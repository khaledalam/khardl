<div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container">
            <!--begin::Navbar-->
            <!--end::Navbar-->

            <!--begin::Row-->
            @if ($is_live)
            <div class="row">
                <div class="col-md-3">
                    <!--begin::Card widget 5-->
                    <div class="card card-flush h-md-100 mb-5 mb-xl-10">
                        <!--begin::Header-->
                        <div class="card-header pt-5">
                            <!--begin::Title-->
                            <div class="card-title d-flex flex-column">
                                <!--begin::Info-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Amount-->
                                    <span class="fs-2hx fw-bolder text-dark me-2 lh-1 ls-n2">{{ $totalOrders }}</span>
                                    <!--end::Amount-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Subtitle-->
                                <span class="text-gray-400 pt-1 fw-bold fs-6">{{ __('total-orders')}}</span>
                                <!--end::Subtitle-->
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body">
                            <!--begin::Labels-->
                            <div class="d-flex flex-column content-justify-center w-100">
                                <!--begin::Label-->
                                <div class="d-flex fs-6 fw-bold align-items-center my-3">
                                    <!--begin::Bullet-->
                                    <div class="bullet w-8px h-6px rounded-2 bg-primary me-3"></div>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-500 flex-grow-1 me-4">
                                        {{ __('pending')}}
                                    </div>
                                    <!--end::Label-->
                                    <!--begin::Stats-->
                                    <div class="fw-boldest text-gray-700 text-xxl-end">
                                        {{ $pendingOrders }}
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Label-->
                                <!--begin::Label-->
                                <div class="d-flex fs-6 fw-bold align-items-center my-3 my-3">
                                    <!--begin::Bullet-->
                                    <div class="bullet w-8px h-6px rounded-2 bg-success me-3"></div>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-500 flex-grow-1 me-4">
                                        {{ __('completed')}}
                                    </div>
                                    <!--end::Label-->
                                    <!--begin::Stats-->
                                    <div class="fw-boldest text-gray-700 text-xxl-end">
                                        {{ $completedOrders }}
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <div class="d-flex fs-6 fw-bold align-items-center my-3 my-3">
                                    <!--begin::Bullet-->
                                    <div class="bullet w-8px h-6px rounded-2 bg-info me-3"></div>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-500 flex-grow-1 me-4">
                                        {{ __('accepted')}}
                                    </div>
                                    <!--end::Label-->
                                    <!--begin::Stats-->
                                    <div class="fw-boldest text-gray-700 text-xxl-end">
                                        {{ $acceptedOrders }}
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Label-->
                                <!--begin::Label-->
                                <div class="d-flex fs-6 fw-bold align-items-center my-3">
                                    <!--begin::Bullet-->
                                    <div class="bullet w-8px h-6px rounded-2 me-3 bg-warning"></div>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-500 flex-grow-1 me-4">
                                        {{ __('Ready')}}
                                    </div>
                                    <!--end::Label-->
                                    <!--begin::Stats-->
                                    <div class="fw-boldest text-gray-700 text-xxl-end">
                                        {{ $readyOrders }}
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Label-->
                                <!--begin::Label-->
                                <div class="d-flex fs-6 fw-bold align-items-center my-3">
                                    <!--begin::Bullet-->
                                    <div class="bullet w-8px h-6px rounded-2 me-3 bg-secondary"></div>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-500 flex-grow-1 me-4">
                                        {{ __('received_by_restaurant')}}
                                    </div>
                                    <!--end::Label-->
                                    <!--begin::Stats-->
                                    <div class="fw-boldest text-gray-700 text-xxl-end">
                                        {{ $receivedByResOrders }}
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Label-->
                            </div>
                            <!--end::Labels-->
                        </div>
                        <!--end::Card body-->

                        <!--begin::Header-->
                        <div class="card-footer pt-5">
                            <!--begin::Title-->
                            <div class="card-title d-flex flex-column">
                                <!--begin::Info-->
                                <div class="d-flex align-items-center">
                                    <!--begin::Amount-->
                                    <span class="fs-2hx fw-bolder text-dark me-2 lh-1 ls-n2">
                                        {{ getAmount((float)$salesThisMonth) }} {{ __('SAR') }}
                                    </span>
                                    <!--end::Amount-->
                                </div>
                                <!--end::Info-->
                                <!--begin::Subtitle-->
                                <span class="text-gray-400 pt-1 fw-bold fs-6">{{ __('Sales This month')}}</span>
                                <!--end::Subtitle-->
                            </div>
                            <!--end::Title-->
                        </div>
                        <!--end::Header-->
                    </div>
                    <!--end::Card widget 5-->
                </div>
                <div class="col-md-9">
                    <!--begin::Card widget 4-->
                    <div class="card card-flush h-md-100 mb-5 mb-xl-10">
                        <!--begin::Card body-->
                        <div class="card-body pt-2 pb-4 d-flex align-items-center">
                            <div class="container">
                                <div class="card">
                                    <div class="card-body p-0">
                                        <h1>{{ $profitMonths->options['chart_title'] }}</h1>
                                        {!! $profitMonths->renderHtml() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 4-->
                </div>
                <div class="col-md-12">
                    <!--begin::Card widget 4-->
                    <div class="card card-flush h-md-100 mb-5 mb-xl-10">
                        <!--end::Header-->
                        <!--begin::Card body-->
                        <div class="card-body pt-2 pb-4 d-flex align-items-center">
                            <div class="container">
                                <div class="card">
                                    <div class="card-body p-0">
                                        <h1>{{ $profitDays->options['chart_title'] }}</h1>
                                        {!! $profitDays->renderHtml() !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card widget 4-->
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
                        <h3 class="fw-bolder m-0">{{ __('restaurant-details') }}</h3>
                    </div>
                    <!--end::Card title-->
                </div>
                <!--begin::Card header-->
                <!--begin::Card body-->
                <div class="card-body p-9">
                    <!--begin::Row-->

                    <div class="row mb-7">
                        <!--begin::Label-->
                        <label class="col-lg-4 fw-bold text-muted">@if (app()->getLocale() == 'en')
                            {{ __('restaurant-name') }}
                            @else
                            {{ __('the-name') }}
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
                        <label class="col-lg-4 fw-bold text-muted">{{ __('domain') }}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800">
                                <a href="{{ $restaurant->route('home') }}">
                                    <p class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1">{{$restaurant->primary_domain->domain}} <i class="fas fa-external-link-alt"></i></p>
                                </a>
                            </span>
                        </div>
                        <!--end::Col-->
                    </div>
                    <div class="row mb-7">
                        <!--begin::Label-->
                        <label class="col-lg-4 fw-bold text-muted">{{ __('position') }}</label>
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
                        <label class="col-lg-4 fw-bold text-muted">{{ __('email') }}
                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('email-must-be-verified') }}"></i></label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 fv-row">
                            <span class="fw-bold text-gray-800 fs-6">{{ $restaurant->user->email }}</span>
                            @if(!is_null($restaurant->user->email_verified_at))
                            <span class="badge badge-success">{{ __('verified') }}</span>
                            @else
                            <span class="badge badge-warning">{{ __('unverified') }}</span>
                            @endif
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-7">
                        <!--begin::Label-->
                        <label class="col-lg-4 fw-bold text-muted">{{ __('phone-number') }}</label>

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
                        <label class="col-lg-4 fw-bold text-muted">{{ __('status') }}
                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('status-must-be-active') }}"></i></label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 d-flex align-items-center">
                            {{-- @if($restaurant->isApproved == 0)
                                <span class="badge badge-warning">{{ __('pending') }}</span> --}}
                            @if ($is_live)
                            <span class="badge badge-success">{{ __('active') }}</span>
                            @else
                            <span class="badge badge-warning">{{ __('inactive') }}</span>
                            @endif
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row mb-7">
                        <!--begin::Label-->
                        <label class="col-lg-4 fw-bold text-muted">{{ __('date-of-registration') }}</label>
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
                        <label class="col-lg-4 fw-bold text-muted">{{ __('facility-name') }}
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
                        <label class="col-lg-4 fw-bold text-muted">{{ __('IBAN') }}
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
                            <div>
                                <h3 class="fw-bolder m-0"> {{ __('files') }}</h3>
                            </div>
                            <div>
                                <a href="{{ route('admin.download.file',  ['path' =>\App\Models\User::STORAGE .'/'. $restaurant->user->id, 'fileName'=>$restaurant->restaurant_name.' - Trader requirements' ]) }}" class="btn btn-khardl ">
                                    <i class="fas fa-download me-1 text-black"></i> {{ __('download') }}
                                    <span class="badge bg-success ms-1">
                                        5 {{ __('files') }}
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
                            <label class=" fw-bold text-muted">{{ __('delivery-contract') }}
                                <i class="fas fa-download-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Country of origination"></i></label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="">
                                {{ __('no-file-available') }}
                            </div>
                            <!--end::Col-->
                        </div>

                        <div class="col-md-6 mb-5">
                            <!--begin::Label-->
                            <label class=" fw-bold text-muted">{{ __('national-address') }}
                                <i class="fas fa-download-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Country of origination"></i></label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="">
                                @if ($restaurant->user->traderRegistrationRequirement->national_address)
                                <a href="{{ route('admin.download.file', ['path' =>$restaurant->user->traderRegistrationRequirement->national_address,'fileName'=>$restaurant->restaurant_name.' - National Address']) }}"><span class="fw-bolder fs-6 fw-bold btn btn-sm btn-khardll"><i class="fas fa-download text-black"></i></span></a>
                                @else
                                {{ __('no-file-available') }}
                                @endif
                            </div>
                            <!--end::Col-->
                        </div>

                        <div class="col-md-6 mb-5">
                            <!--begin::Label-->
                            <label class="fw-bold text-muted">{{ __('the-id-of-the-owner-of-manager') }}
                                <i class="fas fa-download-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Country of origination"></i></label>
                            <!--end::Label-->
                            <!--begin::Col-->

                            <div class="">
                                @if ($restaurant->user->traderRegistrationRequirement->identity_of_owner_or_manager)
                                <a href="{{ route('admin.download.file', ['path' =>$restaurant->user->traderRegistrationRequirement->identity_of_owner_or_manager,'fileName'=>$restaurant->restaurant_name.' - Identity of owner or manager']) }}"><span class="fw-bolder fs-6 fw-bold btn btn-sm btn-khardll"><i class="fas fa-download text-black"></i></span></a>
                                @else
                                {{ __('no-file-available') }}
                                @endif
                            </div>
                            <!--end::Col-->
                        </div>

                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="col-md-6 mb-5">
                            <!--begin::Label-->
                            <label class="fw-bold text-muted">{{ __('commercial-registration') }}</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="">
                                @if ($restaurant->user->traderRegistrationRequirement->commercial_registration)
                                <a href="{{ route('admin.download.file', ['path' =>$restaurant->user->traderRegistrationRequirement->commercial_registration,'fileName'=>$restaurant->restaurant_name.' - Commercial registeration']) }}"><span class="fw-bolder fs-6 fw-bold btn btn-sm btn-khardll"><i class="fas fa-download text-black"></i></span></a>
                                @else
                                {{ __('no-file-available') }}
                                @endif
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="col-md-6 mb-5">
                            <!--begin::Label-->
                            <label class="fw-bold text-muted">{{ __('tax-number') }}</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="">
                                @if ($restaurant->user->traderRegistrationRequirement->tax_registration_certificate)
                                <a href="{{ route('admin.download.file', ['path' =>$restaurant->user->traderRegistrationRequirement->tax_registration_certificate,'fileName'=>$restaurant->restaurant_name.' - Tax registeration certificate']) }}"><span class="fw-bolder fs-6 fw-bold btn btn-sm btn-khardll"><i class="fas fa-download text-black"></i></span></a>
                                @else
                                {{ __('no-file-available') }}
                                @endif

                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                        <!--begin::Input group-->
                        <div class="col-md-6 mb-5">
                            <!--begin::Label-->
                            <label class="fw-bold text-muted">{{ __('bank-certificate') }}</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="">
                                @if ($restaurant->user->traderRegistrationRequirement->bank_certificate)
                                <a href="{{ route('admin.download.file', ['path' =>$restaurant->user->traderRegistrationRequirement->bank_certificate,'fileName'=>$restaurant->restaurant_name.' - Bank Certificate']) }}"><span class="fw-bolder fs-6 fw-bold btn btn-sm btn-khardll"><i class="fas fa-download text-black"></i></span></a>
                                @else
                                {{ __('no-file-available') }}
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
@section('charts')
@if($profitDays&&$is_live)
{!! $profitDays->renderChartJsLibrary() !!}
{!! $profitDays->renderJs() !!}
@endif
@if($profitMonths&&$is_live)
{!! $profitDays->renderChartJsLibrary() !!}
{!! $profitMonths->renderJs() !!}
@endif
@stop
