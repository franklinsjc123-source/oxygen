@extends('layout.auth.master')
@section('contents')

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
							<h3>Product Attribute
								<small>oxygen Admin panel</small>
							</h3>
						</div>
					</div>
					<div class="col-lg-6">
						<ol class="breadcrumb pull-right">
							<li class="breadcrumb-item"><a href="index.php"><i data-feather="home"></i></a></li>
							<li class="breadcrumb-item active">Gst</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
		<!-- Container-fluid Ends-->
		
		<!-- Container-fluid starts-->
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<div class="card">
						
						
						<div class="card-body">
							<div class="modal-body">
								<form class="" method="post">
									<div class="form">
										
										
										<div class="form-group">
											<label for="validationCustom01" class="mb-1">Title</label>
											<input class="form-control" id="" require="" type="text">
										</div>
										<div class="form-group">
											<label class="col-form-label"><span>*</span>Atributes Type</label>
											<select class="custom-select form-control" required>
												<option value="">--Select Type--</option>
												<option value="dropdown">Drop Down</option>
                                                <option value="checkbox">Check box</option>
                                                <option value="radiobutton">Radio Button</option>
                                                
											</select>
										</div>
										
										<div class="form-group">
											<label class="col-xl-3 col-md-4">Status</label>
											<div class="col-md-7">
												<div class="checkbox checkbox-primary">
													<input id="checkbox-primary-2" type="checkbox" data-original-title="" title="">
													<label for="checkbox-primary-2">Active</label>
													<input id="checkbox-primary-2" type="checkbox" data-original-title="" title="">
													<label for="checkbox-primary-2">Deactive</label>
												</div>
												
											</div>
										</div>
										
									</div>
									
								</div>
								<div class="col-md-12">
									<h5>Attributes List</h5>
									
									
									<table class="table addproduct" >
										<thead class="bordered-darkorange">
											<tr role="row"> 
												<th style="width:30px;">S.NO</th>
												<th style="width:150px;">Title</th>
												
											</tr>
										</thead>
										<tr>
											<td>1</td>
											
										</td>
										<td><input type="text" id="pid" name="title"  class="form-control " placeholder="title" required /></td>
										
										
										
										
										
										
										
										
										
									</tr>
								</table>
								</br>
								<div class="col-md-3">
									<button type="button" class='addmore btn btn-xs btn-primary '>+ Add More</button>
								</div>
								</br></br>
								
							</div>
							<div class="modal-footer">
								<a href="category.php" onclick="return confirm('Are you sure, you want to Save it?')">    <button class="btn btn-primary" type="button">Save</button></a>
								<button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Container-fluid Ends-->
	
</div>
@endsection