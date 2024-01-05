@extends('layouts.admin-sidebar')


@section('title', __('messages.logs'))

@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">

            <!--begin::Login sessions-->
            <div class="card mb-5 mb-lg-10">
                <!--begin::Card header-->
                <div class="card-header d-flex justify-content-between align-items-center">
                    <!--begin::Heading-->
                    <div class="card-title">
                        <h3>{{ __('messages.logs') }}</h3>
                    </div>
                    <!--begin::Actions-->
                    <form method="GET" action="{{ route('admin.log') }}">
                        <div class="d-flex my-0">
                            <!--begin::Select-->
                            <select id="usersDropdown" name="user_id" class="form-select form-select-sm border-body bg-body w-150px me-5">
                                <option value="" selected>{{ __('messages.All') }}</option>
                                @foreach ($owners as $owner)
                                <option value="{{ $owner->id }}" {{ request('user_id') == $owner->id ? 'selected' : '' }}>
                                    {{ $owner->id }} | {{ $owner->first_name }} {{ $owner->last_name }}
                                </option>
                                @endforeach
                            </select>

                            <select id="actionsDropdown" name="action" class="form-select form-select-sm border-body bg-body w-250px me-5">
                                <option value="" selected>{{ __('messages.All') }}</option>
                                @foreach ($logTypes as $type)
                                    <option {{ request('action') == $type ? 'selected' : '' }} value="{{ $type }}">{{ __('messages.'.$type) }}</option>
                                @endforeach
                            </select>
                            <select id="actionsDropdown" name="perPage" class="form-select form-select-sm border-body bg-body w-100px me-5">
                                <option value="">{{ __('messages.Per page') }}</option>
                                <option value="10" {{ request('perPage') == 10 ? 'selected' : '' }}>10</option>
                                <option value="20" {{ request('perPage') == 20 ? 'selected' : '' }}>20</option>
                                <option value="50" {{ request('perPage') == 50 ? 'selected' : '' }}>50</option>
                                <option value="100" {{ request('perPage') == 100 ? 'selected' : '' }}>100</option>

                            </select>
                            <!--end::Select-->
                            <button type="submit" id="kt_ecommerce_add_product_submit" class="btn btn-primary">
                                <span class="indicator-label">{{ __('messages.search') }}</span>
                                <span class="indicator-progress">{{ __('messages.please-wait')}}
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>

                    </form>
                    <form method="GET" action="{{ route('admin.log') }}">
                        <div class="d-flex my-0">
                            <input type="hidden" name="download" value="csv">
                            <button type="submit" id="download_logs" class="btn btn-success mx-2">
                                <span class="indicator-label">{{ __('messages.Download') }}</span>
                                <span class="indicator-progress">{{ __('messages.please-wait')}}
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </form>
                </div>
                <!--end::Card header-->
                <!--begin::Card body-->
                <div class="card-body p-0">
                    <!--begin::Table wrapper-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table id="logsTable" class="table table-flush align-middle table-row-bordered table-row-solid gy-4 gs-9">
                            <!--begin::Thead-->
                            <thead class="border-gray-200 fs-5 fw-bold bg-lighten">
                                <tr>
                                    <th class="min-w-200px">{{ __("messages.Customer") }}</th>
                                    <th class="min-w-200px">{{ __('messages.actions') }}</th>
                                    <th class="min-w-200px">{{ __('messages.Type') }}</th>
                                    <th class="min-w-200px">{{ __('messages.date-and-time')}}</th>
                                    <th class="min-w-200px">{{ __('messages.metadata')}}</th>
                                </tr>
                            </thead>
                            <!--end::Thead-->
                            <!--begin::Tbody-->
                            <tbody class="fw-6 fw-bold text-gray-600">
                                @foreach ($logs as $log)
                                <tr data-user-id="{{ $log->user?->id }}" data-action="{{ $log->action }}">
                                    <td>
                                        @if($log->user)
                                        <a href="{{ route('admin.user-management-edit', ['id' => $log->user?->id]) }}" class="text-hover-primary text-gray-600">{{ $log->user?->full_name }}</a>
                                        @endif
                                    </td>
                                    <td>
                                        <span>
                                            {!! $log->action !!}
                                        </span>
                                    </td>
                                    <td>
                                        @if($log->type!=null)
                                            {{ __('messages.'.$log->type) }}
                                        @endif
                                    </td>
                                    <td>{{ $log->created_at }}</td>
                                    <td>
                                        @if (isset($log->metadata['email']))
                                            {{ $log->metadata['email'] }}
                                        @elseif(isset($log->metadata['reason']))
                                            <ul>
                                                @foreach ($log->metadata['reason'] as $reason)
                                                <li>
                                                    {{ $reason }}
                                                </li>
                                                @endforeach
                                            </ul>
                                        @elseif($log->type == \App\Enums\Admin\LogTypes::UpdateSettings->value)
                                            @if(isset($log->metadata['webhook_url']))
                                            <p>
                                                {{ __('messages.webhook-url') }} :
                                                <strong>{{ $log->metadata['webhook_url'] }}</strong>
                                            </p>
                                            @endif
                                            @if(isset($log->metadata['live_chat_enabled']))
                                            <p>
                                                {{ __('messages.live-chat') }} :
                                                <strong>{{ $log->metadata['live_chat_enabled'] }}</strong>
                                            </p>
                                            @endif
                                        @endif
                                    </td>
                                </tr>
                                @endforeach

                            </tbody>
                            <!--end::Tbody-->
                        </table>
                        {{ $logs->links('pagination::bootstrap-4') }}

                        <!--end::Table-->
                    </div>

                    <!--end::Table wrapper-->
                </div>


                <!--end::Card body-->
            </div>
            <!--end::Login sessions-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>

<script src="https://unpkg.com/xlsx/dist/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Blob.js/1.1.1/blob.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!--end::Content-->
@endsection
