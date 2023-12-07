<?php

namespace App\Repositories\PDF;

interface PdfPrintInterface
{
    public function data();
    public function view():string;
    public function fileName():string;
}
