<div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button bg-khardl text-white" type="button" data-bs-toggle="collapse" data-bs-target="#paid_orders" aria-expanded="true" aria-controls="paid_orders">
            {{ __('Online paid orders') }}
        </button>
    </h2>
    <div id="paid_orders" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
        <div class="accordion-body">
            <!--begin::Content-->
            @if($orders?->count())
            <div class="d-flex flex-column gap-7 gap-lg-10">
                <!--begin::Order history-->
                <div class="card card-flush py-4 flex-row-fluid">
                    <form action="">
                        @csrf
                        <div class="modal fade show d-none" id="spinner" tabindex="-1" aria-hidden="false">
                            <!--begin::Modal dialog-->
                            <div class="modal-dialog modal-dialog-centered mw-650px">
                                <!--begin::Modal content-->
                                <div class="spinner-border m-auto" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                                <!--end::Modal content-->
                            </div>
                            <!--end::Modal dialog-->
                        </div>

                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>{{ __('Orders') }}</h2>
                            </div>
                            <!--end::Card title-->


                            <!--begin::Card toolbar-->
                            <div class="card-toolbar flex-row-fluid justify-content-start gap-5" @if(app()->getLocale() === 'ar') style=" flex-direction: revert;" @endif>
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
                                    <input type="text" name="search" value="{{ request('search')??'' }}" class="form-control form-control-solid w-250px ps-14" placeholder="{{__('search')}}" />
                                </div>
                                <div class="w-100 mw-150px">
                                    <!--begin::Select2-->
                                    <select class="form-select form-select-solid" name="date_string">
                                        <option value="">{{ __('Date') }}</option>
                                        <option value="today" {{ request('date_string') =='today' ? 'selected':'' }}>{{ __('Today') }}</option>
                                        <option value="last_day" {{ request('date_string') =='last_day' ? 'selected':'' }}>{{ __('Last day') }}</option>
                                        <option value="last_week" {{ request('date_string') =='last_week' ? 'selected':'' }}>{{ __('Last week') }}</option>
                                    </select>
                                    <!--end::Select2-->
                                </div>
                                <button class="btn btn-khardl" type="submit">{{ __('Search') }}</button>
                                <form method="GET">
                                    @csrf
                                    <div class="d-flex my-0">
                                        <input type="hidden" name="download" value="orders_csv">
                                        <button type="submit" id="download_app_transactions" class="btn btn-khardl mx-2">
                                            <span class="indicator-label">{{ __('Download') }} <i class="fa fa-download"></i></span>
                                            <span class="indicator-progress">{{ __('please-wait')}}
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                        </button>
                                    </div>
                                </form>
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                    </form>


                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                        <th class="w-10px pe-2">
                                            <div class="form-check form-check-sm form-check-custom form-check-solid me-3">
                                                <input class="form-check-input" type="checkbox" data-kt-check="true" data-kt-check-target="#kt_ecommerce_sales_table .form-check-input" value="1" />
                                            </div>
                                        </th>
                                        <th class="min-w-100px">{{ __('ID') }}</th>
                                        <th class="min-w-175px">{{ __('Customer') }}</th>
                                        <th class="text-end min-w-100px">{{ __('Total') }}</th>
                                        <th class="text-end min-w-100px">{{ __('Date') }}</th>
                                    </tr>
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
                                                    <a href="{{route('restaurant.branch.order',['order'=>$order->id])}}" class="text-gray-800 text-hover-khardl fs-5 fw-bolder">
                                                        {{$order?->manual_order_first_name
                                                        ? $order?->manual_order_first_name . ' ' . $order?->manual_order_last_name
                                                        : $order?->user->fullName}}
                                                        @if($order?->manual_order_first_name)
                                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="{{__('Manual order name')}}"></i>
                                                        @endif
                                                    </a>
                                                    <!--end::Title-->
                                                </div>
                                            </div>
                                        </td>
                                        <!--begin::Total=-->
                                        <td class="text-end pe-0">
                                            <span class="fw-bolder">{{$order->total}} {{__('sar')}}</span>
                                        </td>
                                        <!--end::Total=-->
                                        <!--begin::Date Added=-->
                                        <td class="text-end" data-order="2022-03-22">
                                            <span class="fw-bolder">{{$order->created_at?->format('Y-m-d')}}</span>
                                        </td>
                                        <!--end::Date Added=-->
                                    </tr>
                                    <!--end::Table row-->
                                    @endforeach
                                </tbody>
                                <!--end::Table head-->
                            </table>
                            {{ $orders->withQueryString()->links('pagination::bootstrap-4') }}
                            <!--end::Table-->
                        </div>
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Order history-->

            </div>
            @else
            <div class="alert alert-warning text-center">
                <h4>{{ __('You do not have any online paid orders yet') }}</h4>
            </div>
            @endif

        </div>
    </div>
</div>
