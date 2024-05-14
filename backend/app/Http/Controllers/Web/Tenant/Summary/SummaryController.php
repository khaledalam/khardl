<?php

namespace App\Http\Controllers\Web\Tenant\Summary;

use App\Http\Services\tenant\Summary\SummaryService;
use App\Http\Controllers\Web\BaseController;
use Illuminate\Http\Request;

class SummaryController extends BaseController
{
    public function __construct(
        private SummaryService $summaryService
    ) {
    }
    public function index(Request $request)
    {
        return $this->summaryService->index($request);
    }
}
