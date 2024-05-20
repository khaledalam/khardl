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
        if ($request->input('session') == 'success') {
            session()->flash('success', 'The summary has been refreshed successfully!');
        }

        return $this->summaryService->index($request);
    }

}
