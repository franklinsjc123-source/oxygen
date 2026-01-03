@extends('layout.auth.master')
@section('contents')
    @include('paritials.js.product.attribute-js')
    @include('paritials.css.product.attribute-css')
    @include('paritials.auth.header')

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
        <style type="text/css">
            .read-more-show{
              cursor:pointer;
              color: #ed8323;
            }
            .read-more-hide{
              cursor:pointer;
              color: #ed8323;
            }
        
            .hide_content{
              display: none;
            }
            .more{
              display: none;
            }
        </style>

        <div class="page-body">

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <h3>Attributes Listings

                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i data-feather="home"></i></a>
                                </li>
                                <li class="breadcrumb-item active">Attributes Listings</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

            <!-- Container-fluid starts-->
            <div class="container-fluid ">

                <div class="row">

                    <div class="col-sm-12">

                        <div class="card">


                            <div class="card-body order-datatable">

                                <button type="button" class="btn mb-4 btn-primary" data-bs-toggle="modal"
                                    data-original-title="test" data-bs-target="#exampleModal" onclick="showModal()">Add Attributes</button>
                                <br>
                                <form action="{{ route('searchdetails') }}" method="post">
                                    @csrf
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5 class="fw-bold"> Primary / Main Category</h5>
                                                <div class="form-group">
                                                    <select class="js-select2 form-control" id="main_category"
                                                        name="category_main" required>
                                                        <option selected hidden value="">-- Select --
                                                        </option>
                                                        @foreach ($category_main_data as $category_main)
                                                            <option id="{{ $category_main->id }}"
                                                                value="{{ $category_main->id}}">
                                                                {{ $category_main->category_main_name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5 class="fw-bold">Category</h5>
                                                <div id="clothing">
                                                    <select class="js-select2 form-control" name="category"
                                                        id="category" disabled required>
                                                        <option value="">Select Main
                                                            Category</option>

                                                            
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <h5 class="fw-bold">Sub Category</h5>
                                                <div id="clothing">
                                                    <select class="js-select2 form-control" name="category_sub"
                                                        id="sub_category" disabled required>
                                                        <option selected hidden value="">Select
                                                            Category
                                                        </option>
                                                    </select>
                                                </div>
                                              
                                            </div>
                                              
                                        </div>
                                          <div class="col-md-3" style="margin-top:35px;">
                                                  
                                                <button class="btn btn-primary" type="submit" name ="submit">Search</button>
                                                 <a href="{{ route('vendorattribute.master.index') }}"class="btn btn-primary" type="submit" name ="submit">clear</a>
                                          </div>
                                        
                                    </div>
                                </div>
                                </form>
                                <table class="table fcolor" id="table" data-click-to-select="true" data-sort-name="id"
                                    data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-sort="true"
                                    data-pagination="true" data-search="true" data-show-refresh="true"
                                    data-key-events="true" data-show-columns="true" data-resizable="true" data-cookie="true"
                                    data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">

                                    <thead>
                                        <tr>
                                            <th data-field="id" data-sortable="true">Id</th>
                                            <th data-field="title" data-sortable="true"> Sub Category</th>
                                            <th data-field="list" data-sortable="true">Attributes Name</th>
                                            <th data-field="value" data-sortable="true">Attributes Value</th>
                                            <th data-field="status" data-sortable="true">Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody id ="tbody">
                                        @php $spc=0; @endphp
                                        @foreach ($attribute as $attribute)
                                        @php $spc++; @endphp
                                            <tr>
                                                <td>{{ str_pad($loop->iteration, 4, '0', STR_PAD_LEFT); }}</td>


                                                <td>{{ $attribute->category_sub_name }}</td>

                                                <td>{{ $attribute->attribute_name }}</td>

                                                <td>

                                                    @php
                                                        $attr_val = json_decode($attribute->value);
                                                        
                                                        $i=1;
                                                        $nspc=count($attr_val);
                                                        echo '<p>';
                                                        foreach ($attr_val as $key => $value) {
                                                          if($i==4) 
                                                          {
                                                             echo '<span id="dots'.$spc.'">...</span><span id="more'.$spc.'" class="more">';
                                                          } 
                                                             echo "<span class='p-1 border border-dark px-3 mx-1 rounded'>$value</span>";
                                                             
                                                              $i++;
                                                        }
                                                         
                                                         if($nspc>3)
                                                         {
                                                      echo '</span></p><button onclick="readmore('.$spc.')" id="myBtn'.$spc.'">+ more</button> '; 
                                                         }
                                                         else {
                                                            echo '</p>';
                                                         }
                                                        
                                                    @endphp


                                                    {{-- <span class="p-1 border border-danger mx-2 px-3 rounded more"
                                                        onclick="myFunction()" id="myBtn">more</span> --}}
                                                </td>

                                                <td>
                                                     <label class="switch">
                                                           
                                                            
                                                             @if($attribute->status  == 1){
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
                                                    <button type="button" class="edit_attribute btn btn-secondary mx-1" data-bs-toggle="modal" data-original-title="Edit" value="{{$attribute->id}}" id="edit_attribute">
                                                        <i class="fa fa-pencil"></i> </button>
                                                    
                                                	<form action="{{ route('vendorattribute.master.destroy', $attribute->id) }}"
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

        <div class="modal fade fcolor" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title f-w-600" id="exampleModalLabel">Add Attributes</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>

                    <div class="modal-body">
                        <form class="" method="post" action="{{ route('vendorattribute.master.store') }}"
                            enctype="multipart/form-data" onsubmit="return confirm('Are you sure, you want to Save it?')">
                            @csrf

                            <div class="form">
                                {{-- <div class="form-group">
                                    <label class="col-form-label fw-bold">Sub Category</label>
                                    <select name="category_sub_id" id="category_sub_id" class="custom-select form-control" required>
                                        <option value="" hidden selected>--Select Sub Category--</option>
                                        @foreach ($subcategory as $subcategory)
                                            <option  id="{{ $subcategory->id }}" value="{{ $subcategory->id }}">{{ $subcategory->category_sub_name }}
                                        @endforeach
                                    </select>
                                </div> --}}
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5 class="fw-bold"> Primary / Main Category</h5>
                                            <div class="form-group">
                                                <select class="js-select2 form-control" id="ssmain_category"
                                                    name="sscategory_main" required>
                                                    <option selected hidden value="">-- Select --
                                                    </option>
                                                    @foreach ($category_main_data as $category_main)
                                                        <option id="{{ $category_main->id }}"
                                                            value="{{ $category_main->id}}">
                                                            {{ $category_main->category_main_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5 class="fw-bold">Category</h5>
                                            <div id="clothing">
                                                <select class="js-select2 form-control" name="sscategory"
                                                    id="sscategory" disabled required>
                                                    <option value="">Select Main
                                                        Category</option>

                                                        
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5 class="fw-bold">Sub Category</h5>
                                            <div id="clothing">
                                                <select class="js-select2 form-control" name="category_sub_id"
                                                    id="category_sub_id" disabled required>
                                                    <option selected hidden value="">Select
                                                        Category
                                                    </option>
                                                </select>
                                            </div>
                                          
                                        </div>
                                      
                                    </div>
                                    
                                </div>
                                <span id="cate1"></span>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="mb-1 fw-bold">Name</label>
                                <select class="custom-select form-control"  name="name" id="name" required>
                                    <option value="color"  selected>Color</option>
                                    <option value="size"  >Size</option>
                                </select>
                                    {{-- <input class="form-control" name="name" id="" required type="text"> --}}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <table class="table addproduct">
                                    <tbody class="input_fields_wrap" id="display">
                                        <thead class="bordered-darkorange">
                                            <tr role="row">
                                                <th style="width:150px;">Value</th>
                                                <th style="width:150px;"></th>
                                            </tr>
                                        </thead>

                                        <tr>
                                            <td>
                                                <span class="text-dark fw-bold" id="specify_length"></span>
                                            </td>
                                            <td>
                                                <span class="btn btn-info text-white " id="specify_show">Show</span>
                                                <span class="btn btn-success text-white " id="specify_hide">Hide</span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td>
                                                <input id="input" name="value[]" class="form-control" type="text"
                                                    placeholder="Enter Value" />
                                            </td>
                                            <td>
                                                <button type="button" class="add_field_button btn btn-xs btn-primary"
                                                    id="add1">Add More</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group mt-2">
                                <label for="validationCustom01" class="mb-1 fw-bold">Status</label>
                                <select name="status" class="custom-select w-100 form-control" required="">
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>

                                </select>

                            </div>
                    </div>


                    <div class="modal-footer">
                        <button type="sub" class="btn btn-primary" type="submit">Save</button></a>
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>

            </div>
        </div>
        {{-- Edit Attribute --}}
        <div class="modal fade fcolor" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title f-w-600" id="exampleModalLabel">Update Attributes</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>

                    <div class="modal-body">
                        <form class="" method="post"    id="UPDATEFORM"                    
                        enctype="multipart/form-data">
                        @csrf
                        {{-- <form class="" method="post" action="{{ route('attribute.master.update') }}"
                            enctype="multipart/form-data" onsubmit="return confirm('Are you sure, you want to Save it?')">
                            @csrf --}}

                            <div class="form">
                                <input type="hidden" id="edit_id"> 
                                <div class="form-group">






                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5 class="fw-bold"> Primary / Main Category</h5>
                                            <div class="form-group">
                                                <select class="js-select2 form-control" id="editssmain_category"
                                                    name="editsscategory_main" required>
                                                    <option selected hidden value="">-- Select --
                                                    </option>
                                                    @foreach ($category_main_data as $category_main)
                                                        <option id="{{ $category_main->id }}"
                                                            value="{{ $category_main->id}}">
                                                            {{ $category_main->category_main_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <h5 class="fw-bold">Category</h5>
                                            <div id="clothing">
                                                <select class="js-select2 form-control" name="editsscategory"
                                                    id="editsscategory" disabled required>
                                                    <option value="">Select Main
                                                        Category</option>

                                                        @foreach ($category as $category1)
                                                        <option id="{{ $category1->id }}"
                                                            value="{{ $category1->id}}">
                                                            {{ $category1->category_name }}
                                                        </option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                    </div>


                                    <label class="col-form-label fw-bold">Sub Category</label>
                                    {{-- <select name="editcategory_sub_id" id="editcategory_sub_id" class="custom-select form-control" required>
                                        <option value="" hidden selected>--Select Sub Category--</option>
                                        @foreach ($subcategory1 as $subcategory1)
                                            <option value="{{ $subcategory1->id }}">{{ $subcategory1->category_sub_name }}
                                        @endforeach
                                    </select> --}}





                                    <select class="custom-select w-100 form-control"
                                    name="editcategory_sub_name" id="editcategory_sub_name" required>
                                    <option value="" selected hidden>Select Main
                                        Category
                                    </option>
                                    
                                    @foreach ($subcategory1 as $subcategory)
                                        <option value="{{ $subcategory->id }}">
                                            {{  $subcategory->category_sub_name }}
                                        </option>
                                    @endforeach
                                </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="mb-1 fw-bold">Name</label>
                                <select class="custom-select form-control"  name="editname" id="editname" required>
                                    <option value="color"  selected>Color</option>
                                    <option value="size"  >Size</option>
                                </select>
                                    {{-- <input class="form-control" name="name" id="" required type="text"> --}}
                                </div>
                            </div>
                            <div class="col-md-12">
                                <table class="table addproduct">
                                    <tbody class="input_fields_wrap" id="display">
                                        <thead class="bordered-darkorange">
                                            <tr role="row">
                                                <th style="width:150px;">Value</th>
                                                <th style="width:150px;"></th>
                                            </tr>
                                        </thead>

                                        <tr>
                                            <td>
                                                <span class="text-dark fw-bold" id="specify_length"></span>
                                            </td>
                                            <td>
                                                <span class="btn btn-info text-white " id="specify_show">Show</span>
                                                <span class="btn btn-success text-white " id="specify_hide">Hide</span>
                                            </td>
                                        </tr>

                                        <tr>
                                            <td class="tbl1">
                                                {{-- <input id="editvalue" name="editvalue[]" class="form-control" type="text"
                                                    placeholder="Enter Value" /> --}}
                                            </td>
                                            <td>
                                                <button type="button" class="add_field_button btn btn-xs btn-primary"
                                                    id="add1">Add More</button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="form-group mt-2">
                                <label for="validationCustom01" class="mb-1 fw-bold">Status</label>
                                <select name="editstatus" class="custom-select w-100 form-control" required="" id="editstatus">
                                    <option value="1">Active</option>
                                    <option value="0">Deactive</option>

                                </select>

                            </div>
                    </div>


                    <div class="modal-footer">
                        <button type="sub" class="btn btn-primary" type="submit">Update</button></a>
                        <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
                    </div>
                    </form>
                </div>

            </div>
        </div>
        {{-- end --}}

    </div>
        <script>
        function readmore(id) {
          var dots = document.getElementById("dots"+id);
          var moreText = document.getElementById("more"+id);
          var btnText = document.getElementById("myBtn"+id);
        
          if (dots.style.display === "none") {
            dots.style.display = "inline";
            btnText.innerHTML = "+ more"; 
            moreText.style.display = "none";
          } else {
            dots.style.display = "none";
            btnText.innerHTML = "+ less"; 
            moreText.style.display = "inline";
          }
        }
        </script>

         <script type="text/javascript">
          $(document).ready(function()
        {
         $('#exampleModal').on('hidden.bs.modal', function (e) {
            $(this)
                .find("input,textarea,select")
                .val('')
                .end()
                .find("input[type=text], input[type=radio]")
                .prop("checked", "")
                .end();
            })
             $(document).on("click","#add1",function() {
            // alert("click");
            $(this).hide();
            
            });
            
        });
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


        // Get Category
        $('#main_category').on('change', function() {

            let main_category_id = $(this).find(":selected").attr("id");
            let url = '{{ route('vendorgetCategory') }}?main_category_id=' + main_category_id;
            let method = 'GET';
            getAjaxValue(url, method, function(data) {
                $('.spectable').empty();
                $('#attrsize').empty();
                $('#attrcolor').empty();
                $('#category').empty();
                $('#category').append(
                    `<option value=""selected hidden>Select Category</option>`
                );
                $.each(data, function(key, category) {
                    $('#category').append(
                        `<option id="${category.id}" value="${category.id}">${category.category_name}</option>`
                    );
                });

                $('#category').removeAttr('disabled');
            })
        });

        //  Get Sub Categoy
        $('#category').on('change', function() {
            let category_id = $(this).find(":selected").attr("id");
            //alert(category_id);
            let url = '{{ route('vendorgetSubCategory') }}?category_id=' + category_id;
            let method = 'GET';
            getAjaxValue(url, method, function(data) {
                $('.spectable').empty();
                $('#attrsize').empty();
                $('#attrcolor').empty();
                $('#sub_category').empty();
                $('#sub_category').append(
                    `<option value=""selected hidden>Select Sub Category</option>`
                );
                $.each(data, function(key, subCategory) {
                    $('#sub_category').append(
                        `<option id="${subCategory.id}"  value="${subCategory.id}">${subCategory.category_sub_name}</option>`
                    );
                });

                $('#sub_category').removeAttr('disabled');
            })
        });


/**Add attribute  msain category categor**/
// Get Category
$('#ssmain_category').on('change', function() {

let main_category_id = $(this).find(":selected").attr("id");
let url = '{{ route('vendorgetCategory') }}?main_category_id=' + main_category_id;
let method = 'GET';
getAjaxValue(url, method, function(data) {
    $('.spectable').empty();
    $('#attrsize').empty();
    $('#attrcolor').empty();
    $('#sscategory').empty();
    $('#sscategory').append(
        `<option value=""selected hidden>Select Category</option>`
    );
    $.each(data, function(key, category) {
      //  console.log(category);
        $('#sscategory').append(
            `<option id="${category.id}" value="${category.id}">${category.category_name}</option>`
        );
    });

    $('#sscategory').removeAttr('disabled');
})
});

//  Get Sub Categoy
$('#sscategory').on('change', function() {
let category_id = $(this).find(":selected").attr("id");
//alert(category_id);
let url = '{{ route('vendorgetSubCategory') }}?category_id=' + category_id;
let method = 'GET';
getAjaxValue(url, method, function(data) {
    $('.spectable').empty();
    $('#attrsize').empty();
    $('#attrcolor').empty();
    $('#category_sub_id').empty();
    $('#category_sub_id').append(
        `<option value=""selected hidden>Select Sub Category</option>`
    );
    $.each(data, function(key, subCategory) {
        $('#category_sub_id').append(
            `<option id="${subCategory.id}"  value="${subCategory.id}">${subCategory.category_sub_name}</option>`
        );
    });

    $('#category_sub_id').removeAttr('disabled');
})
});
/**End**/ 









/*Category Details*/

    //     $('#category_sub_id').on('change', function() {
    //         let sub_category_id = $(this).find(":selected").attr("id");
            
    //         let url = '{{ route('catedetails') }}?sub_category_id=' + sub_category_id;
    //         let method = 'GET';
    //         $("#cate1").html('');
    //         getAjaxValue(url, method, function(data) {
    //             if(data.catedetails)
    //             {
    //              $("#cate1").html('<label for="" class="mb-1 fw-bold">Main Category</label><input type="text" name="cate" id="cate" value='+data.catedetails[0].category_main_name+'><label for="" class="mb-1 fw-bold">Sub Category</label><input type="text" name="scate" id="scate" value='+data.catedetails[0].category_name+'>');
    //             }
    //             else{
    //                 // $("#cate1").html('<label for="" class="mb-1 fw-bold">Main Category</label><input type="text" name="cate" id="cate" value=''><label for="" class="mb-1 fw-bold">Sub Category</label><input type="text" name="scate" id="scate" value=''>');
    //             }
    //    });
    // });

/*Edit Attripute*/ 

    $(document).on('click','.edit_attribute', function(e){
        var editroute1='';
        var htmlPlan='';
    e.preventDefault();
    var id = $(this).val();

    //    console.log(pin_id);
    //  alert(id);
    
    $('#exampleModal1').modal('show');
        
    //console.log ($id)
    $.ajax({
        //   data: $('').serialize(),  {{ url('admin/pincode1') }}/"+pin_id+"/edit"
          url: "{{ url('vendar/editattribute') }}/"+id+"/edit",          
          type: "get",
          dataType: 'json',
          success: function (response) {
              
              console.log(response)
            // alert('test');
                if(response.status == 404)
                {
                // alert('test');
                
                $('successmessage').html('');
                $('successmessage').addClass('alert alert-danger');
                $('successmessage').text(response.message);
                }
                else{
                     //alert(response.subcategory[0].id);
                    $('#edit_id').val(response.subcategory[0].id);
					$('#editssmain_category').val(response.subcategory[0].category_main_id);
                    $('#editsscategory').val(response.subcategory[0].category_id);
                    $('#editcategory_sub_name').val(response.subcategory[0].category_sub_id);
                    
                    
                    $('#editname').val(response.subcategory[0].attribute_name);
                     //alert(response.subcategory[0].attribute_name);
                    //  $k = response.subcategory[0].value;
                    //  alert($k);
                    var wrapper         = $(".input_fields_wrap"); //Fields wrapper	
                     result = jQuery.parseJSON(response.subcategory[0].value);
                     var x = 1; //initlal text box count
                     cache: false;
                     $(wrapper).html('');
                     for(var k in result) {
                        console.log(k, result[k]);
                        max_fields = result.length;
                        if(x <= max_fields){ //max input box allowed
                            x++; //text box increment
                            $(wrapper).append('<tr class="attr_row"><td><input id ="value" name="value[]" class="form-control" value ='+result[k]+' type ="text" placeholder="Enter Value" /></td><td><a href="#" id="r'+x+'" class="remove " ><span class="text-danger fw-bold border p-2">X</span></a></td><tr>'); //add input box
                        }

                        }

                    //  $('#editvalue').val(response.subcategory[0].value);
                    $('#editstatus').val(response.subcategory[0].status);          
                   // alert(response.subcategory[0].status);          
                }  
            }
        
      });
    
    });
    function showModal() {
        var wrapper         = $(".input_fields_wrap"); 
        cache: false;
             $(wrapper).html('');
                     
        }

        $(document).on('submit','#UPDATEFORM', function(e){
            e.preventDefault();
            var updatecate_id = $('#edit_id').val();
            // alert(updatecate_id);
            let editformDate = new FormData($('#UPDATEFORM')[0]);
            var url ="{{route('vendorattributeupdate', ":updatecate_id")}}";

            url = url.replace(":updatecate_id", updatecate_id);
            $.ajax({
                url:url,       
                type:"POST",
                data: editformDate,
            //  dataType: 'json',
                contentType:false,
                processData:false,
                success: function (response) {
                   // alert(response);
                window.location.reload();
                }

        });
            
        });




//     $(document).on('click','#btnupdate', function(e){
//     //    alert('test');

//          e.preventDefault(e);
//     var id = $('#editid').val();
//     //  alert(id);


    
//     var name = $('#editgstname').val();
//     var value = $('#editgstvalue').val();
//     var description = $('#editgstdescription').val();
//     var status = $('#editgststatus').val();
    
//         //alert ( name);
   
//   //  var url ="{{route('zonalupdate', ":updateid")}}";
//    // url = url.replace(":updateid", updateid);
//     $.ajax({
//         //   data: $('').serialize(),    {{ url('admin/zonalupdate') }}/"+id+"/update"
//              // url: "{{ url('admin/zonalupdate') }}/"+updateid,
//               //console.log(id);
//          url: "{{ url('admin/gstupdate') }}/"+id+"/update", 
//          type: "POST",
//           data: {_token : `{{csrf_token()}}`,
//             gst_name:name,
//             value:value,
//             description:description,
//             status:status
//         },
//          dataType: 'html',
//           success: function (response) {
//                //console.log(response);

//                $('#exampleModal1').modal('hide');
//                location.reload();   
                
         
//             }
        
//       });
//     });

    $(document).ready(function() {
    $(".modal").on("hidden.bs.modal", function() {
        $(this).find('form').trigger('reset');
    });
    });


    </script>
@endsection
