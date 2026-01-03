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
                                    data-original-title="test" data-bs-target="#exampleModal">Add Attributes</button>
                                <br>
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

                                    <tbody>
                                        @php $spc=0; @endphp
                                        @foreach ($attribute as $attribute)
                                        @php $spc++; @endphp
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>


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

                                                <td><!--span> <a href="#" class="badge badge-secondary px-2"
                                                            data-toggle="tooltip" data-placement="top" title=""
                                                            data-original-title="Edit"><i class="fa fa-pencil"></i> </a-->
                                                        <!--a href="#" onclick="return delete_maincategory()"
                                                            class="badge badge-warning px-2" data-toggle="tooltip"
                                                            data-placement="top" title=""
                                                            data-original-title="Delete"><i
                                                                class="fa fa-trash"></i></a-->
                                                	 <form
																action="{{ route('vendorattribute.master.destroy', $attribute->id) }}"
																method="post">
																@method('DELETE')
																@csrf
																<button type="submit" class="btn btn-warning mx-1"
																	onclick="return confirm('Are you sure, you want to delete it?')"><i
																		class="fa fa-trash"></i>
																</button>

                        
													</form><!--/span-->
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
                                <!--<div class="form-group">-->
                                <!--    <label class="col-form-label fw-bold">Sub Category</label>-->
                                <!--    <select name="category_sub_id" class="custom-select form-control" required>-->
                                <!--        <option value="" hidden selected>--Select Sub Category--</option>-->
                                <!--        @foreach ($subcategory as $subcategory)-->
                                <!--            <option value="{{ $subcategory->id }}">{{ $subcategory->category_sub_name }}-->
                                <!--        @endforeach-->
                                <!--    </select>-->
                                <!--</div>-->
                                
                                
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
            let url = '{{ route('getCategory') }}?main_category_id=' + main_category_id;
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
            let url = '{{ route('getSubCategory') }}?category_id=' + category_id;
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


            // Get Category
        $('#ssmain_category').on('change', function() {
        
        let main_category_id = $(this).find(":selected").attr("id");
        let url = '{{ route('getCategory') }}?main_category_id=' + main_category_id;
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
        let url = '{{ route('getSubCategory') }}?category_id=' + category_id;
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
    </script>
@endsection
