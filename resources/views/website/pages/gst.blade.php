{{-- <?php include('header.php')?> --}}
@extends('website.layouts.master')
<!-- page-wrapper Start-->

@include('website.pages.topmenu')
<!-- Page Header Ends -->

<!-- Page Body Start-->
<div class="page-body-wrapper">
	
	<!-- Page Sidebar Start-->
	
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
							<h3>GST Listing
								
							</h3>
						</div>
					</div>
					<div class="col-lg-6">
						<ol class="breadcrumb pull-right">
							<li class="breadcrumb-item"><a href="index.php"><i data-feather="home"></i></a></li>
							<li class="breadcrumb-item active">Gst Listing</li>
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
						<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal"><i class="fa fa-plus"></i> Add Gst</button>
								
							<div class="btn-popup pull-right">
								<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title f-w-600" id="exampleModalLabel">Add GST</h5>
												<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
											</div>
											<div class="modal-body">
												<form class="" method="post">
                                                    @csrf
													<div class="form">
                                                        												
														<div class="form-group">
															<label for="validationCustom01" class="mb-1">GST  Name</label>
															<input class="form-control" id="gstname" require="" type="text" onblur="myFunction()">
														</div>
														
														<div class="form-group">
															<label for="validationCustom01" class="mb-1">GST Value</label>
															<input class="form-control" id="gstvalue" require="" type="text" >
														</div> 

														
														<div class="form-group">
															<label for="validationCustom01" class="mb-1">GST Description</label>
															<input class="form-control" id="" require="" type="text">
														</div>
														<div class="form-group">
                                                        <label for="validationCustom01" class="mb-1">Status</label>
                                                        <select class="custom-select w-100 form-control" required="">
                                               
                                               
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                              
                                            </select>
                                                              
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
							<div class="card-body">
                                <table class="table" id="table"  data-click-to-select="true"  data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-sort="true" data-pagination="true" data-search="true" data-show-columns="true"  data-show-refresh="true" data-key-events="true"  data-resizable="true" data-cookie="true"
     data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
    
<thead>
 <tr>
   <th data-field="id" data-sortable="true">ID</th> 
											<th data-field="name" data-sortable="true">GST</th>
											<th data-field="value" data-sortable="true">GST Value</th>
											<th data-field="description" data-sortable="true">Description</th>
											
											<th data-field="status" data-sortable="true"> Status</th>
											<th>Action</th>
										</tr>
									</thead>
                                    <tbody>
										
										<tr>
											<td>#001</td>
											
											
											<td>GST 5%</td>
											<td>5%</td>
											<td>Gst5% For Product </td>
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
											<td>#005</td>
											
											
											<td>GST 18%</td>
											<td>8%</td>
											<td>Gst8% For Product </td>
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
	<script>
		function myFunction(){
		
		var pvalue=document.getElementById("productvalue").value;
			 var gst=document.getElementById("gstname").value;
			let gst1=0.18;
			let gst2=0.32;
			if (gst == 18){
				
				var t=parseFloat(pvalue)*parseFloat(gst1);
				
				document.getElementById("gstvalue").value=t;
				
				}
			 else if(gst == 32){
				 
				 
				 var t=parseFloat(pvalue)*parseFloat(gst2);
				
				 document.getElementById("gstvalue").value=t;
				 
				 }
			
			 else{
				 alert("enter the correct value");
				 
				 
				 }
			
			
			
			}
		
		
		</script>
    @endsection
	{{-- <?php include('newfooter.php')?> --}}