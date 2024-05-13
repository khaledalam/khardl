@extends('layouts.restaurant-sidebar')

@section('title', __('products-out-of-stock'))

@section('content')

    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">

            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid" id="kt_wrapper">
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
                                                                    <input type="text" data-kt-ecommerce-order-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="{{__('search')}}" />
                                                                </div>
                                                                <!--end::Search-->
                                                            </div>
                                                            <!--end::Card title-->

                                                        </div>
                                                        <!--end::Card header-->
                                                        <a href="#" class="btn btn-sm btn-khardl">{{__('search')}}</a>
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
                                                                    <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-khardl fw-bolder">Elephant 1802</a>
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
															<a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-khardl fw-bolder">150$</a></span>
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
                                                                    <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-khardl fw-bolder">Elephant 1802</a>
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
															<a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-khardl fw-bolder">150$</a></span>
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
                                                                    <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-khardl fw-bolder">Elephant 1802</a>
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
															<a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-khardl fw-bolder">150$</a></span>
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
                                                                    <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-khardl fw-bolder">Elephant 1802</a>
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
															<a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-khardl fw-bolder">150$</a></span>
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
                                                                    <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-khardl fw-bolder">Elephant 1802</a>
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
															<a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-khardl fw-bolder">150$</a></span>
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
                                                                    <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-khardl fw-bolder">Elephant 1802</a>
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
															<a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-khardl fw-bolder">150$</a></span>
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
                                                                    <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-khardl fw-bolder">Elephant 1802</a>
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
															<a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-khardl fw-bolder">150$</a></span>
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
                                                                    <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-khardl fw-bolder">Elephant 1802</a>
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
															<a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-khardl fw-bolder">150$</a></span>
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
                                                                    <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-khardl fw-bolder">Elephant 1802</a>
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
															<a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-khardl fw-bolder">150$</a></span>
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
                                                                    <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-khardl fw-bolder">Elephant 1802</a>
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
															<a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-khardl fw-bolder">150$</a></span>
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
                                                                    <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-khardl fw-bolder">Elephant 1802</a>
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
															<a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-khardl fw-bolder">150$</a></span>
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
                                                                    <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-khardl fw-bolder">Elephant 1802</a>
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
															<a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-khardl fw-bolder">150$</a></span>
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
                                                                    <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-khardl fw-bolder">Elephant 1802</a>
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
															<a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-khardl fw-bolder">150$</a></span>
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
                                                                    <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-khardl fw-bolder">Elephant 1802</a>
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
															<a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-khardl fw-bolder">150$</a></span>
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
                                                                    <a href="../../demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-khardl fw-bolder">Elephant 1802</a>
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
															<a href="../../demo1/dist/apps/ecommerce/sales/details.html" class="text-gray-800 text-hover-khardl fw-bolder">150$</a></span>
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
