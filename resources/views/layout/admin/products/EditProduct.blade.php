@extends('layout.auth.master')
@section('contents')
    @include('paritials.css.product.add-product-css')
    @include('paritials.js.product.add-product-js')

   

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
        <style>
            input[type="file"] {
                display: block;
            }
            .imageThumb {
                max-height: 75px;
                 border: 2px solid;
                padding: 1px;
                cursor: pointer;
            }
            .pip {
                display: inline-block;
                margin: 10px 10px 0 0;
            }
            .remove {
                display: block;
                background: #444;
                border: 1px solid black;
                color: white;
                text-align: center;
                cursor: pointer;
            }
            .remove:hover {
                background: white;
                color: black;
            }
    </style>
        <div class="page-body text-secondary fcolor">
            <form action="{{ route('products.crud.update',$product->id) }}" method="POST" enctype="multipart/form-data">
                
                @csrf
                @method('PUT')
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>Edit Product

                                    </h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <ol class="breadcrumb pull-right">
                                    <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}"><i
                                                data-feather="home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active">Edit Product</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->

                <!-- Container-fluid starts-->
                {{-- @foreach ($products as $product) --}}
                <div class="container-fluid fcolor">
                    <div class="row product-adding">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="col-xl-12">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="col-md-12">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <h5 class="fw-bold"> Primary / Main Category</h5>
                                                            <div class="form-group">
                                                                <select class="js-select2 form-control" id="main_category"
                                                                    name="category_main" required>
                                                                    {{-- <option selected hidden value="">-- Select --
                                                                    </option> --}}
                                                                   <!-- <option selected  value="
                                                                    {{-- {{ $product->id }}"> --}}

                                                                    {{-- {{ $product->category_main }} --}}
                                                                    </option> -->
                                                                    
                                                                    {{-- @foreach ($category as $categories)
                                                                    
                                                                    <option id="{{ $categories->id }}"
                                                                        value="{{ $categories->id }}" {{ ($categories->id == $product->category)?'selected':'';}}>
                                                                        {{ $categories->category_name }}
                                                                    </option>
                                                                @endforeach   --}}



                                                                      @foreach ($category_main_data as $category_main)
                                                                    
                                                                        <option id="{{ $category_main->id }}"
                                                                            value="{{ $category_main->id }}" {{ ($category_main->id==$product->category_main)?'selected':'';}}>
                                                                            {{ $category_main->category_main_name }}
                                                                        </option>
                                                                    @endforeach  
                                                                    {{-- @foreach ($category_main_data as $category_main)
                                                                    <option id="{{ $category_main->id }}"
                                                                        value="{{ $category_main->id}}">
                                                                        {{ $category_main->category_main_name }}
                                                                    </option> 
                                                                @endforeach--}}

                                                                    
                                                                </select>


                                                                
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <h5 class="fw-bold">Category</h5>
                                                            <div id="clothing">
                                                                <select class="js-select2 form-control" name="category"
                                                                    id="category"  required>
                                                                    {{-- <option value="" selected hidden>Select Main
                                                                        Category</option> --}}

                                                                        <option value="{{ $product->category }}" selected> {{ optional($cates->first())->category_name }}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <h5 class="fw-bold">Sub Category</h5>
                                                            <div id="clothing">
                                                                <select class="js-select2 form-control" name="category_sub"
                                                                    id="sub_category"  required>
                                                                    {{-- <option selected hidden value="">Select
                                                                        Category
                                                                    </option> --}}

                                                                    <option value="{{ $product->category_sub }}" selected> {{ optional($cates->first())->category_sub_name }}</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-12 digital-add needs-validation">
                                                <div class="row">
                                                    <div class="col-md-8">
                                                        <div class="form-group mt-2">
                                                            <label for=""
                                                                class="col-form-label pt-0 fw-bold"><span>*</span> Product
                                                                Name</label>
                                                            <input class="form-control" id="validationCustom01"
                                                                type="text" name="product_name" required value="{{ $product->product_name }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <label class="col-form-label col-md-3 fw-bold"><span
                                                                class="text-danger">*</span>Tax</label>
                                                        <select class="custom-select form-control text-secondary"
                                                            id="gs" onchange="r()" name="tax_id" required>
                                                            {{-- <option value="1">Included</option>
                                                            <option value="0">Excluded</option> --}}
                                                            <option value="1" {{ $product->tax_id == 1 ? 'selected' : ''}}>Included</option>
                                                            <option value="0" {{ $product->tax_id == 0 ? 'selected' : ''}}>Excluded</option>
                                                        </select>
                                                    </div>

                                                    <div class="col-md-2">
                                                        <label class="col-form-label col-md-3 fw-bold "><span
                                                                class="text-danger">*</span>Gst</label>
                                                        <select class="custom-select form-control dropdown text-secondary"
                                                            id="gst1" onchange="r()" required name="gst_id" required>
                                                            {{-- <option value="" selected hidden value="">--Select
                                                                Gst %--</option> --}}
                                                                 @foreach ($gst as $gst)
                                                                <option value="{{ $gst->value }}" {{ $product->gst_id == $gst->value ? 'selected' : ''}}>{{ $gst->gst_name }}
                                                                </option>
                                                            @endforeach
                                                            {{-- @foreach ($gst as $gst)
                                                                <option value="{{ $gst->gst_value }}">{{ $gst->gst_name }}
                                                                </option>
                                                            @endforeach --}}
                                                        </select>
                                                    </div>
                                                </div>
                                                @include('layout.admin.products.producteditDetails')


                                                <div class="card mt-3">
                                                    <div class="card-header bg-light">
                                                        <h5 class="m-0 fw-bold text-dark">Product Main Image</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row align-items-center">
                                                            <div class="col-md-4 text-center">
                                                                <div class="border rounded p-3 bg-light" style="max-width: 200px; margin: 0 auto;">
                                                                    <div class="img-preview-box mb-2 d-flex align-items-center justify-content-center" style="height: 150px; overflow: hidden;">
                                                                        <img src="{{ !empty($product->product_image) ? url('assets/images/products/'.$product->product_image) : '' }}" id="productMainImgPreview" class="img-fluid rounded" style="max-height: 100%; max-width: 100%; object-fit: contain; {{ !empty($product->product_image) ? '' : 'display: none;' }}">
                                                                    </div>
                                                                    <span class="btn btn-xs btn-outline-primary btn-productimg w-100 position-relative">
                                                                        <i class="fa fa-cloud-upload"></i> Upload Image
                                                                        <input class="form-control" type="file" id="productMainImgInput" name="mainImage" accept="image/*" style="position: absolute; top: 0; left: 0; opacity: 0; width: 100%; height: 100%; cursor: pointer;">
                                                                    </span>
                                                                    <input type="hidden" name="oldmainImage" value="{{ $product->product_image }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-8">
                                                                <p class="text-secondary small mb-1">Upload a high-quality main image for your product display.</p>
                                                                <ul class="text-secondary small ps-3 mb-0">
                                                                    <li>Supported formats: JPG, PNG, WEBP, GIF</li>
                                                                    <li>Recommend resolution: 800 x 800 pixels</li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5>Product Description</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="digital-add needs-validation">
                                                            <div class="form-group mb-0">
                                                                <div class="description-sm">
                                                                    <textarea id="description" cols="10" required rows="4" name="description">{{$product->description}}</textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card mt-3">
                                                    <div class="card-header bg-light">
                                                        <h5 class="m-0 fw-bold text-dark">Shipping Information</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row g-3">
                                                            <div class="col-md-3">
                                                                <label class="form-label fw-bold text-secondary mb-1">Weight (g)</label>
                                                                <input type="number" class="form-control" name="weight" placeholder="Weight (g)" value="{{$product->weight}}">
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label fw-bold text-secondary mb-1">Length (cm)</label>
                                                                <input type="number" class="form-control" placeholder="Length (cm)" name="length" value="{{ $product->length }}">
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label fw-bold text-secondary mb-1">Width (cm)</label>
                                                                <input type="number" class="form-control" name="width" placeholder="Width (cm)" value="{{ $product->width }}">
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label fw-bold text-secondary mb-1">Height (cm)</label>
                                                                <input type="number" class="form-control" name="height" placeholder="Height (cm)" value="{{$product->height}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card mt-3">
                                                    <div class="card-header bg-light d-flex justify-content-between align-items-center">
                                                        <h5 class="m-0 fw-bold text-dark">Specifications</h5>
                                                        <span class="text-secondary fw-bold" id="specify_length"></span>
                                                    </div>
                                                    <div class="card-body p-0">
                                                        <div class="table-responsive">
                                                            <table class="table table-hover table-bordered m-0 align-middle">
                                                                <thead class="table-light">
                                                                    <tr>
                                                                        <th style="width: 40%;">Specification Name</th>
                                                                        <th style="width: 60%;">Value</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody class="spectable">
                                                                    @php
                                                                        $specById = [];
                                                                        $specByName = [];
                                                                        foreach ($productspecs as $ps) {
                                                                            if (!empty($ps->spec_id)) {
                                                                                $specById[$ps->spec_id] = $ps->specify_value;
                                                                            }
                                                                            if (!empty($ps->specify_attribute)) {
                                                                                $specByName[$ps->specify_attribute] = $ps->specify_value;
                                                                            }
                                                                        }
                                                                    @endphp
                                                                    @foreach ($specification as $spec)
                                                                        @php
                                                                            $specValues = json_decode($spec->specification_values ?? '[]', true) ?: [];
                                                                            $selectedValue = $specById[$spec->id] ?? ($specByName[$spec->specification_group_name] ?? '');
                                                                        @endphp
                                                                        <tr>
                                                                            <td>
                                                                                <div class="form-check m-0 d-flex align-items-center">
                                                                                    <input class="form-check-input m-0" type="checkbox" id="spec_id_{{ $spec->id }}" name="spec_id[]" value="{{ $spec->id }}" {{ $selectedValue !== '' ? 'checked' : '' }}>
                                                                                    <label class="form-check-label fw-bold text-secondary ms-2 mb-0" for="spec_id_{{ $spec->id }}">
                                                                                        {{ $spec->specification_group_name }}
                                                                                    </label>
                                                                                </div>
                                                                                <input type="hidden" name="specify_attribute[{{ $spec->id }}]" value="{{ $spec->specification_group_name }}">
                                                                            </td>
                                                                            <td>
                                                                                <select class="form-select text-secondary" name="specify_value[{{ $spec->id }}]" id="specify_value_{{ $spec->id }}">
                                                                                    <option value="" hidden {{ $selectedValue === '' ? 'selected' : '' }}>-- Select {{ $spec->specification_group_name }} --</option>
                                                                                    @foreach ($specValues as $specify_val)
                                                                                        <option value="{{ $specify_val }}" {{ $specify_val == $selectedValue ? 'selected' : '' }}>{{ $specify_val }}</option>
                                                                                    @endforeach
                                                                                </select>
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
            
                                                    <div class="col-xl-12">
                                                        <div class="card p-3">
                                                            <div class="card-body">
                                                                <div class="conatiner">
                                                                    <div class="row mt-3">
                                                                        <div class="col-md-12 ">
                                                                            <h4 class="fw-bold">Offers & Collection</h4>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mt-3">
                                                                        <div class="col-md-1">
                                                                            <label class="text-center  fw-bold mt-2">Offers</label>
                                                                        </div>
                                                                        <div class="col-md-3 ">
                                                                            <select class="form-select form-select-lg text-secondary"
                                                                                id="offtype" name="offer">
                                                                                <option value="">Select</option>
                                                                                {{-- <option selected hidden value="">Select Here
                                                                                </option>
                                                                                <option value="Buy 3 Get 1 Free">Buy 3 Get 1 Free
                                                                                </option>
                                                                                <option value="Buy 1 Get 1 Free">Buy 1 Get 1 Free
                                                                                </option>
                                                                                <option value="Buy 3 @ 999">Buy 3 @ 999</option>
                                                                                <option value="None">None</option> --}}
            
                                                                                @foreach ($offers as $offer)
                                                                                @php
                                                                                    $offerLabel = "";
                                                                                    if($offer->type == "Buy X Get Y Free") {
                                                                                        $offerLabel = 'Buy ' . $offer->buy . ' get ' . $offer->getoffer . ' free';
                                                                                    } elseif($offer->type == "Buy X @ Y") {
                                                                                        $offerLabel = 'Buy ' . $offer->buyproduct . ' get amount ' . $offer->getamt;
                                                                                    } else {
                                                                                        $offerLabel = $offer->type;
                                                                                    }
                                                                                @endphp
                                                                                <option value="{{ $offer->id }}" {{ ($offerLabel == $product->offers || $offer->id == $product->offers)?'selected':'' }}>
                                                                                    {{ $offerLabel }}
                                                                                </option>
                                                                                 @endforeach
            
                                                                                {{-- <option>{{ $product->offers }}</option> --}}
                                                                            </select>
                                                                        </div>
                                                                        <div class="col-md-1">
                                                                            <label class="text-center  fw-bold mt-2">Collection</label>
                                                                        </div>
                                                                        <div class="col-md-4 ">
                                                                            <select class="form-select form-select-lg text-secondary"
                                                                                id="collection" name="collection">
                                                                                {{-- <option selected hidden value="">Select Here
                                                                                </option> --}}
                                                                                @foreach ($productcollection as $item )
                                                                                <option value="{{ $item->name }}" {{ ($item->name == $product->collection)?'selected':'';}}>{{ $item->name }}</option>
                                                                                @endforeach
                                                                                {{-- <option value="1">New Arrivals</option>
                                                                                <option value="2">Best Collection
                                                                                </option>
                                                                                <option value="3">Brand Material</option> --}}
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
            
                                                    <div class="col-xl-12 d-flex  justify-content-end">
                                                        <div class="form-group mt-5 d-inline">
                                                            &nbsp;
                                                        </div>
                                                        <div class="d-inline  text-white">
                                                            <button class="btn btn-primary w-100"
                                                                onclick="return confirm('Are you sure, you want to Update it?')"
                                                                type="submit">
                                                                Save
                                                            </button>
                                                        </div>
                                                        <div class="d-inline px-2 text-white">
                                                            <a href="#" class="btn btn-secondary w-100 " type="button">
                                                                Close
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-12">
                            <div class="row">
                                <div class="row">
                                    <div class="col-xl-12">
                                        <div class="card p-3">
                                            {{-- <div class="card-head ">
                                                <div class="form-group">
                                                    <div class="row">
                                                        <h4 class="text-start fw-bold ">Shipping</h4>
                                                        <div class="card-body">
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <div class="next-input--stylized">
                                                                        <input type="number" class="form-control"
                                                                            name="weight" placeholder="Weight (g)" value="{{$product->weight}}">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <div class="form-group mb-3">
                                                                        <div class="next-input--stylized">
                                                                            <input type="number" class="form-control"
                                                                                placeholder="Length (cm)" name="length"
                                                                                value="{{ $product->length }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group mb-3">
                                                                        <div class="next-input--stylized">
                                                                            <input type="number" class="form-control"
                                                                                name="width" placeholder="Width (cm)" value="{{ $product->width }}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3 ">
                                                                    <div class="form-group mb-3">
                                                                        <div class="next-input--stylized">

                                                                            <input type="number" class="form-control"
                                                                                name="height" placeholder="Height (cm)" value="{{$product->height}}">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>

                                <div class="col-xl-12">
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


                {{-- @endforeach --}}
            </form>
        </div>
    </div>


    <script type="text/javascript">
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
            let url = '{{ route('getSubCategory') }}?category_id=' + category_id;
            let method = 'GET';
            getAjaxValue(url, method, function(data) {
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

        // Get Specification
        // $('.specification').on('change', function() {
        //     let specification_id = $(this).find(":selected").attr("id");
        //     let url = '{{ route('getSpecValue') }}?specification_id=' + specification_id;
        //     let method = 'GET';
        //     getAjaxValue(url, method, function(data) {
        //         let specData = JSON.parse(data[0]);
        //         $('#specify_value').empty();

        //         $('#specify_value').append(
        //             `<option value=""selected hidden>Select Value</option>`
        //         );
        //         $.each(specData, function(key, spec) {
        //             $('#specify_value').append(
        //                 `<option value="${spec}">${spec}</option>`
        //             );
        //         });

        //         $('#specify_value').removeAttr('disabled');
        //     })
        // })


        // Get Attr
        // $('#sub_category').on('change', function() {
        //     let sub_category_id = $(this).find(":selected").attr("id");
        //     let url = '{{ route('getAttributes') }}?sub_category_id=' + sub_category_id;
        //     let method = 'GET';
        //     getAjaxValue(url, method, function(data) {


        // });
    // });
        // $('#sub_category').on('change', function() {
        //     let sub_category_id = $(this).find(":selected").attr("id");
        //     let url = '{{ route('getAttributes') }}?sub_category_id=' + sub_category_id;
        //     let method = 'GET';
        //     getAjaxValue(url, method, function(data) {

        //         $('#product_details').empty();
        //         let attributes;

        //         var nat = 0;

        //         $.each(data, function(key, attr) {
        //             nat++;
        //             let options;
        //             attributes +=
        //                 `<div class='col-md-2'>
        //                 <select class='form-select form-select-lg text-secondary' name='attributeDetails` + nat + `[]'>
        //                 <option selected value='' hidden> --Select ${attr.attribute_name}--</option>
        //                 ${(function fun(array) {
        //                     for (let index = 0; index < array.length; index++) {
        //                         options += `<option value='${array[index]}'> ${array[index]}</option>`;
        //                     }
        //                     return options;
        //                 })(JSON.parse(attr.value))}
        //             </select>
        //             <input type="hidden" name="attributename` + nat + `[]" value="${attr.attribute_name}">
        //             </div>`
        //         });


        //         // $('#product_details').append(`<div class="row">
        //         //         <div class="col-md-1">
        //         //             <label class="text-center border text-dark p-2" style="cursor: pointer"><span
        //         //                     class="">Add<br>
        //         //                     Product
        //         //                     <br>Image</span>
        //         //                 <input type="file" style="display:none "
        //         //                     onchange="img(this)" id="im1"
        //         //                     name="product_detail_image[]" accept="image/*">
        //         //                     <input type="hidden" name="nproducts[]" value="1" >
        //         //             </label>
        //         //         </div>

        //         //         <div class="col-md-11">
                            
        //         //             <div class="row">
                             
        //         //                 ${attributes}
        //         //                 <div class="col-md-2">
        //         //                     <input type="number" name="retail_price[]"
        //         //                         placeholder="Retail Price" class="form-control" required>
        //         //                 </div>
        //         //                 <div class="col-md-2">
        //         //                     <input type="number" name="selling_price[]"
        //         //                         placeholder="Selling Price" class="form-control" required>
        //         //                 </div>
        //         //                 <div class="col-md-2">
        //         //                     <input type="number" class="form-control"
        //         //                         placeholder="Qty" name="quantity[]" required>
        //         //                 </div>
                              
                               
        //         //     </div></div></div><div class="col-md-11">
                            
        //         //             <div class="row">
        //         //                 <div class="col-md-2">
                                   
        //         //                 </div>
                               

                                 

        //         //                 <div class="col-md-2">
        //         //                     <input type="text" name="sku[]" placeholder="SKU"
        //         //                         class="form-control" required  >
        //         //                 </div> 
        //         //                 <div class="col-md-2">
        //         //                     <select class="form-select form-select-lg text-secondary"
        //         //                         name="return_replace[]" required>
        //         //                         <option selected value="" hidden>
        //         //                             Return /
        //         //                             Replacement
        //         //                         </option>
        //         //                         <option value="1">
        //         //                             Return
        //         //                         </option>

        //         //                         <option value="2">
        //         //                             Replacement
        //         //                         </option>
        //         //                     </select>
        //         //                 </div>

                               

        //         //                 <div class="col-md-2">
        //         //                     <input type="text" name="r_days[]" placeholder="Days"
        //         //                         class="form-control" required>
        //         //                 </div>  
        //         //                 <div class="col-md-2">
        //         //                     <input type="number" name="low_stock_limit[]"
        //         //                         placeholder="Low Stock Limit" class="form-control" required>
        //         //                 </div>  
        //         //             </div>               
        //         //         </div>                  
        //         //     </div><br><br>`);

        //         // $('#specify_value').removeAttr('disabled');
        //     })
        // })

       

        // $(document).ready(function() {
        // // $('#sub_category').on('change', function() {

        //     // let sub_category_id = $(this).find(":selected").attr("id");
        //     // let url1 = '{{ route('getSpecifications') }}?sub_category_id=' + sub_category_id;
        //     let url1 = '{{ route('getSpecifications') }}';
        //     let method1 = 'GET';
        //     getAjaxValue(url1, method1, function(data) {
        //         $('.spectable').empty();

        //         let specifications;

        //         console.log(data);
        //         $.each(data, function(key, spec) {

        //             let options;
        //             specifications +=
        //                 `<tr>
        //                     <td><input type="checkbox" id="spec_id" name="spec_id[]" value="${spec.id}"> ${spec.name}</td><td>

        //                     <select class='form-select form-select-lg text-secondary' name='specify_value[${spec.id}]'>
        //                     <option selected value='' hidden> --Select ${spec.name}--</option>
        //                     ${(function fun(array) {
        //                         for (let index = 0; index < array.length; index++) {
        //                             options += `<option value='${array[index]}'> ${array[index]}</option>`;
        //                         }
        //                         return options;
        //                     })(JSON.parse(spec.value))}
        //                 </select>
        //                 <input type="hidden" name="specify_attribute[${spec.id}]" value="${spec.name}">
        //                 <input type="hidden" name="specify_act[${spec.id}" value="update">

        //                 </td></tr>`;
        //         });
        //         $(".spectable").append(specifications);
        //     });
        // });


        //image preview
         //main image

         $("#productMainImgInput").on("change", function(e) {
             var file = this.files;
             var img = document.getElementById('productMainImgPreview');
             if (file && file[0]) {
                 img.onload = () => {
                     URL.revokeObjectURL(img.src);
                 }
                 img.src = URL.createObjectURL(file[0]);
                 $(img).show();
             } else {
                 img.src = "";
                 $(img).hide();
             }
         });
        //image preciew
    $("#im1").on("change", function(e) {
            //console.log(e);
            
            var files = e.target.files,
                filesLength = files.length;
            
            for (var i = 0; i < filesLength; i++) {
                var f = files[i]
                var fileReader = new FileReader();
                fileReader.onload = (function(e) {
                    var file = e.target;
                  
                    $("<span class=\"pip\">" +
                        "<img class=\"imageThumb\" src=\"" + e.target.result +
                        "\" title=\"" + file.name + "\"/>" +
                        "<br/><span class=\"remove\">Remove image</span>" +
                        "</span>").insertAfter("#im1");
                    $(".remove").click(function() {
                        $(this).parent(".pip").remove();
                    });

                });
                fileReader.readAsDataURL(f);
            }
        });



         //add more product
    
    $(document).ready(function() {
        
             
        var max_fields = 10000000; //maximum input boxes allowed
    
        var wrapper = $(".input_fields_wrap"); //Fields wrapper 
       
        var add_button1 = $("#add_m"); //Add button ID

        var lis =$("#add_m").val();

        var x = lis; //initlal text box count
        
           //alert(lis);
    
        $(add_button1).click(function(e) { //on add input button click
           // alert(x);
            e.preventDefault();

           var lis =$(this).val();
           //alert(lis);
           
            $(wrapper).append(
                '<div class="variant-card w" id="variant-card-'+x+'">' +
                '    <div class="variant-card-header">' +
                '        <h6 class="m-0 fw-bold text-primary">Variant #'+(x+1)+'</h6>' +
                '        <button class="remove_field btn btn-xs btn-danger m-0" value=""><i class="fa fa-trash"></i> Remove</button>' +
                '    </div>' +
                '    <div class="card-body p-4">' +
                '        <input type="hidden" name="product_details_id[]" value="" required>' +
                '        <div class="row">' +
                '            <div class="col-md-9">' +
                '                <div class="row g-3">' +
                '                    <div class="col-md-4">' +
                '                        <label class="form-label fw-bold text-secondary mb-1">Color</label>' +
                '                        <select class="form-select text-secondary attrcolor" name="attrcolor[]" id="attrcolor'+x+'"><option hidden>Color</option></select>' +
                '                    </div>' +
                '                    <div class="col-md-4">' +
                '                        <label class="form-label fw-bold text-secondary mb-1">Size</label>' +
                '                        <select class="form-select text-secondary attrsize" name="attrsize[]" id="attrsize'+x+'"><option hidden>Size</option></select>' +
                '                    </div>' +
                '                    <div class="col-md-4">' +
                '                        <label class="form-label fw-bold text-secondary mb-1">Retail Price</label>' +
                '                        <input type="text" name="retail_price[]" placeholder="Retail Price" class="form-control" required>' +
                '                    </div>' +
                '                    <div class="col-md-4">' +
                '                        <label class="form-label fw-bold text-secondary mb-1">Selling Price</label>' +
                '                        <input type="text" name="selling_price[]" placeholder="Selling Price" class="form-control" required>' +
                '                    </div>' +
                '                    <div class="col-md-4">' +
                '                        <label class="form-label fw-bold text-secondary mb-1" id="lowstack'+(x+1)+'">Quantity</label>' +
                '                        <input type="number" class="qty form-control" id="qty'+(x+1)+'" placeholder="Qty" name="quantity[]" required>' +
                '                    </div>' +
                '                    <div class="col-md-4">' +
                '                        <label class="form-label fw-bold text-secondary mb-1">SKU</label>' +
                '                        <input type="text" name="sku[]" placeholder="SKU" class="form-control" required>' +
                '                    </div>' +
                '                    <div class="col-md-4">' +
                '                        <label class="form-label fw-bold text-secondary mb-1">Return / Replacement</label>' +
                '                        <select class="form-select text-secondary" name="return_replace[]">' +
                '                            <option value="">Select</option>' +
                '                            <option value="Return">Return</option>' +
                '                            <option value="Replacement">Replacement</option>' +
                '                        </select>' +
                '                    </div>' +
                '                    <div class="col-md-4">' +
                '                        <label class="form-label fw-bold text-secondary mb-1">Return Days</label>' +
                '                        <input type="text" name="r_days[]" placeholder="Days" class="form-control">' +
                '                    </div>' +
                '                    <div class="col-md-4">' +
                '                        <label class="form-label fw-bold text-secondary mb-1">Low Stock Limit</label>' +
                '                        <input type="number" name="low_stock_limit[]" id="low_stock_limit'+(x+1)+'" placeholder="Low Stock Limit" class="low_stock_limit form-control" required>' +
                '                    </div>' +
                '                </div>' +
                '            </div>' +
                '            <div class="col-md-3 border-start">' +
                '                <div class="px-2">' +
                '                    <label class="form-label fw-bold text-dark mb-2">Variant Images</label>' +
                '                    <div class="row g-2">' +
                '                        <div class="col-6">' +
                '                            <div class="border rounded p-2 text-center bg-light position-relative">' +
                '                                <span class="d-block mb-1 small fw-bold text-secondary">Main Image</span>' +
                '                                <div class="img-preview-box mb-2">' +
                '                                    <img class="img-thumb" id="mainr'+x+'" src="" style="max-height: 100%; max-width: 100%; object-fit: contain; display: none;" />' +
                '                                </div>' +
                '                                <span class="btn btn-xs btn-outline-primary btn-productimg w-100">' +
                '                                    <i class="fa fa-cloud-upload"></i> Upload' +
                '                                    <input class="form-control add_product" type="file" onchange="previewmainImg(this)" id="p_mainimg'+x+'" name="mainimg[]" accept="image/*">' +
                '                                </span>' +
                '                                <input type="hidden" name="old_mainimg[]" value="">' +
                '                            </div>' +
                '                        </div>' +
                '                        <div class="col-6">' +
                '                            <div class="border rounded p-2 text-center bg-light position-relative">' +
                '                                <span class="d-block mb-1 small fw-bold text-secondary">Sub Image 1</span>' +
                '                                <div class="img-preview-box mb-2">' +
                '                                    <img class="img-thumb" id="sub1r'+x+'" src="" style="max-height: 100%; max-width: 100%; object-fit: contain; display: none;" />' +
                '                                </div>' +
                '                                <span class="btn btn-xs btn-outline-primary btn-productimg w-100">' +
                '                                    <i class="fa fa-cloud-upload"></i> Upload' +
                '                                    <input class="form-control add_product" type="file" onchange="previewsubImg1(this)" id="subimg1'+x+'" name="subimg1[]" accept="image/*">' +
                '                                </span>' +
                '                                <input type="hidden" name="old_subimg1[]" value="">' +
                '                            </div>' +
                '                        </div>' +
                '                        <div class="col-6 mt-2">' +
                '                            <div class="border rounded p-2 text-center bg-light position-relative">' +
                '                                <span class="d-block mb-1 small fw-bold text-secondary">Sub Image 2</span>' +
                '                                <div class="img-preview-box mb-2">' +
                '                                    <img class="img-thumb" id="sub2r'+x+'" src="" style="max-height: 100%; max-width: 100%; object-fit: contain; display: none;" />' +
                '                                </div>' +
                '                                <span class="btn btn-xs btn-outline-primary btn-productimg w-100">' +
                '                                    <i class="fa fa-cloud-upload"></i> Upload' +
                '                                    <input class="form-control add_product" type="file" onchange="previewsubImg2(this)" id="subimg2'+x+'" name="subimg2[]" accept="image/*">' +
                '                                </span>' +
                '                                <input type="hidden" name="old_subimg2[]" value="">' +
                '                            </div>' +
                '                        </div>' +
                '                        <div class="col-6 mt-2">' +
                '                            <div class="border rounded p-2 text-center bg-light position-relative">' +
                '                                <span class="d-block mb-1 small fw-bold text-secondary">Sub Image 3</span>' +
                '                                <div class="img-preview-box mb-2">' +
                '                                    <img class="img-thumb" id="sub3r'+x+'" src="" style="max-height: 100%; max-width: 100%; object-fit: contain; display: none;" />' +
                '                                </div>' +
                '                                <span class="btn btn-xs btn-outline-primary btn-productimg w-100">' +
                '                                    <i class="fa fa-cloud-upload"></i> Upload' +
                '                                    <input class="form-control add_product" type="file" onchange="previewsubImg3(this)" id="subimg3'+x+'" name="subimg3[]" accept="image/*">' +
                '                                </span>' +
                '                                <input type="hidden" name="old_subimg3[]" value="">' +
                '                            </div>' +
                '                        </div>' +
                '                    </div>' +
                '                </div>' +
                '            </div>' +
                '        </div>' +
                '    </div>' +
                '</div>'
            );

            }

            $('#attrsize').find('option').each(function() {
                       //  alert($(this).val());
                         $("#attrsize"+x).append("<option value= "+$(this).val()+">"+$(this).val()+"</option>");
                       
            });

            $('#attrcolor').find('option').each(function() {
                         //alert($(this).val());
                         $("#attrcolor"+x).append("<option value= "+$(this).val()+">"+$(this).val()+"</option>");
                         
            });


        });
       
            // $( ".w" ).load(window.location.href + ".w" );
       
    
      $(wrapper).on("click", ".remove_field", function(e) { //user click on remove text
            e.preventDefault();
            $(this).closest('.w').remove();;
            x--;
         
    
        })
     

    });
    
  








    // add more image preview 
// function previewImg(a)
//     {
//        let id=a.id;
//       // alert(id);
//        const myArray = id.split("im");
//     let myid=   myArray[1];
// //alert(myid);
//        var files = document.getElementById(id).files;
//                     filesLength = files.length;
//                 for (var i = 0; i < filesLength; i++) {
//                     var f = files[i]
//                     var fileReader = new FileReader();
//                     fileReader.onload = (function(e) {
//                     var file = e.target;
//                     $("<div class='col-md-2 '><div class=\"img-thumb-wrapper card shadow\">" +
//                         "<img class=\"img-thumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
//                         "<br/><span class=\"remove bg-dark text-center fw-bold\">Remove</span>" +
//                         "</div></div>").insertAfter("#r"+myid);
//                     $(".remove").click(function(){
//                         $(this).parent(".img-thumb-wrapper").remove();
//                     });
                    
//                     });
//                     fileReader.readAsDataURL(f);
//                 }
//                 console.log(files);
            
           

//     }

   // Get Attr
    //     $('#sub_category').on('change', function() {
    //         let sub_category_id = $(this).find(":selected").attr("id");
    //         let url = '{{ route('getAttributes') }}?sub_category_id=' + sub_category_id;
    //         let method = 'GET';
    //         getAjaxValue(url, method, function(data) {


    //             console.log(data);
                

    //             $('.attrcolor').empty();

    //             let attribute;

    //             $.each(data, function(key, attr) {
    //                 // alert(JSON.stringify(spec));
    //                 // alert(attr.attribute_name)

    //                 let options;
    //                 attribute += ` <div class="col-md-2">${attr.attribute_name}</div>
    //                             <div class="col-md-2">
    //                         <select class='form-select form-select-lg text-secondary' name='atttibute_value[]'>
    //                         <option selected value='' hidden> --Select ${attr.attribute_name}--</option>
    //                         ${(function fun(array) {
    //                             for (let index = 0; index < array.length; index++) {
    //                                 options += `<option value='${array[index]}'> ${array[index]}</option>`;
    //                             }
    //                             return options;
    //                         })(JSON.parse(attr.value))}
    //                     </select>
    //                     <input type="hidden" name="specify_attri[]" value="${attr.attribute_name}">
    //                     </div>`;


    //         });
    //         // alert(attribute);
    //         $(".attrcolor").append(attribute);
    //     });
    // });


   // Image preview main img
   function previewmainImg(a)
   {
       let idee = a.id; 
       let file = $('#'+idee).prop('files'); 
       
       const myArray = idee.split("p_mainimg");
       let x = myArray[1]; 
       
       var img = document.getElementById('mainr'+x);
       if (file && file[0]) {                        
           img.onload = () => {
               URL.revokeObjectURL(img.src);
           }
           img.src = URL.createObjectURL(file[0]);
           img.style.display = 'block';
       } else {
           img.src = "";
           img.style.display = 'none';
       }
   }

// Image previve sub img1
            function previewsubImg1(a)
                {                    
                let idee=a.id; 
                   let file=$('#'+idee).prop('files'); 
                 
                const myArray = idee.split("subimg1");
                 let x =   myArray[1]; 
                    var thy = $(this);
                    
                    var img = document.getElementById('sub1r'+x);
                    var fi = $(a).attr('id');
                    if (file && file[0]) {                      
                      
                    img.onload = () => {
                        URL.revokeObjectURL(img.src);  // no longer needed, free memory
                    }                   
                        img.src = URL.createObjectURL(file[0]); // set src to blob url
                        img.style.display = 'block';
                    }else{  
                                             
                        img.src="";
                        img.style.display = 'none';
                    }                 
                console.log(files);                             
                }

// Image previve sub img2
            function previewsubImg2(a)
                {                    
                let idee=a.id; 
                   let file=$('#'+idee).prop('files'); 
                   
                const myArray = idee.split("subimg2");
                 let x =   myArray[1]; 
                    var thy = $(this);
                    
                    var img = document.getElementById('sub2r'+x);
                    var fi = $(a).attr('id');
                    if (file && file[0]) {                      
                        
                    img.onload = () => {
                        URL.revokeObjectURL(img.src);  // no longer needed, free memory
                    }                   
                        img.src = URL.createObjectURL(file[0]); // set src to blob url
                        img.style.display = 'block';
                    }  else{  
                                             
                        img.src="";
                        img.style.display = 'none';
                    }
                console.log(files);
                }

// Image previve sub img3
            function previewsubImg3(a)
                {
                let idee=a.id; 
                   let file=$('#'+idee).prop('files'); 
                  
                const myArray = idee.split("subimg3");
                let x =   myArray[1]; 
                var thy = $(this);
                    
                    var img = document.getElementById('sub3r'+x);
                    var fi = $(a).attr('id');
                    if (file && file[0]) {

                    img.onload = () => {
                        URL.revokeObjectURL(img.src);  // no longer needed, free memory
                    }
                        img.src = URL.createObjectURL(file[0]); // set src to blob url
                        img.style.display = 'block';
                    }  else{
                        img.src="";
                        img.style.display = 'none';
                    }
                console.log(files);
                }
    </script>
@endsection
