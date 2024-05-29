@extends('layouts.admin-sidebar')
@section('title', __('Create restaurant'))
@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Form-->
            <form action="{{ route('admin.owner-information.store') }}" method="POST" enctype="multipart/form-data" id="form_step_2">
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
                                            <h2>{{ __('Create new restaurant')}}</h2>
                                        </div>
                                        <a href="{{ route('admin.restaurant-owner-management') }}">
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
                                            <label class="form-label">{{ __('first-name')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="first_name" class="form-control mb-2" placeholder="{{ __('first-name')}}" value="{{ old('first_name') }}" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="form-label">{{ __('last-name')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="last_name" class="form-control mb-2" placeholder="{{ __('last-name')}}" value="{{ old('last_name') }}" />
                                            <!--end::Input-->
                                        </div>
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('Restaurant name (English)')}}</label> <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('If your restaurant name is ABC the domain will be abc.khardl.com') }}"></i>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="restaurant_name" required class="form-control mb-2" placeholder="{{ __('Restaurant name (English)')}}" value="{{old('restaurant_name') }}" />
                                            <!--end::Input-->
                                        </div>
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="form-label">{{ __('Restaurant name (Arabic)')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="restaurant_name_ar" class="form-control mb-2" placeholder="{{ __('Restaurant name (English)')}}" value="{{old('restaurant_name_ar') }}" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="form-label">{{ __('email')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="email" name="email" class="form-control mb-2" placeholder="{{ __('email')}}" value="{{old('email') }} " />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class=" form-label">{{ __('password')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="password" id="change_password" name="password" class="form-control mb-2" minlength="8" placeholder="{{ __('password')}}" value="{{old('password')}}" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="form-label">{{ __('phone')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="tel" minlength="10" maxlength="14" class="form-control" name="phone" id="phone" placeholder="05XXXXXXXX" value="{{ old('phone') }}">
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="form-label">{{ __('position')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control" name="position" id="position" placeholder="{{ __('position') }}" value="{{ old('position') }}">
                                            <!--end::Input-->
                                        </div>
                                    </div>

                                    <hr>
                                    <div class="card-body pt-0">
                                        <div class="card-title">
                                            <h2>
                                                {{ __('Required files')}}
                                            </h2>
                                        </div>
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="form-label">{{ __('commercial_registration') }}</label>
                                            <!--end::Label-->

                                            <!--begin::Flex Container-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Input-->
                                                <input type="file" class="form-control" name="commercial_registration" accept=".pdf, .jpg, .jpeg, .png">
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Flex Container-->

                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">{{ __("Accept") }}: PDF, JPG, JPEG, PNG {{ __("size <= 25 MG") }}</div>
                                            <!--end::Description-->
                                        </div>

                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="form-label">{{ __('commercial-registration-number')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control" name="commercial_registration_number" value="{{ old('commercial_registration_number') }}">
                                            <!--end::Input-->
                                            <!--end::Card body-->
                                        </div>
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="form-label">{{ __('tax_registration_certificate')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Flex Container-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Input-->
                                                <input type="file" class="form-control" name="tax_registration_certificate" accept=".pdf, .jpg, .jpeg, .png">
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Flex Container-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">{{__("Accept")}}: PDF, JPG, JPEG, PNG {{__("size <= 25 MG")}}</div>
                                            <!--end::Description-->
                                            <!--end::Card body-->
                                        </div>
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="form-label">{{ __('bank-certificate')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Flex Container-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Input-->
                                                <input type="file" class="form-control" name="bank_certificate" accept=".pdf, .jpg, .jpeg, .png">
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Flex Container-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">{{__("Accept")}}: PDF, JPG, JPEG, PNG {{__("size <= 25 MG")}}</div>
                                            <!--end::Description-->
                                            <!--end::Card body-->
                                        </div>
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="form-label">{{ __('Bank IBAN')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control" name="IBAN" value="{{ old('IBAN') }}">
                                            <!--end::Input-->
                                            <!--end::Card body-->
                                        </div>
                                        <!--end::Content-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="form-label">{{ __('facility-name')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control" name="facility_name" value="{{ old('facility_name') }}">
                                            <!--end::Input-->
                                            <!--end::Card body-->
                                        </div>
                                        <!--end::Content-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="form-label">{{ __('identity_of_owner_or_manager')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Flex Container-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Input-->
                                                <input type="file" class="form-control" name="identity_of_owner_or_manager" accept=".pdf, .jpg, .jpeg, .png" >
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Flex Container-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">{{__("Accept")}}: PDF, JPG, JPEG, PNG {{__("size <= 25 MG")}}</div>
                                            <!--end::Description-->
                                            <!--end::Card body-->
                                        </div>
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="form-label">{{ __('National ID')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control" name="national_id_number" value="{{ old('national_id_number') }}">
                                            <!--end::Input-->
                                            <!--end::Card body-->
                                        </div>
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="form-label">{{ __('Date of birth')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="date" class="form-control" name="dob" value="{{ old('dob') }}">
                                            <!--end::Input-->
                                            <!--end::Card body-->
                                        </div>
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="form-label">{{ __('national_address')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Flex Container-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Input-->
                                                <input type="file" class="form-control" name="national_address" accept=".pdf, .jpg, .jpeg, .png">
                                                <!--end::Input-->
                                            </div>
                                            <!--end::Flex Container-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">{{__("Accept")}}: PDF, JPG, JPEG, PNG {{__("size <= 25 MG")}}</div>
                                            <!--end::Description-->
                                            <!--end::Card body-->
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                </div>
                                <!--end::General options-->
                            </div>
                        </div>
                        <!--end::Tab pane-->
                        <div class="d-flex justify-content-end mt-3">
                            <!--begin::Button-->
                            <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-active-light-khardl">
                                <span class="indicator-label">{{ __('Create') }}</span>
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
