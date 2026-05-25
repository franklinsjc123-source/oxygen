    @php
    use Illuminate\Support\Facades\Request;
    use Illuminate\Support\Str;
    @endphp
<div class="page-sidebar" id="sidebar">
    <div class="main-header-left d-none d-lg-block">
        <div class="logo-wrapper">
            <a href="{{ url('admin/dashboard') }}">
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
            <h6 class="mt-3 f-14">{{session()->get('log_name') ?? 'ADMIN'}}</h6>
            <p> {{session()->get('log_type') ?? 'Administrator'}}</p>
        </div>
        <ul class="sidebar-menu">
     @if (session()->get('log_type') == 'Admin') 
        <li><a class="sidebar-header" href="{{ url('admin/dashboard') }}"><i data-feather="home"></i><span>Dashboard</span></a></li>
        @php
            $main_menus = App\Models\Mainmenus::where('id', '!=', '1')->get();
			
        @endphp
		

        @foreach($main_menus as $mainmenu)
            @php
                $sub_menus = App\Models\Submenus::where('main_menu', '=', $mainmenu->id)->get();
            @endphp
            <li><a class="sidebar-header" href="#"><i data-feather="{{$mainmenu->font_icon}}"></i> <span>{{$mainmenu->title}}</span><i class="fa fa-angle-right pull-right" style="float: right;"></i></a>
                <ul class="sidebar-submenu">
                    @foreach($sub_menus as $submenu)
						@if($submenu->type=='route')
                        <li><a href="{{ route($submenu->link) }}"><i class="fa fa-circle"></i>{{$submenu->title}}</a></li>
						@else
							
                        <li><a href="{{ url($submenu->link) }}"><i class="fa fa-circle"></i>{{$submenu->title}}</a></li>
						@endif
                    @endforeach
                </ul>
            </li>
        @endforeach
		@else
		
        <li><a class="sidebar-header" href="{{ url('admin/dashboard') }}"><i data-feather="home"></i><span>Dashboard</span></a></li>
      @php
        $staffid=session()->get('login_id');
        $main_menus = App\Models\Mainmenus::where('id', '!=', '1')->get();
        $staff =  App\Models\Staffcreates::where('employee_id', '=', $staffid)->first();
        $staffroless = $staff ? App\Models\StaffRole::where('department', '=', $staff->department)->where('designation', '=', $staff->designation)->first() : null;

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
                        $canSeeSubmenu = false;
                        if ($staffroless) {
                            $canSeeSubmenu = in_array($submenu->id, explode(',', $staffroless->submenus));
                        } else {
                            $canSeeSubmenu = true; 
                        }
                    @endphp
                    @if($canSeeSubmenu)
                        @if($submenu->type=='route')
                        <li><a href="{{ route($submenu->link) }}"><i class="fa fa-circle"></i>{{$submenu->title}}</a></li>
                        @else
                        <li><a href="{{ url($submenu->link) }}"><i class="fa fa-circle"></i>{{$submenu->title}}</a></li>
                        @endif
                    @endif
                    @endforeach
                </ul>
            </li>
			@endif
        @endforeach
    @endif 
            
            
			 <li><a class="sidebar-header" href="{{ url('admin/logout') }}"><i
                            data-feather="log-in"></i><span>Logout</span></a>
                </li>
        </ul>
    </div>
</div>

