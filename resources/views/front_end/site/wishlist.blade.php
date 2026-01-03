<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title>Wolmart eCommmerce Marketplace HTML Template</title>

    <meta name="keywords" content="Marketplace ecommerce responsive HTML5 Template" />
    <meta name="description" content="Wolmart is powerful marketplace &amp; ecommerce responsive Html5 Template.">
    <meta name="author" content="D-THEMES">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('website_assets/images/icons/favicon.png')}}">

    <!-- WebFont.js -->
    <script>
        WebFontConfig = {
            google: { families: ['Poppins:400,500,600,700'] }
        };
        ( function ( d ) {
            var wf = d.createElement( 'script' ), s = d.scripts[0];
            wf.src = "{{ asset('website_assets/js/webfont.js')}}";
            wf.async = true;
            s.parentNode.insertBefore( wf, s );
        } )( document );
    </script>

    <link rel="preload" href="{{ asset('website_assets/vendor/fontawesome-free/webfonts/fa-regular-400.woff2')}}" as="font" type="font/woff2"
        crossorigin="anonymous">
    <link rel="preload" href="{{ asset('website_assets/vendor/fontawesome-free/webfonts/fa-solid-900.woff2')}}" as="font" type="font/woff2"
        crossorigin="anonymous">
    <link rel="preload" href="{{ asset('website_assets/vendor/fontawesome-free/webfonts/fa-brands-400.woff2')}}" as="font" type="font/woff2"
            crossorigin="anonymous">
    <link rel="preload" href="{{ asset('website_assets/fonts/wolmart.woff?png09e')}}" as="font" type="font/woff" crossorigin="anonymous">

    <!-- Vendor CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('website_assets/vendor/fontawesome-free/css/all.min.css')}}">

    <!-- Plugin CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('website_assets/vendor/magnific-popup/magnific-popup.min.css')}}">

    <!-- Default CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('website_assets/css/style.min.css')}}">
	<style>
	table  tbody tr td { text-align:center;}
	</style>
</head>

<body class="my-account">
    <div class="page-wrapper">
       
        <!-- Start of Header -->
         @include('front_end.common.header')
        <!-- End of Header -->

        <!-- Start of Main -->
        <main class="main wishlist-page">
            <!-- Start of Page Header -->
            <div class="page-header">
                <div class="container">
                    <h1 class="page-title mb-0">Wishlist</h1>
                </div>
            </div>
            <!-- End of Page Header -->

            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav mb-10">
                <div class="container">
                    <ul class="breadcrumb">
                        <li><a href="demo1.html">Home</a></li>
                        <li>Wishlist</li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->

            <!-- Start of PageContent -->
            <div class="page-content">
                <div class="container">
                    <h3 class="wishlist-title">My wishlist</h3>
                    <table class="shop-table wishlist-table">
                        <thead>
                            <tr>
                                <th class="product-name"><span>Product</span></th>
                                <th>Product Name</th>
                                <th class="product-price"><span>Price</span></th>
                                <th class="product-stock-status"><span>Stock Status</span></th>
                                <th class="wishlist-action">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php $i=0; @endphp
                                       @if($wishCount>0)
										@foreach ($wishlist as $product)
                                        @php  $i++; $images=explode(',',$product->product_detail_image);  $img=substr($images[0], 2, -1);       @endphp
                                        
                            <tr>
                                <td class="product-thumbnail">
                                    <div class="p-relative">
                                        <a href="{{url('ViewProduct_information',$product->ecom_product_id)}}">
                                            <figure>
                                                <img src="{{ asset('assets/images/products/detail') . '/' . $img }}"  alt="product" width="300"
                                                    height="338">
                                            </figure>
                                        </a>
                                        <a   href="{{url('Delete_wishlist',$product->ecom_wishlist_id)}}" class="btn btn-close"><i
                                                class="fas fa-times"></i></a>
                                    </div>
                                </td>
                                <td class="product-name">
                                    <a href="{{url('ViewProduct_information',$product->ecom_product_id)}}">
                                    {{ $product->product_name }}
                                    </a>
                                </td>
                                <td class="product-price"><ins class="new-price">Rs. {{ $product->selling_price }} <del><span class="currencySymbol">Rs.</span> {{ $product->retail_price }} </del></ins></td>
                                <td class="product-stock-status">
                                    <span class="wishlist-in-stock">In Stock</span>
                                </td>
                                <td class="wishlist-action">
                                    <div class="d-lg-flex">
                                        <a href="{{url('Delete_wishlist',$product->ecom_wishlist_id)}}"
                                            class="btn btn-default btn-rounded btn-sm mb-2 mb-lg-0">Remove 
                                            </a>
                                        <a href="{{url('ViewProduct_information',$product->ecom_product_id)}}" class="btn btn-dark btn-rounded btn-sm ml-lg-2 btn-cart">Add to
                                            cart</a>
                                    </div>
                                </td>
                            </tr>
                          
                                        @endforeach
                                        @else
                                        <tr data-id="1">
                                            <td colspan="5">
                                                <center><i class="d-icon-bag"></i> Your Wishlist is Empty</center>
                                            </td>
                                        </tr>
                                        @endif
                                        <tr class="cart_item wrap-buttons">
                                            <td class="wrap-btn-control" colspan="4">
                                                <a href="{{ url('/') }}" class="btn back-to-shop">Back to Shop</a>
                                            </td>
                                        </tr>
                        </tbody>
                    </table>
                    <div class="social-links">
                        <label>Share On:</label>
                        <div class="social-icons social-no-color border-thin">
                            <a href="#" class="social-icon social-facebook w-icon-facebook"></a>
                            <a href="#" class="social-icon social-twitter w-icon-twitter"></a>
                            <a href="#" class="social-icon social-pinterest w-icon-pinterest"></a>
                            <a href="#" class="social-icon social-email far fa-envelope"></a>
                            <a href="#" class="social-icon social-whatsapp fab fa-whatsapp"></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of PageContent -->
        </main>
        <!-- End of Main -->
        <!-- Start of Footer -->
         @include('front_end.common.footer')

    <!-- Plugin JS File -->
    <script src="{{ asset('website_assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('website_assets/vendor/sticky/sticky.js')}}"></script>
    <script src="{{ asset('website_assets/vendor/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{ asset('website_assets/js/main.min.js')}}"></script>
</body>

</html>