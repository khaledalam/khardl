<!DOCTYPE html>
<html @if(app()->getLocale() === 'ar') dir="rtl" style="direction: rtl" @endif lang="{{ app()->getLocale() }}">

<head>
    <base href="" />
    <title>{{ __('khardl')}} | @yield('title', __('dashboard'))</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Khardl, Digital Ecosystem Solution For Restaurants, Create your website and app with Khardl in minutes, start selling right away, and pay based on your orders only">
    <meta name="keywords" content="Khardl, Restaurants Ecosystem, food">
    <meta name="author" content="Khardl">
    <meta property="og:title" content="Khardl - Digital Ecosystem Solution For Restaurants" />
    <meta property="og:description" content="Khardl, Digital Ecosystem Solution For Restaurants, Create your website and app with Khardl in minutes, start selling right away, and pay based on your orders only" />
    <meta property="og:image" content="{{ global_asset('images/Logo_White.svg')}}" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="canonical" href="{{ global_asset('images/Logo_White.svg')}}" />
    <link rel="shortcut png" href="{{ global_asset('images/Logo_White.svg')}}" />
    <link rel="icon" href="{{ global_asset('images/Logo_White.svg')}}" />
    <!--begin::Page Vendor Stylesheets(used by this page)-->
    <link href="{{ global_asset('assets/css/global.css')}}" rel="stylesheet" type="text/css" />
    @if(app()->getLocale() === 'ar')
    <link href="{{ global_asset('assets/css/global-ar.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ global_asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ global_asset('assets/plugins/custom/datatables/datatables.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
    <!--end::Page Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ global_asset('assets/plugins/global/plugins.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ global_asset('assets/css/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    @else
    <link href="{{ global_asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ global_asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
    <!--end::Page Vendor Stylesheets-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="{{ global_asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ global_asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    @endif
    @stack('styles')
    @yield('css')
    @if(app()->getLocale() === 'ar')
    <style>
        .menu-item.menu-accordion.show:not(.hiding):not(.menu-dropdown)>.menu-link .menu-arrow:after,
        .menu-item.menu-accordion.showing:not(.menu-dropdown)>.menu-link .menu-arrow:after {
            transform: rotateZ(270deg);
            transition: transform 0.3s ease;
        }

    </style>
    @endif
    <!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="
      --kt-toolbar-height: 55px;
      --kt-toolbar-height-tablet-and-mobile: 55px;">


    <div class="page-loader flex-column">
        <span class="spinner-border text-primary" role="status"></span>
        <span class="text-muted fs-6 fw-semibold mt-5">Loading...</span>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('success'))
    <script>
        showAlert('success', `{{ session('success') }}`);


        function showAlert(type, message) {
            Swal.fire({
                icon: type
                , title: message
                , showConfirmButton: false
                , timer: 3500
            });
        }

    </script>
    @endif

    @if(session('error'))
    <script>
        showAlert('error', `{{ session('error') }}`);

        function showAlert(type, message) {
            Swal.fire({
                icon: type
                , title: message
                , showConfirmButton: false
                , timer: 3500
            });
        }

    </script>
    @endif

    <script>
        @if($errors->any())
        showAlert('error', '<ul>@foreach ($errors->all() as $error)<li style="list-style-type: none">{{ $error }}</li>@endforeach</ul> <br>');
        @endif

        function showAlert(type, message) {
            Swal.fire({
                icon: type
                , title: message
                , showConfirmButton: true
                , timer: 900000000
            });
        }

    </script>

    <!--begin::Main-->
    <!--begin::Root-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">
            <!--begin::Aside-->
            <div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
                <!--begin::Brand-->
                <div class="aside-logo flex-column-auto" id="kt_aside_logo">
                    <!--begin::Logo-->
                    <a href="/">
                        <img alt="Logo" src="{{ global_asset('images/Logo_White.svg') }}" class="h-30px" />
                    </a>
                    <!--end::Logo-->
                    <!--begin::Aside toggler-->
                    <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-khardl aside-toggle" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="aside-minimize">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg-->
                        <span class="svg-icon svg-icon-1 rotate-180">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.5" d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z" fill="currentColor" />
                                <path d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z" fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Aside toggler-->
                </div>
                <!--end::Brand-->
                <!--begin::Aside menu-->
                <div class="aside-menu flex-column-fluid">
                    <!--begin::Aside Menu-->
                    <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
                        <!--begin::Menu-->
                        <div class="menu menu-column menu-title-gray-800 menu-state-title-khardl menu-state-icon-khardl menu-state-bullet-khardl menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true" data-kt-menu-expand="false">
                            <!-- Summary -->
                            @if($user?->hasPermissionWorker('can_access_summary'))
                            <div class="menu-item menu-accordion">
                                <a href="{{ route('restaurant.summary') }}">
                                    <span class="{{ ($link == 'summary' ) ? 'menu-link active' : 'menu-link ' }}">
                                        <span class="menu-icon">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                            <span class="svg-icon svg-icon-2">
                                                <i class="fas fa-chart-line"></i>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <span class="menu-title ">{{__('summary')}} </span>
                                    </span>
                                </a>
                            </div>
                            @endif
                            @if($user?->hasPermissionWorker('can_access_site_editor'))
                             <!-- Site Editor -->
                            <div class="menu-item menu-accordion">
                                <a href="{{route('restaurants.site_editor')}}" target="_blank">
                                    <span class="{{ ($link == 'site-editor' ) ? 'menu-link active' : 'menu-link ' }}">
                                        <span class="menu-icon">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                            <span class="svg-icon svg-icon-2">
                                                <i class="fas fa-window-maximize"></i>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>

                                            <span class="menu-title">{{__('site-editor')}} </span>
                                    </span>
                                </a>
                            </div>
                            @endif
                            <!-- Braches -->
                            <div class="menu-item menu-accordion">
                                <span class="{{ ($link == 'branches') ? 'menu-link active' : 'menu-link ' }}">
                                    <span class="menu-icon">
                                        <!--begin::Svg Icon -->
                                        <span class="svg-icon svg-icon-2">
                                            <i class="fas fa-building"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <a href="{{route('restaurant.branches')}}">
                                        <span class="menu-title">{{__('branches')}}</span>
                                    </a>
                                </span>
                            </div>
                            <!-- menu -->
                            @if($user?->hasPermissionWorker('can_edit_menu'))
                            <div class="menu-item menu-accordion">
                                <span class="{{ ($link == 'menu') ? 'menu-link active' : 'menu-link ' }}">
                                    <span class="menu-icon">
                                        <!--begin::Svg Icon -->
                                        <span class="svg-icon svg-icon-2">
                                            <i class="fas fa-utensils"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <a href="{{route('restaurant.get-category',['id' => \App\Models\Tenant\Category::where('branch_id', $user->branch?->id)?->first()?->id ?? -1, 'branchId' => $user->branch->id])}}">
                                        <span class="menu-title">{{__('menu')}}</span>
                                    </a>
                                </span>
                            </div>
                            @endif
                            @if($user?->hasPermissionWorker('can_modify_and_see_other_workers'))
                            <!-- Staff -->
                            <div class="menu-item menu-accordion {{ ($link == 'workers') ? 'show' : '' }}">
                                <a href="{{route('restaurant.workers', ['branchId' => $user->branch->id]) }}">
                                    <span class="{{ ($link == 'workers') ? 'menu-link active' : 'menu-link ' }}">
                                        <span class="menu-icon">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen022.svg-->
                                            <span class="svg-icon svg-icon-2">
                                                <i class="fas fa-users"></i>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <span class="menu-title">{{__('workers')}}</span>
                                    </span>
                                </a>
                            </div>
                            @endif
                            {{-- Orders --}}
                            @if($user?->hasPermissionWorker('can_mange_orders') && \App\Models\Tenant\Branch::first())
                            <div class="menu-item menu-accordion">
                                <a href="{{route('restaurant.orders_all')}}">
                                    <span class="{{ ($link == 'orders-all' || $link == 'orders-add') ? 'menu-link active' : 'menu-link ' }}">
                                        <span class="menu-icon">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen022.svg-->
                                            <span class="svg-icon svg-icon-2">
                                                <i class="fas fa-shopping-cart"></i>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <span class="menu-title">{{__('orders')}}</span>
                                    </span>
                                </a>
                            </div>
                            @endif
                            {{-- @if($user?->hasPermissionWorker('can_mange_table_reservations'))
                            <div class="menu-item menu-accordion">
                                <a href="{{route('table-reservations.index',['branchId'=>$user->branch->id])}}">
                                    <span class="{{ ($link == 'table-reservations') ? 'menu-link active' : 'menu-link ' }}">
                                        <span class="menu-icon">
                                             <!--begin::Svg Icon | path: icons/duotune/general/gen022.svg-->
                                            <span class="svg-icon svg-icon-2">
                                                <i class="fas fa-users"></i>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <span class="menu-title">{{__('Table reservations')}}</span>
                                    </span>
                                </a>
                            </div>
                            @endif --}}
                            <!-- Coupons -->
                            @if($user?->hasPermissionWorker('can_access_coupons'))
                            <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{($link == 'promotions' || $link == 'coupons')  ? 'show' : ''}}">
                                <span class="{{ ($link == 'promotions' || $link == 'coupons')? 'menu-link active ' : 'menu-link' }}">
                                    <span class="menu-icon">
                                        <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                        <i class="fa fa-store"></i>
                                            <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">{{ __('Discounts')}} </span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <div class="menu-sub menu-sub-accordion menu-active-bg">
                                    <div class="menu-item">
                                        <a class="menu-link {{($link == 'promotions') ? ' bg-black' : ''}}" href="{{ route('restaurant.promotions') }}">
                                            <span class="menu-icon">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen022.svg-->
                                                <span class="svg-icon svg-icon-2">
                                                    <i class="fas fa-percentage"></i>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <span class="menu-title  {{($link == 'promotions') ? 'text-khardl  ' : ''}}">{{ __('promotions')}}</span>
                                        </a>
                                    </div>


                                    <!-- Staff evaluation -->
                                    <div class="menu-item">
                                        <a class="menu-link {{($link == 'coupons') ? 'bg-black  ' : ''}}" href="{{ route('coupons.index',['branchId'=>$user->branch->id]) }}">
                                            <span class="menu-icon " >
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen022.svg-->
                                                <span class="svg-icon svg-icon-2">
                                                    <i class="bi bi-cash-stack"></i>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </span>
                                            <span class="menu-title {{($link == 'coupons') ? 'text-khardl  ' : ''}}">{{ __('Coupons')}}</span>
                                        </a>
                                    </div>



                                </div>
                            </div>
                            @endif
                            @if(
                            \App\Models\Tenant\Setting::first()?->is_live &&
                            \App\Models\ROSubscription::first()?->status == \App\Models\ROSubscription::ACTIVE &&
                            $user?->hasPermissionWorker('can_access_qr'))
                            <div class="menu-item menu-accordion">
                                <a href="{{route('restaurant.qr')}}">
                                    <span class="{{ ($link == 'qr' ) ? 'menu-link active' : 'menu-link ' }}">
                                        <span class="menu-icon">
                                            <!--begin::Svg Icon -->
                                                <span class="svg-icon svg-icon-2">
                                                <i class="bi bi-camera"></i>
                                                </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                            <span class="menu-title">{{__('QR Maker')}}</span>
                                    </span>
                                </a>
                            </div>
                            @endif
                            @if($user?->hasPermissionWorker('can_access_service_page'))
                              <!-- Services -->
                            <div class="menu-item menu-accordion">
                                <a href="{{route('restaurant.service')}}">
                                    <span class="{{ ($link == 'service' ) ? 'menu-link active' : 'menu-link ' }}">
                                        <span class="menu-icon">
                                            <!--begin::Svg Icon -->
                                                <span class="svg-icon svg-icon-2">
                                                    <i class="fa fa-cubes"></i>
                                                </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                            <span class="menu-title">{{__('services')}}</span>
                                    </span>
                                </a>
                            </div>
                            @endif
                            @if(Auth::user()?->hasPermissionWorker('can_access_advertising_services'))
                            <div class="menu-item menu-accordion">
                                <a href="{{route('restaurant.advertisements.index')}}">
                                    <span class="{{ ($link == 'advertisements-packages' ) ? 'menu-link active' : 'menu-link ' }}">
                                        <span class="menu-icon">
                                            <!--begin::Svg Icon -->
                                                <span class="svg-icon svg-icon-2">
                                                    <i class="fa fa-cubes"></i>
                                                </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                            <span class="menu-title">{{__('Advertising services')}}</span>
                                    </span>
                                </a>
                            </div>
                            @endif
                            @if(Auth::user()?->hasPermissionWorker('can_access_delivery_companies'))
                            <!-- Delivery Companies -->
                            <div class="menu-item menu-accordion">
                                <a href="{{route('restaurant.delivery')}}">
                                    <span class="{{ ($link == 'delivery' ) ? 'menu-link active' : 'menu-link ' }}">
                                        <span class="menu-icon">
                                            <!--begin::Svg Icon -->
                                                <span class="svg-icon svg-icon-2">
                                                    <i class="fas fa-shipping-fast"></i>
                                                </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <span class="menu-title">{{__('delivery-companies')}}</span>
                                    </span>
                                </a>
                            </div>
                            @endif
                            <!-- Customer data -->
                            @if($user?->hasPermissionWorker('can_access_customers_data'))
                            <div class="menu-item menu-accordion">
                                <a href="{{route('customers_data.list')}}">
                                    <span class="{{ ($link == 'customers-data' ) ? 'menu-link active' : 'menu-link ' }}">
                                        <span class="menu-icon">
                                            <span class="svg-icon svg-icon-2">
                                                <i class="fa fa-user"></i>
                                            </span>
                                        </span>
                                        <span class="menu-title">{{__('customers-data')}}</span>
                                    </span>
                                </a>
                            </div>
                            @endif
                            @if($user?->hasPermissionWorker('can_control_payment')&&App\Models\Tenant\Setting::first()->lead_id)
                            <!-- Payments -->
                            <div class="menu-item menu-accordion">
                                <a href="{{route('tap.payments')}}">
                                    <span class="{{ ($link == 'payments') ? 'menu-link active' : 'menu-link ' }}">
                                        <span class="menu-icon">
                                            <span class="svg-icon svg-icon-2">
                                                <i class="fas fa-money-check"></i>
                                            </span>
                                        </span>
                                        <span class="menu-title">{{__('payments')}}</span>
                                    </span>
                                </a>
                            </div>
                            @endif
                            <!-- Settings -->
                            @if($user?->hasPermissionWorker('can_access_settings'))
                            <div class="menu-item menu-accordion">
                                <a href="{{route('restaurant.settings')}}">
                                    <span class="{{ ($link == 'settings' ) ? 'menu-link active' : 'menu-link ' }}">
                                        <span class="menu-icon">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen022.svg-->
                                            <span class="svg-icon svg-icon-2">
                                                <i class="fas fa-cogs"></i>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <span class="menu-title">{{__('settings')}}</span>
                                    </span>
                                </a>
                            </div>
                            @endif
                        </div>
                        <!--end::Menu-->
                    </div>
                    <!--end::Aside Menu-->
                </div>
                <!--end::Aside menu-->
            </div>
            <!--end::Aside-->

            <!--begin::Wrapper-->
            <div class="m-4 wrapper d-flex flex-column flex-row-fluid position-relative" id="kt_wrapper">
                @include('restaurant.components.mobile-alert')
                <!--begin::Header-->
                <div id="kt_header" class="header align-items-stretch">
                    <!--begin::Container-->
                    <div class="container-fluid d-flex align-items-stretch justify-content-between">
                        <!--begin::Aside mobile toggle-->
                        <div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show aside menu">
                            <div class="btn btn-icon btn-active-light-khardl w-30px h-30px w-md-40px h-md-40px" id="kt_aside_mobile_toggle">
                                <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                                <span class="svg-icon svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="currentColor" />
                                        <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </div>
                        </div>
                        <!--end::Aside mobile toggle-->
                        <!--begin::Mobile logo-->
                        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                            <a href="/" class="d-lg-none">
                                <img alt="Logo" src="{{ global_asset('images/Logo_White.svg') }}" class="h-30px" />
                            </a>
                        </div>
                        <!--end::Mobile logo-->
                        <!--begin::Wrapper-->
                        <div class="d-flex align-items-stretch justify-content-between flex-lg-grow-1">
                            <!--begin::Navbar-->
                            <div class="d-flex align-items-stretch" id="kt_header_nav">
                                <!--begin::Menu wrapper-->
                                <div class="header-menu align-items-stretch">
                                    <!--begin::Page title-->
                                    <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                                        <!--begin::Title-->
                                        <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">
                                            @yield('title', 'Dashboard')
                                            <!--begin::Separator-->
                                            <span class="h-20px border-1 border-gray-200 border-start ms-3 mx-2 me-1"></span>
                                            <!--end::Separator-->
                                            <!--begin::Description-->
                                            <span class="text-muted fs-7 fw-bold mt-2">@yield('subtitle', '')</span>
                                            <!--end::Description-->
                                        </h1>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Page title-->
                                </div>
                                <!--end::Menu wrapper-->
                            </div>
                            <!--end::Navbar-->
                            <!--begin::Toolbar wrapper-->
                            <div class="d-flex align-items-stretch flex-shrink-0">

                                <!--begin::User menu-->
                                <div class="d-flex align-items-center ms-1 ms-lg-3" id="kt_header_user_menu_toggle">
                                    <!--begin::Menu wrapper-->
                                    <div class="cursor-pointer symbol symbol-30px symbol-md-40px" data-kt-menu-trigger="click" data-kt-menu-attach="parent" data-kt-menu-placement="bottom-end">
                                        <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="{{ ($link == 'profile' ) ? '#c2da08' : '#000000' }}" />
                                                <rect opacity="0.9" x="8" y="3" width="8" height="8" rx="4" fill="{{ ($link == 'profile' ) ? '#c2da08' : '#000000' }}" />
                                            </svg>
                                        </span>
                                    </div>
                                    <!--begin::User account menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-khardl fw-bold py-4 fs-6 w-275px" data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content d-flex align-items-center px-3">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-50px me-5">
                                                    <span class="svg-icon svg-icon-2">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                            <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="{{ ($link == 'profile' ) ? '#c2da08' : '#000000' }}" />
                                                            <rect opacity="0.9" x="8" y="3" width="8" height="8" rx="4" fill="{{ ($link == 'profile' ) ? '#c2da08' : '#000000' }}" />
                                                        </svg>
                                                    </span>
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Username-->
                                                <div class="d-flex flex-column">
                                                    <div class="fw-bolder d-flex align-items-center fs-5">
                                                        {{$user->first_name}} {{$user->last_name}}
                                                    </div>
                                                    <a href="#" class="fw-bold text-muted text-hover-khardl fs-7">{{ $user->email }}</a>
                                                    <small class="my-4">{{__("Restaurant code")}}
                                                        <code id="r-code" class="cursor-pointer">{{tenant()->mapper_hash}}</code>
                                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('This code is required when workers log in to the restaurant and also when retrieving the password.') }}">
                                                        </i>
                                                        <span id="copy-text" class="text-muted ms-1" style="display: none;">{{__('Copied')}}</span>
                                                    </small>
                                                </div>
                                                <!--end::Username-->
                                            </div>
                                        </div>
                                        <!--end::Menu item-->

                                        <!--begin::Menu separator-->
                                        <div class="separator my-2"></div>
                                        <!--end::Menu separator-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-5" data-kt-menu-trigger="hover" data-kt-menu-placement="left-start">
                                            <a href="#" class="menu-link px-5">
                                                <span class="menu-title position-relative">{{ __('language')}}
                                                    <span class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">@if(app()->getLocale() != 'ar'){{ __('english')}} @else {{ __('arabic')}} @endif
                                                        {{-- <img class="w-15px h-15px rounded-1 ms-2"--}}
                                                        {{-- @if(app()->getLocale() != 'ar')--}}
                                                        {{-- src="{{ global_asset('assets/media/flags/united-kingdom.svg') }}"--}}
                                                        {{-- @else--}}
                                                        {{-- src="{{ global_asset('assets/media/flags/saudi-arabia.svg') }}"--}}
                                                        {{-- @endif--}}
                                                        {{-- alt="" />--}}
                                                    </span></span>
                                            </a>
                                            <!--begin::Menu sub-->
                                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <form action="{{ route('change.language', 'en') }}" method="GET">
                                                        @csrf
                                                        <button style="border: 0;" type="submit" class="w-100 menu-link d-flex px-5 active">
                                                            <span class="symbol symbol-20px me-4">
                                                                {{-- <img class="rounded-1"--}}
                                                                {{-- src={{ global_asset('assets/media/flags/united-kingdom.svg') }} alt="" />--}}
                                                            </span>{{ __('english')}}</button>
                                                    </form>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item mt-1 px-3">
                                                    <form action="{{ route('change.language', 'ar') }}" method="GET">
                                                        @csrf
                                                        <button style="border: 0;" type="submit" class="w-100 menu-link d-flex px-5 active">
                                                            <span class="symbol symbol-20px me-4">
                                                                {{-- <img class="rounded-1" src="{{ global_asset('assets/media/flags/saudi-arabia.svg') }}"--}}
                                                                {{-- alt="" />--}}
                                                            </span>{{ __('arabic')}}</button>
                                                    </form>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu sub-->
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-5">
                                            <a href="{{ route('tenant_logout') }}" class="menu-link px-5" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">{{ __('sign-out')}}</a>
                                            <form id="logout-form" action="{{ route('tenant_logout') }}" method="POST" class="d-none">
                                                @csrf
                                            </form>
                                        </div>
                                        <!--end::Menu item-->

                                    </div>
                                    <!--end::User account menu-->
                                    <!--end::Menu wrapper-->
                                </div>
                                <!--end::User menu-->
                            </div>
                            <!--end::Toolbar wrapper-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Header-->
                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid pt-0">
                    @yield('content')
                </div>
                <!--end::Content-->
                <!--begin::Footer-->
                <div class="footer mt-10 py-2 d-flex flex-lg-column" id="kt_footer">
                    <!--begin::Container-->
                    <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <!--begin::Copyright-->
                        <div class="text-dark order-2 order-md-1">
                            <span class="text-muted fw-bold me-1">{{date('Y')}} ©</span>
                            <a href="#" target="_blank" class="text-gray-800 text-hover-khardl">{{__('khardl')}}</a>
                        </div>
                        <!--end::Copyright-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Footer-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Root-->
    <!--end::Main-->

    <!--begin::Scrolltop-->
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
        <span class="svg-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
                <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
            </svg>
        </span>
        <!--end::Svg Icon-->
    </div>
    <!--end::Scrolltop-->

    <!--begin::Javascript-->
    <script>
        var hostUrl = "global_assets/assets/";

    </script>
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="{{ global_asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ global_asset('assets/js/scripts.bundle.js')}}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Page Vendors Javascript(used by this page)-->

    <script src="{{ global_asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.js')}}"></script>
    <script src="{{ global_asset('assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>
    <!--end::Page Vendors Javascript-->
    <!--begin::Page Custom Javascript(used by this page)-->
    <script src="{{ global_asset('assets/js/widgets.bundle.js')}}"></script>
    <script src="{{ global_asset('assets/js/custom/widgets.js')}}"></script>
    <script src="{{ global_asset('assets/js/custom/apps/chat/chat.js')}}"></script>
    <script src="{{ global_asset('assets/js/custom/utilities/modals/upgrade-plan.js')}}"></script>
    <script src="{{ global_asset('assets/js/custom/utilities/modals/create-app.js')}}"></script>
    <script src="{{ global_asset('assets/js/custom/utilities/modals/users-search.js')}}"></script>

    @yield('js')
    @stack('scripts')

    @if(env('SENTRY_LARAVEL_DSN'))
    <script src="https://js.sentry-cdn.com/860125ea20f9254e5c411ffbdeb02c39.min.js" crossorigin="anonymous"></script>
    @endif

    <script>
         document.getElementById('r-code').addEventListener('click', function() {
            copyToClipboard(this.innerText);
            showCopiedText();
        });

        function copyToClipboard(text) {
            const el = document.createElement('textarea');
            el.value = text;
            document.body.appendChild(el);
            el.select();
            document.execCommand('copy');
            document.body.removeChild(el);
        }

        function showCopiedText() {
            const copiedText = document.getElementById('copy-text');
            copiedText.style.display = 'inline';
            setTimeout(function() {
                copiedText.style.display = 'none';
            }, 2000); // Hide the "Copied" text after 2 seconds
        }
        const r_code = document.getElementById("r-code");

        r_code.onclick = function() {
            document.execCommand("copy");
        }

        r_code.addEventListener("copy", function(event) {
            event.preventDefault();
            if (event.clipboardData) {
                event.clipboardData.setData("text/plain", r_code.textContent);
            }
        });

    </script>
    <!--end::Page Custom Javascript-->
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>
