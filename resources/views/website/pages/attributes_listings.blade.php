{{-- <?php include('header.php')?> --}}
@extends('website.layouts.master')
<style>
.display{
	table-layout:fixed;
	width:100%;
}
</style>
<!-- page-wrapper Start-->
{{-- <?php include('topmenu.php')?> --}}
@include('website.pages.topmenu')
    <!-- Page Header Ends -->

    <!-- Page Body Start-->
    <div class="page-body-wrapper">

        <!-- Page Sidebar Start-->
        
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
                                <h3>Attributes  Listings
                                    <small>oxygen Admin panel</small>
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="index.php"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item active">Attributes  Listings</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->
          
            <!-- Container-fluid starts-->
            <div class="container-fluid">
           
                <div class="row">
                        
                    <div class="col-sm-12">
                        
                        <div class="card">
                     	

                                <div class="card-body order-datatable">
                             
								<button type="button" class="btn mb-4 btn-primary" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal">Add Attributes</button>
							<br>
                                <table class="table" id="table" data-click-to-select="true" data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-sort="true" data-pagination="true" data-search="true" data-show-refresh="true" data-key-events="true" data-show-columns="true" data-resizable="true" data-cookie="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">

									<thead>
										<tr>
											<th data-field="id" data-sortable="true">Id</th>
											<th data-field="title" data-sortable="true"> Title</th>
											<th data-field="type" data-sortable="true"> Type</th>
											<th data-field="list" data-sortable="true">List</th>

											<th data-field="status" data-sortable="true">Status</th>
											<th>Action</th>
										</tr>
									</thead>
									<tbody>


										<tr>
											<td>#001</td>

											<td>Size</td>
											<td>Checkbox</td>
											<td>S, M, L, XL, XXL</td>


											<td>
												<label class="switch">
													<input type="checkbox" onclick="return confirm('Are you sure, you want to Change it?')" checked id="togBtn">
													<div class="slider round">
														<!--ADDED HTML -->
														<span class="off">Inactive </span>
														<span class="on">Active</span>
														<!--END-->
													</div>
												</label>

							</div>

							</td>
							<td><span> <a href="#" class="badge badge-secondary px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
									<a href="#" onclick="return delete_maincategory()" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>

							</tr>

							<tr>
								<td>#002</td>

								<td>Color</td>
								<td>Dropdown</td>
								<td>White, Red, Marron, Black</td>


								</td>
								<td>
									<label class="switch">
										<input type="checkbox" onclick="return confirm('Are you sure, you want to Change it?')" checked id="togBtn">
										<div class="slider round">
											<!--ADDED HTML -->
											<span class="off">Inactive </span>
											<span class="on">Active</span>
											<!--END-->
										</div>
									</label>

						</div>

						</td>
						<td><span> <a href="#" class="badge badge-secondary px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
								<a href="#" onclick="return delete_maincategory()" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>


						</tr>

						<tr>
							<td>#003</td>

							<td>Neck Type</td>
							<td>Dropdown</td>
							<td>Off Shoulder Neckline, Round necklines,V necklines, Collared necklines </td>


							</td>
							<td>
								<label class="switch">
									<input type="checkbox" onclick="return confirm('Are you sure, you want to Change it?')" checked id="togBtn">
									<div class="slider round">
										<!--ADDED HTML -->
										<span class="off">Inactive </span>
										<span class="on">Active</span>
										<!--END-->
									</div>
								</label>

					</div>

					</td>
					<td><span> <a href="#" class="badge badge-secondary px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
							<a href="#" onclick="return delete_maincategory()" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>

					</tr>
					</tbody>
					</table>
                            </div>
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

			
			
			
				<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
									<div class="modal-dialog modal-lg" role="document">
										<div class="modal-content">
											<div class="modal-header">
												<h5 class="modal-title f-w-600" id="exampleModalLabel">Add Attributes</h5>
												<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
											</div>

											<div class="modal-body">
											<form class="" method="post">
                                                @csrf
									<div class="form">
										
										
										<div class="form-group">
											<label for="validationCustom01" class="mb-1">Title</label>
											<input class="form-control" id="" require="" type="text">
										</div>
										<div class="form-group">
											<label class="col-form-label"><span>*</span>Atributes Type</label>
											<select class="custom-select form-control" required>
												<option value="">--Select Type--</option>
												<option value="dropdown">Drop Down</option>
                                                <option value="checkbox">Check box</option>
                                                <option value="radiobutton">Radio Button</option>
                                                
											</select>
										</div>
										
									
										
									</div>
									
							
								<div class="col-md-12">
									<h5>Attributes List</h5>
									
									
									<table class="table addproduct" >
										<thead class="bordered-darkorange">
											<tr role="row"> 
												<th style="width:30px;">S.NO</th>
												<th style="width:150px;">Color Name</th>
												<th style="width:150px;">Color</th>
												
											</tr>
										</thead>
										<tr>
											<td>1</td>
											
										</td>
										<td>   
    
      
    
        <input id = "input" class="form-control" type = "text" placeholder="Enter Color" onkeyup = "gfg_Run()"/>
		<input id ="color_code" name="color_code" type ="text" style="display:none;" readonly/>
      
    
      
 
      

    </p></td>
										</td>
										<td><input type="color" id = "GFG_UP"  class="form-control-md" placeholder="color"  />
										<p id = "GFG_DOWN" style = "color:black;
        font-size: 26px; font-weight: bold;"></td>

									</tr>
								</table>
								</br>
								<div class="col-md-3">
									<button type="button" class='addmore btn btn-xs btn-primary '>+ Add More</button>
								</div>
								
								
							</div>
							                    <div class="form-group mt-2">
															<label for="validationCustom01" class="mb-1">Status</label>
															<select class="custom-select w-100 form-control" required="">
																
																
																<option value="1">Active</option>
																<option value="0">Deactive</option>
																
															</select>
															
														</div>	</div>
	
	<script>
 var el_up = document.getElementById("GFG_UP");
        var el_down = document.getElementById("GFG_DOWN");
          
        el_up.innerHTML = 
            "Type color and click on the button.";
          
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
          
        function gfg_Run() {
            color = document.getElementById('input').value;
			var color_code= document.getElementById('color_code');
            el_up.value =  convert(color);
			color_code.value =  convert(color);
        //    el_down.innerHTML =  color;
			//alert(convert(color));
			if(convert(color) == "#ffffff"){
				el_down.style.color ="#000000";
			}
			else
			{
			el_down.style.color =  convert(color);
			}
        } 

</script>

							<div class="modal-footer">
								<a href="category.php" onclick="return confirm('Are you sure, you want to Save it?')">    <button class="btn btn-primary" type="button">Save</button></a>
								<button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
							</div>
						</form>
											</div>
											
										</div>
									</div>
							
        </div>
		
		
		
		

        <script src="../assets/js/jquery-3.3.1.min.js"></script>
		
		


<script>
	jQuery(function(){
		var counter = 1;
		 var rowCount = 1;
		jQuery('button.addmore').click(function(event){
			event.preventDefault();
			rowCount ++;
			var newRow = jQuery('<tr id="prowCount'+rowCount+'"><td>'+rowCount+'</td><td><input type="text" id="color" name="col'+rowCount+'"  class="form-control" placeholder="Enter Color" required onkeyup="color1(this)"/></td><td><input type="radio" id ="col'+rowCount+'"    class="form-group" checked /></td><td class="r1" style="width:10px;" ><button type="button" class="btn btn-xs btn-warning" onclick="removeRow3('+rowCount+');">x</button></td></tr>');
			counter++;
			jQuery('table.addproduct').append(newRow);
			$("#total_products").val(rowCount);
			
		});
		
	});
	
function color1(obj)
{			
var col=document.getElementById("color");
			var v=document.getElementById(obj.name);
		var s=document.getElementById("cc");
			
	//alert(obj.name);	 
	//alert(obj.value);
	var color=convert(obj.value);
	if(color == color)
	{
		v.style.accentColor=color;
	//	col.value=color;
		s.innerHTML="<p>red</p>";
	}
}
</script>

<script type="text/javascript">
	var rowCount = 1;
	function removeRow3(removeNum) {
		jQuery('#prowCount'+removeNum).remove();
		var tot_product=$("#total_products").val();
		
		var tot_amt=0;
		for(var i=1;i<=tot_product;i++)			
		{	
			var pamt=parseFloat($("#amount"+i).val());
			if(parseFloat(pamt) < 0 || isNaN(parseFloat(pamt))) 
			pamt=0; 
			tot_amt+=pamt;
		}
		alert(tot_amt);
		$("#tot_amount").val(tot_amt.toFixed(2));
		var discount=$("#discount").val();
		var grand_total=parseFloat(tot_amt)-parseFloat(discount);
		
		$("#grand_total").val(grand_total.toFixed(2));
		$("#invoice_paidamount").val(grand_total.toFixed(2));
		
	}
</script>
@endsection
{{-- <?php include('newfooter.php')?> --}}