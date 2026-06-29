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
	
<div class="page-body">

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-header-left">
                            <h3>Dashboard</h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ol class="breadcrumb pull-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}"><i data-feather="home"></i></a></li>
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
            background: #fff;
            border-radius: 16px;
            border: 1px solid rgba(0, 0, 0, 0.06);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.04);
            padding: 24px;
            height: 100%;
            position: relative;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        .employee-card-top {
            display: flex;
            gap: 20px;
            margin-bottom: 20px;
            align-items: flex-start;
        }

        .employee-avatar-wrapper {
            position: relative;
            flex-shrink: 0;
        }

        .employee-avatar {
            width: 100px;
            height: 100px;
            border-radius: 16px;
            border: 3px solid #e0f2fe;
            object-fit: cover;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.05);
        }

        .employee-info-main {
            flex-grow: 1;
            min-width: 0;
        }

        .employee-name {
            font-size: 20px;
            font-weight: 700;
            color: #1e293b;
            margin-bottom: 4px;
        }

        .employee-role {
            font-size: 14px;
            font-weight: 600;
            color: #02cccd;
            margin-bottom: 8px;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .employee-address {
            font-size: 13px;
            color: #64748b;
            line-height: 1.5;
            margin-bottom: 4px;
        }

        .employee-zone {
            font-size: 13px;
            font-weight: 500;
            color: #0f172a;
        }

        .employee-toggle {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .employee-card-bottom {
            border-top: 1px solid #f1f5f9;
            padding-top: 20px;
            display: grid;
            grid-template-columns: 1fr 1fr;
            gap: 16px;
        }

        .employee-meta-item {
            display: flex;
            flex-direction: column;
            gap: 4px;
            min-width: 0;
        }

        .employee-meta-label {
            font-size: 11px;
            text-transform: uppercase;
            font-weight: 600;
            color: #94a3b8;
            letter-spacing: 0.5px;
        }

        .employee-meta-value {
            font-size: 13px;
            font-weight: 600;
            color: #334155;
            word-break: break-all;
        }

        .employee-rating-stars {
            display: flex;
            gap: 2px;
            color: #10b981;
            font-size: 14px;
            margin-top: 4px;
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
            border-radius: 16px;
            padding: 24px 20px;
            min-height: 120px;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.02);
            transition: transform 0.2s ease, box-shadow 0.2s ease;
        }

        .metric-card-custom:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.05);
        }

        .metric-card-label {
            font-size: 13px;
            font-weight: 600;
            opacity: 0.95;
            margin-bottom: 8px;
            line-height: 1.3;
        }

        .metric-card-value {
            font-size: 32px;
            font-weight: 700;
            line-height: 1;
        }

        .card-style-val {
            background-color: #fbf9ff;
            border: 2px solid #ebdbff;
            color: #192c3a;
        }
        .card-style-val .metric-card-label {
            color: #6c757d;
        }
        .card-style-val .metric-card-value {
            color: #192c3a;
        }

        .card-style-orders {
            background-color: #0f4a8a;
            color: #ffffff;
        }

        .card-style-products {
            background-color: #0082c4;
            color: #ffffff;
        }

        .card-style-customers {
            background-color: #00a876;
            color: #ffffff;
        }

        .card-style-vendors {
            background-color: #df485a;
            color: #ffffff;
        }

        .card-style-viewers {
            background-color: #6c56b7;
            color: #ffffff;
        }

        /* Activity Tracker Section */
        .activity-tracker-container {
            background: #ffffff;
            border-radius: 16px;
            padding: 24px;
            border: 1px solid rgba(0, 0, 0, 0.06);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.02);
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
            gap: 8px;
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .activity-nav-link {
            padding: 8px 20px;
            border-radius: 20px;
            font-size: 13px;
            font-weight: 600;
            background-color: #f1f5f9;
            color: #64748b;
            border: none;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .activity-nav-link:hover {
            background-color: #e2e8f0;
        }

        .activity-nav-link.active {
            background-color: #02cccd;
            color: #fff;
            box-shadow: 0 4px 12px rgba(2, 204, 205, 0.2);
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
            .metrics-grid, .activity-grid {
                grid-template-columns: 1fr;
            }
            .employee-card-bottom {
                grid-template-columns: 1fr;
            }
        }
        </style>

        @php
            $showDetails = null;
            if (isset($selectedStaffDetails) && $selectedStaffDetails) {
                $showDetails = $selectedStaffDetails;
            }
            if (!$showDetails) {
                $showDetails = (object)[
                    'fullname' => session()->get('log_name') ?? 'Admin',
                    'designation' => session()->get('log_type') ?? 'Administrator',
                    'curr_addr' => 'Head Office, Mount Road, Chennai - 600002',
                    'zone_id' => 'All Zones',
                    'employee_id' => 'ADMIN-001',
                    'email' => session()->get('username') ?? 'admin@oxygen.com',
                    'mobileno' => '9876543210',
                    'a_mobileno' => '9876543211',
                    'profileimage' => null,
                    'rating' => 5
                ];
            }
        @endphp

        <!-- Container-fluid starts (Top Stats) -->
        <div class="container-fluid">
            <div class="row">
                <!-- Left Column: Employee/Staff Card -->
                <div class="col-xl-5 col-lg-12 mb-4">
                    <div class="employee-card">
                        <!-- iOS Status Toggle -->
                        <div class="employee-toggle">
                            <label class="switch-ios">
                                <input type="checkbox" checked disabled>
                                <span class="slider-ios"></span>
                            </label>
                        </div>
                        
                        <div class="employee-card-top">
                            <div class="employee-avatar-wrapper">
                                @if($showDetails->profileimage && $showDetails->profileimage != '-' && file_exists(public_path('assets/images/staffcreate/' . $showDetails->profileimage)))
                                    <img class="employee-avatar" src="{{ asset('assets/images/staffcreate/' . $showDetails->profileimage) }}" alt="Staff Photo">
                                @elseif($showDetails->profileimage && $showDetails->profileimage != '-' && file_exists(public_path('assets/images/dashboard/staff/' . $showDetails->profileimage)))
                                    <img class="employee-avatar" src="{{ asset('assets/images/dashboard/staff/' . $showDetails->profileimage) }}" alt="Staff Photo">
                                @else
                                    <img class="employee-avatar" src="{{ asset('assets/images/dashboard/man.jpeg') }}" alt="Staff Photo">
                                @endif
                            </div>
                            <div class="employee-info-main">
                                <div class="employee-name text-truncate" title="{{ $showDetails->fullname }}">{{ $showDetails->fullname }}</div>
                                <div class="employee-role text-truncate">{{ $showDetails->designation }}</div>
                                <div class="employee-address" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; height: 38px;">
                                    {{ $showDetails->curr_addr ?? 'Address not specified' }}
                                </div>
                                <div class="employee-zone">
                                    Zone - {{ $showDetails->zone_id ?? 'N/A' }}
                                </div>
                            </div>
                        </div>
                        
                        <div class="employee-card-bottom">
                            <div class="employee-meta-item">
                                <span class="employee-meta-label">EMP ID</span>
                                <span class="employee-meta-value">{{ $showDetails->employee_id }}</span>
                            </div>
                            <div class="employee-meta-item">
                                <span class="employee-meta-label">Email Address</span>
                                <span class="employee-meta-value text-truncate" title="{{ $showDetails->email }}">{{ $showDetails->email }}</span>
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
                                <span class="employee-meta-value">{{ $showDetails->mobileno }}</span>
                            </div>
                        </div>
                    </div>
                </div>
                
                <!-- Right Column: 6 Metrics Cards Grid -->
                <div class="col-xl-7 col-lg-12 mb-4">
                    <div class="metrics-grid">
                        <!-- Card 1: Orders -->
                        <div class="metric-card-custom card-style-orders">
                            <div class="metric-card-label">Orders</div>
                            <div class="metric-card-value">{{ $orderCount ?? 0 }}</div>
                        </div>
                        
                        <!-- Card 2: Products -->
                        <div class="metric-card-custom card-style-products">
                            <div class="metric-card-label">Products</div>
                            <div class="metric-card-value">{{ $productCount ?? 0 }}</div>
                        </div>
                        
                        <!-- Card 3: Customers -->
                        <div class="metric-card-custom card-style-customers">
                            <div class="metric-card-label">Customers</div>
                            <div class="metric-card-value">{{ $customerCount ?? 0 }}</div>
                        </div>
                        
                        <!-- Card 4: Vendors -->
                        <div class="metric-card-custom card-style-vendors">
                            <div class="metric-card-label">Vendors</div>
                            <div class="metric-card-value">{{ $vendorCount ?? 0 }}</div>
                        </div>
                        
                        <!-- Card 5: Viewers -->
                        <div class="metric-card-custom card-style-viewers">
                            <div class="metric-card-label">Viewers</div>
                            <div class="metric-card-value">{{ $totalViews ?? 0 }}</div>
                        </div>

                        <!-- Card 6: Completed Orders Total Value -->
                        <div class="metric-card-custom card-style-val">
                            <div class="metric-card-label">Completed Orders Value</div>
                            <div class="metric-card-value">₹{{ number_format(($completedOrdersTotalValueSum ?? 0) / 1000, 1) }}K</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Detailed Analytics Charts -->
        <div class="container-fluid">
            <div class="row">
                <!-- Sales Over Time & Sales by Discount -->
                <div class="col-xl-8 col-lg-8 col-md-12 mt-4">
                    <div class="card" style="border: 1px solid rgba(0,0,0,0.08); box-shadow: 0 4px 20px 0 rgba(0,0,0,0.02); border-radius: 8px;">
                        <div class="card-header" style="border-bottom: 1px solid rgba(0,0,0,0.08); background-color: #fff; padding: 15px 20px; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                            <h5 style="margin: 0; font-size: 15px; font-weight: 600; color: #192c3a; text-transform: none; letter-spacing: 0;">Sales Over Time</h5>
                        </div>
                        <div class="card-body" style="padding: 20px;">
                            <div class="chart-container" style="position: relative; height: 320px; width: 100%;">
                                <canvas id="visitsOverTimeChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12 mt-4">
                    <div class="card" style="border: 1px solid rgba(0,0,0,0.08); box-shadow: 0 4px 20px 0 rgba(0,0,0,0.02); border-radius: 8px;">
                        <div class="card-header" style="border-bottom: 1px solid rgba(0,0,0,0.08); background-color: #fff; padding: 15px 20px; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                            <h5 style="margin: 0; font-size: 15px; font-weight: 600; color: #192c3a; text-transform: none; letter-spacing: 0;">Sales by Discount</h5>
                        </div>
                        <div class="card-body" style="padding: 20px; display: flex; flex-direction: column; justify-content: space-between; height: 320px;">
                            <div class="chart-container" style="position: relative; height: 210px; width: 100%;">
                                <canvas id="salesDiscountChart"></canvas>
                            </div>
                            <div style="text-align: center; border-top: 1px solid rgba(0,0,0,0.05); padding-top: 10px; margin-top: 10px;">
                                <span style="font-size: 12px; color: #6c757d; font-weight: 500;">Total Discount Given:</span>
                                <h4 style="margin: 0; color: #f89a42; font-weight: 700; font-size: 18px;">₹{{ number_format($totalDiscountGiven, 2) }}</h4>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Customers Over Time & Returning Customers -->
                <div class="col-xl-8 col-lg-8 col-md-12 mt-4">
                    <div class="card" style="border: 1px solid rgba(0,0,0,0.08); box-shadow: 0 4px 20px 0 rgba(0,0,0,0.02); border-radius: 8px;">
                        <div class="card-header" style="border-bottom: 1px solid rgba(0,0,0,0.08); background-color: #fff; padding: 15px 20px; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                            <h5 style="margin: 0; font-size: 15px; font-weight: 600; color: #192c3a; text-transform: none; letter-spacing: 0;">Customers Over Time</h5>
                        </div>
                        <div class="card-body" style="padding: 20px;">
                            <div class="chart-container" style="position: relative; height: 320px; width: 100%;">
                                <canvas id="customerTrendChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12 mt-4">
                    <div class="card" style="border: 1px solid rgba(0,0,0,0.08); box-shadow: 0 4px 20px 0 rgba(0,0,0,0.02); border-radius: 8px; height: calc(100% - 24px);">
                        <div class="card-header" style="border-bottom: 1px solid rgba(0,0,0,0.08); background-color: #fff; padding: 15px 20px; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                            <h5 style="margin: 0; font-size: 15px; font-weight: 600; color: #192c3a; text-transform: none; letter-spacing: 0;">Returning Customers</h5>
                        </div>
                        <div class="card-body" style="padding: 20px; display: flex; flex-direction: column; align-items: center; justify-content: center; height: 320px;">
                            <div style="position: relative; width: 160px; height: 160px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px;">
                                <div style="position: absolute; width: 100%; height: 100%;">
                                    <canvas id="returningCustChart"></canvas>
                                </div>
                                <div style="text-align: center; z-index: 10;">
                                    <h2 style="margin: 0; font-weight: 700; color: #02cccd; font-size: 32px;">{{ $returningCustomersPercent }}%</h2>
                                    <span style="font-size: 11px; color: #6c757d; font-weight: 600; text-transform: uppercase;">Rate</span>
                                </div>
                            </div>
                            <div style="text-align: center; width: 100%; border-top: 1px solid rgba(0,0,0,0.05); padding-top: 15px;">
                                <div class="row">
                                    <div class="col-6" style="border-right: 1px solid rgba(0,0,0,0.05);">
                                        <span style="font-size: 12px; color: #6c757d; font-weight: 500;">Returning</span>
                                        <h4 style="margin: 5px 0 0 0; color: #192c3a; font-weight: 700;">{{ $returningCustomersCount }}</h4>
                                    </div>
                                    <div class="col-6">
                                        <span style="font-size: 12px; color: #6c757d; font-weight: 500;">Total Buyers</span>
                                        <h4 style="margin: 5px 0 0 0; color: #192c3a; font-weight: 700;">{{ $customerCount }}</h4>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Sales by Location & Customers by Location -->
                <div class="col-xl-6 col-lg-6 col-md-12 mt-4">
                    <div class="card" style="border: 1px solid rgba(0,0,0,0.08); box-shadow: 0 4px 20px 0 rgba(0,0,0,0.02); border-radius: 8px;">
                        <div class="card-header" style="border-bottom: 1px solid rgba(0,0,0,0.08); background-color: #fff; padding: 15px 20px; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                            <h5 style="margin: 0; font-size: 15px; font-weight: 600; color: #192c3a; text-transform: none; letter-spacing: 0;">Sales by Location</h5>
                        </div>
                        <div class="card-body" style="padding: 20px;">
                            <div class="chart-container" style="position: relative; height: 280px; width: 100%;">
                                <canvas id="salesLocationChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 mt-4">
                    <div class="card" style="border: 1px solid rgba(0,0,0,0.08); box-shadow: 0 4px 20px 0 rgba(0,0,0,0.02); border-radius: 8px;">
                        <div class="card-header" style="border-bottom: 1px solid rgba(0,0,0,0.08); background-color: #fff; padding: 15px 20px; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                            <h5 style="margin: 0; font-size: 15px; font-weight: 600; color: #192c3a; text-transform: none; letter-spacing: 0;">Customers by Location</h5>
                        </div>
                        <div class="card-body" style="padding: 20px;">
                            <div class="chart-container" style="position: relative; height: 280px; width: 100%;">
                                <canvas id="custLocationChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Admin-Only Analytics: Vendors by Employee & Vendors by Plan -->
                <div class="col-xl-6 col-lg-6 col-md-12 mt-4">
                    <div class="card" style="border: 1px solid rgba(0,0,0,0.08); box-shadow: 0 4px 20px 0 rgba(0,0,0,0.02); border-radius: 8px;">
                        <div class="card-header" style="border-bottom: 1px solid rgba(0,0,0,0.08); background-color: #fff; padding: 15px 20px; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                            <h5 style="margin: 0; font-size: 15px; font-weight: 600; color: #192c3a; text-transform: none; letter-spacing: 0;">Vendors by Employee (Staff Performance)</h5>
                        </div>
                        <div class="card-body" style="padding: 20px;">
                            <div class="chart-container" style="position: relative; height: 280px; width: 100%;">
                                <canvas id="vendorsByEmployeeChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-6 col-md-12 mt-4">
                    <div class="card" style="border: 1px solid rgba(0,0,0,0.08); box-shadow: 0 4px 20px 0 rgba(0,0,0,0.02); border-radius: 8px;">
                        <div class="card-header" style="border-bottom: 1px solid rgba(0,0,0,0.08); background-color: #fff; padding: 15px 20px; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                            <h5 style="margin: 0; font-size: 15px; font-weight: 600; color: #192c3a; text-transform: none; letter-spacing: 0;">Vendors by Subscription Plans</h5>
                        </div>
                        <div class="card-body" style="padding: 20px;">
                            <div class="chart-container" style="position: relative; height: 280px; width: 100%;">
                                <canvas id="vendorsByPlanChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Activity Tracker Section -->
                <div class="col-md-12 mt-4">
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
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
$(document).ready(function() {
    // 1. Sales Over Time Line Chart
    const visitsCanvas = document.getElementById('visitsOverTimeChart');
    if (visitsCanvas) {
        const visitsCtx = visitsCanvas.getContext('2d');
        const visitsGradient = visitsCtx.createLinearGradient(0, 0, 0, 300);
        visitsGradient.addColorStop(0, 'rgba(2, 204, 205, 0.25)');
        visitsGradient.addColorStop(1, 'rgba(2, 204, 205, 0.0)');

        new Chart(visitsCtx, {
            type: 'line',
            data: {
                labels: @json($salesTrendLabels),
                datasets: [
                    {
                        label: 'Revenue (₹)',
                        data: @json($salesTrendRevenue),
                        borderColor: '#02cccd',
                        borderWidth: 2,
                        backgroundColor: visitsGradient,
                        fill: true,
                        tension: 0.4,
                        pointBackgroundColor: '#02cccd',
                        pointBorderColor: '#fff',
                        pointHoverRadius: 6,
                        pointRadius: 4,
                        yAxisID: 'y'
                    },
                    {
                        label: 'Orders Count',
                        data: @json($salesTrendOrders),
                        borderColor: '#a5a5a5',
                        borderWidth: 1.5,
                        borderDash: [5, 5],
                        fill: false,
                        pointRadius: 3,
                        pointBackgroundColor: '#a5a5a5',
                        yAxisID: 'y1'
                    }
                ]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                        labels: { boxWidth: 12, font: { family: "'Work Sans', sans-serif" } }
                    }
                },
                scales: {
                    y: {
                        type: 'linear',
                        display: true,
                        position: 'left',
                        grid: { color: 'rgba(0,0,0,0.05)' },
                        ticks: {
                            font: { family: "'Work Sans', sans-serif" },
                            callback: function(value) { return '₹' + value; }
                        }
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        grid: { drawOnChartArea: false },
                        ticks: { font: { family: "'Work Sans', sans-serif" }, stepSize: 1 }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { family: "'Work Sans', sans-serif" } }
                    }
                }
            }
        });
    }

    // 2. Sales by Discount Doughnut Chart
    const discountCanvas = document.getElementById('salesDiscountChart');
    if (discountCanvas) {
        const discountCtx = discountCanvas.getContext('2d');
        new Chart(discountCtx, {
            type: 'doughnut',
            data: {
                labels: @json($salesDiscountLabels),
                datasets: [{
                    data: @json($salesDiscountValues),
                    backgroundColor: ['#f89a42', '#2b4b7c'],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { boxWidth: 12, font: { family: "'Work Sans', sans-serif", size: 11 } }
                    }
                },
                cutout: '70%'
            }
        });
    }

    // 3. Customers Over Time Area Chart
    const customerTrendCanvas = document.getElementById('customerTrendChart');
    if (customerTrendCanvas) {
        const customerTrendCtx = customerTrendCanvas.getContext('2d');
        const customerGradient = customerTrendCtx.createLinearGradient(0, 0, 0, 300);
        customerGradient.addColorStop(0, 'rgba(43, 75, 124, 0.25)');
        customerGradient.addColorStop(1, 'rgba(43, 75, 124, 0.0)');

        new Chart(customerTrendCtx, {
            type: 'line',
            data: {
                labels: @json($customerTrendLabels),
                datasets: [{
                    label: 'New Customers',
                    data: @json($customerTrendCounts),
                    borderColor: '#2b4b7c',
                    borderWidth: 2,
                    backgroundColor: customerGradient,
                    fill: true,
                    tension: 0.3,
                    pointBackgroundColor: '#2b4b7c',
                    pointBorderColor: '#fff',
                    pointHoverRadius: 6,
                    pointRadius: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        grid: { color: 'rgba(0,0,0,0.05)' },
                        ticks: { font: { family: "'Work Sans', sans-serif" }, stepSize: 1 }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { family: "'Work Sans', sans-serif" } }
                    }
                }
            }
        });
    }

    // 4. Returning Customers Semi-Doughnut Chart
    const returningCanvas = document.getElementById('returningCustChart');
    if (returningCanvas) {
        const returningCtx = returningCanvas.getContext('2d');
        const rate = {{ $returningCustomersPercent }};
        new Chart(returningCtx, {
            type: 'doughnut',
            data: {
                labels: ['Returning', 'One-time'],
                datasets: [{
                    data: [rate, 100 - rate],
                    backgroundColor: ['#02cccd', 'rgba(0,0,0,0.05)'],
                    borderWidth: 0
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false },
                    tooltip: { enabled: false }
                },
                cutout: '80%',
                rotation: -90,
                circumference: 180
            }
        });
    }

    // 5. Sales by Location Horizontal Bar Chart
    const salesLocationCanvas = document.getElementById('salesLocationChart');
    if (salesLocationCanvas) {
        const salesLocationCtx = salesLocationCanvas.getContext('2d');
        new Chart(salesLocationCtx, {
            type: 'bar',
            data: {
                labels: @json($salesLocationLabels),
                datasets: [{
                    label: 'Sales (₹)',
                    data: @json($salesLocationValues),
                    backgroundColor: '#a874e0',
                    borderRadius: 4,
                    maxBarThickness: 25
                }]
            },
            options: {
                indexAxis: 'y',
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    x: {
                        grid: { color: 'rgba(0,0,0,0.05)' },
                        ticks: { font: { family: "'Work Sans', sans-serif" } }
                    },
                    y: {
                        grid: { display: false },
                        ticks: { font: { family: "'Work Sans', sans-serif" } }
                    }
                }
            }
        });
    }

    // 6. Customers by Location Pie Chart
    const custLocationCanvas = document.getElementById('custLocationChart');
    if (custLocationCanvas) {
        const custLocationCtx = custLocationCanvas.getContext('2d');
        new Chart(custLocationCtx, {
            type: 'pie',
            data: {
                labels: @json($custLocationLabels),
                datasets: [{
                    data: @json($custLocationCounts),
                    backgroundColor: ['#02cccd', '#2b4b7c', '#f89a42', '#a874e0', '#ff8084'],
                    borderWidth: 1,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'right',
                        labels: { boxWidth: 12, font: { family: "'Work Sans', sans-serif", size: 11 } }
                    }
                }
            }
        });
    }

    // 7. Vendors by Employee Bar Chart
    const vendorsByEmployeeCanvas = document.getElementById('vendorsByEmployeeChart');
    if (vendorsByEmployeeCanvas) {
        const vendorsByEmployeeCtx = vendorsByEmployeeCanvas.getContext('2d');
        new Chart(vendorsByEmployeeCtx, {
            type: 'bar',
            data: {
                labels: @json($vendorsByEmployeeLabels),
                datasets: [{
                    label: 'Vendors Registered',
                    data: @json($vendorsByEmployeeCounts),
                    backgroundColor: '#ff8084',
                    borderRadius: 4,
                    maxBarThickness: 30
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: { display: false }
                },
                scales: {
                    y: {
                        grid: { color: 'rgba(0,0,0,0.05)' },
                        ticks: { font: { family: "'Work Sans', sans-serif" }, stepSize: 1 }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { family: "'Work Sans', sans-serif" } }
                    }
                }
            }
        });
    }

    // 8. Vendors by Plan Doughnut Chart
    const vendorsByPlanCanvas = document.getElementById('vendorsByPlanChart');
    if (vendorsByPlanCanvas) {
        const vendorsByPlanCtx = vendorsByPlanCanvas.getContext('2d');
        new Chart(vendorsByPlanCtx, {
            type: 'doughnut',
            data: {
                labels: @json($vendorsByPlanLabels),
                datasets: [{
                    data: @json($vendorsByPlanCounts),
                    backgroundColor: ['#2b4b7c', '#02cccd', '#f89a42', '#a874e0', '#ff8084'],
                    borderWidth: 2,
                    borderColor: '#ffffff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: { boxWidth: 12, font: { family: "'Work Sans', sans-serif", size: 11 } }
                    }
                },
                cutout: '60%'
            }
        });
    }
});

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
</script>
@endpush

@endsection