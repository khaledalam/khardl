<?php

namespace App\Http\Controllers\API\Central\Auth;

use App\Models\Log;
use App\Models\User;
use App\Models\Tenant;
use App\Models\Promoter;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Enums\Admin\LogTypes;
use App\Rules\UniqueSubdomain;
use Illuminate\Support\Carbon;
use App\Jobs\CreateTenantAdmin;
use App\Jobs\SendVerifyEmailJob;
use App\Models\PromoterIpAddress;
use App\Models\TraderRequirement;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use App\Actions\CreateTenantAction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Models\Tenant\RestaurantUser;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController;
use App\Http\Requests\RestaurantOwnerRegisterRequest;
use App\Http\Requests\Central\CompleteStepTwo\CompleteStepTwoFormRequest;

class RegisterController extends BaseController
{
    public function register(RestaurantOwnerRegisterRequest $request): JsonResponse
    {
        $input = $request->validated();
        $emailKey = str_replace('.', '_', $input['email']);
        $input = $request->validated(); 
        $emailKey = str_replace('.', '_', $input['email']);
        if (!$session = Session::get('register_' . $emailKey)) {
            if ($session['verification_code'] != $request->otp) {
                return $this->sendError(__('OTP code is wrong'));
            }
        }
        $input['password'] = Hash::make($input['password']);
        $input['status'] = RestaurantUser::INACTIVE;

        if ($promoter = PromoterIpAddress::where('ip_address', request()?->ip())) {
            $promoter->update(['registered' => true]);
        }
        $emailKey = str_replace('.', '_', $input['email']);

        Session::forget('register_' . $emailKey);
        $user = User::create($input);
        $user->email_verified_at = now();
        $user->status = RestaurantUser::ACTIVE;
        $user->verification_code = $input['otp'];
        $role = Role::firstOrCreate(['name' => User::RESTAURANT_ROLE]);
        $user->assignRole($role);
        $user->save();
        Auth::login($user, true);
        $data = [
            'user' => $user
        ];
        $data['step2_status'] = 'incomplete';
        return $this->sendResponse($data, 'User register successfully.');
    }

    public function stepTwo(CompleteStepTwoFormRequest $request)
    {
        $user = auth()->user();
        $tenant = $this->createNewRestaurant($user, $request);
        return $this->sendResponse(['url' => $tenant->impersonationUrl(CreateTenantAdmin::RESTAURANT_OWNER_USER_ID)], 'User complete register step two successfully.');
    }
    public function createNewRestaurant($user, $request)
    {
        $this->updateBD($request, $user);
        $this->createOrUpdateTraderRequirements($user, $request);
        if ($user->isRejected()) {
            $url = $this->reSubmitFiles($user);
            return $this->sendResponse(['url' => $url], 'User complete register step two successfully.');
        }
        // Create tenant logic...
        return $this->createTenant($user);
    }
    public function reSubmitFiles($user)
    {

        $user->status = User::RE_UPLOAD_FILES;
        $user->save();

        $tenant = Tenant::findOrFail(Tenant::where('restaurant_name', '=', $user->restaurant_name)->first()?->id);
        // set user status in tenant table too
        $tenant->run(function () use ($user) {
            $rUser = RestaurantUser::where('email', '=', $user?->email)->first();
            $rUser->status = RestaurantUser::ACTIVE;
            $rUser->reject_reasons = null;
            $rUser->save();
        });

        $url = Tenant::where('restaurant_name', '=', $user?->restaurant_name)->first()->impersonationUrl(CreateTenantAdmin::RESTAURANT_OWNER_USER_ID); //  USER restaurant owner id
        return $url;
    }
    public function createTenant($user)
    {
        $tenant = (new CreateTenantAction)
        (
            user: $user,
            domain: $user->restaurant_name
        );
        $actions = [
            'en' => 'Has created new restaurant',
            'ar' => 'انشأ مطعم جديد',
        ];
        Log::create([
            'user_id' => Auth::id(),
            'action' => $actions,
            'type' => LogTypes::CreateNewRestaurant
        ]);
        return $tenant;
    }
   /*  public function createOrUpdateTraderRequirements($user, $request)
    {
        $user_id = $user->id;

        $input = $request->all();
        $input['user_id'] = $user_id;
        // Ensure the directory exists and is writable
        $directory = storage_path("app/private/" . User::STORAGE . "/{$user_id}");
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }

        $fileNames = [
            'commercial_registration',
            'tax_registration_certificate',
            'bank_certificate',
            'identity_of_owner_or_manager',
            'national_address',
        ];

        $userRejectedReasons = json_decode($user?->reject_reasons) ?? [];

        foreach ($fileNames as $fileKey) {

            if ($request->hasFile($fileKey)) {

                if (($key = array_search($fileKey, $userRejectedReasons)) !== false) {
                    unset($userRejectedReasons[$key]);
                }

                $input[$fileKey] = $request->file($fileKey)->storeAs(
                    "user_files/{$user_id}",
                    $fileKey . '_' . date("Y-m-d") . '_' . hash_file('sha256', $request->file($fileKey)->getRealPath()) . '.' . $request->file($fileKey)->getClientOriginalExtension(),
                    'private'
                );
            } else if ($user?->traderRegistrationRequirement?->{$fileKey}) {
                $input[$fileKey] = $user?->traderRegistrationRequirement?->{$fileKey};
            } else if ($fileKey != 'tax_registration_certificate') { // optional
                return $this->sendError('Fail', $fileKey . __('is missing'));
            }
        }
        TraderRequirement::updateOrCreate([
            'user_id' => $user->id
        ], $input);
    } */
    public function createOrUpdateTraderRequirements($user, $request)
    {
        $user_id = $user->id;
        $input = $request->all();
        $input['user_id'] = $user_id;

        $this->ensureDirectoryExists($user_id);

        $fileNames = [
            'commercial_registration',
            'tax_registration_certificate',
            'bank_certificate',
            'identity_of_owner_or_manager',
            'national_address',
        ];

        $userRejectedReasons = json_decode($user?->reject_reasons) ?? [];

        foreach ($fileNames as $fileKey) {
            if ($request->hasFile($fileKey)) {
                $this->removeRejectedReason($fileKey, $userRejectedReasons);

                if ($oldFilePath = $user?->traderRegistrationRequirement?->{$fileKey}) {
                    $this->deleteOldFile($oldFilePath);
                }

                $input[$fileKey] = $this->storeFile($fileKey, $request->file($fileKey), $user_id);
            } elseif ($user?->traderRegistrationRequirement?->{$fileKey}) {
                $input[$fileKey] = $user?->traderRegistrationRequirement?->{$fileKey};
            }else if ($fileKey != 'tax_registration_certificate') { // optional
                return $this->sendError('Fail', $fileKey . __('is missing'));
            }
        }

        TraderRequirement::updateOrCreate(['user_id' => $user->id], $input);
    }

    private function ensureDirectoryExists($user_id)
    {
        $directory = storage_path("app/private/" . User::STORAGE . "/{$user_id}");
        if (!File::exists($directory)) {
            File::makeDirectory($directory, 0755, true);
        }
    }

    private function removeRejectedReason($fileKey, &$userRejectedReasons)
    {
        if (($key = array_search($fileKey, $userRejectedReasons)) !== false) {
            unset($userRejectedReasons[$key]);
        }
    }

    private function storeFile($fileKey, $file, $user_id)
    {
        return $file->storeAs(
            "user_files/{$user_id}",
            $fileKey . '_' . date("Y-m-d") . '_' . hash_file('sha256', $file->getRealPath()) . '.' . $file->getClientOriginalExtension(),
            'private'
        );
    }

    private function deleteOldFile($filePath)
    {
        $fullPath = storage_path("app/private/" . $filePath);
        if (File::exists($fullPath)) {
            File::delete($fullPath);
        }
    }
    public function updateBD($request, $user)
    {
        if ($request->has('dob')) {
            $user->dob = $request->dob;
            $user->save();
            $request->request->remove('dob');
        }
    }

    public function getStepTwoData(Request $request)
    {
        $user = auth()->user();

        $needs = [];
        $files_fields = [
            'commercial_registration',
            'tax_registration_certificate',
            'bank_certificate',
            'identity_of_owner_or_manager',
            'national_address'
        ];

        // dob (on user level not traderRegistrationRequirement
        $text_fields = [
            'IBAN',
            'facility_name',
            'national_id_number',
            'commercial_registration_number'
        ];

        // files
        foreach ($files_fields as $field) {
            if (
                !$user?->traderRegistrationRequirement?->{$field}
                || ($user->isRejected() && in_array($field, json_decode($user?->reject_reasons) ?? []))
            ) {
                $needs[] = $field;
            }
        }

        // texts
        foreach ($text_fields as $field) {
            if (
                !$user?->traderRegistrationRequirement?->{$field}
                || ($user->isRejected() && in_array($field, json_decode($user?->reject_reasons) ?? []))
            ) {
                $needsText[] = $field;
            }
        }
        //dob
        $needsText[] = 'dob';

        return $this->sendResponse([
            'commercial_registration' => $user?->traderRegistrationRequirement?->commercial_registration,
            'commercial_registration_number' => $user?->traderRegistrationRequirement?->commercial_registration_number,

            'tax_registration_certificate' => $user?->traderRegistrationRequirement?->tax_registration_certificate,
            'bank_certificate' => $user?->traderRegistrationRequirement?->bank_certificate,
            'identity_of_owner_or_manager' => $user?->traderRegistrationRequirement?->identity_of_owner_or_manager,
            'national_address' => $user?->traderRegistrationRequirement?->national_address,
            'IBAN' => $user?->traderRegistrationRequirement?->IBAN ?? "",
            'facility_name' => $user?->traderRegistrationRequirement?->facility_name ?? "",
            'dob' => $user?->dob ?? "",
            'needs' => $needs,
            'needsText' => $needsText
        ], 'Fetched User complete register step two.');

    }


    public function sendVerificationCode(Request $request): JsonResponse
    {
        $request->validate([
            'email' => 'required|string|email|min:10|max:255|unique:users',
        ]);
        if (Auth::check()) {
            $request = $request->all();
            $user = Auth::user();

        } else {
            $data = [
                'email' => $request->email,
                'first_name' => $request->first_name,
                'last_name' => $request->last_name
            ];


            $user = new User($data);
        }


        // You might want a new table to track verification code attempts.
        // Here, I'm assuming the table's name is `email_verification_tokens`.

        $attempts = DB::table('email_verification_tokens')
            ->where([
                ['email', '=', $user?->email],
                ['created_at', '>=', Carbon::now()->subMinutes(15)]
            ])->get()->all();

        if (count($attempts) >= 3) {
            return $this->sendError(__('Too many attempts. Request a new verification code after 15 minutes from now.'), __('Too many attempts. Request a new verification code after 15 minutes from now.'));
        }

        // Generate the verification code using the model's method.
        $user->generateVerificationCode();
        if (Auth::check()) {
            $user->save();
        } else {
            $emailKey = str_replace('.', '_', $user->email);
            session(['register_' . $emailKey => array_merge($data, ['verification_code' => $user->verification_code])]);
        }
        // dd($user);
        SendVerifyEmailJob::dispatch($user);
        // dd($user);
        return $this->sendResponse(null, 'Verification code sent to email.');
    }

    public static function increasePromotersEntered($url)
    {
        $promoter = Promoter::where('url', $url)->first();
        if (!$promoter) {
            abort(404);
        }
        PromoterIpAddress::firstOrCreate(['ip_address' => request()?->ip()], [
            'promoter_id' => $promoter->id
        ]);
    }

    // @TODO: register : collected from users table which is assigned ip address while registered

    public function verify(Request $request): JsonResponse
    {

        $request->validate([
            'email' => 'required|email|max:255',
            'code' => 'required|string|min:6|max:6', // Assuming a 6-digit code
        ]);
        if (Auth::check()) {
            $user = Auth::user();
        } else {
            $emailKey = str_replace('.', '_', $request->email);
            $data = Session::get("register_" . $emailKey);


            if (!$data) {
                return $this->sendError(__('Email not found, please try again'));
            }

            $user = new User($data);
        }


        // Check the verification code
        if ($user->checkVerificationCode($request->code)) {
            if (!Auth::check()) {
                return $this->sendResponse($data, 'Email verified successfully!');
            }

            $user->email_verified_at = now();
            $user->status = RestaurantUser::ACTIVE;
            $user->verification_code = $request->code; // Clear the verification code
            $user->save();
            Auth::login($user, true);
            $data = [
                'user' => $user
            ];
            $data['step2_status'] = 'incomplete';

            return $this->sendResponse($data, 'Email verified successfully!');
        }

        // If we've reached here, the verification code is incorrect
        // Note: You may want to track the number of incorrect attempts and handle them accordingly.
        return $this->sendError(__('The verification code is incorrect.'));
    }

}
