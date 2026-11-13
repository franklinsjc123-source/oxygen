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
					<div class="col-12">
                        <ol class="breadcrumb" style="float: left !important; margin-bottom: 0; padding-left: 0;">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}"><i data-feather="home"></i></a></li>
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
							<div id="toolbar" class="d-flex align-items-center gap-2">
								<button type="button" class="btn btn-success btn-export-excel" style="background-color: #73b400; border-color: #73b400; color: #fff;"><i class="fa fa-file-excel-o me-1"></i> EXPORT EXCEL</button>
								<button type="button" class="btn btn-primary text-uppercase ms-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal"><i class="fa fa-plus"></i> Create Types</button>
							</div>

							<div class="btn-popup pull-right">
								<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title f-w-600" id="exampleModalLabel">ADD Whatsapp Template</h5>
												<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											</div>
											<div class="modal-body">
												<form class="" action="{{route('whatsapp.store')}}" method="post"  enctype="multipart/form-data">
													@csrf
													<div class="row fw-bold">
														<div class="col-sm-12">
															<div class="form-group row mb-3">
																<div class="col-md-12">
																	<label for="orientation" class="mb-1">Poster Size / Orientation :</label>
																	<select class="custom-select w-100 form-control" id="orientation" name="sub_title">
																		<option value="Portrait (1080x1920)">Portrait (1080 &times; 1920 px)</option>
																		<option value="Landscape (1920x1080)">Landscape (1920 &times; 1080 px)</option>
																	</select>
																</div>
															</div>

															<div class="form-group row mb-3">
																<div class="col-md-12">
																	<div class="d-flex justify-content-between align-items-center mb-1">
																		<label for="image" class="mb-0">Template :</label>
																		<span class="badge bg-light text-dark border font-weight-normal" style="font-size: 11px; font-weight: normal;">
																			Portrait: 1080&times;1920 px | Landscape: 1920&times;1080 px
																		</span>
																	</div>
																	<input class="form-control" id="image" name="image" type="file" accept="image/*" required>
																	<small id="image_size_hint" class="text-muted d-block mt-1">
																		<i class="fa fa-info-circle me-1"></i> Recommended size: <strong>Portrait 1080&times;1920 px</strong> or <strong>Landscape 1920&times;1080 px</strong>
																	</small>
																</div>
															</div>

															<div class="form-group row mb-3">
																<div class="col-md-12">
																	<label for="status" class="mb-1">Status :</label>
																	<select class="custom-select w-100 form-control" required id="status" name="status">
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
												<h5 class="modal-title f-w-600" id="exampleModalLabel">Edit Whatsapp Template</h5>
												<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
											</div>
											<div class="modal-body">
												<form class="" action="{{route('whatsapp.update', 1)}}" method="post"  enctype="multipart/form-data">
													@csrf
													@method('PUT')
													<div class="row fw-bold">
														<div class="col-sm-12">
															<input type="hidden" id="edit_id" name="edit_id">
															<input class="form-control" id="oldimage" name="oldimage" type="hidden">

															<div class="form-group row mb-3">
																<div class="col-md-12">
																	<label for="editorientation" class="mb-1">Poster Size / Orientation :</label>
																	<select class="custom-select w-100 form-control" id="editorientation" name="editsub_title">
																		<option value="Portrait (1080x1920)">Portrait (1080 &times; 1920 px)</option>
																		<option value="Landscape (1920x1080)">Landscape (1920 &times; 1080 px)</option>
																	</select>
																</div>
															</div>

															<div class="form-group row mb-3">
																<div class="col-md-12">
																	<div class="d-flex justify-content-between align-items-center mb-1">
																		<label for="editimage" class="mb-0">Template :</label>
																		<span class="badge bg-light text-dark border font-weight-normal" style="font-size: 11px; font-weight: normal;">
																			Portrait: 1080&times;1920 px | Landscape: 1920&times;1080 px
																		</span>
																	</div>
																	<input class="form-control" id="editimage" name="editimage" type="file" accept="image/*">
																	<small id="edit_image_size_hint" class="text-muted d-block mt-1">
																		<i class="fa fa-info-circle me-1"></i> Recommended size: <strong>Portrait 1080&times;1920 px</strong> or <strong>Landscape 1920&times;1080 px</strong>
																	</small>
																	<div id="current_template_preview" class="mt-2"></div>
																</div>
															</div>

															<div class="form-group row mb-3">
																<div class="col-md-12">
																	<label for="editstatus" class="mb-1">Status :</label>
																	<select class="custom-select w-100 form-control" required id="editstatus" name="editstatus">
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
									<table class="table" id="table" data-click-to-select="true" data-show-columns="true" data-sort-name="status" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-sort="true" data-pagination="true" data-page-size="100" data-search="true" data-show-refresh="false" data-key-events="true" data-resizable="true" data-cookie="true"
											 data-show-export="false" data-click-to-select="true" data-toolbar="#toolbar">                                        
                                    <thead>
                                     <tr>
										<th data-field="image" data-sortable="false">Template</th> 
										<th data-field="orientation" data-sortable="true">Poster Size / Orientation</th> 
										<th data-field="status" data-sortable="true">Status</th>										
									    <th>Action</th>
                                     </tr>
                                    </thead>
                                    <tbody>
										@foreach ($whapp as $item)
									<tr>
										<td>
											<div class="d-flex align-items-center">
												<img src="{{asset('assets/images//Marketting/Wh_app_template'). '/' .$item->image}}" alt="Template" class="img-fluid rounded border" style="max-height: 60px; max-width: 90px; object-fit: contain;"> 
											</div>
										</td>
										<td>
											@php
												$isLand = (stripos($item->sub_title, 'Landscape') !== false);
												$badgeClass = $isLand ? 'bg-primary' : 'bg-success';
												$dispOrientation = !empty($item->sub_title) && $item->sub_title != '-' ? $item->sub_title : 'Portrait (1080x1920)';
											@endphp
											<span class="badge {{ $badgeClass }} text-white" style="font-size: 11px; padding: 4px 8px;">{{ $dispOrientation }}</span>
										</td>
										<td>
											<label class="switch">
												 <input type="checkbox" class="toggle-status" data-id="{{ $item->id }}" {{ $item->status == 1 ? 'checked' : '' }}>
												 <div class="slider round">
													 <span class="on">Active</span>
													 <span class="off">Inactive </span>                                                                
												 </div>
											 </label>										
                            			</td>
										<td><span class="d-flex">
											<button type="button" value="{{$item->id}}" class="edit_facebook btn btn-secondary mx-1" title="Edit"> 
												<i class="fa fa-pencil"></i></button> 
												@if (session()->get('log_type') == 'Admin')
													<form
											action="{{ route('whatsapp.destroy', $item->id) }}"
											method="post">
											@method('DELETE')
											@csrf
											<button type="submit" class="btn btn-warning mx-1" title="Delete"><i
													class="fa fa-trash"></i>
											</button>
										</form>
										@endif
											</span></td>
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
$(document).ready(function() {
    // Status Toggle
    $(document).on('change', '.toggle-status', function() {
        var status = $(this).prop('checked') ? 1 : 0;
        var id = $(this).data('id');
        var checkbox = $(this);

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{ route('whatsapp.changestatus') }}",
            data: {'status': status, 'id': id, '_token': '{{ csrf_token() }}'},
            success: function(data) {
                // Instantly changed
            },
            error: function() {
                checkbox.prop('checked', !status);
                Swal.fire('Error!', 'Something went wrong.', 'error');
            }
        });
    });

    // Delete Confirmation
    $(document).on('submit', 'form', function(e) {
        if($(this).find('input[name="_method"][value="DELETE"]').length > 0) {
            e.preventDefault();
            var form = this;
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this template! This cannot be undone.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    });
});
</script>
<script>
    $(document).on('click', '.edit_facebook', function(e){
        e.preventDefault();

        var ad_id = $(this).val();
        $('#exampleModal1').modal('show');
        var url = "{{route('whatsapp.edit', ":ad_id")}}";
        url = url.replace(":ad_id", ad_id);

        $.ajax({
            url: url,       
            type: "get",
            _token: "csrf",
            dataType: 'json',
            success: function (response) {
                if(response.status == 404) {
                    Swal.fire('Error!', response.message, 'error');
                } else {
                    $('#edit_id').val(response.whapp.id);
                    $('#oldimage').val(response.whapp.image);
                    $('#editstatus').val(response.whapp.status);
                    $('#editorientation').val(response.whapp.sub_title && response.whapp.sub_title !== '-' ? response.whapp.sub_title : 'Portrait (1080x1920)');
                    if(response.whapp.image) {
                        var imgUrl = "{{ asset('assets/images//Marketting/Wh_app_template') }}/" + response.whapp.image;
                        $('#current_template_preview').html('<div class="d-flex align-items-center mt-2 gap-2"><img src="' + imgUrl + '" class="img-fluid rounded border" style="max-height: 80px;" alt="Current Template"><span class="text-muted small">Current Template</span></div>');
                    } else {
                        $('#current_template_preview').html('');
                    }
                }
            }
        });
    });

    // Auto-detect image dimensions on upload
    $('#image').on('change', function(e) {
        if (this.files && this.files[0]) {
            var file = this.files[0];
            var img = new Image();
            img.onload = function() {
                var w = this.width;
                var h = this.height;
                var orient = (h >= w) ? 'Portrait' : 'Landscape';
                var recVal = (h >= w) ? 'Portrait (1080x1920)' : 'Landscape (1920x1080)';
                $('#orientation').val(recVal);
                $('#image_size_hint').html('<span class="text-success fw-bold"><i class="fa fa-check-circle me-1"></i> Uploaded: ' + orient + ' (' + w + ' &times; ' + h + ' px)</span> <span class="text-muted">(Standard: ' + (orient === 'Portrait' ? '1080&times;1920 px' : '1920&times;1080 px') + ')</span>');
            };
            img.src = URL.createObjectURL(file);
        }
    });

    $('#editimage').on('change', function(e) {
        if (this.files && this.files[0]) {
            var file = this.files[0];
            var img = new Image();
            img.onload = function() {
                var w = this.width;
                var h = this.height;
                var orient = (h >= w) ? 'Portrait' : 'Landscape';
                var recVal = (h >= w) ? 'Portrait (1080x1920)' : 'Landscape (1920x1080)';
                $('#editorientation').val(recVal);
                $('#edit_image_size_hint').html('<span class="text-success fw-bold"><i class="fa fa-check-circle me-1"></i> Uploaded: ' + orient + ' (' + w + ' &times; ' + h + ' px)</span> <span class="text-muted">(Standard: ' + (orient === 'Portrait' ? '1080&times;1920 px' : '1920&times;1080 px') + ')</span>');
            };
            img.src = URL.createObjectURL(file);
        }
    });
</script>
@endpush
