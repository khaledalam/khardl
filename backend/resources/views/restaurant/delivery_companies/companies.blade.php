@extends('layouts.restaurant-sidebar')

@section('title', __('messages.delivery-companies'))

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
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <!--begin::Container-->
                        <div id="kt_content_container" class="container-fluid">
                            <!--begin::Contacts App- View Contact-->

                            <!--begin::Form-->
                            <form action="#">
                                <!--begin::Card-->
                                <div class="card mb-7">
                                    <!--begin::Card body-->
                                    <div class="card-body">
                                        <!--begin::Compact form-->
                                        <div class="d-flex align-items-center justify-content-center">
                                            <!--begin::Input group-->
                                            <div class="position-relative w-md-200px me-md-2">
                                                <select class="form-select form-select-solid">
                                                    <option value="0" selected="selected">{{ __('messages.Contract') }}</option>
                                                    <option value="1">{{ __('messages.Directly') }}</option>
                                                    <option value="1">{{ __('messages.With khardl') }}</option>
                                                </select>
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Col-->
                                            <div class="position-relative w-md-200px me-md-2">
                                                <select class="form-select form-select-solid">
                                                    <option value="0" selected="selected">{{ __('messages.Coverage areas') }}</option>
                                                    <option value="1">City 1</option>
                                                    <option value="1">City 2</option>
                                                    <option value="1">City 3</option>
                                                    <option value="1">City 4</option>
                                                    <option value="1">City 5</option>
                                                </select>
                                            </div>

                                            <!--begin:Action-->
                                            <div class="d-flex align-items-center">
                                                <button type="submit" class="btn btn-sm btn-khardl me-5">{{ __('messages.Filter') }}</button>
                                            </div>

                                            <div class="d-flex align-items-center">
                                                <button type="reset" class="btn btn-sm btn-secondary me-5">{{__('messages.Discard')}}</button>
                                            </div>
                                            <!--end:Action-->
                                        </div>
                                        <!--end::Compact form-->

                                    </div>
                                    <!--end::Card body-->
                                </div>
                                <!--end::Card-->
                            </form>
                            <!--end::Form-->
                            <div class="row g-6">
                                {{-- NOTE: and variabile you added here note that you have to add it in central controller --}}
                              <!--begin::Yeswa-->
                                @if(isset($yeswa))
                                @include('restaurant.delivery_companies.yeswa.index',['yeswa' => $yeswa,'isadmin' => 0])
                                @endif
                                <!--end::Yeswa-->

                                <!--begin::Cervo-->
                                @if(isset($cervo))
                                @include('restaurant.delivery_companies.cervo.index',['cervo' => $cervo,'isadmin' => 0])
                                @endif
                                <!--end::Cervo-->

                                <!--begin::Streetline-->
                                @if(isset($streetline))
                                @include('restaurant.delivery_companies.streeline.index',['streetline' => $streetline,'isadmin' => 0])
                                @endif
                                <!--end::Streetline-->
                            </div>
                            <!--end::Contacts App- View Contact-->
                        </div>
                        <!--end::Container-->
                    </div>
                    <!--end::Post-->

                </div>
                <!--end::Content-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Root-->
    <!--end::Main-->

@endsection
