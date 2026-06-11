@extends('app_template')
 @section('title', 'Checkout')
 @section('content')
 <script src="https://checkout.razorpay.com/v1/checkout.js"></script>
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
     <style>
         /* Premium Checkout Redesign */

          .shop-footer{
                height: 69px !important;
            }
            .shop-details-ps-image{
                    height: 65px;
                    /* margin-top: 12px; */
            }

         .checkout .card {
             border: 1px solid rgba(0,0,0,0.05) !important;
             border-radius: 12px !important;
             box-shadow: 0 6px 16px rgba(0,0,0,0.03) !important;
             background: #ffffff !important;
             margin-bottom: 24px !important;
             overflow: hidden !important;
         }
         .checkout .card-header {
             background: #f8fafc !important;
             border-bottom: 1px solid rgba(0,0,0,0.04) !important;
             padding: 18px 24px !important;
         }
         .checkout .card-header h4 {
             font-weight: 700 !important;
             font-size: 1.15rem !important;
             color: #1e293b !important;
             margin: 0 !important;
             letter-spacing: -0.01em !important;
         }
         .checkout .card-body {
             padding: 24px !important;
         }
         
         /* Login / Coupon Notices */
         .checkout-notice {
             background: #f0f7ff;
             border-left: 4px solid #0088dd;
             padding: 14px 20px;
             border-radius: 8px;
             margin-bottom: 16px;
             font-size: 0.95rem;
             color: #334155;
             display: flex;
             align-items: center;
             gap: 12px;
             box-shadow: 0 2px 8px rgba(0,0,0,0.02);
         }
         .checkout-notice a {
             color: #0088dd !important;
             font-weight: 700 !important;
             text-decoration: underline !important;
         }

         /* Product List Fixes */
         .checkout .product-list {
             background: #ffffff !important;
             border: 1px solid #e2e8f0 !important;
             border-radius: 10px !important;
             padding: 20px !important;
             margin-bottom: 16px !important;
             transition: all 0.3s ease !important;
             display: flex !important;
             align-items: flex-start !important;
             justify-content: space-between !important;
         }
         .checkout .product-list:hover {
             box-shadow: 0 4px 15px rgba(0,0,0,0.05) !important;
             border-color: #cbd5e1 !important;
         }
         .checkout .product-media {
             border-radius: 8px !important;
             overflow: hidden !important;
             border: 1px solid rgba(0,0,0,0.04) !important;
             flex-shrink: 0 !important;
             flex-basis: 75px !important;
             width: 75px !important;
             max-width: 75px !important;
             height: 75px !important;
             margin-right: 20px !important;
             display: flex !important;
             align-items: center !important;
             justify-content: center !important;
             background: #f8fafc !important;
         }
         .checkout .product-media img {
             width: 100% !important;
             height: 100% !important;
             max-height: 75px !important;
             max-width: 75px !important;
             object-fit: cover !important;
         } 
         .checkout .product-details {
             flex: 1 1 auto !important;
             min-width: 0 !important;
         }
         .checkout .product-name {
             font-size: 1.25rem !important;
             font-weight: 700 !important;
             color: #1e293b !important;
             margin-bottom: 6px !important;
         }
         .checkout .product-meta {
             font-size: 1.05rem !important;
             color: #64748b !important;
             line-height: 1.4 !important;
         }
         .checkout .product-price-block {
             flex: 0 0 auto !important;
             text-align: right !important;
             display: flex !important;
             flex-direction: column !important;
             align-items: flex-end !important;
             padding-left: 20px !important;
         }
         .checkout .product-price-block .price {
             font-size: 1.2rem !important;
             font-weight: 800 !important;
             color: #0f172a !important;
         }
         .checkout .product-price-block .total {
             font-size: 0.95rem !important;
             color: #64748b !important;
             margin-top: 4px !important;
         }

         /* Sidebar "Your Order" */
         .order-summary-wrapper.sticky-sidebar {
             border: 1px solid rgba(0,0,0,0.05);
             border-radius: 12px;
             box-shadow: 0 10px 30px rgba(0,0,0,0.04);
             background: #ffffff;
             padding: 24px;
         }
         .order-summary-wrapper .title {
             font-weight: 800;
             font-size: 1.25rem;
             color: #0f172a;
             border-bottom: 2px solid #f1f5f9;
             padding-bottom: 16px;
             margin-bottom: 16px;
             letter-spacing: -0.01em;
         }
         .order-table th, .order-table td {
             padding: 14px 0 !important;
             border-bottom: 1px dashed #e2e8f0 !important;
             font-size: 1.05rem;
         }
         .order-table .product-name {
             color: #475569;
         }
         .order-table .product-total {
             font-weight: 600;
             color: #1e293b;
             text-align: right;
         }
         .order-total th, .order-total td {
             padding: 24px 0 8px 0 !important;
             border-top: 2px solid #cbd5e1 !important;
             border-bottom: none !important;
         }
         .order-total b {
             font-size: 1.35rem;
             color: #0088dd;
         }

         /* Payment Methods */
         .payment-methods {
             margin-top: 24px;
             padding-top: 24px;
             border-top: 1px solid #f1f5f9;
         }
         .payment-methods .title {
             font-size: 1.1rem;
             color: #1e293b;
             margin-bottom: 16px;
         }
         .payment-accordion .card {
             border: 1px solid #e2e8f0 !important;
             border-radius: 8px !important;
             margin-bottom: 12px !important;
             box-shadow: none !important;
         }
         .payment-accordion .card-header a {
             padding: 14px 20px;
             font-weight: 600;
             color: #334155;
             display: block;
             background: #f8fafc;
             border-radius: 8px;
             text-decoration: none;
         }
         .payment-accordion .card-body {
             padding: 16px 20px !important;
             font-size: 0.9rem;
             color: #64748b;
             background: #ffffff;
         }
         
         .place-order .btn {
             background: linear-gradient(135deg, #0088dd 0%, #006bb3 100%) !important;
             border: none !important;
             color: #ffffff !important;
             font-size: 1.1rem !important;
             font-weight: 700 !important;
             padding: 16px !important;
             border-radius: 8px !important;
             box-shadow: 0 6px 20px rgba(0, 136, 221, 0.3) !important;
             transition: all 0.2s ease;
         }
         .place-order .btn:hover {
             transform: translateY(-2px);
             box-shadow: 0 8px 25px rgba(0, 136, 221, 0.4) !important;
         }
          /* Modern Enhanced Sidebar Styling */
          .order-summary-wrapper.sticky-sidebar {
              border: 1px solid rgba(0,0,0,0.06) !important;
              border-radius: 20px !important;
              box-shadow: 0 15px 45px rgba(0,0,0,0.06) !important;
              padding: 30px !important;
              background: linear-gradient(to bottom, #ffffff, #fcfdfe) !important;
          }
          .order-summary-wrapper .title {
              font-family: 'Poppins', sans-serif;
              font-weight: 800 !important;
              font-size: 1.45rem !important;
              color: #0f172a !important;
              display: flex !important;
              align-items: center;
              gap: 12px;
          }
          .order-summary-wrapper .title::before {
              content: '';
              display: block;
              width: 5px;
              height: 28px;
              background: #0088dd;
              border-radius: 5px;
          }
          .order-table th {
              text-transform: uppercase !important;
              font-size: 0.8rem !important;
              letter-spacing: 0.8px !important;
              color: #64748b !important;
              padding: 15px 0 !important;
          }
          .order-table td {
              padding: 20px 0 !important;
              border-bottom: 1px solid #f1f5f9 !important;
              font-size: 1.15rem !important;
          }
          .order-table .product-name {
              color: #334155 !important;
              font-weight: 600 !important;
          }
          .order-table .product-total {
              font-weight: 800 !important;
              color: #1e293b !important;
          }
          .order-total {
              border-top: 2px solid #e2e8f0 !important;
              padding-top: 24px !important;
          }
          .order-total b {
              font-size: 1.6rem !important;
              color: #0088dd !important;
          }
          #delivery-summary {
              font-size: 1.1rem !important;
              line-height: 1.6 !important;
              color: #334155 !important;
          }
     </style>
     <div class="page-content">
     <div class="container">
     @if (!session()->has('customer_id'))
     <div class="checkout-notice">
         <i class="w-icon-account" style="font-size: 20px;"></i>
         <span>Returning customer? <a onclick="showLoginPopup('{{ route('checkoutPage') }}')" class="show-login" style="cursor:pointer">Click here to login</a></span>
     </div>
     @endif

     @if (!session()->has('customer_id'))
     <div class="checkout-notice mt-3" style="cursor:pointer" onclick="showLoginPopup('{{ route('checkoutPage') }}')">
         <i class="w-icon-coupon" style="font-size: 20px;"></i>
         <span>Have a coupon? <a class="show-coupon" style="color: #0088dd; font-weight: 700; text-decoration: underline;">Click here to enter your code</a></span>
     </div>
     @else
     <div class="checkout-notice mt-3 coupon-toggle" style="cursor:pointer">
         <i class="w-icon-coupon" style="font-size: 20px;"></i>
         <span>Have a coupon? <a class="show-coupon">Click here to enter your code</a></span>
     </div>
     <div class="coupon-content mb-4">
     <p>If you have a coupon code, please apply it below.</p>
     <div class="input-wrapper-inline">
     <input type="text" name="coupon_code" class="form-control form-control-md mr-1 mb-2"
     placeholder="Coupon code" id="coupon_code">
     <button type="submit" class="btn button btn-rounded btn-coupon mb-2" name="apply_coupon"
     value="Apply coupon">Apply Coupon</button>
     </div>
     </div>
     @endif
     @php
         $hasCustomer = session()->has('customer_id');
         $hasAddress =
             !empty($customer->customer_address ?? '') ||
             !empty($customer->customer_mobileno ?? '') ||
             !empty($customer->customer_email ?? '') ||
             !empty($customer->customer_city ?? '') ||
             !empty($customer->customer_state ?? '') ||
             !empty($customer->customer_pincode ?? '');
         $deliveryActionText = $hasCustomer && $hasAddress ? 'Change' : 'Add';
     @endphp
     <form class="form checkout-form" action="{{ route('checkout_store') }}" method="post">
     @csrf
     <div class="row mb-9">
     <div class="col-lg-8 pr-lg-4 mb-4">
     <div class="card mb-4" id="delivery-address">
     <div class="card-header d-flex align-items-center justify-content-between">
     <h4 class="mb-0">Delivery Address</h4>
     <a href="javascript:void(0)" class="text-primary"
     id="change-delivery-address">{{ $deliveryActionText }}</a>
     </div>
     <div class="card-body">
     <div class="mb-2 text-muted">Deliver to:</div>
     <div id="delivery-summary" class="mb-3"></div>

     <input type="hidden" name="billing_first_name" id="billing_first_name"
     value="{{ $customer->customer_firstname ?? '' }}">
     <input type="hidden" name="billing_last_name" id="billing_last_name"
     value="{{ $customer->customer_lastname ?? '' }}">
     <input type="hidden" name="billing_country" id="billing_country"
     value="{{ $customer->customer_country ?? 'India' }}">
     <input type="hidden" name="billing_address" id="billing_address"
     value="{{ $customer->customer_address ?? '' }}">
     <input type="hidden" name="street-address-2" id="billing_address_2"
     value="{{ $customer->customer_address1 ?? '' }}">
     <input type="hidden" name="billing_city" id="billing_city"
     value="{{ $customer->customer_city ?? '' }}">
     <input type="hidden" name="billing_postcode" id="billing_postcode"
     value="{{ $customer->customer_pincode ?? '' }}">
     <input type="hidden" name="billing_state" id="billing_state"
     value="{{ $customer->customer_state ?? '' }}">
     <input type="hidden" name="billing_phone" id="billing_phone"
     value="{{ $customer->customer_mobileno ?? '' }}">
     <input type="hidden" name="billing_email" id="billing_email"
     value="{{ $customer->customer_email ?? '' }}">
     </div>
     </div>

     <div class="card mb-4">
     <div class="card-header">
     <h4 class="mb-0">Items in Your Order</h4>
     </div>
     <div class="card-body">
     @foreach ($checkoutSummary['lines'] ?? [] as $item)
     <div class="product product-list d-flex align-items-center">
     <figure class="product-media">
     <a href="{{ url('/products/' . ($item['slug'] ?? $item['product_id'])) }}">
     <img src="{{ asset('assets/images/products/' . ($item['image'] ?? '')) }}" alt="product">
     </a>
     </figure>
     <div class="product-details flex-grow-1">
     <div class="product-name">
         <a href="{{ url('/products/' . ($item['slug'] ?? $item['product_id'])) }}" class="text-dark">
             {{ $item['name'] }}
         </a>
     </div>
     @if (!empty($item['size']) || !empty($item['color']))
     <div class="product-meta">
     @if (!empty($item['size']))
     Size: <b>{{ $item['size'] }}</b>
     @endif
     @if (!empty($item['size']) && !empty($item['color']))
     <span class="mx-1">|</span> 
     @endif
     @if (!empty($item['color']))
     Color: <b>{{ $item['color'] }}</b>
     @endif
     </div>
     @endif
     <div class="product-meta mt-1">Qty: <b>{{ $item['qty'] }}</b></div>
     @if (!empty($item['offer_applied']))
     <div class="product-meta mt-1 text-success font-weight-bold">
     <i class="fas fa-tags"></i> {{ $item['offer_title'] ?: $item['offer_type'] }}
     @if (!empty($item['free_qty']))
     (Free Qty: {{ $item['free_qty'] }})
     @endif
     </div>
     @endif
     </div>
     <div class="product-price-block">
     @php
         $displayPrice = $item['effective_unit_price'] ?? $item['unit_price'];
         if (($item['offer_type'] ?? '') === 'Buy X Get Y Free') {
             $displayPrice = $item['unit_price'];
         }
     @endphp
     <div class="price"><span style="font-family: Arial, sans-serif;">₹</span>{{ number_format($displayPrice, 2) }}</div>
     <div class="total">Total: <b><span style="font-family: Arial, sans-serif;">₹</span>{{ number_format($item['payable_amount'], 2) }}</b></div>
     </div>
     </div>
      @endforeach
      </div>
      </div>


     </div>
     <div class="col-lg-4 mb-4 sticky-sidebar-wrapper">
     <div class="order-summary-wrapper sticky-sidebar">
     <h3 class="title text-uppercase ls-10"><i class="w-icon-cart"></i> Your Order</h3>
     <div class="order-summary">
     <table class="order-table">
     <thead>
     <tr>
     <th colspan="2" style="border-bottom: 2px solid #f1f5f9; padding-bottom: 12px;">
     <b class="text-uppercase" style="letter-spacing: 1px; font-size: 0.85rem; color: #64748b;">Selected Products</b>
     </th>
     </tr>
     </thead>
     <tbody>
     @foreach ($checkoutSummary['lines'] ?? [] as $item)
     <tr class="bb-no">
     <td class="product-name" style="word-break: break-word; white-space: normal; padding-right: 10px !important;">
     <a href="{{ url('/products/' . ($item['slug'] ?? $item['product_id'])) }}" class="text-dark">
         {{ $item['name'] }}
     </a>
     <i class="fas fa-times"></i>
     <span class="product-quantity">{{ $item['qty'] }}</span>
     
     @if (!empty($item['offer_applied']))
     <div class="mt-1 small text-success" style="word-break: break-word; white-space: normal; line-height: 1.4;">
     {{ $item['offer_title'] ?: $item['offer_type'] }}
     @if (!empty($item['free_qty']))
     | Free Qty: {{ $item['free_qty'] }}
     @endif
     @if (!empty($item['discount_amount']))
     | Saved: <span style="font-family: Arial, sans-serif;">₹</span>{{ number_format($item['discount_amount'], 2) }}
     @endif
     @if (!empty($item['cashback_amount']))
     | Cashback: <span style="font-family: Arial, sans-serif;">₹</span>{{ number_format($item['cashback_amount'], 2) }}
     @endif
     </div>
     @endif
     </td>
     <td class="product-total">
     <span style="font-family: Arial, sans-serif;">₹</span>{{ number_format($item['line_total'], 2) }}
     </td>
     </tr>
     @endforeach

     <tr class="cart-subtotal bb-no">
     <td><b>Subtotal</b></td>
     <td class="product-total"><b style="white-space: nowrap;"><span style="font-family: Arial, sans-serif;">₹</span>{{ number_format($checkoutSummary['subtotal'] ?? $total, 2) }}</b>
     </td>
     </tr>
     @if (($checkoutSummary['discount_total'] ?? 0) > 0)
     <tr class="cart-subtotal bb-no">
     <td><b>Offer Discount</b></td>
     <td class="product-total"><b style="color: #10b981; white-space: nowrap;">-<span style="font-family: Arial, sans-serif;">₹</span>{{ number_format($checkoutSummary['discount_total'], 2) }}</b>
     </td>
     </tr>
     @endif
     <tr class="cart-subtotal bb-no">
     <td><b>Tax</b></td>
     <td class="product-total"><b style="white-space: nowrap;"><span style="font-family: Arial, sans-serif;">₹</span>{{ number_format($checkoutSummary['tax_total'] ?? 0, 2) }}</b>
     </td>
     </tr>
     <tr class="cart-subtotal bb-no">
     <td><b>Delivery Charge</b></td>
     <td class="product-total"><b style="white-space: nowrap;"><span style="font-family: Arial, sans-serif;">₹</span>{{ number_format($checkoutSummary['delivery_charge'] ?? 0, 2) }}</b>
     </td>
     </tr>
     <tr class="cart-subtotal bb-no">
     <td><b>Platform Fee</b></td>
     <td class="product-total"><b style="white-space: nowrap;"><span style="font-family: Arial, sans-serif;">₹</span>{{ number_format($checkoutSummary['platform_fee'] ?? 10.0, 2) }}</b>
     </td>
     </tr>
     </tbody>
     <tfoot>
     <tr class="order-total">
     <th>
     <b>Total</b>
     </th>
     <td>
     <b><span style="font-family: Arial, sans-serif;">₹</span>{{ number_format($checkoutSummary['grand_total'] ?? $total, 2) }}</b>
     </td>
     </tr>
     @if (($checkoutSummary['cashback_total'] ?? 0) > 0)
     <tr class="order-total">
     <th>
     <b>Wallet Cashback</b>
     </th>
     <td>
     <b><span style="font-family: Arial, sans-serif;">₹</span>{{ number_format($checkoutSummary['cashback_total'], 2) }}</b>
     </td>
     </tr>
     @endif
     </tfoot>
     </table>

     <div class="payment-methods" id="payment_method">
     <h4 class="title font-weight-bold ls-25 pb-0 mb-1">Payment Methods</h4>
     <div class="accordion payment-accordion">
   
     <div class="card">
     <div class="card-header">
     <a href="#payment" class="expand payment-option" data-method="onlinepayment">Online Payments</a>
     </div>
     <div id="payment" class="collapsed" style="display: none;">
     </div>
     </div>
     <div class="card">
     <div class="card-header">
     <a href="#delivery" class="expand payment-option" data-method="Cash On Delivery">Cash on delivery</a>
     </div>
     <div id="delivery" class="collapsed" style="display: none;">
     </div>
     </div>
     {{-- <div class="card p-relative">
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
											</div> --}}
     </div>
     </div>

     <div class="form-group place-order pt-6">
     <input type="hidden" name="payment_method" id="payment_method_input" value="onlinepayment">
     <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
     <input type="hidden" name="razorpay_signature" id="razorpay_signature">
     <button type="submit" class="btn btn-dark btn-block btn-rounded">Place
     Order</button>
     </div>
     </div>
     </div>
     </div>
     </div>
     </form>

     <div id="deliveryModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true"
     style="display:none;">
     <div class="modal-dialog modal-dialog-centered modal-md" role="document">
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
     <input type="text" class="form-control form-control-md"
     id="modal_billing_first_name"
     value="{{ $customer->customer_firstname ?? '' }}" required>
     </div>
     </div>
     <div class="col-sm-6">
     <div class="form-group">
     <label>Last name *</label>
     <input type="text" class="form-control form-control-md"
     id="modal_billing_last_name"
     value="{{ $customer->customer_lastname ?? '' }}" required>
     </div>
     </div>
     </div>

     <div class="row gutter-sm">
     <div class="col-md-6">
     <div class="form-group">
     <label>Country / Region *</label>
     <div class="select-box">
     <select id="modal_billing_country" class="form-control form-control-md">
     <option value="India" {{ ($customer->customer_country ?? 'India') == 'India' ? 'selected' : '' }}>India</option>
     </select>
     </div>
     </div>
     </div>
     <div class="col-md-6">
     <div class="form-group">
     <label>Street address *</label>
     <input type="text" placeholder="House number and street name" class="form-control form-control-md" id="modal_billing_address" value="{{ $customer->customer_address ?? '' }}" required>
     <input type="hidden" id="modal_billing_address_2" value="{{ $customer->customer_address1 ?? '' }}">
     </div>
     </div>
     </div>
     <div class="row gutter-sm">
     <div class="col-md-4">
     <div class="form-group">
     <label>Town / City *</label>
     <input type="text" class="form-control form-control-md"
     id="modal_billing_city" value="{{ $customer->customer_city ?? '' }}"
     required>
     </div>
     </div>
     <div class="col-md-4">
     <div class="form-group">
     <label>State *</label>
     <input type="text" class="form-control form-control-md"
     id="modal_billing_state" value="{{ $customer->customer_state ?? '' }}"
     required>
     </div>
     </div>
     <div class="col-md-4">
     <div class="form-group">
     <label>ZIP *</label>
     <input type="text" class="form-control form-control-md"
     id="modal_billing_postcode"
     value="{{ $customer->customer_pincode ?? '' }}" required>
     </div>
     </div>
     </div>
     <div class="row gutter-sm">
     <div class="col-md-6">
     <div class="form-group mb-0">
     <label>Phone *</label>
     <input type="text" class="form-control form-control-md"
     id="modal_billing_phone"
     value="{{ $customer->customer_mobileno ?? '' }}" required>
     </div>
     </div>
     <div class="col-md-6">
     <div class="form-group mb-0">
     <label>Email address *</label>
     <input type="email" class="form-control form-control-md" id="modal_billing_email"
     value="{{ $customer->customer_email ?? '' }}" required>
     </div>
     </div>
     </div>
     </div>
     <div class="modal-footer">
     <button type="button" class="btn btn-outline-secondary"
     id="cancel-delivery-modal">Cancel</button>
     <button type="button" class="btn btn-dark" id="save-delivery-address">Save
     Address</button>
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
     /* Premium Checkout Modal Aesthetics */
     #deliveryModalBackdrop {
         position: fixed;
         inset: 0;
         background: rgba(15, 23, 42, 0.5) !important;
         backdrop-filter: blur(4px);
         z-index: 1040;
         transition: opacity 0.3s ease;
     }

     #deliveryModal {
         position: fixed;
         inset: 0;
         z-index: 1050;
         overflow-y: auto;
         padding: 0 15px;
     }

     #deliveryModal .modal-dialog {
         margin: 5vh auto;
         max-width: 550px;
         transition: all 0.3s cubic-bezier(0.16, 1, 0.3, 1);
         transform: translateY(-20px) scale(0.98);
         opacity: 0;
     }

     #deliveryModal.show .modal-dialog {
         transform: translateY(0) scale(1);
         opacity: 1;
     }

     #deliveryModal .modal-content {
         background: #ffffff;
         border-radius: 16px;
         border: 1px solid rgba(255, 255, 255, 0.2);
         box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25), 0 0 0 1px rgba(0, 0, 0, 0.05);
         overflow: hidden;
     }

     #deliveryModal .modal-header {
         padding: 24px 28px 16px;
         border-bottom: 1px solid #f1f5f9;
         background: linear-gradient(to right, #ffffff, #f8fafc);
     }

     #deliveryModal .modal-title {
         font-weight: 700;
         font-size: 1.45rem;
         color: #0f172a;
         letter-spacing: -0.01em;
     }

     #deliveryModal .close {
         font-size: 1.8rem;
         line-height: 1;
         color: #94a3b8;
         text-shadow: none;
         opacity: 0.6;
         padding: 0;
         margin: 0;
         background: transparent;
         border: none;
         transition: all 0.2s ease;
         outline: none;
     }
     
     #deliveryModal .close:hover {
         color: #ef4444;
         opacity: 1;
         transform: rotate(90deg) scale(1.1);
     }

     #deliveryModal .modal-body {
         padding: 24px 28px;
         background: #fdfdfd;
     }

     #deliveryModal .modal-footer {
         padding: 16px 28px 24px;
         border-top: none;
         background: #fdfdfd;
         display: flex;
         gap: 12px;
         justify-content: flex-end;
     }

     /* Form Fields Premium Polish */
     #deliveryModal .form-group {
         margin-bottom: 20px;
     }

     #deliveryModal .form-group label {
         font-weight: 600;
         font-size: 0.9rem;
         color: #64748b;
         margin-bottom: 8px;
         display: block;
         text-transform: uppercase;
         letter-spacing: 0.7px;
     }

     #deliveryModal .form-control {
         border: 1px solid #cbd5e1;
         border-radius: 8px;
         padding: 12px 14px;
         font-size: 0.95rem;
         color: #334155;
         transition: all 0.2s ease;
         background-color: #ffffff;
     }

     #deliveryModal .form-control:focus {
         border-color: #0088dd;
         box-shadow: 0 0 0 4px rgba(0, 136, 221, 0.1);
         outline: none;
         background-color: #fff;
     }
     
     /* Force height on form controls to prevent inline bugs */
     #deliveryModal .select-box select.form-control,
     #deliveryModal input.form-control {
         height: 46px !important;
     }

     /* Action Buttons */
     #deliveryModal .modal-footer .btn {
         border-radius: 8px;
         padding: 12px 28px;
         font-size: 0.95rem;
         font-weight: 600;
         transition: all 0.2s;
         letter-spacing: 0.3px;
     }

     #deliveryModal .modal-footer .btn-outline-secondary {
         border: 1px solid #e2e8f0;
         color: #64748b;
         background: #ffffff;
         box-shadow: 0 1px 2px rgba(0,0,0,0.05);
     }

     #deliveryModal .modal-footer .btn-outline-secondary:hover {
         background: #f8fafc;
         color: #0f172a;
         border-color: #cbd5e1;
     }

     #deliveryModal .modal-footer .btn-dark {
         background: linear-gradient(135deg, #0088dd 0%, #006bb3 100%);
         border: none;
         color: #ffffff;
         box-shadow: 0 4px 12px rgba(0, 136, 221, 0.3);
     }

     #deliveryModal .modal-footer .btn-dark:hover {
         transform: translateY(-2px);
         box-shadow: 0 6px 16px rgba(0, 136, 221, 0.4);
     }
     </style>

     <script>
         (function() {
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
                 }).catch(function() {
                     // Silent fail; checkout will still save on place order.
                 });
             }

             function openModal() {
                 if (!modal) return;
                 if (!backdrop && modal) {
                     backdrop = document.getElementById('deliveryModalBackdrop');
                 }
                 modal.style.display = 'block';
                 if (backdrop) backdrop.style.display = 'block';
                 
                 // Force reflow allowing the display change to register before the class addition
                 void modal.offsetWidth;
                 
                 modal.classList.add('show');
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
                 changeBtn.addEventListener('click', function() {
                     if (!isLoggedIn) {
                         if (typeof showLoginPopup === 'function') {
                             showLoginPopup('{{ route('checkoutPage') }}');
                         }
                         return;
                     }
                     syncToModal();
                     openModal();
                 });
             }

             if (closeBtn) closeBtn.addEventListener('click', closeModal);
             if (cancelBtn) cancelBtn.addEventListener('click', function() {
                 syncToModal();
                 closeModal();
             });
             if (backdrop) backdrop.addEventListener('click', closeModal);

            if (saveBtn) {
                saveBtn.addEventListener('click', function() {
                    var requiredModalFields = [
                        modalFields.firstName,
                        modalFields.lastName,
                        modalFields.address,
                        modalFields.city,
                        modalFields.postcode,
                        modalFields.state,
                        modalFields.phone,
                        modalFields.email
                    ];

                    var invalid = false;
                    requiredModalFields.forEach(function(field) {
                        if (field && !field.checkValidity()) {
                            field.reportValidity();
                            invalid = true;
                        }
                    });

                    if (invalid) {
                        return;
                    }

                    syncFromModal();
                    persistToStorage();
                    renderSummary();
                    saveAddressToApi();
                    closeModal();
                });
             }

             if (form) {
                 form.addEventListener('submit', function(e) {
                     if (!isLoggedIn) {
                         e.preventDefault();
                         if (typeof showLoginPopup === 'function') {
                             showLoginPopup('{{ route('checkoutPage') }}');
                         }
                         return;
                     }
                     if (!hasAddress()) {
                         e.preventDefault();
                         openModal();
                         return;
                     }
                     
                     var paymentMethod = document.getElementById('payment_method_input').value;
                     if (paymentMethod === 'onlinepayment' && document.getElementById('razorpay_payment_id').value === '') {
                         e.preventDefault();
                         
                         var totalAmount = '{{ $checkoutSummary['grand_total'] ?? 0 }}';
                         var customerName = '{{ $customer->customer_firstname ?? "Customer" }}';
                         var customerEmail = '{{ $customer->customer_email ?? "customer@example.com" }}';
                         var customerPhone = '{{ $customer->customer_mobileno ?? "" }}';
                         
                         var options = {
                             "key": "{{ config('services.razorpay.key') }}",
                             "amount": totalAmount * 100,
                             "currency": "INR",
                             "name": "Oxygen Store",
                             "description": "Order Payment",
                             "handler": function (response){
                                 document.getElementById('razorpay_payment_id').value = response.razorpay_payment_id;
                                 document.getElementById('razorpay_signature').value = response.razorpay_signature;
                                 form.submit();
                             },
                             "prefill": {
                                 "name": customerName,
                                 "email": customerEmail,
                                 "contact": customerPhone
                             },
                             "theme": {
                                 "color": "#3399cc"
                             }
                         };
                         var rzp1 = new Razorpay(options);
                         rzp1.open();
                     }
                 });
             }

             document.querySelectorAll('.payment-option').forEach(function(el) {
                 el.addEventListener('click', function(e) {
                     document.getElementById('payment_method_input').value = this.getAttribute('data-method');
                 });
             });


             // Keep button enabled; block submit only if address missing.

             if (!isLoggedIn) {
                 try {
                     localStorage.removeItem(storageKey);
                 } catch (e) {
                     // Ignore storage failures.
                 }
                 Object.keys(fields).forEach(function(key) {
                     if (fields[key]) fields[key].value = '';
                 });
             } else if (!hasAddress()) {
                 hydrateFromStorage();
             }
             renderSummary();
         })();
     </script>

 @endsection
