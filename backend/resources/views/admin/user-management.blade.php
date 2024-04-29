@extends('layouts.admin-sidebar')


@section('title', __('user-management'))

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
       <span class="card-label fw-bolder fs-3 mb-1">{{ __('admin-staff')}}</span>
       <span class="text-muted mt-1 fw-bold fs-7">{{ count($admins) }} {{ __('admins')}}</span>
     </h3>
     @if($user?->hasPermission("can_add_admins"))
     <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="{{ __('Add') }}">
       <a href="{{ route('admin.add-user') }}" class="btn btn-sm btn-light btn-active-primary">
       <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
       <span class="svg-icon svg-icon-3">
         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
           <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor" />
           <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor" />
         </svg>
       </span>
       <!--end::Svg Icon-->{{ __('new-admin')}}</a>
     </div>
     @endif
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
             <th class="min-w-150px text-end">{{ __('actions')}}</th>
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
                    <span href="#" class="text-dark fw-bolder text-hover-primary fs-6">{{ $admin->first_name }}</span>
                  </div>
                </div>
              </td>
              <td>
                <span href="#" class="text-dark fw-bolder text-hover-primary d-block fs-6">{{ $admin->last_name }}</span>
              </td>
                                          <td>
                <span href="#" class="text-dark fw-bolder text-hover-primary d-block fs-6">{{ $admin->phone }}</span>
              </td>
                                          <td>
                <span href="#" class="text-dark fw-bolder text-hover-primary d-block fs-6">{{ $admin->email }}</span>
              </td>
              <td>
                <div class="d-flex justify-content-end flex-shrink-0">
                  {{-- <a href="#" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                    <!--begin::Svg Icon | path: icons/duotune/general/gen019.svg-->
                    <span class="svg-icon svg-icon-3">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path d="M17.5 11H6.5C4 11 2 9 2 6.5C2 4 4 2 6.5 2H17.5C20 2 22 4 22 6.5C22 9 20 11 17.5 11ZM15 6.5C15 7.9 16.1 9 17.5 9C18.9 9 20 7.9 20 6.5C20 5.1 18.9 4 17.5 4C16.1 4 15 5.1 15 6.5Z" fill="currentColor" />
                        <path opacity="0.3" d="M17.5 22H6.5C4 22 2 20 2 17.5C2 15 4 13 6.5 13H17.5C20 13 22 15 22 17.5C22 20 20 22 17.5 22ZM4 17.5C4 18.9 5.1 20 6.5 20C7.9 20 9 18.9 9 17.5C9 16.1 7.9 15 6.5 15C5.1 15 4 16.1 4 17.5Z" fill="currentColor" />
                      </svg>
                    </span>
                    <!--end::Svg Icon-->
                  </a> --}}
                  <a href="#" class="btn  btn-active-color-primary btn-sm me-1 toggle-status-btn" data-user-id="{{ $admin->id }}">
                    <span class="svg-icon svg-icon-3">
                        <div class="form-check form-switch">
                            <input class="form-check-input toggle-status-switch" type="checkbox" role="switch" id="flexSwitchCheck{{ $admin->id }}" {{ !$admin->isBlocked() ? 'checked' : '' }}>
                            <label class="form-check-label" for="flexSwitchCheck{{ $admin->id }}"></label>
                        </div>
                    </span>
                </a>
                @if($user?->hasPermission("can_edit_admins"))
                  <a href="{{ route('admin.user-management-edit', ['id' => $admin->id]) }}" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                    <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                    <span class="svg-icon svg-icon-3">
                      <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor" />
                        <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor" />
                      </svg>
                    </span>
                    <!--end::Svg Icon-->
                  </a>
                
                  <form class="delete-form" action="{{ route('admin.delete-user', ['id' => $admin->id]) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" class="delete-button btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
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
                  @endif
                </div>
              </td>
            </tr>
          @endforeach
         </tbody>
         <!--end::Table body-->
       </table>
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
                          title: '{{ __('are-you-sure') }}',
                          text: "{{ __('you-wont-be-able-to-undo-this') }}",
                          icon: 'warning',
                          showCancelButton: true,
                          confirmButtonColor: '#d33',
                          cancelButtonColor: '#3085d6',
                          confirmButtonText: '{{ __('delete') }}',
                          cancelButtonText: '{{ __('cancel') }}'
                      }).then((result) => {
                          if (result.isConfirmed) {
                              form.submit();
                          }
                      });
                  });
              });
</script>

<script>
  $(document).ready(function () {
        $('.toggle-status-btn').click(function (event) {
            event.preventDefault();

            const userId = $(this).data('user-id');
            const switchCheckbox = $(`#flexSwitchCheck${userId}`);

            // Make an AJAX request to toggle the status
            $.ajax({
                url: '{{ route('admin.toggle-status', ['user' => '__user_id__']) }}'.replace('__user_id__', userId),
                type: 'POST',
                dataType: 'json',
                data: {
                    '_token': '{{ csrf_token() }}', // Include the CSRF token
                },
                success: function (response) {
                    // Update the switch state based on the new status
                    switchCheckbox.prop('checked', !response.isBlocked);
                },
                error: function (error) {
                    console.error('Error toggling user status:', error);
                }
            });
        });
    });
</script>
@endsection
