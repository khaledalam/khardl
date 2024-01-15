@extends('layouts.restaurant-sidebar')

@section('title', __('messages.payments'))
@section('css')
<style>
    .accordion-button:not(.collapsed)::after{
        
    }
</style>
@endsection
@section('content')
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
@if ($business)
@if($business?->status == 'Active')
<!--begin::Content-->
<div class="accordion" id="accordionExample">
    <div class="accordion-item">
        <h2 class="accordion-header" id="headingOne">
            <button class="accordion-button bg-success text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                {{ __('messages.Your subscription') }}
            </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
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
                                    <span class="text-gray-900 pt-3 fw-bolder    fs-17"><i class=""></i> {{ __('messages.Current subscription') }}</span>
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
                                                        <th class="text-start pe-3 min-w-100px">{{ __('messages.Key') }}</th>
                                                        <th class="text-start pe-3 min-w-100px">{{ __('messages.Value') }}</th>
                                                    </tr>
                                                    <!--end::Table row-->
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody class="fw-bolder text-gray-600">
                                                    <!--begin::Item-->
                                                    <tr>
                                                        <td>
                                                            <span class="text-start">{{__('messages.Number of branches')}}</span>
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
                                                            <span class="text-start">{{__('messages.Package')}}</span>
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
                                                            <span class="text-start">{{__('messages.Price')}}</span>
                                                        </td>
                                                        <td class="text-dark">
                                                            <span class="py-3 px-4 fs-23">{{ $user?->ROSubscription?->amount }} {{ __('messages.SAR') }}</span>
                                                        </td>
                                                    </tr>
                                                    <!--end::Item-->
                                                    <!--begin::Item-->
                                                    <tr>
                                                        <td>
                                                            <span class="text-start">{{__('messages.Start date')}}</span>
                                                        </td>
                                                        <td class="text-dark">
                                                            <span class="py-3 px-4 fs-23">{{ $user?->ROSubscription?->start_at?->format('Y-m-d') }}</span>
                                                        </td>
                                                    </tr>
                                                    <!--end::Item-->
                                                    <!--begin::Item-->
                                                    <tr>
                                                        <td>
                                                            <span class="text-start">{{__('messages.End date')}}</span>
                                                        </td>
                                                        <td class="text-dark">
                                                            <span class="py-3 px-4 fs-23">{{ $user?->ROSubscription?->end_at?->format('Y-m-d') }}</span>
                                                        </td>
                                                    </tr>
                                                    <!--end::Item-->
                                                    <!--begin::Item-->
                                                    <tr>
                                                        <td>
                                                            <span class="text-start">{{__('messages.Status')}}</span>
                                                        </td>
                                                        <td>
                                                            @if($user->ROSubscription?->status == 'active')
                                                            <span class="py-3 px-4 fs-23 badge badge-success">{{ __('messages.'.$user?->ROSubscription?->status) }}</span>
                                                            @else
                                                            <span class="py-3 px-4 fs-23 badge badge-danger">{{ __('messages.'.$user?->ROSubscription?->status) }}</span>
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
                    <h4>{{ __('messages.You do not have subscription') }}</h4>
                    <p>{{ __('messages.You can subscription now') }}</p>
                    <a href="{{ route('restaurant.service') }}">
                        <button type="button" class="btn btn-success btn-sm">{{ __('messages.View services') }}</button>
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
                                                        <h3>{{ __('messages.Transactions') }}</h3>
                                                    </div>
                                                    <!--end::Search-->
                                                </div>
                                                <!--end::Card title-->
                                                <!--begin::Card toolbar-->
                                                <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                                    {{-- <!--begin::Search-->
                                                    <div class="d-flex align-items-center position-relative my-1">
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                                        <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                        <input type="text" data-kt-ecommerce-order-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="transaction id" />
                                                    </div>
                                                    <!--end::Search-->

                                                    <div class="w-100 mw-150px">
                                                        <!--begin::Select2-->
                                                        <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Ranking" data-kt-ecommerce-order-filter="status">
                                                            <option></option>
                                                            <option value="old_to_new">old to new</option>
                                                            <option value="new_to_old">new to old</option>
                                                        </select>
                                                        <!--end::Select2-->
                                                    </div>


                                                    <div class="w-100 mw-150px">
                                                        <!--begin::Select2-->
                                                        <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="Invoice type" data-kt-ecommerce-order-filter="status">
                                                            <option></option>
                                                            <option value="Branches">Branches</option>
                                                            <option value="Apps">Apps</option>
                                                            <option value="Delivery">Delivery</option>
                                                            <option value="Transfer_to_bank_account">Transfer to bank account </option>
                                                        </select>
                                                        <!--end::Select2-->
                                                    </div> --}}



                                                    <!--begin::setting-->
                                                    {{-- <a href="#" class="btn btn-sm btn-khardl">Filter</a> --}}
                                                    <form method="GET">
                                                        @csrf
                                                        <div class="d-flex my-0">
                                                            <input type="hidden" name="download" value="csv">
                                                            <button type="submit" id="download_transactions" class="btn btn-success mx-2">
                                                                <span class="indicator-label">{{ __('messages.Download') }} <i class="fa fa-download"></i></span>
                                                                <span class="indicator-progress">{{ __('messages.please-wait')}}
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
                                                                <th class="text-start pe-3 min-w-100px">{{ __('messages.Package') }}</th>
                                                                <th class="text-start pe-3 min-w-100px">{{ __('messages.Status') }}</th>
                                                                <th class="text-start pe-3 min-w-100px">{{ __('messages.Number of branches') }}</th>
                                                                <th class="text-start pe-3 min-w-100px">{{ __('messages.Price') }}</th>
                                                                <th class="text-start pe-3 min-w-100px">{{ __('messages.Date') }}</th>
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
                                                                    <span class="py-3 px-4 fs-23 badge badge-khardl">{{ __('messages.'.$invoice->status) }}</span>
                                                                    @else
                                                                    <span class="py-3 px-4 fs-23 badge badge-light-khardl">{{ __('messages.'.$invoice->status) }}</span>
                                                                    @endif
                                                                </td>
                                                                <td>
                                                                    <span class="py-3 px-4 fs-23">
                                                                        {{ $invoice->number_of_branches }}
                                                                    </span>
                                                                </td>
                                                                <td class="text-start">
                                                                    <span class="py-3 px-4 fs-23 badge badge-light-success">
                                                                        {{ $invoice->amount }} {{ __('messages.SAR') }}
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
            <button class="accordion-button bg-success text-white" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                {{ __('messages.Tab information') }}
            </button>
        </h2>
        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
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
                                                    <span class="card-label fw-bolder text-dark">{{ __('messages.Tab business information') }}</span>
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
                                                                <th class="text-start pe-3 min-w-100px">{{ __('messages.Key') }}</th>
                                                                <th class="text-start pe-3 min-w-100px">{{ __('messages.Value') }}</th>
                                                            </tr>
                                                            <!--end::Table row-->
                                                        </thead>
                                                        <!--end::Table head-->
                                                        <!--begin::Table body-->
                                                        <tbody class="fw-bolder text-gray-600">
                                                            <tr>
                                                                <!--begin::Item-->
                                                                <td>
                                                                    <span class="text-start">{{__('Business ID')}}</span>
                                                                </td>
                                                                <td class="text-dark">
                                                                    <span class="py-3 px-4 fs-23">{{ $business?->business_id }}</span>
                                                                </td>
                                                                <!--end::Item-->
                                                            </tr>
                                                            <tr>
                                                                <!--begin::Item-->
                                                                <td>
                                                                    <span class="text-start">{{__('Destination ID')}}</span>
                                                                </td>
                                                                <td class="text-dark">
                                                                    <span class="py-3 px-4 fs-23">{{ $business?->destination_id }}</span>
                                                                </td>
                                                                <!--end::Item-->
                                                            </tr>
                                                            <tr>
                                                                <!--begin::Item-->
                                                                <td>
                                                                    <span class="text-start">{{__('messages.Wallet ID')}}</span>
                                                                </td>
                                                                <td class="text-dark">
                                                                    <span class="py-3 px-4 fs-23">{{ $business?->wallet_id }}</span>
                                                                </td>
                                                                <!--end::Item-->
                                                            </tr>
                                                            @if (isset($business?->data['name']))
                                                            <tr>
                                                                <!--begin::Item-->
                                                                <td>
                                                                    <span class="text-start">{{__('messages.Name')}}</span>
                                                                </td>
                                                                <td class="text-dark">
                                                                    <span class="py-3 px-4 fs-23">{{ $business?->data['name'][app()->getLocale()] }}</span>
                                                                </td>
                                                                <!--end::Item-->
                                                            </tr>
                                                            @endif
                                                            @if (isset($business?->data['type']))
                                                            <tr>
                                                                <!--begin::Item-->
                                                                <td>
                                                                    <span class="text-start">{{__('messages.Type')}}</span>
                                                                </td>
                                                                <td class="text-dark">
                                                                    <span class="py-3 px-4 fs-23">{{ $business?->data['type'] == 'ind'? __('messages.Individual'):__('messages.Corporation') }}</span>
                                                                </td>
                                                                <!--end::Item-->
                                                            </tr>
                                                            @endif
                                                            @if (isset($business?->data['brands']))
                                                            <tr>
                                                                <!--begin::Item-->
                                                                <td>
                                                                    <span class="text-start">{{__('messages.Brands')}}</span>
                                                                </td>
                                                                <td class="text-dark">
                                                                    <ul>
                                                                        @foreach ($business?->data['brands'] as $brand)
                                                                        <li>{{ $brand['name'][app()->getLocale()] }}</li>
                                                                        @endforeach
                                                                    </ul>
                                                                </td>
                                                                <!--end::Item-->
                                                            </tr>
                                                            @endif
                                                            @if (isset($business?->data['entity']['country']))
                                                            <tr>
                                                                <!--begin::Item-->
                                                                <td>
                                                                    <span class="text-start">{{__('messages.Country')}}</span>
                                                                </td>
                                                                <td class="text-dark">
                                                                    <span class="py-3 px-4 fs-23">{{ $business?->data['entity']['country'] }}</span>
                                                                </td>
                                                                <!--end::Item-->
                                                            </tr>
                                                            @endif
                                                            @if (isset($business?->data['entity']['legal_name'][app()->getLocale()]))
                                                            <tr>
                                                                <!--begin::Item-->
                                                                <td>
                                                                    <span class="text-start">{{__('messages.Legal name')}}</span>
                                                                </td>
                                                                <td class="text-dark">
                                                                    <span class="py-3 px-4 fs-23">{{ $business?->data['entity']['legal_name'][app()->getLocale()] }}</span>
                                                                </td>
                                                                <!--end::Item-->
                                                            </tr>
                                                            @endif
                                                            @if (isset($business?->data['entity']['is_licensed']))
                                                            <tr>
                                                                <!--begin::Item-->
                                                                <td>
                                                                    <span class="text-start">{{__('messages.Is licensed')}}</span>
                                                                </td>
                                                                @if($business?->data['entity']['is_licensed'])
                                                                <td>
                                                                    <span class="badge badge-success">
                                                                        {{ __('messages.Yes') }}
                                                                    </span>
                                                                </td>
                                                                @else
                                                                <td>
                                                                    <span class="badge badge-danger">
                                                                        {{ __('messages.No') }}
                                                                    </span>
                                                                </td>
                                                                @endif

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
                                                            <span class="card-label fw-bolder text-dark">{{ __('messages.Your account information') }}</span>
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
                                                                        <th class="text-start pe-3 min-w-100px">{{ __('messages.Key') }}</th>
                                                                        <th class="text-start pe-3 min-w-100px">{{ __('messages.Value') }}</th>
                                                                    </tr>
                                                                    <!--end::Table row-->
                                                                </thead>
                                                                <!--end::Table head-->
                                                                <!--begin::Table body-->
                                                                <tbody class="fw-bolder text-gray-600">
                                                                    @if (isset($business?->data['contact_person']['name']['last']))
                                                                    <tr>
                                                                        <!--begin::Item-->
                                                                        <td>
                                                                            <span class="text-start">{{__('messages.Last name')}}</span>
                                                                        </td>
                                                                        <td class="text-dark">
                                                                            <span class="py-3 px-4 fs-23">{{ $business?->data['contact_person']['name']['last'] }}</span>
                                                                        </td>
                                                                        <!--end::Item-->
                                                                    </tr>
                                                                    @endif
                                                                    @if (isset($business?->data['contact_person']['name']['first']))
                                                                    <tr>
                                                                        <!--begin::Item-->
                                                                        <td>
                                                                            <span class="text-start">{{__('messages.First name')}}</span>
                                                                        </td>
                                                                        <td class="text-dark">
                                                                            <span class="py-3 px-4 fs-23">{{ $business?->data['contact_person']['name']['first'] }}</span>
                                                                        </td>
                                                                        <!--end::Item-->
                                                                    </tr>
                                                                    @endif
                                                                    @if (isset($business?->data['contact_person']['name']['title']))
                                                                    <tr>
                                                                        <!--begin::Item-->
                                                                        <td>
                                                                            <span class="text-start">{{__('messages.Title')}}</span>
                                                                        </td>
                                                                        <td class="text-dark">
                                                                            <span class="py-3 px-4 fs-23">{{ $business?->data['contact_person']['name']['title'] }}</span>
                                                                        </td>
                                                                        <!--end::Item-->
                                                                    </tr>
                                                                    @endif
                                                                    @if (isset($business?->data['contact_person']['name']['middle']))
                                                                    <tr>
                                                                        <!--begin::Item-->
                                                                        <td>
                                                                            <span class="text-start">{{__('messages.Middle name')}}</span>
                                                                        </td>
                                                                        <td class="text-dark">
                                                                            <span class="py-3 px-4 fs-23">{{ $business?->data['contact_person']['name']['middle'] }}</span>
                                                                        </td>
                                                                        <!--end::Item-->
                                                                    </tr>
                                                                    @endif
                                                                    @if (isset($business?->data['contact_person']['contact_info']['primary']['email']))
                                                                    <tr>
                                                                        <!--begin::Item-->
                                                                        <td>
                                                                            <span class="text-start">{{__('messages.Email')}}</span>
                                                                        </td>
                                                                        <td class="text-dark">
                                                                            <span class="py-3 px-4 fs-23">{{ $business?->data['contact_person']['contact_info']['primary']['email'] }}</span>
                                                                        </td>
                                                                        <!--end::Item-->
                                                                    </tr>
                                                                    @endif
                                                                    @if (isset($business?->data['contact_person']['contact_info']['primary']['phone']['number']))
                                                                    <tr>
                                                                        <!--begin::Item-->
                                                                        <td>
                                                                            <span class="text-start">{{__('messages.Phone')}}</span>
                                                                        </td>
                                                                        <td class="text-dark">
                                                                            {{ $business?->data['contact_person']['contact_info']['primary']['phone']['country_code'] }}<span>-{{ $business?->data['contact_person']['contact_info']['primary']['phone']['number'] }}</span>
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
                                                            <span class="card-label fw-bolder text-dark">{{ __('messages.Bank information') }}</span>
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
                                                                        <th class="text-start pe-3 min-w-100px">{{ __('messages.Key') }}</th>
                                                                        <th class="text-start pe-3 min-w-100px">{{ __('messages.Value') }}</th>
                                                                    </tr>
                                                                    <!--end::Table row-->
                                                                </thead>
                                                                <!--end::Table head-->
                                                                <!--begin::Table body-->
                                                                <tbody class="fw-bolder text-gray-600">
                                                                    @if (isset($business?->data['entity']['bank_account']['iban']))
                                                                    <tr>
                                                                        <!--begin::Item-->
                                                                        <td>
                                                                            <span class="text-start">{{__('messages.IBAN')}}</span>
                                                                        </td>
                                                                        <td class="text-dark">
                                                                            <span class="py-3 px-4 fs-23">{{ $business?->data['entity']['bank_account']['iban'] }}</span>
                                                                        </td>
                                                                        <!--end::Item-->
                                                                    </tr>
                                                                    @endif
                                                                    @if (isset($business?->data['entity']['bank_account']['swift_code']))
                                                                    <tr>
                                                                        <!--begin::Item-->
                                                                        <td>
                                                                            <span class="text-start">{{__('messages.IBAN')}}</span>
                                                                        </td>
                                                                        <td class="text-dark">
                                                                            <span class="py-3 px-4 fs-23">{{ $business?->data['entity']['bank_account']['swift_code'] }}</span>
                                                                        </td>
                                                                        <!--end::Item-->
                                                                    </tr>
                                                                    @endif
                                                                    @if (isset($business?->data['entity']['bank_account']['account_number']))
                                                                    <tr>
                                                                        <!--begin::Item-->
                                                                        <td>
                                                                            <span class="text-start">{{__('messages.Account number')}}</span>
                                                                        </td>
                                                                        <td class="text-dark">
                                                                            <span class="py-3 px-4 fs-23">{{ $business?->data['entity']['bank_account']['account_number'] }}</span>
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
<div class="alert alert-success">
    {{__('Your TAP account is pending.')}}
</div>
@endif
@else
<div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content1">
    <h2 class="text-center pt-5"> {{ __('messages.Create TAP') }}<a href="{{ route('tap.payments_upload_tap_documents_get') }}"><u>{{ __('messages.business account') }}</u></a> {{ __('messages.first to access this page content!') }}</h2>
</div>


@endif
@endsection
