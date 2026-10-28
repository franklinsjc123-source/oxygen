<?php

namespace App\Exports;

use App\Models\Category\CategorySub;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CategorySubExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return CategorySub::leftJoin('category_main', 'category_sub.category_main_id', '=', 'category_main.id')
            ->leftJoin('category', 'category_sub.category_id', '=', 'category.id')
            ->select('category_sub.*', 'category_main.category_main_name', 'category.category_name')
            ->where('category_sub.flag', '!=', 2)
            ->orderBy('category_sub.category_sub_sortorder', 'asc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Main Category',
            'Category',
            'Sub Category Name',
            'Meta Keywords',
            'Sort Order',
            'Status',
            'Image',
            'Created Date'
        ];
    }

    public function map($subCategory): array
    {
        return [
            str_pad($subCategory->id, 4, '0', STR_PAD_LEFT),
            $subCategory->category_main_name ?? '',
            $subCategory->category_name ?? '',
            $subCategory->category_sub_name ?? '',
            $subCategory->category_sub_keywords ?? '',
            $subCategory->category_sub_sortorder ?? 0,
            $subCategory->status == 1 ? 'Active' : 'Inactive',
            $subCategory->category_sub_image ?? '',
            $subCategory->created_at ? $subCategory->created_at->format('Y-m-d H:i:s') : ''
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
