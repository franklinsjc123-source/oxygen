<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $indexes = [
            // [table, columns, indexName]
            ['products_details', ['products_id'], 'idx_products_details_products_id'],
            ['products_details', ['selling_price'], 'idx_products_details_selling_price'],
            ['products_details', ['attributevalue1(50)'], 'idx_pd_attrval1'],
            ['products_details', ['attributevalue2(50)'], 'idx_pd_attrval2'],
            ['products_details', ['common_product'], 'idx_products_details_common_product'],

            ['products', ['status'], 'idx_products_status'],
            ['products', ['flag'], 'idx_products_flag'],
            ['products', ['login_id'], 'idx_products_login_id'],
            ['products', ['vendor_id(50)'], 'idx_p_vendor_id'],
            ['products', ['category_main(50)'], 'idx_p_category_main'],
            ['products', ['category(50)'], 'idx_p_category'],
            ['products', ['category_sub(50)'], 'idx_p_category_sub'],
            ['products', ['offers(50)'], 'idx_p_offers'],
            ['products', ['status', 'flag', 'category_main(50)'], 'idx_p_status_flag_catmain'],

            ['vendor_details', ['status'], 'idx_vendor_details_status'],
            ['vendor_details', ['staff_id'], 'idx_vendor_details_staff_id'],

            ['category', ['main_category_id'], 'idx_category_main_category_id'],
            ['category', ['status'], 'idx_category_status'],
            ['category', ['category_sortorder'], 'idx_category_category_sortorder'],

            ['category_sub', ['category_id'], 'idx_category_sub_category_id'],
            ['category_sub', ['category_main_id'], 'idx_category_sub_category_main_id'],
            ['category_sub', ['status'], 'idx_category_sub_status'],
            ['category_sub', ['category_sub_sortorder'], 'idx_category_sub_category_sub_sortorder'],

            ['category_main', ['status'], 'idx_category_main_status'],
            ['category_main', ['category_main_sortorder'], 'idx_category_main_category_main_sortorder'],

            ['ratings', ['products_id(50)'], 'idx_ratings_products_id'],
            ['ratings', ['status(50)'], 'idx_ratings_status'],

            ['products_specs', ['products_id'], 'idx_products_specs_products_id'],

            ['ecom_order_product', ['order_id(50)'], 'idx_eop_order_id'],
            ['ecom_order_product', ['product_id(50)'], 'idx_eop_product_id'],
            ['ecom_order_product', ['order_status(50)'], 'idx_eop_order_status'],
            ['ecom_order_product', ['created_at'], 'idx_ecom_order_product_created_at'],

            ['ecom_customer_info', ['customer_id(20)'], 'idx_custinfo_customer_id'],

            ['ecom_wishlist', ['customer_id(50)'], 'idx_wishlist_customer_id'],
            ['ecom_wishlist', ['ecom_product_id(50)'], 'idx_wishlist_product_id'],

            ['pincode', ['name(50)'], 'idx_pincode_name'],
            ['pincode', ['status'], 'idx_pincode_status'],

            ['auctions', ['status'], 'idx_auctions_status'],
            ['auctions', ['product_id(50)'], 'idx_auctions_product_id'],

            ['mainsliders', ['status'], 'idx_mainsliders_status'],
            ['oxygen_advs', ['status'], 'idx_oxygen_advs_status'],
        ];

        foreach ($indexes as [$table, $columns, $name]) {
            $exists = DB::select(
                'SELECT 1 FROM information_schema.statistics WHERE table_schema = DATABASE() AND table_name = ? AND index_name = ?',
                [$table, $name]
            );
            if (empty($exists)) {
                try {
                    DB::statement("ALTER TABLE `{$table}` ADD INDEX `{$name}` (" . implode(', ', $columns) . ")");
                } catch (\Exception $e) {
                    // Ignore if already exists or table doesn't exist
                }
            }
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Indexes are non-destructive
    }
};
