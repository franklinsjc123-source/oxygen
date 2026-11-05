@php
    $vendorProfile = null;
    $staffName = '';
    $staff = null;
    $currentRmRating = null;
    $currentRmReview = '';
    if (session()->get('login_id')) {
        $vendorProfile = App\Models\vendor\vendorcreate::select('shop_name', 'owner_name', 'profile_image', 'staff_id')
            ->where('id', session()->get('login_id'))
            ->first();
            
        if (isset($vendorProfile->staff_id)) {
            $staff = App\Models\Staffcreates::find($vendorProfile->staff_id);
            if ($staff) {
                $staffName = 'RM: ' . ($staff->fullname ?? $staff->username);
                if (\Illuminate\Support\Facades\Schema::hasTable('rm_ratings')) {
                    $existingRating = \Illuminate\Support\Facades\DB::table('rm_ratings')
                        ->where('staff_id', $vendorProfile->staff_id)
                        ->where('vendor_id', session()->get('login_id'))
                        ->first();
                    if ($existingRating) {
                        $currentRmRating = (int) $existingRating->rating;
                        $currentRmReview = $existingRating->review ?? '';
                    }
                }
            }
        }
    }
    $vendorName = optional($vendorProfile)->shop_name ?: (optional($vendorProfile)->owner_name ?: (session()->get('username') ?: 'Seller'));
    $vendorRole = optional($vendorProfile)->owner_name ?: 'Seller Panel';
    $vendorImage = optional($vendorProfile)->profile_image && file_exists(public_path('assets/images/vendor/profile/' . $vendorProfile->profile_image))
        ? asset('assets/images/vendor/profile/' . $vendorProfile->profile_image)
        : asset('assets/images/dashboard/man.jpeg');
    
    $staffImage = isset($staff) && isset($staff->profileimage) && $staff->profileimage != '-' && file_exists(public_path('assets/images/staffcreate/' . $staff->profileimage))
        ? asset('assets/images/staffcreate/' . $staff->profileimage)
        : asset('assets/images/dashboard/man.jpeg');
@endphp
<div class="page-sidebar">
    <div class="main-header-left d-none d-lg-block">
        <div class="logo-wrapper">
            <a href="{{ route('vendordashboard', session()->get('login_id') ?? (auth()->check() ? auth()->user()->login_id : 1)) }}">
                <img class="lazyloaded" src="{{ asset('assets/images/dashboard/logo/logo.png') }}" alt="TrymeNow" style="max-height: 42px; width: auto; max-width: 170px; object-fit: contain;">
            </a>
        </div>
    </div>
    <div class="sidebar custom-scrollbar mt-3">
        <div class="sidebar-user text-center">
            <div style="position: relative; display: inline-block;">
                <img class="img-60 rounded-circle lazyloaded blur-up"
                    src="{{ $vendorImage }}" alt="{{ $vendorName }}"
                    style="width: 60px !important; height: 60px !important; object-fit: cover !important; border: 2px solid rgba(255, 255, 255, 0.4); box-shadow: 0 4px 10px rgba(0,0,0,0.15); margin: 0 auto; display: block;">
            </div>
            <h6 class="mt-3 f-14 vendor-shop-name" style="font-family: 'Pristina', 'Dancing Script', 'Pinyon Script', cursive, sans-serif !important; font-size: 20px !important; font-weight: 700; text-transform: capitalize !important;">{{ ucwords(strtolower($vendorName)) }}</h6>
            <p style="text-transform: capitalize !important;">{{ ucwords(strtolower($vendorRole)) }}</p>
        </div>
        <ul class="sidebar-menu">
            @if (session()->get('login_id') || (auth()->check() && auth()->user()->login_id))
            <li><a class="sidebar-header" href="{{ route('vendordashboard', session()->get('login_id') ?? auth()->user()->login_id) }}"><i
                        data-feather="home"></i><span>Dashboard</span></a></li>

                {{-- category --}}
                <li><a class="sidebar-header" href="#"><i data-feather="box"></i> <span>Category</span><i
                    class="fa fa-angle-right pull-right"></i></a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{ route('vendorcategory.sub.index') }}"><i class="fa fa-circle"></i>Sub Category</a></li>
                        <li><a href="{{ route('vendorattribute.master.index') }}"><i class="fa fa-circle"></i> Attributes</a></li>
                        <li><a href="{{ url('vendor/specification_groups') }}"><i class="fa fa-circle"></i>Specification</a></li>
                    </ul>
                </li>
            
            
            
            <li><a class="sidebar-header" href="#"><i data-feather="box"></i> <span>Products</span><i
                        class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li><a href="{{ route('vendorproductscreate') }}"><i class="fa fa-circle"></i>Add Product</a></li>
                    <li><a href="{{ route('vendorproducts.crud.listing') }}"><i class="fa fa-circle"></i>Product List</a></li>

                    {{--   <li><a href="{{ route('product.specification.index') }}"><i class="fa fa-circle"></i>
                        Offers</a>              
                    </li>  --}}
                    <!--<li><a href="{{ route('vendorproductcollection.master.index') }}"><i class="fa fa-circle"></i>Product-->
                    <!--        Collection</a>-->
                    <!--</li>-->
                   
                </ul>
            </li>
           
            <li><a class="sidebar-header" href=""> <i data-feather="navigation"></i> <span>Sales</span><i
                        class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li><a href="{{ route('vendor.order') }}"><i class="fa fa-circle"></i>Orders</a></li>
                    <li><a href="{{ route('vendor.transaction') }}"><i class="fa fa-circle"></i>Transactions</a></li>
                    <li><a href="{{ route('vendor.returns') }}"><i class="fa fa-circle"></i>Returns & Replacements</a></li>
                </ul>
            </li>
            {{-- <li><a class="sidebar-header" href=""><i data-feather="gift"></i><span>Coupons</span><i
                        class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li><a href="{{ route('coupon.couponlisting') }}"><i class="fa fa-circle"></i>List Coupons</a></li>
                    <li><a href="{{ route('coupon.index') }}"><i class="fa fa-circle"></i>Create Coupons </a></li>
                </ul>
            </li> --}}


            {{-- <li><a class="sidebar-header" href="#"><i data-feather="box"></i> <span>Banners</span><i
                        class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li><a href="{{ url('advbanner') }}"><i class="fa fa-circle"></i>Paid Adv Banner</a></li>
                    <li><a href="{{ url('advoxygen') }}"><i class="fa fa-circle"></i>oxygen Adv </a></li>
                    <li><a href="{{ url('banners.slider') }}"><i class="fa fa-circle"></i>Main Slider</a></li>
                </ul>
            </li> --}}

            {{-- <li><a class="sidebar-header" href=""><i data-feather="gift"></i><span>Auction</span><i
                        class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li><a href="{{ url('auction/list') }}"><i class="fa fa-circle"></i>List Auction</a></li>
                    <li><a href="{{ url('auction/create') }}"><i class="fa fa-circle"></i>Create Auction </a></li>
                </ul>
            </li> --}}
            <li><a class="sidebar-header" href=""><i data-feather="percent"></i><span>Offers</span><i
                        class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li><a href="{{ route('vendoroffer.list.index') }}"><i class="fa fa-circle"></i>List Offers</a></li>
                    <li><a href="{{ route('vendoroffer.main.create') }}"><i class="fa fa-circle"></i>Create Offer </a></li>

                </ul>
            </li>
            <li><a class="sidebar-header" href=""><i data-feather="target"></i><span>Marketing</span><i
                class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li><a href="{{ route('vendorwhatsapp.index') }}"><i class="fa fa-circle"></i>Whatsapp</a></li>
                    <li><a href="{{ route('vendorfacebook.index') }}"><i class="fa fa-circle"></i>Facebook</a></li>
                    <li><a href="{{ route('vendorinstagram.index')}}"><i class="fa fa-circle"></i>Instagram</a></li>
                    <li><a href="{{ route('vendoroxygen.index') }}"><i class="fa fa-circle"></i>Oxygen Promo</a></li>
                </ul>
            </li>
           
         
           {{--<li><a class="sidebar-header" href=""><i data-feather="users"></i><span>Sellers</span><i
                class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li><a href="{{ route('vendor-list') }}"><i class="fa fa-circle"></i>Seller List</a></li>
                    <li><a href="{{ route('vendorcreate.index') }}"><i class="fa fa-circle"></i>Create Seller</a>
                    </li>
                </ul>
            </li>
             @if (session()->get('level') == 5)
                <li><a class="sidebar-header" href=""><i data-feather="users"></i><span>Sellers</span><i
                            class="fa fa-angle-right pull-right"></i></a>
                    <ul class="sidebar-submenu">
                        <li><a href="{{ url('vendor/list') }}"><i class="fa fa-circle"></i>Seller List</a></li>
                        <li><a href="{{ route('vendorcreate.index') }}"><i class="fa fa-circle"></i>Create Seller</a>
                        </li>
                    </ul>
                </li>
            @endif --}}
            

            <li><a class="sidebar-header" href=""><i data-feather="settings"></i><span>Settings</span><i
                        class="fa fa-angle-right pull-right"></i></a>
                <ul class="sidebar-submenu">
                    <li><a href="{{ url('vendor/profile') }}"><i class="fa fa-circle"></i>Profile</a></li>
                </ul>
            </li>
            @if (session()->get('level') == 5 || session()->get('level') == 4)
                <li><a class="sidebar-header" href="#"><i data-feather="bar-chart"></i><span>Reports</span></a>
                </li>
            @endif
             <li><a class="sidebar-header" href="{{ route('logout') }}"><i
                        data-feather="log-out"></i><span>Logout</span></a>
            </li>

            @endif
            
        </ul>
        @if(isset($staff) && $staff)
            <div class="rm-card rm-card-mobile">
                <div class="rm-left-wrapper">
                    <div class="rm-avatar-container">
                        <img class="rm-avatar lazyloaded blur-up" src="{{ $staffImage }}" alt="RM">
                        <div class="rm-status-dot"></div>
                    </div>
                    <div class="rm-info">
                        <h6 class="rm-name" title="RM: {{ $staff->fullname ?? $staff->username }}">{{ $staff->fullname ?? $staff->username }}</h6>
                        <a href="tel:{{ $staff->mobileno }}" class="rm-phone" title="{{ $staff->mobileno }}">
                            <i class="fa fa-phone"></i> {{ $staff->mobileno }}
                        </a>
                        <a href="javascript:void(0)" class="rm-rate-link btn-open-rate-rm" onclick="openRateRmModal()" title="Click to rate your experience with RM">
                            <i class="fa fa-star rm-star-icon" style="color: {{ $currentRmRating ? '#ffd700' : 'rgba(255,255,255,0.7)' }}; font-size: 11px;"></i>
                            <span class="rm-rate-text">{{ $currentRmRating ? $currentRmRating . '.0 ★ Rate RM' : 'Rate RM' }}</span>
                        </a>
                    </div>
                </div>
            </div>
        @endif
    </div>
    @if(isset($staff) && $staff)
    <style>
        .sidebar-menu {
            padding-bottom: 135px !important;
        }

        .rm-card {
            background: linear-gradient(135deg, #ff7a59 0%, #ff5252 100%);
            border-radius: 12px;
            padding: 9px 12px;
            margin: 0;
            transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
            box-shadow: 0 4px 15px rgba(255, 122, 89, 0.25);
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: space-between;
            border: none;
        }

        .rm-card::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255, 255, 255, 0.15) 0%, transparent 70%);
            pointer-events: none;
        }

        .rm-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 8px 25px rgba(255, 122, 89, 0.4);
        }

        .rm-left-wrapper {
            display: flex;
            align-items: center;
            min-width: 0;
            flex: 1;
        }

        .rm-avatar-container {
            position: relative;
            width: 34px;
            height: 34px;
            margin-right: 8px;
            flex-shrink: 0;
        }

        .rm-avatar {
            width: 100%;
            height: 100%;
            object-fit: cover;
            border-radius: 50%;
            border: 2px solid rgba(255, 255, 255, 0.4);
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
            transition: all 0.3s ease;
        }

        .rm-card:hover .rm-avatar {
            border-color: #ffffff;
            transform: scale(1.05);
        }

        .rm-status-dot {
            position: absolute;
            bottom: 0px;
            right: 0px;
            width: 9px;
            height: 9px;
            background-color: #2ecc71;
            border: 1.5px solid #ff7a59;
            border-radius: 50%;
            box-shadow: 0 0 0 1.5px rgba(46, 204, 113, 0.4);
            animation: pulse-green-rm 2s infinite;
        }

        @keyframes pulse-green-rm {
            0% {
                box-shadow: 0 0 0 0 rgba(46, 204, 113, 0.7);
            }
            70% {
                box-shadow: 0 0 0 5px rgba(46, 204, 113, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(46, 204, 113, 0);
            }
        }

        .rm-info {
            display: flex;
            flex-direction: column;
            justify-content: center;
            min-width: 0;
            flex: 1;
        }

        .rm-name {
            margin: 0;
            color: #ffffff;
            font-size: 13px;
            font-weight: 700;
            letter-spacing: 0.3px;
            white-space: nowrap;
            text-transform: uppercase;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .rm-phone {
            margin: 2px 0 0 0;
            font-size: 12px;
            color: rgba(255, 255, 255, 0.9);
            display: flex;
            align-items: center;
            gap: 5px;
            text-decoration: none;
            transition: color 0.2s ease;
            font-weight: 500;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }

        .rm-phone:hover {
            color: #ffffff;
            text-decoration: underline;
        }

        .rm-phone i {
            font-size: 10px;
            color: rgba(255, 255, 255, 0.9);
        }

        .rm-rate-link {
            margin: 4px 0 0 0;
            font-size: 11px;
            color: #ffffff;
            display: inline-flex;
            align-items: center;
            gap: 4px;
            text-decoration: none;
            font-weight: 600;
            background: rgba(0, 0, 0, 0.2);
            padding: 2px 8px;
            border-radius: 10px;
            width: fit-content;
            border: 1px solid rgba(255, 255, 255, 0.3);
            transition: all 0.2s ease;
            cursor: pointer;
        }

        .rm-rate-link:hover {
            background: rgba(0, 0, 0, 0.35);
            color: #ffffff;
            border-color: rgba(255, 255, 255, 0.6);
            transform: translateY(-1px);
        }

        #btnSubmitRmRate:hover {
            background-color: #0f2430 !important;
            border-color: #0f2430 !important;
            transform: translateY(-1px);
            box-shadow: 0 6px 16px rgba(24, 53, 67, 0.5) !important;
        }

        .btn-close-rate-rm:hover {
            background-color: #cbd5e1 !important;
            color: #0f172a !important;
        }

        /* Desktop specific styles */
        @media (min-width: 992px) {
            .rm-card-desktop {
                display: flex !important;
                position: absolute;
                bottom: 15px;
                left: 10px;
                right: 10px;
                z-index: 10;
            }
            .rm-card-mobile {
                display: none !important;
            }
        }

        /* Mobile specific styles */
        @media (max-width: 991px) {
            .rm-card-desktop {
                display: none !important;
            }
            .rm-card-mobile {
                display: flex !important;
                position: relative;
                margin: 20px 15px;
                z-index: 10;
            }
            .sidebar-menu {
                padding-bottom: 20px !important;
            }
        }
    </style>
    <div class="rm-card rm-card-desktop">
        <div class="rm-left-wrapper">
            <div class="rm-avatar-container">
                <img class="rm-avatar lazyloaded blur-up" src="{{ $staffImage }}" alt="RM">
                <div class="rm-status-dot"></div>
            </div>
            <div class="rm-info">
                <h6 class="rm-name" title="RM: {{ $staff->fullname ?? $staff->username }}">{{ $staff->fullname ?? $staff->username }}</h6>
                <a href="tel:{{ $staff->mobileno }}" class="rm-phone" title="{{ $staff->mobileno }}">
                    <i class="fa fa-phone"></i> {{ $staff->mobileno }}
                </a>
                <a href="javascript:void(0)" class="rm-rate-link btn-open-rate-rm" onclick="openRateRmModal()" title="Click to rate your experience with RM">
                    <i class="fa fa-star rm-star-icon" style="color: {{ $currentRmRating ? '#ffd700' : 'rgba(255,255,255,0.7)' }}; font-size: 11px;"></i>
                    <span class="rm-rate-text">{{ $currentRmRating ? $currentRmRating . '.0 ★ Rate RM' : 'Rate RM' }}</span>
                </a>
            </div>
        </div>
    </div>

    <!-- Rate RM Modal -->
    <div class="modal fade" id="rateRmModal" tabindex="-1" aria-labelledby="rateRmModalLabel" aria-hidden="true" style="display: none; z-index: 100000 !important;" onclick="if(event.target === this) closeRateRmModal()">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 440px; margin: 1.75rem auto; z-index: 100001 !important; position: relative;">
            <div class="modal-content" style="border-radius: 18px; border: none; box-shadow: 0 20px 40px rgba(0,0,0,0.3); overflow: hidden; background: #ffffff;">
                <div class="modal-header d-flex justify-content-between align-items-center" style="background: #183543; color: #ffffff; padding: 16px 22px; border-bottom: none;">
                    <h5 class="modal-title mb-0" id="rateRmModalLabel" style="font-weight: 700; font-size: 1.1rem; display: flex; align-items: center; gap: 8px; color: #ffffff;">
                        <i class="fa fa-star" style="color: #ffd700;"></i> Rate Your RM
                    </h5>
                    <button type="button" class="btn-close-rate-rm" onclick="closeRateRmModal()" data-bs-dismiss="modal" data-dismiss="modal" aria-label="Close" style="background: rgba(255,255,255,0.18); border: none; font-size: 22px; line-height: 1; color: #ffffff; width: 32px; height: 32px; border-radius: 50%; display: flex; align-items: center; justify-content: center; cursor: pointer; transition: background 0.2s; outline: none; padding: 0;">
                        <span aria-hidden="true" style="color: #fff; font-weight: bold; margin-top: -3px;">&times;</span>
                    </button>
                </div>
                <form id="formRateRm">
                    @csrf
                    <input type="hidden" name="staff_id" value="{{ $staff->id ?? ($vendorProfile->staff_id ?? '') }}">
                    <input type="hidden" name="rating" id="rm_rating_input" value="{{ $currentRmRating ?? 5 }}">

                    <div class="modal-body" style="padding: 22px 24px;">
                        <!-- RM Profile Preview -->
                        <div class="d-flex align-items-center p-3 mb-3" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 14px;">
                            <img src="{{ $staffImage }}" alt="RM" style="width: 48px; height: 48px; object-fit: cover; border-radius: 50%; border: 2px solid #183543; box-shadow: 0 4px 10px rgba(0,0,0,0.1); margin-right: 12px; flex-shrink: 0;">
                            <div style="min-width: 0; flex: 1;">
                                <h6 style="margin: 0 0 2px; font-size: 0.98rem; font-weight: 700; color: #1e293b;">{{ $staff->fullname ?? $staff->username }}</h6>
                                <span style="display: block; font-size: 0.82rem; color: #64748b; font-weight: 500;">Relationship Manager</span>
                                <span style="font-size: 0.82rem; color: #183543; font-weight: 600;"><i class="fa fa-phone me-1"></i>{{ $staff->mobileno }}</span>
                            </div>
                        </div>

                        <!-- Star Rating Section -->
                        <div class="text-center my-3">
                            <label style="font-weight: 600; font-size: 0.95rem; color: #334155; margin-bottom: 8px; display: block;">
                                How was your experience?
                            </label>
                            <div class="rm-interactive-stars d-flex justify-content-center align-items-center gap-2 mb-2" style="font-size: 32px; cursor: pointer; user-select: none;">
                                @for($i = 1; $i <= 5; $i++)
                                    <i class="fa fa-star rm-star-item" data-value="{{ $i }}" onclick="setRmRating({{ $i }})" style="color: {{ ($currentRmRating ?? 5) >= $i ? '#f59e0b' : '#cbd5e1' }}; transition: transform 0.15s ease, color 0.15s ease; padding: 4px; cursor: pointer;"></i>
                                @endfor
                            </div>
                            <div id="rm_rating_label" style="font-size: 0.88rem; font-weight: 700; color: #f59e0b; min-height: 20px;">
                                @php
                                    $labels = [1 => '★ Poor', 2 => '★★ Fair', 3 => '★★★ Good', 4 => '★★★★ Very Good', 5 => '★★★★★ Excellent'];
                                @endphp
                                {{ $labels[$currentRmRating ?? 5] ?? '★★★★★ Excellent' }}
                            </div>
                        </div>

                        <!-- Feedback Textarea -->
                        <div class="form-group mb-2 mt-3">
                            <label for="rm_review_input" style="font-weight: 600; font-size: 0.88rem; color: #475569; margin-bottom: 6px; display: block;">
                                Feedback / Comments <span style="font-weight: 400; color: #94a3b8;">(Optional)</span>
                            </label>
                            <textarea class="form-control" id="rm_review_input" name="review" rows="3" placeholder="Share your feedback or suggestions regarding your RM support..." style="border-radius: 10px; border: 1px solid #cbd5e1; font-size: 0.9rem; padding: 10px 12px; resize: none; background: #fff; color: #333;">{{ $currentRmReview }}</textarea>
                        </div>

                        <div id="rm_rate_alert" class="mt-2" style="display: none;"></div>
                    </div>

                    <div class="modal-footer" style="border-top: 1px solid #f1f5f9; padding: 14px 22px; background: #fafafa; display: flex; justify-content: flex-end; gap: 10px;">
                        <button type="button" class="btn btn-close-rate-rm" onclick="closeRateRmModal()" data-bs-dismiss="modal" data-dismiss="modal" style="border-radius: 8px; font-weight: 600; padding: 8px 18px; cursor: pointer; background: #e2e8f0; color: #334155; border: 1px solid #cbd5e1;">Cancel</button>
                        <button type="submit" id="btnSubmitRmRate" class="btn text-white" style="background: #183543; border: 1px solid #183543; border-radius: 8px; font-weight: 700; padding: 8px 24px; box-shadow: 0 4px 12px rgba(24, 53, 67, 0.35); cursor: pointer; transition: all 0.2s;">
                            {{ $currentRmRating ? 'Update Rating' : 'Submit Rating' }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
    (function() {
        // Crucial: Move #rateRmModal out of .page-sidebar to <body> so that sidebar position:fixed / z-index:9 does NOT trap modal behind backdrop
        function relocateModalToBody() {
            var modalEl = document.getElementById('rateRmModal');
            if (modalEl && modalEl.parentNode && modalEl.parentNode !== document.body) {
                document.body.appendChild(modalEl);
            }
        }

        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', relocateModalToBody);
        } else {
            relocateModalToBody();
        }

        var starLabels = {
            1: '★ Poor',
            2: '★★ Fair',
            3: '★★★ Good',
            4: '★★★★ Very Good',
            5: '★★★★★ Excellent'
        };

        window.openRateRmModal = function() {
            relocateModalToBody();
            var modalEl = document.getElementById('rateRmModal');
            if (!modalEl) return;

            $('#rm_rate_alert').hide().empty();

            if (window.bootstrap && window.bootstrap.Modal) {
                try {
                    if (typeof window.bootstrap.Modal.getOrCreateInstance === 'function') {
                        window.bootstrap.Modal.getOrCreateInstance(modalEl).show();
                        return;
                    } else {
                        new window.bootstrap.Modal(modalEl).show();
                        return;
                    }
                } catch(e) {}
            }
            if (window.jQuery && typeof window.jQuery.fn.modal === 'function') {
                try {
                    $('#rateRmModal').modal('show');
                    return;
                } catch(e) {}
            }

            // Direct DOM fallback
            modalEl.classList.add('show');
            modalEl.style.display = 'block';
            modalEl.removeAttribute('aria-hidden');
            document.body.classList.add('modal-open');
            if ($('.modal-backdrop').length === 0) {
                $('<div class="modal-backdrop fade show" style="z-index: 99999;"></div>').appendTo('body');
            }
        };

        window.closeRateRmModal = function() {
            var modalEl = document.getElementById('rateRmModal');
            if (modalEl) {
                if (window.bootstrap && window.bootstrap.Modal) {
                    try {
                        var inst = window.bootstrap.Modal.getInstance(modalEl);
                        if (inst) inst.hide();
                    } catch(e) {}
                }
                if (window.jQuery && typeof window.jQuery.fn.modal === 'function') {
                    try {
                        $('#rateRmModal').modal('hide');
                    } catch(e) {}
                }
                modalEl.classList.remove('show');
                modalEl.style.display = 'none';
                modalEl.setAttribute('aria-hidden', 'true');
            }
            $('.modal-backdrop').remove();
            $('body').removeClass('modal-open').css({
                'overflow': '',
                'padding-right': ''
            });
        };

        window.setRmRating = function(val) {
            val = parseInt(val) || 5;
            $('#rm_rating_input').val(val);
            highlightStars(val);
        };

        function highlightStars(val) {
            $('.rm-star-item').each(function() {
                var starVal = parseInt($(this).attr('data-value')) || 0;
                if (starVal <= val) {
                    $(this).css({ 'color': '#f59e0b', 'transform': 'scale(1)' });
                } else {
                    $(this).css({ 'color': '#cbd5e1', 'transform': 'scale(1)' });
                }
            });
            $('#rm_rating_label').text(starLabels[val] || (val + ' Stars'));
        }

        $(document).on('mouseenter', '.rm-star-item', function() {
            var hoverVal = parseInt($(this).attr('data-value')) || 5;
            highlightStars(hoverVal);
            $(this).css('transform', 'scale(1.2)');
        });

        $(document).on('mouseleave', '.rm-star-item', function() {
            $(this).css('transform', 'scale(1)');
        });

        $(document).on('mouseleave', '.rm-interactive-stars', function() {
            var currentVal = parseInt($('#rm_rating_input').val()) || 5;
            highlightStars(currentVal);
        });

        $(document).on('click', '.btn-open-rate-rm', function(e) {
            e.preventDefault();
            openRateRmModal();
        });

        $(document).on('click', '.btn-close-rate-rm, [data-bs-dismiss="modal"], [data-dismiss="modal"]', function(e) {
            e.preventDefault();
            closeRateRmModal();
        });

        $(document).on('keydown', function(e) {
            if (e.key === 'Escape' && $('#rateRmModal').is(':visible')) {
                closeRateRmModal();
            }
        });

        $(document).on('submit', '#formRateRm', function(e) {
            e.preventDefault();
            var $btn = $('#btnSubmitRmRate');
            var $alert = $('#rm_rate_alert');
            var origText = $btn.text();

            $btn.prop('disabled', true).html('<i class="fa fa-spinner fa-spin me-1"></i> Saving...');
            $alert.hide().empty();

            $.ajax({
                url: "{{ route('vendor.rate.rm') }}",
                type: "POST",
                data: $(this).serialize(),
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') || '{{ csrf_token() }}'
                },
                dataType: "json",
                success: function(res) {
                    $btn.prop('disabled', false).text('Update Rating');
                    if (res.success) {
                        $alert.html('<div class="alert alert-success py-2 px-3 mb-0" style="font-size: 0.88rem; background-color: #d1e7dd; color: #0f5132; border-color: #badbcc;"><i class="fa fa-check-circle me-1"></i> ' + res.message + '</div>').fadeIn();

                        var score = res.rating;
                        $('.rm-rate-text').text(score + '.0 ★ Rate RM');
                        $('.rm-star-icon').css('color', '#ffd700');

                        setTimeout(function() {
                            closeRateRmModal();
                        }, 1200);
                    } else {
                        $alert.html('<div class="alert alert-danger py-2 px-3 mb-0" style="font-size: 0.88rem; background-color: #f8d7da; color: #842029; border-color: #f5c2c7;">' + (res.message || 'Error saving rating.') + '</div>').fadeIn();
                    }
                },
                error: function(xhr) {
                    $btn.prop('disabled', false).text(origText);
                    var errMsg = (xhr.responseJSON && xhr.responseJSON.message) ? xhr.responseJSON.message : 'Something went wrong. Please try again.';
                    $alert.html('<div class="alert alert-danger py-2 px-3 mb-0" style="font-size: 0.88rem; background-color: #f8d7da; color: #842029; border-color: #f5c2c7;">' + errMsg + '</div>').fadeIn();
                }
            });
        });
    })();
    </script>
    @endif
</div>
