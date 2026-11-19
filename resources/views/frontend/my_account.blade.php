   @extends('app_template')
   @section('title','My Account')
   @section('content')


   <style>
    /* .form-group {
        position: relative;
    }

    .toggle-password {
        position: absolute;
        right: 12px;
        top: 38px;
        cursor: pointer;
        color: #666;
        font-size: 16px;
    }

    @media (max-width: 768px) {
        .toggle-password {
            right: 10px;
            top: 36px;
            font-size: 18px;
        }
    } */


    .shop-footer{
        height: 69px !important;
    }
    .shop-details-ps-image{
            height: 65px;
            /* margin-top: 12px; */
    }
    /* ─── MODERN ORDER CARDS (My Account) ─── */
    .order-cards-container {
        display: flex;
        flex-direction: column;
        gap: 20px;
    }
    .modern-order-card {
        background: #ffffff;
        border: 1px solid #e2e8f0;
        border-radius: 12px;
        box-shadow: 0 1px 4px rgba(0, 0, 0, 0.04);
        overflow: hidden;
        transition: box-shadow 0.2s ease, border-color 0.2s ease;
    }
    .modern-order-card:hover {
        box-shadow: 0 6px 18px rgba(0, 0, 0, 0.07);
        border-color: #cbd5e1;
    }
    .order-card-header {
        background: #f8fafc;
        border-bottom: 1px solid #f1f5f9;
        padding: 14px 20px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
    }
    .order-header-left {
        display: flex;
        align-items: center;
        gap: 14px;
        flex-wrap: wrap;
    }
    .order-id-badge {
        font-size: 13.5px;
        font-weight: 700;
        color: #0f172a;
        background: #e2e8f0;
        padding: 4px 10px;
        border-radius: 6px;
        letter-spacing: 0.3px;
    }
    .order-date-tag {
        font-size: 13px;
        color: #64748b;
        display: flex;
        align-items: center;
        gap: 5px;
    }
    .order-header-right {
        display: flex;
        align-items: center;
        gap: 16px;
        flex-wrap: wrap;
    }
    .order-total-tag {
        font-size: 13.5px;
        color: #475569;
    }
    .order-total-tag strong {
        font-size: 15.5px;
        font-weight: 800;
        color: #0f172a;
    }
    .status-badge {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 4px 12px;
        border-radius: 9999px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 0.2px;
        white-space: nowrap;
    }
    .status-badge-pending {
        background: #fff7ed;
        color: #c2410c;
        border: 1px solid #fed7aa;
    }
    .status-badge-confirmed {
        background: #eff6ff;
        color: #1d4ed8;
        border: 1px solid #bfdbfe;
    }
    .status-badge-dispatch {
        background: #f5f3ff;
        color: #6d28d9;
        border: 1px solid #ddd6fe;
    }
    .status-badge-delivered {
        background: #ecfdf5;
        color: #047857;
        border: 1px solid #a7f3d0;
    }
    .status-badge-cancelled {
        background: #fef2f2;
        color: #b91c1c;
        border: 1px solid #fecaca;
    }
    .status-dot {
        width: 7px;
        height: 7px;
        border-radius: 50%;
        display: inline-block;
    }
    .order-card-body {
        padding: 16px 20px;
    }
    .order-invoice-block {
        padding: 4px 0;
    }
    .order-item-row {
        display: flex;
        align-items: center;
        justify-content: space-between;
        gap: 16px;
        padding: 12px 0;
        border-bottom: 1px dashed #f1f5f9;
    }
    .order-item-row:last-child {
        border-bottom: none;
        padding-bottom: 0;
    }
    .order-item-row:first-child {
        padding-top: 0;
    }
    .order-item-left {
        display: flex;
        align-items: center;
        gap: 16px;
        flex: 1;
    }
    .order-item-thumb {
        width: 68px;
        height: 68px;
        border-radius: 8px;
        object-fit: cover;
        background: #f8fafc;
        border: 1px solid #e2e8f0;
        flex-shrink: 0;
    }
    .order-item-info {
        flex: 1;
    }
    .order-item-title {
        font-size: 14px;
        font-weight: 700;
        color: #1e293b;
        margin-bottom: 4px;
        line-height: 1.3;
    }
    .order-item-meta {
        display: flex;
        align-items: center;
        gap: 6px;
        flex-wrap: wrap;
        font-size: 12px;
        margin-bottom: 2px;
    }
    .meta-chip {
        background: #f1f5f9;
        color: #475569;
        padding: 2px 8px;
        border-radius: 5px;
        font-size: 11.5px;
        font-weight: 500;
    }
    .order-item-price {
        font-size: 15px;
        font-weight: 700;
        color: #0f172a;
        white-space: nowrap;
    }
    .order-card-footer {
        padding: 12px 20px;
        background: #fafafa;
        border-top: 1px solid #f1f5f9;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
        gap: 12px;
    }
    .order-footer-meta {
        font-size: 12.5px;
        color: #64748b;
    }
    .order-footer-actions {
        display: flex;
        align-items: center;
        gap: 8px;
        flex-wrap: wrap;
    }
    .order-footer-actions .btn {
        font-size: 12px !important;
        padding: 6px 14px !important;
        font-weight: 600 !important;
        border-radius: 8px !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        text-transform: none !important;
        letter-spacing: 0 !important;
    }
    .order-footer-actions .btn-track {
        background: #ffffff !important;
        color: #0088dd !important;
        border: 1px solid #0088dd !important;
    }
    .order-footer-actions .btn-track:hover {
        background: #0088dd !important;
        color: #ffffff !important;
    }
    .order-footer-actions .btn-invoice {
        background: #1e293b !important;
        color: #ffffff !important;
        border: 1px solid #1e293b !important;
    }
    .order-footer-actions .btn-invoice:hover {
        background: #0f172a !important;
        color: #ffffff !important;
    }
    .order-footer-actions .btn-cancel {
        background: #fff !important;
        color: #dc2626 !important;
        border: 1px solid #dc2626 !important;
    }
    .order-footer-actions .btn-cancel:hover {
        background: #dc2626 !important;
        color: #ffffff !important;
    }
    .account-dashboard-grid {
        display: flex;
        flex-wrap: wrap;
    }
    .account-dashboard-grid > div {
        display: flex;
        flex-direction: column;
    }
    .account-dashboard-grid .dashboard-option {
        display: flex;
        flex-direction: column;
        height: 100%;
        width: 100%;
        text-decoration: none;
    }
    .account-dashboard-grid .icon-box {
        border: 1px solid #e8e8e8;
        border-radius: 6px;
        padding: 16px 10px;
        min-height: 90px;
        height: 100%;
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        transition: all .2s ease;
        background: #fff;
        width: 100%;
    }
    .account-dashboard-grid .icon-box:hover {
        border-color: #cfd8dc;
        box-shadow: 0 4px 14px rgba(0,0,0,.06);
    }
    .account-back-wrap {
        display: none !important;
    }
    #profile-details-form input.error,
    #profile-details-form input:invalid,
    #profile-details-form .form-control.error,
    #profile-details-form .form-control:invalid {
        border-color: #eee !important;
        box-shadow: none !important;
        outline: none !important;
    }
    #profile-details-form label.error,
    #profile-details-form .error:not(.error-msg) {
        display: none !important;
    }

    #addressForm input.error,
    #addressForm input:invalid,
    #addressForm .form-control.error,
    #addressForm .form-control:invalid,
    #addressForm .form-control.fv-invalid,
    #addressForm input.fv-invalid,
    #addressForm textarea.fv-invalid,
    .shipping-address .form-control.fv-invalid,
    .shipping-address .form-control:invalid {
        border-color: #eee !important;
        box-shadow: none !important;
        outline: none !important;
    }
    #addressForm .form-control:focus {
        border-color: #336699 !important;
        box-shadow: none !important;
    }

    #account-addresses .shipping-address .title {
        margin-top: 0 !important;
        margin-bottom: 0.5rem !important;
        padding-bottom: 0.5rem !important;
    }
    #account-addresses .shipping-address .d-flex.mb-3 {
        margin-top: 0 !important;
        margin-bottom: 0.75rem !important;
    }
    #addressForm .form-control {
        margin-bottom: 0.25rem !important;
        padding: 0.6rem 0.8rem !important;
        height: 40px !important;
        font-size: 13px !important;
    }
    #addressForm label {
        margin-bottom: 4px !important;
        font-size: 12px !important;
        font-weight: 600 !important;
        text-transform: uppercase !important;
        color: #555 !important;
    }
    #addressForm .row > div {
        margin-bottom: 0.6rem !important;
    }
    #addressForm .address-action-wrap {
        margin-top: 8px !important;
    }
    #addressForm #submitBtn,
    #addressForm #deleteBtn {
        margin-top: 0 !important;
    }

    /* ─── MOBILE WISHLIST CARD LAYOUT (My Account) ─── */
    @media (max-width: 767px) {
        #global-back-btn {
            padding: 4px 10px !important;
            font-size: 11px !important;
            border-radius: 12px !important;
        }
        .tab-vertical .tab-content {
            padding-left: 0 !important;
        }
        .tab-content .tab-pane center h3 {
            display: none !important;
        }
        .account-orders-table {
            min-width: 600px !important;
        }
        #wishlist {
            padding: 0 !important;
            margin: 0 !important;
        }

        #wishlist .row,
        #wishlist .page-content,
        #wishlist .page-content > .container {
            padding: 0 !important;
            margin: 0 !important;
            max-width: 100% !important;
            width: 100% !important;
        }

        #wishlist .shop-table.wishlist-table {
            border: none !important;
            width: 100% !important;
        }

        #wishlist .shop-table.wishlist-table thead {
            display: none !important;
        }

        #wishlist .shop-table.wishlist-table tbody {
            display: block !important;
            width: 100% !important;
        }

        #wishlist .shop-table.wishlist-table tbody tr {
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

        #wishlist .shop-table.wishlist-table tbody tr td {
            display: block !important;
            width: 100% !important;
            padding: 0 !important;
            margin: 0 !important;
            border: none !important;
            text-align: left !important;
            vertical-align: top !important;
        }

        /* ── THUMBNAIL ── */
        #wishlist .shop-table.wishlist-table tbody tr td:nth-child(1) {
            grid-area: img !important;
            display: flex !important;
            align-items: flex-start !important;
            justify-content: center !important;
        }

        #wishlist .shop-table.wishlist-table tbody tr td:nth-child(1) .p-relative {
            width: 100px !important;
            height: 100px !important;
            background: #f5f6f8 !important;
            border-radius: 16px !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            overflow: hidden !important;
        }

        #wishlist .shop-table.wishlist-table tbody tr td:nth-child(1) img {
            width: 80px !important;
            height: 80px !important;
            object-fit: contain !important;
            margin: 0 auto !important;
        }

        /* ── PRODUCT NAME ── */
        #wishlist .shop-table.wishlist-table tbody tr td:nth-child(2) {
            grid-area: name !important;
            font-size: 1.5rem !important;
            font-weight: 700 !important;
            color: #111 !important;
            line-height: 1.3 !important;
            padding-top: 4px !important;
            padding-right: 30px !important;
        }

        #wishlist .shop-table.wishlist-table tbody tr td:nth-child(2) a {
            color: #111 !important;
            font-weight: 700 !important;
        }

        /* ── PRICE ── */
        #wishlist .shop-table.wishlist-table tbody tr td:nth-child(3) {
            grid-area: price !important;
            font-size: 1.4rem !important;
            font-weight: 700 !important;
            color: #111 !important;
        }

        #wishlist .shop-table.wishlist-table tbody tr td:nth-child(3) ins.new-price {
            display: inline-flex !important;
            align-items: center !important;
            flex-wrap: wrap !important;
            gap: 6px !important;
            font-weight: 700 !important;
            color: #111 !important;
            text-decoration: none !important;
        }

        /* ── STOCK (HIDE) ── */
        #wishlist .shop-table.wishlist-table tbody tr td:nth-child(4) {
            display: none !important;
        }

        /* ── ACTIONS ── */
        #wishlist .shop-table.wishlist-table tbody tr td:nth-child(5) {
            grid-area: action !important;
            padding-top: 6px !important;
        }

        #wishlist .shop-table.wishlist-table tbody tr td:nth-child(5) > div {
            display: flex !important;
            align-items: center !important;
            gap: 0 !important;
        }

        /* "View" button */
        #wishlist .shop-table.wishlist-table tbody tr td:nth-child(5) .btn-cart {
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
        #wishlist .shop-table.wishlist-table tbody tr td:nth-child(5) .btn-default {
            position: absolute !important;
            top: 18px !important;
            right: 0 !important;
            width: 28px !important;
            height: 28px !important;
            min-width: 0 !important;
            background: #f0f0f2 !important;
            border-radius: 50% !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            color: #999 !important;
            font-size: 0 !important;
            border: none !important;
            padding: 0 !important;
            margin: 0 !important;
            line-height: 1 !important;
            overflow: hidden !important;
        }

        #wishlist .shop-table.wishlist-table tbody tr td:nth-child(5) .btn-default::after {
            content: "\00d7" !important;
            font-size: 18px !important;
            font-weight: 400 !important;
            line-height: 1 !important;
            display: flex !important;
            align-items: center !important;
            justify-content: center !important;
            width: 100% !important;
            height: 100% !important;
            color: #888 !important;
            transform: translateY(-1px) !important;
        }

        /* Empty wishlist row */
        #wishlist .shop-table.wishlist-table tbody tr[data-id] {
            display: block !important;
            text-align: center !important;
            padding: 40px 0 !important;
        }

        #wishlist .shop-table.wishlist-table tbody tr[data-id] td {
            text-align: center !important;
        }
    }
    </style>

   <main class="main">
       <!-- Start of Page Header -->
       <!-- End of Page Header -->

       <!-- Start of Breadcrumb -->
        <nav class="breadcrumb-nav">
            <div class="container d-flex align-items-center justify-content-between">
                <ul class="breadcrumb" id="account-breadcrumb" style="margin-bottom: 0;">
                    <li><a href="{{ url('home') }}">Home</a></li>
                    <li>My account</li>
                </ul>
                <a href="#account-dashboard" data-bs-toggle="tab" id="global-back-btn" class="btn btn-outline btn-default back-to-dashboard" style="display: none; padding: 6px 16px; font-size: 13px; text-transform: uppercase; border-radius: 15px; height: auto; min-height: unset; line-height: 1.2; font-weight: 600;">Back</a>
            </div>
        </nav>
        <!-- End of Breadcrumb -->

        <!-- Start of PageContent -->
        <div class="page-content pt-2">
            <div class="container">
                @if (session('success') && !str_contains(session('success'), 'Order placed') && !str_contains(session('success'), 'Order ID'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert" style="margin-bottom: 20px; padding: 15px; border-radius: 4px; background-color: #d4edda; border-color: #c3e6cb; color: #155724; position: relative;">
                        {{ session('success') }}
                    </div>
                @endif
                @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert" style="margin-bottom: 20px; padding: 15px; border-radius: 4px; background-color: #f8d7da; border-color: #f5c6cb; color: #721c24; position: relative;">
                        {{ session('error') }}
                    </div>
                @endif

                <div class="tab tab-vertical">
                   <div class="tab-content mb-6">
                       <div class="tab-pane active in" id="account-dashboard">
                           <div class="row account-dashboard-grid">
                               <div class="col-lg-3 col-md-6 col-sm-4 col-6 col-xs-6 mb-4">
                                   <a href="#account-orders" data-bs-toggle="tab" class="dashboard-option">
                                       <div class="icon-box text-center">
                                           <span class="icon-box-icon icon-orders">
                                               <i class="w-icon-orders"></i>
                                           </span>
                                           <div class="icon-box-content">
                                               <p class="text-uppercase mb-0">Orders</p>
                                           </div>
                                       </div>
                                   </a>
                               </div>
                               <div class="col-lg-3 col-md-6 col-sm-4 col-6 col-xs-6 mb-4">
                                   <a href="#account-downloads" data-bs-toggle="tab" class="dashboard-option">
                                       <div class="icon-box text-center">
                                           <span class="icon-box-icon icon-download">
                                               <i class="w-icon-wallet"></i>
                                           </span>
                                           <div class="icon-box-content">
                                               <p class="text-uppercase mb-0">Wallet</p>
                                           </div>
                                       </div>
                                   </a>
                               </div>
                               <div class="col-lg-3 col-md-6 col-sm-4 col-6 col-xs-6 mb-4">
                                   <a href="#account-addresses" data-bs-toggle="tab" class="dashboard-option">
                                       <div class="icon-box text-center">
                                           <span class="icon-box-icon icon-address">
                                               <i class="w-icon-map-marker"></i>
                                           </span>
                                           <div class="icon-box-content">
                                               <p class="text-uppercase mb-0">Addresses</p>
                                           </div>
                                       </div>
                                   </a>
                               </div>
                               <div class="col-lg-3 col-md-6 col-sm-4 col-6 col-xs-6 mb-4">
                                   <a href="#profile-details" data-bs-toggle="tab" class="dashboard-option">
                                       <div class="icon-box text-center">
                                           <span class="icon-box-icon icon-account">
                                               <i class="w-icon-user"></i>
                                           </span>
                                           <div class="icon-box-content">
                                               <p class="text-uppercase mb-0">profile  Details</p>
                                           </div>
                                       </div>
                                   </a>
                               </div>
                               <div class="col-lg-3 col-md-6 col-sm-4 col-6 col-xs-6 mb-4">
                                   <a href="#account-details" data-bs-toggle="tab" class="dashboard-option">
                                       <div class="icon-box text-center">
                                           <span class="icon-box-icon icon-account">
                                               <i class="w-icon-tools"></i>
                                           </span>
                                           <div class="icon-box-content">
                                               <p class="text-uppercase mb-0">Account Settings</p>
                                           </div>
                                       </div>
                                   </a>
                               </div>
                               <div class="col-lg-3 col-md-6 col-sm-4 col-6 col-xs-6 mb-4">
                                   <a href="#wishlist" data-bs-toggle="tab" class="dashboard-option">
                                       <div class="icon-box text-center">
                                           <span class="icon-box-icon icon-wishlist">
                                               <i class="w-icon-heart"></i>
                                           </span>
                                           <div class="icon-box-content">
                                               <p class="text-uppercase mb-0">Wishlist</p>
                                           </div>
                                       </div>
                                   </a>
                               </div>
                               <div class="col-lg-3 col-md-6 col-sm-4 col-6 col-xs-6 mb-4">
                                   <a href="{{ route('customer-logout') }}">
                                       <div class="icon-box text-center">
                                           <span class="icon-box-icon icon-logout">
                                               <i class="w-icon-logout"></i>
                                           </span>
                                           <div class="icon-box-content">
                                               <p class="text-uppercase mb-0">Logout</p>
                                           </div>
                                       </div>
                                   </a>
                               </div>
                           </div>
                       </div>

                       <div class="tab-pane mb-4" id="account-orders">
                            <div class="mb-4 pb-2" style="border-bottom: 1px solid #e2e8f0;">
                                <h3 class="mb-0 font-weight-bold" style="font-size: 20px; color: #0f172a; text-transform: none;">My Orders</h3>
                                <p class="text-muted mb-0" style="font-size: 13px;">View status, track shipments, and download invoices</p>
                            </div>

                            @if($orderdata->count() > 0)
                                <div class="order-cards-container">
                                    @foreach($orderdata as $order)
                                        @php
                                            $statusText = $order->order_status ?? 'Pending';
                                            $statusLower = strtolower(trim((string)$statusText));
                                            
                                            $badgeClass = 'status-badge-pending';
                                            $dotColor = '#f97316';
                                            $displayStatus = 'Pending';

                                            if (in_array($statusLower, ['pending'], true)) {
                                                $badgeClass = 'status-badge-pending';
                                                $dotColor = '#f97316';
                                                $displayStatus = 'Order Placed';
                                            } elseif (in_array($statusLower, ['accept', 'accepted', 'confirmed'], true)) {
                                                $badgeClass = 'status-badge-confirmed';
                                                $dotColor = '#2563eb';
                                                $displayStatus = 'Confirmed';
                                            } elseif (in_array($statusLower, ['dispatch', 'dispatched', 'shipped', 'shipping'], true)) {
                                                $badgeClass = 'status-badge-dispatch';
                                                $dotColor = '#7c3aed';
                                                $displayStatus = 'Dispatched';
                                            } elseif (in_array($statusLower, ['delivered', 'delivery'], true)) {
                                                $badgeClass = 'status-badge-delivered';
                                                $dotColor = '#059669';
                                                $displayStatus = 'Delivered';
                                            } elseif (in_array($statusLower, ['cancel', 'cancelled', 'canceled', 'closed'], true)) {
                                                $badgeClass = 'status-badge-cancelled';
                                                $dotColor = '#dc2626';
                                                $displayStatus = 'Cancelled';
                                            } else {
                                                $displayStatus = ucfirst($statusText);
                                            }

                                            $disallowedCancel = [
                                                'dispatch', 'dispatched', 'shipped', 'shipping', 'ship',
                                                'delivery', 'delivered',
                                                'cancel', 'canceled', 'cancelled',
                                                'return', 'returned', 'refund', 'refunded',
                                                'closed', 'completed'
                                            ];
                                        @endphp

                                        <div class="modern-order-card">
                                            <!-- Order Header -->
                                            <div class="order-card-header">
                                                <div class="order-header-left">
                                                    <span class="order-id-badge">#{{ $order->order_id }}</span>
                                                    <span class="order-date-tag">
                                                        <i class="w-icon-calendar mr-1"></i> {{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}
                                                    </span>
                                                </div>
                                                <div class="order-header-right">
                                                    <span class="order-total-tag">
                                                        Total: <strong><span style="font-family: Arial, sans-serif;">₹</span> {{ number_format($order->grand_total, 2) }}</strong>
                                                    </span>
                                                    <span class="status-badge {{ $badgeClass }}">
                                                        <span class="status-dot" style="background-color: {{ $dotColor }};"></span>
                                                        {{ $displayStatus }}
                                                    </span>
                                                </div>
                                            </div>

                                            <!-- Order Items -->
                                            <div class="order-card-body">
                                                @foreach($order->invoice_details as $invoice)
                                                    @php
                                                        $invStatusLower = strtolower(trim((string)($invoice->status ?? '')));
                                                        $canCancelItem = !empty($invoice->can_cancel)
                                                            && !in_array($statusLower, $disallowedCancel, true)
                                                            && !in_array($invStatusLower, $disallowedCancel, true);
                                                    @endphp

                                                    <div class="order-invoice-block {{ !$loop->last ? 'mb-3 pb-3' : '' }}" style="{{ !$loop->last ? 'border-bottom: 1px dashed #e2e8f0;' : '' }}">
                                                        @if(isset($invoice->products) && count($invoice->products) > 0)
                                                            @foreach($invoice->products as $product)
                                                                @php
                                                                    $productImage = $product->product_image ?? '';
                                                                    $productImageUrl = asset('assets/images/products/no-product-found.png');
                                                                    if (!empty($productImage)) {
                                                                        if (file_exists(public_path('assets/images/products/' . $productImage))) {
                                                                            $productImageUrl = asset('assets/images/products/' . $productImage);
                                                                        } elseif (file_exists(public_path('assets/images/products/detail/' . $productImage))) {
                                                                            $productImageUrl = asset('assets/images/products/detail/' . $productImage);
                                                                        } elseif (file_exists(public_path('assets/images/products/popup/' . $productImage))) {
                                                                            $productImageUrl = asset('assets/images/products/popup/' . $productImage);
                                                                        } else {
                                                                            $productImageUrl = asset('assets/images/products/' . $productImage);
                                                                        }
                                                                    }
                                                                @endphp
                                                                <div class="order-item-row">
                                                                    <div class="order-item-left">
                                                                        <img src="{{ $productImageUrl }}" alt="{{ $product->product_name }}" class="order-item-thumb"
                                                                             onerror="if (this.src.indexOf('/detail/') !== -1) { this.src = '{{ asset('assets/images/products/' . $productImage) }}'; } else { this.src = '{{ asset('assets/images/products/no-product-found.png') }}'; }">
                                                                        <div class="order-item-info">
                                                                            <div class="order-item-title">{{ $product->product_name }}</div>
                                                                            <div class="order-item-meta">
                                                                                @if(!empty($product->product_size))
                                                                                    <span class="meta-chip">Size: {{ $product->product_size }}</span>
                                                                                @endif
                                                                                @if(!empty($product->product_color))
                                                                                    <span class="meta-chip">Color: {{ $product->product_color }}</span>
                                                                                @endif
                                                                                <span class="meta-chip">Qty: {{ $invoice->line_qty ?? 1 }}</span>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="order-item-right text-right">
                                                                        <div class="order-item-price"><span style="font-family: Arial, sans-serif;">₹</span> {{ number_format($product->product_price, 2) }}</div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif

                                                        <!-- Item Level Actions (Cancel / Return / Replace) -->
                                                        @if($canCancelItem || !empty($invoice->can_return) || !empty($invoice->return_deadline))
                                                            <div class="d-flex justify-content-end align-items-center gap-2 mt-2 pt-2" style="gap: 8px;">
                                                                @if($canCancelItem)
                                                                    <form method="POST" action="{{ route('my-account.invoice.cancel', $invoice->invoice_id) }}" onsubmit="return confirm('Cancel this order item?');" style="margin: 0;">
                                                                        @csrf
                                                                        <button type="submit" class="btn order-footer-actions btn-cancel">Cancel Item</button>
                                                                    </form>
                                                                @endif

                                                                @if(!empty($invoice->can_return))
                                                                    @php
                                                                        $allowReturn = false;
                                                                        $allowReplacement = false;
                                                                        if (isset($invoice->products) && count($invoice->products) > 0) {
                                                                            foreach($invoice->products as $p) {
                                                                                $rr = (int)($p->return_replace ?? 0);
                                                                                if ($rr === 1 || $rr === 2) { $allowReturn = true; }
                                                                                if ($rr === 1 || $rr === 3) { $allowReplacement = true; }
                                                                            }
                                                                        } else {
                                                                            $allowReturn = true;
                                                                        }
                                                                    @endphp

                                                                    @if($allowReturn)
                                                                        <form id="return-form-{{ $invoice->invoice_id }}" method="POST" action="{{ route('my-account.invoice.return', $invoice->invoice_id) }}" style="margin: 0;">
                                                                            @csrf
                                                                            <input type="hidden" name="request_type" value="Return">
                                                                            <input type="hidden" name="reason" id="return-reason-{{ $invoice->invoice_id }}">
                                                                            <button type="button" class="btn btn-outline btn-primary btn-sm btn-rounded" style="font-size: 12px; padding: 5px 14px;" onclick="submitReturnRequest('{{ $invoice->invoice_id }}', 'Return')">Return</button>
                                                                        </form>
                                                                    @endif

                                                                    @if($allowReplacement)
                                                                        <form id="replace-form-{{ $invoice->invoice_id }}" method="POST" action="{{ route('my-account.invoice.return', $invoice->invoice_id) }}" style="margin: 0;">
                                                                            @csrf
                                                                            <input type="hidden" name="request_type" value="Replacement">
                                                                            <input type="hidden" name="reason" id="replace-reason-{{ $invoice->invoice_id }}">
                                                                            <button type="button" class="btn btn-outline btn-warning btn-sm btn-rounded" style="font-size: 12px; padding: 5px 14px;" onclick="submitReturnRequest('{{ $invoice->invoice_id }}', 'Replacement')">Replacement</button>
                                                                        </form>
                                                                    @endif
                                                                @elseif(!empty($invoice->return_deadline))
                                                                    <small class="text-muted align-self-center">Return till {{ $invoice->return_deadline }}</small>
                                                                @endif
                                                            </div>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            </div>

                                            <!-- Order Card Footer -->
                                            <div class="order-card-footer">
                                                <div class="order-footer-meta">
                                                    <span>Payment: <strong>{{ $order->payment_type ?? 'Cash On Delivery' }}</strong></span>
                                                </div>
                                                <div class="order-footer-actions">
                                                    <a href="{{ url('order_tracking/'.$order->order_id) }}" class="btn btn-track">
                                                        <i class="w-icon-map-marker mr-1"></i> Track Order
                                                    </a>
                                                    <a href="{{ url('invoice-pdf/'.$order->id) }}" class="btn btn-invoice" target="_blank">
                                                        <i class="w-icon-download mr-1"></i> Download Invoice
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            @else
                                <div class="text-center py-5 my-4" style="background: #ffffff; border: 1px solid #e2e8f0; border-radius: 14px; padding: 50px 20px;">
                                    <div class="mb-3" style="font-size: 48px; color: #94a3b8;">
                                        <i class="w-icon-orders"></i>
                                    </div>
                                    <h4 class="font-weight-bold mb-1" style="color: #0f172a; text-transform: none;">No Orders Found</h4>
                                    <p class="text-muted mb-4" style="font-size: 14px;">You haven't placed any orders yet.</p>
                                    <a href="{{ url('shops') }}" class="btn btn-dark btn-rounded btn-sm" style="padding: 10px 24px; font-weight: 600; text-transform: none;">
                                        Start Shopping <i class="w-icon-long-arrow-right ml-1"></i>
                                    </a>
                                </div>
                            @endif
                        </div>

                        <div class="tab-pane" id="account-downloads">
                            <div class="account-back-wrap" style="float:right" >
                                <a href="#account-dashboard" data-bs-toggle="tab" class="btn btn-outline btn-default btn-sm account-back-btn back-to-dashboard">Back</a>
                            </div>
                         
                            <center><h3>Wallet</h3></center>

                            <h4 style="font-size: 1.6rem; font-weight: 700; color: #333; margin-bottom: 15px;">Wallet Balance : 200</h4>

                               <div style="overflow-x: auto; -webkit-overflow-scrolling: touch; width: 100%;">
                                   <table class="shop-table account-orders-table mb-6">
                                       <thead>
                                           <tr>
                                               <th class="order-id">Order</th>
                                               <th class="order-date">Date</th>
                                               <th class="order-status">Status</th>
                                               <th class="order-total">Total</th>
                                               <th class="order-actions">Actions</th>
                                           </tr>
                                       </thead>
                                       <tbody>
                                           <tr>
                                               <td class="order-id">#2321</td>
                                               <td class="order-date">August 20, 2021</td>
                                               <td class="order-status">Processing</td>
                                               <td class="order-total">
                                                   <span class="order-price">$121.00</span> for
                                                   <span class="order-quantity"> 1</span> item
                                               </td>
                                               <td class="order-action">
                                                   <a href="#"
                                                       class="btn btn-outline btn-default btn-block btn-sm btn-rounded">View</a>
                                               </td>
                                           </tr>
                                      
                                       </tbody>
                                   </table>
                               </div>
                          
                           
                       </div>

                       <div class="tab-pane" id="account-addresses">
                           <div class="account-back-wrap" style="float:right" >
                               <a href="#account-dashboard" data-bs-toggle="tab" class="btn btn-outline btn-default btn-sm account-back-btn back-to-dashboard">Back</a>
                           </div>
                          
                           <center><h3>Addresses</h3></center>

                            <p>
                                The following addresses will be used on the checkout page
                                by   <input type="checkbox" checked disabled> default.
                            </p>

                           <div class="row">
                               <div class="col-md-6 col-12 mb-4">
                                   <div class="ecommerce-address billing-address pr-lg-4">

                                    @forelse($shipping_address as $key => $address)
                                    <div class="card mb-3 address-card "
                                        onclick="showAddress(this)"
                                        data-id="{{ $address->id }}"
                                        data-name="{{ $address->customer_firstname }}"
                                        data-mobile="{{ $address->customer_mobileno }}"
                                        data-address="{{ $address->customer_address }}"
                                        data-state="{{ $address->customer_state }}"
                                        data-pincode="{{ $address->customer_pincode }}"
                                        data-email="{{ $address->customer_email }}"
                                        data-default="{{ $address->is_default ? '1' : '0' }}"
                                        style="cursor:pointer;">

                                         <div class="default-checkbox">
                                                <input type="checkbox"
                                                    {{ $address->is_default ? 'checked' : '' }}
                                                    onclick="setDefaultAddress(event, {{ $address->id }})">
                                            </div>
                                        
                                        <div class="card-body">
                                            <h6 class="mb-1">{{ $address->customer_firstname }}</h6>
                                            <p class="mb-0 small">
                                                {{ $address->customer_address }}<br>
                                                {{ $address->customer_state }}<br>
                                                {{ $address->customer_mobileno }}
                                            </p>
                                        </div>
                                    </div>
                                @empty
                                    <p>No shipping addresses found.</p>
                                @endforelse
                                    
                                   </div>
                               </div>
                            <div class="col-md-6 col-12 mb-4">
                                <div class="ecommerce-address shipping-address pr-lg-4">
                                   <div class="d-flex justify-content-between align-items-center mb-2 mt-0">
                                        <h4 id="address-title" class="title title-underline ls-25 font-weight-bold mb-0">
                                            Add Shipping Address
                                        </h4>

                                        <button type="button"
                                                id="addNewAddressBtn"
                                                class="btn submit-button btn-primary btn-sm">
                                            Add Address
                                        </button>
                                    </div>

                                     

                                    <form method="POST" id="addressForm" action="{{ route('save-shipping-address') }}" novalidate data-no-validate>
                                        @csrf

                                        <input type="hidden" name="address_id" id="address_id">

                                        <div class="row">
                                            <div class="col-md-6 col-12 mb-2">
                                                <label>Name <span style="color: red !important;">*</span></label>
                                                <input type="text" name="customer_firstname" id="customer_firstname"
                                                    class="form-control" data-required="true" data-no-validate>
                                                <div class="error-msg text-danger mt-1" style="display:none; font-size: 0.85rem; font-weight: 500; color: #dc3545 !important;">Please enter name</div>
                                            </div>

                                            <div class="col-md-6 col-12 mb-2">
                                                <label>Mobile <span style="color: red !important;">*</span></label>
                                                <input type="text" name="customer_mobileno" id="customer_mobileno"
                                                    class="form-control" maxlength="10" inputmode="numeric"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);" data-required="true" data-no-validate>
                                                <div class="error-msg text-danger mt-1" style="display:none; font-size: 0.85rem; font-weight: 500; color: #dc3545 !important;">Please enter a valid 10-digit mobile number</div>
                                            </div>

                                            <div class="col-md-6 col-12 mb-2">
                                                <label>Email <span style="color: red !important;">*</span></label>
                                                <input type="email" name="customer_email" id="customer_email"
                                                    class="form-control" data-required="true" data-no-validate>
                                                <div class="error-msg text-danger mt-1" style="display:none; font-size: 0.85rem; font-weight: 500; color: #dc3545 !important;">Please enter a valid email address</div>
                                            </div>

                                            <div class="col-md-6 col-12 mb-2">
                                                <label>Pincode <span style="color: red !important;">*</span></label>
                                                <input type="text" name="customer_pincode" id="customer_pincode"
                                                    class="form-control" maxlength="6" inputmode="numeric"
                                                    oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 6);" data-required="true" data-no-validate>
                                                <div class="error-msg text-danger mt-1" style="display:none; font-size: 0.85rem; font-weight: 500; color: #dc3545 !important;">Please enter pincode</div>
                                            </div>

                                            <div class="col-md-6 col-12 mb-2">
                                                <label>Address <span style="color: red !important;">*</span></label>
                                                <input type="text" name="customer_address" id="customer_address"
                                                    class="form-control" placeholder="House number and street name" data-required="true" data-no-validate>
                                                <div class="error-msg text-danger mt-1" style="display:none; font-size: 0.85rem; font-weight: 500; color: #dc3545 !important;">Please enter address</div>
                                            </div>

                                            <div class="col-md-6 col-12 mb-2">
                                                <label>State <span style="color: red !important;">*</span></label>
                                                <input type="text" name="customer_state" id="customer_state"
                                                    class="form-control" value="Tamil Nadu" readonly style="background-color: #f8f9fa;">
                                            </div>
                                        </div>

                                        <div class="d-flex justify-content-between align-items-center address-action-wrap mb-2 mt-1">
                                            <button type="submit" id="submitBtn" class="btn submit-button btn-primary btn-sm">
                                                Add Address
                                            </button>

                                            <button type="button" id="deleteBtn"
                                                style="background-color: rgb(214, 47, 47); color:#fff" class="btn submit-button btn-danger btn-sm d-none">
                                                Delete Address
                                            </button>
                                        </div>

                                    </form>
                                </div>
                            </div>

                           </div>
                       </div>
                       <div class="tab-pane" id="profile-details">
                          <div class="account-back-wrap" style="float:right">
                              <a href="#account-dashboard" data-bs-toggle="tab" class="btn btn-outline btn-default btn-sm account-back-btn back-to-dashboard">Back</a>
                          </div>
                           
                          <center><h3>Profile Details</h3></center> 

                                        <form action="{{url('/updateaddress')}}" id="profile-details-form" method="post" autocomplete="Off" class="custom-profile-form" novalidate>
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-md-4 mb-3">
                                        <label>First Name <span style="color: red !important;">*</span></label>
                                        <input type="text" class="form-control" name="customer_firstname" onkeyup="this.value = this.value.toUpperCase(); " data-required="true" value="{{@$customer->customer_firstname}}" />
                                        <div class="error-msg text-danger mt-1" style="display:none; font-size: 1.1rem; font-weight: 400; color: #dc3545 !important;">Please enter first name</div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label>Last Name</label>
                                        <input type="text" class="form-control" name="customer_lastname" onkeyup="this.value = this.value.toUpperCase(); " value="{{@$customer->customer_lastname}}" />
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label>Phone <span style="color: red !important;">*</span></label>
                                        <input type="text" class="form-control" name="customer_mobileno" id="order_mobile" data-required="true" maxlength="10" inputmode="numeric" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);" value="{{@$customer->customer_mobileno}}" />
                                        <div class="error-msg text-danger mt-1" style="display:none; font-size: 1.1rem; font-weight: 400; color: #dc3545 !important;">Please enter a valid 10-digit phone number</div>
                                    </div>
                                    
                                    <div class="col-md-4 mb-3">
                                        <label>Email Address <span style="color: red !important;">*</span></label>
                                        <input type="email" class="form-control" name="customer_email" data-required="true" value="{{@$customer->customer_email}}" />
                                        <div class="error-msg text-danger mt-1" style="display:none; font-size: 1.1rem; font-weight: 400; color: #dc3545 !important;">Please enter email address</div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label>Street / House No <span style="color: red !important;">*</span></label>
                                        <input type="text" class="form-control" name="customer_address" data-required="true" placeholder="House number and street name" value="{{@$customer->customer_address}}" />
                                        <div class="error-msg text-danger mt-1" style="display:none; font-size: 1.1rem; font-weight: 400; color: #dc3545 !important;">Please enter street / house number</div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label>Area / Locality <span style="color: red !important;">*</span></label>
                                        <input type="text" class="form-control" name="customer_address1" data-required="true" placeholder="Area" value="{{@$customer->customer_address1}}" />
                                        <div class="error-msg text-danger mt-1" style="display:none; font-size: 1.1rem; font-weight: 400; color: #dc3545 !important;">Please enter area / locality</div>
                                    </div>
 
                                    <div class="col-md-4 mb-3">
                                        <label>Town / City <span style="color: red !important;">*</span></label>
                                        <input type="text" class="form-control" id="city" name="customer_city" data-required="true" value="{{@$customer->customer_city}}" />
                                        <div class="error-msg text-danger mt-1" style="display:none; font-size: 1.1rem; font-weight: 400; color: #dc3545 !important;">Please enter town / city</div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label>State <span style="color: red !important;">*</span></label>
                                        <input type="text" class="form-control" id="state" name="customer_state" data-required="true" value="{{@$customer->customer_state ?: 'Tamil Nadu'}}" readonly style="background-color: #f8f9fa;" />
                                        <div class="error-msg text-danger mt-1" style="display:none; font-size: 1.1rem; font-weight: 400; color: #dc3545 !important;">Please enter state</div>
                                    </div>
                                    <div class="col-md-4 mb-3">
                                        <label>ZIP / POSTAL CODE <span style="color: red !important;">*</span></label>
                                        <input type="text" class="form-control" id="pincode" name="customer_pincode" data-required="true" value="{{@$customer->customer_pincode}}" />
                                        <div class="error-msg text-danger mt-1" style="display:none; font-size: 1.1rem; font-weight: 400; color: #dc3545 !important;">Please enter zip / postal code</div>
                                    </div>
                                </div>
 
                                <div class="login-on-checkout mt-2">
                                    <button type="submit" name="btn-sbmt" class="btn btn-dark btn-rounded">SAVE CHANGES</button>
                                </div>
                            </form>
                       </div>

                                           <div class="tab-pane" id="account-details">                           
                        <div class="account-back-wrap" style="float:right">
                            <a href="#account-dashboard" data-bs-toggle="tab" class="btn btn-outline btn-default btn-sm account-back-btn back-to-dashboard">Back</a>
                        </div>
                        <center><h3>Account Details</h3></center> 
                        <div class="row">
                            <form id="changePasswordForm"  action="{{url('/change-customer-password')}}" method="post" name="frm-login" autocomplete="Off" class="checkout-form" >
                            {{ csrf_field() }}
                            <fieldset style="padding:20px;">
                                <legend>Password Change</legend>
                                <div class="form-group col-md-8  mt-2" >
                                    <label>Current password </label>
                                    <div style="position: relative;">
                                        <input type="password" class="form-control" id="customer_opassword"  name="current_password" data-required="true" value="" style="padding-right: 40px;">
                                        <i class="fa-solid fa-eye toggle-password-1"
                                           onclick="togglePasswordAccount('customer_opassword', this)"
                                           style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; z-index: 10;">
                                        </i>
                                    </div>
                                    <div class="error-msg text-danger mt-1" style="display:none; font-size: 1.1rem; font-weight: 400; color: #dc3545 !important;">Please enter current password</div>
                                </div>
                                <div class="form-group col-md-8   mt-2">
                                    <label class="">New password</label>
                                    <div style="position: relative;">
                                        <input type="password" class="form-control "  id="customer_password" name="new_password" data-required="true" style="padding-right: 40px;">
                                        <i class="fa-solid fa-eye toggle-password-1"
                                           onclick="togglePasswordAccount('customer_password', this)"
                                           style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; z-index: 10;">
                                        </i>
                                    </div>
                                    <div class="error-msg text-danger mt-1" style="display:none; font-size: 1.1rem; font-weight: 400; color: #dc3545 !important;">Please enter new password</div>
                                </div>
                                <div class="form-group col-md-8  mt-2">
                                    <label>Confirm new password</label>
                                    <div style="position: relative;">
                                        <input type="password"  class="form-control" id="customer_cpassword" name="confirm_password" data-required="true" style="padding-right: 40px;">
                                        <i class="fa-solid fa-eye toggle-password-1"
                                           onclick="togglePasswordAccount('customer_cpassword', this)"
                                           style="position: absolute; right: 15px; top: 50%; transform: translateY(-50%); cursor: pointer; z-index: 10;">
                                        </i>
                                    </div>
                                    <div class="error-msg text-danger mt-1" style="display:none; font-size: 1.1rem; font-weight: 400; color: #dc3545 !important;">Please enter confirm new password</div>
                                </div>

                            </fieldset>
                            <br>
                            <div class="login-on-checkout">
                                <p class="form-row">
                                    <button type="submit" class="btn btn-dark btn-rounded">SAVE CHANGES</button>
                                </p>
                            </div>
                            </form>
                        </div>
                    </div>

                    <div class="tab-pane" id="wishlist">                           
                        <div class="account-back-wrap" style="float:right">
                            <a href="#account-dashboard" data-bs-toggle="tab" class="btn btn-outline btn-default btn-sm account-back-btn back-to-dashboard">Back</a>
                        </div>
                        <center><h3>Wishlist</h3></center> 
                        <div class="row">
                            <div class="page-content">
                                <div class="container">
                                    <table class="shop-table wishlist-table">
                                        <thead>
                                            <tr>
                                                <th class="product-name" style="text-align: center; width: 12%;"><span>Product</span></th>
                                                <th class="product-name" style="text-align: center; width: 33%;">Product Name</th>
                                                <th class="product-price" style="text-align: center; width: 15%;"><span>Price</span></th>
                                                <th class="product-stock-status" style="text-align: center; white-space: nowrap; width: 20%;"><span>Stock Availability</span></th>
                                                <th class="wishlist-action" style="text-align: center; width: 20%;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @php $i=0; @endphp
                                                        @if($wishCount>0)
                                                        @foreach ($wishlist as $product)
                                                        @php  $i++; @endphp
                                                        
                                                        <tr>
                                                            <td style="text-align: center; vertical-align: middle;" >
                                                                <div class="p-relative"  >
                                                                    <a href="{{url('products', $product->slug ?? $product->ecom_product_id)}}">
                                                                    
                                                                            <img src="{{ asset('assets/images/products/' . $product->product_image) }}" alt="product" style="width:55px; height:55px; object-fit:contain; margin:0 auto;">
                                                                    
                                                                    </a>
                                                                    {{-- <a   href="{{url('Delete_wishlist',$product->ecom_wishlist_id)}}" class="btn btn-close"><i
                                                                            class="fas fa-times"></i></a> --}}
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
                                                                    <span style="font-family: Arial, sans-serif;">₹</span> {{ $product->selling_price }} 
                                                                    <del style="font-size: 0.8em; color: #888; font-weight: 400; margin: 0 4px;"><span class="currencySymbol" style="font-family: Arial, sans-serif;">₹</span> {{ $product->retail_price }}</del> 
                                                                    <span style="color: #27ae60; font-weight: 700; font-size: 1.4rem; margin-left: 5px;">{{ $discount_rounded }}% Off</span>
                                                                </ins>
                                                            </td>
                                                            <td  style="text-align: center; vertical-align: middle; white-space: nowrap;" class="product-stock-status">
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
                                
                                </div>
                            </div>
                        </div>
                    </div>
                       
                   </div>
               </div>
           </div>
       </div>
       <!-- End of PageContent -->
   </main>


   
   <!-- End of Main -->
   @endsection

<script>
    function updateBreadcrumb(target) {
        var breadcrumb = document.getElementById('account-breadcrumb');
        if (!breadcrumb) return;

        // Reset breadcrumb first
        breadcrumb.innerHTML = '<li><a href="{{ url('home') }}">Home</a></li>';

        var backBtn = document.getElementById('global-back-btn');

        if (!target || target === '#account-dashboard') {
            breadcrumb.innerHTML += '<li>My account</li>';
            if (backBtn) backBtn.style.display = 'none';
        } else {
            breadcrumb.innerHTML += '<li><a href="{{ url('myAccount') }}">My account</a></li>';
            if (backBtn) backBtn.style.display = 'inline-block';
            
            var tabName = '';
            switch(target) {
                case '#account-orders': tabName = 'Orders'; break;
                case '#account-downloads': tabName = 'Wallet'; break;
                case '#account-addresses': tabName = 'Addresses'; break;
                case '#profile-details': tabName = 'Profile Details'; break;
                case '#account-details': tabName = 'Account Settings'; break;
                case '#wishlist': tabName = 'Wishlist'; break;
            }
            if (tabName) {
                breadcrumb.innerHTML += '<li>' + tabName + '</li>';
            }
        }
    }

    function showAccountTab(target) {
        if (!target || target.charAt(0) !== '#') return;

        var pane = document.querySelector(target);
        if (!pane) return;

        if (window.history && window.history.replaceState) {
            window.history.replaceState(null, null, target);
        } else {
            window.location.hash = target;
        }

        if (window.bootstrap && bootstrap.Tab) {
            var toggle = document.querySelector('[data-bs-toggle="tab"][href="' + target + '"]');
            if (toggle) {
                bootstrap.Tab.getOrCreateInstance(toggle).show();
                updateBreadcrumb(target);
                return;
            }
        }

        document.querySelectorAll('.tab-content .tab-pane').forEach(function (el) {
            el.classList.remove('active', 'show', 'in');
        });
        pane.classList.add('active', 'show', 'in');
        updateBreadcrumb(target);
    }

    function submitReturnRequest(invoiceId, type) {
        Swal.fire({
            title: type + ' Request',
            input: 'textarea',
            inputLabel: 'Reason for ' + type.toLowerCase() + ':',
            inputPlaceholder: 'Please type the reason here...',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Submit',
            preConfirm: (reason) => {
                if (!reason || reason.trim() === '') {
                    Swal.showValidationMessage('Reason is required');
                }
                return reason;
            }
        }).then((result) => {
            if (result.isConfirmed) {
                const formId = (type === 'Return' ? 'return-form-' : 'replace-form-') + invoiceId;
                const reasonInputId = (type === 'Return' ? 'return-reason-' : 'replace-reason-') + invoiceId;
                document.getElementById(reasonInputId).value = result.value;
                document.getElementById(formId).submit();
            }
        });
    }

    function toggleOrderDetails(orderId) {
        var row = document.getElementById('order-details-' + orderId);
        if (!row) return;
        row.style.display = row.style.display === 'table-row' ? 'none' : 'table-row';
    }

    function setDefaultAddress(e, addressId) {
        e.stopPropagation(); // prevent card click

        if (!confirm('Set this address as default?')) {
            e.target.checked = false;
            return;
        }

        fetch("{{ route('set-default-shipping-address') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ address_id: addressId })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                Swal.fire("Success!", "Default address updated", "success")
                    .then(() => {
                        window.location.hash = '#account-addresses';
                        window.location.reload();
                    });
            }
        });
    }


    function showAddress(card) {

        // remove active from all cards
        document.querySelectorAll('.address-card').forEach(el => {
            el.classList.remove('active');
        });

        // add active to clicked card
        card.classList.add('active');

        // fill form values
        document.getElementById('address_id').value = card.dataset.id;
        document.getElementById('customer_firstname').value = card.dataset.name;
        document.getElementById('customer_mobileno').value = (card.dataset.mobile || '').replace(/[^0-9]/g, '').slice(0, 10);
        document.getElementById('customer_email').value = card.dataset.email;
        document.getElementById('customer_address').value = card.dataset.address;
        document.getElementById('customer_state').value = card.dataset.state || 'Tamil Nadu';
        document.getElementById('customer_pincode').value = card.dataset.pincode;

        document.querySelectorAll('#addressForm .error-msg').forEach(function(el) {
            el.style.display = 'none';
        });

        // update button
        const btn = document.getElementById('submitBtn');
        btn.innerText = 'Update Address';
        btn.classList.remove('btn-primary');
        btn.classList.add('btn-success');

        // update title
        document.getElementById('address-title').innerText = 'Edit Shipping Address';
        if (card.dataset.default === '1') {
            document.getElementById('deleteBtn').classList.add('d-none');
        } else {
            document.getElementById('deleteBtn').classList.remove('d-none');
        }
    }

    document.addEventListener('DOMContentLoaded', function () {
        // Destroy any jQuery validation auto-attached to profile form
        if (window.jQuery) {
            var $profileForm = jQuery('#profile-details-form');
            if ($profileForm.length && $profileForm.data('validator')) {
                $profileForm.data('validator').destroy();
                $profileForm.find('.error').removeClass('error');
                $profileForm.find('label.error').remove();
            }
        }

        const hash = window.location.hash;
        if (hash) {
            showAccountTab(hash);
        } else {
            updateBreadcrumb('#account-dashboard');
        }

        document.querySelectorAll('.dashboard-option, .back-to-dashboard, .link-to-tab').forEach(function (link) {
            link.addEventListener('click', function (e) {
                const target = this.getAttribute('href');
                if (!target || target.charAt(0) !== '#') {
                    return;
                }
                e.preventDefault();
                showAccountTab(target);
            });
        });


       var passwordForm = document.getElementById('changePasswordForm');
       if (passwordForm) {
           passwordForm.addEventListener('submit', function (e) {
               e.preventDefault(); // stop normal submit

               var form = this;
               var isValid = true;

               // Hide all errors
               form.querySelectorAll('.error-msg').forEach(function(el) {
                   el.style.display = 'none';
               });

               // Check required fields
               form.querySelectorAll('[data-required]').forEach(function(input) {
                   if (!input.value || input.value.trim() === '') {
                       isValid = false;
                       // Locate the error span. It might be next to the relative wrapper parent.
                       var errorSpan = input.closest('.form-group').querySelector('.error-msg');
                       if (errorSpan) {
                           errorSpan.style.display = 'block';
                       }
                   }
               });

               if (!isValid) {
                   return false;
               }

               Swal.fire({
                   title: "Are you sure?",
                   text: "Do you want to change your password?",
                   icon: "warning",
                   buttons: ["No", "Yes, Change"],
                   dangerMode: true,
               }).then(function (willChange) {
                   if (willChange) {
                       passwordForm.submit(); 
                   }
               });
           });
       }

        var profileForm = document.getElementById('profile-details-form');
        if (profileForm) {
            profileForm.addEventListener('submit', function (e) {
                e.preventDefault();
                
                var form = this;
                var isValid = true;
                
                // Hide all errors
                form.querySelectorAll('.error-msg').forEach(function(el) {
                    el.style.display = 'none';
                });
                
                // Check required fields
                form.querySelectorAll('[data-required]').forEach(function(input) {
                    if (!input.value || input.value.trim() === '') {
                        isValid = false;
                        var errorSpan = input.nextElementSibling;
                        if (errorSpan && errorSpan.classList.contains('error-msg')) {
                            errorSpan.style.display = 'block';
                        }
                    } else if (input.type === 'email') {
                        var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                        if (!emailRegex.test(input.value.trim())) {
                            isValid = false;
                            var errorSpan = input.nextElementSibling;
                            if (errorSpan && errorSpan.classList.contains('error-msg')) {
                                errorSpan.innerText = 'Please enter a valid email address';
                                errorSpan.style.display = 'block';
                            }
                        }
                    } else if (input.name === 'customer_mobileno') {
                        var mobileRegex = /^[0-9]{10}$/;
                        if (!mobileRegex.test(input.value.trim())) {
                            isValid = false;
                            var errorSpan = input.nextElementSibling;
                            if (errorSpan && errorSpan.classList.contains('error-msg')) {
                                errorSpan.innerText = 'Please enter a valid 10-digit phone number';
                                errorSpan.style.display = 'block';
                            }
                        }
                    }
                });
                
                if (isValid) {
                    Swal.fire({
                        title: "Are you sure?",
                        text: "Do you want to Change Billing Address?",
                        icon: "warning",
                        buttons: ["No", "Yes, Update"],
                        dangerMode: true,
                    }).then(function (willChange) {
                        if (willChange) {
                            form.submit();
                        }
                    });
                }
            });
        }




        document.getElementById('addNewAddressBtn').addEventListener('click', function () {

            // clear form
            document.getElementById('addressForm').reset();
            document.getElementById('address_id').value = '';

            // remove active cards
            document.querySelectorAll('.address-card').forEach(el => {
                el.classList.remove('active');
            });

            // reset submit button
            const btn = document.getElementById('submitBtn');
            btn.innerText = 'Add Address';
            btn.classList.remove('btn-success');
            btn.classList.add('btn-primary');

            // reset title
            document.getElementById('address-title').innerText = 'Add Shipping Address';
            document.getElementById('deleteBtn').classList.add('d-none');
            document.getElementById('customer_state').value = 'Tamil Nadu';

            document.querySelectorAll('#addressForm .error-msg').forEach(function(el) {
                el.style.display = 'none';
            });
            
        });

        const addressForm = document.getElementById('addressForm');
        if (addressForm) {
            addressForm.addEventListener('submit', function (e) {
                var form = this;
                var isValid = true;

                // Hide all error messages first
                form.querySelectorAll('.error-msg').forEach(function(el) {
                    el.style.display = 'none';
                });

                var nameInput = document.getElementById('customer_firstname');
                if (!nameInput || !nameInput.value.trim()) {
                    isValid = false;
                    var err = nameInput.parentElement ? nameInput.parentElement.querySelector('.error-msg') : null;
                    if (err) err.style.display = 'block';
                }

                var mobileInput = document.getElementById('customer_mobileno');
                var mobileVal = mobileInput ? mobileInput.value.trim() : '';
                if (!/^[0-9]{10}$/.test(mobileVal)) {
                    isValid = false;
                    var err = mobileInput.parentElement ? mobileInput.parentElement.querySelector('.error-msg') : null;
                    if (err) err.style.display = 'block';
                }

                var emailInput = document.getElementById('customer_email');
                var emailVal = emailInput ? emailInput.value.trim() : '';
                var emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailVal || !emailRegex.test(emailVal)) {
                    isValid = false;
                    var err = emailInput.parentElement ? emailInput.parentElement.querySelector('.error-msg') : null;
                    if (err) err.style.display = 'block';
                }

                var pincodeInput = document.getElementById('customer_pincode');
                if (!pincodeInput || !pincodeInput.value.trim()) {
                    isValid = false;
                    var err = pincodeInput.parentElement ? pincodeInput.parentElement.querySelector('.error-msg') : null;
                    if (err) err.style.display = 'block';
                }

                var addrInput = document.getElementById('customer_address');
                if (!addrInput || !addrInput.value.trim()) {
                    isValid = false;
                    var err = addrInput.parentElement ? addrInput.parentElement.querySelector('.error-msg') : null;
                    if (err) err.style.display = 'block';
                }

                if (!isValid) {
                    e.preventDefault();
                    var firstErr = form.querySelector('.error-msg[style*="block"]');
                    if (firstErr && firstErr.parentElement) {
                        var inp = firstErr.parentElement.querySelector('input');
                        if (inp) inp.focus();
                    }
                    return false;
                }
            });

            // Real-time hide error message on input
            addressForm.querySelectorAll('input').forEach(function(input) {
                input.addEventListener('input', function() {
                    var err = this.parentElement ? this.parentElement.querySelector('.error-msg') : null;
                    if (err) {
                        err.style.display = 'none';
                    }
                });
            });
        }


        document.getElementById('deleteBtn').addEventListener('click', function () {

        const addressId = document.getElementById('address_id').value;

        if (!addressId) {
            alert('Please select an address');
            return;
        }

        const activeCard = document.querySelector('.address-card.active');
        if (activeCard && activeCard.dataset.default === '1') {
            Swal.fire({
                title: "Cannot Delete!",
                text: "Default address cannot be deleted. Please set another address as default first.",
                icon: "warning",
                button: "OK"
            });
            return;
        }

        if (!confirm('Are you sure you want to delete this address?')) {
            return;
        }

        fetch("{{ route('delete-shipping-address') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ address_id: addressId })
        })
        .then(res => res.json())
        .then(data => {
            if (!data.success) {
                Swal.fire({
                    title: "Cannot Delete!",
                    text: data.message || "Default address cannot be deleted. Please set another address as default first.",
                    icon: "warning",
                    button: "OK"
                });
                return;
            }
            Swal.fire({
                title: "Success!",
                text: "Address deleted successfully",
                icon: "success",
                button: "OK",
            }).then(() => {
                window.location.hash = '#account-addresses';
                window.location.reload();
            });
        });
    });

});



</script>


