@php
use Illuminate\Support\Facades\Route;
@endphp
<div class="page-sidebar" id="sidebar">
    <div class="main-header-left d-none d-lg-block">
        <div class="logo-wrapper">
            <a href="{{ route('staffdashboard', session()->get('login_id')) }}">
                <img class="blur-up lazyloaded" src="{{ asset('assets/images/dashboard/logo/logo.png') }}" alt="">
            </a>
        </div>
    </div>
    <div class="sidebar custom-scrollbar mt-3">
        <div class="sidebar-user text-center">
            <div>
                <img class="img-60 rounded-circle lazyloaded blur-up"
                    src="{{ asset('assets/images/dashboard/man.jpeg') }}" alt="#">
            </div>
            <h6 class="mt-3 f-14">{{session()->get('log_name') ?? 'STAFF'}}</h6>
            <p> {{session()->get('log_type') ?? 'Staff'}}</p>
        </div>
        <ul class="sidebar-menu">
        <li><a class="sidebar-header" href="{{ route('staffdashboard', session()->get('login_id')) }}"><i data-feather="home"></i><span>Dashboard</span></a></li>
        @php
            $staffid = session()->get('login_id');
            $main_menus = App\Models\Mainmenus::where('id', '!=', '1')
                            ->where('title', '!=', 'Staff')
                            ->where('title', '!=', 'Role')->get();
            $staff = App\Models\Staffcreates::where('employee_id', '=', $staffid)->first();
            $staffroless = $staff ? App\Models\StaffRole::where('department', '=', $staff->department)
                            ->where('designation', '=', $staff->designation)->first() : null;
                            
            $rollSession = \Illuminate\Support\Facades\Session::get('roll');
            $staffMainMenus = [];
            if ($staffroless) {
                $staffMainMenus = explode(',', $staffroless->mainmenus);
            } elseif ($rollSession && count($rollSession) > 0 && !empty($rollSession[0]->permission_id)) {
                $decoded = json_decode($rollSession[0]->permission_id, true);
                if (is_array($decoded) || is_object($decoded)) {
                    $staffMainMenus = array_values((array)$decoded);
                }
            }
        @endphp 
        
        @foreach($main_menus as $mainmenu)
            @if(in_array($mainmenu->id, $staffMainMenus))
            @php
                $sub_menus = App\Models\Submenus::where('main_menu', '=', $mainmenu->id)->get();
            @endphp
            <li><a class="sidebar-header" href="#"><i data-feather="{{$mainmenu->font_icon}}"></i> <span>{{$mainmenu->title}}</span><i class="fa fa-angle-right pull-right" style="float: right;"></i></a>
                <ul class="sidebar-submenu">
                    @foreach($sub_menus as $submenu)
                    @php
                        if ($submenu->title == 'Vendor Product List' || $submenu->link == 'vendor_products.crud.listing') {
                            continue;
                        }
                        $canSeeSubmenu = false;
                        if ($staffroless) {
                            $canSeeSubmenu = in_array($submenu->id, explode(',', $staffroless->submenus));
                        } else {
                            $canSeeSubmenu = true; 
                        }
                    @endphp
                    @if($canSeeSubmenu)
                        @if($submenu->type=='route')
                            @php
                                $finalRoute = '#';
                                $possibleStaffRoute = 'staff' . $submenu->link;
                                if (Route::has($possibleStaffRoute)) {
                                    $finalRoute = route($possibleStaffRoute);
                                } elseif (Route::has('staff.' . $submenu->link)) {
                                    $finalRoute = route('staff.' . $submenu->link);
                                } elseif ($submenu->link == 'order') {
                                    $finalRoute = route('stafforder');
                                } elseif ($submenu->link == 'transaction') {
                                    $finalRoute = route('stafftransaction');
                                } elseif ($submenu->link == 'auction/list') {
                                    $finalRoute = route('staffauction/list');
                                } elseif ($submenu->link == 'auction/live') {
                                    $finalRoute = route('staffauction/live');
                                } elseif (Route::has($submenu->link)) {
                                    $finalRoute = route($submenu->link);
                                }
                            @endphp
                        <li><a href="{{ $finalRoute }}"><i class="fa fa-circle"></i>{{$submenu->title}}</a></li>
                        @else
                        <li><a href="{{ url('staff/' . ltrim($submenu->link, '/')) }}"><i class="fa fa-circle"></i>{{$submenu->title}}</a></li>
                        @endif
                    @endif
                    @endforeach
                </ul>
            </li>
            @endif
        @endforeach
            
            <li><a class="sidebar-header" href="{{ url('logout') }}"><i data-feather="log-in"></i><span>Logout</span></a></li>
            
            @php
                $staffDetails = App\Models\Staffcreates::where('employee_id', session()->get('login_id'))->first();
            @endphp
            
            @if($staffDetails)
            <li class="mt-4 pb-4 px-3">
                <div class="d-flex align-items-center" style="border-top: 1px solid rgba(255, 255, 255, 0.1); padding-top: 15px;">
                    <div style="margin-right: 12px; flex-shrink: 0;">
                        @if($staffDetails->profileimage && $staffDetails->profileimage != '-')
                            <img class="rounded-circle lazyloaded blur-up" src="{{ asset('assets/images/staffcreate/' . $staffDetails->profileimage) }}" alt="RM" style="object-fit: cover; width: 30px; height: 30px; min-width: 30px;">
                        @else
                            <img class="rounded-circle lazyloaded blur-up" src="{{ asset('assets/images/dashboard/man.jpeg') }}" alt="RM" style="object-fit: cover; width: 30px; height: 30px; min-width: 30px;">
                        @endif
                    </div>
                    <div class="text-start text-truncate">
                        <h6 class="mb-1 text-white text-truncate" style="font-size: 11px; font-weight: 600; text-transform: uppercase;">{{ $staffDetails->fullname }}</h6>
                        <p class="mb-0 text-white text-truncate" style="font-size: 10px;"><i class="fa fa-phone me-1"></i>{{ $staffDetails->mobileno }}</p>
                    </div>
                </div>
            </li>
            @endif
        </ul>
    </div>
</div>
