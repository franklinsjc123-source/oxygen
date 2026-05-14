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
        @include('paritials.vendorauth.sidemenu');
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

        .preview-container {
            display: flex;
            flex-wrap: wrap;
            gap: 10px;
        }

        .preview {
            width: 100px;
            height: 100px;
            overflow: hidden;
            border: 1px solid #ccc;
            position: relative;
        }

        .preview img {
            width: 100%;
            height: auto;
        }

        .remove-btn {
            position: absolute;
            top: 5px;
            right: 5px;
            background-color: rgba(255, 0, 0, 0.7);
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        /* Strong red required-field highlight after submit attempt */
        form.validation-attempted :is(input, select, textarea).form-control:invalid,
        form.validation-attempted :is(input, select, textarea).form-select:invalid,
        form.validation-attempted textarea:invalid {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
        }

        .invalid-field {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
        }

        /* Keep invalid inputs red even when focused (override bootstrap blue focus) */
        form.validation-attempted input.form-control.invalid-field,
        form.validation-attempted input.form-control.invalid-field:focus,
        form.validation-attempted select.form-control.invalid-field,
        form.validation-attempted select.form-control.invalid-field:focus,
        form.validation-attempted select.form-select.invalid-field,
        form.validation-attempted select.form-select.invalid-field:focus,
        form.validation-attempted textarea.invalid-field,
        form.validation-attempted textarea.invalid-field:focus {
            border-color: #dc3545 !important;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
            outline: 0 !important;
        }

        /* Select2 invalid state */
        form.validation-attempted select.select2-hidden-accessible:invalid + .select2-container .select2-selection {
            border: 1px solid #dc3545 !important;
            box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important;
        }
    </style>
        <div class="page-body text-secondary fcolor">
        <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="page-header-left">
                                    <h3>Add Product

                                    </h3>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <ol class="breadcrumb pull-right">
                                    <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i
                                                data-feather="home"></i></a>
                                    </li>
                                    <li class="breadcrumb-item active">Add Product</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->
        @if(!@$addinformation && !@$error)
        <!-- Container-fluid Ends-->
        <form action="{{ route('vendorproducts.addinfo') }}" method="post">
            @csrf
            <!-- Container-fluid starts-->
            <div class="container-fluid fcolor">
                <div class="row product-adding">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-xl-12">



                                <div class="card">
                                    <div class="card-body">
                                        <div class="col-md-12">
                                            <div class="row">
                                                @php
                                                    $categoryPairs = collect($CategorySub)
                                                        ->groupBy('category_id')
                                                        ->map(function ($items) {
                                                            return $items->first();
                                                        })
                                                        ->values();
                                                @endphp

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5 class="fw-bold">Main Category / Category</h5>
                                                        <div id="clothing">
                                                            <select class="js-select2 form-control" name="category"
                                                                id="main_category_category_vendor" required>
                                                                <option selected value="">Select Category</option>
                                                                @foreach ($categoryPairs as $pair)
                                                                    <option value="{{ $pair->category_id }}"
                                                                        data-main-category-id="{{ $pair->category_main_id }}">
                                                                        {{ $pair->category_main_name }} -> {{ $pair->category_name }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                            <input type="hidden" name="category_main" id="category_main_hidden_vendor" value="">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5 class="fw-bold">Sub Category</h5>
                                                        <div id="clothing">
                                                            <select class="js-select2 form-control" name="category_sub"
                                                                id="sub_category_initial_vendor" disabled required>
                                                                <option selected  value="">Select
                                                                    Category
                                                                </option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <h5 class="fw-bold">Attribute</h5>
                                                        <div id="clothing">
                                                            <select class="js-select2 form-control" name="selected_attribute_id"
                                                                id="attribute_group_initial_vendor" disabled required>
                                                                <option selected value="">Select Attribute</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <h5 class="fw-bold">Is Color Available?</h5>
                                                        <div id="clothing">
                                                            <select class="form-control" name="is_color" id="is_color" required>
                                                                <option value="yes" selected>Yes</option>
                                                                <option value="no">No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <h5 class="fw-bold">No.of Products</h5>
                                                        <div id="clothing">
                                                            <select class="js-select2 form-control" name="nproduct"
                                                                id="nproduct" required>

                                                                <option value="1" selected> 1</option>
                                                                <option value="2">2</option>
                                                                <option value="3">3</option>
                                                                <option value="4">4</option>
                                                                <option value="5">5</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <h5 class="fw-bold">Add Product Informations</h5>
                                                        <div id="clothing">
                                                            <button type="submit" class="btn btn-primary"> Add Informations </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        @elseif(@$error)

        <div class="container-fluid fcolor">
            <div class="row product-adding">
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-xl-12">

                            <div class="card">
                                <div class="card-body">
                                    <div class="col-md-12">
                                        <div class="alert alert-warning alert-dismissible">
                                            <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                                            <strong>Warning!</strong> {{ $error }}
                                        </div>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5 class="fw-bold"> Primary / Main Category</h5>
                                                    <div class="form-group">
                                                        <select class="js-select2 form-control" id="main_category"
                                                            name="category_main" disabled required>
                                                            <option selected hidden value="">-- Select --
                                                            </option>
                                                            @foreach ($category_main_data as $category_main)
                                                            <option id="{{ $category_main->id }}"
                                                                value="{{ $category_main->id}}" {{(@$maincategoryid==$category_main->id)?'Selected':'';}}>
                                                                {{ $category_main->category_main_name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5 class="fw-bold">Category</h5>
                                                    <div id="clothing">
                                                        <select class="js-select2 form-control" name="category"
                                                            id="category" disabled required>
                                                            @foreach ($category_data as $category)
                                                            <option id="{{ $category->id }}"
                                                                value="{{ $category->id}}" {{(@$categoryid==$category->id)?'Selected':'';}}>
                                                                {{ $category->category_name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h5 class="fw-bold">Sub Category</h5>
                                                    <div id="clothing">
                                                        <select class="js-select2 form-control" name="category_sub"
                                                            id="sub_category" disabled required>
                                                            @foreach ($category_sub_data as $category_sub)
                                                            <option id="{{ $category_sub->id }}"
                                                                value="{{ $category_sub->id}}" {{(@$subcategoryid==$category_sub->id)?'Selected':'';}}>
                                                                {{ $category_sub->category_sub_name }}
                                                            </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <h5 class="fw-bold">No.of Products</h5>
                                                    <div id="clothing">
                                                        <select class="js-select2 form-control" name="nproduct"
                                                            id="sub_category" disabled required>

                                                            <option value="1" {{(@$nproduct=="1")?'Selected':'';}}> 1</option>
                                                            <option value="2" {{(@$nproduct=="2")?'Selected':'';}}>2</option>
                                                            <option value="3" {{(@$nproduct=="3")?'Selected':'';}}>3</option>
                                                            <option value="4" {{(@$nproduct=="4")?'Selected':'';}}>4</option>
                                                            <option value="5" {{(@$nproduct=="5")?'Selected':'';}}>5</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <a href="{{ url('vendor/productscreate') }}" class="btn btn-warning"> Back </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if(@$addinformation)
            <form action="{{ route('vendorproducts.crud.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                @if(!empty($selectedAttributeId))
                    <input type="hidden" name="selected_attribute_id" value="{{ $selectedAttributeId }}">
                @endif
                <!-- Container-fluid starts-->
                

                <!-- Container-fluid starts-->
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
                                                                name="category_main1" disabled required>
                                                                <option selected hidden value="">-- Select --
                                                                </option>
                                                                @foreach ($category_main_data as $category_main)
                                                                <option id="{{ $category_main->id }}"
                                                                    value="{{ $category_main->id}}" {{(@$maincategoryid==$category_main->id)?'Selected':'';}}>
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
                                                            <select class="js-select2 form-control" name="category1"
                                                                id="category" disabled required>
                                                                @foreach ($category_data as $category)
                                                                <option id="{{ $category->id }}"
                                                                    value="{{ $category->id}}" {{(@$categoryid==$category->id)?'Selected':'';}}>
                                                                    {{ $category->category_name }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5 class="fw-bold">Sub Category</h5>
                                                        <div id="clothing">
                                                            <select class="js-select2 form-control" name="category_sub1"
                                                                id="sub_category" disabled required>
                                                                @foreach ($category_sub_data as $category_sub)
                                                                <option id="{{ $category_sub->id }}"
                                                                    value="{{ $category_sub->id}}" {{(@$subcategoryid==$category_sub->id)?'Selected':'';}}>
                                                                    {{ $category_sub->category_sub_name }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <h5 class="fw-bold">Attribute</h5>
                                                        <div id="clothing">
                                                            <select class="js-select2 form-control" name="selected_attribute_id1"
                                                                id="selected_attribute_summary" disabled required>
                                                                @foreach ($attribute as $attr)
                                                                    <option value="{{ $attr->id }}" {{ $selectedAttributeId == $attr->id ? 'selected' : '' }}>
                                                                        {{ $attr->attribute_group_refname }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <h5 class="fw-bold">Color Available?</h5>
                                                        <div id="clothing">
                                                            <select class="form-control" name="is_color_summary" id="is_color_summary" disabled required>
                                                                <option value="yes" {{(@$is_color=="yes")?'Selected':'';}}>Yes</option>
                                                                <option value="no" {{(@$is_color=="no")?'Selected':'';}}>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <h5 class="fw-bold">No.of Products</h5>
                                                        <div id="clothing">
                                                            <select class="js-select2 form-control" name="nproduct1"
                                                                id="nproduct_summary" disabled required>

                                                                <option value="1" {{(@$nproduct=="1")?'Selected':'';}}> 1</option>
                                                                <option value="2" {{(@$nproduct=="2")?'Selected':'';}}>2</option>
                                                                <option value="3" {{(@$nproduct=="3")?'Selected':'';}}>3</option>
                                                                <option value="4" {{(@$nproduct=="4")?'Selected':'';}}>4</option>
                                                                <option value="5" {{(@$nproduct=="5")?'Selected':'';}}>5</option>

                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 d-flex align-items-end">
                                                    <div class="form-group w-100">
                                                        <a href="{{ url('vendor/productscreate') }}" class="btn btn-warning w-100 fw-bold py-2 mb-1"> CLEAR </a>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="category_main" value="{{@$maincategoryid}}">
                                                <input type="hidden" name="category" value="{{@$categoryid}}">
                                                <input type="hidden" name="category_sub" value="{{@$subcategoryid}}">
                                                <input type="hidden" name="nproduct" value="{{@$nproduct}}">
                                                <input type="hidden" name="is_color" value="{{@$is_color}}">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card">
                                        <div class="card-body">

                                            <div class="col-md-12 digital-add needs-validation">
                                                <div class="row">
                                                    <div class="col-md-9">
                                                        <div class="form-group mt-2">
                                                            <label for=""
                                                                class="col-form-label pt-0 fw-bold"><span>*</span> Product
                                                                Name</label>
                                                            <input class="form-control" id="validationCustom01"
                                                                type="text" name="product_name" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <label class="col-form-label  fw-bold"><span
                                                                class="text-danger">*</span>Product Status</label>
                                                        <select class="custom-select form-control text-secondary"
                                                            id="gs" onchange="r()" name="tax_id" required>
                                                            <option value="" hidden>--Select Status--</option>
                                                            <option value="1" selected>Active</option>
                                                            <option value="0">De-Active</option>
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="card">
                                                    <div class="card-header">
                                                        <h5><span style="color: red;">*</span>Product Images</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                            <div class="col-md-3">
                                                                <h6>Upload Main Image</h6>
                                                                <input class="form-control" type="file" id="mainImg" accept="image/*"
                                                                    name="mainImage" required/>

                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="col-form-label col-md-3 fw-bold"><span
                                                                        class="text-danger">*</span>Tax</label>
                                                                <select class="custom-select form-control text-secondary"
                                                                    id="gs" onchange="r()" name="tax_id" required>
                                                                    <option value="" selected hidden>--Select Tax Type--</option>
                                                                    <option value="1">Included</option>
                                                                    <option value="0">Excluded</option>
                                                                </select>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <label class="col-form-label col-md-3 fw-bold "><span
                                                                        class="text-danger">*</span>GST</label>
                                                                <select class="custom-select form-control dropdown text-secondary"
                                                                    id="gst1" onchange="r()" required name="gst_id">
                                                                    <option value="" selected hidden value="">--Select
                                                                        GST %--</option>
                                                                    @foreach ($gst as $gs)
                                                                    <option value="{{ $gs->value }}">{{ $gs->gst_name }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="col-form-label  fw-bold"><span
                                                                        class="text-danger">*</span>HSN CODE</label>
                                                                <input class="form-control" id="validationCustom01"
                                                                    type="text" name="hsncode" >
                                                            </div>
                                                        </div>
                                                        <div class="row" id="ming_preview">
                                                        </div>
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="card">
                                                <div class="card-header">
                                                    <h5>Product Description</h5>
                                                </div>
                                                <div class="card-body">
                                                    <div class="digital-add needs-validation">
                                                        <div class="form-group mb-0">
                                                            <div class="description-sm">
                                                                <textarea id="description" cols="10" rows="4" name="description"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @for($i=1;$i<=$nproduct;$i++)
                        <div class="col-md-12">

                        <div class="card p-3">
                            <div class="card-header">
                                <h5>Product {{ $i }} Informations </h5>
                            </div>
                            <div class="card-body ">


                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group p-1">
                                            <label style="color:blue">(Upload Format : jpg, jpeg, png, web)</label>

                                            <input type="file" id="imageUpload{{ $i }}" name="imageUpload{{ $i }}[]" multiple accept="image/*" onchange="previewImages({{ $i }})">

                                        </div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label>SKU</label>
                                        <input type="text" name="sku[{{ $i }}]" placeholder="SKU"
                                            class="form-control">
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label> Return </label>
                                        <select class="form-select form-select-lg text-secondary"
                                            name="return_replace[{{ $i }}]">

                                            <option selected value="">Select</option>
                                            <option value="Return">
                                                Return
                                            </option>

                                            <option value="Replacement">
                                                Replacement
                                            </option>

                                        </select>
                                    </div>

                                    <div class="form-group col-md-2">
                                        <label> Return Days</label>
                                        <input type="text" name="r_days[{{ $i }}]" placeholder="Days"
                                            class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <div id="previewContainer{{ $i }}" class="row"></div>
                                    </div>

                                </div>
                                <div id="productinfo{{ $i }}">
                                    <hr>
                                    <div class="row">
                                        @if(@$is_color != 'no')
                                        <div class="form-group col-md-3">
                                                <label><span
                                                                            class="text-danger">*</span> Color </label>
                                                <input type="hidden" name="attributecolorname[{{ $i }}][]" value="Color">
                                                <select class="form-select form-select-lg text-secondary attrcolor{{ $i }}"
                                                    name="attributecolorval[{{ $i }}][]" id="attrcolor{{ $i }}" required>
                                                    <option selected value='' hidden> --Select Color--</option>
                                                    @foreach( $colors as $color)
                                                    <option value='{{ $color->color_name }}' style="background-color: {{ $color->color_code }}"> {{ $color->color_name }} </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        @else
                                            <input type="hidden" name="attributecolorname[{{ $i }}][]" value="Color">
                                            <input type="hidden" name="attributecolorval[{{ $i }}][]" value="Multicolor">
                                        @endif
                                        @php $j=0; @endphp
                                        @foreach ($attribute as $attri)
                                        @php
                                        $attri_val = json_decode($attri->attribute_values, true) ?: [];
                                       

                                        @endphp
                                        <div class="form-group col-md-3">
                                            <label><span
                                                                        class="text-danger">*</span> {{ $attri->attribute_group_refname}} </label>
                                            <input type="hidden" name="attributename[{{ $i }}][{{ $j }}][]" value="{{ $attri->attribute_group_refname}}">
                                            <select class="form-select form-select-lg text-secondary attrsize"
                                                name="attributeval[{{ $i }}][{{ $j }}][]" id="attrsize" required>
                                                <option selected value='' hidden> --Select {{ $attri->attribute_group_refname}}--</option>
                                                @foreach( $attri_val as $attval)
                                                <option value='{{ $attval }}'> {{ $attval }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        @php $j++; @endphp
                                        @endforeach
                                        <input type="hidden" name="attributecount" value="{{ $j}}">
                                            
                                    </div>
                                    <div class="row">
                                        <div class="form-group col-md-3">
                                            <label><span
                                                                        class="text-danger">*</span> MRP</label>
                                            <input type="number" name="retail_price[{{ $i }}][]"
                                                placeholder="Retail Price" class="form-control" required>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label><span
                                                                        class="text-danger">*</span> Selling Price</label>
                                            <input type="number" name="selling_price[{{ $i }}][]"
                                                placeholder="Selling Price" class="form-control" required>
                                        </div>

                                        <div class="form-group col-md-3">
                                            <label><span
                                                                        class="text-danger">*</span> Quantity</label>
                                            <input type="number" class="form-control"
                                                placeholder="Qty" name="quantity[{{ $i }}][]" required>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label><span
                                                                        class="text-danger">*</span> Low Stock Limit</label>
                                            <input type="number" id="low_stock_limit" name="low_stock_limit[{{ $i }}][]"
                                                placeholder="Low Stock Limit" class="form-control" required>
                                        </div>
                                    </div>
                                </div>
                                <div id="productmoreinfo{{ $i }}">
                                </div>
                                <div class="text-start mt-3">
                                    <button type="button" id="add-more" class="add_field_button add-more btn btn-primary" onclick="addmoreinfo('{{ $i }}')">
                                        + Add more
                                    </button>

                                </div>



                            </div>
                        </div>

                </div>
                @endfor
                <div class="col-md-12">
                    <div class="row">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="card p-3">
                                    <div class="card-body ">
                                        <div class="form-group">
                                            <div class="row">
                                                <h4 class="text-start fw-bold ">Shipping</h4>
                                                <div class="card-body">
                                                    <div class="row">
                                                        <div class="col-md-3">
                                                            <div class="next-input--stylized">
                                                                <input type="number" class="form-control"
                                                                    name="weight" placeholder="Weight (g)">
                                                            </div>
                                                        </div>

                                                        <div class="col-md-3">
                                                            <div class="form-group mb-3">
                                                                <div class="next-input--stylized">
                                                                    <input type="number" class="form-control"
                                                                        placeholder="Length (cm)" name="length"
                                                                        value="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group mb-3">
                                                                <div class="next-input--stylized">
                                                                    <input type="number" class="form-control"
                                                                        name="width" placeholder="Width (cm)">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3 ">
                                                            <div class="form-group mb-3">
                                                                <div class="next-input--stylized">

                                                                    <input type="number" class="form-control"
                                                                        name="height" placeholder="Height (cm)">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-12">
                            <div class="row">
                                <div class="col-xl-12">
                                    <div class="card p-3">
                                        <div class="card-body">
                                            <div class="conatiner">
                                                <div class="row mt-3">
                                                    <div class="col-md-12 ">
                                                        <h4 class="fw-bold">Specification</h4>
                                                    </div>
                                                    <div class="col-md-2 text-start">
                                                        <span class="text-dark fw-bold"
                                                            id="specify_length"></span>
                                                    </div>

                                                </div>
                                                <table class="table table-bordered ">
                                                    <tbody class="spectable">
                                                        @if(!empty($specification))
                                                        @foreach (collect($specification)->chunk(2) as $specPair)
                                                        <tr>
                                                            @foreach ($specPair as $spec)
                                                            @php
                                                            $spec_val = json_decode($spec->specification_values, true) ?: [];
                                                            @endphp
                                                            <td style="width: 20%; vertical-align: middle;">{{ $spec->specification_group_name }}</td>
                                                            <td style="width: 30%;">
                                                                <input type="hidden" name="spec_id[]" value="{{ $spec->id }}">
                                                                <select class='form-select form-select-lg text-secondary' name='specify_value[{{ $spec->id}}]'>
                                                                    <option selected value='' hidden> --Select {{ $spec->specification_group_name}}--</option>
                                                                    @foreach( $spec_val as $spval )
                                                                    <option value='{{ $spval }}'> {{ $spval }}</option>
                                                                    @endforeach
                                                                </select>
                                                                <input type="hidden" name="specify_attribute[{{ $spec->id}}]" value="{{ $spec->specification_group_name}}">
                                                            </td>
                                                            @endforeach
                                                            @if($specPair->count() === 1)
                                                            <td></td>
                                                            <td></td>
                                                            @endif
                                                        </tr>
                                                        @endforeach
                                                        @endif
                                                    </tbody>
                                                </table>

                                            </div>
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
                                                    <div class="col-md-3">
                                                        <select class="form-select form-select-lg text-secondary"
                                                            id="offtype" name="offers">
                                                            <option value="">Select</option>


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
                                                                <option value="{{ $offer->id }}">
                                                                    {{ $offerLabel }}
                                                                </option>
                                                            @endforeach
                                                            {{-- <option value="Buy 3 Get 1 Free">Buy 3 Get 1 Free
                                                                    </option>
                                                                    <option value="Buy 1 Get 1 Free">Buy 1 Get 1 Free
                                                                    </option>
                                                                    <option value="Buy 3 @ 999">Buy 3 @ 999</option>
                                                                    <option value="None">None</option> --}}
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                    </div>
                                                    <div class="col-md-1">
                                                        <label class="text-center  fw-bold mt-2">Collection</label>
                                                    </div>
                                                    <div class="col-md-4 ">
                                                        <select class="form-select form-select-lg text-secondary"
                                                            id="collection" name="collection">
                                                             <option selected hidden value="">Select Here
                                                            </option>
                                                            @foreach ($productcollection as $productcollection)
                                                            <option id="{{ $productcollection->id }}"
                                                                value="{{ $productcollection->name }}">
                                                                {{ $productcollection->name }}
                                                            </option>
                                                            @endforeach
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
                                            type="submit">
                                            Save
                                        </button>
                                    </div>
                                    <div class="d-inline px-2 text-white">
                                        <a href="{{ route('vendorproducts.crud.listing') }}" class="btn btn-secondary w-100 " type="button">
                                            Close
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
            @endif
        </div>
    </div>


    <script type="text/javascript">
    const vendorSubCategories = @json($CategorySub);
    const vendorAttributeUrl = "{{ route('vendor.getSubCategoryAttributes') }}";

    $('#main_category_category_vendor').on('change', function() {
        const selectedOption = $(this).find(':selected');
        const categoryId = selectedOption.val();
        const mainCategoryId = selectedOption.data('main-category-id') || '';

        $('#category_main_hidden_vendor').val(mainCategoryId);

        const $sub = $('#sub_category_initial_vendor');
        const $attribute = $('#attribute_group_initial_vendor');
        $sub.empty().append('<option selected value="">Select Category</option>');
        $attribute.empty().append('<option selected value="">Select Attribute</option>');
        $attribute.prop('disabled', true);
        $attribute.prop('required', false);

        if (!categoryId) {
            $sub.attr('disabled', true);
            return;
        }

        const filtered = (vendorSubCategories || []).filter(function(item) {
            return String(item.category_id) === String(categoryId);
        });

        filtered.forEach(function(item) {
            $sub.append('<option value="' + item.id + '">' + item.category_sub_name + '</option>');
        });

        $sub.removeAttr('disabled');
    });

    $('#sub_category_initial_vendor').on('change', function() {
        const subCategoryId = $(this).val();
        const $attribute = $('#attribute_group_initial_vendor');

        $attribute.empty().append('<option selected value="">Select Attribute</option>');
        if (!subCategoryId) {
            $attribute.prop('disabled', true);
            $attribute.prop('required', false);
            return;
        }

        $.ajax({
            url: vendorAttributeUrl,
            type: 'GET',
            dataType: 'json',
            data: {
                sub_category_id: subCategoryId
            },
            success: function(data) {
                if (Array.isArray(data) && data.length > 0) {
                    data.forEach(function(attr) {
                        $attribute.append('<option value="' + attr.id + '">' + attr.attribute_group_refname + '</option>');
                    });
                    $attribute.prop('disabled', false);
                    $attribute.prop('required', true);
                } else {
                    $attribute.append('<option value="">No attributes available</option>');
                    $attribute.prop('disabled', true);
                    $attribute.prop('required', false);
                }
            },
            error: function() {
                $attribute.append('<option value="">Unable to load attributes</option>');
                $attribute.prop('disabled', true);
                $attribute.prop('required', false);
            }
        });
    });

    $(document).ready(function() {


        $("#galleryImg").on("change", function(e) {
            console.log(e);
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
                        "<br/><span class=\"remove\">Raemove image</span>" +
                        "</span>").insertAfter("#galleryImg");
                    $(".remove").click(function() {
                        $(this).parent(".pip").remove();
                    });

                });
                fileReader.readAsDataURL(f);
            }
        });

        //main image

        $("#mainImg").on("change", function(e) {
            var files = e.target.files || [];
            var $preview = $("#ming_preview");
            $preview.empty();

            if (!files.length) {
                return;
            }

            for (var i = 0; i < files.length; i++) {
                var f = files[i];
                var fileReader = new FileReader();
                fileReader.onload = (function(evt) {
                    var html = "<div class='col-md-2'><span class=\"pip\">" +
                        "<img class=\"imageThumb\" src=\"" + evt.target.result + "\"/>" +
                        "<br/><span class=\"remove remove-mainimg-preview\">Remove image</span>" +
                        "</span></div>";
                    $preview.append(html);
                });
                fileReader.readAsDataURL(f);
            }
        });

        $(document).on("click", ".remove-mainimg-preview", function() {
            $(this).closest(".col-md-2").remove();
        });

    });
</script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const shouldSkipValidation = function(el) {
            const name = (el.getAttribute('name') || '').toLowerCase();
            return name === 'description'
                || name === 'specification'
                || name === 'hsncode'
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
        };

        document.querySelectorAll('form').forEach(function(form) {
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

    function previewImages(id) {
        const imageUpload = document.getElementById('imageUpload' + id);
        const previewContainer = document.getElementById('previewContainer' + id);
        const files = Array.from(imageUpload.files);

        previewContainer.innerHTML = ''; // Clear previous previews

        files.slice(0, 4).forEach(file => {
            const reader = new FileReader();

            reader.onload = function(event) {
                const imgElement = document.createElement('img');

                const previewDiv = document.createElement('div');
                previewDiv.classList.add('col-md-2', 'preview');

                imgElement.src = event.target.result;

                const removeBtn = document.createElement('button');
                removeBtn.innerText = 'X';
                removeBtn.classList.add('remove-btn');
                removeBtn.onclick = function() {
                    previewDiv.remove(); // Remove the image preview
                };

                previewDiv.appendChild(imgElement);
                previewDiv.appendChild(removeBtn);
                previewContainer.appendChild(previewDiv);
            };

            reader.readAsDataURL(file);
        });
    }

    function addmoreinfo(id) {

        var productinfo = $('#productinfo' + id).clone();
        productinfo.find('[id]').removeAttr('id');
        var selectedColor = $('#attrcolor' + id).val() || '';
        var colorSelect = productinfo.find('.attrcolor' + id).first();
        if (colorSelect.length) {
            colorSelect.val(selectedColor);
            colorSelect.prop('disabled', true);
            colorSelect.removeAttr('required');
            var colorFieldName = colorSelect.attr('name');
            colorSelect.removeAttr('name');
            productinfo.append('<input type="hidden" class="cloned-color-hidden" name="' + colorFieldName + '" value="' + selectedColor + '">');
        }
        var removeBtn = $('<button class="btn btn-danger">Remove</button>');
        removeBtn.click(function() {
            $(this).parent().remove(); // Remove the parent div
        });
        // Append the remove button and the cloned div to the target div
        productinfo.append(removeBtn);
        $('#productmoreinfo' + id).append(productinfo);
    }
</script>
    
@endsection

{{-- <div class='col-md-2'><div class="img-thumb-wrapper card shadow"> <img class="img-thumb" id="mainr1"  src=""   /> <br/><span class="removeimg" id="removemainimg" value="mainimg">REEemove</span> </div></div> <div class='col-md-2'><div class="img-thumb-wrapper card shadow"> <img class="img-thumb" id="sub1r1"  src=""   /> <br/><span class="removeimg" id="removesub1img" value="subimg1">REEemove</span> </div></div> <div class='col-md-2'><div class="img-thumb-wrapper card shadow"> <img class="img-thumb" id="sub2r1"  src=""   /> <br/><span class="removeimg" id="removesub2img" value="subimg2">REEemove</span> </div></div> <div class='col-md-2'><div class="img-thumb-wrapper card shadow"> <img class="img-thumb" id="sub3r1"  src=""   /> <br/><span class="removeimg" id="removesub3img" value="subimg3">REEemove</span> </div></div> --}}


{{-- <div class="col-md-3"><span class="btn btn-primary btn-productimg"><i class="fa fa-cloud-upload" aria-hidden="true"></i> <input class="form-control add_product" type="file" id="mainimg" name="mainimg[]"  accept="image/*"> </span><label class="text-secondary fw-bold">Upload main image</label> </div> <div class="col-md-3"> <span class="btn btn-primary btn-productimg"  > <i class="fa fa-cloud-upload" aria-hidden="true"></i> <input class="form-control add_product" type="file" id="subimg1" name="subimg1[]"  accept="image/*"> </span><label class="text-secondary">Upload Sub image1</label> </div> <div class="col-md-3"> <span class="btn btn-primary btn-productimg"  > <i class="fa fa-cloud-upload" aria-hidden="true"></i> <input class="form-control add_product" type="file" id="subimg2" name="subimg2[]"  accept="image/*"> </span><label class="text-secondary">Upload Sub image2</label> </div> <div class="col-md-3"> <span class="btn btn-primary btn-productimg" > <i class="fa fa-cloud-upload" aria-hidden="true"></i> <input class="form-control add_product" type="file" id="subimg3" name="subimg3[]"  accept="image/*"> </span><label class="text-secondary">Upload Sub image2</label> </div> --}}

