<?php

namespace App\Exports;

use App\Models\coupon\coupon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CouponExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        return coupon::orderBy('id', 'asc')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Coupon Title',
            'Coupon Code',
            'Discount Type',
            'Discount Amount',
            'Discount Percentage',
            'Status',
            'Created Date'
        ];
    }

    public function map($row): array
    {
        return [
            str_pad($row->id, 4, '0', STR_PAD_LEFT),
            $row->title ?? '',
            $row->coupon_code ?? '',
            $row->discount_type ?? '',
            $row->discount_amount ?? '',
            $row->discount_percentage ?? '',
            $row->status == 1 ? 'Active' : 'Inactive',
            $row->created_at ? $row->created_at->format('Y-m-d H:i:s') : ''
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
