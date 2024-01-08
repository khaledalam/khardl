@extends('layouts.admin-sidebar')


@section('title', __('messages.subscriptions'))

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
       <span class="card-label fw-bolder fs-3 mb-1">{{ __('messages.subscriptions')}}</span>
       <span class="text-muted mt-1 fw-bold fs-7">{{ count($subscriptions) }} {{ __('messages.subscriptions')}}</span>
     </h3>
     <div class="card-toolbar" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="Click to add a user">
       <a href="{{ route('admin.subscriptions.create') }}" class="btn btn-sm btn-light btn-active-primary">
       <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
       <span class="svg-icon svg-icon-3">
         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
           <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor" />
           <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor" />
         </svg>
       </span>
       <!--end::Svg Icon-->{{ __('messages.New subscription')}}</a>
     </div>
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
             <th class="min-w-200px">{{ __('messages.name')}}</th>
             <th class="min-w-150px">{{ __('messages.Price')}}</th>
            </tr>
         </thead>
         <!--end::Table head-->
         <!--begin::Table body-->
         <tbody>
          @foreach ($subscriptions as $subscription)
            <tr>
              <td class="text-muted fw-bolder">
                  {{ $subscription->id }}
              </td>
              <td>
                <div class="d-flex align-items-center">
                  <div class="d-flex justify-content-start flex-column">
                    <span href="#" class="text-dark fw-bolder text-hover-primary fs-6">{{ $subscription->name }}</span>
                  </div>
                </div>
              </td>
              <td>
                <span href="#" class="text-dark fw-bolder text-hover-primary d-block fs-6">{{ $subscription->amount }}</span>
              </td>
                                       
                
               
                  
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
                          title: '{{ __('messages.are-you-sure') }}',
                          text: "{{ __('messages.you-wont-be-able-to-undo-this') }}",
                          icon: 'warning',
                          showCancelButton: true,
                          confirmButtonColor: '#d33',
                          cancelButtonColor: '#3085d6',
                          confirmButtonText: '{{ __('messages.delete') }}',
                          cancelButtonText: '{{ __('messages.cancel') }}'
                      }).then((result) => {
                          if (result.isConfirmed) {
                              form.submit();
                          }
                      });
                  });
              });
</script>


@endsection
