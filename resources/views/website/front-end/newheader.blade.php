<body class="theme-color-29">

    <header class="header-tools zindex-up header-style top-relative">
        <div class="mobile-fix-option"></div>
        <div class="logo-menu-part">
            <div class="container border-bottom-0 rounded-5" style="padding:10px;">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="main-menu">
						
                            <div class="menu-left">
                                <div class="brand-logo">
                                    <a href="index.php"> <img src="../assets/img/logo/logo.png"
                                            class="img-fluid lazyload" alt="" ></a>
                                </div>
								
                            </div>
							 <div>
                            <form class="form_search" role="form">
                                <input id="query search-autocomplete" type="search" placeholder="Search anything here..." class="nav-search nav-search-field" aria-expanded="true">
                                <button type="submit" name="nav-submit-button" class="btn-search">
                                    <i class="ti-search"></i>
                                </button>
                            </form>
                        </div>
                            <div class="menu-right pull-right">
                                <div class="d-md-none d-sm-block"><a href="javascript:void(0)" onclick="openNav()"><i class="fa fa-bars sidebar-bar"></i></a></div>
								
                                    
                                
                                <div class="top-header">
                                    <ul class="header-dropdown">
                                        <li class="mobile-wishlist"><a href="#"><img
                                                    src="../assets/images/icon/heart-1.png" alt=""> </a></li>
                                        <li class="onhover-dropdown mobile-account">
                                            <img src="../assets/images/icon/user-1.png" alt="">
                                            <ul class="onhover-show-div">
                                                <li>
                                                    <a href="#" data-lng="en">
                                                        Login
                                                    </a>
                                                </li>
                                                <li>
                                                    <a href="#" data-lng="es">
                                                        Logout
                                                    </a>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </div>
                                <div>
                                    <div class="icon-nav">
                                        <ul>
                                            <li class="onhover-div mobile-search d-md-none d-sm-block">
                                                <div><img src="../assets/images/icon/search.png" onclick="openSearch()"
                                                        class="img-fluid lazyload" alt="">
                                                    <i class="ti-search" onclick="openSearch()"></i>
                                                </div>
                                                <div id="search-overlay" class="search-overlay">
                                                    <div>
                                                        <span class="closebtn" onclick="closeSearch()"
                                                            title="Close Overlay">×</span>
                                                        <div class="overlay-content">
                                                            <div class="container">
                                                                <div class="row">
                                                                    <div class="col-xl-12">
                                                                        <form>
                                                                            <div class="form-group">
                                                                                <input type="text" class="form-control"
                                                                                    id="exampleInputPassword1"
                                                                                    placeholder="Search a Product">
                                                                            </div>
                                                                            <button type="submit"
                                                                                class="btn btn-primary"><i
                                                                                    class="fa fa-search"></i></button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        
                                            <li class="onhover-div mobile-cart">
                                                <div><img src="../assets/images/icon/cart-1.png"
                                                        class="img-fluid lazyload" alt="">
                                                    <i class="ti-shopping-cart cart-count"></i>
                                                </div>
                                                <ul class="show-div shopping-cart" id="cart_dt">
                                                    {{-- <li>
                                                        <div class="media">
                                                            <a href="#"><img alt="" class="me-3"
                                                                    src="../assets/img/product/saree/1.jpg"></a>
                                                            <div class="media-body">
                                                                <a href="#">
                                                                    <h4>Saree</h4>
                                                                </a>
                                                                <h4><span>1 x Rs {{session()->get('productprice') }}</span></h4>
                                                            </div>
                                                        </div>
                                                        <div class="close-circle">
                                                            <a href="#"><i class="fa fa-times"
                                                                    aria-hidden="true"></i></a>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="media">
                                                            <a href="#"><img alt="" class="me-3"
                                                                    src="../assets/img/product/top/1/1.jpg"></a>
                                                            <div class="media-body">
                                                                <a href="#">
                                                                    <h4>Top</h4>
                                                                </a>
                                                                <h4><span>1 x Rs {{ request()->session()->get('productprice') }}</span></h4>
                                                            </div>
                                                        </div>
                                                        <div class="close-circle">
                                                            <a href="#"><i class="fa fa-times"
                                                                    aria-hidden="true"></i></a>
                                                        </div>
                                                    </li> --}}
                                                    <li>
                                                        <div class="total">
                                                            <h5>Total : <span class="total"> Rs </span></h5>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="buttons">
                                                            <a href="{{ route('viewcart') }}" class="view-cart">view cart</a>
                                                            <a href="checkout.php" class="checkout">checkout</a>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
				
				
				</div>
				 <div class="container-fuild border-top-1  d-md-block d-sm-none rounded-5">
				 <div class="row">
                    <div class="col-sm-12 ">
					
					<div class="menu-left">
                           
                               
                                <div id="mySidenav" class="sidenav">
                                    <a href="javascript:void(0)" class="sidebar-overlay" onclick="closeNav()"></a>
                                    <nav>
                                        <div onclick="closeNav()">
                                            <div class="sidebar-back text-start"><i class="fa fa-angle-left pe-2"
                                                    aria-hidden="true"></i> Back</div>
                                        </div>
                                        <ul id="sub-menu" class="sm pixelstrap sm-vertical">
                                            <li>
                                                <a href="#">clothing</a>
                                                <ul class="mega-menu clothing-menu">
                                                    <li>
                                                        <div class="row m-0">
                                                            <div class="col-xl-4">
                                                                <div class="link-section">
                                                                    <h5>women's fashion</h5>
                                                                    <ul>
                                                                        <li><a href="#">dresses</a></li>
                                                                        <li><a href="#">skirts</a></li>
                                                                        <li><a href="#">westarn wear</a></li>
                                                                        <li><a href="#">ethic wear</a></li>
                                                                        <li><a href="#">sport wear</a></li>
                                                                    </ul>
                                                                    <h5>men's fashion</h5>
                                                                    <ul>
                                                                        <li><a href="#">sports wear</a></li>
                                                                        <li><a href="#">western wear</a></li>
                                                                        <li><a href="#">ethic wear</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-4">
                                                                <div class="link-section">
                                                                    <h5>accessories</h5>
                                                                    <ul>
                                                                        <li><a href="#">fashion jewellery</a></li>
                                                                        <li><a href="#">caps and hats</a></li>
                                                                        <li><a href="#">precious jewellery</a></li>
                                                                        <li><a href="#">necklaces</a></li>
                                                                        <li><a href="#">earrings</a></li>
                                                                        <li><a href="#">wrist wear</a></li>
                                                                        <li><a href="#">ties</a></li>
                                                                        <li><a href="#">cufflinks</a></li>
                                                                        <li><a href="#">pockets squares</a></li>
                                                                    </ul>
                                                                </div>
                                                            </div>
                                                            <div class="col-xl-4"><a href="#"
                                                                    class="mega-menu-banner"><img
                                                                        src="../assets/images/mega-menu/fashion.jpg"
                                                                        alt="" class="img-fluid lazyload"></a>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="#">bags</a>
                                                <ul>
                                                    <li><a href="#">shopper bags</a></li>
                                                    <li><a href="#">laptop bags</a></li>
                                                    <li><a href="#">clutches</a></li>
                                                    <li>
                                                        <a href="#">purses</a>
                                                        <ul>
                                                            <li><a href="#">purses</a></li>
                                                            <li><a href="#">wallets</a></li>
                                                            <li><a href="#">leathers</a></li>
                                                            <li><a href="#">satchels</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li>
                                                <a href="#">footwear</a>
                                                <ul>
                                                    <li><a href="#">sport shoes</a></li>
                                                    <li><a href="#">formal shoes</a></li>
                                                    <li><a href="#">casual shoes</a></li>
                                                </ul>
                                            </li>
                                            <li><a href="#">watches</a></li>
                                            <li>
                                                <a href="#">Accessories</a>
                                                <ul>
                                                    <li><a href="#">fashion jewellery</a></li>
                                                    <li><a href="#">caps and hats</a></li>
                                                    <li><a href="#">precious jewellery</a></li>
                                                    <li>
                                                        <a href="#">more..</a>
                                                        <ul>
                                                            <li><a href="#">necklaces</a></li>
                                                            <li><a href="#">earrings</a></li>
                                                            <li><a href="#">wrist wear</a></li>
                                                            <li>
                                                                <a href="#">accessories</a>
                                                                <ul>
                                                                    <li><a href="#">ties</a></li>
                                                                    <li><a href="#">cufflinks</a></li>
                                                                    <li><a href="#">pockets squares</a></li>
                                                                    <li><a href="#">helmets</a></li>
                                                                    <li><a href="#">scarves</a></li>
                                                                    <li>
                                                                        <a href="#">more...</a>
                                                                        <ul>
                                                                            <li><a href="#">accessory gift sets</a></li>
                                                                            <li><a href="#">travel accessories</a></li>
                                                                            <li><a href="#">phone cases</a></li>
                                                                        </ul>
                                                                    </li>
                                                                </ul>
                                                            </li>
                                                            <li><a href="#">belts & more</a></li>
                                                            <li><a href="#">wearable</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a href="#">house of design</a></li>
                                            <li>
                                                <a href="#">beauty & personal care</a>
                                                <ul>
                                                    <li><a href="#">makeup</a></li>
                                                    <li><a href="#">skincare</a></li>
                                                    <li><a href="#">premium beaty</a></li>
                                                    <li>
                                                        <a href="#">more</a>
                                                        <ul>
                                                            <li><a href="#">fragrances</a></li>
                                                            <li><a href="#">luxury beauty</a></li>
                                                            <li><a href="#">hair care</a></li>
                                                            <li><a href="#">tools & brushes</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a href="#">home & decor</a></li>
                                            <li><a href="#">kitchen</a></li>
                                        </ul>
                                    </nav>
                                </div>
                           
                           
                        </div>
                                    <nav id="main-nav" class="">
                                       
                                        <ul id="main-menu" class="sm pixelstrap sm-horizontal">
                                            <li>
                                                <div class="mobile-back text-end">Back<i class="fa fa-angle-right ps-2"
                                                        aria-hidden="true"></i></div>
                                            </li>
                                            
											<li>
											<a href="javascript:void(0)" onclick="openNav()">
                                    <div class="bar-style"><i class="fa fa-bars sidebar-bar" aria-hidden="true"> All</i>
                                    </div>
                                </a></li>
                                            <li class="mega" id="hover-cls">
											
                                                <a href="#">Women Ethnic </a>
                                                <ul class="mega-menu full-mega-menu">
                                                    <li>
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col mega-box">
                                                                    <div class="link-section">
                                                                        <div class="menu-title">
                                                                            <h5>Sarees</h5>
                                                                        </div>
                                                                        <div class="menu-content">
                                                                            <ul>
                                                                                <li><a href="shop.php">All Sarees</a></li>
                                                                                <li><a href="shop.php">Silk Sarees
                                                                                      </a>
                                                                                </li>
                                                                                <li><a href="shop.php">Cotton Sarees</a>
                                                                                </li>
                                                                                <li><a href="shop.php">Chiffon Sarees</a>
                                                                                </li>
                                                                                <li><a href="shop.php">Embroidered Sarees</a>
                                                                                </li>
                                                                                
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
																










                                                                <div class="col mega-box">
                                                                    <div class="link-section">
                                                                        <div class="menu-title">
                                                                            <h5>Kurtis</h5>
                                                                        </div>
                                                                        <div class="menu-content">
                                                                            <ul>
                                                                                <li><a href="shop.php">Anarkali Kurtis</a>
                                                                                </li>
                                                                                <li><a href="shop.php">Rayon Kurtis<i
                                                                                            class="ms-2 fa fa-bolt icon-trend"
                                                                                            aria-hidden="true"></i></a>
                                                                                </li>
                                                                                <li><a
                                                                                        href="shop.php">Cotton Kurtis</a>
                                                                                </li>
                                                                                <li><a href="shop.php">Embroidered Kurtis</a></li>
                                                                               
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
																








                                                                <div class="col mega-box">
                                                                    <div class="link-section">
                                                                        <div class="menu-title">
                                                                            <h5>Other Ethnic</h5>
                                                                        </div>
                                                                        <div class="menu-content">
                                                                            <ul>
                                                                                <li><a href="shop.php">Blouses<i
                                                                                            class="ms-2 fa fa-bolt icon-trend"
                                                                                            aria-hidden="true"></i></a>
                                                                                </li>
                                                                                <li><a href="shop.php">Dupattas</a></li>
                                                                                <li><a href="shop.php">Lehanga</a></li>
																				 <li><a href="shop.php">Gown</a></li>
																				  <li><a href="shop.php">Ethnic Bottomwear</a></li>
																				
																				
                                                                            </ul>
                                                                        </div>
                                                                        
                                                                       
                                                                    </div>
                                                                </div>
                                                                
                                                               
                                                            </div>
                                                         
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                            
                                           <li class="mega" id="hover-cls">
                                                <a href="#">Men</a>
                                                <ul class="mega-menu full-mega-menu">
                                                    <li>
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col mega-box">
                                                                    <div class="link-section">
                                                                        <div class="menu-title">
                                                                            <h5>Sarees</h5>
                                                                        </div>
                                                                        <div class="menu-content">
                                                                            <ul>
                                                                                <li><a href="shop.php">All Sarees</a></li>
                                                                                <li><a href="shop.php">Silk Sarees
                                                                                      </a>
                                                                                </li>
                                                                                <li><a href="shop.php">Cotton Sarees</a>
                                                                                </li>
                                                                                <li><a href="shop.php">Chiffon Sarees</a>
                                                                                </li>
                                                                                <li><a href="shop.php">Embroidered Sarees</a>
                                                                                </li>
                                                                                
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
																










                                                                <div class="col mega-box">
                                                                    <div class="link-section">
                                                                        <div class="menu-title">
                                                                            <h5>Kurtis</h5>
                                                                        </div>
                                                                        <div class="menu-content">
                                                                            <ul>
                                                                                <li><a href="shop.php">Anarkali Kurtis</a>
                                                                                </li>
                                                                                <li><a href="shop.php">Rayon Kurtis<i
                                                                                            class="ms-2 fa fa-bolt icon-trend"
                                                                                            aria-hidden="true"></i></a>
                                                                                </li>
                                                                                <li><a
                                                                                        href="shop.php">Cotton Kurtis</a>
                                                                                </li>
                                                                                <li><a href="shop.php">Embroidered Kurtis</a></li>
                                                                               
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
																








                                                                <div class="col mega-box">
                                                                    <div class="link-section">
                                                                        <div class="menu-title">
                                                                            <h5>Other Ethnic</h5>
                                                                        </div>
                                                                        <div class="menu-content">
                                                                            <ul>
                                                                                <li><a href="shop.php">Blouses<i
                                                                                            class="ms-2 fa fa-bolt icon-trend"
                                                                                            aria-hidden="true"></i></a>
                                                                                </li>
                                                                                <li><a href="shop.php">Dupattas</a></li>
                                                                                <li><a href="shop.php">Lehanga</a></li>
																				 <li><a href="shop.php">Gown</a></li>
																				  <li><a href="shop.php">Ethnic Bottomwear</a></li>
																				
																				
                                                                            </ul>
                                                                        </div>
                                                                        
                                                                       
                                                                    </div>
                                                                </div>
                                                                
                                                               
                                                            </div>
                                                         
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                            
                                            <li class="mega" id="hover-cls">
                                                <a href="#">Women Ethnic </a>
                                                <ul class="mega-menu full-mega-menu">
                                                    <li>
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col mega-box">
                                                                    <div class="link-section">
                                                                        <div class="menu-title">
                                                                            <h5>Sarees</h5>
                                                                        </div>
                                                                        <div class="menu-content">
                                                                            <ul>
                                                                                <li><a href="shop.php">All Sarees</a></li>
                                                                                <li><a href="shop.php">Silk Sarees
                                                                                      </a>
                                                                                </li>
                                                                                <li><a href="shop.php">Cotton Sarees</a>
                                                                                </li>
                                                                                <li><a href="shop.php">Chiffon Sarees</a>
                                                                                </li>
                                                                                <li><a href="shop.php">Embroidered Sarees</a>
                                                                                </li>
                                                                                
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
																










                                                                <div class="col mega-box">
                                                                    <div class="link-section">
                                                                        <div class="menu-title">
                                                                            <h5>Kurtis</h5>
                                                                        </div>
                                                                        <div class="menu-content">
                                                                            <ul>
                                                                                <li><a href="shop.php">Anarkali Kurtis</a>
                                                                                </li>
                                                                                <li><a href="shop.php">Rayon Kurtis<i
                                                                                            class="ms-2 fa fa-bolt icon-trend"
                                                                                            aria-hidden="true"></i></a>
                                                                                </li>
                                                                                <li><a
                                                                                        href="shop.php">Cotton Kurtis</a>
                                                                                </li>
                                                                                <li><a href="shop.php">Embroidered Kurtis</a></li>
                                                                               
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
																








                                                                <div class="col mega-box">
                                                                    <div class="link-section">
                                                                        <div class="menu-title">
                                                                            <h5>Other Ethnic</h5>
                                                                        </div>
                                                                        <div class="menu-content">
                                                                            <ul>
                                                                                <li><a href="shop.php">Blouses<i
                                                                                            class="ms-2 fa fa-bolt icon-trend"
                                                                                            aria-hidden="true"></i></a>
                                                                                </li>
                                                                                <li><a href="shop.php">Dupattas</a></li>
                                                                                <li><a href="shop.php">Lehanga</a></li>
																				 <li><a href="shop.php">Gown</a></li>
																				  <li><a href="shop.php">Ethnic Bottomwear</a></li>
																				
																				
                                                                            </ul>
                                                                        </div>
                                                                        
                                                                       
                                                                    </div>
                                                                </div>
                                                                
                                                               
                                                            </div>
                                                         
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                            
                                           
										   <li class="mega" id="hover-cls">
                                                <a href="#">Women Ethnic </a>
                                                <ul class="mega-menu full-mega-menu">
                                                    <li>
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col mega-box">
                                                                    <div class="link-section">
                                                                        <div class="menu-title">
                                                                            <h5>Sarees</h5>
                                                                        </div>
                                                                        <div class="menu-content">
                                                                            <ul>
                                                                                <li><a href="shop.php">All Sarees</a></li>
                                                                                <li><a href="shop.php">Silk Sarees
                                                                                      </a>
                                                                                </li>
                                                                                <li><a href="shop.php">Cotton Sarees</a>
                                                                                </li>
                                                                                <li><a href="shop.php">Chiffon Sarees</a>
                                                                                </li>
                                                                                <li><a href="shop.php">Embroidered Sarees</a>
                                                                                </li>
                                                                                
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
																










                                                                <div class="col mega-box">
                                                                    <div class="link-section">
                                                                        <div class="menu-title">
                                                                            <h5>Kurtis</h5>
                                                                        </div>
                                                                        <div class="menu-content">
                                                                            <ul>
                                                                                <li><a href="shop.php">Anarkali Kurtis</a>
                                                                                </li>
                                                                                <li><a href="shop.php">Rayon Kurtis<i
                                                                                            class="ms-2 fa fa-bolt icon-trend"
                                                                                            aria-hidden="true"></i></a>
                                                                                </li>
                                                                                <li><a
                                                                                        href="shop.php">Cotton Kurtis</a>
                                                                                </li>
                                                                                <li><a href="shop.php">Embroidered Kurtis</a></li>
                                                                               
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
																








                                                                <div class="col mega-box">
                                                                    <div class="link-section">
                                                                        <div class="menu-title">
                                                                            <h5>Other Ethnic</h5>
                                                                        </div>
                                                                        <div class="menu-content">
                                                                            <ul>
                                                                                <li><a href="shop.php">Blouses<i
                                                                                            class="ms-2 fa fa-bolt icon-trend"
                                                                                            aria-hidden="true"></i></a>
                                                                                </li>
                                                                                <li><a href="shop.php">Dupattas</a></li>
                                                                                <li><a href="shop.php">Lehanga</a></li>
																				 <li><a href="shop.php">Gown</a></li>
																				  <li><a href="shop.php">Ethnic Bottomwear</a></li>
																				
																				
                                                                            </ul>
                                                                        </div>
                                                                        
                                                                       
                                                                    </div>
                                                                </div>
                                                                
                                                               
                                                            </div>
                                                         
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
                                            
										
											
											
											
											
											<li class="mega" id="hover-cls">
                                                <a href="#">Women Ethnic </a>
                                                <ul class="mega-menu full-mega-menu">
                                                    <li>
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col mega-box">
                                                                    <div class="link-section">
                                                                        <div class="menu-title">
                                                                            <h5>Sarees</h5>
                                                                        </div>
                                                                        <div class="menu-content">
                                                                            <ul>
                                                                                <li><a href="shop.php">All Sarees</a></li>
                                                                                <li><a href="shop.php">Silk Sarees
                                                                                      </a>
                                                                                </li>
                                                                                <li><a href="shop.php">Cotton Sarees</a>
                                                                                </li>
                                                                                <li><a href="shop.php">Chiffon Sarees</a>
                                                                                </li>
                                                                                <li><a href="shop.php">Embroidered Sarees</a>
                                                                                </li>
                                                                                
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
																










                                                                <div class="col mega-box">
                                                                    <div class="link-section">
                                                                        <div class="menu-title">
                                                                            <h5>Kurtis</h5>
                                                                        </div>
                                                                        <div class="menu-content">
                                                                            <ul>
                                                                                <li><a href="shop.php">Anarkali Kurtis</a>
                                                                                </li>
                                                                                <li><a href="shop.php">Rayon Kurtis<i
                                                                                            class="ms-2 fa fa-bolt icon-trend"
                                                                                            aria-hidden="true"></i></a>
                                                                                </li>
                                                                                <li><a
                                                                                        href="shop.php">Cotton Kurtis</a>
                                                                                </li>
                                                                                <li><a href="shop.php">Embroidered Kurtis</a></li>
                                                                               
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
																








                                                                <div class="col mega-box">
                                                                    <div class="link-section">
                                                                        <div class="menu-title">
                                                                            <h5>Other Ethnic</h5>
                                                                        </div>
                                                                        <div class="menu-content">
                                                                            <ul>
                                                                                <li><a href="shop.php">Blouses<i
                                                                                            class="ms-2 fa fa-bolt icon-trend"
                                                                                            aria-hidden="true"></i></a>
                                                                                </li>
                                                                                <li><a href="shop.php">Dupattas</a></li>
                                                                                <li><a href="shop.php">Lehanga</a></li>
																				 <li><a href="shop.php">Gown</a></li>
																				  <li><a href="shop.php">Ethnic Bottomwear</a></li>
																				
																				
                                                                            </ul>
                                                                        </div>
                                                                        
                                                                       
                                                                    </div>
                                                                </div>
                                                                
                                                               
                                                            </div>
                                                         
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
											<li class="mega" id="hover-cls">
                                                <a href="#">Women Ethnic </a>
                                                <ul class="mega-menu full-mega-menu">
                                                    <li>
                                                        <div class="container">
                                                            <div class="row">
                                                                <div class="col mega-box">
                                                                    <div class="link-section">
                                                                        <div class="menu-title">
                                                                            <h5>Sarees</h5>
                                                                        </div>
                                                                        <div class="menu-content">
                                                                            <ul>
                                                                                <li><a href="shop.php">All Sarees</a></li>
                                                                                <li><a href="shop.php">Silk Sarees
                                                                                      </a>
                                                                                </li>
                                                                                <li><a href="shop.php">Cotton Sarees</a>
                                                                                </li>
                                                                                <li><a href="shop.php">Chiffon Sarees</a>
                                                                                </li>
                                                                                <li><a href="shop.php">Embroidered Sarees</a>
                                                                                </li>
                                                                                
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
																










                                                                <div class="col mega-box">
                                                                    <div class="link-section">
                                                                        <div class="menu-title">
                                                                            <h5>Kurtis</h5>
                                                                        </div>
                                                                        <div class="menu-content">
                                                                            <ul>
                                                                                <li><a href="shop.php">Anarkali Kurtis</a>
                                                                                </li>
                                                                                <li><a href="shop.php">Rayon Kurtis<i
                                                                                            class="ms-2 fa fa-bolt icon-trend"
                                                                                            aria-hidden="true"></i></a>
                                                                                </li>
                                                                                <li><a
                                                                                        href="shop.php">Cotton Kurtis</a>
                                                                                </li>
                                                                                <li><a href="shop.php">Embroidered Kurtis</a></li>
                                                                               
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
																








                                                                <div class="col mega-box">
                                                                    <div class="link-section">
                                                                        <div class="menu-title">
                                                                            <h5>Other Ethnic</h5>
                                                                        </div>
                                                                        <div class="menu-content">
                                                                            <ul>
                                                                                <li><a href="shop.php">Blouses<i
                                                                                            class="ms-2 fa fa-bolt icon-trend"
                                                                                            aria-hidden="true"></i></a>
                                                                                </li>
                                                                                <li><a href="shop.php">Dupattas</a></li>
                                                                                <li><a href="shop.php">Lehanga</a></li>
																				 <li><a href="shop.php">Gown</a></li>
																				  <li><a href="shop.php">Ethnic Bottomwear</a></li>
																				
																				
                                                                            </ul>
                                                                        </div>
                                                                        
                                                                       
                                                                    </div>
                                                                </div>
                                                                
                                                               
                                                            </div>
                                                         
                                                        </div>
                                                    </li>
                                                </ul>
                                            </li>
											
                                        </ul>
                                    </nav>
                                </div>
            </div>
			</div>
			 </div>
            </div>
        </div>
    </header>
    <!-- header end -->