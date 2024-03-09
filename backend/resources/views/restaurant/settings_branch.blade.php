@extends('layouts.restaurant-sidebar')

@section('title', __('settings'))

@section('content')

    <!--begin::Body-->
    <body id="kt_body"
          class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="
      --kt-toolbar-height: 55px;
      --kt-toolbar-height-tablet-and-mobile: 55px;
    ">
    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">

            <div class="d-flex flex-column flex-row-fluid" id="kt_wrapper">

                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">

                    <!-- begin::Post -->
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <!--begin::Container-->
                        <div id="kt_content_container" class="container-xxl">
                            <!--begin::Setting-->
                            <div class="card mb-5 mb-xl-10">
                                <!--begin::Card header-->
                                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_email_preferences" aria-expanded="true" aria-controls="kt_account_email_preferences">
                                    <div class="card-title m-0">
                                        <h3 class="fw-bolder m-0">{{__('settings')}}</h3>
                                    </div>
                                </div>
                                <!--begin::Card header-->
                                <!--begin::Content-->
                                <div id="kt_account_settings_email_preferences" class="collapse show">
                                    <!--begin::Form-->
                                    <form class="form" method="POST" action="{{route('restaurant.settings.branch.update',['branch'=>$branch->id])}}">
                                        @method('PUT')
                                        @csrf
                                        <!--begin::Card body-->
                                        <div class="card-body border-top px-9 py-9">
                                            <span class="text-active-gray-900" style="font-size: 18px !important;">{{__('customer-payment-methods')}}</span>

                                            <div class="separator separator-dashed my-6"></div>
                                            <!--begin::Option-->
{{--                                            <label class="form-check form-check-custom form-check-solid align-items-start">--}}
{{--                                                <!--begin::Input-->--}}
{{--                                                <input class="form-check-input me-3" type="checkbox" name="payment_methods[]" value="Online" {{($payment_methods['Online'] ?? false)?'checked':''}} />--}}
{{--                                                <!--end::Input-->--}}
{{--                                                <!--begin::Label-->--}}
{{--                                                <span class="form-check-label d-flex flex-column align-items-start">--}}
{{--														<span class="fw-bolder fs-5 mb-0">{{__('online-payment')}}</span>--}}
{{--														<span class="text-muted fs-6">[{{__('visa')}}, {{__('master-card')}}, {{__('mada')}}, {{__('apple-pay')}}]</span>--}}
{{--													</span>--}}
{{--                                                <!--end::Label-->--}}
{{--                                            </label>--}}
{{--                                            <!--end::Option-->--}}
{{--                                            <!--begin::Option-->--}}
{{--                                            <div class="separator separator-dashed my-6"></div>--}}
                                            <!--end::Option-->
                                            <!--begin::Option-->
                                            <label class="form-check form-check-custom form-check-solid align-items-start">
                                                <!--begin::Input-->
                                                <input class="form-check-input me-3" type="checkbox" @if(!$canPayOnline) {{ 'disabled' }} @endif  name="payment_methods[]"  value="{{\App\Models\Tenant\PaymentMethod::ONLINE}}" {{(isset($payment_methods[\App\Models\Tenant\PaymentMethod::ONLINE]) && $canPayOnline)?'checked':''}}/>
                                                <!--end::Input-->
                                                <!--begin::Label-->
                                                <span class="form-check-label d-flex flex-column align-items-start">
														<span class="fw-bolder fs-5 mb-0">{{__('payment-online')}}</span>
                                                        @if(!$canPayOnline)
                                                        <small style="color: red;">{{__('You can not activate pay online because payment account not active yet')}}</small>
                                                        @endif
													</span>
                                                <!--end::Label-->
                                            </label>
                                            <!--end::Option-->
                                            <!--begin::Option-->
                                             <div class="separator separator-dashed my-6"></div>
                                            <!--end::Option-->
                                            <!--begin::Option-->
                                            <label class="form-check form-check-custom form-check-solid align-items-start">
                                                <!--begin::Input-->
                                                <input class="form-check-input me-3" type="checkbox" name="payment_methods[]" value="{{\App\Models\Tenant\PaymentMethod::CASH_ON_DELIVERY}}" {{($payment_methods[\App\Models\Tenant\PaymentMethod::CASH_ON_DELIVERY] ?? false)?'checked':''}} />
                                                <!--end::Input-->
                                                <!--begin::Label-->
                                                <span class="form-check-label d-flex flex-column align-items-start">
														<span class="fw-bolder fs-5 mb-0">{{__('payment-in-cash-upon-receipt')}}</span>
													</span>
                                                <!--end::Label-->
                                            </label>
                                            <!--end::Option-->
                                            <!--begin::Option-->
                                            <div class="separator separator-dashed my-6"></div>
                                            <!--end::Option-->
                                            <div style="margin-top: 50px !important;">
                                                <span class="text-active-gray-900" style="font-size: 18px !important;">{{__('customer-reception-methods')}}</span>
                                            </div>

                                            <div class="separator separator-dashed my-6"></div>

                                            <!--begin::Option-->
                                            <label class="form-check form-check-custom form-check-solid align-items-start">
                                                <!--begin::Input-->
                                                <input class="form-check-input me-3" type="checkbox" @if(!($hasDeliveryCompanies||$hasActiveDrivers)) {{ 'disabled' }} @endif name="delivery_types[]"  value="{{\App\Models\Tenant\DeliveryType::DELIVERY}}" {{(isset($delivery_types[\App\Models\Tenant\DeliveryType::DELIVERY]) &&  ($hasDeliveryCompanies||$hasActiveDrivers) )?'checked':''}}  />
                                                <!--end::Input-->
                                                <!--begin::Label-->
                                                <span class="form-check-label d-flex flex-column align-items-start">
														<span class="fw-bolder fs-5 mb-0">{{__('delivery')}}</span>
                                                    @if(!$hasDeliveryCompanies)
                                                    <small style="color: red;">{{__('you are not signed with any delivery company yet')}}</small>
                                                    @else
                                                        <small style="color: green;">{{__('you are signed with delivery company')}}</small>
                                                    @endif
                                                    @if(!$hasActiveDrivers)
                                                    <small style="color: red;">{{__('You do not have any active drivers')}}</small>
                                                    @else
                                                        <small style="color: green;">{{__('You have active drivers')}}</small>
                                                    @endif
													</span>
                                                <!--end::Label-->
                                            </label>
                                            <!--end::Option-->
                                            <!--begin::Option-->
                                            <div class="separator separator-dashed my-6"></div>
                                            <!--end::Option-->
                                            <!--begin::Option-->
                                            <label class="form-check form-check-custom form-check-solid align-items-start">
                                                <!--begin::Input-->
                                                <input class="form-check-input me-3" type="checkbox" name="delivery_types[]" value="{{\App\Models\Tenant\DeliveryType::PICKUP}}" {{($delivery_types[\App\Models\Tenant\DeliveryType::PICKUP] ?? false)?'checked':''}}  />
                                                <!--end::Input-->
                                                <!--begin::Label-->
                                                <span class="form-check-label d-flex flex-column align-items-start">
														<span class="fw-bolder fs-5 mb-0">{{__('pick-up-from-the-restaurant')}}</span>
													</span>
                                                <!--end::Label-->
                                            </label>
                                            <!--end::Option-->
                                            <!--begin::Option-->
                                            <div class="separator separator-dashed my-6"></div>
                                            <!--end::Option-->
                                            <span class="text-active-gray-900" style="font-size: 18px !important;">{{__('Food preparation time')}}</span>
                                            <small class="text-muted">{{ __('prepare food takes how long time') }}</small>

                                            <div class="separator separator-dashed my-6"></div>
                                            <label class="form-check form-check-custom form-check-solid align-items-start">
                                                <!--begin::Input-->
                                                <input type="text" class="form-control" name="preparation_time_delivery" id="prep-time" value="{{ $branch->preparation_time_delivery }}">
                                                <!--end::Input-->
                                                <!--begin::Label-->
                                                <span class="form-check-label d-flex flex-column align-items-start">
														<span class="fw-bolder fs-5 mb-0">{{__('Time (H:M:S)')}}</span>
													</span>
                                                <!--end::Label-->
                                            </label>
                                        </div>
                                        <!--end::Card body-->
                                        <!--begin::Card footer-->
                                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                                            <button class="btn btn-light btn-active-light-primary me-2">{{__('discard')}}</button>
                                            <button class="btn btn-khardl px-6">{{__('save-changes')}}</button>
                                        </div>
                                        <!--end::Card footer-->
                                    </form>
                                    <!--end::Form-->
                                </div>
                                <!--end::Content-->
                            </div>
                            <!--end::Setting-->
                        </div>
                    </div>
                    <!-- end::Post -->

                </div>
                <!--end::Content-->
            </div>
        </div>
        <!--end::Page-->
    </div>
    <!--end::Root-->
    <!--end::Body-->
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Check if preparation_time_delivery exists
        var preparationTime = "{{ $branch->preparation_time_delivery ?? '' }}";

        // Initialize the timepicker with the existing value or default value
        flatpickr("#prep-time", {
            enableTime: true,
            noCalendar: true,
            enableSeconds: true,
            dateFormat: "H:i:S",
            defaultDate: preparationTime || "00:00:00",
            time_24hr: true
        });
    });
    </script>
@endsection
