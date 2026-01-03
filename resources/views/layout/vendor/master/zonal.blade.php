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
            @include('paritials.auth.notification')
            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <h3>Zonal

                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="dashboard.php"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item active">Zonal</li>
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
                                    Zonal</button>

                                <div class="btn-popup pull-right">

                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                        data-backdrop="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title f-w-600" id="exampleModalLabel">Zonal</h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="" id="form" method="post">
                                                        <div class="form">


                                                            <div class="form-group">
                                                                <label for="validationCustom01" class="mb-1">Zonal Name
                                                                    :</label>
                                                                <input class="form-control" id="name" type="text"
                                                                    name="name" required="true">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="validationCustom01"
                                                                    class="mb-1">Status</label>
                                                                <select class="custom-select w-100 form-control"
                                                                    required="">


                                                                    <option value="1">Active</option>
                                                                    <option value="0">Inactive</option>

                                                                </select>

                                                            </div>
                                                        </div>
                                                        <input type="hidden" name="zonalId" value="-1" />
                                                        <input type="hidden" name="createdBy"
                                                            value="{{ session()->get('userId') }}" />
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
                                                <th data-field="id" data-sortable="true">Id</th>

                                                <th data-field="category" data-sortable="true">Zonal Name</th>


                                                <th data-field="status" data-sortable="true">Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($result as $data)
                                                <tr>
                                                    <td>{{ $data->id }}</td>
                                                    <td>{{ $data->name }}</td>
                                                    <td>
                                                        <label class="switch">
                                                            <input type="checkbox"
                                                                onclick="return confirm('Are you sure, you want to Change it?')"
                                                                checked id="togBtn">
                                                            <div class="slider round">
                                                                @if ($data->status)
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
                                url: "{{ route('checkZonalnamePost') }}",
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
                        var url = "{{ route('saveZonals') }}";
                        var successCallBack = function successCallBack(data) {
                            loadJsonToHtml(data);
                        }
                        ajaxPost(formData, url, successCallBack, null);
                    }
                }
            });


            var dataCol = [{
                    title: "Zonal ID",
                    data: "id",
                    visible: false,
                    className: "never no_export"
                },
                {
                    title: "Sl.No",
                    data: "id",
                },
                {
                    title: "Name",
                    data: "name",
                },
                {
                    title: "Status",
                    data: "status",
                },
                {
                    title: "Action",
                    data: null,
                    className: "text-center no_export min-wt-90",
                    defaultContent: '<div class="d-flex justify-content-center flex-wrap"><a href="" class="update btn-crc btn-warning-1" title="Edit"><i class="far fa-edit"></i></a></div>'
                }
            ];

            var options = dataTableOptions({
                columns: dataCol,
                data: null,
                buttons: [{
                    extend: "excelHtml5",
                    text: '<i class="fas fa-file-excel m-0"></i>',
                    orientation: 'potrait',
                    className: 'btn-crc buttons-excel mr-3',
                    exportOptions: {
                        columns: ':not(.no_export)'
                    },
                    init: function(api, node, config) {
                        $(node).removeClass('btn-secondary')
                    }
                }, {
                    extend: "pdf",
                    text: '<i class="fas fa-file-pdf m-0"></i>',
                    orientation: 'potrait',
                    className: 'btn-crc buttons-pdf',
                    exportOptions: {
                        columns: [1, 2, 3, 4, 5, 6]
                    },
                    init: function(api, node, config) {
                        $(node).removeClass('btn-secondary')
                    }
                }]
            });
            DataTbl = $('#DataTbl').DataTable(options);


            $(function() {
                loadData();
            });

            function loadData() {
                var url = '{{ route('zonalsListingPost') }}';
                var successCallBack = function successCallBack(returnData) {
                    DataTbl.clear().draw();
                    DataTbl.rows.add(returnData.data).draw();
                    $('#divResult').show();
                    $('#divNodata').hide();
                }
                ajaxPost(null, url, successCallBack, null);
            }

            $('#DataTbl').on('click', 'a.update', function(e) {
                e.preventDefault();
                var current_row = $(this).parents('tr');
                if (current_row.hasClass('child')) {
                    current_row = current_row.prev();
                }
                var data = DataTbl.row(current_row).data();
                var link = '{{ route('zonalsListingPost', ':id') }}';
                link = link.replace(':id', data.DepartmentId);
                location = link;
            });
        </script>
    @endpush
