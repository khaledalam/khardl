@extends('layouts.restaurant-sidebar')

@section('title', __('branches'))

@section('content')
@push("styles")
<link
href="https://goSellJSLib.b-cdn.net/v2.0.0/css/gosell.css"
rel="stylesheet"
/>
<link href="{{ global_asset('js/custom/creditCard/main.css')}}"rel="stylesheet" type="text/css" />

<script
type="text/javascript"
src="https://goSellJSLib.b-cdn.net/v2.0.0/js/gosell.js"
></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


<style>

    .google_map {
        position: static !important;
        width: 100%;
        height: auto;
    }
    /* .google_map div {

        height: 70%;
        width: 43%;
        position: absolute;
        top: 0px;
        left: 0px;
        background-color: rgb(229, 227, 223);
    } */

    #map-autocomplete-card-new_branch {
        z-index: 100002 !important; 
        position: relative !important;
    }
    .map-overlay {
        position: relative;
        cursor: pointer;
    }

    .overlay-text {
        position: absolute;
        border-radius: 25px;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        font-size: 16px;
        color: white;
        text-align: center;
    }

    .overlay-text::after {
        content: "";
        display: block;
        width: 100%;
        height: 100%;
        position: absolute;
        top: 0;
        left: 0;
        z-index: -1;
    }

    img {
        display: block;
        width: 100%;
        height: auto;
    }
    .card-map {
        height: 300px;
    }
</style>
@endpush
@push('scripts')
    <script>
        let currentBranch = null;
        function changeBranch(branch){
            currentBranch = branch;
        }
        function submitPayment(e,branch){
            e.preventDefault();
            document.getElementById('currentBranch').value = currentBranch;
            goSell.submit();
        }
        goSell.goSellElements({
        containerID:"root",
        gateway:{
            callback	: function(event){
                if(event.card.id){
                    var waiting = document.querySelector('#waiting-item');
                    waiting.style.display = 'block';
                    var submitButton = document.getElementById('tap-btn');
                    submitButton.disabled = true;
                    document.getElementById('token_id').value = event.id;
                    document.getElementById('renewBranch').submit();
                }
            },
            publicKey:"{{env('TAP_PUBLIC_API_KEY')}}",
            language: "{{app()->getLocale()}}",
            supportedCurrencies: "all",
            supportedPaymentMethods: "all",
            notifications: 'standard',
            style: {
                base: {
                    color: '#535353',
                    lineHeight: '18px',
                    fontFamily: 'sans-serif',
                    fontSmoothing: 'antialiased',
                    fontSize: '16px',
                    '::placeholder': {
                        color: 'rgba(0, 0, 0, 0.26)',
                        fontSize:'15px'
                    }
                },
                invalid: {
                    color: 'red',
                    iconColor: '#fa755a '
                }
            }
        }
        });
    </script>
@endpush
    <style>
        div.pac-container {
            z-index: 99999999999 !important;
        }
        .border-not-active {
            border: 2px solid #e80000;
        }
        .opacity-75-i {
            opacity: 75%;
        }
    </style>

<!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">


        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid mb-10" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <div class="card card-flush border-0">
                    <!--begin::Body-->
                    <div class="card-body py-2">
                        <!--begin::Row-->
                        <div class="row gx-9">
                            <div class="d-flex justify-content-center align-items-center bg-white pt-2">
                                <p class="fw-bolder mx-3">{{ __('branches-available-to-add') }}</p>
                                <p class="badge badge-light-success">{{$available_branches}}</p>
                            </div>
                            @if($available_branches > 0)
                            <div class="row gx-9 d-flex justify-content-center align-items-center">
                                <a href="{{route('restaurant.create-branch')}}" class="fs-6 text-700 fw-bolder text-center p-3 rounded fs-25" >+ {{ __('add-new-branch') }}</a>
                            </div>
                            @endif
                        </div>
                        <!--end::Row-->
                    </div>




                    @if($available_branches == 0&&$branches->count())
                    <div class="alert alert-warning text-center mx-2">
                        <p>{{ __('You can add new branches from services') }}</p>
                        <a href="{{ route('restaurant.service') }}">
                            <button type="button" class="btn btn-khardl btn-sm">{{ __('View services') }}</button>
                        </a>
                    </div>
                    @endif
                    <!--end::Body-->
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
        <!--begin::Post-->


        @forelse ($branches as $branch)
            <div class="post d-flex flex-column-fluid my-5" id="kt_post">
                <!--begin::Container-->
                <div id="kt_content_container " class="container-xxl ">
                    <div class="card card-flush border-0 h-md-100">
                        <!--begin::Body-->
                        <div class="card-body py-9 {{$branch->deleted_at ? 'border-not-active ':''}}">
                            <!--begin::Row-->
                            <div class="row gx-9">
                                <!--begin::Col-->

                                <div class="col-sm-6 branches-google-maps {{$branch->deleted_at ? 'opacity-75-i':''}}" >
                                    {{-- @if(!$branch->deleted_at)
                                    <input id="pac-input{{ $branch->id }}" class="form-control" type="text" placeholder="{{ __('search-for-place')}}"  style="display: none;" value="{{$branch->address}}">
                                    @endif --}}
                                    <div id="map-autocomplete-card{{ $branch->id }}"></div>

                                    <div class="map-container" data-branch-id="{{ $branch->id }}">
                                        <div class="card card-flush border-0 card-map">
                                            <!--begin::Body-->
                                            <div class="card-body py-2">
                                                <div id="map{{ $branch->id }}" class="google_map" >
                                                    <div class="map-overlay">
                                                        <div class="overlay-text">
                                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 512.19 512.19" style="enable-background:new 0 0 512.19 512.19;" xml:space="preserve" width="48" height="48">
                                                                <g>
                                                                    <circle cx="256.095" cy="256.095" r="85.333" />
                                                                    <path d="M496.543,201.034C463.455,147.146,388.191,56.735,256.095,56.735S48.735,147.146,15.647,201.034   c-20.862,33.743-20.862,76.379,0,110.123c33.088,53.888,108.352,144.299,240.448,144.299s207.36-90.411,240.448-144.299   C517.405,277.413,517.405,234.777,496.543,201.034z M256.095,384.095c-70.692,0-128-57.308-128-128s57.308-128,128-128   s128,57.308,128,128C384.024,326.758,326.758,384.024,256.095,384.095z" />
                                                                </g>
                                                            </svg>
                                                        </div>
                                                        <img src="{{ global_asset("images/blured_map.png") }}" class="img-fluid" alt="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>




                                        @if(!$branch->deleted_at)
                                        <form action="{{ route('restaurant.update-branch-location', ['id' => $branch->id]) }}" method="POST">
                                            @csrf
                                            <input type="hidden" id="lat{{ $branch->id }}" name="lat" value="{{ $branch->lat }}" />
                                            <input type="hidden" id="lng{{ $branch->id }}" name="lng" value="{{ $branch->lng }}" />
                                            <input type="hidden" id="location{{ $branch->id }}" name="location" value="{{ $branch->address }}" />
                                            <button style="display: none;" id="save-location{{ $branch->id }}" type="submit" class="btn btn-khardl my-4 w-100">{{ __('save-location')}}</button>
                                        </form>
                                        @endif
                                    </div>
                                </div>


                                </style>


                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-sm-6">
                                    <!--begin::Wrapper-->
                                    <div class="d-flex flex-column h-100 ">
                                        <!--begin::Header-->
                                        <div class="mb-7">
                                            <!--begin::Headin-->
                                            @if($branch->deleted_at)
                                            <span class="fs-7 fw-bolder me-2 d-block lh-1 pb-1 badge badge-warning text-capitalize mb-3">
                                                {{ __('This branch has been previously archived') }}<br>
                                                <small> {{ __('You will not be able to activate this branch or receive orders until after purchase') }}</small>
                                            </span>
                                            @elseif (!$branch->active)
                                            <span class="fs-7 fw-bolder me-2 d-block lh-1 pb-1 badge badge-warning text-capitalize mb-3">
                                                {{ __('This branch is inactive') }}<br>
                                                <small> {{ __('You will not be able to receive orders from this branch') }}</small>
                                            </span>
                                            @endif
                                            <div class="d-flex flex-stack mb-6 {{$branch->deleted_at ? 'opacity-75-i':''}}">
                                                <!--begin::Title-->
                                                <div class="flex-shrink-0 ">
                                                    @if ($branch->is_primary)
                                                    <span class="fs-7 fw-bolder me-2 d-block lh-1 pb-1 badge badge-light-khardl text-capitalize">{{ __('primary-branch') }}</span>
                                                    @endif
                                                    <span class="text-gray-800 fs-1 fw-bolder text-capitalize">{{ $branch->name }}</span>
                                                    <p>
                                                        @if(!$branch->deleted_at)
                                                        <a data-bs-toggle="modal" data-bs-target="#modalTime{{ $branch->id }}" class="text-light bg-dark p-1 rounded cursor-pointer">{{$branch->phone ?? ''}}
                                                            <svg class="feather feather-edit" fill="none" height="16" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24" width="24" xmlns="http://www.w3.org/2000/svg">
                                                                <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7" />
                                                                <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z" /></svg></a>
                                                        @else
                                                        <span class="text-light bg-dark p-1 rounded cursor-pointer">{{$branch->phone ?? ''}}</span>
                                                        @endif

                                                    </p>
                                                    <style>
                                                        .cursor-pointer:hover {
                                                            cursor: pointer;
                                                        }

                                                    </style>


                                                </div>
                                                <div class="flex-shrink-0 me-5 ">
                                                    @if($branch->deleted_at)

                                                    <div class="d-flex justify-content-center mt-1">
                                                        <a data-bs-toggle="modal" data-bs-target="#kt_modal_new_target_renew" onclick="changeBranch({{$branch->id}});" class="btn btn-khardl text-center opacity-100 "> <span class=" text-white fw-bolder">{{__('Purchase')}} <i class="fas fa-money-bill-wave-alt text-white"></i></span></a>
                                                    </div>
                                                    @elseif(!$branch->active)

                                                    <div class="d-flex justify-content-center mt-1">
                                                        <a href="{{route('restaurant.update-branch-status',['id'=>$branch->id])}}" class="btn btn-khardl text-center">{{__('Activate')}} <i class="fa  fa-play text-white m-2"></i></a>
                                                    </div>

                                                    @endif
                                                </div>
                                                <!--end::Title-->
                                            </div>

                                            <!--end::Modal body-->

                                            <!--end::Heading-->
                                            <!--begin::Items-->
                                            <div class="d-flex align-items-center flex-wrap d-grid gap-2">
                                                <!--begin::Item-->
                                                <div class="d-flex align-items-center">
                                                    <!--begin::Symbol-->
                                                    <div class="symbol symbol-30px symbol-circle me-3">
                                                        <span class="symbol-label bg-khardl">
                                                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs042.svg-->
                                                            <span class="svg-icon svg-icon-5 svg-icon-white">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path d="M18 21.6C16.6 20.4 9.1 20.3 6.3 21.2C5.7 21.4 5.1 21.2 4.7 20.8L2 18C4.2 15.8 10.8 15.1 15.8 15.8C16.2 18.3 17 20.5 18 21.6ZM18.8 2.8C18.4 2.4 17.8 2.20001 17.2 2.40001C14.4 3.30001 6.9 3.2 5.5 2C6.8 3.3 7.4 5.5 7.7 7.7C9 7.9 10.3 8 11.7 8C15.8 8 19.8 7.2 21.5 5.5L18.8 2.8Z" fill="currentColor" />
                                                                    <path opacity="0.3" d="M21.2 17.3C21.4 17.9 21.2 18.5 20.8 18.9L18 21.6C15.8 19.4 15.1 12.8 15.8 7.8C18.3 7.4 20.4 6.70001 21.5 5.60001C20.4 7.00001 20.2 14.5 21.2 17.3ZM8 11.7C8 9 7.7 4.2 5.5 2L2.8 4.8C2.4 5.2 2.2 5.80001 2.4 6.40001C2.7 7.40001 3.00001 9.2 3.10001 11.7C3.10001 15.5 2.40001 17.6 2.10001 18C3.20001 16.9 5.3 16.2 7.8 15.8C8 14.2 8 12.7 8 11.7Z" fill="currentColor" />
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </div>
                                                    <!--end::Symbol-->
                                                    <!--begin::Info-->
                                                    <div class="m-0 position-relative {{$branch->deleted_at?'opacity-75-i':''}}">
                                                        <span class="fw-bold text-gray-400 d-block fs-8">{{ __('revenue') }}</span>
                                                        @if(isset($branch->total_revenues['number_formatted']))
                                                        <div class="revenues-container">
                                                            <span class="fw-bold d-block fs-8 branch_revenues fade">{{ $branch->total_revenues['number'] }} {{ __('SAR') }}</span>
                                                            <span class="fw-bolder text-gray-800 fs-7 branch_revenues_formatted">{{ $branch->total_revenues['number_formatted'] }} {{ __('SAR') }}</span>
                                                        </div>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    <!--end::Info-->
                                                </div>
                                                <!--end::Item-->
                                            </div>
                                            <!--end::Items-->
                                        </div>
                                        <!--end::Header-->
                                        @if(!$branch->deleted_at)
                                        <!--begin::Body-->
                                        <div class="mb-6">
                                            <!--begin::Text-->
                                            <!--end::Text-->
                                            <!--begin::Stats-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Stat-->
                                                <div class="border border-gray-300 border-dashed rounded min-w-100px w-100 py-2 px-4 me-6 mb-3">
                                                    <a href="{{ route('restaurant.get-category', ['id' => \App\Models\Tenant\Category::where('branch_id', $branch->id)?->first()?->id ?? -1, 'branchId' => $branch->id]) }}" class="fs-6 text-700 fw-bolder">{{ __('edit-menu') }}</a>
                                                </div>
                                            </div>
                                            <!--end::Stats-->
                                            <!--begin::Stats-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Stat-->
                                                <div class="border border-gray-300 border-dashed rounded min-w-100px w-100 py-2 px-4 me-6 mb-3">
                                                    <a href="{{ route('restaurant.workers', ['branchId' => $branch->id]) }}" class="fs-6 text-700 fw-bolder">{{ __('staff-modification') }}</a>
                                                </div>

                                                <!--end::Stat-->
                                                <!--begin::Stat-->
                                                <div class="border border-gray-300 border-dashed rounded min-w-100px w-100 py-2 px-4 mb-3">
                                                    <a href="#" class="fs-6 text-700 fw-bolder" data-bs-toggle="modal" data-bs-target="#kt_modal_new_target{{ $branch->id }}">{{ __('opening-the-branch') }}
                                                        <i class="fas fa-clock"></i></a>
                                                </div>

                                                <!--end::Stat-->
                                            </div>

                                            <!--end::Stats-->
                                        </div>
                                        <!--end::Body-->
                                        <!--begin::Footer-->

                                        <div class="d-flex align-items-center">
                                            @if ($branch->is_primary)
                                            <div class="border border-gray-300 border-dashed rounded min-w-100px w-100 py-2 px-4 me-6 mb-3">
                                                <a href="{{route('restaurants.site_editor')}}" target="_blank" class="fs-6 text-700 fw-bolder">{{ __('edit-site') }}</a>
                                            </div>
                                            @endif
                                            <div class="border border-gray-300 border-dashed rounded min-w-100px w-100 py-2 px-4 mb-3">
                                                <a href="{{route('restaurant.settings.branch',['branch'=>$branch->id])}}" class="fs-6 text-700 fw-bolder">{{ __('settings') }}</a>
                                            </div>
                                            <div>
                                            </div>
                                        </div>
                                        @endif
                                        <!--end::Footer-->
                                    </div>
                                    <!--end::Wrapper-->
                                </div>
                                <div class="modal fade" id="kt_modal_new_target_renew" tabindex="-1" aria-hidden="true">
                                    <!--begin::Modal dialog-->
                                    <div class="modal-dialog modal-dialog-centered mw-650px">
                                        <!--begin::Modal content-->
                                        <div class="modal-content rounded p-15">
                                            <form action="{{route('tap.renewBranch')}}" id="renewBranch" method="POST">
                                                @csrf
                                                <input type="hidden" name="token_id" id="token_id" value="">
                                                <input type="hidden" id="currentBranch" value="" name="currentBranch">

                                                <div class="modal-header pb-0 border-0  d-flex justify-content-center">
                                                    <h5 class="modal-title text-center">
                                                        {{__('Renewing the branch subscription period')}} ({{$branch_cost}}) {{__('SAR')}}
                                                    </h5>
                                                    <br>

                                                </div>
                                                <p class="text-center text-khardl">
                                                    ({{$branch_left}})
                                                </p>
                                                <div id="root"></div>
                                                <p id="msg"></p>

                                                <button id="tap-btn" type="submit" onclick="submitPayment(event)" class="btn btn-khardl text-white ">

                                                    <span class="indicator-label"> {{__("purchase")}} ✔️</span>
                                                    <span class="indicator-progress" id="waiting-item">{{__('please-wait')}}
                                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                </button>
                                            </form>

                                        </div>

                                    </div>



                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Body-->
                    </div>
                </div>
                <!--end::Container-->
            </div>


            <div class="modal fade" id="modalTime{{ $branch->id }}" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content rounded">
                        <!--begin::Modal header-->
                        <div class="modal-header pb-0 border-0 justify-content-end">
                            <!--begin::Close-->
                            <div class="btn btn-sm btn-icon btn-active-color-khardl" data-bs-dismiss="modal">
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
                        <div class="modal-body scroll-y pt-0 pb-15">
                            <!--begin:Form-->
                            @if(!$branch->deleted_at)
                            <form id="modalTimeForm{{ $branch->id }}" class="form" action="{{ route('restaurant.update-branch-details', ['id' => $branch->id]) }}" method="POST" id="myForm">
                                @csrf
                                @method('PUT')
                                <div class="mb-13 text-center">
                                    <!--begin::Title-->
                                    <label class="form-check-label" for="nameText">{{__('Name')}}</label>
                                    <input class="form-control form-control-solid" name="name" id="nameText" required value="{{ $branch->name }}">
                                    <!--end::Title-->
                                </div>
                                <!--end::Head-->
                                <!--begin::Heading-->
                                <div class="mb-13 text-center">
                                    <!--begin::Title-->
                                    <label class="form-check-label" for="phoneText">{{__('phone')}}</label>
                                    <input class="form-control form-control-solid" name="phone" id="phoneText" required value="{{ $branch->phone }}">
                                    <!--end::Title-->
                                </div>
                                <!--end::Heading-->

                                <!--begin::Heading-->
                                <div class="mb-13 text-center">
                                    <!--begin::Title-->
                                    <label class="form-check-label" for="cityText">{{__('city')}}</label>
                                    <input class="form-control form-control-solid" name="city" id="cityText"  value="{{ $branch->city }}">
                                    <!--end::Title-->
                                </div>
                                <!--end::Heading-->


                                <!--begin::Heading-->
                                <div class="mb-13 text-center">
                                    <!--begin::Title-->
                                    <label class="form-check-label" for="neighborhoodText">{{__('neighborhood')}}</label>
                                    <input class="form-control form-control-solid" name="neighborhood" id="neighborhoodText"  value="{{ $branch->neighborhood }}">
                                    <!--end::Title-->
                                </div>
                                <!--end::Heading-->


                                <!--begin::Actions-->
                                <div class="text-center">
                                    <button type="submit" id="kt_modal_new_target_submit" class="btn btn-khardl">
                                        <span class="indicator-label">{{ __('submit') }}</span>
                                        <span class="indicator-progress">{{ __('please-wait') }}
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                                <!--end::Actions-->
                            </form>
                            @endif
                            <!--end:Form-->
                        </div>
                        <!--end::Modal body-->
                    </div>
                    <!--end::Modal content-->
                </div>
                <!--end::Modal dialog-->
            </div>
            <!--end::Modal - New Target-->


            <div class="modal fade" id="kt_modal_new_target{{ $branch->id }}" tabindex="-1" aria-hidden="true">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="modal-content rounded">
                        <!--begin::Modal header-->
                        <div class="modal-header pb-0 border-0 justify-content-end">
                            <!--begin::Close-->
                            <div class="btn btn-sm btn-icon btn-active-color-khardl" data-bs-dismiss="modal">
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
                        <div class="modal-body scroll-y pt-0 pb-15">
                            <!--begin:Form-->
                            <form id="kt_modal_new_target_form{{ $branch->id }}" class="form" action="{{ route('restaurant.update-branch', ['id' => $branch->id]) }}" method="POST" id="myForm">
                                @csrf
                                @method('PUT')
                                <!--begin::Heading-->
                                <div class="mb-13 text-center">
                                    <!--begin::Title-->
                                    <h1 class="mb-3">{{ __('branch-opening-time') }}</h1>
                                    <!--end::Title-->
                                </div>
                                <!--end::Heading-->


                                <!--begin::Input group-->
                                <div class="row g-9 mb-8">

                                    <div class="col-md-12 fv-row">
                                        <div class="position-relative d-flex align-items-center">
                                            <div class="card-body pt-0">
                                                <p class="form-label required fs-6 fw-bold mb-2">{{__("time")}}</p>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="existed_hours_option" id="existed_normalChoice" value="normal" @if($branch->existed_hours_option == 'normal') checked @endif>
                                                    <label class="form-check-label" for="existed_normalChoice">{{ __('choose-time-for-all-days') }}</label>
                                                </div>

                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="existed_hours_option" id="existed_customChoice" value="custom" @if($branch->existed_hours_option == 'custom') checked @endif>
                                                    <label class="form-check-label" for="existed_customChoice">{{ __('choose-time-for-custom-days') }}</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- START: existed Hours input for normal choice -->
                                    <div id="existed_normalChoiceSection_{{$branch->id}}">

                                        <small class="d-flex m-4">{{ __('time-in-24-h') }}</small>
                                        <div class="d-flex justify-content-between w-100">
                                            <div class="d-flex justify-content-between align-items-center w-50 mx-5 gap-1">
                                                <label for="existed_normal_from">{{ __('from') }} </label>
                                                <input type="text" class="form-control form-control-solid time-24 from" name="existed_normal_from" id="existed_normal_from_{{$branch->id}}" value="{{$branch->saturday_open ?? "09:00"}}" />
                                            </div>

                                            <div class="d-flex justify-content-between align-items-center w-50 mx-5 gap-1">
                                                <label for="existed_normal_to">{{ __('to') }} </label>
                                                <input type="text" class="form-control form-control-solid time-24 to" name="existed_normal_to" id="existed_normal_to_{{$branch->id}}" value="{{$branch->saturday_close ?? "20:00"}}" />
                                            </div>
                                        </div>


                                    </div>
                                    <!--begin:: existed Hours input for normal choice-->

                                    <!--begin::Col-->
                                    <div class="col-md-12 fv-row" id="existed_customChoiceTabs_{{$branch->id}}">
                                        <small class="d-flex m-4">{{ __('time-in-24-h') }}</small>

                                        <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6 d-flex justify-content-center">

                                            @foreach([
                                            'Sunday',
                                            'Monday',
                                            'Tuesday',
                                            'Wednesday',
                                            'Thursday',
                                            'Friday',
                                            'Saturday'
                                            ] as $idx => $weekDay)
                                            <li class="nav-item">
                                                <a class="nav-link text-dark {{$idx == 0 ? 'active' : ''}}" data-bs-toggle="tab" href="#kt_tab_pane_{{$branch->id}}_{{$idx + 1}}">{{ __(strtolower($weekDay)) }}</a> </li>
                                            @endforeach

                                        </ul>

                                        <div class="tab-content" id="existed_customChoiceContent_{{$branch->id}}">

                                            @foreach([
                                            'sunday',
                                            'monday',
                                            'tuesday',
                                            'wednesday',
                                            'thursday',
                                            'friday',
                                            'saturday'
                                            ] as $idx => $weekDay)
                                            <div class="tab-pane fade show {{$idx == 0 ? 'active' : ''}}" id="kt_tab_pane_{{$branch->id}}_{{$idx+1}}" role="tabpanel">
                                                <div class=" d-flex justify-content-between w-100">
                                                    <div class="d-flex justify-content-between align-items-center w-50 mx-5 gap-1">
                                                        <label>{{ __('from') }} </label>
                                                        <input type="text" value="{{ $branch->{$weekDay . '_open'} ? \Carbon\Carbon::parse($branch->{$weekDay . '_open'})->format('H:i') : '' }}" class="form-control form-control-solid time-24 from" name="{{$weekDay . '_open'}}" required />
                                                    </div>

                                                    <div class="d-flex justify-content-between align-items-center w-50 mx-5 gap-1">
                                                        <label>{{ __('to') }} </label>
                                                        <input type="text" value="{{ $branch->{$weekDay . '_close'} ? \Carbon\Carbon::parse($branch->{$weekDay . '_close'})->format('H:i') : '' }}" class="form-control form-control-solid time-24 to" name="{{$weekDay . '_close'}}" required />
                                                    </div>
                                                </div>

                                                <div class="row fv-row my-7">
                                                    <div class="form-check form-check-custom form-check-solid mb-2 d-flex justify-content-center">
                                                        <input class="form-check-input" name="{{$weekDay . '_closed'}}" value="1" type="checkbox" @if($branch->{$weekDay . '_closed'}) checked @endif id="{{$weekDay . '_closed'}}"/>
                                                        <label class="form-check-label text-gray-700 fw-bolder" for="{{$weekDay . '_closed'}}">{{ __('the-shop-is-closed-today') }}</label>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach


                                        </div>
                                    </div>
                                    <!--end::Col-->



                                </div>
                                <!--end::Input group-->


                                <!--begin::Actions-->
                                <div class="text-center">
                                    <button type="submit" id="kt_modal_new_target_submit" class="btn btn-khardl">
                                        <span class="indicator-label">{{ __('submit') }}</span>
                                        <span class="indicator-progress">{{ __('please-wait') }}
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                </div>
                                <!--end::Actions-->
                            </form>
                            <!--end:Form-->
                        </div>
                        <!--end::Modal body-->
                    </div>
                    <!--end::Modal content-->
                </div>
                <!--end::Modal dialog-->
            </div>
            <!--end::Modal - New Target-->
        @empty
            @if ($available_branches>0)
                <div class="post d-flex flex-column-fluid mb-10" id="kt_post">
                    <div id="kt_content_container" class="container-xxl">
                        <div class="card card-flush border-0 h-md-100">
                            <div class="card-body py-15">
                                <div class="row gx-9 h-100 p-15">
                                    <div class="d-flex justify-content-center align-items-center bg-white pt-5">
                                        <p class="fw-bolder mx-3 text-warning fs-15">{{ __('add-your-primary-branch-by-clicking-on-the-button-bellow') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="post d-flex flex-column-fluid mb-10" id="kt_post">
                    <div id="kt_content_container" class="container-xxl">
                        <div class="card card-flush border-0 h-md-100">
                            <div class="card-body py-15">
                                <div class="row gx-9 h-100 p-15">
                                    <div class="alert alert-warning text-center">
                                        <h4>{{ __('You do not the availability to add new branch') }}</h4>
                                        <p>{{ __('You have to purchase new service') }}</p>
                                        <a href="{{ route('restaurant.service') }}">
                                            <button type="button" class="btn btn-khardl btn-sm">{{ __('View services') }}</button>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforelse


    </div>



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

@endsection
@section('js')


    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAzMlj17cdLKcXdS2BlKkl0d31zG04aj2E&v=weekly&libraries=places&loading=async&v=beta" ></script>



    <script>
        let normalChoiceSection = document.getElementById('normalChoiceSection');
        let customChoiceTabs = document.getElementById('customChoiceTabs');
        let customChoiceContent = document.getElementById('customChoiceContent');
        function setRequiredForCustomChoice(required) {
            let customInputs = customChoiceContent.querySelectorAll('input[type="text"]');
            customInputs.forEach(function (input) {
                input.required = required;
            });
        }
        function setRequiredForNormalChoice(required) {
            let customInputs = normalChoiceSection.querySelectorAll('input[type="text"]');
            customInputs.forEach(function (input) {
                input.required = required;
            });
        }
        if(document.querySelectorAll('input[name="hours_option"]').length > 0){
            // Hide/show sections based on the selected option
            document.querySelectorAll('input[name="hours_option"]').forEach(function (radio) {
                radio.addEventListener('change', function () {
                    if (this.value === 'normal') {
                        normalChoiceSection.style.display = 'block';
                        customChoiceTabs.style.display = 'none';
                        customChoiceContent.style.display = 'none';
                        setRequiredForNormalChoice(true);
                        setRequiredForCustomChoice(false);
                    } else if (this.value === 'custom') {
                        normalChoiceSection.style.display = 'none';
                        customChoiceTabs.style.display = 'block';
                        customChoiceContent.style.display = 'block';
                        setRequiredForNormalChoice(false);
                        setRequiredForCustomChoice(true);
                    }
                });
            });
            document.querySelector('input[name="hours_option"]:checked').dispatchEvent(new Event('change'));
        }


        @foreach($branches as $branch)

            function existed_setRequiredForCustomChoice(id, required) {
                let existed_customInputs = document.getElementById('existed_customChoiceContent_' + id).querySelectorAll('input[type="text"]');
                existed_customInputs.forEach(function (input) {
                    input.required = required;
                });
            }
            function existed_setRequiredForNormalChoice(id, required) {
                let existed_customInputs = document.getElementById('existed_normalChoiceSection_' + id).querySelectorAll('input[type="text"]');
                existed_customInputs.forEach(function (input) {
                    input.required = required;
                });
            }
            if(document.querySelectorAll('input[name="existed_hours_option"]').length > 0){
            // Hide/show sections based on the selected option
            document.querySelectorAll('input[name="existed_hours_option"]').forEach(function (radio) {
                radio.addEventListener('change', function () {
                    if (this.value === 'normal') {
                        document.getElementById('existed_normalChoiceSection_{{$branch->id}}').style.display = 'block';
                        document.getElementById('existed_customChoiceTabs_{{$branch->id}}').style.display = 'none';
                        document.getElementById('existed_customChoiceContent_{{$branch->id}}').style.display = 'none';
                        existed_setRequiredForNormalChoice({{$branch->id}}, true);
                        existed_setRequiredForCustomChoice({{$branch->id}}, false);
                    } else if (this.value === 'custom') {
                        document.getElementById('existed_normalChoiceSection_{{$branch->id}}').style.display = 'none';
                        document.getElementById('existed_customChoiceTabs_{{$branch->id}}').style.display = 'block';
                        document.getElementById('existed_customChoiceContent_{{$branch->id}}').style.display = 'block';
                        existed_setRequiredForNormalChoice({{$branch->id}}, false);
                        existed_setRequiredForCustomChoice({{$branch->id}}, true);
                    }
                });
            });
            document.querySelector('input[name="existed_hours_option"]:checked').dispatchEvent(new Event('change'));
        }


        @endforeach


    </script>

    @include('components.map')

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>

    <script>

        document.addEventListener("DOMContentLoaded", (event) => {
            // Initialize the timepicker with the existing value or default value

            flatpickr(".time-24", {
                enableTime: true,
                noCalendar: true,
                enableSeconds: false,
                dateFormat: "H:i",
                time_24hr: true,
                disableMobile: true,
                // @TODO: need to handle the validation of From to be before To time.
                onClose: function(selectedDates, dateStr, instance) {

                    return;


                    let $input = instance.input;

                    let $isFromTime = [...$input.classList].indexOf('from') > -1;

                    let $fromInput = $input.parentNode.parentNode.getElementsByTagName('input')[0];
                    let $toInput = $input.parentNode.parentNode.getElementsByTagName('input')[1];


                    let $time1InMinutesForTimeFrom = getTimeAsNumberOfMinutes($fromInput.value);
                    let $time1InMinutesForTimeTo = getTimeAsNumberOfMinutes($toInput.value);


                    if (parseInt($time1InMinutesForTimeFrom) > parseInt($time1InMinutesForTimeTo)) {
                        alert("{{__("Time from should be before to")}}");
                        $input.value = $($input).data('val')
                    }
                    else {
                        $($input).data('val', $input.value);
                    }

                }
            });


            // function getTimeAsNumberOfMinutes(time)
            // {
            //     let timeParts = time.split(":");
            //     return (timeParts[0] * 60) + timeParts[1];
            // }


            // $('.time-24').on('focusin', function (e) {
            //     console.log("tetw")
            //     $(this).data('valuee', $(this).val());
            //     e.target.value = $(this).data('val');
            // });

            // {{--$('.time-24').on('change', function (e) {--}}

            // {{--    e.preventDefault();--}}

            // {{--    let $isFromTime = [...e.target.classList].indexOf('from') > -1;--}}

            // {{--    let $fromInput = e.target.parentNode.parentNode.getElementsByTagName('input')[0];--}}
            // {{--    let $toInput = e.target.parentNode.parentNode.getElementsByTagName('input')[1];--}}

            // {{--    let $time1InMinutesForTimeFrom = getTimeAsNumberOfMinutes($fromInput.value);--}}
            // {{--    let $time1InMinutesForTimeTo = getTimeAsNumberOfMinutes($toInput.value);--}}

            // {{--    console.log("from: ", $fromInput.value, $time1InMinutesForTimeFrom)--}}
            // {{--    console.log("to: ", $toInput.value, $time1InMinutesForTimeTo)--}}

            // {{--    if (parseInt($time1InMinutesForTimeFrom) > parseInt($time1InMinutesForTimeTo)) {--}}
            // {{--        --}}{{--alert("{{__("Time from should be before to")}}");--}}
            // {{--            e.target.value = $(this).data('val')--}}
            // {{--    }--}}
            // {{--    else {--}}
            // {{--        $(this).data('val', $(this).val());--}}
            // {{--    }--}}
            // {{--})--}}

        });


    </script>





@endsection

