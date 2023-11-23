<?php

namespace App\Packages\TapPayment\Business;

use App\Packages\TapPayment\Requests\CreateFileRequest;
use App\Packages\TapPayment\Requests\CreateBusinessRequest;

interface FileInterface
{
    public static function create(CreateFileRequest $request):array;
    public static function retrieve(string $file_id):array;

}
