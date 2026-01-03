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
							
							
							
							<a href="{{ route('product_colors.create') }}" class="btn btn-primary">Add Color</a><br>
							
							<table class="table" id="table"  data-click-to-select="true"  data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-sort="true" data-pagination="true" data-search="true" data-show-columns="true"  data-show-refresh="true" data-key-events="true"  data-resizable="true" data-cookie="true"
                         data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">

                        
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
										<td ><button type="button" style="background-color: {{ $color->color_code }};">{{ $color->color_code }}</button></td>
										<td>
											   <label class="switch">
                                                        {{-- $status = $pin->status --}}
                                                        
                                                         @if($color->status  == 1){
                                                         <input type="checkbox"
                                                             onclick="return confirm('you want to Change it?  Please Click Edit Button')"
                                                             checked id="togBtn">
                                                         }@else{
                                                             <input type="checkbox"
                                                             onclick="return confirm('you want to Change it?  Please Click Edit Button')" 
                                                              id="togBtn">
                                                         }
                                                         @endif
                                                         <div class="slider round">
                                                             <!--ADDED HTML -->
                                                             <span class="on">Active</span>
                                                             <span class="off">Inactive </span>                                                                
                                                             <!--END-->
                                                         </div>
                                                     </label>
														 </td>
										<td>
											<a href="{{ route('product_colors.edit', $color) }}" class="btn btn-warning" title="Edit"><i class="fa fa-pencil"></i> </a>
											<form action="{{ route('product_colors.destroy', $color) }}"  onsubmit="return confirm('Are you sure you want to delete this color?');" method="POST" style="display:inline;">
												@csrf
												@method('DELETE')
												<button type="submit" class="btn btn-danger" title="Delete"><i class="fa fa-trash"></i> </button>
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
