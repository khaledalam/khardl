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
                    <h3 class="card-title">
                        <span class="card-label fw-bolder fs-3 mb-1">{{ __('restaurant-owners')}}</span>
                        <span class="mx-2 text-muted mt-1 fw-bold fs-7">{{ count($admins) }} {{ __('restaurant-owners')}}</span>
                        <form action="" method="GET" id="selectForm">
                            @csrf
                            <div class="d-flex align-items-center">
                                <input type="text" class="form-control form-control-solid ps-10" name="search" value="{{ request('search') }}" placeholder="{{ __('search') }}" />
                                <div class="position-relative w-md-400px me-md-2">
                                    <div class="card-toolbar form-group mx-2 me-md-2">
                                        <select name="type" id="selectType" class="form-select form-select-solid">
                                            <option value="">{{ __('Select') }}</option>
                                            <option value="complete_step_1" {{ request('type') === 'complete_step_1' ? 'selected' : '' }}>{{ __('Complete Step 1 only') }}</option>
                                            <option value="complete_step_2" {{ request('type') === 'complete_step_2' ? 'selected' : '' }}>{{ __('Have restaurant') }}</option>
                                            <option value="have_active_restaurant" {{ request('type') === 'have_active_restaurant' ? 'selected' : '' }}>{{ __('Have active restaurant') }}</option>
                                            <option value="have_inactive_restaurant" {{ request('type') === 'have_inactive_restaurant' ? 'selected' : '' }}>{{ __('Have inactive restaurant') }}</option>
                                            <option value="verified_email" {{ request('type') === 'verified_email' ? 'selected' : '' }}>{{ __('Verified email') }}</option>
                                            <option value="not_verified_email" {{ request('type') === 'not_verified_email' ? 'selected' : '' }}>{{ __('Not verified email') }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="d-flex align-items-center">
                                    <button type="submit" class="btn btn-active-light-khardl me-5">{{ __('search')}}</button>
                                </div>
                            </div>
                        </form>
                        <a href="{{ route('admin.owner-information.create') }}" class="btn btn-khardl">{{ __("Add new") }}</a>
                    </h3>
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
                                    <th class="min-w-150px">{{ __('Allow Login')}}</th>
                                    @if (Auth::user()->hasPermission('can_delete_restaurants'))
                                    <th class="min-w-150px ">{{ __('Actions')}}</th>
                                    @endif
                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                                @foreach ($admins as $admin)
                                <tr>
                                    <td class="text-muted fw-bolder">
                                        <a href="{{ route('admin.owner-information.show',['user' => $admin->id]) }}">
                                            {{ $admin->id }}
                                        </a>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex justify-content-start flex-column">
                                                <a href="{{ route('admin.owner-information.show',['user' => $admin->id]) }}" class="text-dark fw-bolder text-hover-khardl fs-6">{{ $admin->first_name }}</a>
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
                                            @if ($admin->restaurant?->is_live())
                                            <span class="badge badge-success">{{ __('active') }}</span>
                                            @else
                                            <span class="badge badge-warning">{{ __('inactive') }}</span>
                                            @endif
                                        </a>
                                        @else
                                        <span class="badge badge-secondary">{{ __('Not complete step 2') }}</span>
                                        <a href="{{ route('admin.complete-step-two.index',['user' => $admin->id]) }}" class="text-muted d-block" target="_blank">
                                            <u>
                                                {{ __('Complete step 2 manually') }}
                                            </u>
                                        </a>
                                        @endif
                                    </td>
                                    <td class="d-flex justify-content-center">
                                        <div class="d-flex justify-content-end flex-shrink-0">
                                            <a href="#" class="btn  btn-active-khardl btn-sm me-1 toggle-status-btn" data-user-id="{{ $admin->id }}">
                                                <span class="svg-icon svg-icon-3">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input toggle-status-switch" type="checkbox" role="switch" id="flexSwitchCheck{{ $admin->id }}" {{ !$admin->isBlocked() ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="flexSwitchCheck{{ $admin->id }}"></label>
                                                    </div>
                                                </span>
                                            </a>
                                        </div>
                                    </td>
                                    @if (Auth::user()->hasPermission('can_delete_restaurants'))
                                    <td>
                                        @if ($admin->restaurant)
                                        <form  id="delete-restaurant-{{ $admin->id }}" href="#" action="{{ route('admin.delete-restaurant', ['user' => $admin->id]) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <input type="hidden" name="restaurant_name" id="restaurant_name_{{ $admin->id }}">
                                            <input type="hidden" name="password" id="password_{{ $admin->id }}">
                                            <button type="button" class="btn btn-danger btn-sm" onclick='deleteRestaurant("{{ $admin->id }}")'>
                                                <i class="fa fa-trash-alt text-white px-1"></i>
                                                {{ __('Delete restaurant') }}
                                            </button>
                                        </form>
                                        @else
                                        <form class="delete-form" action="{{ route('admin.delete-account', ['user' => $admin->id]) }}" method="POST">
                                            @method('DELETE')
                                            @csrf
                                            <button type="submit" class="delete-button btn btn-danger btn-sm">
                                                <i class="fa fa-trash-alt text-white px-1"></i>
                                                {{ __('Delete account') }}
                                            </button>
                                          </form>
                                        @endif
                                    </td>
                                    @endif
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
                title: `{{ __('are-you-sure') }}`
                , text: "{{ __('you-wont-be-able-to-undo-this') }}"
                , icon: 'warning'
                , showCancelButton: true
                , confirmButtonColor: '#d33'
                , cancelButtonColor: '#3085d6'
                , confirmButtonText: `{{ __('delete') }}`
                , cancelButtonText: `{{ __('cancel') }}`
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

</script>
@push('scripts')
    <script>
       function deleteRestaurant(user) {
        event.preventDefault();

        Swal.fire({
            text: `{{ __("Are you sure you want to delete this restaurant ?") }}`,
            icon: 'warning',
            html: `
                <label>{{ __('Restaurant Name(English)') }}</label>
            <input type="text" id="restaurant-name-input" required class="swal2-input" placeholder="{{ __('Enter restaurant name') }}">
                <label>{{ __('Password') }}</label>
                <input type="text" id="password-input" required class="swal2-input" placeholder="{{ __('Enter password') }}">
            `,
            showCancelButton: true,
            confirmButtonText: "{{ __('Delete permanently') }}",
            cancelButtonText: "{{ __('No') }}",
            confirmButtonColor: '#d33',
            preConfirm: () => {
                return {
                    restaurant_name: document.getElementById('restaurant-name-input').value,
                    password: document.getElementById('password-input').value
                }
            }
            }).then((result) => {
                if (result.isConfirmed) {
                    // Get the form and inputs
                    var form = document.getElementById(`delete-restaurant-${user}`);
                    var restaurantNameInput = document.getElementById(`restaurant_name_${user}`);
                    var passwordInput = document.getElementById(`password_${user}`);

                    // Set the values from the Swal inputs to the hidden form inputs
                    restaurantNameInput.value = result.value.restaurant_name;
                    passwordInput.value = result.value.password;

                    // Submit the form
                    form.submit();
                }
            });
        }
    </script>
    @endpush
@endsection
