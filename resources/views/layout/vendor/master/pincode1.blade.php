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
                                <h3>Pincode List

                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="dashboard.php"><i data-feather="home"></i></a></li>
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

                            <div class="card-body">

                                <button type="button" class="btn btn-primary btn-sm" data-bs-toggle="modal"
                                    data-original-title="test" data-bs-target="#exampleModal"><i class="fa fa-plus"></i> Add
                                    Pincode</button>

                                


                                <div class="datatable-dashv1-list custom-datatable-overright">
                                    <table class="table" id="table" data-click-to-select="true"
                                        data-show-columns="true" data-sort-name="id" data-sort-order="asc"
                                        data-mobile-responsive="true" data-toggle="table" data-sort="true"
                                        data-pagination="true" data-search="true" data-show-refresh="true"
                                        data-key-events="true" data-resizable="true" data-cookie="true"
                                        data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                        <thead>
                                            <tr>
                                                <th data-field="id" data-sortable="true">ID</th>

                                                <th data-field="route" data-sortable="true">Route</th>
                                                <th data-field="zone" data-sortable="true">Zone</th>
                                                <th data-field="pincode" data-sortable="true">Pincode</th>
                                                <th data-field="area" data-sortable="true">Area</th>
                                                <th data-field="postal" data-sortable="true">Postal Region</th>

                                                <th data-field="status" data-sortable="true">Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($pincode as $pin)
                                                <tr>
                                                    
                                                    <td>#{{ $loop->iteration }}</td>
                                                    <td>{{ $pin->zonal_id }}</td>
                                                    <td>{{ $pin->route_id }}</td>
                                                    {{-- <td>{{ $pin->pincode }}</td> --}}
                                                    <td>{{ $pin->name }}</td>
                                                    <td>{{ $pin->area }}</td>
                                                    <td>{{ $pin->post_region }}</td>
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
                                                            <a href="" class="btn btn-secondary mx-1"
                                                                data-bs-toggle="modal" data-original-title="test"
                                                                data-bs-target="#exampleModal1"data-original-title="Edit"><i
                                                                    class="fa fa-pencil"></i>
                                                            </a>
                                                            {{-- update model start--}}
                                                            <div class="btn-popup pull-right">
                                                                <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog"
                                                                    aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                    <div class="modal-dialog" role="document">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title f-w-600" id="exampleModalLabel">Update Pincode</h5>
                                                                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                                                    aria-label="Close"><span aria-hidden="true">×</span></button>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <form class="" method="post" action="{{ route('pincode1.update', $pin->id) }}" enctype="multipart/form-data">
                                                                                    @csrf
                                                                                    @method('PUT')

                                                                                    {{-- onsubmit="return confirm('Are you sure, you want to Save it?') --}}
                                                                                    <div class="form">
                                                                                        <div class="form-group">
                                                                                            <select class="custom-select w-100 form-control"
                                                                                                required="true" name="route_id" id="route_id">
                                                                                                <option value="">--Select Route-- </option>
                                                                                                @foreach($data as $d){
                                                                                                    <option value="{{$d->id}}">{{$d->name}}</option>
                                                                                                }
                                                                                                @endforeach 
                                                                                              
                                                                                            </select>
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <select class="custom-select w-100 form-control"
                                                                                                required="true" id="zone_id" name="zone_id">
                                                                                                <option value="">--Select Zone--</option>
                                                                                            </select>
                                                                                        </div>

                                                                                        <div class="form-group">
                                                                                            <label for="validationCustom02"
                                                                                                class="mb-1">Pincode</label>
                                                                                            <input class="form-control" id="pincode" name="pincode" value= "{{$pinc->name}}" required="" type="text">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="validationCustom01" class="mb-1">Area</label>
                                                                                            <input class="form-control" id="area" name="area" value= "{{$pinc->area}}" required=""
                                                                                                type="text">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="validationCustom02" class="mb-1">Postal Region
                                                                                                :</label>
                                                                                            <input class="form-control" require="" id="post_regin" name="post_regin" value= "{{$pinc->post_region}}" type="text">
                                                                                        </div>
                                                                                        <div class="form-group">
                                                                                            <label for="validationCustom01"
                                                                                                class="mb-1">Status</label>
                                                                                            <select class="custom-select w-100 form-control"
                                                                                                required="" id="status" value= "{{$pinc->status}}" name="status">


                                                                                                <option value="1">Active</option>
                                                                                                <option value="0">Inactive</option>

                                                                                            </select>

                                                                                        </div>
                                                                                    </div>

                                                                                    <div class="modal-footer">
                                                                                        <button class="btn btn-primary" class="submit"
                                                                                            type="submit">Update</button>
                                                                                        <button class="btn btn-secondary" type="button"
                                                                                            data-bs-dismiss="modal">Close</button>
                                                                                    </div>

                                                                                </form>
                                                                            </div>
                                                                            
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            {{-- update moedel end --}}


                                                            <form
                                                                action="{{ route('pincode1.destroy', $pin->id) }}"
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
        </div>
        <!-- Container-fluid Ends-->
    </div>
@endsection
@push('scripts')
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
                        $('#zone_id').val(data);
                    }
                    ajaxPost(formData, url, successCallBack, null);
                }
            }
        });


        $('#route_id').change(function() {
            let route_id = $(this).val();
            let url = '{{ route('getZonal') }}?route_id=' + route_id;
            let method = 'GET';

            getAjaxValue(url, method, function(data) {
                $('#zone_id').empty();

                $.each(data, function(key, zone) {
                    $('#zone_id').append(
                        `<option value="${zone.id}" selected>${zone.name}</option>`
                    );
                });
            })
        });
    </script>
@endpush
