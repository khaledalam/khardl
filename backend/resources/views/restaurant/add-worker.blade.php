@extends('layouts.restaurant-sidebar')

@section('title', __('messages.add-worker'))

@section('content')
<div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Form-->
            <form action="{{ route('restaurant.generate-worker', ['branchId' => $branchId]) }}" method="POST">
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
                                                <h2>{{ __('messages.add-worker')}}</h2>
                                            </div>
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->
                                        <div class="card-body pt-0">
                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">{{ __('messages.first-name')}}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" name="first_name" class="form-control mb-2" placeholder="{{ __('messages.first-name')}}" value="" />
                                                <!--end::Input-->
                                                <!--begin::Description-->
                                                <div class="text-muted fs-7">{{ __('messages.first-name')}} {{ __('messages.is-required')}}</div>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">{{ __('messages.last-name')}}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="text" name="last_name" class="form-control mb-2" placeholder="{{ __('messages.last-name')}}" value="" />
                                                <!--end::Input-->
                                                <!--begin::Description-->
                                                <div class="text-muted fs-7">{{ __('messages.last-name')}} {{ __('messages.is-required')}}</div>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">{{ __('messages.email')}}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="email" name="email" class="form-control mb-2" placeholder="{{ __('messages.email')}}" value="" />
                                                <!--end::Input-->
                                                <!--begin::Description-->
                                                <div class="text-muted fs-7">{{ __('messages.email')}}.</div>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">{{ __('messages.password')}}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="password" name="password" class="form-control mb-2" placeholder="{{ __('messages.password')}}" value="" />
                                                <!--end::Input-->
                                                <!--begin::Description-->
                                                <div class="text-muted fs-7">{{ __('messages.password')}} {{ __('messages.is-required')}}</div>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Input group-->

                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">{{ __('messages.phone-number')}}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="tel" pattern="[0-9+]{10,14}" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode === 43" minlength="10" maxlength="14" class="form-control @error('phone_number') is-invalid @enderror" value="{{ old('phone_number') }}" name="phone_number" id="phone_number" placeholder="05XXXXXXXX" required>
                                                <!--end::Input-->
                                                <!--begin::Description-->
                                                <div class="text-muted fs-7">{{ __('messages.phone-number')}} {{ __('messages.is-required')}}</div>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Input group-->


                                            <!--begin::Permission-->
                                            <div style="margin-left: 0!important; padding-left: 0!important;" class="card mb-5 mb-xl-10 mx-0 px-0">
                                                <!--begin::Card header-->
                                                <div class="card-header border-0 cursor-pointer mx-0 px-0" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
                                                    <!--begin::Card title-->
                                                    <div class="card-title m-0">
                                                        <h3 class="fw-bolder m-0">{{ __('messages.permission')}}</h3>
                                                    </div>
                                                    <!--end::Card title-->
                                                </div>
                                                <!--begin::Card header-->
                                                <!--begin::Content-->
                                                <div id="kt_account_settings_profile_details" class="collapse show mx-0 px-3">
                                                  <!--begin::Card body-->
                                                  <div class="card-body border-top py-9 mx-0 px-0">
                                                      <div class="row mb-0 mt-5">
                                                          <!--begin::Label-->
                                                          <div class="form-check form-check-solid form-switch fv-row">
                                                            <input class="form-check-input w-35px h-20px" type="checkbox" id="can_edit_menu" value="1"  name="can_edit_menu">
                                                              <label class="form-check-label" for="can_edit_menu">{{ __('messages.can-edit-the-menu')}}</label>
                                                          </div>
                                                          <!--end::Label-->
                                                      </div>
                                                      <!--end::Input group-->


{{--                                                      <!--begin::Input group-->--}}
{{--                                                      <div class="row mb-0 mt-5">--}}
{{--                                                          <!--begin::Label-->--}}
{{--                                                          <div class="form-check form-check-solid form-switch fv-row">--}}
{{--                                                            <input class="form-check-input w-35px h-20px" type="checkbox" id="can_modify_advertisements" value="1" name="can_modify_advertisements">--}}
{{--                                                              <label class="form-check-label" for="can_modify_advertisements">{{ __('messages.can-modify-advertisements')}}</label>--}}
{{--                                                          </div>--}}
{{--                                                          <!--end::Label-->--}}
{{--                                                      </div>--}}
{{--                                                      <!--end::Input group-->--}}

                                                      <!--begin::Input group-->
                                                      <div class="row mb-0 mt-5">
                                                          <!--begin::Label-->
                                                          <div class="form-check form-check-solid form-switch fv-row">
                                                            <input class="form-check-input w-35px h-20px" type="checkbox" id="can_modify_and_see_other_workers" value="1"  name="can_modify_and_see_other_workers">
                                                              <label class="form-check-label" for="can_modify_and_see_other_workers">{{ __('messages.can-modify-and-see-other-workers')}}</label>
                                                          </div>
                                                          <!--end::Label-->
                                                      </div>
                                                      <!--end::Input group-->

                                                      <!--begin::Input group-->
                                                      <div class="row mb-0 mt-5">
                                                          <!--begin::Label-->
                                                          <div class="form-check form-check-solid form-switch fv-row">
                                                            <input class="form-check-input w-35px h-20px" type="checkbox" id="can_modify_working_time" value="1" name="can_modify_working_time">
                                                              <label class="form-check-label" for="can_modify_working_time">{{ __('messages.can-modify-working-time')}}</label>
                                                          </div>
                                                          <!--end::Label-->
                                                      </div>
                                                      <!--end::Input group-->
                                                         <!--begin::Input group-->
                                                         <div class="row mb-0 mt-5">
                                                            <!--begin::Label-->
                                                            <div class="form-check form-check-solid form-switch fv-row">
                                                              <input class="form-check-input w-35px h-20px" type="checkbox" id="can-control-payment" value="1" name="can-control-payment">
                                                                <label class="form-check-label" for="can-control-payment">{{ __('messages.can-control-payment')}}</label>
                                                            </div>
                                                            <!--end::Label-->
                                                        </div>
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
                                <a href="{{ route('restaurant.workers', ['branchId' => $branchId]) }}"
                                    id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">{{ __('messages.cancel')}}</a>
                                <!--end::Button-->
                                <!--begin::Button-->
                                <button type="submit" id="kt_ecommerce_add_product_submit"
                                    class="btn btn-khardl">
                                    <span class="indicator-label">{{ __('messages.save-changes')}}</span>
                                    <span class="indicator-progress">{{ __('messages.please-wait') }}
                                        <span
                                            class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
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
