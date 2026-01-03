{{-- <?php include('header.php')?> --}}
@extends('website.layouts.master')
<!-- page-wrapper Start-->

@include('website.pages.topmenu')
<!-- Page Header Ends -->

<!-- Page Body Start-->
<div class="page-body-wrapper">
	
	<!-- Page Sidebar Start-->
	      
    @include('website.pages.sidemenu')
    @section('content')
	<div class="page-body">
		
		<!-- Container-fluid starts-->
		<div class="container-fluid">
			<div class="page-header">
				<div class="row">
					<div class="col-lg-6">
						<div class="page-header-left">
							<h3>Coupon List
								<small>Oxegen Admin panel</small>
							</h3>
						</div>
					</div>
					<div class="col-lg-6">
						<ol class="breadcrumb pull-right">
							<li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
							<li class="breadcrumb-item">Coupons </li>
							<li class="breadcrumb-item active">Coupon List</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
		<!-- Container-fluid Ends-->
		
		<!-- Container-fluid starts-->
		<div class="container-fluid">
			<div class="card tab2-card">
				<div class="card-header">
					<h5>Discount Coupon Details</h5>
				</div>
				<div class="card-body">
					<ul class="nav nav-tabs tab-coupon" id="myTab" role="tablist">
						
						<li class="nav-item"><a class="nav-link active show" id="search-tab" data-bs-toggle="tab" href="#search" role="tab" aria-controls="search" aria-selected="false" data-original-title="" title="">search</a></li>
						
						
						
						
						<li class="nav-item"><a class="nav-link" id="general-tab" data-bs-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true" data-original-title="" title="">General</a></li>
						
					</ul>
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade" id="general" role="tabpanel" aria-labelledby="general-tab">
							<form class="needs-validation" novalidate="">
                                @csrf
								<h4>General</h4>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-3 col-md-4"><span>*</span> Coupan Title</label>
											<div class="col-md-7">
												<input class="form-control" id="validationCustom0" type="text" required="">
											</div>
										</div>
										<div class="form-group row">
											<label for="validationCustom1" class="col-xl-3 col-md-4"><span>*</span>Coupan Code</label>
											<div class="col-md-7">
												<input class="form-control" id="validationCustom1" type="text" required="" >
											</div>
											<div class="valid-feedback">Please Provide a Valid Coupon Code.</div>
										</div>
										<div class="form-group row">
											<label class="col-xl-3 col-md-4">Start Date</label>
											<div class="col-md-7">
												<input class="datepicker-here form-control digits" type="text" data-language="en">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-xl-3 col-md-4">End Date</label>
											<div class="col-md-7">
												<input class="datepicker-here form-control digits" type="text" data-language="en">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-xl-3 col-md-4">Free Shipping</label>
											<div class="col-md-7">
												<div class="checkbox checkbox-primary">
													<input id="checkbox-primary-1" type="checkbox" data-original-title="" title="">
													<label for="checkbox-primary-1">Allow Free Shipping</label>
												</div>
											</div>
										</div>
										<div class="form-group row">
											<label class="col-xl-3 col-md-4">Quantity</label>
											<div class="col-md-7">
												<input class="form-control" type="number" required="">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-xl-3 col-md-4">Discount Type</label>
											<div class="col-md-7">
												<select class="custom-select w-100 form-control" required="">
													<option value="">--Select--</option>
													<option value="1">Percent</option>
													<option value="2">Fixed</option>
												</select>
											</div>
										</div>
										
										<div class="form-group row">
											<label class="col-xl-3 col-md-4">Discount Amount</label>
											<div class="col-md-7">
												<input class="form-control" type="number" required="">
											</div>
										</div>
										<div class="form-group row">
											<label class="col-xl-3 col-md-4">Status</label>
											<div class="col-md-7">
												<div class="checkbox checkbox-primary">
													<input id="checkbox-primary-2" type="checkbox" data-original-title="" title="">
													<label for="checkbox-primary-2">Enable the Coupon</label>
												</div>
											</div>
										</div>
									</div>
								</div>
							</form>
						</div>
						<div class="tab-pane fade" id="restriction" role="tabpanel" aria-labelledby="restriction-tabs">
							<form class="needs-validation" novalidate="">
								<h4>Restriction</h4>
								<div class="form-group row">
									<label for="validationCustom3" class="col-xl-3 col-md-4">Products</label>
									<div class="col-md-7">
										<input class="form-control" id="validationCustom3" type="text" required="" >
									</div>
									<div class="valid-feedback">Please Provide a Product Name.</div>
								</div>
								<div class="form-group row">
									<label class="col-xl-3 col-md-4">Category</label>
									<div class="col-md-7">
										<select class="custom-select w-100 form-control" required="">
											<option value="">--Select--</option>
											<option value="1">Electronics</option>
											<option value="2">Clothes</option>
											<option value="2">Shoes</option>
											<option value="2">Digital</option>
										</select>
									</div>
								</div>
								<div class="form-group row">
									<label for="validationCustom4" class="col-xl-3 col-md-4">Minimum Spend</label>
									<div class="col-md-7">
										<input class="form-control" id="validationCustom4" type="number" >
									</div>
								</div>
								<div class="form-group row">
									<label for="validationCustom5" class="col-xl-3 col-md-4">Maximum Spend</label>
									<div class="col-md-7">
										<input class="form-control" id="validationCustom5" type="number" >
									</div>
								</div>
							</form>
						</div>
						<div class="tab-pane fade" id="usage" role="tabpanel" aria-labelledby="usage-tab">
							<form class="needs-validation" novalidate="">
								<h4>Usage Limits</h4>
								<div class="form-group row">
									<label for="validationCustom6" class="col-xl-3 col-md-4">Per Limit</label>
									<div class="col-md-7">
										<input class="form-control" id="validationCustom6" type="number" >
									</div>
								</div>
								<div class="form-group row">
									<label for="validationCustom7" class="col-xl-3 col-md-4">Per Customer</label>
									<div class="col-md-7">
										<input class="form-control" id="validationCustom7" type="number" >
									</div>
								</div>
							</form>
						</div>
						
						
						
						
						<div class="tab-pane fade active show" id="search" role="tabpanel" aria-labelledby="search-tab">
							<form class="needs-validation" novalidate="">
								<h4>Search</h4>
								
								<div class="form-group row">
									<label for="validationCustom6" class="col-xl-3 col-md-4">Search</label>
									<div class="col-md-7">
										<input class="form-control" type="search" placeholder="Search.."><span class="d-sm-none mobile-search"><i data-feather="search"></i></span>
									</div>
								</div>
								
							</form>
						</div>
						
					</div>
					<div class="pull-right">
						<button type="button" class="btn btn-primary" onclick="search()">search</button>
					</div>
				</div>
			</div>
			
			
			
			<div class="row" id="static">
				
				<div class="col-sm-12">
					
					<div class="card">
						
						<div class="card-body order-table">
							 
							<table class="table" id="basic-1" >
								<thead>
                                    <tr>
									<th>select</th>
                                        <th> Id</th>
                                        <th>Product image</th>
                                        <th>Product Name</th>
                                        <th>Category Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th> Status</th>
                                        <th>Action</th>
									</tr>
								</thead>
								<tbody>
									
                                    <tr>
									 <td><input type="checkbox" id="vehicle2" name="vehicle2" value="Car"></td>
                                        <td>#001</td>
                                        <td>
                                            <div class="d-flex">
                                                <img src="../assets/images/dashboard/logo/fav.png" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">
											</div>
										</td>
                                        <td>Shirt Top</td>
                                        <td>Fashion</td>
                                        <td>1500</td>
                                        <td>5</td>
                                        <td><span style="color: #fff;" class="badge badge-success px-2">Published</span></td>
                                        <td><span> <a href="#" class="badge badge-secondary px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
										<a href="#" onclick="return delete_maincategory()" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>
                                        
									</tr>
									
                                    <tr>
									<td><input type="checkbox" id="vehicle2" name="vehicle2" value="Car"></td>
                                        <td>#002</td>
                                        <td>
                                            <div class="d-flex">
                                                <img src="../assets/images/dashboard/logo/fav.png" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">
											</div>
										</td>
                                        <td>Shirt Top</td>
                                        <td>Fashion</td>
                                        <td>1500</td>
                                        <td>5</td>
                                        <td><span style="color: #fff;" class="badge badge-danger px-2">Pending</span></td>
                                        <td><span> <a href="#" class="badge badge-secondary px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
										<a href="#" onclick="return delete_maincategory()" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>
                                        
									</tr>
								</tbody>
								
							</table>
							
							<div class="pull-right">
						<button type="button" class="btn btn-primary"  onclick='$("#general-tab").trigger("click");' >continue</button>
					</div>
						</div>
					</div>
				</div>
			</div>
			
		</div>
		<!-- Container-fluid Ends-->
		
	</div>
	
<!-- footer start-->
{{-- <footer class="footer">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 footer-copyright">
				<p class="mb-0">Copyright 2019 © Multikart All rights reserved.</p>
			</div>
			<div class="col-md-6">
				<p class="pull-right mb-0">Hand crafted & made with<i class="fa fa-heart"></i></p>
			</div>
		</div>
	</div>
</footer> --}}
<!-- footer end-->

</div>

</div>
<style>
	#static{
	display:none;
	
	}
	
	
	
	
	</style>
			
			<script>
			$(window).load(function(){
   $('#general-tab').trigger('click');
});
				 function search(){
				
				
					
					
					document.getElementById("static").style.display="block";
					
				}
				</script>
<!-- latest jquery-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


<!-- Bootstrap js-->
<script src="../assets/js/bootstrap.bundle.min.js"></script>

<!-- feather icon js-->
<script src="../assets/js/icons/feather-icon/feather.min.js"></script>
<script src="../assets/js/icons/feather-icon/feather-icon.js"></script>

<!-- Sidebar jquery-->
<script src="../assets/js/sidebar-menu.js"></script>

<!--Datepicker jquery-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

<!--Customizer admin-->
<script src="../assets/js/admin-customizer.js"></script>

<!-- lazyload js-->
<script src="../assets/js/lazysizes.min.js"></script>

<!--right sidebar js-->
<script src="../assets/js/chat-menu.js"></script>

<!--script admin-->
<script src="../assets/js/admin-script.js"></script>
@endsection