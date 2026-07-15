@extends('layout.auth.master')
@section('contents')
    @include('paritials.css.product.add-product-css')
    @include('paritials.js.product.add-product-js')

    @include('paritials.auth.header')

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
            .invalid-feedback-custom {
                display: none;
                color: #dc3545;
                font-size: 1.05rem;
                margin-top: 0.25rem;
            }
            form.validation-attempted :invalid ~ .invalid-feedback-custom,
            form.validation-attempted .invalid-field ~ .invalid-feedback-custom {
                display: block !important;
            }
            form.validation-attempted :invalid {
                border-color: #ced4da !important;
                box-shadow: none !important;
            }
            label, .form-label {
                margin-top: 0px !important;
                margin-bottom: 2px !important;
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
                                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i
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
                        <div class="col-md-12">
                            <div class="card shadow-sm border-0 mb-4">
                                <div class="card-body p-4">
                                    
                                     <!-- Category Selection -->
                                     <div class="row g-3">
                                         <!-- Primary / Main Category -->
                                         <div class="col-md-4">
                                             <div class="form-group">
                                                 <label class="form-label fw-bold text-dark">Primary / Main Category</label>
                                                 <select class="js-select2 form-control text-secondary" id="main_category" disabled required>
                                                     @foreach ($category_main_data as $category_main)
                                                         <option id="{{ $category_main->id }}"
                                                             value="{{ $category_main->id }}" {{ ($category_main->id==$product->category_main)?'selected':'';}}>
                                                             {{ $category_main->category_main_name }}
                                                         </option>
                                                     @endforeach  
                                                 </select>
                                                 <input type="hidden" name="category_main" value="{{ $product->category_main }}">
                                             </div>
                                         </div>
                                         
                                         <!-- Category -->
                                         <div class="col-md-4">
                                             <div class="form-group">
                                                 <label class="form-label fw-bold text-dark">Category</label>
                                                 <select class="js-select2 form-control text-secondary" id="category" disabled required>
                                                     <option value="{{ $product->category }}" selected> {{ optional($cates->first())->category_name }}</option>
                                                 </select>
                                                 <input type="hidden" name="category" value="{{ $product->category }}">
                                             </div>
                                         </div>
                                         
                                         <!-- Sub Category -->
                                         <div class="col-md-4">
                                             <div class="form-group">
                                                 <label class="form-label fw-bold text-dark">Sub Category</label>
                                                 <select class="js-select2 form-control text-secondary" id="sub_category" disabled required>
                                                     <option value="{{ $product->category_sub }}" selected> {{ optional($cates->first())->category_sub_name }}</option>
                                                 </select>
                                                 <input type="hidden" name="category_sub" value="{{ $product->category_sub }}">
                                             </div>
                                         </div>
                                     </div>

                                     <!-- Attribute Configuration -->
                                     @php
                                         $selectedAttributeId = null;
                                         $firstDetail = isset($productdetailss) && count($productdetailss) > 0 ? $productdetailss->first() : null;
                                         $attributesList = isset($attribute) ? $attribute : collect();
                                         if ($firstDetail && count($attributesList) > 0) {
                                             $attrName2 = strtolower($firstDetail->attributename2 ?? '');
                                             $attrName3 = strtolower($firstDetail->attributename3 ?? '');
                                             foreach ($attributesList as $attr) {
                                                 $groupName = strtolower($attr->attribute_group_name ?? '');
                                                 $refName = strtolower($attr->attribute_group_refname ?? '');
                                                 if ($groupName === $attrName2 || $groupName === $attrName3 || $refName === $attrName2 || $refName === $attrName3) {
                                                     $selectedAttributeId = $attr->id;
                                                     break;
                                                 }
                                             }
                                         }
                                         $is_color = 'no';
                                         if ($firstDetail && strtolower($firstDetail->attributename1 ?? '') === 'color' && !empty($firstDetail->attributevalue1)) {
                                             $is_color = 'yes';
                                         }
                                         $nproduct = isset($productdetailss) && count($productdetailss) > 0 ? $productdetailss->max('common_product') : 1;
                                     @endphp

                                     <div class="row g-3 mt-1">
                                         <!-- Attribute -->
                                         <div class="col-md-6">
                                             <div class="form-group">
                                                 <label class="form-label fw-bold text-dark">Attribute</label>
                                                 <select class="form-select text-secondary" id="selected_attribute_summary" disabled required>
                                                     <option value="">Select Attribute</option>
                                                     @foreach ($attributesList as $attr)
                                                         <option value="{{ $attr->id }}" {{ $selectedAttributeId == $attr->id ? 'selected' : '' }}>
                                                             {{ $attr->attribute_group_refname }}
                                                         </option>
                                                     @endforeach
                                                 </select>
                                                 <input type="hidden" name="selected_attribute_id1" value="{{ $selectedAttributeId }}">
                                             </div>
                                         </div>

                                         <!-- Is Color Available? -->
                                         <div class="col-md-6">
                                             <div class="form-group">
                                                 <label class="form-label fw-bold text-dark">Is Color Available?</label>
                                                 <select class="form-select text-secondary" id="is_color_summary" disabled required>
                                                     <option value="yes" {{ $is_color == 'yes' ? 'selected' : '' }}>Yes</option>
                                                     <option value="no" {{ $is_color == 'no' ? 'selected' : '' }}>No</option>
                                                 </select>
                                                 <input type="hidden" name="is_color_summary" value="{{ $is_color }}">
                                             </div>
                                         </div>
                                     </div>

                                     <!-- Basic Details -->
                                     <div class="row g-3 mt-1">
                                         <!-- Product Name -->
                                         <div class="col-md-6">
                                             <div class="form-group">
                                                 <label class="form-label fw-bold text-dark">Product Name <span class="text-danger">*</span></label>
                                                 <input class="form-control" id="validationCustom01" type="text" name="product_name" required value="{{ $product->product_name }}">
                                                 <div class="invalid-feedback-custom">Please enter product name</div>
                                             </div>
                                         </div>
                                         
                                         <!-- Tax -->
                                         <div class="col-md-2">
                                             <div class="form-group">
                                                 <label class="form-label fw-bold text-dark">Tax <span class="text-danger">*</span></label>
                                                 <select class="custom-select form-control text-secondary" id="gs" onchange="r()" name="tax_id" required>
                                                     <option>{{ $product->tax_id }}</option>
                                                 </select>
                                                 <div class="invalid-feedback-custom">Please select tax type</div>
                                             </div>
                                         </div>

                                         <!-- GST -->
                                         <div class="col-md-2">
                                             <div class="form-group">
                                                 <label class="form-label fw-bold text-dark">GST <span class="text-danger">*</span></label>
                                                 <select class="custom-select form-control dropdown text-secondary" id="gst1" onchange="r()" required name="gst_id" required>
                                                     <option>{{ $product->gst_id }}</option>
                                                 </select>
                                                 <div class="invalid-feedback-custom">Please select GST percentage</div>
                                             </div>
                                         </div>
                                         
                                         <!-- HSN Code -->
                                         <div class="col-md-2">
                                             <div class="form-group">
                                                 <label class="form-label fw-bold text-dark">HSN CODE <span class="text-danger">*</span></label>
                                                 <input class="form-control" type="text" name="hsncode" value="{{ $product->hsncode }}" required>
                                                 <div class="invalid-feedback-custom">Please enter HSN code</div>
                                             </div>
                                         </div>
                                     </div>

                                     <!-- Variant Details Subview -->
                                     @include('layout.admin.products.producteditDetails')

                                     <!-- Product Main Image -->
                                     <div class="row g-3 mt-3">
                                         <div class="col-md-3">
                                             <div class="form-group">
                                                 <label class="form-label fw-bold text-dark">Upload Main Image <span class="text-danger">*</span></label>
                                                 <input class="form-control" type="file" id="productMainImgInput" name="mainImage" accept="image/*">
                                                 <input type="hidden" name="oldmainImage" value="{{ $product->product_image }}">
                                             </div>
                                         </div>
                                         <div class="col-md-3">
                                             <div class="img-preview-box p-1 border rounded bg-white d-flex align-items-center justify-content-center" style="height: 120px; width: 120px; overflow: hidden;">
                                                 <img src="{{ !empty($product->product_image) ? url('assets/images/products/'.$product->product_image) : '' }}" id="productMainImgPreview" class="img-fluid" style="max-height: 100%; max-width: 100%; object-fit: contain; {{ !empty($product->product_image) ? '' : 'display: none;' }}">
                                             </div>
                                         </div>
                                     </div>

                                     <!-- Product Description -->
                                     <div class="form-group mt-3">
                                         <label class="form-label fw-bold text-dark">Product Description <span class="text-danger">*</span></label>
                                         <textarea id="description" class="form-control" required rows="5" name="description">{{ $product->description }}</textarea>
                                         <div class="invalid-feedback-custom">Please enter product description</div>
                                     </div>
                                 </div>
                             </div>

                             <!-- Shipping Information Card -->
                             <div class="card shadow-sm border-0 mb-4">
                                 <div class="card-body p-4">
                                     <!-- Shipping Information -->
                                     <h5 class="fw-bold text-dark mb-3">Shipping Information</h5>
                                     <div class="row g-3">
                                         <div class="col-md-3">
                                             <label class="form-label fw-bold text-dark">Weight (g)</label>
                                             <input type="number" class="form-control" name="weight" placeholder="Weight (g)" value="{{ $product->weight }}">
                                         </div>
                                         <div class="col-md-3">
                                             <label class="form-label fw-bold text-dark">Length (cm)</label>
                                             <input type="number" class="form-control" placeholder="Length (cm)" name="length" value="{{ $product->length }}">
                                         </div>
                                         <div class="col-md-3">
                                             <label class="form-label fw-bold text-dark">Width (cm)</label>
                                             <input type="number" class="form-control" name="width" placeholder="Width (cm)" value="{{ $product->width }}">
                                         </div>
                                         <div class="col-md-3">
                                             <label class="form-label fw-bold text-dark">Height (cm)</label>
                                             <input type="number" class="form-control" name="height" placeholder="Height (cm)" value="{{ $product->height }}">
                                         </div>
                                     </div>
                                 </div>
                             </div>

                             <!-- Specifications Card -->
                             <div class="card shadow-sm border-0 mb-4">
                                 <div class="card-body p-4">
                                     <!-- Specifications -->
                                     <h5 class="fw-bold text-dark mb-3">Specifications</h5>
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
                                                                 <label class="form-check-label fw-bold text-dark ms-2 mb-0" for="spec_id_{{ $spec->id }}">
                                                                     {{ $spec->specification_group_name }}
                                                                 </label>
                                                             </div>
                                                             <input type="hidden" name="specify_attribute[{{ $spec->id }}]" value="{{ $spec->specification_group_name }}">
                                                         </td>
                                                         <td>
                                                             <select class="form-control text-secondary" name="specify_value[{{ $spec->id }}]" id="specify_value_{{ $spec->id }}">
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

                             <!-- Offers & Collection Card -->
                             <div class="card shadow-sm border-0 mb-4">
                                 <div class="card-body p-4">
                                     <!-- Offers & Collection -->
                                     <h5 class="fw-bold text-dark mb-3">Offers & Collection</h5>
                                     <div class="row g-3">
                                         <div class="col-md-6">
                                             <div class="form-group">
                                                 <label class="form-label fw-bold text-dark">Offers</label>
                                                 <select class="form-control text-secondary" id="offtype" name="offer">
                                                     <option value="">Select Offer</option>
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
                                                         <option value="{{ $offer->id }}" {{ ($offerLabel == $product->offers || $offer->id == $product->offers) ? 'selected' : '' }}>
                                                             {{ $offerLabel }}
                                                         </option>
                                                     @endforeach
                                                 </select>
                                             </div>
                                         </div>
                                         <div class="col-md-6">
                                             <div class="form-group">
                                                 <label class="form-label fw-bold text-dark">Collection</label>
                                                 <select class="form-control text-secondary" id="collection" name="collection">
                                                     <option value="">Select Collection</option>
                                                     @foreach ($productcollection as $item)
                                                         <option value="{{ $item->name }}" {{ ($item->name == $product->collection) ? 'selected' : '' }}>{{ $item->name }}</option>
                                                     @endforeach
                                                 </select>
                                             </div>
                                         </div>
                                     </div>
                                 </div>
                             </div>

                             <!-- Action Buttons -->
                             <div class="row mt-4">
                                         <div class="col-12 d-flex justify-content-end gap-2">
                                             <button class="btn btn-primary px-4 py-2" onclick="return confirm('Are you sure you want to update this product?')" type="submit">
                                                 Save
                                             </button>
                                             <a href="{{ route('staffproducts.crud.listing') }}" class="btn btn-secondary px-4 py-2">
                                                 Close
                                             </a>
                                         </div>
                                     </div>
                        </div>
                    </div>
                </div>
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

       


        $('#sub_category').on('change', function() {
            let sub_category_id = $(this).find(":selected").attr("id");
            let url1 = '{{ route('getSpecifications') }}?sub_category_id=' + sub_category_id;
            let method1 = 'GET';
            getAjaxValue(url1, method1, function(data) {
                $('.spectable').empty();

                let specifications;


                $.each(data, function(key, spec) {

                    let options;
                    specifications +=
                        `<tr><td>${spec.name}</td><td>
                            <select class='form-select form-select-lg text-secondary' name='specify_value[]'>
                            <option selected value='' hidden> --Select ${spec.name}--</option>
                            ${(function fun(array) {
                                for (let index = 0; index < array.length; index++) {
                                    options += `<option value='${array[index]}'> ${array[index]}</option>`;
                                }
                                return options;
                            })(JSON.parse(spec.value))}
                        </select>
                        <input type="hidden" name="specify_attribute[]" value="${spec.name}">
                        </td></tr>`;
                });
                $(".spectable").append(specifications);
            });
        });


        //image preview
         //main image

         $("#mainImg").on("change", function(e) {
            //console.log(e);
            
            var files = e.target.files,
                filesLength = files.length;
            
            for (var i = 0; i < filesLength; i++) {
                var f = files[i]
                var fileReader = new FileReader();
                fileReader.onload = (function(e) {
                    var file = e.target;
                  
                    $("<div class='col-md-2'><span class=\"pip\">" +
                        "<img class=\"imageThumb\" src=\"" + e.target.result +
                        "\" title=\"" + file.name + "\"/>" +
                        "<br/><span class=\"remove\">Remove image</span>" +
                        "</span></div>").insertAfter("#ming_preview");
                    $(".remove").click(function() {
                        $(this).parent(".pip").remove();
                    });

                });
                fileReader.readAsDataURL(f);
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
           
            if (x < max_fields) { //max input box allowed
                x++; //text box increment
            $(wrapper).append('<hr style="color:black;size:3px;"><div class="w "><div class="row mt-2"><div class="col-md-3"> <div class="form-group flex"><div class="col-md-3"><span class="btn btn-primary btn-productimg"><i class="fa fa-cloud-upload" aria-hidden="true"></i> <input class="form-control add_product" type="file" id="p_mainimg'+x+'" name="mainimg[]" onchange="previewmainImg(this)"  accept="image/*"> </span><label class="text-secondary fw-bold">Upload main image</label> </div> <div class="col-md-3"> <span class="btn btn-primary btn-productimg"  > <i class="fa fa-cloud-upload" aria-hidden="true"></i> <input class="form-control add_product" type="file" id="subimg1'+x+'" onchange="previewsubImg1(this)" name="subimg1[]"  accept="image/*"> </span><label class="text-secondary">Upload Sub image1</label> </div> <div class="col-md-3"> <span class="btn btn-primary btn-productimg"  > <i class="fa fa-cloud-upload" aria-hidden="true"></i> <input class="form-control add_product" type="file" id="subimg2'+x+'" onchange="previewsubImg2(this)" name="subimg2[]"  accept="image/*"> </span><label class="text-secondary">Upload Sub image2</label> </div> <div class="col-md-3"> <span class="btn btn-primary btn-productimg" > <i class="fa fa-cloud-upload" aria-hidden="true"></i> <input class="form-control add_product" type="file" id="subimg3'+x+'" name="subimg3[]" onchange="previewsubImg3(this)" accept="image/*"> </span><label class="text-secondary">Upload Sub image2</label> </div><input type="hidden" name="product_details_id[]" placeholder=""class="form-control"></div></div><div class="col-md-9"> <div class="row"><div class="col-md-2"><select class="form-select form-select-lg text-secondary attrsize" name ="attrsize[]" placeholder="Size" id ="attrsize'+x+'"><option hidden>Size</option></select><div class="invalid-feedback-custom">Please select size</div></div><div class="col-md-2"><select class="form-select form-select-lg text-secondary attrcolor" name="attrcolor[]" id ="attrcolor'+x+'"><option hidden>Color</option></select><div class="invalid-feedback-custom">Please select color</div></div><div class="col-md-2"> <input type="text" name="retail_price[]" placeholder="Retail Price" class="form-control" required><div class="invalid-feedback-custom">Please enter retail price</div></div><div class="col-md-2"><input type="text" name="selling_price[]" placeholder="Selling Price" class="form-control" required><div class="invalid-feedback-custom">Please enter selling price</div></div><div class="col-md-2"><input type="number" class="form-control" placeholder="Qty" name="quantity[]" required><div class="invalid-feedback-custom">Please enter quantity</div></div> </div><div class="row mt-3"><div class="col-md-2"><input type="text" name="sku[]" placeholder="SKU"  class="form-control" required  ><div class="invalid-feedback-custom">Please enter SKU</div></div><div class="col-md-2"><select class="form-select form-select-lg text-secondary"  name="return_replace[]" required><option selected value="" hidden>Return /Replacement</option><option value="1">Return</option><option value="2">Replacement</option></select></div><div class="col-md-2"><input type="text" name="r_days[]" placeholder="Days"  class="form-control" required></div>  <div class="col-md-2"><input type="number" name="low_stock_limit[]"  placeholder="Low Stock Limit" class="form-control" required><div class="invalid-feedback-custom">Please enter low stock limit</div></div>  <div class="col-md-1 "> <a href="#" class="remove_field h6 btn btn-sm bg-warning m-0" style="text-decoration: none;background-color:red;">remove</a></div>  <div class="col-md-3"><span class="text-danger fw-bold" id="bill_month'+x+'_err"></span></div></div><br></div><div class="row "><div class="col-md-2"><div class="img-thumb-wrapper card shadow"> <img class="img-thumb" id="mainr1'+x+'"  src=""   /> <br/><span class="removeimg" id="removemainimg" value="mainimg">Remove</span> </div></div> <div class="col-md-2"><div class="img-thumb-wrapper card shadow"> <img class="img-thumb" id="sub1r1'+x+'"  src=""   /> <br/><span class="removeimg" id="removesub1img" value="subimg1">Remove</span> </div></div> <div class="col-md-2"><div class="img-thumb-wrapper card shadow"> <img class="img-thumb" id="sub2r1'+x+'"  src=""   /> <br/><span class="removeimg" id="removesub2img" value="subimg2">Remove</span> </div></div> <div class="col-md-2"><div class="img-thumb-wrapper card shadow"> <img class="img-thumb" id="sub3r1'+x+'"  src=""   /> <br/><span class="removeimg" id="removesub3img" value="subimg3">Remove</span> </div></div></div>'
                    ); //add input box
                           // $(wrapper).append('<hr style="color:black;size:3px;"><div class="w "><div class="row mt-2"><div class="col-md-3"> <div class="form-group"><label class="text-secondary fw-bold">Upload main image</label><input class="form-control " type="file" id="im'+x+'" onchange="previewImg(this)"  name="nproducts[]" accept="image/*"> <input type="hidden"name="product_details_id[]" placeholder=""class="form-control" required  value="0"></div></div><div class="col-md-9"> <div class="row"><div class="col-md-2"><select class="form-select form-select-lg text-secondary attrsize" name ="attrsize[]" id ="attrsize'+x+'"></select></div><div class="col-md-2"><select class="form-select form-select-lg text-secondary attrcolor" name="attrcolor[]" id ="attrcolor'+x+'"></select></div><div class="col-md-2"> <input type="text" name="retail_price[]" placeholder="Retail Price" class="form-control" required></div><div class="col-md-2"><input type="text" name="selling_price[]" placeholder="Selling Price" class="form-control" required></div><div class="col-md-2"><input type="number" class="form-control" placeholder="Qty" name="quantity[]" required></div> </div><div class="row mt-3"><div class="col-md-2"><input type="text" name="sku[]" placeholder="SKU"  class="form-control" required  ></div><div class="col-md-2"><select class="form-select form-select-lg text-secondary"  name="return_replace[]" required><option selected value="" hidden>Return /Replacement</option><option value="1">Return</option><option value="2">Replacement</option></select></div><div class="col-md-2"><input type="text" name="r_days[]" placeholder="Days"  class="form-control" required></div>  <div class="col-md-2"><input type="number" name="low_stock_limit[]"  placeholder="Low Stock Limit" class="form-control" required></div>  <div class="col-md-1 "> <a href="#" class="remove_field h6 btn btn-sm bg-warning m-0" style="text-decoration: none;background-color:red;">remove</a></div>  <div class="col-md-3"><span class="text-danger fw-bold" id="bill_month'+x+'_err"></span></div></div><br></div><div class="row " onload = "addmore()"" ><div class="col-md-12 " id="r'+x+'"></div> </div>'

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


   // Image previve main img
   function previewmainImg(a)
                {
                let idee=a.id; 
                   let file=$('#'+idee).prop('files'); 
                   
                const myArray = idee.split("p_mainimg");
                 let x =   myArray[1]; 
                    var thy = $(this);
                    
                    var img = document.getElementById('mainr1'+x);
                    var fi = $(a).attr('id');
                    if (file && file[0]) {                        
                    img.onload = () => {
                        URL.revokeObjectURL(img.src);  // no longer needed, free memory
                    }
                        img.src = URL.createObjectURL(file[0]); // set src to blob url
                    }  else{
                        img.src="";
                    }
                console.log(files);                             
                }

// Image previve sub img1
            function previewsubImg1(a)
                {                    
                let idee=a.id; 
                   let file=$('#'+idee).prop('files'); 
                 
                const myArray = idee.split("subimg1");
                 let x =   myArray[1]; 
                    var thy = $(this);
                    
                    var img = document.getElementById('sub1r1'+x);
                    var fi = $(a).attr('id');
                    if (file && file[0]) {                      
                      
                    img.onload = () => {
                        URL.revokeObjectURL(img.src);  // no longer needed, free memory
                    }                   
                        img.src = URL.createObjectURL(file[0]); // set src to blob url
                    }else{  
                                             
                        img.src="";
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
                    
                    var img = document.getElementById('sub2r1'+x);
                    var fi = $(a).attr('id');
                    if (file && file[0]) {                      
                        
                    img.onload = () => {
                        URL.revokeObjectURL(img.src);  // no longer needed, free memory
                    }                   
                        img.src = URL.createObjectURL(file[0]); // set src to blob url
                    }  else{  
                                             
                        img.src="";
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
                    
                    var img = document.getElementById('sub3r1'+x);
                    var fi = $(a).attr('id');
                    if (file && file[0]) {

                    img.onload = () => {
                        URL.revokeObjectURL(img.src);  // no longer needed, free memory
                    }
                        img.src = URL.createObjectURL(file[0]); // set src to blob url
                    }  else{
                        img.src="";
                    }
                 console.log(files);
                 }

    document.addEventListener('DOMContentLoaded', function() {
        const shouldSkipValidation = function(el) {
            const name = (el.getAttribute('name') || '').toLowerCase();
            return name === 'specification'
                || name.indexOf('sku[') === 0
                || name.indexOf('shipping_container') === 0;
        };

        const markRequiredInvalidFields = function(form) {
            form.querySelectorAll('input[required], select[required], textarea[required]').forEach(function(el) {
                if (el.disabled || shouldSkipValidation(el)) return;
                const value = (el.value || '').trim();
                if (value === '' || !el.checkValidity()) {
                    el.classList.add('invalid-field');
                } else {
                    el.classList.remove('invalid-field');
                }
            });

            // Main image validation (required if no existing image)
            const mainImgInput = form.querySelector('#productMainImgInput');
            const oldMainImgInput = form.querySelector('input[name="oldmainImage"]');
            if (mainImgInput && oldMainImgInput) {
                if (mainImgInput.value === '' && oldMainImgInput.value === '') {
                    mainImgInput.classList.add('invalid-field');
                    mainImgInput.setCustomValidity('Please upload main image');
                } else {
                    mainImgInput.classList.remove('invalid-field');
                    mainImgInput.setCustomValidity('');
                }
            }

            // Variant main images validation (required if no existing variant main image)
            form.querySelectorAll('input[name="mainimg[]"]').forEach(function(variantImgInput) {
                const container = variantImgInput.closest('.position-relative');
                if (container) {
                    const oldImgInput = container.querySelector('input[type="hidden"]');
                    if (oldImgInput) {
                        if (variantImgInput.value === '' && oldImgInput.value === '') {
                            variantImgInput.classList.add('invalid-field');
                            variantImgInput.setCustomValidity('Please upload variant main image');
                        } else {
                            variantImgInput.classList.remove('invalid-field');
                            variantImgInput.setCustomValidity('');
                        }
                    }
                }
            });
        };

        document.querySelectorAll('form').forEach(function(form) {
            // Reset custom validity on image change
            form.querySelectorAll('#productMainImgInput, input[name="mainimg[]"]').forEach(function(el) {
                el.addEventListener('change', function() {
                    el.setCustomValidity('');
                    el.classList.remove('invalid-field');
                });
            });
            form.querySelectorAll('input, select, textarea').forEach(function(el) {
                el.addEventListener('input', function() {
                    if (el.checkValidity()) {
                        el.classList.remove('invalid-field');
                    }
                });
                el.addEventListener('change', function() {
                    if (el.checkValidity()) {
                        el.classList.remove('invalid-field');
                    }
                });
            });

            form.querySelectorAll('button[type="submit"], input[type="submit"]').forEach(function(btn) {
                btn.addEventListener('click', function() {
                    form.classList.add('validation-attempted');
                    markRequiredInvalidFields(form);
                });
            });

            form.addEventListener('submit', function(e) {
                markRequiredInvalidFields(form);
                if (!form.checkValidity()) {
                    e.preventDefault();
                    e.stopPropagation();
                    form.classList.add('validation-attempted');
                    form.reportValidity();
                }
            });
        });
    });
    </script>
@endsection
