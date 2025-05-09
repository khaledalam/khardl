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
                <div class="col-md-12">
                    <div class="row">
                        <div class="col-md-4">
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
                            <div class="card card-flush mb-2">
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
                                            <div class="bullet w-8px h-6px rounded-2 bg-khardl me-3"></div>
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
                                            <div class="bullet w-8px h-6px rounded-2 bg-khardl me-3"></div>
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
                            <!--end::Card widget 5-->
                        </div>
                        <div class="col-md-8">
                            <!--begin::List Widget 3-->
                            <div class="card card-xl-stretch" style="min-height:100%">
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
                                        <span class="bullet bullet-vertical h-40px bg-khardl"></span>
                                        <!--end::Bullet-->
                                        <!--begin::Checkbox-->
                                        <div class="form-check form-check-custom form-check-solid mx-5">
                                            @if($orderItem->item_id)
                                            @if(Auth::user()->hasPermissionWorker('can_edit_menu'))
                                            <a href="{{ route('restaurant.view-item',['item' => $orderItem->item_id]) }}" class="symbol symbol-50px">
                                                <span class="symbol-label" style="background-image:url({{$orderItem->item?->photo}});"></span>
                                            </a>
                                            @else
                                            <a href="#" class="symbol symbol-50px">
                                                <span class="symbol-label" style="background-image:url({{$orderItem->item?->photo}});"></span>
                                            </a>
                                            @endif
                                            @else
                                            <span class="symbol-label"></span>
                                            @endif

                                        </div>
                                        <!--end::Checkbox-->
                                        <!--begin::Description-->
                                        <div class="flex-grow-1">
                                            @if(Auth::user()->hasPermissionWorker('can_edit_menu'))
                                            <a href="{{ route('restaurant.view-item',['item' => $orderItem->item_id]) }}" class="text-gray-800 text-hover-khardl fw-bolder fs-6">
                                                {{ $orderItem->item->name ?? __('Deleted') }}
                                            </a>
                                            @else
                                            <span>{{ $orderItem->item->name ?? __('Deleted') }}</span>
                                            @endif
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
                </div>
                <div class="col-md-6 position-relative">
                    <div class="row">
                        <div class="col-md-2 filtration">
                            <div class="mb-4">
                                <select class="form-select" id="filter_range">
                                    <option value="daily" selected>{{ __('7 Days') }}</option>
                                    <option value="monthly">{{ __('6 Months') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12" id="daily_statistics">
                            <!--begin::Card widget 6-->
                            <div class="card card-flush">
                                <!--begin::Card body-->
                                <div class="container mt-4 py-2 px-4 bg-white">
                                    <div class="row justify-content-center">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-body p-1">
                                                    <h3>
                                                        {{ __("Revenues within 7 days") }} :
                                                        <span class="btn-tooltip" data-bs-toggle="tooltip" title="{{ $sum = getSumOfDataGraph($dailyRevenues) }} {{ __('SAR') }}" data-container="body" data-animation="true" data-bs-toggle="tooltip">
                                                            {{ getAmount($sum) }} {{ __('SAR') }}
                                                        </span>
                                                    </h3>
                                                    {!! $dailyRevenues->renderHtml() !!}
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
                        <div class="col-md-12" id="monthly_statistics" style="display: none;">
                            <!--begin::Chart widget 3-->
                            <div class="card card-flush">
                                <!--begin::Card body-->
                                <div class="card-body d-flex pt-0 justify-content-between flex-column pb-1 px-0">
                                    <div class="container mt-4 py-2 px-4 bg-white">
                                        <div class="row justify-content-center">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-body p-1">
                                                        <h3>
                                                            {{ __("Revenues within 6 months") }} :
                                                            <span class="btn-tooltip" data-bs-toggle="tooltip" title="{{ $sum = getSumOfDataGraph($monthlyRevenues) }} {{ __('SAR') }}" data-container="body" data-animation="true" data-bs-toggle="tooltip">
                                                                {{ getAmount($sum) }} {{ __('SAR') }}
                                                            </span>
                                                        </h3>
                                                        {!! $monthlyRevenues->renderHtml() !!}
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
                    </div>
                </div>
                <div class="col-md-6 position-relative">
                    <div class="row">
                        <div class="col-md-2 filtration">
                            <div class="mb-4">
                                <select class="form-select" id="filter_range_visitors">
                                    <option value="daily" selected>{{ __('7 Days') }}</option>
                                    <option value="monthly">{{ __('6 Months') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12" id="daily_visitors_selector">
                            <!--begin::Card widget 6-->
                            <div class="card card-flush">
                                <!--end::Header-->
                                <!--begin::Card body-->
                                <div class="container mt-4 py-2 px-4 bg-white">
                                    <div class="row justify-content-center">
                                        <div class="col-md-12">
                                            <div class="card">
                                                <div class="card-body p-1">
                                                    <h3>
                                                        {{ __("Visitors within 7 days") }} :
                                                        <span class="btn-tooltip" data-bs-toggle="tooltip" title="{{ $sum = getSumOfDataGraph($dailyVisitors) }} {{ __('Visitor') }}" data-container="body" data-animation="true" data-bs-toggle="tooltip">
                                                            {{ getAmount($sum) }} {{ __('Visitor') }}
                                                        </span>
                                                    </h3>
                                                    {!! $dailyVisitors->renderHtml() !!}
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
                        <div class="col-md-12" id="monthly_visitors_selector" style="display: none;">
                            <!--begin::Chart widget 3-->
                            <div class="card card-flush">
                                <!--begin::Card body-->
                                <div class="card-body d-flex pt-0 justify-content-between flex-column pb-1 px-0">
                                    <div class="container mt-4 py-2 px-4 bg-white">
                                        <div class="row justify-content-center">
                                            <div class="col-md-12">
                                                <div class="card">
                                                    <div class="card-body p-1">
                                                        <h3>
                                                            {{ __("Visitors within 6 months") }} :
                                                            <span class="btn-tooltip" data-bs-toggle="tooltip" title="{{ $sum = getSumOfDataGraph($monthVisitors) }} {{ __('Visitor') }}" data-container="body" data-animation="true" data-bs-toggle="tooltip">
                                                                {{ getAmount($sum) }} {{ __('Visitor') }}
                                                            </span>
                                                        </h3>
                                                        {!! $monthVisitors->renderHtml() !!}
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
                    </div>
                </div>
                <!--end::Col-->
                <!--begin::Col-->

            </div>
            <!--end::Modals-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->
@section('js')
{!! $dailyRevenues->renderChartJsLibrary() !!}
{!! $dailyRevenues->renderJs() !!}
{!! $monthlyRevenues->renderJs() !!}
{!! $dailyVisitors->renderJs() !!}
{!! $monthVisitors->renderJs() !!}
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filter_range = document.getElementById('filter_range');
        const daily_statistics = document.getElementById('daily_statistics');
        const monthly_statistics = document.getElementById('monthly_statistics');
        const filter_range_visitors = document.getElementById('filter_range_visitors');
        const daily_visitors_selector = document.getElementById('daily_visitors_selector');
        const monthly_visitors_selector = document.getElementById('monthly_visitors_selector');

        if (filter_range?.length) {
            filter_range.addEventListener('change', function() {
                if (filter_range.value === 'daily') {
                    daily_statistics.style.display = 'block';
                    monthly_statistics.style.display = 'none';
                } else if (filter_range.value === 'monthly') {
                    daily_statistics.style.display = 'none';
                    monthly_statistics.style.display = 'block';
                }
            });
        }
        if (filter_range_visitors?.length) {
            filter_range_visitors.addEventListener('change', function() {
                if (filter_range_visitors.value === 'daily') {
                    daily_visitors_selector.style.display = 'block';
                    monthly_visitors_selector.style.display = 'none';
                } else if (filter_range_visitors.value === 'monthly') {
                    daily_visitors_selector.style.display = 'none';
                    monthly_visitors_selector.style.display = 'block';
                }
            });
        }
    });

</script>
@endsection
@endsection
