@extends('layout.auth.master')
@section('contents')

    @include('paritials.auth.header')?>

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
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <h3>Activity Listings
                                  
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="dashboard.php"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item active">Activity Listings</li>
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
                        
                        <div class="card">
                       
                                <div class="card-body">
                                <a href="{{url('activity/create')}}" class="btn  btn-primary"><i class="fa fa-plus"></i> Add Activity</a>


                            
<table class="table" id="table"  data-click-to-select="true"  data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-show-columns="true" data-sort="true" data-pagination="true" data-search="true"  data-show-refresh="true" data-key-events="true"  data-resizable="true" data-cookie="true"
     data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
    
                                    <thead>
                                    <tr>
                                    <th data-field="rmdetails" data-sortable="true">RM DETAILS</th>
                                    <th data-field="storedetails" data-sortable="true">STORE DETAILS</th>
                                   
                                    <th data-field="branch" data-sortable="true"> BRANCH</th>
                                   
                                   <th data-field="Pipeline" data-sortable="true">PIPELINE</th>
								   
								   <th data-field="reference" data-sortable="true">REFERENCE</th>
								   
								   <th data-field="cdate" data-sortable="true">CREATE DATE</th>
                                    
                                       
                                    <th data-field="fdate" data-sortable="true"> FOLLOW-UP DATE </th>
                                      
									 <th data-field="reason" data-sortable="true">Reason </th>
                                     <th data-field="status" data-sortable="true">STATUS</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
									<tr>
                                        <td>Rameshrajan
										<br>emp.id:001</td>
                                    <td>
                                        <span>SKAP Garments<br>V.id:1020</span>   
                                        </td>
                                    
                                    <td>
                                        <span>T.Nagar</span> / <span>Z001</span>
                                            
                                        </td>
										
                                        <td>
                                        <span>50%-75%</span>   
                                        </td>
										
                                        <td>
                                        <span class="font-secondary">Referral </span>   
                                        </td>
										
                                         <td>
                                          Jun 12,2022
                                        </td>
										
                                        <td>
										Jul 12,2022
										</td>
										<td>
										Specific if any
										</td>
											<td>
										<span class="badge border border-primary text-primary">Dispatch</span>
										</td>
										<td>
										<span>
                                        <a href="#" class="badge badge-secondary px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                            <a href="#" onclick="return delete_maincategory()" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span>
										</td>
                                    </tr>
                                   <tr>
                                        <td>Rameshrajan
										<br>emp.id:001</td>
                                    <td>
                                        <span>SKAP Garments<br>V.id:1020</span>   
                                        </td>
                                    
                                    <td>
                                        <span>T.Nagar</span> / <span>Z001</span>
                                            
                                        </td>
										
                                        <td>
                                        <span>50%-75%</span>   
                                        </td>
										
                                        <td>
                                        <span class="font-secondary">Referral </span>   
                                        </td>
										
                                         <td>
                                          Jun 12,2022
                                        </td>
										
                                        <td>
										Jul 12,2022
										</td>
										<td>
										Specific if any
										</td>
											<td>
										<span class="badge border border-success text-success">Delivered</span>
										</td>
										<td>
										<span>
                                        <a href="#" class="badge badge-secondary px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                            <a href="#" onclick="return delete_maincategory()" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span>
										</td>
                                    </tr>
                                    

                             
                                  

                                    
                                  
                                    </tbody>
                                </table>
                           
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div></div>
            <!-- Container-fluid Ends-->

        </div>

@endsection