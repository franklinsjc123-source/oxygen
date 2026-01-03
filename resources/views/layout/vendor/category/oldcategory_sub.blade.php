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
                                <h3>Sub Category

                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="dashboard.php"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item active">Sub Category</li>
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
                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-original-title="test" data-bs-target="#exampleModal"><i class="fa fa-plus"></i> Add
                                    sub Category</button>

                                <div class="btn-popup pull-right">
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title f-w-600" id="exampleModalLabel">Add Product sub
                                                        Category</h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="" method="post"
                                                        action="{{ route('category.sub.store') }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form">
                                                            <div class="form-group">
                                                                <label for="validationCustom01" class="mb-1">Select Main
                                                                    Category :</label>
                                                                <select class="custom-select w-100 form-control"
                                                                    name="main_category_id" required id="main_category">
                                                                    <option value="" selected hidden>Select Main
                                                                        Category</option>
                                                                    @foreach ($category_main as $main_category)
                                                                        <option value="{{ $main_category->id }}">
                                                                            {{ $main_category->category_main_name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="validationCustom01" class="mb-1">Select
                                                                    Category :</label>
                                                                <select class="custom-select w-100 form-control"
                                                                    name="category_id" id="category_id">
                                                                    <option value="" selected hidden>Select
                                                                        Category</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="validationCustom01" class="mb-1">Sub Category
                                                                    :</label>
                                                                <input class="form-control" name="sub_category_name"
                                                                    id="" required type="text">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="validationCustom02" class="mb-1">Sub Category
                                                                    Image :</label>
                                                                <input class="form-control" name="sub_category_iamge"
                                                                    type="file" accept="image/*" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="validationCustom01"
                                                                    class="mb-1">Status</label>
                                                                <select class="custom-select w-100 form-control"
                                                                    name="status" required>
                                                                    <option value="1">Active</option>
                                                                    <option value="0">Inactive</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="category.php"> <button class="btn btn-primary"
                                                                    type="submit">Save</button></a>
                                                            <button class="btn btn-secondary" type="button"
                                                                data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="datatable-dashv1-list custom-datatable-overright">
                                    <table class="table" id="table" data-click-to-select="true"
                                        data-show-columns="true" data-sort-name="id" data-sort-order="asc"
                                        data-mobile-responsive="true" data-toggle="table" data-sort="true"
                                        data-pagination="true" data-search="true" data-show-refresh="true"
                                        data-key-events="true" data-resizable="true" data-cookie="true"
                                        data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">

                                        <thead>
                                            <tr>
                                                <th data-field="id" data-sortable="true">Id</th>
                                                <th data-field="image" data-sortable="true">Image</th>
                                                <th data-field="maincategory" data-sortable="true">Main Category</th>
                                                <th data-field="category" data-sortable="true">Category</th>
                                                <th data-field="subcategory" data-sortable="true">Sub Category</th>
                                                <th data-field="status" data-sortable="true">Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($sub_category_data as $sub_category)
                                                <tr>
                                                    <td>#{{ $loop->iteration }}</td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <img src="{{ asset('assets/images/categorySub') . '/' . $sub_category->category_sub_image }}"
                                                                alt=""
                                                                class="img-fluid img-30 me-2 blur-up lazyloaded">
                                                        </div>
                                                    </td>

                                                    <td>{{ $sub_category->category_main_name }}</td>
                                                    <td>{{ $sub_category->category_name }}</td>
                                                    <td>{{ $sub_category->category_sub_name }}</td>
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
                                                        <span class="d-flex">
                                                            <a href="#" class="btn btn-secondary mx-1"
                                                                data-bs-toggle="modal" data-original-title="test"
                                                                data-bs-target="#exampleModal"data-original-title="Edit"><i
                                                                    class="fa fa-pencil"></i>
                                                            </a>
                                                            <form
                                                                action="{{ route('category.sub.destroy', $sub_category->id) }}"
                                                                method="post">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="submit" class="btn btn-warning mx-1"
                                                                    onclick="return confirm('Are you sure, you want to delete it?')"><i
                                                                        class="fa fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        </span>
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

        <script>
            // AJAX REQUEST
            function getAjaxValue(url, method, callback) {
                $.ajax({
                    url: url,
                    type: method,
                    data: {
                        "_token": "{{ csrf_token() }}"
                    },
                    dataType: "json",
                    success: callback
                });
            }


            // Main Categoy Id
            $('#main_category').on('change', function() {
                let main_category_id = $(this).val();
                let url = '{{ route('getCategory') }}?main_category_id=' + main_category_id;
                let method = 'GET';
                getAjaxValue(url, method, function(data) {
                    $('#category_id').empty();

                    $.each(data, function(key, category) {
                        $('#category_id').append(
                            `<option value="${category.id}" selected>${category.category_name}</option>`
                        );
                    });
                })
            })
        </script>
    @endsection
