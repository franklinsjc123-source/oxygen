@extends('app_template')
@section('title', $product->product_name . ' - Auction')
@section('content')

<main class="main mb-10 pb-1" style="background-color: #f8fafc;  padding-bottom: 60px;">
    <style>
        .comment-action { display: none !important; }
        .comments li { padding: 10px 0 !important; margin: 0 !important; }
        .comment-body { padding: 0 !important; margin: 0 !important; }
        .comment-content { padding: 0 !important; margin: 0 !important; }
        
        /* Mobile horizontal scroll for product detail tabs */
        @media (max-width: 767px) {
            .product-tabs .nav-tabs {
                display: flex !important;
                flex-wrap: nowrap !important;
                overflow-x: auto !important;
                white-space: nowrap !important;
                -webkit-overflow-scrolling: touch !important;
                border-bottom: 1px solid #eee !important;
                padding-bottom: 2px !important;
            }
            .product-tabs .nav-tabs::-webkit-scrollbar {
                display: none !important;
            }
            .product-tabs .nav-tabs .nav-item {
                flex: 0 0 auto !important;
                margin-right: 15px !important;
                margin-bottom: 0 !important;
            }
            .product-tabs .nav-tabs .nav-link {
                padding: 8px 10px !important;
                font-size: 13px !important;
            }
        }

        /* Clean Premium Minimalist Style */
        .auction-page-wrapper { color: #1e293b; }

        .tm-title { font-size: 26px; font-weight: 800; color: #0f172a; margin-bottom: 25px; line-height: 1.25; letter-spacing: -0.5px; }
        
         .tm-timer-blocks { display: flex; gap: 6px; margin-bottom: 24px; }
         .timer-block { background: #4b4b4b; color: #fff; padding: 12px 10px; text-align: center; flex: 1; border-radius: 6px; display: flex; flex-direction: column; justify-content: center; }
         .timer-block span { font-size: 26px; font-weight: 700; display: block; line-height: 1; margin-bottom: 4px; color: #fff; }
         .timer-block small { font-size: 14px; font-weight: 500; text-transform: capitalize; color: #e2e8f0; }
         .timer-block-days span { color: #f97316; }
 
 
         .tm-bid-box { background: #fff; border-radius: 20px; margin-bottom: 24px; overflow: hidden; box-shadow: 0 10px 40px rgba(0,0,0,0.04); border: 1px solid #f1f5f9; transition: transform 0.3s ease; }
         .tm-bid-box:hover { transform: translateY(-3px); box-shadow: 0 15px 50px rgba(0,0,0,0.06); }
         .tm-bid-box-inner { padding: 40px 32px; text-align: center; position: relative; }
         
         .tm-current-bid-label { font-size: 14px; color: #64748b; margin-bottom: 10px; font-weight: 700; text-transform: uppercase; letter-spacing: 1.5px; }
         .tm-current-bid-value { font-size: 44px; font-weight: 800; color: #000; margin-bottom: 30px; line-height: 1; letter-spacing: normal; font-family: inherit; }
         
         .tm-bid-input-group { display: flex; gap: 0; margin-bottom: 15px; background: #f8fafc; border: 2px solid #e2e8f0; border-radius: 16px; padding: 6px; transition: all 0.3s ease; align-items: stretch; }
         .tm-bid-input-group:focus-within { border-color: #3b82f6; background: #fff; box-shadow: 0 8px 25px rgba(59,130,246,0.15); transform: translateY(-2px); }
         .tm-bid-currency { display: flex; align-items: center; padding-left: 20px; font-size: 20px; font-weight: 800; color: #64748b; font-family: Arial, sans-serif; user-select: none; }
         .tm-bid-input { flex: 1; padding: 16px 12px; border: none; background: transparent; font-size: 20px; font-weight: 800; color: #0f172a; text-align: left; width: 100%; }
         .tm-bid-input:focus { outline: none; }
         .tm-bid-input::placeholder { color: #94a3b8; font-weight: 600; font-size: 16px; }
         .tm-place-bid-btn { background: #0f172a; color: #fff; border: none; padding: 0 32px; font-weight: 700; font-size: 16px; border-radius: 12px; cursor: pointer; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); white-space: nowrap; }
         .tm-place-bid-btn:hover { background: #2563eb; box-shadow: 0 8px 25px rgba(37,99,235,0.3); }
         .tm-place-bid-btn:disabled { background: #cbd5e1; cursor: not-allowed; box-shadow: none; color: #94a3b8; }
 
         .tm-reserve-status { font-size: 14px; color: #059669; margin-bottom: 8px; font-weight: 700; background: #d1fae5; display: inline-block; padding: 6px 16px; border-radius: 20px; letter-spacing: 0.5px; }
         .tm-bid-history-link { font-size: 18px; color: #64748b; text-decoration: none; font-weight: 600; display: block; margin-top: 8px; transition: color 0.2s; }
         .tm-bid-history-link:hover { color: #2563eb; text-decoration: underline; }
        
        .tm-shipping-info { background: #f8fafc; border-top: 1px solid #f1f5f9; padding: 20px 32px; font-size: 15px; color: #475569; display: flex; align-items: center; font-weight: 600; }
        .tm-shipping-info i { margin-right: 14px; font-size: 20px; color: #94a3b8; }
        
        .tm-seller-box { background: #fff; border: 1px solid #f1f5f9; border-radius: 16px; padding: 24px; display: flex; align-items: center; box-shadow: 0 4px 20px rgba(0,0,0,0.02); transition: all 0.3s ease; }
        .tm-seller-box:hover { box-shadow: 0 8px 30px rgba(0,0,0,0.05); transform: translateY(-2px); border-color: #e2e8f0; }
        .tm-seller-avatar { width: 70px; height: 70px; border-radius: 50%; object-fit: cover; margin-right: 20px; border: 3px solid #f1f5f9; padding: 3px; background: #fff; }
        .tm-seller-info h4 { margin: 0 0 6px; font-size: 18px; font-weight: 800; }
        .tm-seller-info h4 a { color: #0f172a; text-decoration: none; transition: color 0.2s; }
        .tm-seller-info h4 a:hover { color: #2563eb; }
        .tm-seller-info .tm-feedback { font-size: 14px; color: #059669; font-weight: 700; margin-bottom: 4px; display: flex; align-items: center; }
        .tm-seller-info .tm-feedback i { color: #10b981; margin-right: 6px; font-size: 16px; }
        .tm-seller-info .tm-location { font-size: 13px; color: #64748b; font-weight: 500; display: flex; align-items: center; }
        .tm-seller-info .tm-location i { margin-right: 6px; }

        .tm-gallery { background: #fff; border-radius: 20px; overflow: hidden; margin-bottom: 30px; padding: 30px; box-shadow: 0 10px 40px rgba(0,0,0,0.03); border: 1px solid #f1f5f9; text-align: center; }
        .tm-main-image { width: 100%; height: auto; max-height: 420px; object-fit: contain; border-radius: 12px; transition: opacity 0.3s; }
        .tm-thumbnails { display: flex; gap: 16px; margin-top: 30px; flex-wrap: wrap; justify-content: center; }
        .tm-thumb { width: 75px; height: 75px; border: 2px solid transparent; cursor: pointer; object-fit: contain; padding: 8px; background: #f8fafc; border-radius: 16px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); opacity: 0.7; }
        .tm-thumb:hover, .tm-thumb.active { border-color: #3b82f6; background: #fff; box-shadow: 0 8px 20px rgba(59,130,246,0.15); transform: translateY(-4px); opacity: 1; }
        
        .tm-details-section { background: #fff; border-radius: 20px; padding: 40px; box-shadow: 0 10px 40px rgba(0,0,0,0.03); border: 1px solid #f1f5f9; }
        .tm-details-flex { display: flex; justify-content: space-between; align-items: center; border-bottom: 2px solid #f8fafc; padding-bottom: 20px; margin-bottom: 24px; }
        .tm-details-title { font-size: 20px; font-weight: 800; color: #0f172a; margin: 0; }
        .tm-details-condition { background: #f1f5f9; padding: 8px 20px; border-radius: 30px; font-size: 14px; font-weight: 700; color: #334155; }
        .tm-details-description { font-size: 15px; line-height: 1.8; color: #475569; font-weight: 400; }

        /* Status Messages */
        .msg-box { display: none; padding: 16px 20px; border-radius: 12px; margin-bottom: 20px; font-size: 15px; font-weight: 600; align-items: center; gap: 12px; }
        #bid-success-msg { background: #ecfdf5; color: #065f46; border: 1px solid #a7f3d0; display: none; }
        #bid-error-msg { background: #fef2f2; color: #991b1b; border: 1px solid #fecaca; display: none; }

        /* Premium Specifications Table Styling */
        .product-specs-table {
            width: 100%;
            margin-top: 1.5rem;
            margin-bottom: 1.5rem;
            border-collapse: separate;
            border-spacing: 0;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            overflow: hidden;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05), 0 2px 4px -1px rgba(0, 0, 0, 0.03);
        }

        .product-specs-table tr {
            transition: background-color 0.2s ease;
        }

        .product-specs-table tr:not(:last-child) {
            border-bottom: 1px solid #e2e8f0;
        }

        .product-specs-table tr:hover {
            background-color: #f8fafc;
        }

        .product-specs-table th.spec-label {
            width: 30%;
            padding: 8px 16px;
            font-size: 12px;
            font-weight: 600;
            color: #475569;
            text-align: left;
            background-color: #f8fafc;
            border-right: 1px solid #e2e8f0;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .product-specs-table td.spec-value {
            padding: 8px 16px;
            font-size: 13px;
            color: #1e293b;
            font-weight: 500;
        }

        /* Responsive styling for specifications */
        @media (max-width: 768px) {
            .product-specs-table {
                border-radius: 8px;
            }
            .product-specs-table tr {
                display: flex;
                flex-direction: column;
            }
            .product-specs-table tr:not(:last-child) {
                border-bottom: 1px solid #e2e8f0;
            }
            .product-specs-table th.spec-label {
                width: 100%;
                padding: 8px 12px 2px;
                border-right: none;
                background-color: transparent;
                color: #64748b;
                font-size: 11px;
            }
            .product-specs-table td.spec-value {
                width: 100%;
                padding: 2px 12px 8px;
                font-size: 12px;
            }
        }
        /* Bid History Modal Styles */
        .tm-modal {
            display: none; 
            position: fixed; 
            z-index: 1050; 
            left: 0;
            top: 0;
            width: 100%; 
            height: 100%; 
            overflow: auto; 
            background-color: rgba(15, 23, 42, 0.6); 
            backdrop-filter: blur(4px);
            align-items: center;
            justify-content: center;
            opacity: 0;
            transition: opacity 0.3s ease;
        }
        .tm-modal.show {
            display: flex;
            opacity: 1;
        }
        .tm-modal-content {
            background-color: #fff;
            margin: auto;
            padding: 32px;
            border: 1px solid #e2e8f0;
            width: 90%;
            max-width: 500px;
            border-radius: 20px;
            box-shadow: 0 20px 25px -5px rgba(0, 0, 0, 0.1), 0 10px 10px -5px rgba(0, 0, 0, 0.04);
            transform: scale(0.95);
            transition: transform 0.3s ease;
        }
        .tm-modal.show .tm-modal-content {
            transform: scale(1);
        }
        .tm-modal-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #f1f5f9;
            padding-bottom: 16px;
            margin-bottom: 20px;
        }
        .tm-modal-header h3 {
            margin: 0;
            font-size: 20px;
            font-weight: 800;
            color: #0f172a;
        }
        .tm-modal-close {
            color: #94a3b8;
            font-size: 28px;
            font-weight: bold;
            cursor: pointer;
            line-height: 1;
            transition: color 0.2s;
        }
        .tm-modal-close:hover {
            color: #0f172a;
        }
        .tm-history-table th {
            font-size: 14px;
            color: #475569;
            font-weight: 700;
            border-bottom: 2px solid #f1f5f9;
            padding: 12px 8px;
        }
        .tm-history-table td {
            font-size: 15px;
            color: #0f172a;
            border-bottom: 1px solid #f1f5f9;
            padding: 12px 8px;
        }
        .tm-history-table tr:last-child td {
            border-bottom: none;
        }
    </style>

    <div class="auction-page-wrapper">
        <nav class="breadcrumb-nav">
            <div class="container">
                <ul class="breadcrumb bb-no">
                    <li><a href="{{ url('home') }}">Home</a></li>
                    <li><a href="{{ url('auction') }}">Auction</a></li>
                    <li>{{ $product->product_name }}</li>
                </ul>
            </div>
        </nav>

        <div class="page-content mt-4">
            <div class="container">
                <div class="row">
                    <!-- Left: Image Gallery & Details -->
                    <div class="col-lg-8 col-md-7 mb-4 pr-lg-4">
                        <div class="tm-gallery">
                            @if(count($productImages) > 0)
                                <img src="{{ asset('assets/images/products/detail/' . $productImages[0]) }}" class="tm-main-image" id="main-product-image" alt="{{ $product->product_name }}">
                                <div class="tm-thumbnails">
                                    @foreach($productImages as $index => $img)
                                        <img src="{{ asset('assets/images/products/detail/' . $img) }}" class="tm-thumb {{ $index == 0 ? 'active' : '' }}" onclick="changeImage(this, '{{ asset('assets/images/products/detail/' . $img) }}')" alt="Thumb">
                                    @endforeach
                                </div>
                            @else
                                <img src="{{ asset('assets/images/products/' . $product->product_image) }}" class="tm-main-image" id="main-product-image" alt="{{ $product->product_name }}">
                            @endif
                        </div>
                    </div>

                    <!-- Right: Bidding & Info -->
                    <div class="col-lg-4 col-md-5 mb-4 pl-lg-4">
                        <h1 class="tm-title">{{ $product->product_name }}</h1>
                        
                        @if(!$isExpired)
                            @if($hasNotStarted)
                                <div style="font-size: 14px; font-weight: 800; color: #2563eb; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 1px;"><i class="far fa-clock" style="margin-right: 4px;"></i> Starts In:</div>
                            @else
                                <div style="font-size: 14px; font-weight: 800; color: #ef4444; margin-bottom: 8px; text-transform: uppercase; letter-spacing: 1px;"><i class="far fa-clock" style="margin-right: 4px;"></i> Ends In:</div>
                            @endif
                            <div class="tm-timer-blocks" id="countdown-display">
                                <div class="timer-block timer-block-days">
                                    <span id="timer-days">00</span>
                                    <small>Days</small>
                                </div>
                                <div class="timer-block">
                                    <span id="timer-hours">00</span>
                                    <small>Hrs</small>
                                </div>
                                <div class="timer-block">
                                    <span id="timer-mins">00</span>
                                    <small>Mins</small>
                                </div>
                                <div class="timer-block">
                                    <span id="timer-secs">00</span>
                                    <small>Secs</small>
                                </div>
                            </div>
                        @else
                            <div class="tm-timer-blocks">
                                <div class="timer-block" style="background: #dc2626;">
                                    <span style="font-size: 16px; margin-bottom: 4px;">Auction Closed</span>
                                    <small>Ended on {{ $endDate->format('D, j M, g:ia') }}</small>
                                </div>
                            </div>
                        @endif

                        <div class="tm-bid-box">
                            <div class="tm-bid-box-inner">
                                <div class="tm-current-bid-label">Current Highest Bid</div>
                                <div class="tm-current-bid-value" id="current-bid-display" style="margin-bottom: 8px;"><span style="font-family: Arial, sans-serif;">₹</span>{{ number_format($currentBid, 2) }}</div>
                                @if(count($bidList) > 0)
                                    <div id="highest-bidder-display" style="margin-bottom: 25px; display: flex; justify-content: center;">
                                        <span style="background: #fef3c7; color: #92400e; border: 1px solid #fde68a; padding: 6px 16px; border-radius: 20px; font-weight: 700; font-size: 14px; display: inline-flex; align-items: center; gap: 6px; text-transform: capitalize; box-shadow: 0 2px 10px rgba(217, 119, 6, 0.08);">
                                            Highest Bidder: {{ $bidList[0]['customer_name'] }} <i class="fas fa-crown" style="color: #d97706;"></i>
                                        </span>
                                    </div>
                                @else
                                    <div id="highest-bidder-display" style="margin-bottom: 25px; display: none; justify-content: center;"></div>
                                @endif
                                
                                <div id="bid-success-msg" class="msg-box"><i class="fas fa-check-circle"></i> <span></span></div>
                                <div id="bid-error-msg" class="msg-box"><i class="fas fa-exclamation-circle"></i> <span></span></div>

                                @if(!$isExpired && !$auction->is_settled)
                                    @if($hasNotStarted)
                                        <div style="margin-bottom: 20px; padding: 20px; border: 2px dashed #fca5a5; border-radius: 16px; background: #fef2f2; color: #991b1b; font-weight: 600; text-align: center;">
                                            <i class="fas fa-exclamation-circle" style="margin-right: 6px;"></i> This auction has not started yet.
                                        </div>
                                    @elseif($isLoggedIn)
                                        <div class="tm-bid-input-group">
                                            <div class="tm-bid-currency">₹</div>
                                            <input type="number" id="bid-amount-input" class="tm-bid-input"
                                                min="{{ $minimumBid }}" 
                                                step="{{ $auction->slab }}" 
                                                value="{{ $minimumBid }}" 
                                                placeholder="Enter {{ number_format($minimumBid, 2) }} or more">
                                            <button class="tm-place-bid-btn" id="place-bid-btn" onclick="placeBid()">Place Bid</button>
                                        </div>
                                        <div style="font-size: 14px; color: #64748b; margin-bottom: 20px; font-weight: 500;">
                                            Minimum next bid: <span style="font-family: Arial, sans-serif;">₹</span><span id="min-bid-display">{{ number_format($minimumBid, 2) }}</span>
                                        </div>
                                    @else
                                        <div style="margin-bottom: 20px; padding: 20px; border: 2px dashed #cbd5e1; border-radius: 16px; background: #f8fafc;">
                                            <a href="javascript:void(0)" onclick="showLoginPopup()" style="color: #2563eb; font-weight: 700; text-decoration: none;">Log in</a> to place your bid.
                                        </div>
                                    @endif
                                @endif

                                @if($totalBids > 0)

                                    <a href="javascript:void(0)" class="tm-bid-history-link" id="total-bids-text" onclick="openHistoryModal()">{{ $totalBids }} bid{{ $totalBids > 1 ? 's' : '' }} so far – view history</a>
                                @else
                                    <div class="tm-reserve-status" style="background: #f1f5f9; color: #475569;"><i class="fas fa-info-circle" style="margin-right: 4px;"></i> No bids yet</div>
                                    <div style="font-size: 15px; color: #64748b; margin-top: 8px; font-weight: 500;">Be the first to bid!</div>
                                @endif
                            </div>
                        </div>

                        <!-- Bid History Modal -->
                        <div id="bid-history-modal" class="tm-modal">
                            <div class="tm-modal-content">
                                <div class="tm-modal-header">
                                    <h3>Bid History (Past 5 Bids)</h3>
                                    <span class="tm-modal-close" onclick="closeHistoryModal()">&times;</span>
                                </div>
                                <div class="tm-modal-body">
                                    <div id="bid-history-loading" style="text-align: center; padding: 20px; color: #64748b;">
                                        <i class="fas fa-spinner fa-spin" style="font-size: 24px; margin-bottom: 10px;"></i>
                                        <div>Loading history...</div>
                                    </div>
                                    <table class="tm-history-table" id="bid-history-table" style="display: none; width: 100%; border-collapse: collapse;">
                                        <thead>
                                            <tr style="border-bottom: 2px solid #f1f5f9; text-align: left;">
                                                <th style="padding: 12px 8px; color: #475569; font-weight: 700;">Bidder</th>
                                                <th style="padding: 12px 8px; color: #475569; font-weight: 700; text-align: right;">Amount</th>
                                                <th style="padding: 12px 8px; color: #475569; font-weight: 700; text-align: right;">Time</th>
                                            </tr>
                                        </thead>
                                        <tbody id="bid-history-tbody">
                                            <!-- Bids will be dynamically injected here -->
                                        </tbody>
                                    </table>
                                    <div id="no-bids-message" style="display: none; text-align: center; padding: 30px; color: #64748b;">
                                        <i class="fas fa-gavel" style="font-size: 36px; color: #cbd5e1; margin-bottom: 12px; display: block;"></i>
                                        No bids have been placed yet.
                                    </div>
                                </div>
                            </div>
                        </div>


                        @if($winnerInfo)
                            <div class="tm-seller-box" style="margin-top: 20px; border-color: #fcd34d; background: #fffbeb; box-shadow: 0 4px 20px rgba(245,158,11,0.1);">
                                <div class="tm-seller-info" style="width: 100%; text-align: center;">
                                    <h4 style="color: #d97706; font-size: 20px; margin-bottom: 10px;">🏆 Auction Winner</h4>
                                    <div style="font-size: 18px; margin-top: 5px; color: #1e293b;"><strong>{{ $winnerInfo['name'] }}</strong> won with <span style="color: #2563eb; font-weight: 800;">₹{{ number_format($winnerInfo['amount'], 2) }}</span></div>
                                    @if($winnerInfo['is_current_user'] && $winnerInfo['coupon_code'])
                                        <div style="margin-top: 15px; font-family: monospace; font-size: 22px; font-weight: bold; padding: 12px; background: #fff; border: 2px dashed #fcd34d; border-radius: 12px; color: #d97706;">{{ $winnerInfo['coupon_code'] }}</div>
                                        <div style="font-size: 14px; margin-top: 8px; color: #64748b; font-weight: 500;">Use this code at checkout</div>
                                    @endif
                                </div>
                            </div>
                        @endif

                    </div>
                </div>
                
                <div class="row mt-8">
                    <div class="col-12">
<div style="background: #fff; border-radius: 20px; padding: 30px; box-shadow: 0 4px 20px rgba(0,0,0,0.03); margin-bottom: 40px;">
                     <div class="tab tab-nav-boxed tab-nav-underline product-tabs">
                         <ul class="nav nav-tabs" role="tablist">
                             <li class="nav-item">
                                 <a href="#product-tab-description" class="nav-link active">Description</a>
                             </li>
                             <li class="nav-item">
                                 <a href="#product-tab-specification" class="nav-link">Specification</a>
                             </li>
                             
                             <li class="nav-item">
                                 <a href="#product-tab-reviews" class="nav-link">Customer Reviews ({{ $reviewCount }})</a>
                             </li>
                         </ul>
                         <div class="tab-content">
                             <div class="tab-pane active" id="product-tab-description">
                                 <div class="row mb-4">
                                     <div class="col-md-12 mb-5">
                                         <h4 class="title tab-pane-title font-weight-bold mb-2">Product details</h4>
                                         <p class="mb-4">{!! $product->description !!}</p>
                                     </div>
                                    
                                 </div>
                                 
                             </div>
                             <div class="tab-pane" id="product-tab-specification">
                                  @if(count($ProductSpecs) > 0)
                                      <table class="product-specs-table">
                                          <tbody>
                                              @foreach ($ProductSpecs as $spec)
                                                  <tr>
                                                      <th class="spec-label">{{ $spec->specify_attribute }}</th>
                                                      <td class="spec-value">{{ $spec->specify_value }}</td>
                                                  </tr>
                                              @endforeach
                                          </tbody>
                                      </table>
                                  @else
                                      <div style="text-align: center; padding: 40px 20px; color: #64748b;">
                                          <i class="w-icon-exclamation-circle" style="font-size: 32px; margin-bottom: 10px; display: block; color: #cbd5e1;"></i>
                                          <span>No specifications available for this product.</span>
                                      </div>
                                  @endif
                              </div>
                             <div class="tab-pane" id="product-tab-reviews">
                                  @php
                                      $totalRatingsCount = count($ratings);
                                      $recommendedRatingsCount = $ratings->where('star_rating', '>=', 4)->count();
                                      $recommendPercentage = $totalRatingsCount > 0 ? round(($recommendedRatingsCount / $totalRatingsCount) * 100) : 0;
                                      
                                      $star5Count = $ratings->where('star_rating', 5)->count();
                                      $star4Count = $ratings->where('star_rating', 4)->count();
                                      $star3Count = $ratings->where('star_rating', 3)->count();
                                      $star2Count = $ratings->where('star_rating', 2)->count();
                                      $star1Count = $ratings->where('star_rating', 1)->count();
                                      
                                      $star5Percent = $totalRatingsCount > 0 ? round(($star5Count / $totalRatingsCount) * 100) : 0;
                                      $star4Percent = $totalRatingsCount > 0 ? round(($star4Count / $totalRatingsCount) * 100) : 0;
                                      $star3Percent = $totalRatingsCount > 0 ? round(($star3Count / $totalRatingsCount) * 100) : 0;
                                      $star2Percent = $totalRatingsCount > 0 ? round(($star2Count / $totalRatingsCount) * 100) : 0;
                                      $star1Percent = $totalRatingsCount > 0 ? round(($star1Count / $totalRatingsCount) * 100) : 0;
                                  @endphp
                                  <div class="row mb-4">
                                      <div class="col-xl-12 col-lg-12 mb-4">
                                          <div class="ratings-wrapper">
                                              <div class="avg-rating-container">
                                                  <h4 class="avg-mark font-weight-bolder ls-50">{{ round($avg, 1) }}</h4>
                                                  <div class="avg-rating">
                                                      <p class="text-dark mb-1">Average Rating</p>
                                                      <div class="ratings-container">
                                                          <div class="ratings-full">
                                                              <span class="ratings" style="width: {{ $percent }}%;"></span>
                                                              <span class="tooltiptext tooltip-top"></span>
                                                          </div>
                                                          <a href="#" class="rating-reviews">({{ $reviewCount }} Reviews)</a>
                                                      </div>
                                                  </div>
                                              </div>
                                              <div
                                                  class="ratings-value d-flex align-items-center text-dark ls-25">
                                                  <span
                                                      class="text-dark font-weight-bold">{{ $recommendPercentage }}%</span>Recommended<span
                                                      class="count">({{ $recommendedRatingsCount }} of {{ $totalRatingsCount }})</span>
                                              </div>
                                              <div class="ratings-list">
                                                  <div class="ratings-container">
                                                      <div class="ratings-full">
                                                          <span class="ratings" style="width: 100%;"></span>
                                                          <span class="tooltiptext tooltip-top"></span>
                                                      </div>
                                                      <div class="progress-bar progress-bar-sm ">
                                                          <span style="width: {{ $star5Percent }}%;"></span>
                                                      </div>
                                                      <div class="progress-value">
                                                          <mark>{{ $star5Percent }}%</mark>
                                                      </div>
                                                  </div>
                                                  <div class="ratings-container">
                                                      <div class="ratings-full">
                                                          <span class="ratings" style="width: 80%;"></span>
                                                          <span class="tooltiptext tooltip-top"></span>
                                                      </div>
                                                      <div class="progress-bar progress-bar-sm ">
                                                          <span style="width: {{ $star4Percent }}%;"></span>
                                                      </div>
                                                      <div class="progress-value">
                                                          <mark>{{ $star4Percent }}%</mark>
                                                      </div>
                                                  </div>
                                                  <div class="ratings-container">
                                                      <div class="ratings-full">
                                                          <span class="ratings" style="width: 60%;"></span>
                                                          <span class="tooltiptext tooltip-top"></span>
                                                      </div>
                                                      <div class="progress-bar progress-bar-sm ">
                                                          <span style="width: {{ $star3Percent }}%;"></span>
                                                      </div>
                                                      <div class="progress-value">
                                                          <mark>{{ $star3Percent }}%</mark>
                                                      </div>
                                                  </div>
                                                  <div class="ratings-container">
                                                      <div class="ratings-full">
                                                          <span class="ratings" style="width: 40%;"></span>
                                                          <span class="tooltiptext tooltip-top"></span>
                                                      </div>
                                                      <div class="progress-bar progress-bar-sm ">
                                                          <span style="width: {{ $star2Percent }}%;"></span>
                                                      </div>
                                                      <div class="progress-value">
                                                          <mark>{{ $star2Percent }}%</mark>
                                                      </div>
                                                  </div>
                                                  <div class="ratings-container">
                                                      <div class="ratings-full">
                                                          <span class="ratings" style="width: 20%;"></span>
                                                          <span class="tooltiptext tooltip-top"></span>
                                                      </div>
                                                      <div class="progress-bar progress-bar-sm ">
                                                          <span style="width: {{ $star1Percent }}%;"></span>
                                                      </div>
                                                      <div class="progress-value">
                                                          <mark>{{ $star1Percent }}%</mark>
                                                      </div>
                                                  </div>
                                              </div>
                                          </div>
                                      </div>
                                  </div>

                                 <div class="tab tab-nav-boxed tab-nav-outline tab-nav-center">
                                     <ul class="nav nav-tabs" role="tablist">
                                         <li class="nav-item">
                                             <a href="#show-all" class="nav-link active">Show All</a>
                                         </li>
                                         <li class="nav-item">
                                             <a href="#helpful-positive" class="nav-link">Most Helpful
                                                 Positive</a>
                                         </li>
                                         <li class="nav-item">
                                             <a href="#helpful-negative" class="nav-link">Most Helpful
                                                 Negative</a>
                                         </li>
                                         <li class="nav-item">
                                             <a href="#highest-rating" class="nav-link">Highest Rating</a>
                                         </li>
                                         <li class="nav-item">
                                             <a href="#lowest-rating" class="nav-link">Lowest Rating</a>
                                         </li>
                                     </ul>
                                     <div class="tab-content">
                                         <div class="tab-pane active" id="show-all">
                                             <ul class="comments list-style-none">
                                                  @forelse($ratings as $rating)
                                                    <li class="comment">
                                                        <div class="comment-body">

                                                            <!-- <figure class="comment-avatar">
                                                                <img src="{{ asset('assets/images/agents/1-100x100.png') }}"
                                                                    alt="Avatar" width="90" height="90">
                                                            </figure> -->

                                                            <div class="comment-content">
                                                                <h4 class="comment-author">
                                                                    <a href="#">{{ $rating->customer_name }}</a>
                                                                    <span class="comment-date">
                                                                       {{ \Carbon\Carbon::parse($rating->created_at)->timezone('Asia/Kolkata')->format('M d, Y h:i A') }}
                                                                    </span>
                                                                </h4>

                                                                {{-- Rating stars --}}
                                                                <div class="ratings-container comment-rating">
                                                                    <div class="ratings-full">
                                                                        <span class="ratings"
                                                                            style="width: {{ ($rating->star_rating / 5) * 100 }}%;"></span>
                                                                    </div>
                                                                </div>

                                                                {{-- Comment --}}
                                                                <p>{{ $rating->comments }}</p>

                                                                <div class="comment-action">
                                                                    <a href="javascript:void(0)" class="vote-btn btn btn-secondary btn-link sm"
                                                                    data-id="{{ $rating->id }}"
                                                                    data-type="helpful">
                                                                        <i class="far fa-thumbs-up"></i>
                                                                        Helpful (<span class="helpful-count">{{ $rating->helpfulVotes->count() }}</span>)
                                                                    </a>

                                                                    <a href="javascript:void(0)" class="vote-btn btn btn-dark btn-link sm"
                                                                    data-id="{{ $rating->id }}"
                                                                    data-type="unhelpful">
                                                                        <i class="far fa-thumbs-down"></i>
                                                                        Unhelpful (<span class="unhelpful-count">{{ $rating->unhelpfulVotes->count() }}</span>)
                                                                    </a>
                                                                </div>
                                                                @php
                                                                    $images = $rating->images ? explode(',', $rating->images) : [];
                                                                @endphp

                                                                @if(count($images))
                                                                <div class="review-image d-flex gap-2 mt-2">
                                                                    @foreach($images as $img)
                                                                        <a href="{{ asset('storage/'.$img) }}" target="_blank">
                                                                            <img src="{{ asset('storage/'.$img) }}"
                                                                                width="60"
                                                                                height="60"
                                                                                class="rounded border">
                                                                        </a>
                                                                    @endforeach
                                                                </div>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </li>
                                                @empty
                                                    <li>
                                                        <p class="text-muted">No reviews yet.</p>
                                                    </li>
                                                @endforelse
                                                 
                                                 
                                             </ul>
                                         </div>


                                         <div class="tab-pane" id="helpful-positive">
                                             <ul class="comments list-style-none">
                                                 @forelse($mostHelpfulPositive as $mostHelpRating)
                                                    <li class="comment">
                                                        <div class="comment-body">

                                                            <!-- <figure class="comment-avatar">
                                                                <img src="{{ asset('assets/images/agents/1-100x100.png') }}"
                                                                    alt="Avatar" width="90" height="90">
                                                            </figure> -->

                                                            <div class="comment-content">
                                                                <h4 class="comment-author">
                                                                    <a href="#">{{ $mostHelpRating->customer_name }}</a>
                                                                    <span class="comment-date">
                                                                       {{ \Carbon\Carbon::parse($mostHelpRating->created_at)->timezone('Asia/Kolkata')->format('M d, Y h:i A') }}
                                                                    </span>
                                                                </h4>

                                                                {{-- Rating stars --}}
                                                                <div class="ratings-container comment-rating">
                                                                    <div class="ratings-full">
                                                                        <span class="ratings"
                                                                            style="width: {{ ($mostHelpRating->star_rating / 5) * 100 }}%;"></span>
                                                                    </div>
                                                                </div>

                                                                {{-- Comment --}}
                                                                <p>{{ $mostHelpRating->comments }}</p>

                                                                <div class="comment-action">
                                                                    <a href="javascript:void(0)" class="vote-btn btn btn-secondary btn-link sm"
                                                                    data-id="{{ $mostHelpRating->id }}"
                                                                    data-type="helpful">
                                                                        <i class="far fa-thumbs-up"></i>
                                                                        Helpful (<span class="helpful-count">{{ $mostHelpRating->helpfulVotes->count() }}</span>)
                                                                    </a>

                                                                    <a href="javascript:void(0)" class="vote-btn btn btn-dark btn-link sm"
                                                                    data-id="{{ $mostHelpRating->id }}"
                                                                    data-type="unhelpful">
                                                                        <i class="far fa-thumbs-down"></i>
                                                                        Unhelpful (<span class="unhelpful-count">{{ $mostHelpRating->unhelpfulVotes->count() }}</span>)
                                                                    </a>
                                                                </div>
                                                                @php
                                                                    $images = $mostHelpRating->images ? explode(',', $mostHelpRating->images) : [];
                                                                @endphp

                                                                @if(count($images))
                                                                <div class="review-image d-flex gap-2 mt-2">
                                                                    @foreach($images as $img)
                                                                        <a href="{{ asset('storage/'.$img) }}" target="_blank">
                                                                            <img src="{{ asset('storage/'.$img) }}"
                                                                                width="60"
                                                                                height="60"
                                                                                class="rounded border">
                                                                        </a>
                                                                    @endforeach
                                                                </div>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </li>
                                                @empty
                                                    <li>
                                                        <p class="text-muted">No reviews yet.</p>
                                                    </li>
                                                @endforelse
                                                 
                                             </ul>
                                         </div>
                                         <div class="tab-pane" id="helpful-negative">
                                             <ul class="comments list-style-none">
                                                 @forelse($mostHelpfulNegative as $mostUnhelpRating)
                                                    <li class="comment">
                                                        <div class="comment-body">

                                                            <!-- <figure class="comment-avatar">
                                                                <img src="{{ asset('assets/images/agents/1-100x100.png') }}"
                                                                    alt="Avatar" width="90" height="90">
                                                            </figure> -->

                                                            <div class="comment-content">
                                                                <h4 class="comment-author">
                                                                    <a href="#">{{ $mostUnhelpRating->customer_name }}</a>
                                                                    <span class="comment-date">
                                                                       {{ \Carbon\Carbon::parse($mostUnhelpRating->created_at)->timezone('Asia/Kolkata')->format('M d, Y h:i A') }}
                                                                    </span>
                                                                </h4>

                                                                {{-- Rating stars --}}
                                                                <div class="ratings-container comment-rating">
                                                                    <div class="ratings-full">
                                                                        <span class="ratings"
                                                                            style="width: {{ ($mostUnhelpRating->star_rating / 5) * 100 }}%;"></span>
                                                                    </div>
                                                                </div>

                                                                {{-- Comment --}}
                                                                <p>{{ $mostUnhelpRating->comments }}</p>

                                                                <div class="comment-action">
                                                                    <a href="javascript:void(0)" class="vote-btn btn btn-secondary btn-link sm"
                                                                    data-id="{{ $mostUnhelpRating->id }}"
                                                                    data-type="helpful">
                                                                        <i class="far fa-thumbs-up"></i>
                                                                        Helpful (<span class="helpful-count">{{ $mostUnhelpRating->helpfulVotes->count() }}</span>)
                                                                    </a>

                                                                    <a href="javascript:void(0)" class="vote-btn btn btn-dark btn-link sm"
                                                                    data-id="{{ $mostUnhelpRating->id }}"
                                                                    data-type="unhelpful">
                                                                        <i class="far fa-thumbs-down"></i>
                                                                        Unhelpful (<span class="unhelpful-count">{{ $mostUnhelpRating->unhelpfulVotes->count() }}</span>)
                                                                    </a>
                                                                </div>
                                                                @php
                                                                    $images = $mostUnhelpRating->images ? explode(',', $mostUnhelpRating->images) : [];
                                                                @endphp

                                                                @if(count($images))
                                                                <div class="review-image d-flex gap-2 mt-2">
                                                                    @foreach($images as $img)
                                                                        <a href="{{ asset('storage/'.$img) }}" target="_blank">
                                                                            <img src="{{ asset('storage/'.$img) }}"
                                                                                width="60"
                                                                                height="60"
                                                                                class="rounded border">
                                                                        </a>
                                                                    @endforeach
                                                                </div>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </li>
                                                @empty
                                                    <li>
                                                        <p class="text-muted">No reviews yet.</p>
                                                    </li>
                                                @endforelse
                                             </ul>
                                         </div>
                                         <div class="tab-pane" id="highest-rating">
                                             <ul class="comments list-style-none">
                                                 @forelse($highestRatingList as $HighRating)
                                                    <li class="comment">
                                                        <div class="comment-body">

                                                            <!-- <figure class="comment-avatar">
                                                                <img src="{{ asset('assets/images/agents/1-100x100.png') }}"
                                                                    alt="Avatar" width="90" height="90">
                                                            </figure> -->

                                                            <div class="comment-content">
                                                                <h4 class="comment-author">
                                                                    <a href="#">{{ $HighRating->customer_name }}</a>
                                                                    <span class="comment-date">
                                                                       {{ \Carbon\Carbon::parse($HighRating->created_at)->timezone('Asia/Kolkata')->format('M d, Y h:i A') }}
                                                                    </span>
                                                                </h4>

                                                                {{-- Rating stars --}}
                                                                <div class="ratings-container comment-rating">
                                                                    <div class="ratings-full">
                                                                        <span class="ratings"
                                                                            style="width: {{ ($HighRating->star_rating / 5) * 100 }}%;"></span>
                                                                    </div>
                                                                </div>

                                                                {{-- Comment --}}
                                                                <p>{{ $HighRating->comments }}</p>

                                                                <div class="comment-action">
                                                                    <a href="javascript:void(0)" class="vote-btn btn btn-secondary btn-link sm"
                                                                    data-id="{{ $HighRating->id }}"
                                                                    data-type="helpful">
                                                                        <i class="far fa-thumbs-up"></i>
                                                                        Helpful (<span class="helpful-count">{{ $HighRating->helpfulVotes->count() }}</span>)
                                                                    </a>

                                                                    <a href="javascript:void(0)" class="vote-btn btn btn-dark btn-link sm"
                                                                    data-id="{{ $HighRating->id }}"
                                                                    data-type="unhelpful">
                                                                        <i class="far fa-thumbs-down"></i>
                                                                        Unhelpful (<span class="unhelpful-count">{{ $HighRating->unhelpfulVotes->count() }}</span>)
                                                                    </a>
                                                                </div>
                                                                @php
                                                                    $images = $HighRating->images ? explode(',', $HighRating->images) : [];
                                                                @endphp

                                                                @if(count($images))
                                                                <div class="review-image d-flex gap-2 mt-2">
                                                                    @foreach($images as $img)
                                                                        <a href="{{ asset('storage/'.$img) }}" target="_blank">
                                                                            <img src="{{ asset('storage/'.$img) }}"
                                                                                width="60"
                                                                                height="60"
                                                                                class="rounded border">
                                                                        </a>
                                                                    @endforeach
                                                                </div>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </li>
                                                @empty
                                                    <li>
                                                        <p class="text-muted">No reviews yet.</p>
                                                    </li>
                                                @endforelse
                                             </ul>
                                         </div>
                                         <div class="tab-pane" id="lowest-rating">
                                             <ul class="comments list-style-none">
                                                 @forelse($lowestRatingList as $LowRating)
                                                    <li class="comment">
                                                        <div class="comment-body">

                                                            <!-- <figure class="comment-avatar">
                                                                <img src="{{ asset('assets/images/agents/1-100x100.png') }}"
                                                                    alt="Avatar" width="90" height="90">
                                                            </figure> -->

                                                            <div class="comment-content">
                                                                <h4 class="comment-author">
                                                                    <a href="#">{{ $LowRating->customer_name }}</a>
                                                                    <span class="comment-date">
                                                                       {{ \Carbon\Carbon::parse($LowRating->created_at)->timezone('Asia/Kolkata')->format('M d, Y h:i A') }}
                                                                    </span>
                                                                </h4>

                                                                {{-- Rating stars --}}
                                                                <div class="ratings-container comment-rating">
                                                                    <div class="ratings-full">
                                                                        <span class="ratings"
                                                                            style="width: {{ ($LowRating->star_rating / 5) * 100 }}%;"></span>
                                                                    </div>
                                                                </div>

                                                                {{-- Comment --}}
                                                                <p>{{ $LowRating->comments }}</p>

                                                                <div class="comment-action">
                                                                    <a href="javascript:void(0)" class="vote-btn btn btn-secondary btn-link sm"
                                                                    data-id="{{ $LowRating->id }}"
                                                                    data-type="helpful">
                                                                        <i class="far fa-thumbs-up"></i>
                                                                        Helpful (<span class="helpful-count">{{ $LowRating->helpfulVotes->count() }}</span>)
                                                                    </a>

                                                                    <a href="javascript:void(0)" class="vote-btn btn btn-dark btn-link sm"
                                                                    data-id="{{ $LowRating->id }}"
                                                                    data-type="unhelpful">
                                                                        <i class="far fa-thumbs-down"></i>
                                                                        Unhelpful (<span class="unhelpful-count">{{ $LowRating->unhelpfulVotes->count() }}</span>)
                                                                    </a>
                                                                </div>
                                                                @php
                                                                    $images = $LowRating->images ? explode(',', $LowRating->images) : [];
                                                                @endphp

                                                                @if(count($images))
                                                                <div class="review-image d-flex gap-2 mt-2">
                                                                    @foreach($images as $img)
                                                                        <a href="{{ asset('storage/'.$img) }}" target="_blank">
                                                                            <img src="{{ asset('storage/'.$img) }}"
                                                                                width="60"
                                                                                height="60"
                                                                                class="rounded border">
                                                                        </a>
                                                                    @endforeach
                                                                </div>
                                                                @endif

                                                            </div>
                                                        </div>
                                                    </li>
                                                @empty
                                                    <li>
                                                        <p class="text-muted">No reviews yet.</p>
                                                    </li>
                                                @endforelse
                                             </ul>
                                         </div>




                                     </div>
                                 </div>
                             </div>
                         </div>
                     </div>



                 

</div>                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<script>
    // ===================== IMAGE GALLERY =====================
    function changeImage(thumb, src) {
        var mainImg = document.getElementById('main-product-image');
        mainImg.style.opacity = '0.5';
        setTimeout(function() {
            mainImg.src = src;
            mainImg.style.opacity = '1';
        }, 150);
        
        var thumbs = document.getElementsByClassName('tm-thumb');
        for (var i = 0; i < thumbs.length; i++) {
            thumbs[i].classList.remove('active');
        }
        thumb.classList.add('active');
    }

    // ===================== COUNTDOWN TIMER =====================
    var auctionHasNotStarted = {{ $hasNotStarted ? 'true' : 'false' }};
    var auctionEndDate = new Date("{{ $endDate->format('Y-m-d\TH:i:s') }}").getTime();
    var auctionStartDate = new Date("{{ $startDate->format('Y-m-d\TH:i:s') }}").getTime();
    var auctionExpired = {{ $isExpired ? 'true' : 'false' }};

    function updateCountdown() {
        if (auctionExpired) return;

        var now = new Date().getTime();
        var diff = 0;

        if (auctionHasNotStarted) {
            diff = auctionStartDate - now;
            if (diff <= 0) {
                auctionHasNotStarted = false;
                setTimeout(function() { location.reload(); }, 1000);
                return;
            }
        } else {
            diff = auctionEndDate - now;
            if (diff <= 0) {
                document.getElementById('countdown-display').innerHTML = '<div class="timer-block" style="background: #dc2626;"><span style="font-size: 16px; margin-bottom: 0;">Auction Closed</span></div>';
                auctionExpired = true;
                setTimeout(function() { location.reload(); }, 2000);
                return;
            }
        }

        var days = Math.floor(diff / (1000 * 60 * 60 * 24));
        var hours = Math.floor((diff % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
        var minutes = Math.floor((diff % (1000 * 60 * 60)) / (1000 * 60));
        var seconds = Math.floor((diff % (1000 * 60)) / 1000);
        
        document.getElementById('timer-days').textContent = days.toString().padStart(2, '0');
        document.getElementById('timer-hours').textContent = hours.toString().padStart(2, '0');
        document.getElementById('timer-mins').textContent = minutes.toString().padStart(2, '0');
        document.getElementById('timer-secs').textContent = seconds.toString().padStart(2, '0');
    }

    if (!auctionExpired) {
        updateCountdown();
        setInterval(updateCountdown, 1000); // Update every second
    }

    // ===================== PLACE BID =====================
    function placeBid() {
        var bidAmount = parseFloat(document.getElementById('bid-amount-input').value);
        var btn = document.getElementById('place-bid-btn');
        var successMsg = document.getElementById('bid-success-msg');
        var errorMsg = document.getElementById('bid-error-msg');

        if (isNaN(bidAmount) || bidAmount <= 0) {
            errorMsg.style.display = 'flex';
            errorMsg.querySelector('span').textContent = 'Please enter a valid bid amount.';
            successMsg.style.display = 'none';
            return;
        }

        btn.disabled = true;
        btn.textContent = 'Placing Bid...';

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
                successMsg.querySelector('span').textContent = data.message;
                errorMsg.style.display = 'none';

                document.getElementById('current-bid-display').innerHTML = '<span style="font-family: Arial, sans-serif;">₹</span>' + parseFloat(bidAmount).toLocaleString('en-IN', {minimumFractionDigits: 2});
                
                 var bidderEl = document.getElementById('highest-bidder-display');
                 if (bidderEl && data.bid) {
                     bidderEl.innerHTML = '<span style="background: #fef3c7; color: #92400e; border: 1px solid #fde68a; padding: 6px 16px; border-radius: 20px; font-weight: 700; font-size: 14px; display: inline-flex; align-items: center; gap: 6px; text-transform: capitalize; box-shadow: 0 2px 10px rgba(217, 119, 6, 0.08);">Highest Bidder: ' + data.bid.customer_name + ' <i class="fas fa-crown" style="color: #d97706;"></i></span>';
                     bidderEl.style.display = 'flex';
                 }
                
                var totalBidsText = data.total_bids + ' bid' + (data.total_bids > 1 ? 's' : '') + ' so far – view history';
                if(document.getElementById('total-bids-text')) {
                    document.getElementById('total-bids-text').textContent = totalBidsText;
                } else {
                    location.reload();
                }

                document.getElementById('min-bid-display').textContent = parseFloat(data.new_minimum_bid).toLocaleString('en-IN', {minimumFractionDigits: 2});
                document.getElementById('bid-amount-input').min = data.new_minimum_bid;
                document.getElementById('bid-amount-input').value = data.new_minimum_bid;

                setTimeout(function() { successMsg.style.display = 'none'; }, 3000);
            } else {
                errorMsg.style.display = 'flex';
                errorMsg.querySelector('span').textContent = data.message;
                successMsg.style.display = 'none';
            }
        })
        .catch(function(err) {
            btn.disabled = false;
            btn.textContent = 'Place Bid';
            errorMsg.style.display = 'flex';
            errorMsg.querySelector('span').textContent = 'Something went wrong. Please try again.';
            successMsg.style.display = 'none';
        });
    }

    // ===================== AUTO-REFRESH BIDS =====================
    @if(!$isExpired)
    setInterval(function() {
        fetch("{{ route('auction.bids', $auction->id) }}")
        .then(function(res) { return res.json(); })
        .then(function(data) {
            document.getElementById('current-bid-display').innerHTML = '<span style="font-family: Arial, sans-serif;">₹</span>' + parseFloat(data.current_bid).toLocaleString('en-IN', {minimumFractionDigits: 2});
            
            var bidderEl = document.getElementById('highest-bidder-display');
            if (bidderEl && data.bids && data.bids.length > 0) {
                bidderEl.innerHTML = '<span style="background: #fef3c7; color: #92400e; border: 1px solid #fde68a; padding: 6px 16px; border-radius: 20px; font-weight: 700; font-size: 14px; display: inline-flex; align-items: center; gap: 6px; text-transform: capitalize; box-shadow: 0 2px 10px rgba(217, 119, 6, 0.08);">Highest Bidder: ' + data.bids[0].customer_name + ' <i class="fas fa-crown" style="color: #d97706;"></i></span>';
                bidderEl.style.display = 'flex';
            }
            
            if(document.getElementById('total-bids-text')) {
                document.getElementById('total-bids-text').textContent = data.total_bids + ' bid' + (data.total_bids > 1 ? 's' : '') + ' so far – view history';
            }

            var minBidEl = document.getElementById('min-bid-display');
            var bidInput = document.getElementById('bid-amount-input');
            if (minBidEl) {
                minBidEl.textContent = parseFloat(data.minimum_bid).toLocaleString('en-IN', {minimumFractionDigits: 2});
            }
            if (bidInput && parseFloat(bidInput.value) < data.minimum_bid) {
                bidInput.min = data.minimum_bid;
                bidInput.value = data.minimum_bid;
            }

            if (data.is_settled) { location.reload(); }
        })
        .catch(function() {});
    }, 5000);
    @endif
 
    // ===================== BID HISTORY MODAL FUNCTIONS =====================
    function openHistoryModal() {
        var modal = document.getElementById('bid-history-modal');
        var loading = document.getElementById('bid-history-loading');
        var table = document.getElementById('bid-history-table');
        var noBids = document.getElementById('no-bids-message');
        var tbody = document.getElementById('bid-history-tbody');
        
        // Show modal & loading
        modal.style.display = 'flex';
        setTimeout(function() { modal.classList.add('show'); }, 10);
        loading.style.display = 'block';
        table.style.display = 'none';
        noBids.style.display = 'none';
        tbody.innerHTML = '';
        
        fetch("{{ route('auction.bids', $auction->id) }}")
        .then(function(res) { return res.json(); })
        .then(function(data) {
            loading.style.display = 'none';
            if (data.bids && data.bids.length > 0) {
                table.style.display = 'table';
                // Take only the past 5 bids
                var bidsToShow = data.bids.slice(0, 5);
                bidsToShow.forEach(function(bid) {
                    var tr = document.createElement('tr');
                    
                    var tdName = document.createElement('td');
                    tdName.style.padding = '12px 8px';
                    tdName.style.color = '#1e293b';
                    
                    var nameDiv = document.createElement('div');
                    nameDiv.style.fontWeight = '600';
                    nameDiv.textContent = bid.customer_name;
                    tdName.appendChild(nameDiv);
                    
                    if (bid.location) {
                        var locDiv = document.createElement('div');
                        locDiv.style.fontSize = '12px';
                        locDiv.style.color = '#64748b';
                        locDiv.style.fontWeight = '400';
                        locDiv.style.marginTop = '2px';
                        locDiv.textContent = bid.location;
                        tdName.appendChild(locDiv);
                    }
                    
                    var tdAmount = document.createElement('td');
                    tdAmount.style.padding = '12px 8px';
                    tdAmount.style.textAlign = 'right';
                    tdAmount.style.fontWeight = '700';
                    tdAmount.style.color = '#2563eb';
                    tdAmount.innerHTML = '<span style="font-family: Arial, sans-serif;">₹</span>' + parseFloat(bid.bid_amount).toLocaleString('en-IN', {minimumFractionDigits: 2});
                    
                    var tdTime = document.createElement('td');
                    tdTime.style.padding = '12px 8px';
                    tdTime.style.textAlign = 'right';
                    tdTime.style.color = '#64748b';
                    tdTime.style.fontSize = '13px';
                    tdTime.textContent = bid.time;
                    
                    tr.appendChild(tdName);
                    tr.appendChild(tdAmount);
                    tr.appendChild(tdTime);
                    tbody.appendChild(tr);
                });
            } else {
                noBids.style.display = 'block';
            }
        })
        .catch(function() {
            loading.style.display = 'none';
            noBids.style.display = 'block';
            noBids.textContent = 'Failed to load bid history.';
        });
    }

    function closeHistoryModal() {
        var modal = document.getElementById('bid-history-modal');
        modal.classList.remove('show');
        setTimeout(function() { modal.style.display = 'none'; }, 300);
    }
    
    // Close modal when clicking outside of modal content
    window.addEventListener('click', function(event) {
        var modal = document.getElementById('bid-history-modal');
        if (event.target === modal) {
            closeHistoryModal();
        }
    });
</script>

@endsection
