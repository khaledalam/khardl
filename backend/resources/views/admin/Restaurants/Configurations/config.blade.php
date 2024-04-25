 <!--begin::details View-->
 <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
    <!--begin::Card header-->
   
        <div class="card-header cursor-pointer">
            <!--begin::Card title-->
            <div class="card-title m-0">
                <h3 class="fw-bolder m-0">{{ __('Customer application') }}</h3>
            </div>
            <!--end::Card title-->
        </div>
        <!--begin::Card header-->
        <!--begin::Card body-->
        @if($customer_app)
        <form action="{{route('admin.update-restaurants-customer-app',['tenant'=>$restaurant->id])}}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')
        <div class="card-body p-9">
            <!--begin::Row-->

            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-bold text-muted required">{{ __('Android App URL') }}
                    <i class="fas fa-download-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Country of origination"></i></label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-6">
                    <input type="text" name="android_url" class="form-control" id="" value="{{$customer_app->android_url}}">
                </div>
                <div class="col-lg-1 mt-2">
                    @if($customer_app->android_url)
                        <a href="{{$customer_app->android_url}}" target="_blank">
                            <img src="{{global_asset('images/logo_playstore.svg')}}" width="90"/>
                        </a>
                    @else
                        <img src="{{global_asset('images/logo_playstore.svg')}}" width="90"/>
                    @endif
                </div>
                <!--end::Col-->
            </div>
        </div>
        <div class="card-body p-9">
            <!--begin::Row-->

            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-bold text-muted required">{{ __('IOS App URL') }}
                    <i class="fas fa-download-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Country of origination"></i></label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-6">
                    <input type="text" class="form-control " name="ios_url" value="{{$customer_app->ios_url}}">
                </div>
                <div class="col-lg-1 mt-2">
                    @if($customer_app->android_url)
                    <a href="{{$customer_app->android_url}}" target="_blank">
                        <img src="{{global_asset('images/logo_appstore.svg')}}" width="90" />
                    </a>
                @else
                <img src="{{global_asset('images/logo_appstore.svg')}}" width="90"/>
                @endif
                </div>
                <!--end::Col-->
            </div>
        </div>
        <div class="card-body p-9">
            <!--begin::Row-->

            <div class="row mb-7">
            <!--begin::Label-->
                <label class="col-lg-4 fw-bold text-muted ">{{ __('Application Icon') }}
                    <i class="fas fa-download-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Country of origination"></i></label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-6">
                    <input type="file" class="form-control " name="icon"  accept="image/x-png,image/gif,image/jpeg" >
                </div>
                <div class="col-lg-1 ">
                    <img alt="Logo" src="{{ $customer_app->icon ?? global_asset('assets/default_logo.png') }}" width="40" />
                </div>
             
                <!--end::Col-->
            </div>
        </div>
      
        <div class="text-center">
            <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">Reset ↻</button>
            <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                <span class="indicator-label">{{__('save-changes')}} ✔️</span>
                <span class="indicator-progress" id="waiting-item">{{__('please-wait')}}
                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
            </button>
        </div>
    </form>
        @else
            <div class="card-title m-0 ">
                <h3 class="fw-bolder m-0  badge-primary p-2 text-center">{{ __('There is no subscription for customer application yet') }}</h3>
            </div>
        @endif
       
  

</div>
<!--end::details View-->
