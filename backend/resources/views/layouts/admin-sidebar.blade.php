<!DOCTYPE html>
<html @if(app()->getLocale() === 'ar') dir="rtl" style="direction: rtl" @endif lang="{{ app()->getLocale() }}">
<head>
    <title>{{ __('khardl')}} | @yield('title', __('dashboard'))</title>
    <meta charset="utf-8" />
    <meta name="description" content="" />
    <meta name="keywords" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="" />
    <meta property="og:url" content="#/metronic" />
    <meta property="og:site_name" content="Keenthemes | Metronic" />
    <link rel="canonical" href="{{ global_asset('images/Logo.webp')}}" />
    <link rel="shortcut png" href="{{ global_asset('images/Logo.webp')}}"/>
    <link rel="icon" href="{{ global_asset('images/Logo.webp')}}"/>
    <!--begin::Page Vendor Stylesheets(used by this page)-->
    <link href="{{ global_asset('assets/css/global.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ global_asset('assets/css/admin-main.css')}}" rel="stylesheet" type="text/css" />
    @if(app()->getLocale() === 'ar')
        <link href="{{ global_asset('assets/css/global-ar.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ global_asset('assets/css/admin-main-ar.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ global_asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.rtl.css')}}"rel="stylesheet" type="text/css" />
        <link href="{{ global_asset('assets/plugins/custom/datatables/datatables.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
        <!--end::Page Vendor Stylesheets-->
        <!--begin::Global Stylesheets Bundle(used by all pages)-->
        <link href="{{ global_asset('assets/plugins/global/plugins.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ global_asset('assets/css/style.bundle.rtl.css')}}" rel="stylesheet" type="text/css" />
        <!--end::Global Stylesheets Bundle-->
    @else
        <link href="{{ global_asset('assets/plugins/custom/fullcalendar/fullcalendar.bundle.css')}}"rel="stylesheet" type="text/css" />
        <link href="{{ global_asset('assets/plugins/custom/datatables/datatables.bundle.css')}}" rel="stylesheet" type="text/css" />
        <!--end::Page Vendor Stylesheets-->
        <!--begin::Global Stylesheets Bundle(used by all pages)-->
        <link href="{{ global_asset('assets/plugins/global/plugins.bundle.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ global_asset('assets/css/style.bundle.css')}}" rel="stylesheet" type="text/css" />
    @endif
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body"
    class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="
      --kt-toolbar-height: 55px;
      --kt-toolbar-height-tablet-and-mobile: 55px;
    ">
    <!--begin::Main-->
    <!--begin::Root-->
   <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    @if(session('success'))
        <script>
            showAlert('success', '{{ session('success') }}');


            function showAlert(type, message) {
                    Swal.fire({
                        icon: type,
                        title: message,
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
        </script>
    @endif

    @if(session('error'))
        <script>
            showAlert('error', '{{ session('error') }}');

            function showAlert(type, message) {
                    Swal.fire({
                        icon: type,
                        title: message,
                        showConfirmButton: false,
                        timer: 3500
                    });
                }
        </script>
    @endif
    <script>
        @if ($errors->any())
        showAlert('error', '<ul>@foreach ($errors->all() as $error)<li style="list-style-type: none">{{ $error }}</li>@endforeach</ul> <br>');
        @endif

        function showAlert(type, message) {
            Swal.fire({
                icon: type,
                title: message,
                showConfirmButton: true,
                timer: 900000000
            });
        }
    </script>


    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">
            <!--begin::Aside-->
            <div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true"
                data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}"
                data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}"
                data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
                <!--begin::Brand-->
                <div class="aside-logo flex-column-auto" id="kt_aside_logo">
                    <!--begin::Logo-->
                    <a href="{{ route('admin.dashboard') }}">
                        <img alt="Logo" src="{{ global_asset('images/Logo.webp') }}" class="h-70px logo" />
                    </a>
                    <!--end::Logo-->
                    <!--begin::Aside toggler-->
                    <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle"
                        data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body"
                        data-kt-toggle-name="aside-minimize">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr079.svg-->
                        <span class="svg-icon svg-icon-1 rotate-180">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none">
                                <path opacity="0.5"
                                    d="M14.2657 11.4343L18.45 7.25C18.8642 6.83579 18.8642 6.16421 18.45 5.75C18.0358 5.33579 17.3642 5.33579 16.95 5.75L11.4071 11.2929C11.0166 11.6834 11.0166 12.3166 11.4071 12.7071L16.95 18.25C17.3642 18.6642 18.0358 18.6642 18.45 18.25C18.8642 17.8358 18.8642 17.1642 18.45 16.75L14.2657 12.5657C13.9533 12.2533 13.9533 11.7467 14.2657 11.4343Z"
                                    fill="currentColor" />
                                <path
                                    d="M8.2657 11.4343L12.45 7.25C12.8642 6.83579 12.8642 6.16421 12.45 5.75C12.0358 5.33579 11.3642 5.33579 10.95 5.75L5.40712 11.2929C5.01659 11.6834 5.01659 12.3166 5.40712 12.7071L10.95 18.25C11.3642 18.6642 12.0358 18.6642 12.45 18.25C12.8642 17.8358 12.8642 17.1642 12.45 16.75L8.2657 12.5657C7.95328 12.2533 7.95328 11.7467 8.2657 11.4343Z"
                                    fill="currentColor" />
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
                    <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
                        data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer"
                        data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
                        <!--begin::Menu-->
                        <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500"
                            id="#kt_aside_menu" data-kt-menu="true" data-kt-menu-expand="false">

                            <!-- Dashboard -->

                            <div class="menu-item">
                                <a href="{{ route('admin.dashboard') }}">
                                    <span class="{{ ($admin_link == 'dashboard' ) ? 'menu-link active' : 'menu-link ' }}">
                                        <span class="menu-icon">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen025.svg-->
                                            <span class="svg-icon svg-icon-2">
                                                <i class="fa fa-tachometer-alt"></i>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>

                                        <span class="menu-title">
                                            {{ __('dashboard')}}</span>
                                    </span>
                                </a>
                            </div>

                            <!-- Setting -->


                            @if($user?->hasPermission("can_access_restaurants"))
                                <!-- Restaurants -->
                                <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{($admin_link == 'restaurants' || $admin_link == 'app-requested' || $admin_link == 'restaurant-owner-management') ? 'show' : ''}}">
                                    <span class="{{ ($admin_link == 'restaurants' || $admin_link == 'restaurant-owner-management') ? 'menu-link active' : 'menu-link' }}">
                                        <span class="menu-icon">
                                            <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                            <i class="fa fa-store"></i>
                                                <!--end::Svg Icon-->
                                        </span>
                                        <span class="menu-title">{{ __('restaurants')}} </span>
                                        <span class="menu-arrow"></span>
                                    </span>
                                    <div class="menu-sub menu-sub-accordion menu-active-bg">
                                        <div class="menu-item">
                                            <a class="menu-link {{($admin_link == 'restaurants') ? 'active' : ''}}" href="{{ route('admin.restaurants') }}">
                                                <span class="menu-icon">
                                                    <span class="svg-icon svg-icon-2">
                                                        <i class="fa fa-store"></i>
                                                    </span>
                                                </span>
                                                <span class="menu-title">{{ __('all-restaurants')}}
                                                    {{--                                                    @if(($restaurantsAll  - $restaurantsLive) > 0)<span class="badge badge-danger mx-1">{{($restaurantsAll  - $restaurantsLive)}}</span>@endif--}}
                                                </span>
                                            </a>
                                        </div>


                                        @if($user?->hasPermission('can_see_restaurant_owners'))
                                            <!-- Staff evaluation -->
                                            <div class="menu-item">
                                                <a class="menu-link {{($admin_link == 'restaurant-owner-management') ? 'active' : ''}}" href="{{ route('admin.restaurant-owner-management') }}">
                                                    <span class="menu-icon">
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen022.svg-->
                                                        <span class="svg-icon svg-icon-2">
                                                            <i class=" fa fa-users"></i>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                    <span class="menu-title">{{ __('restaurant-owners')}}</span>
                                                </a>
                                            </div>
                                            @endif
                                        @if($user?->hasPermission('can_access_restaurants'))
                                            <!-- Staff evaluation -->
                                         
                                            <div class="menu-item">
                                                <a class="menu-link {{($admin_link == 'app-requested') ? 'active' : ''}}" href="{{ route('admin.restaurants.app-requested') }}">
                                                    <span class="menu-icon">
                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen022.svg-->
                                                        <span class="svg-icon svg-icon-2">
                                                            <i class="fa fa-mobile"></i>
                                                        </span>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                    <span class="menu-title">{{ __('Apps requested')}}</span>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            @if($user?->hasPermission('can_access_restaurants'))
                                <!-- Staff evaluation -->
                                    <div class="menu-item">
                                        <a class="menu-link {{($admin_link == 'order-inquiry') ? 'active' : ''}}" href="{{ route('admin.order-inquiry') }}">
                                                            <span class="menu-icon">
                                                                <!--begin::Svg Icon | path: icons/duotune/general/gen022.svg-->
                                                                <span class="svg-icon svg-icon-2">
                                                                    <i class=" fa fa-question"></i>
                                                                </span>
                                                                <!--end::Svg Icon-->
                                                            </span>
                                            <span class="menu-title">{{ __('order inquiry')}}</span>
                                        </a>
                                    </div>
                            @endif
                            <!-- Supports -->
                            @if($user?->hasPermission('can_see_admins') || $user?->hasPermission('can_add_admins'))
                            <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{($admin_link == 'user-management' || $admin_link == 'add-user') ? 'show' : ''}}">
                                <span class="{{ ($admin_link == 'user-management' || $admin_link == 'add-user'  ) ? 'menu-link active' : 'menu-link ' }}">
                                    <span class="menu-icon">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen022.svg-->
                                        <span class="svg-icon svg-icon-2">
                                           <i class=" fa fa-user-shield"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">{{ __('supports')}}</span>
                                    <span class="menu-arrow"></span>
                                </span>
                                <div class="menu-sub menu-sub-accordion menu-active-bg">
                                    @if($user?->hasPermission('can_see_admins'))
                                        <div class="menu-item">
                                            <a class="menu-link {{($admin_link == 'user-management') ? 'active' : ''}}" href="{{ route('admin.user-management') }}">
                                                <span class="menu-bullet">
                                                    <span class="bullet bullet-dot"></span>
                                                </span>
                                                <span class="menu-title">{{ __('all-supports')}}</span>
                                            </a>
                                        </div>
                                    @endif
                                    @if($user?->hasPermission('can_add_admins'))
                                    <div class="menu-item">
                                        <a class="menu-link {{($admin_link == 'add-user') ? 'active' : ''}}" href="{{ route('admin.add-user') }}">
                                            <span class="menu-bullet">
                                                <span class="bullet bullet-dot"></span>
                                            </span>
                                            <span class="menu-title">{{ __('add-supports')}}</span>
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                            @endif
                            @if($user?->hasPermission('can_promoters'))
                             <!-- Staff evaluation -->
                             <div class="menu-item">
                                <a href="{{ route('admin.promoters') }}">
                                <span class="{{ ($admin_link == 'promoters'  ) ? 'menu-link active' : 'menu-link ' }}">
                                    <span class="menu-icon">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen022.svg-->
                                        <span class="svg-icon svg-icon-2">
                                            <i class=" fa fa-bullhorn"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">{{ __('promoters')}}</span>
                                </span>
                            </a>
                            </div>
                            @endif
                            @if($user?->hasPermission('can_see_logs'))
                            <!-- Logs -->
                            <div class="menu-item">
                                <a href="{{ route('admin.log') }}">
                                <span class="{{ ($admin_link == 'logs'  ) ? 'menu-link active' : 'menu-link ' }}">
                                    <span class="menu-icon">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen022.svg-->
                                        <i class=" fa fa-history"></i>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">{{ __('logs')}}</span>
                                </span>
                            </a>
                            </div>
                            @endif
                            @if($user?->hasPermission('can_settings'))
                            <!-- Setting -->
                            <div class="menu-item">
                                <a href="{{ route('admin.settings') }}">
                                <span class="{{ ($admin_link == 'settings'  ) ? 'menu-link active' : 'menu-link ' }}">
                                    <span class="menu-icon">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen022.svg-->
                                        <span class="svg-icon svg-icon-2">
                                            <i class=" fa fa-cogs"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">{{ __('settings')}}</span>
                                </span>
                            </a>
                            </div>
                            @endif

                            @if($user?->email === env('SUPER_MASTER_ADMIN_EMAIL'))
                                <div class="menu-item menu-accordion">
                                    <a href="{{route('admin.subscriptions')}}">
                                    <span class="{{ ($admin_link == 'subscriptions' ) ? 'menu-link active' : 'menu-link ' }}">
                                        <span class="menu-icon">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen022.svg-->
                                            <span class="svg-icon svg-icon-2">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="{{ ($admin_link == 'subscriptions' ) ? '#c2da08' : '#000000' }}" class="bi bi-cash" viewBox="0 0 16 16">
                                                     <path d="M8 10a2 2 0 1 0 0-4 2 2 0 0 0 0 4z"/> <path d="M0 4a1 1 0 0 1 1-1h14a1 1 0 0 1 1 1v8a1 1 0 0 1-1 1H1a1 1 0 0 1-1-1V4zm3 0a2 2 0 0 1-2 2v4a2 2 0 0 1 2 2h10a2 2 0 0 1 2-2V6a2 2 0 0 1-2-2H3z"/> </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <span class="menu-title">{{__('subscriptions')}}</span>
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
            <div class="m-4 wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                <!--begin::Header-->
                <div id="kt_header" style="" class="header align-items-stretch">
                    <!--begin::Container-->
                    <div class="container-fluid d-flex align-items-stretch justify-content-between">
                        <!--begin::Aside mobile toggle-->
                        <div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show aside menu">
                            <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px"
                                id="kt_aside_mobile_toggle">
                                <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                                <span class="svg-icon svg-icon-1">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                        fill="none">
                                        <path
                                            d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z"
                                            fill="currentColor" />
                                        <path opacity="0.3"
                                            d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </div>
                        </div>
                        <!--end::Aside mobile toggle-->
                        <!--begin::Mobile logo-->
                        <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                            <a href="../../demo1/dist/index.html" class="d-lg-none">
                                <img alt="Logo" src="{{ global_asset('images/Logo.webp') }}" class="h-30px" />
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
                                    <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                                        data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                                        class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                                        <!--begin::Title-->
                                        <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">
                                            <a href="{{\URL::previous()}}" class="m-2"><i class="text-black fas fa-arrow-left"></i></a>
                                            @yield('title', 'Dashboard')
                                            <!--begin::Separator-->
                                            <span class="h-20px border-1 border-gray-200 border-start ms-3 mx-2 me-1"></span>
                                            <!--end::Separator-->
                                            <!--begin::Description-->
                                            <span class="text-muted fs-7 fw-bold mt-2"></span>
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
                                    <div class="cursor-pointer symbol symbol-30px symbol-md-40px"
                                        data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                                        data-kt-menu-placement="bottom-end">
                                        <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="{{ ($link == 'profile' ) ? '#c2da08' : '#000000' }}" />
                                                <rect opacity="0.9" x="8" y="3" width="8" height="8" rx="4" fill="{{ ($link == 'profile' ) ? '#c2da08' : '#000000' }}" />
                                            </svg>
                                        </span>
                                    </div>
                                    <!--begin::User account menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px"
                                        data-kt-menu="true">
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
                                        </span>
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Username-->
                                                <div class="d-flex flex-column">
                                                    <div class="fw-bolder d-flex align-items-center fs-5">
                                                        {{Auth::user()->first_name}} {{Auth::user()->last_name}}
                                                    </div>
                                                    <a href="#"
                                                       class="fw-bold text-muted text-hover-khardl fs-7">{{ Auth::user()->email }}</a>
                                                </div>
                                                <!--end::Username-->
                                            </div>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu separator-->

                                        <!--end::Menu separator-->

                                        <!--begin::Menu separator-->
                                        <div class="separator my-2"></div>

                                        <div class="menu-item px-5 my-1">
                                            <a href="{{ route('admin.profile') }}"
                                                class="menu-link px-5">{{ __('profile')}}</a>
                                        </div>
                                        <!--end::Menu separator-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-5" data-kt-menu-trigger="hover"
                                             data-kt-menu-placement="left-start">
                                            <a href="#" class="menu-link px-5">
                                                <span class="menu-title position-relative">{{ __('language')}}
                                                    <span
                                                        class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">@if(app()->getLocale() != 'ar'){{ __('english')}} @else {{ __('arabic')}} @endif
{{--                                                        <img class="w-15px h-15px rounded-1 ms-2"--}}
{{--                                                             @if(app()->getLocale() != 'ar')--}}
{{--                                                             src="{{ global_asset('assets/media/flags/united-kingdom.svg') }}"--}}
{{--                                                             @else--}}
{{--                                                             src="{{ global_asset('assets/media/flags/saudi-arabia.svg') }}"--}}
{{--                                                             @endif--}}
{{--                                                             alt="" />--}}
                                                    </span></span>
                                            </a>
                                            <!--begin::Menu sub-->
                                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <form action="{{ route('change.language', 'en') }}" method="GET">
                                                        @csrf
                                                        <button style="border: 0;" type="submit"
                                                                class="w-100 menu-link d-flex px-5 active">
                                                            <span class="symbol symbol-20px me-4">
{{--                                                                <img class="rounded-1"--}}
{{--                                                                     src={{ global_asset('assets/media/flags/united-kingdom.svg') }} alt="" />--}}
                                                            </span>{{ __('english')}}</button>
                                                    </form>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item mt-1 px-3">
                                                    <form action="{{ route('change.language', 'ar') }}" method="GET">
                                                        @csrf
                                                        <button style="border: 0;" type="submit"
                                                                class="w-100 menu-link d-flex px-5 active">
                                                        <span class="symbol symbol-20px me-4">
{{--                                                            <img class="rounded-1" src="{{ global_asset('assets/media/flags/saudi-arabia.svg') }}"--}}
{{--                                                                 alt="" />--}}
                                                        </span>{{ __('arabic')}}</button>
                                                    </form>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu sub-->
                                        </div>
                                        <!--end::Menu item-->
                                        @if($user?->hasPermission('can_see_logs'))
                                        <div class="menu-item px-5 my-1">
                                            <a href="{{ route('admin.log') }}" class="menu-link px-5">{{ __('Logs') }}</a>
                                        </div>
                                        @endif
                                        <!--begin::Menu item-->
                                        <div class="separator my-2"></div>
                                        <div class="menu-item px-5">
                                            <a href="{{ route('logout') }}"
                                                class="menu-link px-5" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">{{ __('sign-out')}}</a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                        </div>
                                        <!--end::Menu item-->

                                    </div>
                                    <!--end::User account menu-->
                                    <!--end::Menu wrapper-->
                                </div>
                                <!--end::User menu-->
                                <!--begin::Header menu toggle-->
                                <div class="d-flex align-items-center d-lg-none ms-2 me-n3" title="Show header menu">
                                    <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px"
                                        id="kt_header_menu_mobile_toggle">
                                        <!--begin::Svg Icon | path: icons/duotune/text/txt001.svg-->
                                        <span class="svg-icon svg-icon-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                viewBox="0 0 24 24" fill="none">
                                                <path
                                                    d="M13 11H3C2.4 11 2 10.6 2 10V9C2 8.4 2.4 8 3 8H13C13.6 8 14 8.4 14 9V10C14 10.6 13.6 11 13 11ZM22 5V4C22 3.4 21.6 3 21 3H3C2.4 3 2 3.4 2 4V5C2 5.6 2.4 6 3 6H21C21.6 6 22 5.6 22 5Z"
                                                    fill="currentColor" />
                                                <path opacity="0.3"
                                                    d="M21 16H3C2.4 16 2 15.6 2 15V14C2 13.4 2.4 13 3 13H21C21.6 13 22 13.4 22 14V15C22 15.6 21.6 16 21 16ZM14 20V19C14 18.4 13.6 18 13 18H3C2.4 18 2 18.4 2 19V20C2 20.6 2.4 21 3 21H13C13.6 21 14 20.6 14 20Z"
                                                    fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </div>
                                </div>
                                <!--end::Header menu toggle-->
                            </div>
                            <!--end::Toolbar wrapper-->
                        </div>
                        <!--end::Wrapper-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Header-->
                <!--begin::Content-->
                @yield('content')
                <!--end::Content-->
                <!--begin::Footer-->
                <div class="footer mt-10 py-2 d-flex flex-lg-column" id="kt_footer">
                    <!--begin::Container-->
                    <div
                        class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <!--begin::Copyright-->
                        <div class="text-dark order-2 order-md-1">
                            <span class="text-muted fw-bold me-1">{{date('Y')}} ©</span>
                            <a href="https://www.khardl.com" target="_blank"
                                class="text-gray-800 text-hover-primary">{{ __('khardl')}}</a>
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
                <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)"
                    fill="currentColor" />
                <path
                    d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                    fill="currentColor" />
            </svg>
        </span>
        <!--end::Svg Icon-->
    </div>
    <!--end::Scrolltop-->

    @yield('js')
    <!--begin::Javascript-->
    <script>
        var hostUrl = "assets/";
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

    @yield('javascript')
    @stack('scripts')

    @if(env('SENTRY_LARAVEL_DSN'))

        <script
            src="https://js.sentry-cdn.com/860125ea20f9254e5c411ffbdeb02c39.min.js"
            crossorigin="anonymous"
        ></script>
    @endif
    <!--end::Page Custom Javascript-->
    <!--end::Javascript-->
</body>
<!--end::Body-->

</html>
