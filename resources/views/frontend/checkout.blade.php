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
				@php
					$hasCustomer = session()->has('customer_id');
					$hasAddress = !empty($customer->customer_address ?? '')
						|| !empty($customer->customer_mobileno ?? '')
						|| !empty($customer->customer_email ?? '')
						|| !empty($customer->customer_city ?? '')
						|| !empty($customer->customer_state ?? '')
						|| !empty($customer->customer_pincode ?? '');
					$deliveryActionText = ($hasCustomer && $hasAddress) ? 'Change' : 'Add';
				@endphp
				<form class="form checkout-form" action="{{ route('checkout_store') }}" method="post">
					@csrf
					<div class="row mb-9">
						<div class="col-lg-8 pr-lg-4 mb-4">
							<div class="card mb-4" id="delivery-address">
								<div class="card-header d-flex align-items-center justify-content-between">
									<h4 class="mb-0">Delivery Address</h4>
									<a href="javascript:void(0)" class="text-primary" id="change-delivery-address">{{ $deliveryActionText }}</a>
								</div>
								<div class="card-body">
									<div class="mb-2 text-muted">Deliver to:</div>
									<div id="delivery-summary" class="mb-3"></div>

									<input type="hidden" name="billing_first_name" id="billing_first_name" value="{{ $customer->customer_firstname ?? '' }}">
									<input type="hidden" name="billing_last_name" id="billing_last_name" value="{{ $customer->customer_lastname ?? '' }}">
									<input type="hidden" name="billing_country" id="billing_country" value="{{ $customer->customer_country ?? 'India' }}">
									<input type="hidden" name="billing_address" id="billing_address" value="{{ $customer->customer_address ?? '' }}">
									<input type="hidden" name="street-address-2" id="billing_address_2" value="{{ $customer->customer_address1 ?? '' }}">
									<input type="hidden" name="billing_city" id="billing_city" value="{{ $customer->customer_city ?? '' }}">
									<input type="hidden" name="billing_postcode" id="billing_postcode" value="{{ $customer->customer_pincode ?? '' }}">
									<input type="hidden" name="billing_state" id="billing_state" value="{{ $customer->customer_state ?? '' }}">
									<input type="hidden" name="billing_phone" id="billing_phone" value="{{ $customer->customer_mobileno ?? '' }}">
									<input type="hidden" name="billing_email" id="billing_email" value="{{ $customer->customer_email ?? '' }}">
								</div>
							</div>

							<div class="card mb-4">
								<div class="card-header">
									<h4 class="mb-0">Items in Your Order</h4>
								</div>
								<div class="card-body">
									@foreach($records as $item)
										<div class="product product-list d-flex align-items-center mb-3">
											<figure class="product-media mr-3">
												<img src="{{ asset('assets/images/products/' . ($item['attributes']['image'] ?? '')) }}" alt="product" width="80" height="90">
											</figure>
											<div class="product-details flex-grow-1">
												<div class="product-name mb-1">{{ $item['name'] }}</div>
												@if(!empty($item['attributes']['size']) || !empty($item['attributes']['color']))
													<div class="small text-muted">
														@if(!empty($item['attributes']['size'])) Size: {{ $item['attributes']['size'] }} @endif
														@if(!empty($item['attributes']['color'])) | Color: {{ $item['attributes']['color'] }} @endif
													</div>
												@endif
												<div class="small text-muted">Qty: {{ $item['quantity'] }}</div>
											</div>
											<div class="text-right">
												<div class="product-price font-weight-bold">&#8377;{{ number_format($item['price'], 2) }}</div>
												<div class="small text-muted">Total: &#8377;{{ number_format(($item['price'] * $item['quantity']), 2) }}</div>
											</div>
										</div>
									@endforeach
								</div>
							</div>

							<div class="form-group mt-3">
								<label for="order-notes">Order notes (optional)</label>
								<textarea class="form-control mb-0" id="order-notes" name="order-notes" cols="30"
									rows="4"
									placeholder="Notes about your order, e.g special notes for delivery"></textarea>
							</div>
						</div>
						<div class="col-lg-4 mb-4 sticky-sidebar-wrapper">
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
													&#8377;{{ number_format($item['line_total'], 2) }}
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

				<div id="deliveryModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display:none;">
					<div class="modal-dialog modal-md" role="document">
						<div class="modal-content">
							<div class="modal-header d-flex align-items-center justify-content-between">
								<h5 class="modal-title mb-0">Delivery Address</h5>
								<button type="button" class="close m-0" aria-label="Close" id="close-delivery-modal">
									<span aria-hidden="true">&times;</span>
								</button>
							</div>
							<div class="modal-body">
								<div class="row gutter-sm">
									<div class="col-sm-6">
										<div class="form-group">
											<label>First name *</label>
											<input type="text" class="form-control form-control-md" id="modal_billing_first_name" value="{{ $customer->customer_firstname ?? '' }}" required>
										</div>
									</div>
									<div class="col-sm-6">
										<div class="form-group">
											<label>Last name *</label>
											<input type="text" class="form-control form-control-md" id="modal_billing_last_name" value="{{ $customer->customer_lastname ?? '' }}" required>
										</div>
									</div>
								</div>

								<div class="form-group">
									<label>Country / Region *</label>
									<div class="select-box">
										<select id="modal_billing_country" class="form-control form-control-md">
											<option value="India" {{ ($customer->customer_country ?? 'India') == 'India' ? 'selected' : '' }}>India</option>
											<option value="United States">United States</option>
											<option value="United Kingdom">United Kingdom</option>
											<option value="France">France</option>
											<option value="Australia">Australia</option>
										</select>
									</div>
								</div>
								<div class="form-group">
									<label>Street address *</label>
									<input type="text" placeholder="House number and street name"
										class="form-control form-control-md mb-2" id="modal_billing_address" value="{{ $customer->customer_address ?? '' }}" required>
									<input type="text" placeholder="Apartment, suite, unit, etc. (optional)"
										class="form-control form-control-md" id="modal_billing_address_2" value="{{ $customer->customer_address1 ?? '' }}">
								</div>
								<div class="row gutter-sm">
									<div class="col-md-6">
										<div class="form-group">
											<label>Town / City *</label>
											<input type="text" class="form-control form-control-md" id="modal_billing_city" value="{{ $customer->customer_city ?? '' }}" required>
										</div>
										<div class="form-group">
											<label>ZIP *</label>
											<input type="text" class="form-control form-control-md" id="modal_billing_postcode" value="{{ $customer->customer_pincode ?? '' }}" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label>State *</label>
											<input type="text" class="form-control form-control-md" id="modal_billing_state" value="{{ $customer->customer_state ?? '' }}" required>
										</div>
										<div class="form-group">
											<label>Phone *</label>
											<input type="text" class="form-control form-control-md" id="modal_billing_phone" value="{{ $customer->customer_mobileno ?? '' }}" required>
										</div>
									</div>
								</div>
								<div class="form-group mb-0">
									<label>Email address *</label>
									<input type="email" class="form-control form-control-md" id="modal_billing_email" value="{{ $customer->customer_email ?? '' }}" required>
								</div>
							</div>
							<div class="modal-footer">
								<button type="button" class="btn btn-outline-secondary" id="cancel-delivery-modal">Cancel</button>
								<button type="button" class="btn btn-dark" id="save-delivery-address">Save Address</button>
							</div>
						</div>
					</div>
				</div>
				<div id="deliveryModalBackdrop" class="modal-backdrop" style="display:none;"></div>
			</div>
		</div>
		<!-- End of PageContent -->
	</main>

	<style>
		#deliveryModal {
			position: fixed;
			inset: 0;
			z-index: 1050;
			overflow-y: auto;
			background: rgba(0, 0, 0, 0.4);
		}
		#deliveryModal .modal-dialog {
			margin: 4rem auto;
			max-width: 720px;
		}
		#deliveryModalBackdrop {
			position: fixed;
			inset: 0;
			background: rgba(0, 0, 0, 0.4);
			z-index: 1040;
		}
		#deliveryModal .modal-content {
			background: #fff;
			border-radius: 8px;
		}
		#deliveryModal .modal-header,
		#deliveryModal .modal-body,
		#deliveryModal .modal-footer {
			padding: 1rem 1.25rem;
		}
		#deliveryModal .close {
			font-size: 1.5rem;
			line-height: 1;
		}
	</style>

	<script>
		(function () {
			var changeBtn = document.getElementById('change-delivery-address');
			var modal = document.getElementById('deliveryModal');
			var saveBtn = document.getElementById('save-delivery-address');
			var closeBtn = document.getElementById('close-delivery-modal');
			var cancelBtn = document.getElementById('cancel-delivery-modal');
			var summary = document.getElementById('delivery-summary');
			var form = document.querySelector('.checkout-form');
			var placeOrderBtn = form ? form.querySelector('button[type="submit"]') : null;

			var isLoggedIn = {{ session()->has('customer_id') ? 'true' : 'false' }};
			var storageKey = 'oxy_delivery_address';

			var fields = {
				firstName: document.getElementById('billing_first_name'),
				lastName: document.getElementById('billing_last_name'),
				country: document.getElementById('billing_country'),
				address: document.getElementById('billing_address'),
				address2: document.getElementById('billing_address_2'),
				city: document.getElementById('billing_city'),
				postcode: document.getElementById('billing_postcode'),
				state: document.getElementById('billing_state'),
				phone: document.getElementById('billing_phone'),
				email: document.getElementById('billing_email')
			};

			var modalFields = {
				firstName: document.getElementById('modal_billing_first_name'),
				lastName: document.getElementById('modal_billing_last_name'),
				country: document.getElementById('modal_billing_country'),
				address: document.getElementById('modal_billing_address'),
				address2: document.getElementById('modal_billing_address_2'),
				city: document.getElementById('modal_billing_city'),
				postcode: document.getElementById('modal_billing_postcode'),
				state: document.getElementById('modal_billing_state'),
				phone: document.getElementById('modal_billing_phone'),
				email: document.getElementById('modal_billing_email')
			};

			function hasAddress() {
				return !!(
					fields.firstName.value &&
					fields.lastName.value &&
					fields.address.value &&
					fields.city.value &&
					fields.postcode.value &&
					fields.state.value &&
					fields.phone.value &&
					fields.email.value
				);
			}

			function syncToModal() {
				modalFields.firstName.value = fields.firstName.value || '';
				modalFields.lastName.value = fields.lastName.value || '';
				modalFields.country.value = fields.country.value || 'India';
				modalFields.address.value = fields.address.value || '';
				modalFields.address2.value = fields.address2.value || '';
				modalFields.city.value = fields.city.value || '';
				modalFields.postcode.value = fields.postcode.value || '';
				modalFields.state.value = fields.state.value || '';
				modalFields.phone.value = fields.phone.value || '';
				modalFields.email.value = fields.email.value || '';
			}

			function renderSummary() {
				if (!summary) return;
				if (!hasAddress()) {
					summary.innerHTML = '<span class="text-muted">No delivery address added.</span>';
					return;
				}

				var name = (fields.firstName.value + ' ' + fields.lastName.value).trim();
				var addressLine = fields.address.value;
				var address2 = fields.address2.value ? ', ' + fields.address2.value : '';
				var cityLine = fields.city.value + ', ' + fields.state.value + ' ' + fields.postcode.value;
				var phoneLine = 'Phone: ' + fields.phone.value;
				var emailLine = 'Email: ' + fields.email.value;

				summary.innerHTML =
					'<div class="font-weight-bold">' + name + '</div>' +
					'<div>' + addressLine + address2 + '</div>' +
					'<div>' + cityLine + '</div>' +
					'<div>' + (fields.country.value || '') + '</div>' +
					'<div class="small text-muted">' + phoneLine + '</div>' +
					'<div class="small text-muted">' + emailLine + '</div>';
			}

			function syncFromModal() {
				fields.firstName.value = modalFields.firstName.value.trim();
				fields.lastName.value = modalFields.lastName.value.trim();
				fields.country.value = modalFields.country.value;
				fields.address.value = modalFields.address.value.trim();
				fields.address2.value = modalFields.address2.value.trim();
				fields.city.value = modalFields.city.value.trim();
				fields.postcode.value = modalFields.postcode.value.trim();
				fields.state.value = modalFields.state.value.trim();
				fields.phone.value = modalFields.phone.value.trim();
				fields.email.value = modalFields.email.value.trim();
			}

			function persistToStorage() {
				var payload = {
					firstName: fields.firstName.value,
					lastName: fields.lastName.value,
					country: fields.country.value,
					address: fields.address.value,
					address2: fields.address2.value,
					city: fields.city.value,
					postcode: fields.postcode.value,
					state: fields.state.value,
					phone: fields.phone.value,
					email: fields.email.value
				};
				try {
					localStorage.setItem(storageKey, JSON.stringify(payload));
				} catch (e) {
					// Ignore storage failures (privacy mode).
				}
			}

			function hydrateFromStorage() {
				try {
					var raw = localStorage.getItem(storageKey);
					if (!raw) return;
					var data = JSON.parse(raw);
					fields.firstName.value = data.firstName || fields.firstName.value;
					fields.lastName.value = data.lastName || fields.lastName.value;
					fields.country.value = data.country || fields.country.value || 'India';
					fields.address.value = data.address || fields.address.value;
					fields.address2.value = data.address2 || fields.address2.value;
					fields.city.value = data.city || fields.city.value;
					fields.postcode.value = data.postcode || fields.postcode.value;
					fields.state.value = data.state || fields.state.value;
					fields.phone.value = data.phone || fields.phone.value;
					fields.email.value = data.email || fields.email.value;
				} catch (e) {
					// Ignore parse errors.
				}
			}

			function saveAddressToApi() {
				if (!isLoggedIn) return;
				var formData = new FormData();
				formData.append('customer_firstname', fields.firstName.value);
				formData.append('customer_mobileno', fields.phone.value);
				formData.append('customer_email', fields.email.value);
				formData.append('customer_address', fields.address.value);
				formData.append('customer_state', fields.state.value);
				formData.append('customer_pincode', fields.postcode.value);

				fetch("{{ route('save-shipping-address') }}", {
					method: 'POST',
					headers: {
						'X-CSRF-TOKEN': '{{ csrf_token() }}'
					},
					body: formData
				}).catch(function () {
					// Silent fail; checkout will still save on place order.
				});
			}

			function openModal() {
				if (!modal) return;
				if (!backdrop && modal) {
					backdrop = document.getElementById('deliveryModalBackdrop');
				}
				modal.classList.add('show');
				modal.style.display = 'block';
				if (backdrop) backdrop.style.display = 'block';
				document.body.classList.add('modal-open');
			}

			function closeModal() {
				if (!modal) return;
				modal.classList.remove('show');
				modal.style.display = 'none';
				if (backdrop) backdrop.style.display = 'none';
				document.body.classList.remove('modal-open');
			}

			var backdrop = document.getElementById('deliveryModalBackdrop');

			if (changeBtn) {
				changeBtn.addEventListener('click', function () {
					syncToModal();
					openModal();
				});
			}

			if (closeBtn) closeBtn.addEventListener('click', closeModal);
			if (cancelBtn) cancelBtn.addEventListener('click', function () {
				syncToModal();
				closeModal();
			});
			if (backdrop) backdrop.addEventListener('click', closeModal);

			if (saveBtn) {
				saveBtn.addEventListener('click', function () {
					syncFromModal();
					persistToStorage();
					renderSummary();
					saveAddressToApi();
					closeModal();
				});
			}

			if (form) {
				form.addEventListener('submit', function (e) {
					if (!hasAddress()) {
						e.preventDefault();
						openModal();
					}
				});
			}

			// Keep button enabled; block submit only if address missing.

			if (!isLoggedIn) {
				try {
					localStorage.removeItem(storageKey);
				} catch (e) {
					// Ignore storage failures.
				}
				Object.keys(fields).forEach(function (key) {
					if (fields[key]) fields[key].value = '';
				});
			} else if (!hasAddress()) {
				hydrateFromStorage();
			}
			renderSummary();
		})();
	</script>

	 @endsection

