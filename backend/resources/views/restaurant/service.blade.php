@extends('layouts.restaurant-sidebar')

@section('title', __('services'))

@section('content')
@push("styles")
<style>
    .btn:not(.btn-outline):not(.btn-dashed):not(.border-hover):not(.border-active):not(.btn-flush):not(.btn-icon) {
        padding: calc(0.75rem + 2px) calc(1.5rem + 1px);
    }
    .customer-app-card {
        border: 1px solid #c2da08;
    }

    .selected-card {
        background-color: #c2da08;
        color: #fff;
    }

    /* Custom CSS for radio buttons */
    .radio-container {
        display: inline-block;
    }

    .radio-container input[type="radio"] {
        display: none;
    }

    .radio-container label {
        display: block;
        cursor: pointer;
        text-align: center;
        border: 1px solid #525a4d;
        padding: .375rem .75rem;
        margin-bottom: 0;
        width: 100%;
    }

    .radio-container input[type="radio"]:checked+label {
        background-color: #525a4d !important;
        color: #fff;
    }

    .bg-khardl-grey {
        background-color: #525a4d !important;
    }

    .mt-45 {
        margin-top: 45px;
    }

</style>
<link href="https://goSellJSLib.b-cdn.net/v2.0.0/css/gosell.css" rel="stylesheet" />
<link href="{{ global_asset('js/custom/creditCard/main.css')}}" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="https://goSellJSLib.b-cdn.net/v2.0.0/js/gosell.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

@endpush
@push('scripts')
<script>
    function submitPayment(e, containerID) {
        loadedContainer = containerID;
        // var waiting = document.querySelector('#waiting-item');
        // waiting.style.display = 'block';
        // var submitButton = document.getElementById('tap-btn');
        // submitButton.disabled = true;

        e.preventDefault();
        goSell.submit();
        // setTimeout(() => {
        //     waiting.style.display = 'none';
        //     submitButton.disabled = false;
        // }, 2000);


    }
    goSell.goSellElements({
        containerID: "root"
        , gateway: {
            callback: function(event) {
                var waiting = document.querySelector('#waiting-item');
                var submitButton = document.getElementById('tap-btn');
                waiting.style.display = 'block';
                submitButton.disabled = true;
                if (event.card.id) {


                    if (loadedContainer == 'root') {
                        document.getElementById('n_branches').value = document.getElementById('n_branches').value;
                        document.getElementById('type').value = document.getElementById('type').value;
                        document.getElementById('token_id').value = event.id;
                        document.getElementById('pay').submit();
                    } else {
                        document.getElementById('customer_app_token_id').value = event.id;
                        document.getElementById('pay_customer_app').submit();
                    }

                }
            }
            , publicKey: "{{ env('TAP_PUBLIC_API_KEY') }}"
            , language: "{{ app()->getLocale() }}"
            , supportedCurrencies: "all"
            , supportedPaymentMethods: "all"
            , notifications: 'standard'
            , style: {
                base: {
                    color: '#535353'
                    , lineHeight: '18px'
                    , fontFamily: 'sans-serif'
                    , fontSmoothing: 'antialiased'
                    , fontSize: '16px'
                    , '::placeholder': {
                        color: 'rgba(0, 0, 0, 0.26)'
                        , fontSize: '15px'
                    }
                }
                , invalid: {
                    color: 'red'
                    , iconColor: '#fa755a'
                }
            }
        }
    });

    function openModal(modalID) {

        var modalContent = $('#' + modalID).html();

        $('#modal_base_content').html(modalContent);
        if (modalID == 'kt_modal_renew_sub') {
            @if($RO_subscription && $RO_subscription->status == \App\Models\ROSubscription::ACTIVE)
            calculateRenewPrice();
            @endif
        }

        $('#kt_modal_default').modal('show');

        $('input[name="customer_app_sub_option"]').change(function() {
            var selectedValue = $(this).val();
            $('.customer-app-card').removeClass('selected-card');
            $('.card[data-value="' + selectedValue + '"]').addClass('selected-card');
            emptyCouponApp();

        });

        $('.customer-app-card').click(function() {
            $('.customer-app-card').removeClass('selected-card');
            $(this).addClass('selected-card');

            var selectedValue = $(this).data('value');

            $('input[name="customer_app_sub_option"][value="' + selectedValue + '"]').prop('checked', true).trigger('change');

        });
    }

</script>

@endpush

<div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">

    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">
            <!--begin::Wrapper-->
            <div class=" d-flex flex-column flex-row-fluid" id="kt_wrapper">
                <!--begin::Header-->

                <!--end::Header-->
                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">
                    <!--begin::Post-->
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <!--begin::Container-->
                        <div id="kt_content_container" class="container-xxl">
                            <!--begin::Pricing card-->
                            <div class="card" id="kt_pricing">
                                <!--begin::Card body-->
                                <div class="card-body p-lg-10">
                                    <!--begin::Plans-->
                                    <div class="row">

                                        <!--begin::Heading-->
                                        <div class="mb-5 text-center">
                                            <h1 class="fs-2hx fw-bolder mb-5">{{__('Enjoy benefiting from our services')}}</h1>
                                        </div>
                                        <!--end::Heading-->
                                        <div class="alert service-alert d-flex align-items-center" role="alert">
                                            <div class="service-alert-icon">
                                                <i class="bi bi-info-circle mx-2 text-white "></i>
                                            </div>
                                            <div>
                                                <span>
                                                    <h4>{{__('Login code')}}</h4>
                                                    {{__('login code for your restaurant to login to the orders app and drivers app')}} : <u><strong>{{ tenant()->mapper_hash }}</strong></u>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                       <!--begin::Row-->
                                       <div class="row g-10 service-content">
                                        <!--begin::Col branch slot -->
                                        <div class="col-md-6">
                                            <div class="row" style="min-height: 390px">
                                                <div class="col-md-6">
                                                    <div class="text-gray-400 fw-bold w-100">
                                                        <img src="{{ global_asset('images/default_package.svg') }}" class="w-100" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="mt-6">
                                                        <h1 class="text-dark mb-5 fw-boldest text-center">{{$subscription->name}}</h1>
                                                        @if($RO_subscription?->amount)
                                                        <h1>
                                                            <div class="mb-4">
                                                                <span class="mb-2 text-khardl">{{__('SAR')}}</span>
                                                                <span class="fs-2x fw-bolder text-khardl text-center">{{$subscription->amount}}</span>
                                                                /
                                                                {{ __('Branch') }}
                                                            </div>
                                                        </h1>

                                                        @endif
                                                        <span class="text-dark my-5 fw-boldest text-center d-block text-muted">{{$subscription->description}}</span>
                                                    </div>
                                                </div>
                                                <!--begin::image-->

                                                <!--end::image-->
                                                <!--begin::Title-->
                                                <!--end::Title-->
                                                <!--begin::Price-->
                                                @if($RO_subscription->number_of_branches > 0)
                                                <div class="col-md-10">
                                                    <h6 class="fw-normal">{{__('Number of branches available to add')}}</h6>
                                                </div>
                                                <div class="col-md-2">
                                                    <strong>{{$RO_subscription->number_of_branches}}</strong>
                                                </div>
                                                @endif
                                                <div class="col-md-10">
                                                    <h6 class="fw-normal">{{__('Number of current active branches')}}</h6>
                                                </div>
                                                <div class="col-md-2">
                                                    <strong>{{$active_branches}}</strong>
                                                </div>

                                                <!--end::Modal dialog-->
                                                @if($RO_subscription?->status == \App\Models\ROSubscription::ACTIVE )
                                                <div class="col-md-12">
                                                    <a href="#" class="btn btn-sm btn-khardl w-100 m-0" onclick="openModal('kt_modal_renew_sub')">
                                                        {{__("Add more branches")}}
                                                    </a>
                                                </div>
                                                <div class="col-md-12">
                                                    <form action="{{route('restaurant.service.deactivate')}}" method="POST">
                                                        @csrf
                                                        <button href="#" type="submit" class="btn btn-sm btn-darken w-100 m-0">
                                                            {{__("Deactivate")}}
                                                        </button>
                                                        @method('PATCH')
                                                    </form>
                                                </div>
                                                @elseif($RO_subscription?->status == \App\Models\ROSubscription::ACTIVE && $RO_subscription->end_at->isPast())
                                                <div class="col-md-12">
                                                    <a href="#" class="btn btn-sm btn-khardl w-100 m-0" onclick="openModal('kt_modal_suspend_sub')">
                                                        {{__('Renew Subscription')}}
                                                    </a>
                                                </div>

                                                @elseif($RO_subscription?->status == \App\Models\ROSubscription::DEACTIVATE)
                                                <div class="col-md-12">
                                                    <form action="{{route('restaurant.service.activate')}}" method="POST">
                                                        @csrf
                                                        <button href="#" type="submit" class="btn btn-sm btn-khardl w-100 m-0">{{__("Activate")}}</button>
                                                        @method('PATCH')
                                                    </form>
                                                </div>
                                                @elseif($RO_subscription?->status == \App\Models\ROSubscription::SUSPEND)
                                                <div class="col-md-12">
                                                    <a href="#" class="btn btn-sm btn btn-sm btn-khardl w-100 m-0" onclick="openModal('kt_modal_suspend_sub')"><svg style="margin-left:10px" xmlns="http://www.w3.org/2000/svg" height="16" width="16" fill="red" viewBox="0 0 512 512">
                                                        <path d="M256 32c14.2 0 27.3 7.5 34.5 19.8l216 368c7.3 12.4 7.3 27.7 .2 40.1S486.3 480 472 480H40c-14.3 0-27.6-7.7-34.7-20.1s-7-27.8 .2-40.1l216-368C228.7 39.5 241.8 32 256 32zm0 128c-13.3 0-24 10.7-24 24V296c0 13.3 10.7 24 24 24s24-10.7 24-24V184c0-13.3-10.7-24-24-24zm32 224a32 32 0 1 0 -64 0 32 32 0 1 0 64 0z" /></svg>{{__('Renew Subscription')}}
                                                    </a>
                                                </div>
                                                @else
                                                <div class="col-md-12">
                                                    <a href="#" class="btn btn-sm btn-khardl w-100 m-0" onclick="openModal('kt_modal_new_target')">{{__('Buy now')}}</a>
                                                </div>
                                                @endif
                                                <div class="modal fade" id="kt_modal_default" tabindex="-1" aria-hidden="true">
                                                    <div class="modal-dialog modal-dialog-centered mw-650px">
                                                        <!--begin::Modal content-->
                                                        <div class="modal-content rounded ">

                                                            <div class="modal-header pb-0 border-0  d-flex justify-content-end">

                                                                <div class="btn btn-sm btn-icon btn-active-color-khardl" data-bs-dismiss="modal">
                                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                                                    <span class="svg-icon svg-icon-1">
                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                                                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                                                                        </svg>
                                                                    </span>
                                                                    <!--end::Svg Icon-->
                                                                </div>

                                                            </div>
                                                            <div id="root"></div>
                                                            <p id="msg"></p>
                                                            <div class="modal-body" id="modal_base_content">

                                                            </div>



                                                        </div>
                                                    </div>
                                                </div>

                                                @if(!$RO_subscription)
                                                <div class="modal fade" id="kt_modal_new_target" tabindex="-1" aria-hidden="true">
                                                    <form action="{{route('tap.payments_submit_card_details')}}" method="POST" id="pay">
                                                        @csrf
                                                        <!--begin::Modal dialog-->
                                                        <div class="modal-dialog modal-dialog-centered mw-650px">
                                                            <!--begin::Modal content-->
                                                            <div class="modal-content rounded ">
                                                                <input type="hidden" name="type" id="type" value="{{\App\Models\ROSubscription::NEW}}">
                                                                <input type="hidden" name="token_id" id="token_id" value="">
                                                                <!--begin::Modal header-->
                                                                <div class="modal-header pb-0 border-0  d-flex justify-content-center">
                                                                    <h5 class="modal-title text-center">{{$subscription->name}}</h5>
                                                                </div>
                                                                <div class="modal-body">




                                                                    <div class="form-group mt-3">
                                                                        <label for="factor">{{__('Number of branches')}}</label>
                                                                        <input type="number" class="form-control" id="n_branches" name="n_branches" value="1" min="1" onchange="updatePrice()" required>
                                                                    </div>

                                                                    <div class="form-group">
                                                                        <label for="factor">{{__('Total Price')}}</label>
                                                                        <input type="text" class="form-control bg-secondary" id="price" name="price" value="{{ $subscription->amount }}" readonly>
                                                                    </div>

                                                                    <div class="col-md-12">
                                                                        <label class="badge bg-khardl justify-content-center">{{__('Add a coupon code')}}</label>
                                                                        <div>

                                                                            <div>
                                                                                {{-- <input type="text" name="coupon_code" value="" id="coupon_code_app" class="btn btn-outline btn-outline-dashed  p-3 d-flex align-items-center mb-10"  > --}}
                                                                                <div class="input-group mb-3">

                                                                                    <input type="text" style="width: 115px" name="coupon_code" value="" id="coupon_code_web" class="form-control">
                                                                                    <div class="input-group-prepend" id="input-group-web">
                                                                                        <a href="#" id="apply_copoun_web" class="btn btn-khardl rounded-0">{{__('Apply')}}</a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <h5 id="coupon_message_web" class="text-danger " style="margin-right: 15px"></h5>

                                                                            <div class="p-2 bd-highlight">
                                                                                <span class="indicator-progress " id="apply_copoun_web_spinner" style="margin-top: 10px">
                                                                                    <span class="spinner-border spinner-border-sm align-middle ms-2" style="width: 20px;height:20px"></span>
                                                                                </span>
                                                                            </div>

                                                                        </div>



                                                                    </div>
                                                                    <div id="discount_web"></div>


                                                                    <button id="tap-btn" type="submit" onclick="submitPayment(event,'root')" class="btn btn-khardl text-white ">

                                                                        <span class="indicator-label"> {{__("purchase")}} ✔️</span>
                                                                        <span class="indicator-progress" id="waiting-item">{{__('please-wait')}}
                                                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                                    </button>

                                                                </div>

                                                            </div>

                                                        </div>
                                                        <!--end::Modal body-->
                                                    </form>
                                                </div>

                                                @elseif($RO_subscription && $RO_subscription->status != \App\Models\ROSubscription::SUSPEND)
                                                <div class="modal fade" id="kt_modal_renew_sub" tabindex="-1" aria-hidden="true">
                                                    <form action="{{route('tap.payments_submit_card_details')}}" method="POST" id="pay">
                                                        @csrf
                                                        <!--begin::Modal dialog-->
                                                        <div class="modal-dialog modal-dialog-centered mw-650px">
                                                            <!--begin::Modal content-->
                                                            <div class="modal-content rounded ">
                                                                <input type="hidden" name="type" id="type" value="{{\App\Models\ROSubscription::RENEW_TO_CURRENT_END_DATE}}">
                                                                <input type="hidden" name="token_id" id="token_id" value="">

                                                                <!--begin::Modal header-->
                                                                <div class="modal-header pb-0 border-0  d-flex justify-content-center">
                                                                    <h5 class="modal-title text-center">{{$subscription->name}} ({{__('Adding new branches')}})</h5>

                                                                </div>
                                                                <div class="modal-body d-flex justify-content-center">

                                                                    <div class="row">
                                                                        <div class="col-12 mt-3 mb-2">
                                                                            <div class="card">
                                                                                <div class="card-body text-center text-bold font-weight-bold">
                                                                                    <strong>
                                                                                        <h3>{{ __('A period :period of term will be purchased to match the billing time',['period'=>$RO_subscription->dateLeft])}}</h3>
                                                                                    </strong>
                                                                                </div>
                                                                            </div>




                                                                        </div>
                                                                        <div class="col-12">
                                                                            <div class="form-group">
                                                                                <label for="factor">{{__('Number of branches')}}</label>
                                                                                <input type="number" class="form-control" id="n_branches" name="n_branches" value="1" min="1" onchange="calculateRenewPrice()">
                                                                            </div>
                                                                        </div>


                                                                        <div class="col-12 mt-3">
                                                                            <label for="factor">{{__('Total Price')}} </label>
                                                                            <input type="text" class="form-control bg-secondary" id="price" name="price" value="" readonly>
                                                                            <i id="costDesc" class="hidden"></i>
                                                                        </div>

                                                                        <div class="col-12 mt-3">
                                                                            <button id="tap-btn" id="kt_modal_new_target_submit" type="submit" style="width:200px" onclick="submitPayment(event,'root')" class="btn btn-khardl text-white ">

                                                                                <span class="indicator-label">{{__('Buy New branch')}} ✔️</span>
                                                                                <span class="indicator-progress" id="waiting-item">{{__('please-wait')}}
                                                                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                                            </button>


                                                                        </div>

                                                                    </div>



                                                                </div>

                                                            </div>
                                                        </div>
                                                        <!--end::Modal body-->
                                                    </form>
                                                </div>

                                                @elseif($RO_subscription && $RO_subscription->status == \App\Models\ROSubscription::SUSPEND)
                                                <div class="modal fade" id="kt_modal_suspend_sub" tabindex="-1" aria-hidden="true">

                                                    <!--begin::Modal dialog-->
                                                    <form action="{{route('tap.payments_submit_card_details')}}" method="POST" id="pay">
                                                        @csrf
                                                        <div class="modal-dialog modal-dialog-centered mw-650px">
                                                            <!--begin::Modal content-->
                                                            <div class="modal-content rounded ">
                                                                <input type="hidden" name="type" id="type" value="{{\App\Models\ROSubscription::RENEW_AFTER_ONE_YEAR}}">
                                                                <input type="hidden" class="form-control" id="n_branches" name="n_branches" value="0">
                                                                <input type="hidden" name="token_id" id="token_id" value="">

                                                                <!--begin::Modal header-->
                                                                <div class="modal-header pb-0 border-0  d-flex justify-content-center">
                                                                    <h5 class="modal-title text-center">{{$subscription->name}} ({{__('Renew Subscription')}})</h5>
                                                                </div>

                                                                <p class="text-khardl text-center">({{$subscription->amount}}* {{$total_branches}} {{__('branch ')}} ) </p>
                                                                @if($non_active_branches > 0)
                                                                <strong class="text-warning text-center bg-danger">{{__('Inactivated branches will be archived until purchased again. Please make sure to activate the branches you may need before renewing.')}}</strong>
                                                                @endif
                                                                <div class="modal-body d-flex justify-content-center">
                                                                    <div class="row">

                                                                        <div class="col-12 mt-3">
                                                                            <label for="factor">{{__('Total Price')}} </label>
                                                                            <input type="text" readonly class="form-control bg-secondary" id="price" name="price" value="{{$amount}}" readonly>

                                                                        </div>
                                                                        <div class="col-12 mt-3">
                                                                            <div class="d-flex justify-content-center">

                                                                                <button id="tap-btn" id="kt_modal_new_target_submit" type="submit" onclick="submitPayment(event,'root')" class="btn btn-khardl text-white ">

                                                                                    <span class="indicator-label">{{__("Renew Subscription")}}✔️</span>
                                                                                    <span class="indicator-progress" id="waiting-item">{{__('please-wait')}}
                                                                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                                                </button>

                                                                            </div>


                                                                        </div>

                                                                    </div>


                                                                </div>

                                                            </div>
                                                        </div>
                                                        <!--end::Modal body-->
                                                    </form>
                                                </div>
                                                @endif
                                                @if(!$ROCustomerAppSub)
                                                <div class="modal fade" id="kt_modal_customer_app" tabindex="-1" aria-hidden="true">
                                                    <form action="{{route('tap.payments_submit_customer_app')}}" method="POST" id="pay_customer_app">
                                                        @csrf
                                                        <input type="hidden" name="token_id" id="customer_app_token_id">
                                                        <!--begin::Modal dialog-->
                                                        <div class="modal-dialog modal-dialog-centered mw-650px">
                                                            <!--begin::Modal content-->
                                                            <div class="modal-content rounded">
                                                                <!--begin::Modal header-->
                                                                <div class="modal-header pb-0 border-0  d-flex justify-content-center">
                                                                    <h5 class="modal-title text-center">{{$customer_app_sub->name}}</h5>
                                                                </div>
                                                                <div class="modal-body">

                                                                    <div class="row">

                                                                        <div class="col-md-6">
                                                                            <div class=" text-center">
                                                                                <div class="radio-container">
                                                                                    <input class="form-check-input" checked type="radio" name="customer_app_sub_option" id="first-sub" value="is_application_purchase">
                                                                                    <label class="form-check-label" for="first-sub">{{__('Annual subscription')}}</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="card mb-3 customer-app-card selected-card" data-value="is_application_purchase">
                                                                                <div class="card-body">

                                                                                    <div class="form-group">
                                                                                        <label for="factor">{{__('Total Price')}}</label>
                                                                                        <input type="text" class="form-control bg-secondary" name="price" value="{{ $customer_app_sub->amount }}" readonly>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="text-center">
                                                                                <div class="radio-container">
                                                                                    <input class="form-check-input" type="radio" name="customer_app_sub_option" id="second-sub" value="is_lifetime_purchase">
                                                                                    <label class="form-check-label" for="second-sub"> <small>{{__('One time purchase for a lifetime')}}</small></label>

                                                                                </div>
                                                                            </div>
                                                                            <div class="card mb-3 customer-app-card" data-value="is_lifetime_purchase">
                                                                                <div class="card-body">
                                                                                    <div class="form-group">
                                                                                        <label for="factor">{{__('Total Price')}}</label>
                                                                                        <input type="text" class="form-control bg-secondary" name="price" value="{{ $lifetime_customer_app_sub?->amount }}" readonly>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-12">
                                                                            <label class="badge bg-khardl justify-content-center">{{__('Add a coupon code')}}</label>
                                                                            <div>

                                                                                <div>

                                                                                    <div class="p-2 bd-highlight">
                                                                                        {{-- <input type="text" name="coupon_code" value="" id="coupon_code_app" class="btn btn-outline btn-outline-dashed  p-3 d-flex align-items-center mb-10"  > --}}
                                                                                        <div class="input-group mb-3">

                                                                                            <input type="text" style="width: 115px" name="coupon_code" value="" id="coupon_code_app" class="form-control">
                                                                                            <div class="input-group-prepend" id="input-group-app">
                                                                                                <a href="#" id="apply_copoun_app" class="btn btn-khardl rounded-0">{{__('Apply')}}</a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>


                                                                                    <div id="coupon_message_app" class="text-danger "></div>
                                                                                    <div class="p-2 bd-highlight ">
                                                                                        <span class="indicator-progress " id="apply_copoun_app_spinner">
                                                                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                                                                        </span>
                                                                                    </div>

                                                                                </div>




                                                                            </div>

                                                                            <div id="discount_app"></div>
                                                                        </div>
                                                                    </div>



                                                                    <div class="mt-5">
                                                                        <button id="tap-btn" type="submit" onclick="submitPayment(event,'root_customer_app')" class="btn  btn-khardl text-white ">

                                                                            <span class="indicator-label"> {{__("purchase")}} ✔️</span>
                                                                            <span class="indicator-progress" id="waiting-item">{{__('please-wait')}}
                                                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                                        </button>

                                                                    </div>
                                                                </div>

                                                            </div>

                                                        </div>
                                                        <!--end::Modal body-->
                                                    </form>
                                                </div>
                                                @elseif($ROCustomerAppSub?->status == \App\Models\ROSubscription::SUSPEND )
                                                <div class="modal fade" id="kt_modal_suspend_app_sub" tabindex="-1" aria-hidden="true">
                                                    <form action="{{route('tap.payments_submit_customer_app')}}" method="POST" id="pay_customer_app">
                                                        @csrf
                                                        <input type="hidden" name="token_id" id="customer_app_token_id">
                                                        <!--begin::Modal dialog-->
                                                        <div class="modal-dialog modal-dialog-centered mw-650px">
                                                            <!--begin::Modal content-->
                                                            <div class="modal-content rounded">
                                                                <!--begin::Modal header-->
                                                                <div class="modal-header pb-0 border-0  d-flex justify-content-center">
                                                                    <h5 class="modal-title text-center">{{$customer_app_sub->name}} ({{__('Renew Subscription')}})</h5>
                                                                </div>
                                                                <div class="modal-body">



                                                                    <div class="form-group">
                                                                        <div class="row">
                                                                            <div class="col-md-6 text-center">
                                                                                <div class="radio-container">
                                                                                    <input class="form-check-input" type="radio" name="customer_app_sub_option" id="first-sub" value="is_application_purchase">
                                                                                    <label class="form-check-label" for="first-sub">{{__('Annual subscription')}}</label>
                                                                                </div>
                                                                            </div>
                                                                            <div class="col-md-6 text-center">
                                                                                <div class="radio-container">
                                                                                    <input class="form-check-input" type="radio" name="customer_app_sub_option" id="second-sub" value="is_lifetime_purchase">
                                                                                    <label class="form-check-label" for="second-sub">{{__('Lifetime subscription')}}</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">

                                                                        <div class="col-md-6">
                                                                            <div class="card mb-3 customer-app-card" data-value="is_application_purchase">
                                                                                <div class="card-body">

                                                                                    <div class="form-group">
                                                                                        <label for="factor">{{__('Total Price')}}</label>
                                                                                        <input type="text" class="form-control bg-secondary" name="price" value="{{ $customer_app_sub->amount }}" readonly>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="card mb-3 customer-app-card" data-value="is_lifetime_purchase">
                                                                                <div class="card-body">
                                                                                    <div class="form-group">
                                                                                        <label for="factor">{{__('Total Price')}}</label>
                                                                                        <input type="text" class="form-control bg-secondary" name="price" value="{{ $lifetime_customer_app_sub?->amount }}" readonly>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                    <button id="tap-btn" type="submit" onclick="submitPayment(event,'root_customer_app')" class="btn btn-khardl text-white ">


                                                                        <span class="indicator-label">{{__("Renew Subscription")}}✔️</span>
                                                                        <span class="indicator-progress" id="waiting-item">{{__('please-wait')}}
                                                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                                    </button>

                                                                </div>

                                                            </div>

                                                        </div>
                                                        <!--end::Modal body-->
                                                    </form>
                                                </div>
                                                @endif
                                                <!--end::Select-->
                                            </div>
                                        </div>
                                        <!--end::Col branch slot-->
                                        <div class="col-md-6">
                                            <div class="row" style="min-height: 390px">
                                                <div class="col-md-6">
                                                    @if($ROCustomerAppSub?->icon)
                                                    <div class="w-100">
                                                        <img src="{{ $ROCustomerAppSub->icon }}" class="w-100" alt="">
                                                    </div>
                                                    @else
                                                    <div class="w-100">
                                                        <img src="{{ global_asset('images/app_image.svg') }}" class="w-100" alt="">
                                                    </div>
                                                    @endif
                                                </div>
                                                <div class="col-md-6">
                                                    <h1 class="text-dark my-3 fw-boldest text-center mt-4">{{$customer_app_sub->description}}</h1>
                                                    <!--end::Title-->
                                                    <!--begin::Price-->
                                                    <div class="text-center my-5">

                                                        <h2 class="fw-boldest text-center text-khardl mt-3">{{$customer_app_sub->amount}} / {{$lifetime_customer_app_sub?->amount }} {{__('SAR')}}</h2>

                                                    </div>
                                                </div>
                                                @if($ROCustomerAppSub?->status != \App\Models\ROSubscription::SUSPEND )
                                                <div class="col-md-12">
                                                    <div class="d-flex justify-content-center p-2 mt-20">
                                                        @if($ROCustomerAppSub?->android_url)
                                                        <div class="mr-auto p-2">
                                                            <div>
                                                                <a href="{{$ROCustomerAppSub->android_url}}">
                                                                    <img src="{{global_asset('images/logo_playstore.svg')}}" width="100" />
                                                                </a>
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @if($ROCustomerAppSub?->ios_url)
                                                        <div class="p-2">
                                                            <div>
                                                                <a href="{{$ROCustomerAppSub->ios_url}}">
                                                                    <img src="{{global_asset('images/logo_appstore.svg')}}" width="100" />
                                                                </a>
                                                            </div>
                                                        </div>
                                                        @endif
                                                    </div>
                                                </div>
                                                @endif

                                                @if($ROCustomerAppSub?->status == \App\Models\ROSubscription::ACTIVE )
                                                <div class="col-md-12">
                                                    <form action="{{route('restaurant.service.app.deactivate')}}" method="POST">
                                                        @csrf
                                                        <button href="#" type="submit" class="btn btn-sm btn-darken w-100">{{__("Deactivate")}}</button>
                                                        @method('PATCH')
                                                    </form>
                                                </div>
                                                @elseif($ROCustomerAppSub?->status == \App\Models\ROSubscription::DEACTIVATE)
                                                <div class="col-md-12">
                                                    <form action="{{route('restaurant.service.app.activate')}}" method="POST">
                                                        @csrf
                                                        <button href="#" type="submit" class="btn btn-sm btn-khardl w-100">{{__("Resume")}}</button>
                                                        @method('PATCH')
                                                    </form>
                                                </div>

                                                @elseif($ROCustomerAppSub?->status == \App\Models\ROCustomerAppSub::REQUESTED )
                                                <div class="alert service-alert d-flex align-items-center" role="alert">
                                                    <div class="service-alert-icon">
                                                        <i class="bi bi-info-circle mx-2 text-white "></i>
                                                    </div>
                                                    <div>
                                                        <span>
                                                            {{__('Your request has been sent to the admin and the applications will be activated soon')}}
                                                        </span>
                                                    </div>
                                                </div>
                                                @elseif($ROCustomerAppSub?->status == \App\Models\ROCustomerAppSub::SUSPEND )
                                                <div class="col-md-12">
                                                    <a href="#" class="btn btn-sm btn-khardl w-100 " onclick="openModal('kt_modal_suspend_app_sub')">
                                                    {{__('Renew Subscription')}}
                                                    </a>
                                                </div>
                                                @else
                                                <div class="col-md-12">
                                                    <a href="#" class="btn btn-sm btn-khardl w-100" data-bs-toggle="modal" onclick="openModal('kt_modal_customer_app')">
                                                        {{__('Buy now')}}
                                                    </a>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <!--begin::Col-->
                                        <div class="col-md-6">
                                            <div class="row" style="min-height: 390px">
                                                <div class="col-md-6 mt-6">
                                                    <div class="w-100">
                                                        <img src="{{ global_asset('images/order_recieve.svg') }}" class="w-100" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mt-6">
                                                    <h1 class="text-dark my-6fw-boldest text-center">{{__('Order receiving application')}}</h1>
                                                    <!--end::Title-->
                                                    <!--begin::Price-->
                                                    <div class="text-center">
                                                        <span class="fs-2x fw-bolder text-khardl text-center">{{__('Free')}}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="w-100">
                                                        <span class="d-block fw-bolder text-muted text-center">{{__('Download now :')}} </span>
                                                    </div>
                                                    <div class="d-flex justify-content-center p-2">
                                                        <div class="mr-auto p-2">
                                                            <div>
                                                                <a href="https://play.google.com/store/apps/details?id=com.khardl.orders" target="_blank">
                                                                    <img src="{{global_asset('images/logo_playstore.svg')}}" width="100" />
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="p-2">
                                                            <div>
                                                                <a href="https://apps.apple.com/us/app/khardl-orders/id6478204383" target="_blank">
                                                                    <img src="{{global_asset('images/logo_appstore.svg')}}" width="100" />
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="row" style="min-height: 390px">
                                                <div class="col-md-6 mt-6">
                                                    <div class="w-100">
                                                        <img src="{{ global_asset('images/driver_image.svg') }}" class="w-100" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-md-6 mt-6">
                                                    <h1 class="text-dark my-6fw-boldest text-center">{{__('Driver application')}}</h1>
                                                    <!--end::Title-->
                                                    <!--begin::Price-->
                                                    <div class="text-center">
                                                        <span class="fs-2x fw-bolder text-khardl text-center">{{__('Free')}}</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="w-100">
                                                        <span class="d-block fw-bolder text-muted text-center">{{__('Download now :')}} </span>
                                                    </div>
                                                    <div class="d-flex justify-content-center p-2">
                                                        <div class="mr-auto p-2">
                                                            <div>
                                                                <a href="https://play.google.com/store/apps/details?id=com.khardl.driver" target="_blank">
                                                                    <img src="{{global_asset('images/logo_playstore.svg')}}" width="100" />
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="p-2">
                                                            <div>
                                                                <a href="https://apps.apple.com/us/app/khardl-driver/id6499269932" target="_blank">
                                                                    <img src="{{global_asset('images/logo_appstore.svg')}}" width="100" />
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Row-->
                                    <!--end::Plans-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Pricing card-->
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





    <script>
        function applyCoupon() {
            $('#coupon_message_web').empty();
            var waiting = document.querySelector('#apply_copoun_web_spinner');
            waiting.style.display = 'block';
            setTimeout(() => {
                $.ajax({
                    type: 'GET'
                    , url: `{{ route('restaurant.service.coupon.check', ['coupon'=>':coupon','type'=>':type','number_of_branches'=>':number_of_branches']) }}`
                        .replace(':number_of_branches', document.getElementById('n_branches').value)
                        .replace(':coupon', document.getElementById('coupon_code_web').value)
                        .replace(':type', 'is_branch_purchase')
                    , success: function(response) {
                        if (response.cost) {

                            $('#coupon_message_web')

                                .removeClass('text-danger')
                                .append('<div class="form-group mt-5 "><label for="factor">{{__("Total Price after discount")}}</label><input type="text" class="form-control bg-secondary" id="coupon_discount_input_web" value="' + response.cost.toFixed(2) + '" readonly ></div>');
                            $('#input-group-web').html('<span class="input-group-text rounded-0 text-danger"  id="cancel_coupn_web">X</span>');

                        } else {

                            $('#coupon_message_web').append("{{__('Invalid coupon')}}");
                        }
                    }
                    , error: function(error) {
                        $('#coupon_code_web').css('background-color', 'crimson');
                        $('#coupon_message_web').append("{{__('Invalid coupon')}}");
                    }
                });
                waiting.style.display = 'none';
            }, 500);
        }

        function applyAppCoupon() {
            $('#coupon_message_app').empty();
            var waiting = document.querySelector('#apply_copoun_app_spinner');
            waiting.style.display = 'block';
            setTimeout(() => {
                $.ajax({
                    type: 'GET'
                    , url: `{{ route('restaurant.service.coupon.check', ['coupon'=>':coupon','type'=>':type']) }}`
                        .replace(':coupon', document.getElementById('coupon_code_app').value)
                        .replace(':type', $("input[name='customer_app_sub_option']:checked").val())
                    , success: function(response) {
                        if (response.cost) {
                            $('#coupon_message_app')

                                .removeClass('text-danger')
                                .append('<div class="form-group mt-5 "><label for="factor">{{__("Total Price after discount")}}</label><input type="text" class="form-control bg-secondary" value="' + response.cost + '" readonly ></div>');
                            $('#input-group-app').html('  <span class="input-group-text rounded-0 text-danger"  id="cancel_coupn_app">X</span>');
                        } else {

                            $('#coupon_message_app')
                                .addClass('text-danger');

                            $('#coupon_message_app').append("{{__('Invalid coupon')}}");
                        }
                    }
                    , error: function(error) {
                        $('#coupon_message_app').addClass('text-danger');
                        $('#coupon_message_app').append("{{__('Invalid coupon')}}");
                    }
                });
                waiting.style.display = 'none';
            }, 500);
        }
        $('#modal_base_content').on('click', '#apply_copoun_web', function(e) {
            applyCoupon();

        });
        $('#modal_base_content').on('click', '#apply_copoun_app', function(e) {
            applyAppCoupon();

        });
        $('#modal_base_content').on('click', '#cancel_coupn_web', function(e) {
            e.preventDefault();
            $('#coupon_message_web').empty();

            $('#input-group-web').html(`<a href="#" id="apply_copoun_web"   class="btn btn-khardl">{{__('Apply')}}</a>`);


        });
        $('#modal_base_content').on('click', '#cancel_coupn_app', function(e) {
            e.preventDefault();
            emptyCouponApp();
        });

        function emptyCouponApp() {
            $('#coupon_message_app').empty();
            $('#coupon_code_app')
                .val('');
            $('#input-group-app').html(`<a href="#" id="apply_copoun_app"   class="btn btn-khardl rounded-0">{{__('Apply')}}</a>`);
        }

        // Execute the AJAX request when the radio button changes
        $('input[name=n_branches]').change(function() {
            calculateRenewPrice();
        });
        $('#renewSubForm').on('submit', function(e) {
            e.preventDefault();
            BuyNewSlots();
        });

        function calculateRenewPrice() {
            $.ajax({
                type: 'GET'
                , url: `{{ route('restaurant.service.calculate', ['type' => ':type','number_of_branches'=>':number_of_branches','subscription_id'=>':subscription_id']) }}`
                    .replace(':type', '{{\App\Models\ROSubscription::RENEW_TO_CURRENT_END_DATE}}')
                    .replace(':subscription_id', '{{$subscription->id}}')
                    .replace(':number_of_branches', document.getElementById('n_branches').value)
                , success: function(response) {
                    const priceInput = document.getElementById('price');

                    if (response.remainingDaysCost) {
                        priceInput.value = response.cost;
                        $('#costDesc').show();
                        $('#costDesc').text("{{__('The price of renewing current branches')}}" +
                            response.remainingDaysCost + " + " +
                            "{{__('The price of new branches includes current branches for one year')}}" +
                            response.newBranches
                        );
                    } else {
                        priceInput.value = response.cost;

                        $('#costDesc').hide();
                    }

                }
                , error: function(error) {
                    console.error('Error calculating cost: ' + error.responseText);
                }
            });
        }

        function updatePrice() {
            const priceInput = document.getElementById('price');
            const factorInput = document.getElementById('n_branches');
            const factor = parseFloat(factorInput.value) || 1;
            var inputValue = $('#coupon_discount_input_web').val();

            if (inputValue) {
                applyCoupon();
            }
            priceInput.value = "{{$subscription->amount}}" * factor;


        }

    </script>
</div>
<!--end::Content-->
@endsection
