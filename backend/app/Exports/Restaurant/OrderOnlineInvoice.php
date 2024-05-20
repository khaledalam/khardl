<?php

namespace App\Exports\Restaurant;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class OrderOnlineInvoice implements FromCollection,  WithHeadings, WithMapping
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
            __('Order ID'),
            __('Customer'),
            __('Total'),
            __('Date'),
        ];
    }

    public function map($invoice): array
    {
        return [
            strval('#'.$invoice->id),
            $invoice->user?->full_name,
            $invoice->total.' '.__('SAR'),
            $invoice->created_at?->format('Y-m-d'),
        ];
    }
}
