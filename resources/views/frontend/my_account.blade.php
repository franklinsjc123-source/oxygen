   @extends('app_template')
   @section('title','My Account')
   @section('content')


   <style>
    /* .form-group {
        position: relative;
    }

    .toggle-password {
        position: absolute;
        right: 12px;
        top: 38px;
        cursor: pointer;
        color: #666;
        font-size: 16px;
    }

    @media (max-width: 768px) {
        .toggle-password {
            right: 10px;
            top: 36px;
            font-size: 18px;
        }
    } */


    .shop-footer{
        height: 69px !important;
    }
    .shop-details-ps-image{
            height: 65px;
            /* margin-top: 12px; */
    }
    .order-summary-row {
        cursor: pointer;
    }
    .order-details-row {
        display: none;
        background: #fafafa;
    }
    .order-details-card {
        border: 1px solid #e8e8e8;
        border-radius: 8px;
        padding: 12px;
        margin-bottom: 12px;
        background: #fff;
    }
    .order-product-item {
        display: flex;
        align-items: center;
        gap: 10px;
        margin-bottom: 10px;
        padding-bottom: 10px;
        border-bottom: 1px dashed #ececec;
    }
    .order-product-item:last-child {
        margin-bottom: 0;
        padding-bottom: 0;
        border-bottom: 0;
    }
    .order-product-thumb {
        width: 58px;
        height: 58px;
        border-radius: 6px;
        object-fit: cover;
        background: #f0f0f0;
    }
    #account-orders .account-orders-table {
        width: 100%;
        table-layout: fixed;
    }
    #account-orders .account-orders-table thead th,
    #account-orders .account-orders-table tbody td {
        text-align: left;
        vertical-align: middle;
        padding: 12px 10px;
    }
    #account-orders .account-orders-table thead th:last-child,
    #account-orders .account-orders-table tbody td:last-child {
        text-align: center;
    }
    #account-orders .account-orders-table .order-details-row td {
        text-align: left !important;
    }
    #account-orders .account-orders-table .order-id { width: 22%; }
    #account-orders .account-orders-table .order-date { width: 20%; }
    #account-orders .account-orders-table .order-status { width: 18%; }
    #account-orders .account-orders-table .order-total { width: 20%; }
    #account-orders .account-orders-table .order-actions { width: 20%; }
    .account-dashboard-grid .icon-box {
        border: 1px solid #e8e8e8;
        border-radius: 6px;
        padding: 16px 10px;
        min-height: 90px;
        transition: all .2s ease;
        background: #fff;
    }
    .account-dashboard-grid .icon-box:hover {
        border-color: #cfd8dc;
        box-shadow: 0 4px 14px rgba(0,0,0,.06);
    }
    .account-back-wrap {
        display: flex;
        justify-content: flex-start;
        margin-bottom: 16px;
    }
    .account-back-btn {
        border-radius: 20px;
        padding: 7px 14px;
    }
    </style>

   <main class="main">
       <!-- Start of Page Header -->
       <div class="page-header">
           <div class="container">
               <h1 class="page-title mb-0">My Account</h1>
           </div>
       </div>
       <!-- End of Page Header -->

       <!-- Start of Breadcrumb -->
       <nav class="breadcrumb-nav">
           <div class="container">
               <ul class="breadcrumb">
                   <li><a href="demo1.html">Home</a></li>
                   <li>My account</li>
               </ul>
           </div>
       </nav>
       <!-- End of Breadcrumb -->

       <!-- Start of PageContent -->
       <div class="page-content pt-2">
           <div class="container">
               <div class="tab tab-vertical">
                   <div class="tab-content mb-6">
                       <div class="tab-pane active in" id="account-dashboard">
                           <div class="row account-dashboard-grid">
                               <div class="col-lg-3 col-md-6 col-sm-4 col-xs-6 mb-4">
                                   <a href="#account-orders" data-bs-toggle="tab" class="dashboard-option">
                                       <div class="icon-box text-center">
                                           <span class="icon-box-icon icon-orders">
                                               <i class="w-icon-orders"></i>
                                           </span>
                                           <div class="icon-box-content">
                                               <p class="text-uppercase mb-0">Orders</p>
                                           </div>
                                       </div>
                                   </a>
                               </div>
                               <div class="col-lg-3 col-md-6 col-sm-4 col-xs-6 mb-4">
                                   <a href="#account-downloads" data-bs-toggle="tab" class="dashboard-option">
                                       <div class="icon-box text-center">
                                           <span class="icon-box-icon icon-download">
                                               <i class="w-icon-wallet"></i>
                                           </span>
                                           <div class="icon-box-content">
                                               <p class="text-uppercase mb-0">Wallet</p>
                                           </div>
                                       </div>
                                   </a>
                               </div>
                               <div class="col-lg-3 col-md-6 col-sm-4 col-xs-6 mb-4">
                                   <a href="#account-addresses" data-bs-toggle="tab" class="dashboard-option">
                                       <div class="icon-box text-center">
                                           <span class="icon-box-icon icon-address">
                                               <i class="w-icon-map-marker"></i>
                                           </span>
                                           <div class="icon-box-content">
                                               <p class="text-uppercase mb-0">Addresses</p>
                                           </div>
                                       </div>
                                   </a>
                               </div>
                               <div class="col-lg-3 col-md-6 col-sm-4 col-xs-6 mb-4">
                                   <a href="#profile-details" data-bs-toggle="tab" class="dashboard-option">
                                       <div class="icon-box text-center">
                                           <span class="icon-box-icon icon-account">
                                               <i class="w-icon-user"></i>
                                           </span>
                                           <div class="icon-box-content">
                                               <p class="text-uppercase mb-0">profile  Details</p>
                                           </div>
                                       </div>
                                   </a>
                               </div>
                               <div class="col-lg-3 col-md-6 col-sm-4 col-xs-6 mb-4">
                                   <a href="#account-details" data-bs-toggle="tab" class="dashboard-option">
                                       <div class="icon-box text-center">
                                           <span class="icon-box-icon icon-account">
                                               <i class="w-icon-tools"></i>
                                           </span>
                                           <div class="icon-box-content">
                                               <p class="text-uppercase mb-0">Account Settings</p>
                                           </div>
                                       </div>
                                   </a>
                               </div>
                               <div class="col-lg-3 col-md-6 col-sm-4 col-xs-6 mb-4">
                                   <a href="#wishlist" data-bs-toggle="tab" class="dashboard-option">
                                       <div class="icon-box text-center">
                                           <span class="icon-box-icon icon-wishlist">
                                               <i class="w-icon-heart"></i>
                                           </span>
                                           <div class="icon-box-content">
                                               <p class="text-uppercase mb-0">Wishlist</p>
                                           </div>
                                       </div>
                                   </a>
                               </div>
                               <div class="col-lg-3 col-md-6 col-sm-4 col-xs-6 mb-4">
                                   <a href="{{ route('customer-logout') }}">
                                       <div class="icon-box text-center">
                                           <span class="icon-box-icon icon-logout">
                                               <i class="w-icon-logout"></i>
                                           </span>
                                           <div class="icon-box-content">
                                               <p class="text-uppercase mb-0">Logout</p>
                                           </div>
                                       </div>
                                   </a>
                               </div>
                           </div>
                       </div>

                       <div class="tab-pane mb-4" id="account-orders">
                           <div class="account-back-wrap mt-5" style="float:right" >
                               <a  href="#account-dashboard" data-bs-toggle="tab" class="btn btn-outline btn-default btn-sm account-back-btn back-to-dashboard">Back </a>
                           </div>
                           <center><h3>Orders</h3></center>

                           <table class="shop-table account-orders-table mb-6">
                               <thead>
                                   <tr>
                                       <th class="order-id">Order</th>
                                       <th class="order-date">Date</th>
                                       <th class="order-status">Status</th>
                                       <th class="order-total">Total</th>
                                       <th class="order-actions">Actions</th>
                                   </tr>
                               </thead>
                               <tbody>
                                    @if($orderdata->count() > 0)
                                        @foreach($orderdata as $order)
                                            <tr class="order-summary-row" onclick="toggleOrderDetails('{{ $order->id }}')">
                                                <td class="order-id">#{{ $order->order_id }}</td>
                                                <td class="order-date">{{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}</td>
                                                <td class="order-status">{{ $order->order_status }}</td>
                                                <td class="order-total"><span class="order-price">Rs. {{ number_format($order->grand_total, 2) }}</span></td>
                                                <td class="order-action">
                                                    <a href="javascript:void(0)" class="btn btn-outline btn-default btn-block btn-sm btn-rounded">
                                                        View Details
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr id="order-details-{{ $order->id }}" class="order-details-row">
                                                <td colspan="5">
                                                    @foreach($order->invoice_details as $invoice)
                                                        <div class="order-details-card">
                                                            <div class="d-flex justify-content-between align-items-center mb-2">
                                                                <div>
                                                                    <b>Invoice:</b> {{ $invoice->invoice_id }}<br>
                                                                    <b>Status:</b> {{ $invoice->status }}<br>
                                                                    <b>Qty:</b> {{ $invoice->line_qty ?? 1 }} |
                                                                    <b>Tax:</b> Rs. {{ number_format($invoice->tax_amount ?? 0, 2) }}
                                                                </div>
                                                                <div class="text-right"><b>Amount:</b> Rs. {{ number_format($invoice->line_amount, 2) }}</div>
                                                            </div>
                                                            @if(isset($invoice->products) && count($invoice->products) > 0)
                                                                @foreach($invoice->products as $product)
                                                                    @php
                                                                        $productImage = $product->product_image ?? '';
                                                                        $productImageUrl = $productImage !== '' ? asset('assets/images/products/detail/' . $productImage) : asset('frontend/images/demos/demo1/products/1-1.jpg');
                                                                    @endphp
                                                                    <div class="order-product-item">
                                                                        <img src="{{ $productImageUrl }}" alt="{{ $product->product_name }}" class="order-product-thumb">
                                                                        <div>
                                                                            <div><b>{{ $product->product_name }}</b></div>
                                                                            @if(!empty($product->product_size) || !empty($product->product_color))
                                                                                <div>Size: {{ $product->product_size ?: '-' }} | Color: {{ $product->product_color ?: '-' }}</div>
                                                                            @endif
                                                                            <div>Price: Rs. {{ number_format($product->product_price, 2) }}</div>
                                                                        </div>
                                                                    </div>
                                                                @endforeach
                                                            @endif
                                                            <div class="d-flex justify-content-end gap-2 mt-2">
                                                                @if(!empty($invoice->can_cancel))
                                                                    <form method="POST" action="{{ route('my-account.invoice.cancel', $invoice->invoice_id) }}" onsubmit="return confirm('Cancel this order item?');">
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-outline btn-danger btn-sm btn-rounded">Cancel</button>
                                                                    </form>
                                                                @endif
                                                                @if(!empty($invoice->can_return))
                                                                    <form method="POST" action="{{ route('my-account.invoice.return', $invoice->invoice_id) }}" onsubmit="return confirm('Raise return request for this item?');">
                                                                        @csrf
                                                                        <button type="submit" class="btn btn-outline btn-primary btn-sm btn-rounded">Return</button>
                                                                    </form>
                                                                @elseif(!empty($invoice->return_deadline))
                                                                    <small class="text-muted align-self-center">Return till {{ $invoice->return_deadline }}</small>
                                                                @endif
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                    <div class="text-right">
                                                        <a href="{{ url('invoice-pdf/'.$order->id) }}" class="btn btn-dark btn-rounded btn-sm" target="_blank">
                                                            Download Invoice
                                                        </a>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center">No orders found</td>
                                        </tr>
                                    @endif
                                </tbody>
                           </table>

                           <a href="{{ url('shops') }}" class="btn btn-dark btn-rounded btn-icon-right">Go
                               Shop<i class="w-icon-long-arrow-right"></i></a>
                       </div>

                       <div class="tab-pane" id="account-downloads">
                            <div class="account-back-wrap" style="float:right" >
                                <a href="#account-dashboard" data-bs-toggle="tab" class="btn btn-outline btn-default btn-sm account-back-btn back-to-dashboard">Back</a>
                            </div>
                         
                            <center><h3>Wallet</h3></center>

                            <h2>Wallet Balance : 200</h2>

                               <table class="shop-table account-orders-table mb-6">
                               <thead>
                                   <tr>
                                       <th class="order-id">Order</th>
                                       <th class="order-date">Date</th>
                                       <th class="order-status">Status</th>
                                       <th class="order-total">Total</th>
                                       <th class="order-actions">Actions</th>
                                   </tr>
                               </thead>
                               <tbody>
                                   <tr>
                                       <td class="order-id">#2321</td>
                                       <td class="order-date">August 20, 2021</td>
                                       <td class="order-status">Processing</td>
                                       <td class="order-total">
                                           <span class="order-price">$121.00</span> for
                                           <span class="order-quantity"> 1</span> item
                                       </td>
                                       <td class="order-action">
                                           <a href="#"
                                               class="btn btn-outline btn-default btn-block btn-sm btn-rounded">View</a>
                                       </td>
                                   </tr>
                              
                               </tbody>
                           </table>
                          
                           
                       </div>

                       <div class="tab-pane" id="account-addresses">
                           <div class="account-back-wrap" style="float:right" >
                               <a href="#account-dashboard" data-bs-toggle="tab" class="btn btn-outline btn-default btn-sm account-back-btn back-to-dashboard">Back</a>
                           </div>
                          
                           <center><h3>Addresses</h3></center>

                            <p>
                                The following addresses will be used on the checkout page
                                by   <input type="checkbox" checked disabled> default.
                            </p>

                           <div class="row">
                               <div class="col-sm-6 mb-6">
                                   <div class="ecommerce-address billing-address pr-lg-8">

                                    @forelse($shipping_address as $key => $address)
                                    <div class="card mb-3 address-card "
                                        onclick="showAddress(this)"
                                        data-id="{{ $address->id }}"
                                        data-name="{{ $address->customer_firstname }}"
                                        data-mobile="{{ $address->customer_mobileno }}"
                                        data-address="{{ $address->customer_address }}"
                                        data-state="{{ $address->customer_state }}"
                                        data-pincode="{{ $address->customer_pincode }}"
                                        data-email="{{ $address->customer_email }}"
                                        style="cursor:pointer;">

                                         <div class="default-checkbox">
                                                <input type="checkbox"
                                                    {{ $address->is_default ? 'checked' : '' }}
                                                    onclick="setDefaultAddress(event, {{ $address->id }})">
                                            </div>
                                        
                                        <div class="card-body">
                                            <h6 class="mb-1">{{ $address->customer_firstname }}</h6>
                                            <p class="mb-0 small">
                                                {{ $address->customer_address }}<br>
                                                {{ $address->customer_state }}<br>
                                                {{ $address->customer_mobileno }}
                                            </p>
                                        </div>
                                    </div>
                                @empty
                                    <p>No shipping addresses found.</p>
                                @endforelse
                                    
                                   </div>
                               </div>
                            <div class="col-sm-6 mb-6">
                                <div class="ecommerce-address shipping-address pr-lg-8">
                                   <div class="d-flex justify-content-between align-items-center mb-3">
                                        <h4 id="address-title" class="title title-underline ls-25 font-weight-bold mb-0">
                                            Add Shipping Address
                                        </h4>

                                        <button type="button"
                                                id="addNewAddressBtn"
                                                class="btn submit-button btn-primary btn-sm">
                                            Add Address
                                        </button>
                                    </div>

                                     

                                    <form method="POST" id="addressForm"     action="{{ route('save-shipping-address') }}">
                                        @csrf

                                        <input type="hidden" name="address_id" id="address_id">

                                        <div class="mb-2">
                                            <label>Name</label>
                                            <input type="text" name="customer_firstname" id="customer_firstname"
                                                class="form-control">
                                        </div>

                                        <div class="mb-2">
                                            <label>Mobile</label>
                                            <input type="text" name="customer_mobileno" id="customer_mobileno"
                                                class="form-control">
                                        </div>
                                           <div class="mb-2">
                                            <label>Email</label>
                                            <input type="text" name="customer_email" id="customer_email"
                                                class="form-control">
                                        </div>

                                        <div class="mb-2">
                                            <label>Address</label>
                                            <textarea name="customer_address" id="customer_address"
                                                    class="form-control"></textarea>
                                        </div>

                                        <div class="mb-2">
                                            <label>State</label>
                                            <input type="text" name="customer_state" id="customer_state"
                                                class="form-control">
                                        </div>

                                        <div class="mb-2">
                                            <label>Pincode</label>
                                            <input type="text" name="customer_pincode" id="customer_pincode"
                                                class="form-control">
                                        </div>


                                         <div class="d-flex justify-content-between align-items-center mb-3">
                                     <button type="submit"  id="submitBtn"  class="btn submit-button btn-primary btn-sm mt-2">
                                            Add Address
                                        </button>

                                       <button type="button" id="deleteBtn"
                                             style="background-color: rgb(214, 47, 47) ; color:#fff" class="btn submit-button btn-danger btn-sm mt-2 d-none">
                                            Delete Address
                                        </button>
                                    </div>

                                    </form>
                                </div>
                            </div>

                           </div>
                       </div>
                       <div class="tab-pane" id="profile-details">
                          <div class="account-back-wrap" style="float:right">
                              <a href="#account-dashboard" data-bs-toggle="tab" class="btn btn-outline btn-default btn-sm account-back-btn back-to-dashboard">Back</a>
                          </div>
                           
                          <center><h3>Profile Details</h3></center> 

                           <form action="{{url('/updateaddress')}}" name="frm-login" method="post" autocomplete="Off" class="checkout-form" onsubmit="return confirm('Do you  want to Change Billing Address?');">
                               {{ csrf_field() }}
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
                                       <input type="text" class="form-control" id="city" name="customer_city" required="" value="{{@$customer->customer_city}}" />
                                   </div>
                                   <div class="col-xs-6">
                                       <label>State *</label>
                                       <input type="text" class="form-control" id="state" name="customer_state" required="" value="{{@$customer->customer_state}}" />
                                   </div>
                               </div>
                               <label>Email Address *</label>
                               <input type="email" class="form-control" name="customer_email" required="" value="{{@$customer->customer_email}}" />

                               <br>
                               <div class="login-on-checkout">
                                   <p class="form-row">
                                       <button type="submit" name="btn-sbmt" class="btn">SAVE CHANGES</button>
                                   </p>
                           </form>
                       </div>

                      
                   </div>

                    <div class="tab-pane" id="account-details">                           
                        <div class="account-back-wrap" style="float:right">
                            <a href="#account-dashboard" data-bs-toggle="tab" class="btn btn-outline btn-default btn-sm account-back-btn back-to-dashboard">Back</a>
                        </div>
                        <center><h3>Account Details</h3></center> 
                        <div class="row">
                            <form id="changePasswordForm"  action="{{url('/change-customer-password')}}" method="post" name="frm-login" autocomplete="Off" class="checkout-form" >
                            {{ csrf_field() }}
                            <fieldset style="padding:20px;">
                                <legend>Password Change</legend>
                                <div class="form-group col-md-8  mt-2" >

                                    <label>Current password </label>
                                    <input type="password" class="form-control" id="customer_opassword"  name="current_password" required value="">
                                      <i class="fa-solid fa-eye toggle-password-1"
                                      onclick="togglePasswordAccount('customer_opassword', this)"
                                            style="position:absolute; right:360px; margin-top:-30px; cursor:pointer;">
                                    </i>
                                </div>
                                <div class="form-group col-md-8   mt-2">
                                    <label class="">New password</label>
                                    <input type="password" class="form-control "  id="customer_password" name="new_password" required>
                                    <i class="fa-solid fa-eye toggle-password-1"
                                    onclick="togglePasswordAccount('customer_password', this)"
                                            style="position:absolute; right:360px; margin-top:-30px; cursor:pointer;">
                                    </i>
                                </div>
                                <div class="form-group col-md-8  mt-2">
                                    <label>Confirm new password</label>
                                    <input type="password"  class="form-control" id="customer_cpassword" name="confirm_password" required>
                                    <i class="fa-solid fa-eye toggle-password-1"
                                    onclick="togglePasswordAccount('customer_cpassword', this)"
                                            style="position:absolute; right:360px; margin-top:-30px; cursor:pointer;">
                                    </i>
                                </div>

                            </fieldset>
                            <br>
                            <div class="login-on-checkout">
                                <p class="form-row">
                                    <button type="submit" name="btn btn-dark btn-rounded " class="btn">SAVE CHANGES</button>
                                </p>
                            </div>
                            </form>
                        </div>
                    </div>

                    <div class="tab-pane" id="wishlist">                           
                        <div class="account-back-wrap" style="float:right">
                            <a href="#account-dashboard" data-bs-toggle="tab" class="btn btn-outline btn-default btn-sm account-back-btn back-to-dashboard">Back</a>
                        </div>
                        <center><h3>Wishlist</h3></center> 
                        <div class="row">
                            <div class="page-content">
                                <div class="container">
                                    <table class="shop-table wishlist-table">
                                        <thead>
                                            <tr>
                                                <th class="product-name" style="text-align: center; width: 12%;"><span>Product</span></th>
                                                <th class="product-name" style="text-align: center; width: 33%;">Product Name</th>
                                                <th class="product-price" style="text-align: center; width: 15%;"><span>Price</span></th>
                                                <th class="product-stock-status" style="text-align: center; white-space: nowrap; width: 20%;"><span>Stock Availability</span></th>
                                                <th class="wishlist-action" style="text-align: center; width: 20%;">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @php $i=0; @endphp
                                                        @if($wishCount>0)
                                                        @foreach ($wishlist as $product)
                                                        @php  $i++; @endphp
                                                        
                                                        <tr>
                                                            <td style="text-align: center; vertical-align: middle;" >
                                                                <div class="p-relative"  >
                                                                    <a href="{{url('productVar',$product->ecom_product_id)}}">
                                                                    
                                                                            <img   src="{{ asset('assets/images/products/' . $product->product_image) }}"  alt="product" style="width:80px; height:80px; object-fit:contain; margin:0 auto;"
                                                                                >
                                                                    
                                                                    </a>
                                                                    {{-- <a   href="{{url('Delete_wishlist',$product->ecom_wishlist_id)}}" class="btn btn-close"><i
                                                                            class="fas fa-times"></i></a> --}}
                                                                </div>
                                                            </td>
                                                            <td style="text-align: center; vertical-align: middle;" class="product-name">
                                                                <a href="{{url('productVar',$product->ecom_product_id)}}">
                                                                {{ $product->product_name }}
                                                                </a>
                                                            </td>
                                                            <td  style="text-align: center; vertical-align: middle;" class="product-price"><ins class="new-price">Rs. {{ $product->selling_price }} <del><span class="currencySymbol">Rs.</span> {{ $product->retail_price }} </del></ins></td>
                                                            <td  style="text-align: center; vertical-align: middle; white-space: nowrap;" class="product-stock-status">
                                                                <span class="wishlist-in-stock">In Stock</span>
                                                            </td>
                                                            <td  style="text-align: center; vertical-align: middle;" class="wishlist-action">
                                                                <div style="display: flex; justify-content: center; gap: 10px; align-items: center; flex-wrap: wrap;">
                                                                    <a href="{{url('delete_wishlist',$product->ecom_wishlist_id)}}"
                                                                        class="btn btn-default btn-rounded btn-sm">Remove 
                                                                        </a>
                                                                    <a href="{{url('productVar',$product->ecom_product_id)}}" class="btn btn-dark btn-rounded btn-sm btn-cart">View</a>
                                                                </div>
                                                            </td>
                                                        </tr>
                                            
                                                        @endforeach
                                                        @else
                                                        <tr data-id="1">
                                                            <td colspan="5">
                                                                <center><i class="d-icon-bag"></i> Your Wishlist is Empty</center>
                                                            </td>
                                                        </tr>
                                                        @endif
                                                    
                                        </tbody>
                                    </table>
                                
                                </div>
                            </div>
                        </div>
                    </div>
                       
                   </div>
               </div>
           </div>
       </div>
       <!-- End of PageContent -->
   </main>


   
   <!-- End of Main -->
   @endsection

<script>
    function showAccountTab(target) {
        if (!target || target.charAt(0) !== '#') return;

        var pane = document.querySelector(target);
        if (!pane) return;

        if (window.bootstrap && bootstrap.Tab) {
            var toggle = document.querySelector('[data-bs-toggle="tab"][href="' + target + '"]');
            if (toggle) {
                bootstrap.Tab.getOrCreateInstance(toggle).show();
                return;
            }
        }

        document.querySelectorAll('.tab-content .tab-pane').forEach(function (el) {
            el.classList.remove('active', 'show', 'in');
        });
        pane.classList.add('active', 'show', 'in');
    }

    function toggleOrderDetails(orderId) {
        var row = document.getElementById('order-details-' + orderId);
        if (!row) return;
        row.style.display = row.style.display === 'table-row' ? 'none' : 'table-row';
    }

    function setDefaultAddress(e, addressId) {
        e.stopPropagation(); // prevent card click

        if (!confirm('Set this address as default?')) {
            e.target.checked = false;
            return;
        }

        fetch("{{ route('set-default-shipping-address') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ address_id: addressId })
        })
        .then(res => res.json())
        .then(data => {
            if (data.success) {
                swal("Success!", "Default address updated", "success")
                    .then(() => location.reload());
            }
        });
    }


    function showAddress(card) {

        // remove active from all cards
        document.querySelectorAll('.address-card').forEach(el => {
            el.classList.remove('active');
        });

        // add active to clicked card
        card.classList.add('active');

        // fill form values
        document.getElementById('address_id').value = card.dataset.id;
        document.getElementById('customer_firstname').value = card.dataset.name;
        document.getElementById('customer_mobileno').value = card.dataset.mobile;
        document.getElementById('customer_email').value = card.dataset.email;
        document.getElementById('customer_address').value = card.dataset.address;
        document.getElementById('customer_state').value = card.dataset.state;
        document.getElementById('customer_pincode').value = card.dataset.pincode;

        // update button
        const btn = document.getElementById('submitBtn');
        btn.innerText = 'Update Address';
        btn.classList.remove('btn-primary');
        btn.classList.add('btn-success');

        // update title
        document.getElementById('address-title').innerText = 'Edit Shipping Address';
        document.getElementById('deleteBtn').classList.remove('d-none');
    }

    document.addEventListener('DOMContentLoaded', function () {
        const hash = window.location.hash;
        if (hash) {
            showAccountTab(hash);
        }

        document.querySelectorAll('.dashboard-option, .back-to-dashboard, .link-to-tab').forEach(function (link) {
            link.addEventListener('click', function (e) {
                const target = this.getAttribute('href');
                if (!target || target.charAt(0) !== '#') {
                    return;
                }
                e.preventDefault();
                showAccountTab(target);
            });
        });


       document.getElementById('changePasswordForm').addEventListener('submit', function (e) {
    e.preventDefault(); // stop normal submit

    swal({
        title: "Are you sure?",
        text: "Do you want to change your password?",
        icon: "warning",
        buttons: ["No", "Yes, Change"],
        dangerMode: true,
    }).then(function (willChange) {
        if (willChange) {
            e.target.submit(); 
        }
    });
});




        document.getElementById('addNewAddressBtn').addEventListener('click', function () {

            // clear form
            document.getElementById('addressForm').reset();
            document.getElementById('address_id').value = '';

            // remove active cards
            document.querySelectorAll('.address-card').forEach(el => {
                el.classList.remove('active');
            });

            // reset submit button
            const btn = document.getElementById('submitBtn');
            btn.innerText = 'Add Address';
            btn.classList.remove('btn-success');
            btn.classList.add('btn-primary');

            // reset title
            document.getElementById('address-title').innerText = 'Add Shipping Address';
            document.getElementById('deleteBtn').classList.add('d-none');
            
        });


        document.getElementById('deleteBtn').addEventListener('click', function () {

        const addressId = document.getElementById('address_id').value;

        if (!addressId) {
            alert('Please select an address');
            return;
        }

        if (!confirm('Are you sure you want to delete this address?')) {
            return;
        }

        fetch("{{ route('delete-shipping-address') }}", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": "{{ csrf_token() }}"
            },
            body: JSON.stringify({ address_id: addressId })
        })
        .then(res => res.json())
        .then(data => {
            swal({
                title: "Success!",
                text: "Address deleted successfully",
                icon: "success",
                button: "OK",
            }).then(() => {
                location.reload(); // ✅ reload AFTER OK click
            });
        });
    });

});



</script>


