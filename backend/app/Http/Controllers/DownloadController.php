<?php

namespace App\Http\Controllers;

use App\Models\TraderRequirement;
use App\Utils\OrdersLocationsHelper;
use Exception;
use ZipArchive;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use App\Repositories\PDF\PdfPrintInterface;
use Carbon\Carbon;
use PDF;
class DownloadController extends Controller
{
    public function download($path,Request $request){
        try{
            if (Storage::disk('private')->exists($path)) {
                $storage_path = storage_path("app/private/$path");
                if (File::isFile($storage_path)) {

                    if($request->has('fileName')){
                        $extension = pathinfo($storage_path, PATHINFO_EXTENSION);

                        $fileName = $request->fileName.' '.Carbon::now()->format('d-m-Y h:i a').'.'.$extension;
                        return response()->download($storage_path,$fileName);
                    }
                    return response()->download($storage_path);
                } elseif (File::isDirectory($storage_path)) {
                    $zip = new ZipArchive;
                    $zipFileName = 'files.zip';
                    if($request->has('fileName')){
                        $zipFileName = $request->fileName.' '.Carbon::now()->format('d-m-Y h:i a').'.zip';
                    }
                    $zip_path = $storage_path.'/'.$zipFileName;
                    if ($zip->open($zip_path, ZipArchive::CREATE) === TRUE) {
                        $user_id = explode('/',$path)[1];
                        $tradeFiles = TraderRequirement::where('user_id',$user_id)->first();
                        $fieldsToCheck = [
                            'commercial_registration',
                            'tax_registration_certificate',
                            'bank_certificate',
                            'identity_of_owner_or_manager',
                            'national_address'
                        ];
                        foreach ($fieldsToCheck as $field) {
                            if (!empty($tradeFiles->$field)) {
                                $filePath = storage_path("app/private/{$tradeFiles->$field}");
                                if (file_exists($filePath)) {
                                    $zip->addFile($filePath, basename($filePath));
                                }
                            }
                        }
                        $zip->close();
                        return response()->download($zip_path)->deleteFileAfterSend(true);
                    }
                }
            }
        }catch(Exception $e){
            \Sentry\captureMessage('failed to download '. json_encode($e->getMessage()));
        }
        return redirect()->back()->with('error',__('failed to download'));

    }

    function array_to_csv_download($data, $filename = "locations_.csv", $delimiter=";") {
        $f = fopen('php://memory', 'w');

        $rank = 1;
        fputcsv($f, ['City', 'Region', 'Country', 'Orders Count', 'Rank'], $delimiter);
        foreach ($data as $country => $countryList) {
            foreach ($countryList as $city => $cityList) {
                foreach ($cityList as $region => $ordersCount) {
                    fputcsv($f, [$city, $region, $country, $ordersCount, $rank++], $delimiter);
                }
            }
        }

        fseek($f, 0);
        header('Content-Type: text/csv');
        header('Content-Disposition: attachment; filename="'.$filename.'";');
        fpassthru($f);
    }

    public function locationDownload(Request $request) {

        $customerByLocationByLocation = OrdersLocationsHelper::getCustomerOrdersByLocation($request);

        $this->array_to_csv_download($customerByLocationByLocation, "locations_" . date('Y-m-d') . ".csv");

    }

    public function downloadPDF(PdfPrintInterface $repository){
        try{
            $pdf = PDF::loadView($repository->view(),['data'=>$repository->data()]);

            return $pdf->stream($repository->fileName());
        }  catch(Exception $e){
            \Sentry\captureMessage('failed to download '. json_encode($e->getMessage()));
            return redirect()->back()->with('error',__('failed to download'));
        }
    }
}
