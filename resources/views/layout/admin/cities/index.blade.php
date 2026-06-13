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
                            <h3>City List
								
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
								<!-- Button to Open Modal for Creating City -->
								<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#cityModal" id="addCityBtn">
									Add City
								</button>
								
								<!-- Bootstrap Modal for Adding/Editing City -->
								<div class="modal fade" id="cityModal" tabindex="-1" aria-labelledby="cityModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-dialog-centered">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title" id="cityModalLabel">Add City</h5>
												<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
											</div>
											
											<div class="modal-body">
												<form id="cityForm">
													@csrf
													<input type="hidden" name="_method" id="formMethod" value="POST">
													<input type="hidden" name="city_id" id="city_id">
													
													<div class="mb-3">
														<label for="city_name" class="form-label">City Name</label>
														<input type="text" name="city_name" id="city_name" class="form-control" required>
													</div>
													
													<div class="mb-3">
														<label for="state_id" class="form-label">State</label>
														<select name="state_id" id="state_id" class="form-control" required>
															<option value="">Select State</option>
															@foreach($states as $state)
															<option value="{{ $state->id }}">{{ $state->state_name }}</option>
															@endforeach
														</select>
													</div>
													
													<div class="mb-3">
														<label for="status" class="form-label">Status</label>
														<select name="status" id="status" class="form-control">
															<option value="Active">Active</option>
															<option value="Inactive">Inactive</option>
														</select>
													</div>
													
													<button type="submit" class="btn btn-success">Save City</button>
												</form>
											</div>
										</div>
									</div>
								</div>
								
								<!-- Table of Cities -->
								<div class="mt-4">
									<table class="table" id="table"  data-click-to-select="true"  data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-show-columns="true" data-sort="true" data-pagination="true" data-page-size="25" data-search="true"  data-show-refresh="true" data-key-events="true"  data-resizable="true" data-cookie="true"
									data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
										<thead>
											<tr>
												<th>ID</th>
												<th>City Name</th>
												<th>State</th>
												<th>Status</th>
												<th>Actions</th>
											</tr>
										</thead>
										<tbody>
											@foreach($cities as $city)
											<tr>
												<td>{{ $city->id }}</td>
												<td>{{ $city->city_name }}</td>
												<td>{{ $city->state->state_name }}</td>
												<td>
                                                    <label class="switch">
                                                        <input type="checkbox" class="toggle-status" data-id="{{ $city->id }}" {{ $city->status == 'Active' ? 'checked' : '' }}>
                                                        <div class="slider round">
                                                            <span class="off">Inactive </span>
                                                            <span class="on">Active</span>
                                                        </div>
                                                    </label>
                                                </td>
												<td>
													<!-- Edit Button Opens Modal -->
													<button type="button" class="btn btn-secondary mx-1 btn-sm edit-city"
													data-bs-toggle="modal" data-bs-target="#cityModal"
													data-city-id="{{ $city->id }}"
													data-city-name="{{ $city->city_name }}"
													data-state-id="{{ $city->state_id }}"
													data-status="{{ $city->status }}">
														<i class="fa fa-pencil"></i>
													</button>
													
													<!-- Delete Form -->
													<form action="{{ route('cities.destroy', $city->id) }}" method="POST" class="d-inline delete-form">
														@csrf
														@method('DELETE')
														<button type="submit" class="btn btn-warning mx-1 btn-sm"><i class="fa fa-trash"></i></button>
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
		// Open Modal for Adding a New City
		$('#addCityBtn').click(function() {
			$('#cityModalLabel').text('Add City');
			$('#cityForm')[0].reset();
			$('#formMethod').val('POST');
			$('#city_id').val('');
		});
		
		// Open Modal for Editing City
		$(document).on('click', '.edit-city', function(e) {
			var btn = $(e.currentTarget);
			var cityId = btn.attr('data-city-id');
			var cityName = btn.attr('data-city-name');
			var stateId = btn.attr('data-state-id');
			var status = btn.attr('data-status');
			
			console.log("Edit City Clicked", cityId, cityName, stateId, status);
			
			$('#cityModalLabel').text('Edit City');
			$('#city_id').val(cityId);
			$('#city_name').val(cityName);
			$('#state_id').val(stateId);
			$('#status').val(status);
			$('#formMethod').val('PUT');
		});
		
		// AJAX Form Submission for Creating & Updating City
		$('#cityForm').on('submit', function(e) {
			e.preventDefault();
			
			var cityId = $('#city_id').val();
			var method = cityId ? 'PUT' : 'POST';
			var url = cityId ? "{{ url('admin/cities') }}/" + cityId : "{{ route('cities.store') }}";
			
			
			$.ajax({
				url: url,
				type: 'POST',
				data: $(this).serialize() + '&_method=' + method,
				success: function(response) {
					alert(response.message);
					$('#cityModal').modal('hide');
					location.reload();
				},
				error: function(xhr) {
					let errors = xhr.responseJSON.errors;
					let errorMsg = "Error:\n";
					for (let field in errors) {
						errorMsg += errors[field][0] + "\n";
					}
					alert(errorMsg);
				}
			});
		});
		
</script>
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
        var status = $(this).prop('checked') ? 'Active' : 'Inactive';
        var id = $(this).data('id');
        var checkbox = $(this);

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{ route('cities.changestatus') }}",
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
    $(document).on('submit', '.delete-form', function(e) {
        e.preventDefault();
        var form = this;
        Swal.fire({
            title: 'Are you sure?',
            text: "You want to delete this City! This cannot be undone.",
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
    });
});
</script>
@endpush
@endsection

