@extends('layouts.restaurant-sidebar')

@section('content')
    <h3 class="mb-13 mx-3">STEP 1 → Upload Documents for Create TAP Business Account</h3>
    @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    <!--begin::Content-->
    <div class="container content d-flex flex-column flex-column-fluid pt-0" id="kt_content">
        <!--begin::Post-->
        <form id="kt_modal_new_target_form" class="form" action="{{ route('tap.payments_upload_tap_documents', ['id' => 'test']) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <!--begin::Input group-->
        <div class="d-flex flex-column mb-8 fv-row">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="business_log">
                <span class="">Business Icon</span>
                <i class="fas fa-exclamation-circle ms-2 fs-7 mx-3  " data-bs-toggle="tooltip" title="A business logo."></i>
            </label>
            <input id="business_log" accept=".gif,.jpeg,.png" type="file" class="form-control form-control-solid" name="business_log" />
            <pre class="mx-3"><small><i>Accept: GIF, JPEG, PNG. size <= 8 MG</i></small></pre>
        </div>
        <!--end::Input group-->


        <!--begin::Input group-->
        <div class="d-flex flex-column mb-8 fv-row">
            <!--begin::Label-->
            <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="business_log">
                <span class="">Business Logo</span>
                <i class="fas fa-exclamation-circle ms-2 fs-7 mx-3  " data-bs-toggle="tooltip" title="A business logo."></i>
            </label>
            <input id="business_log" accept=".gif,.jpeg,.png" type="file" class="form-control form-control-solid" name="business_log" />
            <pre class="mx-3"><small><i>Accept: GIF, JPEG, PNG. size <= 8 MG</i></small></pre>
        </div>
        <!--end::Input group-->

            <!--begin::Input group-->
            <div class="d-flex flex-column mb-8 fv-row">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="customer_signature">
                    <span class="">Customer Signature</span>
                    <i class="fas fa-exclamation-circle ms-2 fs-7 mx-3  " data-bs-toggle="tooltip" title="A customer signature."></i>
                </label>
                <input id="customer_signature" accept=".jpg,.png,.pdf" type="file" class="form-control form-control-solid" name="customer_signature" />
                <pre class="mx-3"><small><i>Accept: GIF, PDF, JPEG, PNG. size <= 8 MG</i></small></pre>
            </div>
            <!--end::Input group-->


            <!--begin::Input group-->
            <div class="d-flex flex-column mb-8 fv-row">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="dispute_evidence">
                    <span class="">Dispute Evidence</span>
                    <i class="fas fa-exclamation-circle ms-2 fs-7 mx-3  " data-bs-toggle="tooltip" title="Evidence to submit with a dispute response."></i>
                </label>
                <input id="dispute_evidence" accept=" .pdf" type="file" class="form-control form-control-solid" name="dispute_evidence" />
                <pre class="mx-3"><small><i>Accept: PDF, JPEG, PNG. size <= 8 MG</i></small></pre>
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="d-flex flex-column mb-8 fv-row">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="identity_document">
                    <span class="">identity Document</span>
                    <i class="fas fa-exclamation-circle ms-2 fs-7 mx-3  " data-bs-toggle="tooltip" title="A document to verify the identity of an account owner during account provisioning."></i>
                </label>
                <input id="identity_document" accept=".jpeg,.png,.pdf" type="file" class="form-control form-control-solid" name="identity_document" />
                <pre class="mx-3"><small><i>Accept: PDF, JPEG, PNG. size <= 8 MG</i></small></pre>
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="d-flex flex-column mb-8 fv-row">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="pci_document">
                    <span class="">PCI Document</span>
                    <i class="fas fa-exclamation-circle ms-2 fs-7 mx-3  " data-bs-toggle="tooltip" title="A self-assessment PCI questionnaire."></i>
                </label>
                <input id="pci_document" accept=".pdf" type="file" class="form-control form-control-solid" name="pci_document" />
                <pre class="mx-3"><small><i>Accept: PDF, JPEG, PNG. size <= 8 MG</i></small></pre>
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="d-flex flex-column mb-8 fv-row">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="tax_document_user_upload">
                    <span class="">TAX Document User Upload</span>
                    <i class="fas fa-exclamation-circle ms-2 fs-7 mx-3  " data-bs-toggle="tooltip" title="A user-uploaded tax document.A user-uploaded tax document."></i>
                </label>
                <input id="tax_document_user_upload" accept=".csv,.docx,.jpg,.pdf,.png,.xls,.xlsx" type="file" class="form-control form-control-solid" name="tax_document_user_upload" />
                <pre class="mx-3"><small><i>Accept: PDF, JPEG, PNG. size <= 8 MG</i></small></pre>
            </div>
            <!--end::Input group-->

            <!--begin::Actions-->
            <div class="text-center">
                <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">Reset ↻</button>
                <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                    <span class="indicator-label">Upload ⬆</span>
                    <span class="indicator-progress">Please wait...
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
                <a href="{{route('tap.payments_submit_tap_documents_get')}}" type="button" id="next_step_btn" class="btn btn-warning me-3">Go to step 2 →</a>
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
