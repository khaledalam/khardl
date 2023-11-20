@extends('layouts.restaurant-sidebar')

@section('title', DB::table('branches')->where('id', $branchId)->value('name'))
@section('subtitle', $selectedCategory->category_name)

@section('content')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">

        <!--begin::Post-->
              <div class="post d-flex flex-column-fluid" id="kt_post">
                  <!--begin::Container-->
                  <div id="kt_content_container" class="container-xxl">
                      <!--begin::Inbox App - Messages -->
                      <div class="d-flex flex-column flex-lg-row">
                          <!--begin::Sidebar-->
                          <div class="flex-column flex-lg-row-auto w-100 w-lg-275px mb-10 mb-lg-0">
                              <!--begin::Sticky aside-->
                              <div class="card card-flush mb-0" data-kt-sticky="true" data-kt-sticky-name="inbox-aside-sticky" data-kt-sticky-offset="{default: false, xl: '0px'}" data-kt-sticky-width="{lg: '275px'}" data-kt-sticky-left="auto" data-kt-sticky-animation="false" data-kt-sticky-zindex="95">
                                  <!--begin::Aside content-->
                                  <div class="card-body">
                                      <!--begin::Button-->
                                      <p class="btn btn-primary text-uppercase w-100 mb-10">
                                          <a href="{{route('restaurant.menu', ['branchId' => $branchId])}}">
                                            {{ __('messages.all-categories') }}
                                          </a>
                                      </p>
                                      <!--end::Button-->
                                      <!--begin::Menu-->
                                      <div class="menu menu-column menu-rounded menu-state-bg menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary mb-10">
                                          <!--begin::Menu item-->
                                          @foreach ($categories as $category)
                                            <div class="menu-item mb-3">
                                                <!--begin::Inbox-->
                                                <a href="{{ route('restaurant.get-category', ['id' => $category->id, 'branchId' => $branchId]) }}">
                                                    <span class="menu-link @if ($category->id === $selectedCategory->id) active @endif">
                                                        <span class="menu-title fw-bolder">{{ $category->category_name }}</span>
                                                        <span class="badge badge-light-success my-2">{{ DB::table('items')->where('category_id', $category->id)->where('branch_id', $branchId)->count() }}</span>
                                                        {{-- <span class="badge badge-light-success">3</span> --}}
                                                        {{-- <form class="delete-form" action="{{ route('restaurant.delete-category', ['id' => $selectedCategory->id]) }}" method="POST">
                                                            @method('DELETE')
                                                            @csrf
                                                            <button type="submit" class="delete-button btn btn-icon btn-active-color-danger btn-sm">
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
                                                        </form>          --}}
                                                    </span>
                                                </a>
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
                                                  <button class="menu-title fw-bold btn btn-sm" id="addCategoryButton">{{ __('messages.add-new-category') }}</button>
                                              </span>
                                              <!--end::Add label-->
                                              <form action="{{ route('restaurant.add-category', ['branchId' => $branchId]) }}" method="POST">
                                                @csrf
                                                <div id="categoryForm" style="display: none !important;" class="d-flex justify-content-between align-items-center">
                                                    <input type="text" name="category_name" class="form-control form-control-solid" placeholder="Category Name"  id="categoryInput" placeholder="Enter category">
                                                    <button type="submit" class="btn btn-sm btn-primary mx-1" id="saveCategoryBtn">{{ __('messages.save') }}</button>
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
                                          <h3 class="text-primary">{{ DB::table('branches')->where('id', $branchId)->value('name') }} | {{ $selectedCategory->category_name }}</h3>
                                      </div>
                                      <!--end::Actions-->
                                      <!--begin::Pagination-->
                                      <div class="d-flex align-items-center flex-wrap gap-2">
                                          <a href="#" class="btn btn-sm btn-outline-secondary text-dark" data-bs-toggle="modal" data-bs-target="#kt_modal_new_target">{{ __('messages.add-new-item') }}
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
                                      </div>
                                      <!--end::Pagination-->
                                  </div>
                                  <div class="card-body p-0">
                                      <!--begin::Table-->
                                      <table class="table table-hover table-row-dashed fs-6 gy-5 my-0" id="kt_inbox_listing">
                                          <!--begin::Table body-->
                                          <tbody>
                                            @foreach ($items as $item)
                                              <tr>
                                                <td>
                                                        @if(!$item->availability)<span class="badge badge-danger mx-1">Not available</span>@endif
                                                </td>
                                                  <!--begin::Author-->
                                                  <td class="text-center">
                                                      <span class="text-gray fw-bold fs-17">123-2023</span>
                                                  </td>
                                                  <!--end::Author-->
                                                  <!--begin::Title-->
                                                  <td  class="text-center">
                                                      <div class="text-dark">
                                                          <!--begin::Heading-->
                                                          <span class="fw-bolder text-start">{{ $item->description }}</span>
                                                          <!--end::Heading-->
                                                      </div>
                                                  </td>
                                                  <!--end::Title-->
                                                  <!--begin::Date-->
                                                  <td class="text-center">
                                                    <a href="#" class="btn btn-sm btn-light btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">Actions
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
                                                            <a href="https://youtube.com" class="menu-link px-3">{{ __('messages.view') }}</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->
                                                        <div class="menu-item px-3">
                                                            <a href="https://google.com" class="menu-link px-3">{{ __('messages.edit') }}</a>
                                                        </div>
                                                        <!--end::Menu item-->
                                                        <!--begin::Menu item-->

                                                        <div class="menu-item px-3">
                                                            <form class="delete-form" action="{{ route('restaurant.delete-item', ['id' => $item->id]) }}" method="POST">
                                                                @method('DELETE')
                                                                @csrf
                                                                <a href="#" class="menu-link px-3 delete-button">{{ __('messages.delete') }}</a>
                                                            </form>
                                                        </div>
                                                        <!--end::Menu item-->
                                                    </div>
                                                    <!--end::Menu-->
                                                </td>
                                                  <!--end::Date-->
                                              </tr>
                                            @endforeach

                                              <tr>
                                                  <td colspan="6" class="text-center">
                                                      <a href="#" class="btn btn-sm btn-outline-secondary text-dark" data-bs-toggle="modal" data-bs-target="#kt_modal_new_target"> {{ __('messages.add-new-item') }} <!--begin::Svg Icon | path: icons/duotune/arrows/arr087.svg-->
                                                          <span class="svg-icon svg-icon-2 me-3">
                                                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                                  <rect opacity="0.5" x="11" y="18" width="12" height="2" rx="1" transform="rotate(-90 11 18)" fill="currentColor" />
                                                                  <rect x="6" y="11" width="12" height="2" rx="1" fill="currentColor" />
                                                              </svg>
                                                          </span>
                                                          <!--end::Svg Icon--> </a>
                                                  </td>
                                              </tr>

                                          </tbody>
                                          <!--end::Table body-->
                                      </table>
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
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                    <!--begin:Form-->
                    <form id="kt_modal_new_target_form" class="form" action="{{ route('restaurant.add-item', ['id' => $selectedCategory->id, 'branchId' => $branchId]) }}" id="myForm" method="POST" enctype="multipart/form-data">
                        @csrf
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
                            <input type="file" class="form-control form-control-solid" required placeholder="Enter Target Title" name="photo" />
                        </div>
                        <!--end::Input group-->

                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <div class="d-flex justify-content-between align-items-center">
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <span class="required">Item availability</span>
                                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify availability for an item"></i>
                                </label>
                                <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                    <input type="checkbox" name="availability" checked value="1"> 
                                </label>
                            </div>
                     
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
                                    <input type="number" required name="price" class="form-control form-control-solid ps-12" />
                                    <!--end::Datepicker-->
                                </div>
                                <!--end::Input-->
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-6 fv-row">
                                <label class="required fs-6 fw-bold mb-2">Calories</label>
                                <input type="number" required name="calories" class="form-control form-control-solid ps-12" />
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
                                    <input type="checkbox" name="checkbox_required" id=""> required
                                </label>
                            </div>
                            <!--end::Label-->
                            <div id="inputContainer2">
                                <div class="input-container d-flex justify-content-between align-items-center hover-container my-3">
                                    <input oninput="restrictCharacter(this, '|')" required type="text" class="form-control form-control-solid mx-3" name="checkboxInputTitle[]" placeholder="Title">
                                    <input oninput="restrictCharacter(this, '|')" required type="text" class="form-control form-control-solid mx-3" name="checkboxInputMaximumChoice[]" placeholder="Maximum choice">
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-primary" id="addInput2">+</button>
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
                                    <input type="checkbox" name="selection_required" id=""> required
                                </label>
                            </div>
                            <!--end::Label-->
                            <div id="inputContainer">
                                <div class="input-container d-flex justify-content-between align-items-center hover-container my-3">
                                    <input oninput="restrictCharacter(this, '|')" required type="text" class="form-control form-control-solid mx-3" name="selectionInputTitle[]" placeholder="Title ">
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-primary" id="addInput">+</button>
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
                                    <input type="checkbox" name="dropdown_required" id=""> required
                                </label>
                            </div>
                            <!--end::Label-->
                            <div id="inputContainer3">
                                <div class="input-container d-flex justify-content-between align-items-center hover-container my-3">
                                    <input oninput="restrictCharacter(this, '|')" required type="text" class="form-control form-control-solid mx-3" name="dropdownInputName[]" placeholder="Name Dropdown">
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-primary" id="addInput3">+</button>
                        </div>
                        <!--end::Input group-->

                        <!--begin::Actions-->
                        <div class="text-center">
                            <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">Reset</button>
                            <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                                <span class="indicator-label">Submit</span>
                                <span class="indicator-progress">Please wait...
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
                <rect opacity="0.5" x="13" y="6" width="13" height="2" rx="1" transform="rotate(90 13 6)"
                    fill="currentColor" />
                <path
                    d="M12.5657 8.56569L16.75 12.75C17.1642 13.1642 17.8358 13.1642 18.25 12.75C18.6642 12.3358 18.6642 11.6642 18.25 11.25L12.7071 5.70711C12.3166 5.31658 11.6834 5.31658 11.2929 5.70711L5.75 11.25C5.33579 11.6642 5.33579 12.3358 5.75 12.75C6.16421 13.1642 6.83579 13.1642 7.25 12.75L11.4343 8.56569C11.7467 8.25327 12.2533 8.25327 12.5657 8.56569Z"
                    fill="currentColor" />
            </svg>
        </span>
        <!--end::Svg Icon-->
    </div>
    <!--end::Scrolltop-->

    <!--begin::Javascript-->
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

    <script>
        var hostUrl = "assets/";
      // script.js
        const addCategoryButton = document.getElementById("addCategoryButton");
        const categoryForm = document.getElementById("categoryForm");
        const categoryInputForm = document.getElementById("categoryInputForm");
        const categoryNameInput = document.getElementById("categoryName");
        const categoryList = document.getElementById("categoryList");

        addCategoryButton.addEventListener("click", () => {
            categoryForm.style.display = "block";
            categoryNameInput.focus();
        });

        categoryInputForm.addEventListener("submit", (e) => {
            e.preventDefault();

            const categoryName = categoryNameInput.value;
            if (categoryName.trim() !== "") {
                const listItem = document.createElement("li");
                listItem.textContent = categoryName;
                categoryList.appendChild(listItem);

                categoryNameInput.value = "";
                categoryForm.style.display = "none";
            }
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
                <input type="text" oninput="restrictCharacter(this, '|')" name="selectionInputName[]" required class="form-control form-control-solid mx-3" placeholder="name ${inputCount2}">
                <input type="text" oninput="restrictCharacter(this, '|')" name="selectionInputPrice[]" required class="form-control form-control-solid" placeholder="price ${inputCount2}">
            `;
            inputContainer.appendChild(newInput);
        });

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
                <input type="text" oninput="restrictCharacter(this, '|')" name="checkboxInputName[]" required class="form-control form-control-solid mx-3" placeholder="name ${inputCount}">
                <input type="text" oninput="restrictCharacter(this, '|')" name="checkboxInputPrice[]" required class="form-control form-control-solid" placeholder="price ${inputCount}">
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
            <input type="text" oninput="restrictCharacter(this, '|')" name="dropdownInputName[]" required class="form-control form-control-solid mx-3" placeholder="Option ${inputCount3}">
        `;
        inputContainer3.appendChild(newInput);
    });

</script>

<script>
    function restrictCharacter(input, character) {
        const value = input.value;
        if (value.includes(character)) {
            input.value = value.replace(character, '');
        }
    }
    </script>
      <!--end::Content-->
@endsection
