<?php

namespace App\Exports;

use App\Models\Ecom_Orders;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class OrderExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        return Ecom_Orders::orderBy('id', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'Order ID',
            'Customer Name',
            'Mobile',
            'Payment Type',
            'Grand Total',
            'Order Status',
            'Payment Status',
            'Order Date'
        ];
    }

    public function map($row): array
    {
        return [
            $row->order_id ?? ('#' . $row->id),
            trim(($row->customer_firstname ?? '') . ' ' . ($row->customer_lastname ?? '')),
            $row->customer_mobileno ?? '',
            $row->payment_type ?? '',
            $row->grand_total ?? 0,
            $row->order_status ?? '',
            $row->payment_status ?? '',
            $row->created_at ? $row->created_at->format('Y-m-d H:i:s') : ($row->order_date ?? '')
        ];
    }

    public function styles(Worksheet $sheet)
    {
        return [
            1 => [
                'font' => ['bold' => true, 'color' => ['argb' => 'FFFFFFFF']],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['argb' => 'FF183543']
                ]
            ],
        ];
    }
}
