@extends('layouts.restaurant-sidebar')

@section('title', __('edit-worker'))

@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Form-->
            <form action="{{ route('restaurant.update-worker', ['id' => $worker->id]) }}" method="POST">
                @csrf
                @method('PUT')

                <!--begin::Main column-->
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <!--begin::Tab content-->
                    <div class="tab-content">
                        <!--begin::Tab pane-->
                        <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                            <div class="d-flex flex-column gap-7 gap-lg-10">
                                <!--begin::General options-->
                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>{{ __('edit-worker')}}</h2>
                                        </div>
                                        <a href="{{ route('restaurant.workers', ['branchId' => App\Models\User::find($worker->id)->branch_id]) }}">
                                            <button type="button" class="btn btn-khardl btn-sm">
                                <i class="fa fa-arrow-left"></i>
                                {{ __('Back to list') }}
                            </button>
                                        </a>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->

                                    <div class="card-body pt-0">
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('first-name')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="first_name" class="form-control mb-2" required placeholder="{{ __('first-name')}}" value="{{ $worker->first_name }}" />
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">{{ __('first-name')}} {{ __('is-required')}}</div>
                                            <!--end::Description-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('last-name')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="last_name" class="form-control mb-2" required placeholder="{{ __('last-name')}}" value="{{ $worker->last_name }}" />
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">{{ __('last-name')}} {{ __('is-required')}}</div>
                                            <!--end::Description-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('email')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="email" name="email" class="form-control mb-2" required placeholder="{{ __('email')}}" value="{{ $worker->email }}" />
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">{{ __('email')}} {{ __('is-required')}}</div>
                                            <!--end::Description-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('change-password')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="password" @if(!$user?->hasPermissionWorker('can_modify_and_see_other_workers')) disabled @endif name="password" class="form-control mb-2" minlength="6" placeholder="Password" value="" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('phone-number')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="tel" pattern="[0-9+]{10,14}" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode === 43" minlength="10" maxlength="14" class="form-control @error('phone') is-invalid @enderror" value="{{ $worker->phone }}" name="phone" id="phone" placeholder="05XXXXXXXX" required>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->


                                        <!--begin::Permission-->
                                        <div style="margin-left: 0!important; padding-left: 0!important;" class="card mb-5 mb-xl-10 mx-0 px-0">
                                            <!--begin::Card header-->
                                            <div class="card-header border-0 cursor-pointer mx-0 px-0" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                                                <!--begin::Card title-->
                                                <div class="card-title m-0">
                                                    <h3 class="fw-bolder m-0">{{ __('permission')}}</h3>
                                                </div>
                                                <!--end::Card title-->
                                            </div>
                                            <!--begin::Card header-->
                                            <!--begin::Content-->
                                            <div id="kt_account_settings_profile_details" class="collapse show">
                                                <!--begin::Card body-->
                                                <div class="card-body border-top py-9 mx-0 px-0">
                                                    <!--begin::Input group-->
                                                    <div class="row mb-0 mt-5">
                                                        <!--begin::Label-->
                                                        <div class="form-check form-check-solid form-switch fv-row">
                                                            <input class="form-check-input w-35px h-20px" type="checkbox" id="can_edit_menu" value="1" @if (DB::table('permissions_worker')->where('user_id', $worker->id)->value('can_edit_menu') == 1) checked @endif name="can_edit_menu">
                                                            <label class="form-check-label" for="can_edit_menu">{{ __('Can access menu')}}</label>
                                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('Can add and edit category, add and edit products') }}"></i>
                                                        </div>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="row mb-0 mt-5">
                                                        <!--begin::Label-->
                                                        <div class="form-check form-check-solid form-switch fv-row">
                                                            <input class="form-check-input w-35px h-20px" type="checkbox" id="can_modify_and_see_other_workers" value="1" @if (DB::table('permissions_worker')->where('user_id', $worker->id)->value('can_modify_and_see_other_workers') == 1) checked @endif name="can_modify_and_see_other_workers">
                                                            <label class="form-check-label" for="can_modify_and_see_other_workers">{{ __('Can access workers')}}</label>
                                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('Can view and update the workers') }}"></i>
                                                        </div>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="row mb-0 mt-5">
                                                        <!--begin::Label-->
                                                        <div class="form-check form-check-solid form-switch fv-row">
                                                            <input class="form-check-input w-35px h-20px" type="checkbox" id="can_modify_working_time" @if (DB::table('permissions_worker')->where('user_id', $worker->id)->value('can_modify_working_time') == 1) checked @endif value="1" name="can_modify_working_time">
                                                            <label class="form-check-label" for="can_modify_working_time">{{ __('Can access working time')}}</label>
                                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('Can update the working time of the branch') }}"></i>
                                                        </div>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="row mb-0 mt-5">
                                                        <!--begin::Label-->
                                                        <div class="form-check form-check-solid form-switch fv-row">
                                                            <input class="form-check-input w-35px h-20px" type="checkbox" id="can_view_revenues" @if (DB::table('permissions_worker')->where('user_id', $worker->id)->value('can_view_revenues') == 1) checked @endif value="1" name="can_view_revenues">
                                                            <label class="form-check-label" for="can_view_revenues">{{ __('Can acccess revenuses')}}</label>
                                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('Can see the revenuses for every branch') }}"></i>
                                                        </div>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="row mb-0 mt-5">
                                                        <!--begin::Label-->
                                                        <div class="form-check form-check-solid form-switch fv-row">
                                                            <input class="form-check-input w-35px h-20px" type="checkbox" id="can_control_payment" @if (DB::table('permissions_worker')->where('user_id', $worker->id)->value('can_control_payment') == 1) checked @endif value="1" name="can_control_payment">
                                                            <label class="form-check-label" for="can_control_payment">{{ __('Can access payment')}}</label>
                                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('Can see the subscription of the restaurant the details of bank information') }}"></i>
                                                        </div>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="row mb-0 mt-5">
                                                        <!--begin::Label-->
                                                        <div class="form-check form-check-solid form-switch fv-row">
                                                            <input class="form-check-input w-35px h-20px" type="checkbox" id="can_edit_and_view_drivers" @if (DB::table('permissions_worker')->where('user_id', $worker->id)->value('can_edit_and_view_drivers') == 1) checked @endif value="1" name="can_edit_and_view_drivers">
                                                            <label class="form-check-label" for="can_edit_and_view_drivers">{{ __('Can access drivers')}}</label>
                                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('Can add and edit drivers') }}"></i>
                                                        </div>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="row mb-0 mt-5">
                                                        <!--begin::Label-->
                                                        <div class="form-check form-check-solid form-switch fv-row">
                                                            <input class="form-check-input w-35px h-20px" type="checkbox" id="can_mange_orders" @if (DB::table('permissions_worker')->where('user_id', $worker->id)->value('can_mange_orders') == 1) checked @endif value="1" name="can_mange_orders">
                                                            <label class="form-check-label" for="can_mange_orders">{{ __('Can access orders')}}</label>
                                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('Can view details of orders and update order status') }}"></i>
                                                        </div>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="row mb-0 mt-5">
                                                        <!--begin::Label-->
                                                        <div class="form-check form-check-solid form-switch fv-row">
                                                            <input class="form-check-input w-35px h-20px" type="checkbox" id="can_mange_table_reservations" @if (DB::table('permissions_worker')->where('user_id', $worker->id)->value('can_mange_table_reservations') == 1) checked @endif value="1" name="can_mange_table_reservations">
                                                            <label class="form-check-label" for="can_mange_table_reservations">{{ __('Can access table reservation orders')}}</label>
                                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('Can view details of orders and update order status') }}"></i>
                                                        </div>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="row mb-0 mt-5">
                                                        <!--begin::Label-->
                                                        <div class="form-check form-check-solid form-switch fv-row">
                                                            <input class="form-check-input w-35px h-20px" type="checkbox" id="can_access_summary" @if (DB::table('permissions_worker')->where('user_id', $worker->id)->value('can_access_summary') == 1) checked @endif value="1" name="can_access_summary">
                                                            <label class="form-check-label" for="can_access_summary">{{ __('Can access summary page')}}</label>
                                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('Can see the daily and monthly sales, can see best selling items') }}"></i>
                                                        </div>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="row mb-0 mt-5">
                                                        <!--begin::Label-->
                                                        <div class="form-check form-check-solid form-switch fv-row">
                                                            <input class="form-check-input w-35px h-20px" type="checkbox" id="can_access_site_editor" @if (DB::table('permissions_worker')->where('user_id', $worker->id)->value('can_access_site_editor') == 1) checked @endif value="1" name="can_access_site_editor">
                                                            <label class="form-check-label" for="can_access_site_editor">{{ __('Can access site editor')}}</label>
                                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('Can update the design and the style of the website') }}"></i>
                                                        </div>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="row mb-0 mt-5">
                                                        <!--begin::Label-->
                                                        <div class="form-check form-check-solid form-switch fv-row">
                                                            <input class="form-check-input w-35px h-20px" type="checkbox" id="can_access_coupons" @if (DB::table('permissions_worker')->where('user_id', $worker->id)->value('can_access_coupons') == 1) checked @endif value="1" name="can_access_coupons">
                                                            <label class="form-check-label" for="can_access_coupons">{{ __('Can access coupons')}}</label>
                                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('Can add, edit and delete coupons') }}"></i>
                                                        </div>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="row mb-0 mt-5">
                                                        <!--begin::Label-->
                                                        <div class="form-check form-check-solid form-switch fv-row">
                                                            <input class="form-check-input w-35px h-20px" type="checkbox" id="can_access_qr" @if (DB::table('permissions_worker')->where('user_id', $worker->id)->value('can_access_qr') == 1) checked @endif value="1" name="can_access_qr">
                                                            <label class="form-check-label" for="can_access_qr">{{ __('Can access QR codes')}}</label>
                                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('Can add, download QR codes') }}"></i>
                                                        </div>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="row mb-0 mt-5">
                                                        <!--begin::Label-->
                                                        <div class="form-check form-check-solid form-switch fv-row">
                                                            <input class="form-check-input w-35px h-20px" type="checkbox" id="can_access_service_page" @if (DB::table('permissions_worker')->where('user_id', $worker->id)->value('can_access_service_page') == 1) checked @endif value="1" name="can_access_service_page">
                                                            <label class="form-check-label" for="can_access_service_page">{{ __('Can access services page')}}</label>
                                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('Can add branch, deactivate branches, pay for branches and application') }}"></i>
                                                        </div>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="row mb-0 mt-5">
                                                        <!--begin::Label-->
                                                        <div class="form-check form-check-solid form-switch fv-row">
                                                            <input class="form-check-input w-35px h-20px" type="checkbox" id="can_access_delivery_companies" @if (DB::table('permissions_worker')->where('user_id', $worker->id)->value('can_access_delivery_companies') == 1) checked @endif value="1" name="can_access_delivery_companies">
                                                            <label class="form-check-label" for="can_access_delivery_companies">{{ __('Can access delivery companies')}}</label>
                                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('Can contract with delivery companies and deactivate the contraction with them') }}"></i>
                                                        </div>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="row mb-0 mt-5">
                                                        <!--begin::Label-->
                                                        <div class="form-check form-check-solid form-switch fv-row">
                                                            <input class="form-check-input w-35px h-20px" type="checkbox" id="can_access_customers_data" @if (DB::table('permissions_worker')->where('user_id', $worker->id)->value('can_access_customers_data') == 1) checked @endif value="1" name="can_access_customers_data">
                                                            <label class="form-check-label" for="can_access_customers_data">{{ __('Can access customers data')}}</label>
                                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __("Can edit and see customer's orders") }}"></i>
                                                        </div>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="row mb-0 mt-5">
                                                        <!--begin::Label-->
                                                        <div class="form-check form-check-solid form-switch fv-row">
                                                            <input class="form-check-input w-35px h-20px" type="checkbox" id="can_access_settings" @if (DB::table('permissions_worker')->where('user_id', $worker->id)->value('can_access_settings') == 1) checked @endif value="1" name="can_access_settings">
                                                            <label class="form-check-label" for="can_access_settings">{{ __('Can access settings')}}</label>
                                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __("Can update delivery fees and delivery options") }}"></i>
                                                        </div>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="row mb-0 mt-5">
                                                        <!--begin::Label-->
                                                        <div class="form-check form-check-solid form-switch fv-row">
                                                            <input class="form-check-input w-35px h-20px" type="checkbox" id="can_access_advertising_services" @if (DB::table('permissions_worker')->where('user_id', $worker->id)->value('can_access_advertising_services') == 1) checked @endif value="1" name="can_access_advertising_services">
                                                            <label class="form-check-label" for="can_access_advertising_services">{{ __('Can access advertising services')}}</label>
                                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __("Can request for advertisement service, can see old requests") }}"></i>
                                                        </div>
                                                        <!--end::Label-->
                                                    </div>
                                                </div>
                                                <!--end::Card body-->
                                            </div>
                                            <!--end::Content-->
                                        </div>
                                        <!--end::Permission-->


                                    </div>
                                    <!--end::Card header-->
                                </div>
                                <!--end::General options-->
                            </div>
                        </div>
                        <!--end::Tab pane-->
                        <div class="d-flex justify-content-end mt-3">
                            <!--begin::Button-->
                            <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-khardl">
                                <i class="bi bi-check2-square mx-1 text-black"></i>
                                <span class="indicator-label">{{ __('edit')}}</span>
                                <span class="indicator-progress">{{ __('please-wait')}}
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <!--end::Button-->
                        </div>
                    </div>
                    <!--end::Main column-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->
@endsection
