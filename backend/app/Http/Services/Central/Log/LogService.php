<?php

namespace App\Http\Services\Central\Log;

use Carbon\Carbon;
use Illuminate\Http\Request;
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

        return view('admin.logs', compact('user', 'logs', 'owners'));
    }
    private function handleDownload($request, $model)
    {
        try {
            $todayDate = Carbon::now()->format('Y-m-d');
            $filename = "logs_$todayDate.csv";
            $handle = fopen($filename, 'w+');
            fputcsv($handle, array('Customer', 'Action', 'Metadata', 'Date'));
            foreach ($model as $row) {
                fputcsv($handle, array($row->user?->full_name, $row['action'], $row['metadata'], $row->created_at?->format('Y-m-d H')));
            }
            fclose($handle);
            $headers = array(
                'Content-Type' => 'text/csv',
            );
            return Response::download($filename, $filename, $headers);
        } catch (\Exception $e) {
            logger($e);
            return redirect()->route('log');
        }
    }
}
