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
        @include('paritials.auth.sidemenu');
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
                                <h3>Specification Listings

                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i data-feather="home"></i></a>
                                </li>
                                <li class="breadcrumb-item active">Specification Listings</li>
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
                                    data-original-title="test" data-bs-target="#exampleModal"onclick="showModal()">Add Specification</button>
                                <br>
                                <table class="table fcolor" id="table" data-click-to-select="true" data-sort-name="id"
                                    data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-sort="true"
                                    data-pagination="true" data-search="true" data-show-refresh="true"
                                    data-key-events="true" data-show-columns="true" data-resizable="true" data-cookie="true"
                                    data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">

                                    <thead>
                                        <tr>
                                            <th data-field="id" data-sortable="true">Id</th>
                                            <!--<th data-field="title" data-sortable="true">Sub Category</th>-->

                                            <th data-field="list" data-sortable="true">Specification Name</th>
                                            <th data-field="value" data-sortable="true">Specification Value</th>

                                            <th data-field="status" data-sortable="true">Status</th>
                                           
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                         @php $spc=0; @endphp
                                        @foreach ($specification as $specification)
                                         @php $spc++; @endphp
                                            <tr>
                                                <td>{{str_pad($loop->iteration, 4, '0', STR_PAD_LEFT);  }}</td>
                                                <!--<td>{{ $specification->category_sub_name }}</td>-->
                                                <td>{{ $specification->name }}</td>

                                                <td>
                                                   @php
                                                        $spec_val = json_decode($specification->value);
                                                        $i=1;
                                                        $nspc=count($spec_val);
                                                        echo '<p>';
                                                        foreach ($spec_val as $key => $value) {
                                                          if($i==5) 
                                                          {
                                                             echo '<span id="dots'.$spc.'">...</span><span id="more'.$spc.'" class="more">';
                                                          } 
                                                                echo "<span class='p-1 border border-dark px-3 mx-1 rounded'>$value</span>";
                                                             
                                                              $i++;
                                                        }
                                                         
                                                         if($nspc>4)
                                                         {
                                                      echo '</span></p><button onclick="readmore('.$spc.')" id="myBtn'.$spc.'">+ more</button> '; 
                                                         }
                                                         else {
                                                            echo '</p>';
                                                         }
                                                       
                                                    @endphp
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
                                                     <span class="d-flex">
                                                    <button type="button" class="edit_spec btn btn-secondary mx-1" data-bs-toggle="modal" data-original-title="Edit" value="{{$specification->id}}" id="edit_spec">
                                                        <i class="fa fa-pencil"></i> </button>
													<!--span> <a href="#" class="badge badge-secondary px-2"
                                                            data-toggle="tooltip" data-placement="top" title=""
                                                            data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                        <a href="#" onclick="return delete_maincategory()"
                                                            class="badge badge-warning px-2" data-toggle="tooltip"
                                                            data-placement="top" title=""
                                                            data-original-title="Delete"><i class="fa fa-trash"></i></a>
                                                    </span-->
													
													<form
																action="{{ route('product.specification.destroy', $specification->id) }}"
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
                        <h5 class="modal-title f-w-600" id="exampleModalLabel">Add Specification</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>

                    <div class="modal-body">
                        <form class="" method="post" action="{{ route('product.specification.store') }}"
                            enctype="multipart/form-data" onsubmit="return confirm('Are you sure, you want to Save it?')">
                            @csrf

                            <div class="form">
                                <div class="form-group">
                                    <label class="col-form-label fw-bold">Sub Category</label>
                                    <select name="category_sub_id" id="category_sub_id" class="custom-select form-control" required>
                                        <option value="" hidden selected>--Select Sub Category--</option>
                                        <option id="1" value="1">ALL</option> 
                                        <!--@foreach ($subcategory as $subcategory)-->
                                        <!--    <option id="{{ $subcategory->id }}" value="{{ $subcategory->id }}">{{ $subcategory->category_sub_name }}-->
                                        <!--@endforeach-->
                                    </select>
                                </div>
                                <!--<span id="cate1"></span>-->
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="mb-1 fw-bold">Name</label>
                                    <input class="form-control" name="name" id="" required type="text">
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
        {{-- Edit specification --}}
        <div class="modal fade fcolor" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title f-w-600" id="exampleModalLabel">Update Specification</h5>
                        <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">×</span></button>
                    </div>

                    <div class="modal-body">
                        <form class="" method="post"    id="UPDATEFORM"                    
                        enctype="multipart/form-data">
                        @csrf
                        {{-- <form class="" method="post" action="{{ route('product.specification.update') }}"
                            enctype="multipart/form-data" onsubmit="return confirm('Are you sure, you want to Save it?')">
                            @csrf --}}

                            <div class="form">
                                <input type="hidden" id="edit_id"> 
                                <div class="form-group">
                                    <label class="col-form-label fw-bold">Sub Category</label>
                                    <select name="editcategory_sub_id" id="editcategory_sub_id" class="custom-select form-control" required>
                                        <option value="" hidden selected>--Select Sub Category--</option>
                                        <!--@foreach ($subcategory1 as $subcategory)-->
                                        <!--    <option value="{{ $subcategory->id }}">{{ $subcategory->category_sub_name }}-->
                                        <!--@endforeach-->
                                        <option id="1" value="1">ALL</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="mb-1 fw-bold">Name</label>
                                    <input class="form-control" name="editname" id="editname" required type="text">
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
                                                {{-- <input id="value" name="value[]" class="form-control" type="text"
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
                                <select name="editstatus" id="editstatus" class="custom-select w-100 form-control" required="">
                                    <option value="49">Active</option>
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
        {{-- End --}}

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
    <script>
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
        /*Edit Attripute*/ 

    $(document).on('click','.edit_spec', function(e){
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
          url: "{{ url('admin/editspec') }}/"+id+"/edit",          
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
					$('#editcategory_sub_id').val(response.subcategory[0].category_sub_id);
                    $('#editname').val(response.subcategory[0].name);
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
            var url ="{{route('specupdate', ":updatecate_id")}}";

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
/* Category Details*/
/*Category Details*/
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

        $('#category_sub_id').on('change', function() {
            let sub_category_id = $(this).find(":selected").attr("id");
            
            let url = '{{ route('scatedetails') }}?sub_category_id=' + sub_category_id;
            let method = 'GET';
            $("#cate1").html('');
            getAjaxValue(url, method, function(data) {
                //  $("#cate1").html('<label for="" class="mb-1 fw-bold">Main Category</label><input type="text" name="cate" id="cate" value='+data.catedetails[0].category_main_name+'><label for="" class="mb-1 fw-bold">Sub Category</label><input type="text" name="scate" id="scate" value='+data.catedetails[0].category_name+'>');
                  if(data.catedetails)
                    {
                     $("#cate1").html('<label for="" class="mb-1 fw-bold">Main Category</label><input type="text" name="cate" id="cate" value='+data.catedetails[0].category_main_name+'><label for="" class="mb-1 fw-bold">Sub Category</label><input type="text" name="scate" id="scate" value='+data.catedetails[0].category_name+'>');
                    }
                else{
                   
                 }
                
       });
    });

        </script>
@endsection
