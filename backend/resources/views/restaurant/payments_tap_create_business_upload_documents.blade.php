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

        @foreach($files as $name=>$title)
            <!--begin::Input group-->
            <div class="d-flex flex-column mb-8 fv-row">
                <!--begin::Label-->
                <label class="d-flex align-items-center fs-6 fw-bold mb-2" for="business_log">
                    <span class="">{{ __($title) }}</span>
                    <i class="fas fa-exclamation-circle ms-2 fs-7 mx-3  " data-bs-toggle="tooltip" title="A business logo."></i>
                </label>
                <input id="business_log" accept="{{($name == 'business_logo')?'.gif':'.pdf'}},.jpeg,.png" type="file" class="form-control form-control-solid" name="{{$name}}" />
                <pre class="mx-3"><small><i>Accept: {{($name == 'business_logo')?'GIF':'PDF'}}, JPEG, PNG. size <= 8 MG</i></small></pre>
                @if ($tap_files)
                    <a href="{{ route('admin.download.file', ['path' => $tap_files->{$name.'_path'}]) }}"><span class="fw-bolder fs-6 text-gray-800 btn btn-sm btn-primary"><i class="fas fa-download"></i></span></a>
                @endif
            </div>
           
        @endforeach
       <!--begin::Actions-->
       <div class="text-center">
        <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">Reset ↻</button>
        <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
            <span class="indicator-label">Upload ⬆</span>
            <span class="indicator-progress">Please wait...
                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
        </button>
        @if($tap_files)
            <a href="{{route('tap.payments_submit_tap_documents_get')}}" type="button" id="next_step_btn" class="btn btn-warning me-3">Go to step 2 →</a>
        @endif
    </div>
    <!--end::Actions-->
        </form>
        <!--end::Post-->
    </div>
    <!--end::Content-->

@endsection
