<?php
$file = '/var/www/html/oxygen/resources/views/layout/staff/products/add-product.blade.php';
$content = file_get_contents($file);

$content = preg_replace("/route\('products\.crud/", "route('staffproducts.crud", $content);
$content = preg_replace("/route\('products\.addinfo'/", "route('staffproducts.addinfo'", $content);

file_put_contents($file, $content);
echo "Done.";
