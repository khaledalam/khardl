@extends('layouts.restaurant-sidebar')

@section('title', DB::table('branches')->where('id', $branchId)->value('name'))
@section('subtitle', $selectedCategory?->name)
@push('styles')
<link rel="stylesheet" href="{{ global_asset('assets/css/pages/admin/menu.css') }}" type="text/css">
@endpush
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
                <div class="d-flex flex-column fv-row option-block">
                    <!--begin::Label-->
                    <div class="d-flex justify-content-between align-items-center">
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="">{{ __('Add Checkbox') }} </span>
                        </label>
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2 form-check">
                            <input type="hidden" name="checkbox_required[${checkboxCount}]" value="false"  />
                            <input type="checkbox"  class="form-check-input" name="checkbox_required_input[${checkboxCount}]" ${key !=null ? (item.checkbox_required[key] == "true"  ? 'checked':'') : ''} >&nbsp;{{ __('Required') }} ?
                            <button class="delete-checkbox btn btn-sm" type="button" data-index="${item ? item.id : update}"><i class="fas fa-trash-alt"></i></button>
                        </label>
                    </div>
                    <!--end::Label-->

                    <div id="inputContainer${checkboxCount}">
                        <div class="input-container d-flex justify-content-between align-items-center hover-container my-3">
                            <input type="text"  required class="form-control mx-3 w-65" name="checkboxInputTitleEn[${checkboxCount}]"  placeholder="{{ __('Title in english') }}"
                            value="${key !=null ? item.checkbox_input_titles[key][0]: ''}">
                            <input type="text"  required class="form-control mx-3 w-65" name="checkboxInputTitleAr[${checkboxCount}]" placeholder="{{ __('Title in arabic') }}"
                            value="${key !=null ? item.checkbox_input_titles[key][1]: ''}">

                            <input type="number"  min="1" step="1" required class="form-control mx-3 w-45" name="checkboxInputMaximumChoice[]" placeholder="{{ __('Max') }}"
                            value="${key !=null ? item.checkbox_input_maximum_choices[key]: ''}">
                        </div>
                    </div>
                    <hr>
                    <div id="inputContainer${checkboxCount}">
                        <!-- Existing ShakePass11 elements will be dynamically added here -->
                    </div>
                    <div class="options" id="${checkboxCount}" ></div><br />
                    <a class="btn btn-sm btn-khardl add-option  too-rounded w-100" style="color: #fff !important;"><i class="fas fa-plus"></i> {{ __('Add option') }}</a>
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
                    <input type="text"  required name="checkboxInputNameEn[${optionCount}][]" class="form-control mx-3 w-50" placeholder="{{ __('Option in english') }}"
                    value="${option ? option[0] : ''}">
                    <input type="text"  required name="checkboxInputNameAr[${optionCount}][]" class="form-control mx-3 w-50" placeholder="{{ __('Option in arabic') }}"
                    value="${option ? option[1] : ''}">

                    <input type="number" min="0" step="0.1" required name="checkboxInputPrice[${optionCount}][]" class="form-control mx-3 w-50" placeholder="{{ __('Price') }}"
                    value="${price ? price : ''}">
                    <button class="invisible btn btn-sm"><i class="fas fa-trash-alt"></i></button>
                </div>
            `;
        } else {
            optionDiv.innerHTML = `
                <div class="d-flex justify-content-between mt-4">
                    <input type="text"  required name="checkboxInputNameEn[${optionCount}][]" class="form-control mx-3 w-50"  placeholder="{{ __('Option in english') }}"
                    value="${option ? option[0] : ''}">
                    <input type="text"  required name="checkboxInputNameAr[${optionCount}][]" class="form-control mx-3 w-50" placeholder="{{ __('Option in arabic') }}"
                    value="${option ? option[1] : ''}">

                    <input type="number" step="0.1" min="0" required name="checkboxInputPrice[${optionCount}][]" class="form-control mx-3 w-50" placeholder="{{ __('Price') }}"
                    value="${price ? price : ''}">
                    <button class="delete-option btn btn-sm  " type="button"><i class="fas fa-trash-alt"></i></button>
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
                <div class="d-flex flex-column fv-row option-block">
                    <!--begin::Label-->
                    <div class="d-flex justify-content-between align-items-center">
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="">{{ __('Add Selection') }}</span>
                        </label>
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2 form-check">

                            <input type="hidden" name="selection_required[${selectionCount}]" value="false" />
                            <input type="checkbox" class="form-check-input" name="selection_required_input[${selectionCount}]" disabled checked >&nbsp;{{ __('Required') }} ?
                            <button class="delete-selection btn btn-sm" type="button" data-index="${item ? item.id : update}"><i class="fas fa-trash-alt"></i></button>
                        </label>
                    </div>
                    <!--end::Label-->

                    <div id="inputContainer${selectionCount}">
                        <div class="input-container d-flex justify-content-between align-items-center hover-container my-3">
                            <input type="text"  required class="form-control mx-3 w-100" name="selectionInputTitleEn[${selectionCount}]" placeholder="{{ __('Title in english') }}"
                            value="${key !=null ? item.selection_input_titles[key][0]: ''}">
                            <input type="text"  required class="form-control mx-3 w-100" name="selectionInputTitleAr[${selectionCount}]"  placeholder="{{ __('Title in arabic') }}"
                            value="${key !=null ? item.selection_input_titles[key][1]: ''}">
                        </div>
                    </div>
                    <hr>
                    <div id="inputContainer${selectionCount}">
                        <!-- Existing ShakePass11 elements will be dynamically added here -->
                    </div>
                    <div class="options" id="${selectionCount}" ></div><br />
                    <a class="btn btn-sm btn-khardl add-option too-rounded w-100" style="color: #fff !important;"><i class="fas fa-plus"></i> {{ __('Add option') }}</a>
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
                    <input type="text" required  name="selectionInputNameEn[${optionCount}][]" class="form-control mx-3 w-50"  placeholder="{{ __('Option in english') }}"
                    value="${option ? option[0] : ''}">
                    <input type="text" required  name="selectionInputNameAr[${optionCount}][]" class="form-control mx-3 w-50"  placeholder="{{ __('Option in arabic') }}"
                    value="${option ? option[1] : ''}">

                    <input type="number" min="0" step="0.1" required name="selectionInputPrice[${optionCount}][]" class="form-control mx-3 w-50"  placeholder="{{ __('Price') }}"
                    value="${price ? price : ''}">
                    <button class="invisible btn btn-sm"><i class="fas fa-trash-alt"></i></button>
                </div>
            `;
        } else {
            optionDiv.innerHTML = `
                <div class="d-flex justify-content-between align-items-center mt-5">
                    <input type="text" required  name="selectionInputNameEn[${optionCount}][]" class="form-control mx-3 w-50"  placeholder="{{ __('Option in english') }}"
                    value="${option ? option[0] : ''}">
                    <input type="text" required  name="selectionInputNameAr[${optionCount}][]" class="form-control mx-3 w-50"  placeholder="{{ __('Option in arabic') }}"
                    value="${option ? option[1] : ''}">

                    <input type="number" min="0" step="0.1" required name="selectionInputPrice[${optionCount}][]" class="form-control mx-3 w-50"  placeholder="{{ __('Price') }}"
                    value="${price ? price : ''}">
                    <button class="delete-option btn btn-sm " type="button"><i class="fas fa-trash-alt"></i></button>
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
                <div class="d-flex flex-column fv-row option-block">
                    <!--begin::Label-->
                    <div class="d-flex justify-content-between align-items-center">
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="">{{ __('Add Dropdown') }}</span>
                        </label>
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2 form-check">

                            <input type="hidden" name="dropdown_required[${dropdownCount}]" value="true" />
                            <input type="checkbox"  class="form-check-input" name="dropdown_required_input[${dropdownCount}]" disabled checked >&nbsp;{{ __('Required') }} ?
                            <button class="delete-dropdown btn btn-sm" type="button" data-index="${item ? item.id : update}"><i class="fas fa-trash-alt"></i></button>
                        </label>
                    </div>
                    <!--end::Label-->

                    <div id="inputContainer${dropdownCount}">
                        <div class="input-container d-flex justify-content-between align-items-center hover-container my-3">
                            <input type="text"  required class="form-control mx-3 w-100" name="dropdownInputTitleEn[${dropdownCount}]" placeholder="{{ __('Title in english') }}"
                            value="${key !=null ? item.dropdown_input_titles[key][0]: ''}">
                            <input type="text"  required class="form-control mx-3 w-100" name="dropdownInputTitleAr[${dropdownCount}]"  placeholder="{{ __('Title in arabic') }}"
                            value="${key !=null ? item.dropdown_input_titles[key][1]: ''}">
                        </div>
                    </div>
                    <hr>
                    <div id="inputContainer${dropdownCount}">
                        <!-- Existing ShakePass11 elements will be dynamically added here -->
                    </div>
                    <div class="options" id="${dropdownCount}" ></div><br />
                    <a class="btn btn-sm btn-khardl add-option too-rounded w-100" style="color: #fff !important;"><i class="fas fa-plus"></i> {{ __('Add option') }}</a>
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
                        <input type="text"  required name="dropdownInputNameEn[${optionCount}][]" class="form-control mx-3 w-50" placeholder="{{ __('Option in english') }}"
                        value="${option ? option[0] : ''}">
                        <input type="text"  required name="dropdownInputNameAr[${optionCount}][]" class="form-control mx-3 w-50"  placeholder="{{ __('Option in arabic') }}"
                        value="${option ? option[1] : ''}">

                        <input type="number" min="0" step="0.1" required name="dropdownInputPrice[${optionCount}][]" class="form-control mx-3 w-50"  placeholder="{{ __('Price') }}">
                        <button class="invisible btn btn-sm"><i class="fas fa-trash-alt"></i></button>
                    </div>
            `;
        } else {
            optionDiv.innerHTML = `
                    <div class="d-flex justify-content-between align-items-center mt-5">
                        <input type="text"  required name="dropdownInputNameEn[${optionCount}][]" class="form-control mx-3 w-50"  placeholder="{{ __('Option in english') }}"
                        value="${option ? option[0] : ''}">
                        <input type="text"  required name="dropdownInputNameAr[${optionCount}][]" class="form-control mx-3 w-50"   placeholder="{{ __('Option in arabic') }}"
                        value="${option ? option[1] : ''}">

                        <input type="number" min="0" step="0.1" required name="dropdownInputPrice[${optionCount}][]" class="form-control mx-3 w-50"  placeholder="{{ __('Price') }}"
                        value="${price ? price : ''}">
                        <button class="delete-option btn btn-sm " type="button"><i class="fas fa-trash-alt"></i></button>
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
            <div class="flex-lg-row-fluid my-2 branches">
                <div id="carouselExample" class="carousel slide" data-bs-interval="false">

                    <div class="carousel-inner">
                        @foreach ($branches->chunk(3) as $key => $branchChunk)
                        <div class="carousel-item {{ $branchChunk->contains($branchId) ? 'active' : '' }}">
                            <div class="row
                            @if($branchChunk->count() == 1 || $branchChunk->count() == 2) centered @endif">
                                @foreach ($branchChunk as $branchLoop)
                                <div class="col-md-4 d-flex justify-content-center">
                                    <a href="{{ route('restaurant.get-category', ['id'=> \App\Models\Tenant\Category::where('branch_id', $branchLoop->id)?->first()?->id ?? -1,'branchId' => $branchLoop->id]) }}" style="min-width: 120px;" class="btn btn-sm @if($branchLoop->id == $branchId) active @endif">
                                        <span class="d-inline-block text-truncate" style="max-width: 80px;margin:-7px"> {{ $branchLoop->name }}</span>
                                    </a>
                                </div>
                                @endforeach
                            </div>

                        </div>
                        @endforeach
                    </div>
                    @if ($branches?->count() > 3)
                    <a class="carousel-control-prev" href="#carouselExample" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExample" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                    @endif
                </div>
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
            <div class="row">
                <!--begin::Sidebar-->
                <div class="col-md-4 {{-- col-xxl-2 --}} mb-4">
                    <!--begin::Sticky aside-->
                    <div class="card card-flush px-1">
                        <!--begin::Aside content-->
                        <div class="card-header  align-items-center py-5 gap-2 gap-md-5">
                            <div class="d-flex flex-wrap gap-1">
                                <h3>
                                    {{ __('Categories') }}
                                </h3>
                            </div>
                            <div class="d-flex align-items-center flex-wrap gap-2">
                                <button class="btn btn-sm btn-khardl add-new" {{-- id="addCategoryButton" --}} data-bs-toggle="modal" data-bs-target="#add_category">
                                    {{ __('Add new') }}
                                    <i class="fas fa-plus text-white fa-xs"></i>
                                </button>
                                <script>
                                    document.getElementById('addCategoryButton').addEventListener('click', function() {
                                        document.getElementById('addCategoryButton').click();
                                    });
                                </script>
                            </div>
                        </div>
                        <div class="card-body pt-0 px-2">
                            @if($categories->count())
                            <div id="categoryList" class="menu menu-column menu-rounded menu-state-bg menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary mb-10">
                                <!--begin::Menu item-->
                                @foreach ($categories as $category)

                                <div class="row mb-2">
                                    <!--begin::Inbox-->
                                    <div class="col-md-12">
                                        <div class="menu-link d-flex align-items-stretch justify-content-between gap-4 mb-4 p-3 @if ($category?->id === $selectedCategory?->id) active @endif">
                                            <a href="{{ route('restaurant.get-category', ['id' => $category->id, 'branchId' => $branchId]) }}">
                                                <div class="d-flex align-items-center">
                                                    <div class="category_image">
                                                        <img src="{{ $category?->photo ?? global_asset('img/category-icon.png') }}" width="35" height="35" style="border-radius: 50%;" />
                                                    </div>
                                                    <div class="d-flex flex-column ms-3">
                                                        <div class="category_name">
                                                            <span class="menu-title fw-bolder small">{{ $category->name }}</span>
                                                        </div>
                                                        <div class="category_info mt-1">
                                                            <span class="btn-khardl mx-1 px-3 py-1  mt-1">{{ __('Sort') }}: {{ $category->sort }} </span>
                                                            <span class="btn-khardl mx-1 px-3 py-1  mt-1">{{__('Products')}}: {{ $category->items?->count() }} </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </a>
                                            @if($user->isRestaurantOwner())
                                            <div class="d-flex align-items-center mx-2">
                                                <div class="dropdown">
                                                    <span style="cursor: pointer;" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <i class="fas fa-ellipsis-v"></i>
                                                    </span>
                                                    <ul class="dropdown-menu rounded">
                                                        <li>
                                                            <a class="dropdown-item text-muted py-2" href="#" data-bs-toggle="modal" data-bs-target="#edit_category_{{ $category->id }}">
                                                                {{ __('Edit category') }}
                                                            </a>
                                                        </li>
                                                        <li>
                                                            <form class="delete-form text-muted py-2" action="{{ route('restaurant.delete-category', ['id' => $category->id]) }}" method="POST" style="display: inline;">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="submit" class="dropdown-item delete-button btn-danger">
                                                                    {{ __('Delete') }}
                                                                </button>
                                                            </form>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            @endif

                                        </div>

                                    </div>
                                    <!--end::Inbox-->
                                </div>
                                <div class="modal fade" id="edit_category_{{ $category->id }}" tabindex="-1" aria-hidden="true">
                                    <!--begin::Modal dialog-->
                                    <div class="modal-dialog modal-dialog-centered mw-650px">
                                        <!--begin::Modal content-->
                                        <div class="modal-content rounded">
                                            <!--begin::Modal header-->
                                            <div class="modal-header pb-0 border-0">
                                                <!--begin::Close-->
                                                <h1 class="text-center w-100 mt-6">
                                                        {{ __('Edit new category') }}
                                                </h1>
                                                <div class="btn btn-sm btn-icon btn-active-color-khardl" data-bs-dismiss="modal">
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
                                                <div class="menu-item item-popup">
                                                    <form method="POST" action="{{ route('restaurant.edit-category', ['categoryId' => $category->id, 'branchId' => $category->branch?->id]) }}" enctype="multipart/form-data" class="mb-2">
                                                        @csrf
                                                        <div id="categoryForm" class="mt-2">
                                                            <div class="row mt-3">
                                                                <div class="col-md-12 mb-2">
                                                                    <label class="mb-1">{{__('English name')}}</label>
                                                                    <input type="text" class="form-control" value="{{ old('name_en') ?? $category->getTranslation('name','en') }}" placeholder="{{ __('Enter text in English') }}" name="name_en" id="categoryName">
                                                                </div>
                                                                <div class="col-md-12 mb-2">
                                                                    <label class="mb-1">{{__('Arabic name')}}</label>
                                                                    <input type="text" class="form-control" value="{{ old('name_ar') ?? $category->getTranslation('name','ar') }}" placeholder="{{ __('Enter text in Arabic') }}" name="name_ar">
                                                                </div>
                                                                <div class="col-md-12 mb-2">
                                                                    <label class="mb-1">{{__('sort')}}</label>
                                                                    <input type="number" name="sort" min="1" value="{{ $category->sort }}" max="{{count($categories)+1}}" value="{{count($categories)+1}}" class="form-control" placeholder="{{__('The sorting order of category')}}" />
                                                                </div>
                                                                <div class="col-md-6 mb-2" >
                                                                    <label class="mb-1">{{__('category-logo')}}</label>
                                                                    <input type="file" data-item="{{ $category->id }}" class="form-control item_image"  placeholder="Enter Target Title" name="photo" accept="image/*" />
                                                                </div>
                                                                <div class="col-md-6 mb-2">
                                                                    <img alt="category image" src="{{ $category?->photo ?? global_asset('img/category-icon.png') }}" id="item-image-preview-{{ $category->id }}" class="rounded" style="max-height: 162px;max-width:100%" />
                                                                </div>
                                                            </div>
                                                            <div class="justify-content-center mt-2">
                                                                <button type="submit" id="kt_modal_new_target_submit" class="btn btn-khardl w-100 too-rounded">
                                                                    <span class="indicator-label">{{__('Save')}}</span>
                                                                    <span class="indicator-progress" id="waiting-item">{{ __('Please wait...') }}
                                                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            <!--end::Modal body-->
                                        </div>
                                        <!--end::Modal content-->
                                    </div>
                                    <!--end::Modal dialog-->
                                </div>
                                @endforeach
                            </div>
                            @else
                            <div class="alert service-alert d-flex align-items-center" role="alert">
                                <div class="service-alert-icon">
                                    <i class="bi bi-info-circle mx-2 text-white "></i>
                                </div>
                                <div>
                                    <span>
                                        <h4>{{__('No categories found')}}</h4>
                                        {{__('Add new categories to start adding new itms')}}
                                    </span>
                                </div>
                            </div>
                            @endif

                            <!--end::Menu item-->
                            <!--begin::Menu item-->
                            <div class="modal fade" id="add_category" tabindex="-1" aria-hidden="true">
                                <!--begin::Modal dialog-->
                                <div class="modal-dialog modal-dialog-centered mw-650px">
                                    <!--begin::Modal content-->
                                    <div class="modal-content rounded">
                                        <!--begin::Modal header-->
                                        <div class="modal-header pb-0 border-0">
                                            <!--begin::Close-->
                                            <h1 class="text-center w-100 mt-6">
                                                    {{ __('Add new category') }}
                                            </h1>
                                            <div class="btn btn-sm btn-icon btn-active-color-khardl" data-bs-dismiss="modal">
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
                                            <div class="menu-item item-popup">
                                                <!--begin::Add label-->
                                                <!--end::Add label-->
                                                <form action="{{ route('restaurant.add-category', ['branchId' => $branchId]) }}" class="mb-2" method="POST" id="category-submit" enctype="multipart/form-data">
                                                    @csrf
                                                    <div id="categoryForm" class="mt-2">
                                                        <div class="row mt-3">
                                                            <div class="col-md-12 mb-2">
                                                                <label class="mb-1">{{__('English name')}}</label>
                                                                <input type="text" class="form-control" placeholder="{{ __('Enter text in English') }}" name="name_en" id="categoryName">
                                                            </div>
                                                            <div class="col-md-12 mb-2">
                                                                <label class="mb-1">{{__('Arabic name')}}</label>
                                                                <input type="text" class="form-control" placeholder="{{ __('Enter text in Arabic') }}" name="name_ar">
                                                            </div>
                                                            <div class="col-md-12 mb-2">
                                                                <label class="mb-1">{{__('sort')}}</label>
                                                                <input type="number" name="sort" min="1" max="{{count($categories)+1}}" value="{{count($categories)+1}}" class="form-control" placeholder="{{__('The sorting order of category')}}" />
                                                            </div>
                                                            <div class="col-md-6 mb-2" >
                                                                <label class="mb-1">{{__('category-logo')}}</label>
                                                                <input type="file" class="form-control" id="item_image" placeholder="Enter Target Title" name="photo" accept="image/*" />
                                                            </div>
                                                            <div class="col-md-6">
                                                                <img id="item-image-preview" class="rounded" style="max-height: 162px;max-width:100%" />
                                                            </div>
                                                        </div>
                                                        <div class="justify-content-center">
                                                            <button type="submit" class="btn btn-sm btn-khardl mx-1 mt-2" id="saveCategoryBtn">{{ __('Create') }}</button>
                                                            {{-- <button type="button" onclick="hideCategoryEditForm('categoryForm')" class="btn btn-sm btn-secondary mx-1 mt-2">{{ __('Close') }}</button> --}}
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                        <!--end::Modal body-->
                                    </div>
                                    <!--end::Modal content-->
                                </div>
                                <!--end::Modal dialog-->
                            </div>
                            <!--end::Menu item-->

                            <!--end::Menu-->
                        </div>
                        <!--end::Aside content-->
                    </div>
                    <!--end::Sticky aside-->
                </div>
                <!--end::Sidebar-->
                <!--begin::Content-->
                <div class="col-md-8 {{-- col-xxl-10 --}}">
                    <!--begin::Card-->
                    @if($selectedCategory)
                    <div class="card card-flush">
                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                            <!--begin::Actions-->
                            <div class="d-flex flex-wrap gap-1">
                                {{ __('Food items in') }}:
                                <span class="text-khardl">{{ $selectedCategory?->name }}</span>
                            </div>
                            <!--end::Actions-->
                            <!--begin::Pagination-->
                            <div class="d-flex align-items-center flex-wrap gap-2">
                                @if($selectedCategory)
                                <a href="#" data-bs-toggle="modal" data-bs-target="#kt_modal_new_target">
                                    <button class="btn btn-sm btn-khardl add-new">
                                        {{ __('Add new') }}
                                        <i class="fas fa-plus text-white fa-xs"></i>
                                    </button>
                                </a>
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
                                            <div class="btn btn-sm btn-icon btn-active-color-khardl" data-bs-dismiss="modal">
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
                                                    <div class="col-md-6">
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
                                                        <div class="row g-9 mb-8">
                                                            <!--begin::Col-->
                                                            <div class="col-md-12 fv-row">
                                                                <label class="required fs-6 fw-bold mb-2">{{ __('Price(SAR)') }}</label>
                                                                <!--begin::Input-->
                                                                <div class="position-relative d-flex align-items-center">
                                                                    <!--begin::Datepicker-->
                                                                    <input type="number" min="0" step="1" value="{{ old('price') ?? $item->price }}" required name="price" class="form-control item_price form-control-solid "  />
                                                                    <!--end::Datepicker-->
                                                                </div>
                                                                <!--end::Input-->
                                                            </div>
                                                            <!--end::Col-->
                                                            <!--begin::Col-->
                                                            <div class="col-md-12 fv-row">
                                                                <label class="required fs-6 fw-bold mb-2">{{ __('Calories(Kcal)') }}</label>
                                                                <input type="number" step="0.1" min="1" required name="calories" value="{{ old('calories') ?? $item->calories }}" class="form-control form-control-solid " />
                                                            </div>
                                                            <!--end::Col-->
                                                        </div>
                                                        <!--end::Input group-->
                                                    </div>
                                                    <div class="col-md-6">
                                                          <!--begin::Input group-->
                                                          <div class="d-flex flex-column mb-8 fv-row">
                                                            <!--begin::Label-->
                                                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                                <span class="required">{{__('item-photo')}}</span>
                                                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="{{ __('Image will be shown to customers') }}"></i>
                                                            </label>
                                                            <input type="file"  data-item="{{ $item->id }}" class="item_image form-control form-control-solid" placeholder="Enter Target Title" name="photo" accept="image/*" />
                                                            <img alt="product_image" src="{{ $item->photo }}" id="item-image-preview-{{ $item->id }}" class="rounded" style="max-height: 100%;max-width:100%" />
                                                        </div>
                                                        <!--end::Input group-->
                                                    </div>
                                                </div>

                                                <!--begin::Input group-->
                                               {{--  <div class="row g-9 mb-8">
                                                    <!--begin::Col-->
                                                    <div class="col-md-6 fv-row">
                                                        <label class="d-flex align-items-between fs-6 fw-bold mb-4">
                                                            <span class="required">{{__('Allow buy with loyalty points?')}}</span>
                                                        </label>
                                                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                            <input type="checkbox" class="allow_buy_with_loyalty_points" data-id="{{$item->id}}" name="allow_buy_with_loyalty_points" @if($item?->allow_buy_with_loyalty_points) checked @endif value="1">
                                                        </label>
                                                    </div>
                                                    <!--end::Col-->
                                                    <!--begin::Col-->
                                                    <div class="col-md-6 fv-row @if(old('price_using_loyalty_points') ?? $item?->allow_buy_with_loyalty_points) d-block @else d-none @endif" id="price_using_loyalty_points{{$item->id}}" >
                                                        <label class="fs-6 fw-bold mb-2">{{ __('Product price with loyalty points (How many points)') }}</label>
                                                        <input type="number" step="0.1" min="0" name="price_using_loyalty_points" value="{{ old('price_using_loyalty_points') ?? $item?->price_using_loyalty_points }}" class="form-control price_using_loyalty_points form-control-solid " />
                                                        @if($item->LoyaltyPointRatio)
                                                        <div class="loyalty_point_calculation">
                                                            <span>{{__('For every 10 riyal, :point points correspond to the cost of product options',['point'=>10*$item->LoyaltyPointRatio])}}</span> <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="{{__('loyalty points for item options will get calculated automatically')}}"></i>
                                                        </div>
                                                        @else
                                                        <div class="loyalty_point_calculation"></div>
                                                        @endif

                                                    </div>
                                                    <!--end::Col-->

                                                </div> --}}
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
                                                <div class="row g-9 mb-8">
                                                    <div class="col-md-5 fv-row">
                                                        <!--begin::Label-->
                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                                <span class="required">{{__('item-availability')}}</span>

                                                            </label>
                                                            <label class="d-flex align-items-center fs-6 fw-bold mb-2 custom-switch">
                                                                <input type="checkbox" type="checkbox" name="availability" value="1" {{ old('availability') || $item->availability ? 'checked' : '' }}>
                                                                <span class="slider round"></span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                    <!--begin::Col-->
                                                    <div class="col-md-7 fv-row">
                                                        <div class="row">
                                                            <div class="col-md-7">
                                                                <div  class="d-flex align-items-between">
                                                                    <label class="fs-6 fw-bold mb-4">
                                                                        <span>{{__('Allow buy with loyalty points?')}}</span>
                                                                    </label>
                                                                    <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                                                        <label class="custom-switch">
                                                                            <input type="checkbox" type="checkbox" class="allow_buy_with_loyalty_points" data-id="{{$item->id}}" name="allow_buy_with_loyalty_points" @if($item?->allow_buy_with_loyalty_points) checked @endif value="1">
                                                                            <span class="slider round"></span>
                                                                        </label>
                                                                    </label>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-5 @if(old('price_using_loyalty_points') ?? $item?->allow_buy_with_loyalty_points) d-block @else d-none @endif" id="price_using_loyalty_points{{$item->id}}">
                                                                <div {{-- id="loyalty_point_price_section-new" --}}>
                                                                    <input type="number" step="0.1" min="0" placeholder="{{ __('Loyalty price') }}" value="{{ old('price_using_loyalty_points') ?? $item?->price_using_loyalty_points }}"  name="price_using_loyalty_points" class="form-control price_using_loyalty_points form-control-solid " />
                                                                    @if($item->LoyaltyPointRatio)
                                                                    <div class="loyalty_point_calculation text-muted">
                                                                        <span>{{__('For every 10 riyal, :point points correspond to the cost of product options',['point'=>10*$item->LoyaltyPointRatio])}}</span> <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="{{__('loyalty points for item options will get calculated automatically')}}"></i>
                                                                    </div>
                                                                    @else
                                                                    <p class="text-muted">{{ __('How many points') }}</p>
                                                                    <div class="loyalty_point_calculation"></div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!--end::Col-->
                                                </div>
                                                <div class="row mb-4">
                                                    <div class="col-md-4 mb-2">
                                                        <!--begin::Demos drawer toggle-->
                                                        <button id="addCheckbox_{{ $item->id }}" class="btn option-btn" type="button" title="Add Checkbox">
                                                            <span id="create_new_checkbox">
                                                                <i class="fas fa-plus text-black"></i>
                                                                {{ __('Checkbox') }}
                                                            </span>
                                                        </button>
                                                        <!--end::Demos drawer toggle-->
                                                    </div>
                                                    <div class="col-md-4 mb-2">
                                                        <!--begin::Help drawer toggle-->
                                                        <button id="addSelection_{{ $item->id }}" class="btn option-btn" type="button" title="Add Selection">
                                                            <span id="create_new_selection">
                                                                <i class="fas fa-plus text-black"></i>
                                                                {{ __('Selection') }}
                                                            </span>
                                                        </button>
                                                        <!--end::Help drawer toggle-->
                                                    </div>
                                                    <div class="col-md-4 mb-2">
                                                        <!--begin::Purchase link-->
                                                    <button id="addDropdown_{{ $item->id }}" class="btn option-btn" type="button" title="Add Dropdown">
                                                        <span id="create_new_Dropdown">
                                                            <i class="fas fa-plus text-black"></i>
                                                            {{ __('Dropdown') }}
                                                        </span>
                                                    </button>
                                                    <!--end::Purchase link-->
                                                    </div>
                                                </div>
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
                                                <!--begin::Actions-->
                                                <div class="text-center">
                                                    <button type="submit" id="kt_modal_new_target_submit" class="btn btn-khardl w-100 too-rounded">
                                                        <span class="indicator-label">{{__('Save')}}</span>
                                                        <span class="indicator-progress" id="waiting-item">{{ __('Please wait...') }}
                                                            <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                    </button>
                                                </div>
                                                <!--end::Actions-->
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
                            <div class="items row mb-2 px-2" id="kt_inbox_listing">
                                <!--begin::Table body-->
                                @foreach ($items as $item)
                                <div class="col-md-6">
                                    <div class="item mt-3 {{ $item->availability ? '':'un-available'}}">
                                        <div class="d-flex align-items-center rounded-3 p-3 justify-content-between">
                                            <div class="image" data-bs-toggle="tooltip" title="{{$item->name}}">
                                                <img alt="Pic" src="{{$item->photo}}" style="width: 80px; height: 80px;"/>
                                            </div>
                                            <div class="flex-grow-1 ms-3">
                                                <div class="d-flex align-items-center">
                                                    <h5 class="mb-0 fs-5 fw-bold me-auto">
                                                        <a href="{{ route('restaurant.view-item',['item' => $item->id]) }}">
                                                            <span class="fw-bolder text-darken text-start">{{ $item->name }}</span>
                                                        </a>
                                                    </h5>
                                                    <div class="dropdown">
                                                        <span style="cursor: pointer;" data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fas fa-ellipsis-v"></i>
                                                        </span>
                                                        <ul class="dropdown-menu rounded">
                                                            <li>
                                                                <a class="dropdown-item text-muted py-2" href="{{ route('restaurant.view-item',['item' => $item->id]) }}">
                                                                    {{ __('View') }}
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a class="dropdown-item text-muted py-2" href="#" data-bs-toggle="modal" data-bs-target="#kt_modal_new_target_{{ $item->id }}">
                                                                    {{ __('Edit') }}
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <form class="delete-form" action="{{ route('restaurant.delete-item', ['id' => $item->id]) }}" method="POST">
                                                                    @method('DELETE')
                                                                    @csrf
                                                                    <a href="#" class="dropdown-item delete-button btn-danger">{{ __('delete') }}</a>
                                                                </form>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                @if($item->description)
                                                <span class="btn-tooltip" data-bs-toggle="tooltip" title="{{ $item->description }}" data-container="body" data-animation="true" data-bs-toggle="tooltip">{{ Str::limit($item->description, 20, '...') }}</span>
                                                @else
                                                <span>{{ __('No description') }}</span>
                                                @endif
                                                <div class="d-flex justify-content-between align-items-center mt-2">
                                                    <span class="btn-fire rounded-pill px-3 py-2 fs-6  fw-bold">
                                                        <i class="fas fa-fire " style="color: #FF3D00"></i>
                                                        {{ $item->calories }} {{ __('Kcal') }}
                                                    </span>
                                                    <span class="btn-khardl text-white rounded-pill px-2 py-2 fs-6 fw-bold">{{ $item->price }} {{ __("SAR") }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            <!--end::Table body-->
                            </div>
                            {{-- TODO: load item when scroll down --}}
                            <!--end::Table-->
                        </div>
                    </div>
                    @endif
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
                <div class="btn btn-sm btn-icon btn-active-color-khardl" data-bs-dismiss="modal">
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
                <!--begin:Form-->
                @if($selectedCategory)
                <form id="kt_modal_new_target_form" class="item-popup form item_form" action="{{ route('restaurant.add-item', ['id' => $selectedCategory->id, 'branchId' => $branchId]) }}" method="POST" enctype="multipart/form-data">
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
                        <div class="col-md-6">
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
                            <div class="row g-9 mb-8">
                                <!--begin::Col-->
                                <div class="col-md-12 fv-row ">
                                    <label class="required fs-6 fw-bold mb-2">{{ __('Price(SAR)') }}</label>
                                    <!--begin::Input-->
                                    <div class="position-relative d-flex align-items-center">
                                        <!--begin::Datepicker-->
                                        <input type="number" min="0" step="1" required name="price" class="form-control item_price form-control-solid " />
                                        <!--end::Datepicker-->
                                    </div>
                                    <!--end::Input-->
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-12 fv-row">
                                    <label class="required fs-6 fw-bold mb-2">{{ __('Calories(Kcal)') }}</label>
                                    <input type="number" step="0.1" min="1" required name="calories" class="form-control form-control-solid " />
                                </div>
                                <!--end::Col-->
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="d-flex flex-column mb-8 fv-row">
                                <!--begin::Label-->
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">{{__('item-photo')}}</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="{{ __('Image will be shown to customers') }}"></i>
                                </label>
                                <input type="file" id="item_image" class="form-control form-control-solid" required placeholder="Enter Target Title" name="photo" accept="image/*" />
                            </div>
                            <img src="#" id="item-image-preview" class="rounded" style="max-height: 100%;max-width:100%" />
                            <!--for preview purpose -->
                        </div>
                        <div class="col-md-12">
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
                        </div>
                        <!--end::Input group-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row g-9 mb-8">
                        <div class="col-md-5 fv-row">
                            <!--begin::Label-->
                            <div class="d-flex justify-content-between align-items-center">
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">{{__('item-availability')}}</span>

                                </label>
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2 custom-switch">
                                    <input type="checkbox" type="checkbox" name="availability" checked value="1">
                                    <span class="slider round"></span>
                                </label>
                            </div>
                        </div>
                        <!--begin::Col-->
                        <div class="col-md-7 fv-row">
                            <div class="row" >
                                <div class="col-md-7">
                                    <div  class="d-flex align-items-between">
                                        <label class="fs-6 fw-bold mb-4">
                                            <span>{{__('Allow buy with loyalty points?')}}</span>
                                        </label>
                                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                            <label class="custom-switch">
                                                <input type="checkbox" type="checkbox" id="allow_buy_with_loyalty_points-new" name="allow_buy_with_loyalty_points" checked value="1">
                                                <span class="slider round"></span>
                                            </label>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-md-5" id="loyalty_point_price_section-new" >
                                    <div class="d-block" id="loyalty_points" >
                                        <input type="number" step="0.1" min="0" placeholder="{{ __('Loyalty price') }}" name="price_using_loyalty_points" class="form-control price_using_loyalty_points form-control-solid " />
                                        <p class="text-muted">{{ __('How many points') }}</p>
                                        <div class="loyalty_point_calculation"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!--end::Col-->
                    </div>
                    <div class="row mb-4">
                        <div class="col-md-4 mb-2">
                            <!--begin::Demos drawer toggle-->
                            <button id="addCheckbox" class="btn option-btn" type="button" title="Add Checkbox">
                                <span id="create_new_checkbox">
                                    <i class="fas fa-plus text-black"></i>
                                    {{ __('Checkbox') }}
                                </span>
                            </button>
                            <!--end::Demos drawer toggle-->
                        </div>
                        <div class="col-md-4 mb-2">
                            <!--begin::Help drawer toggle-->
                            <button id="addSelection" class="btn option-btn" type="button" title="Add Selection">
                                <span id="create_new_selection">
                                    <i class="fas fa-plus text-black"></i>
                                    {{ __('Selection') }}
                                </span>
                            </button>
                            <!--end::Help drawer toggle-->
                        </div>
                        <div class="col-md-4 mb-2">
                            <!--begin::Purchase link-->
                        <button id="addDropdown" class="btn option-btn" type="button" title="Add Dropdown">
                            <span id="create_new_Dropdown">
                                <i class="fas fa-plus text-black"></i>
                                {{ __('Dropdown') }}
                            </span>
                        </button>
                        <!--end::Purchase link-->
                        </div>
                    </div>
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
                        <button type="submit" id="kt_modal_new_target_submit" class="btn btn-khardl w-100 too-rounded">
                            <span class="indicator-label">{{__('Save')}}</span>
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
        $('#carouselExample').carousel({
            pause: true,
            interval: false,
        });
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

    $(document).ready(function() {
        var translations = {
            'en': 'For every 10 riyal, :point points correspond to the cost of product options',
            'ar': 'لكل ١٠ ريال مقابلها :point نقطة تكلفة خيارات المنتج'
        };

        function translate(replacements) {
            var translation = translations['{{app()->getLocale()}}'];
            for (var placeholder in replacements) {
                translation = translation.replace(`:${placeholder}`, replacements[placeholder]);
            }
            return translation;
        }

        $('.item_price, .price_using_loyalty_points').on('input', function() {
            let container =  $(this).closest('.modal-body');
            let itemPrice = container.find('.item_price').val()
            let loyaltyPoints = container.find('.price_using_loyalty_points').val()

            if (itemPrice !== '' && loyaltyPoints !== '') {

                let text = translate({  point: Math.ceil(10*(loyaltyPoints/itemPrice).toFixed(2)) });
                let loyalty_point_calculation = container.find('.loyalty_point_calculation');
                loyalty_point_calculation.html(`<span>${text}</span> <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="{{__('loyalty points for item options will get calculated automatically')}}"></i>`);
                loyalty_point_calculation.find('[data-bs-toggle="tooltip"]').tooltip();

            }
        });
        $('.allow_buy_with_loyalty_points').change(function(){
            if($(this).is(':checked')){
                $('#price_using_loyalty_points'+$(this).data("id")).removeClass('d-none').addClass( 'd-block');
            }else {
                $('#price_using_loyalty_points'+$(this).data("id")).removeClass('d-block').addClass( 'd-none');
            }

        });
    });
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
                if (document.getElementById('loyalty_points').classList.contains("d-none")) {
                    document.getElementById('loyalty_points').classList.remove('d-none');
                }
                document.getElementById('loyalty_points').classList.add('d-block');
            } else {
                if (document.getElementById('loyalty_points').classList.contains("d-block")) {
                    document.getElementById('loyalty_points').classList.remove('d-block');
                }
                document.getElementById('loyalty_points').classList.add('d-none');
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
            console.log(form);
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

<!--end::Content-->
{{-- Image preview --}}
<script>
    function readURL(input,item_id = null) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
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
        if(this.files[0].size > 4194304) {
            alert("{{__('The file size is large, a maximum of 4 MB must be uploaded!')}}");
            this.value = "";
        }
        readURL(this);
    });
    $(".item_image").change(function(){
        if(this.files[0].size > 4194304) {
            alert("{{__('The file size is large, a maximum of 4 MB must be uploaded!')}}");
            this.value = "";
        }
        var itemID = $(this).data('item');
        readURL(this,itemID);
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
@endsection
