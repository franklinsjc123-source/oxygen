@extends('layout.auth.master')
@section('contents')
@include('paritials.js.auction.create-auction-js')?>
@include('paritials.js.time-js')?>
@include('paritials.css.auction.auction')?>

    @include('paritials.auth.header')?>

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
							<h3>Auction
							
							</h3>
						</div>
					</div>
					<div class="col-lg-6">
						<ol class="breadcrumb pull-right">
							<li class="breadcrumb-item"><a href="dashboard.php"><i data-feather="home"></i></a></li>

							<li class="breadcrumb-item active">Auction</li>
						</ol>
					</div>
				</div>
			</div>
		</div>

	
		<!-- Container-fluid Ends-->
		
		<!-- Container-fluid starts-->
		<div class="container-fluid">
			<div class="card tab2-card">
				
				<div class="card-body">
				
				
							<form class="needs-validation" action="{{route('auction.store')}}" method="post" novalidate="" >
								@csrf
								@method('POST')
								<div class="row fw-bold">
									<div class="col-sm-12">
										@if ($errors->any())
										    <div class="alert alert-danger">
										        <ul>
										            @foreach ($errors->all() as $error)
										                <li>{{ $error }}</li>
										            @endforeach
										        </ul>
										    </div>
										@endif
										<div class="form-group row">
											<label for="validationCustom1" class="col-xl-2 col-md-2">Select Product Type</label>
											<div class="col-md-7">
												<select class="form-control" id="validationCustom1" type="text" name="product_type" required="" >
													<option value="1">Admin Products</option>
													<option value="2">Vedor Products</option>
												</select>
											</div>											
										</div>
										
										<div class="form-group row">
											<label for="validationCustom1" class="col-xl-2 col-md-2">Product ID</label>
											<div class="col-md-7">
												<input class="form-control" id="validationCustom1" name="product_id" type="text" required="" >
											</div>											
										</div>

									    <div class="form-group row">
											<label for="validationCustom1" class="col-xl-2 col-md-2">Starting Price</label>
											<div class="col-md-7">
												<input class="form-control" id="start_price" name="start_price" type="text"  onkeyup = "add()" value="" required="" >
											</div>											
										</div>

										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-2 col-md-2">SLAB</label>
											<div class="col-md-7">
												<input class="form-control" id="slab" name="slab" type="text" onkeyup = "add()" value="" required="">
											</div>
										</div>
									
																			
										<div class="form-group row">
											<label for="validationCustom1" class="col-xl-2 col-md-2">BID Price</label>
											<div class="col-md-7">
												<input class="form-control" id="bid_price" name="bid_price" type="text" required="" >
											</div>											
										</div>
										

										
										

										<div class="form-group row">
											<label class="col-xl-2 col-md-2">Start Offer</label>
												<div class="col-md-4">
											<label class="">Start Date / Time</label>
												 <input id="example" type="datetime-local" class="form-control" name="start_date" placeholder="dd/mm/yy"  />
												 </div>
												 {{-- <div class="col-md-3">
											<label class="">Start Time</label>
												 <input id="" type="time" value="00:00" name="start_time" class="form-control"   />
												 </div> --}}
											
										</div>
										
								
										<div class="form-group row">
											<label class="col-xl-2 col-md-2">End Offer</label>
												<div class="col-md-4">
											<label class="">End Date / Time</label>
												<input id="example1" type="datetime-local" class="form-control"  name="end_date" placeholder="dd/mm/yy"  />
												</div>
												 {{-- <div class="col-md-3">
											<label class="">End Time</label>
												<input id="" type="time" value="00:00" name="end_time" class="form-control"   />
												</div>											 --}}
										</div>
										<div class="form-group row d-none">
											<label class="col-xl-2 col-md-2">Select Product</label>
											<div class="col-md-6">
											
											<input data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" type="text" placeholder="Search Products" class="form-control"   />
												
							
											</div>
											
										</div>
										
												    
												 
      									                     <div class="col-md-8 m-auto d-none">
																		<table class="table" id="table"  data-click-to-select="true"  data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table"  data-sort="true" data-pagination="true"  data-resizable="true" data-cookie="true"
      									data-click-to-select="true" data-toolbar="#toolbar">
															
      									                              <thead>
      									                              <tr>

																											<th data-field="dd" data-checkbox="true">
      									        </th>
                                        
                                        <th data-field="id" data-sortable="true"> Id</th>
                                       
                                        <th data-field="image" data-sortable="true"> images</th>
                                        <th data-field="title" data-sortable="true">Title </th>
                                        
                                        <th data-field="price" data-sortable="true">Product Price</th>
										
                                        <th data-field="qty" data-sortable="true">Qty</th>
                                        
                                       
                                    </tr>
                                    </thead>
                                    <tbody>
                                   
                                    <tr>
									 <td></td>
                                        <td>#001</td>
                                       
                                        <td>
                                            <div class="d-flex">
                                                <img src="{{asset('assets/images/products/blouse.jpg')}}" alt="" class="img-fluid img-40 me-2 blur-up lazyloaded">
                                                </div>
                                        </td>
                                        <td>Embroidery Long Kurtis </td>
                                        
                                      
                                        
                                        <td>
                                        <span>Price : Rs. 1200</span> <br>
                                        <span>Offer  : Rs. 1100</span></td>
										
                                        <td>5</td>
                                       
                                      
                                    </tr>

                                    <tr>
									<td></td>
                                        <td>#005</td>
                                          
                                        <td>
                                            <div class="d-flex">
                                                <img src="{{asset('assets/images/products/blouse.jpg')}}" alt="" class="img-fluid img-40 me-2 blur-up lazyloaded">
                                                </div>
                                                
                                        </td>
                                        <td>Short Top </td>
                                      
                                      
                                        
                                        <td>
                                        <span>Price : Rs. 1200</span> <br>
                                        <span>Offer  : Rs. 1100</span></td>
										
                                        <td>5</td>
                                     
                                    </tr>

                                   


                                    
                                  

                                    
                                  
                                    </tbody>
                                </table>
											</div>
									
										
									
									
										<div class="form-group row ">
											<div class="text-center">
										<div class="col-xl-8 col-md-8">
										<button class="btn btn-primary" type="submit">Save</button>
										<a href="{{route('auction/list')}}" class="btn btn-secondary" type="button">Close</a>
									</div>
								</div>
							</form>
					
					
				</div>
			</div>
			
			
			
		
			
			
			</div></div>
			
		</div>
		<!-- Container-fluid Ends-->
		
	</div>
	
	<!-- footer start-->
	
	<!-- footer end-->
	
</div>

</div>


 <div class="btn-popup pull-right">
								
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" data-backdrop="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title f-w-600" id="exampleModalLabel">Search Product</h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="" method="post" onsubmit="return confirm('Are you sure, you want to delete it?')" >
                                                      
												<table class="table" id="table"  data-click-to-select="true"  data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table"  data-sort="true" data-pagination="true" data-search="true"    data-resizable="true" data-cookie="true"
      data-click-to-select="true" data-toolbar="#toolbar">
    
                                    <thead>
                                    <tr>
									
																		<th data-field="dd" data-checkbox="true">
              </th>
                                        
                                        <th data-field="id" data-sortable="true"> Id</th>
                                       
                                        <th data-field="image" data-sortable="true"> images</th>
                                        <th data-field="title" data-sortable="true">Title </th>
                                        
                                        <th data-field="price" data-sortable="true">Product Price</th>
										
                                        <th data-field="qty" data-sortable="true">Qty</th>
                                        
                                       
                                    </tr>
                                    </thead>
                                    <tbody>
                                   
                                    <tr>
									 <td></td>
                                        <td>#001</td>
                                       
                                        <td>
                                            <div class="d-flex">
                                                <img src="{{asset('assets/images/products/blouse.jpg')}}" alt="" class="img-fluid img-40 me-2 blur-up lazyloaded">
                                                </div>
                                        </td>
                                        <td>Embroidery Long Kurtis </td>
                                        
                                      
                                        
                                        <td>
                                        <span>Price : Rs. 1200</span> <br>
                                        <span>Offer  : Rs. 1100</span></td>
										
                                        <td>5</td>
                                       
                                      
                                    </tr>

                                    <tr>
									<td></td>
                                        <td>#005</td>
                                          
                                        <td>
                                            <div class="d-flex">
                                                <img src="{{asset('assets/images/products/blouse.jpg')}}" alt="" class="img-fluid img-40 me-2 blur-up lazyloaded">
                                                </div>
                                                
                                        </td>
                                        <td>Short Top </td>
                                      
                                      
                                        
                                        <td>
                                        <span>Price : Rs. 1200</span> <br>
                                        <span>Offer  : Rs. 1100</span></td>
										
                                        <td>5</td>
                                     
                                    </tr>

                                   


                                    
                                  

                                    
                                  
                                    </tbody>
                                </table>
												 </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
    
    	<script>
    		function add()
    		{
    		
    			var startprice = $('#start_price').val();
    			
    			var slab = $('#slab').val();
    			
    		
    			var bid = parseInt(startprice)+parseInt(slab);
    			
    			$('#bid_price').val(bid);
    			
    		}
    
    	</script>


@endsection