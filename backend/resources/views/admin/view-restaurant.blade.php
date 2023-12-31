@extends('layouts.view-restaurant-layout')
@section('title', __('messages.view-restaurant'))

@section('body')
@parent
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">

        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Navbar-->
                <!--end::Navbar-->

                    <!--begin::Row-->
                    @if ($is_live)
                        <div class="row g-5 g-xl-10 mb-xl-10">
                            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
                                <!--begin::Card widget 5-->
                                <div class="card card-flush h-md-100 mb-5 mb-xl-10">
                                    <!--begin::Header-->
                                    <div class="card-header pt-5">
                                        <!--begin::Title-->
                                        <div class="card-title d-flex flex-column">
                                            <!--begin::Info-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Amount-->
                                                <span class="fs-2hx fw-bolder text-dark me-2 lh-1 ls-n2">1500</span>
                                                <!--end::Amount-->
                                            </div>
                                            <!--end::Info-->
                                            <!--begin::Subtitle-->
                                            <span class="text-gray-400 pt-1 fw-bold fs-6">{{ __('messages.total-orders')}}</span>
                                            <!--end::Subtitle-->
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-2 pb-4 d-flex align-items-center">
                                        <!--begin::Labels-->
                                        <div class="d-flex flex-column content-justify-center w-100">
                                            <!--begin::Label-->
                                            <div class="d-flex fs-6 fw-bold align-items-center">
                                                <!--begin::Bullet-->
                                                <div class="bullet w-8px h-6px rounded-2 bg-danger me-3"></div>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-500 flex-grow-1 me-4">
                                                    {{ __('messages.pending')}}
                                                </div>
                                                <!--end::Label-->
                                                <!--begin::Stats-->
                                                <div class="fw-boldest text-gray-700 text-xxl-end">
                                                    500
                                                </div>
                                                <!--end::Stats-->
                                            </div>
                                            <!--end::Label-->
                                            <!--begin::Label-->
                                            <div class="d-flex fs-6 fw-bold align-items-center my-3">
                                                <!--begin::Bullet-->
                                                <div class="bullet w-8px h-6px rounded-2 bg-primary me-3"></div>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-500 flex-grow-1 me-4">
                                                    {{ __('messages.accepted')}}
                                                </div>
                                                <!--end::Label-->
                                                <!--begin::Stats-->
                                                <div class="fw-boldest text-gray-700 text-xxl-end">
                                                    500
                                                </div>
                                                <!--end::Stats-->
                                            </div>
                                            <!--end::Label-->
                                            <!--begin::Label-->
                                            <div class="d-flex fs-6 fw-bold align-items-center">
                                                <!--begin::Bullet-->
                                                <div class="bullet w-8px h-6px rounded-2 me-3"
                                                    style="background-color: #efefe4"></div>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-500 flex-grow-1 me-4">
                                                    {{ __('messages.cancelled')}}
                                                </div>
                                                <!--end::Label-->
                                                <!--begin::Stats-->
                                                <div class="fw-boldest text-gray-700 text-xxl-end">
                                                    500
                                                </div>
                                                <!--end::Stats-->
                                            </div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Labels-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card widget 5-->
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
                                <!--begin::Card widget 4-->
                                <div class="card card-flush h-md-100 mb-5 mb-xl-10">
                                    <!--begin::Header-->
                                    <div class="card-header pt-5">
                                        <!--begin::Title-->
                                        <div class="card-title d-flex flex-column">
                                            <!--begin::Info-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Amount-->
                                                <span class="fs-2hx fw-bolder text-dark me-2 lh-1 ls-n2">25.3
                                                    <span class="badge badge-success fs-base">
                                                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                                        <span class="svg-icon svg-icon-5 svg-icon-white ms-n1">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                                height="24" viewBox="0 0 24 24" fill="none">
                                                                <rect opacity="0.5" x="13" y="6" width="13" height="2"
                                                                    rx="1" transform="rotate(90 13 6)"
                                                                    fill="currentColor" />
                                                                <path
                                                                    d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                                                                    fill="currentColor" />
                                                            </svg>
                                                        </span>
                                                        <!--end::Svg Icon-->{{ __('messages.minutes')}}</span>
                                                </span>
                                                <!--end::Amount-->
                                            </div>
                                            <!--end::Info-->
                                            <!--begin::Subtitle-->
                                            <span class="text-gray-400 pt-1 fw-bold fs-6">{{ __('messages.average-delivery-time')}}</span>
                                            <!--end::Subtitle-->
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-2 pb-4 d-flex align-items-center">
                                        <!--begin::Chart-->
                                        <div class="d-flex flex-center me-5 pt-2">
                                            <div id="kt_card_widget_4_chart"
                                                style="min-width: 70px; min-height: 70px" data-kt-size="70"
                                                data-kt-line="11"></div>
                                        </div>
                                        <!--end::Chart-->
                                        <!--begin::Labels-->
                                        <div class="d-flex flex-column content-justify-center w-100">
                                            <!--begin::Label-->
                                            <div class="d-flex fs-6 fw-bold align-items-center">
                                                <!--begin::Bullet-->
                                                <div class="bullet w-8px h-6px rounded-2 bg-danger me-3"></div>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-500 flex-grow-1 me-4">
                                                    Jun
                                                </div>
                                                <!--end::Label-->
                                                <!--begin::Stats-->
                                                <div class="fw-boldest text-gray-700 text-xxl-end">
                                                    45 m
                                                </div>
                                                <!--end::Stats-->
                                            </div>
                                            <!--end::Label-->
                                            <!--begin::Label-->
                                            <div class="d-flex fs-6 fw-bold align-items-center my-3">
                                                <!--begin::Bullet-->
                                                <div class="bullet w-8px h-6px rounded-2 bg-primary me-3"></div>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-500 flex-grow-1 me-4">
                                                    jul
                                                </div>
                                                <!--end::Label-->
                                                <!--begin::Stats-->
                                                <div class="fw-boldest text-gray-700 text-xxl-end">
                                                    35 m
                                                </div>
                                                <!--end::Stats-->
                                            </div>
                                            <!--end::Label-->
                                            <!--begin::Label-->
                                            <div class="d-flex fs-6 fw-bold align-items-center">
                                                <!--begin::Bullet-->
                                                <div class="bullet w-8px h-6px rounded-2 me-3"
                                                    style="background-color: #efefe4"></div>
                                                <!--end::Bullet-->
                                                <!--begin::Label-->
                                                <div class="text-gray-500 flex-grow-1 me-4">
                                                    Aug
                                                </div>
                                                <!--end::Label-->
                                                <!--begin::Stats-->
                                                <div class="fw-boldest text-gray-700 text-xxl-end">
                                                    23 m
                                                </div>
                                                <!--end::Stats-->
                                            </div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Labels-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card widget 4-->
                            </div>

                            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
                                <!--begin::Card widget 6-->
                                <div class="card card-flush h-md-100 mb-5 mb-xl-10">
                                    <!--begin::Header-->
                                    <div class="card-header pt-5">
                                        <!--begin::Title-->
                                        <div class="card-title d-flex flex-column">
                                            <!--begin::Info-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Currency-->
                                                <span
                                                    class="fs-4 fw-bold text-gray-400 me-1 align-self-start">%</span>
                                                <!--end::Currency-->
                                                <!--begin::Amount-->
                                                <span
                                                    class="fs-2hx fw-bolder text-dark me-2 lh-1 ls-n2">80</span>
                                                <!--end::Amount-->
                                                <!--begin::Badge-->
                                                <span class="badge badge-success fs-base">
                                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                                    <span class="svg-icon svg-icon-5 svg-icon-white ms-n1">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                            height="24" viewBox="0 0 24 24" fill="none">
                                                            <rect opacity="0.5" x="13" y="6" width="13" height="2"
                                                                rx="1" transform="rotate(90 13 6)"
                                                                fill="currentColor" />
                                                            <path
                                                                d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                                                                fill="currentColor" />
                                                        </svg>
                                                    </span>
                                                    <!--end::Svg Icon-->2.6%</span>
                                                <!--end::Badge-->
                                            </div>
                                            <!--end::Info-->
                                            <!--begin::Subtitle-->
                                            <span class="text-gray-400 pt-1 fw-bold fs-6">{{ __('messages.delivery-success-rate')}}</span>
                                            <!--end::Subtitle-->
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Card body-->
                                    <div class="card-body d-flex align-items-end px-0 pb-0">
                                        <!--begin::Chart-->
                                        <div id="kt_card_widget_6_chart" class="w-100" style="height: 80px"></div>
                                        <!--end::Chart-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card widget 6-->
                            </div>
                            <div class="col-md-6 col-lg-6 col-xl-6 col-xxl-3 mb-md-5 mb-xl-10">
                                <!--begin::Card widget 7-->
                                <div class="card card-flush h-md-100 mb-xl-10">
                                    <!--begin::Header-->
                                    <div class="card-header pt-5">
                                        <!--begin::Title-->
                                        <div class="card-title d-flex flex-column">
                                            <!--begin::Amount-->
                                            <span class="fs-2hx fw-bolder text-dark me-2 lh-1 ls-n2">6.3k</span>
                                            <!--end::Amount-->
                                            <!--begin::Subtitle-->
                                            <span class="text-gray-400 pt-1 fw-bold fs-6">{{ __('messages.new-customers-this-month') }}</span>
                                            <!--end::Subtitle-->
                                        </div>
                                        <!--end::Title-->
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Card body-->
                                    <div class="card-body d-flex flex-column justify-content-end pe-0">
                                        <!--begin::Title-->
                                        <span class="fs-6 fw-boldest text-gray-800 d-block mb-2">{{ __('messages.number-of-customers') }}</span>
                                        <!--end::Title-->
                                        <!--begin::Users group-->
                                        <div class="symbol-group symbol-hover flex-nowrap">
                                            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip"
                                                title="Alan Warden">
                                                <span
                                                    class="symbol-label bg-warning text-inverse-warning fw-bolder">A</span>
                                            </div>
                                            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip"
                                                title="Michael Eberon">
                                                <img alt="Pic" src="../assets/media/avatars/300-11.jpg" />
                                            </div>
                                            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip"
                                                title="Susan Redwood">
                                                <span
                                                    class="symbol-label bg-primary text-inverse-primary fw-bolder">S</span>
                                            </div>
                                            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip"
                                                title="Melody Macy">
                                                <img alt="Pic" src="../assets/media/avatars/300-2.jpg" />
                                            </div>
                                            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip"
                                                title="Perry Matthew">
                                                <span
                                                    class="symbol-label bg-danger text-inverse-danger fw-bolder">P</span>
                                            </div>
                                            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip"
                                                title="Barry Walter">
                                                <img alt="Pic" src="../assets/media/avatars/300-12.jpg" />
                                            </div>
                                            <a href=".//customers.html" class="symbol symbol-35px symbol-circle"
                                                data-bs-toggle="modal" data-bs-target="#kt_modal_view_users">
                                                <span
                                                    class="symbol-label bg-light text-gray-400 fs-8 fw-bolder">+42</span>
                                            </a>
                                        </div>
                                        <!--end::Users group-->
                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card widget 7-->
                            </div>

                        </div>
                    @endif
                    <!--end::Modals-->


                <!--begin::details View-->
                <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
                    <!--begin::Card header-->
                    <div class="card-header cursor-pointer">
                        <!--begin::Card title-->
                        <div class="card-title m-0">
                            <h3 class="fw-bolder m-0">{{ __('messages.restaurant-details') }}</h3>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <!--begin::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body p-9">
                        <!--begin::Row-->

{{--                        <div class="row mb-7">--}}
{{--                            <!--begin::Label-->--}}
{{--                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.health') }}</label>--}}
{{--                            <!--end::Label-->--}}
{{--                            <!--begin::Col-->--}}
{{--                            <div class="col-lg-8">--}}
{{--                                <span class="fw-bolder fs-6 text-gray-800">--}}
{{--                                   <a href={"https://stats.uptimerobot.com/xjL9numDqg"} target={"_blank"}>🟢</a>--}}
{{--                                </span>--}}
{{--                            </div>--}}
{{--                            <!--end::Col-->--}}
{{--                        </div>--}}

                        <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-bold text-muted">@if (app()->getLocale() == 'en')
                                {{ __('messages.restaurant-name') }}
                            @else
                            {{ __('messages.the-name') }}
                            @endif </label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800">{{ $restaurant->restaurant_name }}</span>
                            </div>
                            <!--end::Col-->
                        </div>
                        <div class="row mb-1">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.domain') }}</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800">
                                    <a href="{{ $restaurant->route('home') }}" >
                                        <p class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1">{{$restaurant->primary_domain->domain}} <i class="fas fa-external-link-alt"></i></p>
                                    </a>
                                </span>
                            </div>
                            <!--end::Col-->
                        </div>
                        <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.position') }}</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <span class="fw-bolder fs-6 text-gray-800">{{$restaurant->user->position}}</span>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                        <!--begin::Input group-->
                        <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.email') }}
                                <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('messages.email-must-be-verified') }}"></i></label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 fv-row">
                                <span class="fw-bold text-gray-800 fs-6">{{ $restaurant->user->email }}</span>
                                @if(!is_null($restaurant->user->email_verified_at))
                                    <span class="badge badge-success">{{ __('messages.verified') }}</span>
                                @else
                                <span class="badge badge-warning">{{ __('messages.unverified') }}</span>
                                @endif
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.phone-number') }}</label>

                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 d-flex align-items-center">
                                <span class="fw-bolder fs-6 text-gray-800 me-2">{{ $restaurant->user->phone }}</span>

                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.status') }}
                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('messages.status-must-be-active') }}"></i></label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 d-flex align-items-center">
                                {{-- @if($restaurant->isApproved == 0)
                                    <span class="badge badge-warning">{{ __('messages.pending') }}</span> --}}
                                @if ($is_live)
                                    <span class="badge badge-success">{{ __('messages.active') }}</span>
                                @else
                                    <span class="badge badge-warning">{{ __('messages.inactive') }}</span>
                                @endif
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.date-of-registration') }}</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                <a href="#" class="fw-bold fs-6 text-gray-800 text-hover-primary">{{ $restaurant->created_at->format('Y-m-d') }}</a>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.facility-name') }}
                            <i class="fas fa-download-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Country of origination"></i></label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                {{$restaurant->user->traderRegistrationRequirement->facility_name}}
                            </div>
                            <!--end::Col-->
                        </div>
                        <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-bold text-muted">{{ __('messages.IBAN') }}
                            <i class="fas fa-download-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Country of origination"></i></label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8">
                                {{$restaurant->user->traderRegistrationRequirement->IBAN}}
                            </div>
                            <!--end::Col-->
                        </div>
                    </div>
                       <!--begin::downloaded-->
                        <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
								<!--begin::Card header-->
								<div class="card-header cursor-pointer">
									<!--begin::Card title-->
									<div class="card-title m-0 d-flex justify-content-between align-items-center w-100">
                                        <div><h3 class="fw-bolder m-0"> {{ __('messages.files') }}</h3></div>
                                        <div>
                                            <a href="{{ route('admin.download.file',  ['path' =>\App\Models\User::STORAGE .'/'. $restaurant->user->id, 'fileName'=>$restaurant->restaurant_name.' - Trader requirements' ]) }}" class="btn btn-khardl ">
                                                <i class="fas fa-download me-1 text-black"></i> {{ __('messages.download') }}
                                                <span class="badge bg-success ms-1">
                                                    5 {{ __('messages.files') }}
                                                </span>
                                            </a>
                                        </div>
									</div>
									<!--end::Card title-->
								</div>



								<!--end::Card body-->

							<!--end::downloaded-->

                        <div class="card-body  row">

                            <!--begin::Input group-->
                            <div class="col-md-6 mb-5">
                                <!--begin::Label-->
                                <label class=" fw-bold text-muted">{{ __('messages.delivery-contract') }}
                                <i class="fas fa-download-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Country of origination"></i></label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="">
                                    {{ __('messages.no-file-available') }}
                                </div>
                                <!--end::Col-->
                            </div>

                            <div class="col-md-6 mb-5">
                                <!--begin::Label-->
                                <label class=" fw-bold text-muted">{{ __('messages.national-address') }}
                                <i class="fas fa-download-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Country of origination"></i></label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="">
                                    @if ($restaurant->user->traderRegistrationRequirement->national_address)
                                    <a  href="{{ route('admin.download.file', ['path' =>$restaurant->user->traderRegistrationRequirement->national_address,'fileName'=>$restaurant->restaurant_name.' - National Address']) }}"  ><span class="fw-bolder fs-6 fw-bold btn btn-sm btn-khardll"><i class="fas fa-download text-black"></i></span></a>
                                    @else
                                        {{ __('messages.no-file-available') }}
                                    @endif
                                </div>
                                <!--end::Col-->
                            </div>

                            <div class="col-md-6 mb-5">
                                <!--begin::Label-->
                                <label class="fw-bold text-muted">{{ __('messages.the-id-of-the-owner-of-manager') }}
                                <i class="fas fa-download-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Country of origination"></i></label>
                                <!--end::Label-->
                                <!--begin::Col-->

                                <div class="">
                                    @if ($restaurant->user->traderRegistrationRequirement->identity_of_owner_or_manager)
                                    <a href="{{ route('admin.download.file', ['path' =>$restaurant->user->traderRegistrationRequirement->identity_of_owner_or_manager,'fileName'=>$restaurant->restaurant_name.' - Identity of owner or manager']) }}"><span class="fw-bolder fs-6 fw-bold btn btn-sm btn-khardll"><i class="fas fa-download text-black"></i></span></a>
                                    @else
                                        {{ __('messages.no-file-available') }}
                                    @endif
                                </div>
                                <!--end::Col-->
                            </div>

                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="col-md-6 mb-5">
                                <!--begin::Label-->
                                <label class="fw-bold text-muted">{{ __('messages.commercial-registration') }}</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="">
                                    @if ($restaurant->user->traderRegistrationRequirement->commercial_registration)
                                    <a href="{{ route('admin.download.file', ['path' =>$restaurant->user->traderRegistrationRequirement->commercial_registration,'fileName'=>$restaurant->restaurant_name.' - Commercial registeration']) }}"><span class="fw-bolder fs-6 fw-bold btn btn-sm btn-khardll"><i class="fas fa-download text-black"></i></span></a>
                                    @else
                                        {{ __('messages.no-file-available') }}
                                    @endif
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="col-md-6 mb-5">
                                <!--begin::Label-->
                                <label class="fw-bold text-muted">{{ __('messages.tax-number') }}</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="">
                                    @if ($restaurant->user->traderRegistrationRequirement->tax_registration_certificate)
                                    <a href="{{ route('admin.download.file', ['path' =>$restaurant->user->traderRegistrationRequirement->tax_registration_certificate,'fileName'=>$restaurant->restaurant_name.' - Tax registeration certificate']) }}"><span class="fw-bolder fs-6 fw-bold btn btn-sm btn-khardll"><i class="fas fa-download text-black"></i></span></a>
                                    @else
                                        {{ __('messages.no-file-available') }}
                                    @endif

                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Input group-->
                            <!--begin::Input group-->
                            <div class="col-md-6 mb-5">
                                <!--begin::Label-->
                                <label class="fw-bold text-muted">{{ __('messages.bank-certificate') }}</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="">
                                    @if ($restaurant->user->traderRegistrationRequirement->bank_certificate)
                                        <a href="{{ route('admin.download.file', ['path' =>$restaurant->user->traderRegistrationRequirement->bank_certificate,'fileName'=>$restaurant->restaurant_name.' - Bank Certificate']) }}"><span class="fw-bolder fs-6 fw-bold btn btn-sm btn-khardll"><i class="fas fa-download text-black"></i></span></a>
                                    @else
                                        {{ __('messages.no-file-available') }}
                                    @endif
                                </div>
                                <!--end::Col-->
                            </div>
                        <!--end::Input group-->
                        </div>

                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::details View-->


            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->

    <!--begin::Modal - Delete-->
    <div class="modal fade" id="kt_modal_delete" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                        <span class="svg-icon svg-icon-1">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </div>
                    <!--end::Close-->
                </div>
                <!--begin::Modal header-->
                <!--begin::Modal body-->
                <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                    <!--begin::Heading-->
                    <div class="text-center mb-13">
                        <!--begin::Title-->
                        <h1 class="mb-3">Are you sure ?</h1>
                        <!--end::Title-->
                        <!--begin::Description-->
                        <div class="text-muted fw-bold fs-5">You won't able to be undo this!</div>
                        <!--end::Description-->
                    </div>
                    <!--end::Heading-->
                    <form action="" method="">
                        <!--begin::select-->
                        <select class="form-select form-control form-control-solid mb-8" name="" id="">
                            <option value="" disabled selected>-- Select an option -- </option>
                            <option value="">Commercial registration</option>
                            <option value="">Deliveery company contract</option>
                            <option value="">Both</option>
                        </select>
                        <!--end::select-->

                        <!--begin::Action-->
                        <div>
                            <a href="" class="btn btn-sm btn-hover-rise btn-primary">Yes, proceed</a>
                            <a href="" class="btn btn-sm btn-hover-rise btn-danger">No, cancel</a>
                        </div>
                        <!--end::Action-->
                    </form>
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - Delete-->
@endsection
