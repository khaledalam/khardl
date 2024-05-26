@extends('layouts.restaurant-sidebar')

@section('title', __('branches'))

@section('content')
@push("styles")

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>


<style>
    .modal{
        z-index: 20;   
    }
    .modal-backdrop{
        z-index: 10;        
    }​
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
    <div class="text-center">
        <div class=" text-center ">
            <!--begin::Title-->
            <h1 class="mb-3 text-center">{{ __('add-new-branch') }}</h1>
            <!--end::Title-->
        </div>
    </div>
    <!--end::Content-->
         <div class="card container" style="width: 800px">
            
            <div class=" card-header border-0">
                <!--begin::Body-->
                <div class="card-body py-2">
                    <!--begin::Row-->
                    <div class="row gx-9">
                        <div class="d-flex justify-content-center align-items-center bg-white pt-2">
                            <p class="fw-bolder mx-3">{{ __('branches-available-to-add') }}</p>
                            <p class="badge badge-light-success">{{$available_branches}}</p>
                        </div>
                      
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
                <div class="card-body  scroll-y p-5 pb-15">
                    <!--begin:Form-->
                    <form id="kt_modal_new_bransh_form" class="form" action="{{ route('restaurant.add-branch') }}" method="POST" id="myForm">
                        @csrf
                        <!--begin::Heading-->
                       
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
                            <!--end::Col-->
                            <!--begin::Col-->

                            <div class="col-md-12 fv-row" >
                                
                                <div id="map-autocomplete-card-new_branch" style="width: 80%;float: left;"></div>
                                <label class="required fs-6 fw-bold mb-2">{{ __('location-branch') }}</label>
{{--                                 <input id="pac-input-new_branch" class="form-control" type="hidden" placeholder="{{ __('search-for-place')}}" name="address">--}}
                                <div style="width: 100%; height: 250px;" id="map-new_branch"></div>
                                <input type="hidden" id="lat-new_branch" name="lat-new_branch" />
                                <input type="hidden" id="lng-new_branch" name="lng-new_branch" />
                                <input type="hidden" id="location-new_branch" name="location" />
                                <!--end::Input-->
                            </div>
                            <!--end::Col-->
                            <!--end::Col-->
                            <div class="col-md-12 fv-row">
                                <label class="fs-6 fw-bold mb-2">{{ __('city') }}</label>
                                <!--begin::Input-->
                                <div class="position-relative d-flex align-items-center">
                                    <!--begin::Datepicker-->
                                    <input value="{{ old('city') }}" required name="city" class="form-control form-control-solid " type="text" />
                                    <!--end::Datepicker-->
                                </div>
                                <!--end::Input-->
                            </div>
                            <!--end::Col-->
                            <!--end::Col-->
                            <div class="col-md-12 fv-row">
                                <label class="fs-6 fw-bold mb-2">{{ __('neighborhood') }}</label>
                                <!--begin::Input-->
                                <div class="position-relative d-flex align-items-center">
                                    <!--begin::Datepicker-->
                                    <input value="{{ old('neighborhood') }}" name="neighborhood" class="form-control form-control-solid " type="text" />
                                    <!--end::Datepicker-->
                                </div>
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
                                        <input type="text" class="form-control form-control-solid time-24 from"  name="normal_from" id="normal_from" value="09:00"  />
                                    </div>

                                    <div class="d-flex justify-content-between align-items-center w-50 mx-5 gap-1">
                                        <label for="normal_to">{{ __('to') }}  </label>
                                        <input type="text" class="form-control form-control-solid time-24 to"  name="normal_to" id="normal_to" value="20:00"  />

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
                                                    <input type="text" class="form-control form-control-solid time-24 from"  name="{{strtolower($weekDay)}}_open" id="{{strtolower($weekDay)}}_open"   />
                                                </div>

                                                <div class="d-flex justify-content-between align-items-center w-50 mx-5 gap-1">
                                                    <label for="{{strtolower($weekDay)}}_close">{{ __('to') }} </label>
                                                    <input type="text" class="form-control form-control-solid time-24 to"  name="{{strtolower($weekDay)}}_close" id="{{strtolower($weekDay)}}_close"   />

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

    @include('components.map')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>


   
    <script>
     const centerCoords = {
            lat: 24.7136,
            lng: 46.6753,
            address: '8779 Street Number 74, Al Olaya, 2593, Riyadh 12214, Saudi Arabia'
        }; // Default center coordinates
        document.getElementById('lat-new_branch').value = centerCoords.lat;
        document.getElementById('lng-new_branch').value = centerCoords.lat;
        // document.getElementById('pac-input-new_branch').value = centerCoords.address;
      
        initializeMapOnClick('-new_branch', centerCoords?.lat, centerCoords?.lng);
    </script>



@endsection

