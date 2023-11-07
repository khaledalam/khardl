@extends('layouts.restaurant-sidebar')

@section('title', __('messages.points'))
@section('subtitle', __('messages.your-balance') . ' ' . $user->points)

@section('content')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">

        <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">
    <!--begin::Pricing card-->
    <div class="card" id="kt_pricing">
    <!--begin::Card body-->
    <div class="card-body p-lg-17">
        <!--begin::Plans-->
        <div class="d-flex flex-column">
            <!--begin::Heading-->
            <div class="mb-13 text-center">
                <h1 class="fs-2hx fw-bolder mb-5">{{ __('messages.choose-your-preferred-package') }}</h1>
                <div class="text-gray-400 fw-bold fs-5">{{ __('messages.each-point-can-execute-1-request') }} </div>
            </div>
            <div class="row g-10">
                <!--begin::Col-->
                <div class="col-xl-4">
                    <div class="d-flex h-100 align-items-center">
                        <!--begin::Option-->
                        <div class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-15 px-10">
                            <!--begin::Heading-->
                            <div class="mb-7 text-center">
                                <!--begin::Title-->
                                <h1 class="text-dark mb-5 fw-boldest">90 {{ __('messages.points') }}</h1>
                                <!--end::Title-->
                                <!--begin::Description-->
                                <div class="text-gray-400 fw-bold mb-5">{{ __('messages.buy-points-90') }}</div>
                                <!--end::Description-->
                                <!--begin::Price-->
                                <div class="text-center">
                                    <span class="mb-2 text-khardl">{{ __('messages.sar') }}</span>
                                    <span class="fs-3x fw-bolder text-khardl" data-kt-plan-price-month="39" data-kt-plan-price-annual="399">116.1</span>
                                    <span class="fs-7 fw-bold opacity-50">/
                                    <span data-kt-element="period">90 {{ __('messages.points') }}</span></span>
                                </div>
                                <!--end::Price-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Features-->
                            <div class="w-100 mb-10">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center mb-5">
                                    <span class="fw-bold fs-6 text-gray-800 flex-grow-1 pe-3">{{ __('messages.one-point') }}</span>
                                    <span class="fw-bold fs-6 text-gray-800 flex-grow-1 pe-3">=</span>
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                    <span class="badge badge-light-khardl">
                                        1.29 {{ __('messages.sar') }}
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                
                            </div>
                            <!--end::Features-->
                            <!--begin::Select-->
                            <form id="buy-points-1" action="{{ route('tap.payment') }}" method="post">
                                @csrf
                                <input type="hidden" name="amount" value="116.1">
                            </form>
                            <a onclick="event.preventDefault();
                            document.getElementById('buy-points-1').submit();" class="btn btn-sm btn-khardl"><i class="fas fa-shopping-cart"></i>{{ __('messages.buy-now') }}</a>
                            <!--end::Select-->
                        </div>
                        <!--end::Option-->
                    </div>
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-xl-4">
                    <div class="d-flex h-100 align-items-center">
                        <!--begin::Option-->
                        <div class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-15 px-10">
                            <!--begin::Heading-->
                            <div class="mb-7 text-center">
                                <!--begin::Title-->
                                <h1 class="text-dark mb-5 fw-boldest">300 {{ __('messages.points') }}</h1>
                                <!--end::Title-->
                                <!--begin::Description-->
                                <div class="text-gray-400 fw-bold mb-5">{{ __('messages.buy-points-300') }}</div>
                                <!--end::Description-->
                                <!--begin::Price-->
                                <div class="text-center">
                                    <span class="mb-2 text-khardl">{{ __('messages.sar') }}</span>
                                    <span class="fs-3x fw-bolder text-khardl" data-kt-plan-price-month="39" data-kt-plan-price-annual="399">387</span>
                                    <span class="fs-7 fw-bold opacity-50">/
                                    <span data-kt-element="period">300 {{ __('messages.points') }}</span></span>
                                </div>
                                <!--end::Price-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Features-->
                            <div class="w-100 mb-10">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center mb-5">
                                    <span class="fw-bold fs-6 text-gray-800 flex-grow-1 pe-3">{{ __('messages.one-point') }}</span>
                                    <span class="fw-bold fs-6 text-gray-800 flex-grow-1 pe-3">=</span>
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                    <span class="badge badge-light-khardl">
                                        1.29 {{ __('messages.sar') }}
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                
                            </div>
                            <!--end::Features-->
                            <!--begin::Select-->
                            <form id="buy-points-2" action="{{ route('tap.payment') }}" method="post">
                                @csrf
                                <input type="hidden" name="amount" value="387">
                            </form>
                            <a onclick="event.preventDefault();
                            document.getElementById('buy-points-2').submit();" class="btn btn-sm btn-khardl"><i class="fas fa-shopping-cart"></i>{{ __('messages.buy-now') }}</a>
                            <!--end::Select-->
                        </div>
                        <!--end::Option-->
                    </div>
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-xl-4">
                    <div class="d-flex h-100 align-items-center">
                        <!--begin::Option-->
                        <div class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-15 px-10">
                            <!--begin::Heading-->
                            <div class="mb-7 text-center">
                                <!--begin::Title-->
                                <h1 class="text-dark mb-5 fw-boldest">550 {{ __('messages.points') }}</h1>
                                <!--end::Title-->
                                <!--begin::Description-->
                                <div class="text-gray-400 fw-bold mb-5">{{ __('messages.buy-points-550') }}</div>
                                <!--end::Description-->
                                <!--begin::Price-->
                                <div class="text-center">
                                    <span class="mb-2 text-khardl">{{ __('messages.sar') }}</span>
                                    <span class="fs-3x fw-bolder text-khardl" data-kt-plan-price-month="39" data-kt-plan-price-annual="399">654.5</span>
                                    <span class="fs-7 fw-bold opacity-50">/
                                    <span data-kt-element="period">550 {{ __('messages.points') }}</span></span>
                                </div>
                                <!--end::Price-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Features-->
                            <div class="w-100 mb-10">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center mb-5">
                                    <span class="fw-bold fs-6 text-gray-800 flex-grow-1 pe-3">{{ __('messages.one-point') }}</span>
                                    <span class="fw-bold fs-6 text-gray-800 flex-grow-1 pe-3">=</span>
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                    <span class="badge badge-light-khardl">
                                        1.19 {{ __('messages.sar') }}
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                
                            </div>
                            <!--end::Features-->
                            <!--begin::Select-->
                            <form id="buy-points-3" action="{{ route('tap.payment') }}" method="post">
                                @csrf
                                <input type="hidden" name="amount" value="654.5">
                            </form>
                            <a onclick="event.preventDefault();
                            document.getElementById('buy-points-3').submit();" class="btn btn-sm btn-khardl"><i class="fas fa-shopping-cart"></i>{{ __('messages.buy-now') }}</a>
                            <!--end::Select-->
                        </div>
                        <!--end::Option-->
                    </div>
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-xl-4">
                    <div class="d-flex h-100 align-items-center">
                        <!--begin::Option-->
                        <div class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-15 px-10">
                            <!--begin::Heading-->
                            <div class="mb-7 text-center">
                                <!--begin::Title-->
                                <h1 class="text-dark mb-5 fw-boldest">750 {{ __('messages.points') }}</h1>
                                <!--end::Title-->
                                <!--begin::Description-->
                                <div class="text-gray-400 fw-bold mb-5">{{ __('messages.buy-points-750') }}</div>
                                <!--end::Description-->
                                <!--begin::Price-->
                                <div class="text-center">
                                    <span class="mb-2 text-khardl">{{ __('messages.sar') }}</span>
                                    <span class="fs-3x fw-bolder text-khardl" data-kt-plan-price-month="39" data-kt-plan-price-annual="399">742.50</span>
                                    <span class="fs-7 fw-bold opacity-50">/
                                    <span data-kt-element="period">750 {{ __('messages.points') }}</span></span>
                                </div>
                                <!--end::Price-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Features-->
                            <div class="w-100 mb-10">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center mb-5">
                                    <span class="fw-bold fs-6 text-gray-800 flex-grow-1 pe-3">{{ __('messages.one-point') }}</span>
                                    <span class="fw-bold fs-6 text-gray-800 flex-grow-1 pe-3">=</span>
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                    <span class="badge badge-light-khardl">
                                        0.99 {{ __('messages.sar') }}
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                
                            </div>
                            <!--end::Features-->
                            <!--begin::Select-->
                            <form id="buy-points-4" action="{{ route('tap.payment') }}" method="post">
                                @csrf
                                <input type="hidden" name="amount" value="742.50">
                            </form>
                            <a onclick="event.preventDefault();
                            document.getElementById('buy-points-4').submit();" class="btn btn-sm btn-khardl"><i class="fas fa-shopping-cart"></i>{{ __('messages.buy-now') }}</a>
                            <!--end::Select-->
                        </div>
                        <!--end::Option-->
                    </div>
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-xl-4">
                    <div class="d-flex h-100 align-items-center">
                        <!--begin::Option-->
                        <div class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-15 px-10">
                            <!--begin::Heading-->
                            <div class="mb-7 text-center">
                                <!--begin::Title-->
                                <h1 class="text-dark mb-5 fw-boldest">990 {{ __('messages.points') }}</h1>
                                <!--end::Title-->
                                <!--begin::Description-->
                                <div class="text-gray-400 fw-bold mb-5">{{ __('messages.buy-points-990') }}</div>
                                <!--end::Description-->
                                <!--begin::Price-->
                                <div class="text-center">
                                    <span class="mb-2 text-khardl">{{ __('messages.sar') }}</span>
                                    <span class="fs-3x fw-bolder text-khardl" data-kt-plan-price-month="39" data-kt-plan-price-annual="399">950.4</span>
                                    <span class="fs-7 fw-bold opacity-50">/
                                    <span data-kt-element="period">990 {{ __('messages.points') }}</span></span>
                                </div>
                                <!--end::Price-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Features-->
                            <div class="w-100 mb-10">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center mb-5">
                                    <span class="fw-bold fs-6 text-gray-800 flex-grow-1 pe-3">{{ __('messages.one-point') }}</span>
                                    <span class="fw-bold fs-6 text-gray-800 flex-grow-1 pe-3">=</span>
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                    <span class="badge badge-light-khardl">
                                        0.96 {{ __('messages.sar') }}
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                
                            </div>
                            <!--end::Features-->
                            <!--begin::Select-->
                            <form id="buy-points-5" action="{{ route('tap.payment') }}" method="post">
                                @csrf
                                <input type="hidden" name="amount" value="950.4">
                            </form>
                            <a onclick="event.preventDefault();
                            document.getElementById('buy-points-5').submit();" class="btn btn-sm btn-khardl"><i class="fas fa-shopping-cart"></i>{{ __('messages.buy-now') }}</a>
                            <!--end::Select-->
                        </div>
                        <!--end::Option-->
                    </div>
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-xl-4">
                    <div class="d-flex h-100 align-items-center">
                        <!--begin::Option-->
                        <div class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-15 px-10">
                            <!--begin::Heading-->
                            <div class="mb-7 text-center">
                                <!--begin::Title-->
                                <h1 class="text-dark mb-5 fw-boldest">1500 {{ __('messages.points') }}</h1>
                                <!--end::Title-->
                                <!--begin::Description-->
                                <div class="text-gray-400 fw-bold mb-5">{{ __('messages.buy-points-1500') }}</div>
                                <!--end::Description-->
                                <!--begin::Price-->
                                <div class="text-center">
                                    <span class="mb-2 text-khardl">{{ __('messages.sar') }}</span>
                                    <span class="fs-3x fw-bolder text-khardl" data-kt-plan-price-month="39" data-kt-plan-price-annual="399">1395</span>
                                    <span class="fs-7 fw-bold opacity-50">/
                                    <span data-kt-element="period">1500 {{ __('messages.points') }}</span></span>
                                </div>
                                <!--end::Price-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Features-->
                            <div class="w-100 mb-10">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center mb-5">
                                    <span class="fw-bold fs-6 text-gray-800 flex-grow-1 pe-3">{{ __('messages.one-point') }}</span>
                                    <span class="fw-bold fs-6 text-gray-800 flex-grow-1 pe-3">=</span>
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                    <span class="badge badge-light-khardl">
                                        0.93 {{ __('messages.sar') }}
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                
                            </div>
                            <!--end::Features-->
                            <!--begin::Select-->
                            <form id="buy-points-6" action="{{ route('tap.payment') }}" method="post">
                                @csrf
                                <input type="hidden" name="amount" value="1395">
                            </form>
                            <a onclick="event.preventDefault();
                            document.getElementById('buy-points-6').submit();" class="btn btn-sm btn-khardl"><i class="fas fa-shopping-cart"></i>{{ __('messages.buy-now') }}</a>
                            <!--end::Select-->
                        </div>
                        <!--end::Option-->
                    </div>
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-xl-4">
                    <div class="d-flex h-100 align-items-center">
                        <!--begin::Option-->
                        <div class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-15 px-10">
                            <!--begin::Heading-->
                            <div class="mb-7 text-center">
                                <!--begin::Title-->
                                <h1 class="text-dark mb-5 fw-boldest">3000 {{ __('messages.points') }}</h1>
                                <!--end::Title-->
                                <!--begin::Description-->
                                <div class="text-gray-400 fw-bold mb-5">{{ __('messages.buy-points-3000') }}</div>
                                <!--end::Description-->
                                <!--begin::Price-->
                                <div class="text-center">
                                    <span class="mb-2 text-khardl">{{ __('messages.sar') }}</span>
                                    <span class="fs-3x fw-bolder text-khardl" data-kt-plan-price-month="39" data-kt-plan-price-annual="399">2640</span>
                                    <span class="fs-7 fw-bold opacity-50">/
                                    <span data-kt-element="period">3000 {{ __('messages.points') }}</span></span>
                                </div>
                                <!--end::Price-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Features-->
                            <div class="w-100 mb-10">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center mb-5">
                                    <span class="fw-bold fs-6 text-gray-800 flex-grow-1 pe-3">{{ __('messages.one-point') }}</span>
                                    <span class="fw-bold fs-6 text-gray-800 flex-grow-1 pe-3">=</span>
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                    <span class="badge badge-light-khardl">
                                        0.88 {{ __('messages.sar') }}
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                
                            </div>
                            <!--end::Features-->
                            <!--begin::Select-->
                            <form id="buy-points-7" action="{{ route('tap.payment') }}" method="post">
                                @csrf
                                <input type="hidden" name="amount" value="2640">
                            </form>
                            <a onclick="event.preventDefault();
                            document.getElementById('buy-points-7').submit();" class="btn btn-sm btn-khardl"><i class="fas fa-shopping-cart"></i>{{ __('messages.buy-now') }}</a>
                            <!--end::Select-->
                        </div>
                        <!--end::Option-->
                    </div>
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-xl-4">
                    <div class="d-flex h-100 align-items-center">
                        <!--begin::Option-->
                        <div class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-15 px-10">
                            <!--begin::Heading-->
                            <div class="mb-7 text-center">
                                <!--begin::Title-->
                                <h1 class="text-dark mb-5 fw-boldest">5500 {{ __('messages.points') }}</h1>
                                <!--end::Title-->
                                <!--begin::Description-->
                                <div class="text-gray-400 fw-bold mb-5">{{ __('messages.buy-points-5500') }}</div>
                                <!--end::Description-->
                                <!--begin::Price-->
                                <div class="text-center">
                                    <span class="mb-2 text-khardl">{{ __('messages.sar') }}</span>
                                    <span class="fs-3x fw-bolder text-khardl" data-kt-plan-price-month="39" data-kt-plan-price-annual="399">4400</span>
                                    <span class="fs-7 fw-bold opacity-50">/
                                    <span data-kt-element="period">5500 {{ __('messages.points') }}</span></span>
                                </div>
                                <!--end::Price-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Features-->
                            <div class="w-100 mb-10">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center mb-5">
                                    <span class="fw-bold fs-6 text-gray-800 flex-grow-1 pe-3">{{ __('messages.one-point') }}</span>
                                    <span class="fw-bold fs-6 text-gray-800 flex-grow-1 pe-3">=</span>
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                    <span class="badge badge-light-khardl">
                                        0.80 {{ __('messages.sar') }}
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                
                            </div>
                            <!--end::Features-->
                            <!--begin::Select-->
                            <form id="buy-points-8" action="{{ route('tap.payment') }}" method="post">
                                @csrf
                                <input type="hidden" name="amount" value="4400">
                            </form>
                            <a onclick="event.preventDefault();
                            document.getElementById('buy-points-8').submit();" class="btn btn-sm btn-khardl"><i class="fas fa-shopping-cart"></i>{{ __('messages.buy-now') }}</a>
                            <!--end::Select-->
                        </div>
                        <!--end::Option-->
                    </div>
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-xl-4">
                    <div class="d-flex h-100 align-items-center">
                        <!--begin::Option-->
                        <div class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-15 px-10">
                            <!--begin::Heading-->
                            <div class="mb-7 text-center">
                                <!--begin::Title-->
                                <h1 class="text-dark mb-5 fw-boldest">7000 {{ __('messages.points') }}</h1>
                                <!--end::Title-->
                                <!--begin::Description-->
                                <div class="text-gray-400 fw-bold mb-5">{{ __('messages.buy-points-7000') }}</div>
                                <!--end::Description-->
                                <!--begin::Price-->
                                <div class="text-center">
                                    <span class="mb-2 text-khardl">{{ __('messages.sar') }}</span>
                                    <span class="fs-3x fw-bolder text-khardl" data-kt-plan-price-month="39" data-kt-plan-price-annual="399">4550</span>
                                    <span class="fs-7 fw-bold opacity-50">/
                                    <span data-kt-element="period">0.65 {{ __('messages.points') }}</span></span>
                                </div>
                                <!--end::Price-->
                            </div>
                            <!--end::Heading-->
                            <!--begin::Features-->
                            <div class="w-100 mb-10">
                                <!--begin::Item-->
                                <div class="d-flex align-items-center mb-5">
                                    <span class="fw-bold fs-6 text-gray-800 flex-grow-1 pe-3">{{ __('messages.one-point') }}</span>
                                    <span class="fw-bold fs-6 text-gray-800 flex-grow-1 pe-3">=</span>
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen043.svg-->
                                    <span class="badge badge-light-khardl">
                                        0.65 {{ __('messages.sar') }}
                                    </span>
                                    <!--end::Svg Icon-->
                                </div>
                                
                            </div>
                            <!--end::Features-->
                            <!--begin::Select-->
                            <form id="buy-points-9" action="{{ route('tap.payment') }}" method="post">
                                @csrf
                                <input type="hidden" name="amount" value="4550">
                            </form>
                            <a onclick="event.preventDefault();
                            document.getElementById('buy-points-9').submit();" class="btn btn-sm btn-khardl"><i class="fas fa-shopping-cart"></i>{{ __('messages.buy-now') }}</a>
                            <!--end::Select-->
                        </div>
                        <!--end::Option-->
                    </div>
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-xl-12">
                    <div class="d-flex h-100 align-items-center">
                        <!--begin::Option-->
                        <div class="w-100 d-flex flex-column flex-center rounded-3 bg-light bg-opacity-75 py-15 px-10">
                            <!--begin::Heading-->
                            <div class="mb-7 text-center">
                                <!--begin::Title-->
                                <h1 class="text-dark mb-5 fw-boldest">{{ __('messages.one-year-of-unlimited-orders') }}</h1>
                                <!--end::Title-->
                                <!--begin::Description-->
                                <div class="text-gray-400 fw-bold mb-5">{{ __('messages.you-can-buy-this-package-and-activate-your-one-year-of-unlimited-orders') }}</div>
                                <!--end::Description-->
                                <!--begin::Price-->
                                <div class="text-center">
                                    <span class="mb-2 text-khardl">{{ __('messages.sar') }}</span>
                                    <span class="fs-3x fw-bolder text-khardl" data-kt-plan-price-month="39" data-kt-plan-price-annual="399">4800</span>
                                </div>
                                <!--end::Price-->
                            </div>
                            <!--end::Heading-->
                        
                            <!--begin::Select-->
                            <form id="buy-points-10" action="{{ route('tap.payment') }}" method="post">
                                @csrf
                                <input type="hidden" name="amount" value="4800">
                            </form>
                            <a onclick="event.preventDefault();
                            document.getElementById('buy-points-10').submit();" class="btn btn-sm btn-khardl"><i class="fas fa-shopping-cart"></i>{{ __('messages.buy-now') }}</a>
                            <!--end::Select-->
                        </div>
                        <!--end::Option-->
                    </div>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        </div>
        <!--end::Plans-->
    </div>
    <!--end::Card body-->
    </div>
    <!--end::Pricing card-->
    </div>
    <!--end::Container-->
    </div>
    <!--end::Post-->
    </div>
    <!--end::Content-->
@endsection