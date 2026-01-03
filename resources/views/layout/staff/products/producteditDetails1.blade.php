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
                                              

                                                    @foreach( $productdetailss  as  $key => $productdetails)
                                                    <div class="w row">
                                                        <div class="col-md-3">

                                                            <div class="form-group">
                                                                <label class="">Option 1</label>
                                                                <img src="{{ url('assets/images/products/detail/'.$productdetails->product_detail_image) }}" id="im1" name="nproducts[]" height="100" width="100">
                                                                {{-- <input class="form-control" type="file" id="mainImg"
                                                                    name="mainImage" /> --}}

                                                                <input class="form-control add_product" type="file" id="im{{ $key }}" name="nproducts[]"  multiple accept="image/*">
                                                                
                                                                <input class="form-control" type="hidden" id="im1" name="oldnproducts[]" value="{{ $productdetails->product_detail_image }}">
                                                              </div>
                                                            
                                                                <!--      <label class="text-center border text-dark p-2" style=""><span
                                                                                class="">Upload Main Image</span>
                                                                            <input type="file" class="form-control" style="display:none "
                                                                                onchange="img(this)" id="im1"
                                                                                name="product_detail_image[]" accept="image/*">
                                                                                <input type="hidden" name="nproducts[]" value="1" >
                                                                        </label>  -->
                                                        </div>
                                
                                                        <div class="col-md-9">
                                                            
                                                            <div class="row">
                                                             
                                                                <div class="col-md-2">
                                                                    <select class="form-select form-select-lg text-secondary"
                                                                    name="attrcolor[]" id="attrcolor" required>

                                                                    @foreach ($attribute as $attri)
                                                                    {{-- @dd($attri); --}}
                                                                
                                                                        @if($attri->attribute_name == 'color')

                                                                            <?php
                                                                            //    dd($attri->value);
                                                                            $val = JSON_decode($attri->value);
                                                                            //  dd($val);
                                                                            //  print_r($val[0]->id);exit();
                                                                                $count = count($val);
                                                                            
                                                                        
                                                                                for($i=0; $i < $count ; $i++) {
                                                                                    ?>

                                                                                    <option id=""
                                                                                    value="{{ $val[$i]}}" {{ ($val[$i] == $productdetails->color)?'selected':'';}}>
                                                                                    {{ $val[$i] }}
                                                                                    </option>
                                                                                    <?php
                                                                                }
                                                                            ?>
                                                                        @endif
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                          
                                                                <div class="col-md-2">
                                                                    <select class="form-select form-select-lg text-secondary"
                                                                    name="attrsize[]" id="attrsize" required>
                                                                    @foreach ($attribute as $attri)
                                                                    @if($attri->attribute_name == 'size')

                                                                        <?php
                                                                        //    dd($attri->value);
                                                                        $val = JSON_decode($attri->value);
                                                                        //  dd($val);
                                                                        //  print_r($val[0]->id);exit();
                                                                            $count = count($val);
                                                                        
                                                                    
                                                                            for($i=0; $i < $count ; $i++) {
                                                                                ?>

                                                                                <option id=""
                                                                                value="{{ $val[$i]}}" {{ ($val[$i] == $productdetails->size)?'selected':'';}}>
                                                                                {{ $val[$i] }}
                                                                                </option>
                                                                                <?php
                                                                            }
                                                                        ?>
                                                                    @endif
                                                                    @endforeach
                                                                  </select>
                                                                </div>
                                                              
                                                                <div class="col-md-2">
                                                                    <input type="text" name="retail_price[]"
                                                                        placeholder="Retail Price" class="form-control" required value="{{ $productdetails->retail_price }}">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <input type="text" name="selling_price[]"
                                                                        placeholder="Selling Price" class="form-control" required value="{{ $productdetails->selling_price }}">
                                                                </div>
                                                                
                                                                <div class="col-md-2">
                                                                    <input type="number" class="form-control"
                                                                        placeholder="Qty" name="quantity[]" required value="{{ $productdetails->quantity }}">
                                                                </div>
                                                              
                                                                
                                                            </div>
                                                        
                                                            <div class="row mt-3">
                                                               
                                                               
                                                                
                                                                <div class="col-md-2">
                                                                    <input type="text" name="sku[]" placeholder="SKU"
                                                                        class="form-control" required  value="{{ $productdetails->sku }}">

                                                                        <input type="hidden" name="product_details_id[]" placeholder=""
                                                                        class="form-control" required  value="{{ $productdetails->id }}">

                                                                        {{-- <input type="hidden" name="product_attri_id[]" placeholder=""
                                                                        class="form-control" required  value="{{ $productsAttri->id }}"> --}}
                                                                </div> 
                                                               
                                                                <div class="col-md-2">
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
                                                                        <option value="4">
                                                                            NA
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
                                                                        <option value="4">
                                                                            NA
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
                                                                        <option value="4">
                                                                            NA
                                                                        </option>
                                                                        <?php } ?>
                                                                    </select>
                                                                </div>
                                
                                                               
                                
                                                                <div class="col-md-2">
                                                                    <input type="text" name="r_days[]" placeholder="Days"
                                                                        class="form-control" required value="{{ $productdetails->r_days }}">
                                                                </div>  
                                                                <div class="col-md-2">
                                                                    <input type="number" name="low_stock_limit[]"
                                                                        placeholder="Low Stock Limit" class="form-control" required value="{{ $productdetails->low_stock_limit }}">
                                                                </div>  

                                                                {{$inc=$key + 1;}}
                                                                
                                                                <div class="col-md-1 ">
                                                                     <a href="#" class="remove_field h6 btn btn-sm bg-warning m-0" id="remove_field{{$inc}}" value= "{{ $productdetails->id }}" >remove</a>

                                                                     <input type="hidden" name="pro_id" id="pro_id{{$inc}}"
                                                                        placeholder="" class="form-control" required value="{{ $productdetails->id }}">
                                                                    </div>
                                                                
                                                            </div> 
                                                            
                                                          </div>
                                                         
                                                         
                                                        </div>
                                
                                                        
                        
                                                    
                                                </div>
                                                <div class="col-md-12" id="r{{$key}}"> 
                                
                                                </div>
                                                @endforeach
                                               
                                                <div class="col-md-12"> 
                                
                                                    <div class="input_fields_wrap" >
                                                            {{-- <h3>test</h3> --}}
                                                    </div>
                    
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


$(document).on("click", ".remove_field", function(e) { //user click on remove text
    
    var id = $(this).attr('id');
    
    // $(".remove_field").each(function(index){
    //     var a = $("#pro_id_"+index).val();
    
    // });
        // $(this).html(index+1);
           let split_id  = id.split("remove_field");
  
           let new_id  =split_id[1];
           // alert(new_id);
        //    var url =  "{{ url('products.crud.productdetailsdelete') }}";
            var pid = $("#pro_id"+new_id).val();

                        $.ajax({
                        url: '{{ url('products.crud.productdetailsdelete') }}',
                        
                        type: "POST",
                        data: {
                            "_token": "{{ csrf_token() }}",
                            "id": pid
                        },

                        dataType: "json",
                        success: function(data) {
                          
                           
                               $(this).closest('.w').remove();
                          
                        }
                    });

  //alert(pid);
    
    //   var b = JSON.stringify(a);
      
      //alert(a);
   // alert("Value: " + $(this).val(''););
            // e.preventDefault();
            // $(this).closest('.w').remove();
            // x--;
         
    
        })
      
    // Dynamically add-on fields



$(function() {
    // Remove button click
    $(document).on(
        'click',
        '[data-role="dynamic-fields"] > .form-inline [data-role="remove_field"]',
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
                   // alert(id);
                    const myArray = id.split("im");
                    let myid=   myArray[1];
                //alert(myid);
                var files = e.target.files,
                    filesLength = files.length;
                   // alert(filesLength);
                for (var i = 0; i < filesLength; i++) {
                    var f = files[i]
                    var fileReader = new FileReader();
                    fileReader.onload = (function(e) {
                    var file = e.target;
                    $("<div class='col-md-2'><div class=\"img-thumb-wrapper card shadow\">" +
                        "<img class=\"img-thumb\" src=\"" + e.target.result + "\" title=\"" + file.name + "\"/>" +
                        "<br/><span class=\"remove bg-dark text-center fw-bold\">Remove</span>" +
                        "</div></div>").insertAfter("#r"+myid);
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