<?php

namespace App\Packages\TapPayment\Business;

use App\Packages\TapPayment\Tap;
use App\Packages\TapPayment\Business\BusinessInterface;
use App\Packages\TapPayment\Requests\CreateBusinessRequest;

class File extends Tap implements FileInterface
{
    public static function create($data):array{
        return self::send('/files',$data);
    }
    public static function retrieve(string $file_id): array {
        return [];
    }

}