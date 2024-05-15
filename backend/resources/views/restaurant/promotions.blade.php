@extends('layouts.restaurant-sidebar')

@section('title', __('promotions'))

@section('content')


<!--begin::Body-->

    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column mb-10">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">

            <!--begin::Wrapper-->
            <div class="d-flex flex-column flex-row-fluid" id="kt_wrapper">


                <!--begin::Content-->
                <div class=" d-flex flex-column flex-column-fluid pt-0" id="kt_content">
                    <!--begin::Post-->
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <!--begin::Container-->
                        <div id="kt_content_container" class="container-xxl">
                            <!--begin::Row-->
                            <div class="row g-12 g-xl-12 mb-xl-112">

                                <div class="col-md-12 col-lg-12 mb-md-4 mb-xl-0">
                                    <!--begin::Card widget 4-->
                                    <div class="card card-flush h-md-100 mb-5 mb-xl-0">
                                        <!--begin::Form-->
                                        <form id="kt_ecommerce_add_product_form" class="form d-flex flex-column flex-lg-row" action="{{ route('promotions.save-settings') }}" method="POST">
                                            @csrf
                                            <!--begin::main column-->
                                            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                                                <!--begin::tab content-->
                                                <div class="tab-content">
                                                    <!--begin::tab pane-->
                                                    <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                                                        <div class="d-flex flex-column gap-7 gap-lg-10">
                                                            <!--begin::general options-->
                                                            <div class="card card-flush py-4">
                                                                <!--begin::card header-->
                                                                <div class="card-header">
                                                                    <div class="card-title">
                                                                        <h2>{{ __('Loyalty points') }}</h2>
                                                                    </div>
                                                                </div>
                                                                <!--end::card header-->
                                                                <!--begin::card body-->
                                                                <div class="card-body pt-0">
                                                                    <!--begin::input group-->
                                                                    <div class="fv-row">
                                                                        <!--begin::label-->
                                                                        <label class="required form-label">{{ __('How many loyalty points customer get per spend each 1 SAR?') }}</label>
                                                                        <!--end::label-->
                                                                        <!--begin::input-->
                                                                        <input type="number" min="0" step="0.01" name="loyalty_points" class="form-control mb-2" placeholder="{{ __('e.g 0.02') }}" value="{{$settings['loyalty_points']}}" />
                                                                        <!--end::input-->

                                                                    </div>
                                                                    <!--begin::input group-->


                                                                </div>
                                                                <!--end::card header-->
                                                            </div>
                                                            <!--end::general options-->
                                                        </div>
                                                    </div>
                                                    <!--end::tab pane-->
                                                </div>

                                            </div>
                                            <!--end::main column-->


                                            <!--begin::Main column-->

                                            <button type="submit" class="btn btn-sm fw-bolder btn-khardl px-4">{{__('save')}}</button>
                                        </form>
                                        <!--end::Form-->
                                    </div>
                                    <!--end::Card widget 4-->
                                </div>

                            </div>
                            <!--end::Modals-->
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

<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Inbox App - Messages -->
            <div class="d-flex flex-column flex-lg-row">
                <!--begin::Sidebar-->
                <div class="flex-column flex-lg-row-fluid w-lg-275px ">
                    <!--begin::Sticky aside-->
                    <div class="card card-flush mb-0 overflow-scroll py-2" data-kt-sticky-offset="{default: false, xl: '0px'}" data-kt-sticky-width="{lg: '275px'}" data-kt-sticky-left="auto" data-kt-sticky-animation="false" data-kt-sticky-zindex="95">
                        <!--begin::Aside content-->
                        <div class="card-body">
                            <!--begin::Button-->
                            {{-- <a href="{{route('restaurant.menu', ['branchId' => $branchId])}}">--}}
                            {{-- <p class="btn btn-khardl text-uppercase w-100 mb-10">--}}
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
                                <h3 class="text-active-khardl">{{ DB::table('branches')->where('id', $branchId)?->value('name') }} @if($selectedCategory) | {{ $selectedCategory->name }} @endif</h3>
                            </div>
                            <!--end::Actions-->
                            <!--begin::Pagination-->
                           
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

    @endsection
