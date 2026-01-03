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
    <style>
body {font-family: Arial, Helvetica, sans-serif;}

/* The Modal (background) */
.modal {
  display: none; /* Hidden by default */
  position: fixed; /* Stay in place */
  z-index: 1; /* Sit on top */
  padding-top: 100px; /* Location of the box */
  left: 0;
  top: 0;
  width: 100%; /* Full width */
  height: 100%; /* Full height */
  overflow: auto; /* Enable scroll if needed */
  background-color: rgb(0,0,0); /* Fallback color */
  background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
  position: relative;
  background-color: #fefefe;
  margin: auto;
  padding: 0;
  border: 1px solid #888;
  width: 80%;
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
  -webkit-animation-name: animatetop;
  -webkit-animation-duration: 0.4s;
  animation-name: animatetop;
  animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
  from {top:-300px; opacity:0} 
  to {top:0; opacity:1}
}

@keyframes animatetop {
  from {top:-300px; opacity:0}
  to {top:0; opacity:1}
}

/* The Close Button */
.close {
  color: white;
  float: right;
  font-size: 28px;
  font-weight: bold;
}

.close:hover,
.close:focus {
  color: #000;
  text-decoration: none;
  cursor: pointer;
}

.modal-header {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}

.modal-body {padding: 2px 16px;}

.modal-footer {
  padding: 2px 16px;
  background-color: #5cb85c;
  color: white;
}
</style>
</head>

<body>
    <div class="page-wrapper">
       
        <!-- Start of Header -->
         @include('front_end.common.header')
        <!-- End of Header -->

        <main class="main">
           

         

            <!-- Start of PageContent -->
            <div class="page-content">
                <div class="container">
                    <div class="tab tab-vertical row gutter-lg">
                         <h2>Auction Products</h2><br>
                            
                    <div class="product-wrapper row cols-xl-2 cols-sm-1 cols-xs-2 cols-1">
                    @foreach ($getauctionProduct as $similarProducts)
                                    @php
                                        $ImgaeOfProduct = isset($similarProducts) ? json_decode($similarProducts->productdetails->product_detail_image) ?? null : null;
                                    @endphp
                                <div class="product product-list">
                                    <figure class="product-media">
                                        <a href="product-default.html">
                                            <img src="{{ asset('assets/images/products/detail') . '/' . $ImgaeOfProduct[0] }}" alt="Product" width="330"
                                                height="338" />
                                            <img src="{{ asset('assets/images/products/detail') . '/' . $ImgaeOfProduct[0] }}" alt="Product" width="330"
                                                height="338" />
                                        </a>
                                        <div class="product-action-vertical">
                                            <a href="#" class="btn-product-icon btn-quickview w-icon-search"
                                                title="Quick View"></a>
                                        </div>
                                        <div class="product-countdown-container">
                                            <div class="product-countdown countdown-compact" data-until="2021, 9, 9"
                                                data-format="DHMS" data-compact="false"
                                                data-labels-short="Days, Hours, Mins, Secs">
                                                00:02:01:00</div>
                                        </div>
                                    </figure>
                                    <div class="product-details">
                                        <div class="product-cat">
                                            <a href="shop-banner-sidebar.html">Collections</a>
                                        </div>
                                        <h4 class="product-name">
                                            <a href="product-default.html">Tops & Chudis</a>
                                        </h4>
                                        <div class="ratings-container">
                                            <div class="ratings-full">
                                                <span class="ratings" style="width: 100%;"></span>
                                                <span class="tooltiptext tooltip-top"></span>
                                            </div>
                                            <a href="product-default.html" class="rating-reviews">(3 Reviews)</a>
                                        </div>
                                        <div class="product-price">
                                            <ins class="new-price">₹{{ $similarProducts->start_price }}</ins><del class="old-price">₹{{ $similarProducts->productdetails->selling_price }}</del>
                                        </div>
                                        <div class="product-desc">
                                            Ultrices eros in cursus turpis massa cursus mattis. Volutpat ac tincidunt
                                            vitae semper quis lectus. Aliquam id diam maecenas ultricies…
                                        </div>
                                        <div class="product-action">
                                            <a href="#" class="btn-product btn-cart" title="Add to Cart"><i
                                                    class="w-icon-cart"></i> Bid Amount</a>
                                                   <button id="myBtn">Open Modal</button>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                       
                    </div>
                </div>
            </div>
            <!-- End of PageContent -->
        </main>
        <!-- End of Main -->
        <!-- Start of Footer -->
         @include('front_end.common.footer')
       

<!-- The Modal -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close">&times;</span>
      <h2>Modal Header</h2>
    </div>
    <div class="modal-body">
      <p>Some text in the Modal Body</p>
      <p>Some other text...</p>
    </div>
    <div class="modal-footer">
      <h3>Modal Footer</h3>
    </div>
  </div>

</div>
         <script src="assets/vendor/jquery/jquery.min.js"></script>
    <script src="assets/vendor/sticky/sticky.js"></script>
    <script src="assets/vendor//jquery.plugin/jquery.plugin.min.js"></script>
    <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
    <script src="assets/vendor/nouislider/nouislider.min.js"></script>
    <script src="assets/vendor/jquery.countdown/jquery.countdown.min.js"></script>
    <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
    <script src="assets/vendor/zoom/jquery.zoom.js"></script>
    <script src="assets/vendor/magnific-popup/jquery.magnific-popup.min.js"></script>

    <!-- Main JS -->
    <script src="assets/js/main.min.js"></script>
    
<script>
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

</body>

</html>