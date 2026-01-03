@extends('layout.auth.master')
@section('contents')
@include('paritials.auth.header')?>

<!-- page-wrapper Start-->
@include('paritials.auth.topmenu');
<!-- Page Header Ends -->

<!-- Page Body Start-->
<div class="page-body-wrapper">
	
	<!-- Page Sidebar Start-->
	@include('paritials.vendorauth.sidemenu');
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
							<h3>Sub Category
								
							</h3>
						</div>
					</div>
					<div class="col-lg-6">
						<ol class="breadcrumb pull-right">
							<li class="breadcrumb-item"><a href="dashboard.php"><i data-feather="home"></i></a></li>
							<li class="breadcrumb-item active">Sub Category</li>
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
							
							<div class="datatable-dashv1-list custom-datatable-overright">
								<table class="table" id="table" data-click-to-select="true"
								data-show-columns="true" data-sort-name="id" data-sort-order="asc"
								data-mobile-responsive="true" data-toggle="table" data-sort="true"
								data-pagination="true" data-search="true" data-show-refresh="true"
								data-key-events="true" data-resizable="true" data-cookie="true"
								data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
									
									<thead>
										<tr>
											<th data-field="id" data-sortable="true">Id</th>
											<th data-field="image" data-sortable="true">Image</th>
											<th data-field="maincategory" data-sortable="true">Main Category</th>
											<th data-field="category" data-sortable="true">Category</th>
											<th data-field="subcategory" data-sortable="true">Sub Category</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>
										
										@foreach ($sub_category_data as $sub_category)
										<tr>
											<td>{{str_pad($loop->iteration, 4, '0', STR_PAD_LEFT);  }}</td>
											<td>
												<div class="d-flex">
													<img src="{{ asset('assets/images/categorySub') . '/' . $sub_category->category_sub_image }}"
													alt=""
													class="img-fluid img-30 me-2 blur-up lazyloaded">
												</div>
											</td>
											
											<td>{{ $sub_category->category_main_name }}  </td>
											<td>{{ $sub_category->category_name }}  </td>
											<td>{{ $sub_category->category_sub_name }}  </td>
											<td>
												<a href="{{url('vendar/viewcategory_sub/'.$sub_category->me_id)}}" class="btn btn-warning"> View </a>
											</td>
										</tr>
										@endforeach
									</tbody>
								</table>
							</div>
							<!--<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
							data-original-title="test" data-bs-target="#exampleModal"><i class="fa fa-plus"></i> 
							View sub Category</button>-->
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Container-fluid Ends-->
	</div>
	
	
	
	@if($view=='Modal')
	<div class="btn-popup pull-right">
		
		 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title f-w-600" id="exampleModalLabel">Add Product sub
						Category</h5>
						<button class="btn-close" type="button" data-bs-dismiss="modal"
						aria-label="Close" ><span aria-hidden="true">×</span></button>
					</div>
					<div class="modal-body">
						<div class="row">
							<div class="col-6">
								<img src="{{ asset('assets/images/categorySub') . '/' . $sub_category_viewdata->category_sub_image }}"
								alt=""
								class="img-fluid  me-2 blur-up lazyloaded"> 
							</div>
							<div class="col-6">
								<table class="table table-bordered">
									<tr>
										<td> Main Category : </td>
										
										<td>{{ $sub_category_viewdata->category_main_name }}  </td>
									</tr>
									<tr>
										<td>  Category : </td>
										<td>{{ $sub_category_viewdata->category_name }}  </td>
									</tr>
									<tr>
										<td> Sub Category : </td>
										<td>{{ $sub_category_viewdata->category_sub_name }}  </td>
									</tr>
								</table>
							</div>
							<div class="col-12">
								<table class="table">
									<tr>
										<td colspan="2"> Attributes : <br>
											<table class="table table-bordered">
												<tr>
													
													<th>Name</th>
													<th>Reference Name</th>
													
													
													<th>Attributes</th> 
												</tr>
												@foreach ($attributegroup as $group)
												@php
												$attr_val = json_decode($group->attribute_values);
												@endphp
												<tr>
													<td>{{ $group->attribute_group_name }}</td>
													<td>{{ $group->attribute_group_refname }}</td>
													<td>
														<p>
															@foreach ($attr_val as $key => $value) 
															
															<span class='p-1 border border-dark px-3 mx-1 rounded'>  {{ $value }}</span>
															@endforeach
														</p>	 
													</td>
												</tr>
												@endforeach
											</table>
										</td>
										
									</tr>
									<tr>
										<td colspan="2"> Specification : <br>
											<table class="table table-bordered">
												<tr>
													
													<th>Name</th>
													<th>Reference Name</th>
													
													
													<th>Attributes</th> 
												</tr>
												@foreach ($specificationgroup as $group) 
												@php
												$spec_val = json_decode($group->specification_values); @endphp
												<tr>
													<td>{{ $group->specification_group_name }}</td>
													<td>{{ $group->specification_group_refname }}</td>
													<td> <p>
														@foreach ($spec_val as $key => $value) 
														
														<span class='p-1 border border-dark px-3 mx-1 rounded'>  {{ $value }}</span>
														@endforeach
													</p>
													</td>
												</tr>
												@endforeach
											</table>
										</td>
										
									</tr>
								</div>
								
							</div>
						</div>
					</div>
				</div>
			</div>
				</div>
				@endif
			<script>
				// AJAX REQUEST
				function getAjaxValue(url, method, callback) {
					$.ajax({
						url: url,
						type: method,
						data: {
							"_token": "{{ csrf_token() }}"
						},
						dataType: "json",
						success: callback
					});
				}
			
			
	</script>
	@if($view=='Modal')
	 <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
 <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
	<script>
				
				
				$('#exampleModal').modal('show');
				function hide() {
 
    // Closing the modal using Bootstrap's modal API (without jQuery)
    var modal = new bootstrap.Modal(document.getElementById('exampleModal'));
    modal.hide();  // Close the modal
}
	</script>
	@endif
	@endsection
