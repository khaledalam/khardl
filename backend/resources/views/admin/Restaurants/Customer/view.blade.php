
<div class="row" id="kt_content">

    <!--begin::Post-->
    <div class="col-md-12" id="kt_post">
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
                                <h3 class="fw-bolder m-0"> {{ __('customers') }}</h3>
                            </div>
                            <div>
                                <a href="{{route('admin.download.pdf',['type'=>'customer','tenant_id'=>$restaurant->id])}}" class="btn btn-khardl">
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
                                            <th class="min-w-175px ps-9">{{ __('date-and-time') }}</th>
                                            <th class="min-w-125px px-0">{{ __('user-id') }}</th>
                                            <th class="min-w-150px px-0">{{ __('name') }}</th>
                                            <th class="min-w-150px px-0">{{ __('email') }}</th>
                                            <th class="min-w-125px">{{ __('phone') }}</th>
                                            <th class="min-w-125px text-center">{{ __('Download file') }}</th>
                                        </tr>
                                    </thead>
                                    <!--end::Thead-->
                                    <!--begin::Tbody-->
                                    <tbody class="fs-6 fw-bold text-gray-600">
                                        @foreach ($customers as $customer)

                                        <tr>
                                            <td class="ps-9">{{ $customer->created_at->format('Y-m-d H:i:s') }}</td>
                                            <td class="ps-0">{{ $customer->id }}</td>
                                            <td class="ps-0">{{ $customer->full_name }}</td>
                                            <td class="ps-0">{{ $customer->email }}</td>
                                            <td class="text-success">{{ $customer->phone }}</td>
                                            <td class="text-center">
                                                <a href="{{route('admin.download.pdf',['type'=>'customer','id'=>$customer->id,'tenant_id'=>$restaurant->id])}}" class="badge badge-light-khardl p-4 text-hover-khardl bg-hover-khardl">{{ __('download') }}</a>
                                            </td>
                                        </tr>
                                        @endforeach

                                    </tbody>

                                    <!--end::Tbody-->
                                </table>
                                {{ $customers->links('pagination::bootstrap-4') }}
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

