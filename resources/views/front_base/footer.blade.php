   <!-- Start of Footer -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

   <style>
       .footer {
           background-color: #172337;
           color: #FFFFFF !important;
       }

       @media (max-width: 767px) {

           .footer-top .row {
               display: flex;
               flex-wrap: nowrap;
               overflow: hidden;
               /* NO SCROLL */
           }

           .footer-top .col-lg-3 {
               flex: 0 0 25%;
               max-width: 25%;
               padding: 0 5px;
           }

           /* Reduce title size */
           .main-footer .widget-title {
               font-size: 11px;
               margin-bottom: 6px;
           }

           /* Reduce link size */
           .main-footer .widget-body li a {
               font-size: 10px;
               /* line-height: 1.4; */
           }

           /* Reduce spacing */
           .widget-body li {
               margin-bottom: 1px;
           }

           /* About section text */
           .widget-about-desc,
           .widget-about-title,
           .widget-about-call {
               font-size: 10px;
               line-height: 1.4;
           }

           /* Hide long text if needed */
           .widget-about-desc {
               display: none;
           }

           /* Smaller social icons */
           .social-icons a {
               width: 25px;
               height: 25px;
               font-size: 10px;
               margin-right: 4px;
           }

           /* Footer bottom */
           .footer-bottom {
               flex-direction: column;
               text-align: center;
               gap: 6px;
           }

           .footer-bottom p {
               font-size: 10px;
           }

           .footer .widget-about .widget-about-call {
               display: block;
               color: white;
               font-size: 0.9rem;
               font-weight: 600;
               line-height: 1;
               margin-bottom: 0.8rem;
           }

           .footer-top .widget-body li {
               line-height: 1.2;
               margin-bottom: 0.5rem;
           }

           .footer-top .widget {
               margin-bottom: 0rem;
           }
       }
   </style>
   <footer class="footer main-footer appear-animate">



       <?php
       
       use App\Models\Category\CategoryMain;
       use App\Models\Category\Category;
       use App\Models\Category\CategorySub;
       use Darryldecode\Cart\Facades\CartFacade as Cart;
       
       $categorymain = CategoryMain::orderBy('category_main_sortorder', 'asc')->get();
       $category = Category::get();
       $categorysub = CategorySub::get();
       $count = Cart::getContent()->count();
       ?>

       <div class="container">
           <div class="footer-top">
               <div class="row">
                   <div class="col-lg-3 col-md-6 col-12">
                       <div class="widget widget-about">
                           <a href="demo1.html">
                               <img class="shop-footer" src="<?= asset('frontend') ?>/images/header-logo.png" alt="logo-footer"
                                   width="144" height="45" />
                           </a>
                           <div class="widget-body">
                               <p class="widget-about-title">Got Question? Call us 24/7</p>
                               <a href="tel:18005707777" class="widget-about-call">+91 98845 88797</a>
                               <p class="widget-about-desc">Register now to get updates on pronot get up icons
                                   & coupons ster now toon.
                               </p>

                               <div class="social-icons social-icons-colored">
                                   <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                                   <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                                   <a href="#" class="social-icon social-instagram w-icon-instagram"></a>
                                   <a href="#" class="social-icon social-youtube w-icon-youtube"></a>
                               </div>
                           </div>
                       </div>
                   </div>
                   <div class="col-lg-3 col-md-6 col-12">
                       <div class="widget">
                           <h3 class="widget-title">SHOP</h3>
                           <ul class="widget-body">
                               <li><a href="#">About Us</a></li>
                               <li><a href="#">Contact Us</a></li>
                               <li><a href="#">Terms & Conditions</a></li>
                               <li><a href="#">Privacy Policy</a></li>
                               <li><a href="#">Shipping Policy</a></li>
                               <li><a href="#">Refund Policy</a></li>
                           </ul>
                       </div>
                   </div>
                   <div class="col-lg-3 col-md-6 col-12">
                       <div class="widget">
                           <h4 class="widget-title">My Account</h4>
                           <ul class="widget-body">
                               <li><a href="#">Track My Order</a></li>
                               <li><a href="{{ url('shopping-cart') }}">View Cart</a></li>
                               <li><a style="cursor:pointer" onclick="showLoginPopup()">Sign In</a></li>
                               <li><a href="#">Help</a></li>
                               <?php  if(session('customer_id')){ ?>
                               <li><a href="{{ url('myWishlist') }}">My Wishlist</a></li>
                               <?php } ?>
                               <li><a href="#">Privacy Policy</a></li>
                           </ul>
                       </div>
                   </div>
                   <div class="col-lg-3 col-md-6 col-12">
                       <div class="widget">
                           <h4 class="widget-title">Categories</h4>
                           <ul class="widget-body">
                               @foreach ($categorymain as $categoriesmain)
                                   <li><a href="{{ url('mainCategoryShop/' . $categoriesmain->id) }}">
                                           {{ $categoriesmain->category_main_name }}</a></li>
                               @endforeach
                           </ul>
                       </div>
                   </div>
               </div>
           </div>

           {{-- <div class="footer-bottom"> --}}



           {{-- <div class="footer-right">
                   <span class="payment-label mr-lg-8">We're using safe payment for</span>
                   <figure class="payment">
                       <img src="<?= asset('frontend') ?>/images/payment.png" alt="payment" width="159" height="25" />
                   </figure>
               </div> --}}

           {{-- </div> --}}
           <center>
               <p class="mt-3">Copyright © 2026 TRYNEWW</p>
           </center><br>
           {{-- <br> --}}
       </div>
   </footer>
   <!-- End of Footer -->
   </div>
   <!-- End of Page Wrapper -->

   <!-- Start of Sticky Footer -->
   <div class="sticky-footer sticky-content fix-bottom">
       <a href="{{ url('home') }}" class="sticky-link active">
           <i class="w-icon-home"></i>
           <p>Home</p>
       </a>
       <a href="{{ url('shops') }}" class="sticky-link">
           <i class="w-icon-vendor-store"></i>
           <p>Shops</p>
       </a>

       <?php  if(session('customer_id')){ ?>
       <a href="{{ route('myAccount') }}" class="sticky-link">
           <i class="w-icon-account"></i>
           <p>Account</p>
       </a>
       <?php  }else{ ?>
       <a onclick="showLoginPopup()" class="sticky-link">
           <i class="w-icon-account"></i>
           <p>Login</p>
       </a>
       <?php } ?>

       <a href="{{ url('offers') }}" class="sticky-link">
           <i class="w-icon-sale"></i>
           <p>Offers</p>
       </a>

       <a href="{{ url('mainCategoryShop/1') }}" class="sticky-link">
           <i class="w-icon-grid"></i>
           <p>Products</p>
       </a>
   </div>
   <!-- End of Sticky Footer -->

   <!-- Start of Scroll Top -->
   <a id="scroll-top" class="scroll-top" href="#top" title="Top" role="button"> <i class="w-icon-angle-up"></i>
       <svg version="1.1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 70 70">
           <circle id="progress-indicator" fill="transparent" stroke="#000000" stroke-miterlimit="10" cx="35"
               cy="35" r="34" style="stroke-dasharray: 16.4198, 400;"></circle>
       </svg> </a>
   <!-- End of Scroll Top -->

   <!-- Start of Mobile Menu -->
   <div class="mobile-menu-wrapper">
       <div class="mobile-menu-overlay"></div>
       <!-- End of .mobile-menu-overlay -->

       <a href="#" class="mobile-menu-close"><i class="close-icon"></i></a>
       <!-- End of .mobile-menu-close -->

       <div class="mobile-menu-container scrollable">
           <!-- Search Form Removed -->
           <div class="tab">
               <ul class="nav nav-tabs" role="tablist">
                   <li class="nav-item">
                       <a href="#main-menu" class="nav-link active">Main Menu</a>
                   </li>
                   <li class="nav-item">
                       <a href="#categories" class="nav-link"> Categories</a>
                   </li>
               </ul>
           </div>
           <div class="tab-content">
                 <div class="tab-pane active" id="main-menu">
                    <ul class="mobile-menu">
                            <li><a href="{{ url('home') }}">Home</a></li>
                            <li><a href="{{ url('shops') }}">Shops</a></li>
                            <li><a href="{{ url('offers') }}">Offer Products</a></li>
                            <li><a href="{{ url('track-order') }}">Track Order</a></li>
                    </ul>
                </div>
               <div class="tab-pane" id="categories">
                   <ul class="mobile-menu">
                       @foreach ($categorymain as $categoriesmain)
                           @if (count($categoriesmain->submenu) > 0)
                               <li>
                                   <a href="{{ url('mainCategoryShop/' . $categoriesmain->id) }}">
                                       {{ $categoriesmain->category_main_name }}
                                   </a>
                                   <ul>
                                       @foreach ($categoriesmain->submenu as $submenus)
                                           @if (count($submenus->childmenu) > 0)
                                               <li>
                                                   <a
                                                       href="{{ url('categoryShop/' . $submenus->id) }}">{{ $submenus->category_name }}</a>
                                                   <ul>
                                                       @foreach ($submenus->childmenu as $childmenus)
                                                           <li><a
                                                                   href="{{ url('categoryShop/' . $submenus->id . '/' . $childmenus->id) }}">{{ $childmenus->category_sub_name }}
                                                               </a>
                                                           </li>
                                                       @endforeach

                                                   </ul>
                                               </li>
                                           @else
                                               <li><a
                                                       href="{{ url('Categoryproductshow/' . $submenus->id) }}">{{ $submenus->category_name }}</a>
                                               </li>
                                           @endif
                                       @endforeach
                                   </ul>
                               </li>
                           @else
                               <li><a
                                       href="{{ url('MainCatergoryproductshow/' . $categoriesmain->id) }}">{{ $categoriesmain->category_main_name }}</a>
                               </li>
                           @endif
                       @endforeach

                   </ul>
               </div>
           </div>
       </div>
   </div>




   <!-- Start of Quick View -->

   <!-- End of Quick view -->
   <!-- End of Mobile Menu -->
   {{-- 
   <div class="newsletter-popup mfp-hide">
       <div class="newsletter-content">
           <h2 style="color:#0088dd" >Please Check Pincode</h2>
           <form id="pincodeForm" class="">
               <div class="row ">
                   <div class="col-md-12">
                       <div class="form-group ">
                           <h6> <label for="pincode"></label></h6>
                           <input type="text" style="border-radius: 10px" class="form-control" id="pincode"
                               name="pincode"
                               placeholder="Enter pincode" value="{{ session('pincode') }}"
                               required pattern="^\d{6}$" maxlength="6">
                          <center>
                            <p id="pincodeHelp" class="form-text mt-2">Enter your pin code to check for delivery availability, nearby by merchant and more  offers!!!</p>
                            </center> 
                       </div>
                   </div>
                   <div class="col-md-12 mt-2">
                    <center>

                        <button type="submit"   style="border-radius: 20px" class="btn btn-primary ">Check
                           Delivery Area</button>
                    </center>
                        
                   </div>
               </div>
               <div id="pincodeResponse" class="mt-3"></div>
           </form>

       </div>
   </div> --}}

   <div class="newsletter-popup mfp-hide">
       <div class="newsletter-content">
           <p class="mt-3 mobile-single-line"><b>Enjoy exclusive <span style="color:#0088dd">discount</span> on your
                   first order</b></p>
           <h4 style="color:#0088dd" class="ls-20">Sign up to TryNexX</h4>

           <p class="mt-2 mobile-two-line">Enter your pin code to check delivery availability, nearby merchants and
               more offers!!!</p>
           <form id="pincodeForm" class="">
               <div class="row justify-content-center">

                   <div class="col-12 col-md-10 px-3 px-md-0">
                       <input type="text" class="form-control mobile-narrow"
                           style="border-radius: 20px; border: 1px solid black;"
                           oninput="this.value = this.value.replace(/[^0-9]/g, '');" id="pincode" name="pincode"
                           placeholder="Delivery Pincode" value="{{ session('pincode') }}" required
                           pattern="^\d{6}$" maxlength="6">
                   </div>

                   <div class="col-12 col-md-10 px-3 px-md-0 mt-3">
                       <button type="submit" class="btn btn-primary w-100 mobile-narrow"
                           style="border-radius: 20px; ">
                           Check Availability
                       </button>
                   </div>

               </div>


               <div id="pincodeResponse" class="mt-3"></div>


               <div class="mobile-app-message">
                   <p class="mt-2"> <b>Download mobile app <span class="mobile-br">& unlock more deals</span></b>
                   </p>

                   <img class="play-store-image shop-details-ps-image" src="{{ asset('frontend/images/google_play.png') }}">

               </div>
           </form>
       </div>
   </div>

   <style>
       .mfp-content {
           width: 60% !important;
       }

       .center-toast {
           position: fixed;
           top: 50%;
           left: 50%;
           transform: translate(-50%, -50%);
           z-index: 99999;
           min-width: 220px;
           max-width: 90vw;
           padding: 12px 18px;
           color: #fff;
           border-radius: 10px;
           text-align: center;
           font-weight: 600;
           box-shadow: 0 12px 30px rgba(0, 0, 0, 0.25);
           opacity: 0;
           pointer-events: none;
           transition: opacity .2s ease;
       }

       .center-toast.show {
           opacity: 1;
       }

       .center-toast.success {
           background: #1c9c53;
       }

       .center-toast.error {
           background: #d13434;
       }
   </style>
   <div id="centerToast" class="center-toast" aria-live="polite"></div>

   <!-- Start of Quick View -->
    <style>
        /* Premium Login Modal UI Redesign */
        .login-register-popup {
            background: #fff;
            border-radius: 24px;
            overflow: hidden;
            box-shadow: 0 25px 50px -12px rgba(0, 0, 0, 0.25);
            max-width: 480px;
            margin: 0 auto;
            position: relative;
            padding: 0;
            border: 1px solid rgba(0,0,0,0.05);
        }

        .login-register-popup .row {
            margin: 0;
        }

        .login-register-popup .col-md-6 {
            padding: 0;
        }

        .login-register-popup .login-popup {
            padding: 30px 45px;
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: center;
            background: #ffffff;
        }

        .login-register-popup .tab-nav-underline {
            border-bottom: 2px solid #f1f5f9;
            margin-bottom: 35px;
        }

        .login-register-popup .nav-tabs .nav-item {
            margin-bottom: -2px;
            flex: 1;
            text-align: center;
        }

        .login-register-popup .nav-tabs .nav-link {
            font-weight: 800;
            font-size: 1.15rem;
            color: #94a3b8;
            padding: 14px 24px;
            border: none;
            background: transparent;
            border-bottom: 3px solid transparent;
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            width: 100%;
            display: block;
        }

        .login-register-popup .nav-tabs .nav-link:hover {
            color: #64748b;
        }

        .login-register-popup .nav-tabs .nav-link.active {
            color: #0088dd;
            border-bottom: 3px solid #0088dd;
        }

        /* Form Styles */
        .login-register-popup .form-group {
            margin-bottom: 24px;
            position: relative;
        }

        .login-register-popup .form-group label {
            font-weight: 600;
            font-size: 0.85rem;
            color: #475569;
            margin-bottom: 8px;
            display: block;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .login-register-popup .form-control {
            border: 1.5px solid #cbd5e1;
            border-radius: 12px;
            padding: 14px 18px;
            font-size: 1.05rem;
            color: #1e293b;
            background-color: #f8fafc;
            transition: all 0.3s ease;
            width: 100%;
        }

        .login-register-popup .form-control:focus {
            border-color: #0088dd;
            background-color: #fff;
            box-shadow: 0 0 0 4px rgba(0, 136, 221, 0.1);
            outline: none;
        }

        .login-register-popup .toggle-password,
        .login-register-popup .toggle-password-1,
        .login-register-popup .toggle-password-2 {
            color: #94a3b8;
            font-size: 1.2rem;
            transition: color 0.2s;
            position: absolute;
            right: 18px !important;
            top: 43px !important;
            bottom: auto !important;
            margin-top: 0 !important;
            cursor: pointer;
        }

        .login-register-popup .toggle-password:hover,
        .login-register-popup .toggle-password-1:hover,
        .login-register-popup .toggle-password-2:hover {
            color: #0088dd;
        }

        .login-register-popup .form-checkbox {
            margin-bottom: 28px;
            font-size: 0.95rem;
        }

        .login-register-popup .form-checkbox label {
            color: #64748b;
            font-weight: 500;
            cursor: pointer;
            margin-left: 8px;
        }

        .login-register-popup .form-checkbox a {
            color: #0088dd;
            font-weight: 600;
            text-decoration: none;
            transition: color 0.2s;
        }

        .login-register-popup .form-checkbox a:hover {
            color: #006bb3;
            text-decoration: underline;
        }

        .login-register-popup .btn {
            width: 100%;
            padding: 16px;
            font-size: 1.15rem;
            font-weight: 800;
            border-radius: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            transition: all 0.3s ease;
            border: none;
        }

        .login-register-popup .btn-success {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #fff;
            box-shadow: 0 6px 15px rgba(16, 185, 129, 0.25);
        }

        .login-register-popup .btn-success:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(16, 185, 129, 0.35);
        }

        .login-register-popup .btn-primary {
            background: linear-gradient(135deg, #0088dd 0%, #006bb3 100%);
            color: #fff;
            box-shadow: 0 6px 15px rgba(0, 136, 221, 0.25);
        }

        .login-register-popup .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(0, 136, 221, 0.35);
        }

        .login-register-popup .image-wrapper {
            height: 100%;
            min-height: 550px;
            background: linear-gradient(135deg, #f0f7ff 0%, #e0f2fe 100%);
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 40px;
            position: relative;
        }

        .login-register-popup .image-wrapper::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: url('{{ asset('website_assets/images/icons/login.jpg') }}') center center / cover no-repeat;
            opacity: 0.9;
            mix-blend-mode: multiply;
        }
        
        .login-register-popup .image-wrapper img {
            display: none;
        }

        /* Force proper scroll inside Magnific Popup */
        .mfp-wrap {
            overflow-y: scroll !important;
        }

        @media (max-width: 767px) {
            .login-register-popup .login-popup {
                padding: 35px 25px;
            }
            .login-register-popup .image-wrapper {
                display: none;
            }
            .login-register-popup {
                max-width: 95%;
                border-radius: 16px;
            }
        }
    </style>
    <div class="login-register-popup mfp-hide">
        <div class="row w-100 m-0">
            <div class="col-md-12 mb-0 p-0">
                <div class="login-popup" style="position: relative;">
                   <button type="button" onclick="$.magnificPopup.close()" style="position: absolute; top: 12px; right: 16px; font-size: 28px; font-weight: 400; line-height: 1; color: #7cb8eb; background: transparent; border: none; cursor: pointer; transition: color 0.2s; z-index: 1045; padding: 0;" onmouseover="this.style.color='#0088dd'" onmouseout="this.style.color='#7cb8eb'" title="Close">&times;</button>
                   <div class="tab tab-nav-boxed tab-nav-center tab-nav-underline">
                       <ul class="nav nav-tabs text-uppercase" role="tablist">
                           <li class="nav-item">
                               <a href="#sign-in" class="nav-link active">Sign In</a>
                           </li>
                           <li class="nav-item">
                               <a href="#sign-up" class="nav-link">Sign Up</a>
                           </li>
                       </ul>
                       <div class="tab-content">

                           <div class="tab-pane active" id="sign-in">
                               <form id="login-form" class="ebb-form" autocomplete="Off" novalidate>
                                   <div id="login-error-alert" class="text-center mb-3" style="display:none; font-weight:500; color: #ef4444 !important; font-size: 1.1rem;"></div>
                                   <div class="form-group">
                                       <label>Mobile Number *</label>
                                       <input type="text" class="form-control" name="username"
                                           id="login_username" placeholder="Enter your mobile number" 
                                           oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="10">
                                   </div>
                                   <div class="form-group mb-0 position-relative">
                                       <label>Password *</label>
                                       <input type="password" class="form-control" name="password"
                                           id="login_password" placeholder="Enter your password">

                                       <i class="fa-solid fa-eye toggle-password" onclick="togglePassword()"></i>
                                   </div>
                                   <div class="form-checkbox d-flex align-items-center justify-content-end mt-4">
                                       <a href="javascript:void(0)" onclick="$('#forget-mail').click()">Lost your password?</a>
                                   </div>

                                   <button type="button" class="btn btn-success" onclick="cuslogin()"
                                       id="cus_login"> Login</button>
                               </form>
                           </div>

                           <div class="tab-pane" id="sign-up">
                               <form id="register-form" class="ebb-form" autocomplete="off" novalidate>
                                   <div id="register-error-alert" class="text-center mb-3" style="display:none; font-weight:500; color: #ef4444 !important; font-size: 1.1rem;"></div>
                                   <div class="form-group">
                                       <label>Customer Name *</label>
                                       <input type="text" class="form-control" name="email_1"
                                           id="register_username" placeholder="E.g. John Doe" style="text-transform:uppercase"
                                           autocomplete="new-username">
                                   </div>
                                   <div class="form-group">
                                       <label>Email Address *</label>
                                       <input type="text" class="form-control" name="email_1" id="register_email"
                                           onblur="isEmail(this.value)" placeholder="E.g. john@example.com">
                                   </div>
                                   <div class="form-group">
                                       <label>Phone Number *</label>
                                       <input type="text" class="form-control" name="phone-number"
                                           id="register_mobile" onblur="verify_mobile(this.value)"
                                           oninput="this.value = this.value.replace(/[^0-9]/g, '')" maxlength="10"
                                           placeholder="E.g. 9876543210">
                                   </div>
                                   <div class="form-group mb-4 position-relative">
                                       <label>Password *</label>
                                       <input type="password" class="form-control" name="password_1"
                                           id="register_password" onblur="pass_verify(this.value)"
                                           placeholder="Create a strong password" autocomplete="new-pass">
                                       <i class="fa-solid fa-eye toggle-password-1"
                                           onclick="togglePasswordRegister('register_password', this)"
                                           style="position:absolute; right:10px; margin-top:-30px; cursor:pointer;">
                                       </i>
                                   </div>
                                   <div class="form-group mb-4 position-relative">
                                       <label>Confirm Password *</label>
                                       <input type="password" class="form-control" name="password_1"
                                           id="register_cpassword" onblur="cpass_verify(this.value)"
                                           placeholder="Re-enter password" autocomplete="off">
                                       <i class="fa-solid fa-eye toggle-password-2"
                                           onclick="togglePasswordRegister('register_cpassword', this)"
                                           style="position:absolute; right:10px; margin-top:-30px; cursor:pointer;">
                                       </i>
                                   </div>

                                   <div class="form-checkbox d-flex align-items-center justify-content-between mb-4">
                                       <div>
                                           <input type="checkbox" class="custom-checkbox" id="remember" name="remember" required>
                                           <label for="remember" class="font-size-md mb-0">I agree to the <a href="#" class="text-primary font-size-md">Privacy Policy</a></label>
                                       </div>
                                   </div>
                                   <button type="button" id="cus_register" onclick="cusregister()"
                                       class="btn btn-primary">Create Account</button>

                               </form>
                           </div>
                       </div>

                   </div>
               </div>
           </div>
           </div>
       </div>
   </div>

   <script>
       const isCustomerLoggedIn = <?= session()->has('customer_id') ? 'true' : 'false' ?>;

       window.showCenterMessage = function(message, type = 'success') {
           const toast = document.getElementById('centerToast');
           if (!toast) return;
           toast.classList.remove('success', 'error', 'show');
           toast.classList.add(type === 'error' ? 'error' : 'success');
           toast.textContent = message || '';
           toast.classList.add('show');
           clearTimeout(window.centerToastTimer);
           window.centerToastTimer = setTimeout(function() {
               toast.classList.remove('show');
           }, 2200);
       };

       window.syncCartCount = function(count) {
           const safeCount = Math.max(0, parseInt(count || 0, 10) || 0);
           $('.cart-count').html(safeCount);
           if (!isCustomerLoggedIn) {
               localStorage.setItem('oxy_cart_count', String(safeCount));
           } else {
               localStorage.removeItem('oxy_cart_count');
           }
       };

       function applyInitialCartCount() {
           if (!isCustomerLoggedIn) {
               const stored = parseInt(localStorage.getItem('oxy_cart_count') || '0', 10) || 0;
               $('.cart-count').html(stored);
           }
       }

       function addwishlist(pid) {

           var user_id = '<?= session()->get('customer_id') ?>';

           if (user_id == 0 || user_id == '') {
               showCenterMessage("Please Login", "error");
               return false;
           }

           var product_id = pid;
           var url = '<?= route('add-wishlist') ?>';
           $.ajax({
               url: url,
               type: "GET",
               data: {
                   "_token": "{{ csrf_token() }}",
                   "product_id": product_id
               },
               dataType: "json",
               success: function(data) {
                   swal("success!", "Wishlist Added Successfully", "success");
                   $('.wishcount').html(data.wishcount);
               },
               error: function(data) {
                   console.log('Error:', data);
               }
           });


       }
   </script>

   <!-- Plugin JS File -->

   <script src="<?= asset('frontend') ?>/vendor/jquery.plugin/jquery.plugin.min.js"></script>
   <script src="<?= asset('frontend') ?>/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
   <script src="<?= asset('frontend') ?>/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>


   <script src="<?= asset('frontend') ?>/vendor/photoswipe/photoswipe.min.js"></script>
   <script src="<?= asset('frontend') ?>/vendor/photoswipe/photoswipe-ui-default.min.js"></script>
   <script src="<?= asset('frontend') ?>/vendor/parallax/parallax.min.js"></script>
   <script src="<?= asset('frontend') ?>/vendor/jquery.plugin/jquery.plugin.min.js"></script>
   <script src="<?= asset('frontend') ?>/vendor/swiper/swiper-bundle.min.js"></script>
   <script src="<?= asset('frontend') ?>/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
   <script src="<?= asset('frontend') ?>/vendor/skrollr/skrollr.min.js"></script>
   <script src="<?= asset('frontend') ?>/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>
   <script src="<?= asset('frontend') ?>/vendor/zoom/jquery.zoom.js"></script>
   <script src="<?= asset('frontend') ?>/vendor/jquery.countdown/jquery.countdown.min.js"></script>
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   <!-- Main JS -->
   <script src="<?= asset('frontend') ?>/js/main.min.js"></script>
   <script src="<?= asset('frontend') ?>/js/notify.min.js"></script>
   <script>
       function togglePassword() {
           var input = document.getElementById("login_password");
           var icon = document.querySelector(".toggle-password");

           if (input.type === "password") {
               input.type = "text";
               icon.classList.remove("fa-eye");
               icon.classList.add("fa-eye-slash");
           } else {
               input.type = "password";
               icon.classList.remove("fa-eye-slash");
               icon.classList.add("fa-eye");
           }
       }





       function togglePasswordRegister(inputId, icon) {
           let input = document.getElementById(inputId);

           if (input.type === "password") {
               input.type = "text";
               icon.classList.remove("fa-eye");
               icon.classList.add("fa-eye-slash");
           } else {
               input.type = "password";
               icon.classList.remove("fa-eye-slash");
               icon.classList.add("fa-eye");
           }
       }



       function togglePasswordAccount(inputId, icon) {
           let input = document.getElementById(inputId);

           if (input.type === "password") {
               input.type = "text";
               icon.classList.remove("fa-eye");
               icon.classList.add("fa-eye-slash");
           } else {
               input.type = "password";
               icon.classList.remove("fa-eye-slash");
               icon.classList.add("fa-eye");
           }
       }



        function showLoginPopup(redirectUrl = null, prefillMobile = null) {
            if (redirectUrl) {
                sessionStorage.setItem('post_login_redirect', redirectUrl);
            } else {
                sessionStorage.removeItem('post_login_redirect');
            }

            if (prefillMobile) {
                sessionStorage.setItem('prefill_login_mobile', prefillMobile);
            }
            //    Wolmart.popup({
            //        items: {
            //            src: ".login-register-popup"
            //        },
           //        type: "inline",
           //        closeBtnInside: true,                      
           //        callbacks: {
           //            close: function() {},
           //        },
           //    })
            Wolmart.popup({
                items: {
                   src: ".login-register-popup"
                },
                type: "inline",
                closeBtnInside: true
            });

            var storedMobile = prefillMobile || sessionStorage.getItem('prefill_login_mobile');
            if (storedMobile) {
                setTimeout(function() {
                    $('#login_username').val(storedMobile);
                }, 80);
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            var serverLoginMobile = @json(session('login_mobile'));
            var serverLoginRedirect = @json(session('login_redirect'));
            if (serverLoginMobile || serverLoginRedirect) {
                showLoginPopup(serverLoginRedirect || null, serverLoginMobile || null);
            }
        });

       $('#pincodeForm').on('submit', function(e) {
           e.preventDefault();
           var siteurl = "{{ url('/') }}";
           var pincode = $('#pincode').val();
           $.ajax({
               url: "{{ route('checkPincode') }}",
               type: 'POST',
               data: {
                   _token: '{{ csrf_token() }}',
                   pincode: pincode
               },
               success: function(response) {
                   if (response.status === 'success') {
                       $('#pincodeResponse').html('<p style="color: #0088dd;">' + response
                           .message + '</p>');
                       location.reload();
                   } else {
                       $('#pincodeResponse').html('<p style="color: red;">' + response
                           .message + '</p>');
                   }
               },
               error: function(xhr, status, error) {
                   $('#pincodeResponse').html(
                       '<p style="color: red;">An error occurred. Please try again.</p>'
                   );
               }
           });
       });




       function showQuickView(id) {

           var url = '<?= url('quickView') ?>/' + id;
           $.get(url, function(html) {
               Wolmart.popup({
                       items: {
                           src: html
                       },
                       callbacks: {
                           open: function() {},
                           close: function() {
                               // $(".mfp-product .swiper-container")
                               //   .data("slider")
                               //   .destroy();

                           },
                       },
                   },
                   "quickview"
               );
           })
       }


       $(document).ready(function() {



           // prevent duplicate timers (mobile reload issue)
           if (window.popupTimerStarted) return;
           window.popupTimerStarted = true;

           var pincode = '{{ session()->get('pincode') ?? 0 }}';
           var popupShown = sessionStorage.getItem('pincode_popup_shown');

           if (pincode == 0) {

               setTimeout(function() {
                   showPicodePopup();
                   // sessionStorage.setItem('pincode_popup_shown', 'yes');
               }, 3000);

           }
       });

       // popup function
       function showPicodePopup() {


           Wolmart.popup({
               items: {
                   src: ".newsletter-popup"
               },
               type: "inline",
               mainClass: "mfp-newsletter mfp-fadein-popup",
               callbacks: {
                   open: function() {
                       // LOCK scroll
                       $('html, body').css({
                           overflow: 'hidden',
                           height: '100%'
                       });
                   },
                   close: function() {
                       // UNLOCK scroll (VERY IMPORTANT)
                       $('html, body').css({
                           overflow: '',
                           height: ''
                       });
                   }
               }
           });
       }


       // function getproduct(id)
       // {
       //     var url = '<?= url('quickView') ?>/'+id;
       //     $.get(url,function(html){
       //         return html;
       //     })        
       // }


       function removeCart(id) {
           var url = '<?= route('removeCart') ?>/' + encodeURIComponent(id);


           swal({
                   title: "Are you sure?",
                   text: "Once deleted, you will not be able to recover this remove cart!",
                   icon: "warning",
                   buttons: true,
                   dangerMode: true,
               })
               .then((willDelete) => {
                   if (willDelete) {
                       $.get(url, function(data) {
                           if (data.removed == 1) {
                               window.showCenterMessage(data.message, "success");
                               window.syncCartCount(data.count || 0);
                               showSideCart();
                           }
                       });

                   }
               });
       }




       function showSideCart() {
           var url = '<?= route('getSideCart') ?>';
           $.get(url, function(data) {
               $('.sideCart').html(data);
               var currentCount = $('.sideCart .product.product-cart').length;
               window.syncCartCount(currentCount);
           });
       }


       function updateQty(id, type, domId) {
           var input = null;
           if (domId) {
               input = document.getElementById(domId);
           } else {
               input = document.querySelector('input[data-item-id="' + String(id).replace(/"/g, '\\"') + '"]');
           }
           var qty = parseInt((input ? input.value : '1') || '1', 10);
           var nextQty = (type == 'Add') ? qty + 1 : ((type == 'Minus' && qty > 1) ? qty - 1 : qty);

           if (id) {
               var url = '<?= route('updateQty') ?>';
               $.post(url, {
                   id: id,
                   'qty': nextQty,
                   '_token': '<?= csrf_token() ?>',
                   'type': type,
               }, function(data) {
                   if (data.status === 'error') {
                       if (input) {
                           input.value = data.quantity || qty;
                       }
                       window.showCenterMessage(data.message || 'Unable to update quantity.', 'error');
                       return;
                   }

                   if (input) {
                       input.value = data.quantity || nextQty;
                   }
                   getCart();
                   window.syncCartCount(data.count || 0);
                   window.showCenterMessage(data.message, "success");

               })
           }
       }

       function getCart() {
           var url = '<?= route('getItemCart') ?>';
           var scrollTop = window.pageYOffset || document.documentElement.scrollTop || document.body.scrollTop || 0;
           $.get(url, function(data) {
               $('#cartView').html(data);
               showSideCart();
               window.scrollTo(0, scrollTop);
           });
       }

       $(document).ready(function() {
           applyInitialCartCount();
           showSideCart();

           // Load wishlist count on page load
           <?php if(session('customer_id')): ?>
           $.get('<?= route('get-wishlist-count') ?>', function(data) {
               if (data && typeof data.wishcount !== 'undefined') {
                   $('.wishcount').html(data.wishcount);
               }
           });
           <?php endif; ?>

           @if(session('success'))
           window.showCenterMessage(@json(session('success')), 'success');
           @endif
           @if(session('error'))
           window.showCenterMessage(@json(session('error')), 'error');
           @endif
       });

        function showFieldError(inputId, message) {
            var input = $('#' + inputId);
            input.css('border-color', '#ef4444');
            if (input.siblings('.inline-error-msg').length == 0) {
                input.after('<small class="inline-error-msg mt-1 d-block" style="color: #ef4444 !important; font-weight: 500; font-size: 0.85rem; text-transform: none; position: absolute; bottom: -22px; left: 0;">' + message + '</small>');
            } else {
                input.siblings('.inline-error-msg').text(message);
            }
        }

        function clearFieldError(inputId) {
            var input = $('#' + inputId);
            input.css('border-color', '');
            input.siblings('.inline-error-msg').remove();
        }

        $(document).ready(function() {
            $('.form-control').on('input focus', function() {
                clearFieldError($(this).attr('id'));
            });
        });

        function cuslogin() {
            var username = $('#login_username').val();
            var password = $('#login_password').val();
            var url = '<?= url('Cuslogin') ?>';
            
            clearFieldError('login_username');
            clearFieldError('login_password');
            $('#login-error-alert').hide();

            var hasError = false;

            if (username == '') {
                showFieldError('login_username', 'Please enter your mobile number.');
                hasError = true;
            }
            if (password == '') {
                showFieldError('login_password', 'Please enter your password.');
                hasError = true;
            }

            if (!hasError) {

                $.ajax({

                    url: url,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "username": username,
                        "password": password
                    },

                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        if (data.msg == 'Success') {
                            var redirectUrl = sessionStorage.getItem('post_login_redirect') || "{{ route('myAccount') }}";
                            sessionStorage.removeItem('post_login_redirect');
                            sessionStorage.removeItem('prefill_login_mobile');
                            if (typeof swal === 'function') {
                                swal("Success!", "Login Successfully", "success").then(function() {
                                    window.location.href = redirectUrl;
                                });
                                setTimeout(function() {
                                    window.location.href = redirectUrl;
                                }, 1200);
                            } else {
                                window.location.href = redirectUrl;
                            }
                        } else {
                            $('#login-error-alert').text('Invalid username or password.').show();
                        }


                    },
                    error: function(data) {
                        console.log('Error:', data);
                    }
                });
            }
        }

       $('#forget-mail').click(function() {

           var email = $('#lost_email').val();
           if (email != '') {

               $.ajax({

                   url: url + '/Forget_password',
                   type: "GET",
                   data: {
                       "_token": "{{ csrf_token() }}",
                       "email": email
                   },

                   dataType: "json",
                   success: function(data) {
                       console.log(data);
                       if (data.msg == 'Success') {
                           swal("Success!", "Password Send Your Mail Id", "success");

                       } else {

                           swal("Warning!", data.msg, "error");
                       }


                   },
                   error: function(data) {
                       console.log('Error:', data);
                   }
               });
           } else {

               swal("Warning!", "Fill All Form Details", "warning");

           }

       });

        function cusregister() {
            var customer_name = $('#register_username').val();
            var customer_mobileno = $('#register_mobile').val();
            var customer_email = $('#register_email').val();
            var customer_password = $('#register_password').val();
            var customer_cpassword = $('#register_cpassword').val();
            var url = '<?= url('CusRegister') ?>';

            clearFieldError('register_username');
            clearFieldError('register_mobile');
            clearFieldError('register_email');
            clearFieldError('register_password');
            clearFieldError('register_cpassword');
            $('#register-error-alert').hide();

            var hasError = false;

            if (customer_name == '') { showFieldError('register_username', 'Please enter your name'); hasError = true; }
            if (customer_mobileno == '') { showFieldError('register_mobile', 'Please enter your mobile number'); hasError = true; }
            if (customer_email == '') { showFieldError('register_email', 'Please enter your email address'); hasError = true; }
            if (customer_password == '') { showFieldError('register_password', 'Please enter a password'); hasError = true; }
            if (customer_password != '' && customer_password.length < 8) { showFieldError('register_password', 'Password must be at least 8 characters'); hasError = true; }
            if (customer_password != '' && customer_password != customer_cpassword) { showFieldError('register_cpassword', 'Passwords do not match'); hasError = true; }

            if (!hasError) {
                $('#reg-btn1').show();
                $('#reg-btn2').hide();
                $.ajax({
                    url: url,
                    type: "GET",
                    data: {
                        "_token": "{{ csrf_token() }}",
                        "customer_name": customer_name,
                        "customer_mobileno": customer_mobileno,
                        "customer_email": customer_email,
                        "customer_password": customer_password
                    },

                    dataType: "json",
                    success: function(data) {
                        console.log(data);
                        if (data.msg == 'Success') {
                            swal("Success!", "Registered Successfully", "success").then(function() {
                                location.reload();
                            });
                        } else {
                            $('#register-error-alert').text('Mobile Number Already Registered').show();
                        }
                        $('#reg-btn1').hide();
                        $('#reg-btn2').show();

                    },
                    error: function(data) {
                        console.log('Error:', data);
                        $('#reg-btn1').hide();
                        $('#reg-btn2').show();
                    }
                });
            }
        }

        function pass_verify(pass) {
            clearFieldError('register_password');
            if (pass.length > 0 && pass.length < 8) {
                showFieldError('register_password', 'Password must be at least 8 characters');
            }
        }

        function cpass_verify(cpass) {
            clearFieldError('register_cpassword');
            var pass = $('#register_password').val();
            if (cpass.length > 0 && pass != cpass) {
                showFieldError('register_cpassword', 'Passwords do not match');
            }
        }

        function opass_verify(cpass) {
            var pass = $('#cpd').val();
            if (pass != cpass) {
                swal("Warning!", "Old Password Miss Matched", "warning");
                $('#customer_opassword').val('');
            }
        }

        function isEmail(email) {
            clearFieldError('register_email');
            var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;
            if (email != '' && regex.test(email) == false) {
                showFieldError('register_email', 'Please enter a valid email address');
            }
        }

        function verify_mobile(id) {
            clearFieldError('register_mobile');
            var mobile = id;
            var reg = /(6|7|8|9)\d{9}/;
            if (mobile != '' && reg.test(mobile) == false) {
                showFieldError('register_mobile', 'Please enter a valid 10-digit mobile number');
            }
        }

       function setImage(e) {
           var img = $(e).attr('data-image');
           $('#firstImg').attr('src', img);
       }
   </script>

   <script>
       document.addEventListener("DOMContentLoaded", function() {

           let stars = document.querySelectorAll('#user-rating a');
           let ratingInput = document.getElementById('rating');
           let reviewForm = document.querySelector('form.review-form');

           let existingRating = {{ $myRating->star_rating ?? 0 }};

           if (ratingInput && existingRating > 0) {
               ratingInput.value = existingRating;
               for (let i = 0; i < existingRating && i < stars.length; i++) {
                   stars[i].classList.add('active');
               }
           }

           stars.forEach((star) => {
               star.addEventListener('click', function(e) {
                   e.preventDefault();
                   if (!ratingInput) return;

                   let value = this.dataset.val;
                   ratingInput.value = value;

                   stars.forEach(s => s.classList.remove('active'));
                   for (let i = 0; i < value && i < stars.length; i++) {
                       stars[i].classList.add('active');
                   }
               });
           });

           if (reviewForm) {
               reviewForm.addEventListener('submit', function(e) {
                   if (!ratingInput || !ratingInput.value) {
                       e.preventDefault();
                       swal('Please select a rating', 'warning');
                   }
               });
           }
       });
   </script>

   <style>
       .fv-invalid {
           border: 1px solid #dc3545 !important;
           box-shadow: 0 0 0 0.12rem rgba(220, 53, 69, 0.25) !important;
       }

       .fv-error {
           color: #dc3545;
           font-size: 12px;
           margin-top: 4px;
       }
   </style>
   <script>
       (function() {
           if (window.__stableHeaderDropdownInit) return;
           window.__stableHeaderDropdownInit = true;

           if (!document.getElementById('stable-frontbase-dropdown-style')) {
               var style = document.createElement('style');
               style.id = 'stable-frontbase-dropdown-style';
               style.textContent = '.header-dropdown > li.onhover-dropdown{padding-bottom:10px;margin-bottom:-10px;}\
                   .header-dropdown > li.onhover-dropdown > .onhover-show-div{top:calc(100% + 2px)!important;}\
                   .header-dropdown li.onhover-dropdown.manual-open > .onhover-show-div{opacity:1!important;visibility:visible!important;transform:translateY(0)!important;}';
               document.head.appendChild(style);
           }

           document.addEventListener('DOMContentLoaded', function() {
               var drops = document.querySelectorAll('.header-dropdown > li.onhover-dropdown');
               drops.forEach(function(drop) {
                   var hasLogout = drop.querySelector('a[href*="logout"], a[href*="customer-logout"], a[href*="userlogout"]');
                   if (!hasLogout) return;
                   var toggle = drop.querySelector(':scope > i, :scope > a, :scope > div');
                   if (!toggle) return;
                   toggle.style.cursor = 'pointer';
                   toggle.addEventListener('click', function(e) {
                       e.preventDefault();
                       e.stopPropagation();
                       drops.forEach(function(other) {
                           if (other !== drop) other.classList.remove('manual-open');
                       });
                       drop.classList.toggle('manual-open');
                   });
               });

               document.addEventListener('click', function(e) {
                   if (!e.target.closest('.header-dropdown > li.onhover-dropdown.manual-open')) {
                       drops.forEach(function(drop) {
                           drop.classList.remove('manual-open');
                       });
                   }
               });
           });
       })();
   </script>
   <script>
       (function() {
           if (window.__globalFrontendValidationInitialized) return;
           window.__globalFrontendValidationInitialized = true;

           function markInvalid(el, msg) {
               if (!el) return;
               el.classList.add('fv-invalid');
               var next = el.nextElementSibling;
               if (!next || !next.classList || !next.classList.contains('fv-error')) {
                   next = document.createElement('div');
                   next.className = 'fv-error';
                   el.insertAdjacentElement('afterend', next);
               }
               next.textContent = msg || 'This field is required.';
           }

           function clearInvalid(el) {
               if (!el) return;
               el.classList.remove('fv-invalid');
               var next = el.nextElementSibling;
               if (next && next.classList && next.classList.contains('fv-error')) {
                   next.remove();
               }
           }

           function isEmail(val) {
               return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(val);
           }

           function validateField(el) {
               if (!el || el.disabled || el.type === 'hidden' || el.dataset.noValidate !== undefined) {
                   return true;
               }

               var value = (el.value || '').trim();
               var required = el.hasAttribute('required');
               var type = (el.type || '').toLowerCase();

               if (required) {
                   if (type === 'checkbox' || type === 'radio') {
                       var form = el.form || document;
                       var selector = 'input[name="' + el.name + '"]:checked';
                       if (!form.querySelector(selector)) {
                           markInvalid(el, 'Please select an option.');
                           return false;
                       }
                   } else if (value === '') {
                       markInvalid(el, 'This field is required.');
                       return false;
                   }
               }

               if (type === 'email' && value !== '' && !isEmail(value)) {
                   markInvalid(el, 'Enter a valid email.');
                   return false;
               }

               if (el.hasAttribute('pattern') && value !== '') {
                   try {
                       var re = new RegExp('^(?:' + el.getAttribute('pattern') + ')$');
                       if (!re.test(value)) {
                           markInvalid(el, 'Invalid format.');
                           return false;
                       }
                   } catch (e) {}
               }

               clearInvalid(el);
               return true;
           }

           function validateForm(form) {
               if (!form || form.noValidate || form.dataset.noValidate !== undefined) return true;

               var fields = form.querySelectorAll('input, select, textarea');
               var firstInvalid = null;
               var ok = true;

               fields.forEach(function(el) {
                   if (!validateField(el)) {
                       ok = false;
                       if (!firstInvalid) firstInvalid = el;
                   }
               });

               if (!ok && firstInvalid) firstInvalid.focus();
               return ok;
           }

           document.addEventListener('submit', function(e) {
               var form = e.target;
               if (form && form.tagName === 'FORM' && !validateForm(form)) {
                   e.preventDefault();
                   e.stopPropagation();
               }
           }, true);

           document.addEventListener('input', function(e) {
               var el = e.target;
               if (el && (el.matches('input') || el.matches('textarea'))) {
                   validateField(el);
               }
           }, true);

           document.addEventListener('change', function(e) {
               var el = e.target;
               if (el && (el.matches('select') || el.matches('input[type="checkbox"]') || el.matches(
                       'input[type="radio"]'))) {
                   validateField(el);
               }
           }, true);
       })();
   </script>
   <script>
       (function() {
           if (window.__globalSingleSubmitInitialized) return;
           window.__globalSingleSubmitInitialized = true;

           document.addEventListener('submit', function(e) {
               var form = e.target;
               if (!form || form.tagName !== 'FORM') return;
               if (e.defaultPrevented) return;

               if (form.dataset.submitting === '1') {
                   e.preventDefault();
                   return;
               }

               form.dataset.submitting = '1';
               var buttons = form.querySelectorAll('button[type="submit"], input[type="submit"]');
               buttons.forEach(function(btn) {
                   btn.disabled = true;
                   btn.classList.add('disabled');
               });

               setTimeout(function() {
                   if (document.body.contains(form)) {
                       form.dataset.submitting = '0';
                       buttons.forEach(function(btn) {
                           btn.disabled = false;
                           btn.classList.remove('disabled');
                       });
                   }
               }, 15000);
           }, false);
       })();
   </script>



   </body>

   </html>
