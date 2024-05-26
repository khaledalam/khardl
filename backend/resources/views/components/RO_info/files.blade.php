<div class="card-body pt-0">
    <div class="card-title">
        <h2>{{ __('Required files')}}</h2>
    </div>
    <!--begin::Input group-->
    <div class="mb-10 fv-row">
        <!--begin::Label-->
        <label class="{{ $user?->traderRegistrationRequirement ? '' : 'required' }} form-label">{{ __('commercial_registration') }}</label>
        <!--end::Label-->

        <!--begin::Flex Container-->
        <div class="d-flex align-items-center">
            <!--begin::Input-->
            <input type="file" class="form-control" name="commercial_registration" accept=".pdf, .jpg, .jpeg, .png" {{ $user?->traderRegistrationRequirement ? '' : 'required' }}>
            <!--end::Input-->

            <!--begin::Download Link-->
            @if ($user?->traderRegistrationRequirement?->commercial_registration)
            <a href="{{ route('admin.download.file', ['path' => $user->traderRegistrationRequirement?->commercial_registration, 'fileName' => $user->restaurant_name.' - Commercial registeration']) }}" class="btn btn-sm btn-khardl py-4 mx-2">
                <i class="fas fa-download"></i>
            </a>
            @endif
            <!--end::Download Link-->
        </div>
        <!--end::Flex Container-->

        <!--begin::Description-->
        <div class="text-muted fs-7">{{ __("Accept") }}: PDF, JPG, JPEG, PNG {{ __("size <= 25 MG") }}</div>
        <!--end::Description-->
    </div>

    <div class="mb-10 fv-row">
        <!--begin::Label-->
        <label class="required form-label">{{ __('commercial-registration-number')}}</label>
        <!--end::Label-->
        <!--begin::Input-->
        <input type="text" class="form-control" name="commercial_registration_number" value="{{ old('commercial_registration_number')  ?? ($user?->traderregistrationrequirement ? $user?->traderregistrationrequirement->commercial_registration_number:'') }}" required>
        <!--end::Input-->
        <!--end::Card body-->
    </div>
    <div class="mb-10 fv-row">
    <!--begin::Label-->
        <label class="form-label">{{ __('tax_registration_certificate')}}</label>
        <!--end::Label-->
        <!--begin::Flex Container-->
        <div class="d-flex align-items-center">
            <!--begin::Input-->
            <input type="file" class="form-control" name="tax_registration_certificate" accept=".pdf, .jpg, .jpeg, .png">
            <!--end::Input-->
            <!--begin::Download Link-->
            @if ($user?->traderRegistrationRequirement?->tax_registration_certificate)
            <a href="{{ route('admin.download.file', ['path' => $user->traderRegistrationRequirement?->tax_registration_certificate, 'fileName' => $user->restaurant_name.' - Tax registeration certificate']) }}" class="btn btn-sm btn-khardl py-4 mx-2">
                <i class="fas fa-download"></i>
            </a>
            @endif
            <!--end::Download Link-->
        </div>
        <!--end::Flex Container-->
        <!--begin::Description-->
        <div class="text-muted fs-7">{{__("Accept")}}: PDF, JPG, JPEG, PNG {{__("size <= 25 MG")}}</div>
        <!--end::Description-->
        <!--end::Card body-->
    </div>
    <div class="mb-10 fv-row">
        <!--begin::Label-->
        <label class="{{ $user?->traderregistrationrequirement ? '' : 'required'}}  form-label">{{ __('bank-certificate')}}</label>
        <!--end::Label-->
        <!--begin::Flex Container-->
        <div class="d-flex align-items-center">
            <!--begin::Input-->
            <input type="file" class="form-control" name="bank_certificate" accept=".pdf, .jpg, .jpeg, .png" {{ $user?->traderregistrationrequirement ? '' : 'required'}}>
            <!--end::Input-->
            <!--begin::Download Link-->
            @if ($user?->traderRegistrationRequirement?->bank_certificate)
            <a href="{{ route('admin.download.file', ['path' => $user->traderRegistrationRequirement?->bank_certificate, 'fileName' => $user->restaurant_name.' - Bank Certificate']) }}" class="btn btn-sm btn-khardl py-4 mx-2">
                <i class="fas fa-download"></i>
            </a>
            @endif
            <!--end::Download Link-->
        </div>
        <!--end::Flex Container-->
        <!--begin::Description-->
        <div class="text-muted fs-7">{{__("Accept")}}: PDF, JPG, JPEG, PNG {{__("size <= 25 MG")}}</div>
        <!--end::Description-->
        <!--end::Card body-->
    </div>
    <div class="mb-10 fv-row">
        <!--begin::Label-->
        <label class="required form-label">{{ __('Bank IBAN')}}</label>
        <!--end::Label-->
        <!--begin::Input-->
        <input type="text" class="form-control" name="IBAN" value="{{ old('IBAN') ?? ($user?->traderregistrationrequirement ? $user?->traderregistrationrequirement->IBAN:'')}}" required>
        <!--end::Input-->
        <!--end::Card body-->
    </div>
    <!--end::Content-->
    <div class="mb-10 fv-row">
        <!--begin::Label-->
        <label class="required form-label">{{ __('facility-name')}}</label>
        <!--end::Label-->
        <!--begin::Input-->
        <input type="text" class="form-control" name="facility_name" value="{{ old('facility_name') ?? ($user?->traderregistrationrequirement ? $user?->traderregistrationrequirement->facility_name:'') }}" required>
        <!--end::Input-->
        <!--end::Card body-->
    </div>
    <!--end::Content-->
    <div class="mb-10 fv-row">
        <!--begin::Label-->
        <label class="{{ $user?->traderregistrationrequirement ? '' : 'required'}}  form-label">{{ __('identity_of_owner_or_manager')}}</label>
        <!--end::Label-->
        <!--begin::Flex Container-->
        <div class="d-flex align-items-center">
            <!--begin::Input-->
            <input type="file" class="form-control" name="identity_of_owner_or_manager" accept=".pdf, .jpg, .jpeg, .png" {{ $user?->traderregistrationrequirement ? '' : 'required'}}>
            <!--end::Input-->
            <!--begin::Download Link-->
            @if ($user?->traderRegistrationRequirement?->identity_of_owner_or_manager)
            <a href="{{ route('admin.download.file', ['path' => $user->traderRegistrationRequirement?->identity_of_owner_or_manager, 'fileName' => $user->restaurant_name.' - Identity of owner or manager']) }}" class="btn btn-sm btn-khardl py-4 mx-2">
                <i class="fas fa-download"></i>
            </a>
            @endif
            <!--end::Download Link-->
        </div>
        <!--end::Flex Container-->
        <!--begin::Description-->
        <div class="text-muted fs-7">{{__("Accept")}}: PDF, JPG, JPEG, PNG {{__("size <= 25 MG")}}</div>
        <!--end::Description-->
        <!--end::Card body-->
    </div>
    <div class="mb-10 fv-row">
        <!--begin::Label-->
        <label class="required form-label">{{ __('National ID')}}</label>
        <!--end::Label-->
        <!--begin::Input-->
        <input type="text" class="form-control" name="national_id_number" value="{{ old('national_id_number') ?? ($user?->traderregistrationrequirement ? $user?->traderregistrationrequirement->national_id_number:'') }}" required>
        <!--end::Input-->
        <!--end::Card body-->
    </div>
    <div class="mb-10 fv-row">
        <!--begin::Label-->
        <label class="required form-label">{{ __('Date of birth')}}</label>
        <!--end::Label-->
        <!--begin::Input-->
        <input type="date" class="form-control" name="dob" value="{{ old('dob') ?? ($user?->dob!=null ? $user?->dob:'')}}" required>
        <!--end::Input-->
        <!--end::Card body-->
    </div>
    <div class="mb-10 fv-row">
        <!--begin::Label-->
        <label class="{{ $user?->traderregistrationrequirement ? '' : 'required'}} form-label">{{ __('national_address')}}</label>
        <!--end::Label-->
        <!--begin::Flex Container-->
        <div class="d-flex align-items-center">
            <!--begin::Input-->
            <input type="file" class="form-control" name="national_address" accept=".pdf, .jpg, .jpeg, .png" {{ $user?->traderregistrationrequirement ? '' : 'required'}}>
            <!--end::Input-->
            <!--begin::Download Link-->
            @if ($user?->traderRegistrationRequirement?->national_address)
            <a href="{{ route('admin.download.file', ['path' => $user->traderRegistrationRequirement?->national_address, 'fileName' => $user->restaurant_name.' - National Address']) }}" class="btn btn-sm btn-khardl py-4 mx-2">
                <i class="fas fa-download"></i>
            </a>
            @endif
            <!--end::Download Link-->
        </div>
        <!--end::Flex Container-->
        <!--begin::Description-->
        <div class="text-muted fs-7">{{__("Accept")}}: PDF, JPG, JPEG, PNG {{__("size <= 25 MG")}}</div>
        <!--end::Description-->
        <!--end::Card body-->
    </div>


</div>
