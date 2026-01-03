@extends('layout.auth.master')
@section('contents')

    @include('paritials.auth.header')?>

<!-- page-wrapper Start-->
@include('paritials.auth.topmenu');
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
                                            <h3 class="mt-2 mb-2"> <span class="counter">6659</span><small> </small></h3>
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
                                            <h3 class="mt-0 mb-0"><span class="counter">9856</span></h3>
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
                                            <h3 class="mt-0 mb-0"> <span class="counter">893</span><small></small></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-3 col-md-3">
                            <div class="card o-hidden widget-cards">
                                <div class="bg-danger card-body">
                                    <div class="media static-top-widget row">
                                        <div class="icons-widgets col-4">
                                            <div class="align-self-center text-center"><i data-feather="users" class="font-danger"></i></div>
                                        </div>
                                        <div class="media-body col-8"><span class="m-0"> Vendors</span>
                                            <h3 class="mt-0 mb-0"><span class="counter">45631</span><small> </small></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="card tab2-card" style="background-color:#80808014">

                    <h4>Active Orders</h4>
                    <div class="card-body">



                        <ul class="nav nav-tabs tab-coupon" id="myTab" role="tablist" style="border-bottom:none !important;">
                            <li class="nav-item"><a class="nav-link active show" id="new-tabs" data-bs-toggle="tab" href="#new" role="tab" aria-controls="new" aria-selected="false" data-original-title="" title="">New</a></li>

                            <li class="nav-item"><a class="nav-link" id="general-tab" data-bs-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true" data-original-title="" title="">Dispatch</a></li>
                        </ul>




                        <div class="tab-content" id="myTabContent">

                            <div class="tab-pane active show fade" id="new" role="tabpanel" aria-labelledby="new-tabs">
                                <form class="needs-validation" novalidate="">


                                    <div class="row pt-3 products-admin ratio_asos">
                                        <div class="col-xl-4 col-md-4">
                                            <div class="card">
                                                <div class="card-body product-box">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <h5 style="font-weight:600" class="mt-0 mb-0">Order #<span>005</span></h5>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <h5 style="text-align:right;" class="mt-1 mb-1">Jun 08, 11.30 am</h5>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="img-wrapper">
                                                                <div class="front">

                                                                    <a href="#"><img src="{{asset('assets/images/products/blouse.jpg')}}" class="img-fluid" alt=""></a>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="row">
                                                                <div class="col-md-9">
                                                                    <div class="product-detail">

                                                                        <a href="#">
                                                                            <h6 class="pt-0 mb-0 mt-0 font-primary">Slim Fit Cotton Shirt</h6>
                                                                        </a>
                                                                        <p class="pt-0 mb-0 mt-0"><span class="font-warning">Qty: 2</span></p>
                                                                        <h6 class="pt-2 mb-0 mt-0 font-secondary">₹ 500.00</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <span style="color: #fff;" class="mt-5 badge badge-success px-2">Paid</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-xl-4 col-md-4">
                                            <div class="card">
                                                <div class="card-body product-box">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <h5 style="font-weight:600" class="mt-0 mb-0">Order # <span>005</span></h5>
                                                        </div>

                                                        <div class="col-md-6">
                                                            <h5 style="text-align:right;" class="mt-1 mb-1">Jun 08, 2.30 pm</h5>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="img-wrapper">
                                                                <div class="front">

                                                                    <a href="#"><img src="{{asset('assets/images/products/blouse.jpg')}}" class="img-fluid" alt=""></a>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="row">
                                                                <div class="col-md-9">
                                                                    <div class="product-detail">

                                                                        <a href="#">
                                                                            <h6 class="pt-0 mb-0 mt-0 font-primary">Slim Fit Cotton Shirt</h6>
                                                                        </a>
                                                                       <p class="pt-0 mb-0 mt-0"><span class="font-warning">Qty: 2</span></p>
                                                                        <h6 class="pt-2 mb-0 mt-0 font-secondary">₹ 500.00</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <span style="color: #fff;" class="mt-5 badge badge-success px-2">Paid</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="col-xl-4 col-md-4">
                                            <div class="card">
                                                <div class="card-body product-box">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <h5 style="font-weight:600" class="mt-0 mb-0">Order #<span>005</span></h5>
                                                        </div>

                                                        <div class="col-md-6">
                                                           <h5 style="text-align:right;" class="mt-1 mb-1">Jun 08, 11.30 pm</h5>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="img-wrapper">
                                                                <div class="front">

                                                                    <a href="#"><img src="{{asset('assets/images/products/blouse.jpg')}}" class="img-fluid" alt=""></a>

                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-9">
                                                            <div class="row">
                                                                <div class="col-md-9">
                                                                    <div class="product-detail">

                                                                        <a href="#">
                                                                            <h6 class="pt-0 mb-0 mt-0 font-primary">Slim Fit Cotton Shirt</h6>
                                                                        </a>
                                                                       <p class="pt-0 mb-0 mt-0"><span class="font-warning">Qty: 2</span></p>
                                                                        <h6 class="pt-2 mb-0 mt-0 font-secondary">₹ 500.00</h6>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <span style="color: #fff;" class="mt-5 badge badge-warning px-2">COD</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>

                            </div>
                            <div class="tab-pane fade" id="general" role="tabpanel" aria-labelledby="general-tab">
                                <div class="row products-admin pt-3 ratio_asos">
                                    <div class="col-xl-4 col-md-4">
                                        <div class="card">
                                            <div class="card-body product-box">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h5 style="font-weight:600" class="mt-0 mb-0">Order #<span>005</span></h5>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <h5 style="text-align:right;" class="mt-1 mb-1">Jun 08, 1.30 pm</h5>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="img-wrapper">
                                                            <div class="front">

                                                                <a href="#"><img src="{{asset('assets/images/products/blouse.jpg')}}" class="img-fluid" alt=""></a>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="row">
                                                            <div class="col-md-9">
                                                                <div class="product-detail">

                                                                    <a href="#">
                                                                        <h6 class="pt-0 mb-0 mt-0 font-primary">Slim Fit Cotton Shirt</h6>
                                                                    </a>
                                                                    <p class="pt-0 mb-0 mt-0"><span class="font-warning">Qty: 2</span></p>
                                                                        <h6 class="pt-2 mb-0 mt-0 font-secondary">₹ 500.00</h6>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <span style="color: #fff;" class="mt-5 badge badge-success px-2">Paid</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-xl-4 col-md-4">
                                        <div class="card">
                                            <div class="card-body product-box">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h5 style="font-weight:600" class="mt-0 mb-0">Order #<span>005</span></h5>
                                                    </div>

                                                    <div class="col-md-6">
                                                       <h5 style="text-align:right;" class="mt-1 mb-1">Jun 08, 11.30 pm</h5>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="img-wrapper">
                                                            <div class="front">

                                                                <a href="#"><img src="{{asset('assets/images/products/blouse.jpg')}}" class="img-fluid" alt=""></a>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="row">
                                                            <div class="col-md-9">
                                                                <div class="product-detail">

                                                                    <a href="#">
                                                                        <h6 class="pt-0 mb-0 mt-0 font-primary">Slim Fit Cotton Shirt</h6>
                                                                    </a>
                                                                    <p class="pt-0 mb-0 mt-0"><span class="font-warning">Qty: 2</span></p>
                                                                        <h6 class="pt-2 mb-0 mt-0 font-secondary">₹ 500.00</h6>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <span style="color: #fff;" class="mt-5 badge badge-success px-2">Paid</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="col-xl-4 col-md-4">
                                        <div class="card">
                                            <div class="card-body product-box">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <h5 style="font-weight:600" class="mt-0 mb-0">Order #<span>005</span></h5>
                                                    </div>

                                                    <div class="col-md-6">
                                                      <h5 style="text-align:right;" class="mt-1 mb-1">Jun 08, 11.30 am</h5>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="img-wrapper">
                                                            <div class="front">

                                                                <a href="#"><img src="{{asset('assets/images/products/blouse.jpg')}}" class="img-fluid" alt=""></a>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <div class="row">
                                                            <div class="col-md-9">
                                                                <div class="product-detail">

                                                                    <a href="#">
                                                                        <h6 class="pt-0 mb-0 mt-0 font-primary">Slim Fit Cotton Shirt</h6>
                                                                    </a>
                                                                    <p class="pt-0 mb-0 mt-0"><span class="font-warning">Qty: 2</span></p>
                                                                        <h6 class="pt-2 mb-0 mt-0 font-secondary">₹ 500.00</h6>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <span style="color: #fff;" class="mt-5 badge badge-warning px-2">COD</span>
                                                            </div>
                                                        </div>
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



                <div class="card tab2-card" style="background-color:#80808014">

<h4>Recent Activity</h4>
<div class="card-body">






    <div class="tab-content" id="myTabContent">

        <div class="tab-pane active show fade" id="new" role="tabpanel" aria-labelledby="new-tabs">
            <form class="needs-validation" novalidate="">


                <div class="row pt-3 products-admin ratio_asos">
                    <div class="col-xl-6 col-md-6">
                        <div class="card">
                            <div class="card-body product-box">
                                <div class="row">
                                <ul class="">
									
									<li>
										<div class="media">
											<div class="col-md-1">
												<img src="{{asset('assets/images/products/blouse.jpg')}}" class="img-fluid img-30 me-2 blur-up lazyloaded"/>
											</div>
											<div class="col-md-11">
												<h5 class="mt-0"><a href=""><span class="font-secondary">SKAP GARMENTS</span></a>  - Activity</h5>
												<span class="text-secondary">1 minutes ago</span>
											
											</div>
										</div>
										
									</li>
									<li>
										<div class="media">
											<div class="col-md-1">
												<img src="{{asset('assets/images/products/blouse.jpg')}}" class="img-fluid img-30 me-2 blur-up lazyloaded"/>
											</div>
											<div class="col-md-11">
												<h5 class="mt-0"><a href=""><span class="font-secondary">VAA GARMENTS</span></a>  - Activity</h5>
												<span class="text-secondary">5 minutes ago</span>
											</div>
										</div>
										
									</li>

                                    <li>
										<div class="media">
											<div class="col-md-1">
												<img src="{{asset('assets/images/products/blouse.jpg')}}" class="img-fluid img-30 me-2 blur-up lazyloaded"/>
											</div>
											<div class="col-md-11">
												<h5 class="mt-0"><a href=""><span class="font-secondary">SKAP GARMENTS</span></a>  - Activity</h5>
												<span class="text-secondary">2 hours 20 minutes ago</span>
											</div>
										</div>
										
									</li>
                                    <li>
										<div class="media">
											<div class="col-md-1">
												<img src="{{asset('assets/images/products/blouse.jpg')}}" class="img-fluid img-30 me-2 blur-up lazyloaded"/>
											</div>
											<div class="col-md-11">
										<h5 class="mt-0"><a href=""><span class="font-secondary">AAA GARMENTS</span></a>  - Activity</h5>
												<span class="text-secondary">1 day ago</span>
											</div>
										</div>
										
									</li>
                                    <li>
										
										
									</li>
									
									
									
								</ul>
                                <div class="pull-right text-right pt-2">
								<button type="submit" class="btn btn-primary">View All</button>
							</div>
	
                                </div>
                                
                            </div>
                        </div>
                    </div>


 <div class="col-xl-6 col-sm-6 xl-50">
      <div class="card">
                            <div class="card-body product-box">
                                        <div class="order-graph sm-order-space">
                                            
                                            <h4>Sales By Location</h4>
                                            <div class="chart-block chart-vertical-center">
                                                <canvas id="myDoughnutGraph"></canvas>
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

</div>

@endsection