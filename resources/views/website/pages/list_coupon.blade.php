@extends('website.layouts.master')
{{-- <?php include('header.php')?> --}}

<!-- page-wrapper Start-->
<?php include('topmenu.php')?>
@include('website.pages.topmenu')
    <!-- Page Header Ends -->

    <!-- Page Body Start-->
    <div class="page-body-wrapper">

        <!-- Page Sidebar Start-->
        <?php include('sidemenu.php')?>
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
                                <h3>List Coupon
                                  
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="index.php"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item active">List Coupon</li>
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
                           
                            <div class="card-body">
                                
                          <a href="coupon-create.php" class="btn mb-4 btn-primary"><i class="fa fa-plus"></i> Add Coupon </a> 


                            <div class="datatable-dashv1-list custom-datatable-overright">

                            
<table class="table" id="table"  data-click-to-select="true"  data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-sort="true" data-pagination="true" data-search="true" data-show-columns="true"  data-show-refresh="true" data-key-events="true"  data-resizable="true" data-cookie="true"
     data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
    
<thead>
 <tr>
   <th data-field="id" data-sortable="true">Id</th> 
    <th data-field="coupontype" data-sortable="true">Coupon Type</th>
    <th data-field="code" data-sortable="true">Coupon Code</th>
    <th data-field="discounttype" data-sortable="true">Discount Type</th>
    <th data-field="Discount" data-sortable="true">Discount</th>
   <th data-field="status" data-sortable="true">Status</th>
   <th>Action</th>
</tr>
</thead>
<tbody>



<tr>
        <td>#001</td>
        <td>Mimimum Purchase 
            <br><span>Rs 1500</span>
        </td>
        <td>OFF15%</td>
        <td>Fixed</td>
        <td>150</td>
        <td>
<label class="switch">
<input type="checkbox"  onclick="return confirm('Are you sure, you want to Change it?')" checked id="togBtn">
<div class="slider round"><!--ADDED HTML -->
<span class="off">Inactive </span>
<span class="on">Active</span><!--END--></div>
</label>

</div>

</td>
        <td><span> <a href="#" class="badge badge-secondary px-2"  data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal"data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
        <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>
        
    </tr>

    <tr>
        <td>#002</td>
        <td>DateWise
            <br><span>13-05-2022 to 16-05-2022</span>
        </td>
        <td>OFF10%</td>
        <td>percentage </td>
        <td>10%</td>
        <td>
        <label class="switch">
        <input type="checkbox"  onclick="return confirm('Are you sure, you want to Change it?')" checked id="togBtn">
        <div class="slider round"><!--ADDED HTML -->
        <span class="off">Inactive </span>
        <span class="on">Active</span><!--END--></div>
        </label>

    </div>

    </td>
        <td><span> <a href="#" class="badge badge-secondary px-2"  data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal"data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
        <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a></span></td>
        
    </tr>
    
  

</tbody>
</table> </div>


                           
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

        </div>
		
		<style>
		#deactive{
	display:none;
	
	
	}
	</style>
		
		
		
		
		
<script>
						function status(){
		
		
		document.getElementById("deactive").style.display="block";
		document.getElementById("active").style.display="none";
	document.getElementById("deactive").style.width="33%";
		
		
		
	}
	function status1(){
		
		
		document.getElementById("active").style.display="block";
		document.getElementById("deactive").style.display="none";
		document.getElementById("active").style.width="33%";
		
	}
					
					
					
					
					</script>
    @endsection

        {{-- <?php include('newfooter.php')?> --}}