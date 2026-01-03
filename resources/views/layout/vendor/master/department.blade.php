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
                                <h3>Department

                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="dashboard.php"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item active">department</li>
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
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                    data-original-title="test" data-bs-target="#exampleModal"><i class="fa fa-plus"></i> Add
                                    Department</button>

                                <div class="btn-popup pull-right">

                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                        data-backdrop="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title f-w-600" id="exampleModalLabel">Department</h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="" method="post"
                                                        id="form">
                                                        <div class="form">


                                                            <div class="form-group">
                                                                <label for="validationCustom01" class="mb-1">Department
                                                                    :</label>
                                                                <input class="form-control" id="name" name="name" type="text"
                                                                    required="true">
                                                            </div>
															 <input type="hidden" name="departmentId" value="-1" />
                                                        <input type="hidden" name="createdBy"
                                                            value="{{ session()->get('userId') }}" />

                                                            <div class="form-group">
                                                                <label for="validationCustom01" 
                                                                    class="mb-1">Status</label>
                                                                <select class="custom-select w-100 form-control"
                                                                    required="">


                                                                    <option value="Active">Active</option>
                                                                    <option value="Inactive">Inactive</option>

                                                                </select>

                                                            </div>
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-primary" id="btnSave" type="submit">Save</button>
                                                    <button class="btn btn-secondary" type="button"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="datatable-dashv1-list custom-datatable-overright">


                                    <table class="table" id="table" data-click-to-select="true" data-sort-name="id"
                                        data-sort-order="asc" data-mobile-responsive="true" data-toggle="table"
                                        data-sort="true" data-pagination="true" data-search="true" data-show-refresh="true"
                                        data-show-columns="true" data-key-events="true" data-resizable="true"
                                        data-cookie="true" data-show-export="true" data-click-to-select="true"
                                        data-toolbar="#toolbar">

                                        <thead>
                                            <tr>
                                                <th data-field="id" data-sortable="true">Id</th>

                                                <th data-field="department" data-sortable="true">Department</th>


                                                <th data-field="status" data-sortable="true">Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>



                                            @foreach ($departments as $department)
                                                <tr>
                                                    <td>{{ $department->id }}</td>
                                                    <td>{{ $department->name }}</td>
                                                    <td>
                                                        <label class="switch">
                                                            <input type="checkbox"
                                                                onclick="return confirm('Are you sure, you want to Change it?')"
                                                                checked id="togBtn">
                                                            <div class="slider round">
                                                                @if ($department->status)
                                                                    <span class="off">Inactive </span>
                                                                @else
                                                                    <span class="on">Active</span>
                                                                @endif
                                                                <!--ADDED HTML -->


                                                                <!--END-->
                                                            </div>
                                                        </label>
                                                    </td>

                                                    <td><span> <a href="#" class="badge badge-secondary px-2"
                                                                data-bs-toggle="modal" data-original-title="test"
                                                                data-bs-target="#exampleModal"data-original-title="Edit"><i
                                                                    class="fa fa-pencil"></i> </a>
                                                            <a href="#"
                                                                onclick="return confirm('Are you sure, you want to delete it?')"
                                                                class="badge badge-warning px-2" data-toggle="tooltip"
                                                                data-placement="top" title=""
                                                                data-original-title="Delete"><i
                                                                    class="fa fa-trash"></i></a></span></td>
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
@push('scripts')
        <script>
            $(function() {
                var validation_option = getValidationOptions({
                    rules: {
                        name: {
                            required: true,
                            remote: {
                                url: "{{ route('checkDepartmentnamePost') }}",
                                type: "post",
                                data: {
                                    name: function() {
                                        return $("#name").val();
                                    },
                                },
                                dataFilter: function(data) {
                                    var json = JSON.parse(data);
                                    if (json != "true") {
                                        $('#name').addClass("is-invalid");
                                        return "\" " + json + " \"";
                                    } else {
                                        return true;
                                    }
                                }
                            }
                        }
                    },
                    messages: {
                        Name: {
                            required: "Required  zonal name"
                        }
                    }
                });

                $('#form').validate(validation_option);

                $('#btnSave').click(function(event) {
                    event.preventDefault();
                    save(null);
                });

                function save(callBack) {
                    if ($('#form').valid()) {
                        var disabled = $('#form').find(':input:disabled').removeAttr('disabled');
                        var formData = $('#form').serializeFormJSON();
                        disabled.attr('disabled', 'disabled');
                        var url = "{{ route('saveDepartments') }}";
                        var successCallBack = function successCallBack(data) {
                            loadJsonToHtml(data);
                        }
                        ajaxPost(formData, url, successCallBack, null);
                    }
                }
            });
        </script>
    @endpush
