@extends('layouts.restaurant-sidebar')

@section('title', __('messages.orders-all'))

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
                        <div id="kt_content_container" class="container-xxl">
                            <!--begin::Products-->
                            <div class="card card-flush">
                                <!--begin::Card header-->
                                <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                    <!--begin::Card title-->
                                    <div class="card-title">
                                        <!--begin::Search-->
                                        <div class="d-flex align-items-center position-relative my-1">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                            <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                                    <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                            <input type="text" data-kt-ecommerce-order-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="{{__('messages.search')}}" />
                                        </div>
                                        <!--end::Search-->
                                    </div>
                                    <!--end::Card title-->
                                    <!--begin::Card toolbar-->
                                    <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                        <!--begin::Flatpickr-->
                                        <div class="input-group w-250px">
                                            <input class="form-control form-control-solid rounded rounded-end-0" placeholder="{{ __('messages.Pick date range') }}" id="kt_ecommerce_sales_flatpickr" />
                                            <button class="btn btn-icon btn-light" id="kt_ecommerce_sales_flatpickr_clear">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr088.svg-->
                                                <span class="svg-icon svg-icon-2">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <rect opacity="0.5" x="7.05025" y="15.5356" width="12" height="2" rx="1" transform="rotate(-45 7.05025 15.5356)" fill="currentColor" />
                                                        <rect x="8.46447" y="7.05029" width="12" height="2" rx="1" transform="rotate(45 8.46447 7.05029)" fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </button>
                                        </div>
                                        <!--end::Flatpickr-->
                                        <div class="w-100 mw-150px">
                                            <!--begin::Select2-->
                                            <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="{{ __('messages.Delivery') }}" data-kt-ecommerce-order-filter="status">
                                                <option></option>
                                                <option value="all">{{ __('messages.All') }}</option>
                                                <option value="Cancelled">{{ __('messages.Cancelled') }}</option>
                                                <option value="Completed">{{ __('messages.Completed') }}</option>
                                                <option value="Denied">{{ __('messages.Denied') }}</option>
                                                <option value="Expired">{{ __('messages.Expired') }}</option>
                                                <option value="Failed">{{ __('messages.Failed') }}</option>
                                                <option value="Pending">{{ __('messages.Pending') }}</option>
                                                <option value="Processing">{{ __('messages.Processing') }}</option>
                                                <option value="Refunded">{{ __('messages.Refunded') }}</option>
                                                <option value="Delivered">{{ __('messages.Delivered') }}</option>
                                                <option value="Delivering">{{ __('messages.Delivering') }}</option>
                                            </select>
                                            <!--end::Select2-->
                                        </div>


                                        <div class="w-100 mw-150px">
                                            <!--begin::Select2-->
                                            <select class="form-select form-select-solid" data-control="select2" data-hide-search="true" data-placeholder="{{ __('messages.Payment') }}" data-kt-ecommerce-order-filter="status">
                                                <option></option>
                                                <option value="all">{{ __('messages.All') }}</option>
                                                <option value="paid">{{ __('messages.Paid') }}</option>
                                                <option value="unpaid">{{ __('messages.Un Paid') }}</option>
                                            </select>
                                            <!--end::Select2-->
                                        </div>



                                        <!--begin::setting-->
                                        <a href="#" class="btn btn-sm btn-khardl" data-bs-toggle="modal" data-bs-target="#kt_modal_new_target">Setting <i class="fas fa-clock"></i></a>
                                        <!--end::setting-->
                                    </div>
                                    <!--end::Card toolbar-->
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    <!--begin::Table-->
                                    <table class="table align-middle table-row-dashed fs-6 gy-5" id="kt_ecommerce_sales_table">
                                        <!--begin::Table head-->
                                        <thead>
                                        <!--begin::Table row-->
                                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                            <th class="w-10px pe-2">
                                                <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                    <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_ecommerce_sales_table .form-check-input" value="1" />
                                                </div>
                                            </th>
                                            <th class="min-w-100px">{{ __('messages.ID') }}</th>
                                            <th class="min-w-175px">{{ __('messages.Customer') }}</th>
                                            {{-- <th class="text-end min-w-70px">Delivery Type</th> --}}
                                            <th class="text-end min-w-70px">{{ __('messages.Branch') }}</th>
                                            <th class="text-end min-w-70px">{{ __('messages.Status') }}</th>
                                            <th class="text-end min-w-100px">{{ __('messages.Total') }}</th>
                                            <th class="text-end min-w-100px">{{ __('messages.Date') }}</th>
                                            <th class="text-end min-w-100px"><div class="btn btn-sm btn-khardl"><a href="{{ route('restaurant.orders_add') }}" class=" text-white">{{ __('messages.Add new') }}</a></div>
                                            </th>
                                        </tr>
                                        <!--end::Table row-->
                                        </thead>
                                        <!--end::Table head-->
                                        <!--begin::Table body-->
                                        <tbody class="fw-bold text-gray-600">
                                            @foreach($orders as $order)
                                                <!--begin::Table row-->
                                                <tr>
                                                    <!--begin::Checkbox-->
                                                    <td>
                                                        <div class="form-check form-check-sm form-check-custom form-check-solid">
                                                            <input class="form-check-input" type="checkbox" value="{{$order->id}}" />
                                                        </div>
                                                    </td>
                                                    <!--end::Checkbox-->
                                                    <!--begin::Order ID=-->
                                                    <td data-kt-ecommerce-order-filter="order_id">
                                                        <a href="{{route('restaurant.branch.order',['order'=>$order->id])}}" class="text-gray-800 text-hover-khardl fw-bolder">{{$order->id}}</a>
                                                    </td>
                                                    <!--end::Order ID=-->
                                                    <!--begin::Customer=-->
                                                    <td>
                                                        <div class="d-flex align-items-center">
                                                            <!--begin:: Avatar -->
                                                            <div class="symbol symbol-circle symbol-50px overflow-hidden me-3">
                                                                <a href="#">
                                                                    <div class="symbol-label fs-3 bg-light-success text-success">L</div>
                                                                </a>
                                                            </div>
                                                            <!--end::Avatar-->
                                                            <div class="ms-5">
                                                                <!--begin::Title-->
                                                                <a href="#" class="text-gray-800 text-hover-khardl fs-5 fw-bolder">{{$order->user->fullName}}</a>
                                                                <!--end::Title-->
                                                            </div>
                                                        </div>
                                                    </td>
                                                    <!--end::Customer=-->
                                                    <!--begin::Status=-->
                                                    {{-- <td class="text-end pe-0" data-order="Refunded">
                                                        <!--begin::Badges-->
                                                        @if($order->delivery_type->name = 'delivery')
                                                            <div class="badge badge-light-info">{{__("messages.delivery")}}</div>
                                                        @elseif($order->delivery_type = 'receive_from_branch')
                                                            <div class="badge badge-light">{{__("messages.receive_from_branch")}}</div>
                                                        @endif

                                                        <!--end::Badges-->
                                                    </td> --}}
                                                    <td class="text-end pe-0" >
                                                        <!--begin::Badges-->
                                                        <div class="fw-bolder"> {{$order->branch->name}}</div>

                                                        <!--end::Badges-->
                                                    </td>
                                                    <!--end::Status=-->
                                                    <!--begin::Status=-->
                                                    <td class="text-end pe-0" data-order="Refunded">
                                                        <!--begin::Badges-->
                                                        @if($order->status == \App\Models\Tenant\Order::ACCEPTED)
                                                            <span class="badge badge-primary " >{{__("messages.accepted")}}</span>
                                                        @elseif($order->status ==  \App\Models\Tenant\Order::PENDING)
                                                            <span class="badge badge-secondary ">{{__("messages.pending")}}</span>
                                                        @elseif($order->status ==  \App\Models\Tenant\Order::RECEIVED_BY_RESTAURANT)
                                                            <span class="badge badge-warning ">{{__("messages.received_by_restaurant")}}</span>
                                                        @elseif($order->status ==  \App\Models\Tenant\Order::CANCELLED)
                                                            <span class="badge badge-danger ">{{__("messages.cancelled")}}</span>
                                                        @elseif($order->status ==  \App\Models\Tenant\Order::READY)
                                                            <span class="badge badge-info ">{{__("messages.ready")}}</span>
                                                        @elseif($order->status ==  \App\Models\Tenant\Order::COMPLETED)
                                                            <span class="badge badge-success ">{{__("messages.completed")}}</span>
                                                        @endif

                                                        <!--end::Badges-->
                                                    </td>
                                                    <!--end::Status=-->


                                                    <!--begin::Total=-->
                                                    <td class="text-end pe-0">
                                                    <span class="fw-bolder">{{$order->total}} {{__('messages.sar')}}</span>
                                                    </td>
                                                    <!--end::Total=-->
                                                    <!--begin::Date Added=-->
                                                    <td class="text-end" data-order="2022-03-22">
                                                        <span class="fw-bolder">{{$order->created_at}}</span>
                                                    </td>
                                                    <!--end::Date Added=-->
                                                    <!--begin::Action=-->
                                                    <td class="text-end">
                                                        <a href="#" class="btn btn-sm btn-active-light-khardl" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">{{ __('messages.Actions') }}
                                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                                            <span class="svg-icon svg-icon-5 m-0">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon--></a>
                                                        <!--begin::Menu-->
                                                        <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-khardl fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a  href="{{route('restaurant.branch.order',['order'=>$order->id])}}" class="menu-link px-3">{{ __('messages.View') }}</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3">{{ __('messages.Edit') }}</a>
                                                            </div>
                                                            <!--end::Menu item-->
                                                            <!--begin::Menu item-->
                                                            {{-- <div class="menu-item px-3">
                                                                <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">Delete</a>
                                                            </div> --}}
                                                            <div class="menu-item px-3">
                                                                <a href="#" onclick="showConfirmation({{$order->id}})" class="menu-link px-3" >{{__('messages.Changes status')}}</a>
                                                            </div>

                                                            <!--end::Menu item-->
                                                        </div>
                                                        <!--end::Menu-->
                                                    </td>
                                                    <!--end::Action=-->
                                                </tr>
                                                <!--end::Table row-->
                                            @endforeach
                                        </tbody>
                                        <!--end::Table body-->
                                    </table>
                                    <!--end::Table-->
                                    <form id="approve-form"  method="POST" style="display: inline">
                                        @csrf
                                        @method('PUT')
                                        <input type="hidden" name="status" id="orderStatus" >
                                    </form>
                                    <script>
                                        function showConfirmation(orderId) {
                                            event.preventDefault();
                                            const statusOptions = @json(array_combine(\App\Models\Tenant\Order::STATUS,array_map(fn ($status) => __('messages.'.$status), \App\Models\Tenant\Order::STATUS)));

                                            Swal.fire({
                                                text: '{{ __('messages.are-you-sure-you-want-to-change-order-status')}}',
                                                icon: 'warning',
                                                input: 'select',
                                                showCancelButton: true,
                                                inputOptions: statusOptions,
                                                inputPlaceholder: 'Select an option',
                                                confirmButtonText: '{{ __('messages.yes') }}',
                                                cancelButtonText: '{{ __('messages.no') }}'
                                            }).then((result) => {
                                                if (result.isConfirmed) {
                                                    const selectedStatus = result.value;
                                                    document.getElementById('orderStatus').setAttribute('value',selectedStatus);
                                                    var form = document.getElementById('approve-form');
                                                    form.action = `{{ route('restaurant.branch.order.status', ['order' => ':orderId']) }}`.replace(':orderId', orderId)
                                                    form.submit();

                                                }
                                            });
                                        }
                                    </script>
                                    {{ $orders->links('pagination::bootstrap-4') }}
                                </div>
                                <!--end::Card body-->
                            </div>
                            <!--end::Products-->
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

    <!--begin::Modal - New Target-->
    <div class="modal fade" id="kt_modal_new_target" tabindex="-1" aria-hidden="true">
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
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                    <!--begin:Form-->
                    <form id="kt_modal_new_target_form" class="form" action="#" id="myForm">
                        <!--begin::Heading-->
                        <div class="mb-13 text-center">
                            <!--begin::Title-->
                            <h1 class="mb-3">Setting orders</h1>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->

                        <!--begin::Input group-->
                        <div class="row g-9 mb-8">
                            <!--begin::Col-->
                            <div class="col-md-12 fv-row">
                                <!-- <label class="required fs-6 fw-bold mb-2">price</label> -->
                                <!--begin::Input-->
                                <div class="position-relative d-flex align-items-center">
                                    <!--begin::Datepicker-->
                                    <input class="form-control form-control-solid ps-12" />
                                    <!--end::Datepicker-->
                                </div>
                                <!--end::Input-->
                            </div>
                            <!--end::Col-->

                            <!--begin::Row-->
                            <div class="fv-row">
                                <!--begin::Radio group-->
                                <div class="btn-group w-100" data-kt-buttons="true" data-kt-buttons-target="[data-kt-button]">
                                    <!--begin::Radio-->
                                    <label class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-khardl" data-kt-button="true">
                                        <!--begin::Input-->
                                        <input class="btn-check" type="radio" name="method" value="1" />
                                        <!--end::Input-->
                                        Minute</label>
                                    <!--end::Radio-->
                                    <!--begin::Radio-->
                                    <label class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-khardl active" data-kt-button="true">
                                        <!--begin::Input-->
                                        <input class="btn-check" type="radio" name="method" checked="checked" value="2" />
                                        <!--end::Input-->
                                        hour</label>
                                    <!--end::Radio-->
                                    <!--begin::Radio-->
                                    <label class="btn btn-outline-secondary text-muted text-hover-white text-active-white btn-outline btn-active-khardl" data-kt-button="true">
                                        <!--begin::Input-->
                                        <input class="btn-check" type="radio" name="method" value="3" />
                                        <!--end::Input-->
                                        day</label>
                                    <!--end::Radio-->

                                </div>
                                <!--end::Radio group-->
                            </div>
                            <!--end::Row-->




                            <div class="mt-7  d-flex justify-content-between align-items-center">
                                <div class="form-check form-check-custom form-check-solid mb-2  d-flex justify-content-center">
                                    <input class="form-check-input" type="checkbox" name="stop" id="stop_receving" value="1" />
                                    <label class="form-check-label text-gray-700 fw-bolder" for="stop_receving">Stop receiving orders</label>
                                </div>
                                <div class="form-check form-check-custom form-check-solid mb-2  d-flex justify-content-center">
                                    <input class="form-check-input" name="mute" type="checkbox" id="mute_otification" value="1" />
                                    <label class="form-check-label text-gray-700 fw-bolder" for="mute_otification">Mute Notification</label>
                                </div>
                            </div>

                            <div class="row fv-row my-7">
                                <div class="col-md-6 text-md-end">
                                    <!--begin::Label-->
                                    <label class="fs-6 fw-bold form-label mt-3">
                                        <span>Turn off notifications</span>
                                        <i class="fas fa-exclamation-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Enable/disable tracking customers online status."></i>
                                    </label>
                                    <!--end::Label-->
                                </div>
                                <div class="col-md-6">
                                    <div class="d-flex mt-3">
                                        <!--begin::Radio-->
                                        <div class="form-check form-check-custom form-check-solid me-5">
                                            <input class="form-check-input" type="radio" value="" name="mute" id="mute_yes" checked="checked" />
                                            <label class="form-check-label" for="mute_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-custom form-check-solid">
                                            <input class="form-check-input" type="radio" value="" name="mute" id="mute_no" />
                                            <label class="form-check-label" for="mute_no">No</label>
                                        </div>
                                        <!--end::Radio-->
                                    </div>
                                </div>
                            </div>

                        </div>
                        <!--end::Input group-->


                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">Cancel</button>
                            <button type="submit" id="kt_modal_new_target_submit" class="btn btn-khardl">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
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


@push('scripts')
    <script src="{{ global_asset('assets/js/custom/apps/ecommerce/sales/listing.js')}}"></script>
@endpush
@endsection
