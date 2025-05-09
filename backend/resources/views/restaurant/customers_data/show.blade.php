@extends('layouts.restaurant-sidebar')

@section('title', __('customers-data'))

@section('content')
<style>
    .google_map {
        position: static !important;
        width: 100%;
        height: 500px;

    }

</style>
<div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Order details page-->
            <div class="d-flex flex-column gap-7 gap-lg-10">
                <div class="d-flex flex-wrap flex-stack gap-5 gap-lg-10">
                    <!--begin:::Tabs-->
                    <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-lg-n2 me-auto">
                        <!--begin:::Tab item-->
                        <li class="nav-item">
                            <a class="nav-link text-active-khardl pb-4 active" data-bs-toggle="tab" id="summary" href="#kt_ecommerce_sales_order_summary">{{ __('Customer Summary') }}</a>
                        </li>
                        <!--end:::Tab item-->
                        <!--begin:::Tab item-->
                        @if (Auth::user()?->hasPermissionWorker('can_mange_orders'))
                        <li class="nav-item">
                            <a class="nav-link text-active-khardl pb-4" data-bs-toggle="tab" id="order_history" href="#kt_ecommerce_sales_order_history">{{ __('Order History') }}</a>
                        </li>
                        @endif
                        <!--end:::Tab item-->
                    </ul>
                    <!--end:::Tabs-->
                    <!--begin::Button-->

                </div>
                <!--begin::Order summary-->
                <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">

                    <!--begin::Customer details-->
                    <div class="card card-flush py-4 flex-row-fluid">
                        <!--begin::Card header-->
                        <div class="card-header">
                            <div class="card-title">
                                <h2>{{ __('Customer') }}</h2>
                            </div>
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                    <!--begin::Table body-->
                                    <tbody class="fw-bold text-gray-600">
                                        <!--begin::Customer name-->
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                                                    <span class="svg-icon svg-icon-2 me-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="currentColor" />
                                                            <path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->{{ __('Customer') }}</div>
                                            </td>
                                            <td class="fw-bolder text-end">
                                                <div class="d-flex align-items-center justify-content-end">
                                                    <!--begin::Name-->
                                                    <a href="../../demo1/dist/apps/ecommerce/customers/details.html" class="text-gray-600 text-hover-khardl">{{ $restaurantUser->full_name }}</a>
                                                    <!--end::Name-->
                                                </div>
                                            </td>
                                        </tr>
                                        <!--end::Customer name-->
                                        <!--begin::Customer email-->
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
                                                    <span class="svg-icon svg-icon-2 me-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z" fill="currentColor" />
                                                            <path d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z" fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->{{ __('Email') }}</div>
                                            </td>
                                            <td class="fw-bolder text-end">
                                                <a href="../../demo1/dist/apps/user-management/users/view.html" class="text-gray-600 text-hover-khardl">{{ $restaurantUser->email }}</a>
                                            </td>
                                        </tr>
                                        <!--end::Payment method-->
                                        <!--begin::Date-->
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Svg Icon | path: icons/duotune/electronics/elc003.svg-->
                                                    <span class="svg-icon svg-icon-2 me-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path d="M5 20H19V21C19 21.6 18.6 22 18 22H6C5.4 22 5 21.6 5 21V20ZM19 3C19 2.4 18.6 2 18 2H6C5.4 2 5 2.4 5 3V4H19V3Z" fill="currentColor" />
                                                            <path opacity="0.3" d="M19 4H5V20H19V4Z" fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->{{ __('Phone') }}</div>
                                            </td>
                                            <td class="fw-bolder text-end">+{{ $restaurantUser->phone }}</td>
                                        </tr>
                                        <!--end::Date-->
                                        <!--begin::Date-->
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Svg Icon | path: icons/duotune/electronics/elc003.svg-->
                                                    <i class="bi bi-person-badge mx-2"></i>
                                                    <!--end::Svg Icon-->{{ __('Status') }}</div>
                                            </td>
                                            <td class="fw-bolder text-end">
                                                <span class="badge {{ $restaurantUser->status }}">
                                                    {{__("$restaurantUser->status")}}
                                                </span>
                                            </td>
                                        </tr>
                                        <!--end::Date-->
                                        <!--begin::Date-->
                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Svg Icon | path: icons/duotune/electronics/elc003.svg-->
                                                    <i class="bi bi-house mx-2"></i>
                                                    <!--end::Svg Icon-->{{ __('Addresses') }}</div>
                                            </td>
                                            <td class="fw-bolder text-end">
                                                @if($restaurantUser->addresses()->count())
                                                <div id="carouselExample" class="carousel slide" data-bs-interval="false">

                                                    <div class="carousel-inner">
                                                        @foreach ($restaurantUser->addresses->chunk(4) as $key => $addresses)

                                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                            <div class="row ">
                                                                @foreach ($addresses as $address)
                                                                <div class="col-md-3 d-flex justify-content-center">
                                                                    <a href="https://www.google.com/maps?q={{ $address->lat }},{{ $address->lng }}" target="_blank" style="min-width: 140px;" class="btn btn-sm btn-active-light-khardl ">
                                                                        <span class="d-inline-block text-truncate" style="max-width: 120px;margin:-7px"> <i class="bi bi-box-arrow-up-right"></i> {{ $address->address }} </span>
                                                                    </a>
                                                                </div>

                                                                @endforeach
                                                            </div>

                                                        </div>
                                                        @endforeach
                                                    </div>
                                                    <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                        <span class="sr-only">Previous</span>
                                                    </a>
                                                    <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
                                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                        <span class="sr-only">Next</span>
                                                    </a>
                                                </div>
                                                @else
                                                <span>{{ __('No address found') }}</span>
                                                @endif
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="text-muted">
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Svg Icon | path: icons/duotune/electronics/elc003.svg-->
                                                    <i class="bi bi-clock-fill mx-2"></i>
                                                    <!--end::Svg Icon-->{{ __('Last login') }}</div>
                                            </td>
                                            <td class="fw-bolder text-end">
                                                {{ $restaurantUser->last_login?->format('Y-m-d') }}
                                            </td>
                                        </tr>
                                        <!--end::Date-->
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                        </div>
                        <!--end::Card body-->
                    </div>
                </div>
                <!--end::Order summary-->
                <!--begin::Tab content-->
                <div class="tab-content">
                    <!--begin::Tab pane-->

                    <!--end::Tab pane-->
                    <!--begin::Tab pane-->
                    @if (Auth::user()?->hasPermissionWorker('can_mange_orders'))
                    <div class="tab-pane fade" id="kt_ecommerce_sales_order_history" role="tab-panel">
                        <!--begin::Orders-->
                        <div class="d-flex flex-column gap-7 gap-lg-10">
                            <!--begin::Order history-->
                            <div class="card card-flush py-4 flex-row-fluid">
                                <form action="">
                                    @csrf
                                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                        <!--begin::Card title-->
                                        <div class="card-title">
                                            <h2>{{ __('Order History') }}</h2>
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
                                                <input type="text" name="search" value="{{ request('search')??'' }}" class="form-control form-control-solid w-250px ps-14" placeholder="{{__('search')}}" />
                                            </div>
                                            <div class="w-100 mw-150px">
                                                <!--begin::Select2-->
                                                <select class="form-select form-select-solid" name="status">
                                                    <option value="">{{ __('Status') }}</option>
                                                    <option value="pending" {{ request('status') =='pending' ? 'selected':'' }}>{{ __('Pending') }}</option>
                                                    <option value="received_by_restaurant" {{ request('status') =='received_by_restaurant' ? 'selected':'' }}>{{ __('received_by_restaurant') }}</option>
                                                    <option value="ready" {{ request('status') =='ready' ? 'selected':'' }}>{{ __('Ready') }}</option>
                                                    <option value="accepted" {{ request('status') =='accepted' ? 'selected':'' }}>{{ __('Accepted') }}</option>
                                                    <option value="completed" {{ request('status') =='completed' ? 'selected':'' }}>{{ __('Completed') }}</option>
                                                    <option value="cancelled" {{ request('status') =='cancelled' ? 'selected':'' }}>{{ __('Cancelled') }}</option>
                                                </select>
                                                <!--end::Select2-->
                                            </div>
                                            <div class="w-100 mw-150px">
                                                <!--begin::Select2-->
                                                <select class="form-select form-select-solid" name="payment_status">
                                                    <option value="">{{ __('Payment') }}</option>
                                                    <option value="paid" {{ request('payment_status') =='paid' ? 'selected':'' }}>{{ __('Paid') }}</option>
                                                    <option value="pending" {{ request('payment_status') =='pending' ? 'selected':'' }}>{{ __('Pending') }}</option>
                                                </select>
                                                <!--end::Select2-->
                                            </div>
                                            <div class="w-100 mw-150px">
                                                <!--begin::Select2-->
                                                <select class="form-select form-select-solid" name="date_string">
                                                    <option value="">{{ __('Date') }}</option>
                                                    <option value="today" {{ request('date_string') =='today' ? 'selected':'' }}>{{ __('Today') }}</option>
                                                    <option value="last_day" {{ request('date_string') =='last_day' ? 'selected':'' }}>{{ __('Last day') }}</option>
                                                    <option value="last_week" {{ request('date_string') =='last_week' ? 'selected':'' }}>{{ __('Last week') }}</option>
                                                    <option value="this_month" {{ request('date_string') =='this_month' ? 'selected':'' }}>{{ __('This Month') }}</option>
                                                    <option value="last_month" {{ request('date_string') =='last_month' ? 'selected':'' }}>{{ __('Last Month') }}</option>
                                                    <option value="this_year" {{ request('date_string') =='this_year' ? 'selected':'' }}>{{ __('This Year') }}</option>
                                                    <option value="last_year" {{ request('date_string') =='last_year' ? 'selected':'' }}>{{ __('Last Year') }}</option>
                                                </select>
                                                <!--end::Select2-->
                                            </div>
                                            <button class="btn btn-khardl" type="submit">{{ __('Search') }}</button>
                                        </div>
                                        <!--end::Card toolbar-->
                                    </div>
                                </form>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <div class="table-responsive">
                                        <!--begin::Table-->
                                        <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                            <!--begin::Table head-->
                                            <thead>
                                                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                                    <th class="min-w-100px">{{ __('ID') }}</th>
                                                    <th class="min-w-100px">{{ __('Date Added') }}</th>
                                                    <th class="min-w-175px">{{ __('Total') }}</th>
                                                    <th class="min-w-100px">{{ __('Branch') }}</th>
                                                    <th class="min-w-70px">{{ __('Status') }}</th>
                                                    <th class="min-w-70px">{{ __('Payment Status') }}</th>
                                                    <th class="min-w-70px">{{ __('Type') }}</th>
                                                    <th class="min-w-70px">{{ __('Address') }}</th>
                                                </tr>
                                            </thead>
                                            <!--end::Table head-->
                                            <!--begin::Table body-->
                                            <tbody class="fw-bold text-gray-600">
                                                @foreach ($orders as $order)
                                                <tr>
                                                    <td>
                                                        <a href="{{ route('restaurant.branch.order',$order->id) }}">
                                                            {{ $order->id }}
                                                        </a>
                                                    </td>
                                                    <td>
                                                        {{ $order->created_at }}
                                                    </td>
                                                    <td>
                                                        {{ $order->total }}
                                                    </td>
                                                    <td>
                                                        {{ $order->branch?->name }}
                                                    </td>
                                                    <td>
                                                        <span class="badge {{ $order->status }}">
                                                            {{__("$order->status")}}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        <span class="badge {{ $order->payment_status }}">
                                                            {{__("$order->payment_status")}}
                                                        </span>
                                                    </td>
                                                    <td>
                                                        {{ __(''.$order->delivery_type?->name) }}
                                                    </td>
                                                    <td>
                                                        {{ $order->shipping_address }}
                                                    </td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                            <!--end::Table head-->
                                        </table>
                                        {{ $orders->withQueryString()->links('pagination::bootstrap-4') }}
                                        <!--end::Table-->
                                    </div>
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Order history-->

                        </div>
                        <!--end::Orders-->
                    </div>
                    @endif
                    <!--end::Tab pane-->
                </div>
                <!--end::Tab content-->
            </div>
            <!--end::Order details page-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<style>
    .carousel-control-prev-icon {
        background-image: url('/img/next.png')
    }

    .carousel-control-next-icon {
        background-image: url('/img/prev.png')
    }

    .carousel-inner {
        position: relative;
        width: 70%;
        margin: 0 115px;
        padding: 6px 0px;
    }

</style>
@endsection
@section('js')

<script>
    $(document).ready(function() {
        $('#carouselExample').carousel({
            pause: true
            , interval: false
        , });
        const urlParams = new URLSearchParams(window.location.search);
        const pageParam = urlParams.get('page');
        const statusParam = urlParams.get('status');
        const paymentStatusParam = urlParams.get('payment_status');
        const searchParam = urlParams.get('search');
        const DateStringParam = urlParams.get('date_string');

        if (pageParam || statusParam || paymentStatusParam || searchParam || DateStringParam) {
            $('#summary').removeClass('active');
            $('#order_history').addClass('active');
            $('#kt_ecommerce_sales_order_history').addClass('active show');
            $('#kt_ecommerce_sales_order_summary').removeClass('active show');
            $('html, body').animate({
                scrollTop: $('#kt_ecommerce_sales_order_history').offset().top + 700
            }, 800);
        }
        $('.nav-link').on('click', function(e) {
            e.preventDefault();
            var targetTabId = $(this).attr('href');
            $('html, body').animate({
                scrollTop: $(targetTabId).offset().top + 700
            }, 800);
        });
    });
    // initializeMapOnClick("{{$restaurantUser->id}}", "{{$restaurantUser->lat ?? ''}}", "{{$restaurantUser->lng ?? ''}}");

</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
