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
        $googleMapsApiKey = env('GOOGLE_MAPS_API_KEY');

        $url = "https://maps.googleapis.com/maps/api/geocode/json?latlng={$lat},{$lng}&key={$googleMapsApiKey}";

//        $ch = curl_init();
//        curl_setopt($ch, CURLOPT_URL, $url);
//
//        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
//        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, TRUE);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
//        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST,  2);
//        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET");
//
//        $response = curl_exec($ch);

        $response = file_get_contents($url);


        if($response === false) {
//            $error = curl_error($ch);
            return $this->sendError('Request Error.', 'Error: Unable to retrieve address request.');
        }

//        curl_close($ch);

        $data = json_decode($response, true);

        if ($data['status'] === 'OK') {
            return $data['results'][0]['formatted_address']
                ?? $data['geocode']?->plus_code?->compound_code
                ?? "$lat,$lng";
        }

        return $this->sendError('Request Error.', 'Error: Unable to retrieve address.');

        // geocode?.results[0]?.formatted_address || geocode?.plus_code?.compound_code || `${lat},${lng}`

    }
}
