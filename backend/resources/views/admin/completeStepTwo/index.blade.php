@extends('layouts.admin-sidebar')
@section('title', __('Complete step 2'))
@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Form-->
            <form action="{{ route('admin.complete-step-two.store',['user' => $user->id]) }}" method="POST" enctype="multipart/form-data" novalidate>
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
                                            <h2>{{ __('Complete step 2 manually')}}</h2>
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
                                            <label class="required form-label">{{ __('commercial_registration')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="file" class="form-control"  name="commercial_registration" accept=".pdf, .jpg, .jpeg, .png" required>
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">{{__("Accept")}}: PDF, JPG, JPEG, PNG {{__("size <= 25 MG")}}</div>
                                            <!--end::Description-->
                                            <!--end::Card body-->
                                        </div>
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('commercial-registration-number')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control"  name="commercial_registration_number" value="{{ old('commercial_registration_number') }}" required>
                                            <!--end::Input-->
                                            <!--end::Card body-->
                                        </div>
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="form-label">{{ __('tax_registration_certificate')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="file" class="form-control"  name="tax_registration_certificate" accept=".pdf, .jpg, .jpeg, .png">
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">{{__("Accept")}}: PDF, JPG, JPEG, PNG {{__("size <= 25 MG")}}</div>
                                            <!--end::Description-->
                                            <!--end::Card body-->
                                        </div>
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('identity_of_owner_or_manager')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="file" class="form-control"  name="bank_certificate" accept=".pdf, .jpg, .jpeg, .png" required>
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">{{__("Accept")}}: PDF, JPG, JPEG, PNG {{__("size <= 25 MG")}}</div>
                                            <!--end::Description-->
                                            <!--end::Card body-->
                                        </div>
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('Bank IBAN')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control"  name="IBAN" value="{{ old('IBAN') }}" required>
                                            <!--end::Input-->
                                            <!--end::Card body-->
                                        </div>
                                        <!--end::Content-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('facility-name')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control"  name="facility_name" value="{{ old('facility_name') }}" required>
                                            <!--end::Input-->
                                            <!--end::Card body-->
                                        </div>
                                        <!--end::Content-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('identity_of_owner_or_manager')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="file" class="form-control"  name="identity_of_owner_or_manager" accept=".pdf, .jpg, .jpeg, .png" required>
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">{{__("Accept")}}: PDF, JPG, JPEG, PNG {{__("size <= 25 MG")}}</div>
                                            <!--end::Description-->
                                            <!--end::Card body-->
                                        </div>
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('National ID')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control"  name="national_id_number" value="{{ old('national_id_number') }}" required>
                                            <!--end::Input-->
                                            <!--end::Card body-->
                                        </div>
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('Date of birth')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="date" class="form-control"  name="dob" value="{{ old('dob') }}" required>
                                            <!--end::Input-->
                                            <!--end::Card body-->
                                        </div>
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('National ID')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="file" class="form-control"  name="national_address" accept=".pdf, .jpg, .jpeg, .png" required>
                                            <!--end::Input-->
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
                            <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-khardl">
                                <span class="indicator-label">{{ __('Upload files') }}</span>
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
