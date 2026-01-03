@section('sidemenu')

<div class="page-sidebar">
    <div class="main-header-left d-none d-lg-block">
        <div class="logo-wrapper"><a href="index.php"><img class="blur-up lazyloaded" src="../assets/images/dashboard/logo/logo.png" alt=""></a></div>
    </div>
    <div class="sidebar custom-scrollbar">
        <div class="sidebar-user text-center d-none">
            <div><img class="img-60 rounded-circle lazyloaded blur-up" src="../assets/images/dashboard/man.png" alt="#">
            </div>
            <h6 class="mt-3 f-14">JOHN</h6>
            <p>general manager.</p>
        </div>
        <ul class="sidebar-menu">
            <li><a class="sidebar-header" href="dashboard.php"><i data-feather="home"></i><span>Dashboard</span></a></li>
            <li><a class="sidebar-header" href="#"><i data-feather="box"></i> <span>Products</span><i class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                           
                            <li><a href="product_listing.php"><i class="fa fa-circle"></i>Product List</a></li>
                           
                  
                </ul>
            </li>
            <li><a class="sidebar-header" href=""> <i data-feather="navigation"></i> <span>Sales</span><i class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li><a href="order_list.php"><i class="fa fa-circle"></i>Orders</a></li>
                    <li><a href="order_transaction.php"><i class="fa fa-circle"></i>Transactions</a></li>
                </ul>
            </li>
            <li><a class="sidebar-header" href=""><i data-feather="tag"></i><span>Coupons</span><i class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li><a href="list_coupon.php"><i class="fa fa-circle"></i>List Coupons</a></li>
                  
                </ul>
            </li>
            <li><a class="sidebar-header" href=""><i data-feather="percent"></i><span>Offers</span><i class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li><a href="offerslist.php"><i class="fa fa-circle"></i>List Offers</a></li>
                  
                </ul>
            </li>
          
          

            <li><a class="sidebar-header" href=""><i data-feather="users"></i><span>Activity Tracker</span><i class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li><a href="list_activity.php"><i class="fa fa-circle"></i>Acivity List</a></li>
                    <li><a href="activity_tracker.php"><i class="fa fa-circle"></i>Add Activity </a></li>
                </ul>
            </li>
           
          
            <li><a class="sidebar-header" href=""><i data-feather="settings" ></i><span>Settings</span><i class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li><a href="profile.php"><i class="fa fa-circle"></i>Profile</a></li>
                </ul>
            </li>
<li><a class="sidebar-header" href="#"><i data-feather="bar-chart"></i><span>Reports</span></a></li>
            <li><a class="sidebar-header" href="index.php"><i data-feather="log-in"></i><span>Logout</span></a>
            </li>
        </ul>
    </div>
</div>
@endsection