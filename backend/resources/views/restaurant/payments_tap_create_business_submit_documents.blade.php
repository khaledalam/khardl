@extends('layouts.restaurant-sidebar')

@section('content')
    <h3 class="mb-13 mx-3">STEP 2 → Submit Create TAP Business Account</h3>
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
                    <span class="required">Name (English)</span>
                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Business name in English"></i>
                </label>
                <!--end::Label-->
                <input type="text" class="form-control form-control-solid" required placeholder="Enter Business Name (EN)" name="name_en" id="name_en" />
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="d-flex flex-column mb-8 fv-row">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="name_ar">
                    <span class="required">Name (Arabic)</span>
                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Business name in Arabic"></i>
                </label>
                <!--end::Label-->
                <input type="text" class="form-control form-control-solid" required placeholder="Enter Business Name (AR)" name="name_ar" id="name_ar" />
            </div>
            <!--end::Input group-->


            <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="entity_group">
                <h2 class="bold">Entity</h2>
                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="The entity details of the business."></i>
            </label>

            <div class="entity_group mx-5">
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
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="is_licensed">
                        <span class="required">Is Licensed</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Denote whether the business is licensed or not."></i>
                    <!--end::Label-->
                        <input id="is_licensed" type="checkbox" class="mx-2" name="is_licensed" checked/>
                    </label>
                </div>
                <!--end::Input group-->

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
                <!--end::Input group-->

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
                <!--end::Input group-->

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
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="countrySelect">
                        <span class="">Country</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Denote whether the business is licensed or not."></i>
                    </label>
                    <!--end::Label-->
                    <select id="countrySelect" class="form-select"></select>
                </div>
                <!--end::Input group-->

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
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="tax_number">
                        <span class="">Documents</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="The official documents related to the business."></i>
                    </label>
                    <div id="documents_inputs_group">
                        <div>
                            <label>
                                <span class="">Documents</span>
                                <input id="" type="file" class="form-control form-control-solid" name="" /><br />
                            </label>
                        </div>
                    </div>
                    <!--end::Label-->
                    <button class="btn btn-sm btn-primary" id="add_documents_btn">+</button>
                </div>
                <!--end::Input group-->

                <!--begin::Input group-->
                <div class="d-flex flex-column mb-8 fv-row">
                    <!--begin::Label-->
                    <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="bank_account_iban">
                        <span class="">Bank Account</span>
                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="The official documents related to the business."></i>
                    </label>
                    <!--end::Label-->
                    <input id="bank_account_iban" type="text" class="form-control form-control-solid" placeholder="IBAN e.g. INBNK00045545555555555555" name="bank_account_iban" /><br />
                    <input id="bank_account_swift_code" type="text" class="form-control form-control-solid" placeholder="SWIFT code e.g. SWFT12345678909836435647" name="bank_account_swift_code" /><br />
                    <input id="bank_account_number" type="text" class="form-control form-control-solid" placeholder="Account Number e.g. DFGHGFVB876215bsdjhkn" name="bank_account_number" />
                </div>
                <!--end::Input group-->


                <!--begin::Input group-->
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
                <!--end::Input group-->
            </div>

            <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="contact_person_group">
                <h2 class="bold">Contact Person</h2>
                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="The entity details of the business."></i>
            </label>

            <div id="contact_person_group mx-5">

            </div>

            <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="contact_person_group">
                <h2 class="bold">Brands</h2>
                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="The entity details of the business."></i>
            </label>

            <div id="brands_group mx-5">

            </div>


            <!--begin::Actions-->
            <div class="text-center">
                <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">Reset</button>
                <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                    <span class="indicator-label">Submit</span>
                    <span class="indicator-progress">Please wait...
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

            fetch('https://raw.githubusercontent.com/umpirsky/country-list/master/data/en/country.json')
                .then(response => response.json())
                .then(data => {
                    // Populate the select element with options
                    let countrySelect = document.getElementById('countrySelect');
                    let billingAddressCountry = document.getElementById('billing_address_country');
                    Object.keys(data).forEach((iso2, idx) => {
                        let option = document.createElement('option');
                        option.value = iso2;
                        option.text = data[iso2];
                        countrySelect.add(option);
                        billingAddressCountry.add(option);
                    });
                })
                .catch(error => console.error('Error fetching country data:', error));


            document.getElementById('countrySelect').addEventListener('change', function(e) {
                e.preventDefault();

                var selectedCountry = this.value;
                console.log('Selected Country ISO2:', selectedCountry);
            });

            document.getElementById('add_documents_btn').addEventListener('click', function(e) {
                e.preventDefault();

                var selectedCountry = this.value;
                console.log('Selected Country ISO2:', selectedCountry);
            });



            document.getElementById('is_licensed').addEventListener('change', function (is_licensed_event) {
                is_licensed_event.preventDefault();
                console.log("fdfsd")

                let is_licensed_children = document.getElementsByClassName('is_licensed_children');


                console.log("1111")


                for(let idx in is_licensed_children) {

                    let is_licensed_child = is_licensed_children[idx];


                    if (typeof is_licensed_child != 'object')continue;

                    // show the children license related input fields
                    if (is_licensed_event.target.checked) {
                        is_licensed_child.classList.remove('d-none');
                        is_licensed_child.classList.add('d-flex');
                    }
                    // hide the children license related input fields
                    else {
                        is_licensed_child.classList.add('d-none');
                        is_licensed_child.classList.remove('d-flex');
                    }

                }





            });

        });

    </script>

@endsection
