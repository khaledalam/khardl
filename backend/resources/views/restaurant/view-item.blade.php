@extends('layouts.restaurant-sidebar')

@section('title', $item->name)

@section('content')<div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">
    <!--begin::Post-->
    <div class="post" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container">
            <!--begin::Navbar-->
            <div class="card mb-5 mb-xl-10">
                <div class="card-body pt-9 pb-0">
                    <!--begin::Details-->
                    <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                        <!--begin: Pic-->
                        <div class="me-7 mb-4">
                            <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                <img alt="Logo" src="{{ $item->photo }}" />

                            </div>
                        </div>
                        <!--end::Pic-->
                        <!--begin::Info-->
                        <div class="flex-grow-1">
                            <!--begin::Title-->
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <!--begin::User-->
                                <div class="d-flex flex-column">
                                    <!--begin::Name-->
                                    <div class="d-flex align-items-center mb-2">

                                        <a class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1">{{ $item->name }}
                                        </a>
                                    </div>
                                    <!--end::Name-->
                                </div>
                                <!--end::User-->

                            </div>
                            <!--begin::Info-->
                            <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
                                <a href="#" class="d-flex align-items-center text-hover-success me-5 mb-2">
                                    <i class="bi bi-cash mx-2"></i>
                                    {{ $item->price }}
                                    {{ __('messages.SAR') }}
                                </a>
                                {{-- <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                        <!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
                                        <span class="svg-icon svg-icon-4 me-1">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                <path opacity="0.3" d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z" fill="currentColor" />
                                                <path d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z" fill="currentColor" />
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->SA, Al-Riyadh</a> --}}
                                <a href="#" class="d-flex align-items-center text-hover-success mb-2">
                                    <!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
                                    <i class="bi bi-activity mx-2"></i>
                                    <!--end::Svg Icon-->
                                    {{ $item->calories }}
                                    {{ __('messages.Calories') }}
                                </a>
                            </div>
                            <!--end::Info-->
                            <!--end::Title-->
                        </div>
                        <!--end::Info-->
                    </div>
                </div>
                <div class="card-footer">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-3" id="kt_table_widget_5_table">
                            <!--begin::Table head-->
                            <thead>
                                <!--begin::Table row-->
                                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="text-start pe-3 min-w-100px">{{ __('messages.Key') }}</th>
                                    <th class="text-start pe-3 min-w-100px">{{ __('messages.Value') }}</th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="fw-bolder text-gray-600">
                                <!--begin::Item-->
                                <tr>
                                    <td>
                                        <span class="text-start">{{__('messages.Name')}}</span>
                                    </td>
                                    <td class="text-dark">
                                        <span class="py-3 px-4 fs-23">{{ $item->name }}</span>
                                    </td>
                                </tr>
                                <!--end::Item-->
                                <tr>
                                    <td>
                                        <span class="text-start">{{__('messages.Description')}}</span>
                                    </td>
                                    <td class="text-dark">
                                        <span class="py-3 px-4 fs-23">{{ $item->description }}</span>
                                    </td>
                                </tr>
                                <!--begin::Item-->
                                <tr>
                                    <td>
                                        <span class="text-start">{{__('messages.Branch')}}</span>
                                    </td>
                                    <td class="text-dark">
                                        <span class="py-3 px-4 fs-23">{{ $item?->branch?->name }}</span>
                                    </td>
                                </tr>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <tr>
                                    <td>
                                        <span class="text-start">{{__('messages.Category')}}</span>
                                    </td>
                                    <td class="text-dark">
                                        <span class="py-3 px-4 fs-23">{{ $item->category->name }}</span>
                                    </td>
                                </tr>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <tr>
                                    <td>
                                        <span class="text-start">{{__('messages.Availability')}}</span>
                                    </td>
                                    <td class="text-dark">
                                        @if(!$item->availability)<span class="badge badge-danger mx-1">Not available</span>
                                        @else
                                        <span class="badge badge-success mx-1">Available</span>
                                        @endif
                                    </td>
                                </tr>
                                <!--end::Item-->
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                </div>
                <!--end::Container-->
            </div>
            <!--end::Post-->
        </div>
    </div>
</div>
@endsection
