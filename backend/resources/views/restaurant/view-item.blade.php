@extends('layouts.restaurant-sidebar')

@section('title', $item->name)

@section('content')<div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">
    <!--begin::Post-->
    <div class="post" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container">
            <!--begin::Navbar-->
            <div class="card mb-5 mb-xl-10">
                <div class="card-body pt-9 pb-0">
                    <!--begin::Details-->
                    <div class="d-flex flex-wrap flex-sm-nowrap mb-3">
                        <!--begin: Pic-->
                        <div class="me-7 mb-4">
                            <div class="symbol symbol-100px symbol-lg-160px symbol-fixed position-relative">
                                <img alt="product_image" src="{{ $item->photo }}" />
                            </div>
                        </div>
                        <!--end::Pic-->
                        <!--begin::Info-->
                        <div class="flex-grow-1">
                            <!--begin::Title-->
                            <div class="d-flex justify-content-between align-items-start flex-wrap mb-2">
                                <!--begin::User-->
                                <div class="d-flex flex-column">
                                    <!--begin::Name-->
                                    <div class="d-flex align-items-center mb-2">

                                        <a class="text-gray-900 text-hover-primary fs-2 fw-bolder me-1">{{ $item->name }}
                                        </a>
                                    </div>
                                    <!--end::Name-->
                                </div>
                                <!--end::User-->

                            </div>
                            <!--begin::Info-->
                            <div class="d-flex flex-wrap fw-bold fs-6 mb-4 pe-2">
                                <a href="#" class="d-flex align-items-center text-hover-success me-5 mb-2">
                                    <i class="bi bi-cash mx-2"></i>
                                    {{ $item->price }}
                                    {{ __('SAR') }}
                                </a>
                                <a href="#" class="d-flex align-items-center text-hover-success mb-2">
                                    <!--begin::Svg Icon | path: icons/duotune/communication/com011.svg-->
                                    <i class="bi bi-activity mx-2"></i>
                                    <!--end::Svg Icon-->
                                    {{ $item->calories }}
                                    {{ __('Calories') }}
                                </a>
                            </div>
                            <!--end::Info-->
                            <!--end::Title-->
                        </div>
                        <a href="{{ route('restaurant.get-category',['id' => $item->category->id,'branchId' => $item->branch->id]) }}">
                            <button type="button" class="btn btn-primary btn-sm">
                                <i class="fa fa-arrow-left"></i>
                                {{ __('Back to list') }}
                            </button>
                        </a>
                        <!--end::Info-->
                    </div>
                </div>
                <div class="card-footer">
                    <div class="table-responsive">
                        <table class="table align-middle table-row-dashed fs-6 gy-3" id="kt_table_widget_5_table">
                            <!--begin::Table head-->
                            <thead>
                                <!--begin::Table row-->
                                <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                    <th class="text-start pe-3 min-w-100px">{{ __('Key') }}</th>
                                    <th class="text-start pe-3 min-w-100px">{{ __('Value') }}</th>
                                </tr>
                                <!--end::Table row-->
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody class="fw-bolder text-gray-600">
                                <!--begin::Item-->
                                <tr>
                                    <td>
                                        <span class="text-start">{{__('Name')}}</span>
                                    </td>
                                    <td class="text-dark">
                                        <span class="py-3 px-4 fs-23">{{ $item->name }}</span>
                                    </td>
                                </tr>
                                <!--end::Item-->
                                <tr>
                                    <td>
                                        <span class="text-start">{{__('Description')}}</span>
                                    </td>
                                    <td class="text-dark">
                                        <span class="py-3 px-4 fs-23">{{ $item->description }}</span>
                                    </td>
                                </tr>
                                <!--begin::Item-->
                                <tr>
                                    <td>
                                        <span class="text-start">{{__('Branch')}}</span>
                                    </td>
                                    <td class="text-dark">
                                        <span class="py-3 px-4 fs-23">{{ $item?->branch?->name }}</span>
                                    </td>
                                </tr>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <tr>
                                    <td>
                                        <span class="text-start">{{__('Category')}}</span>
                                    </td>
                                    <td class="text-dark">
                                        <span class="py-3 px-4 fs-23">{{ $item->category?->name }}</span>
                                    </td>
                                </tr>
                                <!--end::Item-->
                                 <!--begin::Item-->
                                 <tr>
                                    <td>
                                        <span class="text-start">{{__('Orders count')}}</span>
                                    </td>
                                    <td class="text-dark">
                                        <span class="py-3 px-4 fs-23">{{ $item?->getTotalOrderedCount() }}</span>
                                    </td>
                                </tr>
                                <!--end::Item-->
                                <!--begin::Item-->
                                <tr>
                                    <td>
                                        <span class="text-start">{{__('Availability')}}</span>
                                    </td>
                                    <td class="text-dark">
                                        @if(!$item->availability)<span class="badge badge-danger mx-1">{{ __('Not available') }}</span>
                                        @else
                                        <span class="badge badge-success mx-1">{{ __('Available') }}</span>
                                        @endif
                                    </td>
                                </tr>
                                @if ($item?->checkbox_input_titles)
                                <tr>
                                    <td>
                                        <span class="text-start">{{__('Checkbox')}}</span>
                                    </td>
                                    <td class="text-dark">
                                        @foreach ($item?->checkbox_input_titles as $key => $option)

                                        @if(isset($option[$key]))
                                            <span>{{ $option[$key] }}</span>
                                            @if(isset($item->checkbox_input_maximum_choices[$key]))
                                                <small class="text-muted">({{ __('Max') }} : <strong>{{ $item->checkbox_input_maximum_choices[$key] }}</strong>)</small>
                                            @endif
                                        @endif
                                        @php
                                        $innerSelection = [];
                                        if(isset($item?->checkbox_input_names[$key])){
                                        $innerSelection = $item?->checkbox_input_names[$key];
                                        }
                                        @endphp
                                        <ul>
                                            @foreach($innerSelection as $innerKey => $innerOption)
                                            @if(isset($innerOption[$key]))
                                            <li>
                                                <span>
                                                    @if(app()->getLocale() == 'ar')
                                                    {{ $innerOption[1] }}
                                                    @else
                                                    {{ $innerOption[0] }}
                                                    @endif
                                                </span>
                                                @if(isset($item?->checkbox_input_prices[$key][$innerKey]))<span class="text-success">({{ $item?->checkbox_input_prices[$key][$innerKey] }} {{ __('SAR') }})</span>@endif
                                            </li>
                                            @endif
                                            @endforeach
                                        </ul>
                                        <br>
                                        @endforeach
                                    </td>
                                </tr>
                                @endif
                                @if ($item?->selection_input_titles)
                                <tr>
                                    <td>
                                        <span class="text-start">{{__('Selection')}}</span>
                                    </td>
                                    <td class="text-dark">
                                        @foreach ($item?->selection_input_titles as $key => $option)
                                        @if(isset($option[$key]))<span>{{ $option[$key] }}</span>@endif
                                        <ul>
                                            @php
                                            $innerSelection = [];
                                            if(isset($item?->selection_input_names[$key])){
                                            $innerSelection = $item?->selection_input_names[$key];
                                            }
                                            @endphp
                                            @foreach($innerSelection as $innerKey => $innerOption)
                                            <li>
                                                <span>
                                                    @if(app()->getLocale() == 'ar')
                                                    {{ $innerOption[1] }}
                                                    @else
                                                    {{ $innerOption[0] }}
                                                    @endif
                                                </span>
                                                @if(isset($item?->selection_input_prices[$key][$innerKey]))<span class="text-success">({{ $item?->selection_input_prices[$key][$innerKey] }} {{ __('SAR') }})</span>@endif
                                            </li>
                                            @endforeach
                                        </ul>
                                        <br>
                                        @endforeach
                                    </td>
                                </tr>
                                @endif
                                @if ($item?->dropdown_input_titles)
                                <tr>
                                    <td>
                                        <span class="text-start">{{__('Dropdown')}}</span>
                                    </td>
                                    <td class="text-dark">
                                        @foreach ($item?->dropdown_input_titles as $key => $option)
                                        @if(isset($option[$key]))<span>{{ $option[$key] }}</span>@endif
                                        <ul>
                                            @php
                                            $innerSelection = [];
                                            if(isset($item?->dropdown_input_names[$key])){
                                            $innerSelection = $item?->dropdown_input_names[$key];
                                            }
                                            @endphp
                                            @foreach($innerSelection as $innerKey => $innerOption)
                                            <li>
                                                <span>
                                                    @if(app()->getLocale() == 'ar')
                                                    {{ $innerOption[1] }}
                                                    @else
                                                    {{ $innerOption[0] }}
                                                    @endif
                                                </span>
                                                @if(isset($item?->dropdown_input_prices[$key][$innerKey]))<span class="text-success">({{ $item?->dropdown_input_prices[$key][$innerKey] }} {{ __('SAR') }})</span>@endif
                                            </li>
                                            @endforeach
                                        </ul>
                                        <br>
                                        @endforeach
                                    </td>
                                </tr>
                                @endif
                                <!--end::Item-->
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                </div>
                <!--end::Container-->
            </div>
            <!--end::Post-->
        </div>
    </div>
</div>
@endsection
