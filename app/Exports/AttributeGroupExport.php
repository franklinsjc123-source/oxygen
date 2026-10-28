<?php

namespace App\Exports;

use App\Models\Master\Attribute\AttributeGroup;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class AttributeGroupExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    public function collection()
    {
        return AttributeGroup::orderBy('id', 'asc')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Reference Name',
            'Attributes / Values',
            'Status',
            'Created By',
            'Created Date'
        ];
    }

    public function map($row): array
    {
        $values = '';
        if (!empty($row->attribute_values)) {
            $decoded = json_decode($row->attribute_values, true);
            if (is_array($decoded)) {
                $values = implode(', ', $decoded);
            } else {
                $values = (string) $row->attribute_values;
            }
        }

        return [
            str_pad($row->id, 4, '0', STR_PAD_LEFT),
            $row->attribute_group_name ?? '',
            $row->attribute_group_refname ?? '',
            $values,
            $row->status ?? 'Active',
            $row->created_by ?? 'Admin',
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
