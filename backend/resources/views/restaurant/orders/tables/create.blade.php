@extends('layouts.restaurant-sidebar')

@section('title', __('Reserve new table'))

@section('content')
@push("styles")
<script src="https://cdnjs.cloudflare.com/ajax/libs/flatpickr/4.6.13/flatpickr.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
@endpush

<div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Form-->
            <form action="{{ route('table-reservations.store') }}" method="POST" enctype="multipart/form-data">
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
                                            <h2>{{ __('Reserve new table')}}</h2>
                                        </div>
                                        <a href="{{ route('table-reservations.index') }}">
                                            <button type="button" class="btn btn-khardl btn-sm">
                                <i class="fa fa-arrow-left"></i>
                                {{ __('Back to list') }}
                            </button>
                                        </a>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0 row">
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('Number of guests')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="number" step="1" name="n_of_guests" class="form-control mb-2" placeholder="{{ __('Number of guests')}}" value="{{old('n_of_guests')}}" required/>
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">{{ __('Number of guests')}} {{ __('is-required')}}</div>
                                            <!--end::Description-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('type of reservation')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="environment" class="form-select">
                                                @foreach (['indoor','outdoor'] as $status)
                                                <option value="{{ $status}}" {{old('environment') == $status ? 'selected' :''}} required>{{ __($status)}}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Input-->
                                            <!--begin::Description-->
                                            <div class="text-muted fs-7">{{ __('type of reservation')}} {{ __('is-required')}}</div>
                                            <!--end::Description-->
                                        </div>
                                        <!--end::Input group-->
                                
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="form-label">{{ __('Status')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <select name="status" class="form-select">
                                                @foreach (App\Enums\Order\TableInvoiceEnum::values() as $status)
                                                <option value="{{ $status}}" {{old('status') == $status ? 'selected' :''}} required>{{ __($status)}}</option>
                                                @endforeach
                                            </select>
                                            <!--end::Input-->
                                        </div>
                                      
                                        <div class="mb-10 col-md-6">
                                            <!-- TODO @todo improvement: search for customer better approach -->
                                            <!--begin::Label-->
                                            <label class=" form-label">{{ __('Customer')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <select name="user_id"  class="form-select">
                                                    @foreach ($customers as $customer)
                                                    <option value="{{ $customer->id }}" {{old('user_id') == $customer->id ? 'selected' :''}} required>{{ $customer->fullName }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <div class="mb-10 col-md-1">
                                            {{__('or')}}
                                        </div>
                                        <div class="mb-10 col-md-5">
                                            <!-- TODO @todo improvement: search for customer better approach -->
                                            <!--begin::Label-->
                                            <label class=" form-label">{{ __('New customer')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <input type="text" name="new_user" class="form-control mb-2" placeholder="{{ __('New customer')}}" value="{{old('new_user')}}"  />

                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <!--end::Input group-->
                                        <!--begin::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class=" form-label">{{ __('notes')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <input type="text" name="note" class="form-control mb-2" placeholder="{{ __('notes')}}" value="{{old('note')}}"  />
                                            <!--end::Input-->
                                            <!--begin::Description-->

                                            <!--end::Description-->
                                        </div>
                                        <!--end::Input group-->
                                        <div class="mb-10 fv-row">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                <span class="required form-label"> {{ __('Branch')}}</span>
                                                <i class="fas fa-exclamation-circle ms-1 fs-7">
                                                    {{ __('Active Branches Only')}}
                                                </i>
                                            </label>

                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <select name="branch_id" id="branch_id" class="form-select">
                                                    <option value=""></option>
                                                    @foreach ($branches as $branch)
                                                    <option value="{{ $branch->id }}" {{old('branch_id') == $branch->id ? 'selected' :''}} required>{{ $branch->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <!--end::Input-->
                                        </div>
                                        <div class="mb-10 fv-row" id="customChoiceTabs"> 
                                            <!--begin::Label-->
                                            <label class="required form-label">{{ __('Reservation time')}}</label>
                                            <!--end::Label-->
                                            <!--begin::Input-->
                                            <div class="form-group">
                                                <div class="col-md-12 fv-row"  >

                                                    <div class="d-flex w-50 mx-5 gap-1">
                                                        <input type="text" class="form-control form-control-solid  from" id="datetime" name="date_time"   />
                                                    </div>
                                                </div>
                                                
                                            </div>
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
                        <div class="d-flex justify-content-end mt-3">
                            <!--begin::Button-->
               
                            <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-khardl">
                                <span class="indicator-label">
                                    <i class="bi bi-check2-square mx-1 text-black"></i>
                                    {{ __('save-changes')}}
                                </span>
                                <span class="indicator-progress">{{ __('please-wait') }}
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
@section('js')
<script>
    let flatpickrInstance;

    function updateDisabledDates(branchId) {
        if (branchId === undefined) {
            $('#customChoiceTabs').css('display','none');
            return ;
        }
        $('#customChoiceTabs').css('display','block');
        $.ajax({
            url: `/table-reservations/get-branch-hours/${branchId}`, // Adjust the URL to your backend endpoint
            method: 'GET',
            success: function(response) {

                const disabledDays = response.disabledDays;

                if (flatpickrInstance) {
                    flatpickrInstance.destroy();
                }
                flatpickrInstance = flatpickr("#datetime", {
                    enableTime: true,
                    dateFormat: "Y-m-d H",
                    time_24hr: true,
                    disable: [
                        function(date) {
                            return disabledDays.includes(date.getDay());
                        }
                    ],
                    
                    onClose: function(selectedDates, dateStr, instance) {
                            const selectedDate = selectedDates[0];
                    
                            if (selectedDate && branchId) {
                                const formattedDate = instance.formatDate(selectedDate, "Y-m-d H");
                            
                                $.ajax({
                                    url: `/table-reservations/validate-time`, // Change to your actual endpoint
                                    method: 'GET',
                                    data: {
                                        branch_id: branchId,
                                        datetime: formattedDate
                                    },
                                    error: function(response) {
                                        instance.clear();
                                        alert(response.responseJSON.message);
                                    }
                                });
                            }else {
                                alert("{{__('Please select the branch first')}}");
                            }
                    }
                });
            },
            error: function() {
                alert("{{__('An error occurred while fetching branch dates.')}}");
            }
        });
    }
        $(document).ready(function() {
            const branchId = $("#branch option:selected").val();
            updateDisabledDates(branchId);

            $("#branch_id").change(function() {
                const newBranchId = $(this).val();
                updateDisabledDates(newBranchId);
            });
        });

           
           
            
</script>
@endsection