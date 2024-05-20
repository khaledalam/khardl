@extends('layouts.restaurant-sidebar')
@section('title', __('payments'))
@section('content')
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
@php
$tap_info = $settings->lead_response;
@endphp
@if ($settings->lead_id&&$settings->merchant_id)
@if ($settings->lead_response)
<!--begin::Content-->
<div class="accordion" id="accordionExample">

    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button bg-khardl text-white" type="button" data-bs-toggle="collapse" data-bs-target="#paid_orders" aria-expanded="true" aria-controls="paid_orders">
                {{ __('Online paid orders') }}
            </button>
        </h2>
        <div id="paid_orders" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <!--begin::Content-->
                @if($orders?->count())
                <div class="d-flex flex-column gap-7 gap-lg-10">
                    <!--begin::Order history-->
                    <div class="card card-flush py-4 flex-row-fluid">
                        <form action="">
                            @csrf
                            <div class="modal fade show d-none" id="spinner" tabindex="-1" aria-hidden="false">
                                <!--begin::Modal dialog-->
                                <div class="modal-dialog modal-dialog-centered mw-650px">
                                    <!--begin::Modal content-->
                                    <div class="spinner-border m-auto" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                    <!--end::Modal content-->
                                </div>
                                <!--end::Modal dialog-->
                            </div>

                            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                <!--begin::Card title-->
                                <div class="card-title">
                                    <h2>{{ __('Orders') }}</h2>
                                </div>
                                <!--end::Card title-->


                                <!--begin::Card toolbar-->
                                <div class="card-toolbar flex-row-fluid justify-content-start gap-5" @if(app()->getLocale() === 'ar') style=" flex-direction: revert;" @endif>
                                    <!--begin::Search-->
                                    <div class="d-flex align-items-center position-relative my-1">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                        <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                        <input type="text" name="search" value="{{ request('search')??'' }}" class="form-control form-control-solid w-250px ps-14" placeholder="{{__('search')}}" />
                                    </div>
                                    <div class="w-100 mw-150px">
                                        <!--begin::Select2-->
                                        <select class="form-select form-select-solid" name="date_string">
                                            <option value="">{{ __('Date') }}</option>
                                            <option value="today" {{ request('date_string') =='today' ? 'selected':'' }}>{{ __('Today') }}</option>
                                            <option value="last_day" {{ request('date_string') =='last_day' ? 'selected':'' }}>{{ __('Last day') }}</option>
                                            <option value="last_week" {{ request('date_string') =='last_week' ? 'selected':'' }}>{{ __('Last week') }}</option>
                                        </select>
                                        <!--end::Select2-->
                                    </div>
                                    <button class="btn btn-khardl" type="submit">{{ __('Search') }}</button>
                                    <form method="GET">
                                        @csrf
                                        <div class="d-flex my-0">
                                            <input type="hidden" name="download" value="orders_csv">
                                            <button type="submit" id="download_app_transactions" class="btn btn-khardl mx-2">
                                                <span class="indicator-label">{{ __('Download') }} <i class="fa fa-download"></i></span>
                                                <span class="indicator-progress">{{ __('please-wait')}}
                                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                                <!--end::Card toolbar-->
                            </div>
                        </form>


                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                    <!--begin::Table head-->
                                    <thead>
                                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                            <th class="w-10px pe-2">
                                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                    <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_ecommerce_sales_table .form-check-input" value="1" />
                                                </div>
                                            </th>
                                            <th class="min-w-100px">{{ __('ID') }}</th>
                                            <th class="min-w-175px">{{ __('Customer') }}</th>
                                            <th class="text-end min-w-100px">{{ __('Total') }}</th>
                                            <th class="text-end min-w-100px">{{ __('Date') }}</th>
                                        </tr>
                                    </thead>
                                    <!--end::Table head-->
                                    <!--begin::Table body-->
                                    <tbody class="fw-bold text-gray-600">
                                        @foreach($orders as $order)
                                        <!--begin::Table row-->
                                        <tr>
                                            <!--begin::Checkbox-->
                                            <td>
                                                <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                    <input class="form-check-input" type="checkbox" value="{{$order->id}}" />
                                                </div>
                                            </td>
                                            <!--end::Checkbox-->
                                            <!--begin::Order ID=-->
                                            <td data-kt-ecommerce-order-filter="order_id">
                                                <a href="{{route('restaurant.branch.order',['order'=>$order->id])}}" class="text-gray-800 text-hover-khardl fw-bolder">{{$order->id}}</a>
                                            </td>
                                            <!--end::Order ID=-->
                                            <!--begin::Customer=-->
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <!--begin:: Avatar -->
                                                    <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                        <a href="#">
                                                            <div class="symbol-label fs-3 bg-light-success text-success">L</div>
                                                        </a>
                                                    </div>
                                                    <!--end::Avatar-->
                                                    <div class="ms-5">
                                                        <!--begin::Title-->
                                                        <a href="{{route('restaurant.branch.order',['order'=>$order->id])}}" class="text-gray-800 text-hover-khardl fs-5 fw-bolder">
                                                            {{$order?->manual_order_first_name
                                                            ? $order?->manual_order_first_name . ' ' . $order?->manual_order_last_name
                                                            : $order?->user->fullName}}
                                                            @if($order?->manual_order_first_name)
                                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="{{__('Manual order name')}}"></i>
                                                            @endif
                                                        </a>
                                                        <!--end::Title-->
                                                    </div>
                                                </div>
                                            </td>
                                            <!--begin::Total=-->
                                            <td class="text-end pe-0">
                                                <span class="fw-bolder">{{$order->total}} {{__('sar')}}</span>
                                            </td>
                                            <!--end::Total=-->
                                            <!--begin::Date Added=-->
                                            <td class="text-end" data-order="2022-03-22">
                                                <span class="fw-bolder">{{$order->created_at?->format('Y-m-d')}}</span>
                                            </td>
                                            <!--end::Date Added=-->
                                        </tr>
                                        <!--end::Table row-->
                                        @endforeach
                                    </tbody>
                                    <!--end::Table head-->
                                </table>
                                {{ $orders->withQueryString()->links('pagination::bootstrap-4') }}
                                <!--end::Table-->
                            </div>
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Order history-->

                </div>
                @else
                <div class="alert alert-warning text-center">
                    <h4>{{ __('You do not have any online paid orders yet') }}</h4>
                </div>
                @endif

            </div>
        </div>
    </div>

    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button bg-khardl text-white" type="button" data-bs-toggle="collapse" data-bs-target="#subscriptions" aria-expanded="true" aria-controls="subscriptions">
                {{ __('Your subscription') }}
            </button>
        </h2>
        <div id="subscriptions" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <!--begin::Content-->
                @if($ROSubscription)
                <div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">
                    <!--begin::Post-->
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <!--begin::Container-->
                        <div id="kt_content_container" class="container-xxl">
                            <!--begin::Row-->
                            <div class="row">

                                <!--begin::Col-->
                                <div class="col-md-12">
                                    <!--begin::Subtitle-->
                                    <span class="text-gray-900 pt-3 fw-bolder    fs-17"><i class=""></i> {{ __('Current subscription') }}</span>
                                    <!--end::Subtitle-->
                                    <!--begin::Info-->
                                    <div class="card-body">
                                        <!--begin::Scroll-->
                                        <div class="hover-scroll-overlay-y">
                                            <!--begin::Table-->
                                            <table class="table align-middle table-row-dashed fs-6 gy-3" id="kt_table_widget_5_table">
                                                <!--begin::Table head-->
                                                <thead>
                                                    <!--begin::Table row-->
                                                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                                        <th class="text-start pe-3 min-w-100px">{{ __('Key') }}</th>
                                                        <th class="text-start pe-3 min-w-100px">{{ __('Value') }}</th>
                                                    </tr>
                                                    <!--end::Table row-->
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody class="fw-bolder text-gray-600">
                                                    <!--begin::Item-->
                                                    <tr>
                                                        <td>
                                                            <span class="text-start">{{__('Number of remain available branches')}}</span>
                                                        </td>
                                                        <td class="text-dark">
                                                            <span class="py-3 px-4 fs-23">{{ $ROSubscription?->number_of_branches }}</span>
                                                        </td>
                                                    </tr>
                                                    <!--end::Item-->
                                                    @if(isset($ROSubscription?->subscription?->name))
                                                    <!--begin::Item-->
                                                    <tr>
                                                        <td>
                                                            <span class="text-start">{{__('Package')}}</span>
                                                        </td>
                                                        <td class="text-dark">
                                                            <span class="py-3 px-4 fs-23">{{ $ROSubscription?->subscription?->name }}</span>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                    <!--end::Item-->
                                                    <!--begin::Item-->
                                                    <tr>
                                                        <td>
                                                            <span class="text-start">{{__('Price')}}</span>
                                                        </td>
                                                        <td class="text-dark">
                                                            @if($ROSubscription?->discount)
                                                            <div class="d-flex flex-row">
                                                                <div class="p-2">
                                                                    <p class="text-decoration-line-through">
                                                                        {{$ROSubscription?->amount}} {{__('SAR')}}
                                                                    </p>
                                                                </div>
                                                                <div class="p-2">
                                                                    <p>{{$ROSubscription?->discount}} {{__('SAR')}}</p>
                                                                </div>
                                                            </div>


                                                            @else
                                                            <span class="py-3 px-4 fs-23">{{ $ROSubscription?->amount }} {{ __('SAR') }}</span>

                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <!--end::Item-->
                                                    <!--begin::Item-->
                                                    <tr>
                                                        <td>
                                                            <span class="text-start">{{__('Start date')}}</span>
                                                        </td>
                                                        <td class="text-dark">
                                                            <span class="py-3 px-4 fs-23">{{ $ROSubscription?->start_at?->format('Y-m-d') }}</span>
                                                        </td>
                                                    </tr>
                                                    <!--end::Item-->
                                                    <!--begin::Item-->
                                                    <tr>
                                                        <td>
                                                            <span class="text-start">{{__('End date')}}</span>
                                                        </td>
                                                        <td class="text-dark">
                                                            <span class="py-3 px-4 fs-23">{{ $ROSubscription?->end_at?->format('Y-m-d') }}</span>
                                                        </td>
                                                    </tr>
                                                    <!--end::Item-->
                                                    <!--begin::Item-->
                                                    <tr>
                                                        <td>
                                                            <span class="text-start">{{__('Status')}}</span>
                                                        </td>
                                                        <td>
                                                            @if($ROSubscription?->status == 'active')
                                                            <span class="py-3 px-4 fs-23 badge badge-success">{{ __(''.$ROSubscription?->status) }}</span>
                                                            @else
                                                            <span class="py-3 px-4 fs-23 badge badge-danger">{{ __(''.$ROSubscription?->status) }}</span>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <!--end::Item-->
                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Scroll-->
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Modals-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Post-->
                </div>
                @else
                <div class="alert alert-warning text-center">
                    <h4>{{ __('You do not have subscription') }}</h4>
                    <p>{{ __('You can subscription now') }}</p>
                    <a href="{{ route('restaurant.service') }}">
                        <button type="button" class="btn btn-khardl btn-sm">{{ __('View services') }}</button>
                    </a>
                </div>
                @endif
                <hr>
                <!--end::Content-->
                @if($ROSubscriptionInvoices->count())
                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">
                    <!--begin::Post-->
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <!--begin::Container-->
                        <div id="kt_content_container" class="container-xxl">
                            <!--begin::Row-->
                            <div class="row g-12 g-xl-12 mb-xl-112">

                                <!--begin::Col-->
                                <div class="col-lg-12 col-xl-12 col-xxl-12 mb-8 mb-xl-0">
                                    <!--begin::Chart widget 3-->
                                    <div class="card card-flush overflow-hidden h-md-100">
                                        <!--begin::List widget 5-->
                                        <div class="card card-flush h-xl-100">
                                            <!--begin::Card header-->
                                            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                                <!--begin::Card title-->
                                                <div class="card-title">
                                                    <!--begin::Search-->
                                                    <div class="d-flex align-items-center position-relative my-1">
                                                        <h3>{{ __('Transactions') }}</h3>
                                                    </div>
                                                    <!--end::Search-->
                                                </div>
                                                <!--end::Card title-->
                                                <!--begin::Card toolbar-->
                                                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                                    <form method="GET">
                                                        @csrf
                                                        <div class="d-flex my-0">
                                                            <input type="hidden" name="download" value="csv">
                                                            <button type="submit" id="download_app_transactions" class="btn btn-khardl mx-2">
                                                                <span class="indicator-label">{{ __('Download') }} <i class="fa fa-download"></i></span>
                                                                <span class="indicator-progress">{{ __('please-wait')}}
                                                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                            </button>
                                                        </div>
                                                    </form>
                                                    <!--end::setting-->
                                                </div>
                                                <!--end::Card toolbar-->
                                            </div>
                                            <!--end::Card header-->
                                            <!--begin::Body-->
                                            <div class="card-body">
                                                <!--begin::Scroll-->
                                                <div class="hover-scroll-overlay-y">
                                                    <!--begin::Table-->
                                                    <table class="table align-middle table-row-dashed fs-6 gy-3" id="kt_table_widget_5_table">
                                                        <!--begin::Table head-->
                                                        <thead>
                                                            <!--begin::Table row-->
                                                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                                                <th class="text-start pe-3 min-w-100px">{{ __('Package') }}</th>
                                                                <th class="text-start pe-3 min-w-100px">{{ __('Status') }}</th>
                                                                <th class="text-start pe-3 min-w-100px">{{ __('Number of branches') }}</th>
                                                                <th class="text-start pe-3 min-w-100px">{{ __('Price') }}</th>
                                                                <th class="text-start pe-3 min-w-100px">{{ __('Date') }}</th>
                                                            </tr>
                                                            <!--end::Table row-->
                                                        </thead>
                                                        <!--end::Table head-->
                                                        <!--begin::Table body-->
                                                        <tbody class="fw-bolder text-gray-600">
                                                            @foreach ($ROSubscriptionInvoices as $invoice)
                                                            <tr>
                                                                <!--begin::Item-->
                                                                <td class="text-start">
                                                                    {{ $invoice->subscription?->name }}
                                                                </td>
                                                                <td class="text-start">
                                                                    @if($invoice->status =='active')
                                                                    <span class="py-3 px-4 fs-23 badge badge-khardl">{{ __(''.$invoice->status) }}</span>
                                                                    @else
                                                                    <span class="py-3 px-4 fs-23 badge badge-light-khardl">{{ __(''.$invoice->status) }}</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <span class="py-3 px-4 fs-23">
                                                                        {{ $invoice->number_of_branches }}
                                                                    </span>
                                                                </td>
                                                                <td class="text-start">
                                                                    @if($invoice?->discount)
                                                                    <div class="d-flex flex-row">
                                                                        <div class="p-2">
                                                                            <p class="text-decoration-line-through">
                                                                                {{$invoice?->amount}} {{__('SAR')}}
                                                                            </p>
                                                                        </div>
                                                                        <div class="p-2">
                                                                            <p>{{$invoice?->discount}} {{__('SAR')}}</p>
                                                                        </div>
                                                                    </div>


                                                                    @else
                                                                    <span class="py-3 px-4 fs-23">{{ $invoice?->amount }} {{ __('SAR') }}</span>

                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <a href="#" class="text-dark text-hover-khardl">{{ $invoice->created_at?->format('Y-m-d h:m A') }}</a>
                                                                </td>
                                                                <!--end::Item-->
                                                            </tr>
                                                            @endforeach

                                                        </tbody>
                                                        <!--end::Table body-->
                                                    </table>
                                                    <!--end::Table-->
                                                </div>
                                                <!--end::Scroll-->
                                            </div>
                                            <!--end::Body-->
                                        </div>
                                        <!--end::List widget 5-->
                                    </div>
                                    <!--end::Chart widget 3-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Modals-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Post-->
                </div>
                <!--end::Content-->
                @endif

            </div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button bg-khardl text-white" type="button" data-bs-toggle="collapse" data-bs-target="#customer-app" aria-expanded="true" aria-controls="customer-app">
                {{ __('Customer application') }}
            </button>
        </h2>
        <div id="customer-app" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <!--begin::Content-->
                @if($ROCustomerAppSubscription)
                <div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">
                    <!--begin::Post-->
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <!--begin::Container-->
                        <div id="kt_content_container" class="container-xxl">
                            <!--begin::Row-->
                            <div class="row">

                                <!--begin::Col-->
                                <div class="col-md-12">
                                    <!--begin::Subtitle-->
                                    <span class="text-gray-900 pt-3 fw-bolder    fs-17"><i class=""></i> {{ __('Current subscription') }}</span>
                                    <!--end::Subtitle-->
                                    <!--begin::Info-->
                                    <div class="card-body">
                                        <!--begin::Scroll-->
                                        <div class="hover-scroll-overlay-y">
                                            <!--begin::Table-->
                                            <table class="table align-middle table-row-dashed fs-6 gy-3" id="kt_table_widget_5_table">
                                                <!--begin::Table head-->
                                                <thead>
                                                    <!--begin::Table row-->
                                                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                                        <th class="text-start pe-3 min-w-100px">{{ __('Key') }}</th>
                                                        <th class="text-start pe-3 min-w-100px">{{ __('Value') }}</th>
                                                    </tr>
                                                    <!--end::Table row-->
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody class="fw-bolder text-gray-600">
                                                    <!--begin::Item-->

                                                    <!--end::Item-->
                                                    @if(isset($ROCustomerAppSubscription?->subscription?->name))
                                                    <!--begin::Item-->
                                                    <tr>
                                                        <td>
                                                            <span class="text-start">{{__('Package')}}</span>
                                                        </td>
                                                        <td class="text-dark">
                                                            <span class="py-3 px-4 fs-23">{{ $ROCustomerAppSubscription?->subscription?->name }}</span>
                                                        </td>
                                                    </tr>
                                                    @endif
                                                    <!--end::Item-->
                                                    <!--begin::Item-->
                                                    <tr>
                                                        <td>
                                                            <span class="text-start">{{__('Price')}}</span>
                                                        </td>
                                                        <td class="text-dark">
                                                            @if($ROCustomerAppSubscription?->discount)
                                                            <div class="d-flex flex-row">
                                                                <div class="p-2">
                                                                    <p class="text-decoration-line-through">
                                                                        {{$ROCustomerAppSubscription?->amount}} {{__('SAR')}}
                                                                    </p>
                                                                </div>
                                                                <div class="p-2">
                                                                    <p>{{$ROCustomerAppSubscription?->discount}} {{__('SAR')}}</p>
                                                                </div>
                                                            </div>


                                                            @else
                                                            <span class="py-3 px-4 fs-23">{{ $ROCustomerAppSubscription?->amount }} {{ __('SAR') }}</span>

                                                            @endif
                                                        </td>
                                                    </tr>
                                                    <!--end::Item-->
                                                    <!--begin::Item-->
                                                    <tr>
                                                        <td>
                                                            <span class="text-start">{{__('Start date')}}</span>
                                                        </td>
                                                        <td class="text-dark">
                                                            <span class="py-3 px-4 fs-23">{{ $ROCustomerAppSubscription?->start_at?->format('Y-m-d') }}</span>
                                                        </td>
                                                    </tr>
                                                    <!--end::Item-->
                                                    <!--begin::Item-->
                                                    <tr>
                                                        <td>
                                                            <span class="text-start">{{__('End date')}}</span>
                                                        </td>
                                                        <td class="text-dark">
                                                            <span class="py-3 px-4 fs-23">{{ $ROCustomerAppSubscription?->end_at?->format('Y-m-d') }}</span>
                                                        </td>
                                                    </tr>
                                                    <!--end::Item-->
                                                    <!--begin::Item-->
                                                    <tr>
                                                        <td>
                                                            <span class="text-start">{{__('Status')}}</span>
                                                        </td>
                                                        <td>
                                                            @if($ROCustomerAppSubscription?->status == 'active')
                                                            <span class="py-3 px-4 fs-23 badge badge-success">{{ __(''.$ROCustomerAppSubscription?->status) }}</span>
                                                            @elseif($ROCustomerAppSubscription?->status == 'requested')
                                                            <span class="py-3 px-4 fs-23 badge badge-warning">{{ __(''.$ROCustomerAppSubscription?->status) }}</span>
                                                            @else
                                                            <span class="py-3 px-4 fs-23 badge badge-danger">{{ __(''.$ROCustomerAppSubscription?->status) }}</span>@endif
                                                        </td>
                                                    </tr>
                                                    <!--end::Item-->
                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Scroll-->
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Modals-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Post-->
                </div>
                @else
                <div class="alert alert-warning text-center">
                    <h4>{{ __('You do not have subscription') }}</h4>
                    <p>{{ __('You can subscription now') }}</p>
                    <a href="{{ route('restaurant.service') }}">
                        <button type="button" class="btn btn-khardl btn-sm">{{ __('View services') }}</button>
                    </a>
                </div>
                @endif
                <hr>
                <!--end::Content-->
                @if($ROCustomerAppSubscriptionInvoices->count())
                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">
                    <!--begin::Post-->
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <!--begin::Container-->
                        <div id="kt_content_container" class="container-xxl">
                            <!--begin::Row-->
                            <div class="row g-12 g-xl-12 mb-xl-112">

                                <!--begin::Col-->
                                <div class="col-lg-12 col-xl-12 col-xxl-12 mb-8 mb-xl-0">
                                    <!--begin::Chart widget 3-->
                                    <div class="card card-flush overflow-hidden h-md-100">
                                        <!--begin::List widget 5-->
                                        <div class="card card-flush h-xl-100">
                                            <!--begin::Card header-->
                                            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                                <!--begin::Card title-->
                                                <div class="card-title">
                                                    <!--begin::Search-->
                                                    <div class="d-flex align-items-center position-relative my-1">
                                                        <h3>{{ __('Transactions') }}</h3>
                                                    </div>
                                                    <!--end::Search-->
                                                </div>
                                                <!--end::Card title-->
                                                <!--begin::Card toolbar-->
                                                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                                    <form method="GET">
                                                        @csrf
                                                        <div class="d-flex my-0">
                                                            <input type="hidden" name="download" value="download_app">
                                                            <button type="submit" id="download_transactions" class="btn btn-khardl mx-2">
                                                                <span class="indicator-label">{{ __('Download') }} <i class="fa fa-download"></i></span>
                                                                <span class="indicator-progress">{{ __('please-wait')}}
                                                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                            </button>
                                                        </div>
                                                    </form>
                                                    <!--end::setting-->
                                                </div>
                                                <!--end::Card toolbar-->
                                            </div>
                                            <!--end::Card header-->
                                            <!--begin::Body-->
                                            <div class="card-body">
                                                <!--begin::Scroll-->
                                                <div class="hover-scroll-overlay-y">
                                                    <!--begin::Table-->
                                                    <table class="table align-middle table-row-dashed fs-6 gy-3" id="kt_table_widget_5_table">
                                                        <!--begin::Table head-->
                                                        <thead>
                                                            <!--begin::Table row-->
                                                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                                                <th class="text-start pe-3 min-w-100px">{{ __('Package') }}</th>
                                                                <th class="text-start pe-3 min-w-100px">{{ __('Status') }}</th>
                                                                <th class="text-start pe-3 min-w-100px">{{ __('Price') }}</th>
                                                                <th class="text-start pe-3 min-w-100px">{{ __('Date') }}</th>
                                                            </tr>
                                                            <!--end::Table row-->
                                                        </thead>
                                                        <!--end::Table head-->
                                                        <!--begin::Table body-->
                                                        <tbody class="fw-bolder text-gray-600">
                                                            @foreach ($ROCustomerAppSubscriptionInvoices as $invoice)
                                                            <tr>
                                                                <!--begin::Item-->
                                                                <td class="text-start">
                                                                    {{ $invoice->subscription?->name }}
                                                                </td>
                                                                <td class="text-start">
                                                                    @if($invoice->status =='active')
                                                                    <span class="py-3 px-4 fs-23 badge badge-khardl">{{ __(''.$invoice->status) }}</span>
                                                                    @else
                                                                    <span class="py-3 px-4 fs-23 badge badge-light-khardl">{{ __(''.$invoice->status) }}</span>
                                                                    @endif
                                                                </td>

                                                                <td class="text-start">
                                                                    @if($invoice?->discount)
                                                                    <div class="d-flex flex-row">
                                                                        <div class="p-2">
                                                                            <p class="text-decoration-line-through">
                                                                                {{$invoice?->amount}} {{__('SAR')}}
                                                                            </p>
                                                                        </div>
                                                                        <div class="p-2">
                                                                            <p>{{$invoice?->discount}} {{__('SAR')}}</p>
                                                                        </div>
                                                                    </div>


                                                                    @else
                                                                    <span class="py-3 px-4 fs-23">{{ $invoice?->amount }} {{ __('SAR') }}</span>

                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <a href="#" class="text-dark text-hover-khardl">{{ $invoice->created_at?->format('Y-m-d h:m A') }}</a>
                                                                </td>
                                                                <!--end::Item-->
                                                            </tr>
                                                            @endforeach

                                                        </tbody>
                                                        <!--end::Table body-->
                                                    </table>
                                                    <!--end::Table-->
                                                </div>
                                                <!--end::Scroll-->
                                            </div>
                                            <!--end::Body-->
                                        </div>
                                        <!--end::List widget 5-->
                                    </div>
                                    <!--end::Chart widget 3-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Modals-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Post-->
                </div>
                <!--end::Content-->
                @endif

            </div>
        </div>
    </div>
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button bg-khardl text-white" type="button" data-bs-toggle="collapse" data-bs-target="#tap_bussiness_info" aria-expanded="true" aria-controls="tap_bussiness_info">
                {{ __('Tab information') }}
            </button>
        </h2>
        <div id="tap_bussiness_info" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">
                    <!--begin::Post-->
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <!--begin::Container-->
                        <div id="kt_content_container" class="container-xxl">
                            <!--begin::Row-->
                            <div class="row g-12 g-xl-12 mb-xl-112">

                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <!--begin::Chart widget 3-->
                                    <div class="card card-flush overflow-hidden h-md-100">
                                        <!--begin::List widget 5-->
                                        <div class="card card-flush h-xl-100">
                                            <!--begin::Header-->
                                            <div class="card-header pt-7">
                                                <!--begin::Title-->
                                                <h3 class="card-title align-items-start flex-column">
                                                    <span class="card-label fw-bolder text-dark">{{ __('Business information') }}</span>
                                                </h3>
                                                <!--end::Title-->
                                            </div>
                                            <!--end::Header-->
                                            <!--begin::Body-->
                                            <div class="card-body">
                                                <!--begin::Scroll-->
                                                <div class="hover-scroll-overlay-y">
                                                    <!--begin::Table-->
                                                    <table class="table align-middle table-row-dashed fs-6 gy-3" id="kt_table_widget_5_table">
                                                        <!--begin::Table head-->
                                                        <thead>
                                                            <!--begin::Table row-->
                                                            <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                                                <th class="text-start pe-3 min-w-100px">{{ __('Key') }}</th>
                                                                <th class="text-start pe-3 min-w-100px">{{ __('Value') }}</th>
                                                            </tr>
                                                            <!--end::Table row-->
                                                        </thead>
                                                        <!--end::Table head-->
                                                        <!--begin::Table body-->
                                                        <tbody class="fw-bolder text-gray-600">
                                                            @if (isset($tap_info['id']))
                                                            <tr>
                                                                <!--begin::Item-->
                                                                <td>
                                                                    <span class="text-start">{{__('Business ID')}}</span>
                                                                </td>
                                                                <td class="text-dark">
                                                                    <span class="py-3 px-4 fs-23">{{ $tap_info['id'] }}</span>
                                                                </td>
                                                                <!--end::Item-->
                                                            </tr>
                                                            @endif
                                                            @if (isset($tap_info['brand']['name']))
                                                            <tr>
                                                                <!--begin::Item-->
                                                                <td>
                                                                    <span class="text-start">{{__('Brand name')}}</span>
                                                                </td>
                                                                <td class="text-dark">
                                                                    <span class="py-3 px-4 fs-23">{{ $tap_info['brand']['name']['ar'] }}</span>
                                                                    -
                                                                    <span class="py-3 px-4 fs-23">{{ $tap_info['brand']['name']['en'] }}</span>
                                                                </td>
                                                                <!--end::Item-->
                                                            </tr>
                                                            @endif
                                                            @if (isset($tap_info['entity']['country'])&&isset($tap_info['entity']['license']))
                                                            <tr>
                                                                <!--begin::Item-->
                                                                <td>
                                                                    <span class="text-start">{{__('Legal Entity (Commercial Registration)')}}</span>
                                                                </td>
                                                                <td class="text-dark">
                                                                    <span class="py-3 px-4 fs-23">
                                                                        <span class="py-3 px-4 fs-23">
                                                                            @if($tap_info['entity']['is_licensed'])
                                                                            <span>
                                                                                {{ __('Entity is Licensed') }}
                                                                            </span>
                                                                            @else
                                                                            <span>
                                                                                {{ __('Entity is not Licensed') }}
                                                                            </span>
                                                                            @endif
                                                                        </span>
                                                                </td>
                                                                <!--end::Item-->
                                                            </tr>
                                                            @if (isset($tap_info['entity']['license']['number']))
                                                            <tr>
                                                                <!--begin::Item-->
                                                                <td>
                                                                    <span class="text-start">{{__('Legal entity number')}}</span>
                                                                </td>
                                                                <td class="text-dark">
                                                                    <span class="py-3 px-4 fs-23">
                                                                        {{ $tap_info['entity']['license']['number'] }}
                                                                    </span>
                                                                </td>
                                                                <!--end::Item-->
                                                            </tr>
                                                            @if (isset($tap_info['entity']['license']['documents'][1]['number'])&&isset($tap_info['entity']['license']['documents'][1]['issuing_date']))
                                                            <tr>
                                                                <!--begin::Item-->
                                                                <td>
                                                                    <span class="text-start">{{__('Number of Memorandum of Association')}}</span>
                                                                </td>
                                                                <td class="text-dark">
                                                                    <span class="py-3 px-4 fs-23">
                                                                        {{ $tap_info['entity']['license']['documents'][1]['number'] }}
                                                                    </span>
                                                                </td>
                                                                <!--end::Item-->
                                                            </tr>
                                                            <tr>
                                                                <!--begin::Item-->
                                                                <td>
                                                                    <span class="text-start">{{__('Issuing date')}}</span>
                                                                </td>
                                                                <td class="text-dark">
                                                                    <span class="py-3 px-4 fs-23">
                                                                        {{ $tap_info['entity']['license']['documents'][1]['issuing_date'] }}
                                                                    </span>
                                                                </td>
                                                                <!--end::Item-->
                                                            </tr>
                                                            <tr>
                                                                <!--begin::Item-->
                                                                <td>
                                                                    <span class="text-start">{{__('Expiry date')}}</span>
                                                                </td>
                                                                <td class="text-dark">
                                                                    <span class="py-3 px-4 fs-23">
                                                                        {{ $tap_info['entity']['license']['documents'][1]['expiry_date'] }}
                                                                    </span>
                                                                </td>
                                                                <!--end::Item-->
                                                            </tr>
                                                            @endif
                                                            @endif
                                                            @endif
                                                        </tbody>
                                                        <!--end::Table body-->
                                                    </table>
                                                    <!--end::Table-->
                                                </div>
                                                <!--end::Scroll-->
                                            </div>
                                            <!--end::Body-->
                                        </div>
                                        <!--end::List widget 5-->
                                    </div>
                                    <!--end::Chart widget 3-->
                                </div>
                                <!--end::Col-->

                                <!--begin::Col-->
                                <div class="col-md-6">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <!--begin::Chart widget 3-->
                                            <div class="card card-flush overflow-hidden h-md-100">
                                                <!--begin::List widget 5-->
                                                <div class="card card-flush h-xl-100">
                                                    <!--begin::Header-->
                                                    <div class="card-header pt-7">
                                                        <!--begin::Title-->
                                                        <h3 class="card-title align-items-start flex-column">
                                                            <span class="card-label fw-bolder text-dark">{{ __('Your information') }}</span>
                                                        </h3>
                                                        <!--end::Title-->
                                                    </div>
                                                    <!--end::Header-->
                                                    <!--begin::Body-->
                                                    <div class="card-body">
                                                        <!--begin::Scroll-->
                                                        <div class="hover-scroll-overlay-y">
                                                            <!--begin::Table-->
                                                            <table class="table align-middle table-row-dashed fs-6 gy-3" id="kt_table_widget_5_table">
                                                                <!--begin::Table head-->
                                                                <thead>
                                                                    <!--begin::Table row-->
                                                                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                                                        <th class="text-start pe-3 min-w-100px"></th>
                                                                        <th class="text-start pe-3 min-w-100px"></th>
                                                                    </tr>
                                                                    <!--end::Table row-->
                                                                </thead>
                                                                <!--end::Table head-->
                                                                <!--begin::Table body-->
                                                                <tbody class="fw-bolder text-gray-600">
                                                                    @if (isset($tap_info['user']['name']))
                                                                    <tr>
                                                                        <!--begin::Item-->
                                                                        <td>
                                                                            <span class="text-start">{{__('Name')}}</span>
                                                                        </td>
                                                                        <td class="text-dark">
                                                                            <span class="py-3 px-4 fs-23">
                                                                                {{ __($tap_info['user']['name']['title']) }}.
                                                                                {{ $tap_info['user']['name']['first'] }} {{-- {{ $tap_info['user']['name']['middle'] }} --}} {{ $tap_info['user']['name']['last'] }}
                                                                            </span>
                                                                        </td>
                                                                        <!--end::Item-->
                                                                    </tr>
                                                                    @endif
                                                                    @if (isset($tap_info['user']['email']))
                                                                    <tr>
                                                                        <!--begin::Item-->
                                                                        <td>
                                                                            <span class="text-start">{{__('Email')}}</span>
                                                                        </td>
                                                                        <td class="text-dark">
                                                                            <span class="py-3 px-4 fs-23">
                                                                                {{ $tap_info['user']['email'][0]['address'] }} - ({{ __($tap_info['user']['email'][0]['type']) }})
                                                                                {{-- ({{ $tap_info['user']['email'][0]['primary'] ? __('Primary') : __('Not primary') }}) --}}
                                                                            </span>
                                                                        </td>
                                                                        <!--end::Item-->
                                                                    </tr>
                                                                    @endif
                                                                    @if (isset($tap_info['user']['phone'][0]))
                                                                    <tr>
                                                                        <!--begin::Item-->
                                                                        <td>
                                                                            <span class="text-start">{{__('Phone')}}</span>
                                                                        </td>
                                                                        <td class="text-dark">
                                                                            <span class="py-3 px-4 fs-23">
                                                                                {{ $tap_info['user']['phone'][0]['country_code'] }}-{{ $tap_info['user']['phone'][0]['number'] }}
                                                                                {{-- ({{ $tap_info['user']['phone'][0]['primary']  ? __('Primary') : __('Not primary')}} --}} - ({{ __($tap_info['user']['phone'][0]['type']) }})
                                                                            </span>
                                                                        </td>
                                                                        <!--end::Item-->
                                                                    </tr>
                                                                    @endif
                                                                </tbody>
                                                                <!--end::Table body-->
                                                            </table>
                                                            <!--end::Table-->
                                                        </div>
                                                        <!--end::Scroll-->
                                                    </div>
                                                    <!--end::Body-->
                                                </div>
                                                <!--end::List widget 5-->
                                            </div>
                                            <!--end::Chart widget 3-->
                                        </div>
                                        <hr>
                                        <div class="col-md-12">
                                            <!--begin::Chart widget 3-->
                                            <div class="card card-flush my-2 overflow-hidden h-md-100">
                                                <!--begin::List widget 5-->
                                                <div class="card card-flush h-xl-100">
                                                    <!--begin::Header-->
                                                    <div class="card-header pt-7">
                                                        <!--begin::Title-->
                                                        <h3 class="card-title align-items-start flex-column">
                                                            <span class="card-label fw-bolder text-dark">{{ __('Bank information') }}</span>
                                                        </h3>
                                                        <!--end::Title-->
                                                    </div>
                                                    <!--end::Header-->
                                                    <!--begin::Body-->
                                                    <div class="card-body">
                                                        <!--begin::Scroll-->
                                                        <div class="hover-scroll-overlay-y">
                                                            <!--begin::Table-->
                                                            <table class="table align-middle table-row-dashed fs-6 gy-3" id="kt_table_widget_5_table">
                                                                <!--begin::Table head-->
                                                                <thead>
                                                                    <!--begin::Table row-->
                                                                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                                                        <th class="text-start pe-3 min-w-100px"></th>
                                                                        <th class="text-start pe-3 min-w-100px"></th>
                                                                    </tr>
                                                                    <!--end::Table row-->
                                                                </thead>
                                                                <!--end::Table head-->
                                                                <!--begin::Table body-->
                                                                <tbody class="fw-bolder text-gray-600">
                                                                    @if (isset($tap_info['wallet']['bank']['name'])&&isset($tap_info['wallet']['bank']['account']))
                                                                    <tr>
                                                                        <!--begin::Item-->
                                                                        <td>
                                                                            <span class="text-start">{{__('Bank name')}}</span>
                                                                        </td>
                                                                        <td class="text-dark">
                                                                            <span class="py-3 px-4 fs-23">
                                                                                {{ $tap_info['wallet']['bank']['name'] }}
                                                                            </span>
                                                                        </td>
                                                                        <!--end::Item-->
                                                                    </tr>
                                                                    <tr>
                                                                        <!--begin::Item-->
                                                                        <td>
                                                                            <span class="text-start">{{__('Bank IBAN')}}</span>
                                                                        </td>
                                                                        <td class="text-dark">
                                                                            <span class="py-3 px-4 fs-23">
                                                                                {{ $tap_info['wallet']['bank']['account']['iban'] }}
                                                                            </span>
                                                                        </td>
                                                                        <!--end::Item-->
                                                                    </tr>
                                                                    <tr>
                                                                        <!--begin::Item-->
                                                                        <td>
                                                                            <span class="text-start">{{__('Bank account number')}}</span>
                                                                        </td>
                                                                        <td class="text-dark">
                                                                            <span class="py-3 px-4 fs-23">
                                                                                {{ $tap_info['wallet']['bank']['account']['number'] }}
                                                                            </span>
                                                                        </td>
                                                                        <!--end::Item-->
                                                                    </tr>
                                                                    @endif
                                                                    @if (isset($tap_info['wallet']['bank']['account']['name']))
                                                                    <tr>
                                                                        <!--begin::Item-->
                                                                        <td>
                                                                            <span class="text-start">{{__('Company Name')}}</span>
                                                                        </td>
                                                                        <td class="text-dark">
                                                                            <span class="py-3 px-4 fs-23">
                                                                                {{ $tap_info['wallet']['bank']['account']['name'] }}
                                                                            </span>
                                                                        </td>
                                                                        <!--end::Item-->
                                                                    </tr>
                                                                    @endif
                                                                    @if (isset($tap_info['wallet']['bank']['documents'][0]['number']))
                                                                    <tr>
                                                                        <!--begin::Item-->
                                                                        <td>
                                                                            <span class="text-start">{{__('Bank Statement Number')}}</span>
                                                                        </td>
                                                                        <td class="text-dark">
                                                                            <span class="py-3 px-4 fs-23">
                                                                                {{ $tap_info['wallet']['bank']['documents'][0]['number'] }}
                                                                            </span>
                                                                        </td>
                                                                        <!--end::Item-->
                                                                    </tr>
                                                                    <tr>
                                                                        <!--begin::Item-->
                                                                        <td>
                                                                            <span class="text-start">{{__('Bank Issuing date')}}</span>
                                                                        </td>
                                                                        <td class="text-dark">
                                                                            <span class="py-3 px-4 fs-23">
                                                                                {{ $tap_info['wallet']['bank']['documents'][0]['issuing_date'] }}
                                                                            </span>
                                                                        </td>
                                                                        <!--end::Item-->
                                                                    </tr>

                                                                    @endif
                                                                </tbody>
                                                                <!--end::Table body-->
                                                            </table>
                                                            <!--end::Table-->
                                                        </div>
                                                        <!--end::Scroll-->
                                                    </div>
                                                    <!--end::Body-->
                                                </div>
                                                <!--end::List widget 5-->
                                            </div>
                                            <!--end::Chart widget 3-->
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Modals-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Post-->
                </div>
            </div>
        </div>
    </div>
</div>
<!--end::Content-->
@else
<div class="alert alert-warning mx-10 p-10 text-center">
    <i class="bi bi-hourglass-split text-warning fa-3x rotating"></i>
    <h4 class="mt-5">{{ __('Your request is pending and waiting for the respond of payment gateway.') }}</h4>
</div>
@endif
@else
<div class="alert alert-warning mx-10 p-10 text-center">
    <i class="bi bi-hourglass-split text-warning fa-3x rotating"></i>
    <h4 class="mt-5">{{ __('You need to contact adminstration because of your payment gateway is not set.') }}</h4>
</div>


@endif


@endsection

@section('js')

<script src="{{ global_asset('assets/js/custom/apps/ecommerce/sales/listing.js')}}"></script>

@endsection
