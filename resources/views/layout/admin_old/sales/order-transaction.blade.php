@extends('layout.auth.master')
@section('contents')

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
            <div class="container-fluid fcolor">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <h3>Order Transactions
                                   
                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="{{url('dashboard')}}"><i data-feather="home"></i></a></li>
                                <li class="breadcrumb-item active">Transactions</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

            <!-- Container-fluid starts-->
            <div class="container-fluid fcolor">
                <div class="row">
                    <div class="col-sm-12">
                         <div class="card tab2-card">
                           
                            <div class="card-body">
                                <form class="needs-validation" novalidate="">
                                   
                                    <div class="row">
                                  
                                      <div class="datatable-dashv1-list custom-datatable-overright">

                            
                                    <table class="table fcolor" id="table"  data-click-to-select="true"  data-sort-name="id" data-show-columns="true" data-sort-order="desc" data-mobile-responsive="true" data-toggle="table" data-sort="true" data-pagination="true" data-search="true"  data-show-refresh="true" data-key-events="true"  data-resizable="true" data-cookie="true"
                                         data-show-export="true" data-click-to-select="true" data-toolbar="#toolbar">
                                        
                                    <thead>
                                    <tr>
                                       <th data-field="id" data-sortable="true">ORDER ID</th> 
                                        <th data-field="date" data-sortable="true">ORDER DATE</th>
										<th data-field="qty" data-sortable="true">ORDER QTY</th>
                                        <th data-field="sellername" data-sortable="true">SELLER NAME</th>
										<th data-field="deliver" data-sortable="true">DELIVERED ON</th>
                                        <th data-field="amount" data-sortable="true">ORDER AMT</th>
                                       
									   <th data-field="pmode" data-sortable="true">PAYMENT MODE</th>
                                        <th data-field="payment" data-sortable="true">STATUS</th>
                                        <th data-field="servicecharge" data-sortable="true">TRANSFERRED</th>
                                        <th data-field="remainingamount" data-sortable="true">INVOICE NO</th>
                                        <th data-field="paymentstaus" data-sortable="true">TRANSFER AMT</th>
                                       
                                    </tr>
                                    </thead>
                                    <tbody class="">
                                        
                                         <?php
                                          
                                                $orderspro = DB::table('ecom_order_product')->join('ecom_order_info', 'ecom_order_product.order_id', '=', 'ecom_order_info.order_id')
                                                ->get();
                                                  

                                        ?>
                                   
                                   @foreach ($orderspro as $attribute)

                                        <tr>

                                       <td>{{ $attribute->order_id }}</td>
                                       <td>{{ $attribute->order_date }}</td>
									   <td>{{ $attribute->product_quantity }}</td>
                                       <td> <span class="text-primary">Vendor </span> <br> <span>{{$attribute->customer_id}} </span> </td>
                                       <td>{{$attribute->delivery_date}}</td>
                                      <td>{{$attribute->grand_total}}</td>
                                      
                                       <td>{{$attribute->payment_status}}</td>
									   <td><span style="color: #fff;" class="badge badge-success px-2">Transferd</span></td>
									   <td>03/June/2022</td>
                                       <td>3</td>
                                       <td>1000</td>
                                       
										
                                     </tr>
                                                                    
                                    @endforeach
                                
                                  
                                    </tbody>
                                </table> </div>
                              
                                    </div>
                                </form>
                            </div>
						 
						
								
								
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

        </div>

@endsection