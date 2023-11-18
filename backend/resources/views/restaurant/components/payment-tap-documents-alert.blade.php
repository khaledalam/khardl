@if ($user && $user?->submitedTapDocuments == 0)
    <div class="alert alert-warning">
        <span class="badge badge-danger mx-1">&#9432;</span> Your TAP account is not approved yet, please <a href="{{route('tap.payments_submit_tap_documents')}}"><u>submit your TAP documents</u></a>.
    </div>
@endif
