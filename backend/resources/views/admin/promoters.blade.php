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
                  <form method="POST" action="{{ route('admin.add-promoter') }}">
                  @csrf
                  <!--begin::Main column-->
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
                                                    <h2>{{ __('add-a-promoter') }}</h2>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-end mt-3">
                                                    <!--begin::Button-->
                                                    <a id="resetButton" id="kt_ecommerce_add_product_cancel" class="btn btn-light me-5">{{ __('reset') }}</a>
                                                    <!--end::Button-->
                                                    <!--begin::Button-->
                                                    <button type="submit" id="kt_ecommerce_add_product_submit"
                                                        class="btn btn-sm btn-primary">
                                                        <span class="indicator-label">{{ __('add') }}</span>
                                                        <span class="indicator-progress">{{ __('please-wait') }}
                                                            <span
                                                                class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                                    </button>
                                                    <!--end::Button-->
                                                </div>
                                            </div>
                                            <!--end::Card header-->
                                            <!--begin::Card body-->
                                            <div class="card-body pt-0">
                                                <!--begin::Input group-->
                                                <div class="mb-10 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="required form-label">{{ __('name') }}</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" required id="nameInput" name="name" class="form-control mb-2" placeholder="{{ __('name') }}" value="{{ old('name') }}" />
                                                    <!--end::Input-->
                                                    <!--begin::Description-->
                                                    <div class="text-muted fs-7">{{ __('name') }} {{ __('is-required') }}</div>
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Input group-->
                                                <!--begin::Input group-->
                                                <div class="mb-10 fv-row">
                                                    <!--begin::Label-->
                                                    <label class="form-label">{{ __('url') }}</label>
                                                    <!--end::Label-->
                                                    <!--begin::Input-->
                                                    <input type="text" id="urlInput" name="url" class="form-control mb-2" placeholder="{{ __('url-example') }}" value="{{ old('url') }}" />
                                                    <!--end::Input-->
                                                    <!--begin::Description-->
                                                    <div class="text-muted fs-7">{{ __('leave-empty-for-random-url') }}</div>
                                                    <div class="text-muted fs-7">{{ __('url-should-be-unique') }}</div>
                                                    <!--end::Description-->
                                                </div>
                                                <!--end::Input group-->

                                            </div>
                                            <!--end::Card header-->
                                        </div>
                                        <!--end::General options-->
                                    </div>
                                </div>
                                <!--end::Tab pane-->
                    </div>
                    <!--end::Main column-->
                  </form>
              <!--end::Form-->




                      <!--begin::Tables Widget 9-->
                      <div class="card mb-5 mb-xl-8">

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
                                              <th class="min-w-200px">{{ __('name') }}</th>
                                              <th class="min-w-150px">{{ __('url') }}</th>
                                              <th class="min-w-150px">{{ __('entered') }}</th>
                                              <th class="min-w-150px">{{ __('registered') }}</th>
                                              <th class="min-w-150px">{{ __('External URL') }}</th>
                                              <th class="min-w-150px text-end">{{ __('actions')}}</th>
                                          </tr>
                                      </thead>
                                      <!--end::Table head-->
                                      <!--begin::Table body-->
                                      <tbody>

                                        @foreach ($promoters as $promoter)
                                            <tr>
                                                <td class="text-muted fw-bolder">
                                                    {{ $promoter->id }}
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center">
                                                        <div class="d-flex justify-content-start flex-column">
                                                            <a class="text-dark fw-bolder text-hover-primary fs-6">{{ $promoter->name }}</a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <a href="/register/?ref={{ $promoter->url }}" target="_blank" class="text-dark fw-bolder text-hover-primary d-block fs-6">{{ $promoter->url }}</a>
                                                </td>
                                                <td>
                                                    <span class="badge badge-light-success fw-bolder px-4 py-3">{{ $promoter->entered }}</span>
                                                </td>
                                                <td>
                                                    <span class="badge badge-light-success fw-bolder px-4 py-3">{{ $promoter->registered }}</span>
                                                </td>
                                                <td>
                                                    <div>
                                                        <a href="{{ route('global.promoter.show', ['name' => $promoter->name]) }}" target="_blank">
                                                          <i class="fa fa-eye"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td class="text-end">
                                                    <form class="delete-form justify-content-end" action="{{ route('admin.delete-promoter', ['id' => $promoter->id]) }}" method="POST">
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
                                  {{ $promoters->links('pagination::bootstrap-4') }}
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
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script>
            $(document).ready(function() {
                $('#resetButton').click(function() {
                    $('#nameInput').val("");
                    $('#urlInput').val("");
                });
            });
        </script>

        <script>
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
          </script>

      <!--end::Content-->
@endsection
