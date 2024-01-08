<?php

namespace App\Http\Services\Central\Admin\Log;

use App\Enums\Admin\LogTypes;
use App\Exports\LogsExport;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Models\User;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;


class LogService
{
    public function getList(Request $request)
    {
        $logs = Log::with(['user'])
            ->whenUser($request['user_id'] ?? null)
            ->whenAction($request['action'] ?? null)
            ->recent();

        if ($request->filled('download') && $request->input('download') == 'csv'){
            return $this->handleDownload($request, $logs);
        }

        $logs = $logs->paginate($request['perPage'] ? (int) $request['perPage'] : config('application.perPage'));
        $owners = User::get();
        $user = Auth::user();
        $logTypes = LogTypes::values();
        return view('admin.logs', compact('user', 'logs', 'owners','logTypes'));
    }
    private function handleDownload($request, $model)
    {
        try {
            $todayDate = Carbon::now()->format('Y-m-d');
            $filename = "logs_$todayDate.csv";

            return Excel::download(new LogsExport($model->get()), $filename);
        } catch (\Exception $e) {
            logger($e);
            return redirect()->route('admin.log');
        }
    }
}
