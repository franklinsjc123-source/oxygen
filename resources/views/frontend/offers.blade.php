@extends('app_template')
@section('title',' Offers')
@section('content')

<style>
/* ── Unified Offers Layout Styles ── */
.offers-split-layout {
    display: flex;
    gap: 20px;
    align-items: flex-start;
    padding-top: 10px;
    padding-bottom: 30px;
}

/* ── LEFT SIDEBAR (OFFERS LIST) ── */
.offers-sidebar {
    position: sticky;
    top: 90px;
    align-self: flex-start;
    overflow-y: auto;
    scrollbar-width: none;
    -ms-overflow-style: none;
    border-right: 2px solid #e2e8f0;
    padding-right: 12px;
}

.offers-sidebar::-webkit-scrollbar {
    display: none;
}

.offers-sidebar-inner {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 14px;
}

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
    position: relative;
    margin: 0 auto;
    display: flex;
    align-items: center;
    justify-content: center;
    background: #ffffff;
    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    transition: all 0.3s ease;
    border-radius: 50%;
}

.category-media img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    border-radius: 50%;
    display: block;
}

@keyframes glowing-border-sidebar {
    0% { box-shadow: 0 0 8px #ff7b00, 0 0 14px rgba(255, 123, 0, 0.6); }
    50% { box-shadow: 0 0 16px #ff0055, 0 0 24px rgba(255, 0, 85, 0.8); }
    100% { box-shadow: 0 0 8px #ff7b00, 0 0 14px rgba(255, 123, 0, 0.6); }
}

.category-ellipse-item.sc-active .category-media {
    padding: 3px;
    background: linear-gradient(135deg, #ff7b00 0%, #ff0055 50%, #764ba2 100%);
    animation: glowing-border-sidebar 2s infinite;
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
    font-size: 11px;
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
    margin-top: 4px;
    margin-bottom: 0;
    color: #333333;
    font-weight: 600;
    text-align: center;
    word-break: break-word;
    line-height: 1.2;
}

.category-ellipse-item.sc-active .category-name {
    color: #ff0055 !important;
    font-weight: 800 !important;
    text-transform: uppercase;
}

/* ── RIGHT MAIN CONTENT ── */
.offers-main-content {
    flex: 1;
    min-width: 0;
}

.vendor-search-wrapper {
    margin-bottom: 20px;
}

.vendor-search-form {
    display: flex;
    align-items: center;
    max-width: 500px;
}

.offer-group-block {
    margin-bottom: 24px;
}

.offer-group-title {
    font-size: 18px;
    font-weight: 700;
    color: #222222;
    margin: 0 0 12px 0;
    padding-bottom: 6px;
    border-bottom: 2px solid #ff0055;
    display: inline-block;
}

.offer-cards-grid {
    display: grid;
    gap: 16px;
}

/* Responsive screen size rules */
@media (min-width: 992px) {
    .offers-sidebar {
        width: 320px;
        min-width: 320px;
        max-width: 320px;
        max-height: calc(100vh - 110px);
        padding-right: 15px;
    }
    .offers-sidebar-inner {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 14px 8px;
    }
    .category-media {
        width: 60px;
        height: 60px;
    }
    .category-name {
        font-size: 11px;
    }
    .offer-cards-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
    }
}

@media (min-width: 768px) and (max-width: 991px) {
    .offers-sidebar {
        width: 220px;
        min-width: 220px;
        max-width: 220px;
        max-height: calc(100vh - 100px);
        padding-right: 10px;
    }
    .offers-sidebar-inner {
        display: grid;
        grid-template-columns: repeat(2, 1fr);
        gap: 12px 6px;
    }
    .category-media {
        width: 52px;
        height: 52px;
    }
    .category-name {
        font-size: 10px;
    }
    .offer-cards-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 12px;
    }
}

@media (max-width: 767px) {
    .offers-sidebar {
        width: 85px;
        min-width: 85px;
        max-width: 85px;
        top: 70px;
        max-height: calc(100vh - 80px);
        padding-right: 6px;
    }
    .offers-sidebar-inner {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 12px;
    }
    .category-media {
        width: 48px;
        height: 48px;
    }
    .category-name {
        font-size: 10px;
    }
    .offer-cards-grid {
        grid-template-columns: 1fr;
    }
    .offer-group-title {
        font-size: 15px;
        text-align: center;
        display: block;
        border-bottom: none;
    }
}

/* ── STORE CARD ITEM ── */
.store-card-item {
    display: flex;
    border-radius: 12px;
    overflow: hidden;
    background: #25262a;
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.12);
    min-height: 160px;
    position: relative;
    cursor: pointer;
    transition: transform 0.25s ease, box-shadow 0.25s ease;
}

.store-card-item:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
}

.store-card-left {
    width: 48%;
    min-width: 48%;
    background: #25262a;
    color: #ffffff;
    padding: 12px 10px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    cursor: pointer;
}

.store-card-title {
    font-size: 14px;
    font-weight: 700;
    margin: 0 0 4px 0;
    line-height: 1.25;
}

.store-card-title a {
    color: #ffffff !important;
    text-decoration: none;
}

.store-card-title a:hover {
    color: #ff0055 !important;
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
    font-size: 11px;
    margin-bottom: 4px;
}

.store-address {
    color: #d1d5db;
    font-size: 10px;
    line-height: 1.35;
    margin-bottom: 4px;
}

.store-phone {
    color: #9ca3af;
    font-size: 10px;
    display: flex;
    align-items: center;
    gap: 4px;
}

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

.store-action-btn {
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
    transition: transform 0.2s ease, background 0.2s ease;
}

.store-action-btn:hover {
    transform: scale(1.1);
    background: #006699;
}

.store-action-btn i {
    font-size: 15px;
    color: #ffffff;
}
</style>

<main class="main">
    <!-- Breadcrumb -->
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

    <div class="page-content mb-8">
        <div class="container">
            <div class="offers-split-layout">

                <!-- LEFT SIDEBAR: OFFER CATEGORIES / LOGOS + NAMES -->
                <aside class="offers-sidebar">
                    <div class="offers-sidebar-inner">
                        <!-- ALL OFFERS ITEM -->
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

                        <!-- INDIVIDUAL OFFER ITEMS -->
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

                <!-- RIGHT MAIN CONTENT: SEARCH & VENDOR CARDS -->
                <main class="offers-main-content">
                    <!-- Vendor Search Input -->
                    <div class="vendor-search-wrapper mb-4">
                        <form class="vendor-search-form" onsubmit="return false;">
                            <input type="text" class="form-control mr-4 bg-white" name="vendor" id="vendor-search-input" placeholder="Search Vendors by shop name, address..." />
                            <button class="btn btn-primary btn-rounded" type="button"><i class="w-icon-search"></i> Search</button>
                        </form>
                    </div>

                    @if(!empty($groupedOffers) && count($groupedOffers) > 0)
                        @foreach($groupedOffers as $groupKey => $vendors)
                            <div class="offer-group-block">
                                <h3 class="offer-group-title">{{ $groupLabels[$groupKey] ?? $groupKey }}</h3>

                                <div class="offer-cards-grid">
                                    @foreach($vendors as $vendor)
                                        <div class="store-card-item" onclick="window.location.href='{{ url('/vendor-offer-products/'.$vendor->id.'?ids='.($groupOfferIds[$groupKey] ?? '')) }}';">
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
                                                    {{ $vendor->owner_name ?: 'Vendor' }}
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    var searchInput = document.getElementById('vendor-search-input');
    if (searchInput) {
        searchInput.addEventListener('input', function() {
            var query = this.value.toLowerCase().trim();
            var cards = document.querySelectorAll('.store-card-item');
            
            cards.forEach(function(card) {
                var text = card.textContent.toLowerCase();
                if (query === '' || text.indexOf(query) !== -1) {
                    card.style.display = 'flex';
                } else {
                    card.style.display = 'none';
                }
            });

            var groups = document.querySelectorAll('.offer-group-block');
            groups.forEach(function(group) {
                var cardsInGroup = group.querySelectorAll('.store-card-item');
                var hasVisible = false;
                cardsInGroup.forEach(function(c) {
                    if (c.style.display !== 'none') {
                        hasVisible = true;
                    }
                });
                if (!hasVisible && query !== '') {
                    group.style.display = 'none';
                } else {
                    group.style.display = 'block';
                }
            });
        });
    }
});
</script>

@endsection