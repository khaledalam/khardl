@extends('layouts.restaurant-sidebar')

@section('content')
    <h3 class="mb-13">Upload TAP documents</h3>
    @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif

    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">
        <!--begin::Post-->
        <form id="kt_modal_new_target_form" class="form" action="{{ route('tap.payments_upload_tap_documents', ['id' => 'test']) }}" method="POST" enctype="multipart/form-data">
        @csrf
            <!--begin::Input group-->
            <div class="d-flex flex-column mb-8 fv-row">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                    <span class="required">First Document</span>
                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference"></i>
                </label>
                <!--end::Label-->
                <input type="file" class="form-control form-control-solid" required placeholder="Enter Target Title" name="photo" />
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="d-flex flex-column mb-8 fv-row">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                    <span class="required">Second Document</span>
                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference"></i>
                </label>
                <!--end::Label-->
                <input type="file" class="form-control form-control-solid" required placeholder="Enter Target Title" name="photo" />
            </div>
            <!--end::Input group-->

            <!--begin::Input group-->
            <div class="d-flex flex-column mb-8">
                <label class="fs-6 fw-bold mb-2">Notes</label>
                <textarea class="form-control form-control-solid" rows="3" name="description" placeholder="Write Description"></textarea>
            </div>
            <!--end::Input group-->



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

@endsection
