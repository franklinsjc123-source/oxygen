<div class="cart-header">
    <span>Shopping Cart</span>
    <a href="#" class="btn-close">Close<i class="w-icon-long-arrow-right"></i></a>
</div>
<div class="products">
    <?php
    $baseUrl = url('/');
    foreach ($records as $row) {  ?>
        <div class="product product-cart">
            <figure class="product-media">
                <a href="<?= route('productVar', [$row['product_id']]) ?>">
                    <img src="<?= $baseUrl ?>/assets/images/products/<?= $row['image'] ?>" alt="product" height="80" width="80">
                </a>
            </figure>
            <div class="product-detail">
                <a href="<?= route('productVar', [$row['product_id']]) ?>" class="product-name"><?= $row['name'] ?></a>
                <?php
                    $size = $row['size'] ?? '';
                    $color = $row['color'] ?? '';
                ?>
                <div class="small text-muted" style="font-size: 11px;">
                    <?php if ($size !== '') { ?>
                        <span>Size: <?= $size ?></span>
                    <?php } ?>
                    <?php if ($size !== '' && $color !== '') { ?>
                        <span> | </span>
                    <?php } ?>
                    <?php if ($color !== '') { ?>
                        <span>Color: <?= $color ?></span>
                    <?php } ?>
                </div>

                <?php if ($row['offer_applied']) { ?>
                    <div class="small text-success mb-1" style="font-size: 11px;">
                        <strong><?= $row['offer_title'] ?></strong>
                    </div>
                <?php } ?>

                <div class="price-box">
                    <span class="product-quantity"><?= $row['qty'] ?></span>
                    <?php
                        $displayPrice = $row['effective_unit_price'];
                        if (($row['offer_type'] ?? '') === 'Buy X Get Y Free') {
                            $displayPrice = $row['unit_price'];
                        }
                    ?>
                    <span class="product-price">₹<?= number_format($displayPrice, 2) ?></span>
                </div>
            </div>
            <button onclick="removeCart('<?= $row['id'] ?>')" class="btn btn-link btn-close" aria-label="button">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
        <?php /* if (!empty($row['free_qty'])) { ?>
            <div class="product product-cart" style="opacity: 0.8; padding-top:5px; border-bottom: 1px dotted #e1e1e1;">
                <div class="product-detail">
                    <span class="product-name text-success">FREE: <?= $row['name'] ?></span>
                    <div class="price-box">
                        <span class="product-quantity"><?= $row['free_qty'] ?></span>
                        <span class="product-price">₹0.00</span>
                    </div>
                </div>
            </div>
        <?php } */ ?>
        
    <?php } ?>


</div>
<div class="cart-total">
    <label>Subtotal:</label>
    <span class="price">₹<?= $total ?? 0 ?></span>
</div>
<div class="cart-action">
    <a href="<?= route('shopping-cart') ?>" class="btn btn-dark btn-rounded">View Cart</a>
    <a href="<?= route('checkoutPage') ?>" class="btn btn-primary btn-rounded">Checkout</a>
</div>
