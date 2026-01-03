<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title>@yield('title')</title>

    <meta name="keywords" content="Marketplace ecommerce responsive HTML5 Template" />
    <meta name="description" content="Wolmart is powerful marketplace &amp; ecommerce responsive Html5 Template.">
    <meta name="author" content="D-THEMES">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="<?= asset('frontend') ?>/images/favicon.png">
       
    <!-- WebFont.js -->
    <script>
        WebFontConfig = {
            google: { families: ['Poppins:400,500,600,700'] }
        };
        ( function ( d ) {
            var wf = d.createElement( 'script' ), s = d.scripts[0];
            wf.src = '<?= asset('frontend') ?>/js/webfont.js';
            wf.async = true;
            s.parentNode.insertBefore( wf, s );
        } )( document );
    </script>

     <!-- Default CSS -->
     <link rel="stylesheet" type="text/css" href="<?= asset('frontend') ?>/css/style.min.css">


    <link rel="preload" href="<?= asset('frontend') ?>/vendor/fontawesome-free/webfonts/fa-regular-400.woff2" as="font" type="font/woff2"
        crossorigin="anonymous">
    <link rel="preload" href="<?= asset('frontend') ?>/vendor/fontawesome-free/webfonts/fa-solid-900.woff2" as="font" type="font/woff2"
        crossorigin="anonymous">
 <link rel="preload" href="<?= asset('frontend') ?>/fonts/wolmart.woff?png09e" as="font" type="font/woff" crossorigin="anonymous">
    <!-- Vendor CSS -->
    <link rel="stylesheet" type="text/css" href="<?= asset('frontend') ?>/vendor/fontawesome-free/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="<?= asset('frontend') ?>/vendor/animate/animate.min.css">

    <!-- preloading link
    <link rel="preload" href="<?= asset('frontend') ?>/fonts/venedor.woff" as="font" type="font/woff" crossorigin="anonymous"> -->

    <!-- Plugins CSS -->
   
    <link rel="stylesheet" type="text/css" href="<?= asset('frontend') ?>/vendor/animate/animate.min.css">
    <link rel="stylesheet" type="text/css" href="<?= asset('frontend') ?>/vendor/magnific-popup/magnific-popup.min.css">
     <link rel="stylesheet" href="<?= asset('frontend') ?>/vendor/swiper/swiper-bundle.min.css">
    <link rel="stylesheet" type="text/css" href="<?= asset('frontend') ?>/css/demo8.min.css">
   
    <script src="<?= asset('frontend') ?>/vendor/jquery/jquery.min.js"></script>
   
</head>

<body>


<?php
 
    use App\Models\Category\CategoryMain;
    use App\Models\Category\Category;
    use App\Models\Category\CategorySub;
    use Darryldecode\Cart\Facades\CartFacade as Cart;

    $categorymain   = CategoryMain::get();
    $category       = Category::get();
    $categorysub    = CategorySub::get();  
    $count          = Cart::getContent()->count();                                  
?>

<body>
    <!-- Start of Page Wrapper -->
    <div class="page-wrapper">
        <h1 class="d-none">Wolmart - Responsive Marketplace HTML Template</h1>
        <!-- Start of Header -->
        <header class="header header-border">
            <div class="header-top">
                <div class="container">
                    <div class="header-left">
                        <p class="welcome-msg">Welcome to Oxygen ! </p>
                    </div>
                    <div class="header-right">
                       

                        
                        <!-- End of Dropdown Menu -->
                        {{-- <span class="divider d-lg-show"></span> --}}
                        <a href="blog.html" class="d-lg-show">Blog</a>
                        <a href="contact-us.html" class="d-lg-show">Contact Us</a>  
                        {{-- <a href="my-account.html" class="d-lg-show">My Account</a> --}}
                        {{-- <a href="javascript:void(0)" onclick="showLoginPopup()" class="d-lg-show login sign-in"><i
                                class="w-icon-account"></i>Sign In</a>
                        <span class="delimiter d-lg-show">/</span>
                        <a href="javascript:void(0)" onclick="showLoginPopup()" class="ml-0 d-lg-show login register">Register</a> --}}
                    </div>
                </div>
            </div>
            <!-- End of Header Top -->

            <div class="header-middle">
                <div class="container">
                    <div class="header-left mr-md-4">
                        <a href="#" class="mobile-menu-toggle  w-icon-hamburger" aria-label="menu-toggle">
                        </a>
                        <a href="{{ url('demoEight') }}" class="logo ml-lg-0">
                            <img src="<?= asset('frontend') ?>/images/header-logo.png" alt="logo" width="144" height="45" />
                        </a>
                        <form method="get" action="#" class="header-search hs-expanded hs-round d-none d-md-flex input-wrapper">
                            <div class="select-box">
                                <select id="category" name="category">
                                    <option value="">All Categories</option>
                                    <option value="4">Fashion</option>
                                    <option value="5">Furniture</option>
                                    <option value="6">Shoes</option>
                                    <option value="7">Sports</option>
                                    <option value="8">Games</option>
                                    <option value="9">Computers</option>
                                    <option value="10">Electronics</option>
                                    <option value="11">Kitchen</option>
                                    <option value="12">Clothing</option>
                                </select>
                            </div>
                            <input type="text" class="form-control" name="search" id="search"
                                placeholder="Search in..." required />
                            <button class="btn btn-search" type="submit"><i class="w-icon-search"></i>
                            </button>
                        </form>
                    </div>
                    <div class="header-right ml-4">
                        <div class="header-call d-xs-show d-lg-flex align-items-center">
                            <a href="tel:#" class="w-icon-call"></a>
                            <div class="call-info d-lg-show">
                                <h4 class="chat font-weight-normal font-size-md text-normal ls-normal text-light mb-0">
                                    <a href="mailto:#" class="text-capitalize">Call</a></h4>
                                <a href="tel:#" class="phone-number font-weight-bolder ls-50">+91 98845 88797</a>
                            </div>
                        </div>

                        

                <?php  if(session('customer_id')){ ?>
                    
                    <a class="wishlist label-down link d-xs-show" href="{{ route('myWishlist') }}">
                            <i class="w-icon-heart"></i>
                            <span class="wishlist-label d-lg-show mt-1">Wishlist</span>
                        </a>

                      <a   href="{{ route('myAccount') }}"   class="compare label-down link d-xs-show" >
                                <i class="w-icon-account"  style="font-size:28px;"></i>
                                <span class="compare-label d-lg-show mt-1">Account</span>
                            </a>


               <?php  }else{ ?>
                    
                            <a   href="javascript:void(0)" onclick="showLoginPopup()"  class="compare label-down link d-xs-show" >
                                <i class="w-icon-account"  style="font-size:28px;"></i>
                                <span class="compare-label d-lg-show mt-1">Login</span>
                            </a>

               <?php } ?>
                        {{-- <a class="compare label-down link d-xs-show" href="compare.html">
                            <i class="w-icon-compare"></i>
                            <span class="compare-label d-lg-show">Compare</span>
                        </a> --}}
                        <div class="dropdown cart-dropdown cart-offcanvas mr-0 mr-lg-2">
                            <div class="cart-overlay"></div>
                            <a href="javascript:void(0)" onclick="showSideCart()" class="cart-toggle label-down link">
                                <i class="w-icon-cart">
                                    <span class="cart-count">0</span>
                                </i>
                                <span class="cart-label">Cart</span>
                            </a>
                            <div class="dropdown-box sideCart">
                               
                            </div>
                            <!-- End of Dropdown Box -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of Header Middle -->

            <div class="header-bottom sticky-content fix-top sticky-header">
                <div class="container">
                    <div class="inner-wrap">
                        <div class="header-left">
                            <div class="dropdown category-dropdown has-border " data-visible="true">
                                <a href="#" class="category-toggle" role="button" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="true" data-display="static"
                                    title="Browse Categories">
                                    <i class="w-icon-category"></i>
                                    <span>Browse Categories</span>
                                </a>
                                <div class="dropdown-box text-default">
                                    <ul class="menu vertical-menu category-menu"> 
                                    @foreach ($categorymain as $categoriesmain)
                                       @if(count($categoriesmain->submenu) > 0)                                       
                                        <li>
                                            <a href="{{ url( 'mainCategoryShop/'.$categoriesmain->id ) }}">
                                               
                                                {{ $categoriesmain->category_main_name }}
                                            </a>
                                            <ul class="megamenu">
                                                @foreach($categoriesmain->submenu as $submenus)                                                
                                                @if(count($submenus->childmenu) > 0)
                                                <li>
                                                    <a href="{{ url( 'categoryShop/'.$submenus->id ) }}"><h4 class="menu-title">{{ $submenus->category_name }}</h4></a>
                                                    <hr class="divider">
                                                    <ul>
                                                        @foreach($submenus->childmenu as $childmenus)                                                        
                                                            <li><a href="{{ url( 'categoryShop/'.$submenus->id.'/'.$childmenus->id ) }}">{{ $childmenus->category_sub_name }} </a></li>                                                
                                                         @endforeach
                                                    </ul>
                                                  
                                                </li>
                                                @else
                                                <li><a href="{{ url( 'Categoryproductshow/'.$submenus->id ) }}">{{ $submenus->category_name }}</a></li> 
                                                @endif
                                                @endforeach
                                                
                                               
                                            </ul>
                                        </li>
                                        @else
                                      <li><a href="{{ url( 'MainCatergoryproductshow/'.$categoriesmain->id ) }}">{{ $categoriesmain->category_main_name }}</a></li> 
                                       @endif
                                       @endforeach                                     
                                    </ul>
                                     
                                </div>
                              
                            </div>
                            <nav class="main-nav">
                                <ul class="menu active-underline">
                                    <li>
                                        <a href="{{ url('demoEight') }}">Home</a>
                                    </li>
                                    {{-- <li>
                                        <a href="shop-banner-sidebar.html">Shop</a>

                                        <ul class="megamenu">
                                            <li>
                                                <h4 class="menu-title">Shop Pages</h4>
                                                <ul>
                                                    <li><a href="shop-banner-sidebar.html">Banner With Sidebar</a></li>
                                                    <li><a href="shop-boxed-banner.html">Boxed Banner</a></li>
                                                    <li><a href="shop-fullwidth-banner.html">Full Width Banner</a></li>
                                                    <li><a href="shop-horizontal-filter.html">Horizontal Filter<span
                                                                class="tip tip-hot">Hot</span></a></li>
                                                    <li><a href="shop-off-canvas.html">Off Canvas Sidebar<span
                                                                class="tip tip-new">New</span></a></li>
                                                    <li><a href="shop-infinite-scroll.html">Infinite Ajax Scroll</a>
                                                    </li>
                                                    <li><a href="shop-right-sidebar.html">Right Sidebar</a></li>
                                                    <li><a href="shop-both-sidebar.html">Both Sidebar</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <h4 class="menu-title">Shop Layouts</h4>
                                                <ul>
                                                    <li><a href="shop-grid-3cols.html">3 Columns Mode</a></li>
                                                    <li><a href="shop-grid-4cols.html">4 Columns Mode</a></li>
                                                    <li><a href="shop-grid-5cols.html">5 Columns Mode</a></li>
                                                    <li><a href="shop-grid-6cols.html">6 Columns Mode</a></li>
                                                    <li><a href="shop-grid-7cols.html">7 Columns Mode</a></li>
                                                    <li><a href="shop-grid-8cols.html">8 Columns Mode</a></li>
                                                    <li><a href="shop-list.html">List Mode</a></li>
                                                    <li><a href="shop-list-sidebar.html">List Mode With Sidebar</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <h4 class="menu-title">Product Pages</h4>
                                                <ul>
                                                    <li><a href="product-variable.html">Variable Product</a></li>
                                                    <li><a href="product-featured.html">Featured &amp; Sale</a></li>
                                                    <li><a href="product-accordion.html">Data In Accordion</a></li>
                                                    <li><a href="product-section.html">Data In Sections</a></li>
                                                    <li><a href="product-swatch.html">Image Swatch</a></li>
                                                    <li><a href="product-extended.html">Extended Info</a>
                                                    </li>
                                                    <li><a href="product-without-sidebar.html">Without Sidebar</a></li>
                                                    <li><a href="product-video.html">360<sup>o</sup> &amp; Video<span
                                                                class="tip tip-new">New</span></a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <h4 class="menu-title">Product Layouts</h4>
                                                <ul>
                                                    <li><a href="product-default.html">Default<span
                                                                class="tip tip-hot">Hot</span></a></li>
                                                    <li><a href="product-vertical.html">Vertical Thumbs</a></li>
                                                    <li><a href="product-grid.html">Grid Images</a></li>
                                                    <li><a href="product-masonry.html">Masonry</a></li>
                                                    <li><a href="product-gallery.html">Gallery</a></li>
                                                    <li><a href="product-sticky-info.html">Sticky Info</a></li>
                                                    <li><a href="product-sticky-thumb.html">Sticky Thumbs</a></li>
                                                    <li><a href="product-sticky-both.html">Sticky Both</a></li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </li> --}}
                                    <li >
                                        <a href="{{ url('vendorDokenGrid') }}">Shops</a>
                                        {{-- <ul>
                                            <li>
                                                <a href="vendor-dokan-store-list.html">Store Listing</a>
                                                <ul>
                                                    <li><a href="vendor-dokan-store-list.html">Store listing 1</a></li>
                                                    <li><a href="vendor-wcfm-store-list.html">Store listing 2</a></li>
                                                    <li><a href="vendor-wcmp-store-list.html">Store listing 3</a></li>
                                                    <li><a href="vendor-wc-store-list.html">Store listing 4</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="vendor-dokan-store.html">Vendor Store</a>
                                                <ul>
                                                    <li><a href="vendor-dokan-store.html">Vendor Store 1</a></li>
                                                    <li><a href="vendor-wcfm-store-product-grid.html">Vendor Store 2</a>
                                                    </li>
                                                    <li><a href="vendor-wcmp-store-product-grid.html">Vendor Store 3</a>
                                                    </li>
                                                    <li><a href="vendor-wc-store-product-grid.html">Vendor Store 4</a>
                                                    </li>
                                                </ul>
                                            </li>

                                            
                                        </ul> --}}
                                    </li>

                                        {{-- <li >
                                        <a href="vendor-dokan-store.html">Offers</a>
                                        
                                    </li> --}}
                                    {{-- <li>
                                        <a href="blog.html">Blog</a>
                                        <ul>
                                            <li><a href="blog.html">Classic</a></li>
                                            <li><a href="blog-listing.html">Listing</a></li>
                                            <li>
                                                <a href="blog-grid-3cols.html">Grid</a>
                                                <ul>
                                                    <li><a href="blog-grid-2cols.html">Grid 2 columns</a></li>
                                                    <li><a href="blog-grid-3cols.html">Grid 3 columns</a></li>
                                                    <li><a href="blog-grid-4cols.html">Grid 4 columns</a></li>
                                                    <li><a href="blog-grid-sidebar.html">Grid sidebar</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="blog-masonry-3cols.html">Masonry</a>
                                                <ul>
                                                    <li><a href="blog-masonry-2cols.html">Masonry 2 columns</a></li>
                                                    <li><a href="blog-masonry-3cols.html">Masonry 3 columns</a></li>
                                                    <li><a href="blog-masonry-4cols.html">Masonry 4 columns</a></li>
                                                    <li><a href="blog-masonry-sidebar.html">Masonry sidebar</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="blog-mask-grid.html">Mask</a>
                                                <ul>
                                                    <li><a href="blog-mask-grid.html">Blog mask grid</a></li>
                                                    <li><a href="blog-mask-masonry.html">Blog mask masonry</a></li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="post-single.html">Single Post</a>
                                            </li>
                                        </ul>
                                    </li> --}}
                                    {{-- <li>
                                        <a href="about-us.html">Pages</a>
                                        <ul>

                                            <li><a href="about-us.html">About Us</a></li>
                                            <li><a href="become-a-vendor.html">Become A Vendor</a></li>
                                            <li><a href="contact-us.html">Contact Us</a></li>
                                            <li><a href="faq.html">FAQs</a></li>
                                            <li><a href="error-404.html">Error 404</a></li>
                                            <li><a href="coming-soon.html">Coming Soon</a></li>
                                            <li><a href="wishlist.html">Wishlist</a></li>
                                            <li><a href="cart.html">Cart</a></li>
                                            <li><a href="checkout.html">Checkout</a></li>
                                            <li><a href="my-account.html">My Account</a></li>
                                            <li><a href="compare.html">Compare</a></li>
                                        </ul>
                                    </li> --}}
                                    {{-- <li>
                                        <a href="elements.html">Elements</a>
                                        <ul>
                                            <li><a href="element-accordions.html">Accordions</a></li>
                                            <li><a href="element-alerts.html">Alert &amp; Notification</a></li>
                                            <li><a href="element-blog-posts.html">Blog Posts</a></li>
                                            <li><a href="element-buttons.html">Buttons</a></li>
                                            <li><a href="element-cta.html">Call to Action</a></li>
                                            <li><a href="element-icons.html">Icons</a></li>
                                            <li><a href="element-icon-boxes.html">Icon Boxes</a></li>
                                            <li><a href="element-instagrams.html">Instagrams</a></li>
                                            <li><a href="element-categories.html">Product Category</a></li>
                                            <li><a href="element-products.html">Products</a></li>
                                            <li><a href="element-tabs.html">Tabs</a></li>
                                            <li><a href="element-testimonials.html">Testimonials</a></li>
                                            <li><a href="element-titles.html">Titles</a></li>
                                            <li><a href="element-typography.html">Typography</a></li>

                                            <li><a href="element-vendors.html">Vendors</a></li>
                                        </ul>
                                    </li> --}}
                                </ul>
                            </nav>
                        </div>
                        <div class="header-right">
                            <a href="{{ url('offers') }}"><i class="w-icon-sale"></i>Offer Products</a>
                            <a href="#" class="d-xl-show"><i class="w-icon-map-marker mr-1"></i>Track Order</a>
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- End of Header -->