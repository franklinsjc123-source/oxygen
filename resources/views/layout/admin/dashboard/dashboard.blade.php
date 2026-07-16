@extends('layout.auth.master')
@section('contents')



<!-- page-wrapper Start-->
@include('paritials.auth.topmenu');
<!-- Page Header Ends -->

<!-- Page Body Start-->
<div class="page-body-wrapper">
	
	<!-- Page Sidebar Start-->
	@include('paritials.auth.sidemenu');
	<!-- Page Sidebar Ends-->
	
	<!-- Right sidebar Start-->
	
	<!-- Right sidebar Ends-->
	
<div class="page-body">

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-header-left">
                            <h3>Dashboard

                            </h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ol class="breadcrumb pull-right">
                            <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->

        <style>
        /* Employee Card Styles */
        .employee-card {
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

        .employee-profile-banner {
            min-height: 100px;
            background: linear-gradient(135deg, #183543 0%, #0f2430 100%);
            position: relative;
            padding: 20px 24px;
            display: flex;
            align-items: center;
            gap: 16px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.08);
        }

        .employee-avatar-wrapper {
            width: 56px;
            height: 56px;
            flex-shrink: 0;
            position: relative;
        }

        .employee-avatar {
            width: 56px;
            height: 56px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid #ffffff;
            box-shadow: 0 4px 10px rgba(0,0,0,0.15);
        }

        .employee-info-main {
            flex-grow: 1;
            min-width: 0;
            color: #ffffff;
            padding-right: 50px;
        }

        .employee-address-text {
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .employee-name {
            font-size: 20px;
            font-weight: 700;
            color: #ffffff;
            margin: 0;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .employee-role {
            font-size: 12.5px;
            font-weight: 600;
            color: #02cccd;
            margin-bottom: 4px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .employee-address {
            font-size: 13px;
            color: #ffffff;
            margin: 0;
            display: flex;
            align-items: flex-start;
            gap: 4px;
            line-height: 1.35;
        }

        .employee-zone {
            font-size: 13px;
            font-weight: 500;
            color: #ffffff;
            opacity: 0.9;
        }

        .employee-toggle {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            right: 24px;
        }

        .employee-card-bottom {
            padding: 20px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 12px;
            border-top: none;
        }

        .employee-meta-item {
            background: #f8fafc;
            border: 1px solid #edf2f7;
            border-radius: 8px;
            padding: 8px 12px;
            display: flex;
            flex-direction: column;
            gap: 4px;
            min-width: 0;
            transition: all 0.2s ease;
        }

        .employee-meta-item:hover {
            border-color: #cbd5e0;
            background: #ffffff;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.02);
            transform: translateY(-1px);
        }

        .employee-meta-label {
            font-size: 10px;
            font-weight: 700;
            color: #94a3b8;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .employee-meta-value {
            font-size: 14px;
            font-weight: 700;
            color: #1e293b;
            word-break: break-all;
        }

        .employee-rating-stars {
            display: flex;
            gap: 2px;
            color: #f1c40f;
            font-size: 14px;
        }

        /* iOS Toggle Switch Styles */
        .switch-ios {
            position: relative;
            display: inline-block;
            width: 44px;
            height: 24px;
        }

        .switch-ios input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        .slider-ios {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
            border-radius: 24px;
        }

        .slider-ios:before {
            position: absolute;
            content: "";
            height: 18px;
            width: 18px;
            left: 3px;
            bottom: 3px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
            border-radius: 50%;
            box-shadow: 0 2px 4px rgba(0,0,0,0.2);
        }

        input:checked + .slider-ios {
            background-color: #34c759;
        }

        input:focus + .slider-ios {
            box-shadow: 0 0 1px #34c759;
        }

        input:checked + .slider-ios:before {
            -webkit-transform: translateX(20px);
            -ms-transform: translateX(20px);
            transform: translateX(20px);
        }

        /* Metrics Cards Grid */
        .metrics-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
            height: 100%;
        }

        .metric-card-custom {
            border-radius: 20px !important;
            padding: 20px !important;
            min-height: 120px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1) !important;
            cursor: pointer;
            overflow: hidden;
            border: none !important;
        }

        .metric-card-custom:hover {
            transform: translateY(-6px) scale(1.01) !important;
        }

        .metric-card-label {
            font-size: 11px !important;
            text-transform: uppercase !important;
            letter-spacing: 1px !important;
            opacity: 0.85 !important;
            font-weight: 700 !important;
            line-height: 1.3;
        }

        .metric-card-value {
            font-size: 32px !important;
            font-weight: 800 !important;
            line-height: 1.1 !important;
            letter-spacing: -0.5px !important;
            text-shadow: 0 2px 4px rgba(0, 0, 0, 0.08);
        }

        .metric-card-custom i {
            transition: all 0.3s ease;
        }

        .metric-card-custom:hover i {
            transform: scale(1.2) rotate(-5deg) !important;
            opacity: 0.35 !important;
        }

        .card-style-val {
            background: linear-gradient(135deg, #f472b6 0%, #db2777 100%) !important;
            color: #ffffff !important;
            box-shadow: 0 10px 20px -5px rgba(219, 39, 119, 0.35) !important;
        }
        .card-style-val:hover {
            box-shadow: 0 20px 30px -5px rgba(219, 39, 119, 0.5) !important;
        }
        .card-style-val .metric-card-label {
            color: #ffffff !important;
        }
        .card-style-val .metric-card-value {
            color: #ffffff !important;
        }

        .card-style-orders {
            background: linear-gradient(135deg, #60a5fa 0%, #2563eb 100%) !important;
            color: #ffffff !important;
            box-shadow: 0 10px 20px -5px rgba(37, 99, 235, 0.35) !important;
        }
        .card-style-orders:hover {
            box-shadow: 0 20px 30px -5px rgba(37, 99, 235, 0.5) !important;
        }

        .card-style-products {
            background: linear-gradient(135deg, #34d399 0%, #059669 100%) !important;
            color: #ffffff !important;
            box-shadow: 0 10px 20px -5px rgba(5, 150, 105, 0.35) !important;
        }
        .card-style-products:hover {
            box-shadow: 0 20px 30px -5px rgba(5, 150, 105, 0.5) !important;
        }

        .card-style-customers {
            background: linear-gradient(135deg, #fb7185 0%, #e11d48 100%) !important;
            color: #ffffff !important;
            box-shadow: 0 10px 20px -5px rgba(225, 29, 72, 0.35) !important;
        }
        .card-style-customers:hover {
            box-shadow: 0 20px 30px -5px rgba(225, 29, 72, 0.5) !important;
        }

        .card-style-vendors {
            background: linear-gradient(135deg, #fbbf24 0%, #d97706 100%) !important;
            color: #ffffff !important;
            box-shadow: 0 10px 20px -5px rgba(217, 119, 6, 0.35) !important;
        }
        .card-style-vendors:hover {
            box-shadow: 0 20px 30px -5px rgba(217, 119, 6, 0.5) !important;
        }

        .card-style-viewers {
            background: linear-gradient(135deg, #818cf8 0%, #4f46e5 100%) !important;
            color: #ffffff !important;
            box-shadow: 0 10px 20px -5px rgba(99, 102, 241, 0.35) !important;
        }
        .card-style-viewers:hover {
            box-shadow: 0 20px 30px -5px rgba(99, 102, 241, 0.5) !important;
        }

        /* Activity Tracker Section */
        .activity-tracker-container {
            background: #ffffff;
            border-radius: 20px;
            padding: 24px;
            border: none;
            box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.02);
        }

        .activity-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 24px;
            flex-wrap: wrap;
            gap: 16px;
        }

        .activity-title {
            font-size: 18px;
            font-weight: 700;
            color: #1e293b;
            margin: 0;
        }

        .activity-nav-pills {
            display: flex;
            flex-wrap: wrap;
            gap: 8px;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .activity-nav-link {
            padding: 6px 16px;
            border-radius: 8px;
            font-size: 12px;
            font-weight: 600;
            background-color: #edf2f7;
            color: #718096;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .activity-nav-link:hover {
            background-color: #e2e8f0;
            color: #2d3748;
        }

        .activity-nav-link.active {
            background-color: #e2e8f0;
            color: #2d3748;
            box-shadow: none;
        }

        .activity-grid {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 16px;
        }

        .activity-card {
            background: #f8fafc;
            border-radius: 12px;
            border: 1px solid rgba(0, 0, 0, 0.04);
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.01);
            overflow: hidden;
            position: relative;
            padding: 16px;
            padding-left: 24px;
            display: flex;
            flex-direction: column;
            gap: 8px;
        }

        .activity-card::before {
            content: '';
            position: absolute;
            left: 0;
            top: 0;
            bottom: 0;
            width: 6px;
            background-color: var(--indicator-color, #10b981);
        }

        .activity-card-row1 {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .activity-staff-name {
            font-size: 14px;
            font-weight: 700;
            color: #1e293b;
        }

        .activity-time {
            font-size: 12px;
            font-weight: 600;
        }

        .activity-card-row2 {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .activity-shop-name {
            font-size: 13px;
            font-style: italic;
            color: #475569;
        }

        .activity-status-label {
            font-size: 12px;
            font-weight: 500;
            color: #475569;
        }

        .activity-card-row3 {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .activity-area {
            font-size: 12px;
            color: #64748b;
        }

        .activity-percentage-pill {
            font-size: 11px;
            font-weight: 700;
            padding: 3px 8px;
            border-radius: 12px;
        }

        .activity-address {
            font-size: 12px;
            color: #64748b;
            line-height: 1.4;
            border-top: 1px solid #e2e8f0;
            padding-top: 8px;
            margin-top: 4px;
        }

        @media (max-width: 1199px) {
            .metrics-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 991px) {
            .activity-grid {
                grid-template-columns: repeat(2, 1fr);
            }
        }

        @media (max-width: 575px) {
            .employee-profile-banner {
                padding: 16px !important;
                gap: 12px !important;
            }
            .employee-info-main {
                padding-right: 0 !important;
            }
            .employee-name {
                white-space: normal !important;
                word-break: break-word !important;
            }
            .employee-role {
                white-space: normal !important;
                overflow: visible !important;
                text-overflow: clip !important;
            }
            .employee-address-text {
                display: block !important;
                overflow: visible !important;
                -webkit-line-clamp: unset !important;
                text-overflow: clip !important;
            }
            .metrics-grid {
                grid-template-columns: repeat(2, 1fr);
                gap: 12px;
            }
            .activity-grid {
                grid-template-columns: 1fr;
            }
            .employee-card-bottom {
                grid-template-columns: 1fr;
            }
            .activity-tracker-container {
                padding: 16px !important;
            }
            .activity-header {
                flex-direction: column !important;
                align-items: stretch !important;
                gap: 12px !important;
                margin-bottom: 16px !important;
            }
            .activity-header > div.d-flex {
                width: 100% !important;
            }
            .activity-nav-pills {
                width: 100% !important;
                display: flex !important;
                flex-wrap: nowrap !important;
                gap: 4px !important;
                overflow: hidden !important;
            }
            .activity-nav-pills li {
                flex: 1 !important;
                display: block !important;
            }
            .activity-nav-pills li button {
                width: 100% !important;
                text-align: center !important;
                padding: 6px 2px !important;
                font-size: 10.5px !important;
                white-space: nowrap !important;
                letter-spacing: -0.2px !important;
            }
            .chart-sub-pill-container {
                width: 100% !important;
                display: flex !important;
                gap: 4px !important;
                border-radius: 8px !important;
            }
            .chart-sub-pill {
                flex: 1 !important;
                text-align: center !important;
                padding: 6px 4px !important;
                font-size: 11px !important;
                border-radius: 6px !important;
                white-space: nowrap !important;
            }
            .activity-tracker-container .view-all-link {
                display: none !important;
            }
            .mobile-view-all {
                display: block !important;
                margin-top: 16px;
            }
        }

        .mobile-view-all {
            display: none;
        }
        .view-all-mobile-btn {
            display: inline-block;
            width: 100%;
            text-align: center;
            padding: 10px 16px;
            background-color: #f8fafc;
            border: 1px solid #e2e8f0;
            border-radius: 12px;
            color: #475569;
            font-size: 13px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.2s ease;
        }
        .view-all-mobile-btn:hover {
            background-color: #edf2f7;
            color: #1e293b;
        }

        /* Dynamic Chart Custom Styles */
        .chart-sub-pill {
            padding: 6px 16px !important;
            font-size: 12px !important;
            border-radius: 8px !important;
            background: #edf2f7 !important;
            color: #718096 !important;
            border: none !important;
            font-weight: 600 !important;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .chart-sub-pill.active {
            background: #e2e8f0 !important;
            color: #2d3748 !important;
            box-shadow: none !important;
        }

        /* Period filter bar styling */
        .period-btn {
            color: #64748b;
            text-decoration: none;
        }
        .period-btn.active {
            background-color: #183543 !important;
            color: #ffffff !important;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);
        }
        .period-btn:hover:not(.active) {
            color: #183543;
            background-color: rgba(24, 53, 67, 0.05);
        }

        /* Filter bar date inputs layout */
        .custom-date-inputs {
            display: flex !important;
            align-items: center !important;
            gap: 8px !important;
        }
        .custom-date-buttons {
            display: flex !important;
            gap: 8px !important;
        }

        /* Responsive filter bar for small screens */
        @media (max-width: 575.98px) {
            .filter-bar {
                flex-direction: column !important;
                align-items: stretch !important;
                padding: 16px !important;
            }
            .filter-controls {
                flex-direction: column !important;
                align-items: stretch !important;
                width: 100% !important;
                gap: 12px !important;
            }
            .period-selector {
                width: 100% !important;
            }
            .period-btn {
                flex: 1 !important;
                text-align: center !important;
                padding: 6px 0 !important;
            }
            #customDateFilterForm {
                width: 100% !important;
                flex-direction: column !important;
                align-items: stretch !important;
                gap: 10px !important;
            }
            .custom-date-inputs {
                width: 100% !important;
                display: flex !important;
                align-items: center !important;
                justify-content: space-between !important;
                gap: 8px !important;
            }
            .custom-date-inputs input {
                flex: 1 !important;
                width: 100% !important;
            }
            .custom-date-buttons {
                width: 100% !important;
                display: flex !important;
                gap: 8px !important;
            }
            .custom-date-buttons button {
                flex: 1 !important;
            }
        }
        </style>

        <!-- Container-fluid starts (Top Stats & Employee Card) -->
        <div class="container-fluid">
            <div class="row">
                <!-- Left Column: Employee/Staff Card -->
                <div class="col-xl-5 col-lg-12 mb-4">
                    <div class="employee-card">
                        <!-- Modern Header Banner with Employee Image, Name and Address -->
                        <div class="employee-profile-banner">
                            <div style="display: flex; align-items: center; gap: 12px; flex-grow: 1; min-width: 0; width: 100%;">
                                <!-- Profile Image -->
                                <div class="employee-avatar-wrapper">
                                    @if($staffDetails->profileimage && $staffDetails->profileimage != '-' && file_exists(public_path('assets/images/staffcreate/' . $staffDetails->profileimage)))
                                        <img class="employee-avatar" src="{{ asset('assets/images/staffcreate/' . $staffDetails->profileimage) }}" alt="Staff Photo">
                                    @elseif($staffDetails->profileimage && $staffDetails->profileimage != '-' && file_exists(public_path('assets/images/dashboard/staff/' . $staffDetails->profileimage)))
                                        <img class="employee-avatar" src="{{ asset('assets/images/dashboard/staff/' . $staffDetails->profileimage) }}" alt="Staff Photo">
                                    @else
                                        <img class="employee-avatar" src="{{ asset('assets/images/dashboard/man.jpeg') }}" alt="Staff Photo">
                                    @endif
                                </div>
                                
                                <!-- Employee Info next to the image -->
                                <div class="employee-info-main">
                                    <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
                                        <h4 class="employee-name" title="{{ $staffDetails->fullname }}">{{ $staffDetails->fullname }}</h4>
                                    </div>
                                    <div class="employee-role text-truncate">
                                        {{ $staffDetails->designation }} &middot; Zone - {{ $staffDetails->zone_id ?? 'N/A' }}
                                    </div>
                                    <p class="employee-address" title="{{ $staffDetails->curr_addr ?? 'Address not specified' }}">
                                        <i class="fa fa-map-marker" style="color: #ffffff; margin-top: 2px; font-size: 12px; width: 12px; text-align: center; flex-shrink: 0;"></i>
                                        <span class="employee-address-text">
                                            {{ $staffDetails->curr_addr ?? 'Address not specified' }}
                                        </span>
                                    </p>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Details and Info grid at bottom -->
                        <div class="employee-card-bottom">
                            <div class="employee-meta-item">
                                <span class="employee-meta-label">EMP ID</span>
                                <span class="employee-meta-value">{{ $staffDetails->employee_id }}</span>
                            </div>
                            <div class="employee-meta-item">
                                <span class="employee-meta-label">Email Address</span>
                                <span class="employee-meta-value text-truncate" title="{{ $staffDetails->email }}">{{ $staffDetails->email }}</span>
                            </div>
                            <div class="employee-meta-item">
                                <span class="employee-meta-label">Rating</span>
                                <div class="employee-rating-stars">
                                    @for($i = 0; $i < 5; $i++)
                                        <i class="fa fa-star"></i>
                                    @endfor
                                </div>
                            </div>
                            <div class="employee-meta-item">
                                <span class="employee-meta-label">Contact Details</span>
                                <span class="employee-meta-value">{{ $staffDetails->mobileno }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Right Column: 6 Metrics Cards Grid -->
                <div class="col-xl-7 col-lg-12 mb-4">
                    <div class="metrics-grid">
                        <!-- Card 1: Orders -->
                        <div class="metric-card-custom card-style-orders" style="position: relative;">
                            <div>
                                <div class="metric-card-label">Orders</div>
                                <div class="metric-card-value" id="metricOrderCount">{{ $orderCount ?? 0 }}</div>
                            </div>
                            <i class="fa fa-shopping-bag" style="position: absolute; right: 20px; bottom: 20px; font-size: 36px; opacity: 0.18; color: #ffffff;"></i>
                        </div>
                        
                        <!-- Card 2: Products -->
                        <div class="metric-card-custom card-style-products" style="position: relative;">
                            <div>
                                <div class="metric-card-label">Products</div>
                                <div class="metric-card-value" id="metricProductCount">{{ $productCount ?? 0 }}</div>
                            </div>
                            <i class="fa fa-cubes" style="position: absolute; right: 20px; bottom: 20px; font-size: 36px; opacity: 0.18; color: #ffffff;"></i>
                        </div>
                        
                        <!-- Card 3: Customers -->
                        <div class="metric-card-custom card-style-customers" style="position: relative;">
                            <div>
                                <div class="metric-card-label">Customers</div>
                                <div class="metric-card-value" id="metricCustomerCount">{{ $customerCount ?? 0 }}</div>
                            </div>
                            <i class="fa fa-users" style="position: absolute; right: 20px; bottom: 20px; font-size: 36px; opacity: 0.18; color: #ffffff;"></i>
                        </div>
                        
                        <!-- Card 4: Vendors -->
                        <div class="metric-card-custom card-style-vendors" style="position: relative;">
                            <div>
                                <div class="metric-card-label">Vendors</div>
                                <div class="metric-card-value" id="metricVendorCount">{{ $vendorCount ?? 0 }}</div>
                            </div>
                            <i class="fa fa-store" style="position: absolute; right: 20px; bottom: 20px; font-size: 36px; opacity: 0.18; color: #ffffff;"></i>
                        </div>
                        
                        <!-- Card 5: Viewers -->
                        <div class="metric-card-custom card-style-viewers" style="position: relative;">
                            <div>
                                <div class="metric-card-label">Viewers</div>
                                <div class="metric-card-value" id="metricViewerCount">{{ $totalViews ?? 0 }}</div>
                            </div>
                            <i class="fa fa-eye" style="position: absolute; right: 20px; bottom: 20px; font-size: 36px; opacity: 0.18; color: #ffffff;"></i>
                        </div>

                        <!-- Card 6: Total Order Amount -->
                        <div class="metric-card-custom card-style-val" style="position: relative;">
                            <div>
                                <div class="metric-card-label">Total Order Amount</div>
                                <div class="metric-card-value" id="metricTotalOrderAmountValue">₹{{ number_format(($totalOrderAmountSum ?? 0) / 1000, 1) }}K</div>
                            </div>
                            <i class="fa fa-inr" style="position: absolute; right: 20px; bottom: 20px; font-size: 36px; opacity: 0.18; color: #ffffff;"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Activity Tracker Section -->
        <div class="container-fluid mt-4">
            <div class="activity-tracker-container">
                <div class="activity-header">
                    <h4 class="activity-title">Activity Tracker</h4>
                    
                    <div class="d-flex align-items-center gap-3">
                        <ul class="activity-nav-pills">
                            <li><button type="button" class="activity-nav-link active" onclick="switchActivityTab(event, 'tab-today')">Today</button></li>
                            <li><button type="button" class="activity-nav-link" onclick="switchActivityTab(event, 'tab-upcoming')">Upcoming</button></li>
                            <li><button type="button" class="activity-nav-link" onclick="switchActivityTab(event, 'tab-pastdue')">Past Due</button></li>
                        </ul>
                        <a href="{{ url('admin/activity_trackers') }}" class="view-all-link" style="color: #64748b; font-size: 13px; font-weight: 600; text-decoration: none; margin-left: 15px;">View All &gt;&gt;</a>
                    </div>
                </div>
                
                <!-- Tab Panels -->
                <div id="tab-today" class="activity-tab-content">
                    <div class="activity-grid">
                        @forelse($todayActivities as $index => $act)
                            @include('layout.admin.dashboard.activity_card', ['act' => $act, 'index' => $index])
                        @empty
                            <div class="col-12 text-center py-5 text-muted w-100" style="grid-column: 1 / -1;">
                                <i class="fa fa-calendar-check-o fa-2x mb-3 text-secondary"></i>
                                <p class="mb-0">No follow-ups scheduled for today.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
                
                <div id="tab-upcoming" class="activity-tab-content" style="display: none;">
                    <div class="activity-grid">
                        @forelse($upcomingActivities as $index => $act)
                            @include('layout.admin.dashboard.activity_card', ['act' => $act, 'index' => $index])
                        @empty
                            <div class="col-12 text-center py-5 text-muted w-100" style="grid-column: 1 / -1;">
                                <i class="fa fa-calendar-plus-o fa-2x mb-3 text-secondary"></i>
                                <p class="mb-0">No upcoming follow-ups scheduled.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
                
                <div id="tab-pastdue" class="activity-tab-content" style="display: none;">
                    <div class="activity-grid">
                        @forelse($pastDueActivities as $index => $act)
                            @include('layout.admin.dashboard.activity_card', ['act' => $act, 'index' => $index])
                        @empty
                            <div class="col-12 text-center py-5 text-muted w-100" style="grid-column: 1 / -1;">
                                <i class="fa fa-calendar-times-o fa-2x mb-3 text-secondary"></i>
                                <p class="mb-0">No past due follow-ups.</p>
                            </div>
                        @endforelse
                    </div>
                </div>
                
                <!-- Mobile View All Button -->
                <div class="mobile-view-all">
                    <a href="{{ url('admin/activity_trackers') }}" class="view-all-mobile-btn">View All &gt;&gt;</a>
                </div>
            </div>
        </div>

        <!-- Period Filter Bar -->
        <div class="container-fluid mt-4 mb-4">
            <div class="filter-bar d-flex justify-content-between align-items-center flex-wrap gap-3" style="background: #ffffff; padding: 16px 24px; border-radius: 16px; border: 1px solid #edf2f7; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.02);">
                <div class="filter-title d-flex align-items-center gap-3">
                    <div style="background-color: rgba(24, 53, 67, 0.08); width: 38px; height: 38px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                        <i class="fa fa-calendar" style="color: #183543; font-size: 16px;"></i>
                    </div>
                    <div>
                        <span style="font-weight: 700; color: #1a202c; font-size: 15px; display: block;">Period Filter</span>
                        <span id="filterDateText" style="font-size: 11px; color: #718096; font-weight: 500;">
                            @if($startDate && $endDate)
                                Showing data from {{ \Carbon\Carbon::parse($startDate)->format('M d, Y') }} to {{ \Carbon\Carbon::parse($endDate)->format('M d, Y') }}
                            @else
                                Showing cumulative data
                            @endif
                        </span>
                    </div>
                </div>
                <div class="filter-controls d-flex align-items-center gap-3 flex-wrap">
                    <!-- Employee Filter Dropdown -->
                    <div class="employee-filter-container d-flex align-items-center gap-2">
                        <div style="background-color: rgba(24, 53, 67, 0.08); width: 32px; height: 32px; border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                            <i class="fa fa-user" style="color: #183543; font-size: 14px;"></i>
                        </div>
                        <select id="filterStaffId" class="form-control form-control-sm" style="border-color: #cbd5e1; border-radius: 8px; font-size: 12px; font-weight: 600; color: #334155; width: 180px; height: 32px; box-shadow: 0 1px 2px 0 rgba(0,0,0,0.05); cursor: pointer; display: inline-block; vertical-align: middle;" onchange="applyStaffFilter(this.value)">
                            <option value="">All Employees</option>
                            @foreach($subStaffList as $staff)
                                <option value="{{ $staff->id }}" {{ (isset($selectedStaffId) && $selectedStaffId == $staff->id) ? 'selected' : '' }}>{{ $staff->fullname }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="period-selector d-flex p-1" style="border-radius: 30px; background-color: #f1f5f9; border: 1px solid #e2e8f0;">
                        <button type="button" class="period-btn {{ $period === 'today' ? 'active' : '' }}" onclick="applyPeriodFilter('today', this)" style="padding: 6px 18px; border-radius: 20px; font-size: 12px; font-weight: 600; text-decoration: none; transition: all 0.2s; display: inline-block; text-align: center; border: none; cursor: pointer;">Today</button>
                        <button type="button" class="period-btn {{ $period === 'week' ? 'active' : '' }}" onclick="applyPeriodFilter('week', this)" style="padding: 6px 18px; border-radius: 20px; font-size: 12px; font-weight: 600; text-decoration: none; transition: all 0.2s; display: inline-block; text-align: center; border: none; cursor: pointer;">Week</button>
                        <button type="button" class="period-btn {{ $period === 'month' ? 'active' : '' }}" onclick="applyPeriodFilter('month', this)" style="padding: 6px 18px; border-radius: 20px; font-size: 12px; font-weight: 600; text-decoration: none; transition: all 0.2s; display: inline-block; text-align: center; border: none; cursor: pointer;">Month</button>
                    </div>
                    
                    <form id="customDateFilterForm" class="d-flex align-items-center gap-2 m-0 flex-wrap" onsubmit="return applyCustomDateFilter(event)">
                        <div class="custom-date-inputs">
                            <input type="date" id="filterStartDate" class="form-control form-control-sm" value="{{ $startDate }}" style="border-color: #cbd5e1; border-radius: 8px; font-size: 12px; font-weight: 500; color: #334155; width: 135px; height: 32px; box-shadow: 0 1px 2px 0 rgba(0,0,0,0.05);">
                            <span style="font-size: 12px; color: #64748b; font-weight: 600; padding: 0 4px;">to</span>
                            <input type="date" id="filterEndDate" class="form-control form-control-sm" value="{{ $endDate }}" style="border-color: #cbd5e1; border-radius: 8px; font-size: 12px; font-weight: 500; color: #334155; width: 135px; height: 32px; box-shadow: 0 1px 2px 0 rgba(0,0,0,0.05);">
                        </div>
                        <div class="custom-date-buttons">
                            <button type="submit" id="applyFilterBtn" class="btn btn-sm text-white" style="background-color: #183543; border-radius: 8px; font-size: 12px; font-weight: 700; padding: 0 16px; border: none; height: 32px; transition: all 0.2s; box-shadow: 0 4px 6px -1px rgba(24, 53, 67, 0.15); text-transform: uppercase; letter-spacing: 0.5px;">APPLY</button>
                            <button type="button" class="btn btn-sm btn-light d-inline-flex align-items-center justify-content-center" onclick="applyPeriodFilter('month', document.querySelector('.period-btn:last-child'))" style="border-radius: 8px; font-size: 12px; font-weight: 700; padding: 0 12px; border: 1px solid #cbd5e1; height: 32px; background-color: #f8fafc; text-transform: uppercase; letter-spacing: 0.5px;">CLEAR</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="container-fluid mt-4">
            <div class="row">
                <!-- Left Card: Target vs Client Sales -->
                <div class="col-xl-8 col-lg-8 col-md-12 mb-4">
                    <div class="activity-tracker-container" style="height: 100%; display: flex; flex-direction: column; justify-content: space-between;">
                        <div class="activity-header d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                            <!-- Left Sub-Tabs -->
                            <div class="d-flex align-items-center gap-1">
                                <ul class="activity-nav-pills" id="double-left-tabs">
                                    <li><button type="button" class="activity-nav-link" onclick="switchDoubleLeftTab(this, 'target')">Revenue</button></li>
                                    <li><button type="button" class="activity-nav-link active" onclick="switchDoubleLeftTab(this, 'client')">Client</button></li>
                                </ul>
                            </div>
                            <div class="d-flex align-items-center gap-1">
                                <div class="chart-sub-pill-container" id="double-right-tabs-container" style="background-color: #f1f5f9; padding: 4px; border-radius: 20px; display: flex; gap: 2px;">
                                    <button type="button" class="chart-sub-pill active" id="btn-period" onclick="switchDoubleRightTab(this, 'period')">Period</button>
                                    <button type="button" class="chart-sub-pill" id="btn-location" onclick="switchDoubleRightTab(this, 'location')">Location</button>
                                </div>
                            </div>
                        </div>
                        <h5 style="margin: 0 0 10px 0; font-size: 16px; font-weight: 600; color: #3498db; text-transform: none; letter-spacing: 0;" id="double-chart-title">Client vs. Revenue</h5>
                        <div style="flex-grow: 1; min-height: 300px; position: relative;">
                             <canvas id="doubleLineChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Right Card: Gauge Ratio Analytics -->
                <div class="col-xl-4 col-lg-4 col-md-12 mb-4">
                    <div class="activity-tracker-container" style="height: 100%; display: flex; flex-direction: column; justify-content: space-between;">
                        <div class="activity-header d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                            <!-- Left Sub-Tabs -->
                            <div class="d-flex align-items-center gap-1">
                                <ul class="activity-nav-pills" id="gauge-tabs">
                                    <li><button type="button" class="activity-nav-link active" onclick="switchGaugeTab(this, 'client')">Clients</button></li>
                                    <li><button type="button" class="activity-nav-link" onclick="switchGaugeTab(this, 'prospect')">Prospects</button></li>
                                    <li><button type="button" class="activity-nav-link" onclick="switchGaugeTab(this, 'loyal')">Loyal</button></li>
                                    <li><button type="button" class="activity-nav-link" onclick="switchGaugeTab(this, 'auction')">Auction</button></li>
                                </ul>
                            </div>
                        </div>
                        <div style="flex-grow: 1; display: flex; flex-direction: column; align-items: center; justify-content: center; min-height: 300px;">
                            <!-- Gauge Canvas Container -->
                            <div style="width: 240px; height: 120px; position: relative; margin-bottom: 20px;">
                                <canvas id="gaugeChart" style="width: 240px; height: 120px;"></canvas>
                                <div style="position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); text-align: center;">
                                    <strong id="gauge-rate-text" style="font-size: 28px; font-weight: 800; color: #e74c3c; line-height: 1;">0%</strong>
                                    <span style="font-size: 11px; font-weight: 700; color: #a0aec0; text-transform: uppercase; display: block;">Rate</span>
                                </div>
                            </div>
                            
                            <!-- Stats Grid -->
                            <div style="width: 100%; border-top: 1px solid #f1f5f9; padding-top: 15px; display: flex; justify-content: space-around; text-align: center;">
                                <div>
                                    <span id="gauge-stat1-label" style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; display: block;">Stat 1</span>
                                    <strong id="gauge-stat1-value" style="font-size: 20px; color: #1e293b; font-weight: 800;">0</strong>
                                </div>
                                <div style="border-left: 1px solid #e2e8f0; height: 40px;"></div>
                                <div>
                                    <span id="gauge-stat2-label" style="font-size: 11px; font-weight: 700; color: #64748b; text-transform: uppercase; display: block;">Stat 2</span>
                                    <strong id="gauge-stat2-value" style="font-size: 20px; color: #1e293b; font-weight: 800;">0</strong>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Analytics & Interactive Charts Section -->
        <div class="container-fluid mt-4">
            <div class="row">
                <!-- Left Card: Sales Performance Analytics -->
                <div class="col-xl-8 col-lg-8 col-md-12 mb-4">
                    <div class="activity-tracker-container" style="height: 100%; display: flex; flex-direction: column; justify-content: space-between;">
                        <div class="activity-header d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                            <!-- Left Sub-Tabs -->
                            <div class="d-flex align-items-center gap-1">
                                <ul class="activity-nav-pills" id="perf-left-tabs">
                                    <li><button type="button" class="activity-nav-link active" onclick="switchPerformanceLeftTab(this, 'employee')">Employee</button></li>
                                    <li><button type="button" class="activity-nav-link" onclick="switchPerformanceLeftTab(this, 'vendor')">Vendor</button></li>
                                    <li><button type="button" class="activity-nav-link" onclick="switchPerformanceLeftTab(this, 'location')">Location</button></li>
                                    <li><button type="button" class="activity-nav-link" onclick="switchPerformanceLeftTab(this, 'customer')">Customer</button></li>
                                </ul>
                            </div>
                            <!-- Right Sub-Tabs -->
                            <div class="d-flex align-items-center gap-1">
                                <div class="chart-sub-pill-container" style="background-color: #f1f5f9; padding: 4px; border-radius: 20px; display: flex; gap: 2px;">
                                    <button type="button" class="chart-sub-pill active" onclick="switchPerformanceRightTab(this, 'revenue')">Revenue</button>
                                    <button type="button" class="chart-sub-pill" onclick="switchPerformanceRightTab(this, 'auction')">Auction</button>
                                </div>
                            </div>
                        </div>
                        <div style="flex-grow: 1; min-height: 320px; position: relative;">
                            <canvas id="performanceChart"></canvas>
                        </div>
                    </div>
                </div>

                <!-- Right Card: Prospect & Activity Analytics -->
                <div class="col-xl-4 col-lg-4 col-md-12 mb-4">
                    <div class="activity-tracker-container" style="height: 100%; display: flex; flex-direction: column; justify-content: space-between;">
                        <div class="activity-header d-flex justify-content-between align-items-center flex-wrap gap-2 mb-3">
                            <!-- Left Sub-Tabs -->
                            <div class="d-flex align-items-center gap-1">
                                <ul class="activity-nav-pills" id="prospect-tabs">
                                    <li><button type="button" class="activity-nav-link active" onclick="switchProspectTab(this, 'pipeline')">Pipeline</button></li>
                                    <li><button type="button" class="activity-nav-link" onclick="switchProspectTab(this, 'win')">Win %</button></li>
                                    <li><button type="button" class="activity-nav-link" onclick="switchProspectTab(this, 'reference')">Reference</button></li>
                                </ul>
                            </div>
                            <!-- Prospects Total Badge -->
                            <div class="d-flex align-items-center">
                                <div style="background-color: #f8fafc; border: 1px solid #e2e8f0; padding: 6px 16px; border-radius: 8px; text-align: center; display: flex; flex-direction: column; align-items: center; justify-content: center;">
                                    <span style="font-size: 10px; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px; margin-bottom: 2px;">Prospects</span>
                                    <strong id="prospects-badge-count" style="font-size: 18px; color: #1e293b; font-weight: 800; line-height: 1;">0</strong>
                                </div>
                            </div>
                        </div>
                        <div style="flex-grow: 1; min-height: 320px; position: relative;">
                            <canvas id="prospectsChart"></canvas>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <!-- ================= NEW WIDGETS ROW 2 ================= -->
        <div class="container-fluid mt-4 mb-4">
            <div class="row">
                <!-- Left: Transaction Table -->
                <div class="col-lg-8 col-md-12 mb-4">
                    <div class="card" style="border-radius: 20px; border: none; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.02); height: 100%;">
                        <div class="card-header" style="background-color: transparent; border: none; padding: 24px 24px 12px 24px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
                            <div style="display: flex; align-items: center; gap: 10px;">
                                <h4 style="font-weight: 700; color: #1a202c; margin: 0; font-size: 18px;">Transaction</h4>
                                <a href="{{ route('transaction') }}" style="font-size: 12.5px; font-weight: 600; color: #5c67f2; text-decoration: none;">See History</a>
                            </div>
                            <!-- Transaction Filter Tabs -->
                            <div style="display: flex; gap: 16px; align-items: center;">
                                <span class="tx-tab active" onclick="filterTransactions('All', this)" style="cursor: pointer; font-size: 12px; font-weight: 700; color: #5c67f2; border-bottom: 2px solid #5c67f2; padding-bottom: 4px; transition: all 0.2s;">All</span>
                                <span class="tx-tab" onclick="filterTransactions('Paid', this)" style="cursor: pointer; font-size: 12px; font-weight: 600; color: #a0aec0; padding-bottom: 4px; transition: all 0.2s;">Paid</span>
                                <span class="tx-tab" onclick="filterTransactions('Pending', this)" style="cursor: pointer; font-size: 12px; font-weight: 600; color: #a0aec0; padding-bottom: 4px; transition: all 0.2s;">Pending</span>
                            </div>
                        </div>
                        <div class="card-body" style="padding: 0 24px 24px 24px;">
                            <div class="table-responsive">
                                <table class="table table-borderless align-middle" style="margin: 0;">
                                    <thead>
                                        <tr style="border-bottom: 1px solid #edf2f7;">
                                            <th style="font-size: 11px; font-weight: 600; color: #ffffff; text-transform: uppercase; padding: 12px 8px;">Order No.</th>
                                            <th style="font-size: 11px; font-weight: 600; color: #ffffff; text-transform: uppercase; padding: 12px 8px;">Date</th>
                                            <th style="font-size: 11px; font-weight: 600; color: #ffffff; text-transform: uppercase; padding: 12px 8px;">Customer</th>
                                            <th style="font-size: 11px; font-weight: 600; color: #ffffff; text-transform: uppercase; padding: 12px 8px;">Location</th>
                                            <th style="font-size: 11px; font-weight: 600; color: #ffffff; text-transform: uppercase; padding: 12px 8px;">Amount</th>
                                            <th style="font-size: 11px; font-weight: 600; color: #ffffff; text-transform: uppercase; padding: 12px 8px;">Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($transactionsList as $tx)
                                            <tr class="tx-row" data-status="{{ $tx['status'] }}" style="border-bottom: 1px solid #f7fafc; transition: all 0.2s;">
                                                <td style="font-size: 13.5px; font-weight: 700; color: #2d3748; padding: 16px 8px;">{{ $tx['order_no'] }}</td>
                                                <td style="font-size: 13px; color: #718096; font-weight: 500; padding: 16px 8px;">{{ $tx['date'] }}</td>
                                                <td style="padding: 16px 8px;">
                                                    <div style="display: flex; align-items: center; gap: 10px;">
                                                        @php
                                                            $colors = ['#5c67f2', '#e67e22', '#2ecc71', '#e74c3c', '#9b59b6', '#00cec9'];
                                                            $bg = $colors[abs(crc32($tx['customer'])) % count($colors)];
                                                        @endphp
                                                        <div style="width: 32px; height: 32px; border-radius: 50%; background-color: {{ $bg }}20; color: {{ $bg }}; display: flex; align-items: center; justify-content: center; font-size: 12px; font-weight: 700;">
                                                            {{ $tx['initials'] }}
                                                        </div>
                                                        <span style="font-size: 13.5px; font-weight: 600; color: #2d3748;">{{ $tx['customer'] }}</span>
                                                    </div>
                                                </td>
                                                <td style="font-size: 13px; color: #718096; font-weight: 600; padding: 16px 8px;">{{ $tx['location'] }}</td>
                                                <td style="font-size: 13.5px; font-weight: 700; color: #2d3748; padding: 16px 8px;">{{ $tx['amount'] }}</td>
                                                <td style="padding: 16px 8px;">
                                                    <span style="display: inline-flex; align-items: center; gap: 5px; font-size: 12px; font-weight: 600; color: {{ $tx['status'] === 'Paid' ? '#2ecc71' : '#a0aec0' }};">
                                                        <span style="width: 6px; height: 6px; border-radius: 50%; background-color: {{ $tx['status'] === 'Paid' ? '#2ecc71' : '#a0aec0' }}; display: inline-block;"></span>
                                                        {{ $tx['status'] }}
                                                    </span>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="6" style="text-align: center; padding: 40px; color: #a0aec0; font-size: 14px; font-weight: 500;">
                                                    <div style="margin-bottom: 8px;"><i class="fa fa-receipt" style="font-size: 24px; color: #cbd5e1;"></i></div>
                                                    No transactions found
                                                </td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right: Recent Activities -->
                <div class="col-lg-4 col-md-12 mb-4">
                    <div class="card" style="border-radius: 20px; border: none; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.02); height: 100%;">
                        <div class="card-header" style="background-color: transparent; border: none; padding: 24px 24px 12px 24px; display: flex; justify-content: space-between; align-items: center;">
                            <h4 style="font-weight: 700; color: #1a202c; margin: 0; font-size: 18px;">Recent Activities</h4>
                            <div style="display: flex; gap: 8px;">
                                <a href="#" style="font-size: 12px; font-weight: 600; color: #718096; text-decoration: none;">Cancel</a>
                                <a href="#" style="font-size: 12px; font-weight: 700; color: #5c67f2; text-decoration: none; border-bottom: 2px solid #5c67f2; padding-bottom: 2px;">All</a>
                            </div>
                        </div>
                        <div class="card-body" style="padding: 12px 24px 24px 24px;">
                            <div style="display: flex; flex-direction: column; gap: 20px;">
                                @forelse($activitiesList as $act)
                                    <div style="display: flex; align-items: flex-start; gap: 14px;">
                                        <div style="width: 38px; height: 38px; border-radius: 50%; background-color: {{ $act['color'] }}20; color: {{ $act['color'] }}; display: flex; align-items: center; justify-content: center; font-size: 13px; font-weight: 700; flex-shrink: 0; position: relative;">
                                            {{ $act['initials'] }}
                                        </div>
                                        <div style="flex-grow: 1;">
                                            <p style="font-size: 13.5px; color: #2d3748; font-weight: 600; margin: 0 0 2px 0; line-height: 1.4;">{{ $act['text'] }}</p>
                                            <span style="font-size: 11px; color: #a0aec0; font-weight: 500;">{{ $act['time'] }}</span>
                                        </div>
                                    </div>
                                @empty
                                    <div style="text-align: center; padding: 40px 0; color: #a0aec0; font-size: 14px; font-weight: 500; display: flex; flex-direction: column; align-items: center; gap: 8px;">
                                        <i class="fa fa-bell-slash" style="font-size: 24px; color: #cbd5e1;"></i>
                                        <span>No recent activities found</span>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
// === Transaction Filter ===
function filterTransactions(status, el) {
    document.querySelectorAll('.tx-tab').forEach(function(tab) {
        tab.classList.remove('active');
        tab.style.color = '#a0aec0';
        tab.style.borderBottom = 'none';
        tab.style.fontWeight = '600';
    });
    el.classList.add('active');
    el.style.color = '#5c67f2';
    el.style.borderBottom = '2px solid #5c67f2';
    el.style.fontWeight = '700';

    document.querySelectorAll('.tx-row').forEach(function(row) {
        if (status === 'All') {
            row.style.display = '';
        } else {
            var rowStatus = row.getAttribute('data-status');
            if (rowStatus === status) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    });
}
function switchActivityTab(evt, tabId) {
    // Hide all activity tab contents
    document.querySelectorAll('.activity-tab-content').forEach(function(content) {
        content.style.display = 'none';
    });
    // Remove active class from all links
    document.querySelectorAll('.activity-nav-link').forEach(function(link) {
        link.classList.remove('active');
    });
    // Show the selected tab content
    document.getElementById(tabId).style.display = 'block';
    // Add active class to current button
    evt.currentTarget.classList.add('active');
}

// Chart.js implementation for Performance & Activity analytics
let top10Data = @json($top10Data);
let activityStats = @json($activityStats);

let performanceChartInstance = null;
let prospectsChartInstance = null;

let activePerfLeftTab = 'employee';
let activePerfRightTab = 'revenue';
let activeProspectTab = 'pipeline';

function renderPerformanceChart(leftTab, rightTab) {
    const dataObj = top10Data[leftTab][rightTab];
    const labels = dataObj.labels || [];
    const values = dataObj.values || [];

    const ctx = document.getElementById('performanceChart').getContext('2d');
    
    if (performanceChartInstance) {
        performanceChartInstance.destroy();
    }

    const labelTitle = rightTab === 'revenue' ? 'Sales Revenue (₹)' : 'Products Count';
    const barColor = '#00a2ff';
    const hoverColor = '#0085d4';

    performanceChartInstance = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                label: labelTitle,
                data: values,
                backgroundColor: barColor,
                hoverBackgroundColor: hoverColor,
                borderRadius: 8,
                barThickness: 16
            }]
        },
        options: {
            indexAxis: 'y',
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                },
                tooltip: {
                    callbacks: {
                        label: function(context) {
                            let value = context.raw;
                            if (rightTab === 'revenue') {
                                return 'Revenue: ₹' + value.toLocaleString();
                            }
                            return 'Quantity: ' + value;
                        }
                    }
                }
            },
            scales: {
                x: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0,0,0,0.03)'
                    },
                    ticks: {
                        callback: function(value) {
                            if (rightTab === 'revenue') {
                                if (value >= 1000) {
                                    return '₹' + (value / 1000) + 'K';
                                }
                                return '₹' + value;
                            }
                            return value;
                        }
                    }
                },
                y: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            weight: '600'
                        }
                    }
                }
            }
        }
    });
}

function renderProspectsChart(tab) {
    const dataObj = activityStats[tab];
    const labels = dataObj.labels || [];
    const values = dataObj.values || [];

    const totalProspects = values.reduce((a, b) => a + b, 0);
    document.getElementById('prospects-badge-count').innerText = totalProspects;

    const ctx = document.getElementById('prospectsChart').getContext('2d');
    
    if (prospectsChartInstance) {
        prospectsChartInstance.destroy();
    }

    const pipelineColors = [
        '#2563eb', // Blue
        '#a855f7', // Purple
        '#f43f5e', // Pink/Coral
        '#22c55e', // Green
        '#06b6d4', // Light Blue/Cyan
        '#f97316'  // Orange
    ];
    
    const colors = labels.map((_, i) => pipelineColors[i % pipelineColors.length]);

    prospectsChartInstance = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: labels,
            datasets: [{
                data: values,
                backgroundColor: colors,
                borderRadius: 8,
                barThickness: 24
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: {
                    display: false
                }
            },
            scales: {
                x: {
                    grid: {
                        display: false
                    },
                    ticks: {
                        font: {
                            weight: '600'
                        }
                    }
                },
                y: {
                    beginAtZero: true,
                    grid: {
                        color: 'rgba(0,0,0,0.03)'
                    },
                    ticks: {
                        stepSize: 1
                    }
                }
            }
        }
    });
}

function switchPerformanceLeftTab(btn, tab) {
    document.querySelectorAll('#perf-left-tabs .activity-nav-link').forEach(link => {
        link.classList.remove('active');
    });
    btn.classList.add('active');
    activePerfLeftTab = tab;
    renderPerformanceChart(activePerfLeftTab, activePerfRightTab);
}

function switchPerformanceRightTab(btn, tab) {
    document.querySelectorAll('.chart-sub-pill').forEach(link => {
        link.classList.remove('active');
    });
    btn.classList.add('active');
    activePerfRightTab = tab;
    renderPerformanceChart(activePerfLeftTab, activePerfRightTab);
}

function switchProspectTab(btn, tab) {
    document.querySelectorAll('#prospect-tabs .activity-nav-link').forEach(link => {
        link.classList.remove('active');
    });
    btn.classList.add('active');
    activeProspectTab = tab;
    renderProspectsChart(activeProspectTab);
}

document.addEventListener('DOMContentLoaded', function() {
    renderPerformanceChart('employee', 'revenue');
    renderProspectsChart('pipeline');
    renderDoubleChart('client', 'period');
    renderGaugeChart('client');
});

// Chart.js implementation for Double Axis & Ratio Gauge analytics
let doubleChartsData = @json($doubleChartsData);
let gaugeStats = @json($gaugeStats);

let doubleChartInstance = null;
let gaugeChartInstance = null;

let activeDoubleLeftTab = 'client';
let activeDoubleRightTab = 'period';
let activeGaugeTab = 'client';

function renderDoubleChart(leftTab, rightTab) {
    const ctx = document.getElementById('doubleLineChart').getContext('2d');
    if (doubleChartInstance) {
        doubleChartInstance.destroy();
    }

    let chartType = 'line';
    let dataSets = [];
    let labels = [];
    let title = '';

    if (leftTab === 'target') {
        document.getElementById('btn-period').style.display = 'block';
        document.getElementById('btn-location').style.display = 'none';
        document.getElementById('btn-period').classList.add('active');
        
        labels = doubleChartsData.target.labels;
        title = 'Revenue vs. Target';
        
        dataSets.push({
            label: 'Actual Revenue (₹)',
            data: doubleChartsData.target.revenue,
            borderColor: '#4285F4',
            backgroundColor: 'rgba(66, 133, 244, 0.1)',
            fill: true,
            tension: 0.4,
            borderWidth: 3
        });
        
        dataSets.push({
            label: 'Monthly Target (₹)',
            data: doubleChartsData.target.target,
            borderColor: '#f43f5e',
            borderDash: [5, 5],
            fill: false,
            tension: 0,
            borderWidth: 2
        });
    } else {
        document.getElementById('btn-period').style.display = 'block';
        document.getElementById('btn-location').style.display = 'block';
        
        if (rightTab === 'period') {
            labels = doubleChartsData.client.period.labels;
            title = 'Client vs. Revenue';
            
            dataSets.push({
                label: 'Customer Count',
                data: doubleChartsData.client.period.clients,
                borderColor: '#2563eb',
                fill: false,
                tension: 0.4,
                borderWidth: 3,
                yAxisID: 'y'
            });
            dataSets.push({
                label: 'Revenue (₹)',
                data: doubleChartsData.client.period.revenue,
                borderColor: '#f97316',
                fill: false,
                tension: 0.4,
                borderWidth: 3,
                yAxisID: 'y1'
            });
        } else {
            labels = doubleChartsData.client.location.labels;
            title = 'Client vs. Revenue';
            chartType = 'bar';
            
            dataSets.push({
                label: 'Customer Count',
                data: doubleChartsData.client.location.clients,
                backgroundColor: '#2563eb',
                borderRadius: 4,
                yAxisID: 'y'
            });
            dataSets.push({
                label: 'Revenue (₹)',
                data: doubleChartsData.client.location.revenue,
                backgroundColor: '#f97316',
                borderRadius: 4,
                yAxisID: 'y1'
            });
        }
    }

    document.getElementById('double-chart-title').innerText = title;

    let scalesConfig = {
        x: {
            grid: { display: false },
            ticks: { font: { weight: '600' } }
        },
        y: {
            type: 'linear',
            display: true,
            position: 'left',
            grid: { color: 'rgba(0,0,0,0.03)' },
            title: {
                display: true,
                text: leftTab === 'target' ? 'Revenue (₹)' : 'Customer Count'
            }
        }
    };

    if (leftTab === 'client') {
        scalesConfig.y1 = {
            type: 'linear',
            display: true,
            position: 'right',
            grid: { drawOnChartArea: false },
            title: {
                display: true,
                text: 'Revenue (₹)'
            }
        };
    }

    doubleChartInstance = new Chart(ctx, {
        type: chartType,
        data: {
            labels: labels,
            datasets: dataSets
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            plugins: {
                legend: {
                    position: 'bottom',
                    labels: { boxWidth: 12, font: { weight: '600' } }
                }
            },
            scales: scalesConfig
        }
    });
}

function renderGaugeChart(tab) {
    const statsObj = gaugeStats[tab];
    const rate = statsObj.rate;

    document.getElementById('gauge-rate-text').innerText = rate + '%';
    document.getElementById('gauge-stat1-label').innerText = statsObj.stat1_label;
    document.getElementById('gauge-stat1-value').innerText = statsObj.stat1_value.toLocaleString();
    document.getElementById('gauge-stat2-label').innerText = statsObj.stat2_label;
    document.getElementById('gauge-stat2-value').innerText = statsObj.stat2_value.toLocaleString();

    const ctx = document.getElementById('gaugeChart').getContext('2d');
    if (gaugeChartInstance) {
        gaugeChartInstance.destroy();
    }

    gaugeChartInstance = new Chart(ctx, {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [rate, Math.max(0, 100 - rate)],
                backgroundColor: ['#e74c3c', '#edf2f7'],
                borderWidth: 0
            }]
        },
        options: {
            rotation: -90,
            circumference: 180,
            cutout: '80%',
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: { enabled: false }
            }
        }
    });
}

function switchDoubleLeftTab(btn, tab) {
    document.querySelectorAll('#double-left-tabs .activity-nav-link').forEach(link => {
        link.classList.remove('active');
    });
    btn.classList.add('active');
    activeDoubleLeftTab = tab;
    
    activeDoubleRightTab = 'period';
    document.querySelectorAll('#double-right-tabs-container .chart-sub-pill').forEach(link => {
        link.classList.remove('active');
    });
    document.getElementById('btn-period').classList.add('active');

    renderDoubleChart(activeDoubleLeftTab, activeDoubleRightTab);
}

function switchDoubleRightTab(btn, tab) {
    document.querySelectorAll('#double-right-tabs-container .chart-sub-pill').forEach(link => {
        link.classList.remove('active');
    });
    btn.classList.add('active');
    activeDoubleRightTab = tab;
    renderDoubleChart(activeDoubleLeftTab, activeDoubleRightTab);
}

function switchGaugeTab(btn, tab) {
    document.querySelectorAll('#gauge-tabs .activity-nav-link').forEach(link => {
        link.classList.remove('active');
    });
    btn.classList.add('active');
    activeGaugeTab = tab;
    renderGaugeChart(activeGaugeTab);
}

function applyStaffFilter(staffId) {
    var url = new URL(window.location.href);
    if (staffId) {
        url.searchParams.set('staff_id', staffId);
    } else {
        url.searchParams.delete('staff_id');
    }
    window.location.href = url.toString();
}

// === AJAX Period & Date Filter ===
function applyPeriodFilter(period, btn) {
    // Update active class on preset buttons
    document.querySelectorAll('.period-btn').forEach(function(b) {
        b.classList.remove('active');
    });
    if (btn) {
        btn.classList.add('active');
    }

    fetchFilteredData({ period: period });
}

function applyCustomDateFilter(e) {
    e.preventDefault();
    var startDate = document.getElementById('filterStartDate').value;
    var endDate = document.getElementById('filterEndDate').value;

    if (!startDate || !endDate) {
        alert('Please select both start and end dates.');
        return false;
    }

    // Remove active class from period buttons
    document.querySelectorAll('.period-btn').forEach(function(b) {
        b.classList.remove('active');
    });

    fetchFilteredData({
        start_date: startDate,
        end_date: endDate
    });
    return false;
}

function fetchFilteredData(params) {
    var url = new URL("{{ route('admin.dashboard.filter_data') }}", window.location.origin);
    Object.keys(params).forEach(key => url.searchParams.append(key, params[key]));

    var staffSelect = document.getElementById('filterStaffId');
    if (staffSelect && staffSelect.value) {
        url.searchParams.append('staff_id', staffSelect.value);
    }

    var applyBtn = document.getElementById('applyFilterBtn');
    if (applyBtn) {
        applyBtn.disabled = true;
        applyBtn.textContent = 'APPLYING...';
    }

    fetch(url, {
        method: 'GET',
        headers: {
            'X-Requested-With': 'XMLHttpRequest',
            'Accept': 'application/json'
        }
    })
    .then(response => response.json())
    .then(data => {
        if (applyBtn) {
            applyBtn.disabled = false;
            applyBtn.textContent = 'APPLY';
        }

        if (data.success) {
            // Update Metric Card numbers
            if (document.getElementById('metricOrderCount')) {
                document.getElementById('metricOrderCount').textContent = data.orderCount || 0;
            }
            if (document.getElementById('metricProductCount')) {
                document.getElementById('metricProductCount').textContent = data.productCount || 0;
            }
            if (document.getElementById('metricCustomerCount')) {
                document.getElementById('metricCustomerCount').textContent = data.customerCount || 0;
            }
            if (document.getElementById('metricVendorCount')) {
                document.getElementById('metricVendorCount').textContent = data.vendorCount || 0;
            }
            if (document.getElementById('metricViewerCount')) {
                document.getElementById('metricViewerCount').textContent = data.totalViews || 0;
            }
            if (document.getElementById('metricTotalOrderAmountValue')) {
                document.getElementById('metricTotalOrderAmountValue').textContent = '₹' + ((data.totalOrderAmountSum || 0) / 1000).toFixed(1) + 'K';
            }

            // Update date text description
            if (document.getElementById('filterDateText')) {
                document.getElementById('filterDateText').textContent = data.filterText;
            }

            // Update start/end date inputs
            if (data.startDate && data.endDate) {
                document.getElementById('filterStartDate').value = data.startDate;
                document.getElementById('filterEndDate').value = data.endDate;
            }

            // Update datasets
            top10Data = data.top10Data;
            activityStats = data.activityStats;
            doubleChartsData = data.doubleChartsData;
            gaugeStats = data.gaugeStats;

            // Re-render chart instances
            renderPerformanceChart(activePerfLeftTab, activePerfRightTab);
            renderProspectsChart(activeProspectTab);
            renderDoubleChart(activeDoubleLeftTab, activeDoubleRightTab);
            renderGaugeChart(activeGaugeTab);
        }
    })
    .catch(err => {
        console.error('Error fetching filtered data:', err);
        if (applyBtn) {
            applyBtn.disabled = false;
            applyBtn.textContent = 'APPLY';
        }
    });
}
</script>
@endpush
</div>

</div>

@endsection