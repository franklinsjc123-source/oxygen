@extends('layout.auth.master')
@section('contents')


    <!-- page-wrapper Start-->
    @include('paritials.auth.topmenu');
    <!-- Page Header Ends -->

    <!-- Page Body Start-->
    <div class="page-body-wrapper">

        <!-- Page Sidebar Start-->
        @include('paritials.auth.sidemenu');

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
                                <h3>Product Collection

                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item active">Product Collection</li>
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
                                    Product Collection</button>

                                <div class="btn-popup pull-right">
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                        data-backdrop="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title f-w-600" id="exampleModalLabel">Product
                                                        Collection</h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="" method="post"
                                                        action="{{ route('productcollection.master.store') }}"
                                                        enctype="multipart/form-data"
                                                        onsubmit="return confirm('Are you sure, you want to Save it?')">
                                                        @csrf
                                                        <div class="form">
                                                            <div class="form-group">
                                                                <label for="validationCustom01" class="mb-1">Product Tag
                                                                </label>
                                                                <input class="form-control" id="" name="name"
                                                                    type="text" required="true">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="validationCustom02" class="mb-1">Tag Image
                                                                </label>
                                                                <input class="form-control" name="image" require=""
                                                                    type="file">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="validationCustom01"
                                                                    class="mb-1">Status</label>
                                                                <select class="custom-select w-100 form-control"
                                                                    name="status" required="">
                                                                    <option value="1">Active</option>
                                                                    <option value="0">Inactive</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-primary" type="submit">Save</button>
                                                            <button class="btn btn-secondary" type="button"
                                                                data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- Edit modal --}}
                                <div class="btn-popup pull-right">
                                    <div class="modal fade" id="editexampleModal" tabindex="-1" role="dialog"
                                        data-backdrop="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title f-w-600" id="editexampleModalLabel">Product
                                                        Collection</h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="" id ="updatepro" method="post"
                                                        
                                                        onsubmit="return confirm('Are you sure, you want to update it?')">
                                                        @csrf
                                                        <div class="form">
                                                            <input type="hidden" id = pro_id name = pro_id value ="">
                                                            <div class="form-group">
                                                                <label for="validationCustom01" class="mb-1">Product Tag
                                                                </label>
                                                                <input class="form-control" id="editname" name="editname"
                                                                    type="text" required="true">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="validationCustom02" class="mb-1">Tag Image
                                                                </label>
                                                                <input class="form-control" id="editimage" name="editimage" require=""
                                                                    type="file">
                                                                    <input class="form-control" name="oldeditimage" id="oldeditimage"
                                                                        type="hidden" value="" accept="image/*"> 
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="validationCustom01"
                                                                    class="mb-1">Status</label>
                                                                <select class="custom-select w-100 form-control"
                                                                    id="editstatus" name="editstatus" required="">
                                                                    <option value="1">Active</option>
                                                                    <option value="0">Inactive</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <button class="btn btn-primary" type="submit">Update</button>
                                                            <button class="btn btn-secondary" type="button"
                                                                data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                {{-- End --}}
                            </div>

                            <div class="datatable-dashv1-list custom-datatable-overright">
                                <table class="table" id="table" data-click-to-select="true" data-sort-name="id"
                                    data-sort-order="asc" data-mobile-responsive="true" data-toggle="table"
                                    data-show-columns="true" data-sort="true" data-pagination="true" data-search="true"
                                    data-show-refresh="true" data-key-events="true" data-resizable="true" data-cookie="true"
                                    data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                    <thead>
                                        <tr>
                                            <th data-field="id" data-sortable="true">Id</th>
                                            <th data-field="image" data-sortable="true">Image</th>
                                            <th data-field="collection" data-sortable="true">Product Collection</th>


                                            <th data-field="status" data-sortable="true">Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($productcollection as $productcollection)
                                            <tr>
                                                <td>{{ str_pad($loop->iteration,4,'0',STR_PAD_LEFT); }}</td>
                                                <td>
                                                    <div class="d-flex">
                                                        <img src="{{ asset('assets/images/productcollection') . '/' . $productcollection->image }}"
                                                            alt=""
                                                            class="img-fluid img-40 me-2 blur-up lazyloaded">
                                                    </div>
                                                </td>
                                                <td style="width:100%;">
                                                    {{ $productcollection->name }}
                                                </td>
                                                </td>
                                                <td>
                                                    <label class="switch">
                                                        {{-- $status = $pin->status --}}
                                                        
                                                         @if($productcollection->status  == 1){
                                                         <input type="checkbox"
                                                             onclick="return confirm('you want to Change it?  Please Click Edit Button')"
                                                             checked id="togBtn">
                                                         }@else{
                                                             <input type="checkbox"
                                                             onclick="return confirm('you want to Change it?  Please Click Edit Button')" 
                                                              id="togBtn">
                                                         }
                                                         @endif
                                                         <div class="slider round">
                                                             <!--ADDED HTML -->
                                                             <span class="on">Active</span>
                                                             <span class="off">Inactive </span>                                                                
                                                             <!--END-->
                                                         </div>
                                                     </label>
                                                </td>
                                                <td><span class="d-flex">
                                                    <button type="button" class="edit_pro_col btn btn-secondary mx-1" value="{{ $productcollection->id }}">
                                                        <i class="fa fa-pencil"></i></button>
                                                     @if (session()->get('log_type') == 'Admin')
														 <form
                                                        action="{{ route('productcollection.master.destroy', $productcollection->id) }}"
                                                        method="post">
                                                        @method('DELETE')
                                                        @csrf
                                                        <button type="submit" class="btn btn-warning mx-1"
                                                            onclick="return confirm('Are you sure, you want to delete it?')"><i
                                                                class="fa fa-trash"></i>
                                                        </button>
                                                    </form>
													@endif
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

        $(document).on('click','.edit_pro_col', function(e){
              
            e.preventDefault();
            var cate_id = $(this).val();
          //  alert(cate_id);
            //    console.log(pin_id);
            $('#editexampleModal').modal('show');
            var url ="{{route('productcollection.master.edit', ":cate_id")}}";
                url = url.replace(":cate_id", cate_id);
            $.ajax({
             
                  url:url,       
                  type: "get",
                  dataType: 'json',
                  success: function (response) {
                       console.log(response);
                     //alert(response);
                        if(response.status == 404)
                        {
                        //  alert('test');
                        $('successmessage').html('');
                        $('successmessage').addClass('alert alert-danger');
                        $('successmessage').text(response.message);
                        }
                        else{
                            $('#pro_id').val(response.productcollection.id);
                            $('#editname').val(response.productcollection.name);
                            $('#editstatus').val(response.productcollection.status);
                            $('#editimage').val();		
                            $('#oldeditimage').val(response.productcollection.image);
                           
                          
                            // alert(response.category_main.category_main_image);
                        }
             
                        
                 
                    }
                
              });
        
            });
        
        
            /*update category*/
            $(document).on('submit','#updatepro', function(e){
                e.preventDefault();
                 var updatepro_id = $('#pro_id').val();
                // alert(cate_id);
                let editformDate = new FormData($('#updatepro')[0]);
                var url ="{{route('productcollection_update', ":updatepro_id")}}";
        
                url = url.replace(":updatepro_id", updatepro_id);
                $.ajax({
                    url:url,       
                    type:"POST",
                     data: editformDate,
                  //  dataType: 'json',
                    contentType:false,
                    processData:false,
                    success: function (response) {
                    //    alert(response);
                    window.location.reload();
                    }
        
             });
                
            });
                </script>
@endsection
