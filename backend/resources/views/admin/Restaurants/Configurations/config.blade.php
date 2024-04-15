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
        <form action="{{route('admin.update-restaurants-config',['tenant'=>$restaurant->id])}}" method="POST">
            @csrf
            @method('PATCH')
        <div class="card-body p-9">
            <!--begin::Row-->

            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-bold text-muted">{{ __('Merchant ID') }}
                    <i class="fas fa-download-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Country of origination"></i></label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">
                    <input type="text" name="merchant_id" class="form-control" id="" value="{{$setting->merchant_id}}">
                </div>
                <!--end::Col-->
            </div>
        </div>
        <div class="card-body p-9">
            <!--begin::Row-->

            <div class="row mb-7">
                <!--begin::Label-->
                <label class="col-lg-4 fw-bold text-muted">{{ __('Lead ID') }}
                    <i class="fas fa-download-circle ms-1 fs-7" data-bs-toggle="tooltip" title="Country of origination"></i></label>
                <!--end::Label-->
                <!--begin::Col-->
                <div class="col-lg-8">
                    <input type="text" class="form-control " name="lead_id" value="{{$setting->lead_id}}">
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
