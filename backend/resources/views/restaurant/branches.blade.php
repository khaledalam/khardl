@extends('layouts.restaurant-sidebar')

@section('title', __('messages.branches'))

@section('content')

<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB4IfCMfgHzQaHLHy59vALydLhvtjr0Om0
    &libraries=places"></script>
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
                                <p class="fw-bolder mx-3">{{ __('messages.branches-available-to-add') }}</p>
                                <p class="badge badge-light-success">{{$available_branches}}</p>
                            </div>
                        </div>
                        <!--end::Row-->
                    </div>
                    <!--end::Body-->
                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
        <!--begin::Post-->
        @foreach ($branches as $branch)
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <div class="card card-flush border-0 h-md-100">
                    <!--begin::Body-->
                    <div class="card-body py-9">
                        <!--begin::Row-->
                        <div class="row gx-9 h-100">
                            <!--begin::Col-->
                            <div class="col-sm-6 mb-10 mb-sm-0">
                                <!--begin::Image-->

                                    <div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-400px min-h-sm-100 h-100">
                                        <input id="pac-input" class="form-control" type="text" placeholder="Search for place">
                                        <div id="map{{ $branch->id }}" style="width: 100%; height: 90%; border:0;"></div>
                                            <form action="{{ route('restaurant.update-branch-location', ['id' => $branch->id]) }}" method="POST">
                                                @csrf
                                                <input type="hidden" id="lat{{ $branch->id }}" name="lat" value="{{ $branch->lat }}" />
                                                <input type="hidden" id="lng{{ $branch->id }}" name="lng" value="{{ $branch->lng }}" />
                                                <button id="save-location{{ $branch->id }}" type="submit" class="btn btn-khardl mt-3 w-100">{{ __('messages.save-location')}}</button>
                                        </form>
                                    </div>
                                <!--end::Image-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-sm-6">
                                <!--begin::Wrapper-->
                                <div class="d-flex flex-column h-100">
                                    <!--begin::Header-->
                                    <div class="mb-7">
                                        <!--begin::Headin-->
                                        <div class="d-flex flex-stack mb-6">
                                            <!--begin::Title-->
                                            <div class="flex-shrink-0 me-5">
                                                @if ($branch->is_primary)
                                                    <span
                                                        class="fs-7 fw-bolder me-2 d-block lh-1 pb-1 badge badge-light-khardl text-capitalize">{{ __('messages.primary-branch') }}</span>
                                                @endif
                                                <span
                                                    class="text-gray-800 fs-1 fw-bolder text-capitalize">{{ $branch->name }}</span>
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Heading-->
                                        <!--begin::Items-->
                                        <div class="d-flex align-items-center flex-wrap d-grid gap-2">
                                            <!--begin::Item-->
                                            {{-- <div class="d-flex align-items-center me-5 me-xl-13">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-30px symbol-circle me-3">
                                                    <img src="assets/media/avatars/300-3.jpg" class=""
                                                        alt="" />
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Info-->
                                                <div class="m-0">
                                                    <span
                                                        class="fw-bold text-gray-400 d-block fs-8">Manager</span>
                                                    <span class="fw-bolder text-gray-800 fs-7">Ibrahim
                                                        Rogi</span>
                                                </div>
                                                <!--end::Info-->
                                            </div> --}}
                                            <!--end::Item-->
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
                                                <div class="m-0">
                                                    <span
                                                        class="fw-bold text-gray-400 d-block fs-8">{{ __('messages.revenue') }}</span>
                                                    <span
                                                        class="fw-bolder text-gray-800 fs-7">$TODO</span>
                                                </div>
                                                <!--end::Info-->
                                            </div>
                                            <!--end::Item-->
                                        </div>
                                        <!--end::Items-->
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="mb-6">
                                        <!--begin::Text-->
                                        {{-- <span class="fw-bold text-gray-600 fs-6 mb-8 d-block">Lorem ipsum
                                            dolor sit amet, consectetur adipisicing elit. Rem laborum
                                            necessitatibus porro.</span> --}}
                                        <!--end::Text-->
                                        <!--begin::Stats-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Stat-->
                                                <div
                                                    class="border border-gray-300 border-dashed rounded min-w-100px w-100 py-2 px-4 me-6 mb-3">
                                                    <a href="{{ route('restaurant.menu', ['branchId' => $branch->id]) }}" class="fs-6 text-700 fw-bolder">{{ __('messages.edit-menu') }}</a>
                                                </div>

                                            <!--end::Stat-->
{{--                                            <!--begin::Stat-->--}}
{{--                                            <div--}}
{{--                                                class="border border-gray-300 border-dashed rounded min-w-100px w-100 py-2 px-4 mb-3">--}}
{{--                                                <a href="#" class="fs-6 text-700 fw-bolder">{{ __('messages.advertisement-modification') }}</a>--}}
{{--                                            </div>--}}

{{--                                            <!--end::Stat-->--}}
                                        </div>
                                        <!--end::Stats-->
                                        <!--begin::Stats-->
                                        <div class="d-flex align-items-center">
                                            <!--begin::Stat-->
                                                <div
                                                    class="border border-gray-300 border-dashed rounded min-w-100px w-100 py-2 px-4 me-6 mb-3">
                                                    <a href="{{ route('restaurant.workers', ['branchId' => $branch->id]) }}" class="fs-6 text-700 fw-bolder">{{ __('messages.staff-modification') }}</a>
                                                </div>

                                            <!--end::Stat-->
                                            <!--begin::Stat-->
                                                <div
                                                    class="border border-gray-300 border-dashed rounded min-w-100px w-100 py-2 px-4 mb-3">
                                                    <a href="#" class="fs-6 text-700 fw-bolder"
                                                        data-bs-toggle="modal"
                                                        data-bs-target="#kt_modal_new_target{{ $branch->id }}">{{ __('messages.opening-the-branch') }}
                                                        <i class="fas fa-clock"></i></a>
                                                </div>

                                            <!--end::Stat-->
                                        </div>
                                        <!--end::Stats-->
                                    </div>
                                    <!--end::Body-->
                                    <!--begin::Footer-->
                                    <div class="d-flex flex-stack mt-auto bd-highlight">
                                        @if ($branch->is_primary)
                                            <div
                                                class="border border-gray-300 border-dashed rounded min-w-50px w-50 py-2 px-4 mb-3">
                                                <a href="#" class="fs-6 text-700 fw-bolder">{{ __('messages.edit-site') }}</a>
                                            </div>
                                        @endif
                                        <div>
                                            <!--begin::Actions-->
                                            {{-- <a href="demo1/dist/apps/projects/project.html"
                                                class="text-primary opacity-75-hover fs-6 fw-bold">View
                                                Project
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr095.svg-->
                                                <span class="svg-icon svg-icon-4 svg-icon-gray-800 ms-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24"
                                                        height="24" viewBox="0 0 24 24" fill="none">
                                                        <path opacity="0.3"
                                                            d="M4.7 17.3V7.7C4.7 6.59543 5.59543 5.7 6.7 5.7H9.8C10.2694 5.7 10.65 5.31944 10.65 4.85C10.65 4.38056 10.2694 4 9.8 4H5C3.89543 4 3 4.89543 3 6V19C3 20.1046 3.89543 21 5 21H18C19.1046 21 20 20.1046 20 19V14.2C20 13.7306 19.6194 13.35 19.15 13.35C18.6806 13.35 18.3 13.7306 18.3 14.2V17.3C18.3 18.4046 17.4046 19.3 16.3 19.3H6.7C5.59543 19.3 4.7 18.4046 4.7 17.3Z"
                                                            fill="currentColor" />
                                                        <rect x="21.9497" y="3.46448" width="13" height="2"
                                                            rx="1" transform="rotate(135 21.9497 3.46448)"
                                                            fill="currentColor" />
                                                        <path
                                                            d="M19.8284 4.97161L19.8284 9.93937C19.8284 10.5252 20.3033 11 20.8891 11C21.4749 11 21.9497 10.5252 21.9497 9.93937L21.9497 3.05029C21.9497 2.498 21.502 2.05028 20.9497 2.05028L14.0607 2.05027C13.4749 2.05027 13 2.52514 13 3.11094C13 3.69673 13.4749 4.17161 14.0607 4.17161L19.0284 4.17161C19.4702 4.17161 19.8284 4.52978 19.8284 4.97161Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon--></a> --}}
                                            <!--end::Actions-->
                                        </div>
                                    </div>
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
                        <h1 class="mb-3">{{ __('messages.branch-opening-time') }}</h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Heading-->

                    <!--begin::Input group-->
                    <div class="row g-9 mb-8">
                        <!--begin::Col-->
                        <div class="col-md-12 fv-row">
                            <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6 d-flex justify-content-center">
                                <li class="nav-item">
                                    <a class="nav-link text-dark active" data-bs-toggle="tab" href="#kt_tab_pane_1">{{ __('messages.saturday') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" data-bs-toggle="tab" href="#kt_tab_pane_2">{{ __('messages.sunday') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" data-bs-toggle="tab" href="#kt_tab_pane_3">{{ __('messages.monday') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" data-bs-toggle="tab" href="#kt_tab_pane_4">{{ __('messages.tuesday') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" data-bs-toggle="tab" href="#kt_tab_pane_5">{{ __('messages.wednesday') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" data-bs-toggle="tab" href="#kt_tab_pane_6">{{ __('messages.thursday') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" data-bs-toggle="tab" href="#kt_tab_pane_7">{{ __('messages.friday') }}</a>
                                </li>
                            </ul>

                            <div class="tab-content" id="myTabContent">

                                <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
                                    <div class=" d-flex justify-content-between w-100">
                                        <div class="d-flex justify-content-between align-items-center w-50 mx-5">
                                            <label for="">{{ __('messages.from') }} </label>
                                            <input type="time" value="{{ $branch->saturday_open ? \Carbon\Carbon::parse($branch->saturday_open)->format('H:i') : '' }}" class="form-control form-control-solid " id="appt" name="saturday_open"  required />
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center w-50 mx-5">
                                            <label for="">{{ __('messages.to') }} </label>
                                            <input type="time" value="{{ $branch->saturday_close ? \Carbon\Carbon::parse($branch->saturday_close)->format('H:i') : '' }}" class="form-control form-control-solid " id="appt" name="saturday_close"  required />

                                        </div>
                                    </div>

                                    <div class="row fv-row my-7">
                                        <div
                                            class="form-check form-check-custom form-check-solid mb-2  d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" @if($branch->saturday_closed) checked @endif name="saturday_closed" id="closed_receving"
                                                value="1" />
                                            <label class="form-check-label text-gray-700 fw-bolder" for="closed_receving">{{ __('messages.the-shop-is-closed-today') }}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
                                    <div class=" d-flex justify-content-between w-100">
                                        <div class="d-flex justify-content-between align-items-center w-50 mx-5">
                                            <label for="">{{ __('messages.from') }} </label>
                                            <input type="time" value="{{ $branch->sunday_open ? \Carbon\Carbon::parse($branch->sunday_open)->format('H:i') : '' }}" class="form-control form-control-solid " id="appt" name="sunday_open"  required />
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center w-50 mx-5">
                                            <label for="">{{ __('messages.to') }} </label>
                                            <input type="time" value="{{ $branch->sunday_close ? \Carbon\Carbon::parse($branch->sunday_close)->format('H:i') : '' }}" class="form-control form-control-solid " id="appt" name="sunday_close"  required />

                                        </div>
                                    </div>

                                    <div class="row fv-row my-7">
                                        <div
                                            class="form-check form-check-custom form-check-solid mb-2  d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" @if($branch->sunday_closed) checked @endif name="sunday_closed" id="closed_receving"
                                                value="1" />
                                            <label class="form-check-label text-gray-700 fw-bolder" for="closed_receving">{{ __('messages.the-shop-is-closed-today') }}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel">
                                    <div class=" d-flex justify-content-between w-100">
                                        <div class="d-flex justify-content-between align-items-center w-50 mx-5">
                                            <label for="">{{ __('messages.from') }} </label>
                                            <input type="time" value="{{ $branch->monday_open ? \Carbon\Carbon::parse($branch->monday_open)->format('H:i') : '' }}" class="form-control form-control-solid " id="appt" name="monday_open"  required />
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center w-50 mx-5">
                                            <label for="">{{ __('messages.to') }} </label>
                                            <input type="time" value="{{ $branch->monday_close ? \Carbon\Carbon::parse($branch->monday_close)->format('H:i') : '' }}" class="form-control form-control-solid " id="appt" name="monday_close"  required />

                                        </div>
                                    </div>

                                    <div class="row fv-row my-7">
                                        <div
                                            class="form-check form-check-custom form-check-solid mb-2  d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" @if($branch->monday_closed) checked @endif name="monday_closed" id="closed_receving"
                                                value="1" />
                                            <label class="form-check-label text-gray-700 fw-bolder" for="closed_receving">{{ __('messages.the-shop-is-closed-today') }}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="kt_tab_pane_4" role="tabpanel">
                                    <div class=" d-flex justify-content-between w-100">
                                        <div class="d-flex justify-content-between align-items-center w-50 mx-5">
                                            <label for="">{{ __('messages.from') }} </label>
                                            <input type="time" value="{{ $branch->tuesday_open ? \Carbon\Carbon::parse($branch->tuesday_open)->format('H:i') : '' }}" class="form-control form-control-solid " id="appt" name="tuesday_open"  required />
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center w-50 mx-5">
                                            <label for="">{{ __('messages.to') }} </label>
                                            <input type="time" value="{{ $branch->tuesday_close ? \Carbon\Carbon::parse($branch->tuesday_close)->format('H:i') : '' }}" class="form-control form-control-solid " id="appt" name="tuesday_close"  required />

                                        </div>
                                    </div>

                                    <div class="row fv-row my-7">
                                        <div
                                            class="form-check form-check-custom form-check-solid mb-2  d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" @if($branch->tuesday_closed) checked @endif name="tuesday_closed" id="closed_receving"
                                                value="1" />
                                            <label class="form-check-label text-gray-700 fw-bolder" for="closed_receving">{{ __('messages.the-shop-is-closed-today') }}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="kt_tab_pane_5" role="tabpanel">
                                    <div class=" d-flex justify-content-between w-100">
                                        <div class="d-flex justify-content-between align-items-center w-50 mx-5">
                                            <label for="">{{ __('messages.from') }} </label>
                                            <input type="time" value="{{ $branch->wednesday_open ? \Carbon\Carbon::parse($branch->wednesday_open)->format('H:i') : '' }}" class="form-control form-control-solid " id="appt" name="wednesday_open"  required />
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center w-50 mx-5">
                                            <label for="">{{ __('messages.to') }} </label>
                                            <input type="time" value="{{ $branch->wednesday_close ? \Carbon\Carbon::parse($branch->wednesday_close)->format('H:i') : '' }}" class="form-control form-control-solid " id="appt" name="wednesday_close"  required />

                                        </div>
                                    </div>

                                    <div class="row fv-row my-7">
                                        <div
                                            class="form-check form-check-custom form-check-solid mb-2  d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" @if($branch->wednesday_closed) checked @endif name="wednesday_closed" id="closed_receving"
                                                value="1" />
                                            <label class="form-check-label text-gray-700 fw-bolder" for="closed_receving">{{ __('messages.the-shop-is-closed-today') }}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="kt_tab_pane_6" role="tabpanel">
                                    <div class=" d-flex justify-content-between w-100">
                                        <div class="d-flex justify-content-between align-items-center w-50 mx-5">
                                            <label for="">{{ __('messages.from') }} </label>
                                            <input type="time" value="{{ $branch->thursday_open ? \Carbon\Carbon::parse($branch->thursday_open)->format('H:i') : '' }}" class="form-control form-control-solid " id="appt" name="thursday_open"  required />
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center w-50 mx-5">
                                            <label for="">{{ __('messages.to') }} </label>
                                            <input type="time" value="{{ $branch->thursday_close ? \Carbon\Carbon::parse($branch->thursday_close)->format('H:i') : '' }}" class="form-control form-control-solid " id="appt" name="thursday_close"  required />
                                        </div>
                                    </div>

                                    <div class="row fv-row my-7">
                                        <div
                                            class="form-check form-check-custom form-check-solid mb-2  d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" @if($branch->thursday_closed) checked @endif name="thursday_closed" id="closed_receving"
                                                value="1" />
                                            <label class="form-check-label text-gray-700 fw-bolder" for="closed_receving">{{ __('messages.the-shop-is-closed-today') }}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="kt_tab_pane_7" role="tabpanel">
                                    <div class=" d-flex justify-content-between w-100">
                                        <div class="d-flex justify-content-between align-items-center w-50 mx-5">
                                            <label for="">{{ __('messages.from') }} </label>
                                            <input type="time" value="{{ $branch->friday_open ? \Carbon\Carbon::parse($branch->friday_open)->format('H:i') : '' }}" class="form-control form-control-solid " id="appt" name="friday_open"  required />
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center w-50 mx-5">
                                            <label for="">{{ __('messages.to') }} </label>
                                            <input type="time" value="{{ $branch->friday_close ? \Carbon\Carbon::parse($branch->friday_close)->format('H:i') : '' }}" class="form-control form-control-solid " id="appt" name="friday_close"  required />
                                        </div>
                                    </div>

                                    <div class="row fv-row my-7">
                                        <div
                                            class="form-check form-check-custom form-check-solid mb-2  d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" @if($branch->friday_closed) checked @endif name="friday_closed" id="closed_receving"
                                                value="1" />
                                            <label class="form-check-label text-gray-700 fw-bolder" for="closed_receving">{{ __('messages.the-shop-is-closed-today') }}</label>
                                        </div>
                                    </div>
                                </div>


                            </div>
                        </div>
                        <!--end::Col-->








                    </div>
                    <!--end::Input group-->


                    <!--begin::Actions-->
                    <div class="text-center">
                        <button type="submit" id="kt_modal_new_target_submit" class="btn btn-khardl">
                            <span class="indicator-label">{{ __('messages.submit') }}</span>
                            <span class="indicator-progress">{{ __('messages.please-wait') }}
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

        @endforeach
        <!--end::Post-->
        @if ($branches == "[]")
            <div class="post d-flex flex-column-fluid mb-10" id="kt_post">
                <div id="kt_content_container" class="container-xxl">
                    <div class="card card-flush border-0 h-md-100">
                        <div class="card-body py-15">
                            <div class="row gx-9 h-100 p-15">
                                <div class="d-flex justify-content-center align-items-center bg-white pt-5">
                                    <p class="fw-bolder mx-3 text-warning fs-15">{{ __('messages.add-your-primary-branch-by-clicking-on-the-button-bellow') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @if($available_branches > 0)
            <!--begin::Post-->
            <div class="post d-flex flex-column-fluid mt-10" id="kt_post">
                <!--begin::Container-->
                <div id="kt_content_container" class="container-xxl">
                    <div class="card card-flush border-0 h-md-100">
                        <!--begin::Body-->
                        <div class="card-body py-9">
                            <!--begin::Row-->
                            <div class="row gx-9 h-100 d-flex justify-content-center align-items-center">
                                <a href="#" class="fs-6 text-700 fw-bolder text-center border p-15 rounded fs-25" data-bs-toggle="modal" data-bs-target="#kt_modal_new_bransh">{{ __('messages.add-new-branch') }}</a>
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Body-->
                    </div>
                </div>
                <!--end::Container-->
            </div>
            <!--end::Post-->
        @endif

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
                <h1 class="mb-3">{{ __('messages.add-new-branch') }}</h1>
                <!--end::Title-->
            </div>
            <!--end::Heading-->

            <!--begin::Input group-->
            <div class="row g-9 mb-8">
                <!--begin::Col-->
                <div class="col-md-12 fv-row">
                    <label class="required fs-6 fw-bold mb-2">{{ __('messages.name-branch') }}</label>
                    <!--begin::Input-->
                    <div class="position-relative d-flex align-items-center">
                        <!--begin::Datepicker-->
                        <input value="{{ old('name') }}" required name="name" class="form-control form-control-solid " />
                        <!--end::Datepicker-->
                    </div>
                    <!--end::Input-->
                </div>
                <!--end::Col-->

                <!--begin::Col-->
                <div class="col-md-12 fv-row">
                    <label class="required fs-6 fw-bold mb-2">{{ __('messages.location-branch') }}</label>
                    <!--begin::Input-->
                    <div style="width: 100%; height: 250px;" id="map"></div>
                    <input type="hidden" value="{{ old('location') }}" id="location" name="location">
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
                            <label for="kt_ecommerce_add_product_store_template" class="form-label required fs-6 fw-bold mb-2">{{ __('messages.copy-menu') }}</label>
                            <!--end::Select store template-->
                            <!--begin::Select2-->
                            <select class="form-select mb-2" data-control="select2" data-hide-search="true" name="copy_menu" data-placeholder="{{ __('messages.select-an-option') }}" id="kt_ecommerce_add_product_store_template">
                                <option value="None">{{ __('messages.none') }}</option>
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

                <!--begin::Col-->
                <div class="col-md-12 fv-row">
                    <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6 d-flex justify-content-center">
                        <li class="nav-item">
                            <a class="nav-link text-dark active" data-bs-toggle="tab" href="#kt_tab_pane_8">{{ __('messages.saturday') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" data-bs-toggle="tab" href="#kt_tab_pane_9">{{ __('messages.sunday') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" data-bs-toggle="tab" href="#kt_tab_pane_10">{{ __('messages.monday') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" data-bs-toggle="tab" href="#kt_tab_pane_11">{{ __('messages.tuesday') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" data-bs-toggle="tab" href="#kt_tab_pane_12">{{ __('messages.wednesday') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" data-bs-toggle="tab" href="#kt_tab_pane_13">{{ __('messages.thursday') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link text-dark" data-bs-toggle="tab" href="#kt_tab_pane_14">{{ __('messages.friday') }}</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">

                        <div class="tab-pane fade show active" id="kt_tab_pane_8" role="tabpanel">
                            <div class=" d-flex justify-content-between w-100">
                                <div class="d-flex justify-content-between align-items-center w-50 mx-5">
                                    <label for="">{{ __('messages.from') }} </label>
                                    <input type="time" class="form-control form-control-solid" id="appt" name="saturday_open"  required />
                                </div>

                                <div class="d-flex justify-content-between align-items-center w-50 mx-5">
                                    <label for="">{{ __('messages.to') }} </label>
                                    <input type="time" class="form-control form-control-solid" id="appt" name="saturday_close"  required />

                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="kt_tab_pane_9" role="tabpanel">
                            <div class=" d-flex justify-content-between w-100">
                                <div class="d-flex justify-content-between align-items-center w-50 mx-5">
                                    <label for="">{{ __('messages.from') }} </label>
                                    <input type="time" class="form-control form-control-solid " id="appt" name="sunday_open"  required />
                                </div>

                                <div class="d-flex justify-content-between align-items-center w-50 mx-5">
                                    <label for="">{{ __('messages.to') }} </label>
                                    <input type="time" class="form-control form-control-solid " id="appt" name="sunday_close"  required />

                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="kt_tab_pane_10" role="tabpanel">
                            <div class=" d-flex justify-content-between w-100">
                                <div class="d-flex justify-content-between align-items-center w-50 mx-5">
                                    <label for="">{{ __('messages.from') }} </label>
                                    <input type="time" class="form-control form-control-solid " id="appt" name="monday_open"  required />
                                </div>

                                <div class="d-flex justify-content-between align-items-center w-50 mx-5">
                                    <label for="">{{ __('messages.to') }} </label>
                                    <input type="time" class="form-control form-control-solid " id="appt" name="monday_close"  required />

                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="kt_tab_pane_11" role="tabpanel">
                            <div class=" d-flex justify-content-between w-100">
                                <div class="d-flex justify-content-between align-items-center w-50 mx-5">
                                    <label for="">{{ __('messages.from') }} </label>
                                    <input type="time" class="form-control form-control-solid " id="appt" name="tuesday_open"  required />
                                </div>

                                <div class="d-flex justify-content-between align-items-center w-50 mx-5">
                                    <label for="">{{ __('messages.to') }} </label>
                                    <input type="time" class="form-control form-control-solid " id="appt" name="tuesday_close"  required />

                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="kt_tab_pane_12" role="tabpanel">
                            <div class=" d-flex justify-content-between w-100">
                                <div class="d-flex justify-content-between align-items-center w-50 mx-5">
                                    <label for="">{{ __('messages.from') }} </label>
                                    <input type="time" class="form-control form-control-solid " id="appt" name="wednesday_open"  required />
                                </div>

                                <div class="d-flex justify-content-between align-items-center w-50 mx-5">
                                    <label for="">{{ __('messages.to') }} </label>
                                    <input type="time" class="form-control form-control-solid " id="appt" name="wednesday_close"  required />

                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="kt_tab_pane_13" role="tabpanel">
                            <div class=" d-flex justify-content-between w-100">
                                <div class="d-flex justify-content-between align-items-center w-50 mx-5">
                                    <label for="">{{ __('messages.from') }} </label>
                                    <input type="time" class="form-control form-control-solid " id="appt" name="thursday_open"  required />
                                </div>

                                <div class="d-flex justify-content-between align-items-center w-50 mx-5">
                                    <label for="">{{ __('messages.to') }} </label>
                                    <input type="time" class="form-control form-control-solid " id="appt" name="thursday_close"  required />

                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="kt_tab_pane_14" role="tabpanel">
                            <div class=" d-flex justify-content-between w-100">
                                <div class="d-flex justify-content-between align-items-center w-50 mx-5">
                                    <label for="">{{ __('messages.from') }} </label>
                                    <input type="time" class="form-control form-control-solid " id="appt" name="friday_open" required />
                                </div>

                                <div class="d-flex justify-content-between align-items-center w-50 mx-5">
                                    <label for="">{{ __('messages.to') }} </label>
                                    <input type="time" class="form-control form-control-solid " id="appt" name="friday_close"  required />

                                </div>
                            </div>
                        </div>


                    </div>
                </div>
                <!--end::Col-->

            </div>
            <!--end::Input group-->



                <!--begin::Actions-->
                <div class="text-center">
                    <button type="reset" id="kt_modal_new_bransh_cancel"
                        class="btn btn-light me-3">{{ __('messages.reset') }}</button>
                    <button type="submit" id="kt_modal_new_bransh_submit" class="btn btn-khardl">
                        <span class="indicator-label">{{ __('messages.add-branch') }}</span>
                        <span class="indicator-progress">{{ __('messages.please-wait') }}
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

    <script>
        let maps = {}; // Store maps in an object
        let markers = {}; // Store markers in an object

        function initializeMap(branchId, lat, lng) {
          const latLng = new google.maps.LatLng(lat, lng);

          const map = new google.maps.Map(document.getElementById('map' + branchId), {
            center: latLng,
            zoom: 8,
          });
          const input = document.getElementById("pac-input");
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
                infowindow.close();
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
                selectedPlacePosition = { lat, lng };
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
                infowindow.open(map, marker);
            });
        }

        function updateLocationInput(latLng, branchId) {
          const latInput = document.getElementById('lat' + branchId);
          const lngInput = document.getElementById('lng' + branchId);
          latInput.value = latLng.lat();
          lngInput.value = latLng.lng();
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
          initializeMap({{ $branch->id }}, {{ $branch->lat }}, {{ $branch->lng }});
        @endforeach
      </script>


    <script>



        const mapElement = document.getElementById('map');
        const centerCoords = { lat: 24.7136, lng: 46.6753 }; // Default center coordinates

        // Check if the old('location') is not null
        const locationValue = "{{ old('location') }}";
        if (locationValue !== null && locationValue !== '') {
            const locationArray = locationValue.split(' ');
            if (locationArray.length === 2) {
                // Update the center coordinates based on the old('location')
                centerCoords.lat = parseFloat(locationArray[0]);
                centerCoords.lng = parseFloat(locationArray[1]);
            }
        }

        const map = new google.maps.Map(mapElement, {
            center: centerCoords,
            zoom: 10, // Set an appropriate zoom level
        });



        const locationInput = document.getElementById('location');
        const geocoder = new google.maps.Geocoder();

        let marker; // To store the dropped pin

        // Create a PlacesService instance for autocomplete

        // Listen for a place selection

        google.maps.event.addListener(map, 'click', function (event) {
        // If a marker exists, remove it
        if (marker) {
            marker.setMap(null);
        }

        // Create a new marker at the clicked location
        marker = new google.maps.Marker({
            map: map,
            position: event.latLng,
        });

        // Update the hidden input with the clicked location's latitude and longitude
        locationInput.value = `${event.latLng.lat()}, ${event.latLng.lng()}`;
    });



    </script>

@endsection
