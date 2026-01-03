@extends('layout.auth.master')
@section('contents')
    @include('paritials.auth.header')?>

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
                                                    <h5 class="modal-title f-w-600" id="exampleModalLabel">Add Department</h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="" method="post" action="{{ route('staffDepartmentssave') }}"
                                                        id="form">
                                                        @csrf
                                                        <div class="form">


                                                            <div class="form-group">
                                                                <label for="validationCustom01" class="mb-1">Department
                                                                    :</label>
                                                                <input class="form-control" id="name" name="name" type="text"
                                                                    required="true">
                                                            </div>
															 {{-- <input type="hidden" name="departmentId" value="-1" />
                                                        <input type="hidden" name="createdBy"
                                                            value="{{ session()->get('userId') }}" /> --}}

                                                            <div class="form-group">
                                                                <label for="validationCustom01" 
                                                                    class="mb-1">Status</label>
                                                                <select class="custom-select w-100 form-control" name="status" id="status"
                                                                    >


                                                                    <option value="1">Active</option>
                                                                    <option value="0">Inactive</option>

                                                                </select>

                                                            </div>
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-primary" id="Save" type="submit">Save</button>
                                                    <button class="btn btn-secondary" type="button"
                                                        data-bs-dismiss="modal">Close</button>
                                                </div>

                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="btn-popup pull-right">

                                    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog"
                                        data-backdrop="false" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title f-w-600" id="exampleModalLabel1">Edit Department</h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="" method="post"
                                                        id="form">
                                                        <div class="form">
                                                            <input class="form-control" id="editid" name="editid" type="hidden"
                                                            required="true">

                                                            <div class="form-group">
                                                                <label for="validationCustom01" class="mb-1">Department
                                                                    :</label>
                                                                <input class="form-control" id="editname" name="editname" type="text"
                                                                    required="true">
                                                            </div>
															 {{-- <input type="hidden" name="departmentId" value="-1" />
                                                        <input type="hidden" name="createdBy"
                                                            value="{{ session()->get('userId') }}" /> --}}

                                                            <div class="form-group">
                                                                <label for="validationCustom01" 
                                                                    class="mb-1">Status</label>
                                                                <select class="custom-select w-100 form-control" name="editstatus" id="editstatus"
                                                                    required="">

                                                                    <option value="1">Active</option>
                                                                    <option value="0">Inactive</option>

                                                                </select>

                                                            </div>
                                                        </div>

                                                </div>
                                                <div class="modal-footer">
                                                    <button class="btn btn-primary" id="btnupdate" type="submit">Update</button>
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
                                                            @if($department->status  == 1){
                                                                <input type="checkbox"
                                                                    onclick="return confirm('you want to Change it?  Please Click Edit Button')"
                                                                    checked id="togBtn">
                                                                }@else{
                                                                    <input type="checkbox"
                                                                    onclick="return confirm('you want to Change it?  Please Click Edit Button')" 
                                                                     id="togBtn">
                                                                }
                                                                @endif
                                                            {{-- <input type="checkbox"
                                                                onclick="return confirm('Are you sure, you want to Change it?')"
                                                                checked id="togBtn"> --}}
                                                            <div class="slider round">
                                                               
                                                                    <span class="off">Inactive </span>
                                                               
                                                                    <span class="on">Active</span>
                                                                
                                                                <!--ADDED HTML -->


                                                                <!--END-->
                                                            </div>
                                                        </label>
                                                    </td>

                                                    <td><span class="d-flex"> 
                                                        <button type="button" class="edit_department btn btn-secondary mx-1" value="{{$department->id}}">
                                                            <i class="fa fa-pencil"></i></button>

                                                        {{-- <a href="#" class="badge badge-secondary px-2"
                                                                data-bs-toggle="modal" data-original-title="test"
                                                                data-bs-target="#exampleModal1"data-original-title="Edit"><i
                                                                    class="fa fa-pencil"></i> </a> --}}
                                                                    <form
                                                                    action="{{ route('staffdepartmentdelete', $department->id) }}"
                                                                    method="post">
                                                                    @method('POST')
                                                                    @csrf
                                                                    <button type="submit" class="btn btn-warning mx-1" value="{{$department->id}}"
                                                                        onclick="return confirm('Are you sure, you want to delete it?')"><i
                                                                            class="fa fa-trash"></i>
                                                                    </button>
                                                                </form>


                                                            {{-- <a href="#"
                                                                onclick="return confirm('Are you sure, you want to delete it?')"
                                                                class="badge badge-warning px-2" data-toggle="tooltip"
                                                                data-placement="top" title=""
                                                                data-original-title="Delete"><i
                                                                    class="fa fa-trash"></i></a> --}}
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
@endsection
@push('scripts')
        <script>
            $(function() {
                var validation_option = getValidationOptions({
                    rules: {
                        name: {
                            required: true,
                            remote: {
                                url: "{{ route('staffcheckDepartmentnamePost') }}",
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
                        var url = "{{ route('staffDepartmentssave') }}";
                        var successCallBack = function successCallBack(data) {
                            loadJsonToHtml(data);
                        }
                        ajaxPost(formData, url, successCallBack, null);
                    }
                }
            });




            
    $(document).on('click','.edit_department', function(e){
        var editroute1='';
        var htmlPlan='';
    e.preventDefault();
    var id = $(this).val();
    //    console.log(pin_id);
    $('#exampleModal1').modal('show');

    //console.log ($id)
    $.ajax({
        //   data: $('').serialize(),  {{ url('admin/pincode1') }}/"+pin_id+"/edit"
          url: "{{ url('staff/editdepartment') }}/"+id+"/edit",          
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
                    $('#editid').val(response.editdepartment.id);
                    $('#editname').val(response.editdepartment.name);
                    $('#editstatus').val(response.editdepartment.status);
                }  
            }
        
      });
    




    });

    $(document).on('click','#btnupdate', function(e){
       //alert('test');

         e.preventDefault(e);
    var id = $('#editid').val();
     //alert(id);


    
    var name = $('#editname').val();
    var status = $('#editstatus').val();
    
        //alert ( name);
   
  //  var url ="{{route('zonalupdate', ":updateid")}}";
   // url = url.replace(":updateid", updateid);
    $.ajax({
        //   data: $('').serialize(),    {{ url('admin/zonalupdate') }}/"+id+"/update"
             // url: "{{ url('admin/zonalupdate') }}/"+updateid,
              //console.log(id);
         url: "{{ url('staff/departmentupdate') }}/"+id+"/update", 
         type: "POST",
          data: {_token : `{{csrf_token()}}`,
            name:name,
            status:status
        },
         dataType: 'html',
          success: function (response) {
               //console.log(response);

               $('#exampleModal1').modal('hide');
               location.reload();   
                
         
            }
        
      });
    });
        </script>
    @endpush
