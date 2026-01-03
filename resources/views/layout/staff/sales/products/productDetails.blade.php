<style>
    .img-thumb {
  max-height: 75px;
  border: 2px solid none;
   border-radius:3px;
  padding: 1px;
  cursor: pointer;
}
.img-thumb-wrapper {
  display: inline-block;
  margin: 10px 10px 0 0;
}
.remove {
  display: block;
  background: #444;
  border: 1px solid none;
  color: white;
  text-align: center;
  cursor: pointer;
}
.remove:hover {
  background: white;
  color: black;
}
    </style>
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

                                                    <div class="row">
                                                        <div class="col-md-3">

                                                            <div class="form-group">
                                                                <label class="">Option 1</label>
                                                                <input class="form-control add_product" type="file" id="im1" name="nproducts[]" multiple accept="image/*">
                                                                
                                                              </div>
                                                             
                                                        </div>
                                
                                                        <div class="col-md-9">
                                                            
                                                            <div class="row">
                                                             
                                                                
                                                                <div class="col-md-2">
                                                                    <select class="form-select form-select-lg text-secondary attrsize" name ="attrsize[]" id ="attrsize"></select>        
                                                                 </div>
                                                                    
                                                                    <div class="col-md-2">
                                                                     <select class="form-select form-select-lg text-secondary attrcolor"
                                                                            name="attrcolor[]" id ="attrcolor"></select>  
                                                                     </div>

                                                                <div class="col-md-2">
                                                                    <input type="text" name="retail_price[]"
                                                                        placeholder="Retail Price" class="form-control" required>
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <input type="text" name="selling_price[]"
                                                                        placeholder="Selling Price" class="form-control" required>
                                                                </div>
                                                                
                                                                <div class="col-md-2">
                                                                    <input type="number" class="form-control"
                                                                        placeholder="Qty" name="quantity[]" required>
                                                                </div>
                                                              
                                                                 
                                                             </div>
                                                        
                                                             <div class="row mt-3">
                                                               
                                                               
                                                                
                                                                <div class="col-md-2">
                                                                    <input type="text" name="sku[]" placeholder="SKU"
                                                                        class="form-control" required  >
                                                                </div>
                                                               
                                                                <div class="col-md-2">
                                                                    <select class="form-select form-select-lg text-secondary"
                                                                        name="return_replace[]" required>
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
                                                                    </select>
                                                                </div>
                                
                                                               
                                
                                                                <div class="col-md-2">
                                                                    <input type="text" name="r_days[]" placeholder="Days"
                                                                        class="form-control" required>
                                                                </div>  
                                                                <div class="col-md-2">
                                                                    <input type="number" id="low_stock_limit" name="low_stock_limit[]"
                                                                        placeholder="Low Stock Limit" class="form-control" required>
                                                                </div>  
                                   
                                                            </div> 
                                                             
                                                         </div>
                                                              <div class="col-md-12" id="r1"> 
                                                              </div>
                            
                                                        </div> 

                                                            <div class="col-md-12" > 
                                
                                                                <div class="input_fields_wrap" >
                                                                        <h3 class=""></h3>
                                                                </div>
                                
                                                            </div> 

                                                 </div>
                                                        
                                                                      
                                                 </div>
                                                    
                                                    <div style="float:right">
                                                        <button  type="button" id="add_m"  class=' btn btn-xs bg-gradient-dark   btn-primary mb-3 mt-3' id="a1"  >ADD More </button>
                                                        </div>     

                                                </div>
                                                </div>
                                            </div>
                                            {{-- <div data-role="dynamic-fields">
                                                <div class="form-inline form-row">
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <input type="text" name="retail_price[]"
                                                                placeholder="Retail Price" class="form-control"
                                                                required>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="text" name="selling_price[]"
                                                                placeholder="Selling Price" class="form-control"
                                                                required>
                                                        </div>

                                                        <div class="col-md-1">
                                                            <input type="text" class="form-control" placeholder="Qty"
                                                                name="quantity[]" required>
                                                        </div>

                                                        <div class="col-md-1">
                                                            <input type="text" name="sku[]" placeholder="SKU"
                                                                class="form-control" required>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <select class="form-select form-select-lg text-secondary"
                                                                name="return_replace[]" required>
                                                                <option selected value="" hidden>
                                                                    Return /
                                                                    Replacement
                                                                </option>
                                                                <option value="1">
                                                                    Return
                                                                </option>

                                                                <option value="2">
                                                                    Replacement
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="text" name="r_days[]" placeholder="Days"
                                                                class="form-control" required>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="number" name="low_stock_limit[]"
                                                                placeholder="Low Stock Limit" class="form-control"
                                                                required>
                                                        </div>
                                                    </div>
                                                  
                                                 
                                                                        
                                                    <button class="btn btn-sm btn-danger  mb-2" data-role="remove">
                                                     <i class=""></i>Remove
                                                    </button>
                                                    <button class="btn btn-sm btn-primary  mb-2" data-role="add">
                                                        <i class=""></i>Add
                                                    </button>
                                                    
                                                    
                                                </div> 
                                            </div>  --}}



                                            {{-- <div data-role="dynamic-fields">
                                                <div class="form-inline form-row">
                                                    <div class="row">
                                                        <div class="col-md-2">
                                                            <input type="text" name="retail_price[]"
                                                                placeholder="Retail Price" class="form-control"
                                                                required>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="text" name="selling_price[]"
                                                                placeholder="Selling Price" class="form-control"
                                                                required>
                                                        </div>

                                                        <div class="col-md-1">
                                                            <input type="text" class="form-control" placeholder="Qty"
                                                                name="quantity[]" required>
                                                        </div>

                                                        <div class="col-md-1">
                                                            <input type="text" name="sku[]" placeholder="SKU"
                                                                class="form-control" required>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <select class="form-select form-select-lg text-secondary"
                                                                name="return_replace[]" required>
                                                                <option selected value="" hidden>
                                                                    Return /
                                                                    Replacement
                                                                </option>
                                                                <option value="1">
                                                                    Return
                                                                </option>

                                                                <option value="2">
                                                                    Replacement
                                                                </option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="text" name="r_days[]" placeholder="Days"
                                                                class="form-control" required>
                                                        </div>
                                                        <div class="col-md-2">
                                                            <input type="number" name="low_stock_limit[]"
                                                                placeholder="Low Stock Limit" class="form-control"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}


                                        </div>
                                        <div class="more-products"></div>
                                        {{-- <div class="row">
                                            <div class="col-md-12">


                                                <button class="btn btn-sm btn-danger  mb-2" data-role="remove">
                                                <i class="fa fa-minus"></i>
                                                </button>
                                                <button class="btn btn-sm btn-primary  mb-2" data-role="add">
                                                    remove
                                                </button>

                                                <span id="img1" width="20%" class=""></span><a
                                                    href="#" class="btn-sm btn-danger" onclick="rmimg(this)"
                                                    id="rim1" style="visibility:hidden;">remove</a>
                                            </div>
                                        </div> --}}
                                    </div>

                                    <div class="text-start mt-3">
                                        {{-- <button type="button" id="add-more" class="add_field_button add-more btn btn-primary ">
                                            Add
                                            more
                                        </button> --}}
                                        {{-- <button class="btn btn-sm btn-primary  mb-2" data-role="add">
                                            <i class="fa fa-plus"></i>
                                        </button> --}}
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



 //image preciew

            

    // $("#im1").on("change", function(e) {
    //         //console.log(e);
            
    //         var files = e.target.files,
    //             filesLength = files.length;
            
    //         for (var i = 0; i < filesLength; i++) {
    //             var f = files[i]
    //             var fileReader = new FileReader();
    //             fileReader.onload = (function(e) {
    //                 var file = e.target;
                  
    //                 $("<span class=\"pip\">" +
    //                     "<img class=\"imageThumb\" src=\"" + e.target.result +
    //                     "\" title=\"" + file.name + "\"/>" +
    //                     "<br/><span class=\"remove\">Remove image</span>" +
    //                     "</span>").insertAfter("#im1");<br/>
    //                 $(".remove").click(function() {
    //                     $(this).parent(".pip").remove();
    //                 });

    //             });
    //             fileReader.readAsDataURL(f);
    //         }
    //     });



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
       
    //     function onChangeCall() {
    //         $('#sub_category').on('change', function() {
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
    //         //alert(attribute);
    //         $(".attrcolor").append(attribute);
    //     });
    // });
    //     }


    // $('#sub_category').on('change', function() {
    //         let sub_category_id = $(this).find(":selected").attr("id");
    //         let url = '{{ route('getAttributes') }}?sub_category_id=' + sub_category_id;
    //         let method = 'GET';
    //         getAjaxValue(url, method, function(data) {
    //             //alert(JSON.stringify(data))
    //             // $('#attrcolor').empty();
    //             // $('#attrsize').empty();
    //             let attribute;
    //             $.each(data, function(key, attr) {

    //                 if(attr.attribute_name == 'color'){
    //                 const myarr = JSON.parse(attr.value);
                    
    //                 for(var i=0; i<myarr.length;i++)
    //                 {
                       
    //                     $("#attrcolor").append("<option value= "+myarr[i]+">"+myarr[i]+"</option>");
    //                 }
                   
    //             }
                
    //              else if(attr.attribute_name == 'size'){
    //                 const myarr = JSON.parse(attr.value);
                    
                   
    //                 for(var i=0; i<myarr.length; i++)
    //                 {
                       
    //                     $("#attrsize").append("<option value= "+myarr[i]+">"+myarr[i]+"</option>");
    //                 }
    //               }
                
    //             });

    //           //  $(".attrcolor").append(elm);
    //     });
    // });

    //end
    </script>