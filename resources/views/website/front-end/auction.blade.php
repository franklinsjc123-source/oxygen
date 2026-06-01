@extends('app_template')
@section('title',' Auction Products')
@section('content')

<main class="main">
    <!-- Start of Breadcrumb -->
    <nav class="breadcrumb-nav">
        <div class="container">
            <ul class="breadcrumb bb-no">
                <li><a href="{{ url('home')}}">Home</a></li>
                <li><a href="{{ url('auction') }}"> Auction </a> </li>
            </ul>
        </div>
    </nav>
    <!-- End of Breadcrumb -->

    <!-- Start of Page Content -->
    <div class="page-content mb-8 mt-5">
        <div class="container">
            <div class="toolbox vendor-toolbox pb-0">
                <div class="toolbox-left mb-4 mb-md-0">
                    <h2><label class="d-block">Auction Products</label></h2>
                </div>
            </div>

            <div class="product-wrapper row cols-md-6 cols-sm-2 cols-2" id="productslist">
                @foreach($auction as $auct)
                    @php
                        // If end_date doesn't exist or is invalid, skip
                        if(empty($auct->end_date)) continue;
                        
                        $endDateStr = str_replace('T', ' ', $auct->end_date);
                        try {
                            $parsedDate = \Carbon\Carbon::parse($endDateStr);
                        } catch (\Exception $e) {
                            continue;
                        }
                        
                        // Filter out expired auctions
                        if (\Carbon\Carbon::now()->greaterThanOrEqualTo($parsedDate)) {
                            continue;
                        }
                        
                        $formattedForJs = $parsedDate->format('Y, n, j, G, i, s');
                        $productdetails = App\Models\Products\Products::where('product_id', $auct->product_id)->get();
                    @endphp
                    
                    @foreach($productdetails as $product)
                        <div class="product-wrap">
                            <div class="product text-center">
                                <figure class="product-media">
                                    <a href="{{ url('/productVar/'.$product->id) }}">
                                        <img src="{{ asset('assets/images/products/'.$product->product_image) }}" alt="Product" />
                                    </a>
                                    
                                    <div class="product-action-vertical">
                                        <a href="{{ url('/productVar/'.$product->id) }}" class="btn-product-icon w-icon-cart"></a>
                                        <a href="#" onclick="addwishlist('{{ $product->id }}')" class="btn-product-icon btn-wishlist w-icon-heart"><span></span></a>
                                        <a href="#" onclick="showQuickView('{{ $product->id }}')" data-id="{{ $product->id }}" class="btn-product-icon btn-quickview w-icon-search"></a>
                                    </div>
                                    
                                    <div class="product-countdown-container">
                                        <div class="product-countdown countdown-compact" data-until="{{ $formattedForJs }}"
                                            data-format="DHMS" data-compact="false" data-labels-short="Days, Hrs, Mins, Secs">
                                            00:00:00:00
                                        </div>
                                    </div>
                                </figure>
                        
                                 <div class="product-details">
                                     @php
                                        $vendor_id = $product->vendor_id;
                                        $vendor_detail = \Illuminate\Support\Facades\DB::table('vendor_details')->where('id', $vendor_id)->first();
                                        $shop_name = $vendor_detail ? $vendor_detail->shop_name : 'Admin';
                                     @endphp
                                     <div class="sold-by" style="margin-bottom: 2px;">
                                         <a href="{{ url('/shop/' . ($vendor_slug ?? $vendor_id ?? '#')) }}" style="color: #0088dd; font-weight: 700; font-size: 1.3rem;">
                                             {{ $shop_name }}
                                         </a>
                                     </div>
                                     <h4 class="product-name" style="margin-bottom: 5px; font-weight: 500; font-size: 1.4rem;">
                                         <a href="{{ url('/productVar/'.$product->id) }}" style="color: #333; text-decoration: none;">
                                            {{ $product->product_name }}
                                         </a>
                                     </h4>
                         
                                     <div class="ratings-container" style="margin-bottom: 5px;">
                                         <div class="ratings-full">
                                             <span class="ratings" style="width: {{ $product->rating_percent ?? 0 }}%"></span>
                                         </div>
                                         <a class="rating-reviews" style="font-size: 1.1rem; color: #0088dd;">({{ $product->review_count ?? 0 }} Reviews)</a>
                                     </div>
                         
                                     <div class="product-pa-wrapper" style="display: flex; align-items: center; justify-content: center; padding-top: 5px;">
                                         <div class="product-price-home" style="font-family: monospace; font-size: 1.6rem; font-weight: 700; color: #000;" title="Bid Amount">
                                            <span style="color: #666; font-size: 1.4rem; font-weight: 600; margin-right: 5px; font-family: inherit;">Bid:</span>₹{{ $auct->bid_price ?? $auct->start_price ?? 0 }}
                                         </div>
                                     </div>
                                 </div>
                            </div>
                        </div>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
</main>
@endsection
