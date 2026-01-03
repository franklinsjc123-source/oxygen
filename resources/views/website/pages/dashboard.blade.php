{{-- <?php include('header.php')?> --}}

@extends('website.layouts.master')
<!-- page-wrapper Start-->
  {{-- <?php include('topmenu.php')?> --}}
  @include('website.pages.topmenu')
    <!-- Page Header Ends -->

    <!-- Page Body Start-->
    <div class="page-body-wrapper">

        <!-- Page Sidebar Start-->
        {{-- <?php include('sidemenu.php')?> --}}
        @include('website.pages.sidemenu')
        <!-- Page Sidebar Ends-->

        <!-- Right sidebar Start-->
       
        <!-- Right sidebar Ends-->
        @section('content')

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
                                <li class="breadcrumb-item"><a href="dashboard.php"><i data-feather="home"></i></a></li>
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
                <div class="col-md-7">

                <div class="col-xl-12 col-md-12">
                        <div class="card">
                            <div class="card-body product-box">
                                <div class="row">
                                   
                                    <div class="col-md-3">
                                <div class="img-wrapper">
                                    <div class="front align-self-center mt-4">
                                        
                                        <a href="#"><img src="../assets/images/vendor/logo/skap.png" class="img-fluid" alt=""></a>
                                        
                                    </div></div>
                                </div>
                                <div class="col-md-9">
                                   <div class="row">
                                       <div class="col-md-9">
                                <div class="product-detail">
                                   
                                    <a href="#">
                                        <h6 class="pt-0 mb-0 mt-0"><b>SKAP Garments</b></h6>
                                    </a>
                                    <p class="pt-0 mb-0 mt-0">#25 New  Nagar</p>
                                    <p class="pt-0 mb-0 mt-0">Trichy:62002</p>
                                    <h6 class="pt-0 mb-0 mt-0"><span class="font-secondary">Business Category :</span> Fashion Footwears</h6> <p> </p>

</div>
                                </div>
                              
                                </div>
                            </div>
                                </div>
<hr style="margin-bottom:0px ; margin-top:0px;">
                                <div class="row px-5">
                                    

<div class="col-md-8">
                                    <h5><b>Owner Name: <span>Anand</span> </b></h5>
                                    <h5><b>Mobile: <span>987654310</span> </b></h5>
  <p>skap2k@gmail.com</p>
  <h5><b>Valid Till - 31st Dec 2023</b></h5>
  <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                                    
                            </div>
                            <div class="col-md-4">
                                   
                                    <span style="color: #fff; font-size:13px;" class="mt-4 badge badge-success py-3 px-4">Active Plan : Gold</span>
                                 
                                  <div class="profile-details">
                                  <div class="social">
                                        <div class="form-group btn-showcase">
                                            <button class="btn social-btn btn-fb d-inline-block"> <i class="fa fa-facebook"></i></button>
                                            <button class="btn social-btn btn-twitter d-inline-block"><i class="fa fa-google"></i></button>
                                            <button class="btn social-btn btn-google d-inline-block me-0"><i class="fa fa-instagram"></i></button>
                                        </div></div>
                                    </div>
                            </div>
                        </div>


                                    
                            </div>
                        </div>
                    </div>


</div>
                    <div class="col-md-5">
                        <div class="row">
                    <div class="col-xl-6 col-md-6">
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
                  <div class="col-xl-6 col-md-6">
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
                   <div class="col-xl-6 col-md-6">
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
                   <div class="col-xl-6 col-md-6">
                        <div class="card o-hidden widget-cards">
                            <div class="bg-danger card-body">
                                <div class="media static-top-widget row">
                                    <div class="icons-widgets col-4">
                                        <div class="align-self-center text-center"><i data-feather="users" class="font-danger"></i></div>
                                    </div>
                                    <div class="media-body col-8"><span class="m-0"> Visitors</span>
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
                                    @csrf
                                   
                                    <div class="row pt-3 products-admin ratio_asos">
                <div class="col-xl-4 col-md-4">
                        <div class="card">
                            <div class="card-body product-box">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 style="font-weight:600" class="mt-0 mb-0">Order <span>005</span></h5>
</div>

<div class="col-md-6">
<h5 style="text-align:right;" class="mt-1 mb-1">18/Jan/2022</h5>
</div>
                                    <div class="col-md-3">
                                <div class="img-wrapper">
                                    <div class="front">
                                        
                                        <a href="#"><img src="../assets/images/products/blouse.jpg" class="img-fluid" alt=""></a>
                                        
                                    </div></div>
                                </div>
                                <div class="col-md-9">
                                   <div class="row">
                                       <div class="col-md-9">
                                <div class="product-detail">
                                   
                                    <a href="#">
                                        <h6 class="pt-0 mb-0 mt-0 font-primary">Slim Fit Cotton Shirt</h6>
                                    </a>
                                    <p class="pt-0 mb-0 mt-0">2 Item</p>
                                    <h6 class="pt-0 mb-0 mt-0 font-secondary">₹ 500.00</h6>
</div>
                                </div>
                                <div class="col-md-3">
                                <span style="color: #fff;" class="mt-5 badge badge-success px-2">Paid</span>
</div>
                                </div></div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-xl-4 col-md-4">
                        <div class="card">
                            <div class="card-body product-box">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 style="font-weight:600" class="mt-0 mb-0">Order <span>005</span></h5>
</div>

<div class="col-md-6">
<h5 style="text-align:right;" class="mt-1 mb-1">18/Jan/2022</h5>
</div>
                                    <div class="col-md-3">
                                <div class="img-wrapper">
                                    <div class="front">
                                        
                                        <a href="#"><img src="../assets/images/products/blouse.jpg" class="img-fluid" alt=""></a>
                                        
                                    </div></div>
                                </div>
                                <div class="col-md-9">
                                   <div class="row">
                                       <div class="col-md-9">
                                <div class="product-detail">
                                   
                                    <a href="#">
                                        <h6 class="pt-0 mb-0 mt-0 font-primary">Slim Fit Cotton Shirt</h6>
                                    </a>
                                    <p class="pt-0 mb-0 mt-0">2 Item</p>
                                    <h6 class="pt-0 mb-0 mt-0 font-secondary">₹ 500.00</h6>
</div>
                                </div>
                                <div class="col-md-3">
                                <span style="color: #fff;" class="mt-5 badge badge-success px-2">Paid</span>
</div>
                                </div></div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-xl-4 col-md-4">
                        <div class="card">
                            <div class="card-body product-box">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 style="font-weight:600" class="mt-0 mb-0">Order <span>005</span></h5>
</div>

<div class="col-md-6">
<h5 style="text-align:right;" class="mt-1 mb-1">18/Jan/2022</h5>
</div>
                                    <div class="col-md-3">
                                <div class="img-wrapper">
                                    <div class="front">
                                        
                                        <a href="#"><img src="../assets/images/products/blouse.jpg" class="img-fluid" alt=""></a>
                                        
                                    </div></div>
                                </div>
                                <div class="col-md-9">
                                   <div class="row">
                                       <div class="col-md-9">
                                <div class="product-detail">
                                   
                                    <a href="#">
                                        <h6 class="pt-0 mb-0 mt-0 font-primary">Slim Fit Cotton Shirt</h6>
                                    </a>
                                    <p class="pt-0 mb-0 mt-0">2 Item</p>
                                    <h6 class="pt-0 mb-0 mt-0 font-secondary">₹ 500.00</h6>
</div>
                                </div>
                                <div class="col-md-3">
                                <span style="color: #fff;" class="mt-5 badge badge-warning px-2">COD</span>
</div>
                                </div></div>
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
                                        <h5 style="font-weight:600" class="mt-0 mb-0">Order <span>005</span></h5>
</div>

<div class="col-md-6">
<h5 style="text-align:right;" class="mt-1 mb-1">18/05/2022</h5>
</div>
                                    <div class="col-md-3">
                                <div class="img-wrapper">
                                    <div class="front">
                                        
                                        <a href="#"><img src="../assets/images/products/blouse.jpg" class="img-fluid" alt=""></a>
                                        
                                    </div></div>
                                </div>
                                <div class="col-md-9">
                                   <div class="row">
                                       <div class="col-md-9">
                                <div class="product-detail">
                                   
                                    <a href="#">
                                        <h6 class="pt-0 mb-0 mt-0 font-primary">Slim Fit Cotton Shirt</h6>
                                    </a>
                                    <p class="pt-0 mb-0 mt-0">2 Item</p>
                                    <h6 class="pt-0 mb-0 mt-0 font-secondary">₹ 500.00</h6>
</div>
                                </div>
                                <div class="col-md-3">
                                <span style="color: #fff;" class="mt-5 badge badge-success px-2">Paid</span>
</div>
                                </div></div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-xl-4 col-md-4">
                        <div class="card">
                            <div class="card-body product-box">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 style="font-weight:600" class="mt-0 mb-0">Order <span>005</span></h5>
</div>

<div class="col-md-6">
<h5 style="text-align:right;" class="mt-1 mb-1">18/05/2022</h5>
</div>
                                    <div class="col-md-3">
                                <div class="img-wrapper">
                                    <div class="front">
                                        
                                        <a href="#"><img src="../assets/images/products/blouse.jpg" class="img-fluid" alt=""></a>
                                        
                                    </div></div>
                                </div>
                                <div class="col-md-9">
                                   <div class="row">
                                       <div class="col-md-9">
                                <div class="product-detail">
                                   
                                    <a href="#">
                                        <h6 class="pt-0 mb-0 mt-0 font-primary">Slim Fit Cotton Shirt</h6>
                                    </a>
                                    <p class="pt-0 mb-0 mt-0">2 Item</p>
                                    <h6 class="pt-0 mb-0 mt-0 font-secondary">₹ 500.00</h6>
</div>
                                </div>
                                <div class="col-md-3">
                                <span style="color: #fff;" class="mt-5 badge badge-success px-2">Paid</span>
</div>
                                </div></div>
                                </div>
                            </div>
                        </div>
                    </div>



                    <div class="col-xl-4 col-md-4">
                        <div class="card">
                            <div class="card-body product-box">
                                <div class="row">
                                    <div class="col-md-6">
                                        <h5 style="font-weight:600" class="mt-0 mb-0">Order <span>005</span></h5>
</div>

<div class="col-md-6">
<h5 style="text-align:right;" class="mt-1 mb-1">18/05/2022</h5>
</div>
                                    <div class="col-md-3">
                                <div class="img-wrapper">
                                    <div class="front">
                                        
                                        <a href="#"><img src="../assets/images/products/blouse.jpg" class="img-fluid" alt=""></a>
                                        
                                    </div></div>
                                </div>
                                <div class="col-md-9">
                                   <div class="row">
                                       <div class="col-md-9">
                                <div class="product-detail">
                                   
                                    <a href="#">
                                        <h6 class="pt-0 mb-0 mt-0 font-primary">Slim Fit Cotton Shirt</h6>
                                    </a>
                                    <p class="pt-0 mb-0 mt-0">2 Item</p>
                                    <h6 class="pt-0 mb-0 mt-0 font-secondary">₹ 500.00</h6>
</div>
                                </div>
                                <div class="col-md-3">
                                <span style="color: #fff;" class="mt-5 badge badge-warning px-2">COD</span>
</div>
                                </div></div>
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
            <!-- Container-fluid Ends-->

        </div>
@endsection

        {{-- <?php include('newfooter.php')?> --}}