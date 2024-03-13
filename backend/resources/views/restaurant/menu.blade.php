@extends('layouts.restaurant-sidebar')

@section('title', __('menu'))

@section('content')
<!--begin::Content-->
@if($user->isRestaurantOwner())
<div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
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
                                <a href="{{ route('restaurant.menu',['branchId' => $branchLoop->id]) }}">
                                    <button type="button" class="btn btn-primary">
                                        {{ $branchLoop->name }}
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
<div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Inbox App - Messages -->
            <div class="flex-lg-row-fluid my-2">
                <!--begin::Card-->
                <div class="card">
                    <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                        <div class="d-flex flex-wrap gap-1">
                            <h3 class="text-primary">{{ __('select-a-category') }}</h3>
                        </div>
                    </div>
                </div>
                <!--end::Card-->
            </div>
            <div class="d-flex flex-column flex-lg-row">
                <!--begin::Sidebar-->
                <div class="flex-column flex-lg-row-auto w-100 w-lg-400px mb-10 mb-lg-0">
                    <!--begin::Sticky aside-->
                    <div class="card card-flush mb-0" data-kt-sticky="true" data-kt-sticky-name="inbox-aside-sticky" data-kt-sticky-offset="{default: false, xl: '0px'}" data-kt-sticky-width="{lg: '275px'}" data-kt-sticky-left="auto" data-kt-sticky-animation="false" data-kt-sticky-zindex="95">
                        <!--begin::Aside content-->
                        <div class="card-body">
                            <!--begin::Button-->
                            <p class="text-center text-uppercase w-100 mb-10">
                                <span>{{$branch->name}}</span>
                            </p>

                            <!--end::Button-->
                            <!--begin::Menu-->
                            <div id="categoryList" class="menu menu-column menu-rounded menu-state-bg menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary mb-10">
                                <!--begin::Menu item-->
                                @foreach ($categories as $category)
                                <div class="row">
                                    <!--begin::Inbox-->
                                    @if($user->isRestaurantOwner())
                                    <div class="col-md-2 edit-category">
                                        <button class="btn btn-primary btn-sm mt-2" onclick="EditCategory('{{ $category->getTranslation('name','ar') }}','{{ $category->getTranslation('name','en') }}','{{ $category->id }}')">
                                            <i class="fa fa-edit"></i>
                                        </button>
                                    </div>
                                    @endif
                                    <div class="col-md-8">
                                        <a href="{{ route('restaurant.get-category', ['id' => $category->id, 'branchId' => $branchId]) }}">
                                            <span class="menu-link">
                                                <img src="{{ $category?->photo ?? global_asset('img/category-icon.png') }}" width="50" height="50" class="mx-2" style="border-radius: 50%;" />
                                                <span class="menu-title fw-bolder">{{ $category->name }}</span>
                                            </span>
                                        </a>
                                    </div>
                                    <div class="col-md-2">
                                        <span class="badge badge-light-success mt-5">{{ DB::table('items')->where('category_id', $category->id)->where('branch_id', $branchId)->count() }}</span>
                                    </div>
                                    <!--end::Inbox-->
                                </div>
                                @endforeach

                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item">
                                    <!--begin::Add label-->
                                    <span class="menu-link">
                                        <span class="menu-icon">
                                            <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                                            <span class="svg-icon svg-icon-2 me-3">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                    <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
                                                    <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
                                                </svg>
                                            </span>
                                            <!--end::Svg Icon-->
                                        </span>
                                        <button class="menu-title fw-bold btn btn-sm" id="addCategoryButton">{{ __('add-new-category') }}</button>
                                    </span>
                                    <!--end::Add label-->
                                    <form action="{{ route('restaurant.add-category', ['branchId' => $branchId]) }}" method="POST" id="category-submit" enctype="multipart/form-data">
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
                                                    <input type="file" class="form-control form-control-solid" placeholder="Enter Target Title" name="photo" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn btn-sm btn-khardl mx-1 mt-2" id="saveCategoryBtn">{{ __('save') }}</button>
                                        </div>
                                    </form>
                                    <form method="POST" id="category-edit" enctype="multipart/form-data">
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
                                            </div>
                                        </div>
                                        <div class="d-none justify-content-center" id="update-category-btn">
                                            <button type="submit" class="btn btn-sm btn-khardl mx-1 mt-2" id="saveCategoryBtn">{{ __('Update') }}</button>
                                        </div>
                                    </form>
                                </div>
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
            <!--end::Content-->
        </div>
        <!--end::Inbox App - Messages -->
    </div>
    <!--end::Container-->
</div>
<!--end::Post-->
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
            <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                <!--begin:Form-->
                <form id="kt_modal_new_target_form" class="form" action="#" id="myForm" enctype="multipart/form-data">
                    <!--begin::Heading-->
                    <div class="mb-13 text-center">
                        <!--begin::Title-->
                        <h1 class="mb-3">Create New Items</h1>
                        <!--end::Title-->
                    </div>
                    <!--end::Heading-->
                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="required">Item photo</span>
                            <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference"></i>
                        </label>
                        <!--end::Label-->
                        <input type="file" class="form-control form-control-solid" placeholder="Enter Target Title" name="photo" />
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="row g-9 mb-8">
                        <!--begin::Col-->
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-bold mb-2">price</label>
                            <!--begin::Input-->
                            <div class="position-relative d-flex align-items-center">
                                <!--begin::Datepicker-->
                                <input class="form-control form-control-solid ps-12" />
                                <!--end::Datepicker-->
                            </div>
                            <!--end::Input-->
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-6 fv-row">
                            <label class="required fs-6 fw-bold mb-2">Calories</label>
                            <input class="form-control form-control-solid ps-12" />
                        </div>
                        <!--end::Col-->

                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8">
                        <label class="fs-6 fw-bold mb-2">Description</label>
                        <textarea class="form-control form-control-solid" rows="3" name="description" placeholder="Write Description"></textarea>
                    </div>
                    <!--end::Input group-->


                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <div class="d-flex justify-content-between align-items-center">
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">checkbox choice</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a target priorty"></i>
                            </label>
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <input type="checkbox" name="" id=""> required
                            </label>
                        </div>
                        <!--end::Label-->
                        <div id="inputContainer2">
                            <div class="input-container d-flex justify-content-between align-items-center hover-container my-3">
                                <input type="text" class="form-control form-control-solid mx-3" name="input2[]" placeholder="Title">
                                <input type="text" class="form-control form-control-solid mx-3" name="input[]" placeholder="Maximum choice ">
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-khardl" id="addInput2">+</button>
                    </div>
                    <!--end::Input group-->



                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <div class="d-flex justify-content-between align-items-center">
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">Selection buttons</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a target priorty"></i>
                            </label>
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <input type="checkbox" name="" id=""> required
                            </label>
                        </div>
                        <!--end::Label-->
                        <div id="inputContainer">
                            <div class="input-container d-flex justify-content-between align-items-center hover-container my-3">
                                <input type="text" class="form-control form-control-solid mx-3" name="input[]" placeholder="Title ">
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-khardl" id="addInput">+</button>
                    </div>
                    <!--end::Input group-->




                    <!--begin::Input group-->
                    <div class="d-flex flex-column mb-8 fv-row">
                        <!--begin::Label-->
                        <div class="d-flex justify-content-between align-items-center">
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">Dropdown</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a target priorty"></i>
                            </label>
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <input type="checkbox" name="" id=""> required
                            </label>
                        </div>
                        <!--end::Label-->
                        <div id="inputContainer3">
                            <div class="input-container d-flex justify-content-between align-items-center hover-container my-3">
                                <input type="text" class="form-control form-control-solid mx-3" name="input2[]" placeholder="Name Dropdown">
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-primary" id="addInput3">+</button>
                    </div>
                    <!--end::Input group-->

                    <!--begin::Actions-->
                    <div class="text-center">
                        <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">Cancel</button>
                        <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                            <span class="indicator-label">Submit</span>
                            <span class="indicator-progress">{{ __('Please wait...') }}
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
<!--end::Modal - New Target-->


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

<script>
    const addButton2 = document.getElementById('addInput');
    const inputContainer = document.getElementById('inputContainer');
    let inputCount2 = 0;

    addButton2.addEventListener('click', () => {
        inputCount2++;
        const newInput = document.createElement('div');
        newInput.className = 'input-container d-flex justify-content-between align-items-center hover-container my-3';
        newInput.innerHTML = `
                <input type="text" name="input1[]" class="form-control form-control-solid mx-3" placeholder="name ${inputCount2}">
                <input type="text" name="input2[]" class="form-control form-control-solid" placeholder="price ${inputCount2}">
            `;
        inputContainer.appendChild(newInput);
    });

</script>
<script>
    function EditCategory(category_ar,category_en,category_id){
        console.log(category_ar,category_en);
        const updateBtn = document.getElementById("update-category-btn");
        updateBtn.classList.remove('d-none');
        updateBtn.classList.add('d-flex');
        const categoryForm = document.getElementById("category-edit-form");
        const categoryEnInput = document.getElementById("category_name_en");
        categoryEnInput.value = category_en;
        const categoryArInput = document.getElementById("category_name_ar");
        categoryArInput.value = category_ar;
        categoryForm.style.display = "block";
        var form = document.getElementById('category-edit');
        form.action = `{{ route('restaurant.edit-category', ['categoryId' => ':categoryId']) }}`.replace(':categoryId', category_id);
    }
</script>
<script>
    const addButton = document.getElementById('addInput2');
    const inputContainer2 = document.getElementById('inputContainer2');
    let inputCount = 0;

    addButton.addEventListener('click', () => {
        inputCount++;
        const newInput = document.createElement('div');
        newInput.className = 'input-container d-flex justify-content-between align-items-center hover-container my-3';
        newInput.innerHTML = `
            <input type="text" name="input1[]" class="form-control form-control-solid mx-3" placeholder="name ${inputCount}">
            <input type="text" name="input2[]" class="form-control form-control-solid" placeholder="price ${inputCount}">
        `;
        inputContainer2.appendChild(newInput);
    });

</script>

<script>
    const addButton3 = document.getElementById('addInput3');
    const inputContainer3 = document.getElementById('inputContainer3');
    let inputCount3 = 0;

    addButton3.addEventListener('click', () => {
        inputCount3++;
        const newInput = document.createElement('div');
        newInput.className = 'input-container d-flex justify-content-between align-items-center hover-container my-3';
        newInput.innerHTML = `
            <input type="text" name="input1[]" class="form-control form-control-solid mx-3" placeholder="Option ${inputCount3}">
        `;
        inputContainer3.appendChild(newInput);
    });


    document.getElementById('category-submit').addEventListener('submit', function(e) {
        e.preventDefault();
        var submitButton = document.querySelector('#saveCategoryBtn');
        submitButton.disabled = true;

        var inputValue = document.querySelector('input[name=name_ar]').value.trim();
        if (inputValue === '') {
            alert('Please fill in the input in (Arabic) tab.');
            return;
        }
        var inputValueAR = document.querySelector('input[name=name_en]').value.trim();
        console.log(inputValueAR);
        if (inputValueAR === '') {
            alert('Please fill in the input in the (English) tab .');
            return;
        }
        document.getElementById('category-submit').submit();



    });

</script>
<!--end::Content-->
@endsection
