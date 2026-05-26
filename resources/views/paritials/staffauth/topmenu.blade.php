<style>
#sidebar-toggle {
    display:inline-flex; align-items:center; justify-content:center;
    min-width:44px; min-height:44px; cursor:pointer;
    -webkit-tap-highlight-color:transparent; touch-action:manipulation;
}
.admin-mmenu-wrap{visibility:hidden;position:fixed;top:0;left:0;right:0;bottom:0;z-index:100000;transition:visibility 0.4s}
.admin-mmenu-wrap.open{visibility:visible}
.admin-mmenu-bg{position:fixed;left:0;top:0;bottom:0;right:0;background:#000;opacity:0;transition:opacity 0.4s}
.admin-mmenu-wrap.open .admin-mmenu-bg{opacity:0.5}
.admin-mmenu-x{position:fixed;right:15px;top:15px;z-index:1;opacity:0;transition:opacity 0.3s;color:#e1e1e1;font-size:28px;cursor:pointer;text-decoration:none;width:40px;height:40px;display:flex;align-items:center;justify-content:center}
.admin-mmenu-wrap.open .admin-mmenu-x{opacity:1}
.admin-mmenu-box{max-width:296px;width:100%;height:100%;overflow-y:auto;background:#222;box-shadow:1px 0 5px rgba(0,0,0,0.5);transform:translateX(-296px);-webkit-transform:translateX(-296px);transition:transform 0.4s;-webkit-transition:-webkit-transform 0.4s;padding:20px 15px;-webkit-overflow-scrolling:touch}
.admin-mmenu-wrap.open .admin-mmenu-box{transform:translateX(0);-webkit-transform:translateX(0)}
.admin-mmenu-user{text-align:center;padding:15px 0 20px;border-bottom:1px solid #2e3237;margin-bottom:10px}
.admin-mmenu-user img{width:50px;height:50px;border-radius:50%}
.admin-mmenu-user h6{color:#fff;margin:8px 0 2px;font-size:14px}
.admin-mmenu-user p{color:#999;margin:0;font-size:12px}
.admin-mmenu ul{list-style:none;padding:0;margin:0}
.admin-mmenu > li{border-bottom:1px solid #2e3237}
.admin-mmenu li a{display:block;padding:12px 10px;color:#eee;text-decoration:none;transition:color 0.3s;font-size:14px}
.admin-mmenu li a:hover{color:#336699}
.admin-mmenu .has-sub > a{display:flex;justify-content:space-between;align-items:center;cursor:pointer}
.admin-mmenu .has-sub > a .arr{transition:transform 0.3s;font-size:12px}
.admin-mmenu .has-sub.opened > a .arr{transform:rotate(90deg)}
.admin-mmenu .sub{display:none;background:#1a1a1a}
.admin-mmenu .has-sub.opened .sub{display:block}
.admin-mmenu .sub li{border-bottom:1px solid #2a2a2a}
.admin-mmenu .sub li a{padding-left:30px;font-size:13px;color:#ccc}
.admin-mmenu .sub li a:hover{color:#336699}
@media(min-width:992px){.admin-mmenu-wrap{display:none !important}}
</style>

<div class="admin-mmenu-wrap" id="admMobileMenu">
    <div class="admin-mmenu-bg" id="admMobileBg"></div>
    <a href="#" class="admin-mmenu-x" id="admMobileX">&times;</a>
    <div class="admin-mmenu-box">
        <div class="admin-mmenu-user">
            <img src="{{ asset('assets/images/dashboard/man.jpeg') }}" alt="User">
            <h6>{{ session()->get('log_name') ?? 'Staff' }}</h6>
            <p>Staff</p>
        </div>
        <ul class="admin-mmenu">
            <li><a href="{{ url('admin/dashboard') }}">🏠 Dashboard</a></li>
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
            <li><a href="{{ url('admin/logout') }}">🔓 Logout</a></li>
        </ul>
    </div>
</div>

<div class="page-wrapper">
    <div class="page-main-header">
        <div class="main-header-right row p-0">
            <div class="main-header-left d-lg-none w-auto">
                <div class="logo-wrapper"><a href="dashboard.php"><img class="blur-up lazyloaded"
                            src="{{ asset('assets/images/dashboard/logo/newlogo.png') }}" alt=""></a></div>
            </div>
            <div class="mobile-sidebar w-auto">
                <div class="media-body text-end switch-sm">
                    <a href="javascript:void(0)" class="sidebar-toggle-btn" id="sidebar-toggle" aria-label="Toggle sidebar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="pointer-events:none;"><line x1="17" y1="10" x2="3" y2="10"></line><line x1="21" y1="6" x2="3" y2="6"></line><line x1="21" y1="14" x2="3" y2="14"></line><line x1="17" y1="18" x2="3" y2="18"></line></svg>
                    </a>
                </div>
            </div>
<script>
(function(){
    var w=document.getElementById('admMobileMenu'),bg=document.getElementById('admMobileBg'),x=document.getElementById('admMobileX'),btn=document.getElementById('sidebar-toggle');
    if(!w||!btn)return;
    function openM(){w.classList.add('open')}function closeM(){w.classList.remove('open')}
    bg.addEventListener('click',closeM);bg.addEventListener('touchstart',function(e){e.preventDefault();closeM()},{passive:false});
    x.addEventListener('click',function(e){e.preventDefault();closeM()});x.addEventListener('touchstart',function(e){e.preventDefault();closeM()},{passive:false});
    w.addEventListener('click',function(e){var t=e.target.closest('.has-sub > a');if(!t)return;e.preventDefault();t.parentElement.classList.toggle('opened')});
    var tf=false;
    btn.addEventListener('touchstart',function(e){e.preventDefault();e.stopPropagation();e.stopImmediatePropagation();tf=true;openM();setTimeout(function(){tf=false},800)},true);
    btn.addEventListener('click',function(e){e.preventDefault();e.stopPropagation();e.stopImmediatePropagation();if(tf)return;openM()},true);
})();
</script>
            <div class="nav-right col">
                <ul class="nav-menus">
                    <li class="onhover-dropdown"><i data-feather="bell"></i><span
                            class="badge badge-pill badge-primary pull-right notification-badge">3</span><span
                            class="dot"></span>
                        <ul class="notification-dropdown onhover-show-div p-0">
                            <li>Notification <span class="badge badge-pill badge-primary pull-right">3</span></li>
                            <li>
                                <div class="media">
                                    <div class="media-body">
                                        <h6 class="mt-0"><span><i class="shopping-color"
                                                    data-feather="shopping-bag"></i></span>Your 1 order </h6>
                                        <p class="mb-0">Short top</p>
                                    </div>
                                </div>
                            </li>
                            <li class="txt-dark"><a href="#">All</a> notification</li>
                        </ul>
                    </li>
                    <li class="onhover-dropdown">
                        <div class="media align-items-center"><img
                                class="align-self-center pull-right img-30 rounded-circle blur-up lazyloaded"
                                src="{{ asset('assets/images/dashboard/logo/fav.png') }}" alt="header-user">
                            <div class="dotted-animation"><span class="animate-circle"></span><span
                                    class="main-circle"></span></div>
                        </div>
                        <ul class="profile-dropdown onhover-show-div p-20 profile-dropdown-hover">
                            <li><a href="#"><i data-feather="user"></i>Edit Profile</a></li>
                            <li><a href="#"><i data-feather="mail"></i>Inbox</a></li>
                            <li><a href="#"><i data-feather="lock"></i>Lock Screen</a></li>
                            <li><a href="#"><i data-feather="settings"></i>Settings</a></li>
                            <li><a href="index.php"><i data-feather="log-out"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="d-lg-none mobile-toggle pull-right"><i data-feather="more-horizontal"></i></div>
            </div>
        </div>
    </div>
