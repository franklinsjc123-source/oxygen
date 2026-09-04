@extends('app_template')
@section('title',' Offers')
@section('content')

<style>
/* ── Offers Page Split Layout ── */
.offers-split-layout {
    display: flex;
    gap: 14px;
    align-items: flex-start;
    padding-top: 10px;
    padding-bottom: 20px;
}

/* ── Left Sidebar (Vertical Offer Icons) ── */
.offers-sidebar {
    width: 105px;
    min-width: 105px;
    max-width: 105px;
    border-right: 1.5px solid #e2e8f0;
    padding-right: 10px;
    position: sticky;
    top: 80px;
    align-self: flex-start;
    max-height: calc(100vh - 100px);
    overflow-y: auto;
    scrollbar-width: none;
    -ms-overflow-style: none;
}

.offers-sidebar::-webkit-scrollbar {
    display: none;
}

.offers-sidebar-inner {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 18px;
}

/* Sidebar Item */
.category-ellipse-item {
    width: 100%;
    text-align: center;
}

.category-link {
    display: flex;
    flex-direction: column;
    align-items: center;
    text-decoration: none !important;
}

.category-media {
    width: 60px;
    height: 60px;
    border-radius: 50%;
    position: relative;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #ffffff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: all 0.3s cubic-bezier(0.25, 0.8, 0.25, 1);
}

.category-media img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
    display: block;
}

/* Glowing Border Animation for Active Offer */
@keyframes glowing-border {
    0% { box-shadow: 0 0 8px #ff7b00, 0 0 14px rgba(255, 123, 0, 0.6); }
    50% { box-shadow: 0 0 16px #ff0055, 0 0 24px rgba(255, 0, 85, 0.8); }
    100% { box-shadow: 0 0 8px #ff7b00, 0 0 14px rgba(255, 123, 0, 0.6); }
}

.category-ellipse-item.sc-active .category-media {
    padding: 3px;
    background: linear-gradient(135deg, #ff7b00 0%, #ff0055 50%, #764ba2 100%);
    animation: glowing-border 2s infinite;
    transform: scale(1.08);
}

.category-ellipse-item.sc-active .category-media img {
    border: 2px solid #ffffff;
}

.star-badge {
    position: absolute;
    top: -3px;
    right: -3px;
    background: #ff7b00;
    color: #ffffff;
    font-size: 10px;
    width: 18px;
    height: 18px;
    line-height: 18px;
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

.category-name {
    font-size: 11px;
    line-height: 1.25;
    margin-top: 6px;
    color: #333333;
    font-weight: 600;
    text-align: center;
    word-break: break-word;
}

.category-ellipse-item.sc-active .category-name {
    color: #ff0055 !important;
    font-weight: 800 !important;
    text-transform: uppercase;
}

/* ── Right Main Content (Shop Cards) ── */
.offers-main-content {
    flex: 1;
    min-width: 0;
}

.offer-group-title {
    font-size: 17px;
    font-weight: 700;
    color: #222222;
    text-align: center;
    margin: 4px 0 16px 0;
    position: relative;
    padding-bottom: 6px;
}

.offer-cards-stack {
    display: flex;
    flex-direction: column;
    gap: 16px;
}

/* Store Card Item */
.store-card-item {
    display: flex;
    border-radius: 12px;
    overflow: hidden;
    background: #25262a;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
    min-height: 175px;
    position: relative;
    transition: transform 0.2s ease, box-shadow 0.2s ease;
}

.store-card-item:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 18px rgba(0, 0, 0, 0.18);
}

/* Left Half - Details */
.store-card-left {
    width: 48%;
    min-width: 48%;
    background: #25262a;
    color: #ffffff;
    padding: 14px 12px;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.store-card-title {
    font-size: 15px;
    font-weight: 700;
    margin: 0 0 3px 0;
    line-height: 1.25;
}

.store-card-title a {
    color: #ffffff !important;
    text-decoration: none;
}

.store-ratings {
    margin-bottom: 4px;
}

.stars-red {
    color: #ff3366;
    font-size: 12px;
    letter-spacing: 1px;
}

.store-subtitle {
    color: #a0a0a0;
    font-size: 12px;
    margin-bottom: 6px;
}

.store-address {
    color: #d1d5db;
    font-size: 11px;
    line-height: 1.4;
    margin-bottom: 6px;
}

.store-phone {
    color: #9ca3af;
    font-size: 11px;
    display: flex;
    align-items: center;
    gap: 4px;
}

.store-phone i {
    font-size: 11px;
    color: #9ca3af;
}

/* Right Half - Photo & Action Button */
.store-card-right {
    width: 52%;
    min-width: 52%;
    position: relative;
    overflow: hidden;
    background: #1e1f23;
}

.store-img-link {
    display: block;
    width: 100%;
    height: 100%;
}

.store-img-link img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    display: block;
}

/* Floating Blue Action Button */
.store-action-btn {
    position: absolute;
    bottom: 10px;
    right: 10px;
    width: 42px;
    height: 42px;
    border-radius: 50%;
    background: #0088cc;
    color: #ffffff !important;
    display: flex;
    align-items: center;
    justify-content: center;
    text-decoration: none !important;
    box-shadow: 0 4px 12px rgba(0, 136, 204, 0.45);
    transition: transform 0.2s ease, background-color 0.2s ease;
    z-index: 5;
}

.store-action-btn:hover {
    transform: scale(1.1);
    background: #0077bb;
}

.store-action-btn i {
    font-size: 18px;
    color: #ffffff;
}

/* Mobile Responsiveness Tweaks */
@media (max-width: 480px) {
    .offers-sidebar {
        width: 95px;
        min-width: 95px;
        max-width: 95px;
        padding-right: 6px;
    }
    .category-media {
        width: 52px;
        height: 52px;
    }
    .category-name {
        font-size: 10px;
    }
    .store-card-left {
        padding: 10px 8px;
    }
    .store-card-title {
        font-size: 14px;
    }
    .store-address {
        font-size: 10px;
        line-height: 1.35;
    }
    .store-action-btn {
        width: 36px;
        height: 36px;
        bottom: 8px;
        right: 8px;
    }
    .store-action-btn i {
        font-size: 15px;
    }
}
</style>

<!-- Start of Main -->
<main class="main">
    <!-- Start of Breadcrumb -->
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
    <!-- End of Breadcrumb -->

    <!-- Start of Page Content -->
    <div class="page-content mb-8">
        <div class="container">
            <div class="offers-split-layout">

                <!-- LEFT SIDEBAR: OFFER CATEGORIES -->
                <aside class="offers-sidebar">
                    <div class="offers-sidebar-inner">
                        
                        <!-- All Offers Category Item -->
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

                        <!-- Individual Offer Items -->
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

                                            <!-- LEFT BOX: STORE DETAILS -->
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

                                            <!-- RIGHT BOX: STORE IMAGE & FLOATING BUTTON -->
                                            <div class="store-card-right">
                                                <a href="{{ url('/vendor-offer-products/'.$vendor->id.'?ids='.($groupOfferIds[$groupKey] ?? '')) }}" class="store-img-link">
                                                    <img src="{{ asset('assets/images/vendor/profile/' . $vendor->profile_image) }}" 
                                                         alt="{{ $vendor->shop_name }}"
                                                         onerror="this.src='{{ asset('assets/images/vendor/profile/1683363518.jpg') }}';" />
                                                </a>
                                                
                                                <!-- Floating Blue Action Button -->
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
</main>

@endsection