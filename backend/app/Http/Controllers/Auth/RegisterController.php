<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'has_mobile_app' => 'required|in:0,1',
            'has_delivery_system' => 'required|in:0,1',
            'has_own_deliveries' => 'required_if:has_delivery_system,1|in:0,1',
            'use_delivery_app' => 'required_if:has_own_deliveries,1|in:0,1',
            'sign_contract_with_delivery' => 'required_if:has_own_deliveries,0|in:0,1',
            'has_cashier_system' => 'required|in:0,1',
            'use_order_app' => 'required_if:has_cashier_system,0|in:0,1',
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'restaurant_name' => 'required|string|unique:users',
            'phone_number' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'commercial_registration' => 'required|file',
            'signed_contract_delivery_company' => 'required_if:sign_contract_with_delivery,1|file'
        ]);
    }

    public function showRegisterForm($url){
        $urlRecord = DB::table('promoters')->where('url', $url)->first();

        if (!$urlRecord) {
            abort(404);
        }

        $key = 'promoter_entered_' . $url . '_' . request()->ip();

        if (!session()->has($key)) {
            DB::table('promoters')
                ->where('url', $url)
                ->increment('entered', 1);
            
            session([$key => true]);
        }

        return view('auth.register', ['url' => $urlRecord]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $contents = file_get_contents($data['commercial_registration']);
        $fileName = Str::random(40) . '.' . $data['commercial_registration']->getClientOriginalExtension();
        $filePath = 'private/commercial_registration/' . $fileName;
        Storage::disk('local')->put($filePath, $contents);

        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'restaurant_name' => $data['restaurant_name'],
            'phone_number' => $data['phone_number'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'commercial_registration_pdf' => $fileName,
            'membership' => 0
        ]);
    }
}