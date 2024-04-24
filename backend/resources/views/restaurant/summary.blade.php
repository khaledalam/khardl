@extends('layouts.restaurant-sidebar')

@section('title', __('summary'))

@section('content')
    <div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">

        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
         <!--begin::Container-->
         <div id="kt_content_container" class="container-xxl">
             <!--begin::Row-->
             <div class="row g-5 g-xl-10 mb-xl-10">
                 <div class="col-md-6">
                     <!--begin::Card widget 6-->
                     <div class="card card-flush">
                         <!--begin::Header-->
                         <div class="card-header pt-5">
                             <!--begin::Title-->
                             <div class="card-title d-flex flex-column">
                                 <!--begin::Info-->
                                 <div class="d-flex align-items-center restaurant_daily_amount position-relative">
                                     <!--begin::Currency-->
                                     <span
                                         class="fs-4 fw-bold text-gray-400 me-1 align-self-start">{{ __('SAR') }}</span>
                                     <!--end::Currency-->
                                     <!--begin::Amount-->
                                     <span class="fs-2hx fw-bolder text-dark me-2 lh-1 ls-n2">{{ getAmount((float)$dailySales) }}</span>
                                     <span class="restaurant_daily_earning fade">{{ number_format($dailySales,2) }} {{ __('SAR') }}</span>
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
                                 <span class="text-gray-400 pt-1 fw-bold fs-6">{{ __('Daily Sales') }}</span>
                                 <!--end::Subtitle-->
                             </div>
                             <!--end::Title-->
                         </div>
                         <!--end::Header-->
                         <!--begin::Card body-->
                         <div class="container mt-4 py-2 px-4 bg-white">
                            <div class="row justify-content-center">
                                <div class="col-md-12">
                                    <div class="card">
                                        <div class="card-body p-1">
                                            <h1>{{ $profitLast7Days->options['chart_title'] }}</h1>
                                            {!! $profitLast7Days->renderHtml() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                         <!--end::Card body-->
                     </div>
                     <!--end::Card widget 6-->
                     <!--begin::Card widget 7-->
                 </div>
                 <!--begin::Col-->
                 <div class="col-md-6">
                     <!--begin::Chart widget 3-->
                     <div class="card card-flush overflow-hidden">
                         <!--begin::Header-->
                         <div class="card-header">
                             <!--begin::Title-->
                             <h3 class="card-title align-items-start flex-column">
                                 <span class="card-label fw-bolder text-dark">{{ __('Sales This Months') }}</span>
                             </h3>
                             <!--end::Title-->
                         </div>
                         <!--end::Header-->
                         <!--begin::Card body-->
                         <div class="card-body d-flex pt-0 justify-content-between flex-column pb-1 px-0 restaurant_daily_amount position-relative">
                             <!--begin::Statistics-->
                             <div class="px-9 mb-5">
                                 <!--begin::Statistics-->
                                 <div class="d-flex mb-2">
                                     <span class="fs-4 fw-bold text-gray-400 me-1">{{ __('SAR') }}</span>
                                     <span class="fs-2hx fw-bolder text-dark me-2 lh-1 ls-n2">{{ getAmount((float)$totalPriceThisMonth) }}</span>
                                     <span class="restaurant_daily_earning fade">{{ number_format($totalPriceThisMonth,2) }} {{ __('SAR') }}</span>
                                 </div>
                                 <!--end::Statistics-->
                             </div>
                             <!--end::Statistics-->
                             <div class="container">
                                <div class="row justify-content-center">
                                    <div class="col-md-12">
                                        <div class="card">
                                            <div class="card-body p-1">
                                                <h1>{{ $profitLast4Months->options['chart_title'] }}</h1>
                                                {!! $profitLast4Months->renderHtml() !!}
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
                 <div class="col-md-3">
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
                                <span class="text-gray-400 pt-1 fw-bold fs-6">{{__('all-branches')}}</span>
                                <!--end::Subtitle-->
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                    </div>
                    <!--end::Card widget 4-->
                    <!--begin::Card widget 5-->
                    <div class="card card-flush">
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
                                <span class="text-gray-400 pt-1 fw-bold fs-6">{{ __('Total orders') }}</span>
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
                                <div class="d-flex fs-6 fw-bold align-items-center my-3">
                                    <!--begin::Bullet-->
                                    <div class="bullet w-8px h-6px rounded-2 bg-primary me-3"></div>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-500 flex-grow-1 me-4">
                                        {{ __('Pending') }}
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
                                <div class="d-flex fs-6 fw-bold align-items-center my-3 my-3">
                                    <!--begin::Bullet-->
                                    <div class="bullet w-8px h-6px rounded-2 bg-info me-3"></div>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-500 flex-grow-1 me-4">
                                       {{ __('Accepted') }}
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
                                 <div class="d-flex fs-6 fw-bold align-items-center my-3">
                                   <!--begin::Bullet-->
                                   <div class="bullet w-8px h-6px rounded-2 bg-success me-3"></div>
                                   <!--end::Bullet-->
                                   <!--begin::Label-->
                                   <div class="text-gray-500 flex-grow-1 me-4">
                                       {{ __('Completed') }}
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
                                <div class="d-flex fs-6 fw-bold align-items-center my-3">
                                    <!--begin::Bullet-->
                                    <div class="bullet w-8px h-6px rounded-2 bg-warning me-3"></div>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-500 flex-grow-1 me-4">
                                       {{ __('Ready') }}
                                    </div>
                                    <!--end::Label-->
                                    <!--begin::Stats-->
                                    <div class="fw-boldest text-gray-700 text-xxl-end">
                                        {{ $ready }}
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Label-->
                                <!--begin::Label-->
                                <div class="d-flex fs-6 fw-bold align-items-center my-3">
                                    <!--begin::Bullet-->
                                    <div class="bullet w-8px h-6px rounded-2 bg-secondary me-3"></div>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-500 flex-grow-1 me-4">
                                       {{ __('received_by_restaurant') }}
                                    </div>
                                    <!--end::Label-->
                                    <!--begin::Stats-->
                                    <div class="fw-boldest text-gray-700 text-xxl-end">
                                        {{ $receivedByRes }}
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Label-->
                                <!--begin::Label-->
                                <div class="d-flex fs-6 fw-bold align-items-center my-3">
                                    <!--begin::Bullet-->
                                    <div class="bullet w-8px h-6px rounded-2 bg-danger me-3"></div>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-500 flex-grow-1 me-4">
                                       {{ __('Cancelled') }}
                                    </div>
                                    <!--end::Label-->
                                    <!--begin::Stats-->
                                    <div class="fw-boldest text-gray-700 text-xxl-end">
                                        {{ $cancelled }}
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Label-->
                                <!--begin::Label-->
                                <div class="d-flex fs-6 fw-bold align-items-center my-3">
                                    <!--begin::Bullet-->
                                    <div class="bullet w-8px h-6px rounded-2 bg-danger me-3"></div>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-500 flex-grow-1 me-4">
                                       {{ __('Rejected') }}
                                    </div>
                                    <!--end::Label-->
                                    <!--begin::Stats-->
                                    <div class="fw-boldest text-gray-700 text-xxl-end">
                                        {{ $rejected }}
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Label-->
                            </div>
                            <!--end::Labels-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <div class="card card-flush mt-2">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <div class="card-title d-flex flex-column">
                                <!--begin::Amount-->
                                <span class="fs-2hx fw-bolder text-dark me-2 lh-1 ls-n2">{{ $noOfUsersThisMonth }}</span>
                                <!--end::Amount-->
                                <!--begin::Subtitle-->
                                <span class="text-gray-400 pt-1 fw-bold fs-6">{{ __('New Customers This Month') }}</span>
                                <!--end::Subtitle-->
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                    </div>
                    <!--end::Card widget 5-->
                </div>
                 <!--begin::Col-->
                 <div class="col-md-9">
                     <!--begin::List Widget 3-->
                     <div class="card card-xl-stretch">
                         <!--begin::Header-->
                         <div class="card-header border-0">
                             <h3 class="card-title fw-bolder text-dark">{{ __('Best selling products (Last 30 days)') }}</h3>
                             <div class="card-toolbar">

                             </div>
                         </div>
                         <!--end::Header-->
                         <!--begin::Body-->
                         <div class="card-body pt-2">
                             <!--begin::Item-->
                             @foreach ($bestSellingItems as $orderItem)
                             <div class="d-flex align-items-center mb-8">
                                <!--begin::Bullet-->
                                <span class="bullet bullet-vertical h-40px bg-success"></span>
                                <!--end::Bullet-->
                                <!--begin::Checkbox-->
                                <div class="form-check form-check-custom form-check-solid mx-5">
                                    <a href="{{ route('restaurant.view-item',['item' => $orderItem->item_id]) }}" class="symbol symbol-50px">
                                        <span class="symbol-label" style="background-image:url({{$orderItem->item?->photo}});"></span>
                                    </a>
                                </div>
                                <!--end::Checkbox-->
                                <!--begin::Description-->
                                <div class="flex-grow-1">
                                    <a href="{{ route('restaurant.view-item',['item' => $orderItem->item_id]) }}" class="text-gray-800 text-hover-primary fw-bolder fs-6">
                                        {{ $orderItem->item?->name }}
                                    </a>
                                    <span class="text-muted fw-bold d-block">{{ $orderItem->item?->price }} {{ __('SAR') }}</span>
                                </div>
                                <!--end::Description-->
                                <span class="badge badge-light-success fs-8 fw-bolder">{{ $orderItem->total_quantity }}</span>
                            </div>
                             @endforeach

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
    {!! $profitLast7Days->renderChartJsLibrary() !!}
    {!! $profitLast7Days->renderJs() !!}
    {!! $profitLast4Months->renderJs() !!}
@endsection
