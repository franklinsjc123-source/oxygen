<?php
$files = glob('/var/www/html/oxygen/resources/views/layout/staff/product_colors/*.blade.php');
foreach($files as $file) {
    $content = file_get_contents($file);
    $content = str_replace("layout.auth.master", "layout.staff.master", $content);
    $content = str_replace("paritials.auth.sidemenu", "paritials.staffauth.sidemenu", $content);
    $content = str_replace("product_colors.create", "staffproduct_colors.create", $content);
    $content = str_replace("product_colors.edit", "staffproduct_colors.edit", $content);
    $content = str_replace("product_colors.destroy", "staffproduct_colors.destroy", $content);
    $content = str_replace("product_colors.store", "staffproduct_colors.store", $content);
    $content = str_replace("product_colors.update", "staffproduct_colors.update", $content);
    file_put_contents($file, $content);
}
echo "Done replacing content in views.";
