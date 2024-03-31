@section('title', __('order inquiry'))

@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div class="container w-80">
            <form action="" method="GET">
                @csrf
                <div class="form-group">
                    <input type="text" name="order_id" min="16" max="16" value="{{ request('order_id') }}" class="form-control mb-3" placeholder="{{ __('Enter order ID') }}">
                    <button class="btn btn-primary mt-2" type="submit">
                        {{ __('Search') }}
                        <!--begin::Svg Icon | path: icons/duotune/general/gen022.svg-->
                            <span class="svg-icon svg-icon-2">
                                <i class=" fa fa-search"></i>
                            </span>
                        <!--end::Svg Icon-->
                    </button>
                </div>
            </form>

            <hr class="w-50 py-1 my-5 m-auto" />

            @if (request('order_id') && $order)
                <div class="conatiner m-2 alert alert-success">
                    @include('restaurant.orders.order-details')
                </div>
            @elseif(request('order_id'))
                @if (app()->getLocale() == 'ar')
                    <h5 class="mt-2 alert alert-warning">{{ request('order_id') }} : {{ __('Order not found') }}</h5>
                @else
                    <h5 class="mt-2 alert alert-warning">{{ __('Order not found') }} : {{ request('order_id') }}</h5>
                @endif
            @endif
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->
@endsection
