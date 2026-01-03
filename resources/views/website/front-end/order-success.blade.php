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

    <!-- thank-you section start -->
    <section class="section-b-space light-layout">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="success-text">
                        <div class="checkmark">
                            <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972-.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z">
                                </path>
                            </svg>
                            <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972-.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z">
                                </path>
                            </svg>
                            <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972-.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z">
                                </path>
                            </svg>
                            <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972-.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z">
                                </path>
                            </svg>
                            <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972-.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z">
                                </path>
                            </svg>
                            <svg class="star" height="19" viewBox="0 0 19 19" width="19"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.296.747c.532-.972 1.393-.973 1.925 0l2.665 4.872 4.876 2.66c.974.532.975 1.393 0 1.926l-4.875 2.666-2.664 4.876c-.53.972-1.39.973-1.924 0l-2.664-4.876L.76 10.206c-.972-.532-.973-1.393 0-1.925l4.872-2.66L8.296.746z">
                                </path>
                            </svg>
                            <svg class="checkmark__check" height="36" viewBox="0 0 48 36" width="48"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M47.248 3.9L43.906.667a2.428 2.428 0 0 0-3.344 0l-23.63 23.09-9.554-9.338a2.432 2.432 0 0 0-3.345 0L.692 17.654a2.236 2.236 0 0 0 .002 3.233l14.567 14.175c.926.894 2.42.894 3.342.01L47.248 7.128c.922-.89.922-2.34 0-3.23">
                                </path>
                            </svg>
                            <svg class="checkmark__background" height="115" viewBox="0 0 120 115" width="120"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M107.332 72.938c-1.798 5.557 4.564 15.334 1.21 19.96-3.387 4.674-14.646 1.605-19.298 5.003-4.61 3.368-5.163 15.074-10.695 16.878-5.344 1.743-12.628-7.35-18.545-7.35-5.922 0-13.206 9.088-18.543 7.345-5.538-1.804-6.09-13.515-10.696-16.877-4.657-3.398-15.91-.334-19.297-5.002-3.356-4.627 3.006-14.404 1.208-19.962C10.93 67.576 0 63.442 0 57.5c0-5.943 10.93-10.076 12.668-15.438 1.798-5.557-4.564-15.334-1.21-19.96 3.387-4.674 14.646-1.605 19.298-5.003C35.366 13.73 35.92 2.025 41.45.22c5.344-1.743 12.628 7.35 18.545 7.35 5.922 0 13.206-9.088 18.543-7.345 5.538 1.804 6.09 13.515 10.696 16.877 4.657 3.398 15.91.334 19.297 5.002 3.356 4.627-3.006 14.404-1.208 19.962C109.07 47.424 120 51.562 120 57.5c0 5.943-10.93 10.076-12.668 15.438z">
                                </path>
                            </svg>
                        </div>
                        <h2>thank you</h2>
                        <p>Payment is successfully processsed and your order is on the way</p>
                        <p class="font-weight-bold">Transaction ID:{{$orders_id}}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section ends -->


    <!-- order-detail section start -->
    <section class="section-b-space">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="product-order">
                        


                        <?php
                        // if(session('cart')==null)
                        // {
                        //     echo'null';
                        // }
                        // else {
                        //     echo'not null';
                        // }
                        // exit;



                        ?>
                                    
                                    @foreach($orders_pro as $id => $details)
                                      
                                        <div class="row product-order-detail">
                                            <?php 
                                                $product_image = json_decode($details['product_image']);
                                                    if(!empty($product_image[0]))
                                                    {
                                                ?>
                                            <div class="col-3"><img src="{{ asset('assets/images/products/detail') . '/' . $product_image[0] }}" alt=""
                                                    class="img-fluid blur-up lazyload"></div>
                                                <?php
                                                }
                                              ?>

                                            <div class="col-2 order_detail">
                                                <div>
                                                    <h4>Product</h4>
                                                    <h5>{{ $details['product_name'] }}</h5>
                                                </div>
                                            </div>
                                            <div class="col-2 order_detail">
                                                <div>
                                                    <h4>Qty</h4>
                                                    <h5>{{ $details['product_quantity'] }}</h5>
                                                </div>
                                            </div>
                                            <div class="col-2 order_detail">
                                                <div>
                                                    <h4>Price</h4>
                                                    <h5>Rs {{ intval($details['product_price']) }}</h5>
                                                </div>
                                            </div>
                                            <div class="col-3 order_detail">
                                                <div>
                                                    <h4>Total</h4>
                                                    <h5>Rs {{ intval($details['product_quantity'] * $details['product_price']) }}</h5>
                                                </div>
                                            </div>
                                        </div>
                                        
                                    @endforeach
                        
                       
                        <div class="total-sec">
                            <ul>
                                @foreach($order_infos as $order_info)
                                <!--<li>Subtotal <span>Rs {{ $order_info->total }}</span></li>-->
                                @foreach($orders_pro as $id => $details1)
                                    <li>Subtotal <span>Rs {{ intval($details1['total_price']) }}</span></li>
                                    @endforeach
                                <li>Shipping <span>Rs {{ $order_info->shipping }}</span></li>
                                <li>Tax(GST) <span>Rs {{ $order_info->gst_charge }}</span></li>
                                <li>Discount <span>Rs {{ $order_info->discount }}</span></li>
                                  @endforeach
                            </ul>
                        </div>
                        <div class="final-total">
                           
                            
                            <h3>Total <span>Rs {{ $order_info->grandtotal }}</span></h3>
                        </div>
                    </div>
                </div>
                    @php
                    
                      
                     //session::forget('cart');
                   // session()->flush();
                     @endphp
                
                <div class="col-lg-6"><br>
                    <div class="order-success-sec pt-10">
                        <div class="row">
                            <div class="col-sm-6">
                                <h4>summery</h4>
                                <ul class="order-detail">
                                    <li>order ID: {{$orders_id}}</li>
                                    <li>Order Date: {{ date('d M Y',strtotime($order_info->order_date)) }}</li>
                                    <li>Order Total: Rs {{ $order_info->grandtotal }}
                                    
                                    </li>
                                </ul>
                            </div>
                            <div class="col-sm-6">
                                <h4>Shipping Address</h4>
                                <ul class="order-detail">
                                    <li>Name:{{$order_info->firstname}}{{$order_info->lastname}}</li>
                                    <li>Address: {{$order_info->address}}</li>
                                    <li>Town:{{$order_info->town}}</li>
                                    
                                    <li>State:{{$order_info->state}}</li>
                                    <li>Country:{{$order_info->country}}</li>
                                    <li>Contact No:{{$order_info->phone}}</li>
                                </ul>
                            </div>
                            <div class="col-sm-12 payment-mode">
                                <h4>payment method</h4>
                                <p>Pay on Delivery (Cash/Card). Cash on delivery (COD) available. Card/Net banking
                                    acceptance subject to device availability.</p>
                            </div>
                            <div class="col-md-12">
                                <div class="delivery-sec">
                                    <h3>Expected Date of Delivery: <span>{{ date('d M Y',strtotime($order_info->order_date. " +7 days")) }} </span></h3>
                                    <a href={{ route('order_tracking', $orders_id) }}>Track order</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section ends -->


    <!-- footer start -->
    
@include('website.front-end.newfooter')

