@extends('layout.auth.master')
@section('contents')

@include('paritials.css.auction.auction')?>

    @include('paritials.auth.header')?>

<!-- page-wrapper Start-->
@include('paritials.auth.topmenu');
<!-- Page Header Ends -->

<!-- Page Body Start-->
<div class="page-body-wrapper">
	
	<!-- Page Sidebar Start-->
	@include('paritials.vendorauth.sidemenu');
	<!-- Page Sidebar Ends-->
	
	<!-- Right sidebar Start-->
	
	<!-- Right sidebar Ends-->
	
         <div class="page-body">

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <h3>List Offers
                                  
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
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
                                
                          <a href="{{url('auction/create')}}" class="btn mb-4 btn-primary"><i class="fa fa-plus"></i> Add Offers </a> 


                            <div class="datatable-dashv1-list custom-datatable-overright">

                            
<table class="table" id="table"  data-click-to-select="true"  data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-sort="true" data-pagination="true" data-search="true" data-show-columns="true"  data-show-refresh="true" data-key-events="true"  data-resizable="true" data-cookie="true"
     data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
    
<thead>
 <tr>
   <th data-field="id" data-sortable="true">Id</th> 
   
   <th data-field="sprice" data-sortable="true">Starting Price</th>
    <th data-field="slab" data-sortable="true">SLAB</th>
	
    
    <th data-field="bid" data-sortable="true">BID Price</th>
	 <th data-field="so" data-sortable="true">Stat Offer</th>
	 
	 <th data-field="eo" data-sortable="true">End Offer</th>
	
	 
   <th data-field="status" data-sortable="true">Status</th>
   <th>Action</th>
</tr>
</thead>
<tbody>



<tr>
        <td>#001</td>
          <td>2000</span>
        </td>
        <td>---</td>
        <td>200</td>
        <td>05-JUNE-2022</td>
		  <td>05-jul-2022</td>
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
        <td>1000</span>
        </td>
        <td>---</td>
        <td>100</td>
        <td>05-JUNE-2022</td>
		  <td>05-jul-2022</td>
		    
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
		
@endsection