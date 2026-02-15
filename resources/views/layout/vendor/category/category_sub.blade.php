@extends('layout.auth.master')
@section('contents')
@include('paritials.auth.header')?>

<!-- page-wrapper Start-->
@include('paritials.auth.topmenu');
<!-- Page Header Ends -->

<!-- Page Body Start-->
<div class="page-body-wrapper">
    @include('paritials.vendorauth.sidemenu');

    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="page-header-left">
                            <h3>Sub Category</h3>
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

        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">
                        <div class="card-body">
                            @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                            @endif

                            <div class="datatable-dashv1-list custom-datatable-overright">
                                <table class="table" id="table" data-click-to-select="true" data-show-columns="true"
                                    data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true"
                                    data-toggle="table" data-sort="true" data-pagination="true" data-search="true"
                                    data-show-refresh="true" data-key-events="true" data-resizable="true"
                                    data-cookie="true" data-show-export="true" data-click-to-select="true"
                                    data-toolbar="#toolbar">

                                    <thead>
                                        <tr>
                                            <th data-field="id" data-sortable="true">Id</th>
                                            <th data-field="image" data-sortable="true">Image</th>
                                            <th data-field="maincategory" data-sortable="true">Main Category</th>
                                            <th data-field="category" data-sortable="true">Category</th>
                                            <th data-field="subcategory" data-sortable="true">Sub Category</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($sub_category_data as $sub_category)
                                        <tr>
                                            <td>{{ str_pad($loop->iteration, 4, '0', STR_PAD_LEFT) }}</td>
                                            <td>
                                                <div class="d-flex">
                                                    <img src="{{ asset('assets/images/categorySub') . '/' . $sub_category->category_sub_image }}"
                                                        alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">
                                                </div>
                                            </td>
                                            <td>{{ $sub_category->category_main_name }}</td>
                                            <td>{{ $sub_category->category_name }}</td>
                                            <td>{{ $sub_category->category_sub_name }}</td>
                                            <td>
                                                <a href="{{ url('vendar/viewcategory_sub/' . $sub_category->me_id) }}"
                                                    class="btn btn-warning">View</a>
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
    </div>

    @if ($view == 'Modal')
    @php
    $selectedAttributeIds = $selectedAttributeIds ?? [];
    $selectedSpecificationIds = $selectedSpecificationIds ?? [];
    @endphp
    <div class="btn-popup pull-right">
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl" role="document">
                <div class="modal-content">
                    <form method="POST" action="{{ route('vendorsubcategory_mapping_update', $sub_category_viewdata->me_id) }}">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title f-w-600" id="exampleModalLabel">Sub Category Mapping</h5>
                            <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">x</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12 col-md-4">
                                    <img src="{{ asset('assets/images/categorySub') . '/' . $sub_category_viewdata->category_sub_image }}"
                                        alt="" class="img-fluid me-2 blur-up lazyloaded">
                                </div>
                                <div class="col-12 col-md-8">
                                    <table class="table table-bordered">
                                        <tr>
                                            <td>Main Category :</td>
                                            <td>{{ $sub_category_viewdata->category_main_name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Category :</td>
                                            <td>{{ $sub_category_viewdata->category_name }}</td>
                                        </tr>
                                        <tr>
                                            <td>Sub Category :</td>
                                            <td>{{ $sub_category_viewdata->category_sub_name }}</td>
                                        </tr>
                                    </table>
                                </div>

                                <div class="col-12 mt-3">
                                    <h5>Attributes</h5>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th style="width: 60px;">Select</th>
                                            <th>Name</th>
                                            <th>Reference Name</th>
                                            <th>Values</th>
                                        </tr>
                                        @foreach ($attributegroup as $group)
                                        @php
                                        $attr_val = json_decode($group->attribute_values, true) ?: [];
                                        @endphp
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="category_sub_attribute_ids[]"
                                                    value="{{ $group->id }}"
                                                    {{ in_array($group->id, $selectedAttributeIds) ? 'checked' : '' }}>
                                            </td>
                                            <td>{{ $group->attribute_group_name }}</td>
                                            <td>{{ $group->attribute_group_refname }}</td>
                                            <td>
                                                @foreach ($attr_val as $value)
                                                <span class="p-1 border border-dark px-3 mx-1 rounded">{{ $value }}</span>
                                                @endforeach
                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>

                                <div class="col-12 mt-2">
                                    <h5>Specification</h5>
                                    <table class="table table-bordered">
                                        <tr>
                                            <th style="width: 60px;">Select</th>
                                            <th>Name</th>
                                            <th>Reference Name</th>
                                            <th>Values</th>
                                        </tr>
                                        @foreach ($specificationgroup as $group)
                                        @php
                                        $spec_val = json_decode($group->specification_values, true) ?: [];
                                        @endphp
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="category_sub_specification_ids[]"
                                                    value="{{ $group->id }}"
                                                    {{ in_array($group->id, $selectedSpecificationIds) ? 'checked' : '' }}>
                                            </td>
                                            <td>{{ $group->specification_group_name }}</td>
                                            <td>{{ $group->specification_group_refname }}</td>
                                            <td>
                                                @foreach ($spec_val as $value)
                                                <span class="p-1 border border-dark px-3 mx-1 rounded">{{ $value }}</span>
                                                @endforeach
                                            </td>
                                        </tr>
                                        @endforeach
                                    </table>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endif

    <script>
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
    </script>

    @if($view=='Modal')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $('#exampleModal').modal('show');
    </script>
    @endif
    @endsection
