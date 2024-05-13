<!--begin::Post-->
<div class="post d-flex flex-column-fluid" id="kt_post">
    <!--begin::Container-->
    <div id="kt_content_container" class="container-xxl">
        <!--begin::Order details page-->
        <div class="d-flex flex-column gap-7 gap-lg-10">
            <div class="d-flex flex-wrap flex-stack gap-3 gap-lg-10">
                <!--begin:::Tabs-->
                <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-lg-n2 me-auto">
                    <!--begin:::Tab item-->
                    <li class="nav-item">
                        <a class="nav-link text-active-khardl pb-4 active" data-bs-toggle="tab" href="#kt_ecommerce_sales_order_summary">{{__('order-summary')}}</a>
                    </li>
                    <!--end:::Tab item-->

                </ul>
                <!--end:::Tabs-->
                <!--begin::Button-->
                <a href="{{route('restaurant.orders_all')}}" class="btn btn-icon btn-light-khardl btn-sm ms-auto me-lg-n7">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr074.svg-->
                    <span class="svg-icon svg-icon-2">
                                 <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                     <path d="M11.2657 11.4343L15.45 7.25C15.8642 6.83579 15.8642 6.16421 15.45 5.75C15.0358 5.33579 14.3642 5.33579 13.95 5.75L8.40712 11.2929C8.01659 11.6834 8.01659 12.3166 8.40712 12.7071L13.95 18.25C14.3642 18.6642 15.0358 18.6642 15.45 18.25C15.8642 17.8358 15.8642 17.1642 15.45 16.75L11.2657 12.5657C10.9533 12.2533 10.9533 11.7467 11.2657 11.4343Z" fill="currentColor" />
                                 </svg>
                             </span>
                    <!--end::Svg Icon-->
                </a>
                <!--end::Button-->
                <!--begin::Button-->
                <!-- <a href="demo1/dist/apps/ecommerce/sales/edit-order.html" class="btn btn-light-khardl btn-sm me-lg-n7">Edit Order</a> -->
                <!--end::Button-->
                <!--begin::Button-->
                {{--                         <a href="#" class="btn btn-active-light-khardl btn-sm">Edit Order</a>--}}
                @if($order->status == \App\Models\Tenant\Order::ACCEPTED)
                    <a href="#"  class="btn btn-light-success btn-sm text-black" >{{__("accepted")}}</a>
                @elseif($order->status ==  \App\Models\Tenant\Order::PENDING)
                    <a href="#"  class="btn btn-light-warning btn-sm">{{__("pending")}}</a>
                @elseif($order->status ==  \App\Models\Tenant\Order::CANCELLED)
                    <a href="#"  class="btn btn-light-danger btn-sm">{{__("cancelled")}}</a>
                @elseif($order->status ==  \App\Models\Tenant\Order::READY)
                    <a href="#"  class="btn btn-light-info btn-sm">{{__("ready")}}</a>
                @elseif($order->status ==  \App\Models\Tenant\Order::COMPLETED)
                    <a href="#"  class="btn btn-light-success btn-sm">{{__("completed")}}</a>
            @endif

            <!--end::Button-->
            </div>
            <!--begin::Order summary-->
            <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">
                <!--begin::Order details-->
                <div class="card card-flush py-4 flex-row-fluid">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2>{{__('order-details')}} (#{{$order->id}})</h2>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                <!--begin::Table body-->
                                <tbody class="fw-bold text-gray-600">
                                <!--begin::Branch-->
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                                         <span class="svg-icon svg-icon-2 me-2">
                                                             <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                                                 <path opacity="0.3" d="M19 3.40002C18.4 3.40002 18 3.80002 18 4.40002V8.40002H14V4.40002C14 3.80002 13.6 3.40002 13 3.40002C12.4 3.40002 12 3.80002 12 4.40002V8.40002H8V4.40002C8 3.80002 7.6 3.40002 7 3.40002C6.4 3.40002 6 3.80002 6 4.40002V8.40002H2V4.40002C2 3.80002 1.6 3.40002 1 3.40002C0.4 3.40002 0 3.80002 0 4.40002V19.4C0 20 0.4 20.4 1 20.4H19C19.6 20.4 20 20 20 19.4V4.40002C20 3.80002 19.6 3.40002 19 3.40002ZM18 10.4V13.4H14V10.4H18ZM12 10.4V13.4H8V10.4H12ZM12 15.4V18.4H8V15.4H12ZM6 10.4V13.4H2V10.4H6ZM2 15.4H6V18.4H2V15.4ZM14 18.4V15.4H18V18.4H14Z" fill="currentColor" />
                                                                 <path d="M19 0.400024H1C0.4 0.400024 0 0.800024 0 1.40002V4.40002C0 5.00002 0.4 5.40002 1 5.40002H19C19.6 5.40002 20 5.00002 20 4.40002V1.40002C20 0.800024 19.6 0.400024 19 0.400024Z" fill="currentColor" />
                                                             </svg>
                                                         </span>
                                            <!--end::Svg Icon-->{{__('branch')}}</div>
                                    </td>
                                    <td class="fw-bolder text-end">{{$order?->branch?->name}}</td>
                                </tr>
                                <!--end::Branch-->
                                <!--begin::Date-->
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <!--begin::Svg Icon | path: icons/duotune/files/fil002.svg-->
                                            <span class="svg-icon svg-icon-2 me-2">
                                                         <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21" viewBox="0 0 20 21" fill="none">
                                                             <path opacity="0.3" d="M19 3.40002C18.4 3.40002 18 3.80002 18 4.40002V8.40002H14V4.40002C14 3.80002 13.6 3.40002 13 3.40002C12.4 3.40002 12 3.80002 12 4.40002V8.40002H8V4.40002C8 3.80002 7.6 3.40002 7 3.40002C6.4 3.40002 6 3.80002 6 4.40002V8.40002H2V4.40002C2 3.80002 1.6 3.40002 1 3.40002C0.4 3.40002 0 3.80002 0 4.40002V19.4C0 20 0.4 20.4 1 20.4H19C19.6 20.4 20 20 20 19.4V4.40002C20 3.80002 19.6 3.40002 19 3.40002ZM18 10.4V13.4H14V10.4H18ZM12 10.4V13.4H8V10.4H12ZM12 15.4V18.4H8V15.4H12ZM6 10.4V13.4H2V10.4H6ZM2 15.4H6V18.4H2V15.4ZM14 18.4V15.4H18V18.4H14Z" fill="currentColor" />
                                                             <path d="M19 0.400024H1C0.4 0.400024 0 0.800024 0 1.40002V4.40002C0 5.00002 0.4 5.40002 1 5.40002H19C19.6 5.40002 20 5.00002 20 4.40002V1.40002C20 0.800024 19.6 0.400024 19 0.400024Z" fill="currentColor" />
                                                         </svg>
                                                     </span>
                                            <!--end::Svg Icon-->{{__('date-added')}}</div>
                                    </td>
                                    <td class="fw-bolder text-end">{{$order->created_at}}</td>
                                </tr>
                                <!--end::Date-->
                                <!--begin::Payment method-->
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <!--begin::Svg Icon | path: icons/duotune/finance/fin008.svg-->
                                            <span class="svg-icon svg-icon-2 me-2">
                                                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                             <path opacity="0.3" d="M3.20001 5.91897L16.9 3.01895C17.4 2.91895 18 3.219 18.1 3.819L19.2 9.01895L3.20001 5.91897Z" fill="currentColor" />
                                                             <path opacity="0.3" d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21C21.6 10.9189 22 11.3189 22 11.9189V15.9189C22 16.5189 21.6 16.9189 21 16.9189H16C14.3 16.9189 13 15.6189 13 13.9189ZM16 12.4189C15.2 12.4189 14.5 13.1189 14.5 13.9189C14.5 14.7189 15.2 15.4189 16 15.4189C16.8 15.4189 17.5 14.7189 17.5 13.9189C17.5 13.1189 16.8 12.4189 16 12.4189Z" fill="currentColor" />
                                                             <path d="M13 13.9189C13 12.2189 14.3 10.9189 16 10.9189H21V7.91895C21 6.81895 20.1 5.91895 19 5.91895H3C2.4 5.91895 2 6.31895 2 6.91895V20.9189C2 21.5189 2.4 21.9189 3 21.9189H19C20.1 21.9189 21 21.0189 21 19.9189V16.9189H16C14.3 16.9189 13 15.6189 13 13.9189Z" fill="currentColor" />
                                                         </svg>
                                                     </span>
                                            <!--end::Svg Icon-->{{__('payment-method')}}</div>
                                    </td>
                                    <td class="fw-bolder text-end">
                                        {{__(''.$order->payment_method?->name)}}

                                    @if($order->payment_method->name == \App\Models\Tenant\PaymentMethod::ONLINE)
                                        @if($order?->tap_payment_method == 'APPLE_PAY')
                                        <svg xmlns="http://www.w3.org/2000/svg" width="2.43em" height="1em" viewBox="0 0 512 211"><path d="M93.552 27.103c-6 7.1-15.602 12.702-25.203 11.901c-1.2-9.6 3.5-19.802 9.001-26.103C83.35 5.601 93.852.4 102.353 0c1 10.001-2.9 19.802-8.8 27.103m8.701 13.802c-13.902-.8-25.803 7.9-32.404 7.9c-6.7 0-16.802-7.5-27.803-7.3c-14.301.2-27.603 8.3-34.904 21.202c-15.002 25.803-3.9 64.008 10.601 85.01c7.101 10.401 15.602 21.802 26.803 21.402c10.602-.4 14.802-6.9 27.604-6.9c12.901 0 16.602 6.9 27.803 6.7c11.601-.2 18.902-10.4 26.003-20.802c8.1-11.801 11.401-23.303 11.601-23.903c-.2-.2-22.402-8.7-22.602-34.304c-.2-21.402 17.502-31.603 18.302-32.203c-10.002-14.802-25.603-16.402-31.004-16.802m80.31-29.004V167.82h24.202v-53.306h33.504c30.603 0 52.106-21.002 52.106-51.406c0-30.403-21.103-51.206-51.306-51.206zm24.202 20.403h27.903c21.003 0 33.004 11.201 33.004 30.903c0 19.702-12.001 31.004-33.104 31.004h-27.803zM336.58 169.019c15.202 0 29.303-7.7 35.704-19.902h.5v18.702h22.403V90.21c0-22.502-18.002-37.004-45.706-37.004c-25.703 0-44.705 14.702-45.405 34.904h21.803c1.8-9.601 10.7-15.902 22.902-15.902c14.802 0 23.103 6.901 23.103 19.603v8.6l-30.204 1.8c-28.103 1.7-43.304 13.202-43.304 33.205c0 20.202 15.701 33.603 38.204 33.603m6.5-18.502c-12.9 0-21.102-6.2-21.102-15.702c0-9.8 7.901-15.501 23.003-16.401l26.903-1.7v8.8c0 14.602-12.401 25.003-28.803 25.003m82.01 59.707c23.603 0 34.704-9 44.405-36.304L512 54.706h-24.603l-28.503 92.11h-.5l-28.503-92.11h-25.303l41.004 113.513l-2.2 6.901c-3.7 11.701-9.701 16.202-20.402 16.202c-1.9 0-5.6-.2-7.101-.4v18.702c1.4.4 7.4.6 9.201.6"/></svg>
                                        @else
                                        <svg width="24px" height="24px" viewBox="0 0 24 24" role="img" xmlns="http://www.w3.org/2000/svg"><title>Visa icon</title><path d="M17.445 8.623c-.387-.146-.99-.301-1.74-.301-1.92 0-3.275.968-3.285 2.355-.012 1.02.964 1.594 1.701 1.936.757.35 1.01.57 1.008.885-.005.477-.605.693-1.162.693-.766 0-1.186-.107-1.831-.375l-.239-.111-.271 1.598c.466.195 1.306.362 2.175.375 2.041 0 3.375-.961 3.391-2.439.016-.813-.51-1.43-1.621-1.938-.674-.33-1.094-.551-1.094-.886 0-.296.359-.612 1.109-.612.645-.01 1.096.129 1.455.273l.18.081.271-1.544-.047.01zm4.983-.17h-1.5c-.467 0-.816.127-1.021.591l-2.885 6.534h2.041l.408-1.07 2.49.002c.061.25.24 1.068.24 1.068H24l-1.572-7.125zM9.66 8.393h1.943l-1.215 7.129H8.444L9.66 8.391v.002zm-4.939 3.929l.202.99 1.901-4.859h2.059l-3.061 7.115H3.768l-1.68-6.026c-.035-.103-.078-.173-.18-.237C1.34 9.008.705 8.766 0 8.598l.025-.15h3.131c.424.016.766.15.883.604l.682 3.273v-.003zm15.308.727l.775-1.994c-.01.02.16-.412.258-.68l.133.615.449 2.057h-1.615v.002z"/></svg>

                                        @endif
                                    @endif
                                        @if($order->payment_status == \App\Models\Tenant\PaymentMethod::PAID)
                                            <span class="badge badge-success">{{__(''.$order->payment_status)}}</span>
                                        @elseif($order->payment_status == \App\Models\Tenant\PaymentMethod::FAILED)
                                            <span class="badge badge-danger">{{__(''.$order->payment_status)}}</span>
                                        @elseif($order->payment_status ==  \App\Models\Tenant\PaymentMethod::PENDING)
                                            <span class="badge badge-warning">{{__(''.$order->payment_status)}}</span>
                                        @endif
                                    </td>
                                </tr>
                                <!--end::Payment method-->
                                <!--begin::Date-->
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm006.svg-->
                                            <span class="svg-icon svg-icon-2 me-2">
                                                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                             <path d="M20 8H16C15.4 8 15 8.4 15 9V16H10V17C10 17.6 10.4 18 11 18H16C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18H21C21.6 18 22 17.6 22 17V13L20 8Z" fill="currentColor" />
                                                             <path opacity="0.3" d="M20 18C20 19.1 19.1 20 18 20C16.9 20 16 19.1 16 18C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18ZM15 4C15 3.4 14.6 3 14 3H3C2.4 3 2 3.4 2 4V13C2 13.6 2.4 14 3 14H15V4ZM6 16C4.9 16 4 16.9 4 18C4 19.1 4.9 20 6 20C7.1 20 8 19.1 8 18C8 16.9 7.1 16 6 16Z" fill="currentColor" />
                                                         </svg>
                                                     </span>
                                            <!--end::Svg Icon-->{{__('shipping-method')}}</div>
                                    </td>
                                    <td class="fw-bolder text-end">{{__(''.$order->delivery_type?->name)}}</td>
                                </tr>
                                <!--end::Date-->
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Order details-->
                <!--begin::Customer details-->
                <div class="card card-flush py-4 flex-row-fluid">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2>{{__('customer-details')}}</h2>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                <!--begin::Table body-->
                                <tbody class="fw-bold text-gray-600">
                                <!--begin::Customer name-->
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <!--begin::Svg Icon | path: icons/duotune/communication/com006.svg-->
                                            <span class="svg-icon svg-icon-2 me-2">
                                                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                             <path opacity="0.3" d="M22 12C22 17.5 17.5 22 12 22C6.5 22 2 17.5 2 12C2 6.5 6.5 2 12 2C17.5 2 22 6.5 22 12ZM12 7C10.3 7 9 8.3 9 10C9 11.7 10.3 13 12 13C13.7 13 15 11.7 15 10C15 8.3 13.7 7 12 7Z" fill="currentColor" />
                                                             <path d="M12 22C14.6 22 17 21 18.7 19.4C17.9 16.9 15.2 15 12 15C8.8 15 6.09999 16.9 5.29999 19.4C6.99999 21 9.4 22 12 22Z" fill="currentColor" />
                                                         </svg>
                                                     </span>
                                            <!--end::Svg Icon-->{{__('customer')}}</div>
                                    </td>
                                    <td class="fw-bolder text-end">
                                        <div class="d-flex align-items-center justify-content-end">
                                            <!--begin:: Avatar -->
                                            <div class="symbol symbol-circle symbol-25px overflow-hidden me-3">
                                                <div class="symbol-label">
                                                    {{--                                                                 <img src="" alt="photo {{$order->user->fullName}}" class="w-100" />--}}
                                                    <svg
                                                        width="24"
                                                        height="24"
                                                        viewBox="0 0 24 24"
                                                        stroke="#212b36"
                                                        stroke-width="2"
                                                        stroke-linecap="round"
                                                        stroke-linejoin="round"
                                                        fill="none"
                                                    >
                                                        <circle cx="12" cy="8" r="5" />
                                                        <path d="M3,21 h18 C 21,12 3,12 3,21"/>
                                                    </svg>
                                                </div>
                                            </div>
                                            <!--end::Avatar-->
                                            <!--begin::Name-->
                                            @if(Auth::user()->isWorker())
                                                <span class="text-gray-600 text-hover-khardl">{{$order?->manual_order_first_name
                                                    ? $order?->manual_order_first_name . ' ' . $order?->manual_order_last_name
                                                    : $order?->user?->fullName}}
                                                </span>

                                                @if($order?->manual_order_first_name)
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="{{__('Manual order name')}}"></i>
                                                @endif
                                            @else
                                                <a href="{{ route('customers_data.show',['restaurantUser' => $order->user?->id]) }}">
                                                <span class="text-gray-600 text-hover-khardl">{{$order?->manual_order_first_name
                                                    ? $order?->manual_order_first_name . ' ' . $order?->manual_order_last_name
                                                    : $order?->user?->fullName}}
                                                </span>

                                                @if($order?->manual_order_first_name)
                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="{{__('Manual order name')}}"></i>
                                                @endif
                                                </a>
                                            @endif



                                        <!--end::Name-->
                                        </div>
                                    </td>
                                </tr>
                                <!--end::Customer name-->
                                <!--begin::Customer email-->
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
                                            <span class="svg-icon svg-icon-2 me-2">
                                                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                             <path opacity="0.3" d="M21 19H3C2.4 19 2 18.6 2 18V6C2 5.4 2.4 5 3 5H21C21.6 5 22 5.4 22 6V18C22 18.6 21.6 19 21 19Z" fill="currentColor" />
                                                             <path d="M21 5H2.99999C2.69999 5 2.49999 5.10005 2.29999 5.30005L11.2 13.3C11.7 13.7 12.4 13.7 12.8 13.3L21.7 5.30005C21.5 5.10005 21.3 5 21 5Z" fill="currentColor" />
                                                         </svg>
                                                     </span>
                                            <!--end::Svg Icon-->
                                            {{__('email')}}</div>
                                    </td>
                                    <td class="fw-bolder text-end">
                                        <a href="mailto:{{$order->user?->email}}" class="text-gray-600 text-hover-khardl">{{$order->user?->email}}</a>
                                    </td>
                                </tr>
                                <!--end::Payment method-->
                                <!--begin::Date-->
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <!--begin::Svg Icon | path: icons/duotune/electronics/elc003.svg-->
                                            <span class="svg-icon svg-icon-2 me-2">
                                                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                             <path d="M5 20H19V21C19 21.6 18.6 22 18 22H6C5.4 22 5 21.6 5 21V20ZM19 3C19 2.4 18.6 2 18 2H6C5.4 2 5 2.4 5 3V4H19V3Z" fill="currentColor" />
                                                             <path opacity="0.3" d="M19 4H5V20H19V4Z" fill="currentColor" />
                                                         </svg>
                                                     </span>
                                            <!--end::Svg Icon-->{{__('phone')}}</div>
                                    </td>
                                    <td class="fw-bolder text-end">
                                        <a href="tel:{{$order->user?->phone}}" class="text-gray-600 text-hover-khardl">{{$order->user?->phone}}</a>
                                    </td>
                                </tr>
                                <!--end::Date-->
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Customer details-->
                <!--begin::Documents-->
                <div class="card card-flush py-4 flex-row-fluid">
                    <!--begin::Card header-->
                    <div class="card-header">
                        <div class="card-title">
                            <h2>{{__('documents')}}</h2>
                        </div>
                    </div>
                    <!--end::Card header-->
                    <!--begin::Card body-->
                    <div class="card-body pt-0">
                        <div class="table-responsive">
                            <!--begin::Table-->
                            <table class="table align-middle table-row-bordered mb-0 fs-6 gy-5 min-w-300px">
                                <!--begin::Table body-->
                                <tbody class="fw-bold text-gray-600">
                                <!--begin::Invoice-->
                                <tr>
                                    <td class="text-muted">
                                        <div class="d-flex align-items-center">
                                            <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm008.svg-->
                                            <span class="svg-icon svg-icon-2 me-2">
                                                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                             <path opacity="0.3" d="M18 21.6C16.3 21.6 15 20.3 15 18.6V2.50001C15 2.20001 14.6 1.99996 14.3 2.19996L13 3.59999L11.7 2.3C11.3 1.9 10.7 1.9 10.3 2.3L9 3.59999L7.70001 2.3C7.30001 1.9 6.69999 1.9 6.29999 2.3L5 3.59999L3.70001 2.3C3.50001 2.1 3 2.20001 3 3.50001V18.6C3 20.3 4.3 21.6 6 21.6H18Z" fill="currentColor" />
                                                             <path d="M12 12.6H11C10.4 12.6 10 12.2 10 11.6C10 11 10.4 10.6 11 10.6H12C12.6 10.6 13 11 13 11.6C13 12.2 12.6 12.6 12 12.6ZM9 11.6C9 11 8.6 10.6 8 10.6H6C5.4 10.6 5 11 5 11.6C5 12.2 5.4 12.6 6 12.6H8C8.6 12.6 9 12.2 9 11.6ZM9 7.59998C9 6.99998 8.6 6.59998 8 6.59998H6C5.4 6.59998 5 6.99998 5 7.59998C5 8.19998 5.4 8.59998 6 8.59998H8C8.6 8.59998 9 8.19998 9 7.59998ZM13 7.59998C13 6.99998 12.6 6.59998 12 6.59998H11C10.4 6.59998 10 6.99998 10 7.59998C10 8.19998 10.4 8.59998 11 8.59998H12C12.6 8.59998 13 8.19998 13 7.59998ZM13 15.6C13 15 12.6 14.6 12 14.6H10C9.4 14.6 9 15 9 15.6C9 16.2 9.4 16.6 10 16.6H12C12.6 16.6 13 16.2 13 15.6Z" fill="currentColor" />
                                                             <path d="M15 18.6C15 20.3 16.3 21.6 18 21.6C19.7 21.6 21 20.3 21 18.6V12.5C21 12.2 20.6 12 20.3 12.2L19 13.6L17.7 12.3C17.3 11.9 16.7 11.9 16.3 12.3L15 13.6V18.6Z" fill="currentColor" />
                                                         </svg>
                                                     </span>
                                            <!--end::Svg Icon-->{{__('invoice')}}
                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="View the invoice generated by this order."></i></div>
                                    </td>
                                    <td class="fw-bolder text-end">
                                        <a href="{{route('download.pdf',['type'=>'order','id'=>$order->id,'tenant_id'=>tenant('id')])}}" class="text-gray-600 text-hover-khardl "><i class="fas fa-external-link-alt "></i> </a>
                                    </td>
                                </tr>
                                <!--end::Invoice-->
                                <!--begin::Shipping-->
{{--                                <tr>--}}
{{--                                    <td class="text-muted">--}}
{{--                                        <div class="d-flex align-items-center">--}}
{{--                                            <!--begin::Svg Icon | path: icons/duotune/ecommerce/ecm006.svg-->--}}
{{--                                            <span class="svg-icon svg-icon-2 me-2">--}}
{{--                                                         <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">--}}
{{--                                                             <path d="M20 8H16C15.4 8 15 8.4 15 9V16H10V17C10 17.6 10.4 18 11 18H16C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18H21C21.6 18 22 17.6 22 17V13L20 8Z" fill="currentColor" />--}}
{{--                                                             <path opacity="0.3" d="M20 18C20 19.1 19.1 20 18 20C16.9 20 16 19.1 16 18C16 16.9 16.9 16 18 16C19.1 16 20 16.9 20 18ZM15 4C15 3.4 14.6 3 14 3H3C2.4 3 2 3.4 2 4V13C2 13.6 2.4 14 3 14H15V4ZM6 16C4.9 16 4 16.9 4 18C4 19.1 4.9 20 6 20C7.1 20 8 19.1 8 18C8 16.9 7.1 16 6 16Z" fill="currentColor" />--}}
{{--                                                         </svg>--}}
{{--                                                     </span>--}}
{{--                                            <!--end::Svg Icon-->{{__('shipping')}}--}}
{{--                                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="View the shipping manifest generated by this order."></i></div>--}}
{{--                                    </td>--}}
{{--                                    <td class="fw-bolder text-end">--}}
{{--                                        <a href="#" class="text-gray-600 text-hover-khardl">#TODO</a>--}}
{{--                                    </td>--}}
{{--                                </tr>--}}
                                <!--end::Shipping-->
                                <!--begin::Rewards-->

                                <!--end::Rewards-->
                                </tbody>
                                <!--end::Table body-->
                            </table>
                            <!--end::Table-->
                        </div>
                    </div>
                    <!--end::Card body-->
                </div>
                <!--end::Documents-->
            </div>
            <!--end::Order summary-->
            <!--begin::Tab content-->
            <div class="tab-content">
                <!--begin::Tab pane-->
                <div class="tab-pane fade show active" id="kt_ecommerce_sales_order_summary" role="tab-panel">
                    <!--begin::Orders-->
                    <div class="d-flex flex-column gap-7 gap-lg-10">
                        <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10">

                            <!--begin::Shipping address-->
                        @if($order->delivery_type?->name != App\Models\Tenant\DeliveryType::PICKUP)
                            <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
                                <!--begin::Background-->
                                <div class="position-absolute top-0 end-0 opacity-10 pe-none text-end">
                                    <img src="#" class="w-175px" />
                                </div>
                                <!--end::Background-->
                                <!--begin::Card header-->
                                <div class="card-header">
                                    <div class="card-title">
                                        <h2>{{__('shipping-address')}}</h2>
                                    </div>
                                </div>
                                <!--end::Card header-->
                                <!--begin::Card body-->
                                <div class="card-body pt-0">
                                    {{-- Unit 1/23 Hastings Road,
                                 <br />Melbourne 3000,
                                 <br />Victoria,
                                 <br />Australia. --}}
                                    <svg width="24" height="24" xmlns="http://www.w3.org/2000/svg" fill-rule="evenodd" clip-rule="evenodd"><path d="M12 10c-1.104 0-2-.896-2-2s.896-2 2-2 2 .896 2 2-.896 2-2 2m0-5c-1.657 0-3 1.343-3 3s1.343 3 3 3 3-1.343 3-3-1.343-3-3-3m-7 2.602c0-3.517 3.271-6.602 7-6.602s7 3.085 7 6.602c0 3.455-2.563 7.543-7 14.527-4.489-7.073-7-11.072-7-14.527m7-7.602c-4.198 0-8 3.403-8 7.602 0 4.198 3.469 9.21 8 16.398 4.531-7.188 8-12.2 8-16.398 0-4.199-3.801-7.602-8-7.602"/></svg> {{$order->user->address ?: $order->address}}
                                </div>
                                <!--end::Card body-->
                            </div>
                        @endif
                            <!--end::Shipping address-->
                        </div>
                        <div class="row">
                            <div class="card card-flush col-md-12 my-2">
                                <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>{{__('order')}} #{{$order->id}}

                                                @if($order->status == \App\Models\Tenant\Order::ACCEPTED)
                                                    <a href="#"  class="btn btn-light-success btn-sm text-black" >{{__("accepted")}}</a>
                                                @elseif($order->status == \App\Models\Tenant\Order::PENDING)
                                                    <a href="#"  class="btn btn-light-warning btn-sm">{{__("pending")}}</a>
                                                @elseif($order->status == \App\Models\Tenant\Order::RECEIVED_BY_RESTAURANT)
                                                    <a href="#"  class="btn btn-light-warning btn-sm">{{__("received_by_restaurant")}}</a>
                                                @elseif($order->status == \App\Models\Tenant\Order::CANCELLED)
                                                    <a href="#"  class="btn btn-light-danger btn-sm">{{__("cancelled")}}</a>
                                                @elseif($order->status == \App\Models\Tenant\Order::READY)
                                                    <a href="#"  class="btn btn-light-info btn-sm">{{__("ready")}}</a>
                                                @elseif($order->status == \App\Models\Tenant\Order::COMPLETED)
                                                    <a href="#"  class="btn btn-light-secondary btn-sm">{{__("completed")}}</a>
                                                @endif
                                            </h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <div class="table-responsive">
                                            <!--begin::Table-->
                                            <table class="table align-middle table-row-dashed fs-6 gy-5 mb-0">
                                                <!--begin::Table head-->
                                                <thead>
                                                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                                    <th class="min-w-175px">{{__('product')}}</th>
                                                    {{-- <th class="min-w-100px text-end">SKU</th> --}}
                                                    <th class="min-w-100px text-end">{{__('id')}}</th>
                                                    <th class="min-w-70px text-end">{{__('QTY')}}</th>
                                                    <th class="min-w-100px text-end">{{__('unit-price')}}</th>
                                                    <th class="min-w-100px text-end">{{__('options-price')}}</th>
                                                    <th class="min-w-100px text-end">{{__('total')}}</th>
                                                </tr>
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody class="fw-bold text-gray-600">
                                                <!--begin::Products-->
                                                @foreach ($order->items as $order_item)
                                                    <tr>
                                                        <!--begin::Product-->
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                <!--begin::Thumbnail-->
                                                                <a href="#" class="symbol symbol-50px">
                                                                    @if($order_item->item)
                                                                    <span class="symbol-label" style="background-image:url({{$order_item->item?->photo}});"></span>

                                                                    @else
                                                                    <span class="symbol-label text-danger text-center" >{{__('Deleted')}}</span>

                                                                    @endif
                                                                </a>
                                                                <!--end::Thumbnail-->
                                                                <!--begin::Title-->
                                                                <div class="ms-5">
                                                                    <a href="#" class="fw-bolder text-gray-600 text-hover-khardl">{{$order_item->item?->name}}</a>
                                                                    <div class="fs-7 text-muted">{{__('notes')}}: {{$order_item->notes ?? __('NA')}}</div>

                                                                </div>

                                                                <!--end::Title-->
                                                            </div>
                                                            <div class="text-muted">
                                                                @if($order_item->item_id)
                                                                    @if($order_item->checkbox_options)
                                                                        @foreach($order_item->checkbox_options as $value)
                                                                            <?php $option = array_keys($value[$locale]); ?>

                                                                            <ul class="list-group" style="border-radius: 0;">
                                                                                <li class="list-group-item" style="width: 100%; overflow: hidden;">

                                                                                    <span >{{ $option[0] }}</span>:
                                                                                    <i >{{ implode(', ', array_column($value[$locale][$option[0]], 0)) }}</span>
                                                                                </li>
                                                                            </ul>
                                                                        @endforeach

                                                                    @endif
                                                                    @if($order_item->selection_options)
                                                                        @foreach($order_item->selection_options as $value)
                                                                            <?php $option = array_keys($value[$locale]); ?>
                                                                            <ul class="list-group" style="border-radius: 0;">
                                                                                <li class="list-group-item" style="width: 100%; overflow: hidden;">
                                                                                    <span >{{ $option[0] }}</span>:

                                                                                    <i >{{ $value[$locale][$option[0]][0] }}</span>
                                                                                </li>
                                                                            </ul>
                                                                        @endforeach
                                                                    @endif
                                                                    @if($order_item->dropdown_options)
                                                                        @foreach($order_item->dropdown_options as $value)
                                                                            <?php $option = array_keys($value[$locale]); ?>
                                                                            <ul class="list-group" style="border-radius: 0;">
                                                                                <li class="list-group-item" style="width: 100%; overflow: hidden;">
                                                                                    <span >{{ $option[0] }}</span>:
                                                                                    <i >{{$value[$locale][$option[0]]}}</span>

                                                                                </li>
                                                                            </ul>
                                                                        @endforeach
                                                                    @endif

                                                                @endif
                                                            </div>
                                                        </td>
                                                        <!--end::Product-->
                                                        <!--begin::SKU-->
                                                        <td class="text-end">{{$order_item->id}}</td>
                                                        <!--end::SKU-->
                                                        <!--begin::Quantity-->
                                                        <td class="text-end">{{$order_item->quantity}}</td>
                                                        <!--end::Quantity-->
                                                        <!--begin::Price-->
                                                        <td class="text-end">{{$order_item->price}}</td>
                                                        <!--end::Price-->
                                                        <!--begin::Price-->
                                                        <td class="text-end">{{$order_item->options_price}}</td>
                                                        <!--end::Price-->
                                                        <!--begin::Total-->
                                                        <td class="text-end">{{$order_item->total}}  {{__('SAR')}}</td>
                                                        <!--end::Total-->
                                                    </tr>
                                                @endforeach

                                                <!--end::Products-->
                                                <!--begin::Subtotal-->
                                                <tr>
                                                    <td colspan="4" class="text-end">{{__('subtotal')}}</td>
                                                    <td class="text-end">{{$order->subtotal}} {{__('SAR')}} +</td>
                                                </tr>
                                                <!--end::Subtotal-->
                                                <!--begin::Shipping-->
                                                <tr>
                                                    <td colspan="4" class="text-end">{{__('shipping-rate')}}</td>
                                                    <td class="text-end">{{$order->delivery_cost}} {{__('SAR')}} +</td>
                                                </tr>
                                                <!--end::Shipping-->
                                                <!--begin::Shipping-->
                                                <tr>
                                                    <td colspan="4" class="text-end">{{__('discount')}}</td>
                                                    <td class="text-end">
                                                        @if($order->coupon)
                                                            <a href="{{ route('coupons.edit',['coupon' => $order->coupon?->id]) }}" target="_blank">
                                                                ({{ $order->coupon?->code }})
                                                            </a>
                                                        @endif
                                                        {{ $order->discount ?? 0 }} {{__('SAR')}} -
                                                    </td>
                                                </tr>
                                                <!--end::Shipping-->
                                                <!--begin::Shipping-->
                                                <tr>
                                                    <td colspan="4" class="text-end">{{__('Tax')}}</td>
                                                    <td class="text-end">{{ $order->tax_amount }} {{__('SAR')}} +</td>
                                                </tr>
                                                <!--end::Shipping-->
                                                <!--begin::Grand total-->
                                                <tr>
                                                    <td colspan="4" class="fs-3 text-dark text-end">{{__('grand-total')}}</td>
                                                    <td class="text-dark fs-3 fw-boldest text-end">{{$order->total }} {{__('SAR')}}</td>
                                                    <td> <i> {{App\Repositories\Customer\CartRepository::VAT_PERCENTAGE }} % <br> {{__('inclusive-VAT')}}</i></td>
                                                </tr>
                                                <!--end::Grand total-->
                                                </tbody>
                                                <!--end::Table head-->
                                            </table>
                                            <!--end::Table-->
                                        </div>
                                    </div>
                                    <!--end::Card body-->
                                </div>
                            </div>
                            <!--begin::Payment address-->
                            <div class="card card-flush col-md-12 my-2">
                                <!--begin::List Widget 5-->
                                <div class="card card-xl-stretch">
                                    <!--begin::Header-->
                                    <div class="card-header align-items-center border-0 mt-4">
                                        <h3 class="card-title align-items-start flex-column">
                                            <span class="fw-bolder mb-2 text-dark">{{__('preparations')}}</span>
                                        </h3>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="card-body pt-5">
                                        @if($order->status == \App\Models\Tenant\Order::ACCEPTED)
                                            <h3 class="btn btn-light-success btn-sm">{{__('in-preparations')}}</h3>
                                        @else
                                            <h3 class="btn btn-light-danger btn-sm">{{__('not-in-preparations')}}</h3>
                                        @endif

                                        <hr />

                                        <a href="#" onclick="showConfirmation({{$order->id}})" class="btn btn-info menu-link px-3" >{{__('status')}}</a>

                                        <hr />


                                        <div class="timeline-label">
                                        @foreach($orderStatusLogs as $log)
                                            <!--begin::Item-->
                                                <div class="timeline-item">
                                                    <!--begin::Badge-->
                                                    <div class="timeline-badge">
                                                        <i class="fa fa-genderless {{$log->class_name}} fs-1"></i>
                                                    </div>
                                                    <!--end::Badge-->
                                                    <!--begin::Content-->
                                                    <div class="d-block">
                                                        <div>
                                                            <p class="fw-bolder text-gray-800 ps-3">{{__($log->status)}}</p>
                                                        </div>
                                                        <div class="fw-mormal timeline-content text-muted ps-3">
                                                            {{$log->created_at}} <span>({{\Carbon\Carbon::parse($log->created_at)->diffForHumans()}})</span>
                                                            {{strtoupper($log->notes)}}

                                                        </div>

                                                    </div>
                                                    <!--end::Content-->
                                                </div>
                                                <!--end::Item-->
                                            @endforeach

                                        </div>
                                        <!--end::Timeline-->
                                    </div>
                                    <!--end: Card Body-->
                                </div>
                                <!--end: List Widget 5-->
                            </div>
                            <!--end::Payment address-->
                            <!--begin::Shipping address-->
                        </div>
                    </div>
                    <!--end::Orders-->
                </div>
                <!--end::Tab pane-->
            </div>
            <!--end::Tab content-->
        </div>
        <!--end::Order details page-->
    </div>
    <!--end::Container-->
</div>
<!--end::Post-->
