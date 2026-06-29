@extends('layout.auth.master')
@section('contents')



<!-- page-wrapper Start-->
@include('paritials.auth.topmenu');
<!-- Page Header Ends -->

<!-- Page Body Start-->
<div class="page-body-wrapper">
	
	<!-- Page Sidebar Start-->
	@include('paritials.staffauth.sidemenu');
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

        <!-- Container-fluid starts (Top Stats & Employee Card) -->
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
                                @if($staffDetails->profileimage && $staffDetails->profileimage != '-' && file_exists(public_path('assets/images/staffcreate/' . $staffDetails->profileimage)))
                                    <img class="employee-avatar" src="{{ asset('assets/images/staffcreate/' . $staffDetails->profileimage) }}" alt="Staff Photo">
                                @elseif($staffDetails->profileimage && $staffDetails->profileimage != '-' && file_exists(public_path('assets/images/dashboard/staff/' . $staffDetails->profileimage)))
                                    <img class="employee-avatar" src="{{ asset('assets/images/dashboard/staff/' . $staffDetails->profileimage) }}" alt="Staff Photo">
                                @else
                                    <img class="employee-avatar" src="{{ asset('assets/images/dashboard/man.jpeg') }}" alt="Staff Photo">
                                @endif
                            </div>
                            <div class="employee-info-main">
                                <div class="employee-name text-truncate" title="{{ $staffDetails->fullname }}">{{ $staffDetails->fullname }}</div>
                                <div class="employee-role text-truncate">{{ $staffDetails->designation }}</div>
                                <div class="employee-address" style="display: -webkit-box; -webkit-line-clamp: 2; -webkit-box-orient: vertical; overflow: hidden; height: 38px;">
                                    {{ $staffDetails->curr_addr ?? 'Address not specified' }}
                                </div>
                                <div class="employee-zone">
                                    Zone - {{ $staffDetails->zone_id ?? 'N/A' }}
                                </div>
                            </div>
                        </div>
                        
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
                        <!-- Card 1: Completed Orders Total Value -->
                        <div class="metric-card-custom card-style-val">
                            <div class="metric-card-label">Completed orders total value</div>
                            <div class="metric-card-value">₹{{ number_format(($completedOrdersTotalValueSum ?? 0) / 1000, 1) }}K</div>
                        </div>
                        
                        <!-- Card 2: Orders -->
                        <div class="metric-card-custom card-style-orders">
                            <div class="metric-card-label"># completed orders</div>
                            <div class="metric-card-value">{{ $orderCount ?? 0 }}</div>
                        </div>
                        
                        <!-- Card 3: Products -->
                        <div class="metric-card-custom card-style-products">
                            <div class="metric-card-label">Products</div>
                            <div class="metric-card-value">{{ $productCount ?? 0 }}</div>
                        </div>
                        
                        <!-- Card 4: Customers -->
                        <div class="metric-card-custom card-style-customers">
                            <div class="metric-card-label">Customers</div>
                            <div class="metric-card-value">{{ $customerCount ?? 0 }}</div>
                        </div>
                        
                        <!-- Card 5: Vendors -->
                        <div class="metric-card-custom card-style-vendors">
                            <div class="metric-card-label">Vendors</div>
                            <div class="metric-card-value">{{ $vendorCount ?? 0 }}</div>
                        </div>
                        
                        <!-- Card 6: Viewers -->
                        <div class="metric-card-custom card-style-viewers">
                            <div class="metric-card-label">Viewers</div>
                            <div class="metric-card-value">{{ $totalViews ?? 0 }}</div>
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
                        <a href="{{ url('staff/activity_trackers') }}" class="view-all-link" style="color: #64748b; font-size: 13px; font-weight: 600; text-decoration: none; margin-left: 15px;">View All &gt;&gt;</a>
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

        <!-- Recent Orders Feed -->
        <div class="container-fluid mt-4 mb-4">
            <div class="card tab2-card" style="background-color:#80808014; border: 1px solid rgba(0,0,0,0.08); box-shadow: 0 4px 20px 0 rgba(0,0,0,0.02); border-radius: 8px;">
                <div class="card-header" style="border-bottom: 1px solid rgba(0,0,0,0.08); background-color: #fff; padding: 15px 20px; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                    <h4 style="margin: 0; font-size: 15px; font-weight: 600; color: #192c3a; text-transform: none; letter-spacing: 0;">Recent Orders</h4>
                </div>
                <div class="card-body" style="padding: 20px;">
                    <div class="tab-content">
                        <div class="tab-pane active show fade">
                            <div class="row pt-3 products-admin ratio_asos">
                                <div class="col-xl-12 col-md-12">
                                    <div class="card" style="border: none; box-shadow: none; margin: 0;">
                                        <div class="card-body product-box" style="padding: 0;">
                                            <div class="row">
                                                <ul style="list-style: none; padding: 0; margin: 0; width: 100%;">
                                                    @forelse($recentActivities as $activity)
                                                    <li>
                                                        <div class="media" style="align-items: center; padding: 12px 0; border-bottom: 1px solid rgba(0,0,0,0.05);">
                                                            <div class="col-md-1" style="max-width: 45px; padding: 0;">
                                                                @if(!empty($activity->product_image) && file_exists(public_path('assets/images/products/' . $activity->product_image)))
                                                                    <img src="{{ asset('assets/images/products/' . $activity->product_image) }}" class="img-fluid img-30 me-2 blur-up lazyloaded" style="width: 35px; height: 35px; object-fit: cover; border-radius: 4px;" alt=""/>
                                                                @else
                                                                    <img src="{{ asset('assets/images/products/blouse.jpg') }}" class="img-fluid img-30 me-2 blur-up lazyloaded" style="width: 35px; height: 35px; object-fit: cover; border-radius: 4px;" alt=""/>
                                                                @endif
                                                            </div>
                                                            <div class="col-md-11" style="padding-left: 15px;">
                                                                <h5 class="mt-0" style="font-size: 14px; font-weight: 500; color: #192c3a; margin-bottom: 2px;">
                                                                    <span class="font-secondary" style="font-weight: 600;">{{ ucwords(trim($activity->customer_firstname . ' ' . $activity->customer_lastname)) }}</span> 
                                                                    ordered 
                                                                    <strong style="color: #02cccd;">{{ $activity->product_name }}</strong> 
                                                                    (Qty: {{ $activity->product_quantity }})
                                                                </h5>
                                                                <span class="text-secondary" style="font-size: 12px; display: block; margin-top: 2px;">
                                                                    <i class="fa fa-clock-o me-1"></i> {{ \Carbon\Carbon::parse($activity->created_at)->diffForHumans() }} 
                                                                    <span class="badge {{ $activity->order_status == 'Delivered' ? 'badge-success' : 'badge-warning' }} ms-2" style="font-size: 10px; padding: 3px 8px;">{{ $activity->order_status }}</span>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                    @empty
                                                    <li class="text-center py-4">
                                                        <h6 class="text-muted">No recent orders found.</h6>
                                                    </li>
                                                    @endforelse
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@push('scripts')
<script>
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
</div>

</div>

@endsection