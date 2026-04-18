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

         .product-price-home {
             font-family: monospace;
             font-size: 1.6rem;
             font-weight: 600;
             color: #333;
         }

         .product-price-discount {
             text-decoration: line-through;
             color: #999;
             font-size: 1.3rem;
             margin-left: 5px;
         }

         .product-offer-percentage {
             color: #2ecc71;
             font-weight: 600;
             font-size: 1.3rem;
             margin-left: 5px;
         }

         .product-pa-wrapper {
             display: flex;
             align-items: center;
             justify-content: center;
             flex-wrap: wrap;
             margin-top: 5px;
         }
     </style>

     <body class="theme-color-29">
         <main class="main" style="background-color: #fff;">
         <div class="page-content mb-10">

             <div id="loading-container">
                 <div class="loader"></div>
             </div>

             <div class="container">
                 <div class="title-link-wrapper mt-6 mb-3">
                     <h2 class="title">Search Results for "{{ $keyword }}"</h2>
                     <a href="{{ url('shops') }}" class="mb-0">More Products<i class="w-icon-long-arrow-right"></i></a>
                 </div>

                 <div class="row banner-product-wrapper mb-6">
                     @if (($products ?? collect())->count() === 0)
                         <div class="col-12 pt-4 pb-4">
                             <h5>No products found.</h5>
                         </div>
                     @endif

                     @foreach ($products as $product)
                         <div class="grid-item col-xl-6col col-lg-2 col-sm-4 col-6 mb-4">
                             @include('frontend/product-card', ['product' => $product])
                         </div>
                     @endforeach
                 </div>
             </div>
         </div>
         </main>

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
