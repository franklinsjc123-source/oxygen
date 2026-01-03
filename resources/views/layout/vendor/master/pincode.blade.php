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

                                    <div id="successmessage">
                                    </div>
                                <div class="btn-popup pull-right">
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title f-w-600" id="exampleModalLabel">Add Pincode</h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="" method="post" action="{{ route('pincode1.store') }}" enctype="multipart/form-data">
                                                        @csrf
                                                        {{-- onsubmit="return confirm('Are you sure, you want to Save it?') --}}
                                                        <div class="form">
                                                            <div class="form-group">
                                                                <select class="custom-select w-100 form-control"
                                                                    required="true" name="route_id" id="route_id">
                                                                    <option value="">--Select Route-- </option>
                                                                    @foreach($rdata as $d){
                                                                        <option value="{{$d->id}}">{{$d->name}}</option>
                                                                    }
                                                                    @endforeach 
                                                                    {{-- {!! $data->routeList !!} --}}
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <select class="custom-select w-100 form-control"
                                                                    required="true" id="zone_id" name="zonal_id">
                                                                    <option value="">--Select Zone--</option>
                                                                    
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="validationCustom02"
                                                                    class="mb-1">Pincode</label>
                                                                <input class="form-control" id="pincode" name="pincode" required="" type="text">
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


                                                                    <option value="1">Active</option>
                                                                    <option value="0">Inactive</option>

                                                                </select>

                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">
                                                            <button class="btn btn-primary" class="submit"
                                                                type="submit">Save</button>
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
@if($pincode)
                                            @foreach ($pincode as $pin)
                                                <tr>
                                                    
                                                    <td>#{{ $loop->iteration }}</td>
                                                    {{-- <td>{{ $pin->zonal_id }}</td> --}}
                                                    <td>{{ $pin->routename }}</td>
                                                    <td>{{ $pin->zonalname }}</td>
                                                    {{-- <td>{{ $pin->route_id }}</td> --}}
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
                                                            <button type="button" value="{{$pin->id}}" class="edit_pincode btn btn-secondary mx-1"> <i
                                                                class="fa fa-pencil"></i></button>
                                                            {{-- <a href="{{ route('pincode1.edit', $pin->id) }}" class="btn btn-secondary mx-1"
                                                                data-bs-toggle="modal" data-original-title="test"
                                                                data-bs-target=""data-original-title="Edit"><i
                                                                    class="fa fa-pencil"></i>
                                                            </a> --}}
                                                            {{-- update model start--}}
                                                            


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
                                                        {{-- <form class="" method="post" action="{{ route('pincode1.update', $pin->id) }}" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT') --}}

                                                           
                                                            <div class="form">
                                                                <div class="form-group">
                                                                    <select class="custom-select w-100 form-control"
                                                                        required="true" name="editroute_id" id="editroute_id">
                                                                        <option value="">--Select Route-- </option>
                                                                        @foreach($rdata as $d){
                                                                            <option value="{{$d->id}}">{{$d->name}}</option>
                                                                        }
                                                                        @endforeach 
                                                                      
                                                                    </select>
                                                                </div>
                                                                <div class="form-group">
                                                                    <select class="custom-select w-100 form-control"
                                                                        required="true" id="editzone_id" name="editzone_id">
                                                                        <option value="">--Select Zone--</option>
                                                                        {{-- @foreach($zone as $zo){
                                                                            <option value="{{$zo->id}}">{{$zo->name}}</option>
                                                                        }
                                                                        @endforeach  --}}
                                                                    </select>
                                                                </div>

                                                                <div class="form-group">
                                                                    <input type="hidden" id=pincodee_id name=pincodee_id>

                                                                    <label for="validationCustom02"
                                                                        class="mb-1">Pincode</label>
                                                                    <input class="form-control" id="editpincode" name="editpincode" required=""  type="text">
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
<script>

            // function makeArray(value) {
            // return editroute.map(function(a) {
            //     return {[value]: a[value]};
            // });
            // }




    $(document).on('click','.edit_pincode', function(e){
        var editroute1='';
        var htmlPlan='';
    e.preventDefault();
    var pin_id = $(this).val();
    //    console.log(pin_id);
    $('#exampleModal1').modal('show');
    $.ajax({
        //   data: $('').serialize(),
          url: "{{ url('admin/pincode1') }}/"+pin_id+"/edit",          
          type: "get",
          dataType: 'json',
          success: function (response) {
              // console.log(response);
            // alert('test');
                if(response.status == 404)
                {
                // alert('test');
                $('successmessage').html('');
                $('successmessage').addClass('alert alert-danger');
                $('successmessage').text(response.message);
                }
                else{
                    $('#editroute_id').val(response.pincodee.route_id);
                    $('#editzone_id').val(response.pincodee.zonal_id);
                    $('#editpincode').val(response.pincodee.name);
                    $('#editarea').val(response.pincodee.area);
                    $('#editpost_regin').val(response.pincodee.post_region);
                    $('#editstatus').val(response.pincodee.status);
                    $('#pincodee_id').val(pin_id);
                    
                    var editroute_id = response.pincodee.route_id;
                    //alert(editroute_id);
                    var editzone_id = response.pincodee.zonal_id;
                    //alert(editzone_id);
                    
                    var editzonal = JSON.stringify(response.editzonal);
                    var editzonal1 = JSON.parse(editzonal);
                   // console.log(editzonal1['0'].id);
                   //console.log(editzonal1['1'].name);

                //     for (var i = 0; i < editroute.length; i++) {
                //             console.log(editroute[i]['id']);
                //         }
                //    // var myarray= JSON.parse(editroute);
                        // alert(editroute['7']);
                        // alert(editroute.length);

                    // var labels = makeArray('editroute');


                    // alert(labels);

                    //alert(editroute);
                    //var editzonal = response.editzonal;
                     //alert(editzonal);

                    // for(let x = 0;x < editzonal1.length;x++){
                    //    //console.log(editzonal1[x].id)
                    //     if(editzone_id == editzonal1[x].id){
                    //         htmlPlan += `<option value="`+editzonal1[x].id+`" selected>`+editzonal1[x].name+`</option>`;
                    //     }
                    //     else{
                    //         htmlPlan += `<option value="`+editzonal1[x].id+`">`+editzonal1[x].name+`</option>`;
                    //     }
                    // }
                    // $("#editzone_id").html(htmlPlan);


                }
     
                
         
            }
        
      });

    });
   
    </script>
    {{-- update --}}
    <script>
     $(document).on('click','#update_pincode', function(e){
       //alert('test');

         e.preventDefault(e);
    var updateid = $('#pincodee_id').val();
    // alert(updatepin_id);


    var route_id = $('#editroute_id').val();
    var zonal_id = $('#editzone_id').val();
    var name = $('#editpincode').val();
    var  area = $('#editarea').val();
    var post_region = $('#editpost_regin').val();
    var  status = $('#editstatus').val();
    

    // alert(route_id);
    // alert(zone_id);
    // alert(name);
    // alert(area);
    // alert(post_region);
    // alert(status);
    var url ="{{route('pincode1.update', ":updateid")}}";
    url = url.replace(":updateid", updateid);
    $.ajax({
        //   data: $('').serialize(),
            //  url: "{{ url('admin/pincode1/update') }}/"+updatepin_id,
            


            url:url,
          
          type: "PUT",
          data: {_token : `{{csrf_token()}}`, route_id:route_id,zonal_id:zonal_id,name:name,area:area,post_region:post_region,status:status},
         dataType: 'html',
          success: function (response) {
               //console.log(response);

               $('#exampleModal1').modal('hide');
               location.reload();
            //    $('#table').text(response.html);
            // // alert('test');
            //     if(response.status == 404)
            //     {
            //     // alert('test');
            //     $('successmessage').html('');
            //     $('successmessage').addClass('alert alert-danger');
            //     $('successmessage').text(response.message);
            //     }
            //     else{
            //         $('#editroute_id').val(response.pincodee.route_id);
            //         $('#editzone_id').val(response.pincodee.zonal_id);
            //         $('#editpincode').val(response.pincodee.name);
            //         $('#editarea').val(response.pincodee.area);
            //         $('#editpost_regin').val(response.pincodee.post_region);
            //         $('#editstatus').val(response.pincodee.status);
            //         $('#pincodee_id').val(pin_id);

            //     }
     
                
         
            }
        
      });
    

    });
        </script>
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
        $('#editroute_id').change(function() {
            let route_id = $(this).val();
            // alert(route_id);
            let url = '{{ route('getZonal') }}?route_id=' + route_id;
            // alert(url);
            let method = 'GET';

            getAjaxValue(url, method, function(data) {
                
                $('#editzone_id').empty();

                $.each(data, function(key, zone) {
                   
                    $('#editzone_id').append(
                        `<option value="${zone.id}" selected>${zone.name}</option>`
                    );
                });
            })
        });
       
        
    </script>
@endpush
