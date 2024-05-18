@extends('layouts.admin-sidebar')
@section('title', __('dashboard'))
@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">
    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Row-->

            <div class="row">
                <div class="col-md-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card card-flush">
                                <!--begin::Header-->
                                <div class="card-header pt-5">
                                    <!--begin::Title-->
                                    <div class="card-title d-flex flex-column">
                                        <!--begin::Info-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Amount-->
                                            <span class="fs-2hx fw-bolder text-dark me-2 lh-1 ls-n2">{{ $totalOrders }}</span>
                                            <!--end::Amount-->
                                        </div>
                                        <!--end::Info-->
                                        <!--begin::Subtitle-->
                                        <span class="text-gray-400 pt-1 fw-bold fs-6">{{ __('total-orders')}}</span>
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
                                                {{ __('Completed')}}
                                            </div>
                                            <!--end::Label-->
                                            <!--begin::Stats-->
                                            <div class="fw-boldest text-gray-700 text-xxl-end">
                                                {{ $completedOrders }}
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
                                                {{ __('Accepted')}}
                                            </div>
                                            <!--end::Label-->
                                            <!--begin::Stats-->
                                            <div class="fw-boldest text-gray-700 text-xxl-end">
                                                {{ $acceptedOrders }}
                                            </div>
                                            <!--end::Stats-->
                                        </div>
                                        <!--end::Label-->
                                        <!--begin::Label-->
                                        <div class="d-flex fs-6 fw-bold align-items-center my-3 my-3">
                                            <!--begin::Bullet-->
                                            <div class="bullet w-8px h-6px rounded-2 bg-primary me-3"></div>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="text-gray-500 flex-grow-1 me-4">
                                                {{ __('Pending')}}
                                            </div>
                                            <!--end::Label-->
                                            <!--begin::Stats-->
                                            <div class="fw-boldest text-gray-700 text-xxl-end">
                                                {{ $pendingOrders }}
                                            </div>
                                            <!--end::Stats-->
                                        </div>
                                        <!--end::Label-->
                                        <!--begin::Label-->
                                        <div class="d-flex fs-6 fw-bold align-items-center my-3 my-3">
                                            <!--begin::Bullet-->
                                            <div class="bullet w-8px h-6px rounded-2 bg-warning me-3"></div>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="text-gray-500 flex-grow-1 me-4">
                                                {{ __('Ready')}}
                                            </div>
                                            <!--end::Label-->
                                            <!--begin::Stats-->
                                            <div class="fw-boldest text-gray-700 text-xxl-end">
                                                {{ $readyOrders }}
                                            </div>
                                            <!--end::Stats-->
                                        </div>
                                        <!--end::Label-->
                                        <div class="d-flex fs-6 fw-bold align-items-center my-3 my-3">
                                            <!--begin::Bullet-->
                                            <div class="bullet w-8px h-6px rounded-2 bg-secondary me-3"></div>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="text-gray-500 flex-grow-1 me-4">
                                                {{ __('Received by restaurant')}}
                                            </div>
                                            <!--end::Label-->
                                            <!--begin::Stats-->
                                            <div class="fw-boldest text-gray-700 text-xxl-end">
                                                {{ $receivedByResOrders }}
                                            </div>
                                            <!--end::Stats-->
                                        </div>
                                        <!--end::Label-->
                                        <!--begin::Label-->
                                        <div class="d-flex fs-6 fw-bold align-items-center my-3 my-3">
                                            <!--begin::Bullet-->
                                            <div class="bullet w-8px h-6px rounded-2 bg-danger me-3"></div>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="text-gray-500 flex-grow-1 me-4">
                                                {{ __('Cancelled')}}
                                            </div>
                                            <!--end::Label-->
                                            <!--begin::Stats-->
                                            <div class="fw-boldest text-gray-700 text-xxl-end">
                                                {{ $cancelledOrders }}
                                            </div>
                                            <!--end::Stats-->
                                        </div>
                                        <!--end::Label-->
                                        <!--begin::Label-->
                                        <div class="d-flex fs-6 fw-bold align-items-center my-3 my-3">
                                            <!--begin::Bullet-->
                                            <div class="bullet w-8px h-6px rounded-2 bg-danger me-3"></div>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="text-gray-500 flex-grow-1 me-4">
                                                {{ __('Rejected')}}
                                            </div>
                                            <!--end::Label-->
                                            <!--begin::Stats-->
                                            <div class="fw-boldest text-gray-700 text-xxl-end">
                                                {{ $rejectedOrders }}
                                            </div>
                                            <!--end::Stats-->
                                        </div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Labels-->
                                </div>
                                <!--end::Card body-->
                            </div>
                        </div>
                        <div class="col-md-12">
                            <!--begin::Card widget 4-->
                            <div class="card card-flush mt-4">
                                <!--begin::Card body-->
                                <div class="card-body pt-2 pb-4 d-flex align-items-center">
                                    <!--begin::Chart-->
                                    <div class="d-flex flex-center me-5 pt-2">
                                        <div id="kt_card_widget_4_chart" style="min-width: 70px; min-height: 70px" data-kt-size="70" data-kt-line="11"></div>
                                    </div>
                                    <!--end::Chart-->
                                    <!--begin::Labels-->
                                    <div class="d-flex flex-column content-justify-center w-100">
                                        <!--begin::Label-->
                                        <div class="d-flex fs-6 fw-bold align-items-center my-3">
                                            <!--begin::Bullet-->
                                            <div class="bullet w-8px h-6px rounded-2 bg-danger me-3"></div>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="text-gray-500 flex-grow-1 me-4">
                                                {{ __('not_upload_register_files')}}
                                            </div>
                                            <!--end::Label-->
                                            <!--begin::Stats-->
                                            <div class="fw-boldest text-gray-700 text-xxl-end">
                                                {{$restaurantsOwnersNotUploadFiles}}
                                            </div>
                                            <!--end::Stats-->
                                        </div>
                                        <!--end::Label-->
                                        <!--begin::Label-->
                                        <div class="d-flex fs-6 fw-bold align-items-center my-3 my-3">
                                            <!--begin::Bullet-->
                                            <div class="bullet w-8px h-6px rounded-2 bg-primary me-3"></div>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="text-gray-500 flex-grow-1 me-4">
                                                {{ __('live')}}
                                            </div>
                                            <!--end::Label-->
                                            <!--begin::Stats-->
                                            <div class="fw-boldest text-gray-700 text-xxl-end">
                                                {{$restaurantsLive}}
                                            </div>
                                            <!--end::Stats-->
                                        </div>
                                        <!--end::Label-->
                                        <!--begin::Label-->
                                        <div class="d-flex fs-6 fw-bold align-items-center my-3">
                                            <!--begin::Bullet-->
                                            <div class="bullet w-8px h-6px rounded-2 me-3" style="background-color: #efefe4"></div>
                                            <!--end::Bullet-->
                                            <!--begin::Label-->
                                            <div class="text-gray-500 flex-grow-1 me-4">
                                                {{ __('not_live')}}
                                            </div>
                                            <!--end::Label-->
                                            <!--begin::Stats-->
                                            <div class="fw-boldest text-gray-700 text-xxl-end">
                                                {{$restaurantsAll - $restaurantsLive }}
                                            </div>
                                            <!--end::Stats-->
                                        </div>
                                        <!--end::Label-->
                                    </div>
                                    <!--end::Labels-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card widget 4-->
                        </div>
                        <div class="col-md-12">
                            <!--end::Card widget 6-->
                            <!--begin::Card widget 7-->
                            <div class="card card-flush my-4">
                                <!--begin::Header-->
                                <div class="card-header">
                                    <!--begin::Title-->
                                    <div class="card-title d-flex flex-column">
                                        <!--begin::Amount-->
                                        <span class="fs-2hx fw-bolder text-dark me-2 lh-1 ls-n2">{{$restaurantsAll}}</span>
                                        <!--end::Amount-->
                                        <!--begin::Subtitle-->
                                        <span class="text-gray-400 pt-1 fw-bold fs-6">{{ __('restaurants-count')}}</span>
                                        <!--end::Subtitle-->
                                    </div>
                                    <!--end::Title-->
                                </div>
                            </div>
                            <!--end::Card widget 7-->
                        </div>
                    </div>
                </div>
                <div class="col-md-8 position-relative">
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
                            <div class="card card-flush h-md-100 mb-5 mb-xl-10">
                                <!--begin::Card body-->
                                <div class="card-body pt-2 pb-4 d-flex align-items-center">
                                    <div class="container">
                                        <div class="card">
                                            <div class="card-body p-1">
                                                <h3>
                                                    {{ __("Visitors within 7 days") }} :
                                                    <span class="btn-tooltip" data-bs-toggle="tooltip"
                                                    title="{{ $sum = getSumOfDataGraph($dailyVisitors) }} {{ __('Visitor') }}" data-container="body"
                                                    data-animation="true" data-bs-toggle="tooltip">
                                                        {{ getAmount($sum) }} {{ __('Visitor') }}
                                                    </span>
                                                </h3>
                                                {!! $dailyVisitors->renderHtml() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Card body-->
                            </div>
                        </div>
                        <div class="col-md-12" id="monthly_statistics" style="display: none;">
                            <div class="card card-flush h-md-100 mb-5 mb-xl-10">
                                <!--begin::Card body-->
                                <div class="card-body pt-2 pb-4 d-flex align-items-center">
                                    <div class="container">
                                        <div class="card">
                                            <div class="card-body p-1">
                                                <h3>
                                                    {{ __("Visitors within 6 months") }} :
                                                    <span class="btn-tooltip" data-bs-toggle="tooltip"
                                                    title="{{ $sum = getSumOfDataGraph($monthVisitors) }} {{ __('Visitor') }}" data-container="body"
                                                    data-animation="true" data-bs-toggle="tooltip">
                                                        {{ getAmount($sum) }} {{ __('Visitor') }}
                                                    </span>
                                                </h3>
                                                {!! $monthVisitors->renderHtml() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Card body-->
                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <!--end::Modals-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->
@endsection
<style>
    canvas {
        width: 100% !important;
        height: 100% !important;
        position: relative;
    }

</style>
@section('js')
@if ($dailyVisitors)
{!! $dailyVisitors->renderChartJsLibrary() !!}
{!! $dailyVisitors->renderJs() !!}
@endif
@if ($monthVisitors)
{!! $monthVisitors->renderChartJsLibrary() !!}
{!! $monthVisitors->renderJs() !!}
@endif
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const filter_range = document.getElementById('filter_range');
        const daily_statistics = document.getElementById('daily_statistics');
        const monthly_statistics = document.getElementById('monthly_statistics');

        if (filter_range?.length) {
            filter_range.addEventListener('change', function () {
                if (filter_range.value === 'daily') {
                    daily_statistics.style.display = 'block';
                    monthly_statistics.style.display = 'none';
                } else if (filter_range.value === 'monthly') {
                    daily_statistics.style.display = 'none';
                    monthly_statistics.style.display = 'block';
                }
            });
        }
    });
</script>
@endsection
