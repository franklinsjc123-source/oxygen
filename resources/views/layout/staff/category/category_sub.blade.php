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
                                <h3>Sub Category

                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="dashboard.php"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item active">Sub Category</li>
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
                                    sub Category</button>

                                <div class="btn-popup pull-right">
                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title f-w-600" id="exampleModalLabel">Add Product sub
                                                        Category</h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="" method="post"
                                                        action="{{ route('category.sub.store') }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form">
                                                            <div class="form-group">
                                                                <label for="validationCustom01" class="mb-1">Select Main
                                                                    Category :</label>
                                                                <select class="custom-select w-100 form-control"
                                                                    name="main_category_id" required id="main_category">
                                                                    <option value="" selected hidden>Select Main
                                                                        Category</option>
                                                                    @foreach ($category_main as $main_category)
                                                                        <option value="{{ $main_category->id }}">
                                                                            {{ $main_category->category_main_name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="validationCustom01" class="mb-1">Select
                                                                    Category :</label>
                                                                <select class="custom-select w-100 form-control"
                                                                    name="category_id" id="category_id">
                                                                    <option value="" selected hidden>Select
                                                                        Category</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="validationCustom01" class="mb-1">Sub Category
                                                                    :</label>
                                                                <input class="form-control" name="sub_category_name"
                                                                    id="" required type="text">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="validationCustom02" class="mb-1">Sub Category
                                                                    Image :</label>
                                                                <input class="form-control" name="sub_category_iamge"
                                                                    type="file" accept="image/*" required>
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="validationCustom01"
                                                                    class="mb-1">Status</label>
                                                                <select class="custom-select w-100 form-control"
                                                                    name="status" required>
                                                                    <option value="1">Active</option>
                                                                    <option value="0">Inactive</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="category.php"> <button class="btn btn-primary"
                                                                    type="submit">Save</button></a>
                                                            <button class="btn btn-secondary" type="button"
                                                                data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


{{-- EDIT PAGE --}}

                                <div class="btn-popup pull-right">
                                    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title f-w-600" id="exampleModalLabel">Edit Product sub
                                                        Category</h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="" method="post" id="UPDATEFORM"                                                        
                                                        enctype="multipart/form-data">
                                                        <input type="hidden" id="edit_id">
                                                        @csrf
                                                        <div class="form">
                                                            <div class="form-group">
                                                                <label for="validationCustom01" class="mb-1">Select Main
                                                                    Category :</label>
                                                                <select class="custom-select w-100 form-control"
                                                                    name="editmain_category_id" required id="editmain_category_id">
                                                                    <option value="" selected hidden>Select Main
                                                                        Category</option>
                                                                    @foreach ($category_main as $main_category)
                                                                        <option value="{{ $main_category->id }}">
                                                                            {{ $main_category->category_main_name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="validationCustom01" class="mb-1">Select
                                                                    Category :</label>
                                                                     {{-- <input type="hidden" id="editcategory_id" name="editcategory_id">  --}}
                                                                {{-- <select  class="custom-select w-100 form-control"
                                                                    name="editcategory_id" id="editcategory_id">
                                                                    <option value="" selected hidden>Select
                                                                        Category</option>
                                                                        @foreach ($category as $category)
                                                                        <option value="{{ $category->id }}">
                                                                            {{ $category->category_name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select> --}}
                                                                <select class="custom-select w-100 form-control" 
                                                                name="editcategory_id" id="editcategory_id">
                                                                    <option value="" id="editcategoryoption_id" selected hidden>Select
                                                                        Category</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="validationCustom01" class="mb-1">Sub Category
                                                                    :</label>
                                                                <input class="form-control" name="editsub_category_name"
                                                                    id="editsub_category_name" required type="text">
                                                            </div>

                                                            <div class="form-group">
                                                                <label for="validationCustom02" class="mb-1">Sub Category
                                                                    Image :</label>
                                                                <input class="form-control" name="editsub_category_iamge"
                                                                id="editsub_category_iamge" type="file" accept="image/*" >
                                                                <input class="form-control" name="oldeditsub_category_iamge"
                                                                id="oldeditsub_category_iamge" type="hidden" accept="image/*" >
                                                            </div>
                                                            <div class="form-group">
                                                                <label for="validationCustom01"
                                                                    class="mb-1">Status</label>
                                                                <select class="custom-select w-100 form-control"
                                                                    name="editstatus"  id="editstatus" required>
                                                                    <option value="1">Active</option>
                                                                    <option value="0">Inactive</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <a href="category.php"> <button class="btn btn-primary" id="btnupdate"
                                                                    type="submit">Update</button></a>
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
                                                <th data-field="id" data-sortable="true">Id</th>
                                                <th data-field="image" data-sortable="true">Image</th>
                                                <th data-field="maincategory" data-sortable="true">Main Category</th>
                                                <th data-field="category" data-sortable="true">Category</th>
                                                <th data-field="subcategory" data-sortable="true">Sub Category</th>
                                                <th data-field="status" data-sortable="true">Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($sub_category_data as $sub_category)
                                                <tr>
                                                    <td>#{{ $loop->iteration }}</td>
                                                    <td>
                                                        <div class="d-flex">
                                                            <img src="{{ asset('assets/images/categorySub') . '/' . $sub_category->category_sub_image }}"
                                                                alt=""
                                                                class="img-fluid img-30 me-2 blur-up lazyloaded">
                                                        </div>
                                                    </td>

                                                    <td>{{ $sub_category->category_main_name }}  </td>
                                                    <td>{{ $sub_category->category_name }}  </td>
                                                    <td>{{ $sub_category->category_sub_name }}  </td>
                                                    <td>
                                                        <label class="switch">
                                                         @if($sub_category->sc_status  == 1){
                                                                <input type="checkbox"
                                                                    onclick="return confirm('you want to Change it?  Please Click Edit Button')" value="1" active="Active"
                                                                    checked id="togBtn">
                                                                }@else{
                                                                    <input type="checkbox"
                                                                    onclick="return confirm('you want to Change it?  Please Click Edit Button')" value="0"  class="Inactive"
                                                                     id="togBtn">
                                                                }
                                                                @endif 
                                                             {{-- <input type="checkbox"
                                                                onclick="return confirm('Are you sure, you want to Change it?')"
                                                                checked id="togBtn"> --}}
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
                                                            <button type="button" class="edit_Sub_catagory btn btn-secondary mx-1" data-bs-toggle="modal" data-original-title="Edit" value="{{$sub_category->me_id}}" id="edit_Sub_catagory">
                                                                <i class="fa fa-pencil"></i> </button>
                                                            {{-- <a href="#" class="btn btn-secondary mx-1"
                                                                data-bs-toggle="modal" data-original-title="test"
                                                                data-bs-target="#exampleModal"data-original-title="Edit"><i
                                                                    class="fa fa-pencil"></i>
                                                            </a> --}}
                                                            <form
                                                                action="{{ route('category.sub.destroy', $sub_category->me_id) }}"
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
        </div>

        <script>
            // AJAX REQUEST
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


            // Main Categoy Id
            $('#main_category').on('change', function() {
                let main_category_id = $(this).val();
                let url = '{{ route('getCategory') }}?main_category_id=' + main_category_id;
                let method = 'GET';
                getAjaxValue(url, method, function(data) {
                    $('#category_id').empty();

                    $.each(data, function(key, category) {
                        $('#category_id').append(
                            `<option value="${category.id}" selected>${category.category_name}</option>`
                        );
                    });
                });
            });


            $(document).on('click','.edit_Sub_catagory', function(e){
      
      e.preventDefault();
      var cate_id = $(this).val();
    //  alert(cate_id);
      //    console.log(pin_id);
      $('#exampleModal1').modal('show');
      var url ="{{route('category.sub.edit', ":cate_id")}}";
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
                    $('#edit_id').val(response.category_sub.id);
					$('#editmain_category_id').val(response.category_sub.category_main_id);
                    $('#editcategoryoption_id').val(response.category_sub.category_id);
                    $('#editsub_category_name').val(response.category_sub.category_sub_name);
                    $('#oldeditsub_category_iamge').val(response.category_sub.category_sub_image);
                    $('#editstatus').val(response.category_sub.status);
                     // $('#editmain_category_image').val();		
                     //  $('#oldeditmain_category_image').val(response.category_sub.category_main_image);
                     
                    
                      // alert(response.category_main.category_main_image);
                  }
           
              }
          
        });
  
      });


      $('#editmain_category_id').on('change', function() {
                let main_category_id = $(this).val();
                let url = '{{ route('getCategory') }}?main_category_id=' + main_category_id;
                let method = 'GET';
                getAjaxValue(url, method, function(data) {
                    //$('#editcategory_id').empty();

                    $.each(data, function(key, category) {
                        $('#editcategory_id').append(
                            
                            `<option value="${category.id}" selected>${category.category_name}</option>`
                        );
                    });
                });
            });

   


            $(document).on('submit','#UPDATEFORM', function(e){
        e.preventDefault();
         var updatecate_id = $('#edit_id').val();
         alert(updatecate_id);
        let editformDate = new FormData($('#UPDATEFORM')[0]);
        var url ="{{route('subcategory_update', ":updatecate_id")}}";

        url = url.replace(":updatecate_id", updatecate_id);
        $.ajax({
            url:url,       
            type:"POST",
             data: editformDate,
          //  dataType: 'json',
            contentType:false,
            processData:false,
            success: function (response) {
                //alert(response);
                //console.log(response);
            window.location.reload();
            }

     });
        
    });
        </script>
    @endsection
