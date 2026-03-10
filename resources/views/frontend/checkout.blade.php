	 @extends('app_template')
	 @section('title','Checkout Page')
	 @section('content')
	 <div class="woo-page-header">
	     <div class="">
	         <ul class="breadcrumb">
	             <li class="">
	                 <a href="{{ url('shopping-cart') }}">Shopping Cart</a>
				 </li>
	             <li class="current">
	                 <i class="delimiter"></i>
	                 <a href="{{ url('checkoutPage') }}">Checkout</a>
	             </li>
	             
	         </ul>
	     </div>
	 </div>


	 	<main class="main checkout mt-3">
		

		<!-- Start of PageContent -->
		<div class="page-content">
			<div class="container">
                @if(!session()->has('customer_id'))
				<div style="cursor:pointer" >
					Returning customer? <a  onclick="showLoginPopup('{{ route('checkoutPage') }}')" 
						class="show-login font-weight-bold text-uppercase text-dark">Login</a>
				</div>
                @endif
			
				<div class="coupon-toggle mt-3">
					Have a coupon? <a href="#"
						class="show-coupon font-weight-bold text-uppercase text-dark">Enter your
						code</a>
				</div>
				<div class="coupon-content mb-4">
					<p>If you have a coupon code, please apply it below.</p>
					<div class="input-wrapper-inline">
						<input type="text" name="coupon_code" class="form-control form-control-md mr-1 mb-2" placeholder="Coupon code" id="coupon_code">
						<button type="submit" class="btn button btn-rounded btn-coupon mb-2" name="apply_coupon" value="Apply coupon">Apply Coupon</button>
					</div>
				</div>
				<form class="form checkout-form" action="{{ route('checkout_store') }}" method="post">
					@csrf
					<div class="row mb-9">
						<div class="col-lg-7 pr-lg-4 mb-4">
							<h3 class="title billing-title text-uppercase ls-10 pt-1 pb-3 mb-0">
								Billing Details
							</h3>
							<div class="row gutter-sm">
								<div class="col-xs-6">
									<div class="form-group">
										<label>First name *</label>
										<input type="text" class="form-control form-control-md" name="billing_first_name" value="{{ $customer->customer_firstname ?? '' }}"
											required>
									</div>
								</div>
								<div class="col-xs-6">
									<div class="form-group">
										<label>Last name *</label>
										<input type="text" class="form-control form-control-md" name="billing_last_name" value="{{ $customer->customer_lastname ?? '' }}"
											required>
									</div>
								</div>
							</div>
						
							<div class="form-group">
								<label>Country / Region *</label>
								<div class="select-box">
									<select name="billing_country" class="form-control form-control-md">
										<option value="default" selected="selected">United States
											(US)
										</option>
										<option value="uk">United Kingdom (UK)</option>
										<option value="us">United States</option>
										<option value="fr">France</option>
										<option value="aus">Australia</option>
										<option value="ind">India</option>
									</select>
								</div>
							</div>
							<div class="form-group">
								<label>Street address *</label>
								<input type="text" placeholder="House number and street name"
									class="form-control form-control-md mb-2" name="billing_address" value="{{ $customer->customer_address ?? '' }}" required>
								<input type="text" placeholder="Apartment, suite, unit, etc. (optional)"
									class="form-control form-control-md" name="street-address-2" value="{{ $customer->customer_address1 ?? '' }}" required>
							</div>
							<div class="row gutter-sm">
								<div class="col-md-6">
									<div class="form-group">
										<label>Town / City *</label>
										<input type="text" class="form-control form-control-md" name="billing_city" value="{{ $customer->customer_city ?? '' }}" required>
									</div>
									<div class="form-group">
										<label>ZIP *</label>
										<input type="text" class="form-control form-control-md" name="billing_postcode" value="{{ $customer->customer_pincode ?? '' }}" required>
									</div>
								</div>
								<div class="col-md-6">
									<div class="form-group">
										<label>State *</label>
										<div class="select-box">
											<select name="billing_state" class="form-control form-control-md">
												<option value="default" selected="selected">Tamilnadu</option>
												<option value="uk">United Kingdom (UK)</option>
												<option value="us">United States</option>
												<option value="fr">France</option>
												<option value="aus">Australia</option>
												
											</select>
										</div>
									</div>
									<div class="form-group">
										<label>Phone *</label>
										<input type="text" class="form-control form-control-md" name="billing_phone" value="{{ $customer->customer_mobileno ?? '' }}" required>
									</div>
								</div>
							</div>
							<div class="form-group mb-7">
								<label>Email address *</label>
								<input type="email" class="form-control form-control-md" name="billing_email" value="{{ $customer->customer_email ?? '' }}" required>
							</div>
							<div class="form-group checkbox-toggle pb-2">
								<input type="checkbox" class="custom-checkbox" id="shipping-toggle"
									name="shipping-toggle">
								<label for="shipping-toggle">Ship to a different address?</label>
							</div>
							<div class="checkbox-content">
								<div class="row gutter-sm">
									<div class="col-xs-6">
										<div class="form-group">
											<label>First name *</label>
											<input type="text" class="form-control form-control-md" name="shipping_firstname" id="shipping_firstname">
										</div>
									</div>
									<div class="col-xs-6">
										<div class="form-group">
											<label>Last name *</label>
											<input type="text" class="form-control form-control-md" name="shipping_lastname" id="shipping_lastname">
										</div>
									</div>
								</div>
								
								<div class="form-group">
									<label>Country / Region *</label>
									<div class="select-box">
										<select name="shipping_country" class="form-control form-control-md" id="shipping_country">
											<option value="default" selected="selected">United States
												(US)
											</option>
											<option value="uk">United Kingdom (UK)</option>
											<option value="us">United States</option>
											<option value="fr">France</option>
											<option value="aus">Australia</option>
											<option value="ind">India</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label>Street address *</label>
									<input type="text" placeholder="House number and street name" id="shipping_address"
										class="form-control form-control-md mb-2" name="shipping_address" >
									<input type="text" placeholder="Apartment, suite, unit, etc. (optional)" id="shipping_address1"
										class="form-control form-control-md" name="shipping_address1" >
								</div>
								<div class="row gutter-sm">
									<div class="col-md-6">
										<div class="form-group">
											<label>Town / City *</label>
											<input type="text" class="form-control form-control-md" name="shipping_city" id="shipping_city" >
										</div>
										<div class="form-group">
											<label>Postcode *</label>
											<input type="text" class="form-control form-control-md" name="shipping_postcode" id="shipping_postcode" >
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>State *</label>
											<div class="select-box">
												<select name="shipping_state" class="form-control form-control-md" id="shipping_state">
													<option value="default" selected="selected">Tamilnadu</option>
													<option value="uk">United Kingdom (UK)</option>
													<option value="us">United States</option>
													<option value="fr">France</option>
													<option value="aus">Australia</option>
												
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div class="form-group mt-3">
								<label for="order-notes">Order notes (optional)</label>
								<textarea class="form-control mb-0" id="order-notes" name="order-notes" cols="30"
									rows="4"
									placeholder="Notes about your order, e.g special notes for delivery"></textarea>
							</div>
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
											@foreach(($checkoutSummary['lines'] ?? []) as $item)
											<tr class="bb-no">
												<td class="product-name">
													{{ $item['name'] }}
													<i class="fas fa-times"></i>
													<span class="product-quantity">{{ $item['qty'] }}</span>
												</td>
												<td class="product-total">
													₹{{ number_format($item['line_total'], 2) }}
												</td>
											</tr>
											@endforeach

                                            <tr class="cart-subtotal bb-no">
                                                <td><b>Subtotal</b></td>
                                                <td><b>&#8377;{{ number_format(($checkoutSummary['subtotal'] ?? $total), 2) }}</b></td>
                                            </tr>
                                            <tr class="cart-subtotal bb-no">
                                                <td><b>Tax</b></td>
                                                <td><b>&#8377;{{ number_format(($checkoutSummary['tax_total'] ?? 0), 2) }}</b></td>
                                            </tr>
                                            <tr class="cart-subtotal bb-no">
                                                <td><b>Delivery Charge</b></td>
                                                <td><b>&#8377;{{ number_format(($checkoutSummary['delivery_charge'] ?? 0), 2) }}</b></td>
                                            </tr>
										</tbody>
										<tfoot>
											<tr class="shipping-methods">
												<td colspan="2" class="text-left">
													<h4 class="title title-simple bb-no mb-1 pb-0 pt-3">Shipping
													</h4>
													<ul id="shipping-method" class="mb-4">
														<li>
															<div class="custom-radio">
																<input type="radio" id="free-shipping"
																	class="custom-control-input" name="shipping">
																<label for="free-shipping"
																	class="custom-control-label color-dark">Free
																	Shipping</label>
															</div>
														</li>
														<li>
															<div class="custom-radio">
																<input type="radio" id="local-pickup"
																	class="custom-control-input" name="shipping">
																<label for="local-pickup"
																	class="custom-control-label color-dark">Local
																	Pickup</label>
															</div>
														</li>
														<li>
															<div class="custom-radio">
																<input type="radio" id="flat-rate"
																	class="custom-control-input" name="shipping">
																<label for="flat-rate"
																	class="custom-control-label color-dark">Flat
																	rate: $5.00</label>
															</div>
														</li>
													</ul>
												</td>
											</tr>
											<tr class="order-total">
												<th>
													<b>Total</b>
												</th>
												<td>
                                                    <b>&#8377;{{ number_format(($checkoutSummary['grand_total'] ?? $total), 2) }}</b>
												</td>
											</tr>
										</tfoot>
									</table>

									<div class="payment-methods" id="payment_method">
										<h4 class="title font-weight-bold ls-25 pb-0 mb-1">Payment Methods</h4>
										<div class="accordion payment-accordion">
											<div class="card">
												<div class="card-header">
													<a href="#cash-on-delivery" class="collapse">Direct Bank Transfor</a>
												</div>
												<div id="cash-on-delivery" class="card-body expanded">
													<p class="mb-0">
														Make your payment directly into our bank account. 
														Please use your Order ID as the payment reference. 
														Your order will not be shipped until the funds have cleared in our account.
													</p>
												</div>
											</div>
											<div class="card">
												<div class="card-header">
													<a href="#payment" class="expand">Check Payments</a>
												</div>
												<div id="payment" class="card-body collapsed">
													<p class="mb-0">
														Please send a check to Store Name, Store Street, Store Town, Store State / County, Store Postcode.
													</p>
												</div>
											</div>
											<div class="card">
												<div class="card-header">
													<a href="#delivery" class="expand">Cash on delivery</a>
												</div>
												<div id="delivery" class="card-body collapsed">
													<p class="mb-0">
														Pay with cash upon delivery.
													</p>
												</div>
											</div>
											<div class="card p-relative">
												<div class="card-header">
													<a href="#paypal" class="expand">Paypal</a>
												</div>
												<a href="https://www.paypal.com/us/webapps/mpp/paypal-popup" class="text-primary paypal-que" 
													onclick="javascript:window.open('https://www.paypal.com/us/webapps/mpp/paypal-popup','WIPaypal',
													'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=yes, resizable=yes, width=1060, height=700'); 
													return false;">What is PayPal?
												</a>
												<div id="paypal" class="card-body collapsed">
													<p class="mb-0">
														Pay via PayPal, you can pay with your credit cart if you
														don't have a PayPal account.
													</p>
												</div>
											</div>
										</div>
									</div>

									<div class="form-group place-order pt-6">
										<button type="submit" class="btn btn-dark btn-block btn-rounded">Place Order</button>
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
			</div>
		</div>
		<!-- End of PageContent -->
	</main>


<script>

const toggle = document.getElementById('shipping-toggle');
const shippingFields = [
  'shipping_firstname',
  'shipping_lastname',
  'shipping_address',
  'shipping_address1',
  'shipping_city',
  'shipping_postcode',
  'shipping_state'
];

function updateShippingRequired() {
  shippingFields.forEach(id => {
    const el = document.getElementById(id);
    if (toggle.checked) {
      el.setAttribute('required','required');
    } else {
      el.removeAttribute('required');
    }
  });
}

toggle.addEventListener('change', updateShippingRequired);

// page load-la first time check
updateShippingRequired();
</script>



	 @endsection

