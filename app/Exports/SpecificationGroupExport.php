<?php

namespace App\Exports;

use App\Models\Master\Specification\SpecificationGroup;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class SpecificationGroupExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $vendor_id;

    public function __construct($vendor_id = null)
    {
        $this->vendor_id = $vendor_id;
    }

    public function collection()
    {
        $query = SpecificationGroup::leftJoin('vendor_details', function ($join) {
                $join->on('specification_group.created_byid', '=', 'vendor_details.id')
                     ->where('specification_group.created_by', '=', 'Vendor');
            })
            ->select('specification_group.*', 'vendor_details.shop_name as vendor_name');

        if ($this->vendor_id) {
            $vendorcreate = \App\Models\vendor\vendorcreate::select('sub_category_ids')->where('id', $this->vendor_id)->first();
            $vendorSubCategoryIds = array_values(array_filter(array_map('intval', array_map('trim', explode(',', (string) optional($vendorcreate)->sub_category_ids)))));

            $query->where(function($q) use ($vendorSubCategoryIds) {
                $q->where(function ($ownQ) {
                    $ownQ->where('specification_group.created_by', 'Vendor')
                         ->where('specification_group.created_byid', $this->vendor_id);
                })
                ->orWhere(function ($adminQ) use ($vendorSubCategoryIds) {
                    $adminQ->where('specification_group.created_by', 'Admin');
                    if (!empty($vendorSubCategoryIds)) {
                        $adminQ->where(function ($subQ) use ($vendorSubCategoryIds) {
                            $subQ->whereNull('specification_group.sub_category_ids')
                                 ->orWhere('specification_group.sub_category_ids', '')
                                 ->orWhereRaw("FIND_IN_SET(?, specification_group.vendor_ids)", [$this->vendor_id]);
                            foreach ($vendorSubCategoryIds as $subId) {
                                $subQ->orWhereRaw("FIND_IN_SET(?, specification_group.sub_category_ids)", [$subId]);
                            }
                        });
                    }
                });
            });
        }

        return $query->orderBy('specification_group.id', 'desc')->get();
    }

    public function headings(): array
    {
        return [
            'ID',
            'Name',
            'Reference Name',
            'Specifications / Values',
            'Created By',
            'Vendor / Shop Name',
            'Status',
            'Created Date'
        ];
    }

    public function map($row): array
    {
        $values = '';
        if (!empty($row->specification_values)) {
            $decoded = json_decode($row->specification_values, true);
            if (is_array($decoded)) {
                $values = implode(', ', $decoded);
            } else {
                $values = (string) $row->specification_values;
            }
        }

        return [
            str_pad($row->id, 4, '0', STR_PAD_LEFT),
            $row->specification_group_name ?? '',
            $row->specification_group_refname ?? '',
            $values,
            $row->created_by ?? 'Admin',
            $row->vendor_name ?? '',
            $row->status ?? 'Active',
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
