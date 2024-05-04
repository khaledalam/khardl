<?php

namespace App\Http\Services\tenant\Worker;

use App\Models\Tenant\Branch;
use App\Traits\APIResponseTrait;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Tenant\RestaurantUser;
use App\Http\Requests\RegisterWorkerRequest;

class WorkerService
{
    use APIResponseTrait;
    public function workers($branchId)
    {
        /* TODO: make policy for workers */
        $user = Auth::user();
        if($user->isWorker() && $branchId != $user->branch_id){
            return abort(403);
        }
        $branch = Branch::findOrFail($branchId);

        $workers = $branch->workers()
//            ->where('id', '!=', $user->id)
            ->whereHas('roles', function ($query) {
                $query->where('name', 'Worker');
            })
            ->orderBy('id','desc')
            ->get();
        return view('restaurant.workers', compact('user', 'workers', 'branchId', 'branch'));
    }

    public function addWorker($branchId)
    {

        $user = Auth::user();

        return view('restaurant.add-worker', compact('user', 'branchId'));
    }

    public function generateWorker($request, $branchId)
    {

        $input = $request->validated();
        $input['password'] = Hash::make($input['password']);
        $input['phone_verified_at'] = null;
        $input['branch_id'] = $branchId;
        $user = RestaurantUser::create($input);

        $user->save();
        $user->assignRole('Worker');
        $permissions = [
            'can_modify_and_see_other_workers',
            'can_modify_working_time',
            'can_edit_menu',
            'can_control_payment',
            'can_view_revenues',
            'can_edit_and_view_drivers',
            'can_mange_orders',
            'can_access_summary',
            'can_access_site_editor',
            'can_access_coupons',
            'can_access_qr',
            'can_access_service_page',
            'can_access_delivery_companies',
            'can_access_customers_data',
            'can_access_settings',
        ];
        $insertData = [];

        foreach ($permissions as $permission) {
            $insertData[$permission] = $request->has($permission) ? 1 : 0;
        }

        $insertData['user_id'] = $user->id;

        DB::table('permissions_worker')->insert($insertData);

        return redirect()->route('restaurant.workers',['branchId' => $user->branch_id])->with([
            'success' => __('Added successfully'),
        ]);
    }

    public function deleteWorker($id)
    {
        try {
            DB::beginTransaction();
            DB::table('permissions_worker')->where('user_id', $id)->delete();

            $user = RestaurantUser::findOrFail($id);
            $branch = $user->branch_id;
            $user->delete();

            DB::commit();


            return redirect()->route('restaurant.workers',['branchId' => $branch])->with([
                'success' => __('Deleted successfully'),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();

            if (app()->getLocale() === 'en')
                return redirect()->back()->with('error', 'Error deleting user and related records: ' . $e->getMessage());
            else
                return redirect()->back()->with('error', 'خطأ في حذف المستخدم والسجلات ذات الصلة' . $e->getMessage());
        }
    }

    public function updateWorker($request, $id)
    {
        $selectedWorker = RestaurantUser::find($id);

        $user = Auth::user();
        if ($user?->id == $selectedWorker?->id) {
            return redirect()->back()->with('error', __('not allowed'));
        }

        $selectedWorker->first_name = $request->input('first_name');
        $selectedWorker->last_name = $request->input('last_name');
        $selectedWorker->phone = $request->input('phone');
        $selectedWorker->email = $request->input('email');

        if($request->has('password') && $user?->hasPermissionWorker('can_modify_and_see_other_workers')
            && $request->password && strlen($request->password) >= 6) {
            $selectedWorker->password = Hash::make($request->password);
        }

        $permissions = [
            'can_modify_and_see_other_workers',
            'can_modify_working_time',
            'can_edit_menu',
            'can_control_payment',
            'can_view_revenues',
            'can_edit_and_view_drivers',
            'can_mange_orders',
            'can_access_summary',
            'can_access_site_editor',
            'can_access_coupons',
            'can_access_qr',
            'can_access_service_page',
            'can_access_delivery_companies',
            'can_access_customers_data',
            'can_access_settings',
        ];

        $updateData = [];

        foreach ($permissions as $permission) {
            $updateData[$permission] = $request->has($permission) ? 1 : 0;
        }

        DB::table('permissions_worker')
            ->where('user_id', $id)
            ->update($updateData);

        $selectedWorker->save();
        return redirect()->route('restaurant.workers',['branchId' => $selectedWorker->branch_id])->with([
            'success' => __('Updated successfully'),
        ]);
    }

    public function editWorker($id)
    {
        $user = Auth::user();

        $worker = RestaurantUser::findOrFail($id);
        $user = Auth::user();
        if(($user->isWorker() && $worker->branch_id != $user->branch_id) || !$worker->isWorker()){
            return abort(403);
        }
        if ($user?->id == $worker?->id) {
            return redirect()->back()->with('error', __('not allowed'));
        }

        // if($worker->role != 2){
        //     return abort(404);
        // }
        return view('restaurant.edit-worker', compact('worker', 'user'));
    }
}
