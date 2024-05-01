<?php

namespace App\Http\Services\tenant\QR;

use App\Models\Tenant\QrCode;
use Illuminate\Support\Facades\Http;
use Illuminate\Http\Request;
use App\Models\Tenant\Setting;
use Illuminate\Support\Facades\Auth;
use App\Models\Tenant\RestaurantUser;
use Illuminate\Support\Facades\Storage;
use App\Models\ROSubscription;
use App\Traits\APIResponseTrait;
class QRService
{
    use APIResponseTrait;
    private function qrCanAccess()
    {
        return Setting::first()?->is_live && ROSubscription::first()?->status == ROSubscription::ACTIVE;
    }

    public function index()
    {
        if (!$this->qrCanAccess()) {
            return redirect()->route('restaurant.summary')->with('error', __('You are not allowed to access this page'));
        }

        /** @var RestaurantUser $user */
        $user = Auth::user();
        $qrcodes = QrCode::orderBy('id', 'desc')->paginate(10);

        return view(
            'restaurant.qr',
            compact('user', 'qrcodes')
        );
    }


    public function create(Request $request){

        if (!$this->qrCanAccess()) {
            return redirect()->route('restaurant.summary')->with('error', __('You are not allowed to access this page'));
        }

        $imageUrl = "";
        if (file_exists($request->file("file"))) {
            $response = Http::withHeaders([
                "X-RapidAPI-Host" => "qrcode-monkey.p.rapidapi.com",
                "X-RapidAPI-Key" => "f72e221083msh5ff50679b312fbap131e53jsna069e8de315b",
            ])->attach('file', $request->file('file')->getPathname(), $request->file('file')->getClientOriginalName())
                ->post("https://qrcode-monkey.p.rapidapi.com/qr/uploadImage");


            if ($response->successful()) {

                $uploadedFile = $request->file('file'); //Instead of before taking $response->json and taking the "file" name from the response, I now tried uploading image to the server and getting logo made by inputing URL not fileName I get from this api


//                $imagePath = uniqid('', false) . '.' . $uploadedFile->getClientOriginalExtension();
//                Storage::disk('qrcodes')->put($imagePath, file_get_contents($uploadedFile));

                $imageUrl = tenant_asset(store_image($uploadedFile, QrCode::STORAGE, uniqid('', true)));
            } else {
                return "cURL Error 1 #: " . $response->status();
            }
        }


        $gradientColor1 = "";
        $gradientColor2 = "";

        if($request->input('single_color') == 0){
            $gradientColor1 = $request->input('bodyColor');
            $gradientColor2 = $request->input('gradientColor2');
        }

        $logoMode = "default";

        if($request->input("logoMode") == 1){
            $logoMode = "clean";
        }

        $gradientOnEyes = $request->input('single_color') == 0 ? true : false;

        $response = Http::withHeaders([
            "X-RapidAPI-Host" => "qrcode-monkey.p.rapidapi.com",
            "X-RapidAPI-Key" => "f72e221083msh5ff50679b312fbap131e53jsna069e8de315b",
        ])->post('https://qrcode-monkey.p.rapidapi.com/qr/custom', [
            "data" => $request->input('data'),
            "config" => [
                'body' => $request->input('body'),
                'eye' => $request->input('eye'),
                'eyeBall' => $request->input('eyeBall'),
                "erf1" => [],
                "erf2" => ['fh'],
                "erf3" => ['fv'],
                "brf1" => [],
                "brf2" => ['fh'],
                "brf3" => ['fv'],
                'bodyColor' => $request->input("bodyColor"),
                "bgColor" => $request->input("bgColor"),
                "eye1Color" => $request->input('eyeColor'),
                "eye2Color" => $request->input('eyeColor'),
                "eye3Color" => $request->input('eyeColor'),
                "eyeBall1Color" => $request->input('eyeBallColor'),
                "eyeBall2Color" => $request->input('eyeBallColor'),
                "eyeBall3Color" => $request->input('eyeBallColor'),
                "gradientColor1" => $gradientColor1,
                "gradientColor2" => $gradientColor2,
                "gradientType" => "linear",
                "gradientOnEyes" => $gradientOnEyes,
                //Putting an actual link to a working picture as test to see does it work on a picture that is accessible, so its not my local host
                "logo" => $imageUrl, // 'https://www.fnordware.com/superpng/pnggrad16rgb.png',
                "logoMode" => $logoMode
            ],
            "size" => $request->input('size'),
            "download" => "true",
            "file" => "png"
        ]);


        if ($response->successful()) {
            $imageContent = $response->body();

            // short uuid
//            $imageUrl = tenant_asset(store_image($uploadedFile, QrCode::STORAGE, uniqid('', false)));

            $imageName = uniqid('', false) . '.png';
            Storage::disk(QrCode::STORAGE)->put($imageName, $imageContent);

            $qrCode = QrCode::create([
                'image_path' => $imageName,
                'url' => $request->input('data'),
                'name' => $request->input('name'),
            ]);

            return redirect()->route("restaurant.qr")
                ->with('success',__('QR Code has been created successfully'));
        }

        return "cURL Error 2 #: " . $response->status();
    }

    public function download($id)
    {
        if (!$this->qrCanAccess()) {
            return redirect()->route('restaurant.summary')->with('error', __('You are not allowed to access this page'));
        }

        $qr = QrCode::findOrFail($id);
        $fileName = $qr->image_path;

        if (!Storage::disk(QrCode::STORAGE)->exists($fileName)) {
            abort(404);
        }

        $fileContents = Storage::disk(QrCode::STORAGE)->get($fileName);

        return response($fileContents)
            ->header('Content-Type', 'image/png')
            ->header('Content-Disposition', 'attachment; filename="' . $fileName . '"');

    }
}
