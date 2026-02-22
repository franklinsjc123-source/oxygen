<div class="cart-header">
    <span>Shopping Cart</span>
    <a href="#" class="btn-close">Close<i class="w-icon-long-arrow-right"></i></a>
</div>
<div class="products">
    <?php
    $baseUrl = url('/');
    foreach ($records as $row) {  ?>
        <div class="product product-cart">
            <div class="product-detail">
                <a href="<?= route('productVar', [$row['id']]) ?>" class="product-name"><?= $row['name'] ?></a>
                <div class="price-box">
                    <span class="product-quantity"><?= $row['quantity'] ?></span>
                    <span class="product-price"><?= $row['price'] ?></span>
                </div>
            </div>
            <figure class="product-media">
                <a href="product-default.html">
                    <img src="<?= $baseUrl ?>/assets/images/products/<?= $row['attributes']['image'] ?>" alt="product" height="84" width="94">
                </a>
            </figure>
            <button onclick="removeCart('<?= $row['id'] ?>')" class="btn btn-link btn-close" aria-label="button">
                <i class="fas fa-times"></i>
            </button>
        </div>
    <?php } ?>


</div>
<div class="cart-total">
    <label>Subtotal:</label>
    <span class="price">₹<?= $total ?? 0 ?></span>
</div>
<div class="cart-action">
    <a href="<?= route('shopping-cart') ?>" class="btn btn-dark btn-outline btn-rounded">View Cart</a>
    <a href="<?= route('checkoutPage') ?>" class="btn btn-primary  btn-rounded">Checkout</a>
</div>