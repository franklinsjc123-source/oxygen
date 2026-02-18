 @extends('app_template')
 @section('title','OXYGEN')
 @section('content')
@include('website.front-end.newhead')
@include('website.partials.js.frontendjs')
@include('paritials.js.userwebsite.cart_js')
{{-- @include('paritials.website.header') --}}

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<style>
    #loading-container {
        display: none;
        position: fixed;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background-color: rgba(255, 255, 255, 0.8);
        z-index: 9999;
    }

    .loader {
        border: 8px solid #f3f3f3;
        border-top: 8px solid #3498db;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        animation: spin 2s linear infinite;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>

<body style="background-color:#F0F0F0" class="theme-color-29">
    <div id="loading-container">
        <div class="loader"></div>
    </div>

    @include('paritials.website.menu')

    <div class="title1 section-t-space pt-5">
        <h4 class="title-inner1 text-left">Search Results for "{{ $keyword }}"</h4>
    </div>

    <section style="background-color:#f7f1f2" class="pt-0 section-b-space ratio_asos">
        <div class="container-fuild">
            <div class="row game-product grid-products px-5">
                @if(($products ?? collect())->count() === 0)
                    <div class="col-12 pt-4 pb-4">
                        <h5>No products found.</h5>
                    </div>
                @endif

                @foreach($products as $product)
                    <div class="gallery_product product-box col-xl-2 col-lg-3 col-sm-4 col-6 default">
                        <div class="product-box">
                            <div class="img-wrapper">
                                <div class="front">
                                    <a href="{{ route('addtocart', $product->product_id ) }}">
                                        <img src="{{ asset('assets/images/products') . '/' . $product->product_image }}" class="img-fluid blur-up lazyload bg-img" alt="">
                                    </a>
                                </div>
                                <div class="cart-info cart-wrap">
                                    <a href="javascript:void(0)" title="Add to Wishlist" tabindex="0"><i class="ti-heart" aria-hidden="true"></i></a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" title="Quick View" tabindex="0"><i class="ti-search" aria-hidden="true"></i></a>
                                    <a href="compare.html" title="Compare" tabindex="0"><i class="ti-reload" aria-hidden="true"></i></a>
                                </div>
                            </div>

                            <div class="product-detail">
                                <a href="{{ route('addtocart', $product->product_id ) }}">
                                    @php
                                        $vendorName = App\Models\User::where('login_id', $product->created_by)->value('name');
                                        $retail = (float) ($product->retail_price ?? 0);
                                        $selling = (float) ($product->selling_price ?? 0);
                                        $offerperc = $retail > 0 ? (($retail - $selling) / $retail) * 100 : 0;
                                        $displayColor = $product->attributevalue1 ?? '#d9d9d9';
                                    @endphp

                                    <h6 style="background-color:lightgray;">{{ $vendorName ?? 'Vendor' }}</h6>
                                    <h6>{{ $product->product_name }}</h6>
                                    <h6>Rs.{{ $selling }} <del>Rs {{ $retail }}</del><span style="color:red;">Offer: {{ round($offerperc) }}%</span></h6>
                                    <ul class="color-variant">
                                        <li style="background-color:{{ $displayColor }};"></li>
                                    </ul>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
            function showLoader() {
                document.getElementById("loading-container").style.display = "block";
            }

            function hideLoader() {
                document.getElementById("loading-container").style.display = "none";
            }

            window.addEventListener("beforeunload", showLoader);
            window.addEventListener("load", hideLoader);
        });

        $(document).ready(function () {
            var pincode = ('{{ session()->get("pincode") }}' || '').trim();
            if (!/^\d{6}$/.test(pincode) && typeof window.showPicodePopup === 'function') {
                setTimeout(function () {
                    window.showPicodePopup();
                }, 400);
            }
        });
    </script>

    @include('website.front-end.newfooter')
</body>
@endsection