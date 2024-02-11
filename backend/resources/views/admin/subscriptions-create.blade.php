@extends('layouts.admin-sidebar')
@section('title', __('messages.New subscription'))
@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Form-->
            <form action="{{ route('admin.subscriptions.store') }}" method="POST">
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
                                            <h2>{{ __('messages.New subscription')}}</h2>
                                        </div>
                                        <a href="{{ route('admin.subscriptions') }}">
                                            <button type="button" class="btn btn-primary btn-sm">
                                                <i class="fa fa-arrow-left"></i>
                                                {{ __('messages.Back to list') }}
                                            </button>
                                        </a>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->

                                    <div class="card-body pt-0">
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!-- Arabic Name -->
                                            <div class="mb-2" style="width: 50%; float: left;">
                                                <label class="required form-label">{{ __('messages.Name (Arabic)')}}</label>
                                                <input type="text" name="name_ar" class="form-control" required placeholder="{{ __('messages.Name (Arabic)')}}" value="{{ old('name_ar') }}" />
                                                <div class="text-muted fs-7">{{ __('messages.Name (Arabic)')}} {{ __('messages.is-required')}}</div>
                                            </div>

                                            <!-- English Name -->
                                            <div class="mb-2" style="width: 50%; float: left;">
                                                <label class="required form-label">{{ __('messages.Name (English)')}}</label>
                                                <input type="text" name="name_en" class="form-control" required placeholder="{{ __('messages.Name (English)')}}" value="{{ old('name_en') }}" />
                                                <div class="text-muted fs-7">{{ __('messages.Name (English)')}} {{ __('messages.is-required')}}</div>
                                            </div>

                                            <div style="clear: both;"></div> <!-- Clear the float -->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('messages.Price')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="number" min="1" name="amount" class="form-control mb-2" required placeholder="{{ __('messages.Price')}}" value="{{old('amount')}}" />
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">{{ __('messages.Price')}} {{ __('messages.is-required')}}</div>
                                            <!--end::Description-->
                                        </div>
                                        <!--end::Input group-->

                                        <div class="d-flex justify-content-end mt-3">
                                            <!--begin::Button-->
                                            <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                                                <i class="bi bi-check2-square mx-1"></i>
                                                <span class="indicator-label">{{ __('messages.New subscription') }}</span>
                                                <span class="indicator-progress">{{ __('messages.please-wait')}}
                                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            </button>
                                            <!--end::Button-->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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
@endsection
