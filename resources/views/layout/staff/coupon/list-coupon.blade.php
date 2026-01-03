@extends('layout.auth.master')
@section('contents')

    @include('paritials.auth.header')?>

<!-- page-wrapper Start-->
@include('paritials.auth.topmenu');
<!-- Page Header Ends -->

<!-- Page Body Start-->
<div class="page-body-wrapper">
	
	<!-- Page Sidebar Start-->
	@include('paritials.staffauth.sidemenu');
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
                                
                          <a href="{{ route('staffcoupon.index') }}" class="btn mb-4 btn-primary"><i class="fa fa-plus"></i> Add Coupon </a> 


                            <div class="datatable-dashv1-list custom-datatable-overright">

                            
                <table class="table" id="table"  data-click-to-select="true"  data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-sort="true" data-pagination="true" data-search="true" data-show-columns="true"  data-show-refresh="true" data-key-events="true"  data-resizable="true" data-cookie="true"
                     data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">

                <thead>
                 <tr>
                   <th data-field="id" data-sortable="true">Id</th> 
                    <th data-field="title" data-sortable="true">Coupon Title</th>
                    <th data-field="code" data-sortable="true">Coupon Code</th>
                	<th data-field="dt" data-sortable="true">Discount Type</th>
                    <th data-field="da" data-sortable="true">Discount</th>

                    <th data-field="mrt" data-sortable="true">Minimum Requirment Type</th>
                    <th data-field="mra" data-sortable="true">Value</th>
                
                	<th data-field="sd" data-sortable="true">Start Date</th>
                	<th data-field="ed" data-sortable="true">End Date</th>
                
                
                
                

                   <th data-field="status" data-sortable="true">Status</th>
                   <th>Action</th>
                </tr>
                </thead>
                <tbody>
                
                @foreach($coupondata as $coupondata)
                
                <tr>
                    <td>#{{ $loop->iteration }}</td>
                    <td>{{ $coupondata->title }}</td>
                    <td>{{ $coupondata->coupon_code  }}</td>
                     <td>{{ $coupondata->discount_type  }}</td>
                     @if($coupondata->discount_type=='Fixed')
                      <td>{{ $coupondata->discount_amount }}</td>
                      @else
                       <td>{{ $coupondata->discount_percentage  }}</td>
                       @endif
                       <td>{{ $coupondata->minimum_requirment_type }}</td>
                       @if($coupondata->minimum_requirment_type=='None')
                       <td>None</td>
                       @elseif($coupondata->minimum_requirment_type=='Amount')
                       <td>{{ $coupondata->minimum_requirment_amount }}</td>
                       @else
                       <td>{{ $coupondata->minimum_requirment_quantity }}</td>
                       @endif
                       <td>{{ $coupondata->start_date }}</td>

                       <td>{{ $coupondata->end_date }}</td>
                
                        <td>
                            <?php
                                    $ed= $coupondata->end_date;
                                    $sd = $coupondata->start_date;
                                   // dd($ed);
                                    //exit();
                            ?>
                        <label class="switch">
                         
                        @if($ed >= $date  && $sd <= $date)                                                            
                            <input type="checkbox"
                                onclick="return confirm('you want to Change it?  Please Click Edit Button')"
                                checked id="togBtn">                                                            
                            @else
                                <input type="checkbox"
                                onclick="return confirm('you want to Change it?  Please Click Edit Button')" 
                                 id="togBtn">                                                            
                            @endif
                        <div class="slider round">
                            <!--ADDED HTML -->
                            <span class="off">Inactive</span>
                            <span class="on">Active</span>
                            <!--END-->
                        </div>
                        
                        </label>
                    
                        </div>
                    
                        </td>
                        <td>
                            <span class="mt-3 d-flex"> 
                                <form action="{{ route('staffcoupon.edit', $coupondata->id) }}"
                                    method="get">
                                    @method('GET')
                                    @csrf
                                <button class="btn btn-secondary mx-1"
                                onclick="return confirm('Are you sure, you want to Edit it?')"
                                        data-original-title="Edit"><i class="fa fa-pencil"></i> </button>
                                </form>
                                    {{-- <a href="#" class="badge badge-secondary px-2"  data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal"data-original-title="Edit"><i class="fa fa-pencil"></i> </a> --}}
                                    <form action="{{ route('staffcoupon.destroy', $coupondata->id) }}"
                                        method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit" class="btn btn-warning mx-1"
                                            onclick="return confirm('Are you sure, you want to delete it?')"><i
                                                class="fa fa-trash"></i>
                                                
                                        </button>                        
                            </form>
                                    {{-- <a href="#" onclick="return confirm('Are you sure, you want to delete it?')" class="badge badge-warning px-2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><i class="fa fa-trash"></i></a> --}}
                            </span>
                        </td>
                                
                            </tr>        
                            @endforeach
                        </tbody>
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