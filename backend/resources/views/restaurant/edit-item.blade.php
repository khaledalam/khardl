@extends('layouts.restaurant-sidebar')

@section('title', $item->name)

@section('content')<div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">
    <!--begin::Post-->
    <div class="post" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container">
            <!--begin::Navbar-->
            <div class="card mb-5 mb-xl-10">
                <div class="card-header">
                    <div class="card-title">
                        <div class="d-flex flex-column">
                            <!--begin::Name-->
                            <div class="d-flex align-items-center mb-2">

                                <a class="text-primar fs-2 fw-bolder me-1">
                                    {{ __('Edit item : '). $item->name}}
                                </a>
                            </div>
                            <!--end::Name-->
                        </div>
                    </div>
                    <a href="{{ route('restaurant.get-category', ['id' => $item->category_id,'branchId' => $item->branch_id]) }}" class="mt-4">
                        <button type="button" class="btn btn-khardl btn-sm">
                            <i class="fa fa-arrow-left"></i>
                            {{ __('Back to list') }}
                        </button>
                    </a>
                </div>
                <div class="card-body pt-9 pb-0">
                    <div class="modal-dialog" id="kt_modal_new_target" tabindex="-1" aria-hidden="true">
                        <!--begin::Modal dialog-->
                        <div class="modal-dialog modal-dialog-centered mw-650px">
                            <!--begin::Modal content-->
                            <div class="modal-content rounded">
                                <!--begin::Modal header-->

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
                                        </button>                        <!--end::Help drawer toggle-->
                                        <!--begin::Purchase link-->
                                        <button id="addDropdown" class="engage-demos-toggle btn btn-flex h-35px bg-body btn-color-gray-700 btn-active-color-gray-900 shadow-sm fs-6 px-4 rounded-top-0 btn-khardl" title="Add Dropdown">
                                            <span id="create_new_Dropdown">+ {{ __('Dropdown') }}</span>
                                        </button>
                                        <!--end::Purchase link-->
                                    </div>


                                    <!--begin:Form-->

                                    <form id="kt_modal_new_target_form" class="form" action="{{ route('restaurant.update-item',['item' => $item->id]) }}"  method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <!--end::Heading-->
                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column mb-8 fv-row">
                                            <!--begin::Label-->
                                            <label class="d-flex align-items-center fs-6 fw-bold mb-2 mt-2">
                                                {{__('item-photo')}}</span>
                                            </label>
                                            <!--end::Label-->
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <input type="file" class="form-control form-control-solid" placeholder="Enter Target Title" name="photo" accept="image/*" />
                                                </div>
                                                <div class="col-md-3">
                                                    <img alt="product_image" src="{{ $item->photo }}" class="rounded" style="max-height: 100%;max-width:100%"/>
                                                </div>
                                            </div>
                                        </div>
                                        <!--end::Input group-->

                                        <!--begin::Input group-->
                                        <div class="d-flex flex-column mb-8">
                                            <label class="fs-6 fw-bold mb-2">{{ __('Name') }}</label>

                                            <ul class="nav nav-tabs" >
                                                <li class="nav-item">
                                                    <a class="nav-link active required" id="name-en-tab" data-bs-toggle="tab" href="#name-en-{{ $item->id }}">{{ __('English') }}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link required" id="name-ar-tab" data-bs-toggle="tab" href="#name-ar-{{ $item->id }}">{{ __('Arabic') }}</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content mt-3">
                                                <div class="tab-pane fade show active" id="name-en-{{ $item->id }}">
                                                    <input type="text" class="form-control form-control-solid"  rows="3" placeholder="{{ __('Enter name in english') }}" name="item_name_en" value="{{ old('item_name_en') ??  $item->getTranslation('name', 'en') }}"/>
                                                </div>
                                                <div class="tab-pane fade" id="name-ar-{{ $item->id }}">
                                                    <input type="text" class="form-control form-control-solid"  rows="3" placeholder="{{ __('Enter name in arabic') }}" name="item_name_ar" value="{{ old('item_name_ar') ?? $item->getTranslation('name', 'ar') }}"/>
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

                                        <div class="d-flex flex-column mb-8">
                                            <label class="fs-6 fw-bold mb-2">{{ __("Description") }}</label>

                                            <ul class="nav nav-tabs" >
                                                <li class="nav-item">
                                                    <a class="nav-link active" id="d-en-tab" data-bs-toggle="tab" href="#d-en">{{ __('English') }}</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" id="d-ar-tab" data-bs-toggle="tab" href="#d-ar">{{ __('Arabic') }}</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content mt-3">
                                                <div class="tab-pane fade show active" id="d-en">
                                                    <textarea type="text" class="form-control form-control-solid"  rows="3" placeholder="{{ __('Enter name in english') }}"  name="description_en">
                                                        {{ old('description_en') ?? $item->getTranslation('description', 'en') }}
                                                    </textarea>
                                                </div>
                                                <div class="tab-pane fade" id="d-ar">
                                                    <textarea type="text" class="form-control form-control-solid"  rows="3" placeholder="{{ __('Enter name in arabic') }}"   name="description_ar">
                                                        {{ old('description_ar') ?? $item->getTranslation('description', 'ar') }}
                                                    </textarea>
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
                                            <button type="submit" id="kt_modal_new_target_submit" class="btn btn-khardl">
                                                <span class="indicator-label">{{__('submit')}}</span>
                                                <span class="indicator-progress" id="waiting-item">{{ __('Please wait...') }}
                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                            </button>
                                        </div>
                                        <!--end::Actions-->
                                    </form>

                                        <!--end:Form-->
                                </div>
                                <!--end::Modal body-->
                            </div>
                            <!--end::Modal content-->
                        </div>
                        <!--end::Modal dialog-->
                    </div>
                </div>

                <!--end::Container-->
            </div>
            <!--end::Post-->
        </div>
    </div>

</div>

<!-- Checkbox -->
<script>
    const checkboxesContainer = document.getElementById('checkboxes');
    const addCheckboxButton = document.getElementById('addCheckbox');

    let checkboxCount = -1;

    function createCheckbox(item = null,key = null) {
        checkboxCount++;
        const checkboxDiv = document.createElement('div');
        checkboxDiv.className = 'd-flex flex-column mb-8 fv-row';
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
                        <input type="text" style="box-shadow:0 0 13px 2px rgba(0, 0, 0, 0.2) !important;" required class="form-control form-control-solid mx-3 w-65" name="checkboxInputTitleEn[]"  placeholder="{{ __('Title in english') }}"
                        value="${key !=null ? item.checkbox_input_titles[key][0]: ''}">
                        <input type="text" style="box-shadow:0 0 13px 2px rgba(0, 0, 0, 0.2) !important;" required class="form-control form-control-solid mx-3 w-65" name="checkboxInputTitleAr[]" placeholder="{{ __('Title in arabic') }}"
                        value="${key !=null ? item.checkbox_input_titles[key][1]: ''}">

                        <input type="number" style="box-shadow:0 0 13px 2px rgba(0, 0, 0, 0.2) !important;" min="0" step="1" required class="form-control form-control-solid mx-3 w-45" name="checkboxInputMaximumChoice[]" placeholder="{{ __('Max') }}"
                        value="${key !=null ? item.checkbox_input_maximum_choices[key]: ''}">
                        <button class="delete-checkbox btn btn-sm btn-white"><i class="fas fa-trash text-danger"></i></button>
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
        deleteCheckboxButton.addEventListener('click', () => {
            checkboxesContainer.removeChild(checkboxDiv);
        });
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

        checkboxesContainer.appendChild(checkboxDiv);
        if(key!=null){
            if(item.checkbox_input_prices!= null && item.checkbox_input_names!=null){
                item.checkbox_input_names[key].forEach(function(value,index) {
                    createCheckBoxOption(checkboxDiv,false, value, item.checkbox_input_prices[key][index]);
                });
            }
        }else{
            createCheckBoxOption(checkboxDiv,false);
        }
    }

    function createCheckBoxOption(checkboxDiv,isDeletable = false, option = null, price = null) {
        const optionsDiv = checkboxDiv.querySelector('.options');
        const optionCount = optionsDiv.id;
        const optionDiv = document.createElement('div');
        optionDiv.className = 'option';
        if(isDeletable){
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
        }else {
            optionDiv.innerHTML = `
            <div class="d-flex justify-content-between mt-4">
                <input type="text"  required name="checkboxInputNameEn[${optionCount}][]" class="form-control form-control-solid mx-3 w-50"  placeholder="{{ __('Option in english') }}"
                value="${option ? option[0] : ''}">
                <input type="text"  required name="checkboxInputNameAr[${optionCount}][]" class="form-control form-control-solid mx-3 w-50" placeholder="{{ __('Option in arabic') }}"
                value="${option ? option[1] : ''}">

                <input type="number" step="0.1" min="0" required name="checkboxInputPrice[${optionCount}][]" class="form-control form-control-solid mx-3 w-50" placeholder="{{ __('Price') }}"
                value="${price ? price : ''}">
                <button class="delete-option btn btn-sm btn-white"><i class="fas fa-trash text-danger"></i></button>
            </div>
        `;

            const deleteOptionButton = optionDiv.querySelector('.delete-option');
            deleteOptionButton.addEventListener('click', () => {
                optionsDiv.removeChild(optionDiv);
            });
        }



        optionsDiv.appendChild(optionDiv);
    }

    addCheckboxButton.addEventListener('click', createCheckbox);
</script>

<!-- Selection -->
<script>
    const selectionsContainer = document.getElementById('selections');
    const addSelectionButton = document.getElementById('addSelection');

    let selectionCount = -1;

    function createSelection(item = null, key = null) {
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
                        <input type="checkbox" name="selection_required_input[${selectionCount}]" ${key !=null ? (item.selection_required[key] == "true"  ? 'checked':'') : ''} >&nbsp;{{ __('Required') }}
                    </label>
                </div>
                <!--end::Label-->

                <div id="inputContainer${selectionCount}">
                    <div class="input-container d-flex justify-content-between align-items-center hover-container my-3">
                        <input type="text" style="box-shadow:0 0 13px 2px rgba(0, 0, 0, 0.2) !important;" required class="form-control form-control-solid mx-3 w-100" name="selectionInputTitleEn[]" placeholder="{{ __('Title in english') }}"
                        value="${key !=null ? item.selection_input_titles[key][0]: ''}">
                        <input type="text" style="box-shadow:0 0 13px 2px rgba(0, 0, 0, 0.2) !important;" required class="form-control form-control-solid mx-3 w-100" name="selectionInputTitleAr[]"  placeholder="{{ __('Title in arabic') }}"
                        value="${key !=null ? item.selection_input_titles[key][1]: ''}">

                        <button class="delete-selection btn btn-sm btn-white"><i class="fas fa-trash text-danger"></i></button>
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
        deleteSelectionButton.addEventListener('click', () => {
            selectionsContainer.removeChild(selectionDiv);
        });
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

        selectionsContainer.appendChild(selectionDiv);
        if(key!=null){
            if(item.selection_input_prices!= null && item.selection_input_names !=null){
                item.selection_input_names[key].forEach(function(value,index) {
                        createSelectionOption(selectionDiv, selectionCount,false,value, item.selection_input_prices[key][index]);
                });
            }
        }else{
            createSelectionOption(selectionDiv, selectionCount,false);
        }
    }

    function createSelectionOption(selectionDiv, selectionCount,isDeletable = false, option = null, price = null) {
        const optionsDiv = selectionDiv.querySelector('.options');
        const optionCount = optionsDiv.id;
        const optionDiv = document.createElement('div');
        optionDiv.className = 'option';
        if(isDeletable){
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
        `;  }
        else {
            optionDiv.innerHTML = `
            <div class="d-flex justify-content-between align-items-center mt-5">
                <input type="text" required  name="selectionInputNameEn[${optionCount}][]" class="form-control form-control-solid mx-3 w-50"  placeholder="{{ __('Option in english') }}"
                value="${option ? option[0] : ''}">
                <input type="text" required  name="selectionInputNameAr[${optionCount}][]" class="form-control form-control-solid mx-3 w-50"  placeholder="{{ __('Option in arabic') }}"
                value="${option ? option[1] : ''}">

                <input type="number" min="0" step="0.1" required name="selectionInputPrice[${optionCount}][]" class="form-control form-control-solid mx-3 w-50"  placeholder="{{ __('Price') }}"
                value="${price ? price : ''}">
                <button class="delete-option btn btn-sm btn-white"><i class="fas fa-trash text-danger"></i></button>
            </div>
        `;

        const deleteOptionButton = optionDiv.querySelector('.delete-option');
        deleteOptionButton.addEventListener('click', () => {
            optionsDiv.removeChild(optionDiv);
        });
        }


        optionsDiv.appendChild(optionDiv);
    }

    addSelectionButton.addEventListener('click', createSelection);
</script>

<!-- Dropdown -->
<script>
    const dropdownsContainer = document.getElementById('dropdowns');
    const addDropdownButton = document.getElementById('addDropdown');

    let dropdownCount = -1;

    function createDropdown(item = null, key = null) {
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
                        <input type="checkbox" name="dropdown_required_input[${dropdownCount}]"  ${key !=null ? (item.dropdown_required[key] == "true"  ? 'checked':'') : ''} >&nbsp;{{ __('Required') }}
                    </label>
                </div>
                <!--end::Label-->

                <div id="inputContainer${dropdownCount}">
                    <div class="input-container d-flex justify-content-between align-items-center hover-container my-3">
                        <input type="text" style="box-shadow:0 0 13px 2px rgba(0, 0, 0, 0.2) !important;" required class="form-control form-control-solid mx-3 w-100" name="dropdownInputTitleEn[]" placeholder="{{ __('Title in english') }}"
                        value="${key !=null ? item.dropdown_input_titles[key][0]: ''}">
                        <input type="text" style="box-shadow:0 0 13px 2px rgba(0, 0, 0, 0.2) !important;" required class="form-control form-control-solid mx-3 w-100" name="dropdownInputTitleAr[]"  placeholder="{{ __('Title in arabic') }}"
                        value="${key !=null ? item.dropdown_input_titles[key][1]: ''}">

                        <button class="delete-dropdown btn btn-sm btn-white"><i class="fas fa-trash text-danger"></i></button>
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
        deleteDropdownButton.addEventListener('click', () => {
            dropdownsContainer.removeChild(dropdownDiv);
        });
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

        dropdownsContainer.appendChild(dropdownDiv);
        if(key!=null){
            if(item.dropdown_input_prices!= null && item.dropdown_input_names !=null){
                item.dropdown_input_names[key].forEach(function(value,index) {
                    createDropdownOption(dropdownDiv,false,value,item.dropdown_input_prices[key][index]);
                });
            }
        }else{
            createDropdownOption(dropdownDiv,false);
        }
    }

    function createDropdownOption(dropdownDiv,isDeletable = false, option = null, price = null) {
        const optionsDiv = dropdownDiv.querySelector('.options');
        const optionCount = optionsDiv.id;
        const optionDiv = document.createElement('div');
        optionDiv.className = 'option';
        if(isDeletable){
        optionDiv.innerHTML = `
                <div class="d-flex justify-content-between align-items-center mt-5">
                    <input type="text"  required name="dropdownInputNameEn[${optionCount}][]" class="form-control form-control-solid mx-3 w-50" placeholder="{{ __('Option in english') }}"
                    value="${option ? option[0] : ''}">
                    <input type="text"  required name="dropdownInputNameAr[${optionCount}][]" class="form-control form-control-solid mx-3 w-50"  placeholder="{{ __('Option in arabic') }}"
                    value="${option ? option[1] : ''}">

                    <input type="number" min="0" step="0.1" required name="dropdownInputPrice[${optionCount}][]" class="form-control form-control-solid mx-3 w-50"  placeholder="{{ __('Price') }}">
                    <button class="invisible btn btn-sm btn-white"><i class="fas fa-trash text-danger"></i></button>
                </div>
        `; }else {
            optionDiv.innerHTML = `
                <div class="d-flex justify-content-between align-items-center mt-5">
                    <input type="text"  required name="dropdownInputNameEn[${optionCount}][]" class="form-control form-control-solid mx-3 w-50"  placeholder="{{ __('Option in english') }}"
                    value="${option ? option[0] : ''}">
                    <input type="text"  required name="dropdownInputNameAr[${optionCount}][]" class="form-control form-control-solid mx-3 w-50"   placeholder="{{ __('Option in arabic') }}"
                    value="${option ? option[1] : ''}">

                    <input type="number" min="0" step="0.1" required name="dropdownInputPrice[${optionCount}][]" class="form-control form-control-solid mx-3 w-50"  placeholder="{{ __('Price') }}"
                    value="${price ? price : ''}">
                    <button class="delete-option btn btn-sm btn-white"><i class="fas fa-trash text-danger"></i></button>
                </div>
        `;
        const deleteOptionButton = optionDiv.querySelector('.delete-option');
        deleteOptionButton.addEventListener('click', () => {
            optionsDiv.removeChild(optionDiv);
        });

        }

        optionsDiv.appendChild(optionDiv);
    }

    addDropdownButton.addEventListener('click', createDropdown);


    document.getElementById('kt_modal_new_target_form').addEventListener('submit', function (e) {
        e.preventDefault();
        var submitButton = document.querySelector('#kt_modal_new_target_submit');

        submitButton.disabled = true;

        var inputValue = document.querySelector('textarea[name=description_en]').value.trim();
        var inputNameValue = document.querySelector('input[name=item_name_en]').value;
        var inputValueAR = document.querySelector('textarea[name=description_ar]').value.trim();
        var inputNameValueAR = document.querySelector('input[name=item_name_ar]').value;

        if (inputNameValue === '') {
            alert(`Please fill name input in (English) tab.`);
            submitButton.disabled = false;

            return ;
        }else if (inputNameValueAR === '' ) {
            alert(`Please fill name input in (Arabic) tab .`);
            submitButton.disabled = false;
            return ;
        }

        if (inputValueAR === '' && inputValue != ''){
            alert("{{__('Please fill description in (Arabic) tab.')}}");
            submitButton.disabled = false;

            return ;
        } else if(inputValue === '' && inputValueAR != ''){
            alert("{{__('Please fill description in (English) tab.')}}");
            submitButton.disabled = false;
            return ;
        }

        var englishRegex = /^[0-9a-zA-Z\s]+$/;
        var arabicRegex = /^[\u0600-\u06FF0-9\s]+$/;

        if (!englishRegex.test(inputNameValue)) {
            alert("{{__('English name is not valid')}}")
            submitButton.disabled = false;
            return ;
        }

        if (!arabicRegex.test(inputNameValueAR)) {
            alert("{{__('Arabic name is not valid')}}");
            submitButton.disabled = false;
            return ;
        }

        var waiting = document.querySelector('#waiting-item');
        waiting.style.display = 'block';

        document.getElementById('kt_modal_new_target_form').submit();



    });
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
    .modal-dialog {
        max-width: 800px;
    }
</style>
{{-- Add items options --}}
<script>
    var item = @json($item);
    var checkboxOptions = @json($item->checkbox_input_titles);
    if(checkboxOptions){
        checkboxOptions.forEach(function(value,key) {
            createCheckbox(item,key);
        });
    }
    var selectionOptions = @json($item->selection_input_titles);
    if(selectionOptions){
        selectionOptions.forEach(function(value,key) {
            createSelection(item,key);
        });
    }
    var dropdownOptions = @json($item->dropdown_input_titles);
    if(dropdownOptions){
        dropdownOptions.forEach(function(value,key) {
            createDropdown(item,key);
        });
    }
</script>
@endsection
