<?php

namespace App\Http\Services\Central\Log;

use App\Enums\Admin\LogTypes;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;
use App\Models\User;
use App\Models\Log;
use Illuminate\Support\Facades\Auth;


class LogService
{
    public function getList(Request $request)
    {
        $logs = Log::with(['user'])
            ->whenUser($request['user_id'] ?? null)
            ->whenAction($request['action'] ?? null)
            ->recent()
            ->paginate($request['perPage'] ? (int) $request['perPage'] : config('application.perPage'));
        if ($request->filled('download') && $request->input('download') == 'csv')
            return $this->handleDownload($request, $logs);
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

            // Ensure the directory exists or create it
            $csvDirectory = storage_path('app/csv');
            File::makeDirectory($csvDirectory, $mode = 0755, true, true);

            $filePath = storage_path("app/csv/$filename");
            $handle = fopen($filePath, 'w+');

            fputcsv($handle, array('Customer', 'Action', 'Metadata', 'Date'));

            foreach ($model as $row) {
                fputcsv($handle, array($row->user?->full_name, $row['action'], $row['metadata'], $row->created_at?->format('Y-m-d H')));
            }

            fclose($handle);

            $headers = [
                'Content-Type' => 'text/csv',
            ];

            return response()->download($filePath, $filename, $headers);
        } catch (\Exception $e) {
            logger($e);
            return redirect()->route('admin.log');
        }
    }
}
