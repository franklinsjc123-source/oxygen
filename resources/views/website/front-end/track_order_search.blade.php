 @extends('app_template')
 @section('title','Track Order')
 @section('content')

<style>
    /* ===== Page Layout ===== */
    .track-page {
        background: #f1f3f6;
        min-height: 70vh;
        padding: 30px 0 60px;
    }
    .track-page .container {
        max-width: 100%;
        margin: 0 auto;
        padding: 0 30px;
    }

    /* ===== Page Header ===== */
    .track-page-header {
        display: flex;
        align-items: center;
        gap: 14px;
        margin-bottom: 28px;
    }
    .track-page-header .header-icon {
        width: 48px;
        height: 48px;
        background: linear-gradient(135deg, #183543, #1a6b8a);
        border-radius: 14px;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 4px 14px rgba(24,53,67,0.25);
    }
    .track-page-header .header-icon i {
        font-size: 22px;
        color: #fff;
    }
    .track-page-header h1 {
        font-size: 24px;
        font-weight: 700;
        color: #183543;
        margin: 0;
    }
    .track-page-header .order-count {
        font-size: 13px;
        color: #878787;
        font-weight: 400;
    }

    /* ===== Order Card ===== */
    .order-card {
        background: #fff;
        border-radius: 4px;
        box-shadow: 0 1px 4px rgba(0,0,0,0.08);
        margin-bottom: 20px;
        overflow: hidden;
    }

    /* ===== Order Card Header ===== */
    .order-card-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 16px 20px;
        border-bottom: 1px solid #f0f0f0;
        background: #fafafa;
        flex-wrap: wrap;
        gap: 8px;
    }
    .order-meta {
        display: flex;
        align-items: center;
        gap: 20px;
        flex-wrap: wrap;
    }
    .order-meta-item {
        display: flex;
        flex-direction: column;
    }
    .order-meta-item .meta-label {
        font-size: 11px;
        color: #878787;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-weight: 600;
    }
    .order-meta-item .meta-value {
        font-size: 14px;
        color: #212121;
        font-weight: 600;
    }
    .order-status-badge {
        padding: 5px 14px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.3px;
    }
    .badge-pending {
        background: #fff3e0;
        color: #e65100;
    }
    .badge-accept {
        background: #e3f2fd;
        color: #1565c0;
    }
    .badge-dispatch {
        background: #e8f5e9;
        color: #2e7d32;
    }

    /* ===== Product Row ===== */
    .product-row {
        display: flex;
        align-items: flex-start;
        padding: 18px 20px;
        gap: 16px;
        border-bottom: 1px solid #f5f5f5;
    }
    .product-row:last-child {
        border-bottom: none;
    }
    .product-thumb {
        width: 72px;
        height: 72px;
        border-radius: 8px;
        overflow: hidden;
        flex-shrink: 0;
        border: 1px solid #f0f0f0;
        background: #fafafa;
    }
    .product-thumb img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
    .product-info {
        flex: 1;
        min-width: 0;
    }
    .product-info .p-name {
        font-size: 14px;
        font-weight: 600;
        color: #212121;
        margin: 0 0 4px;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }
    .product-info .p-variant {
        font-size: 12px;
        color: #878787;
        margin: 0 0 6px;
    }
    .product-info .p-price {
        font-size: 15px;
        font-weight: 700;
        color: #212121;
    }
    .product-info .p-qty {
        font-size: 12px;
        color: #878787;
        font-weight: 500;
        margin-left: 8px;
    }

    /* ===== Tracking Timeline ===== */
    .tracking-section {
        padding: 24px 20px 20px;
        border-top: 1px solid #f0f0f0;
    }
    .tracking-section .section-title {
        font-size: 13px;
        font-weight: 700;
        color: #212121;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 20px;
    }

    .timeline {
        position: relative;
        padding-left: 30px;
    }
    .timeline::before {
        content: '';
        position: absolute;
        left: 10px;
        top: 6px;
        bottom: 6px;
        width: 2px;
        background: #e0e0e0;
        border-radius: 2px;
    }

    .timeline-step {
        position: relative;
        padding-bottom: 28px;
    }
    .timeline-step:last-child {
        padding-bottom: 0;
    }

    .timeline-dot {
        position: absolute;
        left: -29px;
        top: 2px;
        width: 20px;
        height: 20px;
        border-radius: 50%;
        background: #e0e0e0;
        border: 2px solid #fff;
        box-shadow: 0 0 0 2px #e0e0e0;
        z-index: 2;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .timeline-dot i {
        font-size: 9px;
        color: #fff;
        display: none;
    }

    .timeline-step.completed .timeline-dot {
        background: #26a541;
        box-shadow: 0 0 0 2px #26a541;
    }
    .timeline-step.completed .timeline-dot i {
        display: block;
    }

    .timeline-step.current .timeline-dot {
        background: #26a541;
        box-shadow: 0 0 0 2px #26a541, 0 0 0 6px rgba(38,165,65,0.15);
        animation: pulse-track 1.5s ease-in-out infinite;
    }
    .timeline-step.current .timeline-dot i {
        display: block;
    }

    @keyframes pulse-track {
        0%, 100% { box-shadow: 0 0 0 2px #26a541, 0 0 0 5px rgba(38,165,65,0.15); }
        50% { box-shadow: 0 0 0 2px #26a541, 0 0 0 10px rgba(38,165,65,0.08); }
    }

    /* Green line for completed steps */
    .timeline-step.completed + .timeline-step.completed::before,
    .timeline-step.completed + .timeline-step.current::before {
        content: '';
        position: absolute;
        left: -16px;
        top: -22px;
        bottom: calc(100% - 8px);
        width: 3px;
        background: #26a541;
        z-index: 1;
    }

    /* First completed step needs a connecting line too */
    .timeline-step.completed ~ .timeline-step.completed::before,
    .timeline-step.completed ~ .timeline-step.current::before {
        content: '';
        position: absolute;
        left: -16px;
        width: 3px;
        background: #26a541;
        z-index: 1;
    }

    .step-label {
        font-size: 14px;
        font-weight: 600;
        color: #212121;
        margin-bottom: 2px;
    }
    .timeline-step:not(.completed):not(.current) .step-label {
        color: #878787;
    }
    .step-date {
        font-size: 12px;
        color: #878787;
        font-weight: 400;
    }
    .step-sub {
        font-size: 12px;
        color: #26a541;
        font-weight: 500;
        margin-top: 2px;
    }
    .timeline-step:not(.completed):not(.current) .step-sub {
        color: #878787;
    }

    /* ===== Delivery Address ===== */
    .delivery-section {
        padding: 16px 20px;
        border-top: 1px solid #f0f0f0;
        background: #fafafa;
    }
    .delivery-section .section-title {
        font-size: 12px;
        font-weight: 700;
        color: #878787;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 8px;
    }
    .delivery-address {
        font-size: 13px;
        color: #212121;
        line-height: 1.6;
        font-weight: 400;
    }
    .delivery-address strong {
        font-weight: 600;
    }

    /* ===== View Details Link ===== */
    .order-card-footer {
        display: flex;
        align-items: center;
        justify-content: flex-end;
        padding: 12px 20px;
        border-top: 1px solid #f0f0f0;
    }
    .view-detail-link {
        font-size: 13px;
        font-weight: 600;
        color: #1a6b8a;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        transition: color 0.2s;
    }
    .view-detail-link:hover {
        color: #183543;
        text-decoration: none;
    }

    /* ===== Empty State ===== */
    .empty-state {
        background: #fff;
        border-radius: 8px;
        padding: 60px 30px;
        text-align: center;
        box-shadow: 0 1px 4px rgba(0,0,0,0.08);
    }
    .empty-state .empty-icon {
        width: 90px;
        height: 90px;
        background: linear-gradient(135deg, #e8f5e9, #c8e6c9);
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        margin: 0 auto 24px;
    }
    .empty-state .empty-icon i {
        font-size: 40px;
        color: #43a047;
    }
    .empty-state h3 {
        font-size: 22px;
        font-weight: 700;
        color: #212121;
        margin-bottom: 8px;
    }
    .empty-state p {
        font-size: 14px;
        color: #878787;
        margin-bottom: 24px;
        max-width: 340px;
        margin-left: auto;
        margin-right: auto;
    }
    .empty-state .shop-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        background: linear-gradient(135deg, #183543, #1a6b8a);
        color: #fff;
        padding: 12px 28px;
        border-radius: 8px;
        font-size: 14px;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s;
    }
    .empty-state .shop-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 18px rgba(24,53,67,0.3);
        color: #fff;
        text-decoration: none;
    }

    /* ===== Responsive ===== */
    @media (max-width: 600px) {
        .track-page {
            padding: 16px 0 40px;
        }
        .order-card-header {
            padding: 12px 14px;
        }
        .order-meta {
            gap: 12px;
        }
        .product-row {
            padding: 14px;
        }
        .product-thumb {
            width: 60px;
            height: 60px;
        }
        .tracking-section, .delivery-section {
            padding: 16px 14px;
        }
        .track-page-header h1 {
            font-size: 20px;
        }
    }
</style>

<section class="track-page">
    <div class="container">

        {{-- Page Header --}}
        <div class="track-page-header">
            <div class="header-icon">
                <i class="fas fa-shipping-fast"></i>
            </div>
            <div>
                <h1>My Orders
                    @if(isset($orders) && $orders->count() > 0)
                        <span class="order-count">({{ $orders->count() }} active)</span>
                    @endif
                </h1>
            </div>
        </div>

        @if(!isset($orders) || $orders->count() === 0)
            {{-- Empty State --}}
            <div class="empty-state">
                <div class="empty-icon">
                    <i class="fas fa-check-circle"></i>
                </div>
                <h3>All Caught Up!</h3>
                <p>You have no active orders at the moment. All your orders have been delivered.</p>
                <a href="{{ url('home') }}" class="shop-btn">
                    <i class="fas fa-shopping-bag"></i> Continue Shopping
                </a>
            </div>
        @else
            @foreach($orders as $order)
                @php
                    // Determine timeline step index
                    $statusMap = [
                        'Pending' => 0,
                        'Accept' => 1,
                        'Dispatch' => 2,
                        'Delivered' => 3,
                    ];
                    $currentStep = $statusMap[$order->order_status] ?? 0;

                    $steps = [
                        ['label' => 'Order Placed', 'icon' => 'fa-check', 'date' => $order->order_date],
                        ['label' => 'Order Accepted', 'icon' => 'fa-check', 'date' => null],
                        ['label' => 'Shipped', 'icon' => 'fa-check', 'date' => null],
                        ['label' => 'Delivered', 'icon' => 'fa-check', 'date' => $order->delivery_date],
                    ];

                    // Badge class
                    $badgeClass = 'badge-pending';
                    $badgeLabel = 'Processing';
                    if ($order->order_status === 'Accept') {
                        $badgeClass = 'badge-accept';
                        $badgeLabel = 'Accepted';
                    } elseif ($order->order_status === 'Dispatch') {
                        $badgeClass = 'badge-dispatch';
                        $badgeLabel = 'Shipped';
                    }

                    $expectedDate = $order->delivery_date
                        ? date('D, d M Y', strtotime($order->delivery_date))
                        : date('D, d M Y', strtotime($order->order_date . ' +7 days'));
                @endphp

                <div class="order-card">
                    {{-- Order Header --}}
                    <div class="order-card-header">
                        <div class="order-meta">
                            <div class="order-meta-item">
                                <span class="meta-label">Order ID</span>
                                <span class="meta-value">{{ $order->order_id }}</span>
                            </div>
                            <div class="order-meta-item">
                                <span class="meta-label">Placed On</span>
                                <span class="meta-value">{{ date('d M Y', strtotime($order->order_date)) }}</span>
                            </div>
                            <div class="order-meta-item">
                                <span class="meta-label">Total</span>
                                <span class="meta-value">₹{{ number_format($order->grand_total, 2) }}</span>
                            </div>
                            <div class="order-meta-item">
                                <span class="meta-label">Payment</span>
                                <span class="meta-value">{{ $order->payment_type ?? 'N/A' }}</span>
                            </div>
                        </div>
                        <span class="order-status-badge {{ $badgeClass }}">{{ $badgeLabel }}</span>
                    </div>

                    {{-- Products --}}
                    @if(isset($order->products) && $order->products->count() > 0)
                        @foreach($order->products as $product)
                            <div class="product-row">
                                <div class="product-thumb">
                                    @if($product->product_image)
                                        <img src="{{ asset('assets/images/products/' . $product->product_image) }}" alt="{{ $product->product_name }}">
                                    @else
                                        <img src="{{ asset('assets/images/fashion/pro/1.jpg') }}" alt="Product">
                                    @endif
                                </div>
                                <div class="product-info">
                                    <p class="p-name">{{ $product->product_name }}</p>
                                    @if($product->product_size)
                                        <p class="p-variant">Size: {{ $product->product_size }}</p>
                                    @endif
                                    <div>
                                        <span class="p-price">₹{{ number_format($product->total_price, 2) }}</span>
                                        <span class="p-qty">Qty: {{ $product->product_quantity }}</span>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                    {{-- Tracking Timeline --}}
                    <div class="tracking-section">
                        <div class="section-title">Tracking Details</div>
                        <div class="timeline">
                            @foreach($steps as $i => $step)
                                @php
                                    $stepClass = '';
                                    if ($i < $currentStep) {
                                        $stepClass = 'completed';
                                    } elseif ($i === $currentStep) {
                                        $stepClass = 'completed current';
                                    }
                                @endphp
                                <div class="timeline-step {{ $stepClass }}">
                                    <div class="timeline-dot">
                                        <i class="fas {{ $step['icon'] }}"></i>
                                    </div>
                                    <div class="step-label">{{ $step['label'] }}</div>
                                    @if($i === 0 && $order->order_date)
                                        <div class="step-date">{{ date('D, d M Y h:i A', strtotime($order->order_date)) }}</div>
                                    @endif
                                    @if($i === 3)
                                        @if($order->delivery_date && $currentStep >= 3)
                                            <div class="step-date">{{ date('D, d M Y', strtotime($order->delivery_date)) }}</div>
                                        @else
                                            <div class="step-sub">Expected by {{ $expectedDate }}</div>
                                        @endif
                                    @endif
                                </div>
                            @endforeach
                        </div>
                    </div>

                    {{-- Delivery Address --}}
                    <div class="delivery-section">
                        <div class="section-title">Delivery Address</div>
                        <div class="delivery-address">
                            <strong>{{ $order->customer_firstname }} {{ $order->customer_lastname }}</strong><br>
                            {{ $order->customer_address }}
                            @if($order->customer_address1), {{ $order->customer_address1 }}@endif<br>
                            {{ $order->customer_city }}, {{ $order->customer_state }} - {{ $order->customer_pincode }}<br>
                            <i class="fas fa-phone-alt" style="font-size:11px; color:#878787;"></i> {{ $order->customer_mobileno }}
                        </div>
                    </div>

                    {{-- Footer --}}
                    <div class="order-card-footer">
                        <a href="{{ route('order_tracking', ['orders_id' => $order->order_id]) }}" class="view-detail-link">
                            View Full Details <i class="fas fa-chevron-right" style="font-size:11px;"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        @endif

    </div>
</section>

@endsection
