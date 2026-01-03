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
.btn-productimg {
    position: relative;
    overflow: hidden;
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
                                    <div class="form-group p-1"><label class="text-danger">(Image size 150x250, accepted files : jpg, jpeg, png, web)</label>
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
                                                            <div class="form-group flex">                                                                
                                                                {{-- <label class="text-secondary fw-bold">Upload main image</label> --}}
                                                                {{-- <label class="">Option 1</label> --}}
                                                                <div class="col-md-3">
                                                                    <span class="btn btn-primary btn-productimg" > 
                                                                        <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                                                       <input class="form-control add_product" type="file" id="p_mainimg" name="mainimg[]"  accept="image/*">
                                                                    </span><label class="text-secondary fw-bold">Upload main image</label>
                                                                </div>
                                                                
                                                                <div class="col-md-3">
                                                                    <span class="btn btn-primary btn-productimg"  > 
                                                                        <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                                                        <input class="form-control add_product" type="file" id="subimg1" name="subimg1[]"  accept="image/*">
                                                                     </span><label class="text-secondary">Upload Sub image1</label>
                                                                </div>
                                                                
                                                                <div class="col-md-3">
                                                                    <span class="btn btn-primary btn-productimg"  >
                                                                        <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                                                       <input class="form-control add_product" type="file" id="subimg2" name="subimg2[]"  accept="image/*">
                                                                    </span><label class="text-secondary">Upload Sub image2</label>
                                                                </div>
                                                                
                                                                <div class="col-md-3">
                                                                    <span class="btn btn-primary btn-productimg" >
                                                                        <i class="fa fa-cloud-upload" aria-hidden="true"></i>
                                                                       <input class="form-control add_product" type="file" id="subimg3" name="subimg3[]"  accept="image/*">
                                                                    </span><label class="text-secondary">Upload Sub image2</label>
                                                                </div>
                                                                
                                                                {{-- <div class="new_Btn text-primary fw-bold"><i class="fa fa-file-image-o" aria-hidden="true"></i>Main Img</div><br> --}}
                                                                {{-- <input style="display: none;" id="html_btn" type='file' /><br>
                                                                <input class="form-control add_product" type="file" id="im1" name="mainimg[]"  accept="image/*">
                                                                <input class="form-control add_product" type="file" id="im1" name="subimg1[]"  accept="image/*">
                                                                <input class="form-control add_product" type="file" id="im1" name="subimg2[]"  accept="image/*">
                                                                <input class="form-control add_product" type="file" id="im1" name="subimg3[]"  accept="image/*"> --}}

                                                                <input type="hidden" name="product_details_id[]" placeholder=""
                                                                        class="form-control" required >
                                                            </div>                                                            
                                                        </div>
                                                        
                                                        <div class="col-md-9">                                                            
                                                            <div class="row">                                                             
                                                                <div class="col-md-2">
                                                                    <select class="form-select form-select-lg text-secondary attrsize" name = "attrsize[]" id ="attrsize">
                                                                        <option hidden>Size</option>
                                                                    </select>        
                                                                </div>                                                                    
                                                                    <div class="col-md-2">
                                                                     <select class="form-select form-select-lg text-secondary attrcolor"
                                                                            name="attrcolor[]" id ="attrcolor">
                                                                            <option hidden>Color</option>
                                                                        </select>  
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
                                                                        class="form-control" required>
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
                                                                        <option  value="4">
                                                                            NA
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
                                                                {{-- <div class="col md-8">
                                                                   <div class="col-md-2" id="r1"> 
                                                                   </div>
                                                                   <div class="col-md-2" id="r2"> 
                                                                 </div>
                                                                 <div class="col-md-2" id="r3"> 
                                                                 </div>
                                                                 <div class="col-md-2" id="r4"> 
                                                                 </div>
                                                                </div> --}}
                                                              
                                                                <div class='col-md-2'><div class="img-thumb-wrapper card shadow">
                                                                    <img class="img-thumb" id="mainr1"  src=""   />
                                                                    <br/><span class="removeimg" id="removemainimg" value="mainimg">Remove</span>
                                                                </div></div>
                                                                <div class='col-md-2'><div class="img-thumb-wrapper card shadow">
                                                                    <img class="img-thumb" id="sub1r1"  src=""   />
                                                                    <br/><span class="removeimg" id="removesub1img" value="subimg1">Remove</span>
                                                                </div></div>


                                                                <div class='col-md-2'><div class="img-thumb-wrapper card shadow">
                                                                    <img class="img-thumb" id="sub2r1"  src=""   />
                                                                    <br/><span class="removeimg" id="removesub2img" value="subimg2">Remove</span>
                                                                </div></div>


                                                                <div class='col-md-2'><div class="img-thumb-wrapper card shadow">
                                                                    <img class="img-thumb" id="sub3r1"  src=""   />
                                                                    <br/><span class="removeimg" id="removesub3img" value="subimg3">Remove</span>
                                                                </div></div> 
                                                    </div> 
                                                                <div class="col-md-12" >                                 
                                                                    <div class="input_fields_wrap">
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
                                </div>                                        
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
        '[data-role="dynamic-fields"]> .form-inline [data-role="add"]',
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
                $(".add_prgfngfhgfhoduct").on("change", function(e) {
                    var id = $(this).attr('id');
                     const myArray = id.split("im");
            let myid=   myArray;
            const iterator = myid.length;
            //alert (id);

                var files = e.target.files,
                    filesLength = files.length;
                for (var i = 0; i < 4; i++) {
                    var f = files[i]
                    var fileReader = new FileReader();
                    fileReader.onload = (function(e) {
                    var file = e.target;
                    $("<div class='col-md-2'><div class=\"img-thumb-wrapper card shadow\">" +
                        "<img class=\"img-thumb\"  src=\"" + e.target.result + "\"  title=\"" + file.name + "\" />" +
                        "<br/><span class=\"remove\">Remove</span>" +
                        "</div></div>").insertAfter("#r1");
                    $(".removeimg").click(function(){
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

//ID GET
            $(document).ready(function() {
            if (window.File && window.FileList && window.FileReader) {
                $("#p_mainimg").on("change", function(e) {
                    var lll = $(this);
                    alert(lll);
                    var id = $(this).attr('id');
                    var img = document.getElementById('mainr1');
                    if (this.files && this.files[0]) {                      
                    
                    img.onload = () => {
                        URL.revokeObjectURL(img.src);  // no longer needed, free memory
                    }
                    // $(this).parent(".img-thumb-wrapper").remove();
                    // $("<div class='col-md-2'><div class=\"img-thumb-wrapper card shadow\">" +
                    //     "<img class=\"img-thumb\"  src=\"" +URL.createObjectURL(this.files[0])+ "\"   />" +
                    //     "<br/><span class=\"remove\">REEemove</span>" +
                    //     "</div></div>").insertAfter("#r1");
                    //     $(".remove").click(function(){
                    //     $(this).parent(".img-thumb-wrapper").remove();
                    //     });
                     img.src = URL.createObjectURL(this.files[0]); // set src to blob url
                    }  else{
                       // $("#"+img).empty();
                        img.src="";
                    }               
                console.log(files);
                });
                $("#subimg1").on("change", function(e) {
                    var id = $(this).attr('id');
                    if (this.files && this.files[0]) {
                    var img = document.getElementById('sub1r1');
                    img.onload = () => {
                        URL.revokeObjectURL(img.src);  // no longer needed, free memory
                    }
                  
                    // $("<div class='col-md-2'><div class=\"img-thumb-wrapper card shadow\">" +
                    //     "<img class=\"img-thumb\"  src=\"" +URL.createObjectURL(this.files[0])+ "\"   />" +
                    //     "<br/><span class=\"remove\">REEemove</span>" +
                    //     "</div></div>").insertAfter("#r3");
                    //     $(".removeimg").click(function(){
                    //     $(this).parent(".img-thumb-wrapper").remove();
                    //     }); 
                     img.src = URL.createObjectURL(this.files[0]); // set src to blob url
                    }                 
                console.log(files);
                });
                $("#subimg2").on("change", function(e) {
                    var id = $(this).attr('id');
                    if (this.files && this.files[0]) {
                    var img = document.getElementById('sub2r1');
                    img.onload = () => {
                        URL.revokeObjectURL(img.src);  // no longer needed, free memory
                    }
                    // $("<div class='col-md-2'><div class=\"img-thumb-wrapper card shadow\">" +
                    //     "<img class=\"img-thumb\"  src=\"" +URL.createObjectURL(this.files[0])+ "\"   />" +
                    //     "<br/><span class=\"remove\">REEemove</span>" +
                    //     "</div></div>").insertAfter("#r1");
                    //     $(".removeimg").click(function(){
                    //     $(this).parent(".img-thumb-wrapper").remove();
                    //     });
                     img.src = URL.createObjectURL(this.files[0]); // set src to blob url
                    }                 
                console.log(files);
                });
                $("#subimg3").on("change", function(e) {
                    var id = $(this).attr('id');
                    if (this.files && this.files[0]) {
                    var img = document.getElementById('sub3r1');
                    img.onload = () => {
                        URL.revokeObjectURL(img.src);  // no longer needed, free memory
                    }
                    // $(this).parent(".img-thumb-wrapper").remove();
                    // $("<div class='col-md-2'><div class=\"img-thumb-wrapper card shadow\">" +
                    //     "<img class=\"img-thumb\"  src=\"" +URL.createObjectURL(this.files[0])+ "\"   />" +
                    //     "<br/><span class=\"remove\">REEemove</span>" +
                    //     "</div></div>").insertAfter("#r1");
                    //     $(".removeimg").click(function(){
                    //     $(this).parent(".img-thumb-wrapper").remove();
                    //     });
                     img.src = URL.createObjectURL(this.files[0]); // set src to blob url
                    }                 
                console.log(files);
                });
            } else {
                alert("Your browser doesn't support to File API")
            }
            });


            $("#removemainimg").click(function(e) {

              // $(this).parent('img').empty();
                var img = document.getElementById('mainr1');
                //$("#"+img).empty();
                img.src = "";

                var id = $(this).attr('value');
                //alert(id);
                $('input[id = '+id+']').val("");
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









//     window.addEventListener('load', function() {
//   document.querySelector('input[type="file"]').addEventListener('change', function() {
//       if (this.files && this.files[0]) {
//           var img = document.querySelector('img');
//           img.onload = () => {
//               URL.revokeObjectURL(img.src);  // no longer needed, free memory
//           }

//           img.src = URL.createObjectURL(this.files[0]); // set src to blob url
//       }
//   });
// });














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



    //selsect pic

    $('.new_Btn').click(function() {
  $('#html_btn').click();
});

    //end




    </script>