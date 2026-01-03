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
                            <h3>Activity Tracker
								
							</h3>
						</div>
					</div>
					<div class="col-lg-6">
						<ol class="breadcrumb pull-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}"><i data-feather="home"></i></a></li>
							
							<li class="breadcrumb-item active">Cities</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
		<!-- Container-fluid Ends-->
		
		<!-- Container-fluid starts-->
		<div class="container-fluid">
			<div class="row">
				
				<div class="col-xl-12">
					<div class="card tab2-card">
						<div class="card-body">
							
							<div class="tab-content" id="top-tabContent">
								
								<!-- Button to Open Modal for Creating State -->
								<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#stateModal">
									Add State
								</button>
								
								<!-- Bootstrap Modal -->
								<div class="modal fade" id="stateModal" tabindex="-1" aria-labelledby="stateModalLabel" aria-hidden="true">
									<div class="modal-dialog">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="stateModalLabel">Add State</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											
											<div class="modal-body">
												<!-- AJAX Form for Adding or Editing State -->
												<form id="stateForm" action="{{ route('states.store') }}" method="POST">
													@csrf
													<input type="hidden" id="state_id" name="state_id">
													<input type="hidden" name="_method" value="POST"> 
													
													<div class="mb-3">
														<label for="state_name" class="form-label">State Name</label>
														<input type="text" name="state_name" id="state_name" class="form-control" required>
													</div>
													
													<div class="mb-3">
														<label for="status" class="form-label">Status</label>
														<select name="status" id="status" class="form-control">
															<option value="Active">Active</option>
															<option value="Inactive">Inactive</option>
														</select>
													</div>
													
													<input type="submit" class="btn btn-success" id="upd_but">
												</form>
											</div>
										</div>
									</div>
								</div>
								
								<!-- Table of States -->
								<div class="mt-4">
									<h3>State List</h3>
									<table class="table" id="table"  data-click-to-select="true"  data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-show-columns="true" data-sort="true" data-pagination="true" data-search="true"  data-show-refresh="true" data-key-events="true"  data-resizable="true" data-cookie="true"
									data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
										<thead>
											<tr>
												<th>State Name</th>
												<th>Status</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody>
											@foreach($states as $state)
											<tr>
												<td>{{ $state->state_name }}</td>
												<td>{{ $state->status }}</td>
												<td>
													<!-- Edit Button Opens Modal for Editing -->
													<button type="button" class="btn btn-warning btn-sm editState" 
													data-bs-toggle="modal" 
													data-bs-target="#stateModal"
													data-state-id="{{ $state->id }}"
													data-state-name="{{ $state->state_name }}"
													data-status="{{ $state->status }}">
														Edit
													</button>
													
													<!-- Delete Form -->
													<form action="{{ route('states.destroy', $state->id) }}" method="POST" style="display:inline;">
														@csrf
														@method('DELETE')
														<button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
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
	
	<!-- footer start-->
	
	<!-- footer end-->
	
</div>

</div>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
	$(document).ready(function() {
		// Open Modal with Pre-filled Data when Editing
		$('.editState').click(function() {
			var stateId = $(this).data('state-id');
			var stateName = $(this).data('state-name');
			var status = $(this).data('status');
			
			$('#stateModalLabel').text('Edit State');
			$('#state_name').val(stateName);
			$('#status').val(status);
			$('#state_id').val(stateId);
			$('#upd_but').val('Update State');
			
			
			var form = $('#stateForm');
			
			form.attr('action', '{{ route("states.update", ":stateId") }}'.replace(':stateId', stateId));
				// Change form action dynamically
			form.find('[name="_method"]').val('PUT'); // Set method to PUT
		});
		
		// Reset Modal Form when Opening for Adding a New State
		$('#stateModal').on('hidden.bs.modal', function() {
			$('#stateModalLabel').text('Add State');
			$('#stateForm')[0].reset(); // Reset form fields
			$('#state_id').val('');
			$('#upd_but').val('Add State');
			$('#stateForm').attr('action', '{{ route("states.store") }}'); // Reset form action
			$('#stateForm').find('[name="_method"]').val('POST'); // Reset method to POST
		});
		
		// Submit Form using AJAX
		$('#stateForm').on('submit', function(e) {
			e.preventDefault();
			
			var form = $(this);
			var formAction = form.attr('action'); // Get dynamically set action URL
			var formData = form.serialize(); // Serialize form data
			
			$.ajax({
				url: formAction,
				method: form.find('[name="_method"]').val(), // Dynamically use PUT or POST
				data: formData,
				success: function(response) {
					alert("State saved successfully!");
					$('#stateModal').modal('hide');
					location.reload(); // Reload page to reflect changes
				},
				error: function(response) {
					alert("Error saving state!");
				}
			});
		});
	});
</script>

@endsection
