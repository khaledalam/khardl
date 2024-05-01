<?php

namespace App\Http\Controllers\Web\Tenant\Summary;

use App\Http\Services\tenant\Summary\SummaryService;
use App\Http\Controllers\Web\BaseController;


class SummaryController extends BaseController
{
    public function __construct(
        private SummaryService $summaryService
    ) {
    }
    public function index()
    {
        return $this->summaryService->index();
    }
}
