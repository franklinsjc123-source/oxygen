{{-- <?php include('header.php')?> --}}
@extends('website.layouts.master')
<!-- page-wrapper Start-->

@include('website.pages.topmenu')
    <!-- Page Header Ends -->

    <!-- Page Body Start-->
    <div class="page-body-wrapper">

        <!-- Page Sidebar Start-->
        
        <?php include('sidemenu.php')?>
        <!-- Page Sidebar Ends-->

        <!-- Right sidebar Start-->
       
        <!-- Right sidebar Ends-->
@section('content')
        <div class="page-body">

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-12">
                        <ol class="breadcrumb" style="float: left !important; margin-bottom: 0; padding-left: 0;">
                            <li class="breadcrumb-item"><a href="dashboard.php"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item active">List Offers</li>
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
                                
                        


                             <button type="button" class="btn btn-success btn-export-excel ms-2" style="background-color: #28a745; border-color: #28a745; color: #fff;"><i class="fa fa-file-excel-o me-1"></i> Export Excel</button>
<div class="mb-3"></div>
<div class="datatable-dashv1-list custom-datatable-overright">

                            
<table class="table" id="table"  data-click-to-select="true"  data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-sort="true" data-pagination="true" data-page-size="25" data-search="true" data-show-columns="true"  data-show-refresh="false" data-key-events="true"  data-resizable="true" data-cookie="true"
     data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
    
<thead>
 <tr>
   <th data-field="id" data-sortable="true">Id</th> 
   
    <th data-field="code" data-sortable="true">Offer Code</th>
	
    <th data-field="offertype" data-sortable="true">Offer Type</th>
    <th data-field="startdate" data-sortable="true">Start Date</th>
	 <th data-field="enddate" data-sortable="true">End Date</th>
   <th data-field="status" data-sortable="true">Status</th>
   <th>Action</th>
</tr>
</thead>
<tbody>



<tr>
        <td>#001</td>
        <td>Offer Buy 1 Get 1
            <br><span>OFF50</span>
        </td>
        <td>BUY 1 GET 1</td>
        <td>25-MAY-2022</td>
        <td>05-JUNE-2022</td>
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
        <td>Offer Buy 1 Get 1
            <br><span>OFF50</span>
        </td>
        <td>BUY 2 GET 1</td>
        <td>25-MAY-2022</td>
        <td>05-JUNE-2022</td>
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
