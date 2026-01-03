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
            <h6 class="mt-3 f-14">{{session()->get('log_name')}}</h6>
            <p> {{session()->get('log_type')}}</p>
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
            <li><a class="sidebar-header" href="#"><i data-feather="{{$mainmenu->font_icon}}"></i> <span>{{$mainmenu->title}}</span><i class="fa fa-angle-right pull-right"></i></a>
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
			
			$staffroless = App\Models\StaffRole::where('department', '=', $staff->department)->where('designation', '=', $staff->designation)->first();
        @endphp 
		

        @foreach($main_menus as $mainmenu)
			@if(isset($staffroless) && in_array($mainmenu->id, explode(',', $staffroless->mainmenus)))
            @php
                $sub_menus = App\Models\Submenus::where('main_menu', '=', $mainmenu->id)->get();
            @endphp
            <li><a class="sidebar-header" href="#"><i data-feather="{{$mainmenu->font_icon}}"></i> <span>{{$mainmenu->title}}</span><i class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    @foreach($sub_menus as $submenu)
					@if(isset($staffroless) && in_array($submenu->id, explode(',', $staffroless->submenus)))
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

