@extends('layout.auth.master')
@section('contents')

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
							<h3>Add CMS PAGE
								
							</h3>
						</div>
					</div>
					<div class="col-lg-6">
						<ol class="breadcrumb pull-right">
							<li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}"><i data-feather="home"></i></a></li>
							
							<li class="breadcrumb-item active">Add CMS PAGE</li>
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
					
					
					
					<form action="{{ route('cmspages.store') }}" method="POST">
						@csrf
						<div class="row">
							<div class="col-md-5">
								<div class="mb-3">
									<label for="page_name" class="form-label">Page Name</label>
									<select class="form-control" id="page_name" name="page_name" required>
										<option value="">Select Page Name</option>
										<option value="About Us">About Us</option>
										<option value="Contact Us">Contact Us</option>
										<option value="Terms & Conditions">Terms & Conditions</option>
										<option value="Privacy Policy">Privacy Policy</option>
										<option value="Shipping Policy">Shipping Policy</option>
										<option value="Refund Policy">Refund Policy</option>
									</select>
								</div>
							</div>
							<div class="col-md-5">
								<div class="mb-3">
									<label for="page_title" class="form-label">Page Title</label>
									<input type="text" class="form-control" id="page_title" name="page_title" required>
								</div>
							</div>
							<div class="col-md-2">
								<div class="mb-3">
									<label for="status" class="form-label">Status</label>
									<select class="form-control" id="status" name="status" required>
										<option value="1">Active</option>
										<option value="0">Inactive</option>
									</select>
								</div>
							</div>
						</div>
						<div class="mb-3">
							<label for="page_content" class="form-label">Page Content</label>
							<textarea class="form-control ckeditor" id="page_content" name="page_content" rows="20" required></textarea>
						</div>
						
						
						
						<button type="submit" class="btn btn-primary">Create Page</button>
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
	
	
	@endsection	
