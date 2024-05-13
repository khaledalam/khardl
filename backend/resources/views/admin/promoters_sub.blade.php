@extends('layouts.admin-sidebar')


@section('title', __('promoters'))

@section('content')
    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">

        <!--begin::Post-->
              <div class="post d-flex flex-column-fluid" id="kt_post">
                  <!--begin::Container-->
                  <div id="kt_content_container" class="container-xxl">

                      <!--begin::Form-->
                
                  <!--begin::Main column-->
                    <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">
                        <!--begin::Tab content-->
                        <div class="tab-content">
                            <!--begin::Tab pane-->
                            <div class="d-flex flex-column flex-row-fluid gap-7 gap-lg-10">

                                <!--begin::Tab content-->
                                <div class="tab-content">
                                    <!--begin::Tab pane-->
                                    <div class="tab-pane fade show active" id="kt_ecommerce_add_product_general" role="tab-panel">
                                        <div class="d-flex flex-column gap-7 gap-lg-10">
                                            <!--begin::General options-->
                                            <div class="card card-flush py-4">
                                               
                                                <!--begin::Card header-->
                                                <div class="card-header">
                                                    <div class="card-title">
                                                        <h2>{{ __('Make a new coupon for subscriptions') }}</h2>
                                                    </div>
                                                   
                                                </div>
                                                <!--end::Card header-->
                                                <form action="{{ route('admin.save.promoters.sub') }}" method="POST">
                                                    @csrf
                                                    <!--begin::Card body-->
                                                    <div class="card-body pt-0">
                                                        <div class="mb-10 fv-row">
                                                            <!--begin::Label-->
                                                            <label class="required form-label">{{ __('Choose a promoter') }}</label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <select name="promoter_id" required  class="form-control mb-2" placeholder="{{ __('Choose a promoter') }}" >
                                                                <option selected></option>
                                                                @foreach($promoters as $promoter)
                                                                    <option value="{{$promoter->id}}" {{ (old('promoter_id') == $promoter->id) ? 'selected':'' }}>{{$promoter->name}}</option>
                                                                @endforeach
                                                            </select>
                                                            <!--end::Input-->
                                                        </div>
                                                        <!--begin::Input group-->
                                                        <div class="mb-10 fv-row">
                                                            <!--begin::Label-->
                                                            <label class="required form-label">{{ __('Code') }}</label>
                                                            <!--end::Label-->
                                                            <!--begin::Input-->
                                                            <input type="text" name="code" required value="{{ old('code') }}" class="form-control mb-2" placeholder="{{ __('Code') }}" />
                                                            <!--end::Input-->
                                                        </div>
                                                        <!--end::Input group-->
                                                        <!--begin::Input group-->
                                                        <div class="fv-row">
                                                            <div class="row">
                                                                <!--begin::Col 1-->
                                                                <div class="col-lg-6">
                                                                    <!--begin::Option 1-->
                                                                    <input type="radio" class="btn-check" name="type"  value="percentage" checked id="kt_create_account_form_account_type_percentage" />
                                                                    <label class="btn btn-outline btn-outline-dashed btn-outline-default p-3 d-flex align-items-center mb-10" for="kt_create_account_form_account_type_percentage">
                                                                        <!--begin::Info-->
                                                                        <div class="d-flex justify-content-between align-items-center">
                                                                            <div>
                                                                                <span>%</span>
                                                                            </div>
                                                                            <div class="sprout-container">
                                                                                <input type="number" max="100" min="1" value="{{ old('percentage') }}" name="percentage" id="percentageInput" class="form-control ml-2" step="1" placeholder="0" />
                                                                            </div>
                                                                        </div>
                                                                        <!--end::Info-->
                                                                    </label>
                                                                    <!--end::Option 1-->
                                                                </div>
                                                                <!--end::Col 1-->

                                                                <!--begin::Col 2-->
                                                                <div class="col-lg-6">
                                                                    <!--begin::Option 2-->
                                                                    <input type="radio" class="btn-check" name="type" value="fixed" id="kt_create_account_form_account_type_sar" />
                                                                    <label class="btn btn-outline btn-outline-dashed btn-outline-default p-3 d-flex align-items-center mb-10" for="kt_create_account_form_account_type_sar">
                                                                        <!--begin::Info-->
                                                                        <div class="d-flex justify-content-between align-items-center">
                                                                            <div>
                                                                                <span>{{ __('SAR') }}</span>
                                                                            </div>
                                                                            <div class="sprout-container">
                                                                                <input type="number" min="1" value="{{ old('fixed') }}" name="fixed" id="sarInput" class="form-control ml-2" step="1" placeholder="0" disabled />
                                                                            </div>
                                                                        </div>
                                                                        <!--end::Info-->
                                                                    </label>
                                                                    <!--end::Option 2-->
                                                                </div>
                                                                <div class="col-md-6">
                                                                    <div class="mb-10 fv-row">
                                                                        <div class="d-flex justify-content-between align-items-center">
                                                                            <div>
                                                                                <label class="form-label">{{ __('Max use') }}</label>
                                                                                <small class="text-muted">({{ __('One time use code per restaurnt owner') }})</small>
                                                                            </div>
                                                                        </div>
                                                                        <input type="number" min="1" name="max_use" value="{{ old('max_use') }}" class="form-control mb-2" placeholder="{{ __('Max use') }}" />
                                                                    </div>
                                                               
                                                                  
                                                                </div>
                                                                <div id="kt_account_settings_profile_details" class="collapse show">
                                                                    <!--begin::Card body-->
                                                                    <div class="card-body border-bottom mb-3">
                                                                        <!--begin::Input group-->
                                                                        <div class="row mb-0">
                                                                            <!--begin::Label-->
                                                                            <div class="form-check form-check-solid form-switch fv-row">
                                                                                <input class="form-check-input w-35px h-20px" type="checkbox" id="is_application_purchase" value="1" checked name="is_application_purchase">
                                                                                <label class="form-check-label" for="is_application_purchase">
                                                                                    {{ __('On purchase yearly app')}}
                                                                                </label>
                                                                            </div>
                                                                            <!--end::Label-->
                                                                        </div>
                                                                        <div class="row mb-0">
                                                                            <!--begin::Label-->
                                                                            <div class="form-check form-check-solid form-switch fv-row">
                                                                                <input class="form-check-input w-35px h-20px" type="checkbox" id="is_branch_purchase" value="1" checked name="is_branch_purchase">
                                                                                <label class="form-check-label" for="is_branch_purchase">
                                                                                    {{ __('On purchase branch')}}
                                                                                </label>
                                                                            </div>
                                                                            <!--end::Label-->
                                                                        </div>
                                                                        <div class="row mb-0">
                                                                            <!--begin::Label-->
                                                                            <div class="form-check form-check-solid form-switch fv-row">
                                                                                <input class="form-check-input w-35px h-20px" type="checkbox" id="is_lifetime_purchase" value="1" checked name="is_lifetime_purchase">
                                                                                <label class="form-check-label" for="is_lifetime_purchase">
                                                                                    {{ __('On purchase lifetime app')}}
                                                                                </label>
                                                                            </div>
                                                                            <!--end::Label-->
                                                                        </div>
                    
                                                                        <!--end::Input group-->
                                                                    </div>
                                                                    <!--end::Card body-->
                                                                </div>
                                                              

                                                        </div>
                                                        <!--begin::Actions-->
                                                        <div class="d-flex justify-content-end">
                                                            <button type="submit" class="badge badge-light-khardl p-4 text-hover-khardl bg-hover-khardl" style="border:none" data-kt-search-element="advanced-options-form-cancel">{{ __('Add') }}</button>
                                                        </div>
                                                        <!--end::Actions-->

                                                    </div>
                                                    <!--end::Card header-->
                                                </form>
                                            </div>
                                            <!--end::General options-->
                                        </div>
                                    </div>
                                    <!--end::Tab pane-->
                                </div>

                            </div>
                                <!--end::Tab pane-->
                    </div>
                    <!--end::Main column-->
      
              <!--end::Form-->




                      <!--begin::Tables Widget 9-->
                      <div class="card mb-5 mb-xl-8  mt-2">

                          <!--begin::Body-->
                          <div class="card-body py-3">
                            <form method="GET" action="{{ route('admin.promoters.sub') }}">
                                <div class="position-relative w-md-400px me-md-2">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen021.svg-->
                                    <span class="svg-icon svg-icon-3 svg-icon-gray-500 position-absolute top-50 translate-middle ms-6">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546" height="2" rx="1" transform="rotate(45 17.0365 15.1223)" fill="currentColor" />
                                            <path d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                    <div class="d-flex flex-row">
                                        <input type="text" class="form-control form-control-solid ps-10" name="search" value="{{ request('search') }}" placeholder="{{ __('search') }}" />
    
                                        <button type="submit" class="btn btn-khardl">{{__('Search')}}</button>
                                    </div>
            
                                </div>
                                </form>
                              <!--begin::Table container-->
                              <div class="table-responsive">
                                  <!--begin::Table-->
                                  <table class="table table-row-dashed table-row-gray-300 align-middle gs-0 gy-4">
                                      <!--begin::Table head-->
                                      <thead>
                                          <tr class="fw-bolder text-muted">
                                              <th class="min-w-25px">#</th>
                                              <th class="min-w-200px">{{ __('Promoter') }}</th>
                                              <th class="min-w-150px">{{ __('Code') }}</th>
                                              <th class="min-w-150px">{{ __('discount') }}</th>
                                              <th class="min-w-150px">{{ __('Type') }}</th>
                                              <th class="min-w-150px">{{ __('Number of usage') }}</th>
                                         
                                              <th class="min-w-150px">{{ __('restaurant subscription') }}</th>
                                              <th class="min-w-150px">{{ __('lifetime app') }}</th>
                                              <th class="min-w-150px">{{ __('yearly app') }}</th>
                                              <th class="min-w-150px text-end">{{ __('actions')}}</th>
                                          </tr>
                                      </thead>
                                      <!--end::Table head-->
                                      <!--begin::Table body-->
                                      <tbody>

                                    @foreach ($coupons as $coupon)
                                            <tr>
                                                <td class="text-muted fw-bolder">
                                                    {{ $coupon->id }}
                                                </td>
                                                <td>
                                                    <div>
                                                        <a href="{{ route('global.promoter.show', ['name' => $coupon->promoter->name]) }}" target="_blank">
                                                          <i class="fa fa-eye"></i>
                                                          {{$coupon->promoter->name}}
                                                        </a>
                                                    </div>
                                                </td>
                                            
                                                <td>
                                                    <span class="badge badge-light-success fw-bolder px-4 py-3">{{ $coupon->code }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge badge-light-success fw-bolder px-4 py-3">{{ $coupon->amount }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge badge-light-success fw-bolder px-4 py-3">{{ __($coupon->type) }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge badge-light-success fw-bolder px-4 py-3">{{ __($coupon->n_of_usage) }}</span>
                                                </td>
                                                
                                                <td>
                                                    <span class="badge  fw-bolder px-4 py-3">{{ $coupon->is_branch_purchase ? '✅':'❌' }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge  fw-bolder px-4 py-3">{{ $coupon->is_lifetime_purchase ? '✅':'❌' }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge  fw-bolder px-4 py-3">{{ $coupon->is_application_purchase ? '✅':'❌' }}</span>
                                                </td>
                                                <td class="text-end">
                                                    <form class="delete-form justify-content-end" action="{{ route('admin.delete-promoter-coupon', ['id' => $coupon->id]) }}" method="POST">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="delete-button btn btn-icon btn-bg-light btn-active-color-primary btn-sm">
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
                                                </td> 
                                            </tr>
                                        @endforeach 
                                      </tbody>
                                      <!--end::Table body-->
                                  </table>
                                  <!--end::Table-->
                                
                                  {{ $coupons->withQueryString()->links('pagination::bootstrap-4') }}
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
    </div>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#resetButton').click(function() {
                    $('#nameInput').val("");
                    $('#urlInput').val("");
                });
            });
            var deleteButtons = document.querySelectorAll('.delete-button');
                        deleteButtons.forEach(function(button) {
                            button.addEventListener('click', function(event) {
                                event.preventDefault();

                                var form = button.closest('.delete-form');

                                Swal.fire({
                                    title: '{{ __('are-you-sure') }}',
                                    text: "{{ __('you-wont-be-able-to-undo-this') }}",
                                    icon: 'warning',
                                    showCancelButton: true,
                                    confirmButtonColor: '#d33',
                                    cancelButtonColor: '#3085d6',
                                    confirmButtonText: '{{ __('delete') }}',
                                    cancelButtonText: '{{ __('cancel') }}'
                                }).then((result) => {
                                    if (result.isConfirmed) {
                                        form.submit();
                                    }
                                });
                            });
                        });
                    const percentageInput = document.getElementById('percentageInput');
                    const sarInput = document.getElementById('sarInput');

                    const percentageRadio = document.getElementById('kt_create_account_form_account_type_percentage');
                    const sarRadio = document.getElementById('kt_create_account_form_account_type_sar');

                    percentageRadio.addEventListener('change', () => {
                        if (percentageRadio.checked) {
                            percentageInput.disabled = false;
                            sarInput.disabled = true;
                            sarInput.value = ''; // Clear the value when disabled
                        }
                    });

                    sarRadio.addEventListener('change', () => {
                        if (sarRadio.checked) {
                            sarInput.disabled = false;
                            percentageInput.disabled = true;
                            percentageInput.value = ''; // Clear the value when disabled
                        }
                    });

                    const percentageLabel = document.querySelector('[for="kt_create_account_form_account_type_percentage"]');
                    const sarLabel = document.querySelector('[for="kt_create_account_form_account_type_sar"]');

                    percentageLabel.addEventListener('click', () => {
                        percentageInput.disabled = false;
                        sarInput.disabled = true;
                        sarInput.value = ''; // Clear the value when disabled
                        percentageRadio.checked = true;
                    });

                    sarLabel.addEventListener('click', () => {
                        sarInput.disabled = false;
                        percentageInput.disabled = true;
                        percentageInput.value = ''; // Clear the value when disabled
                        sarRadio.checked = true;
                    });
  </script>
@endsection
