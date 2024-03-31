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
        <form id="kt_modal_new_target_form" class="form card"  method="POST" enctype="multipart/form-data" action="{{route('admin.tap.sign-new-lead',['tenant'=>$restaurant->id])}}">
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
                                    <input id="is_licensed" type="checkbox" class="mx-2" name="entity[is_licensed]" checked />

                                    <span class="required">{{__('Is Entity Licensed')}}</span>
                                    <!--end::Label-->

                                </label>
                            </div>

                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span>{{__('Restaurant Logo')}}</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" ></i>
                                </label>
                                <!--end::Label-->
                                <input type="file" class="form-control form-control-solid"   name="brand[logo]" placeholder="Enter Target Title"  />
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
                                    <input type="text" class="form-control" name="entity[license][number]" value="{{old('entity.license.number' ?? $traderRegistrationRequirement->commercial_registration_number )}}" />
                                </div>
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        {{__("Number of Memorandum of Association")}}

                                    </label>
                                    <!--end::Label-->
                                    <input type="text" class="form-control" name="entity[license][documents][0][number]" value="{{old('entity.license.documents.0.number')}}" />
                                </div>
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        {{__("Issuing date")}}
                                    </label>
                                    <!--end::Label-->
                                    <input type="date" name="entity[license][documents][0][issuing_date]" class="form-control mb-2" value="{{ old('entity.license.documents.0.issuing_date') }}" />
                                </div>
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        {{__("Expiry date")}}

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
                                <select id="countrySelect" class="form-select" required name="user[nationality]"></select>
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
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    {{__("This Number used In")}}

                                </label>
                                <!--end::Label-->
                                <select class="form-select mb-2" data-placeholder="test" name="user[phone][type]">
                                    <option ></option>
                                    <option value="HOME" {{old('user.phone.0.type') == 'HOME'? 'selected' :''}}>{{__('Home')}}</option>
                                    <option value="WORK"  {{old('user.phone.0.type') == 'WORK'? 'selected' :''}}>{{__('Work')}}</option>
                                </select>
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
                        <div class="d-flex flex-column mb-8 fv-row">
                             <!--begin::Label-->
                             <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                {{__("This Email used In")}}

                             </label>
                             <!--end::Label-->
                             <select class="form-select mb-2" data-placeholder="test" name="user[email][type]" >
                                <option ></option>
                                 <option value="HOME" {{old('user.email.type') == 'HOME'? 'selected' :''}}>{{__('Home')}}</option>
                                 <option value="WORK"  {{old('user.email.type') == 'WORK'? 'selected' :''}}>{{__('Work')}}</option>
                             </select>
                         </div>
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                 
    
                                <!--end::Label-->
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="countrySelect">
                                        <span class="required">{{__('Country of origin')}}</span>
    
                                    </label>
                                    <!--end::Label-->
                                    <select id="countrySelect2" class="form-select"  placeholder="{{ __('country') }}" name="user[birth][country]"></select>
                                </div>
                                <!--begin::Input group-->
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        {{__("City")}}
    
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" class="form-control" placeholder="{{ __('City') }}" name="user[birth][city]" value="{{old('user.birth.city')}}" />
                                </div>
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">{{__("National ID")}}</span>
                                    </label>
                                    <!--end::Label-->
                                    <input type="text" class="form-control" placeholder="{{__('National ID')}}" required name="user[identification][number]" value="{{old('user.identification.number') ?? $traderRegistrationRequirement->national_id_number}}" />
                                </div>
                                <!--begin::Input group-->
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">{{__("Date of birth")}}</span>
    
                                    </label>
                                    <!--end::Label-->
                                    <input type="date" required name="user[birth][date]" class="form-control mb-2" value="{{ old('user.birth.date') }}" />
                                    <small class="text-info">{{__('The date of birth must match the National ID number')}}</small>
                                </div>
    
    
                            </div>

                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="bank" role="tabpanel" aria-labelledby="bank-tab">
                    <div class="row  m-4">


                        <div class="col-md-12">
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="bank_account_swift_code">
                                <span class="">{{__('Bank Name')}}<span class="text-danger h4"> * </span></span>
                            </label>
                            <input id="bank_account_swift_code" type="text" class="form-control" name="wallet[bank][name]" value="{{old('wallet.bank.name')   ?? $traderRegistrationRequirement->bank_name}}" /><br />

                            <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="bank_account_swift_code">
                                <span class="">{{__('Company Name')}}</span>
                            </label>
                            <input id="bank_account_swift_code" type="text" class="form-control" name="wallet[bank][account][name]" value="{{old('wallet.bank.account.name') ?? $traderRegistrationRequirement->facility_name}}" /><br />

                            <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="bank_account_iban">
                                <span class="">{{__('Account number')}}</span>
                            </label>
                            <input id="bank_account_number" type="text" class="form-control" name="wallet[bank][account][number]" value="{{old('wallet.bank.account.number') }}" /><br/>
                             <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="bank_account_iban">
                                <span class="">{{__('Bank IBAN')}}<span class="text-danger h4"> * </span></span>
                            </label>
                            <input id="bank_account_number" type="text" class="form-control" name="wallet[bank][account][iban]" value="{{old('wallet.bank.account.iban') ?? $traderRegistrationRequirement->IBAN}}" /><br/>

                            <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="bank_account_iban">
                                <span class="">{{__('Swift Number')}}</span>
                            </label>
                            <input id="bank_account_number" type="text" class="form-control" name="wallet[bank][account][swift]" value="{{old('wallet.bank.account.swift')}}" /><br/>

                           
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="bank_account_iban">
                                <span class="">{{__('Bank Statement number')}}<span class="text-danger h4"> * </span></span>
                            </label>
                        <br>
                            <input id="bank_account_number" type="text" class="form-control" name="wallet[bank][documents][0][number]" value="{{old('wallet.bank.documents.0.number')}}" /><br/>
                           
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    {{__('Bank Statement File')}}
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"></i>
                                </label>
                                <!--end::Label-->
                                <input type="file" class="form-control form-control-solid"   name="wallet[bank][documents][0][images][]"   />
                            </div>

                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    {{__("Issuing date")}}

                                </label>
                                <!--end::Label-->
                                <input type="date" name="wallet[bank][documents][0][issuing_date]" class="form-control mb-2" value="{{ old('entity.license.documents.0.issuing_date') }}" />
                            </div>



                        </div>

                    </div>

                  
                </div>
               
                    <div class="tab-pane fade  " id="tax" role="tabpanel" aria-labelledby="tax-tab">
                        <div class="row m-4" >

                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    {{__("Number")}}

                                </label>
                                <!--end::Label-->
                                <input type="text" class="form-control" name="entity[tax][number]" value="{{old('entity.tax.number')}}" />
                            </div>
         
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    {{__("Issuing date")}}

                                </label>
                                <!--end::Label-->
                                <input type="date" name="entity[tax][issuing_date]" class="form-control mb-2" value="{{ old('entity.tax.issuing_date') }}" />
                            </div>
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    {{__("Expiry date")}}

                                </label>
                                <!--end::Label-->
                                <input type="date" name="entity[tax][expiry_date]" class="form-control mb-2" value="{{ old('entity.tax.expiry_date') }}" />
                                <div class="d-flex flex-column mb-8 fv-row">
                                    <!--begin::Label-->
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        {{__('Tax Document file')}}
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" ></i>
                                    </label>
                                    <!--end::Label-->
                                    <input type="file" class="form-control form-control-solid"  name="documents" placeholder="Enter Target Title"  />
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



     
    });
    document.getElementById('kt_modal_new_target_form').addEventListener('submit', function(event) {
        event.preventDefault();
        var submitButton = document.querySelector('#kt_modal_new_target_submit');
        submitButton.disabled = true;
        var waiting = document.querySelector('#waiting-item');
        waiting.style.display = 'block';
       
        Swal.fire({
            title: '{{ __('are-you-sure') }}',
            text: `{{ __("Are you sure you want to sign new contract ?") }}`,
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#009ef7',
            cancelButtonColor: '#3085d6',
            confirmButtonText: '{{ __('yes') }}',
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

