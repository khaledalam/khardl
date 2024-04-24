
@if($restaurant?->is_live())
    <span class="badge badge-light-success fw-bolder">{{ __('live')}}</span>
@elseif ($restaurant->user->status == \App\Models\User::STATUS_ACTIVE)
    <span class="badge badge-light-info fw-bolder">{{ __('pending')}}</span>
@elseif ($restaurant->user->status == \App\Models\User::RE_UPLOAD_FILES)
<span class="badge badge-light-info fw-bolder">{{ __('files re-uploaded')}}</span>
@elseif ($restaurant?->user?->isRejected())
    <span class="badge badge-danger fw-bolder">{{ __('rejected')}}</span>
@elseif ($restaurant?->user?->isBlocked())
    <span class="badge badge-danger fw-bolder">{{ __('blocked')}}</span>
@else
    <span class="badge badge-light-danger fw-bolder">{{ __('not_live')}}</span>
@endif

@if(isset($sub) && $sub->status == \App\Models\ROSubscription::ACTIVE)
<span class="badge badge-light-success fw-bolder">{{ __('Active subscription')}}</span>
@elseif(isset($sub) )
<span class="badge badge-warning fw-bolder">{{ __('subscription not active')}}</span>

@else

<span class="badge badge-danger fw-bolder">{{ __('No subscription')}}</span>
@endif
@if($customer_app && $customer_app->status == \App\Models\ROCustomerAppSub::REQUESTED)
<span class="badge badge-light-danger fw-bolder m-1">{{ __('Request for app')}}</span>
@endif