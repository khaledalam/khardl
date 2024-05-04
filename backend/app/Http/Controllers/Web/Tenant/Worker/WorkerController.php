<?php

namespace App\Http\Controllers\Web\Tenant\Worker;

use App\Http\Controllers\Web\BaseController;
use App\Http\Requests\RegisterWorkerRequest;
use App\Http\Services\tenant\Worker\WorkerService;


class WorkerController extends BaseController
{
    public function __construct(
        private WorkerService $workerService
    ) {
    }
    public function workers($branchId)
    {
        return $this->workerService->workers($branchId);
    }
    public function addWorker($branchId)
    {
        return $this->workerService->addWorker($branchId);
    }
    public function generateWorker(RegisterWorkerRequest $request, $branchId)
    {
        return $this->workerService->generateWorker($request, $branchId);
    }
    public function deleteWorker($id)
    {
        return $this->workerService->deleteWorker($id);
    }
    public function updateWorker(RegisterWorkerRequest $request, $id)
    {
        return $this->workerService->updateWorker($request, $id);
    }
    public function editWorker($id)
    {
        return $this->workerService->editWorker($id);
    }
}
