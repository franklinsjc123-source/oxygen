<div class="page-sidebar">
    <div class="main-header-left d-none d-lg-block">
        <div class="logo-wrapper">
            <a href="index.php">
                <img class="blur-up lazyloaded" src="{{ asset('assets/images/dashboard/logo/logo.png') }}" alt="">
            </a>
        </div>
    </div>
    <div class="sidebar custom-scrollbar mt-3">
        <div class="sidebar-user text-center d-none">
            <div>
                <img class="img-60 rounded-circle lazyloaded blur-up"
                    src="{{ asset('assets/images/dashboard/man.png') }}" alt="#">
            </div>
            <h6 class="mt-3 f-14">JOHN</h6>
            <p>general manager.</p>
        </div>
        <ul class="sidebar-menu">
            @if (session()->get('login_id'))
            <li><a class="sidebar-header" href="{{ url('vendar/dashboard/'.session()->get('login_id')) }}"><i
                        data-feather="home"></i><span>Dasshboard</span></a></li>

                {{-- category --}}
                <li><a class="sidebar-header" href="#"><i data-feather="box"></i> <span>Category</span><i
                    class="fa fa-angle-right pull-right"></i></a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{ route('vendorcategory.sub.index') }}"><i class="fa fa-circle"></i>Sub Category</a></li>
                    </ul>
                </li>
            
            
            
            <li><a class="sidebar-header" href="#"><i data-feather="box"></i> <span>Products</span><i
                        class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li><a href="{{ route('vendorproductscreate') }}"><i class="fa fa-circle"></i>Add Product</a></li>
                    <!--<li><a href=" {{ route('vendorattribute.master.index') }}"><i class="fa fa-circle"></i> Attributes</a>
                    </li>-->
                 <li><a href="{{ route('vendorproducts.crud.listing') }}"><i class="fa fa-circle"></i>Product List</a>
                    </li>
                    <li><a href="{{ url('vendar/specification_groups') }}"><i class="fa fa-circle"></i>
                            Specification</a>
                    </li>

                    {{--   <li><a href="{{ route('product.specification.index') }}"><i class="fa fa-circle"></i>
                        Offers</a>              
                    </li>  --}}
                    <!--<li><a href="{{ route('vendorproductcollection.master.index') }}"><i class="fa fa-circle"></i>Product-->
                    <!--        Collection</a>-->
                    <!--</li>-->
                   
                </ul>
            </li>
           
            <li><a class="sidebar-header" href=""> <i data-feather="navigation"></i> <span>Sales</span><i
                        class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li><a href="{{ route('vendor.order') }}"><i class="fa fa-circle"></i>Orders</a></li>
                    <li><a href="{{ route('vendor.transaction') }}"><i class="fa fa-circle"></i>Transactions</a></li>
                </ul>
            </li>
            {{-- <li><a class="sidebar-header" href=""><i data-feather="gift"></i><span>Coupons</span><i
                        class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li><a href="{{ route('coupon.couponlisting') }}"><i class="fa fa-circle"></i>List Coupons</a></li>
                    <li><a href="{{ route('coupon.index') }}"><i class="fa fa-circle"></i>Create Coupons </a></li>
                </ul>
            </li> --}}


            {{-- <li><a class="sidebar-header" href="#"><i data-feather="box"></i> <span>Banners</span><i
                        class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li><a href="{{ url('advbanner') }}"><i class="fa fa-circle"></i>Paid Adv Banner</a></li>
                    <li><a href="{{ url('advoxygen') }}"><i class="fa fa-circle"></i>oxygen Adv </a></li>
                    <li><a href="{{ url('banners.slider') }}"><i class="fa fa-circle"></i>Main Slider</a></li>
                </ul>
            </li> --}}

            {{-- <li><a class="sidebar-header" href=""><i data-feather="gift"></i><span>Auction</span><i
                        class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li><a href="{{ url('auction/list') }}"><i class="fa fa-circle"></i>List Auction</a></li>
                    <li><a href="{{ url('auction/create') }}"><i class="fa fa-circle"></i>Create Auction </a></li>
                </ul>
            </li> --}}
            <li><a class="sidebar-header" href=""><i data-feather="percent"></i><span>Offers</span><i
                        class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li><a href="{{ route('vendoroffer.list.index') }}"><i class="fa fa-circle"></i>List Offers</a></li>
                    <li><a href="{{ route('vendoroffer.main.create') }}"><i class="fa fa-circle"></i>Create Offer </a></li>

                </ul>
            </li>
            <li><a class="sidebar-header" href=""><i data-feather="target"></i><span>Marketing</span><i
                class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li><a href="{{ route('vendorwhatsapp.index') }}"><i class="fa fa-circle"></i>Whatsapp</a></li>
                    <li><a href="{{ route('vendorfacebook.index') }}"><i class="fa fa-circle"></i>Facebook</a></li>
                    <li><a href="{{ route('vendorinstagram.index')}}"><i class="fa fa-circle"></i>Instagram</a></li>
                    <li><a href="{{ route('vendoroxygen.index') }}"><i class="fa fa-circle"></i>Oxygen Promo</a></li>
                </ul>
            </li>
           
         
           {{--<li><a class="sidebar-header" href=""><i data-feather="users"></i><span>Vendors</span><i
                class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li><a href="{{ route('vendor-list') }}"><i class="fa fa-circle"></i>Vendor List</a></li>
                    <li><a href="{{ route('vendorcreate.index') }}"><i class="fa fa-circle"></i>Create Vendor</a>
                    </li>
                </ul>
            </li>
             @if (session()->get('level') == 5)
                <li><a class="sidebar-header" href=""><i data-feather="users"></i><span>Vendors</span><i
                            class="fa fa-angle-right pull-right"></i></a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{ url('vendor/list') }}"><i class="fa fa-circle"></i>Vendor List</a></li>
                        <li><a href="{{ route('vendorcreate.index') }}"><i class="fa fa-circle"></i>Create Vendor</a>
                        </li>
                    </ul>
                </li>
            @endif --}}
            

            <li><a class="sidebar-header" href=""><i data-feather="settings"></i><span>Settings</span><i
                        class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li><a href="{{ url('vendar/profile') }}"><i class="fa fa-circle"></i>Profile</a></li>
                </ul>
            </li>
            @if (session()->get('level') == 5 || session()->get('level') == 4)
                <li><a class="sidebar-header" href="#"><i data-feather="bar-chart"></i><span>Reports</span></a>
                </li>
                <li><a class="sidebar-header" href="{{ route('logout') }}"><i
                            data-feather="log-in"></i><span>Logout</span></a>
                </li>
            @endif
            @endif
        </ul>
    </div>
</div>
