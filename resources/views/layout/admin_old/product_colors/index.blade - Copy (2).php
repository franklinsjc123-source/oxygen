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
				<div class="col-sm-12">
					<div class="card">
						
						<div class="card-body"> 
							
							
							<h1>Product Colors</h1>
							<a href="{{ route('product_colors.create') }}" class="btn btn-primary">Add Color</a>
							<table class="table">
								<thead>
									<tr>
										<th>ID</th>
										<th>Color Name</th>
										<th>Color Code</th>
										<th>Status</th>
										<th>Actions</th>
									</tr>
								</thead>
								<tbody>
									@foreach ($colors as $color)
									<tr>
										<td>{{ $color->id }}</td>
										<td>{{ $color->color_name }}</td>
										<td style="background-color: {{ $color->color_code }};">{{ $color->color_code }}</td>
										<td>{{ $color->status }}</td>
										<td>
											<a href="{{ route('product_colors.edit', $color) }}" class="btn btn-warning">Edit</a>
											<form action="{{ route('product_colors.destroy', $color) }}" method="POST" style="display:inline;">
												@csrf
												@method('DELETE')
												<button type="submit" class="btn btn-danger">Delete</button>
											</form>
										</td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						
					</div>
				</div>
			</div>
		</div>
		<!-- Container-fluid Ends  add_designation-->
		
	</div>
	@endsection
