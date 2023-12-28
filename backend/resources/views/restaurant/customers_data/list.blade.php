@extends('layouts.restaurant-sidebar')

@section('title', __('messages.customers-data'))

@section('content')


<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">


    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
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
            </div>
            <!--begin::Referred users-->
            <div class="card">
                <!--begin::Tab content-->
                <div id="kt_referred_users_tab_content" class="tab-content">
                    <!--begin::Tab panel-->
                    <div id="kt_referrals_1" class="card-body p-0 tab-pane fade show active" role="tabpanel">
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table table-row-bordered table-flush align-middle gy-6">
                                <!--begin::Thead-->
                                <thead class="border-bottom border-gray-200 fs-6 fw-bolder bg-lighten">
                                    <tr>
                                        <th class="min-w-50px ps-5">ID</th>
                                        <th class="min-w-100px px-0">Name</th>
                                        <th class="min-w-100px px-0">Phone</th>
                                        <th class="min-w-100px px-0">Eamil</th>
                                        <th class="min-w-100px px-0">Status</th>
                                        <th class="min-w-100px px-0">Adress</th>
                                        <th class="min-w-100px px-0">Branch</th>
                                        <th class="min-w-100px px-0">Last login</th>
                                        <th class="min-w-125px text-center">Registration <br> date</th>
                                    </tr>
                                </thead>
                                <!--end::Thead-->
                                <!--begin::Tbody-->
                                <tbody class="fs-6 fw-bold text-gray-600">
                                    @foreach ($allCustomers as $customer)
                                    <tr>
                                        <td class="px-2">
                                            <a href="{{ route('customers_data.show',$customer->id) }}">
                                                {{ $customer->id }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="" class="text-gray-600 text-hover-primary">{{ $customer->full_name }}</a>
                                        </td>
                                        <td>{{ $customer->phone }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>
                                            <span class="badge {{ $customer->status }}">{{__("messages.$customer->status")}}</span>
                                        </td>
                                        <td>{{ $customer->address }}</td>
                                        <td>{{ $customer->branch?->name }}</td>
                                        <td>{{ $customer->last_login?->format('Y-m-d') }}</td>
                                        <td>{{ $customer->created_at?->format('Y-m-d') }}</td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-sm btn-active-light-khardl" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
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
                                                    <a href="{{route('customers_data.show',['restaurantUser'=>$customer->id])}}" class="menu-link px-3">View</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">Edit</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                {{-- <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3" data-kt-ecommerce-order-filter="delete_row">Delete</a>
                                                </div> --}}
                                                <div class="menu-item px-3">
                                                    <a href="#" onclick="showConfirmation({{$customer->id}})" class="menu-link px-3">{{__('messages.status')}}</a>
                                                </div>

                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu-->
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <!--end::Tbody-->
                            </table>
                            {{-- TODO:Change status --}}
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
                            {{ $allCustomers->links('pagination::bootstrap-4') }}
                            <!--end::Table-->
                        </div>
                    </div>
                    <!--end::Tab panel-->

                </div>
                <!--end::Tab content-->
            </div>
            <!--end::Referred users-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>

@endsection
