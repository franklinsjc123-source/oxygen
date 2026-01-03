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
        
        <?php include('sidemenu.php')?>
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
                                <h3>Product Listings
                                  
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="dashboard.php"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item active">Product Listings</li>
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
                              <div class="mb-3 pull-right"> <a href="add-product.php"><button type="button" class="btn btn-primary"><i class="fa fa-plus"></i>  Add Product</button></a>
                               </div>   
                                <div class="card-body order-datatable">
                         

  
<div class="datatable-dashv1-list custom-datatable-overright">

                            
<table class="table" id="table"  data-click-to-select="true"  data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-show-columns="true" data-sort="true" data-pagination="true" data-search="true"  data-show-refresh="true" data-key-events="true"  data-resizable="true" data-cookie="true"
     data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
    
                                    <thead>
                                    <tr>
                                        <th data-field="id" data-sortable="true"> Id</th>
                                        <th data-field="status" data-sortable="true"> Status</th>
                                        <th data-field="image" data-sortable="true"> images</th>
                                        <th data-field="title" data-sortable="true">Title </th>
                                        <th data-field="maincategory" data-sortable="true">Main Category </th>
                                        <th data-field="category" data-sortable="true">Category </th>
                                        
                                        <th data-field="price" data-sortable="true">Product Price</th>
										 <th data-field="attributes" data-sortable="true">Attributes </th>
                                        <th data-field="qty" data-sortable="true">Qty</th>
                                        
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                   
                                    <tr>
                                        <td>#001</td>
                                        <td><span style="color: #fff;" class="badge badge-success px-2">Published</span></td>
                                        <td>
                                            <div class="d-flex">
                                                <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-40 me-2 blur-up lazyloaded">
                                                </div>
                                        </td>
                                        <td>Embroidery Long Kurtis </td>
                                        <td>Clothing & Accessories</td>
                                        <td>Women</td>
                                      
                                        
                                        <td><span>MRP : Rs.1500</span> <br>
                                        <span>Price : Rs. 1200</span> <br>
                                        <span>Offer  : Rs. 1100</span></td>
										  <td>Size : XL, S <br>
										  Color : Red
										  </td>
                                        <td>5</td>
                                       
                                        <td><span> <a href="#" class="badge badge-secondary px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                            <a href="#" onclick="return delete_maincategory()" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>
                                        
                                    </tr>

                                    <tr>
                                        <td>#005</td>
                                          <td><span style="color: #fff;" class="badge badge-success px-2">Published</span></td>
                                        <td>
                                            <div class="d-flex">
                                                <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-40 me-2 blur-up lazyloaded">
                                                </div>
                                                
                                        </td>
                                        <td>Short Top </td>
                                        <td>Clothing & Accessories</td>
                                        <td>Women</td>
                                      
                                        
                                        <td><span>MRP : Rs.1500</span> <br>
                                        <span>Price : Rs. 1200</span> <br>
                                        <span>Offer  : Rs. 1100</span></td>
										  <td>Size : XL, S <br>
										  Color : Red
										  </td>
                                        <td>5</td>
                                      
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