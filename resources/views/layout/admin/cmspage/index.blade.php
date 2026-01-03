@extends('layout.auth.master')
@section('contents')

@include('paritials.js.product.attribute-js')
@include('paritials.css.product.attribute-css')



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
							<h3>CMS PAGES
								
							</h3>
						</div>
					</div>
					<div class="col-lg-6">
						<ol class="breadcrumb pull-right">
							<li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}"><i data-feather="home"></i></a></li>
							<li class="breadcrumb-item active">CMS PAGES </li>
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
							
							<a href="{{route('cmspages.create')}}" class="btn mb-4 btn-primary"><i class="fa fa-plus"></i> Add CMS PAGES </a> 
							
							
                            <div class="datatable-dashv1-list custom-datatable-overright">
								
								
								<table class="table" id="table"  data-click-to-select="true"  data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-sort="true" data-pagination="true" data-search="true" data-show-columns="true"  data-show-refresh="true" data-key-events="true"  data-resizable="true" data-cookie="true"
								data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
									
									<thead>
										<tr>
											<th>ID</th>
											<th>Page Name</th>
											<th>Page Title</th>               
											<th>Status</th>
											<th>Actions</th>
										</tr>
									</thead>
									<tbody>
										
										@foreach ($pages as $page)
										<tr>
											<td>{{ $page->id }}</td>
											<td>{{ $page->page_name }}</td>
											<td>{{ $page->page_title }}</td>
											<td>{{ $page->status }}</td>
											<td>
												<a href="{{ route('cmspages.show', $page->id) }}" class="btn btn-sm btn-info">View</a>
												<a href="{{ route('cmspages.edit', $page->id) }}" class="btn btn-sm btn-primary">Edit</a>
												<form action="{{ route('cmspages.destroy', $page->id) }}" method="POST" style="display: inline-block;">
													@csrf
													@method('DELETE')
													<button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure?')">Delete</button>
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
		</div>
	</div>
	<!-- Container-fluid Ends-->
	
</div>
{{-- Edit Attribute --}}
<div class="modal fade fcolor" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title f-w-600" id="exampleModalLabel">Update Attributes</h5>
				<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span
				aria-hidden="true">×</span></button>
			</div>
			
			<div class="modal-body">
				<form class="" method="post"   action="{{ route('update_attributevalues') }}"             
				enctype="multipart/form-data">
					@csrf
					
					
					<div class="form">
						<input type="hidden" name="id" id="edit_id"> 
						
						<div class="col-md-12">
							<table class="table addproduct">
								<tbody class="input_fields_wrap" id="display">
									<thead class="bordered-darkorange">
										<tr role="row">
											<th style="width:150px;">Value</th>
											<th style="width:150px;"></th>
										</tr>
									</thead>
									
									
									<tr>
										<td class="tbl1">
											{{-- <input id="editvalue" name="editvalue[]" class="form-control" type="text"
											placeholder="Enter Value" /> --}}
										</td>
										<td>
											<button type="button" class="add_field_button btn btn-xs btn-primary"
											id="add1">Add More</button>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
						
					</div>
					
					
                    <div class="modal-footer">
					<button  class="btn btn-primary" type="submit">Update</button></a>
					<button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
				</div>
			</form>
		</div>
		
	</div>
</div>
{{-- end --}}
{{-- Edit Attribute --}}
<div class="modal fade fcolor" id="exampleModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
aria-hidden="true">
	<div class="modal-dialog modal-lg" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title f-w-600" id="exampleModalLabel">Selected Category</h5>
				<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span
				aria-hidden="true">×</span></button>
			</div>
			
			<div class="modal-body">
				<form class="" method="post"   action="{{ route('update_attributevalues') }}"             
				enctype="multipart/form-data">
					@csrf
					
					
					<div class="form">
						<input type="hidden" name="id" id="edit_id1"> 
						<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
						<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
						
						
						<div class="row">
							<form class="col-md-12">
								<label>Select</label>
								<select class="form-control select2" multiple style="width:100%;">
									<option>Select</option> 
									<option>Car</option> 
									<option>Bike</option> 
									<option>Scooter</option> 
								<option>Cycle</option> 
								<option>Horse</option> 
								</select>
								</form>
								</div>
								
                                <script>
								$('.select2').select2();
                                </script>
								</div>
								
								</div>
								
								
								<div class="modal-footer">
								<button  class="btn btn-primary" type="submit">Update</button></a>
								<button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
								</div>
								</form>
								</div>
								
								</div>
								</div>
								{{-- end --}}
								<script>
								function readmore(id) {
								var dots = document.getElementById("dots"+id);
								var moreText = document.getElementById("more"+id);
								var btnText = document.getElementById("myBtn"+id);
								
								if (dots.style.display === "none") {
								dots.style.display = "inline";
								btnText.innerHTML = "+ more"; 
								moreText.style.display = "none";
								} else {
								dots.style.display = "none";
								btnText.innerHTML = "+ less"; 
								moreText.style.display = "inline";
								}
								}
								</script>
								
								<script>
								$(document).on('click','.edit_category', function(e){
								
								var id = $(this).val();
								
								$('#edit_id1').val(id);
								
								$('#exampleModal2').modal('show');
								});    </script>    
								<script>
								
								$(document).on('click','.edit_attribute', function(e){
								var editroute1='';
								var htmlPlan='';
								e.preventDefault();
								var id = $(this).val();
								$('#edit_id').val(id);
								//    console.log(pin_id);
								//  alert(id);
								
								$('#exampleModal1').modal('show');
								
								
								//alert(response.subcategory[0].attribute_name);
								//  $k = response.subcategory[0].value;
								//  alert($k);
								var wrapper         = $(".input_fields_wrap"); //Fields wrapper	
								result = $('#attributes_val'+id).val();
								var splitResult = result.split(',');
								cache: false;
								var x=1;
								$(wrapper).html('');
								splitResult.forEach(function(item) {
								
								max_fields = result.length;
								if(x <= max_fields){ //max input box allowed
								x++; //text box increment
								$(wrapper).append('<tr class="attr_row"><td><input id ="value" name="value[]" class="form-control" value ='+item+' type ="text" placeholder="Enter Value" /></td><td><a href="#" id="r'+x+'" class="remove " ><span class="text-danger fw-bold border p-2">X</span></a></td><tr>'); //add input box
								}
								
								});
								
								
								
								});
								
								
								
								</script>
								
								@endsection								