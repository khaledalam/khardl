@extends('layouts.restaurant-sidebar')

@section('title', __('Coupons'))

@section('content')
@if($user->isRestaurantOwner())
<div class="content d-flex flex-column flex-column pt-0" id="kt_content">

    <!--begin::Post-->
    <div class="post d-flex flex-column" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Inbox App - Messages -->
            <div class="flex-lg-row-fluid my-2">
                <!--begin::Card-->
                <div class="card">
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <div class="d-flex flex-wrap gap-1">
                            <h3 class="text-khardl">{{ __('Branches') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                         
                            <div id="carouselExample" class="carousel slide" data-interval="false">
                              
                                <div class="carousel-inner">
                                    @foreach ($branches->chunk(6) as $key => $branchChunk)
                                    
                                        <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                            <div class="row ">
                                                @foreach ($branchChunk as $branchLoop)
                                                <div class="col-md-2 d-flex justify-content-start" >
                                                    <a href="{{ route('coupons.index', ['branchId' => $branchLoop->id]) }}" style="min-width: 120px;" class="btn btn-sm @if($branchLoop->id == $branchId) btn-khardl border border-dark text-black @else btn-active-light-khardl @endif">
                                                        <span class="d-inline-block text-truncate" style="max-width: 80px;margin:-7px" >   {{ $branchLoop->name }}</span>
                                                    </a>
                                                </div>
                                                      
                                                @endforeach
                                            </div>
                                        </div>
                                    @endforeach
                                        
                                    
                                </div>
                                <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev" >
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next" >
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                  
                    
                    </div>
                </div>
                <!--end::Card-->
            </div>
        </div>
        <!--end::Inbox App - Messages -->
    </div>
    <!--end::Container-->
</div>
@endif
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">


    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <div class="card-header d-flex py-5 gap-2 gap-md-5">
                <!--begin::Card title-->
                <div class="card-title">
                    <!--begin::Search-->
                    <form action="">
                        <div class="d-flex align-items-center position-relative my-1">
                            <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                            <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                    <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <input  type="text" value="{{ request('search') }}" name="search" data-kt-ecommerce-order-filter="search" class="form-control form-control-solid w-250px ps-14" placeholder="{{__('search')}}" />
                            <!--end::Svg Icon-->
                            <select name="is_deleted" class="form-select mx-2">
                                <option value="" selected>{{ __('Deleted or not') }}</option>
                                <option value="0" {{ request('is_deleted') == "0" ? 'selected' : '' }}>{{ __('Not deleted') }}</option>
                                <option value="1" {{ request('is_deleted') == "1" ? 'selected' : '' }}>{{ __('Deleted') }}</option>
                            </select>
                            <select name="type" class="form-select mx-2">
                                <option value="" selected>{{ __('Type') }}</option>
                                <option value="fixed" {{ request('type') == "fixed" ? 'selected' : '' }}>{{ __('Fixed') }}</option>
                                <option value="percentage" {{ request('type') == "percentage" ? 'selected' : '' }}>{{ __('Percentage') }}</option>
                            </select>
                            <button type="submit" class="btn btn-secondary"> {{ __('Filter') }}</button>
                        </div>
                    </form>
                    <!--end::Search-->
                </div>
                <div class="mr-auto p-2 ">
                    <a href="{{ route('coupons.create',['branchId'=>$branchId]) }}">
                        <button class="btn btn-sm btn-khardl">
                            {{ __('Add new') }}
                        </button>
                    </a>
                </div>
            </div>
            <!--begin::Referred users-->
            <div class="card">
                <!--begin::Tab content-->
                <div id="kt_referred_users_tab_content" class="tab-content">
                    <!--begin::Tab panel-->
                    <div id="kt_referrals_1" class="card-body p-0 tab-pane fade show active" role="tabpanel">
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table table-row-bordered table-flush align-middle gy-6">
                                <!--begin::Thead-->
                                <thead class="border-bottom border-gray-200 fs-6 fw-bolder bg-lighten">
                                    <tr>
                                        <th class="px-3">{{ __('ID') }}</th>
                                        <th class="px-2">{{ __('Code') }}</th>
                                        <th class="px-2">{{ __('Amount') }}</th>
                                        <th class="px-2">{{ __('Uses') }}</th>
                                        <th class="px-2">{{ __('Max discount amount') }}</th>
                                        <th class="px-2">{{ __('Max use') }}</th>
                                        <th class="px-2">{{ __('Max use per user') }}</th>
                                        <th class="px-2">{{ __('Minimum cart amount') }}</th>
                                        <th class="px-2">{{ __('Active from') }}</th>
                                        <th class="px-2">{{ __('Expire at') }}</th>
                                        <th class="px-2">{{ __('Status') }}</th>
                                        <th class="px-2">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <!--end::Thead-->
                                <!--begin::Tbody-->
                                <tbody class="fs-6 fw-bold text-gray-600">
                                    @foreach ($coupons as $coupon)
                                    <tr>
                                        <td class="px-3">
                                            <a href="#">
                                                {{ $coupon->id }}
                                            </a>
                                        </td>
                                        <td class="text-black ">
                                            {{ $coupon->code }}
                                            
                                        </td>
                                        <td class="px-3">
                                            @if($coupon->type == \App\Enums\Admin\CouponTypes::FIXED_COUPON->value)
                                            <span class="text-success">
                                                {{ $coupon->amount }} {{ __('SAR') }}
                                            </span>
                                            @else
                                            <span class="text-primary">
                                                {{ $coupon->amount }}%
                                            </span>
                                            @endif
                                        </td>
                                        <td class="px-3">
                                            <span>{{ $coupon->users()->count() }}</span>
                                        </td>
                                        <td class="px-3">
                                            @if($coupon->max_discount_amount)
                                            <span>{{ $coupon->max_discount_amount }} {{ __('SAR') }}</span>
                                            @endif
                                        </td>
                                        <td class="px-3">
                                            @if($coupon->max_use)
                                            <span>{{ $coupon->max_use }} {{ __('each_time') }}</span>
                                            @endif
                                        </td>
                                        <td class="px-3">
                                            @if($coupon->max_use_per_user)
                                            <span>{{ $coupon->max_use_per_user }} {{ __('each_time') }}</span>
                                            @endif
                                        </td>
                                        <td class="px-3">
                                            @if($coupon->minimum_cart_amount)
                                            <span>{{ $coupon->minimum_cart_amount }} {{ __('SAR') }}</span>
                                            @endif
                                        </td>
                                        <td class="px-3">
                                            <span>{{ $coupon->active_from?->format('Y-m-d') }}</span>
                                        </td>
                                        <td class="px-3">
                                            <span>{{ $coupon->expire_at?->format('Y-m-d') }}</span>
                                        </td>
                                        <td>
                                            {{-- <span class="position-relative">
                                                <label class="@if($coupon->status) switch-opposite @else switch @endif">
                                                    <input type="checkbox" onclick="toggleStatus({{ $coupon->id }})">
                                                    <span class="slider"></span>
                                                </label>
                                            </span> --}}
                                            <?php $status = $coupon->expire_at->lt(today()) || !$coupon->status || !$coupon->validity ?>
                                            @if($coupon->deleted_at)
                                            <span class="badge badge-danger">{{ __('Deleted') }}</span>
                                            @elseif($status)
                                                <span class="badge badge-warning">{{__('not active')}}</span>
                                            @else 
                                                <span class="badge badge-success">{{__('active')}}</span>
                                            @endif
                                        </td>
                                        <td class="text-end">
                                            <a href="#" class="btn btn-sm btn-active-light-khardl" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">{{ __('Actions') }}
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                                <span class="svg-icon svg-icon-5 m-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon--></a>
                                            <!--begin::Menu-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-khardl fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                                <!--begin::Menu item-->
                                                
                                                <div class="menu-item px-3">

                                                    @if($status)
                                                    <a href="{{ route('coupons.edit',['coupon'=>$coupon->id,'branchId'=>$branchId]) }}" class="menu-link px-3">{{ __('Activate') }}</a>

                                                    @else
                                                    <a href="{{  route('coupons.change-status', ['coupon'=>$coupon->id,'branchId'=>$branchId]) }}" class="menu-link px-3">{{ __('Deactivate') }}</a>
                                                    <a href="{{ route('coupons.edit',['coupon'=>$coupon->id,'branchId'=>$branchId]) }}" class="menu-link px-3">{{ __('Edit') }}</a>
                                                    @endif
                                                </div>
                                                @if(!$coupon->deleted_at)
                                                <div class="menu-item px-3">
                                                    <form class="delete-form" id="delete_coupon_{{ $coupon->id }}" action="{{ route('coupons.delete', ['coupon' => $coupon->id,'branchId'=>$branchId]) }}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                    </form>
                                                    <a href="#" onclick='DeleteCoupon("{{ $coupon->id }}")' class="menu-link px-3">{{__('Delete')}}</a>
                                                </div>
                                                @endif
                                                @if($coupon->deleted_at)
                                                <div class="menu-item px-3">
                                                    <form class="restore-form" id="restore_coupon_{{ $coupon->id }}" action="{{ route('coupons.restore', ['coupon' => $coupon->id,'branchId'=>$branchId]) }}" method="POST">
                                                        @method('POST')
                                                        @csrf
                                                    </form>
                                                    <a href="#" onclick='RestoreCoupon("{{ $coupon->id }}")' class="menu-link px-3">{{__('Restore')}}</a>
                                                </div>
                                                @endif
                                            </div>

                                            <!--end::Menu-->
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <!--end::Tbody-->
                            </table>
                            {{ $coupons->withQueryString()->links('pagination::bootstrap-4') }}
                            <!--end::Table-->
                        </div>
                    </div>
                    <!--end::Tab panel-->

                </div>
                <!--end::Tab content-->
            </div>
            <!--end::Referred users-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>

<style>
    


  
    .carousel-control-prev-icon
    {
        background-image : url('/img/next.png')
    }
    .carousel-control-next-icon {
        background-image : url('/img/prev.png')
    }
    .carousel-inner{
        position: relative;
        width: 70%;
        margin: 0 115px;
    }
</style>
@endsection
@section('js')
<script>
    
    $(document).ready(function() {
  $('#carouselExample').carousel({
    pause: true,
    interval: false,
  });
});
   

    function DeleteCoupon(couponId) {
        event.preventDefault();

        var form = document.getElementById(`delete_coupon_${couponId}`);
        Swal.fire({
            title: `{{ __("Are you sure you want to delete this coupon ?") }}`
            , icon: 'warning'
            , showCancelButton: true
            , confirmButtonColor: '#d33'
            , cancelButtonColor: '#3085d6'
            , confirmButtonText: '{{ __("delete") }}'
            , cancelButtonText: '{{ __("cancel") }}'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }

    function RestoreCoupon(couponId) {
        event.preventDefault();

        var form = document.getElementById(`restore_coupon_${couponId}`);
        Swal.fire({
            title: `{{ __("Are you sure you want to restore this coupon ?") }}`
            , icon: 'warning'
            , showCancelButton: true
            , confirmButtonColor: '#50cd89'
            , cancelButtonColor: '#3085d6'
            , confirmButtonText: '{{ __("Restore") }}'
            , cancelButtonText: '{{ __("cancel") }}'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }

</script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

@endsection
