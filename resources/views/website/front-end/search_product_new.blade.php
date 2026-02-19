 @extends('app_template')
 @section('title', 'OXYGEN')
 @section('content')
     {{-- @include('website.front-end.newhead') --}}
     {{-- @include('website.partials.js.frontendjs') --}}
     {{-- @include('paritials.js.userwebsite.cart_js') --}}
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
             0% {
                 transform: rotate(0deg);
             }

             100% {
                 transform: rotate(360deg);
             }
         }
     </style>

     <body style="background-color:#F0F0F0" class="theme-color-29">
         <div class="page-content" style="margin:0px 40px">

             <div id="loading-container">
                 <div class="loader"></div>
             </div>

             {{-- @include('paritials.website.menu') --}}

             <div class="title1 section-t-space pt-5">
                 <h4 class="title-inner1 text-left">Search Results for "{{ $keyword }}"</h4>
             </div>

             <section style="background-color:#f7f1f2" class="pt-0 section-b-space ratio_asos">
                 <div class="container-fuild"  style="background-color:#FFF; padding:0px 20px;">
                     <div class="row game-product grid-products px-5">
                         @if (($products ?? collect())->count() === 0)
                             <div class="col-12 pt-4 pb-4">
                                 <h5>No products found.</h5>
                             </div>
                         @endif

                         @foreach ($products as $product)
                             <div class="gallery_product product-box col-xl-2 col-lg-3 col-sm-4 col-6 default">
                                 @include('frontend/product-card', ['product' => $product])

                             </div>
                         @endforeach
                     </div>
                 </div>
             </section>
         </div>

         <script>
             document.addEventListener("DOMContentLoaded", function() {
                 function showLoader() {
                     document.getElementById("loading-container").style.display = "block";
                 }

                 function hideLoader() {
                     document.getElementById("loading-container").style.display = "none";
                 }

                 window.addEventListener("beforeunload", showLoader);
                 window.addEventListener("load", hideLoader);
             });

             $(document).ready(function() {
                 var pincode = ('{{ session()->get('pincode') }}' || '').trim();
                 if (!/^\d{6}$/.test(pincode) && typeof window.showPicodePopup === 'function') {
                     setTimeout(function() {
                         window.showPicodePopup();
                     }, 400);
                 }
             });
         </script>

         {{-- @include('website.front-end.newfooter') --}}
     </body>
 @endsection
