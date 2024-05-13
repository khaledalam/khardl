@extends('layouts.restaurant-sidebar')

@section('title', DB::table('branches')->where('id', $branchId)->value('name'))
@section('subtitle', $selectedCategory?->name)

@section('content')
<!-- Checkbox -->
<script>
    var checkboxesContainer = document.getElementById('checkboxes');
    let checkboxCount = -1;

    function createCheckbox(item = null, key = null, update = null) {

        if(update){
            checkboxesContainer = document.getElementById(`checkboxes_${update}`);
        }
        checkboxCount++;
        const checkboxDiv = document.createElement('div');
        checkboxDiv.className = 'd-flex flex-column mb-8 fv-row checkbox-content';
        checkboxDiv.innerHTML = `
                <hr />
                <div class="d-flex flex-column fv-row">
                    <!--begin::Label-->
                    <div class="d-flex justify-content-between align-items-center">
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="">{{ __('Checkbox') }} </span>
                        </label>
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <input type="hidden" name="checkbox_required[${checkboxCount}]" value="false"  />
                            <input type="checkbox" name="checkbox_required_input[${checkboxCount}]" ${key !=null ? (item.checkbox_required[key] == "true"  ? 'checked':'') : ''} >&nbsp;{{ __('Required') }}
                        </label>
                    </div>
                    <!--end::Label-->

                    <div id="inputContainer${checkboxCount}">
                        <div class="input-container d-flex justify-content-between align-items-center hover-container my-3">
                            <input type="text" style="box-shadow:0 0 13px 2px rgba(0, 0, 0, 0.2) !important;" required class="form-control form-control-solid mx-3 w-65" name="checkboxInputTitleEn[${checkboxCount}]"  placeholder="{{ __('Title in english') }}"
                            value="${key !=null ? item.checkbox_input_titles[key][0]: ''}">
                            <input type="text" style="box-shadow:0 0 13px 2px rgba(0, 0, 0, 0.2) !important;" required class="form-control form-control-solid mx-3 w-65" name="checkboxInputTitleAr[${checkboxCount}]" placeholder="{{ __('Title in arabic') }}"
                            value="${key !=null ? item.checkbox_input_titles[key][1]: ''}">

                            <input type="number" style="box-shadow:0 0 13px 2px rgba(0, 0, 0, 0.2) !important;" min="1" step="1" required class="form-control form-control-solid mx-3 w-45" name="checkboxInputMaximumChoice[]" placeholder="{{ __('Max') }}"
                            value="${key !=null ? item.checkbox_input_maximum_choices[key]: ''}">
                            <button class="delete-checkbox btn btn-sm btn-white" type="button" data-index="${item ? item.id : update}"><i class="fas fa-trash text-danger"></i></button>
                        </div>
                    </div>
                    <hr>
                    <div id="inputContainer${checkboxCount}">
                        <!-- Existing ShakePass11 elements will be dynamically added here -->
                    </div>
                    <div class="options" id="${checkboxCount}" ></div><br />
                    <a class="btn btn-sm btn-khardl add-option w-100">+ {{ __('Add option') }}</a>
                </div>
            `;

        const deleteCheckboxButton = checkboxDiv.querySelector('.delete-checkbox');
        if(key!=null){
            deleteCheckboxButton.addEventListener('click', () => {
                const dataIndex = event.currentTarget.getAttribute('data-index');
                document.getElementById(`checkboxes_${dataIndex}`).removeChild(checkboxDiv);
            });
        }else{
            deleteCheckboxButton.addEventListener('click', () => {
                const dataIndex = event.currentTarget.getAttribute('data-index');
                checkboxesContainer.removeChild(checkboxDiv);
            });
        }
        const hiddenInput = checkboxDiv.querySelector(`input[name="checkbox_required_input[${checkboxCount}]"]`);

        hiddenInput.addEventListener('change', function() {
            // Get the corresponding hidden input's name before redeclaring hiddenInput
            const hiddenInputName = hiddenInput.name.replace('_input', '');

            // Now redeclare hiddenInput to get the correct hidden input element
            const actualHiddenInput = document.querySelector(`input[name="${hiddenInputName}"]`);

            // Update the value of the hidden input based on the checkbox state
            actualHiddenInput.value = hiddenInput.checked ? 'true' : 'false';
        });
        const addOptionButton = checkboxDiv.querySelector('.add-option');
        addOptionButton.addEventListener('click', () => {
            createCheckBoxOption(checkboxDiv);
        });

        if (key != null) {
            if (item.checkbox_input_prices != null && item.checkbox_input_names != null) {
                item.checkbox_input_names[key].forEach(function(value, index) {
                    createCheckBoxOption(checkboxDiv, false, value, item.checkbox_input_prices[key][index]);
                });
            }
            var checkboxItem = document.getElementById(`checkboxes_${item.id}`);
            checkboxItem.appendChild(checkboxDiv);
        } else {
            checkboxesContainer.appendChild(checkboxDiv);
            createCheckBoxOption(checkboxDiv, true);
        }
    }

    function createCheckBoxOption(checkboxDiv, isDeletable = false, option = null, price = null) {
        const optionsDiv = checkboxDiv.querySelector('.options');
        const optionCount = optionsDiv.id;
        const optionDiv = document.createElement('div');
        optionDiv.className = 'option';
        if (isDeletable) {
            optionDiv.innerHTML = `
                <div class="d-flex justify-content-between mt-4">
                    <input type="text"  required name="checkboxInputNameEn[${optionCount}][]" class="form-control form-control-solid mx-3 w-50" placeholder="{{ __('Option in english') }}"
                    value="${option ? option[0] : ''}">
                    <input type="text"  required name="checkboxInputNameAr[${optionCount}][]" class="form-control form-control-solid mx-3 w-50" placeholder="{{ __('Option in arabic') }}"
                    value="${option ? option[1] : ''}">

                    <input type="number" min="0" step="0.1" required name="checkboxInputPrice[${optionCount}][]" class="form-control form-control-solid mx-3 w-50" placeholder="{{ __('Price') }}"
                    value="${price ? price : ''}">
                    <button class="invisible btn btn-sm btn-white"><i class="fas fa-trash text-danger"></i></button>
                </div>
            `;
        } else {
            optionDiv.innerHTML = `
                <div class="d-flex justify-content-between mt-4">
                    <input type="text"  required name="checkboxInputNameEn[${optionCount}][]" class="form-control form-control-solid mx-3 w-50"  placeholder="{{ __('Option in english') }}"
                    value="${option ? option[0] : ''}">
                    <input type="text"  required name="checkboxInputNameAr[${optionCount}][]" class="form-control form-control-solid mx-3 w-50" placeholder="{{ __('Option in arabic') }}"
                    value="${option ? option[1] : ''}">

                    <input type="number" step="0.1" min="0" required name="checkboxInputPrice[${optionCount}][]" class="form-control form-control-solid mx-3 w-50" placeholder="{{ __('Price') }}"
                    value="${price ? price : ''}">
                    <button class="delete-option btn btn-sm btn-white " type="button"><i class="fas fa-trash text-danger"></i></button>
                </div>
            `;

            const deleteOptionButton = optionDiv.querySelector('.delete-option');
            deleteOptionButton.addEventListener('click', () => {
                optionsDiv.removeChild(optionDiv);
            });
        }



        optionsDiv.appendChild(optionDiv);
    }

</script>

<!-- Selection -->
<script>
    var selectionsContainer = document.getElementById('selections');

    let selectionCount = -1;

    function createSelection(item = null, key = null, update = null) {
        if(update){
            selectionsContainer = document.getElementById(`selections_${update}`);
        }
        selectionCount++;
        const selectionDiv = document.createElement('div');
        selectionDiv.className = 'd-flex flex-column mb-8 fv-row';
        selectionDiv.innerHTML = `
                <hr />
                <div class="d-flex flex-column fv-row">
                    <!--begin::Label-->
                    <div class="d-flex justify-content-between align-items-center">
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="">{{ __('Selection') }}</span>
                        </label>
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">

                            <input type="hidden" name="selection_required[${selectionCount}]" value="false" />
                            <input type="checkbox" name="selection_required_input[${selectionCount}]" disabled checked >&nbsp;{{ __('Required') }}
                        </label>
                    </div>
                    <!--end::Label-->

                    <div id="inputContainer${selectionCount}">
                        <div class="input-container d-flex justify-content-between align-items-center hover-container my-3">
                            <input type="text" style="box-shadow:0 0 13px 2px rgba(0, 0, 0, 0.2) !important;" required class="form-control form-control-solid mx-3 w-100" name="selectionInputTitleEn[${selectionCount}]" placeholder="{{ __('Title in english') }}"
                            value="${key !=null ? item.selection_input_titles[key][0]: ''}">
                            <input type="text" style="box-shadow:0 0 13px 2px rgba(0, 0, 0, 0.2) !important;" required class="form-control form-control-solid mx-3 w-100" name="selectionInputTitleAr[${selectionCount}]"  placeholder="{{ __('Title in arabic') }}"
                            value="${key !=null ? item.selection_input_titles[key][1]: ''}">

                            <button class="delete-selection btn btn-sm btn-white" type="button" data-index="${item ? item.id : update}"><i class="fas fa-trash text-danger"></i></button>
                        </div>
                    </div>
                    <hr>
                    <div id="inputContainer${selectionCount}">
                        <!-- Existing ShakePass11 elements will be dynamically added here -->
                    </div>
                    <div class="options" id="${selectionCount}" ></div><br />
                    <a class="btn btn-sm btn-khardl add-option w-100">+ {{ __('Add option') }}</a>
                </div>
            `;

        const deleteSelectionButton = selectionDiv.querySelector('.delete-selection');

        if(key!=null){
            deleteSelectionButton.addEventListener('click', () => {
                const dataIndex = event.currentTarget.getAttribute('data-index');
                document.getElementById(`selections_${dataIndex}`).removeChild(selectionDiv);
            });
        }else{
            deleteSelectionButton.addEventListener('click', () => {
                selectionsContainer.removeChild(selectionDiv);
            });
        }
        const hiddenInput = selectionDiv.querySelector(`input[name="selection_required_input[${selectionCount}]"]`);

        hiddenInput.addEventListener('change', function() {
            // Get the corresponding hidden input's name before redeclaring hiddenInput
            const hiddenInputName = hiddenInput.name.replace('_input', '');

            // Now redeclare hiddenInput to get the correct hidden input element
            const actualHiddenInput = document.querySelector(`input[name="${hiddenInputName}"]`);

            // Update the value of the hidden input based on the checkbox state
            actualHiddenInput.value = hiddenInput.checked ? 'true' : 'false';
        });
        const addOptionButton = selectionDiv.querySelector('.add-option');
        addOptionButton.addEventListener('click', () => {
            createSelectionOption(selectionDiv, selectionCount); // Pass the selectionCount
        });

        if (key != null) {
            if (item.selection_input_prices != null && item.selection_input_names != null) {
                item.selection_input_names[key].forEach(function(value, index) {
                    createSelectionOption(selectionDiv, selectionCount, false, value, item.selection_input_prices[key][index]);
                });
            }
            var selectionItem = document.getElementById(`selections_${item.id}`);
            selectionItem.appendChild(selectionDiv);
        } else {
            selectionsContainer.appendChild(selectionDiv);
            createSelectionOption(selectionDiv, selectionCount, true);
        }
    }

    function createSelectionOption(selectionDiv, selectionCount, isDeletable = false, option = null, price = null) {
        const optionsDiv = selectionDiv.querySelector('.options');
        const optionCount = optionsDiv.id;
        const optionDiv = document.createElement('div');
        optionDiv.className = 'option';
        if (isDeletable) {
            optionDiv.innerHTML = `
                <div class="d-flex justify-content-between align-items-center mt-5">
                    <input type="text" required  name="selectionInputNameEn[${optionCount}][]" class="form-control form-control-solid mx-3 w-50"  placeholder="{{ __('Option in english') }}"
                    value="${option ? option[0] : ''}">
                    <input type="text" required  name="selectionInputNameAr[${optionCount}][]" class="form-control form-control-solid mx-3 w-50"  placeholder="{{ __('Option in arabic') }}"
                    value="${option ? option[1] : ''}">

                    <input type="number" min="0" step="0.1" required name="selectionInputPrice[${optionCount}][]" class="form-control form-control-solid mx-3 w-50"  placeholder="{{ __('Price') }}"
                    value="${price ? price : ''}">
                    <button class="invisible btn btn-sm btn-white"><i class="fas fa-trash text-danger"></i></button>
                </div>
            `;
        } else {
            optionDiv.innerHTML = `
                <div class="d-flex justify-content-between align-items-center mt-5">
                    <input type="text" required  name="selectionInputNameEn[${optionCount}][]" class="form-control form-control-solid mx-3 w-50"  placeholder="{{ __('Option in english') }}"
                    value="${option ? option[0] : ''}">
                    <input type="text" required  name="selectionInputNameAr[${optionCount}][]" class="form-control form-control-solid mx-3 w-50"  placeholder="{{ __('Option in arabic') }}"
                    value="${option ? option[1] : ''}">

                    <input type="number" min="0" step="0.1" required name="selectionInputPrice[${optionCount}][]" class="form-control form-control-solid mx-3 w-50"  placeholder="{{ __('Price') }}"
                    value="${price ? price : ''}">
                    <button class="delete-option btn btn-sm btn-white" type="button"><i class="fas fa-trash text-danger"></i></button>
                </div>
            `;

            const deleteOptionButton = optionDiv.querySelector('.delete-option');
            deleteOptionButton.addEventListener('click', () => {
                optionsDiv.removeChild(optionDiv);
            });
        }


        optionsDiv.appendChild(optionDiv);
    }

</script>

<!-- Dropdown -->
<script>
    var dropdownsContainer = document.getElementById('dropdowns');

    let dropdownCount = -1;

    function createDropdown(item = null, key = null, update = null) {
        if(update){
            dropdownsContainer = document.getElementById(`dropdowns_${update}`);
        }
        dropdownCount++;
        const dropdownDiv = document.createElement('div');
        dropdownDiv.className = 'd-flex flex-column mb-8 fv-row';
        dropdownDiv.innerHTML = `
                <hr />
                <div class="d-flex flex-column fv-row">
                    <!--begin::Label-->
                    <div class="d-flex justify-content-between align-items-center">
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="">{{ __('Dropdown') }}</span>
                        </label>
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">

                            <input type="hidden" name="dropdown_required[${dropdownCount}]" value="false" />
                            <input type="checkbox" name="dropdown_required_input[${dropdownCount}]" disabled checked >&nbsp;{{ __('Required') }}
                        </label>
                    </div>
                    <!--end::Label-->

                    <div id="inputContainer${dropdownCount}">
                        <div class="input-container d-flex justify-content-between align-items-center hover-container my-3">
                            <input type="text" style="box-shadow:0 0 13px 2px rgba(0, 0, 0, 0.2) !important;" required class="form-control form-control-solid mx-3 w-100" name="dropdownInputTitleEn[${dropdownCount}]" placeholder="{{ __('Title in english') }}"
                            value="${key !=null ? item.dropdown_input_titles[key][0]: ''}">
                            <input type="text" style="box-shadow:0 0 13px 2px rgba(0, 0, 0, 0.2) !important;" required class="form-control form-control-solid mx-3 w-100" name="dropdownInputTitleAr[${dropdownCount}]"  placeholder="{{ __('Title in arabic') }}"
                            value="${key !=null ? item.dropdown_input_titles[key][1]: ''}">

                            <button class="delete-dropdown btn btn-sm btn-white" type="button" data-index="${item ? item.id : update}"><i class="fas fa-trash text-danger"></i></button>
                        </div>
                    </div>
                    <hr>
                    <div id="inputContainer${dropdownCount}">
                        <!-- Existing ShakePass11 elements will be dynamically added here -->
                    </div>
                    <div class="options" id="${dropdownCount}" ></div><br />
                    <a class="btn btn-sm btn-khardl add-option w-100">+ {{ __('Add option') }}</a>
                </div>
            `;

        const deleteDropdownButton = dropdownDiv.querySelector('.delete-dropdown');

        if(key!=null){
            deleteDropdownButton.addEventListener('click', () => {
                const dataIndex = event.currentTarget.getAttribute('data-index');
                document.getElementById(`dropdowns_${dataIndex}`).removeChild(dropdownDiv);
            });
        }else{
            deleteDropdownButton.addEventListener('click', () => {
                dropdownsContainer.removeChild(dropdownDiv);
            });
        }
        const hiddenInput = dropdownDiv.querySelector(`input[name="dropdown_required_input[${dropdownCount}]"]`);

        hiddenInput.addEventListener('change', function() {
            // Get the corresponding hidden input's name before redeclaring hiddenInput
            const hiddenInputName = hiddenInput.name.replace('_input', '');

            // Now redeclare hiddenInput to get the correct hidden input element
            const actualHiddenInput = document.querySelector(`input[name="${hiddenInputName}"]`);

            // Update the value of the hidden input based on the checkbox state
            actualHiddenInput.value = hiddenInput.checked ? 'true' : 'false';
        });
        const addOptionButton = dropdownDiv.querySelector('.add-option');
        addOptionButton.addEventListener('click', () => {
            createDropdownOption(dropdownDiv);
        });

        if (key != null) {
            if (item.dropdown_input_prices != null && item.dropdown_input_names != null) {
                item.dropdown_input_names[key].forEach(function(value, index) {
                    createDropdownOption(dropdownDiv, false, value, item.dropdown_input_prices[key][index]);
                });
            }
            var dropDownItem = document.getElementById(`dropdowns_${item.id}`);
            dropDownItem.appendChild(dropdownDiv);
        } else {
            dropdownsContainer.appendChild(dropdownDiv);
            createDropdownOption(dropdownDiv, true);
        }
    }

    function createDropdownOption(dropdownDiv, isDeletable = false, option = null, price = null) {
        const optionsDiv = dropdownDiv.querySelector('.options');
        const optionCount = optionsDiv.id;
        const optionDiv = document.createElement('div');
        optionDiv.className = 'option';
        if (isDeletable) {
            optionDiv.innerHTML = `
                    <div class="d-flex justify-content-between align-items-center mt-5">
                        <input type="text"  required name="dropdownInputNameEn[${optionCount}][]" class="form-control form-control-solid mx-3 w-50" placeholder="{{ __('Option in english') }}"
                        value="${option ? option[0] : ''}">
                        <input type="text"  required name="dropdownInputNameAr[${optionCount}][]" class="form-control form-control-solid mx-3 w-50"  placeholder="{{ __('Option in arabic') }}"
                        value="${option ? option[1] : ''}">

                        <input type="number" min="0" step="0.1" required name="dropdownInputPrice[${optionCount}][]" class="form-control form-control-solid mx-3 w-50"  placeholder="{{ __('Price') }}">
                        <button class="invisible btn btn-sm btn-white"><i class="fas fa-trash text-danger"></i></button>
                    </div>
            `;
        } else {
            optionDiv.innerHTML = `
                    <div class="d-flex justify-content-between align-items-center mt-5">
                        <input type="text"  required name="dropdownInputNameEn[${optionCount}][]" class="form-control form-control-solid mx-3 w-50"  placeholder="{{ __('Option in english') }}"
                        value="${option ? option[0] : ''}">
                        <input type="text"  required name="dropdownInputNameAr[${optionCount}][]" class="form-control form-control-solid mx-3 w-50"   placeholder="{{ __('Option in arabic') }}"
                        value="${option ? option[1] : ''}">

                        <input type="number" min="0" step="0.1" required name="dropdownInputPrice[${optionCount}][]" class="form-control form-control-solid mx-3 w-50"  placeholder="{{ __('Price') }}"
                        value="${price ? price : ''}">
                        <button class="delete-option btn btn-sm btn-white" type="button"><i class="fas fa-trash text-danger"></i></button>
                    </div>
            `;
            const deleteOptionButton = optionDiv.querySelector('.delete-option');
            deleteOptionButton.addEventListener('click', () => {
                optionsDiv.removeChild(optionDiv);
            });

        }

        optionsDiv.appendChild(optionDiv);
    }
</script>
@if($user->isRestaurantOwner())
<div class="content d-flex flex-column flex-column pt-0" id="kt_content">

    <!--begin::Post-->
    <div class="post d-flex flex-column" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Inbox App - Messages -->
            <div class="flex-lg-row-fluid my-2">
                <!--begin::Card-->
                <div class="card">
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <div class="d-flex flex-wrap gap-1">
                            <h3 class="text-primary">{{ __('Branches') }}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            @foreach ($branches as $branchLoop)
                            <div class="col-md-3">
                                <a href="{{ route('restaurant.get-category',['id'=> \App\Models\Tenant\Category::where('branch_id', $branchLoop->id)?->first()?->id ?? -1, 'branchId' => $branchLoop->id]) }}">
                                    <button type="button" class="btn btn-sm @if($branchLoop->id == $branchId) btn-khardl text-black @else btn-primary @endif">
                                        @if($branchLoop->id == $branchId)<i class="fa fa-arrow-down text-white mx-1"></i>@endif {{ $branchLoop->name }}
                                    </button>
                                </a>
                            </div>
                            @endforeach
                        </div>
                        </ul>
                    </div>
                </div>
                <!--end::Card-->
            </div>
        </div>
        <!--end::Inbox App - Messages -->
    </div>
    <!--end::Container-->
</div>
@endif
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Inbox App - Messages -->
            <div class="d-flex flex-column flex-lg-row">
                <!--begin::Sidebar-->
                <div class="flex-column flex-lg-row-fluid w-100 w-lg-275px mb-10 mb-lg-0">
                    <!--begin::Sticky aside-->
                    <div class="card card-flush mb-0 overflow-scroll py-2" data-kt-sticky-offset="{default: false, xl: '0px'}" data-kt-sticky-width="{lg: '275px'}" data-kt-sticky-left="auto" data-kt-sticky-animation="false" data-kt-sticky-zindex="95">
                        <!--begin::Aside content-->
                        <div class="card-body">
                            <!--begin::Button-->
                            {{-- <a href="{{route('restaurant.menu', ['branchId' => $branchId])}}">--}}
                            {{-- <p class="btn btn-primary text-uppercase w-100 mb-10">--}}
                            {{-- {{ __('all-categories') }}--}}
                            {{-- </p>--}}
                            {{-- </a>--}}
                            <!--end::Button-->
                            <!--begin::Menu-->
                            <div id="categoryList" class="menu menu-column menu-rounded menu-state-bg menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary mb-10">
                                <!--begin::Menu item-->
                                @foreach ($categories as $category)

                                    <div class="row mb-2">
                                        <!--begin::Inbox-->
                                        <div class="col-md-12">

                                                <span class="menu-link d-flex align-items-stretch justify-content-start gap-4 mb-4 p-3" @if ($category?->id === $selectedCategory?->id) style="background: #eeeeee;" @endif">
                                                    <a href="{{ route('restaurant.get-category', ['id' => $category->id, 'branchId' => $branchId]) }}">
                                                        <img src="{{ $category?->photo ?? global_asset('img/category-icon.png') }}" width="50" height="50" class="mx-2" style="border-radius: 50%;" />
                                                    </a>
                                                    <div>
                                                        <a href="{{ route('restaurant.get-category', ['id' => $category->id, 'branchId' => $branchId]) }}">
                                                            <span class="menu-title fw-bolder small">{{ $category->name }}</span>
                                                        </a>
                                                        <div class="">
                                                            @if($user->isRestaurantOwner())
                                                                        <span class="badge badge-light-info mt-1">
                                                                    <div class="edit-category">
                                                                        <span style="cursor: pointer;" onclick="EditCategory('{{ $category->getTranslation('name','ar') }}','{{ $category->getTranslation('name','en') }}','{{ $category->id }}', '{{$category->sort}}')">
                                                                            <i class="fa fas fa-edit border" ></i>
                                                                        </span>
                                                                    </div>
                                                                </span>
                                                            @endif
                                                            <span class="badge badge-light-info mt-1">{{ $category->sort }}</span>
                                                            <span class="badge badge-light-success mt-1">{{ DB::table('items')->where('category_id', $category->id)->where('branch_id', $branchId)->count() }} {{__('Products')}}</span>
                                                        </div>
                                                    </div>

                                                </span>


                                        </div>

                                        <!--end::Inbox-->
                                    </div>
{{--                                --}}
{{--                                <div class="menu-item mb-3">--}}
{{--                                    <!--begin::Inbox-->--}}
{{--                                    <a href="{{ route('restaurant.get-category', ['id' => $category?->id, 'branchId' => $branchId]) }}">--}}
{{--                                        <span class="menu-link @if ($category?->id === $selectedCategory?->id) active @endif">--}}
{{--                                            <img src="{{ $category->photo ?? global_asset('img/category-icon.png') }}" width="50" height="50" class="mx-2" style="border-radius: 50%;" />--}}
{{--                                            <span class="menu-title fw-bolder">{{ $category->name }}</span>--}}
{{--                                        </span>--}}
{{--                                        <div class="col-md-2">--}}
{{--                                            <span class="badge badge-light-info mt-1">{{ $category->sort }} {{__('sort')}}</span>--}}
{{--                                            <span class="badge badge-light-success mt-1">{{ DB::table('items')->where('category_id', $category->id)->where('branch_id', $branchId)->count() }} {{__('Products')}}</span>--}}
{{--                                        </div>--}}
{{--                                    </a>--}}
{{--                                    <!--end::Inbox-->--}}
{{--                                </div>--}}
                                @endforeach

                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item">
                                    <!--begin::Add label-->
                                    <span class="menu-link">
                                        <span class="menu-icon" id="svgIcon">
                                            <span class="svg-icon svg-icon-2 me-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
                                                    <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <button class="menu-title fw-bold btn btn-sm" id="addCategoryButton">{{ __('add-new-category') }}</button>

                                        <script>
                                            document.getElementById('svgIcon').addEventListener('click', function() {
                                                document.getElementById('addCategoryButton').click();
                                            });
                                        </script>
                                    </span>
                                    <!--end::Add label-->
                                    <form action="{{ route('restaurant.add-category', ['branchId' => $branchId]) }}" class="mb-2" method="POST" id="category-submit" enctype="multipart/form-data">
                                        @csrf
                                        <div id="categoryForm" class="mt-2" style="display: none !important;">
                                            <ul class="nav nav-tabs" id="languageTabs">
                                                <li class="nav-item">
                                                    <a class="nav-link active required" id="en-tab" data-bs-toggle="tab" href="#en">{{__('english')}}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link required" id="ar-tab" data-bs-toggle="tab" href="#ar">{{__('arabic')}}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="logo-tab" data-bs-toggle="tab" href="#logo">{{__('logo')}}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="sort-tab" data-bs-toggle="tab" href="#sort">{{__('sort')}}</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content mt-3">
                                                <div class="tab-pane fade show active" id="en">
                                                    <input type="text" class="form-control" placeholder="{{ __('Enter text in English') }}" name="name_en" id="categoryName">
                                                </div>
                                                <div class="tab-pane fade" id="ar">
                                                    <input type="text" class="form-control" placeholder="{{ __('Enter text in Arabic') }}" name="name_ar">
                                                </div>
                                                <div class="tab-pane fade" id="logo">
                                                    <label>{{__('category-logo')}}</label>
                                                    <input type="file" class="form-control form-control-solid" placeholder="Enter Target Title" name="photo" accept="image/*" />
                                                </div>
                                                <div class="tab-pane fade" id="sort">
                                                    <label>{{__('sort')}}</label>
                                                    <input type="number" name="sort" min="1" max="{{count($categories)+1}}" value="{{count($categories)+1}}" class="form-control form-control-solid" placeholder="{{__('The sorting order of category')}}" />
                                                </div>
                                            </div>
                                            <div class="justify-content-center" >
                                                <button type="submit" class="btn btn-sm btn-khardl mx-1 mt-2" id="saveCategoryBtn">{{ __('Create') }}</button>
                                                <button type="button" onclick="hideCategoryEditForm('categoryForm')" class="btn btn-sm btn-info mx-1 mt-2">{{ __('Close') }}</button>
                                            </div>
                                        </div>
                                    </form>

                                    <form method="POST" id="category-edit" enctype="multipart/form-data" class="mb-2">
                                        @csrf

                                        <div id="category-edit-form" class="mt-2" style="display: none !important;">
                                            <ul class="nav nav-tabs" id="edit-cateogry">
                                                <li class="nav-item">
                                                    <a class="nav-link active required" id="en-tab" data-bs-toggle="tab" href="#edit-en">{{__('english')}}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link required" id="ar-tab" data-bs-toggle="tab" href="#edit-ar">{{__('arabic')}}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="logo-tab" data-bs-toggle="tab" href="#edit-logo">{{__('logo')}}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="sort-tab" data-bs-toggle="tab" href="#edit-sort">{{__('sort')}}</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content mt-3">
                                                <div class="tab-pane fade show active" id="edit-en">
                                                    <input type="text" class="form-control" placeholder="{{ __('Enter text in English') }}" name="name_en" id="category_name_en">
                                                </div>
                                                <div class="tab-pane fade" id="edit-ar">
                                                    <input type="text" class="form-control" placeholder="{{ __('Enter text in Arabic') }}" name="name_ar" id="category_name_ar">
                                                </div>
                                                <div class="tab-pane fade" id="edit-logo">
                                                    <label>{{__('category-logo')}}</label>
                                                    <input type="file" class="form-control form-control-solid" accept="image/*" placeholder="Enter Target Title" name="photo" />
                                                </div>
                                                <div class="tab-pane fade" id="edit-sort">
                                                    <label>{{__('sort')}}</label>
                                                    <input type="number" min="1" max="{{count($categories)}}" class="form-control form-control-solid" name="sort" placeholder="{{__('The sorting order of category')}}" id="category_sort"/>
                                                </div>
                                            </div>
                                            <div class="d-none justify-content-center" id="update-category-btn">
                                                <button type="submit" class="btn btn-sm btn-khardl mx-1 mt-2" id="saveCategoryBtn">{{ __('Update') }}</button>
                                                <button type="button" onclick="hideCategoryEditForm('category-edit-form')" class="btn btn-sm btn-info mx-1 mt-2">{{ __('Close') }}</button>
                                            </div>
                                        </div>

                                    </form>

                                </div>
                                <!--end::Menu item-->

                            </div>
                            <!--end::Menu-->
                        </div>
                        <!--end::Aside content-->
                    </div>
                    <!--end::Sticky aside-->
                </div>
                <!--end::Sidebar-->
                <!--begin::Content-->
                <div class="flex-lg-row-fluid ms-lg-7 ms-xl-10">
                    <!--begin::Card-->
                    <div class="card">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <!--begin::Actions-->
                            <div class="d-flex flex-wrap gap-1">
                                <h3 class="text-primary">{{ DB::table('branches')->where('id', $branchId)?->value('name') }} @if($selectedCategory) | {{ $selectedCategory->name }} @endif</h3>
                            </div>
                            <!--end::Actions-->
                            <!--begin::Pagination-->
                            <div class="d-flex align-items-center flex-wrap gap-2">
                                @if($selectedCategory)
                                <a href="#" class="btn btn-sm btn-outline-secondary text-dark" data-bs-toggle="modal" data-bs-target="#kt_modal_new_target">{{ __('create-new-items') }}
                                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                                    <span class="svg-icon svg-icon-2 me-3">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
                                            <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </a>
                                <form class="delete-form" action="{{ route('restaurant.delete-category', ['id' => $selectedCategory->id]) }}" method="POST">
                                    @method('DELETE')
                                    @csrf
                                    <button type="submit" class="delete-button btn btn-icon btn-bg-light btn-active-color-danger btn-sm">
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
                            <!--end::Pagination-->
                        </div>
                        {{-- TODO:Refactor 2 loops and modal for every item--}}
                        @foreach ($items as $item)
                        <form class="form item_form" action="{{ route('restaurant.update-item',['item' => $item->id]) }}"  method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('post')
                            <div class="modal fade" id="kt_modal_new_target_{{ $item->id }}" tabindex="-1" aria-hidden="true">
                                <!--begin::Modal dialog-->
                                <div class="modal-dialog modal-dialog-centered mw-650px">
                                    <!--begin::Modal content-->
                                    <div class="modal-content rounded">
                                        <!--begin::Modal header-->
                                        <div class="modal-header pb-0 border-0 justify-content-end">
                                            <!--begin::Close-->
                                            <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                                                <span class="svg-icon svg-icon-1">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                                                        <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </div>
                                            <!--end::Close-->
                                        </div>
                                        <!--begin::Modal header-->
                                        <!--begin::Modal body-->
                                        <div class="modal-body px-10 px-lg-15 pt-0 pb-15">
                                            <div class="engage-toolbar d-flex position-fixed px-5 fw-bolder zindex-2  flex-row-reverse start-0 {{app()->getLocale() != 'ar'?' transform-90':'transform-270'}} mt-20 gap-2">
                                                <!--begin::Demos drawer toggle-->
                                                <button id="addCheckbox_{{ $item->id }}" type="button" class="engage-demos-toggle btn btn-flex h-35px bg-body btn-color-gray-700 btn-active-color-gray-900 shadow-sm fs-6 px-4 rounded-top-0 btn-khardl" title="Add Checkbox">
                                                    <span id="create_new_checkbox">+ {{ __('Checkbox') }}</span>
                                                </button>
                                                <!--end::Demos drawer toggle-->
                                                <!--begin::Help drawer toggle-->
                                                <button id="addSelection_{{ $item->id }}" type="button" class="engage-demos-toggle btn btn-flex h-35px bg-body btn-color-gray-700 btn-active-color-gray-900 shadow-sm fs-6 px-4 rounded-top-0 btn-khardl" title="Add Selection">
                                                    <span id="create_new_selection">+ {{ __('Selection') }}</span>
                                                </button>
                                                <!--end::Help drawer toggle-->
                                                <!--begin::Purchase link-->
                                                <button id="addDropdown_{{ $item->id }}" type="button" class="engage-demos-toggle btn btn-flex h-35px bg-body btn-color-gray-700 btn-active-color-gray-900 shadow-sm fs-6 px-4 rounded-top-0 btn-khardl" title="Add Dropdown">
                                                    <span id="create_new_Dropdown">+ {{ __('Dropdown') }}</span>
                                                </button>
                                                <!--end::Purchase link-->
                                            </div>


                                            <!--begin:Form-->
                                            @if($selectedCategory)
                                                <!--begin::Heading-->
                                                <div class="mb-13 text-center">
                                                    <!--begin::Title-->
                                                    <h1 class="mb-3">{{__('Update item')}}</h1>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Heading-->
                                                <div class="row">
                                                    <div class="col-md-8">
                                                         <!--begin::Input group-->
                                                        <div class="d-flex flex-column mb-8 fv-row">
                                                            <!--begin::Label-->
                                                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                                <span class="required">{{__('item-photo')}}</span>
                                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="{{ __('Image will be shown to customers') }}"></i>
                                                            </label>
                                                            <input type="file"  data-item="{{ $item->id }}" class="item_image form-control form-control-solid" placeholder="Enter Target Title" name="photo" accept="image/*" />
                                                        </div>
                                                        <!--end::Input group-->

                                                        <!--begin::Input group-->
                                                        <div class="d-flex flex-column mb-8">
                                                            <label class="fs-6 fw-bold mb-2">{{ __('Name') }}</label>

                                                            <ul class="nav nav-tabs">
                                                                <li class="nav-item">
                                                                    <a class="nav-link active required" id="name-en-tab" data-bs-toggle="tab" href="#name-en-{{ $item->id }}">{{ __('English') }}</a>
                                                                </li>
                                                                <li class="nav-item">
                                                                    <a class="nav-link required" id="name-ar-tab" data-bs-toggle="tab" href="#name-ar-{{ $item->id }}">{{ __('Arabic') }}</a>
                                                                </li>
                                                            </ul>
                                                            <div class="tab-content mt-3">
                                                                <div class="tab-pane fade show active" id="name-en-{{ $item->id }}">
                                                                    <input type="text" class="form-control form-control-solid" rows="3" placeholder="{{ __('Enter name in english') }}" name="item_name_en" value="{{ old('item_name_en') ??  $item->getTranslation('name', 'en') }}" />
                                                                </div>
                                                                <div class="tab-pane fade" id="name-ar-{{ $item->id }}">
                                                                    <input type="text" class="form-control form-control-solid" rows="3" placeholder="{{ __('Enter name in arabic') }}" name="item_name_ar" value="{{ old('item_name_ar') ?? $item->getTranslation('name', 'ar') }}" />
                                                                </div>
                                                            </div>
                                                        </div>

                                                        <!--begin::Input group-->
                                                        <div class="d-flex flex-column mb-8 fv-row">
                                                            <!--begin::Label-->
                                                            <div class="d-flex justify-content-between align-items-center">
                                                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                                    <span class="required">{{__('item-availability')}}</span>
                                                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify availability for an item"></i>
                                                                </label>
                                                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                                    <input type="checkbox" name="availability" value="1" {{ old('availability') || $item->availability ? 'checked' : '' }}>
                                                                </label>
                                                            </div>

                                                        </div>
                                                        <!--end::Input group-->
                                                    </div>
                                                    <div class="col-md-4">
                                                        <img alt="product_image" src="{{ $item->photo }}" id="item-image-preview-{{ $item->id }}" class="rounded" style="max-height: 100%;max-width:100%" />
                                                    </div>
                                                </div>
                                                <!--begin::Input group-->
                                                <div class="row g-9 mb-8">
                                                    <!--begin::Col-->
                                                    <div class="col-md-6 fv-row">
                                                        <label class="required fs-6 fw-bold mb-2">{{ __('Price') }}</label>
                                                        <!--begin::Input-->
                                                        <div class="position-relative d-flex align-items-center">
                                                            <!--begin::Datepicker-->
                                                            <input type="number" min="0" step="0.1" value="{{ old('price') ?? $item->price }}" required name="price" class="form-control form-control-solid ps-12" />
                                                            <!--end::Datepicker-->
                                                        </div>
                                                        <!--end::Input-->
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--begin::Col-->
                                                    <div class="col-md-6 fv-row">
                                                        <label class="required fs-6 fw-bold mb-2">{{ __('Calories') }}</label>
                                                        <input type="number" step="0.1" min="1" required name="calories" value="{{ old('calories') ?? $item->calories }}" class="form-control form-control-solid ps-12" />
                                                    </div>
                                                    <!--end::Col-->

                                                </div>
                                                <!--end::Input group-->

                                                <!--begin::Input group-->
                                                <div class="row g-9 mb-8">
                                                    <!--begin::Col-->
                                                    <div class="col-md-6 fv-row">
                                                        <label class="d-flex align-items-between fs-6 fw-bold mb-4">
                                                            <span class="required">{{__('Allow buy with loyalty points?')}}</span>
                                                        </label>
                                                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                            <input type="checkbox" id="allow_buy_with_loyalty_points" name="allow_buy_with_loyalty_points" @if($item?->price_using_loyalty_points) checked @endif value="1">
                                                        </label>
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--begin::Col-->
                                                    <div class="col-md-6 fv-row @if(old('price_using_loyalty_points') ?? $item?->price_using_loyalty_points) d-block @else d-none @endif" id="loyalty_point_price_section">
                                                        <label class="fs-6 fw-bold mb-2">{{ __('Price using loyalty points (how many points)') }}</label>
                                                        <input type="number" step="0.1" min="0" required name="price_using_loyalty_points" value="{{ old('price_using_loyalty_points') ?? $item?->price_using_loyalty_points }}" class="form-control form-control-solid ps-12" />
                                                    </div>
                                                    <!--end::Col-->

                                                </div>
                                                <!--end::Input group-->

                                                <div class="d-flex flex-column mb-8">
                                                    <label class="fs-6 fw-bold mb-2">{{ __("Description") }}</label>

                                                    <ul class="nav nav-tabs">
                                                        <li class="nav-item">
                                                            <a class="nav-link active" id="d-en-tab" data-bs-toggle="tab" href="#d-en-{{ $item->id }}">{{ __('English') }}</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="d-ar-tab" data-bs-toggle="tab" href="#d-ar-{{ $item->id }}">{{ __('Arabic') }}</a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content mt-3">
                                                        <div class="tab-pane fade show active" id="d-en-{{ $item->id }}">
                                                            <textarea type="text" class="form-control form-control-solid" rows="3" placeholder="{{ __('Enter name in english') }}" name="description_en">
                                                            {{ old('description_en') ?? $item->getTranslation('description', 'en') }}
                                                            </textarea>
                                                        </div>
                                                        <div class="tab-pane fade" id="d-ar-{{ $item->id }}">
                                                            <textarea type="text" class="form-control form-control-solid" rows="3" placeholder="{{ __('Enter name in arabic') }}" name="description_ar">
                                                            {{ old('description_ar') ?? $item->getTranslation('description', 'ar') }}
                                                            </textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                                <!--end::Input group-->

                                                <div id="checkboxes_{{ $item->id }}">
                                                    <!-- Checkbox elements will be dynamically added here -->

                                                </div>


                                                <div id="selections_{{ $item->id }}">
                                                    <!-- Checkbox elements will be dynamically added here -->
                                                </div>


                                                <div id="dropdowns_{{ $item->id }}">
                                                    <!-- Checkbox elements will be dynamically added here -->
                                                </div>
                                                <script>
                                                    var item = @json($item);
                                                    var checkboxOptions = @json($item->checkbox_input_titles);
                                                    if (checkboxOptions) {
                                                        checkboxOptions.forEach(function(value, key) {
                                                            createCheckbox(item, key);
                                                        });
                                                    }
                                                    var selectionOptions = @json($item->selection_input_titles);
                                                    if (selectionOptions) {
                                                        selectionOptions.forEach(function(value, key) {
                                                            createSelection(item, key);
                                                        });
                                                    }
                                                    var dropdownOptions = @json($item->dropdown_input_titles);
                                                    if (dropdownOptions) {
                                                        dropdownOptions.forEach(function(value, key) {
                                                            createDropdown(item, key);
                                                        });
                                                    }

                                                    (function(item) { // Create a new scope for each iteration
                                                        document.getElementById(`addSelection_${item.id}`).addEventListener('click', function(){
                                                            createSelection(null, null, item.id);
                                                        });
                                                    })(item);
                                                    (function(item) { // Create a new scope for each iteration
                                                        document.getElementById(`addCheckbox_${item.id}`).addEventListener('click', function(){
                                                            createCheckbox(null, null, item.id);
                                                        });
                                                    })(item);
                                                    (function(item) { // Create a new scope for each iteration
                                                        document.getElementById(`addDropdown_${item.id}`).addEventListener('click', function(){
                                                            createDropdown(null, null, item.id);
                                                        });
                                                    })(item);

                                                </script>

                                                <!--begin::Actions-->
                                                <div class="text-center">
                                                    <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">{{__('clear')}}</button>
                                                    <button type="submit" id="kt_modal_new_target_submit" class="btn btn-khardl">
                                                        <span class="indicator-label">{{__('submit')}}</span>
                                                        <span class="indicator-progress" id="waiting-item">{{ __('Please wait...') }}
                                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                    </button>
                                                </div>
                                                <!--end::Actions-->
                                            @endif
                                            <!--end:Form-->
                                        </div>
                                        <!--end::Modal body-->
                                    </div>
                                    <!--end::Modal content-->
                                </div>
                                <!--end::Modal dialog-->
                            </div>
                        </form>
                        @endforeach
                        <div class="card-body p-1">
                            <!--begin::Table-->
                            <table class="table table-hover table-row-dashed fs-6 gy-5 my-0" id="kt_inbox_listing">
                                <!--begin::Table body-->
                                <tbody>
                                    @foreach ($items as $item)
                                    <tr>
                                        <td>
                                            @if(!$item->availability)<span class="badge badge-danger mx-1">{{__('Not available')}}</span>
                                            @else
                                            <span class="badge badge-success mx-1">{{__('Available')}}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip" title="{{$item->name}}">
                                                <img alt="Pic" src="{{$item->photo}}" />
                                            </div>
                                        </td>

                                        <!--begin::Title-->
                                        <td class="text-center">
                                            <div class="text-dark">
                                                <!--begin::Heading-->
                                                <a href="{{ route('restaurant.view-item',['item' => $item->id]) }}">
                                                    <span class="fw-bolder text-start">{{ $item->name }}</span>
                                                </a>
                                                <!--end::Heading-->
                                            </div>
                                        </td>
                                        <!--begin::Author-->
                                        <td class="text-center">
                                            <span class="text-gray fw-bold fs-17">{{$item->price}}</span>
                                        </td>
                                        <!--end::Author-->

                                        <!--end::Title-->
                                        <!--begin::Date-->
                                        <td class="text-center">
                                            <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">{{ __('Actions') }}
                                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr072.svg-->
                                                <span class="svg-icon svg-icon-5 m-0">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path d="M11.4343 12.7344L7.25 8.55005C6.83579 8.13583 6.16421 8.13584 5.75 8.55005C5.33579 8.96426 5.33579 9.63583 5.75 10.05L11.2929 15.5929C11.6834 15.9835 12.3166 15.9835 12.7071 15.5929L18.25 10.05C18.6642 9.63584 18.6642 8.96426 18.25 8.55005C17.8358 8.13584 17.1642 8.13584 16.75 8.55005L12.5657 12.7344C12.2533 13.0468 11.7467 13.0468 11.4343 12.7344Z" fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon--></a>
                                            <!--begin::Menu-->
                                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-125px py-4" data-kt-menu="true">
                                                <!--begin::Menu item-->
                                                <div class="menu-item px-3">
                                                    <a href="{{ route('restaurant.view-item',['item' => $item->id]) }}" class="menu-link px-3">{{ __('view') }}</a>
                                                </div>
                                                <div class="menu-item px-3">
                                                    <a href="#"  class="menu-link px-3" data-bs-toggle="modal" data-bs-target="#kt_modal_new_target_{{ $item->id }}">
                                                        {{ __('edit') }}
                                                    </a>
                                                </div>
                                                <!--end::Menu item-->
                                                <!--begin::Menu item-->
                                                {{-- TODO:Edit item --}}
                                                {{-- <div class="menu-item px-3">
                                                            <a href="https://google.com" class="menu-link px-3">{{ __('edit') }}</a>
                                            </div> --}}
                                            <!--end::Menu item-->
                                            <!--begin::Menu item-->

                                            <div class="menu-item px-3" style="border-top-style: solid;border-top-width: 1px;border-top-color: #ccc;">
                                                <form class="delete-form" action="{{ route('restaurant.delete-item', ['id' => $item->id]) }}" method="POST">
                                                    @method('DELETE')
                                                    @csrf
                                                    <a href="#" class="menu-link px-3 delete-button">{{ __('delete') }}</a>
                                                </form>
                                            </div>
                                            <!--end::Menu item-->
                                            </div>
                                            <!--end::Menu-->
                                        </td>
                                        <!--end::Date-->
                                    </tr>
                                    @endforeach
                                </tbody>
                            <!--end::Table body-->
                            </table>
                            {{-- TODO: load item when scroll down --}}
                            <!--end::Table-->
                        </div>
                </div>
                <!--end::Card-->
            </div>
            <!--end::Content-->
        </div>
        <!--end::Inbox App - Messages -->
    </div>
    <!--end::Container-->
</div>
<!--end::Post-->
</div>

<!--begin::Modal - New Target-->
<div class="modal fade" id="kt_modal_new_target" tabindex="-1" aria-hidden="true">
    <!--begin::Modal dialog-->
    <div class="modal-dialog modal-dialog-centered mw-650px">
        <!--begin::Modal content-->
        <div class="modal-content rounded">
            <!--begin::Modal header-->
            <div class="modal-header pb-0 border-0 justify-content-end">
                <!--begin::Close-->
                <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                    <!--begin::Svg Icon | path: icons/duotune/arrows/arr061.svg-->
                    <span class="svg-icon svg-icon-1">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <rect opacity="0.5" x="6" y="17.3137" width="16" height="2" rx="1" transform="rotate(-45 6 17.3137)" fill="currentColor" />
                            <rect x="7.41422" y="6" width="16" height="2" rx="1" transform="rotate(45 7.41422 6)" fill="currentColor" />
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
                <!--end::Close-->
            </div>
            <!--begin::Modal header-->
            <!--begin::Modal body-->
            <div class="modal-body px-10 px-lg-15 pt-0 pb-15">
                <div class="engage-toolbar d-flex position-fixed px-5 fw-bolder zindex-2  flex-row-reverse start-0 {{app()->getLocale() != 'ar'?' transform-90':'transform-270'}} mt-20 gap-2">
                    <!--begin::Demos drawer toggle-->
                    <button id="addCheckbox" class="engage-demos-toggle btn btn-flex h-35px bg-body btn-color-gray-700 btn-active-color-gray-900 shadow-sm fs-6 px-4 rounded-top-0 btn-khardl" title="Add Checkbox">
                        <span id="create_new_checkbox">+ {{ __('Checkbox') }}</span>
                    </button>
                    <!--end::Demos drawer toggle-->
                    <!--begin::Help drawer toggle-->
                    <button id="addSelection" class="engage-demos-toggle btn btn-flex h-35px bg-body btn-color-gray-700 btn-active-color-gray-900 shadow-sm fs-6 px-4 rounded-top-0 btn-khardl" title="Add Selection">
                        <span id="create_new_selection">+ {{ __('Selection') }}</span>
                    </button>
                    <!--end::Help drawer toggle-->
                    <!--begin::Purchase link-->
                    <button id="addDropdown" class="engage-demos-toggle btn btn-flex h-35px bg-body btn-color-gray-700 btn-active-color-gray-900 shadow-sm fs-6 px-4 rounded-top-0 btn-khardl" title="Add Dropdown">
                        <span id="create_new_Dropdown">+ {{ __('Dropdown') }}</span>
                    </button>
                    <!--end::Purchase link-->
                </div>


                <!--begin:Form-->
                @if($selectedCategory)
                <form id="kt_modal_new_target_form" class="form item_form" action="{{ route('restaurant.add-item', ['id' => $selectedCategory->id, 'branchId' => $branchId]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <!--begin::Title-->
                        <h1 class="mb-3">{{__('create-new-items')}}</h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Input group-->
                    <div class="row">
                        <div class="col-md-8">

                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">{{__('item-photo')}}</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="{{ __('Image will be shown to customers') }}"></i>
                                </label>
                                <input type="file" id="item_image" class="form-control form-control-solid" required placeholder="Enter Target Title" name="photo" accept="image/*" />
                            </div>
                            <!--end::Input group-->

                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-8">
                                <label class="fs-6 fw-bold mb-2">{{ __('Name') }}</label>

                                <ul class="nav nav-tabs">
                                    <li class="nav-item">
                                        <a class="nav-link active required" id="name-en-tab" data-bs-toggle="tab" href="#name-en">{{ __('English') }}</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link required" id="name-ar-tab" data-bs-toggle="tab" href="#name-ar">{{ __('Arabic') }}</a>
                                    </li>
                                </ul>
                                <div class="tab-content mt-3">
                                    <div class="tab-pane fade show active" id="name-en">
                                        <input type="text" class="form-control form-control-solid" rows="3" placeholder="{{ __('Enter name in english') }}" name="item_name_en" />
                                    </div>
                                    <div class="tab-pane fade" id="name-ar">
                                        <input type="text" class="form-control form-control-solid" rows="3" placeholder="{{ __('Enter name in arabic') }}" name="item_name_ar" />
                                    </div>
                                </div>
                            </div>

                            <!--begin::Input group-->
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <div class="d-flex justify-content-between align-items-center">
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <span class="required">{{__('item-availability')}}</span>
                                        <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify availability for an item"></i>
                                    </label>
                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                        <input type="checkbox" name="availability" checked value="1">
                                    </label>
                                </div>

                            </div>
                        </div>
                        <div class="col-md-4">
                            <img src="#" id="item-image-preview" class="rounded" style="max-height: 100%;max-width:100%" />   <!--for preview purpose -->
                        </div>
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row g-9 mb-8">
                        <!--begin::Col-->
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-bold mb-2">{{ __('Price') }}</label>
                            <!--begin::Input-->
                            <div class="position-relative d-flex align-items-center">
                                <!--begin::Datepicker-->
                                <input type="number" min="0" step="0.1" required name="price" class="form-control form-control-solid ps-12" />
                                <!--end::Datepicker-->
                            </div>
                            <!--end::Input-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-bold mb-2">{{ __('Calories') }}</label>
                            <input type="number" step="0.1" min="1" required name="calories" class="form-control form-control-solid ps-12" />
                        </div>
                        <!--end::Col-->

                    </div>
                    <!--end::Input group-->

                    <!--begin::Input group-->
                    <div class="row g-9 mb-8">
                        <!--begin::Col-->
                        <div class="col-md-6 fv-row">
                            <label class="d-flex align-items-between fs-6 fw-bold mb-4">
                                <span class="required">{{__('Allow buy with loyalty points?')}}</span>
                            </label>
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <input type="checkbox" id="allow_buy_with_loyalty_points-new" name="allow_buy_with_loyalty_points" checked value="1">
                            </label>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6 fv-row d-block" id="loyalty_point_price_section-new">
                            <label class="fs-6 fw-bold mb-2">{{ __('Price using loyalty points (how many points)') }}</label>
                            <input type="number" step="0.1" min="0" required name="price_using_loyalty_points" class="form-control form-control-solid ps-12" />
                        </div>
                        <!--end::Col-->

                    </div>
                    <!--end::Input group-->

                    <div class="d-flex flex-column mb-8">
                        <label class="fs-6 fw-bold mb-2">{{ __("Description") }}</label>

                        <ul class="nav nav-tabs">
                            <li class="nav-item">
                                <a class="nav-link active" id="d-en-tab" data-bs-toggle="tab" href="#d-en">{{ __('English') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" id="d-ar-tab" data-bs-toggle="tab" href="#d-ar">{{ __('Arabic') }}</a>
                            </li>
                        </ul>
                        <div class="tab-content mt-3">
                            <div class="tab-pane fade show active" id="d-en">
                                <textarea type="text" class="form-control form-control-solid" rows="3" placeholder="{{ __('Enter name in english') }}" name="description_en"></textarea>
                            </div>
                            <div class="tab-pane fade" id="d-ar">
                                <textarea type="text" class="form-control form-control-solid" rows="3" placeholder="{{ __('Enter name in arabic') }}" name="description_ar"></textarea>
                            </div>
                        </div>
                    </div>
                    <!--end::Input group-->



                    <div id="checkboxes">
                        <!-- Checkbox elements will be dynamically added here -->

                    </div>


                    <div id="selections">
                        <!-- Checkbox elements will be dynamically added here -->
                    </div>


                    <div id="dropdowns">
                        <!-- Checkbox elements will be dynamically added here -->
                    </div>

                    <!--begin::Actions-->
                    <div class="text-center">
                        <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">{{__('clear')}}</button>
                        <button type="submit" id="kt_modal_new_target_submit" class="btn btn-khardl">
                            <span class="indicator-label">{{__('submit')}}</span>
                            <span class="indicator-progress" id="waiting-item">{{ __('Please wait...') }}
                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                        </button>
                    </div>
                    <!--end::Actions-->
                </form>
                @endif
                <!--end:Form-->
            </div>
            <!--end::Modal body-->
        </div>
        <!--end::Modal content-->
    </div>
    <!--end::Modal dialog-->
</div>
<!--end::Modal - New Target-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
    $(document).ready(function() {
        function confirmCloseModal() {
            return confirm("{{ __('are-you-sure-you-want-to-close-without-saving') }}");
        }

        $('.btn[data-bs-dismiss="modal"]').click(function() {
            if (!confirmCloseModal()) {
                return false;
            }
        });

        $('#kt_modal_new_target').on('hide.bs.modal', function (e) {
            if (!confirmCloseModal()) {
                e.preventDefault();
            }
        });
    });
</script>
<!--begin::Scrolltop-->
<div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
    <!--begin::Svg Icon | path: icons/duotune/arrows/arr066.svg-->
    <span class="svg-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)" fill="currentColor" />
            <path d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z" fill="currentColor" />
        </svg>
    </span>
    <!--end::Svg Icon-->
</div>
<!--end::Scrolltop-->

<!--begin::Javascript-->
{{-- Items form validations --}}
<script>



    if (document.getElementById('allow_buy_with_loyalty_points')) {
        document.getElementById('allow_buy_with_loyalty_points').addEventListener('click', function (e) {
            if (e.target.checked) {
                if (document.getElementById('loyalty_point_price_section').classList.contains("d-none")) {
                    document.getElementById('loyalty_point_price_section').classList.remove('d-none');
                }
                document.getElementById('loyalty_point_price_section').classList.add('d-block');
            } else {
                if (document.getElementById('loyalty_point_price_section').classList.contains("d-block")) {
                    document.getElementById('loyalty_point_price_section').classList.remove('d-block');
                }
                document.getElementById('loyalty_point_price_section').classList.add('d-none');
            }
        });
    }

    if (document.getElementById('allow_buy_with_loyalty_points-new')) {
        document.getElementById('allow_buy_with_loyalty_points-new').addEventListener('click', function (e) {
            if (e.target.checked) {
                if (document.getElementById('loyalty_point_price_section-new').classList.contains("d-none")) {
                    document.getElementById('loyalty_point_price_section-new').classList.remove('d-none');
                }
                document.getElementById('loyalty_point_price_section-new').classList.add('d-block');
            } else {
                if (document.getElementById('loyalty_point_price_section-new').classList.contains("d-block")) {
                    document.getElementById('loyalty_point_price_section-new').classList.remove('d-block');
                }
                document.getElementById('loyalty_point_price_section-new').classList.add('d-none');
            }
        });
    }


    document.addEventListener('submit', function(e) {
        if(e.target.classList.contains('item_form')){
            e.preventDefault();
            var submitButton = e.target.querySelector('#kt_modal_new_target_submit');

            submitButton.disabled = true;

            var inputValue = e.target.querySelector('textarea[name=description_en]').value.trim();
            var inputValueAR = e.target.querySelector('textarea[name=description_ar]').value.trim();
            var inputNameValue = e.target.querySelector('input[name=item_name_en]').value;
            var inputNameValueAR = e.target.querySelector('input[name=item_name_ar]').value;
            /*
            //TODO: validate image if moved or deleted
            const fileInput = e.target.querySelector('input[type="file"]');
            console.log(fileInput.files[0]);
            if (fileInput.required && ( fileInput.files.length === 0 || !fileInput.files[0])) {
                event.preventDefault();
                alert('Please select a file.');
                submitButton.disabled = false;
                return;
            } */
            if (inputNameValue === '') {
                alert("{{ __('Please fill name input in (English) tab.') }}");
                submitButton.disabled = false;

                return;
            } else if (inputNameValueAR === '') {
                alert("{{ __('Please fill name input in (Arabic) tab .') }}");
                submitButton.disabled = false;
                return;
            }

            if (inputValueAR === '' && inputValue != '') {
                alert("{{__('Please fill description in (Arabic) tab.')}}");
                submitButton.disabled = false;

                return;
            } else if (inputValue === '' && inputValueAR != '') {
                alert("{{__('Please fill description in (English) tab.')}}");
                submitButton.disabled = false;
                return;
            }

            var englishRegex = /^[0-9a-zA-Z\s]+$/;
            var arabicRegex = /^[\u0600-\u06FF0-9\s]+$/;

            if (!englishRegex.test(inputNameValue)) {
                alert("{{__('English name is not valid, please use english characters')}}")
                submitButton.disabled = false;
                return;
            }

            if (!arabicRegex.test(inputNameValueAR)) {
                alert("{{__('Arabic name is not valid, please use arabic characters')}}");
                submitButton.disabled = false;
                return;
            }

            var waiting = document.querySelector('#waiting-item');
            waiting.style.display = 'block';

            e.target.submit();
        }
    });
    var modal = document.getElementById('kt_modal_new_target');
    modal.addEventListener('hidden.bs.modal', function() {
        document.getElementById("kt_modal_new_target_form").reset();
        document.getElementById('checkboxes').innerHTML = '';
        document.getElementById('selections').innerHTML = '';
        document.getElementById('dropdowns').innerHTML = '';

    });
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
{{-- Category validations --}}
<script>
    document.getElementById('category-submit').addEventListener('submit', function(e) {
        e.preventDefault();
        var submitButton = document.querySelector('#saveCategoryBtn');

        var inputValue = document.querySelector('input[name=name_ar]').value.trim();
        if (inputValue === '') {
            alert("{{ __('Please fill in the input in (Arabic) tab.') }}");
            return;
        }
        var inputValueAR = document.querySelector('input[name=name_en]').value.trim();
        if (inputValueAR === '') {
            alert("{{ __('Please fill in the input in the (English) tab.') }}");
            return;
        }

        document.getElementById('category-submit').submit();
    });
</script>

<!--begin::Javascript-->
<script>
    var hostUrl = "assets/";
    // script.js
    const addCategoryButton = document.getElementById("addCategoryButton");
    const categoryForm = document.getElementById("categoryForm");
    const categoryNameInput = document.getElementById("categoryName");
    const categoryList = document.getElementById("categoryList");

    addCategoryButton.addEventListener("click", () => {
        categoryForm.style.display = "block";
        categoryList.scrollTo(0, categoryList.scrollHeight);
        categoryNameInput.focus();
    });

</script>


<!-- Category sidebar -->
<script>
    const sectionsList = document.getElementById('sections-list');


    // Function to toggle between edit and save modes for a section
    function toggleEditSave(section) {
        const sectionTitle = section.querySelector('.menu-title');
        const editButton = section.querySelector('.edit-button');

        if (sectionTitle.contentEditable === 'true') {
            // Save mode
            sectionTitle.contentEditable = 'false';
            editButton.innerHTML = '<i class="fas fa-edit" style="color:#00a0f7;"></i>';
        } else {
            // Edit mode
            sectionTitle.contentEditable = 'true';
            editButton.innerHTML = '<i class="fas fa-save" style="color:#19b919;"></i>';
        }
    }

    // Function to delete a section with confirmation
    function deleteSection(section) {
        const confirmation = confirm("Are you sure you want to delete this section?");
        if (confirmation) {
            sectionsList.removeChild(section);
        }
    }


    // Add event listener for the "Add New Section" button

</script>


<script>
    function EditCategory(category_ar,category_en,category_id, category_sort){
        const updateBtn = document.getElementById("update-category-btn");
        updateBtn.classList.remove('d-none');
        updateBtn.classList.add('d-flex');
        const categoryForm = document.getElementById("category-edit-form");
        const categoryEnInput = document.getElementById("category_name_en");
        categoryEnInput.value = category_en;
        const categoryArInput = document.getElementById("category_name_ar");
        categoryArInput.value = category_ar;
        const categorySort = document.getElementById("category_sort");
        categorySort.value = category_sort;
        categoryForm.style.display = "block";
        var form = document.getElementById('category-edit');
        form.action = `{{ route('restaurant.edit-category', ['categoryId' => ':categoryId', 'branchId' => ':branchId']) }}`.replace(':categoryId', category_id).replace(':branchId', {{$branchId}});
        form.scrollIntoView({ behavior: 'smooth' });
    }

    const hideCategoryEditForm = function(id){
        document.getElementById(id).style.display = 'none';
    }
</script>

{{-- New Items here --}}
<script>
    var checkboxesContainer = document.getElementById('checkboxes');
    const addCheckboxButton = document.getElementById('addCheckbox');
    if(addCheckboxButton)
        addCheckboxButton.addEventListener('click', createCheckbox);
    var selectionsContainer = document.getElementById('selections');
    const addSelectionButton = document.getElementById('addSelection');
    if(addSelectionButton)
        addSelectionButton.addEventListener('click', createSelection);
    var dropdownsContainer = document.getElementById('dropdowns');
    const addDropdownButton = document.getElementById('addDropdown');
    if(addDropdownButton)
        addDropdownButton.addEventListener('click', createDropdown);
    </script>
<style>
    .engage-toolbar {
        position: absolute !important;
        display: flex !important;
    }

    .transform-270 {
        transform: rotate(270deg);
        transform-origin: right top;
    }

    .transform-90 {
        transform: rotate(90deg);
        transform-origin: left top;
    }

</style>
<!--end::Content-->
{{-- Image preview --}}
<script>
    function readURL(input,item_id = null) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                console.log(item_id);
                if(item_id){
                    $(`#item-image-preview-${item_id}`).attr('src', e.target.result);
                }else{
                    $('#item-image-preview').attr('src', e.target.result);
                }
            }
            reader.readAsDataURL(input.files[0]);
        }
    }

    $("#item_image").change(function(){
        readURL(this);
    });
    $(".item_image").change(function(){
        var itemID = $(this).data('item');
        readURL(this,itemID);
    });
</script>
@endsection
