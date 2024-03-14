@extends('layouts.restaurant-sidebar')

@section('title', __('Edit customer'))

@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Form-->
            <form action="{{ route('customers_data.update', ['restaurantUser' => $restaurantUser->id]) }}" method="POST">
                @csrf
                @method('PUT')

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
                                            <h2>{{ __('Edit customer')}}</h2>
                                        </div>
                                        <a href="{{ route('customers_data.list') }}">
                                            <button type="button" class="btn btn-primary btn-sm">
                                                <i class="fa fa-arrow-left"></i>
                                                {{ __('Back to list') }}
                                            </button>
                                        </a>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->

                                    <div class="card-body pt-0">
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('first-name')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="first_name" class="form-control mb-2 @error('first_name') is-invalid @enderror" required placeholder="{{ __('first-name')}}" value="{{ old('first_name') ? old('first_name') : $restaurantUser->first_name }}" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('last-name')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="last_name" class="form-control mb-2  @error('last_name') is-invalid @enderror" required placeholder="{{ __('last-name')}}" value="{{ old('last_name') ? old('last_name') : $restaurantUser->last_name }}" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('email')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="email" name="email" class="form-control mb-2 @error('email') is-invalid @enderror" required placeholder="{{ __('email')}}" value="{{ old('email') ? old('email') : $restaurantUser->email }}" />
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('phone-number')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="tel" pattern="[0-9+]{10,14}" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode === 43" minlength="10" maxlength="14" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') ? old('phone') : $restaurantUser->phone }}" name="phone" id="phone" placeholder="05XXXXXXXX" required>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('Status')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <select name="status" id="status" class="form-select @error('status') is-invalid @enderror">
                                                    <option value="active" {{ old('status') == 'active' ? 'selected' : ($restaurantUser->status == 'active' ? 'selected' : '')  }}>{{ __('active') }}</option>
                                                    <option value="inactive" {{ old('status') == 'inactive' ? 'selected' : ($restaurantUser->status == 'inactive' ? 'selected' : '')  }}>{{ __('inactive') }}</option>
                                                    <option value="suspended" {{ old('status') == 'suspended' ? 'selected' : ($restaurantUser->status == 'suspended' ? 'selected' : '')  }}>{{ __('suspended') }}</option>
                                                </select>
                                            </div>
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <!--end::Description-->
                                        </div>
                                        <!--end::Input group-->
                                    </div>
                                    <!--end::Card header-->
                                </div>
                                <!--end::General options-->
                            </div>
                        </div>
                        <!--end::Tab pane-->
                        <div class="d-flex justify-content-end mt-3">
                            <!--begin::Button-->
                            <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-khardl">
                                <i class="bi bi-check2-square mx-1 text-black"></i>
                                <span class="indicator-label">{{ __('save')}}</span>
                                <span class="indicator-progress">{{ __('please-wait')}}
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
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
    <!--end::Post-->
</div>
<!--end::Content-->
@endsection
