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
                                    <div class="bullet w-8px h-6px rounded-2 bg-khardl me-3"></div>
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
                                    <div class="bullet w-8px h-6px rounded-2 bg-khardl me-3"></div>
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
                                <!--begin::Label-->
                                <div class="d-flex fs-6 fw-bold align-items-center my-3">
                                    <!--begin::Bullet-->
                                    <div class="bullet w-8px h-6px rounded-2 me-3 bg-danger"></div>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-500 flex-grow-1 me-4">
                                        {{ __('Cancelled')}}
                                    </div>
                                    <!--end::Label-->
                                    <!--begin::Stats-->
                                    <div class="fw-boldest text-gray-700 text-xxl-end">
                                        {{ $cancelledOrders }}
                                    </div>
                                    <!--end::Stats-->
                                </div>
                                <!--end::Label-->
                                <!--begin::Label-->
                                <div class="d-flex fs-6 fw-bold align-items-center my-3">
                                    <!--begin::Bullet-->
                                    <div class="bullet w-8px h-6px rounded-2 me-3 bg-danger"></div>
                                    <!--end::Bullet-->
                                    <!--begin::Label-->
                                    <div class="text-gray-500 flex-grow-1 me-4">
                                        {{ __('Rejected')}}
                                    </div>
                                    <!--end::Label-->
                                    <!--begin::Stats-->
                                    <div class="fw-boldest text-gray-700 text-xxl-end">
                                        {{ $rejectedOrders }}
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
                <div class="col-md-9 position-relative">
                    <div class="row">
                        <div class="col-md-2 filtration">
                            <div class="mb-4">
                                <select class="form-select" id="filter_range">
                                    <option value="daily" selected>{{ __('7 Days') }}</option>
                                    <option value="monthly">{{ __('6 Months') }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-12" id="monthly_statistics" style="display: none;">
                            <!--begin::Card widget 4-->
                            <div class="card card-flush h-md-100 mb-5 mb-xl-10">
                                <!--begin::Card body-->
                                <div class="card-body pt-2 pb-4 d-flex align-items-center">
                                    <div class="container">
                                        <div class="card">
                                            <div class="card-body p-1">
                                                <h3>
                                                    {{ __("Revenues within 6 months") }} :
                                                    <span class="btn-tooltip" data-bs-toggle="tooltip"
                                                    title="{{ $sum = getSumOfDataGraph($profitMonths) }} {{ __('SAR') }}" data-container="body"
                                                    data-animation="true" data-bs-toggle="tooltip">
                                                        {{ getAmount($sum) }} {{ __('SAR') }}
                                                    </span>
                                                </h3>
                                                {!! $profitMonths->renderHtml() !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Card widget 4-->
                        </div>
                        <div class="col-md-12" id="daily_statistics">
                            <!--begin::Card widget 4-->
                            <div class="card card-flush h-md-100 mb-5 mb-xl-10">
                                <!--end::Header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-2 pb-4 d-flex align-items-center">
                                    <div class="container">
                                        <div class="card">
                                            <div class="card-body p-1">
                                                <h3>
                                                    {{ __("Revenues within 7 days") }} :
                                                    <span class="btn-tooltip" data-bs-toggle="tooltip"
                                                    title="{{ $sum = getSumOfDataGraph($profitDays) }} {{ __('SAR') }}" data-container="body"
                                                    data-animation="true" data-bs-toggle="tooltip">
                                                        {{ getAmount($sum) }} {{ __('SAR') }}
                                                    </span>
                                                </h3>
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
                    <a href="{{ route('admin.owner-information.show', ['user' => $restaurant->user_id]) }}" class="btn btn-icon btn-bg-light btn-active-color-khardl btn-sm me-1">
                        <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                        <span class="svg-icon svg-icon-3">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor" />
                                <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor" />
                            </svg>
                        </span>
                        <!--end::Svg Icon-->
                    </a>
                    <!--end::Card title-->
                </div>
                <!--begin::Card header-->
                <!--begin::Card body-->
                <div class="card-body p-9">
                    <!--begin::Row-->

                    <div class="row mb-7">
                        <!--begin::Label-->
                        <label class="col-lg-4 fw-bold text-muted">{{ __('Restaurant name (English)') }}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800">{{ $restaurant->restaurant_name }}</span>
                        </div>
                        <!--end::Col-->
                    </div>
                    <div class="row mb-7">
                        <!--begin::Label-->
                        <label class="col-lg-4 fw-bold text-muted">
                            {{ __('Restaurant name (Arabic)') }}
                        </label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8">
                            <span class="fw-bolder fs-6 text-gray-800">{{ $restaurant->restaurant_name_ar }}</span>
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
                                <a href="{{ $restaurant->route('home') }}" target="_blank">
                                    <p class="text-gray-900 text-hover-khardl fs-2 fw-bolder me-1">{{$restaurant->primary_domain->domain}} <i class="fas fa-external-link-alt"></i></p>
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
                            <a href="mailto:{{ $restaurant->user->email }}" class="fw-bold text-gray-800 fs-6">{{ $restaurant->user->email }}</a>
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
                            <a href="tel:{{ $restaurant->user->phone }}" class="fw-bolder fs-6 text-gray-800 me-2">{{ $restaurant->user->phone }}</a>

                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->
                    <div class="row mb-7">
                        <!--begin::Label-->
                        <label class="col-lg-4 fw-bold text-muted">{{ __('National ID') }}
                            <i class="fas fa-download-circle ms-1 fs-7" data-bs-toggle="tooltip" title="national id number"></i></label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8">
                            {{$restaurant->user->traderRegistrationRequirement->national_id_number}}
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--begin::Input group-->
                    <div class="row mb-7">
                        <!--begin::Label-->
                        <label class="col-lg-4 fw-bold text-muted">{{ __('status') }}
                            <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="{{ __('status-must-be-active') }}"></i></label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8 d-flex align-items-center">
                            @include('components.restaurant-status-badge')
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Input group-->


                    @if ($restaurant?->user?->isRejected())
                        <!--begin::Input group-->
                        <div class="row mb-7">
                            <!--begin::Label-->
                            <label class="col-lg-4 fw-bold text-muted">{{ __('Rejection reasons') }}</label>
                            <!--end::Label-->
                            <!--begin::Col-->
                            <div class="col-lg-8 d-flex align-items-center">
                                {{-- @if($restaurant->isApproved == 0)
                                    <span class="badge badge-warning">{{ __('pending') }}</span> --}}
                                @if(count(json_decode($restaurant?->user?->reject_reasons) ?? []) > 0)
                                    <ul>
                                        @foreach(json_decode($restaurant?->user?->reject_reasons) ?? [] as $reason)
                                            <li class="fs-6 text-danger small">{{ __($reason)}}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Input group-->
                    @endif


                    <!--begin::Input group-->
                    <div class="row mb-7">
                        <!--begin::Label-->
                        <label class="col-lg-4 fw-bold text-muted">{{ __('date-of-registration') }}</label>
                        <!--end::Label-->
                        <!--begin::Col-->
                        <div class="col-lg-8">
                            <span class="fw-bold fs-6 text-gray-800">{{ $restaurant->created_at->format('Y-m-d H:i') }}</span>
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
                            <i class="fas fa-download-circle ms-1 fs-7" data-bs-toggle="tooltip" title="bank iban"></i></label>
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
                                @if($restaurant->user->traderRegistrationRequirement)
                                <small> {{__('Created at')}} {{$restaurant->user->traderRegistrationRequirement->created_at->format('Y-m-d H:m')}}</small>

                                @endif
                            </div>
                            <div>
                                <a href="{{ route('admin.download.file',  ['path' =>\App\Models\User::STORAGE .'/'. $restaurant->user->id, 'fileName'=>$restaurant->restaurant_name.' - Trader requirements' ]) }}" class="btn btn-khardl ">
                                    <i class="fas fa-download me-1 text-black"></i> {{ __('download') }}
                                    <span class="badge bg-khardl ms-1">
                                        {{$filesCount}} {{ __('files') }}
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
{{--                        <div class="col-md-6 mb-5">--}}
{{--                            <!--begin::Label-->--}}
{{--                            <label class=" fw-bold text-muted">{{ __('delivery-contract') }}--}}
{{--                                <i class="fas fa-download-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Country of origination"></i></label>--}}
{{--                            <!--end::Label-->--}}
{{--                            <!--begin::Col-->--}}
{{--                            <div class="">--}}
{{--                                {{ __('no-file-available') }}--}}
{{--                            </div>--}}
{{--                            <!--end::Col-->--}}
{{--                        </div>--}}

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
<style>
    canvas{
      width: 100%!important;
      height:100%!important;
      position: relative;
    }
  </style>
@section('js')
    @if($profitDays&&$is_live)
    {!! $profitDays->renderChartJsLibrary() !!}
    {!! $profitDays->renderJs() !!}
    @endif
    @if($profitMonths&&$is_live)
    {!! $profitMonths->renderChartJsLibrary() !!}
    {!! $profitMonths->renderJs() !!}
    @endif
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filter_range = document.getElementById('filter_range');
            const daily_statistics = document.getElementById('daily_statistics');
            const monthly_statistics = document.getElementById('monthly_statistics');

            if (filter_range?.length) {
                filter_range.addEventListener('change', function () {
                    if (filter_range.value === 'daily') {
                        daily_statistics.style.display = 'block';
                        monthly_statistics.style.display = 'none';
                    } else if (filter_range.value === 'monthly') {
                        daily_statistics.style.display = 'none';
                        monthly_statistics.style.display = 'block';
                    }
                });
            }
        });
    </script>

@endsection
