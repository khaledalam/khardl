@extends('layouts.restaurant-sidebar')

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
        <form id="kt_modal_new_target_form" class="form" action="{{ route('tap.payments_submit_tap_documents', ['id' => 'test']) }}" method="POST" enctype="multipart/form-data">
        @csrf
            <!--begin::Input group-->
            <div class="d-flex flex-column mb-8 fv-row">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="name_en">
                    <span class="required">{{__("Enter Business Name (EN)")}}</span>

                </label>
                <!--end::Label-->
                <input type="text" class="form-control form-control-solid" required placeholder="{{__('Enter Business Name (EN)')}}" name="name[en]" id="name_en" value="{{old('name.en')  ?? $restaurant_name}}" />
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="d-flex flex-column mb-8 fv-row">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="name_ar">
                    <span >{{__("Enter Business Name (AR)")}}</span>

                </label>
                <!--end::Label-->
                <input type="text" class="form-control form-control-solid"  v placeholder="{{__('Enter Business Name (AR)')}}" name="name[ar]" id="name_ar"  value="{{old('name.ar') ?? $restaurant_name}}"/>
            </div>
            <!--end::Input group-->


            <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="entity_group">
                <h2 class="bold">{{__("Entity")}}</h2>
                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="{{__('The entity details of the business')}}"></i>
            </label>

            <div class="entity_group ">
                {{-- <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="tax_number">
                        <span class="">Tax Number</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="The business tax number."></i>
                    </label>
                    <!--end::Label-->
                    <input id="tax_number" type="text" class="form-control form-control-solid" placeholder="License Number e.g. 2134342SE" name="tax_number" />
                </div>
                <!--end::Input group--> --}}
                 <!--begin::Input group-->
            <div class="d-flex flex-column mb-8 fv-row">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="name_en">
                    <span class="required">{{__('Legal Name (English)')}}</span>

                </label>
                <!--end::Label-->
                <input type="text" class="form-control form-control-solid" required placeholder="{{__('Enter Legal Name (EN)')}}" name="entity[legal_name][en]" value="{{old('entity.legal_name.en')}}" id="name_en" />
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="d-flex flex-column mb-8 fv-row">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="name_ar">
                    <span >{{__('Legal Name (Arabic)')}}</span>

                </label>
                <!--end::Label-->
                <input type="text" class="form-control form-control-solid"  placeholder="{{__('Enter Legal Name (AR)')}}" name="entity[legal_name][ar]" value="{{old('entity.legal_name.ar')}}"  id="name_ar" />
            </div>
            <!--end::Input group-->
                <input type="hidden" name="type" value="ind">
                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="is_licensed">
                        <span class="required">{{__('Is Business Licensed')}}</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="{{__('Denote whether the business is licensed or not')}}"></i>
                    <!--end::Label-->
                        <input  type="hidden" name="entity[is_licensed]" value="{{false}}"   />
                        <input id="is_licensed" type="checkbox" class="mx-2" name="entity[is_licensed]"   {{old('entity.is_licensed')?'checked':''}} />
                    </label>
                </div>
                <!--end::Input group-->
{{--
                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row is_licensed_children">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="license_type">
                        <span class="">License Type</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Denote whether the business is licensed or not."></i>
                    </label>
                    <!--end::Label-->
                    <select name="license_type" id="license_type" class="form-select">
                        <option value="Commercial License">Commercial License</option>
                        <option value="Commercial Registration">Commercial Registration</option>
                    </select>
                </div>
                <!--end::Input group--> --}}
{{--
                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row is_licensed_children">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="license_number">
                        <span class="">License Number</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Denote whether the business is licensed or not."></i>
                    </label>
                    <!--end::Label-->
                    <input type="text" class="form-control form-control-solid" placeholder="License Number e.g. 2134342SE" name="license_number" id="license_number" />
                </div>
                <!--end::Input group--> --}}
{{--
                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="not_for_profit">
                        <span class="required">Not For Profit</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="The business is a non profit organization"></i>
                        <!--end::Label-->
                        <input id="not_for_profit" type="checkbox" class="mx-2" name="not_for_profit" checked/>
                    </label>
                </div>
                <!--end::Input group--> --}}

                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="countrySelect">
                        <span class="required">{{__('country')}}</span>

                    </label>
                    <!--end::Label-->
                    <select id="countrySelect" class="form-select" name="entity[country]"  ></select>
                </div>
                <!--end::Input group-->
{{--
                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="tax_number">
                        <span class="">Tax Number</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="The business tax number."></i>
                    </label>
                    <!--end::Label-->
                    <input id="tax_number" type="text" class="form-control form-control-solid" placeholder="License Number e.g. 2134342SE" name="tax_number" />
                </div>
                <!--end::Input group--> --}}

                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="bank_account_iban">
                        <span class="">{{__('Bank Account')}}<span class="text-danger h4"> * </span></span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="The official documents related to the business."></i>
                    </label>
                    <!--end::Label-->
                    <input id="bank_account_iban" type="text" class="form-control form-control-solid" placeholder="IBAN e.g. INBNK00045545555555555555" name="entity[bank_account][iban]" required  value="{{old('entity.bank_account.iban') ?? $iban}}"/><br />
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="bank_account_swift_code">
                        <span class="">{{__('Swift code')}}<span class="text-danger h4"> * </span></span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="The official documents related to the business."></i>
                    </label>
                    <input id="bank_account_swift_code" type="text" class="form-control form-control-solid" placeholder="{{ __('SWIFT code e.g. SWFT12345678909836435647') }}" name="entity[bank_account][swift_code]"  value="{{old('entity.bank_account.swift_code')}}" /><br />
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="bank_account_number">
                        <span class="">{{__('Account number')}}<span class="text-danger h4"> * </span></span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="The official documents related to the business."></i>
                    </label>
                    <input id="bank_account_number" type="text" class="form-control form-control-solid" placeholder="{{ __('Account Number e.g. DFGHGFVB876215bsdjhkn') }}" name="entity[bank_account][account_number]" value="{{old('entity.bank_account.account_number')}}" />
                </div>
                <!--end::Input group-->


                {{-- <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="billing_address">
                        <span class="">Billing Address</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="The billing address of the business."></i>
                    </label>
                    <!--end::Label-->
                    <input id="billing_address_recipient_name" type="text" class="form-control form-control-solid" placeholder="Recipient Name e.g. test" name="billing_address_recipient_name" /><br />
                    <input id="billing_address_address_1" type="text" class="form-control form-control-solid" placeholder="Address 1" name="billing_address_address_1" /><br />
                    <input id="billing_address_address_2" type="text" class="form-control form-control-solid" placeholder="Address 2" name="billing_address_address_2" /><br />
                    <input id="billing_address_po_box" type="text" class="form-control form-control-solid" placeholder="PO Box e.g. 0000" name="billing_address_po_box" /><br />
                    <input id="billing_address_district" type="text" class="form-control form-control-solid" placeholder="District e.g. Salmiya" name="billing_address_district" /><br />
                    <input id="billing_address_city" type="text" class="form-control form-control-solid" placeholder="City e.g. Hawally" name="billing_address_city" /><br />
                    <input id="billing_address_state" type="text" class="form-control form-control-solid" placeholder="State e.g. Kuwait" name="billing_address_state" /><br />
                    <input id="billing_address_zip_code" type="text" class="form-control form-control-solid" placeholder="Zip Code e.g. 30003" name="billing_address_zip_code" /><br />
                    <select id="billing_address_country" type="text" class="form-select form-control-solid" name="billing_address_country"></select>
                </div>
                <!--end::Input group--> --}}
            </div>

            <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="contact_person_group">
                <h2 class="bold">{{__('Contact Person')}}</h2>

            </label>

            <div id="contact_person_group">
                <!-- Name title input group -->
                <div class="d-flex flex-column mb-8 fv-row">
                    <!-- Label -->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="name_title">
                        <span class="required">{{ __("Title") }}</span>

                    </label>
                    <!-- Input -->
                    <input type="text" class="form-control form-control-solid" required placeholder="{{ __('Mr') }}" name="contact_person[name][title]" id="name_title" value="{{ old('contact_person.name.title')  ?? 'Mr'}}" />
                </div>

                <!-- Name first input group -->
                <div class="d-flex flex-column mb-8 fv-row">
                    <!-- Label -->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="name_first">
                        <span class="required">{{ __("First Name") }}</span>

                    </label>
                    <!-- Input -->
                    <input type="text" class="form-control form-control-solid" required placeholder="{{ __('Enter First Name') }}" name="contact_person[name][first]" id="name_first" value="{{ old('contact_person.name.first') ?? $user->first_name }}" />
                </div>

                <!-- Name middle input group -->
                <div class="d-flex flex-column mb-8 fv-row">
                    <!-- Label -->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="name_middle">
                        <span class="required">{{ __("Middle Name") }}</span>

                    </label>
                    <!-- Input -->
                    <input type="text" class="form-control form-control-solid" required placeholder="{{ __('Enter Middle Name') }}" name="contact_person[name][middle]" id="name_middle" value="{{ old('contact_person.name.middle') }}" />
                </div>

                <!-- Name last input group -->
                <div class="d-flex flex-column mb-8 fv-row">
                    <!-- Label -->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="name_last">
                        <span class="required">{{ __("Last Name") }}</span>

                    </label>
                    <!-- Input -->
                    <input type="text" class="form-control form-control-solid" required placeholder="{{ __('Enter Last Name') }}" name="contact_person[name][last]" id="name_last" value="{{ old('contact_person.name.last') ?? $user->last_name }}" />
                </div>
            </div>
            <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="contact_info_group">
                <h2 class="bold">{{__('Contact Info')}}</h2>

            </label>
            <div id="contact_info_group">
                <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="contact_person_primary_email">
                            <span class="required">{{__("email")}}</span>

                        </label>
                        <!--end::Label-->
                        <input type="email" class="form-control form-control-solid" required placeholder="{{__('Enter Your Email')}}" name="contact_person[contact_info][primary][email]" id="contact_person_primary_email" value="{{ old('contact_person.contact_info.primary.email') ?? $user->email }}" />
                    </div>
                    <!--end::Input group-->




                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="contact_person_primary_number">
                            <span class="required">{{__("Number")}}</span>

                        </label>
                        <!--end::Label-->
                        <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text border-left " style="border-radius: 0">
                                <input type="text"  readonly name="contact_person[contact_info][primary][phone][country_code]" id="countryCodeInput" value="{{old('contact_person.contact_info.primary.phone.country_code')}}" style="width: 40px;border:0;background-color:#f5f8fa">
                            </span>
                        </div>
                        <input type="text" class="form-control form-control-solid" required placeholder="{{__('Enter Your Number')}}" name="contact_person[contact_info][primary][phone][number]"  id="contact_person_primary_number" value="{{ old('contact_person.contact_info.primary.phone.number') ?? substr($user->phone,3)}}" />
                        </div>
                    </div>
                    <!--end::Input group-->
            </div>
            <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="contact_person_group">
                <h2 class="bold">{{__('Brand')}}</h2>

            </label>

            <div id="brands_group mx-5">
                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="name_en">
                            <span class="required">{{__("Brand Name (English)")}}</span>

                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid" required placeholder="{{__('Enter Brand Name (EN)')}}" name="brands[0][name][en]" id="name_en" value="{{old('brands.0.name.en') ?? $facility_name}}" />
                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="name_ar">
                            <span >{{__("Brand Name (Arabic)")}}</span>

                        </label>
                        <!--end::Label-->
                        <input type="text" class="form-control form-control-solid"  placeholder="{{__('Enter Brand Name (AR)')}}" name="brands[0][name][ar]" id="name_ar"  value="{{old('brands.0.name.ar') ?? $facility_name}}"/>
                    </div>
                    <!--end::Input group-->
            </div>


            <!--begin::Actions-->
            <div class="text-center">
                <a href="{{route('tap.payments_upload_tap_documents_get')}}" type="button" id="prev_step_btn" class="btn btn-warning me-3">{{ __('Back to step 1') }}</a>
                <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">{{ __('Reset ↻') }}</button>
                <button type="submit" id="kt_modal_new_target_submit" class="btn btn-khardl">
                    <span class="indicator-label">{{ __('Submit ✔️') }}</span>
                    <span class="indicator-progress" id="waiting-item">
                        {{ __('Please wait...') }}
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
                    let countryCodeInput = document.getElementById('countryCodeInput');
                    // let billingAddressCountry = document.getElementById('billing_address_country');
                    data.forEach((country) => {

                        let option = document.createElement('option');


                        option.value = country.alpha2_code;
                        option.text = (lang == 'en')?country.english_name:country.arabic_name;
                        option.setAttribute('data-phone-code', country.phone_code);
                        if('{{ old("entity.country") }}'){
                            if(country.alpha2_code =='{{ old("entity.country") }}') {
                                option.selected = true;
                                countryCodeInput.setAttribute('value',country.phone_code);

                            }
                        }else {
                            if(country.alpha2_code =='SA') {
                                option.selected = true;
                                countryCodeInput.setAttribute('value','966');
                            }
                        }


                        countrySelect.add(option);
                        // billingAddressCountry.add(option);
                    });
                })
                .catch(error => console.error('Error fetching country data:', error));

            document.getElementById('countrySelect').addEventListener('change', function(e) {
                e.preventDefault();
                //
                let countryCodeInput = document.getElementById('countryCodeInput');
                let selectedIndex = this.selectedIndex;
                let selectedOption = this.options[selectedIndex];
                countryCodeInput.setAttribute('value',selectedOption.getAttribute('data-phone-code'));

                //
                var selectedCountry = this.value;
            });
            document.getElementById('kt_modal_new_target_form').addEventListener('submit', function (e) {
                e.preventDefault();
                var submitButton = document.querySelector('#kt_modal_new_target_submit');
                submitButton.disabled = true;
                var waiting = document.querySelector('#waiting-item');
                waiting.style.display = 'block';
                document.getElementById('kt_modal_new_target_form').submit();
            });
            // document.getElementById('countrySelect').addEventListener('click', function(e) {
            //     e.preventDefault();

            //     var selectedCountry = this.value;
            //     console.log('Selected Country ISO2:', selectedCountry);
            // });



            // document.getElementById('is_licensed').addEventListener('change', function (is_licensed_event) {
            //     is_licensed_event.preventDefault();
            //     console.log("fdfsd")

            //     let is_licensed_children = document.getElementsByClassName('is_licensed_children');


            //     console.log("1111")


            //     for(let idx in is_licensed_children) {

            //         let is_licensed_child = is_licensed_children[idx];


            //         if (typeof is_licensed_child != 'object')continue;

            //         // show the children license related input fields
            //         if (is_licensed_event.target.checked) {
            //             is_licensed_child.classList.remove('d-none');
            //             is_licensed_child.classList.add('d-flex');
            //         }
            //         // hide the children license related input fields
            //         else {
            //             is_licensed_child.classList.add('d-none');
            //             is_licensed_child.classList.remove('d-flex');
            //         }

            //     }





            // });

        });

    </script>

@endsection
