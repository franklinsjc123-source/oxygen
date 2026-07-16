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
        <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
        <style>
            #exampleModal1 .select2-container--default .select2-selection--multiple {
                min-height: 42px;
                border: 1px solid #ced4da;
                background-color: #fff;
            }
            #exampleModal1 .select2-container--default .select2-selection--multiple .select2-selection__rendered {
                display: block !important;
                padding: 4px 6px;
                white-space: normal !important;
            }
            #exampleModal1 .select2-container--default .select2-selection--multiple .select2-selection__choice {
                display: inline-block !important;
                background: #e9f2ff !important;
                border: 1px solid #9ec1ff !important;
                color: #1f2937 !important;
                padding: 2px 8px !important;
                margin-top: 4px !important;
                margin-right: 6px !important;
                border-radius: 12px !important;
            }
        </style>


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
                                <li class="breadcrumb-item"><a href="{{ url('staff/dashboard/'.session()->get('login_id')) }}"><i data-feather="home"></i></a></li>
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

                                    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title f-w-600" id="exampleModalLabel">Add Product sub
                                                        Category</h5>
                                                    <button class="btn-close" type="button" data-bs-dismiss="modal"
                                                        aria-label="Close"><span aria-hidden="true">×</span></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form class="" method="post"
                                                        action="{{ route('staffcategory.sub.store') }}"
                                                        enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="form row">
                                                            <div class="form-group col-6">
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

                                                            <div class="form-group col-6">
                                                                <label for="validationCustom01" class="mb-1">Select
                                                                    Category :</label>
                                                                <select class="custom-select w-100 form-control"
                                                                    name="category_id" id="category_id">
                                                                    <option value="" selected hidden>Select
                                                                        Category</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group  col-12">
                                                                <label for="validationCustom01" class="mb-1">Sub Category
                                                                    :</label>
                                                                <input class="form-control" name="sub_category_name"
                                                                    id="" required type="text">
                                                            </div>

                                                            <div class="form-group  col-6">
                                                                <label for="validationCustom02" class="mb-1">Sub Category
                                                                    Image :</label>
                                                                <input class="form-control" name="sub_category_iamge"
                                                                    type="file" accept="image/*" required>
                                                            </div>
                                                            <div class="form-group  col-6">
                                                                <label for="validationCustom01" class="mb-1">Sort Order
                                                                    :</label>
                                                                <input class="form-control" name="sub_category_sortorder"
                                                                    id="" type="number" required="true">
                                                            </div>
                                                            <div class="form-group  col-12">
                                                                <label for="validationCustom01" class="mb-1">Meta Keyword / Tags
                                                                    :</label>
                                                                <textarea class="form-control" name="sub_category_keywords"
                                                                    id="" type="text" required="true"></textarea>
                                                            </div>
                                                            <div class="form-group  col-12">
                                                                <label for="validationCustom01" class="mb-1">Attributes
                                                                    :</label>
                                                                    <select class="form-control select2"  name="category_sub_attributes[]" multiple style="width:100%;">
                                                                    @foreach ($attributegroup as $group)
                                                                        <option value="{{ $group->id }}">
                                                                            {{ $group->attribute_group_name }} ( {{ $group->attribute_group_refname }})
                                                                        </option>
                                                                    @endforeach
                                                                    </select>
                                                            </div>
                                                            <div class="form-group  col-12">
                                                                <label for="validationCustom01" class="mb-1">Specifications
                                                                    :</label>
                                                                    <select class="form-control select2"  name="category_sub_specifications[]" multiple style="width:100%;">
                                                                    @foreach ($specificationgroup as $group)
                                                                        <option value="{{ $group->id }}">
                                                                            {{ $group->specification_group_name }} ( {{ $group->specification_group_refname }})
                                                                        </option>
                                                                    @endforeach
                                                                    </select>
                                                            </div>
                                                            <div class="form-group  col-6">
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


{{-- EDIT PAGE --}}

                                    <div class="modal fade" id="exampleModal1" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
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
                                                        <div class="form row">
                                                            <div class="form-group col-6">
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

                                                            <div class="form-group  col-6">
                                                                <label for="validationCustom01" class="mb-1">Select
                                                                    Category :</label>
                                                                <select class="custom-select w-100 form-control" 
                                                                name="editcategory_id" id="editcategory_id">
                                                                    <option value="" id="editcategoryoption_id" selected hidden>Select
                                                                        Category</option>
                                                                </select>
                                                            </div>

                                                            <div class="form-group col-12">
                                                                <label for="validationCustom01" class="mb-1">Sub Category
                                                                    :</label>
                                                                <input class="form-control" name="editsub_category_name"
                                                                    id="editsub_category_name" required type="text">
                                                            </div>

                                                            <div class="form-group  col-6">
                                                                <label for="validationCustom02" class="mb-1">Sub Category
                                                                    Image :</label>
                                                                <input class="form-control" name="editsub_category_iamge"
                                                                id="editsub_category_iamge" type="file" accept="image/*" >
                                                                <input class="form-control" name="oldeditsub_category_iamge"
                                                                id="oldeditsub_category_iamge" type="hidden" accept="image/*" >
                                                            </div>
                                                            <div class="form-group  col-6">
                                                                <label for="validationCustom01" class="mb-1">Sort Order
                                                                    :</label>
                                                                <input class="form-control" id="editsub_category_sortorder" name="editsub_category_sortorder"
                                                                    id="" type="number" required="true">
                                                            </div>
                                                            <div class="form-group col-12">
                                                                <label for="validationCustom01" class="mb-1">Meta Keyword / Tags
                                                                    :</label>
                                                                <textarea class="form-control" id="editsub_category_keywords" name="editsub_category_keywords"
                                                                    id="" type="text" required="true"></textarea>
                                                            </div>
                                                            <div class="form-group  col-12">
                                                                <label for="validationCustom01" class="mb-1">Attributes
                                                                    :</label>
                                                                    <select class="form-control select2" id="edit_attributes" name="category_sub_attributes[]" multiple style="width:100%;">
                                                                    @foreach ($attributegroup as $group)
                                                                        <option value="{{ $group->id }}">
                                                                            {{ $group->attribute_group_name }} ( {{ $group->attribute_group_refname }})
                                                                        </option>
                                                                    @endforeach
                                                                    </select>
                                                            </div>
                                                            <div class="form-group col-12">
                                                                <label for="validationCustom01" class="mb-1">Specifications
                                                                    :</label>
                                                                    <select class="form-control select2" id="edit_specifications" name="category_sub_specifications[]" multiple style="width:100%;">
                                                                    @foreach ($specificationgroup as $group)
                                                                        <option value="{{ $group->id }}">
                                                                            {{ $group->specification_group_name }} ( {{ $group->specification_group_refname }})
                                                                        </option>
                                                                    @endforeach
                                                                    </select>
                                                            </div>
                                
                            
                                                            <div class="form-group  col-6">
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








                                <div class="datatable-dashv1-list custom-datatable-overright">
                                    <table class="table" id="table" data-click-to-select="true"
                                        data-show-columns="true" data-sort-name="id" data-sort-order="asc"
                                        data-mobile-responsive="true" data-toggle="table" data-sort="true"
                                        data-pagination="true" data-page-size="25" data-search="true" data-show-refresh="true"
                                        data-key-events="true" data-resizable="true" data-cookie="true"
                                        data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">

                                        <thead>
                                            <tr>
                                                <th data-field="id" data-sortable="true">Id</th>
                                                <th data-field="image" data-sortable="true">Image</th>
                                                <th data-field="maincategory" data-sortable="true">Main Category</th>
                                                <th data-field="category" data-sortable="true">Category</th>
                                                <th data-field="subcategory" data-sortable="true">Sub Category</th>
                                                <th data-field="sort" data-sortable="true">Sort Order</th>
                                                <th data-field="status" data-sortable="true">Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($sub_category_data as $sub_category)
                                                <tr>
                                                     
                                                    <td>{{str_pad($loop->iteration, 4, '0', STR_PAD_LEFT);  }}</td>
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
                                                    <td>{{ $sub_category->category_sub_sortorder }}  </td>
                                                    <td>
                                                        <label class="switch">
                                                            <input type="checkbox"
                                                                   class="toggle-status"
                                                                   data-id="{{ $sub_category->me_id }}"
                                                                   {{ $sub_category->sc_status == 1 ? 'checked' : '' }}>
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
                                                            {{-- <form
                                                                action="{{ route('staffcategory.sub.destroy', $sub_category->me_id) }}"
                                                                method="post">
                                                                @method('DELETE')
                                                                @csrf
                                                                <button type="button" class="btn btn-warning mx-1 delete-btn"><i class="fa fa-trash"></i>
                                                                </button>
                                                            </form> --}}
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
            function ensureEditSelect2Rendered() {
                var $modal = $('#exampleModal1');
                var $attrs = $('#edit_attributes');
                var $specs = $('#edit_specifications');

                [$attrs, $specs].forEach(function($el) {
                    if (!$el.length) return;
                    if ($el.data('select2')) {
                        $el.select2('destroy');
                    }
                    $el.select2({
                        width: '100%',
                        dropdownParent: $modal,
                        closeOnSelect: false
                    });
                });
            }

            function applySelectedValues($select, values) {
                if (!$select || !$select.length) return;
                var cleanValues = (values || []).map(function(v) {
                    return String(v).trim();
                }).filter(function(v) {
                    return v !== '';
                });

                cleanValues.forEach(function(v) {
                    if ($select.find('option[value="' + v.replace(/"/g, '\\"') + '"]').length === 0) {
                        $select.append(new Option(v, v, true, true));
                    }
                });

                $select.val(cleanValues).trigger('change').trigger('change.select2');
            }

            $('.select2').select2();
        </script>
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
      $('#exampleModal1').modal('show');
      var url ="{{route('staffcategory.sub.edit', ":cate_id")}}";
          url = url.replace(":cate_id", cate_id);
      $.ajax({
       
            url:url,       
            type: "get",
            dataType: 'json',
            success: function (response) {
                  if(response.status == 404)
                  {
                  $('successmessage').html('');
                  $('successmessage').addClass('alert alert-danger');
                  $('successmessage').text(response.message);
                  }
                  else{
                    function parseStoredMultiValue(rawValue) {
                        if (!rawValue) return [];
                        var text = String(rawValue).trim();
                        if (!text) return [];

                        if (text.charAt(0) === '[') {
                            try {
                                var parsed = JSON.parse(text);
                                if (Array.isArray(parsed)) {
                                    return parsed.map(function(item) {
                                        return String(item).trim();
                                    }).filter(function(item) {
                                        return item !== '';
                                    });
                                }
                            } catch (e) {}
                        }

                        return text.split(',').map(function(item) {
                            return String(item).trim();
                        }).filter(function(item) {
                            return item !== '';
                        });
                    }

                    getsubcat(response.category_sub.category_main_id,response.category_sub.category_id);
                    $('#edit_id').val(response.category_sub.id);
                    $('#editmain_category_id').val(response.category_sub.category_main_id);

                    $('#editcategoryoption_id').val(response.category_sub.category_id);
                    $('#editsub_category_name').val(response.category_sub.category_sub_name);
                    $('#oldeditsub_category_iamge').val(response.category_sub.category_sub_image);                    
                    $('#editsub_category_sortorder').val(response.category_sub.category_sub_sortorder);                    
                    $('#editsub_category_keywords').val(response.category_sub.category_sub_keywords);
                    $('#editstatus').val(response.category_sub.status);
                    var attributesArray = parseStoredMultiValue(response.category_sub.category_sub_attributes);
                    var specificationsArray = parseStoredMultiValue(response.category_sub.category_sub_specifications);

                    // Set selected values for multi-select dropdown
                    applySelectedValues($('#edit_attributes'), attributesArray);
                    applySelectedValues($('#edit_specifications'), specificationsArray);
                    $('#exampleModal1').one('shown.bs.modal', function() {
                        ensureEditSelect2Rendered();
                        applySelectedValues($('#edit_attributes'), attributesArray);
                        applySelectedValues($('#edit_specifications'), specificationsArray);
                    });
                    ensureEditSelect2Rendered();
                    applySelectedValues($('#edit_attributes'), attributesArray);
                    applySelectedValues($('#edit_specifications'), specificationsArray);
                  }
              }
        });
      });


      $('#editmain_category_id').on('change', function() {
                let main_category_id = $(this).val();
                let url = '{{ route('getCategory') }}?main_category_id=' + main_category_id;
                let method = 'GET';
                getAjaxValue(url, method, function(data) {

                    $.each(data, function(key, category) {
                        $('#editcategory_id').append(
                            
                            `<option value="${category.id}" selected>${category.category_name}</option>`
                        );
                    });
                });
            });

   function getsubcat(mid,cid)
   {
    let main_category_id = mid;
    let url = '{{ route('getCategory') }}?main_category_id=' + main_category_id;
    let method = 'GET';
    getAjaxValue(url, method, function(data) {
        $('#editcategory_id').empty();

        $.each(data, function(key, category) {
            var cond=(cid==category.id)?'selected':'';
            $('#editcategory_id').append(
                
                `<option value="${category.id}" `+ cond+`>${category.category_name}</option>`
            );
        });
    });
   }


            $(document).on('submit','#UPDATEFORM', function(e){
        e.preventDefault();
        var updatecate_id = $('#edit_id').val();
        let editformDate = new FormData($('#UPDATEFORM')[0]);
        var url ="{{route('subcategory_update', ":updatecate_id")}}";

        url = url.replace(":updatecate_id", updatecate_id);
        $.ajax({
            url:url,       
            type:"POST",
            data: editformDate,
            contentType:false,
            processData:false,
            success: function (response) {
                window.location.reload();
            }
     });
    });
    
    $(document).ready(function() {
        $(".modal").on("hidden.bs.modal", function() {
            $(this).find('form').trigger('reset');
        });

        // Toggle Status
        $(document).on('change', '.toggle-status', function() {
            var status = $(this).prop('checked') == true ? 1 : 0;
            var category_id = $(this).data('id');
            
            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('staffcategory.sub.changestatus') }}",
                data: {
                    '_token': '{{ csrf_token() }}',
                    'status': status,
                    'id': category_id
                },
                success: function(data){
                    console.log(data.success);
                },
                error: function(xhr, status, error) {
                    console.log(error);
                }
            });
        });

        // Delete SweetAlert
        $(document).on('click', '.delete-btn', function(e) {
            e.preventDefault();
            var form = $(this).closest('form');
            Swal.fire({
                title: 'Are you sure?',
                text: "You want to delete it?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });
    });

        </script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <style>
            .swal2-popup {
                font-size: 1.6rem !important;
                width: 500px !important;
                max-width: 90% !important;
            }
        </style>
    @endsection
