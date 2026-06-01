<style>
    .cart-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.5rem;
        background: #f8fafc;
        border-bottom: 1px solid #e2e8f0;
    }
    .cart-header span {
        font-size: 1.25rem;
        font-weight: 700;
        color: #1e293b;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .cart-header .btn-close {
        color: #64748b;
        font-size: 0.9rem;
        font-weight: 600;
        text-decoration: none;
        display: flex;
        align-items: center;
        gap: 0.5rem;
        transition: color 0.2s;
    }
    .cart-header .btn-close:hover {
        color: #ef4444;
    }
    .products {
        max-height: calc(100vh - 220px);
        overflow-y: auto;
        padding: 1.5rem;
    }
    .product-cart {
        display: flex;
        align-items: flex-start;
        padding-bottom: 1.5rem;
        margin-bottom: 1.5rem;
        border-bottom: 1px dashed #cbd5e1;
        position: relative;
    }
    .product-cart:last-child {
        border-bottom: none;
        margin-bottom: 0;
        padding-bottom: 0;
    }
    .product-cart .product-media {
        flex: 0 0 85px;
        margin-right: 1.25rem;
        margin-bottom: 0;
        border-radius: 12px;
        overflow: hidden;
        border: 1px solid #f1f5f9;
        box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
    }
    .product-cart .product-media img {
        width: 100%;
        height: 85px;
        object-fit: cover;
    }
    .product-cart .product-detail {
        flex: 1;
        padding-right: 2rem;
    }
    .product-cart .product-name {
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        font-size: 1rem;
        font-weight: 600;
        color: #334155;
        line-height: 1.4;
        margin-bottom: 0.5rem;
        text-decoration: none;
        transition: color 0.2s;
    }
    .product-cart .product-name:hover {
        color: #0ea5e9;
    }
    .product-cart .product-attributes {
        font-size: 0.85rem;
        color: #64748b;
        margin-bottom: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.5rem;
    }
    .product-cart .price-box {
        display: flex;
        align-items: baseline;
        gap: 0.5rem;
        margin-top: 0.5rem;
    }
    .product-cart .product-quantity {
        font-size: 0.9rem;
        color: #94a3b8;
        font-weight: 500;
    }
    .product-cart .product-quantity::after {
        content: ' ×';
    }
    .product-cart .product-price {
        font-size: 1.1rem;
        font-weight: 700;
        color: #0ea5e9;
    }
    .product-cart .btn-remove {
        position: absolute;
        top: -0.25rem;
        right: -0.5rem;
        background: transparent;
        border: none;
        color: #cbd5e1;
        font-size: 1.25rem;
        cursor: pointer;
        padding: 0.5rem;
        transition: color 0.2s, transform 0.2s;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .product-cart .btn-remove:hover {
        color: #ef4444;
        transform: scale(1.1);
    }
    .cart-total {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 1.5rem;
        background: #f8fafc;
        border-top: 1px solid #e2e8f0;
    }
    .cart-total label {
        font-size: 1.1rem;
        color: #475569;
        font-weight: 600;
        margin: 0;
    }
    .cart-total .price {
        font-size: 1.4rem;
        font-weight: 800;
        color: #0f172a;
    }
    .cart-action {
        display: flex;
        gap: 1rem;
        padding: 0 1.5rem 1.5rem;
        background: #f8fafc;
    }
    .cart-action .btn {
        flex: 1;
        padding: 0.875rem 1.5rem;
        text-align: center;
        border-radius: 9999px;
        font-weight: 700;
        font-size: 0.95rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .cart-action .btn-view-cart {
        background: #fff;
        color: #334155;
        border: 2px solid #cbd5e1;
    }
    .cart-action .btn-view-cart:hover {
        background: #f1f5f9;
        border-color: #94a3b8;
    }
    .cart-action .btn-checkout {
        background: linear-gradient(135deg, #0ea5e9 0%, #0284c7 100%);
        color: #fff;
        border: none;
        box-shadow: 0 4px 12px rgba(14, 165, 233, 0.25);
    }
    .cart-action .btn-checkout:hover {
        box-shadow: 0 6px 16px rgba(14, 165, 233, 0.4);
        transform: translateY(-2px);
    }
    
    /* Scrollbar for products */
    .products::-webkit-scrollbar {
        width: 6px;
    }
    .products::-webkit-scrollbar-track {
        background: #f1f5f9; 
    }
    .products::-webkit-scrollbar-thumb {
        background: #cbd5e1; 
        border-radius: 10px;
    }
    .products::-webkit-scrollbar-thumb:hover {
        background: #94a3b8; 
    }
</style>

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
                <a href="<?= url('/products/' . ($row['slug'] ?? $row['product_id'])) ?>">
                    <img src="<?= $baseUrl ?>/assets/images/products/<?= $row['image'] ?>" alt="product">
                </a>
            </figure>
            <div class="product-detail">
                <a href="<?= url('/products/' . ($row['slug'] ?? $row['product_id'])) ?>" class="product-name"><?= $row['name'] ?></a>
                <?php
                    $size = $row['size'] ?? '';
                    $color = $row['color'] ?? '';
                ?>
                <div class="product-attributes">
                    <?php if ($size !== '') { ?>
                        <span>Size: <?= $size ?></span>
                    <?php } ?>
                    <?php if ($size !== '' && $color !== '') { ?>
                        <span>|</span>
                    <?php } ?>
                    <?php if ($color !== '') { ?>
                        <span>Color: <?= $color ?></span>
                    <?php } ?>
                </div>

                <?php if ($row['offer_applied']) { ?>
                    <div class="small text-success mb-1" style="font-size: 11px; font-weight: 600;">
                        <?= $row['offer_title'] ?>
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
                    <span class="product-price"><span style="font-family: Arial, sans-serif;">₹</span><?= number_format($displayPrice, 2) ?></span>
                </div>
            </div>
            <button onclick="removeCart('<?= $row['id'] ?>')" class="btn-remove" aria-label="Remove item">
                <i class="fas fa-times"></i>
            </button>
        </div>
        
    <?php } ?>
</div>
<div class="cart-total">
    <label>Subtotal:</label>
    <span class="price"><span style="font-family: Arial, sans-serif;">₹</span><?= $total ?? 0 ?></span>
</div>
<div class="cart-action">
    <a href="<?= route('shopping-cart') ?>" class="btn btn-view-cart">View Cart</a>
    <a href="<?= route('checkoutPage') ?>" class="btn btn-checkout">Checkout</a>
</div>
