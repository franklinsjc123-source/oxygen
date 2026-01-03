@extends('layout.auth.master')
@section('contents')

    @include('paritials.auth.header')

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
            <div class="container-fluid" >
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <h3>Role Assign
                                    <small>oxygen Admin panel</small>
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="index.php"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item active">Role Assign</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->
          
            <!-- Container-fluid starts-->
            <div class="container-fluid ">
           
                <div class="row">
                        
                    <div class="col-sm-12">
                        
                        <div class="card">
                     	<div class="card-body fcolor">
						<form action="#" >
					<div class="row ">

											<div class="col-md-4">
											<label class="fw-bold">Staf Id</label>
												<input class="form-control" id="stfid" name="stfid" type="text" required="" >
											</div>
											
											<div class="col-md-4">
											<label class="fw-bold">User Name</label>
												<input class="form-control" id="uname" name="uname" type="text" required="" >
											
											</div>
										
										<div class="col-md-4">
											<button class="btn btn-primary" style="margin-top:7%">Search</button>
											</div>
										
										</div>
								</form>	
<div class="row mt-5 ">		
<form action="#">						
					<div class="col-md-3">
					<label class="fw-bold">Name</label> <br>
								<input class="form-group" id="" type="checkbox" name="stfid" value="stf098738" > oxygen
									
						</div>		
					<div class="col-md-3">
					<label class="fw-bold">Role</label> <br>
								<select class="w-100 form-control text-secondary" name="role" required="">
																<option value="">--Select--</option>
																
																<option value="">Super Admin</option>
																<option value="">Admin</option>
																<option value="">Hr</option>
																<option value="">Sales Man</option>
																
															</select>									
									</div>	
									
						<div class="col-md-2">
								<button class="btn btn-primary " style="margin-top:14%">Assign</button>
						</div>
	</form>		
				</div>
								</div><!--card-body -->

                               
                            </div>
                              
                            </div>
                      </div>
					  </div>
            <!-- Container-fluid Ends-->

			</div>
			</div>
			
			



    @endsection