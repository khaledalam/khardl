@extends('layouts.restaurant-sidebar')

@section('title', __('messages.Coupons'))

@section('content')


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
                        <div class="row">
                            <div class="col-md-12">
                                <!--begin::Card widget 4-->
                                <div class="card card-flush h-md-100 mb-5 mb-xl-0">
                                    <!--begin::Form-->
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
                                                                <h2>{{ __('messages.Make a new coupon') }}</h2>
                                                            </div>
                                                            <div class="">
                                                                <a href="{{ route('coupons.index') }}">
                                                                    <button class="btn btn-primary btn-sm">{{ __('messages.Back to list') }}</button>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <!--end::Card header-->
                                                        <form action="{{ route('coupons.update',$coupon->id) }}" method="POST">
                                                            @method('PUT')
                                                            @csrf
                                                            <!--begin::Card body-->
                                                            <div class="card-body pt-0">
                                                                <!--begin::Input group-->
                                                                <div class="mb-10 fv-row">
                                                                    <!--begin::Label-->
                                                                    <label class="required form-label">{{ __('messages.Code') }}</label>
                                                                    <!--end::Label-->
                                                                    <!--begin::Input-->
                                                                    <input type="text" name="code" required value="{{ old('code') ?? $coupon->code }}" class="form-control mb-2" placeholder="{{ __('messages.Code') }}" />
                                                                    <!--end::Input-->
                                                                </div>
                                                                <!--end::Input group-->
                                                                <!--begin::Input group-->
                                                                <div class="fv-row">
                                                                    <div class="row">
                                                                        <!--begin::Col 1-->
                                                                        <div class="col-lg-6">
                                                                            <!--begin::Option 1-->
                                                                            <input type="radio" class="btn-check" name="type" value="percentage" {{ $coupon->type=='percentage' ? 'checked' : '' }} id="kt_create_account_form_account_type_percentage" />
                                                                            <label class="btn btn-outline btn-outline-dashed btn-outline-default p-3 d-flex align-items-center mb-10" for="kt_create_account_form_account_type_percentage">
                                                                                <!--begin::Info-->
                                                                                <div class="d-flex justify-content-between align-items-center">
                                                                                    <div>
                                                                                        <span>%</span>
                                                                                    </div>
                                                                                    <div class="sprout-container">
                                                                                        <input type="number" max="100" min="1" value="{{ old('percentage') ?? ($coupon->type =='percentage' ? $coupon->amount :'')}}" name="percentage" id="percentageInput" class="form-control ml-2" step="1" placeholder="0"   {{ $coupon->type=='fixed' ? 'disabled' : '' }} />
                                                                                    </div>
                                                                                </div>
                                                                                <!--end::Info-->
                                                                            </label>
                                                                            <!--end::Option 1-->
                                                                        </div>
                                                                        <!--end::Col 1-->

                                                                        <!--begin::Col 2-->
                                                                        <div class="col-lg-6">
                                                                            <!--begin::Option 2-->
                                                                            <input type="radio" class="btn-check" name="type" value="fixed" {{ $coupon->type=='fixed' ? 'checked' : '' }} id="kt_create_account_form_account_type_sar" />
                                                                            <label class="btn btn-outline btn-outline-dashed btn-outline-default p-3 d-flex align-items-center mb-10" for="kt_create_account_form_account_type_sar">
                                                                                <!--begin::Info-->
                                                                                <div class="d-flex justify-content-between align-items-center">
                                                                                    <div>
                                                                                        <span>{{ __('messages.SAR') }}</span>
                                                                                    </div>
                                                                                    <div class="sprout-container">
                                                                                        <input type="number" min="1" value="{{ old('fixed') ?? ($coupon->type =='fixed' ? $coupon->amount :'')}}" name="fixed" id="sarInput" class="form-control ml-2" step="1" placeholder="0" {{ $coupon->type=='percentage' ? 'disabled' : '' }} />
                                                                                    </div>
                                                                                </div>
                                                                                <!--end::Info-->
                                                                            </label>
                                                                            <!--end::Option 2-->
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="mb-10 fv-row">
                                                                                <div class="d-flex justify-content-between align-items-center">
                                                                                    <div>
                                                                                        <label class="form-label">{{ __('messages.Max use') }} </label>
                                                                                        <small class="text-muted">({{ __('messages.No limit if empty') }})</small>
                                                                                    </div>
                                                                                </div>
                                                                                <input type="number" name="max_use" value="{{ old('max_use') ?? $coupon->max_use}}" class="form-control mb-2" placeholder="{{ __('messages.Max use') }}" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="mb-10 fv-row">
                                                                                <div class="d-flex justify-content-between align-items-center">
                                                                                    <div>
                                                                                        <label class="form-label">{{ __('messages.Max use per user') }}</label>
                                                                                        <small class="text-muted">({{ __('messages.No limit if empty') }})</small>
                                                                                    </div>
                                                                                </div>
                                                                                <input type="number" name="max_use_per_user" value="{{ old('max_use_per_user') ?? $coupon->max_use_per_user }}" class="form-control mb-2" placeholder="{{ __('messages.Max use per user') }}" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="mb-10 fv-row">
                                                                                <div class="d-flex justify-content-between align-items-center">
                                                                                    <div>
                                                                                        <label class="form-label">{{ __('messages.Max discount amount') }}</label>
                                                                                        <small class="text-muted">({{ __('messages.No limit if empty') }})</small>
                                                                                    </div>
                                                                                </div>
                                                                                <input type="number" name="max_discount_amount" value="{{ old('max_discount_amount') ?? $coupon->max_discount_amount }}" class="form-control mb-2" placeholder="{{ __('messages.Amount') }}" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="mb-10 fv-row">
                                                                                <div class="d-flex justify-content-between align-items-center">
                                                                                    <div>
                                                                                        <label class="form-label">{{ __('messages.Minimum cart amount') }}</label>
                                                                                        <small class="text-muted">({{ __('messages.No limit if empty') }})</small>
                                                                                    </div>
                                                                                </div>
                                                                                <input type="number" name="minimum_cart_amount" value="{{ old('minimum_cart_amount') ?? $coupon->minimum_cart_amount }}" class="form-control mb-2" placeholder="{{ __('messages.Cart total') }}" />
                                                                            </div>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="fv-row mt-5">
                                                                                <div class="d-flex justify-content-between align-items-center">
                                                                                    <div>
                                                                                        <label class="required form-label">{{ __('messages.Active from') }}</label>
                                                                                    </div>
                                                                                </div>
                                                                                <input type="date" name="active_from" class="form-control mb-2" value="{{ old('active_from') ?? $coupon->active_from?->format('Y-m-d') }}" />
                                                                            </div>
                                                                            <!--end::Col 2-->
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <div class="fv-row mt-5">
                                                                                <div class="d-flex justify-content-between align-items-center">
                                                                                    <div>
                                                                                        <label class="required form-label">{{ __('messages.Expire at') }}</label>
                                                                                    </div>
                                                                                </div>
                                                                                <input type="date" name="expire_at" class="form-control mb-2" value="{{ old('expire_at') ?? $coupon->expire_at?->format('Y-m-d') }}" />
                                                                            </div>
                                                                        </div>

                                                                    </div>
                                                                    <!--begin::Actions-->
                                                                    <div class="d-flex justify-content-end">
                                                                        <button type="submit" class="badge badge-light-khardl p-4 text-hover-khardl bg-hover-khardl" style="border:none" data-kt-search-element="advanced-options-form-cancel">{{ __('messages.Update') }}</button>
                                                                    </div>
                                                                    <!--end::Actions-->

                                                                </div>
                                                                <!--end::Card header-->
                                                        </form>
                                                    </div>
                                                    <!--end::General options-->
                                                </div>
                                            </div>
                                            <!--end::Tab pane-->
                                        </div>

                                    </div>
                                    <!--end::Main column-->
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

@endsection
@section('js')
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
@endsection
