@extends('layouts.restaurant-sidebar')

@section('title', __('settings'))

@section('content')
<style>
     .border-not-active {
            border: 2px solid #e80000;
        }
</style>
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
                            <div class="card mb-5 mb-xl-10 {{!$branch->active ? 'border-not-active':''}}" >
                                <!--begin::Card header-->
                                <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_email_preferences" aria-expanded="true" aria-controls="kt_account_email_preferences">
                                    <div class="card-title m-0 float-left">
                                        <h3 class="fw-bolder m-0">{{__('settings')}}</h3>
                                    </div>
                                    <div class="card-title m-0 float-right">

                                        @if($branch->active)
                                        <a href="#" onclick="confirmAction('{{ route('restaurant.update-branch-status', ['id' => $branch->id]) }}', `{{ __('Are you sure you want to deactivate this branch ?') }}`)" class="btn btn-danger text-center">
                                            <label for="Activate">{{ __('Deactivate') }}</label>
                                            <i class="fa fa-play text-white m-2"></i>
                                        </a>
                                        @else
                                        <a href="#" onclick="confirmAction('{{ route('restaurant.update-branch-status', ['id' => $branch->id]) }}', `{{ __('Are you sure you want to activate this branch ?') }}`)" class="btn btn-success text-center">
                                            <label for="Activate">{{ __('Activate') }}</label>
                                            <i class="fa fa-play text-white m-2"></i>
                                        </a>
                                        @endif

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
														<span class="fw-bolder fs-5 mb-0">{{__('Payment upon receiving')}}</span>
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
                                            <div class="form-check form-check-custom form-check-solid align-items-start">
                                                <!--begin::Label-->
                                                <span class="form-check-label d-flex flex-column align-items-start">
														<span class="fw-bolder fs-5 mb-0">{{__('The delivery')}}</span>
                                                    @if(!$hasDeliveryCompanies)
                                                        <div class="d-flex my-4">
                                                            <label for="delivery_companies_option">
                                                                <input class="form-check-input me-3" id="delivery_companies_option" type="checkbox" {{ !$branch->delivery_companies_option ? 'disabled' : '' }} name="delivery_companies_option"  value="1" {{ isset($delivery_types[\App\Models\Tenant\DeliveryType::DELIVERY]) &&  $branch->delivery_companies_option ?'checked':''}}  />
                                                                <span class="fw-bolder fs-5 mb-0 form-check-label">{{__('Delivery companies')}}</span>
                                                                <small class="m-2 text-danger">({{__('you are not signed with any delivery company yet')}})</small>
                                                            </label>
                                                        </div>
                                                    @else
                                                        <label for="delivery_companies_option">
                                                            <div class="d-flex my-4">
                                                                <input class="form-check-input me-3" id="delivery_companies_option" type="checkbox" name="delivery_companies_option"  value="1" {{ isset($delivery_types[\App\Models\Tenant\DeliveryType::DELIVERY]) &&  $branch->delivery_companies_option ?'checked':''}}  />
                                                                <span class="fw-bolder fs-5 mb-0">{{__('Delivery companies')}}</span>
                                                                <small class="m-2 text-success">({{__('you are signed with delivery company')}})</small>
                                                            </div>
                                                        </label>
                                                    @endif
                                                    @if(!$hasActiveDrivers)
                                                        <label for="drivers_option">
                                                            <div class="d-flex my-4">
                                                                <input class="form-check-input me-3" id="drivers_option" type="checkbox" name="drivers_option" value="" {{ !$branch->drivers_option ? 'disabled' : '' }} value="1" {{ isset($delivery_types[\App\Models\Tenant\DeliveryType::DELIVERY]) &&  $branch->drivers_option ?'checked':''}}  />
                                                                <span class="fw-bolder fs-5 mb-0 form-check-label">{{__('Own drivers')}}</span>
                                                                <small class="m-2 text-danger">({{__('You do not have any active drivers')}})</small>
                                                            </div>
                                                        </label>
                                                    @else
                                                        <label for="drivers_option">
                                                            <div class="d-flex my-4">
                                                                <input class="form-check-input me-3" type="checkbox" id="drivers_option" name="drivers_option"  value="1" {{ isset($delivery_types[\App\Models\Tenant\DeliveryType::DELIVERY]) &&  $branch->drivers_option ?'checked':''}}  />
                                                                <span class="fw-bolder fs-5 mb-0">{{__('Own drivers')}}</span>
                                                                <small class="m-2 text-success">({{__('You have active drivers')}})</small>
                                                            </div>
                                                        </label>
                                                    @endif
                                                </span>
                                                <!--end::Label-->
                                            </div>
                                            <!--end::Option-->
                                            <!--begin::Option-->
                                            <div class="separator separator-dashed my-6"></div>
                                            <!--end::Option-->
                                            <!--begin::Option-->
                                            <label class="form-check form-check-custom form-check-solid align-items-start">
                                                <!--begin::Input-->
                                                <input class="form-check-input me-3" type="checkbox" name="pickup_availability" value="1" {{($delivery_types[\App\Models\Tenant\DeliveryType::PICKUP] ?? false)?'checked':''}}  />
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

                                            <div class="separator separator-dashed my-6"></div>

                                            <!-- display_category_icon begin::Option-->
                                            <label class="form-check form-check-custom form-check-solid align-items-start">
                                                <!--begin::Input-->
                                                <input class="form-check-input me-3" type="checkbox" name="display_category_icon" value="{{$branch->display_category_icon}}" {{($branch->display_category_icon)?'checked':''}}  />
                                                <!--end::Input-->
                                                <!--begin::Label-->
                                                <span class="form-check-label d-flex flex-column align-items-start">
                                                    <span class="fw-bolder fs-5 mb-0">{{__('display-categories-icons')}}</span>
                                                </span>
                                                <!--end::Label-->
                                            </label>
                                            <!--display_category_icon end::Option-->

                                        </div>
                                        <!--end::Card body-->
                                        <!--begin::Card footer-->
                                        <div class="card-footer d-flex justify-content-end py-6 px-9">
                                            <button class="btn btn-light btn-active-light-primary me-2" type="reset">{{__('discard')}}</button>
                                            <button class="btn btn-khardl px-6" type="submit">{{__('save-changes')}}</button>
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
                time_24hr: true,
                disableMobile: true
            });
        });
        function confirmAction(url, message) {
            event.preventDefault();

            Swal.fire({
                title: message,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: '{{ __("Yes") }}',
                cancelButtonText: '{{ __("No") }}'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = url;
                }
            });
        }
    </script>
@endsection
