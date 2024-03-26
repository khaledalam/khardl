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

@endpush
@push('scripts')
    <script>
        function submitPayment(e,branch){
            e.preventDefault();
            document.getElementById('currenBranch').value = branch;
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
                <div class="card card-flush border-0 h-md-100">
                    <!--begin::Body-->
                    <div class="card-body py-2">
                        <!--begin::Row-->
                        <div class="row gx-9 h-100">
                            <div class="d-flex justify-content-center align-items-center bg-white pt-5">
                                <p class="fw-bolder mx-3">{{ __('branches-available-to-add') }}</p>
                                <p class="badge badge-light-success">{{$available_branches}}</p>
                            </div>
                            @if($available_branches > 0)
                            <div class="row gx-9 d-flex justify-content-center align-items-center">
                                <a href="#" class="fs-6 text-700 fw-bolder text-center p-15 rounded fs-25" data-bs-toggle="modal" data-bs-target="#kt_modal_new_bransh">+ {{ __('add-new-branch') }}</a>
                            </div>
                            @endif
                        </div>
                        <!--end::Row-->
                    </div>




                    @if($available_branches == 0&&$branches->count())
                    <div class="alert alert-warning text-center mx-4">
                        <p>{{ __('You can add new branches from services') }}</p>
                        <a href="{{ route('restaurant.service') }}">
                            <button type="button" class="btn btn-success btn-sm">{{ __('View services') }}</button>
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
            <div id="kt_content_container " class="container-xxl " >
                <div class="card card-flush border-0 h-md-100">
                    <!--begin::Body-->
                    <div class="card-body py-9 {{$branch->deleted_at ? 'border-not-active ':''}}" >
                        <!--begin::Row-->
                        <div class="row gx-9">
                            <!--begin::Col-->

                            <div class="col-sm-6 branches-google-maps {{$branch->deleted_at ? 'opacity-75-i':''}}">
                                @if(!$branch->deleted_at)
                                <input id="pac-input{{ $branch->id }}" class="form-control" type="text" placeholder="{{ __('search-for-place')}}" value="{{$branch->address}}">
                                @endif
                                <div id="map{{ $branch->id }}" class="google_map" ></div>
                                @if(!$branch->deleted_at)
                                <form action="{{ route('restaurant.update-branch-location', ['id' => $branch->id]) }}" method="POST">
                                        @csrf
                                        <input type="hidden" id="lat{{ $branch->id }}" name="lat" value="{{ $branch->lat }}" />
                                        <input type="hidden" id="lng{{ $branch->id }}" name="lng" value="{{ $branch->lng }}" />
                                        <input type="hidden" id="location{{ $branch->id }}" name="location" value="{{ $branch->address }}" />
                                        <button id="save-location{{ $branch->id }}" type="submit" class="btn btn-khardl my-4 w-100">{{ __('save-location')}}</button>
                                </form>
                                @endif
                            </div>

                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-sm-6">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column h-100 ">
                                    <!--begin::Header-->
                                    <div class="mb-7">
                                        <!--begin::Headin-->
                                        @if($branch->deleted_at)
                                            <span
                                                class="fs-7 fw-bolder me-2 d-block lh-1 pb-1 badge badge-warning text-capitalize mb-3">
                                                {{ __('This branch has been previously archived') }}<br>
                                                <small>  {{ __('You will not be able to activate this branch or receive orders until after purchase') }}</small>
                                            </span>
                                        @elseif (!$branch->active)
                                        <span
                                                class="fs-7 fw-bolder me-2 d-block lh-1 pb-1 badge badge-warning text-capitalize mb-3">
                                                {{ __('This branch is inactive') }}<br>
                                                <small>  {{ __('You will not be able to receive orders from this branch') }}</small>
                                            </span>
                                        @endif
                                        <div class="d-flex flex-stack mb-6 {{$branch->deleted_at ? 'opacity-75-i':''}}">
                                            <!--begin::Title-->
                                            <div class="flex-shrink-0 ">
                                                @if ($branch->is_primary)
                                                <span
                                                    class="fs-7 fw-bolder me-2 d-block lh-1 pb-1 badge badge-light-khardl text-capitalize">{{ __('primary-branch') }}</span>
                                            @endif
                                            <span
                                                class="text-gray-800 fs-1 fw-bolder text-capitalize">{{ $branch->name }}</span>
                                                <p > <a href="#" class="text-light bg-dark p-1 rounded">{{$branch->phone ?? ''}}</a> </p>


                                            </div>
                                            <div class="flex-shrink-0 me-5 ">
                                                @if($branch->deleted_at)

                                                <div class="d-flex justify-content-center mt-1">
                                                    <a  data-bs-toggle="modal" data-bs-target="#kt_modal_new_target_renew"
                                                class="btn btn-khardl text-center opacity-100 " > <span class=" text-white fw-bolder">{{__('Purchase')}} <i class="fas fa-money-bill-wave-alt text-white"></i></span></a>
                                                </div>
                                                @elseif(!$branch->active)

                                                    <div class="d-flex justify-content-center mt-1">
                                                        <a href="{{route('restaurant.update-branch-status',['id'=>$branch->id])}}"
                                                    class="btn btn-success text-center">{{__('Activate')}} <i class="fa  fa-play text-white m-2"></i></a>
                                                    </div>

                                                @endif
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                        <div class="modal fade" id="kt_modal_new_target_renew" tabindex="-1" aria-hidden="true">
                                            <!--begin::Modal dialog-->
                                            <div class="modal-dialog modal-dialog-centered mw-650px">
                                                <!--begin::Modal content-->
                                                <div class="modal-content rounded p-15">
                                                    <form action="{{route('tap.renewBranch')}}" id="renewBranch" method="POST">
                                                        @csrf
                                                    <input type="hidden" name="token_id" id="token_id" value="">
                                                    <input type="hidden"  id="currenBranch" value="" name="currenBranch">

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

                                                    <button id="tap-btn"  type="submit"   onclick="submitPayment(event,{{$branch->id}})" class="btn btn-khardl text-white ">

                                                        <span class="indicator-label"> {{__("purchase")}} ✔️</span>
                                                        <span class="indicator-progress" id="waiting-item">{{__('please-wait')}}
                                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                    </button>
                                                </form>

                                                </div>

                                                </div>



                                        </div>
                                            <!--end::Modal body-->

                                        <!--end::Heading-->
                                        <!--begin::Items-->
                                        <div class="d-flex align-items-center flex-wrap d-grid gap-2">
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-30px symbol-circle me-3">
                                                    <span class="symbol-label bg-success">
                                                        <!--begin::Svg Icon | path: icons/duotune/abstract/abs042.svg-->
                                                        <span class="svg-icon svg-icon-5 svg-icon-white">
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                width="24" height="24" viewBox="0 0 24 24"
                                                                fill="none">
                                                                <path
                                                                    d="M18 21.6C16.6 20.4 9.1 20.3 6.3 21.2C5.7 21.4 5.1 21.2 4.7 20.8L2 18C4.2 15.8 10.8 15.1 15.8 15.8C16.2 18.3 17 20.5 18 21.6ZM18.8 2.8C18.4 2.4 17.8 2.20001 17.2 2.40001C14.4 3.30001 6.9 3.2 5.5 2C6.8 3.3 7.4 5.5 7.7 7.7C9 7.9 10.3 8 11.7 8C15.8 8 19.8 7.2 21.5 5.5L18.8 2.8Z"
                                                                    fill="currentColor" />
                                                                <path opacity="0.3"
                                                                    d="M21.2 17.3C21.4 17.9 21.2 18.5 20.8 18.9L18 21.6C15.8 19.4 15.1 12.8 15.8 7.8C18.3 7.4 20.4 6.70001 21.5 5.60001C20.4 7.00001 20.2 14.5 21.2 17.3ZM8 11.7C8 9 7.7 4.2 5.5 2L2.8 4.8C2.4 5.2 2.2 5.80001 2.4 6.40001C2.7 7.40001 3.00001 9.2 3.10001 11.7C3.10001 15.5 2.40001 17.6 2.10001 18C3.20001 16.9 5.3 16.2 7.8 15.8C8 14.2 8 12.7 8 11.7Z"
                                                                    fill="currentColor" />
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
                                                <div
                                                    class="border border-gray-300 border-dashed rounded min-w-100px w-100 py-2 px-4 me-6 mb-3">
                                                    <a href="{{ route('restaurant.menu', ['branchId' => $branch->id]) }}" class="fs-6 text-700 fw-bolder">{{ __('edit-menu') }}</a>
                                                </div>
                                        </div>
                                        <!--end::Stats-->
                                        <!--begin::Stats-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Stat-->
                                                <div
                                                    class="border border-gray-300 border-dashed rounded min-w-100px w-100 py-2 px-4 me-6 mb-3">
                                                    <a href="{{ route('restaurant.workers', ['branchId' => $branch->id]) }}" class="fs-6 text-700 fw-bolder">{{ __('staff-modification') }}</a>
                                                </div>

                                            <!--end::Stat-->
                                            <!--begin::Stat-->
                                                <div
                                                    class="border border-gray-300 border-dashed rounded min-w-100px w-100 py-2 px-4 mb-3">
                                                    <a href="#" class="fs-6 text-700 fw-bolder"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#kt_modal_new_target{{ $branch->id }}">{{ __('opening-the-branch') }}
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
                                            <div
                                                class="border border-gray-300 border-dashed rounded min-w-100px w-100 py-2 px-4 me-6 mb-3">
                                                <a href="#" class="fs-6 text-700 fw-bolder">{{ __('edit-site') }}</a>
                                            </div>
                                        @endif
                                            <div
                                                class="border border-gray-300 border-dashed rounded min-w-100px w-100 py-2 px-4 mb-3">
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
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Body-->
                </div>
            </div>
            <!--end::Container-->
        </div>

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
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                                transform="rotate(-45 6 17.3137)" fill="currentColor" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                                fill="currentColor" />
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
                                    <label for="existed_normal_from">{{ __('from') }}  </label>
                                    <input type="text" class="form-control form-control-solid time-24"  name="existed_normal_from" id="existed_normal_from_{{$branch->id}}" value="{{$branch->saturday_open ?? "09:00"}}"  />
                                </div>

                                <div class="d-flex justify-content-between align-items-center w-50 mx-5 gap-1">
                                    <label for="existed_normal_to">{{ __('to') }}  </label>
                                    <input type="text" class="form-control form-control-solid time-24"  name="existed_normal_to" id="existed_normal_to_{{$branch->id}}" value="{{$branch->saturday_close ?? "20:00"}}"  />
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
                                        <a class="nav-link text-dark {{$idx == 0 ? 'active' : ''}}" data-bs-toggle="tab" href="#kt_tab_pane_{{$branch->id}}_{{$idx + 1}}">{{ __(strtolower($weekDay)) }}</a>                                    </li>
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
                                            <input type="text" value="{{ $branch->{$weekDay . '_open'} ? \Carbon\Carbon::parse($branch->{$weekDay . '_open'})->format('H:i') : '' }}" class="form-control form-control-solid time-24"  name="{{$weekDay . '_open'}}"  required />
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center w-50 mx-5 gap-1">
                                            <label>{{ __('to') }} </label>
                                            <input type="text" value="{{ $branch->{$weekDay . '_close'} ? \Carbon\Carbon::parse($branch->{$weekDay . '_close'})->format('H:i') : '' }}" class="form-control form-control-solid time-24"  name="{{$weekDay . '_close'}}"  required />
                                        </div>
                                    </div>

                                    <div class="row fv-row my-7">
                                        <div
                                            class="form-check form-check-custom form-check-solid mb-2 d-flex justify-content-center">
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
                                        <button type="button" class="btn btn-success btn-sm">{{ __('View services') }}</button>
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
    <!--end::Content-->

    <!--begin::Modal - New Target-->



    <!--begin::Modal - New Branshes-->
    <div class="modal fade" id="kt_modal_new_bransh" tabindex="-1" aria-hidden="true">
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
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                    fill="none">
                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1"
                        transform="rotate(-45 6 17.3137)" fill="currentColor" />
                    <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)"
                        fill="currentColor" />
                </svg>
            </span>
            <!--end::Svg Icon-->
        </div>
        <!--end::Close-->
    </div>
    <!--begin::Modal header-->
    <!--begin::Modal body-->
    @if($available_branches > 0)
    <div class="modal-body scroll-y pt-0 pb-15">
        <!--begin:Form-->
        <form id="kt_modal_new_bransh_form" class="form" action="{{ route('restaurant.add-branch') }}" method="POST" id="myForm">
            @csrf
            <!--begin::Heading-->
            <div class="mb-13 text-center d-flex justify-content-between align-items-center">
                <!--begin::Title-->
                <h1 class="mb-3">{{ __('add-new-branch') }}</h1>
                <!--end::Title-->
            </div>
            <!--end::Heading-->

            <!--begin::Input group-->
            <div class="row g-9 mb-8">
                <!--begin::Col-->
                <div class="col-md-12 fv-row">
                    <label class="required fs-6 fw-bold mb-2">{{ __('name-branch') }}</label>
                    <!--begin::Input-->
                    <div class="position-relative d-flex align-items-center">
                        <!--begin::Datepicker-->
                        <input value="{{ old('name') }}" required name="name" class="form-control form-control-solid " type="text" />
                        <!--end::Datepicker-->
                    </div>
                    <!--end::Input-->
                </div>
                <!--end::Col-->
                <div class="col-md-12 fv-row">
                    <label class="required fs-6 fw-bold mb-2">{{ __('phone') }}</label>
                    <!--begin::Input-->
                    <div class="position-relative d-flex align-items-center">
                        <!--begin::Datepicker-->
                        <input value="{{ old('phone') }}" required name="phone" class="form-control form-control-solid " type="text" />
                        <!--end::Datepicker-->
                    </div>
                    <!--end::Input-->
                </div>
                <!--begin::Col-->
                <div class="col-md-12 fv-row">
                    <label class="required fs-6 fw-bold mb-2">{{ __('location-branch') }}</label>
                    <input id="pac-input-new_branch" class="form-control" type="text" required placeholder="{{ __('search-for-place')}}" name="address">
                    <div style="width: 100%; height: 250px;" id="map-new_branch"></div>
                    <input type="hidden" id="lat-new_branch" name="lat-new_branch" />
                    <input type="hidden" id="lng-new_branch" name="lng-new_branch" />
                    <!--end::Input-->
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-md-12 fv-row">
                    <!--begin::Input-->
                    <div class="position-relative d-flex align-items-center">
                    <!--begin::Card body-->
                        <div class="card-body pt-0">
                            <!--begin::Select store template-->
                            <label for="kt_ecommerce_add_product_store_template" class="form-label required fs-6 fw-bold mb-2">{{ __('copy-menu') }}</label>
                            <!--end::Select store template-->
                            <!--begin::Select2-->
                            <select class="form-select mb-2" data-control="select2" data-hide-search="true" name="copy_menu" data-placeholder="{{ __('select-an-option') }}" id="kt_ecommerce_add_product_store_template">
                                <option value="None">{{ __('none') }}</option>
                                @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                                @endforeach
                            </select>
                            <!--end::Select2-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Input-->
                </div>
                <!--end::Col-->
                <div class="col-md-12 fv-row">
                    <div class="position-relative d-flex align-items-center">
                        <div class="card-body pt-0">
                            <p class="form-label required fs-6 fw-bold mb-2">{{__("time")}}</p>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="hours_option" id="normalChoice" value="normal" checked>
                                <label class="form-check-label" for="normalChoice">{{ __('choose-time-for-all-days') }}</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="hours_option" id="customChoice" value="custom">
                                <label class="form-check-label" for="customChoice">{{ __('choose-time-for-custom-days') }}</label>
                            </div>
                        </div>
                    </div>
                </div>
                 <!-- Hours input for normal choice -->
                 <div  id="normalChoiceSection">

                     <small class="d-flex m-4">{{ __('time-in-24-h') }}</small>

                     <div class=" d-flex justify-content-between w-100">
                        <div class="d-flex justify-content-between align-items-center w-50 mx-5 gap-1">
                            <label for="normal_from">{{ __('from') }}</label>
                            <input type="text" class="form-control form-control-solid time-24"  name="normal_from" id="normal_from" value="09:00"  />
                        </div>

                        <div class="d-flex justify-content-between align-items-center w-50 mx-5 gap-1">
                            <label for="normal_to">{{ __('to') }}  </label>
                            <input type="text" class="form-control form-control-solid time-24"  name="normal_to" id="normal_to" value="20:00"  />

                        </div>
                    </div>
                </div>
                <!--begin::Col-->
                <div class="col-md-12 fv-row"  id="customChoiceTabs">

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
                                <a class="nav-link text-dark {{$idx == 0 ? 'active' : ''}}" data-bs-toggle="tab" href="#kt_tab_pane_{{8+$idx}}">{{ __(strtolower($weekDay)) }}</a>
                            </li>
                        @endforeach
                    </ul>

                    <div class="tab-content" id="customChoiceContent"  >

                        @foreach([
                                   'Sunday',
                                   'Monday',
                                   'Tuesday',
                                   'Wednesday',
                                   'Thursday',
                                   'Friday',
                                   'Saturday'
                               ] as $idx => $weekDay)

                            <div class="tab-pane fade show {{$idx == 0 ? 'active' : ''}}" id="kt_tab_pane_{{$idx + 8}}" role="tabpanel">
                                <div class=" d-flex justify-content-between w-100">
                                    <div class="d-flex justify-content-between align-items-center w-50 mx-5 gap-1">
                                        <label for="{{strtolower($weekDay)}}_open">{{ __('from') }} </label>
                                        <input type="text" class="form-control form-control-solid time-24"  name="{{strtolower($weekDay)}}_open" id="{{strtolower($weekDay)}}_open"   />
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center w-50 mx-5 gap-1">
                                        <label for="{{strtolower($weekDay)}}_close">{{ __('to') }} </label>
                                        <input type="text" class="form-control form-control-solid time-24"  name="{{strtolower($weekDay)}}_close" id="{{strtolower($weekDay)}}_close"   />

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
                    <button type="reset" id="kt_modal_new_bransh_cancel"
                        class="btn btn-light me-3">{{ __('reset') }}</button>
                    <button type="submit" id="kt_modal_new_bransh_submit" class="btn btn-khardl">
                        <span class="indicator-label">{{ __('add-branch') }}</span>
                        <span class="indicator-progress">{{ __('please-wait') }}
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                </div>

            <!--end::Actions-->
        </form>
        <!--end:Form-->
    </div>
    @endif

    <!--end::Modal body-->
    </div>
    <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
    </div>
    <!--end::Modal - New Bransh-->




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


    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAzMlj17cdLKcXdS2BlKkl0d31zG04aj2E&libraries=places"></script>

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



        // Initialize based on the default selected option

        document.addEventListener("DOMContentLoaded", (event) => {
            let maps = {}; // Store maps in an object
            let markers = {}; // Store markers in an object

            function initializeMap(branchId, lat, lng,viewOnly = false) {
                const latLng = new google.maps.LatLng(lat, lng);

                const map = new google.maps.Map(document.getElementById('map' + branchId), {
                    center: latLng,
                    zoom: 8,
                });
                if(!viewOnly){
                    const input = document.getElementById("pac-input" + branchId);

                    const options = {
                        fields: ["formatted_address", "geometry", "name"],
                        strictBounds: false,
                    };
                    const autocomplete = new google.maps.places.Autocomplete(input, options);
                    autocomplete.bindTo("bounds", map);

                    const marker = new google.maps.Marker({
                        position: latLng,
                        map: map,
                        draggable: true,
                    });

                    markers[branchId] = marker; // Store the marker for this branch
                    maps[branchId] = map; // Store the map for this branch

                    google.maps.event.addListener(marker, 'dragend', function () {
                        updateLocationInput(marker.getPosition(), branchId);
                    });

                    // Add a click event listener to the map
                    google.maps.event.addListener(map, 'click', function (event) {
                        marker.setPosition(event.latLng);
                        updateLocationInput(event.latLng, branchId);
                    });
                    autocomplete.addListener("place_changed", () => {
                        console.log('change location')
                        // infowindow.close();
                        marker.setVisible(false);

                        const place = autocomplete.getPlace();

                        if (!place.geometry || !place.geometry.location) {
                            // User entered the name of a Place that was not suggested and
                            // pressed the Enter key, or the Place Details request failed.
                            window.alert("No details available for input: '" + place.name + "'");
                            return;
                        }
                        const lat = place.geometry.location.lat();
                        const lng = place.geometry.location.lng();
                        selectedPlacePosition = new google.maps.LatLng(lat, lng);
                        updateLocationInput(selectedPlacePosition, branchId);
                        // If the place has a geometry, then present it on a map.
                        if (place.geometry.viewport) {
                            map.fitBounds(place.geometry.viewport);
                        } else {
                            map.setCenter(place.geometry.location);
                            map.setZoom(17);
                        }

                        marker.setPosition(place.geometry.location);
                        marker.setVisible(true);
                        // infowindow.open(map, marker);
                    });

                }

            }

            async function convertToAddress(lat, lng){

                return await fetch(
                    `https://maps.googleapis.com/maps/api/geocode/json?latlng=${lat},${lng}&key=AIzaSyCFkagJ1zc4jW9N3lRNlIyAIJJcNpOwecE`
                )
                    .then(async (res) => {
                        const geocode = await res.json();
                        return geocode?.results[0]?.formatted_address || geocode?.plus_code?.compound_code || `${lat},${lng}`;
                    });
            }

            async function updateLocationInput(latLng, branchId) {

                const latInput = document.getElementById('lat' + branchId);
                const lngInput = document.getElementById('lng' + branchId);
                latInput.value = latLng.lat();
                lngInput.value = latLng.lng();

                const addressFromLatLng = await convertToAddress(latLng.lat(), latLng.lng());

                const locationInput = document.getElementById('location' + branchId);

                if (locationInput) {
                    locationInput.value = addressFromLatLng;
                }

                const locationInputBranch = document.getElementById('pac-input' + branchId);


                if (locationInputBranch) {
                    locationInputBranch.value = addressFromLatLng;
                }
            }

            function updateLocation(branchId) {
                const marker = markers[branchId];
                const latInput = document.getElementById('lat' + branchId);
                const lngInput = document.getElementById('lng' + branchId);
                const lat = parseFloat(latInput.value);
                const lng = parseFloat(lngInput.value);

                if (!isNaN(lat) && !isNaN(lng)) {
                    const latLng = new google.maps.LatLng(lat, lng);
                    marker.setPosition(latLng);
                    maps[branchId].setCenter(latLng);

                    $.ajax({
                        url: '/branches/update-location/' + branchId,
                        method: 'POST',
                        data: {
                            lat: lat,
                            lng: lng,
                        },
                        success: function (response) {
                            console.log('Location updated successfully:');
                        },
                        error: function (error) {
                            console.error('Error updating location:', error);
                        },
                    });
                }
            }


            // Initialize the maps for each branch
            @foreach ($branches as $branch)
                @if($branch->deleted_at)
                initializeMap({{ $branch->id }}, {{ $branch->lat }}, {{ $branch->lng }},true);
                @else
                initializeMap({{ $branch->id }}, {{ $branch->lat }}, {{ $branch->lng }});

                @endif
            @endforeach


            if (document.getElementById('pac-input-new_branch')) {

                // New branch popup
                const centerCoords = {
                    lat: 24.7136,
                    lng: 46.6753,
                    address: '8779 Street Number 74, Al Olaya, 2593, Riyadh 12214, Saudi Arabia'
                }; // Default center coordinates
                initializeMap('-new_branch', centerCoords?.lat, centerCoords?.lng);

                document.getElementById('lat-new_branch').value = centerCoords.lat;
                document.getElementById('lng-new_branch').value = centerCoords.lat;
                document.getElementById('pac-input-new_branch').value = centerCoords.address;

                google.maps.event.addListener(maps['-new_branch'], 'click', function (event) {

                    // If a marker exists, remove it
                    if (markers['-new_branch']) {
                        markers['-new_branch'].setMap(null);
                    }

                    // Create a new marker at the clicked location
                    markers['-new_branch'] = new google.maps.Marker({
                        map: maps['-new_branch'],
                        position: event.latLng,
                        draggable: true,
                    });

                    // document.getElementById('pac-input-new_branch').value = markers['-new_branch'].position.lat() + ' ' + markers['-new_branch'].position.lng();

                    const latnew_branch = document.getElementById('lat-new_branch');
                    const lngnew_branch = document.getElementById('lng-new_branch');

                    // Update the hidden input with the clicked location's latitude and longitude
                    latnew_branch.value = `${event.latLng.lat()}`;
                    lngnew_branch.value = `${event.latLng.lng()}`;
                });
            }


            function updateTimeInput() {
                var timeInput = document.getElementById("timeInput");
                var timeValue = timeInput.value.split(":");
                var hours = parseInt(timeValue[0], 10);

                if (hours < 10) {
                    timeInput.value = "0" + hours + ":" + timeValue[1];
                }
            }

        });


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
                disableMobile: true
            });
        });
    </script>


@endsection

