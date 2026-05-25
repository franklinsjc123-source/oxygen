<?php
$file = '/var/www/html/oxygen/app/Http/Controllers/staff/ProductsController/ProductsController.php';
$content = file_get_contents('/var/www/html/oxygen/app/Http/Controllers/ProductsController/ProductsController.php');

$content = str_replace('namespace App\Http\Controllers\ProductsController;', 'namespace App\Http\Controllers\staff\ProductsController;', $content);
$content = str_replace('layout.admin.products.', 'layout.staff.products.', $content);
$content = preg_replace("/route\('products\.crud/", "route('staffproducts.crud", $content);
$content = preg_replace("/route\('vendor_products\.crud/", "route('staffvendor_products.crud", $content);
$content = preg_replace("/route\('productdetailsdelete'/", "route('staffproducts.crud.productdetailsdelete'", $content);
$content = preg_replace("/route\('offer\.update'/", "route('offer.update'", $content); // wait, staffoffer.update? Let's leave offer.update alone if it's the same

file_put_contents($file, $content);
echo "Done.";
