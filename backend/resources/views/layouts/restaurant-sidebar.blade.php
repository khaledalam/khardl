@if(!Auth::user()->isRestaurantOwner())
    @include('layouts.worker-sidebar')
@else
<!DOCTYPE html>
<html @if(app()->getLocale() === 'ar') dir="rtl" style="direction: rtl" @endif lang="{{ app()->getLocale() }}">

<head>
    <title>{{ __('khardl')}} | @yield('title', __('dashboard'))</title>
    <meta charset="utf-8" />
    <meta name="description" content="Kardl" />
    <meta name="keywords" content="Kardl" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="website" />
    <meta property="og:title" content="__('khardl')}}" />
    <meta property="og:url" content="khardl.com" />
    <meta property="og:site_name" content="__('khardl')}}" />
    <link rel="canonical" href="{{ global_asset('images/Logo_White.svg')}}" />
    <link rel="shortcut png" href="{{ global_asset('images/Logo_White.svg')}}"/>
    <link rel="icon" href="{{ global_asset('images/Logo_White.svg')}}"/>
    <!--begin::Fonts-->
    <!--end::Fonts-->
    <!--begin::Page Vendor Stylesheets(used by this page)-->
    <link href="{{ global_asset('assets/css/global.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{ global_asset('assets/css/resturant-main.css')}}" rel="stylesheet" type="text/css" />
    @if(app()->getLocale() === 'ar')
        <link href="{{ global_asset('assets/css/global-ar.css')}}" rel="stylesheet" type="text/css" />
        <link href="{{ global_asset('assets/css/resturant-main-ar.css')}}" rel="stylesheet" type="text/css" />
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

    @stack('styles')
    @yield('css')

    @if(app()->getLocale() === 'ar')
        <style>
        .menu-item.menu-accordion.show:not(.hiding):not(.menu-dropdown) > .menu-link .menu-arrow:after, .menu-item.menu-accordion.showing:not(.menu-dropdown) > .menu-link .menu-arrow:after {
            transform: rotateZ(270deg);
            transition: transform 0.3s ease;
        }
        </style>
    @endif

<!--end::Global Stylesheets Bundle-->
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body"
      class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="
      --kt-toolbar-height: 55px;
      --kt-toolbar-height-tablet-and-mobile: 55px;">


<div class="page-loader flex-column">
    <span class="spinner-border text-primary" role="status"></span>
    <span class="text-muted fs-6 fw-semibold mt-5">Loading...</span>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
    <script>
        showAlert('success', '{{ session('success') }}');

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
    showAlert('error', {!! json_encode($errors->all()) !!});
    @endif

    function showAlert(type, messages) {
        Swal.fire({
            icon: type,
            title: '<ul><li>' + messages.join('</li><li>') + '</li></ul><br>',
            showConfirmButton: true,
            timer: 900000000
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
        <div id="kt_aside" class="aside aside-dark aside-hoverable" data-kt-drawer="true"
             data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}"
             data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}"
             data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">

            <!--begin::Brand-->
            <div class="aside-logo flex-column-auto" id="kt_aside_logo">
                <!--begin::Logo-->
                <a href="/">
                    <img alt="Logo" src="{{ global_asset('/images/Logo_White.svg') }}" class="h-30px" />
                </a>
                <!--end::Logo-->
                <!--begin::Aside toggler-->
                <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-khardl aside-toggle"
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
                    <div class="menu menu-column menu-title-gray-800 menu-state-title-khardl menu-state-icon-khardl menu-state-bullet-khardl menu-arrow-gray-500"
                         id="#kt_aside_menu" data-kt-menu="true" data-kt-menu-expand="false">
                        <!-- Dashboard -->
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
                       <!-- Branches -->
                       <div class="menu-item menu-accordion">
                           <a href="{{route('restaurant.branches')}}">
                            <span class="{{ ($link == 'branches') ? 'menu-link active' : 'menu-link ' }}">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon -->
                                        <span class="svg-icon svg-icon-2">
                                            <i class="fas fa-building"></i>
                                        </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">{{__('branches')}}</span>
                            </span>
                           </a>
                        </div>
                        <!-- menu -->
                        <div class="menu-item menu-accordion">
                            @if( $id = \App\Models\Tenant\Branch::first()?->id)
                            <a href="{{route('restaurant.get-category', ['id' => \App\Models\Tenant\Category::where('branch_id', $id)?->first()?->id ?? -1, 'branchId' => $id])}}">
                                <span class="{{ ($link == 'menu') ? 'menu-link active' : 'menu-link ' }}">
                                    <span class="menu-icon">
                                        <!--begin::Svg Icon -->
                                        <span class="svg-icon svg-icon-2">
                                            <i class="fas fa-utensils"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">{{__('menu')}}</span>

                                </span>
                            </a>
                            @else
                            <a href="{{route('restaurant.no_branches')}}">
                                <span class="{{ ($link == 'menu') ? 'menu-link active' : 'menu-link ' }}">
                                    <span class="menu-icon">
                                        <!--begin::Svg Icon -->
                                        <span class="svg-icon svg-icon-2">
                                            <i class="fas fa-utensils"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">{{__('menu')}}</span>
                                </span>
                            </a>
                            @endif
                        </div>
                        <!-- menu -->

                        <!-- workers -->
                        <div class="menu-item menu-accordion">
                            @if( $id = \App\Models\Tenant\Branch::first()?->id)

                            <a href="{{route('restaurant.workers',['branchId' => $id])}}">
                                <span class="{{ ($link == 'workers') ? 'menu-link active' : 'menu-link ' }}">
                                    <span class="menu-icon">
                                        <!--begin::Svg Icon -->
                                        <span class="svg-icon svg-icon-2">
                                            <i class="fas fa-users"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">{{__('staff-modification')}}</span>
                                </span>
                            </a>
                            @else
                            <a href="{{route('restaurant.no_branches')}}">
                                <span class="{{ ($link == 'workers') ? 'menu-link active' : 'menu-link ' }}">
                                    <span class="menu-icon">
                                        <!--begin::Svg Icon -->
                                        <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="{{ ($link == 'workers') ? '#c2da08' : '#000000' }}" class="bi bi-person" viewBox="0 0 16 16">
                                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" /> </svg> </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">{{__('staff-modification')}}</span>
                                </span>
                            </a>
                            @endif
                        </div>
                        <!-- drivers -->
                        <div class="menu-item menu-accordion">
                            @if(\App\Models\Tenant\Branch::first())
                            <a href="{{route('drivers.index')}}">
                                <span class="{{ ($link == 'drivers') ? 'menu-link active' : 'menu-link ' }}">
                                    <span class="menu-icon">
                                        <span class="svg-icon svg-icon-2">
                                            <i class="fas fa-motorcycle"></i>
                                        </span>
                                    </span>
                                    <span class="menu-title">{{__('drivers')}}</span>
                                </span>
                            </a>
                            @else
                            <a href="{{route('restaurant.no_branches')}}">
                                <span class="{{ ($link == 'drivers') ? 'menu-link active' : 'menu-link ' }}">
                                    <span class="menu-icon">
                                        <!--begin::Svg Icon -->
                                        <span class="svg-icon svg-icon-2">
                                            <i class="fas fa-motorcycle"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">{{__('drivers')}}</span>
                                </span>
                            </a>
                            @endif
                        </div>

                    <!-- menu -->

                        <!-- Orders -->

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

                        @if($user?->hasPermission("can_access_restaurants"))
                        <!-- Restaurants -->
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{($link == 'promotions' || $link == 'coupons')  ? 'show' : ''}}">
                            <span class="{{ ($link == 'promotions' || $link == 'coupons')? 'menu-link active ' : 'menu-link' }}">
                                <span class="menu-icon">
                                    <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm007.svg-->
                                    <i class="fa fa-store"></i>
                                        <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">{{ __('Promotions')}} </span>
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
                                        <span class="menu-title  {{($link == 'coupons') ? 'text-khardl  ' : ''}}">{{ __('promotions')}}</span>
                                    </a>
                                </div>


                                <!-- Staff evaluation -->
                                <div class="menu-item">
                                    <a class="menu-link {{($link == 'coupons') ? 'bg-black  ' : ''}}" href="{{ route('coupons.index') }}">
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
                        <!-- Coupons -->

                        @if(\App\Models\Tenant\Setting::first()?->is_live && \App\Models\ROSubscription::first()?->status == \App\Models\ROSubscription::ACTIVE)
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
                        <!-- Advertisement package  -->
                        <div class="menu-item menu-accordion">
                            <a href="{{route('restaurant.advertisements.index')}}">
                                <span class="{{ ($link == 'service' ) ? 'menu-link active' : 'menu-link ' }}">
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

                        <!-- QR maker -->
                        {{-- <div class="menu-item menu-accordion">
                            <a href="{{route('restaurant.qr')}}">
                                <span class="{{ ($link == 'qr' ) ? 'menu-link active' : 'menu-link ' }}">
                                    <span class="menu-icon">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen022.svg-->
                                        <span class="svg-icon svg-icon-2">
                                            <svg fill="{{ ($link == 'qr' ) ? '#c2da08' : '#000000' }}" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M21,2H15a1,1,0,0,0-1,1V9a1,1,0,0,0,1,1h1v2h2V10h2v2h2V3A1,1,0,0,0,21,2ZM18,8H16V4h4V8ZM3,10H9a1,1,0,0,0,1-1V3A1,1,0,0,0,9,2H3A1,1,0,0,0,2,3V9A1,1,0,0,0,3,10ZM4,4H8V8H4ZM5,16v2H3V16ZM3,20H5v2H3Zm4-2v2H5V18Zm0-2H5V14H7V12H9v4ZM5,12v2H3V12Zm9,3v1H13V14H11v4h3v3a1,1,0,0,0,1,1h6a1,1,0,0,0,1-1V15a1,1,0,0,0-1-1H16V12H14Zm6,1v4H16V16ZM9,18h2v2h1v2H7V20H9ZM13,6H11V4h2ZM11,8h2v4H11ZM5,5H7V7H5ZM17,5h2V7H17Zm2,14H17V17h2Z"></path></g></svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">{{__('qr-maker')}}</span>
                                </span>
                            </a>
                        </div> --}}
                        <!-- Customer data -->
                        <div class="menu-item menu-accordion">
                            <a href="{{route('customers_data.list')}}">
                                <span class="{{ ($link == 'customers-data' ) ? 'menu-link active' : 'menu-link ' }}">
                                    <span class="menu-icon">
                                        <i class="fa fa-user"></i>
                                    </span>
                                    <span class="menu-title">{{__('customers-data')}}</span>
                                </span>
                            </a>
                        </div>
                        <!-- Payments -->
                        <div class="menu-item menu-accordion">
                            <a href="{{route('tap.payments')}}">
                                <span class="{{ ($link == 'payments' ) ? 'menu-link active' : 'menu-link ' }}">
                                    <span class="menu-icon">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen022.svg-->
                                        <span class="svg-icon svg-icon-2">
                                            <i class="fas fa-money-check"></i>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">{{__('payments')}} </span>
                                </span>
                            </a>
                        </div>
                         <!-- Settings -->
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
        @include('restaurant.components.payment-tap-documents-alert')
        @include('restaurant.components.subscription-alert')
        @include('restaurant.components.mobile-alert')
        <!--begin::Header-->
            <div id="kt_header" class="header align-items-stretch">
                <!--begin::Container-->
                <div class="container-fluid d-flex align-items-stretch justify-content-between">
                    <!--begin::Aside mobile toggle-->
                    <div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show aside menu">
                        <div class="btn btn-icon btn-active-light-khardl w-30px h-30px w-md-40px h-md-40px"
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
                                <div data-kt-swapper="true" data-kt-swapper-mode="prepend"
                                     data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}"
                                     class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
                                    <!--begin::Title-->
                                    <h1 class="d-flex text-dark fw-bolder fs-3 align-items-center my-1">
                                    @yield('title', 'Dashboard')
                                    @if(isset($refresh))
                                        <div class="d-flex justify-content-center mx-1">
                                            <a href="{{route('restaurant.summary')}}?refresh=true"  style="cursor: pointer">
                                                <span class="btn-tooltip" data-bs-toggle="tooltip" title="{{ __('This will refresh the summary result of page, note that the results will be refresh automatically for every :hour hours.',['hours' => calculateHours($cacheSeconds)]) }}" data-container="body" data-animation="true" data-bs-toggle="tooltip">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="30" height="30" fill="currentColor" class="bi bi-arrow-counterclockwise" viewBox="0 0 16 16">
                                                        <path fill-rule="evenodd" d="M8 3a5 5 0 1 1-4.546 2.914.5.5 0 0 0-.908-.417A6 6 0 1 0 8 2v1z" />
                                                        <path d="M8 4.466V.534a.25.25 0 0 0-.41-.192L5.23 2.308a.25.25 0 0 0 0 .384l2.36 1.966A.25.25 0 0 0 8 4.466z" />
                                                    </svg>
                                                </span>
                                            </a>
                                        </div>
                                    @endif
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
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-khardl fw-bold py-4 fs-6 w-275px"
                                     data-kt-menu="true">
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-3">
                                        <div class="menu-content d-flex align-items-center px-3">
                                            <!--begin::Avatar-->
                                        <a href="{{route('restaurant.profile')}}" >
                                            <div class="symbol symbol-50px me-5">
                                                <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M6.28548 15.0861C7.34369 13.1814 9.35142 12 11.5304 12H12.4696C14.6486 12 16.6563 13.1814 17.7145 15.0861L19.3493 18.0287C20.0899 19.3618 19.1259 21 17.601 21H6.39903C4.87406 21 3.91012 19.3618 4.65071 18.0287L6.28548 15.0861Z" fill="{{ ($link == 'profile' ) ? '#c2da08' : '#000000' }}" />
                                                <rect opacity="0.9" x="8" y="3" width="8" height="8" rx="4" fill="{{ ($link == 'profile' ) ? '#c2da08' : '#000000' }}" />
                                            </svg>
                                                </span>
                                            </div>
                                        </a>
                                            <!--end::Avatar-->
                                            <!--begin::Username-->
                                            <div class="d-flex flex-column">
                                                <div class="fw-bolder d-flex align-items-center fs-5">
                                                    {{Auth::user()->first_name}} {{Auth::user()->last_name}}
                                                </div>
                                                <a href="{{route('restaurant.profile')}}"
                                                   class="fw-bold text-muted text-hover-khardl fs-7">{{ Auth::user()->email }}</a>
                                                <small class="my-4">{{__("Restaurant code")}}
                                                    <code id="r-code" class="cursor-pointer">{{tenant()->mapper_hash}}</code>
                                                    <i  lass="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip"
                                                    title="{{ __('This code is required when workers log in to the restaurant and also when retrieving the password.') }}">
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
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-5">
                                        <a href="{{ route('tenant_logout') }}"
                                           class="menu-link px-5" onclick="event.preventDefault();
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
            <div class="footer mt-20 py-2 d-flex flex-lg-column" id="kt_footer">
                <!--begin::Container-->
                <div
                    class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                    <!--begin::Copyright-->
                    <div class="text-dark order-2 order-md-1">
                        <span class="text-muted fw-bold me-1">{{date('Y')}} ©</span>
                        <a href="/" target="_blank"
                           class="text-gray-800 text-hover-khardl">{{__('khardl')}}</a>
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
@yield('js')
@stack('scripts')
@if(env('SENTRY_LARAVEL_DSN'))
    <script
        src="https://js.sentry-cdn.com/860125ea20f9254e5c411ffbdeb02c39.min.js"
        crossorigin="anonymous"
    ></script>
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
@endif
