    @php
    use Illuminate\Support\Facades\Request;
    use Illuminate\Support\Str;
    @endphp
<div class="page-sidebar" id="sidebar">
    <div class="main-header-left d-none d-lg-block">
        <div class="logo-wrapper">
            <a href="{{ url('admin/dashboard') }}">
                <img class="lazyloaded" src="{{ asset('assets/images/dashboard/logo/logo.png') }}" alt="TrymeNow" style="max-height: 42px; width: auto; max-width: 170px; object-fit: contain;">
            </a>
        </div>
    </div>
    <div class="sidebar custom-scrollbar mt-3">
        <div class="sidebar-user text-center">
            <div>
                <img class="img-60 rounded-circle lazyloaded blur-up"
                    src="{{ asset('assets/images/dashboard/man.jpeg') }}" alt="#">
            </div>
            <h6 class="mt-3 f-14 vendor-shop-name" style="font-family: 'Pristina', 'Dancing Script', 'Pinyon Script', cursive, sans-serif !important; font-size: 20px !important; font-weight: 700; text-transform: capitalize !important;">{{ ucwords(strtolower(session()->get('log_name') ?? 'Madhan')) }}</h6>
            <p style="text-transform: capitalize !important;">{{ ucwords(strtolower(session()->get('log_type') ?? 'Admin')) }}</p>
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
                $mmTitle = strtolower(trim($mainmenu->title));

                if ($mainmenu->id == 2 || $mmTitle == 'category') {
                    $attrSpec = App\Models\Submenus::withoutGlobalScopes()
                        ->where(function($q) {
                            $q->whereIn('link', ['attribute_groups.index', 'specification_groups.admin.index'])
                              ->orWhereIn('title', ['Attributes', 'Specification']);
                        })->get();
                    foreach ($attrSpec as $asItem) {
                        if (!$sub_menus->contains('link', $asItem->link)) {
                            $sub_menus->push($asItem);
                        }
                    }
                    $order = [
                        'category.main.index' => 1,
                        'category.index' => 2,
                        'category.sub.index' => 3,
                        'attribute_groups.index' => 4,
                        'specification_groups.admin.index' => 5,
                    ];
                    $sub_menus = $sub_menus->sortBy(function($submenu) use ($order) {
                        return $order[$submenu->link] ?? 99;
                    });
                } elseif ($mainmenu->id == 3 || $mmTitle == 'products') {
                    $sub_menus = $sub_menus->reject(function($submenu) {
                        return in_array($submenu->link, ['attribute_groups.index', 'specification_groups.admin.index']) ||
                               in_array($submenu->title, ['Attributes', 'Specification']);
                    });
                } elseif ($mainmenu->id == 4 || $mmTitle == 'sales') {
                    $hasReturns = $sub_menus->contains(function($submenu) {
                        return $submenu->link == 'returns' || strtolower(trim($submenu->title)) == 'returns & replacements';
                    });
                    if (!$hasReturns) {
                        $returnsItem = App\Models\Submenus::withoutGlobalScopes()->where('link', 'returns')->first();
                        if (!$returnsItem) {
                            try {
                                \Illuminate\Support\Facades\DB::table('sub_menu')->updateOrInsert(
                                    ['link' => 'returns'],
                                    [
                                        'main_menu' => 4,
                                        'title' => 'Returns & Replacements',
                                        'type' => 'route',
                                        'link' => 'returns',
                                        'route' => '',
                                        'created_at' => now(),
                                        'updated_at' => now(),
                                    ]
                                );
                                $returnsItem = App\Models\Submenus::withoutGlobalScopes()->where('link', 'returns')->first();
                            } catch (\Throwable $e) {}
                        }
                        if ($returnsItem) {
                            $sub_menus->push($returnsItem);
                        } else {
                            $sub_menus->push((object)[
                                'id' => 44,
                                'main_menu' => 4,
                                'title' => 'Returns & Replacements',
                                'type' => 'route',
                                'link' => 'returns',
                                'route' => ''
                            ]);
                        }
                    }
                    $order = [
                        'order' => 1,
                        'transaction' => 2,
                        'returns' => 3,
                    ];
                    $sub_menus = $sub_menus->sortBy(function($submenu) use ($order) {
                        return $order[$submenu->link] ?? 99;
                    });
                } elseif ($mainmenu->title == 'Banners') {
                    $order = [
                        'main slider' => 1,
                        'category banners' => 2,
                        'adv banner' => 3,
                        'oxygen adv' => 4
                    ];
                    $sub_menus = $sub_menus->sortBy(function($submenu) use ($order) {
                        return $order[strtolower($submenu->title)] ?? 99;
                    });
                } elseif ($mmTitle == 'role') {
                    $order = [
                        'department' => 1,
                        'designation' => 2,
                        'role assign' => 3
                    ];
                    $sub_menus = $sub_menus->sortBy(function($submenu) use ($order) {
                        return $order[strtolower(trim($submenu->title))] ?? 99;
                    });
                }
            @endphp
            @php
                $mmDisplayTitle = str_ireplace(['Vendors', 'Vendor'], ['Sellers', 'Seller'], $mainmenu->title);
                $isVendorMenu = (strtolower(trim($mainmenu->title)) == 'vendors');
                $isRequestsActive = request()->routeIs('admin.seller_leads.*') || request()->is('admin/seller-requests*');
                $isMainActive = $isVendorMenu && $isRequestsActive;
            @endphp
            <li class="{{ $isMainActive ? 'active' : '' }}"><a class="sidebar-header {{ $isMainActive ? 'active' : '' }}" href="#"><i data-feather="{{$mainmenu->font_icon}}"></i> <span>{{$mmDisplayTitle}}</span><i class="fa fa-angle-right pull-right" style="float: right;"></i></a>
                <ul class="sidebar-submenu" style="{{ $isMainActive ? 'display: block;' : '' }}">
                    @foreach($sub_menus as $submenu)
                        @if($submenu->title == 'Vendor Product List' || $submenu->link == 'vendor_products.crud.listing' || $submenu->title == 'Seller Product List')
                            @continue
                        @endif
                        @php
                            $smDisplayTitle = str_ireplace(['Vendors', 'Vendor'], ['Sellers', 'Seller'], $submenu->title);
                        @endphp
						@if($submenu->type=='route')
                        <li><a href="{{ route($submenu->link) }}"><i class="fa fa-circle"></i>{{$smDisplayTitle}}</a></li>
						@else
							
                        <li><a href="{{ url($submenu->link) }}"><i class="fa fa-circle"></i>{{$smDisplayTitle}}</a></li>
						@endif
                    @endforeach

                    @if($isVendorMenu)
                        @php
                            $pendingLeadsCount = \Illuminate\Support\Facades\Schema::hasTable('seller_leads')
                                ? \DB::table('seller_leads')->where('status', 'Pending')->count()
                                : 0;
                        @endphp
                        <li class="{{ $isRequestsActive ? 'active' : '' }}">
                            <a href="{{ route('admin.seller_leads.index') }}" class="{{ $isRequestsActive ? 'active' : '' }}" style="display: flex; align-items: center; white-space: nowrap;">
                                <i class="fa fa-circle" style="margin-right: 6px;"></i>Seller Requests @if($pendingLeadsCount > 0)<span class="badge badge-primary" style="background-color: #ff8084 !important; color: #fff; font-size: 10px; font-weight: 700; padding: 2px 5px; border-radius: 4px; line-height: 1; margin-left: 5px;">{{ $pendingLeadsCount }}</span>@endif
                            </a>
                        </li>
                    @endif
                </ul>
            </li>
        @endforeach

        @php
            $pendingLeadsCount = \Illuminate\Support\Facades\Schema::hasTable('seller_leads')
                ? \DB::table('seller_leads')->where('status', 'Pending')->count()
                : 0;
            $isRequestsActive = request()->routeIs('admin.seller_leads.*') || request()->is('admin/seller-requests*');
        @endphp
        <li class="{{ $isRequestsActive ? 'active' : '' }}">
            <a class="sidebar-header {{ $isRequestsActive ? 'active' : '' }}" href="{{ route('admin.seller_leads.index') }}" style="display: flex; align-items: center; white-space: nowrap; letter-spacing: 0px !important;">
                <i data-feather="user-check" style="margin-right: 7px !important; flex-shrink: 0;"></i>
                <span style="font-size: 12px; font-weight: 600;">Seller Requests</span>@if($pendingLeadsCount > 0)<span class="badge badge-primary" style="background-color: #ff8084 !important; color: #fff; font-size: 10px; font-weight: 700; padding: 2px 5px; border-radius: 4px; line-height: 1; margin-left: 5px; flex-shrink: 0; display: inline-block;">{{ $pendingLeadsCount }}</span>@endif
            </a>
        </li>
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
                $mmTitle = strtolower(trim($mainmenu->title));

                if ($mainmenu->id == 2 || $mmTitle == 'category') {
                    $attrSpec = App\Models\Submenus::withoutGlobalScopes()
                        ->where(function($q) {
                            $q->whereIn('link', ['attribute_groups.index', 'specification_groups.admin.index'])
                              ->orWhereIn('title', ['Attributes', 'Specification']);
                        })->get();
                    foreach ($attrSpec as $asItem) {
                        if (!$sub_menus->contains('link', $asItem->link)) {
                            $sub_menus->push($asItem);
                        }
                    }
                    $order = [
                        'category.main.index' => 1,
                        'category.index' => 2,
                        'category.sub.index' => 3,
                        'attribute_groups.index' => 4,
                        'specification_groups.admin.index' => 5,
                    ];
                    $sub_menus = $sub_menus->sortBy(function($submenu) use ($order) {
                        return $order[$submenu->link] ?? 99;
                    });
                } elseif ($mainmenu->id == 3 || $mmTitle == 'products') {
                    $sub_menus = $sub_menus->reject(function($submenu) {
                        return in_array($submenu->link, ['attribute_groups.index', 'specification_groups.admin.index']) ||
                               in_array($submenu->title, ['Attributes', 'Specification']);
                    });
                } elseif ($mainmenu->id == 4 || $mmTitle == 'sales') {
                    $hasReturns = $sub_menus->contains(function($submenu) {
                        return $submenu->link == 'returns' || strtolower(trim($submenu->title)) == 'returns & replacements';
                    });
                    if (!$hasReturns) {
                        $returnsItem = App\Models\Submenus::withoutGlobalScopes()->where('link', 'returns')->first();
                        if ($returnsItem) {
                            $sub_menus->push($returnsItem);
                        }
                    }
                    $order = [
                        'order' => 1,
                        'transaction' => 2,
                        'returns' => 3,
                    ];
                    $sub_menus = $sub_menus->sortBy(function($submenu) use ($order) {
                        return $order[$submenu->link] ?? 99;
                    });
                } elseif ($mainmenu->title == 'Banners') {
                    $order = [
                        'main slider' => 1,
                        'category banners' => 2,
                        'adv banner' => 3,
                        'oxygen adv' => 4
                    ];
                    $sub_menus = $sub_menus->sortBy(function($submenu) use ($order) {
                        return $order[strtolower($submenu->title)] ?? 99;
                    });
                } elseif ($mmTitle == 'role') {
                    $order = [
                        'department' => 1,
                        'designation' => 2,
                        'role assign' => 3
                    ];
                    $sub_menus = $sub_menus->sortBy(function($submenu) use ($order) {
                        return $order[strtolower(trim($submenu->title))] ?? 99;
                    });
                }
            @endphp
            @php
                $mmDisplayTitle = str_ireplace(['Vendors', 'Vendor'], ['Sellers', 'Seller'], $mainmenu->title);
            @endphp
            <li><a class="sidebar-header" href="#"><i data-feather="{{$mainmenu->font_icon}}"></i> <span>{{$mmDisplayTitle}}</span><i class="fa fa-angle-right pull-right" style="float: right;"></i></a>
                <ul class="sidebar-submenu">
                    @foreach($sub_menus as $submenu)
                    @php
                        if ($submenu->title == 'Vendor Product List' || $submenu->link == 'vendor_products.crud.listing' || $submenu->title == 'Seller Product List') {
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
                        @php
                            $routeUrl = '#';
                            if ($submenu->type == 'route') {
                                if ($submenu->link == 'returns' && \Illuminate\Support\Facades\Route::has('staffreturns')) {
                                    $routeUrl = route('staffreturns');
                                } elseif (\Illuminate\Support\Facades\Route::has($submenu->link)) {
                                    $routeUrl = route($submenu->link);
                                }
                            } else {
                                $routeUrl = url($submenu->link);
                            }
                            $smDisplayTitle = str_ireplace(['Vendors', 'Vendor'], ['Sellers', 'Seller'], $submenu->title);
                        @endphp
                        <li><a href="{{ $routeUrl }}"><i class="fa fa-circle"></i>{{$smDisplayTitle}}</a></li>
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

