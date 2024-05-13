@extends('layouts.restaurant-sidebar')

@section('title', __('payments'))
@section('content')
<h3 class="mb-13 mx-3">{{__('STEP 2 → Submit Create TAP Business Account')}}</h3>
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

<!--begin::Content-->
<div class="container content d-flex flex-column flex-column-fluid pt-0" id="kt_content">
    <!--begin::Post-->
    <form id="kt_modal_new_target_form" class="form card"  method="POST" enctype="multipart/form-data" action="{{route('tap.payments_submit_lead')}}">
        @csrf

        <ul class="nav nav-tabs fs-5" id="myTab" role="tablist" style="border-radius: 10%" >
            <li class="nav-item fs-5" role="presentation">
                <button class="nav-link active" id="profile-tab" style="font-family: system-ui;font-size: 19px;"  data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">{{__('1')}}. {{__('Personal Information')}}</button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link " id="home-tab" style="font-family: system-ui;font-size: 19px;" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">{{__('2')}}. {{__('Restaurant Information')}}</button>
            </li>

            <li class="nav-item fs-5" role="presentation">
              <button class="nav-link" id="bank-tab" style="font-family: system-ui;font-size: 19px;"  data-bs-toggle="tab" data-bs-target="#bank" type="button" role="tab" aria-controls="contact" aria-selected="false">{{__('3')}}. {{__("Bank Details")}}</button>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent" style="background-color: aliceblue" >
            <div class="tab-pane fade  " id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="row m-4">
                    <div class="col-md-12">

                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">{{__("Restaurant name (English)")}}</span>

                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control" placeholder="{{__('Enter Business Name (EN)')}}" name="brand[name][en]" value="{{old('brand.name.en') ?? $restaurant_name}}" />
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="name_ar">
                                <span class="required"> {{__("Restaurant name (Arabic)")}}</span>

                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control" placeholder="{{__('Enter Business Name (AR)')}}" name="brand[name][ar]" id="name_ar" value="{{old('brand.name.ar') ?? $restaurant_name}}" />
                        </div>
                        <!--end::Input group-->

                        <div class="d-flex flex-column mb-8 fv-row">
                            <label clas s="d-flex align-items-center fs-6 fw-bold mb-2" for="is_licensed">
                                <input id="is_licensed" type="checkbox" class="mx-2" name="entity[is_licensed]" {{old('entity.is_licensed')?'checked':''}} />

                                <span class="required">{{__('Is Entity Licensed')}}</span>
                                <!--end::Label-->

                            </label>
                        </div>

                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">{{__('Restaurant Logo')}}</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" ></i>
                            </label>
                            <!--end::Label-->
                            <input type="file" class="form-control form-control-solid" required  name="brand[logo]" placeholder="Enter Target Title"  />
                        </div>

                        <div id="entity"  style="display: none;">

                            <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="entity_group">
                                <h2 class="bold">{{__("Legal Entity (Commercial Registration)")}}</h2>

                            </label>
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">{{__("Number")}}</span>

                                </label>
                                <!--end::Label-->
                                <input type="text" class="form-control" name="entity[license][number]" value="{{old('entity.license.number')}}" />
                            </div>
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">{{__("Number of Memorandum of Association")}}</span>

                                </label>
                                <!--end::Label-->
                                <input type="text" class="form-control" name="entity[license][documents][0][number]" value="{{old('entity.license.documents.0.number')}}" />
                            </div>
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">{{__("Issuing date")}}</span>

                                </label>
                                <!--end::Label-->
                                <input type="date" name="entity[license][documents][0][issuing_date]" class="form-control mb-2" value="{{ old('entity.license.documents.0.issuing_date') }}" />
                            </div>
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">{{__("Expiry date")}}</span>

                                </label>
                                <!--end::Label-->
                                <input type="date" name="entity[license][documents][0][expiry_date]" class="form-control mb-2" value="{{ old('entity.license.documents.0.expiry_date') }}" />
                            </div>

                        </div>

                    </div>
                </div>
            </div>
            <div class="tab-pane fade show active" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="row   m-4">
                    <div class="col-md-12">


                        <div id="contact_person_group">
                            <!-- Name title input group -->
{{--                            <div class="d-flex flex-column mb-8 fv-row">--}}
{{--                                <!-- Label -->--}}
{{--                                <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="name_title">--}}
{{--                                    <span class="required">{{ __("Title") }}</span>--}}

{{--                                </label>--}}
{{--                                <!-- Input -->--}}
{{--                                <select name="user[name][title]" id="user_title" class="form-select">--}}
{{--                                    <option value="Mr" {{ old('user.name.title') == 'Mr'? 'selected' :'' }}>{{ __('Mr') }}</option>--}}
{{--                                    <option value="Mrs" {{ old('user.name.title') == 'Mrs'? 'selected' :'' }}>{{ __('Mrs') }}</option>--}}
{{--                                    <option value="Dr" {{ old('user.name.title') == 'Dr'? 'selected' :'' }}>{{ __('Dr') }}</option>--}}
{{--                                    <option value="Prof" {{ old('user.name.title') == 'ProfMr'? 'selected' :'' }}>{{ __('Prof') }}</option>--}}
{{--                                </select>--}}
{{--                            </div>--}}

                            <!-- Name first input group -->
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!-- Label -->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="name_first">
                                    <span class="required">{{ __("First Name") }}</span>

                                </label>
                                <!-- Input -->
                                <input type="text" class="form-control" placeholder="{{ __('Enter First Name') }}" name="user[name][first]" id="name_first" value="{{ old('user.name.first') ?? $user->first_name }}" />
                            </div>


                            <!-- Name last input group -->
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!-- Label -->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="name_last">
                                    <span class="required">{{ __("Last Name") }}</span>

                                </label>
                                <!-- Input -->
                                <input type="text" class="form-control" placeholder="{{ __('Enter Last Name') }}" name="user[name][last]" id="name_last" value="{{ old('user.name.last')  ?? $user->last_name }}" />
                            </div>
                        </div>


                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">{{__("Phone Number")}}</span>

                            </label>
                            <!--end::Label-->

                            <div class="input-group">
                                <div class="input-group-prepend">
                                <span class="input-group-text border-left " style="border-radius: 0">
                                    <input type="text" readonly  style="width: 40px;border:0;background-color:#f5f8fa" value="966">
                                </span>
                                </div>
                                <input type="text" class="form-control" name="user[phone][number]" value="{{ old('user.phone.0.number')  ?? substr($user->phone,3)}}" />
                            </div>
                        </div>

                        <!--end::Input group-->
                        <!--begin::Input group-->
                    {{--                    <div class="d-flex flex-column mb-8 fv-row">--}}
                    {{--                        <!--begin::Label-->--}}
                    {{--                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">--}}
                    {{--                            <span class="required">{{__("This Number used In")}}</span>--}}

                    {{--                        </label>--}}
                    {{--                        <!--end::Label-->--}}
                    {{--                        <select class="form-select mb-2" data-placeholder="test" name="user[phone][type]">--}}
                    {{--                            <option value="HOME" {{old('user.phone.0.type') == 'HOME'? 'selected' :''}}>{{__('Home')}}</option>--}}
                    {{--                            <option value="WORK"  {{old('user.phone.0.type') == 'WORK'? 'selected' :''}}>{{__('Work')}}</option>--}}
                    {{--                        </select>--}}
                    {{--                    </div>--}}

                    <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">{{__("email")}}</span>

                            </label>
                            <!--end::Label-->

                            <input type="email" class="form-control" placeholder="{{__('Email')}}" name="user[email][address]" value="{{old('user.email.0.address') ?? $user->email}}" />
                        </div>

                        {{--                        <div class="d-flex flex-column mb-8 fv-row">--}}
                        {{--                            <!--begin::Label-->--}}
                        {{--                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">--}}
                        {{--                                <span class="required">{{__("This Email used In")}}</span>--}}

                        {{--                            </label>--}}
                        {{--                            <!--end::Label-->--}}
                        {{--                            <select class="form-select mb-2" data-placeholder="test" name="user[email][type]" >--}}
                        {{--                                <option value="HOME" {{old('user.email.type') == 'HOME'? 'selected' :''}}>{{__('Home')}}</option>--}}
                        {{--                                <option value="WORK"  {{old('user.email.type') == 'WORK'? 'selected' :''}}>{{__('Work')}}</option>--}}
                        {{--                            </select>--}}
                        {{--                        </div>--}}
                        {{--         <div class="d-flex flex-column mb-8 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">{{__("Type")}}</span>

                                    </label>
                                    <!--end::Label-->
                                    <select class="form-select mb-2" data-placeholder="test" name="user[email][type]">
                                        <option value="HOME" {{old('user.phone.type') == 'HOME'? 'selected' :''}}>{{__('Home')}}</option>
                                        <option value="WORK"  {{old('user.phone.type') == 'WORK'? 'selected' :''}}>{{__('Work')}}</option>
                                    </select>
                                </div> --}}


                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="bank" role="tabpanel" aria-labelledby="bank-tab">
                <div class="row  m-4">


                    <div class="col-md-12">

                        <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="bank_account_swift_code">
                            <span class="">{{__('Company Name')}}<span class="text-danger h4"> * </span></span>
                        </label>
                        <input id="bank_account_swift_code" type="text" class="form-control" name="wallet[bank][account][name]" value="{{old('wallet.bank.account.name') ?? $facility_name}}" /><br />

                        <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="bank_account_iban">
                            <span class="">{{__('Account number')}}<span class="text-danger h4"> * </span></span>
                        </label>
                        <input id="bank_account_number" type="text" class="form-control" name="wallet[bank][account][number]" value="{{old('wallet.bank.account.number')}}" /><br/>

                        <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="bank_account_swift_code">
                            <span class="">{{__('Bank Name')}}<span class="text-danger h4"> * </span></span>
                        </label>
                        <input id="bank_account_swift_code" type="text" class="form-control" name="wallet[bank][name]" value="{{old('wallet.bank.name')}}" /><br />

                        {{--                        <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="bank_account_iban">--}}
{{--                            <span class="">{{__('IBAN')}}<span class="text-danger h4"> * </span></span>--}}
{{--                        </label>--}}
{{--                        <input id="bank_account_iban" type="text" class="form-control" name="wallet[bank][account][iban]" value="{{old('wallet.bank.account.iban') ?? $iban}}" /><br />--}}



                        <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="entity_group">
                            <h2 class="bold">{{__("Bank Statement")}}</h2>

                        </label>


                        <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="bank_account_iban">
                            <span class="">{{__('Bank Statement Number')}}<span class="text-danger h4"> * </span></span>

                        </label>
                        <input id="bank_account_number" type="text" class="form-control" name="wallet[bank][documents][0][number]" value="{{old('wallet.bank.account.number')}}" />
                       <br>

                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">{{__('Bank Statement File')}}</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"></i>
                            </label>
                            <!--end::Label-->
                            <input type="file" class="form-control form-control-solid" required  name="wallet[bank][documents][0][images][]"   />
                        </div>

                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">{{__("Issuing date")}}</span>

                            </label>
                            <!--end::Label-->
                            <input type="date" name="wallet[bank][documents][0][issuing_date]" class="form-control mb-2" value="{{ old('entity.license.documents.0.issuing_date') }}" />
                        </div>



                    </div>

                </div>

                <!--begin::Actions-->
                <div class="text-center m-5">
                    <button type="submit" id="kt_modal_new_target_submit" class="btn btn-khardl" id="kt_modal_new_target_next_step1">
                        <span class="indicator-label">{{ __('Submit ✔️') }}</span>

                        <span class="indicator-progress" id="waiting-item">{{__('please-wait')}}
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>
            </div>
          </div>


    </form>
    <!--end::Post-->
</div>
<!--end::Content-->

<script>
    document.addEventListener('DOMContentLoaded', function(e) {
        e.preventDefault();
        let lang = '{{app()->getLocale()}}'


        document.getElementById('kt_modal_new_target_form').addEventListener('submit', function(e) {
            e.preventDefault();
            var submitButton = document.querySelector('#kt_modal_new_target_submit');
            submitButton.disabled = true;
            var waiting = document.querySelector('#waiting-item');
            waiting.style.display = 'block';
            document.getElementById('kt_modal_new_target_form').submit();
        });

    });
    document.getElementById('kt_modal_new_target_submit').addEventListener('click', function(event) {
        event.preventDefault();
        {{--if (!areCheckboxesChecked()) {--}}
        {{--    alert(`{{__('Please check all terms and conditions before submitting.')}}`);--}}
        {{--    return ;--}}
        {{--}--}}
        Swal.fire({
            title: '{{ __('are-you-sure') }}',
            text: "{{ __('you-wont-be-able-to-undo-this') }}",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#009ef7',
            cancelButtonColor: '#3085d6',
            confirmButtonText: '{{ __('submit') }}',
            cancelButtonText: '{{ __('cancel') }}'
        }).then((result) => {
            if (result.isConfirmed) {
                const submitButton = document.getElementById('kt_modal_new_target_submit');
                submitButton.setAttribute('disabled', 'disabled');
                    // Show the loading indicator
                document.getElementById('waiting-item').style.display = 'inline-block';
                document.getElementById('kt_modal_new_target_form').submit();
            }
        });
    });

    // function areCheckboxesChecked() {
    //     var checkbox1 = document.getElementById('flexCheckDefault');
    //     var checkbox2 = document.getElementById('flexCheckChecked2');
    //     var checkbox3 = document.getElementById('flexCheckChecked3');
    //
    //     return checkbox1.checked && checkbox2.checked && checkbox3.checked;
    // }

    function toggleEntityVisibility() {
        var entitySection = document.getElementById('entity');
        var isLicensedCheckbox = document.getElementById('is_licensed');

        if (isLicensedCheckbox.checked) {
            entitySection.style.display = 'block'; // Show entity section if checkbox is checked
        } else {
            entitySection.style.display = 'none'; // Hide entity section if checkbox is not checked
        }
    }

    // Attach event listener to is_licensed checkbox to toggle visibility of entity section
    document.getElementById('is_licensed').addEventListener('change', toggleEntityVisibility);

    // Initial call to toggleEntityVisibility to set initial visibility based on checkbox state
    toggleEntityVisibility();
</script>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>
@endpush
@push('styles')
<style>
   .nav-tabs .nav-item.show .nav-link, .nav-tabs .nav-link.active {
        background: aliceblue !important;
    }
</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css">
@endpush
@endsection
