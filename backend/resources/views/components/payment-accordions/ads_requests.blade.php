<div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button bg-khardl text-white" type="button" data-bs-toggle="collapse" data-bs-target="#paid_orders" aria-expanded="true" aria-controls="paid_orders">
            {{ __('Advertising requests') }}
        </button>
    </h2>
    <div id="paid_orders" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
        <div class="accordion-body">
            <!--begin::Content-->
            @if($requestedPackages?->count())
            @include('components.ads_requested.list')
            @else
            <div class="alert alert-warning text-center">
                <h4>{{ __('You do not have any advertising services before.') }}</h4>
                @if(Auth::user()->hasPermission('can_access_advertising_services'))
                <span class="text-muted">
                    <u>
                        <a href="{{ route('restaurant.advertisements.index') }}">
                            {{ __('You can request an advertising service from here') }}
                        </a>
                    </u>
                </span>
                @endif
            </div>
            @endif

        </div>
    </div>
</div>
