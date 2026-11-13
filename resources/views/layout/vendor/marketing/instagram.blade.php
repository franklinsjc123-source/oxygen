@extends('layout.auth.master')
@section('contents')

    @include('paritials.vendorauth.header')?>

<!-- page-wrapper Start-->
@include('paritials.vendorauth.topmenu');
<!-- Page Header Ends -->

<!-- Page Body Start-->
<div class="page-body-wrapper">
	
	<!-- Page Sidebar Start-->
	@include('paritials.vendorauth.sidemenu');
	<!-- Page Sidebar Ends-->
	
	<!-- Right sidebar Start-->
	
	<!-- Right sidebar Ends-->
	
    <style>
        @media (min-width: 992px) {
            .page-wrapper .page-body-wrapper .page-header {
                margin: 20px 0 10px 0 !important;
                padding: 0 !important;
                border-bottom: none !important;
            }
        }
        @media (max-width: 991px) {
            .page-wrapper .page-body-wrapper .page-header {
                margin: 15px 0 10px 0 !important;
                padding: 0 !important;
                border-bottom: none !important;
            }
        }
    </style>

        <div class="page-body">		
		<!-- Container-fluid starts-->
		<div class="container-fluid">
			<div class="page-header">
				<div class="row">
					<div class="col-12">
                        <ol class="breadcrumb" style="float: left !important; margin-bottom: 0; padding-left: 0;">
                            <li class="breadcrumb-item"><a href="{{ route('vendordashboard', session()->get('login_id') ?? (auth()->check() ? auth()->user()->login_id : 1)) }}"><i data-feather="home"></i></a></li>
							<li class="breadcrumb-item active">Instagram Campaign</li>
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
							<div id="toolbar" class="d-flex align-items-center gap-2">
								<button type="button" class="btn btn-success btn-export-excel" style="background-color: #73b400; border-color: #73b400; color: #fff;">EXPORT EXCEL</button>
							</div>

							<div class="btn-popup pull-right">
								<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title f-w-600" id="exampleModalLabel">ADD Instagram Budget</h5>
												<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
											</div>
											<div class="modal-body">
												<form class="" action="{{route('vendorinstagram.store')}}" method="post">
													@csrf
													<div class="row fw-bold">
														<div class="col-sm-12">
															<div class="form-group row mb-3">
																<div class="col-md-12">
																	<label for="amount" class="mb-1">Budget :</label>
																	<input class="form-control" id="amount" name="amount" type="number" min="0" placeholder="Enter budget amount" required>
																</div>
															</div>

															<div class="form-group row mb-3">
																<div class="col-md-12">
																	<label for="impressions" class="mb-1">Add Impressions :</label>
																	<input class="form-control" id="impressions" name="impressions" type="number" min="0" placeholder="Enter impressions count" required>
																</div>
															</div>

															<div class="form-group row mb-3">
																<div class="col-md-12">
																	<label for="clicks" class="mb-1">Clicks :</label>
																	<input class="form-control" id="clicks" name="clicks" type="number" min="0" placeholder="Enter clicks count" required>
																</div>
															</div>

															<div class="form-group row mb-3">
																<div class="col-md-12">
																	<label for="duration" class="mb-1">Duration (Days) :</label>
																	<input class="form-control" id="duration" name="duration" type="number" min="0" placeholder="Enter duration in days" required>
																</div>
															</div>

															<div class="form-group row mb-3">
																<div class="col-md-12">
																	<label for="status" class="mb-1">Status :</label>
																	<select class="custom-select w-100 form-control" required id="status" name="status">
																		<option value="">--Select--</option>
																		<option value="1" selected>Active</option>
																		<option value="0">Inactive</option>
																	</select>
																</div>
															</div>

															<div class="form-group row mt-4">
																<div class="col-12 d-flex justify-content-end gap-2 text-end" style="justify-content: flex-end !important; text-align: right;">
																	<button class="btn btn-primary" type="submit">Save</button>
																	<button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
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
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title f-w-600" id="exampleModalLabel">Edit Instagram Budget</h5>
												<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
											</div>
											<div class="modal-body">
												<form class="" action="{{route('vendorinstagram.update', 1)}}" method="post">
													@csrf
													@method('PUT')
													<div class="row fw-bold">
														<div class="col-sm-12">
															<input type="hidden" id="edit_id" name="edit_id">

															<div class="form-group row mb-3">
																<div class="col-md-12">
																	<label for="editamount" class="mb-1">Budget :</label>
																	<input class="form-control" id="editamount" name="editamount" type="number" min="0" placeholder="Enter budget amount" required>
																</div>
															</div>

															<div class="form-group row mb-3">
																<div class="col-md-12">
																	<label for="editimpressions" class="mb-1">Add Impressions :</label>
																	<input class="form-control" id="editimpressions" name="editimpressions" type="number" min="0" placeholder="Enter impressions count" required>
																</div>
															</div>

															<div class="form-group row mb-3">
																<div class="col-md-12">
																	<label for="editclicks" class="mb-1">Clicks :</label>
																	<input class="form-control" id="editclicks" name="editclicks" type="number" min="0" placeholder="Enter clicks count" required>
																</div>
															</div>

															<div class="form-group row mb-3">
																<div class="col-md-12">
																	<label for="editduration" class="mb-1">Duration (Days) :</label>
																	<input class="form-control" id="editduration" name="editduration" type="number" min="0" placeholder="Enter duration in days" required>
																</div>
															</div>

															<div class="form-group row mb-3">
																<div class="col-md-12">
																	<label for="editstatus" class="mb-1">Status :</label>
																	<select class="custom-select w-100 form-control" required id="editstatus" name="editstatus">
																		<option value="">--Select--</option>
																		<option value="1">Active</option>
																		<option value="0">Inactive</option>
																	</select>
																</div>
															</div>

															<div class="form-group row mt-4">
																<div class="col-12 d-flex justify-content-end gap-2 text-end" style="justify-content: flex-end !important; text-align: right;">
																	<button class="btn btn-primary" type="submit">Save</button>
																	<button class="btn btn-secondary" data-bs-dismiss="modal" type="button">Close</button>
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
							



							<div class="row">
								<div class="datatable-dashv1-list custom-datatable-overright">                            
									<table class="table" id="table"  data-click-to-select="true" data-show-columns="true" data-sort-name="budget" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-sort="true" data-pagination="true" data-page-size="100" data-search="true"  data-show-refresh="false" data-key-events="true"  data-resizable="true" data-cookie="true"
											 data-show-export="false" data-click-to-select="true" data-toolbar="#toolbar">                                        
                                    <thead>
                                     <tr>
                                        <th data-field="budget" data-sortable="true">Budget</th>
                                        <th data-field="impressions" data-sortable="true">Add Impressions</th>
                                        <th data-field="clicks" data-sortable="true">Clicks</th>
                                        <th data-field="duration" data-sortable="true">Duration</th>
                                        <th data-field="status" data-sortable="true">Status</th>
									    <th>Action</th>
                                     </tr>
                                    </thead>
                                    <tbody>
										@foreach ($instagrame as $item)
									<tr>
										<td>
											<div class="d-flex">
												{{$item->amount}}
											</div>
										</td>
											
										<td>{{$item->impressions}}</td>
										<td>{{$item->clicks}}</td>
										<td>{{$item->duration}}</td>
										<td>
											<label class="switch">
												 @if($item->status == 1)
												 <input type="checkbox" checked id="togBtn_{{$item->id}}" class="status-toggle" data-id="{{$item->id}}">
												 @else
												 <input type="checkbox" id="togBtn_{{$item->id}}" class="status-toggle" data-id="{{$item->id}}">
												 @endif
												 <div class="slider round">
													 <span class="on">Active</span>
													 <span class="off">Inactive </span>                                                                
												 </div>
											 </label>										
                            			</td>
										<td><span class="d-flex">
											<button type="button" value="{{$item->id}}" class="edit_facebook btn btn-secondary mx-1"> 
												<i class="fa fa-pencil"></i></button> 
											{{-- <a href="#" class="badge badge-secondary px-2"  data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal"data-original-title="Edit"><i class="fa fa-pencil"></i> </a> --}}
											<form action="{{ route('vendorinstagram.destroy', $item->id) }}" method="post" class="delete-form">
												@method('DELETE')
												@csrf
												<button type="button" class="btn btn-warning mx-1 delete-btn">
													<i class="fa fa-trash"></i>
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
		</div>
		<!-- Container-fluid Ends-->		
	</div>
@endsection


@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
    .swal2-popup {
        font-size: 1.6rem !important;
    }
</style>
<script>
    $(document).on('click', '.edit_facebook', function(e){

        e.preventDefault();

        //alert('cate_id');
        var ad_id = $(this).val();
        $('#exampleModal1').modal('show');
		console.log(ad_id);
        var url = "{{route('vendorinstagram.edit', ':ad_id')}}";
        url = url.replace(":ad_id", ad_id);

        $.ajax({
             url:url,       
             type: "get",
             dataType: 'json',
             success: function (response) {
                  console.log(response);
                if(response.status == 404)
                {
                   $('successmessage').html('');
                   $('successmessage').addClass('alert alert-danger');
                   $('successmessage').text(response.message);
                }
                else{
                    $('#edit_id').val(response.instagrame.id);
                    $('#editamount').val(response.instagrame.amount);
                    $('#editimpressions').val(response.instagrame.impressions);
                    $('#editclicks').val(response.instagrame.clicks);
                    $('#editduration').val(response.instagrame.duration);
                    $('#editstatus').val(response.instagrame.status);  
                }
            }
        });
        
    });

    // Use event delegation for delete buttons because bootstrap-table recreates DOM elements
    document.body.addEventListener('click', function(e) {
        if (e.target.closest('.delete-btn')) {
            e.preventDefault();
            const button = e.target.closest('.delete-btn');
            const form = button.closest('.delete-form');
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    });

    // Use event delegation for status toggle
    document.body.addEventListener('change', function(e) {
        if (e.target.classList.contains('status-toggle')) {
            const status = e.target.checked ? 1 : 0;
            const item_id = e.target.getAttribute('data-id');
            const token = document.querySelector('meta[name="csrf-token"]') ? document.querySelector('meta[name="csrf-token"]').getAttribute('content') : '{{ csrf_token() }}';

            fetch("{{ route('vendorinstagram.changestatus') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': token
                },
                body: JSON.stringify({
                    id: item_id,
                    status: status
                })
            })
            .then(response => response.json())
            .then(data => {
                // Silently succeed
            })
            .catch(error => {
                console.error('Error updating status:', error);
                // Revert toggle if failed
                e.target.checked = !status;
            });
        }
    });
</script>
@endpush
