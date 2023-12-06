@extends('layouts.view-restaurant-layout')
@section('title', __('messages.view-restaurant'))

@section('body')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">
                
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <div id="kt_referred_users_tab_content" class="tab-content">
                    <!--begin::Tab panel-->
                    
                    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
                        <!--begin::Card header-->
                        <div class="card-header cursor-pointer">
                            <!--begin::Card title-->
                            <div class="card-title m-0 d-flex justify-content-between align-items-center w-100">
                                <div><h3 class="fw-bolder m-0"> {{ __('messages.customers') }}</h3></div>
                                <div>
                                    <a href="{{route('download.pdf',['type'=>'customer','tenant_id'=>$restaurant->id])}}" class="btn btn-khardl">
                                        <i class="fas fa-download me-1 text-black"></i> {{ __('messages.download-all') }}
                                        
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
                                        <th class="min-w-175px ps-9">{{ __('messages.date') }}</th>
                                        <th class="min-w-125px px-0">{{ __('messages.user-id') }}</th>
                                        <th class="min-w-150px px-0">{{ __('messages.name') }}</th>
                                        <th class="min-w-150px px-0">{{ __('messages.email') }}</th>
                                        <th class="min-w-125px">{{ __('messages.phone') }}</th>
                                        <th class="min-w-125px text-center">{{ __('messages.invoice') }}</th>
                                    </tr>
                                </thead>
                                <!--end::Thead-->
                                <!--begin::Tbody-->
                                <tbody class="fs-6 fw-bold text-gray-600">
                                    @foreach ($customers as $customer)
                                    
                                        <tr>
                                            <td class="ps-9">{{ $customer->created_at->format('Y-m-d') }}</td>
                                            <td class="ps-0">{{ $customer->id }}</td>
                                            <td class="ps-0">{{ $customer->full_name }}</td>
                                            <td class="ps-0">{{ $customer->email }}</td>
                                            <td class="text-success">{{ $customer->phone }}</td>
                                            <td class="text-center">
                                                <a href="{{route('download.pdf',['type'=>'customer','id'=>$customer->id,'tenant_id'=>$restaurant->id])}}" class="badge badge-light-khardl p-4 text-hover-khardl bg-hover-khardl">{{ __('messages.download') }}</a>
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
    <!--end::Content-->

    <!--begin::Modal - Delete-->
    <div class="modal fade" id="kt_modal_delete" tabindex="-1" aria-hidden="true">
        <!--begin::Modal dialog-->
        <div class="modal-dialog mw-650px">
            <!--begin::Modal content-->
            <div class="modal-content">
                <!--begin::Modal header-->
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <!--begin::Close-->
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
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
                <div class="modal-body scroll-y mx-5 mx-xl-18 pt-0 pb-15">
                    <!--begin::Heading-->
                    <div class="text-center mb-13">
                        <!--begin::Title-->
                        <h1 class="mb-3">{{ __('messages.are-you-sure') }}</h1>
                        <!--end::Title-->
                        <!--begin::Description-->
                        <div class="text-muted fw-bold fs-5">You won't able to be undo this!</div>
                        <!--end::Description-->
                    </div>
                    <!--end::Heading-->
                    <form action="" method="">
                        <!--begin::select-->
                        <select class="form-select form-control form-control-solid mb-8" name="" id="">
                            <option value="" disabled selected>-- Select an option -- </option>
                            <option value="">Commercial registration</option>
                            <option value="">Deliveery company contract</option>
                            <option value="">Both</option>
                        </select>
                        <!--end::select-->

                        <!--begin::Action-->
                        <div>
                            <a href="" class="btn btn-sm btn-hover-rise btn-primary">Yes, proceed</a>
                            <a href="" class="btn btn-sm btn-hover-rise btn-danger">No, cancel</a>
                        </div>
                        <!--end::Action-->
                    </form>
                </div>
                <!--end::Modal body-->
            </div>
            <!--end::Modal content-->
        </div>
        <!--end::Modal dialog-->
    </div>
    <!--end::Modal - Delete-->
@endsection