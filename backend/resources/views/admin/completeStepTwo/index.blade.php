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
            <form action="{{ route('admin.complete-step-two.store',['user' => $user->id]) }}" method="POST" enctype="multipart/form-data" novalidate id="form_step_2">
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
                                        <div class="card-title">
                                            <h2>{{ __('Restaurant owner information')}}</h2>
                                        </div>
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('first-name')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="first_name" class="form-control mb-2" required placeholder="{{ __('first-name')}}" value="{{old('first_name') ?? $user->first_name}}" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('last-name')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="last_name" class="form-control mb-2" required placeholder="{{ __('last-name')}}" value="{{old('last_name') ?? $user->last_name}}" />
                                            <!--end::Input-->
                                        </div>
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('Restaurant name (English)')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="restaurant_name" class="form-control mb-2" required placeholder="{{ __('Restaurant name (English)')}}" value="{{old('restaurant_name') ?? $user->restaurant_name}}" />
                                            <!--end::Input-->
                                        </div>
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('Restaurant name (Arabic)')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="restaurant_name_ar" class="form-control mb-2" required placeholder="{{ __('Restaurant name (English)')}}" value="{{old('restaurant_name_ar') ?? $user->restaurant_name_ar}}" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('email')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="email" name="email" class="form-control mb-2" required placeholder="{{ __('email')}}" value="{{old('email')?? $user->email}} " />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class=" form-label">{{ __('password')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="password" name="password" class="form-control mb-2" minlength="8" placeholder="{{ __('password')}}" value="{{old('password')}}" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('phone')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="tel" pattern="[0-9+]{10,14}" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode === 43" minlength="10" maxlength="14" class="form-control" name="phone" id="phone" placeholder="05XXXXXXXX" required value="{{ old('phone') ?? $user->phone }}">
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('position')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" required class="form-control" name="position" id="position" placeholder="{{ __('position') }}" value="{{ old('position') ?? $user->position }}">
                                            <!--end::Input-->
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="card-body pt-0">
                                        <div class="card-title">
                                            <h2>{{ __('Required files')}}</h2>
                                        </div>
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('commercial_registration')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="file" class="form-control" name="commercial_registration" accept=".pdf, .jpg, .jpeg, .png" required>
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
                                            <input type="text" class="form-control" name="commercial_registration_number" value="{{ old('commercial_registration_number') }}" required>
                                            <!--end::Input-->
                                            <!--end::Card body-->
                                        </div>
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="form-label">{{ __('tax_registration_certificate')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="file" class="form-control" name="tax_registration_certificate" accept=".pdf, .jpg, .jpeg, .png">
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
                                            <input type="file" class="form-control" name="bank_certificate" accept=".pdf, .jpg, .jpeg, .png" required>
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
                                            <input type="text" class="form-control" name="IBAN" value="{{ old('IBAN') }}" required>
                                            <!--end::Input-->
                                            <!--end::Card body-->
                                        </div>
                                        <!--end::Content-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('facility-name')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" class="form-control" name="facility_name" value="{{ old('facility_name') }}" required>
                                            <!--end::Input-->
                                            <!--end::Card body-->
                                        </div>
                                        <!--end::Content-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('identity_of_owner_or_manager')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="file" class="form-control" name="identity_of_owner_or_manager" accept=".pdf, .jpg, .jpeg, .png" required>
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
                                            <input type="text" class="form-control" name="national_id_number" value="{{ old('national_id_number') }}" required>
                                            <!--end::Input-->
                                            <!--end::Card body-->
                                        </div>
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('Date of birth')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="date" class="form-control" name="dob" value="{{ old('dob') }}" required>
                                            <!--end::Input-->
                                            <!--end::Card body-->
                                        </div>
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('National ID')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="file" class="form-control" name="national_address" accept=".pdf, .jpg, .jpeg, .png" required>
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
                            <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-active-light-khardl">
                                <span class="indicator-label">{{ __('Upload files') }}</span>
                                <i class="bi bi-check2-square mx-1"></i>
                                <span class="indicator-progress">{{ __('please-wait')}}
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <button type="submit" class="mx-2 btn btn-khardl" id="upload_with_active">
                                <span class="indicator-label">{{ __('Upload with restaurant activation') }}</span>
                                <i class="bi bi-check2-square mx-1"></i>
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
@section('js')
<script>
    document.getElementById('upload_with_active').addEventListener('click', function() {
        console.log(1);
        event.preventDefault();
        var newInput = document.createElement('input');
        newInput.type = 'hidden';
        newInput.name = 'active';
        newInput.value = 'true';
        // Append the new input to the form
        var form = document.getElementById('form_step_2');
        form.appendChild(newInput);
        form.submit(); // Submit the form
    });

</script>

@endsection
@endsection
