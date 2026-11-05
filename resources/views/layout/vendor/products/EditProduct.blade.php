@extends('layout.auth.master')
@section('contents')
    @include('paritials.css.product.add-product-css')
    @include('paritials.js.product.add-product-js')

    @include('paritials.vendorauth.header')

    <!-- page-wrapper Start-->
    @include('paritials.vendorauth.topmenu');
    <!-- Page Header Ends -->

    <!-- Page Body Start-->
    <div class="page-body-wrapper">

        <!-- Page Sidebar Start-->
        @include('paritials.vendorauth.sidemenu');
        <!-- Page Sidebar Ends-->

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
            <form action="{{ route('vendorproducts.crud.update', $product->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <!-- Container-fluid starts-->
                <div class="container-fluid">
                    <div class="page-header">
                        <div class="row">
                            <div class="col-12">
                        <ol class="breadcrumb" style="float: left !important; margin-bottom: 0; padding-left: 0;">
                            <li class="breadcrumb-item"><a href="{{ route('vendordashboard', session()->get('login_id') ?? (auth()->check() ? auth()->user()->login_id : 1)) }}"><i data-feather="home"></i></a></li>
                                    <li class="breadcrumb-item active">Edit Product</li>
                        </ol>
                    </div>
                </div>
            </div>
                </div>
                <!-- Container-fluid Ends-->

                <!-- Container-fluid starts-->
                <div class="container-fluid fcolor">
                    <div class="row product-adding">
                        <div class="col-md-12">
                            <div class="card shadow-sm border-0 mb-4">
                                <div class="card-body p-4">
                                    <div class="row g-3">
                                        @php
                                            $categoryPairs = collect($categorysub)
                                                ->groupBy('category_id')
                                                ->map(function ($items) {
                                                    return $items->first();
                                                })
                                                ->values();
                                        @endphp

                                         <!-- Primary / Main Category -->
                                         <div class="col-md-3">
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
                                         <div class="col-md-3">
                                             <div class="form-group">
                                                 <label class="form-label fw-bold text-dark">Category</label>
                                                 <select class="js-select2 form-control text-secondary" id="category" disabled required>
                                                     <option value="{{ $product->category }}" selected> {{ optional($cates->first())->category_name }}</option>
                                                 </select>
                                                 <input type="hidden" name="category" value="{{ $product->category }}">
                                             </div>
                                         </div>
                                         
                                         <!-- Sub Category -->
                                         <div class="col-md-3">
                                             <div class="form-group">
                                                 <label class="form-label fw-bold text-dark">Sub Category</label>
                                                 <select class="js-select2 form-control text-secondary" id="sub_category" disabled required>
                                                     <option value="{{ $product->category_sub }}" selected> {{ optional($cates->first())->category_sub_name }}</option>
                                                 </select>
                                                 <input type="hidden" name="category_sub" value="{{ $product->category_sub }}">
                                             </div>
                                         </div>

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

                                        <!-- Attribute -->
                                        <div class="col-md-3">
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
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label fw-bold text-dark">Is Color Available?</label>
                                                <select class="form-select text-secondary" id="is_color_summary" disabled required>
                                                    <option value="yes" {{ $is_color == 'yes' ? 'selected' : '' }}>Yes</option>
                                                    <option value="no" {{ $is_color == 'no' ? 'selected' : '' }}>No</option>
                                                </select>
                                                <input type="hidden" name="is_color_summary" value="{{ $is_color }}">
                                            </div>
                                        </div>

                                        <!-- Product Name -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label fw-bold text-dark">Product Name <span class="text-danger">*</span></label>
                                                <input class="form-control" id="validationCustom01" type="text" name="product_name" required value="{{ $product->product_name }}">
                                                <div class="invalid-feedback-custom">Please enter product name</div>
                                            </div>
                                        </div>
                                        
                                        <!-- Tax -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label fw-bold text-dark">Tax <span class="text-danger">*</span></label>
                                                <select class="form-control text-secondary" id="gs" onchange="r()" name="tax_id" required>
                                                    <option value="1" {{ $product->tax_id == 1 ? 'selected' : '' }}>Included</option>
                                                    <option value="0" {{ $product->tax_id == 0 ? 'selected' : '' }}>Excluded</option>
                                                </select>
                                                <div class="invalid-feedback-custom">Please select tax type</div>
                                            </div>
                                        </div>

                                        <!-- GST -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label fw-bold text-dark">GST <span class="text-danger">*</span></label>
                                                <select class="form-control text-secondary" id="gst1" onchange="r()" required name="gst_id">
                                                    @foreach ($gst as $g)
                                                        <option value="{{ $g->value }}" {{ $product->gst_id == $g->value ? 'selected' : '' }}>{{ $g->gst_name }}</option>
                                                    @endforeach
                                                </select>
                                                <div class="invalid-feedback-custom">Please select GST percentage</div>
                                            </div>
                                        </div>

                                        <!-- HSN Code -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label fw-bold text-dark">HSN CODE <span class="text-danger">*</span></label>
                                                <input class="form-control" type="text" name="hsncode" value="{{ $product->hsncode }}" required>
                                                <div class="invalid-feedback-custom">Please enter HSN code</div>
                                            </div>
                                        </div>

                                        <!-- Return Policy -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label fw-bold text-dark">Return / Replacement <span class="text-danger">*</span></label>
                                                <select class="form-select text-secondary" name="return_replace" required>
                                                    <option value="">Select</option>
                                                    <option value="Return" {{ ($productdetailss[0]->return_replace ?? '') == 'Return' ? 'selected' : '' }}>Return</option>
                                                    <option value="Replacement" {{ ($productdetailss[0]->return_replace ?? '') == 'Replacement' ? 'selected' : '' }}>Replacement</option>
                                                </select>
                                                <div class="invalid-feedback-custom">Please select return/replacement option</div>
                                            </div>
                                        </div>

                                        <!-- Return Days -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label fw-bold text-dark">Return Days <span class="text-danger">*</span></label>
                                                <input type="text" name="r_days" placeholder="Days" class="form-control" required value="{{ $productdetailss[0]->r_days ?? '' }}">
                                                <div class="invalid-feedback-custom">Please enter return days</div>
                                            </div>
                                        </div>

                                        <!-- SKU -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label class="form-label fw-bold text-dark">SKU <span class="text-danger">*</span></label>
                                                <input type="text" name="sku" placeholder="SKU" class="form-control" required value="{{ $productdetailss[0]->sku ?? '' }}">
                                                <div class="invalid-feedback-custom">Please enter SKU</div>
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Main Image -->
                                    <div class="row g-3 mt-2">
                                         <div class="col-md-3">
                                             <div class="form-group mb-0">
                                                 <label class="form-label fw-bold text-dark">Main Image <span class="text-danger">*</span></label>
                                                 <input class="form-control" type="file" id="productMainImgInput" name="mainImage" accept="image/*">
                                                 <div class="text-muted small mt-1">Upload Format: jpg, jpeg, png</div>
                                                 <input type="hidden" name="oldmainImage" value="{{ $product->product_image }}">
                                             </div>
                                         </div>
                                         <div class="col-md-3">
                                             @if(!empty($product->product_image))
                                                 <div class="mt-0">
                                                     <label class="form-label d-block mb-1">&nbsp;</label>
                                                     <div class="img-preview-box p-1 border rounded bg-white d-flex align-items-center justify-content-center" style="height: 70px; width: 70px; overflow: hidden;">
                                                         <img src="{{ url('assets/images/products/'.$product->product_image) }}" id="productMainImgPreview" class="img-fluid" style="max-height: 100%; max-width: 100%; object-fit: contain;">
                                                     </div>
                                                 </div>
                                             @else
                                                 <div class="mt-0" style="display: none;" id="productMainImgPreviewWrap">
                                                     <label class="form-label d-block mb-1">&nbsp;</label>
                                                     <div class="img-preview-box p-1 border rounded bg-white d-flex align-items-center justify-content-center" style="height: 70px; width: 70px; overflow: hidden;">
                                                         <img src="" id="productMainImgPreview" class="img-fluid" style="max-height: 100%; max-width: 100%; object-fit: contain; display: none;">
                                                     </div>
                                                 </div>
                                             @endif
                                         </div>
                                    </div>

                                    <!-- Include Variants Details Subview -->
                                    @include('layout.vendor.products.producteditDetails')

                                    <!-- Product Description -->
                                    <div class="form-group mt-3">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <label class="form-label fw-bold text-dark mb-0">Product Description <span class="text-danger">*</span></label>
                                            <button type="button" class="btn btn-sm text-white" id="btn-generate-desc" style="background-color: #183543 !important; border-color: #183543 !important; color: #ffffff !important;"><i class="fa fa-magic"></i> Generate Description</button>
                                        </div>
                                        <textarea id="description" class="form-control ckeditor" required rows="5" name="description">{{ $product->description }}</textarea>
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
                                                 @if(!empty($specification))
                                                 @foreach (collect($specification)->chunk(2) as $specPair)
                                                     <tr>
                                                         @foreach ($specPair as $spec)
                                                         @php
                                                             $specValues = json_decode($spec->specification_values ?? '[]', true) ?: [];
                                                             $selectedValue = $specById[$spec->id] ?? ($specByName[$spec->specification_group_name] ?? '');
                                                         @endphp
                                                         <td style="width: 20%; vertical-align: middle;">{{ $spec->specification_group_name }}</td>
                                                         <td style="width: 30%;">
                                                             <input type="hidden" name="spec_id[]" value="{{ $spec->id }}">
                                                             <select class="form-control text-secondary" name="specify_value[{{ $spec->id }}]" id="specify_value_{{ $spec->id }}">
                                                                 <option value="" {{ $selectedValue === '' ? 'selected' : '' }}>-- Select {{ $spec->specification_group_name }} --</option>
                                                                 @foreach ($specValues as $specify_val)
                                                                     <option value="{{ $specify_val }}" {{ $specify_val == $selectedValue ? 'selected' : '' }}>{{ $specify_val }}</option>
                                                                 @endforeach
                                                             </select>
                                                             <input type="hidden" name="specify_attribute[{{ $spec->id }}]" value="{{ $spec->specification_group_name }}">
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
                                                         <option value="{{ $item->ids }}" {{ $item->ids == $product->collection ? 'selected' : '' }}>{{ $item->name }}</option>
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
                                             <button class="btn btn-primary px-4 py-2" type="submit">
                                                 Save
                                             </button>
                                             <a href="{{ route('vendorproducts.crud.listing') }}" class="btn btn-secondary px-4 py-2">
                                                 Close
                                             </a>
                                         </div>
                                     </div>

                        </div>
                    </div>
                </div>
                <!-- Container-fluid Ends-->
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

        const vendorSubCategories = @json($categorysub);

        // Get Category change behavior (client-side filtering)
        $('#main_category_category_vendor').on('change', function() {
            const selectedOption = $(this).find(':selected');
            const categoryId = selectedOption.val();
            const mainCategoryId = selectedOption.data('main-category-id') || '';

            $('#category_main_hidden_vendor').val(mainCategoryId);

            const $sub = $('#sub_category_initial_vendor');
            $sub.empty().append('<option selected value="">Select Sub Category</option>');
            $('.spectable').empty(); // Clear specifications when category changes

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

        // Get Specifications on Sub Category change
        $('#sub_category_initial_vendor').on('change', function() {
            let sub_category_id = $(this).val();
            if (!sub_category_id) {
                $('.spectable').empty();
                return;
            }
            let url1 = '{{ route('getSpecifications') }}?sub_category_id=' + sub_category_id;
            let method1 = 'GET';
            getAjaxValue(url1, method1, function(data) {
                $('.spectable').empty();
                let specifications = '';
                let tempArr = [];
                $.each(data, function(key, spec) {
                    tempArr.push(spec);
                });
                
                for (let i = 0; i < tempArr.length; i += 2) {
                    specifications += `<tr>`;
                    for (let j = 0; j < 2; j++) {
                        if (i + j < tempArr.length) {
                            let spec = tempArr[i + j];
                            
                            let options = '';
                            let specValues = JSON.parse(spec.value || '[]');
                            for (let index = 0; index < specValues.length; index++) {
                                options += `<option value='${specValues[index]}'> ${specValues[index]}</option>`;
                            }
                            
                            specifications += `
                                <td style="width: 20%; vertical-align: middle;">${spec.name}</td>
                                <td style="width: 30%;">
                                    <input type="hidden" name="spec_id[]" value="${spec.id}">
                                    <select class='form-control text-secondary' name='specify_value[${spec.id}]'>
                                        <option selected value=''> --Select ${spec.name}--</option>
                                        ${options}
                                    </select>
                                    <input type="hidden" name="specify_attribute[${spec.id}]" value="${spec.name}">
                                </td>
                            `;
                        } else {
                            specifications += `<td></td><td></td>`;
                        }
                    }
                    specifications += `</tr>`;
                }
                $(".spectable").append(specifications);
            });
        });

        // Product Image 1 Live Preview
        $("#productMainImgInput").on("change", function(e) {
            var file = this.files[0];
            var imgPreview = document.getElementById('productMainImgPreview');
            if (file) {
                imgPreview.onload = () => {
                    URL.revokeObjectURL(imgPreview.src);
                }
                imgPreview.src = URL.createObjectURL(file);
                imgPreview.style.display = 'block';
            } else {
                imgPreview.src = "";
                imgPreview.style.display = 'none';
            }
        });

        // Add More Variants script
        $(document).ready(function() {
            var max_fields = 10000000;
            var wrapper = $(".input_fields_wrap");
            var add_button1 = $("#add_m");
            var lis = $("#add_m").val();
            var x = parseInt(lis) || 0;

            $(add_button1).click(function(e) {
                e.preventDefault();
                x++;

                $(wrapper).append(
                    '<div class="variant-card w" id="variant-card-'+x+'">' +
                    '    <div class="variant-card-header">' +
                    '        <h6 class="m-0 fw-bold text-primary">Variant #'+x+'</h6>' +
                    '        <button class="remove_field btn btn-xs btn-danger m-0" value=""><i class="fa fa-trash"></i> Remove</button>' +
                    '    </div>' +
                    '    <div class="card-body p-4">' +
                    '        <div class="variant-fields-wrapper">' +
                    '            <input type="hidden" name="product_details_id[]" value="" required>' +
                    '            <div class="row g-3">' +
                    '            <div class="col-md-2 color-col-wrapper">' +
                    '                <label class="form-label fw-bold text-secondary mb-1">Color</label>' +
                    '                <select class="form-select text-secondary attrcolor" name="attrcolor[]" id="attrcolor'+x+'"><option hidden>Color</option></select>' +
                    '                <div class="invalid-feedback-custom">Please select color</div>' +
                    '            </div>' +
                    '            <div class="col-md-2">' +
                    '                <label class="form-label fw-bold text-secondary mb-1">Size</label>' +
                    '                <select class="form-select text-secondary attrsize" name="attrsize[]" id="attrsize'+x+'"><option hidden>Size</option></select>' +
                    '                <div class="invalid-feedback-custom">Please select size</div>' +
                    '            </div>' +
                    '            <div class="col-md-2">' +
                    '                <label class="form-label fw-bold text-secondary mb-1">Retail Price</label>' +
                    '                <input type="text" name="retail_price[]" placeholder="Retail Price" class="form-control" required>' +
                    '                <div class="invalid-feedback-custom">Please enter retail price</div>' +
                    '            </div>' +
                    '            <div class="col-md-2">' +
                    '                <label class="form-label fw-bold text-secondary mb-1">Selling Price</label>' +
                    '                <input type="text" name="selling_price[]" placeholder="Selling Price" class="form-control" required>' +
                    '                <div class="invalid-feedback-custom">Please enter selling price</div>' +
                    '            </div>' +
                    '            <div class="col-md-1">' +
                    '                <label class="form-label fw-bold text-secondary mb-1" id="lowstack'+(x+1)+'">Qty</label>' +
                    '                <input type="number" class="qty form-control" id="qty'+(x+1)+'" placeholder="Qty" name="quantity[]" required>' +
                    '                <div class="invalid-feedback-custom">Please enter quantity</div>' +
                    '            </div>' +
                    '            <div class="col-md-2">' +
                    '                <label class="form-label fw-bold text-secondary mb-1">Low Stock Limit</label>' +
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
                    '                    <span class="d-block mb-1 small fw-bold text-secondary">Image 1</span>' +
                    '                    <div class="img-preview-box mb-2">' +
                    '                        <img class="img-thumb" id="mainr'+x+'" src="" style="max-height: 100%; max-width: 100%; object-fit: contain; display: none;" />' +
                    '                    </div>' +
                    '                    <span class="btn btn-xs btn-outline-primary btn-productimg w-100">' +
                    '                        <i class="fa fa-cloud-upload"></i> Upload' +
                    '                        <input class="form-control add_product" type="file" onchange="previewmainImg(this)" id="p_mainimg'+x+'" name="mainimg[]" accept="image/*">' +
                    '                    </span>' +
                    '                    <input type="hidden" name="old_mainimg[]" value="">' +
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
                    '                    <input type="hidden" name="old_subimg1[]" value="">' +
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
                    '                    <input type="hidden" name="old_subimg2[]" value="">' +
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
                    '                    <input type="hidden" name="old_subimg3[]" value="">' +
                    '                </div>' +
                    '            </div>' +
                    '            </div>' +
                    '        </div>' +
                    '    </div>' +
                    '</div>'
                );

                $('#attrsize').find('option').each(function() {
                    $("#attrsize"+x).append("<option value= '"+$(this).val()+"'>"+$(this).val()+"</option>");
                });

                $('#attrcolor').find('option').each(function() {
                    var $option = $(this).clone().prop('selected', false);
                    $("#attrcolor"+x).append($option);
                });

                syncVariantImages();
            });

            $(wrapper).on("click", ".remove_field", function(e) {
                e.preventDefault();
                $(this).closest('.w').remove();
            });
        });

        // Image preview helpers
        function previewmainImg(a) {
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

        function previewsubImg1(a) {                    
            let idee = a.id; 
            let file = $('#'+idee).prop('files'); 
            const myArray = idee.split("subimg1");
            let x = myArray[1]; 
            var img = document.getElementById('sub1r'+x);
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

        function previewsubImg2(a) {                    
            let idee = a.id; 
            let file = $('#'+idee).prop('files'); 
            const myArray = idee.split("subimg2");
            let x = myArray[1]; 
            var img = document.getElementById('sub2r'+x);
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

        function previewsubImg3(a) {
            let idee = a.id; 
            let file = $('#'+idee).prop('files'); 
            const myArray = idee.split("subimg3");
            let x = myArray[1]; 
            var img = document.getElementById('sub3r'+x);
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

            $('#btn-generate-desc').click(function() {
                var productName = $('input[name="product_name"]').val() ? $('input[name="product_name"]').val().trim() : '';

                // Gather categories & attributes
                var mainCat = $('#main_category option:selected').text().trim();
                if (mainCat.indexOf('--') === 0 || mainCat === '' || mainCat.indexOf('Select') === 0) mainCat = '';
                
                var cat = $('#category option:selected').text().trim();
                if (cat.indexOf('--') === 0 || cat === '' || cat.indexOf('Select') === 0) cat = '';
                
                var subCat = $('#sub_category option:selected').text().trim();
                if (subCat.indexOf('--') === 0 || subCat === '' || subCat.indexOf('Select') === 0) subCat = '';
                
                var attribute = $('#selected_attribute_summary option:selected').text().trim();
                if (attribute.indexOf('--') === 0 || attribute === '' || attribute.indexOf('Select') === 0) attribute = '';

                var displayName = productName || subCat || (cat ? cat + " Item" : "Premium Product");
                var catChain = [mainCat, cat, subCat].filter(Boolean).join(" &rsaquo; ");

                // Colors & Sizes from variants
                var colorsList = [];
                $('select[name="attrcolor[]"], .attrcolor').each(function() {
                    var c = $(this).find('option:selected').text().trim() || $(this).val();
                    if (c && c !== 'Color' && c !== 'Multicolor' && c.indexOf('--') !== 0 && c.indexOf('Select') !== 0 && colorsList.indexOf(c) === -1) {
                        colorsList.push(c);
                    }
                });

                var sizesList = [];
                $('select[name="attrsize[]"], .attrsize').each(function() {
                    var s = $(this).find('option:selected').text().trim() || $(this).val();
                    if (s && s !== 'Size' && s.indexOf('--') !== 0 && s.indexOf('Select') !== 0 && sizesList.indexOf(s) === -1) {
                        sizesList.push(s);
                    }
                });

                // Specifications
                var specs = [];
                $('select[name^="specify_value"]').each(function() {
                    var val = $(this).val();
                    if (val && val !== '' && val.indexOf('--') !== 0 && val.indexOf('Select') !== 0) {
                        var groupName = $(this).closest('td').prev('td').text().trim();
                        if (!groupName) {
                            groupName = $(this).siblings('input[name^="specify_attribute"]').val();
                        }
                        if (!groupName) {
                            groupName = $(this).closest('tr').find('input[name^="specify_attribute"]').val();
                        }
                        if (groupName) {
                            groupName = groupName.replace(/:$/, '').trim();
                            var exists = specs.some(function(s) { return s.name.toLowerCase() === groupName.toLowerCase(); });
                            if (!exists) {
                                specs.push({ name: groupName, value: val });
                            }
                        }
                    }
                });

                // Offers & Collection
                var collection = $('#collection option:selected').text().trim();
                if (collection === 'Select Here' || collection.indexOf('--') === 0 || collection.indexOf('Select') === 0) collection = '';
                
                var offer = $('#offtype option:selected').text().trim();
                if (offer === 'Select' || offer.indexOf('--') === 0 || offer.indexOf('Select') === 0) offer = '';

                // Check if at least some context exists
                if (!productName && !catChain && colorsList.length === 0 && sizesList.length === 0 && specs.length === 0) {
                    alert("Please select category or enter product details to generate the description.");
                    return;
                }

                // Construct HTML description with only 3 sections:
                // 1. Product details (existing intro paragraphs)
                // 2. Key Features & Highlights (generated using specification details)
                // 3. Care & Handling instructions
                var html = '';
                html += '<p>The <strong>' + displayName + '</strong> is thoughtfully designed to bring together timeless elegance, superior craftsmanship, and day-to-day comfort.</p>';

                if (catChain) {
                    html += '<p>Proudly featured under our distinguished <strong>' + catChain + '</strong> collection' + (collection ? ' as part of the exclusive <em>' + collection + '</em> range' : '') + ', this product represents a harmonious blend of contemporary aesthetics and dependable durability. Created to satisfy discerning standards, it effortlessly elevates your style and fits seamlessly into your lifestyle.</p>';
                }

                if (offer) {
                    html += '<p><em><strong>Special Offer:</strong> Take advantage of our exclusive promotion &mdash; ' + offer + ' &mdash; available for a limited time!</em></p>';
                }

                html += '<h4>Key Features &amp; Highlights</h4>';
                html += '<ul>';

                if (specs.length > 0) {
                    specs.forEach(function(sp) {
                        html += '<li><strong>' + sp.name + ':</strong> ' + sp.value + '</li>';
                    });
                } else {
                    html += '<li><strong>Superior Craftsmanship:</strong> Meticulously constructed using premium grade materials, ensuring an exquisite finish, luxurious touch, and exceptional longevity.</li>';
                    html += '<li><strong>Tailored Comfort:</strong> Ergonomically engineered to provide a flattering, relaxed fit that guarantees all-day ease and unrestricted movement.</li>';
                    html += '<li><strong>Versatile Appeal:</strong> Styled with contemporary sophistication, effortlessly adapting to formal events, casual outings, or everyday routines.</li>';
                }

                if (colorsList.length > 0) {
                    html += '<li><strong>Available Colors:</strong> ' + colorsList.join(', ') + '</li>';
                }
                if (sizesList.length > 0) {
                    html += '<li><strong>Available Sizing:</strong> Offered in standard sizes: ' + sizesList.join(', ') + ' for your ideal fit.</li>';
                }
                if (attribute) {
                    html += '<li><strong>Design Attribute:</strong> Specially developed under ' + attribute + ' design standards.</li>';
                }
                html += '</ul>';

                html += '<h4>Care &amp; Handling Instructions</h4>';
                html += '<ul>';
                html += '<li>Handle with gentle care and follow standard cleaning practices to preserve fabric vibrancy and texture.</li>';
                html += '<li>Store in a clean, dry environment away from prolonged direct sunlight and moisture.</li>';
                html += '<li>Avoid harsh bleaches, strong chemicals, or aggressive scrubbing to maintain prime condition.</li>';
                html += '</ul>';

                if (typeof CKEDITOR !== 'undefined' && CKEDITOR.instances.description) {
                    CKEDITOR.instances.description.setData(html);
                }
                $('#description').val(html);
            });
        });
    </script>
@endsection
