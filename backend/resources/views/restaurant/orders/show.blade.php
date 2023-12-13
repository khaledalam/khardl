@extends('layouts.restaurant-sidebar')

@section('title', __('messages.order-summary'))

@section('content')


  <!--begin::Content-->
  <div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">

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
                                 <a class="nav-link text-active-khardl pb-4 active" data-bs-toggle="tab" href="#kt_ecommerce_sales_order_summary">{{__('messages.order-summary')}}</a>
                             </li>
                             <!--end:::Tab item-->
                             
                         </ul>
                         <!--end:::Tabs-->
                         <!--begin::Button-->
                         <a href="index.html" class="btn btn-icon btn-light-khardl btn-sm ms-auto me-lg-n7">
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
                         <a href="#" class="btn btn-active-light-khardl btn-sm">Edit Order</a>
                         @if($order->status == \App\Models\Tenant\Order::ACCEPTED)
                         <a href="#"  class="btn btn-light-primary btn-sm" >{{__("messages.accepted")}}</a>
                         @elseif($order->status ==  \App\Models\Tenant\Order::PENDING)
                         <a href="#"  class="btn btn-light-warning btn-sm">{{__("messages.pending")}}</a>    

                         @elseif($order->status ==  \App\Models\Tenant\Order::CANCELLED)
                         <a href="#"  class="btn btn-light-danger btn-sm">{{__("messages.cancelled")}}</a>    
                         @elseif($order->status ==  \App\Models\Tenant\Order::READY)
                         <a href="#"  class="btn btn-light-info btn-sm">{{__("messages.ready")}}</a>    

                         @elseif($order->status ==  \App\Models\Tenant\Order::COMPLETED)
                         <a href="#"  class="btn btn-light-success btn-sm">{{__("messages.completed")}}</a>    
                         

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
                                     <h2>{{__('messages.order-details')}} (#{{$order->id}})</h2>
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
                                                     <!--end::Svg Icon-->{{__('messages.date-added')}}</div>
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
                                                     <!--end::Svg Icon-->{{__('messages.payment-method')}}</div>
                                                 </td>
                                                 <td class="fw-bolder text-end">{{__('messages.'.$order->payment_method->name)}}
                                                 <img src="assets/media/svg/card-logos/visa.svg" class="w-50px ms-2" /></td>
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
                                                     <!--end::Svg Icon-->{{__('messages.shipping-method')}}</div>
                                                 </td>
                                                 <td class="fw-bolder text-end">{{__('messages.'.$order->delivery_type->name)}}</td>
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
                                     <h2>{{__('messages.customer-details')}}</h2>
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
                                                     <!--end::Svg Icon-->{{__('messages.customer')}}</div>
                                                 </td>
                                                 <td class="fw-bolder text-end">
                                                     <div class="d-flex align-items-center justify-content-end">
                                                         <!--begin:: Avatar -->
                                                         <div class="symbol symbol-circle symbol-25px overflow-hidden me-3">
                                                             <a href="demo1/dist/apps/ecommerce/customers/details.html">
                                                                 <div class="symbol-label">
                                                                     <img src="assets/media/avatars/300-23.jpg" alt="Photo" class="w-100" />
                                                                 </div>
                                                             </a>
                                                         </div>
                                                         <!--end::Avatar-->
                                                         <!--begin::Name-->
                                                         <a href="demo1/dist/apps/ecommerce/customers/details.html" class="text-gray-600 text-hover-khardl">{{$order->user->fullName}}</a>
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
                                                     <!--end::Svg Icon-->{{__('messages.email')}}</div>
                                                 </td>
                                                 <td class="fw-bolder text-end">
                                                     <a href="demo1/dist/apps/user-management/users/view.html" class="text-gray-600 text-hover-khardl">{{$order->user->email}}</a>
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
                                                     <!--end::Svg Icon-->{{__('messages.phone')}}</div>
                                                 </td>
                                                 <td class="fw-bolder text-end">{{$order->user->phone}}</td>
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
                                     <h2>{{__('messages.documents')}}</h2>
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
                                                     <!--end::Svg Icon-->{{__('messages.invoice')}}
                                                     <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="View the invoice generated by this order."></i></div>
                                                 </td>
                                                 <td class="fw-bolder text-end">
                                                     <a href="{{route('admin.download.pdf',['type'=>'order','id'=>$order->id,'tenant_id'=>tenant('id')])}}" class="text-gray-600 text-hover-khardl "><i class="fas fa-external-link-alt "></i> </a>
                                                 </td>
                                             </tr>
                                             <!--end::Invoice-->
                                             <!--begin::Shipping-->
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
                                                     <!--end::Svg Icon-->{{__('messages.shipping')}}
                                                     <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="" data-bs-original-title="View the shipping manifest generated by this order."></i></div>
                                                 </td>
                                                 <td class="fw-bolder text-end">
                                                     <a href="#" class="text-gray-600 text-hover-khardl">#TODO</a>
                                                 </td>
                                             </tr>
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
                                     <!--begin::Payment address-->
                                     <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
                                         <!--begin::Background-->
                                         <div class="position-absolute top-0 end-0 opacity-10 pe-none text-end">
                                             <img src="assets/media/icons/duotune/ecommerce/ecm001.svg" class="w-175px" />
                                         </div>
                                         <!--end::Background-->
                                         <!--begin::Card header-->
                                         <div class="card-header">
                                             <div class="card-title">
                                                 <h2>{{__("messages.payment-address")}}</h2>
                                             </div>
                                         </div>
                                         <!--end::Card header-->
                                         <!--begin::Card body-->
                                         <div class="card-body pt-0">
                                        {{-- Unit 1/23 Hastings Road,
                                         <br />Melbourne 3000,
                                         <br />Victoria,
                                         <br />Australia. --}}
                                         TODO
                                        </div>
                                         <!--end::Card body-->
                                     </div>
                                     <!--end::Payment address-->
                                     <!--begin::Shipping address-->
                                     <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
                                         <!--begin::Background-->
                                         <div class="position-absolute top-0 end-0 opacity-10 pe-none text-end">
                                             <img src="assets/media/icons/duotune/ecommerce/ecm006.svg" class="w-175px" />
                                         </div>
                                         <!--end::Background-->
                                         <!--begin::Card header-->
                                         <div class="card-header">
                                             <div class="card-title">
                                                 <h2>{{__('messages.shipping-address')}}</h2>
                                             </div>
                                         </div>
                                         <!--end::Card header-->
                                         <!--begin::Card body-->
                                         <div class="card-body pt-0">
                                            {{-- Unit 1/23 Hastings Road,
                                         <br />Melbourne 3000,
                                         <br />Victoria,
                                         <br />Australia. --}}
                                         TODO
                                        </div>
                                         <!--end::Card body-->
                                     </div>
                                     <!--end::Shipping address-->
                                 </div>
                                 <div class="d-flex flex-column flex-xl-row gap-7 gap-lg-10 w-100">
                                     <!--begin::Payment address-->
                                     <div class="card card-flush py-4 flex-row-fluid overflow-hidden w-100">
                                         <!--begin::List Widget 5-->
                                         <div class="card card-xl-stretch">
                                             <!--begin::Header-->
                                             <div class="card-header align-items-center border-0 mt-4">
                                                 <h3 class="card-title align-items-start flex-column">
                                                     <span class="fw-bolder mb-2 text-dark">{{__('messages.preparations')}}</span>
                                                 </h3>
                                             </div>
                                             <!--end::Header-->
                                             <!--begin::Body-->
                                             <div class="card-body pt-5">
                                                TODO
                                                 <!--begin::Timeline-->
                                                 <div class="timeline-label">
                                                     
                                                     <!--begin::Item-->
                                                     <div class="timeline-item">
                                                         <!--begin::Badge-->
                                                         <div class="timeline-badge">
                                                             <i class="fa fa-genderless text-info fs-1"></i>
                                                         </div>
                                                         <!--end::Badge-->
                                                         <!--begin::Content-->
                                                         <div class="d-block">
                                                             <div>
                                                                 <p class="fw-bolder text-gray-800 ps-3">Payment status
                                                                 </p>
                                                             </div>
                                                             
                                                             <div class="fw-mormal timeline-content text-muted ps-3">
                                                                 <span class="badge badge-light-danger">Paid</span>
                                                             </div>
                                                             <div class="fw-mormal timeline-content text-muted ps-3">
                                                                 <span class="badge badge-light-warning my-5">Payment when recieving</span>
                                                             </div>
                                                         </div>
                                                         <!--end::Content-->
                                                     </div>
                                                     <!--end::Item-->
                                                     <!--begin::Item-->
                                                     <div class="timeline-item">
                                                         <!--begin::Badge-->
                                                         <div class="timeline-badge">
                                                             <i class="fa fa-genderless text-success fs-1"></i>
                                                         </div>
                                                         <!--end::Badge-->
                                                         <!--begin::Content-->
                                                         <div class="d-block">
                                                             <div>
                                                                 <p class="fw-bolder text-gray-800 ps-3">Order ready for delivery
                                                                 </p>
                                                             </div>
                                                             
                                                             <div class="fw-mormal timeline-content text-muted ps-3">
                                                                 <button class="btn btn-sm btn-success">Ready for delivery</button>
                                                             </div>
                                                         </div>
                                                         <!--end::Content-->
                                                     </div>
                                                     <!--end::Item-->
                                                     <!--begin::Item-->
                                                     <div class="timeline-item">
                                                         <!--begin::Badge-->
                                                         <div class="timeline-badge">
                                                             <i class="fa fa-genderless text-danger fs-1"></i>
                                                         </div>
                                                         <!--end::Badge-->
                                                         <!--begin::Desc-->
                                                         <div class="d-block">
                                                             <div>
                                                                 <p class="fw-bolder text-gray-800 ps-3">On the way to the client</p>
                                                             </div>
                                                             
                                                             <div class="fw-mormal timeline-content text-muted ps-3">Lorem ipsum dolor sit amet consectetur adipisicing elit.</div>
                                                         </div>
                                                         <!--end::Desc-->
                                                     </div>
                                                     <!--end::Item-->
                                                     <!--begin::Item-->
                                                     <div class="timeline-item">
                                                         <!--begin::Badge-->
                                                         <div class="timeline-badge">
                                                             <i class="fa fa-genderless text-khardl fs-1"></i>
                                                         </div>
                                                         <!--end::Badge-->
                                                         <!--begin::Desc-->
                                                         <div class="d-block">
                                                             <div>
                                                                 <p class="fw-bolder text-gray-800 ps-3">Delivered</p>
                                                             </div>
                                                             
                                                             <div class="fw-mormal timeline-content text-muted ps-3">Lorem ipsum dolor sit amet consectetur adipisicing elit.</div>
                                                         </div>
                                                         <!--end::Desc-->
                                                     </div>
                                                     <!--end::Item-->
                                                 </div>
                                                 <!--end::Timeline-->
                                             </div>
                                             <!--end: Card Body-->
                                         </div>
                                         <!--end: List Widget 5-->
                                     </div>
                                     <!--end::Payment address-->
                                     <!--begin::Shipping address-->
                                     <div class="card card-flush py-4 flex-row-fluid overflow-hidden w-100">
                                         <div class="card card-flush py-4 flex-row-fluid overflow-hidden">
                                             <!--begin::Card header-->
                                             <div class="card-header">
                                                 <div class="card-title">
                                                     <h2>{{__('messages.order')}} #{{$order->id}}</h2>
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
                                                                 <th class="min-w-175px">{{__('messages.product')}}</th>
                                                                 {{-- <th class="min-w-100px text-end">SKU</th> --}}
                                                                 <th class="min-w-100px text-end">{{__('messages.id')}}</th>
                                                                 <th class="min-w-70px text-end">{{__('messages.QTY')}}</th>
                                                                 <th class="min-w-100px text-end">{{__('messages.unit_price')}}</th>
                                                                 <th class="min-w-100px text-end">{{__('messages.total')}}</th>
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
                                                                                <a href="demo1/dist/apps/ecommerce/catalog/edit-product.html" class="symbol symbol-50px">
                                                                                    <span class="symbol-label" style="background-image:url({{$order_item->item->photo}});"></span>
                                                                                </a>
                                                                                <!--end::Thumbnail-->
                                                                                <!--begin::Title-->
                                                                                <div class="ms-5">
                                                                                    <a href="demo1/dist/apps/ecommerce/catalog/edit-product.html" class="fw-bolder text-gray-600 text-hover-khardl">{{$order_item->item->description}}</a>
                                                                                    <div class="fs-7 text-muted">Delivery Date: TODO</div>
                                                                                </div>
                                                                                <!--end::Title-->
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
                                                                        <!--begin::Total-->
                                                                        <td class="text-end">{{$order_item->total}}</td>
                                                                        <!--end::Total-->
                                                                    </tr>
                                                                @endforeach
                                                             
                                                             <!--end::Products-->
                                                             <!--begin::Subtotal-->
                                                             <tr>
                                                                 <td colspan="4" class="text-end">{{__('messages.subtotal')}}</td>
                                                                 <td class="text-end">{{$order->subtotal}}</td>
                                                             </tr>
                                                             <!--end::Subtotal-->
                                                             <!--begin::VAT-->
                                                             <tr>
                                                                 <td colspan="4" class="text-end">{{__('messages.vat')}} ({{$order->vat}}%)</td>
                                                                 <td class="text-end">{{$order->total - ($order->subtotal  + $order->delivery_type->cost)}}</td>
                                                             </tr>
                                                             <!--end::VAT-->
                                                             <!--begin::Shipping-->
                                                             <tr>
                                                                 <td colspan="4" class="text-end">{{__('messages.shipping-rate')}}</td>
                                                                 <td class="text-end">{{$order->delivery_type->cost}}</td>
                                                             </tr>
                                                             <!--end::Shipping-->
                                                             <!--begin::Shipping-->
                                                             <tr>
                                                                 <td colspan="4" class="text-end">{{__('messages.discount')}}</td>
                                                                 <td class="text-end">TODO</td>
                                                             </tr>
                                                             <!--end::Shipping-->
                                                             <!--begin::Grand total-->
                                                             <tr>
                                                                 <td colspan="4" class="fs-3 text-dark text-end">{{__('messages.grand-total')}}</td>
                                                                 <td class="text-dark fs-3 fw-boldest text-end">{{$order->total}}</td>
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
     
 </div>
 <!--end::Content-->
@endsection
