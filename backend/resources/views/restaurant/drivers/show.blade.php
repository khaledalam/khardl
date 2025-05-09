@extends('layouts.restaurant-sidebar')

@section('title', __('View driver'))

@section('content')
<div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">

    <!--begin::Post-->
    <div class="tables-page m-4">
        <div class="row">
            <div class="col-md-12 mb-5 card">
                <div class="card-header d-flex align-items-center justify-content-between flex-xxl-row flex-lg-row flex-md-row flex-column">
                    <strong class="title_head h4 fw-semibold d-block text-primary">
                        {{ $driver->full_name }}
                    </strong>
                    <span>
                        <div class="badge badge-{{ $driver->status }}">
                            {{ __($driver->status) }}
                        </div>
                    </span>
                    <a href="{{ route('drivers.index') }}">
                        <button type="button" class="btn btn-khardl btn-sm">
                            <i class="fa fa-arrow-left"></i>
                            {{ __('Back to list') }}
                        </button>
                    </a>
                </div>
                <div class="card-body table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>{{ __("Phone") }}</td>
                                <td class="text-info">{{ $driver->phone }}</td>
                            </tr>
                            <tr>
                                <td>{{ __("Email") }}</td>
                                <td>{{ $driver->email }}</td>
                            </tr>
                            <tr>
                                <td>{{ __("Address") }}</td>
                                <td>{{ $driver->address }}</td>
                            </tr>
                            <tr>
                                <td>{{ __("Branch") }}</td>
                                <td>{{ $driver->branch?->name }}</td>
                            </tr>
                            <tr>
                                <td>{{ __("Vehicle number") }}</td>
                                <td>{{ $driver->vehicle_number }}</td>
                            </tr>
                            <tr>
                                <td>{{ __("Delivered orders") }}</td>
                                <td>{{ $driver->completed_orders?->count() }}</td>
                            </tr>
                            <tr>
                                <td>{{ __("This month") }}</td>
                                <td>{{ $driver->monthly_orders()?->count() }}</td>
                            </tr>
                            <tr>
                                <td>{{ __("Image") }}</td>
                                <td>
                                    @if ($driver->image)
                                    <div class="symbol symbol-60px symbol-lg-60px symbol-fixed position-relative">
                                        <img alt="driver image" src="{{ $driver->image }}" />
                                    </div>
                                    @else
                                    <div class="symbol symbol-60px symbol-lg-60px symbol-fixed position-relative">
                                        <img alt="driver image" src="{{ global_asset('images/driver_logo.jpg') }}" />
                                    </div>
                                    @endif

                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-md-12 mb-5 card">
                <div class="card-header d-flex align-items-center justify-content-between flex-xxl-row flex-lg-row flex-md-row flex-column">
                    <strong class="title_head h4 fw-semibold d-block">
                        {{ __('Orders') }}
                    </strong>
                </div>
                <hr />
                <div class="row">
                    <div class="col-md-12">
                        @include('restaurant.orders.component.list_orders',['orders' => $orders])
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->
@endsection
