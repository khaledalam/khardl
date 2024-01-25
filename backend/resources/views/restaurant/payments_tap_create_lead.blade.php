@extends('layouts.restaurant-sidebar')

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
    <form id="kt_modal_new_target_form" class="form"  method="POST" enctype="multipart/form-data" action="{{route('tap.payments_submit_lead')}}">
        @csrf
        <div class="row">
            <div class="col-md-6">
                <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="entity_group">
                    <h2 class="bold">{{__("messages.Name")}}</h2>

                </label>
                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">{{__("messages.Name (English)")}}</span>

                    </label>
                    <!--end::Label-->
                    <input type="text" class="form-control" required placeholder="{{__('messages.Enter Business Name (EN)')}}" name="brand[name][en]" value="{{old('brand.name.en')}}" />
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="name_ar">
                        <span class="required"> {{__("messages.Name (Arabic)")}}</span>

                    </label>
                    <!--end::Label-->
                    <input type="text" class="form-control" placeholder="{{__('messages.Enter Business Name (AR)')}}" name="brand[name][ar]" id="name_ar" value="{{old('brand.name.ar')}}" />
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="name_ar">
                        <span> {{__("messages.Your website Channel")}}</span>

                    </label>
                    <!--end::Label-->
                    <input type="text" class="form-control" placeholder="{{__('messages.Facebook page, instagram, website')}}" name="brand[channel_services][address]" value="{{old('brand.channel_services.address')}}" />
                </div>
                <!--end::Input group-->


            </div>
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
                    <input type="text" class="form-control" required placeholder="{{__('messages.National ID')}}" name="user[identification][number]" value="{{old('user.identification.number')}}" />
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
                <input id="bank_account_swift_code" type="text" class="form-control" name="wallet[bank][name]" required value="{{old('wallet.bank.name')}}" /><br />
                <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="bank_account_iban">
                    <span class="">{{__('messages.Company Name')}}<span class="text-danger h4"> * </span></span>

                </label>
                <input id="bank_account_swift_code" type="text" class="form-control" name="wallet[bank][account][name]" required value="{{old('wallet.bank.account.name')}}" /><br />
                <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="bank_account_iban">
                    <span class="">{{__('messages.IBAN')}}<span class="text-danger h4"> * </span></span>

                </label>
                <input id="bank_account_iban" type="text" class="form-control" name="wallet[bank][account][iban]" required value="{{old('wallet.bank.account.iban')}}" /><br />
                <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="bank_account_iban">
                    <span class="">{{__('messages.Swift code')}}<span class="text-danger h4"> * </span></span>

                </label>
                <input id="bank_account_swift_code" type="text" class="form-control" name="wallet[bank][account][swift]" required value="{{old('wallet.bank.account.swift')}}" /><br />
                <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="bank_account_iban">
                    <span class="">{{__('messages.Account number')}}<span class="text-danger h4"> * </span></span>

                </label>
                <input id="bank_account_number" type="text" class="form-control" name="wallet[bank][account][number]" required required value="{{old('wallet.bank.account.number')}}" />



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
                    <input type="text" class="form-control" required name="entity[license][number]" value="{{old('entity.license.number')}}" />
                </div>
                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">{{__("messages.City")}}</span>

                    </label>
                    <!--end::Label-->
                    <input type="text" class="form-control" required name="entity[license][city]" value="{{old('entity.license.city')}}" />
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

            <hr class="mt-4">
            <br>
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
                        <input type="text" class="form-control" required placeholder="{{ __('messages.Mr') }}" name="user[name][title]" id="name_title" value="{{ old('user.name.title')  ?? 'Mr'}}" />
                    </div>

                    <!-- Name first input group -->
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!-- Label -->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="name_first">
                            <span class="required">{{ __("messages.First Name") }}</span>

                        </label>
                        <!-- Input -->
                        <input type="text" class="form-control" required placeholder="{{ __('messages.Enter First Name') }}" name="user[name][first]" id="name_first" value="{{ old('user.name.first')  }}" />
                    </div>

                    <!-- Name middle input group -->
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!-- Label -->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="name_middle">
                            <span class="required">{{ __("messages.Middle Name") }}</span>

                        </label>
                        <!-- Input -->
                        <input type="text" class="form-control" required placeholder="{{ __('messages.Enter Middle Name') }}" name="user[name][middle]" id="name_middle" value="{{ old('user.name.middle') }}" />
                    </div>

                    <!-- Name last input group -->
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!-- Label -->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="name_last">
                            <span class="required">{{ __("messages.Last Name") }}</span>

                        </label>
                        <!-- Input -->
                        <input type="text" class="form-control" required placeholder="{{ __('messages.Enter Last Name') }}" name="user[name][last]" id="name_last" value="{{ old('user.name.last')}}" />
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
                        <input type="text" class="form-control" required name="user[phone][number]" value="{{ old('user.phone.number') }}" />
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
                        <option value="HOME">{{__('messages.Home')}}</option>
                        <option value="WORK">{{__('messages.Work')}}</option>
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
                        <select id="countrySelect2" class="form-select" value="{{old('user.birth.country')}}"  placeholder="{{ __('messages.country') }}" name="user[birth][country]"></select>
                    </div>
                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">{{__("messages.City")}}</span>

                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control" required placeholder="{{ __('messages.City') }}" name="user[birth][city]" value="{{old('user.birth.city')}}" />
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
                    <input type="text" class="form-control" required name="user[address][city]" value="{{old('user.address.city')}}" />
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">{{__("messages.Zip Code")}}</span>

                    </label>
                    <!--end::Label-->
                    <input type="text" class="form-control" required name="user[address][zip_code]" value="{{old('user.address.zip_code')}}" />
                </div>
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">{{__("messages.Line 1")}}</span>

                    </label>
                    <!--end::Label-->
                    <input type="text" class="form-control" required name="user[address][line1]" value="{{old('user.address.line1')}}" />
                </div>
                <!--end::Input group-->
                <!--end::Input group-->
                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">{{__("messages.Type")}}</span>

                    </label>
                    <!--end::Label-->
                    <select class="form-select mb-2" data-placeholder="test" name="user[address][type]" >
                        <option value="HOME">{{__('messages.Home')}}</option>
                        <option value="WORK">{{__('messages.Work')}}</option>
                    </select>
                </div>
                <!--end::Input group-->
                <div class="d-flex flex-column mb-8 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">{{__("messages.Line 2")}}</span>

                    </label>
                    <!--end::Label-->
                    <input type="text" class="form-control" name="user[address][line2]" value="{{old('user.address.line2')}}" required/>
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

                    <input type="email" class="form-control" required placeholder="{{__('messages.Email')}}" name="user[email][address]" value="{{old('user.email.address')}}" />
                </div>
                <div class="d-flex flex-column mb-8 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                        <span class="required">{{__("messages.Type")}}</span>

                    </label>
                    <!--end::Label-->
                    <select class="form-select mb-2" data-placeholder="test" name="user[email][type]" value="{{old('user.email.type')}}" >
                        <option value="HOME">{{__('messages.Home')}}</option>
                        <option value="WORK">{{__('messages.Work')}}</option>
                    </select>
                </div>

                <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="entity_group">
                    <h2 class="bold">{{__("messages.Terms and conditions")}}</h2>

                </label>

                <div class="form-check" style="margin:10px 0px">
                    <input class="form-check-input" type="checkbox" id="flexCheckDefault"  checked value="1" name="brand[terms][general]">
                    <label class="form-check-label" for="flexCheckDefault">
                        {{__('messages.General approval')}}
                    </label>
                </div>
                <div class="form-check" style="margin:10px 0px">
                    <input class="form-check-input" type="checkbox" id="flexCheckChecked2" checked value="1" name="brand[terms][chargeback]">
                    <label class="form-check-label" for="flexCheckChecked2">
                        {{__('messages.Charge Back')}}
                    </label>
                </div>
                <div class="form-check" style="margin:10px 0px">
                    <input class="form-check-input" type="checkbox" id="flexCheckChecked3" checked value="1" name="brand[terms][refund]">
                    <label class="form-check-label" for="flexCheckChecked3">
                        {{__('messages.Refund')}}
                    </label>
                </div>
            </div>
        </div>


        <!--begin::Actions-->
        <div class="text-center">
            <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">Reset ↻</button>
            <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                <span class="indicator-label">{{__('messages.save-changes')}} ✔️</span>
                <span class="indicator-progress" id="waiting-item">{{__('messages.please-wait')}}
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
        </div>
        <!--end::Actions-->
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
                    if ('{{ old("entity.country") }}') {
                        if (country.alpha2_code == '{{ old("entity.country") }}') {
                            option.selected = true;
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

</script>

@push('scripts')
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>
@endpush
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css">
@endpush
@endsection
