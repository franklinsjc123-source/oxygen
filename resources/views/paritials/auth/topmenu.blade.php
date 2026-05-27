{{-- ══════════════════════════════════════════════════════════════
     ADMIN MOBILE MENU DRAWER (matches customer mobile-menu-wrapper style)
     Self-contained CSS + JS. No dependency on sidebar-menu.js or Wolmart.
     ══════════════════════════════════════════════════════════════ --}}
<style>
#sidebar-toggle {
    display: inline-flex; align-items: center; justify-content: center;
    min-width: 44px; min-height: 44px; cursor: pointer;
    -webkit-tap-highlight-color: transparent; touch-action: manipulation;
}
.admin-mmenu-wrap { visibility:hidden; position:fixed; top:0; left:0; right:0; bottom:0; z-index:100000; transition:visibility 0.4s; }
.admin-mmenu-wrap.open { visibility:visible; }
.admin-mmenu-bg { position:fixed; left:0; top:0; bottom:0; right:0; background:#000; opacity:0; transition:opacity 0.4s; }
.admin-mmenu-wrap.open .admin-mmenu-bg { opacity:0.5; }
.admin-mmenu-x { position:fixed; right:15px; top:15px; z-index:1; opacity:0; transition:opacity 0.3s; color:#e1e1e1; font-size:28px; cursor:pointer; text-decoration:none; width:40px; height:40px; display:flex; align-items:center; justify-content:center; }
.admin-mmenu-wrap.open .admin-mmenu-x { opacity:1; }
.admin-mmenu-box { max-width:296px; width:100%; height:100%; overflow-y:auto; background:#222; box-shadow:1px 0 5px rgba(0,0,0,0.5); transform:translateX(-296px); -webkit-transform:translateX(-296px); transition:transform 0.4s; -webkit-transition:-webkit-transform 0.4s; padding:20px 15px; -webkit-overflow-scrolling:touch; }
.admin-mmenu-wrap.open .admin-mmenu-box { transform:translateX(0); -webkit-transform:translateX(0); }
.admin-mmenu-user { text-align:center; padding:15px 0 20px; border-bottom:1px solid #2e3237; margin-bottom:10px; }
.admin-mmenu-user img { width:50px; height:50px; border-radius:50%; }
.admin-mmenu-user h6 { color:#fff; margin:8px 0 2px; font-size:14px; }
.admin-mmenu-user p { color:#999; margin:0; font-size:12px; }
.admin-mmenu ul { list-style:none; padding:0; margin:0; }
.admin-mmenu > li { border-bottom:1px solid #2e3237; }
.admin-mmenu li a { display:block; padding:12px 10px; color:#eee; text-decoration:none; transition:color 0.3s; font-size:14px; }
.admin-mmenu li a:hover { color:#336699; }
.admin-mmenu .has-sub > a { display:flex; justify-content:space-between; align-items:center; cursor:pointer; }
.admin-mmenu .has-sub > a .arr { transition:transform 0.3s; font-size:12px; }
.admin-mmenu .has-sub.opened > a .arr { transform:rotate(90deg); }
.admin-mmenu .sub { display:none; background:#1a1a1a; }
.admin-mmenu .has-sub.opened .sub { display:block; }
.admin-mmenu .sub li { border-bottom:1px solid #2a2a2a; }
.admin-mmenu .sub li a { padding-left:30px; font-size:13px; color:#ccc; }
.admin-mmenu .sub li a:hover { color:#336699; }
/* Hide mobile drawer on desktop — only show on mobile/app */
@media (min-width: 992px) {
    .admin-mmenu-wrap { display:none !important; }
}
</style>

<div class="admin-mmenu-wrap" id="admMobileMenu">
    <div class="admin-mmenu-bg" id="admMobileBg"></div>
    <a href="#" class="admin-mmenu-x" id="admMobileX">&times;</a>
    <div class="admin-mmenu-box">
        <div class="admin-mmenu-user">
            <img src="{{ asset('assets/images/dashboard/man.jpeg') }}" alt="User">
            <h6>{{ session()->get('log_name') ?? 'ADMIN' }}</h6>
            <p>{{ session()->get('log_type') ?? 'Administrator' }}</p>
        </div>
        <ul class="admin-mmenu">
            <li><a href="{{ url('admin/dashboard') }}">🏠 Dashboard</a></li>
            @if (session()->get('log_type') == 'Admin')
                @php $mob_mains = App\Models\Mainmenus::where('id','!=','1')->get(); @endphp
                @foreach($mob_mains as $mm)
                    @php $mob_subs = App\Models\Submenus::where('main_menu','=',$mm->id)->get(); @endphp
                    <li class="has-sub">
                        <a href="#">{{ $mm->title }} <span class="arr">▶</span></a>
                        <ul class="sub">
                            @foreach($mob_subs as $sm)
                                <li><a href="{{ $sm->type=='route' ? route($sm->link) : url($sm->link) }}">{{ $sm->title }}</a></li>
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            @else
                @php
                    $mob_sid = session()->get('login_id');
                    $mob_mains = App\Models\Mainmenus::where('id','!=','1')->get();
                    $mob_stf = App\Models\Staffcreates::where('employee_id','=',$mob_sid)->first();
                    $mob_sr = $mob_stf ? App\Models\StaffRole::where('department','=',$mob_stf->department)->where('designation','=',$mob_stf->designation)->first() : null;
                    $mob_rs = \Illuminate\Support\Facades\Session::get('roll');
                    $mob_smm = [];
                    if ($mob_sr) { $mob_smm = explode(',', $mob_sr->mainmenus); }
                    elseif ($mob_rs && count($mob_rs) > 0 && !empty($mob_rs[0]->permission_id)) {
                        $d = json_decode($mob_rs[0]->permission_id, true);
                        if (is_array($d) || is_object($d)) { $mob_smm = array_values((array)$d); }
                    }
                @endphp
                @foreach($mob_mains as $mm)
                    @if(in_array($mm->id, $mob_smm))
                        @php $mob_subs = App\Models\Submenus::where('main_menu','=',$mm->id)->get(); @endphp
                        <li class="has-sub">
                            <a href="#">{{ $mm->title }} <span class="arr">▶</span></a>
                            <ul class="sub">
                                @foreach($mob_subs as $sm)
                                    @php $canSee = $mob_sr ? in_array($sm->id, explode(',', $mob_sr->submenus)) : true; @endphp
                                    @if($canSee)
                                        <li><a href="{{ $sm->type=='route' ? route($sm->link) : url($sm->link) }}">{{ $sm->title }}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </li>
                    @endif
                @endforeach
            @endif
            <li><a href="{{ url('admin/logout') }}">🔓 Logout</a></li>
        </ul>
    </div>
</div>

<div class="page-wrapper" id="top-menu">

    <!-- Page Header Start-->
    <div class="page-main-header">
        <div class="main-header-right row p-0 align-items-center">
            
            <!-- 1. Left side: Breadcrumb/Toggle button -->
            <div class="mobile-sidebar w-auto col-auto">
                <div class="media-body text-end switch-sm">
                    <!-- Desktop Toggle -->
                    <a href="javascript:void(0)" 
                    class="sidebar-toggle-btn d-none d-lg-inline-block" 
                    id="sidebar-toggle" 
                    aria-label="Toggle sidebar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" 
                            fill="none" stroke="currentColor" stroke-width="2" 
                            stroke-linecap="round" stroke-linejoin="round" 
                            style="pointer-events:none;">
                            <line x1="17" y1="10" x2="3" y2="10"></line>
                            <line x1="21" y1="6" x2="3" y2="6"></line>
                            <line x1="21" y1="14" x2="3" y2="14"></line>
                            <line x1="17" y1="18" x2="3" y2="18"></line>
                        </svg>
                    </a>
                    <!-- Mobile Toggle -->
                    <a href="javascript:void(0)" 
                    class="mobile-drawer-toggle-btn d-inline-block d-lg-none" 
                    id="mobile-drawer-toggle" 
                    style="color: inherit;"
                    aria-label="Toggle mobile menu">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" 
                            fill="none" stroke="currentColor" stroke-width="2" 
                            stroke-linecap="round" stroke-linejoin="round" 
                            style="pointer-events:none;">
                            <line x1="17" y1="10" x2="3" y2="10"></line>
                            <line x1="21" y1="6" x2="3" y2="6"></line>
                            <line x1="21" y1="14" x2="3" y2="14"></line>
                            <line x1="17" y1="18" x2="3" y2="18"></line>
                        </svg>
                    </a>
                </div>
            </div>

            <!-- 2. Center: Logo (mobile only) -->
            <div class="main-header-left d-lg-none col text-center">
                <div class="logo-wrapper" style="display: inline-block;"><a href="{{ url('admin/dashboard') }}"><img class="blur-up lazyloaded"
                            src="{{ asset('assets/images/dashboard/logo/newlogo.png') }}" alt="Logo" style="max-height: 45px; object-fit: contain;"></a></div>
            </div>
<script>
// Admin mobile menu toggle — runs immediately (button exists above this script)
(function(){
    var w = document.getElementById('admMobileMenu');
    var bg = document.getElementById('admMobileBg');
    var x = document.getElementById('admMobileX');
    var btn = document.getElementById('mobile-drawer-toggle');
    if (!w || !btn) return;

    function openM() { w.classList.add('open'); }
    function closeM() { w.classList.remove('open'); }

    // Overlay & close
    bg.addEventListener('click', closeM);
    bg.addEventListener('touchstart', function(e){ e.preventDefault(); closeM(); }, {passive:false});
    x.addEventListener('click', function(e){ e.preventDefault(); closeM(); });
    x.addEventListener('touchstart', function(e){ e.preventDefault(); closeM(); }, {passive:false});

    // Submenu accordion
    w.addEventListener('click', function(e){
        var t = e.target.closest('.has-sub > a');
        if(!t) return;
        e.preventDefault();
        t.parentElement.classList.toggle('opened');
    });

    // Toggle button — capture phase to block sidebar-menu.js
    var tf = false;
    btn.addEventListener('touchstart', function(e){
        e.preventDefault(); e.stopPropagation(); e.stopImmediatePropagation();
        tf = true; openM();
        setTimeout(function(){ tf=false; }, 800);
    }, true);
    btn.addEventListener('click', function(e){
        e.preventDefault(); e.stopPropagation(); e.stopImmediatePropagation();
        if(tf) return; openM();
    }, true);
})();
</script>

             @php
                $user_info = "App\Models\User"::where('id', session('userId'))->first();

                //    dd($user_info);

                $userId = session('userId');


                $adminorders_pro = DB::table('ordersproducts')
                    ->join('products_details', 'ordersproducts.product_id', '=', 'products_details.id')
                    ->join('products', 'products.id', '=', 'products_details.products_id')
                    ->where('products.created_by', 1)
                    ->where('products.logintype', 'Admin')
                    ->whereIn('ordersproducts.order_status', ['New', 'Accept', 'Dispatch', 'Delivery', 'Cancel', 'Return'])
                    ->count();
                //  dd($adminorders_pro);

                //dd($user_info->login_id);
                $vendarorders_pro = DB::table('ordersproducts')
                    ->join('products_details', 'ordersproducts.product_id', '=', 'products_details.id')
                    ->join('products', 'products_details.products_id', '=', 'products.product_id')
                    ->where('products.login_id', $user_info->login_id)
                    ->where('products.logintype', 'Vendor')
                    //->where('ordersproducts.order_status', 'New')
                    ->whereIn('ordersproducts.order_status', ['New', 'Accept', 'Dispatch', 'Delivery', 'Cancel', 'Return'])
                    ->count();
                // dd($vendarorders_pro);


                $adminorders_pro1 = DB::table('ordersproducts')
                    ->join('products_details', 'ordersproducts.product_id', '=', 'products_details.id')
                    ->join('products', 'products.id', '=', 'products_details.products_id')
                    ->where('products.created_by', 1)
                    ->where('products.logintype', 'Admin')
                    ->whereIn('ordersproducts.order_status', ['New', 'Accept', 'Dispatch', 'Delivery', 'Cancel', 'Return'])
                    ->first();
                //dd($adminorders_pro1);



                $vendarorders_pro1 = DB::table('ordersproducts')
                    ->join('products_details', 'ordersproducts.product_id', '=', 'products_details.id')
                    ->join('products', 'products.id', '=', 'products_details.products_id')
                    ->where('products.logintype', 'Vendor')


                    ->get();


                //    dd($vendarorders_pro1);
                $orderspro = DB::table('notifications')->get();

                $venorderspro = DB::table('notifications')->where('login_id', '<>', 1)->get();





            @endphp
            <div class="nav-right col">
                <ul class="nav-menus">
                    <li class="onhover-dropdown"><i data-feather="bell"></i><span
                            class="badge badge-pill badge-primary pull-right notification-badge">{{($adminorders_pro) ? $adminorders_pro : $vendarorders_pro}}</span><span
                            class="dot"></span>
                        <ul class="notification-dropdown onhover-show-div p-0">
                            
                         
                            
                            @if(!empty($adminorders_pro1) || empty($adminorders_pro1))




                                @if(isset($adminorders_pro1) && $adminorders_pro1->created_by == 1)
                                       @foreach ($orderspro as $item)
                                                @php           
                                                                                                    $ptime1 = $item->created_at;
                                                    $ptime = strtotime($ptime1);
                                                    // echo time_elapsed_string($ptime);
                                                @endphp
                                        @if ($item->details == "New")
                                            <li>New Order {{$item->orders_id}} Placed by Admin<span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $adminorders_pro}}</a></span></li>
                                        @elseif($item->details == "Accept")
                                            @php
                                                $acc_count = DB::table('notifications')->where('details', 'Accept')->count();
                                                $acc_count1 = DB::table('notifications')->where('details', 'Accept')->get();
                                            @endphp
                                            <li>Orders {{$acc_count1->orders_id}}have been Accepted by Admin<span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $acc_count }}</a></span></li>
                                        @elseif($item->details == "Dispatch")
                                            @php
                                                $acc_count = DB::table('notifications')->where('details', 'Dispatch')->count();
                                                //  dd($acc_count); // This dd() function will halt execution, remove it if not needed
                                            @endphp
                                            <li>Orders have been Dispatched by Admin<span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $adminorders_pro}}</a></span></li>
                                        @elseif($item->details == "Delivered")
                                                @php
                                                    $acc_count = DB::table('notifications')->where('details', 'Delivered')->count();
                                                    //  dd($acc_count); // This dd() function will halt execution, remove it if not needed
                                                @endphp
                                                <li>Orders have been Delivered by Admin<span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $adminorders_pro}}</a></span></li>


                                            @elseif($item->details == "Cancel")
                                                <li>New Order {{$item->orders_id}}has been Canceled by {{$item->login_id}}<span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $adminorders_pro}}</a></span></li>

                                            @elseif($item->details == "Return")
                                                <li>New Order {{$item->orders_id}} has been Return by {{$item->login_id}}<span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $adminorders_pro}}</a></span></li>

                                            @endif

                                    @endforeach     


                                 @elseif($vendarorders_pro1)
                                     {{-- [0]->logintype =='Vendor' --}}
                                        @foreach($venorderspro as $item)

                                                @php           
                                                                                            $ptime1 = $item->created_at;
                                                    $ptime = strtotime($ptime1);
                                                    // echo time_elapsed_string($ptime);
                                                    $userId = session('userId');

                                                @endphp


                                                @if ($item->details == "New")

                                                    <li>New Order {{$item->orders_id}} Placed by Vendar<span class="badge badge-pill badge-primary pull-right"> <a href="{{ route('order') }}">{{ $adminorders_pro}}</a></span></li>
                                                @elseif($item->details == "Accept")

                                                                                 @php
                                                                                    $acc_count = DB::table('notifications')->where('details', 'Accept')->count();
                                                                                    $acc_count1 = DB::table('notifications')->where('details', 'Accept')->get();


                                                                                 @endphp

                                                                                <li>Orders  
                                                                                {{ isset($acc_count1[0]->orders_id) ?
                                                    ($acc_count1[0]->orders_id ? $acc_count1[0]->orders_id . ' has been Accepted by Vendor' : 'Not Accepted')
                                                    : 'NA' 
                                                                                            }}
                                                                                        <span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $acc_count }}</a></span></li>
                                                @elseif($item->details == "Dispatch")
                                                                                 @php
                                                                                    $acc_count = DB::table('notifications')->where('details', 'Dispatch')->count();
                                                                                    $acc_count1 = DB::table('notifications')->where('details', 'Dispatch')->get();

                                                                                 @endphp
                                                                                <li>Orders
                                                                                {{ isset($acc_count1[0]->orders_id) ?
                                                    ($acc_count1[0]->orders_id ? $acc_count1[0]->orders_id . 'has been Dispatched by Vendor' : 'Not Accepted')
                                                    : 'NA' 
                                                                                            }}


                                                                               <span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $acc_count}}</a></span></li>
                                                @elseif($item->details == "Cancel")
                                                    <li>New Order has been Canceled by {{$item->login_id}}<span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $adminorders_pro}}</a></span></li>

                                                 @endif

                                            @if ($item->details == "New")
                                                <li>New Order Placed by Vendar<span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $acc_count}}</a></span></li>
                                            @elseif($item->details == "Accept" && $item->login_id == 1)
                                                @php
                                                    $acc_count = DB::table('notifications')->where('details', 'Accept')->count();
                                                    $acc_count1 = DB::table('notifications')->where('details', 'Accept')->get();
                                                @endphp
                                                <li>Orders {{ $acc_count1->orders_id }} have been Accepted by Vendar<span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $acc_count }}</a></span></li>
                                            @elseif($item->details == "Dispatch" && $item->login_id == 1)
                                                @php
                                                    $acc_count = DB::table('notifications')->where('details', 'Dispatch')->count();
                                                    $acc_count1 = DB::table('notifications')->where('details', 'Dispatch')->get();

                                                    //  dd($acc_count); // This dd() function will halt execution, remove it if not needed
                                                @endphp
                                                <li>Orders {{$acc_count1->orders_id }} have been Dispatched by Vendar<span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $adminorders_pro}}</a></span></li>



                                            @elseif($item->details == "Delivered" && $item->login_id == 1)
                                                                                @php
                                                                                    $acc_count = DB::table('notifications')->where('details', 'Delivered')->count();
                                                                                    $acc_count1 = DB::table('notifications')->where('details', 'Delivered')->get();

                                                                                    //  dd($acc_count); // This dd() function will halt execution, remove it if not needed
                                                                                @endphp
                                                                                <li>Orders

                                                                                {{ isset($acc_count1[0]->orders_id) ?
                                                    ($acc_count1[0]->orders_id ? $acc_count1[0]->orders_id . 'have been Delivered by Vendar' : 'Not Accepted')
                                                    : 'NA' 
                                                                                            }}
                                                                                <span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $adminorders_pro}}</a></span></li>


                                                @elseif($item->details == "Cancel")

                                                    <li>New Order has been Canceled by {{$item->login_id}}<span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $adminorders_pro}}</a></span></li>

                                                @elseif($item->details == "Return")
                                                    <li>New Order has been Return by {{$item->login_id}}<span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $adminorders_pro}}</a></span></li>

                                                @endif

                                        @endforeach  


                                @else

                                    <li>Notification Vendar  product<span class="badge badge-pill badge-primary pull-right">{{ $vendarorders_pro}}</span></li>     

                                @endif


                            @elseif($vendarorders_pro1[0]->logintype == 'Vendor')

                                    @foreach($venorderspro as $item)

                                            @php           
                                                                                            $ptime1 = $item->created_at;
                                                $ptime = strtotime($ptime1);
                                                // echo time_elapsed_string($ptime);
                                                $userId = session('userId');

                                            @endphp


                                            @if ($item->details == "New")

                                                <li>New Order {{$item->orders_id}} Placed by Vendar<span class="badge badge-pill badge-primary pull-right"> <a href="{{ route('order') }}">{{ $adminorders_pro}}</a></span></li>
                                            @elseif($item->details == "Accept")
                                                                                 @php
                                                                                    $acc_count = DB::table('notifications')->where('details', 'Accept')->where('login_id', $userId)->count();
                                                                                    $acc_count1 = DB::table('notifications')->where('details', 'Accept')->where('login_id', $userId)->get();
                                                                                    //dd($acc_count1[0]->orders_id);

                                                                                 @endphp

                                                                                <li>Orders  

                                                                                {{ isset($acc_count1[0]->orders_id) ?
                                                ($acc_count1[0]->orders_id ? $acc_count1[0]->orders_id . ' has been Accepted by Vendor' : 'Not Accepted')
                                                : 'NA' 
                                                                                            }}
                                                                                        <span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $acc_count }}</a></span></li>
                                            @elseif($item->details == "Dispatch")
                                                                                 @php
                                                                                    $acc_count = DB::table('notifications')->where('details', 'Dispatch')->where('login_id', $userId)->count();
                                                                                    $acc_count1 = DB::table('notifications')->where('details', 'Dispatch')->where('login_id', $userId)->get();

                                                                                 @endphp
                                                                                <li>Orders
                                                                                {{ isset($acc_count1[0]->orders_id) ?
                                                ($acc_count1[0]->orders_id ? $acc_count1[0]->orders_id . 'has been Dispatched by Vendor' : 'Not Accepted')
                                                : 'NA' 
                                                                                            }}


                                                                               <span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $acc_count}}</a></span></li>
                                            @elseif($item->details == "Cancel")
                                                <li>New Order has been Canceled by {{$item->login_id}}<span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $adminorders_pro}}</a></span></li>

                                             @endif

                                        @if ($item->details == "New")
                                            <li>New Order Placed by Vendar<span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $acc_count}}</a></span></li>
                                        @elseif($item->details == "Accept" && $item->login_id == 1)
                                            @php
                                                $acc_count = DB::table('notifications')->where('details', 'Accept')->where('login_id', $userId)->count();
                                                $acc_count1 = DB::table('notifications')->where('details', 'Accept')->where('login_id', $userId)->get();
                                            @endphp
                                            <li>Orders {{ $acc_count1->orders_id }} have been Accepted by Vendar<span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $acc_count }}</a></span></li>
                                        @elseif($item->details == "Dispatch" && $item->login_id == 1)
                                            @php
                                                $acc_count = DB::table('notifications')->where('details', 'Dispatch')->where('login_id', $userId)->count();
                                                $acc_count1 = DB::table('notifications')->where('details', 'Dispatch')->where('login_id', $userId)->get();

                                                //  dd($acc_count); // This dd() function will halt execution, remove it if not needed
                                            @endphp
                                            <li>Orders {{$acc_count1->orders_id }} have been Dispatched by Vendar<span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $adminorders_pro}}</a></span></li>



                                        @elseif($item->details == "Delivered" && $item->login_id == 1)
                                                                                @php
                                                                                    $acc_count = DB::table('notifications')->where('details', 'Delivered')->where('login_id', $userId)->count();
                                                                                    $acc_count1 = DB::table('notifications')->where('details', 'Delivered')->where('login_id', $userId)->get();

                                                                                    //  dd($acc_count); // This dd() function will halt execution, remove it if not needed
                                                                                @endphp
                                                                                <li>Orders

                                                                                {{ isset($acc_count1[0]->orders_id) ?
                                                ($acc_count1[0]->orders_id ? $acc_count1[0]->orders_id . 'have been Delivered by Vendar' : 'Not Accepted')
                                                : 'NA' 
                                                                                            }}
                                                                                <span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $adminorders_pro}}</a></span></li>


                                            @elseif($item->details == "Cancel")

                                                <li>New Order has been Canceled by {{$item->login_id}}<span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $adminorders_pro}}</a></span></li>

                                            @elseif($item->details == "Return")
                                                <li>New Order has been Return by {{$item->login_id}}<span class="badge badge-pill badge-primary pull-right"><a href="{{ route('order') }}">{{ $adminorders_pro}}</a></span></li>

                                            @endif

                                    @endforeach


                                 @else

                                 <li>Notification Vendar  product<span class="badge badge-pill badge-primary pull-right">{{ $vendarorders_pro}}</span></li>     

                            @endif
                            
                           
                            <li>
                                <div class="media">
                                    <div class="media-body">
                                        <h6 class="mt-0"><span><i class="shopping-color"
                                                    data-feather="shopping-bag"></i></span>Login by {{$user_info->name }} </h6>
                                                   
                                        <p class="mb-0">Short top</p>
                                    </div>
                                </div>
                            </li>


                            <li class="txt-dark"><a href="{{ route('order') }}">All notification</a> </li>
                        </ul>
                    </li>
                    <li class="onhover-dropdown">
                        <div class="media align-items-center"><img
                                class="align-self-center pull-right img-30 rounded-circle blur-up lazyloaded"
                                src="{{ asset('assets/images/dashboard/logo/4.png') }}" alt="header-user">
                            <div class="dotted-animation"><span class="animate-circle"></span><span
                                    class="main-circle"></span></div>
                        </div>
                        <ul class="profile-dropdown onhover-show-div p-20 profile-dropdown-hover">
                            {{-- <li><a href="#"><i data-feather="user"></i>Edit Profile</a></li> --}}
                            {{-- <li><a href="#"><i data-feather="mail"></i>Inbox</a></li> --}}
                            {{-- <li><a href="#"><i data-feather="lock"></i>Lock Screen</a></li> --}}
                            {{-- <li><a href="#"><i data-feather="settings"></i>Settings</a></li> --}}
                            <li><a href="{{ url('admin/logout') }}"><i data-feather="log-out"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="d-lg-none pull-right" style="display: flex; align-items: center;">
                    <a href="{{ url('admin/logout') }}" style="color: #333; padding: 10px;">
                        <i data-feather="log-out"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
