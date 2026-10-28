<?php

namespace App\Exports;

use App\Models\Category\Category;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CategoryExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Category::join('category_main', 'category.main_category_id', '=', 'category_main.id')
            ->select('category.*', 'category_main.category_main_name')
            ->where('category.created_byid', 1)
            ->where('category.flag', '!=', 2)
            ->orderBy('category.category_sortorder', 'asc')
            ->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Main Category',
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
            $category->category_name ?? '',
            $category->category_keywords ?? '',
            $category->category_sortorder ?? 0,
            $category->status == 1 ? 'Active' : 'Inactive',
            $category->category_image ?? '',
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
