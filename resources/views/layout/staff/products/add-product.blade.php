@extends('layout.auth.master')
@section('contents')
@include('paritials.css.product.add-product-css')
@include('paritials.js.product.add-product-js')



<!-- page-wrapper Start-->
@include('paritials.auth.topmenu');
<!-- Page Header Ends -->

<!-- Page Body Start   -->
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
            /* border-color: #dc3545 !important; */
            /* box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important; */
        }

        .invalid-field {
            /* border-color: #dc3545 !important; */
            /* box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important; */
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
            /* border-color: #dc3545 !important; */
            /* box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important; */
            /* outline: 0 !important; */
        }

        /* Select2 invalid state */
        form.validation-attempted select.select2-hidden-accessible:invalid + .select2-container .select2-selection {
            /* border: 1px solid #dc3545 !important; */
            /* box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25) !important; */
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

        .variant-card .variant-fields-wrapper:first-of-type .remove-size-row-inline-btn {
            display: none !important;
        }
        .variant-card .variant-fields-wrapper:first-of-type .add-size-row-inline-btn {
            display: inline-block !important;
        }
        .variant-card .variant-fields-wrapper ~ .variant-fields-wrapper label {
            display: none !important;
        }
        .variant-card .variant-fields-wrapper ~ .variant-fields-wrapper .add-size-row-inline-btn {
            display: none !important;
        }
        .variant-card .variant-fields-wrapper ~ .variant-fields-wrapper .remove-size-row-inline-btn {
            display: inline-block !important;
        }
        .variant-card .variant-fields-wrapper ~ .variant-fields-wrapper {
            margin-top: 15px;
        }
        .variant-card {
            border: 1px solid #e3e6f0;
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.05);
            background-color: #fff;
            margin-bottom: 1.5rem;
        }
        .variant-card-header {
            background-color: #f8f9fc;
            border-bottom: 1px solid #e3e6f0;
            padding: 0.75rem 1.25rem;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .img-preview-box {
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #f8f9fc;
            border: 1px dashed #dddfeb;
            border-radius: 4px;
        }
        .img-thumb {
            max-height: 75px;
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 2px;
            cursor: pointer;
            background-color: #fff;
        }
        .btn-productimg {
            position: relative;
            overflow: hidden;
            display: inline-block;
        }
        .btn-productimg input[type=file] {
            position: absolute;
            top: 0;
            right: 0;
            min-width: 100%;
            min-height: 100%;
            font-size: 100px;
            text-align: right;
            filter: alpha(opacity=0);
            opacity: 0;
            outline: none;   
            cursor: inherit;
            display: block;
        }
    </style>
    <div class="page-body text-secondary fcolor">

        <!-- Container-fluid starts-->
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
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}"><i
                                        data-feather="home"></i></a>
                            </li>
                            <li class="breadcrumb-item active">Add Product</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        @if(!@$addinformation && !@$error)
        <!-- Container-fluid Ends-->
        <form action="{{ route('staffproducts.addinfo') }}" method="post">
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
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bold text-dark" >Vendor</label>
                                                        <div id="clothing">
                                                            <select class="js-select2 form-control" name="vendorlist"
                                                                id="vendorlist"  required>
                                                                <option value="">Select Vendor
                                                                    </option>
																@foreach ($vendorlist as $vendor)
                                                                <option id="{{ $vendor->id }}"
                                                                    value="{{ $vendor->id}}">
                                                                    {{ $vendor->shop_name }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <h5 class="fw-bold">Main Category / Category</h5>
                                                        <div class="form-group">
                                                            <select class="js-select2 form-control" id="main_category_category"
                                                                name="category" required>
                                                                <option selected hidden value="">-- Select Category --
                                                                </option>
                                                                @foreach ($category_data_all as $category_item)
                                                                <option value="{{ $category_item->id }}"
                                                                    data-main-category-id="{{ $category_item->main_category_id }}">
                                                                    {{ $category_item->category_main_name }} -> {{ $category_item->category_name }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                            <input type="hidden" id="category_main" name="category_main" value="">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                <div class="col-md-3">
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
                                                <div class="col-md-4">
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
                                                <div class="col-md-4">
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
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <h5 class="fw-bold">Add Product Informations</h5>
                                                        <div id="clothing">
                                                            <button type="submit" class="btn btn-primary w-100"> Add Informations </button>
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
                                                <a href="{{ url('admin/category_sub') }}" class="btn btn-warning"> Go to Sub Category </a>
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
        <form action="{{ route('staffproducts.crud.store') }}" method="post" enctype="multipart/form-data">
            @csrf
            @if(!empty($selectedAttributeId))
                <input type="hidden" name="selected_attribute_id" value="{{ $selectedAttributeId }}">
            @endif
            
            <div class="container-fluid fcolor">
                <div class="row product-adding">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-xl-12">

                                <div class="card">
                                    <div class="card-body">
                                        <div class="col-md-12">
                                            <div class="row">
                                            <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bold text-dark" >Vendor</label>
                                                        <div id="clothing">
                                                            <select class="js-select2 form-control" name="vendorlist"
                                                                id="vendorlist" disabled required>
                                                                <option value="">Select Vendor
                                                                    </option>
																@foreach ($vendorlist as $vendor)
                                                                <option id="{{ $vendor->id }}"
                                                                    value="{{ $vendor->id}}" {{(@$vendorid==$vendor->id)?'Selected':'';}}>
                                                                    {{ $vendor->shop_name }}
                                                                </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bold text-dark">Primary / Main Category</label>
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
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bold text-dark">Category</label>
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
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bold text-dark">Sub Category</label>
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
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bold text-dark">Attribute</label>
                                                        <div id="clothing">
                                                            <select class="js-select2 form-control" name="selected_attribute_id1"
                                                                id="selected_attribute_summary" disabled required>
                                                                @foreach ($attribute as $attr)
                                                                    <option value="{{ $attr->id }}" {{ (@$selectedAttributeId == $attr->id) ? 'selected' : '' }}>
                                                                        {{ $attr->attribute_group_refname }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="form-label fw-bold text-dark">Color Available?</label>
                                                        <div id="clothing">
                                                            <select class="form-control" name="is_color_summary" id="is_color_summary" disabled required>
                                                                <option value="yes" {{(@$is_color=="yes")?'Selected':'';}}>Yes</option>
                                                                <option value="no" {{(@$is_color=="no")?'Selected':'';}}>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <input type="hidden" name="category_main" value="{{@$maincategoryid}}">
                                                <input type="hidden" name="category" value="{{@$categoryid}}">
                                                <input type="hidden" name="category_sub" value="{{@$subcategoryid}}">
                                                <input type="hidden" name="nproduct" value="{{@$nproduct}}">
                                                <input type="hidden" name="vendorid" value="{{@$vendorid}}">
                                                <input type="hidden" name="is_color" value="{{@$is_color}}">
                                                <div class="col-md-4 d-flex align-items-end">
                                                    <div class="form-group w-100">
                                                        <a href="{{ url('admin/products_crud') }}" class="btn btn-warning w-100 fw-bold py-2 mb-1"> CLEAR </a>
                                                    </div>
                                                </div>
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
                                                                class="form-label fw-bold text-dark">Product Name <span class="text-danger">*</span></label>
                                                            <input class="form-control" id="validationCustom01"
                                                                type="text" name="product_name" required>
                                                            <div class="invalid-feedback-custom">Please enter product name</div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mt-2">
                                                            <label class="form-label fw-bold text-dark">Product Status <span class="text-danger">*</span></label>
                                                            <select class="custom-select form-control text-secondary"
                                                                id="status" name="status" required>
                                                                <option value="" hidden>--Select Status--</option>
                                                                <option value="1" selected>Active</option>
                                                                <option value="0">De-Active</option>
                                                            </select>
                                                            <div class="invalid-feedback-custom">Please select product status</div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="card shadow-sm border-0 mb-4">
                                                    <div class="card-body p-4">
                                                        <div class="row g-3">
                                                            <div class="col-md-3">
                                                                <label class="form-label fw-bold text-dark">Tax <span class="text-danger">*</span></label>
                                                                <select class="custom-select form-control text-secondary"
                                                                    id="gs" onchange="r()" name="tax_id" required>
                                                                    <option value="" selected hidden>--Select Tax Type--</option>
                                                                    <option value="1">Included</option>
                                                                    <option value="0">Excluded</option>
                                                                </select>
                                                                <div class="invalid-feedback-custom">Please select tax type</div>
                                                            </div>

                                                            <div class="col-md-3">
                                                                <label class="form-label fw-bold text-dark">GST <span class="text-danger">*</span></label>
                                                                <select class="custom-select form-control dropdown text-secondary"
                                                                    id="gst1" onchange="r()" required name="gst_id">
                                                                    <option value="" selected hidden value="">--Select
                                                                        GST %--</option>
                                                                    @foreach ($gst as $gs)
                                                                    <option value="{{ $gs->value }}">{{ $gs->gst_name }}
                                                                    </option>
                                                                    @endforeach
                                                                </select>
                                                                <div class="invalid-feedback-custom">Please select GST percentage</div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label fw-bold text-dark">HSN CODE <span class="text-danger">*</span></label>
                                                                <input class="form-control" id="validationCustom01"
                                                                    type="text" name="hsncode" required>
                                                                <div class="invalid-feedback-custom">Please enter HSN code</div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label fw-bold text-dark">Return / Replacement <span class="text-danger">*</span></label>
                                                                <select class="custom-select form-control dropdown text-secondary" name="return_replace" required>
                                                                    <option value="" selected hidden>--Select Return/Replacement--</option>
                                                                    <option value="Return">Return</option>
                                                                    <option value="Replacement">Replacement</option>
                                                                </select>
                                                                <div class="invalid-feedback-custom">Please select return/replacement option</div>
                                                            </div>
                                                        </div>
                                                        <div class="row g-3 mt-2">
                                                            <div class="col-md-3">
                                                                <label class="form-label fw-bold text-dark">Return Days <span class="text-danger">*</span></label>
                                                                <input type="text" name="r_days" placeholder="Days" class="form-control" required>
                                                                <div class="invalid-feedback-custom">Please enter return days</div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label fw-bold text-dark">SKU <span class="text-danger">*</span></label>
                                                                <input type="text" name="sku" placeholder="SKU" class="form-control" required>
                                                                <div class="invalid-feedback-custom">Please enter SKU</div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label fw-bold text-dark">Upload Main Image <span class="text-danger">*</span></label>
                                                                <input class="form-control" type="file" id="mainImg" accept="image/*"
                                                                    name="mainImage" required/>
                                                                <div class="text-muted small mt-1">Upload Format: jpg, jpeg, png</div>
                                                                <div class="invalid-feedback-custom">Please upload main image</div>
                                                            </div>
                                                        </div>
                                                        <div class="row" id="ming_preview">
                                                        </div>
                                                       
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                            <div class="card shadow-sm border-0 mb-4">
                                                <div class="card-body p-4">
                                                    <div class="d-flex justify-content-between align-items-center mb-3">
                                                        <label class="form-label fw-bold text-dark h5 m-0">Product Description <span class="text-danger">*</span></label>
                                                        {{-- <button type="button" class="btn btn-sm text-white" id="btn-generate-desc" style="background-color: #183543 !important; border-color: #183543 !important; color: #ffffff !important;"><i class="fa fa-magic"></i> Generate Description</button> --}}
                                                    </div>
                                                    <div class="digital-add needs-validation">
                                                        <div class="form-group mb-0">
                                                            <div class="description-sm">
                                                                <textarea class="form-control ckeditor" id="description" required cols="10" rows="4" name="description"></textarea>
                                                                <div class="invalid-feedback-custom">Please enter product description</div>
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
                    <div class="form-group mt-3" style="background-color: #f8f9fc; padding: 1.5rem; border-radius: 5px;">
                        <div class="row" id="p1">
                            <div class="container-fluid w-100">
                                <div id="product_details">
                                    {{-- First variant card --}}
                                    <div class="variant-card w" id="variant-card-0">
                                        <div class="variant-card-header">
                                            <h6 class="m-0 fw-bold text-primary">Variant #1</h6>
                                        </div>
                                        <div class="card-body p-4">
                                            <div class="variant-fields-wrapper">
                                                <input type="hidden" name="product_details_id[]" value="" required>
                                                <div class="row g-3">
                                                    {{-- Color --}}
                                                    @if(@$is_color != 'no')
                                                    <div class="col-md-2 color-col-wrapper">
                                                        <label class="form-label fw-bold text-secondary mb-1">Color <span class="text-danger">*</span></label>
                                                        <select class="form-select text-secondary attrcolor" name="attrcolor[]" id="attrcolor" required>
                                                            <option hidden>Color</option>
                                                            @foreach($colors as $color)
                                                                <option value="{{ $color->color_name }}" style="background-color: {{ $color->color_code }}">{{ $color->color_name }}</option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback-custom">Please select color</div>
                                                    </div>
                                                    @else
                                                    <input type="hidden" name="attrcolor[]" value="Multicolor">
                                                    @endif

                                                    {{-- Size --}}
                                                    <div class="col-md-2">
                                                        <label class="form-label fw-bold text-secondary mb-1">Size <span class="text-danger">*</span></label>
                                                        <select class="form-select text-secondary attrsize" name="attrsize[]" id="attrsize" required>
                                                            <option hidden>Size</option>
                                                            @foreach ($attribute as $attri)
                                                                @php
                                                                    $attrValues = json_decode($attri->attribute_values ?? '[]', true) ?: [];
                                                                @endphp
                                                                @foreach($attrValues as $val)
                                                                    <option value="{{ $val }}">{{ $val }}</option>
                                                                @endforeach
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback-custom">Please select size</div>
                                                    </div>

                                                    {{-- Retail Price --}}
                                                    <div class="col-md-2">
                                                        <label class="form-label fw-bold text-secondary mb-1">Retail Price <span class="text-danger">*</span></label>
                                                        <input type="text" name="retail_price[]" placeholder="Retail Price" class="form-control" required>
                                                        <div class="invalid-feedback-custom">Please enter retail price</div>
                                                    </div>

                                                    {{-- Selling Price --}}
                                                    <div class="col-md-2">
                                                        <label class="form-label fw-bold text-secondary mb-1">Selling Price <span class="text-danger">*</span></label>
                                                        <input type="text" name="selling_price[]" placeholder="Selling Price" class="form-control" required>
                                                        <div class="invalid-feedback-custom">Please enter selling price</div>
                                                    </div>

                                                    {{-- Quantity --}}
                                                    <div class="col-md-1">
                                                        <label class="form-label fw-bold text-secondary mb-1" id="lowstack1">Qty <span class="text-danger">*</span></label>
                                                        <input type="number" class="qty form-control" id="qty1" placeholder="Qty" name="quantity[]" required>
                                                        <div class="invalid-feedback-custom">Please enter quantity</div>
                                                    </div>

                                                    {{-- Low Stock Limit --}}
                                                    <div class="col-md-2">
                                                        <label class="form-label fw-bold text-secondary mb-1">Low Stock Limit <span class="text-danger">*</span></label>
                                                        <input type="number" name="low_stock_limit[]" id="low_stock_limit1" placeholder="Low Stock Limit" class="low_stock_limit form-control" required>
                                                        <div class="invalid-feedback-custom">Please enter low stock limit</div>
                                                    </div>

                                                    {{-- Actions --}}
                                                    <div class="col-md-1 d-flex flex-column justify-content-end">
                                                        <label class="form-label fw-bold text-secondary mb-1">&nbsp;</label>
                                                        <div class="d-flex gap-1 justify-content-end">
                                                            <button type="button" class="btn btn-danger w-100 remove-size-row-inline-btn" title="Remove Size"><i class="fa fa-trash"></i></button>
                                                            <button type="button" class="btn btn-primary w-100 add-size-row-inline-btn" title="Add Size"><i class="fa fa-plus"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            {{-- Variant Images --}}
                                            <div class="row variant-images-wrapper mt-3 col-12 p-0 m-0">
                                                <div class="col-12 mt-4">
                                                    <label class="form-label fw-bold text-dark mb-0">Variant Images</label>
                                                    <hr class="mt-1 mb-3 text-secondary opacity-25">
                                                </div>
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="border rounded p-2 text-center bg-light position-relative">
                                                        <span class="d-block mb-1 small fw-bold text-secondary">Image 1 <span class="text-danger">*</span></span>
                                                        <div class="img-preview-box mb-2">
                                                            <img class="img-thumb" id="mainr0" src="" style="max-height: 100%; max-width: 100%; object-fit: contain; display: none;" />
                                                        </div>
                                                        <span class="btn btn-xs btn-outline-primary btn-productimg w-100">
                                                            <i class="fa fa-cloud-upload"></i> Upload
                                                            <input class="form-control add_product" type="file" onchange="previewmainImg(this)" id="p_mainimg0" name="mainimg[]" accept="image/*">
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="border rounded p-2 text-center bg-light position-relative">
                                                        <span class="d-block mb-1 small fw-bold text-secondary">Image 2</span>
                                                        <div class="img-preview-box mb-2">
                                                            <img class="img-thumb" id="sub1r0" src="" style="max-height: 100%; max-width: 100%; object-fit: contain; display: none;" />
                                                        </div>
                                                        <span class="btn btn-xs btn-outline-primary btn-productimg w-100">
                                                            <i class="fa fa-cloud-upload"></i> Upload
                                                            <input class="form-control add_product" type="file" onchange="previewsubImg1(this)" id="subimg10" name="subimg1[]" accept="image/*">
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="border rounded p-2 text-center bg-light position-relative">
                                                        <span class="d-block mb-1 small fw-bold text-secondary">Image 3</span>
                                                        <div class="img-preview-box mb-2">
                                                            <img class="img-thumb" id="sub2r0" src="" style="max-height: 100%; max-width: 100%; object-fit: contain; display: none;" />
                                                        </div>
                                                        <span class="btn btn-xs btn-outline-primary btn-productimg w-100">
                                                            <i class="fa fa-cloud-upload"></i> Upload
                                                            <input class="form-control add_product" type="file" onchange="previewsubImg2(this)" id="subimg20" name="subimg2[]" accept="image/*">
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-3 col-sm-6">
                                                    <div class="border rounded p-2 text-center bg-light position-relative">
                                                        <span class="d-block mb-1 small fw-bold text-secondary">Image 4</span>
                                                        <div class="img-preview-box mb-2">
                                                            <img class="img-thumb" id="sub3r0" src="" style="max-height: 100%; max-width: 100%; object-fit: contain; display: none;" />
                                                        </div>
                                                        <span class="btn btn-xs btn-outline-primary btn-productimg w-100">
                                                            <i class="fa fa-cloud-upload"></i> Upload
                                                            <input class="form-control add_product" type="file" onchange="previewsubImg3(this)" id="subimg30" name="subimg3[]" accept="image/*">
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="input_fields_wrap"></div>

                                <div class="d-flex justify-content-end">
                                    <button type="button" id="add_m" name="addproduct[]" value="0" class='btn btn-xs btn-primary mb-3 mt-3'>
                                        <i class="fa fa-plus"></i> ADD MORE VARIANT
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                <div class="row mt-3">
                    <!-- Shipping Information Section -->
                    <div class="col-xl-12">
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="card-body p-4">
                                <h5 class="fw-bold text-dark mb-3">Shipping Information</h5>
                                <div class="row g-3">
                                    <div class="col-md-3">
                                        <label class="form-label fw-bold text-dark mb-1">Weight (g)</label>
                                        <input type="number" class="form-control" name="weight" placeholder="Weight (g)">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fw-bold text-dark mb-1">Length (cm)</label>
                                        <input type="number" class="form-control" placeholder="Length (cm)" name="length" value="">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fw-bold text-dark mb-1">Width (cm)</label>
                                        <input type="number" class="form-control" name="width" placeholder="Width (cm)">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="form-label fw-bold text-dark mb-1">Height (cm)</label>
                                        <input type="number" class="form-control" name="height" placeholder="Height (cm)">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Specifications Section -->
                    <div class="col-xl-12">
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="card-body p-4">
                                <h5 class="fw-bold text-dark mb-3">Specifications</h5>
                                <table class="table table-hover table-bordered m-0 align-middle">
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
                                                <select class='form-control text-secondary' name='specify_value[{{ $spec->id}}]'>
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

                    <!-- Offers & Collection Section -->
                    <div class="col-xl-12">
                        <div class="card shadow-sm border-0 mb-4">
                            <div class="card-body p-4">
                                <h5 class="fw-bold text-dark mb-3">Offers & Collection</h5>
                                <div class="row g-3">
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold text-dark mb-1">Offers</label>
                                        <select class="form-control text-secondary" id="offtype" name="offers">
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
                                        </select>
                                    </div>
                                    <div class="col-md-6">
                                        <label class="form-label fw-bold text-dark mb-1">Collection</label>
                                        <select class="form-control text-secondary" id="collection" name="collection">
                                            <option selected hidden value="">Select Here</option>
                                            @foreach ($productcollection as $productcol)
                                            <option id="{{ $productcol->id }}" value="{{ $productcol->name }}">
                                                {{ $productcol->name }}
                                            </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Action Buttons -->
                    <div class="col-xl-12 d-flex justify-content-end mb-4">
                        <div class="d-inline text-white" style="width: 120px;">
                            <button class="btn btn-primary w-100" type="submit">Save</button>
                        </div>
                        <div class="d-inline px-2 text-white" style="width: 120px;">
                            <a href="{{ route('staffproducts.crud.listing') }}" class="btn btn-secondary w-100" type="button">Close</a>
                        </div>
                    </div>
                </div>
            </form>
    </div>
    
    @endif
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


    // Get Sub Category from combined Main Category / Category dropdown
    $('#main_category_category').on('change', function() {
        const selectedOption = $(this).find(':selected');
        const category_id = selectedOption.val();
        const main_category_id = selectedOption.data('main-category-id') || '';

        $('#category_main').val(main_category_id);

        const $sub = $('#sub_category_initial_vendor');
        const $attribute = $('#attribute_group_initial_vendor');

        if (!category_id) {
            $sub.empty().append(
                `<option value="" selected hidden>Select Category</option>`
            ).attr('disabled', true);
            $attribute.empty().append('<option selected value="">Select Attribute</option>').prop('disabled', true);
            return;
        }

        let url = "{{ route('getSubCategory') }}?category_id=" + category_id;
        let method = 'GET';
        getAjaxValue(url, method, function(data) {
            $('#attrsize').empty();
            $('#attrcolor').empty();
            $sub.empty();
            $attribute.empty().append('<option selected value="">Select Attribute</option>').prop('disabled', true);

            $sub.append(
                `<option value=""selected hidden>Select Sub Category</option>`
            );
            $.each(data, function(key, subCategory) {
                $sub.append(
                    `<option id="${subCategory.id}"  value="${subCategory.id}">${subCategory.category_sub_name}</option>`
                );
            });

            $sub.removeAttr('disabled');
        });
    });

    $('#sub_category_initial_vendor').on('change', function() {
        const subCategoryId = $(this).val();
        const vendorId = $('#vendorlist').val() || 0;
        const $attribute = $('#attribute_group_initial_vendor');

        $attribute.empty().append('<option selected value="">Select Attribute</option>');
        if (!subCategoryId) {
            $attribute.prop('disabled', true);
            $attribute.prop('required', false);
            return;
        }

        $.ajax({
            url: "{{ route('admin.getSubCategoryAttributes') }}",
            type: 'GET',
            dataType: 'json',
            data: {
                sub_category_id: subCategoryId,
                vendor_id: vendorId
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

    $('#vendorlist').on('change', function() {
        if ($('#sub_category_initial_vendor').val()) {
            $('#sub_category_initial_vendor').trigger('change');
        }
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
            $preview.empty(); // Always reset previous preview when chooser changes

            if (!files.length) {
                return; // User closed chooser without picking file
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

        document.addEventListener('change', function(e) {
            if (e.target && e.target.type === 'file') {
                const maxSizeBytes = 4 * 1024 * 1024; // 1 MB
                const allowedExtensions = ['jpg', 'jpeg', 'png'];
                const files = e.target.files;
                if (files && files.length > 0) {
                    for (let i = 0; i < files.length; i++) {
                        const file = files[i];
                        const extension = file.name.split('.').pop().toLowerCase();
                        if (!allowedExtensions.includes(extension)) {
                            alert('Only JPG, JPEG, and PNG images are allowed. Selected file: ' + file.name);
                            e.target.value = '';
                            break;
                        }
                        if (file.size > maxSizeBytes) {
                            alert('Image size must not exceed 4 MB. Selected file: ' + file.name + ' (' + (file.size / (1024 * 1024)).toFixed(2) + ' MB)');
                            e.target.value = '';
                            break;
                        }
                    }
                }
            }
        }, true);
    });

    // Dynamic variant add/remove logic
    $(document).ready(function() {
        var max_fields = 10000000;
        var wrapper = $(".input_fields_wrap");

        $(document).on('click', '#add_m', function(e) {
            e.preventDefault();
            
            var x = -1;
            $('.variant-card.w').each(function() {
                var idAttr = $(this).attr('id');
                if (idAttr) {
                    var num = parseInt(idAttr.replace('variant-card-', ''));
                    if (!isNaN(num) && num > x) {
                        x = num;
                    }
                }
            });
            x++;

            if (x < max_fields) {
                var colorFieldHtml = '';
                if ("{{ @$is_color }}" !== 'no') {
                    colorFieldHtml = 
                    '            <div class="col-md-2 color-col-wrapper">' +
                    '                <label class="form-label fw-bold text-secondary mb-1">Color <span class="text-danger">*</span></label>' +
                    '                <select class="form-select text-secondary attrcolor" name="attrcolor[]" id="attrcolor'+x+'"><option hidden>Color</option></select>' +
                    '                <div class="invalid-feedback-custom">Please select color</div>' +
                    '            </div>';
                } else {
                    colorFieldHtml = '<input type="hidden" name="attrcolor[]" value="Multicolor">';
                }

                $(wrapper).append(
                    '<div class="variant-card w" id="variant-card-'+x+'">' +
                    '    <div class="variant-card-header">' +
                    '        <h6 class="m-0 fw-bold text-primary">Variant #'+(x+1)+'</h6>' +
                    '        <button class="remove_field btn btn-xs btn-danger m-0" value=""><i class="fa fa-trash"></i> Remove</button>' +
                    '    </div>' +
                    '    <div class="card-body p-4">' +
                    '        <div class="variant-fields-wrapper">' +
                    '            <input type="hidden" name="product_details_id[]" value="" required>' +
                    '            <div class="row g-3">' +
                    colorFieldHtml +
                    '            <div class="col-md-2">' +
                    '                <label class="form-label fw-bold text-secondary mb-1">Size <span class="text-danger">*</span></label>' +
                    '                <select class="form-select text-secondary attrsize" name="attrsize[]" id="attrsize'+x+'"><option hidden>Size</option></select>' +
                    '                <div class="invalid-feedback-custom">Please select size</div>' +
                    '            </div>' +
                    '            <div class="col-md-2">' +
                    '                <label class="form-label fw-bold text-secondary mb-1">Retail Price <span class="text-danger">*</span></label>' +
                    '                <input type="text" name="retail_price[]" placeholder="Retail Price" class="form-control" required>' +
                    '                <div class="invalid-feedback-custom">Please enter retail price</div>' +
                    '            </div>' +
                    '            <div class="col-md-2">' +
                    '                <label class="form-label fw-bold text-secondary mb-1">Selling Price <span class="text-danger">*</span></label>' +
                    '                <input type="text" name="selling_price[]" placeholder="Selling Price" class="form-control" required>' +
                    '                <div class="invalid-feedback-custom">Please enter selling price</div>' +
                    '            </div>' +
                    '            <div class="col-md-1">' +
                    '                <label class="form-label fw-bold text-secondary mb-1" id="lowstack'+(x+1)+'">Qty <span class="text-danger">*</span></label>' +
                    '                <input type="number" class="qty form-control" id="qty'+(x+1)+'" placeholder="Qty" name="quantity[]" required>' +
                    '                <div class="invalid-feedback-custom">Please enter quantity</div>' +
                    '            </div>' +
                    '            <div class="col-md-2">' +
                    '                <label class="form-label fw-bold text-secondary mb-1">Low Stock Limit <span class="text-danger">*</span></label>' +
                    '                <input type="number" name="low_stock_limit[]" id="low_stock_limit'+(x+1)+'" placeholder="Low Stock Limit" class="low_stock_limit form-control" required>' +
                    '                <div class="invalid-feedback-custom">Please enter low stock limit</div>' +
                    '            </div>' +
                    '            <div class="col-md-1 d-flex flex-column justify-content-end">' +
                    '                <label class="form-label fw-bold text-secondary mb-1">&nbsp;</label>' +
                    '                <div class="d-flex gap-1 justify-content-end">' +
                    '                    <button type="button" class="btn btn-danger w-100 remove-size-row-inline-btn" title="Remove Size"><i class="fa fa-trash"></i></button>' +
                    '                    <button type="button" class="btn btn-primary w-100 add-size-row-inline-btn" title="Add Size"><i class="fa fa-plus"></i></button>' +
                    '                </div>' +
                    '            </div>' +
                    '            </div>' +
                    '        </div>' +
                    '        <div class="row variant-images-wrapper mt-3 col-12 p-0 m-0">' +
                    '                <div class="col-12 mt-4">' +
                    '                    <label class="form-label fw-bold text-dark mb-0">Variant Images</label>' +
                    '                    <hr class="mt-1 mb-3 text-secondary opacity-25">' +
                    '                </div>' +
                    '            <div class="col-md-3 col-sm-6">' +
                    '                <div class="border rounded p-2 text-center bg-light position-relative">' +
                    '                    <span class="d-block mb-1 small fw-bold text-secondary">Image 1 <span class="text-danger">*</span></span>' +
                    '                    <div class="img-preview-box mb-2">' +
                    '                        <img class="img-thumb" id="mainr'+x+'" src="" style="max-height: 100%; max-width: 100%; object-fit: contain; display: none;" />' +
                    '                    </div>' +
                    '                    <span class="btn btn-xs btn-outline-primary btn-productimg w-100">' +
                    '                        <i class="fa fa-cloud-upload"></i> Upload' +
                    '                        <input class="form-control add_product" type="file" onchange="previewmainImg(this)" id="p_mainimg'+x+'" name="mainimg[]" accept="image/*">' +
                    '                    </span>' +
                    '                </div>' +
                    '            </div>' +
                    '            <div class="col-md-3 col-sm-6">' +
                    '                <div class="border rounded p-2 text-center bg-light position-relative">' +
                    '                    <span class="d-block mb-1 small fw-bold text-secondary">Image 2</span>' +
                    '                    <div class="img-preview-box mb-2">' +
                    '                        <img class="img-thumb" id="sub1r'+x+'" src="" style="max-height: 100%; max-width: 100%; object-fit: contain; display: none;" />' +
                    '                    </div>' +
                    '                    <span class="btn btn-xs btn-outline-primary btn-productimg w-100">' +
                    '                        <i class="fa fa-cloud-upload"></i> Upload' +
                    '                        <input class="form-control add_product" type="file" onchange="previewsubImg1(this)" id="subimg1'+x+'" name="subimg1[]" accept="image/*">' +
                    '                    </span>' +
                    '                </div>' +
                    '            </div>' +
                    '            <div class="col-md-3 col-sm-6">' +
                    '                <div class="border rounded p-2 text-center bg-light position-relative">' +
                    '                    <span class="d-block mb-1 small fw-bold text-secondary">Image 3</span>' +
                    '                    <div class="img-preview-box mb-2">' +
                    '                        <img class="img-thumb" id="sub2r'+x+'" src="" style="max-height: 100%; max-width: 100%; object-fit: contain; display: none;" />' +
                    '                    </div>' +
                    '                    <span class="btn btn-xs btn-outline-primary btn-productimg w-100">' +
                    '                        <i class="fa fa-cloud-upload"></i> Upload' +
                    '                        <input class="form-control add_product" type="file" onchange="previewsubImg2(this)" id="subimg2'+x+'" name="subimg2[]" accept="image/*">' +
                    '                    </span>' +
                    '                </div>' +
                    '            </div>' +
                    '            <div class="col-md-3 col-sm-6">' +
                    '                <div class="border rounded p-2 text-center bg-light position-relative">' +
                    '                    <span class="d-block mb-1 small fw-bold text-secondary">Image 4</span>' +
                    '                    <div class="img-preview-box mb-2">' +
                    '                        <img class="img-thumb" id="sub3r'+x+'" src="" style="max-height: 100%; max-width: 100%; object-fit: contain; display: none;" />' +
                    '                    </div>' +
                    '                    <span class="btn btn-xs btn-outline-primary btn-productimg w-100">' +
                    '                        <i class="fa fa-cloud-upload"></i> Upload' +
                    '                        <input class="form-control add_product" type="file" onchange="previewsubImg3(this)" id="subimg3'+x+'" name="subimg3[]" accept="image/*">' +
                    '                    </span>' +
                    '                </div>' +
                    '            </div>' +
                    '            </div>' +
                    '        </div>' +
                    '    </div>' +
                    '</div>'
                );

                $('#attrsize').find('option').each(function() {
                    $("#attrsize"+x).append("<option value='"+$(this).val()+"'>"+$(this).val()+"</option>");
                });

                $('#attrcolor').find('option').each(function() {
                    var $option = $(this).clone().prop('selected', false);
                    $("#attrcolor"+x).append($option);
                });

                if (window.syncVariantImages) {
                    window.syncVariantImages();
                }
            }
        });

        $(wrapper).on("click", ".remove_field", function(e) {
            e.preventDefault();
            $(this).closest('.w').remove();
            if (window.syncVariantImages) {
                window.syncVariantImages();
            }
        });
    });

    // Image preview main img
    function previewmainImg(a) {
        let idee = a.id; 
        let file = $('#'+idee).prop('files'); 
        const myArray = idee.split("p_mainimg");
        let x = myArray[1]; 
        var img = document.getElementById('mainr'+x);
        if (file && file[0]) {                        
            img.onload = () => { URL.revokeObjectURL(img.src); }
            img.src = URL.createObjectURL(file[0]);
            img.style.display = 'block';
        } else {
            img.src = "";
            img.style.display = 'none';
        }
    }

    // Image preview sub img1
    function previewsubImg1(a) {                    
        let idee = a.id; 
        let file = $('#'+idee).prop('files'); 
        const myArray = idee.split("subimg1");
        let x = myArray[1]; 
        var img = document.getElementById('sub1r'+x);
        if (file && file[0]) {                      
            img.onload = () => { URL.revokeObjectURL(img.src); }                   
            img.src = URL.createObjectURL(file[0]);
            img.style.display = 'block';
        } else {  
            img.src = "";
            img.style.display = 'none';
        }                 
    }

    // Image preview sub img2
    function previewsubImg2(a) {                    
        let idee = a.id; 
        let file = $('#'+idee).prop('files'); 
        const myArray = idee.split("subimg2");
        let x = myArray[1]; 
        var img = document.getElementById('sub2r'+x);
        if (file && file[0]) {                      
            img.onload = () => { URL.revokeObjectURL(img.src); }                   
            img.src = URL.createObjectURL(file[0]);
            img.style.display = 'block';
        } else {  
            img.src = "";
            img.style.display = 'none';
        }
    }

    // Image preview sub img3
    function previewsubImg3(a) {
        let idee = a.id; 
        let file = $('#'+idee).prop('files'); 
        const myArray = idee.split("subimg3");
        let x = myArray[1]; 
        var img = document.getElementById('sub3r'+x);
        if (file && file[0]) {
            img.onload = () => { URL.revokeObjectURL(img.src); }
            img.src = URL.createObjectURL(file[0]);
            img.style.display = 'block';
        } else {
            img.src = "";
            img.style.display = 'none';
        }
    }
</script>
<!--<script src="//js.nicedit.com/nicEdit-latest.js" type="text/javascript"></script>
<script type="text/javascript">
    bkLib.onDomLoaded(nicEditors.allTextAreas);
</script>-->
<script type="text/javascript">

    $(document).ready(function() {

        if (typeof CKEDITOR !== 'undefined' && $('#description').length && !CKEDITOR.instances.description) {
            CKEDITOR.replace('description', {
                height: 300,
                allowedContent: true,
                removePlugins: 'elementspath'
            });
        }

        $('#btn-generate-desc').click(function() {
            var descParts = [];

            // Gather categories & attributes
            var mainCat = $('#main_category option:selected').text().trim();
            if (mainCat.indexOf('--') === 0 || mainCat === '') mainCat = '';
            
            var cat = $('#category option:selected').text().trim();
            if (cat.indexOf('--') === 0 || cat === '') cat = '';
            
            var subCat = $('#sub_category option:selected').text().trim();
            if (subCat.indexOf('--') === 0 || subCat === '') subCat = '';
            
            var attribute = $('#selected_attribute_summary option:selected').text().trim();
            if (attribute.indexOf('--') === 0 || attribute === '') attribute = '';
            
            var colorAvail = $('#is_color_summary option:selected').text().trim();
            if (colorAvail.indexOf('--') === 0 || colorAvail === '') colorAvail = '';

            var introPara = "";
            if (mainCat || cat || subCat) {
                var catChain = [mainCat, cat, subCat].filter(Boolean).join(" > ");
                introPara = "Discover our premium quality product under the " + catChain + " category.";
                if (attribute) {
                    introPara += " Designed with " + attribute + " specifications.";
                }
                if (colorAvail) {
                    introPara += " Color options available: " + colorAvail + ".";
                }
                introPara += " Excellent styling and durable build, perfect for your needs.";
                
                descParts.push(introPara);
            }
            
            // Gather shipping details (general)
            var weight = $('input[name="weight"]').val();
            var length = $('input[name="length"]').val();
            var width = $('input[name="width"]').val();
            var height = $('input[name="height"]').val();
            
            // Gather details for each variant
            var variantsCount = {{ $nproduct ?? 1 }};
            var variantSections = [];
            
            for (var i = 1; i <= variantsCount; i++) {
                var sku = $('input[name="sku[' + i + ']"]').val();
                var returnReplace = $('select[name="return_replace[' + i + ']"]').val();
                var rDays = $('input[name="r_days[' + i + ']"]').val();
                
                // Color Select
                var color = $('#attrcolor' + i).val() || $('select[name="attributecolorval[' + i + '][]"]').val();
                
                // Size / Attributes Selects
                var attributes = [];
                $('select[name^="attributeval[' + i + ']"]').each(function() {
                    var val = $(this).val();
                    if (val) {
                        attributes.push(val);
                    }
                });
                
                var mrp = $('input[name="retail_price[' + i + '][]"]').val();
                var sellingPrice = $('input[name="selling_price[' + i + '][]"]').val();
                var qty = $('input[name="quantity[' + i + '][]"]').val();
                var lowStock = $('input[name="low_stock_limit[' + i + '][]"]').val();
                
                // Only build section if at least some details are filled
                if (sku || color || attributes.length > 0 || mrp || sellingPrice) {
                    var items = [];
                    if (sku) items.push("SKU: " + sku);
                    if (color) items.push("Color: " + color);
                    if (attributes.length > 0) items.push("Size/Spec: " + attributes.join(', '));
                    if (mrp) items.push("MRP: ₹" + mrp);
                    if (sellingPrice) items.push("Selling Price: ₹" + sellingPrice);
                    if (qty) items.push("Stock Quantity: " + qty);
                    if (lowStock) items.push("Low Stock Alert: " + lowStock);
                    if (returnReplace) {
                        var returnStr = "Return/Replacement: " + returnReplace;
                        if (rDays) returnStr += " (within " + rDays + " Days)";
                        items.push(returnStr);
                    }
                    
                    variantSections.push("Product Variant #" + i + " Details:\n" + items.map(function(it) { return "• " + it; }).join("\n"));
                }
            }
            
            if (variantSections.length > 0) {
                descParts.push(variantSections.join("\n\n"));
            }
            
            var shippingItems = [];
            if (weight) shippingItems.push("Weight: " + weight + " g");
            if (length || width || height) {
                shippingItems.push("Dimensions: " + (length || 0) + " cm x " + (width || 0) + " cm x " + (height || 0) + " cm");
            }
            
            if (shippingItems.length > 0) {
                descParts.push("Shipping & Dimensions:\n" + shippingItems.map(function(it) { return "• " + it; }).join("\n"));
            }
            
            var generatedText = descParts.join("\n\n");
            if (generatedText.trim() !== "") {
                if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances.description) {
                    CKEDITOR.instances.description.setData(generatedText.replace(/\n/g, '<br>'));
                } else {
                    $('#description').val(generatedText);
                }
            } else {
                alert("Please fill in some product details (SKU, Prices, Color, Size, etc.) to generate the description.");
            }
        });

    });

</script>
	
@endsection

{{-- <div class='col-md-2'><div class="img-thumb-wrapper card shadow"> <img class="img-thumb" id="mainr1"  src=""   /> <br/><span class="removeimg" id="removemainimg" value="mainimg">REEemove</span> </div></div> <div class='col-md-2'><div class="img-thumb-wrapper card shadow"> <img class="img-thumb" id="sub1r1"  src=""   /> <br/><span class="removeimg" id="removesub1img" value="subimg1">REEemove</span> </div></div> <div class='col-md-2'><div class="img-thumb-wrapper card shadow"> <img class="img-thumb" id="sub2r1"  src=""   /> <br/><span class="removeimg" id="removesub2img" value="subimg2">REEemove</span> </div></div> <div class='col-md-2'><div class="img-thumb-wrapper card shadow"> <img class="img-thumb" id="sub3r1"  src=""   /> <br/><span class="removeimg" id="removesub3img" value="subimg3">REEemove</span> </div></div> --}}


{{-- <div class="col-md-3"><span class="btn btn-primary btn-productimg"><i class="fa fa-cloud-upload" aria-hidden="true"></i> <input class="form-control add_product" type="file" id="mainimg" name="mainimg[]"  accept="image/*"> </span><label class="text-secondary fw-bold">Upload main image</label> </div> <div class="col-md-3"> <span class="btn btn-primary btn-productimg"  > <i class="fa fa-cloud-upload" aria-hidden="true"></i> <input class="form-control add_product" type="file" id="subimg1" name="subimg1[]"  accept="image/*"> </span><label class="text-secondary">Upload Sub image1</label> </div> <div class="col-md-3"> <span class="btn btn-primary btn-productimg"  > <i class="fa fa-cloud-upload" aria-hidden="true"></i> <input class="form-control add_product" type="file" id="subimg2" name="subimg2[]"  accept="image/*"> </span><label class="text-secondary">Upload Sub image2</label> </div> <div class="col-md-3"> <span class="btn btn-primary btn-productimg" > <i class="fa fa-cloud-upload" aria-hidden="true"></i> <input class="form-control add_product" type="file" id="subimg3" name="subimg3[]"  accept="image/*"> </span><label class="text-secondary">Upload Sub image2</label> </div> --}}
