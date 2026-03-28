<div class="product-wrap">
    <div class="product text-center">
        <figure class="product-media">
            <a href="{{ url('/productVar/'.$product->id) }}">
                <img src="{{ asset('assets/images/products/'.$product->product_image) }}" alt="Product" />
            </a>
            @php
                $offer_image = isset($product->offer_image) ? $product->offer_image : (isset($product['offer_image']) ? $product['offer_image'] : null);
            @endphp
            @if($offer_image)
                <div class="product-label-group" style="position: absolute; top: 10px; left: 10px; z-index: 10;">
                    <img src="{{ asset('assets/images/offer_logo/'.$offer_image) }}" alt="Offer" style="width: 45px; height: 45px; object-fit: contain; filter: drop-shadow(2px 2px 4px rgba(0,0,0,0.3));  border-radius: 5px;">
                </div>
            @endif
            <div class="product-action-vertical">
                <a href="{{ url('/productVar/'.$product->id) }}" class="btn-product-icon btn-cart w-icon-cart"></a>
                <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"></a>
                <a href="#" onclick="showQuickView('{{ $product->id }}')" data-id="{{ $product->id }}" class="btn-product-icon btn-quickview w-icon-search"></a>
            </div>
        </figure>

        <div class="product-details">
            <h3 class="product-name">
                <a href="{{ url('/productVar/'.$product->id) }}">{{ $product->product_name }}</a>
            </h3>

            <div class="ratings-container">
                <div class="ratings-full">
                    <span class="ratings" style="width:100%"></span>
                </div>
                <a class="rating-reviews">(3 Reviews)</a>
            </div>

            <div class="product-pa-wrapper">
                <div class="product-price">₹{{ $product->selling_price }}</div>
                <div class="product-price-discount">₹{{ $product->retail_price }}</div>
                @php
                    $retailPrice = (float) ($product->retail_price ?? 0);
                    $sellingPrice = (float) ($product->selling_price ?? 0);
                    $discount = $retailPrice > 0
                        ? number_format((($retailPrice - $sellingPrice) / $retailPrice) * 100)
                        : 0;
                @endphp
                <div class="product-offer-percentage">{{ $discount }}% Off</div>
            </div>
            @php
                $showStockCount = $showStockCount ?? false;
                $stockQty = isset($product->stock_qty) ? (int) $product->stock_qty : null;
                $lowStockLimit = isset($product->low_stock_limit) ? (int) $product->low_stock_limit : null;
            @endphp
            @if($showStockCount && $stockQty !== null)
                <div class="small mt-1 {{ ($lowStockLimit !== null && $stockQty <= $lowStockLimit) ? 'text-danger' : 'text-muted' }}">
                    Stock: {{ $stockQty }}
                    @if($lowStockLimit !== null && $stockQty <= $lowStockLimit)
                        <span class="ms-1">Low stock</span>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
