@extends('layout.auth.master')
@section('contents')

@include('paritials.js.staff.staff-create-js')
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
                            <li class="breadcrumb-item"><a href="dashboard.php"><i data-feather="home"></i></a></li>
							
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
                   
                    <div class="col-xl-10">
                        <div class="card tab2-card">
                            <div class="card-body">
                                <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" id="top-profile-tab" data-bs-toggle="tab" href="#top-profile" role="tab" aria-controls="top-profile" aria-selected="true"><i data-feather="user" class="me-2"></i>Personal Information</a>
                                    </li>
                                  
									<li class="nav-item"><a class="nav-link" id="upload-top-tab" data-bs-toggle="tab" href="#top-upload" role="tab" aria-controls="top-upload" aria-selected="false"><i data-feather="settings" class="me-2"></i>Documents & Other Information</a>
                                    </li>
                                </ul>
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
											
									<form method="post" action="{{ url('admin/staff/store') }}" class="needs-validation user-add" novalidate="" enctype="multipart/form-data">
										@csrf
										<div class="row mt-4">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">  Employee ID</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="empid" type="text" required="true" name="empid">
												
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
											<label for="validationCustom0" class="col-xl-4 col-md-4"> User Name</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="username" type="text" required="true" name="username">
											</div>
										</div>
									</div>
									</div>

									<div class="row">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4"> Full Name</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="fullname" type="text" required="true" name="fullname">
											</div>
										</div>
									</div>
									<div class="col-md-6">
									<div class="form-group row">
											<label for="validationCustom2" class="col-xl-4 col-md-4">Date Of Birth</label>
											<div class="col-xl-8 col-md-7">
												<input class="form-control" id="dob" type="date" required="true" name="dob"
												placeholder="dd/mm/yy">
											</div>
										</div>
									</div>
									</div>

										
											
									

										<div class="row">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom01" class="col-xl-4 col-md-4">Department :</label>
											<div class="col-xl-8 col-md-8">


											<select class="custom-select w-100 form-control" id="department" name="department" required="true">
																<option value="">--Select--</option>
																@foreach ($department as $item)
																<option value="{{$item->id}}">{{$item->name}}</option>
																@endforeach
																{{-- <option value="1">Manager</option>
																<option value="2">Sales Executive</option>
																 --}}
																
															</select>
											
											</div>
										</div>
										</div>
										<div class="col-md-6">
										<div class="form-group row">
											<label for="validationCustom01" class="col-xl-4 col-md-4">Desgination:</label>
											<div class="col-xl-8 col-md-8">
												<select class="custom-select w-100 form-control" id="designation" name="designation" required="true">
																<option value="">--Select--</option>
																
																{{-- <option value="1">Manager</option>
																<option value="2">Sales Executive</option> --}}
																
																
															</select>
											</div>
										</div>
										</div>
										</div>

										<div class="row">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">  Mobile Number</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="mobileno"  type="text" required="true" name="mobileno">
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">Alternate Number</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="a_mobileno" type="text" required="true" name="a_mobileno">
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">E-Mail</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="email" type="email" required="true" name="email">
											</div>
										</div>
									</div>
									</div>
									<div class="row">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4"> Qualification</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="qualification" type="text" required="true" name="qualification">
											</div>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">Experience</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="experience" type="text" required="true" name="experience">
											</div>
										</div>
									</div>
									</div>

									<div class="row">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4"> Blood Group</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="bloodgroup" type="text" required="true" name="bloodgroup">
											</div>
										</div>
										</div>
										<div class="col-md-6">
										<div class="form-group row">
											<label for="validationCustom2" class="col-xl-4 col-md-4">Date of Joining</label>
											<div class="col-xl-8 col-md-7">
												<input class="form-control" id="doj" type="date" required="true" name="doj"
												placeholder="dd/mm/yy">
											</div>
										</div>
										</div>
										</div>
										
									
										<div class="form-group row">
											<label for="validationCustom1" class="col-xl-2 col-md-2">Permanent Address</label>
											<div class="col-xl-10 col-md-10">
												<textarea class="form-control" rows="3" id="permanant_addr" type="text" required="true" name="permanant_addr"></textarea>
											</div>
										</div>
										<div class="form-group row">
											<label for="validationCustom1" class="col-xl-2 col-md-2">Current Address</label>
											<div class="col-xl-10 col-md-10">
												<textarea class="form-control" rows="3" id="curr_addr" type="text" required="true" name="curr_addr"></textarea>
											</div>
										</div>

										<div class="row">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom3" class="col-xl-4 col-md-4"><span>*</span> Password</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="password" type="password" required="true"name="password">
											</div>
										</div>
										</div>
										<div class="col-md-6">
										<div class="form-group row">
											<label for="validationCustom4" class="col-xl-4 col-md-4"><span>*</span> Confirm Password</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="confirm_password" type="password" required="true" name="confirm_password">
											</div>
											<span style=" color:red">
												@error('confirm_password')
												{{$message}}
												@enderror
											</span>
										</div>
										</div>
										</div>
											<div class="modal-footer"> 
												<ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
													{{-- <li class="nav-item"><a class="nav-link active" id="top-profile-tab" data-bs-toggle="tab" href="#top-profile" role="tab" aria-controls="top-profile" aria-selected="true"><i data-feather="user" class="me-2"></i>Personal Information</a>
													</li> --}}
												  
													<li class="nav-item"><a class="nav-link" id="upload-top-tab" data-bs-toggle="tab" href="#top-upload" role="tab" aria-controls="top-upload" aria-selected="false"><i data-feather="settings" class="me-2"></i>Next</a>
													</li>
												</ul></div>
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
                                                <label for="validationCustom1" class="col-xl-2 col-md-2"><span>*</span>Aadhar Card</label>
                                                <div class="col-xl-10 col-md-10">
                                                    <input class="form-control" id="aatherimage" type="file"  name="aatherimage" multiple />
													<div id="image-holder"></div>
                                                </div>
                                            </div>
											<div class="form-group row">
                                                <label for="validationCustom1" class="col-xl-2 col-md-2"><span>*</span>Pan Card</label>
                                                <div class="col-xl-10 col-md-10">
                                                    <input class="form-control" id="pancard" type="file"  name="pancard" multiple />
													<div id="image-holder1"></div>
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
													<label for="validationCustom0" class="col-xl-4 col-md-4">Monthly Salary</label>
													<div class="col-xl-8 col-md-8">
														<input class="form-control" id="monthlysalary" type="text" required="" name="monthlysalary">
													</div>
												</div>
												</div>
												<div class="col-md-6">
												<div class="form-group row">
													<label for="validationCustom0" class="col-xl-4 col-md-4">CTC</label>
													<div class="col-xl-8 col-md-8">
														<input class="form-control" id="ctc" type="text" required="" name="ctc">
													</div>
												</div>
												</div>
												</div>
												<div class="row">
												<div class="col-md-6">
													
												<div class="form-group row">
													<label for="validationCustom0" class="col-xl-4 col-md-4">Daily Target</label>
													<div class="col-xl-8 col-md-8">
														<input class="form-control" id="dailytarget" type="text" required="" name="dailytarget">
													</div>
												</div>
												</div>
												<div class="col-md-6">
												<div class="form-group row">
													<label for="validationCustom0" class="col-xl-4 col-md-4">Monthly Target</label>
													<div class="col-xl-8 col-md-8">
														<input class="form-control" id="monthlytarget" type="text" required="" name="monthlytarget">
													</div>
												</div>
												</div>
												</div>
												<div class="row">
												<div class="col-md-6">
													
												<div class="form-group row">
													<label for="validationCustom01" class="col-xl-4 col-md-4">Zone:</label>
													<div class="col-xl-8 col-md-8">


													<select class="custom-select w-100 form-control" name ="zone_id" required="">
																		<option value="">--Select--</option>
																		
																		@foreach($zone as $zo){
																			<option value="{{$zo->id}}">{{$zo->name}}</option>
																		}
																		@endforeach 
																		
																	</select>
													
													</div>
												</div>
												</div>
												<div class="col-md-6">
												<div class="form-group row">
													<label for="validationCustom01" class="col-xl-4 col-md-4">Route:</label>
													<div class="col-xl-8 col-md-8">
														<select class="custom-select w-100 form-control" name ="route_id" required="">
																		<option value="">--Select--</option>
																		
																	
																		@foreach($rdata as $d){
																			<option value="{{$d->id}}">{{$d->name}}</option>
																		}
																		@endforeach  
																	</select>
													</div>
												</div>
												</div>
												</div>

						
												<div class="modal-footer">   
												<button class="btn  px-5 btn-lg btn-primary"  type="submit">Save</button>
												{{-- <button class="btn btn-lg btn-secondary px-5" type="button">Close</button>		 --}}
												<a href="{{ route('staff-list') }}" class="btn btn-lg btn-secondary px-5 " type="button">
													Close
												</a>
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


</script>
@endpush