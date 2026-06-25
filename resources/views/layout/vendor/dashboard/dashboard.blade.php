@extends('layout.auth.master')
@section('contents')

    @include('paritials.vendorauth.header')

<!-- page-wrapper Start-->
@include('paritials.vendorauth.topmenu')
<!-- Page Header Ends -->

<!-- Page Body Start-->
<div class="page-body-wrapper">
	
	<!-- Page Sidebar Start-->
	@include('paritials.vendorauth.sidemenu')
	<!-- Page Sidebar Ends-->
	
<div class="page-body" style="background-color: #f7fafc; margin-top: 60px !important; ">

    <style>
        /* General styling */
        .dashboard-container {
            font-family: 'Inter', 'Work Sans', sans-serif;
            padding: 20px 20px 30px 20px;
        }

        /* Profile Card styling */
        .profile-card {
            background: #ffffff;
            border: 1px solid #e2e8f0;
            border-radius: 24px;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.03), 0 8px 10px -6px rgba(0, 0, 0, 0.03);
            padding: 0 !important;
            overflow: hidden !important;
            color: #2d3748;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }
        .profile-header {
            display: flex;
            align-items: flex-start;
            gap: 20px;
            margin-bottom: 20px;
        }
        .profile-pic {
            width: 75px;
            height: 75px;
            border-radius: 50%;
            object-fit: cover;
            border: 2px solid #e2e8f0;
        }
        .profile-title-container {
            flex-grow: 1;
        }
        .profile-title {
            font-size: 19px;
            font-weight: 700;
            margin: 0 0 6px 0;
            color: #1a202c;
            display: flex;
            align-items: center;
            flex-wrap: wrap;
            gap: 8px;
        }
        .profile-title a {
            color: #02cccd;
            font-size: 13.5px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            text-decoration: none;
            transition: color 0.2s;
        }
        .profile-title a:hover {
            color: #00999a;
        }
        .address-text {
            font-size: 13px;
            color: #718096;
            margin: 4px 0;
            line-height: 1.45;
        }
        .category-text {
            font-size: 12.5px;
            color: #4a5568;
            margin: 8px 0 0 0;
        }
        .category-text strong {
            color: #b7791f;
        }
        .info-label {
            font-size: 11px;
            text-transform: uppercase;
            color: #a0aec0;
            letter-spacing: 0.6px;
            margin-bottom: 4px;
            font-weight: 600;
        }
        .info-value {
            font-size: 14px;
            font-weight: 600;
            color: #2d3748;
            margin: 0;
        }
        .plan-badge {
            background-color: #02cccd;
            color: #ffffff;
            padding: 6px 14px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            display: inline-block;
            border: none;
            transition: background-color 0.2s;
        }
        .plan-badge:hover {
            background-color: #01adad;
            color: #ffffff;
        }
        .upgrade-link {
            color: #02cccd;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s;
        }
        .upgrade-link:hover {
            color: #01adad;
            text-decoration: underline;
        }
        .dot-indicator {
            display: inline-block;
            width: 14px;
            height: 14px;
            border-radius: 50%;
            margin-left: 8px;
        }
        
        /* Metrics Cards styling */
        .metric-card {
            border-radius: 16px;
            padding: 24px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02), 0 2px 4px -1px rgba(0, 0, 0, 0.01);
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 115px;
            transition: transform 0.2s;
        }
        .metric-card:hover {
            transform: translateY(-2px);
        }
        .metric-title {
            font-size: 13px;
            font-weight: 600;
            margin-bottom: 8px;
            opacity: 0.95;
            line-height: 1.3;
        }
        .metric-value {
            font-size: 28px;
            font-weight: 700;
            margin: 0;
            line-height: 1.1;
        }
        
        /* Dynamic active orders tab buttons */
        .tab-btn {
            padding: 10px 22px;
            border-radius: 24px;
            font-size: 14px;
            font-weight: 600;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
            background-color: #edf2f7;
            color: #4a5568;
        }
        .tab-btn:hover {
            background-color: #cbd5e0;
        }
        .tab-btn.active {
            background-color: #094080;
            color: #ffffff;
        }
        
        /* Order Cards inside Grid */
        .order-card {
            background: #ffffff;
            border: 1px solid #edf2f7;
            border-radius: 18px;
            padding: 20px;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
            transition: transform 0.2s, box-shadow 0.2s;
        }
        .order-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.05);
        }
        .order-card-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-bottom: 1px solid #f7fafc;
            padding-bottom: 12px;
            margin-bottom: 14px;
        }
        .order-card-body {
            display: flex;
            align-items: center;
            gap: 16px;
        }
        .pill-badge {
            padding: 4px 10px;
            border-radius: 6px;
            font-size: 10.5px;
            font-weight: 700;
            text-transform: uppercase;
        }
        .pill-paid {
            background-color: #e6fcf5;
            color: #0ca678;
        }
        .pill-cod {
            background-color: #fff9db;
            color: #f08c00;
        }

        /* Toggle switch */
        .switch {
            position: relative;
            display: inline-block;
            width: 44px;
            height: 22px;
            margin: 0;
        }
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }
        .slider-round {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #2ecc71;
            transition: .3s;
            border-radius: 34px;
        }
        .slider-round:before {
            position: absolute;
            content: "";
            height: 16px;
            width: 16px;
            left: 24px;
            bottom: 3px;
            background-color: white;
            transition: .3s;
            border-radius: 50%;
        }
        .switch input:not(:checked) + .slider-round {
            background-color: #ccc;
        }
        .switch input:not(:checked) + .slider-round:before {
            left: 4px;
        }
    </style>

    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="page-header" style="margin-top: 15px !important;">
            <div class="row">
                <div class="col-lg-6">
                    <div class="page-header-left">
                        <h3 style="font-weight: 700; color: #1a202c; font-size: 22px; margin-top: 15px !important;">Dashboard</h3>
                    </div>
                </div>
                <div class="col-lg-6">
                    <ol class="breadcrumb pull-right" style="margin-top: 15px !important;">
                        <li class="breadcrumb-item"><a href="{{ route('portal_selection') }}"><i data-feather="home"></i></a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->


    <div class="container-fluid dashboard-container">
        <!-- Top Section: Profile Card (Left) and Metrics Grid (Right) -->
        <div class="row">
            <!-- 1. Profile / Business Card -->
            <div class="col-xl-6 col-lg-6 col-md-12 mb-4" style="display: flex; flex-direction: column;">
                <div class="profile-card" style="padding: 0; overflow: hidden; position: relative;">
                    <!-- Modern Gradient Banner -->
                    <div style="height: 85px; background: #183543; position: relative;">
                        <!-- Status Badge overlay in banner -->
                        <div style="position: absolute; top: 50%; transform: translateY(-50%); right: 24px; display: flex; align-items: center;">
                            <span style="background-color: rgba(46, 204, 113, 0.25); color: #2ecc71; padding: 6px 14px; border-radius: 20px; font-size: 11px; font-weight: 700; text-transform: uppercase; border: 1px solid rgba(46, 204, 113, 0.4); letter-spacing: 0.5px; backdrop-filter: blur(4px);">Active</span>
                        </div>
                    </div>
                    
                    <!-- Profile picture overlapping the banner -->
                    <div style="padding: 0 24px; margin-top: -40px; height: 38px; position: relative;">
                        @if(!empty($vendorDetails->profile_image) && file_exists(public_path('assets/images/vendor/profile/' . $vendorDetails->profile_image)))
                            <img src="{{ asset('assets/images/vendor/profile/' . $vendorDetails->profile_image) }}" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 4px solid #ffffff; box-shadow: 0 4px 10px rgba(0,0,0,0.1); position: absolute; bottom: 0; left: 24px;" alt="Profile">
                        @else
                            <img src="{{ asset('assets/images/dashboard/man.jpeg') }}" style="width: 80px; height: 80px; border-radius: 50%; object-fit: cover; border: 4px solid #ffffff; box-shadow: 0 4px 10px rgba(0,0,0,0.1); position: absolute; bottom: 0; left: 24px;" alt="Profile">
                        @endif
                    </div>

                    <!-- Shop Information -->
                    <div style="padding: 16px 24px 24px 24px; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                        <div>
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 6px;">
                                <h4 style="font-size: 20px; font-weight: 700; color: #1a202c; margin: 0;">
                                    {{ $vendorDetails->shop_name ?? 'ABC Garments' }}
                                </h4>
                                <div style="display: flex; gap: 3px; align-items: center;">
                                    <i class="fa fa-star" style="color: #f1c40f; font-size: 14px;"></i>
                                    <i class="fa fa-star" style="color: #f1c40f; font-size: 14px;"></i>
                                    <i class="fa fa-star" style="color: #f1c40f; font-size: 14px;"></i>
                                    <i class="fa fa-star" style="color: #f1c40f; font-size: 14px;"></i>
                                    <i class="fa fa-star" style="color: #f1c40f; font-size: 14px;"></i>
                                    <span style="font-size: 12px; font-weight: 700; color: #4a5568; margin-left: 4px;">5.0</span>
                                </div>
                            </div>
                            
                            <!-- Address with icon & Map button -->
                            <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 12px; gap: 12px;">
                                <p style="font-size: 13px; color: #718096; margin: 0; display: flex; align-items: flex-start; gap: 6px; line-height: 1.4;">
                                    <i class="fa fa-map-marker" style="color: #a0aec0; margin-top: 3px; font-size: 12px; width: 12px; text-align: center;"></i>
                                    <span>
                                        #{{ $vendorDetails->address ?? '38' }}
                                        @if(!empty($vendorDetails->address1)), {{ $vendorDetails->address1 }} @endif
                                        @if(!empty($vendorDetails->city)), {{ $vendorDetails->city }} @endif
                                        @if(!empty($vendorDetails->state)), {{ $vendorDetails->state }} @endif
                                        @if(!empty($vendorDetails->pincode)) - {{ $vendorDetails->pincode }} @endif
                                    </span>
                                </p>
                                @if(!empty($vendorDetails->location_map))
                                    <a href="{{ $vendorDetails->location_map }}" target="_blank" style="background-color: #02cccd; color: #ffffff; padding: 5px 12px; border-radius: 6px; font-size: 11px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 4px; box-shadow: 0 2px 5px rgba(2, 204, 205, 0.15); white-space: nowrap;">
                                        <i class="fa fa-map-marker" style="font-size: 10px;"></i> Map View
                                    </a>
                                @endif
                            </div>
                            
                            <!-- Business Category Box -->
                            <div style="background-color: #f8fafc; border: 1px solid #edf2f7; border-radius: 12px; padding: 10px 14px; margin-bottom: 16px;">
                                <div style="font-size: 10px; text-transform: uppercase; color: #a0aec0; letter-spacing: 0.6px; font-weight: 700; margin-bottom: 2px;">Business Category</div>
                                <div style="font-size: 13px; font-weight: 600; color: #2d3748; display: flex; align-items: center; gap: 6px;">
                                    <i class="fa fa-tag" style="color: #b7791f; font-size: 11px;"></i>
                                    <span>
                                        {{ $vendorDetails->business_category ?? 'Fashion' }}
                                        @if(count($subCategoriesList) > 0)
                                            <span style="color: #718096; font-weight: 400; font-size: 12px;">
                                                ({{ implode(', ', array_slice($subCategoriesList, 0, 2)) }}
                                                @if(count($subCategoriesList) > 2)
                                                    +{{ count($subCategoriesList) - 2 }} more
                                                @endif)
                                            </span>
                                        @endif
                                    </span>
                                </div>
                            </div>
                            
                            <!-- Owner & Phone Details Grid -->
                            <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 12px; margin-bottom: 16px; border-bottom: 1px solid #edf2f7; padding-bottom: 12px;">
                                <div>
                                    <div style="font-size: 10px; text-transform: uppercase; color: #a0aec0; letter-spacing: 0.6px; font-weight: 700; margin-bottom: 2px;">Owner Name</div>
                                    <div style="font-size: 13px; font-weight: 600; color: #2d3748; display: flex; align-items: center; gap: 5px;">
                                        <i class="fa fa-user" style="color: #718096; font-size: 12px;"></i>
                                        {{ $vendorDetails->owner_name ?? 'N/A' }}
                                    </div>
                                </div>
                                <div>
                                    <div style="font-size: 10px; text-transform: uppercase; color: #a0aec0; letter-spacing: 0.6px; font-weight: 700; margin-bottom: 2px;">Mobile Number</div>
                                    <div style="font-size: 13px; font-weight: 600; color: #2d3748; display: flex; align-items: center; gap: 5px;">
                                        <i class="fa fa-phone" style="color: #718096; font-size: 12px;"></i>
                                        {{ $vendorDetails->mobile_number1 ?? 'N/A' }}
                                    </div>
                                </div>
                            </div>

                            <!-- Email & Subscription Plan -->
                            <div style="display: flex; flex-direction: column; gap: 10px; margin-bottom: 16px;">
                                <div style="display: flex; align-items: center; gap: 6px;">
                                    <i class="fa fa-envelope" style="color: #a0aec0; font-size: 12px; width: 12px; text-align: center;"></i>
                                    <span style="font-size: 13px; color: #4a5568; font-weight: 500;">{{ $vendorDetails->email ?? 'emailaddress@com' }}</span>
                                </div>
                                
                                <!-- Plan Card Container -->
                                <div style="background: linear-gradient(135deg, #e6fcf5 0%, #c3fae8 100%); border-radius: 12px; padding: 12px 14px; display: flex; justify-content: space-between; align-items: center; border: 1px solid #a3ebd6;">
                                    <div>
                                        <div style="font-size: 9px; text-transform: uppercase; color: #0ca678; letter-spacing: 0.5px; font-weight: 700;">Plan Info</div>
                                        <div style="font-size: 13px; font-weight: 700; color: #094080; margin-top: 1px;">{{ $packagePlanName }}</div>
                                        <div style="font-size: 11px; color: #0ca678; font-weight: 500; margin-top: 1px;">
                                            Till: {{ $vendorDetails->expired_date ? date('d M Y', strtotime($vendorDetails->expired_date)) : '31st Dec 2023' }}
                                        </div>
                                    </div>
                                    <a href="javascript:void(0)" style="background-color: #0ca678; color: #ffffff; padding: 5px 12px; border-radius: 6px; font-size: 11.5px; font-weight: 700; text-decoration: none; transition: background-color 0.2s; box-shadow: 0 2px 5px rgba(12, 166, 120, 0.15);">
                                        Renewal
                                    </a>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

            <!-- 2. Metrics Cards -->
            <div class="col-xl-6 col-lg-6 col-md-12 mb-4" style="display: flex; flex-direction: column;">
                <div class="row" style="flex-grow: 1; display: flex; margin-bottom: -24px;">
                    <!-- Card 1: Orders -->
                    <div class="col-md-6 col-sm-6" style="margin-bottom: 24px; display: flex; flex-direction: column;">
                        <div class="metric-card" style="background: linear-gradient(135deg, #094080 0%, #1e5ba0 100%); color: #ffffff; position: relative; padding: 24px; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                            <div>
                                <div class="metric-title" style="font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px; opacity: 0.85;">Orders</div>
                                <div class="metric-value" style="font-size: 36px; font-weight: 700; margin-top: 8px;">{{ number_format($orderCount) }}</div>
                            </div>
                            <i class="fa fa-shopping-bag" style="position: absolute; right: 24px; bottom: 24px; font-size: 36px; opacity: 0.18;"></i>
                        </div>
                    </div>
                    
                    <!-- Card 2: Products -->
                    <div class="col-md-6 col-sm-6" style="margin-bottom: 24px; display: flex; flex-direction: column;">
                        <div class="metric-card" style="background: linear-gradient(135deg, #00bfa5 0%, #1de9b6 100%); color: #ffffff; position: relative; padding: 24px; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                            <div>
                                <div class="metric-title" style="font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px; opacity: 0.85;">Products</div>
                                <div class="metric-value" style="font-size: 36px; font-weight: 700; margin-top: 8px;">{{ number_format($productCount) }}</div>
                            </div>
                            <i class="fa fa-cubes" style="position: absolute; right: 24px; bottom: 24px; font-size: 36px; opacity: 0.18;"></i>
                        </div>
                    </div>
                    
                    <!-- Card 3: Customers -->
                    <div class="col-md-6 col-sm-6" style="margin-bottom: 24px; display: flex; flex-direction: column;">
                        <div class="metric-card" style="background: linear-gradient(135deg, #ff5252 0%, #ff8a80 100%); color: #ffffff; position: relative; padding: 24px; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                            <div>
                                <div class="metric-title" style="font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px; opacity: 0.85;">Customers</div>
                                <div class="metric-value" style="font-size: 36px; font-weight: 700; margin-top: 8px;">{{ number_format($customerCount) }}</div>
                            </div>
                            <i class="fa fa-users" style="position: absolute; right: 24px; bottom: 24px; font-size: 36px; opacity: 0.18;"></i>
                        </div>
                    </div>
                    
                    <!-- Card 4: Viewers -->
                    <div class="col-md-6 col-sm-6" style="margin-bottom: 24px; display: flex; flex-direction: column;">
                        <div class="metric-card" style="background: linear-gradient(135deg, #7c4dff 0%, #b388ff 100%); color: #ffffff; position: relative; padding: 24px; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                            <div>
                                <div class="metric-title" style="font-size: 14px; text-transform: uppercase; letter-spacing: 0.5px; opacity: 0.85;">Viewers</div>
                                <div class="metric-value" style="font-size: 36px; font-weight: 700; margin-top: 8px;">{{ number_format($totalViews) }}</div>
                            </div>
                            <i class="fa fa-eye" style="position: absolute; right: 24px; bottom: 24px; font-size: 36px; opacity: 0.18;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bottom Section: Active Orders -->
        <div class="card mt-2" style="border-radius: 20px; border: none; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.02);">
            <div class="card-header" style="background-color: transparent; border: none; display: flex; justify-content: space-between; align-items: center; padding: 24px 24px 10px 24px;">
                <h4 style="font-weight: 700; color: #1a202c; margin: 0; font-size: 19px;">Active Orders</h4>
                <a href="{{ route('vendor.order') }}" style="color: #718096; font-size: 14px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 4px;">
                    View All <i class="fa fa-angle-right" style="font-size: 15px;"></i>
                </a>
            </div>
            <div class="card-body" style="padding: 10px 24px 24px 24px;">
                <!-- Filter Tabs -->
                @php
                    $pendingOrders = $activeOrders->filter(fn($o) => $o->order_status === 'Pending');
                    $acceptedOrders = $activeOrders->filter(fn($o) => $o->order_status === 'Accept');
                    $shippedOrders = $activeOrders->filter(fn($o) => $o->order_status === 'Dispatch');
                @endphp
                
                <div style="display: flex; gap: 12px; margin-bottom: 24px; flex-wrap: wrap;">
                    <button class="tab-btn active" onclick="switchActiveTab('pending', this)">
                        Pending ({{ count($pendingOrders) }})
                    </button>
                    <button class="tab-btn" onclick="switchActiveTab('accepted', this)">
                        Accepted ({{ count($acceptedOrders) }})
                    </button>
                    <button class="tab-btn" onclick="switchActiveTab('shipped', this)">
                        Shipped ({{ count($shippedOrders) }})
                    </button>
                </div>

                <!-- Tab Panels -->
                <!-- 1. Pending Panel -->
                <div id="tab-pending" class="tab-panel-content">
                    <div class="row">
                        @forelse($pendingOrders as $order)
                            <div class="col-xl-4 col-md-6 col-12 mb-4">
                                <div class="order-card">
                                    <div class="order-card-header">
                                        <div style="display: flex; align-items: center;">
                                            <span style="font-weight: 700; color: #1a202c; font-size: 15px;">
                                                Order #{{ substr($order->order_id, 4) }}
                                            </span>
                                            @if(\Carbon\Carbon::parse($order->created_at)->gt(\Carbon\Carbon::now()->subRealHours(24)))
                                                <span class="pill-badge" style="background-color: #2ecc71; color: #ffffff; margin-left: 8px;">NEW</span>
                                            @endif
                                        </div>
                                        <span style="font-size: 12px; color: #a0aec0;">
                                            {{ \Carbon\Carbon::parse($order->created_at)->isToday() ? 'Today, ' . \Carbon\Carbon::parse($order->created_at)->format('g:i A') : (\Carbon\Carbon::parse($order->created_at)->isYesterday() ? 'Yesterday, ' . \Carbon\Carbon::parse($order->created_at)->format('g:i A') : \Carbon\Carbon::parse($order->created_at)->format('d M, g:i A')) }}
                                        </span>
                                    </div>
                                    <div class="order-card-body">
                                        @if(!empty($order->product_image) && file_exists(public_path('assets/images/products/' . $order->product_image)))
                                            <img src="{{ asset('assets/images/products/' . $order->product_image) }}" style="width: 58px; height: 58px; border-radius: 10px; object-fit: cover;" alt=""/>
                                        @else
                                            <img src="{{ asset('assets/images/products/blouse.jpg') }}" style="width: 58px; height: 58px; border-radius: 10px; object-fit: cover;" alt=""/>
                                        @endif
                                        <div style="flex-grow: 1;">
                                            <div style="font-size: 12.5px; color: #718096;">
                                                {{ $order->total_qty }} item{{ $order->total_qty > 1 ? 's' : '' }}
                                            </div>
                                            <div style="font-weight: 700; color: #02cccd; font-size: 16.5px; margin-top: 2px;">
                                                ₹{{ number_format($order->total_price, 0) }}
                                            </div>
                                        </div>
                                        <div>
                                            @if(strtolower($order->payment_type) === 'cash on delivery')
                                                <span class="pill-badge pill-cod">COD</span>
                                            @else
                                                <span class="pill-badge pill-paid">PAID</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <h6 style="color: #a0aec0; font-weight: 500; margin: 0;">No pending orders available.</h6>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- 2. Accepted Panel -->
                <div id="tab-accepted" class="tab-panel-content" style="display: none;">
                    <div class="row">
                        @forelse($acceptedOrders as $order)
                            <div class="col-xl-4 col-md-6 col-12 mb-4">
                                <div class="order-card">
                                    <div class="order-card-header">
                                        <div style="display: flex; align-items: center;">
                                            <span style="font-weight: 700; color: #1a202c; font-size: 15px;">
                                                Order #{{ substr($order->order_id, 4) }}
                                            </span>
                                            @if(\Carbon\Carbon::parse($order->created_at)->gt(\Carbon\Carbon::now()->subRealHours(24)))
                                                <span class="pill-badge" style="background-color: #2ecc71; color: #ffffff; margin-left: 8px;">NEW</span>
                                            @endif
                                        </div>
                                        <span style="font-size: 12px; color: #a0aec0;">
                                            {{ \Carbon\Carbon::parse($order->created_at)->isToday() ? 'Today, ' . \Carbon\Carbon::parse($order->created_at)->format('g:i A') : (\Carbon\Carbon::parse($order->created_at)->isYesterday() ? 'Yesterday, ' . \Carbon\Carbon::parse($order->created_at)->format('g:i A') : \Carbon\Carbon::parse($order->created_at)->format('d M, g:i A')) }}
                                        </span>
                                    </div>
                                    <div class="order-card-body">
                                        @if(!empty($order->product_image) && file_exists(public_path('assets/images/products/' . $order->product_image)))
                                            <img src="{{ asset('assets/images/products/' . $order->product_image) }}" style="width: 58px; height: 58px; border-radius: 10px; object-fit: cover;" alt=""/>
                                        @else
                                            <img src="{{ asset('assets/images/products/blouse.jpg') }}" style="width: 58px; height: 58px; border-radius: 10px; object-fit: cover;" alt=""/>
                                        @endif
                                        <div style="flex-grow: 1;">
                                            <div style="font-size: 12.5px; color: #718096;">
                                                {{ $order->total_qty }} item{{ $order->total_qty > 1 ? 's' : '' }}
                                            </div>
                                            <div style="font-weight: 700; color: #02cccd; font-size: 16.5px; margin-top: 2px;">
                                                ₹{{ number_format($order->total_price, 0) }}
                                            </div>
                                        </div>
                                        <div>
                                            @if(strtolower($order->payment_type) === 'cash on delivery')
                                                <span class="pill-badge pill-cod">COD</span>
                                            @else
                                                <span class="pill-badge pill-paid">PAID</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <h6 style="color: #a0aec0; font-weight: 500; margin: 0;">No accepted orders available.</h6>
                            </div>
                        @endforelse
                    </div>
                </div>

                <!-- 3. Shipped Panel -->
                <div id="tab-shipped" class="tab-panel-content" style="display: none;">
                    <div class="row">
                        @forelse($shippedOrders as $order)
                            <div class="col-xl-4 col-md-6 col-12 mb-4">
                                <div class="order-card">
                                    <div class="order-card-header">
                                        <div style="display: flex; align-items: center;">
                                            <span style="font-weight: 700; color: #1a202c; font-size: 15px;">
                                                Order #{{ substr($order->order_id, 4) }}
                                            </span>
                                            @if(\Carbon\Carbon::parse($order->created_at)->gt(\Carbon\Carbon::now()->subRealHours(24)))
                                                <span class="pill-badge" style="background-color: #2ecc71; color: #ffffff; margin-left: 8px;">NEW</span>
                                            @endif
                                        </div>
                                        <span style="font-size: 12px; color: #a0aec0;">
                                            {{ \Carbon\Carbon::parse($order->created_at)->isToday() ? 'Today, ' . \Carbon\Carbon::parse($order->created_at)->format('g:i A') : (\Carbon\Carbon::parse($order->created_at)->isYesterday() ? 'Yesterday, ' . \Carbon\Carbon::parse($order->created_at)->format('g:i A') : \Carbon\Carbon::parse($order->created_at)->format('d M, g:i A')) }}
                                        </span>
                                    </div>
                                    <div class="order-card-body">
                                        @if(!empty($order->product_image) && file_exists(public_path('assets/images/products/' . $order->product_image)))
                                            <img src="{{ asset('assets/images/products/' . $order->product_image) }}" style="width: 58px; height: 58px; border-radius: 10px; object-fit: cover;" alt=""/>
                                        @else
                                            <img src="{{ asset('assets/images/products/blouse.jpg') }}" style="width: 58px; height: 58px; border-radius: 10px; object-fit: cover;" alt=""/>
                                        @endif
                                        <div style="flex-grow: 1;">
                                            <div style="font-size: 12.5px; color: #718096;">
                                                {{ $order->total_qty }} item{{ $order->total_qty > 1 ? 's' : '' }}
                                            </div>
                                            <div style="font-weight: 700; color: #02cccd; font-size: 16.5px; margin-top: 2px;">
                                                ₹{{ number_format($order->total_price, 0) }}
                                            </div>
                                        </div>
                                        <div>
                                            @if(strtolower($order->payment_type) === 'cash on delivery')
                                                <span class="pill-badge pill-cod">COD</span>
                                            @else
                                                <span class="pill-badge pill-paid">PAID</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-12 text-center py-5">
                                <h6 style="color: #a0aec0; font-weight: 500; margin: 0;">No shipped orders available.</h6>
                            </div>
                        @endforelse
                    </div>
                </div>

            </div>
        </div>
    </div>

</div>
</div>

@push('scripts')
<script>
    function switchActiveTab(tabName, btnElement) {
        // Hide all tab content
        document.querySelectorAll('.tab-panel-content').forEach(function(el) {
            el.style.display = 'none';
        });
        
        // Deactivate all tab buttons
        document.querySelectorAll('.tab-btn').forEach(function(btn) {
            btn.classList.remove('active');
        });
        
        // Show selected tab content and active tab button
        document.getElementById('tab-' + tabName).style.display = 'block';
        btnElement.classList.add('active');
    }
</script>
@endpush

@endsection