<div class="container-xxl mt-5">
    <div class="card">
        <div class="card-title">
            <div class="mb-5 text-center mt-6">
                <h3 class="fs-2hx fw-bolder mb-5">
                    {{__('Your requested advertisement packages')}}
                </h3>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="card-body py-3">
                    <!--begin::Table container-->
                    <div class="table-responsive">
                        <!--begin::Table-->
                        <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                            <!--begin::Table head-->
                            <thead>
                                <tr class="fw-bolder text-muted">
                                    <th class="min-w-25px">#</th>
                                    <th class="min-w-200px">{{ __('Package')}}</th>
                                    <th class="min-w-150px">{{ __('Name')}}</th>
                                    <th class="min-w-150px">{{ __('Status')}}</th>
                                    <th class="min-w-150px">{{ __('Price')}}</th>
                                    <th class="min-w-150px">{{ __('Orde date')}}</th>
                                </tr>
                            </thead>
                            <!--end::Table head-->
                            <!--begin::Table body-->
                            <tbody>
                                @foreach ($requestedPackages as $request)
                                <tr>
                                    <td class="text-muted fw-bolder">
                                        {{ $request?->id }}
                                    </td>
                                    <td>
                                        @if ($request?->advertisement_package?->image_for_tenants)
                                        <div class="symbol symbol-60px symbol-lg-60px symbol-fixed position-relative">
                                            <img alt="package image" src="{{ $request?->advertisement_package->image_for_tenants }}" />
                                        </div>
                                        @else
                                        <div class="symbol symbol-60px symbol-lg-60px symbol-fixed position-relative">
                                            <img alt="package image" src="{{ global_asset('images/advertisement.png') }}" />
                                        </div>
                                        @endif
                                    </td>
                                    <td>
                                        <span>{{ $request?->advertisement_package?->name }}</span>
                                    </td>
                                    <td>
                                        <span class="badge {{ $request->status }}">
                                            {{ __($request->status) }}
                                        </span>
                                        @if($request->status == 'contacted')
                                        <br>
                                        <span>({{ $request->answered_at?->format('Y-m-d') }})</span>
                                        @endif
                                    </td>
                                    <td>
                                        <span>{{ $request?->price }} {{ __('SAR') }}</span>
                                    </td>
                                    <td>
                                        {{ $request->created_at?->format('Y-m-d') }}
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                            <!--end::Table body-->
                        </table>
                        <!--end::Table-->
                    </div>
                    <!--end::Table container-->
                </div>
            </div>
        </div>
    </div>
</div>
