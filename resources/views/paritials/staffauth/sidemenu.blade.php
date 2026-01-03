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
 
            <?php
use Illuminate\Support\Facades\Session; 
            $roll= Session::get('roll');
            // dd($roll);

            $staffs = json_decode($roll[0]->permission_id);
           //  print_r($roll[0]->permission_id);
            // foreach($staffs as $x => $val) {
                
            //     echo"<li>". $val . "</li>";
            //     }  
            // exit();
                ?>
                @foreach ( $staffs as $key => $val)
               @if($val == 1)
                
                <li id="{{$val}}"><a class="sidebar-header" href="{{ url('dashboard') }}"><i
                    data-feather="home"></i><span>Dashboard</span></a></li>
         
            @elseif ($val ==2)             
  
              <li ><a class="sidebar-header" href="#"><i data-feather="box"></i> <span>Category</span><i
                          class="fa fa-angle-right pull-right"></i></a>
                  <ul class="sidebar-submenu">
                      <li><a href="{{ route('staffcategory.main.index') }}"><i class="fa fa-circle"></i>Main Category</a></li>
                      <li><a href="{{ route('staffcategory.index') }}"><i class="fa fa-circle"></i>Category</a></li>
                      <li><a href="{{ route('staffcategory.sub.index') }}"><i class="fa fa-circle"></i>Sub Category</a></li>
                  </ul>
              </li>
              @elseif ($val == 3)
              <li><a class="sidebar-header" href="#"><i data-feather="box"></i> <span>Products</span><i
                          class="fa fa-angle-right pull-right"></i></a>
                  <ul class="sidebar-submenu">
                      <li><a href="{{ route('staffproducts.crud.index') }}"><i class="fa fa-circle"></i>Add Product</a></li>
                      <li><a href=" {{ route('staffattribute.master.index') }}"><i class="fa fa-circle"></i> Attributes</a>
                      </li>
  
                      <li><a href="{{ route('staffproduct.specification.index') }}"><i class="fa fa-circle"></i>
                              Specification</a>
                      </li>
  
                      {{-- <li><a href="{{ route('product.specification.index') }}"><i class="fa fa-circle"></i>
                          Offers</a>
                      </li> --}}
                      <li><a href="{{ route('staffproductcollection.master.index') }}"><i class="fa fa-circle"></i>Product
                              Collection</a>
                      </li>
                      <li><a href="{{ route('staffproducts.crud.listing') }}"><i class="fa fa-circle"></i>Product List</a>
                      </li>
                  </ul>
              </li>
              @elseif ($val ==4)
              <li><a class="sidebar-header" href=""> <i data-feather="navigation"></i> <span>Sales</span><i
                          class="fa fa-angle-right pull-right"></i></a>
                  <ul class="sidebar-submenu">
                      <li><a href="{{ route('stafforder') }}"><i class="fa fa-circle"></i>Orders</a></li>
                      <li><a href="{{ route('stafftransaction') }}"><i class="fa fa-circle"></i>Transactions</a></li>
                  </ul>
              </li>
              @elseif ($val == 5)
              <li><a class="sidebar-header" href=""><i data-feather="gift"></i><span>Coupons</span><i
                          class="fa fa-angle-right pull-right"></i></a>
                  <ul class="sidebar-submenu">
                      <li><a href="{{ route('staffcoupon.couponlisting') }}"><i class="fa fa-circle"></i>List Coupons</a></li>
                      <li><a href="{{ route('staffcoupon.index') }}"><i class="fa fa-circle"></i>Create Coupons </a></li>
                  </ul>
              </li>
  
              @elseif ($val == 6)
              <li><a class="sidebar-header" href="#"><i data-feather="box"></i> <span>Banners</span><i
                          class="fa fa-angle-right pull-right"></i></a>
                  <ul class="sidebar-submenu">
                      <li><a href="{{ route('staffadvbanner.index') }}"><i class="fa fa-circle"></i>Paid Adv Banner</a></li>
                      <li><a href="{{ route('staffadvoxygen.index') }}"><i class="fa fa-circle"></i>oxygen Adv </a></li>
                      <li><a href="{{ route('staffmain_slider.index') }}"><i class="fa fa-circle"></i>Main Slider</a></li>
                  </ul>
              </li>
              @elseif ($val == 7)
              <li><a class="sidebar-header" href=""><i data-feather="gift"></i><span>Auction</span><i
                          class="fa fa-angle-right pull-right"></i></a>
                  <ul class="sidebar-submenu">
                      <li><a href="{{ route('staffauction/list') }}"><i class="fa fa-circle"></i>List Auction</a></li>
                      <li><a href="{{ route('staffauction.create') }}"><i class="fa fa-circle"></i>Create Auction </a></li>
                  </ul>
              </li>
              @elseif ($val == 8)
              <li><a class="sidebar-header" href=""><i data-feather="percent"></i><span>Offers</span><i
                          class="fa fa-angle-right pull-right"></i></a>
                  <ul class="sidebar-submenu">
                      <li><a href="{{ route('staffoffer.list.index') }}"><i class="fa fa-circle"></i>List Offers</a></li>
                      <li><a href="{{ route('staffoffer.main.create') }}"><i class="fa fa-circle"></i>Create Offer </a></li>
                      
                  </ul>
              </li>
              @elseif ($val == 9)
              <li><a class="sidebar-header" href=""><i data-feather="target"></i><span>Marketing</span><i
                          class="fa fa-angle-right pull-right"></i></a>
                  <ul class="sidebar-submenu">
  
                      <!--<li><a href="{{ url('marketing/whatsapp') }}"><i class="fa fa-circle"></i>Whatsapp</a></li>-->
                      <!--<li><a href="{{ url('marketing/facebook') }}"><i class="fa fa-circle"></i>Facebook</a></li>-->
                      <!--<li><a href="{{ url('marketing/instagram') }}"><i class="fa fa-circle"></i>Instagram</a></li>-->
                      <!--<li><a href="{{ url('marketing/oxygen') }}"><i class="fa fa-circle"></i>Oxygen Promo</a></li>-->
                      
                      <li><a href="{{ route('staffwhatsapp.index') }}"><i class="fa fa-circle"></i>Whatsapp</a></li>
                    <li><a href="{{ route('stafffacebook.index') }}"><i class="fa fa-circle"></i>Facebook</a></li>
                    <li><a href="{{ route('staffinstagram.index')}}"><i class="fa fa-circle"></i>Instagram</a></li>
                    <li><a href="{{ route('staffoxygen.index') }}"   ><i class="fa fa-circle"></i>Oxygen Promo</a></li>
                  </ul>
              </li>
              @elseif ($val == 10)
              <li><a class="sidebar-header" href=""><i data-feather="user-plus"></i><span>Staff</span><i
                          class="fa fa-angle-right pull-right"></i></a>
                  <ul class="sidebar-submenu">
                      <li><a href="{{ url('staff/staff/create') }}"><i class="fa fa-circle"></i>Staff Create </a></li>
                      <li><a href="{{ route('sstaff-list') }}"><i class="fa fa-circle"></i>Staff Listing</a></li>
  
                  </ul>
              </li>
              @elseif ($val == 11)
              {{-- @if (session()->get('level') == 5 || session()->get('level') == 4) --}}
                  <li><a class="sidebar-header" href=""><i data-feather="user-plus"></i><span>Role</span><i
                              class="fa fa-angle-right pull-right"></i></a>
                      <ul class="sidebar-submenu">
                          <li><a href="{{ route('roll.index') }}"><i class="fa fa-circle"></i>Role Create </a></li>
                          <li><a href="{{ route('rolelist') }}"><i class="fa fa-circle"></i>Role Assign</a></li>
  
                      </ul>
                  </li>
              {{-- @endif --}}
              @elseif ($val == 12)
              <li><a class="sidebar-header" href=""><i data-feather="users"></i><span>Vendors</span><i
                  class="fa fa-angle-right pull-right"></i></a>
                  <ul class="sidebar-submenu">
                      <li><a href="{{ route('staffvendor-list') }}"><i class="fa fa-circle"></i>Vendor List</a></li>
                      <li><a href="{{ route('staffvendorcreate.index') }}"><i class="fa fa-circle"></i>Create Vendor</a>
                      </li>
                  </ul>
              </li>
              @elseif ($val == 13)
              {{-- @if (session()->get('level') == 5)
                  <li><a class="sidebar-header" href=""><i data-feather="users"></i><span>Vendors</span><i
                              class="fa fa-angle-right pull-right"></i></a>
                      <ul class="sidebar-submenu">
                          <li><a href="{{ route('staffvendor-list') }}"><i class="fa fa-circle"></i>Vendor List</a></li>
                          <li><a href="{{ route('staffvendorcreate.index') }}"><i class="fa fa-circle"></i>Create Vendor</a>
                          </li>
                      </ul>
                  </li>
              @endif --}}
              <li><a class="sidebar-header" href=""><i data-feather="bar-chart"></i><span>Activity
                          Tracker</span><i class="fa fa-angle-right pull-right"></i></a>
                  <ul class="sidebar-submenu">
                      <li><a href="{{ route('staffactivitylist') }}"><i class="fa fa-circle"></i>Acivity List</a></li>
                      <li><a href="{{ route('staffactivitycreate') }}"><i class="fa fa-circle"></i>Add Activity </a></li>
                  </ul>
              </li>
              @elseif ($val == 14)
              <li><a class="sidebar-header" href=""><i data-feather="database"></i><span>Master</span><i
                          class="fa fa-angle-right pull-right"></i></a>
                  <ul class="sidebar-submenu">
  
                      
                      <li><a href="{{ route('staffpincode1.index') }}"><i class="fa fa-circle"></i>Pincode Master</a></li>
  
                      <li><a href="{{ route('staffgst.master.index') }}"><i class="fa fa-circle"></i>GST Master</a></li>
  
                      
                      <li><a href="{{ route('staffpackage.index') }}"><i class="fa fa-circle"></i>Package Master</a></li>
                      <li><a href="{{ route('staffdepartment') }}"><i class="fa fa-circle"></i>Department</a></li>
                      <li><a href="{{ route('staffdesignation.master.index') }}"><i class="fa fa-circle"></i>Designation</a></li>
                      <li><a href="{{ route('staffzonal') }}"><i class="fa fa-circle"></i>Zonal</a></li>
                      <li><a href="{{ route('staffroute') }}"><i class="fa fa-circle"></i>Route</a></li>
  
  
                  </ul>
              </li>
              @elseif ($val == 15)
              <li><a class="sidebar-header" href=""><i data-feather="settings"></i><span>Settings</span><i
                          class="fa fa-angle-right pull-right"></i></a>
                  <ul class="sidebar-submenu">
                      <li><a href="{{ url('profile') }}"><i class="fa fa-circle"></i>Profile</a></li>
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
                @endforeach
          </ul>
    </div>
</div>
