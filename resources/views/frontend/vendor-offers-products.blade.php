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
                                    $productIds = collect($prouctsList)->pluck('id')->toArray();

                                    $allDetails = \Illuminate\Support\Facades\DB::table('products_details')
                                            ->whereIn('products_id', $productIds)
                                            ->get();

                                    $coloursArray = [];
                                    $sizesArray = [];
                                    foreach($allDetails as $detail) {
                                        $c = $detail->color;
                                        if(!$c) {
                                            if($detail->attributename1 == 'Color') $c = $detail->attributevalue1;
                                            elseif($detail->attributename2 == 'Color') $c = $detail->attributevalue2;
                                            elseif($detail->attributename3 == 'Color') $c = $detail->attributevalue3;
                                        }
                                        if($c && $c != '') {
                                            if(!isset($coloursArray[$c])) $coloursArray[$c] = [];
                                            $coloursArray[$c][] = $detail->products_id;
                                        }

                                        $s = $detail->size;
                                        if(!$s) {
                                            if(str_contains(strtolower($detail->attributename1 ?? ''), 'size')) $s = $detail->attributevalue1;
                                            elseif(str_contains(strtolower($detail->attributename2 ?? ''), 'size')) $s = $detail->attributevalue2;
                                            elseif(str_contains(strtolower($detail->attributename3 ?? ''), 'size')) $s = $detail->attributevalue3;
                                        }
                                        if($s && $s != '' && strtoupper($s) != 'NA') {
                                            $sizesArray[] = $s;
                                        }
                                    }

                                    $colours = [];
                                    foreach($coloursArray as $c => $pIds) {
                                        $colours[] = (object)['color' => $c, 'count' => count(array_unique($pIds))];
                                    }
                                    $sizes = array_unique($sizesArray);

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

                              <div class="product-wrapper row cols-xl-5 cols-lg-5 cols-md-4 cols-sm-3 cols-2"  id="productslist">
                                 @if(count($prouctsList) > 0)
                                      @foreach($prouctsList as $product)
                                          @php
                                              $p_id = is_array($product) ? $product['id'] : $product->id;
                                              $details = \Illuminate\Support\Facades\DB::table('products_details')->where('products_id', $p_id)->get();
                                              $c_list = []; $s_list = [];
                                              foreach($details as $d) {
                                                  $c = $d->color;
                                                  if(!$c) {
                                                      if($d->attributename1 == 'Color') $c = $d->attributevalue1;
                                                      elseif($d->attributename2 == 'Color') $c = $d->attributevalue2;
                                                      elseif($d->attributename3 == 'Color') $c = $d->attributevalue3;
                                                  }
                                                  if($c && $c != '') $c_list[] = $c;

                                                  $s = $d->size;
                                                  if(!$s) {
                                                      if(str_contains(strtolower($d->attributename1 ?? ''), 'size')) $s = $d->attributevalue1;
                                                      elseif(str_contains(strtolower($d->attributename2 ?? ''), 'size')) $s = $d->attributevalue2;
                                                      elseif(str_contains(strtolower($d->attributename3 ?? ''), 'size')) $s = $d->attributevalue3;
                                                  }
                                                  if($s && $s != '' && strtoupper($s) != 'NA') $s_list[] = $s;
                                              }
                                              $p_colors = implode(',', array_unique($c_list));
                                              $p_sizes = implode(',', array_unique($s_list));
                                              $p_price = collect($product)->get('selling_price') ?? 0;
                                              $p_rating = collect($product)->get('avg_rating') ?? (collect($product)->get('rating_percent') ? collect($product)->get('rating_percent') / 20 : 0);
                                          @endphp
                                          <span class="product-filter-data" style="display:none;" 
                                               data-price="{{ (float)$p_price }}" 
                                               data-colors="{{ strtolower($p_colors) }}"
                                               data-sizes="{{ strtolower($p_sizes) }}"
                                               data-rating="{{ (float)$p_rating }}"></span>
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