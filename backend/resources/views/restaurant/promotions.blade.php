@extends('layouts.restaurant-sidebar')

@section('title', __('promotions'))

@section('content')


<!--begin::Body-->

<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="
      --kt-toolbar-height: 55px;
      --kt-toolbar-height-tablet-and-mobile: 55px;
    ">
    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">

            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid" id="kt_wrapper">


                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">
                    <!--begin::Post-->
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <!--begin::Container-->
                        <div id="kt_content_container" class="container-xxl">
                            <!--begin::Row-->
                            <div class="row g-12 g-xl-12 mb-xl-112">

                                <div class="col-md-12 col-lg-12 mb-md-4 mb-xl-0">
                                    <!--begin::Card widget 4-->
                                    <div class="card card-flush h-md-100 mb-5 mb-xl-0">
                                        <!--begin::Form-->
                                        <form id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row" action="{{ route('promotions.save-settings') }}" method="POST">
                                            @csrf
                                            <!--begin::main column-->
                                            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                                                <!--begin::tab content-->
                                                <div class="tab-content">
                                                    <!--begin::tab pane-->
                                                    <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                                                        <div class="d-flex flex-column gap-7 gap-lg-10">
                                                            <!--begin::general options-->
                                                            <div class="card card-flush py-4">
                                                                <!--begin::card header-->
                                                                <div class="card-header">
                                                                    <div class="card-title">
                                                                        <h2>{{ __('Loyalty points') }}</h2>
                                                                    </div>
                                                                </div>
                                                                <!--end::card header-->
                                                                <!--begin::card body-->
                                                                <div class="card-body pt-0">
                                                                    <!--begin::input group-->
                                                                    <div class="fv-row">
                                                                        <!--begin::label-->
                                                                        <label class="required form-label">{{ __('How many loyalty points customer get per spend each 1 SAR?') }}</label>
                                                                        <!--end::label-->
                                                                        <!--begin::input-->
                                                                        <input type="number" min="0" step="0.01" name="loyalty_points" class="form-control mb-2" placeholder="{{ __('e.g 0.02') }}" value="{{$settings['loyalty_points']}}" />
                                                                        <!--end::input-->

                                                                    </div>
                                                                    <!--begin::input group-->
{{--                                                                    <div class="mb-10 fv-row">--}}
{{--                                                                        <!--begin::label-->--}}
{{--                                                                        <label class="required form-label">{{__('Price per 1 loyalty point per purchase')}}--}}
{{--                                                                            <small class="text-muted">({{ __('SAR') }})</small>--}}
{{--                                                                        </label>--}}
{{--                                                                        <!--end::label-->--}}
{{--                                                                        <!--begin::input-->--}}
{{--                                                                        <input type="number" min="1" step="0.01" name="loyalty_point_price" class="form-control mb-2" placeholder="1 {{ __('SAR') }}" value="{{$settings['loyalty_point_price']}}" />--}}
{{--                                                                        <!--end::input-->--}}
{{--                                                                    </div>--}}
                                                                    <!--end::input group-->


                                                                </div>
                                                                <!--end::card header-->
                                                            </div>
                                                            <!--end::general options-->
                                                        </div>
                                                    </div>
                                                    <!--end::tab pane-->
                                                </div>

                                            </div>
                                            <!--end::main column-->


                                            <!--begin::Main column-->
{{--                                            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">--}}

{{--                                                <!--begin::Tab content-->--}}
{{--                                                <div class="tab-content">--}}
{{--                                                    <!--begin::Tab pane-->--}}
{{--                                                    <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">--}}
{{--                                                        <div class="d-flex flex-column gap-7 gap-lg-10">--}}
{{--                                                            <!--begin::General options-->--}}
{{--                                                            <div class="card card-flush py-4">--}}
{{--                                                                <!--begin::Card header-->--}}
{{--                                                                <div class="card-header">--}}
{{--                                                                    <div class="card-title">--}}
{{--                                                                        <h2>{{ __('Cash-back') }}</h2>--}}
{{--                                                                    </div>--}}
{{--                                                                </div>--}}
{{--                                                                <!--end::Card header-->--}}
{{--                                                                <!--begin::Card body-->--}}
{{--                                                                <div class="card-body pt-0">--}}
{{--                                                                    <!--begin::Input group-->--}}
{{--                                                                    <div class="fv-row">--}}
{{--                                                                        <!--begin::Label-->--}}
{{--                                                                        <label class="required form-label">{{ __('Start from') }}--}}
{{--                                                                            <small class="text-muted">({{ __('get cash back when total is above this value') }})</small>--}}
{{--                                                                        </label>--}}
{{--                                                                        <!--end::Label-->--}}
{{--                                                                        <!--begin::Input-->--}}
{{--                                                                        <input type="number" min="1" step="0.01" name="cashback_threshold" class="form-control mb-2" placeholder="e.x. 50" value="{{$settings['cashback_threshold']}}" />--}}
{{--                                                                        <!--end::Input-->--}}
{{--                                                                    </div>--}}
{{--                                                                    <!--end::Input group-->--}}
{{--                                                                    <!--begin::Input group-->--}}
{{--                                                                    <div class="mb-10 mt-1 fv-row">--}}
{{--                                                                        <!--begin::Input-->--}}
{{--                                                                        --}}{{-- <input type="checkbox" name="threshold" id="threshold"/>--}}
{{--                                                                        --}}{{-- <!--end::Input-->--}}
{{--                                                                        --}}{{-- <!--begin::Label-->--}}
{{--                                                                        --}}{{-- <label class="form-label" for="threshold">Enable threshold</label>--}}
{{--                                                                        <!--end::Label-->--}}
{{--                                                                    </div>--}}
{{--                                                                    <!--end::Input group-->--}}
{{--                                                                    <!--begin::Input group-->--}}
{{--                                                                    <div class="mb-10 fv-row">--}}
{{--                                                                        <!--begin::Label-->--}}
{{--                                                                        <label class="required form-label">{{ __('Cash back in percentage (%)') }}</label>--}}
{{--                                                                        <!--end::Label-->--}}
{{--                                                                        <!--begin::Input-->--}}
{{--                                                                        <input type="number" min="1" step="0.01" name="cashback_percentage" class="form-control mb-2" placeholder="e.x. 5%" value="{{$settings['cashback_percentage']}}" />--}}
{{--                                                                        <!--end::Input-->--}}
{{--                                                                    </div>--}}
{{--                                                                    <!--end::Input group-->--}}

{{--                                                                </div>--}}
{{--                                                                <!--end::Card header-->--}}
{{--                                                            </div>--}}
{{--                                                            <!--end::General options-->--}}
{{--                                                        </div>--}}
{{--                                                    </div>--}}
{{--                                                    <!--end::Tab pane-->--}}
{{--                                                </div>--}}

{{--                                            </div>--}}
                                            <!--end::Main column-->

                                            <button type="submit" class="btn btn-sm fw-bolder btn-khardl px-4">{{__('save')}}</button>
                                        </form>
                                        <!--end::Form-->
                                    </div>
                                    <!--end::Card widget 4-->
                                </div>

                            </div>
                            <!--end::Modals-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Post-->
                </div>
                <!--end::Content-->

            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Root-->
    <!--end::Main-->

    @endsection
