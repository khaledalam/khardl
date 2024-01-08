@extends('layouts.restaurant-sidebar')

@section('title', 'Promotions')

@section('content')


    <!--begin::Body-->

    <body id="kt_body"
          class="header-fixed header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="
      --kt-toolbar-height: 55px;
      --kt-toolbar-height-tablet-and-mobile: 55px;
    ">
    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">

            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid" id="kt_wrapper">


                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">
                    <!--begin::Post-->
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <!--begin::Container-->
                        <div id="kt_content_container" class="container-xxl">
                            <!--begin::Row-->
                            <div class="row g-12 g-xl-12 mb-xl-112">

                                <div class="col-md-12 col-lg-12 mb-md-4 mb-xl-0">
                                    <!--begin::Card widget 4-->
                                    <div class="card card-flush h-md-100 mb-5 mb-xl-0">
                                        <!--begin::Form-->
                                        <form id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row"
                                              action="{{route('promotions.save-settings')}}" method="POST">

                                            <!--begin::main column-->
                                            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                                                <!--begin::tab content-->
                                                <div class="tab-content">
                                                    <!--begin::tab pane-->
                                                    <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                                                        <div class="d-flex flex-column gap-7 gap-lg-10">
                                                            <!--begin::general options-->
                                                            <div class="card card-flush py-4">
                                                                <!--begin::card header-->
                                                                <div class="card-header">
                                                                    <div class="card-title">
                                                                        <h2>loyalty points</h2>
                                                                    </div>
                                                                </div>
                                                                <!--end::card header-->
                                                                <!--begin::card body-->
                                                                <div class="card-body pt-0">
                                                                    <!--begin::input group-->
                                                                    <div class="fv-row">
                                                                        <!--begin::label-->
                                                                        <label class="required form-label">loyalty points</label>
                                                                        <!--end::label-->
                                                                        <!--begin::input-->
                                                                        <input type="number" name="loyalty_points" class="form-control mb-2" placeholder="e.x. 60" value="{{$settings['loyalty_points']}}"/>
                                                                        <!--end::input-->
                                                                    </div>
                                                                    <!--end::input group-->
                                                                    <div class="text-center mt-5 mb-5">
                                                                        <span>=</span>
                                                                    </div>
                                                                    <!--begin::input group-->
                                                                    <div class="mb-10 fv-row">
                                                                        <!--begin::label-->
                                                                        <label class="required form-label">{{__('messages.sar')}}</label>
                                                                        <!--end::label-->
                                                                        <!--begin::input-->
                                                                        <input type="number" name="loyalty_point_price" class="form-control mb-2" placeholder="e.x. 25{{__('messages.sar')}}" value="{{$settings['loyalty_point_price']}}" />
                                                                        <!--end::input-->
                                                                    </div>
                                                                    <!--end::input group-->


                                                                </div>
                                                                <!--end::card header-->
                                                            </div>
                                                            <!--end::general options-->
                                                        </div>
                                                    </div>
                                                    <!--end::tab pane-->
                                                </div>

                                            </div>
                                            <!--end::main column-->

                                            <!--begin::Main column-->
                                            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                                                <!--begin::Tab content-->
                                                <div class="tab-content">
                                                    <!--begin::Tab pane-->
                                                    <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                                                        <div class="d-flex flex-column gap-7 gap-lg-10">
                                                            <!--begin::General options-->
                                                            <div class="card card-flush py-4">
                                                                <!--begin::Card header-->
                                                                <div class="card-header">
                                                                    <div class="card-title">
                                                                        <h2>Cash-back</h2>
                                                                    </div>
                                                                </div>
                                                                <!--end::Card header-->
                                                                <!--begin::Card body-->
                                                                <div class="card-body pt-0">
                                                                    <!--begin::Input group-->
                                                                    <div class="fv-row">
                                                                        <!--begin::Label-->
                                                                        <label class="required form-label">Threshold</label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <input type="number" name="cashback_threshold" class="form-control mb-2" placeholder="e.x. 50" value="{{$settings['cashback_threshold']}}"/>
                                                                        <!--end::Input-->
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                    <!--begin::Input group-->
                                                                    <div class="mb-10 mt-1 fv-row">
                                                                        <!--begin::Input-->
                                                                    {{--                                                                        <input type="checkbox" name="threshold" id="threshold"/>--}}
                                                                    {{--                                                                        <!--end::Input-->--}}
                                                                    {{--                                                                        <!--begin::Label-->--}}
                                                                    {{--                                                                        <label class="form-label" for="threshold">Enable threshold</label>--}}
                                                                    <!--end::Label-->
                                                                    </div>
                                                                    <!--end::Input group-->
                                                                    <!--begin::Input group-->
                                                                    <div class="mb-10 fv-row">
                                                                        <!--begin::Label-->
                                                                        <label class="required form-label">Money back %</label>
                                                                        <!--end::Label-->
                                                                        <!--begin::Input-->
                                                                        <input type="number" name="cashback_percentage" class="form-control mb-2" placeholder="e.x. 5%" value="{{$settings['cashback_percentage']}}"/>
                                                                        <!--end::Input-->
                                                                    </div>
                                                                    <!--end::Input group-->

                                                                </div>
                                                                <!--end::Card header-->
                                                            </div>
                                                            <!--end::General options-->
                                                        </div>
                                                    </div>
                                                    <!--end::Tab pane-->
                                                </div>

                                            </div>
                                            <!--end::Main column-->

                                            <!--begin::Actions-->
                                            <div class="d-flex justify-content-end">
{{--                                                <button type="reset" class="btn btn-sm btn-light fw-bolder btn-active-light-khardl me-2" data-kt-search-element="advanced-options-form-cancel">Cancel</button>--}}
                                                <button type="submit" class="btn btn-sm btn-light fw-bolder btn btn-sm fw-bolder btn-khardl me-2" data-kt-search-element="advanced-options-form-cancel">{{__('messages.save')}}</button>
                                            </div>
                                            <!--end::Actions-->

                                        </form>
                                        <!--end::Form-->
                                    </div>
                                    <!--end::Card widget 4-->
                                </div>

                            </div>
                            <!--end::Modals-->
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
    <!--end::Main-->


    <!--begin::Javascript-->
    <script>
        const enableUsesCheckbox = document.getElementById('enableUses');
        const usesInput = document.querySelector('[name="uses"]');

        enableUsesCheckbox.addEventListener('change', function () {
            const isChecked = enableUsesCheckbox.checked;

            usesInput.disabled = isChecked;

            if (isChecked) {
                usesInput.value = ''; // Clear the value when disabled
            }
        });
    </script>


    <!-- Checked -->
    <script>
        const percentageInput = document.getElementById('percentageInput');
        const sarInput = document.getElementById('sarInput');

        const percentageRadio = document.getElementById('kt_create_account_form_account_type_percentage');
        const sarRadio = document.getElementById('kt_create_account_form_account_type_sar');

        percentageRadio.addEventListener('change', () => {
            if (percentageRadio.checked) {
                percentageInput.disabled = false;
                sarInput.disabled = true;
                sarInput.value = ''; // Clear the value when disabled
            }
        });

        sarRadio.addEventListener('change', () => {
            if (sarRadio.checked) {
                sarInput.disabled = false;
                percentageInput.disabled = true;
                percentageInput.value = ''; // Clear the value when disabled
            }
        });

        const percentageLabel = document.querySelector('[for="kt_create_account_form_account_type_percentage"]');
        const sarLabel = document.querySelector('[for="kt_create_account_form_account_type_sar"]');

        percentageLabel.addEventListener('click', () => {
            percentageInput.disabled = false;
            sarInput.disabled = true;
            sarInput.value = ''; // Clear the value when disabled
            percentageRadio.checked = true;
        });

        sarLabel.addEventListener('click', () => {
            sarInput.disabled = false;
            percentageInput.disabled = true;
            percentageInput.value = ''; // Clear the value when disabled
            sarRadio.checked = true;
        });
    </script>


    <!-- Timer -->
    <script>
        function startCountdown(days, hours, minutes) {
            const timerElement = document.getElementById('timer');
            let totalSeconds = (days * 24 * 60 * 60) + (hours * 60 * 60) + (minutes * 60);

            function updateTimer() {
                const daysRemaining = Math.floor(totalSeconds / (24 * 60 * 60));
                const hoursRemaining = Math.floor((totalSeconds % (24 * 60 * 60)) / (60 * 60));
                const minutesRemaining = Math.floor((totalSeconds % (60 * 60)) / 60);
                const secondsRemaining = totalSeconds % 60;

                const formattedTime = `${padZero(daysRemaining)}:${padZero(hoursRemaining)}:${padZero(minutesRemaining)}:${padZero(secondsRemaining)}`;
                timerElement.textContent = formattedTime;

                if (totalSeconds > 0) {
                    totalSeconds--;
                } else {
                    clearInterval(interval);
                    timerElement.textContent = "Time's up!";
                }
            }

            function padZero(number) {
                return number.toString().padStart(2, '0');
            }

            updateTimer();
            const interval = setInterval(updateTimer, 1000);
        }

        startCountdown(2, 12, 30); // Start the countdown with 2 days, 12 hours, and 30 minutes
    </script>

    <!-- Disable end date -->
    <script>
        const enableExpirationCheckbox = document.getElementById('experation');
        const endDateInput = document.querySelector('[name="end_coupon"]');

        enableExpirationCheckbox.addEventListener('change', function () {
            const isChecked = enableExpirationCheckbox.checked;

            if (isChecked) {
                endDateInput.disabled = true;
                endDateInput.value = ''; // Clear the value when disabled
            } else {
                endDateInput.disabled = false;
            }
        });
    </script>


    <script>
        // script.js
        const hoverTag = document.querySelector('.hover-tag');
        const metaDescription = document.querySelector('.meta-description');

        hoverTag.addEventListener('mouseenter', () => {
            setTimeout(() => {
                metaDescription.style.display = 'block';
            }, 300); // Adjust the delay as needed
        });

        hoverTag.addEventListener('mouseleave', () => {
            metaDescription.style.display = 'none';
        });

    </script>


    <!--begin::Javascript-->
    <script>var hostUrl = "assets/";</script>
    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="{{global_asset('assets/plugins/global/plugins.bundle.js')}}"></script>
    {{--        <script src="assets/js/scripts.bundle.js"></script>--}}
    <script src="assets/plugins/custom/datatables/datatables.bundle.js"></script>
    {{--        <script src="assets/js/custom/apps/file-manager/list.js"></script>--}}
    {{--        <script src="assets/js/widgets.bundle.js"></script>--}}
    {{--        <script src="assets/js/custom/widgets.js"></script>--}}
    {{--        <script src="assets/js/custom/utilities/modals/upgrade-plan.js"></script>--}}
    {{--        <script src="assets/js/custom/utilities/modals/create-app.js"></script>--}}
    {{--        <script src="assets/js/custom/utilities/modals/users-search.js"></script>--}}
    <!--end::Page Custom Javascript-->
    </body>
    <!--end::Body-->

@endsection
