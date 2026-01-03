@extends('layout.auth.master')
@section('contents')
<script src="https://polyfill.io/v3/polyfill.min.js?features=es6"></script>
  <script id="MathJax-script" async
          src="https://cdn.jsdelivr.net/npm/mathjax@3.0.1/es5/tex-mml-chtml.js">
  </script>
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
												<form class="" method="post" action="{{ route('package.store') }}" enctype="multipart/form-data">
													@csrf
													<div class="form">
                                                        
														<div class="row">
															<div class="col-md-6">														
														<div class="form-group">
															<label for="validationCustom01" class="mb-1">Pack</label>
															<input class="form-control" id="" required=""  name="name" type="text">
														</div>
</div><div class="col-md-6">	
<div class="form-group">
															<label for="validationCustom01" class="mb-1">Status</label>
															<select class="custom-select w-100 form-control" name="status" required="">
																
																
																<option value="1">Active</option>
																<option value="0">Inactive</option>
																
															</select>
															
														</div>
</div>
</div>
<div class="form-group">
                                                                <label for="validationCustom02" class="mb-1"> Image :</label>
                                                                <input class="form-control" require="" name="image" type="file">
                                                            </div>
                                                        <div class="form-group">
															<label for="validationCustom01" class="mb-1">Price</label>
															<input class="form-control" id="" required="" name="price" type="text">
														</div>


														<div class="row">
															<div class="col-md-6">														
														
															<div class="form-group">
															<label for="validationCustom01" class="mb-1">Validity</label>
															<input class="form-control" id="" required="" name="validity" type="text">
														</div>
</div><div class="col-md-6">	
<div class="form-group">
															<label for="validationCustom01" class="mb-1">++ Days</label>
															<input class="form-control" id="" required=""  name="days" type="text">
														</div>
</div>
</div>
                                                        <div class="form-group">
															<label for="validationCustom01" class="mb-1">Wallet </label>
															<input class="form-control" id="" required="" name="wallet" type="text">
														</div>
														   <div class="form-group">
															<label for="validationCustom01" class="mb-1">Commission %</label>
															<input class="form-control" id="" required="" name="commission" type="text">
														</div>
														
														<div class="form-group">
															<label for="validationCustom01" class="mb-1">Description</label>
															<textarea class="ckeditor form-control" rows="3" id="description"  required="" name="description"></textarea>
											
														</div>
                                                       
														
													</div>
												
											</div>
											<div class="modal-footer">
                                                <a href="" onclick="return confirm('Are you sure, you want to Save it?')"> <button class="btn btn-primary" type="submit">Save</button></a>
												<button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
											</div>
										</form>
										</div>
									</div>
								</div>
							</div>
							
							
							<div class="datatable-dashv1-list custom-datatable-overright">
								
								
								<table class="table" id="table"  data-click-to-select="true" data-show-columns="true" data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-sort="true" data-pagination="true" data-search="true"  data-show-refresh="true" data-key-events="true"  data-resizable="true" data-cookie="true"
								data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
									
                               
                                    <thead>
										<tr>
											<th>SNO</th>
											<th>Name</th>
										<th>Image</th>
											
                                            <th>Price</th>
											<th>Validity</th>
											
											<th>++ Days</th>
											<th>wallet</th>
											<th>Commission</th>
											<th>Description</th>
											
											
											<th> Status</th>
											<th>Action</th>
										</tr>
									</thead>
                                    <tbody>
										@foreach ($package as $package)
										<tr>
											<td>#{{ $loop->iteration }}</td>
											<td>{{ $package->name }}</td>
											<td>
												<div class="d-flex">
													<img src="{{ asset('assets/images/vendor/package') . '/' . $package->image }}"
														alt=""
														class="img-fluid img-40 me-2 blur-up lazyloaded">
												</div>
											</td>	
										
											<td>{{ $package->price }}</td>
											<td>{{ $package->validity }}</td>
											<td>{{ $package->days }}</td>
											<td>{{ $package->wallet }}</td>
											<td>{{ $package->commission }}</td>
											<td>{!! $package->description !!}</td>
										
										
										
								<td>	
									<div>	
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
										

										@endforeach
										
										
										
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
	
	<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>

<script type="text/javascript">

    $(document).ready(function() {

       $('.ckeditor').ckeditor();

    });

</script>
<script>
	CKEDITOR.replace( 'description' );
</script>
@endsection