@extends('layouts.restaurant-sidebar')

@section('title', __('messages.No available branches'))

@section('content')
<!--begin::Content-->
<div class="content d-flex flex-column flex-column-fluid pt-0" id="kt_content">

    <!--begin::Post-->
    <div class="post d-flex flex-column-fluid" id="kt_post">
        <!--begin::Container-->
        <div id="kt_content_container" class="container-xxl">
            <div class="row">
                <div class="col-md-12">
                    <div class="card card-flush mb-0" data-kt-sticky="true" data-kt-sticky-name="inbox-aside-sticky" data-kt-sticky-offset="{default: false, xl: '0px'}" data-kt-sticky-width="{lg: '275px'}" data-kt-sticky-left="auto" data-kt-sticky-animation="false" data-kt-sticky-zindex="95">
                        <!--begin::Aside content-->
                        <div class="card-body" style="overflow-y: scroll;height: 20vh;">
                            <div class="alert alert-warning text-center">
                                {{ __('messages.You need to have branches first') }}
                            </div>
                        </div>
                        <!--end::Menu-->
                    </div>
                </div>

            </div>
            <!--end::Sidebar-->
            <!--begin::Content-->
            <!--end::Content-->
        </div>
        <!--end::Inbox App - Messages -->
    </div>
    <!--end::Container-->
</div>
<!--end::Post-->
<!--begin::Modal - New Target-->

@endsection
