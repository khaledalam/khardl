<div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button bg-khardl text-white" type="button" data-bs-toggle="collapse" data-bs-target="#subscriptions" aria-expanded="true" aria-controls="subscriptions">
            {{ __('Your subscription') }}
        </button>
    </h2>
    <div id="subscriptions" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
        <div class="accordion-body">
            <!--begin::Content-->
            @if($ROSubscription)
            <div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">
                <!--begin::Post-->
                <div class="post d-flex flex-column-fluid" id="kt_post">
                    <!--begin::Container-->
                    <div id="kt_content_container" class="container-xxl">
                        <!--begin::Row-->
                        <div class="row">

                            <!--begin::Col-->
                            <div class="col-md-12">
                                <!--begin::Subtitle-->
                                <span class="text-gray-900 pt-3 fw-bolder    fs-17"><i class=""></i> {{ __('Current subscription') }}</span>
                                <!--end::Subtitle-->
                                <!--begin::Info-->
                                <div class="card-body">
                                    <!--begin::Scroll-->
                                    <div class="hover-scroll-overlay-y">
                                        <!--begin::Table-->
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
                                                        <span class="text-start">{{__('Number of remain available branches')}}</span>
                                                    </td>
                                                    <td class="text-dark">
                                                        <span class="py-3 px-4 fs-23">{{ $ROSubscription?->number_of_branches }}</span>
                                                    </td>
                                                </tr>
                                                <!--end::Item-->
                                                @if(isset($ROSubscription?->subscription?->name))
                                                <!--begin::Item-->
                                                <tr>
                                                    <td>
                                                        <span class="text-start">{{__('Package')}}</span>
                                                    </td>
                                                    <td class="text-dark">
                                                        <span class="py-3 px-4 fs-23">{{ $ROSubscription?->subscription?->name }}</span>
                                                    </td>
                                                </tr>
                                                @endif
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <tr>
                                                    <td>
                                                        <span class="text-start">{{__('Price')}}</span>
                                                    </td>
                                                    <td class="text-dark">
                                                        @if($ROSubscription?->discount)
                                                        <div class="d-flex flex-row">
                                                            <div class="p-2">
                                                                <p class="text-decoration-line-through">
                                                                    {{$ROSubscription?->amount}} {{__('SAR')}}
                                                                </p>
                                                            </div>
                                                            <div class="p-2">
                                                                <p>{{$ROSubscription?->discount}} {{__('SAR')}}</p>
                                                            </div>
                                                        </div>


                                                        @else
                                                        <span class="py-3 px-4 fs-23">{{ $ROSubscription?->amount }} {{ __('SAR') }}</span>

                                                        @endif
                                                    </td>
                                                </tr>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <tr>
                                                    <td>
                                                        <span class="text-start">{{__('Start date')}}</span>
                                                    </td>
                                                    <td class="text-dark">
                                                        <span class="py-3 px-4 fs-23">{{ $ROSubscription?->start_at?->format('Y-m-d') }}</span>
                                                    </td>
                                                </tr>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <tr>
                                                    <td>
                                                        <span class="text-start">{{__('End date')}}</span>
                                                    </td>
                                                    <td class="text-dark">
                                                        <span class="py-3 px-4 fs-23">{{ $ROSubscription?->end_at?->format('Y-m-d') }}</span>
                                                    </td>
                                                </tr>
                                                <!--end::Item-->
                                                <!--begin::Item-->
                                                <tr>
                                                    <td>
                                                        <span class="text-start">{{__('Status')}}</span>
                                                    </td>
                                                    <td>
                                                        @if($ROSubscription?->status == 'active')
                                                        <span class="py-3 px-4 fs-23 badge badge-success">{{ __(''.$ROSubscription?->status) }}</span>
                                                        @else
                                                        <span class="py-3 px-4 fs-23 badge badge-danger">{{ __(''.$ROSubscription?->status) }}</span>
                                                        @endif
                                                    </td>
                                                </tr>
                                                <!--end::Item-->
                                            </tbody>
                                            <!--end::Table body-->
                                        </table>
                                        <!--end::Table-->
                                    </div>
                                    <!--end::Scroll-->
                                </div>
                                <!--end::Info-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Modals-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Post-->
            </div>
            @else
            <div class="alert alert-warning text-center">
                <h4>{{ __('You do not have subscription') }}</h4>
                <p>{{ __('You can subscription now') }}</p>
                <a href="{{ route('restaurant.service') }}">
                    <button type="button" class="btn btn-khardl btn-sm">{{ __('View services') }}</button>
                </a>
            </div>
            @endif
            <hr>
            <!--end::Content-->
            @if($ROSubscriptionInvoices->count())
            <!--begin::Content-->
            <div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">
                <!--begin::Post-->
                <div class="post d-flex flex-column-fluid" id="kt_post">
                    <!--begin::Container-->
                    <div id="kt_content_container" class="container-xxl">
                        <!--begin::Row-->
                        <div class="row g-12 g-xl-12 mb-xl-112">

                            <!--begin::Col-->
                            <div class="col-lg-12 col-xl-12 col-xxl-12 mb-8 mb-xl-0">
                                <!--begin::Chart widget 3-->
                                <div class="card card-flush overflow-hidden h-md-100">
                                    <!--begin::List widget 5-->
                                    <div class="card card-flush h-xl-100">
                                        <!--begin::Card header-->
                                        <div class="card-header align-items-center py-5 gap-2 gap-md-5">
                                            <!--begin::Card title-->
                                            <div class="card-title">
                                                <!--begin::Search-->
                                                <div class="d-flex align-items-center position-relative my-1">
                                                    <h3>{{ __('Transactions') }}</h3>
                                                </div>
                                                <!--end::Search-->
                                            </div>
                                            <!--end::Card title-->
                                            <!--begin::Card toolbar-->
                                            <div class="card-toolbar flex-row-fluid justify-content-end gap-5">
                                                <form method="GET">
                                                    @csrf
                                                    <div class="d-flex my-0">
                                                        <input type="hidden" name="download" value="csv">
                                                        <button type="submit" id="download_app_transactions" class="btn btn-khardl mx-2">
                                                            <span class="indicator-label">{{ __('Download') }} <i class="fa fa-download"></i></span>
                                                            <span class="indicator-progress">{{ __('please-wait')}}
                                                                <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                        </button>
                                                    </div>
                                                </form>
                                                <!--end::setting-->
                                            </div>
                                            <!--end::Card toolbar-->
                                        </div>
                                        <!--end::Card header-->
                                        <!--begin::Body-->
                                        <div class="card-body">
                                            <!--begin::Scroll-->
                                            <div class="hover-scroll-overlay-y">
                                                <!--begin::Table-->
                                                <table class="table align-middle table-row-dashed fs-6 gy-3" id="kt_table_widget_5_table">
                                                    <!--begin::Table head-->
                                                    <thead>
                                                        <!--begin::Table row-->
                                                        <tr class="text-start text-gray-400 fw-bolder fs-7 text-uppercase gs-0">
                                                            <th class="text-start pe-3 min-w-100px">{{ __('Package') }}</th>
                                                            <th class="text-start pe-3 min-w-100px">{{ __('Status') }}</th>
                                                            <th class="text-start pe-3 min-w-100px">{{ __('Number of branches') }}</th>
                                                            <th class="text-start pe-3 min-w-100px">{{ __('Price') }}</th>
                                                            <th class="text-start pe-3 min-w-100px">{{ __('Date') }}</th>
                                                        </tr>
                                                        <!--end::Table row-->
                                                    </thead>
                                                    <!--end::Table head-->
                                                    <!--begin::Table body-->
                                                    <tbody class="fw-bolder text-gray-600">
                                                        @foreach ($ROSubscriptionInvoices as $invoice)
                                                        <tr>
                                                            <!--begin::Item-->
                                                            <td class="text-start">
                                                                {{ $invoice->subscription?->name }}
                                                            </td>
                                                            <td class="text-start">
                                                                @if($invoice->status =='active')
                                                                <span class="py-3 px-4 fs-23 badge badge-khardl">{{ __(''.$invoice->status) }}</span>
                                                                @else
                                                                <span class="py-3 px-4 fs-23 badge badge-light-khardl">{{ __(''.$invoice->status) }}</span>
                                                                @endif
                                                            </td>
                                                            <td>
                                                                <span class="py-3 px-4 fs-23">
                                                                    {{ $invoice->number_of_branches }}
                                                                </span>
                                                            </td>
                                                            <td class="text-start">
                                                                @if($invoice?->discount)
                                                                <div class="d-flex flex-row">
                                                                    <div class="p-2">
                                                                        <p class="text-decoration-line-through">
                                                                            {{$invoice?->amount}} {{__('SAR')}}
                                                                        </p>
                                                                    </div>
                                                                    <div class="p-2">
                                                                        <p>{{$invoice?->discount}} {{__('SAR')}}</p>
                                                                    </div>
                                                                </div>


                                                                @else
                                                                <span class="py-3 px-4 fs-23">{{ $invoice?->amount }} {{ __('SAR') }}</span>

                                                                @endif
                                                            </td>
                                                            <td>
                                                                <a href="#" class="text-dark text-hover-khardl">{{ $invoice->created_at?->format('Y-m-d h:m A') }}</a>
                                                            </td>
                                                            <!--end::Item-->
                                                        </tr>
                                                        @endforeach

                                                    </tbody>
                                                    <!--end::Table body-->
                                                </table>
                                                <!--end::Table-->
                                            </div>
                                            <!--end::Scroll-->
                                        </div>
                                        <!--end::Body-->
                                    </div>
                                    <!--end::List widget 5-->
                                </div>
                                <!--end::Chart widget 3-->
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Modals-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Post-->
            </div>
            <!--end::Content-->
            @endif

        </div>
    </div>
</div>
