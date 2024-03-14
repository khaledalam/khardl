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
            <button class="accordion-button bg-success text-white" type="button" data-bs-toggle="collapse" data-bs-target="#paid_orders" aria-expanded="true" aria-controls="paid_orders">
                {{ __('Online paid orders') }}
            </button>
        </h2>
        <div id="paid_orders" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <!--begin::Content-->
                @if($orders?->count())
                @include('restaurant.orders.component.list_orders',['orders' => $orders])
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
            <button class="accordion-button bg-success text-white" type="button" data-bs-toggle="collapse" data-bs-target="#subscriptions" aria-expanded="true" aria-controls="subscriptions">
                {{ __('Your subscription') }}
            </button>
        </h2>
        <div id="subscriptions" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
            <div class="accordion-body">
                <!--begin::Content-->
                @if($user?->ROSubscription)
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
                                                            <span class="py-3 px-4 fs-23">{{ $user?->ROSubscription?->number_of_branches }}</span>
                                                        </td>
                                                    </tr>
                                                    <!--end::Item-->
                                                    @if(isset($user?->ROSubscription?->subscription?->name))
                                                    <!--begin::Item-->
                                                    <tr>
                                                        <td>
                                                            <span class="text-start">{{__('Package')}}</span>
                                                        </td>
                                                        <td class="text-dark">
                                                            <span class="py-3 px-4 fs-23">{{ $user?->ROSubscription?->subscription?->name }}</span>
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
                                                            <span class="py-3 px-4 fs-23">{{ $user?->ROSubscription?->amount }} {{ __('SAR') }}</span>
                                                        </td>
                                                    </tr>
                                                    <!--end::Item-->
                                                    <!--begin::Item-->
                                                    <tr>
                                                        <td>
                                                            <span class="text-start">{{__('Start date')}}</span>
                                                        </td>
                                                        <td class="text-dark">
                                                            <span class="py-3 px-4 fs-23">{{ $user?->ROSubscription?->start_at?->format('Y-m-d') }}</span>
                                                        </td>
                                                    </tr>
                                                    <!--end::Item-->
                                                    <!--begin::Item-->
                                                    <tr>
                                                        <td>
                                                            <span class="text-start">{{__('End date')}}</span>
                                                        </td>
                                                        <td class="text-dark">
                                                            <span class="py-3 px-4 fs-23">{{ $user?->ROSubscription?->end_at?->format('Y-m-d') }}</span>
                                                        </td>
                                                    </tr>
                                                    <!--end::Item-->
                                                    <!--begin::Item-->
                                                    <tr>
                                                        <td>
                                                            <span class="text-start">{{__('Status')}}</span>
                                                        </td>
                                                        <td>
                                                            @if($user->ROSubscription?->status == 'active')
                                                            <span class="py-3 px-4 fs-23 badge badge-success">{{ __(''.$user?->ROSubscription?->status) }}</span>
                                                            @else
                                                            <span class="py-3 px-4 fs-23 badge badge-danger">{{ __(''.$user?->ROSubscription?->status) }}</span>
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
                        <button type="button" class="btn btn-success btn-sm">{{ __('View services') }}</button>
                    </a>
                </div>
                @endif
                <hr>
                <!--end::Content-->
                @if($user?->ROSubscriptionInvoices->count())
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
                                                            <button type="submit" id="download_transactions" class="btn btn-success mx-2">
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
                                                            @foreach ($user->ROSubscriptionInvoices as $invoice)
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
                                                                    <span class="py-3 px-4 fs-23 badge badge-light-success">
                                                                        {{ $invoice->amount }} {{ __('SAR') }}
                                                                    </span>
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
            <button class="accordion-button bg-success text-white" type="button" data-bs-toggle="collapse" data-bs-target="#tap_bussiness_info" aria-expanded="true" aria-controls="tap_bussiness_info">
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
                                                            {{-- @if (isset($tap_info['brand']['channel_services'][0]['channel'])&&isset($tap_info['brand']['channel_services'][0]['address']))
                                                                <tr>
                                                                    <!--begin::Item-->
                                                                    <td>
                                                                        <span class="text-start">{{__('Brand channel')}}</span>
                                                            </td>
                                                            <td class="text-dark">
                                                                <span class="py-3 px-4 fs-23">{{ $tap_info['brand']['channel_services'][0]['channel'] }}</span>
                                                            </td>
                                                            <!--end::Item-->
                                                            </tr>
                                                            <tr>
                                                                <!--begin::Item-->
                                                                <td>
                                                                    <span class="text-start">{{__('Brand address')}}</span>
                                                                </td>
                                                                <td class="text-dark">
                                                                    <span class="py-3 px-4 fs-23">{{ $tap_info['brand']['channel_services'][0]['address'] }}</span>
                                                                </td>
                                                                <!--end::Item-->
                                                            </tr>
                                                            @endif --}}
                                                            {{-- @if (isset($tap_info['brand']['operations']['sales']['period'])&&isset($tap_info['brand']['operations']['sales']['range']))
                                                                <tr>
                                                                    <!--begin::Item-->
                                                                    <td>
                                                                        <span class="text-start">{{__('Bussiness expected sales')}}</span>
                                                            </td>
                                                            <td class="text-dark">
                                                                <span class="py-3 px-4 fs-23">
                                                                    {{ __('From') }}
                                                                    {{ $tap_info['brand']['operations']['sales']['range']['from'] }}
                                                                    {{ __('To') }}
                                                                    {{ $tap_info['brand']['operations']['sales']['range']['to'] }}
                                                                    {{ __($tap_info['brand']['operations']['sales']['currency']) }} {{ __($tap_info['brand']['operations']['sales']['period']) }}
                                                                </span>
                                                            </td>
                                                            <!--end::Item-->
                                                            </tr>
                                                            @endif --}}
                                                            @if (isset($tap_info['entity']['country'])&&isset($tap_info['entity']['license']))
                                                            <tr>
                                                                <!--begin::Item-->
                                                                <td>
                                                                    <span class="text-start">{{__('Legal Entity (Commercial Registration)')}}</span>
                                                                </td>
                                                                <td class="text-dark">
                                                                    <span class="py-3 px-4 fs-23">
{{--                                                                         <span class="py-3 px-4 fs-23">
                                                                            {{ $tap_info['entity']['country'] }}
                                                                            ({{ $tap_info['entity']['license']['city'] }})
                                                                        </span> --}}
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
                                                                        <th class="text-start pe-3 min-w-100px">{{ __('Key') }}</th>
                                                                        <th class="text-start pe-3 min-w-100px">{{ __('Value') }}</th>
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
                                                                  {{--   @if (isset($tap_info['user']['birth']))
                                                                    <tr>
                                                                            <!--begin::Item-->
                                                                            <td>
                                                                                <span class="text-start">{{__('Birthday')}}< /span>
                                                                        </td>
                                                                        <td class="text-dark">
                                                                            <span class="py-3 px-4 fs-23">
                                                                                {{ $tap_info['user']['birth']['date'] }}
                                                                            </span>
                                                                        </td>
                                                                        <!--end::Item-->
                                                                        </tr>
                                                                        <tr>
                                                                            <!--begin::Item-->
                                                                            <td>
                                                                                <span class="text-start">{{__('Birthday city')}}</span>
                                                                            </td>
                                                                            <td class="text-dark">
                                                                                <span class="py-3 px-4 fs-23">
                                                                                    {{ $tap_info['user']['birth']['country'] }} - {{ $tap_info['user']['birth']['city'] }}
                                                                                </span>
                                                                            </td>
                                                                            <!--end::Item-->
                                                                        </tr>
                                                                        @endif --}}
                                                                        {{-- @if (isset($tap_info['user']['address'][0]))
                                                                        <tr>
                                                                            <!--begin::Item-->
                                                                            <td>
                                                                                <span class="text-start">{{__('Country')}}</span>
                                                                            </td>
                                                                            <td class="text-dark">
                                                                                <span class="py-3 px-4 fs-23">{{ $tap_info['user']['address'][0]['country'] }}
                                                                                    ({{ __($tap_info['user']['address'][0]['type']) }})
                                                                                </span>
                                                                            </td>
                                                                            <!--end::Item-->
                                                                        </tr>
                                                                        <tr>
                                                                            <!--begin::Item-->
                                                                            <td>
                                                                                <span class="text-start">{{__('City')}}</span>
                                                                            </td>
                                                                            <td class="text-dark">
                                                                                <span class="py-3 px-4 fs-23">{{ $tap_info['user']['address'][0]['city'] }}</span>
                                                                            </td>
                                                                            <!--end::Item-->
                                                                        </tr>
                                                                        <tr>
                                                                            <!--begin::Item-->
                                                                            <td>
                                                                                <span class="text-start">{{__('ZIP code')}}</span>
                                                                            </td>
                                                                            <td class="text-dark">
                                                                                <span class="py-3 px-4 fs-23">{{ $tap_info['user']['address'][0]['zip_code'] }}</span>
                                                                            </td>
                                                                            <!--end::Item-->
                                                                        </tr>
                                                                        <tr>
                                                                            <!--begin::Item-->
                                                                            <td>
                                                                                <span class="text-start">{{__('Address Line 1')}}</span>
                                                                            </td>
                                                                            <td class="text-dark">
                                                                                <span class="py-3 px-4 fs-23">{{ $tap_info['user']['address'][0]['line1'] }}</span>
                                                                            </td>
                                                                            <!--end::Item-->
                                                                        </tr>
                                                                        <tr>
                                                                            <!--begin::Item-->
                                                                            <td>
                                                                                <span class="text-start">{{__('Address Line 2')}}</span>
                                                                            </td>
                                                                            <td class="text-dark">
                                                                                <span class="py-3 px-4 fs-23">{{ $tap_info['user']['address'][0]['line2'] }}</span>
                                                                            </td>
                                                                            <!--end::Item-->
                                                                        </tr>
                                                                        @endif --}}
                                                                        {{-- @if (isset($tap_info['user']['identification']))
                                                                        <tr>
                                                                            <!--begin::Item-->
                                                                            <td>
                                                                                <span class="text-start">{{__('National ID')}}</span>
                                                                        </td>
                                                                        <td class="text-dark">
                                                                            <span class="py-3 px-4 fs-23">{{ $tap_info['user']['identification']['number'] }}
                                                                            </span>
                                                                        </td>
                                                                        <!--end::Item-->
                                                                        </tr>
                                                                        @endif --}}
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
                                                                        <th class="text-start pe-3 min-w-100px">{{ __('Key') }}</th>
                                                                        <th class="text-start pe-3 min-w-100px">{{ __('Value') }}</th>
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
                                                                    {{-- <tr>
                                                                        <!--begin::Item-->
                                                                        <td>
                                                                            <span class="text-start">{{__('Bank SWIFT code')}}</span>
                                                                        </td>
                                                                        <td class="text-dark">
                                                                            <span class="py-3 px-4 fs-23">
                                                                                {{ $tap_info['wallet']['bank']['account']['swift'] }}
                                                                            </span>
                                                                        </td>
                                                                        <!--end::Item-->
                                                                    </tr> --}}
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
