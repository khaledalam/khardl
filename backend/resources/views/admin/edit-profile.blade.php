@extends('layouts.admin-sidebar')


@section('title', __('messages.edit-profile'))

@section('content')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Form-->
                <form action="{{ route('admin.profile-update') }}" method="POST" enctype="multipart/form-data">
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
                                                <div class="card-title w-100 d-flex justify-content-between align-items-center">
                                                    <div>
                                                        <h2>{{ __('messages.edit-profile')}}</h2>
                                                    </div>
                                                    <div>
                                                        <button type="submit" style="border: 0;" class="badge badge-primary p-3"><i class="fas fa-save text-white"></i></button>
                                                    </div>
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
                                                    <input type="text" name="first_name" class="form-control mb-2" placeholder="{{ __('messages.first-name')}}" required value="{{ $user->first_name }}"/>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="mb-10 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="required form-label">{{ __('messages.last-name')}}</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" name="last_name" class="form-control mb-2" placeholder="{{ __('messages.last-name')}}" required value="{{ $user->last_name }}"/>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="mb-10 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="required form-label">{{ __('messages.phone-number')}}</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="tel" pattern="[0-9+]{10,14}" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode === 43" minlength="10" maxlength="14" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" name="phone" id="phone" placeholder="05XXXXXXXX" required>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="mb-10 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="required form-label">{{ __('messages.email')}}</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="email" name="email" class="form-control mb-2" placeholder="{{ __('messages.email')}}" required value="{{ $user->email }}"/>
                                                    <!--end::Input-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="mb-10 fv-row" data-kt-password-meter="true">
                                                    <!--begin::Wrapper-->
                                                    <div class="mb-1">
                                                        <!--begin::Label-->
                                                        <label class="form-label fw-bolder text-dark fs-6">{{ __('messages.password')}}</label>
                                                        <!--end::Label-->
                                                        <!--begin::Input wrapper-->
                                                        <div class="position-relative mb-3">
                                                            <input class="form-control form-control-lg form-control-solid" type="password" placeholder="*******" name="password" autocomplete="off" value="" />
                                                            <span class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2" data-kt-password-meter-control="visibility">
                                                                <i class="bi bi-eye-slash fs-2"></i>
                                                                <i class="bi bi-eye fs-2 d-none"></i>
                                                            </span>
                                                        </div>
                                                        <!--end::Input wrapper-->
                                                        <!--begin::Meter-->
                                                        <div class="d-flex align-items-center mb-3" data-kt-password-meter-control="highlight">
                                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2"></div>
                                                            <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                                        </div>
                                                        <!--end::Meter-->
                                                    </div>
                                                    <!--end::Wrapper-->
                                                    <!--begin::Hint-->
                                                    <div class="text-muted">{{ __('messages.leave-empty-if-you-dont-want-to-change-password') }} <br> {{ __('messages.use-8-or-more-characters-with-a-mix-of-letters-numbers-symbols') }}</div>
                                                    <!--end::Hint-->
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
                </form>
                <!--end::Form-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->
@endsection