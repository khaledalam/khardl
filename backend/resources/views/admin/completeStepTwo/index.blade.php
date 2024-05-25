@extends('layouts.admin-sidebar')
@section('title', __('Complete step 2'))
@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Form-->
            <form action="{{ route('admin.complete-step-two.store',['user' => $user->id]) }}" method="POST" enctype="multipart/form-data" id="form_step_2">
                @csrf

                <!--begin::Main column-->
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <!--begin::Tab content-->
                    <div class="tab-content">
                        <!--begin::Tab pane-->
                        <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                            <div class="d-flex flex-column gap-7 gap-lg-10">
                                <!--begin::General options-->
                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>{{ __('Complete step 2 manually')}}</h2>
                                        </div>
                                        <a href="{{ route('admin.restaurant-owner-management') }}">
                                            <button type="button" class="btn btn-khardl btn-sm">
                                                <i class="fa fa-arrow-left"></i>
                                                {{ __('Back to list') }}
                                            </button>
                                        </a>
                                    </div>
                                    <!--end::Card header-->
                                    @include('components.RO_info.index')
                                    <hr>
                                    @include('components.RO_info.files')
                                    <!--end::Card header-->
                                </div>
                                <!--end::General options-->
                            </div>
                        </div>
                        <!--end::Tab pane-->
                        <div class="d-flex justify-content-end mt-3">
                            <!--begin::Button-->
                            <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-active-light-khardl">
                                <span class="indicator-label">{{ __('Upload files') }}</span>
                                <i class="bi bi-check2-square mx-1"></i>
                                <span class="indicator-progress">{{ __('please-wait')}}
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <button type="submit" class="mx-2 btn btn-khardl" id="upload_with_active">
                                <span class="indicator-label">{{ __('Upload with restaurant activation') }}</span>
                                <i class="bi bi-check2-square mx-1"></i>
                            </button>
                            <!--end::Button-->
                        </div>
                    </div>
                    <!--end::Main column-->
            </form>
            <!--end::Form-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->
@section('js')
<script>
    document.getElementById('upload_with_active').addEventListener('click', function() {
        console.log(1);
        event.preventDefault();
        var newInput = document.createElement('input');
        newInput.type = 'hidden';
        newInput.name = 'active';
        newInput.value = 'true';
        // Append the new input to the form
        var form = document.getElementById('form_step_2');
        form.appendChild(newInput);
        form.submit(); // Submit the form
    });

</script>

@endsection
@endsection
