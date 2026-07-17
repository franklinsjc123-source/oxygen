@extends('layout.auth.master')
@section('contents')



<!-- page-wrapper Start-->
@include('paritials.auth.topmenu');
<!-- Page Header Ends -->

<style>
    /* Modern, soft-pill tab styling */
    .order-custom-tabs {
        border-bottom: none;
        margin-bottom: 25px;
        background-color: #f4f6f9; /* Soft gray container */
        padding: 8px;
        border-radius: 12px;
        display: inline-flex;
        flex-wrap: wrap;
        gap: 5px;
    }
    .order-custom-tabs .nav-item {
        margin-bottom: 0;
    }
    .order-custom-tabs .nav-link {
        color: #495057 !important;
        font-weight: 600;
        font-size: 1.05rem;
        border: none !important;
        border-radius: 8px !important;
        padding: 10px 22px;
        transition: all 0.25s ease-in-out;
        background-color: transparent !important;
    }
    .order-custom-tabs .nav-link:hover {
        color: #1a1d20 !important;
        background-color: #e9ecef !important;
    }
    .order-custom-tabs .nav-link.active, .order-custom-tabs .nav-item.show .nav-link {
        color: #0d6efd !important; /* Rich blue text */
        background-color: #ffffff !important; /* White pill */
        box-shadow: 0 2px 8px rgba(0,0,0,0.08); /* Soft shadow to make it pop */
    }
    
    /* SweetAlert2 font size adjustment for visual consistency */
    .swal2-popup {
        font-size: 1.6rem !important;
    }
</style>

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
                    <div class="col-lg-6">
                        <div class="page-header-left">
                            <h3>Active Order's

                            </h3>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <ol class="breadcrumb pull-right">
                            <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}"><i data-feather="home"></i></a></li>
                            <li class="breadcrumb-item active">Order List</li>
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
                    <div class="card tab2-card">

                        <div class="card-body">


                            <ul class="nav nav-tabs order-custom-tabs" id="myTab" role="tablist">
                                <li class="nav-item"><a class="nav-link active show" id="new-tabs" data-bs-toggle="tab" href="#new" role="tab" aria-controls="new" aria-selected="false" data-original-title="" title=""><span class="fw-bold">New ({{$new}})</span> </a></li>
                                <li class="nav-item"><a class="nav-link" id="general-tab" data-bs-toggle="tab" href="#general" role="tab" aria-controls="general" aria-selected="true" data-original-title="" title=""><span class="fw-bold">Accepted ({{$accept}})</span> </a></li>

                                <li class="nav-item"><a class="nav-link" id="dispatch-tab" data-bs-toggle="tab" href="#dispatch" role="tab" aria-controls="dispatch" aria-selected="true" data-original-title="" title=""><span class="fw-bold">Dispatch ({{$dispatch}})</span> </a></li>
                                <li class="nav-item"><a class="nav-link" id="delivery-tab" data-bs-toggle="tab" href="#delivery" role="tab" aria-controls="delivery" aria-selected="true" data-original-title="" title=""><span class="fw-bold">Delivered ({{$delivered}})</span></a></li>
                                <li class="nav-item"><a class="nav-link" id="usage-tab" data-bs-toggle="tab" href="#usage" role="tab" aria-controls="usage" aria-selected="false" data-original-title="" title=""><span class="fw-bold">Return ({{$return}})</span> </a></li>
								
								<li class="nav-item"><a class="nav-link" id="cancel-tab" data-bs-toggle="tab" href="#cancel" role="tab" aria-controls="cancel" aria-selected="false" data-original-title="" title=""><span class="fw-bold">Cancel ({{$cancel}})</span></a></li>
								
                            </ul>

                            <div class="tab-content" id="myTabContent">

                                <div class="tab-pane fade active show" id="new" role="tabpanel" aria-labelledby="new-tabs">
								<div class="mt-3"> 
                                    <button class="btn border border-success text-success accept">Accept</button> 
                                    <button class="btn border border-danger text-danger cancelbulk">Cancel</button> 
                                </div>
                                    {{-- <form class="needs-validation" novalidate=""> --}}
			
                                        <div class="row">

                                            <div class="datatable-dashv1-list custom-datatable-overright" >


                                                <table class="table fcolor" id="table" data-click-to-select="true" data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-show-columns="true" data-sort="true" data-pagination="true" data-page-size="25" data-search="true" data-show-refresh="true" data-key-events="true" data-resizable="true" data-cookie="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar" >
                                                    <thead>
                                                        <tr>
														{{-- <th data-field="dd" data-checkbox="true">
                                                         </th> --}}
                                                         <th width="50px"><input type="checkbox" id="master"></th>

														<th data-field="orderid" data-sortable="true">ORDER ID</th>
														<th data-field="date" data-sortable="true">ORDER DATE</th>
														<th data-field="image" data-sortable="true">IMAGE</th>&nbsp; &nbsp; 
                                                        <th data-field="productname" data-sortable="true"> PRODUCT NAME</th>
                                                            <th data-field="orderqty" data-sortable="true">ORDER QTY</th>
<th data-field="paymentmode" data-sortable="true">PAYMENT MODE</th>
															<th data-field="action" data-sortable="true">ACTION</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php
                                                     
                                                        use App\Models\Ecom_Orders;
                                                        use App\Models\Ecom_Order_product;

                                                    
                                                        $ordersproduct = Ecom_Orders::join('ecom_order_product',"ecom_order_product.order_id","=","ecom_order_info.order_id")
                                                        ->where('ecom_order_product.order_status', '=', 'Pending')->get();
                                                        
                                                        $ordersproductaccept = Ecom_Orders::join('ecom_order_product',"ecom_order_product.order_id","=","ecom_order_info.order_id")
                                                        ->where('ecom_order_product.order_status', '=', 'Accept')->get();

                                                        $ordersproductdispatch = Ecom_Orders::join('ecom_order_product',"ecom_order_product.order_id","=","ecom_order_info.order_id")
                                                        ->where('ecom_order_product.order_status', '=', 'Dispatch')->get();
                                                        $ordersproductdelivered = Ecom_Orders::join('ecom_order_product',"ecom_order_product.order_id","=","ecom_order_info.order_id")
                                                        ->where('ecom_order_product.order_status', '=', 'Delivered')->get();
                                                        $ordersproductreturn = Ecom_Orders::join('ecom_order_product',"ecom_order_product.order_id","=","ecom_order_info.order_id")
                                                        ->where('ecom_order_product.order_status', '=', 'Return')->get();
                                                        $ordersproductcancel = Ecom_Orders::join('ecom_order_product',"ecom_order_product.order_id","=","ecom_order_info.order_id")
                                                        ->where('ecom_order_product.order_status', '=', 'Cancel')->get();
                                                        //  dd($ordersproductaccept);
                                                        ?>
                                                        @foreach ($ordersproduct as $attribute)
                                                        <tr>
                                                            
                                                            <?php
                                                            // print_r($attribute);
                                                            // exit();
                                                            ?>
                                                            
                                                            <td><input type="checkbox" class="sub_chk" data-id="{{$attribute->id}}"></td>   
                                                            
            
            
                                                            <td>{{ $attribute->order_id }}</td>
            
                                                            <td>{{ Carbon\Carbon::parse($attribute->order_date, 'UTC')->timezone('Asia/Kolkata')->format('d-m-Y h:i:s A') }}</td>
            
                                                            <td>       
                                                                
                                                                <img src="{{ asset('assets/images/products/detail') . '/' . $attribute->product_image }}"
                                                                                        class="img-fluid img-30 me-2 blur-up lazyloaded" alt="">
                                                                {{-- {{ $attribute->product_image }} --}}
                                                            </td>
                                                            <td>                                          
                                                                {{ $attribute->product_name }}
                                                            </td>
                                                            <td>{{ $attribute->product_quantity }}</td>
<td>                                          
                                                                @if(stripos($attribute->payment_type, 'Cash') !== false || $attribute->payment_type == 'COD')
                                                                    <span class="badge badge-warning text-dark">COD</span>
                                                                @else
                                                                    <span class="badge badge-success">Online</span>
                                                                @endif
                                                            </td>
                                                            <td><span> 
                                                                {{-- <button  id ="btnnew" value= "{{ $attribute->id }}" data-status="{{ $attribute->order_status }}" class="btnnew badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="" data-original-title="Edit"><i class="fa fa-pencil"></i> </button> --}}
															 @if (session()->get('log_type') == 'Admin')
                                                                    <a href="#" class="btn btn-info btn-sm view-product-details text-white" 
   data-id="{{ $attribute->product_id }}"
   data-name="{{ $attribute->product_name }}"
   data-image="{{ asset('assets/images/products/detail') . '/' . $attribute->product_image }}"
   data-size="{{ $attribute->product_size }}"
   data-price="{{ $attribute->product_price }}"
   data-qty="{{ $attribute->product_quantity }}"
   data-total="{{ $attribute->total_price }}"
   data-bs-toggle="modal" data-bs-target="#viewDetailsModal"
   data-toggle="tooltip" data-placement="top" title="View Details">
   <i class="fa fa-eye"></i>
</a></span></td>
                                                           @endif
                                                        </tr>
                                                    @endforeach

                                                    </tbody>
                                                </table>
												
												<!-- The Modal -->
                                            <div class="modal" id="New">
                                            <div class="modal-dialog  modal-dialog-centered">
                                                <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Status</h4>
                                                    <button type="button" class="btn-close text-danger" data-bs-dismiss="modal"></button>
                                                </div>

                                                <!-- Modal body -->
                                                        {{-- <form action="{{ route('orderstatusupdate',$ordersproduct[0]->id) }}" method="POST" enctype="multipart/form-data"> --}}
                                                            {{-- {{ method_field('PUT') }} --}}
                                                            {{-- {{ csrf_field() }} --}}
                                                            <div class="modal-body">
                                                                            <div class="container-fluid">
                                                                                <div class="row">
                                                                                
                                                                                        <div class="col-md-3">Change Status	</div>
                                                                                                <div class="col-md-6">
                                                                                                            <select class="form-select form-select-lg" name="status"  id="o_status" required="">
                                                                                                                    <option selected disabled>--Select--</option>
                                                                                                                    <option value="Accept">Accept</option>
                                                                                                                    <option value="Dispatch">Dispatch</option>
                                                                                                                    <option value="Delivered">Delivered</option>
                                                                                                                    <option value="Return">Return</option>
                                                                                                                    <option value="Cancel">Cancel</option>
                                                                                                                                                    
                                                                                                                </select>
                                                                                                </div>
                                                                                                
                                                                                </div>  
                                                                            </div>
                                                            </div>

                                                            <!-- Modal footer -->
                                                            <div class="modal-footer">
                                                                <button type="submit" class="btn btn-primary">SUBMIT</button>
                                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                            </div>
                                                        {{-- </form>	 --}}
                                                        </div>
                                                  
                                            </div>
                                            </div>
                                            </div>

                                        </div>
                                    {{-- </form> --}}
                                </div>


                                <div class="tab-pane fade" id="general" role="tabpanel" aria-labelledby="general-tab">
											<div class="mt-3"> <button class="btn border border-primary text-primary dispatch" >Dispatch</button> 
                                                <button class="btn border border-danger text-danger cancelbulkdispatch">Cancel</button> 
                                            </div>
                                    
                                    <div class="row">

                                        <div class="datatable-dashv1-list custom-datatable-overright" >


                                            <table class="table fcolor" id="table" data-click-to-select="true" data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-show-columns="true" data-sort="true" data-pagination="true" data-page-size="25" data-search="true" data-show-refresh="true" data-key-events="true" data-resizable="true" data-cookie="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar" >
                                                <thead>
                                                    <tr>
                                                    {{-- <th data-field="dd" data-checkbox="true">
                                                     </th> --}}
                                                     <th width="50px"><input type="checkbox" id="dismaster"></th>
                                                     <th></th>
                                                    <th data-field="orderid" data-sortable="true">ORDER ID</th>
                                                    <th data-field="date" data-sortable="true">ORDER DATE</th>
                                                    <th data-field="image" data-sortable="true">IMAGE</th>&nbsp; &nbsp; 
                                                    <th data-field="productname" data-sortable="true"> PRODUCT NAME</th>
                                                    <th data-field="orderqty" data-sortable="true">ORDER QTY</th>
<th data-field="paymentmode" data-sortable="true">PAYMENT MODE</th>
                                                    <th data-field="action" data-sortable="true">ACTION</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                //  use App\Models\order\Orders;
                                                //  use App\Models\order\ordersproduct;

                                                
                                                    // $ordersproduct1 = orders::join('ecom_order_product',"ecom_order_product.order_id","=","ecom_order_info.order_id")->get();
                                                  //  dd($ordersproductaccept);
                                                    ?>
                                                    @foreach ($ordersproductaccept as $attribute)
                                                    <tr>
                                                        <td><input type="checkbox" class="sub_check" data-id="{{$attribute->id}}"></td>   
                                                        {{-- @dd($attribute); --}}
                                                        <td>{{ $loop->iteration }}</td>
        
        
                                                        <td>{{ $attribute->order_id }}</td>
        
                                                        <td>{{ Carbon\Carbon::parse($attribute->order_date, 'UTC')->timezone('Asia/Kolkata')->format('d-m-Y h:i:s A') }}</td>
        
                                                        <td>       
                                                            
                                                            <img src="{{ asset('assets/images/products/detail') . '/' . $attribute->product_image }}"
                                                                                    class="img-fluid img-30 me-2 blur-up lazyloaded" alt="">
                                                            {{-- {{ $attribute->product_image }} --}}
                                                        </td>
                                                        <td>                                          
                                                            {{ $attribute->product_name }}
                                                        </td>
                                                        <td>{{ $attribute->product_quantity }}</td>
<td>                                          
                                                            @if(stripos($attribute->payment_type, 'Cash') !== false || $attribute->payment_type == 'COD')
                                                                <span class="badge badge-warning text-dark">COD</span>
                                                            @else
                                                                <span class="badge badge-success">Online</span>
                                                            @endif
                                                        </td>
                                                            <td><span>
   {{-- <button  id ="btnaccess" value= "{{ $attribute->id }}" data-status="{{ $attribute->order_status }}" class="btnaccess badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="" data-original-title="Edit"><i class="fa fa-pencil"></i> </button> --}}
                                                          
                                                         @if (session()->get('log_type') == 'Admin')
                                                                <a href="#" class="btn btn-info btn-sm view-product-details text-white" 
   data-id="{{ $attribute->product_id }}"
   data-name="{{ $attribute->product_name }}"
   data-image="{{ asset('assets/images/products/detail') . '/' . $attribute->product_image }}"
   data-size="{{ $attribute->product_size }}"
   data-price="{{ $attribute->product_price }}"
   data-qty="{{ $attribute->product_quantity }}"
   data-total="{{ $attribute->total_price }}"
   data-bs-toggle="modal" data-bs-target="#viewDetailsModal"
   data-toggle="tooltip" data-placement="top" title="View Details">
   <i class="fa fa-eye"></i>
</a></span></td>
                                                       @endif
                                                    </tr>
                                                @endforeach

                                                </tbody>
                                            </table>
                                            
                                            <!-- The Modal -->
                                        <div class="modal" id="accept">
                                        <div class="modal-dialog  modal-dialog-centered">
                                            <div class="modal-content">

                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Status</h4>
                                                <button type="button" class="btn-close text-danger" data-bs-dismiss="modal"></button>
                                            </div>

                                            <!-- Modal body -->
                                                    {{-- <form action="{{ route('orderstatusupdate',$ordersproduct[0]->id) }}" method="POST" enctype="multipart/form-data"> --}}
                                                        {{-- {{ method_field('PUT') }} --}}
                                                        {{-- {{ csrf_field() }} --}}
                                                        <div class="modal-body">
                                                                        <div class="container-fluid">
                                                                            <div class="row">
                                                                            
                                                                                    <div class="col-md-3">Change Status	</div>
                                                                                            <div class="col-md-6">
                                                                                                        <select class="form-select form-select-lg" name="status" id ="a_status" required="">
                                                                                                                <option selected disabled>--Select--</option>
                                                                                                                <option value="Accept">Accept</option>
                                                                                                                <option value="Dispatch">Dispatch</option>
                                                                                                                <option value="Delivered">Delivered</option>
                                                                                                                <option value="Return">Return</option>
                                                                                                                <option value="Cancel">Cancel</option>
                                                                                                                                                
                                                                                                            </select>
                                                                                            </div>
                                                                                            
                                                                            </div>  
                                                                        </div>
                                                        </div>

                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">SUBMIT</button>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    {{-- </form>	 --}}
                                                    </div>
                                              
                                        </div>
                                        </div>
                                        </div>

                                    </div>
                                </div>
					
                                <div class="tab-pane fade" id="dispatch" role="tabpanel" aria-labelledby="dispatch-tabs">
						<div class="mt-3"> <button class="btn border border-success text-success delivered" >Delivered</button> 
                           
                        </div>
                                
                        
                        <div class="row">

                            <div class="datatable-dashv1-list custom-datatable-overright" >


                                <table class="table fcolor" id="table" data-click-to-select="true" data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-show-columns="true" data-sort="true" data-pagination="true" data-page-size="25" data-search="true" data-show-refresh="true" data-key-events="true" data-resizable="true" data-cookie="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar" >
                                    <thead>
                                        <tr>
                                        {{-- <th data-field="dd" data-checkbox="true">
                                         </th> --}}
                                          <th width="50px"><input type="checkbox" id="delmaster"></th>
                                        <th data-field="orderid" data-sortable="true">ORDER ID</th>
                                        <th data-field="date" data-sortable="true">ORDER DATE</th>
                                        <th data-field="image" data-sortable="true">IMAGE</th>&nbsp; &nbsp; 
                                        <th data-field="productname" data-sortable="true"> PRODUCT NAME</th>
                                            <th data-field="orderqty" data-sortable="true">ORDER QTY</th>
<th data-field="paymentmode" data-sortable="true">PAYMENT MODE</th>
                                            <th data-field="action" data-sortable="true">ACTION</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    //  use App\Models\order\Orders;
                                    //  use App\Models\order\ordersproduct;

                                    
                                        // $ordersproduct1 = orders::join('ecom_order_product',"ecom_order_product.order_id","=","ecom_order_info.order_id")->get();
                                      //  dd($ordersproductaccept);
                                        ?>
                                        @foreach ($ordersproductdispatch as $attribute)
                                        <tr>
                                            {{-- @dd($attribute); --}}
                                             <td><input type="checkbox" class="sub_check" data-id="{{$attribute->id}}"></td>   
                                            <!--<td>{{ $loop->iteration }}</td>-->


                                            <td>{{ $attribute->order_id }}</td>

                                            <td>{{ Carbon\Carbon::parse($attribute->order_date, 'UTC')->timezone('Asia/Kolkata')->format('d-m-Y h:i:s A') }}</td>

                                            <td>       
                                                
                                                <img src="{{ asset('assets/images/products/detail') . '/' . $attribute->product_image }}"
                                                                        class="img-fluid img-30 me-2 blur-up lazyloaded" alt="">
                                                {{-- {{ $attribute->product_image }} --}}
                                            </td>
                                            <td>                                          
                                                {{ $attribute->product_name }}
                                            </td>
                                            <td>{{ $attribute->product_quantity }}</td>
<td>                                          
                                                @if(stripos($attribute->payment_type, 'Cash') !== false || $attribute->payment_type == 'COD')
                                                    <span class="badge badge-warning text-dark">COD</span>
                                                @else
                                                    <span class="badge badge-success">Online</span>
                                                @endif
                                            </td>
                                                            <td><span> 
                                                
                                                {{-- <button  id ="btndispatch" value= "{{ $attribute->id }}" data-status="{{ $attribute->order_status }}" class="btndispatch badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="" data-original-title="Edit"><i class="fa fa-pencil"></i> </button> --}}
                                             @if (session()->get('log_type') == 'Admin')
                                                    <a href="#" class="btn btn-info btn-sm view-product-details text-white" 
   data-id="{{ $attribute->product_id }}"
   data-name="{{ $attribute->product_name }}"
   data-image="{{ asset('assets/images/products/detail') . '/' . $attribute->product_image }}"
   data-size="{{ $attribute->product_size }}"
   data-price="{{ $attribute->product_price }}"
   data-qty="{{ $attribute->product_quantity }}"
   data-total="{{ $attribute->total_price }}"
   data-bs-toggle="modal" data-bs-target="#viewDetailsModal"
   data-toggle="tooltip" data-placement="top" title="View Details">
   <i class="fa fa-eye"></i>
</a></span></td>
                                           @endif
                                        </tr>
                                    @endforeach

                                    </tbody>
                                </table>
                                
                                <!-- The Modal -->
                            <div class="modal" id="Dispatch">
                            <div class="modal-dialog  modal-dialog-centered">
                                <div class="modal-content">

                                <!-- Modal Header -->
                                <div class="modal-header">
                                    <h4 class="modal-title">Status</h4>
                                    <button type="button" class="btn-close text-danger" data-bs-dismiss="modal"></button>
                                </div>

                                <!-- Modal body -->
                                        {{-- <form action="{{ route('orderstatusupdate',$ordersproduct[0]->id) }}" method="POST" enctype="multipart/form-data"> --}}
                                            {{-- {{ method_field('PUT') }} --}}
                                            {{-- {{ csrf_field() }} --}}
                                            <div class="modal-body">
                                                            <div class="container-fluid">
                                                                <div class="row">
                                                                
                                                                        <div class="col-md-3">Change Status	</div>
                                                                                <div class="col-md-6">
                                                                                            <select class="form-select form-select-lg" name="status"  id="d_status" required="">
                                                                                                    <option selected disabled>--Select--</option>
                                                                                                    <option value="Accept">Accept</option>
                                                                                                    <option value="Dispatch">Dispatch</option>
                                                                                                    <option value="Delivered">Delivered</option>
                                                                                                    <option value="Return">Return</option>
                                                                                                    <option value="Cancel">Cancel</option>
                                                                                                                                    
                                                                                                </select>
                                                                                </div>
                                                                                
                                                                </div>  
                                                            </div>
                                            </div>

                                            <!-- Modal footer -->
                                            <div class="modal-footer">
                                                <button type="submit" class="btn btn-primary">SUBMIT</button>
                                                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                            </div>
                                        {{-- </form>	 --}}
                                        </div>
                                  
                            </div>
                            </div>
                            </div>

                        </div>
                        
                       

                                </div>

                                <div class="tab-pane fade" id="delivery" role="tabpanel" aria-labelledby="delivery-tabs">
                                    
                                    


                                    <div class="row">

                                        <div class="datatable-dashv1-list custom-datatable-overright" >
            
            
                                            <table class="table fcolor" id="table" data-click-to-select="true" data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-show-columns="true" data-sort="true" data-pagination="true" data-page-size="25" data-search="true" data-show-refresh="true" data-key-events="true" data-resizable="true" data-cookie="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar" >
                                                <thead>
                                                    <tr>
                                                    <th data-field="dd" data-checkbox="true">
                                                     </th>
                                                    <th data-field="orderid" data-sortable="true">ORDER ID</th>
                                                    <th data-field="date" data-sortable="true">ORDER DATE</th>
                                                    <th data-field="image" data-sortable="true">IMAGE</th>&nbsp; &nbsp; 
                                                    <th data-field="productname" data-sortable="true"> PRODUCT NAME</th>
                                                        <th data-field="orderqty" data-sortable="true">ORDER QTY</th>
<th data-field="paymentmode" data-sortable="true">PAYMENT MODE</th>
                                                        <th data-field="action" data-sortable="true">ACTION</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                //  use App\Models\order\Orders;
                                                //  use App\Models\order\ordersproduct;
            
                                                
                                                    // $ordersproduct1 = orders::join('ecom_order_product',"ecom_order_product.order_id","=","ecom_order_info.order_id")->get();
                                                  //  dd($ordersproductaccept);
                                                    ?>
                                                    @foreach ($ordersproductdelivered as $attribute)
                                                    <tr>
                                                        {{-- @dd($attribute); --}}
                                                        <td>#{{ $loop->iteration }}</td>
            
            
                                                        <td>{{ $attribute->order_id }}</td>
            
                                                        <td>{{ Carbon\Carbon::parse($attribute->order_date, 'UTC')->timezone('Asia/Kolkata')->format('d-m-Y h:i:s A') }}</td>
            
                                                        <td>       
                                                            
                                                            <img src="{{ asset('assets/images/products/detail') . '/' . $attribute->product_image }}"
                                                                                    class="img-fluid img-30 me-2 blur-up lazyloaded" alt="">
                                                            {{-- {{ $attribute->product_image }} --}}
                                                        </td>
                                                        <td>                                          
                                                            {{ $attribute->product_name }}
                                                        </td>
                                                        <td>{{ $attribute->product_quantity }}</td>
<td>                                          
                                                            @if(stripos($attribute->payment_type, 'Cash') !== false || $attribute->payment_type == 'COD')
                                                                <span class="badge badge-warning text-dark">COD</span>
                                                            @else
                                                                <span class="badge badge-success">Online</span>
                                                            @endif
                                                        </td>
                                                            <td><span>
                                                            
                                                            {{-- <button  id ="btndelivered" value= "{{ $attribute->id }}" data-status="{{ $attribute->order_status }}" class="btndelivered badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="" data-original-title="Edit"><i class="fa fa-pencil"></i> </button> --}}
                                                         @if (session()->get('log_type') == 'Admin')
                                                                <a href="#" class="btn btn-info btn-sm view-product-details text-white" 
   data-id="{{ $attribute->product_id }}"
   data-name="{{ $attribute->product_name }}"
   data-image="{{ asset('assets/images/products/detail') . '/' . $attribute->product_image }}"
   data-size="{{ $attribute->product_size }}"
   data-price="{{ $attribute->product_price }}"
   data-qty="{{ $attribute->product_quantity }}"
   data-total="{{ $attribute->total_price }}"
   data-bs-toggle="modal" data-bs-target="#viewDetailsModal"
   data-toggle="tooltip" data-placement="top" title="View Details">
   <i class="fa fa-eye"></i>
</a></span></td>
                                                       @endif
                                                    </tr>
                                                @endforeach
            
                                                </tbody>
                                            </table>
                                            
                                            <!-- The Modal -->
                                        <div class="modal" id="delivere">
                                        <div class="modal-dialog  modal-dialog-centered">
                                            <div class="modal-content">
            
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Status</h4>
                                                <button type="button" class="btn-close text-danger" data-bs-dismiss="modal"></button>
                                            </div>
            
                                            <!-- Modal body -->
                                                    {{-- <form action="{{ route('orderstatusupdate',$ordersproduct[0]->id) }}" method="POST" enctype="multipart/form-data"> --}}
                                                        {{-- {{ method_field('PUT') }} --}}
                                                        {{-- {{ csrf_field() }} --}}
                                                        <div class="modal-body">
                                                                        <div class="container-fluid">
                                                                            <div class="row">
                                                                            
                                                                                    <div class="col-md-3">Change Status	</div>
                                                                                            <div class="col-md-6">
                                                                                                        <select class="form-select form-select-lg" name="status" id="deli_status" required="">
                                                                                                                <option selected disabled>--Select--</option>
                                                                                                                <option value="Accept">Accept</option>
                                                                                                                <option value="Dispatch">Dispatch</option>
                                                                                                                <option value="Delivered">Delivered</option>
                                                                                                                <option value="Return">Return</option>
                                                                                                                <option value="Cancel">Cancel</option>
                                                                                                                                                
                                                                                                            </select>
                                                                                            </div>
                                                                                            
                                                                            </div>  
                                                                        </div>
                                                        </div>
            
                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">SUBMIT</button>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>	
                                                    </div>
                                              
                                        </div>
                                        </div>
                                        </div>
            
                                    </div>

                                  
                                </div>




                                <div class="tab-pane fade" id="usage" role="tabpanel" aria-labelledby="usage-tab">
                                   
                                   
                                    <div class="row">

                                        <div class="datatable-dashv1-list custom-datatable-overright" >
            
            
                                            <table class="table fcolor" id="table" data-click-to-select="true" data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-show-columns="true" data-sort="true" data-pagination="true" data-page-size="25" data-search="true" data-show-refresh="true" data-key-events="true" data-resizable="true" data-cookie="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar" >
                                                <thead>
                                                    <tr>
                                                    <th data-field="dd" data-checkbox="true">
                                                     </th>
                                                    <th data-field="orderid" data-sortable="true">ORDER ID</th>
                                                    <th data-field="date" data-sortable="true">ORDER DATE</th>
                                                    <th data-field="image" data-sortable="true">IMAGE</th>&nbsp; &nbsp; 
                                                    <th data-field="productname" data-sortable="true"> PRODUCT NAME</th>
                                                        <th data-field="orderqty" data-sortable="true">ORDER QTY</th>
<th data-field="paymentmode" data-sortable="true">PAYMENT MODE</th>
                                                        <th data-field="action" data-sortable="true">ACTION</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                //  use App\Models\order\Orders;
                                                //  use App\Models\order\ordersproduct;
            
                                                
                                                    // $ordersproduct1 = orders::join('ecom_order_product',"ecom_order_product.order_id","=","ecom_order_info.order_id")->get();
                                                  //  dd($ordersproductaccept);
                                                    ?>
                                                    @foreach ($ordersproductreturn as $attribute)
                                                    <tr>
                                                        {{-- @dd($attribute); --}}
                                                        <td>#{{ $loop->iteration }}</td>
            
            
                                                        <td>{{ $attribute->order_id }}</td>
            
                                                        <td>{{ Carbon\Carbon::parse($attribute->order_date, 'UTC')->timezone('Asia/Kolkata')->format('d-m-Y h:i:s A') }}</td>
            
                                                        <td>       
                                                            
                                                            <img src="{{ asset('assets/images/products/detail') . '/' . $attribute->product_image }}"
                                                                                    class="img-fluid img-30 me-2 blur-up lazyloaded" alt="">
                                                            {{-- {{ $attribute->product_image }} --}}
                                                        </td>
                                                        <td>                                          
                                                            {{ $attribute->product_name }}
                                                        </td>
                                                        <td>{{ $attribute->product_quantity }}</td>
<td>                                          
                                                            @if(stripos($attribute->payment_type, 'Cash') !== false || $attribute->payment_type == 'COD')
                                                                <span class="badge badge-warning text-dark">COD</span>
                                                            @else
                                                                <span class="badge badge-success">Online</span>
                                                            @endif
                                                        </td>
                                                            <td><span> 
                                                            
                                                            {{-- <button  id ="btnreturn" value= "{{ $attribute->id }}" data-status="{{ $attribute->order_status }}" class="btnreturn badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="" data-original-title="Edit"><i class="fa fa-pencil"></i> </button> --}}
                                                         @if (session()->get('log_type') == 'Admin')
                                                                <a href="#" class="btn btn-info btn-sm view-product-details text-white" 
   data-id="{{ $attribute->product_id }}"
   data-name="{{ $attribute->product_name }}"
   data-image="{{ asset('assets/images/products/detail') . '/' . $attribute->product_image }}"
   data-size="{{ $attribute->product_size }}"
   data-price="{{ $attribute->product_price }}"
   data-qty="{{ $attribute->product_quantity }}"
   data-total="{{ $attribute->total_price }}"
   data-bs-toggle="modal" data-bs-target="#viewDetailsModal"
   data-toggle="tooltip" data-placement="top" title="View Details">
   <i class="fa fa-eye"></i>
</a></span></td>
                                                       @endif
                                                    </tr>
                                                @endforeach
            
                                                </tbody>
                                            </table>
                                            
                                            <!-- The Modal -->
                                        <div class="modal" id="return">
                                        <div class="modal-dialog  modal-dialog-centered">
                                            <div class="modal-content">
            
                                            <!-- Modal Header -->
                                            <div class="modal-header">
                                                <h4 class="modal-title">Status</h4>
                                                <button type="button" class="btn-close text-danger" data-bs-dismiss="modal"></button>
                                            </div>
            
                                            <!-- Modal body -->
                                                    {{-- <form action="{{ route('orderstatusupdate',$ordersproduct[0]->id) }}" method="POST" enctype="multipart/form-data"> --}}
                                                        {{-- {{ method_field('PUT') }} --}}
                                                        {{-- {{ csrf_field() }} --}}
                                                        <div class="modal-body">
                                                                        <div class="container-fluid">
                                                                            <div class="row">
                                                                            
                                                                                    <div class="col-md-3">Change Status	</div>
                                                                                            <div class="col-md-6">
                                                                                                        <select class="form-select form-select-lg" name="status" id="return_status" required="">
                                                                                                                <option selected disabled>--Select--</option>
                                                                                                                <option value="Accept">Accept</option>
                                                                                                                <option value="Dispatch">Dispatch</option>
                                                                                                                <option value="Delivered">Delivered</option>
                                                                                                                <option value="Return">Return</option>
                                                                                                                <option value="Cancel">Cancel</option>
                                                                                                                                                
                                                                                                            </select>
                                                                                            </div>
                                                                                            
                                                                            </div>  
                                                                        </div>
                                                        </div>
            
                                                        <!-- Modal footer -->
                                                        <div class="modal-footer">
                                                            <button type="submit" class="btn btn-primary">SUBMIT</button>
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                        </div>
                                                    </form>	
                                                    </div>
                                              
                                        </div>
                                        </div>
                                        </div>
            
                                    </div>
                                   
                                    


                                </div>
								
							<div class="tab-pane fade" id="cancel" role="tabpanel" aria-labelledby="cancel-tabs">	
								    
                                <div class="row">

                                    <div class="datatable-dashv1-list custom-datatable-overright" >
        
        
                                        <table class="table fcolor" id="table" data-click-to-select="true" data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-show-columns="true" data-sort="true" data-pagination="true" data-page-size="25" data-search="true" data-show-refresh="true" data-key-events="true" data-resizable="true" data-cookie="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar" >
                                            <thead>
                                                <tr>
                                                <th data-field="dd" data-checkbox="true">
                                                 </th>
                                                <th data-field="orderid" data-sortable="true">ORDER ID</th>
                                                <th data-field="date" data-sortable="true">ORDER DATE</th>
                                                <th data-field="image" data-sortable="true">IMAGE</th>&nbsp; &nbsp; 
                                                <th data-field="productname" data-sortable="true"> PRODUCT NAME</th>
                                                    <th data-field="orderqty" data-sortable="true">ORDER QTY</th>
<th data-field="paymentmode" data-sortable="true">PAYMENT MODE</th>
                                                    <th data-field="action" data-sortable="true">ACTION</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            //  use App\Models\order\Orders;
                                            //  use App\Models\order\ordersproduct;
        
                                            
                                                // $ordersproduct1 = orders::join('ecom_order_product',"ecom_order_product.order_id","=","ecom_order_info.order_id")->get();
                                              //  dd($ordersproductaccept);
                                                ?>
                                                @foreach ($ordersproductcancel as $attribute)
                                                <tr>
                                                    {{-- @dd($attribute); --}}
                                                    <td>#{{ $loop->iteration }}</td>
        
        
                                                    <td>{{ $attribute->order_id }}</td>
        
                                                    <td>{{ Carbon\Carbon::parse($attribute->order_date, 'UTC')->timezone('Asia/Kolkata')->format('d-m-Y h:i:s A') }}</td>
        
                                                    <td>       
                                                        
                                                        <img src="{{ asset('assets/images/products/detail') . '/' . $attribute->product_image }}"
                                                                                class="img-fluid img-30 me-2 blur-up lazyloaded" alt="">
                                                        {{-- {{ $attribute->product_image }} --}}
                                                    </td>
                                                    <td>                                          
                                                        {{ $attribute->product_name }}
                                                    </td>
                                                    <td>{{ $attribute->product_quantity }}</td>
<!--<td>                                          -->
                                                    <!--    {{ $attribute->payment_type }}-->
                                                    <!--</td>-->
                                                    
        
                                                    <td><span> 
                                                        {{-- <button  id ="btncancel" value= "{{ $attribute->id }}" data-status="{{ $attribute->order_status }}" class="btncancel badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="" data-original-title="Edit"><i class="fa fa-pencil"></i> </button> --}}
                                                     @if (session()->get('log_type') == 'Admin')
                                                            <a href="#" class="btn btn-info btn-sm view-product-details text-white" 
   data-id="{{ $attribute->product_id }}"
   data-name="{{ $attribute->product_name }}"
   data-image="{{ asset('assets/images/products/detail') . '/' . $attribute->product_image }}"
   data-size="{{ $attribute->product_size }}"
   data-price="{{ $attribute->product_price }}"
   data-qty="{{ $attribute->product_quantity }}"
   data-total="{{ $attribute->total_price }}"
   data-bs-toggle="modal" data-bs-target="#viewDetailsModal"
   data-toggle="tooltip" data-placement="top" title="View Details">
   <i class="fa fa-eye"></i>
</a></span></td>
                                                   @endif
                                                </tr>
                                            @endforeach
        
                                            </tbody>
                                        </table>
                                        
                                        <!-- The Modal -->
                                    <div class="modal" id="can">
                                    <div class="modal-dialog  modal-dialog-centered">
                                        <div class="modal-content">
        
                                        <!-- Modal Header -->
                                        <div class="modal-header">
                                            <h4 class="modal-title">Status</h4>
                                            <button type="button" class="btn-close text-danger" data-bs-dismiss="modal"></button>
                                        </div>
        
                                        <!-- Modal body -->
                                                {{-- <form action="{{ route('orderstatusupdate',$ordersproduct[0]->id) }}" method="POST" enctype="multipart/form-data"> --}}
                                                    {{-- {{ method_field('PUT') }} --}}
                                                    {{-- {{ csrf_field() }} --}}
                                                    <div class="modal-body">
                                                                    <div class="container-fluid">
                                                                        <div class="row">
                                                                        
                                                                                <div class="col-md-3">Change Status	</div>
                                                                                        <div class="col-md-6">
                                                                                                    <select class="form-select form-select-lg" name="status" id="can_status" required="">
                                                                                                            <option selected disabled>--Select--</option>
                                                                                                            <option value="Accept">Accept</option>
                                                                                                            <option value="Dispatch">Dispatch</option>
                                                                                                            <option value="Delivered">Delivered</option>
                                                                                                            <option value="Return">Return</option>
                                                                                                            <option value="Cancel">Cancel</option>
                                                                                                                                            
                                                                                                        </select>
                                                                                        </div>
                                                                                        
                                                                        </div>  
                                                                    </div>
                                                    </div>
        
                                                    <!-- Modal footer -->
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-primary">SUBMIT</button>
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                    </div>
                                                {{-- </form>	 --}}
                                                </div>
                                          
                                    </div>
                                    </div>
                                    </div>
        
                                </div>
                                
                                
                                {{-- <form class="needs-validation" novalidate="">
				
                                        <div class="row">

                                            <div class="datatable-dashv1-list custom-datatable-overright">


                                            <table class="table fcolor" id="table" data-click-to-select="true" data-sort-name="id" data-sort-order="asc" data-mobile-responsive="true" data-toggle="table" data-show-columns="true" data-sort="true" data-pagination="true" data-page-size="25" data-search="true" data-show-refresh="true" data-key-events="true" data-resizable="true" data-cookie="true" data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                                 <thead>
                                                        <tr>
														<th data-field="dd" data-checkbox="true">
                                                        </th>
														<th data-field="orderid" data-sortable="true">ORDER ID</th>
														<th data-field="date" data-sortable="true">CANCEL DATE</th>
														<th data-field="image" data-sortable="true">IMAGE</th>
                                                        <th data-field="productname" data-sortable="true"> PRODUCT NAME</th>
                                                            <th data-field="orderqty" data-sortable="true">ORDER QTY</th>
<th data-field="paymentmode" data-sortable="true">PAYMENT MODE</th>
															<th>ACTION</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>



                                                        <tr>
														<td></td>
                                                            <td>#093877</td>
                                                           
															<td>13-Jun-2022 10.30 AM</td>
															<td>10</td>
                                                            <td>00125</td>
                                                            
                                                            
												<td>	<div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div></td>
															 <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>
															<td>RED-L</td>
															<td>6</td>
                                                            <td><span class="font-primary">UPI</span></td>
															
														<td><p class="text-center" style="border:1px solid #f90000;color:#f90000;border-radius:5px;">Cancel</p></td>
															
                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#can" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" class="btn btn-info btn-sm view-product-details text-white" 
   data-id="{{ $attribute->product_id }}"
   data-name="{{ $attribute->product_name }}"
   data-image="{{ asset('assets/images/products/detail') . '/' . $attribute->product_image }}"
   data-size="{{ $attribute->product_size }}"
   data-price="{{ $attribute->product_price }}"
   data-qty="{{ $attribute->product_quantity }}"
   data-total="{{ $attribute->total_price }}"
   data-bs-toggle="modal" data-bs-target="#viewDetailsModal"
   data-toggle="tooltip" data-placement="top" title="View Details">
   <i class="fa fa-eye"></i>
</a></span></td>


                                                        </tr>
											<tr>
														<td></td>
                                                            <td>#093877</td>
                                                           
															<td>25-Jun-2022 10.30 AM</td>
															<td>10</td>
                                                            <td>00125</td>
                                                            
                                                            
												<td>	<div class="d-flex">
                                                                    <img src="../assets/images/products/blouse.jpg" alt="" class="img-fluid img-30 me-2 blur-up lazyloaded">

                                                                </div></td>
															 <td style="width:100%;">
                                                                Readymade Blouse Velvet Material
                                                            </td>
															<td>RED-L</td>
															<td>6</td>
                                                            <td><span class="font-primary">COD</span></td>
															
															<td><p class="text-center" style="border:1px solid #f90000;color:#f90000;border-radius:5px;">Cancel</p></td>
															
                                                            <td><span> <a href="#" class="badge badge-secondary px-2" data-bs-toggle="modal" data-original-title="test" data-bs-target="#exampleModal" data-original-title="Edit"><i class="fa fa-pencil"></i> </a>
                                                                    <a href="#" class="btn btn-info btn-sm view-product-details text-white" 
   data-id="{{ $attribute->product_id }}"
   data-name="{{ $attribute->product_name }}"
   data-image="{{ asset('assets/images/products/detail') . '/' . $attribute->product_image }}"
   data-size="{{ $attribute->product_size }}"
   data-price="{{ $attribute->product_price }}"
   data-qty="{{ $attribute->product_quantity }}"
   data-total="{{ $attribute->total_price }}"
   data-bs-toggle="modal" data-bs-target="#viewDetailsModal"
   data-toggle="tooltip" data-placement="top" title="View Details">
   <i class="fa fa-eye"></i>
</a></span></td>


                                                        </tr>
                                                    

                                                    </tbody>
                                                </table>
												<!-- The Modal -->
                                            <div class="modal" id="can">
                                            <div class="modal-dialog  modal-dialog-centered">
                                                <div class="modal-content">

                                                <!-- Modal Header -->
                                                <div class="modal-header">
                                                    <h4 class="modal-title">Status</h4>
                                                    <button type="button" class="btn-close text-danger" data-bs-dismiss="modal"></button>
                                                </div>

                                                <!-- Modal body -->
                                                <div class="modal-body">
                                                <div class="container-fluid">
                                                <div class="row">
                                                <form action="#">
                                                <div class="col-md-3">Change Status	</div>
                                                <div class="col-md-6">
                                                    <select class="form-select form-select-lg" name="status" required="">
                                                                    <option selected disabled>--Select--</option>
                                                                    <option value="Accept">Accept</option>
                                                                    <option value="Accept">Dispatch</option>
                                                                    <option value="Delivered">Delivered</option>
                                                                    <option value="Return">Return</option>
                                                                    <option value="Cancel">Cancel</option>
                                                                                                    
                                                                    </select>
                                                                    </div>
                                                        </form>
                                                </div>
                                                </div>
                                                </div>

                                                <!-- Modal footer -->
                                                <div class="modal-footer">
                                                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" >SUBMIT</button>
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                </div>

                                                </div>
                                            </div>
                                            </div>
                                            </div>
                                        </div>
								
							        </div>
							
                                </form> --}}
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->

</div>






<script>
     $(document).ready(function() {
      function setStatusValue(selectId, statusValue) {
        var $select = $('#' + selectId);
        if ($select.find('option[value="' + statusValue + '"]').length) {
            $select.val(statusValue);
        } else {
            $select.prop('selectedIndex', 0);
        }
      }
        
      $(".btnnew").click(function(e) {
        e.preventDefault();
       
        var btnnew = $(this).val();
        var currentStatus = ($(this).data('status') || '').toString();
        
     // alert(btnaccess);
     setStatusValue('o_status', currentStatus || 'Pending');
     var newmodal = $('#New').modal('show');
     $('#New .btn-primary').off('click').on('click', function(e) {
     var sts = $('#o_status').val();   
    // alert(sts);

    
        $.ajax({

        url: "{{ url('admin/orderstatusupdate') }}/"+btnnew, 
        type: "POST",
        data: {
            "_token": "{{ csrf_token() }}",
            "sts": sts

        },

        dataType: "json",
        success: function (data) {
            alert(data);
            $('#New').modal('hide');
            location.reload();
            
        },
        error: function (data) {
            console.log('Error:', data);
        }
        });


      });
     });
     
     
     
     
     
     /*Accept*/

 $(".btnaccess").click(function(e) {
        e.preventDefault();
       
        var btnaccess = $(this).val();
        var currentStatus = ($(this).data('status') || '').toString();
        
     // alert(btnaccess);
     setStatusValue('a_status', currentStatus || 'Accept');
     var newmodal = $('#accept').modal('show');
     $('#accept .btn-primary').off('click').on('click', function(e) {
     var sts = $('#a_status').val();   
    // alert(sts);

    
        $.ajax({

        url: "{{ url('admin/orderstatusupdate') }}/"+btnaccess, 
        type: "POST",
        data: {
            "_token": "{{ csrf_token() }}",
            "sts": sts

        },

        dataType: "json",
        success: function (data) {
           // alert(data);
            $('#accept').modal('hide');
            location.reload();
        },
        error: function (data) {
            console.log('Error:', data);
        }
        });


      });
     });

     //Dispatch
     $(".btndispatch").click(function(e) {
        e.preventDefault();
        
        var btndispatch = $(this).val();
        var currentStatus = ($(this).data('status') || '').toString();
        
     // alert(btnaccess);
      setStatusValue('d_status', currentStatus || 'Dispatch');
      $('#Dispatch').modal('show');
     $('#Dispatch .btn-primary').off('click').on('click', function(e) {
     var sts = $('#d_status').val();   
    // alert(sts);

    
        $.ajax({

        url: "{{ url('admin/orderstatusupdate') }}/"+btndispatch, 
        type: "POST",
        data: {
            "_token": "{{ csrf_token() }}",
            "sts": sts

        },

        dataType: "json",
        success: function (data) {
           // alert(data);
            $('#Dispatch').modal('hide');
            location.reload();
        },
        error: function (data) {
            console.log('Error:', data);
        }
        });


      });
     });

    //diuspatchend
    /*delivered start*/
    $(".btndelivered").click(function(e) {
        e.preventDefault();
        
        var btndelivered = $(this).val();
        var currentStatus = ($(this).data('status') || '').toString();
        
     // alert(btnaccess);
     setStatusValue('deli_status', currentStatus || 'Delivered');
     $('#delivere').modal('show');
     $('#delivere .btn-primary').off('click').on('click', function(e) {
     var sts = $('#deli_status').val();   
    // alert(sts);

    
        $.ajax({

        url: "{{ url('admin/orderstatusupdate') }}/"+btndelivered, 
        type: "POST",
        data: {
            "_token": "{{ csrf_token() }}",
            "sts": sts

        },

        dataType: "json",
        success: function (data) {
           // alert(data);
            $('#delivere').modal('hide');
            location.reload();
        },
        error: function (data) {
            console.log('Error:', data);
        }
        });


      });
     });

    /*delivered end*/
    /*return start*/
    $(".btnreturn").click(function(e) {
        e.preventDefault();
        
        var btnreturn = $(this).val();
        var currentStatus = ($(this).data('status') || '').toString();
        
     // alert(btnaccess);
     setStatusValue('return_status', currentStatus || 'Return');
     $('#return').modal('show');
     $('#return .btn-primary').off('click').on('click', function(e) {
     var sts = $('#return_status').val();   
    // alert(sts);

    
        $.ajax({

        url: "{{ url('admin/orderstatusupdate') }}/"+btnreturn, 
        type: "POST",
        data: {
            "_token": "{{ csrf_token() }}",
            "sts": sts

        },

        dataType: "json",
        success: function (data) {
           // alert(data);
            $('#return').modal('hide');
            location.reload();
        },
        error: function (data) {
            console.log('Error:', data);
        }
        });


      });
     });

    /*return end*/


     /*cancel start*/
    $(".btncancel").click(function(e) {
        e.preventDefault();
        
        var btncancel = $(this).val();
        var currentStatus = ($(this).data('status') || '').toString();
        
     // alert(btnaccess);
     setStatusValue('can_status', currentStatus || 'Cancel');
     $('#can').modal('show');
     $('#can .btn-primary').off('click').on('click', function(e) {
     var sts = $('#can_status').val();   
    // alert(sts);

    
        $.ajax({

        url: "{{ url('admin/orderstatusupdate') }}/"+btncancel, 
        type: "POST",
        data: {
            "_token": "{{ csrf_token() }}",
            "sts": sts

        },

        dataType: "json",
        success: function (data) {
           // alert(data);
            $('#can').modal('hide');
            location.reload();
        },
        error: function (data) {
            console.log('Error:', data);
        }
        });


      });
     });

    /*cancel end*/
    });
</script>

<script>
     var chk = document.querySelectorAll("input[type=checkbox]");
console.log(chk);

    function checkall(checkbox)
    {
        if(checkbox.checked==true)
            {
                chk.forEach(function(checkbox){
                    checkbox.checked == true;
                });
            }
            else{

                chk.forEach(function(checkbox){
                    checkbox.checked == false;
                });
            }

    }
        //   alert(chk);

//     function testChecked() {
//   let arr = $("#testdiv").data("town").split(",");
  
//   for (let i = 0; i < arr.length; i++) {
//     if (!$("input[value=" + arr[i] + "]").is(":checked")) return false;
//   }
  
//   return true;
// }

// console.log(testChecked());
</script>



<script type="text/javascript">
    $(document).ready(function () {
        // Automatically switch to the tab specified in the URL hash
        var hash = window.location.hash;
        if (hash) {
            $('.nav-tabs a[href="' + hash + '"]').tab('show');
        }

        $(document).on('click', '#master', function(e) {
          if($(this).is(':checked',true))  
          {
              $(".sub_chk").prop('checked', true);  
          } else {  
              $(".sub_chk").prop('checked',false);  
          }  
        });
 
        $('.accept').on('click', function(e) {
            var allVals = [];  
            $(".sub_chk:checked").each(function() {  
                allVals.push($(this).attr('data-id'));
            });  
            if(allVals.length <=0)  
            {  
                Swal.fire('Warning', 'Please select at least one row.', 'warning');
            }  else {  
                var currentDate = new Date();
                var year = currentDate.getFullYear();
                var month = currentDate.getMonth() + 1; // Months are zero-based, so we add 1
                var day = currentDate.getDate();
                var formattedDate = year + '-' + (month < 10 ? '0' + month : month) + '-' + (day < 10 ? '0' + day : day);
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You are about to update the status of selected rows!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, update it!'
                }).then((result) => {
                    if(result.isConfirmed){  
                        var join_selected_values = allVals.join(","); 
                        $.ajax({
                            url: "{{route('orderbulkstatusupdate')}}", 
                            type: "POST",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "ids": join_selected_values,
                                 "sts":"Accept","formattedDate":formattedDate
                            },
                            dataType: "json",
                            success: function (data) {
                                 window.location.hash = 'general';
                                 location.reload();
                            },
                            error: function (data) {
                                console.log('Error:', data);
                            }
                        });
                    }  
                });
            }  
        });

        /*cancel the bulk orders*/


        $('.cancelbulk').on('click', function(e) {
            var allVals = [];  
            $(".sub_chk:checked").each(function() {  
                allVals.push($(this).attr('data-id'));
            });  
            if(allVals.length <=0)  
            {  
                Swal.fire('Warning', 'Please select at least one row.', 'warning');
            }  else {  
                var currentDate = new Date();
                var year = currentDate.getFullYear();
                var month = currentDate.getMonth() + 1; // Months are zero-based, so we add 1
                var day = currentDate.getDate();
                var formattedDate = year + '-' + (month < 10 ? '0' + month : month) + '-' + (day < 10 ? '0' + day : day);
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You are about to cancel the selected orders!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, cancel it!'
                }).then((result) => {
                    if(result.isConfirmed){  
                        var join_selected_values = allVals.join(","); 
                        $.ajax({
                            url: "{{route('orderbulkstatusupdate')}}", 
                            type: "POST",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "ids": join_selected_values,
                                 "sts":"Cancel","formattedDate":formattedDate
                            },
                            dataType: "json",
                            success: function (data) {
                                 window.location.hash = 'cancel';
                                 location.reload();
                            },
                            error: function (data) {
                                console.log('Error:', data);
                            }
                        });
                    }  
                });
            }  
        });
        /*end*/
       
    });
</script>



<script type="text/javascript">
$(document).ready(function () {
        $(document).on('click', '#dismaster', function(e) {
   // alert('test');
          if($(this).is(':checked',true))  
          {
              $(".sub_check").prop('checked', true);  
          } else {  
              $(".sub_check").prop('checked',false);  
          }  
        });



        $('.dispatch').on('click', function(e) {
            var allVals = [];  
            $(".sub_check:checked").each(function() {  
                allVals.push($(this).attr('data-id'));
            });  
            if(allVals.length <=0)  
            {  
                Swal.fire('Warning', 'Please select at least one row.', 'warning');
            }  else {  
                var currentDate = new Date();
                var year = currentDate.getFullYear();
                var month = currentDate.getMonth() + 1; // Months are zero-based, so we add 1
                var day = currentDate.getDate();
                var formattedDate = year + '-' + (month < 10 ? '0' + month : month) + '-' + (day < 10 ? '0' + day : day);
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You are about to dispatch the selected orders!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, dispatch it!'
                }).then((result) => {
                    if(result.isConfirmed){  
                        var join_selected_values = allVals.join(","); 
                        $.ajax({
                            url: "{{route('orderbulkstatusupdate')}}", 
                            type: "POST",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "ids": join_selected_values,
                                 "sts":"Dispatch","formattedDate":formattedDate
                            },
                            dataType: "json",
                            success: function (data) {
                                 window.location.hash = 'dispatch';
                                 location.reload();
                            },
                            error: function (data) {
                                console.log('Error:', data);
                            }
                        });
                    }  
                });
            }  
        });

        //  /*cancel the bulk orders*/


        //  $('.cancelbulkdispatch').on('click', function(e) {
        //     var allVals = [];  
        //     alert(allVals)
        //     $(".sub_chk:checked").each(function() {  
        //         allVals.push($(this).attr('data-id'));
        //     });  
        //     if(allVals.length <=0)  
        //     {  
        //         alert("Please select rowwwwwwwwwww.");  
        //     }  else {  

        //        // alert("Accept.");  
        //         var check = confirm("Are you sure you want to update this row?");  
        //         if(check == true){  
        //             var join_selected_values = allVals.join(","); 

        //             $.ajax({

        //                 url: "{{route('orderbulkstatusupdate')}}", 
        //                 type: "POST",
        //                 data: {
        //                     "_token": "{{ csrf_token() }}",
        //                     "ids": join_selected_values,
        //                      "sts":"Cancel"

        //                 },

        //                 dataType: "json",
        //                 success: function (data) {
        //                 // alert(data);
                          
        //                      location.reload();
        //                 },
        //                 error: function (data) {
        //                     console.log('Error:', data);
        //                 }
        //                 });


                   
        //         }  
        //     }  
        // });
        /*end*/
    });
</script>



<script type="text/javascript">
$(document).ready(function () {
        $(document).on('click', '#delmaster', function(e) {
   // alert('test');
          if($(this).is(':checked',true))  
          {
              $(".sub_check").prop('checked', true);  
          } else {  
              $(".sub_check").prop('checked',false);  
          }  
        });



        $('.delivered').on('click', function(e) {
            var allVals = [];  
            $(".sub_check:checked").each(function() {  
                allVals.push($(this).attr('data-id'));
            });  
            if(allVals.length <=0)  
            {  
                Swal.fire('Warning', 'Please select at least one row.', 'warning');
            }  else {  
                var currentDate = new Date();
                var year = currentDate.getFullYear();
                var month = currentDate.getMonth() + 1; // Months are zero-based, so we add 1
                var day = currentDate.getDate();
                var formattedDate = year + '-' + (month < 10 ? '0' + month : month) + '-' + (day < 10 ? '0' + day : day);
                
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You are about to mark the selected orders as delivered!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, mark delivered!'
                }).then((result) => {
                    if(result.isConfirmed){  
                        var join_selected_values = allVals.join(","); 
                        $.ajax({
                            url: "{{route('orderbulkstatusupdate')}}", 
                            type: "POST",
                            data: {
                                "_token": "{{ csrf_token() }}",
                                "ids": join_selected_values,
                                 "sts":"Delivered","formattedDate":formattedDate
                            },
                            dataType: "json",
                            success: function (data) {
                                 window.location.hash = 'delivery';
                                 location.reload();
                            },
                            error: function (data) {
                                console.log('Error:', data);
                            }
                        });
                    }  
                });
            }  
        });
    });
</script>

<!-- SweetAlert2 CDN -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<!-- View Details Modal -->
<div class="modal fade" id="viewDetailsModal" tabindex="-1" role="dialog" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Product Details</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center mb-3">
                    <img id="modal-product-image" src="" alt="Product Image" style="max-height: 100px; border-radius: 8px; box-shadow: 0 4px 12px rgba(0,0,0,0.1);">
                </div>
                <table class="table table-bordered table-striped mt-3">
                    <tbody>
                        <tr>
                            <th width="40%">Product ID</th>
                            <td id="modal-product-id" class="fw-bold"></td>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <td id="modal-product-name"></td>
                        </tr>
                        <tr>
                            <th>Size / Color</th>
                            <td id="modal-product-size"></td>
                        </tr>
                        <tr>
                            <th>Price</th>
                            <td id="modal-product-price"></td>
                        </tr>
                        <tr>
                            <th>Quantity</th>
                            <td id="modal-product-qty"></td>
                        </tr>
                        <tr>
                            <th>Total Price</th>
                            <td id="modal-product-total" class="text-success fw-bold"></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        $(document).on('click', '.view-product-details', function() {
            $('#modal-product-id').text($(this).data('id'));
            $('#modal-product-name').text($(this).data('name'));
            $('#modal-product-size').text($(this).data('size') ? $(this).data('size') : 'N/A');
            $('#modal-product-price').text('₹' + $(this).data('price'));
            $('#modal-product-qty').text($(this).data('qty'));
            $('#modal-product-total').text('₹' + $(this).data('total'));
            $('#modal-product-image').attr('src', $(this).data('image'));
        });
    });
</script>
@endsection
