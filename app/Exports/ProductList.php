<?php

namespace App\Exports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;
use Illuminate\Support\Facades\DB;

class ProductList implements FromCollection, WithHeadings, WithStyles, WithColumnWidths
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $products = DB::table('products')
            ->leftJoin('category_main', 'products.category_main', '=', 'category_main.id')
            ->leftJoin('category', 'products.category', '=', 'category.id')
            ->leftJoin('category_sub', 'products.category_sub', '=', 'category_sub.id')
            ->leftJoin('master_offers', 'products.offers', '=', 'master_offers.id')
            ->leftJoin('vendor_details', 'products.login_id', '=', 'vendor_details.user_id')
            ->leftJoin('zonals', 'vendor_details.zone', '=', 'zonals.id')
            ->select(
                'products.id',
                'products.product_id',
                'products.login_id',
                'products.product_name',
                'products.hsncode',
                'category_main.category_main_name',
                'category.category_name',
                'category_sub.category_sub_name',
                'products.offers',
                'master_offers.title as offer_name',
                'products.status',
                'products.created_by',
                'vendor_details.shop_name',
                'zonals.name as zone_name',
                'products.created_at'
            )
            ->where('products.flag', '!=', 2)
            ->orderBy('products.id', 'asc')
            ->get();

        // Get all product details
        $productDetails = DB::table('products_details')
            ->select(
                'products_id',
                'color',
                'size',
                'attributename1',
                'attributevalue1',
                'attributename2',
                'attributevalue2',
                'attributename3',
                'attributevalue3',
                'quantity',
                'retail_price',
                'selling_price',
                'sku',
                'return_replace',
                'r_days',
                'low_stock_limit'
            )
            ->get()
            ->groupBy('products_id');

        // Get all colors for lookup
        $colors = DB::table('product_color')
            ->pluck('color_name', 'id')
            ->toArray();

        // Get all attributes for lookup
        $attributes = DB::table('master_attribute')
            ->pluck('attribute_name', 'id')
            ->toArray();

        // Pre-compute vendor sequence counts for Product ID formatting
        $vendorProductCounts = [];

        $rows = new Collection();
        $slNo = 1;

        foreach ($products as $product) {
            $details = $productDetails->get($product->id, collect());

            // Build Product ID in format: {Zone}-{login_id_padded}-{seq_padded}
            $loginId = str_pad($product->login_id, 4, '0', STR_PAD_LEFT);
            $vendorSeq = DB::table('products')
                ->where('login_id', $product->login_id)
                ->where('id', '<=', $product->id)
                ->count();
            $proId = str_pad($vendorSeq, 5, '0', STR_PAD_LEFT);
            $zoneName = !empty($product->zone_name) ? $product->zone_name : '';
            $displayProductId = $zoneName . '-' . $loginId . '-' . $proId;

            $statusText = $product->status == 1 ? 'Active' : 'Inactive';
            $shopName = $product->shop_name ?? $product->created_by ?? '-';

            if ($details->isEmpty()) {
                // Product with no variants
                $rows->push([
                    $slNo++,
                    $displayProductId,
                    $product->product_name ?? '-',
                    $product->hsncode ?? '-',
                    $product->category_main_name ?? '-',
                    $product->category_name ?? '-',
                    $product->category_sub_name ?? '-',
                    '-', // Color
                    '-', // Size
                    '-', // Attribute 1
                    '-', // Attribute 2
                    '-', // Attribute 3
                    0,   // Stock
                    0,   // MRP
                    0,   // Selling Price
                    '-', // SKU
                    '-', // Return/Replace
                    '-', // Return Days
                    0,   // Low Stock Limit
                    $product->offer_name ?? '-',
                    $statusText,
                    $shopName,
                    $product->created_at ?? '-',
                ]);
            } else {
                foreach ($details as $detail) {
                    // Resolve color name
                    $colorName = '-';
                    if (!empty($detail->color)) {
                        $colorId = intval($detail->color);
                        $colorName = $colors[$colorId] ?? $detail->color;
                    }

                    // Resolve size
                    $sizeDisplay = !empty($detail->size) ? $detail->size : '-';

                    // Resolve attribute 1
                    $attr1 = '-';
                    if (!empty($detail->attributename1) && !empty($detail->attributevalue1)) {
                        $attrName1 = $attributes[intval($detail->attributename1)] ?? $detail->attributename1;
                        $attr1 = $attrName1 . ': ' . $detail->attributevalue1;
                    }

                    // Resolve attribute 2
                    $attr2 = '-';
                    if (!empty($detail->attributename2) && !empty($detail->attributevalue2)) {
                        $attrName2 = $attributes[intval($detail->attributename2)] ?? $detail->attributename2;
                        $attr2 = $attrName2 . ': ' . $detail->attributevalue2;
                    }

                    // Resolve attribute 3
                    $attr3 = '-';
                    if (!empty($detail->attributename3) && !empty($detail->attributevalue3)) {
                        $attrName3 = $attributes[intval($detail->attributename3)] ?? $detail->attributename3;
                        $attr3 = $attrName3 . ': ' . $detail->attributevalue3;
                    }

                    $rows->push([
                        $slNo++,
                        $displayProductId,
                        $product->product_name ?? '-',
                        $product->hsncode ?? '-',
                        $product->category_main_name ?? '-',
                        $product->category_name ?? '-',
                        $product->category_sub_name ?? '-',
                        $colorName,
                        $sizeDisplay,
                        $attr1,
                        $attr2,
                        $attr3,
                        $detail->quantity ?? 0,
                        $detail->retail_price ?? 0,
                        $detail->selling_price ?? 0,
                        $detail->sku ?? '-',
                        $detail->return_replace ?? '-',
                        $detail->r_days ?? '-',
                        $detail->low_stock_limit ?? 0,
                        $product->offer_name ?? '-',
                        $statusText,
                        $shopName,
                        $product->created_at ?? '-',
                    ]);
                }
            }
        }

        return $rows;
    }

    public function headings(): array
    {
        return [
            'Sl No',
            'Product ID',
            'Product Name',
            'HSN Code',
            'Main Category',
            'Category',
            'Sub Category',
            'Color',
            'Size',
            'Attribute 1',
            'Attribute 2',
            'Attribute 3',
            'Stock Qty',
            'MRP (₹)',
            'Selling Price (₹)',
            'SKU',
            'Return/Replace',
            'Return Days',
            'Low Stock Limit',
            'Offer',
            'Status',
            'Shop / Created By',
            'Created Date',
        ];
    }

    /**
     * Style the spreadsheet
     */
    public function styles(Worksheet $sheet)
    {
        return [
            // Header row bold + background color
            1 => [
                'font' => [
                    'bold' => true,
                    'color' => ['rgb' => 'FFFFFF'],
                    'size' => 11,
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => ['rgb' => '2C3E50'],
                ],
                'alignment' => [
                    'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
                    'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
                ],
            ],
        ];
    }

    /**
     * Set column widths for readability
     */
    public function columnWidths(): array
    {
        return [
            'A' => 8,   // Sl No
            'B' => 20,  // Product ID
            'C' => 35,  // Product Name
            'D' => 14,  // HSN Code
            'E' => 18,  // Main Category
            'F' => 18,  // Category
            'G' => 18,  // Sub Category
            'H' => 15,  // Color
            'I' => 12,  // Size
            'J' => 20,  // Attribute 1
            'K' => 20,  // Attribute 2
            'L' => 20,  // Attribute 3
            'M' => 12,  // Stock Qty
            'N' => 12,  // MRP
            'O' => 16,  // Selling Price
            'P' => 15,  // SKU
            'Q' => 16,  // Return/Replace
            'R' => 12,  // Return Days
            'S' => 16,  // Low Stock Limit
            'T' => 20,  // Offer
            'U' => 10,  // Status
            'V' => 22,  // Shop / Created By
            'W' => 20,  // Created Date
        ];
    }
}
