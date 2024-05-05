@extends('layouts.admin-sidebar')
@section('title', __('view-restaurant'))

@section('content')

<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">
    <!--begin::Post-->
    <div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container">
            <!--begin::Navbar-->
            <div class="card mb-5 mb-xl-10">
                <div class="card-body pt-9 pb-0">
                    <!--begin::Details-->
                    <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                        <!--begin: Pic-->
                        <div class="me-7 mb-4">
                            <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">

                                <img alt="Logo" src="{{ $logo ?? global_asset('assets/default_logo.png') }}" />

                                @if($is_live)<div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-white h-20px w-20px"></div>@endif

                            </div>
                        </div>
                        <!--end::Pic-->
                        <!--begin::Info-->
                        <div class="flex-grow-1">
                            <!--begin::Title-->
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <!--begin::User-->
                                <div class="d-flex flex-column">
                                    <!--begin::Name-->
                                    <div class="d-flex align-items-center mb-2">

                                        <a class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1">{{ $restaurant->restaurant_name }}
                                        </a>
                                        <a>
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen026.svg-->
                                            @if ($is_live)
                                            <span class="svg-icon svg-icon-1 svg-icon-primary">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                    <path d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z" fill="#00A3FF" />
                                                    <path class="permanent" d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z" fill="white" />
                                                </svg>
                                            </span>
                                            @endif
                                            <!--end::Svg Icon-->
                                        </a>
                                    </div>
                                    <!--end::Name-->
                                    <!--begin::Info-->
                                    <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
                                        <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                            <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                                            <span class="svg-icon svg-icon-4 me-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="currentColor" />
                                                    <path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->{{ $owner->first_name }} {{ $owner->last_name }}</a>
                                        {{-- <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
                                            <span class="svg-icon svg-icon-4 me-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z" fill="currentColor" />
                                                    <path d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z" fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->SA, Al-Riyadh</a> --}}
                                        <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                            <!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
                                            <span class="svg-icon svg-icon-4 me-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z" fill="currentColor" />
                                                    <path d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z" fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->{{ $restaurant->email }}</a>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::User-->

                            </div>
                            <!--end::Title-->
                            <!--begin::Stats-->

                            <div class="d-flex flex-wrap flex-stack">
                                <!--begin::Wrapper-->
                                @if ($is_live)
                                <div class="d-flex flex-column flex-grow-1 pe-8">
                                    <!--begin::Stats-->
                                    <div class="d-flex flex-wrap">
                                        <!--begin::Stat-->
                                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                            <!--begin::Number-->
                                            <div class="d-flex align-items-center restaurant_daily_amount position-relative">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                                @if ($compareEarningResult=='higher')
                                                <i class="fa fa-arrow-up text-success mx-2"></i>
                                                @else
                                                <i class="fa fa-arrow-down text-danger mx-2"></i>
                                                @endif
                                                <!--end::Svg Icon-->
                                                <span class="restaurant_daily_earning fade">{{ $dailyEarning }} {{ __('SAR') }}</span>
                                                <div class="fs-2 fw-bolder">{{ getAmount((float)$dailyEarning) }} {{ __('SAR') }}</div>
                                            </div>
                                            <!--end::Number-->
                                            <!--begin::Label-->
                                            <div class="fw-bold fs-6 text-gray-400">{{ __('Daily earnings')}}</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Stat-->
                                        <!--begin::Stat-->
                                        <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                            <!--begin::Number-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr065.svg-->
                                                @if ($compareOrderResult=='higher')
                                                <i class="fa fa-arrow-up text-success mx-2"></i>
                                                @else
                                                <i class="fa fa-arrow-down text-danger mx-2"></i>
                                                @endif

                                                <!--end::Svg Icon-->
                                                <div class="fs-2 fw-bolder">{{ $dailyOrders }}</div> <!--  data-kt-countup-value="150" -->
                                            </div>
                                            <!--end::Number-->
                                            <!--begin::Label-->
                                            <div class="fw-bold fs-6 text-gray-400">{{ __('Daily orders')}}</div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Stat-->
                                        <!--begin::Stat-->

                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <div class="d-flex flex-column w-200px w-sm-300px mt-3">
                                    <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                        @if($subscription && $subscription->status == \App\Models\ROSubscription::ACTIVE)
                                            <span class="fw-bold fs-6 text-black fw-bolder">{{ __('plan ends at') }} :</span>
                                            <span class="badge badge-success p-2 fs-6">
                                                {{ $subscription->end_at?->format('Y-m-d') }}
                                            </span>
                                        @elseif($subscription)
                                        <span class="fw-bold fs-6 text-black fw-bolder">{{__('Plan')}}</span>
                                            <span class="badge badge-warning p-2 fs-6">
                                                {{__("subscription not active")}}
                                            </span>
                                        @else
                                            <span class="fw-bold fs-6 text-black fw-bolder">{{__('Plan')}}</span>
                                            <span class="badge badge-dark p-2 fs-6">
                                                {{__("No subscription")}}
                                            </span>
                                        @endif

                                    </div>
                                    <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                        @if($customer_app && $customer_app->status == \App\Models\ROSubscription::ACTIVE)
                                        <span class="fw-bold fs-6 text-black fw-bolder">{{ __('customer app plan ends at') }} :</span>
                                        <span class="badge badge-success p-2 fs-6">
                                            {{ $customer_app->end_at?->format('Y-m-d') }}
                                        </span>
                                        @elseif($customer_app && $customer_app->status == \App\Models\ROCustomerAppSub::REQUESTED)
                                            <span class="fw-bold fs-6 text-black fw-bolder">{{__('Customer application')}}</span>
                                            <span class="badge badge-light-danger fw-bolder m-1">{{ __('Request for app')}}</span>
                                        @elseif($customer_app && $customer_app->status == \App\Models\ROCustomerAppSub::DEACTIVATE)
                                            <span class="fw-bold fs-6 text-black fw-bolder">{{__('Customer application')}}</span>
                                            <span class="badge badge-light-danger fw-bolder m-1">{{ __('cancellation request')}}</span>
                                        @elseif($customer_app && $customer_app->status == \App\Models\ROSubscription::SUSPEND)
                                            <span class="fw-bold fs-6 text-black fw-bolder">{{__('Customer application')}}</span>
                                            {{__("Customer app Subscription is currently suspended")}}

                                            <span class="badge badge-success p-2 fs-6">

                                                {{ $customer_app->end_at?->format('Y-m-d') }}
                                            </span>
                                        @else
                                            <span class="fw-bold fs-6 text-black fw-bolder">{{__('Customer application')}}</span>
                                            <span class="badge badge-dark p-2 fs-6">
                                                {{__("No subscription")}}
                                            </span>
                                        @endif
                                    </div>
                                </div>


                                <!--end::Wrapper-->
                                <!--begin::Progress-->

                                @elseif (!$is_live && !$restaurant?->user?->isBlocked())
                                <div class="d-flex justify-content-between align-items-center">
                                    @if($user?->hasPermission('can_approve_restaurants'))
                                    <a id="active_restuarant" class="badge badge-light-success  text-hover-white bg-hover-success p-5 m-3">{{ __('approve')}}</a>
                                    <form id="approve-form" data-loading="false" action="{{ route('admin.restaurant.activate', ['restaurant' => $restaurant->id]) }}" method="POST" style="display: inline">
                                        @csrf
                                        @method('PUT')

                                    </form>
                                    @endif

                                    <form action="{{ route('admin.denyUser', ['id' => $restaurant->id]) }}" method="POST" style="display: inline">
                                        @csrf
                                        <button style="border: 0;" type="submit" class="badge badge-light-danger btn-confirm text-hover-white bg-hover-danger p-5 m-3">{{ __('deny')}}</button>
                                    </form>


                                </div>
                                @elseif ($restaurant?->user?->isBlocked())
                                    <div class="d-flex justify-content-left w-100 mt-auto mb-2">
                                        <span class="badge badge-danger p-2 fs-6">{{ __('blocked')}}</span>
                                    </div>
                                @endif

                                @if ($restaurant?->user?->isRejected())
                                    <div class="d-flex flex-column justify-content-left w-80 mt-auto my-2">
                                        <span class="badge badge-danger p-3 fs-6 text-center">{{ __('rejected')}}</span>
                                    </div>
                                @endif
                                <!--end::Progress-->
                            </div>

                            <!--end::Stats-->
                        </div>
                        <!--end::Info-->
                    </div>
                    <!--end::Details-->
                    <div class="d-flex justify-content-between align-items-center">
                        <!--begin::Navs-->
                        <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder">
                            <!--begin::Nav item-->
                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5 {{!request()->has('config')?'active':""}}" data-bs-toggle="tab" href="#overview">{{ __('overview')}}</a>
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            @if ($is_live)

                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" href="#restuarant_orders">{{ __('orders')}}</a>
                            </li>
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" href="#customers">{{ __('customers')}}</a>
                            </li>
                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" href="#delivery_companies">{{ __('Delivery companies')}}</a>
                            </li>
                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5 {{request()->has('config')?'active':""}}" data-bs-toggle="tab" href="#config">{{ __('configurations')}}</a>
                            </li>
                            <li class="nav-item mt-2">
                                <a class="nav-link text-active-primary ms-0 me-10 py-5" data-bs-toggle="tab" href="#tap">{{ __('Payment gateway')}}</a>
                            </li>
                            @endif
                            <!--end::Nav item-->
                            <!--begin::Nav item-->
                            <!-- <li class="nav-item mt-2">
                                    <a class="nav-link text-active-primary ms-0 me-10 py-5" href="./logs.html">Logs</a>
                                </li> -->
                            <!--end::Nav item-->
                        </ul>
                        <!--begin::Navs-->
                    </div>

                    <div class="tab-content">
                        <div class="tab-pane fade  {{!request()->has('config')?'active show':""}}" id="overview" role="tab-panel">
                            @include('admin.Restaurants.Overview.view',['sub'=>$subscription])
                        </div>
                        <div class="tab-pane fade" id="restuarant_orders" role="tab-panel">
                            @include('admin.Restaurants.Orders.view')
                        </div>
                        <div class="tab-pane fade" id="customers" role="tab-panel">
                            @include('admin.Restaurants.Customer.view')
                        </div>
                        <div class="tab-pane fade delivery_companies" id="delivery_companies" role="tab-panel">
                            @include('admin.Restaurants.Delivery_companies.view')
                        </div>
                        <div class="tab-pane fade config {{request()->has('config')?'active show':""}}" id="config" role="tab-panel">
                            @include('admin.Restaurants.Configurations.config')
                        </div>

                        <div class="tab-pane fade tap" id="tap" role="tab-panel">
                            @include('admin.Restaurants.Configurations.tap-setting')
                        </div>
                    </div>
                </div>
                <!--end::Container-->
            </div>
            <!--end::Post-->
        </div>
    </div>
</div>
@endsection

@section('js')
<link rel="stylesheet" href="{{ global_asset('assets/css/data-tree.css')}}" />

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="{{ global_asset('assets/js/data-tree.js')}}"></script>
<script>
new DataTree({
    fpath:'{{route("admin.view-restaurants-tap-lead",["tenant"=>$restaurant->id])}}',
    container:'#tree',
    json:true
});
</script>
@endsection

@section('javascript')
<script>
    function ActiveRestuarant(event) {
        event.preventDefault();
        if (document.getElementById('approve-form').dataset.loading === "true") {
            Swal.fire('Action is already in progress!', '', 'danger')
            return;
        }
        Swal.fire({
            title: '{{ __('confirm-approval') }}'
            , text: '{{ __('are-you-sure-you-want-to-approve-this-restaurant') }}'
            , icon: 'warning'
            , showCancelButton: true
            , confirmButtonText: '{{ __('yes-approve-it') }}'
            , cancelButtonText: '{{ __('cancel') }}'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('approve-form').dataset.loading = "true";
                document.getElementById('approve-form').submit();
            }
        })
    }
    document.addEventListener('DOMContentLoaded', function() {

        $("#active_restuarant").on('click', ActiveRestuarant);

        var confirmButtons = document.querySelectorAll('.btn-confirm');
        confirmButtons.forEach(function(button) {
            button.addEventListener('click', function(event) {
                event.preventDefault();
                if (document.getElementById('approve-form').dataset.loading === "true"){
                    Swal.fire('Action is already in progress!', '', 'danger')
                    return;
                }
                Swal.fire({
                    title: "{{ __('you-wont-be-able-to-undo-this') }}",
                    showCancelButton: true,
                    confirmButtonText: '{{ __('yes-proceed') }}',
                    cancelButtonText: '{{ __('no-cancel') }}',
                    html: `
                        <div class="form-check my-2">
                            <input type="checkbox" class="form-check-input" id="commercial_registration" name="options[]" value="commercial_registration">
                            <label class="form-check-label" for="commercial_registration">{{ __('commercial-registration') }}</label>
                        </div>
                        <div class="form-check my-2">
                            <input type="checkbox" class="form-check-input" id="commercial_registration_number" name="options[]" value="commercial_registration_number">
                            <label class="form-check-label" for="commercial_registration_number">{{ __('commercial-registration-number') }}</label>
                        </div>
                        <div class="form-check my-2">
                            <input type="checkbox" class="form-check-input" id="tax_registration_certificate" name="options[]" value="tax_registration_certificate">
                            <label class="form-check-label" for="tax_registration_certificate">{{ __('tax-number') }}</label>
                        </div>
                        <div class="form-check my-2">
                            <input type="checkbox" class="form-check-input" id="bank_certificate" name="options[]" value="bank_certificate">
                            <label class="form-check-label" for="bank_certificate">{{ __('bank-certificate') }}</label>
                        </div>

                        <div class="form-check my-2">
                            <input type="checkbox" class="form-check-input" id="IBAN" name="options[]" value="IBAN">
                            <label class="form-check-label" for="IBAN">{{ __('IBAN') }}</label>
                        </div>
                        <div class="form-check my-2">
                            <input type="checkbox" class="form-check-input" id="identity_of_owner_or_manager" name="options[]" value="identity_of_owner_or_manager">
                            <label class="form-check-label" for="identity_of_owner_or_manager">{{ __('identity_of_owner_or_manager') }}</label>
                        </div>
                        <div class="form-check my-2">
                            <input type="checkbox" class="form-check-input" id="national_id_number" name="options[]" value="national_id_number">
                            <label class="form-check-label" for="national_id_number">{{ __('National ID') }}</label>
                        </div>
                        <div class="form-check my-2">
                            <input type="checkbox" class="form-check-input" id="dob" name="options[]" value="dob">
                            <label class="form-check-label" for="dob">{{ __('Date of birth') }}</label>
                        </div>
                        <div class="form-check my-2">
                            <input type="checkbox" class="form-check-input" id="national_address" name="options[]" value="national_address">
                            <label class="form-check-label" for="national_address">{{ __('national_address') }}</label>
                        </div>
                        <div class="form-check my-2">
                            <input type="checkbox" class="form-check-input" id="others" name="options[]" value="others">
                            <label class="form-check-label" for="others">{{ __('others') }}</LABEL>
                        </div>
                    `,
                    preConfirm: function() {
                        var selectedOptions = [];
                        document.querySelectorAll('input[name="options[]"]:checked').forEach(function(checkbox) {
                            selectedOptions.push(checkbox.value);
                        });
                        return selectedOptions;
                    },
                    allowOutsideClick: false,
                    allowEscapeKey: false
                }).then((result) => {
                    if (result.isConfirmed && result.value.length > 0) {
                        var form = event.target.closest('form');
                        var selectedOptions = result.value;
                        selectedOptions.forEach(function(option) {
                            form.insertAdjacentHTML('beforeend', '<input type="hidden" name="options[]" value="' + option + '">');
                        });
                        form.submit();
                    }
                });
            });
        });
    });
</script>
@stop
