<?php

namespace App\Http\Controllers\Web\Central\Admin\Log;

use App\Http\Controllers\Controller;
use App\Http\Services\Central\Admin\Log\LogService;
use Illuminate\Http\Request;

class LogController extends Controller

{
    public function __construct(private LogService $logService) {
    }
    public function logs(Request $request)
    {
        return $this->logService->getList($request);
    }
}
