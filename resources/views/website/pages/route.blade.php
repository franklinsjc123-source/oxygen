{{-- <?php include('header.php')?> --}}
@extends('website.layouts.master')

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
							<h3>Route
								
							</h3>
						</div>
					</div>
					<div class="col-lg-6">
						<ol class="breadcrumb pull-right">
							<li class="breadcrumb-item"><a href="index.php"><i data-feather="home"></i></a></li>
							<li class="breadcrumb-item active">Route</li>
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
							<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal"><i class="fa fa-plus"></i> Add Route</button>
							
							<div class="btn-popup pull-right">
								
								<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" data-backdrop="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title f-w-600" id="exampleModalLabel">Route</h5>
												<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
											</div>
											<div class="modal-body">
												<form class="" method="post">
													@csrf
													<div class="form">
														
														<div class="form-group">
															<label for="validationCustom01" class="mb-1">Select Zonal :</label>
															<select class="custom-select w-100 form-control" required="">
																<option value="">--Select--</option>
																
																<option value="2">Z01</option>
																<option value="2">Z02</option>
																<option value="2">Z03</option>
																
															</select>
															
														</div>
														
														<div class="form-group">
															<label for="validationCustom01" class="mb-1">Route Name :</label>
															<input class="form-control" id="" type="text" required="true">
														</div>
														
														<div class="form-group">
															<label for="validationCustom01" class="mb-1">Status</label>
															<select class="custom-select w-100 form-control" required="">
																
																
																<option value="Active">Active</option>
																<option value="Inactive">Inactive</option>
																
															</select>
															
														</div>
													</div>
													
												</div>
                                                <div class="modal-footer">
													<button class="btn btn-primary" type="submit">Save</button>
                                                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
												</div>
												
											</form>
										</div>
									</div>
								</div>
							</div>
							
							
							<div class="datatable-dashv1-list custom-datatable-overright">
								
								
								<table class="table" id="table"  data-click-to-select="true" data-show-columns="true"  data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-sort="true" data-pagination="true" data-search="true"  data-show-refresh="true" data-key-events="true"  data-resizable="true" data-cookie="true"
								data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
									
                                    <thead>
										<tr>
											<th data-field="id" data-sortable="true">Route ID</th> 
											<th data-field="image" data-sortable="true" >Zonal</th>
											<th data-field="category" data-sortable="true">Route</th>
											
											
											<th data-field="status" data-sortable="true">Status</th>
											<th>Action</th>
										</tr>
									</thead>
                                    <tbody>
										
										
										
										<tr>
											<td>001</td>
											
											
											
											<td>
											Z01

											</td>
											<td style="width:100%;">	
												Blue
											</td>
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
											<td>001</td>
											
											
											
											<td>
											Z15

											</td>
											<td style="width:100%;">	
												Yellow
											</td>
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
								</table> </div>
								
								
								
								
                                
								
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Container-fluid Ends-->
		
	</div>
	
	<script src="../assets/js/jquery-3.3.1.min.js"></script>
	
	<!-- Bootstrap js-->
	<script src="../assets/js/bootstrap.bundle.min.js"></script>
	
	<!-- feather icon js-->
	<script src="../assets/js/icons/feather-icon/feather.min.js"></script>
	<script src="../assets/js/icons/feather-icon/feather-icon.js"></script>
	
	<!-- Sidebar jquery-->
	<script src="../assets/js/sidebar-menu.js"></script>
	
	<!-- Datatable js-->
	<script src="../assets/js/datatables/jquery.dataTables.min.js"></script>
	<script src="../assets/js/datatables/custom-basic.js"></script>
	
	<!--Customizer admin-->
	<script src="../assets/js/admin-customizer.js"></script>
	
	<!-- lazyload js-->
	<script src="../assets/js/lazysizes.min.js"></script>
	
	<!--right sidebar js-->
	<script src="../assets/js/chat-menu.js"></script>
	
	<!--script admin-->
	<script src="../assets/js/admin-script.js"></script>
	
	<!--new-->
	
	<!-- jquery
	============================================ -->
	
    <!-- bootstrap JS
	============================================ -->
    <script src="../assets/js/bootstrap.min.js"></script>
    <!-- wow JS
	============================================ -->
    
    <!-- data table JS
	============================================ -->
    <script src="../assets/js/data-table/bootstrap-table.js"></script>
    <script src="../assets/js/data-table/tableExport.js"></script>
    <script src="../assets/js/data-table/data-table-active.js"></script>
    <script src="../assets/js/data-table/bootstrap-table-editable.js"></script>
    <script src="../assets/js/data-table/bootstrap-editable.js"></script>
    <script src="../assets/js/data-table/bootstrap-table-resizable.js"></script>
    <script src="../assets/js/data-table/colResizable-1.5.source.js"></script>
    <script src="../assets/js/data-table/bootstrap-table-export.js"></script>
    <!--  editable JS
	============================================ -->
    
    <!-- Chart JS
	============================================ -->
	
@endsection