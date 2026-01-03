{{-- <?php include('header.php');?> --}}
@extends('website.layouts.master')
<!-- Page Body Start-->

@include('website.pages.topmenu')

<div class="page-body-wrapper">
	
	
	@include('website.pages.sidemenu')
	@section('content')
	<div class="page-body">
		
		<!-- Container-fluid starts-->
		<div class="container-fluid">
			<div class="page-header">
				<div class="row">
					<div class="col-lg-6">
						<div class="page-header-left">
							<h3>Create User
								
							</h3>
						</div>
					</div>
					<div class="col-lg-6">
						<ol class="breadcrumb pull-right">
							<li class="breadcrumb-item"><a href="dashboard.php"><i data-feather="home"></i></a></li>
							<li class="breadcrumb-item">Users </li>
							<li class="breadcrumb-item active">Create User </li>
						</ol>
					</div>
				</div>
			</div>
		</div>
		<!-- Container-fluid Ends-->
		
		<!-- Container-fluid starts-->
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-10">
					<div class="card">
						
						<div class="card-body">
						
							<div class="tab-content" id="myTabContent">
								<div class="tab-pane fade active show" id="account" role="tabpanel" aria-labelledby="account-tab">
									<form class="needs-validation user-add" novalidate="">
										@csrf
									 	<h4>Account Details</h4>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group row">
													<label for="validationCustom0" class="col-xl-4 col-md-4">  Employee Id</label>
													<div class="col-xl-8 col-md-8">
														<input class="form-control" id="validationCustom0" type="text" required="" name="firstname">
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group row">
													<label for="validationCustom0" class="col-xl-4 col-md-4"> User Name</label>
													<div class="col-xl-8 col-md-8">
														<input class="form-control" id="validationCustom0" type="text" required="" name="firstname">
													</div>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<div class="form-group row">
													<label for="validationCustom0" class="col-xl-4 col-md-4"> Fullname</label>
													<div class="col-xl-8 col-md-8">
														<input class="form-control" id="validationCustom0" type="text" required="" name="firstname">
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group row">
													<label for="validationCustom2" class="col-xl-4 col-md-4">Date Of Birth</label>
													<div class="col-xl-8 col-md-7">
														<input class="form-control" id="validationCustom2" type="date" required="" name="dob">
													</div>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<div class="form-group row">
												<label for="validationCustom01" class="col-xl-4 col-md-4">Department :</label>
													<div class="col-xl-8 col-md-8">
																<select class="custom-select w-100 form-control" required="">
																	<option value="">--Select--</option>
																	<option value="2">Manager</option>
																	<option value="2">Sales Executive</option>
																</select>
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group row">
													<label for="validationCustom01" class="col-xl-4 col-md-4">Desgination:</label>
														<div class="col-xl-8 col-md-8">
															<select class="custom-select w-100 form-control" required="">
																			<option value="">--Select--</option>
																			<option value="2">Manager</option>
																			<option value="2">Sales Executive</option>
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
														<input class="form-control" id="validationCustom0" type="text" required="" name="firstname">
													</div>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group row">
														<label for="validationCustom0" class="col-xl-4 col-md-4">Alternate</label>
														<div class="col-xl-8 col-md-8">
															<input class="form-control" id="validationCustom0" type="text" required="" name="firstname">
													</div>
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-md-6">
												<div class="form-group row">
												<label for="validationCustom0" class="col-xl-4 col-md-4"> Qualification</label>
													<div class="col-xl-8 col-md-8">
														<input class="form-control" id="validationCustom0" type="text" required="" name="qualification">
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group row">
													<label for="validationCustom0" class="col-xl-4 col-md-4">Experience</label>
													<div class="col-xl-8 col-md-8">
														<input class="form-control" id="validationCustom0" type="text" required="" name="experience">
													</div>
												</div>
											</div>
										</div>

										<div class="row">
											<div class="col-md-6">
												<div class="form-group row">
												<label for="validationCustom0" class="col-xl-4 col-md-4"> Blood Group</label>
												<div class="col-xl-8 col-md-8">
													<input class="form-control" id="validationCustom0" type="text" required="" name="firstname">
												</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group row">
												<label for="validationCustom2" class="col-xl-4 col-md-4">Date of Joining</label>
													<div class="col-xl-8 col-md-7">
														<input class="form-control" id="validationCustom2" type="date" required="" name="dob">
													</div>
												</div>
											</div>
										</div>
											
											<div class="form-group row">
												<label for="validationCustom1" class="col-xl-2 col-md-2">Permanent Address</label>
												<div class="col-xl-10 col-md-10">
													<textarea class="form-control" rows="3" id="validationCustom1" type="text" required="" name="address"></textarea>
												</div>
											</div>
											<div class="form-group row">
												<label for="validationCustom1" class="col-xl-2 col-md-2">Current Address</label>
												<div class="col-xl-10 col-md-10">
													<textarea class="form-control" rows="3" id="validationCustom1" type="text" required="" name="address"></textarea>
												</div>
											</div>

											<div class="row">
											<div class="col-md-6">
												
												<div class="form-group row">
													<label for="validationCustom3" class="col-xl-4 col-md-4"><span>*</span> Password</label>
													<div class="col-xl-8 col-md-8">
														<input class="form-control" id="validationCustom3" type="password" required=""name="password">
													</div>
												</div>
											</div>
											<div class="col-md-6">
												<div class="form-group row">
													<label for="validationCustom4" class="col-xl-4 col-md-4"><span>*</span> Confirm Password</label>
													<div class="col-xl-8 col-md-8">
														<input class="form-control" id="validationCustom4" type="password" required="" name="confirm_password">
													</div>
												</div>
											</div>
											</div>
											<div class="pull-right">
												<button type="submit" class="btn btn-primary">Save</button>
											</div>
											</div>
										
										</div>
								
									</form>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Container-fluid Ends-->
		
	</div>
	
	
	
</div>

</div>

@endsection
{{-- <?php include('newfooter.php')?> --}}