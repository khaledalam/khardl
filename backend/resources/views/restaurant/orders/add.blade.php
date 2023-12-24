@extends('layouts.restaurant-sidebar')

@section('title', __('messages.orders-add'))
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection
@section('content')
<!--begin::Main-->
<!--begin::Root-->
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="page d-flex flex-row flex-column-fluid">

        <!--begin::Wrapper-->
        <div class="d-flex flex-column flex-row-fluid" id="kt_wrapper">
            <!--begin::Content-->
            <div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">

                <!--begin::Post-->
                <div class="post d-flex flex-column-fluid" id="kt_post">
                    <!--begin::Container-->
                    <div id="kt_content_container" class="container-xxl">
                        <!--begin::Form-->
                        <form id="kt_ecommerce_edit_order_form" class="form d-flex flex-column flex-lg-row"
                            data-kt-redirect="./demo1/dist/apps/ecommerce/sales/listing.html">
                            <!--begin::Aside column-->
                            <div class="w-100 flex-lg-row-auto w-lg-300px mb-7 me-7 me-lg-10">
                                <!--begin::Order details-->
                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Order Details</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <div class="d-flex flex-column gap-10">
                                            <!--begin::Input group-->
                                            <div class="fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">Phone Number</label>
                                                <!--end::Label-->
                                                <!--begin::Editor-->
                                                <input id="phone" type="number" name="phone" placeholder="Phone"
                                                    class="form-control mb-2" value="" required />
                                                <!--end::Editor-->
                                            </div>
                                            <div class="fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">First name</label>
                                                <!--end::Label-->
                                                <!--begin::Editor-->
                                                <input id="first_name" type="text" name="first_name"
                                                    placeholder="First name" class="form-control mb-2" value=""
                                                    required />
                                                <!--end::Editor-->
                                            </div>
                                            <div class="fv-row">
                                                <!--begin::Label-->
                                                <label class="form-label">Last name</label>
                                                <!--end::Label-->
                                                <!--begin::Editor-->
                                                <input id="last_name" type="text" name="last_name"
                                                    placeholder="Last name" class="form-control mb-2" value="" />
                                                <!--end::Editor-->
                                            </div>
                                            <div class="fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">Deliverly Type</label>
                                                <!--end::Label-->
                                                <!--begin::Select2-->
                                                <select class="form-select mb-2"
                                                    data-hide-search="true" data-placeholder="Select Type"
                                                    name="delivery_type_id" required>
                                                    @foreach ($deliveryTypes as $type)
                                                    <option value="{{ $type->id }}">{{ $type->name }}</option>
                                                    @endforeach
                                                </select>
                                                <!--end::Select2-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">Shipping address</label>
                                                <!--end::Label-->
                                                <!--begin::Editor-->
                                                <input id="address" type="text" name="shipping_address"
                                                    placeholder="Adddress" class="form-control mb-2" value=""
                                                    required />
                                                <!--end::Editor-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="fv-row">
                                                <!--begin::Label-->
                                                <label class="form-label">Order Notes</label>
                                                <!--end::Label-->
                                                <!--begin::Editor-->
                                                <textarea name="order_notes" placeholder="Notes"
                                                    class="form-control mb-2" value=""></textarea>
                                                <!--end::Editor-->
                                            </div>
                                            <!--end::Input group-->
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                </div>
                                <!--end::Order details-->
                            </div>
                            <!--end::Aside column-->
                            <!--begin::Main column-->
                            <div class="d-flex flex-column flex-lg-row-fluid gap-7 gap-lg-10">
                                <!--begin::Order details-->
                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>Select Products</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <div class="d-flex flex-column gap-10">
                                            <!--begin::Input group-->
                                            <div>
                                                <!--begin::Label-->
                                                <label class="form-label">Add products to this order</label>
                                                <!--end::Label-->
                                                <!--begin::Selected products-->
                                                <div class="row row-cols-1 row-cols-xl-3 row-cols-md-2 border border-dashed rounded pt-3 pb-1 px-2 mb-5 mh-300px overflow-scroll"
                                                    id="kt_ecommerce_edit_order_selected_products">
                                                    <!--begin::Empty message-->
                                                    <span class="w-100 text-muted">Select one or more products from the
                                                        list below by ticking the checkbox.</span>
                                                    <!--end::Empty message-->
                                                </div>
                                                <!--begin::Selected products-->
                                                <!--begin::Total price-->
                                                <div class="fw-bolder fs-4">Total Cost: $
                                                    <span id="kt_ecommerce_edit_order_total_price">0.00</span>
                                                </div>
                                                <!--end::Total price-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Separator-->
                                            <div class="separator"></div>
                                            <!--end::Separator-->
                                            <!--begin::Search products-->
                                            <div class="d-flex align-items-center position-relative mb-n7">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                                <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                        viewBox="0 0 24 24" fill="none">
                                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546"
                                                            height="2" rx="1" transform="rotate(45 17.0365 15.1223)"
                                                            fill="currentColor" />
                                                        <path
                                                            d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                                            fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                                {{-- <input type="text" data-kt-ecommerce-edit-order-filter="search"
                                                    class="form-control form-control-solid w-100 w-lg-50 ps-14"
                                                    placeholder="Search Products" /> --}}
                                                <select id="productSelect" class="form-select" name="products[]"
                                                    multiple style="width: 300px;">
                                                    <option disabled>Search for a product...</option>
                                                </select>
                                            </div>
                                            <!--end::Search products-->
                                            <!--begin::Table-->
                                            <table class="table align-middle table-row-dashed fs-6 gy-5"
                                                id="kt_ecommerce_edit_order_product_table">
                                                <!--begin::Table head-->
                                                <thead>
                                                    <tr
                                                        class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                                        <th class="w-25px pe-2"></th>
                                                        <th class="min-w-200px">Product</th>
                                                        <th class="min-w-100px text-end pe-5">Qty Remaining</th>
                                                    </tr>
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody class="fw-bold text-gray-600" id="product_table">
                                                    <!--begin::Table row-->
                                                    {{-- <tr>
                                                        <!--begin::Checkbox-->
                                                        <td>
                                                            <div
                                                                class="form-check form-check-sm form-check-custom form-check-solid">
                                                                <input class="form-check-input" type="checkbox"
                                                                    value="1" />
                                                            </div>
                                                        </td>
                                                        <!--end::Checkbox-->
                                                        <!--begin::Product=-->
                                                        <td>
                                                            <div class="d-flex align-items-center"
                                                                data-kt-ecommerce-edit-order-filter="product"
                                                                data-kt-ecommerce-edit-order-id="product_1">
                                                                <!--begin::Thumbnail-->
                                                                <a href="./demo1/dist/apps/ecommerce/catalog/edit-product.html"
                                                                    class="symbol symbol-50px">
                                                                    <span class="symbol-label"
                                                                        style="background-image:url(assets/media//stock/ecommerce/1.gif);"></span>
                                                                </a>
                                                                <!--end::Thumbnail-->
                                                                <div class="ms-5">
                                                                    <!--begin::Title-->
                                                                    <a href="./demo1/dist/apps/ecommerce/catalog/edit-product.html"
                                                                        class="text-gray-800 text-hover-khardl fs-5 fw-bolder">Product
                                                                        1</a>
                                                                    <!--end::Title-->
                                                                    <!--begin::Price-->
                                                                    <div class="fw-bold fs-7">Price: $
                                                                        <span
                                                                            data-kt-ecommerce-edit-order-filter="price">292.00</span>
                                                                    </div>
                                                                    <!--end::Price-->
                                                                    <!--begin::SKU-->
                                                                    <div class="text-muted fs-7">SKU: 04792007</div>
                                                                    <!--end::SKU-->
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <!--end::Product=-->
                                                        <!--begin::Qty=-->
                                                        <td class="text-end pe-5" data-order="35">
                                                            <span class="fw-bolder ms-3">35</span>
                                                        </td>
                                                        <!--end::Qty=-->
                                                    </tr> --}}
                                                    <!--end::Table row-->
                                                </tbody>
                                                <!--end::Table body-->
                                            </table>
                                            <!--end::Table-->
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                </div>
                                <!--end::Order details-->
                                <div class="d-flex justify-content-end">
                                    <!--begin::Button-->
                                    <button type="submit" id="kt_ecommerce_edit_order_submit" class="btn btn-khardl">
                                        <span class="indicator-label">Order</span>
                                        <span class="indicator-progress">Please wait...
                                            <span
                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                    <!--end::Button-->
                                </div>
                            </div>
                            <!--end::Main column-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Post-->

            </div>
            <!--end::Content-->
        </div>
        <!--end::Wrapper-->
    </div>
    <!--end::Page-->
</div>
<!--end::Root-->
<!--end::Main-->

@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
        $('#productSelect').select2({
            placeholder: 'Search for a product...',
            ajax: {
                url: '/search-products',
                dataType: 'json',
                delay: 250,
                processResults: function(data) {
                    return {
                        results: $.map(data.data, function(product) {
                            return {
                                text: product.description,
                                id: product.id,
                                data: product
                            };
                        })
                    };
                },
                error: function(xhr, textStatus, errorThrown) {
                    console.error('Error fetching product details:', errorThrown);
                },
                cache: true
            }
        }).on('select2:select', function(e) {
        // Get the selected product data
        console.log(e);
        var selectedProduct = e.params.data.data;

        // Append the selected product to the table
        var tableRow = `
           <tr>
            <td>
                <div class="d-flex align-items-center" data-kt-ecommerce-edit-order-filter="product" data-kt-ecommerce-edit-order-id="product_${selectedProduct.id}">
                    <!--begin::Thumbnail-->
                    <a href="./demo1/dist/apps/ecommerce/catalog/edit-product.html" class="symbol symbol-50px">
                        <span class="symbol-label" style="background-image:url(${selectedProduct.photo});"></span>
                    </a>
                    <!--end::Thumbnail-->
                    <div class="ms-5">
                        <!--begin::Title-->
                        <a href="./demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-khardl fs-5 fw-bolder">${selectedProduct.description}</a>
                        <!--end::Title-->
                        <!--begin::Price-->
                        <div>Price: SAR <span data-kt-ecommerce-edit-order-filter="price">${selectedProduct.price}</span></div>
                        <!--end::Price-->
                        <!--begin::SKU-->

                        <!--end::SKU-->
                    </div>
                </div>
            </td>
           </tr>
        `;

        // Append the table row to your table (replace 'your-table-id' with the actual ID of your table)
        $('#product_table').append(tableRow);
        });
    });
</script>
@endsection
