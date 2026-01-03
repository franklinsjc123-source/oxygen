{{-- <?php include('header.php')?> --}}
@extends('website.layouts.master')

<!-- page-wrapper Start-->

@include('website.pages.topmenu')
<!-- Page Header Ends -->

<!-- Page Body Start-->
<div class="page-body-wrapper">
	
	<!-- Page Sidebar Start-->
	
    <?php include('sidemenu.php')?>
    @section('content')
	<div class="page-body">
		
		<!-- Container-fluid starts-->
		<div class="container-fluid">
			<div class="page-header">
				<div class="row">
					<div class="col-lg-6">
						<div class="page-header-left">
							<h3>Create Coupon
							
							</h3>
						</div>
					</div>
					<div class="col-lg-6">
						<ol class="breadcrumb pull-right">
							<li class="breadcrumb-item"><a href="dashboard.php"><i data-feather="home"></i></a></li>
							<li class="breadcrumb-item">Coupons </li>
							<li class="breadcrumb-item active">Create Coupon</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
		<!-- Container-fluid Ends-->
		
		<!-- Container-fluid starts-->
		<div class="container-fluid">
			<div class="card tab2-card">
				
				<div class="card-body">
				
				
							<form class="needs-validation" novalidate="" >
                                @csrf
								<h4>General</h4>
								<div class="row">
									<div class="col-sm-12">
										<div class="form-group row">
											<label for="validationCustom0" class="col-xl-3 col-md-4">Coupon Title</label>
											<div class="col-md-7">
												<input class="form-control" id="validationCustom0" type="text" required="">
											</div>
										</div>
										<div class="form-group row">
											<label for="validationCustom1" class="col-xl-3 col-md-4">Coupon Code</label>
											<div class="col-md-7">
												<input class="form-control" id="validationCustom1" type="text" required="" >
											</div>
											
										</div>
										
										
										<div class="form-group row">
											<label class="col-xl-3 col-md-4">Coupon Type</label>
											<div class="col-md-7">
												<div class="checkbox checkbox-primary">
													<input id="checkbox-primary-3" type="checkbox"  checked="true" data-original-title="" title=""onclick="myFunction1()" >
													<label for="checkbox-primary-3" >Minimum Purchase</label>
													<input id="checkbox-primary-4" type="checkbox" data-original-title="" title="" onclick="myFunction()">
													<label for="checkbox-primary-4" >Days Coupon</label>
												</div>
											</div>
										</div>
										
										<div class="" id="coupon">
										<div class="form-group row"  >
										
										<label class="col-xl-3 col-md-4">Start</label>
											<div class="col-md-4">
											<label class="">Start Date</label>
												 <input id="example" type="text" class="form-control" placeholder="dd/mm/yy"  />
												 </div>
												 <div class="col-md-3">
											<label class="">Start Time</label>
												 <input id="example" type="time" class="form-control"   />
												 </div>

											</div>
									<div class="form-group row"  >
										
										<label class="col-xl-3 col-md-4">End</label>
											<div class="col-md-4">
											<label class="">End Date</label>
												 <input id="example1" type="text" class="form-control" placeholder="dd/mm/yy"  />
												 </div>
												 <div class="col-md-3">
											<label class="">End Time</label>
												 <input id="example" type="time" class="form-control"   />
												 </div>

											</div>
											
										</div>
                                        </div>
										
										<div  id="minimum">
										<div class="form-group row">
											<label class="col-xl-3 col-md-4"></label>
											<div class="col-md-4">
											<label class="">Minimum Purchase Amount</label>
												<input class="datepicker-here form-control digits" type="text" data-language="en">
											</div>
										</div>
                                        </div>
									
										<div class="form-group row">
											<label class="col-xl-3 col-md-4">Discount Type</label>
											<div class="col-md-7">
												<select class="custom-select w-100 form-control" required="" id="percent" onchange="discount()" >
													<option value="">--Select--</option>
													<option value="percent" >Percent</option>
													<option value="fixed" >Fixed</option>
												</select>
											</div>
										</div>
										
										<div id="dispercentage">
										<div class="form-group row">
											<label class="col-xl-3 col-md-4"></label>
											<div class="col-md-7">
											<label class="col-xl-3 col-md-4">Discount Percentage</label>
												<input class="form-control" type="text"  id="percent" value="">
											</div>
										</div></div>
										<div id="disamount">
										<div class="form-group row">
										<label class="col-xl-3 col-md-4"></label>
											<div class="col-md-7">
											<label class="col-xl-3 col-md-4">Discount Amount</label>
												<input class="form-control" type="text"  id="fixed" value="">
											</div>
										</div></div>
										<div class="form-group row">
											<label class="col-xl-3 col-md-4">Status</label>
											<div class="col-md-7">
												<div class="checkbox checkbox-primary">
													<input id="checkbox-primary-2" type="checkbox" data-original-title="" title="">
													<label for="checkbox-primary-2">Enable the Coupon</label>
												</div>
											</div>
										</div>
										<div class="form-group row ">
											<div class="text-center">
										<div class="col-xl-8 col-md-8">
										<button class="btn btn-primary" type="submit">Save</button>
                                                    <button class="btn btn-secondary" type="button">Close</button>
									</div>
								</div>
							</form>
					
					
				</div>
			</div>
			
			
			
		
			
			
			
			
		</div>
		<!-- Container-fluid Ends-->
		
	</div>
	
	<!-- footer start-->
	
	<!-- footer end-->
	
</div>

</div>
<style>
	#static{
	display:none;
	
	}
	
	#coupon{
	display:none;
	
	}
	#coupon1{
	display:none;
	
	}
	

	
	#dispercentage{
	display:none;
	
	}
	#disamount{
	display:none;
	
	}
</style>

<script>
	$(window).load(function(){
		$('#general-tab').trigger('click');
	});
	function search(){
		
		
		
		
		document.getElementById("static").style.display="block";
		
	}
</script>
<script>
	
	function myFunction() {
		var a = document.getElementById("checkbox-primary-4");

  if (a.checked == true){
   document.getElementById("coupon").style.display="block";
		document.getElementById("coupon1").style.display="block";
		
  } else {
    document.getElementById("coupon").style.display="none";
		document.getElementById("coupon1").style.display="none";
			
  }
}
	
	function myFunction1() {
		var a = document.getElementById("checkbox-primary-3");

  if (a.checked == true){
   document.getElementById("minimum").style.display="block";

		
  } else {
    document.getElementById("minimum").style.display="none";

			
  }
}
	function discount(){
		
		var a = document.getElementById("percent").value;
		
		if (a =="percent"){
			
		
			document.getElementById("dispercentage").style.display="block";
			document.getElementById("disamount").style.display="none";
			}

		else if (a =="fixed"){
			
			document.getElementById("disamount").style.display="block";
			document.getElementById("dispercentage").style.display="none";
			}
	}
	
</script>

<script>
	 const myDatePicker1 = MCDatepicker.create({ 
      
	  el:'#example'
	  
})
	 const myDatePicker2 = MCDatepicker.create({ 
      
	  el:'#example1'
	  
})
</script>
@endsection
<!-- latest jquery-->
{{-- <?php include('newfooter.php')?> --}}
