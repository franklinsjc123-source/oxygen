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
                                <h3>Order Transactions
                                   
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="dashboard.php"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item active">Transactions</li>
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
                                <form class="needs-validation" novalidate="">
                                    @csrf
                                    <div class="row">
                                  
                                      <div class="datatable-dashv1-list custom-datatable-overright">

                            
                                    <table class="table" id="table"  data-click-to-select="true"  data-sort-name="id" data-show-columns="true" data-sort-order="desc" data-mobile-responsive="true" data-toggle="table" data-sort="true" data-pagination="true" data-search="true"  data-show-refresh="true" data-key-events="true"  data-resizable="true" data-cookie="true"
                                         data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                        
                                    <thead>
                                    <tr>
                                       <th data-field="id" data-sortable="true">Order Id</th> 
                                        <th data-field="date" data-sortable="true">Order Date</th>
                                        <th data-field="sellertype" data-sortable="false">Seller Name</th>
                                        <th data-field="amount" data-sortable="false">Order Amount</th>
                                       
                                        <th data-field="payment" data-sortable="false">Payment Type</th>
                                        <th data-field="servicecharge" data-sortable="true">Service Charges</th>
                                        <th data-field="remainingamount" data-sortable="true">Remaining Amount</th>
                                        <th data-field="paymentstaus" data-sortable="true">Payment Status</th>
                                       
                                    </tr>
                                    </thead>
                                    <tbody>
                                   
                                   <tr>
                                       <td>106</td>
                                       <td>09/05/2022 <br> 7.30 Am </td>
                                       <td> <span>Vendor </span> <br> <span>SKAP MULTISERVICE </span> </td>
                                       <td>1000</td>
                                      
                                      
                                       <td>COD</td>
                                       <td>5%</td>
                                       <td>950</td>
                                       <td><span style="color: #fff;" class="badge badge-success px-2">Transferd</span></td>
										
                                    </tr>

                                    <tr>
                                       <td>101</td>
                                       <td>09/05/2022 <br> 7.30 Am </td>
                                       <td> <span>Admin </span>  </td>
                                       <td>1000</td>
                                      
                                       <td>COD</td>
                                       <td></td>
                                       <td>1000</td>
                                       <td><span style="color: #fff;" class="badge badge-success px-2">Pending</span></td>
										
                                    </tr>
                                    <tr>
                                       <td>057</td>
                                       <td>09/05/2022 <br> 7.30 Am </td>
                                       <td> <span>Vendor </span> <br> <span>SKAP MULTISERVICE </span> </td>
                                       <td>1000</td>
                                      
                                      
                                       <td>COD</td>
                                       <td>5%</td>
                                       <td>950</td>
                                       <td><span style="color: #fff;" class="badge badge-success px-2">Pending</span></td>
										
                                    </tr>

                                  
                                  
                                  
                                    </tbody>
                                </table> </div>
                              
                                    </div>
                                </form>
                            </div>
						 
						
								
								
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

        </div>
        @endsection

        {{-- <?php include('newfooter.php')?> --}}