<?php

namespace App\Imports;

use App\Models\Products\Products;
use App\Models\Products\ProductsDetails;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Category\CategoryMain;
use App\Models\Category\Category;
use App\Models\Category\CategorySub;
use App\Models\Master\Colors\ProductColor;
use App\Models\Master\GST\GST;
use App\Models\Offer\Offer;
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
     * 7  - Is Color Available
     * 8  - Color ID
     * 9  - Size
     * 10 - Quantity            (stock)
     * 11 - Retail Price        (MRP)
     * 12 - Selling Price
     * 13 - SKU
     * 14 - Return/Replace      (return / replace / none)
     * 15 - Return Days
     * 16 - Low Stock Limit
     * 17 - GST ID
     * 18 - Offer ID
     * 19 - Status              (1 = Active, 0 = Inactive)
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

        // Resolve Main Category
        $mainCat = trim($row[2] ?? '');
        $mainCatId = null;
        if ($mainCat !== '') {
            $catM = CategoryMain::where('category_main_name', 'LIKE', $mainCat)->first();
            $mainCatId = $catM ? $catM->id : (is_numeric($mainCat) ? intval($mainCat) : null);
        }

        // Resolve Category
        $cat = trim($row[3] ?? '');
        $catId = null;
        if ($cat !== '') {
            $catObj = Category::where('category_name', 'LIKE', $cat)->first();
            $catId = $catObj ? $catObj->id : (is_numeric($cat) ? intval($cat) : null);
        }

        // Resolve Sub Category
        $subCat = trim($row[4] ?? '');
        $subCatId = null;
        if ($subCat !== '') {
            $subCatObj = CategorySub::where('category_sub_name', 'LIKE', $subCat)->first();
            $subCatId = $subCatObj ? $subCatObj->id : (is_numeric($subCat) ? intval($subCat) : null);
        }

        // Resolve GST
        $gstVal = trim($row[17] ?? '');
        $gstId = null;
        if ($gstVal !== '') {
            $gstObj = GST::where('gst_name', 'LIKE', $gstVal)->orWhere('value', $gstVal)->first();
            $gstId = $gstObj ? $gstObj->id : (is_numeric($gstVal) ? intval($gstVal) : null);
        }

        // Resolve Offer
        $offerVal = trim($row[18] ?? '');
        $offerId = null;
        if ($offerVal !== '') {
            $offerObj = Offer::where('title', 'LIKE', $offerVal)->first();
            $offerId = $offerObj ? $offerObj->id : (is_numeric($offerVal) ? intval($offerVal) : null);
        }

        // Resolve Status
        $statusVal = strtolower(trim($row[19] ?? ''));
        $status = 1; // Default to Active
        if ($statusVal === 'inactive' || $statusVal === '0') {
            $status = 0;
        }

        // Create or find the product
        $product = Products::create([
            'login_id'      => $loginId,
            'product_name'  => $productName,
            'slug'          => Products::generateUniqueSlug($productName),
            'hsncode'       => $row[1] ?? null,
            'category_main' => $mainCatId,
            'category'      => $catId,
            'category_sub'  => $subCatId,
            'description'   => $row[5] ?? null,
            'weight'        => $row[6] ?? null,
            'gst_id'        => $gstId,
            'offers'        => $offerId,
            'status'        => $status,
            'flag'          => 1,
            'created_by'    => session()->get('name') ?? 'admin',
            'logintype'     => session()->get('log_type') ?? 'Vendor', // Set logintype automatically based on session
        ]);

        // Resolve Color
        $colorVal = trim($row[8] ?? '');
        $colorId = null;
        if ($colorVal !== '') {
            $colorObj = ProductColor::where('color_name', 'LIKE', $colorVal)->first();
            $colorId = $colorObj ? $colorObj->id : (is_numeric($colorVal) ? intval($colorVal) : null);
        }

        // Create product detail (variant)
        if ($product) {
            ProductsDetails::create([
                'products_id'    => $product->id,
                'color'          => $colorId,
                'size'           => $row[9] ?? null,
                'quantity'       => !empty($row[10]) ? intval($row[10]) : 0,
                'retail_price'   => !empty($row[11]) ? floatval($row[11]) : 0,
                'selling_price'  => !empty($row[12]) ? floatval($row[12]) : 0,
                'sku'            => $row[13] ?? null,
                'return_replace' => $row[14] ?? null,
                'r_days'         => $row[15] ?? null,
                'low_stock_limit' => !empty($row[16]) ? intval($row[16]) : 0,
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
