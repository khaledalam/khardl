@extends('layouts.admin-sidebar')


@section('title',  __('settings'))

@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">
  <!--begin::Post-->
  <div class="post d-flex flex-column-fluid" id="kt_post">
      <!--begin::Container-->
      <div id="kt_content_container" class="container-xxl">

          <!--begin::Restaurants-->
{{--          <div class="card mb-5 mb-xl-10">--}}
{{--              <!--begin::Card header-->--}}
{{--              <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">--}}
{{--                  <!--begin::Card title-->--}}
{{--                  <div class="card-title m-0">--}}
{{--                      <h3 class="fw-bolder m-0">{{ __('restaurants')}}</h3>--}}
{{--                  </div>--}}
{{--                  <!--end::Card title-->--}}
{{--              </div>--}}
{{--              <!--begin::Card header-->--}}
{{--              <!--begin::Content-->--}}
{{--              <div id="kt_account_settings_profile_details" class="collapse show">--}}
{{--                  <!--begin::Form-->--}}
{{--                  <form id="kt_account_profile_details_form" class="form">--}}
{{--                      <!--begin::Card body-->--}}
{{--                      <div class="card-body border-top p-9">--}}

{{--                          <!--begin::Input group-->--}}
{{--                          <div class="row mb-0 mt-5">--}}
{{--                              <!--begin::Label-->--}}
{{--                                  <div class="form-check form-check-solid form-switch fv-row">--}}
{{--                                      <input class="form-check-input w-35px h-20px" type="checkbox" id="allowmarketing2" checked="checked" />--}}
{{--                                      <label class="form-check-label" for="allowmarketing2">{{ __('selling-items')}}--}}
{{--                                      </label>--}}
{{--                                  </div>--}}
{{--                              <!--begin::Label-->--}}
{{--                          </div>--}}
{{--                          <!--end::Input group-->--}}

{{--                          <!--begin::Input group-->--}}
{{--                          <div class="row mb-0 mt-5">--}}
{{--                              <!--begin::Label-->--}}
{{--                                  <div class="form-check form-check-solid form-switch fv-row">--}}
{{--                                      <input class="form-check-input w-35px h-20px" type="checkbox" id="allowmarketing3" checked="checked" />--}}
{{--                                      <label class="form-check-label" for="allowmarketing">{{ __('login')}}--}}
{{--                                      </label>--}}
{{--                                  </div>--}}
{{--                              <!--begin::Label-->--}}
{{--                          </div>--}}
{{--                          <!--end::Input group-->--}}

{{--                          <!--begin::Input group-->--}}
{{--                          <div class="row mb-0 mt-5">--}}
{{--                              <!--begin::Label-->--}}
{{--                                  <div class="form-check form-check-solid form-switch fv-row">--}}
{{--                                      <input class="form-check-input w-35px h-20px" type="checkbox" id="allowmarketing4" checked="checked" />--}}
{{--                                      <label class="form-check-label" for="allowmarketing4">{{ __('registration')}}--}}
{{--                                      </label>--}}
{{--                                  </div>--}}
{{--                              <!--begin::Label-->--}}
{{--                          </div>--}}
{{--                          <!--end::Input group-->--}}


{{--                      </div>--}}
{{--                      <!--end::Card body-->--}}
{{--                      <!--begin::Actions-->--}}
{{--                      <div class="card-footer d-flex justify-content-end py-6 px-9">--}}
{{--                          <button type="reset" class="btn btn-light btn-active-light-primary me-2">{{ __('discard')}}</button>--}}
{{--                          <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">{{ __('save-changes')}}</button>--}}
{{--                      </div>--}}
{{--                      <!--end::Actions-->--}}
{{--                  </form>--}}
{{--                  <!--end::Form-->--}}
{{--              </div>--}}
{{--              <!--end::Content-->--}}
{{--          </div>--}}
          <!--end::Restaurants-->

              <!--begin::Admin-->
<div class="card mb-5 mb-xl-10">
<!--begin::Card header-->
<div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">
  <!--begin::Card title-->
  <div class="card-title m-0">
    <h3 class="fw-bolder m-0">{{ __('admin')}}</h3>
  </div>
  <!--end::Card title-->
</div>
<!--begin::Card header-->
<!--begin::Content-->
<div id="kt_account_settings_profile_details" class="collapse show">
  <!--begin::Form-->
  <form action="{{ route('admin.save-settings') }}" method="POST">
  @csrf
    <!--begin::Card body-->
    <div class="card-body border-top p-9">


                              <!--begin::Input group-->
      <div class="row mb-0 mt-5">
        <!--begin::Label-->
          <div class="form-check form-check-solid form-switch fv-row">
            <input class="form-check-input w-35px h-20px" type="checkbox" id="allowmarketing5" name="live_chat_enabled" @if($live_chat_enabled) checked="checked" @endif}} />
            <label class="form-check-label" for="allowmarketing5">{{ __('show')}} {{ __('live-chat')}}
                                          </label>
          </div>
        <!--begin::Label-->
      </div>
      <!--end::Input group-->

        <!--begin::Input group-->
        <div class="row mb-0 mt-5">
            <!--begin::Label-->
            <div class="form-text fv-row">
                <label class="form-label" for="allowmarketing5">{{ __('webhook-url')}}
                </label>:
                <input class="form-control form-control-solid" value="{{$webhook_url}}" type="url" id="allowmarketing5" name="webhook_url" />
                <small>(for testing purposes)</small>
            </div>
            <!--begin::Label-->
        </div>
        <!--end::Input group-->
      <!--begin::Input group-->
      <div class="row mb-0 mt-5">
        <!--begin::Label-->
        <div class="form-text fv-row">
            <label class="form-label" for="allowmarketing5">{{ __('Specify the duration of deactivation of restaurant subscriptions after the number of days from the expiration date')}}
            </label>:
            <input class="form-control form-control-solid" value="{{old('days_sub') ?? $active_days_after_sub_expired}}" type="number" min="1" id="allowmarketing5" name="active_days_after_sub_expired"  placeholder="{{__('Enter Number of days')}}"/>

        </div>
        <!--begin::Label-->
    </div>
    <!--end::Input group-->

    </div>
    <!--end::Card body-->
    <!--begin::Actions-->
    <div class="card-footer d-flex justify-content-end py-6 px-9">
      <button type="reset" class="btn btn-light btn-active-light-primary me-2">{{ __('discard')}}</button>
      <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">
        <i class="bi bi-check2-square mx-1"></i>
        {{ __('save-changes')}}
    </button>
    </div>
    <!--end::Actions-->
  </form>
  <!--end::Form-->
</div>
<!--end::Content-->
</div>
<!--end::Admin-->


              <!--begin::Customers-->

{{--  <div class="card mb-5 mb-xl-10">--}}
{{--  <!--begin::Card header-->--}}
{{--  <div class="card-header border-0 cursor-pointer" role="button" data-bs-toggle="collapse" data-bs-target="#kt_account_profile_details" aria-expanded="true" aria-controls="kt_account_profile_details">--}}
{{--    <!--begin::Card title-->--}}
{{--    <div class="card-title m-0">--}}
{{--      <h3 class="fw-bolder m-0">{{ __('customers')}}</h3>--}}
{{--    </div>--}}
{{--    <!--end::Card title-->--}}
{{--  </div>--}}
{{--  <!--begin::Card header-->--}}
{{--  <!--begin::Content-->--}}
{{--  <div id="kt_account_settings_profile_details" class="collapse show">--}}
{{--    <!--begin::Form-->--}}
{{--    <form id="kt_account_profile_details_form" action="{{ route('admin.save-settings') }}" method="POST" class="form">--}}
{{--      <!--begin::Card body-->--}}
{{--      <div class="card-body border-top p-9">--}}

{{--        <!--begin::Input group-->--}}
{{--        <div class="row mb-0">--}}
{{--          <!--begin::Label-->--}}
{{--            <div class="form-check form-check-solid form-switch fv-row">--}}
{{--              <input class="form-check-input w-35px h-20px" type="checkbox" id="allowmarketing6" checked="checked" />--}}
{{--              <label class="form-check-label" for="allowmarketing6">{{ __('login')}}</label>--}}
{{--            </div>--}}
{{--          <!--begin::Label-->--}}
{{--        </div>--}}
{{--        <!--end::Input group-->--}}

{{--                                <!--begin::Input group-->--}}
{{--        <div class="row mb-0 mt-5">--}}
{{--          <!--begin::Label-->--}}
{{--            <div class="form-check form-check-solid form-switch fv-row">--}}
{{--              <input class="form-check-input w-35px h-20px" type="checkbox" id="allowmarketing7" checked="checked" />--}}
{{--              <label class="form-check-label" for="allowmarketing7">{{ __('registration')}}--}}
{{--                                            </label>--}}
{{--            </div>--}}
{{--          <!--begin::Label-->--}}
{{--        </div>--}}
{{--        <!--end::Input group-->--}}

{{--                                <!--begin::Input group-->--}}
{{--        <div class="row mb-0 mt-5">--}}
{{--          <!--begin::Label-->--}}
{{--            <div class="form-check form-check-solid form-switch fv-row">--}}
{{--              <input class="form-check-input w-35px h-20px" type="checkbox" id="allowmarketing8" checked="checked" />--}}
{{--              <label class="form-check-label" for="allowmarketing8">{{ __('control-panel')}}--}}
{{--                                            </label>--}}
{{--            </div>--}}
{{--          <!--begin::Label-->--}}
{{--        </div>--}}
{{--        <!--end::Input group-->--}}


{{--      </div>--}}
{{--      <!--end::Card body-->--}}
{{--      <!--begin::Actions-->--}}
{{--      <div class="card-footer d-flex justify-content-end py-6 px-9">--}}
{{--        <button type="reset" class="btn btn-light btn-active-light-primary me-2">{{ __('discard')}}</button>--}}
{{--        <button type="submit" class="btn btn-primary" id="kt_account_profile_details_submit">{{ __('save-changes')}}</button>--}}
{{--      </div>--}}
{{--      <!--end::Actions-->--}}
{{--    </form>--}}
{{--    <!--end::Form-->--}}
{{--  </div>--}}
{{--  <!--end::Content-->--}}
{{--  </div>--}}
  <!--end::Customers-->


</div>
<!--end::Content-->
</div>
<!--end::Setting-->
      </div>
      <!--end::Container-->
  </div>
  <!--end::Post-->
</div>
<!--end::Content-->
@endsection
