@extends('layouts.restaurant-sidebar')

@section('content')
    <h3 class="mb-13 mx-3">{{ __('STEP 1 → Upload Documents for Create TAP Business Account') }}</h3>
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
                    <span class="">{{ __(''.$title) }}</span>
                    <span class="text-danger h4"> * </span>
                    <i class="fas fa-exclamation-circle ms-2 fs-7 mx-3  " data-bs-toggle="tooltip" title="{{ __(''.$title) }}"></i>
                </label>
                <input id="business_log" accept="{{($name == 'business_logo')?'.gif':'.pdf'}},.jpeg,.png" type="file" class="form-control form-control-solid" name="{{$name}}" />
                <small><i>{{ __('Accept') }}: {{ ($name == 'business_logo')?'GIF':'PDF' }}, JPEG, PNG. {{ __('size <= 16 MG') }}</i></small>
                @if ($tap_files)
                    <a href="{{ route('download.file', ['path' => $tap_files->{$name.'_path'}]) }}"><span class="fw-bolder fs-6 text-gray-800 btn btn-sm btn-khardl"><i class="fas fa-download"></i></span></a>
                @endif
            </div>

        @endforeach
       <!--begin::Actions-->
       <div class="text-center">
        <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">{{ __('Reset ↻') }}</button>
        <button type="submit" id="kt_modal_new_target_submit" class="btn btn-khardl">
            <span class="indicator-label">{{ __('Upload ⬆') }}</span>
            <span class="indicator-progress" id="waiting-item">{{ __('Please wait...') }}
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
    <script>
        document.getElementById('kt_modal_new_target_form').addEventListener('submit', function (e) {
            e.preventDefault();
            var submitButton = document.querySelector('#kt_modal_new_target_submit');

            submitButton.disabled = true;
            var waiting = document.querySelector('#waiting-item');
            waiting.style.display = 'block';
            document.getElementById('kt_modal_new_target_form').submit();

        });
    </script>
@endsection
