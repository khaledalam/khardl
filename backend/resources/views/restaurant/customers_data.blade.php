@extends('layouts.restaurant-sidebar')

@section('title', __('messages.customers-data'))

@section('content')


                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">


                    <!--begin::Post-->
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <!--begin::Container-->
                        <div id="kt_content_container" class="container-xxl">

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
                                                    <th class="min-w-25px ps-5">ID</th>
                                                    <th class="min-w-100px px-0">Name</th>
                                                    <th class="min-w-100px px-0">Phone</th>
                                                    <th class="min-w-100px px-0">Eamil</th>
                                                    <th class="min-w-50px px-0">Wallet</th>
                                                    <th class="min-w-25px px-0 text-center">Total <br> money spent</th>
                                                    <th class="min-w-25px px-0 text-center">Total <br> loyalty spent</th>
                                                    <th class="min-w-25px px-0 text-center">Total <br> Cashback</th>
                                                    <th class="min-w-75px ps-0 text-center">Last <br> Order</th>
                                                    <th class="min-w-125px text-center">Registration <br> date</th>
                                                </tr>
                                                </thead>
                                                <!--end::Thead-->
                                                <!--begin::Tbody-->
                                                <tbody class="fs-6 fw-bold text-gray-600">
                                                <tr>
                                                    <td class="ps-5">1</td>
                                                    <td class="ps-0">
                                                        <a href="" class="text-gray-600 text-hover-primary">Marcus Harris</a>
                                                    </td>
                                                    <td>123456789</td>
                                                    <td>email@email.com</td>
                                                    <td class="text-success text-center">$1,500.00 <a href="#" data-bs-toggle="modal" data-bs-target="#kt_modal_pop_registeration">
                                                            <i class="fas fa-plus"></i>
                                                        </a></td>
                                                    <td class="text-success text-center">$1,200.00</td>
                                                    <td class="text-dark text-center">100 / 400</td>
                                                    <td class="text-success text-center">$1,200.00</td>
                                                    <td class="text-success text-center">$1,200.00</td>
                                                    <td class="text-dark text-center">2023-03-29</td>
                                                </tr>
                                                </tbody>
                                                <!--end::Tbody-->
                                            </table>
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
                <!--end::Content-->
            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Page-->
    </div>
    <!--end::Root-->

    <!--begin::Modal -registeration-->
    <div class="modal fade" id="kt_modal_pop_registeration" tabindex="-1" aria-hidden="true">
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
                    <form id="kt_modal_bidding_form" class="form" action="#">
                        <!--begin::Heading-->
                        <div class="mb-13 text-center">
                            <!--begin::Title-->
                            <h1 class="mb-3">Add funds</h1>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <input type="text" class="form-control form-control-solid" placeholder="Add funds" name="bid_funds" />
                        </div>
                        <!--end::Input group-->

                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="reset" class="btn btn-light me-3" data-kt-modal-action-type="cancel">Cancel</button>
                            <button type="submit" class="btn btn-primary" data-kt-modal-action-type="submit">
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
    <!--end::Modal -registeration-->

    <!--begin::Javascript-->
    <script>
        var hostUrl = "../assets/";
    </script>
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="../assets/plugins/global/plugins.bundle.js"></script>
{{--    <script src="../assets/js/scripts.bundle.js"></script>--}}
    <!--end::Global Javascript Bundle-->
    <!--begin::Page Vendors Javascript(used by this page)-->
{{--    <script src="../assets/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>--}}
{{--    <script src="../assets/plugins/custom/datatables/datatables.bundle.js"></script>--}}
    <!--end::Page Vendors Javascript-->
    <!--begin::Page Custom Javascript(used by this page)-->
{{--    <script src="../assets/js/widgets.bundle.js"></script>--}}
{{--    <script src="../assets/js/custom/widgets.js"></script>--}}
{{--    <script src="../assets/js/custom/apps/chat/chat.js"></script>--}}
{{--    <script src="../assets/js/custom/utilities/modals/upgrade-plan.js"></script>--}}
{{--    <script src="../assets/js/custom/utilities/modals/create-app.js"></script>--}}
{{--    <script src="../assets/js/custom/utilities/modals/users-search.js"></script>--}}
    <!--end::Page Custom Javascript-->

@endsection
