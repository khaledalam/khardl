@extends('layouts.restaurant-sidebar')

@section('title', DB::table('branches')->where('id', $branchId)->value('name'))
@section('subtitle', $selectedCategory->name)

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
                                      <a href="{{route('restaurant.menu', ['branchId' => $branchId])}}">
                                        <p class="btn btn-primary text-uppercase w-100 mb-10">

                                                {{ __('messages.all-categories') }}

                                        </p>
                                    </a>
                                      <!--end::Button-->
                                      <!--begin::Menu-->
                                      <div class="menu menu-column menu-rounded menu-state-bg menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary mb-10">
                                          <!--begin::Menu item-->
                                          @foreach ($categories as $category)
                                            <div class="menu-item mb-3">
                                                <!--begin::Inbox-->
                                                <a href="{{ route('restaurant.get-category', ['id' => $category->id, 'branchId' => $branchId]) }}">
                                                    <span class="menu-link @if ($category->id === $selectedCategory->id) active @endif">
                                                        <img src="{{ $category->photo }}" width="50" height="50" class="mx-2" style="border-radius: 50%;" />
                                                        <span class="menu-title fw-bolder">{{ $category->name }}</span>
                                                        <span class="badge badge-light-success my-2">{{ DB::table('items')->where('category_id', $category->id)->where('branch_id', $branchId)->count() }}</span>
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
                                              <form action="{{ route('restaurant.add-category', ['branchId' => $branchId]) }}" method="POST" id="category-submit" enctype="multipart/form-data">
                                                @csrf
                                                <div id="categoryForm" class="mt-2" style="display: none !important;" >
                                                    <ul class="nav nav-tabs" id="languageTabs">
                                                        <li class="nav-item">
                                                            <a class="nav-link active required" id="en-tab" data-bs-toggle="tab" href="#en">{{__('messages.english')}}</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link required" id="ar-tab" data-bs-toggle="tab" href="#ar">{{__('messages.arabic')}}</a>
                                                        </li>
                                                        <li class="nav-item">
                                                            <a class="nav-link" id="logo-tab" data-bs-toggle="tab" href="#logo">{{__('messages.logo')}}</a>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content mt-3">
                                                        <div class="tab-pane fade show active" id="en">
                                                            <input type="text" class="form-control" placeholder="Enter text in English" name="name_en">
                                                        </div>
                                                        <div class="tab-pane fade" id="ar">
                                                            <input type="text" class="form-control" placeholder="أدخل النص باللغة العربية" name="name_ar">
                                                        </div>
                                                        <div class="tab-pane fade" id="logo">
                                                            <label>{{__('messages.category-logo')}}</label>
                                                            <input type="file" class="form-control form-control-solid" placeholder="Enter Target Title" name="photo" />
                                                        </div>
                                                    </div>
                                                    <div class="d-flex justify-content-center">
                                                        <button type="submit" class="btn btn-sm btn-khardl mx-1 mt-2" id="saveCategoryBtn">{{ __('messages.save') }}</button>
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
                                          <h3 class="text-primary">{{ DB::table('branches')->where('id', $branchId)->value('name') }} | {{ $selectedCategory->name }}</h3>
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
                                                    @if(!$item->availability)<span class="badge badge-danger mx-1">Not available</span>
                                                    @else
                                                    <span class="badge badge-success mx-1">Available</span>
                                                    @endif
                                                 </td>
                                                <td>
                                                     <div class="symbol symbol-35px symbol-circle" data-bs-toggle="tooltip"
                                                    title="{{$item->name}}">
                                                    <img alt="Pic" src="{{$item->photo}}" />
                                                </div>
                                                </td>

                                                 <!--begin::Title-->
                                                 <td  class="text-center">
                                                    <div class="text-dark">
                                                        <!--begin::Heading-->
                                                        <span class="fw-bolder text-start">{{ $item->name }}</span>
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
                <div class="modal-body px-10 px-lg-15 pt-0 pb-15">
                    <div class="engage-toolbar d-flex position-fixed px-5 fw-bolder zindex-2  flex-row-reverse end-0 {{app()->getLocale() == 'ar'?' transform-90':'transform-270'}} mt-20 gap-2">
                        <!--begin::Demos drawer toggle-->
                        <button id="addCheckbox" class="engage-demos-toggle btn btn-flex h-35px bg-body btn-color-gray-700 btn-active-color-gray-900 shadow-sm fs-6 px-4 rounded-top-0" title="Add Checkbox">
                            <span id="create_new_checkbox">+ Checkbox</span>
                        </button>
                        <!--end::Demos drawer toggle-->
                        <!--begin::Help drawer toggle-->
                        <button id="addSelection" class="engage-demos-toggle btn btn-flex h-35px bg-body btn-color-gray-700 btn-active-color-gray-900 shadow-sm fs-6 px-4 rounded-top-0" title="Add Selection">
                            <span id="create_new_selection">+ Selection</span>
                        </button>                        <!--end::Help drawer toggle-->
                        <!--begin::Purchase link-->
                        <button id="addDropdown" class="engage-demos-toggle btn btn-flex h-35px bg-body btn-color-gray-700 btn-active-color-gray-900 shadow-sm fs-6 px-4 rounded-top-0" title="Add Dropdown">
                            <span id="create_new_Dropdown">+ Dropdown</span>
                        </button>
                        <!--end::Purchase link-->
                    </div>


                    <!--begin:Form-->
                    <form id="kt_modal_new_target_form" class="form" action="{{ route('restaurant.add-item', ['id' => $selectedCategory->id, 'branchId' => $branchId]) }}" id="myForm" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!--begin::Heading-->
                        <div class="mb-13 text-center">
                            <!--begin::Title-->
                            <h1 class="mb-3">{{__('messages.create-new-items')}}</h1>
                            <!--end::Title-->
                        </div>
                        <!--end::Heading-->
                        <!--begin::Input group-->
                        <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">{{__('messages.item-photo')}}</span>
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
                                    <span class="required">{{__('messages.item-availability')}}</span>
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
                            <label class="fs-6 fw-bold mb-2">Name</label>

                            <ul class="nav nav-tabs" >
                                <li class="nav-item">
                                    <a class="nav-link active required" id="name-en-tab" data-bs-toggle="tab" href="#name-en">English</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link required" id="name-ar-tab" data-bs-toggle="tab" href="#name-ar">Arabic</a>
                                </li>
                            </ul>
                            <div class="tab-content mt-3">
                                <div class="tab-pane fade show active" id="name-en">
                                    <input type="text" class="form-control form-control-solid"  rows="3" placeholder="Enter name in English"   name="item_name_en" />
                                </div>
                                <div class="tab-pane fade" id="name-ar">
                                    <input type="text" class="form-control form-control-solid"  rows="3" placeholder="أدخل الاسم باللغة العربية"   name="item_name_ar" />
                                </div>
                            </div>
                        </div>
                        <div class="d-flex flex-column mb-8">
                            <label class="fs-6 fw-bold mb-2">Description</label>

                            <ul class="nav nav-tabs" >
                                <li class="nav-item">
                                    <a class="nav-link active" id="d-en-tab" data-bs-toggle="tab" href="#d-en">English</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="d-ar-tab" data-bs-toggle="tab" href="#d-ar">Arabic</a>
                                </li>
                            </ul>
                            <div class="tab-content mt-3">
                                <div class="tab-pane fade show active" id="d-en">
                                    <textarea type="text" class="form-control form-control-solid"  rows="3" placeholder="Enter Description in English"   name="description_en"></textarea>
                                </div>
                                <div class="tab-pane fade" id="d-ar">
                                    <textarea type="text" class="form-control form-control-solid"  rows="3" placeholder="أدخل الوصف باللغة العربية"   name="description_ar"></textarea>
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
                            <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">{{__('messages.clear')}}</button>
                            <button type="submit" id="kt_modal_new_target_submit" class="btn btn-primary">
                                <span class="indicator-label">{{__('messages.submit')}}</span>
                                <span class="indicator-progress" id="waiting-item">Please wait...
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

    <!--begin::Modal - New Target-->
    {{-- <div class="modal fade" id="kt_modal_new_target" tabindex="-1" aria-hidden="true">
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
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">


                    <!-- Toolbar -->
                    <div class="engage-toolbar d-flex position-fixed px-5 fw-bolder zindex-2 top-50 end-0 transform-90 mt-20 gap-2">
                        <!--begin::Demos drawer toggle-->
                        <button id="addCheckbox" class="engage-demos-toggle btn btn-flex h-35px bg-body btn-color-gray-700 btn-active-color-gray-900 shadow-sm fs-6 px-4 rounded-top-0" title="Add Checkbox">
                            <span id="create_new_checkbox">+ Checkbox</span>
                        </button>
                        <!--end::Demos drawer toggle-->
                        <!--begin::Help drawer toggle-->
                        <button id="addSelection" class="engage-demos-toggle btn btn-flex h-35px bg-body btn-color-gray-700 btn-active-color-gray-900 shadow-sm fs-6 px-4 rounded-top-0" title="Add Selection">
                            <span id="create_new_selection">+ Selection</span>
                        </button>                        <!--end::Help drawer toggle-->
                        <!--begin::Purchase link-->
                        <button id="addDropdown" class="engage-demos-toggle btn btn-flex h-35px bg-body btn-color-gray-700 btn-active-color-gray-900 shadow-sm fs-6 px-4 rounded-top-0" title="Add Dropdown">
                            <span id="create_new_Dropdown">+ Dropdown</span>
                        </button>
                        <!--end::Purchase link-->
                    </div>




                    <!--begin:Form-->
                    <form id="kt_modal_new_target_form" class="form" action="#" id="myForm">
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
                            <input type="file" class="form-control form-control-solid" multiple placeholder="Enter Target Title" name="photo[]" />
                        </div>
                        <!--end::Input group-->

                         <!--begin::Input group-->
                         <div class="d-flex flex-column mb-8 fv-row">
                            <!--begin::Label-->
                            <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                                <span class="required">Item Title</span>
                                <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip" title="Specify a target name for future usage and reference"></i>
                            </label>
                            <!--end::Label-->
                            <input type="text" class="form-control form-control-solid" name="input2[]" placeholder="Title">
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
                            <button type="reset" id="kt_modal_new_target_cancel" class="btn btn-light me-3">Cancel</button>
                            <button type="submit" id="kt_modal_new_target_submit" class="btn btn-khardl">
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
    </div> --}}
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
        var modal = document.getElementById('kt_modal_new_target');
        modal.addEventListener('hidden.bs.modal', function () {
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


    <!-- Checkbox -->
    <script>
        const checkboxesContainer = document.getElementById('checkboxes');
        const addCheckboxButton = document.getElementById('addCheckbox');

        let checkboxCount = -1;

        function createCheckbox() {
            checkboxCount++;
            const checkboxDiv = document.createElement('div');
            checkboxDiv.className = 'd-flex flex-column mb-8 fv-row';
            checkboxDiv.innerHTML = `
                <div class="d-flex flex-column fv-row">
                    <!--begin::Label-->
                    <div class="d-flex justify-content-between align-items-center">
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="">Checkbox buttons </span>
                        </label>
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <input type="hidden" name="checkbox_required[${checkboxCount}]" value="false" />
                            <input type="checkbox" name="checkbox_required_input[${checkboxCount}]" id="" > required
                        </label>
                    </div>
                    <!--end::Label-->

                    <div id="inputContainer${checkboxCount}">
                        <div class="input-container d-flex justify-content-between align-items-center hover-container my-3">
                            <input type="text" required class="form-control form-control-solid mx-3 w-75" name="checkboxInputTitleEn[]" placeholder="Title in english ">
                            <input type="text" required class="form-control form-control-solid mx-3 w-75" name="checkboxInputTitleAr[]" placeholder="العنوان بالعربية">

                            <input type="number" required class="form-control form-control-solid mx-3 w-25" name="checkboxInputMaximumChoice[]" placeholder="max ">
                            <button class="delete-checkbox btn btn-sm btn-white"><i class="fas fa-trash text-danger"></i></button>
                        </div>
                    </div>
                    <div id="inputContainer${checkboxCount}">
                        <!-- Existing ShakePass11 elements will be dynamically added here -->
                    </div>
                    <div class="options" id="${checkboxCount}">
                        <a class="btn btn-sm btn-khardl add-option w-100">+ Add Option</a>
                    </div>
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
            createCheckBoxOption(checkboxDiv,true);
        }

        function createCheckBoxOption(checkboxDiv,isDeletable = false) {
            const optionsDiv = checkboxDiv.querySelector('.options');
            const optionCount = optionsDiv.id;
            const optionDiv = document.createElement('div');
            optionDiv.className = 'option';
            if(isDeletable){
                optionDiv.innerHTML = `
                <div class="d-flex justify-content-between mt-4">
                    <input type="text"  required name="checkboxInputNameEn[${optionCount}][]" class="form-control form-control-solid mx-3 w-50" placeholder="Name in english ">
                    <input type="text"  required name="checkboxInputNameAr[${optionCount}][]" class="form-control form-control-solid mx-3 w-50" placeholder="الاسم بالعربية ">

                    <input type="number"  required name="checkboxInputPrice[${optionCount}][]" class="form-control form-control-solid mx-3 w-50" placeholder="price">
                    <button class="invisible btn btn-sm btn-white"><i class="fas fa-trash text-danger"></i></button>
                </div>
            `;
            }else {
                optionDiv.innerHTML = `
                <div class="d-flex justify-content-between mt-4">
                    <input type="text"  required name="checkboxInputNameEn[${optionCount}][]" class="form-control form-control-solid mx-3 w-50"  placeholder="Name in english ">
                    <input type="text"  required name="checkboxInputNameAr[${optionCount}][]" class="form-control form-control-solid mx-3 w-50" placeholder="الاسم بالعربية ">

                    <input type="number"  required name="checkboxInputPrice[${optionCount}][]" class="form-control form-control-solid mx-3 w-50" placeholder="price">
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

        function createSelection() {
            selectionCount++;
            const selectionDiv = document.createElement('div');
            selectionDiv.className = 'd-flex flex-column mb-8 fv-row';
            selectionDiv.innerHTML = `
                <div class="d-flex flex-column fv-row">
                    <!--begin::Label-->
                    <div class="d-flex justify-content-between align-items-center">
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="">Selection buttons </span>
                        </label>
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">

                            <input type="hidden" name="selection_required[${selectionCount}]" value="false" />
                            <input type="checkbox" name="selection_required_input[${selectionCount}]" id="" > required
                        </label>
                    </div>
                    <!--end::Label-->

                    <div id="inputContainer${selectionCount}">
                        <div class="input-container d-flex justify-content-between align-items-center hover-container my-3">
                            <input type="text"  required class="form-control form-control-solid mx-3 w-100" name="selectionInputTitleEn[]" placeholder="Title in english ">
                            <input type="text"  required class="form-control form-control-solid mx-3 w-100" name="selectionInputTitleAr[]"  placeholder="العنوان بالعربية">

                            <button class="delete-selection btn btn-sm btn-white"><i class="fas fa-trash text-danger"></i></button>
                        </div>
                    </div>
                    <div id="inputContainer${selectionCount}">
                        <!-- Existing ShakePass11 elements will be dynamically added here -->
                    </div>
                    <div class="options" id="${selectionCount}">
                        <a class="btn btn-sm btn-khardl add-option w-100">+ Add Option</a>
                    </div>
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
            createSelectionOption(selectionDiv, selectionCount,true);
        }

        function createSelectionOption(selectionDiv, selectionCount,isDeletable = false) {
            const optionsDiv = selectionDiv.querySelector('.options');
            const optionCount = optionsDiv.id;
            const optionDiv = document.createElement('div');
            optionDiv.className = 'option';
            if(isDeletable){
            optionDiv.innerHTML = `
                <div class="d-flex justify-content-between align-items-center mt-5">
                    <input type="text" required  name="selectionInputNameEn[${optionCount}][]" class="form-control form-control-solid mx-3 w-50"  placeholder="Name in english ">
                    <input type="text" required  name="selectionInputNameAr[${optionCount}][]" class="form-control form-control-solid mx-3 w-50"  placeholder="الاسم بالعربية ">

                    <input type="number"  required name="selectionInputPrice[${optionCount}][]" class="form-control form-control-solid mx-3 w-50"  placeholder="price">
                    <button class="invisible btn btn-sm btn-white"><i class="fas fa-trash"></i></button>
                </div>
            `;  }
            else {
                optionDiv.innerHTML = `
                <div class="d-flex justify-content-between align-items-center mt-5">
                    <input type="text" required  name="selectionInputNameEn[${optionCount}][]" class="form-control form-control-solid mx-3 w-50"  placeholder="Name in english ">
                    <input type="text" required  name="selectionInputNameAr[${optionCount}][]" class="form-control form-control-solid mx-3 w-50"  placeholder="الاسم بالعربية ">

                    <input type="number"  required name="selectionInputPrice[${optionCount}][]" class="form-control form-control-solid mx-3 w-50"  placeholder="price">
                    <button class="delete-option btn btn-sm btn-white"><i class="fas fa-trash"></i></button>
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

        function createDropdown() {
            dropdownCount++;
            const dropdownDiv = document.createElement('div');
            dropdownDiv.className = 'd-flex flex-column mb-8 fv-row';
            dropdownDiv.innerHTML = `
                <div class="d-flex flex-column fv-row">
                    <!--begin::Label-->
                    <div class="d-flex justify-content-between align-items-center">
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">
                            <span class="">Dropdown buttons </span>
                        </label>
                        <label class="d-flex align-items-center fs-6 fw-bold mb-2">

                            <input type="hidden" name="dropdown_required[${dropdownCount}]" value="false" />
                            <input type="checkbox" name="dropdown_required_input[${dropdownCount}]" id="" > required
                        </label>
                    </div>
                    <!--end::Label-->

                    <div id="inputContainer${dropdownCount}">
                        <div class="input-container d-flex justify-content-between align-items-center hover-container my-3">
                            <input type="text" required class="form-control form-control-solid mx-3 w-100" name="dropdownInputTitleEn[]" placeholder="Title in english ">
                            <input type="text" required class="form-control form-control-solid mx-3 w-100" name="dropdownInputTitleAr[]"  placeholder="العنوان بالعربية">

                            <button class="delete-dropdown btn btn-sm btn-white"><i class="fas fa-trash text-danger"></i></button>
                        </div>
                    </div>
                    <div id="inputContainer${dropdownCount}">
                        <!-- Existing ShakePass11 elements will be dynamically added here -->
                    </div>
                    <div class="options" id="${dropdownCount}">
                        <a class="btn btn-sm btn-khardl add-option w-100">+ Add Option</a>
                    </div>
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
            createDropdownOption(dropdownDiv,true);
        }

        function createDropdownOption(dropdownDiv,isDeletable = false) {
            const optionsDiv = dropdownDiv.querySelector('.options');
            const optionCount = optionsDiv.id;
            const optionDiv = document.createElement('div');
            optionDiv.className = 'option';
            if(isDeletable){
            optionDiv.innerHTML = `
                    <div class="d-flex justify-content-between align-items-center mt-5">
                        <input type="text"  required name="dropdownInputNameEn[${optionCount}][]" class="form-control form-control-solid mx-3 w-50" placeholder="Name in english ">
                        <input type="text"  required name="dropdownInputNameAr[${optionCount}][]" class="form-control form-control-solid mx-3 w-50"  placeholder="الاسم بالعربية ">


                        <button class="invisible btn btn-sm btn-white"><i class="fas fa-trash"></i></button>
                    </div>
            `; }else {
                optionDiv.innerHTML = `
                    <div class="d-flex justify-content-between align-items-center mt-5">
                        <input type="text"  required name="dropdownInputNameEn[${optionCount}][]" class="form-control form-control-solid mx-3 w-50"  placeholder="Name in english ">
                        <input type="text"  required name="dropdownInputNameAr[${optionCount}][]" class="form-control form-control-solid mx-3 w-50"   placeholder="الاسم بالعربية ">


                        <button class="delete-option btn btn-sm btn-white"><i class="fas fa-trash"></i></button>
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

        document.getElementById('category-submit').addEventListener('submit', function (e) {
            e.preventDefault();
            var submitButton = document.querySelector('#saveCategoryBtn');
            submitButton.disabled = true;

            var inputValue = document.querySelector('input[name=name_ar]').value.trim();
            if (inputValue === '') {
                alert('Please fill in the input in (Arabic) tab.');
                return ;
            }
            var inputValueAR = document.querySelector('input[name=name_en]').value.trim();
            console.log(inputValueAR);
            if (inputValueAR === '') {
                alert('Please fill in the input in the (English) tab.');
                return ;
            }

            document.getElementById('category-submit').submit();
        });

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



            if(inputValueAR === '' && inputValue != ''){
                alert(`Please fill name description in (Arabic) tab.`);
                submitButton.disabled = false;

                return ;
            }else if(inputValue === '' && inputValueAR != ''){
                alert(`Please fill name description in (English) tab.`);
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
    </style>
      <!--end::Content-->
@endsection
