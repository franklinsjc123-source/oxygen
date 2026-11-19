@extends('app_template')
@section('title', 'Track Orders')
@section('content')

<style>
    /* ===== Page Background & Container ===== */
    .track-page {
        background-color: #f8fafc;
        min-height: 75vh;
        padding: 30px 0 60px;
        font-family: inherit;
    }
    .track-page .container {
        max-width: 1120px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* ===== Page Header ===== */
    .track-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
        flex-wrap: wrap;
        gap: 16px;
    }
    .track-header-left {
        display: flex;
        align-items: center;
        gap: 14px;
    }
    .track-header-icon {
        width: 48px;
        height: 48px;
        border-radius: 12px;
        background: linear-gradient(135deg, #0088dd, #0066aa);
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 2rem;
        box-shadow: 0 4px 12px rgba(0, 136, 221, 0.25);
    }
    .track-header h1 {
        font-size: 2.2rem;
        font-weight: 800;
        color: #0f172a;
        margin: 0;
        line-height: 1.2;
    }
    .track-header p {
        font-size: 1.3rem;
        color: #64748b;
        margin: 2px 0 0;
    }

    /* ===== Search Bar ===== */
    .track-search-box {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 10px;
        padding: 6px 6px 6px 16px;
        display: flex;
        align-items: center;
        width: 380px;
        max-width: 100%;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
    }
    .track-search-box input {
        border: none;
        outline: none;
        font-size: 1.35rem;
        color: #1e293b;
        flex: 1;
        background: transparent;
    }
    .track-search-box button {
        background: #0088dd;
        color: #ffffff;
        border: none;
        border-radius: 8px;
        padding: 8px 18px;
        font-size: 1.3rem;
        font-weight: 600;
        cursor: pointer;
        transition: background 0.2s;
    }
    .track-search-box button:hover {
        background: #0077c2;
    }

    /* ===== Order Card ===== */
    .track-order-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        margin-bottom: 24px;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
        overflow: hidden;
        transition: box-shadow 0.2s ease;
    }
    .track-order-card:hover {
        box-shadow: 0 4px 14px rgba(0, 0, 0, 0.07);
    }

    /* Card Header */
    .track-card-header {
        padding: 14px 22px;
        background: #f8fafc;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }
    .track-meta-group {
        display: flex;
        align-items: center;
        gap: 24px;
        flex-wrap: wrap;
    }
    .track-meta-item {
        display: flex;
        flex-direction: column;
    }
    .track-meta-item .meta-label {
        font-size: 1.1rem;
        font-weight: 700;
        text-transform: uppercase;
        color: #94a3b8;
        letter-spacing: 0.5px;
    }
    .track-meta-item .meta-val {
        font-size: 1.4rem;
        font-weight: 700;
        color: #1e293b;
    }
    .track-status-pill {
        padding: 5px 14px;
        border-radius: 20px;
        font-size: 1.25rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.4px;
    }
    .badge-status-pending { background: #fef3c7; color: #b45309; }
    .badge-status-accept { background: #e0f2fe; color: #0369a1; }
    .badge-status-dispatch { background: #dcfce7; color: #15803d; }
    .badge-status-delivered { background: #dcfce7; color: #166534; }
    .badge-status-cancel { background: #fee2e2; color: #b91c1c; }

    /* Card Body */
    .track-card-body {
        padding: 22px;
    }

    /* Product Section */
    .track-product-list {
        display: flex;
        flex-direction: column;
        gap: 16px;
    }
    .track-product-item {
        display: flex;
        align-items: center;
        gap: 16px;
    }
    .track-product-thumb {
        width: 75px;
        height: 75px;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
        flex-shrink: 0;
        background: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .track-product-thumb img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
    .track-product-details {
        flex: 1;
        min-width: 0;
    }
    .track-product-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #0f172a;
        margin: 0 0 6px;
        line-height: 1.3;
    }
    .track-product-title a {
        color: inherit;
        text-decoration: none;
    }
    .track-product-title a:hover {
        color: #0088dd;
    }
    .track-variant-tags {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
        margin-bottom: 6px;
    }
    .variant-tag {
        font-size: 1.2rem;
        background: #f1f5f9;
        color: #475569;
        padding: 2px 8px;
        border-radius: 4px;
        font-weight: 600;
    }
    .track-price-line {
        font-size: 1.4rem;
        color: #334155;
    }
    .track-price-line strong {
        font-size: 1.5rem;
        color: #0f172a;
    }

    /* Timeline Section in Card */
    .track-timeline-wrap {
        border-left: 1px solid #f1f5f9;
        padding-left: 24px;
    }
    .timeline-heading {
        font-size: 1.2rem;
        font-weight: 700;
        text-transform: uppercase;
        color: #64748b;
        letter-spacing: 0.5px;
        margin-bottom: 16px;
        display: flex;
        align-items: center;
        gap: 6px;
    }

    .stepper-mini {
        position: relative;
        padding-left: 24px;
    }
    .stepper-mini::before {
        content: '';
        position: absolute;
        left: 8px;
        top: 6px;
        bottom: 6px;
        width: 2px;
        background: #e2e8f0;
    }
    .stepper-mini-step {
        position: relative;
        padding-bottom: 20px;
    }
    .stepper-mini-step:last-child {
        padding-bottom: 0;
    }
    .stepper-mini-dot {
        position: absolute;
        left: -24px;
        top: 2px;
        width: 18px;
        height: 18px;
        border-radius: 50%;
        background: #cbd5e1;
        border: 2px solid #ffffff;
        box-shadow: 0 0 0 2px #cbd5e1;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 9px;
        color: #ffffff;
        z-index: 2;
    }
    .stepper-mini-step.completed .stepper-mini-dot {
        background: #16a34a;
        box-shadow: 0 0 0 2px #16a34a;
    }
    .stepper-mini-step.active .stepper-mini-dot {
        background: #16a34a;
        box-shadow: 0 0 0 2px #16a34a, 0 0 0 5px rgba(22, 163, 74, 0.2);
    }
    .stepper-mini-title {
        font-size: 1.35rem;
        font-weight: 600;
        color: #94a3b8;
        line-height: 1.3;
    }
    .stepper-mini-step.completed .stepper-mini-title,
    .stepper-mini-step.active .stepper-mini-title {
        color: #0f172a;
        font-weight: 700;
    }
    .stepper-mini-date {
        font-size: 1.15rem;
        color: #94a3b8;
        margin-top: 2px;
    }
    .stepper-mini-step.completed .stepper-mini-date {
        color: #16a34a;
    }

    /* Card Footer */
    .track-card-footer {
        padding: 14px 22px;
        background: #f8fafc;
        border-top: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
        flex-wrap: wrap;
        gap: 12px;
    }
    .track-footer-address {
        font-size: 1.3rem;
        color: #475569;
        display: flex;
        align-items: center;
        gap: 8px;
        max-width: 550px;
    }
    .track-footer-address i {
        color: #0088dd;
        font-size: 1.4rem;
    }
    .track-footer-actions {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    /* Buttons */
    .btn-track-details {
        background-color: #0088dd !important;
        color: #ffffff !important;
        border-radius: 8px !important;
        padding: 8px 18px !important;
        font-size: 1.3rem !important;
        font-weight: 700 !important;
        text-decoration: none !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
        transition: background-color 0.2s ease;
    }
    .btn-track-details:hover {
        background-color: #0077c2 !important;
        color: #ffffff !important;
    }
    .btn-track-invoice {
        background-color: #ffffff !important;
        color: #334155 !important;
        border: 1px solid #cbd5e1 !important;
        border-radius: 8px !important;
        padding: 8px 16px !important;
        font-size: 1.3rem !important;
        font-weight: 600 !important;
        text-decoration: none !important;
        display: inline-flex !important;
        align-items: center !important;
        gap: 6px !important;
        transition: all 0.2s ease;
    }
    .btn-track-invoice:hover {
        background-color: #f1f5f9 !important;
        color: #0f172a !important;
        border-color: #94a3b8 !important;
    }

    /* Empty State */
    .track-empty-card {
        background: #ffffff;
        border-radius: 12px;
        border: 1px solid #e2e8f0;
        padding: 60px 20px;
        text-align: center;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
    }
    .track-empty-icon {
        width: 72px;
        height: 72px;
        border-radius: 50%;
        background: #f1f5f9;
        color: #0088dd;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 3rem;
        margin: 0 auto 18px;
    }
    .track-empty-card h3 {
        font-size: 2rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 8px;
    }
    .track-empty-card p {
        font-size: 1.4rem;
        color: #64748b;
        margin-bottom: 24px;
    }

    /* Responsive */
    @media (max-width: 991px) {
        .track-timeline-wrap {
            border-left: none;
            border-top: 1px solid #f1f5f9;
            padding-left: 0;
            padding-top: 20px;
            margin-top: 20px;
        }
        .track-search-box {
            width: 100%;
        }
    }
</style>

<div class="track-page">
    <div class="container">

        {{-- Page Header --}}
        <div class="track-header">
            <div class="track-header-left">
                <div class="track-header-icon">
                    <i class="fas fa-shipping-fast"></i>
                </div>
                <div>
                    <h1>Track Orders</h1>
                    <p>
                        @if(isset($orders) && $orders->count() > 0)
                            Showing {{ $orders->count() }} active order(s)
                        @else
                            No active orders
                        @endif
                    </p>
                </div>
            </div>

            {{-- Search Bar --}}
            <form action="{{ route('track_order_search') }}" method="POST" class="track-search-box">
                @csrf
                <input type="text" name="orders_id" placeholder="Enter Order ID..." required>
                <button type="submit"><i class="fas fa-search mr-1"></i> Track</button>
            </form>
        </div>

        {{-- Error / Session Alert --}}
        @if(session('error'))
            <div class="alert alert-danger mb-4" style="font-size: 1.4rem; border-radius: 8px;">
                <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
            </div>
        @endif

        {{-- Order List --}}
        @if(!isset($orders) || $orders->count() === 0)
            <div class="track-empty-card">
                <div class="track-empty-icon">
                    <i class="fas fa-box-open"></i>
                </div>
                <h3>No Active Orders</h3>
                <p>You don't have any orders in transit right now.</p>
                <a href="{{ url('home') }}" class="btn btn-primary btn-rounded" style="padding: 10px 24px; font-size: 1.4rem; font-weight: 700;">
                    <i class="fas fa-shopping-bag mr-2"></i> Start Shopping
                </a>
            </div>
        @else
            @foreach($orders as $order)
                @php
                    $rawStatus = (string) ($order->order_status ?? 'Pending');
                    $normalizedStatus = strtolower(trim($rawStatus));

                    $stepIndex = 0;
                    if (in_array($normalizedStatus, ['pending', 'placed'], true)) {
                        $stepIndex = 0;
                        $badgeClass = 'badge-status-pending';
                        $badgeLabel = 'Order Placed';
                    } elseif (in_array($normalizedStatus, ['accept', 'accepted', 'processing'], true)) {
                        $stepIndex = 1;
                        $badgeClass = 'badge-status-accept';
                        $badgeLabel = 'Accepted';
                    } elseif (in_array($normalizedStatus, ['dispatch', 'dispatched', 'shipped'], true)) {
                        $stepIndex = 2;
                        $badgeClass = 'badge-status-dispatch';
                        $badgeLabel = 'Shipped';
                    } elseif (in_array($normalizedStatus, ['delivery', 'delivered'], true)) {
                        $stepIndex = 3;
                        $badgeClass = 'badge-status-delivered';
                        $badgeLabel = 'Delivered';
                    } else {
                        $stepIndex = 0;
                        $badgeClass = 'badge-status-pending';
                        $badgeLabel = ucfirst($rawStatus);
                    }

                    $orderDateFormatted = date('d M Y', strtotime($order->order_date ?? now()));
                    $expectedDate = $order->delivery_date
                        ? date('D, d M Y', strtotime($order->delivery_date))
                        : date('D, d M Y', strtotime(($order->order_date ?? now()) . ' +7 days'));
                @endphp

                <div class="track-order-card">
                    {{-- Card Header --}}
                    <div class="track-card-header">
                        <div class="track-meta-group">
                            <div class="track-meta-item">
                                <span class="meta-label">Order ID</span>
                                <span class="meta-val">#{{ $order->order_id }}</span>
                            </div>
                            <div class="track-meta-item">
                                <span class="meta-label">Placed On</span>
                                <span class="meta-val">{{ $orderDateFormatted }}</span>
                            </div>
                            <div class="track-meta-item">
                                <span class="meta-label">Total Amount</span>
                                <span class="meta-val">₹ {{ number_format($order->grand_total, 2) }}</span>
                            </div>
                            <div class="track-meta-item">
                                <span class="meta-label">Payment</span>
                                <span class="meta-val">{{ $order->payment_type ?? 'Cash On Delivery' }}</span>
                            </div>
                        </div>
                        <span class="track-status-pill {{ $badgeClass }}">{{ $badgeLabel }}</span>
                    </div>

                    {{-- Card Body: Products (Left) + Timeline (Right) --}}
                    <div class="track-card-body">
                        <div class="row align-items-center">

                            {{-- Left: Products in order --}}
                            <div class="col-lg-6">
                                <div class="track-product-list">
                                    @if(isset($order->products) && $order->products->count() > 0)
                                        @foreach($order->products as $product)
                                            @php
                                                $imgName = $product->product_image ?: ($product->main_image ?? '');
                                                $resolvedThumb = asset('assets/images/products/no-product-found.png');

                                                if (!empty($imgName)) {
                                                    if (file_exists(public_path('assets/images/products/' . $imgName))) {
                                                        $resolvedThumb = asset('assets/images/products/' . $imgName);
                                                    } elseif (file_exists(public_path('assets/images/products/detail/' . $imgName))) {
                                                        $resolvedThumb = asset('assets/images/products/detail/' . $imgName);
                                                    } elseif (file_exists(public_path('assets/images/products/popup/' . $imgName))) {
                                                        $resolvedThumb = asset('assets/images/products/popup/' . $imgName);
                                                    } else {
                                                        $resolvedThumb = asset('assets/images/products/' . $imgName);
                                                    }
                                                }
                                            @endphp
                                            <div class="track-product-item">
                                                <div class="track-product-thumb">
                                                    <img src="{{ $resolvedThumb }}" alt="{{ $product->product_name }}"
                                                         onerror="if (this.src.indexOf('/detail/') !== -1) { this.src = '{{ asset('assets/images/products/' . $imgName) }}'; } else { this.src = '{{ asset('assets/images/products/no-product-found.png') }}'; }">
                                                </div>
                                                <div class="track-product-details">
                                                    <h5 class="track-product-title">
                                                        @if(!empty($product->slug))
                                                            <a href="{{ url('products/' . $product->slug) }}">{{ $product->product_name }}</a>
                                                        @else
                                                            {{ $product->product_name }}
                                                        @endif
                                                    </h5>

                                                    <div class="track-variant-tags">
                                                        @if(!empty($product->product_size))
                                                            <span class="variant-tag">Size: {{ $product->product_size }}</span>
                                                        @endif
                                                        @if(!empty($product->product_color))
                                                            <span class="variant-tag">Color: {{ $product->product_color }}</span>
                                                        @endif
                                                        <span class="variant-tag" style="background: #e0f2fe; color: #0369a1;">Qty: {{ $product->product_quantity ?? 1 }}</span>
                                                    </div>

                                                    <div class="track-price-line">
                                                        <strong>₹ {{ number_format($product->total_price ?? ($product->product_price * ($product->product_quantity ?? 1)), 2) }}</strong>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>

                            {{-- Right: Stepper Timeline --}}
                            <div class="col-lg-6">
                                <div class="track-timeline-wrap">
                                    <div class="timeline-heading">
                                        <i class="fas fa-truck text-primary"></i> Delivery Status
                                    </div>
                                    <div class="stepper-mini">
                                        {{-- Step 1: Placed --}}
                                        <div class="stepper-mini-step {{ $stepIndex >= 0 ? ($stepIndex == 0 ? 'active' : 'completed') : '' }}">
                                            <div class="stepper-mini-dot">
                                                <i class="fas fa-check"></i>
                                            </div>
                                            <div class="stepper-mini-title">Order Placed</div>
                                            <div class="stepper-mini-date">{{ date('d M Y, h:i A', strtotime($order->order_date ?? now())) }}</div>
                                        </div>

                                        {{-- Step 2: Confirmed --}}
                                        <div class="stepper-mini-step {{ $stepIndex >= 1 ? ($stepIndex == 1 ? 'active' : 'completed') : '' }}">
                                            <div class="stepper-mini-dot">
                                                <i class="fas fa-check"></i>
                                            </div>
                                            <div class="stepper-mini-title">Order Confirmed</div>
                                            <div class="stepper-mini-date">{{ $stepIndex >= 1 ? 'Processing' : 'Pending' }}</div>
                                        </div>

                                        {{-- Step 3: Shipped --}}
                                        <div class="stepper-mini-step {{ $stepIndex >= 2 ? ($stepIndex == 2 ? 'active' : 'completed') : '' }}">
                                            <div class="stepper-mini-dot">
                                                <i class="fas fa-check"></i>
                                            </div>
                                            <div class="stepper-mini-title">Shipped</div>
                                            <div class="stepper-mini-date">{{ $stepIndex >= 2 ? 'In Transit' : 'Upcoming' }}</div>
                                        </div>

                                        {{-- Step 4: Delivered --}}
                                        <div class="stepper-mini-step {{ $stepIndex >= 3 ? 'completed active' : '' }}">
                                            <div class="stepper-mini-dot">
                                                <i class="fas fa-check"></i>
                                            </div>
                                            <div class="stepper-mini-title">Delivered</div>
                                            <div class="stepper-mini-date">Expected by {{ $expectedDate }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    {{-- Card Footer --}}
                    <div class="track-card-footer">
                        <div class="track-footer-address">
                            <i class="fas fa-map-marker-alt"></i>
                            <span>
                                <strong>Delivery to:</strong>
                                {{ $order->customer_firstname }} {{ $order->customer_lastname }},
                                {{ $order->customer_address }},
                                {{ $order->customer_city ? $order->customer_city . ', ' : '' }}{{ $order->customer_state }} - {{ $order->customer_pincode }}
                            </span>
                        </div>
                        <div class="track-footer-actions">
                            <a href="{{ route('order_tracking', ['orders_id' => $order->order_id]) }}" class="btn-track-details">
                                View Full Details <i class="fas fa-arrow-right ml-1"></i>
                            </a>
                            <a href="{{ url('invoice-pdf/' . $order->id) }}" class="btn-track-invoice" target="_blank">
                                <i class="fas fa-file-invoice"></i> Invoice
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
        @endif

    </div>
</div>

@endsection
