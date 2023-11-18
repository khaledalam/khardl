<?php

namespace App\Http\Controllers\Web\Tenant;

use App\Http\Controllers\Web\BaseController;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\Tenant\Branch;
use App\Models\Tenant\RestaurantUser;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Contracts\Database\Query\Builder;

class RestaurantController extends BaseController
{
    public function index(){

        /** @var RestaurantUser $user */
        $user = Auth::user();
        $branches = Branch::all();

        return view('restaurant.summary', compact('user', 'branches'));
    }

    public function services(){
        /** @var RestaurantUser $user */
        $user = Auth::user();
        $branches = Branch::all();

        return view('restaurant.services',
            compact('user', 'branches'));
    }

    public function branches(){
        $user = Auth::user();
        $available_branches = $user->number_of_available_branches();
        $branches =  DB::table('branches')
        ->when($user->isWorker(), function (Builder $query, string $role)use($user) {
            $query->where('id', $user->branch->id);
        })
        ->get()
        ->sortByDesc('is_primary');

        return view(($user->isRestaurantOwner())?'restaurant.branches':'worker.branches',
        compact('available_branches','user', 'branches')); //view('branches')
    }

    public function addBranch(Request $request){

        if(!$this->can_create_branch()){
            return redirect()->back()->with('error', 'Not allowed to create branch');
        }
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'location' => 'required',
            'copy_menu' => 'required',
            'saturday_open' => 'required|date_format:H:i',
            'saturday_close' => 'required|date_format:H:i|after:saturday_open',
            'sunday_open' => 'required|date_format:H:i',
            'sunday_close' => 'required|date_format:H:i|after:sunday_open',
            'monday_open' => 'required|date_format:H:i',
            'monday_close' => 'required|date_format:H:i|after:monday_open',
            'tuesday_open' => 'required|date_format:H:i',
            'tuesday_close' => 'required|date_format:H:i|after:tuesday_open',
            'wednesday_open' => 'required|date_format:H:i',
            'wednesday_close' => 'required|date_format:H:i|after:wednesday_open',
            'thursday_open' => 'required|date_format:H:i',
            'thursday_close' => 'required|date_format:H:i|after:thursday_open',
            'friday_open' => 'required|date_format:H:i',
            'friday_close' => 'required|date_format:H:i|after:friday_open',
        ]);


        list($lat, $lng) = explode(' ', $validatedData['location']);

        $branchesExist = DB::table('branches')->where('is_primary',1)->exists();

        $newBranchId = DB::table('branches')->insertGetId([
            'name' => $validatedData['name'],
            'lat' => (float) $lat,
            'lng' => (float) $lng,
            'is_primary' => !$branchesExist,
            'saturday_open' => Carbon::createFromFormat('H:i', $request->input('saturday_open'))->format('H:i'),
            'saturday_close' => Carbon::createFromFormat('H:i', $request->input('saturday_close'))->format('H:i'),
            'sunday_open' => Carbon::createFromFormat('H:i', $request->input('sunday_open'))->format('H:i'),
            'sunday_close' => Carbon::createFromFormat('H:i', $request->input('sunday_close'))->format('H:i'),
            'monday_open' => Carbon::createFromFormat('H:i', $request->input('monday_open'))->format('H:i'),
            'monday_close' => Carbon::createFromFormat('H:i', $request->input('monday_close'))->format('H:i'),
            'tuesday_open' => Carbon::createFromFormat('H:i', $request->input('tuesday_open'))->format('H:i'),
            'tuesday_close' => Carbon::createFromFormat('H:i', $request->input('tuesday_close'))->format('H:i'),
            'wednesday_open' => Carbon::createFromFormat('H:i', $request->input('wednesday_open'))->format('H:i'),
            'wednesday_close' => Carbon::createFromFormat('H:i', $request->input('wednesday_close'))->format('H:i'),
            'thursday_open' => Carbon::createFromFormat('H:i', $request->input('thursday_open'))->format('H:i'),
            'thursday_close' => Carbon::createFromFormat('H:i', $request->input('thursday_close'))->format('H:i'),
            'friday_open' => Carbon::createFromFormat('H:i', $request->input('friday_open'))->format('H:i'),
            'friday_close' => Carbon::createFromFormat('H:i', $request->input('friday_close'))->format('H:i'),
        ]);

        if ($validatedData['copy_menu'] != "None") {

            $categories = DB::table('categories')->where('branch_id', $validatedData['copy_menu'])->get();
            foreach ($categories as $category) {
                DB::table('categories')->insert([
                    'branch_id' => $newBranchId,
                    'category_name' => $category->category_name,
                    'user_id' => Auth::user()->id,
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                $newCategoryId = DB::getPdo()->lastInsertId();

                $items = DB::table('items')->where('category_id', $category->id)->get();
                foreach ($items as $item) {
                    $newFilename = Str::uuid()->toString() . '.' . pathinfo($item->photo, PATHINFO_EXTENSION);

                    DB::table('items')->insert([
                        'branch_id' => $newBranchId,
                        'category_id' => $newCategoryId,
                        // 'name' => $item->name,
                        'photo' => $newFilename,
                        'price' => $item->price,
                        'calories' => $item->calories,
                        'description' => $item->description,
                        'checkbox_required' => $item->checkbox_required,
                        'checkbox_input_titles' => $item->checkbox_input_titles,
                        'checkbox_input_maximum_choices' => $item->checkbox_input_maximum_choices,
                        'checkbox_input_names' => $item->checkbox_input_names,
                        'checkbox_input_prices' => $item->checkbox_input_prices,
                        'selection_required' => $item->selection_required,
                        'selection_input_names' => $item->selection_input_names,
                        'selection_input_prices' => $item->selection_input_prices,
                        'selection_input_titles' => $item->selection_input_titles,
                        'dropdown_required' => $item->dropdown_required,
                        'dropdown_input_names' => $item->dropdown_input_names,
                        'user_id' => Auth::user()->id,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ]);

                    $sourcePath = storage_path("{$item->photo}");
                    $destinationPath = storage_path("{$newFilename}");

                    if (file_exists($sourcePath)) {
                        $destinationPath = str_replace('/', DIRECTORY_SEPARATOR, $destinationPath);
                        Storage::disk('local')->copy($sourcePath, $destinationPath);
                    }


                }
            }
        }

        return redirect()->back()->with('success', 'Branch successfully added.');

    }
    private function can_create_branch(){
        // redirect to payment gateway
        return true;
    }


    public function updateBranch(Request $request, $id)
    {
        // if(Auth::user()->id != DB::table('branches')->where('id', $id)->value('user_id'))
        //     return;

        $validatedData = $request->validate([
            'saturday_open' => 'required|date_format:H:i',
            'saturday_close' => 'required|date_format:H:i|after:saturday_open',
            'sunday_open' => 'required|date_format:H:i',
            'sunday_close' => 'required|date_format:H:i|after:sunday_open',
            'monday_open' => 'required|date_format:H:i',
            'monday_close' => 'required|date_format:H:i|after:monday_open',
            'tuesday_open' => 'required|date_format:H:i',
            'tuesday_close' => 'required|date_format:H:i|after:tuesday_open',
            'wednesday_open' => 'required|date_format:H:i',
            'wednesday_close' => 'required|date_format:H:i|after:wednesday_open',
            'thursday_open' => 'required|date_format:H:i',
            'thursday_close' => 'required|date_format:H:i|after:thursday_open',
            'friday_open' => 'required|date_format:H:i',
            'friday_close' => 'required|date_format:H:i|after:friday_open',
        ]);

        $formattedData = [
            'saturday_open' => Carbon::createFromFormat('H:i', $validatedData['saturday_open'])->format('H:i'),
            'saturday_close' => Carbon::createFromFormat('H:i', $validatedData['saturday_close'])->format('H:i'),
            'sunday_open' => Carbon::createFromFormat('H:i', $validatedData['sunday_open'])->format('H:i'),
            'sunday_close' => Carbon::createFromFormat('H:i', $validatedData['sunday_close'])->format('H:i'),
            'monday_open' => Carbon::createFromFormat('H:i', $validatedData['monday_open'])->format('H:i'),
            'monday_close' => Carbon::createFromFormat('H:i', $validatedData['monday_close'])->format('H:i'),
            'tuesday_open' => Carbon::createFromFormat('H:i', $validatedData['tuesday_open'])->format('H:i'),
            'tuesday_close' => Carbon::createFromFormat('H:i', $validatedData['tuesday_close'])->format('H:i'),
            'wednesday_open' => Carbon::createFromFormat('H:i', $validatedData['wednesday_open'])->format('H:i'),
            'wednesday_close' => Carbon::createFromFormat('H:i', $validatedData['wednesday_close'])->format('H:i'),
            'thursday_open' => Carbon::createFromFormat('H:i', $validatedData['thursday_open'])->format('H:i'),
            'thursday_close' => Carbon::createFromFormat('H:i', $validatedData['thursday_close'])->format('H:i'),
            'friday_open' => Carbon::createFromFormat('H:i', $validatedData['friday_open'])->format('H:i'),
            'friday_close' => Carbon::createFromFormat('H:i', $validatedData['friday_close'])->format('H:i'),
            'saturday_closed' => $request->has('saturday_closed') ? 1 : 0,
            'sunday_closed' => $request->has('sunday_closed') ? 1 : 0,
            'monday_closed' => $request->has('monday_closed') ? 1 : 0,
            'tuesday_closed' => $request->has('tuesday_closed') ? 1 : 0,
            'wednesday_closed' => $request->has('wednesday_closed') ? 1 : 0,
            'thursday_closed' => $request->has('thursday_closed') ? 1 : 0,
            'friday_closed' => $request->has('friday_closed') ? 1 : 0,
        ];

        DB::table('branches')->where('id', $id)->update($formattedData);

        return redirect()->back()
            ->with('success', 'Branch updated successfully');
    }

    public function updateBranchLocation(Request $request, $id){

        // if(Auth::user()->id != DB::table('branches')->where('id', $id)->value('user_id'))
        // return;

        $lat = number_format((float)$request->input('lat'), 8, '.', '');
        $lng = number_format((float)$request->input('lng'), 8, '.', '');


        DB::table('branches')
            ->where('id', $id)
            ->update([
                'lat' => $lat,
                'lng' => $lng,
            ]);

        return redirect()->back()->with('success', 'Location successfully changed.');

    }

    public function menu($branchId){

        $user = Auth::user();
        // if($user->id != DB::table('branches')->where('id', $branchId)->value('user_id')){
        //     return redirect()->route('restaurant.branches')->with('error', 'Unauthorized access');
        // }

        $categories = DB::table('categories')
        ->when($user->isWorker(), function (Builder $query, string $role)use($user) {
            $query->where('branch_id', $user->branch->id) ->where('user_id', $user->id);
        })
        ->get();
        return view('restaurant.menu', compact('user', 'categories', 'branchId'));
    }

    public function getCategory(Request $request, $id, $branchId){
        $user = Auth::user();

        if(!$user->isRestaurantOwner()  && $user->branch->id != $branchId){
            return redirect()->route('restaurant.branches')->with('error', 'Unauthorized access');
        }

        $selectedCategory = DB::table('categories')->where('id', $id)->where('branch_id', $branchId)->first();
        $categories = DB::table('categories')->where('id', $id)->where('branch_id', $branchId)->get();

        $items = DB::table('items')
        ->where('user_id', $user->id)
        ->where('category_id', $selectedCategory->id)
        ->where('branch_id', $branchId)->get();

        return view('restaurant.menu-category', compact('user', 'selectedCategory', 'categories', 'items', 'branchId'));
    }


    public function addCategory(Request $request, $branchId){

        $userId = Auth::user()->id;

        // if($userId != DB::table('branches')->where('id', $branchId)->value('user_id')){
        //     return redirect()->route('restaurant.branches')->with('error', 'Unauthorized access');
        // }

        // if($userId != DB::table('branches')->where('id', $branchId)->value('user_id'))
        //     return;
        DB::table('categories')->insert([
            'category_name' => $request->input('category_name'),
            'user_id' => $userId,
            'branch_id' => $branchId,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return redirect()->back()->with('success', 'Category successfully added.');
    }

    public function addItem(Request $request, $id, $branchId){

        // if(Auth::user()->id != DB::table('branches')->where('id', $branchId)->value('user_id')){
        //     return redirect()->route('restaurant.branches')->with('error', 'Unauthorized access');
        // }

        // DB::table('categories')->where('id', $id)->where('branch_id', $branchId)->value('user_id') == Auth::user()->id && $request->hasFile('photo')

        if (DB::table('categories')->where('id', $id)->where('branch_id', $branchId)->value('user_id')) {

            $photoFile = $request->file('photo');

            $filename = Str::random(40) . '.' . $photoFile->getClientOriginalExtension();

            while (Storage::disk('private')->exists('items/' . $filename)) {
                $filename = Str::random(40) . '.' . $photoFile->getClientOriginalExtension();
            }

            $photoFile->storeAs('items', $filename, 'private');

            DB::beginTransaction();

            try {

                $itemData = [
                    'photo' => $filename,
                    'price' => $request->input('price'),
                    'calories' => $request->input('calories'),
                    'description' => $request->input('description'),
                    'checkbox_required' => $request->has('checkbox_required'),
                    'checkbox_input_titles' => json_encode($request->input('checkboxInputTitle')),
                    'checkbox_input_maximum_choices' => json_encode($request->input('checkboxInputMaximumChoice')),
                    'checkbox_input_names' => json_encode($request->input('checkboxInputName')),
                    'checkbox_input_prices' => json_encode($request->input('checkboxInputPrice')),
                    'selection_required' => $request->has('selection_required'),
                    'selection_input_names' => json_encode($request->input('selectionInputName')),
                    'selection_input_prices' => json_encode($request->input('selectionInputPrice')),
                    'selection_input_titles' => json_encode($request->input('selectionInputTitle')),
                    'dropdown_required' => $request->has('dropdown_required'),
                    'dropdown_input_names' => json_encode($request->input('dropdownInputName')),
                    'category_id' => $id,
                    'user_id' => Auth::user()->id,
                    'branch_id' => $branchId,
                    'created_at' => now(),
                    'updated_at' => now(),
                ];

                DB::table('items')->insert($itemData);

                DB::commit();

                return redirect()->back()->with('success', 'Item successfully added.');
            } catch (\Exception $e) {
                DB::rollback();
                return redirect()->back()->with('error', $e->getMessage());
            }
        }
    }

    public function deleteCategory($id){

        $user = Auth::user();

        $selectedCategory = DB::table('categories')->where('id', $id)->first();

        if ($selectedCategory && $user->id == $selectedCategory->user_id) {

            DB::table('items')->where('category_id', $id)->delete();
            DB::table('categories')->where('id', $id)->delete();

            return redirect()->route('restaurant.menu', ['branchId' => $selectedCategory->branch_id])->with('success', 'Category successfully deleted.');

        } else {
            return redirect()->back()->with('error', 'You are not authorized to access that page.');
        }
    }

    public function deleteItem($id){

        $user = Auth::user();

        $selectedItem = DB::table('items')->where('id', $id)->first();

        if ($selectedItem && $user->id == $selectedItem->user_id) {

            DB::table('items')->where('id', $id)->delete();

            return redirect()->route('restaurant.menu', ['branchId' => $selectedItem->branch_id])->with('success', 'Item successfully deleted.');

        } else {
            return redirect()->back()->with('error', 'You are not authorized to access that page.');
        }
    }



    public function updateProfile(Request $request)
    {
        $validatedData = $request->validate([
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'phone' => 'required|string|max:255',
            // 'commercial_registration' => 'nullable|file',
            // 'delivery_contract' => 'nullable|file',
        ]);

        $loggedUserId = Auth::id();
        $user = RestaurantUser::find($loggedUserId);

        // if ($request->hasFile('commercial_registration')) {
        //     $file = $request->file('commercial_registration');
        //     $contents = file_get_contents($file);
        //     $fileName = Str::random(40) . '.' . $file->getClientOriginalExtension();
        //     $filePath = 'private/commercial_registration/' . $fileName;
        //     Storage::disk('local')->put($filePath, $contents);
        //     $user->commercial_registration_pdf = $fileName;
        // }

        // if ($request->hasFile('delivery_contract')) {
        //     $file = $request->file('delivery_contract');
        //     $contents = file_get_contents($file);
        //     $fileName = Str::random(40) . '.' . $file->getClientOriginalExtension();
        //     $filePath = 'private/delivery_contract/' . $fileName;
        //     Storage::disk('local')->put($filePath, $contents);
        //     $user->signed_contract_delivery_company = $fileName;
        // }

        $user->first_name = $validatedData['first_name'];
        $user->last_name = $validatedData['last_name'];
        // $user->restaurant_name = $validatedData['restaurant_name'];
        $user->phone = $validatedData['phone'];

        // if($user->signed_contract_delivery_company != null && $user->commercial_registration_pdf != null){
        //     $user->isApproved = 0;
        // }
        $user->save();



        return redirect()->back()->with('success', 'Profile updated successfully');
    }

    public function profile(){
        $user = Auth::user();

        return view('restaurant.profile', compact('user'));
    }

    public function workers($branchId){


        $branch = Branch::findOrFail($branchId);
        $user = Auth::user();
        // $workers = User::where('role', 2)->where('restaurant_name', $user->restaurant_name)->where('branch_id', $branchId)
        // ->paginate(15);
        $workers = $branch->workers()
        ->where('id','!=',$user->id)
        ->whereHas('roles', function ($query) {
            $query->where('name', 'Worker');
        })
        ->get();
        return view('restaurant.workers', compact('user', 'workers', 'branchId','branch'));
    }

    public function addWorker($branchId){

        $user = Auth::user();

        return view('restaurant.add-worker', compact('user', 'branchId'));
    }

    public function generateWorker(Request $request, $branchId)
    {

        $existingUser = RestaurantUser::where('email', $request['email'])->first();
        if ($existingUser) {
            if(app()->getLocale() === 'en')
                return redirect()->back()->with('error', 'Email is already registered.');
            else
                return redirect()->back()->with('error', 'عنوان البريد الإلكترونى هذا مسجل بالفعل');

        }

        $user = new RestaurantUser();
        $user->first_name = $request->first_name;
        $user->last_name = $request->last_name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->branch_id = $branchId;
        $user->phone = $request->phone;

        $user->save();
        $user->assignRole('Worker');
        $permissions = [
            'can_modify_and_see_other_workers',
            'can_modify_working_time',
            'can_modify_advertisements',
            'can_edit_menu',
            'can_control_payment'
        ];

        $insertData = [];

        foreach ($permissions as $permission) {
            $insertData[$permission] = $request->has($permission) ? 1 : 0;
        }

        $insertData['user_id'] = $user->id;

        DB::table('permissions_worker')->insert($insertData);

        if(app()->getLocale() === 'en')
            return redirect()->route("restaurant.workers",$branchId)->with('success', 'Worker added successfully');
        else
            return redirect()->back()->with('success', 'تمت إضافة موظف بنجاح');
    }

    public function deleteWorker($id){
        try {
            DB::beginTransaction();
            DB::table('permissions_worker')->where('user_id', $id)->delete();

            RestaurantUser::findOrFail($id)->delete();

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

    public function updateWorker(Request $request, $id){

        $selectedWorker = RestaurantUser::find($id);

        $selectedWorker->first_name = $request->input('first_name');
        $selectedWorker->last_name = $request->input('last_name');
        $selectedWorker->phone = $request->input('phone');
        $selectedWorker->email = $request->input('email');

        $permissions = [
            'can_modify_and_see_other_workers',
            'can_modify_working_time',
            'can_modify_advertisements',
            'can_edit_menu',
        ];

        $updateData = [];

        foreach ($permissions as $permission) {
            $updateData[$permission] = $request->has($permission) ? 1 : 0;
        }

        DB::table('permissions_worker')
            ->where('user_id', $id)
            ->update($updateData);

        $selectedWorker->save();

        $user = Auth::user();

        if(app()->getLocale() === 'en')
            return redirect()->back()->with([
                'success' => 'Worker updated successfully',
            ])->with(compact('user'));
        else
            return redirect()->back()->with([
                'success' => 'Work updated successfully',
            ])->with(compact('user'));
    }

    public function editWorker($id){

        $user = Auth::user();

        $worker = RestaurantUser::findOrFail($id);

        // if($worker->role != 2){
        //     return abort(404);
        // }
        return view('restaurant.edit-worker', compact('worker', 'user'));
    }
}
