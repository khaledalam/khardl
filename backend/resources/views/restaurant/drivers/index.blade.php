@extends('layouts.restaurant-sidebar')

@section('title', __('drivers'))

@section('content')

<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <!--begin::Tables Widget 9-->
            <div class="card mb-5 mb-xl-8">
                <!--begin::Header-->
                <form action="">
                    <div class="card-title border-0 pt-5 d-flex align-items-center position-relative my-1">
                        <h3 class="card-title align-items-start flex-column mx-2">
                            <span class="card-label fw-bolder fs-3 mb-1">{{ __('drivers') }}
                        </h3>
                        <input type="text" value="{{ request('search') }}" placeholder="{{ __('By name, email, phone') }}" name="search" class="form-control  w-200px" />
                        <div class="form-group mx-2">
                            <select name="status" id="status" class="form-select w-200px">
                                <option value="">{{ __('Status') }}</option>
                                <option value="active" {{ request('status') == 'active' ? 'selected' : ''  }}>{{ __('active') }}</option>
                                <option value="inactive" {{ request('status') == 'inactive' ? 'selected' : ''  }}>{{ __('inactive') }}</option>
                                <option value="suspended" {{ request('status') == 'suspended' ? 'selected' : ''  }}>{{ __('suspended') }}</option>
                            </select>
                        </div>
                        @if (!$user->isWorker())
                            <div class="form-group mx-2">
                                <select name="branch_id" id="branch" class="form-select w-200px">
                                    <option value="">{{ __('Branch') }}</option>
                                    @foreach ($branches as $branch)
                                    <option value="{{ $branch->id }}"
                                        @if (request('branch_id') == $branch->id)
                                        {{ 'selected' }}
                                        @endif>{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        @endif

                        <button type="submit" class="btn btn-secondary"> {{ __('Filter') }}</button>
                        <div class="card-toolbar mx-2" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-trigger="hover" title="{{ __('Add') }}">
                            <a href="{{ route('drivers.create') }}" class="btn btn-sm btn-khardl">
                                <!--begin::Svg Icon | path: icons/duotune/arrows/arr075.svg-->
                                <span class="svg-icon svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <rect opacity="0.5" x="11.364" y="20.364" width="16" height="2" rx="1" transform="rotate(-90 11.364 20.364)" fill="currentColor" />
                                        <rect x="4.36396" y="11.364" width="16" height="2" rx="1" fill="currentColor" />
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->{{ __('new-driver') }}</a>
                        </div>
                    </div>
                </form>

                <!--end::Header-->
                <!--begin::Body-->
                <div class="card-body py-3">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                            <!--begin::Table head-->
                            <thead>
                                <tr class="fw-bolder text-muted">
                                    <th class="min-w-25px">#</th>
                                    <th class="min-w-200px">{{ __('Name') }}</th>
                                    <th class="min-w-200px">{{ __('Image') }}</th>
                                    <th class="min-w-150px">{{ __('Branch') }}</th>
                                    <th class="min-w-150px">{{ __('Status') }}</th>
                                    <th class="min-w-150px">{{ __('Delivered orders') }}</th>
                                    <th class="min-w-150px">{{ __('This month') }}</th>
                                    <th class="min-w-150px">{{ __('phone-number') }}</th>
                                    <th class="min-w-150px">{{ __('email') }}</th>
                                    <th class="min-w-150px">{{ __('Vehicle No.') }}</th>
                                    <th class="min-w-150px">{{ __('Created at') }}</th>
                                    <th class="min-w-150px text-end">{{ __('actions') }}</th>
                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                                @foreach ($drivers as $driver)
                                <tr>
                                    <td class="text-muted fw-bolder">
                                        {{ $driver->id }}
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="d-flex justify-content-start flex-column">
                                                <a class="text-dark fw-bolder text-hover-khardl fs-6">{{ $driver->full_name }}</a>
                                            </div>
                                        </div>
                                    </td>
                                    <td>

                                        @if ($driver->image)
                                        <div class="symbol symbol-60px symbol-lg-60px symbol-fixed position-relative">
                                            <img alt="driver image" src="{{ $driver->image }}" />
                                        </div>
                                        @else
                                        <div class="symbol symbol-60px symbol-lg-60px symbol-fixed position-relative">
                                            <img alt="driver image" src="{{ global_asset('images/driver_logo.jpg') }}" />
                                        </div>
                                        @endif
                                    </td>
                                    <td>
                                        <span>
                                            {{ $driver->branch?->name }}
                                        </span>
                                    </td>
                                    <td>
                                        <span class="badge {{ $driver->status }}">
                                            {{__("$driver->status")}}
                                        </span>
                                    </td>
                                    <td>
                                        <span>{{ $driver?->completed_orders?->count() }}</span>
                                    </td>
                                    <td>
                                        <span>{{ $driver?->monthly_orders()?->count() }}</span>
                                    </td>
                                    <td>
                                        <a class="text-dark fw-bolder text-hover-khardl d-block fs-6">{{ $driver->phone }}</a>
                                    </td>
                                    <td>
                                        <a class="text-dark fw-bolder text-hover-khardl d-block fs-6">{{ $driver->email }}</a>
                                    </td>
                                    <td>
                                        <a class="text-dark fw-bolder text-hover-khardl d-block fs-6">{{ $driver->vehicle_number }}</a>
                                    </td>
                                    <td>
                                        <span>{{ $driver?->created_at?->format('Y-m-d') }}</span>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-end flex-shrink-0">
                                            <a href="{{ route('drivers.show', ['driver' => $driver->id]) }}" class="btn btn-icon btn-bg-light btn-active-color-khardl btn-sm me-1">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                            <a href="{{ route('drivers.edit', ['driver' => $driver->id]) }}" class="btn btn-icon btn-bg-light btn-active-color-khardl btn-sm me-1">
                                                <!--begin::Svg Icon | path: icons/duotune/art/art005.svg-->
                                                <span class="svg-icon svg-icon-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path opacity="0.3" d="M21.4 8.35303L19.241 10.511L13.485 4.755L15.643 2.59595C16.0248 2.21423 16.5426 1.99988 17.0825 1.99988C17.6224 1.99988 18.1402 2.21423 18.522 2.59595L21.4 5.474C21.7817 5.85581 21.9962 6.37355 21.9962 6.91345C21.9962 7.45335 21.7817 7.97122 21.4 8.35303ZM3.68699 21.932L9.88699 19.865L4.13099 14.109L2.06399 20.309C1.98815 20.5354 1.97703 20.7787 2.03189 21.0111C2.08674 21.2436 2.2054 21.4561 2.37449 21.6248C2.54359 21.7934 2.75641 21.9115 2.989 21.9658C3.22158 22.0201 3.4647 22.0084 3.69099 21.932H3.68699Z" fill="currentColor" />
                                                        <path d="M5.574 21.3L3.692 21.928C3.46591 22.0032 3.22334 22.0141 2.99144 21.9594C2.75954 21.9046 2.54744 21.7864 2.3789 21.6179C2.21036 21.4495 2.09202 21.2375 2.03711 21.0056C1.9822 20.7737 1.99289 20.5312 2.06799 20.3051L2.696 18.422L5.574 21.3ZM4.13499 14.105L9.891 19.861L19.245 10.507L13.489 4.75098L4.13499 14.105Z" fill="currentColor" />
                                                    </svg>
                                                </span>
                                                <!--end::Svg Icon-->
                                            </a>
                                            @if($user->isRestaurantOwner())
                                            <form class="delete-form" id="delete_driver_{{ $driver->id }}" action="{{ route('drivers.destroy', ['driver' => $driver->id]) }}" method="POST">
                                                @method('DELETE')
                                                @csrf
                                            </form>
                                            <a href="#" onclick='deleteDriver("{{ $driver->id }}")' class="delete-button btn btn-icon btn-bg-light btn-active-color-khardl btn-sm">
                                                <span class="svg-icon svg-icon-3">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                                        <path d="M5 9C5 8.44772 5.44772 8 6 8H18C18.5523 8 19 8.44772 19 9V18C19 19.6569 17.6569 21 16 21H8C6.34315 21 5 19.6569 5 18V9Z" fill="currentColor" />
                                                        <path opacity="0.5" d="M5 5C5 4.44772 5.44772 4 6 4H18C18.5523 4 19 4.44772 19 5V5C19 5.55228 18.5523 6 18 6H6C5.44772 6 5 5.55228 5 5V5Z" fill="currentColor" />
                                                        <path opacity="0.5" d="M9 4C9 3.44772 9.44772 3 10 3H14C14.5523 3 15 3.44772 15 4V4H9V4Z" fill="currentColor" />
                                                    </svg>
                                                </span>
                                            </a>
                                            @endif
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        {{ $drivers->withQueryString()->links('pagination::bootstrap-4') }}
                        <!--end::Table-->
                    </div>
                    <!--end::Table container-->
                </div>
                <!--begin::Body-->
            </div>
            <!--end::Tables Widget 9-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Post-->
</div>
<!--end::Content-->

@endsection
@section('js')
<script>

    function deleteDriver(driverId) {
        event.preventDefault();

        var form = document.getElementById(`delete_driver_${driverId}`);
        Swal.fire({
            title: `{{ __("Are you sure you want to delete this driver ?") }}`
            , icon: 'warning'
            , showCancelButton: true
            , confirmButtonColor: '#d33'
            , cancelButtonColor: '#3085d6'
            , confirmButtonText: '{{ __("delete") }}'
            , cancelButtonText: '{{ __("cancel") }}'
        }).then((result) => {
            if (result.isConfirmed) {
                form.submit();
            }
        });
    }
</script>
@endsection
