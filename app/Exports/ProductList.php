<?php

namespace App\Exports;

use App\Models\Products\ProductsDetails;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ProductList implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return ProductsDetails::all();
    }


    public function headings():array{
        return[
     
            "id",
            "products_id",
            "product_detail_image",
            "color",
            "size",
            "quantity",
            "retail_price",
            "selling_price",
            "sku",
            "return_replace",
            "r_days",
            "low_stock_limit",
            "threshold",
            'createdBy','created_at','updated_at'
        ];
    }
}
