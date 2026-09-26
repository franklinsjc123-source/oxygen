@extends('layout.auth.master')
@section('contents')
    @include('paritials.vendorauth.header')?>

    <!-- page-wrapper Start-->
    @include('paritials.vendorauth.topmenu');
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
                        <div class="col-12">
                        <ol class="breadcrumb" style="float: left !important; margin-bottom: 0; padding-left: 0;">
                            <li class="breadcrumb-item"><a href="dashboard.php"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item active">Product Collection</li>
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
                                <div id="toolbar" class="d-flex align-items-center">
                                    <button type="button" class="btn btn-success btn-export-excel me-2" style="background-color: #28a745; border-color: #28a745; color: #fff;"><i class="fa fa-file-excel-o me-1"></i> Export Excel</button>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-original-title="test" data-bs-target="#exampleModal"><i class="fa fa-plus"></i> Add
                                        Product Collection</button>
                                </div>

                                <div class="btn-popup pull-right">
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                        data-backdrop="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title f-w-600" id="exampleModalLabel">Product
                                                        Collection</h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="" method="post"
                                                        action="{{ route('vendorproductcollection.master.store') }}"
                                                        enctype="multipart/form-data"
                                                        onsubmit="return confirm('Are you sure, you want to Save it?')">
                                                        @csrf
                                                        <div class="form">
                                                            <div class="form-group">
                                                                <label for="validationCustom01" class="mb-1">Product Tag
                                                                </label>
                                                                <input class="form-control" id="" name="name"
                                                                    type="text" required="true">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="validationCustom02" class="mb-1">Tag Image
                                                                </label>
                                                                <input class="form-control" name="image" require=""
                                                                    type="file">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="validationCustom01"
                                                                    class="mb-1">Status</label>
                                                                <select class="custom-select w-100 form-control"
                                                                    name="status" required="">
                                                                    <option value="1">Active</option>
                                                                    <option value="0">Inactive</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-primary" type="submit">Save</button>
                                                            <button class="btn btn-secondary" type="button"
                                                                data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="datatable-dashv1-list custom-datatable-overright mt-3">
                                <table class="table" id="table" data-click-to-select="true" data-sort-name="id"
                                    data-sort-order="asc" data-mobile-responsive="true" data-toggle="table"
                                    data-show-columns="true" data-sort="true" data-pagination="true" data-page-size="25" data-search="true"
                                    data-show-refresh="false" data-key-events="true" data-resizable="true" data-cookie="true"
                                    data-show-export="false" data-click-to-select="true" data-toolbar="#toolbar">
                                    <thead>
                                        <tr>
                                            <th data-field="id" data-sortable="true">Id</th>
                                            <th data-field="image" data-sortable="true">Image</th>
                                            <th data-field="collection" data-sortable="true">Product Collection</th>


                                            <th data-field="status" data-sortable="true">Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($productcollection as $productcollection)
                                            <tr>
                                                <td>#{{ $loop->iteration }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <img src="{{ asset('assets/images/productcollection') . '/' . $productcollection->image }}"
                                                            alt=""
                                                            class="img-fluid img-40 me-2 blur-up lazyloaded">
                                                    </div>
                                                </td>
                                                <td style="width:100%;">
                                                    {{ $productcollection->name }}
                                                </td>
                                                </td>
                                                <td>
                                                    <label class="switch">
                                                        <input type="checkbox"
                                                            onclick="return confirm('Are you sure, you want to Change it?')"
                                                            checked id="togBtn">
                                                        <div class="slider round">
                                                            <!--ADDED HTML -->
                                                            <span class="off">Inactive </span>
                                                            <span class="on">Active</span>
                                                            <!--END-->
                                                        </div>
                                                    </label>
                                                </td>
                                                <td>
                                                    <form
                                                        action="{{ route('vendorproductcollection.master.destroy', $productcollection->id) }}"
                                                        method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-warning mx-1"
                                                            onclick="return confirm('Are you sure, you want to delete it?')"><i
                                                                class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
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

