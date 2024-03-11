<?php

namespace App\Http\Controllers\API\Tenant\Profile;

use App\Http\Controllers\Controller;
use App\Traits\APIResponseTrait;
use Illuminate\Http\Request;


class ProfileController extends Controller
{
    use APIResponseTrait;
    public function changeLang(Request $request)
    {
        $request->validate([
            'default_lang' => ['required','in:ar,en']
        ]);
        getAuth()->update(['default_lang' => $request->default_lang]);
        return $this->sendResponse('',__('Updated successfully'));
    }
}
