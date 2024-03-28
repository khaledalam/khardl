@extends('layouts.restaurant-sidebar')

@section('title', __('order-summary'))

@section('content')

    <style>
        .timeline-label:before{
            right: 1px !important;
        }
        .timeline-label{
            overflow-y: scroll;
            height: 400px;
        }

    </style>

  <!--begin::Content-->
  <div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">

    @include('restaurant.orders.order-details')

 </div>
  <form id="approve-form"  method="POST" style="display: inline">
      @csrf
      @method('PUT')
      <input type="hidden" name="status" id="orderStatus" >
  </form>
  <script>
      function showConfirmation(orderId) {
          event.preventDefault();
          const statusOptions = @json(array_combine(\App\Models\Tenant\Order::STATUS,array_map(fn ($status) => __(''.$status), \App\Models\Tenant\Order::STATUS)));

          Swal.fire({
              text: '{{ __('are-you-sure-you-want-to-change-order-status')}}',
              icon: 'warning',
              input: 'select',
              showCancelButton: true,
              inputOptions: statusOptions,
              inputPlaceholder: 'Select an option',
              confirmButtonText: '{{ __('yes') }}',
              cancelButtonText: '{{ __('no') }}'
          }).then((result) => {
              if (result.isConfirmed) {
                  const selectedStatus = result.value;
                  document.getElementById('orderStatus').setAttribute('value',selectedStatus);
                  var form = document.getElementById('approve-form');
                  form.action = `{{ route('restaurant.branch.order.status', ['order' => ':orderId']) }}`.replace(':orderId', orderId)
                  form.submit();

              }
          });
      }
  </script>
 <!--end::Content-->
@endsection
