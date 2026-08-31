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
            @php
                static $masterOffersMap = null;
                if ($masterOffersMap === null) {
                    $masterOffersMap = DB::table('master_offers')->get()->keyBy('id');
                }
                $offerName = '';
                $offerId = $product->offer_id ?? $product->offers ?? null;
                if ($offerId) {
                    $offerDetails = $masterOffersMap[$offerId] ?? null;
                    if ($offerDetails) {
                        if ($offerDetails->type == "Buy X Get Y Free") {
                            $offerName = 'Buy ' . ($offerDetails->buy ?: '1') . ' Get ' . ($offerDetails->getoffer ?: '1') . ' Free';
                        } elseif ($offerDetails->type == "Cashback" || $offerDetails->type == "Cashback Offer") {
                            if (strtolower($offerDetails->cashbacktype) == 'percentage') {
                                $offerName = "Cash Back {$offerDetails->cashbackvalue}% Off";
                            } else {
                                $offerName = "Cashback ₹{$offerDetails->cashbackvalue} Off";
                            }
                        } elseif ($offerDetails->type == "Fixed Discount") {
                            if (strtolower($offerDetails->discount_type) == 'percentage') {
                                $offerName = "Flat {$offerDetails->value}% Off";
                            } else {
                                $offerName = "Flat ₹{$offerDetails->value} Off";
                            }
                        } elseif (str_contains($offerDetails->type, '@')) {
                            $amt = $offerDetails->getamt ? "₹{$offerDetails->getamt}/-" : "{$offerDetails->value}%";
                            $buyQty = $offerDetails->buy ?: ($offerDetails->buyproduct ?: "1"); $offerName = "Buy {$buyQty} @ {$amt}";
                        } else {
                            $offerName = $offerDetails->title ?: $offerDetails->type;
                        }
                    }
                }
                if (empty($offerName)) {
                    $offerName = $product->offer_text ?? $product->offer_type ?? null;
                }
            @endphp
            @if(!empty($offerName))
                @php
                    $bg = 'linear-gradient(135deg, #ff7b7b 0%, #ff5b5b 100%)';
                    $text = '#ffffff';
                    $style = "position:absolute; top:0; left:10px; width:52px; min-height:62px; clip-path:polygon(0% 0%, 100% 0%, 100% 100%, 50% 86%, 0% 100%); padding:6px 3px 14px 3px; border-radius:0 0 4px 4px;";
                @endphp
                <div style="{{ $style }} background:{{ $bg }}; color:{{ $text }}; font-weight:900; font-size:10px; text-transform:uppercase; text-align:center; display:flex; align-items:center; justify-content:center; flex-direction:column; box-sizing:border-box; z-index:10; line-height:1.15; letter-spacing:0.3px; word-break:break-word; font-family:'Inter','Segoe UI',sans-serif;">
                    {{ $offerName }}
                </div>
            @endif

            <div class="product-action-vertical">
                <a href="{{ url('/products/'.($product->slug ?? $product->id)) }}" class="btn-product-icon  w-icon-cart"></a>
                <a href="#" onclick="addwishlist('{{ $product->id }}', this)" class="btn-product-icon btn-wishlist {{ in_array($product->id, $wishlistedProductIds ?? []) ? 'w-icon-heart-full' : 'w-icon-heart' }}" style="{{ in_array($product->id, $wishlistedProductIds ?? []) ? 'color: #ef4444 !important;' : '' }}"><span></span></a>
                <a href="#" onclick="showQuickView('{{ $product->id }}')" data-id="{{ $product->id }}" class="btn-product-icon btn-quickview w-icon-search"></a>
            </div>
        </figure>

         <div class="product-details">
             @if((isset($product->vendor_id) || isset($product->shop_name)) && !request()->routeIs('shop-details') && !request()->routeIs('shop.show'))
                <div class="sold-by" style="margin-bottom: 2px;">
                    <a href="{{ url('/shop/' . ($product->vendor_slug ?? $product->vendor_id ?? '#')) }}" style="color: #ff5e5e; font-weight: 700; font-size: 1.3rem;">
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
                 <a class="rating-reviews" style="font-size: 1.1rem; color: #ff5e5e;">({{ $product->review_count ?? 0 }} Reviews)</a>
             </div>
 
             <div class="product-pa-wrapper" style="display: flex; align-items: center; justify-content: center; gap: 4px; white-space: nowrap; flex-wrap: nowrap;">
                 <div class="product-price-home" style="font-family: monospace; font-size: 1.5rem; font-weight: 700; color: #000;">
                    <span style="font-family: Arial, sans-serif;">₹</span>{{ $product->selling_price }}
                 </div>
                 <div class="product-price-discount" style="text-decoration: line-through; color: #888; font-size: 1.1rem; font-weight: 600;">
                    <span style="font-family: Arial, sans-serif;">₹</span>{{ $product->retail_price }}
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
