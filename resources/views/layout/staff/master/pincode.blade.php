@extends('layout.auth.master')
@section('contents')
    <!-- page-wrapper Start-->
    @include('paritials.auth.topmenu')
    <!-- Page Header Ends -->

    <!-- Page Body Start-->
    <div class="page-body-wrapper">

        <!-- Page Sidebar Start-->
        @include('paritials.staffauth.sidemenu')
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
                            <li class="breadcrumb-item"><a href="{{ route('staffdashboard', session()->get('login_id')) }}"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item active">Pincode</li>
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
/* Ensure breadcrumb is cleanly visible under top navbar on both desktop and mobile */
.page-wrapper .page-body-wrapper .page-body,
.page-wrapper .page-body-wrapper .page-sidebar ~ .page-body,
.page-wrapper .page-body-wrapper .page-sidebar.open ~ .page-body {
    margin-top: 60px !important;
    padding-top: 16px !important;
}
.page-wrapper .page-body-wrapper .page-header {
    margin-top: 0 !important;
    margin-bottom: 12px !important;
    padding-top: 0 !important;
    padding-bottom: 0 !important;
    border-bottom: none !important;
}

/* Pincode Toolbar: 2x2 Grid on Mobile, Balanced Flex on Desktop */
@media (max-width: 767.98px) {
    .fixed-table-toolbar .bs-bars {
        width: 100% !important;
        margin: 10px 0 8px 0 !important;
        float: none !important;
    }
    .fixed-table-toolbar .bs-bars #toolbar,
    .fixed-table-toolbar .bs-bars .pincode-toolbar,
    #toolbar.pincode-toolbar {
        display: grid !important;
        grid-template-columns: repeat(2, 1fr) !important;
        gap: 8px !important;
        width: 100% !important;
        overflow-x: visible !important;
        box-sizing: border-box !important;
    }
    .fixed-table-toolbar .bs-bars #toolbar .btn,
    .fixed-table-toolbar .bs-bars #toolbar a.btn,
    .fixed-table-toolbar .bs-bars #toolbar button,
    .fixed-table-toolbar .bs-bars #toolbar a,
    .fixed-table-toolbar .bs-bars .pincode-toolbar .btn,
    .fixed-table-toolbar .bs-bars .pincode-toolbar a.btn,
    .fixed-table-toolbar .bs-bars .pincode-toolbar button,
    .fixed-table-toolbar .bs-bars .pincode-toolbar a,
    #toolbar.pincode-toolbar .btn,
    #toolbar.pincode-toolbar a.btn,
    #toolbar.pincode-toolbar button,
    #toolbar.pincode-toolbar a {
        width: 100% !important;
        max-width: 100% !important;
        flex: none !important;
        height: 38px !important;
        min-height: 38px !important;
        font-size: 11.5px !important;
        font-weight: 600 !important;
        padding: 6px 4px !important;
        white-space: nowrap !important;
        display: inline-flex !important;
        align-items: center !important;
        justify-content: center !important;
        text-align: center !important;
        margin: 0 !important;
        margin-right: 0 !important;
        margin-left: 0 !important;
        border-radius: 6px !important;
        box-sizing: border-box !important;
        line-height: 1.2 !important;
        text-decoration: none !important;
    }
    .fixed-table-toolbar .bs-bars #toolbar .btn i,
    .fixed-table-toolbar .bs-bars #toolbar a.btn i,
    #toolbar.pincode-toolbar .btn i,
    #toolbar.pincode-toolbar a.btn i {
        margin-right: 4px !important;
        font-size: 12px !important;
    }
}

@media (min-width: 768px) {
    .fixed-table-toolbar {
        display: flex !important;
        align-items: center !important;
        flex-wrap: nowrap !important;
    }
    .fixed-table-toolbar .search {
        flex: 1 1 auto !important;
        min-width: 200px !important;
        margin: 5px 0 !important;
    }
    .fixed-table-toolbar .search input.form-control {
        height: 38px !important;
        font-size: 13px !important;
    }
    .fixed-table-toolbar .columns {
        margin: 5px 12px 5px 0 !important;
    }
    .fixed-table-toolbar .bs-bars #toolbar,
    .fixed-table-toolbar .bs-bars .pincode-toolbar,
    #toolbar.pincode-toolbar {
        display: flex !important;
        flex-wrap: nowrap !important;
        align-items: center !important;
        gap: 8px !important;
        width: auto !important;
    }
    .fixed-table-toolbar .bs-bars #toolbar .btn,
    .fixed-table-toolbar .bs-bars #toolbar a.btn,
    .fixed-table-toolbar .bs-bars #toolbar button,
    .fixed-table-toolbar .bs-bars #toolbar a,
    #toolbar.pincode-toolbar .btn,
    #toolbar.pincode-toolbar a.btn,
    #toolbar.pincode-toolbar button,
    #toolbar.pincode-toolbar a {
        width: auto !important;
        flex: 0 0 auto !important;
        height: 38px !important;
        font-size: 13px !important;
        font-weight: 600 !important;
        padding: 6px 14px !important;
        display: inline-flex !important;
        align-items: center !important;
        margin: 0 !important;
        white-space: nowrap !important;
    }
}

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

/* Modern Import Modal Styles */</style>
                            <div class="card-body">

                                <div id="toolbar" class="d-flex align-items-center pincode-toolbar">
                                    <a href="{{ route('staffpincode.export') }}" class="btn btn-success me-2" style="background-color: #28a745; border-color: #28a745; color: #fff;" data-toggle="tooltip" data-placement="top" title="Export Excel" data-original-title="Export Excel"><i class="fa fa-file-excel-o me-1"></i> Export Excel</a>
                                    <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal"
                                        data-original-title="test" data-bs-target="#exampleModal"><i class="fa fa-plus me-1"></i> Add Pincode</button>
                                    <button type="button" class="btn btn-primary me-2" data-bs-toggle="modal"
                                        data-original-title="test" data-bs-target="#exampleModalImport"><i class="fa fa-plus me-1"></i> Import Pincode</button>
                                </div>

                                    <div id="successmessage">
                                    </div>

                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title f-w-600" id="exampleModalLabel">Add Pincode</h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="" method="post" action="{{ route('staffpincode1.store') }}" enctype="multipart/form-data">
                                                        @csrf
                                                        {{-- onsubmit="return confirm('Are you sure, you want to Save it?') --}}
                                                        <div class="form">
                                                            <div class="form-group">
                                                                <label for="validationCustom02"
                                                                    class="mb-1">Zone</label>
                                                                <select class="custom-select w-100 form-control"
                                                                    required="true" id="zone_id" name="zonal_id">
                                                                    <option value="">--Select Zone--</option>
                                                                     @foreach($zone as $z)
                                                                        <option value="{{$z->id}}">{{$z->name}}</option>
                                                                    @endforeach 
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="validationCustom02"
                                                                    class="mb-1">Pincode</label>
                                                                <input class="form-control" id="pincode" name="pincode" required="" type="text">
                                                                <small id="pincode_err" class="text-danger fw-bold d-block mt-1"></small>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="validationCustom01" class="mb-1">Area</label>
                                                                <input class="form-control" id="area" name="area" required=""
                                                                    type="text">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="validationCustom02" class="mb-1">Postal Region
                                                                    :</label>
                                                                <input class="form-control" require="" id="post_regin" name="post_regin" type="text">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="validationCustom01"
                                                                    class="mb-1">Status</label>
                                                                <select class="custom-select w-100 form-control"
                                                                    required="" id="status" name="status">


                                                                    <option id="active" value="1">Active</option>
                                                                    <option id="inactive" value="0">Inactive</option>

                                                                </select>

                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button class="btn btn-primary" id="add_pincode_btn" class="submit"
                                                                type="submit">Save</button>
                                                            <button class="btn btn-secondary" type="button"
                                                                data-bs-dismiss="modal">Close</button>
                                                        </div>

                                                    </form>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                <!-- Import Pincode Modal -->
                                <div class="modal fade" id="exampleModalImport" tabindex="-1" aria-labelledby="exampleModalImportLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <form action="{{ route('importpincode') }}" method="POST" enctype="multipart/form-data">
                                                @csrf
                                                <div class="modal-header text-white" style="background-color: #183543;">
                                                    <h5 class="modal-title" id="exampleModalImportLabel"><i class="fa fa-upload me-2"></i>Import Pincode</h5>
                                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="importPincodeFile" class="form-label fw-bold">Select Excel/CSV File</label>
                                                        <input type="file" class="form-control" id="importPincodeFile" name="file" accept=".xlsx,.xls,.csv" required>
                                                        <div class="form-text">Supported formats: .xlsx, .xls, .csv (Max: 10MB)</div>
                                                    </div>
                                                    <div class="alert alert-info d-flex align-items-center" role="alert">
                                                        <i class="fa fa-info-circle me-2" style="font-size: 18px;"></i>
                                                        <div>
                                                            Download the <a href="{{ route('staff.pincode.sample.download') }}" class="alert-link" download="sample_pincode.xlsx">sample template</a> to see the required format.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">CANCEL</button>
                                                    <button type="submit" class="btn btn-primary"><i class="fa fa-upload me-1"></i> IMPORT</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>


                                <div class="datatable-dashv1-list custom-datatable-overright">
                                    <table class="table" id="table" data-click-to-select="true"
                                        data-show-columns="true" data-sort-name="zone" data-sort-order="asc"
                                        data-mobile-responsive="true" data-toggle="table" data-sort="true"
                                        data-pagination="true" data-page-size="100" data-search="true" data-show-refresh="false"
                                        data-key-events="true" data-resizable="true" data-cookie="true"
                                        data-show-export="false" data-click-to-select="true" data-toolbar="#toolbar">
                                        <thead>
                                            <tr>
                                               <!-- <th data-field="route" data-sortable="true">Route</th>-->
                                                <th data-field="zone" data-sortable="true">Zone</th>
                                                <th data-field="pincode" data-sortable="true">Pincode</th>
                                                <th data-field="area" data-sortable="true">Area</th>
                                                <th data-field="postal" data-sortable="true">Postal Region</th>

                                                <th data-field="status" data-sortable="true">Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @if($pincode)
                                            @foreach ($pincode as $pin)
                                                <tr>
                                                    
                                                    {{-- <td>{{ $pin->zonal_id }}</td> 
                                                    <td>{{ $pin->routename }}</td>--}}
                                                    <td>{{ $pin->zonalname }}</td>
                                                    {{-- <td>{{ $pin->route_id }}</td> --}}
                                                    {{-- <td>{{ $pin->pincode }}</td> --}}
                                                    <td>{{ $pin->name }}</td>
                                                    <td>{{ $pin->area }}</td>
                                                    <td>{{ $pin->post_region }}</td>
                                                    {{-- <td>{{ $pin->status }}</td> --}}
                                                    
                                                    <td>
                                                        <label class="switch">
                                                            <input type="checkbox" class="toggle-status" data-id="{{ $pin->id }}" {{ $pin->status == 1 ? 'checked' : '' }}>
                                                            <div class="slider round">
                                                                <!--ADDED HTML -->
                                                                <span class="on">Active</span>
                                                                <span class="off">Inactive </span>                                                                
                                                                <!--END-->
                                                            </div>
                                                        </label>
                                                    </td>
                                                    
                                                    <td>

                                                        <span class="d-flex">
                                                            <button type="button" value="{{$pin->id}}" class="edit_pincode btn btn-secondary mx-1"> <i
                                                                class="fa fa-pencil"></i></button>
                                                            {{-- <a href="{{ route('staffpincode1.edit', $pin->id) }}" class="btn btn-secondary mx-1"
                                                                data-bs-toggle="modal" data-original-title="test"
                                                                data-bs-target=""data-original-title="Edit"><i
                                                                    class="fa fa-pencil"></i>
                                                            </a> --}}
                                                            {{-- update model start--}}
                                                            


                                                            <form
                                                                action="{{ route('staffpincode1.destroy', $pin->id) }}"
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
                                                    {{-- <td>#001</td>
                                                    <td>Blue</td>
                                                    <td>
                                                        Z01
                                                    </td>
                                                    <td>600001</td>
                                                    <td>Chennai GPO </td>
                                                    <td>Chennai GPO </td>
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
                                                    <td><span> <a href="#" class="badge badge-secondary px-2"
                                                                data-bs-toggle="modal" data-original-title="test"
                                                                data-bs-target="#"data-original-title="Edit"><i
                                                                    class="fa fa-pencil"></i> </a>
                                                            <a href=""
                                                                onclick="return confirm('Are you sure, you want to delete it?')"
                                                                class="badge badge-warning px-2" data-toggle="tooltip"
                                                                data-placement="top" title=""
                                                                data-original-title="Delete"><i
                                                                    class="fa fa-trash"></i></a></span></td> --}}

                                                </tr>
                                            @endforeach
                                        @endif
                                            {{-- <tr>
                                                <td>#002</td>
                                                <td>Blue</td>
                                                <td>
                                                    Z01
                                                </td>


                                                <td>600002</td>
                                                <td>Anna Road GPO </td>
                                                <td>CHENNAI CITY CENTRAL</td>
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
                                                    <span>
                                                        <a href="#" class="badge badge-secondary px-2"
                                                            data-bs-toggle="modal" data-original-title="test"
                                                            data-bs-target="#exampleModal"data-original-title="Edit"><i
                                                                class="fa fa-pencil"></i> </a>
                                                        <a href="#"
                                                            onclick="return confirm('Are you sure, you want to delete it?')"
                                                            class="badge badge-warning px-2" data-toggle="tooltip"
                                                            data-placement="top" title=""
                                                            data-original-title="Delete"><i class="fa fa-trash"></i>
                                                        </a>
                                                    </span>
                                                </td>
                                            </tr> --}}
                                        </tbody>
                                    </table>

                                    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title f-w-600" id="exampleModalLabel">Update Pincode</h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    {{-- <form class="" method="post" action="{{ route('pincode1.update', $pin->id) }}" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT') --}}

                                                       
                                                        <div class="form">
                                                            <div class="form-group">
                                                                <label for="validationCustom02" class="mb-1">Zone</label>
                                                                <select class="custom-select w-100 form-control"
                                                                    required="true" id="editzone_id" name="editzone_id">
                                                                    <option value="">--Select Zone--</option>
                                                                    @foreach($zone as $zo)
                                                                        <option value="{{$zo->id}}">{{$zo->name}}</option>
                                                                    @endforeach  
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <input type="hidden" id="pincodee_id" name="pincodee_id">

                                                                <label for="validationCustom02"
                                                                    class="mb-1">Pincode</label>
                                                                <input class="form-control" id="editpincode" name="editpincode" required=""  type="text">
                                                                <small id="editpincode_err" class="text-danger fw-bold d-block mt-1"></small>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="validationCustom01" class="mb-1">Area</label>
                                                                <input class="form-control" id="editarea" name="editarea" required=""
                                                                    type="text">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="validationCustom02" class="mb-1">Postal Region
                                                                    :</label>
                                                                <input class="form-control" require="" id="editpost_regin" name="editpost_regin" type="text">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="validationCustom01"
                                                                    class="mb-1">Status</label>
                                                                <select class="custom-select w-100 form-control"
                                                                    required="" id="editstatus" name="editstatus">


                                                                    <option value="1">Active</option>
                                                                    <option value="0">Inactive</option>

                                                                </select>

                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button class="btn btn-primary" type="submit" id="update_pincode">Update</button>
                                                            <button class="btn btn-secondary" type="button"
                                                                data-bs-dismiss="modal">Close</button>
                                                        </div>

                                                    {{-- </form> --}}
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    {{-- update moedel end --}}
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<style>
.swal2-popup {
    font-size: 1.6rem !important;
}
</style>
<script>
$(document).ready(function() {
    // Status Toggle
    $(document).on('change', '.toggle-status', function() {
        var status = $(this).prop('checked') ? 1 : 0;
        var id = $(this).data('id');
        var checkbox = $(this);

        $.ajax({
            type: "POST",
            dataType: "json",
            url: "{{ route('staffpincode1.changestatus') }}",
            data: {'status': status, 'id': id, '_token': '{{ csrf_token() }}'},
            success: function(data) {
                // Instantly changed
            },
            error: function() {
                checkbox.prop('checked', !status);
                Swal.fire('Error!', 'Something went wrong.', 'error');
            }
        });
    });

    // Delete Confirmation
    $(document).on('submit', 'form', function(e) {
        if($(this).find('input[name="_method"][value="DELETE"]').length > 0) {
            e.preventDefault();
            var form = this;
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete this pincode! This cannot be undone.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        }
    });

    // Edit Pincode
    $(document).on('click', '.edit_pincode', function(e){
        e.preventDefault();
        var pin_id = $(this).val();
        $('#exampleModal1').modal('show');
        $.ajax({
            url: "{{ url('staff/pincode1') }}/"+pin_id+"/edit",          
            type: "get",
            dataType: 'json',
            success: function (response) {
                if(response.status == 404) {
                    $('#successmessage').html('').addClass('alert alert-danger').text(response.message);
                } else {
                    $('#editzone_id').val(response.pincodee.zonal_id);
                    $('#editpincode').val(response.pincodee.name);
                    $('#editarea').val(response.pincodee.area);
                    $('#editpost_regin').val(response.pincodee.post_region);
                    $('#editstatus').val(response.pincodee.status);
                    $('#pincodee_id').val(pin_id);
                }
            }
        });
    });

    // Update Pincode
    $(document).on('click', '#update_pincode', function(e){
        e.preventDefault();
        var updateid = $('#pincodee_id').val();
        var zonal_id = $('#editzone_id').val();
        var name = $('#editpincode').val();
        var area = $('#editarea').val();
        var post_region = $('#editpost_regin').val();
        var status = $('#editstatus').val();

        var url = "{{route('staffpincode1.update', ':updateid')}}";
        url = url.replace(':updateid', updateid);
        $.ajax({
            url: url,
            type: "PUT",
            data: {
                _token: `{{csrf_token()}}`,
                zonal_id: zonal_id,
                name: name,
                area: area,
                post_region: post_region,
                status: status
            },
            dataType: 'json',
            success: function (response) {
                if (response.status == 200) {
                    $('#exampleModal1').modal('hide');
                    location.reload();
                } else {
                    Swal.fire('Error!', response.message || 'Pincode already exists!', 'error');
                }
            },
            error: function (xhr) {
                var msg = 'Something went wrong.';
                if (xhr.responseJSON && xhr.responseJSON.message) {
                    msg = xhr.responseJSON.message;
                }
                Swal.fire('Error!', msg, 'error');
            }
        });
    });

    // Real-time duplicate check
    $('#pincode').on('input blur', function() {
        var val = $(this).val().trim();
        if (!val) {
            $('#pincode_err').text('');
            $('#add_pincode_btn').prop('disabled', false);
            return;
        }
        $.ajax({
            type: 'POST',
            url: "{{ route('staffpincode1.checkduplicate') }}",
            data: { pincode: val, _token: '{{ csrf_token() }}' },
            success: function(res) {
                if (res.exists) {
                    $('#pincode_err').text(res.message);
                    $('#add_pincode_btn').prop('disabled', true);
                } else {
                    $('#pincode_err').text('');
                    $('#add_pincode_btn').prop('disabled', false);
                }
            }
        });
    });

    $('#editpincode').on('input blur', function() {
        var val = $(this).val().trim();
        var id = $('#pincodee_id').val();
        if (!val) {
            $('#editpincode_err').text('');
            $('#update_pincode').prop('disabled', false);
            return;
        }
        $.ajax({
            type: 'POST',
            url: "{{ route('staffpincode1.checkduplicate') }}",
            data: { pincode: val, id: id, _token: '{{ csrf_token() }}' },
            success: function(res) {
                if (res.exists) {
                    $('#editpincode_err').text(res.message);
                    $('#update_pincode').prop('disabled', true);
                } else {
                    $('#editpincode_err').text('');
                    $('#update_pincode').prop('disabled', false);
                }
            }
        });
    });
});
</script>
@endpush

