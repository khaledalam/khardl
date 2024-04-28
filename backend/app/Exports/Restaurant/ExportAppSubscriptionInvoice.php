<?php

namespace App\Exports\Restaurant;

use App\Models\ROSubscriptionInvoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportAppSubscriptionInvoice implements FromCollection,  WithHeadings, WithMapping
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
            __('Package'),
            __('Status'),
            __('Price'),
            __('Date'),
        ];
    }

    public function map($invoice): array
    {
        return [
            $invoice->subscription?->name,
            __('' . $invoice->status),
            ($invoice->discount ??  $invoice->amount ).' '.__('SAR'),
            $invoice->created_at?->format('Y-m-d'),
        ];
    }
}
