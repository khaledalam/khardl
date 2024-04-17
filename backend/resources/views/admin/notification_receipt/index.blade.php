@extends('layouts.admin-sidebar')

@section('title', __('Purchase notifications'))

@section('content')

<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Tables Widget 9-->
            <div class="card mb-5 mb-xl-8">
                <!--begin::Header-->
                <form action="">
                    <div class="card-title border-0 pt-5 d-flex align-items-center position-relative my-1">
                        <h3 class="card-title align-items-start flex-column mx-2">
                            <span class="card-label fw-bolder fs-3 mb-1">{{ __('Users') }}
                        </h3>
                        <input type="text" value="{{ request('search') }}" placeholder="{{ __('By name, email') }}" name="search" class="form-control  w-200px" />
                        <div class="form-group mx-2">
                            <select name="active" id="status" class="form-select w-200px">
                                <option value="">{{ __('Select') }}</option>
                                <option value="true" {{ request('active') == 'true' ? 'selected' : ''  }}>{{ __('active') }}</option>
                                <option value="false" {{ request('active') == 'false' ? 'selected' : ''  }}>{{ __('inactive') }}</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-secondary"> {{ __('Filter') }}</button>
                        <div class="card-toolbar mx-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="{{ __('Add') }}">
                            <a href="{{ route('admin.notifications-receipt.create') }}" class="btn btn-sm btn-light btn-active-khardl">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                <span class="svg-icon svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor" />
                                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->{{ __('New notification') }}</a>
                        </div>
                    </div>
                </form>

                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body py-3">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                            <!--begin::Table head-->
                            <thead>
                                <tr class="fw-bolder text-muted">
                                    <th class="min-w-200px">{{ __('Name') }}</th>
                                    <th class="min-w-200px">{{ __('Email') }}</th>
                                    <th class="min-w-150px">{{ __('On purchase the app') }}</th>
                                    <th class="min-w-150px">{{ __('On purchase branch') }}</th>
                                    <th class="min-w-150px">{{ __('Status') }}</th>
                                    <th class="min-w-150px">{{ __('Created at') }}</th>
                                    <th class="min-w-150px text-end">{{ __('actions') }}</th>
                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                                @foreach ($notifications as $notification)
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex justify-content-start flex-column">
                                                <a class="text-dark fw-bolder text-hover-khardl fs-6">{{ $notification->name }}</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p>
                                            {{ $notification->email }}
                                        </p>
                                    </td>
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
                                    <td class="px-2">
                                        <span class="position-relative">
                                            <label class="@if($notification->active) switch-opposite @else switch @endif">
                                                <input type="checkbox" onclick="toggleStatus({{ $notification->id }})">
                                                <span class="slider"></span>
                                            </label>
                                        </span>
                                    </td>
                                    <td class="px-2">
                                        <span>{{ $notification->created_at?->format('Y-m-d') }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-end flex-shrink-0">
                                            <a href="{{ route('admin.notifications-receipt.show', ['notifications_receipt' => $notification->id]) }}" class="btn btn-icon btn-bg-light btn-active-color-khardl btn-sm me-1">
                                        <i class="fa fa-eye"></i>
                                        </a>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                    </tbody>
                    <!--end::Table body-->
                    </table>
                    {{ $notifications->withQueryString()->links('pagination::bootstrap-4') }}
                    <!--end::Table-->
                </div>
                <!--end::Table container-->
            </div>
            <!--begin::Body-->
        </div>
        <!--end::Tables Widget 9-->
    </div>
    <!--end::Container-->
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
