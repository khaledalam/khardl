@extends('layouts.admin-sidebar')


@section('title',  __('profile'))

@section('content')
  <!--begin::Content-->
  <div class="content d-flex flex-column flex-column-fluid pt-0   " id="kt_content">
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Form-->
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
                          @if($user?->hasPermission('can_edit_profile'))
                          <div class="card-header">
                            <div class="card-title w-100 d-flex justify-content-between align-items-center">
                              <div>
                                  <h2>{{ __('profile')}}</h2>
                              </div>
                              <div>
                                  <a href="{{ route('admin.edit-profile') }}" class="badge badge-primary p-3"><i class="fas fa-edit text-white"></i></a>
                              </div>
                            </div>
                          </div>
                          @endif
                          <!--end::Card header-->
                          <!--begin::Card body-->
                          <div class="card-body pt-0">
                            <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                              <!--begin::Label-->
                              <label class="required form-label">{{ __('first-name')}}</label>
                              <!--end::Label-->
                              <!--begin::Input-->
                              <input type="text" name="first_name" class="form-control mb-2" placeholder="{{ __('first-name')}}" value="{{ $user->first_name }}" disabled/>
                              <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                                                          <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                              <!--begin::Label-->
                              <label class="required form-label">{{ __('last-name')}}</label>
                              <!--end::Label-->
                              <!--begin::Input-->
                              <input type="text" name="last_name" class="form-control mb-2" placeholder="{{ __('last-name')}}" value="{{ $user->last_name }}" disabled/>
                              <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                                                          <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                              <!--begin::Label-->
                              <label class="required form-label">{{ __('phone-number')}}</label>
                              <!--end::Label-->
                              <!--begin::Input-->
                              <input type="text" name="phone" class="form-control mb-2" placeholder="{{ __('phone-number')}}" value="{{ $user->phone }}" disabled/>
                              <!--end::Input-->
                            </div>
                            <!--end::Input group-->
                                                          <!--begin::Input group-->
                            <div class="mb-10 fv-row">
                              <!--begin::Label-->
                              <label class="required form-label">{{ __('email')}}</label>
                              <!--end::Label-->
                              <!--begin::Input-->
                              <input type="text" name="email" class="form-control mb-2" placeholder="{{ __('email')}}" value="{{ $user->email }}" disabled/>
                              <!--end::Input-->
                            </div>
                            <!--end::Input group-->

                                                          <!--begin::Input group-->
                                                          <div class="mb-10 fv-row" data-kt-password-meter="true">
                                                              <!--begin::Wrapper-->
                                                              <div class="mb-1">
                                                                  <!--begin::Label-->
                                                                  <label class="form-label fw-bolder text-dark fs-6">{{ __('password')}}</label>
                                                                  <!--end::Label-->
                                                                  <!--begin::Input wrapper-->
                                                                  <div class="position-relative mb-3">
                                                                      <input class="form-control form-control-lg form-control-solid" minlength="8" type="password" placeholder="" name="password" autocomplete="off" value="********" disabled />
                                                                      {{-- <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                                                          <i class="bi bi-eye-slash fs-2"></i>
                                                                          <i class="bi bi-eye fs-2 d-none"></i>
                                                                      </span> --}}
                                                                  </div>
                                                                  <!--end::Input wrapper-->

                                                              </div>
                                                              <!--end::Wrapper-->
                                                          </div>
                                                          <!--end::Input group=-->

                          </div>
                          <!--end::Card header-->
                        </div>
                        <!--end::General options-->
                      </div>
                    </div>
      <!--end::Tab pane-->
                    </div>

                </div>
                <!--end::Main column-->
            <!--end::Form-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->
@endsection
