<div class="product-wrap">
    <div class="product text-center">
        <figure class="product-media">
            <a href="{{ url('/productVar/'.$product->id) }}">
                <img src="{{ asset('assets/images/products/'.$product->product_image) }}" alt="Product" />
            </a>
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
                    $discount = number_format((($product->retail_price - $product->selling_price) / $product->retail_price) * 100);
                @endphp
                <div class="product-offer-percentage">{{ $discount }}% Off</div>
            </div>
        </div>
    </div>
</div>