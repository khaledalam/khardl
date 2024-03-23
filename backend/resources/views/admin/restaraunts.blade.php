@extends('layouts.admin-sidebar')
@section('title', __('restaurants'))
@section('content')
<div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Form-->
            <form action="{{ route('admin.restaurants') }}" method="GET">
                <!--begin::Card-->
                <div class="card mb-7">
                    <!--begin::Card body-->
                    <div class="card-body">
                        <!--begin::Compact form-->
                        <div class="d-flex align-items-center">
                            <!--begin::Input group-->
                            <div class="position-relative w-md-400px me-md-2">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                <span class="svg-icon svg-icon-3 svg-icon-gray-500 position-absolute top-50 translate-middle ms-6">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                                <input type="text" class="form-control form-control-solid ps-10" name="search" value="{{ request('search') }}" placeholder="{{ __('search') }}" />

                            </div>
                            <!--end::Input group-->
                            <!--begin::Col-->
                            <div class="position-relative w-md-200px me-md-2">
                                <select class="form-select form-select-solid" name="live">
                                    <option>{{ __('all')}}</option>
                                    <option value="1" {{ request('live') == '1' ? 'selected' : '' }}>{{ __('live')}}</option>
                                    <option value="0" {{ request('live') == '0' ? 'selected' : '' }}>{{ __('not_live')}}</option>
                                </select>
                                </select>
                            </div>
                            <div class="position-relative w-md-200px me-md-2">
                                <select class="form-select form-select-solid" name="order_by">
                                    <option >{{ __('Order by')}}</option>
                                    <option value="highest_orders" {{ request('order_by') === 'highest_orders' ? 'selected' : '' }}>{{ __('Highest orders')}}</option>
                                    <option value="highest_customers" {{ request('order_by') === 'highest_customers' ? 'selected' : '' }}>{{ __('Highest customers')}}</option>
                                </select>
                                </select>
                            </div>

                            <!--begin:Action-->
                            <div class="d-flex align-items-center">
                                <button type="submit" class="btn btn-primary me-5">{{ __('search')}}</button>
                            </div>
                            <!--end:Action-->
                        </div>
                        <!--end::Compact form-->

                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Card-->
            </form>
            <!--end::Form-->
            <!--begin::Toolbar-->
            <div class="d-flex flex-wrap flex-stack pb-7">
                <!--begin::Title-->
                <div class="d-flex flex-wrap align-items-center my-1">
                    <h3 class="fw-bolder me-5 my-1">{{ $restaurants->count() }} {{ __('restaurants-found')}} ({{__('from')}} {{$totalRestaurantsCount}} {{__('restaurant-singular')}})</h3>
                </div>
                <!--end::Title-->
                <!--begin::Controls-->
                <div class="d-flex flex-wrap my-1">
                    <!--begin::Tab nav-->
                    <ul class="nav nav-pills me-6 mb-2 mb-sm-0">
                        <li class="nav-item m-0">
                            <a class="btn btn-sm btn-icon btn-light btn-color-muted btn-active-primary me-3 active" data-bs-toggle="tab" href="#kt_project_users_card_pane">
                                <!--begin::Svg Icon | path: icons/duotune/general/gen024.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="5" y="5" width="5" height="5" rx="1" fill="currentColor" />
                                            <rect x="14" y="5" width="5" height="5" rx="1" fill="currentColor" opacity="0.3" />
                                            <rect x="5" y="14" width="5" height="5" rx="1" fill="currentColor" opacity="0.3" />
                                            <rect x="14" y="14" width="5" height="5" rx="1" fill="currentColor" opacity="0.3" />
                                        </g>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </a>
                        </li>
                        <li class="nav-item m-0">
                            <a class="btn btn-sm btn-icon btn-light btn-color-muted btn-active-primary" data-bs-toggle="tab" href="#kt_project_users_table_pane">
                                <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                                <span class="svg-icon svg-icon-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="currentColor" />
                                        <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </a>
                        </li>
                    </ul>
                    <!--end::Tab nav-->
                    <!--begin::Actions-->
                    <div class="d-flex my-0">
                        <!--begin::Select-->
                        <!--end::Select-->
                        <!--begin::Select-->
                        {{-- <select name="status" data-control="select2" data-hide-search="true" data-placeholder="Export" class="form-select form-select-sm border-body bg-body w-100px">
        <option value="1">Excel</option>
        <option value="1">PDF</option>
        <option value="2">Print</option>
      </select> --}}
                        <!--end::Select-->
                    </div>
                    <!--end::Actions-->
                </div>
                <!--end::Controls-->
            </div>
            <!--end::Toolbar-->
            <!--begin::Tab Content-->
            <div class="tab-content">
                <!--begin::Tab pane-->
                <div id="kt_project_users_card_pane" class="tab-pane fade show active">
                    <!--begin::Row-->
                    <div class="row g-6 g-xl-9">
                        <!-- Foreach -->
                        <!--begin::Col-->
                        @foreach($restaurants as $restaurant)
                        <div class="col-md-6 col-xxl-4">
                            <!--begin::Card-->
                            <div class="card">
                                <!--begin::Card body-->
                                <div class="card-body d-flex flex-center flex-column p-9 pt-3">

{{--                                    {{dd($restaurant)}}--}}
                                    <!--begin::Name-->
                                    <a href="{{ route('admin.view-restaurants', ['tenant' => $restaurant->id]) }}" class="fs-4 text-gray-800 text-hover-primary fw-bolder mb-0">
                                        @php
                                            $restaurant->run(function() use ($restaurant){
                                                $logo = App\Models\Tenant\RestaurantStyle::first()->logo;

												if ($restaurant->is_live()) {
                                                    echo <<<HTML
                                                        <img alt="Logo" src="$logo" class="h-70px logo" />
                                                    HTML;
												} else {
													echo '<img alt="Logo" src="'. global_asset('assets/default_logo.png') . '" class="h-70px logo" />';
												}

                                            });
                                        @endphp
                                        {{ $restaurant?->restaurant_name }}
                                        @if($restaurant?->is_live())
                                        <span class="badge badge-light-success fw-bolder">{{ __('live')}}</span>

                                        @elseif ($restaurant->user->status == \App\Models\User::STATUS_ACTIVE)
                                        <span class="badge badge-light-warning fw-bolder">{{ __('pending')}}</span>
                                        @elseif ($restaurant?->user?->isBlocked())
                                        <span class="badge badge-danger fw-bolder">{{ __('blocked')}}</span>
                                        @else
                                        <span class="badge badge-light-danger fw-bolder">{{ __('not_live')}}</span>
                                        @endif
                                    </a>

                                    <!--end::Name-->
                                    <!--begin::Position-->
                                    <div class="fw-bold text-gray-400 mb-6">{{ $restaurant->first_name }} {{ $restaurant->last_name }}</div>
                                    <!--end::Position-->

                                    <div class="d-flex flex-center flex-wrap">
                                        <!--begin::Stats-->
                                        <div class="border border-gray-300 border-dashed formatted_amount rounded min-w-80px py-3 px-4 mx-2 mb-3 position-relative" style="cursor: pointer;">
                                            <span class="currency_amount fade">{{ $restaurant->total_earning['number'] }} {{ __('SAR') }}</span>
                                            <div class="fs-6 fw-bolder text-gray-700 ">{{ $restaurant->total_earning['number_formatted'] }} {{ __('SAR') }}</div>
                                            <div class="fw-bold text-gray-400">{{ __('earnings')}}</div>
                                        </div>
                                        <!--end::Stats-->
                                        <!--begin::Stats-->
                                        <div class="border border-gray-300 border-dashed rounded res_total_orders min-w-80px py-3 px-4 mx-2 mb-3 position-relative">
                                            <span class="total_orders fade">{{ $restaurant->total_orders['number'] }}</span>
                                            <div class="fs-6 fw-bolder text-gray-700">{{ $restaurant->total_orders['number_formatted'] }}</div>
                                            <div class="fw-bold text-gray-400">{{ __('Completed orders')}}</div>
                                        </div>
                                        <!--end::Stats-->
                                        <!--begin::Action-->
                                        <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mb-3">
                                            <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">{{ __('actions')}}
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                                <span class="svg-icon svg-icon-5 m-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon--></a>
                                            <!--begin::Menu-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="{{ route('admin.view-restaurants', ['tenant' => $restaurant->id]) }}" class="menu-link px-3">{{ __('view')}}</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                {{-- <div class="menu-item px-3">
                                        <form id="delete-form{{ $restaurant->id }}" class="delete-form" action="{{ route('admin.delete-restaurant', ['id' => $restaurant->id]) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                                </form>
                                                <a href="#" class="menu-link px-3" onclick="showDeleteConfirmation('{{ $restaurant->id }}')" data-kt-ecommerce-product-filter="delete_row">{{ __('delete')}}</a>
                                            </div> --}}
                                            <script>
                                                var translations = @json([
                                                    'cancelIt' => __('cancel')
                                                    , 'yesDeleteIt' => __('yes-delete-it'),

                                                ]);
                                                var translationss = @json([
                                                    'confirmDelete' => __('confirm-delete')
                                                    , 'areYouSure' => __('are-you-sure-you-want-to-delete-this-restaurant'),

                                                ]);



                                                function showDeleteConfirmation(restaurantId) {
                                                    Swal.fire({
                                                        title: translationss.confirmDelete
                                                        , text: translationss.areYouSure
                                                        , icon: 'warning'
                                                        , showCancelButton: true
                                                        , confirmButtonText: translations.yesDeleteIt
                                                        , cancelButtonText: translations.cancelIt
                                                    }).then((result) => {
                                                        if (result.isConfirmed) {
                                                            document.getElementById('delete-form' + restaurantId).submit();
                                                        }
                                                    });
                                                }

                                            </script>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu-->
                                    </div>
                                    <!--end::Action-->
                                </div>

                                {{-- <!--begin::Info-->
                        <div class="d-flex flex-center flex-wrap">
                            <!--begin::Stats-->
                            <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                                <div class="fs-6 fw-bolder text-gray-700">$14,560</div>
                                <div class="fw-bold text-gray-400">{{ __('earnings')}}
                            </div>
                        </div>
                        <!--end::Stats-->
                        <!--begin::Stats-->
                        <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mx-2 mb-3">
                            <div class="fs-6 fw-bolder text-gray-700">230</div>
                            <div class="fw-bold text-gray-400">{{ __('orders')}}</div>
                        </div>
                        <!--end::Stats-->
                        <!--begin::Action-->
                        <div class="border border-gray-300 border-dashed rounded min-w-80px py-3 px-4 mb-3">
                            <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">{{ __('actions')}}
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                <span class="svg-icon svg-icon-5 m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon--></a>
                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="{{ route('admin.view-restaurants', ['tenant' => $restaurant->id]) }}" class="menu-link px-3">{{ __('view')}}</a>
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <form id="delete-form{{ $restaurant->id }}" class="delete-form" action="{{ route('admin.delete-restaurant', ['id' => $restaurant->id]) }}" method="POST">
                                        @method('DELETE')
                                        @csrf
                                    </form>
                                    <a href="#" class="menu-link px-3" onclick="showDeleteConfirmation('{{ $restaurant->id }}')" data-kt-ecommerce-product-filter="delete_row">{{ __('delete')}}</a>
                                </div>
                                <script>
                                    var translations = @json([
                                        'cancelIt' => __('cancel')
                                        , 'yesDeleteIt' => __('yes-delete-it'),

                                    ]);
                                    var translationss = @json([
                                        'confirmDelete' => __('confirm-delete')
                                        , 'areYouSure' => __('are-you-sure-you-want-to-delete-this-restaurant'),

                                    ]);



                                    function showDeleteConfirmation(restaurantId) {
                                        Swal.fire({
                                            title: translationss.confirmDelete
                                            , text: translationss.areYouSure
                                            , icon: 'warning'
                                            , showCancelButton: true
                                            , confirmButtonText: translations.yesDeleteIt
                                            , cancelButtonText: translations.cancelIt
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                document.getElementById('delete-form' + restaurantId).submit();
                                            }
                                        });
                                    }

                                </script>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                        </div>
                        <!--end::Action-->
                    </div> --}}
                    <!--end::Info-->
                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->
        </div>
        @endforeach
        <!--end::Col-->
        <!-- End foreach -->

    </div>
    <!--end::Row-->
    <!--begin::Pagination-->
    <div class="d-flex flex-stack flex-wrap pt-10">
        <div class="fs-6 fw-bold text-gray-700">
            {{ __('showing')}} {{ $restaurants->firstItem() }} {{ __('to')}} {{ $restaurants->lastItem() }} {{ __('of')}} {{ $restaurants->total() }} {{ __('entries')}}
        </div>
        <!--begin::Pages-->
        <ul class="pagination">
            @if ($restaurants->currentPage() > 1)
            <li class="page-item previous">
                <a href="{{ $restaurants->previousPageUrl() }}" class="page-link">
                    <i class="previous"></i>
                </a>
            </li>
            @endif

            @for ($page = max(1, $restaurants->currentPage() - 2); $page <= min($restaurants->lastPage(), $restaurants->currentPage() + 2); $page++)
                <li class="page-item {{ $page == $restaurants->currentPage() ? 'active' : '' }}">
                    <a href="{{ $restaurants->url($page) }}" class="page-link">{{ $page }}</a>
                </li>
                @endfor

                @if ($restaurants->hasMorePages())
                <li class="page-item next">
                    <a href="{{ $restaurants->nextPageUrl() }}" class="page-link">
                        <i class="next"></i>
                    </a>
                </li>
                @endif
        </ul>
        <!--end::Pages-->
    </div>
</div>
<!--end::Tab pane-->
<!--begin::Tab pane-->
<div id="kt_project_users_table_pane" class="tab-pane fade">
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
                            <th class="min-w-150px">{{ __('phone')}}</th>
                            <th class="min-w-90px">{{ __('status')}}</th>
                            <th class="min-w-90px">{{ __('orders')}}</th>
                            <th class="min-w-90px">{{ __('earnings')}}</th>
                            <th class="min-w-50px text-end">{{ __('actions')}}</th>
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
                                                $restaurant->run(function() use ($restaurant){
                                                    $logo = App\Models\Tenant\RestaurantStyle::first()->logo;

                                                    if ($restaurant->is_live()) {
                                                        echo <<<HTML
                                                            <img alt="Pic" src="$logo" />
                                                        HTML;
                                                    } else {
                                                        echo '<img alt="Pic" src="'. global_asset('assets/default_logo.png') . '" />';
                                                    }

                                                });
                                            @endphp
                                        </div>
                                        <!--end::Avatar-->
                                    </div>
                                    <!--end::Wrapper-->
                                    <!--begin::Info-->

                                    <div class="d-flex flex-column justify-content-center">
                                        <a href="{{ route('admin.view-restaurants', ['tenant' => $restaurant->id]) }}" class="mb-1 text-gray-800 text-hover-primary">{{ $restaurant->restaurant_name }}</a>
                                        <div class="fw-bold fs-6 text-gray-400">{{ $restaurant->email }}</div>
                                    </div>
                                    <!--end::Info-->
                                </div>
                                <!--end::User-->
                            </td>
                            <td>{{ $restaurant->phone_number }}</td>

                            <td>
                                @if($restaurant?->is_live())
                                <span class="badge badge-light-success fw-bolder">{{ __('live')}}</span>

                                @elseif ($restaurant->status == "active")
                                <span class="badge badge-light-warning fw-bolder">{{ __('pending')}}</span>
                                @elseif ($restaurant?->user?->isBlocked())
                                <span class="badge badge-danger fw-bolder">{{ __('blocked')}}</span>
                                @else
                                <span class="badge badge-light-danger fw-bolder">{{ __('not_live')}}</span>
                                @endif
                            </td>
                            <td>
                                <span class="badge badge-light-success fw-bolder px-4 py-3">{{ $restaurant->total_orders['number_formatted'] }}</span>
                            </td>
                            <td>
                                <span class="badge badge-light-success fw-bolder px-4 py-3">{{ $restaurant->total_earning['number_formatted'] }} {{ __('SAR') }}</span>
                            </td>
                            <td class="text-end">
                                <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">{{ __('actions')}}
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                    <span class="svg-icon svg-icon-5 m-0">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon--></a>
                                <!--begin::Menu-->
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <a href="{{ route('admin.view-restaurants', ['tenant' => $restaurant->id]) }}" class="menu-link px-3">{{ __('view')}}</a>
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    {{-- <div class="menu-item px-3">
                                                                  <form id="delete-form{{ $restaurant->id }}" class="delete-form" action="{{ route('admin.delete-restaurant', ['id' => $restaurant->id]) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <form>
                                        <a href="{{ route('admin.delete-restaurant', ['id' => $restaurant->id]) }}" onclick="event.preventDefault();
                                                                    document.getElementById('delete-form{{ $restaurant->id }}').submit();" class="menu-link px-3" data-kt-ecommerce-product-filter="delete_row">{{ __('delete')}}</a>
                                </div> --}}
                                <!--end::Menu item-->
            </div>
            <!--end::Menu-->
            </td>
            </tr>
            @endforeach

            </tbody>
            <!--end::Body-->
            </table>
            <!--end::Table-->
        </div>
        <!--end::Table container-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->
</div>
<!--end::Tab pane-->
</div>
<!--end::Tab Content-->
</div>
<!--end::Container-->
</div>
<!--end::Post-->
</div>
@endsection
