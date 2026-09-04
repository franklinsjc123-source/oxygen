@extends('app_template')
@section('title',' Offers')
@section('content')

<style>
/* ── Responsive Display Switch ── */
@media (min-width: 768px) {
    .offers-mobile-layout {
        display: none !important;
    }
    .offers-desktop-layout {
        display: block !important;
    }
}

@media (max-width: 767px) {
    .offers-desktop-layout {
        display: none !important;
    }
    .offers-mobile-layout {
        display: block !important;
    }
}

/* ── DESKTOP STYLES (min-width: 768px) ── */
.offers-desktop-layout .custom-split {
    display: flex;
    height: 240px;
    border-radius: 10px;
    color: white;
    overflow: hidden;
    background: rgba(37, 38, 42, 0.9);
}

.offers-desktop-layout .custom-split .store-left {
    width: 40%;
    padding: 20px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.offers-desktop-layout .custom-split .store-right {
    width: 60%;
}

.offers-desktop-layout .custom-split .store-right img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.offers-desktop-layout .store-address-grid {
    color: #fff5f5ff;
}

@keyframes glowing-border-desktop {
    0% { box-shadow: 0 0 10px #ff7b00, 0 0 15px rgba(255, 123, 0, 0.6); }
    50% { box-shadow: 0 0 20px #ff0055, 0 0 30px rgba(255, 0, 85, 0.8); }
    100% { box-shadow: 0 0 10px #ff7b00, 0 0 15px rgba(255, 123, 0, 0.6); }
}

.offers-desktop-layout .category-ellipse.sc-active .category-media {
    position: relative;
    border-radius: 50%;
    padding: 4px;
    background: linear-gradient(135deg, #ff7b00 0%, #ff0055 50%, #764ba2 100%);
    animation: glowing-border-desktop 2s infinite;
    transition: all 0.35s cubic-bezier(.25,.8,.25,1);
}

.offers-desktop-layout .category-ellipse.sc-active .category-media img {
    border-radius: 50%;
    border: 3px solid #fff;
}

.offers-desktop-layout .category-ellipse.sc-active {
    transform: scale(1.15) translateY(-5px);
    transition: transform 0.35s cubic-bezier(.25,.8,.25,1);
    position: relative;
    z-index: 10;
}

.offers-desktop-layout .category-ellipse.sc-active .category-name a {
    color: #ff0055 !important;
    font-weight: 800 !important;
    letter-spacing: 0.5px;
    text-transform: uppercase;
    font-size: 1.05rem;
    text-shadow: 0px 2px 4px rgba(255, 0, 85, 0.2);
}

.offers-desktop-layout .category-ellipse.sc-active .category-media::after {
    content: '★';
    position: absolute;
    top: -5px;
    right: -5px;
    background: #ff7b00;
    color: #fff;
    font-size: 14px;
    line-height: 1;
    padding: 6px;
    border-radius: 50%;
    border: 2px solid #fff;
    box-shadow: 0 2px 5px rgba(0,0,0,0.2);
}

.offers-desktop-layout .category-media {
    width: 100px;
    height: 100px;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 50% !important;
    transition: all 0.3s ease;
    aspect-ratio: 1 / 1;
    flex-shrink: 0;
}

.offers-desktop-layout .category-media img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
    display: block;
}

.offers-desktop-layout .category-ellipse:not(.sc-active):hover {
    transform: translateY(-3px);
    transition: transform 0.25s ease;
}

/* ── MOBILE STYLES (max-width: 767px) ── */
.offers-mobile-layout .offers-split-layout {
    display: flex;
    gap: 10px;
    align-items: flex-start;
    padding-top: 5px;
    padding-bottom: 20px;
}

.offers-mobile-layout .offers-sidebar {
    width: 95px;
    min-width: 95px;
    max-width: 95px;
    border-right: 1.5px solid #e2e8f0;
    padding-right: 6px;
    position: sticky;
    top: 70px;
    align-self: flex-start;
    max-height: calc(100vh - 90px);
    overflow-y: auto;
    scrollbar-width: none;
    -ms-overflow-style: none;
}

.offers-mobile-layout .offers-sidebar::-webkit-scrollbar {
    display: none;
}

.offers-mobile-layout .offers-sidebar-inner {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 16px;
}

.offers-mobile-layout .category-ellipse-item {
    width: 100%;
    text-align: center;
}

.offers-mobile-layout .category-link {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-decoration: none !important;
}

.offers-mobile-layout .category-media {
    width: 55px;
    height: 55px;
    border-radius: 50%;
    position: relative;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #ffffff;
    box-shadow: 0 2px 6px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
}

.offers-mobile-layout .category-media img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
    display: block;
}

@keyframes glowing-border-mobile {
    0% { box-shadow: 0 0 8px #ff7b00, 0 0 14px rgba(255, 123, 0, 0.6); }
    50% { box-shadow: 0 0 16px #ff0055, 0 0 24px rgba(255, 0, 85, 0.8); }
    100% { box-shadow: 0 0 8px #ff7b00, 0 0 14px rgba(255, 123, 0, 0.6); }
}

.offers-mobile-layout .category-ellipse-item.sc-active .category-media {
    padding: 3px;
    background: linear-gradient(135deg, #ff7b00 0%, #ff0055 50%, #764ba2 100%);
    animation: glowing-border-mobile 2s infinite;
    transform: scale(1.06);
}

.offers-mobile-layout .category-ellipse-item.sc-active .category-media img {
    border: 2px solid #ffffff;
}

.offers-mobile-layout .star-badge {
    position: absolute;
    top: -3px;
    right: -3px;
    background: #ff7b00;
    color: #ffffff;
    font-size: 10px;
    width: 16px;
    height: 16px;
    line-height: 16px;
    border-radius: 50%;
    border: 2px solid #ffffff;
    font-weight: bold;
    text-align: center;
    box-shadow: 0 2px 4px rgba(0,0,0,0.25);
    z-index: 2;
    display: flex;
    align-items: center;
    justify-content: center;
}

.offers-mobile-layout .category-name {
    font-size: 10px;
    line-height: 1.2;
    margin-top: 4px;
    color: #333333;
    font-weight: 600;
    text-align: center;
    word-break: break-word;
}

.offers-mobile-layout .category-ellipse-item.sc-active .category-name {
    color: #ff0055 !important;
    font-weight: 800 !important;
    text-transform: uppercase;
}

.offers-mobile-layout .offers-main-content {
    flex: 1;
    min-width: 0;
}

.offers-mobile-layout .offer-group-title {
    font-size: 16px;
    font-weight: 700;
    color: #222222;
    text-align: center;
    margin: 2px 0 12px 0;
}

.offers-mobile-layout .offer-cards-stack {
    display: flex;
    flex-direction: column;
    gap: 14px;
}

.offers-mobile-layout .store-card-item {
    display: flex;
    border-radius: 12px;
    overflow: hidden;
    background: #25262a;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
    min-height: 160px;
    position: relative;
}

.offers-mobile-layout .store-card-left {
    width: 48%;
    min-width: 48%;
    background: #25262a;
    color: #ffffff;
    padding: 10px 8px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.offers-mobile-layout .store-card-title {
    font-size: 14px;
    font-weight: 700;
    margin: 0 0 3px 0;
    line-height: 1.2;
}

.offers-mobile-layout .store-card-title a {
    color: #ffffff !important;
    text-decoration: none;
}

.offers-mobile-layout .store-ratings {
    margin-bottom: 3px;
}

.offers-mobile-layout .stars-red {
    color: #ff3366;
    font-size: 11px;
    letter-spacing: 1px;
}

.offers-mobile-layout .store-subtitle {
    color: #a0a0a0;
    font-size: 11px;
    margin-bottom: 4px;
}

.offers-mobile-layout .store-address {
    color: #d1d5db;
    font-size: 10px;
    line-height: 1.35;
    margin-bottom: 4px;
}

.offers-mobile-layout .store-phone {
    color: #9ca3af;
    font-size: 10px;
    display: flex;
    align-items: center;
    gap: 4px;
}

.offers-mobile-layout .store-card-right {
    width: 52%;
    min-width: 52%;
    position: relative;
    overflow: hidden;
    background: #1e1f23;
}

.offers-mobile-layout .store-img-link {
    display: block;
    width: 100%;
    height: 100%;
}

.offers-mobile-layout .store-img-link img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

.offers-mobile-layout .store-action-btn {
    position: absolute;
    bottom: 8px;
    right: 8px;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    background: #0088cc;
    color: #ffffff !important;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none !important;
    box-shadow: 0 4px 10px rgba(0, 136, 204, 0.45);
    z-index: 5;
}

.offers-mobile-layout .store-action-btn i {
    font-size: 15px;
    color: #ffffff;
}
</style>

<main class="main">
    <!-- Breadcrumb (Shared) -->
    <nav class="breadcrumb-nav">
        <div class="container">
            <ul class="breadcrumb bb-no">
                <li><a href="{{ url('home') }}">Home</a></li>
                <li><a href="{{ url('offers') }}">Offers</a></li>

                @if($offer_id > 0)
                    <li><a href="{{ url('offers?id='.$offer_id) }}">{{ $offer_name }}</a></li>
                @else
                    <li><a href="{{ url('offers') }}">All</a></li>
                @endif
            </ul>
        </div>
    </nav>

    <!-- ── DESKTOP LAYOUT (min-width: 768px) ── -->
    <div class="offers-desktop-layout">
        <div class="page-content">
            <div class="container">

                <div class="shop-default-category category-ellipse-section mb-6">
                    <div class="row gutter-lg cols-xl-8 cols-lg-7 cols-md-6 cols-sm-4 cols-xs-4 cols-4 justify-content-center mt-4">
                        <div class="category-wrap mb-4">
                            <div class="category category-ellipse {{ ($offer_id == 0) ? 'sc-active' : '' }}">
                                <figure class="category-media">
                                    <a href="{{ url('offers') }}">
                                        <img src="{{ asset('assets/images/offer_logo/all_offer.jpeg') }}" alt="All Offers" style="background-color: #5C92C0;" />
                                    </a>
                                </figure>
                                <div class="category-content">
                                    <h4 class="category-name">
                                        <a href="{{ url('offers') }}">All Offers</a>
                                    </h4>
                                </div>
                            </div>
                        </div>

                        @foreach($offer as $o)
                        <div class="category-wrap mb-4">
                            <div class="category category-ellipse {{ ($selectedGroupKey == $o->group_key) ? 'sc-active' : '' }}">
                                <figure class="category-media">
                                    <a href="{{ url('offers?id='.$o->id) }}">
                                        <img src="{{ asset('assets/images/offer_logo/'.$o->offer_logo) }}" alt="Category" style="background-color: #5C92C0;" />
                                    </a>
                                </figure>
                                <div class="category-content">
                                    <h4 class="category-name">
                                        <a href="{{ url('offers?id='.$o->id) }}">{{ $o->title }}</a>
                                    </h4>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="page-content mb-8 mt-5">
                    <div class="container">
                        <div class="toolbox vendor-toolbox pb-0">
                            <div class="toolbox-left mb-4 mb-md-0"></div>
                        </div>
                        <div class="vendor-search-wrapper">
                            <form class="vendor-search-form">
                                <input type="email" class="form-control mr-4 bg-white" name="vendor" id="vendor" placeholder="Search Vendors" />
                                <button class="btn btn-primary btn-rounded" type="submit">Apply</button>
                            </form>
                        </div>

                        @foreach($groupedOffers as $groupKey => $vendors)
                        <div class="mt-5 mb-2">
                            <h3 class="title title-center title-underline">{{ $groupLabels[$groupKey] ?? $groupKey }}</h3>
                        </div>
                        <div class="row cols-lg-3 cols-md-2 cols-sm-2 cols-1 mt-2">
                            @foreach($vendors as $vendor)
                                <div class="store-wrap mb-4">
                                    <div class="store store-grid">
                                        <div class="store-header custom-split">
                                            <div class="store-left">
                                                <h4 class="store-title">
                                                    <a href="{{ url('/vendor-offer-products/'.$vendor->id.'?ids='.($groupOfferIds[$groupKey] ?? '')) }}">
                                                        {{ $vendor->shop_name }}
                                                    </a>
                                                </h4>

                                                <div class="ratings-container">
                                                    <div class="ratings-full">
                                                        <span class="ratings" style="width:100%;"></span>
                                                    </div>
                                                </div>

                                                <div class="store-address-grid">
                                                    {{ $vendor->address }} , <br>
                                                    {{ $vendor->city }} - {{ $vendor->pincode }} , <br>
                                                    {{ $vendor->state }} . <br>
                                                    <i class="w-icon-phone"></i> {{ $vendor->mobile_number1 }}
                                                </div>
                                            </div>

                                            <div class="store-right">
                                                <a href="{{ url('/vendor-offer-products/'.$vendor->id.'?ids='.($groupOfferIds[$groupKey] ?? '')) }}">
                                                    <img src="{{ asset('assets/images/vendor/profile/' . $vendor->profile_image) }}" alt="">
                                                </a>
                                            </div>
                                        </div>

                                        <div class="store-footer">
                                            <figure class="seller-brand">
                                                <a href="{{ url('/vendor-offer-products/'.$vendor->id.'?ids='.($groupOfferIds[$groupKey] ?? '')) }}">
                                                    <img src="{{ asset('assets/images/vendor/profile/' . $vendor->profile_image) }}" alt="Brand" width="80" height="80" />
                                                </a>
                                            </figure>
                                            <a href="{{ url('/vendor-offer-products/'.$vendor->id.'?ids='.($groupOfferIds[$groupKey] ?? '')) }}" class="btn btn-dark btn-link btn-underline btn-icon-right btn-visit"><b></b></a>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        @endforeach

                        @if(empty($groupedOffers) || count($groupedOffers) == 0)
                        <div class="text-center mt-5 mb-5">
                            <h4>No offers available at the moment.</h4>
                        </div>
                        @endif
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- ── MOBILE LAYOUT (max-width: 767px) ── -->
    <div class="offers-mobile-layout">
        <div class="page-content mb-8">
            <div class="container">
                <div class="offers-split-layout">

                    <!-- LEFT SIDEBAR: OFFER CATEGORIES -->
                    <aside class="offers-sidebar">
                        <div class="offers-sidebar-inner">
                            <div class="category-ellipse-item {{ ($offer_id == 0) ? 'sc-active' : '' }}">
                                <a href="{{ url('offers') }}" class="category-link">
                                    <figure class="category-media">
                                        <img src="{{ asset('assets/images/offer_logo/all_offer.jpeg') }}" alt="All Offers" />
                                        @if($offer_id == 0)
                                            <span class="star-badge">★</span>
                                        @endif
                                    </figure>
                                    <h4 class="category-name">ALL OFFERS</h4>
                                </a>
                            </div>

                            @foreach($offer as $o)
                            <div class="category-ellipse-item {{ ($selectedGroupKey == $o->group_key) ? 'sc-active' : '' }}">
                                <a href="{{ url('offers?id='.$o->id) }}" class="category-link">
                                    <figure class="category-media">
                                        <img src="{{ asset('assets/images/offer_logo/'.$o->offer_logo) }}" alt="{{ $o->title }}" />
                                        @if($selectedGroupKey == $o->group_key)
                                            <span class="star-badge">★</span>
                                        @endif
                                    </figure>
                                    <h4 class="category-name">{{ $o->title }}</h4>
                                </a>
                            </div>
                            @endforeach
                        </div>
                    </aside>

                    <!-- RIGHT MAIN CONTENT: GROUP TITLES & VENDOR CARDS -->
                    <main class="offers-main-content">
                        @if(!empty($groupedOffers) && count($groupedOffers) > 0)
                            @foreach($groupedOffers as $groupKey => $vendors)
                                <div class="offer-group-block mb-6">
                                    <h3 class="offer-group-title">{{ $groupLabels[$groupKey] ?? $groupKey }}</h3>

                                    <div class="offer-cards-stack">
                                        @foreach($vendors as $vendor)
                                            <div class="store-card-item">
                                                <div class="store-card-left">
                                                    <h4 class="store-card-title">
                                                        <a href="{{ url('/vendor-offer-products/'.$vendor->id.'?ids='.($groupOfferIds[$groupKey] ?? '')) }}">
                                                            {{ $vendor->shop_name }}
                                                        </a>
                                                    </h4>

                                                    <div class="store-ratings">
                                                        <span class="stars-red">★★★★★</span>
                                                    </div>

                                                    <div class="store-subtitle">
                                                        {{ $vendor->owner_name ?: 'Random' }}
                                                    </div>

                                                    <div class="store-address">
                                                        @if($vendor->address) {{ $vendor->address }},<br> @endif
                                                        @if($vendor->city) {{ $vendor->city }} - {{ $vendor->pincode }},<br> @endif
                                                        @if($vendor->state) {{ $vendor->state }} . @endif
                                                    </div>

                                                    @if($vendor->mobile_number1)
                                                        <div class="store-phone">
                                                            <i class="w-icon-phone"></i> {{ $vendor->mobile_number1 }}
                                                        </div>
                                                    @endif
                                                </div>

                                                <div class="store-card-right">
                                                    <a href="{{ url('/vendor-offer-products/'.$vendor->id.'?ids='.($groupOfferIds[$groupKey] ?? '')) }}" class="store-img-link">
                                                        <img src="{{ asset('assets/images/vendor/profile/' . $vendor->profile_image) }}" 
                                                             alt="{{ $vendor->shop_name }}"
                                                             onerror="this.src='{{ asset('assets/images/vendor/profile/1683363518.jpg') }}';" />
                                                    </a>
                                                    
                                                    <a href="{{ url('/vendor-offer-products/'.$vendor->id.'?ids='.($groupOfferIds[$groupKey] ?? '')) }}" class="store-action-btn" title="View Store Offers">
                                                        <i class="w-icon-map-marker"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            @endforeach
                        @else
                            <div class="text-center py-5">
                                <i class="w-icon-exclamation-circle" style="font-size: 40px; color: #ccc;"></i>
                                <h4 class="mt-3" style="color: #666;">No offers available at the moment.</h4>
                            </div>
                        @endif
                    </main>

                </div>
            </div>
        </div>
    </div>
</main>

@endsection