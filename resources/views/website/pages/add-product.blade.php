{{-- <?php include('header.php') ?> --}}
@extends('website.layouts.master')

<link rel='stylesheet' href='https://fonts.googleapis.com/css?family=Raleway'>
<link rel='stylesheet' href='https://fonts.googleapis.com/icon?family=Material+Icons'>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<style>

.select2-container--default .select2-selection--multiple {
  background-color: white;
  border: 1px solid #aaaaaa6e;
    border-top-width: 1px;
    border-right-width: 1px;
    border-bottom-width: 1px;
    border-left-width: 1px;
  border-radius: 4px;
  cursor: text;
}
   .color {
  width: 25px !important;
  height: 25px !important;
  border-radius: 50%;
  border: none;
  background-color: transparent;
}
</style>
<!-- page-wrapper Start-->
{{-- <?php include('topmenu.php') ?> --}}

@include('website.pages.topmenu')
<!-- Page Header Ends -->

<!-- Page Body Start-->
<div class="page-body-wrapper">

    <!-- Page Sidebar Start-->
    {{-- <?php include('sidemenu.php') ?> --}}
    @include('website.pages.sidemenu')
    <!-- Page Sidebar Ends-->

    <!-- Right sidebar Start-->

    <!-- Right sidebar Ends-->
    @section('content')
    <div class="page-body">

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
                            <li class="breadcrumb-item"><a href="index.html"><i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item active">Add Product</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
        <!-- Container-fluid Ends-->

        <!-- Container-fluid starts-->
        <div class="container-fluid">



            <div class="row product-adding">
                <div class="row">
                    <div class="col-md-9">


                        <div class="col-xl-12">
                            <div class="card">
                               
                                <div class="card-body">


                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5> Primary Categories</h5>
                                                    
                                                <div class="form-group"> 

                                                <select class="js-select2 form-control">
                                                <option selected disabled>Select Here</option>
                                                <option value="Clothing & Accessories" data-badge="">Clothing & Accessories</option>
                                                        <option value="Beauty" data-badge="">Beauty</option>
                                                        <option value="Fashion" data-badge="">Fashion</option>
                                                        <option value="Electronics" data-badge="">Electronics</option>
                                                  

                                                </select>
                                                    

                                                </div>
                                            </div></div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5> Categories</h5>
                                                    <select class="js-select2 form-control">
                                                    <option selected disabled>Select Here</option>
                                                <option value="Clothing & Accessories" data-badge="">Clothing & Accessories</option>
                                                        <option value="Beauty" data-badge="">Beauty</option>
                                                        <option value="Fashion" data-badge="">Fashion</option>
                                                        <option value="Electronics" data-badge="">Electronics</option>
                                                  

                                                </select>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <h5> Sub Categories</h5>
                                                    <select class="js-select2 form-control">
                                                    <option selected disabled>Select Here</option>
                                                   <option value="men" data-badge="">MEN</option>
                                                        <option value="women" data-badge="">WOMEN</option>
                                                       
                                                  

                                                </select>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                    <div class="digital-add needs-validation">


                                        <div class="form-group">
                                            <label for="validationCustom01" class="col-form-label pt-0"><span>*</span> Product Name</label>
                                            <input class="form-control" id="validationCustom01" type="text" required>
                                        </div>
										<div class="card">
                                <div class="card-header">
                                    <h5>Add Description</h5>
                                </div>
                                <div class="card-body">
                                    <div class="digital-add needs-validation">
                                        <div class="form-group mb-0">
                                            <div class="description-sm">
                                                <textarea id="editor1" name="editor1" cols="10" rows="4"></textarea>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
										 

                                       

                                        <div class="form-group" style="background-color:#80808036;">
										<div class="row tab-border">
										<div class="col-md-6">
										<select class="form-select form-select-lg" id="select_product"  onchange="sm()" >
										
												  <option value="single">Single Product</option>
												  <option  value="multiple">Multiple Product</option>
											
												</select>
										</div></div>
										
	<script>
$(document).ready(function(){
  $("#select_product").change(function(){
	  if ($("#select_product").val() == 'single') {
     $("p2").hide();
    
}
else if($("#select_product").val() == 'multiple') {
    
	$("p1").hide();
	
}
   
  });
 
});
</script>

										
																
                                          <div class="row tab-border" id="p1" style="">
										  <div class="container">
										  <div class="">
										  
                <div class="col-xl-12 p-0 bg-gray">
                    <ul class="nav nav-tabs nav-material  nav-border fw-bold" id="top-tab" role="tablist">
                        <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab" href="#top-home" role="tab" aria-selected="true">Genreal </a></li>
                        <li class="nav-item"><a class="nav-link" id="profile-top-tab" data-bs-toggle="tab" href="#top-profile" role="tab" aria-selected="false">Inventory</a></li>
                        <li class="nav-item"><a class="nav-link" id="contact-top-tab" data-bs-toggle="tab" href="#top-contact" role="tab" aria-selected="false">Shipping</a></li>
						  <li class="nav-item"><a class="nav-link" id="attribute-top-tab" data-bs-toggle="tab" href="#attribute" role="tab" aria-selected="false">Attributes</a></li>
                    </ul>
                </div>
                <div class="col-xl-12">
                    <div class="tab-content nav-material" id="top-tabContent" style="padding:20px; background-Color:#fff;">
                        <div class="tab-pane fade active show" id="top-home" role="tabpanel" aria-labelledby="top-home-tab">
                            <div class="col-xl-12">
                                            <label class="col-form-label col-md-3"><span>*</span>GST</label>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <form id="mainForm" name="mainForm" class="d-flex justify-content-around">
                                                            @csrf
                                                            <input type="radio" name="gst" value="include"  checked onclick="r()" />Include
                                                            <input type="radio" name="gst" value="exclude"  onclick="r()" />Exclude

                                                        </form>
                                                    </div>
                                                    <div class="col-md-8">

                                                        <select class="custom-select form-control dropdown" id="gst1"  onchange="r()" required>
                                                            <option value="">--Select Gst--</option>
                                                            <option value="05">5%</option>
                                                            <option value="12">12%</option>
                                                            <option value="18">18%</option>
                                                            <option value="24">24%</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>



                                        </div>

                                        <div class="col-md-12" style="" id="dis1">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="validationCustom02" class="col-form-label"><span>*</span>MRP </label>
                                                        <input class="form-control" id="in1" type="text" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="validationCustom02" class="col-form-label"><span>*</span>Selling Price </label>
                                                        <input class="form-control" id="in2" type="text" onkeyup="r()" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="validationCustom02" class="col-form-label"><span>*</span> Offer Price </label>
                                                        <input class="form-control" id="in3" type="text" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="validationCustom02" class="col-form-label"><span>*</span>GST</label>
                                                        <input class="form-control" id="in4"  type="text" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="validationCustom02" class="col-form-label"><span>*</span> Product Price </label>
                                                        <input class="form-control" id="in5" value=""  type="text" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="validationCustom02" class="col-form-label"><span>*</span> Qty </label>
                                                        <input class="form-control" id="in6"  type="text" required>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                        </div>
                        
						<div class="tab-pane fade" id="top-profile" role="tabpanel" aria-labelledby="profile-top-tab">
                            <label for="quan" class="col-form-label pt-0">Quantity</label>
                                            <input class="form-control" id="quan" type="text" name="quan" required>
                        </div>
						
                        <div class="tab-pane fade" id="top-contact" role="tabpanel" aria-labelledby="contact-top-tab">
                               <div class="card">
                                
                                <div class="card-body">
                                    <div class="row">
                                        <h5> Shipping</h5>

                                        <div class="col-md-6 col-md-6">

                                            <div class="form-group mb-3">
                                                <label>Weight (g)</label>
                                                <div class="next-input--stylized">

                                                    <input type="text" class="form-control" name="weight" value="0" im-insert="true">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Length (cm)</label>
                                                <div class="next-input--stylized">

                                                    <input type="text" class="form-control" name="length" value="0" im-insert="true">
                                                </div>
                                            </div>
                                        </div>
                                      <div class="col-md-6 col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Wide (cm)</label>
                                                <div class="next-input--stylized">

                                                    <input type="text" class="form-control" name="wide" value="0" im-insert="true">
                                                </div>
                                            </div>
                                        </div>
                                      <div class="col-md-6 col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Height (cm)</label>
                                                <div class="next-input--stylized">

                                                    <input type="text" class="form-control" name="height" value="0" im-insert="true">
                                                </div>
                                            </div>
                                        </div>

                                    </div>



                                </div>
                            </div>
                        </div>
						
						<div class="tab-pane fade" id="attribute" role="tabpanel" aria-labelledby="attribute-top-tab">
                            <table class="table addproduct" >
										<thead class="bordered-darkorange">
											<tr role="row"> 
												<th style="width:30px;">S.NO</th>
												<th style="width:150px;">Color Name</th>
												<th style="width:150px;">Color</th>
												
											</tr>
										</thead>
										<tr >
											<td>1</td>
											
										
										<td>   
    
      
    
		<select class="form-select form-select-lg" onchange = "color()" name="color" id="color" >
        <option selected>choose color</option>
        <option value="red">red </option>
        <option value="green">green </option>
        <option value="pink">pink </option>
        
        </select>
      
    
      
 
        </td>
										
										<td><input type="color" id = "col"  class="form-control-md color"   />
										</td>

									</tr>
										<tbody class="input_fields_wrap">
										
									
									</tbody>
									
									
									
								</table>
			<br>
			                 <div class="form-group">

                                            <label class="col-form-label"><span>*</span> Product Size</label>
                                                <select class="js-select2" multiple="multiple" name="size" style="width:100%;">
                                               
                                                    <option value="O1" data-badge="">S</option>
                                                    <option value="O2" data-badge="">M</option>
                                                    <option value="O3" data-badge="">L</option>
                                                    <option value="O4" data-badge="">XL</option>
                                                    <option value="O5" data-badge="">XXL</option>
                                                    <option value="O6" data-badge="">XXXL</option>

                                                </select>
                                            
                                        </div>
								
                        </div>
						
                    </div>
                </div>
            </div></div></div>
			
				 <div class="row tab-border" id="p2" style="display:none;">
				<div class="container">
                <div class="row">				
                <div class="col-xl-12 p-0 bg-gray">
                    <ul class="nav nav-tabs nav-material  nav-border fw-bold" id="top-tab" role="tablist">
                        <li class="nav-item"><a class="nav-link active" id="top-general-tab" data-bs-toggle="tab" href="#top-general" role="tab" aria-selected="true">Genreal </a></li>
                    
                        <li class="nav-item"><a class="nav-link" id="top-shipping-tab" data-bs-toggle="tab" href="#top-shipping" role="tab" aria-selected="false">Shipping</a></li>
						  <li class="nav-item"><a class="nav-link" id="top-attr-tab" data-bs-toggle="tab" href="#top-attr" role="tab" aria-selected="false">Attributes</a></li>
                    </ul>
                </div>	
					
					
					<div class="col-xl-12 p-0 mt-2">
					<div class="tab-content nav-material" id="top-tabContent" style="padding:20px; background-Color:#fff;">
                        <div class="tab-pane fade active show" id="top-general" role="tabpanel" aria-labelledby="top-general-tab" >
									  <label class="col-form-label col-md-3"><span>*</span>GST</label>
                                            <div class="form-group">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <form id="mainForm" name="mainForm" class="d-flex justify-content-around">
                                                            <input type="radio" name="gst1" value="include"  checked onclick="r1()" />Include
                                                            <input type="radio" name="gst1" value="exclude"  onclick="r1()" />Exclude

                                                        </form>
                                                    </div>
                                                    <div class="col-md-8">

                                                        <select class="custom-select form-control dropdown" id="gst2"  onchange="r1()" required>
                                                            <option value="">--Select Gst--</option>
                                                            <option value="05">5%</option>
                                                            <option value="12">12%</option>
                                                            <option value="18">18%</option>
                                                            <option value="24">24%</option>

                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
											
											 <div class="col-md-12" style="" id="dis1">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="validationCustom02" class="col-form-label"><span>*</span>MRP </label>
                                                        <input class="form-control" id="i1" type="text" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="validationCustom02" class="col-form-label"><span>*</span>Selling Price </label>
                                                        <input class="form-control" id="i2" type="text" onkeyup="r1()" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="validationCustom02" class="col-form-label"><span>*</span> Offer Price </label>
                                                        <input class="form-control" id="i3" type="text" required>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="validationCustom02" class="col-form-label"><span>*</span>GST</label>
                                                        <input class="form-control" id="i4"  type="text" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="validationCustom02" class="col-form-label"><span>*</span> Product Price </label>
                                                        <input class="form-control" id="i5" value=""  type="text" readonly>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="validationCustom02" class="col-form-label"><span>*</span> Qty </label>
                                                        <input class="form-control" id="i6"  type="text" required>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
						</div>
						<div class="tab-pane fade " id="top-shipping" role="tabpanel" aria-labelledby="top-shipping-tab">
										       <div class="card">
                                <div class="card-header">
                                    <h5>Shipping</h5>
                                </div>
                                <div class="card-body">
                                    <div class="row">
                                        
                                        <div class="col-md-6 col-md-6">

                                            <div class="form-group mb-3">
                                                <label>Weight (g)</label>
                                                <div class="next-input--stylized">

                                                    <input type="text" class="form-control" name="weight" value="0" im-insert="true">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-6 col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Length (cm)</label>
                                                <div class="next-input--stylized">

                                                    <input type="text" class="form-control" name="length" value="0" im-insert="true">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Wide (cm)</label>
                                                <div class="next-input--stylized">

                                                    <input type="text" class="form-control" name="wide" value="0" im-insert="true">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-md-6">
                                            <div class="form-group mb-3">
                                                <label>Height (cm)</label>
                                                <div class="next-input--stylized">

                                                    <input type="text" class="form-control" name="height" value="0" im-insert="true">
                                                </div>
                                            </div>
                                        </div>

                                    </div>



                                </div>
                            </div>
						</div>
						<div class="tab-pane fade " id="top-attr" role="tabpanel" aria-labelledby="top-attr-tab">
										                                <div class="card">



                                    <div class="card-body">

                                        <div class="row">
                                            <h5> Product Variation</h5>

                                            <table class="table addproduct">
                                                <thead class="bordered-darkorange">
                                                    <tr role="row">
                                                        <th style="width:30px;">S.NO</th>
                                                        <th style="width:150px; text-align:center;"> Color </th>
														
                                                        <th style="width:300px; text-align:center;"> Size </th>



                                                        <th style=" width:80px; text-align:center;">Price(₹)</th>
                                                        <th style=" width:30px; text-align:center;">Quantity</th>
                                                        <th style=" width:100px; text-align:center;">Image</th>
														<th style=" width:100px; text-align:center;"></th>
                                                    </tr>
                                                </thead>
                                                <tr>
                                                    <td>1</td>

                                                    </td>
                                                    <td>

                                                    <div class="row" >
               
                                                    <select class="js-select2 form-control" name="mycolor[1]" id="color1" onchange="col()">
                                               
                                               <option value="red" data-badge="">Red</option>
                                               <option value="white" data-badge="">White</option>
                                               <option value="Yellow" data-badge="">Yellow</option>
                                               <option value="pink" data-badge="">pink</option>
                                           </select>
				
                </div>
               <input type ="color" id ="col1" class="color" name=""  /> 
            </td>


        <td>
    <div class="form-group">

        <div class="row">
            <div class="col">
                <div class="row" name="size_type[]">

                    <select class="js-select2 form-control">

                        <option value="O1" data-badge="">S</option>
                        <option value="O2" data-badge="">M</option>
                        <option value="O3" data-badge="">L</option>
                        <option value="O4" data-badge="">XL</option>
                        <option value="O5" data-badge="">XXL</option>
                        <option value="O6" data-badge="">XXXL</option>

                    </select>



                </div>
            </div>
        </div>
    </div>
</td>




<td><input type="text" id="price" name="price[]" class="form-control" placeholder="" required /></td>
<td><input type="text" id="qty" name="qty[]" class="form-control" placeholder="" required /></td>

<td>
    <input type="file" id="upload2" name="myfile" onchange="m_image(this)">
<img src="" id="img1" style="width:30%;">
</td>
</tr>
	<tbody class="input_fields_wrap">
																		
									</tbody>							
</table>
</br>

	<div class="col-md-3">
									<button type="button" class='add_field_button btn btn-xs btn-danger '>+ Add More</button>
								</div>
</br></br>

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
                                      

                                       <div class="form-group">

                                            <label class="col-form-label">Short Description</label>
                                            <textarea rows="2" cols="5" class=""></textarea>
                                        </div>
										
										

								
       
                                        <script>
										
function col()
{
	var color1=document.getElementById("color1").value;
	var col1=document.getElementById("col1");
	
	var color2=convert(color1);
	if(color2 != false)
	{
		
		col1.value=color2;
		
	}
}
						function sm()
						{
								var a = document.getElementById("select_product").value;
								var p1 = document.getElementById("p1");
								var p2 = document.getElementById("p2");
								
							if(a == "single")
							{
								alert(a);
								p1.style.display="block";
								p2.style.display="none";
							}								
							else if(a == "multiple")
							{
								alert(a);
								p1.style.display="none";
								p2.style.display="block";
								
							}
							else{ alert ("Select Single or Multiple Product"); }
								
						}
														
												
										
                                            function preview_image() {
											//	alert("preview");
                                                var total_file = document.getElementById("upload").files.length;
												var im = document.getElementById("img");
												alert(total_file);
                                                for (var i = 0; i < total_file; i++) {
														
													im.src=URL.createObjectURL(event.target.files[i]);
													alert(im.src);
                                                }
                                            }
                                            function multi_image() {
											//	alert("preview");
                                                var total_file = document.getElementById("upload1").files.length;
                                                for (var i = 0; i < total_file; i++) {
                                                    $('#preview1').append("<img class='shadow p-2' src='" + URL.createObjectURL(event.target.files[i]) + "' style='width:10%;border:2px solid red;' name=''>&nbsp&nbsp");
                                                }
                                            }


                                            function image(id) {

                                                var file = document.getElementById(id).src;
                                                alert(file);

                                                var n = 1;


                                                $('#view1').append("<img class='' src='" + file + "' style='width:10%;border:2px solid red;' id='im" + n + "' name='multi_img[]'> &nbsp");
												
												


                                            }

                                            $(document).ready(function() {
                                                $('#sub').click(function() {
                                                    var x = document.getElementById("im1").src;
                                                    //var y=document.getElementById("a1").src
                                                    //var z=document.getElementById("a3").src
                                                    //const g = [x,y];
                                                    document.getElementById("uplfile").value = x;
                                                    var onimg = document.getElementById("online_img");
                                                    onimg.src = x;
                                                    onimg.style.display = "block";

                                                    alert(x);
                                                });
                                            });
											
		$(document).ready(function() {
    var max_fields      = 100; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var add_button      = $(".add_field_button"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<tr><td>'+x+'</td><td>  <select class="js-select2 form-control" onchange="colorn(this)" id="n'+x+'" name="mycolor2['+x+']" ><option value="red" data-badge="">Red</option><option value="white" data-badge="">White</option><option value="yellow" data-badge="">Yellow</option><option value="green" data-badge="">green</option></select><input type ="color" id ="mycolor2['+x+']" name="color[]" value="#ff0000" /></td>&nbsp &nbsp</td><select class="js-select2 form-control"><option value="O1" data-badge="">Red</option><option value="O2" data-badge="">White</option><option value="O3" data-badge="">Black</option><option value="O4" data-badge="">Yellow</option><option value="O5" data-badge="">Blue</option><option value="O6" data-badge="">Light Green</option></select></div></div></div></div></div></td><td><div class="form-group"><div class="row"><div class="col"><div class="row" name="size_type[]"><select class="js-select2 form-control"><option value="O1" data-badge="">S</option><option value="O2" data-badge="">M</option><option value="O3" data-badge="">L</option><option value="O4" data-badge="">XL</option><option value="O5" data-badge="">XXL</option><option value="O6" data-badge="">XXXL</option></select></div></div></div></div></div></td><td><input type="text" id="price' + x + '" name="price[]"  class="form-control" placeholder="Price"required/></td><td><input type="text" id="qty' + x + '" name="qty[]"  class="form-control" placeholder="Qty"required/></td><td> <input type="file" class="form-control " id="upload' + x + '" name="file'+ x + '" onchange="m_image(this)" /><br><img id="file'+ x +'" style="width:30%"></td><td class="r1" style="width:10px;" ><a href="#" class="remove_field " ><button type="button" class="btn btn-xs btn-" style="background-Color:red;" onclick="removeRow3(' + x + ');">x</button></a></td><tr>'); //add input box
        }
    });

    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).closest('tr').remove();; x--;
    })
});

function colorn(obj)
{			



			var v=document.getElementById(obj.name);
		//var s=document.getElementById("cc");
			
	//alert(obj.value);
	//alert(obj.name);	 
	//alert(obj.value);
	var color=convert(obj.value);
	
	if(color != false)
	{
		alert(color);	
		//col1.value=color;
		
		v.value=color;
		
	}
}									
											
											
                                        </script>




                                 
                                </div>
                            </div>

                        </div>



                      





                    </div>

                </div>

                <div class="col-md-3">


                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="form-group">
                                    <h5> Status</h5>
                                    <select class="custom-select form-control" required>

                                        <option value="1">Active</option>
                                        <option value="2">Inactive</option>
                                        <option value="2">Pending</option>

                                    </select>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header">
                                <h5>Meta Data</h5>
                            </div>
                            <div class="card-body">
                                <div class="digital-add needs-validation">
                                    <div class="form-group">
                                        <label for="validationCustom05" class="col-form-label pt-0"> Meta Title</label>
                                        <input class="form-control" id="validationCustom05" type="text" required>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-form-label">Meta Description</label>
                                        <textarea rows="2" cols="12"></textarea>
                                    </div>

                                </div>




                            </div>
                        </div>
						
                        <div class="col-xl-12">
                         </div>


                            <div class="col-xl-12 ">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <h5 class="fw-bold ">Single  Image Upload</h5>
                                            <div class="row">
                                                <div class="col-md-12">
                                                        <div class="col-md-5 m-auto">
                                                            <input type="file" class="form-control mt-3" id="upload" name="upload_file" onchange="preview_image()"  />
                                                        </div><br>
                                                        <div id="preview">
														<img src="" id="img" style="width:30%">
														</div>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
							
                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <h5 class="fw-bold"> Multi Image Upload</h5>
                                            <div class="row">
										
                                                <div class="col-md-12">
												
												          <div class="d-flex justify-content-center mb-5">
                                                            <button type="button" class="btn btn-primary " data-bs-toggle="modal" data-bs-target="#myModal1">
                                                                Open Media
                                                            </button>
                                                        </div>
														<div id="view"> <img src="" id="par" style="width:10%;"></div>

                                                        <div class="modal fade" id="myModal1">
                                                            <div class="modal-dialog modal-dialog-centered modal-xl">
                                                                <div class="modal-content">

                                                                    <!-- Modal Header -->
                                                                    <div class="modal-header">
            <div class="container-fluid">
                <div class="row">
                   
                    <div class="col-xl-12">
                        <div class="card tab2-card">
						
						<div class="card-header"><h3 class="text-center">Image Upload</h3>
						
						    
						</div>
						
                            <div class="card-body">
                                       <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" id="top-profile-tab" data-bs-toggle="tab" href="#top-profile" role="tab" aria-controls="top-profile" aria-selected="true"><i data-feather="user" class="me-2"></i>Local</a>
                                    </li>
                                  
									<li class="nav-item"><a class="nav-link" id="upload-top-tab" data-bs-toggle="tab" href="#top-upload" role="tab" aria-controls="top-upload" aria-selected="false"><i data-feather="settings" class="me-2"></i>Online</a>
                                    </li>
									
								
                                </ul>
								
                                <div class="tab-content" id="top-tabContent">
								
								
                                    <div class="tab-pane fade show active" id="top-profile" role="tabpanel" aria-labelledby="top-profile-tab">
									<div class="border border-primary mt-5">
										 <div class="col-md-5 m-auto">
                                                            <input type="file" class="form-control mt-3" id="upload1" name="multi_img[]" onchange="multi_image();"  multiple />
                                                        </div><br>
									</div><hr>
									<div id="preview1"></div>
									
									
									</div>
									
									<div class="tab-pane fade" id="top-upload" role="tabpanel" aria-labelledby="top-upload-tab">
									
									<h2></h2>
									<div class="row">
                                                                            <div class="col-md-2">
                                                                                <img src="../assets/images/products/blouse.jpg" alt="test" id="1" width="100%" onclick="image(this.id)">
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                <img src="../assets/images/products/shortop.jpg" alt="test" id="2" width="100%" onclick="image(this.id)">
                                                                            </div>
                                                                            <div class="col-md-2">
                                                                                <img src="../assets/images/products/blouse.jpg" alt="test" id="3" width="100%" onclick="image(this.id)">
                                                                            </div>
                                                                        </div>
																		<hr>
																		<div id="view1"></div>
									
									</div>
  
 
                                </div>
  						  
							
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                                                                        
                                                                    </div>

                                                                   

                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="sub" onclick="s()">submit</button>
                                                                            <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Close</button>
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
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <h5> Product Collection</h5>
                                            <div class="row">
                                                <div class="col">
                                                    <label class="d-block" for="chk-ani">
                                                        <input class="checkbox_animated" id="chk-ani" type="checkbox">
                                                        New Arrival
                                                    </label>
                                                    <label class="d-block" for="chk-ani1">
                                                        <input class="checkbox_animated" id="chk-ani1" type="checkbox">
                                                        Best Seller
                                                    </label>
                                                    <label class="d-block" for="chk-ani2">
                                                        <input class="checkbox_animated" id="chk-ani2" type="checkbox">
                                                        Special Offer
                                                    </label>

                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                            </div>
							
	
							
							
							

<script src="js/colorpicker/color.js"></script>

                            <script>
                                            function m_image(im) {
											
                                                var total = im.files.length;
												var image = document.getElementById("file2");
													alert(total);
													alert(im.name);
                                                for (var i = 0; i < total; i++) {
														
													var img=	URL.createObjectURL(event.target.files[i]);
												image.src = img;
													alert(img);
                                                }
                                            }							
							
							
function s()
{
		  var img = document.getElementsByName('multi_img[]');
alert(img.length);
           for (var i = 0; i < img.length; i++) {
                var a = img[i].src;
                
			 document.getElementById("par").src = a;
            }
 
            
}


function color()
{
	var col = document.getElementById("color").value;
	var c = document.getElementById("col");
	//alert(color);
	var color=convert(col);
	
	if(color != false)
	{
		alert(color);
		
		c.value=color;
		//s.innerHTML="<p>red</p>";
	}
	
}
							
							
							
                                $(document).ready(function() {
                                    $('#sub').click(function() {
                                        var x = document.getElementById("im1").src;
                                        //var y=document.getElementById("a1").src
                                        //var z=document.getElementById("a3").src
                                        //const g = [x,y];
                                        document.getElementById("uplfile").value = x;
                                        var onimg = document.getElementById("online_img");
                                        onimg.src = x;
                                        onimg.style.display = "block";

                                        alert(x);
                                    });
                                });


                            function r1() {
                                    var c = document.getElementById("gst2").value;


                                    var i1 = document.getElementById("i1");
                                    var i2 = document.getElementById("i2").value;
                                    var i3 = document.getElementById("i3");
                                    var i4 = document.getElementById("i4");
                                    var i5 = document.getElementById("i5");

                                    var gst = document.querySelector('input[name = gst1]:checked').value;
									

                                   
                                   if (gst == "include") {
                                        if (c == "") {
                                            alert("select GST");
                                        }
                                        if (c == c) {

                                            var price = i2 * 1;
                                            var p = c / 100;
											var g="0."+c;
                                            var p1 = i2 * g ;
                                            var tot_price = price - (price * p);
                                            //v2.value=c;
                                           // alert(g);
                                            i4.value = p1;
                                            i5.value = tot_price;

                                        }
                            
                                        
                                    } else if (gst == "exclude") {

                                        if (c == "") {
                                            alert("select GST");
                                        }
                                        if (c == c) {
                                            var price = i2 * 1;
											var g="0."+c;
                                            var p = price * g;
                                            var tot_price = price + p;
                                            //v2.value=c;
                                            i4.value = p;
                                            i5.value = tot_price;

                                        }
                                        
                                        
                                    }

                                }

                                function r() {
                                    var c = document.getElementById("gst1").value;


                                    var i1 = document.getElementById("in1");
                                    var i2 = document.getElementById("in2").value;
                                    var i3 = document.getElementById("in3");
                                    var i4 = document.getElementById("in4");
                                    var i5 = document.getElementById("in5");

                                    var gst = document.querySelector('input[name = gst]:checked').value;
									

                                   
                                   if (gst == "include") {
                                        if (c == "") {
                                            alert("select GST");
                                        }
                                        if (c == c) {

                                            var price = i2 * 1;
                                            var p = c / 100;
											var g="0."+c;
                                            var p1 = i2 * g ;
                                            var tot_price = price - (price * p);
                                            //v2.value=c;
                                           // alert(g);
                                            i4.value = p1;
                                            i5.value = tot_price;

                                        }
                            
                                        
                                    } else if (gst == "exclude") {

                                        if (c == "") {
                                            alert("select GST");
                                        }
                                        if (c == c) {
                                            var price = i2 * 1;
											var g="0."+c;
                                            var p = price * g;
                                            var tot_price = price + p;
                                            //v2.value=c;
                                            i4.value = p;
                                            i5.value = tot_price;

                                        }
                                        
                                        
                                    }

                                }
								
								
	  function convert(color) {
            var colours = {
                "aliceblue":"#f0f8ff", "antiquewhite":"#faebd7", "aqua":"#00ffff", "aquamarine":"#7fffd4", "azure":"#f0ffff",  "beige":"#f5f5dc", "bisque":"#ffe4c4", "black":"#000000", "blanchedalmond":"#ffebcd", "blue":"#0000ff", "blueviolet":"#8a2be2", "brown":"#a52a2a", "burlywood":"#deb887",  "cadetblue":"#5f9ea0", "chartreuse":"#7fff00", "chocolate":"#d2691e", "coral":"#ff7f50", "cornflowerblue":"#6495ed", "cornsilk":"#fff8dc", "crimson":"#dc143c", "cyan":"#00ffff",  "darkblue":"#00008b", "darkcyan":"#008b8b", "darkgoldenrod":"#b8860b", "darkgray":"#a9a9a9", "darkgreen":"#006400", "darkkhaki":"#bdb76b", "darkmagenta":"#8b008b", "darkolivegreen":"#556b2f",  "darkorange":"#ff8c00", "darkorchid":"#9932cc", "darkred":"#8b0000", "darksalmon":"#e9967a", "darkseagreen":"#8fbc8f", "darkslateblue":"#483d8b", "darkslategray":"#2f4f4f", "darkturquoise":"#00ced1",  "darkviolet":"#9400d3", "deeppink":"#ff1493", "deepskyblue":"#00bfff", "dimgray":"#696969", "dodgerblue":"#1e90ff",  "firebrick":"#b22222", "floralwhite":"#fffaf0", "forestgreen":"#228b22", "fuchsia":"#ff00ff",  "gainsboro":"#dcdcdc", "ghostwhite":"#f8f8ff", "gold":"#ffd700", "goldenrod":"#daa520", "gray":"#808080", "green":"#008000", "greenyellow":"#adff2f",
                "honeydew":"#f0fff0", "hotpink":"#ff69b4", "indianred ":"#cd5c5c", "indigo":"#4b0082", "ivory":"#fffff0", "khaki":"#f0e68c",  "lavender":"#e6e6fa", "lavenderblush":"#fff0f5", "lawngreen":"#7cfc00", "lemonchiffon":"#fffacd", "lightblue":"#add8e6", "lightcoral":"#f08080", "lightcyan":"#e0ffff", "lightgoldenrodyellow":"#fafad2",  "lightgrey":"#d3d3d3", "lightgreen":"#90ee90", "lightpink":"#ffb6c1", "lightsalmon":"#ffa07a", "lightseagreen":"#20b2aa", "lightskyblue":"#87cefa", "lightslategray":"#778899", "lightsteelblue":"#b0c4de",  "lightyellow":"#ffffe0", "lime":"#00ff00", "limegreen":"#32cd32", "linen":"#faf0e6",  "magenta":"#ff00ff", "maroon":"#800000", "mediumaquamarine":"#66cdaa", "mediumblue":"#0000cd", "mediumorchid":"#ba55d3", "mediumpurple":"#9370d8", "mediumseagreen":"#3cb371", "mediumslateblue":"#7b68ee",        "mediumspringgreen":"#00fa9a", "mediumturquoise":"#48d1cc", "mediumvioletred":"#c71585", "midnightblue":"#191970", "mintcream":"#f5fffa", "mistyrose":"#ffe4e1", "moccasin":"#ffe4b5", "navajowhite":"#ffdead", "navy":"#000080",  "oldlace":"#fdf5e6", "olive":"#808000", "olivedrab":"#6b8e23", "orange":"#ffa500", "orangered":"#ff4500", "orchid":"#da70d6",  "palegoldenrod":"#eee8aa",
                "palegreen":"#98fb98", "paleturquoise":"#afeeee", "palevioletred":"#d87093", "papayawhip":"#ffefd5", "peachpuff":"#ffdab9", "peru":"#cd853f", "pink":"#ffc0cb", "plum":"#dda0dd", "powderblue":"#b0e0e6", "purple":"#800080",  "rebeccapurple":"#663399", "red":"#ff0000", "rosybrown":"#bc8f8f", "royalblue":"#4169e1",  "saddlebrown":"#8b4513", "salmon":"#fa8072", "sandybrown":"#f4a460", "seagreen":"#2e8b57", "seashell":"#fff5ee", "sienna":"#a0522d", "silver":"#c0c0c0", "skyblue":"#87ceeb", "slateblue":"#6a5acd", "slategray":"#708090", "snow":"#fffafa", "springgreen":"#00ff7f", "steelblue":"#4682b4",   "tan":"#d2b48c", "teal":"#008080", "thistle":"#d8bfd8", "tomato":"#ff6347", "turquoise":"#40e0d0", "violet":"#ee82ee",   "wheat":"#f5deb3", "white":"#ffffff", "whitesmoke":"#f5f5f5", "yellow":"#ffff00", "yellowgreen":"#9acd32"
            };
                  
            if (typeof colours[color.toLowerCase()] != 'undefined')
                return colours[color.toLowerCase()];
            return false;
        }
                            </script>

                            <div class="col-xl-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="form-group">
                                            <a href="product_listing.php" onclick="return confirm('Are you sure, you want to Save it?')"> <button class="btn btn-primary" type="button">Save</button></a>
                                            <button class="btn btn-secondary" type="button">Close</button>

                                        </div>
                                    </div>
                                </div>

                            </div>




                        </div>

                    </div>
                </div>
            </div>


            <!-- Container-fluid Ends-->

        </div>


        <!-- latest jquery-->
        <script src="../assets/js/jquery-3.3.1.min.js"></script>
        <script>
            jQuery(function() {
                var counter = 1;
                var rowCount = 1;
                jQuery('button.addmore').click(function(event) {
                    event.preventDefault();
                    rowCount++;
                    var newRow = jQuery('<tr id="prowCount' + rowCount + '"><td>' + rowCount + '</td><td><input type="text" id="" name="particulars[]"  class="form-control" placeholder=""required/></td><td><input type="text" id="quantity1" name="quantity[]" class="form-control" placeholder=""  value="1" required /></td><td><input type="text" id="size' + rowCount + '" name="size[]" onkeyup="calc_amount(' + rowCount + ')" class="form-control" placeholder="" required /></td><td><select style="font-size:14px;width: 100px;" name="size_type[]"><option value="feed">Feet</option><option value="Sqft">SquareFeet</option><option value="kg">KG</option><option value="No`s">No`s</option></select></td><td><input type="text" id="rate' + rowCount + '" name="rate[]"  onkeyup="calc_amount(' + rowCount + ')" class="form-control" placeholder=""required/></td><td><select style="font-size:14px;width: 100px;" name="rate_type[]"><option value="feed">Feet</option><option value="Sqft">SquareFeet</option><option value="kg">KG</option><option value="No`s">No`s</option></select></td><td><input type="text" id="amount' + rowCount + '" name="amount[]"  class="form-control" placeholder=""required/></td><td class="r1" style="width:10px;" ><button type="button" class="btn btn-xs btn-danger" onclick="removeRow3(' + rowCount + ');">x</button></td></tr>');
                    counter++;
                    jQuery('table.addproduct').append(newRow);
                    $("#total_products").val(rowCount);

                });

            });
        </script>

        <script type="text/javascript">
            var rowCount = 1;

            function removeRow3(removeNum) {
                jQuery('#prowCount' + removeNum).remove();
                var tot_product = $("#total_products").val();

                var tot_amt = 0;
                for (var i = 1; i <= tot_product; i++) {
                    var pamt = parseFloat($("#amount" + i).val());
                    if (parseFloat(pamt) < 0 || isNaN(parseFloat(pamt)))
                        pamt = 0;
                    tot_amt += pamt;
                }
                //alert(tot_amt);
                $("#tot_amount").val(tot_amt.toFixed(2));
                var discount = $("#discount").val();
                var grand_total = parseFloat(tot_amt) - parseFloat(discount);

                $("#grand_total").val(grand_total.toFixed(2));
                $("#invoice_paidamount").val(grand_total.toFixed(2));

            }
        </script>
        <!-- Bootstrap js-->
        <script src="../assets/js/bootstrap.bundle.min.js"></script>
        <script src="../assets/js/touchspin/touchspin.js"></script>
        <script src="../assets/js/touchspin/input-groups.min.js"></script>

        <!-- form validation js-->
        <script src="../assets/js/dashboard/form-validation-custom.js"></script>

        <!-- ckeditor js-->
        <!-- feather icon js-->
        <script src="../assets/js/icons/feather-icon/feather.min.js"></script>
        <script src="../assets/js/icons/feather-icon/feather-icon.js"></script>

        <!-- Sidebar jquery-->
        <script src="../assets/js/sidebar-menu.js"></script>

        <!--dropzone js-->
        <script src="../assets/js/dropzone/dropzone.js"></script>
        <script src="../assets/js/dropzone/dropzone-script.js"></script>

        <!--ckeditor js-->
        <script src="../assets/js/editor/ckeditor/ckeditor.js"></script>
        <script src="../assets/js/editor/ckeditor/styles.js"></script>
        <script src="../assets/js/editor/ckeditor/adapters/jquery.js"></script>
        <script src="../assets/js/editor/ckeditor/ckeditor.custom.js"></script>

        <!--Customizer admin-->
        <script src="../assets/js/admin-customizer.js"></script>
        <script src="../assets/js/index.js"></script>
        <!-- lazyload js-->
        <script src="../assets/js/lazysizes.min.js"></script>

        <!--right sidebar js-->
        <script src="../assets/js/chat-menu.js"></script>

        <!--script admin-->
        <script src="../assets/js/admin-script.js"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>
<script>
$(".js-select2").select2({
			closeOnSelect : true,
			placeholder: '--Select--',
			allowHtml: false,
			allowClear: true,
			tags: false // создает новые опции на лету
		});
		
	</script>
@endsection