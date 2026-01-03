{{-- <?php include('header.php')?> --}}
@extends('website.layouts.master')
<!-- page-wrapper Start-->

@include('website.pages.topmenu')
<!-- Page Header Ends -->

<!-- Page Body Start-->
<div class="page-body-wrapper">
	
	<!-- Page Sidebar Start-->
	
    <?php include('sidemenu.php')?>
    @section('content')
	<div class="page-body">
		
		<!-- Container-fluid starts-->
		<div class="container-fluid">
			<div class="page-header">
				<div class="row">
					<div class="col">
						<div class="page-header-left">
							<h3>Create Vendor
							
							</h3>
						</div>
					</div>
					<div class="col-lg-6">
						<ol class="breadcrumb pull-right">
							<li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
							<li class="breadcrumb-item">Vendors </li>
							<li class="breadcrumb-item active">Create Vendor </li>
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
					<div class="card tab2-card">
						
						<div class="card-body">
							<ul class="nav nav-tabs tab-coupon" id="myTab" role="tablist">
								<li class="nav-item"><a class="nav-link active show" id="account-tab" data-bs-toggle="tab" href="#account" role="tab" aria-controls="account" aria-selected="true" data-original-title="" title="">Account</a></li>
								<li class="nav-item"><a class="nav-link" id="permission-tabs" data-bs-toggle="tab" href="#permission" role="tab" aria-controls="permission" aria-selected="false" data-original-title="" title="">Permission</a></li>
							</ul>
							<div class="tab-content" id="myTabContent">
								<div class="tab-pane fade active show" id="account" role="tabpanel" aria-labelledby="account-tab">
									<form class="needs-validation user-add">
                                        @csrf
										<h4>Account</h4>
									
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-3 col-md-4"><span>*</span>Name</label>
											<div class="col-xl-8 col-md-7">
												<input class="form-control" id="validationCustom0" type="text" required="">
											</div>
										</div>
										<div class="form-group row">
											<label for="validationCustom1" class="col-xl-3 col-md-4"><span>*</span>Registration Number</label>
											<div class="col-xl-8 col-md-7">
												<input class="form-control" id="validationCustom1" type="text" required="">
											</div>
										</div>
										
										<div class="form-group row">
											<label for="validationCustom1" class="col-xl-3 col-md-4"><span>*</span>Mobile Number</label>
											<div class="col-xl-8 col-md-7">
												<input class="form-control" id="validationCustom1" type="text" required="">
											</div>
										</div>

										<div class="form-group row">
											<label for="validationCustom1" class="col-xl-3 col-md-4"><span>*</span>E.Mail</label>
											<div class="col-xl-8 col-md-7">
												<input class="form-control" id="validationCustom1" type="email" required="">
											</div>
										</div>

										

										<div class="form-group row">
											<label for="validationCustom1" class="col-xl-3 col-md-4"><span>*</span>Zone</label>
											<div class="col-xl-8 col-md-7">
											<select class="custom-select w-100 form-control" required="">
																<option value="">--Select Zone--</option>
																
																<option value="z01">Z01</option>
																<option value="Z02">Z02</option>
																
															</select>
											</div>
										</div>

										<div class="form-group row">
											<label for="validationCustom1" class="col-xl-3 col-md-4"><span>*</span>Route</label>
											<div class="col-xl-8 col-md-7">
											<select class="custom-select w-100 form-control" required="">
																<option value="">--Select Route-- </option>
																
																<option value="2">Blue</option>
																<option value="2">Green</option>
																<option value="2">Yellow</option>
															</select>
											</div>
										</div>
										<div class="form-group row">
															<label for="validationCustom02" class="col-xl-3 col-md-4">Pincode :</label>
															<div class="col-xl-8 col-md-7">
															<input class="form-control" required="" type="text">
                                                        </div>
														</div>

														<div class="form-group row">
															<label for="validationCustom02" class="col-xl-3 col-md-4"><span>*</span>Area :</label>
															<div class="col-xl-8 col-md-7">
															<input class="form-control"  type="text" required="">
                                                        </div>
														</div>
														<div class="form-group row">
															<label for="validationCustom02" class="col-xl-3 col-md-4">Postal Region :</label>
															<div class="col-xl-8 col-md-7">
															<input class="form-control"  type="text">
                                                            </div>
														</div>

														<div class="form-group row">
															<label for="validationCustom02" class="col-xl-3 col-md-4"><span>*</span> Address :</label>
															<div class="col-xl-8 col-md-7">
															<textarea class="form-control"   rows="2"></textarea>
                                                        </div>
														</div>

													
										<div class="form-group row">
											<label for="validationCustom02" class="col-xl-3 col-md-4"><span>*</span>Pan Card</label>
											<div class="col-xl-8 col-md-7">
											<input class="form-control" id="validationCustom02" required="" type="file">
											</div>
										</div>
										<div class="form-group row">
											<label for="validationCustom02" class="col-xl-3 col-md-4"><span>*</span>Adhaar card</label>
											<div class="col-xl-8 col-md-7">
											<input class="form-control" id="validationCustom02" required="" type="file">
											</div>
										</div>
										<div class="form-group row">
											<label for="validationCustom02" class="col-xl-3 col-md-4">Other document</label>
											<div class="col-xl-8 col-md-7">
											<input class="form-control" id="validationCustom02" type="file">
											</div>
										</div>
										<div class="form-group row">
											<label for="validationCustom3" class="col-xl-3 col-md-4"><span>*</span> Password</label>
											<div class="col-xl-8 col-md-7">
												<input class="form-control" id="validationCustom3" type="password" required="">
											</div>
										</div>
										<div class="form-group row">
											<label for="validationCustom4" class="col-xl-3 col-md-4"><span>*</span> Confirm Password</label>
											<div class="col-xl-8 col-md-7">
												<input class="form-control" id="validationCustom4" type="password" required="">
											</div>
										</div><br>
										<div class="form-group row">
										<h4>Package</h4>
											<div class="col-xl-4 col-md-4">
										
											<select class="custom-select w-100 form-control" required="">
																<option value="">--Select Package-- </option>
																
																<option value="1">Package 1</option>
																<option value="2">Package 2</option>
																<option value="3">Package 3</option>
															</select>
											</div>

											<div class="col-xl-4 col-md-4">
											<label for="validationCustom0" class=""><span>*</span>Validity</label>
											<input class="form-control" id="validationCustom0"  placeholder="365 Days" type="text" required="">
											</div>
											<div class="col-xl-4 col-md-4">
											<label for="validationCustom0" class=""><span>*</span>Start Date</label>
											<input class="form-control" id="validationCustom0"  placeholder="12/05/2022" type="text" required="">
											</div>
											<div class="col-xl-4 col-md-4">
											<label for="validationCustom0" class=""><span>*</span>End  Date</label>
											<input class="form-control" id="validationCustom0"  placeholder="12/05/2023" type="text" required="">
											</div>
											<div class="col-xl-4 col-md-4">
											<label for="validationCustom0" class=""><span>*</span>Grace Days</label>
											<input class="form-control" id="validationCustom0"  placeholder="20" type="text" required="">
											</div>
											<div class="col-xl-4 col-md-4">
											<label for="validationCustom0" class=""><span>*</span>Renewal  Date</label>
											<input class="form-control" id="validationCustom0"  placeholder="13/06/2023" type="text" required="">
											</div>
										</div>
										<div class="form-group row ">
											<div class="text-center">
										<div class="col-xl-8 col-md-8">
										<button class="btn btn-primary" type="submit">Save</button>
                                                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                                        </div></div></div>
									</form>
								</div>
								<div class="tab-pane fade" id="permission" role="tabpanel" aria-labelledby="permission-tabs">
									<form class="needs-validation user-add">
										<h4>Permission</h4>
										<div class="permission-block">
											<div class="attribute-blocks">
												<h5 class="f-w-600 mb-3">Product Related permition </h5>
												<div class="row">
													<div class="col-xl-3 col-sm-4">
														<label>Add Product</label>
													</div>
													<div class="col-xl-9 col-sm-8">
														<div class="form-group m-checkbox-inline mb-0 custom-radio-ml d-flex radio-animated">
															<label class="d-block" for="edo-ani1">
																<input class="radio_animated" id="edo-ani1" type="radio" name="rdo-ani">
																Allow
															</label>
															<label class="d-block" for="edo-ani2">
																<input class="radio_animated" id="edo-ani2" type="radio" name="rdo-ani" checked="">
																Deny
															</label>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-xl-3 col-sm-4">
														<label>Update Product</label>
													</div>
													<div class="col-xl-9 col-sm-8">
														<div class="form-group m-checkbox-inline mb-0 custom-radio-ml d-flex radio-animated">
															<label class="d-block" for="edo-ani3">
																<input class="radio_animated" id="edo-ani3" type="radio" name="rdo-ani1">
																Allow
															</label>
															<label class="d-block" for="edo-ani4">
																<input class="radio_animated" id="edo-ani4" type="radio" name="rdo-ani1" checked="">
																Deny
															</label>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-xl-3 col-sm-4">
														<label>Delete Product</label>
													</div>
													<div class="col-xl-9 col-sm-8">
														<div class="form-group m-checkbox-inline mb-0 custom-radio-ml d-flex radio-animated">
															<label class="d-block" for="edo-ani5">
																<input class="radio_animated" id="edo-ani5" type="radio" name="rdo-ani2">
																Allow
															</label>
															<label class="d-block" for="edo-ani6">
																<input class="radio_animated" id="edo-ani6" type="radio" name="rdo-ani2" checked="">
																Deny
															</label>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-xl-3 col-sm-4">
														<label class="mb-0 sm-label-radio">Apply Discount</label>
													</div>
													<div class="col-xl-9 col-sm-8">
														<div class="form-group m-checkbox-inline mb-0 custom-radio-ml d-flex radio-animated pb-0">
															<label class="d-block mb-0" for="edo-ani7">
																<input class="radio_animated" id="edo-ani7" type="radio" name="rdo-ani3">
																Allow
															</label>
															<label class="d-block mb-0" for="edo-ani8">
																<input class="radio_animated" id="edo-ani8" type="radio" name="rdo-ani3" checked="">
																Deny
															</label>
														</div>
													</div>
												</div>
											</div>
											<div class="attribute-blocks">
												<h5 class="f-w-600 mb-3">Category Related permition </h5>
												<div class="row">
													<div class="col-xl-3 col-sm-4">
														<label>Add Category</label>
													</div>
													<div class="col-xl-9 col-sm-8">
														<div class="form-group m-checkbox-inline mb-0 custom-radio-ml d-flex radio-animated">
															<label class="d-block" for="edo-ani9">
																<input class="radio_animated" id="edo-ani9" type="radio" name="rdo-ani4">
																Allow
															</label>
															<label class="d-block" for="edo-ani10">
																<input class="radio_animated" id="edo-ani10" type="radio" name="rdo-ani4" checked="">
																Deny
															</label>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-xl-3 col-sm-4">
														<label>Update Category</label>
													</div>
													<div class="col-xl-9 col-sm-8">
														<div class="form-group m-checkbox-inline mb-0 custom-radio-ml d-flex radio-animated">
															<label class="d-block" for="edo-ani11">
																<input class="radio_animated" id="edo-ani11" type="radio" name="rdo-ani5">
																Allow
															</label>
															<label class="d-block" for="edo-ani12">
																<input class="radio_animated" id="edo-ani12" type="radio" name="rdo-ani5" checked="">
																Deny
															</label>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-xl-3 col-sm-4">
														<label>Delete Category</label>
													</div>
													<div class="col-xl-9 col-sm-8">
														<div class="form-group m-checkbox-inline mb-0 custom-radio-ml d-flex radio-animated">
															<label class="d-block" for="edo-ani13">
																<input class="radio_animated" id="edo-ani13" type="radio" name="rdo-ani6">
																Allow
															</label>
															<label class="d-block" for="edo-ani14">
																<input class="radio_animated" id="edo-ani14" type="radio" name="rdo-ani6" checked="">
																Deny
															</label>
														</div>
													</div>
												</div>
												<div class="row">
													<div class="col-xl-3 col-sm-4">
														<label class="mb-0 sm-label-radio">Apply discount</label>
													</div>
													<div class="col-xl-9 col-sm-8">
														<div class="form-group m-checkbox-inline custom-radio-ml d-flex radio-animated pb-0">
															<label class="d-block mb-0" for="edo-ani15">
																<input class="radio_animated" id="edo-ani15" type="radio" name="rdo-ani7">
																Allow
															</label>
															<label class="d-block mb-0" for="edo-ani16">
																<input class="radio_animated" id="edo-ani16" type="radio" name="rdo-ani7" checked="">
																Deny
															</label>
														</div>
													</div>
												</div>
											</div>
										</div>
										<div class="pull-right">
								<button type="button" class="btn btn-primary">Save</button>
							</div>
									</form>
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

<!-- latest jquery-->
<script src="../assets/js/jquery-3.3.1.min.js"></script>

<!-- Bootstrap js-->
<script src="../assets/js/bootstrap.bundle.min.js"></script>

<!-- feather icon js-->
<script src="../assets/js/icons/feather-icon/feather.min.js"></script>
<script src="../assets/js/icons/feather-icon/feather-icon.js"></script>

<!-- Sidebar jquery-->
<script src="../assets/js/sidebar-menu.js"></script>

<!--Customizer admin-->
<script src="../assets/js/admin-customizer.js"></script>

<!-- lazyload js-->
<script src="../assets/js/lazysizes.min.js"></script>

<!--right sidebar js-->
<script src="../assets/js/chat-menu.js"></script>

<script src="../assets/js/admin-script.js"></script>
@endsection