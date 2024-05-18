<?php

namespace App\Http\Controllers\Web\Tenant\QR;

use App\Http\Services\tenant\QR\QRService;
use Illuminate\Http\Request;
use App\Http\Controllers\Web\BaseController;


class QRController extends BaseController
{
    public function __construct(
        private QRService $QRService
    ) {
    }
    public function index()
    {
        return $this->QRService->index();
    }

    public function create(Request $request){
        return $this->QRService->create($request);
    }

    public function download($id)
    {
        return $this->QRService->download($id);
    }
    public function delete($id)
    {
        return $this->QRService->delete($id);
    }

}
