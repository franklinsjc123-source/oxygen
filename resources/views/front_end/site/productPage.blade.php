@extends('front_end.app')
@section('content')
<style>
    .size {
        width: 40px;
        height: 40px;
        border: 1px solid #ccc;
        background-color: white;
        font-size: 14px;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        /* Needed for pseudo-element positioning */
    }

    .size.disabled {
        color: #999;
        cursor: not-allowed;
    }

    .size.disabled::after {
        content: '';
        position: absolute;
        width: 100%;
        height: 2px;
        background-color: #999;
        /* Line-through color */
        top: 50%;
        left: 0;
        transform: rotate(-45deg);
        /* Rotate by 45 degrees */
        transform-origin: center;
    }

    .size:hover:not(.disabled) {
        background-color: #f0f0f0;
    }
</style>
<div class="page-wrapper">

    @include('front_end.common.header')
    <!-- Start of Main -->
    <main class="main mb-10 pb-1">
        <!-- Start of Breadcrumb -->
        <nav class="breadcrumb-nav container">
            <ul class="breadcrumb bb-no">
                <li><a href="#">Home</a></li>
                <li>Products</li>
            </ul>

        </nav>
        <!-- End of Breadcrumb -->

        <!-- Start of Page Content -->
        <div class="page-content">
            <div class="container">
                <div class="row gutter-lg">
                    <div class="main-content">
                        <div class="product product-single row">
                            <div class="col-md-6 mb-6">
                                <div class="product-gallery product-gallery-sticky">
                                    <div class="swiper-container product-single-swiper swiper-theme nav-inner"
                                        data-swiper-options="{
                                        'navigation': {
                                            'nextEl': '.swiper-button-next',
                                            'prevEl': '.swiper-button-prev'
                                        }
                                    }">

                                        @php
                                        $ImgaeOfProduct = isset($getSpecificProduct)
                                        ? json_decode($getSpecificProduct->product_detail_image) ?? null
                                        : null;
                                        @endphp
                                        <div class="swiper-wrapper row cols-1 gutter-no">
                                            @foreach ($ImgaeOfProduct ?? [] as $img)
                                            <div class="swiper-slide">
                                                <figure class="product-image">
                                                    <img src="{{ asset('assets/images/products/detail') . '/' . $img }}"
                                                        data-zoom-image="{{ asset('assets/images/products/detail') . '/' . $img }}"
                                                        alt="Electronics Black Wrist Watch" width="800"
                                                        height="900">
                                                </figure>
                                            </div>
                                            @endforeach
                                        </div>
                                        <button class="swiper-button-next"></button>
                                        <button class="swiper-button-prev"></button>
                                        <a href="#" class="product-gallery-btn product-image-full"><i
                                                class="w-icon-zoom"></i></a>
                                    </div>
                                    <div class="product-thumbs-wrap swiper-container"
                                        data-swiper-options="{
                                        'navigation': {
                                            'nextEl': '.swiper-button-next',
                                            'prevEl': '.swiper-button-prev'
                                        }
                                    }">
                                        <div class="product-thumbs swiper-wrapper row cols-4 gutter-sm">
                                            @foreach ($ImgaeOfProduct ?? [] as $imgs)
                                            <div class="product-thumb swiper-slide">
                                                <img src="{{ asset('assets/images/products/detail') . '/' . $imgs }}"
                                                    alt="Product Thumb" width="800" height="900">
                                            </div>
                                            @endforeach
                                        </div>
                                        <button class="swiper-button-next"></button>
                                        <button class="swiper-button-prev"></button>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 mb-4 mb-md-6">
                                <div class="product-details" data-sticky-options="{'minWidth': 767}">
                                    <h1 class="product-title">{{ $getSpecificProduct->product->product_name }}</h1>
                                    <div class="product-bm-wrapper">
                                        <figure class="brand">
                                            <img src="{{ asset('/website_assets/images/brands/brand.jpg') }}"
                                                alt="Brand" width="102" height="48" />
                                        </figure>
                                        <div class="product-meta">
                                            @if ($vendor_details != '')
                                            <div class="product-categories">
                                                Vendor :
                                                <span class="product-category"><a
                                                        href="{{ url('Vendor_information/' . $vendor_details->id) }}">{{ $vendor_details->shop_name }}</a></span>
                                            </div><br>
                                            @endif
                                            <div class="product-categories">
                                                Category:
                                                <span class="product-category"><a
                                                        href="#">{{ $getSpecificProduct->product->CategoryChild->category_sub_name }}</a></span>
                                            </div>
                                            <br>
                                            <div class="product-sku">
                                                SKU: <span>{{ $getSpecificProduct->sku }}</span>
                                            </div>
                                            <br>
                                            <!-- <div class="product-sku">
                                                Vendor: <span>{{ $vendor_name }}</span>
                                            </div> -->
                                        </div>
                                    </div>

                                    <hr class="product-divider">

                                    <div class="product-price"><ins
                                            class="new-price">₹{{ $getSpecificProduct->selling_price }}</ins></div>

                                    <div class="ratings-container">
                                        <div class="ratings-full">
                                            <span class="ratings" style="width: 80%;"></span>
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                        <a href="#product-tab-reviews" class="rating-reviews scroll-to">(3
                                            Reviews)</a>
                                    </div>

                                    <!--<div class="product-short-desc">
                                            <ul class="list-type-check list-style-none">
                                                <li>Ultrices eros in cursus turpis massa cursus mattis.</li>
                                                <li>Volutpat ac tincidunt vitae semper quis lectus.</li>
                                                <li>Aliquam id diam maecenas ultricies mi eget mauris.</li>
                                            </ul>
                                        </div>
    -->
                                    <hr class="product-divider">

                                    @if ($getSpecificProduct->attributename1 != '')
                                    <div
                                        class="product-form product-variation-form product-color-swatch product-size-swatch"">
                                                <label>{{ $getSpecificProduct->attributename1 }}: </label>
                                                <div class=" flex-wrap d-flex align-items-center product-variations">
                                        @php
                                        $uniqueColors = [];
                                        @endphp
                                        @foreach ($getrelateProduct as $colour)
                                        @if (!in_array($colour->attributevalue1, $uniqueColors))
                                        @php
                                        $uniqueColors[] = $colour->attributevalue1;

                                        $color = App\Models\Master\Colors\ProductColor::where(
                                        'color_name',
                                        $colour->attributevalue1,
                                        )->first();

                                        @endphp
                                        <a onclick="setColor('<?= $colour->attributevalue1 ?>')" title="{{ $colour->attributevalue1 }}" href="#"
                                            class="color {{ $colour->attributevalue1 == $getSpecificProduct->attributevalue1 ? 'active' : '' }}"
                                            style="background-color: {{ $color->color_code }}"></a>
                                        @endif
                                        @endforeach
                                    </div>
                                </div>
                                @endif
                                @if ($getSpecificProduct->attributename2 != '')
                                <div class="product-form product-variation-form product-size-swatch">
                                    <label class="mb-1">{{ $getSpecificProduct->attributename2 }}: </label>
                                    <div class="flex-wrap d-flex align-items-center product-variations">

                                        @php
                                        $uniqueSize = [];
                                        @endphp
                                        @foreach ($getrelateProduct as $size)
                                        @if (!in_array($size->attributevalue2, $uniqueSize))
                                        @php
                                        $uniqueSize[] = $size->attributevalue2;
                                        @endphp
                                        <a onclick="setSize('<?= $size->attributevalue2 ?>')" title="{{ $size->attributevalue2 }}" href="#"
                                            class="size {{ $size->attributevalue2 == $getSpecificProduct->attributevalue2 ? 'active' : '' }}">
                                            {{ $size->attributevalue2 }} </a>
                                        @endif
                                        @endforeach
                                    </div>

                                </div>
                                @endif
                                @if ($getSpecificProduct->attributename3 != '')
                                <div class="product-form product-variation-form product-size-swatch">
                                    <label class="mb-1">{{ $getSpecificProduct->attributename3 }}: </label>
                                    <div class="flex-wrap d-flex align-items-center product-variations">

                                        @php
                                        $uniqueSize1 = [];
                                        @endphp
                                        @foreach ($getrelateProduct as $size1)
                                        @if (!in_array($size1->attributevalue3, $uniqueSize1))
                                        @php
                                        $uniqueSize1[] = $size1->attributevalue3;
                                        @endphp
                                        <a title="{{ $size1->attributevalue3 }}" href="#"
                                            class="size disabled {{ $size1->attributevalue3 == $getSpecificProduct->attributevalue3 ? 'active' : '' }}">
                                            {{ $size1->attributevalue3 }} </a>
                                        @endif
                                        @endforeach
                                    </div>

                                </div>
                                @endif
                                <input type="hidden" id="product-size"  value=""/>
                                <input type="hidden" id="product-color" value=""/>
                                <input type="hidden" name="product_size"
                                    id="product_size{{ $getSpecificProduct->id }}"
                                    value="{{ $getSpecificProduct->attributevalue1 }}"
                                    class="form-control input-number">
                                <input type="hidden" name="hidden_name"
                                    id="product_name{{ $getSpecificProduct->id }}"
                                    value="{{ $getSpecificProduct->product->product_name }}" />
                                <input type="hidden" name="hidden_price"
                                    id="product_price{{ $getSpecificProduct->id }}"
                                    value="{{ $getSpecificProduct->selling_price }}" />
                                <input type="hidden" name="product_id"
                                    id="product_id{{ $getSpecificProduct->id }}"
                                    value="{{ $getSpecificProduct->id }}" />
                                <div class="row" style="display:block;"
                                    id="addcart2_{{ $getSpecificProduct->id }}">
                                    <div class="col-md-4">

                                        <div class="product-qty-form">
                                            <div class="input-group">
                                                <input type="text" name="quant[2]"
                                                    id="quantity{{ $getSpecificProduct->id }}" value="1"
                                                    class="form-control input-number" min="1"
                                                    max="100" readonly>

                                                <button class="quantity-plus w-icon-plus"
                                                    onclick="addqnty('{{ $getSpecificProduct->id }}','Add')"></button>
                                                <button class="quantity-minus w-icon-minus"
                                                    onclick="addqnty('{{ $getSpecificProduct->id }}','Minus')"></button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-4 ">
                                        <a href="{{ url('/Shopping-cart') }}" class="buttons"><button
                                                type="button" class="btn add-to-cart-btn">&nbsp; <i
                                                    class="biolife-icon icon-cart"></i> &nbsp; BUY NOW</button></a>
                                    </div> -->
                                </div>

                                <br>

                                @php
                                $adcartbtn = 'd-block';
                                $pincodetxtbtn = 'd-block';
                                @endphp
                                @if (session()->has('pincode'))
                                @php
                                $adcartbtn = 'd-block';
                                $adcartbtnactinact = 'enable';
                                $pincodetxtbtn = 'd-none';
                                @endphp
                                @else
                                @php
                                $adcartbtn = 'd-block';
                                $adcartbtnactinact = 'disabled';
                                $pincodetxtbtn = 'd-block';
                                @endphp
                                @endif
                                <div class="buttons {{ $adcartbtn }}"
                                    id="addcart1_{{ $getSpecificProduct->id }}">
                                    <!-- <button type="button" class="btn btn-primary"
                                            onclick="{{ $adcartbtnactinact == 'enable' ? "addqnty('{$getSpecificProduct->id}', 'Add')" : "swal('Error!', 'Please check your pincode before adding to cart', 'error')" }}">
                                            <i class="w-icon-cart"></i>&nbsp; Add to cart handleAddToCart({{ $getSpecificProduct->id }}, '{{ $adcartbtnactinact }}')
                                        </button> -->
                                    <div class="row">
                                        <div class=" col-md-4">
                                            <button type="button" class="btn btn-primary"
                                                onclick="addCart('<?= $getSpecificProduct->id ?>')">
                                                <i class="w-icon-cart"></i>&nbsp; Add to cart
                                            </button>
                                        </div>
                                        <div class=" col-md-1">
                                        </div>

                                        <div class=" col-md-4">
                                            <button type="button" class="btn btn-warning "
                                                onclick="addwishlist('{{ $getSpecificProduct->id }}')"> <i
                                                    class="w-icon-heart"></i> Add Wish list</span></button>

                                        </div>
                                    </div>

                                </div>
                            </div>

                            <form id="pincodeForm" class="{{$pincodetxtbtn}}">
                                <div class="row mt-3">
                                    <div class="col-md-6">
                                        <div class="form-group mt-1">
                                            <h6> <label for="pincode">Pincode</label></h6>
                                            <input type="text" class="form-control" id="pincode"
                                                name="pincode"
                                                placeholder="Enter pincode" value="{{ session('pincode') }}"
                                                required pattern="^\d{6}$" maxlength="6">
                                            <h6 id="pincodeHelp" class="form-text mt-2">Please enter a 6-digit
                                                pincode.</h6>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mt-5"><br>
                                        <button type="submit" class="btn btn-primary btn-check">Check
                                            Delivery Area</button>
                                    </div>
                                </div>
                                <div id="pincodeResponse" class="mt-3"></div>
                            </form>





                        </div>
                    </div>
                </div>

                <div class="tab tab-nav-boxed tab-nav-underline product-tabs">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item">
                            <a href="#product-tab-description" class="nav-link active">Description</a>
                        </li>
                        <li class="nav-item">
                            <a href="#product-tab-specification" class="nav-link">Specification</a>
                        </li>
                        <li class="nav-item">
                            <a href="#product-tab-vendor" class="nav-link">Vendor Info</a>
                        </li>
                        <li class="nav-item">
                            <a href="#product-tab-reviews" class="nav-link">Customer Reviews (3)</a>
                        </li>
                    </ul>
                    <div class="tab-content">
                        <div class="tab-pane active" id="product-tab-description">
                            <div class="row mb-4">
                                <div class="col-md-6 mb-5">
                                    <h4 class="title tab-pane-title font-weight-bold mb-2">Detail</h4>
                                    <p class="mb-4">{{ $getSpecificProduct->product->description }}</p>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane" id="product-tab-specification">
                            @foreach ($ProductSpecs as $spec)
                            <p>{{ $spec->specify_attribute }} : {{ $spec->specify_value }} </p>
                            @endforeach
                        </div>
                        <div class="tab-pane" id="product-tab-vendor">
                            @if ($vendor_details != '')
                            <div class="row mb-3">


                                <div class="col-md-6 mb-4">
                                    <figure class="vendor-banner br-sm">
                                        <img src="{{ asset('assets/images/vendor/profile/' . $vendor_details->profile_image) }}"
                                            alt="Vendor Banner" width="610" height="200"
                                            style="background-color: #353B55;" />
                                    </figure>
                                </div>
                                <div class="col-md-6 pl-2 pl-md-6 mb-4">
                                    <div class="vendor-user">
                                        <!--<figure class="vendor-logo mr-4">
                                                        <a href="#">
                                                            <img src="/website_assets/images/products/vendor-logo.jpg"
                                                                alt="Vendor Logo" width="80" height="80" />
                                                        </a>
                                                    </figure>-->
                                        <div>
                                            <div class="vendor-name"><a
                                                    href="#">{{ $vendor_details->owner_name }}</a>
                                            </div>
                                            <div class="ratings-container">
                                                <div class="ratings-full">
                                                    <span class="ratings" style="width: 90%;"></span>
                                                    <span class="tooltiptext tooltip-top"></span>
                                                </div>
                                                <!--<a href="#" class="rating-reviews">(32 Reviews)</a>-->
                                            </div>
                                        </div>
                                    </div>
                                    <ul class="vendor-info list-style-none">
                                        <li class="store-name">
                                            <label>Store Name:</label>
                                            <span class="detail">{{ $vendor_details->shop_name }}</span>
                                        </li>
                                        <li class="store-address">
                                            <label>Address:</label>
                                            <span class="detail">{{ $vendor_details->address }},</span>
                                            <span class="detail">{{ $vendor_details->address1 }},</span>
                                            <span class="detail">{{ $vendor_details->city }},</span>
                                            <span class="detail">{{ $vendor_details->state }}</span>
                                            <span class="detail">- {{ $vendor_details->pincode }}</span>
                                        </li>
                                        <li class="store-phone">
                                            <label>Phone:</label>
                                            <a href="#tel:">{{ $vendor_details->mobile_number1 }}</a>
                                        </li>
                                        <li class="store-phone">
                                            <label>Other Phone:</label>
                                            <a href="#tel:">{{ $vendor_details->mobile_number2 }}</a>
                                        </li>
                                    </ul>
                                    <a href="vendor-dokan-store.html"
                                        class="btn btn-dark btn-link btn-underline btn-icon-right">Visit
                                        Store<i class="w-icon-long-arrow-right"></i></a>
                                    <p class="mb-5">
                                        {{ $vendor_details->description }}
                                    </p>
                                </div>
                            </div>
                            @else
                            <div class="row mb-3">


                                <div class="col-md-6 mb-4">
                                    <figure class="vendor-banner br-sm">
                                        <img src="{{ asset('website_assets/images/brands/brand.jpg') }}"
                                            alt="Vendor Banner" width="610" height="200"
                                            style="background-color: #353B55;" />
                                    </figure>
                                </div>

                            </div>
                            @endif
                        </div>
                        <div class="tab-pane" id="product-tab-reviews">


                            <div class="tab tab-nav-boxed tab-nav-outline tab-nav-center">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a href="#show-all" class="nav-link active">Show All</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#helpful-positive" class="nav-link">Most Helpful
                                            Positive</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#helpful-negative" class="nav-link">Most Helpful
                                            Negative</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#highest-rating" class="nav-link">Highest Rating</a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="#lowest-rating" class="nav-link">Lowest Rating</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active" id="show-all">
                                        <ul class="comments list-style-none">
                                            <li class="comment">
                                                <div class="comment-body">
                                                    <figure class="comment-avatar">
                                                        <img src="assets/images/agents/1-100x100.png"
                                                            alt="Commenter Avatar" width="90"
                                                            height="90">
                                                    </figure>
                                                    <div class="comment-content">
                                                        <h4 class="comment-author">
                                                            <a href="#">John Doe</a>
                                                            <span class="comment-date">March 22, 2021 at
                                                                1:54 pm</span>
                                                        </h4>
                                                        <div class="ratings-container comment-rating">
                                                            <div class="ratings-full">
                                                                <span class="ratings"
                                                                    style="width: 60%;"></span>
                                                                <span class="tooltiptext tooltip-top"></span>
                                                            </div>
                                                        </div>
                                                        <p>pellentesque habitant morbi tristique senectus
                                                            et. In dictum non consectetur a erat.
                                                            Nunc ultrices eros in cursus turpis massa
                                                            tincidunt ante in nibh mauris cursus mattis.
                                                            Cras ornare arcu dui vivamus arcu felis bibendum
                                                            ut tristique.</p>
                                                        <div class="comment-action">
                                                            <a href="#"
                                                                class="btn btn-secondary btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                <i class="far fa-thumbs-up"></i>Helpful (1)
                                                            </a>
                                                            <a href="#"
                                                                class="btn btn-dark btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                <i class="far fa-thumbs-down"></i>Unhelpful
                                                                (0)
                                                            </a>
                                                            <div class="review-image">
                                                                <a href="#">
                                                                    <figure>
                                                                        <img src="/website_assets/images/products/default/review-img-1.jpg"
                                                                            width="60" height="60"
                                                                            alt="Attachment image of John Doe's review on Electronics Black Wrist Watch"
                                                                            data-zoom-image="/website_assets/images/products/default/review-img-1-800x900.jpg" />
                                                                    </figure>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="tab-pane" id="helpful-positive">
                                        <ul class="comments list-style-none">
                                            <li class="comment">
                                                <div class="comment-body">
                                                    <figure class="comment-avatar">
                                                        <img src="assets/images/agents/1-100x100.png"
                                                            alt="Commenter Avatar" width="90"
                                                            height="90">
                                                    </figure>
                                                    <div class="comment-content">
                                                        <h4 class="comment-author">
                                                            <a href="#">John Doe</a>
                                                            <span class="comment-date">March 22, 2021 at
                                                                1:54 pm</span>
                                                        </h4>
                                                        <div class="ratings-container comment-rating">
                                                            <div class="ratings-full">
                                                                <span class="ratings"
                                                                    style="width: 60%;"></span>
                                                                <span class="tooltiptext tooltip-top"></span>
                                                            </div>
                                                        </div>
                                                        <p>pellentesque habitant morbi tristique senectus
                                                            et. In dictum non consectetur a erat.
                                                            Nunc ultrices eros in cursus turpis massa
                                                            tincidunt ante in nibh mauris cursus mattis.
                                                            Cras ornare arcu dui vivamus arcu felis bibendum
                                                            ut tristique.</p>
                                                        <div class="comment-action">
                                                            <a href="#"
                                                                class="btn btn-secondary btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                <i class="far fa-thumbs-up"></i>Helpful (1)
                                                            </a>
                                                            <a href="#"
                                                                class="btn btn-dark btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                <i class="far fa-thumbs-down"></i>Unhelpful
                                                                (0)
                                                            </a>
                                                            <div class="review-image">
                                                                <a href="#">
                                                                    <figure>
                                                                        <img src="/website_assets/images/products/default/review-img-1.jpg"
                                                                            width="60" height="60"
                                                                            alt="Attachment image of John Doe's review on Electronics Black Wrist Watch"
                                                                            data-zoom-image="/website_assets/images/products/default/review-img-1.jpg" />
                                                                    </figure>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>

                                        </ul>
                                    </div>
                                    <div class="tab-pane" id="helpful-negative">
                                        <ul class="comments list-style-none">
                                            <li class="comment">
                                                <div class="comment-body">
                                                    <figure class="comment-avatar">
                                                        <img src="assets/images/agents/3-100x100.png"
                                                            alt="Commenter Avatar" width="90"
                                                            height="90">
                                                    </figure>
                                                    <div class="comment-content">
                                                        <h4 class="comment-author">
                                                            <a href="#">John Doe</a>
                                                            <span class="comment-date">March 22, 2021 at
                                                                1:21 pm</span>
                                                        </h4>
                                                        <div class="ratings-container comment-rating">
                                                            <div class="ratings-full">
                                                                <span class="ratings"
                                                                    style="width: 60%;"></span>
                                                                <span class="tooltiptext tooltip-top"></span>
                                                            </div>
                                                        </div>
                                                        <p>In fermentum et sollicitudin ac orci phasellus. A
                                                            condimentum vitae
                                                            sapien pellentesque habitant morbi tristique
                                                            senectus et. In dictum
                                                            non consectetur a erat. Nunc scelerisque viverra
                                                            mauris in aliquam sem fringilla.</p>
                                                        <div class="comment-action">
                                                            <a href="#"
                                                                class="btn btn-secondary btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                <i class="far fa-thumbs-up"></i>Helpful (0)
                                                            </a>
                                                            <a href="#"
                                                                class="btn btn-dark btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                <i class="far fa-thumbs-down"></i>Unhelpful
                                                                (1)
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane" id="highest-rating">
                                        <ul class="comments list-style-none">
                                            <li class="comment">
                                                <div class="comment-body">
                                                    <figure class="comment-avatar">
                                                        <img src="assets/images/agents/2-100x100.png"
                                                            alt="Commenter Avatar" width="90"
                                                            height="90">
                                                    </figure>
                                                    <div class="comment-content">
                                                        <h4 class="comment-author">
                                                            <a href="#">John Doe</a>
                                                            <span class="comment-date">March 22, 2021 at
                                                                1:52 pm</span>
                                                        </h4>
                                                        <div class="ratings-container comment-rating">
                                                            <div class="ratings-full">
                                                                <span class="ratings"
                                                                    style="width: 80%;"></span>
                                                                <span class="tooltiptext tooltip-top"></span>
                                                            </div>
                                                        </div>
                                                        <p>Nullam a magna porttitor, dictum risus nec,
                                                            faucibus sapien.
                                                            Ultrices eros in cursus turpis massa tincidunt
                                                            ante in nibh mauris cursus mattis.
                                                            Cras ornare arcu dui vivamus arcu felis bibendum
                                                            ut tristique.</p>
                                                        <div class="comment-action">
                                                            <a href="#"
                                                                class="btn btn-secondary btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                <i class="far fa-thumbs-up"></i>Helpful (1)
                                                            </a>
                                                            <a href="#"
                                                                class="btn btn-dark btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                <i class="far fa-thumbs-down"></i>Unhelpful
                                                                (0)
                                                            </a>
                                                            <div class="review-image">
                                                                <a href="#">
                                                                    <figure>
                                                                        <img src="/website_assets/images/products/default/review-img-2.jpg"
                                                                            width="60" height="60"
                                                                            alt="Attachment image of John Doe's review on Electronics Black Wrist Watch"
                                                                            data-zoom-image="/website_assets/images/products/default/review-img-2-800x900.jpg" />
                                                                    </figure>
                                                                </a>
                                                                <a href="#">
                                                                    <figure>
                                                                        <img src="/website_assets/images/products/default/review-img-3.jpg"
                                                                            width="60" height="60"
                                                                            alt="Attachment image of John Doe's review on Electronics Black Wrist Watch"
                                                                            data-zoom-image="/website_assets/images/products/default/review-img-3-800x900.jpg" />
                                                                    </figure>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="tab-pane" id="lowest-rating">
                                        <ul class="comments list-style-none">
                                            <li class="comment">
                                                <div class="comment-body">
                                                    <figure class="comment-avatar">
                                                        <img src="assets/images/agents/1-100x100.png"
                                                            alt="Commenter Avatar" width="90"
                                                            height="90">
                                                    </figure>
                                                    <div class="comment-content">
                                                        <h4 class="comment-author">
                                                            <a href="#">John Doe</a>
                                                            <span class="comment-date">March 22, 2021 at
                                                                1:54 pm</span>
                                                        </h4>
                                                        <div class="ratings-container comment-rating">
                                                            <div class="ratings-full">
                                                                <span class="ratings"
                                                                    style="width: 60%;"></span>
                                                                <span class="tooltiptext tooltip-top"></span>
                                                            </div>
                                                        </div>
                                                        <p>pellentesque habitant morbi tristique senectus
                                                            et. In dictum non consectetur a erat.
                                                            Nunc ultrices eros in cursus turpis massa
                                                            tincidunt ante in nibh mauris cursus mattis.
                                                            Cras ornare arcu dui vivamus arcu felis bibendum
                                                            ut tristique.</p>
                                                        <div class="comment-action">
                                                            <a href="#"
                                                                class="btn btn-secondary btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                <i class="far fa-thumbs-up"></i>Helpful (1)
                                                            </a>
                                                            <a href="#"
                                                                class="btn btn-dark btn-link btn-underline sm btn-icon-left font-weight-normal text-capitalize">
                                                                <i class="far fa-thumbs-down"></i>Unhelpful
                                                                (0)
                                                            </a>
                                                            <div class="review-image">
                                                                <a href="#">
                                                                    <figure>
                                                                        <img src="/website_assets/images/products/default/review-img-3.jpg"
                                                                            width="60" height="60"
                                                                            alt="Attachment image of John Doe's review on Electronics Black Wrist Watch"
                                                                            data-zoom-image="/website_assets/images/products/default/review-img-3-800x900.jpg" />
                                                                    </figure>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <section class="vendor-product-section">
                    <div class="title-link-wrapper mb-4">
                        <h4 class="title text-left">More Products From This Vendor</h4>
                        <a href="#" class="btn btn-dark btn-link btn-slide-right btn-icon-right">More
                            Products<i class="w-icon-long-arrow-right"></i></a>
                    </div>
                    <div class="swiper-container swiper-theme"
                        data-swiper-options="{
                                    'spaceBetween': 20,
                                    'slidesPerView': 2,
                                    'breakpoints': {
                                        '576': {
                                            'slidesPerView': 4
                                        },
                                        '768': {
                                            'slidesPerView': 4
                                        },
                                        '992': {
                                            'slidesPerView': 4
                                        }
                                    }
                                }">
                        <div class="swiper-wrapper row cols-lg-3 cols-md-4 cols-sm-3 cols-2">

                            @foreach ($getRelateVendorProduct as $vendorProducts)
                            @if ($vendorProducts->productdetails)
                            <div class="swiper-slide product">
                                <figure class="product-media">
                                    <a
                                        href="{{ route('getProduct', $vendorProducts->productdetails->id) }}">
                                        <img src="{{ asset('assets/images/products') . '/' . $vendorProducts->product_image }}"
                                            alt="Product" width="300" height="338" />
                                        <img src="{{ asset('assets/images/products') . '/' . $vendorProducts->product_image }}"
                                            alt="Product" width="300" height="338" />
                                    </a>

                                    {{-- <div class="product-action-vertical">
                                                    <a href="#" class="btn-product-icon btn-cart w-icon-cart"
                                                        title="Add to cart"></a>
                                                    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                                        title="Add to wishlist"></a>
                                                    <a href="#" class="btn-product-icon btn-compare w-icon-compare"
                                                        title="Add to Compare"></a>
                                                </div> --}}
                                    <div class="product-action">
                                        <a href="{{ route('getProduct', $vendorProducts->productdetails->id) }}"
                                            class="btn-product" title="Quick View">Quick
                                            View</a>
                                    </div>
                                </figure>
                                <div class="product-details">
                                    <div class="product-cat"><a
                                            href="shop-banner-sidebar.html">Accessories</a>
                                    </div>
                                    <h4 class="product-name"><a
                                            href="{{ route('getProduct', $vendorProducts->productdetails->id) }}">
                                            {{ $vendorProducts->product_name }}</a>
                                    </h4>
                                    <div class="ratings-container">
                                        <div class="ratings-full">
                                            <span class="ratings" style="width: 100%;"></span>
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                        <a href="{{ route('getProduct', $vendorProducts->productdetails->id) }}"
                                            class="rating-reviews">(3
                                            reviews)</a>
                                    </div>
                                    <div class="product-pa-wrapper">
                                        <div class="product-price">
                                            ₹{{ $vendorProducts->productdetails->selling_price }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </section>
                <section class="related-product-section">
                    <div class="title-link-wrapper mb-4">
                        <h4 class="title">Related Products</h4>
                        <a href="#" class="btn btn-dark btn-link btn-slide-right btn-icon-right">More
                            Products<i class="w-icon-long-arrow-right"></i></a>
                    </div>
                    <div class="swiper-container swiper-theme"
                        data-swiper-options="{
                                'spaceBetween': 20,
                                'slidesPerView': 2,
                                'breakpoints': {
                                    '576': {
                                        'slidesPerView': 4
                                    },
                                    '768': {
                                        'slidesPerView': 4
                                    },
                                    '992': {
                                        'slidesPerView': 4
                                    }
                                }
                            }">
                        <div class="swiper-wrapper row cols-lg-3 cols-md-4 cols-sm-3 cols-2">
                            @foreach ($getRelateVendorProduct as $vendorProducts)
                            @if ($vendorProducts->productdetails)
                            <div class="swiper-slide product">
                                <figure class="product-media">
                                    <a
                                        href="{{ route('getProduct', $vendorProducts->productdetails->id) }}">
                                        <img src="{{ asset('assets/images/products') . '/' . $vendorProducts->product_image }}"
                                            alt="Product" width="300" height="338" />
                                        <img src="{{ asset('assets/images/products') . '/' . $vendorProducts->product_image }}"
                                            alt="Product" width="300" height="338" />
                                    </a>

                                    {{-- <div class="product-action-vertical">
                                                    <a href="#" class="btn-product-icon btn-cart w-icon-cart"
                                                        title="Add to cart"></a>
                                                    <a href="#" class="btn-product-icon btn-wishlist w-icon-heart"
                                                        title="Add to wishlist"></a>
                                                    <a href="#" class="btn-product-icon btn-compare w-icon-compare"
                                                        title="Add to Compare"></a>
                                                </div> --}}
                                    <div class="product-action">
                                        <a href="{{ route('getProduct', $vendorProducts->productdetails->id) }}" class="btn-product"
                                            title="Quick View">Quick
                                            View</a>
                                    </div>
                                </figure>
                                <div class="product-details">
                                    <div class="product-cat"><a
                                            href="shop-banner-sidebar.html">Accessories</a>
                                    </div>
                                    <h4 class="product-name"><a
                                            href="{{ route('getProduct', $vendorProducts->productdetails->id) }}">
                                            {{ $vendorProducts->product_name }}</a>
                                    </h4>
                                    <div class="ratings-container">
                                        <div class="ratings-full">
                                            <span class="ratings" style="width: 100%;"></span>
                                            <span class="tooltiptext tooltip-top"></span>
                                        </div>
                                        <a href="{{ route('getProduct', $vendorProducts->productdetails->id) }}"
                                            class="rating-reviews">(3
                                            reviews)</a>
                                    </div>
                                    <div class="product-pa-wrapper">
                                        <div class="product-price">
                                            ₹{{ $vendorProducts->productdetails->selling_price }}
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endif
                            @endforeach
                        </div>
                    </div>
                </section>
            </div>
            <!-- End of Main Content -->
            <aside class="sidebar product-sidebar sidebar-fixed right-sidebar sticky-sidebar-wrapper">
                <div class="sidebar-overlay"></div>
                <a class="sidebar-close" href="#"><i class="close-icon"></i></a>
                <a href="#" class="sidebar-toggle d-flex d-lg-none"><i
                        class="fas fa-chevron-left"></i></a>
                <div class="sidebar-content scrollable">
                    <div class="sticky-sidebar">
                        <div class="widget widget-icon-box mb-6">
                            <div class="icon-box icon-box-side">
                                <span class="icon-box-icon text-dark">
                                    <i class="w-icon-truck"></i>
                                </span>
                                <div class="icon-box-content">
                                    <h4 class="icon-box-title">Free Shipping & Returns</h4>
                                    <p>For all orders over Rs.400 above</p>
                                </div>
                            </div>
                            <div class="icon-box icon-box-side">
                                <span class="icon-box-icon text-dark">
                                    <i class="w-icon-bag"></i>
                                </span>
                                <div class="icon-box-content">
                                    <h4 class="icon-box-title">Secure Payment</h4>
                                    <p>We ensure secure payment</p>
                                </div>
                            </div>
                            <div class="icon-box icon-box-side">
                                <span class="icon-box-icon text-dark">
                                    <i class="w-icon-money"></i>
                                </span>
                                <div class="icon-box-content">
                                    <h4 class="icon-box-title">Money Back Guarantee</h4>
                                    <p>Any back within 30 days</p>
                                </div>
                            </div>
                        </div>
                        <!-- End of Widget Icon Box -->




                    </div>
                </div>
            </aside>
            <!-- End of Sidebar -->
        </div>
</div>
</div>
<!-- End of Page Content -->
</main>
<!-- End of Main -->
</div>
<!-- End of Page Wrapper -->

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function handleAddToCart(productId, status) {

        if (status === 'enable') {
            addqnty(productId, 'Add');
        } else {
            swal('Error!', 'Please check your pincode before adding to cart', 'error');
        }
    }

    function setSize(size)
    {
        $('#product-size').val(size);
    }
    function setColor(color)
    {
         $('#product-color').val(color);
    }


    $(document).ready(function() {

        // When the form is submitted
        $('#pincodeForm').on('submit', function(e) {
            e.preventDefault(); // Prevent form from submitting the traditional way
            var siteurl = "{{ url('/') }}";
            var pincode = $('#pincode').val(); // Get the value of the pincode field
            //alert(pincode);
            // AJAX request to check the pincode
            $.ajax({
                url: "{{ route('checkPincode')}}", // The route we created in web.php
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}', // Include CSRF token for security
                    pincode: pincode // Send the pincode as data
                },
                success: function(response) {
                    // Handle the response from the server
                    if (response.status === 'success') {
                        $('#pincodeResponse').html('<p style="color: success;">' + response
                            .message + '</p>');
                        location.reload();
                    } else {
                        $('#pincodeResponse').html('<p style="color: red;">' + response
                            .message + '</p>');

                    }
                },
                error: function(xhr, status, error) {
                    // If there is an error with the AJAX request
                    $('#pincodeResponse').html(
                        '<p style="color: red;">An error occurred. Please try again.</p>'
                    );
                }
            });
        });
    });


    function addCart(id) {
       // var id = '<?=  $getSpecificProduct->id ?>';

        var pincode = '<?= session()->get('pincode'); ?>';
       
        if(pincode === '')
        {
             $.notify("Please Check Pincode!", "error");  
             return false;
        }

        var qty = $('#quantity'+id).val();
        var url = '<?= route('customCart') ?>';
        var size =   $('#product-size').val();
        var color =  $('#product-color').val();
      
        if(color === '')
        {
             $.notify("Please Choose Color!", "error");  
             return false;
        }

        if(size === '')
        {
             $.notify("Please Choose Size!", "error");  
             return false;
        }

       
        


        $.post(url, {
            id: id,
            qty: qty,
            size: size,
            color: color,
            '_token': '<?= csrf_token() ?>'
        }, function(data) {
            $.notify(data.message, "success", "bottom");            
            $('.cart-count').html(data.count);
        });
    }
</script>
@endsection