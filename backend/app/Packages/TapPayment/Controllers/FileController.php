<?php

namespace App\Packages\TapPayment\Controllers;

use App\Http\Controllers\Controller;
use App\Packages\TapPayment\File\File;
use App\Packages\TapPayment\Requests\CreateFileRequest;

class FileController extends Controller
{
    public function store(CreateFileRequest $request){
        return File::create($request->validated());
    }
    public function show($file_id){
        return File::retrieve($file_id);
    }
    public function dummy_data(){
        return [
            'headers' => [
                'Authorization' => 'Bearer sk_test_XKokBfNWv6FIYuTMg5sLPjhJ',
                'accept' => 'application/json',
                'expires_at' => '1913743462',
                'file' => 'file_990913504414658560',
                'file_link_create' => 'true',
                'file_link_meta_data' => 'file=@"/path/to/file"',
                'purpose' => 'identity_document',
                'title' => 'Civil ID',
              ],
        ];
    }
    
}
