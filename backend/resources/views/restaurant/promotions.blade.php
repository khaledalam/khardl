@extends('layouts.restaurant-sidebar')

@section('title', __('promotions'))

@section('content')


<!--begin::Body-->

    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column mb-10">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">

            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid" id="kt_wrapper">


                <!--begin::Content-->
                <div class=" d-flex flex-column flex-column-fluid pt-0" id="kt_content">
                    <!--begin::Post-->
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <!--begin::Container-->
                        <div id="kt_content_container" class="container-xxl">
                            <!--begin::Row-->
                            <div class="row g-12 g-xl-12 mb-xl-112">

                                <div class="col-md-12 col-lg-12 mb-md-4 mb-xl-0">
                                    <h2>{{ __('Loyalty points') }}</h2>
                                    <!--begin::Card widget 4-->
                                    <div class="card card-flush">
                                        <!--begin::Form-->
                                        <form id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row" action="{{ route('promotions.save-settings') }}" method="POST">
                                            @csrf
                                            <!--begin::main column-->
                                            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                                                <!--begin::tab content-->
                                                <div class="tab-content">
                                                    
                                                    <!--begin::tab pane-->
                                                    <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                                                        <div class="d-flex flex-column gap-7 gap-lg-10">
                                                            <!--begin::general options-->
                                                            <div class="card card-flush py-4">
                                                                <!--begin::card header-->
                                                              
                                                                <!--end::card header-->
                                                                <!--begin::card body-->
                                                                <div class="card-body p-3">
                                                                    <!--begin::input group-->
                                                                    <div class="fv-row">
                                                                        <!--begin::label-->
                                                                      
                                                                        <div class="d-flex justify-content-around">
                                                                            <div class=" ">
                                                                                <label class="required form-label">{{ __('How many loyalty points customer get per spend each 1 SAR?') }}</label>
    
                                                                            </div>
                                                                            <div class="mx-5 flex-fill">
                                                                                <input type="number" min="0" step="0.01" name="loyalty_points" {{  $user->isRestaurantOwner() ?:'readonly'}} class="form-control" placeholder="{{ __('e.g 0.02') }}" value="{{$settings['loyalty_points']}}" />


                                                                            </div>
                                                                            @if($user->isRestaurantOwner())
                                                                            <div class=" mt-2">
                                     
                                                                               
                                                                                <button type="submit" class=" btn btn-sm fw-bolder btn-khardl">{{__('save')}}</button>
                                                                            </div>
                                                                            @endif
                                                                        </div>
                                                                    
                                                                        <!--end::label-->
                                                                        <!--begin::input-->
                                                                        <!--end::input-->
                                                                        
                                                                    </div>
                                                                    <!--begin::input group-->


                                                                </div>
                                                                <!--end::card header-->
                                                            </div>
                                                            <!--end::general options-->
                                                            
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                    <!--end::tab pane-->
                                                </div>

                                            </div>
                                            <!--end::main column-->


                                            <!--begin::Main column-->

                                        
                                        </form>
                                        <!--end::Form-->
                                    </div>
                                    <!--end::Card widget 4-->
                                </div>
                                <div class="col-md-12 d-flex flex-column flex-lg-row">
                                    <!--begin::Sidebar-->
                                    <div class="flex-column flex-lg-row-fluid w-lg-275px ">
                                        <!--begin::Sticky aside-->
                                       
                                            <!--begin::Aside content-->
                                            <div class="mb-5  mt-5">
                                                <div class="card-title">
                                                    <h2>{{ __('Activate loyalty points for branches') }}</h2>
                                                </div>
                                            </div>
                                            @foreach ($branches as $branch)
                                            <div class="card mb-5 p-0">
                                            <div class="card-body p-0">
                                                <div id="categoryList" class="menu menu-column menu-rounded menu-state-bg menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary ">
                                                    <!--begin::Menu item-->
                                                
                                                    
                                                    <div class="d-flex ">
                                                        <div class="mr-auto w-100">
                                                            <!--begin::Inbox-->
                                                            <div class="">
                    
                                                                    <span class="menu-link d-flex align-items-stretch justify-content-start  p-2" >
                                                                        <a href="#">
                                                                            <img src="{{  global_asset('img/branch.png') }}" width="50" height="50" class="mx-2" style="border-radius: 50%;" />
                                                                        </a>
                                                                        <div>
                                                                        
                                                                            <div>
                                                                                <span class="menu-title fw-bolder small">{{ $branch->name }}</span>

                                                                            </div>
                                                                            <span class="badge badge-light-success mt-1">{{$branch->phone}}</span>

                                                                        </div>
                    
                                                                    </span>
                    
                    
                                                            </div>
                    
                                                            <!--end::Inbox-->
                                                        </div>
                                                
                                                    <div class="">
                                                        <a href="#" class="toggle-status-btn" data-branch-id="{{ $branch->id }}"> 
                                                                <div class="form-check form-switch mt-5">
                                                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheck{{ $branch->id }}" {{ $branch->loyalty_availability ? 'checked' : '' }} >
                                                                </div>
                                                        </a>
                                                    </div>
                                                </div>
                                                
                                                
                    
                                            </div>
    
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                        
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
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <script>
        $(document).ready(function() {
            $('.toggle-status-btn').click(function(event) {
                event.preventDefault();
    
                const branchId = $(this).data('branch-id');

                const switchCheckbox = $(`#flexSwitchCheck${branchId}`);
    
                // Make an AJAX request to toggle the status
                $.ajax({
                    url: `{{ route('restaurant.branch.toggleLoyaltyPoint', ['id' => '__branch_id__']) }}`.replace('__branch_id__', branchId)
                    , type: 'POST'
                    , dataType: 'json'
                    , data: {
                        '_token': '{{ csrf_token() }}', // Include the CSRF token
                    }
                    , success: function(response) {
                        console.log(response.checked);
                        switchCheckbox.prop('checked', response.checked);
                    }
                    , error: function(error) {
                        console.error('Error toggling user status:', error);
                    }
                });
            });
        });
     
    
    </script>

    @endsection
