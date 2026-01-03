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
                    <h3>status for {{ count($orders)}} orders  </h3>
                    
                    {{-- @dd($orders_product); --}}
                    
                    @if(!empty(session('userId')))
                    @if(!empty($orders))
    
                     {{-- @foreach ($orders_product as $order) --}}
                     
                        @foreach ($orders as $ord)
                        <div class="wrapper">
                            <div class="arrow-steps clearfix">
                                <div class="step done {{($ord->order_status=='Placed')?'current':'';}}"> <span> Order placed</span> </div>
                                <div class="step {{($ord->order_status=='Accept')?'current':'';}}"> <span>Preparing to ship</span> </div>
                                <div class="step {{($ord->order_status=='Dispatch')?'current':'';}}"><span> Shipped</span> </div>
                                <div class="step {{($ord->order_status=='Delivered')?'current':'';}}"><span>Delivered</span> </div>
                                @if($ord->order_status=='Return')
                                <div class="step current"><span>Returned</span> </div>
                                @endif
                                @if($ord->order_status=='Cancel')
                                <div class="step current"><span>Canceled</span> </div>
                                @endif
                            </div>
                        </div>
                    <div class="row border-part">
                        <div class="col-xl-5 col-lg-5 col-sm-5">
                            <div class="product-detail">
                                
                                <div class="tracking-detail">
                                <ul>
                                   
                                    <li>
                                        <div class="left">
                                            <span>Product Details</span></br>
                                            <?php
                                 // dd($ord);
                                //  dd($orders_product->product_image);
                              
                              $orders_product =DB::table('ordersproducts')->where('order_id', $ord->orders_id)->get();

                               //   dd($orders_product->id);

                                if(!empty($orders_product[0]->product_image))
                                {
                                    $img = json_decode($orders_product[0]->product_image);
                                    // dd($img);
                                    foreach ($img as $key => $value) {
                                        
                                        if($key == 0)
                                        {
                                            ?>
                                            <img src="assets(assets/images/products/detail/{{$value}})" class="img-fluid blur-up lazyload" alt="" width="100px">
                                    <?php
                                        }
                                    }
                                }
                                ?>
                                        </div>
                                        <div class="right">
                                            <ul class="order-detail">
                                                <li>Product Name:{{$orders_product[0]->product_name}}</li>
                                                <li>Product Size:{{$orders_product[0]->product_size}}</li>
                                                <li>Product Quantity:{{$orders_product[0]->product_quantity}}</li>
                                                
                                                <li>Product Price:{{$orders_product[0]->product_price}}</li>
                                                <li>Total Price {{$orders_product[0]->total_price}}</li>
                                                
                                            </ul>
                                    
                                        </div>
                                    </li>

                                </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-5 col-lg-5 col-sm-5">
                            <div class="tracking-detail">
                                <ul>
                                   
                                    <li>
                                        <div class="left">
                                            <span>Order ID</span>
                                        </div>
                                        <div class="right">
                                            <span>{{$ord->orders_id}}</span> 
                                        </div>
                                    </li>
                                    <li>
                                        <div class="left">
                                            <span>order date</span>
                                        </div>
                                        <div class="right">
                                            
                                            <span>{{ date("Y-m-d", strtotime($ord->order_date)) }}</span>
                                        </div>
                                    </li>
                                    @if($ord->delivery_date!=null)
                                    <li>
                                        <div class="left">
                                            <span>Ship Date</span>
                                        </div>
                                        <div class="right">
                                            <span>{{ date('d M Y',strtotime($ord->delivery_date)) }}</span>
                                        </div>
                                    </li>
                                    @else
                                    <li>
                                        <div class="left">
                                            <span>Expected Date</span>
                                        </div>
                                        <div class="right">
                                            <span>{{ date('d M Y',strtotime($ord->order_date. " +7 days")) }}</span>
                                        </div>
                                    </li>
                                    @endif
                                    <li>
                                        <div class="left">
                                            <span>Shipping Address</span>
                                        </div>
                                        <div class="right">
                                            <ul class="order-detail">
                                                <li>Name:{{$ord->firstname}}{{$ord->lastname}}</li>
                                                <li>Address: {{$ord->address}}</li>
                                                <li>Town:{{$ord->town}}</li>
                                                
                                                <li>State:{{$ord->state}}</li>
                                                <li>Country:{{$ord->country}}</li>
                                                <li>Contact No:{{$ord->phone}}</li>
                                            </ul>
                                    
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-sm-2">
                             @if($ord->order_status=='Delivered')
                                <a href ="{{route('ordersreturn',$ord->id)}}" type="button" class="btn btn-warning" value="{{$ord->id}}" >Return</a>
                                      {{-- <input type="hidden" name="orderreturn" id="orderreturn" value="Return"> --}}
                             @elseif($ord->order_status=='Return')
                                     
      
                                @else

                               <a href ="{{route('orderscancel',$ord->id)}}"  type="button" class="btn btn-info" value="{{$ord->id}}">Cancel</a>
                                @endif
                            
                          
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
                                <tr>
                                    <td>
                                          <a href ="{{route('ordersreturn',$ord->id)}}" type="button" class="btn btn-warning" value="{{$ord->id}}" >Return</a>
                                          {{-- <input type="hidden" name="orderreturn" id="orderreturn" value="Return"> --}}
                                    </td>
                                   

                                    <td><a href ="{{route('orderscancel',$ord->id)}}"  type="button" class="btn btn-info" value="{{$ord->id}}">Cancel</a></td>
                                   
                                </tr>
                            </tbody>
                        </table>
                    </div>-->
                  @endforeach
                  
                      
                      @else
                      <div class="left">
                        <span>No Record!! </span>
                    </div>
                      @endif
                  @else
                  <div class="left">
                    <span>No Record!! </span>
                </div>
                  @endif
                </div>
            </div>
        </div>
    </section>
    <!-- tracking page end -->


    <!-- footer start -->

    @include('website.front-end.newfooter')