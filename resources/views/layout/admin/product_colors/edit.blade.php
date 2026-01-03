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
							<h3>Color 
								
							</h3>
						</div>
					</div>
					<div class="col-lg-6">
						<ol class="breadcrumb pull-right">
							<li class="breadcrumb-item"><a href="index.php"><i data-feather="home"></i></a></li>
							<li class="breadcrumb-item active">Color </li>
						</ol>
					</div>
				</div>
			</div>
		</div>
		<!-- Container-fluid Ends-->
		
		{{-- <!-- Container-fluid starts-->     --}}
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<div class="card">
						
						<div class="card-body"> 
							
							
							<form action="{{ route('product_colors.update', $productColor) }}" method="POST">
								@csrf
								@method('PUT')
								<div class="form-group">
									<label for="color_name">Color Name</label>
									<input type="text" name="color_name" class="form-control" value="{{ $productColor->color_name }}" required>
								</div>
								<div class="form-group">
									<label for="color_code">Color Code</label>
									<input type="color" name="color_code" class="form-control" value="{{ $productColor->color_code }}" required>
								</div>
								<div class="form-group">
									<label for="status">Status</label>
									<select name="status" class="form-control" required>
										<option value="1" {{ $productColor->status == '1' ? 'selected' : '' }}>Active</option>
										<option value="0" {{ $productColor->status == '0' ? 'selected' : '' }}>Inactive</option>
									</select>
								</div>
								<button type="submit" class="btn btn-primary">Update Color</button>
							</form>
						</div>
						
					</div>
				</div>
			</div>
		</div>
		<!-- Container-fluid Ends  add_designation-->
		
	</div>
	@endsection
