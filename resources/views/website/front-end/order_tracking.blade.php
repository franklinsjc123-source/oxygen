@extends('app_template')
@section('title', 'Order Details - ' . $orders_id)
@section('content')

<style>
    /* Prevent Poppins font swap glitch on Rupee symbol */
    @font-face {
        font-family: 'Poppins';
        src: local('Arial'), local('Segoe UI'), local('Roboto'), local('sans-serif');
        unicode-range: U+20B9;
    }
    .rupee-symbol {
        font-family: Arial, sans-serif !important;
    }

    .order-detail-page {
        background-color: #f8fafc;
        padding: 30px 0 60px;
        min-height: 80vh;
        font-family: inherit;
    }
    .order-detail-page .container {
        max-width: 1200px;
        margin: 0 auto;
        padding: 0 20px;
    }

    /* Top Breadcrumb & Actions */
    .detail-top-nav {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 24px;
        flex-wrap: wrap;
        gap: 12px;
    }
    .detail-back-link {
        font-size: 1.4rem;
        font-weight: 600;
        color: #0088dd;
        text-decoration: none;
        display: inline-flex;
        align-items: center;
        gap: 8px;
        transition: color 0.2s;
    }
    .detail-back-link:hover {
        color: #0066aa;
        text-decoration: underline;
    }
    .order-header-badge-group {
        display: flex;
        align-items: center;
        gap: 10px;
        flex-wrap: wrap;
    }
    .order-id-pill {
        background: #e2e8f0;
        color: #334155;
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 1.3rem;
        font-weight: 700;
        letter-spacing: 0.3px;
    }
    .order-status-pill {
        padding: 6px 14px;
        border-radius: 20px;
        font-size: 1.3rem;
        font-weight: 700;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    .status-pill-pending { background: #fef3c7; color: #b45309; }
    .status-pill-accept { background: #e0f2fe; color: #0369a1; }
    .status-pill-dispatch { background: #dcfce7; color: #15803d; }
    .status-pill-delivered { background: #dcfce7; color: #166534; }
    .status-pill-cancel { background: #fee2e2; color: #b91c1c; }
    .status-pill-return { background: #f3e8ff; color: #7e22ce; }

    /* Cards */
    .detail-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.04);
        margin-bottom: 24px;
        overflow: hidden;
    }
    .detail-card-header {
        padding: 16px 22px;
        background: #ffffff;
        border-bottom: 1px solid #f1f5f9;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }
    .detail-card-header h4 {
        margin: 0;
        font-size: 1.6rem;
        font-weight: 700;
        color: #0f172a;
        display: flex;
        align-items: center;
        gap: 10px;
    }
    .detail-card-body {
        padding: 22px;
    }

    /* Stepper / Timeline */
    .tracking-stepper {
        display: flex;
        align-items: flex-start;
        justify-content: space-between;
        position: relative;
        padding: 10px 0;
    }
    .stepper-progress-bar {
        position: absolute;
        top: 26px;
        left: 5%;
        right: 5%;
        height: 4px;
        background: #e2e8f0;
        z-index: 1;
    }
    .stepper-progress-fill {
        height: 100%;
        background: #16a34a;
        transition: width 0.4s ease;
    }
    .stepper-step {
        position: relative;
        z-index: 2;
        text-align: center;
        flex: 1;
        display: flex;
        flex-direction: column;
        align-items: center;
    }
    .stepper-icon {
        width: 36px;
        height: 36px;
        border-radius: 50%;
        background: #ffffff;
        border: 3px solid #cbd5e1;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.3rem;
        color: #94a3b8;
        font-weight: 700;
        transition: all 0.3s;
        margin-bottom: 10px;
    }
    .stepper-step.completed .stepper-icon {
        background: #16a34a;
        border-color: #16a34a;
        color: #ffffff;
    }
    .stepper-step.active .stepper-icon {
        background: #ffffff;
        border-color: #16a34a;
        color: #16a34a;
        box-shadow: 0 0 0 4px rgba(22, 163, 74, 0.2);
    }
    .stepper-title {
        font-size: 1.35rem;
        font-weight: 600;
        color: #64748b;
        margin-bottom: 2px;
    }
    .stepper-step.completed .stepper-title,
    .stepper-step.active .stepper-title {
        color: #0f172a;
        font-weight: 700;
    }
    .stepper-date {
        font-size: 1.15rem;
        color: #94a3b8;
    }
    .stepper-step.completed .stepper-date,
    .stepper-step.active .stepper-date {
        color: #16a34a;
        font-weight: 500;
    }

    /* Product Item */
    .ordered-product-card {
        display: flex;
        align-items: center;
        gap: 18px;
        padding: 16px 0;
        border-bottom: 1px solid #f1f5f9;
    }
    .ordered-product-card:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }
    .ordered-product-card:first-child {
        padding-top: 0;
    }
    .product-thumb-box {
        width: 80px;
        height: 80px;
        border-radius: 10px;
        border: 1px solid #e2e8f0;
        overflow: hidden;
        flex-shrink: 0;
        background: #fafafa;
        display: flex;
        align-items: center;
        justify-content: center;
    }
    .product-thumb-box img {
        width: 100%;
        height: 100%;
        object-fit: contain;
    }
    .product-details-content {
        flex: 1;
        min-width: 0;
    }
    .product-details-title {
        font-size: 1.5rem;
        font-weight: 700;
        color: #0f172a;
        margin: 0 0 6px 0;
        line-height: 1.3;
    }
    .product-details-title a {
        color: inherit;
        text-decoration: none;
    }
    .product-details-title a:hover {
        color: #0088dd;
    }
    .product-variant-badges {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
        margin-bottom: 6px;
    }
    .variant-badge {
        font-size: 1.2rem;
        background: #f1f5f9;
        color: #475569;
        padding: 3px 10px;
        border-radius: 6px;
        font-weight: 600;
    }
    .product-pricing-line {
        font-size: 1.4rem;
        color: #334155;
    }
    .product-pricing-line .price-highlight {
        font-weight: 700;
        color: #0f172a;
        font-size: 1.5rem;
    }

    /* Info Lists */
    .info-list-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 10px 0;
        border-bottom: 1px dashed #f1f5f9;
        font-size: 1.4rem;
    }
    .info-list-row:last-child {
        border-bottom: none;
    }
    .info-label {
        color: #64748b;
        font-weight: 500;
    }
    .info-value {
        color: #0f172a;
        font-weight: 600;
        text-align: right;
    }
    .info-total-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 14px 0 0;
        border-top: 2px solid #e2e8f0;
        margin-top: 10px;
    }
    .info-total-row .info-label {
        font-size: 1.6rem;
        font-weight: 700;
        color: #0f172a;
    }
    .info-total-row .info-value {
        font-size: 1.8rem;
        font-weight: 800;
        color: #0088dd;
    }

    /* Address Box */
    .address-box {
        font-size: 1.4rem;
        line-height: 1.6;
        color: #334155;
    }
    .address-customer-name {
        font-size: 1.5rem;
        font-weight: 700;
        color: #0f172a;
        margin-bottom: 4px;
    }
    .address-line {
        margin-bottom: 4px;
        color: #475569;
    }
    .address-contact-item {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-top: 6px;
        color: #475569;
        font-size: 1.35rem;
    }
    .address-contact-item i {
        color: #0088dd;
        width: 16px;
    }

    /* Buttons */
    .btn-download-inv {
        background-color: #0f172a !important;
        color: #ffffff !important;
        border: none !important;
        border-radius: 8px !important;
        padding: 12px 20px !important;
        font-size: 1.4rem !important;
        font-weight: 700 !important;
        text-decoration: none !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 8px !important;
        width: 100% !important;
        transition: background-color 0.2s ease;
    }
    .btn-download-inv:hover {
        background-color: #0088dd !important;
        color: #ffffff !important;
    }

    .btn-secondary-action {
        background-color: #ffffff !important;
        color: #475569 !important;
        border: 1px solid #cbd5e1 !important;
        border-radius: 8px !important;
        padding: 10px 20px !important;
        font-size: 1.4rem !important;
        font-weight: 600 !important;
        text-decoration: none !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        gap: 8px !important;
        width: 100% !important;
        transition: all 0.2s ease;
    }
    .btn-secondary-action:hover {
        background-color: #f8fafc !important;
        color: #0f172a !important;
        border-color: #94a3b8 !important;
    }

    /* Mobile adjustments */
    @media (max-width: 768px) {
        .tracking-stepper {
            flex-direction: column;
            gap: 20px;
            padding-left: 20px;
        }
        .stepper-progress-bar {
            top: 20px;
            bottom: 20px;
            left: 36px;
            right: auto;
            width: 3px;
            height: auto;
        }
        .stepper-step {
            flex-direction: row;
            text-align: left;
            gap: 16px;
            width: 100%;
        }
        .stepper-icon {
            margin-bottom: 0;
            flex-shrink: 0;
        }
    }
</style>

@php
    $rawStatus = (string) ($order_info->order_status ?? 'Pending');
    $normalizedStatus = strtolower(trim($rawStatus));

    // Status mapping: 0 = Placed, 1 = Confirmed, 2 = Shipped, 3 = Delivered
    $stepIndex = 0;
    if (in_array($normalizedStatus, ['pending', 'placed'], true)) {
        $stepIndex = 0;
        $statusPillClass = 'status-pill-pending';
        $statusPillText = 'Order Placed';
    } elseif (in_array($normalizedStatus, ['accept', 'accepted', 'processing'], true)) {
        $stepIndex = 1;
        $statusPillClass = 'status-pill-accept';
        $statusPillText = 'Accepted';
    } elseif (in_array($normalizedStatus, ['dispatch', 'dispatched', 'shipped'], true)) {
        $stepIndex = 2;
        $statusPillClass = 'status-pill-dispatch';
        $statusPillText = 'Shipped';
    } elseif (in_array($normalizedStatus, ['delivery', 'delivered'], true)) {
        $stepIndex = 3;
        $statusPillClass = 'status-pill-delivered';
        $statusPillText = 'Delivered';
    } elseif ($normalizedStatus === 'cancel' || $normalizedStatus === 'canceled') {
        $stepIndex = -1;
        $statusPillClass = 'status-pill-cancel';
        $statusPillText = 'Canceled';
    } elseif ($normalizedStatus === 'return' || $normalizedStatus === 'returned') {
        $stepIndex = -1;
        $statusPillClass = 'status-pill-return';
        $statusPillText = 'Returned';
    } else {
        $stepIndex = 0;
        $statusPillClass = 'status-pill-pending';
        $statusPillText = ucfirst($rawStatus);
    }

    $progressPercent = ($stepIndex >= 0) ? min(100, ($stepIndex / 3) * 100) : 0;

    $orderDateFormatted = date('d M Y, h:i A', strtotime($order_info->order_date ?? $order_info->created_at));
    $expectedDelivery = $order_info->delivery_date
        ? date('D, d M Y', strtotime($order_info->delivery_date))
        : date('D, d M Y', strtotime(($order_info->order_date ?? now()) . ' +7 days'));
@endphp

<div class="order-detail-page">
    <div class="container">

        {{-- Top Navigation & Header --}}
        <div class="detail-top-nav">
            <a href="{{ url('track-order') }}" class="detail-back-link">
                <i class="fas fa-arrow-left"></i> Back to Track Orders
            </a>
            <div class="order-header-badge-group">
                <span class="order-id-pill">Order #{{ $order_info->order_id }}</span>
                <span class="order-status-pill {{ $statusPillClass }}">{{ $statusPillText }}</span>
            </div>
        </div>

        <div class="row">
            {{-- Left Column: Tracking Timeline & Products --}}
            <div class="col-lg-8 pr-lg-4 mb-4">

                {{-- Tracking Timeline Card --}}
                <div class="detail-card">
                    <div class="detail-card-header">
                        <h4><i class="fas fa-shipping-fast text-primary"></i> Order Status</h4>
                        @if($stepIndex >= 0 && $stepIndex < 3)
                            <span style="font-size: 1.3rem; color: #16a34a; font-weight: 600;">
                                Expected: {{ $expectedDelivery }}
                            </span>
                        @endif
                    </div>
                    <div class="detail-card-body">
                        @if($stepIndex === -1)
                            <div class="alert alert-danger mb-0" style="font-size: 1.4rem; border-radius: 8px;">
                                <i class="fas fa-info-circle mr-2"></i> This order has been {{ strtolower($statusPillText) }}.
                            </div>
                        @else
                            <div class="tracking-stepper">
                                <div class="stepper-progress-bar">
                                    <div class="stepper-progress-fill" style="width: {{ $progressPercent }}%;"></div>
                                </div>

                                {{-- Step 1: Placed --}}
                                <div class="stepper-step {{ $stepIndex >= 0 ? ($stepIndex == 0 ? 'active' : 'completed') : '' }}">
                                    <div class="stepper-icon">
                                        @if($stepIndex > 0)
                                            <i class="fas fa-check"></i>
                                        @else
                                            <i class="fas fa-shopping-cart"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="stepper-title">Order Placed</div>
                                        <div class="stepper-date">{{ date('d M Y', strtotime($order_info->order_date ?? now())) }}</div>
                                    </div>
                                </div>

                                {{-- Step 2: Confirmed --}}
                                <div class="stepper-step {{ $stepIndex >= 1 ? ($stepIndex == 1 ? 'active' : 'completed') : '' }}">
                                    <div class="stepper-icon">
                                        @if($stepIndex > 1)
                                            <i class="fas fa-check"></i>
                                        @else
                                            <i class="fas fa-box"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="stepper-title">Order Confirmed</div>
                                        <div class="stepper-date">{{ $stepIndex >= 1 ? 'Processing' : 'Pending' }}</div>
                                    </div>
                                </div>

                                {{-- Step 3: Shipped --}}
                                <div class="stepper-step {{ $stepIndex >= 2 ? ($stepIndex == 2 ? 'active' : 'completed') : '' }}">
                                    <div class="stepper-icon">
                                        @if($stepIndex > 2)
                                            <i class="fas fa-check"></i>
                                        @else
                                            <i class="fas fa-truck"></i>
                                        @endif
                                    </div>
                                    <div>
                                        <div class="stepper-title">Shipped</div>
                                        <div class="stepper-date">{{ $stepIndex >= 2 ? 'In Transit' : 'Upcoming' }}</div>
                                    </div>
                                </div>

                                {{-- Step 4: Delivered --}}
                                <div class="stepper-step {{ $stepIndex >= 3 ? 'completed active' : '' }}">
                                    <div class="stepper-icon">
                                        <i class="fas fa-check-circle"></i>
                                    </div>
                                    <div>
                                        <div class="stepper-title">Delivered</div>
                                        <div class="stepper-date">{{ $stepIndex >= 3 ? date('d M Y', strtotime($order_info->delivery_date ?? now())) : $expectedDelivery }}</div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>

                {{-- Ordered Items Card --}}
                <div class="detail-card">
                    <div class="detail-card-header">
                        <h4><i class="fas fa-box-open text-primary"></i> Items in this Order ({{ $order_products->count() }})</h4>
                    </div>
                    <div class="detail-card-body">
                        @if($order_products->isEmpty())
                            <div class="text-center py-4 text-muted" style="font-size: 1.4rem;">
                                No item details available for this order.
                            </div>
                        @else
                            @foreach($order_products as $product)
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
                                <div class="ordered-product-card">
                                    <div class="product-thumb-box">
                                        <img src="{{ $resolvedThumb }}" alt="{{ $product->product_name }}"
                                             onerror="if (this.src.indexOf('/detail/') !== -1) { this.src = '{{ asset('assets/images/products/' . $imgName) }}'; } else { this.src = '{{ asset('assets/images/products/no-product-found.png') }}'; }">
                                    </div>
                                    <div class="product-details-content">
                                        <h5 class="product-details-title">
                                            @if(!empty($product->slug))
                                                <a href="{{ url('products/' . $product->slug) }}">{{ $product->product_name }}</a>
                                            @else
                                                {{ $product->product_name }}
                                            @endif
                                        </h5>

                                        <div class="product-variant-badges">
                                            @if(!empty($product->product_size))
                                                <span class="variant-badge">Size: {{ $product->product_size }}</span>
                                            @endif
                                            @if(!empty($product->product_color))
                                                <span class="variant-badge">Color: {{ $product->product_color }}</span>
                                            @endif
                                            <span class="variant-badge" style="background: #e0f2fe; color: #0369a1;">Qty: {{ $product->product_quantity ?? 1 }}</span>
                                        </div>

                                        <div class="product-pricing-line">
                                            <span class="price-highlight"><span style="font-family: Arial, sans-serif;">₹</span>{{ number_format($product->total_price ?? ($product->product_price * ($product->product_quantity ?? 1)), 2) }}</span>
                                            @if(($product->product_quantity ?? 1) > 1)
                                                <span class="text-muted" style="font-size: 1.25rem;">(<span style="font-family: Arial, sans-serif;">₹</span>{{ number_format($product->product_price, 2) }} each)</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>

            </div>

            {{-- Right Column: Delivery Address, Price Breakdown, Actions --}}
            <div class="col-lg-4">

                {{-- Delivery Address Card --}}
                <div class="detail-card">
                    <div class="detail-card-header">
                        <h4><i class="fas fa-map-marker-alt text-primary"></i> Delivery Address</h4>
                    </div>
                    <div class="detail-card-body">
                        <div class="address-box">
                            <div class="address-customer-name">
                                {{ trim(($order_info->customer_firstname ?? '') . ' ' . ($order_info->customer_lastname ?? '')) ?: 'Customer' }}
                            </div>
                            <div class="address-line">
                                {{ $order_info->customer_address ?? 'Address not specified' }}
                            </div>
                            @if(!empty($order_info->customer_address1))
                                <div class="address-line">{{ $order_info->customer_address1 }}</div>
                            @endif
                            <div class="address-line">
                                @if(!empty($order_info->customer_city))
                                    {{ $order_info->customer_city }},
                                @endif
                                {{ $order_info->customer_state ?? 'Tamil Nadu' }}
                                @if(!empty($order_info->customer_pincode))
                                    - {{ $order_info->customer_pincode }}
                                @endif
                            </div>

                            @if(!empty($order_info->customer_mobileno))
                                <div class="address-contact-item">
                                    <i class="fas fa-phone-alt"></i>
                                    <span>{{ $order_info->customer_mobileno }}</span>
                                </div>
                            @endif
                            @if(!empty($order_info->customer_email))
                                <div class="address-contact-item">
                                    <i class="fas fa-envelope"></i>
                                    <span>{{ $order_info->customer_email }}</span>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                {{-- Price Details Card --}}
                <div class="detail-card">
                    <div class="detail-card-header">
                        <h4><i class="fas fa-receipt text-primary"></i> Price Details</h4>
                    </div>
                    <div class="detail-card-body">
                        <div class="info-list-row">
                            <span class="info-label">Items Total</span>
                            <span class="info-value"><span style="font-family: Arial, sans-serif;">₹</span>{{ number_format($order_info->total_amount ?? $order_info->grand_total, 2) }}</span>
                        </div>

                        <div class="info-list-row">
                            <span class="info-label">Delivery Charges</span>
                            <span class="info-value" style="{{ ($order_info->shipping_charge ?? 0) > 0 ? '' : 'color: #16a34a;' }}">
                                {!! ($order_info->shipping_charge ?? 0) > 0 ? '<span style="font-family: Arial, sans-serif;">₹</span>' . number_format($order_info->shipping_charge, 2) : 'FREE' !!}
                            </span>
                        </div>

                        @if(($order_info->discount_amount ?? 0) > 0)
                            <div class="info-list-row">
                                <span class="info-label">Discount</span>
                                <span class="info-value" style="color: #16a34a;">- <span style="font-family: Arial, sans-serif;">₹</span>{{ number_format($order_info->discount_amount, 2) }}</span>
                            </div>
                        @endif

                        <div class="info-list-row">
                            <span class="info-label">Payment Method</span>
                            <span class="info-value">{{ $order_info->payment_type ?? 'Cash On Delivery' }}</span>
                        </div>

                        <div class="info-total-row">
                            <span class="info-label">Total Amount</span>
                            <span class="info-value"><span style="font-family: Arial, sans-serif;">₹</span>{{ number_format($order_info->grand_total, 2) }}</span>
                        </div>
                    </div>
                </div>

                {{-- Actions Card --}}
                <div class="detail-card">
                    <div class="detail-card-body d-flex flex-column gap-2" style="gap: 12px;">
                        <a href="{{ url('invoice-pdf/' . $order_info->id) }}" class="btn-download-inv" target="_blank">
                            <i class="fas fa-file-invoice"></i> Download Invoice
                        </a>
                        <a href="{{ url('track-order') }}" class="btn-secondary-action">
                            <i class="fas fa-search-location"></i> Track Other Orders
                        </a>
                        <a href="{{ url('home') }}" class="btn-secondary-action">
                            <i class="fas fa-shopping-bag"></i> Continue Shopping
                        </a>
                    </div>
                </div>

            </div>
        </div>

    </div>
</div>

@endsection
