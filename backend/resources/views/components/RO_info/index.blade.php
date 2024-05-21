<!--begin::Card body-->
<div class="card-body pt-0">
    <div class="card-title">
        <h2>{{ __('Restaurant owner information')}}</h2>
    </div>
    <!--begin::Input group-->
    <div class="mb-10 fv-row">
        <!--begin::Label-->
        <label class="required form-label">{{ __('first-name')}}</label>
        <!--end::Label-->
        <!--begin::Input-->
        <input type="text" name="first_name" class="form-control mb-2" required placeholder="{{ __('first-name')}}" value="{{old('first_name') ?? $user->first_name}}" />
        <!--end::Input-->
    </div>
    <!--end::Input group-->
    <div class="mb-10 fv-row">
        <!--begin::Label-->
        <label class="required form-label">{{ __('last-name')}}</label>
        <!--end::Label-->
        <!--begin::Input-->
        <input type="text" name="last_name" class="form-control mb-2" required placeholder="{{ __('last-name')}}" value="{{old('last_name') ?? $user->last_name}}" />
        <!--end::Input-->
    </div>
    @if(!$user?->traderregistrationrequirement||!$user->restaurant)
    <div class="mb-10 fv-row">
        <!--begin::Label-->
        <label class="required form-label">{{ __('Restaurant name (English)')}}</label>
        <!--end::Label-->
        <!--begin::Input-->
        <input type="text" name="restaurant_name" class="form-control mb-2" required placeholder="{{ __('Restaurant name (English)')}}" value="{{old('restaurant_name') ?? $user->restaurant_name}}" />
        <!--end::Input-->
    </div>
    <div class="mb-10 fv-row">
        <!--begin::Label-->
        <label class="required form-label">{{ __('Restaurant name (Arabic)')}}</label>
        <!--end::Label-->
        <!--begin::Input-->
        <input type="text" name="restaurant_name_ar" class="form-control mb-2" required placeholder="{{ __('Restaurant name (English)')}}" value="{{old('restaurant_name_ar') ?? $user->restaurant_name_ar}}" />
        <!--end::Input-->
    </div>
    @endif
    <!--end::Input group-->
    <!--begin::Input group-->
    <div class="mb-10 fv-row">
        <!--begin::Label-->
        <label class="required form-label">{{ __('email')}}</label>
        <!--end::Label-->
        <!--begin::Input-->
        <input type="email" name="email" class="form-control mb-2" required placeholder="{{ __('email')}}" value="{{old('email')?? $user->email}} " />
        <!--end::Input-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="mb-10 fv-row">
        <!--begin::Label-->
        <label class=" form-label">{{ __('password')}}</label>
        <!--end::Label-->
        <!--begin::Input-->
        <input type="password" name="password" class="form-control mb-2" minlength="8" placeholder="{{ __('password')}}" value="{{old('password')}}" />
        <!--end::Input-->
    </div>
    <!--end::Input group-->

    <!--begin::Input group-->
    <div class="mb-10 fv-row">
        <!--begin::Label-->
        <label class="required form-label">{{ __('phone')}}</label>
        <!--end::Label-->
        <!--begin::Input-->
        <input type="tel" pattern="[0-9+]{10,14}" onkeypress="return event.charCode >= 48 && event.charCode <= 57 || event.charCode === 43" minlength="10" maxlength="14" class="form-control" name="phone" id="phone" placeholder="05XXXXXXXX" required value="{{ old('phone') ?? $user->phone }}">
        <!--end::Input-->
    </div>
    <!--end::Input group-->
    <div class="mb-10 fv-row">
        <!--begin::Label-->
        <label class="required form-label">{{ __('position')}}</label>
        <!--end::Label-->
        <!--begin::Input-->
        <input type="text" required class="form-control" name="position" id="position" placeholder="{{ __('position') }}" value="{{ old('position') ?? $user->position }}">
        <!--end::Input-->
    </div>
</div>
