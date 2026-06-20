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
.admin-mmenu-box { max-width:296px; width:100%; height:100%; overflow-y:auto; background:#192c3a; box-shadow:1px 0 5px rgba(0,0,0,0.5); transform:translateX(-296px); -webkit-transform:translateX(-296px); transition:transform 0.4s; -webkit-transition:-webkit-transform 0.4s; padding:30px 20px; -webkit-overflow-scrolling:touch; }
.admin-mmenu-wrap.open .admin-mmenu-box { transform:translateX(0); -webkit-transform:translateX(0); }
.admin-mmenu-user { text-align:center; padding:0 0 30px; border-bottom:1px solid rgba(255,255,255,0.05); margin-bottom:20px; }
.admin-mmenu-user img { width:70px; height:70px; border-radius:50%; box-shadow:0 0 20px rgba(69,162,223,0.4); border:2px solid #192c3a; }
.admin-mmenu-user h6 { color:#ff6b6b; margin:15px 0 5px; font-size:16px; font-weight:700; text-transform:uppercase; letter-spacing:1px; }
.admin-mmenu-user p { color:#7d91a1; margin:0; font-size:12px; font-weight:600; text-transform:uppercase; letter-spacing:1px; }
.admin-mmenu ul { list-style:none; padding:0; margin:0; }
.admin-mmenu > li { border:none; margin-bottom:5px; }
.admin-mmenu li a { display:flex; align-items:center; padding:12px 10px; color:#d6e5ef; text-decoration:none; transition:all 0.3s; font-size:15px; font-weight:600; border-radius:8px; }
.admin-mmenu li a svg { width:18px; height:18px; margin-right:15px; }
.admin-mmenu li a:hover, .admin-mmenu li.active > a { color:#45a2df; background:rgba(255,255,255,0.05); }
.admin-mmenu .has-sub > a { justify-content:flex-start; }
.admin-mmenu .has-sub > a .text-label { flex-grow:1; }
.admin-mmenu .has-sub > a .arr { transition:transform 0.3s; font-size:14px; margin-left:auto; font-family:monospace; }
.admin-mmenu .has-sub.opened > a .arr { transform:rotate(90deg); }
.admin-mmenu .sub { display:none; background:transparent; padding-left:35px; }
.admin-mmenu .has-sub.opened .sub { display:block; margin-top:5px; }
.admin-mmenu .sub li { border:none; }
.admin-mmenu .sub li a { padding:10px 10px; font-size:14px; color:#9ab0c1; }
.admin-mmenu .sub li a:hover { color:#45a2df; }
@media(min-width:992px){.admin-mmenu-wrap{display:none !important}}
/* Hide legacy sidebar completely on mobile to prevent flashing or layout issues */
@media (max-width: 991px) {
    .page-wrapper .page-body-wrapper .page-sidebar {
        display: none !important;
        visibility: hidden !important;
        transform: translateX(-100%) !important;
    }
    .page-wrapper .page-body-wrapper .page-sidebar ~ .page-body,
    .page-wrapper .page-body-wrapper .page-sidebar ~ footer {
        margin-left: 0 !important;
    }
}
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
            <li><a href="{{ url('admin/dashboard') }}"><i data-feather="home"></i> <span class="text-label">Dashboard</span></a></li>
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
                        <a href="#"><i data-feather="{{ $mm->font_icon }}"></i> <span class="text-label">{{ $mm->title }}</span> <span class="arr">&#10095;</span></a>
                        <ul class="sub">
                            @foreach($mob_subs as $sm)
                                @if($sm->title == 'Vendor Product List' || $sm->link == 'vendor_products.crud.listing')
                                    @continue
                                @endif
                                @php $canSee = $mob_sr ? in_array($sm->id, explode(',', $mob_sr->submenus)) : true; @endphp
                                @if($canSee)
                                    <li><a href="{{ $sm->type=='route' ? route($sm->link) : url($sm->link) }}">{{ $sm->title }}</a></li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @endif
            @endforeach
            <li><a href="{{ url('staff/logout') }}"><i data-feather="log-in"></i> <span class="text-label">Logout</span></a></li>
        </ul>
    </div>
</div>

<div class="page-wrapper">
    <div class="page-main-header">
        <div class="main-header-right row p-0 align-items-center">
            
            <!-- 1. Left side: Breadcrumb/Toggle button -->
            <div class="mobile-sidebar w-auto col-auto">
                <div class="media-body text-end switch-sm">
                    <!-- Desktop Toggle -->
                    <a href="javascript:void(0)" class="sidebar-toggle-btn d-none d-lg-inline-block" id="sidebar-toggle" aria-label="Toggle sidebar">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="pointer-events:none;"><line x1="17" y1="10" x2="3" y2="10"></line><line x1="21" y1="6" x2="3" y2="6"></line><line x1="21" y1="14" x2="3" y2="14"></line><line x1="17" y1="18" x2="3" y2="18"></line></svg>
                    </a>
                    <!-- Mobile Toggle -->
                    <a href="javascript:void(0)" class="mobile-drawer-toggle-btn d-inline-block d-lg-none" id="mobile-drawer-toggle" style="color: inherit;" aria-label="Toggle mobile menu">
                        <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="pointer-events:none;"><line x1="17" y1="10" x2="3" y2="10"></line><line x1="21" y1="6" x2="3" y2="6"></line><line x1="21" y1="14" x2="3" y2="14"></line><line x1="17" y1="18" x2="3" y2="18"></line></svg>
                    </a>
                </div>
            </div>

            <!-- 2. Center: Logo (mobile only) -->
            <div class="main-header-left d-lg-none col text-center">
                <div class="logo-wrapper" style="display: inline-block;"><a href="{{ url('admin/dashboard') }}"><img class="blur-up lazyloaded"
                            src="{{ asset('assets/images/dashboard/logo/newlogo.png') }}" alt="Logo" style="max-height: 45px; object-fit: contain;"></a></div>
            </div>
<script>
(function(){
    var w=document.getElementById('admMobileMenu'),bg=document.getElementById('admMobileBg'),x=document.getElementById('admMobileX'),btn=document.getElementById('mobile-drawer-toggle');
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
                    <li class="onhover-dropdown" style="padding: 0 10px;">
                        <style>
                            .btn-dark-setting-icon {
                                cursor: pointer;
                                display: inline-flex;
                                align-items: center;
                                justify-content: center;
                                color: inherit;
                                opacity: 0.9;
                                transition: opacity 0.2s ease-in-out;
                            }
                            .btn-dark-setting-icon:hover {
                                opacity: 1;
                            }
                            .btn-dark-setting-icon svg {
                                width: 22px !important;
                                height: 22px !important;
                            }
                            .btn-dark-setting-icon .icon-sun {
                                display: none;
                            }
                            .btn-dark-setting-icon .icon-moon {
                                display: inline-block;
                            }
                            body.dark .btn-dark-setting-icon .icon-moon {
                                display: none;
                            }
                            body.dark .btn-dark-setting-icon .icon-sun {
                                display: inline-block;
                            }
                        </style>
                        <a href="javascript:void(0)" class="btn-dark-setting btn-dark-setting-icon" title="Toggle Dark/Light Mode">
                            <i data-feather="moon" class="icon-moon"></i>
                            <i data-feather="sun" class="icon-sun"></i>
                        </a>
                    </li>
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
                            {{-- <li><a href="#"><i data-feather="user"></i>Edit Profile</a></li> --}}
                            {{-- <li><a href="#"><i data-feather="mail"></i>Inbox</a></li> --}}
                            {{-- <li><a href="#"><i data-feather="lock"></i>Lock Screen</a></li> --}}
                            {{-- <li><a href="#"><i data-feather="settings"></i>Settings</a></li> --}}
                            <li><a href="{{ url('staff/logout') }}"><i data-feather="log-out"></i>Logout</a></li>
                        </ul>
                    </li>
                </ul>
                <div class="d-lg-none pull-right" style="display: flex; align-items: center;">
                    <a href="{{ url('staff/logout') }}" style="color: #333; padding: 10px;">
                        <i data-feather="log-out"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
