<style>
.cart-count
{
    background-color: green;
    padding: 5px;
    border-radius: 50px;
    color: #fff;
    font-size: 12px;
}
#header {
  position: fixed;
}

#content {
  margin-top: 100px;
}
</style>

<header id="header" class="header-tools zindex-up header-style top-relative">
    <div class="mobile-fix-option"></div>
    <div style="background-color: #0088dd;" class="logo-menu-part">
        <div class="container-fuild  px-3  border-bottom-0 rounded-5">
            <div class="row">
                <div class="col-sm-12">
                    <div class="main-menu">
                    <div class="col-md-3  col-sm-6 col-6">
                        <div class="menu-left">
                        <div class="navbar">
                        <a href="javascript:void(0)" onclick="openNav()">
                                <div class="bar-style px-2"><i class="fa fa-bars sidebar-bar" style="font-size: 25px;color: #000;" aria-hidden="true"></i>
                                </div>
                            </a>
                            
                        <div id="mySidenav" class="sidenav">
                                <a href="javascript:void(0)" class="sidebar-overlay" onclick="closeNav()"></a>
                                <nav>
                                    <div onclick="closeNav()">
                                        <div class="sidebar-back text-start"><i class="fa fa-angle-left pe-2"
                                                aria-hidden="true"></i> Back</div>
                                    </div>
                                    <ul id="sub-menu" class="sm pixelstrap sm-vertical">
                                      
                                         <li>
                                            <a href="{{ url( '/' ) }}">HOME</a>
                                            
                                        </li> 
                                       
                                       <?php
                                        // $menu = App\Http\Controllers\Website\Home\HomeController::menu();
                                        // print_r($menu);
                                        use App\Models\Category\CategoryMain;
                                        use App\Models\Category\Category;
                                        use App\Models\Category\CategorySub;

                                        $categorymain = CategoryMain::get();
                                        $category = Category::get();
                                        $categorysub = CategorySub::get();                                        
                                       ?>
                                       
                                       @foreach ($categorymain as $categoriesmain)
                                       @if(count($categoriesmain->submenu) > 0)
                                       <li>
                                           <a href="{{ url( 'MainCatergoryproductshow/'.$categoriesmain->id ) }}">{{ $categoriesmain->category_main_name }}</a>
                                           <ul>                                            
                                               @foreach($categoriesmain->submenu as $submenus)                                                
                                               @if(count($submenus->childmenu) > 0)
                                               <li>
                                                   <a href="{{ url( 'Categoryproductshow/'.$submenus->id ) }}">{{ $submenus->category_name }}</a>
                                                   <ul>
                                                       @foreach($submenus->childmenu as $childmenus)                                                        
                                                           <li><a href="{{ url( 'Subcategoryproductshow/'.$childmenus->id ) }}">{{ $childmenus->category_sub_name }}</a></li>                                                
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

                                       
                                            <li><a href="{{ route('auction') }}">Auction</a></li> 
                                    </ul>
                                </nav>
                            </div> </div>
                            <div class="brand-logo">
                                <a href="{{ url( '/' ) }}"> <img src="{{ asset('frontend_assets/img/logo/logo.png' ) }}"
                                        class="img-fluid lazyload" alt="" ></a>
                            </div>
                        </div>
                        </div>
                        <div class="col-md-6 col-sm-6 col-6">
                         <div class="pt-1">
                            <form action="{{ route('productsearchdetails') }}" class="form_search m-auto" role="form" method="post">
                                  @csrf
                            <input id="keywords" name ="keywords" type="search" placeholder="Search anything here..." class="nav-search nav-search-field" aria-expanded="true">
                            <button type="submit" name="nav-submit-button" class="btn-search">
                                <i class="ti-search"></i>
                            </button>
                        </form>
                            </div></div>
                            <div class="col-md-3 col-sm-6 col-6">
                        <div class="menu-right">
                           
                            <div class="top-header">
                                <ul class="header-dropdown">
                                    
                                    <li class="onhover-dropdown mobile-account">
                                        <img src="{{ asset('frontend_assets/images/icon/user-1.png') }}" alt="">
                                        <ul class="onhover-show-div">
                                            <li>
                                                {{-- <a href="{{ route('userlogin') }}" data-lng="en">
                                                    Login
                                                    
                                                </a> --}}
                                            </li>
                                            
                                            @if(!empty(session('userId')))
                                            <li><a href="{{route('UserSettings')}}" data-lng="es">user setting</a></li> 
                                            <li><a href="{{route('ordersdetails')}}" data-lng="es">user Orders</a></li> 
                                           
                                            <li>
                                                <a href="{{ route('userlogout') }}" data-lng="es">
                                                    Logout
                                                </a>
                                            </li>
                                            @else
                                            <li>
                                                
                                                <a href="{{ route('userlogin') }}" data-lng="en">
                                                    Sign in
                                                    
                                                </a>
                                            </li>
                                            <li>
                                                
                                                <a href="{{ route('usersignin.index') }}" data-lng="en">
                                                    Sign up
                                                    
                                                </a>
                                            </li>
                                            
                                            
                                            @endif
                                            
                                        </ul>
                                        
                                          <p>Profile</p>
                                          
                                    </li>
                                  &nbsp;&nbsp;
                                    
                                    <li class="mobile-wishlist"><a href="#"><img
                                                src="{{ asset('frontend_assets/images/icon/heart-1.png') }}" alt=""> </a>
                                                
                                          <p>Wishlist</p>
                                          
                                                </li>
                                                 
                                          &nbsp;&nbsp;      
                                </ul>
                                
                            </div>
                            <div>
                                <div class="icon-nav">
                                    <ul>
                                        
                                       
                                        <li class="onhover-div mobile-cart" title="Cart">
                                            <div><img src="{{ asset('frontend_assets/images/icon/cart-1.png ') }}"
                                                    class="img-fluid lazyload" alt="">
                                                <i class="ti-shopping-cart"></i>
                                                <span style="background-color:#3dd6ef" class="cart-count">0</span>
                                                 
                                          <p>Cart</p>
                                            </div>
                                          
                                            <ul class="show-div shopping-cart" id="cart_dt">
                                                
                                                <li>
                                                    <div class="buttons">
                                                        {{-- <a href="{{ route('viewcart') }}" class="view-cart">view cart</a> --}}
                                                        <a href="" class="view-cart">view cart</a>
                                                        <a href="#" class="checkout">checkout</a>
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
        </div>
         <?php 
       
        $categorymain = App\Models\Category\CategoryMain::where('status',1)->limit(7)->get();
        $category = App\Models\Category\Category::where('status',1)->get();
        $Categorysub = App\Models\Category\CategorySub::where('status',1)->get();
        ?>
        
         <div  class="container-fuild">
        <div class="col-md-12 m-auto">
            <div class="row margin-default ratio_square">               
                
                    <!-- <div class="col-xl-1 p-0 col-sm-1 col-3">
                        <a href="#">
                            <div class="img-category">
                                <a href="{{route('allproductshow')}}">
                                <div class="img-sec">
                                    <img  src="  "class="img-fluid bg-img" alt="">
                                </div>
                                  </a>   
                                 <h6>ALL</h6>                                 
                            </div>
                        </a>
                    </div>
                    
                    
                    <div class="col-xl-1 p-0 col-sm-1 col-3">
                        <a href="#">
                            <div class="img-category">
                                <a href="{{ route('allvendors') }}">
                                <div class="img-sec">
                                    <img  src="  "class="img-fluid bg-img" alt="">
                                </div>
                                  </a>   
                                 <h6>VENDORS</h6>                                 
                            </div>
                        </a>
                    </div>
                    
                    <div class="col-xl-1 p-0 col-sm-1 col-3">
                        <a href="#">
                            <div class="img-category">
                                <a href="{{route('alloffers')}}">
                                <div class="img-sec">
                                    <img  src="  "class="img-fluid bg-img" alt="">
                                </div>
                                  </a>   
                                 <h6>DEALS</h6>                                 
                            </div>
                        </a>
                    </div> -->
                 
                           



                                {{-- <nav id="main-nav navbar">
                                      
                                    <div class="toggle-nav"><i class="fa fa-bars sidebar-bar"></i></div>
                                    <ul id="main-menu" class="sm pixelstrap sm-horizontal" style="background-color: #e6eff7;">
                                        <li>
                                            <div class="mobile-back text-end">Back<i class="fa fa-angle-right ps-2" aria-hidden="true"></i></div>
                                        </li>
                                        <li class="mega" id="hover-cls">
                                        <a href="{{route('allproductshow')}}">
                                            <div class="">                                            
                                                    <div class="img-category">                                                   
                                                        <div class="img-sec">
                                                            <img  src="  "class="img-fluid bg-img" alt="">
                                                        </div>                                                     
                                                        <h6>ALL</h6>                                
                                                    </div>                                            
                                            </div>
                                        </a>
                                        </li>

                                        <li class="mega" id="hover-cls">
                                        <a href="{{ route('allvendors') }}">
                                            <div class="">                                            
                                                    <div class="img-category">                                                   
                                                        <div class="img-sec">
                                                            <img  src="  "class="img-fluid bg-img" alt="">
                                                        </div>                                                     
                                                        <h6>VENDORS</h6>                                
                                                    </div>                                            
                                            </div>
                                        </a>
                                        </li>

                                        <li class="mega" id="hover-cls">
                                        <a href="{{route('alloffers')}}">
                                            <div class="">                                            
                                                    <div class="img-category">                                                   
                                                        <div class="img-sec">
                                                            <img  src="  "class="img-fluid bg-img" alt="">
                                                        </div>                                                     
                                                        <h6>DEALS</h6>                                
                                                    </div>                                            
                                            </div>
                                        </a>
                                        </li>
                                        @foreach ($categorymain as $categoriesmain)
                                       @if(count($categoriesmain->submenu) > 0)
                                        <li class="mega" id="hover-cls" class="">
                                            <a href="{{ url( 'MainCatergoryproductshow/'.$categoriesmain->id ) }}">
                                                 <div class="">           <!--col-xl-1 p-0 col-sm-1 col-3  -->
                                                        <div class="img-category">                                                   
                                                            <div class="img-sec" width="100px" heigth="100px">
                                                                <img  src=" {{ asset('assets/images/categoryMain') . '/' . $categoriesmain->category_main_image }} "class="img-fluid bg-img" alt="">
                                                            </div>                                                     
                                                            <h6>{{ $categoriesmain->category_main_name }}</h6>
                                                        </div>                                            
                                                </div>
                                            </a>
                                            <ul class="mega-menu full-mega-menu border border-info" style="min-width: 160px;">
                                            @foreach($categoriesmain->submenu as $submenus)                                                
                                               @if(count($submenus->childmenu) > 0)
                                                <li>
                                                    <div class="container">
                                                        <div class="row">
                                                            <div class="col">
                                                                <div class="link-section">
                                                                    <div class="menu-title">
                                                                        <!--<h5>{{ $submenus->category_name }}</h5>-->
                                                                              <a style="color: #808080;" href="{{ url( 'Categoryproductshow/'.$submenus->id ) }}">{{ $submenus->category_name }}</a>
                                                                    </div>
                                                                    <div class="menu-content">
                                                                        <ul>
                                                                        @foreach($submenus->childmenu as $childmenus)
                                                                            <li style="text-indent: 2px;"><a style="color: #808080;" href="{{ url( 'Subcategoryproductshow/'.$childmenus->id ) }}">{{ $childmenus->category_sub_name }}</a>
                                                                            </li>
                                                                        @endforeach 
                                                                        </ul>
                                                                    </div>
                                                                </div>
                                                            </div>                                                            
                                                        </div>                                                        
                                                    </div>
                                                </li>
                                                @else
                                               <li><a style="color: #35bbdb;" href="{{ url( 'Categoryproductshow/'.$submenus->id ) }}">{{ $submenus->category_name }}</a></li>
                                                @endif
                                               @endforeach
                                            </ul>
                                        </li>  
                                        @else
                                      <li>
                                      <a href="index.html">
                                                <div class="">                                            
                                                        <div class="img-category">                                                   
                                                            <div class="img-sec">
                                                                <img  src="  "class="img-fluid bg-img" alt="">
                                                            </div>                                                     
                                                            <h6>{{ $categoriesmain->category_main_name }}</h6>
                                                        </div>                                            
                                                </div>
                                            </a>
                                      </li> 
                                        @endif
                                       @endforeach                                      
                                    </ul>
                                </nav> --}}
            </div>
        </div>
    </div>
    </div>
    

</header>


