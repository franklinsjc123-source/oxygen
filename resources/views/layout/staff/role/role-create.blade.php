@extends('layout.auth.master')
@section('contents')

    @include('paritials.auth.header')

<!-- page-wrapper Start-->
@include('paritials.auth.topmenu');
<!-- Page Header Ends -->

<!-- Page Body Start-->
<div class="page-body-wrapper">
	
	<!-- Page Sidebar Start-->
	@include('paritials.vendorauth.sidemenu');
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
                                <h3>Role Create
                                    <small>oxygen Admin panel</small>
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="index.php"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item active">Role Create</li>
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
                     	
    <div class="card-body">
                
                        <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                           
                            <div class="card-body">
							 <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal"><i class="fa fa-plus"></i> Add Role</button>
                                   
                                <div class="btn-popup pull-right">
								
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" data-backdrop="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog " role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title f-w-600" id="exampleModalLabel">Role</h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="" method="post" onsubmit="return confirm('Are you sure, you want to delete it?')" >
                                                        <div class="form">
                                                      

                                                            <div class="form-group">
                                                                <label for="role" class="mb-1 fw-bold"> Role </label>
                                                                <input class="form-control" id="role" type="text" name="role" required >
                                                            </div>
															
															<div class="form-group">
                                                                <label for="description" class="mb-1 fw-bold"> Description </label>
                                                                <input class="form-control" id="description" type="text" name="description" required >
                                                            </div>
															
														
															<div class="form-group">
                                                                <label for="description" class="mb-4 fw-bold"> Permission </label><br>
																<div class="d-inline">
                                                                <input class="form-group" id="" type="checkbox" name="permission[]" value="Dashboard" > Dashboard
																
																<input class="form-group" id="" type="checkbox" name="permission[]" value="Category" > Category
																
																<input class="form-group" id="" type="checkbox" name="permission[]" value="Products" > Products
																
																<input class="form-group" id="" type="checkbox" name="permission[]" value="Sales" > Sales
																
																<input class="form-group" id="" type="checkbox" name="permission[]" value="Coupons" > Coupons
																
																<input class="form-group" id="" type="checkbox" name="permission[]" value="Banners" > Banners
																</div>
																<div class="d-inline">
																<input class="form-group" id="" type="checkbox" name="permission[]" value="Auction" > Auction
																
																<input class="form-group" id="" type="checkbox" name="permission[]" value="Offer" > Offer
																
																<input class="form-group" id="" type="checkbox" name="permission[]" value="Marketing" > Marketing
																
																<input class="form-group" id="" type="checkbox" name="permission[]" value="Staff" > Staff
																
																<input class="form-group" id="" type="checkbox" name="permission[]" value="Role" > Role
																
																<input class="form-group" id="" type="checkbox" name="permission[]" value="Vendors" > Vendors
																</div>
																<div class="d-block">
																<input class="form-group" id="" type="checkbox" name="permission[]" value="Activity Tracker" > Activity Tracker
																
																<input class="form-group" id="" type="checkbox" name="permission[]" value="Master" > Master
																
																<input class="form-group" id="" type="checkbox" name="permission[]" value="Settings" > Settings
																
																</div>
                                                            </div>	
															
															<div class="form-group">
                                                        <label for="status" class="mb-1 fw-bold">Status</label>
                                                        <select class="custom-select w-100 form-control" name="status" required>
                                               
                                               
                                                <option value="Active">Active</option>
                                                <option value="Inactive">Inactive</option>
                                              
                                            </select>
                                                              
                                                            </div>
                                                        </div>
                                                   
                                                </div>
                                                <div class="modal-footer">
                                                   <button class="btn btn-primary" type="submit">Save</button>
                                                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                                                </div>
												
												 </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
								
								
								<div class="datatable-dashv1-list custom-datatable-overright">

                            
                                <table class="table fcolor" id="table"  data-click-to-select="true"  data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-show-columns="true" data-sort="true" data-pagination="true" data-search="true"  data-show-refresh="true" data-key-events="true"  data-resizable="true" data-cookie="true"
     data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">  
                                    <thead>
                                     <tr>
                                       <th data-field="id" data-sortable="true">Id</th> 
                                        
                                        <th data-field="title" data-sortable="true">Role</th>
                                       
                                       <th data-field="status" data-sortable="true">Status</th>
									   <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                   
                                   

                                    <tr>
                                        <td>001</td>
                                       
                                       
							<td>Admin</td>

						<td>
                         <label class="switch">
                          <input type="checkbox"  onclick="return confirm('Are you sure, you want to Change it?')" checked id="togBtn">
                            <div class="slider round"><!--ADDED HTML -->
                            <span class="off">Inactive </span>
                            <span class="on">Active</span><!--END--></div>
</label>

  </div>
                            
                            </td>
										
										   <td><span> <a href="#" class="badge badge-secondary px-2"  data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal"data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                            <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>
                                        
                                   
                                    </tr>
                                      <tr>
                                        <td>002</td>
                                       
                                       
                                       

									<td >	
                                         Manager
												</td>
						<td>
                         <label class="switch">
                          <input type="checkbox"  onclick="return confirm('Are you sure, you want to Change it?')" checked id="togBtn">
                            <div class="slider round"><!--ADDED HTML -->
                            <span class="off">Inactive </span>
                            <span class="on">Active</span><!--END--></div>
</label>

  </div>
                            
                            </td>
										
										   <td><span> <a href="#" class="badge badge-secondary px-2"  data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal"data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                            <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>
                                        
                                   
                                    </tr>
                                   
                                  
                                   
                                  
                                    </tbody>
                                </table> </div>
								
								
								
								
                                
                              
                            </div>
                        </div>
                    </div>
	




			</div>
			</div>
			
			

		</div>
		</div></div>
		
		</div>
		</div>
		

    @endsection