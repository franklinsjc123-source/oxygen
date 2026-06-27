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
            background-color: #183543;
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
        
        /* Responsive Shop Banner & Info */
        .shop-profile-banner {
            height: 80px; 
            background: #183543; 
            position: relative; 
            padding: 12px 24px; 
            display: flex; 
            align-items: center; 
            gap: 16px;
        }
        .shop-profile-info {
            flex-grow: 1; 
            min-width: 0; 
            color: #ffffff; 
            padding-right: 145px;
        }
        .shop-profile-status-badge {
            position: absolute; 
            top: 50%; 
            transform: translateY(-50%); 
            right: 24px;
        }
        .shop-owner-details-row {
            display: grid; 
            grid-template-columns: 1fr 1fr 1.2fr; 
            gap: 10px; 
            margin-bottom: 14px; 
            border-bottom: 1px solid #edf2f7; 
            padding-bottom: 14px;
        }
        
        @media (max-width: 575.98px) {
            .shop-profile-banner {
                flex-direction: row !important;
                align-items: flex-start !important;
                height: auto !important;
                padding: 12px !important;
                gap: 12px !important;
            }
            .shop-profile-banner > div:first-child,
            .shop-profile-banner > div:first-child img {
                width: 48px !important;
                height: 48px !important;
            }
            .shop-profile-info {
                padding-right: 92px !important;
                width: auto !important;
                flex-grow: 1 !important;
            }
            .shop-profile-info h4 {
                font-size: 15px !important;
                white-space: normal !important;
                overflow: visible !important;
                text-overflow: clip !important;
                line-height: 1.25 !important;
            }
            .shop-profile-info p {
                font-size: 11px !important;
                line-height: 1.3 !important;
                margin-top: 2px !important;
            }
            .shop-profile-info p span {
                -webkit-line-clamp: unset !important;
                overflow: visible !important;
                display: block !important;
            }
            .shop-profile-status-badge {
                position: absolute !important;
                top: 12px !important;
                right: 12px !important;
                transform: none !important;
                bottom: auto !important;
            }
            .shop-profile-status-badge button {
                padding: 3px 8px !important;
                font-size: 10px !important;
            }
            .shop-owner-details-row {
                grid-template-columns: 1fr !important;
                gap: 12px !important;
            }
            .shop-owner-details-row div div {
                white-space: normal !important;
                word-break: break-word !important;
                overflow: visible !important;
                text-overflow: clip !important;
            }
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
                    <!-- Modern Header Banner with Shop Image, Name and Address -->
                    <div class="shop-profile-banner">
                        <!-- Profile Image -->
                        <div style="width: 56px; height: 56px; flex-shrink: 0; position: relative;">
                            @if(!empty($vendorDetails->profile_image) && file_exists(public_path('assets/images/vendor/profile/' . $vendorDetails->profile_image)))
                                <img src="{{ asset('assets/images/vendor/profile/' . $vendorDetails->profile_image) }}" style="width: 56px; height: 56px; border-radius: 50%; object-fit: cover; border: 3px solid #ffffff; box-shadow: 0 4px 10px rgba(0,0,0,0.15);" alt="Profile">
                            @else
                                <img src="{{ asset('assets/images/dashboard/man.jpeg') }}" style="width: 56px; height: 56px; border-radius: 50%; object-fit: cover; border: 3px solid #ffffff; box-shadow: 0 4px 10px rgba(0,0,0,0.15);" alt="Profile">
                            @endif
                        </div>
                        
                        <!-- Shop Info next to the image -->
                        <div class="shop-profile-info">
                            <div style="display: flex; align-items: center; gap: 8px; margin-bottom: 4px;">
                                <h4 style="font-size: 20px; font-weight: 700; color: #ffffff; margin: 0; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                    {{ $vendorDetails->shop_name ?? 'ABC Garments' }}
                                </h4>
                                <div style="display: flex; gap: 2px; align-items: center; flex-shrink: 0; background-color: rgba(255, 255, 255, 0.15); padding: 2px 6px; border-radius: 12px;">
                                    <i class="fa fa-star" style="color: #f1c40f; font-size: 12px;"></i>
                                    <span style="font-size: 11px; font-weight: 700; color: #ffffff; margin-left: 2px;">5.0</span>
                                </div>
                            </div>
                            
                            <p style="font-size: 13px; color: #ffffff; margin: 0; display: flex; align-items: flex-start; gap: 4px; line-height: 1.35;">
                                <i class="fa fa-map-marker" style="color: #ffffff; margin-top: 2px; font-size: 12px; width: 12px; text-align: center; flex-shrink: 0;"></i>
                                <span style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden;">
                                    #{{ $vendorDetails->address ?? '38' }}
                                    @if(!empty($vendorDetails->address1)), {{ $vendorDetails->address1 }} @endif
                                    @if(!empty($vendorDetails->city)), {{ $vendorDetails->city }} @endif
                                    @if(!empty($vendorDetails->state)), {{ $vendorDetails->state }} @endif
                                    @if(!empty($vendorDetails->pincode)) - {{ $vendorDetails->pincode }} @endif
                                </span>
                            </p>
                            @if(!empty($vendorDetails->location_map))
                                <div style="margin-top: 4px;">
                                    <a href="{{ $vendorDetails->location_map }}" target="_blank" style="background-color: rgba(255, 255, 255, 0.15); color: #ffffff; padding: 2px 8px; border-radius: 4px; font-size: 10.5px; font-weight: 600; text-decoration: none; display: inline-flex; align-items: center; gap: 3px;">
                                        <i class="fa fa-map-marker" style="font-size: 9.5px;"></i> Map View
                                    </a>
                                </div>
                            @endif
                        </div>
                        
                        <!-- Status Badge on the right -->
                        <div class="shop-profile-status-badge">
                            <button id="vendorStatusBtn" onclick="toggleVendorStatus()" style="background-color: {{ (int)($vendorDetails->status ?? 1) === 1 ? 'rgba(46, 204, 113, 0.25)' : 'rgba(231, 76, 60, 0.25)' }}; color: {{ (int)($vendorDetails->status ?? 1) === 1 ? '#2ecc71' : '#e74c3c' }}; padding: 4px 12px; border-radius: 20px; font-size: 11.5px; font-weight: 700; text-transform: uppercase; border: 1px solid {{ (int)($vendorDetails->status ?? 1) === 1 ? 'rgba(46, 204, 113, 0.4)' : 'rgba(231, 76, 60, 0.4)' }}; letter-spacing: 0.5px; backdrop-filter: blur(4px); cursor: pointer; display: flex; align-items: center; gap: 4px; transition: all 0.2s; outline: none;" onmouseover="this.style.transform='scale(1.05)'" onmouseout="this.style.transform='scale(1)'">
                                <span id="vendorStatusDot" style="width: 6px; height: 6px; border-radius: 50%; background-color: {{ (int)($vendorDetails->status ?? 1) === 1 ? '#2ecc71' : '#e74c3c' }}; display: inline-block;"></span>
                                <span id="vendorStatusText">{{ (int)($vendorDetails->status ?? 1) === 1 ? 'Active' : 'Inactive' }}</span>
                            </button>
                        </div>
                    </div>

                    <!-- Shop Information -->
                    <div style="padding: 16px 16px 12px 16px; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                        <div>
                            
                            <!-- Business Category Box -->
                            <div style="background-color: #f8fafc; border: 1px solid #edf2f7; border-radius: 8px; padding: 8px 12px; margin-bottom: 12px;">
                                <div style="font-size: 11.5px; text-transform: uppercase; color: #a0aec0; letter-spacing: 0.5px; font-weight: 700; margin-bottom: 2px;">Business Category</div>
                                <div style="font-size: 14.5px; font-weight: 600; color: #2d3748; display: flex; align-items: center; gap: 6px;">
                                    <i class="fa fa-tag" style="color: #b7791f; font-size: 13px;"></i><span>{{ $vendorDetails->business_category ?? 'Fashion' }}@if(count($subCategoriesList) > 0) <span style="color: #718096; font-weight: 400; font-size: 13px;">({{ implode(', ', array_slice($subCategoriesList, 0, 2)) }}@if(count($subCategoriesList) > 2) +{{ count($subCategoriesList) - 2 }} more @endif)</span>@endif</span>
                                </div>
                            </div>
                            
                            <!-- Owner, Phone, Email Details Row -->
                            <div class="shop-owner-details-row">
                                <div>
                                    <div style="font-size: 11.5px; text-transform: uppercase; color: #a0aec0; letter-spacing: 0.5px; font-weight: 700; margin-bottom: 2px;">Owner Name</div>
                                    <div style="font-size: 14px; font-weight: 600; color: #2d3748; display: flex; align-items: center; gap: 4px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                        <i class="fa fa-user" style="color: #718096; font-size: 13px;"></i>{{ $vendorDetails->owner_name ?? 'N/A' }}
                                    </div>
                                </div>
                                <div>
                                    <div style="font-size: 11.5px; text-transform: uppercase; color: #a0aec0; letter-spacing: 0.5px; font-weight: 700; margin-bottom: 2px;">Mobile Number</div>
                                    <div style="font-size: 14px; font-weight: 600; color: #2d3748; display: flex; align-items: center; gap: 4px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
                                        <i class="fa fa-phone" style="color: #718096; font-size: 13px;"></i>{{ $vendorDetails->mobile_number1 ?? 'N/A' }}
                                    </div>
                                </div>
                                <div>
                                    <div style="font-size: 11.5px; text-transform: uppercase; color: #a0aec0; letter-spacing: 0.5px; font-weight: 700; margin-bottom: 2px;">Email Address</div>
                                    <div style="font-size: 14px; font-weight: 600; color: #2d3748; display: flex; align-items: center; gap: 4px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" title="{{ $vendorDetails->email ?? 'N/A' }}">
                                        <i class="fa fa-envelope" style="color: #718096; font-size: 13px;"></i>{{ $vendorDetails->email ?? 'N/A' }}
                                    </div>
                                </div>
                            </div>

                            <!-- Subscription Plan Box -->
                            <div style="background: linear-gradient(135deg, #e6fcf5 0%, #c3fae8 100%); border-radius: 8px; padding: 8px 12px; display: flex; justify-content: space-between; align-items: center; border: 1px solid #a3ebd6; margin-bottom: 10px;">
                                <div style="display: flex; align-items: center; gap: 12px;">
                                    <div>
                                        <span style="font-size: 11.5px; text-transform: uppercase; color: #0ca678; letter-spacing: 0.5px; font-weight: 700;">Plan:</span>
                                        <strong style="font-size: 14px; color: #094080; margin-left: 4px;">{{ $packagePlanName }}</strong>
                                    </div>
                                    <div style="font-size: 13px; color: #0ca678; font-weight: 500; border-left: 1px solid #a3ebd6; padding-left: 12px;">
                                        Expires: {{ $vendorDetails->expired_date ? date('d M Y', strtotime($vendorDetails->expired_date)) : '31st Dec 2023' }}
                                    </div>
                                </div>
                                <a href="javascript:void(0)" onclick="openRenewalModal()" style="background-color: #183543; color: #ffffff; padding: 4px 10px; border-radius: 4px; font-size: 10.5px; font-weight: 700; text-decoration: none; transition: background-color 0.2s; box-shadow: 0 2px 4px rgba(24, 53, 67, 0.15);">
                                    Renewal
                                </a>
                            </div>

                            <!-- Social Media Links -->
                            @if(!empty($vendorDetails->instagram_link) || !empty($vendorDetails->facebook_link) || !empty($vendorDetails->whatsapp_number))
                                <div style="display: flex; gap: 6px; justify-content: flex-end; align-items: center; margin-top: 8px;">
                                    @if(!empty($vendorDetails->facebook_link))
                                        <a href="{{ $vendorDetails->facebook_link }}" target="_blank" title="Facebook" style="display: flex; align-items: center; justify-content: center; width: 22px; height: 22px; border-radius: 50%; background-color: #3b5998; color: #ffffff; font-size: 10px; text-decoration: none; transition: transform 0.2s; box-shadow: 0 2px 4px rgba(59, 89, 152, 0.15);" onmouseover="this.style.transform='scale(1.15)';" onmouseout="this.style.transform='scale(1)';">
                                            <i class="fa fa-facebook"></i>
                                        </a>
                                    @endif
                                    @if(!empty($vendorDetails->instagram_link))
                                        <a href="{{ $vendorDetails->instagram_link }}" target="_blank" title="Instagram" style="display: flex; align-items: center; justify-content: center; width: 22px; height: 22px; border-radius: 50%; background: linear-gradient(45deg, #f09433 0%, #e6683c 25%, #dc2743 50%, #cc2366 75%, #bc1888 100%); color: #ffffff; font-size: 10px; text-decoration: none; transition: transform 0.2s; box-shadow: 0 2px 4px rgba(220, 39, 67, 0.15);" onmouseover="this.style.transform='scale(1.15)';" onmouseout="this.style.transform='scale(1)';">
                                            <i class="fa fa-instagram"></i>
                                        </a>
                                    @endif
                                    @if(!empty($vendorDetails->whatsapp_number))
                                        @php
                                            $whatsappNumber = preg_replace('/[^0-9]/', '', $vendorDetails->whatsapp_number);
                                        @endphp
                                        <a href="https://wa.me/{{ $whatsappNumber }}" target="_blank" title="WhatsApp" style="display: flex; align-items: center; justify-content: center; width: 22px; height: 22px; border-radius: 50%; background-color: #25d366; color: #ffffff; font-size: 11px; text-decoration: none; transition: transform 0.2s; box-shadow: 0 2px 4px rgba(37, 211, 102, 0.15);" onmouseover="this.style.transform='scale(1.15)';" onmouseout="this.style.transform='scale(1)';">
                                            <i class="fa fa-whatsapp"></i>
                                        </a>
                                    @endif
                                </div>
                            @endif
                        </div>


                    </div>
                </div>
            </div>

            <!-- 2. Metrics Cards -->
            <div class="col-xl-6 col-lg-6 col-md-12 mb-4" style="display: flex; flex-direction: column;">
                <div class="row" style="flex-grow: 1; display: flex; margin-bottom: -24px;">
                    <!-- Card 1: Orders -->
                    <div class="col-6 col-xs-6 col-md-6 col-sm-6" style="margin-bottom: 24px; display: flex; flex-direction: column;">
                        <div class="metric-card" style="background: linear-gradient(135deg, #094080 0%, #1e5ba0 100%); color: #ffffff; position: relative; padding: 16px; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                            <div>
                                <div class="metric-title" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; opacity: 0.85;">Orders</div>
                                <div class="metric-value" style="font-size: 28px; font-weight: 700; margin-top: 8px;">{{ number_format($orderCount) }}</div>
                            </div>
                            <i class="fa fa-shopping-bag" style="position: absolute; right: 16px; bottom: 16px; font-size: 28px; opacity: 0.18;"></i>
                        </div>
                    </div>
                    
                    <!-- Card 2: Products -->
                    <div class="col-6 col-xs-6 col-md-6 col-sm-6" style="margin-bottom: 24px; display: flex; flex-direction: column;">
                        <div class="metric-card" style="background: linear-gradient(135deg, #00bfa5 0%, #1de9b6 100%); color: #ffffff; position: relative; padding: 16px; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                            <div>
                                <div class="metric-title" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; opacity: 0.85;">Products</div>
                                <div class="metric-value" style="font-size: 28px; font-weight: 700; margin-top: 8px;">{{ number_format($productCount) }}</div>
                            </div>
                            <i class="fa fa-cubes" style="position: absolute; right: 16px; bottom: 16px; font-size: 28px; opacity: 0.18;"></i>
                        </div>
                    </div>
                    
                    <!-- Card 3: Customers -->
                    <div class="col-6 col-xs-6 col-md-6 col-sm-6" style="margin-bottom: 24px; display: flex; flex-direction: column;">
                        <div class="metric-card" style="background: linear-gradient(135deg, #ff5252 0%, #ff8a80 100%); color: #ffffff; position: relative; padding: 16px; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                            <div>
                                <div class="metric-title" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; opacity: 0.85;">Customers</div>
                                <div class="metric-value" style="font-size: 28px; font-weight: 700; margin-top: 8px;">{{ number_format($customerCount) }}</div>
                            </div>
                            <i class="fa fa-users" style="position: absolute; right: 16px; bottom: 16px; font-size: 28px; opacity: 0.18;"></i>
                        </div>
                    </div>
                    
                    <!-- Card 4: Viewers -->
                    <div class="col-6 col-xs-6 col-md-6 col-sm-6" style="margin-bottom: 24px; display: flex; flex-direction: column;">
                        <div class="metric-card" style="background: linear-gradient(135deg, #7c4dff 0%, #b388ff 100%); color: #ffffff; position: relative; padding: 16px; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                            <div>
                                <div class="metric-title" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; opacity: 0.85;">Viewers</div>
                                <div class="metric-value" style="font-size: 28px; font-weight: 700; margin-top: 8px;">{{ number_format($totalViews) }}</div>
                            </div>
                            <i class="fa fa-eye" style="position: absolute; right: 16px; bottom: 16px; font-size: 28px; opacity: 0.18;"></i>
                        </div>
                    </div>

                    {{--
                    <!-- Card 5: Categories -->
                    <div class="col-6 col-xs-6 col-md-6 col-sm-6" style="margin-bottom: 24px; display: flex; flex-direction: column;">
                        <div class="metric-card" style="background: linear-gradient(135deg, #ff9100 0%, #ffb74d 100%); color: #ffffff; position: relative; padding: 16px; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                            <div>
                                <div class="metric-title" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; opacity: 0.85;">Categories</div>
                                <div class="metric-value" style="font-size: 28px; font-weight: 700; margin-top: 8px;">{{ number_format($assignedCategoryCount) }}</div>
                            </div>
                            <i class="fa fa-th-list" style="position: absolute; right: 16px; bottom: 16px; font-size: 28px; opacity: 0.18;"></i>
                        </div>
                    </div>
                    
                    <!-- Card 6: Sub Categories -->
                    <div class="col-6 col-xs-6 col-md-6 col-sm-6" style="margin-bottom: 24px; display: flex; flex-direction: column;">
                        <div class="metric-card" style="background: linear-gradient(135deg, #e91e63 0%, #ff6090 100%); color: #ffffff; position: relative; padding: 16px; flex-grow: 1; display: flex; flex-direction: column; justify-content: space-between;">
                            <div>
                                <div class="metric-title" style="font-size: 12px; text-transform: uppercase; letter-spacing: 0.5px; opacity: 0.85;">Sub Categories</div>
                                <div class="metric-value" style="font-size: 28px; font-weight: 700; margin-top: 8px;">{{ number_format($assignedSubCategoryCount) }}</div>
                            </div>
                            <i class="fa fa-tags" style="position: absolute; right: 16px; bottom: 16px; font-size: 28px; opacity: 0.18;"></i>
                        </div>
                    </div>
                    --}}
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

        <!-- Premium Period Wise Activity Filter Bar -->
        <div class="filter-bar d-flex justify-content-between align-items-center flex-wrap gap-3 mb-4" style="background: #ffffff; padding: 16px 24px; border-radius: 16px; border: 1px solid #edf2f7; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.02); margin-top: 20px;">
            <div class="filter-title d-flex align-items-center gap-3">
                <div style="background-color: rgba(24, 53, 67, 0.08); width: 38px; height: 38px; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                    <i class="fa fa-calendar" style="color: #183543; font-size: 16px;"></i>
                </div>
                <div>
                    <span style="font-weight: 700; color: #1a202c; font-size: 15px; display: block;">Period Filter</span>
                    <span style="font-size: 11px; color: #718096; font-weight: 500;">
                        @if($startDate && $endDate)
                            Showing data from {{ \Carbon\Carbon::parse($startDate)->format('M d, Y') }} to {{ \Carbon\Carbon::parse($endDate)->format('M d, Y') }}
                        @else
                            Showing cumulative data
                        @endif
                    </span>
                </div>
            </div>
            <div class="filter-controls d-flex align-items-center gap-3 flex-wrap">
                <!-- Period Preset Buttons (Today, Week, Month matches mockup exactly) -->
                <div class="period-selector d-flex p-1" style="border-radius: 30px; background-color: #f1f5f9; border: 1px solid #e2e8f0;">
                    <a href="?period=today" class="period-btn {{ $period === 'today' ? 'active' : '' }}" style="padding: 6px 18px; border-radius: 20px; font-size: 12px; font-weight: 600; text-decoration: none; transition: all 0.2s; display: inline-block; text-align: center;">Today</a>
                    <a href="?period=week" class="period-btn {{ $period === 'week' ? 'active' : '' }}" style="padding: 6px 18px; border-radius: 20px; font-size: 12px; font-weight: 600; text-decoration: none; transition: all 0.2s; display: inline-block; text-align: center;">Week</a>
                    <a href="?period=month" class="period-btn {{ $period === 'month' ? 'active' : '' }}" style="padding: 6px 18px; border-radius: 20px; font-size: 12px; font-weight: 600; text-decoration: none; transition: all 0.2s; display: inline-block; text-align: center;">Month</a>
                </div>
                
                <!-- Custom Date Form -->
                <form method="GET" action="" class="d-flex align-items-center gap-2 m-0 flex-wrap">
                    <div class="input-group input-group-sm" style="width: auto; box-shadow: 0 1px 2px 0 rgba(0,0,0,0.05);">
                        <span class="input-group-text bg-white" style="border-right: none; border-color: #cbd5e1; border-top-left-radius: 8px; border-bottom-left-radius: 8px;"><i class="fa fa-calendar-o" style="color: #64748b; font-size: 11px;"></i></span>
                        <input type="date" name="start_date" class="form-control form-control-sm" value="{{ $startDate }}" style="border-left: none; border-color: #cbd5e1; font-size: 12px; font-weight: 500; color: #334155; width: 135px; border-top-right-radius: 8px; border-bottom-right-radius: 8px; height: 32px;">
                    </div>
                    <span style="font-size: 12px; color: #64748b; font-weight: 600; padding: 0 4px;">to</span>
                    <div class="input-group input-group-sm" style="width: auto; box-shadow: 0 1px 2px 0 rgba(0,0,0,0.05);">
                        <span class="input-group-text bg-white" style="border-right: none; border-color: #cbd5e1; border-top-left-radius: 8px; border-bottom-left-radius: 8px;"><i class="fa fa-calendar-o" style="color: #64748b; font-size: 11px;"></i></span>
                        <input type="date" name="end_date" class="form-control form-control-sm" value="{{ $endDate }}" style="border-left: none; border-color: #cbd5e1; font-size: 12px; font-weight: 500; color: #334155; width: 135px; border-top-right-radius: 8px; border-bottom-right-radius: 8px; height: 32px;">
                    </div>
                    <button type="submit" class="btn btn-sm text-white" style="background-color: #183543; border-radius: 8px; font-size: 12px; font-weight: 600; padding: 0 16px; border: none; height: 32px; transition: all 0.2s; box-shadow: 0 4px 6px -1px rgba(24, 53, 67, 0.15);">Apply</button>
                    @if(request('period') || request('start_date') || request('end_date'))
                        <a href="?" class="btn btn-sm btn-light d-inline-flex align-items-center justify-content-center" style="border-radius: 8px; font-size: 12px; font-weight: 600; padding: 0 12px; border: 1px solid #cbd5e1; height: 32px; background-color: #f8fafc;">Clear</a>
                    @endif
                </form>
            </div>
        </div>

        <!-- Analytics Section: Sales over Customers + Returning Customers Gauge -->
        <div class="row mt-4">
            <!-- Left: Mixed Chart -->
            <div class="col-lg-8 col-md-12 mb-4">
                <div class="card" style="border-radius: 20px; border: none; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.02); height: 100%; display: flex; flex-direction: column;">
                    <div class="card-header" style="background-color: transparent; border: none; padding: 24px 24px 0 24px;">
                        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
                            <!-- Chart Type Tabs -->
                            <div style="display: flex; gap: 20px; align-items: center;">
                                <span class="chart-type-tab active" onclick="switchChartType('sales', this)" style="cursor: pointer; font-size: 14px; font-weight: 600; color: #3498db; border-bottom: 2px solid #3498db; padding-bottom: 4px;">Sales</span>
                                <span class="chart-type-tab" onclick="switchChartType('revenue', this)" style="cursor: pointer; font-size: 14px; font-weight: 600; color: #a0aec0; padding-bottom: 4px;">Revenue</span>
                                <span class="chart-type-tab" onclick="switchChartType('customer', this)" style="cursor: pointer; font-size: 14px; font-weight: 600; color: #a0aec0; padding-bottom: 4px;">Customer</span>
                            </div>
                            <!-- Period / Location Tabs -->
                            <div style="display: flex; gap: 8px;">
                                <span class="chart-view-tab active" onclick="switchChartView('period', this)" style="background-color: #e2e8f0; padding: 6px 16px; border-radius: 8px; font-size: 12px; font-weight: 600; color: #2d3748; cursor: pointer; transition: all 0.2s ease;">Period</span>
                                <span class="chart-view-tab" onclick="switchChartView('location', this)" style="background-color: #edf2f7; padding: 6px 16px; border-radius: 8px; font-size: 12px; font-weight: 600; color: #718096; cursor: pointer; transition: all 0.2s ease;">Location</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="padding: 16px 24px 24px 24px; display: flex; flex-direction: column; justify-content: space-between; flex-grow: 1;">
                        <h5 id="chartTitle" style="font-size: 16px; font-weight: 600; color: #3498db; margin-bottom: 16px;">Sales over Customers</h5>
                        <div style="position: relative; height: 220px; width: 100%;">
                            <canvas id="salesCustomerChart"></canvas>
                        </div>
                        <div style="display: flex; justify-content: center; gap: 24px; margin-top: 12px;">
                            <div style="display: flex; align-items: center; gap: 6px;">
                                <span style="width: 14px; height: 3px; background-color: #3498db; border-radius: 2px;"></span>
                                <span id="legend0Label" style="font-size: 12px; color: #718096;">Customer</span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 6px;">
                                <span style="width: 14px; height: 3px; background-color: #e88e8e; border-radius: 2px;"></span>
                                <span id="legend1Label" style="font-size: 12px; color: #718096;">Sales</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Returning Customers Gauge -->
            <div class="col-lg-4 col-md-12 mb-4">
                <div class="card" style="border-radius: 20px; border: none; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.02); height: 100%; display: flex; flex-direction: column;">
                    <div class="card-header" style="background-color: transparent; border: none; padding: 24px 24px 0 24px;">
                        <div style="display: flex; gap: 24px; align-items: center; justify-content: center;">
                            <span class="gauge-tab active" onclick="switchGaugeTab('returning', this)" style="cursor: pointer; font-size: 13px; font-weight: 600; color: #2d3748; padding-bottom: 4px; text-align: center;">Returning Customers</span>
                            <span class="gauge-tab" onclick="switchGaugeTab('customer_visitors', this)" style="cursor: pointer; font-size: 13px; font-weight: 600; color: #a0aec0; padding-bottom: 4px; text-align: center;">Customer &  Visitors</span>
                        </div>
                    </div>
                    <div class="card-body" style="padding: 20px 24px; display: flex; flex-direction: column; align-items: center; justify-content: center; flex-grow: 1;">
                        <!-- Gauge -->
                        <div style="position: relative; width: 180px; height: 100px; margin-bottom: 10px;">
                            <canvas id="gaugeChart" width="180" height="100"></canvas>
                            <div style="position: absolute; bottom: 0; left: 50%; transform: translateX(-50%); text-align: center;">
                                <div id="gaugeValue" style="font-size: 32px; font-weight: 700; color: #e74c3c;">{{ $returningCustomersPercent }}%</div>
                                <div id="gaugeSubtext" style="font-size: 11px; font-weight: 600; color: #a0aec0; text-transform: uppercase; letter-spacing: 0.5px;">Rate</div>
                            </div>
                        </div>
                        <!-- Bottom Stats -->
                        <div style="display: flex; justify-content: space-around; width: 100%; margin-top: 20px; padding-top: 16px; border-top: 1px solid #edf2f7;">
                            <div style="text-align: center;">
                                <div id="gaugeLeftLabel" style="font-size: 11px; color: #a0aec0; font-weight: 600; margin-bottom: 4px;">Repeated</div>
                                <div id="returningVal" style="font-size: 22px; font-weight: 700; color: #2d3748;">{{ $returningCustomersCount }}</div>
                            </div>
                            <div style="text-align: center;">
                                <div id="gaugeRightLabel" style="font-size: 11px; color: #a0aec0; font-weight: 600; margin-bottom: 4px;">Total Buyers</div>
                                <div id="totalBuyersVal" style="font-size: 22px; font-weight: 700; color: #2d3748;">{{ $customerCount }}</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ================= NEW WIDGETS ROW 1 ================= -->
        <div class="row mt-4">
            <!-- Left: Category Sub Chart -->
            <div class="col-lg-8 col-md-12 mb-4">
                <div class="card" style="border-radius: 20px; border: none; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.02); height: 100%;">
                    <div class="card-header" style="background-color: transparent; border: none; padding: 24px 24px 0 24px;">
                        <div style="display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
                            <!-- Category Tabs -->
                            <div id="catsubTabsContainer" style="display: flex; gap: 20px; align-items: center; transition: all 0.2s;">
                                <span class="catsub-tab active" onclick="switchCatSubTab('All', this)" style="cursor: pointer; font-size: 14px; font-weight: 700; color: #ff7675; border-bottom: 2px solid #ff7675; padding-bottom: 4px; transition: all 0.2s;">All</span>
                                @if(in_array('Men', $activeTabKeys))
                                    <span class="catsub-tab" onclick="switchCatSubTab('Men', this)" style="cursor: pointer; font-size: 14px; font-weight: 600; color: #a0aec0; padding-bottom: 4px; transition: all 0.2s;">Men</span>
                                @endif
                                @if(in_array('Women', $activeTabKeys))
                                    <span class="catsub-tab" onclick="switchCatSubTab('Women', this)" style="cursor: pointer; font-size: 14px; font-weight: 600; color: #a0aec0; padding-bottom: 4px; transition: all 0.2s;">Women</span>
                                @endif
                                @if(in_array('Kids', $activeTabKeys))
                                    <span class="catsub-tab" onclick="switchCatSubTab('Kids', this)" style="cursor: pointer; font-size: 14px; font-weight: 600; color: #a0aec0; padding-bottom: 4px; transition: all 0.2s;">Kids</span>
                                @endif
                                @if(in_array('Living', $activeTabKeys))
                                    <span class="catsub-tab" onclick="switchCatSubTab('Living', this)" style="cursor: pointer; font-size: 14px; font-weight: 600; color: #a0aec0; padding-bottom: 4px; transition: all 0.2s;">Living</span>
                                @endif
                            </div>
                            <!-- Right Category/Offer Buttons -->
                            <div style="display: flex; gap: 8px;">
                                <span class="catsub-mode-tab active" onclick="switchCatSubMode('category', this)" style="background-color: #e2e8f0; padding: 6px 16px; border-radius: 8px; font-size: 12px; font-weight: 600; color: #2d3748; cursor: pointer; transition: all 0.2s ease;">Category</span>
                                <span class="catsub-mode-tab" onclick="switchCatSubMode('offer', this)" style="background-color: #edf2f7; padding: 6px 16px; border-radius: 8px; font-size: 12px; font-weight: 600; color: #718096; cursor: pointer; transition: all 0.2s ease;">Offer</span>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="padding: 16px 24px 24px 24px;">
                        <div style="position: relative; height: 260px; width: 100%;">
                            <canvas id="subcategoryMixChart"></canvas>
                        </div>
                        <!-- Legend -->
                        <div style="display: flex; justify-content: center; gap: 24px; margin-top: 16px; flex-wrap: wrap;">
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <span style="width: 24px; height: 12px; background-color: rgba(255, 118, 117, 0.35); border: 1.5px solid #ff7675; border-radius: 4px; display: inline-block;"></span>
                                <span style="font-size: 12px; color: #718096; font-weight: 600;">Sales</span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <span style="width: 16px; height: 3px; background-color: #3498db; border-radius: 2px; display: inline-block; position: relative; top: -1px;"></span>
                                <span style="font-size: 12px; color: #718096; font-weight: 600;">Products</span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 8px;">
                                <span style="width: 16px; height: 3px; background-color: #e67e22; border-radius: 2px; display: inline-block; position: relative; top: -1px;"></span>
                                <span style="font-size: 12px; color: #718096; font-weight: 600;">Customer</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Right: Total Orders Doughnut Chart -->
            <div class="col-lg-4 col-md-12 mb-4">
                <div class="card" style="border-radius: 20px; border: none; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.02); height: 100%; display: flex; flex-direction: column;">
                    <div class="card-header" style="background-color: transparent; border: none; padding: 24px 24px 0 24px;">
                        <h4 style="font-weight: 700; color: #1a202c; margin: 0; font-size: 18px;">Total Orders</h4>
                    </div>
                    <div class="card-body" style="padding: 12px 24px 20px 24px; display: flex; flex-direction: column; align-items: center; justify-content: center; flex-grow: 1;">
                        <div style="position: relative; width: 170px; height: 170px; margin-bottom: 15px;">
                            <canvas id="totalOrdersDoughnut" width="170" height="170"></canvas>
                            <div style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); text-align: center;">
                                <div style="font-size: 11px; font-weight: 600; color: #a0aec0; text-transform: uppercase; letter-spacing: 0.5px; line-height: 1;">Total</div>
                                <div style="font-size: 10px; font-weight: 600; color: #a0aec0; text-transform: uppercase; letter-spacing: 0.5px; line-height: 1; margin-bottom: 2px;">Orders</div>
                                <div style="font-size: 30px; font-weight: 800; color: #2d3748; line-height: 1;">{{ $doughnutTotal }}</div>
                            </div>
                        </div>
                        <div style="width: 100%; display: flex; flex-wrap: wrap; justify-content: center; gap: 8px 14px; border-top: 1px solid #edf2f7; padding-top: 12px; margin-top: auto;">
                            <div style="display: flex; align-items: center; gap: 6px; font-size: 12px; color: #718096; font-weight: 600; white-space: nowrap;">
                                <span style="width: 8px; height: 8px; border-radius: 2px; background-color: #3498db; display: inline-block;"></span>
                                <span>Pending: <b style="color: #2d3748;">{{ $doughnutStatuses['Pending'] }}</b></span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 6px; font-size: 12px; color: #718096; font-weight: 600; white-space: nowrap;">
                                <span style="width: 8px; height: 8px; border-radius: 2px; background-color: #9b59b6; display: inline-block;"></span>
                                <span>Accepted: <b style="color: #2d3748;">{{ $doughnutStatuses['Accepted'] }}</b></span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 6px; font-size: 12px; color: #718096; font-weight: 600; white-space: nowrap;">
                                <span style="width: 8px; height: 8px; border-radius: 2px; background-color: #ff7675; display: inline-block;"></span>
                                <span>Delivered: <b style="color: #2d3748;">{{ $doughnutStatuses['Delivered'] }}</b></span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 6px; font-size: 12px; color: #718096; font-weight: 600; white-space: nowrap;">
                                <span style="width: 8px; height: 8px; border-radius: 2px; background-color: #2ecc71; display: inline-block;"></span>
                                <span>Completed: <b style="color: #2d3748;">{{ $doughnutStatuses['Completed'] }}</b></span>
                            </div>
                            <div style="display: flex; align-items: center; gap: 6px; font-size: 12px; color: #718096; font-weight: 600; white-space: nowrap;">
                                <span style="width: 8px; height: 8px; border-radius: 2px; background-color: #00cec9; display: inline-block;"></span>
                                <span>Returned: <b style="color: #2d3748;">{{ $doughnutStatuses['Returned'] }}</b></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- ================= NEW WIDGETS ROW 2 ================= -->
        <div class="row">
            <!-- Left: Transaction Table -->
            <div class="col-lg-8 col-md-12 mb-4">
                <div class="card" style="border-radius: 20px; border: none; box-shadow: 0 10px 25px -5px rgba(0, 0, 0, 0.02); height: 100%;">
                    <div class="card-header" style="background-color: transparent; border: none; padding: 24px 24px 12px 24px; display: flex; justify-content: space-between; align-items: center; flex-wrap: wrap; gap: 12px;">
                        <div style="display: flex; align-items: center; gap: 10px;">
                            <h4 style="font-weight: 700; color: #1a202c; margin: 0; font-size: 18px;">Transaction</h4>
                            <a href="#" style="font-size: 12.5px; font-weight: 600; color: #5c67f2; text-decoration: none;">See History</a>
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
                                        <th style="font-size: 11px; font-weight: 600; color: #ffffff; text-transform: uppercase; padding: 12px 8px; text-align: right;"></th>
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
                                            <td style="padding: 16px 8px; text-align: right;">
                                                <i class="fa fa-ellipsis-h" style="color: #cbd5e1; cursor: pointer; font-size: 14px;"></i>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" style="text-align: center; padding: 40px; color: #a0aec0; font-size: 14px; font-weight: 500;">
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

</div>
</div>
<!-- Subscription Renewal Modal -->
<!-- Subscription Renewal Modal -->
<div class="modal fade" id="renewalModal" tabindex="-1" aria-labelledby="renewalModalLabel" aria-hidden="true" style="backdrop-filter: blur(8px); background-color: rgba(15, 23, 42, 0.3);">
    <div class="modal-dialog modal-xl modal-dialog-centered" style="max-width: 1250px;">
        <div class="modal-content" style="border-radius: 16px; border: none; box-shadow: 0 20px 40px -8px rgba(0, 0, 0, 0.15); overflow: hidden; background: #ffffff;">
            
            <!-- Modal Header -->
            <div class="modal-header" style="background: linear-gradient(135deg, #183543 0%, #0f2430 100%); border: none; padding: 18px 24px; display: flex; flex-direction: column; align-items: center; position: relative;">
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close" style="position: absolute; right: 18px; top: 18px; opacity: 0.8; transition: all 0.2s; border: none; background: transparent; color: white; font-size: 20px; font-weight: 300; line-height: 1; outline: none;">&times;</button>
                <h3 class="modal-title text-white" id="renewalModalLabel" style="font-weight: 800; font-size: 19px; margin-bottom: 4px; letter-spacing: -0.5px;">Subscription Renewal Plans</h3>
                <p style="color: #94a3b8; font-size: 12px; margin: 0; font-weight: 500; text-align: center;">Select the ideal plan to unlock premium features and accelerate your store's growth.</p>
                
                <!-- Sliding Pill Tab Selector -->
                <div style="display: flex; justify-content: center; margin-top: 14px; width: 100%;">
                    <div style="background-color: rgba(255, 255, 255, 0.08); border-radius: 30px; padding: 3px; display: flex; position: relative; width: 330px; border: 1px solid rgba(255, 255, 255, 0.1);">
                        <button type="button" class="duration-tab active" onclick="switchDurationGroup('12', this)" style="flex: 1; border: none; background: transparent; padding: 6px 12px; font-size: 11.5px; font-weight: 700; border-radius: 26px; cursor: pointer; transition: all 0.3s; color: #ffffff; z-index: 2; outline: none;">12 Months</button>
                        <button type="button" class="duration-tab" onclick="switchDurationGroup('3', this)" style="flex: 1; border: none; background: transparent; padding: 6px 12px; font-size: 11.5px; font-weight: 700; border-radius: 26px; cursor: pointer; transition: all 0.3s; color: #94a3b8; z-index: 2; outline: none;">3 Months</button>
                        <button type="button" class="duration-tab" onclick="switchDurationGroup('1', this)" style="flex: 1; border: none; background: transparent; padding: 6px 12px; font-size: 11.5px; font-weight: 700; border-radius: 26px; cursor: pointer; transition: all 0.3s; color: #94a3b8; z-index: 2; outline: none;">1 Month</button>
                        <!-- Sliding Background Pill -->
                        <div id="durationPillBg" style="position: absolute; top: 3px; bottom: 3px; left: 3px; width: 106px; background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); border-radius: 26px; transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1); z-index: 1; box-shadow: 0 3px 8px rgba(29, 78, 216, 0.3);"></div>
                    </div>
                </div>
            </div>

            <!-- Modal Body -->
            <div class="modal-body" style="padding: 20px; background-color: #f8fafc;">
                <div class="row g-3 justify-content-center" id="packageCardsRow" style="min-height: 300px;">
                    <!-- Cards will be dynamically injected here via JS -->
                </div>
            </div>

        </div>
    </div>
</div>

<style>
    .pricing-features-scroll::-webkit-scrollbar {
        width: 5px;
    }
    .pricing-features-scroll::-webkit-scrollbar-track {
        background: transparent;
    }
    .pricing-features-scroll::-webkit-scrollbar-thumb {
        background: #cbd5e1;
        border-radius: 10px;
    }
    .pricing-card {
        transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
    }
    .pricing-card:hover {
        transform: translateY(-6px) !important;
    }
</style>
@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
<script>
    // === Vendor Status Toggle ===
    function toggleVendorStatus() {
        var btn = $('#vendorStatusBtn');
        btn.prop('disabled', true);
        
        $.ajax({
            url: "{{ route('vendor.toggle_status') }}",
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                btn.prop('disabled', false);
                if (response.success) {
                    var isNowActive = (parseInt(response.status) === 1);
                    
                    // Update UI style dynamically
                    if (isNowActive) {
                        btn.css({
                            'background-color': 'rgba(46, 204, 113, 0.25)',
                            'color': '#2ecc71',
                            'border-color': 'rgba(46, 204, 113, 0.4)'
                        });
                        $('#vendorStatusDot').css('background-color', '#2ecc71');
                        $('#vendorStatusText').text('Active');
                        
                        // Toast notification
                        Swal.fire({
                            icon: 'success',
                            title: 'Status updated to Active',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true
                        });
                    } else {
                        btn.css({
                            'background-color': 'rgba(231, 76, 60, 0.25)',
                            'color': '#e74c3c',
                            'border-color': 'rgba(231, 76, 60, 0.4)'
                        });
                        $('#vendorStatusDot').css('background-color', '#e74c3c');
                        $('#vendorStatusText').text('Inactive');
                        
                        Swal.fire({
                            icon: 'warning',
                            title: 'Status updated to Inactive',
                            toast: true,
                            position: 'top-end',
                            showConfirmButton: false,
                            timer: 3000,
                            timerProgressBar: true
                        });
                    }
                } else {
                    Swal.fire({
                        title: 'Error',
                        text: response.message || 'Failed to update status.',
                        icon: 'error',
                        confirmButtonColor: '#183543'
                    });
                }
            },
            error: function(xhr) {
                btn.prop('disabled', false);
                Swal.fire({
                    title: 'Error',
                    text: 'An error occurred while updating status. Please try again.',
                    icon: 'error',
                    confirmButtonColor: '#183543'
                });
            }
        });
    }

    // === Subscription Renewal Package Setup ===
    // Dynamically load SweetAlert2 if not already present
    if (typeof Swal === 'undefined') {
        var sweetalertScript = document.createElement('script');
        sweetalertScript.src = 'https://cdn.jsdelivr.net/npm/sweetalert2@11';
        document.head.appendChild(sweetalertScript);
    }

    var currentVendorPackageId = {{ $vendorDetails->package_id ?? 0 }};
    var dbPackages = @json($packages);
    var packageGroups = {
        '12': [],
        '3': [],
        '1': []
    };

    dbPackages.forEach(function(pkg) {
        var validity = parseInt(pkg.validity);
        var groupKey = '1';
        if (validity >= 360) {
            groupKey = '12';
        } else if (validity >= 80) {
            groupKey = '3';
        }
        
        // Parse features list from description HTML
        var tempDiv = document.createElement('div');
        tempDiv.innerHTML = pkg.description;
        var features = [];
        var lis = tempDiv.querySelectorAll('li');
        lis.forEach(function(li) {
            features.push(li.textContent.trim());
        });

        // Determine type of plan based on name
        var lowerName = pkg.name.toLowerCase();
        var type = 'startup';
        if (lowerName.includes('business')) {
            type = 'business';
        } else if (lowerName.includes('premium') || lowerName.includes('professional')) {
            type = 'premium';
        } else if (lowerName.includes('enterprise')) {
            type = 'enterprise';
        }

        packageGroups[groupKey].push({
            id: pkg.id,
            name: pkg.name.split(' (')[0], // e.g. "Start-Up"
            price: parseFloat(pkg.price),
            validity: pkg.validity,
            days: pkg.days,
            type: type,
            features: features
        });
    });

    // Sort packages within each group to ensure order: Startup, Business, Premium, Enterprise
    var typeOrder = { 'startup': 0, 'business': 1, 'premium': 2, 'enterprise': 3 };
    Object.keys(packageGroups).forEach(function(key) {
        packageGroups[key].sort(function(a, b) {
            return typeOrder[a.type] - typeOrder[b.type];
        });
    });

    function openRenewalModal() {
        // Show the modal
        var modalEl = document.getElementById('renewalModal');
        var modal = bootstrap.Modal.getInstance(modalEl);
        if (!modal) {
            modal = new bootstrap.Modal(modalEl);
        }
        modal.show();

        // Trigger duration slide after modal is shown to ensure correct dimensions are calculated
        setTimeout(function() {
            var activeTab = document.querySelector('.duration-tab.active');
            if (activeTab) {
                switchDurationGroup('12', activeTab);
            }
        }, 200);
    }

    function switchDurationGroup(groupKey, el) {
        // Update active class on buttons
        document.querySelectorAll('.duration-tab').forEach(function(btn) {
            btn.classList.remove('active');
            btn.style.color = '#94a3b8';
        });
        el.classList.add('active');
        el.style.color = '#ffffff';

        // Slide the background pill
        var pill = document.getElementById('durationPillBg');
        var width = el.offsetWidth;
        pill.style.width = width + 'px';
        pill.style.left = (el.offsetLeft) + 'px';

        // Render the cards for this group
        renderPackageCards(groupKey);
    }

    function renderPackageCards(durationKey) {
        var cards = packageGroups[durationKey] || [];
        var row = document.getElementById('packageCardsRow');
        row.innerHTML = '';

        cards.forEach(function(pkg) {
            var colors = {
                startup: { primary: '#0ca678', bgGradient: 'linear-gradient(135deg, #e6fcf5 0%, #c3fae8 100%)', text: '#094080' },
                business: { primary: '#3b82f6', bgGradient: 'linear-gradient(135deg, #eff6ff 0%, #dbeafe 100%)', text: '#1e3a8a' },
                premium: { primary: '#9b59b6', bgGradient: 'linear-gradient(135deg, #faf5ff 0%, #f3e8ff 100%)', text: '#581c87' },
                enterprise: { primary: '#f59e0b', bgGradient: 'linear-gradient(135deg, #fffbeb 0%, #fef3c7 100%)', text: '#78350f' }
            };
            var theme = colors[pkg.type] || colors.startup;

            var isCurrentPlan = (pkg.id == currentVendorPackageId);
            var cardStyle = 'border-radius: 14px; border: 1.5px solid #e2e8f0; background: #ffffff; padding: 16px 14px; height: 100%; display: flex; flex-direction: column; position: relative; transition: all 0.3s ease; box-shadow: 0 4px 6px -1px rgba(0,0,0,0.02);';
            var popularBadgeHtml = '';
            var currentPlanBadgeHtml = '';

            if (pkg.type === 'business') {
                cardStyle = 'border-radius: 14px; border: 2.5px solid #3b82f6; background: #ffffff; padding: 16px 14px; height: 100%; display: flex; flex-direction: column; position: relative; transition: all 0.3s ease; box-shadow: 0 8px 20px -5px rgba(59, 130, 246, 0.15); transform: scale(1.01);';
                popularBadgeHtml = '<div style="position: absolute; top: -11px; left: 50%; transform: translateX(-50%); background: linear-gradient(135deg, #3b82f6 0%, #1d4ed8 100%); color: #ffffff; padding: 2px 10px; border-radius: 20px; font-size: 9px; font-weight: 800; text-transform: uppercase; letter-spacing: 0.5px; box-shadow: 0 3px 6px rgba(29, 78, 216, 0.25); white-space: nowrap; z-index: 10;">Most Popular</div>';
            }

            if (isCurrentPlan) {
                cardStyle += ' border-color: #0ca678; box-shadow: 0 8px 20px -5px rgba(12, 166, 120, 0.15);';
                currentPlanBadgeHtml = '<div style="position: absolute; top: 8px; right: 8px; background: #e6fcf5; color: #0ca678; border: 1px solid #c3fae8; padding: 1px 6px; border-radius: 12px; font-size: 8px; font-weight: 700; text-transform: uppercase; z-index: 10;">Current Plan</div>';
            }

            var featuresHtml = '';
            pkg.features.forEach(function(feat) {
                featuresHtml += `
                    <div style="display: flex; align-items: flex-start; gap: 7px; margin-bottom: 7px; font-size: 11.5px; color: #4a5568; font-weight: 500; line-height: 1.3;">
                        <i class="fa fa-check-circle" style="color: ${theme.primary}; font-size: 13px; margin-top: 1px; flex-shrink: 0;"></i>
                        <span>${feat}</span>
                    </div>`;
            });

            var col = document.createElement('div');
            col.className = 'col-lg-3 col-md-6 mb-3';
            col.innerHTML = `
                <div class="pricing-card" style="${cardStyle}">
                    ${popularBadgeHtml}
                    ${currentPlanBadgeHtml}
                    
                    <div style="text-align: center; margin-bottom: 10px;">
                        <h5 style="font-size: 13px; font-weight: 700; color: #64748b; margin-bottom: 6px; text-transform: uppercase; letter-spacing: 0.5px;">${pkg.name}</h5>
                        
                        <div style="background: ${theme.bgGradient}; border-radius: 30px; padding: 4px 10px; display: inline-flex; align-items: center; justify-content: center; gap: 3px; border: 1px solid rgba(0,0,0,0.02); min-width: 110px;">
                           <span style="font-size: 12px; font-weight: 800; color: ${theme.primary}; align-self: flex-start; margin-top: 1px;">₹</span>
                           <span style="font-size: 18px; font-weight: 800; color: ${theme.primary}; line-height: 1;">${pkg.price.toLocaleString('en-IN')}</span>
                           <span style="font-size: 10px; font-weight: 600; color: #718096; margin-left: 1px; align-self: flex-end; margin-bottom: 1px;">/ ${pkg.days} days</span>
                        </div>
                    </div>

                    <div class="pricing-features-scroll" style="flex-grow: 1; overflow-y: auto; max-height: 150px; padding-right: 2px; margin-bottom: 12px; border-bottom: 1px solid #edf2f7; border-top: 1px solid #edf2f7; padding: 8px 0;">
                        ${featuresHtml}
                    </div>

                    <button type="button" class="btn w-100" onclick="selectRenewalPlan(${pkg.id}, '${pkg.name}', ${pkg.price})" style="background: ${isCurrentPlan ? 'linear-gradient(135deg, #0ca678 0%, #087f5b 100%)' : 'linear-gradient(135deg, #183543 0%, #0f2430 100%)'}; color: #ffffff; border: none; border-radius: 8px; padding: 6px 10px; font-size: 11.5px; font-weight: 700; transition: all 0.2s; box-shadow: 0 3px 6px rgba(0,0,0,0.05); display: flex; align-items: center; justify-content: center; gap: 6px;">
                        <span>${isCurrentPlan ? 'Renew Plan' : 'Upgrade Plan'}</span>
                        <i class="fa fa-arrow-right" style="font-size: 10px;"></i>
                    </button>
                </div>
            `;
            row.appendChild(col);
        });
    }

    function selectRenewalPlan(packageId, packageName, price) {
        if (typeof Swal === 'undefined') {
            alert('Please wait a moment while the interface loads, or try again.');
            return;
        }

        Swal.fire({
            title: 'Confirm Subscription Update',
            html: `You have selected the <strong>${packageName}</strong> plan.<br><br><span style="font-size: 18px; font-weight: 700; color: #183543;">Amount Payable: ₹${price.toLocaleString('en-IN')}</span>`,
            icon: 'info',
            showCancelButton: true,
            confirmButtonText: 'Proceed to Payment',
            cancelButtonText: 'Cancel',
            confirmButtonColor: '#183543',
            cancelButtonColor: '#718096',
            background: '#ffffff'
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire({
                    title: 'Processing Payment...',
                    html: 'Simulating secure payment gateway connection. Please do not close this window.',
                    allowOutsideClick: false,
                    didOpen: () => {
                        Swal.showLoading();
                        
                        // Submit AJAX call to renew plan
                        $.ajax({
                            url: "{{ route('vendor.renew_package') }}",
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                                package_id: packageId
                            },
                            success: function(response) {
                                if (response.success) {
                                    setTimeout(function() {
                                        Swal.fire({
                                            title: 'Plan Activated!',
                                            text: 'Your plan has been updated successfully to ' + response.plan_name + '! Expiring on: ' + response.expired_date,
                                            icon: 'success',
                                            confirmButtonColor: '#0ca678'
                                        }).then(() => {
                                            window.location.reload();
                                        });
                                    }, 1500);
                                } else {
                                    Swal.fire({
                                        title: 'Error',
                                        text: response.message || 'Failed to update plan.',
                                        icon: 'error',
                                        confirmButtonColor: '#183543'
                                    });
                                }
                            },
                            error: function(xhr) {
                                var msg = 'Failed to process renewal. Please try again.';
                                if (xhr.responseJSON && xhr.responseJSON.message) {
                                    msg = xhr.responseJSON.message;
                                }
                                Swal.fire({
                                    title: 'Transaction Failed',
                                    text: msg,
                                    icon: 'error',
                                    confirmButtonColor: '#183543'
                                });
                            }
                        });
                    }
                });
            }
        });
    }

    // === Active Orders Tab Switcher ===
    function switchActiveTab(tabName, btnElement) {
        document.querySelectorAll('.tab-panel-content').forEach(function(el) {
            el.style.display = 'none';
        });
        document.querySelectorAll('.tab-btn').forEach(function(btn) {
            btn.classList.remove('active');
        });
        document.getElementById('tab-' + tabName).style.display = 'block';
        btnElement.classList.add('active');
    }

    // === Chart Data from Controller ===
    var currentChartType = sessionStorage.getItem('currentChartType') || 'sales';
    var currentChartViewMode = sessionStorage.getItem('currentChartViewMode') || 'period';

    var periodLabels = @json($salesTrendLabels);
    var periodRevenue = @json($salesTrendRevenue);
    var periodSales = @json($salesTrendOrders);
    var periodCustomers = @json($salesTrendCustomers);
    var periodVisitors = @json($salesTrendVisitors);

    var locationLabels = @json($locationLabels);
    var locationRevenue = @json($locationRevenue);
    var locationSales = @json($locationSales);
    var locationCustomers = @json($locationCustomers);
    var locationVisitors = @json($locationVisitors);

    // Initial references for chart creation
    var chartLabels = periodLabels;
    var customerData = periodCustomers;
    var salesData = periodSales;
    var revenueData = periodRevenue;
    var visitorData = periodVisitors;
    var returningPercent = {{ $returningCustomersPercent }};
    var returningCount = {{ $returningCustomersCount }};
    var totalBuyers = {{ $customerCount }};
    var totalViewers = {{ $totalViews }};

    // === Mixed Area + Line Chart ===
    var ctx = document.getElementById('salesCustomerChart').getContext('2d');
    var salesCustomerChart = new Chart(ctx, {
        type: 'line',
        data: {
            labels: chartLabels,
            datasets: [
                {
                    label: 'Customer',
                    data: customerData.length ? customerData : Array(chartLabels.length).fill(0),
                    borderColor: '#3498db',
                    backgroundColor: 'rgba(52, 152, 219, 0.12)',
                    fill: true,
                    tension: 0.4,
                    borderWidth: 2.5,
                    pointRadius: 4,
                    pointBackgroundColor: '#3498db',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointHoverRadius: 6,
                    order: 1,
                    yAxisID: 'y'
                },
                {
                    label: 'Sales',
                    data: salesData,
                    borderColor: '#e88e8e',
                    backgroundColor: 'transparent',
                    fill: false,
                    tension: 0.4,
                    borderWidth: 2.5,
                    pointRadius: 4,
                    pointBackgroundColor: '#e88e8e',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    pointHoverRadius: 6,
                    order: 0,
                    yAxisID: 'y'
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            interaction: { mode: 'index', intersect: false },
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#2d3748',
                    titleFont: { size: 12, weight: '600' },
                    bodyFont: { size: 12 },
                    padding: 10,
                    cornerRadius: 8,
                    callbacks: {
                        label: function(context) {
                            var label = context.dataset.label || '';
                            if (label) {
                                label += ': ';
                            }
                            if (context.dataset.label === 'Revenue') {
                                label += '₹' + context.parsed.y.toLocaleString();
                            } else {
                                label += context.parsed.y;
                            }
                            return label;
                        }
                    }
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 11, weight: '500' }, color: '#a0aec0' }
                },
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    grid: { color: 'rgba(0,0,0,0.04)' },
                    ticks: {
                        font: { size: 11 },
                        color: '#a0aec0',
                        callback: function(value, index, values) {
                            if (salesCustomerChart && salesCustomerChart.data.datasets[1].label === 'Revenue') {
                                return '₹' + value;
                            }
                            return value;
                        }
                    },
                    beginAtZero: true
                },
                y1: {
                    type: 'linear',
                    display: false,
                    position: 'right',
                    grid: { drawOnChartArea: false },
                    ticks: { font: { size: 11 }, color: '#a0aec0' },
                    beginAtZero: true
                }
            }
        }
    });

    // === Restore Chart Tab Styles and Render on Page Load ===
    (function() {
        // Restore Chart Type Tab Active Styling
        var typeTabs = document.querySelectorAll('.chart-type-tab');
        typeTabs.forEach(function(tab) {
            var onclickAttr = tab.getAttribute('onclick');
            if (onclickAttr && onclickAttr.includes(currentChartType)) {
                tab.classList.add('active');
                tab.style.color = '#3498db';
                tab.style.borderBottom = '2px solid #3498db';
            } else {
                tab.classList.remove('active');
                tab.style.color = '#a0aec0';
                tab.style.borderBottom = 'none';
            }
        });

        // Restore Chart View Mode Tab (Period / Location)
        var viewTabs = document.querySelectorAll('.chart-view-tab');
        viewTabs.forEach(function(tab) {
            var onclickAttr = tab.getAttribute('onclick');
            if (onclickAttr && onclickAttr.includes(currentChartViewMode)) {
                tab.classList.add('active');
                tab.style.color = '#2d3748';
                tab.style.backgroundColor = '#e2e8f0';
            } else {
                tab.classList.remove('active');
                tab.style.color = '#718096';
                tab.style.backgroundColor = '#edf2f7';
            }
        });

        // Trigger initial render with correct datasets
        updateMainChart();
    })();

    // === Chart Type Tab Switcher ===
    function switchChartType(type, el) {
        document.querySelectorAll('.chart-type-tab').forEach(function(tab) {
            tab.classList.remove('active');
            tab.style.color = '#a0aec0';
            tab.style.borderBottom = 'none';
        });
        el.classList.add('active');
        el.style.color = '#3498db';
        el.style.borderBottom = '2px solid #3498db';

        currentChartType = type;
        sessionStorage.setItem('currentChartType', type);
        updateMainChart();
    }

    // === Chart View Mode Switcher (Period / Location) ===
    function switchChartView(mode, el) {
        document.querySelectorAll('.chart-view-tab').forEach(function(tab) {
            tab.classList.remove('active');
            tab.style.color = '#718096';
            tab.style.backgroundColor = '#edf2f7';
        });
        el.classList.add('active');
        el.style.color = '#2d3748';
        el.style.backgroundColor = '#e2e8f0';

        currentChartViewMode = mode;
        sessionStorage.setItem('currentChartViewMode', mode);
        updateMainChart();
    }

    // === Unified Chart Update Function ===
    function updateMainChart() {
        var titleEl = document.getElementById('chartTitle');
        var legend0Label = document.getElementById('legend0Label');
        var legend1Label = document.getElementById('legend1Label');

        var labelsSource = (currentChartViewMode === 'location') ? locationLabels : periodLabels;
        var revenueSource = (currentChartViewMode === 'location') ? locationRevenue : periodRevenue;
        var salesSource = (currentChartViewMode === 'location') ? locationSales : periodSales;
        var customerSource = (currentChartViewMode === 'location') ? locationCustomers : periodCustomers;
        var visitorSource = (currentChartViewMode === 'location') ? locationVisitors : periodVisitors;

        salesCustomerChart.data.labels = labelsSource;

        if (currentChartType === 'sales') {
            salesCustomerChart.data.datasets[0].label = 'Customer';
            salesCustomerChart.data.datasets[0].data = customerSource;
            salesCustomerChart.data.datasets[0].yAxisID = 'y';
            
            salesCustomerChart.data.datasets[1].label = 'Sales';
            salesCustomerChart.data.datasets[1].data = salesSource;
            salesCustomerChart.data.datasets[1].yAxisID = 'y';
            
            salesCustomerChart.options.scales.y1.display = false;
            titleEl.textContent = (currentChartViewMode === 'location') ? 'Sales over Customers by Location' : 'Sales over Customers';
            if(legend0Label) legend0Label.textContent = 'Customer';
            if(legend1Label) legend1Label.textContent = 'Sales';
        } else if (currentChartType === 'revenue') {
            salesCustomerChart.data.datasets[0].label = 'Sales';
            salesCustomerChart.data.datasets[0].data = salesSource;
            salesCustomerChart.data.datasets[0].yAxisID = 'y1';
            
            salesCustomerChart.data.datasets[1].label = 'Revenue';
            salesCustomerChart.data.datasets[1].data = revenueSource;
            salesCustomerChart.data.datasets[1].yAxisID = 'y';
            
            salesCustomerChart.options.scales.y1.display = true;
            titleEl.textContent = (currentChartViewMode === 'location') ? 'Revenue over Sales by Location' : 'Revenue over Sales';
            if(legend0Label) legend0Label.textContent = 'Sales';
            if(legend1Label) legend1Label.textContent = 'Revenue';
        } else if (currentChartType === 'customer') {
            salesCustomerChart.data.datasets[0].label = 'Visitors';
            salesCustomerChart.data.datasets[0].data = visitorSource;
            salesCustomerChart.data.datasets[0].yAxisID = 'y';
            
            salesCustomerChart.data.datasets[1].label = 'Customer';
            salesCustomerChart.data.datasets[1].data = customerSource;
            salesCustomerChart.data.datasets[1].yAxisID = 'y';
            
            salesCustomerChart.options.scales.y1.display = false;
            titleEl.textContent = (currentChartViewMode === 'location') ? 'Customer over Visitors by Location' : 'Customer over Visitors';
            if(legend0Label) legend0Label.textContent = 'Visitors';
            if(legend1Label) legend1Label.textContent = 'Customer';
        }
        salesCustomerChart.update();
    }

    // === Gauge Chart (Half-Doughnut) ===
    var gaugeCtx = document.getElementById('gaugeChart').getContext('2d');
    var gaugeChart = new Chart(gaugeCtx, {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [returningPercent, 100 - returningPercent],
                backgroundColor: ['#e74c3c', '#edf2f7'],
                borderWidth: 0
            }]
        },
        options: {
            responsive: false,
            rotation: -90,
            circumference: 180,
            cutout: '78%',
            plugins: {
                legend: { display: false },
                tooltip: { enabled: false }
            }
        }
    });

    // === Gauge Tab Switcher ===
    function switchGaugeTab(type, el) {
        document.querySelectorAll('.gauge-tab').forEach(function(tab) {
            tab.classList.remove('active');
            tab.style.color = '#a0aec0';
        });
        el.classList.add('active');
        el.style.color = '#2d3748';

        var gaugeVal = document.getElementById('gaugeValue');
        var gaugeSub = document.getElementById('gaugeSubtext');
        var leftLabel = document.getElementById('gaugeLeftLabel');
        var rightLabel = document.getElementById('gaugeRightLabel');
        var leftVal = document.getElementById('returningVal');
        var rightVal = document.getElementById('totalBuyersVal');

        if (type === 'returning') {
            gaugeChart.data.datasets[0].data = [returningPercent, 100 - returningPercent];
            gaugeVal.textContent = returningPercent + '%';
            gaugeSub.textContent = 'Rate';
            leftLabel.textContent = 'Repeated';
            rightLabel.textContent = 'Total Buyers';
            leftVal.textContent = returningCount;
            rightVal.textContent = totalBuyers;
        } else if (type === 'customer_visitors') {
            var conversionPercent = totalViewers > 0 ? Math.min(100, Math.round((totalBuyers / totalViewers) * 100)) : 0;
            gaugeChart.data.datasets[0].data = [conversionPercent, 100 - conversionPercent];
            gaugeVal.textContent = conversionPercent + '%';
            gaugeSub.textContent = 'Conversion';
            leftLabel.textContent = 'Customers';
            rightLabel.textContent = 'Total Visitors';
            leftVal.textContent = totalBuyers;
            rightVal.textContent = totalViewers;
        }
        gaugeChart.update();
    }

    // === Category Subcategory Mixed Chart ===
    var catsubStats = @json($subcategoryStats);
    var offerStats = @json($offerStats);
    var currentCatsubTab = 'All';
    var currentCatsubMode = 'category';

    var subCtx = document.getElementById('subcategoryMixChart').getContext('2d');
    var subcategoryMixChart = new Chart(subCtx, {
        type: 'bar',
        data: {
            labels: catsubStats[currentCatsubTab].labels,
            datasets: [
                {
                    label: 'Sales',
                    type: 'bar',
                    data: catsubStats[currentCatsubTab].sales,
                    backgroundColor: 'rgba(255, 118, 117, 0.35)',
                    borderColor: '#ff7675',
                    borderWidth: 1.5,
                    borderRadius: 8,
                    borderSkipped: false,
                    barThickness: 24,
                    order: 2
                },
                {
                    label: 'Products',
                    type: 'line',
                    data: catsubStats[currentCatsubTab].products,
                    borderColor: '#3498db',
                    backgroundColor: 'transparent',
                    borderWidth: 3,
                    pointRadius: 4,
                    pointBackgroundColor: '#3498db',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    tension: 0.35,
                    order: 1
                },
                {
                    label: 'Customer',
                    type: 'line',
                    data: catsubStats[currentCatsubTab].customers,
                    borderColor: '#e67e22',
                    backgroundColor: 'transparent',
                    borderWidth: 3,
                    pointRadius: 4,
                    pointBackgroundColor: '#e67e22',
                    pointBorderColor: '#ffffff',
                    pointBorderWidth: 2,
                    tension: 0.35,
                    order: 0
                }
            ]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            plugins: {
                legend: { display: false },
                tooltip: {
                    backgroundColor: '#2d3748',
                    titleFont: { size: 12, weight: '600' },
                    bodyFont: { size: 12 },
                    padding: 10,
                    cornerRadius: 8
                }
            },
            scales: {
                x: {
                    grid: { display: false },
                    ticks: { font: { size: 11, weight: '600' }, color: '#4a5568' }
                },
                y: {
                    grid: { color: 'rgba(0,0,0,0.04)' },
                    ticks: { font: { size: 11 }, color: '#a0aec0' },
                    beginAtZero: true
                }
            }
        }
    });

    function switchCatSubTab(tabName, el) {
        document.querySelectorAll('.catsub-tab').forEach(function(tab) {
            tab.classList.remove('active');
            tab.style.color = '#a0aec0';
            tab.style.borderBottom = 'none';
            tab.style.fontWeight = '600';
        });
        el.classList.add('active');
        el.style.color = '#ff7675';
        el.style.borderBottom = '2px solid #ff7675';
        el.style.fontWeight = '700';

        currentCatsubTab = tabName;

        if (currentCatsubMode === 'category') {
            subcategoryMixChart.data.labels = catsubStats[currentCatsubTab].labels;
            subcategoryMixChart.data.datasets[0].data = catsubStats[currentCatsubTab].sales;
            subcategoryMixChart.data.datasets[1].data = catsubStats[currentCatsubTab].products;
            subcategoryMixChart.data.datasets[2].data = catsubStats[currentCatsubTab].customers;
        } else {
            var ds = offerStats[currentCatsubTab] || { labels: [], sales: [], products: [], customers: [] };
            subcategoryMixChart.data.labels = ds.labels;
            subcategoryMixChart.data.datasets[0].data = ds.sales;
            subcategoryMixChart.data.datasets[1].data = ds.products;
            subcategoryMixChart.data.datasets[2].data = ds.customers;
        }
        subcategoryMixChart.update();
    }

    function switchCatSubMode(mode, el) {
        document.querySelectorAll('.catsub-mode-tab').forEach(function(tab) {
            tab.classList.remove('active');
            tab.style.color = '#718096';
            tab.style.backgroundColor = '#edf2f7';
        });
        el.classList.add('active');
        el.style.color = '#2d3748';
        el.style.backgroundColor = '#e2e8f0';

        currentCatsubMode = mode;
        var tabsContainer = document.getElementById('catsubTabsContainer');

        // Keep category tabs visible in both modes as requested
        if (tabsContainer) tabsContainer.style.display = 'flex';

        if (mode === 'category') {
            subcategoryMixChart.data.labels = catsubStats[currentCatsubTab].labels;
            subcategoryMixChart.data.datasets[0].data = catsubStats[currentCatsubTab].sales;
            subcategoryMixChart.data.datasets[1].data = catsubStats[currentCatsubTab].products;
            subcategoryMixChart.data.datasets[2].data = catsubStats[currentCatsubTab].customers;
        } else {
            var ds = offerStats[currentCatsubTab] || { labels: [], sales: [], products: [], customers: [] };
            subcategoryMixChart.data.labels = ds.labels;
            subcategoryMixChart.data.datasets[0].data = ds.sales;
            subcategoryMixChart.data.datasets[1].data = ds.products;
            subcategoryMixChart.data.datasets[2].data = ds.customers;
        }
        subcategoryMixChart.update();
    }

    // === Total Orders Doughnut Chart ===
    var doughnutCounts = @json($doughnutStatuses);
    var hasData = Object.values(doughnutCounts).some(function(v) { return v > 0; });
    var doughnutData = hasData 
        ? [doughnutCounts.Pending, doughnutCounts.Accepted, doughnutCounts.Delivered, doughnutCounts.Completed, doughnutCounts.Returned]
        : [1];
    var doughnutColors = hasData
        ? ['#3498db', '#9b59b6', '#ff7675', '#2ecc71', '#00cec9']
        : ['#edf2f7'];

    var doughnutCtx = document.getElementById('totalOrdersDoughnut').getContext('2d');
    var totalOrdersDoughnut = new Chart(doughnutCtx, {
        type: 'doughnut',
        data: {
            labels: hasData ? ['Pending', 'Accepted', 'Delivered', 'Completed', 'Returned'] : ['No Orders'],
            datasets: [{
                data: doughnutData,
                backgroundColor: doughnutColors,
                borderWidth: hasData ? 4 : 1,
                borderColor: '#ffffff',
                hoverBorderColor: '#ffffff'
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            cutout: '72%',
            plugins: {
                legend: { display: false },
                tooltip: {
                    enabled: hasData,
                    backgroundColor: '#2d3748',
                    titleFont: { size: 12, weight: '600' },
                    bodyFont: { size: 12 },
                    padding: 10,
                    cornerRadius: 8
                }
            }
        }
    });

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
</script>
@endpush

@endsection