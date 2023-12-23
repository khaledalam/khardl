@extends('layouts.restaurant-sidebar')

@section('title', __('messages.summary'))

@section('content')
    <div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">

        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
         <!--begin::Container-->
         <div id="kt_content_container" class="container-xxl">
             <!--begin::Row-->
             <div class="row g-5 g-xl-10 mb-xl-10">
                 <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
                     <!--begin::Card widget 4-->
                     <div class="card card-flush mb-2">
                         <!--begin::Header-->
                         <div class="card-header pt-5">
                             <!--begin::Title-->
                             <div class="card-title d-flex flex-column">
                                 <!--begin::Info-->
                                 <a href="{{ route('restaurant.branches') }}">
                                    <div class="d-flex align-items-center">
                                        <!--begin::Amount-->
                                        <span class="fs-2hx fw-bolder text-dark me-2 lh-1 ls-n2">{{count($branches)}}</span>
                                        <!--end::Amount-->
                                    </div>
                                </a>
                                 <!--end::Info-->
                                 <!--begin::Subtitle-->
                                 <span class="text-gray-400 pt-1 fw-bold fs-6">{{__('messages.all-branches')}}</span>
                                 <!--end::Subtitle-->
                             </div>
                             <!--end::Title-->
                         </div>
                         <!--end::Header-->
                     </div>
                     <!--end::Card widget 4-->
                     <!--begin::Card widget 5-->
                     <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                         <!--begin::Header-->
                         <div class="card-header pt-5">
                             <!--begin::Title-->
                             <div class="card-title d-flex flex-column">
                                 <!--begin::Info-->
                                 <div class="d-flex align-items-center">
                                     <!--begin::Amount-->
                                     <span class="fs-2hx fw-bolder text-dark me-2 lh-1 ls-n2">{{ $total }}</span>
                                     <!--end::Amount-->
                                 </div>
                                 <!--end::Info-->
                                 <!--begin::Subtitle-->
                                 <span class="text-gray-400 pt-1 fw-bold fs-6">Total orders</span>
                                 <!--end::Subtitle-->
                             </div>
                             <!--end::Title-->
                         </div>
                         <!--end::Header-->
                         <!--begin::Card body-->
                         <div class="card-body pt-2 pb-4 d-flex align-items-center">
                             <!--begin::Labels-->
                             <div class="d-flex flex-column content-justify-center w-100">
                                 <!--begin::Label-->
                                 <div class="d-flex fs-6 fw-bold align-items-center">
                                     <!--begin::Bullet-->
                                     <div class="bullet w-8px h-6px rounded-2 bg-primary me-3"></div>
                                     <!--end::Bullet-->
                                     <!--begin::Label-->
                                     <div class="text-gray-500 flex-grow-1 me-4">
                                         Pending
                                     </div>
                                     <!--end::Label-->
                                     <!--begin::Stats-->
                                     <div class="fw-boldest text-gray-700 text-xxl-end">
                                        {{ $pending }}
                                     </div>
                                     <!--end::Stats-->
                                 </div>
                                 <!--end::Label-->
                                 <!--begin::Label-->
                                 <div class="d-flex fs-6 fw-bold align-items-center my-3">
                                     <!--begin::Bullet-->
                                     <div class="bullet w-8px h-6px rounded-2 bg-info me-3"></div>
                                     <!--end::Bullet-->
                                     <!--begin::Label-->
                                     <div class="text-gray-500 flex-grow-1 me-4">
                                         Accepted
                                     </div>
                                     <!--end::Label-->
                                     <!--begin::Stats-->
                                     <div class="fw-boldest text-gray-700 text-xxl-end">
                                        {{ $accepted }}
                                     </div>
                                     <!--end::Stats-->
                                 </div>
                                <!--begin::Label-->
                                  <!--begin::Label-->
                                  <div class="d-flex fs-6 fw-bold align-items-center">
                                    <!--begin::Bullet-->
                                    <div class="bullet w-8px h-6px rounded-2 bg-success me-3"></div>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-500 flex-grow-1 me-4">
                                        Completed
                                    </div>
                                    <!--end::Label-->
                                    <!--begin::Stats-->
                                    <div class="fw-boldest text-gray-700 text-xxl-end">
                                       {{ $completed }}
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Label-->
                                 <!--end::Label-->
                                 <!--begin::Label-->
                                 <div class="d-flex fs-6 fw-bold align-items-center">
                                     <!--begin::Bullet-->
                                     <div class="bullet w-8px h-6px rounded-2 bg-danger me-3"></div>
                                     <!--end::Bullet-->
                                     <!--begin::Label-->
                                     <div class="text-gray-500 flex-grow-1 me-4">
                                         Cancelled
                                     </div>
                                     <!--end::Label-->
                                     <!--begin::Stats-->
                                     <div class="fw-boldest text-gray-700 text-xxl-end">
                                         {{ $cancelled }}
                                     </div>
                                     <!--end::Stats-->
                                 </div>
                                 <!--end::Label-->
                             </div>
                             <!--end::Labels-->
                         </div>
                         <!--end::Card body-->
                     </div>
                     <!--end::Card widget 5-->
                 </div>
                 <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
                     <!--begin::Card widget 6-->
                     <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                         <!--begin::Header-->
                         <div class="card-header pt-5">
                             <!--begin::Title-->
                             <div class="card-title d-flex flex-column">
                                 <!--begin::Info-->
                                 <div class="d-flex align-items-center">
                                     <!--begin::Currency-->
                                     <span
                                         class="fs-4 fw-bold text-gray-400 me-1 align-self-start">SAR</span>
                                     <!--end::Currency-->
                                     <!--begin::Amount-->
                                     <span
                                         class="fs-2hx fw-bolder text-dark me-2 lh-1 ls-n2">{{ $dailySales }}</span>
                                     <!--end::Amount-->
                                     <!--begin::Badge-->
                                     <span class="{{ $percentageChange >=0 ? 'badge fs-base badge-success':'badge fs-base badge-danger' }}">
                                         <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                         <span class="svg-icon svg-icon-5 svg-icon-white ms-n1">
                                            @if ($percentageChange >=0 )
                                            <i class="bi bi-arrow-up-short text-white fa-lg"></i>
                                            @else
                                            <i class="bi bi-arrow-down-short text-white fa-lg"></i>
                                            @endif
                                         </span>
                                         <!--end::Svg Icon-->{{ $percentageChange }}%
                                    </span>
                                     <!--end::Badge-->
                                 </div>
                                 <!--end::Info-->
                                 <!--begin::Subtitle-->
                                 <span class="text-gray-400 pt-1 fw-bold fs-6">Average Daily Sales</span>
                                 <!--end::Subtitle-->
                             </div>
                             <!--end::Title-->
                         </div>
                         <!--end::Header-->
                         <!--begin::Card body-->
                         <div class="card-body d-flex align-items-end px-0 pb-0">
                             <!--begin::Chart-->
                             <div id="kt_card_widget_6_chart" class="w-100" style="height: 80px"></div>
                             <!--end::Chart-->
                         </div>
                         <!--end::Card body-->
                     </div>
                     <!--end::Card widget 6-->
                     <!--begin::Card widget 7-->
                     <div class="card card-flush">
                         <!--begin::Header-->
                         <div class="card-header pt-5">
                             <!--begin::Title-->
                             <div class="card-title d-flex flex-column">
                                 <!--begin::Amount-->
                                 <span class="fs-2hx fw-bolder text-dark me-2 lh-1 ls-n2">{{ $noOfUsersThisMonth }}</span>
                                 <!--end::Amount-->
                                 <!--begin::Subtitle-->
                                 <span class="text-gray-400 pt-1 fw-bold fs-6">New Customers This
                                     Month</span>
                                 <!--end::Subtitle-->
                             </div>
                             <!--end::Title-->
                         </div>
                         <!--end::Header-->
                     </div>
                     <!--end::Card widget 7-->
                 </div>
                 <!--begin::Col-->
                 <div class="col-lg-12 col-xl-12 col-xxl-6 mb-5 mb-xl-0">
                     <!--begin::Chart widget 3-->
                     <div class="card card-flush overflow-hidden h-md-100">
                         <!--begin::Header-->
                         <div class="card-header py-5">
                             <!--begin::Title-->
                             <h3 class="card-title align-items-start flex-column">
                                 <span class="card-label fw-bolder text-dark">Sales This Months</span>
                             </h3>
                             <!--end::Title-->
                         </div>
                         <!--end::Header-->
                         <!--begin::Card body-->
                         <div class="card-body d-flex justify-content-between flex-column pb-1 px-0">
                             <!--begin::Statistics-->
                             <div class="px-9 mb-5">
                                 <!--begin::Statistics-->
                                 <div class="d-flex mb-2">
                                     <span class="fs-4 fw-bold text-gray-400 me-1">$</span>
                                     <span
                                         class="fs-2hx fw-bolder text-gray-800 me-2 lh-1 ls-n2">14,094</span>
                                 </div>
                                 <!--end::Statistics-->
                             </div>
                             <!--end::Statistics-->
                             <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body">
                                                <h1>{{ $chart1->options['chart_title'] }}</h1>
                                                {!! $chart1->renderHtml() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                         </div>
                         <!--end::Card body-->
                     </div>
                     <!--end::Chart widget 3-->
                 </div>
                 <!--end::Col-->

                 <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 mb-md-5 mb-xl-10">
                     <!--begin::Card widget 5-->
                     <div class="card card-flush h-md-50 mb-5 mb-xl-10">
                         <!--begin::Header-->
                         <div class="card-header pt-5">
                             <!--begin::Title-->
                             <div class="card-title d-flex flex-column">
                                 <!--begin::Info-->
                                 <div class="d-flex align-items-center">
                                     <!--begin::Amount-->
                                     <span class="fs-2hx fw-bolder text-dark me-2 lh-1 ls-n2">1500
                                         <!--begin::Badge-->
                                                <span class="badge badge-khardl fs-base">SAR</span>
                                                </span>
                                     <!--end::Amount-->
                                 </div>
                                 <!--end::Info-->
                                 <!--begin::Subtitle-->
                                 <span class="text-gray-400 pt-1 fw-bold fs-6">available balance</span>
                                 <!--end::Subtitle-->
                             </div>
                             <!--end::Title-->
                         </div>
                         <!--end::Header-->
                         <!--begin::Card body-->
                         <div class="card-body pt-2 pb-4 d-flex align-items-center">
                             <!--begin::Labels-->
                             <div class="d-flex flex-column content-justify-center w-100">
                                 <!--begin::Label-->
                                 <div class="d-flex fs-6 fw-bold align-items-center">
                                     <!--begin::Bullet-->
                                     <div class="bullet w-8px h-6px rounded-2 bg-danger me-3"></div>
                                     <!--end::Bullet-->
                                     <!--begin::Label-->
                                     <div class="text-gray-500 flex-grow-1 me-4">
                                         All balance
                                     </div>
                                     <!--end::Label-->
                                     <!--begin::Stats-->
                                     <div class="fw-boldest text-gray-700 text-xxl-end">
                                         18000
                                     </div>
                                     <!--end::Stats-->
                                 </div>
                                 <!--end::Label-->
                                 <!--begin::Label-->
                                 <div class="d-flex fs-6 fw-bold align-items-center my-3">
                                     <!--begin::Bullet-->
                                     <div class="bullet w-8px h-6px rounded-2 bg-primary me-3"></div>
                                     <!--end::Bullet-->
                                     <!--begin::Label-->
                                     <div class="text-gray-500 flex-grow-1 me-4">
                                         Withdrawal balance
                                     </div>
                                     <!--end::Label-->
                                     <!--begin::Stats-->
                                     <div class="fw-boldest text-gray-700 text-xxl-end">
                                         15000
                                     </div>
                                     <!--end::Stats-->
                                 </div>
                                 <!--end::Label-->
                                 <!--begin::Label-->
                                 <div class="d-flex fs-6 fw-bold align-items-center">
                                     <!--begin::Bullet-->
                                     <div class="bullet w-8px h-6px rounded-2 me-3"
                                          style="background-color: #efefe4"></div>
                                     <!--end::Bullet-->
                                     <!--begin::Label-->
                                     <div class="text-gray-500 flex-grow-1 me-4">
                                         It has been withdrawn
                                     </div>
                                     <!--end::Label-->
                                     <!--begin::Stats-->
                                     <div class="fw-boldest text-gray-700 text-xxl-end">
                                         3000
                                     </div>
                                     <!--end::Stats-->
                                 </div>
                                 <!--end::Label-->
                             </div>
                             <!--end::Labels-->
                         </div>
                         <!--end::Card body-->
                     </div>
                     <!--end::Card widget 5-->
                 </div>

                 <!--begin::Col-->
                 <div class="col-lg-8 col-xl-8 col-xxl-8 mb-5 mb-xl-0">
                     <!--begin::List Widget 3-->
                     <div class="card card-xl-stretch mb-xl-8">
                         <!--begin::Header-->
                         <div class="card-header border-0">
                             <h3 class="card-title fw-bolder text-dark">Best selling</h3>
                             <div class="card-toolbar">

                             </div>
                         </div>
                         <!--end::Header-->
                         <!--begin::Body-->
                         <div class="card-body pt-2">
                             <!--begin::Item-->
                             <div class="d-flex align-items-center mb-8">
                                 <!--begin::Bullet-->
                                 <span class="bullet bullet-vertical h-40px bg-success"></span>
                                 <!--end::Bullet-->
                                 <!--begin::Checkbox-->
                                 <div class="form-check form-check-custom form-check-solid mx-5">
                                 </div>
                                 <!--end::Checkbox-->
                                 <!--begin::Description-->
                                 <div class="flex-grow-1">
                                     <a href="#" class="text-gray-800 text-hover-primary fw-bolder fs-6">Create FireStone Logo</a>
                                     <span class="text-muted fw-bold d-block">Due in 2 Days</span>
                                 </div>
                                 <!--end::Description-->
                                 <span class="badge badge-light-success fs-8 fw-bolder">53</span>
                             </div>
                             <!--end:Item-->
                             <!--begin::Item-->
                             <div class="d-flex align-items-center mb-8">
                                 <!--begin::Bullet-->
                                 <span class="bullet bullet-vertical h-40px bg-primary"></span>
                                 <!--end::Bullet-->
                                 <!--begin::Checkbox-->
                                 <div class="form-check form-check-custom form-check-solid mx-5">
                                 </div>
                                 <!--end::Checkbox-->
                                 <!--begin::Description-->
                                 <div class="flex-grow-1">
                                     <a href="#" class="text-gray-800 text-hover-primary fw-bolder fs-6">Stakeholder Meeting</a>
                                     <span class="text-muted fw-bold d-block">Due in 3 Days</span>
                                 </div>
                                 <!--end::Description-->
                                 <span class="badge badge-light-primary fs-8 fw-bolder">50</span>
                             </div>
                             <!--end:Item-->
                             <!--begin::Item-->
                             <div class="d-flex align-items-center mb-8">
                                 <!--begin::Bullet-->
                                 <span class="bullet bullet-vertical h-40px bg-warning"></span>
                                 <!--end::Bullet-->
                                 <!--begin::Checkbox-->
                                 <div class="form-check form-check-custom form-check-solid mx-5">
                                 </div>
                                 <!--end::Checkbox-->
                                 <!--begin::Description-->
                                 <div class="flex-grow-1">
                                     <a href="#" class="text-gray-800 text-hover-primary fw-bolder fs-6">Scoping &amp; Estimations</a>
                                     <span class="text-muted fw-bold d-block">Due in 5 Days</span>
                                 </div>
                                 <!--end::Description-->
                                 <span class="badge badge-light-warning fs-8 fw-bolder">47</span>
                             </div>
                             <!--end:Item-->
                             <!--begin::Item-->
                             <div class="d-flex align-items-center mb-8">
                                 <!--begin::Bullet-->
                                 <span class="bullet bullet-vertical h-40px bg-primary"></span>
                                 <!--end::Bullet-->
                                 <!--begin::Checkbox-->
                                 <div class="form-check form-check-custom form-check-solid mx-5">
                                 </div>
                                 <!--end::Checkbox-->
                                 <!--begin::Description-->
                                 <div class="flex-grow-1">
                                     <a href="#" class="text-gray-800 text-hover-primary fw-bolder fs-6">KPI App Showcase</a>
                                     <span class="text-muted fw-bold d-block">Due in 2 Days</span>
                                 </div>
                                 <!--end::Description-->
                                 <span class="badge badge-light-primary fs-8 fw-bolder">41</span>
                             </div>
                             <!--end:Item-->
                             <!--begin::Item-->
                             <div class="d-flex align-items-center mb-8">
                                 <!--begin::Bullet-->
                                 <span class="bullet bullet-vertical h-40px bg-danger"></span>
                                 <!--end::Bullet-->
                                 <!--begin::Checkbox-->
                                 <div class="form-check form-check-custom form-check-solid mx-5">
                                 </div>
                                 <!--end::Checkbox-->
                                 <!--begin::Description-->
                                 <div class="flex-grow-1">
                                     <a href="#" class="text-gray-800 text-hover-primary fw-bolder fs-6">Project Meeting</a>
                                     <span class="text-muted fw-bold d-block">Due in 12 Days</span>
                                 </div>
                                 <!--end::Description-->
                                 <span class="badge badge-light-danger fs-8 fw-bolder">38</span>
                             </div>
                             <!--end:Item-->
                             <!--begin::Item-->
                             <div class="d-flex align-items-center">
                                 <!--begin::Bullet-->
                                 <span class="bullet bullet-vertical h-40px bg-success"></span>
                                 <!--end::Bullet-->
                                 <!--begin::Checkbox-->
                                 <div class="form-check form-check-custom form-check-solid mx-5">
                                 </div>
                                 <!--end::Checkbox-->
                                 <!--begin::Description-->
                                 <div class="flex-grow-1">
                                     <a href="#" class="text-gray-800 text-hover-primary fw-bolder fs-6">Customers Update</a>
                                     <span class="text-muted fw-bold d-block">Due in 1 week</span>
                                 </div>
                                 <!--end::Description-->
                                 <span class="badge badge-light-success fs-8 fw-bolder">35</span>
                             </div>
                             <!--end:Item-->
                         </div>
                         <!--end::Body-->
                     </div>
                     <!--end:List Widget 3-->
                 </div>

             </div>
             <!--end::Modals-->
         </div>
         <!--end::Container-->
     </div>
     <!--end::Post-->
     </div>
     <!--end::Content-->
    {!! $chart1->renderChartJsLibrary() !!}
    {!! $chart1->renderJs() !!}
@endsection
