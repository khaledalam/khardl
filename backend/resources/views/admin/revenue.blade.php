@extends('layouts.admin-sidebar')


@section('title',  __('messages.revenue'))

@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">
  <!--begin::Post-->

    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Form-->
            <form action="{{ route('admin.generate-user') }}" method="POST">
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
                                            <h2>{{ __('messages.revenue')}}</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->

                                    <div class="card-body pt-0">
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="form-label">{{ __('messages.flat-rate')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="first_name" class="form-control mb-2" required placeholder="{{ __('messages.flat-rate')}} in {{__('messages.Halala')}}" value="" />
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">{{__("e.g.")}} 700 {{__('messages.Halala')}}</div>
                                            <!--end::Description-->
                                        </div>
                                        <!--end::Input group-->


                                    </div>
                                    <!--end::Card header-->
                                </div>
                                <!--end::General options-->
                            </div>
                        </div>
                        <!--end::Tab pane-->
                        <div class="d-flex justify-content-end mt-3">
                            <!--begin::Button-->
                            <a href="{{ route('admin.user-management') }}"
                               id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">{{ __('messages.go-back')}}</a>
                            <!--end::Button-->
                            <!--begin::Button-->
                            <button type="submit" id="kt_ecommerce_add_product_submit"
                                    class="btn btn-primary">
                                <span class="indicator-label">{{ __('messages.save') }}</span>
                                <span class="indicator-progress">{{ __('messages.please-wait')}}
                                          <span
                                              class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
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

</div>
<!--end::Content-->
@endsection
