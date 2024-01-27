@extends('layouts.restaurant-sidebar')

@section('title', __('messages.settings'))

@section('content')

    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">
        <!--begin::Post-->

        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container-xxl">
                <!--begin::Form-->
                <form action="{{ route('restaurant.update.settings') }}" method="POST">
                @csrf

                <!--begin::Main column-->
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <!--begin::Tab content-->
                        <div class="tab-content">
                            <!--begin::Tab pane-->
                            <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">

                                {{-- Fee start --}}
                                <div class="d-flex flex-column gap-7 gap-lg-10">
                                    <!--begin::General options-->
                                    <div class="card card-flush py-4">
                                        <!--begin::Card header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>{{ __('messages.fees')}}</h2>
                                            </div>
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->

                                        <div class="card-body pt-0">
                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="form-label">{{ __('messages.delivery-fee')}}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="number" step="0.1" name="delivery_fee" class="form-control mb-2" required placeholder="{{ __('messages.delivery-fee')}} {{__('messages.in')}} {{__('messages.sar')}}" value="{{$settings['delivery_fee']}}" />
                                                <!--end::Input-->
                                                <!--begin::Description-->
                                                <div class="text-muted fs-7">{{__('messages.e.g.')}} 10.5 {{__('messages.sar')}}</div>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Input group-->


                                        </div>
                                        <!--end::Card header-->
                                    </div>
                                    <!--end::General options-->
                                </div>
                                {{-- Fee end --}}

                                {{-- loyalty_points start --}}
                                <div class="d-flex flex-column gap-7 gap-lg-10">
                                    <!--begin::General options-->
                                    <div class="card card-flush py-4">
                                        <!--begin::Card header-->
                                        <div class="card-header">
                                            <div class="card-title">
                                                <h2>{{ __('messages.loyalty-points')}}</h2>
                                            </div>
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Card body-->

                                        <div class="card-body pt-0">
                                            <!--begin::Input group-->
                                            <div class="mb-10 fv-row">
                                                <!--begin::Label-->
                                                <label class="form-label">{{ __('messages.loyalty-points-per-order')}}</label>
                                                <!--end::Label-->
                                                <!--begin::Input-->
                                                <input type="number" step="0.1" name="loyalty_points_per_order" class="form-control mb-2" required placeholder="{{ __('messages.loyalty-points-per-order')}}" value="{{$settings['loyalty_points_per_order']}}" />
                                                <!--end::Input-->
                                                <!--begin::Description-->
                                                <div class="text-muted fs-7">{{__('messages.loyalty-point-desc')}}</div>
                                                <!--end::Description-->
                                            </div>
                                            <!--end::Input group-->


                                        </div>
                                        <!--end::Card header-->
                                    </div>
                                    <!--end::General options-->
                                </div>
                                {{-- loyalty_points and cashback end --}}

                            </div>
                            <!--end::Tab pane-->
                            <div class="d-flex justify-content-end mt-3">
                                <!--begin::Button-->
                                <button type="submit" id="kt_ecommerce_add_product_submit"
                                        class="btn btn-primary">
                                    <span class="indicator-label">{{ __('messages.save') }}</span>
                                    <i class="bi bi-check2-square mx-1"></i>
                                    <span class="indicator-progress">{{ __('messages.please-wait')}}
                                          <span
                                              class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                </button>
                                <!--end::Button-->
                            </div>
                        </div>
                        <!--end::Main column-->
                </form>
                <!--end::Form-->
            </div>
            <!--end::Container-->
        </div>

    </div>
    <!--end::Content-->
@endsection
