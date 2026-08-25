@extends('app_template')
@section('title','My Wishlist')
@section('content')

<main class="main wishlist-page">

<style>
    /* ─── MOBILE WISHLIST CARD LAYOUT ─── */
    @media (max-width: 767px) {
        .wishlist-page .wishlist-title {
            font-size: 2rem !important;
            font-weight: 800 !important;
            color: #111 !important;
            margin-bottom: 10px !important;
        }

        .wishlist-page .shop-table.wishlist-table {
            border: none !important;
        }

        .wishlist-page .shop-table.wishlist-table thead {
            display: none !important;
        }

        .wishlist-page .shop-table.wishlist-table tbody {
            display: block !important;
            width: 100% !important;
        }

        .wishlist-page .shop-table.wishlist-table tbody tr {
            display: grid !important;
            grid-template-columns: 100px 1fr !important;
            grid-template-areas:
                "img name"
                "img price"
                "img action" !important;
            gap: 2px 15px !important;
            padding: 18px 0 !important;
            margin: 0 !important;
            border: none !important;
            border-bottom: 1px solid #f0f0f2 !important;
            box-shadow: none !important;
            background: #fff !important;
            position: relative !important;
            align-items: start !important;
        }

        .wishlist-page .shop-table.wishlist-table tbody tr td {
            display: block !important;
            width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
            border: none !important;
            text-align: left !important;
            vertical-align: top !important;
        }

        /* ── THUMBNAIL ── */
        .wishlist-page .shop-table.wishlist-table tbody tr td:nth-child(1) {
            grid-area: img !important;
            display: flex !important;
            align-items: flex-start !important;
            justify-content: center !important;
        }

        .wishlist-page .shop-table.wishlist-table tbody tr td:nth-child(1) .p-relative {
            width: 100px !important;
            height: 100px !important;
        }

        .wishlist-page .shop-table.wishlist-table tbody tr td:nth-child(1) figure {
            width: 100px !important;
            height: 100px !important;
            background: #f5f6f8 !important;
            border-radius: 16px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            margin: 0 !important;
            overflow: hidden !important;
        }

        .wishlist-page .shop-table.wishlist-table tbody tr td:nth-child(1) img {
            width: 80px !important;
            height: 80px !important;
            object-fit: cover !important;
            margin: 0 auto !important;
        }

        /* ── PRODUCT NAME ── */
        .wishlist-page .shop-table.wishlist-table tbody tr td:nth-child(2) {
            grid-area: name !important;
            font-size: 1.5rem !important;
            font-weight: 700 !important;
            color: #111 !important;
            line-height: 1.3 !important;
            padding-top: 4px !important;
            padding-right: 30px !important;
        }

        .wishlist-page .shop-table.wishlist-table tbody tr td:nth-child(2) a {
            color: #111 !important;
            font-weight: 700 !important;
        }

        /* ── PRICE ── */
        .wishlist-page .shop-table.wishlist-table tbody tr td:nth-child(3) {
            grid-area: price !important;
            font-size: 1.4rem !important;
            font-weight: 700 !important;
            color: #111 !important;
        }

        .wishlist-page .shop-table.wishlist-table tbody tr td:nth-child(3) ins.new-price {
            display: inline-flex !important;
            align-items: center !important;
            flex-wrap: wrap !important;
            gap: 6px !important;
            font-weight: 700 !important;
            color: #111 !important;
            text-decoration: none !important;
        }

        /* ── STOCK (HIDE) ── */
        .wishlist-page .shop-table.wishlist-table tbody tr td:nth-child(4) {
            display: none !important;
        }

        /* ── ACTIONS ── */
        .wishlist-page .shop-table.wishlist-table tbody tr td:nth-child(5) {
            grid-area: action !important;
            padding-top: 6px !important;
        }

        .wishlist-page .shop-table.wishlist-table tbody tr td:nth-child(5) > div {
            display: flex !important;
            align-items: center !important;
            gap: 0 !important;
        }

        /* "View" button => "Add to bag" style */
        .wishlist-page .shop-table.wishlist-table tbody tr td:nth-child(5) .btn-cart {
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            height: 34px !important;
            padding: 0 18px !important;
            font-size: 1.15rem !important;
            font-weight: 600 !important;
            letter-spacing: 0.3px !important;
            border-radius: 8px !important;
            background: #111 !important;
            border: none !important;
            color: #fff !important;
            width: auto !important;
            margin: 0 !important;
            text-transform: capitalize !important;
        }

        /* "Remove" button => X circle in top right */
        .wishlist-page .shop-table.wishlist-table tbody tr td:nth-child(5) .btn-default {
            position: absolute !important;
            top: 18px !important;
            right: 0 !important;
            width: 26px !important;
            height: 26px !important;
            min-width: 26px !important;
            background: #f0f0f2 !important;
            border-radius: 50% !important;
            display: inline-block !important;
            color: #888 !important;
            font-size: 0 !important;
            line-height: 0 !important;
            border: none !important;
            padding: 0 !important;
            margin: 0 !important;
            overflow: hidden !important;
        }

        .wishlist-page .shop-table.wishlist-table tbody tr td:nth-child(5) .btn-default::after {
            content: "\00d7" !important;
            font-size: 18px !important;
            font-weight: 400 !important;
            line-height: 1 !important;
            position: absolute !important;
            top: 50% !important;
            left: 50% !important;
            transform: translate(-50%, -54%) !important;
            color: #777 !important;
            margin: 0 !important;
            padding: 0 !important;
        }

        /* Empty wishlist row */
        .wishlist-page .shop-table.wishlist-table tbody tr[data-id] {
            display: block !important;
            text-align: center !important;
            padding: 40px 0 !important;
        }

        .wishlist-page .shop-table.wishlist-table tbody tr[data-id] td {
            text-align: center !important;
        }
    }
    
    .wishlist-offer-badge {
        transform: scale(0.48);
        transform-origin: top left;
    }
    @media (max-width: 767px) {
        .wishlist-offer-badge {
            transform: scale(0.7) !important;
        }
    }
    @media (min-width: 768px) {
        .wishlist-page .container {
            padding-left: 45px !important;
            padding-right: 45px !important;
        }
    }
</style>

    <nav class="breadcrumb-nav mb-10">
        <div class="container">
            <ul class="breadcrumb">
                <li><a href="{{ route('home') }}">Home</a></li>
                <li>Wishlist</li>
            </ul>
        </div>
    </nav>

    <div class="page-content">
        <div class="container">
            <h3 class="wishlist-title">My Wishlist</h3>
            <table class="shop-table wishlist-table">
                <thead>
                    <tr>
                        <th class="product-name" style="text-align: center; width: 12%;"><span>Product</span></th>
                        <th class="product-name" style="text-align: center; width: 33%;">Product Name</th>
                        <th class="product-price" style="text-align: center; width: 15%;"><span>Price</span></th>
                        <th class="" style="text-align: center; width: 20%;"><span>Stock Availability</span></th>
                        <th class="wishlist-action" style="text-align: center; width: 20%;">Actions</th>
                    </tr>
                </thead>
                <tbody>
                @php $i=0; @endphp
                                @if($wishCount>0)
                                @foreach ($wishlist as $product)
                                @php  $i++; @endphp
                                
                                <tr>
                                    <td style="text-align: center; vertical-align: middle;" class="product-thumbnail">
                                        @php
                                            static $masterOffersMap = null;
                                            if ($masterOffersMap === null) {
                                                $masterOffersMap = DB::table('master_offers')->get()->keyBy('id');
                                            }
                                            $offerName = '';
                                            $offerId = $product->offers ?? null;
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
                                        @endphp
                                        <div class="p-relative" style="position: relative;">
                                            <a href="{{url('products', $product->slug ?? $product->ecom_product_id)}}">
                                                <figure style="position: relative; margin: 0 auto; width: 80px; height: 80px; display: block;">
                                                    <img src="{{ asset('assets/images/products/' . $product->product_image) }}" alt="product" style="width:80px; height:80px; object-fit:cover;">
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
                                                </figure>
                                            </a>
                                        </div>
                                    </td>
                                    <td style="text-align: center; vertical-align: middle;" class="product-name">
                                        <a href="{{url('products', $product->slug ?? $product->ecom_product_id)}}">
                                        {{ $product->product_name }}
                                        </a>
                                    </td>
                                    <td  style="text-align: center; vertical-align: middle;" class="product-price">
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
                                        <ins class="new-price" style="text-decoration: none;">
                                            <span style="font-family: Arial, sans-serif;">&#8377;</span> {{ $product->selling_price }} 
                                            <del style="font-size: 0.8em; color: #888; font-weight: 400; margin: 0 4px;"><span class="currencySymbol" style="font-family: Arial, sans-serif;">&#8377;</span> {{ $product->retail_price }}</del> 
                                            <span style="color: #27ae60; font-weight: 700; font-size: 1.4rem; margin-left: 5px;">{{ $discount_rounded }}% Off</span>
                                        </ins>
                                    </td>
                                    <td class="product-stock" style="text-align: center; vertical-align: middle; white-space: nowrap;" >
                                        <span class="wishlist-in-stock">In Stock</span>
                                    </td>
                                    <td  style="text-align: center; vertical-align: middle;" class="wishlist-action">
                                        <div style="display: flex; justify-content: center; gap: 10px; align-items: center; flex-wrap: wrap;">
                                            <a href="{{url('delete_wishlist',$product->ecom_wishlist_id)}}"
                                                class="btn btn-default btn-rounded btn-sm">Remove 
                                                </a>
                                            <a href="{{url('products', $product->slug ?? $product->ecom_product_id)}}" class="btn btn-dark btn-rounded btn-sm btn-cart">View</a>
                                        </div>
                                    </td>
                                </tr>
                    
                                @endforeach
                                @else
                                <tr data-id="1">
                                    <td colspan="5">
                                        <center><i class="d-icon-bag"></i> Your Wishlist is Empty</center>
                                    </td>
                                </tr>
                                @endif
                </tbody>
            </table>
            
            <div class="wishlist-actions mt-4 mb-4">
                <a href="{{ url('/home') }}" class="btn back-to-shop btn-dark btn-rounded">Back to Shop</a>
            </div>
        </div>
    </div>

</main>
        
@endsection