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
           <i class="w-icon-category"></i>
           <p>Shop</p>
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

       <a href="javascript:void(0)" onclick="showSideCart()" class="cart-toggle label-down sticky-link ">
           <i class="w-icon-cart"></i>
           <p>Cart</p>
       </a>



       <div class="header-search hs-toggle dir-up">
           <a href="#" class="search-toggle sticky-link">
               <i class="w-icon-search"></i>
               <p>Search</p>
           </a>
           <form action="#" class="input-wrapper">
               <input type="text" class="form-control" name="search" autocomplete="off" placeholder="Search"
                    />
               <button class="btn btn-search" type="submit">
                   <i class="w-icon-search"></i>
               </button>
           </form>
       </div>
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
           <form action="#" method="get" class="input-wrapper">
               <input type="text" class="form-control" name="search" autocomplete="off" placeholder="Search"
                    />
               <button class="btn btn-search" type="submit">
                   <i class="w-icon-search"></i>
               </button>
           </form>
           <!-- End of Search Form -->
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
   <div class="login-register-popup mfp-hide">
       <div class="row gutter-sm">
           <div class="col-md-6 mb-4 mb-md-0">
               <div class="login-popup">
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
                               <form id="login-form" class="ebb-form" autocomplete="Off">
                                   <div class="form-group">
                                       <label>Mobile*</label>
                                       <input type="text" class="form-control" name="username"
                                           id="login_username" required>
                                   </div>
                                   <div class="form-group mb-0 position-relative">
                                       <label>Password *</label>
                                       <input type="password" class="form-control" name="password"
                                           id="login_password" required>

                                       <i class="fa-solid fa-eye toggle-password" onclick="togglePassword()"
                                           style="position:absolute; right:10px; margin-top:-30px; cursor:pointer;"></i>
                                   </div>
                                   <div class="form-checkbox d-flex align-items-center justify-content-between">
                                       <input type="checkbox" class="custom-checkbox" id="remember1"
                                           name="remember1" required="">
                                       <label for="remember1">Remember me</label>
                                       <a href="">Last your password?</a>
                                   </div>

                                   <button type="button" class="btn btn-success" onclick="cuslogin()"
                                       id="cus_login">Login</button>
                               </form>
                           </div>

                           <div class="tab-pane" id="sign-up">
                               <form id="register-form" class="ebb-form" autocomplete="off">
                                   <div class="form-group">
                                       <label>Customer Name *</label>
                                       <input type="text" class="form-control" name="email_1"
                                           id="register_username" placeholder="Name" style="text-transform:uppercase"
                                           required autocomplete="new-username">
                                   </div>
                                   <div class="form-group">
                                       <label>Your email address *</label>
                                       <input type="text" class="form-control" name="email_1" id="register_email"
                                           onblur="isEmail(this.value)" placeholder="Email ID" required>
                                   </div>
                                   <div class="form-group">
                                       <label>Phone Number *</label>
                                       <input type="text" class="form-control" name="phone-number"
                                           id="register_mobile" onblur="verify_mobile(this.value)"
                                           placeholder="Mobile Number" required>
                                   </div>
                                   <div class="form-group mb-5">
                                       <label>Password *</label>
                                       <input type="password" class="form-control" name="password_1"
                                           id="register_password" onblur="pass_verify(this.value)"
                                           placeholder="New Password" required autocomplete="new-pass">
                                       <i class="fa-solid fa-eye toggle-password-1"
                                           onclick="togglePasswordRegister('register_password', this)"
                                           style="position:absolute; right:10px; margin-top:-30px; cursor:pointer;">
                                       </i>
                                   </div>
                                   <div class="form-group mb-5">
                                       <label>Confirm Password *</label>
                                       <input type="password" class="form-control" name="password_1"
                                           id="register_cpassword" onblur="cpass_verify(this.value)"
                                           placeholder="Confirm Password" autocomplete="off" required>
                                       <i class="fa-solid fa-eye toggle-password-2"
                                           onclick="togglePasswordRegister('register_cpassword', this)"
                                           style="position:absolute; right:10px; margin-top:-30px; cursor:pointer;">
                                       </i>
                                   </div>

                                   <div class="form-checkbox d-flex align-items-center justify-content-between mb-5">
                                       <input type="checkbox" class="custom-checkbox" id="remember" name="remember"
                                           required="">
                                       <label for="remember" class="font-size-md">I agree to the <a href="#"
                                               class="text-primary font-size-md">privacy policy</a></label>
                                   </div>
                                   <button type="button" id="cus_register" onclick="cusregister()"
                                       class="btn btn-primary">Register</button>

                               </form>
                           </div>
                       </div>

                   </div>
               </div>
           </div>
           <div class="col-md-6 mb-4 mb-md-0">
               <img src="{{ asset('website_assets/images/icons/login.jpg') }}">

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

           if (user_id == 0 && user_id == '') {
               $.notify("Please Login", "error");
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
            if (serverLoginMobile) {
                showLoginPopup(serverLoginRedirect || null, serverLoginMobile);
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

                   } else {
                       swal("Your Cart is safe!");
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

           @if(session('success'))
           window.showCenterMessage(@json(session('success')), 'success');
           @endif
           @if(session('error'))
           window.showCenterMessage(@json(session('error')), 'error');
           @endif
       });

       function cuslogin() {
           var username = $('#login_username').val();
           var password = $('#login_password').val();
           var url = '<?= url('Cuslogin') ?>';
           if (username != '' && password != '') {

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
                               if (typeof window.showCenterMessage === 'function') {
                                   window.showCenterMessage("Login Successfully", "success");
                               }
                               window.location.href = redirectUrl;
                           }
                       } else {
                           if (typeof swal === 'function') {
                               swal("Warning!", "Username And Password is Wrong", "error");
                           } else if (typeof window.showCenterMessage === 'function') {
                               window.showCenterMessage("Username And Password is Wrong", "error");
                           } else {
                               alert("Username And Password is Wrong");
                           }
                       }


                   },
                   error: function(data) {
                       console.log('Error:', data);
                   }
               });
           } else {

               swal("Warning!", "Fill All Form Details", "warning");

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
           if (customer_password != customer_cpassword) {
               swal("Warning!", "Password Miss Matched", "warning");
           } else if (customer_name != '' && customer_mobileno != '' && customer_password != '' && customer_cpassword !=
               '') {
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
                           swal("Success!", "Registered  Successfully", "success");

                           location.reload();
                       } else {
                           //alert(data.msg);
                           swal("Failed", "Mobile Number Already Registered", "error");
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
           } else {

               swal("Warning!", "Fill All Form Details", "warning");

           }

       }

       function pass_verify(pass) {

           if (pass.length < 8) {
               //swal("Warning!", "Password Minimum 8 Character", "warning");

               $('#register_password').val('');
           }
       }

       function cpass_verify(cpass) {
           var pass = $('#register_password').val();
           if (pass.length < 8) {
               swal("Warning!", "Password Minimum 8 Character", "warning");

           } else if (pass != cpass) {
               swal("Warning!", "Password Miss Matched", "warning");
               $('#register_cpassword').val('');
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
           var regex = /^([a-zA-Z0-9_.+-])+\@(([a-zA-Z0-9-])+\.)+([a-zA-Z0-9]{2,4})+$/;

           if (email == '') {

               swal("Warning!", "Enter the Email ID", "warning");
           } else if (regex.test(email) == false) {


               swal("Warning!", "Invalid Email ID", "warning");
               $('#register_email').val('');
           } else {

           }
       }

       function verify_mobile(id) {

           var mobile = id;



           var reg = /(6|7|8|9)\d{9}/;

           if (mobile == '') {

               swal("Warning!", "Enter the Mobile Number", "warning");
           } else if (reg.test(mobile) == false) {


               swal("Warning!", "Invalid Mobile Number", "warning");
               $("#register_mobile").val('');
           } else {

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
