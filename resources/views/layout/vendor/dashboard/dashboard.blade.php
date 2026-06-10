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

        <!-- Container-fluid starts-->
        <div class="container-fluid">
            <div class="row">

                <div class="col-md-12">
                    <div class="row">
                        <div class="col-xl-3 col-md-3">
                            <div class="card o-hidden widget-cards">
                                <div class="bg-warning card-body">
                                    <div class="media static-top-widget row">
                                        <div class="icons-widgets col-4">
                                            <div class="align-self-center text-center"><i data-feather="navigation" class="font-warning"></i></div>
                                        </div>
                                        <div class="media-body col-8"><span class="m-0">Orders</span>
                                            <h3 class="mt-2 mb-2"> <span class="counter">{{ $orderCount }}</span><small> </small></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-3">
                            <div class="card o-hidden  widget-cards">
                                <div class="bg-secondary card-body">
                                    <div class="media static-top-widget row">
                                        <div class="icons-widgets col-4">
                                            <div class="align-self-center text-center"><i data-feather="box" class="font-secondary"></i></div>
                                        </div>
                                        <div class="media-body col-8"><span class="m-0">Products</span>
                                            <h3 class="mt-0 mb-0"><span class="counter">{{ $productCount }}</span></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-3">
                            <div class="card o-hidden widget-cards">
                                <div class="bg-primary card-body">
                                    <div class="media static-top-widget row">
                                        <div class="icons-widgets col-4">
                                            <div class="align-self-center text-center"><i data-feather="message-square" class="font-primary"></i></div>
                                        </div>
                                        <div class="media-body col-8"><span class="m-0">Customers</span>
                                            <h3 class="mt-0 mb-0"> <span class="counter">{{ $customerCount }}</span><small></small></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-3">
                            <div class="card o-hidden widget-cards">
                                <div class="bg-info card-body">
                                    <div class="media static-top-widget row">
                                        <div class="icons-widgets col-4">
                                            <div class="align-self-center text-center"><i data-feather="eye" class="font-info"></i></div>
                                        </div>
                                        <div class="media-body col-8"><span class="m-0">Total Views</span>
                                            <h3 class="mt-0 mb-0"> <span class="counter">{{ $totalViews ?? 0 }}</span><small></small></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                <!-- Detailed Analytics Charts (Matomo Style) -->
                <div class="col-xl-8 col-lg-8 col-md-12 mt-4">
                    <div class="card" style="border: 1px solid rgba(0,0,0,0.08); box-shadow: 0 4px 20px 0 rgba(0,0,0,0.02); border-radius: 8px;">
                        <div class="card-header" style="border-bottom: 1px solid rgba(0,0,0,0.08); background-color: #fff; padding: 15px 20px; border-top-left-radius: 8px; border-top-right-radius: 8px;">
                            <h5 style="margin: 0; font-size: 15px; font-weight: 600; color: #192c3a; text-transform: none; letter-spacing: 0;">Sales & Orders Trend (Last 12 Months)</h5>
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
                            <h5 style="margin: 0; font-size: 15px; font-weight: 600; color: #192c3a; text-transform: none; letter-spacing: 0;">Sales by Payment Method</h5>
                        </div>
                        <div class="card-body" style="padding: 20px;">
                            <div class="chart-container" style="position: relative; height: 320px; width: 100%;">
                                <canvas id="channelTypeChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-5 col-lg-5 col-md-12 mt-4">
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
                <div class="col-xl-7 col-lg-7 col-md-12 mt-4">
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
                <div class="card tab2-card" style="background-color:#80808014">

<h4>Recent Activity</h4>
<div class="card-body">






    <div class="tab-content" id="myTabContent">

        <div class="tab-pane active show fade" id="new" role="tabpanel" aria-labelledby="new-tabs">
            <form class="needs-validation" novalidate="">


                <div class="row pt-3 products-admin ratio_asos">
                    <div class="col-xl-12 col-md-12">
                        <div class="card">
                            <div class="card-body product-box">
                                <div class="row">
                                <ul class="">
                                    @forelse($recentActivities as $activity)
                                    <li>
                                        <div class="media" style="align-items: center; padding: 10px 0; border-bottom: 1px solid rgba(0,0,0,0.05);">
                                            <div class="col-md-1" style="max-width: 45px; padding: 0;">
                                                @if(!empty($activity->product_image) && file_exists(public_path('assets/images/products/' . $activity->product_image)))
                                                    <img src="{{ asset('assets/images/products/' . $activity->product_image) }}" class="img-fluid img-30 me-2 blur-up lazyloaded" style="width: 35px; height: 35px; object-fit: cover; border-radius: 4px;" alt=""/>
                                                @else
                                                    <img src="{{ asset('assets/images/products/blouse.jpg') }}" class="img-fluid img-30 me-2 blur-up lazyloaded" style="width: 35px; height: 35px; object-fit: cover; border-radius: 4px;" alt=""/>
                                                @endif
                                            </div>
                                            <div class="col-md-11" style="padding-left: 15px;">
                                                <h5 class="mt-0" style="font-size: 14px; font-weight: 500; color: #192c3a;">
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
                                <div class="pull-right text-right pt-2">
								<button type="submit" class="btn btn-primary">View All</button>
							</div>
	
                                </div>
                                
                            </div>
                        </div>
                    </div>
                  </div>

        </div>
   




        </form>
    </div>
</div>



</div>

        
</div>
			
		</div>


            </div>
        </div>



    </div>

</div>
<!-- Container-fluid Ends-->

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
$(document).ready(function() {
    // 1. Sales & Orders Trend Line Chart
    const visitsCanvas = document.getElementById('visitsOverTimeChart');
    if (visitsCanvas) {
        const visitsCtx = visitsCanvas.getContext('2d');
        
        // Create soft gradient fill
        const visitsGradient = visitsCtx.createLinearGradient(0, 0, 0, 300);
        visitsGradient.addColorStop(0, 'rgba(2, 204, 205, 0.25)');
        visitsGradient.addColorStop(1, 'rgba(2, 204, 205, 0.0)');

        new Chart(visitsCtx, {
            type: 'line',
            data: {
                labels: @json($salesTrendLabels),
                datasets: [
                    {
                        label: 'Revenue',
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
                        labels: {
                            boxWidth: 12,
                            font: { family: "'Work Sans', sans-serif" }
                        }
                    },
                    tooltip: {
                        padding: 12,
                        cornerRadius: 6,
                        titleFont: { family: "'Work Sans', sans-serif" },
                        bodyFont: { family: "'Work Sans', sans-serif" }
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
                            callback: function(value) {
                                return '₹' + value;
                            }
                        }
                    },
                    y1: {
                        type: 'linear',
                        display: true,
                        position: 'right',
                        grid: { drawOnChartArea: false },
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

    // 2. Sales by Payment Method Doughnut Chart
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

    // 3. Category wise Products Bar Chart
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

    // 4. Orders by Status Bar Chart
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