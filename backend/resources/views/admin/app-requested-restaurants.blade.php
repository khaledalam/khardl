@extends('layouts.admin-sidebar')
@section('title', __('Restaurants that have requested mobile apps'))
@section('content')
<div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Form-->
            <!--end::Form-->
            <!--begin::Toolbar-->
            <div class="d-flex flex-wrap flex-stack pb-7">
                <!--begin::Title-->
                <div class="d-flex flex-wrap align-items-center my-1">
                    <h3 class="fw-bolder me-5 my-1">{{ $restaurants->count() }} {{ __('restaurants-found')}} ({{__('from')}} {{$totalRestaurantsCount}} {{__('restaurant-singular')}})</h3>
                </div>
                <!--end::Title-->
                <div id="kt_project_users_table_pane" class="tab-pane fade show active" style="width:100%">
                    <!--begin::Card-->
                    <div class="card card-flush">
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Table container-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table id="kt_project_users_table" class="table table-row-bordered table-row-dashed gy-4 align-middle fw-bolder">
                                    <!--begin::Head-->
                                    <thead class="fs-7 text-gray-400 text-uppercase">
                                        <tr>
                                            <th class="min-w-250px">{{ __('owner')}}</th>
                                            <th class="min-w-150px">{{ __('Request date')}}</th>
                                            <th class="min-w-90px">{{ __('Icon')}}</th>
                                            <th class="min-w-90px">{{ __('status')}}</th>
                                            <th class="min-w-90px">{{ __('Start date')}}</th>
                                            <th class="min-w-90px">{{ __('End date')}}</th>
                                            <th class="min-w-90px">{{ __('Android URL')}}</th>
                                            <th class="min-w-90px">{{ __('IOS URL')}}</th>

                                        </tr>
                                    </thead>
                                    <!--end::Head-->
                                    <!--begin::Body-->
                                    <tbody class="fs-6">
                                        @foreach ($restaurants as $restaurant)
                                        <tr>
                                            <td>
                                                <!--begin::User-->
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Wrapper-->
                                                    <div class="me-5 position-relative">
                                                        <!--begin::Avatar-->
                                                        <div class="symbol symbol-35px symbol-circle">
                                                            @php
                                                            $customer_app = null;
                                                            $is_live = null;
                                                            $logo = null;
                                                            $restaurant->run(function() use ($restaurant,&$customer_app,&$is_live,&$logo){
                                                            $logo = App\Models\Tenant\RestaurantStyle::first()->logo;
                                                            $customer_app = App\Models\ROCustomerAppSub::first();
                                                            $is_live = $restaurant->is_live();
                                                            });
                                                            @endphp
                                                            @if ($is_live&&$logo)
                                                            <img alt="Logo" src="{{ $logo }}" class="logo" />
                                                            @else
                                                            <img alt="Logo" src="{{ global_asset('assets/default_logo.png') }}" class="logo" />
                                                            @endif
                                                        </div>
                                                        <!--end::Avatar-->
                                                    </div>
                                                    <!--end::Wrapper-->
                                                    <!--begin::Info-->

                                                    <div class="d-flex flex-column justify-content-center">
                                                        <a href="{{ route('admin.view-restaurants', ['tenant' => $restaurant->id]) }}?config=1" class="mb-1 text-gray-800 text-hover-khardl">{{ $restaurant->restaurant_name }}</a>
                                                        <div class="fw-bold fs-6 text-gray-400">{{ $restaurant->email }}</div>
                                                    </div>
                                                    <!--end::Info-->
                                                </div>
                                                <!--end::User-->
                                            </td>
                                            <td>{{ $customer_app?->getOriginal('created_at')?->format('Y-m-d') }}</td>
                                            <td>
                                                @if($customer_app->icon ?? null)
                                                <img src="{{$customer_app->icon}}" alt="" width="50" height="50" class="rounded-circle ">
                                                @endif
                                            </td>
                                            <td>
                                                @if($customer_app && $customer_app->status == \App\Models\ROSubscription::ACTIVE)
                                                <span class="badge badge-success fw-bolder">{{ __('active')}}</span>
                                                @elseif($customer_app && $customer_app->status == \App\Models\ROCustomerAppSub::SUSPEND)
                                                <span class="badge badge-light-danger fw-bolder">{{ __('payment overdue')}}</span>
                                                @elseif($customer_app && $customer_app->status == \App\Models\ROCustomerAppSub::DEACTIVATE)
                                                <span class="badge badge-light-warning fw-bolder">{{ __('cancellation request')}}</span>
                                                @elseif($customer_app && $customer_app->status == \App\Models\ROCustomerAppSub::REQUESTED)
                                                <span class="badge badge-khardl fw-bolder">{{ __('Request for app')}}</span>
                                                @else
                                                <span class="badge badge-light-danger fw-bolder">{{ __('not subscribed')}}</span>
                                                @endif
                                            </td>
                                            <td>{{ $customer_app?->start_at->format('Y-m-d') }}</td>

                                            <td>{{ $customer_app?->end_at->format('Y-m-d')}}</td>
                                            <td>
                                                @if($customer_app?->android_url)
                                                <div class="col-lg-8">
                                                    <span class="fw-bolder fs-6 text-gray-800">
                                                        <a href="{{ $customer_app->android_url}}" target="_blank">
                                                            <p class="text-gray-900 text-hover-khardl fs-2 fw-bolder me-1"><i class="fas fa-external-link-alt"></i></p>
                                                        </a>
                                                    </span>
                                                </div>
                                                @endif
                                            </td>
                                            <td>
                                                @if($customer_app?->ios_url)
                                                <div class="col-lg-8">
                                                    <span class="fw-bolder fs-6 text-gray-800">
                                                        <a href="{{ $customer_app->ios_url}}" target="_blank">
                                                            <p class="text-gray-900 text-hover-khardl fs-2 fw-bolder me-1"><i class="fas fa-external-link-alt"></i></p>
                                                        </a>
                                                    </span>
                                                </div>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                {{ $restaurants->withQueryString()->links('pagination::bootstrap-4') }}
                                <!--begin::Menu-->
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->

                            <!--end::Body-->
                            </table>
                            <!--end::Table-->
                        </div>
                        <!--end::Table container-->
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Controls-->
            </div>
            <!--end::Toolbar-->
            <!--begin::Tab Content-->

            <!--end::Card-->
        </div>
        <!--end::Col-->
        <!-- End foreach -->
    </div>
    <!--end::Row-->
    <!--begin::Pagination-->

</div>
@endsection
