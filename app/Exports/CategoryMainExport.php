<?php

namespace App\Exports;

use App\Models\Category\CategoryMain;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CategoryMainExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return CategoryMain::where('flag', '!=', 2)
            ->where('created_byid', 1)
            ->orderBy('category_main_sortorder', 'asc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Category Name',
            'Meta Keywords',
            'Sort Order',
            'Status',
            'Image',
            'Created Date'
        ];
    }

    public function map($category): array
    {
        return [
            str_pad($category->id, 4, '0', STR_PAD_LEFT),
            $category->category_main_name ?? '',
            $category->category_main_keywords ?? '',
            $category->category_main_sortorder ?? 0,
            $category->status == 1 ? 'Active' : 'Inactive',
            $category->category_main_image ?? '',
            $category->created_at ? $category->created_at->format('Y-m-d H:i:s') : ''
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
