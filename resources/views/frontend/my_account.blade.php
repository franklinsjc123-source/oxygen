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
               <div class="tab tab-vertical row gutter-lg">
                   <ul class="nav nav-tabs mb-6" role="tablist">
                       <li class="nav-item">
                           <a href="#account-dashboard"  data-bs-toggle="tab"  class="nav-link    active">Dashboard</a>
                       </li>
                       <li class="nav-item">
                           <a href="#account-orders"  data-bs-toggle="tab"   class="nav-link  ">Orders</a>
                       </li>
                       <li class="nav-item">
                           <a href="#account-downloads"  data-bs-toggle="tab"  class="nav-link  ">Wallet</a>
                       </li>
                       <li class="nav-item">
                           <a href="#account-addresses"  data-bs-toggle="tab"  class="nav-link ">Addresses</a>
                       </li>
                       <li class="nav-item">
                           <a href="#profile-details"  data-bs-toggle="tab"  class="nav-link ">profile Details</a>
                       </li>
                       <li class="nav-item">
                           <a href="#account-details"  data-bs-toggle="tab"   class="nav-link ">Account Settings</a>
                       </li>
                       <li class="link-item">
                           <a href="#wishlist"  data-bs-toggle="tab"  class="nav-link ">Wishlist</a>
                       </li>
                       <li class="link-item">
                            <a href="{{ route('customer-logout') }}" 
                                class="nav-link " 
                                onclick="window.location.href=this.href; return false;">
                                Logout
                            </a>
                       </li>
                   </ul>

                   <div class="tab-content mb-6">
                       <div class="tab-pane active in" id="account-dashboard">
                           <p class="greeting">
                               Hello
                               <span class="text-dark font-weight-bold"><?=  $customer['customer_firstname'] ?></span>
                               (not
                               <span class="text-dark font-weight-bold"><?=  $customer['customer_firstname'] ?></span> ?
                               <a href="{{ route('customer-logout') }}" class="text-primary">Log out</a>)
                           </p>

                           <p class="mb-4">
                               From your account dashboard you can view your <a href="#account-orders"
                                   class="text-primary link-to-tab">recent orders</a>,
                               manage your <a href="#account-addresses" class="text-primary link-to-tab">shipping
                                   and billing
                                   addresses</a>, and
                               <a href="#account-details" class="text-primary link-to-tab">edit your password and
                                   account details.</a>
                           </p>

                           <div class="row">
                               <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                   <a href="#account-orders" class="link-to-tab">
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
                               <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                   <a href="#account-downloads" class="link-to-tab">
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
                               <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                   <a href="#account-addresses" class="link-to-tab">
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
                               <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                   <a href="#profile-details" class="link-to-tab">
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
                               <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                   <a href="#account-details" class="link-to-tab">
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
                               <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
                                   <a href="#wishlist" class="link-to-tab">
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
                               <div class="col-lg-4 col-md-6 col-sm-4 col-xs-6 mb-4">
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
                                            <tr>
                                                <td class="order-id">
                                                    #{{ $order->orders_id }}
                                                </td>

                                                <td class="order-date">
                                                    {{ \Carbon\Carbon::parse($order->order_date)->format('d M Y') }}
                                                </td>

                                                <td class="order-status">
                                                    {{ $order->order_status }}
                                                </td>

                                                <td class="order-total">
                                                    <span class="order-price">₹{{ number_format($order->grandtotal, 2) }}</span>
                                                </td>

                                                <td class="order-action">
                                                    <a href="{{ url('order-details/'.$order->id) }}"
                                                    class="btn btn-outline btn-default btn-block btn-sm btn-rounded">
                                                    View
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @else
                                        <tr>
                                            <td colspan="5" class="text-center">
                                                No orders found
                                            </td>
                                        </tr>
                                    @endif
                                </tbody>
                           </table>

                           <a href="shop-banner-sidebar.html" class="btn btn-dark btn-rounded btn-icon-right">Go
                               Shop<i class="w-icon-long-arrow-right"></i></a>
                       </div>

                       <div class="tab-pane" id="account-downloads">
                         
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
                        <center><h3>Wishlist</h3></center> 
                        <div class="row">
                            <div class="page-content">
                                <div class="container">
                                    <table class="shop-table wishlist-table">
                                        <thead>
                                            <tr>
                                                <th class="product-name"><span>Product</span></th>
                                                <th class="product-name">Product Name</th>
                                                <th class="product-price"><span>Price</span></th>
                                                <th class="product-stock-status"><span>Stock Status</span></th>
                                                <th class="wishlist-action">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        @php $i=0; @endphp
                                                        @if($wishCount>0)
                                                        @foreach ($wishlist as $product)
                                                        @php  $i++; $images=explode(',',$product->product_detail_image);  $img=substr($images[0], 2, -1);       @endphp
                                                        
                                                        <tr>
                                                            <td style="text-align: center;" >
                                                                <div class="p-relative"  >
                                                                    <a href="{{url('productVar',$product->ecom_product_id)}}">
                                                                    
                                                                            <img   src="{{ asset('assets/images/products/detail') . '/' . $img }}"  alt="product" 
                                                                                >
                                                                    
                                                                    </a>
                                                                    {{-- <a   href="{{url('Delete_wishlist',$product->ecom_wishlist_id)}}" class="btn btn-close"><i
                                                                            class="fas fa-times"></i></a> --}}
                                                                </div>
                                                            </td>
                                                            <td style="text-align: center;" class="product-name">
                                                                <a href="{{url('productVar',$product->ecom_product_id)}}">
                                                                {{ $product->product_name }}
                                                                </a>
                                                            </td>
                                                            <td  style="text-align: center;" class="product-price"><ins class="new-price">Rs. {{ $product->selling_price }} <del><span class="currencySymbol">Rs.</span> {{ $product->retail_price }} </del></ins></td>
                                                            <td  style="text-align: center;" class="product-stock-status">
                                                                <span class="wishlist-in-stock">In Stock</span>
                                                            </td>
                                                            <td  style="text-align: center;" class="wishlist-action">
                                                                <div class="d-lg-flex">
                                                                    <a href="{{url('delete_wishlist',$product->ecom_wishlist_id)}}"
                                                                        class="btn btn-default btn-rounded btn-sm mb-2 mb-lg-0">Remove 
                                                                        </a>
                                                                    <a href="{{url('productVar',$product->ecom_product_id)}}" class="btn btn-dark btn-rounded btn-sm ml-lg-2 btn-cart">Add to
                                                                        cart</a>
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


