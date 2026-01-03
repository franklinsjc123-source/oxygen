@extends('layout.auth.master')
@section('contents')
@include('paritials.css.activity.activity-css')?>
@include('paritials.js.activity.activity-add-js')?>
    @include('paritials.auth.header')?>

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
                            <h3>Activity Tracker
								
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                            <li class="breadcrumb-item"><a href="dashboard.php"><i data-feather="home"></i></a></li>
							
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
                                   
                                      <form class="needs-validation user-add">
									
										<div class="row mt-4">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">  Shop Name</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="validationCustom0" type="text" required="" name="shopname">
											</div>
										</div>
</div>
<div class="col-md-6">
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4"> Owner Name</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="validationCustom0" type="text" required="" name="ownername">
											</div>
										</div>
</div>
</div>

<div class="row">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4"> Business Category</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="validationCustom0" type="text" required="" name="businesscategory">
											</div>
										</div>
</div>
<div class="col-md-6">
<div class="form-group row">
											<label for="validationCustom2" class="col-xl-4 col-md-4">E-Mail</label>
											<div class="col-xl-8 col-md-7">
												<input class="form-control" id="validationCustom2" type="email" required="" name="email">
											</div>
										</div>
</div>
</div>

										
											
									

									


<div class="row">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">  Mobile Number</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="validationCustom0" type="text" required="" name="moble">
											</div>
										</div>
</div>
<div class="col-md-6">
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">Alternate Number</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="validationCustom0" type="text" required="" name="alternatemobile">
											</div>
										</div>
</div>
</div>
<div class="row">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4"> Address Line 1</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="validationCustom0" type="text" required="" name="address1">
											</div>
										</div>
</div>
<div class="col-md-6">
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">Address Line 2</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="validationCustom0" type="text" required="" name="address2">
											</div>
										</div>
</div>
</div>
<div class="row">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom01" class="col-xl-4 col-md-4">State :</label>
											<div class="col-xl-8 col-md-8">


											<select class="custom-select w-100 form-control" name="state" required="">
																<option value="">--Select--</option>
																
																<option value="2">TamilNadu</option>
																<option value="2">Kerala</option>
																
																
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
																
																<option value="2">Chennai</option>
																<option value="2">Trichy</option>
																
																
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
												<input class="form-control" id="validationCustom0" type="text" required="" name="pincode">
											</div>
										</div>
</div>
<div class="col-md-6">
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">Location Map</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="validationCustom0" type="text" required="" name="locationmap">
											</div>
										</div>
</div>
</div>

<div class="row">
										<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4"> Zone</label>
											<div class="col-xl-8 col-md-8">
												<input class="form-control" id="validationCustom0" readonly type="text" required="" name="zone">
											</div>
										</div>
</div>
<div class="col-md-6">
<div class="form-group row">
											<label for="validationCustom2" class="col-xl-4 col-md-4">Area</label>
											<div class="col-xl-8 col-md-7">
												<input class="form-control" id="validationCustom2" readonly type="text" required="" name="route">
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
																
																<option value="Appoinment Fixed">Appoinment Fixed</option>
																<option value="Package Explained">Package Explained</option>
																<option value="Negotiating">Negotiating</option>
																<option value="Pending Decision">Pending Decision</option>
																<option value="Not Interested">Not Interested</option>
																<option value="Interested">Interested</option>
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
																
																<option value="10%-25%">10%-25%</option>
																<option value="25%-50%">25%-50%</option>
																<option value="50%-75%">50%-75%</option>
																<option value="75%-100%">75%-100%</option>
																
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
																
																<option value="Self">Self</option>
																<option value="Referral">Referral</option>
																<option value="Tele-Calling">Tele-Calling</option>
																<option value="Advertisement">Advertisement</option>
															
															</select>
											</div>
										</div>
</div>


<div class="col-md-6">
<div class="form-group row">
											<label for="validationCustom2" class="col-xl-4 col-md-4">Next Follow-up Date</label>
											<div class="col-xl-8 col-md-7">
												<input class="form-control" id="example"  type="date" required="" name="follow-up-date">
											</div>
										</div>
</div>
<div class="col-md-6">
											
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-4 col-md-4">Status</label>
											<div class="col-xl-8 col-md-8">
												<select class="custom-select w-100 form-control" name="reference" required="">
																<option value="">--Select--</option>
																
																<option value="Accepted">Accepted</option>
																<option value="Pending">Pending</option>
																<option value="Dispatched">Dispatched</option>
																<option value="Delivered">Delivered</option>
																<option value="Return">Return</option>
																<option value="Cancel">Cancel</option>
															
															</select>
											</div>
										</div>
</div>
</div>
										
									
										<div class="form-group row">
											<label for="validationCustom1" class="col-xl-2 col-md-2">Reason</label>
											<div class="col-xl-10 col-md-10">
												<textarea class="form-control" rows="3" id="validationCustom1" type="text" required="" name="address"></textarea>
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

@endsection