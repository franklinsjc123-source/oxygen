@extends('layout.staff.master')
@section('contents')



<!-- page-wrapper Start-->
@include('paritials.auth.topmenu');
<!-- Page Header Ends -->

<!-- Page Body Start-->
<div class="page-body-wrapper">
	
	<!-- Page Sidebar Start-->
	@include('paritials.staffauth.sidemenu');
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
							
							
							
							<a href="{{ route('staffproduct_colors.create') }}" class="btn btn-primary">Add Color</a><br>
							
							<table class="table" id="table"  data-click-to-select="true"  data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-sort="true" data-pagination="true" data-page-size="25" data-search="true" data-show-columns="true"  data-show-refresh="true" data-key-events="true"  data-resizable="true" data-cookie="true"
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
                                                        
                                                         @if($color->status  == 1)
                                                         <input type="checkbox"
                                                             class="status-toggle" data-id="{{ $color->id }}"
                                                             checked>
                                                         @else
                                                             <input type="checkbox"
                                                             class="status-toggle" data-id="{{ $color->id }}">
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
											<a href="{{ route('staffproduct_colors.edit', $color) }}" class="btn btn-warning" title="Edit"><i class="fa fa-pencil"></i> </a>
											 @if (session()->get('log_type') == 'Admin')
												 <form action="{{ route('staffproduct_colors.destroy', $color) }}" method="POST" style="display:inline;" class="delete-form">
												@csrf
												@method('DELETE')
												<button type="button" class="btn btn-danger delete-btn" title="Delete"><i class="fa fa-trash"></i> </button>
											</form>
											@endif
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
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
	<script>
	    $(document).ready(function() {
	        // Status toggle AJAX
	        $(document).on('change', '.status-toggle', function() {
	            var colorId = $(this).data('id');
	            var nextStatus = $(this).is(':checked') ? '1' : '0';

	            $.ajax({
	                url: "{{ route('staffproduct_colors.status') }}",
	                type: "POST",
	                data: {
	                    "_token": "{{ csrf_token() }}",
	                    "id": colorId,
	                    "status": nextStatus
	                },
	                dataType: "json",
	                success: function(response) {
	                    if (!response.success) {
	                        alert('Status update failed.');
	                        $(this).prop('checked', !$(this).is(':checked'));
	                    }
	                }.bind(this),
	                error: function() {
	                    alert('Status update failed.');
	                    $(this).prop('checked', !$(this).is(':checked'));
	                }.bind(this)
	            });
	        });
	        // Delete SweetAlert
	        $(document).on('click', '.delete-btn', function(e) {
	            e.preventDefault();
	            var form = $(this).closest('form');
	            Swal.fire({
	                title: 'Are you sure?',
	                text: "You want to delete it?",
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
	        });
	    });
	</script>
	<style>
	    .swal2-popup {
	        font-size: 1.6rem !important;
	        width: 500px !important;
	        max-width: 90% !important;
	    }
	</style>
	@endsection

