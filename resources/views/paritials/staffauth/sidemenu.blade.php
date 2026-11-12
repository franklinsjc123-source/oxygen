@php
use Illuminate\Support\Facades\Route;
@endphp
<div class="page-sidebar" id="sidebar">
    <div class="main-header-left d-none d-lg-block">
        <div class="logo-wrapper">
            <a href="{{ route('staffdashboard', session()->get('login_id')) }}">
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
            <h6 class="mt-3 f-14 vendor-shop-name" style="font-family: 'Pristina', 'Dancing Script', 'Pinyon Script', cursive, sans-serif !important; font-size: 20px !important; font-weight: 700; text-transform: capitalize !important;">{{ ucwords(strtolower(session()->get('log_name') ?? 'Staff')) }}</h6>
            <p style="text-transform: capitalize !important;">{{ ucwords(strtolower(session()->get('log_type') ?? 'Staff')) }}</p>
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
                        @if($submenu->type=='route')
                            @php
                                $finalRoute = '#';
                                $possibleStaffRoute = 'staff' . $submenu->link;
                                if (Route::has($possibleStaffRoute)) {
                                    $finalRoute = route($possibleStaffRoute);
                                } elseif (Route::has($possibleStaffRoute . '.index')) {
                                    $finalRoute = route($possibleStaffRoute . '.index');
                                } elseif (Route::has('staff.' . $submenu->link)) {
                                    $finalRoute = route('staff.' . $submenu->link);
                                } elseif (Route::has('staff.' . $submenu->link . '.index')) {
                                    $finalRoute = route('staff.' . $submenu->link . '.index');
                                } elseif ($submenu->link == 'order') {
                                    $finalRoute = route('stafforder');
                                } elseif ($submenu->link == 'transaction') {
                                    $finalRoute = route('stafftransaction');
                                } elseif ($submenu->link == 'returns') {
                                    $finalRoute = route('staffreturns');
                                } elseif ($submenu->link == 'auction/list') {
                                    $finalRoute = route('staffauction/list');
                                } elseif ($submenu->link == 'auction/live') {
                                    $finalRoute = route('staffauction/live');
                                } elseif ($submenu->link == 'attribute_groups.index' || $submenu->link == 'attribute_groups' || str_contains($submenu->link, 'attribute_group') || strtolower(trim($submenu->title)) == 'attributes') {
                                    $finalRoute = route('staff.attribute_groups.index');
                                } elseif ($submenu->link == 'specification_groups.admin.index' || $submenu->link == 'specification_groups' || str_contains($submenu->link, 'specification_group') || strtolower(trim($submenu->title)) == 'specification') {
                                    $finalRoute = route('staff.specification_groups.index');
                                } elseif (Route::has($submenu->link)) {
                                    $finalRoute = route($submenu->link);
                                }
                            @endphp
                        <li><a href="{{ $finalRoute }}"><i class="fa fa-circle"></i>{{ str_ireplace(['Vendors', 'Vendor'], ['Sellers', 'Seller'], $submenu->title) }}</a></li>
                        @else
                            @php
                                $finalUrl = url('staff/' . ltrim($submenu->link, '/'));
                                if (str_contains($submenu->link, 'attribute_group') || strtolower(trim($submenu->title)) == 'attributes') {
                                    $finalUrl = route('staff.attribute_groups.index');
                                } elseif (str_contains($submenu->link, 'specification_group') || strtolower(trim($submenu->title)) == 'specification') {
                                    $finalUrl = route('staff.specification_groups.index');
                                }
                            @endphp
                        <li><a href="{{ $finalUrl }}"><i class="fa fa-circle"></i>{{ str_ireplace(['Vendors', 'Vendor'], ['Sellers', 'Seller'], $submenu->title) }}</a></li>
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
