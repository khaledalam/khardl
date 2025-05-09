@extends('layouts.admin-sidebar')
@section('title', __('add-support'))
@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Form-->
            <form action="{{ route('admin.generate-user') }}" method="POST">
                @csrf

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
                                            <h2>{{ __('add-support')}}</h2>
                                        </div>
                                        <a href="{{ route('admin.user-management') }}">
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
                                            <input type="text" name="first_name" class="form-control mb-2" required placeholder="{{ __('first-name')}}" value="{{old('first_name')}}" />
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
                                            <input type="text" name="last_name" class="form-control mb-2" required placeholder="{{ __('last-name')}}" value="{{old('last_name')}}" />
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
                                            <input type="email" name="email" class="form-control mb-2" required placeholder="{{ __('email')}}" value="{{old('email')}}" />
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">{{ __('email')}} {{ __('is-required')}}</div>
                                            <!--end::Description-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('password')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="password" name="password" class="form-control mb-2" required minlength="8" placeholder="{{ __('password')}}" value="{{old('password')}}" />
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">{{ __('password')}} {{ __('is-required')}}</div>
                                            <!--end::Description-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('phone')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="tel" pattern="[0-9+]{10,14}" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode === 43" minlength="10" maxlength="14" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" name="phone" id="phone" placeholder="05XXXXXXXX" required>
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">{{ __('phone')}} {{ __('is-required')}}</div>
                                            <!--end::Description-->
                                        </div>
                                        <!--end::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('position')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" required class="form-control @error('phone') is-invalid @enderror" value="{{ old('position') }}" name="position" id="position" placeholder="{{ __('position') }}">
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">{{ __('position')}} {{ __('is-required')}}</div>
                                            <!--end::Description-->
                                        </div>

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
                                            <div id="kt_account_settings_profile_details" class="collapse show mx-0 px-3">
                                                <!--begin::Card body-->
                                                <div class="card-body border-top py-9 mx-0 px-0">
                                                    <!--begin::Input group-->
                                                    <div class="row mb-0">
                                                        <!--begin::Label-->
                                                        <div class="form-check form-check-solid form-switch fv-row">
                                                            <input class="form-check-input w-35px h-20px" type="checkbox" id="can_access_dashboard" value="1" checked name="can_access_dashboard" disabled>
                                                            <label class="form-check-label" for="can_access_dashboard">{{ __('dashboard')}}<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('email-must-be-verified') }}"></i></label>
                                                        </div>
                                                        <!--end::Label-->
                                                    </div>
                                                    <!--end::Input group-->
                                                    <hr>
                                                    <!--begin::Input group-->
                                                    <div class="row mb-0 mt-5">
                                                        <!--begin::Label-->
                                                        <div class="form-check form-check-solid form-switch fv-row">
                                                            <input class="form-check-input w-35px h-20px" type="checkbox" id="can_access_restaurants" value="1" name="can_access_restaurants">
                                                            <label class="form-check-label" for="can_access_restaurants">{{ __('access-restaurants')}}<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('email-must-be-verified') }}"></i></label>
                                                        </div>
                                                        <!--end::Label-->
                                                    </div>
                                                    <!--end::Input group-->


                                                    <!--begin::Input group-->
                                                    <div class="row mb-0 mt-5">
                                                        <!--begin::Label-->
                                                        <div class="form-check form-check-solid form-switch fv-row">
                                                            <input class="form-check-input w-35px h-20px" type="checkbox" id="can_access_approved_restaurants" value="1" name="can_view_restaurants">
                                                            <label class="form-check-label" for="can_access_approved_restaurants">{{ __('view-restaurants')}}<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('view-restaurants-status') }}"></i></label>
                                                        </div>
                                                        <!--end::Label-->
                                                    </div>
                                                    <!--end::Input group-->

                                                    <!--begin::Input group-->
                                                    <div class="row mb-0 mt-5">
                                                        <!--begin::Label-->
                                                        <div class="form-check form-check-solid form-switch fv-row">
                                                            <input class="form-check-input w-35px h-20px" type="checkbox" id="can_access_pending_restaurants" value="1" name="can_delete_restaurants">
                                                            <label class="form-check-label" for="can_access_pending_restaurants">{{ __('delete-restaurants')}}<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('delete-restaurants-status') }}"></i></label>
                                                        </div>
                                                        <!--end::Label-->
                                                    </div>
                                                    <!--end::Input group-->

                                                    <!--begin::Input group-->
                                                    <div class="row mb-0 mt-5">
                                                        <!--begin::Label-->
                                                        <div class="form-check form-check-solid form-switch fv-row">
                                                            <input class="form-check-input w-35px h-20px" type="checkbox" id="can_access_denied_restaurants" value="1" name="can_approve_restaurants">
                                                            <label class="form-check-label" for="can_access_denied_restaurants">{{ __('approve-restaurants')}}<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('approve-restaurants-status') }}"></i></label>
                                                        </div>
                                                        <!--end::Label-->
                                                    </div>
                                                    <!--end::Input group-->

                                                    <hr>

                                                    <!--begin::Input group-->
                                                    <div class="row mb-0 mt-5">
                                                        <!--begin::Label-->
                                                        <div class="form-check form-check-solid form-switch fv-row">
                                                            <input class="form-check-input w-35px h-20px" type="checkbox" id="can_access_add_user" value="1" name="can_see_admins">
                                                            <label class="form-check-label" for="can_access_add_user">{{ __('see-admins')}}<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('see-admins-status') }}"></i></label>
                                                        </div>
                                                        <!--end::Label-->
                                                    </div>
                                                    <!--end::Input group-->

                                                    <!--begin::Input group-->
                                                    <div class="row mb-0 mt-5">
                                                        <!--begin::Label-->
                                                        <div class="form-check form-check-solid form-switch fv-row">
                                                            <input class="form-check-input w-35px h-20px" type="checkbox" id="can_access_user_management" value="1" name="can_add_admins">
                                                            <label class="form-check-label" for="can_access_user_management">{{ __('add-admins')}}<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('add-admins-status') }}"></i></label>
                                                        </div>
                                                        <!--end::Label-->
                                                    </div>
                                                    <!--end::Input group-->

                                                    <!--begin::Input group-->
                                                    <div class="row mb-0 mt-5">
                                                        <!--begin::Label-->
                                                        <div class="form-check form-check-solid form-switch fv-row">
                                                            <input class="form-check-input w-35px h-20px" type="checkbox" id="can_access_logs" value="1" name="can_edit_admins">
                                                            <label class="form-check-label" for="can_access_logs">{{ __('edit-admins')}}<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('edit-admins-status') }}"></i></label>
                                                        </div>
                                                        <!--end::Label-->
                                                    </div>
                                                    <!--end::Input group-->
                                                    <hr>

                                                    <!--begin::Input group-->
                                                    <div class="row mb-0 mt-5">
                                                        <!--begin::Label-->
                                                        <div class="form-check form-check-solid form-switch fv-row">
                                                            <input class="form-check-input w-35px h-20px" type="checkbox" id="can_see_restaurant_owners" value="1" name="can_see_restaurant_owners">
                                                            <label class="form-check-label" for="can_see_restaurant_owners">{{ __('see-restaurant-owners')}}<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('see-restaurant-owners') }}"></i></label>
                                                        </div>
                                                        <!--end::Label-->
                                                    </div>
                                                    <!--end::Input group-->

                                                    <!--end::Input group-->
                                                    <hr>

                                                    <!--begin::Input group-->
                                                    <div class="row mb-0 mt-5">
                                                        <!--begin::Label-->
                                                        <div class="form-check form-check-solid form-switch fv-row">
                                                            <input class="form-check-input w-35px h-20px" type="checkbox" id="can_access_coupons" name="can_promoters">
                                                            <label class="form-check-label" for="can_access_coupons">{{ __('access-promoters')}}<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('access-promoters-status') }}"></i></label>
                                                        </div>
                                                        <!--end::Label-->
                                                    </div>

                                                    <hr>

                                                    <div class="row mb-0 mt-5">
                                                        <!--begin::Label-->
                                                        <div class="form-check form-check-solid form-switch fv-row">
                                                            <input class="form-check-input w-35px h-20px" type="checkbox" id="can_access_coupons" name="can_see_logs">
                                                            <label class="form-check-label" for="can_access_coupons">{{ __('see-logs')}}<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('see-logs-status') }}"></i></label>
                                                        </div>
                                                        <!--end::Label-->
                                                    </div>

                                                    <div class="row mb-0 mt-5">
                                                        <!--begin::Label-->
                                                        <div class="form-check form-check-solid form-switch fv-row">
                                                            <input class="form-check-input w-35px h-20px" type="checkbox" id="can_access_coupons" name="can_edit_profile">
                                                            <label class="form-check-label" for="can_access_coupons">{{ __('edit-profile')}}<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('edit-profile-status') }}"></i></label>
                                                        </div>
                                                        <!--end::Label-->
                                                    </div>

                                                    <div class="row mb-0 mt-5">
                                                        <!--begin::Label-->
                                                        <div class="form-check form-check-solid form-switch fv-row">
                                                            <input class="form-check-input w-35px h-20px" type="checkbox" id="can_access_coupons" name="can_settings">
                                                            <label class="form-check-label" for="can_access_coupons">{{ __('edit-settings')}}<i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('edit-settings-status') }}"></i></label>
                                                        </div>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="row mb-0 mt-5">
                                                        <!--begin::Label-->
                                                        <div class="form-check form-check-solid form-switch fv-row">
                                                            <input class="form-check-input w-35px h-20px" type="checkbox" id="can_manage_notifications_receipt" name="can_manage_notifications_receipt">
                                                            <label class="form-check-label" for="can_manage_notifications_receipt">
                                                                {{ __('Ability to Manage purchase notifications')}}
                                                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('Manage purchase notifications') }}"></i>
                                                            </label>
                                                        </div>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="row mb-0 mt-5">
                                                        <!--begin::Label-->
                                                        <div class="form-check form-check-solid form-switch fv-row">
                                                            <input class="form-check-input w-35px h-20px" type="checkbox" id="can_access_back_doors" value="1" name="can_access_advertisements" {{old('can_access_advertisements') ? 'checked' : ''}}>
                                                            <label class="form-check-label" for="can_access_advertisements">{{ __('Can access advertising services')}}</label>
                                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __("Can request for advertisement service, can see old requests") }}"></i>
                                                        </div>
                                                        <!--end::Label-->
                                                    </div>
                                                    <div class="row mb-0 mt-5">
                                                        <!--begin::Label-->
                                                        <div class="form-check form-check-solid form-switch fv-row">
                                                            <input class="form-check-input w-35px h-20px" type="checkbox" id="can_access_back_doors" value="1" name="can_access_back_doors" {{old('can_access_back_doors') ? 'checked' : ''}}>
                                                            <label class="form-check-label" for="can_access_back_doors">{{ __('Can access back doors')}}</label>
                                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __("Can login as restaurant owner for all restaurants") }}"></i>
                                                        </div>
                                                        <!--end::Label-->
                                                    </div>
                                                    <!--end::Input group-->

                                                    <!--end::Input group-->
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
                                <span class="indicator-label">{{ __('add-support') }}</span>
                                <i class="bi bi-check2-square mx-1"></i>
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
