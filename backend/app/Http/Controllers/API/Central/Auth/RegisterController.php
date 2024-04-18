<?php

namespace App\Http\Controllers\API\Central\Auth;

use App\Enums\Admin\LogTypes;
use App\Jobs\SendVerifyEmailJob;
use App\Models\Log;
use App\Models\Tenant;
use App\Models\Tenant\RestaurantUser;
use App\Models\User;
use App\Models\Promoter;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use App\Rules\UniqueSubdomain;
use Illuminate\Support\Carbon;
use App\Jobs\CreateTenantAdmin;
use App\Models\PromoterIpAddress;
use App\Models\TraderRequirement;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use App\Actions\CreateTenantAction;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\API\BaseController;
use App\Http\Requests\RestaurantOwnerRegisterRequest;
use Spatie\Permission\Models\Role;

class RegisterController extends BaseController
{
    public function register(RestaurantOwnerRegisterRequest $request): JsonResponse
    {
        $input = $request->validated();
        $input['password'] = Hash::make($input['password']);
        $input['status'] = RestaurantUser::INACTIVE;
        $user = User::create($input);
        $success['token'] =  $user->createToken('Personal Access Token')->accessToken;
        $success['name'] =  "$user->first_name $user->last_name";
        $role = Role::firstOrCreate(['name' => User::RESTAURANT_ROLE]);
        $user->assignRole($role);
        Auth::login($user,true);
        if($promoter = PromoterIpAddress::where('ip_address',request()?->ip())){
            $promoter->update(['registered'=>true]);
        }
        $this->sendVerificationCode($request);
        return $this->sendResponse($success, 'User register successfully.');
    }

    public function stepTwo(Request $request)
    {
        $request->validate([
            'commercial_registration' => 'nullable|mimes:pdf,jpg,jpeg,png|max:25600', // 25MB
            'tax_registration_certificate' => 'nullable|mimes:pdf,jpg,jpeg,png|max:25600',
            'bank_certificate' => 'nullable|mimes:pdf,jpg,jpeg,png|max:25600',
            'identity_of_owner_or_manager' => 'nullable|mimes:pdf,jpg,jpeg,png|max:25600',
            'national_address' => 'nullable|mimes:pdf,jpg,jpeg,png|max:25600',

            'commercial_registration_number' => 'nullable|string|min:5|max:255',
            'IBAN' => 'nullable|string|min:10|max:255',
            'facility_name' => 'nullable|string|min:5|max:255',
            'national_id_number' => 'nullable|string|min:5|max:255',
            'dob' => 'nullable|date_format:Y-m-d'
        ]);

        $user = auth()->user();

        // Check if the trader's registration requirements already fulfilled.
        if ($user?->traderRegistrationRequirement && !$user->isRejected()) {
            return $this->sendResponse(null, 'User already completed register step2 successfully.');
        }

        if ($request->has('dob')) {
            $user->dob = $request->dob;
            $user->save();
            $request->request->remove('dob');
        }

        $user_id = $user->id;

        $input = $request->all();
        $input['user_id'] = $user_id;

        // Ensure the directory exists and is writable
        $directory = storage_path("app/private/".User::STORAGE."/{$user_id}");
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
            } else if($fileKey != 'tax_registration_certificate') { // optional
                return $this->sendError('Fail', $fileKey . __('is missing'));
            }
        }
        TraderRequirement::create($input);


        if ($user->isRejected()) {

            if (!count($userRejectedReasons)) {
                $user->status = User::STATUS_ACTIVE;
                $user->save();

                $tenant = Tenant::findOrFail(Tenant::where('restaurant_name', '=', $user->restaurant_name)->first()?->id);
                // set user status in tenant table too
                $tenant->run(function () use($user){
                    $rUser = RestaurantUser::where('email', '=', $user?->email)->first();
                    $rUser->status = RestaurantUser::ACTIVE;
                    $rUser->reject_reasons = null;
                    $rUser->save();
                });

            }

            $url = Tenant::where('restaurant_name', '=', $user?->restaurant_name)->first()->impersonationUrl(CreateTenantAdmin::RESTAURANT_OWNER_USER_ID); //  USER restaurant owner id

            return $this->sendResponse(['url' => $url], 'User complete register step two successfully.');
        }

        // Create tenant logic...

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
        return $this->sendResponse(['url'=>$tenant->impersonationUrl(CreateTenantAdmin::RESTAURANT_OWNER_USER_ID)], 'User complete register step two successfully.');
    }

    public function getStepTwoData(Request $request)
    {
        $user = auth()->user();

        $needs = [];
        $files_fields = [
            'commercial_registration', 'tax_registration_certificate',
            'bank_certificate', 'identity_of_owner_or_manager',
            'national_address'
        ];

        // dob (on user level not traderRegistrationRequirement
        $text_fields = [
            'IBAN', 'facility_name',
            'national_id_number', 'commercial_registration_number'
        ];

        // files
        foreach ($files_fields as $field) {
            if (!$user?->traderRegistrationRequirement?->{$field}
                || ($user->isRejected() && in_array($field, json_decode($user?->reject_reasons) ?? []))) {
                $needs[] = $field;
            }
        }

        // texts
        foreach ($text_fields as $field) {
            if (!$user?->traderRegistrationRequirement?->{$field}
                || ($user->isRejected() && in_array($field, json_decode($user?->reject_reasons) ?? []))) {
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
        $today = Carbon::today();
        $user = Auth::user();
        // You might want a new table to track verification code attempts.
        // Here, I'm assuming the table's name is `email_verification_tokens`.
        $attempts = DB::table('email_verification_tokens')
            ->where([
                ['email', '=', $user?->email],
                ['created_at', '>=', Carbon::now()->subMinutes(15)]
            ])->get()->all();

        if (count($attempts) >= 3) {
            return $this->sendError('Fail', __('Too many attempts. Request a new verification code after 15 minutes from now.'));
        }

        // Generate the verification code using the model's method.
        $user->generateVerificationCode();

        SendVerifyEmailJob::dispatch($user);

        return $this->sendResponse(null, 'Verification code sent to email.');
    }

    public static function increasePromotersEntered($url){
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
            // 'email' => 'required|email|max:255',
            'code' => 'required|string|min:6|max:6', // Assuming a 6-digit code
        ]);
        $user =Auth::user();

        // If the user has already verified their email
        // if ($user->email_verified_at !== null) {

        //     return $this->sendError('Fail', 'Email is already verified.');
        // }

        // Check the verification code
        if ($user->checkVerificationCode($request->code)) {
            $user->email_verified_at = now();
            $user->status = RestaurantUser::ACTIVE;
            $user->verification_code = $request->code; // Clear the verification code
            $user->save();

            return $this->sendResponse(null, 'Email verified successfully!');
        }

        // If we've reached here, the verification code is incorrect
        // Note: You may want to track the number of incorrect attempts and handle them accordingly.
        return $this->sendError('Fail', 'The verification code is incorrect.');
    }

}
