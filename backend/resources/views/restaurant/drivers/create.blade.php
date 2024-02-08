@extends('layouts.restaurant-sidebar')

@section('title', __('messages.add-driver'))

@section('content')
<div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Form-->
            <form action="{{ route('drivers.store') }}" method="POST">
                @csrf

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
                                            <h2>{{ __('messages.add-driver')}}</h2>
                                        </div>
                                        <a href="{{ route('drivers.index') }}">
                                            <button type="button" class="btn btn-primary btn-sm">
                                                <i class="fa fa-arrow-left"></i>
                                                {{ __('messages.Back to list') }}
                                            </button>
                                        </a>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('messages.first-name')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="first_name" class="form-control mb-2" placeholder="{{ __('messages.first-name')}}" value="{{old('first_name')}}" required/>
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">{{ __('messages.first-name')}} {{ __('messages.is-required')}}</div>
                                            <!--end::Description-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('messages.last-name')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="last_name" class="form-control mb-2" placeholder="{{ __('messages.last-name')}}" value="{{old('last_name')}}" required/>
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">{{ __('messages.last-name')}} {{ __('messages.is-required')}}</div>
                                            <!--end::Description-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="form-label">{{ __('messages.Address')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="address" class="form-control mb-2" placeholder="{{ __('messages.Address')}}" value="{{old('address')}}"  required/>
                                            <!--end::Input-->
                                        </div>
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('messages.Branch')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <select name="branch_id" id="branch" class="form-select">
                                                    @foreach ($branches as $branch)
                                                    <option value="{{ $branch->id }}" {{old('branch_id') == $branch->id ? 'selected' :''}} required>{{ $branch->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('messages.email')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="email" name="email" class="form-control mb-2" placeholder="{{ __('messages.email')}}" value="{{old('email')}}" required />
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">{{ __('messages.email')}}.</div>
                                            <!--end::Description-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('messages.password')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="password" name="password" class="form-control mb-2" placeholder="{{ __('messages.password')}}" value="{{old('password')}}" required/>
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">{{ __('messages.password')}} {{ __('messages.is-required')}}</div>
                                            <!--end::Description-->
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('messages.phone-number')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="tel" minlength="9" maxlength="13" class="form-control @error('phone') is-invalid @enderror" value="{{ old('phone') }}" name="phone" id="phone" placeholder="+966 123456789" required>
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">{{ __('messages.phone-number')}} {{ __('messages.is-required')}}</div>
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
                                <span class="indicator-label">
                                    <i class="bi bi-check2-square mx-1 text-black"></i>
                                    {{ __('messages.save-changes')}}
                                </span>
                                <span class="indicator-progress">{{ __('messages.please-wait') }}
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
