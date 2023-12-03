@extends('layouts.restaurant-sidebar')

@section('title', 'Promotions')

@section('content')


    <!--begin::Body-->

    <body id="kt_body"
          class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="
      --kt-toolbar-height: 55px;
      --kt-toolbar-height-tablet-and-mobile: 55px;
    ">
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
                                <img alt="Logo" src="{{ global_asset('img/logo.png') }}" class="h-30px" />
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
                                        <img src="../assets/media/avatars/300-1.jpg" alt="user" />
                                    </div>
                                    <!--begin::User account menu-->
                                    <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-khardl fw-bold py-4 fs-6 w-275px"
                                         data-kt-menu="true">
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-3">
                                            <div class="menu-content d-flex align-items-center px-3">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-50px me-5">
                                                    <img alt="Logo" src="../assets/media/avatars/300-1.jpg" />
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Username-->
                                                <div class="d-flex flex-column">
                                                    <div class="fw-bolder d-flex align-items-center fs-5">
                                                        Max Smith
                                                        <span
                                                            class="badge badge-light-success fw-bolder fs-8 px-2 py-1 ms-2">Pro</span>
                                                    </div>
                                                    <a href="#"
                                                       class="fw-bold text-muted text-hover-khardl fs-7">max@kt.com</a>
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
                                                         src="../assets/media/flags/united-states.svg"
                                                         alt="" /></span></span>
                                            </a>
                                            <!--begin::Menu sub-->
                                            <div class="menu-sub menu-sub-dropdown w-175px py-4">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="../../demo1/dist/account/settings.html"
                                                       class="menu-link d-flex px-5 active">
                                                    <span class="symbol symbol-20px me-4">
                                                        <img class="rounded-1"
                                                             src="../assets/media/flags/united-states.svg" alt="" />
                                                    </span>English</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="../../demo1/dist/account/settings.html"
                                                       class="menu-link d-flex px-5">
                                                    <span class="symbol symbol-20px me-4">
                                                        <img class="rounded-1" src="../assets/media/flags/saudi-arabia.svg"
                                                             alt="" /> </span>Arabic</a>
                                                </div>
                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu sub-->
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-5 my-1">
                                            <a href="../log.html" class="menu-link px-5">Logs</a>
                                        </div>
                                        <!--end::Menu item-->
                                        <!--begin::Menu item-->
                                        <div class="menu-item px-5">
                                            <a href="../../demo1/dist/authentication/flows/basic/sign-in.html"
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
                                    <div class="btn btn-icon btn-active-light-khardl w-30px h-30px w-md-40px h-md-40px"
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
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <!--begin::Container-->
                        <div id="kt_content_container" class="container-xxl">
                            <!--begin::Row-->
                            <div class="row g-12 g-xl-12 mb-xl-112">
                                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 mb-md-4 mb-xl-0">
                                    <!--begin::Card widget 4-->
                                    <div class="card card-flush h-md-100 mb-5 mb-xl-0">
                                        <!--begin::Form-->
                                        <form id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row"
                                              data-kt-redirect="../../demo1/dist/apps/ecommerce/catalog/restaurants.html">

                                            <!--begin::Main column-->
                                            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                                                <!--begin::Tab content-->
                                                <div class="tab-content">
                                                    <!--begin::Tab pane-->
                                                    <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                                                        <div class="d-flex flex-column gap-7 gap-lg-10">
                                                            <!--begin::General options-->
                                                            <div class="card card-flush py-4">
                                                                <!--begin::Card header-->
                                                                <div class="card-header">
                                                                    <div class="card-title">
                                                                        <h2>Make a new coupon</h2>
                                                                    </div>
                                                                </div>
                                                                <!--end::Card header-->
                                                                <!--begin::Card body-->
                                                                <div class="card-body pt-0">
                                                                    <!--begin::Input group-->
                                                                    <div class="mb-10 fv-row">
                                                                        <!--begin::Label-->
                                                                        <label class="required form-label">Coupon code</label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <input type="text" name="coupon" class="form-control mb-2" placeholder="Coupon code"/>
                                                                        <!--end::Input-->
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row">
                                                                        <div class="row">
                                                                            <!--begin::Col 1-->
                                                                            <div class="col-lg-6">
                                                                                <!--begin::Option 1-->
                                                                                <input type="radio" class="btn-check" name="account_type" value="percentage" checked id="kt_create_account_form_account_type_percentage" />
                                                                                <label class="btn btn-outline btn-outline-dashed btn-outline-default p-3 d-flex align-items-center mb-10" for="kt_create_account_form_account_type_percentage">
                                                                                    <!--begin::Info-->
                                                                                    <div class="d-flex justify-content-between align-items-center">
                                                                                        <div>
                                                                                            <span>%</span>
                                                                                        </div>
                                                                                        <div class="sprout-container">
                                                                                            <input type="number" name="percentageInput" id="percentageInput" class="form-control ml-2" step="1" placeholder="0" />
                                                                                        </div>
                                                                                    </div>
                                                                                    <!--end::Info-->
                                                                                </label>
                                                                                <!--end::Option 1-->
                                                                            </div>
                                                                            <!--end::Col 1-->

                                                                            <!--begin::Col 2-->
                                                                            <div class="col-lg-6">
                                                                                <!--begin::Option 2-->
                                                                                <input type="radio" class="btn-check" name="account_type" value="SAR" id="kt_create_account_form_account_type_sar" />
                                                                                <label class="btn btn-outline btn-outline-dashed btn-outline-default p-3 d-flex align-items-center mb-10" for="kt_create_account_form_account_type_sar">
                                                                                    <!--begin::Info-->
                                                                                    <div class="d-flex justify-content-between align-items-center">
                                                                                        <div>
                                                                                            <span>SAR</span>
                                                                                        </div>
                                                                                        <div class="sprout-container">
                                                                                            <input type="number" name="sarInput" id="sarInput" class="form-control ml-2" step="1" placeholder="0" disabled />
                                                                                        </div>
                                                                                    </div>
                                                                                    <!--end::Info-->
                                                                                </label>
                                                                                <!--end::Option 2-->
                                                                            </div>
                                                                            <!--end::Col 2-->
                                                                        </div>

                                                                    </div>
                                                                    <!--end::Input group-->
                                                                    <!--begin::Input group-->
                                                                    <div class="mb-10 fv-row">
                                                                        <div class="d-flex justify-content-between align-items-center">
                                                                            <div>
                                                                                <label class="form-label">Uses</label>
                                                                            </div>
                                                                            <div class=" mt-1 fv-row">
                                                                                <input type="checkbox" name="enableUses" id="enableUses"/>
                                                                                <label class="form-label" for="enableUses">Disable uses</label>
                                                                            </div>
                                                                        </div>
                                                                        <input type="text" name="uses" class="form-control mb-2" placeholder="Uses" />
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                    <!--begin::Input group-->
                                                                    <div class="mb-10 fv-row">
                                                                        <!--begin::Label-->
                                                                        <label class="form-label">Time to expire</label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <div class="d-flex justify-content-between align-items-center">
                                                                            <input type="number" name="Days" class="form-control mb-2" placeholder="Days"/>
                                                                            <input type="number" name="Hours" class="form-control mb-2" placeholder="Hours"/>
                                                                            <input type="number" name="Minutes" class="form-control mb-2" placeholder="Minutes"/>
                                                                        </div>
                                                                        <!--end::Input-->
                                                                    </div>
                                                                    <!--end::Input group-->

                                                                    <!--begin::Actions-->
                                                                    <div class="d-flex justify-content-end">
                                                                        <button type="reset" class="btn btn-sm btn-light fw-bolder btn-active-light-secondary me-2" data-kt-search-element="advanced-options-form-cancel">Cancel</button>
                                                                        <button type="reset" class="badge badge-light-khardl p-4 text-hover-khardl bg-hover-khardl"  style="border:none" data-kt-search-element="advanced-options-form-cancel">Add</button>
                                                                    </div>
                                                                    <!--end::Actions-->

                                                                </div>
                                                                <!--end::Card header-->
                                                            </div>
                                                            <!--end::General options-->
                                                        </div>
                                                    </div>
                                                    <!--end::Tab pane-->
                                                </div>

                                            </div>
                                            <!--end::Main column-->
                                        </form>
                                        <!--end::Form-->
                                    </div>
                                    <!--end::Card widget 4-->
                                </div>
                                <!--begin::Col-->
                                <div class="col-lg-8 col-xl-8 col-xxl-8 mb-8 mb-xl-0">
                                    <!--begin::Chart widget 3-->
                                    <div class="card card-flush overflow-hidden h-md-100">
                                        <!--begin::List widget 5-->
                                        <div class="card card-flush h-xl-100">
                                            <!--begin::Header-->
                                            <div class="card-header pt-7">
                                                <!--begin::Title-->
                                                <h3 class="card-title align-items-start flex-column">
                                                    <span class="card-label fw-bolder text-dark">Your coupons</span>
                                                </h3>
                                                <!--end::Title-->
                                            </div>
                                            <!--end::Header-->
                                            <!--begin::Body-->
                                            <div class="card-body">
                                                <!--begin::Scroll-->
                                                <div class="hover-scroll-overlay-y" style="height: 450px">
                                                    <!--begin::Table-->
                                                    <table class="table align-middle table-row-dashed fs-6 gy-3" id="kt_table_widget_5_table">
                                                        <!--begin::Table head-->
                                                        <thead>
                                                        <!--begin::Table row-->
                                                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                                            <th class="text-start pe-3 min-w-100px">Coupon</th>
                                                            <th class="text-start pe-3 min-w-100px">Used</th>
                                                            <th class="text-start pe-3 min-w-100px">Discounts</th>
                                                            <th class="text-start pe-3 min-w-100px">Timer</th>
                                                            <th class="text-start pe-3 min-w-100px">Delete</th>
                                                        </tr>
                                                        <!--end::Table row-->
                                                        </thead>
                                                        <!--end::Table head-->
                                                        <!--begin::Table body-->
                                                        <tbody class="fw-bolder text-gray-600">
                                                        <tr>
                                                            <!--begin::Item-->
                                                            <td>
                                                                <a href="#" class="text-dark text-hover-khardl">self-234h-f325	</a>
                                                            </td>
                                                            <td class="text-start">
                                                                <span class="badge py-3 px-4 fs-7 badge-light-success">69/100</span>
                                                            </td>
                                                            <td class="text-start">
                                                                <span class="badge py-3 px-4 fs-7 badge-light-success">% 10</span>
                                                            </td>
                                                            <!--end::Item-->
                                                            <td class="text-start" id="timer">00 : 00 : 00</td>
                                                            <td class="text-start"><a href="" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></a></td>


                                                        </tr>

                                                        </tbody>
                                                        <!--end::Table body-->
                                                    </table>
                                                    <!--end::Table-->
                                                </div>
                                                <!--end::Scroll-->
                                            </div>
                                            <!--end::Body-->
                                        </div>
                                        <!--end::List widget 5-->
                                    </div>
                                    <!--end::Chart widget 3-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Modals-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Post-->
                </div>
                <!--end::Content-->


                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">
                    <!--begin::Post-->
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <!--begin::Container-->
                        <div id="kt_content_container" class="container-xxl">
                            <!--begin::Row-->
                            <div class="row g-12 g-xl-12 mb-xl-112">
                                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 mb-md-4 mb-xl-0">
                                    <!--begin::Card widget 4-->
                                    <div class="card card-flush h-md-100 mb-5 mb-xl-0">
                                        <!--begin::Form-->
                                        <form id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row"
                                              data-kt-redirect="../../demo1/dist/apps/ecommerce/catalog/restaurants.html">

                                            <!--begin::Main column-->
                                            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                                                <!--begin::Tab content-->
                                                <div class="tab-content">
                                                    <!--begin::Tab pane-->
                                                    <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                                                        <div class="d-flex flex-column gap-7 gap-lg-10">
                                                            <!--begin::General options-->
                                                            <div class="card card-flush py-4">
                                                                <!--begin::Card header-->
                                                                <div class="card-header">
                                                                    <div class="card-title">
                                                                        <h2>Make a new discount</h2>
                                                                    </div>
                                                                </div>
                                                                <!--end::Card header-->
                                                                <!--begin::Card body-->
                                                                <div class="card-body pt-0">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row">
                                                                        <!--begin::Label-->
                                                                        <label class="required form-label">Discount start date</label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <input type="date" name="start_coupon" class="form-control mb-2" placeholder="Coupon code"/>
                                                                        <!--end::Input-->
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                    <div class="fv-row mt-5">
                                                                        <div class="d-flex justify-content-between align-items-center">
                                                                            <div>
                                                                                <label class="required form-label">Discount end date</label>
                                                                            </div>
                                                                            <div class="fv-row">
                                                                                <input type="checkbox" name="experation" id="experation"/>
                                                                                <label class="form-label" for="experation">Disable end date</label>
                                                                            </div>
                                                                        </div>
                                                                        <input type="date" name="end_coupon" class="form-control mb-2" placeholder="Coupon code"/>
                                                                    </div>
                                                                    <!--begin::Input group-->
                                                                    <div class="mb-10 fv-row">
                                                                        <!--begin::Label-->
                                                                        <label class="required form-label">Discount %</label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <input type="text" name="discount" class="form-control mb-2" placeholder="e.x. 25%"/>
                                                                        <!--end::Input-->
                                                                    </div>
                                                                    <!--end::Input group-->

                                                                    <!--begin::Actions-->
                                                                    <div class="d-flex justify-content-end">
                                                                        <button type="reset" class="btn btn-sm btn-light fw-bolder btn-active-light-khardl me-2" data-kt-search-element="advanced-options-form-cancel">Cancel</button>
                                                                        <button type="reset" class="btn btn-sm btn-light fw-bolder btn btn-sm fw-bolder btn-khardl me-2" data-kt-search-element="advanced-options-form-cancel">Start Discounts</button>
                                                                    </div>
                                                                    <!--end::Actions-->

                                                                </div>
                                                                <!--end::Card header-->
                                                            </div>
                                                            <!--end::General options-->
                                                        </div>
                                                    </div>
                                                    <!--end::Tab pane-->
                                                </div>

                                            </div>
                                            <!--end::Main column-->
                                        </form>
                                        <!--end::Form-->
                                    </div>
                                    <!--end::Card widget 4-->
                                </div>
                                <!--begin::Col-->
                                <div class="col-lg-8 col-xl-8 col-xxl-8 mb-8 mb-xl-0">
                                    <!--begin::Chart widget 3-->
                                    <div class="card card-flush overflow-hidden h-md-100">
                                        <!--begin::List widget 5-->
                                        <div class="card card-flush h-xl-100">
                                            <!--begin::Header-->
                                            <div class="card-header pt-7">
                                                <!--begin::Title-->
                                                <!--begin:::Tabs-->
                                                <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8">
                                                    <!--begin:::Tab item-->
                                                    <li class="nav-item">
                                                        <a class="nav-link text-active-khardl pb-4 active" data-bs-toggle="tab" href="#kt_ecommerce_settings_general">Select items</a>
                                                    </li>
                                                    <!--end:::Tab item-->
                                                    <!--begin:::Tab item-->
                                                    <li class="nav-item">
                                                        <a class="nav-link text-active-khardl pb-4" data-bs-toggle="tab" href="#kt_ecommerce_settings_store">Active discounts</a>
                                                    </li>
                                                    <!--end:::Tab item-->
                                                    <!--begin:::Tab item-->
                                                    <li class="nav-item">
                                                        <a class="nav-link text-active-khardl pb-4" data-bs-toggle="tab" href="#kt_ecommerce_settings_localization">Upcoming discounts</a>
                                                    </li>
                                                    <!--end:::Tab item-->
                                                    <!--begin:::Tab item-->
                                                    <li class="nav-item">
                                                        <a class="nav-link text-active-khardl pb-4" data-bs-toggle="tab" href="#kt_ecommerce_settings_products">Ended discounts
                                                        </a>
                                                    </li>
                                                    <!--end:::Tab item-->
                                                </ul>
                                                <!--end:::Tabs-->
                                                <!--end::Title-->
                                            </div>
                                            <!--end::Header-->
                                            <!--begin::Body-->
                                            <div class="card-body p-0">
                                                <!--begin::Scroll-->
                                                <div class="hover-scroll-overlay-y" style="height: 280px">
                                                    <!--begin::Content-->
                                                    <div class="flex-lg-row-fluid ms-lg-15">

                                                        <!--begin:::Tab content-->
                                                        <div class="tab-content" id="myTabContent">
                                                            <!--begin:::Tab pane-->
                                                            <div class="tab-pane fade show active" id="kt_ecommerce_settings_general" role="tabpanel">
                                                                <!--begin::Products-->
                                                                <div class="card card-flush">
                                                                    <!--begin::Card body-->
                                                                    <div class="card-body p-0 ">
                                                                        <div>
                                                                            <!--begin::Form-->
                                                                            <form action="#">
                                                                                <!--begin::Card-->
                                                                                <div class="card">
                                                                                    <!--begin::Card body-->
                                                                                    <div class="card-body p-0 w-100">
                                                                                        <!--begin::Compact form-->
                                                                                        <div class="d-flex align-items-center">
                                                                                            <!--begin::Input group-->
                                                                                            <div class="position-relative w-md-600px me-md-2">
                                                                                                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                                                                                <span class="svg-icon svg-icon-3 svg-icon-gray-500 position-absolute top-50 translate-middle ms-6">
                                                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                                                                                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                                                                                            </svg>
                                                                                                        </span>
                                                                                                <!--end::Svg Icon-->
                                                                                                <input type="text" class="form-control form-control-solid ps-10" name="search" value="" placeholder="{{__('messages.search')}}" />
                                                                                            </div>
                                                                                            <!--end::Input group-->

                                                                                            <!--begin:Action-->
                                                                                            <div class="d-flex align-items-center">
                                                                                                <button type="submit" class="btn btn-khardl me-5">Search</button>
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
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Card body-->
                                                                    <!--begin::Actions-->
                                                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                                                        <div class="d-flex justify-content-end align-items-center w-50">
                                                                            <button type="reset" class="btn btn-sm btn-light fw-bolder btn-active-light-khardl me-2 w-100" data-kt-search-element="advanced-options-form-cancel">Select all</button>

                                                                            <select class="form-select badge badge-light-khardl p-3" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="kt_ecommerce_add_product_store_template">
                                                                                <option selected>Categories</option>
                                                                                <option value="default">Default template</option>
                                                                                <option value="electronics">Electronics</option>
                                                                                <option value="office">Office stationary</option>
                                                                                <option value="fashion">Fashion</option>
                                                                            </select>
                                                                        </div>

                                                                        <div>
                                                                            <button type="submit" class="badge badge-light-khardl  p-3 me-13 text-hover-khardl bg-hover-khardl"  style="border:none" title="Save"><i class="fas fa-save"></i></button>
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Actions-->
                                                                </div>
                                                                <!--end::Products-->

                                                                <div class="d-flex align-items-center bg-light-dark rounded p-3 mt-3">
                                                                    <!--begin::Icon-->
                                                                    <span class="svg-icon svg-icon-danger me-5">
                                                                                <input type="checkbox"  name="subscribe" id="subscribeCheckbox">
                                                                            </span>
                                                                    <!--end::Icon-->
                                                                    <!--begin::Title-->
                                                                    <div class="flex-grow-1 me-2">
                                                                        <label" class="fw-bolder text-gray-800 text-hover-khardl fs-6">Rebrand strategy planning</label>
                                                                    </div>
                                                                    <!-- discount percentage -->
                                                                    <div class="flex-grow-1 me-2">
                                                                        <div>
                                                                            <label" class="fw-bolder text-gray-800 text-hover-khardl fs-6">
                                                                            <div class="hover-container">
                                                                                <div class="hover-tag">150 SAR</div>
                                                                                <div class="meta-description">New price</div>
                                                                            </div>
                                                                            </label>
                                                                        </div>
                                                                        --------
                                                                        <div>
                                                                            <label" class="fw-bolder text-gray-800 text-hover-khardl fs-6">
                                                                            <div class="hover-container">
                                                                                <div class="hover-tag"><del>200 SAR</del></div>
                                                                                <div class="meta-description">Old price</div>
                                                                            </div>
                                                                            </label>
                                                                        </div>
                                                                    </div>
                                                                    <!--end::discount percentage-->
                                                                    <!-- Start Date -->
                                                                    <div class="flex-grow-1 me-2">
                                                                        <div>
                                                                            <label" class="fw-bolder text-gray-800 text-hover-khardl fs-6">
                                                                            <div class="hover-container">
                                                                                <div class="hover-tag">2023-08-15</div>
                                                                                <div class="meta-description">Start date</div>
                                                                            </div>
                                                                            </label>
                                                                        </div>
                                                                        -----------
                                                                        <div>
                                                                            <label" class="fw-bolder text-gray-800 text-hover-khardl fs-6">
                                                                            <div class="hover-container">
                                                                                <div class="hover-tag">2023-08-31</div>
                                                                                <div class="meta-description">End date</div>
                                                                            </div>
                                                                            </label>
                                                                        </div>
                                                                    </div>

                                                                    <!-- end Date -->
                                                                    <div class="flex-grow-1 me-2">

                                                                    </div>

                                                                    <!-- delete -->
                                                                    <div class="flex-grow-1 me-2">
                                                                        <button class="btn btn-sm btn-danger p-2 text-center"><i class="fas fa-trash"></i></button>
                                                                    </div>


                                                                </div>


                                                            </div>
                                                            <!--end:::Tab pane-->
                                                            <!--begin:::Tab pane-->
                                                            <div class="tab-pane fade" id="kt_ecommerce_settings_store" role="tabpanel">
                                                                <!--begin::Table-->
                                                                <table class="table align-middle table-row-dashed fs-6 gy-3" id="kt_table_widget_5_table">
                                                                    <!--begin::Table head-->
                                                                    <thead>
                                                                    <!--begin::Table row-->
                                                                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase">
                                                                        <th class="text-start w-75px">Discount</th>
                                                                        <th class="text-start w-75px">Times used</th>
                                                                        <th class="text-start w-75px">Expiration date</th>
                                                                    </tr>
                                                                    <!--end::Table row-->
                                                                    </thead>
                                                                    <!--end::Table head-->
                                                                    <!--begin::Table body-->
                                                                    <tbody class="fw-bolder text-gray-600">
                                                                    <tr>
                                                                        <!--begin::Item-->
                                                                        <td>
                                                                            <a href="#" class="text-dark text-hover-khardl">self-234h-f325</a>
                                                                        </td>
                                                                        <!--end::Item-->
                                                                        <td class="text-start">Mark</td>
                                                                        <td class="text-start">
                                                                            <span class="badge py-3 px-4 fs-7 badge-light-danger">69</span>
                                                                        </td>
                                                                    </tr>

                                                                    </tbody>
                                                                    <!--end::Table body-->
                                                                </table>
                                                                <!--end::Table-->
                                                            </div>
                                                            <!--end:::Tab pane-->
                                                            <!--begin:::Tab pane-->
                                                            <div class="tab-pane fade" id="kt_ecommerce_settings_localization" role="tabpanel">
                                                                <!--begin::Table-->
                                                                <table class="table align-middle table-row-dashed fs-6 gy-3" id="kt_table_widget_5_table">
                                                                    <!--begin::Table head-->
                                                                    <thead>
                                                                    <!--begin::Table row-->
                                                                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase">
                                                                        <th class="text-start w-75px">Product name</th>
                                                                        <th class="text-start w-75px">discount percentage</th>
                                                                        <th class="text-start w-75px">Start date</th>
                                                                        <th class="text-start w-75px">End date</th>
                                                                        <th class="text-start w-75px">Action</th>
                                                                    </tr>
                                                                    <!--end::Table row-->
                                                                    </thead>
                                                                    <!--end::Table head-->
                                                                    <!--begin::Table body-->
                                                                    <tbody class="fw-bolder text-gray-600">
                                                                    <tr>
                                                                        <!--begin::Item-->
                                                                        <td>
                                                                            <a href="#" class="text-dark text-hover-khardl">Product one</a>
                                                                        </td>
                                                                        <td class="text-start">
                                                                            <span class="badge py-3 px-4 fs-7 badge-light-khardl">69%</span>
                                                                        </td>
                                                                        <!--end::Item-->
                                                                        <td class="text-start">2023-08-15</td>
                                                                        <td class="text-start">2023-08-31</td>
                                                                        <td class="text-start"><button type="submit" class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button></td>
                                                                    </tr>

                                                                    </tbody>
                                                                    <!--end::Table body-->
                                                                </table>
                                                                <!--end::Table-->
                                                            </div>
                                                            <!--end:::Tab pane-->
                                                            <!--begin:::Tab pane-->
                                                            <div class="tab-pane fade" id="kt_ecommerce_settings_products" role="tabpanel">
                                                                <!--begin::Table-->
                                                                <table class="table align-middle table-row-dashed fs-6 gy-3" id="kt_table_widget_5_table">
                                                                    <!--begin::Table head-->
                                                                    <thead>
                                                                    <!--begin::Table row-->
                                                                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase">
                                                                        <th class="text-start w-75px">Discount</th>
                                                                        <th class="text-start w-75px">Times used</th>
                                                                        <th class="text-start w-75px">Expiration date</th>
                                                                    </tr>
                                                                    <!--end::Table row-->
                                                                    </thead>
                                                                    <!--end::Table head-->
                                                                    <!--begin::Table body-->
                                                                    <tbody class="fw-bolder text-gray-600">
                                                                    <tr>
                                                                        <!--begin::Item-->
                                                                        <td>
                                                                            <a href="#" class="text-dark text-hover-khardl">self-234h-f325</a>
                                                                        </td>
                                                                        <!--end::Item-->
                                                                        <td class="text-start">Mark</td>
                                                                        <td class="text-start">
                                                                            <span class="badge py-3 px-4 fs-7 badge-light-danger">69</span>
                                                                        </td>
                                                                    </tr>

                                                                    </tbody>
                                                                    <!--end::Table body-->
                                                                </table>
                                                                <!--end::Table-->
                                                            </div>
                                                            <!--end:::Tab pane-->
                                                            <!--begin:::Tab pane-->
                                                            <div class="tab-pane fade" id="kt_ecommerce_settings_customers" role="tabpanel">
                                                                <!--begin::Products-->
                                                                <div class="card card-flush">
                                                                    <!--begin::Card header-->
                                                                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                                                        <!--begin::Card title-->
                                                                        <div class="card-title">
                                                                            <!--begin::Title-->
                                                                            <h2>Customers</h2>
                                                                            <!--end::Title-->
                                                                        </div>
                                                                        <!--end::Card title-->
                                                                    </div>
                                                                    <!--end::Card header-->
                                                                    <!--begin::Card body-->
                                                                    <div class="card-body pt-0">
                                                                        <!--begin::Form-->
                                                                        <form id="kt_ecommerce_settings_general_customers" class="form" action="#">
                                                                            <!--begin::Input group-->
                                                                            <div class="row fv-row mb-7">
                                                                                <div class="col-md-3 text-md-end">
                                                                                    <!--begin::Label-->
                                                                                    <label class="fs-6 fw-bold form-label mt-3">
                                                                                        <span>Customers Online</span>
                                                                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enable/disable tracking customers online status."></i>
                                                                                    </label>
                                                                                    <!--end::Label-->
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <div class="d-flex mt-3">
                                                                                        <!--begin::Radio-->
                                                                                        <div class="form-check form-check-custom form-check-solid me-5">
                                                                                            <input class="form-check-input" type="radio" value="" name="customers_online" id="customers_online_yes" checked="checked" />
                                                                                            <label class="form-check-label" for="customers_online_yes">Yes</label>
                                                                                        </div>
                                                                                        <div class="form-check form-check-custom form-check-solid">
                                                                                            <input class="form-check-input" type="radio" value="" name="customers_online" id="customers_online_no" />
                                                                                            <label class="form-check-label" for="customers_online_no">No</label>
                                                                                        </div>
                                                                                        <!--end::Radio-->
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!--end::Input group-->
                                                                            <!--begin::Input group-->
                                                                            <div class="row fv-row mb-7">
                                                                                <div class="col-md-3 text-md-end">
                                                                                    <!--begin::Label-->
                                                                                    <label class="fs-6 fw-bold form-label mt-3">
                                                                                        <span>Customers Activity</span>
                                                                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enable/disable tracking customers activity."></i>
                                                                                    </label>
                                                                                    <!--end::Label-->
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <div class="d-flex mt-3">
                                                                                        <!--begin::Radio-->
                                                                                        <div class="form-check form-check-custom form-check-solid me-5">
                                                                                            <input class="form-check-input" type="radio" value="" name="customers_activity" id="customers_activity_yes" checked="checked" />
                                                                                            <label class="form-check-label" for="customers_activity_yes">Yes</label>
                                                                                        </div>
                                                                                        <div class="form-check form-check-custom form-check-solid">
                                                                                            <input class="form-check-input" type="radio" value="" name="customers_activity" id="customers_activity_no" />
                                                                                            <label class="form-check-label" for="customers_activity_no">No</label>
                                                                                        </div>
                                                                                        <!--end::Radio-->
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!--end::Input group-->
                                                                            <!--begin::Input group-->
                                                                            <div class="row fv-row mb-7">
                                                                                <div class="col-md-3 text-md-end">
                                                                                    <!--begin::Label-->
                                                                                    <label class="fs-6 fw-bold form-label mt-3">
                                                                                        <span>Customer Searches</span>
                                                                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enable/disable logging customers search keywords."></i>
                                                                                    </label>
                                                                                    <!--end::Label-->
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <div class="d-flex mt-3">
                                                                                        <!--begin::Radio-->
                                                                                        <div class="form-check form-check-custom form-check-solid me-5">
                                                                                            <input class="form-check-input" type="radio" value="" name="customers_searches" id="customers_searches_yes" checked="checked" />
                                                                                            <label class="form-check-label" for="customers_searches_yes">Yes</label>
                                                                                        </div>
                                                                                        <div class="form-check form-check-custom form-check-solid">
                                                                                            <input class="form-check-input" type="radio" value="" name="customers_searches" id="customers_searches_no" />
                                                                                            <label class="form-check-label" for="customers_searches_no">No</label>
                                                                                        </div>
                                                                                        <!--end::Radio-->
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!--end::Input group-->
                                                                            <!--begin::Input group-->
                                                                            <div class="row fv-row mb-7">
                                                                                <div class="col-md-3 text-md-end">
                                                                                    <!--begin::Label-->
                                                                                    <label class="fs-6 fw-bold form-label mt-3">
                                                                                        <span>Allow Guest Checkout</span>
                                                                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enable/disable guest customers to checkout."></i>
                                                                                    </label>
                                                                                    <!--end::Label-->
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <div class="d-flex mt-3">
                                                                                        <!--begin::Radio-->
                                                                                        <div class="form-check form-check-custom form-check-solid me-5">
                                                                                            <input class="form-check-input" type="radio" value="" name="customers_guest_checkout" id="customers_guest_checkout_yes" />
                                                                                            <label class="form-check-label" for="customers_guest_checkout_yes">Yes</label>
                                                                                        </div>
                                                                                        <div class="form-check form-check-custom form-check-solid">
                                                                                            <input class="form-check-input" type="radio" value="" name="customers_guest_checkout" id="customers_guest_checkout_no" checked="checked" />
                                                                                            <label class="form-check-label" for="customers_guest_checkout_no">No</label>
                                                                                        </div>
                                                                                        <!--end::Radio-->
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!--end::Input group-->
                                                                            <!--begin::Input group-->
                                                                            <div class="row fv-row mb-7">
                                                                                <div class="col-md-3 text-md-end">
                                                                                    <!--begin::Label-->
                                                                                    <label class="fs-6 fw-bold form-label mt-3">
                                                                                        <span>Login Display Prices</span>
                                                                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Only show prices when customers log in."></i>
                                                                                    </label>
                                                                                    <!--end::Label-->
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <div class="d-flex mt-3">
                                                                                        <!--begin::Radio-->
                                                                                        <div class="form-check form-check-custom form-check-solid me-5">
                                                                                            <input class="form-check-input" type="radio" value="" name="customers_login_prices" id="customers_login_prices_yes" />
                                                                                            <label class="form-check-label" for="customers_login_prices_yes">Yes</label>
                                                                                        </div>
                                                                                        <div class="form-check form-check-custom form-check-solid">
                                                                                            <input class="form-check-input" type="radio" value="" name="customers_login_prices" id="customers_login_prices_no" checked="checked" />
                                                                                            <label class="form-check-label" for="customers_login_prices_no">No</label>
                                                                                        </div>
                                                                                        <!--end::Radio-->
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!--end::Input group-->
                                                                            <!--begin::Input group-->
                                                                            <div class="row fv-row mb-7">
                                                                                <div class="col-md-3 text-md-end">
                                                                                    <!--begin::Label-->
                                                                                    <label class="fs-6 fw-bold form-label mt-3">
                                                                                        <span class="required">Max Login Attempts</span>
                                                                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Set the max number of login attempts before the customer account is locked for 1 hour."></i>
                                                                                    </label>
                                                                                    <!--end::Label-->
                                                                                </div>
                                                                                <div class="col-md-9">
                                                                                    <!--begin::Input-->
                                                                                    <input type="text" class="form-control form-control-solid" name="customer_login_attempts" value="" />
                                                                                    <!--end::Input-->
                                                                                </div>
                                                                            </div>
                                                                            <!--end::Input group-->
                                                                            <!--begin::Action buttons-->
                                                                            <div class="row">
                                                                                <div class="col-md-9 offset-md-3">
                                                                                    <!--begin::Separator-->
                                                                                    <div class="separator mb-6"></div>
                                                                                    <!--end::Separator-->
                                                                                    <div class="d-flex justify-content-end">
                                                                                        <!--begin::Button-->
                                                                                        <button type="reset" data-kt-ecommerce-settings-type="cancel" class="btn btn-light me-3">Cancel</button>
                                                                                        <!--end::Button-->
                                                                                        <!--begin::Button-->
                                                                                        <button type="submit" data-kt-ecommerce-settings-type="submit" class="btn btn-khardl">
                                                                                            <span class="indicator-label">Save</span>
                                                                                            <span class="indicator-progress">Please wait...
                                                                                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                                                        </button>
                                                                                        <!--end::Button-->
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <!--end::Action buttons-->
                                                                        </form>
                                                                        <!--end::Form-->
                                                                    </div>
                                                                    <!--end::Card body-->
                                                                </div>
                                                                <!--end::Products-->
                                                            </div>
                                                            <!--end:::Tab pane-->
                                                        </div>
                                                        <!--end:::Tab content-->
                                                    </div>
                                                    <!--end::Content-->
                                                </div>
                                                <!--end::Scroll-->
                                            </div>
                                            <!--end::Body-->
                                        </div>
                                        <!--end::List widget 5-->
                                    </div>
                                    <!--end::Chart widget 3-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Modals-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Post-->
                </div>
                <!--end::Content-->



                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">
                    <!--begin::Post-->
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <!--begin::Container-->
                        <div id="kt_content_container" class="container-xxl">
                            <!--begin::Row-->
                            <div class="row g-12 g-xl-12 mb-xl-112">
                                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 mb-md-4 mb-xl-0">
                                    <!--begin::Card widget 4-->
                                    <div class="card card-flush h-md-100 mb-5 mb-xl-0">
                                        <!--begin::Form-->
                                        <form id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row"
                                              data-kt-redirect="../../demo1/dist/apps/ecommerce/catalog/restaurants.html">

                                            <!--begin::Main column-->
                                            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                                                <!--begin::Tab content-->
                                                <div class="tab-content">
                                                    <!--begin::Tab pane-->
                                                    <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                                                        <div class="d-flex flex-column gap-7 gap-lg-10">
                                                            <!--begin::General options-->
                                                            <div class="card card-flush py-4">
                                                                <!--begin::Card header-->
                                                                <div class="card-header">
                                                                    <div class="card-title">
                                                                        <h2>Loyalty points</h2>
                                                                    </div>
                                                                </div>
                                                                <!--end::Card header-->
                                                                <!--begin::Card body-->
                                                                <div class="card-body pt-0">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row">
                                                                        <!--begin::Label-->
                                                                        <label class="required form-label">Loyalty points</label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <input type="number" name="coupon" class="form-control mb-2" placeholder="e.x. 60"/>
                                                                        <!--end::Input-->
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                    <div class="text-center mt-5 mb-5">
                                                                        <span>=</span>
                                                                    </div>
                                                                    <!--begin::Input group-->
                                                                    <div class="mb-10 fv-row">
                                                                        <!--begin::Label-->
                                                                        <label class="required form-label">Dollars</label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <input type="number" name="discount" class="form-control mb-2" placeholder="e.x. 25$"/>
                                                                        <!--end::Input-->
                                                                    </div>
                                                                    <!--end::Input group-->

                                                                    <!--begin::Actions-->
                                                                    <div class="d-flex justify-content-end">
                                                                        <button type="reset" class="btn btn-sm btn-light fw-bolder btn-active-light-khardl me-2" data-kt-search-element="advanced-options-form-cancel">Cancel</button>
                                                                        <button type="reset" class="btn btn-sm btn-light fw-bolder btn btn-sm fw-bolder btn-khardl me-2" data-kt-search-element="advanced-options-form-cancel">Apply</button>
                                                                    </div>
                                                                    <!--end::Actions-->

                                                                </div>
                                                                <!--end::Card header-->
                                                            </div>
                                                            <!--end::General options-->
                                                        </div>
                                                    </div>
                                                    <!--end::Tab pane-->
                                                </div>

                                            </div>
                                            <!--end::Main column-->
                                        </form>
                                        <!--end::Form-->
                                    </div>
                                    <!--end::Card widget 4-->
                                </div>
                                <!--begin::Col-->
                                <div class="col-lg-8 col-xl-8 col-xxl-8 mb-8 mb-xl-0">
                                    <!--begin::Chart widget 3-->
                                    <div class="card card-flush overflow-hidden h-md-100">
                                        <!--begin::List widget 5-->
                                        <div class="card card-flush h-xl-100">
                                            <!--begin::Header-->
                                            <div class="card-header pt-7">
                                                <!--begin::Title-->
                                                <h2>Items loyalty points work on</h2>
                                                <!--end::Title-->
                                            </div>
                                            <!--end::Header-->
                                            <!--begin::Body-->
                                            <div class="card-body p-0">
                                                <!--begin::Scroll-->
                                                <div class="hover-scroll-overlay-y" style="height: 300px">
                                                    <!--begin::Content-->
                                                    <div class="flex-lg-row-fluid ms-lg-15">

                                                        <!--begin:::Tab content-->
                                                        <div class="tab-content" id="myTabContent">
                                                            <!--begin:::Tab pane-->
                                                            <div class="tab-pane fade show active" id="kt_ecommerce_settings_general" role="tabpanel">
                                                                <!--begin::Products-->
                                                                <div class="card card-flush">
                                                                    <!--begin::Card body-->
                                                                    <div class="card-body p-0 ">
                                                                        <div>
                                                                            <!--begin::Form-->
                                                                            <form action="#">
                                                                                <!--begin::Card-->
                                                                                <div class="card">
                                                                                    <!--begin::Card body-->
                                                                                    <div class="card-body p-0 w-100">
                                                                                        <!--begin::Compact form-->
                                                                                        <div class="d-flex align-items-center">
                                                                                            <!--begin::Input group-->
                                                                                            <div class="position-relative w-md-600px me-md-2">
                                                                                                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                                                                                <span class="svg-icon svg-icon-3 svg-icon-gray-500 position-absolute top-50 translate-middle ms-6">
                                                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                                                                                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                                                                                            </svg>
                                                                                                        </span>
                                                                                                <!--end::Svg Icon-->
                                                                                                <input type="text" class="form-control form-control-solid ps-10" name="search" value="" placeholder="{{__('messages.search')}}" />
                                                                                            </div>
                                                                                            <!--end::Input group-->

                                                                                            <!--begin:Action-->
                                                                                            <div class="d-flex align-items-center">
                                                                                                <button type="submit" class="btn btn-khardl me-5">Search</button>
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
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Card body-->
                                                                    <!--begin::Actions-->
                                                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                                                        <div class="d-flex justify-content-end align-items-center w-50">
                                                                            <button type="reset" class="btn btn-sm btn-light fw-bolder btn-active-light-khardl me-2 w-100" data-kt-search-element="advanced-options-form-cancel">Select all</button>

                                                                            <select class="form-select badge badge-light-khardl p-3" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="kt_ecommerce_add_product_store_template">
                                                                                <option selected>Categories</option>
                                                                                <option value="default">Default template</option>
                                                                                <option value="electronics">Electronics</option>
                                                                                <option value="office">Office stationary</option>
                                                                                <option value="fashion">Fashion</option>
                                                                            </select>
                                                                        </div>

                                                                        <div>
                                                                            <button type="submit" class="badge badge-light-khardl  p-3 me-13 text-hover-khardl bg-hover-khardl"  style="border:none" title="Save"><i class="fas fa-save"></i></button>
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Actions-->
                                                                </div>
                                                                <!--end::Products-->

                                                                <div class="d-flex align-items-center bg-light-dark rounded p-3 mt-3">
                                                                    <!--begin::Icon-->
                                                                    <span class="svg-icon svg-icon-danger me-5">
                                                                                <input type="checkbox"  name="subscribe" id="subscribeCheckbox">
                                                                            </span>
                                                                    <!--end::Icon-->
                                                                    <!--begin::Title-->
                                                                    <div class="flex-grow-1 me-2">
                                                                        <label" class="fw-bolder text-gray-800 text-hover-khardl fs-6">Rebrand strategy planning</label>
                                                                    </div>
                                                                    <div class="flex-grow-1 me-2">
                                                                        <label" class="fw-bolder badge badge-light-khardl  text-hover-khardl fs-6">
                                                                        <div class="hover-container">
                                                                            <div class="hover-tag">50 SAR</div>
                                                                            <div class="meta-description">price in SAR</div>
                                                                        </div>
                                                                        </label>
                                                                    </div>
                                                                    <div class="flex-grow-1 me-2">
                                                                        <label" class="fw-bolder badge badge-light-khardl  text-hover-khardl fs-6" title="price in points">
                                                                        <div class="hover-container">
                                                                            <div class="hover-tag">1500 points</div>
                                                                            <div class="meta-description">price in Points</div>
                                                                        </div>
                                                                        </label>
                                                                    </div>

                                                                    <!--end::Title-->
                                                                </div>


                                                            </div>
                                                            <!--end:::Tab pane-->
                                                        </div>
                                                        <!--end:::Tab content-->
                                                    </div>
                                                    <!--end::Content-->
                                                </div>
                                                <!--end::Scroll-->
                                            </div>
                                            <!--end::Body-->
                                        </div>
                                        <!--end::List widget 5-->
                                    </div>
                                    <!--end::Chart widget 3-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Modals-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Post-->
                </div>
                <!--end::Content-->

                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">
                    <!--begin::Post-->
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <!--begin::Container-->
                        <div id="kt_content_container" class="container-xxl">
                            <!--begin::Row-->
                            <div class="row g-12 g-xl-12 mb-xl-112">
                                <div class="col-md-4 col-lg-4 col-xl-4 col-xxl-4 mb-md-4 mb-xl-0">
                                    <!--begin::Card widget 4-->
                                    <div class="card card-flush h-md-100 mb-5 mb-xl-0">
                                        <!--begin::Form-->
                                        <form id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row"
                                              data-kt-redirect="../../demo1/dist/apps/ecommerce/catalog/restaurants.html">

                                            <!--begin::Main column-->
                                            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                                                <!--begin::Tab content-->
                                                <div class="tab-content">
                                                    <!--begin::Tab pane-->
                                                    <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                                                        <div class="d-flex flex-column gap-7 gap-lg-10">
                                                            <!--begin::General options-->
                                                            <div class="card card-flush py-4">
                                                                <!--begin::Card header-->
                                                                <div class="card-header">
                                                                    <div class="card-title">
                                                                        <h2>Cash-back</h2>
                                                                    </div>
                                                                </div>
                                                                <!--end::Card header-->
                                                                <!--begin::Card body-->
                                                                <div class="card-body pt-0">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row">
                                                                        <!--begin::Label-->
                                                                        <label class="required form-label">Threshold</label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <input type="number" name="coupon" class="form-control mb-2" placeholder="e.x. 50"/>
                                                                        <!--end::Input-->
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                    <!--begin::Input group-->
                                                                    <div class="mb-10 mt-1 fv-row">
                                                                        <!--begin::Input-->
                                                                        <input type="checkbox" name="threshold" id="threshold"/>
                                                                        <!--end::Input-->
                                                                        <!--begin::Label-->
                                                                        <label class="form-label" for="threshold">Enable threshold</label>
                                                                        <!--end::Label-->
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                    <!--begin::Input group-->
                                                                    <div class="mb-10 fv-row">
                                                                        <!--begin::Label-->
                                                                        <label class="required form-label">Money back %</label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <input type="number" name="discount" class="form-control mb-2" placeholder="e.x. 5%"/>
                                                                        <!--end::Input-->
                                                                    </div>
                                                                    <!--end::Input group-->

                                                                    <!--begin::Actions-->
                                                                    <div class="d-flex justify-content-end">
                                                                        <button type="reset" class="btn btn-sm btn-light fw-bolder btn-active-light-khardl me-2" data-kt-search-element="advanced-options-form-cancel">Cancel</button>
                                                                        <button type="reset" class="btn btn-sm btn-light fw-bolder btn btn-sm fw-bolder btn-khardl me-2" data-kt-search-element="advanced-options-form-cancel">Apply</button>
                                                                    </div>
                                                                    <!--end::Actions-->

                                                                </div>
                                                                <!--end::Card header-->
                                                            </div>
                                                            <!--end::General options-->
                                                        </div>
                                                    </div>
                                                    <!--end::Tab pane-->
                                                </div>

                                            </div>
                                            <!--end::Main column-->
                                        </form>
                                        <!--end::Form-->
                                    </div>
                                    <!--end::Card widget 4-->
                                </div>
                                <!--begin::Col-->
                                <div class="col-lg-8 col-xl-8 col-xxl-8 mb-8 mb-xl-0">
                                    <!--begin::Chart widget 3-->
                                    <div class="card card-flush overflow-hidden h-md-100">
                                        <!--begin::List widget 5-->
                                        <div class="card card-flush h-xl-100">
                                            <!--begin::Header-->
                                            <div class="card-header pt-7">
                                                <!--begin::Title-->
                                                <h2>Items cash-back applies to</h2>
                                                <!--end::Title-->
                                            </div>
                                            <!--end::Header-->
                                            <!--begin::Body-->
                                            <div class="card-body p-0">
                                                <!--begin::Scroll-->
                                                <div class="hover-scroll-overlay-y" style="height: 300px">
                                                    <!--begin::Content-->
                                                    <div class="flex-lg-row-fluid ms-lg-15">

                                                        <!--begin:::Tab content-->
                                                        <div class="tab-content" id="myTabContent">
                                                            <!--begin:::Tab pane-->
                                                            <div class="tab-pane fade show active" id="kt_ecommerce_settings_general" role="tabpanel">
                                                                <!--begin::Products-->
                                                                <div class="card card-flush">
                                                                    <!--begin::Card body-->
                                                                    <div class="card-body p-0 ">
                                                                        <div>
                                                                            <!--begin::Form-->
                                                                            <form action="#">
                                                                                <!--begin::Card-->
                                                                                <div class="card">
                                                                                    <!--begin::Card body-->
                                                                                    <div class="card-body p-0 w-100">
                                                                                        <!--begin::Compact form-->
                                                                                        <div class="d-flex align-items-center">
                                                                                            <!--begin::Input group-->
                                                                                            <div class="position-relative w-md-600px me-md-2">
                                                                                                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                                                                                <span class="svg-icon svg-icon-3 svg-icon-gray-500 position-absolute top-50 translate-middle ms-6">
                                                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                                                                <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                                                                                                <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                                                                                            </svg>
                                                                                                        </span>
                                                                                                <!--end::Svg Icon-->
                                                                                                <input type="text" class="form-control form-control-solid ps-10" name="search" value="" placeholder="{{__('messages.search')}}" />
                                                                                            </div>
                                                                                            <!--end::Input group-->

                                                                                            <!--begin:Action-->
                                                                                            <div class="d-flex align-items-center">
                                                                                                <button type="submit" class="btn btn-khardl me-5">Search</button>
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
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Card body-->
                                                                    <!--begin::Actions-->
                                                                    <div class="d-flex justify-content-between align-items-center mt-3">
                                                                        <div class="d-flex justify-content-end align-items-center w-50">
                                                                            <button type="reset" class="btn btn-sm btn-light fw-bolder btn-active-light-khardl me-2 w-100" data-kt-search-element="advanced-options-form-cancel">Select all</button>

                                                                            <select class="form-select badge badge-light-khardl p-3" data-control="select2" data-hide-search="true" data-placeholder="Select an option" id="kt_ecommerce_add_product_store_template">
                                                                                <option selected>Categories</option>
                                                                                <option value="default">Default template</option>
                                                                                <option value="electronics">Electronics</option>
                                                                                <option value="office">Office stationary</option>
                                                                                <option value="fashion">Fashion</option>
                                                                            </select>
                                                                        </div>

                                                                        <div>
                                                                            <button type="submit" class="badge badge-light-khardl  p-3 me-13 text-hover-khardl bg-hover-khardl"  style="border:none" title="Save"><i class="fas fa-save"></i></button>
                                                                        </div>
                                                                    </div>
                                                                    <!--end::Actions-->
                                                                </div>
                                                                <!--end::Products-->

                                                                <div class="d-flex align-items-center bg-light-dark rounded p-3 mt-3">
                                                                    <!--begin::Icon-->
                                                                    <span class="svg-icon svg-icon-danger me-5">
                                                                                <input type="checkbox"  name="subscribe" id="subscribeCheckbox">
                                                                            </span>
                                                                    <!--end::Icon-->
                                                                    <!--begin::Title-->
                                                                    <div class="flex-grow-1 me-2">
                                                                        <label" class="fw-bolder text-gray-800 text-hover-khardl fs-6">Rebrand strategy planning</label>
                                                                    </div>
                                                                    <div class="flex-grow-1 me-2">
                                                                        <label" class="fw-bolder badge badge-light-khardl text-gray-800 text-hover-khardl fs-6">
                                                                        <div class="hover-container">
                                                                            <div class="hover-tag">150 SAR</div>
                                                                            <div class="meta-description">Price</div>
                                                                        </div>
                                                                        </label>
                                                                    </div>
                                                                    <div class="flex-grow-1 me-2">
                                                                        <label" class="fw-bolder badge  badge-light-khardl text-gray-800 text-hover-khardl fs-6">
                                                                        <div class="hover-container">
                                                                            <div class="hover-tag">5 SAR</div>
                                                                            <div class="meta-description">value cash back</div>
                                                                        </div>
                                                                        </label>
                                                                    </div>
                                                                    <!--end::Title-->

                                                                </div>

                                                            </div>
                                                            <!--end:::Tab pane-->
                                                        </div>
                                                        <!--end:::Tab content-->
                                                    </div>
                                                    <!--end::Content-->
                                                </div>
                                                <!--end::Scroll-->
                                            </div>
                                            <!--end::Body-->
                                        </div>
                                        <!--end::List widget 5-->
                                    </div>
                                    <!--end::Chart widget 3-->
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Modals-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Post-->
                </div>
                <!--end::Content-->

            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Root-->
    <!--end::Main-->


    <!--begin::Javascript-->
    <script>
        const enableUsesCheckbox = document.getElementById('enableUses');
        const usesInput = document.querySelector('[name="uses"]');

        enableUsesCheckbox.addEventListener('change', function () {
            const isChecked = enableUsesCheckbox.checked;

            usesInput.disabled = isChecked;

            if (isChecked) {
                usesInput.value = ''; // Clear the value when disabled
            }
        });
    </script>


    <!-- Checked -->
    <script>
        const percentageInput = document.getElementById('percentageInput');
        const sarInput = document.getElementById('sarInput');

        const percentageRadio = document.getElementById('kt_create_account_form_account_type_percentage');
        const sarRadio = document.getElementById('kt_create_account_form_account_type_sar');

        percentageRadio.addEventListener('change', () => {
            if (percentageRadio.checked) {
                percentageInput.disabled = false;
                sarInput.disabled = true;
                sarInput.value = ''; // Clear the value when disabled
            }
        });

        sarRadio.addEventListener('change', () => {
            if (sarRadio.checked) {
                sarInput.disabled = false;
                percentageInput.disabled = true;
                percentageInput.value = ''; // Clear the value when disabled
            }
        });

        const percentageLabel = document.querySelector('[for="kt_create_account_form_account_type_percentage"]');
        const sarLabel = document.querySelector('[for="kt_create_account_form_account_type_sar"]');

        percentageLabel.addEventListener('click', () => {
            percentageInput.disabled = false;
            sarInput.disabled = true;
            sarInput.value = ''; // Clear the value when disabled
            percentageRadio.checked = true;
        });

        sarLabel.addEventListener('click', () => {
            sarInput.disabled = false;
            percentageInput.disabled = true;
            percentageInput.value = ''; // Clear the value when disabled
            sarRadio.checked = true;
        });
    </script>


    <!-- Timer -->
    <script>
        function startCountdown(days, hours, minutes) {
            const timerElement = document.getElementById('timer');
            let totalSeconds = (days * 24 * 60 * 60) + (hours * 60 * 60) + (minutes * 60);

            function updateTimer() {
                const daysRemaining = Math.floor(totalSeconds / (24 * 60 * 60));
                const hoursRemaining = Math.floor((totalSeconds % (24 * 60 * 60)) / (60 * 60));
                const minutesRemaining = Math.floor((totalSeconds % (60 * 60)) / 60);
                const secondsRemaining = totalSeconds % 60;

                const formattedTime = `${padZero(daysRemaining)}:${padZero(hoursRemaining)}:${padZero(minutesRemaining)}:${padZero(secondsRemaining)}`;
                timerElement.textContent = formattedTime;

                if (totalSeconds > 0) {
                    totalSeconds--;
                } else {
                    clearInterval(interval);
                    timerElement.textContent = "Time's up!";
                }
            }

            function padZero(number) {
                return number.toString().padStart(2, '0');
            }

            updateTimer();
            const interval = setInterval(updateTimer, 1000);
        }

        startCountdown(2, 12, 30); // Start the countdown with 2 days, 12 hours, and 30 minutes
    </script>

    <!-- Disable end date -->
    <script>
        const enableExpirationCheckbox = document.getElementById('experation');
        const endDateInput = document.querySelector('[name="end_coupon"]');

        enableExpirationCheckbox.addEventListener('change', function () {
            const isChecked = enableExpirationCheckbox.checked;

            if (isChecked) {
                endDateInput.disabled = true;
                endDateInput.value = ''; // Clear the value when disabled
            } else {
                endDateInput.disabled = false;
            }
        });
    </script>


    <script>
        // script.js
        const hoverTag = document.querySelector('.hover-tag');
        const metaDescription = document.querySelector('.meta-description');

        hoverTag.addEventListener('mouseenter', () => {
            setTimeout(() => {
                metaDescription.style.display = 'block';
            }, 300); // Adjust the delay as needed
        });

        hoverTag.addEventListener('mouseleave', () => {
            metaDescription.style.display = 'none';
        });

    </script>


    <!--begin::Javascript-->
    <script>var hostUrl = "assets/";</script>
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="{{global_asset('assets/plugins/global/plugins.bundle.js')}}"></script>
    {{--        <script src="assets/js/scripts.bundle.js"></script>--}}
    <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
    {{--        <script src="assets/js/custom/apps/file-manager/list.js"></script>--}}
    {{--        <script src="assets/js/widgets.bundle.js"></script>--}}
    {{--        <script src="assets/js/custom/widgets.js"></script>--}}
    {{--        <script src="assets/js/custom/utilities/modals/upgrade-plan.js"></script>--}}
    {{--        <script src="assets/js/custom/utilities/modals/create-app.js"></script>--}}
    {{--        <script src="assets/js/custom/utilities/modals/users-search.js"></script>--}}
    <!--end::Page Custom Javascript-->
    </body>
    <!--end::Body-->

@endsection
