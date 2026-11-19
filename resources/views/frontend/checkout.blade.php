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
             margin-bottom: 10px !important;
             box-shadow: none !important;
             background: #f8fafc !important;
             overflow: hidden !important;
         }
         .payment-accordion .card-header {
             padding: 0 !important;
             background: transparent !important;
             border: none !important;
         }
         .payment-accordion .card-header a {
             padding: 12px 18px 12px 46px !important;
             font-weight: 600;
             font-size: 1.5rem !important;
             color: #334155;
             display: flex !important;
             align-items: center !important;
             background: #f8fafc;
             border-radius: 8px;
             text-decoration: none;
             position: relative;
             line-height: 1.4;
         }
         .payment-accordion .card-header a::before {
             left: 14px !important;
             top: 50% !important;
             transform: translateY(-50%) !important;
         }
         .payment-accordion .card-header a::after {
             left: 19px !important;
             top: 50% !important;
             transform: translateY(-50%) !important;
         }
         .payment-accordion .card-header a.collapse {
             color: #0088dd;
         }
         .payment-accordion .card-header a.collapse::before {
             border-color: #0088dd !important;
         }
         .payment-accordion .card-header a.collapse::after {
             background-color: #0088dd !important;
             opacity: 1 !important;
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

          /* Mobile Responsive Checkout Redesign */
          @media (max-width: 767px) {
              .checkout .page-content .container {
                  padding-left: 15px !important;
                  padding-right: 15px !important;
                  max-width: 100% !important;
                  width: 100% !important;
              }

              .checkout .card-body {
                  padding: 15px !important;
              }

              .checkout .product-list {
                  display: grid !important;
                  grid-template-columns: 75px 1fr !important;
                  grid-template-areas:
                      "img name"
                      "img meta"
                      "img price" !important;
                  gap: 4px 12px !important;
                  padding: 12px !important;
                  position: relative !important;
                  align-items: start !important;
              }

              .checkout .product-media {
                  grid-area: img !important;
                  margin-right: 0 !important;
                  width: 75px !important;
                  height: 75px !important;
                  border-radius: 12px !important;
                  background: #f5f6f8 !important;
              }

              .checkout .product-details {
                  grid-area: name !important;
                  display: flex !important;
                  flex-direction: column !important;
                  gap: 2px !important;
              }

              .checkout .product-name {
                  font-size: 1.3rem !important;
                  margin-bottom: 0 !important;
                  line-height: 1.3 !important;
              }

              .checkout .product-meta {
                  font-size: 1.1rem !important;
                  line-height: 1.2 !important;
              }

              .checkout .product-price-block {
                  grid-area: price !important;
                  display: block !important;
                  text-align: left !important;
                  padding-left: 0 !important;
                  margin-top: 4px !important;
                  align-items: flex-start !important;
              }

              .checkout .product-price-block .price {
                  font-size: 1.3rem !important;
                  font-weight: 700 !important;
                  color: #111 !important;
                  display: inline-block !important;
              }

              .checkout .product-price-block .total {
                  font-size: 1.2rem !important;
                  color: #4b5563 !important;
                  margin-top: 2px !important;
                  display: block !important;
              }
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
         $shipping_addresses = $shipping_addresses ?? collect();
         $defaultSavedAddress = $shipping_addresses->firstWhere('is_default', 1) ?? $shipping_addresses->first();

         $initFirstName = $defaultSavedAddress->customer_firstname ?? ($customer->customer_firstname ?? '');
         $initLastName = $customer->customer_lastname ?? '';
         $initPhone = $defaultSavedAddress->customer_mobileno ?? ($customer->customer_mobileno ?? '');
         $initEmail = $defaultSavedAddress->customer_email ?? ($customer->customer_email ?? '');
         $initAddress = $defaultSavedAddress->customer_address ?? ($customer->customer_address ?? '');
         $initState = $defaultSavedAddress->customer_state ?? (!empty($customer->customer_state) ? $customer->customer_state : 'Tamil Nadu');
         $initCity = $defaultSavedAddress->customer_city ?? ($customer->customer_city ?? '');
         if (empty($initCity)) {
             $initCity = $initState;
         }
         $initPincode = $defaultSavedAddress->customer_pincode ?? ($customer->customer_pincode ?? '');
         $initCountry = 'India';

         $hasAddress = !empty($initAddress) && !empty($initPhone) && !empty($initPincode);
         $deliveryActionText = $shipping_addresses->count() > 1 ? 'Change' : ($hasAddress ? 'Change' : 'Add');
     @endphp

     @if (session('error'))
     <div class="alert alert-danger alert-simple alert-inline mb-4" role="alert" style="font-size: 1.4rem;">
         <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
     </div>
     @endif
     @if ($errors->any())
     <div class="alert alert-danger alert-simple alert-inline mb-4" role="alert" style="font-size: 1.4rem;">
         <i class="fas fa-exclamation-circle mr-2"></i>
         <ul class="mb-0 pl-3">
             @foreach ($errors->all() as $error)
                 <li>{{ $error }}</li>
             @endforeach
         </ul>
     </div>
     @endif

     <form class="form checkout-form" action="{{ route('checkout_store') }}" method="post" novalidate data-no-validate>
     @csrf
     <div class="row mb-9">
     <div class="col-lg-8 pr-lg-4 mb-4">
     <div class="card mb-4" id="delivery-address" style="border: 1px solid #e2e8f0; border-radius: 12px; box-shadow: 0 1px 4px rgba(0,0,0,0.04);">
     <div class="card-header d-flex align-items-center justify-content-between" style="background: #ffffff; border-bottom: 1px solid #f1f5f9; padding: 14px 20px;">
     <h4 class="mb-0 font-weight-bold" style="font-size: 1.15rem; color: #0f172a;">
         <i class="fas fa-map-marker-alt text-primary mr-2"></i> Delivery Address
     </h4>
     <a href="javascript:void(0)" class="btn btn-outline-primary btn-sm font-weight-bold"
     id="change-delivery-address" style="border-radius: 6px; padding: 5px 14px;">
         <i class="fas fa-exchange-alt mr-1"></i> {{ $deliveryActionText }}
     </a>
     </div>
     <div class="card-body" style="padding: 16px 20px;">
     <div class="mb-2 text-muted small text-uppercase font-weight-bold" style="letter-spacing: 0.5px;">Deliver to:</div>
     <div id="delivery-summary" class="mb-2"></div>

     <input type="hidden" name="billing_first_name" id="billing_first_name"
     value="{{ $initFirstName }}">
     <input type="hidden" name="billing_last_name" id="billing_last_name"
     value="{{ $initLastName }}">
     <input type="hidden" name="billing_country" id="billing_country"
     value="{{ $initCountry }}">
     <input type="hidden" name="billing_address" id="billing_address"
     value="{{ $initAddress }}">
     <input type="hidden" name="street-address-2" id="billing_address_2"
     value="">
     <input type="hidden" name="billing_city" id="billing_city"
     value="{{ $initCity }}">
     <input type="hidden" name="billing_postcode" id="billing_postcode"
     value="{{ $initPincode }}">
     <input type="hidden" name="billing_state" id="billing_state"
     value="{{ $initState }}">
     <input type="hidden" name="billing_phone" id="billing_phone"
     value="{{ $initPhone }}">
     <input type="hidden" name="billing_email" id="billing_email"
     value="{{ $initEmail }}">
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

     @php
         $subtotalWithTax = isset($checkoutSummary['items_total'])
             ? (float) $checkoutSummary['items_total']
             : (((float) ($checkoutSummary['subtotal'] ?? 0)) + ((float) ($checkoutSummary['tax_total'] ?? 0)));
         if ($subtotalWithTax <= 0 && isset($total)) {
             $subtotalWithTax = (float) $total;
         }
     @endphp
     <tr class="cart-subtotal bb-no">
     <td><b>Subtotal</b></td>
     <td class="product-total"><b style="white-space: nowrap;"><span style="font-family: Arial, sans-serif;">₹</span>{{ number_format($subtotalWithTax, 2) }}</b>
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
     <td><b>Delivery Charge</b></td>
     <td class="product-total">
         @if (($checkoutSummary['delivery_charge'] ?? 0) > 0)
             <b style="white-space: nowrap;"><span style="font-family: Arial, sans-serif;">₹</span>{{ number_format($checkoutSummary['delivery_charge'], 2) }}</b>
         @else
             <span style="display: inline-flex; align-items: center; white-space: nowrap;">
                 <span style="font-family: Arial, sans-serif; text-decoration: line-through; text-decoration-thickness: 1.8px; color: #64748b; font-size: 1.15rem; font-weight: 600; margin-right: 8px;">₹40.00</span>
                 <b style="color: #10b981; font-size: 1.15rem; font-weight: 700;">Free</b>
             </span>
         @endif
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
     <div class="accordion payment-accordion radio-type">
   
     <div class="card">
     <div class="card-header">
     <a href="#payment" class="collapse payment-option" data-method="onlinepayment">Online Payments</a>
     </div>
     <div id="payment" class="expanded">
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

     <div id="deliveryModal" class="modal fade" tabindex="-1" role="dialog" aria-hidden="true" style="display:none;">
     <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 620px; width: 95%;">
     <div class="modal-content" style="border-radius: 16px; border: none; overflow: hidden; box-shadow: 0 20px 45px rgba(0,0,0,0.18);">
     
     <div class="modal-header d-flex align-items-center justify-content-between" style="padding: 16px 24px; border-bottom: 1px solid #f1f5f9; background: #ffffff;">
     <h5 class="modal-title mb-0 font-weight-bold" id="deliveryModalTitle" style="color: #0f172a; font-size: 1.25rem;">
         {{ $shipping_addresses->count() > 0 ? 'Select Delivery Address' : 'Add Delivery Address' }}
     </h5>
     <button type="button" class="close m-0" aria-label="Close" id="close-delivery-modal" style="font-size: 1.6rem; color: #94a3b8; background: transparent; border: none;">
         <span aria-hidden="true">&times;</span>
     </button>
     </div>

     <div class="modal-body" style="padding: 20px 24px; max-height: 72vh; overflow-y: auto; background: #fafbfc;">
     
     {{-- 1. SAVED ADDRESSES VIEW --}}
     <div id="saved-addresses-view" style="{{ $shipping_addresses->count() > 0 ? '' : 'display: none;' }}">
         <div class="d-flex justify-content-between align-items-center mb-3">
             <span style="font-size: 0.85rem; font-weight: 700; color: #64748b; text-transform: uppercase; letter-spacing: 0.5px;">
                 Saved Addresses ({{ $shipping_addresses->count() }})
             </span>
             <button type="button" class="btn btn-primary btn-sm font-weight-bold" id="btn-show-add-address" style="border-radius: 6px; padding: 6px 14px; font-size: 0.82rem; display: inline-flex; align-items: center; gap: 5px;">
                 <i class="fas fa-plus" style="font-size: 10px !important; margin: 0 !important; line-height: 1 !important;"></i> Add New Address
             </button>
         </div>

         <div class="saved-address-list">
             @foreach($shipping_addresses as $addr)
             @php
                 $isThisSelected = ($defaultSavedAddress && $defaultSavedAddress->id == $addr->id);
             @endphp
             <div class="saved-address-card {{ $isThisSelected ? 'selected' : '' }}"
                  id="addr-card-{{ $addr->id }}"
                  data-id="{{ $addr->id }}"
                  data-name="{{ $addr->customer_firstname }}"
                  data-phone="{{ $addr->customer_mobileno }}"
                  data-email="{{ $addr->customer_email }}"
                  data-address="{{ $addr->customer_address }}"
                  data-city="{{ $addr->customer_city ?? '' }}"
                  data-state="{{ $addr->customer_state ?: 'Tamil Nadu' }}"
                  data-pincode="{{ $addr->customer_pincode }}"
                  data-country="India">
                 <div class="d-flex align-items-start">
                     <div class="addr-radio-wrap mr-3 pt-1">
                         <input type="radio" name="selected_saved_address" value="{{ $addr->id }}" {{ $isThisSelected ? 'checked' : '' }} style="width: 18px; height: 18px; cursor: pointer; accent-color: #0088dd;">
                     </div>
                     <div class="addr-info flex-grow-1">
                         <div class="d-flex align-items-center flex-wrap mb-1">
                             <span class="addr-name font-weight-bold mr-2" style="font-size: 0.98rem; color: #0f172a;">{{ $addr->customer_firstname }}</span>
                             <span class="addr-phone text-muted mr-2" style="font-size: 0.88rem; font-weight: 500;">{{ $addr->customer_mobileno }}</span>
                             @if($addr->is_default)
                                 <span class="badge badge-success text-white" style="font-size: 10px; padding: 2px 7px; border-radius: 4px; background: #10b981; font-weight: 600;">DEFAULT</span>
                             @endif
                         </div>
                         <div class="addr-fulltext mb-1" style="color: #475569; font-size: 0.88rem; line-height: 1.45;">
                             {{ $addr->customer_address }}@if($addr->customer_city), {{ $addr->customer_city }}@endif, {{ $addr->customer_state ?: 'Tamil Nadu' }} - <strong style="color: #1e293b;">{{ $addr->customer_pincode }}</strong>
                         </div>
                         @if($addr->customer_email)
                             <div class="addr-email small text-muted mb-2">
                                 <i class="far fa-envelope mr-1"></i> {{ $addr->customer_email }}
                             </div>
                         @endif
                         <div class="addr-action-box mt-2">
                             <button type="button" class="btn btn-primary btn-sm btn-deliver-here" style="font-weight: 700; border-radius: 6px; padding: 6px 16px; font-size: 0.8rem; letter-spacing: 0.3px;">
                                 DELIVER TO THIS ADDRESS
                             </button>
                         </div>
                     </div>
                 </div>
             </div>
             @endforeach
         </div>
     </div>

     {{-- 2. ADD NEW ADDRESS FORM VIEW --}}
     <div id="add-address-view" style="{{ $shipping_addresses->count() > 0 ? 'display: none;' : '' }}">
         <div class="d-flex justify-content-between align-items-center mb-3">
             <span style="font-size: 0.95rem; font-weight: 700; color: #0f172a;">
                 Add New Delivery Address
             </span>
             @if($shipping_addresses->count() > 0)
             <button type="button" class="btn btn-link btn-sm text-primary p-0" id="btn-back-to-saved" style="font-weight: 600; text-decoration: none;">
                 <i class="fas fa-arrow-left mr-1"></i> Back to Saved Addresses
             </button>
             @endif
         </div>

         <div class="row gutter-sm">
         <div class="col-sm-6">
         <div class="form-group">
         <label>First name *</label>
         <input type="text" class="form-control form-control-md"
         id="modal_billing_first_name"
         value="" required>
         </div>
         </div>
         <div class="col-sm-6">
         <div class="form-group">
         <label>Last name</label>
         <input type="text" class="form-control form-control-md"
         id="modal_billing_last_name"
         value="">
         </div>
         </div>
         </div>

         <div class="row gutter-sm">
         <div class="col-md-6">
         <div class="form-group">
         <label>Country / Region *</label>
         <div class="select-box">
         <select id="modal_billing_country" class="form-control form-control-md">
         <option value="India" selected>India</option>
         </select>
         </div>
         </div>
         </div>
         <div class="col-md-6">
         <div class="form-group">
         <label>Street address *</label>
         <input type="text" placeholder="House number and street name" class="form-control form-control-md" id="modal_billing_address" value="" required>
         <input type="hidden" id="modal_billing_address_2" value="">
         </div>
         </div>
         </div>

         <div class="row gutter-sm">
         <div class="col-md-4">
         <div class="form-group">
         <label>Town / City *</label>
         <input type="text" class="form-control form-control-md"
         id="modal_billing_city" value="" required>
         </div>
         </div>
         <div class="col-md-4">
         <div class="form-group">
         <label>State *</label>
         <input type="text" class="form-control form-control-md"
         id="modal_billing_state" value="Tamil Nadu" readonly style="background-color: #f8f9fa;" required>
         </div>
         </div>
         <div class="col-md-4">
         <div class="form-group">
         <label>ZIP *</label>
         <input type="text" class="form-control form-control-md"
         id="modal_billing_postcode" value="" required>
         </div>
         </div>
         </div>

         <div class="row gutter-sm">
         <div class="col-md-6">
         <div class="form-group mb-3">
         <label>Phone *</label>
         <input type="text" class="form-control form-control-md"
         id="modal_billing_phone" value="" maxlength="10" inputmode="numeric"
         oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);" required>
         </div>
         </div>
         <div class="col-md-6">
         <div class="form-group mb-3">
         <label>Email address *</label>
         <input type="email" class="form-control form-control-md" id="modal_billing_email"
         value="" required>
         </div>
         </div>
         </div>

         <div class="mt-2 text-right">
             <button type="button" class="btn btn-primary" id="save-delivery-address" style="border-radius: 6px; font-weight: 600; padding: 10px 24px;">
                 Save & Deliver Here
             </button>
         </div>
     </div>

     </div>

     <div class="modal-footer" style="padding: 12px 24px; border-top: 1px solid #f1f5f9; background: #ffffff;">
     <button type="button" class="btn btn-outline-secondary" id="cancel-delivery-modal" style="border-radius: 6px; font-weight: 600;">Close</button>
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

     #deliveryModal .form-group label,
     #deliveryModal label {
         font-weight: 600;
         font-size: 0.85rem;
         color: #2b3445 !important;
         margin-bottom: 8px;
         display: block;
         text-transform: uppercase;
         letter-spacing: 0.5px;
     }

     #deliveryModal .form-control {
         border: 1px solid #cbd5e1;
         border-radius: 8px;
         padding: 12px 14px;
         font-size: 0.95rem;
         color: #1e293b;
         font-weight: 500;
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

     /* Saved Address Cards - Flipkart / Modern E-commerce UI */
     .saved-address-card {
         border: 1.5px solid #e2e8f0;
         border-radius: 12px;
         padding: 16px 18px;
         margin-bottom: 12px;
         cursor: pointer;
         background: #ffffff;
         transition: all 0.2s ease;
         position: relative;
     }
     .saved-address-card:hover {
         border-color: #93c5fd;
         background: #f8fafc;
     }
     .saved-address-card.selected {
         border-color: #0088dd;
         background: #f0f9ff;
         box-shadow: 0 4px 14px rgba(0, 136, 221, 0.12);
     }
     .saved-address-card .btn-deliver-here {
         display: none;
     }
     .saved-address-card.selected .btn-deliver-here {
         display: inline-block;
     }
     .saved-address-card input[type="radio"] {
         width: 18px;
         height: 18px;
         cursor: pointer;
         accent-color: #0088dd;
     }
     .saved-address-list {
         max-height: 52vh;
         overflow-y: auto;
         padding-right: 4px;
     }
     .saved-address-list::-webkit-scrollbar {
         width: 6px;
     }
     .saved-address-list::-webkit-scrollbar-thumb {
         background: #cbd5e1;
         border-radius: 4px;
     }

     /* Action Buttons */
     #deliveryModal .modal-footer .btn {
         border-radius: 8px;
         padding: 10px 24px;
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

     #deliveryModal #btn-show-add-address {
         display: inline-flex !important;
         align-items: center !important;
         gap: 5px !important;
     }

     #deliveryModal #btn-show-add-address i {
         font-size: 10px !important;
         margin: 0 !important;
         line-height: 1 !important;
     }
     </style>

     <script>
         (function() {
             var changeBtn = document.getElementById('change-delivery-address');
             var modal = document.getElementById('deliveryModal');
             var modalTitle = document.getElementById('deliveryModalTitle');
             var closeBtn = document.getElementById('close-delivery-modal');
             var cancelBtn = document.getElementById('cancel-delivery-modal');
             var summary = document.getElementById('delivery-summary');
             var form = document.querySelector('.checkout-form');
             var backdrop = document.getElementById('deliveryModalBackdrop');

             var savedView = document.getElementById('saved-addresses-view');
             var addView = document.getElementById('add-address-view');
             var btnShowAdd = document.getElementById('btn-show-add-address');
             var btnBackToSaved = document.getElementById('btn-back-to-saved');
             var saveBtn = document.getElementById('save-delivery-address');

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
                     fields.address.value &&
                     fields.postcode.value &&
                     fields.phone.value
                 );
             }

             function renderSummary() {
                 if (!summary) return;
                 if (!hasAddress()) {
                     summary.innerHTML = '<span class="text-muted">No delivery address selected. Click Add / Change to choose an address.</span>';
                     return;
                 }

                 var name = (fields.firstName.value + (fields.lastName.value ? ' ' + fields.lastName.value : '')).trim();
                 var addressLine = fields.address.value;
                 var address2 = (fields.address2 && fields.address2.value) ? ', ' + fields.address2.value : '';
                 var cityLine = (fields.city.value ? fields.city.value + ', ' : '') + fields.state.value + ' - ' + fields.postcode.value;
                 var phoneLine = fields.phone.value;
                 var emailLine = fields.email.value ? fields.email.value : '';

                 summary.innerHTML =
                     '<div class="d-flex align-items-center mb-1">' +
                         '<strong style="font-size: 1.05rem; color: #0f172a;" class="mr-2">' + name + '</strong>' +
                         '<span class="badge badge-light text-dark font-weight-bold" style="border: 1px solid #cbd5e1; font-size: 0.8rem; padding: 3px 8px; border-radius: 4px;">' + phoneLine + '</span>' +
                     '</div>' +
                     '<div style="color: #475569; font-size: 0.92rem; line-height: 1.45;">' + addressLine + address2 + '</div>' +
                     '<div style="color: #475569; font-size: 0.92rem; font-weight: 500;">' + cityLine + '</div>' +
                     '<div style="color: #64748b; font-size: 0.88rem;">' + (fields.country.value || 'India') + '</div>' +
                     (emailLine ? '<div class="small text-muted mt-1"><i class="far fa-envelope mr-1"></i> ' + emailLine + '</div>' : '');
             }

             function selectSavedCard(cardEl) {
                 if (!cardEl) return;
                 document.querySelectorAll('.saved-address-card').forEach(function(c) {
                     c.classList.remove('selected');
                     var r = c.querySelector('input[type="radio"]');
                     if (r) r.checked = false;
                 });
                 cardEl.classList.add('selected');
                 var radio = cardEl.querySelector('input[type="radio"]');
                 if (radio) radio.checked = true;
             }

             function applyAddressData(data) {
                 fields.firstName.value = data.name || '';
                 fields.lastName.value = data.lastName || '';
                 fields.phone.value = data.phone || '';
                 fields.email.value = data.email || '';
                 fields.address.value = data.address || '';
                 fields.city.value = data.city || data.state || 'Tamil Nadu';
                 fields.state.value = data.state || 'Tamil Nadu';
                 fields.postcode.value = data.pincode || '';
                 fields.country.value = data.country || 'India';

                 renderSummary();
                 persistToStorage();
                 closeModal();
             }

             // Click listeners on saved address cards
             document.querySelectorAll('.saved-address-card').forEach(function(card) {
                 card.addEventListener('click', function(e) {
                     selectSavedCard(this);
                     // If clicked "DELIVER TO THIS ADDRESS" button or double-clicked, apply immediately
                     if (e.target.closest('.btn-deliver-here')) {
                         e.stopPropagation();
                         applyAddressData(this.dataset);
                     }
                 });
             });

             if (btnShowAdd) {
                 btnShowAdd.addEventListener('click', function() {
                     if (savedView) savedView.style.display = 'none';
                     if (addView) addView.style.display = 'block';
                     if (modalTitle) modalTitle.textContent = 'Add New Delivery Address';
                     if (modalFields.firstName) modalFields.firstName.value = '';
                     if (modalFields.lastName) modalFields.lastName.value = '';
                     if (modalFields.address) modalFields.address.value = '';
                     if (modalFields.city) modalFields.city.value = '';
                     if (modalFields.state) modalFields.state.value = 'Tamil Nadu';
                     if (modalFields.postcode) modalFields.postcode.value = '';
                     if (modalFields.phone) modalFields.phone.value = '';
                     if (modalFields.email) modalFields.email.value = '';
                 });
             }

             if (btnBackToSaved) {
                 btnBackToSaved.addEventListener('click', function() {
                     if (addView) addView.style.display = 'none';
                     if (savedView) savedView.style.display = 'block';
                     if (modalTitle) modalTitle.textContent = 'Select Delivery Address';
                 });
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
                 } catch (e) {}
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
                     fields.state.value = data.state || fields.state.value || 'Tamil Nadu';
                     fields.phone.value = data.phone || fields.phone.value;
                     fields.email.value = data.email || fields.email.value;
                 } catch (e) {}
             }

             function openModal() {
                 if (!modal) return;
                 if (!backdrop) backdrop = document.getElementById('deliveryModalBackdrop');
                 
                 // Show saved addresses view if cards exist, else add view
                 var hasCards = document.querySelectorAll('.saved-address-card').length > 0;
                 if (hasCards) {
                     if (savedView) savedView.style.display = 'block';
                     if (addView) addView.style.display = 'none';
                     if (modalTitle) modalTitle.textContent = 'Select Delivery Address';
                 } else {
                     if (savedView) savedView.style.display = 'none';
                     if (addView) addView.style.display = 'block';
                     if (modalTitle) modalTitle.textContent = 'Add Delivery Address';
                 }

                 modal.style.display = 'block';
                 if (backdrop) backdrop.style.display = 'block';
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

             if (changeBtn) {
                 changeBtn.addEventListener('click', function() {
                     if (!isLoggedIn) {
                         if (typeof showLoginPopup === 'function') {
                             showLoginPopup('{{ route('checkoutPage') }}');
                         }
                         return;
                     }
                     openModal();
                 });
             }

             if (closeBtn) closeBtn.addEventListener('click', closeModal);
             if (cancelBtn) cancelBtn.addEventListener('click', closeModal);
             if (backdrop) backdrop.addEventListener('click', closeModal);

             // Save new address from modal form
             if (saveBtn) {
                 saveBtn.addEventListener('click', function() {
                     var requiredModalFields = [
                         modalFields.firstName,
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

                     if (invalid) return;

                     var phoneVal = modalFields.phone.value.trim();
                     if (!/^[0-9]{10}$/.test(phoneVal)) {
                         modalFields.phone.setCustomValidity('Please enter a valid 10-digit mobile number');
                         modalFields.phone.reportValidity();
                         return;
                     } else {
                         modalFields.phone.setCustomValidity('');
                     }

                     var newAddressData = {
                         name: modalFields.firstName.value.trim() + (modalFields.lastName.value.trim() ? ' ' + modalFields.lastName.value.trim() : ''),
                         phone: modalFields.phone.value.trim(),
                         email: modalFields.email.value.trim(),
                         address: modalFields.address.value.trim(),
                         city: modalFields.city.value.trim() || modalFields.state.value.trim() || 'Tamil Nadu',
                         state: modalFields.state.value.trim() || 'Tamil Nadu',
                         pincode: modalFields.postcode.value.trim(),
                         country: modalFields.country.value || 'India'
                     };

                     applyAddressData(newAddressData);

                     // Save to backend API asynchronously
                     if (isLoggedIn) {
                         var formData = new FormData();
                         formData.append('customer_firstname', newAddressData.name);
                         formData.append('customer_mobileno', newAddressData.phone);
                         formData.append('customer_email', newAddressData.email);
                         formData.append('customer_address', newAddressData.address);
                         formData.append('customer_city', newAddressData.city);
                         formData.append('customer_state', newAddressData.state);
                         formData.append('customer_pincode', newAddressData.pincode);

                         fetch("{{ route('save-shipping-address') }}", {
                             method: 'POST',
                             headers: {
                                 'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                 'Accept': 'application/json'
                             },
                             body: formData
                         }).catch(function() {});
                     }
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
                     
                     var activeOpt = document.querySelector('.payment-option.collapse');
                     if (activeOpt && activeOpt.getAttribute('data-method')) {
                         document.getElementById('payment_method_input').value = activeOpt.getAttribute('data-method');
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
                             "name": "Trymenow Store",
                             "description": "Order Payment",
                             "webview_intent": /iPhone|iPad|iPod|Android/i.test(navigator.userAgent),
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
                     document.querySelectorAll('.payment-option').forEach(function(opt) {
                         opt.classList.remove('collapse');
                         opt.classList.add('expand');
                     });
                     this.classList.remove('expand');
                     this.classList.add('collapse');
                     document.getElementById('payment_method_input').value = this.getAttribute('data-method');
                 });
             });

             document.querySelectorAll('.payment-accordion .card-header').forEach(function(header) {
                 header.addEventListener('click', function(e) {
                     var opt = this.querySelector('.payment-option');
                     if (opt) {
                         document.querySelectorAll('.payment-option').forEach(function(o) {
                             o.classList.remove('collapse');
                             o.classList.add('expand');
                         });
                         opt.classList.remove('expand');
                         opt.classList.add('collapse');
                         var method = opt.getAttribute('data-method') || 'Cash On Delivery';
                         document.getElementById('payment_method_input').value = method;
                     }
                 });
             });

             // Ensure Online Payments radio dot is active by default
             var currentMethod = document.getElementById('payment_method_input').value || 'onlinepayment';
             var defaultOpt = document.querySelector('.payment-option[data-method="' + currentMethod + '"]') || document.querySelector('.payment-option[data-method="onlinepayment"]');
             if (defaultOpt) {
                 document.querySelectorAll('.payment-option').forEach(function(opt) {
                     opt.classList.remove('collapse');
                     opt.classList.add('expand');
                 });
                 defaultOpt.classList.remove('expand');
                 defaultOpt.classList.add('collapse');
                 document.getElementById('payment_method_input').value = defaultOpt.getAttribute('data-method');
             }


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
             if (!fields.state.value) {
                 fields.state.value = 'Tamil Nadu';
             }
             if (!modalFields.state.value) {
                 modalFields.state.value = 'Tamil Nadu';
             }
             renderSummary();
         })();
     </script>

 @endsection
