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
                    <option value="all" {{ request('user_id') == 'all' ? 'selected' : '' }}>All</option>
                    @foreach ($owners as $owner)
                        <option value="{{ $user->id }}" {{ request('user_id') == $owner->id ? 'selected' : '' }}>
                            {{ $owner->id }} | {{ $owner->first_name }} {{ $owner->last_name }}
                        </option>
                    @endforeach
                </select>

                <select id="actionsDropdown" name="action" class="form-select form-select-sm border-body bg-body w-150px me-5">
                    <option value="all" {{ request('action', 'all') == 'all' ? 'selected' : '' }}>All</option>
                    <option value="Logged in" {{ request('action') == 'Logged in' ? 'selected' : '' }}>{{ __('messages.logged-in') }}</option>
                    <option value="Has edited profile and permissions for an user with ID of" {{ request('action') == 'Has edited profile and permissions for an user with ID of' ? 'selected' : '' }}>{{ __('messages.has-edited-permissions') }}</option>
                    <option value="Made an user" {{ request('action') == 'Made an user' ? 'selected' : '' }}>{{ __('messages.made-an-user') }}</option>
                    <option value="Has activate restaurant" {{ request('action') == 'Has activate restaurant' ? 'selected' : '' }}>{{ __('messages.has-approved-restaurant') }}</option>
                    <option value="Made a promoter" {{ request('action') == 'Made a promoter' ? 'selected' : '' }}>{{ __('messages.made-a-promoter') }}</option>
                    <option value="Has edited his profile" {{ request('action') == 'Has edited his profile' ? 'selected' : '' }}>{{ __('messages.has-edited-his-profile') }}</option>
                    <option value="Has approved an user" {{ request('action') == 'Has approved an user' ? 'selected' : '' }}>{{ __('messages.has-approved-an-user') }}</option>
                    <option value="Has denied an user" {{ request('action') == 'Has denied an user' ? 'selected' : '' }}>{{ __('messages.has-denied-an-user') }}</option>
                    <option value="Has downloaded a commercial registration file" {{ request('action') == 'Has downloaded a commercial registration file' ? 'selected' : '' }}>{{ __('messages.has-downloaded-a-commercial-registration-file') }}</option>
                    <option value="Has downloaded a delivery contract file" {{ request('action') == 'Has downloaded a delivery contract file' ? 'selected' : '' }}>{{ __('messages.has-downloaded-a-delivery-contract-file') }}</option>
                    <option value="Has downloaded a tax number registration file" {{ request('action') == 'Has downloaded a tax number registration file' ? 'selected' : '' }}>{{ __('messages.has-downloaded-a-tax-number-file') }}</option>
                    <option value="Has downloaded a bank certificate contract file" {{ request('action') == 'Has downloaded a bank certificate contract file' ? 'selected' : '' }}>{{ __('messages.has-downloaded-a-bank-cerificate-file') }}</option>
                    <option value="Has deleted a restaurant" {{ request('action') == 'Has deleted a restaurant' ? 'selected' : '' }}>{{ __('messages.has-deleted-a-restaurant') }}</option>
                    <option value="Has deleted an user" {{ request('action') == 'Has deleted an user' ? 'selected' : '' }}>{{ __('messages.has-deleted-an-user') }}</option>
                </select>

                                  <!--end::Select-->
                <button type="submit" id="kt_ecommerce_add_product_submit"
                  class="btn btn-primary">
                  <span class="indicator-label">{{ __('messages.search') }}</span>
                  <span class="indicator-progress">{{ __('messages.please-wait')}}
                  <span
                  class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                </button>
              </div>

            </form>
                              <!--end::Actions-->
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
                    <th class="min-w-200px">#</th>
                    <th class="min-w-200px">{{ __('messages.actions') }}</th>
                    <th class="min-w-200px">{{ __('messages.date-and-time')}}</th>
                  </tr>
                </thead>
                <!--end::Thead-->
                <!--begin::Tbody-->
                <tbody class="fw-6 fw-bold text-gray-600">
                  @foreach ($logs as $log)
                    <tr data-user-id="{{ $log->user_id }}" data-action="{{ $log->action }}">
                      <td>
                        <a href="{{ route('admin.user-management-edit', ['id' => $log->user_id]) }}" class="text-hover-primary text-gray-600">{{ $log->user_id }}</a>
                      </td>
                      <td>
                        <span>
                          @if(app()->getLocale() === 'en')

                            {!! $log->action !!}

                          @else

                            @if($log->action == 'Logged in')
                                سجل دخوله
                            @elseif ($log->action == 'Has edited his profile.')
                            قام بتحرير ملفه الشخصي
                            @elseif (Str::contains($log->action, 'Has edited profile and permissions for an user with ID of:'))
                              @php
                                  $matches = [];
                                  if (preg_match('/\d+/', $log->action, $matches)) {
                                      $userId = $matches[0];
                                  }
                              @endphp
                              قام بتحرير الملف الشخصي والأذونات لمستخدم بمعرف: {{ $userId }}
                              @elseif (Str::contains($log->action, 'Made an user with an ID of:'))
                                @php
                                    $matches = [];
                                    if (preg_match('/\d+/', $log->action, $matches)) {
                                        $userId = $matches[0];
                                    }
                                @endphp
                              قام بصنع مستخدم بمعرف: {{ $userId }}

                              @elseif (Str::contains($log->action, 'Has approved an user with an ID of:'))
                                @php
                                    $matches = [];
                                    if (preg_match('/\d+/', $log->action, $matches)) {
                                        $userId = $matches[0];
                                    }
                                @endphp
                                قاما بقبول مطعم بمعرف: {{ $userId }}
                              @elseif (Str::contains($log->action, 'Has activate restaurant with an ID of:'))
                                @php
                                    $matches = [];
                                    if (preg_match('/\d+/', $log->action, $matches)) {
                                        $restaurat_id = $matches[0];
                                    }
                                @endphp
                                قاما بتفعيل مطعم بمعرف: {{ $restaurat_id }}
                              @elseif (Str::contains($log->action, 'Has downloaded a commercial registration file with a filename of:'))
                                @php
                                    $matches = [];
                                    if (preg_match('/filename of: (.+)$/', $log->action, $matches)) {
                                        $filename = $matches[1];
                                    }
                                @endphp
                            
                            قام بتنزيل ملف سجل تجاري الملف باسم: {{ $filename }}

                              @elseif (Str::contains($log->action, 'Has downloaded a tax number file with a filename of:'))
                                @php
                                      $matches = [];
                                      if (preg_match('/filename of: (.+)$/', $log->action, $matches)) {
                                          $filename = $matches[1];
                                      }
                                  @endphp
                              
                              قام بتنزيل ملف رقم ضريبي الملف باسم: {{ $filename }}

                              @elseif (Str::contains($log->action, 'Has downloaded a delivery contract file with a filename of:'))
                                @php  
                                    $matches = [];
                                    if (preg_match('/filename of: (.+)$/', $log->action, $matches)) {
                                        $filename = $matches[1];
                                    }
                                @endphp
                            
                            قام بتنزيل ملف عقد توصيل الملف باسم: {{ $filename }}

                              @elseif (Str::contains($log->action, 'Has downloaded a bank certificate file with a filename of:'))

                                @php
                                    $matches = [];
                                    if (preg_match('/filename of: (.+)$/', $log->action, $matches)) {
                                        $filename = $matches[1];
                                    }
                                @endphp
                            
                            لقد رفض مطعم بمعرف: {{ $filename }}

                              @elseif (Str::contains($log->action, 'Has denied an user with an ID of:'))
                                @php
                                    $matches = [];
                                    if (preg_match('/\d+/', $log->action, $matches)) {
                                        $userId = $matches[0];
                                    }
                                @endphp
                              لقد قام بحذف مطعم بمعرف:  {{ $userId }}

                              @elseif (Str::contains($log->action, 'Has deleted an user with an ID of:'))

                                @php
                                    $matches = [];
                                    if (preg_match('/\d+/', $log->action, $matches)) {
                                        $userId = $matches[0];
                                    }
                                @endphp
                                لقد قام بتحرير ملفه الشخصي: {{ $userId }}

                              @elseif (Str::contains($log->action, 'Has deleted a restaurant with an ID of:'))

                                @php
                                    $matches = [];
                                    if (preg_match('/\d+/', $log->action, $matches)) {
                                        $userId = $matches[0];
                                    }
                                @endphp
                              لقد قام بصنع مروج برقم تعريفي: {{ $userId }}

                              @elseif (Str::contains($log->action, 'Has edited his profile.'))

                                @php
                                    $matches = [];
                                    if (preg_match('/\d+/', $log->action, $matches)) {
                                        $userId = $matches[0];
                                    }
                                @endphp
                                {{ $userId }} is the id
                              @elseif (Str::contains($log->action, 'Made a promoter with an ID of:'))
                                    
                                @php
                                      $matches = [];
                                      if (preg_match('/\d+/', $log->action, $matches)) {
                                          $userId = $matches[0];
                                      }
                                  @endphp
                                  {{ $userId }} is the id
                              @endif
                          @endif
                        </span>
                      </td>
                      <td>{{ $log->created_at }}</td>
                    </tr>
                  @endforeach

                </tbody>
                <!--end::Tbody-->
              </table>

              
              <!--end::Table-->
            </div>
            
            <!--end::Table wrapper-->
          </div>

          
          <!--end::Card body-->
        </div>
        <div class="d-flex flex-stack flex-wrap pt-10">
          <div class="fs-6 fw-bold text-gray-700">
              Showing {{ $logs->firstItem() }} to {{ $logs->lastItem() }} of {{ $logs->total() }} entries
          </div>
          <!--begin::Pages-->
          <ul class="pagination">
              @if ($logs->currentPage() > 1)
                  <li class="page-item previous">
                      <a href="{{ $logs->previousPageUrl() }}" class="page-link">
                          <i class="previous"></i>
                      </a>
                  </li>
              @endif
      
              @for ($page = max(1, $logs->currentPage() - 2); $page <= min($logs->lastPage(), $logs->currentPage() + 2); $page++)
                  <li class="page-item {{ $page == $logs->currentPage() ? 'active' : '' }}">
                      <a href="{{ $logs->url($page) }}" class="page-link">{{ $page }}</a>
                  </li>
              @endfor
      
              @if ($logs->hasMorePages())
                  <li class="page-item next">
                      <a href="{{ $logs->nextPageUrl() }}" class="page-link">
                          <i class="next"></i>
                      </a>
                  </li>
              @endif
          </ul>
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