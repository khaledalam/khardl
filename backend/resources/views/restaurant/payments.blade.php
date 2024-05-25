@extends('layouts.restaurant-sidebar')
@section('title', __('payments'))
@section('content')
@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif
@php
$tap_info = $settings->lead_response;
@endphp
@if ($settings->lead_id&&$settings->merchant_id)
@if ($settings->lead_response)
<!--begin::Content-->
<div class="accordion" id="accordionExample">
    {{-- Online paid payment --}}
    @include('components.payment-accordions.paid_online_payment')
    {{-- Advertising requests --}}
    @include('components.payment-accordions.ads_requests')
    {{-- RO subscription --}}
    @include('components.payment-accordions.subscriptions')
    {{-- Application --}}
    @include('components.payment-accordions.app')
    {{-- Bank information --}}
    @include('components.payment-accordions.bank_information')
</div>
<!--end::Content-->
@else
<div class="alert alert-warning mx-10 p-10 text-center">
    <i class="bi bi-hourglass-split text-warning fa-3x rotating"></i>
    <h4 class="mt-5">{{ __('Your request is pending and waiting for the respond of payment gateway.') }}</h4>
</div>
@endif
@else
<div class="alert alert-warning mx-10 p-10 text-center">
    <i class="bi bi-hourglass-split text-warning fa-3x rotating"></i>
    <h4 class="mt-5">{{ __('You need to contact adminstration because of your payment gateway is not set.') }}</h4>
</div>
@endif
@endsection
@section('js')
<script src="{{ global_asset('assets/js/custom/apps/ecommerce/sales/listing.js')}}"></script>
@endsection
