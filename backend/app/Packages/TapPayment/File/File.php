<?php

namespace App\Packages\TapPayment\File;

use Carbon\Carbon;
use App\Packages\TapPayment\Tap;
use App\Packages\TapPayment\File\FileInterface;


class File extends Tap implements FileInterface
{
    public static function create($data):array{
        return self::send('/files',[
            'file_link_create' => true,
            'expires_at' => Carbon::now()->addMonths(1)->timestamp,
        ]+$data,'post',true);
    }
    public static function retrieve(string $file_id): array {
        return self::send('/files/file_id',[
            'file_id'=>$file_id
        ]);
    }

}