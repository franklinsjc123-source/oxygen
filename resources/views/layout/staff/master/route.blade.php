@extends('layout.auth.master')
@section('contents')
    

    <!-- page-wrapper Start-->
    @include('paritials.auth.topmenu');
    <!-- Page Header Ends -->

    <!-- Page Body Start-->
    <div class="page-body-wrapper">

        <!-- Page Sidebar Start-->
        @include('paritials.staffauth.sidemenu');
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
                            <li class="breadcrumb-item"><a href="{{ url('staff/dashboard/'.session()->get('login_id')) }}"><i data-feather="home"></i></a></li>
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
<style>
/* Ensure datatable and its wrappers take full 100% width of card */
.datatable-dashv1-list,
.custom-datatable-overright,
.bootstrap-table,
.fixed-table-container,
.fixed-table-toolbar,
.fixed-table-pagination,
.fixed-table-container table,
table#table {
    width: 100% !important;
    max-width: 100% !important;
    float: none !important;
    clear: both !important;
}
</style>

                            <div class="card-body">
                                <div id="toolbar" class="d-flex align-items-center">
                                    <a href="{{ route('staffroute.export') }}" class="btn btn-success me-2" style="background-color: #28a745; border-color: #28a745; color: #fff;" data-toggle="tooltip" data-placement="top" title="Export Excel" data-original-title="Export Excel"><i class="fa fa-file-excel-o me-1"></i> Export Excel</a>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                        data-original-title="test" data-bs-target="#exampleModal"><i class="fa fa-plus"></i> Add
                                        Route</button>
                                </div>

                                <div class="btn-popup">

                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                        data-backdrop="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
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
                                                                    required="" id="status" name="status">


                                                                    <option value="1">Active</option>
                                                                    <option value="0">Inactive</option>

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
                                        data-show-columns="true" data-sort-name="image" data-sort-order="asc"
                                        data-mobile-responsive="true" data-toggle="table" data-sort="true"
                                        data-pagination="true" data-page-size="100" data-search="true" data-show-refresh="false"
                                        data-key-events="true" data-resizable="true" data-cookie="true"
                                        data-show-export="false" data-click-to-select="true" data-toolbar="#toolbar">

                                        <thead>
                                            <tr>
                                                <th data-field="image" data-sortable="true">Zonal</th>
                                                <th data-field="category" data-sortable="true">Route</th>


                                                <th data-field="status" data-sortable="true">Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data->routeList as $rrr)
                                                <tr>
                                                    <td>
                                                        {{ optional(App\Models\Zonal::find($rrr->zonal_id))->name ?? 'N/A' }}
                                                    </td>
                                                    <td>{{ $rrr->name }}</td>
                                                    <td>
                                                        <label class="switch">
                                                            @if($rrr->status == 1)
                                                                <input type="checkbox"
                                                                    onclick="return confirm('you want to Change it?  Please Click Edit Button')"
                                                                    checked id="togBtn">
                                                            @else
                                                                <input type="checkbox"
                                                                    onclick="return confirm('you want to Change it?  Please Click Edit Button')" 
                                                                    id="togBtn">
                                                            @endif
                                                            <div class="slider round">                                                              
                                                                <span class="off">Inactive </span>
                                                                <span class="on">Active</span>
                                                            </div>
                                                        </label>
                                                    </td>
                                                    <td>
                                                        <span class="d-flex align-items-center"> 
                                                            <button type="button" class="edit_route btn btn-secondary mx-1" value="{{$rrr->id}}">
                                                                <i class="fa fa-pencil"></i>
                                                            </button>
                                                            <form action="{{ route('staffroutedelete', $rrr->id) }}" method="post" class="d-inline m-0">
                                                                @method('POST')
                                                                @csrf
                                                                <button type="submit" class="btn btn-warning mx-1" value="{{$rrr->id}}"
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

                                <div class="modal fade" id="editroute" tabindex="-1" role="dialog"
                                    data-backdrop="false" aria-labelledby="editRouteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title f-w-600" id="editRouteModalLabel">Route</h5>
                                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                    aria-label="Close"><span aria-hidden="true">×</span></button>
                                            </div>
                                            <div class="modal-body">
                                                <form class="" id="editform" method="post">
                                                    <div class="form">
                                                        <input type="hidden" id="editzonal_id" name="editzonal_id">
                                                        <input type="hidden" id="editid" name="editid">
                                                        <div class="form-group">
                                                            <label for="editzonal_name" class="mb-1">Select Zonal :</label>
                                                            <select class="custom-select w-100 form-control"
                                                                name="editzonal_name" id="editzonal_name" required="">
                                                                <option value="">--Select--</option>
                                                                {!! $data->zonaList !!}
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="editname" class="mb-1">Route Name :</label>
                                                            <input class="form-control" type="text"
                                                                name="editname" id="editname" required="true">
                                                        </div>

                                                        <div class="form-group">
                                                            <label for="editstatus" class="mb-1">Status</label>
                                                            <select class="custom-select w-100 form-control"
                                                                required="" name="editstatus" id="editstatus">
                                                                <option value="1">Active</option>
                                                                <option value="0">Inactive</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button class="btn btn-primary" id="update_route" type="submit">Update</button>
                                                <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                                            </div>
                                            </form>
                                        </div>
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
    @push('scripts')
        <script>
            $(function() {
                var validation_option = getValidationOptions({
                    rules: {
                        name: {
                            required: true,
                            remote: {
                                url: "{{ route('staffchecRoutenamePost') }}",
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
                    $('#exampleModal').modal('hide');
                    location.reload();
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
        <script>
            $(document).on('click','.edit_route', function(e){
                e.preventDefault();
                var id = $(this).val();
                $('#editroute').modal('show');
                $.ajax({
                    url: "{{ url('staff/editroute') }}/"+id+"/edit",          
                    type: "get",
                    dataType: 'json',
                    success: function (response) {
                        if(response.status == 404) {
                            $('successmessage').html('').addClass('alert alert-danger').text(response.message);
                        } else if(response.editroute) {
                            $('#editid').val(response.editroute.id);
                            $('#editzonal_id').val(response.editroute.zonal_id);
                            $('#editzonal_name').val(response.editroute.zonal_id);
                            $('#editname').val(response.editroute.name);
                            $('#editstatus').val(response.editroute.status);
                        }  
                    }
                });
            });

            $(document).on('click','#update_route', function(e){
                e.preventDefault();
                var id = $('#editid').val();
                var zonal_id = $('#editzonal_name').val() || $('#editzonal_id').val();
                var name = $('#editname').val();
                var status = $('#editstatus').val();

                var url = '{{ route("staffroute_update", ":id") }}'.replace(':id', id );

                $.ajax({
                    url: url,
                    type: "POST",
                    data: {
                        _token : `{{csrf_token()}}`,
                        zonal_id: zonal_id, 
                        name: name,
                        status: status
                    },
                    dataType: 'html',
                    success: function (response) {
                        $('#editroute').modal('hide');
                        location.reload();   
                    }
                });
            });
        </script>
    @endpush
