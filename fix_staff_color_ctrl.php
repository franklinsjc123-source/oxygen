<?php
$file = '/var/www/html/oxygen/app/Http/Controllers/staff/ProductsController/ProductColorController.php';
$content = file_get_contents($file);

$content = str_replace("namespace App\Http\Controllers\ProductsController;", "namespace App\Http\Controllers\staff\ProductsController;", $content);
$content = str_replace("layout.admin.product_colors.", "layout.staff.product_colors.", $content);
$content = str_replace("route('product_colors.index')", "route('staffproduct_colors.index')", $content);

file_put_contents($file, $content);
echo "Done Controller\n";
