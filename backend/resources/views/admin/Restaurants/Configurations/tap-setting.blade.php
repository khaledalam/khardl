 <!--begin::details View-->
 <div class="card mt-5 mb-xl-10" id="kt_profile_details_view">
    <!--begin::Card header-->
    @if($setting->lead_id)
    <div class="container">
        <div class="d-flex justify-content-center mt-5">
            <h2 class="badge badge-primary text-center w-20">{{__('The payment gateway is linked to the restaurant')}}</h2> 

        </div>


    </div>
    @else
    
    <!--begin::Content-->
    <div class="container content d-flex flex-column flex-column-fluid pt-0" id="kt_content">
        <!--begin::Post-->
        <form id="kt_modal_new_target_form" class="form card"  method="POST" enctype="multipart/form-data" action="{{route('tap.payments_submit_lead')}}">
            @csrf

            <ul class="nav nav-tabs fs-5" id="myTab" role="tablist" style="border-radius: 10%" >
                <li class="nav-item fs-5" role="presentation">
                    <button class="nav-link active" id="profile-tab" style="font-family: system-ui;font-size: 19px;"  data-bs-toggle="tab" data-bs-target="#profile" type="button" role="tab" aria-controls="profile" aria-selected="false">1. {{__('Personal Information')}}<span class="text-danger">*</span></button>
                </li>
                <li class="nav-item" role="presentation">
                <button class="nav-link " id="home-tab" style="font-family: system-ui;font-size: 19px;" data-bs-toggle="tab" data-bs-target="#home" type="button" role="tab" aria-controls="home" aria-selected="true">2. {{__('Restaurant Information')}}<span class="text-danger">*</span></button>
                </li>

                <li class="nav-item fs-5" role="presentation">
                <button class="nav-link" id="bank-tab" style="font-family: system-ui;font-size: 19px;"  data-bs-toggle="tab" data-bs-target="#bank" type="button" role="tab" aria-controls="contact" aria-selected="false">3. {{__("Bank Details")}}<span class="text-danger">*</span></button>
                </li>
                <li class="nav-item fs-5" role="presentation">
                    <button class="nav-link" id="tax-tab" style="font-family: system-ui;font-size: 19px;"  data-bs-toggle="tab" data-bs-target="#tax" type="button" role="tab" aria-controls="tax" aria-selected="false">4. {{__("Tax Document")}}</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
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

                                <!-- Name first input group -->
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <!-- Label -->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="name_first">
                                        <span class="required">{{ __("First Name") }}</span>

                                    </label>
                                    <!-- Input -->
                                    <input type="text" class="form-control" placeholder="{{ __('Enter First Name') }}" name="user[name][first]" id="name_first" value="{{ old('user.name.first') ?? $RO->first_name }}" />
                                </div>


                                <!-- Name last input group -->
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <!-- Label -->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="name_last">
                                        <span class="required">{{ __("Last Name") }}</span>

                                    </label>
                                    <!-- Input -->
                                    <input type="text" class="form-control" placeholder="{{ __('Enter Last Name') }}" name="user[name][last]" id="name_last" value="{{ old('user.name.last')  ?? $RO->last_name }}" />
                                </div>
                            </div>
      
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="countrySelect">
                                    <span class="required">{{__('Nationality')}}</span>
    
                                </label>
                                <!--end::Label-->
                                <select id="countrySelect" class="form-select" name="user[nationality]"></select>
                            </div>
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">{{__("National ID")}}</span>
                                </label>
                                <!--end::Label-->
                                <input type="text" class="form-control" placeholder="{{__('National ID')}}" name="user[identification][number]" value="{{old('user.identification.number')}}" />
                            </div>
                            <!--end::Input group-->

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
                                    <input type="text" class="form-control" name="user[phone][number]" value="{{ old('user.phone.0.number')  ?? substr($RO->phone,3)}}" />
                                </div>
                            </div>

                        <!--begin::Input group-->
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">{{__("email")}}</span>

                                </label>
                                <!--end::Label-->

                                <input type="email" class="form-control" placeholder="{{__('Email')}}" name="user[email][address]" value="{{old('user.email.0.address') ?? $RO->email}}" />
                            </div>


                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="bank" role="tabpanel" aria-labelledby="bank-tab">
                    <div class="row  m-4">


                        <div class="col-md-12">
                          
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="bank_account_swift_code">
                                <span class="">{{__('Company Name')}}<span class="text-danger h4"> * </span></span>
                            </label>
                            <input id="bank_account_swift_code" type="text" class="form-control" name="wallet[bank][account][name]" value="{{old('wallet.bank.account.name') ?? $traderRegistrationRequirement->facility_name}}" /><br />

                            <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="bank_account_iban">
                                <span class="">{{__('Account number')}}<span class="text-danger h4"> * </span></span>
                            </label>
                            <input id="bank_account_number" type="text" class="form-control" name="wallet[bank][account][iban]" value="{{old('wallet.bank.account.iban') ?? $traderRegistrationRequirement->IBAN}}" /><br/>

                            <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="bank_account_iban">
                                <span class="">{{__('Account number')}}<span class="text-danger h4"> * </span></span>
                            </label>
                            <input id="bank_account_number" type="text" class="form-control" name="wallet[bank][account][swift]" value="{{old('wallet.bank.account.swift')}}" /><br/>

                            <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="bank_account_swift_code">
                                <span class="">{{__('Bank Name')}}<span class="text-danger h4"> * </span></span>
                            </label>
                            <input id="bank_account_swift_code" type="text" class="form-control" name="wallet[bank][name]" value="{{old('wallet.bank.name')}}" /><br />

                            <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="entity_group">
                                <h2 class="bold">{{__("Bank Statement")}}</h2>

                            </label>


                           
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

                  
                </div>
               
                    <div class="tab-pane fade  " id="tax" role="tabpanel" aria-labelledby="tax-tab">
                        <div class="row m-4" >

                            <label class="d-flex align-items-center fs-6 fw-bold mb-2" >
                                <h2 class="bold">{{__("Tax Document")}}</h2>

                            </label>
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">{{__("Number")}}</span>

                                </label>
                                <!--end::Label-->
                                <input type="text" class="form-control" name="entity[tax][number]" value="{{old('entity.tax.number')}}" />
                            </div>
         
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">{{__("Issuing date")}}</span>

                                </label>
                                <!--end::Label-->
                                <input type="date" name="entity[tax][issuing_date]" class="form-control mb-2" value="{{ old('entity.tax.issuing_date') }}" />
                            </div>
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">{{__("Expiry date")}}</span>

                                </label>
                                <!--end::Label-->
                                <input type="date" name="entity[tax][expiry_date]" class="form-control mb-2" value="{{ old('entity.tax.expiry_date') }}" />
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">{{__('Tax Document file')}}</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" ></i>
                                    </label>
                                    <!--end::Label-->
                                    <input type="file" class="form-control form-control-solid" required  name="entity[tax][documents][0][images][]" placeholder="Enter Target Title"  />
                                </div>

                            </div>

                        </div>
                    </div>

            </div>

  <!--begin::Actions-->
    <div class="text-center m-5">
        <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary" id="kt_modal_new_target_next_step1">
            <span class="indicator-label">{{ __('Sign a new contract ✔️') }}</span>

            <span class="indicator-progress" id="waiting-item">{{__('please-wait')}}
                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
        </button>
    </div>
        </form>
        <!--end::Post-->
    </div>
    <!--end::Content-->
    @endif
    @if($setting->lead_response)
    <div class="card-body p-9" >
        <label class="col-lg-4 fw-bold text-muted" >{{ __('Lead information') }}
            <i class="fas fa-download-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Country of origination"></i></label>
        <div id="tree" style="direction: ltr;"></div>
    </div>
    @endif


 </div>
<script>
    
    document.addEventListener('DOMContentLoaded', function(e) {
        e.preventDefault();
        let lang = '{{app()->getLocale()}}'
        fetch(`https://raw.githubusercontent.com/amrsaeedhosny/countries/master/countries.json`)
            .then(response => response.json())
            .then(data => {
                // Populate the select element with options
                let countrySelect = document.getElementById('countrySelect');
                data.forEach((country) => {

                    let option = document.createElement('option');

                    option.value = country.alpha2_code;
                    option.text = (lang == 'en') ? country.english_name : country.arabic_name;

                    
                    if ('{{ old("user.birth.country") }}' || '{{ old("user.nationality") }}') {
                        if (country.alpha2_code == '{{ old("user.nationality") }}') {
                            option.selected = true;
                        }
                    
                    } else {
                        if (country.alpha2_code == 'SA') {
                            option.selected = true;
                        }
                    }

                    countrySelect.add(option);
                    
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

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.css">
@endpush

