<?php

namespace App\Exports\Restaurant;

use App\Models\ROSubscriptionInvoice;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportSubscriptionInvoice implements FromCollection,  WithHeadings, WithMapping
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
            __('messages.Package'),
            __('messages.Status'),
            __('messages.Number of branches'),
            __('messages.Price'),
            __('messages.Date'),
        ];
    }

    public function map($invoice): array
    {
        return [
            $invoice->subscription?->name,
            __('messages.' . $invoice->status),
            $invoice->number_of_branches,
            $invoice->amount.' '.__('messages.SAR'),
            $invoice->created_at?->format('Y-m-d'),
        ];
    }
}
