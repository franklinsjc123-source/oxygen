@extends('layout.auth.master')
@section('contents')

@include('paritials.js.staff.staff-create-js')

<style>
    .invalid-feedback-custom {
        display: none;
        color: #dc3545;
        font-size: 1.05rem;
        margin-top: 0.25rem;
    }
    form.validation-attempted :invalid ~ .invalid-feedback-custom,
    form.validation-attempted .invalid-field ~ .invalid-feedback-custom {
        display: block !important;
    }
    form.validation-attempted :invalid {
        border-color: #ced4da !important;
        box-shadow: none !important;
    }
</style>

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
    
         <div class="page-body fcolor">

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                            <h3>Staff Creation 
								
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}"><i data-feather="home"></i></a></li>
							
							<li class="breadcrumb-item active">User Creation </li>
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
                            <div class="card-body" style="font-family: 'Century Gothic',lucida grande, helvetica, verdana, arial, sans-serif;">
                                <ul class="nav nav-tabs nav-material pb-5" id="top-tab" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" id="top-profile-tab" href="#top-profile" role="tab" aria-controls="top-profile" aria-selected="true"><i data-feather="user" class="me-2"></i><span class="fw-bold">Personal Information</span></a>
                                    </li>
                                  
									<li class="nav-item"><a class="nav-link" id="upload-top-tab" href="#top-upload" role="tab" aria-controls="top-upload" aria-selected="false"><i data-feather="settings" class="me-2"></i><span class="fw-bold">Documents & Other Information</span></a>
                                    </li>
                                </ul>
                                <form method="post" action="{{ url('admin/staff/store') }}" class="needs-validation user-add" novalidate="" enctype="multipart/form-data">
                                    @csrf
                                <div class="tab-content" id="top-tabContent">
                                    <div class="tab-pane fade show active" id="top-profile" role="tabpanel" aria-labelledby="top-profile-tab">
                                      
                                        <div class="tab-pane fade active show" id="account" role="tabpanel" aria-labelledby="account-tab">
											{{-- @if($errors)
											@foreach ( $errors->all() as $errors)
											<li style=" color:red">
												{{$errors}}
											</li>
												
											@endforeach
											@endif --}}
											
										<div class="row mt-4">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">Employee ID <span class="text-danger">*</span></label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="empid" type="text" required name="empid" value="{{ $next_emp_id }}" readonly>
												<div class="invalid-feedback-custom">Please enter employee ID</div>
											</div>
											<span style=" color:red">
												@error('empid')
												{{$message}}
												@enderror
											</span>
										</div>
										</div>
										<div class="col-md-6">
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">User Name <span class="text-danger">*</span></label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="username" type="text" required name="username">
												<span id="username_alert" class="mt-1 d-block" style="font-weight: bold;"></span>
												<div class="invalid-feedback-custom">Please enter user name</div>
											</div>
										</div>
									</div>
									</div>

									<div class="row">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">Full Name <span class="text-danger">*</span></label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="fullname" type="text" required name="fullname">
												<div class="invalid-feedback-custom">Please enter full name</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
									<div class="form-group row">
											<label for="validationCustom2" class="col-xl-4 col-md-4">Date Of Birth <span class="text-danger">*</span></label>
											<div class="col-xl-8 col-md-7">
												<input class="form-control" id="dob" type="date" required name="dob"
												placeholder="dd/mm/yy">
												<div class="invalid-feedback-custom">Please select date of birth</div>
											</div>
										</div>
									</div>
									</div>

										
											
									

										<div class="row">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom01" class="col-xl-4 col-md-4">Department <span class="text-danger">*</span></label>
											<div class="col-xl-8 col-md-8">


											<select class="custom-select w-100 form-control" id="department" name="department" required>
																<option value="">--Select--</option>
																@foreach ($department as $item)
																<option value="{{$item->id}}">{{$item->name}}</option>
																@endforeach
																{{-- <option value="1">Manager</option>
																<option value="2">Sales Executive</option>
																 --}}
																
															</select>
											<div class="invalid-feedback-custom">Please select department</div>
											</div>
										</div>
										</div>
										<div class="col-md-6">
										<div class="form-group row">
											<label for="validationCustom01" class="col-xl-4 col-md-4">Designation <span class="text-danger">*</span></label>
											<div class="col-xl-8 col-md-8">
												<select class="custom-select w-100 form-control" id="designation" name="designation" required>
																<option value="">--Select--</option>
																
																{{-- <option value="1">Manager</option>
																<option value="2">Sales Executive</option> --}}
																
																
															</select>
												<div class="invalid-feedback-custom">Please select designation</div>
											</div>
										</div>
										</div>
										</div>

										<div class="row">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">Mobile Number <span class="text-danger">*</span></label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="mobileno"  type="text" required name="mobileno" maxlength="10" pattern="[0-9]{10}">
												<div class="invalid-feedback-custom">Please enter a valid 10-digit mobile number</div>
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">Alternate Number</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="a_mobileno" type="text" name="a_mobileno" maxlength="10" pattern="[0-9]{10}">
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">E-Mail <span class="text-danger">*</span></label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="email" type="email" required name="email">
												<div class="invalid-feedback-custom">Please enter e-mail</div>
											</div>
										</div>
									</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">Qualification</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="qualification" type="text" name="qualification">
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">Experience</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="experience" type="text" name="experience">
											</div>
										</div>
									</div>
									</div>

									<div class="row">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">Blood Group</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="bloodgroup" type="text" name="bloodgroup">
											</div>
										</div>
										</div>
										<div class="col-md-6">
										<div class="form-group row">
											<label for="validationCustom2" class="col-xl-4 col-md-4">Date of Joining <span class="text-danger">*</span></label>
											<div class="col-xl-8 col-md-7">
												<input class="form-control" id="doj" type="date" required name="doj"
												placeholder="dd/mm/yy">
												<div class="invalid-feedback-custom">Please select date of joining</div>
											</div>
										</div>
										</div>
										</div>
										
									
										<div class="form-group row">
											<label for="validationCustom1" class="col-xl-2 col-md-2">Permanent Address <span class="text-danger">*</span></label>
											<div class="col-xl-10 col-md-10">
												<textarea class="form-control" rows="3" id="permanant_addr" type="text" required name="permanant_addr"></textarea>
												<div class="invalid-feedback-custom">Please enter permanent address</div>
											</div>
										</div>
										<div class="form-group row">
											<label for="validationCustom1" class="col-xl-2 col-md-2">Current Address <span class="text-danger">*</span></label>
											<div class="col-xl-10 col-md-10">
												<textarea class="form-control" rows="3" id="curr_addr" type="text" required name="curr_addr"></textarea>
												<div class="invalid-feedback-custom">Please enter current address</div>
											</div>
										</div>

										<div class="row">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom3" class="col-xl-4 col-md-4">Password <span class="text-danger">*</span></label>
											<div class="col-xl-8 col-md-8">
												<div class="position-relative">
													<input class="form-control" id="password" type="password" required name="password" style="padding-right: 40px;">
													<i class="fa-regular fa-eye position-absolute" id="togglePassword" style="right: 15px; top: 19px; transform: translateY(-50%); cursor: pointer; z-index: 10;"></i>
													<div class="invalid-feedback-custom">Please enter password</div>
												</div>
											</div>
										</div>
										</div>
										<div class="col-md-6">
										<div class="form-group row">
											<label for="validationCustom4" class="col-xl-4 col-md-4">Confirm Password <span class="text-danger">*</span></label>
											<div class="col-xl-8 col-md-8">
												<div class="position-relative">
													<input class="form-control" id="confirm_password" type="password" required name="confirm_password" style="padding-right: 40px;">
													<i class="fa-regular fa-eye position-absolute" id="toggleConfirmPassword" style="right: 15px; top: 19px; transform: translateY(-50%); cursor: pointer; z-index: 10;"></i>
													<div class="invalid-feedback-custom" id="confirm_password_feedback">Please enter confirm password</div>
												</div>
											</div>
											<span style=" color:red" id="wrong_pass_alert">
												@error('confirm_password')
												{{$message}}
												@enderror
											</span>
										</div>
										</div>
										</div>

										{{-- <div class="modal-footer"> 
											  <button id="upload-top-tab" data-bs-toggle="tab" class="btn btn-lg btn-secondary px-5" type="button">Close</button>
                                                   <button class="btn  px-5 btn-lg btn-primary" type="submit">Save</button>
                                                  
                                                </div>
                                    </form> --}}
									</div>
                                    
                                    </div>
									
                                    
									<div class="tab-pane fade" id="top-upload" role="tabpanel" aria-labelledby="top-upload-tab">
									
                                        <h5 class="f-w-600">Upload</h5>
										

                                        {{-- <form method="post" action="{{ url('admin/staff/update') }}" class="needs-validation user-add" novalidate="" enctype="multipart/form-data">
                                            @csrf --}}
											{{-- <h5 class="f-w-600"> Enter Employee ID</h5>
											<input class="form-control" id="emp_id"  name ="emp_id" type="text"  name="profileimage" multiple /></br> --}}
											
										 <div class="form-group row">
                                                <label for="validationCustom1" class="col-xl-2 col-md-2">Profile Image</label>
                                                <div class="col-xl-10 col-md-10">
                                                    <input class="form-control" id="profileimage" type="file"  name="profileimage" multiple />
													<div id="image-holder1"></div>
                                                </div>
                                            </div>
											<div class="form-group row">
                                                <label for="validationCustom1" class="col-xl-2 col-md-2">Aadhar Card <span class="text-danger">*</span></label>
                                                <div class="col-xl-10 col-md-10">
                                                    <input class="form-control" id="aatherimage" type="file"  name="aatherimage" multiple required />
													<div id="image-holder"></div>
													<div class="invalid-feedback-custom">Please upload Aadhar card</div>
                                                </div>
                                            </div>
											<div class="form-group row">
                                                <label for="validationCustom1" class="col-xl-2 col-md-2">Pan Card <span class="text-danger">*</span></label>
                                                <div class="col-xl-10 col-md-10">
                                                    <input class="form-control" id="pancard" type="file"  name="pancard" multiple required />
													<div id="image-holder1"></div>
													<div class="invalid-feedback-custom">Please upload Pan card</div>
                                                </div>
                                            </div>
											
                                           
                                            <div class="form-group row">
                                                <label for="validationCustom1" class="col-xl-2 col-md-2">Other Documents</label>
                                                <div class="col-xl-10 col-md-10">
                                                    <input class="form-control" id="otherdoc" type="file"  name="otherdoc" multiple />
													<div id="image-holder1"></div>
                                                </div>
                                            </div>
                                        {{-- </form> --}}


                                            <h5 class="f-w-600">Other Information</h5>
                                        {{-- <form class="needs-validation user-add" novalidate=""> --}}


												<div class="row">
												<div class="col-md-6">
													
												<div class="form-group row">
													<label for="validationCustom0" class="col-xl-4 col-md-4">Monthly Salary <span class="text-danger">*</span></label>
													<div class="col-xl-8 col-md-8">
														<input class="form-control" id="monthlysalary" type="text" pattern="[0-9]+" required name="monthlysalary">
														<div class="invalid-feedback-custom">Please enter monthly salary</div>
													</div>
												</div>
												</div>
												<div class="col-md-6">
												<div class="form-group row">
													<label for="validationCustom0" class="col-xl-4 col-md-4">CTC <span class="text-danger">*</span></label>
													<div class="col-xl-8 col-md-8">
														<input class="form-control" id="ctc" type="text" pattern="[0-9]+" required name="ctc">
														<div class="invalid-feedback-custom">Please enter CTC</div>
													</div>
												</div>
												</div>
												</div>
												<div class="row">
												<div class="col-md-6">
													
												<div class="form-group row">
													<label for="validationCustom0" class="col-xl-4 col-md-4">Daily Target <span class="text-danger">*</span></label>
													<div class="col-xl-8 col-md-8">
														<input class="form-control" id="dailytarget" type="text" pattern="[0-9]+" required name="dailytarget">
														<div class="invalid-feedback-custom">Please enter daily target</div>
													</div>
												</div>
												</div>
												<div class="col-md-6">
												<div class="form-group row">
													<label for="validationCustom0" class="col-xl-4 col-md-4">Monthly Target <span class="text-danger">*</span></label>
													<div class="col-xl-8 col-md-8">
														<input class="form-control" id="monthlytarget" type="text" pattern="[0-9]+" required name="monthlytarget">
														<div class="invalid-feedback-custom">Please enter monthly target</div>
													</div>
												</div>
												</div>
												</div>
												<div class="row">
												<div class="col-md-6">
													
												<div class="form-group row">
													<label for="validationCustom01" class="col-xl-4 col-md-4">Zone <span class="text-danger">*</span></label>
													<div class="col-xl-8 col-md-8">


													<select class="custom-select w-100 form-control" id="zone_id" name="zone_id" required>
																		<option value="">--Select--</option>
																		
																		@foreach($zone as $zo){
																			<option value="{{$zo->id}}">{{$zo->name}}</option>
																		}
																		@endforeach 
																		
																	</select>
													<div class="invalid-feedback-custom">Please select zone</div>
													</div>
												</div>
												</div>
												<div class="col-md-6">
												<div class="form-group row">
													<label for="validationCustom01" class="col-xl-4 col-md-4">Route <span class="text-danger">*</span></label>
													<div class="col-xl-8 col-md-8">
														<select class="custom-select w-100 form-control" id="route_id" name="route_id" required>
																		<option value="">--Select--</option>
																	</select>
														<div class="invalid-feedback-custom">Please select route</div>
													</div>
												</div>
												</div>
												</div>

						
                                    </div>
                                </div>
								<div class="justify-content-end gap-2 mt-4 d-flex" id="staff-wizard-controls">
									<button type="button" class="btn btn-secondary px-4"
														id="wizard-prev-btn">Previous</button>
									<button type="button" class="btn btn-primary px-4"
														id="wizard-next-btn">Next</button>
								</div>
								<div class="justify-content-end align-items-center gap-2 mt-4 staff-final-actions d-none" id="final-wizard-controls">
									<button type="button" class="btn btn-secondary px-4"
														id="wizard-prev-last-btn">Previous</button>
									<button class="btn btn-primary px-4" type="submit">Save</button>
									<a href="{{ route('staff-list') }}" class="btn btn-secondary px-4" type="button">Close</a>
								</div>
                                </form>
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

@endsection
@push('scripts')

{{-- <script>

function Validate() {
        var password = document.getElementById("Password").value;
		alert(password);
        var confirmPassword = document.getElementById("confirm_password").value;
        if (password != confirmPassword) {
            alert("Passwords do not match.");
            return false;
        }
        return true;
    }
	</script> --}}

<script>
function save() {
	alert('vendor has been added successfully');
	window.location.href='{{route("vendor-list")}}'
}



function getAjaxValue(url, method, callback) {
                $.ajax({
                    url: url,
                    type: method,
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: callback
                });
            }


            // Main Categoy Id
            $('#department').on('change', function() {
                let department = $(this).val();
                let url = '{{ route('getstaffdepartment') }}?department=' + department;
                let method = 'GET';
                getAjaxValue(url, method, function(data) {
                    $('#designation').empty();
					//alert(data);
                    $.each(data, function(key, category) {

                        $('#designation').append(
                            `<option value="${category.id}" selected>${category.designation}</option>`
                        );
                    });
                });
            });

            // Zonal Route dependent dropdown
            $('#zone_id').on('change', function() {
                let zone_id = $(this).val();
                if (!zone_id) {
                    $('#route_id').html('<option value="">--Select--</option>');
                    return;
                }
                let url = '{{ route('getroute') }}?zone_id=' + zone_id;
                let method = 'GET';
                getAjaxValue(url, method, function(data) {
                    $('#route_id').empty();
                    $('#route_id').append('<option value="">--Select--</option>');
                    $.each(data, function(key, route) {
                        $('#route_id').append(
                            `<option value="${route.id}">${route.name}</option>`
                        );
                    });
                });
            });

        $(function() {
            var isUsernameValid = true;
            const $tabLinks = $('#top-tab .nav-link');
            const $tabPanes = $('#top-tabContent > .tab-pane');
            const tabCount = $tabLinks.length;

            function getActiveIndex() {
                const idx = $tabLinks.index($('#top-tab .nav-link.active'));
                return idx >= 0 ? idx : 0;
            }

            function checkPasswordMatch() {
                const pass = $('#password').val() || '';
                const confirmPass = $('#confirm_password').val() || '';
                const confirmInput = document.getElementById('confirm_password');
                const feedback = $('#confirm_password_feedback');

                if (confirmInput) {
                    if (confirmPass === '') {
                        confirmInput.setCustomValidity("Please enter confirm password");
                        feedback.text("Please enter confirm password");
                    } else if (pass !== confirmPass) {
                        confirmInput.setCustomValidity("Passwords do not match");
                        feedback.text("Passwords do not match");
                    } else {
                        confirmInput.setCustomValidity("");
                        feedback.text("");
                    }
                }
            }

            $('#password, #confirm_password').on('input change', function() {
                checkPasswordMatch();
            });

            $('#username').on('keyup change blur input', function() {
                var username = $(this).val().trim();
                var $alert = $('#username_alert');

                if (username.length === 0) {
                    $alert.text('');
                    isUsernameValid = false;
                    return;
                }

                $.ajax({
                    url: "{{ route('checkUsername') }}",
                    type: "POST",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "username": username
                    },
                    dataType: "json",
                    success: function(response) {
                        if (response.exists) {
                            $alert.css('color', 'red').html('☒ Username already exists');
                            isUsernameValid = false;
                        } else {
                            $alert.css('color', 'green').html('☑ Username available');
                            isUsernameValid = true;
                        }
                    }
                });
            });

            function isCurrentTabValid() {
                const currentTab = $('#top-tabContent .tab-pane.active');

                // If in step 1, validate password match first
                if (currentTab.attr('id') === 'top-profile') {
                    checkPasswordMatch();
                    if (!isUsernameValid) {
                        $('#username').focus();
                        $('#username_alert').css('color', 'red').html('☒ Username already exists');
                        return false;
                    }
                }

                const inputs = currentTab.find('input[required], select[required], textarea[required], [required]');
                let valid = true;

                // Add validation-attempted to show validation errors
                $('form.needs-validation').addClass('validation-attempted');

                inputs.each(function() {
                    if (!this.checkValidity()) {
                        valid = false;
                        this.reportValidity();
                        // Focus the first invalid element
                        $(this).focus();
                        return false;
                    }
                });

                return valid;
            }

            function showTab(index) {
                if (index < 0 || index >= tabCount) return;
                $tabLinks.removeClass('active').attr('aria-selected', 'false');
                $($tabLinks.get(index)).addClass('active').attr('aria-selected', 'true');
                $tabPanes.removeClass('show active');
                const targetSelector = $($tabLinks.get(index)).attr('href');
                $(targetSelector).addClass('show active');
                
                // Show/hide wizard buttons
                syncWizardButtons();
                window.scrollTo(0, 0);
            }

            function syncWizardButtons() {
                const currentIdx = getActiveIndex();
                if (currentIdx === 0) {
                    $('#wizard-prev-btn').hide();
                    $('#wizard-next-btn').show();
                    $('#wizard-prev-last-btn').hide();
                    $('#wizard-submit-btn').hide();
                } else if (currentIdx === tabCount - 1) {
                    $('#wizard-prev-btn').hide();
                    $('#wizard-next-btn').hide();
                    $('#wizard-prev-last-btn').show();
                    $('#wizard-submit-btn').show();
                } else {
                    $('#wizard-prev-btn').show();
                    $('#wizard-next-btn').show();
                    $('#wizard-prev-last-btn').hide();
                    $('#wizard-submit-btn').hide();
                }
            }

            $('#wizard-next-btn').on('click', function() {
                if (isCurrentTabValid()) {
                    showTab(getActiveIndex() + 1);
                }
            });

            $('#wizard-prev-btn').on('click', function() {
                showTab(getActiveIndex() - 1);
            });

            $('#wizard-prev-last-btn').on('click', function() {
                showTab(getActiveIndex() - 1);
            });

            $tabLinks.on('click', function(e) {
                e.preventDefault();
                const targetIdx = $tabLinks.index(this);
                const currentIdx = getActiveIndex();

                if (targetIdx > currentIdx) {
                    // Only allow moving to the next tab if it's the immediate next one AND current tab is valid
                    if (targetIdx !== currentIdx + 1 || !isCurrentTabValid()) {
                        return;
                    }
                }
                showTab(targetIdx);
            });

            $('form.needs-validation').on('submit', function(e) {
                $(this).addClass('validation-attempted');
                if (!isUsernameValid) {
                    e.preventDefault();
                    e.stopPropagation();
                    $('#username').focus();
                    $('#username_alert').css('color', 'red').html('☒ Username already exists');
                    return;
                }
                if (!this.checkValidity()) {
                    e.preventDefault();
                    e.stopPropagation();
                }
            });

            $('#togglePassword').on('click', function() {
                const type = $('#password').attr('type') === 'password' ? 'text' : 'password';
                $('#password').attr('type', type);
                $(this).toggleClass('fa-eye fa-eye-slash');
            });

            $('#toggleConfirmPassword').on('click', function() {
                const type = $('#confirm_password').attr('type') === 'password' ? 'text' : 'password';
                $('#confirm_password').attr('type', type);
                $(this).toggleClass('fa-eye fa-eye-slash');
            });

            $('#mobileno, #a_mobileno').on('input', function() {
                this.value = this.value.replace(/\D/g, '').slice(0, 10);
            });

            $('#monthlysalary, #ctc, #dailytarget, #monthlytarget').on('input', function() {
                this.value = this.value.replace(/\D/g, '');
            });

            showTab(getActiveIndex());
            syncWizardButtons();
        });

</script>
@endpush