@extends('website.layouts.master')
{{-- <?php include('header.php')?> --}}

<!-- page-wrapper Start-->

@include('website.pages.topmenu')
    <!-- Page Header Ends -->

    <!-- Page Body Start-->
    <div class="page-body-wrapper">

        <!-- Page Sidebar Start-->
      
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
                                <a href="activity_tracker.php" class="btn  btn-primary"><i class="fa fa-plus"></i> Add Activity</a>


                            
<table class="table" id="table"  data-click-to-select="true"  data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-show-columns="true" data-sort="true" data-pagination="true" data-search="true"  data-show-refresh="true" data-key-events="true"  data-resizable="true" data-cookie="true"
     data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
    
                                    <thead>
                                    <tr>
                                  
                                    <th data-field="order" data-sortable="true">Order Status </th>
                                    <th data-field="nextfollow" data-sortable="true">Next Follow-Up Date </th>
                                    <th data-field="reason" data-sortable="true">Reason </th>
                                        <th data-field="store" data-sortable="true"> Store Details</th>
                                        <th data-field="contactdetail" data-sortable="true"> Contact Details</th>
                                       
                                        <th data-field="business" data-sortable="true">Business Info </th>
                                       <th data-field="address" data-sortable="true"> Address </th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                   
                                    <tr>
                                    <td>
                                        <span class="font-secondary">Pending </span>   
                                        </td>
                                        
                                        <td>
                                        <span>01-Jun-2022 </span>   
                                        </td>
                                        <td>
                                        <span>Two Weeks time</span>   
                                        </td>
                                        <td><span>Shop : </span> <span><b>SKAP Garments</b></span>
                                        <br><span>10001</span>
                                        <br><span>Z001</span> / <span>T.Nagar</span>
                                            
                                            
                                        </td>
                                        <td> <span>
                                            Owner </span><span>VIGNESH</span>
                                            <br><span>skapgarment@gmail.com</span><br>
                                            <span>+91987654311</span><br></td>
                                       
                                          
                                            
                                            <td> <span> Fashion, Footwear..</span>
                                            
                                       
                                        
                                      
                                        <td>Vadivel Nagar <br>
                                        2nd street <br>
                                    Trichy
</td>
                                       
                                       
                                       
                                        <td>
                                            
                                        <span>
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