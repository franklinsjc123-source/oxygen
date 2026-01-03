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
                                <h3>Main Category
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="dashboard.php"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item active">Main Category</li>
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
                                    Category</button>

                                <div class="btn-popup pull-right">
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                        data-backdrop="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title f-w-600" id="exampleModalLabel">Main Category
                                                    </h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true">X</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="" method="post"
                                                        action="{{ route('category.main.store') }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form">
                                                            <div class="form-group">
                                                                <label for="validationCustom01" class="mb-1">Category
                                                                    :</label>
                                                                <input class="form-control" name="main_category_name"
                                                                    id="" type="text" required="true">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="validationCustom02" class="mb-1">Category
                                                                    Image :</label>

                                                                <input class="form-control" name="main_category_image"
                                                                    type="file" accept="image/*">
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="validationCustom01"
                                                                    class="mb-1">Status</label>
                                                                <select class="custom-select w-100 form-control"
                                                                    required="" name="catstatus">
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


                                <div class="datatable-dashv1-list custom-datatable-overright">
                                    <table class="table" id="table" data-click-to-select="true" data-sort-name="id"
                                        data-sort-order="asc" data-mobile-responsive="true" data-toggle="table"
                                        data-show-columns="true" data-sort="true" data-pagination="true" data-search="true"
                                        data-show-refresh="true" data-key-events="true" data-resizable="true"
                                        data-cookie="true" data-show-export="true" data-click-to-select="true"
                                        data-toolbar="#toolbar">
                                        <thead>
                                            <tr>
                                                <th data-field="id" data-sortable="true">Id</th>
                                                <th data-field="image" data-sortable="true">Image</th>
                                                <th data-field="category" data-sortable="true">Category</th>
                                                <th data-field="status" data-sortable="true">Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($category_main as $categories)
                                                <tr>
                                                    <td>#{{ $loop->iteration }}</td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <img src="{{ asset('assets/images/categoryMain') . '/' . $categories->category_main_image }}"
                                                                alt=""
                                                                class="img-fluid img-40 me-2 blur-up lazyloaded">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        {{ $categories->category_main_name }}
                                                    </td>
                                                    <?php
                                                    // dd($categories);
                                                    ?>
                                                    <td>
                                                        <label class="switch">
                                                            {{-- $status = $pin->status --}}
                                                            
                                                             @if($categories->status  == 1){
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

                                                    <td>
                                                        <span class="d-flex">
                                                            <button type="button" class="edit_category_main btn btn-secondary mx-1" value="{{ $categories->id }}">
                                                                <i class="fa fa-pencil"></i></button>
                                                            {{-- <a href="#" class="btn btn-secondary mx-1"
                                                                data-bs-toggle="modal" data-original-title="test"
                                                                data-bs-target="#exampleeditModal"data-original-title="Edit"><i
                                                                    class="fa fa-pencil"></i>
                                                            </a> --}}
                                                            <form
                                                                action="{{ route('category.main.destroy', $categories->id) }}"
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
            <!-- Container-fluid Ends-->


              {{-- edit modal start--}}
              <div class="btn-popup pull-right">
                <div class="modal fade" id="exampleeditModal" tabindex="-1" role="dialog"
                    data-backdrop="false" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title f-w-600" id="exampleeditModalLabel">Main Category
                                </h5>
                                <button class="btn-close" type="button" data-bs-dismiss="modal"
                                    aria-label="Close"><span aria-hidden="true">X</span></button>
                            </div>
                            <div class="modal-body">
                                <form class="" id ="updatecate" method="post" enctype="multipart/form-data">
                                    @csrf
                                    
                                    <div class="form">
                                        <input type="hidden" id = cate_id name = cate_id value ="">
                                        <div class="form-group">
                                            <label for="validationCustom01" class="mb-1">Category
                                                :</label>
                                            <input class="form-control" name="editmain_category_name"
                                                id="editmain_category_name"  type="text" required="true">
                                        </div>
                                        <div class="form-group">
                                            <label for="validationCustom02" class="mb-1">Category
                                                Image :</label>

                                            <input class="form-control" name="editmain_category_image" id="editmain_category_image"
                                                type="file"  accept="image/*">

                                                <input class="form-control" name="oldeditmain_category_image" id="oldeditmain_category_image"
                                                type="hidden"  accept="image/*"> 
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
            {{-- edit model end --}}
        </div>

        <script>

$(document).on('click','.edit_category_main', function(e){
      
    e.preventDefault();
    var cate_id = $(this).val();
  //  alert(cate_id);
    //    console.log(pin_id);
    $('#exampleeditModal').modal('show');
    var url ="{{route('category.main.edit', ":cate_id")}}";
        url = url.replace(":cate_id", cate_id);
    $.ajax({
     
          url:url,       
          type: "get",
          dataType: 'json',
          success: function (response) {
              // console.log(response);
             //alert(response);
                if(response.status == 404)
                {
                //  alert('test');
                $('successmessage').html('');
                $('successmessage').addClass('alert alert-danger');
                $('successmessage').text(response.message);
                }
                else{
                    $('#editmain_category_name').val(response.category_main.category_main_name);
                  //alert(response.category_main.category_main_name);
                  $('#cate_id').val(cate_id);
					// var sts = response.category_main.status;
					//  //alert(sts);
					// if(sts == 49)
					// {
					// 	$('#editstatus').val(1);

					// }
					// else{
					// 	$('#editstatus').val(0);
					// }
                    $('#editstatus').val(response.category_main.status);
                    $('#editmain_category_image').val();		
					 $('#oldeditmain_category_image').val(response.category_main.category_main_image);
                   
                  
                    // alert(response.category_main.category_main_image);
                }
     
                
         
            }
        
      });

    });


    /*update category*/
    $(document).on('submit','#updatecate', function(e){
        e.preventDefault();
         var updatecate_id = $('#cate_id').val();
        // alert(cate_id);
        let editformDate = new FormData($('#updatecate')[0]);
        var url ="{{route('category_main_update', ":updatecate_id")}}";

        url = url.replace(":updatecate_id", updatecate_id);
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
