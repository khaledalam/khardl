@extends('layouts.restaurant-sidebar')

@section('title', __('services'))

@section('content')

<div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">

    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">
            <!--begin::Wrapper-->
            <div class=" d-flex flex-column flex-row-fluid" id="kt_wrapper">
                <!--begin::Header-->
                @if(!$hasActiveCustomerApp)
                <div class="card p-10">
                    <div class="alert service-alert d-flex align-items-center" role="alert">
                        <div class="service-alert-icon">
                            <i class="bi bi-info-circle mx-2 text-white "></i>
                        </div>
                        <div>
                            <span>
                                <h4>{{__('You do not have customer app')}}</h4>
                                {{__('In order to be able to request an advertising service for the restaurant, you must have a subscription to the customer application.')}}
                                @if(Auth::user()?->hasPermissionWorker('can_access_service_page'))
                                <a href="{{route('restaurant.service')}}">
                                    <u>
                                        {{ __('You can purchase the customer application from here') }}
                                    </u>
                                </a>
                                @endif
                            </span>
                        </div>
                    </div>
                </div>
                @else
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
                                            <h3 class="fs-2hx fw-bolder mb-5">
                                                {{__('You can now advertise on your restaurant by purchasing one of the advertising packages below')}}
                                            </h3>
                                            <span class="text-muted">
                                                {{ __('This service is provided by a third party (another company and we khardl do not bear responsibility for the results)') }}
                                            </span>
                                        </div>
                                    </div>
                                    <!--begin::Row-->
                                    <div class="row g-10 service-content">
                                        @php
                                        $ROUser = \App\Models\Tenant\RestaurantUser::find(1);
                                        @endphp
                                        @foreach ($AdsPackages as $package)
                                        <!--begin::Col branch slot -->
                                        <div class="col-md-6">
                                            <div class="row" style="min-height: 290px">
                                                <div class="col-md-5">
                                                    <div class="text-gray-400 fw-bold w-100 mt-6">
                                                        <img src="{{ $package->image_for_tenants }}" class="rounded w-100" alt="">
                                                    </div>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="mt-6">
                                                        <h1 class="text-dark mb-5 fw-boldest text-center">{{ $package->name }}</h1>
                                                        <p class="text-dark my-5 fw-boldest text-center d-block text-muted">{{ $package->description }}</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    @php
                                                    $hasPendingRequest = tenancy()->central(function () use ($ROUser,$package) {
                                                    $user = \App\Models\User::where('email', $ROUser->email)->first();
                                                    return \App\Models\AdsRequest::where('status','pending')
                                                    ->where('user_id',$user->id)
                                                    ->where('advertisement_package_id',$package->id)
                                                    ->count();
                                                    });
                                                    @endphp
                                                    @if(!$hasPendingRequest)
                                                    <form id="advertisement-form" action="{{route('restaurant.advertisements.store',['advertisement' => $package->id])}}" method="POST">
                                                        @csrf
                                                        <button href="#" type="button" id="request-button" class="btn btn-sm btn-khardl w-100">{{__("Request for service")}}</button>
                                                        <div class="modal fade" id="priceModal" tabindex="-1" aria-labelledby="priceModalLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="priceModalLabel">{{ __("Type the price of the advertising campaign you want") }}</h5>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <label for="price" class="my-2">{{ __("Price") }}</label>
                                                                            <input type="number" class="form-control my-2" id="price" name="price" required placeholder="{{ __('Price in SAR') }}">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" id="buy-button" class="btn btn-khardl">{{ __("Request") }}</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                    @else
                                                    <button href="#" type="button" class="btn btn-sm btn-darken w-100">{{__("Waiting for response")}}</button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
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
                    <div class="container-xxl mt-5">
                        <div class="card">
                            <div class="card-title">
                                <div class="mb-5 text-center mt-6">
                                    <h3 class="fs-2hx fw-bolder mb-5">
                                        {{__('Your requested advertisement packages')}}
                                    </h3>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-body py-3">
                                        <!--begin::Table container-->
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                                <!--begin::Table head-->
                                                <thead>
                                                    <tr class="fw-bolder text-muted">
                                                        <th class="min-w-25px">#</th>
                                                        <th class="min-w-200px">{{ __('Package')}}</th>
                                                        <th class="min-w-150px">{{ __('Name')}}</th>
                                                        <th class="min-w-150px">{{ __('Status')}}</th>
                                                        <th class="min-w-150px">{{ __('Price')}}</th>
                                                        <th class="min-w-150px">{{ __('Orde date')}}</th>
                                                    </tr>
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody>
                                                    @foreach ($requestedPackages as $request)
                                                    <tr>
                                                        <td class="text-muted fw-bolder">
                                                            {{ $request?->id }}
                                                        </td>
                                                        <td>
                                                            @if ($request?->advertisement_package?->image_for_tenants)
                                                            <div class="symbol symbol-60px symbol-lg-60px symbol-fixed position-relative">
                                                                <img alt="package image" src="{{ $request?->advertisement_package->image_for_tenants }}" />
                                                            </div>
                                                            @else
                                                            <div class="symbol symbol-60px symbol-lg-60px symbol-fixed position-relative">
                                                                <img alt="package image" src="{{ global_asset('images/advertisement.png') }}" />
                                                            </div>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <span>{{ $request?->advertisement_package?->name }}</span>
                                                        </td>
                                                        <td>
                                                            <span class="badge {{ $request->status }}">
                                                                {{ __($request->status) }}
                                                            </span>
                                                            @if($request->status == 'contacted')
                                                            <br>
                                                            <span>({{ $request->answered_at?->format('Y-m-d') }})</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            <span>{{ $request?->price }} {{ __('SAR') }}</span>
                                                        </td>
                                                        <td>
                                                            {{ $request->created_at?->format('Y-m-d') }}
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Table container-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--end::Post-->
                </div>
                <!--end::Content-->
                @endif

            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Root-->
    <!--end::Main-->
</div>
@section('js')
<script>
    document.getElementById('request-button').addEventListener('click', function(event) {
        event.preventDefault();
        $('#priceModal').modal('show');
    });

    document.getElementById('buy-button').addEventListener('click', function() {
        var priceInput = document.getElementById('price');
        if (priceInput.value.trim() === '') {
            alert(__('Please enter a price.'));
            return;
        }
        document.getElementById('advertisement-form').submit();
    });

</script>

@endsection
@endsection
