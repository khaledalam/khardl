<?php

namespace App\Http\Controllers\Web\Tenant\Auth;



use App\Http\Controllers\Web\BaseController;
use App\Models\Tenant\RestaurantUser;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth as AuthFacades;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class RegisterController extends BaseController
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
     *
     * */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
            'c_password' => 'required|same:password',
        ]);
    }

    public function showRegisterForm($url){
        $urlRecord = DB::table('promoters')->where('url', $url)->first();

        if (!$urlRecord) {
            abort(404);
        }

        $key = 'promoter_entered_' . $url . '_' . request()?->ip();

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

        return RestaurantUser::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'restaurant_name' => $data['restaurant_name'],
            'phone' => $data['phone'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'commercial_registration_pdf' => $fileName,
            'membership' => 0
        ]);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|min:3|max:255',
            'last_name' => 'required|string|min:3|max:255',
            'email' => 'required|string|email|min:10|max:255|unique:users',
            'password' => 'required|string|min:6|max:255',
            'c_password' => 'required|same:password',
            'phone' => 'required|string|min:10|max:14',
            'terms_and_policies' => 'accepted',
        ]);

        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['status'] = 'inactive';
        $user = RestaurantUser::create($input);
        $success['name'] =  "$user->first_name $user->last_name";


        AuthFacades::login($user);
        $this->sendVerificationSMSCode($request);
        return $this->sendResponse($success, 'Customer registered successfully.');
    }

    public function sendVerificationSMSCode(Request $request)
    {

    }
}
