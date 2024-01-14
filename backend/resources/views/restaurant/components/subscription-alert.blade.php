@if ($sub=\App\Models\ROSubscription::first())
    @if($sub->status !=  \App\Models\ROSubscription::ACTIVE)
    <div class="alert alert-warning">
        <span class="badge badge-danger mx-1">&#9432;</span>
        @if($sub->status == \App\Models\ROSubscription::SUSPEND)
        {{__('messages.The current subscription period has expired, please renew in order to receive new orders')}} 
        @elseif($sub->status == \App\Models\ROSubscription::DEACTIVATE)
        {{__('messages.Please activate the branches so that you can receive orders')}} 
        @endif
        <a href="{{route('restaurant.service')}}"><u>{{__('messages.Activate your branches')}}</u></a>.
    </div>
    @elseif($sub->status ==  \App\Models\ROSubscription::ACTIVE && $sub->end_at->isPast())
        <div class="alert alert-warning">
            <span class="badge badge-danger mx-1">&#9432;</span>
            {{__('messages.Your subscription has expired, please activate it before it is deactivated')}} 
            <a href="{{route('restaurant.service')}}"><u>{{__('messages.Activate your branches')}}</u></a>.
        </div>
    @endif
@else

    <div class="alert alert-warning">
        <span class="badge badge-danger mx-1">&#9432;</span>
        {{__('messages.Subscribe to the available packages so that you can create branches')}} 
        <a href="{{route('restaurant.service')}}"><u>{{__('messages.Activate your branches')}}</u></a>.
    </div>
@endif
