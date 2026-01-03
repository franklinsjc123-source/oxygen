
@extends('website.layouts.master')
{{-- <?php include('header.php') ?> --}}

<!-- page-wrapper Start-->

@include('website.pages.topmenu')
<!-- Page Header Ends -->

<!-- Page Body Start-->
<div class="page-body-wrapper">

    <!-- Page Sidebar Start-->
    
    <?php include('sidemenu.php') ?>
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
                            <h3>Active Order's

                            </h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ol class="breadcrumb pull-right">
                            <li class="breadcrumb-item"><a href="dashboard.php"><i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item active">Order List</li>
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


                            <ul class="nav nav-tabs tab-coupon" id="myTab" role="tablist">
                                <li class="nav-item"><a class="nav-link active show" id="new-tabs" data-bs-toggle="tab" href="#new" role="tab" aria-controls="new" aria-selected="false" data-original-title="" title="">New </a></li>
                                <li class="nav-item"><a class="nav-link" id="general-tab" data-bs-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true" data-original-title="" title="">Accept </a></li>

                                <li class="nav-item"><a class="nav-link" id="general-tab" data-bs-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true" data-original-title="" title="">Dispatch </a></li>
                                <li class="nav-item"><a class="nav-link" id="delivery-tab" data-bs-toggle="tab" href="#delivery" role="tab" aria-controls="delivery" aria-selected="true" data-original-title="" title="">Delivered </a></li>
                                <li class="nav-item"><a class="nav-link" id="usage-tab" data-bs-toggle="tab" href="#usage" role="tab" aria-controls="usage" aria-selected="false" data-original-title="" title="">Return/Cancel </a></li>
                            </ul>

                            <div class="tab-content" id="myTabContent">

                                <div class="tab-pane fade active show" id="new" role="tabpanel" aria-labelledby="new-tabs">
                                    <form class="needs-validation" novalidate="">
                                        @csrf
                                        <div class="row">

                                            <div class="datatable-dashv1-list custom-datatable-overright">


                                                <table class="table" id="table" data-click-to-select="true" data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-show-columns="true" data-sort="true" data-pagination="true" data-search="true" data-show-refresh="true" data-key-events="true" data-resizable="true" data-cookie="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                                    <thead>
                                                        <tr>
                                                            <th data-field="image" data-sortable="false">Image</th>
                                                            <th data-field="productname" data-sortable="true"> Product name</th>
                                                            <th data-field="orderid" data-sortable="true">Order Id</th>
                                                            <th data-field="orderqty" data-sortable="true">QTY</th>
                                                            <th data-field="date" data-sortable="true">Order Date</th>
                                                            <th data-field="paymentmode" data-sortable="true">Payment Mode</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>



                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-primary">UPI</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>

                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-secondary">COD</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-primary">UPI</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-secondary">COD</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-secondary">COD</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-primary">UPI</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-warning">Bank Transfer</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-secondary">COD</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-secondary">COD</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-secondary">COD</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-secondary">COD</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-secondary">COD</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>

                                                        <tr>
                                                            <td>21/3/2022 <br>
                                                                7:50 am IST</td>


                                                            <td>00125
                                                                <br>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">
                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                                <br>
                                                                Pid: TG03-N7NS <br>
                                                                Quantity: 1
                                                            </td>
                                                            <td><span style="color: #fff;" class="badge badge-success px-2">Cancel</span></td>
                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>

                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </form>
                                </div>


                                <div class="tab-pane fade" id="general" role="tabpanel" aria-labelledby="general-tab">
                                    <form class="needs-validation" novalidate="">
                                        @csrf
                                        <div class="row">

                                            <div class="datatable-dashv1-list custom-datatable-overright">


                                            <table class="table" id="table" data-click-to-select="true" data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-show-columns="true" data-sort="true" data-pagination="true" data-search="true" data-show-refresh="true" data-key-events="true" data-resizable="true" data-cookie="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                                    <thead>
                                                        <tr>
                                                            <th data-field="image" data-sortable="false">Image</th>
                                                            <th data-field="productname" data-sortable="true"> Product name</th>
                                                            <th data-field="orderid" data-sortable="true">Order Id</th>
                                                            <th data-field="orderqty" data-sortable="true">QTY</th>
                                                            <th data-field="date" data-sortable="true">Order Date</th>
                                                            <th data-field="paymentmode" data-sortable="true">Payment Mode</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>



                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-primary">UPI</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>

                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-secondary">COD</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-primary">UPI</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-secondary">COD</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-secondary">COD</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-primary">UPI</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-warning">Bank Transfer</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-secondary">COD</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-secondary">COD</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-secondary">COD</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-secondary">COD</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-secondary">COD</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>

                                                        <tr>
                                                            <td>21/3/2022 <br>
                                                                7:50 am IST</td>


                                                            <td>00125
                                                                <br>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">
                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                                <br>
                                                                Pid: TG03-N7NS <br>
                                                                Quantity: 1
                                                            </td>
                                                            <td><span style="color: #fff;" class="badge badge-success px-2">Cancel</span></td>
                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>

                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade" id="restriction" role="tabpanel" aria-labelledby="restriction-tabs">
                                    <form class="needs-validation" novalidate="">
                                        @csrf
                                        <div class="row">
                                            <div class="row">
                                                <div class="datatable-dashv1-list custom-datatable-overright">


                                                <table class="table" id="table" data-click-to-select="true" data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-show-columns="true" data-sort="true" data-pagination="true" data-search="true" data-show-refresh="true" data-key-events="true" data-resizable="true" data-cookie="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                                    <thead>
                                                        <tr>
                                                            <th data-field="image" data-sortable="false">Image</th>
                                                            <th data-field="productname" data-sortable="true"> Product name</th>
                                                            <th data-field="orderid" data-sortable="true">Order Id</th>
                                                            <th data-field="orderqty" data-sortable="true">QTY</th>
                                                            <th data-field="date" data-sortable="true">Order Date</th>
                                                            <th data-field="paymentmode" data-sortable="true">Payment Mode</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>



                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-primary">UPI</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>

                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-secondary">COD</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-primary">UPI</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-secondary">COD</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-secondary">COD</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-primary">UPI</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-warning">Bank Transfer</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-secondary">COD</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-secondary">COD</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-secondary">COD</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-secondary">COD</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-secondary">COD</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>

                                                        <tr>
                                                            <td>21/3/2022 <br>
                                                                7:50 am IST</td>


                                                            <td>00125
                                                                <br>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">
                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                                <br>
                                                                Pid: TG03-N7NS <br>
                                                                Quantity: 1
                                                            </td>
                                                            <td><span style="color: #fff;" class="badge badge-success px-2">Cancel</span></td>
                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>

                                                        </tr>

                                                    </tbody>
                                                </table>
                                                </div>
                                            </div>

                                        </div>
                                    </form>
                                </div>

                                <div class="tab-pane fade" id="delivery" role="tabpanel" aria-labelledby="delivery-tabs">
                                    <form class="needs-validation" novalidate="">
                                        @csrf
                                        <div class="row">

                                            <div class="datatable-dashv1-list custom-datatable-overright">


                                            <table class="table" id="table" data-click-to-select="true" data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-show-columns="true" data-sort="true" data-pagination="true" data-search="true" data-show-refresh="true" data-key-events="true" data-resizable="true" data-cookie="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                                    <thead>
                                                        <tr>
                                                            <th data-field="image" data-sortable="false">Image</th>
                                                            <th data-field="productname" data-sortable="true"> Product name</th>
                                                            <th data-field="orderid" data-sortable="true">Order Id</th>
                                                            <th data-field="orderqty" data-sortable="true">QTY</th>
                                                            <th data-field="date" data-sortable="true">Order Date</th>
                                                            <th data-field="paymentmode" data-sortable="true">Payment Mode</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>



                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-primary">UPI</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>

                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-secondary">COD</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-primary">UPI</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-secondary">COD</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-secondary">COD</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-primary">UPI</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-warning">Bank Transfer</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-secondary">COD</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-secondary">COD</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-secondary">COD</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-secondary">COD</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-secondary">COD</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>

                                                        <tr>
                                                            <td>21/3/2022 <br>
                                                                7:50 am IST</td>


                                                            <td>00125
                                                                <br>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">
                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                                <br>
                                                                Pid: TG03-N7NS <br>
                                                                Quantity: 1
                                                            </td>
                                                            <td><span style="color: #fff;" class="badge badge-success px-2">Cancel</span></td>
                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>

                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>

                                        </div>
                                    </form>
                                </div>


                                <div class="tab-pane fade" id="usage" role="tabpanel" aria-labelledby="usage-tab">
                                    <form class="needs-validation" novalidate="">
                                        @csrf
                                        <div class="row">

                                            <div class="datatable-dashv1-list custom-datatable-overright">


                                            <table class="table" id="table" data-click-to-select="true" data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-show-columns="true" data-sort="true" data-pagination="true" data-search="true" data-show-refresh="true" data-key-events="true" data-resizable="true" data-cookie="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                                    <thead>
                                                        <tr>
                                                            <th data-field="image" data-sortable="false">Image</th>
                                                            <th data-field="productname" data-sortable="true"> Product name</th>
                                                            <th data-field="orderid" data-sortable="true">Order Id</th>
                                                            <th data-field="orderqty" data-sortable="true">QTY</th>
                                                            <th data-field="date" data-sortable="true">Order Date</th>
                                                            <th data-field="paymentmode" data-sortable="true">Payment Mode</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>



                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-primary">UPI</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>

                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-secondary">COD</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-primary">UPI</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-secondary">COD</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-secondary">COD</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-primary">UPI</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-warning">Bank Transfer</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-secondary">COD</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-secondary">COD</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-secondary">COD</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-secondary">COD</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>
                                                        <tr>
                                                            <td>

                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>



                                                            <td>00125
                                                            </td>
                                                            <td>10
                                                            </td>
                                                            <td>13-Jan-2022</td>
                                                            <td><span class="font-secondary">COD</span></td>

                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


                                                        </tr>

                                                        <tr>
                                                            <td>21/3/2022 <br>
                                                                7:50 am IST</td>


                                                            <td>00125
                                                                <br>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">
                                                                </div>
                                                            </td>
                                                            <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                                <br>
                                                                Pid: TG03-N7NS <br>
                                                                Quantity: 1
                                                            </td>
                                                            <td><span style="color: #fff;" class="badge badge-success px-2">Cancel</span></td>
                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>

                                                        </tr>

                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>


                                </div>
                                </form>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

</div>
@endsection

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

<!--new-->

<!-- jquery
		============================================ -->

<!-- bootstrap JS
		============================================ -->
<script src="../assets/js/bootstrap.min.js"></script>
<!-- wow JS
		============================================ -->

<!-- data table JS
		============================================ -->
<script src="../assets/js/data-table/bootstrap-table.js"></script>
<script src="../assets/js/data-table/tableExport.js"></script>
<script src="../assets/js/data-table/data-table-active.js"></script>
<script src="../assets/js/data-table/bootstrap-table-editable.js"></script>
<script src="../assets/js/data-table/bootstrap-editable.js"></script>
<script src="../assets/js/data-table/bootstrap-table-resizable.js"></script>
<script src="../assets/js/data-table/colResizable-1.5.source.js"></script>
<script src="../assets/js/data-table/bootstrap-table-export.js"></script>
<!--  editable JS
		============================================ -->

<!-- Chart JS
		============================================ -->
