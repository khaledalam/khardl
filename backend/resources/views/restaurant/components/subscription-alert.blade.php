
<?php $setting = \App\Models\Tenant\Setting::first();?>

@if( !$setting->lead_id && !$setting->merchant_id)

<div class="alert alert-warning text-center">
    <h3>{{ __('You need to configure your payment account to start selling') }}</h3>
    <a href="{{ route('tap.payments_submit_lead_get') }}">
        <button class="btn btn-primary btn-sm my-2">{{ __('Manage payment gateway') }}</button>
    </a>
    </div>
@elseif($setting->lead_id && !$setting->merchant_id)
<div class="alert alert-warning text-center">
    <h3>{{ __('Your payment gateway account is currently waiting for approval to process selling orders') }}</h3>

</div>
@endif
@if ($sub=\App\Models\ROSubscription::first())
    @if($sub->status ==  \App\Models\ROSubscription::ACTIVE && \App\Models\Tenant\Branch::count() == 0)
    <div class="alert alert-success">
        <span class="badge badge-primary mx-1">&#9432;</span>

        {!! __('You must add a :branches to activate your subscription',['branches'=>
         "<a href='".route('restaurant.branches')."'>".__('branches')."</a>"
        ]) !!}
    </a>
    </div>
    @elseif($sub->status !=  \App\Models\ROSubscription::ACTIVE)
    <div class="alert alert-primary">
        <span class="badge badge-info mx-1">&#9432;</span>
        @if($sub->status == \App\Models\ROSubscription::SUSPEND)
        {{__('The current subscription period has expired, please renew in order to receive new orders')}}
        @elseif($sub->status == \App\Models\ROSubscription::DEACTIVATE)
        {{__('Please activate the branches so that you can receive orders')}}
        @endif
        <a href="{{route('restaurant.service')}}"><u>{{__('Activate your branches')}}</u></a>.
    </div>
    @elseif($sub->status ==  \App\Models\ROSubscription::ACTIVE && $sub->end_at->isPast())
        <div class="alert alert-warning">
            <span class="badge badge-danger mx-1">&#9432;</span>
            {{__('Your subscription has expired, please activate it before it is deactivated')}}
            <a href="{{route('restaurant.service')}}"><u>{{__('Activate your branches')}}</u></a>.
        </div>
    @endif
@else

    <div class="alert alert-warning">
        <span class="badge badge-danger mx-1">&#9432;</span>
        {{__('Subscribe to the available packages so that you can create branches')}}
        <a href="{{route('restaurant.service')}}"><u>{{__('Activate your branches')}}</u></a>.
    </div>
@endif
@if(!$setting->is_live)
<div class="alert alert-warning">
    <span class="badge badge-danger mx-1">&#9432;</span>
    {{ __('Your restaurant will be activated after completing the review process') }}

</div>
@endif
