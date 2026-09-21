@extends('layout.auth.master')
@section('contents')

@include('paritials.js.Offer.offer-list-js')

@include('paritials.auth.header')?>

<!-- page-wrapper Start-->
@include('paritials.auth.topmenu');
<!-- Page Header Ends -->

<!-- Page Body Start-->
<div class="page-body-wrapper">
	
	<!-- Page Sidebar Start-->
	@include('paritials.auth.sidemenu');
	<!-- Page Sidebar Ends-->
	
	<!-- Right sidebar Start-->
	
	<!-- Right sidebar Ends-->

          <div class="page-body">

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-12">
                        <ol class="breadcrumb" style="float: left !important; margin-bottom: 0; padding-left: 0;">
                            <li class="breadcrumb-item"><a href="dashboard.php"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item active">List Orders</li>
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
                                
                          <a href="{{ url('offer/create?id=1') }}" class="btn mb-4 btn-primary"><i class="fa fa-plus"></i> Add Offers </a> <button type="button" class="btn btn-success btn-export-excel ms-2" style="background-color: #28a745; border-color: #28a745; color: #fff;"><i class="fa fa-file-excel-o me-1"></i> Export Excel</button> 


                            <div class="datatable-dashv1-list custom-datatable-overright">

                            
<table class="table" id="table"  data-click-to-select="true"  data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-sort="true" data-pagination="true" data-page-size="25" data-search="true" data-show-columns="true"  data-show-refresh="false" data-key-events="true"  data-resizable="true" data-cookie="true"
     data-show-export="false" data-click-to-select="true" data-toolbar="#toolbar">
    
<thead>
 <tr>
   <th data-field="id" data-sortable="true">Id</th> 
   
   <th data-field="title" data-sortable="true">Orders ID</th>
    <th data-field="otype" data-sortable="true">Name</th>
	
    
    <th data-field="startdate" data-sortable="true">Phone</th>
	 <th data-field="enddate" data-sortable="true">Email</th>
	 
	 <th data-field="dtype" data-sortable="true">Address</th>
	 <th data-field="value" data-sortable="true">Total</th>
	 <th data-field="shold" data-sortable="true">Discount</th>
	 <th data-field="shold" data-sortable="true">Shipping</th>
	 
   <th data-field="status" data-sortable="true">Granttotal</th>
   <th data-field="gst_charge" data-sortable="true">gst_charge</th>
   
   {{-- <th>Action</th> --}}
</tr>
</thead>
<tbody>
                                        @foreach ($orders as $attribute)
                                            <tr>
                                                <td>#{{ $loop->iteration }}</td>


                                                <td>{{ $attribute->orders_id }}</td>

                                                <td>{{ $attribute->firstname }}</td>

                                                <td>                                          
                                                    {{ $attribute->phone }}
                                                </td>
												<td>                                          
                                                    {{ $attribute->email }}
                                                </td>
												<td>                                          
                                                    {{ $attribute->address }}
                                                </td>
												
												<td>                                          
                                                    {{ $attribute->total }}
                                                </td>
                                                <td>                                          
                                                    {{ $attribute->discount }}
                                                </td>
                                                <td>                                          
                                                    {{ $attribute->shipping }}
                                                </td>
                                                <td>                                          
                                                    {{ $attribute->grandtotal }}
                                                </td>
                                                <td>                                          
                                                    {{ $attribute->gst_charge }}
                                                </td>
                                               
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
</table>
</div>


                           
                              
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

        </div>

@endsection
