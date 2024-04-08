@extends('layouts.restaurant-sidebar')

@section('title', __('branches'))

@section('content')
<style>
      .border-not-active {
            border: 2px solid #e80000;
        }
</style>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAzMlj17cdLKcXdS2BlKkl0d31zG04aj2E&libraries=places"></script>

<!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">

        <!--end::Post-->
        <!--begin::Post-->
        @foreach ($branches as $branch)
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <div class="card card-flush border-0 h-md-100">
                    <!--begin::Body-->
                    <div class="card-body py-9 {{!$branch->active ? 'border-not-active':''}}">
                        <!--begin::Row-->
                        <div class="row gx-9">
                            <!--begin::Col-->
                            <div class="col-sm-6 branches-google-maps">
                                <!--begin::Image-->

                                    <div class="bgi-no-repeat bgi-position-center bgi-size-cover card-rounded min-h-400px min-h-sm-100 h-100">
                                        <input id="pac-input{{ $branch->id }}" class="form-control" type="text" placeholder="{{__('search-for-place')}}" value="{{$branch->address}}">
                                        <div id="map{{ $branch->id }}" class="google_map"></div>
                                            <form action="{{ route('restaurant.update-branch-location', ['id' => $branch->id]) }}" method="POST">
                                                @csrf
                                                <input type="hidden" id="lat{{ $branch->id }}" name="lat" value="{{ $branch->lat }}" />
                                                <input type="hidden" id="lng{{ $branch->id }}" name="lng" value="{{ $branch->lng }}" />
                                                <input type="hidden" id="location{{ $branch->id }}" name="location" value="{{ $branch->address }}" />
                                                <button id="save-location{{ $branch->id }}" type="submit" class="btn btn-khardl my-4 w-100">{{ __('save-location')}}</button>
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
                                        @if(!$branch->active)
                                        <span
                                                class="fs-7 fw-bolder me-2 d-block lh-1 pb-1 badge badge-warning text-capitalize mb-3">
                                                {{ __('This branch is inactive') }}<br>
                                                <small>  {{ __('You will not be able to receive orders from this branch') }}</small>
                                            </span>
                                        @endif
                                        <!--begin::Headin-->
                                        <div class="d-flex flex-stack mb-6">
                                            <!--begin::Title-->
                                            <div class="flex-shrink-0 me-5">
                                                @if ($branch->is_primary)
                                                    <span
                                                        class="fs-7 fw-bolder me-2 d-block lh-1 pb-1 badge badge-light-khardl text-capitalize">{{ __('primary-branch') }}</span>
                                                @endif
                                                <span
                                                    class="text-gray-800 fs-1 fw-bolder text-capitalize">{{ $branch->name }}</span>
                                                    <p > <a href="#" class="text-light bg-dark p-1 rounded">{{$branch->phone ?? ''}}</a> </p>
                                            </div>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Heading-->
                                        <!--begin::Items-->
                                        <div class="d-flex align-items-center flex-wrap d-grid gap-2">
                                            <!--begin::Item-->
                                            @if($user?->hasPermissionWorker('can_view_revenues'))
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
                                                <div class="m-0 position-relative">
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
                                            @endif
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
                                            @if($user?->hasPermissionWorker('can_edit_menu'))
                                            <!--begin::Stat-->
                                                <div
                                                    class="border border-gray-300 border-dashed rounded min-w-100px w-100 py-2 px-4 me-6 mb-3">
                                                    <a href="{{ route('restaurant.get-category', ['id' => \App\Models\Tenant\Category::where('branch_id', $branch->id)?->first()?->id ?? -1, 'branchId' => $branch->id]) }}" class="fs-6 text-700 fw-bolder">{{ __('edit-menu') }}</a>
                                                </div>
                                            @endif
                                        </div>
                                        <!--end::Stats-->
                                        @if($user?->hasPermissionWorker('can_modify_working_time'))
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
                                        @endif
                                        <!--end::Stats-->
                                    </div>
                                    <!--end::Body-->
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
                        <!--begin::Col-->
                        <div class="col-md-12 fv-row">
                            <ul class="nav nav-tabs nav-line-tabs mb-5 fs-6 d-flex justify-content-center">
                                <li class="nav-item">
                                    <a class="nav-link text-dark active" data-bs-toggle="tab" href="#kt_tab_pane_1">{{ __('saturday') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" data-bs-toggle="tab" href="#kt_tab_pane_2">{{ __('sunday') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" data-bs-toggle="tab" href="#kt_tab_pane_3">{{ __('monday') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" data-bs-toggle="tab" href="#kt_tab_pane_4">{{ __('tuesday') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" data-bs-toggle="tab" href="#kt_tab_pane_5">{{ __('wednesday') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" data-bs-toggle="tab" href="#kt_tab_pane_6">{{ __('thursday') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link text-dark" data-bs-toggle="tab" href="#kt_tab_pane_7">{{ __('friday') }}</a>
                                </li>
                            </ul>

                            <div class="tab-content" id="myTabContent">

                                <div class="tab-pane fade show active" id="kt_tab_pane_1" role="tabpanel">
                                    <div class=" d-flex justify-content-between w-100">
                                        <div class="d-flex justify-content-between align-items-center w-50 mx-5">
                                            <label for="">{{ __('from') }} </label>
                                            <input type="text" value="{{ $branch->saturday_open ? \Carbon\Carbon::parse($branch->saturday_open)->format('H:i') : '' }}" class="form-control form-control-solid time-24" name="saturday_open"  required />
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center w-50 mx-5">
                                            <label for="">{{ __('to') }} </label>
                                            <input type="text" value="{{ $branch->saturday_close ? \Carbon\Carbon::parse($branch->saturday_close)->format('H:i') : '' }}" class="form-control form-control-solid time-24" name="saturday_close"  required />
                                        </div>
                                    </div>

                                    <div class="row fv-row my-7">
                                        <div
                                            class="form-check form-check-custom form-check-solid mb-2  d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" @if($branch->saturday_closed) checked @endif name="saturday_closed" id="closed_receving"
                                                value="1" />
                                            <label class="form-check-label text-gray-700 fw-bolder" for="closed_receving">{{ __('the-shop-is-closed-today') }}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="kt_tab_pane_2" role="tabpanel">
                                    <div class=" d-flex justify-content-between w-100">
                                        <div class="d-flex justify-content-between align-items-center w-50 mx-5">
                                            <label for="">{{ __('from') }} </label>
                                            <input type="text" value="{{ $branch->sunday_open ? \Carbon\Carbon::parse($branch->sunday_open)->format('H:i') : '' }}" class="form-control form-control-solid time-24" name="sunday_open"  required />
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center w-50 mx-5">
                                            <label for="">{{ __('to') }} </label>
                                            <input type="text" value="{{ $branch->sunday_close ? \Carbon\Carbon::parse($branch->sunday_close)->format('H:i') : '' }}" class="form-control form-control-solid time-24" name="sunday_close"  required />

                                        </div>
                                    </div>

                                    <div class="row fv-row my-7">
                                        <div
                                            class="form-check form-check-custom form-check-solid mb-2  d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" @if($branch->sunday_closed) checked @endif name="sunday_closed" id="closed_receving"
                                                value="1" />
                                            <label class="form-check-label text-gray-700 fw-bolder" for="closed_receving">{{ __('the-shop-is-closed-today') }}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="kt_tab_pane_3" role="tabpanel">
                                    <div class=" d-flex justify-content-between w-100">
                                        <div class="d-flex justify-content-between align-items-center w-50 mx-5">
                                            <label for="">{{ __('from') }} </label>
                                            <input type="text" value="{{ $branch->monday_open ? \Carbon\Carbon::parse($branch->monday_open)->format('H:i') : '' }}" class="form-control form-control-solid time-24" name="monday_open"  required />
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center w-50 mx-5">
                                            <label for="">{{ __('to') }} </label>
                                            <input type="text" value="{{ $branch->monday_close ? \Carbon\Carbon::parse($branch->monday_close)->format('H:i') : '' }}" class="form-control form-control-solid time-24" name="monday_close"  required />

                                        </div>
                                    </div>

                                    <div class="row fv-row my-7">
                                        <div
                                            class="form-check form-check-custom form-check-solid mb-2  d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" @if($branch->monday_closed) checked @endif name="monday_closed" id="closed_receving"
                                                value="1" />
                                            <label class="form-check-label text-gray-700 fw-bolder" for="closed_receving">{{ __('the-shop-is-closed-today') }}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="kt_tab_pane_4" role="tabpanel">
                                    <div class=" d-flex justify-content-between w-100">
                                        <div class="d-flex justify-content-between align-items-center w-50 mx-5">
                                            <label for="">{{ __('from') }} </label>
                                            <input type="text" value="{{ $branch->tuesday_open ? \Carbon\Carbon::parse($branch->tuesday_open)->format('H:i') : '' }}" class="form-control form-control-solid time-24" name="tuesday_open"  required />
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center w-50 mx-5">
                                            <label for="">{{ __('to') }} </label>
                                            <input type="text" value="{{ $branch->tuesday_close ? \Carbon\Carbon::parse($branch->tuesday_close)->format('H:i') : '' }}" class="form-control form-control-solid time-24" name="tuesday_close"  required />

                                        </div>
                                    </div>

                                    <div class="row fv-row my-7">
                                        <div
                                            class="form-check form-check-custom form-check-solid mb-2  d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" @if($branch->tuesday_closed) checked @endif name="tuesday_closed" id="closed_receving"
                                                value="1" />
                                            <label class="form-check-label text-gray-700 fw-bolder" for="closed_receving">{{ __('the-shop-is-closed-today') }}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="kt_tab_pane_5" role="tabpanel">
                                    <div class=" d-flex justify-content-between w-100">
                                        <div class="d-flex justify-content-between align-items-center w-50 mx-5">
                                            <label for="">{{ __('from') }} </label>
                                            <input type="text" value="{{ $branch->wednesday_open ? \Carbon\Carbon::parse($branch->wednesday_open)->format('H:i') : '' }}" class="form-control form-control-solid time-24" name="wednesday_open"  required />
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center w-50 mx-5">
                                            <label for="">{{ __('to') }} </label>
                                            <input type="text" value="{{ $branch->wednesday_close ? \Carbon\Carbon::parse($branch->wednesday_close)->format('H:i') : '' }}" class="form-control form-control-solid time-24" name="wednesday_close"  required />

                                        </div>
                                    </div>

                                    <div class="row fv-row my-7">
                                        <div
                                            class="form-check form-check-custom form-check-solid mb-2  d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" @if($branch->wednesday_closed) checked @endif name="wednesday_closed" id="closed_receving"
                                                value="1" />
                                            <label class="form-check-label text-gray-700 fw-bolder" for="closed_receving">{{ __('the-shop-is-closed-today') }}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="kt_tab_pane_6" role="tabpanel">
                                    <div class=" d-flex justify-content-between w-100">
                                        <div class="d-flex justify-content-between align-items-center w-50 mx-5">
                                            <label for="">{{ __('from') }} </label>
                                            <input type="text" value="{{ $branch->thursday_open ? \Carbon\Carbon::parse($branch->thursday_open)->format('H:i') : '' }}" class="form-control form-control-solid time-24" name="thursday_open"  required />
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center w-50 mx-5">
                                            <label for="">{{ __('to') }} </label>
                                            <input type="text" value="{{ $branch->thursday_close ? \Carbon\Carbon::parse($branch->thursday_close)->format('H:i') : '' }}" class="form-control form-control-solid time-24" name="thursday_close"  required />
                                        </div>
                                    </div>

                                    <div class="row fv-row my-7">
                                        <div
                                            class="form-check form-check-custom form-check-solid mb-2  d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" @if($branch->thursday_closed) checked @endif name="thursday_closed" id="closed_receving"
                                                value="1" />
                                            <label class="form-check-label text-gray-700 fw-bolder" for="closed_receving">{{ __('the-shop-is-closed-today') }}</label>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="kt_tab_pane_7" role="tabpanel">
                                    <div class=" d-flex justify-content-between w-100">
                                        <div class="d-flex justify-content-between align-items-center w-50 mx-5">
                                            <label for="">{{ __('from') }} </label>
                                            <input type="text" value="{{ $branch->friday_open ? \Carbon\Carbon::parse($branch->friday_open)->format('H:i') : '' }}" class="form-control form-control-solid time-24" name="friday_open"  required />
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center w-50 mx-5">
                                            <label for="">{{ __('to') }} </label>
                                            <input type="text" value="{{ $branch->friday_close ? \Carbon\Carbon::parse($branch->friday_close)->format('H:i') : '' }}" class="form-control form-control-solid time-24" name="friday_close"  required />
                                        </div>
                                    </div>

                                    <div class="row fv-row my-7">
                                        <div
                                            class="form-check form-check-custom form-check-solid mb-2  d-flex justify-content-center">
                                            <input class="form-check-input" type="checkbox" @if($branch->friday_closed) checked @endif name="friday_closed" id="closed_receving"
                                                value="1" />
                                            <label class="form-check-label text-gray-700 fw-bolder" for="closed_receving">{{ __('the-shop-is-closed-today') }}</label>
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

        @endforeach
        <!--end::Post-->
        @if ($branches == "[]")
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
