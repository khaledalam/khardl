@extends('layouts.restaurant-sidebar')

@section('title', __('Unavailable products'))

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
                        <input type="text" data-kt-ecommerce-order-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="{{__('search')}}" />
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
                                    <tr class="px-3">
                                        <th>{{ __('ID') }}</th>
                                        <th>{{ __('Image') }}</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Price') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Category') }}</th>
                                        <th>{{ __('Branch') }}</th>
                                        <th>{{ __('User') }}</th>
                                        <th>{{ __('Calories') }}</th>
                                        <th>{{ __('Created at') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <!--end::Thead-->
                                <!--begin::Tbody-->
                                <tbody class="fs-6 fw-bold text-gray-600">
                                    @foreach ($products as $product)
                                    <tr class="px-3">
                                        <td class="px-2">
                                            <a href="#">
                                                {{ $product->id }}
                                            </a>
                                        </td>
                                        <td>
                                            <div class="form-check form-check-custom form-check-solid mx-5">
                                                <a href="#" class="symbol symbol-50px">
                                                    <span class="symbol-label" style="background-image:url({{$product->photo}});"></span>
                                                </a>
                                            </div>
                                        </td>
                                        <td class="px-2">
                                            <span>{{ $product->name }}</span>
                                        </td>
                                        <td class="px-2">
                                            <span>{{ $product->price }}</span>
                                        </td>
                                        <td class="px-2">
                                            <span>
                                                <label class="switch">
                                                    <input type="checkbox" onclick="toggleAvailability({{ $product->id }})">
                                                    <span class="slider"></span>
                                                </label>
                                            </span>
                                        </td>
                                        <td>
                                            <a href="{{ route('restaurant.get-category',['id'=> $product->category,'branchId'=> $product->branch_id]) }}" class="text-gray-600 text-hover-primary">
                                                {{ $product->category->name }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ route('restaurant.menu',['branchId'=> $product->branch_id]) }}" class="text-gray-600 text-hover-primary">
                                                {{ $product->branch->name }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="#" class="text-gray-600 text-hover-primary">
                                                {{ $product->user->first_name }}
                                            </a>
                                        </td>
                                        <td class="px-2">
                                            <span>{{ $product->calories }}</span>
                                        </td>
                                        <td class="px-2">
                                            <span>{{ $product->created_at?->format('Y-m-d') }}</span>
                                        </td>
                                        {{-- <td>{{ $customer->phone }}</td>
                                        <td>{{ $customer->email }}</td>
                                        <td>
                                            <span class="badge {{ $customer->status }}">{{__("$customer->status")}}</span>
                                        </td>
                                        <td>{{ $customer->address }}</td>
                                        <td>{{ $customer->branch?->name }}</td>
                                        <td>{{ $customer->last_login?->format('Y-m-d') }}</td>
                                        <td>{{ $customer->created_at?->format('Y-m-d') }}</td> --}}
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
                                                    <a href="#" class="menu-link px-3">{{ __('View') }}</a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="#" class="menu-link px-3">{{ __('Edit') }}</a>
                                                </div>
                                            </div>
                                            <!--end::Menu-->
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <!--end::Tbody-->
                            </table>
                            {{ $products->links('pagination::bootstrap-4') }}
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
@section('js')
<script>
    function toggleAvailability(itemId,availability) {
        $.ajax({
                url: `{{ route('restaurant.change-availability', ['item' => ':itemId']) }}`.replace(':itemId', itemId),
                type: 'POST',
                dataType: 'json',
                data: {
                    '_token': '{{ csrf_token() }}',
                    'availability': availability,
                },
                success: function (response) {

                },
                error: function (error) {
                    console.error('Error toggling user status:', error);
                }
            });
    }

</script>
@endsection
