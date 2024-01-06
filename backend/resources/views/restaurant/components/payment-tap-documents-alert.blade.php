@if (!\App\Models\Tenant\Tap\TapBusiness::first())
    <div class="alert alert-warning">
        <span class="badge badge-danger mx-1">&#9432;</span> {{__('messages.payment-gateway-approve-warning-text')}} <a href="{{route('tap.payments_upload_tap_documents_get')}}"><u>{{__('messages.payment-gateway-approve-warning-link-text')}}</u></a>.
    </div>
@endif
