<?php

namespace App\Http\Controllers;

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
                        $filesToZip = Storage::disk('private')->allFiles($path);
                        foreach ($filesToZip as $file) {
                            $zip->addFile(storage_path("app/private/$file"), basename($file));
                        }
                        $zip->close();
                        return response()->download($zip_path)->deleteFileAfterSend(true);
                    }
                }
            }
        }catch(Exception $e){

        }
        return redirect()->back()->with('error',__('failed to download'));

    }
    public function downloadPDF(PdfPrintInterface $repository){
        try{
            $pdf = PDF::loadView($repository->view(),['data'=>$repository->data()]);

            return $pdf->stream($repository->fileName());
        }  catch(Exception $e){

            return redirect()->back()->with('error',__('failed to download'));
        }
    }
}
