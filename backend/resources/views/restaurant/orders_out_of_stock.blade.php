@extends('layouts.restaurant-sidebar')

@section('title', __('messages.products-out-of-stock'))

@section('content')

    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">

            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid" id="kt_wrapper">
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
                            <a href="../../../demo1/dist/index.html" class="d-lg-none">
                                <img alt="Logo" src="../../assets/media/logos/logo-2.svg" class="h-30px" />
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
                                        <img src="../../assets/media/avatars/300-1.jpg" alt="user" />
                                    </div>
                                    <!--begin::User account menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-primary fw-bold py-4 fs-6 w-275px"
                                         data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content d-flex align-items-center px-3">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-50px me-5">
                                                    <img alt="Logo" src="../../assets/media/avatars/300-1.jpg" />
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Username-->
                                                <div class="d-flex flex-column">
                                                    <div class="fw-bolder d-flex align-items-center fs-5">
                                                        <a href="../../profile.html">Max Smith</a>
                                                        <span
                                                            class="badge badge-light-khardl fw-bolder fs-8 px-2 py-1 ms-2">Pro</span>
                                                    </div>
                                                    <a href="#"
                                                       class="fw-bold text-muted text-hover-primary fs-7">max@kt.com</a>
                                                </div>
                                                <!--end::Username-->
                                            </div>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu separator-->
                                        <div class="separator my-2"></div>
                                        <!--end::Menu separator-->

                                        <!--begin::Menu separator-->
                                        <div class="separator my-2"></div>
                                        <!--end::Menu separator-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-5" data-kt-menu-trigger="hover"
                                             data-kt-menu-placement="left-start">
                                            <a href="#" class="menu-link px-5">
                                            <span class="menu-title position-relative">Language
                                                <span
                                                    class="fs-8 rounded bg-light px-3 py-2 position-absolute translate-middle-y top-50 end-0">English
                                                    <img class="w-15px h-15px rounded-1 ms-2"
                                                         src="../../assets/media/flags/united-states.svg"
                                                         alt="" /></span></span>
                                            </a>
                                            <!--begin::Menu sub-->
                                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="../../../demo1/dist/account/settings.html"
                                                       class="menu-link d-flex px-5 active">
                                                    <span class="symbol symbol-20px me-4">
                                                        <img class="rounded-1"
                                                             src="../../assets/media/flags/united-states.svg" alt="" />
                                                    </span>English</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="../../../demo1/dist/account/settings.html"
                                                       class="menu-link d-flex px-5">
                                                    <span class="symbol symbol-20px me-4">
                                                        <img class="rounded-1" src="../../assets/media/flags/saudi-arabia.svg"
                                                             alt="" /> </span>Arabic</a>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu sub-->
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-5">
                                            <a href="../../../demo1/dist/authentication/flows/basic/sign-in.html"
                                               class="menu-link px-5">Sign Out</a>
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
                <div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">


                    <!--begin::Post-->
                    <div class="post d-flex flex-column-fluid mb-15" id="kt_post">
                        <!--begin::Container-->
                        <div id="kt_content_container" class="container-xxl">
                            <!--begin::Products-->
                            <div class="card card-flush">
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Row-->
                                    <div class="row gy-5 g-xl-10">
                                        <!--begin::Col-->
                                        <div class="col-xl-12">
                                            <!--begin::List widget 5-->
                                            <div class="card card-flush h-xl-100">
                                                <!--begin::Header-->
                                                <div class="card-header">
                                                    <!--begin::Title-->
                                                    <h3 class="card-title align-items-start flex-column">
                                                        <span class="card-label fw-bolder text-dark">Product out of stock</span>
                                                    </h3>
                                                    <!--end::Title-->
                                                    <!--begin::Toolbar-->
                                                    <div class="card-toolbar">
                                                        <!--begin::Card header-->
                                                        <div class="align-items-center py-5 gap-2 gap-md-5">
                                                            <!--begin::Card title-->
                                                            <div class="card-title">
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
                                                                    <input type="text" data-kt-ecommerce-order-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="{{__('messages.search')}}" />
                                                                </div>
                                                                <!--end::Search-->
                                                            </div>
                                                            <!--end::Card title-->

                                                        </div>
                                                        <!--end::Card header-->
                                                        <a href="#" class="btn btn-sm btn-khardl">{{__('messages.search')}}</a>
                                                    </div>
                                                    <!--end::Toolbar-->
                                                </div>
                                                <!--end::Header-->
                                                <!--begin::Body-->
                                                <div class="card-body">
                                                    <!--begin::Scroll-->
                                                    <div class="hover-scroll-overlay-y pe-6 me-n6" style="height: 600px">

                                                        <!--begin::Item-->
                                                        <div class="rounded border-gray-300 border-1 border-gray-300 border-dashed px-7 py-3 mb-6">
                                                            <!--begin::Info-->
                                                            <div class="d-flex flex-stack mb-3">
                                                                <!--begin::Wrapper-->
                                                                <div class="me-3">
                                                                    <!--begin::Icon-->
                                                                    <img src="../../assets/media/stock/ecommerce/210.gif" class="w-50px ms-n1 me-1" alt="" />
                                                                    <!--end::Icon-->
                                                                    <!--begin::Title-->
                                                                    <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bolder">Elephant 1802</a>
                                                                    <!--end::Title-->
                                                                </div>
                                                                <!--end::Wrapper-->
                                                                <!--begin::Action-->
                                                                <div class="m-0">
                                                                    <!--begin::Menu-->
                                                                    <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
                                                                        <span class="svg-icon svg-icon-1">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <circle cx="12" cy="12" r="10" fill="currentColor" />
                                                                            <path d="M9 16.2V7.79998L16 12L9 16.2Z" fill="white" />
                                                                          </svg>
                                                                            </svg>
																	</span>
                                                                        <!--end::Svg Icon-->
                                                                    </button>

                                                                    <!--end::Menu-->
                                                                </div>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Info-->
                                                            <!--begin::Customer-->
                                                            <div class="d-flex flex-stack">
                                                                <!--begin::Name-->
                                                                <span class="text-gray-400 fw-bolder">Price :
															<a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bolder">150$</a></span>
                                                                <!--end::Name-->
                                                                <!--begin::Label-->
                                                                <span class="badge badge-light-warning">Out of stock</span>
                                                                <!--end::Label-->
                                                            </div>
                                                            <!--end::Customer-->
                                                        </div>
                                                        <!--end::Item-->

                                                        <!--begin::Item-->
                                                        <div class="rounded border-gray-300 border-1 border-gray-300 border-dashed px-7 py-3 mb-6">
                                                            <!--begin::Info-->
                                                            <div class="d-flex flex-stack mb-3">
                                                                <!--begin::Wrapper-->
                                                                <div class="me-3">
                                                                    <!--begin::Icon-->
                                                                    <img src="../../assets/media/stock/ecommerce/210.gif" class="w-50px ms-n1 me-1" alt="" />
                                                                    <!--end::Icon-->
                                                                    <!--begin::Title-->
                                                                    <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bolder">Elephant 1802</a>
                                                                    <!--end::Title-->
                                                                </div>
                                                                <!--end::Wrapper-->
                                                                <!--begin::Action-->
                                                                <div class="m-0">
                                                                    <!--begin::Menu-->
                                                                    <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
                                                                        <span class="svg-icon svg-icon-1">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <circle cx="12" cy="12" r="10" fill="currentColor" />
                                                                            <path d="M9 16.2V7.79998L16 12L9 16.2Z" fill="white" />
                                                                          </svg>
                                                                            </svg>
																	</span>
                                                                        <!--end::Svg Icon-->
                                                                    </button>

                                                                    <!--end::Menu-->
                                                                </div>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Info-->
                                                            <!--begin::Customer-->
                                                            <div class="d-flex flex-stack">
                                                                <!--begin::Name-->
                                                                <span class="text-gray-400 fw-bolder">Price :
															<a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bolder">150$</a></span>
                                                                <!--end::Name-->
                                                                <!--begin::Label-->
                                                                <span class="badge badge-light-warning">Out of stock</span>
                                                                <!--end::Label-->
                                                            </div>
                                                            <!--end::Customer-->
                                                        </div>
                                                        <!--end::Item-->

                                                        <!--begin::Item-->
                                                        <div class="rounded border-gray-300 border-1 border-gray-300 border-dashed px-7 py-3 mb-6">
                                                            <!--begin::Info-->
                                                            <div class="d-flex flex-stack mb-3">
                                                                <!--begin::Wrapper-->
                                                                <div class="me-3">
                                                                    <!--begin::Icon-->
                                                                    <img src="../../assets/media/stock/ecommerce/210.gif" class="w-50px ms-n1 me-1" alt="" />
                                                                    <!--end::Icon-->
                                                                    <!--begin::Title-->
                                                                    <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bolder">Elephant 1802</a>
                                                                    <!--end::Title-->
                                                                </div>
                                                                <!--end::Wrapper-->
                                                                <!--begin::Action-->
                                                                <div class="m-0">
                                                                    <!--begin::Menu-->
                                                                    <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
                                                                        <span class="svg-icon svg-icon-1">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <circle cx="12" cy="12" r="10" fill="currentColor" />
                                                                            <path d="M9 16.2V7.79998L16 12L9 16.2Z" fill="white" />
                                                                          </svg>
                                                                            </svg>
																	</span>
                                                                        <!--end::Svg Icon-->
                                                                    </button>

                                                                    <!--end::Menu-->
                                                                </div>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Info-->
                                                            <!--begin::Customer-->
                                                            <div class="d-flex flex-stack">
                                                                <!--begin::Name-->
                                                                <span class="text-gray-400 fw-bolder">Price :
															<a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bolder">150$</a></span>
                                                                <!--end::Name-->
                                                                <!--begin::Label-->
                                                                <span class="badge badge-light-warning">Out of stock</span>
                                                                <!--end::Label-->
                                                            </div>
                                                            <!--end::Customer-->
                                                        </div>
                                                        <!--end::Item-->

                                                        <!--begin::Item-->
                                                        <div class="rounded border-gray-300 border-1 border-gray-300 border-dashed px-7 py-3 mb-6">
                                                            <!--begin::Info-->
                                                            <div class="d-flex flex-stack mb-3">
                                                                <!--begin::Wrapper-->
                                                                <div class="me-3">
                                                                    <!--begin::Icon-->
                                                                    <img src="../../assets/media/stock/ecommerce/210.gif" class="w-50px ms-n1 me-1" alt="" />
                                                                    <!--end::Icon-->
                                                                    <!--begin::Title-->
                                                                    <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bolder">Elephant 1802</a>
                                                                    <!--end::Title-->
                                                                </div>
                                                                <!--end::Wrapper-->
                                                                <!--begin::Action-->
                                                                <div class="m-0">
                                                                    <!--begin::Menu-->
                                                                    <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
                                                                        <span class="svg-icon svg-icon-1">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <rect x="6" y="6" width="12" height="12" rx="2" fill="currentColor" />
                                                                          </svg>

                                                                            </svg>
																	</span>
                                                                        <!--end::Svg Icon-->
                                                                    </button>

                                                                    <!--end::Menu-->
                                                                </div>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Info-->
                                                            <!--begin::Customer-->
                                                            <div class="d-flex flex-stack">
                                                                <!--begin::Name-->
                                                                <span class="text-gray-400 fw-bolder">Price :
															<a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bolder">150$</a></span>
                                                                <!--end::Name-->
                                                                <!--begin::Label-->
                                                                <span class="badge badge-light-success">in stock</span>
                                                                <!--end::Label-->
                                                            </div>
                                                            <!--end::Customer-->
                                                        </div>
                                                        <!--end::Item-->

                                                        <!--begin::Item-->
                                                        <div class="rounded border-gray-300 border-1 border-gray-300 border-dashed px-7 py-3 mb-6">
                                                            <!--begin::Info-->
                                                            <div class="d-flex flex-stack mb-3">
                                                                <!--begin::Wrapper-->
                                                                <div class="me-3">
                                                                    <!--begin::Icon-->
                                                                    <img src="../../assets/media/stock/ecommerce/210.gif" class="w-50px ms-n1 me-1" alt="" />
                                                                    <!--end::Icon-->
                                                                    <!--begin::Title-->
                                                                    <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bolder">Elephant 1802</a>
                                                                    <!--end::Title-->
                                                                </div>
                                                                <!--end::Wrapper-->
                                                                <!--begin::Action-->
                                                                <div class="m-0">
                                                                    <!--begin::Menu-->
                                                                    <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
                                                                        <span class="svg-icon svg-icon-1">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <rect x="6" y="6" width="12" height="12" rx="2" fill="currentColor" />
                                                                          </svg>

                                                                            </svg>
																	</span>
                                                                        <!--end::Svg Icon-->
                                                                    </button>

                                                                    <!--end::Menu-->
                                                                </div>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Info-->
                                                            <!--begin::Customer-->
                                                            <div class="d-flex flex-stack">
                                                                <!--begin::Name-->
                                                                <span class="text-gray-400 fw-bolder">Price :
															<a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bolder">150$</a></span>
                                                                <!--end::Name-->
                                                                <!--begin::Label-->
                                                                <span class="badge badge-light-success">in stock</span>
                                                                <!--end::Label-->
                                                            </div>
                                                            <!--end::Customer-->
                                                        </div>
                                                        <!--end::Item-->

                                                        <!--begin::Item-->
                                                        <div class="rounded border-gray-300 border-1 border-gray-300 border-dashed px-7 py-3 mb-6">
                                                            <!--begin::Info-->
                                                            <div class="d-flex flex-stack mb-3">
                                                                <!--begin::Wrapper-->
                                                                <div class="me-3">
                                                                    <!--begin::Icon-->
                                                                    <img src="../../assets/media/stock/ecommerce/210.gif" class="w-50px ms-n1 me-1" alt="" />
                                                                    <!--end::Icon-->
                                                                    <!--begin::Title-->
                                                                    <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bolder">Elephant 1802</a>
                                                                    <!--end::Title-->
                                                                </div>
                                                                <!--end::Wrapper-->
                                                                <!--begin::Action-->
                                                                <div class="m-0">
                                                                    <!--begin::Menu-->
                                                                    <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
                                                                        <span class="svg-icon svg-icon-1">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <rect x="6" y="6" width="12" height="12" rx="2" fill="currentColor" />
                                                                          </svg>

                                                                            </svg>
																	</span>
                                                                        <!--end::Svg Icon-->
                                                                    </button>

                                                                    <!--end::Menu-->
                                                                </div>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Info-->
                                                            <!--begin::Customer-->
                                                            <div class="d-flex flex-stack">
                                                                <!--begin::Name-->
                                                                <span class="text-gray-400 fw-bolder">Price :
															<a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bolder">150$</a></span>
                                                                <!--end::Name-->
                                                                <!--begin::Label-->
                                                                <span class="badge badge-light-success">in stock</span>
                                                                <!--end::Label-->
                                                            </div>
                                                            <!--end::Customer-->
                                                        </div>
                                                        <!--end::Item-->


                                                        <!--begin::Item-->
                                                        <div class="rounded border-gray-300 border-1 border-gray-300 border-dashed px-7 py-3 mb-6">
                                                            <!--begin::Info-->
                                                            <div class="d-flex flex-stack mb-3">
                                                                <!--begin::Wrapper-->
                                                                <div class="me-3">
                                                                    <!--begin::Icon-->
                                                                    <img src="../../assets/media/stock/ecommerce/210.gif" class="w-50px ms-n1 me-1" alt="" />
                                                                    <!--end::Icon-->
                                                                    <!--begin::Title-->
                                                                    <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bolder">Elephant 1802</a>
                                                                    <!--end::Title-->
                                                                </div>
                                                                <!--end::Wrapper-->
                                                                <!--begin::Action-->
                                                                <div class="m-0">
                                                                    <!--begin::Menu-->
                                                                    <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
                                                                        <span class="svg-icon svg-icon-1">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <rect x="6" y="6" width="12" height="12" rx="2" fill="currentColor" />
                                                                          </svg>

                                                                            </svg>
																	</span>
                                                                        <!--end::Svg Icon-->
                                                                    </button>

                                                                    <!--end::Menu-->
                                                                </div>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Info-->
                                                            <!--begin::Customer-->
                                                            <div class="d-flex flex-stack">
                                                                <!--begin::Name-->
                                                                <span class="text-gray-400 fw-bolder">Price :
															<a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bolder">150$</a></span>
                                                                <!--end::Name-->
                                                                <!--begin::Label-->
                                                                <span class="badge badge-light-success">in stock</span>
                                                                <!--end::Label-->
                                                            </div>
                                                            <!--end::Customer-->
                                                        </div>
                                                        <!--end::Item-->


                                                        <!--begin::Item-->
                                                        <div class="rounded border-gray-300 border-1 border-gray-300 border-dashed px-7 py-3 mb-6">
                                                            <!--begin::Info-->
                                                            <div class="d-flex flex-stack mb-3">
                                                                <!--begin::Wrapper-->
                                                                <div class="me-3">
                                                                    <!--begin::Icon-->
                                                                    <img src="../../assets/media/stock/ecommerce/210.gif" class="w-50px ms-n1 me-1" alt="" />
                                                                    <!--end::Icon-->
                                                                    <!--begin::Title-->
                                                                    <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bolder">Elephant 1802</a>
                                                                    <!--end::Title-->
                                                                </div>
                                                                <!--end::Wrapper-->
                                                                <!--begin::Action-->
                                                                <div class="m-0">
                                                                    <!--begin::Menu-->
                                                                    <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
                                                                        <span class="svg-icon svg-icon-1">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <rect x="6" y="6" width="12" height="12" rx="2" fill="currentColor" />
                                                                          </svg>

                                                                            </svg>
																	</span>
                                                                        <!--end::Svg Icon-->
                                                                    </button>

                                                                    <!--end::Menu-->
                                                                </div>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Info-->
                                                            <!--begin::Customer-->
                                                            <div class="d-flex flex-stack">
                                                                <!--begin::Name-->
                                                                <span class="text-gray-400 fw-bolder">Price :
															<a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bolder">150$</a></span>
                                                                <!--end::Name-->
                                                                <!--begin::Label-->
                                                                <span class="badge badge-light-success">in stock</span>
                                                                <!--end::Label-->
                                                            </div>
                                                            <!--end::Customer-->
                                                        </div>
                                                        <!--end::Item-->


                                                        <!--begin::Item-->
                                                        <div class="rounded border-gray-300 border-1 border-gray-300 border-dashed px-7 py-3 mb-6">
                                                            <!--begin::Info-->
                                                            <div class="d-flex flex-stack mb-3">
                                                                <!--begin::Wrapper-->
                                                                <div class="me-3">
                                                                    <!--begin::Icon-->
                                                                    <img src="../../assets/media/stock/ecommerce/210.gif" class="w-50px ms-n1 me-1" alt="" />
                                                                    <!--end::Icon-->
                                                                    <!--begin::Title-->
                                                                    <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bolder">Elephant 1802</a>
                                                                    <!--end::Title-->
                                                                </div>
                                                                <!--end::Wrapper-->
                                                                <!--begin::Action-->
                                                                <div class="m-0">
                                                                    <!--begin::Menu-->
                                                                    <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
                                                                        <span class="svg-icon svg-icon-1">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <rect x="6" y="6" width="12" height="12" rx="2" fill="currentColor" />
                                                                          </svg>

                                                                            </svg>
																	</span>
                                                                        <!--end::Svg Icon-->
                                                                    </button>

                                                                    <!--end::Menu-->
                                                                </div>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Info-->
                                                            <!--begin::Customer-->
                                                            <div class="d-flex flex-stack">
                                                                <!--begin::Name-->
                                                                <span class="text-gray-400 fw-bolder">Price :
															<a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bolder">150$</a></span>
                                                                <!--end::Name-->
                                                                <!--begin::Label-->
                                                                <span class="badge badge-light-success">in stock</span>
                                                                <!--end::Label-->
                                                            </div>
                                                            <!--end::Customer-->
                                                        </div>
                                                        <!--end::Item-->

                                                        <!--begin::Item-->
                                                        <div class="rounded border-gray-300 border-1 border-gray-300 border-dashed px-7 py-3 mb-6">
                                                            <!--begin::Info-->
                                                            <div class="d-flex flex-stack mb-3">
                                                                <!--begin::Wrapper-->
                                                                <div class="me-3">
                                                                    <!--begin::Icon-->
                                                                    <img src="../../assets/media/stock/ecommerce/210.gif" class="w-50px ms-n1 me-1" alt="" />
                                                                    <!--end::Icon-->
                                                                    <!--begin::Title-->
                                                                    <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bolder">Elephant 1802</a>
                                                                    <!--end::Title-->
                                                                </div>
                                                                <!--end::Wrapper-->
                                                                <!--begin::Action-->
                                                                <div class="m-0">
                                                                    <!--begin::Menu-->
                                                                    <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
                                                                        <span class="svg-icon svg-icon-1">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <rect x="6" y="6" width="12" height="12" rx="2" fill="currentColor" />
                                                                          </svg>

                                                                            </svg>
																	</span>
                                                                        <!--end::Svg Icon-->
                                                                    </button>

                                                                    <!--end::Menu-->
                                                                </div>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Info-->
                                                            <!--begin::Customer-->
                                                            <div class="d-flex flex-stack">
                                                                <!--begin::Name-->
                                                                <span class="text-gray-400 fw-bolder">Price :
															<a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bolder">150$</a></span>
                                                                <!--end::Name-->
                                                                <!--begin::Label-->
                                                                <span class="badge badge-light-success">in stock</span>
                                                                <!--end::Label-->
                                                            </div>
                                                            <!--end::Customer-->
                                                        </div>
                                                        <!--end::Item-->

                                                        <!--begin::Item-->
                                                        <div class="rounded border-gray-300 border-1 border-gray-300 border-dashed px-7 py-3 mb-6">
                                                            <!--begin::Info-->
                                                            <div class="d-flex flex-stack mb-3">
                                                                <!--begin::Wrapper-->
                                                                <div class="me-3">
                                                                    <!--begin::Icon-->
                                                                    <img src="../../assets/media/stock/ecommerce/210.gif" class="w-50px ms-n1 me-1" alt="" />
                                                                    <!--end::Icon-->
                                                                    <!--begin::Title-->
                                                                    <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bolder">Elephant 1802</a>
                                                                    <!--end::Title-->
                                                                </div>
                                                                <!--end::Wrapper-->
                                                                <!--begin::Action-->
                                                                <div class="m-0">
                                                                    <!--begin::Menu-->
                                                                    <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
                                                                        <span class="svg-icon svg-icon-1">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <rect x="6" y="6" width="12" height="12" rx="2" fill="currentColor" />
                                                                          </svg>

                                                                            </svg>
																	</span>
                                                                        <!--end::Svg Icon-->
                                                                    </button>

                                                                    <!--end::Menu-->
                                                                </div>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Info-->
                                                            <!--begin::Customer-->
                                                            <div class="d-flex flex-stack">
                                                                <!--begin::Name-->
                                                                <span class="text-gray-400 fw-bolder">Price :
															<a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bolder">150$</a></span>
                                                                <!--end::Name-->
                                                                <!--begin::Label-->
                                                                <span class="badge badge-light-success">in stock</span>
                                                                <!--end::Label-->
                                                            </div>
                                                            <!--end::Customer-->
                                                        </div>
                                                        <!--end::Item-->

                                                        <!--begin::Item-->
                                                        <div class="rounded border-gray-300 border-1 border-gray-300 border-dashed px-7 py-3 mb-6">
                                                            <!--begin::Info-->
                                                            <div class="d-flex flex-stack mb-3">
                                                                <!--begin::Wrapper-->
                                                                <div class="me-3">
                                                                    <!--begin::Icon-->
                                                                    <img src="../../assets/media/stock/ecommerce/210.gif" class="w-50px ms-n1 me-1" alt="" />
                                                                    <!--end::Icon-->
                                                                    <!--begin::Title-->
                                                                    <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bolder">Elephant 1802</a>
                                                                    <!--end::Title-->
                                                                </div>
                                                                <!--end::Wrapper-->
                                                                <!--begin::Action-->
                                                                <div class="m-0">
                                                                    <!--begin::Menu-->
                                                                    <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
                                                                        <span class="svg-icon svg-icon-1">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <rect x="6" y="6" width="12" height="12" rx="2" fill="currentColor" />
                                                                          </svg>

                                                                            </svg>
																	</span>
                                                                        <!--end::Svg Icon-->
                                                                    </button>

                                                                    <!--end::Menu-->
                                                                </div>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Info-->
                                                            <!--begin::Customer-->
                                                            <div class="d-flex flex-stack">
                                                                <!--begin::Name-->
                                                                <span class="text-gray-400 fw-bolder">Price :
															<a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bolder">150$</a></span>
                                                                <!--end::Name-->
                                                                <!--begin::Label-->
                                                                <span class="badge badge-light-success">in stock</span>
                                                                <!--end::Label-->
                                                            </div>
                                                            <!--end::Customer-->
                                                        </div>
                                                        <!--end::Item-->

                                                        <!--begin::Item-->
                                                        <div class="rounded border-gray-300 border-1 border-gray-300 border-dashed px-7 py-3 mb-6">
                                                            <!--begin::Info-->
                                                            <div class="d-flex flex-stack mb-3">
                                                                <!--begin::Wrapper-->
                                                                <div class="me-3">
                                                                    <!--begin::Icon-->
                                                                    <img src="../../assets/media/stock/ecommerce/210.gif" class="w-50px ms-n1 me-1" alt="" />
                                                                    <!--end::Icon-->
                                                                    <!--begin::Title-->
                                                                    <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bolder">Elephant 1802</a>
                                                                    <!--end::Title-->
                                                                </div>
                                                                <!--end::Wrapper-->
                                                                <!--begin::Action-->
                                                                <div class="m-0">
                                                                    <!--begin::Menu-->
                                                                    <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
                                                                        <span class="svg-icon svg-icon-1">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <rect x="6" y="6" width="12" height="12" rx="2" fill="currentColor" />
                                                                          </svg>

                                                                            </svg>
																	</span>
                                                                        <!--end::Svg Icon-->
                                                                    </button>

                                                                    <!--end::Menu-->
                                                                </div>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Info-->
                                                            <!--begin::Customer-->
                                                            <div class="d-flex flex-stack">
                                                                <!--begin::Name-->
                                                                <span class="text-gray-400 fw-bolder">Price :
															<a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bolder">150$</a></span>
                                                                <!--end::Name-->
                                                                <!--begin::Label-->
                                                                <span class="badge badge-light-success">in stock</span>
                                                                <!--end::Label-->
                                                            </div>
                                                            <!--end::Customer-->
                                                        </div>
                                                        <!--end::Item-->

                                                        <!--begin::Item-->
                                                        <div class="rounded border-gray-300 border-1 border-gray-300 border-dashed px-7 py-3 mb-6">
                                                            <!--begin::Info-->
                                                            <div class="d-flex flex-stack mb-3">
                                                                <!--begin::Wrapper-->
                                                                <div class="me-3">
                                                                    <!--begin::Icon-->
                                                                    <img src="../../assets/media/stock/ecommerce/210.gif" class="w-50px ms-n1 me-1" alt="" />
                                                                    <!--end::Icon-->
                                                                    <!--begin::Title-->
                                                                    <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bolder">Elephant 1802</a>
                                                                    <!--end::Title-->
                                                                </div>
                                                                <!--end::Wrapper-->
                                                                <!--begin::Action-->
                                                                <div class="m-0">
                                                                    <!--begin::Menu-->
                                                                    <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
                                                                        <span class="svg-icon svg-icon-1">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <rect x="6" y="6" width="12" height="12" rx="2" fill="currentColor" />
                                                                          </svg>

                                                                            </svg>
																	</span>
                                                                        <!--end::Svg Icon-->
                                                                    </button>

                                                                    <!--end::Menu-->
                                                                </div>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Info-->
                                                            <!--begin::Customer-->
                                                            <div class="d-flex flex-stack">
                                                                <!--begin::Name-->
                                                                <span class="text-gray-400 fw-bolder">Price :
															<a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bolder">150$</a></span>
                                                                <!--end::Name-->
                                                                <!--begin::Label-->
                                                                <span class="badge badge-light-success">in stock</span>
                                                                <!--end::Label-->
                                                            </div>
                                                            <!--end::Customer-->
                                                        </div>
                                                        <!--end::Item-->

                                                        <!--begin::Item-->
                                                        <div class="rounded border-gray-300 border-1 border-gray-300 border-dashed px-7 py-3 mb-6">
                                                            <!--begin::Info-->
                                                            <div class="d-flex flex-stack mb-3">
                                                                <!--begin::Wrapper-->
                                                                <div class="me-3">
                                                                    <!--begin::Icon-->
                                                                    <img src="../../assets/media/stock/ecommerce/210.gif" class="w-50px ms-n1 me-1" alt="" />
                                                                    <!--end::Icon-->
                                                                    <!--begin::Title-->
                                                                    <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-primary fw-bolder">Elephant 1802</a>
                                                                    <!--end::Title-->
                                                                </div>
                                                                <!--end::Wrapper-->
                                                                <!--begin::Action-->
                                                                <div class="m-0">
                                                                    <!--begin::Menu-->
                                                                    <button class="btn btn-icon btn-color-gray-400 btn-active-color-primary justify-content-end" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end" data-kt-menu-overflow="true">
                                                                        <!--begin::Svg Icon | path: icons/duotune/general/gen023.svg-->
                                                                        <span class="svg-icon svg-icon-1">
																		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                            <rect x="6" y="6" width="12" height="12" rx="2" fill="currentColor" />
                                                                          </svg>

                                                                            </svg>
																	</span>
                                                                        <!--end::Svg Icon-->
                                                                    </button>

                                                                    <!--end::Menu-->
                                                                </div>
                                                                <!--end::Action-->
                                                            </div>
                                                            <!--end::Info-->
                                                            <!--begin::Customer-->
                                                            <div class="d-flex flex-stack">
                                                                <!--begin::Name-->
                                                                <span class="text-gray-400 fw-bolder">Price :
															<a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-primary fw-bolder">150$</a></span>
                                                                <!--end::Name-->
                                                                <!--begin::Label-->
                                                                <span class="badge badge-light-success">in stock</span>
                                                                <!--end::Label-->
                                                            </div>
                                                            <!--end::Customer-->
                                                        </div>
                                                        <!--end::Item-->

                                                    </div>
                                                    <!--end::Scroll-->
                                                </div>
                                                <!--end::Body-->
                                            </div>
                                            <!--end::List widget 5-->
                                        </div>
                                        <!--end::Col-->
                                    </div>
                                    <!--end::Row-->
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Products-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Post-->

                </div>
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Root-->
    <!--end::Main-->



@endsection
