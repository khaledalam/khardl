<div class="accordion-item">
    <h2 class="accordion-header" id="headingOne">
        <button class="accordion-button bg-khardl text-white" type="button" data-bs-toggle="collapse" data-bs-target="#tap_bussiness_info" aria-expanded="true" aria-controls="tap_bussiness_info">
            {{ __('Tab information') }}
        </button>
    </h2>
    <div id="tap_bussiness_info" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
        <div class="accordion-body">
            <div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">
                <!--begin::Post-->
                <div class="post d-flex flex-column-fluid" id="kt_post">
                    <!--begin::Container-->
                    <div id="kt_content_container" class="container-xxl">
                        <!--begin::Row-->
                        <div class="row g-12 g-xl-12 mb-xl-112">

                            <!--begin::Col-->
                            <div class="col-md-6">
                                <!--begin::Chart widget 3-->
                                <div class="card card-flush overflow-hidden h-md-100">
                                    <!--begin::List widget 5-->
                                    <div class="card card-flush h-xl-100">
                                        <!--begin::Header-->
                                        <div class="card-header pt-7">
                                            <!--begin::Title-->
                                            <h3 class="card-title align-items-start flex-column">
                                                <span class="card-label fw-bolder text-dark">{{ __('Business information') }}</span>
                                            </h3>
                                            <!--end::Title-->
                                        </div>
                                        <!--end::Header-->
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
                                                            <th class="text-start pe-3 min-w-100px">{{ __('Key') }}</th>
                                                            <th class="text-start pe-3 min-w-100px">{{ __('Value') }}</th>
                                                        </tr>
                                                        <!--end::Table row-->
                                                    </thead>
                                                    <!--end::Table head-->
                                                    <!--begin::Table body-->
                                                    <tbody class="fw-bolder text-gray-600">
                                                        @if (isset($tap_info['id']))
                                                        <tr>
                                                            <!--begin::Item-->
                                                            <td>
                                                                <span class="text-start">{{__('Business ID')}}</span>
                                                            </td>
                                                            <td class="text-dark">
                                                                <span class="py-3 px-4 fs-23">{{ $tap_info['id'] }}</span>
                                                            </td>
                                                            <!--end::Item-->
                                                        </tr>
                                                        @endif
                                                        @if (isset($tap_info['brand']['name']))
                                                        <tr>
                                                            <!--begin::Item-->
                                                            <td>
                                                                <span class="text-start">{{__('Brand name')}}</span>
                                                            </td>
                                                            <td class="text-dark">
                                                                <span class="py-3 px-4 fs-23">{{ $tap_info['brand']['name']['ar'] }}</span>
                                                                -
                                                                <span class="py-3 px-4 fs-23">{{ $tap_info['brand']['name']['en'] }}</span>
                                                            </td>
                                                            <!--end::Item-->
                                                        </tr>
                                                        @endif
                                                        @if (isset($tap_info['entity']['country'])&&isset($tap_info['entity']['license']))
                                                        <tr>
                                                            <!--begin::Item-->
                                                            <td>
                                                                <span class="text-start">{{__('Legal Entity (Commercial Registration)')}}</span>
                                                            </td>
                                                            <td class="text-dark">
                                                                <span class="py-3 px-4 fs-23">
                                                                    <span class="py-3 px-4 fs-23">
                                                                        @if($tap_info['entity']['is_licensed'])
                                                                        <span>
                                                                            {{ __('Entity is Licensed') }}
                                                                        </span>
                                                                        @else
                                                                        <span>
                                                                            {{ __('Entity is not Licensed') }}
                                                                        </span>
                                                                        @endif
                                                                    </span>
                                                            </td>
                                                            <!--end::Item-->
                                                        </tr>
                                                        @if (isset($tap_info['entity']['license']['number']))
                                                        <tr>
                                                            <!--begin::Item-->
                                                            <td>
                                                                <span class="text-start">{{__('Legal entity number')}}</span>
                                                            </td>
                                                            <td class="text-dark">
                                                                <span class="py-3 px-4 fs-23">
                                                                    {{ $tap_info['entity']['license']['number'] }}
                                                                </span>
                                                            </td>
                                                            <!--end::Item-->
                                                        </tr>
                                                        @if (isset($tap_info['entity']['license']['documents'][1]['number'])&&isset($tap_info['entity']['license']['documents'][1]['issuing_date']))
                                                        <tr>
                                                            <!--begin::Item-->
                                                            <td>
                                                                <span class="text-start">{{__('Number of Memorandum of Association')}}</span>
                                                            </td>
                                                            <td class="text-dark">
                                                                <span class="py-3 px-4 fs-23">
                                                                    {{ $tap_info['entity']['license']['documents'][1]['number'] }}
                                                                </span>
                                                            </td>
                                                            <!--end::Item-->
                                                        </tr>
                                                        <tr>
                                                            <!--begin::Item-->
                                                            <td>
                                                                <span class="text-start">{{__('Issuing date')}}</span>
                                                            </td>
                                                            <td class="text-dark">
                                                                <span class="py-3 px-4 fs-23">
                                                                    {{ $tap_info['entity']['license']['documents'][1]['issuing_date'] }}
                                                                </span>
                                                            </td>
                                                            <!--end::Item-->
                                                        </tr>
                                                        <tr>
                                                            <!--begin::Item-->
                                                            <td>
                                                                <span class="text-start">{{__('Expiry date')}}</span>
                                                            </td>
                                                            <td class="text-dark">
                                                                <span class="py-3 px-4 fs-23">
                                                                    {{ $tap_info['entity']['license']['documents'][1]['expiry_date'] }}
                                                                </span>
                                                            </td>
                                                            <!--end::Item-->
                                                        </tr>
                                                        @endif
                                                        @endif
                                                        @endif
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

                            <!--begin::Col-->
                            <div class="col-md-6">
                                <div class="row">
                                    <div class="col-md-12">
                                        <!--begin::Chart widget 3-->
                                        <div class="card card-flush overflow-hidden h-md-100">
                                            <!--begin::List widget 5-->
                                            <div class="card card-flush h-xl-100">
                                                <!--begin::Header-->
                                                <div class="card-header pt-7">
                                                    <!--begin::Title-->
                                                    <h3 class="card-title align-items-start flex-column">
                                                        <span class="card-label fw-bolder text-dark">{{ __('Your information') }}</span>
                                                    </h3>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Header-->
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
                                                                    <th class="text-start pe-3 min-w-100px"></th>
                                                                    <th class="text-start pe-3 min-w-100px"></th>
                                                                </tr>
                                                                <!--end::Table row-->
                                                            </thead>
                                                            <!--end::Table head-->
                                                            <!--begin::Table body-->
                                                            <tbody class="fw-bolder text-gray-600">
                                                                @if (isset($tap_info['user']['name']))
                                                                <tr>
                                                                    <!--begin::Item-->
                                                                    <td>
                                                                        <span class="text-start">{{__('Name')}}</span>
                                                                    </td>
                                                                    <td class="text-dark">
                                                                        <span class="py-3 px-4 fs-23">
                                                                            {{ __($tap_info['user']['name']['title']) }}.
                                                                            {{ $tap_info['user']['name']['first'] }} {{-- {{ $tap_info['user']['name']['middle'] }} --}} {{ $tap_info['user']['name']['last'] }}
                                                                        </span>
                                                                    </td>
                                                                    <!--end::Item-->
                                                                </tr>
                                                                @endif
                                                                @if (isset($tap_info['user']['email']))
                                                                <tr>
                                                                    <!--begin::Item-->
                                                                    <td>
                                                                        <span class="text-start">{{__('Email')}}</span>
                                                                    </td>
                                                                    <td class="text-dark">
                                                                        <span class="py-3 px-4 fs-23">
                                                                            {{ $tap_info['user']['email'][0]['address'] }} - ({{ __($tap_info['user']['email'][0]['type']) }})
                                                                            {{-- ({{ $tap_info['user']['email'][0]['primary'] ? __('Primary') : __('Not primary') }}) --}}
                                                                        </span>
                                                                    </td>
                                                                    <!--end::Item-->
                                                                </tr>
                                                                @endif
                                                                @if (isset($tap_info['user']['phone'][0]))
                                                                <tr>
                                                                    <!--begin::Item-->
                                                                    <td>
                                                                        <span class="text-start">{{__('Phone')}}</span>
                                                                    </td>
                                                                    <td class="text-dark">
                                                                        <span class="py-3 px-4 fs-23">
                                                                            {{ $tap_info['user']['phone'][0]['country_code'] }}-{{ $tap_info['user']['phone'][0]['number'] }}
                                                                            {{-- ({{ $tap_info['user']['phone'][0]['primary']  ? __('Primary') : __('Not primary')}} --}} - ({{ __($tap_info['user']['phone'][0]['type']) }})
                                                                        </span>
                                                                    </td>
                                                                    <!--end::Item-->
                                                                </tr>
                                                                @endif
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
                                    <hr>
                                    <div class="col-md-12">
                                        <!--begin::Chart widget 3-->
                                        <div class="card card-flush my-2 overflow-hidden h-md-100">
                                            <!--begin::List widget 5-->
                                            <div class="card card-flush h-xl-100">
                                                <!--begin::Header-->
                                                <div class="card-header pt-7">
                                                    <!--begin::Title-->
                                                    <h3 class="card-title align-items-start flex-column">
                                                        <span class="card-label fw-bolder text-dark">{{ __('Bank information') }}</span>
                                                    </h3>
                                                    <!--end::Title-->
                                                </div>
                                                <!--end::Header-->
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
                                                                    <th class="text-start pe-3 min-w-100px"></th>
                                                                    <th class="text-start pe-3 min-w-100px"></th>
                                                                </tr>
                                                                <!--end::Table row-->
                                                            </thead>
                                                            <!--end::Table head-->
                                                            <!--begin::Table body-->
                                                            <tbody class="fw-bolder text-gray-600">
                                                                @if (isset($tap_info['wallet']['bank']['name'])&&isset($tap_info['wallet']['bank']['account']))
                                                                <tr>
                                                                    <!--begin::Item-->
                                                                    <td>
                                                                        <span class="text-start">{{__('Bank name')}}</span>
                                                                    </td>
                                                                    <td class="text-dark">
                                                                        <span class="py-3 px-4 fs-23">
                                                                            {{ $tap_info['wallet']['bank']['name'] }}
                                                                        </span>
                                                                    </td>
                                                                    <!--end::Item-->
                                                                </tr>
                                                                <tr>
                                                                    <!--begin::Item-->
                                                                    <td>
                                                                        <span class="text-start">{{__('Bank IBAN')}}</span>
                                                                    </td>
                                                                    <td class="text-dark">
                                                                        <span class="py-3 px-4 fs-23">
                                                                            {{ $tap_info['wallet']['bank']['account']['iban'] }}
                                                                        </span>
                                                                    </td>
                                                                    <!--end::Item-->
                                                                </tr>
                                                                <tr>
                                                                    <!--begin::Item-->
                                                                    <td>
                                                                        <span class="text-start">{{__('Bank account number')}}</span>
                                                                    </td>
                                                                    <td class="text-dark">
                                                                        <span class="py-3 px-4 fs-23">
                                                                            {{ $tap_info['wallet']['bank']['account']['number'] }}
                                                                        </span>
                                                                    </td>
                                                                    <!--end::Item-->
                                                                </tr>
                                                                @endif
                                                                @if (isset($tap_info['wallet']['bank']['account']['name']))
                                                                <tr>
                                                                    <!--begin::Item-->
                                                                    <td>
                                                                        <span class="text-start">{{__('Company Name')}}</span>
                                                                    </td>
                                                                    <td class="text-dark">
                                                                        <span class="py-3 px-4 fs-23">
                                                                            {{ $tap_info['wallet']['bank']['account']['name'] }}
                                                                        </span>
                                                                    </td>
                                                                    <!--end::Item-->
                                                                </tr>
                                                                @endif
                                                                @if (isset($tap_info['wallet']['bank']['documents'][0]['number']))
                                                                <tr>
                                                                    <!--begin::Item-->
                                                                    <td>
                                                                        <span class="text-start">{{__('Bank Statement Number')}}</span>
                                                                    </td>
                                                                    <td class="text-dark">
                                                                        <span class="py-3 px-4 fs-23">
                                                                            {{ $tap_info['wallet']['bank']['documents'][0]['number'] }}
                                                                        </span>
                                                                    </td>
                                                                    <!--end::Item-->
                                                                </tr>
                                                                <tr>
                                                                    <!--begin::Item-->
                                                                    <td>
                                                                        <span class="text-start">{{__('Bank Issuing date')}}</span>
                                                                    </td>
                                                                    <td class="text-dark">
                                                                        <span class="py-3 px-4 fs-23">
                                                                            {{ $tap_info['wallet']['bank']['documents'][0]['issuing_date'] }}
                                                                        </span>
                                                                    </td>
                                                                    <!--end::Item-->
                                                                </tr>

                                                                @endif
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
                                </div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Modals-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Post-->
            </div>
        </div>
    </div>
</div>
