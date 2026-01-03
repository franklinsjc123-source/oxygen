{{-- <?php include('header.php')?> --}}
@extends('website.layouts.master')

<!-- page-wrapper Start-->
<?php include('topmenu.php')?>
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
							<h3>Product Attribute
								<small>oxygen Admin panel</small>
							</h3>
						</div>
					</div>
					<div class="col-lg-6">
						<ol class="breadcrumb pull-right">
							<li class="breadcrumb-item"><a href="index.php"><i data-feather="home"></i></a></li>
							<li class="breadcrumb-item active">Gst</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
		<!-- Container-fluid Ends-->
		
		<!-- Container-fluid starts-->
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<div class="card">
						
						
						<div class="card-body">
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
										
										<div class="form-group">
											<label class="col-xl-3 col-md-4">Status</label>
											<div class="col-md-7">
												<div class="checkbox checkbox-primary">
													<input id="checkbox-primary-2" type="checkbox" data-original-title="" title="">
													<label for="checkbox-primary-2">Active</label>
													<input id="checkbox-primary-2" type="checkbox" data-original-title="" title="">
													<label for="checkbox-primary-2">Deactive</label>
												</div>
												
											</div>
										</div>
										
									</div>
									
								</div>
								<div class="col-md-12">
									<h5>Attributes List</h5>
									
									
									<table class="table addproduct" >
										<thead class="bordered-darkorange">
											<tr role="row"> 
												<th style="width:30px;">S.NO</th>
												<th style="width:150px;">Title</th>
												
											</tr>
										</thead>
										<tr>
											<td>1</td>
											
										</td>
										<td><input type="text" id="pid" name="title"  class="form-control " placeholder="title" required /></td>
										
										
										
										
										
										
										
										
										
									</tr>
								</table>
								</br>
								<div class="col-md-3">
									<button type="button" class='addmore btn btn-xs btn-primary '>+ Add More</button>
								</div>
								</br></br>
								
							</div>
							<div class="modal-footer">
								<a href="category.php" onclick="return confirm('Are you sure, you want to Save it?')">    <button class="btn btn-primary" type="button">Save</button></a>
								<button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Close</button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- Container-fluid Ends-->
	
</div>
<script type="text/javascript" src="jquery.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
	function addField(n)
	{
		var tr = n.parentNode.parentNode.cloneNode(true);
		document.getElementById('tbl').appendChild(tr);
		
	}
	
	
	
	
</script>
<script>
	$(document).ready(function(){
		$("#tbl").on('click','.btnDelete',function(){
			$(this).closest('tr').remove();
		});
	});
</script>





<script>
	jQuery(function(){
		var counter = 1;
		var rowCount = 1;
		jQuery('button.addmore').click(function(event){
			event.preventDefault();
			rowCount ++;
			var newRow = jQuery('<tr id="prowCount'+rowCount+'"><td>'+rowCount+'</td><td><input type="text" id="price'+rowCount+'" name="title"  class="form-control" placeholder="title"required/></td>;"><td class="r1" style="width:10px;" ><button type="button" class="btn btn-xs btn-warning" onclick="removeRow3('+rowCount+');">x</button></td></tr>');
			counter++;
			jQuery('table.addproduct').append(newRow);
			$("#total_products").val(rowCount);
			
		});
		
	});
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
		//alert(tot_amt);
		$("#tot_amount").val(tot_amt.toFixed(2));
		var discount=$("#discount").val();
		var grand_total=parseFloat(tot_amt)-parseFloat(discount);
		
		$("#grand_total").val(grand_total.toFixed(2));
		$("#invoice_paidamount").val(grand_total.toFixed(2));
		
	}
</script>



<script src="../assets/js/jquery-3.3.1.min.js"></script>

<!-- Bootstrap js-->
<script src="../assets/js/bootstrap.bundle.min.js"></script>

<!-- feather icon js-->
<script src="../assets/js/icons/feather-icon/feather.min.js"></script>
<script src="../assets/js/icons/feather-icon/feather-icon.js"></script>

<!-- Sidebar jquery-->
<script src="../assets/js/sidebar-menu.js"></script>

<!-- Datatable js-->
<script src="../assets/js/datatables/jquery.dataTables.min.js"></script>
<script src="../assets/js/datatables/custom-basic.js"></script>

<!--Customizer admin-->
<script src="../assets/js/admin-customizer.js"></script>

<!-- lazyload js-->
<script src="../assets/js/lazysizes.min.js"></script>

<!--right sidebar js-->
<script src="../assets/js/chat-menu.js"></script>

<!--script admin-->
<script src="../assets/js/admin-script.js"></script>

@endsection