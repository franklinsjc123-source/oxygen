<?php

namespace App\Imports;

use App\Models\Products\Products;
use App\Models\Products\ProductsDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ImportProduct implements ToModel, WithStartRow, WithMultipleSheets
{
    /**
     * Map each Excel row to create/update a product + product_details.
     *
     * Expected Excel columns (Row 1 = Header, Data starts from Row 2):
     * 0  - Product Name        (required)
     * 1  - HSN Code
     * 2  - Main Category ID
     * 3  - Category ID
     * 4  - Sub Category ID
     * 5  - Description
     * 6  - Weight
     * 7  - Color ID
     * 8  - Size
     * 9  - Quantity            (stock)
     * 10 - Retail Price        (MRP)
     * 11 - Selling Price
     * 12 - SKU
     * 13 - Return/Replace      (return / replace / none)
     * 14 - Return Days
     * 15 - Low Stock Limit
     * 16 - GST ID
     * 17 - Offer ID
     * 18 - Status              (1 = Active, 0 = Inactive)
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // Skip if product name is empty
        $productName = trim($row[0] ?? '');
        if (empty($productName)) {
            return null;
        }

        $loginId = session()->get('login_id');

        // Create or find the product
        $product = Products::create([
            'login_id'      => $loginId,
            'product_name'  => $productName,
            'slug'          => Products::generateUniqueSlug($productName),
            'hsncode'       => $row[1] ?? null,
            'category_main' => !empty($row[2]) ? intval($row[2]) : null,
            'category'      => !empty($row[3]) ? intval($row[3]) : null,
            'category_sub'  => !empty($row[4]) ? intval($row[4]) : null,
            'description'   => $row[5] ?? null,
            'weight'        => $row[6] ?? null,
            'gst_id'        => !empty($row[16]) ? intval($row[16]) : null,
            'offers'        => !empty($row[17]) ? intval($row[17]) : null,
            'status'        => isset($row[18]) ? intval($row[18]) : 1,
            'flag'          => 1,
            'created_by'    => session()->get('name') ?? 'admin',
        ]);

        // Create product detail (variant)
        if ($product) {
            ProductsDetails::create([
                'products_id'    => $product->id,
                'color'          => $row[7] ?? null,
                'size'           => $row[8] ?? null,
                'quantity'       => !empty($row[9]) ? intval($row[9]) : 0,
                'retail_price'   => !empty($row[10]) ? floatval($row[10]) : 0,
                'selling_price'  => !empty($row[11]) ? floatval($row[11]) : 0,
                'sku'            => $row[12] ?? null,
                'return_replace' => $row[13] ?? null,
                'r_days'         => $row[14] ?? null,
                'low_stock_limit' => !empty($row[15]) ? intval($row[15]) : 0,
            ]);
        }

        return null; // We handle creation manually
    }

    public function startRow(): int
    {
        return 2;
    }

    public function sheets(): array
    {
        return [
            new ImportProduct()
        ];
    }
}
