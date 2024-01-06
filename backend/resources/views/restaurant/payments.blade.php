@extends('layouts.restaurant-sidebar')

@section('title', __('messages.payments'))

@section('content')
    @if(session('success'))
      <div class="alert alert-success">
        {{ session('success') }}
      </div>
    @endif
    @if ($business)
        @if($business->status == 'Active')
            <div class="alert alert-success">
                <span>{{__('Business ID #')}}<strong>{{$business->business_id}}</strong></span>
                <span>{{__('Destination ID #')}}<strong>{{$business->destination_id}}</strong></span>
            </div>

        <!--begin::Content-->
        <div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">
            <!--begin::Post-->
            <div class="post d-flex flex-column-fluid" id="kt_post">
                <!--begin::Container-->
                <div id="kt_content_container" class="container-xxl">
                    <!--begin::Row-->
                    <div class="row g-12 g-xl-12 mb-xl-112">

                        <!--begin::Col-->
                        <div class="col-lg-4 col-xl-4 col-xxl-4 mb-8 mb-xl-0">
                            <!--begin::Card widget 6-->
                            <div class="card card-flush h-md-50">
                                <!--begin::Header-->
                                <div class="card-header">
                                    <!--begin::Title-->
                                    <div class="card-title d-flex flex-column ">
                                        <!--begin::Subtitle-->
                                        <span class="text-gray-900 pt-3 fw-bolder    fs-17"><i class=""></i> Under proccess</span>
                                        <!--end::Subtitle-->
                                        <!--begin::Info-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Amount-->
                                            <span class="fs-1hx fw-bolder text-dark me-2 lh-1 ls-n2 text-khardl">8000 <span class="">SAR</span></span>
                                            <!--end::Amount-->
                                        </div>
                                        <!--end::Info-->

                                    </div>
                                    <!--end::Title-->
                                </div>
                                <!--end::Header-->

                            </div>
                            <!--end::Card widget 6-->

                            <!--begin::Card widget 6-->
                            <div class="card card-flush h-md-50 mt-5">
                                <!--begin::Header-->
                                <div class="card-header">
                                    <!--begin::Title-->
                                    <div class="card-title d-flex flex-column ">
                                        <!--begin::Subtitle-->
                                        <span class="text-gray-900 pt-3 fw-bolder fs-17">Total conversion</span>
                                        <!--end::Subtitle-->
                                        <!--begin::Info-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Amount-->
                                            <span class="fs-1hx fw-bolder text-dark me-2 lh-1 ls-n2 text-khardl">15000 <span class="">SAR</span></span>
                                            <!--end::Amount-->
                                        </div>
                                        <!--end::Info-->

                                    </div>
                                    <!--end::Title-->
                                </div>
                                <!--end::Header-->

                            </div>
                            <!--end::Card widget 6-->
                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col-lg-8 col-xl-8 col-xxl-8 mb-8 mb-xl-0">
                            <!--begin::Chart widget 3-->
                            <div class="card card-flush overflow-hidden h-md-100">
                                <!--begin::List widget 5-->
                                <div class="card card-flush h-xl-100">
                                    <!--begin::Header-->
                                    <div class="card-header pt-7">
                                        <!--begin::Title-->
                                        <h3 class="card-title align-items-start flex-column">
                                            <span class="card-label fw-bolder text-dark">Invoices</span>
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
                                                    <th class="text-start pe-3 min-w-100px">Invoices</th>
                                                    <th class="text-start pe-3 min-w-100px">value</th>
                                                    <th class="text-start pe-3 min-w-100px">Date of issuance of the invoice</th>
                                                </tr>
                                                <!--end::Table row-->
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody class="fw-bolder text-gray-600">
                                                <tr>
                                                    <!--begin::Item-->
                                                    <td>
                                                        <a href="#" class="text-dark text-hover-khardl">Branches</a>
                                                    </td>
                                                    <td class="text-start">
                                                        <span class="py-3 px-4 fs-23">100 <span>SAR</span></span>
                                                        <a href=""><span class="badge badge-light-khardl p-4">Pay</span></a>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="text-dark text-hover-khardl">20/8/2023</a>
                                                    </td>
                                                    <!--end::Item-->
                                                </tr>


                                                <tr>
                                                    <!--begin::Item-->
                                                    <td>
                                                        <a href="#" class="text-dark text-hover-khardl">Apps</a>
                                                    </td>
                                                    <td class="text-start">
                                                        <span class="py-3 px-4 fs-23">100 <span>SAR</span></span>
                                                        <a href=""><span class="badge badge-light-khardl p-4">Pay</span></a>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="text-dark text-hover-khardl">20/8/2023</a>
                                                    </td>
                                                    <!--end::Item-->
                                                </tr>

                                                <tr>
                                                    <!--begin::Item-->
                                                    <td>
                                                        <a href="#" class="text-dark text-hover-khardl">Delivery</a>
                                                    </td>
                                                    <td class="text-start">
                                                        <span class="py-3 px-4 fs-23"><span class="badge badge-light-success px-4">Paid</span> <br> <span>20/9/2023</span></span>
                                                        <a href=""><span class="badge badge-light-khardl p-4">Pay</span></a>
                                                    </td>
                                                    <td>
                                                        <a href="#" class="text-dark text-hover-khardl">20/8/2023</a>
                                                    </td>
                                                    <!--end::Item-->
                                                </tr>

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
                                                <h3>Account statement</h3>
                                            </div>
                                            <!--end::Search-->
                                        </div>
                                        <!--end::Card title-->
                                        <!--begin::Card toolbar-->
                                        <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
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
                                                    <option value="Transfer_to_bank_account">Transfer to bank account	</option>
                                                </select>
                                                <!--end::Select2-->
                                            </div>



                                            <!--begin::setting-->
                                            <a href="#" class="btn btn-sm btn-khardl">Filter</a>
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
                                                    <th class="text-start pe-3 min-w-100px">Date of operation</th>
                                                    <th class="text-start pe-3 min-w-100px">Type of Operation</th>
                                                    <th class="text-start pe-3 min-w-100px">Amount</th>
                                                    <th class="text-start pe-3 min-w-100px">Invoice type</th>
                                                    <th class="text-start pe-3 min-w-100px">transaction id</th>
                                                </tr>
                                                <!--end::Table row-->
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody class="fw-bolder text-gray-600">
                                                <tr>
                                                    <!--begin::Item-->
                                                    <td>
                                                        <a href="#" class="text-dark text-hover-khardl">20-3-2023</a>
                                                    </td>
                                                    <td class="text-start">
                                                        <span class="py-3 px-4 fs-23">Issued</span>
                                                    </td>
                                                    <td>
                                                        <span class="py-3 px-4 fs-23">10.000 <span>SAR</span></span>
                                                    </td>
                                                    <td class="text-start">
                                                        <span class="py-3 px-4 fs-23">Delivery</span>
                                                    </td>
                                                    <td class="text-start">
                                                        <span class="py-3 px-4 fs-23">0123456789</span>
                                                    </td>
                                                    <!--end::Item-->
                                                </tr>


                                                <tr>
                                                    <!--begin::Item-->
                                                    <td>
                                                        <a href="#" class="text-dark text-hover-khardl">20-3-2023</a>
                                                    </td>
                                                    <td class="text-start">
                                                        <span class="py-3 px-4 fs-23 badge badge-light-khardl">Incoming</span>
                                                    </td>
                                                    <td>
                                                        <span class="py-3 px-4 fs-23">10.000 <span>SAR</span></span>
                                                    </td>
                                                    <td class="text-start">
                                                        <span class="py-3 px-4 fs-23 badge badge-light-success">Transfer to bank account</span>
                                                    </td>
                                                    <td class="text-start">
                                                        <span class="py-3 px-4 fs-23">0123456789</span>
                                                    </td>
                                                    <!--end::Item-->
                                                </tr>

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
