@extends('layout.auth.master')
@section('contents')

    @include('paritials.vendorauth.header')?>

<!-- page-wrapper Start-->
@include('paritials.vendorauth.topmenu');
<!-- Page Header Ends -->

<!-- Page Body Start-->
<div class="page-body-wrapper">
	
	<!-- Page Sidebar Start-->
	@include('paritials.vendorauth.sidemenu');
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
                            <li class="breadcrumb-item"><a href="{{ route('portal_selection') }}"><i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->

        <!-- Filter Card -->
        <div class="container-fluid">
            <div class="card" style="border: 1px solid rgba(0,0,0,0.08); box-shadow: 0 4px 20px 0 rgba(0,0,0,0.02); border-radius: 8px; margin-bottom: 25px;">
                <div class="card-header" style="border-bottom: 1px solid rgba(0,0,0,0.08); background-color: #fff; padding: 15px 20px; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                    <h5 style="margin: 0; font-size: 15px; font-weight: 600; color: #192c3a; text-transform: none; letter-spacing: 0; display: flex; align-items: center; gap: 8px;">
                        <i class="fa fa-sliders" style="color: #02cccd;"></i> Filter Dashboard Metrics
                    </h5>
                </div>
                <div class="card-body" style="padding: 20px;">
                    <form method="GET" action="{{ route('vendordashboard', ['id' => $vendorid]) }}" id="filter-form">
                        <div class="row align-items-end">
                            <div class="col-xl-5 col-lg-5 col-md-5 mb-3">
                                <label class="form-label" style="font-weight: 500; font-size: 13px; color: #4f5d6e; margin-bottom: 6px; display: block;">Start Date</label>
                                <input type="date" name="start_date" class="form-control" value="{{ $startDate }}" style="border-radius: 6px; border: 1px solid #ced4da; padding: 8px 12px; height: auto;">
                            </div>
                            <div class="col-xl-5 col-lg-5 col-md-5 mb-3">
                                <label class="form-label" style="font-weight: 500; font-size: 13px; color: #4f5d6e; margin-bottom: 6px; display: block;">End Date</label>
                                <input type="date" name="end_date" class="form-control" value="{{ $endDate }}" style="border-radius: 6px; border: 1px solid #ced4da; padding: 8px 12px; height: auto;">
                            </div>
                            <div class="col-xl-2 col-lg-2 col-md-2 mb-3" style="display: flex; gap: 10px;">
                                <button type="submit" class="btn btn-primary w-100" style="padding: 10px; border-radius: 6px; font-weight: 500; display: flex; align-items: center; justify-content: center; gap: 6px; background-color: #02cccd; border-color: #02cccd;">
                                    <i class="fa fa-filter"></i> Filter
                                </button>
                                <a href="{{ route('vendordashboard', ['id' => $vendorid]) }}" class="btn btn-secondary w-100" style="padding: 10px; border-radius: 6px; font-weight: 500; display: flex; align-items: center; justify-content: center; gap: 6px; background-color: #6c757d; border-color: #6c757d; color: #fff;">
                                    <i class="fa fa-undo"></i> Reset
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Container-fluid starts (Top Stats) -->
        <div class="container-fluid">
            <style>
            @media (max-width: 575px) {
                .widget-cards .card-body {
                    padding: 12px 10px !important;
                }
                .widget-cards .media.static-top-widget {
                    display: flex !important;
                    flex-direction: row !important;
                    align-items: center !important;
                    justify-content: center !important;
                }
                .widget-cards .icons-widgets {
                    padding: 0 !important;
                    flex: 0 0 30% !important;
                    max-width: 30% !important;
                    display: flex !important;
                    justify-content: center !important;
                }
                .widget-cards .icons-widgets .align-self-center {
                    width: 32px !important;
                    height: 32px !important;
                    line-height: 32px !important;
                    display: flex !important;
                    align-items: center !important;
                    justify-content: center !important;
                }
                .widget-cards .icons-widgets i {
                    width: 14px !important;
                    height: 14px !important;
                }
                .widget-cards .media-body {
                    padding: 0 0 0 8px !important;
                    flex: 0 0 70% !important;
                    max-width: 70% !important;
                    text-align: left !important;
                }
                .widget-cards .media-body span {
                    font-size: 11px !important;
                }
                .widget-cards .media-body h3 {
                    font-size: 16px !important;
                    margin-top: 2px !important;
                    margin-bottom: 0 !important;
                }
            }
            </style>
            <div class="row text-center">
                <div class="col-xl-3 col-md-6 col-sm-6 col-xs-6 col-6 mb-4">
                    <div class="card o-hidden widget-cards" style="margin-bottom: 0;">
                        <div class="bg-warning card-body">
                            <div class="media static-top-widget row">
                                <div class="icons-widgets col-4">
                                    <div class="align-self-center text-center"><i data-feather="shopping-bag" class="font-warning"></i></div>
                                </div>
                                <div class="media-body col-8"><span class="m-0">Orders</span>
                                    <h3 class="mt-2 mb-2"> <span class="counter">{{ $orderCount }}</span></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-6 col-xs-6 col-6 mb-4">
                    <div class="card o-hidden widget-cards" style="margin-bottom: 0;">
                        <div class="bg-secondary card-body">
                            <div class="media static-top-widget row">
                                <div class="icons-widgets col-4">
                                    <div class="align-self-center text-center"><i data-feather="box" class="font-secondary"></i></div>
                                </div>
                                <div class="media-body col-8"><span class="m-0">Products</span>
                                    <h3 class="mt-2 mb-2"><span class="counter">{{ $productCount }}</span></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-6 col-xs-6 col-6 mb-4">
                    <div class="card o-hidden widget-cards" style="margin-bottom: 0;">
                        <div class="bg-primary card-body">
                            <div class="media static-top-widget row">
                                <div class="icons-widgets col-4">
                                    <div class="align-self-center text-center"><i data-feather="users" class="font-primary"></i></div>
                                </div>
                                <div class="media-body col-8"><span class="m-0">Customers</span>
                                    <h3 class="mt-2 mb-2"> <span class="counter">{{ $customerCount }}</span></h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-md-6 col-sm-6 col-xs-6 col-6 mb-4">
                    <div class="card o-hidden widget-cards" style="margin-bottom: 0;">
                        <div class="bg-info card-body">
                            <div class="media static-top-widget row">
                                <div class="icons-widgets col-4">
                                    <div class="align-self-center text-center"><i data-feather="eye" class="font-info"></i></div>
                                </div>
                                <div class="media-body col-8"><span class="m-0">Viewers</span>
                                    <h3 class="mt-2 mb-2"><span class="counter">{{ $totalViews }}</span></h3>
                                </div>
                            </div>
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

                <!-- Sales by Payment Method & Category wise Products -->
                <div class="col-xl-4 col-lg-4 col-md-12 mt-4">
                    <div class="card" style="border: 1px solid rgba(0,0,0,0.08); box-shadow: 0 4px 20px 0 rgba(0,0,0,0.02); border-radius: 8px;">
                        <div class="card-header" style="border-bottom: 1px solid rgba(0,0,0,0.08); background-color: #fff; padding: 15px 20px; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                            <h5 style="margin: 0; font-size: 15px; font-weight: 600; color: #192c3a; text-transform: none; letter-spacing: 0;">Sales by Payment Method</h5>
                        </div>
                        <div class="card-body" style="padding: 20px;">
                            <div class="chart-container" style="position: relative; height: 280px; width: 100%;">
                                <canvas id="channelTypeChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12 mt-4">
                    <div class="card" style="border: 1px solid rgba(0,0,0,0.08); box-shadow: 0 4px 20px 0 rgba(0,0,0,0.02); border-radius: 8px;">
                        <div class="card-header" style="border-bottom: 1px solid rgba(0,0,0,0.08); background-color: #fff; padding: 15px 20px; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                            <h5 style="margin: 0; font-size: 15px; font-weight: 600; color: #192c3a; text-transform: none; letter-spacing: 0;">Category wise Products</h5>
                        </div>
                        <div class="card-body" style="padding: 20px;">
                            <div class="chart-container" style="position: relative; height: 280px; width: 100%;">
                                <canvas id="socialNetworkChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-4 col-md-12 mt-4">
                    <div class="card" style="border: 1px solid rgba(0,0,0,0.08); box-shadow: 0 4px 20px 0 rgba(0,0,0,0.02); border-radius: 8px;">
                        <div class="card-header" style="border-bottom: 1px solid rgba(0,0,0,0.08); background-color: #fff; padding: 15px 20px; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                            <h5 style="margin: 0; font-size: 15px; font-weight: 600; color: #192c3a; text-transform: none; letter-spacing: 0;">Orders by Status</h5>
                        </div>
                        <div class="card-body" style="padding: 20px;">
                            <div class="chart-container" style="position: relative; height: 280px; width: 100%;">
                                <canvas id="browserChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity Feed -->
                <div class="col-md-12 mt-4">
                    <div class="card tab2-card" style="background-color:#80808014; border: 1px solid rgba(0,0,0,0.08); box-shadow: 0 4px 20px 0 rgba(0,0,0,0.02); border-radius: 8px;">
                        <div class="card-header" style="border-bottom: 1px solid rgba(0,0,0,0.08); background-color: #fff; padding: 15px 20px; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                            <h4 style="margin: 0; font-size: 15px; font-weight: 600; color: #192c3a; text-transform: none; letter-spacing: 0;">Recent Activity</h4>
                        </div>
                        <div class="card-body" style="padding: 20px;">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane active show fade" id="new" role="tabpanel" aria-labelledby="new-tabs">
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
                                                                <h6 class="text-muted">No recent activities found for your products.</h6>
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

    // 7. Sales by Payment Method Doughnut Chart
    const channelCanvas = document.getElementById('channelTypeChart');
    if (channelCanvas) {
        const channelCtx = channelCanvas.getContext('2d');
        new Chart(channelCtx, {
            type: 'doughnut',
            data: {
                labels: @json($paymentLabels),
                datasets: [{
                    data: @json($paymentCounts),
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
                        labels: {
                            boxWidth: 12,
                            font: { family: "'Work Sans', sans-serif", size: 11 }
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                return ' ' + context.label + ': ' + context.raw + ' orders';
                            }
                        }
                    }
                },
                cutout: '60%'
            }
        });
    }

    // 8. Category wise Products Bar Chart
    const socialCanvas = document.getElementById('socialNetworkChart');
    if (socialCanvas) {
        const socialCtx = socialCanvas.getContext('2d');
        new Chart(socialCtx, {
            type: 'bar',
            data: {
                labels: @json($categoryLabels).map(label => {
                    if (label === 'Living & Personalized') {
                        return ['Living &', 'Personalized'];
                    }
                    return label;
                }),
                datasets: [
                    {
                        label: 'Product Count',
                        data: @json($categoryCounts),
                        backgroundColor: '#f89a42',
                        borderRadius: 4,
                        maxBarThickness: 30
                    }
                ]
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
                        ticks: {
                            font: { family: "'Work Sans', sans-serif" },
                            stepSize: 1
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: {
                            font: { family: "'Work Sans', sans-serif" },
                            maxRotation: 0,
                            minRotation: 0
                        }
                    }
                }
            }
        });
    }

    // 9. Orders by Status Bar Chart
    const browserCanvas = document.getElementById('browserChart');
    if (browserCanvas) {
        const browserCtx = browserCanvas.getContext('2d');
        new Chart(browserCtx, {
            type: 'bar',
            data: {
                labels: @json($statusLabels),
                datasets: [{
                    label: 'Orders Count',
                    data: @json($statusCounts),
                    backgroundColor: '#02cccd',
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
                        ticks: {
                            font: { family: "'Work Sans', sans-serif" },
                            stepSize: 1
                        }
                    },
                    x: {
                        grid: { display: false },
                        ticks: { font: { family: "'Work Sans', sans-serif" } }
                    }
                }
            }
        });
    }
});
</script>
@endpush

@endsection