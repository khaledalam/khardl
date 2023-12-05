@extends('layouts.admin-sidebar')
@section('title', __('messages.view-restaurant'))

@section('content')

    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">

        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Navbar-->
                <div class="card mb-5 mb-xl-10">
                    <div class="card-body pt-9 pb-0">
                        <!--begin::Details-->
                        <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                            <!--begin: Pic-->
                            <div class="me-7 mb-4">
                                <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">

                                    <img alt="Logo" src="{{ $logo ?? global_asset('img/logo.png') }}" />

                                    @if($is_live)<div class="position-absolute translate-middle bottom-0 start-100 mb-6 bg-success rounded-circle border border-4 border-white h-20px w-20px"></div>@endif

                                </div>
                            </div>
                            <!--end::Pic-->
                            <!--begin::Info-->
                            <div class="flex-grow-1">
                                <!--begin::Title-->
                                <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                    <!--begin::User-->
                                    <div class="d-flex flex-column">
                                        <!--begin::Name-->
                                        <div class="d-flex align-items-center mb-2">

                                            <a class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1">{{  $restaurant->restaurant_name }}
                                            </a>
                                            <a>
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen026.svg-->
                                                @if ($is_live)
                                                <span class="svg-icon svg-icon-1 svg-icon-primary">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24px" height="24px" viewBox="0 0 24 24">
                                                        <path d="M10.0813 3.7242C10.8849 2.16438 13.1151 2.16438 13.9187 3.7242V3.7242C14.4016 4.66147 15.4909 5.1127 16.4951 4.79139V4.79139C18.1663 4.25668 19.7433 5.83365 19.2086 7.50485V7.50485C18.8873 8.50905 19.3385 9.59842 20.2758 10.0813V10.0813C21.8356 10.8849 21.8356 13.1151 20.2758 13.9187V13.9187C19.3385 14.4016 18.8873 15.491 19.2086 16.4951V16.4951C19.7433 18.1663 18.1663 19.7433 16.4951 19.2086V19.2086C15.491 18.8873 14.4016 19.3385 13.9187 20.2758V20.2758C13.1151 21.8356 10.8849 21.8356 10.0813 20.2758V20.2758C9.59842 19.3385 8.50905 18.8873 7.50485 19.2086V19.2086C5.83365 19.7433 4.25668 18.1663 4.79139 16.4951V16.4951C5.1127 15.491 4.66147 14.4016 3.7242 13.9187V13.9187C2.16438 13.1151 2.16438 10.8849 3.7242 10.0813V10.0813C4.66147 9.59842 5.1127 8.50905 4.79139 7.50485V7.50485C4.25668 5.83365 5.83365 4.25668 7.50485 4.79139V4.79139C8.50905 5.1127 9.59842 4.66147 10.0813 3.7242V3.7242Z" fill="#00A3FF" />
                                                        <path class="permanent" d="M14.8563 9.1903C15.0606 8.94984 15.3771 8.9385 15.6175 9.14289C15.858 9.34728 15.8229 9.66433 15.6185 9.9048L11.863 14.6558C11.6554 14.9001 11.2876 14.9258 11.048 14.7128L8.47656 12.4271C8.24068 12.2174 8.21944 11.8563 8.42911 11.6204C8.63877 11.3845 8.99996 11.3633 9.23583 11.5729L11.3706 13.4705L14.8563 9.1903Z" fill="white" />
                                                    </svg>
                                                </span>
                                                @endif
                                                <!--end::Svg Icon-->
                                            </a>
                                        </div>
                                        <!--end::Name-->
                                        <!--begin::Info-->
                                        <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
                                            <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                            <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                                            <span class="svg-icon svg-icon-4 me-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="currentColor" />
                                                    <path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->{{  $owner->first_name }} {{  $owner->last_name }}</a>
                                            {{-- <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary me-5 mb-2">
                                            <!--begin::Svg Icon | path: icons/duotune/general/gen018.svg-->
                                            <span class="svg-icon svg-icon-4 me-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M18.0624 15.3453L13.1624 20.7453C12.5624 21.4453 11.5624 21.4453 10.9624 20.7453L6.06242 15.3453C4.56242 13.6453 3.76242 11.4453 4.06242 8.94534C4.56242 5.34534 7.46242 2.44534 11.0624 2.04534C15.8624 1.54534 19.9624 5.24534 19.9624 9.94534C20.0624 12.0453 19.2624 13.9453 18.0624 15.3453Z" fill="currentColor" />
                                                    <path d="M12.0624 13.0453C13.7193 13.0453 15.0624 11.7022 15.0624 10.0453C15.0624 8.38849 13.7193 7.04535 12.0624 7.04535C10.4056 7.04535 9.06241 8.38849 9.06241 10.0453C9.06241 11.7022 10.4056 13.0453 12.0624 13.0453Z" fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->SA, Al-Riyadh</a> --}}
                                            <a href="#" class="d-flex align-items-center text-gray-400 text-hover-primary mb-2">
                                            <!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
                                            <span class="svg-icon svg-icon-4 me-1">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z" fill="currentColor" />
                                                    <path d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z" fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->{{ $restaurant->email }}</a>
                                        </div>
                                        <!--end::Info-->
                                    </div>
                                    <!--end::User-->

                                </div>
                                <!--end::Title-->
                                <!--begin::Stats-->

                                    <div class="d-flex flex-wrap flex-stack">
                                        <!--begin::Wrapper-->
                                        @if ($is_live)
                                            <div class="d-flex flex-column flex-grow-1 pe-8">
                                                <!--begin::Stats-->
                                                <div class="d-flex flex-wrap">
                                                    <!--begin::Stat-->
                                                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                        <!--begin::Number-->
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
                                                            <span class="svg-icon svg-icon-3 svg-icon-success me-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
                                                                    <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                            <div class="fs-2 fw-bolder" data-kt-countup="true" data-kt-countup-value="0" data-kt-countup-prefix="$">0</div>  <!-- data-kt-countup-value="3500" -->
                                                        </div>
                                                        <!--end::Number-->
                                                        <!--begin::Label-->
                                                        <div class="fw-bold fs-6 text-gray-400">{{ __('messages.earnings')}}</div>
                                                        <!--end::Label-->
                                                    </div>
                                                    <!--end::Stat-->
                                                    <!--begin::Stat-->
                                                    <div class="border border-gray-300 border-dashed rounded min-w-125px py-3 px-4 me-6 mb-3">
                                                        <!--begin::Number-->
                                                        <div class="d-flex align-items-center">
                                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr065.svg-->
                                                            <span class="svg-icon svg-icon-3 svg-icon-danger me-2">
                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                    <rect opacity="0.5" x="11" y="18" width="13" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
                                                                    <path d="M11.4343 15.4343L7.25 11.25C6.83579 10.8358 6.16421 10.8358 5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75L11.2929 18.2929C11.6834 18.6834 12.3166 18.6834 12.7071 18.2929L18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25C17.8358 10.8358 17.1642 10.8358 16.75 11.25L12.5657 15.4343C12.2533 15.7467 11.7467 15.7467 11.4343 15.4343Z" fill="currentColor" />
                                                                </svg>
                                                            </span>
                                                            <!--end::Svg Icon-->
                                                            <div class="fs-2 fw-bolder" data-kt-countup="true" data-kt-countup-value="0">0</div> <!--  data-kt-countup-value="150" -->
                                                        </div>
                                                        <!--end::Number-->
                                                        <!--begin::Label-->
                                                        <div class="fw-bold fs-6 text-gray-400">{{ __('messages.orders')}}</div>
                                                        <!--end::Label-->
                                                    </div>
                                                    <!--end::Stat-->
                                                    <!--begin::Stat-->

                                                </div>
                                                <!--end::Stats-->
                                            </div>
                                            <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
                                                <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                                    <span class="fw-bold fs-6 text-black fw-bolder">Site end date :</span>
                                                    <span class="badge badge-dark p-2 fs-6">2025-07-09</span>
                                                </div>
                                                <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                                    <span class="fw-bold fs-6 text-black fw-bolder">App end date :</span>
                                                    <span class="badge badge-dark p-2 fs-6">2024-12-08</span>
                                                </div>
                                            </div>
                                            <!--end::Wrapper-->
                                            <!--begin::Progress-->
                                            <div class="d-flex align-items-center w-200px w-sm-300px flex-column mt-3">
                                                @if (!is_null($restaurant->website_expire))
                                                    <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                                        <span class="fw-bold fs-6 text-black fw-bolder">{{ __('messages.site-end-date')}}</span>
                                                        <span class="badge badge-dark p-2 fs-6">{{$restaurant->website_expire}}</span>
                                                    </div>
                                                @endif
                                                @if (!is_null($restaurant->mobile_expire))
                                                    <div class="d-flex justify-content-between w-100 mt-auto mb-2">
                                                        <span class="fw-bold fs-6 text-black fw-bolder">{{ __('messages.app-end-date')}}</span>
                                                        <span class="badge badge-dark p-2 fs-6">{{ $restaurant->mobile_expire}}</span>
                                                    </div>
                                                @endif
                                            </div>
                                        @elseif (!$is_live)
                                        <div class="d-flex justify-content-between align-items-center">
                                            @if($user?->hasPermission('can_approve_restaurants'))
                                                <a onclick="showConfirmation()" class="badge badge-light-success  text-hover-white bg-hover-success p-5 m-3" >{{ __('messages.approve')}}</a>
                                                <form id="approve-form" action="{{ route('admin.restaurant.activate', ['restaurant' => $restaurant->id]) }}" method="POST" style="display: inline">
                                                    @csrf
                                                    @method('PUT')

                                                </form>
                                                <script>
                                                    function showConfirmation() {
                                                        event.preventDefault();

                                                        Swal.fire({
                                                            title: '{{ __('messages.confirm-approval') }}',
                                                            text: '{{ __('messages.are-you-sure-you-want-to-approve-this-restaurant') }}',
                                                            icon: 'warning',
                                                            showCancelButton: true,
                                                            confirmButtonText: '{{ __('messages.yes-approve-it') }}',
                                                            cancelButtonText: '{{ __('messages.cancel') }}'
                                                        }).then((result) => {
                                                            if (result.isConfirmed) {
                                                                document.getElementById('approve-form').submit();
                                                            }
                                                        });
                                                    }
                                                </script>
                                            @endif

                                            <form action="{{ route('admin.denyUser', ['id' => $restaurant->id]) }}" method="POST" style="display: inline">
                                                @csrf
                                                <button style="border: 0;" type="submit" class="badge badge-light-danger btn-confirm text-hover-white bg-hover-danger p-5 m-3">{{ __('messages.deny')}}</button>
                                            </form>
                                            <script>
                                                document.addEventListener('DOMContentLoaded', function() {
                                                    var confirmButtons = document.querySelectorAll('.btn-confirm');

                                                    confirmButtons.forEach(function(button) {
                                                        button.addEventListener('click', function(event) {
                                                            event.preventDefault();

                                                            Swal.fire({
                                                                title: "{{ __('messages.you-wont-be-able-to-undo-this') }}",
                                                                showCancelButton: true,
                                                                confirmButtonText: '{{ __('messages.yes-proceed') }}',
                                                                cancelButtonText: '{{ __('messages.no-cancel') }}',
                                                                html: `
                                                                    <div class="form-check">
                                                                        <input type="checkbox" class="form-check-input" id="option1" name="options[]" value="option1">
                                                                        <label class="form-check-label" for="option1">{{ __('messages.commercial-registration-number') }}</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input type="checkbox" class="form-check-input" id="option2" name="options[]" value="option2">
                                                                        <label class="form-check-label" for="option2">{{ __('messages.delivery-company-contract') }}</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input type="checkbox" class="form-check-input" id="option3" name="options[]" value="option3">
                                                                        <label class="form-check-label" for="option3">{{ __('messages.tax-number') }}</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input type="checkbox" class="form-check-input" id="option4" name="options[]" value="option4">
                                                                        <label class="form-check-label" for="option4">{{ __('messages.bank-certificate') }}</label>
                                                                    </div>
                                                                `,
                                                                preConfirm: function() {
                                                                    var selectedOptions = [];
                                                                    document.querySelectorAll('input[name="options[]"]:checked').forEach(function(checkbox) {
                                                                        selectedOptions.push(checkbox.value);
                                                                    });
                                                                    return selectedOptions;
                                                                },
                                                                allowOutsideClick: false,
                                                                allowEscapeKey: false
                                                            }).then((result) => {
                                                                if (result.isConfirmed && result.value.length > 0) {
                                                                    var form = event.target.closest('form');
                                                                    var selectedOptions = result.value;
                                                                    selectedOptions.forEach(function(option) {
                                                                        form.insertAdjacentHTML('beforeend', '<input type="hidden" name="options[]" value="' + option + '">');
                                                                    });
                                                                    form.submit();
                                                                }
                                                            });
                                                        });
                                                    });
                                                });


                                            </script>


                                        </div>
                                        @endif
                                        <!--end::Progress-->
                                    </div>

                                <!--end::Stats-->
                            </div>
                            <!--end::Info-->
                        </div>
                        <!--end::Details-->
                        <div class="d-flex justify-content-between align-items-center">
                            <!--begin::Navs-->
                            <ul class="nav nav-stretch nav-line-tabs nav-line-tabs-2x border-transparent fs-5 fw-bolder">
                                <!--begin::Nav item-->
                                <li class="nav-item mt-2">
                                    <a class="nav-link text-active-primary ms-0 me-10 py-5 {{$widget == 'overview' ? 'active':''}}" href="{{ route('admin.view-restaurants', ['id' => $restaurant->id])}}">{{ __('messages.overview')}}</a>
                                </li>
                                <!--end::Nav item-->
                                <!--begin::Nav item-->
                                @if ($is_live)

                                    <li class="nav-item mt-2">
                                        <a class="nav-link text-active-primary ms-0 me-10 py-5 {{$widget == 'orders' ? 'active':''}}" href="{{ route('admin.view-restaurants-orders', ['id' => $restaurant->id]) }}">{{ __('messages.orders')}}</a>
                                    </li>
                                    <!--end::Nav item-->
                                    <!--begin::Nav item-->
                                    <li class="nav-item mt-2">
                                        <a class="nav-link text-active-primary ms-0 me-10 py-5 {{$widget == 'customers' ? 'active':''}}" href="#">{{ __('messages.customers')}}</a>
                                    </li>
                                @endif
                                <!--end::Nav item-->
                                <!--begin::Nav item-->
                                <!-- <li class="nav-item mt-2">
                                    <a class="nav-link text-active-primary ms-0 me-10 py-5" href="./logs.html">Logs</a>
                                </li> -->
                                <!--end::Nav item-->
                            </ul>
                            <!--begin::Navs-->
                        </div>
                    </div>
                </div>

                @yield('body')


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
                        <h1 class="mb-3">Are you sure ?</h1>
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
