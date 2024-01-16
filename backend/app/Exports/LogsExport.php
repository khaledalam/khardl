<?php

namespace App\Exports;

use App\Models\Log;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class LogsExport implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $model;
    public function __construct($model)
    {
        $this->model = $model;
    }
    public function collection()
    {
        return $this->model;
    }
    public function headings(): array
    {
        return [
            __('messages.ID'),
            __('messages.User'),
            __('messages.Action'),
            __('messages.Type'),
            __('messages.Metadata'),
            __('messages.Date'),
        ];
    }

    public function map($log): array
    {
        return [
            $log->id,
            $log->user?->full_name,
            $log->action,
            __('messages.'.$log->type),
            $log->metadata,
            $log->created_at?->format('Y-m-d H'),
        ];
    }
}
