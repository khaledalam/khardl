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
                                                    <option value="0" selected="selected">Coverage areas</option>
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
                                                <button type="reset" class="btn btn-sm btn-secondary me-5">Discard</button>
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


                                <!--begin::Yeswa-->
                                <div class="col-xl-6">
                                    <!--begin::Contacts-->
                                    <div class="card card-flush h-lg-100" id="kt_contacts_main">
                                        <!--begin::Card body-->
                                        <div><span class="badge badge-light-khardl">
                                                <span><svg viewBox="0 0 24 24"  style="width: 20px !important;" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#010101"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21.5609 10.7386L20.2009 9.15859C19.9409 8.85859 19.7309 8.29859 19.7309 7.89859V6.19859C19.7309 5.13859 18.8609 4.26859 17.8009 4.26859H16.1009C15.7109 4.26859 15.1409 4.05859 14.8409 3.79859L13.2609 2.43859C12.5709 1.84859 11.4409 1.84859 10.7409 2.43859L9.17086 3.80859C8.87086 4.05859 8.30086 4.26859 7.91086 4.26859H6.18086C5.12086 4.26859 4.25086 5.13859 4.25086 6.19859V7.90859C4.25086 8.29859 4.04086 8.85859 3.79086 9.15859L2.44086 10.7486C1.86086 11.4386 1.86086 12.5586 2.44086 13.2486L3.79086 14.8386C4.04086 15.1386 4.25086 15.6986 4.25086 16.0886V17.7986C4.25086 18.8586 5.12086 19.7286 6.18086 19.7286H7.91086C8.30086 19.7286 8.87086 19.9386 9.17086 20.1986L10.7509 21.5586C11.4409 22.1486 12.5709 22.1486 13.2709 21.5586L14.8509 20.1986C15.1509 19.9386 15.7109 19.7286 16.1109 19.7286H17.8109C18.8709 19.7286 19.7409 18.8586 19.7409 17.7986V16.0986C19.7409 15.7086 19.9509 15.1386 20.2109 14.8386L21.5709 13.2586C22.1509 12.5686 22.1509 11.4286 21.5609 10.7386ZM16.1609 10.1086L11.3309 14.9386C11.1909 15.0786 11.0009 15.1586 10.8009 15.1586C10.6009 15.1586 10.4109 15.0786 10.2709 14.9386L7.85086 12.5186C7.56086 12.2286 7.56086 11.7486 7.85086 11.4586C8.14086 11.1686 8.62086 11.1686 8.91086 11.4586L10.8009 13.3486L15.1009 9.04859C15.3909 8.75859 15.8709 8.75859 16.1609 9.04859C16.4509 9.33859 16.4509 9.81859 16.1609 10.1086Z" fill="#fffff"></path> </g></svg></span>
                                                {{__('messages.verified')}}</span></div>
                                        <div class="card-body pt-5">
                                            <!--begin::Profile-->
                                            <div class="d-flex gap-7 align-items-center">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-circle symbol-100px">
                                                    <img src="{{global_asset('delivery-companies/yeswa/yeswa_logo.svg')}}" alt="yeswa image" />
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Contact details-->
                                                <div class="d-flex flex-column gap-2">
                                                    <!--begin::Name-->
                                                    <h3 class="mb-0">{{__('messages.yeswa')}}</h3>
                                                    <!--end::Name-->
                                                    <!--begin::Activation-->
                                                    <div class="d-flex align-items-center gap-2">
                                                        <!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
                                                        <span class="svg-icon svg-icon-2">
																<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M8.827 6.956c2.265.662 5.109-.295 8.172-1.867l.001.079c0 1.3-1.642 2.897-3.248 4.288a3.818 3.818 0 0 0-.752.898v6.726c1.321.372 2.815 2.089 3.827 3.655-.027.088-.043.179-.077.265h-8.5c-.034-.087-.057-.17-.082-.254 1.01-1.57 2.509-3.293 3.833-3.666v-6.729a3.819 3.819 0 0 0-.73-.88 17.898 17.898 0 0 1-2.443-2.515zM17.922 2H20v1h-1.516A5.594 5.594 0 0 1 19 5.319c0 2.15-1.479 4.294-3.545 6.092a1.544 1.544 0 0 0-.62 1.089 1.544 1.544 0 0 0 .62 1.089C17.521 15.387 19 17.53 19 19.68a5.595 5.595 0 0 1-.516 2.32H20v1H5v-1h1.5a5.666 5.666 0 0 1-.5-2.319c0-2.15 1.479-4.294 3.545-6.092a1.544 1.544 0 0 0 .62-1.089 1.544 1.544 0 0 0-.62-1.089C7.479 9.613 6 7.47 6 5.32A5.666 5.666 0 0 1 6.5 3H5V2zm-.545 1H7.624A4.68 4.68 0 0 0 7 5.32c0 1.645 1.137 3.54 3.2 5.336a2.435 2.435 0 0 1 .966 1.844 2.432 2.432 0 0 1-.965 1.843c-2.064 1.797-3.2 3.692-3.2 5.338A4.68 4.68 0 0 0 7.623 22h9.753A4.646 4.646 0 0 0 18 19.68c0-1.645-1.137-3.54-3.2-5.336a2.435 2.435 0 0 1-.966-1.844 2.432 2.432 0 0 1 .965-1.843c2.064-1.797 3.2-3.692 3.2-5.338A4.646 4.646 0 0 0 17.378 3z"></path><path fill="none" d="M0 0h24v24H0z"></path></g></svg>
															</span>
                                                        <!--end::Svg Icon-->
                                                        <a href="#" class="text-muted text-hover-khardl">{{__('messages.activation-within')}} 48 {{__('messages.hour')}}</a>
                                                    </div>
                                                    <!--end::Activation-->
                                                </div>
                                                <!--end::Contact details-->
                                            </div>
                                            <!--end::Profile-->
                                            <!--begin:::Tabs-->
                                            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x fs-6 fw-bold mt-6 mb-8">
                                                <!--begin:::Tab item-->
                                                <li class="nav-item">
                                                    <a class="nav-link text-active-khardl pb-4 active" data-bs-toggle="tab" href="#kt_contact_view_Brief">{{__('messages.brief')}}</a>
                                                </li>
                                                <!--end:::Tab item-->
                                                <!--begin:::Tab item-->
                                                <li class="nav-item">
                                                    <a class="nav-link text-active-khardl pb-4" data-bs-toggle="tab" href="#kt_contact_view_coverage_areas">{{__('messages.coverage')}}</a>
                                                </li>
                                                <!--end:::Tab item-->
                                                <!--begin:::Tab item-->
                                                <li class="nav-item">
                                                    <a class="nav-link text-active-khardl pb-4" data-bs-toggle="tab" href="#kt_contact_view_prices">{{__('messages.prices')}}</a>
                                                </li>
                                                <!--end:::Tab item-->
                                                <!--begin:::Tab item-->
{{--                                                <li class="nav-item">--}}
{{--                                                    <a class="nav-link text-active-khardl pb-4" data-bs-toggle="tab" href="#kt_contact_view_contract">{{__('messages.contract')}}</a>--}}
{{--                                                </li>--}}
                                                <!--end:::Tab item-->
                                                <li class="nav-item">
                                                    <a class="nav-link text-active-khardl pb-4" data-bs-toggle="tab" href="#kt_contact_contact">{{__("messages.contact")}}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link text-active-khardl pb-4" data-bs-toggle="tab" href="#kt_yeswa_configurations">{{__("messages.configurations")}}</a>
                                                </li>
                                                <!--end:::Tab item-->

                                            </ul>
                                            <!--end:::Tabs-->
                                            <!--begin::Tab content-->
                                            <div class="tab-content" id="">
                                                <!--begin:::Tab pane-->
                                                <div class="tab-pane fade show active" id="kt_contact_view_Brief" role="tabpanel">
                                                    <!--begin::Additional details-->
                                                    <div class="d-flex flex-column gap-5 mt-7">
                                                        <!--begin::Notes-->
                                                        <div class="d-flex flex-column gap-1">
                                                            <div class="fw-bolder text-muted">{{__('messages.summary')}}</div>
                                                            <p>{!! __('messages.delivery.yeswa.summary') !!}</p>
                                                            <a href="{{global_asset('delivery-companies/yeswa/Yeswa_Profile.pdf')}}" class="btn btn-warning text-black text-hover-khardl" target="_blank">Profile.pdf</a>
                                                        </div>
                                                        <!--end::Notes-->
                                                    </div>
                                                    <!--end::Additional details-->
                                                </div>
                                                <!--end:::Tab pane-->
                                                <!--begin:::Tab pane-->
                                                <div class="tab-pane fade" id="kt_contact_view_coverage_areas" role="tabpanel">

                                                    <!--begin::Tab Content-->
                                                    <div class="tab-content">
                                                        <!--begin::Day-->
                                                        <div id="kt_schedule_day_0" class="tab-pane fade show active">
                                                            <!--begin::Time-->
                                                            <div class="d-flex flex-stack position-relative mt-8">
                                                                <!--begin::Bar-->
                                                                <div class="position-absolute h-100 w-4px bg-khardl rounded top-0 start-0"></div>
                                                                <!--end::Bar-->
                                                                <!--begin::Info-->
                                                                <div class="fw-bold ms-5 text-gray-600">
                                                                    <!--begin::Time-->
                                                                    <div class="fs-5 mb-3">{{__('messages.cover-area')}}</div>
                                                                    <!--end::Time-->
                                                                    <span class="badge badge-lg badge-light-khardl">{{__('messages.Riyadh')}}</span>
                                                                    <span class="badge badge-lg badge-light-khardl">{{__('messages.Jeddah')}}</span>
                                                                    <span class="badge badge-lg badge-light-khardl">{{__('messages.Mecca')}}</span>
                                                                    <span class="badge badge-lg badge-light-khardl">{{__('messages.Dammam')}}</span>
                                                                    <span class="badge badge-lg badge-light-khardl">{{__('messages.Al-Ahsa')}}</span>
                                                                </div>
                                                                <!--end::Info-->
                                                            </div>
                                                            <!--end::Time-->

                                                        </div>
                                                        <!--end::Day-->
                                                    </div>
                                                    <!--end::Tab Content-->
                                                </div>
                                                <!--end:::Tab pane-->
                                                <!--begin:::Tab pane-->
                                                <div class="tab-pane fade" id="kt_contact_view_prices" role="tabpanel">
                                                    <!--begin::Timeline-->
                                                    <div class="d-flex flex-stack position-relative mt-8">

                                                        <div class="position-absolute h-100 w-4px bg-khardl rounded top-0 start-0"></div>

                                                        <div class="fw-bold ms-5 text-gray-600">
                                                            <!--begin::Time-->
                                                            <div class="fs-5 mb-3">{{__('messages.main-cost')}}</div>
                                                            <!--end::Time-->
                                                            <span class="badge badge-lg badge-light-khardl">17 {{__('messages.sar')}}</span>
                                                            <br /><br />
                                                            <div class="fs-5 mb-3">{{__('messages.additional-cost')}}</div>
                                                            <span class="badge badge-lg badge-light-khardl"> {{__('messages.na')}}</span>
                                                        </div>

                                                    </div>
                                                    <!--end::Timeline-->
                                                </div>
                                                <!--end:::Tab pane-->
                                                <!--begin:::Tab pane-->
                                                <div class="tab-pane fade" id="kt_contact_contact" role="tabpanel">
                                                    <!--begin::Timeline-->
                                                    <div class="timeline-label">
                                                        <!--begin::Card body-->
                                                        <div class="card-body pt-0">
                                                            <div class="table-responsive">
                                                                <!--begin::Table-->
                                                                <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                                                    <!--begin::Table body-->
                                                                    <tbody class="fw-bold text-gray-600">
                                                                    <!--begin::Payment method-->
                                                                    <tr>
                                                                        <td class="text-muted p-0 py-3">
                                                                            <div class="d-flex flex-column align-items-center">
                                                                                Tel: <a href="tel:+966557767339">+966557767339</a>
                                                                            </div>
                                                                        </td>
                                                                        <td class="fw-bolder text-end py-0"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted p-0 py-3">
                                                                            <div class="d-flex flex-column align-items-center">
                                                                                Email: <a href="mailto:info@yeswa.net">info@yeswa.net</a>
                                                                            </div>
                                                                        </td>
                                                                        <td class="fw-bolder text-end py-0"></td>
                                                                    </tr>
                                                                    <!--end::Payment method-->
                                                                    </tbody>
                                                                    <!--end::Table body-->
                                                                </table>
                                                                <!--end::Table-->
                                                            </div>
                                                        </div>
                                                        <!--end::Card body-->
                                                    </div>
                                                    <!--end::Timeline-->
                                                </div>
                                                 <div class="tab-pane fade" id="kt_yeswa_configurations" role="tabpanel">
                                                    <!--begin::Timeline-->
                                                    <div class="timeline-label">
                                                        <!--begin::Card body-->
                                                        <div class="card-body pt-0">
                                                            <div class="table-responsive">
                                                                <!--begin::Table-->
                                                                <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                                                    <!--begin::Table body-->
                                                                    <tbody class="fw-bold text-gray-600">
                                                                    <!--begin::Payment method-->
                                                                    <tr>
                                                                        <td class="text-muted p-0 py-3">
                                                                            <div class="d-flex flex-column align-items-center">
                                                                                {{-- <form  action="{{route('restaurant.delivery.activate',['module'=>'Yeswa'])}}" method="POST" style="width: 100%">
                                                                                    @csrf
                                                                                    @if($yeswa->status)
                                                                                        Secret Key <input type="text" readonly value="{{$yeswa->api_key}}" class="form-control mb-2" name="api_key" id="">
                                                                                    @else
                                                                                        Secret Key <input type="text"   class="form-control mb-2" name="api_key" value="{{$yeswa->api_key}}">
                                                                                    @endif
                                                                                    <div class="d-flex justify-content-center">
                                                                                        @if(!$yeswa->status)
                                                                                        <button type="submit"  class="btn btn-success text-white text-hover-white" >{{__("messages.Activate")}}</a>
                                                                                        @else 
                                                                                            <button type="submit" class="btn btn-danger  text-white text-hover-white" >{{__("messages.Deactivate")}}</a>
                                                                                        @endif
                                                                                    </div>
                                                                                </form> --}}
                                                                               
                                                                            </div>
                                                                        </td>
                                                                        <td class="fw-bolder text-end py-0"></td>
                                                                       
                                                                    </tr>
                                                                    <!--end::Payment method-->
                                                                    </tbody>
                                                                    <!--end::Table body-->
                                                                </table>
                                                                <!--end::Table-->
                                                            </div>
                                                        </div>
                                                        <!--end::Card body-->
                                                    </div>
                                                    <!--end::Timeline-->
                                                </div>

                                                <!--end:::Tab pane-->

                                                <!--begin:::Tab pane-->
{{--                                                <div class="tab-pane fade" id="kt_contact_view_contract" role="tabpanel">--}}

{{--                                                    <!--begin::Timeline-->--}}
{{--                                                    <div class="timeline-label">--}}
{{--                                                        <!--begin::Bar-->--}}
{{--                                                        <div class="position-absolute h-100 w-4px bg-khardl rounded top-0 start-0"></div>--}}
{{--                                                        <!--end::Bar-->--}}
{{--                                                        <table id="kt_file_manager_list" style="margin-left: 20px;" data-kt-filemanager-table="files" class="table align-middle table-row-dashed fs-6 gy-5">--}}
{{--                                                            <!--begin::Table body-->--}}
{{--                                                            <tbody class="fw-bold text-gray-600">--}}
{{--                                                            <tr>--}}
{{--                                                                <!--begin::Name=-->--}}
{{--                                                                <td>--}}
{{--                                                                    <div class="d-flex align-items-center">--}}
{{--                                                                        <!--begin::Svg Icon | path: icons/duotune/files/fil003.svg-->--}}
{{--                                                                        <span class="svg-icon svg-icon-2x svg-icon-khardl me-4">--}}
{{--                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">--}}
{{--                                                                                        <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22Z" fill="currentColor" />--}}
{{--                                                                                        <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor" />--}}
{{--                                                                                    </svg>--}}
{{--                                                                                </span>--}}
{{--                                                                        <!--end::Svg Icon-->--}}
{{--                                                                        <a href="{{global_asset('delivery-companies/yeswa/yeswa_contract.pdf')}}}}" class="text-gray-800 text-hover-khardl">Yeswa_Contract.pdf</a>--}}
{{--                                                                    </div>--}}
{{--                                                                </td>--}}
{{--                                                                <!--end::Name=-->--}}
{{--                                                                <!--begin::Size-->--}}
{{--                                                                <td>489 KB</td>--}}
{{--                                                                <!--end::Size-->--}}

{{--                                                                <!--begin::Actions-->--}}
{{--                                                                <td class="text-end" data-kt-filemanager-table="action_dropdown">--}}
{{--                                                                    <div class="d-flex justify-content-end">--}}

{{--                                                                        <!--begin::More-->--}}
{{--                                                                        <div class="ms-2">--}}
{{--                                                                            <!--begin::Menu-->--}}
{{--                                                                            <div class="menu-rounded menu-gray-600 menu-state-bg-light-khardl fw-bold fs-7 w-150px py-4">--}}
{{--                                                                                <!--begin::Menu item-->--}}
{{--                                                                                <div class="menu-item px-3">--}}
{{--                                                                                    <a href="#" class="menu-link px-3">Download File</a>--}}
{{--                                                                                </div>--}}
{{--                                                                                <!--end::Menu item-->--}}

{{--                                                                            </div>--}}
{{--                                                                            <!--end::Menu-->--}}
{{--                                                                            <!--end::Svg Icon-->--}}
{{--                                                                            </button>--}}

{{--                                                                        </div>--}}
{{--                                                                        <!--end::More-->--}}
{{--                                                                    </div>--}}
{{--                                                                </td>--}}
{{--                                                                <!--end::Actions-->--}}
{{--                                                            </tr>--}}

{{--                                                            <tr>--}}
{{--                                                                <td colspan="3">--}}
{{--                                                                    <div class="d-flex justify-content-between align-items-center">--}}
{{--                                                                        <div>--}}
{{--                                                                            <span style="margin-left: 15px;">Upload the signed contract</span>--}}
{{--                                                                        </div>--}}

{{--                                                                        <div>--}}
{{--                                                                            <button type="button" class="btn btn-khardl" data-bs-toggle="modal" data-bs-target="#kt_modal_upload">--}}
{{--                                                                                <!--begin::Svg Icon | path: icons/duotune/files/fil018.svg-->--}}
{{--                                                                                <span class="svg-icon svg-icon-2">--}}
{{--                                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">--}}
{{--                                                                                                <path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z" fill="currentColor" />--}}
{{--                                                                                                <path d="M10.4 3.60001L12 6H21C21.6 6 22 6.4 22 7V19C22 19.6 21.6 20 21 20H3C2.4 20 2 19.6 2 19V4C2 3.4 2.4 3 3 3H9.20001C9.70001 3 10.2 3.20001 10.4 3.60001ZM16 11.6L12.7 8.29999C12.3 7.89999 11.7 7.89999 11.3 8.29999L8 11.6H11V17C11 17.6 11.4 18 12 18C12.6 18 13 17.6 13 17V11.6H16Z" fill="currentColor" />--}}
{{--                                                                                                <path opacity="0.3" d="M11 11.6V17C11 17.6 11.4 18 12 18C12.6 18 13 17.6 13 17V11.6H11Z" fill="currentColor" />--}}
{{--                                                                                            </svg>--}}
{{--                                                                                        </span>--}}
{{--                                                                                <!--end::Svg Icon-->Upload Files</button>--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}

{{--                                                                </td>--}}
{{--                                                                <td>--}}

{{--                                                                </td>--}}
{{--                                                            </tr>--}}
{{--                                                            </tbody>--}}
{{--                                                            <!--end::Table body-->--}}
{{--                                                        </table>--}}
{{--                                                    </div>--}}
{{--                                                    <!--end::Timeline-->--}}
{{--                                                </div>--}}
                                                <!--end:::Tab pane-->

                                            </div>
                                            <!--end::Tab content-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Contacts-->
                                </div>
                                <!--end::Yeswa-->

                                <!--begin::Cervo-->
                                <div class="col-xl-6">
                                    <!--begin::Contacts-->
                                    <div class="card card-flush h-lg-100" id="kt_contacts_main">
                                        <!--begin::Card body-->
                                        <div><span class="badge badge-light-khardl">
                                                <span><svg viewBox="0 0 24 24"  style="width: 20px !important;" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#010101"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21.5609 10.7386L20.2009 9.15859C19.9409 8.85859 19.7309 8.29859 19.7309 7.89859V6.19859C19.7309 5.13859 18.8609 4.26859 17.8009 4.26859H16.1009C15.7109 4.26859 15.1409 4.05859 14.8409 3.79859L13.2609 2.43859C12.5709 1.84859 11.4409 1.84859 10.7409 2.43859L9.17086 3.80859C8.87086 4.05859 8.30086 4.26859 7.91086 4.26859H6.18086C5.12086 4.26859 4.25086 5.13859 4.25086 6.19859V7.90859C4.25086 8.29859 4.04086 8.85859 3.79086 9.15859L2.44086 10.7486C1.86086 11.4386 1.86086 12.5586 2.44086 13.2486L3.79086 14.8386C4.04086 15.1386 4.25086 15.6986 4.25086 16.0886V17.7986C4.25086 18.8586 5.12086 19.7286 6.18086 19.7286H7.91086C8.30086 19.7286 8.87086 19.9386 9.17086 20.1986L10.7509 21.5586C11.4409 22.1486 12.5709 22.1486 13.2709 21.5586L14.8509 20.1986C15.1509 19.9386 15.7109 19.7286 16.1109 19.7286H17.8109C18.8709 19.7286 19.7409 18.8586 19.7409 17.7986V16.0986C19.7409 15.7086 19.9509 15.1386 20.2109 14.8386L21.5709 13.2586C22.1509 12.5686 22.1509 11.4286 21.5609 10.7386ZM16.1609 10.1086L11.3309 14.9386C11.1909 15.0786 11.0009 15.1586 10.8009 15.1586C10.6009 15.1586 10.4109 15.0786 10.2709 14.9386L7.85086 12.5186C7.56086 12.2286 7.56086 11.7486 7.85086 11.4586C8.14086 11.1686 8.62086 11.1686 8.91086 11.4586L10.8009 13.3486L15.1009 9.04859C15.3909 8.75859 15.8709 8.75859 16.1609 9.04859C16.4509 9.33859 16.4509 9.81859 16.1609 10.1086Z" fill="#fffff"></path> </g></svg></span>
                                                {{__('messages.verified')}}</span></div>
                                        <div class="card-body pt-5">
                                            <!--begin::Profile-->
                                            <div class="d-flex gap-7 align-items-center">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-circle symbol-100px">
                                                    <img src="{{global_asset('delivery-companies/cervo/cervo_logo.svg')}}" alt="cervo image" />
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Contact details-->
                                                <div class="d-flex flex-column gap-2">
                                                    <!--begin::Name-->
                                                    <h3 class="mb-0">{{__('messages.cervo')}}</h3>
                                                    <!--end::Name-->
                                                    <!--begin::Activation-->
                                                    <div class="d-flex align-items-center gap-2">
                                                        <!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
                                                        <span class="svg-icon svg-icon-2">
																<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M8.827 6.956c2.265.662 5.109-.295 8.172-1.867l.001.079c0 1.3-1.642 2.897-3.248 4.288a3.818 3.818 0 0 0-.752.898v6.726c1.321.372 2.815 2.089 3.827 3.655-.027.088-.043.179-.077.265h-8.5c-.034-.087-.057-.17-.082-.254 1.01-1.57 2.509-3.293 3.833-3.666v-6.729a3.819 3.819 0 0 0-.73-.88 17.898 17.898 0 0 1-2.443-2.515zM17.922 2H20v1h-1.516A5.594 5.594 0 0 1 19 5.319c0 2.15-1.479 4.294-3.545 6.092a1.544 1.544 0 0 0-.62 1.089 1.544 1.544 0 0 0 .62 1.089C17.521 15.387 19 17.53 19 19.68a5.595 5.595 0 0 1-.516 2.32H20v1H5v-1h1.5a5.666 5.666 0 0 1-.5-2.319c0-2.15 1.479-4.294 3.545-6.092a1.544 1.544 0 0 0 .62-1.089 1.544 1.544 0 0 0-.62-1.089C7.479 9.613 6 7.47 6 5.32A5.666 5.666 0 0 1 6.5 3H5V2zm-.545 1H7.624A4.68 4.68 0 0 0 7 5.32c0 1.645 1.137 3.54 3.2 5.336a2.435 2.435 0 0 1 .966 1.844 2.432 2.432 0 0 1-.965 1.843c-2.064 1.797-3.2 3.692-3.2 5.338A4.68 4.68 0 0 0 7.623 22h9.753A4.646 4.646 0 0 0 18 19.68c0-1.645-1.137-3.54-3.2-5.336a2.435 2.435 0 0 1-.966-1.844 2.432 2.432 0 0 1 .965-1.843c2.064-1.797 3.2-3.692 3.2-5.338A4.646 4.646 0 0 0 17.378 3z"></path><path fill="none" d="M0 0h24v24H0z"></path></g></svg>
															</span>
                                                        <!--end::Svg Icon-->
                                                        <a href="#" class="text-muted text-hover-khardl">{{__('messages.activation-within')}} 48 {{__('messages.hour')}}</a>
                                                    </div>
                                                    <!--end::Activation-->
                                                </div>
                                            <!--end::Contact details-->
                                            </div>
                                            <!--end::Profile-->
                                            <!--begin:::Tabs-->
                                            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x fs-6 fw-bold mt-6 mb-8">
                                                <!--begin:::Tab item-->
                                                <li class="nav-item">
                                                    <a class="nav-link text-active-khardl pb-4 active" data-bs-toggle="tab" href="#kt_contact_view_Brief_cervo">{{__('messages.brief')}}</a>
                                                </li>
                                                <!--end:::Tab item-->
                                                <!--begin:::Tab item-->
                                                <li class="nav-item">
                                                    <a class="nav-link text-active-khardl pb-4" data-bs-toggle="tab" href="#kt_contact_view_coverage_areas_cervo">{{__('messages.coverage')}}</a>
                                                </li>
                                                <!--end:::Tab item-->
                                                <!--begin:::Tab item-->
                                                <li class="nav-item">
                                                    <a class="nav-link text-active-khardl pb-4" data-bs-toggle="tab" href="#kt_contact_view_prices_cervo">{{__('messages.prices')}}</a>
                                                </li>
                                                <!--end:::Tab item-->
                                                <!--begin:::Tab item-->
{{--                                                <li class="nav-item">--}}
{{--                                                    <a class="nav-link text-active-khardl pb-4" data-bs-toggle="tab" href="#kt_contact_view_contract_cervo">{{__('messages.contract')}}</a>--}}
{{--                                                </li>--}}
                                                <!--end:::Tab item-->
                                                <li class="nav-item">
                                                    <a class="nav-link text-active-khardl pb-4" data-bs-toggle="tab" href="#kt_contact_contact_cervo">{{__("messages.contact")}}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link text-active-khardl pb-4" data-bs-toggle="tab" href="#kt_cervo_configurations">{{__("messages.configurations")}}</a>
                                                </li>
                                                <!--end:::Tab item-->

                                            </ul>
                                            <!--end:::Tabs-->
                                            <!--begin::Tab content-->
                                            <div class="tab-content" id="">
                                                <!--begin:::Tab pane-->
                                                <div class="tab-pane fade show active" id="kt_contact_view_Brief_cervo" role="tabpanel">
                                                    <!--begin::Additional details-->
                                                    <div class="d-flex flex-column gap-5 mt-7">
                                                        <!--begin::Notes-->
                                                        <div class="d-flex flex-column gap-1">
                                                            <div class="fw-bolder text-muted">{{__('messages.summary')}}</div>
                                                            <p>{!! __('messages.delivery.cervo.summary') !!}</p>
                                                        </div>
                                                        <!--end::Notes-->
                                                    </div>
                                                    <!--end::Additional details-->
                                                </div>
                                                <!--end:::Tab pane-->
                                                <!--begin:::Tab pane-->
                                                <div class="tab-pane fade" id="kt_contact_view_coverage_areas_cervo" role="tabpanel">

                                                    <!--begin::Tab Content-->
                                                    <div class="tab-content">
                                                        <!--begin::Day-->
                                                        <div id="kt_schedule_day_0" class="tab-pane fade show active">
                                                            <!--begin::Time-->
                                                            <div class="d-flex flex-stack position-relative mt-8">
                                                                <!--begin::Bar-->
                                                                <div class="position-absolute h-100 w-4px bg-khardl rounded top-0 start-0"></div>
                                                                <!--end::Bar-->
                                                                <!--begin::Info-->
                                                                <div class="fw-bold ms-5 text-gray-600">

                                                                    Max:
                                                                    <!--begin::Time-->
                                                                    <div class="fs-5 mb-3">{{__('messages.cover-area')}}</div>
                                                                    <!--end::Time-->
                                                                    <span class="badge badge-lg badge-light-khardl">{{__('messages.Riyadh')}}</span>
                                                                    <span class="badge badge-lg badge-light-khardl">{{__('messages.Jeddah')}}</span>
                                                                    <span class="badge badge-lg badge-light-khardl">{{__('messages.Mecca')}}</span>
                                                                    <span class="badge badge-lg badge-light-khardl">{{__('messages.Dammam')}}</span>
                                                                    <span class="badge badge-lg badge-light-khardl">{{__('messages.Al-Ahsa')}}</span>
                                                                </div>
                                                                <!--end::Info-->
                                                            </div>
                                                            <!--end::Time-->

                                                        </div>
                                                        <!--end::Day-->
                                                    </div>
                                                    <!--end::Tab Content-->
                                                </div>
                                                <!--end:::Tab pane-->
                                                <!--begin:::Tab pane-->
                                                <div class="tab-pane fade" id="kt_contact_view_prices_cervo" role="tabpanel">
                                                    <!--begin::Timeline-->
                                                    <div class="d-flex flex-stack position-relative mt-8">

                                                        <div class="position-absolute h-100 w-4px bg-khardl rounded top-0 start-0"></div>

                                                        <div class="fw-bold ms-5 text-gray-600">
                                                            <!--begin::Time-->
                                                            <div class="fs-5 mb-3">{{__('messages.main-cost')}}</div>
                                                            <!--end::Time-->
                                                            First 8KM for <span class="badge badge-lg badge-light-khardl">14 {{__('messages.sar')}}</span>
                                                            <br /><br />
                                                            <div class="fs-5 mb-3">{{__('messages.additional-cost')}}</div>
                                                            each additional 1KM: <span class="badge badge-lg badge-light-khardl">+1 {{__('messages.sar')}}</span>
                                                        </div>

                                                    </div>
                                                    <!--end::Timeline-->
                                                </div>
                                                <!--end:::Tab pane-->
                                                <!--begin:::Tab pane-->
                                                <div class="tab-pane fade" id="kt_contact_contact_cervo" role="tabpanel">
                                                    <!--begin::Timeline-->
                                                    <div class="timeline-label">
                                                        <!--begin::Card body-->
                                                        <div class="card-body pt-0">
                                                            <div class="table-responsive">
                                                                <!--begin::Table-->
                                                                <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                                                    <!--begin::Table body-->
                                                                    <tbody class="fw-bold text-gray-600">
                                                                    <!--begin::Payment method-->
                                                                    <tr>
                                                                        <td class="text-muted p-0 py-3">
                                                                            <div class="d-flex flex-column align-items-center">
                                                                                Tel: <a href="tel:+966544488721">+966 544488721</a><br />
                                                                                Tel: <a href="tel:+966548983405">+966 548983405</a><br />
                                                                                Tel: <a href="tel:+966571625192">+966 571625192</a><br />
                                                                            </div>
                                                                        </td>
                                                                        <td class="fw-bolder text-end py-0"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted p-0 py-3">
                                                                            <div class="d-flex flex-column align-items-center">
                                                                                Email: <a href="mailto:info@cervodelivery.com">info@cervodelivery.com</a>
                                                                            </div>
                                                                        </td>
                                                                        <td class="fw-bolder text-end py-0"></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td class="text-muted p-0 py-3">
                                                                            <div class="d-flex flex-column align-items-center">
                                                                                Address: Hejra road - Madina<br />Monawra, Saudi Arabia
                                                                            </div>
                                                                        </td>
                                                                        <td class="fw-bolder text-end py-0"></td>
                                                                    </tr>
                                                                    <!--end::Payment method-->
                                                                    </tbody>
                                                                    <!--end::Table body-->
                                                                </table>
                                                                <!--end::Table-->
                                                            </div>
                                                        </div>
                                                        <!--end::Card body-->
                                                    </div>
                                                    <!--end::Timeline-->
                                                </div>
                                                <div class="tab-pane fade" id="kt_cervo_configurations" role="tabpanel">
                                                    <!--begin::Timeline-->
                                                    <div class="timeline-label">
                                                        <!--begin::Card body-->
                                                        <div class="card-body pt-0">
                                                            <div class="table-responsive">
                                                                <!--begin::Table-->
                                                                <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                                                    <!--begin::Table body-->
                                                                    <tbody class="fw-bold text-gray-600">
                                                                    <!--begin::Payment method-->
                                                                    <tr>
                                                                        <td class="text-muted p-0 py-3">
                                                                            <div class="d-flex flex-column align-items-center">
                                                                                <form  action="{{route('restaurant.delivery.activate',['module'=>'Cervo'])}}" method="POST" style="width: 100%">
                                                                                    @csrf
                                                                                    @if($cervo->status)
                                                                                        Secret Key <input type="text" readonly value="{{$cervo->api_key}}" class="form-control mb-2" name="api_key" id="">
                                                                                    @else
                                                                                        Secret Key <input type="text"   class="form-control mb-2" name="api_key" value="{{$cervo->api_key}}">
                                                                                    @endif
                                                                                    <div class="d-flex justify-content-center">
                                                                                        @if(!$cervo->status)
                                                                                        <button type="submit"  class="btn btn-success text-white text-hover-white" >{{__("messages.Activate")}}</a>
                                                                                        @else 
                                                                                            <button type="submit" class="btn btn-danger  text-white text-hover-white" >{{__("messages.Deactivate")}}</a>
                                                                                        @endif
                                                                                    </div>
                                                                                </form>
                                                                            </div>
                                                                        </td>
                                                                        <td class="fw-bolder text-end py-0"></td>
                                                                       
                                                                    </tr>
                                                                    <!--end::Payment method-->
                                                                    </tbody>
                                                                    <!--end::Table body-->
                                                                </table>
                                                                <!--end::Table-->
                                                            </div>
                                                        </div>
                                                        <!--end::Card body-->
                                                    </div>
                                                    <!--end::Timeline-->
                                                </div>
                                                <!--end:::Tab pane-->
                                                <!--begin:::Tab pane-->
{{--                                                <div class="tab-pane fade" id="kt_contact_view_contract_cervo" role="tabpanel">--}}

{{--                                                    <!--begin::Timeline-->--}}
{{--                                                    <div class="timeline-label">--}}
{{--                                                        <!--begin::Bar-->--}}
{{--                                                        <div class="position-absolute h-100 w-4px bg-khardl rounded top-0 start-0"></div>--}}
{{--                                                        <!--end::Bar-->--}}
{{--                                                        <table id="kt_file_manager_list" style="margin-left: 20px;" data-kt-filemanager-table="files" class="table align-middle table-row-dashed fs-6 gy-5">--}}
{{--                                                            <!--begin::Table body-->--}}
{{--                                                            <tbody class="fw-bold text-gray-600">--}}
{{--                                                            <tr>--}}
{{--                                                                <!--begin::Name=-->--}}
{{--                                                                <td>--}}
{{--                                                                    <div class="d-flex align-items-center">--}}
{{--                                                                        <!--begin::Svg Icon | path: icons/duotune/files/fil003.svg-->--}}
{{--                                                                        <span class="svg-icon svg-icon-2x svg-icon-khardl me-4">--}}
{{--                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">--}}
{{--                                                                                        <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22Z" fill="currentColor" />--}}
{{--                                                                                        <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor" />--}}
{{--                                                                                    </svg>--}}
{{--                                                                                </span>--}}
{{--                                                                        <!--end::Svg Icon-->--}}
{{--                                                                        <a href="{{global_asset('delivery-companies/cervo/cervo_contract.pdf')}}" class="text-gray-800 text-hover-khardl">Servo_Contract.pdf</a>--}}
{{--                                                                    </div>--}}
{{--                                                                </td>--}}
{{--                                                                <!--end::Name=-->--}}
{{--                                                                <!--begin::Size-->--}}
{{--                                                                <td>489 KB</td>--}}
{{--                                                                <!--end::Size-->--}}

{{--                                                                <!--begin::Actions-->--}}
{{--                                                                <td class="text-end" data-kt-filemanager-table="action_dropdown">--}}
{{--                                                                    <div class="d-flex justify-content-end">--}}

{{--                                                                        <!--begin::More-->--}}
{{--                                                                        <div class="ms-2">--}}
{{--                                                                            <!--begin::Menu-->--}}
{{--                                                                            <div class="menu-rounded menu-gray-600 menu-state-bg-light-khardl fw-bold fs-7 w-150px py-4">--}}
{{--                                                                                <!--begin::Menu item-->--}}
{{--                                                                                <div class="menu-item px-3">--}}
{{--                                                                                    <a href="#" class="menu-link px-3">Download File</a>--}}
{{--                                                                                </div>--}}
{{--                                                                                <!--end::Menu item-->--}}

{{--                                                                            </div>--}}
{{--                                                                            <!--end::Menu-->--}}
{{--                                                                            <!--end::Svg Icon-->--}}
{{--                                                                            </button>--}}

{{--                                                                        </div>--}}
{{--                                                                        <!--end::More-->--}}
{{--                                                                    </div>--}}
{{--                                                                </td>--}}
{{--                                                                <!--end::Actions-->--}}
{{--                                                            </tr>--}}

{{--                                                            <tr>--}}
{{--                                                                <td colspan="3">--}}
{{--                                                                    <div class="d-flex justify-content-between align-items-center">--}}
{{--                                                                        <div>--}}
{{--                                                                            <span style="margin-left: 15px;">Upload the signed contract</span>--}}
{{--                                                                        </div>--}}

{{--                                                                        <div>--}}
{{--                                                                            <button type="button" class="btn btn-khardl" data-bs-toggle="modal" data-bs-target="#kt_modal_upload">--}}
{{--                                                                                <!--begin::Svg Icon | path: icons/duotune/files/fil018.svg-->--}}
{{--                                                                                <span class="svg-icon svg-icon-2">--}}
{{--                                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">--}}
{{--                                                                                                <path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z" fill="currentColor" />--}}
{{--                                                                                                <path d="M10.4 3.60001L12 6H21C21.6 6 22 6.4 22 7V19C22 19.6 21.6 20 21 20H3C2.4 20 2 19.6 2 19V4C2 3.4 2.4 3 3 3H9.20001C9.70001 3 10.2 3.20001 10.4 3.60001ZM16 11.6L12.7 8.29999C12.3 7.89999 11.7 7.89999 11.3 8.29999L8 11.6H11V17C11 17.6 11.4 18 12 18C12.6 18 13 17.6 13 17V11.6H16Z" fill="currentColor" />--}}
{{--                                                                                                <path opacity="0.3" d="M11 11.6V17C11 17.6 11.4 18 12 18C12.6 18 13 17.6 13 17V11.6H11Z" fill="currentColor" />--}}
{{--                                                                                            </svg>--}}
{{--                                                                                        </span>--}}
{{--                                                                                <!--end::Svg Icon-->Upload Files</button>--}}
{{--                                                                        </div>--}}
{{--                                                                    </div>--}}

{{--                                                                </td>--}}
{{--                                                                <td>--}}

{{--                                                                </td>--}}
{{--                                                            </tr>--}}
{{--                                                            </tbody>--}}
{{--                                                            <!--end::Table body-->--}}
{{--                                                        </table>--}}
{{--                                                    </div>--}}
{{--                                                    <!--end::Timeline-->--}}
{{--                                                </div>--}}
                                                <!--end:::Tab pane-->

                                            </div>
                                            <!--end::Tab content-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Contacts-->
                                </div>
                                <!--end::Cervo-->

                                <!--begin::Streetline-->
                                <div class="col-xl-6">
                                    <!--begin::Contacts-->
                                    <div class="card card-flush h-lg-100" id="kt_contacts_main">
                                        <!--begin::Card body-->
                                        <div><span class="badge badge-light-khardl">
                                                <span><svg viewBox="0 0 24 24"  style="width: 20px !important;" fill="none" xmlns="http://www.w3.org/2000/svg" stroke="#010101"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <path d="M21.5609 10.7386L20.2009 9.15859C19.9409 8.85859 19.7309 8.29859 19.7309 7.89859V6.19859C19.7309 5.13859 18.8609 4.26859 17.8009 4.26859H16.1009C15.7109 4.26859 15.1409 4.05859 14.8409 3.79859L13.2609 2.43859C12.5709 1.84859 11.4409 1.84859 10.7409 2.43859L9.17086 3.80859C8.87086 4.05859 8.30086 4.26859 7.91086 4.26859H6.18086C5.12086 4.26859 4.25086 5.13859 4.25086 6.19859V7.90859C4.25086 8.29859 4.04086 8.85859 3.79086 9.15859L2.44086 10.7486C1.86086 11.4386 1.86086 12.5586 2.44086 13.2486L3.79086 14.8386C4.04086 15.1386 4.25086 15.6986 4.25086 16.0886V17.7986C4.25086 18.8586 5.12086 19.7286 6.18086 19.7286H7.91086C8.30086 19.7286 8.87086 19.9386 9.17086 20.1986L10.7509 21.5586C11.4409 22.1486 12.5709 22.1486 13.2709 21.5586L14.8509 20.1986C15.1509 19.9386 15.7109 19.7286 16.1109 19.7286H17.8109C18.8709 19.7286 19.7409 18.8586 19.7409 17.7986V16.0986C19.7409 15.7086 19.9509 15.1386 20.2109 14.8386L21.5709 13.2586C22.1509 12.5686 22.1509 11.4286 21.5609 10.7386ZM16.1609 10.1086L11.3309 14.9386C11.1909 15.0786 11.0009 15.1586 10.8009 15.1586C10.6009 15.1586 10.4109 15.0786 10.2709 14.9386L7.85086 12.5186C7.56086 12.2286 7.56086 11.7486 7.85086 11.4586C8.14086 11.1686 8.62086 11.1686 8.91086 11.4586L10.8009 13.3486L15.1009 9.04859C15.3909 8.75859 15.8709 8.75859 16.1609 9.04859C16.4509 9.33859 16.4509 9.81859 16.1609 10.1086Z" fill="#fffff"></path> </g></svg></span>
                                                {{__('messages.verified')}}</span></div>
                                        <div class="card-body pt-5">
                                            <!--begin::Profile-->
                                            <div class="d-flex gap-7 align-items-center">
                                                <!--begin::Avatar-->
                                                <div class="symbol symbol-circle symbol-100px">
                                                    <img src="{{global_asset('delivery-companies/street-line/street-line_logo.png')}}" alt="streetline image" />
                                                </div>
                                                <!--end::Avatar-->
                                                <!--begin::Contact details-->
                                                <div class="d-flex flex-column gap-2">
                                                    <!--begin::Name-->
                                                    <h3 class="mb-0">{{__('messages.street-line')}}</h3>
                                                    <!--end::Name-->
                                                    <!--begin::Activation-->
                                                    <div class="d-flex align-items-center gap-2">
                                                        <!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
                                                        <span class="svg-icon svg-icon-2">
																<svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" fill="#000000"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"><path d="M8.827 6.956c2.265.662 5.109-.295 8.172-1.867l.001.079c0 1.3-1.642 2.897-3.248 4.288a3.818 3.818 0 0 0-.752.898v6.726c1.321.372 2.815 2.089 3.827 3.655-.027.088-.043.179-.077.265h-8.5c-.034-.087-.057-.17-.082-.254 1.01-1.57 2.509-3.293 3.833-3.666v-6.729a3.819 3.819 0 0 0-.73-.88 17.898 17.898 0 0 1-2.443-2.515zM17.922 2H20v1h-1.516A5.594 5.594 0 0 1 19 5.319c0 2.15-1.479 4.294-3.545 6.092a1.544 1.544 0 0 0-.62 1.089 1.544 1.544 0 0 0 .62 1.089C17.521 15.387 19 17.53 19 19.68a5.595 5.595 0 0 1-.516 2.32H20v1H5v-1h1.5a5.666 5.666 0 0 1-.5-2.319c0-2.15 1.479-4.294 3.545-6.092a1.544 1.544 0 0 0 .62-1.089 1.544 1.544 0 0 0-.62-1.089C7.479 9.613 6 7.47 6 5.32A5.666 5.666 0 0 1 6.5 3H5V2zm-.545 1H7.624A4.68 4.68 0 0 0 7 5.32c0 1.645 1.137 3.54 3.2 5.336a2.435 2.435 0 0 1 .966 1.844 2.432 2.432 0 0 1-.965 1.843c-2.064 1.797-3.2 3.692-3.2 5.338A4.68 4.68 0 0 0 7.623 22h9.753A4.646 4.646 0 0 0 18 19.68c0-1.645-1.137-3.54-3.2-5.336a2.435 2.435 0 0 1-.966-1.844 2.432 2.432 0 0 1 .965-1.843c2.064-1.797 3.2-3.692 3.2-5.338A4.646 4.646 0 0 0 17.378 3z"></path><path fill="none" d="M0 0h24v24H0z"></path></g></svg>
															</span>
                                                        <!--end::Svg Icon-->
                                                        <a href="#" class="text-muted text-hover-khardl">{{__('messages.activation-within')}} 48 {{__('messages.hour')}}</a>
                                                    </div>
                                                    <!--end::Activation-->
                                                </div>
                                                <!--end::Contact details-->
                                            </div>
                                            <!--end::Profile-->
                                            <!--begin:::Tabs-->
                                            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x fs-6 fw-bold mt-6 mb-8">
                                                <!--begin:::Tab item-->
                                                <li class="nav-item">
                                                    <a class="nav-link text-active-khardl pb-4 active" data-bs-toggle="tab" href="#kt_contact_view_Brief_street-line">{{__('messages.brief')}}</a>
                                                </li>
                                                <!--end:::Tab item-->
                                                <!--begin:::Tab item-->
                                                <li class="nav-item">
                                                    <a class="nav-link text-active-khardl pb-4" data-bs-toggle="tab" href="#kt_contact_view_coverage_areas_street-line">{{__('messages.coverage')}}</a>
                                                </li>
                                                <!--end:::Tab item-->
                                                <!--begin:::Tab item-->
                                                <li class="nav-item">
                                                    <a class="nav-link text-active-khardl pb-4" data-bs-toggle="tab" href="#kt_contact_view_prices_street-line">{{__('messages.prices')}}</a>
                                                </li>
                                                <!--end:::Tab item-->
                                                <!--begin:::Tab item-->
                                            {{--                                                <li class="nav-item">--}}
                                            {{--                                                    <a class="nav-link text-active-khardl pb-4" data-bs-toggle="tab" href="#kt_contact_view_contract_cervo">{{__('messages.contract')}}</a>--}}
                                            {{--                                                </li>--}}
                                            <!--end:::Tab item-->
                                                <li class="nav-item">
                                                    <a class="nav-link text-active-khardl pb-4" data-bs-toggle="tab" href="#kt_contact_contact_street-line">{{__("messages.contact")}}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link text-active-khardl pb-4" data-bs-toggle="tab" href="#kt_streetline_configurations">{{__("messages.configurations")}}</a>
                                                </li>
                                                <!--end:::Tab item-->

                                            </ul>
                                            <!--end:::Tabs-->
                                            <!--begin::Tab content-->
                                            <div class="tab-content" id="">
                                                <!--begin:::Tab pane-->
                                                <div class="tab-pane fade show active" id="kt_contact_view_Brief_street-line" role="tabpanel">
                                                    <!--begin::Additional details-->
                                                    <div class="d-flex flex-column gap-5 mt-7">
                                                        <!--begin::Notes-->
                                                        <div class="d-flex flex-column gap-1">
                                                            <div class="fw-bolder text-muted">{{__('messages.summary')}}</div>
                                                            <p>{!! __('messages.delivery.street-line.summary') !!}</p>
                                                        </div>
                                                        <!--end::Notes-->
                                                    </div>
                                                    <!--end::Additional details-->
                                                </div>
                                                <!--end:::Tab pane-->
                                                <!--begin:::Tab pane-->
                                                <div class="tab-pane fade" id="kt_contact_view_coverage_areas_street-line" role="tabpanel">

                                                    <!--begin::Tab Content-->
                                                    <div class="tab-content">
                                                        <!--begin::Day-->
                                                        <div id="kt_schedule_day_0" class="tab-pane fade show active">
                                                            <!--begin::Time-->
                                                            <div class="d-flex flex-stack position-relative mt-8">
                                                                <!--begin::Bar-->
                                                                <div class="position-absolute h-100 w-4px bg-khardl rounded top-0 start-0"></div>
                                                                <!--end::Bar-->
                                                                <!--begin::Info-->
                                                                <div class="fw-bold ms-5 text-gray-600">

                                                                    Max:
                                                                    <!--begin::Time-->
                                                                    <div class="fs-5 mb-3">{{__('messages.cover-area')}}</div>
                                                                    <!--end::Time-->
                                                                    <span class="badge badge-lg badge-light-khardl">{{__('messages.Riyadh')}} partially (check attached map)</span>
                                                                    <span class="badge badge-lg badge-light-khardl">{{__('messages.Jeddah')}}</span>
                                                                    <span class="badge badge-lg badge-light-khardl">{{__('messages.Mecca')}}</span>
                                                                    <span class="badge badge-lg badge-light-khardl">{{__('messages.Dammam')}}</span>
                                                                    <span class="badge badge-lg badge-light-khardl">{{__('messages.Al-Ahsa')}}</span>

                                                                    <span class="badge badge-lg badge-light-khardl">{{__('messages.Khobar')}}</span>
                                                                    <span class="badge badge-lg badge-light-khardl">{{__('messages.Dahran')}}</span>
                                                                    <span class="badge badge-lg badge-light-khardl">{{__('messages.Hassa')}}</span>
                                                                    <span class="badge badge-lg badge-light-khardl">{{__('messages.Buridah')}}</span>
                                                                    <span class="badge badge-lg badge-light-khardl">{{__('messages.Tabuk')}}</span>
                                                                    <span class="badge badge-lg badge-light-khardl">{{__('messages.Al Madinah')}}</span>
                                                                    <span class="badge badge-lg badge-light-khardl">{{__('messages.Yanbu')}}</span>
                                                                    <span class="badge badge-lg badge-light-khardl">{{__('messages.Makkah')}}</span>
                                                                    <span class="badge badge-lg badge-light-khardl">{{__('messages.Taif')}}</span>
                                                                    <span class="badge badge-lg badge-light-khardl">{{__('messages.Abha')}}</span>
                                                                    <span class="badge badge-lg badge-light-khardl">{{__('messages.Khamis Mashit')}}</span>
                                                                    <span class="badge badge-lg badge-light-khardl">{{__('messages.Bulgrshi')}}</span>
                                                                    <span class="badge badge-lg badge-light-khardl">{{__('messages.Kharj')}}</span>

                                                                    <img src="{{global_asset('delivery-companies/street-line/Riyadh_coverd_area.jpg')}}" alt="street-line coverage area riyadh image" />

                                                                </div>
                                                                <!--end::Info-->
                                                            </div>
                                                            <!--end::Time-->

                                                        </div>
                                                        <!--end::Day-->
                                                    </div>
                                                    <!--end::Tab Content-->
                                                </div>
                                                <!--end:::Tab pane-->
                                                <!--begin:::Tab pane-->
                                                <div class="tab-pane fade" id="kt_contact_view_prices_street-line" role="tabpanel">
                                                    <!--begin::Timeline-->
                                                    <div class="d-flex flex-stack position-relative mt-8">

                                                        <div class="position-absolute h-100 w-4px bg-khardl rounded top-0 start-0"></div>

                                                        <div class="fw-bold ms-5 text-gray-600">
                                                            <!--begin::Time-->
                                                            <div class="fs-5 mb-3">{{__('messages.main-cost')}}</div>
                                                            <!--end::Time-->
                                                            First 8KM for <span class="badge badge-lg badge-light-khardl">14 {{__('messages.sar')}}</span>
                                                            <br /><br />
                                                            <div class="fs-5 mb-3">{{__('messages.additional-cost')}}</div>
                                                            each additional 1KM: <span class="badge badge-lg badge-light-khardl">+1 {{__('messages.sar')}}</span>
                                                        </div>

                                                    </div>
                                                    <!--end::Timeline-->
                                                </div>
                                                <!--end:::Tab pane-->
                                                <!--begin:::Tab pane-->
                                                <div class="tab-pane fade" id="kt_contact_contact_street-line" role="tabpanel">
                                                    <!--begin::Timeline-->
                                                    <div class="timeline-label">
                                                        <!--begin::Card body-->
                                                        <div class="card-body pt-0">
                                                            <div class="table-responsive">
                                                                <!--begin::Table-->
                                                                <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                                                    <!--begin::Table body-->
                                                                    <tbody class="fw-bold text-gray-600">
                                                                    <!--begin::Payment method-->
                                                                    <tr>
                                                                        <td class="text-muted p-0 py-3">
                                                                            <div class="d-flex flex-column align-items-center">
                                                                                Website form: <a href="https://alshrouqexpress.com/">https://alshrouqexpress.com/</a>
                                                                            </div>
                                                                        </td>
                                                                        <td class="fw-bolder text-end py-0"></td>
                                                                    </tr>
                                                                    <!--end::Payment method-->
                                                                    </tbody>
                                                                    <!--end::Table body-->
                                                                </table>
                                                                <!--end::Table-->
                                                            </div>
                                                        </div>
                                                        <!--end::Card body-->
                                                    </div>
                                                    <!--end::Timeline-->
                                                </div>
                                                <div class="tab-pane fade" id="kt_streetline_configurations" role="tabpanel">
                                                    <!--begin::Timeline-->
                                                    <div class="timeline-label">
                                                        <!--begin::Card body-->
                                                        <div class="card-body pt-0">
                                                            <div class="table-responsive">
                                                                <!--begin::Table-->
                                                                <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                                                    <!--begin::Table body-->
                                                                    <tbody class="fw-bold text-gray-600">
                                                                    <!--begin::Payment method-->
                                                                    <tr>
                                                                        <td class="text-muted p-0 py-3">
                                                                            <div class="d-flex flex-column align-items-center">
                                                                                {{-- <form  action="{{route('restaurant.delivery.activate',['module'=>'StreetLine'])}}" method="POST" style="width: 100%">
                                                                                    @csrf
                                                                                    @if($streetline->status)
                                                                                        Secret Key <input type="text" readonly value="{{$streetline->api_key}}" class="form-control mb-2" name="api_key" id="">
                                                                                    @else
                                                                                        Secret Key <input type="text"   class="form-control mb-2" name="api_key" value="{{$streetline->api_key}}">
                                                                                    @endif
                                                                                    <div class="d-flex justify-content-center">
                                                                                        @if(!$streetline->status)
                                                                                        <button type="submit"  class="btn btn-success text-white text-hover-white" >{{__("messages.Activate")}}</a>
                                                                                        @else 
                                                                                            <button type="submit" class="btn btn-danger  text-white text-hover-white" >{{__("messages.Deactivate")}}</a>
                                                                                        @endif
                                                                                    </div>
                                                                                </form> --}}
                                                                            </div>
                                                                        </td>
                                                                        <td class="fw-bolder text-end py-0"></td>
                                                                       
                                                                    </tr>
                                                                    <!--end::Payment method-->
                                                                    </tbody>
                                                                    <!--end::Table body-->
                                                                </table>
                                                                <!--end::Table-->
                                                            </div>
                                                        </div>
                                                        <!--end::Card body-->
                                                    </div>
                                                    <!--end::Timeline-->
                                                </div>
                                                <!--end:::Tab pane-->
                                                <!--begin:::Tab pane-->
                                            {{--                                                <div class="tab-pane fade" id="kt_contact_view_contract_cervo" role="tabpanel">--}}

                                            {{--                                                    <!--begin::Timeline-->--}}
                                            {{--                                                    <div class="timeline-label">--}}
                                            {{--                                                        <!--begin::Bar-->--}}
                                            {{--                                                        <div class="position-absolute h-100 w-4px bg-khardl rounded top-0 start-0"></div>--}}
                                            {{--                                                        <!--end::Bar-->--}}
                                            {{--                                                        <table id="kt_file_manager_list" style="margin-left: 20px;" data-kt-filemanager-table="files" class="table align-middle table-row-dashed fs-6 gy-5">--}}
                                            {{--                                                            <!--begin::Table body-->--}}
                                            {{--                                                            <tbody class="fw-bold text-gray-600">--}}
                                            {{--                                                            <tr>--}}
                                            {{--                                                                <!--begin::Name=-->--}}
                                            {{--                                                                <td>--}}
                                            {{--                                                                    <div class="d-flex align-items-center">--}}
                                            {{--                                                                        <!--begin::Svg Icon | path: icons/duotune/files/fil003.svg-->--}}
                                            {{--                                                                        <span class="svg-icon svg-icon-2x svg-icon-khardl me-4">--}}
                                            {{--                                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">--}}
                                            {{--                                                                                        <path opacity="0.3" d="M19 22H5C4.4 22 4 21.6 4 21V3C4 2.4 4.4 2 5 2H14L20 8V21C20 21.6 19.6 22 19 22Z" fill="currentColor" />--}}
                                            {{--                                                                                        <path d="M15 8H20L14 2V7C14 7.6 14.4 8 15 8Z" fill="currentColor" />--}}
                                            {{--                                                                                    </svg>--}}
                                            {{--                                                                                </span>--}}
                                            {{--                                                                        <!--end::Svg Icon-->--}}
                                            {{--                                                                        <a href="{{global_asset('delivery-companies/cervo/cervo_contract.pdf')}}" class="text-gray-800 text-hover-khardl">Servo_Contract.pdf</a>--}}
                                            {{--                                                                    </div>--}}
                                            {{--                                                                </td>--}}
                                            {{--                                                                <!--end::Name=-->--}}
                                            {{--                                                                <!--begin::Size-->--}}
                                            {{--                                                                <td>489 KB</td>--}}
                                            {{--                                                                <!--end::Size-->--}}

                                            {{--                                                                <!--begin::Actions-->--}}
                                            {{--                                                                <td class="text-end" data-kt-filemanager-table="action_dropdown">--}}
                                            {{--                                                                    <div class="d-flex justify-content-end">--}}

                                            {{--                                                                        <!--begin::More-->--}}
                                            {{--                                                                        <div class="ms-2">--}}
                                            {{--                                                                            <!--begin::Menu-->--}}
                                            {{--                                                                            <div class="menu-rounded menu-gray-600 menu-state-bg-light-khardl fw-bold fs-7 w-150px py-4">--}}
                                            {{--                                                                                <!--begin::Menu item-->--}}
                                            {{--                                                                                <div class="menu-item px-3">--}}
                                            {{--                                                                                    <a href="#" class="menu-link px-3">Download File</a>--}}
                                            {{--                                                                                </div>--}}
                                            {{--                                                                                <!--end::Menu item-->--}}

                                            {{--                                                                            </div>--}}
                                            {{--                                                                            <!--end::Menu-->--}}
                                            {{--                                                                            <!--end::Svg Icon-->--}}
                                            {{--                                                                            </button>--}}

                                            {{--                                                                        </div>--}}
                                            {{--                                                                        <!--end::More-->--}}
                                            {{--                                                                    </div>--}}
                                            {{--                                                                </td>--}}
                                            {{--                                                                <!--end::Actions-->--}}
                                            {{--                                                            </tr>--}}

                                            {{--                                                            <tr>--}}
                                            {{--                                                                <td colspan="3">--}}
                                            {{--                                                                    <div class="d-flex justify-content-between align-items-center">--}}
                                            {{--                                                                        <div>--}}
                                            {{--                                                                            <span style="margin-left: 15px;">Upload the signed contract</span>--}}
                                            {{--                                                                        </div>--}}

                                            {{--                                                                        <div>--}}
                                            {{--                                                                            <button type="button" class="btn btn-khardl" data-bs-toggle="modal" data-bs-target="#kt_modal_upload">--}}
                                            {{--                                                                                <!--begin::Svg Icon | path: icons/duotune/files/fil018.svg-->--}}
                                            {{--                                                                                <span class="svg-icon svg-icon-2">--}}
                                            {{--                                                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">--}}
                                            {{--                                                                                                <path opacity="0.3" d="M10 4H21C21.6 4 22 4.4 22 5V7H10V4Z" fill="currentColor" />--}}
                                            {{--                                                                                                <path d="M10.4 3.60001L12 6H21C21.6 6 22 6.4 22 7V19C22 19.6 21.6 20 21 20H3C2.4 20 2 19.6 2 19V4C2 3.4 2.4 3 3 3H9.20001C9.70001 3 10.2 3.20001 10.4 3.60001ZM16 11.6L12.7 8.29999C12.3 7.89999 11.7 7.89999 11.3 8.29999L8 11.6H11V17C11 17.6 11.4 18 12 18C12.6 18 13 17.6 13 17V11.6H16Z" fill="currentColor" />--}}
                                            {{--                                                                                                <path opacity="0.3" d="M11 11.6V17C11 17.6 11.4 18 12 18C12.6 18 13 17.6 13 17V11.6H11Z" fill="currentColor" />--}}
                                            {{--                                                                                            </svg>--}}
                                            {{--                                                                                        </span>--}}
                                            {{--                                                                                <!--end::Svg Icon-->Upload Files</button>--}}
                                            {{--                                                                        </div>--}}
                                            {{--                                                                    </div>--}}

                                            {{--                                                                </td>--}}
                                            {{--                                                                <td>--}}

                                            {{--                                                                </td>--}}
                                            {{--                                                            </tr>--}}
                                            {{--                                                            </tbody>--}}
                                            {{--                                                            <!--end::Table body-->--}}
                                            {{--                                                        </table>--}}
                                            {{--                                                    </div>--}}
                                            {{--                                                    <!--end::Timeline-->--}}
                                            {{--                                                </div>--}}
                                            <!--end:::Tab pane-->

                                            </div>
                                            <!--end::Tab content-->
                                        </div>
                                        <!--end::Card body-->
                                    </div>
                                    <!--end::Contacts-->
                                </div>
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
