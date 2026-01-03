<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title>Wolmart eCommmerce Marketplace HTML Template</title>

    <meta name="keywords" content="Marketplace ecommerce responsive HTML5 Template" />
    <meta name="description" content="Wolmart is powerful marketplace &amp; ecommerce responsive Html5 Template.">
    <meta name="author" content="D-THEMES">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('website_assets/images/icons/favicon.png')}}">

    <!-- WebFont.js -->
    <script>
        WebFontConfig = {
            google: { families: ['Poppins:400,500,600,700'] }
        };
        ( function ( d ) {
            var wf = d.createElement( 'script' ), s = d.scripts[0];
            wf.src = "{{ asset('website_assets/js/webfont.js')}}";
            wf.async = true;
            s.parentNode.insertBefore( wf, s );
        } )( document );
    </script>

    <link rel="preload" href="{{ asset('website_assets/vendor/fontawesome-free/webfonts/fa-regular-400.woff2')}}" as="font" type="font/woff2"
        crossorigin="anonymous">
    <link rel="preload" href="{{ asset('website_assets/vendor/fontawesome-free/webfonts/fa-solid-900.woff2')}}" as="font" type="font/woff2"
        crossorigin="anonymous">
    <link rel="preload" href="{{ asset('website_assets/vendor/fontawesome-free/webfonts/fa-brands-400.woff2')}}" as="font" type="font/woff2"
            crossorigin="anonymous">
    <link rel="preload" href="{{ asset('website_assets/fonts/wolmart.woff?png09e')}}" as="font" type="font/woff" crossorigin="anonymous">

    <!-- Vendor CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('website_assets/vendor/fontawesome-free/css/all.min.css')}}">

    <!-- Plugin CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('website_assets/vendor/magnific-popup/magnific-popup.min.css')}}">

    <!-- Default CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('website_assets/css/style.min.css')}}">
	<style>
	.radio-container input[type="radio"] {
    transform: scale(1.3); /* Increase the scale */
}
	</style>
	
</head>

<body>
    <div class="page-wrapper">
        <h1 class="d-none">Wolmart - Responsive Marketplace HTML Template</h1>
        <!-- Start of Header -->
         @include('front_end.common.header')
        <!-- End of Header -->

        <!-- Start of Main -->
        <main class="main checkout">
            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb shop-breadcrumb bb-no">
                        <li class="passed"><a href="#">Shopping Cart</a></li>
                        <li class="active"><a href="#">Checkout</a></li>
                        <li><a href="#">Order Complete</a></li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->


            <!-- Start of PageContent -->
            <div class="page-content">
                <div class="container"> 
					
                    <form action="{{url('/placeorder')}}" name="frm-login" method="post" autocomplete="Off" class="form checkout-form" onsubmit="return confirm('Do you  want to Confirm This Order?');">
                    {{ csrf_field() }} 
                    
                        <div class="row mb-9">
                            <div class="col-lg-7 pr-lg-4 mb-4">
							<h3 class="title-box"><span class="number1">1</span>Customer</h3>
				  @if(session()->has('customer_id'))
					 <div class="box-content">
						<p class="txt-desc">Thank You for login, you can and access your Accounts, orders, rewards and ect...</p>
						<p class="msg">Login with different an account? <a href="{{ url('/CheckoutLogout') }}" class="link-forward">Sign-out now</a></p>
					</div>
					@else
						
                    <div class="#">
                        Returning customer? <a href="#"
                            class=" btn-quickview font-weight-bold text-uppercase text-dark">Login</a>
                    </div>
					 @endif
                                <hr>
								<h3 class="title billing-title text-uppercase ls-10 pt-1 pb-3 mb-0">
                                <span class="number1" >2</span>Shipping
                                </h3> 
								@if(session()->has('customer_id'))
                                            @php 
                                            
                                            $customer = App\Models\Ecom_Customer_info::where('customer_id', session()->get('customer_id'))->first();
                                            @endphp
                                            <div class="box-content">
                                                <div id="shipping-address">
                                                    <h4 class="title title-simple text-left text-uppercase">Shipping Informations</h4>

                                                    <div class="row">
                                                        <div class="col-xs-6">
                                                            <label>First Name *</label>
                                                            <input type="text" class="form-control" name="customer_firstname" onkeyup="this.value = this.value.toUpperCase(); " required="" value="{{@$customer->customer_firstname}}" />
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <label>Last Name *</label>
                                                            <input type="text" class="form-control" name="customer_lastname" onkeyup="this.value = this.value.toUpperCase(); " required="" value="{{@$customer->customer_lastname}}" />
                                                        </div>
                                                    </div>
                                                    <label>Company Name (Optional)</label>
                                                    <input type="text" class="form-control" name="customer_company_name" onkeyup="this.value = this.value.toUpperCase(); " value="{{@$customer->customer_company_name}}" />

                                                    <label>Street Address *</label>
                                                    <input type="text" class="form-control" name="customer_address" required="" placeholder="House number and street name" value="{{@$customer->customer_address}}" />
                                                    <input type="text" class="form-control" name="customer_address1" required="" placeholder="Area" value="{{@$customer->customer_address1}}" />

                                                    <div class="row">
                                                        <div class="col-xs-6">
                                                            <label>ZIP / POSTAL CODE*</label>
                                                            <input type="text" class="form-control" id="pincode" name="customer_pincode" required="" value="{{@$customer->customer_pincode}}" />
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <label>Phone *</label>
                                                            <input type="text" class="form-control" name="customer_mobileno" id="order_mobile" required="" onblur="verify_mobile(this.value)" value="{{@$customer->customer_mobileno}}" />
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-xs-6">
                                                            <label>Town / City *</label>
                                                            <input type="text" class="form-control" id="city" name="customer_city" required=""  value="{{@$customer->customer_city}}" />
                                                        </div>
                                                        <div class="col-xs-6">
                                                            <label>State *</label>
                                                            <input type="text" class="form-control" id="state" name="customer_state" required="" value="{{@$customer->customer_state}}"  />
                                                        </div>
                                                    </div>
                                                    <label>Email Address *</label>
                                                    <input type="email" class="form-control" name="customer_email" required="" value="{{@$customer->customer_email}}" />

                                                    <br>
                                                    <h5 style="font-size: 16px;" class="title title-simple text-uppercase text-left">Additional Information</h5>
                                                    <label>Order Notes (Optional)</label>
                                                    <textarea class="form-control pb-2 pt-2 mb-0" cols="30" rows="3" name="order_notes" placeholder="Notes about your order, e.g. special notes for delivery"></textarea>
                                                </div>
                                            </div>
											@else
												<div>
											<p> Shipping And Bill address information here. please login to continue shoping.</p>
												</div>
											@endif
                                
                            </div>
                            <div class="col-lg-5 mb-4 sticky-sidebar-wrapper">
                                <div class="order-summary-wrapper sticky-sidebar">
                                    <h3 class="title text-uppercase ls-10">Your Order</h3>
                                    <div class="order-summary">
                                        <table class="order-table">
                                            <thead>
                                                <tr>
                                                    <th colspan="2">
                                                        <b>Product</b>
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
											@php $subtotal = 0;$cart=0;$totalmrp=0; @endphp
                                    @if(session('cart'))
                                    @foreach(session('cart') as $id => $details)
                                    @php $totalmrp += $details['mrp'] * $details['qty'];
									$subtotal += $details['price'] * $details['qty'];
									$cart++;
                                    @endphp
                                                <tr class="bb-no">
                                                    <td class="product-name">{{ $details['name'] }}  - <span
                                                            class="product-quantity">{{ $details['qty'] }} <i
                                                            class="fas fa-times"></i> {{ $details['mrp'] }}</span> </td>
                                                    <td class="product-total">Rs. {{ $details['qty'] * $details['mrp'] }}</td>
                                                </tr>
                                                
												  @endforeach
											@else
											<tr class="bb-no">
                                                    <td class="product-name">Your Cart is Empty <i class="fas fa-times"></i>
                                                        <span class="product-quantity">0</span></td>
                                                    <td class="product-total">Rs.0</td>
                                                </tr>
												<tr>

												@endif
												<tr class="bb-no">
												 <td colspan="2"> <hr> </td>
												 </tr>
												
                                                <tr class="cart-subtotal bb-no">
                                                     <td class="product-name">
                                                        Total MRP
                                                    </td>
                                                    <td>
                                                        <b>Rs. {{$totalmrp}}</b>
                                                    </td>
                                                </tr>
												<tr class="cart-subtotal bb-no">
                                                     <td class="product-name">
                                                        MRP Discount
                                                    </td>
                                                    <td  >
                                                        <b style="color:green;">- Rs. {{$totalmrp - $subtotal}}</b>
                                                    </td>
                                                </tr>
												
												@if($subtotal>=500)
												@php $shipingcost=0; @endphp
												<tr class="cart-subtotal bb-no">
                                                    <td class="product-name">
                                                        Shipping Cost
														<br>
														<small style="color:green;"> Free shipping for you </small>
                                                    </td>
                                                    <td>
													<del>Rs. 40</del>
                                                        <b style="color:green;"> Free</b>
                                                    </td>
                                                </tr>
												@else
													@php $shipingcost=40; @endphp
													<tr class="cart-subtotal bb-no">
													 <td class="product-name">
                                                        Shipping Cost
                                                    </td>
                                                    <td>
                                                        <b>+ Rs. 40</b>
                                                    </td>
                                                </tr>
												@endif
												<tr class="cart-subtotal bb-no">
                                                     <td class="product-name">
                                                        Coupon Discount
                                                    </td>
                                                    <td  >
                                                        <b style="color:#336699;"> 0 </b>
                                                    
													</td>
                                                </tr>
												<tr class="cart-subtotal bb-no">
                                                     <td class="product-name" colspan="2">                                                    
														<div class="coupon-toggle">
														 <a href="#"
															class="show-coupon btn btn-sm text-dark">Apply Coupon</a>
													</div>
													<div class="coupon-content mb-4">
															<p>If you have a coupon code, please apply it below.</p>
															<div class="input-wrapper-inline">
																<input type="text" name="coupon_code" class="form-control form-control-md mr-1 mb-2" placeholder="Coupon code" id="coupon_code">
																<button type="button" class="btn button btn-rounded btn-coupon mb-2" name="apply_coupon" value="Apply coupon">Apply</button>
															</div>
														</div>
													</td>
                                                </tr>
                                            </tbody>
                                            <tfoot>
                                                
                                                <tr class="order-total">
                                                    <th>
                                                        <b>Total Amount</b>
                                                    </th>
                                                    <td>
                                                        <b>Rs.{{$subtotal + $shipingcost}}</b>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
									<input type="hidden" name="total_mrpamount" value="{{ $totalmrp }}">
									<input type="hidden" name="total_amount" value="{{ $subtotal }}">
                                    <input type="hidden" name="discount_amount" value="0">
                                    <input type="hidden" name="gst_charge" value="0">

                                    <input type="hidden" name="shipping_charge" value="{{ $shipingcost }}">
                                    <input type="hidden" name="grand_total" value="{{ $subtotal + $shipingcost }}">

                                        <div class="payment-methods radio-container" id="payment_method">
                                            <h4 class="title font-weight-bold ls-25 pb-0 mb-1">Payment Methods</h4>
											<br>
                                            <h4 class="title"> <input type="radio" name="payment_type" Value="Cash On Delivery" checked> &nbsp;&nbsp;Cash On Delivery </h4>
										
											<h4 class="title"> <input type="radio" name="payment_type" value="Online Transaction" > &nbsp;&nbsp;Online Transaction </h4><br>
                                        </div>
										@if($cart!=0 && session()->has('customer_id'))
                                        <div class="form-group place-order pt-6">
                                            <button type="submit" class="btn btn-dark btn-block btn-rounded">Place Order</button>
                                        </div>
										@endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- End of PageContent -->
        </main>
        <!-- End of Main -->

        <!-- Start of Footer -->
         @include('front_end.common.footer')

    <!-- Plugin JS File -->
    <script src="{{ asset('website_assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('website_assets/vendor/sticky/sticky.js')}}"></script>
    <script src="{{ asset('website_assets/vendor/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{ asset('website_assets/js/main.min.js')}}"></script>
	
</body>

</html>