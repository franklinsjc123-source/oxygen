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
                                <h3>Route

                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="index.php"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item active">Route</li>
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
                                    Route</button>

                                <div class="btn-popup pull-right">

                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                        data-backdrop="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title f-w-600" id="exampleModalLabel">Route</h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="" id="form" method="post">
                                                        <div class="form">

                                                            <div class="form-group">
                                                                <label for="validationCustom01" class="mb-1">Select Zonal
                                                                    :</label>
                                                                <select class="custom-select w-100 form-control"
                                                                    name="zonal_id" id="zonal_id" required="">
                                                                    <option value="">--Select--</option>

                                                                    {!! $data->zonaList !!}

                                                                </select>

                                                            </div>

                                                            <div class="form-group">
                                                                <label for="validationCustom01" class="mb-1">Route Name
                                                                    :</label>
                                                                <input class="form-control" id="name" type="text"
                                                                    name="name" required="true">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="validationCustom01"
                                                                    class="mb-1">Status</label>
                                                                <select class="custom-select w-100 form-control"
                                                                    required="">


                                                                    <option value="Active">Active</option>
                                                                    <option value="Inactive">Inactive</option>

                                                                </select>
                                                                <input type="hidden" name="routeId" value="-1" />
                                                                <input type="hidden" name="createdBy"
                                                                    value="{{ session()->get('userId') }}">
                                                            </div>
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-primary" id="btnSave"
                                                        type="submit">Save</button>
                                                    <button class="btn btn-secondary" type="button"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>

                                                </form>
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
                                                <th data-field="id" data-sortable="true">Route ID</th>
                                                <th data-field="image" data-sortable="true">Zonal</th>
                                                <th data-field="category" data-sortable="true">Route</th>


                                                <th data-field="status" data-sortable="true">Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($data->routeList as $route)
                                                <tr>
                                                    <td>{{ $route->id }}</td>
                                                    <td>{{ $route->name }}</td>
													<td>{{ $route->zonals->name }}</td>
                                                    <td>
                                                        <label class="switch">
                                                            <input type="checkbox"
                                                                onclick="return confirm('Are you sure, you want to Change it?')"
                                                                checked id="togBtn">
                                                            <div class="slider round">
                                                                @if ($route->status)
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
                                                                data-bs-target="#edit{{$route->id}}"data-original-title="Edit"><i
                                                                    class="fa fa-pencil"></i> </a>
                                                            <a href="{{url('route_delete/'.$route->id)}}"
                                                                onclick="return confirm('Are you sure, you want to delete it?')"
                                                                class="badge badge-warning px-2" data-toggle="tooltip"
                                                                data-placement="top" title=""
                                                                data-original-title="Delete"><i
                                                                    class="fa fa-trash"></i></a></span></td>
                                                </tr>


                                                <div class="btn-popup pull-right">

                                                    <div class="modal fade" id="edit{{$route->id}}" tabindex="-1" role="dialog"
                                                        data-backdrop="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                        <div class="modal-dialog" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title f-w-600" id="exampleModalLabel">Route</h5>
                                                                    <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                                        aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <form class="" action="{{ url('route_update/'.$route->id) }}" id="form" method="post">
                                                                        <div class="form">
                                    
                                                                            <div class="form-group">
                                                                                <label for="validationCustom01" class="mb-1">Select Zonal
                                                                                    :</label>
                                                                                <select class="custom-select w-100 form-control"
                                                                                    name="zonal_id" id="zonal_id" required="">
                                                                                    <option value="">--Select--</option>
                                    
                                                                                    {!! $data->zonaList !!}
                                    
                                                                                </select>
                                    
                                                                            </div>
                                    
                                                                            <div class="form-group">
                                                                                <label for="validationCustom01" class="mb-1">Route Name
                                                                                    :</label>
                                                                                <input class="form-control" id="name" type="text"
                                                                                    name="name" required="true" value="{{$route->name}}">
                                                                            </div>
                                    
                                                                            <div class="form-group">
                                                                                <label for="validationCustom01"
                                                                                    class="mb-1">Status</label>
                                                                                <select class="custom-select w-100 form-control"
                                                                                    required="" name="status">
                                    
                                    
                                                                                    <option value="Active">Active</option>
                                                                                    <option value="Inactive">Inactive</option>
                                    
                                                                                </select>
                                                                                <input type="hidden" name="routeId" value="-1" />
                                                                                <input type="hidden" name="createdBy"
                                                                                    value="{{ session()->get('userId') }}">
                                                                            </div>
                                                                        </div>
                                    
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button class="btn btn-primary" id="btnSave"
                                                                        type="submit">Save</button>
                                                                    <button class="btn btn-secondary" type="button"
                                                                        data-bs-dismiss="modal">Close</button>
                                                                </div>
                                    
                                                                </form>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>      
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
                                url: "{{ route('checRoutenamePost') }}",
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
                            required: "Required  route name"
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
                        var url = "{{ route('saveRoute') }}";
                        var successCallBack = function successCallBack(data) {
                            loadJsonToHtml(data);
                        }
                        ajaxPost(formData, url, successCallBack, null);
                    }
                }
            });
        </script>
    @endpush
