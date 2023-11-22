<?php

namespace App\Http\Controllers;

use App\Models\Tenant;
use App\Models\Tenant\RestaurantUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Support\Facades\Mail;
use App\Mail\DeniedEmail;
use App\Mail\ApprovedEmail;
use App\Models\User;
use App\Models\Log;
use App\Models\Promoter;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function dashboard()
    {
        $user = Auth::user();
        return view('admin.dashboard', compact('user'));
    }

    public function addUser()
    {
        $user = Auth::user();
        return view('admin.add-user', compact('user'));
    }

    public function promoters(){

        $promoters = Promoter::paginate(15);

        $user = Auth::user();
        return view('admin.promoters', compact('user', 'promoters'));
    }

    public function addPromoter(Request $request){

        $name = $request['name'];
        $url = $request['url'];
        if(is_null($url)){
            $newURL = Str::random(16);
            while (DB::table('promoters')->where('url', $newURL)->exists()) {
                $newURL = Str::random(16);
            }
            $url = $newURL;
        }

        if(DB::table('promoters')->where('url', $url)->exists()){

            if(app()->getLocale() === 'en')
                return redirect()->back()->with('error', 'URL already exists!');
            else
                return redirect()->back()->with('error', 'هذا الرابط موجود');
        }

        $insertData = [];
        $insertData['url'] = $url;
        $insertData['name'] = $name;
        $insertData['user_id'] = Auth::user()->id;
        $insertData['created_at'] = now();
        $insertData['updated_at'] = now();

        DB::table('promoters')->insert($insertData);

        Log::create([
            'user_id' => Auth::id(),
            'action' => 'Made a promoter with an ID of: ' . DB::table('promoters')->where('url', $url)->value('id'),
        ]);

        if(app()->getLocale() === 'en')
            return redirect()->back()->with('success', 'Promoter added successfully');
        else
            return redirect()->back()->with('success', 'تمت إضافة المروج بنجاح');

    }

    public function generateUser(Request $request)
    {

        $existingUser = User::where('email', $request['email'])->first();
        if ($existingUser) {
            if(app()->getLocale() === 'en')
                return redirect()->back()->with('error', 'Email is already registered.');
            else
                return redirect()->back()->with('error', 'عنوان البريد الإلكترونى هذا مسجل بالفعل');

        }

        $user = new User();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->role = 10;
        $user->phone_number = $request->phone_number;

        $user->save();

        $permissions = [
            'can_access_restaurants',
            'can_view_restaurants',
            'can_approve_restaurants',
            'can_see_admins',
            'can_edit_admins',
            'can_add_admins',
            'can_promoters',
            'can_see_logs',
            'can_settings',
            'can_edit_profile',
            'can_delete_restaurants',
        ];

        $insertData = [];

        foreach ($permissions as $permission) {
            $insertData[$permission] = $request->has($permission) ? 1 : 0;
        }

        $insertData['user_id'] = $user->id;
        $insertData['can_access_dashboard'] = 1;

        DB::table('permissions')->insert($insertData);

        Log::create([
            'user_id' => Auth::id(),
            'action' => 'Made an user with an ID of: ' . $user->id,
        ]);

        if(app()->getLocale() === 'en')
            return redirect()->back()->with('success', 'Admin added successfully');
        else
            return redirect()->back()->with('success', 'تمت إضافة المسؤول بنجاح');
    }


    public function profile()
    {
        $user = Auth::user();
        return view('admin.profile', compact('user'));
    }

    public function editProfile(){

        $user = Auth::user();
        return view('admin.edit-profile', compact('user'));
    }

    public function updateProfile(Request $request){

        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone_number' => 'required|string|max:255',
        ]);

        $loggedUserId = Auth::id();
        $user = User::find($loggedUserId);

        Log::create([
            'user_id' => Auth::id(),
            'action' => 'Has edited his profile.',
        ]);

        $user->first_name = $validatedData['first_name'];
        $user->last_name = $validatedData['last_name'];
        $user->email = $validatedData['email'];
        $user->phone_number = $validatedData['phone_number'];
        if($request->input('password') != ""){
            $user->password = Hash::make($request->input('password'));
        }

        $user->save();

        if(app()->getLocale() === 'en')
            return redirect()->route('admin.profile')->with('success', 'Profile updated successfully');
        else
            return redirect()->route('admin.profile')->with('success', 'تم تحديث الملف الشخصي بنجاح');

    }

    public function restaurants(Request $request)
    {
        // users from central table
        $query = User::where('restaurant_name', '<>', null);

        $restaurants =  Tenant::with("primary_domain")->paginate();
        // foreach($restaurants as $restaurant){
        //     $restaurant->run(function ($tenant) {
        //         $query = RestaurantUser::where('branch_id', null);
        //     });
        // }
       
        // if ($request->has('search')) {
        //     $search = $request->input('search');
        //     $query->where('first_name', 'like', '%' . $search . '%');
        //     $query->Where('last_name', 'like', '%' . $search . '%');
        // }
        // if ($request->has('status') && $request->input('status') != "All") {
        //     $status = $request->input('status');
        //     $query->where('status', $status);
        // }
    
        // $restaurants = $query->paginate(15);

        $user = Auth::user();

        return view('admin.restaraunts', compact('restaurants', 'user'));
    }

    public function viewRestaurant($id){
      
        $restaurant = Tenant::findOrFail($id);//->with('user.traderRegistrationRequirement');
        
        // if($restaurant->role == 0){
        //     return view('admin.view-restaurant', compact('restaurant'));
        // }else{
        //     return abort(404);
        // }
        return view('admin.view-restaurant', compact('restaurant'));
       
    }

    public function viewRestaurantOrders($id){

        $restaurant = User::findOrFail($id);

        if($restaurant->role == 0){
            $orders = DB::table('orders')
            ->where('user_id', $id)
            ->get();

            return view('admin.view-restaurant-orders', compact('restaurant', 'orders'));
        }
        return abort(404);
    }

    public function deleteRestaurant($id)
    {
        User::findOrFail($id)->delete();

            Log::create([
                'user_id' => Auth::id(),
                'action' => 'Has deleted a restaurant with an ID of: ' . $id,
            ]);

        if(app()->getLocale() === 'en')
            return redirect()->back()->with('success', 'Deleted successfully.');
        else
            return redirect()->back()->with('success', 'حذف بنجاح.');
    }

    public function deleteUser($id)
    {
        DB::beginTransaction();

        try {

            Log::create([
                'user_id' => Auth::id(),
                'action' => 'Has deleted an user with an ID of: ' . $id,
            ]);

            DB::table('logs')->where('user_id', $id)->delete();
            DB::table('permissions')->where('user_id', $id)->delete();
            User::findOrFail($id)->delete();

            DB::commit();


            if(app()->getLocale() === 'en')
                return redirect()->back()->with('success', 'Deleted successfully.');
            else
                return redirect()->back()->with('success', 'حذف بنجاح.');
        } catch (\Exception $e) {
            DB::rollBack();

            if(app()->getLocale() === 'en')
                return redirect()->back()->with('error', 'Error deleting user and related records: ' . $e->getMessage());
            else
                return redirect()->back()->with('error', 'خطأ في حذف المستخدم والسجلات ذات الصلة' . $e->getMessage());
        }
    }

    public function deletePromoter($id){
        Log::create([
            'user_id' => Auth::id(),
            'action' => 'Has deleted a promoter with an ID of: ' . $id,
        ]);

        DB::table('promoters')->where('id', $id)->delete();

        if(app()->getLocale() === 'en')
                return redirect()->back()->with('success', 'Deleted successfully.');
            else
                return redirect()->back()->with('success', 'حذف بنجاح.');

    }

    public function settings()
    {
        $user = Auth::user();
        return view('admin.settings', compact('user'));
    }

    public function userManagement()
    {
        $users = User::where('role', 10)
        ->paginate(15);
        $user = Auth::user();
        $logs = Log::orderBy('created_at', 'desc')->get();

        return view('admin.user-management', compact('user', 'users', 'logs'));
    }

    public function userManagementEdit($id){

        $user = User::findOrFail($id);

        if($user->role != 10){
            return abort(404);
        }
        return view('admin.edit-user', compact('user'));

    }

    public function logs(Request $request)
    {
        $user = Auth::user();
        $query = DB::table('logs')->orderBy('created_at', 'desc');

        if ($request->filled('user_id')) {
            if ($request->input('user_id') != 'all') {
                $query->where('user_id', $request->input('user_id'));
            }
        }

        if ($request->filled('action')) {
            if ($request->input('action') != 'all') {
                $query->where('action', 'LIKE', '%' . $request->input('action') . '%');
            }
        }

        $users = User::where('role', 10)->get();

        $logs = $query->paginate(25);

        return view('admin.logs', compact('user', 'logs', 'users'));
    }


    public function updateUserPermissions(Request $request, $userId){

        $selectedUser = User::find($userId);

        $selectedUser->first_name = $request->input('first_name');
        $selectedUser->last_name = $request->input('last_name');
        $selectedUser->phone_number = $request->input('phone_number');
        $selectedUser->email = $request->input('email');

        $permissions = [
            'can_access_restaurants',
            'can_view_restaurants',
            'can_approve_restaurants',
            'can_see_admins',
            'can_edit_admins',
            'can_add_admins',
            'can_promoters',
            'can_see_logs',
            'can_settings',
            'can_edit_profile',
            'can_delete_restaurants',
        ];

        $updateData = [];

        foreach ($permissions as $permission) {
            $updateData[$permission] = $request->has($permission) ? 1 : 0;
        }
        $updateData['can_access_dashboard'] = 1;
        DB::table('permissions')
            ->where('user_id', $userId)
            ->update($updateData);

        $selectedUser->save();

        $user = Auth::user();

        Log::create([
            'user_id' => Auth::id(),
            'action' => 'Has edited profile and permissions for an user with ID of: ' . $userId,
        ]);

        if(app()->getLocale() === 'en')
            return redirect()->route('admin.user-management')->with([
                'success' => 'User updated successfully',
            ])->with(compact('user'));
        else
            return redirect()->route('admin.user-management')->with([
                'success' => 'User updated successfully',
            ])->with(compact('user'));
    }

    public function giveUnapprovedUsers(){

        $unapprovedUsers = User::where('isApproved', 0)
        ->where('role', 0)
        ->whereNotNull('commercial_registration_pdf')
        ->whereNotNull('signed_contract_delivery_company')
        ->whereNotNull('email_verified_at')
        ->paginate(15);

        $loggedUser = Auth::user();

        return view('admin.unapproved', compact('unapprovedUsers', 'loggedUser'));
    }

    public function approveUser($id)
    {
        $user = User::find($id);

        if ($user) {
            $user->isApproved = 1;
            $user->save();
        }
        Mail::to($user->email)->send(new ApprovedEmail($user));

        $loggedUser = Auth::user();

        Log::create([
            'user_id' => Auth::id(),
            'action' => 'Has approved an user with an ID of: ' . $id,
        ]);

        if(app()->getLocale() === 'en')
            return redirect()->back()->with([
                'success' => 'User approved successfully',
            ])->with(compact('loggedUser'));
        else
            return redirect()->back()->with([
                'success' => 'تم تحديث المسوؤل بنجاح',
            ])->with(compact('loggedUser'));

    }

    public function denyUser(Request $request, $id)
    {
        $user = User::find($id);
        $selectedOption = $request->input('option');
        if($selectedOption == null){
            return redirect()->back()->with('error', 'You have to select one option at least!');
        }

        if ($user) {
            $user->isApproved = 2;
            if($selectedOption == 'option1'){
                $user->commercial_registration_pdf = null;
            }
            else if($selectedOption == 'option2'){
                $user->signed_contract_delivery_company	= null;
            }
            else{
                $user->commercial_registration_pdf = null;
                $user->signed_contract_delivery_company	= null;
            }
            $user->save();
        }

        Mail::to($user->email)->send(new DeniedEmail($user, $selectedOption));

        Log::create([
            'user_id' => Auth::id(),
            'action' => 'Has denied an user with an ID of: ' . $id,
        ]);

        if(app()->getLocale() === 'en')
            return redirect()->back()->with([
                'success' => 'User denied successfully',
                'user' => Auth::user()
            ]);
        else
            return redirect()->back()->with([
                'success' => 'User denied successfully',
                'user' => Auth::user()
            ]);
    }

    public function downloadCommercialRegistration($filename){
        $filePath = 'private/commercial_registration/' . $filename;
        $file = Storage::disk('local')->get($filePath);

        if ($file) {
            Log::create([
                'user_id' => Auth::id(),
                'action' => 'Has downloaded a commercial registration file with a filename of: ' . $filename,
            ]);
            return response()->download(storage_path('app/' . $filePath), $filename);
        } else {
            abort(404, 'File not found');
        }

    }

    public function downloadDeliveryContract($filename){
        $filePath = 'private/delivery_contract/' . $filename;
        $file = Storage::disk('local')->get($filePath);

        if ($file) {
            Log::create([
                'user_id' => Auth::id(),
                'action' => 'Has downloaded a delivery contract file with a filename of: ' . $filename,
            ]);
            return response()->download(storage_path('app/' . $filePath), $filename);
        } else {
            abort(404, 'File not found');
        }

    }

    public function downloadTaxNumber($filename){
        $filePath = 'private/tax_number/' . $filename;
        $file = Storage::disk('local')->get($filePath);

        if ($file) {
            Log::create([
                'user_id' => Auth::id(),
                'action' => 'Has downloaded a tax number file with a filename of: ' . $filename,
            ]);
            return response()->download(storage_path('app/' . $filePath), $filename);
        } else {
            abort(404, 'File not found');
        }

    }

    public function downloadBankCertificate($filename){
        $filePath = 'private/bank_certificate/' . $filename;
        $file = Storage::disk('local')->get($filePath);

        if ($file) {
            Log::create([
                'user_id' => Auth::id(),
                'action' => 'Has downloaded a bank certificate file with a filename of: ' . $filename,
            ]);
            return response()->download(storage_path('app/' . $filePath), $filename);
        } else {
            abort(404, 'File not found');
        }

    }
}
