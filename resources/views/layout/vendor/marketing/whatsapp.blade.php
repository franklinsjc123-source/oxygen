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
							<h3>Whatsapp Campaign 							
							</h3>
						</div>
					</div>
					<div class="col-lg-6">
						<ol class="breadcrumb pull-right">
							<li class="breadcrumb-item"><a href="dashboard.php"><i data-feather="home"></i></a></li>
							<li class="breadcrumb-item active">Whatsapp Campaign</li>							
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
						<button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal"><i class="fa fa-plus"></i> Create Types</button>

							<div class="btn-popup pull-right">
								<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title f-w-600" id="exampleModalLabel">ADD Whatsapp Budget</h5>
												<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
											</div>
											<div class="modal-body">
												<form class="" action="{{route('vendorwhatsapp.store')}}" method="post" onsubmit="return confirm('Are you sure, you want to Save it?')" enctype="multipart/form-data">
													@csrf
													<div class="row fw-bold">
														<div class="col-sm-12">
															<div class="form-group row">
																<div class="col-md-12">																	
																	<label for="validationCustom1" class="mb-1">Title :</label>
																	<input class="form-control" id="title" name="title" type="text" required >																															
																</div>				
															</div>

															<div class="form-group row">																
																<div class="col-md-12">
																	<label for="validationCustom1" class="col-xl-3 col-md-4">Sub title :</label>
																	<input class="form-control" id="sub_title" name="sub_title" type="text" required="" >
																</div>											
															</div>
										
															<div class="form-group row ">
																<div class="col-md-12">	
																	<label for="validationCustom1" class="col-xl-3 col-md-4">Line 1 :</label>									
																	<input class="form-control" id="line1" name="line1" type="text" required="" >
																</div>											
															</div>

															<div class="form-group row ">
																<div class="col-md-12">		
																<label for="validationCustom1" class="col-xl-3 col-md-4">Line 2 :</label>							
																	<input class="form-control" id="line2" name="line2" type="text" required="" >
																</div>
															</div>

															<div class="form-group row ">
																<div class="col-md-12">	
																<label for="validationCustom1" class="col-xl-3 col-md-4">Mobile :</label>
																	<input class="form-control" id="ph_no" name="ph_no" type="number" required="" >
																</div>
															</div>

															<div class="form-group row ">
																<div class="col-md-12">
																<label for="validationCustom1" class="col-xl-3 col-md-4">Background Image :</label>
																	<input class="form-control" id="image" name="image" type="file"  accept="image/*" required="" >
																</div>
															</div>	
									
															<div class="form-group row">																
																<div class="col-md-12">
																	<label class="col-xl-3 col-md-4">Status</label>
																	<select class="custom-select w-100 form-control" required="" id="status" name="status" onchange="discount()" >
																		<option value="">--Select--</option>
																		<option value="1" >Active</option>
																		<option value="0" >Inactive</option>
																	</select>
																</div>
															</div>	
									
															<div class="form-group row ">
																<div class="text-center">
																	<div class="col-xl-8 col-md-8">
																		<button class="btn btn-primary" type="submit">Save</button>
                                        							    <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
																	</div>
																</div>
															</div>
														</div>	
													</div>
												</form>
											</div>
										</div>
									</div>							
								</div>
							</div>

							{{-- EIDT MODEL --}}

							<div class="btn-popup pull-right">
								<div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title f-w-600" id="exampleModalLabel">Edit Whatsapp Budget</h5>
												<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
											</div>
											<div class="modal-body">
												<form class="" action="{{route('vendorwhatsapp.update', 1)}}" method="post" onsubmit="return confirm('Are you sure, you want to Save it?')" enctype="multipart/form-data">
													@csrf
													@method('PUT')
													<div class="row fw-bold">
														<div class="col-sm-12">
															<input type="hidden" id="edit_id" name="edit_id">
															<div class="form-group row">
																<div class="col-md-12">																	
																	<label for="validationCustom1" class="mb-1">Title :</label>
																	<input class="form-control" id="edittitle" name="edittitle" type="text" required >																															
																</div>
															</div>

															<div class="form-group row">																
																<div class="col-md-12">
																	<label for="validationCustom1" class="col-xl-3 col-md-4">Sub title :</label>
																	<input class="form-control" id="editsub_title" name="editsub_title" type="text" required="" >
																</div>
															</div>
										
															<div class="form-group row ">
																<div class="col-md-12">	
																	<label for="validationCustom1" class="col-xl-3 col-md-4">Line 1 :</label>									
																	<input class="form-control" id="editline1" name="editline1" type="text" required="" >
																</div>
															</div>

															<div class="form-group row ">
																<div class="col-md-12">		
																<label for="validationCustom1" class="col-xl-3 col-md-4">Line 2 :</label>							
																	<input class="form-control" id="editline2" name="editline2" type="text" required="" >
																</div>
															</div>

															<div class="form-group row ">
																<div class="col-md-12">	
																<label for="validationCustom1" class="col-xl-3 col-md-4">Mobile :</label>
																	<input class="form-control" id="editph_no" name="editph_no" type="number" required="" >
																</div>
															</div>

															<div class="form-group row ">
																<div class="col-md-12">
																<label for="validationCustom1" class="col-xl-3 col-md-4">Background Image :</label>
																	<input class="form-control" id="editimage" name="editimage" type="file"  accept="image/*" >
																	<input class="form-control" id="oldimage" name="oldimage" type="hidden"  >
																</div>
															</div>
									
															<div class="form-group row">																
																<div class="col-md-12">
																	<label class="col-xl-3 col-md-4">Status</label>
																	<select class="custom-select w-100 form-control" required="" id="editstatus" name="editstatus" onchange="discount()" >
																		<option value="">--Select--</option>
																		<option value="1" >Active</option>
																		<option value="0" >Inactive</option>
																	</select>
																</div>
															</div>	
									
															<div class="form-group row ">
																<div class="text-center">
																	<div class="col-xl-8 col-md-8">
																		<button class="btn btn-primary" type="submit">Save</button>
                                        							    <button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
																	</div>
																</div>
															</div>
														</div>	
													</div>
												</form>
											</div>
										</div>
									</div>							
								</div>
							</div>
							



							<div class="datatable-dashv1-list custom-datatable-overright">                            
                            	<table class="table" id="table"  data-click-to-select="true" data-show-columns="true" data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-sort="true" data-pagination="true" data-search="true"  data-show-refresh="true" data-key-events="true"  data-resizable="true" data-cookie="true"
                                         data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">                                        
                                    <thead>
                                     <tr>
                                        <th data-field="id" data-sortable="true">Id</th>
										<th data-field="image" data-sortable="true">Image</th> 
                                        <th data-field="title" data-sortable="true">Title</th>
                                        <th data-field="sub_title" data-sortable="true">Sub Title</th>
                                        <th data-field="line1" data-sortable="true">Line 1</th>
                                        <th data-field="line2" data-sortable="true">Line 2</th>
                                        <th data-field="mobile" data-sortable="true">Mobile</th>
										<th data-field="status" data-sortable="true">Status</th>										
									    <th>Action</th>
                                     </tr>
                                    </thead>
                                    <tbody>
										@foreach ($whapp as $item)
									<tr>
										<td>{{$loop->iteration}}</td>
										<td>
											{{-- <div class="d-flex">
												<img src="{{asset('assets/images/banners/adv-baner') . '/' .$item->image}}" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">
											</div> --}}
											<div class="d-flex">
											<img src="{{asset('assets/images//Marketting/Wh_app_template'). '/' .$item->image}}" alt="" class="img-fluid img-40 me-2 blur-up lazyloaded"> 
											</div>
										</td>
										<td>
											<div class="d-flex">
												{{$item->title}}
											</div>
										</td>
											
										<td>{{$item->sub_title}}</td>
										<td>{{$item->line1}}</td>
										<td>{{$item->line2}}</td>
										<td>{{$item->mobile}}</td>
										<td>
											<label class="switch">
												{{-- $status = $pin->status --}}
												 @if($item->status  == 1){
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
										<td><span class="d-flex">
											<button type="button" value="{{$item->id}}" class="edit_facebook btn btn-secondary mx-1"> 
												<i class="fa fa-pencil"></i></button> 
											{{-- <a href="#" class="badge badge-secondary px-2"  data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal"data-original-title="Edit"><i class="fa fa-pencil"></i> </a> --}}
											<form
											action="{{ route('vendorwhatsapp.destroy', $item->id) }}"
											method="post">
											@method('DELETE')
											@csrf
											<button type="submit" class="btn btn-warning mx-1"
												onclick="return confirm('Are you sure, you want to delete it?')"><i
													class="fa fa-trash"></i>
											</button>
										</form>
											{{-- <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td> --}}
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
@endsection


@push('scripts')
<script>
    $(document).on('click', '.edit_facebook', function(e){

        e.preventDefault();

        //alert('cate_id');
        var ad_id = $(this).val();
        $('#exampleModal1').modal('show');
		console.log(ad_id);
        var url = "{{route('vendorwhatsapp.edit', ":ad_id")}}";
        url = url.replace(":ad_id", ad_id);

            $.ajax({
            
             url:url,       
             type: "get",
             _token: "csrf",
             dataType: 'json',
             success: function (response) {
                  console.log(response);
                //alert(response);
               if(response.status == 404)
               {
               //  alert('test');
               $('successmessage').html('');
               $('successmessage').addClass('alert alert-danger');
               $('successmessage').text(response.message);
               }

                else{
                   // alert(response);

                $('#edit_id').val(response.whapp.id);
                $('#edittitle    ').val(response.whapp.title);
                $('#editsub_title').val(response.whapp.sub_title);
                $('#editline1    ').val(response.whapp.line1);
                $('#editline2    ').val(response.whapp.line2);
				$('#editph_no    ').val(response.whapp.ph_no);
				$('#oldimage    ').val(response.whapp.image);
                $('#editstatus   ').val(response.whapp.status);  
                }
            }

            //alert('dfhdgfjftg');
            // error: function (response){

            // }

        });
        
    });

</script>
@endpush
