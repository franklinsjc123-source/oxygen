@include('website.front-end.newhead')
 
{{-- @include('website.front-end.newheader') --}}
   <!-- header end -->


   @include('website.partials.js.frontendjs')
   @include('paritials.js.userwebsite.cart_js')
   @include('website.partials.css.frontendcss');
  

   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style>
        #loading-container {
       display: none;
       position: fixed;
       top: 0;
       left: 0;
       width: 100%;
       height: 100%;
       background-color: rgba(255, 255, 255, 0.8);
       z-index: 9999;
   }
   
   .loader {
       border: 8px solid #f3f3f3;
       border-top: 8px solid #3498db;
       border-radius: 50%;
       width: 50px;
       height: 50px;
       animation: spin 2s linear infinite;
       position: absolute;
       top: 50%;
       left: 50%;
       transform: translate(-50%, -50%);
   }
   
   @keyframes spin {
       0% { transform: rotate(0deg); }
       100% { transform: rotate(360deg); }
   }


</style>

<body class="theme-color-29">
   <div id="loading-container">
       <div class="loader"></div>
   </div>

   <!-- loader start -->
   
   <!-- loader end -->

<!-- header start -->
   @include('paritials.website.header')
    
    <!-- tracking page start -->
    <section class="tracking-page section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-sm-12">
                    <h3>status for order no: {{$order_info->orders_id}}</h3>
                    <div class="wrapper">
                        <div class="arrow-steps clearfix">
                            <div class="step done {{($order_info->order_status=='Placed')?'current':'';}}"> <span> Order placed</span> </div>
                            <div class="step {{($order_info->order_status=='Accept')?'current':'';}}"> <span>Preparing to ship</span> </div>
                            <div class="step {{($order_info->order_status=='Dispatch')?'current':'';}}"><span> Shipped</span> </div>
                            <div class="step {{($order_info->order_status=='Delivered')?'current':'';}}"><span>Delivered</span> </div>
                            @if($order_info->order_status=='Return')
                            <div class="step current"><span>Returned</span> </div>
                            @endif
                            @if($order_info->order_status=='Cancel')
                            <div class="step current"><span>Canceled</span> </div>
                            @endif
                        </div>
                    </div>
                    <div class="row border-part">
                        <div class="col-xl-2 col-md-3 col-sm-4">
                            <div class="product-detail">
                                <img src="../assets/images/fashion/pro/1.jpg" class="img-fluid blur-up lazyload" alt="">
                            </div>
                        </div>
                        <div class="col-xl-7 col-lg-7 col-sm-8">
                            <div class="tracking-detail">
                                <ul>
                                   
                                    <li>
                                        <div class="left">
                                            <span>Customer number</span>
                                        </div>
                                        <div class="right">
                                            <span>{{$order_info->orders_id}}</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="left">
                                            <span>order date</span>
                                        </div>
                                        <div class="right">
                                            
                                            <span> {{ date('d M Y',strtotime($order_info->order_date)) }}</span>
                                        </div>
                                    </li>
                                    @if($order_info->delivery_date!=null)
                                    <li>
                                        <div class="left">
                                            <span>Ship Date</span>
                                        </div>
                                        <div class="right">
                                            <span>{{ date('d M Y',strtotime($order_info->delivery_date)) }}</span>
                                        </div>
                                    </li>
                                    @else
                                    <li>
                                        <div class="left">
                                            <span>Expected Date</span>
                                        </div>
                                        <div class="right">
                                            <span>{{ date('d M Y',strtotime($order_info->order_date. " +7 days")) }}</span>
                                        </div>
                                    </li>
                                    @endif
                                    <li>
                                        <div class="left">
                                            <span>Shipping Address</span>
                                        </div>
                                        <div class="right">
                                            <ul class="order-detail">
                                                <li>Name:{{$order_info->firstname}}{{$order_info->lastname}}</li>
                                                <li>Address: {{$order_info->address}}</li>
                                                <li>Town:{{$order_info->town}}</li>
                                                
                                                <li>State:{{$order_info->state}}</li>
                                                <li>Country:{{$order_info->country}}</li>
                                                <li>Contact No:{{$order_info->phone}}</li>
                                            </ul>
                                    
                                        </div>
                                    </li>
                                   <!-- <li>
                                        <div class="left">
                                            <span>carrier</span>
                                        </div>
                                        <div class="right">
                                            <span>FedEx</span>
                                        </div>
                                    </li>
                                    <li>
                                        <div class="left">
                                            <span>carrier tracking number</span>
                                        </div>
                                        <div class="right">
                                            <span>656974541515484</span>
                                        </div>
                                    </li>-->
                                </ul>
                            </div>
                        </div>
                       
                    </div>
                    
                    <!--<div class="order-table table-responsive-sm">
                        <table class="table mb-0 table-striped table-borderless">
                            <thead class="">
                                <tr>
                                    <th scope="col">Date</th>
                                    <th scope="col">Time</th>
                                    <th scope="col">Description</th>
                                    <th scope="col">Location</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>06 June 2022</td>
                                    <td>01.00 AM</td>
                                    <td>Shipped</td>
                                    <td>Chennai</td>
                                </tr>
                                <tr>
                                    <td>07 June 2022</td>
                                    <td>08.00 PM</td>
                                    <td>shipping info received</td>
                                    <td>Trichy</td>
                                </tr>
                                <tr>
                                    <td>08 June 2022</td>
                                    <td>010.00 AM</td>
                                    <td>Delivered</td>
                                    <td>Trichy</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>-->
                </div>
            </div>
        </div>
    </section>
    <!-- tracking page end -->


    <!-- footer start -->

    @include('website.front-end.newfooter')