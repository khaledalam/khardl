<div class="row g-6">
    {{-- NOTE: and variabile you added here note that you have to add it in tenant controller --}}
    <!--begin::Yeswa-->
    @if(isset($yeswa))
    @include('restaurant.delivery_companies.yeswa.index',['yeswa' => $yeswa,'isadmin' => 1])
    @endif
    <!--end::Yeswa-->

    <!--begin::Cervo-->
    @if(isset($cervo))
    @include('restaurant.delivery_companies.cervo.index',['cervo' => $cervo,'isadmin' => 1])
    @endif
    <!--end::Cervo-->

    <!--begin::Streetline-->
    @if(isset($streetline))
    @include('restaurant.delivery_companies.streeline.index',['streetline' => $streetline,'isadmin' => 1])
    @endif
    <!--end::Streetline-->
</div>
@if (!isset($yeswa)||!isset($cervo)||!isset($streetline))
<div class="card card-flush h-lg-100" id="kt_contacts_main">
    <!--begin::Card body-->

    <div class="card-body pt-5">
        <div class="text-center p-5 ">
            <h5 class="">
                <div class="alert alert-warning">
                    {{ __('messages.Restaurant does not have any delivery companies yet') }}
                </div>
            </h5>
        </div>
    </div>
    <!--end::Card body-->
</div>
@endif
