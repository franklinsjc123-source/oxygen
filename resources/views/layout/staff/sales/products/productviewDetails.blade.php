<div class="form-group" style="background-color:#80808036;">
    <div class="row tab-border" id="p1" style="">
        <div class="container-fluid  w-100">
            <div class="bg-light">
                <div class="col-xl-12 p-0 ">
                </div>
                <div class="col-xl-12">
                    <div class="tab-content nav-material" id="top-tabContent"
                        style="padding:20px; background-Color:#fff;">
                        <div class="tab-pane fade active show" id="top-home" role="tabpanel"
                            aria-labelledby="top-home-tab">
                            <div class="col-xl-12">
                                <div class="col-md-12" style="" id="dis1">
                                    <div class="form-group p-1">
                                        <div class="row">
                                            <div id="append" style="">
                                                <span id="s1" class="badge bg-secondary text-white"></span>
                                                &nbsp;
                                                <span class="badge bg-secondary text-white" id="s2"></span>
                                            </div>
                                            <div data-role="dynamic-fields">
                                             <div class="form-inline form-row">
                                                <div class="container" id="product_details">
                                              

                                                    @foreach( $productdetailss  as $productdetails)
                                                    <div class="row">
                                                        <div class="col-md-3">

                                                            <div class="form-group">
                                                                <label class="">Option 1</label>
                                                                <img src="{{ url('assets/images/products/detail/'.$productdetails->product_detail_image) }}" id="im1" name="nproducts[]" height="100" width="100">
                                                                {{-- <input class="form-control" type="file" id="mainImg"
                                                                    name="mainImage" /> --}}

                                                                <input class="form-control add_product" type="file" id="im1" name="nproducts[]" multiple accept="image/*">
                                                                
                                                                <input class="form-control" type="hidden" id="im1" name="oldnproducts[]" value="{{ $productdetails->product_detail_image }}">
                                                              </div>
                                                            
                                                               
                                                        </div>
                                
                                                        <div class="col-md-9">
                                                            
                                                            <div class="row">
                                                                <?php
                                                        
                                                                ?>

                                                
                                                            @foreach ($productsAttri as $productsAttr)

                                                            
                                                                <div class="col-md-3">
                                                                    <input type="text" name="spec_attribute[]"
                                                                        placeholder="" class="form-control" required value="{{ $productsAttr->spec_attribute }}">
                                                                </div>


                                                                <div class="col-md-3">
                                                                    <input type="text" name="spec_value[]"
                                                                        placeholder="spec_value" class="form-control" required value="{{ $productsAttr->spec_value }}">
                                                                </div>
                                                            
                                                                   @endforeach

                                                                <div class="attrcolor">
                                                                  
                                                                </div>

                                                                <div class="col-md-3">
                                                                    <input type="text" name="retail_price[]"
                                                                        placeholder="Retail Price" class="form-control" required value="{{ $productdetails->retail_price }}">
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <input type="text" name="selling_price[]"
                                                                        placeholder="Selling Price" class="form-control" required value="{{ $productdetails->selling_price }}">
                                                                </div>
                                                                
                                                                <div class="col-md-3">
                                                                    <input type="number" class="form-control"
                                                                        placeholder="Qty" name="quantity[]" required value="{{ $productdetails->quantity }}">
                                                                </div>
                                                              
                                                                <div class="col-md-3">
                                                                    <input type="text" name="sku[]" placeholder="SKU"
                                                                        class="form-control" required  value="{{ $productdetails->sku }}">

                                                                        <input type="hidden" name="product_details_id[]" placeholder=""
                                                                        class="form-control" required  value="{{ $productdetails->id }}">

                                                                        {{-- <input type="hidden" name="product_attri_id[]" placeholder=""
                                                                        class="form-control" required  value="{{ $productsAttri->id }}"> --}}
                                                                </div> 
                                                            </div>
                                                        
                                                            <div class="row mt-3">
                                                               
                                                               
                                                                
                                                                
                                                               
                                                                <div class="col-md-3">
                                                                    <select class="form-select form-select-lg text-secondary"
                                                                        name="return_replace[]" required>
                                                                        <?php if($productdetails->return_replace == 1) { ?>
                                                                        <option selected value="1">
                                                                            Return /
                                                                            Replacement
                                                                        </option>
                                                                        <option value="2">
                                                                            Return
                                                                        </option>
                                                                        <option value="3">
                                                                            Replacement
                                                                        </option>
                                                                        <?php } ?>
                                                                        <?php if($productdetails->return_replace == 2) { ?>
                                                                        <option selected value="2">
                                                                            Return
                                                                        </option>
                                                                        <option value="1">
                                                                            Return /
                                                                            Replacement
                                                                        </option>
                                                                        <option value="3">
                                                                            Replacement
                                                                        </option>
                                                                        <?php } ?>
                                                                        <?php if($productdetails->return_replace == 3) { ?>
                                                                        <option selected value="3">
                                                                            Replacement
                                                                        </option>
                                                                        <option value="1">
                                                                            Return /
                                                                            Replacement
                                                                        </option>
                                                                        <option value="2">
                                                                            Return
                                                                        </option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                
                                                               
                                
                                                                <div class="col-md-3">
                                                                    <input type="text" name="r_days[]" placeholder="Days"
                                                                        class="form-control" required value="{{ $productdetails->r_days }}">
                                                                </div>  
                                                                <div class="col-md-3">
                                                                    <input type="number" name="low_stock_limit[]"
                                                                        placeholder="Low Stock Limit" class="form-control" required value="{{ $productdetails->low_stock_limit }}">
                                                                </div>  
                                
                                                               
                                
                                                           
                                                                
                                                            </div> 
                                                             
                                                          </div>
                                                        </div>
                                
                                                       
                                                        <div class="col-md-12"> 
                                
                                                            <div class="input_fields_wrap" >
                                                                    {{-- <h3>test</h3> --}}
                                                            </div>
                            
                                                            </div> 
                                
                                                     @endforeach

                                                    
                                                </div>
                                                     
                                             </div>

                                                   
                                                                      
                                                 </div>
                                                    
                                                    {{-- <div style="float:right">
                                                        <button  type="button" id="add_m" onclick="addmore()" class=' btn btn-xs bg-gradient-dark   btn-primary mb-3 mt-3' id="a1"  >ADD More </button>
                                                        </div>      --}}

                                                </div>
                                                </div>
                                            </div>
                                           


                                        </div>
                                        <div class="more-products"></div>
                                       
                                    </div>

                                    <div class="text-start mt-3">
                                       
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

{{-- <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css"> --}}
{{-- <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script> --}}
<!------ Include the above in your HEAD tag ---------->

{{-- <link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"/> --}}




<script>
    // Dynamically add-on fields

$(function() {
    // Remove button click
    $(document).on(
        'click',
        '[data-role="dynamic-fields"] > .form-inline [data-role="remove"]',
        function(e) {
            e.preventDefault();
            $(this).closest('.form-inline').remove();
        }
    );
    // Add button click
    $(document).on(
        'click',
        '[data-role="dynamic-fields"] > .form-inline [data-role="add"]',
        function(e) {
            e.preventDefault();
            var container = $(this).closest('[data-role="dynamic-fields"]');
            new_field_group = container.children().filter('.form-inline:first-child').clone();
          new_field_group.find('label').html('Upload Document'); new_field_group.find('input').each(function(){
                $(this).val('');
            });
            container.append(new_field_group);
        }
    );
});



// file upload

// $(document).on('change', '.file-upload', function(){
//   var i = $(this).prev('label').clone();
//   var file = this.files[0].name;
//   $(this).prev('label').text(file);
// });





/*image preview*/

        $(document).ready(function() {
            if (window.File && window.FileList && window.FileReader) {
                $(".add_product").on("change", function(e) {
                    var id = $(this).attr('id');
                 
                var files = e.target.files,
                    filesLength = files.length;
                for (var i = 0; i < filesLength; i++) {
                    var f = files[i]
                    var fileReader = new FileReader();
                    fileReader.onload = (function(e) {
                    var file = e.target;
                    $("<div class='col-md-2'><div class=\"img-thumb-wrapper card shadow\">" +
                        "<img class=\"img-thumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                        "<br/><span class=\"remove\">Remove</span>" +
                        "</div></div>").insertAfter("#r1");
                    $(".remove").click(function(){
                        $(this).parent(".img-thumb-wrapper").remove();
                    });
                    
                    });
                    fileReader.readAsDataURL(f);
                }
                console.log(files);
                });
            } else {
                alert("Your browser doesn't support to File API")
            }
            });


             // Get Attr
        
   


    
    </script>