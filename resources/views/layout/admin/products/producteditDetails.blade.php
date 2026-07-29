<style>
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
</style>

<div class="form-group mt-3" style="background-color: #f8f9fc; padding: 1.5rem; border-radius: 5px;">
    <div class="row" id="p1">
        <div class="container-fluid w-100">
            <div id="product_details"> 
                @foreach($productdetailss as $key => $productdetails)
                    @php
                        $qtyinc = $key + 1;
                        $inc = $key + 1;
                        $p_imgs = json_decode($productdetails->product_detail_image) ?: [];
                        
                        $currentColor = $productdetails->color
                            ?? ($productdetails->attributevalue1 ?? null)
                            ?? (($productdetails->attributename2 ?? '') === 'Color' ? ($productdetails->attributevalue2 ?? null) : null)
                            ?? (($productdetails->attributename3 ?? '') === 'Color' ? ($productdetails->attributevalue3 ?? null) : null);
                            
                        $currentSize = $productdetails->size
                            ?? (($productdetails->attributename2 ?? '') === 'Size' ? ($productdetails->attributevalue2 ?? null) : null)
                            ?? (($productdetails->attributename3 ?? '') === 'Size' ? ($productdetails->attributevalue3 ?? null) : null)
                            ?? ($productdetails->attributevalue2 ?? null);
                    @endphp
                    
                    <div class="variant-card w" id="variant-card-{{ $key }}">
                        <div class="variant-card-header">
                            <h6 class="m-0 fw-bold text-primary">Variant #{{ $qtyinc }}</h6>
                            @if($key > 0)
                                <button class="remove_field btn btn-xs btn-danger m-0" id="remove_field{{ $inc }}" value="{{ $productdetails->id }}">
                                    <i class="fa fa-trash"></i> Remove
                                </button>
                            @endif
                        </div>
                        
                        <div class="card-body p-4">
                            <div class="variant-fields-wrapper">
                                <input type="hidden" name="product_details_id[]" value="{{ $productdetails->id }}" required>
                                
                                <div class="row g-3">
                                <!-- Color -->
                                <div class="col-md-2">
                                    <label class="form-label fw-bold text-dark mb-1">Color <span class="text-danger">*</span></label>
                                    <select class="form-select text-secondary" name="attrcolor[]" id="attrcolor" required>
                                        @if(!empty($currentColor))
                                            <option value="{{ $currentColor }}" selected>{{ $currentColor }}</option>
                                        @endif
                                        @if(!empty($colors))
                                            @foreach ($colors as $color)
                                                @if($color->color_name != $currentColor)
                                                    <option value="{{ $color->color_name }}" style="background-color: {{ $color->color_code }}">{{ $color->color_name }}</option>
                                                @endif
                                            @endforeach
                                        @endif
                                    </select>
                                    <div class="invalid-feedback-custom">Please select color</div>
                                </div>
                                
                                <!-- Size -->
                                <div class="col-md-2">
                                    <label class="form-label fw-bold text-dark mb-1">Size <span class="text-danger">*</span></label>
                                    <select class="form-select text-secondary" name="attrsize[]" id="attrsize" required>
                                        @if(!empty($currentSize))
                                            <option value="{{ $currentSize }}" selected>{{ $currentSize }}</option>
                                        @endif
                                        @foreach ($attribute as $attri)
                                            @php
                                                $attrName = strtolower($attri->attribute_name ?? $attri->attribute_group_name ?? '');
                                                $attrValues = json_decode($attri->value ?? $attri->attribute_values ?? '[]', true) ?: [];
                                            @endphp
                                            @if($attrName !== 'color')
                                                @foreach($attrValues as $val)
                                                    @if($val != $currentSize)
                                                        <option value="{{ $val }}">{{ $val }}</option>
                                                    @endif
                                                @endforeach
                                            @endif
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback-custom">Please select size</div>
                                </div>
                                
                                <!-- Retail Price -->
                                <div class="col-md-2">
                                    <label class="form-label fw-bold text-dark mb-1">Retail Price <span class="text-danger">*</span></label>
                                    <input type="text" name="retail_price[]" placeholder="Retail Price" class="form-control" required value="{{ $productdetails->retail_price }}">
                                    <div class="invalid-feedback-custom">Please enter retail price</div>
                                </div>
                                
                                <!-- Selling Price -->
                                <div class="col-md-2">
                                    <label class="form-label fw-bold text-dark mb-1">Selling Price <span class="text-danger">*</span></label>
                                    <input type="text" name="selling_price[]" placeholder="Selling Price" class="form-control" required value="{{ $productdetails->selling_price }}">
                                    <div class="invalid-feedback-custom">Please enter selling price</div>
                                </div>
                                
                                <!-- Quantity -->
                                <div class="col-md-1">
                                    <label class="form-label fw-bold text-dark mb-1" id="lowstack{{ $qtyinc }}">Qty <span class="text-danger">*</span></label>
                                    <input type="number" class="qty form-control" id="qty{{ $qtyinc }}" placeholder="Qty" name="quantity[]" required value="{{ $productdetails->quantity }}">
                                    <div class="invalid-feedback-custom">Please enter quantity</div>
                                </div>
                                

                                <!-- Low Stock Limit -->
                                <div class="col-md-2">
                                    <label class="form-label fw-bold text-dark mb-1">Low Stock Limit <span class="text-danger">*</span></label>
                                    <input type="number" name="low_stock_limit[]" id="low_stock_limit{{ $inc }}" placeholder="Low Stock Limit" class="low_stock_limit form-control" required value="{{ $productdetails->low_stock_limit }}">
                                    <div class="invalid-feedback-custom">Please enter low stock limit</div>
                                </div>

                                <!-- Actions -->
                                <div class="col-md-1 d-flex flex-column justify-content-end">
                                    <label class="form-label fw-bold text-dark mb-1">&nbsp;</label>
                                    <div class="d-flex gap-1 justify-content-end">
                                        <button type="button" class="btn btn-danger w-100 remove-size-row-inline-btn" title="Remove Size"><i class="fa fa-trash"></i></button>
                                        <button type="button" class="btn btn-primary w-100 add-size-row-inline-btn" title="Add Size"><i class="fa fa-plus"></i></button>
                                    </div>
                                </div>
                                </div>

                                <!-- Variant Images Section -->
                                <div class="row variant-images-wrapper mt-3 col-12 p-0 m-0">
                                    <div class="col-12 mt-4">
                                        <label class="form-label fw-bold text-dark mb-0">Variant Images</label>
                                        <hr class="mt-1 mb-3 text-secondary opacity-25">
                                    </div>

                                    <!-- Main Image -->
                                    <div class="col-md-3 col-sm-6">
                                        <div class="border rounded p-2 text-center bg-light position-relative">
                                            <span class="d-block mb-1 small fw-bold text-dark">Image 1 <span class="text-danger">*</span></span>
                                            <div class="img-preview-box mb-2">
                                                <img class="img-thumb" id="mainr{{ $key }}" src="{{ isset($p_imgs[0]) && !empty($p_imgs[0]) ? url('assets/images/products/detail/'.$p_imgs[0]) : '' }}" style="max-height: 100%; max-width: 100%; object-fit: contain; {{ isset($p_imgs[0]) && !empty($p_imgs[0]) ? '' : 'display:none;' }}" />
                                            </div>
                                            <span class="btn btn-xs btn-outline-primary btn-productimg w-100">
                                                <i class="fa fa-cloud-upload"></i> Upload
                                                <input class="form-control add_product" type="file" onchange="previewmainImg(this)" id="p_mainimg{{ $key }}" name="mainimg[]" accept="image/*">
                                            </span>
                                            <input type="hidden" name="old_mainimg[]" value="{{ $p_imgs[0] ?? '' }}">
                                        </div>
                                    </div>
                                    
                                    <!-- Image 2 -->
                                    <div class="col-md-3 col-sm-6">
                                        <div class="border rounded p-2 text-center bg-light position-relative">
                                            <span class="d-block mb-1 small fw-bold text-dark">Image 2</span>
                                            <div class="img-preview-box mb-2">
                                                <img class="img-thumb" id="sub1r{{ $key }}" src="{{ isset($p_imgs[1]) && !empty($p_imgs[1]) ? url('assets/images/products/detail/'.$p_imgs[1]) : '' }}" style="max-height: 100%; max-width: 100%; object-fit: contain; {{ isset($p_imgs[1]) && !empty($p_imgs[1]) ? '' : 'display:none;' }}" />
                                            </div>
                                            <span class="btn btn-xs btn-outline-primary btn-productimg w-100">
                                                <i class="fa fa-cloud-upload"></i> Upload
                                                <input class="form-control add_product" type="file" onchange="previewsubImg1(this)" id="subimg1{{ $key }}" name="subimg1[]" accept="image/*">
                                            </span>
                                            <input type="hidden" name="old_subimg1[]" value="{{ $p_imgs[1] ?? '' }}">
                                        </div>
                                    </div>
                                    
                                    <!-- Image 3 -->
                                    <div class="col-md-3 col-sm-6">
                                        <div class="border rounded p-2 text-center bg-light position-relative">
                                            <span class="d-block mb-1 small fw-bold text-dark">Image 3</span>
                                            <div class="img-preview-box mb-2">
                                                <img class="img-thumb" id="sub2r{{ $key }}" src="{{ isset($p_imgs[2]) && !empty($p_imgs[2]) ? url('assets/images/products/detail/'.$p_imgs[2]) : '' }}" style="max-height: 100%; max-width: 100%; object-fit: contain; {{ isset($p_imgs[2]) && !empty($p_imgs[2]) ? '' : 'display:none;' }}" />
                                            </div>
                                            <span class="btn btn-xs btn-outline-primary btn-productimg w-100">
                                                <i class="fa fa-cloud-upload"></i> Upload
                                                <input class="form-control add_product" type="file" onchange="previewsubImg2(this)" id="subimg2{{ $key }}" name="subimg2[]" accept="image/*">
                                            </span>
                                            <input type="hidden" name="old_subimg2[]" value="{{ $p_imgs[2] ?? '' }}">
                                        </div>
                                    </div>
                                    
                                    <!-- Image 4 -->
                                    <div class="col-md-3 col-sm-6">
                                        <div class="border rounded p-2 text-center bg-light position-relative">
                                            <span class="d-block mb-1 small fw-bold text-dark">Image 4</span>
                                            <div class="img-preview-box mb-2">
                                                <img class="img-thumb" id="sub3r{{ $key }}" src="{{ isset($p_imgs[3]) && !empty($p_imgs[3]) ? url('assets/images/products/detail/'.$p_imgs[3]) : '' }}" style="max-height: 100%; max-width: 100%; object-fit: contain; {{ isset($p_imgs[3]) && !empty($p_imgs[3]) ? '' : 'display:none;' }}" />
                                            </div>
                                            <span class="btn btn-xs btn-outline-primary btn-productimg w-100">
                                                <i class="fa fa-cloud-upload"></i> Upload
                                                <input class="form-control add_product" type="file" onchange="previewsubImg3(this)" id="subimg3{{ $key }}" name="subimg3[]" accept="image/*">
                                            </span>
                                            <input type="hidden" name="old_subimg3[]" value="{{ $p_imgs[3] ?? '' }}">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            
            <div class="input_fields_wrap"></div>
            
            <div class="d-flex justify-content-end">
                <button type="button" id="add_m" name="addproduct[]" value="{{ count($productdetailss) - 1 }}" class='btn btn-xs btn-primary mb-3 mt-3'>
                    <i class="fa fa-plus"></i> ADD MORE VARIANT
                </button>
            </div>  
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        // Evaluate stock indicators immediately on load
        $(".low_stock_limit").each(function(index) {
            var ind = index + 1;
            var quantity = $("#qty" + ind).val();           
            var lowstack = $("#low_stock_limit" + ind).val();
            
            if (parseInt(quantity) > parseInt(lowstack)) {
                $('#lowstack' + ind).html('Qty <span class="text-danger">*</span>');
            } else {
                $('#lowstack' + ind).html('Qty <span class="text-danger">*</span>');
            }
        });
        
        // Listen for live input changes to update stock status badge dynamically
        $(document).on('input', '.qty, .low_stock_limit', function() {
            var idAttr = $(this).attr('id');
            var ind = idAttr.replace('qty', '').replace('low_stock_limit', '');
            var quantity = $("#qty" + ind).val();
            var lowstack = $("#low_stock_limit" + ind).val();
            
            if (quantity && lowstack) {
                if (parseInt(quantity) > parseInt(lowstack)) {
                    $('#lowstack' + ind).html('Qty <span class="text-danger">*</span>');
                } else {
                    $('#lowstack' + ind).html('Qty <span class="text-danger">*</span>');
                }
            }
        });

        // Remove variant handler
        $(document).on('click', '.remove_field', function(e) {
            e.preventDefault();
            var ids = $(this).val();
            var card = $(this).closest('.w');
            
            if (ids && ids !== "") {
                if (confirm('Are you sure you want to delete this variant?')) {
                    var url = "{{ route('productdetailsdelete', ':ad_id') }}";
                    url = url.replace(":ad_id", ids);
                    
                    $.ajax({
                        url: url,       
                        type: "post",
                        data: {
                            "_token": "{{ csrf_token() }}"
                        },
                        dataType: 'json',
                        success: function (response) {
                            card.remove();
                        },
                        error: function() {
                            card.remove();
                        }
                    });
                }
            } else {
                card.remove();
            }
        });
    });
</script>
