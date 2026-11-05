<?php

namespace App\Exports;

use App\Models\Category\CategorySub;
use App\Models\Master\Attribute\AttributeGroup;
use App\Models\Master\Specification\SpecificationGroup;
use App\Models\vendor\vendorcreate;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class CategorySubExport implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithStyles
{
    protected $vendor_id;
    protected $attributeGroups;
    protected $specificationGroups;
    protected $mappings;

    public function __construct($vendor_id = null)
    {
        $this->vendor_id = $vendor_id;
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        // Pre-fetch attribute and specification groups for fast in-memory lookup
        $this->attributeGroups = AttributeGroup::all()->keyBy('id');
        $this->specificationGroups = SpecificationGroup::all()->keyBy('id');

        if ($this->vendor_id) {
            $this->mappings = DB::table('sub_category_mapping')
                ->where(function ($q) {
                    $q->where('vendor_id', $this->vendor_id)->orWhereNull('vendor_id');
                })
                ->get();

            $vendor = vendorcreate::select('sub_category_ids')->where('id', $this->vendor_id)->first();
            $subIds = array_values(array_filter(array_map('intval', array_map('trim', explode(',', (string) optional($vendor)->sub_category_ids)))));

            $query = CategorySub::leftJoin('category_main', 'category_sub.category_main_id', '=', 'category_main.id')
                ->leftJoin('category', 'category_sub.category_id', '=', 'category.id')
                ->select('category_sub.*', 'category_main.category_main_name', 'category.category_name')
                ->where('category_sub.flag', '!=', 2);

            if (!empty($subIds)) {
                $query->whereIn('category_sub.id', $subIds);
            } else {
                $query->whereRaw('1=0');
            }

            return $query->orderBy('category_sub.category_sub_sortorder', 'asc')->get();
        } else {
            $this->mappings = DB::table('sub_category_mapping')
                ->whereNull('vendor_id')
                ->get();

            return CategorySub::leftJoin('category_main', 'category_sub.category_main_id', '=', 'category_main.id')
                ->leftJoin('category', 'category_sub.category_id', '=', 'category.id')
                ->select('category_sub.*', 'category_main.category_main_name', 'category.category_name')
                ->where('category_sub.flag', '!=', 2)
                ->orderBy('category_sub.category_sub_sortorder', 'asc')
                ->get();
        }
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
            'Attributes',
            'Specifications',
            'Image',
            'Created Date'
        ];
    }

    public function map($subCategory): array
    {
        $subId = $subCategory->id;
        $selectedAttributeIds = [];
        $selectedSpecificationIds = [];

        if ($this->vendor_id) {
            // 1. Check vendor-specific mapping
            $vendorMapping = $this->mappings->first(function ($m) use ($subId) {
                return $m->sub_category_id == $subId && $m->vendor_id == $this->vendor_id;
            });

            if ($vendorMapping) {
                $attrData = json_decode($vendorMapping->category_sub_attribute_ids, true);
                $specData = json_decode($vendorMapping->category_sub_specification_ids, true);
                if (is_array($attrData)) $selectedAttributeIds = array_values(array_filter(array_map('intval', $attrData)));
                if (is_array($specData)) $selectedSpecificationIds = array_values(array_filter(array_map('intval', $specData)));
            } else {
                // Admin fallback mapping
                $adminMapping = $this->mappings->first(function ($m) use ($subId) {
                    return $m->sub_category_id == $subId && is_null($m->vendor_id);
                });
                $adminAttrs = $adminMapping ? (json_decode($adminMapping->category_sub_attribute_ids, true) ?: []) : [];
                $adminSpecs = $adminMapping ? (json_decode($adminMapping->category_sub_specification_ids, true) ?: []) : [];

                $globalAttrIds = $this->attributeGroups ? $this->attributeGroups->filter(function ($ag) use ($subId) {
                    return $ag->created_by === 'Admin' && in_array((string)$subId, array_filter(explode(',', (string)$ag->sub_category_ids)));
                })->pluck('id')->toArray() : [];

                $globalSpecIds = $this->specificationGroups ? $this->specificationGroups->filter(function ($sg) use ($subId) {
                    return $sg->created_by === 'Admin' && in_array((string)$subId, array_filter(explode(',', (string)$sg->sub_category_ids)));
                })->pluck('id')->toArray() : [];

                $defaultAttrIds = !empty($subCategory->category_sub_attributes)
                    ? array_filter(array_map('intval', explode(',', (string)$subCategory->category_sub_attributes)))
                    : [];
                $defaultSpecIds = !empty($subCategory->category_sub_specifications)
                    ? array_filter(array_map('intval', explode(',', (string)$subCategory->category_sub_specifications)))
                    : [];

                $selectedAttributeIds = array_values(array_unique(array_merge($adminAttrs, $globalAttrIds, $defaultAttrIds)));
                $selectedSpecificationIds = array_values(array_unique(array_merge($adminSpecs, $globalSpecIds, $defaultSpecIds)));
            }

            // Merge vendor's own created groups assigned to this subcategory
            $vendorAttrIds = $this->attributeGroups ? $this->attributeGroups->filter(function ($ag) use ($subId) {
                return $ag->created_byid == $this->vendor_id && in_array((string)$subId, array_filter(explode(',', (string)$ag->sub_category_ids)));
            })->pluck('id')->toArray() : [];

            $vendorSpecIds = $this->specificationGroups ? $this->specificationGroups->filter(function ($sg) use ($subId) {
                return $sg->created_byid == $this->vendor_id && in_array((string)$subId, array_filter(explode(',', (string)$sg->sub_category_ids)));
            })->pluck('id')->toArray() : [];

            $selectedAttributeIds = array_values(array_unique(array_merge($selectedAttributeIds, $vendorAttrIds)));
            $selectedSpecificationIds = array_values(array_unique(array_merge($selectedSpecificationIds, $vendorSpecIds)));
        } else {
            // Admin / Staff mapping
            $adminMapping = $this->mappings->first(function ($m) use ($subId) {
                return $m->sub_category_id == $subId && is_null($m->vendor_id);
            });
            $adminAttrs = $adminMapping ? (json_decode($adminMapping->category_sub_attribute_ids, true) ?: []) : [];
            $adminSpecs = $adminMapping ? (json_decode($adminMapping->category_sub_specification_ids, true) ?: []) : [];

            $globalAttrIds = $this->attributeGroups ? $this->attributeGroups->filter(function ($ag) use ($subId) {
                return $ag->created_by === 'Admin' && in_array((string)$subId, array_filter(explode(',', (string)$ag->sub_category_ids)));
            })->pluck('id')->toArray() : [];

            $globalSpecIds = $this->specificationGroups ? $this->specificationGroups->filter(function ($sg) use ($subId) {
                return $sg->created_by === 'Admin' && in_array((string)$subId, array_filter(explode(',', (string)$sg->sub_category_ids)));
            })->pluck('id')->toArray() : [];

            $defaultAttrIds = !empty($subCategory->category_sub_attributes)
                ? array_filter(array_map('intval', explode(',', (string)$subCategory->category_sub_attributes)))
                : [];
            $defaultSpecIds = !empty($subCategory->category_sub_specifications)
                ? array_filter(array_map('intval', explode(',', (string)$subCategory->category_sub_specifications)))
                : [];

            $selectedAttributeIds = array_values(array_unique(array_merge($adminAttrs, $globalAttrIds, $defaultAttrIds)));
            $selectedSpecificationIds = array_values(array_unique(array_merge($adminSpecs, $globalSpecIds, $defaultSpecIds)));
        }

        // Format Attributes String
        $attrLines = [];
        foreach ($selectedAttributeIds as $attrId) {
            $ag = $this->attributeGroups ? $this->attributeGroups->get((int)$attrId) : null;
            if (!$ag) continue;
            $name = trim($ag->attribute_group_name ?? '');
            $ref = trim($ag->attribute_group_refname ?? '');
            $title = ($ref !== '' && strcasecmp($name, $ref) !== 0) ? "{$name} ({$ref})" : $name;

            $decoded = json_decode($ag->attribute_values, true);
            if (is_array($decoded)) {
                $vals = implode(', ', array_filter(array_map('trim', $decoded)));
            } else {
                $vals = trim((string)$ag->attribute_values);
            }

            $attrLines[] = !empty($vals) ? "{$title}: {$vals}" : $title;
        }
        $attributesStr = !empty($attrLines) ? implode("\n", $attrLines) : '-';

        // Format Specifications String
        $specLines = [];
        foreach ($selectedSpecificationIds as $specId) {
            $sg = $this->specificationGroups ? $this->specificationGroups->get((int)$specId) : null;
            if (!$sg) continue;
            $name = trim($sg->specification_group_name ?? '');
            $ref = trim($sg->specification_group_refname ?? '');
            $title = ($ref !== '' && strcasecmp($name, $ref) !== 0) ? "{$name} ({$ref})" : $name;

            $decoded = json_decode($sg->specification_values, true);
            if (is_array($decoded)) {
                $vals = implode(', ', array_filter(array_map('trim', $decoded)));
            } else {
                $vals = trim((string)$sg->specification_values);
            }

            $specLines[] = !empty($vals) ? "{$title}: {$vals}" : $title;
        }
        $specificationsStr = !empty($specLines) ? implode("\n", $specLines) : '-';

        return [
            str_pad($subCategory->id, 4, '0', STR_PAD_LEFT),
            $subCategory->category_main_name ?? '',
            $subCategory->category_name ?? '',
            $subCategory->category_sub_name ?? '',
            $subCategory->category_sub_keywords ?? '',
            $subCategory->category_sub_sortorder ?? 0,
            $subCategory->status == 1 ? 'Active' : 'Inactive',
            $attributesStr,
            $specificationsStr,
            $subCategory->category_sub_image ?? '',
            $subCategory->created_at ? $subCategory->created_at->format('Y-m-d H:i:s') : ''
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('H:I')->getAlignment()->setWrapText(true);

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
