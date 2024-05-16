<div class="row" id="kt_content">

    <!--begin::Post-->
    <div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container">
            <div id="kt_referred_users_tab_content" class="tab-content">
                <!--begin::Tab panel-->

                <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
                    <!--begin::Card header-->
                    <div class="card-header cursor-pointer">
                        <!--begin::Card title-->
                        <div class="card-title m-0 d-flex justify-content-between align-items-center w-100">
                            <div>
                                <h3 class="fw-bolder m-0"> {{ __('orders') }}</h3>
                            </div>
                            <div>
                                <a href="{{route('admin.download.pdf',['type'=>'order','tenant_id'=>$restaurant->id])}}" class="btn btn-khardl">
                                    <i class="fas fa-download me-1 text-black"></i> {{ __('download-all') }}

                                </a>
                            </div>
                        </div>
                        <!--end::Card title-->
                    </div>
                    <div class="card-body  ">
                        <div id="kt_referrals_1" class="card-body p-0 tab-pane fade show active" role="tabpanel">
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table table-flush align-middle table-row-bordered table-row-solid gy-4 gs-9">
                                    <!--begin::Thead-->
                                    <thead class="border-gray-200 fs-5 fw-bold bg-lighten">
                                        <tr>
                                            <th class="min-w-175px ps-9">{{ __('date') }}</th>
                                            <th class="min-w-125px px-0">{{ __('order-id') }}</th>
                                            <th class="min-w-150px px-0">{{ __('status') }}</th>
                                            <th class="min-w-150px px-0">{{ __('name-branch') }}</th>
                                            <th class="min-w-125px">{{ __('total-price') }}</th>
                                            <th class="min-w-125px">{{ __('payment-method') }}</th>
                                            <th class="min-w-125px text-center">{{ __('invoice') }}</th>
                                        </tr>
                                    </thead>
                                    <!--end::Thead-->
                                    <!--begin::Tbody-->
                                    <tbody class="fs-6 fw-bold text-gray-600">
                                        @foreach ($orders as $order)

                                        <tr>
                                            <td class="ps-9">{{ $order->created_at }}</td>
                                            <td class="ps-0">{{ $order->id }}</td>
                                            <td class="ps-0">
                                                <span class="badge {{ $order->status }}">
                                                    {{__("$order->status")}}
                                                </span>
                                            </td>
                                            <td class="ps-0">{{ $order?->branch?->name }}</td>
                                            <td class="text-success">{{ $order->total }}</td>
                                            <td>{{ $order->payment_method?->name }}</td>
                                            <td class="text-center">
                                                <a href="{{route('admin.download.pdf',['type'=>'order','id'=>$order->id,'tenant_id'=>$restaurant->id])}}" class="badge badge-light-khardl p-4 text-hover-khardl bg-hover-khardl">{{ __('download') }}</a>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>

                                    <!--end::Tbody-->
                                </table>
                                {{ $orders->links('pagination::bootstrap-4') }}
                                <!--end::Table-->
                            </div>
                        </div>
                    </div>
                    <!--end::Tab panel-->
                </div>
                <!--end::Tab Content-->
                <!--end::Toolbar wrapper-->

            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
</div>
