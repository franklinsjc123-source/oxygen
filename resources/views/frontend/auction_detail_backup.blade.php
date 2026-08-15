@extends('app_template')
@section('title', $product->product_name . ' - Auction')
@section('content')

<main class="main mb-10 pb-1">
    <style>
        .auction-hero {
            background: linear-gradient(135deg, #1e3c72 0%, #2a5298 100%);
            border-radius: 12px;
            padding: 25px;
            margin-bottom: 15px;
            color: #fff;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(42, 82, 152, 0.2);
        }
        .auction-hero::before {
            content: '';
            position: absolute;
            top: 0; left: 0; width: 6px; height: 100%;
            background: #ffd32a;
        }
        .auction-hero .auction-badge {
            display: inline-flex;
            align-items: center;
            background: rgba(255, 211, 42, 0.2);
            color: #ffd32a;
            padding: 6px 16px;
            border-radius: 30px;
            font-size: 12px;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 12px;
            border: 1px solid rgba(255, 211, 42, 0.3);
        }
        .auction-countdown-box {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
            text-align: center;
            margin-bottom: 15px;
            border: 1px solid #eaeaea;
        }
        .auction-countdown-box .countdown-label {
            font-size: 13px;
            color: #555;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            margin-bottom: 10px;
            font-weight: 700;
        }
        .countdown-timer {
            display: flex;
            justify-content: center;
            gap: 15px;
        }
        .countdown-timer .time-block {
            background: #fff;
            color: #333;
            padding: 10px 15px;
            border-radius: 10px;
            min-width: 60px;
            text-align: center;
            border: 1px solid #eaeaea;
            box-shadow: 0 2px 8px rgba(0,0,0,0.02);
        }
        .countdown-timer .time-block .time-value {
            font-size: 24px;
            font-weight: 800;
            line-height: 1;
            color: #0088dd;
        }
        .countdown-timer .time-block .time-unit {
            font-size: 11px;
            text-transform: uppercase;
            letter-spacing: 1px;
            opacity: 0.6;
            margin-top: 6px;
            font-weight: 600;
        }
        .current-bid-box {
            background: #fff;
            border-radius: 12px;
            padding: 25px;
            text-align: center;
            margin-bottom: 15px;
            border: 1px solid #eaeaea;
            box-shadow: 0 8px 25px rgba(0,0,0,0.04);
            position: relative;
        }
        .current-bid-box .bid-label {
            font-size: 14px;
            color: #666;
            text-transform: uppercase;
            letter-spacing: 1.5px;
            font-weight: 700;
        }
        .current-bid-box .bid-value {
            font-size: 38px;
            font-weight: 800;
            color: #0088dd;
            font-family: 'Inter', sans-serif;
            margin: 5px 0;
            letter-spacing: -1px;
        }
        .current-bid-box .bid-count {
            font-size: 13px;
            color: #888;
            font-weight: 500;
            background: #f4f4f4;
            display: inline-block;
            padding: 4px 12px;
            border-radius: 20px;
        }
        .bid-form-card {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.05);
            margin-bottom: 15px;
            border: 1px solid #f0f0f0;
        }
        .bid-form-card h4 {
            margin: 0 0 20px;
            font-size: 20px;
            font-weight: 700;
            color: #222;
        }
        .bid-input-group {
            display: flex;
            gap: 12px;
            position: relative;
        }
        .bid-input-group input {
            flex: 1;
            border: 2px solid #e5e5e5;
            border-radius: 10px;
            padding: 12px 15px;
            font-size: 18px;
            font-weight: 700;
            outline: none;
            transition: all 0.3s ease;
            color: #333;
        }
        .bid-input-group input:focus {
            border-color: #0088dd;
            box-shadow: 0 0 0 4px rgba(0, 136, 221, 0.1);
        }
        .bid-input-group button {
            background: #0088dd;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 12px 25px;
            font-size: 15px;
            font-weight: 700;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
        }
        .bid-input-group button:hover {
            background: #0077c2;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 136, 221, 0.3);
        }
        .bid-input-group button:disabled {
            opacity: 0.6;
            cursor: not-allowed;
            transform: none;
            box-shadow: none;
        }
        .min-bid-note {
            font-size: 13px;
            color: #777;
            margin-top: 10px;
            font-weight: 500;
        }
        .bid-history-card {
            background: #fff;
            border-radius: 12px;
            padding: 20px;
            box-shadow: 0 5px 25px rgba(0,0,0,0.05);
            border: 1px solid #f0f0f0;
        }
        .bid-history-card h4 {
            margin: 0 0 20px;
            font-size: 20px;
            font-weight: 700;
            color: #222;
        }
        .bid-history-list {
            list-style: none;
            padding: 0;
            margin: 0;
            max-height: 400px;
            overflow-y: auto;
        }
        .bid-history-list::-webkit-scrollbar {
            width: 6px;
        }
        .bid-history-list::-webkit-scrollbar-thumb {
            background: #ddd;
            border-radius: 10px;
        }
        .bid-history-list li {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #f5f5f5;
            transition: background 0.2s;
        }
        .bid-history-list li:last-child {
            border-bottom: none;
        }
        .bid-history-list li:first-child {
            background: rgba(0, 136, 221, 0.05);
            margin: 0 -15px;
            padding: 15px 20px;
            border-radius: 8px;
            border-left: 4px solid #0088dd;
        }
        .bid-history-list .bidder-name {
            font-weight: 700;
            color: #333;
            font-size: 15px;
        }
        .bid-history-list .bid-time {
            font-size: 12px;
            color: #888;
            margin-top: 2px;
        }
        .bid-history-list .bid-amount {
            font-weight: 800;
            color: #333;
            font-size: 18px;
            font-family: 'Inter', sans-serif;
        }
        .bid-history-list li:first-child .bid-amount {
            color: #0088dd;
        }
        .bid-history-list li:first-child .bidder-name::after {
            content: ' 👑';
            font-size: 16px;
        }
        .auction-ended-box {
            background: #ff4757;
            background-image: linear-gradient(135deg, #ff4757 0%, #ff6b81 100%);
            border-radius: 16px;
            padding: 30px;
            text-align: center;
            color: #fff;
            margin-bottom: 20px;
            box-shadow: 0 10px 25px rgba(255, 71, 87, 0.3);
        }
        .auction-ended-box h3 {
            margin: 0;
            font-size: 24px;
            font-weight: 800;
            letter-spacing: 0.5px;
        }
        .auction-ended-box p {
            margin: 10px 0 0;
            opacity: 0.9;
            font-size: 15px;
        }
        .winner-box {
            background: #111;
            border-radius: 16px;
            padding: 30px;
            text-align: center;
            color: #fff;
            margin-bottom: 20px;
            position: relative;
            overflow: hidden;
            border: 2px solid #ffd32a;
            box-shadow: 0 15px 35px rgba(255, 211, 42, 0.2);
        }
        .winner-box::before {
            content: '🌟';
            position: absolute;
            font-size: 120px;
            opacity: 0.05;
            top: -20px; right: -20px;
            transform: rotate(15deg);
        }
        .winner-box h3 {
            margin: 0 0 10px;
            font-size: 22px;
            color: #ffd32a;
        }
        .winner-box p {
            font-size: 16px;
        }
        .winner-box .coupon-display {
            background: rgba(255,255,255,0.1);
            border-radius: 12px;
            padding: 18px;
            margin-top: 20px;
            font-family: 'Courier New', monospace;
            font-size: 28px;
            font-weight: 800;
            letter-spacing: 4px;
            border: 1px dashed rgba(255, 211, 42, 0.5);
            color: #ffd32a;
        }
        .login-prompt {
            background: #fff;
            border: 2px dashed #0088dd;
            border-radius: 16px;
            padding: 25px;
            text-align: center;
            margin-bottom: 20px;
        }
        .login-prompt a {
            color: #0088dd;
            font-weight: 800;
            text-decoration: none;
            padding-bottom: 2px;
            border-bottom: 2px solid #0088dd;
            transition: all 0.3s;
        }
        .login-prompt a:hover {
            color: #0077c2;
            border-bottom-color: #0077c2;
        }
        .product-gallery .product-image {
            background: #fff;
            border-radius: 16px;
            padding: 10px;
            border: 1px solid #f0f0f0;
            box-shadow: 0 5px 25px rgba(0,0,0,0.03);
            text-align: center;
        }
        .product-gallery .product-image img {
            border-radius: 12px;
            object-fit: contain;
            width: 100%;
            height: auto;
            max-height: 500px;
        }
        .product-thumbs .product-thumb {
            cursor: pointer;
            border: 2px solid transparent;
            border-radius: 12px;
            overflow: hidden;
            transition: all 0.3s;
            background: #fff;
            border: 1px solid #eee;
            margin-top: 15px;
        }
        .product-thumbs .product-thumb:hover, 
        .product-thumbs .product-thumb.swiper-slide-thumb-active {
            border-color: #0088dd;
            box-shadow: 0 5px 15px rgba(0,136,221,0.2);
            transform: translateY(-2px);
        }
        .product-thumbs .product-thumb img {
            max-height: 100px;
            object-fit: contain;
            width: 100%;
        }
        .starting-price-info {
            display: flex;
            justify-content: space-between;
            background: #fafafa;
            border: 1px solid #eaeaea;
            border-radius: 12px;
            padding: 12px 15px;
            margin-bottom: 15px;
        }
        .starting-price-info .info-item {
            text-align: center;
            flex: 1;
            border-right: 1px solid #eee;
        }
        .starting-price-info .info-item:last-child {
            border-right: none;
        }
        .starting-price-info .info-label {
            font-size: 12px;
            color: #888;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 600;
            margin-bottom: 4px;
        }
        .starting-price-info .info-value {
            font-size: 18px;
            font-weight: 800;
            color: #222;
        }
        #bid-success-msg, #bid-error-msg {
            display: none;
            padding: 12px 18px;
            border-radius: 10px;
            margin-top: 15px;
            font-size: 14px;
            font-weight: 600;
            align-items: center;
        }
        #bid-success-msg::before {
            content: '✓';
            display: inline-block;
            margin-right: 8px;
            font-weight: bold;
        }
        #bid-error-msg::before {
            content: '✕';
            display: inline-block;
            margin-right: 8px;
            font-weight: bold;
        }
        #bid-success-msg {
            background: #f0fdf4;
            color: #166534;
            border: 1px solid #bbf7d0;
        }
        #bid-error-msg {
            background: #fef2f2;
            color: #991b1b;
            border: 1px solid #fecaca;
        }
    </style>

    <!-- Breadcrumb -->
    <nav class="breadcrumb-nav container">
        <ul class="breadcrumb bb-no">
            <li><a href="{{ url('home') }}">Home</a></li>
            <li><a href="{{ url('auction') }}">Auction</a></li>
            <li>{{ $product->product_name }}</li>
        </ul>
    </nav>

    <!-- Page Content -->
    <div class="page-content">
        <div class="container">
            <div class="row gutter-lg">
                <div class="main-content">
                    <div class="product product-single row">
                        <!-- Left: Product Image -->
                        <div class="col-md-6 mb-4 mb-md-8">
                    <div class="product-gallery product-gallery-sticky">
                        <div class="swiper-container product-single-swiper swiper-theme nav-inner" data-swiper-options="{
                            'navigation': {
                                'nextEl': '.swiper-button-next',
                                'prevEl': '.swiper-button-prev'
                            }
                        }">
                            <div class="swiper-wrapper row cols-1 gutter-no">
                                @if(count($productImages) > 0)
                                    @foreach($productImages as $img)
                                        <div class="swiper-slide">
                                            <figure class="product-image">
                                                <img src="{{ asset('assets/images/products/detail/' . $img) }}"
                                                    data-zoom-image="{{ asset('assets/images/products/detail/' . $img) }}"
                                                    alt="{{ $product->product_name }}">
                                            </figure>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="swiper-slide">
                                        <figure class="product-image">
                                            <img src="{{ asset('assets/images/products/' . $product->product_image) }}"
                                                data-zoom-image="{{ asset('assets/images/products/' . $product->product_image) }}"
                                                alt="{{ $product->product_name }}">
                                        </figure>
                                    </div>
                                @endif
                            </div>
                            <button class="swiper-button-next"></button>
                            <button class="swiper-button-prev"></button>
                        </div>

                        <!-- Thumbnails -->
                        <div class="product-thumbs-wrap swiper-container" data-swiper-options="{
                            'navigation': {
                                'nextEl': '.swiper-button-next',
                                'prevEl': '.swiper-button-prev'
                            }
                        }">
                            <div class="product-thumbs swiper-wrapper row cols-4 gutter-sm">
                                @if(count($productImages) > 0)
                                    @foreach($productImages as $img)
                                        <div class="product-thumb swiper-slide">
                                            <img src="{{ asset('assets/images/products/detail/' . $img) }}" alt="Thumb">
                                        </div>
                                    @endforeach
                                @else
                                    <div class="product-thumb swiper-slide">
                                        <img src="{{ asset('assets/images/products/' . $product->product_image) }}" alt="Thumb">
                                    </div>
                                @endif
                            </div>
                            <button class="swiper-button-next"></button>
                            <button class="swiper-button-prev"></button>
                        </div>
                    </div>

                    <!-- Product Description -->
                    <div class="bid-form-card mt-4" style="margin-top: 30px; clear: both; overflow: hidden; display: block; width: 100%;">
                        <h4>📝 Product Description</h4>
                        <p style="color: #555; line-height: 1.7;">{{ $product->description }}</p>
                    </div>

                </div>

                <!-- Right: Auction Info & Bidding -->
                <div class="col-md-6 mb-6 mb-md-8">

                    <!-- Auction Hero -->
                    <div class="auction-hero">
                        <span class="auction-badge">🔨 Live Auction</span>
                        <h1 style="margin: 5px 0; font-size: 24px; font-weight: 700; color: #ffffff;">{{ $product->product_name }}</h1>
                        @if($vendor)
                            <p style="margin: 0; opacity: 0.85; font-size: 14px;">
                                by <a href="{{ url('/shop/' . ($vendor->slug ?? $vendor->id)) }}" style="color: #fff; text-decoration: underline;">{{ $vendor->shop_name }}</a>
                            </p>
                        @endif
                    </div>

                    <!-- Countdown Timer -->
                    @if(!$isExpired)
                        <div class="auction-countdown-box">
                            <div class="countdown-label">Auction Ends In</div>
                            <div class="countdown-timer" id="auction-countdown">
                                <div class="time-block">
                                    <div class="time-value" id="cd-days">00</div>
                                    <div class="time-unit">Days</div>
                                </div>
                                <div class="time-block">
                                    <div class="time-value" id="cd-hours">00</div>
                                    <div class="time-unit">Hours</div>
                                </div>
                                <div class="time-block">
                                    <div class="time-value" id="cd-minutes">00</div>
                                    <div class="time-unit">Mins</div>
                                </div>
                                <div class="time-block">
                                    <div class="time-value" id="cd-seconds">00</div>
                                    <div class="time-unit">Secs</div>
                                </div>
                            </div>
                        </div>
                    @else
                        <div class="auction-ended-box">
                            <h3>⏰ Auction Has Ended</h3>
                            <p>This auction is no longer accepting bids.</p>
                        </div>
                    @endif

                    <!-- Starting Price & Slab Info -->
                    <div class="starting-price-info">
                        <div class="info-item">
                            <div class="info-label">Starting Price</div>
                            <div class="info-value">₹{{ number_format($auction->start_price, 2) }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Bid Increment</div>
                            <div class="info-value">₹{{ number_format($auction->slab, 2) }}</div>
                        </div>
                        <div class="info-item">
                            <div class="info-label">Total Bids</div>
                            <div class="info-value" id="total-bids-count">{{ $totalBids }}</div>
                        </div>
                    </div>

                    <!-- Current Highest Bid -->
                    <div class="current-bid-box">
                        <div class="bid-label">Current Highest Bid</div>
                        <div class="bid-value" id="current-bid-display">₹{{ number_format($currentBid, 2) }}</div>
                        <div class="bid-count" id="total-bids-text">{{ $totalBids }} bid(s) so far</div>
                    </div>

                    <!-- Winner Info (if auction settled) -->
                    @if($winnerInfo)
                        <div class="winner-box">
                            <h3>🏆 Auction Winner</h3>
                            <p><strong>{{ $winnerInfo['name'] }}</strong> won with ₹{{ number_format($winnerInfo['amount'], 2) }}</p>
                            @if($winnerInfo['is_current_user'] && $winnerInfo['coupon_code'])
                                <div class="coupon-display">{{ $winnerInfo['coupon_code'] }}</div>
                                <p style="margin-top: 10px; font-size: 13px; opacity: 0.85;">Use this coupon code at checkout!</p>
                            @endif
                        </div>
                    @endif

                    <!-- Bid Form (only for logged-in users & active auctions) -->
                    @if(!$isExpired && !$auction->is_settled)
                        @if($isLoggedIn)
                            <div class="bid-form-card">
                                <h4>💰 Place Your Bid</h4>
                                <div class="bid-input-group">
                                    <input type="number" id="bid-amount-input" 
                                        min="{{ $minimumBid }}" 
                                        step="{{ $auction->slab }}" 
                                        value="{{ $minimumBid }}" 
                                        placeholder="Enter your bid amount">
                                    <button id="place-bid-btn" onclick="placeBid()">
                                        Place Bid
                                    </button>
                                </div>
                                <div class="min-bid-note">
                                    Minimum bid: <strong id="min-bid-display">₹{{ number_format($minimumBid, 2) }}</strong> 
                                    (current bid + ₹{{ number_format($auction->slab, 2) }} increment)
                                </div>
                                <div id="bid-success-msg"></div>
                                <div id="bid-error-msg"></div>
                            </div>
                        @else
                            <div class="login-prompt">
                                <p style="margin: 0; font-size: 16px;">
                                    🔒 <a href="{{ url('Cuslogin') }}">Login</a> to place your bid on this auction!
                                </p>
                            </div>
                        @endif
                    @endif



                </div>
                    </div> <!-- End of product row -->
                </div> <!-- End of main-content -->

                <!-- 3rd Column: Sidebar -->
                <aside class="sidebar product-sidebar sidebar-fixed right-sidebar sticky-sidebar-wrapper">
                    <div class="sidebar-overlay"></div>
                    <a class="sidebar-close" href="#"><i class="close-icon"></i></a>
                    <a href="#" class="sidebar-toggle d-flex d-lg-none"><i class="fas fa-chevron-left"></i></a>
                    <div class="sidebar-content scrollable">
                        <div class="sticky-sidebar">
                            <div class="widget widget-icon-box mb-6">
                                <div class="icon-box icon-box-side">
                                    <span class="icon-box-icon text-dark">
                                        <i class="w-icon-truck"></i>
                                    </span> 
                                    <div class="icon-box-content">
                                        <h4 class="icon-box-title">Free Shipping & Returns</h4>
                                        <p>For all orders over ₹499</p>
                                    </div>
                                </div>
                                <div class="icon-box icon-box-side">
                                    <span class="icon-box-icon text-dark">
                                        <i class="w-icon-bag"></i>
                                    </span>
                                    <div class="icon-box-content">
                                        <h4 class="icon-box-title">Secure Payment</h4>
                                        <p>We ensure secure payment</p>
                                    </div>
                                </div>
                                <div class="icon-box icon-box-side">
                                    <span class="icon-box-icon text-dark">
                                        <i class="w-icon-money"></i>
                                    </span>
                                    <div class="icon-box-content">
                                        <h4 class="icon-box-title">Money Back Guarantee</h4>
                                        <p>Any return within 7 - 10 work days</p>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Widget Icon Box -->

                            <div class="widget widget-banner mb-9">
                                <div class="banner banner-fixed br-sm">
                                    <figure>
                                        <img src="{{ asset('frontend/images/shop/banner3.jpg') }}" alt="Banner" width="266"
                                            height="220" style="background-color: #1D2D44;" />
                                    </figure>
                                    <div class="banner-content">
                                        <div class="banner-price-info font-weight-bolder text-white lh-1 ls-25">
                                            40<sup class="font-weight-bold">%</sup><sub
                                                class="font-weight-bold text-uppercase ls-25">Off</sub>
                                        </div>
                                        <h4 class="banner-subtitle text-white font-weight-bolder text-uppercase mb-0">Ultimate Sale</h4>
                                    </div>
                                </div>
                            </div>
                            <!-- End of Widget Banner -->
                        </div>
                    </div>
                </aside>
                
            </div>
        </div>
    </div>
</main>

<script>
    // ===================== COUNTDOWN TIMER =====================
    var auctionEndDate = new Date("{{ $endDate->format('Y-m-d\TH:i:s') }}").getTime();
    var auctionExpired = {{ $isExpired ? 'true' : 'false' }};

    function updateCountdown() {
        if (auctionExpired) return;

        var now = new Date().getTime();
        var diff = auctionEndDate - now;

        if (diff <= 0) {
            document.getElementById('cd-days').textContent = '00';
            document.getElementById('cd-hours').textContent = '00';
            document.getElementById('cd-minutes').textContent = '00';
            document.getElementById('cd-seconds').textContent = '00';
            auctionExpired = true;
            
            // Reload page to show ended state
            setTimeout(function() {
                location.reload();
            }, 2000);
            return;
        }

        var days = Math.floor(diff / (1000 * 60 * 60 * 24));
        var hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((diff % (1000 * 60)) / 1000);

        document.getElementById('cd-days').textContent = days.toString().padStart(2, '0');
        document.getElementById('cd-hours').textContent = hours.toString().padStart(2, '0');
        document.getElementById('cd-minutes').textContent = minutes.toString().padStart(2, '0');
        document.getElementById('cd-seconds').textContent = seconds.toString().padStart(2, '0');
    }

    if (!auctionExpired) {
        updateCountdown();
        setInterval(updateCountdown, 1000);
    }

    // ===================== PLACE BID =====================
    function placeBid() {
        var bidAmount = parseFloat(document.getElementById('bid-amount-input').value);
        var btn = document.getElementById('place-bid-btn');
        var successMsg = document.getElementById('bid-success-msg');
        var errorMsg = document.getElementById('bid-error-msg');

        if (isNaN(bidAmount) || bidAmount <= 0) {
            errorMsg.style.display = 'flex';
            errorMsg.textContent = 'Please enter a valid bid amount.';
            successMsg.style.display = 'none';
            return;
        }

        btn.disabled = true;
        btn.textContent = 'Placing...';

        fetch("{{ route('auction.bid') }}", {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                'Accept': 'application/json',
            },
            body: JSON.stringify({
                auction_id: {{ $auction->id }},
                bid_amount: bidAmount
            })
        })
        .then(function(res) { return res.json(); })
        .then(function(data) {
            btn.disabled = false;
            btn.textContent = 'Place Bid';

            if (data.success) {
                successMsg.style.display = 'flex';
                successMsg.textContent = data.message;
                errorMsg.style.display = 'none';

                // Update current bid display
                document.getElementById('current-bid-display').textContent = '₹' + parseFloat(bidAmount).toLocaleString('en-IN', {minimumFractionDigits: 2});
                document.getElementById('total-bids-count').textContent = data.total_bids;
                document.getElementById('total-bids-text').textContent = data.total_bids + ' bid(s) so far';

                // Update minimum bid
                document.getElementById('min-bid-display').textContent = '₹' + parseFloat(data.new_minimum_bid).toLocaleString('en-IN', {minimumFractionDigits: 2});
                document.getElementById('bid-amount-input').min = data.new_minimum_bid;
                document.getElementById('bid-amount-input').value = data.new_minimum_bid;



                // Hide success msg after 3 seconds
                setTimeout(function() {
                    successMsg.style.display = 'none';
                }, 3000);
            } else {
                errorMsg.style.display = 'flex';
                errorMsg.textContent = data.message;
                successMsg.style.display = 'none';
            }
        })
        .catch(function(err) {
            btn.disabled = false;
            btn.textContent = 'Place Bid';
            errorMsg.style.display = 'flex';
            errorMsg.textContent = 'Something went wrong. Please try again.';
            successMsg.style.display = 'none';
        });
    }

    // ===================== AUTO-REFRESH BIDS =====================
    @if(!$isExpired)
    setInterval(function() {
        fetch("{{ route('auction.bids', $auction->id) }}")
        .then(function(res) { return res.json(); })
        .then(function(data) {
            // Update current bid
            document.getElementById('current-bid-display').textContent = '₹' + parseFloat(data.current_bid).toLocaleString('en-IN', {minimumFractionDigits: 2});
            document.getElementById('total-bids-count').textContent = data.total_bids;
            document.getElementById('total-bids-text').textContent = data.total_bids + ' bid(s) so far';

            var minBidEl = document.getElementById('min-bid-display');
            var bidInput = document.getElementById('bid-amount-input');
            if (minBidEl) {
                minBidEl.textContent = '₹' + parseFloat(data.minimum_bid).toLocaleString('en-IN', {minimumFractionDigits: 2});
            }
            if (bidInput && parseFloat(bidInput.value) < data.minimum_bid) {
                bidInput.min = data.minimum_bid;
                bidInput.value = data.minimum_bid;
            }



            // If auction was settled, reload
            if (data.is_settled) {
                location.reload();
            }
        })
        .catch(function() {});
    }, 5000); // Refresh every 5 seconds
    @endif
</script>

@endsection
