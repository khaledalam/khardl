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
                            <div class="d-flex flex-column my-2">
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

                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column flex-row-fluid my-2">
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
                                            <h2>{{ __('messages.Delivery options')}}</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->

                                    <div class="card-body pt-0">
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="form-label">{{ __('messages.Max time for drivers to pickup order(in case if delivery companies exist and drivers)')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="number" min="1" name="limit_delivery_company" class="form-control mb-2" placeholder="{{ __('messages.Number of minutes')}}" value="{{$settings->limit_delivery_company}}" />
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">{{__('messages.The number of minutes for drivers so he can pick up order before order goes to delivery companies')}} ({{ __('messages.Default: :minutes minutes',['minutes' => $settings->limit_delivery_company ?? config('application.limit_delivery_company')]) }})</div>
                                            <!--end::Description-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="row mb-0 mt-5">
                                            <!--begin::Label-->
                                            <div class="form-check form-check-solid form-switch fv-row">
                                                <input class="form-check-input w-35px h-20px" type="checkbox" id="delivery_companies_option" value="1" name="delivery_companies_option"
                                                @if($settings->delivery_companies_option || old('delivery_companies_option') == "1")
                                                {{ 'checked' }}
                                                @endif>
                                                <label class="form-check-label" for="delivery_companies_option">{{ __('messages.Delivery companies option')}}</label>
                                            </div>
                                            <!--end::Label-->
                                        </div>
                                        <div class="row mb-0 mt-5">
                                            <!--begin::Label-->
                                            <div class="form-check form-check-solid form-switch fv-row">
                                                <input class="form-check-input w-35px h-20px" type="checkbox" id="drivers_option" value="1" name="drivers_option"
                                                @if($settings->drivers_option || old('drivers_option') == "1")
                                                {{ 'checked' }}
                                                @endif>
                                                <label class="form-check-label" for="drivers_option">{{ __('messages.Drivers option')}}</label>
                                            </div>
                                            <!--end::Label-->
                                        </div>
                                        <!--end::Input group-->


                                    </div>
                                    <!--end::Card header-->
                                </div>
                                <!--end::General options-->
                            </div>
                            {{-- Fee end --}}

                        </div>
                    </div>
                </div>
                <!--end::Tab pane-->
                <div class="d-flex justify-content-end mt-3">
                    <!--begin::Button-->
                    <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                        <span class="indicator-label">{{ __('messages.save') }}</span>
                        <i class="bi bi-check2-square mx-1"></i>
                        <span class="indicator-progress">{{ __('messages.please-wait')}}
                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                    </button>
                    <!--end::Button-->
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
