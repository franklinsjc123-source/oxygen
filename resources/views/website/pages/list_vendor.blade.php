{{-- <?php include('header.php')?> --}}
@extends('website.layouts.master')

    <style>
    .display{
        table-layout:fixed;
        width:100%;
    }
    </style>
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
    @section('coontent')
        <div class="page-body">

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <h3>Vendor's Listings
                                  
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="dashboard.php"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item active">Vendors Listings</li>
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
                       
                                <div class="card-body order-datatable">
                               
<div class="datatable-dashv1-list custom-datatable-overright">

                            
<table class="table" id="table"  data-click-to-select="true"  data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-show-columns="true" data-sort="true" data-pagination="true" data-search="true"  data-show-refresh="true" data-key-events="true"  data-resizable="true" data-cookie="true"
     data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
    
                                    <thead>
                                    <tr>
                                        <th data-field="id" data-sortable="true"> Id</th>
                                        <th data-field="name" data-sortable="true"> Vendor Details</th>
                                        <th data-field="regno" data-sortable="true"> Registration No</th>
                                        <th data-field="package" data-sortable="true">Package </th>
                                        <th data-field="wallet" data-sortable="true">Wallet  </th>
                                        <th data-field="sales" data-sortable="true">Sales  </th>
                                        <th data-field="location" data-sortable="true">Location</th>
                                        <th data-field="address" data-sortable="true">Address </th>
                                        
                                      
										
                                       
                                        
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                   
                                    <tr>
                                        <td>#5868</td>
                                        <td><b>SKAP MULTISERVICE</b>
                                            <br><small>skap2k12@gmail.com</small>
                                            <small>+91987654311</small>
                                        </td>
                                        <td>12566588</td>
                                        <td><span>Silver</span>
                                            <small>Renewal: 12/05/2023</small>
                                        </td>
                                        <td>5500</td>
                                        <td>25000</td>
                                        <td>Z001 <br>
                                        Blue<br>
                                    600001<br>
                                    Chennai GPO </td>
                                      
                                        <td>Vadivel Nagar <br>
                                        2nd street <br>
                                    Trichy
</td>
                                       
                                       
                                       
                                        <td><span> <a href="#" class="badge badge-secondary px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                            <a href="#" onclick="return delete_maincategory()" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>
                                        
                                    </tr>

                                    <tr>
                                        <td>#5968</td>
                                        <td><b>Yogam Garments</b>
                                        <br><small>yogam@gmail.com</small>
                                            <small>+91987654311</small>
                                        </td>
                                        <td>6646878</td>
                                        <td><span>Gold</span>
                                            <small>Renewal: 12/05/2023</small>
                                        </td>
                                        <td>5500</td>
                                        <td>25000</td>
                                        <td>Z001 <br>
                                        Blue<br>
                                    600002<br>
                                    Chennai GPO </td>
                                      
                                        <td>New Nagar <br>
                                        2nd street <br>
                                    Chennai
</td>
                                       
                                       
                                       
                                        <td><span> <a href="#" class="badge badge-secondary px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                            <a href="#" onclick="return delete_maincategory()" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>
                                        
                                    </tr>
                                   


                                    
                                  

                                    
                                  
                                    </tbody>
                                </table>
                            </div>
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div></div>
            <!-- Container-fluid Ends-->

        </div>
@endsection
{{-- <?php include('newfooter.php')?> --}}