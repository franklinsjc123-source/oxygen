@php
    $vendorProfile = null;
    $staffName = '';
    $staff = null;
    if (session()->get('login_id')) {
        $vendorProfile = App\Models\vendor\vendorcreate::select('shop_name', 'owner_name', 'profile_image', 'staff_id')
            ->where('id', session()->get('login_id'))
            ->first();
            
        if (isset($vendorProfile->staff_id)) {
            $staff = App\Models\Staffcreates::find($vendorProfile->staff_id);
            if ($staff) {
                $staffName = 'RM: ' . ($staff->fullname ?? $staff->username);
            }
        }
    }
    $vendorName = optional($vendorProfile)->shop_name ?: (optional($vendorProfile)->owner_name ?: (session()->get('username') ?: 'Vendor'));
    $vendorRole = optional($vendorProfile)->owner_name ?: 'Vendor Panel';
    $vendorImage = optional($vendorProfile)->profile_image && file_exists(public_path('assets/images/vendor/profile/' . $vendorProfile->profile_image))
        ? asset('assets/images/vendor/profile/' . $vendorProfile->profile_image)
        : asset('assets/images/dashboard/man.jpeg');
    
    $staffImage = isset($staff) && isset($staff->profileimage) && $staff->profileimage != '-' && file_exists(public_path('assets/images/staffcreate/' . $staff->profileimage))
        ? asset('assets/images/staffcreate/' . $staff->profileimage)
        : asset('assets/images/dashboard/man.jpeg');
@endphp
<div class="page-sidebar">
    <div class="main-header-left d-none d-lg-block">
        <div class="logo-wrapper">
            <a href="index.php">
                <img class="blur-up lazyloaded" src="{{ asset('assets/images/dashboard/logo/logo.png') }}" alt="">
            </a>
        </div>
    </div>
    <div class="sidebar custom-scrollbar mt-3">
        <div class="sidebar-user text-center">
            <div>
                <img class="img-60 rounded-circle lazyloaded blur-up"
                    src="{{ $vendorImage }}" alt="{{ $vendorName }}">
            </div>
            <h6 class="mt-3 f-14">{{ $vendorName }}</h6>
            <p>{{ $vendorRole }}</p>
        </div>
        <ul class="sidebar-menu">
            @if (session()->get('login_id'))
            <li><a class="sidebar-header" href="{{ url('vendor/dashboard/'.session()->get('login_id')) }}"><i
                        data-feather="home"></i><span>Dashboard</span></a></li>

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
                    <li><a href="{{ route('vendorattribute.master.index') }}"><i class="fa fa-circle"></i> Attributes</a></li>
                 <li><a href="{{ route('vendorproducts.crud.listing') }}"><i class="fa fa-circle"></i>Product List</a>
                    </li>
                    <li><a href="{{ url('vendor/specification_groups') }}"><i class="fa fa-circle"></i>
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
                    <li><a href="{{ url('vendor/profile') }}"><i class="fa fa-circle"></i>Profile</a></li>
                </ul>
            </li>
            @if (session()->get('level') == 5 || session()->get('level') == 4)
                <li><a class="sidebar-header" href="#"><i data-feather="bar-chart"></i><span>Reports</span></a>
                </li>
            @endif
            <li><a class="sidebar-header" href="{{ route('logout') }}"><i
                        data-feather="log-out"></i><span>Logout</span></a>
            </li>

            @endif
            
            @if(isset($staff) && $staff)
            <style>
                .rm-card {
                    background: linear-gradient(135deg, rgba(255, 255, 255, 0.08) 0%, rgba(255, 255, 255, 0.02) 100%);
                    border: 1px solid rgba(255, 255, 255, 0.08);
                    border-radius: 12px;
                    padding: 10px 12px;
                    margin: 25px 8px 15px 8px;
                    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
                    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
                    position: relative;
                    overflow: hidden;
                }

                .rm-card::before {
                    content: '';
                    position: absolute;
                    top: -50%;
                    left: -50%;
                    width: 200%;
                    height: 200%;
                    background: radial-gradient(circle, rgba(255, 255, 255, 0.03) 0%, transparent 70%);
                    pointer-events: none;
                }

                .rm-card:hover {
                    transform: translateY(-2px);
                    box-shadow: 0 8px 25px rgba(0, 0, 0, 0.25);
                    border-color: rgba(255, 255, 255, 0.18);
                    background: linear-gradient(135deg, rgba(255, 255, 255, 0.12) 0%, rgba(255, 255, 255, 0.04) 100%);
                }

                .rm-badge {
                    display: inline-block;
                    font-size: 8px;
                    font-weight: 800;
                    text-transform: uppercase;
                    letter-spacing: 1px;
                    padding: 3px 8px;
                    border-radius: 20px;
                    background: rgba(255, 193, 7, 0.15);
                    color: #ffc107;
                    margin-bottom: 8px;
                    border: 1px solid rgba(255, 193, 7, 0.2);
                }

                .rm-avatar-container {
                    position: relative;
                    width: 32px;
                    height: 32px;
                    margin-right: 8px;
                    flex-shrink: 0;
                }

                .rm-avatar {
                    width: 100%;
                    height: 100%;
                    object-fit: cover;
                    border-radius: 50%;
                    border: 2px solid rgba(255, 255, 255, 0.15);
                    box-shadow: 0 4px 8px rgba(0,0,0,0.15);
                    transition: all 0.3s ease;
                }

                .rm-card:hover .rm-avatar {
                    border-color: #ffc107;
                    transform: scale(1.05);
                }

                .rm-status-dot {
                    position: absolute;
                    bottom: 0px;
                    right: 0px;
                    width: 8px;
                    height: 8px;
                    background-color: #2ecc71;
                    border: 1.5px solid #1a3344;
                    border-radius: 50%;
                    box-shadow: 0 0 0 1.5px rgba(46, 204, 113, 0.4);
                    animation: pulse-green-rm 2s infinite;
                }

                @keyframes pulse-green-rm {
                    0% {
                        box-shadow: 0 0 0 0 rgba(46, 204, 113, 0.7);
                    }
                    70% {
                        box-shadow: 0 0 0 5px rgba(46, 204, 113, 0);
                    }
                    100% {
                        box-shadow: 0 0 0 0 rgba(46, 204, 113, 0);
                    }
                }

                .rm-info {
                    flex-grow: 1;
                }

                .rm-name {
                    margin: 0 0 2px 0;
                    color: #ffffff;
                    font-size: 11.5px;
                    font-weight: 700;
                    letter-spacing: 0.3px;
                    text-transform: uppercase;
                    white-space: nowrap;
                }

                .rm-phone {
                    margin: 0;
                    font-size: 10.5px;
                    color: rgba(255, 255, 255, 0.75);
                    display: flex;
                    align-items: center;
                    gap: 5px;
                    text-decoration: none;
                    transition: color 0.2s ease;
                    font-weight: 500;
                    white-space: nowrap;
                }

                .rm-phone:hover {
                    color: #ffc107;
                }

                .rm-phone i {
                    font-size: 9px;
                    color: #ffc107;
                }
            </style>
            <div class="rm-card">
                <div class="rm-badge">Support</div>
                <div class="d-flex align-items-center">
                    <div class="rm-avatar-container">
                        <img class="rm-avatar lazyloaded blur-up" src="{{ $staffImage }}" alt="RM">
                        <div class="rm-status-dot"></div>
                    </div>
                    <div class="rm-info">
                        <h6 class="rm-name">RM: {{ $staff->fullname ?? $staff->username }}</h6>
                        <a href="tel:{{ $staff->mobileno }}" class="rm-phone">
                            <i class="fa fa-phone"></i> {{ $staff->mobileno }}
                        </a>
                    </div>
                </div>
            </div>
            @endif
            
        </ul>
    </div>
</div>
