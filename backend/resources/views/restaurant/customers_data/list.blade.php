@extends('layouts.restaurant-sidebar')

@section('title', __('customers-data'))

@section('content')


<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">


    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Referred users-->
            <div class="card">
                <form action="">
                @csrf
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <!--begin::Card title-->
                        <div class="card-title">
                            <h2>{{ __('Customers') }}</h2>
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
                                <input type="text" name="search" value="{{ request('search')??'' }}" class="form-control form-control-solid w-250px ps-14" placeholder="{{__('Name, email, phone, adress')}}" />
                            </div>
                            <div class="w-100 mw-150px">
                                <!--begin::Select2-->
                                <select class="form-select form-select-solid" name="status">
                                    <option value="">{{ __('Status') }}</option>
                                @foreach ($customerStatuses as $status)
                                <option value="{{ $status }}" @if($status==request('status')) {{ 'selected' }} @endif>{{ __($status) }}</option>
                                @endforeach
                                </select>
                                <!--end::Select2-->
                            </div>
                            <button class="btn btn-primary" type="submit">{{ __('Search') }}</button>
                        </div>
                        <!--end::Card toolbar-->
                    </div>
                </form>
                <!--begin::Tab content-->
                <div id="kt_referred_users_tab_content" class="tab-content">
                    <!--begin::Tab panel-->
                    <div id="kt_referrals_1" class="card-body p-0 tab-pane fade show active" role="tabpanel">
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                <!--begin::Table head-->
                                <thead>
                                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                        <th class="min-w-100px">{{ __('ID') }}</th>
                                        <th class="min-w-175px">{{ __('Name') }}</th>
                                        <th class="min-w-70px">{{ __('Phone') }}</th>
                                        <th class="min-w-70px">{{ __('Email') }}</th>
                                        <th class="min-w-70px">{{ __('Status') }}</th>
                                        <th class="min-w-100px">{{ __('Address') }}<i class="fas fa-info-circle"></i></th></th>
                                        <th class="min-w-100px">{{ __('Branch') }}</th>
                                        <th class="min-w-100px">{{ __('Last login') }}</th>
                                        <th class="min-w-100px">{{ __('Registration') }}</th>
                                        <th class="min-w-100px">{{ __('Actions') }}
                                    </tr>
                                </thead>
                                <!--end::Table head-->
                                <!--begin::Table body-->
                                <tbody class="fw-bold text-gray-600">
                                    @foreach ($allCustomers as $customer)
                                    <!--begin::Table row-->
                                    <tr>
                                        <td class="px-2">
                                            <a href="{{ route('customers_data.show',$customer->id) }}">
                                                {{ $customer->id }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('customers_data.show',$customer->id) }}" class="text-gray-600 text-hover-primary">{{ $customer->full_name }}</a>
                                        </td>
                                        <td>{{ $customer->phone }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>
                                            <span class="badge {{ $customer->status }}">{{__("$customer->status")}}</span>
                                        </td>
                                        <td>
                                            <span class="btn-tooltip" data-bs-toggle="tooltip" title="{{ $customer->address }}" data-container="body" data-animation="true" data-bs-toggle="tooltip">{{ Str::limit($customer->address, 20, '...') }}</span>
                                        </td>
                                        <td>{{ $customer->branch?->name }}</td>
                                        <td>{{ $customer->last_login?->format('Y-m-d') }}</td>
                                        <td>{{ $customer->created_at?->format('Y-m-d') }}</td>
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
                                                    <a href="{{route('customers_data.show',['restaurantUser'=>$customer->id])}}" class="menu-link px-3">{{ __('View') }}</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="{{ route('customers_data.edit',['restaurantUser' => $customer->id]) }}" class="menu-link px-3">{{ __('Edit') }}</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" onclick="showConfirmation({{$customer->id}})" class="menu-link px-3">{{__('status')}}</a>
                                                </div>

                                                <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu-->
                                        </td>
                                    </tr>
                                    <!--end::Table row-->
                                    @endforeach
                                </tbody>
                                <!--end::Table head-->
                                <form id="approve-form"  method="POST" style="display: inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" id="orderStatus" >
                                </form>
                                <script>
                                    function showConfirmation(customerId) {
                                        event.preventDefault();
                                        const statusOptions = @json(array_combine(\App\Models\Tenant\RestaurantUser::STATUS,array_map(fn ($status) => __(''.$status), \App\Models\Tenant\RestaurantUser::STATUS)));

                                        Swal.fire({
                                            text: '{{ __('are-you-sure-you-want-to-change-order-status')}}',
                                            icon: 'warning',
                                            input: 'select',
                                            showCancelButton: true,
                                            inputOptions: statusOptions,
                                            inputPlaceholder: 'Select an option',
                                            confirmButtonText: '{{ __('yes') }}',
                                            cancelButtonText: '{{ __('no') }}'
                                        }).then((result) => {
                                            if (result.isConfirmed) {
                                                const selectedStatus = result.value;
                                                document.getElementById('orderStatus').setAttribute('value',selectedStatus);
                                                var form = document.getElementById('approve-form');
                                                form.action = `{{ route('customers_data.change-status', ['restaurantUser' => ':customerId']) }}`.replace(':customerId', customerId)
                                                form.submit();

                                            }
                                        });
                                    }
                                </script>
                                {{ $allCustomers->links('pagination::bootstrap-4') }}
                            </table>
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
