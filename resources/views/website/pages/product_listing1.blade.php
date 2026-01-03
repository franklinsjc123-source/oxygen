{{-- <?php include('header.php')?> --}}
@extends('website.layouts.master')
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
                                <h3>Product Listings
                                    <small>oxygen Admin panel</small>
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="index.php"><i data-feather="home"></i></a></li>
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
                       
                                <div class="card-body order-datatable">
                                <div class="mb-3 pull-right"> <a href="add-product.php"><button type="button" class="btn btn-primary">+ Add Product</button></a>
</div>   
                                <table class="display" id="basic-1" >
                                    <thead>
                                    <tr>
                                        <th> Id</th>
                                        <th>Product image</th>
                                        <th>Product Name</th>
                                        <th>Category Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th> Status</th>
                                        <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                   
                                    <tr>
                                        <td>#001</td>
                                        <td>
                                            <div class="d-flex">
                                                <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">
                                                </div>
                                        </td>
                                        <td>Blouse Top</td>
                                        <td>Fashion</td>
                                        <td>1500</td>
                                        <td>5</td>
                                        <td><span style="color: #fff;" class="badge badge-success px-2">Published</span></td>
                                        <td><span> <a href="#" class="badge badge-secondary px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                            <a href="#" onclick="return delete_maincategory()" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>
                                        
                                    </tr>

                                    <tr>
                                        <td>#002</td>
                                        <td>
                                            <div class="d-flex">
                                                <img src="../assets/images/products/shortop.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">
                                                </div>
                                        </td>
                                        <td>Shirt Top</td>
                                        <td>Fashion</td>
                                        <td>1500</td>
                                        <td>5</td>
                                        <td><span style="color: #fff;" class="badge badge-danger px-2">Pending</span></td>
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
            </div>
            <!-- Container-fluid Ends-->

        </div>

        <script src="../assets/js/jquery-3.3.1.min.js"></script>

        <!-- Bootstrap js-->
        <script src="../assets/js/bootstrap.bundle.min.js"></script>

        <!-- feather icon js-->
        <script src="../assets/js/icons/feather-icon/feather.min.js"></script>
        <script src="../assets/js/icons/feather-icon/feather-icon.js"></script>

        <!-- Sidebar jquery-->
        <script src="../assets/js/sidebar-menu.js"></script>

        <!-- Datatable js-->
        <script src="../assets/js/datatables/jquery.dataTables.min.js"></script>
        <script src="../assets/js/datatables/custom-basic.js"></script>

        <!--Customizer admin-->
        <script src="../assets/js/admin-customizer.js"></script>

        <!-- lazyload js-->
        <script src="../assets/js/lazysizes.min.js"></script>

        <!--right sidebar js-->
        <script src="../assets/js/chat-menu.js"></script>

        <!--script admin-->
        <script src="../assets/js/admin-script.js"></script>


        <script>
        $(document).ready(function() {
            var table = $('#example').DataTable( {
                scrollY:        "300px",
                scrollX:        true,
                scrollCollapse: true,
                paging:         false,
                columnDefs: [
                    { width: '20%', targets: 0 }
                ],
                fixedColumns: true
            }); 
        });
        </script>

@endsection