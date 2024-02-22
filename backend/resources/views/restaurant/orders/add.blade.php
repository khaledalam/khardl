@extends('layouts.restaurant-sidebar')

@section('title', __('orders-add'))
@section('css')
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<style>
    i.required:after {
        position: absolute !important;
        font-size: 16px;
    }

</style>
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
                        <form action="{{ route('restaurant.order.store') }}" method="POST" class="form d-flex flex-column flex-lg-row">
                            @csrf
                            <!--begin::Aside column-->
                            <div class="w-100 flex-lg-row-auto w-lg-300px mb-7 me-7 me-lg-10">
                                <!--begin::Order details-->
                                <div class="card card-flush py-4">
                                    <!--begin::Card header-->
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h2>{{ __('Order Details') }}</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0">
                                        <div class="d-flex flex-column gap-10">
                                            <!--begin::Input group-->
                                            <div class="fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">{{ __('Phone Number') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Editor-->
                                                <input id="phone" type="number" name="phone" placeholder="{{ __('Phone') }}" class="form-control mb-2" value="{{ old('phone') }}" required />
                                                <!--end::Editor-->
                                            </div>
                                            <div class="fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">{{ __('First name') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Editor-->
                                                <input id="first_name" type="text" name="first_name" placeholder="{{ __('First name') }}" class="form-control mb-2" value="{{ old('first_name') }}" required />
                                                <!--end::Editor-->
                                            </div>
                                            <div class="fv-row">
                                                <!--begin::Label-->
                                                <label class="form-label">{{ __('Last name') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Editor-->
                                                <input id="last_name" type="text" name="last_name" placeholder="{{ __('Last name') }}" class="form-control mb-2" value="{{ old('last_name') }}" />
                                                <!--end::Editor-->
                                            </div>
                                            <div class="fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">{{ __('Delivery Type') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Select2-->
                                                <select class="form-select mb-2" data-hide-search="true" data-placeholder="Select Type" name="delivery_type_id" required>
                                                    @foreach ($deliveryTypes as $type)
                                                    <option value="{{ $type->id }}"
                                                        @if (old('delivery_type_id') == $type->id)
                                                            {{ 'selected' }}
                                                        @endif
                                                        >{{ __(''.$type->name) }}</option>
                                                    @endforeach
                                                </select>
                                                <!--end::Select2-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="fv-row">
                                                <!--begin::Label-->
                                                <label class="required form-label">{{ __('Shipping address') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Editor-->
                                                <input id="address" type="text" name="shipping_address" placeholder="{{ __('Address') }}" class="form-control mb-2" value="{{ old('shipping_address') }}" required />
                                                <!--end::Editor-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Input group-->
                                            <div class="fv-row">
                                                <!--begin::Label-->
                                                <label class="form-label">{{ __('Order Notes') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Editor-->
                                                <textarea name="order_notes" placeholder="{{ __('Notes') }}" class="form-control mb-2" >{{ old('order_notes') }}</textarea>
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
                                            <h2>{{ __('Select Products') }}</h2>
                                        </div>
                                    </div>
                                    <!--end::Card header-->
                                    <!--begin::Card body-->
                                    <div class="card-body pt-0 products">
                                        <div class="d-flex flex-column gap-5">
                                            <!--begin::Input group-->
                                            <div>
                                                <!--begin::Label-->
                                                <label class="form-label">{{ __('Add products to this order') }}</label>
                                                <!--end::Label-->
                                                <!--begin::Selected products-->
                                                <div class="row row-cols-1 row-cols-xl-3 row-cols-md-2 border border-dashed rounded pt-3 pb-1 px-2 mb-5 mh-300px overflow-scroll" id="kt_ecommerce_edit_order_selected_products">
                                                    <!--begin::Empty message-->
                                                    <span class="w-100 text-muted">{{ __('Select one or more products from the list below by click the product.') }}</span>
                                                    <!--end::Empty message-->
                                                </div>
                                                <!--begin::Selected products-->
                                                <!--begin::Total price-->
                                                <div class="fw-bolder fs-4">{{ __('Subtotal') }}: {{ __('SAR') }}
                                                    <span id="kt_ecommerce_edit_order_total_price">0.00</span>
                                                </div>
                                                <!--end::Total price-->
                                            </div>
                                            <!--end::Input group-->
                                            <!--begin::Separator-->
                                            <label class="required form-label">{{ __('Select branch first') }}</label>
                                            <select id="branchSelect" name="branch_id" required class="form-select" style="width: 300px;">
                                                <option>{{ __('Select branch') }}</option>
                                                @foreach ($branches as $branch)
                                                <option value="{{ $branch->id }}"
                                                    @if (old('branch_id')==$branch->id)
                                                        {{ 'selected' }}
                                                    @endif>{{ $branch->name }}</option>
                                                @endforeach
                                            </select>
                                            <div class="separator"></div>
                                            <!--end::Separator-->
                                            <!--begin::Search products-->
                                            <label class="required form-label">{{ __('Select products') }}</label>
                                            <div class="d-flex align-items-center position-relative mb-n7">
                                                <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                                <span class="svg-icon svg-icon-1 position-absolute ms-4">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                                        <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                                {{-- <input type="text" data-kt-ecommerce-edit-order-filter="search"
                                                    class="form-control form-control-solid w-100 w-lg-50 ps-14"                                                    placeholder="Search Products" /> --}}

                                                <select id="productSelect" class="form-select" multiple style="width: 300px;">
                                                    <option disabled>{{ __('Search for a product...') }}</option>
                                                </select>
                                            </div>
                                            <!--end::Search products-->
                                            <!--begin::Table-->
                                            <table class="table align-middle table-row-dashed fs-6 gy-5 products" id="kt_ecommerce_edit_order_product_table">
                                                <!--begin::Table head-->
                                                <thead>
                                                    <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                                        <th class="min-w-200px">{{ __('Product') }}</th>
                                                        <th class="min-w-100px pe-5">{{ __('Quantity') }}</th>
                                                        <th class="min-w-100px pe-5">{{ __('Options') }}</th>
                                                    </tr>
                                                </thead>
                                                <!--end::Table head-->
                                                <!--begin::Table body-->
                                                <tbody class="fw-bold text-gray-600" id="product_table">
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
                                        <span class="indicator-label">{{ __('Order') }}</span>
                                        <span class="indicator-progress">{{ __('Please wait...') }}
                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    </button>
                                    <!--end::Button-->
                                </div>
                            </div>
                            <!--end::Main column-->
                            <div id="modal_here">

                            </div>
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
<script type="text/javascript" src="https://unpkg.com/default-passive-events"></script>

<script>
    $(document).ready(function() {
        var totalCost = 0.00;
        var productTotals = {};
        var productQuantity = {};
        var OptionsPrice = {};
        var oldProductSelectOptions = {};
        let cuurent_product = null;
        var productSelect = null
        function getOldProductData() {
            var products = {!! json_encode(old('products')) !!};
            var branch_id = "";
            if(products) {
                Object.keys(products).forEach(key => {
                    $.ajax({
                        url: `/get-product-by-id/${key}`,
                        type: 'GET',
                        success: function(data) {
                            var product = data.data;
                            branch_id = product.branch.id;
                            var tableRow = TableRow(product);
                            $('#product_table').append(tableRow);
                            var modalRow = ModalRow(product);
                            $('#modal_here').append(modalRow);
                            totalCost += parseFloat(product.price);
                            productTotals[product.id] = parseFloat(product.price);
                            productQuantity[product.id] = 1;
                            OptionsPrice[product.id] = 0;
                            updateTotalCost();
                        },
                        error: function(xhr, status, error) {
                            console.error( error);
                        }
                    });
                });
                var current_branch = $('#branchSelect').val();
                productSelect = initializeProductSelect(current_branch);
            }else{
                productSelect = initializeProductSelect();
            }
        }
        getOldProductData();
        function initializeProducts(branch_id){
            return $('#productSelect').select2({
                placeholder: "{{ __('Search for a product...') }}"
                , ajax: {
                    url: '/search-products?branch_id=' + branch_id
                    , dataType: 'json'
                    , delay: 250
                    , processResults: function(data) {
                        return {
                            results: $.map(data.data, function(product) {
                                return {
                                    text: product.name
                                    , id: product.id
                                    , data: product
                                };
                            })
                        };
                    }
                    , error: function(xhr, textStatus, errorThrown) {
                        console.error('Error fetching product details:', errorThrown);
                    }
                    , cache: true
                }
                });
        }

        function initializeProductSelect(branch_id = "") {
            if (branch_id == "") {
                return $('#productSelect').select2();
            } else {
                return $('#productSelect').select2({
                    placeholder: "{{ __('Search for a product...') }}",
                    ajax: {
                        url: '/search-products?branch_id=' + branch_id,
                        dataType: 'json',
                        delay: 250,
                        processResults: function(data) {
                            return {
                                results: $.map(data.data, function(product) {
                                    return {
                                        text: product.name,
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
                }).on('wheel', function(e) {
                    // Prevent default behavior of the 'wheel' event
                    e.preventDefault();
                }, { passive: true }); // Mark the event listener as passive
            }
        }


        function TableRow(selectedProduct) {
            return `
           <tr>
            <td>
                <div class="d-flex align-items-center" data-kt-ecommerce-edit-order-filter="product" data-kt-ecommerce-edit-order-id="product_${selectedProduct.id}">
                    <a href="./demo1/dist/apps/ecommerce/catalog/edit-product.html" class="symbol symbol-50px">
                        <span class="symbol-label" style="background-image:url(${selectedProduct.photo});"></span>
                    </a>
                    <div class="ms-5">
                        <a href="./demo1/dist/apps/ecommerce/catalog/edit-product.html" class="text-gray-800 text-hover-khardl fs-5 fw-bolder">${selectedProduct.name}</a>
                        <div>Price: SAR <span data-kt-ecommerce-edit-order-filter="price">${selectedProduct.price}</span></div>
                    </div>
                </div>
            </td>
            <td>
                <div class="d-flex align-items-center" data-kt-ecommerce-edit-order-filter="product" data-kt-ecommerce-edit-order-id="product_${selectedProduct.id}">
                    <div class="ms-5">
                        <input type="number" class="form-control product_quantity" min="1" name="products[${selectedProduct.id}][]" value="1" />
                    </div>
                </div>
            </td>
            <td>
                <i class="bi bi-eye btn-sm btn btn-success"
                data-bs-toggle="modal"
                id="options_${selectedProduct.id}"
                data-bs-target="#kt_modal_select_options_${selectedProduct.id}"></i>
                <i class="bi bi-trash btn-sm btn btn-danger remove-product-btn"
                data-product="${selectedProduct.id}"></i>
            </td>
           </tr>
        `;
        }

        function getLangName($name) {
            if ("{{ app()->getLocale() }}" == 'ar') return $name[1];
            return $name[0];
        }


        function ModalRow(selectedProduct) {
            let haveRequiredFiled = false;
            let optionsHTML = '';
            if (!selectedProduct.checkbox_input_titles && !selectedProduct.selection_input_titles && !selectedProduct.dropdown_input_titles) {
                var elementToRemove = document.getElementById(`options_${selectedProduct.id}`);
                elementToRemove.remove();
                return '';
            }
            if (selectedProduct.checkbox_input_titles) {
                selectedProduct.checkbox_input_titles.forEach((option, index) => {
                    let innerOptions = selectedProduct.checkbox_input_names[index];
                    let isRequired = selectedProduct.checkbox_required[index] == "true";
                    if (isRequired) haveRequiredFiled = true;
                    optionsHTML += `<div class="mb-4" id="checkbox_${selectedProduct.id}">
                                <h6 class="${isRequired ? 'required' : ''}">${getLangName(option)}</h6>`;
                    innerOptions.forEach((option, innerIndex) => {
                        let price = selectedProduct.checkbox_input_prices[index][innerIndex];
                        optionsHTML += `<div class="form-check mb-2">`;
                        optionsHTML += `
                            <label class="form-check-label">${getLangName(option)}</label>
                            <input class="form-check-input" id="option_price" type="checkbox" value="${innerIndex}" data-price="${price}" data-product-id="${selectedProduct.id}" name="product_options[${selectedProduct.id}][checkbox_input][${index}][]" >
                            <span class="product_option_price">{{ __('SAR') }} ${price}</span>
                            `;
                        optionsHTML += `</div>`;
                    });
                    optionsHTML += `
                    </div>`;
                });
            }
            if (selectedProduct.selection_input_titles) {
                selectedProduct.selection_input_titles.forEach((option, index) => {
                    let innerOptions = selectedProduct.selection_input_names[index];
                    let isRequired = selectedProduct.selection_required[index] == "true";
                    if (isRequired) haveRequiredFiled = true;
                    optionsHTML += `<div class="mb-4">
                                <h6 class="${isRequired ? 'required' : ''}">${getLangName(option)}</h6>`;
                    innerOptions.forEach((option, innerIndex) => {
                        let price = selectedProduct.selection_input_prices[index][innerIndex];
                        optionsHTML += `<div class="form-check mb-2">`;
                        optionsHTML += `
                            <label class="form-check-label">${getLangName(option)}</label>
                            <input class="form-check-input" type="radio" value="${innerIndex}" data-index="${index}" data-inner-index="${innerIndex}" data-price="${price}" data-product-id="${selectedProduct.id}"  name="product_options[${selectedProduct.id}][selection_input][${index}]">
                            <span class="product_option_price">{{ __('SAR') }} ${price}</span>
                            `;
                        optionsHTML += `</div>`;
                    });
                    optionsHTML += `
                    </div>`;
                });
            }
            if (selectedProduct.dropdown_input_titles) {
                selectedProduct.dropdown_input_titles.forEach((option, index) => {
                    let innerOptions = selectedProduct.dropdown_input_names[index];
                    let isRequired = selectedProduct.dropdown_required[index] == "true";
                    if (isRequired) haveRequiredFiled = true;
                    console.log(selectedProduct.dropdown_required[index],isRequired,innerOptions);
                    optionsHTML += `<div class="mb-4">
                                <h6 class="${isRequired ? 'required' : ''}">${getLangName(option)}</h6>`;
                    optionsHTML += `
                    <select class="form-select" name="product_options[${selectedProduct.id}][dropdown_input][${index}]">
                        <option value="">{{ __('Select option') }}</option>`;
                    innerOptions.forEach((option, innerIndex) => {
                        optionsHTML += `<option value="${innerIndex}">${getLangName(option)}</option>`;
                    });
                    optionsHTML += `</select>`;
                    optionsHTML += `</div>`;
                });
            }
            if (haveRequiredFiled) {
                console.log('test');
                var addRequired = document.getElementById(`options_${selectedProduct.id}`);
                addRequired.classList.add('required');
            }
            return `
        <div class="modal fade" id="kt_modal_select_options_${selectedProduct.id}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered mw-650px">
                <div class="modal-content rounded">
                    <div class="modal-header pb-0 border-0 justify-content-end">
                        <div class="btn btn-sm btn-icon btn-active-color-khardl" data-bs-dismiss="modal">
                            <span class="svg-icon svg-icon-1">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                    <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                                </svg>
                            </span>
                        </div>
                    </div>
                    <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                        <span>{{ __('Select options for' ) }} :
                            <h6 class="d-inline">${selectedProduct.name}</h6>
                        </span>
                        ${optionsHTML}
                    </div>
                </div>
            </div>
        </div>
    `;
        }
        productSelect.on('select2:select', function(e) {
            // Get the selected product data
            console.log(e);
            var selectedProduct = e.params.data.data;

            // Append the selected product to the table
            var tableRow = TableRow(selectedProduct);
            $('#product_table').on('input', `input[name="products[${selectedProduct.id}][]"]`, function() {
                // Update the total cost when the quantity changes
                var oldTotal = productTotals[selectedProduct.id] || 0;
                // Update the total cost by subtracting the old total and adding the new total
                var quantity = $(this).val();
/*                 if(quantity > 2){
                    var optionPrice = (OptionsPrice[selectedProduct.id] / (quantity - 1));
                }else {
                } */
                var optionPrice = OptionsPrice[selectedProduct.id];
                console.log(optionPrice);
                var productTotal = (parseFloat(selectedProduct.price) + optionPrice)* quantity;
                console.log(selectedProduct.id, totalCost);
                totalCost = totalCost - oldTotal + productTotal;
                console.log(oldTotal, quantity, productTotal, totalCost);

                // Update the old total for this product
                productTotals[selectedProduct.id] = productTotal;
                productQuantity[selectedProduct.id] = quantity;
                console.log(productTotals);
                updateTotalCost();
            });
            // Append the table row to your table (replace 'your-table-id' with the actual ID of your table)
            $('#product_table').append(tableRow);
            $('#modal_here').append(ModalRow(selectedProduct));
            $('#modal_here').on('change', 'input[type="checkbox"][name^="product_options"]', function() {
                var price = $(this).data('price');
                var product = $(this).data('product-id');
                var isChecked = $(this).is(':checked');
                console.log(isChecked,product,price,productQuantity[product]);
                if (isChecked) {
                    if(price&&price > 0){
                        var subtotal = parseFloat(price * productQuantity[product]);
                        totalCost += subtotal;
                        OptionsPrice[product] += subtotal;
                        productTotals[selectedProduct.id] +=subtotal;
                    }
                } else {
                    if(price&&price > 0){
                        var subtotal = parseFloat(price * productQuantity[product]);
                        totalCost -= subtotal;
                        OptionsPrice[product] -= subtotal;
                        productTotals[selectedProduct.id] -=subtotal;
                    }
                }
                updateTotalCost();
            });
            $('#modal_here').on('change', 'input[type="radio"][name^="product_options"]', function() {
                var price = $(this).data('price');
                var product = $(this).data('product-id');
                var index = $(this).data('index');
                var Innerindex = $(this).data('inner-index');
                console.log(price);
                let subtotal = parseFloat(price * productQuantity[product]);
                console.log(subtotal);
                console.log($(this).val);
                if (!oldProductSelectOptions[product]) {
                    oldProductSelectOptions[product] = [];
                }

                if (typeof oldProductSelectOptions[product][index] === 'undefined' ||oldProductSelectOptions[product][index] === null) {
                 oldProductSelectOptions[product][index] = [];
                } else {
                    console.log('Inneer : '+Innerindex);
                    subtotal -= oldProductSelectOptions[product][index];
                }
                console.log(subtotal);
                if (Array.isArray(oldProductSelectOptions[product])) {

                    totalCost += subtotal;
                    OptionsPrice[product] += subtotal;
                    productTotals[selectedProduct.id] +=subtotal;
                    oldProductSelectOptions[product][index] = parseFloat(price * productQuantity[product]);
                    updateTotalCost();
                } else {
                    console.error('oldProductSelectOptions[product] is not an array');
                }
            });

            // Update the total cost
            totalCost += parseFloat(selectedProduct.price);
            productTotals[selectedProduct.id] = parseFloat(selectedProduct.price);
            console.log(productTotals);
            productQuantity[selectedProduct.id] = 1;
            OptionsPrice[selectedProduct.id] = 0;
            updateTotalCost();
            productSelect.val(null).trigger('change');
        });
        $('#branchSelect').change(function() {
            var branchId = $(this).val();
            // Update branch_id variable
            productSelect.select2('destroy');
            productSelect = initializeProductSelect(branchId);

            // Clear and refresh productSelect
            productSelect.val(null).trigger('change');
            $('#product_table').empty();
            totalCost = 0;
            updateTotalCost();

        });
        $('#product_table').on('click', '.remove-product-btn', function() {
            var productId = $(this).data('product');
            var productTotal = productTotals[productId];
            console.log(productTotal);
            totalCost -= parseFloat(productTotal);
            delete productTotals[productId];
            $(this).closest('tr').remove();
            updateTotalCost();
        });

        function updateTotalCost() {
            $('#kt_ecommerce_edit_order_total_price').text(totalCost.toFixed(2));
        }
    });

</script>
@endsection
