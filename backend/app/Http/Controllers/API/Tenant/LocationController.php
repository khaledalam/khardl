<?php

namespace App\Http\Controllers\API\Tenant;

use App\Enums\Admin\LogTypes;
use App\Http\Controllers\Controller;
use App\Jobs\SendContactUsEmailJob;
use App\Models\ContactUs;
use App\Models\Log;
use App\Traits\APIResponseTrait;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class LocationController extends Controller
{
    use APIResponseTrait;

    public function convertLatLngToAddress(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'lat' => ['required','regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/'],
            'lng' => ['required','regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/']
        ]);

        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }

        $inputs = $request->all();
        $lat = $inputs['lat'];
        $lng = $inputs['lng'];

        $response = convertLatLngToAddress($lat, $lng);

        if($response === false) {
            return $this->sendError('Request Error.', 'Error: Unable to retrieve address request.');
        }

        if ($response['status'] === 'OK') {
            return $response['results'][0]['formatted_address']
                ?? $response['geocode']?->plus_code?->compound_code
                ?? "$lat,$lng";
        }

        return $this->sendError('Request Error.', 'Error: Unable to retrieve address.');

        // geocode?.results[0]?.formatted_address || geocode?.plus_code?.compound_code || `${lat},${lng}`

    }
}
