{{-- <?php include('header.php')?> --}}
@extends('website.layouts.master')

<style>.modal-backdrop {
    z-index: 1040 !important;
}
.modal-backdrop {
    /* bug fix - no overlay */    
    display: block;    
}
</style>
<!-- page-wrapper Start-->

@include('website.pages.topmenu')
<!-- Page Header Ends -->

<!-- Page Body Start-->
<div class="page-body-wrapper">
	
	<!-- Page Sidebar Start-->
	<?php include('sidemenu.php')?>
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
							<h3>Package 
								
							</h3>
						</div>
					</div>
					<div class="col-lg-6">
						<ol class="breadcrumb pull-right">
							<li class="breadcrumb-item"><a href="index.php"><i data-feather="home"></i></a></li>
							<li class="breadcrumb-item active">Package </li>
						</ol>
					</div>
				</div>
			</div>
		</div>
		<!-- Container-fluid Ends-->
		
		<!-- Container-fluid starts-->
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12">
					<div class="card">
						
						<div class="card-body">
							<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal"><i class="fa fa-plus"></i>  Add Package</button>
							
							<div class="btn-popup pull-right">
								
                            <div class="modal fade" id="exampleModal" tabindex="-1"  role="dialog" data-backdrop="static" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title f-w-600" id="exampleModalLabel">Add Package</h5>
												<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
											</div>
											<div class="modal-body">
												<form class="" method="post">
													@csrf
													<div class="form">
                                                        
														<div class="row">
															<div class="col-md-6">														
															<div class="form-group">
															<label for="validationCustom01" class="mb-1">Pack</label>
															<input class="form-control" id="" required=""  type="text">
															</div>
															</div>
															<div class="col-md-6">	
															<div class="form-group">
															<label for="validationCustom01" class="mb-1">Status</label>
															<select class="custom-select w-100 form-control" required="">
																<option value="Active">Active</option>
																<option value="Inactive">Inactive</option>
															</select>
														</div>
														</div>
														</div>
														<div class="form-group">
                                                                <label for="validationCustom02" class="mb-1"> Image :</label>
                                                                <input class="form-control" require="" type="file">
                                                            </div>
                                                        <div class="form-group">
															<label for="validationCustom01" class="mb-1">Price</label>
															<input class="form-control" id="" required="" type="text">
														</div>
														<div class="row">
															<div class="col-md-6">														
															<div class="form-group">
															<label for="validationCustom01" class="mb-1">Validty</label>
															<input class="form-control" id="" required="" type="text">
														</div>
														</div><div class="col-md-6">	
														<div class="form-group">
															<label for="validationCustom01" class="mb-1">++ Days</label>
															<input class="form-control" id="" required="" type="text">
														</div>
														</div>
														</div>
														<div class="form-group">
															<label for="validationCustom01" class="mb-1">Description</label>
															<textarea class="form-control" rows="3" id="validationCustom1" type="text" required="" name="address"></textarea>
											
														</div>
													</div>
												</form>
											</div>
											<div class="modal-footer">
                                                <a href="category.php" onclick="return confirm('Are you sure, you want to Save it?')">    <button class="btn btn-primary" type="button">Save</button></a>
												<button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="datatable-dashv1-list custom-datatable-overright">
								<table class="table" id="table"  data-click-to-select="true" data-show-columns="true" data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-sort="true" data-pagination="true" data-search="true"  data-show-refresh="true" data-key-events="true"  data-resizable="true" data-cookie="true"
								data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                    <thead>
										<tr>
										<th>Image</th>
											<th>Pack</th>
                                            <th>Price</th>
											<th>Validty</th>
											<th>++ Days</th>
											<th>Description</th>
											<th> Status</th>
											<th>Action</th>
										</tr>
									</thead>
                                    <tbody>
										
										<tr>
										<td> <img src="../assets/images/pack/horse.jpg" alt="" class="img-fluid img-50 me-2 blur-up lazyloaded">
										</td>
										
											<td>
											 Gold
											</td>
											<td>1500</td>
											<td>365 Days</td>
											<td>30 days</td>
                                             <td>Gold Package with 365days Validty</td>
                                             </td>
											<td>
											<label class="switch">
											<input type="checkbox"  onclick="return confirm('Are you sure, you want to Change it?')" checked id="togBtn">
												<div class="slider round"><!--ADDED HTML -->
												<span class="off">Inactive </span>
												<span class="on">Active</span><!--END--></div>
												</label>

												</div>
												
												</td>
											<td><span> <a href="#" class="badge badge-secondary px-2"  data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal"data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
											<a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>
											
										</tr>
										
										<tr>
										<td> <img src="../assets/images/pack/horse.jpg" alt="" class="img-fluid img-50 me-2 blur-up lazyloaded">
										</td>
										
											<td>
												Silver
											</td>
                                            <td>1000</td>
											<td>200 Days</td>
										
											<td>20 days</td>
                                             <td>Silver package with 365days validty</td>

                                             </td>
											<td>
											<label class="switch">
											<input type="checkbox"  onclick="return confirm('Are you sure, you want to Change it?')" checked id="togBtn">
												<div class="slider round"><!--ADDED HTML -->
												<span class="off">Inactive </span>
												<span class="on">Active</span><!--END--></div>
											</label>
											</div>
												
												</td>
											<td><span> <a href="#" class="badge badge-secondary px-2"  data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal"data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
											<a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>
											
										</tr>
									</tbody>
								</table>
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