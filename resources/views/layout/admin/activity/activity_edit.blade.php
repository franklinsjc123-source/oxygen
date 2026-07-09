@extends('layout.auth.master')
@section('contents')

   

<!-- page-wrapper Start-->
@include('paritials.auth.topmenu');
<!-- Page Header Ends -->

<!-- Page Body Start-->
<div class="page-body-wrapper">
	
	<!-- Page Sidebar Start-->
	@if(request()->is('staff/*') || (session()->get('log_type') != 'Admin'))
		@include('paritials.staffauth.sidemenu');
	@else
		@include('paritials.auth.sidemenu');
	@endif
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
                            <li class="breadcrumb-item"><a href="{{ (request()->is('staff/*') || (session()->get('log_type') != 'Admin')) ? route('staffdashboard', session()->get('login_id')) : url('admin/dashboard') }}"><i data-feather="home"></i></a></li>
							
							<li class="breadcrumb-item active">Activity Tracker</li>
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
                                   
                                <form action="{{ route(request()->is('staff/*') ? 'staffactivity_trackers.update' : 'activity_trackers.update', $tracker->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
									
										<div class="row mt-4">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">  Shop Name</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="validationCustom0" type="text" required="" name="shopname" value="{{ old('shopname', $tracker->shop_name) }}">
											</div>
										</div>
</div>
<div class="col-md-6">
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4"> Owner Name</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="validationCustom0" type="text" required="" name="ownername" value="{{ old('ownername', $tracker->owner_name) }}">
											</div>
										</div>
</div>
</div>

<div class="row">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4"> Business Category</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="validationCustom0" type="text" required="" name="businesscategory" value="{{ old('businesscategory', $tracker->business_category) }}">
											</div>
										</div>
</div>
<div class="col-md-6">
<div class="form-group row">
											<label for="validationCustom2" class="col-xl-4 col-md-4">E-Mail</label>
											<div class="col-xl-8 col-md-7">
												<input class="form-control" id="validationCustom2" type="email" required="" name="email" value="{{ old('email', $tracker->email) }}">
											</div>
										</div>
</div>
</div>

										
											
									

									


<div class="row">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">  Mobile Number</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="validationCustom0" type="text" required="" name="mobile" value="{{ old('mobile', $tracker->mobile_number) }}">
											</div>
										</div>
</div>
<div class="col-md-6">
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">Alternate Number</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="validationCustom0" type="text" required="" name="alternatemobile" value="{{ old('alternatemobile', $tracker->mobile_number1) }}">
											</div>
										</div>
</div>
</div>
<div class="row">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4"> Address Line 1</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="validationCustom0" type="text" required="" name="address1" value="{{ old('address1', $tracker->address) }}">
											</div>
										</div>
</div>
<div class="col-md-6">
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">Address Line 2</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="validationCustom0" type="text" required="" name="address2" value="{{ old('address2', $tracker->address1) }}">
											</div>
										</div>
</div>
</div>
<div class="row">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom01" class="col-xl-4 col-md-4">State :</label>
											<div class="col-xl-8 col-md-8">


											<select class="custom-select w-100 form-control" name="state" required="" >
																<option value="">--Select--</option>
																
																@foreach ($State as $st)
												<option value="{{ $st->state_name }}" {{($tracker->state==$st->state_name)?'selected':''}}> {{ $st->state_name }} </option>
												@endforeach   
																
															</select>
											
											</div>
										</div>
                                        </div>
                                        <div class="col-md-6">
                                        <div class="form-group row">
											<label for="validationCustom01" class="col-xl-4 col-md-4">City:</label>
											<div class="col-xl-8 col-md-8">
												<select class="custom-select w-100 form-control" name="city" required="">
																<option value="">--Select--</option>
																
																@foreach ($City as $ct)
												<option value="{{ $ct->city_name }}" {{($tracker->city==$ct->city_name)?'selected':''}}> {{ $ct->city_name }} </option>
												@endforeach  
																
															</select>
											</div>
										</div>
</div>
</div>

<div class="row">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4"> Pincode</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="validationCustom0" type="text" required="" name="pincode" value="{{ old('pincode', $tracker->pincode) }}">
											</div>
										</div>
</div>
<div class="col-md-6">
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">Location Map</label>
											<div class="col-xl-8 col-md-8">
												<div class="input-group mb-2">
													<input class="form-control" id="location_map" type="text" name="locationmap" required placeholder="Select location on map" value="{{ old('locationmap', $tracker->location_map) }}" readonly>
													<button class="btn btn-primary" id="btn_open_map" type="button" data-bs-toggle="modal" data-bs-target="#vendorMapModal">
														<i class="fa fa-map-marker"></i> Pick on Map
													</button>
													<button class="btn btn-info ms-2" id="btn_current_location" type="button">
														<i class="fa fa-crosshairs"></i> Current Location
													</button>
												</div>
												<input type="hidden" name="latitude" id="latitude">
												<input type="hidden" name="longitude" id="longitude">
												<small class="text-muted">Stored Coordinates: <span id="coords_display">{{ old('locationmap', $tracker->location_map) ?: 'N/A' }}</span></small>
											</div>
										</div>
</div>
</div>

<div class="row">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4"> Zone</label>
											<div class="col-xl-8 col-md-8">
											<select class="form-control" name="zone" id="zone">

												<option value=''>Select zone</option>

												@foreach ($zone as $zo)
												<option value="{{ $zo->name }}" {{($tracker->zone==$zo->name)?'selected':''}}> {{ $zo->name }} </option>
												@endforeach   
												</select></div>
										</div>
</div>
<div class="col-md-6">
<div class="form-group row">
											<label for="validationCustom2" class="col-xl-4 col-md-4">Area</label>
											<div class="col-xl-8 col-md-7">
												<input class="form-control" id="validationCustom2"  type="text" required="" name="route" value="{{ old('route', $tracker->area) }}">
											</div>
										</div>
</div>
</div>

<div class="row">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">Pipeline</label>
											<div class="col-xl-8 col-md-8">
												<select class="custom-select w-100 form-control" name="pipe" required="">
																<option value="">--Select--</option>
																
																<option value="Appoinment Fixed" {{($tracker->pipline=='Appoinment Fixed')?'selected':''}}>Appoinment Fixed</option>
																<option value="Package Explained" {{($tracker->pipline=='Package Explained')?'selected':''}}>Package Explained</option>
																<option value="Negotiating" {{($tracker->pipline=='Negotiating')?'selected':''}}>Negotiating</option>
																<option value="Pending Decision" {{($tracker->pipline=='Pending Decision')?'selected':''}}>Pending Decision</option>
																<option value="Not Interested" {{($tracker->pipline=='Not Interested')?'selected':''}}>Not Interested</option>
																<option value="Interested" {{($tracker->pipline=='Interested')?'selected':''}}>Interested</option>
															</select>
											</div>
										</div>
</div>

<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">Win %</label>
											<div class="col-xl-8 col-md-8">
												<select class="custom-select w-100 form-control" name="win" required="">
																<option value="">--Select--</option>
																
																<option value="10%-25%" {{($tracker->win=='10%-25%')?'selected':''}}>10%-25%</option>
																<option value="25%-50%" {{($tracker->win=='25%-50%')?'selected':''}}>25%-50%</option>
																<option value="50%-75%" {{($tracker->win=='50%-75%')?'selected':''}}>50%-75%</option>
																<option value="75%-100%" {{($tracker->win=='75%-100%')?'selected':''}}>75%-100%</option>
																
															</select>
											</div>
										</div>
</div>

<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">Reference</label>
											<div class="col-xl-8 col-md-8">
												<select class="custom-select w-100 form-control" name="reference" required="">
																<option value="">--Select--</option>
																
																<option value="Self" {{($tracker->reference=='Self')?'selected':''}}>Self</option>
																<option value="Referral" {{($tracker->reference=='Referral')?'selected':''}}>Referral</option>
																<option value="Tele-Calling" {{($tracker->reference=='Tele-Calling')?'selected':''}}>Tele-Calling</option>
																<option value="Advertisement" {{($tracker->reference=='Advertisement')?'selected':''}}>Advertisement</option>
															
															</select>
											</div>
										</div>
</div>


<div class="col-md-6">
<div class="form-group row">
											<label for="validationCustom2" class="col-xl-4 col-md-4">Next Follow-up Date</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="next_follow_date"  type="date" required="" name="next_follow_date" value="{{ old('next_follow_date', $tracker->next_follow_date) }}">
											</div>
										</div>
</div>
</div>

<div class="row">
	<div class="col-md-6">
		<div class="form-group row">
			<label for="validationCustom0" class="col-xl-4 col-md-4">Status</label>
			<div class="col-xl-8 col-md-8">
				<select class="custom-select w-100 form-control" name="status" required="">
					<option value="">--Select--</option>
					<option value="Pending" {{($tracker->status=='Pending')?'selected':''}}>Pending</option>
					<option value="Waiting" {{($tracker->status=='Waiting')?'selected':''}}>Waiting</option>
					<option value="Accepted" {{($tracker->status=='Accepted')?'selected':''}}>Accepted</option>
					<option value="Rejected" {{($tracker->status=='Rejected')?'selected':''}}>Rejected</option>
				</select>
			</div>
		</div>
	</div>

	<div class="col-md-6">										
		<div class="form-group row">
			<label for="validationCustom1" class="col-xl-4 col-md-4">Reason</label>
			<div class="col-xl-8 col-md-8">
				<textarea class="form-control" rows="3" id="validationCustom1" type="text" required="" name="reason">{{ old('reason', $tracker->reason) }}</textarea>
			</div>
		</div>
	</div>
</div>

<div class="row">
	<div class="col-md-6">									
		<div class="form-group row">
			<label for="manufacturer_type" class="col-xl-4 col-md-4">Source Type</label>
			<div class="col-xl-8 col-md-8">
				<select class="custom-select w-100 form-control" name="manufacturer_type" required="">
					<option value="">--Select--</option>
					<option value="Direct from Manufacturer" {{($tracker->manufacturer_type=='Direct from Manufacturer')?'selected':''}}>Direct from Manufacturer</option>
					<option value="Wholesalers" {{($tracker->manufacturer_type=='Wholesalers')?'selected':''}}>Wholesalers</option>
					<option value="Distributors" {{($tracker->manufacturer_type=='Distributors')?'selected':''}}>Distributors</option>
					<option value="B2B Marketplace" {{($tracker->manufacturer_type=='B2B Marketplace')?'selected':''}}>B2B Marketplace</option>
					<option value="Others" {{($tracker->manufacturer_type=='Others')?'selected':''}}>Others</option>
				</select>
			</div>
		</div>
	</div>

	<div class="col-md-6">	
		<div class="form-group row">
			<label for="manufacturer_details" class="col-xl-4 col-md-4">Manufacturer Details</label>
			<div class="col-xl-8 col-md-8">
				<textarea class="form-control" rows="3" id="manufacturer_details" type="text" required="" name="manufacturer_details">{{ old('manufacturer_details', $tracker->manufacturer_details) }}</textarea>
			</div>
		</div>
	</div>	
</div>							
<div class="modal-footer">   <button class="btn btn-lg btn-secondary px-5" type="button">Close</button>
                                                   <button class="btn  px-5 btn-lg btn-primary" type="submit">Save & Reopen</button>
                                                  
                                                </div>
                                    </form>
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

        <!-- footer start-->
     
        <!-- footer end-->

    </div>

</div>
<!-- Location Map Modal -->
<div class="modal fade" id="vendorMapModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="vendorMapModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="vendorMapModalLabel">Select Location on Map</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div id="map" style="height: 450px; width: 100%; border-radius: 8px;"></div>
                <p class="mt-2 text-muted">Click on the map or drag the blue marker to set the precise location.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Confirm & Close</button>
            </div>
        </div>
    </div>
</div>

<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" />
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"></script>
<script>
    $(document).ready(function() {
        var mapInitialized = false;
        var map, marker;
        
        // Use existing coordinates if available, otherwise default to Chennai
        var existingCoords = $('#location_map').val().split(',');
        var defaultLat = existingCoords.length == 2 && !isNaN(parseFloat(existingCoords[0])) ? parseFloat(existingCoords[0]) : 13.0827;
        var defaultLng = existingCoords.length == 2 && !isNaN(parseFloat(existingCoords[1])) ? parseFloat(existingCoords[1]) : 80.2707;

        function updateInputs(lat, lng) {
            $('#latitude').val(lat.toFixed(8));
            $('#longitude').val(lng.toFixed(8));
            $('#location_map').val(lat.toFixed(8) + ', ' + lng.toFixed(8));
            $('#coords_display').text(lat.toFixed(8) + ', ' + lng.toFixed(8));
        }

        function initMap() {
            if (mapInitialized) return;
            
            map = L.map('map').setView([defaultLat, defaultLng], 13);
            
            L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
            }).addTo(map);

            marker = L.marker([defaultLat, defaultLng], {
                draggable: true
            }).addTo(map);

            marker.on('dragend', function(event) {
                var position = marker.getLatLng();
                updateInputs(position.lat, position.lng);
            });

            map.on('click', function(e) {
                marker.setLatLng(e.latlng);
                updateInputs(e.latlng.lat, e.latlng.lng);
            });

            mapInitialized = true;
        }

        // Current Location Logic
        $('#btn_current_location').on('click', function() {
            if (navigator.geolocation) {
                var $btn = $(this);
                var originalHtml = $btn.html();
                $btn.html('<i class="fa fa-spinner fa-spin"></i> Getting Location...').prop('disabled', true);

                navigator.geolocation.getCurrentPosition(function(position) {
                    var lat = position.coords.latitude;
                    var lng = position.coords.longitude;
                    
                    updateInputs(lat, lng);
                    
                    if (map && marker) {
                        marker.setLatLng([lat, lng]);
                        map.setView([lat, lng], 15);
                    } else {
                        defaultLat = lat;
                        defaultLng = lng;
                    }
                    
                    $btn.html(originalHtml).prop('disabled', false);
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({title: 'Success', text: 'Location updated successfully!', icon: 'success'});
                    } else {
                        alert('Location updated successfully!');
                    }
                }, function(error) {
                    $btn.html(originalHtml).prop('disabled', false);
                    let msg = 'Error getting location: ';
                    switch(error.code) {
                        case error.PERMISSION_DENIED: msg += "User denied Geolocation."; break;
                        case error.POSITION_UNAVAILABLE: msg += "Location information is unavailable."; break;
                        case error.TIMEOUT: msg += "The request to get user location timed out."; break;
                        case error.UNKNOWN_ERROR: msg += "An unknown error occurred."; break;
                    }
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({title: 'Error', text: msg, icon: 'error'});
                    } else {
                        alert(msg);
                    }
                }, {
                    enableHighAccuracy: true,
                    timeout: 10000,
                    maximumAge: 0
                });
            } else {
                if (typeof Swal !== 'undefined') {
                    Swal.fire({title: 'Error', text: 'Geolocation is not supported by this browser.', icon: 'error'});
                } else {
                    alert('Geolocation is not supported by this browser.');
                }
            }
        });

        $('#vendorMapModal').on('shown.bs.modal', function() {
            initMap();
            setTimeout(function(){ map.invalidateSize(); }, 200);
        });
    });
</script>

@endsection