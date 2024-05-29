@extends('layouts.restaurant-sidebar')

@section('title', __('orders'))

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
                       <!--begin::Orders-->
<div class="d-flex flex-column gap-7 gap-lg-10">
    <!--begin::Order history-->
    <div class="card card-flush py-4 flex-row-fluid">
        <form action="">
            @csrf
            <div class="modal fade show d-none" id="spinner" tabindex="-1" aria-hidden="false">
                <!--begin::Modal dialog-->
                <div class="modal-dialog modal-dialog-centered mw-650px">
                    <!--begin::Modal content-->
                    <div class="spinner-border m-auto" role="status" >
                        <span class="sr-only">Loading...</span>
                      </div>
                    <!--end::Modal content-->
                </div>
                <!--end::Modal dialog-->
            </div>

            <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                <!--begin::Card title-->
                <div class="card-title">
                    <h2>{{ __('Table reservations') }}</h2>
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
                        <select class="form-select form-select-solid" name="status">
                            <option value="">{{ __('Status') }}</option>
                            <option value="pending" {{ request('status') =='pending' ? 'selected':'' }}>{{ __('Pending') }}</option>
                            <option value="received_by_restaurant" {{ request('status') =='received_by_restaurant' ? 'selected':'' }}>{{ __('received_by_restaurant') }}</option>
                            <option value="ready" {{ request('status') =='ready' ? 'selected':'' }}>{{ __('Ready') }}</option>
                            <option value="accepted" {{ request('status') =='accepted' ? 'selected':'' }}>{{ __('Accepted') }}</option>
                            <option value="completed" {{ request('status') =='completed' ? 'selected':'' }}>{{ __('Completed') }}</option>
                            <option value="cancelled" {{ request('status') =='cancelled' ? 'selected':'' }}>{{ __('Cancelled') }}</option>
                        </select>
                        <!--end::Select2-->
                    </div>
                    <div class="w-100 mw-150px">
                        <!--begin::Select2-->
                        <select class="form-select form-select-solid" name="payment_status">
                            <option value="">{{ __('Payment') }}</option>
                            <option value="paid" {{ request('payment_status') =='paid' ? 'selected':'' }}>{{ __('Paid') }}</option>
                            <option value="pending" {{ request('payment_status') =='pending' ? 'selected':'' }}>{{ __('Pending') }}</option>
                        </select>
                        <!--end::Select2-->
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
                            <th class="text-end min-w-70px">{{ __('Phone') }}</th>
                            <th class="min-w-175px">{{ __('Branch') }}</th>
                            <th class="min-w-175px">{{ __('Status') }}</th>
    
                            <th class="text-end min-w-70px">{{ __('Number of guests') }}</th>
                            <th class="text-end min-w-100px">{{ __('type of reservation') }}</th>
                            <th class="text-end min-w-100px">{{ __('notes') }}</th>
                            <th class="text-end min-w-100px">{{ __('Reservation time') }}</th>
                            <th class="text-end min-w-100px">{{ __('Created at') }}</th>
                            <th class="text-end min-w-100px">
                                <a href="{{ route('restaurant.orders_add') }}">
                                    <button class="btn btn-khardl btn-sm" type="button">
                                        {{ __('Add new') }}
                                    </button>
                                </a>
                            </th>
                        </tr>
                    </thead>
                    <!--end::Table head-->
                    <!--begin::Table body-->
                    <tbody class="fw-bold text-gray-600">
                        @foreach($tables as $table)
                    <!--begin::Table row-->
                    <tr>
                        <!--begin::Checkbox-->
                        <td>
                            <div class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="{{$table->id}}" />
                            </div>
                        </td>
                        <!--end::Checkbox-->
                        <!--begin::Order ID=-->
                        <td data-kt-ecommerce-order-filter="order_id">
                            <a href="{{route('restaurant.branch.order',['order'=>$table->id])}}" class="text-gray-800 text-hover-khardl fw-bolder">{{$table->id}}</a>
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
                                    <a href="{{route('restaurant.branch.order',['order'=>$table->id])}}" class="text-gray-800 text-hover-khardl fs-5 fw-bolder">
                                        {{$table->user->fullName}}
                                    </a>
                                    <!--end::Title-->
                                </div>
                            </div>
                        </td>
                        <td>
                            <div >
                                <!--begin::Title-->
                                <a href="{{route('restaurant.branch.order',['order'=>$table->id])}}" class="text-gray-800 text-hover-khardl fs-5 fw-bolder">
                                    {{$table->user?->phone}}
                                </a>
                                <!--end::Title-->
                            </div>
                        </td>
                        <!--end::Customer=-->
                        <!--begin::Status=-->
           
                        <td  >
                            <!--begin::Badges-->
                            <div> {{$table->branch?->name}}</div>

                            <!--end::Badges-->
                        </td>
                        <!--end::Status=-->
                        <!--begin::Status=-->
                        <td data-order="Refunded">
                            <!--begin::Badges-->
                            <span class="badge {{ $table->status }} ">{{__($table->status)}}</span>
                            <!--end::Badges-->
                        </td>
                        <!--end::Status=-->
                        <td  >
                            <!--begin::Badges-->
                            <div class=""> {{$table->n_of_guests}}</div>

                            <!--end::Badges-->
                        </td>
                     
                      
                        <td>
                            <span >
                                {{__($table->environment)}}
                            </span>
                        </td>
                        <td>
                         
                            <p data-toggle="tooltip" data-placement="top" title="{{$table->note}}" id="test">
                                <span class="d-inline-block text-truncate" style="max-width: 70px;">
                                    {{$table->note}}
                                </span>
                            </p>
                        </td>
                        <td class="text-end" data-order="2022-03-22">
                            <span class="fw-bolder">{{Carbon\Carbon::parse($table->date_time)->format('d-m-y h:i A')}}</span>
                        </td>
                        <!--begin::Date Added=-->
                        <td class="text-end" data-order="2022-03-22">
                            <span class="fw-bolder">{{$table->created_at?->format('Y-m-d')}}</span>
                        </td>
                        <!--end::Date Added=-->
                        <!--begin::Action=-->
                        <td class="text-end">
                            <a href="#" class="btn btn-sm btn-active-light-khardl" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">{{ __('Actions') }}
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
                                    <a href="{{route('restaurant.branch.order',['order'=>$table->id])}}" class="menu-link px-3">{{ __('View') }}</a>
                                </div>
                                <!--end::Menu item-->

                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                {{-- <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">Delete</a>
                                </div> --}}
                                {{-- @if($order->status != \App\Models\Tenant\Order::CANCELLED && $order->status != \App\Models\Tenant\Order::COMPLETED && $order->status != \App\Models\Tenant\Order::REJECTED  )
                                    <div class="menu-item px-3">
                                        <a href="#" onclick='showConfirmation("{{$order->id}}","{{$order->status}}")' class="menu-link px-3" >{{__('Changes status')}}</a>
                                    </div>
                                @endif --}}

                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                        </td>
                        <!--end::Action=-->
                    </tr>
                    <!--end::Table row-->
                @endforeach
                    </tbody>
                    <!--end::Table head-->
                </table>
               
         
                {{ $tables->withQueryString()->links('pagination::bootstrap-4') }}
          
            </div>
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Order history-->

</div>

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
@push('styles')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

@endpush
@section('js')

<script>
    $(document).ready(function() {
        $('#test').tooltip('enable');
    });
</script>
@endsection