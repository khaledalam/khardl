<?php

namespace App\Http\Controllers\API\Tenant;

use App\Models\Tenant\Setting;
use Illuminate\Http\Request;
use App\Traits\APIResponseTrait;
use App\Http\Controllers\Controller;


class PolicyAndTermsController extends Controller
{
    use APIResponseTrait;

    public function update_privacy_and_policy(Request $request)
    {
        $request->validate([
            'privacy_and_policy.ar' => 'required|string',
            'privacy_and_policy.en' => 'required|string',
        ]);

        Setting::first()->update([
            'privacy_and_policy' => $request->privacy_and_policy
        ]);
        return $this->sendResponse(null, __('Updated successfully'));
    }
    public function update_terms_and_conditions(Request $request)
    {
        $request->validate([
            'terms_and_conditions.ar' => 'required|string',
            'terms_and_conditions.en' => 'required|string',
        ]);

        Setting::first()->update([
            'terms_and_conditions' => $request->terms_and_conditions
        ]);
        return $this->sendResponse(null, __('Updated successfully'));
    }

    public function get_privacy_and_policy(Request $request)
    {
        return $this->sendResponse(Setting::first()?->getTranslations('privacy_and_policy'));
    }
    public function get_terms_and_conditions(Request $request)
    {
        return $this->sendResponse(Setting::first()?->getTranslations('terms_and_conditions'));
    }

}
