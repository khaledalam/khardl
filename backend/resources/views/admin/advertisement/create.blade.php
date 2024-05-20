@extends('layouts.admin-sidebar')
@section('title', __('Add package'))
@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Form-->
            <form action="{{ route('admin.advertisement.store') }}" method="POST" enctype="multipart/form-data">
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
                                            <h2>{{ __('Add package')}}</h2>
                                        </div>
                                        <a href="{{ route('admin.advertisement.index') }}">
                                            <button type="button" class="btn btn-khardl btn-sm">
                                                <i class="fa fa-arrow-left"></i>
                                                {{ __('Back to list') }}
                                            </button>
                                        </a>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->

                                    <div class="card-body pt-0">
                                        <label class="required form-label">{{ __('name')}}</label>
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item">
                                                <a class="nav-link active required" id="en-tab" data-bs-toggle="tab" href="#name_en">{{__('English')}}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link required" id="ar-tab" data-bs-toggle="tab" href="#name_ar">{{__('Arabic')}}</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content mt-3 input-group input-group-outline" style="display: block;">
                                            <div class="tab-pane fade show active" id="name_en">
                                                <input type="text" name="name[en]" value="{{ old('name.en') }}" class="form-control" placeholder="{{ __('Enter package name(en)') }}" required>
                                            </div>
                                            <div class="tab-pane fade" id="name_ar">
                                                <input type="text" name="name[ar]" value="{{ old('name.ar') }}" class="form-control" placeholder="{{ __('Enter package name(ar)') }}">
                                            </div>
                                        </div>
                                        <label class="required form-label my-2">{{ __('Description')}}</label>
                                        <ul class="nav nav-tabs">
                                            <li class="nav-item">
                                                <a class="nav-link active required" id="en-tab" data-bs-toggle="tab" href="#desc_en">{{__('English')}}</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link required" id="ar-tab" data-bs-toggle="tab" href="#desc_ar">{{__('Arabic')}}</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content my-3 input-group input-group-outline" style="display: block;">
                                            <div class="tab-pane fade show active" id="desc_en">
                                                <textarea name="description[en]" id="" cols="30" rows="10" class="form-control" placeholder="{{ __('Enter package description(en)') }}" required>{{ old('description.en') }}</textarea>
                                            </div>
                                            <div class="tab-pane fade" id="desc_ar">
                                                <textarea name="description[ar]" id="" cols="30" rows="10" class="form-control" placeholder="{{ __('Enter package description(ar)') }}">{{ old('description.ar') }}</textarea>
                                            </div>
                                        </div>
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="form-label required">{{ __('Image')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="file" class="form-control form-control-solid" placeholder="{{ __('Photo') }}" name="image" accept="image/*" required/>
                                            <!--end::Input-->
                                        </div>
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('Status')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <select name="active" id="status" class="form-select">
                                                    <option value="1" {{ old('active') == '1' ? 'selected' : ''  }}>{{ __('active') }}</option>
                                                    <option value="0" {{ old('active') == '0' ? 'selected' : ''  }}>{{ __('inactive') }}</option>
                                                </select>
                                            </div>
                                            <!--end::Input-->
                                        </div>
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
                                <span class="indicator-label">{{ __('Add package') }}</span>
                                <i class="bi bi-check2-square mx-1"></i>
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
