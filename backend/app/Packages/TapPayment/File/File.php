<?php

namespace App\Packages\TapPayment\File;

use App\Packages\TapPayment\Tap;
use App\Packages\TapPayment\File\FileInterface;


class File extends Tap implements FileInterface
{
    public static function create($data):array{
        return self::send('/files',$data);
    }
    public static function retrieve(string $file_id): array {
        return self::send('/files/file_id',[
            'file_id'=>$file_id
        ],'get');
    }

}