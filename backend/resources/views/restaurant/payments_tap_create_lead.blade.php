@extends('layouts.restaurant-sidebar')

@section('title', __('messages.payments'))
@section('content')
<h3 class="mb-13 mx-3">{{__('messages.STEP 2 → Submit Create TAP Business Account')}}</h3>
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
        <ul class="nav nav-tabs fs-5" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">{{__('messages.Business Details')}}</button>
            </li>
            <li class="nav-item fs-5" role="presentation">
              <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">{{__('messages.Personal Information')}}</button>
            </li>
            <li class="nav-item fs-5" role="presentation">
              <button class="nav-link" id="bank-tab" data-bs-toggle="tab" data-bs-target="#bank" type="button" role="tab" aria-controls="contact" aria-selected="false">{{__("messages.Bank Details")}}</button>
            </li>
          </ul>
          <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                <div class="row  m-4">
                    <div class="col-md-6">
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="entity_group">
                            <h2 class="bold">{{__("messages.Name")}}</h2>

                        </label>
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">{{__("messages.Entity name (English)")}}</span>

                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control" placeholder="{{__('messages.Enter Business Name (EN)')}}" name="brand[name][en]" value="{{old('brand.name.en') ?? $restaurant_name}}" />
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="name_ar">
                                <span class="required"> {{__("messages.Entity Name (Arabic)")}}</span>

                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control" placeholder="{{__('messages.Enter Business Name (AR)')}}" name="brand[name][ar]" id="name_ar" value="{{old('brand.name.ar') ?? $restaurant_name}}" />
                        </div>
                        <!--end::Input group-->



                    </div>
                    <div class="col-md-6">
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="entity_group">
                            <h2 class="bold">{{__("messages.Legal Entity (Commercial Registration)")}}</h2>

                        </label>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">{{__("messages.Number")}}</span>

                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control" name="entity[license][number]" value="{{old('entity.license.number')}}" />
                        </div>
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">{{__("messages.City")}}</span>

                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control" name="entity[license][city]" value="{{old('entity.license.city')}}" />
                        </div>
                        <!--end::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="is_licensed">
                                <span class="required">{{__('messages.Is Entity Licensed')}}</span>
                                <!--end::Label-->
                                <input type="hidden" name="entity[is_licensed]" value="{{false}}" />
                                <input id="is_licensed" type="checkbox" class="mx-2" name="entity[is_licensed]" {{old('entity.is_licensed')?'checked':''}} />
                            </label>
                        </div>


                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                <div class="row   m-4">
                    <div class="col-md-6">


                        <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="contact_person_group">
                            <h2 class="bold">{{__('messages.Contact Person')}}</h2>

                        </label>

                        <div id="contact_person_group">
                            <!-- Name title input group -->
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!-- Label -->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="name_title">
                                    <span class="required">{{ __("messages.Title") }}</span>

                                </label>
                                <!-- Input -->
                                <select name="user[name][title]" id="user_title" class="form-select">
                                    <option value="Mr" {{ old('user.name.title') == 'Mr'? 'selected' :'' }}>{{ __('messages.Mr') }}</option>
                                    <option value="Mrs" {{ old('user.name.title') == 'Mrs'? 'selected' :'' }}>{{ __('messages.Mrs') }}</option>
                                    <option value="Dr" {{ old('user.name.title') == 'Dr'? 'selected' :'' }}>{{ __('messages.Dr') }}</option>
                                    <option value="Prof" {{ old('user.name.title') == 'ProfMr'? 'selected' :'' }}>{{ __('messages.Prof') }}</option>
                                </select>
                            </div>

                            <!-- Name first input group -->
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!-- Label -->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="name_first">
                                    <span class="required">{{ __("messages.First Name") }}</span>

                                </label>
                                <!-- Input -->
                                <input type="text" class="form-control" placeholder="{{ __('messages.Enter First Name') }}" name="user[name][first]" id="name_first" value="{{ old('user.name.first') ?? $user->first_name }}" />
                            </div>

                            <!-- Name middle input group -->
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!-- Label -->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="name_middle">
                                    <span class="required">{{ __("messages.Middle Name") }}</span>

                                </label>
                                <!-- Input -->
                                <input type="text" class="form-control" placeholder="{{ __('messages.Enter Middle Name') }}" name="user[name][middle]" id="name_middle" value="{{ old('user.name.middle') }}" />
                            </div>

                            <!-- Name last input group -->
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!-- Label -->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="name_last">
                                    <span class="required">{{ __("messages.Last Name") }}</span>

                                </label>
                                <!-- Input -->
                                <input type="text" class="form-control" placeholder="{{ __('messages.Enter Last Name') }}" name="user[name][last]" id="name_last" value="{{ old('user.name.last')  ?? $user->last_name }}" />
                            </div>
                        </div>
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">{{__("messages.Phone Number")}}</span>

                            </label>
                            <!--end::Label-->

                            <div class="input-group mb-3">
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
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">{{__("messages.Type")}}</span>

                            </label>
                            <!--end::Label-->
                            <select class="form-select mb-2" data-placeholder="test" name="user[phone][type]">
                                <option value="HOME" {{old('user.phone.0.type') == 'HOME'? 'selected' :''}}>{{__('messages.Home')}}</option>
                                <option value="WORK"  {{old('user.phone.0.type') == 'WORK'? 'selected' :''}}>{{__('messages.Work')}}</option>
                            </select>
                        </div>

                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="entity_group">
                                <h2 class="bold">{{__("messages.Birthday")}}</h2>

                            </label>

                            <!--end::Label-->
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="countrySelect">
                                    <span class="required">{{__('messages.country')}}</span>

                                </label>
                                <!--end::Label-->
                                <select id="countrySelect2" class="form-select"  placeholder="{{ __('messages.country') }}" name="user[birth][country]"></select>
                            </div>
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">{{__("messages.City")}}</span>

                                </label>
                                <!--end::Label-->
                                <input type="text" class="form-control" placeholder="{{ __('messages.City') }}" name="user[birth][city]" value="{{old('user.birth.city')}}" />
                            </div>
                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">{{__("messages.Date of birth")}}</span>

                                </label>
                                <!--end::Label-->
                                <input type="date" name="user[birth][date]" class="form-control mb-2" value="{{ old('user.birth.date') }}" />
                            </div>


                        </div>





                    </div>
                    <div class="col-md-6">
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="entity_group">
                            <h2 class="bold">{{__("messages.Address")}}</h2>

                        </label>
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">{{__("messages.City")}}</span>

                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control" name="user[address][city]" value="{{old('user.address.0.city')}}" />
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">{{__("messages.Zip Code")}}</span>

                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control" name="user[address][zip_code]" value="{{old('user.address.0.zip_code')}}" />
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">{{__("messages.Line 1")}}</span>

                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control" name="user[address][line1]" value="{{old('user.address.0.line1')}}" />
                        </div>
                        <!--end::Input group-->
                        <!--end::Input group-->
                        <!--begin::Input group-->
                     {{--    <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">{{__("messages.Type")}}</span>

                            </label>
                            <!--end::Label-->
                            <select class="form-select mb-2" data-placeholder="test" name="user[address][type]" >
                                <option value="HOME">{{__('messages.Home')}}</option>
                                <option value="WORK">{{__('messages.Work')}}</option>
                            </select>
                        </div> --}}
                        <!--end::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">{{__("messages.Line 2")}}</span>

                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control" name="user[address][line2]" value="{{old('user.address.0.line2')}}" />
                        </div>
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="entity_group">
                            <h2 class="bold">{{__("messages.Email Information")}}</h2>

                        </label>

                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">{{__("messages.email")}}</span>

                            </label>
                            <!--end::Label-->

                            <input type="email" class="form-control" placeholder="{{__('messages.Email')}}" name="user[email][address]" value="{{old('user.email.0.address') ?? $user->email}}" />
                        </div>
                {{--         <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">{{__("messages.Type")}}</span>

                            </label>
                            <!--end::Label-->
                            <select class="form-select mb-2" data-placeholder="test" name="user[email][type]">
                                <option value="HOME" {{old('user.phone.type') == 'HOME'? 'selected' :''}}>{{__('messages.Home')}}</option>
                                <option value="WORK"  {{old('user.phone.type') == 'WORK'? 'selected' :''}}>{{__('messages.Work')}}</option>
                            </select>
                        </div> --}}


                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="bank" role="tabpanel" aria-labelledby="bank-tab">
                <div class="row  m-4">
                    <div class="col-md-6">
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="entity_group">
                            <h2 class="bold">{{__("messages.Your estimated sales (Monthly)")}}</h2>

                        </label>

                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="name_ar">
                                <span class="required">{{__("messages.Range")}}</span>

                            </label>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="brand[operations][sales][range][from]" placeholder="{{__('messages.From')}}" value="{{old('brand.operations.sales.range.from')}}">
                                        <div class="input-group-append">
                                            <span class="input-group-text" style="opacity:0.8;border-bottom-left-radius:0;border-top-left-radius:0">{{__('messages.SAR')}}</span>

                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="input-group">
                                        <input type="number" class="form-control" name="brand[operations][sales][range][to]" placeholder="{{__('messages.To')}}" value="{{old('brand.operations.sales.range.to')}}">
                                        <div class="input-group-append">
                                            <span class="input-group-text " style="opacity:0.8;border-bottom-left-radius:0;border-top-left-radius:0">{{__('messages.SAR')}}</span>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="entity_group">
                            <h2 class="bold">{{__("messages.Your Identification")}}</h2>

                        </label>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="countrySelect">
                                <span class="required">{{__('messages.Nationality')}}</span>

                            </label>
                            <!--end::Label-->
                            <select id="countrySelect" class="form-select" name="user[nationality]"></select>
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">{{__("messages.National ID")}}</span>
                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control" placeholder="{{__('messages.National ID')}}" name="user[identification][number]" value="{{old('user.identification.number')}}" />
                        </div>
                        <!--end::Input group-->


                    </div>



                    <div class="col-md-6">
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="entity_group">
                            <h2 class="bold">{{__("messages.Bank Details")}}</h2>

                        </label>
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="bank_account_iban">
                            <span class="">{{__('messages.Bank Name')}}<span class="text-danger h4"> * </span></span>

                        </label>
                        <input id="bank_account_swift_code" type="text" class="form-control" name="wallet[bank][name]" value="{{old('wallet.bank.name')}}" /><br />
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="bank_account_iban">
                            <span class="">{{__('messages.Company Name')}}<span class="text-danger h4"> * </span></span>

                        </label>
                        <input id="bank_account_swift_code" type="text" class="form-control" name="wallet[bank][account][name]" value="{{old('wallet.bank.account.name') ?? $facility_name}}" /><br />
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="bank_account_iban">
                            <span class="">{{__('messages.IBAN')}}<span class="text-danger h4"> * </span></span>

                        </label>
                        <input id="bank_account_iban" type="text" class="form-control" name="wallet[bank][account][iban]" value="{{old('wallet.bank.account.iban') ?? $iban}}" /><br />
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="bank_account_iban">
                            <span class="">{{__('messages.Swift code')}}<span class="text-danger h4"> * </span></span>

                        </label>
                        <input id="bank_account_swift_code" type="text" class="form-control" name="wallet[bank][account][swift]" value="{{old('wallet.bank.account.swift')}}" /><br />
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="bank_account_iban">
                            <span class="">{{__('messages.Account number')}}<span class="text-danger h4"> * </span></span>

                        </label>
                        <input id="bank_account_number" type="text" class="form-control" name="wallet[bank][account][number]" value="{{old('wallet.bank.account.number')}}" />



                    </div>
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="entity_group">
                        <h2 class="bold">{{__("messages.Terms and conditions")}}</h2>

                    </label>

                    <div class="form-check" style="margin:10px 0px">
                        <input class="form-check-input" type="checkbox" id="flexCheckDefault"  checked value="1">
                        <label class="form-check-label" for="flexCheckDefault">
                            {{__('messages.General approval')}}
                        </label>
                    </div>
                    <div class="form-check" style="margin:10px 0px">
                        <input class="form-check-input" type="checkbox" id="flexCheckChecked2" checked value="1">
                        <label class="form-check-label" for="flexCheckChecked2">
                            {{__('messages.Charge Back')}}
                        </label>
                    </div>
                    <div class="form-check" style="margin:10px 0px">
                        <input class="form-check-input" type="checkbox" id="flexCheckChecked3" checked value="1">
                        <label class="form-check-label" for="flexCheckChecked3">
                            {{__('messages.Refund')}}
                        </label>
                    </div>
                </div>

                <!--begin::Actions-->
                <div class="text-center m-5">
                    <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary" id="kt_modal_new_target_next_step1">
                        <span class="indicator-label">{{ __('messages.Submit ✔️') }}</span>

                        <span class="indicator-progress" id="waiting-item">{{__('messages.please-wait')}}
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
        fetch(`https://raw.githubusercontent.com/amrsaeedhosny/countries/master/countries.json`)
            .then(response => response.json())
            .then(data => {
                // Populate the select element with options
                let countrySelect = document.getElementById('countrySelect');
                let countrySelect2 = document.getElementById('countrySelect2');
                data.forEach((country) => {

                    let option = document.createElement('option');
                    let option2 = document.createElement('option');

                    option.value = country.alpha2_code;
                    option.text = (lang == 'en') ? country.english_name : country.arabic_name;

                    option2.value = country.alpha2_code;
                    option2.text = (lang == 'en') ? country.english_name : country.arabic_name;
                    if ('{{ old("user.birth.country") }}' || '{{ old("user.nationality") }}') {
                        if (country.alpha2_code == '{{ old("user.nationality") }}') {
                            option.selected = true;
                        }
                        if (country.alpha2_code == '{{ old("user.birth.country") }}') {
                            option2.selected = true;
                        }
                    } else {
                        if (country.alpha2_code == 'SA') {
                            option.selected = true;
                            option2.selected = true;
                        }
                    }

                    countrySelect.add(option);
                    countrySelect2.add(option2);
                });
            })
            .catch(error => console.error('Error fetching country data:', error));


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
        if (!areCheckboxesChecked()) {
            alert(`{{__('messages.Please check all terms and conditions before submitting.')}}`);
            return ;
        }
        Swal.fire({
            title: '{{ __('messages.are-you-sure') }}',
            text: "{{ __('messages.you-wont-be-able-to-undo-this') }}",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#009ef7',
            cancelButtonColor: '#3085d6',
            confirmButtonText: '{{ __('messages.submit') }}',
            cancelButtonText: '{{ __('messages.cancel') }}'
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
    function areCheckboxesChecked() {
        var checkbox1 = document.getElementById('flexCheckDefault');
        var checkbox2 = document.getElementById('flexCheckChecked2');
        var checkbox3 = document.getElementById('flexCheckChecked3');

        return checkbox1.checked && checkbox2.checked && checkbox3.checked;
    }
</script>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>
@endpush
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css">
@endpush
@endsection
