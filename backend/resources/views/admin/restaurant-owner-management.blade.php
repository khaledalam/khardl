@extends('layouts.admin-sidebar')


@section('title', __('restaurant-owner-management'))

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
                <div class="card-header border-0 pt-5">
                    <h3 class="card-title align-items-start flex-column">
                        <span class="card-label fw-bolder fs-3 mb-1">{{ __('restaurant-owners')}}</span>
                        <span class="text-muted mt-1 fw-bold fs-7">{{ count($admins) }} {{ __('restaurant-owners')}}</span>
                    </h3>
                    <form action="" method="GET" id="selectForm">
                        @csrf
                        <div class="card-toolbar form-group">
                            <select name="type"  id="selectType" class="form-select">
                                <option value="">{{ __('Select') }}</option>
                                <option value="complete_step_1" {{ request('type') === 'complete_step_1' ? 'selected' : '' }}>{{ __('Complete Step 1 only') }}</option>
                                <option value="complete_step_2" {{ request('type') === 'complete_step_2' ? 'selected' : '' }}>{{ __('Have restaurant') }}</option>
                                <option value="have_active_restaurant" {{ request('type') === 'have_active_restaurant' ? 'selected' : '' }}>{{ __('Have active restaurant') }}</option>
                                <option value="have_inactive_restaurant" {{ request('type') === 'have_inactive_restaurant' ? 'selected' : '' }}>{{ __('Have inactive restaurant') }}</option>
                                <option value="verified_email" {{ request('type') === 'verified_email' ? 'selected' : '' }}>{{ __('Verified email') }}</option>
                                <option value="not_verified_email" {{ request('type') === 'not_verified_email' ? 'selected' : '' }}>{{ __('Not verified email') }}</option>
                            </select>
                        </div>
                    </form>
                </div>
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
                                    <th class="min-w-25px">#</th>
                                    <th class="min-w-200px">{{ __('first-name')}}</th>
                                    <th class="min-w-150px">{{ __('last-name')}}</th>
                                    <th class="min-w-150px">{{ __('phone-number')}}</th>
                                    <th class="min-w-150px">{{ __('email')}}</th>
                                    <th class="min-w-150px">{{ __('restaurant')}}</th>
                                    <th class="min-w-150px text-end">{{ __('Allow Login')}}</th>
                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                                @foreach ($admins as $admin)
                                <tr>
                                    <td class="text-muted fw-bolder">
                                        {{ $admin->id }}
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex justify-content-start flex-column">
                                                <span href="#" class="text-dark fw-bolder text-hover-khardl fs-6">{{ $admin->first_name }}</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span href="#" class="text-dark fw-bolder text-hover-khardl d-block fs-6">{{ $admin->last_name }}</span>
                                    </td>
                                    <td>
                                        <span href="#" class="text-dark fw-bolder text-hover-khardl d-block fs-6">{{ $admin->phone }}</span>
                                    </td>
                                    <td>
                                        <span href="#" class="text-dark fw-bolder text-hover-khardl d-block fs-6">{{ $admin->email }}
                                            <br>
                                            @if(is_null($admin->email_verified_at))
                                            <span class="badge badge-warning">{{ __('unverified') }}</span>
                                            @else
                                            <span class="badge badge-success">{{ __('verified') }}</span>
                                            @endif
                                        </span>
                                    </td>
                                    <td>
                                        @if ($admin?->restaurant)
                                        <a class="text-dark fw-bolder text-hover-khardl d-block fs-6" href="{{ route('admin.view-restaurants', ['tenant' => $admin->restaurant?->id]) }}">
                                            {{ $admin->restaurant?->restaurant_name }}
                                            <br>
                                            @if ($admin->restaurant->is_live())
                                            <span class="badge badge-success">{{ __('active') }}</span>
                                            @else
                                            <span class="badge badge-warning">{{ __('inactive') }}</span>
                                            @endif
                                        </a>
                                        @else
                                        <span class="badge badge-secondary">{{ __('Not complete step 2') }}</span>
                                        @endif

                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-end flex-shrink-0">
                                            {{-- <a href="#" class="btn btn-icon btn-bg-light btn-active-color-khardl btn-sm me-1">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                    <span class="svg-icon svg-icon-3">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="currentColor" />
                        <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="currentColor" />
                      </svg>
                    </span>
                    <!--end::Svg Icon-->
                  </a> --}}
                                            <a href="#" class="btn  btn-active-color-khardl btn-sm me-1 toggle-status-btn" data-user-id="{{ $admin->id }}">
                                                <span class="svg-icon svg-icon-3">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input toggle-status-switch" type="checkbox" role="switch" id="flexSwitchCheck{{ $admin->id }}" {{ !$admin->isBlocked() ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="flexSwitchCheck{{ $admin->id }}"></label>
                                                    </div>
                                                </span>
                                            </a>


                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        {{ $admins->withQueryString()->links('pagination::bootstrap-4') }}
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
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script>
    var deleteButtons = document.querySelectorAll('.delete-button');
    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function(event) {
            event.preventDefault();

            var form = button.closest('.delete-form');

            Swal.fire({
                title: '{{ __('are-you-sure') }}'
                , text: "{{ __('you-wont-be-able-to-undo-this') }}"
                , icon: 'warning'
                , showCancelButton: true
                , confirmButtonColor: '#d33'
                , cancelButtonColor: '#3085d6'
                , confirmButtonText: '{{ __('delete ') }}'
                , cancelButtonText: '{{ __('cancel') }}'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

</script>

<script>
    $(document).ready(function() {
        $('.toggle-status-btn').click(function(event) {
            event.preventDefault();

            const userId = $(this).data('user-id');
            const switchCheckbox = $(`#flexSwitchCheck${userId}`);

            // Make an AJAX request to toggle the status
            $.ajax({
                url: `{{ route('admin.toggle-status', ['user' => '__user_id__']) }}`.replace('__user_id__', userId)
                , type: 'POST'
                , dataType: 'json'
                , data: {
                    '_token': '{{ csrf_token() }}', // Include the CSRF token
                }
                , success: function(response) {
                    // Update the switch state based on the new status
                    switchCheckbox.prop('checked', !response.isBlocked);
                }
                , error: function(error) {
                    console.error('Error toggling user status:', error);
                }
            });
        });
    });
    document.getElementById('selectType').addEventListener('change', function () {
        document.getElementById('selectForm').submit();
    });

</script>
@endsection
