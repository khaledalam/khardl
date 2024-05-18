@extends('layouts.restaurant-sidebar')

@section('title', __('settings'))

@section('content')

<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">
    <!--begin::Post-->

    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Form-->
            <form action="{{ route('restaurant.update.settings') }}" method="POST">
                @csrf

                <!--begin::Main column-->
                <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                    <!--begin::Tab content-->
                    <div class="tab-content">
                        <!--begin::Tab pane-->
                        <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">

                            {{-- Fee start --}}
                            <div class="d-flex flex-column my-2">
                                <!--begin::General options-->
                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>{{ __('Global delivery fees for all branches')}}</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->

                                    <div class="card-body pt-0">
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="form-label">{{ __('delivery-fee')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="number" min="0" step="0.1" name="delivery_fee" class="form-control mb-2" required placeholder="{{ __('delivery-fee')}} {{__('in')}} {{__('sar')}}" value="{{$settings['delivery_fee']}}" />
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">{{__('e.g.')}} 10.5 {{__('sar')}}</div>
                                            <!--end::Description-->
                                        </div>
                                        <!--end::Input group-->


                                    </div>
                                    <!--end::Card header-->
                                </div>
                                <!--end::General options-->
                            </div>
                            {{-- Fee end --}}

                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column flex-row-fluid my-2">
                    <!--begin::Tab content-->
                    <div class="tab-content">
                        <!--begin::Tab pane-->
                        <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">

                            {{-- Fee start --}}
                            <div class="d-flex flex-column gap-7 gap-lg-10">
                                <!--begin::General options-->
                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>{{ __('Delivery options')}}</h2>
                                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                            title="{{ __('If you enable own drivers option and delivery companies option at any branch, the orders at first (when accepted by restaurant) will automatically goes to your own drivers and there will be timer (Which you determine bellow) after this timer the orders goes automatically to all delivery companies you already assigned with.') }}">
                                            </i>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->

                                    <div class="card-body pt-0">
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="form-label">{{ __('Max time for drivers to accept order(in case if delivery companies exist and drivers)')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="number" min="1" name="limit_delivery_company" id="limit_delivery_company" class="form-control mb-2" placeholder="{{ __('Number of minutes')}}" value="{{$settings->limit_delivery_company ?? config('application.limit_delivery_company')}}" />
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">{{__('The number of minutes for own drivers so he can accept order before order goes to delivery companies')}} ({{ __('Default: :minutes minutes',['minutes' => $settings->limit_delivery_company ?? config('application.limit_delivery_company')]) }})</div>
                                            <!--end::Description-->
                                        </div>
                                        <!--end::Input group-->

                                    </div>
                                    <!--end::Card header-->
                                </div>
                                <!--end::General options-->
                            </div>
                            {{-- Fee end --}}

                        </div>
                    </div>
                </div>
                <!--end::Tab pane-->
                <div class="d-flex justify-content-end mt-3">
                    <!--begin::Button-->
                    <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-khardl">
                        <span class="indicator-label">{{ __('save') }}</span>
                        <i class="bi bi-check2-square mx-1"></i>
                        <span class="indicator-progress">{{ __('please-wait')}}
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                    <!--end::Button-->
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
@section('js')
<script>
   /*  document.addEventListener('DOMContentLoaded', function() {
        // Function to toggle the disabled attribute of limit_delivery_company input
        function toggleLimitDeliveryCompany() {
            var driversOptionCheckbox = document.getElementById('drivers_option');
            var DeliveryCompaniesOptionCheckbox = document.getElementById('delivery_companies_option');
            var limitDeliveryCompanyInput = document.getElementById('limit_delivery_company');
            // Check if the elements are found before setting properties
            if (driversOptionCheckbox && limitDeliveryCompanyInput) {
                // Enable/disable based on the state of the drivers option checkbox
                limitDeliveryCompanyInput.disabled = (!driversOptionCheckbox.checked||!DeliveryCompaniesOptionCheckbox.checked);
            }
        }

        // Call the function when the page loads
        toggleLimitDeliveryCompany(); // Initial state

        // Call the function whenever the drivers option checkbox state changes
        document.getElementById('drivers_option').addEventListener('change', function() {
            toggleLimitDeliveryCompany();
        });
        document.getElementById('delivery_companies_option').addEventListener('change', function() {
            toggleLimitDeliveryCompany();
        });
    }); */
</script>

@endsection
