@extends('layouts.admin-sidebar')

@section('title', __('Purchase notifications'))

@section('content')
<div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">

    <!--begin::Post-->
    <div class="tables-page m-4">
        <div class="row">
            <div class="col-md-12 mb-5 card">
                <div class="card-header d-flex align-items-center justify-content-between flex-xxl-row flex-lg-row flex-md-row flex-column">
                    <strong class="title_head h4 fw-semibold d-block text-primary">
                        {{ $notification->name }}
                    </strong>
                    <span>
                        <div class="d-flex">
                            <a href="{{ route('admin.notifications-receipt.edit', ['notifications_receipt' => $notification->id]) }}" class="btn btn-icon btn-bg-light btn-active-color-khardl btn-sm me-1">
                                <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                <span class="svg-icon svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor" />
                                        <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->
                            </a>
                            <form class="delete-form" action="{{ route('admin.notifications-receipt.destroy', ['notifications_receipt' => $notification->id]) }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button type="submit" class="delete-button btn btn-icon btn-bg-light btn-active-color-khardl btn-sm">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen027.svg-->
                                    <span class="svg-icon svg-icon-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor" />
                                            <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor" />
                                            <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </button>
                            </form>
                        </div>
                    </span>
                    <a href="{{ route('admin.notifications-receipt.index') }}">
                        <button type="button" class="btn btn-primary btn-sm">
                            <i class="fa fa-arrow-left"></i>
                            {{ __('Back to list') }}
                        </button>
                    </a>
                </div>
                <div class="card-body table-responsive">
                    <table class="table">
                        <tbody>
                            <tr>
                                <td>{{ __("Email") }}</td>
                                <td class="text-info">{{ $notification->email }}</td>
                            </tr>
                            <tr>
                                <td>{{ __("On purchase the app") }}</td>
                                <td>
                                    @if ($notification->is_application_purchase)
                                    <span class="badge active">
                                        {{ __('Yes') }}
                                    </span>
                                    @else
                                    <span class="badge inactive">
                                        {{ __('No') }}
                                    </span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __("On purchase branch") }}</td>
                                <td>
                                    @if ($notification->is_branch_purchase)
                                    <span class="badge active">
                                        {{ __('Yes') }}
                                    </span>
                                    @else
                                    <span class="badge inactive">
                                        {{ __('No') }}
                                    </span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __('Created at') }}</td>
                                <td>
                                    <span>{{ $notification->created_at?->format('Y-m-d') }}</span>
                                </td>
                            </tr>
                            <tr>
                                <td>{{ __("Status") }}</td>
                                <td class="text-info">
                                    <span class="position-relative">
                                        <label class="@if($notification->active) switch-opposite @else switch @endif">
                                            <input type="checkbox" onclick="toggleStatus({{ $notification->id }})">
                                            <span class="slider"></span>
                                        </label>
                                    </span>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->
@endsection
@section('js')
<script>
    function toggleStatus(itemId) {
        $.ajax({
            url: `{{ route('admin.notifications-change-status', ['notifications_receipt' => ':itemId']) }}`.replace(':itemId', itemId)
            , type: 'POST'
            , dataType: 'json'
            , data: {
                '_token': '{{ csrf_token() }}'
            , }
            , success: function(response) {

            }
            , error: function(error) {
                console.error('Error toggling user status:', error);
            }
        });
    }

</script>
@endsection
