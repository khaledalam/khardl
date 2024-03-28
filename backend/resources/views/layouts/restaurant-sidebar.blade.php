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
    <meta property="og:title" content="Kardl" />
    <meta property="og:url" content="Kardl.com" />
    <meta property="og:site_name" content="Kardl" />
    <link rel="canonical" href="{{ global_asset('images/Logo.webp')}}" />
    <link rel="shortcut png" href="{{ global_asset('images/Logo.webp')}}"/>
    <link rel="icon" href="{{ global_asset('images/Logo.webp')}}"/>
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
                    <img alt="Logo" src="{{ global_asset('/images/Logo.webp') }}" class="h-30px" />
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
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                 viewBox="0 0 24 24" fill="none">
                                                <rect x="2" y="2" width="9" height="9" rx="2" fill="{{ ($link == 'summary' ) ? '#c2da08' : '#000000' }}" />
                                                <rect opacity="0.3" x="13" y="2" width="9" height="9" rx="2"
                                                      fill="{{ ($link == 'summary' ) ? '#c2da08' : '#000000' }}" />
                                                <rect opacity="0.3" x="13" y="13" width="9" height="9" rx="2"
                                                      fill="{{ ($link == 'summary' ) ? '#c2da08' : '#000000' }}" />
                                                <rect opacity="0.3" x="2" y="13" width="9" height="9" rx="2"
                                                      fill="{{ ($link == 'summary' ) ? '#c2da08' : '#000000' }}" />
                                            </svg>
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
                                            <svg version="1.1" id="Icons" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 32 32" xml:space="preserve" fill="{{ ($link == 'site-editor' ) ? '#c2da08' : '#000000' }}"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <style type="text/css"> .st0{fill:none;stroke:#000000;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;} .st1{fill:none;stroke:#000000;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;} .st2{fill:none;stroke:#000000;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-dasharray:5.2066,0;} </style> <line class="st0" x1="3" y1="11" x2="29" y2="11"></line> <line class="st0" x1="7" y1="8" x2="7" y2="8"></line> <line class="st0" x1="10" y1="8" x2="10" y2="8"></line> <line class="st0" x1="13" y1="8" x2="13" y2="8"></line> <path class="st0" d="M8.8,27H3V5h26v22l-5.8,0c0.3-0.1,0.6-0.1,0.9-0.1c0.1-0.6,0.2-1.3,0.2-1.9c0-0.7-0.1-1.3-0.2-1.9 c-1,0.1-2-0.3-2.5-1.3c-0.5-0.9-0.4-2,0.2-2.8c-0.9-0.9-2.1-1.6-3.4-2c-0.4,0.9-1.3,1.6-2.4,1.6s-2-0.7-2.4-1.6 c-1.3,0.4-2.4,1.1-3.4,2c0.6,0.8,0.7,1.9,0.2,2.8c-0.5,0.9-1.6,1.4-2.5,1.3c-0.1,0.6-0.2,1.3-0.2,1.9c0,0.7,0.1,1.3,0.2,1.9 C8.2,26.9,8.5,26.9,8.8,27L8.8,27z"></path> <circle class="st0" cx="16" cy="25" r="3"></circle> </g></svg>
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
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path d="M21 9V11C21 11.6 20.6 12 20 12H14V8H20C20.6 8 21 8.4 21 9ZM10 8H4C3.4 8 3 8.4 3 9V11C3 11.6 3.4 12 4 12H10V8Z" fill="{{ ($link == 'branches') ? '#c2da08' : '#000000' }}" />
                                                <path d="M15 2C13.3 2 12 3.3 12 5V8H15C16.7 8 18 6.7 18 5C18 3.3 16.7 2 15 2Z" fill="{{ ($link == 'branches') ? '#c2da08' : '#000000' }}" />
                                                <path opacity="0.3" d="M9 2C10.7 2 12 3.3 12 5V8H9C7.3 8 6 6.7 6 5C6 3.3 7.3 2 9 2ZM4 12V21C4 21.6 4.4 22 5 22H10V12H4ZM20 12V21C20 21.6 19.6 22 19 22H14V12H20Z" fill="{{ ($link == 'branches') ? '#c2da08' : '#000000' }}" />
                                            </svg>
                                        </span>
                                    <!--end::Svg Icon-->
                                </span>
                                <span class="menu-title">{{__('branches')}}</span>
                            </span>
                           </a>
                        </div>
                        <!-- menu -->
                        <div class="menu-item menu-accordion">
                            @if( $id = \App\Models\Tenant\Branch::where('is_primary',true)->first()?->id)
                            <a href="{{route('restaurant.menu',['branchId' => $id])}}">
                                <span class="{{ ($link == 'menu') ? 'menu-link active' : 'menu-link ' }}">
                                    <span class="menu-icon">
                                        <!--begin::Svg Icon -->
                                        <span class="svg-icon svg-icon-2">
                                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path d="M16 6.00008V4.2844C16 3.51587 16 3.13161 15.8387 2.88321C15.6976 2.66587 15.4776 2.5118 15.2252 2.45345C14.9366 2.38677 14.5755 2.51809 13.8532 2.78073L6.57982 5.4256C6.01064 5.63257 5.72605 5.73606 5.51615 5.91845C5.33073 6.07956 5.18772 6.28374 5.09968 6.51304C5 6.77264 5 7.07546 5 7.6811V12.0001M9 17.0001H15M9 13.5001H15M9 10.0001H15M8.2 21.0001H15.8C16.9201 21.0001 17.4802 21.0001 17.908 20.7821C18.2843 20.5903 18.5903 20.2844 18.782 19.9081C19 19.4802 19 18.9202 19 17.8001V9.20008C19 8.07997 19 7.51992 18.782 7.0921C18.5903 6.71577 18.2843 6.40981 17.908 6.21807C17.4802 6.00008 16.9201 6.00008 15.8 6.00008H8.2C7.0799 6.00008 6.51984 6.00008 6.09202 6.21807C5.71569 6.40981 5.40973 6.71577 5.21799 7.0921C5 7.51992 5 8.07997 5 9.20008V17.8001C5 18.9202 5 19.4802 5.21799 19.9081C5.40973 20.2844 5.71569 20.5903 6.09202 20.7821C6.51984 21.0001 7.07989 21.0001 8.2 21.0001Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </g>
                                            </svg>
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
                                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <path d="M16 6.00008V4.2844C16 3.51587 16 3.13161 15.8387 2.88321C15.6976 2.66587 15.4776 2.5118 15.2252 2.45345C14.9366 2.38677 14.5755 2.51809 13.8532 2.78073L6.57982 5.4256C6.01064 5.63257 5.72605 5.73606 5.51615 5.91845C5.33073 6.07956 5.18772 6.28374 5.09968 6.51304C5 6.77264 5 7.07546 5 7.6811V12.0001M9 17.0001H15M9 13.5001H15M9 10.0001H15M8.2 21.0001H15.8C16.9201 21.0001 17.4802 21.0001 17.908 20.7821C18.2843 20.5903 18.5903 20.2844 18.782 19.9081C19 19.4802 19 18.9202 19 17.8001V9.20008C19 8.07997 19 7.51992 18.782 7.0921C18.5903 6.71577 18.2843 6.40981 17.908 6.21807C17.4802 6.00008 16.9201 6.00008 15.8 6.00008H8.2C7.0799 6.00008 6.51984 6.00008 6.09202 6.21807C5.71569 6.40981 5.40973 6.71577 5.21799 7.0921C5 7.51992 5 8.07997 5 9.20008V17.8001C5 18.9202 5 19.4802 5.21799 19.9081C5.40973 20.2844 5.71569 20.5903 6.09202 20.7821C6.51984 21.0001 7.07989 21.0001 8.2 21.0001Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                                                </g>
                                            </svg>
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
                            @if( $id = \App\Models\Tenant\Branch::where('is_primary',true)->first()?->id)

                            <a href="{{route('restaurant.workers',['branchId' => $id])}}">
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
                        {{-- //TODO: uncomment when driver app is ready --}}
                        <!-- drivers -->
                        {{-- <div class="menu-item menu-accordion">
                            @if(\App\Models\Tenant\Branch::first())
                            <a href="{{route('drivers.index')}}">
                                <span class="{{ ($link == 'drivers') ? 'menu-link active' : 'menu-link ' }}">
                                    <span class="menu-icon">
                                        <!--begin::Svg Icon -->
                                        <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="{{ ($link == 'workers') ? '#c2da08' : '#000000' }}" class="bi bi-person" viewBox="0 0 16 16">
                                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" /> </svg> </span>
                                        <!--end::Svg Icon-->
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
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="{{ ($link == 'workers') ? '#c2da08' : '#000000' }}" class="bi bi-person" viewBox="0 0 16 16">
                                                <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6zm2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0zm4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4zm-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10c-2.29 0-3.516.68-4.168 1.332-.678.678-.83 1.418-.832 1.664h10z" /> </svg> </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">{{__('staff-modification')}}</span>
                                </span>
                            </a>
                            @endif
                        </div> --}}

                    <!-- menu -->

                        <!-- Orders -->
                        <div data-kt-menu-trigger="click" class="menu-item menu-accordion {{ ($link == 'order-inquiry' || $link == 'orders-all' || $link == 'orders-add' || $link == 'unavailable-products') ? 'show' : '' }}">
                                <span class="menu-link">
                                    <span class="menu-icon">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen022.svg-->
                                        <span class="svg-icon svg-icon-2">
                                            <svg fill="{{ ($link == 'order-inquiry' || $link == 'orders-all' || $link == 'orders-add' || $link == 'products-out-of-stock') ? '#c2da08' : '#000000' }}" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 100 100" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M78.8,62.1l-3.6-1.7c-0.5-0.3-1.2-0.3-1.7,0L52,70.6c-1.2,0.6-2.7,0.6-3.9,0L26.5,60.4 c-0.5-0.3-1.2-0.3-1.7,0l-3.6,1.7c-1.6,0.8-1.6,2.9,0,3.7L48,78.5c1.2,0.6,2.7,0.6,3.9,0l26.8-12.7C80.4,65,80.4,62.8,78.8,62.1z"></path> </g> <g> <path d="M78.8,48.1l-3.7-1.7c-0.5-0.3-1.2-0.3-1.7,0L52,56.6c-1.2,0.6-2.7,0.6-3.9,0L26.6,46.4 c-0.5-0.3-1.2-0.3-1.7,0l-3.7,1.7c-1.6,0.8-1.6,2.9,0,3.7L48,64.6c1.2,0.6,2.7,0.6,3.9,0l26.8-12.7C80.4,51.1,80.4,48.9,78.8,48.1 z"></path> </g> <g> <path d="M21.2,37.8l26.8,12.7c1.2,0.6,2.7,0.6,3.9,0l26.8-12.7c1.6-0.8,1.6-2.9,0-3.7L51.9,21.4 c-1.2-0.6-2.7-0.6-3.9,0L21.2,34.2C19.6,34.9,19.6,37.1,21.2,37.8z"></path> </g> </g> </g></svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">{{__('orders')}}</span>
                                    <span class="menu-arrow"></span>
                                </span>
                            <div class="menu-sub menu-sub-accordion menu-active-bg">
                                <a href="{{route('restaurant.order-inquiry')}}">
                                    <div class="{{ ($link == 'order-inquiry') ? 'menu-link active' : 'menu-link ' }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot {{ ($link == 'order-inquiry') ? 'bg-light' : '' }}"></span>
                                        </span>
                                        <span class="menu-title">{{__('order inquiry')}}</span>
                                    </div>
                                </a>
                                <a href="{{route('restaurant.orders_all')}}">
                                    <div class="{{ ($link == 'orders-all') ? 'menu-link active' : 'menu-link ' }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot {{ ($link == 'orders-all') ? 'bg-light' : '' }}"></span>
                                        </span>
                                        <span class="menu-title">{{__('orders-all')}}</span>
                                    </div>
                                </a>
                                <a href="{{route('restaurant.orders_add')}}">
                                    <div class="{{ ($link == 'orders-add') ? 'menu-link active' : 'menu-link ' }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot {{ ($link == 'orders-add') ? 'bg-light' : '' }}"></span>
                                        </span>
                                        <span class="menu-title">{{__('orders-add')}}</span>
                                    </div>
                                </a>
                                <a href="{{route('restaurant.unavailable-products')}}">
                                    <div class="{{ ($link == 'unavailable-products') ? 'menu-link active' : 'menu-link ' }}">
                                        <span class="menu-bullet">
                                            <span class="bullet bullet-dot {{ ($link == 'unavailable-products') ? 'bg-light' : '' }}"></span>
                                        </span>
                                        <span class="menu-title">{{__('Unavailable products')}}</span>
                                    </div>
                                </a>
                            </div>
                        </div>
                           <!-- Coupons -->
                           <div class="menu-item menu-accordion">
                            <a href="{{route('coupons.index')}}">
                                <span class="{{ ($link == 'coupons' ) ? 'menu-link active' : 'menu-link ' }}">
                                    <span class="menu-icon">
                                        <!--begin::Svg Icon -->
                                            <span class="svg-icon svg-icon-2">
                                                <i class="bi bi-cash-stack"></i>
                                            </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                        <span class="menu-title">{{__('Coupons')}}</span>
                                </span>
                            </a>
                        </div>
                        <!-- Services -->
                        <div class="menu-item menu-accordion">
                            <a href="{{route('restaurant.service')}}">
                                <span class="{{ ($link == 'service' ) ? 'menu-link active' : 'menu-link ' }}">
                                    <span class="menu-icon">
                                        <!--begin::Svg Icon -->
                                            <span class="svg-icon svg-icon-2">
                                                <svg viewBox="0 0 24 24" version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" fill="{{ ($link == 'service' ) ? '#c2da08' : '#000000' }}"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <title></title> <g fill="none" fill-rule="evenodd" id="页面-1" stroke="none" stroke-linecap="round" stroke-linejoin="round" stroke-width="1"> <g id="导航图标" stroke="{{ ($link == 'service' ) ? '#c2da08' : '#000000' }}" stroke-width="1.5" transform="translate(-329.000000, -334.000000)"> <g id="服务" transform="translate(329.000000, 334.000000)"> <g id="编组" transform="translate(2.000000, 3.000000)"> <path d="M8,12.5 L11,13.5 C11,13.5 18.5,12 19.5,12 C20.5,12 20.5,13 19.5,14 C18.5,15 15,18 12,18 C9,18 7,16.5 5,16.5 C3,16.5 0,16.5 0,16.5" id="路径"></path> <path d="M0,10.5 C1,9.5 3,8 5,8 C7,8 11.75,10 12.5,11 C13.25,12 11,13.5 11,13.5" id="路径"></path> <path d="M6,5 L6,1 C6,0.447715 6.4477,0 7,0 L19,0 C19.5523,0 20,0.447715 20,1 L20,9" id="路径"></path> <rect height="4.5" id="矩形" width="5" x="10.5" y="0"></rect> </g> </g> </g> </g> </g></svg>
                                            </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                        <span class="menu-title">{{__('services')}}</span>
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
                                              <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g clip-path="url(#clip0_429_11129)"> <path d="M2 3V1.75C1.30964 1.75 0.75 2.30964 0.75 3L2 3ZM13 3H14.25C14.25 2.30964 13.6904 1.75 13 1.75V3ZM13 9V7.75C12.6685 7.75 12.3505 7.8817 12.1161 8.11612C11.8817 8.35054 11.75 8.66848 11.75 9H13ZM2 4.25H13V1.75H2V4.25ZM11.75 3V19H14.25V3H11.75ZM3.25 17V3H0.75V17H3.25ZM13 10.25H18V7.75H13V10.25ZM20.75 13V17H23.25V13H20.75ZM14.25 19L14.25 9H11.75L11.75 19H14.25ZM18.5303 19.5303C18.2374 19.8232 17.7626 19.8232 17.4697 19.5303L15.7019 21.2981C16.9711 22.5673 19.0289 22.5673 20.2981 21.2981L18.5303 19.5303ZM17.4697 18.4697C17.7626 18.1768 18.2374 18.1768 18.5303 18.4697L20.2981 16.7019C19.0289 15.4327 16.9711 15.4327 15.7019 16.7019L17.4697 18.4697ZM6.53033 19.5303C6.23744 19.8232 5.76256 19.8232 5.46967 19.5303L3.7019 21.2981C4.97111 22.5673 7.02889 22.5673 8.2981 21.2981L6.53033 19.5303ZM5.46967 18.4697C5.76256 18.1768 6.23744 18.1768 6.53033 18.4697L8.2981 16.7019C7.02889 15.4327 4.97111 15.4327 3.7019 16.7019L5.46967 18.4697ZM18.5303 18.4697C18.677 18.6164 18.75 18.8061 18.75 19H21.25C21.25 18.1702 20.9325 17.3363 20.2981 16.7019L18.5303 18.4697ZM18.75 19C18.75 19.1939 18.677 19.3836 18.5303 19.5303L20.2981 21.2981C20.9325 20.6637 21.25 19.8298 21.25 19H18.75ZM16 17.75H13V20.25H16V17.75ZM17.4697 19.5303C17.323 19.3836 17.25 19.1939 17.25 19H14.75C14.75 19.8298 15.0675 20.6637 15.7019 21.2981L17.4697 19.5303ZM17.25 19C17.25 18.8061 17.323 18.6164 17.4697 18.4697L15.7019 16.7019C15.0675 17.3363 14.75 18.1702 14.75 19H17.25ZM5.46967 19.5303C5.32298 19.3836 5.25 19.1939 5.25 19H2.75C2.75 19.8298 3.06755 20.6637 3.7019 21.2981L5.46967 19.5303ZM5.25 19C5.25 18.8061 5.32298 18.6164 5.46967 18.4697L3.7019 16.7019C3.06755 17.3363 2.75 18.1702 2.75 19H5.25ZM13 17.75H8V20.25H13V17.75ZM6.53033 18.4697C6.67702 18.6164 6.75 18.8061 6.75 19H9.25C9.25 18.1702 8.93245 17.3363 8.2981 16.7019L6.53033 18.4697ZM6.75 19C6.75 19.1939 6.67702 19.3836 6.53033 19.5303L8.2981 21.2981C8.93245 20.6637 9.25 19.8298 9.25 19H6.75ZM20.75 17C20.75 17.4142 20.4142 17.75 20 17.75V20.25C21.7949 20.25 23.25 18.7949 23.25 17H20.75ZM18 10.25C19.5188 10.25 20.75 11.4812 20.75 13H23.25C23.25 10.1005 20.8995 7.75 18 7.75V10.25ZM0.75 17C0.75 18.7949 2.20507 20.25 4 20.25V17.75C3.58579 17.75 3.25 17.4142 3.25 17H0.75Z" fill="{{ ($link == 'delivery' ) ? '#c2da08' : '#000000' }}"></path> <path d="M2 8H5" stroke="#292929" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path> <path d="M2 12H7" stroke="#292929" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path> </g> <defs> <clipPath id="clip0_429_11129"> <rect width="24" height="24" fill="white"></rect> </clipPath> </defs> </g></svg>
                                            </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">{{__('delivery-companies')}}</span>
                                </span>
                            </a>
                        </div>
                        <!-- Promotions -->
                        {{-- <div class="menu-item menu-accordion">
                            <a href="{{route('restaurant.promotions')}}">
                                <span class="{{ ($link == 'promotions' ) ? 'menu-link active' : 'menu-link ' }}">
                                    <span class="menu-icon">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen022.svg-->
                                        <span class="svg-icon svg-icon-2">
                                            <svg fill="{{ ($link == 'promotions' ) ? '#c2da08' : '#000000' }}" viewBox="0 0 52 52" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M15.1,2a1.68,1.68,0,0,1,1.71,1.63V4.85a1.68,1.68,0,0,1-1.63,1.71H10A3.4,3.4,0,0,0,6.56,9.81V42a3.4,3.4,0,0,0,3.25,3.41H42a3.4,3.4,0,0,0,3.41-3.25V36.9a1.68,1.68,0,0,1,1.63-1.71h1.22A1.67,1.67,0,0,1,50,36.82v6.35A6.82,6.82,0,0,1,43.18,50H8.83A6.82,6.82,0,0,1,2,43.18H2V8.83A6.83,6.83,0,0,1,8.82,2H15.1Z" fill-rule="evenodd"></path><path d="M38.11,21a2.23,2.23,0,1,0,2.25,2.23h0A2.22,2.22,0,0,0,38.14,21Z"></path><path d="M27.49,12.76A2.23,2.23,0,1,0,29.72,15a2.22,2.22,0,0,0-2.23-2.23Z"></path><path d="M49.1,16.87l-1.87-2.24a3.94,3.94,0,0,1-.93-2.31l-.22-2.86a3.66,3.66,0,0,0-3.35-3.41l-2.49-.2a5.3,5.3,0,0,1-3-1.28L35.35,2.91a3.68,3.68,0,0,0-4.79-.05L28.5,4.6a4.72,4.72,0,0,1-2.7,1.1l-2.67.18a3.69,3.69,0,0,0-3.42,3.36l-.19,2.44a5.28,5.28,0,0,1-1.29,3L16.6,16.59a3.67,3.67,0,0,0,0,4.78l1.77,2.14a4.42,4.42,0,0,1,1,2.54l.2,2.75a3.68,3.68,0,0,0,3.35,3.42l2.5.22a5.17,5.17,0,0,1,3,1.27l1.9,1.64a3.7,3.7,0,0,0,4.79,0l2.18-1.82a4.08,4.08,0,0,1,2.43-1l2.85-.21A3.68,3.68,0,0,0,46,29l.2-2.31a5.93,5.93,0,0,1,1.43-3.32l1.52-1.73A3.66,3.66,0,0,0,49.1,16.87ZM23.38,15a4.15,4.15,0,1,1,4.15,4.14h0A4.13,4.13,0,0,1,23.36,15v0Zm6,12.22a.39.39,0,0,1-.25.17H27.89a.33.33,0,0,1-.26-.16.29.29,0,0,1,0-.31L36.28,11a.4.4,0,0,1,.26-.16h1.29a.31.31,0,0,1,.15.42h0Zm12.94-4a4.15,4.15,0,1,1-4.17-4.12h0a4.13,4.13,0,0,1,4.12,4.15h0Z"></path></g></svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">{{__('promotions')}}</span>
                                </span>
                            </a>
                        </div> --}}
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
                                        <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path fill-rule="evenodd" clip-rule="evenodd" d="M1 5C1 3.34315 2.34315 2 4 2H8.43845C9.81505 2 11.015 2.93689 11.3489 4.27239L11.7808 6H13.5H20C21.6569 6 23 7.34315 23 9V10C23 10.5523 22.5523 11 22 11C21.4477 11 21 10.5523 21 10V9C21 8.44772 20.5523 8 20 8H13.5H11.7808H4C3.44772 8 3 8.44772 3 9V10V19C3 19.5523 3.44772 20 4 20H8C8.55228 20 9 20.4477 9 21C9 21.5523 8.55228 22 8 22H4C2.34315 22 1 20.6569 1 19V10V9V5ZM3 6.17071C3.31278 6.06015 3.64936 6 4 6H9.71922L9.40859 4.75746C9.2973 4.3123 8.89732 4 8.43845 4H4C3.44772 4 3 4.44772 3 5V6.17071ZM17 19C14.2951 19 13 20.6758 13 22C13 22.5523 12.5523 23 12 23C11.4477 23 11 22.5523 11 22C11 20.1742 12.1429 18.5122 13.9952 17.6404C13.3757 16.936 13 16.0119 13 15C13 12.7909 14.7909 11 17 11C19.2091 11 21 12.7909 21 15C21 16.0119 20.6243 16.936 20.0048 17.6404C21.8571 18.5122 23 20.1742 23 22C23 22.5523 22.5523 23 22 23C21.4477 23 21 22.5523 21 22C21 20.6758 19.7049 19 17 19ZM17 17C18.1046 17 19 16.1046 19 15C19 13.8954 18.1046 13 17 13C15.8954 13 15 13.8954 15 15C15 16.1046 15.8954 17 17 17Z" fill="{{ ($link == 'customers-data' ) ? '#c2da08' : '#000000' }}"></path> </g></svg>
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
                                            <svg viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M7 13C7 11.1144 7 10.1716 7.58579 9.58579C8.17157 9 9.11438 9 11 9H14H17C18.8856 9 19.8284 9 20.4142 9.58579C21 10.1716 21 11.1144 21 13V14V15C21 16.8856 21 17.8284 20.4142 18.4142C19.8284 19 18.8856 19 17 19H14H11C9.11438 19 8.17157 19 7.58579 18.4142C7 17.8284 7 16.8856 7 15V14V13Z" stroke="#323232" stroke-width="2" stroke-linejoin="round"></path> <path d="M7 15V15C5.11438 15 4.17157 15 3.58579 14.4142C3.58579 14.4142 3.58579 14.4142 3.58579 14.4142C3 13.8284 3 12.8856 3 11L3 9C3 7.11438 3 6.17157 3.58579 5.58579C4.17157 5 5.11438 5 7 5L13 5C14.8856 5 15.8284 5 16.4142 5.58579C17 6.17157 17 7.11438 17 9V9" stroke="#323232" stroke-width="2" stroke-linejoin="round"></path> <path d="M16 14C16 15.1046 15.1046 16 14 16C12.8954 16 12 15.1046 12 14C12 12.8954 12.8954 12 14 12C15.1046 12 16 12.8954 16 14Z" stroke="#323232" stroke-width="2"></path> </g></svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </span>
                                    <span class="menu-title">


                                        {{__('payments')}} </span>
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
                                        <svg fill="{{ ($link == 'settings' ) ? '#c2da08' : '#000000' }}" height="200px" width="200px" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 482.568 482.568" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M116.993,203.218c13.4-1.8,26.8,2.8,36.3,12.3l24,24l22.7-22.6l-32.8-32.7c-5.1-5.1-5.1-13.4,0-18.5s13.4-5.1,18.5,0 l32.8,32.8l22.7-22.6l-24.1-24.1c-9.5-9.5-14.1-23-12.3-36.3c4-30.4-5.7-62.2-29-85.6c-23.8-23.8-56.4-33.4-87.3-28.8 c-4.9,0.7-6.9,6.8-3.4,10.3l30.9,30.9c14.7,14.7,14.7,38.5,0,53.1l-19,19c-14.7,14.7-38.5,14.7-53.1,0l-31-30.9 c-3.5-3.5-9.5-1.5-10.3,3.4c-4.6,30.9,5,63.5,28.8,87.3C54.793,197.518,86.593,207.218,116.993,203.218z"></path> <path d="M309.193,243.918l-22.7,22.6l134.8,134.8c5.1,5.1,5.1,13.4,0,18.5s-13.4,5.1-18.5,0l-134.8-134.8l-22.7,22.6l138.9,138.9 c17.6,17.6,46.1,17.5,63.7-0.1s17.6-46.1,0.1-63.7L309.193,243.918z"></path> <path d="M361.293,153.918h59.9l59.9-119.7l-29.9-29.9l-119.8,59.8v59.9l-162.8,162.3l-29.3-29.2l-118,118 c-24.6,24.6-24.6,64.4,0,89s64.4,24.6,89,0l118-118l-29.9-29.9L361.293,153.918z"></path> </g> </g> </g></svg>                                        </span>
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
        <div class="m-4 wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
        @include('restaurant.components.payment-tap-documents-alert')
        @include('restaurant.components.subscription-alert')
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
                                                        <img class="w-15px h-15px rounded-1 ms-2"
                                                             @if(app()->getLocale() != 'ar')
                                                             src="{{ global_asset('assets/media/flags/united-kingdom.svg') }}"
                                                             @else
                                                             src="{{ global_asset('assets/media/flags/saudi-arabia.svg') }}"
                                                             @endif
                                                             alt="" /></span></span>
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
                                                                <img class="rounded-1"
                                                                     src={{ global_asset('assets/media/flags/united-kingdom.svg') }} alt="" />
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
                                                            <img class="rounded-1" src="{{ global_asset('assets/media/flags/saudi-arabia.svg') }}"
                                                                 alt="" /> </span>{{ __('arabic')}}</button>
                                                </form>
                                            </div>
                                            <!--end::Menu item-->
                                        </div>
                                        <!--end::Menu sub-->
                                    </div>
                                    <!--end::Menu item-->
                                    <!--begin::Menu item-->
                                    <div class="menu-item px-5">
                                        <a href="{{ route('tenant_logout_get') }}"
                                           class="menu-link px-5" onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit();">{{ __('sign-out')}}</a>
                                        <form id="logout-form" action="{{ route('tenant_logout_get') }}" method="POST" class="d-none">
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
        @yield('content')
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

<script
    src="https://js.sentry-cdn.com/860125ea20f9254e5c411ffbdeb02c39.min.js"
    crossorigin="anonymous"
></script>
<!--end::Page Custom Javascript-->
<!--end::Javascript-->
</body>
<!--end::Body-->

</html>
@endif
