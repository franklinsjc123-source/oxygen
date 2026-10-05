 @extends('app_template')
 @section('title',' Offer Products')
 @section('content')

 
  <!-- Start of Main -->
        <main class="main">
            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb bb-no">

                        <li><a href="{{ url('home')}}">Home</a></li>
                        <li><a href="{{ url( 'offers' ) }}"> Offers </a> </li>

                        <?php if($offer_name != ''){  ?>
                            <li><a href="{{ url( 'vendor-offer-products/'.$vendor_id . '?' . request()->getQueryString() ) }}"> <?= $offer_name ?> </a> </li>
                        <?php  } else {  ?>
                            <li><a href="{{ url( 'offers') }}"> All </a> </li>
                        <?php } ?>

                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->

            <!-- Start of Page Content -->
            <div class="page-content">
                <div class="container">

                 

                     <div class="page-content mb-8 mt-5">
                        <div class="container">
                            <div class="shop-content row gutter-lg mb-10">
                                @php
                                    $colours = \Illuminate\Support\Facades\DB::table('products_details')
                                            ->select('color', \Illuminate\Support\Facades\DB::raw('COUNT(products_id) as count'))
                                            ->whereNotNull('color')
                                            ->groupBy('color')
                                            ->get();

                                    $sizes = \Illuminate\Support\Facades\DB::table('products_details')
                                            ->whereNotNull('size')
                                            ->pluck('size')->unique()->toArray();

                                    $offerTypes = \App\Models\Master\Offers\Offers::all();
                                    $offer = \App\Models\Master\Offers\Offers::all();
                                    // Helper for colors
                                    $colorMap = [
                                        'multi' => 'linear-gradient(to right, red, orange, yellow, green, blue, indigo, violet)',
                                        'multicolor' => 'linear-gradient(to right, red, orange, yellow, green, blue, indigo, violet)',
                                        'multicolour' => 'linear-gradient(to right, red, orange, yellow, green, blue, indigo, violet)',
                                        'silver' => '#C0C0C0', 'gold' => '#FFD700', 'maroon' => '#800000',
                                        'navy' => '#000080', 'olive' => '#808000', 'teal' => '#008080',
                                        'magenta' => '#FF00FF', 'cyan' => '#00FFFF', 'brown' => '#A52A2A',
                                        'beige' => '#F5F5DC', 'peach' => '#FFDAB9', 'mint' => '#98FF98',
                                        'lavender' => '#E6E6FA', 'coral' => '#FF7F50', 'mustard' => '#FFDB58',
                                        'salmon' => '#FA8072', 'rust' => '#B7410E', 'wine' => '#722F37',
                                        'plum' => '#8E4585', 'khaki' => '#F0E68C', 'turquoise' => '#40E0D0',
                                        'grey' => '#808080', 'cream' => '#FFFDD0', 'copper' => '#B87333',
                                        'bronze' => '#CD7F32', 'charcoal' => '#36454F', 'magenta' => '#FF00FF'
                                    ];
                                @endphp
                                @include('frontend/vendor-offer-sidebar')
                                <div class="main-content">
                            <div class="toolbox vendor-toolbox pb-0">
                            
                                <div class="toolbox-left mb-4 mb-md-0">
                                    {{-- <a href="#" class="btn btn-primary btn-outline btn-rounded btn-icon-left "><i class="w-icon-category"></i>VENDORS</a> --}}
                                    {{-- <label class="d-block">Total Store Showing 6</label> --}}
                                </div>
                               
                            </div>
                            <div class="vendor-search-wrapper">
                                <form class="vendor-search-form">
                                    <input type="email" class="form-control mr-4 bg-white" name="vendor" id="vendor"
                                        placeholder="Search Vendors" />
                                    <button class="btn btn-primary btn-rounded" type="submit">Apply</button>
                                </form>
                            </div>

                              <div class="product-wrapper row cols-md-6 cols-sm-2 cols-2"  id="productslist">
                                 @if(count($prouctsList) > 0)
                                     @foreach($prouctsList as $product)
                                         @include('frontend/product-card', ['product' => $product, 'showStockCount' => false])
                                     @endforeach
                                  @endif
                           
                              </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

 @endsection