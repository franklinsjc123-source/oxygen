{{-- <?php include('header.php')?> --}}
@extends('website.layouts.master')
<!-- page-wrapper Start-->

@include('website.pages.topmenu')
    <!-- Page Header Ends -->

    <!-- Page Body Start-->
    <div class="page-body-wrapper">

        <!-- Page Sidebar Start-->
        <?php include('sidemenu.php')?>
        @include('website.pages.sidemenu')
        <!-- Page Sidebar Ends-->

        <!-- Right sidebar Start-->
       
        <!-- Right sidebar Ends-->
@section('content')
        <div class="page-body">

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <h3>User's Listings
                                  
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="dashboard.php"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item active">User Listings</li>
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
                                <a href="employee.php" class="btn  btn-primary"><i class="fa fa-plus"></i> Add User</a>


                            
<table class="table" id="table"  data-click-to-select="true"  data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-show-columns="true" data-sort="true" data-pagination="true" data-search="true"  data-show-refresh="true" data-key-events="true"  data-resizable="true" data-cookie="true"
     data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
    
                                    <thead>
                                    <tr>
                                    <th data-field="image"> Photo</th>
                                        <th data-field="empdetails" data-sortable="true"> Employee Details</th>
                                        <th data-field="contactdetail" data-sortable="true"> User Details</th>
                                        <th data-field="curriculam" data-sortable="true">curriculam Details </th>
                                        <th data-field="personal" data-sortable="true">Personal Details </th>
                                        
                                        
                                     
                                        
                                        <th data-field="address" data-sortable="true">Current Address </th>
                                        
                                      
										
                                       
                                        
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                   
                                    <tr>
                                    <td>
                                            <div class="d-flex">
                                                <img src="../assets/img/profile/defult_icon.png" alt="" class="img-fluid img-60 me-2 blur-up lazyloaded">
                                                </div>
                                        </td>
                                        <td><span><b>Rameshrajan</b></span>
                                        <br><span>10001</span>
                                        <br><span>Marketing</span> / <span>Sales Executive</span>
                                            
                                            
                                        </td>
                                        <td> <span>username: rajanramesh</span>
                                            <br><span>rajan@gmail.com</span><br>
                                            <span>+91987654311</span><br></td>
                                       
                                            <td> <span> Education : MCA</span>
                                            <br><span>Experience : 8 Years</span><br>
                                            <span>DOJ : 13/05/2022 </span></td>
                                            
                                        <td><span>DOB: 13/05/2022</span><br>
                                        <span>
                                            Blood Group : B+
                                        </span>
                                     </td>
                                       
                                        
                                      
                                        <td>Vadivel Nagar <br>
                                        2nd street <br>
                                    Trichy
                                    </td>
                                       
                                       
                                       
                                        <td>
                                            
                                        <span>
                                        <a href="#" class="badge badge-success px-4 py-3" data-toggle="tooltip" data-placement="top" title="" data-original-title="Report"> Report </a>
                                        <a href="#" class="badge badge-secondary px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                            <a href="#" onclick="return delete_maincategory()" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>
                                        
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
{{-- <?php include('newfooter.php')?> --}}