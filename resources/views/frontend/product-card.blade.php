@php
    if (is_array($product)) {
        $product = (object) $product;
    }
@endphp
<div class="product-wrap">
    <div class="product text-center">
        <figure class="product-media">
            <a href="{{ url('/products/'.($product->slug ?? $product->id)) }}">
                <img src="{{ asset('assets/images/products/'.$product->product_image) }}" alt="Product" />
            </a>
            @php
                $offer_image = $product->offer_image ?? null;
                $offer_type = $product->offer_type ?? null;
                $discount_type = $product->discount_type ?? null;
                
                if (empty($offer_image) && !empty($offer_type)) {
                    if ($offer_type == 'Fixed Discount' && $discount_type == 'Percentage') {
                        $offer_image = 'Fixed Discount Percentage.png';
                    } else {
                        $offer_image = $offer_type . '.jpeg';
                    }
                }
            @endphp
            @if($offer_image)
                <div class="product-label-group" style="position: absolute; top: 10px; left: 10px; z-index: 10; text-align: center; display: flex; flex-direction: column; align-items: center; gap: 4px;">
                    <img src="{{ asset('assets/images/offer_logo/'.$offer_image) }}" alt="Offer" style="width: 45px; height: 45px; object-fit: contain; filter: drop-shadow(2px 2px 4px rgba(0,0,0,0.3)); border-radius: 5px;">
                    @if(!empty($product->offer_text))
                        <div style="background: #0088dd; color: #fff; font-size: 8px; font-weight: 700; padding: 1px 4px; border-radius: 2px; box-shadow: 0 1px 3px rgba(0,0,0,0.2); white-space: nowrap; line-height: 1.1;">
                            {{ $product->offer_text }}
                        </div>
                    @endif
                </div>
            @endif
            <div class="product-action-vertical">
                <a href="{{ url('/products/'.($product->slug ?? $product->id)) }}" class="btn-product-icon  w-icon-cart"></a>
                <a href="#" onclick="addwishlist('{{ $product->id }}')" class="btn-product-icon btn-wishlist w-icon-heart"><span></span></a>
                <a href="#" onclick="showQuickView('{{ $product->id }}')" data-id="{{ $product->id }}" class="btn-product-icon btn-quickview w-icon-search"></a>
            </div>
        </figure>

         <div class="product-details">
             @if((isset($product->vendor_id) || isset($product->shop_name)) && !request()->routeIs('shop-details'))
                <div class="sold-by" style="margin-bottom: 2px;">
                    <a href="{{ url('/shop/' . ($product->vendor_slug ?? $product->vendor_id ?? '#')) }}" style="color: #0088dd; font-weight: 700; font-size: 1.3rem;">
                        {{ $product->shop_name ?? 'N/A' }}
                    </a>
                </div>
             @endif
             <h4 class="product-name" style="margin-bottom: 5px; font-weight: 500; font-size: 1.4rem;">
                 <a href="{{ url('/products/'.($product->slug ?? $product->id)) }}" style="color: #333 text-decoration: none;">
                    {{ $product->product_name }}
                 </a>
             </h4>
 
             <div class="ratings-container" style="margin-bottom: 5px;">
                 <div class="ratings-full">
                     <span class="ratings" style="width: {{ $product->rating_percent ?? 0 }}%"></span>
                 </div>
                 <a class="rating-reviews" style="font-size: 1.1rem; color: #0088dd;">({{ $product->review_count ?? 0 }} Reviews)</a>
             </div>
 
             <div class="product-pa-wrapper" style="display: flex; align-items: center; justify-content: center; gap: 4px; white-space: nowrap; flex-wrap: nowrap;">
                 <div class="product-price-home" style="font-family: monospace; font-size: 1.5rem; font-weight: 700; color: #000;">
                    ₹{{ $product->selling_price }}
                 </div>
                 <div class="product-price-discount" style="text-decoration: line-through; color: #888; font-size: 1.1rem; font-weight: 600;">
                    ₹{{ $product->retail_price }}
                 </div>
                 @php
                     $retailPrice = (float) ($product->retail_price ?? 0);
                     $sellingPrice = (float) ($product->selling_price ?? 0);
                     if ($retailPrice > 0) {
                         $discount_percentage = (($retailPrice - $sellingPrice) / $retailPrice) * 100;
                         $discount_rounded = round($discount_percentage / 10) * 10;
                     } else {
                         $discount_rounded = 0;
                     }
                 @endphp
                 <div class="product-offer-percentage" style="color: #27ae60; font-weight: 700; font-size: 1.1rem;">
                    {{ $discount_rounded }}% Off
                 </div>
             </div>
            @php
                $showStockCount = $showStockCount ?? false;
                $stockQty = isset($product->stock_qty) ? (int) $product->stock_qty : null;
                $lowStockLimit = isset($product->low_stock_limit) ? (int) $product->low_stock_limit : null;
            @endphp
            @if($showStockCount && $stockQty !== null)
                <div class="product-stock-status">
                    @if($stockQty > ($lowStockLimit ?? 5))
                        <span class="stock-label in-stock">
                            <i class="fas fa-check-circle"></i> In Stock: {{ $stockQty }}
                        </span>
                    @elseif($stockQty > 0)
                        <span class="stock-label low-stock">
                            <i class="fas fa-exclamation-triangle"></i> Only {{ $stockQty }} Left
                        </span>
                    @else
                        <span class="stock-label out-of-stock">
                            <i class="fas fa-times-circle"></i> Out of Stock
                        </span>
                    @endif
                </div>
            @endif
        </div>
    </div>
</div>
