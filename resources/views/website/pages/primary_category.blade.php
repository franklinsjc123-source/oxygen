{{-- <?php include('header.php')?> --}}
@extends('website.layouts.master')
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
                                <h3>Primary Category
                                    <small>oxygen Admin panel</small>
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item active">Primary Category</li>
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
                                <div class="btn-popup pull-right">
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal">Add Primary Category</button>
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title f-w-600" id="exampleModalLabel">Add Product Primary Category</h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="needs-validation">
                                                        @csrf
                                                        <div class="form">
                                                            <div class="form-group">
                                                                <label for="validationCustom01" class="mb-1">Primary Category Name :</label>
                                                                <input class="form-control" id="validationCustom01" type="text">
                                                            </div>
                                                            <div class="form-group mb-0">
                                                                <label for="validationCustom02" class="mb-1">Primary Category Image :</label>
                                                                <input class="form-control" id="validationCustom02" type="file">
                                                            </div>
															<div class="form-group">
															<label class="col-xl-3 col-md-4">Status</label>
															<div class="col-md-7">
																<div class="checkbox checkbox-primary">
																	<input id="checkbox-primary-2" type="checkbox" data-original-title="" title="">
																	<label for="checkbox-primary-2">Active</label>
																	<input id="checkbox-primary-2" type="checkbox" data-original-title="" title="">
																	<label for="checkbox-primary-2">Deactive</label>
																</div>
																
															</div>
														</div>
                                                        </div>
                                                    </form>
                                                </div>
                                                <div class="modal-footer">
                                                <a href="category.php" onclick="return confirm('Are you sure, you want to Save it?')">      <button class="btn btn-primary" type="button">Save</button></a>
                                                    <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-body order-datatable">
                                <table class="display" id="basic-1" >
                                    <thead>
                                    <tr>
                                        <th> Id</th>
                                        <th>Primary Category Image</th>
                                        <th>Primary Category Name</th>
                                       
                                        <th> Status</th>
                                       <th>Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr>
                                        <td>#002</td>
                                        <td>
                                            <div class="d-flex">
                                                  <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">
                                                </div>
                                        </td>
                                        <td>Clothes</td>
                                        <td><span style="color: #fff;" class="badge badge-success px-2">Active</span></td>
                                       <td><span> <a href="#" class="badge badge-secondary px-2"  data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal"data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                            <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>
                                    </tr>
                                    <tr>
                                        <td>#003</td>
                                        <td>
                                            <div class="d-flex">
                                                  <img src="../assets/images/products/shortop.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">
                                                </div>
                                        </td>
                                        <td>Shoes</td>
                                        <td><span style="color: #fff;" class="badge badge-success px-2">Active</span></td>
                                        <td><span> <a href="#" class="badge badge-secondary px-2"  data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal"data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                            <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>
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
    @endsection
       {{-- <?php include('newfooter.php')?> --}}