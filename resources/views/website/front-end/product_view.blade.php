 
 @include('website.front-end.newhead')
 
 {{-- @include('website.front-end.newheader') --}}
    <!-- header end -->


    @include('website.partials.js.frontendjs')
    @include('paritials.js.userwebsite.cart_js')
    @include('website.partials.css.frontendcss');
    @include('paritials.website.header')

    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <style>
        .rate {
            float: left;
            height: 46px;
            padding: 0 10px;
            }
            .rate:not(:checked) > input {
            position:absolute;
            display: none;
            }
            .rate:not(:checked) > label {
            float:right;
            width:1em;
            overflow:hidden;
            white-space:nowrap;
            cursor:pointer;
            font-size:30px;
            color:#ccc;
            }
            .rated:not(:checked) > label {
            float:right;
            width:1em;
            overflow:hidden;
            white-space:nowrap;
            cursor:pointer;
            font-size:30px;
            color:#ccc;
            }
            .rate:not(:checked) > label:before {
            content: '★ ';
            }
            .rate > input:checked ~ label {
            color: #ffc700;
            }
            .rate:not(:checked) > label:hover,
            .rate:not(:checked) > label:hover ~ label {
            color: #deb217;
            }
            .rate > input:checked + label:hover,
            .rate > input:checked + label:hover ~ label,
            .rate > input:checked ~ label:hover,
            .rate > input:checked ~ label:hover ~ label,
            .rate > label:hover ~ input:checked ~ label {
            color: #c59b08;
            }
            .star-rating-complete{
               color: #c59b08;
            }
            .rating-container .form-control:hover, .rating-container .form-control:focus{
            background: #fff;
            border: 1px solid #ced4da;
            }
            .rating-container textarea:focus, .rating-container input:focus {
            color: #000;
            }
            .rated {
            float: left;
            height: 46px;
            padding: 0 10px;
            }
            .rated:not(:checked) > input {
            position:absolute;
            display: none;
            }
            .rated:not(:checked) > label {
            float:right;
            width:1em;
            overflow:hidden;
            white-space:nowrap;
            cursor:pointer;
            font-size:30px;
            color:#ffc700;
            }
            .rated:not(:checked) > label:before {
            content: '★ ';
            }
            .rated > input:checked ~ label {
            color: #ffc700;
            }
            .rated:not(:checked) > label:hover,
            .rated:not(:checked) > label:hover ~ label {
            color: #deb217;
            }
            .rated > input:checked + label:hover,
            .rated > input:checked + label:hover ~ label,
            .rated > input:checked ~ label:hover,
            .rated > input:checked ~ label:hover ~ label,
            .rated > label:hover ~ input:checked ~ label {
            color: #c59b08;
            }

            /* .product-slick:hover {

            transform: scale(1.5); 

            } */
            figure.zoom {
            background-position: 50% 50%;
            position: relative;
            width: 500px;
            overflow: hidden;
            cursor: zoom-in;
            }
            figure.zoom img:hover {
            opacity: 0;
            }
            figure.zoom img {
            transition: opacity 0.5s;
            display: block;
            width: 100%;
            }
            .img {
            float: left;
            width:  100px;
            height: 100px;
            background-size: cover;
           }
             .bg-light0 {
            padding: 10px;
            margin: 5px;
            background-color:lightgreen;
            border-radius: 5px;
            cursor: pointer;
            transition: filter 0.5s;
            }

            .bg-light0.active {
            /*filter: blur(0);*/
            border: 2px solid #007bff;
            }

            .bg-light0.inactive {
            /*filter: blur(1px);*/
            border= '';
            }
            .bg-light0:not(.active) {
            /*filter: blur(1px);*/
            /*border= none;*/
            }  
            .bg-light0.selected {
            border: 2px solid #007bff;
            }
            /*.active {*/
            /*border: 2px solid #007bff;*/
            /*}*/
            /*.inactive {*/
            /* border: '';*/
            /*}*/
            
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

<style>
    .licolor {
        opacity: 0.5; /* Initial opacity for all colors */
        transition: opacity 0.5s ease; /* Add a transition for smooth fading */
    }

    .licolor.active {
        opacity: 1; /* Active size colors have full opacity */
    }
</style>
    <!-- section start -->
    {{-- @dd($product[0]->offers); --}}
    <?php
    
  //dd($product_det);
    // exit();
    ?>
    
    <section>
        <div id="loading-container">
        <div class="loader"></div>
        </div>
        <div class="collection-wrapper" style="marigin-top:150px;">
            <div class="container">
                <div class="row">
                    <div class="col-sm-3 collection-filter" style="marigin-top:150px;">
                     <div class="collection-filter-block">
                            <div class="collection-mobile-back">
                                <span class="filter-back">
                                    <i class="fa fa-angle-left" aria-hidden="true"></i>
                                    back
                                </span>
                            </div>
                            <div class="collection-collapse-block border-0 open">
                                <h3 class="collapse-block-title">brand</h3>
                                <div class="collection-collapse-block-content">
                                    <div class="collection-brand-filter">
                                        <ul class="category-list">
                                             @foreach ($categorymain as $categorymain1)
                                                
                                                <li><a href="{{ url( 'MainCatergoryproductshow/'.$categorymain1->id ) }}">{{ $categorymain1->category_main_name }}</a></li>
                                                
                                             @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="collection-filter-block">
                            <div class="product-service">
                                <div class="media">
                                    <!--<svg>-->
                                    <!--    <use xlink:href="../assets/svg/icons.svg#returnable"></use>-->
                                    <!--</svg>-->
                                    <!--<div class="media-body">-->
                                    <!--    <h4>10 days returnable</h4>-->
                                    <!--    <p>easy returnable policies</p>-->
                                    <!--</div>-->
                                </div>
                                <div class="media">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" id="Capa_1" x="0px" y="0px" viewBox="0 0 480 480"
                                        style="enable-background:new 0 0 480 480;" xml:space="preserve" width="512px"
                                        height="512px">
                                        <g>
                                            <g>
                                                <g>
                                                    <path
                                                        d="M472,432h-24V280c-0.003-4.418-3.588-7.997-8.006-7.994c-2.607,0.002-5.05,1.274-6.546,3.41l-112,160     c-2.532,3.621-1.649,8.609,1.972,11.14c1.343,0.939,2.941,1.443,4.58,1.444h104v24c0,4.418,3.582,8,8,8s8-3.582,8-8v-24h24     c4.418,0,8-3.582,8-8S476.418,432,472,432z M432,432h-88.64L432,305.376V432z"
                                                        fill="#ff4c3b" />
                                                    <path
                                                        d="M328,464h-94.712l88.056-103.688c0.2-0.238,0.387-0.486,0.56-0.744c16.566-24.518,11.048-57.713-12.56-75.552     c-28.705-20.625-68.695-14.074-89.319,14.631C212.204,309.532,207.998,322.597,208,336c0,4.418,3.582,8,8,8s8-3.582,8-8     c-0.003-26.51,21.486-48.002,47.995-48.005c10.048-0.001,19.843,3.151,28.005,9.013c16.537,12.671,20.388,36.007,8.8,53.32     l-98.896,116.496c-2.859,3.369-2.445,8.417,0.924,11.276c1.445,1.226,3.277,1.899,5.172,1.9h112c4.418,0,8-3.582,8-8     S332.418,464,328,464z"
                                                        fill="#ff4c3b" />
                                                    <path
                                                        d="M216.176,424.152c0.167-4.415-3.278-8.129-7.693-8.296c-0.001,0-0.002,0-0.003,0     C104.11,411.982,20.341,328.363,16.28,224H48c4.418,0,8-3.582,8-8s-3.582-8-8-8H16.28C20.283,103.821,103.82,20.287,208,16.288     V40c0,4.418,3.582,8,8,8s8-3.582,8-8V16.288c102.754,3.974,185.686,85.34,191.616,188l-31.2-31.2     c-3.178-3.07-8.242-2.982-11.312,0.196c-2.994,3.1-2.994,8.015,0,11.116l44.656,44.656c0.841,1.018,1.925,1.807,3.152,2.296     c0.313,0.094,0.631,0.172,0.952,0.232c0.549,0.198,1.117,0.335,1.696,0.408c0.08,0,0.152,0,0.232,0c0.08,0,0.152,0,0.224,0     c0.609-0.046,1.211-0.164,1.792-0.352c0.329-0.04,0.655-0.101,0.976-0.184c1.083-0.385,2.069-1.002,2.888-1.808l45.264-45.248     c3.069-3.178,2.982-8.242-0.196-11.312c-3.1-2.994-8.015-2.994-11.116,0l-31.976,31.952     C425.933,90.37,331.38,0.281,216.568,0.112C216.368,0.104,216.2,0,216,0s-0.368,0.104-0.568,0.112     C96.582,0.275,0.275,96.582,0.112,215.432C0.112,215.632,0,215.8,0,216s0.104,0.368,0.112,0.568     c0.199,115.917,91.939,210.97,207.776,215.28h0.296C212.483,431.847,216.013,428.448,216.176,424.152z"
                                                        fill="#ff4c3b" />
                                                    <path
                                                        d="M323.48,108.52c-3.124-3.123-8.188-3.123-11.312,0L226.2,194.48c-6.495-2.896-13.914-2.896-20.408,0l-40.704-40.704     c-3.178-3.069-8.243-2.981-11.312,0.197c-2.994,3.1-2.994,8.015,0,11.115l40.624,40.624c-5.704,11.94-0.648,26.244,11.293,31.947     c9.165,4.378,20.095,2.501,27.275-4.683c7.219-7.158,9.078-18.118,4.624-27.256l85.888-85.888     C326.603,116.708,326.603,111.644,323.48,108.52z M221.658,221.654c-0.001,0.001-0.001,0.001-0.002,0.002     c-3.164,3.025-8.148,3.025-11.312,0c-3.125-3.124-3.125-8.189-0.002-11.314c3.124-3.125,8.189-3.125,11.314-0.002     C224.781,213.464,224.781,218.53,221.658,221.654z"
                                                        fill="#ff4c3b" />
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                    <div class="media-body">
                                        <h4>24 X 7 service</h4>
                                        <p>easy and fast services</p>
                                    </div>
                                </div>
                                <div class="media">
                                    <!--<svg>-->
                                    <!--    <use xlink:href="../assets/svg/icons.svg#warranty"></use>-->
                                    <!--</svg>-->
                                    <!--<div class="media-body">-->
                                    <!--    <h4>1 Year Warranty</h4>-->
                                    <!--    <p>from the date of purchase</p>-->
                                    <!--</div>-->
                                </div>
                                <div class="media border-0 m-0">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512"
                                        style="enable-background:new 0 0 512 512;" xml:space="preserve" width="512px"
                                        height="512px">
                                        <g>
                                            <g>
                                                <g>
                                                    <path
                                                        d="M498.409,175.706L336.283,13.582c-8.752-8.751-20.423-13.571-32.865-13.571c-12.441,0-24.113,4.818-32.865,13.569     L13.571,270.563C4.82,279.315,0,290.985,0,303.427c0,12.442,4.82,24.114,13.571,32.864l19.992,19.992     c0.002,0.001,0.003,0.003,0.005,0.005c0.002,0.002,0.004,0.004,0.006,0.006l134.36,134.36H149.33     c-5.89,0-10.666,4.775-10.666,10.666c0,5.89,4.776,10.666,10.666,10.666h59.189c0.014,0,0.027,0.001,0.041,0.001     s0.027-0.001,0.041-0.001l154.053,0.002c5.89,0,10.666-4.776,10.666-10.666c0-5.891-4.776-10.666-10.666-10.666l-113.464-0.002     L498.41,241.434C516.53,223.312,516.53,193.826,498.409,175.706z M483.325,226.35L226.341,483.334     c-4.713,4.712-11.013,7.31-17.742,7.32h-0.081c-6.727-0.011-13.025-2.608-17.736-7.32L56.195,348.746L302.99,101.949     c4.165-4.165,4.165-10.919,0-15.084c-4.166-4.165-10.918-4.165-15.085,0.001L41.11,333.663l-12.456-12.456     c-4.721-4.721-7.321-11.035-7.321-17.779c0-6.744,2.6-13.059,7.322-17.781L285.637,28.665c4.722-4.721,11.037-7.321,17.781-7.321     c6.744,0,13.059,2.6,17.781,7.322l57.703,57.702l-246.798,246.8c-4.165,4.164-4.165,10.918,0,15.085     c2.083,2.082,4.813,3.123,7.542,3.123c2.729,0,5.459-1.042,7.542-3.124l246.798-246.799l89.339,89.336     C493.128,200.593,493.127,216.546,483.325,226.35z"
                                                        fill="#ff4c3b" />
                                                    <path
                                                        d="M262.801,308.064c-4.165-4.165-10.917-4.164-15.085,0l-83.934,83.933c-4.165,4.165-4.165,10.918,0,15.085     c2.083,2.083,4.813,3.124,7.542,3.124c2.729,0,5.459-1.042,7.542-3.124l83.934-83.933     C266.966,318.982,266.966,312.229,262.801,308.064z"
                                                        fill="#ff4c3b" />
                                                    <path
                                                        d="M228.375,387.741l-34.425,34.425c-4.165,4.165-4.165,10.919,0,15.085c2.083,2.082,4.813,3.124,7.542,3.124     c2.731,0,5.459-1.042,7.542-3.124l34.425-34.425c4.165-4.165,4.165-10.919,0-15.085     C239.294,383.575,232.543,383.575,228.375,387.741z"
                                                        fill="#ff4c3b" />
                                                    <path
                                                        d="M260.054,356.065l-4.525,4.524c-4.166,4.165-4.166,10.918-0.001,15.085c2.082,2.083,4.813,3.125,7.542,3.125     c2.729,0,5.459-1.042,7.541-3.125l4.525-4.524c4.166-4.165,4.166-10.918,0.001-15.084     C270.974,351.901,264.219,351.9,260.054,356.065z"
                                                        fill="#ff4c3b" />
                                                    <path
                                                        d="M407.073,163.793c-2-2-4.713-3.124-7.542-3.124c-2.829,0-5.541,1.124-7.542,3.124l-45.255,45.254     c-2,2.001-3.124,4.713-3.124,7.542s1.124,5.542,3.124,7.542l30.17,30.167c2.083,2.083,4.813,3.124,7.542,3.124     c2.731,0,5.459-1.042,7.542-3.124l45.253-45.252c4.165-4.165,4.165-10.919,0-15.084L407.073,163.793z M384.445,231.673     l-15.085-15.084l30.17-30.169l15.084,15.085L384.445,231.673z"
                                                        fill="#ff4c3b" />
                                                    <path
                                                        d="M320.339,80.186c2.731,0,5.461-1.042,7.543-3.126l4.525-4.527c4.164-4.166,4.163-10.92-0.003-15.084     c-4.165-4.164-10.92-4.163-15.084,0.003l-4.525,4.527c-4.164,4.166-4.163,10.92,0.003,15.084     C314.881,79.146,317.609,80.186,320.339,80.186z"
                                                        fill="#ff4c3b" />
                                                    <path
                                                        d="M107.215,358.057l-4.525,4.525c-4.165,4.164-4.165,10.918,0,15.085c2.083,2.082,4.813,3.123,7.542,3.123     s5.459-1.041,7.542-3.123l4.525-4.525c4.165-4.166,4.165-10.92,0-15.085C118.133,353.891,111.381,353.891,107.215,358.057z"
                                                        fill="#ff4c3b" />
                                                </g>
                                            </g>
                                        </g>
                                    </svg>
                                    <div class="media-body">
                                        <h4>online payment</h4>
                                        <p>Contrary to popular belief.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                     </div>
                <div class="col-lg-9 col-sm-12">

                     <div class="container-fluid p-0">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="filter-main-btn mb-2"><span class="filter-btn"><i class="fa fa-filter"
                                            aria-hidden="true"></i> Sidebar</span></div>
                            </div>
                        </div>
                      <div class="row">
                            <div class="col-lg-6">
                                <div class="product-slick">
                                    <?php 
                                    
                                    $product_detailsimage = json_decode($product_det[0]->product_detail_image);
                                    // 
                                    foreach ($product_detailsimage as $key => $value) {
                                        
                                        if(!empty($value))
                                        {
                                ?>
                                    <div id="slide1">
                                        <figure class="zoom" onmousemove="zoom(event)" style="background-image: url('{{ asset('assets/images/products/detail') . '/' . $value }}')">
                                        <img src="{{ asset('assets/images/products/detail') . '/' . $value }}" alt=""
                                            class="img-fluid blur-up lazyload image_zoom_cls-0" style="width:500px;height:600px;">
                                        </figure>
                                        </div>
                                    
                                    <?php
                                        
                                    }
                                }
                                        
                                    ?>
                                </div>
                                <div class="row">
                                    <div class="col-12 p-0">
                                        <div class="slider-nav">
                                            <?php 
                                    $product_detailsimage1 = json_decode($product_det[0]->product_detail_image);
                                    
                                    foreach ($product_detailsimage1 as $key1 => $value1) {
                                        if(!empty($value1))
                                        {
                                    ?>
                                            <div class ="img" id="slide">
                                            
                                                <img src="{{ asset('assets/images/products/detail') . '/' . $value1 }}" alt=""
                                                    class="img-fluid blur-up lazyload">
                                            
                                                </div>
                                        
                                            <?php
                                                }
                                                }
                                            ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-lg-6 rtl-text">
                                <div class="product-right">
                                    <form action="{{route('buynow')}}" method="post">
                                        @csrf
                                    
                                    <h2>{{ $product_det[0]->product_name }}</h2>
                                    <div class="rating-section">
                                        <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i>
                                        </div>
                                        <h6>120 ratings</h6>
                                    </div>
                                {{-- @dd($productdetailid); --}}
                                    <div class="label-section">
                                        <span class="badge badge-grey-color">#1 Best seller</span>
                                        {{-- <span class="label-text">in fashion</span> --}}
                                    <?php
                                        if(!empty($vendorname)){
                                        ?>
                                        <a href="{{ route('vendorallproduct', $productdetailid ) }}">{{$vendorname}}</a>
                                    <?php
                                    }
                                    ?>
                                    </div>
                                    @php
                                        $disc = $product_det[0]->retail_price -$product_det[0]->selling_price;
                                        $offerperc = $disc/$product_det[0]->retail_price *100;
                                    @endphp
                                <div id="price">
                                
                                    <h3 class="price-detail">Rs {{ $product_det[0]->selling_price }} <del>Rs {{ $product_det[0]->retail_price }}</del><span style="color:red;">({{round($offerperc)}}%Off)</span></h3>
                                    <input type="hidden"  id="product_price" name="product_price" class="form-control input-number" value="{{ $product_det[0]->selling_price }}">
                                </div>
                                
                                        <ul class="color-variant">
                                            <?php
                                    
                                            use App\Models\Products\ProductsDetails;
                                            use App\Models\Products\Products;
                                        
                                            $colorsize_id = $product_det[0]->products_id;
                                            // dd($colorsize_id);

                                            $productcolorsize = ProductsDetails::where('products_id',$colorsize_id)->get();
                                            //   print_r($productcolorsize);


                                            //   exit;
                                            //   $i = 0;
                                            $clr =array('');
                                            ?>
                                            {{-- @dd($productcolorsize); --}}
                                            <div class="form-control" id="div2">
                                            @foreach ($productcolorsize as $item)
                                                    <?php
                                                    $color1=$item->color;
                                                    
                                                    if(!in_array($color1,$clr))
                                                    {
                                                        ?>
                                                    <li  style="color:{{ $item->color }}; background-color:{{ $item->color }};" id ="bg-light0{{ $item->id }}" class="licolor bg-light0" value="{{ $item->id }}">
                                                        
                                                      <!--{{ $item->color }}-->
                                                    
                                                    </li>
                                                    <input type="hidden" name="product_color{{ $item->id }}" id="product_color{{ $item->id }}" value="{{$item->color}}" />
                                                    
                                                    <?php array_push($clr,$color1); 
                                                    } ?>
                                            @endforeach
                                            </div>
                                        
                                        </ul>
                                    <div id="selectSize" class="addeffect-section product-description border-product">
                                        <h6 class="product-title size-text">select size <span><a href="" data-bs-toggle="modal"
                                                    data-bs-target="#sizemodal">size
                                                    chart</a></span></h6>
                                        <div class="modal fade" id="sizemodal" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Sheer
                                                            Straight Kurta</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                    </div>
                                                    <div class="modal-body"><img src="../assets/images/size-chart.jpg" alt=""
                                                            class="img-fluid blur-up lazyload"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <h6 class="error-message">please select size</h6>
                                        <span id ="spn1"></span>
                                        <div class="size-box">
                                        {{-- <div> --}}
                                        
                                            <ul id="clsize">
                                            <?php
                                    
                                                
                                                $colorsize_id = $product_det[0]->products_id;
                                                //dd($colorsize_id);
            
                                                $productcolorsize1 = ProductsDetails::where('products_id',$colorsize_id)->get();
                                               // dd($productcolorsize1);
                                                $siz =array('');
                                                ?>
                                                
                                                @foreach ($productcolorsize1 as $item)
                                                
                                                <?php
                                                $size1 = $item->size;
                                                // print_r($size1);
                                                if(!in_array($size1,$siz))
                                                {
                                                    
                                                ?>
                                        
                                                <li id = "size{{ $item->id }}" class ="size" value="{{ $item->id }}">
                                                <a href="javascript:void(0)">{{$item->size}}</a></li>
                                                <input type="hidden" id="sizee{{ $item->id }}" name="sizee{{ $item->id }}" value="{{ $item->size }}">
            
                                                </li>
                                                <?php array_push($siz,$size1); 
                                                } ?>
                                                
                                                
                                                @endforeach
                                            </ul>
                                        </div>
                                        
                                        <h6 class="product-title">quantity</h6>
                                        
                                        <div class="qty-box">
                                            <div class="input-group"><span class="input-group-prepend"><button type="button"
                                                        class="btn quantity-left-minus" data-type="minus" data-field=""><i
                                                            class="ti-angle-left"></i></button> </span>
                                                <input type="text"  id="quantity" name="quantity" class="form-control input-number" value="1">
                                                <span class="input-group-prepend"><button type="button"
                                                        class="btn quantity-right-plus" data-type="plus" data-field=""><i
                                                            class="ti-angle-right"></i></button></span>
                                            </div>
                                        </div>
                                        <?php
                                    if($productdetailid !=null)

                                        {
                                            
                                            $product = App\Models\Products\Products::where('id',$productdetailid)->get();
                                            $offers = App\Models\Offer\Offer::where('id',$product[0]->offers)->get();
                                            
                                            $selprice = $product_det[0]->selling_price;
                                            if( $offers->isEmpty())
                                            {
                                                
                                                $offertitle = " ";
                                            }
                                            else{
                                                $offertitle = $offers[0]->title;
                                            }
                                        }
                                        else{
                                            
                                            $offertitle = " ";
                                        }
                                        
                                        if( $offers->isEmpty())
                                            {
                                                $amt = $selprice;
                                                ?>


                                                <h6 class="product-title">Total Price</h6>
                                                    <h3 id="h3"> Rs {{ $amt }}
                                                        <input type="hidden"  id="product_price1" name="product_price1" class="form-control input-number" value="{{ $amt }}">
                                                        
                                                    </h3>
                                                    <div class="product-form-group"><br>
                                                        <div class="row" style="display:none;" id="addcart2_{{$product_det[0]->id}}">
                                                            <div class="col-md-4">
                                                                <div class="input-group">
                                                                    <span class="input-group-btn">
                                                                        <button type="button" class="btn btn-danger btn-number" data-type="minus" data-field="quant[2]" onclick="addqnty('{{$product_det[0]->id}}','Minus')">
                                                                            <span class="fa fa-minus"></span>
                                                                        </button>
                                                                    </span>
                                                                    <input type="text" name="quant[2]" id="quantity{{$product_det[0]->id}}" value="0" class="form-control input-number" min="1" max="100" readonly>
                                                                    <span class="input-group-btn">
                                                                        <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]" onclick="addqnty('{{$product_det[0]->id}}','Add')">
                                                                            <span class="fa fa-plus"></span>
                                                                        </button>
                                                                    </span>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4 ">
                                                                <a href="{{ url('/Shopping-cart')}}" class="buttons"><button type="button" class="btn add-to-cart-btn">&nbsp; <i class="biolife-icon icon-cart"></i> &nbsp; BUY NOW</button></a>
                    
                                                            </div>
                                                        </div>
                                                        @if($product_det[0]->quantity>0)
                                                        @else
                                                        @endif
                                                    </div>
                                                <div class="product-buttons">
                                                    <a href="" id="cartbook" 
                                                    class="btn btn-solid hover-solid btn-animation"><i class=""
                                                        aria-hidden="true"></i> Buy Now</a>
                                                    <a href="" id="cartEffect" 
                                                        class="btn btn-solid hover-solid btn-animation"><i class="fa fa-shopping-cart me-1"
                                                            aria-hidden="true"></i> add to cart</a>
                                                
                                                </div>
                    
                                                <div class="product-count" style="display:none;">
                                                    <ul>
                                                        <li>
                                                            <img src="../assets/images/icon/truck.png" class="img-fluid" alt="image">
                                                            <span class="lang">Free shipping for orders above $500 USD</span>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="border-product" style="display:none;">
                                                    <h6 class="product-title">Sales Ends In</h6>
                                                    <div class="timer">
                                                        <p id="demo"></p>
                                                    </div>
                                                </div>
                                                <div class="border-product">
                                                    <h6 class="product-title">shipping info</h6>
                                                    <ul class="shipping-info">
                                                        <li>100% Original Products</li>
                                                        <li>Free Delivery on order above Rs. 799</li>
                                                        <li>Pay on delivery is available</li>
                                                        <li>Easy 30 days returns and exchanges</li>
                                                    </ul>
                                                </div>
                                                <div class="border-product">
                                                    <h6 class="product-title">share it</h6>
                                                    <div class="product-icon">
                                                        <ul class="product-social">
                                                            <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                                        <li><a href="#"><i class="fa fa-whatsapp"></i></a></li>
                                                            <!--<li><a href="#"><i class="fa fa-twitter"></i></a></li>-->
                                                            <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                                            
                                                        </ul>
                                                    </div>
                                                </div>


                                               
                                            <?php        
                                            }
                                            else{       
                                            if($offers[0]->type == 'Fixed Discount'){
                                                    if($offers[0]->discount_type == 'Percentage')
                                                    {
                                                        $dis = $selprice * $offers[0]->value/100;
                                                        $amt = $selprice - $dis;
                                                    }
                                                    else if($offers[0]->discount_type == 'Fixed') {
                                                        $amt = $selprice - $offers[0]->value;
                                                    }
                                                
                                                    ?>

                                                    <h6 class="product-title">Total Price</h6>
                                                    <h3 id="h3"><del>Rs {{ $product_det[0]->selling_price }}</del> Rs {{ $amt }}
                                                        <input type="hidden"  id="product_price1" name="product_price1" class="form-control input-number" value="{{ $amt }}">
                                                        <input type="hidden"  id="fixeddiscount" name="fixeddiscount" class="form-control input-number" value="fixeddiscount">
                                                    </h3>
                                            
                                            <?php
                                            
                                                }
                                            ?>
                                                <?php
                                                ?>
                                        
                                            <?php
                                            
                                            ?>
                                        <h6 class="product-title">Available Offers</h6>
                                    
                                        <li>{{ $offertitle }}</li>
                                        
                                        {{-- <h5 class="price-detail"> {{ $offers[0]->title }}</h5> --}}
                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                                            {{-- {{ $offers[0]->title }} --}}
                                            Similar Offer Products
                                        </button>
                                        <!-- Button trigger modal -->
        
                                            <!-- Modal -->
                                            <div class="modal fade bd-example-modal-lg" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Offer Products</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <section class="pt-0 section-b-space ratio_asos">
                                                            <div class="container-fuild">
                                                                <div class="row game-product grid-products px-5">
                                                    
                                                                    
                                                                        <?php
                                                                        //  dd($productdetailid);
                                                                        $product = App\Models\Products\Products::where('id',$productdetailid)->get();
                                                                        //dd($product);
                                                                        $products_Ids = Products::where('offers', $product[0]->offers)->get();
                                                                       
                                                                         $offs = App\Models\Offer\Offer::where('id',$products_Ids[0]->offers)->where('status',1)->get();
                                                                         foreach($offs as $off)
                                                                            {
                                                                            $off1 = DB::table('products')
                                                                                    ->select('products.*', 'master_offers.*')
                                                                                    ->join('master_offers', 'products.offers', '=', 'master_offers.id')
                                                                                    ->where('products.offers', $product[0]->offers)
                                                                                    ->when($off->buy, function ($query) use ($off) {
                                                                                        $query->where('master_offers.buy', $off->buy)
                                                                                            ->where('master_offers.getoffer', $off->getoffer);
                                                                                    }, function ($query) use ($off) {
                                                                                        $query->where('master_offers.buyproduct', $off->buyproduct)
                                                                                            ->where('master_offers.getamt', $off->getamt);
                                                                                    })
                                                                                    ->where('master_offers.status', 1)
                                                                                    ->get();
                                                                            }

                                                                        // dd($off1);
                                                                        foreach($off1 as $products_Id)
                                                                        {
                                                                    
                                                                        ?>
                                                                        <div class="product-box col-xl-2 col-lg-3 col-sm-4 col-6">
                                                                                <div class="img-wrapper">
                                                                                    <div class="front">
                                                                                            
                                                                                        <div class="img">
                                                                                            <a href="{{ route('addtocart', $products_Id->id ) }}"><img
                                                                                                src="{{ asset('assets/images/products/') . '/' . $products_Id->product_image  }}"
                                                                                                class="img-fluid blur-up lazyload" alt=""></a>
                                                                                        </div>
                                                                                        
                                                                                    </div>
                                                                                    <div class="cart-info cart-wrap">
                                                                                        <a href="javascript:void(0)" title="Add to Wishlist" tabindex="0"><i
                                                                                                class="ti-heart" aria-hidden="true"></i></a>
                                                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" title="Quick View"
                                                                                            tabindex="0"><i class="ti-search" aria-hidden="true"></i></a>
                                                                                        <a href="compare.html" title="Compare" tabindex="0"><i class="ti-reload"
                                                                                                aria-hidden="true"></i></a>
                                                                                    </div>
                                                                                    {{-- <div class="add-button" data-bs-toggle="modal" data-bs-target="#addtocart">add to
                                                                                        cart</div> --}}
                                                                                </div>
                                                                                <div class="product-detail">
                                                    
                                                                                    <a href="{{ route('addtocart', $products_Id->id ) }}">
                                                                                    
                                                                                    </a>
                                                    
                                                                                </div>
                                                                            </div>     

                                                                    <?php
                                                                    }
                                                                    ?>
                                                    
                                                                </div>
                                                            </div>
                                                        </section>
                                                    </div>
                                                    {{-- <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                    </div> --}}
                                                </div>
                                                </div>
                                            </div>
                                            <?php
                                            
                                            ?>

                                           
                                            {{-- Fixed Discount Modal --}}
                                                    <!-- Modal -->
                                            <div class="modal fade bd-example-modal-lg" id="exampleModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog modal-lg" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Offer Products</h5>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">&times;</span>
                                                    </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <section class="pt-0 section-b-space ratio_asos">
                                                            <div class="container-fuild">
                                                                <div class="row game-product grid-products px-5">
                                                    
                                                                    {{-- @foreach($product as $products ) --}}
                                                                        <?php
                                                                        //   dd($productdetailid);
                                                                        $product = App\Models\Products\Products::where('id',$productdetailid)->get();
                                                                        
                                                                        
                                                                        
                                                                        $offers1 = App\Models\Offer\Offer::where('id',$product[0]->offers)->get();
                                                                        $offertitle1 = $offers1[0]->title;
                                                                        
                                                                        if($offertitle1 == 'Fixed Discount'){
                                                                        $products_Ids = Products::where('offers', $product[0]->offers)->get();
                                                                        
                                                                        
                                                                        foreach($products_Ids as $products_Id)
                                                                        {
                                                                        
                                                                        //$product = App\Models\Products\ProductsDetails::where('id',$productdetailid)->get();
                                                                        $productdetails = App\Models\Products\ProductsDetails::where('products_id',$products_Id->product_id)->get();
                                                                        //   dd($productdetails);
                                                                        // print_r($productdetails);
                                                                        // $productdetails = App\Models\Products\ProductsDetails::where('products_id',$products->product_id)->get();
                                                                
                                                                        //   print_r($productdetails[0]->products_id);
                                                                        // print_r($category);
                                                                    ?>
                                                                        {{-- @foreach($productdetails as $productdetail ) --}}
                                                                            <div class="product-box col-xl-2 col-lg-3 col-sm-4 col-6">
                                                                                <div class="img-wrapper">
                                                                                    <div class="front">
                                                                                        <?php
                                                                                        // $img = json_decode($productdetail->product_detail_image);
                                                                                        // //  dd($img);
                                                                                        // foreach ($img as $id => $offerimg) {
                                                                                        //     if($id == 0)
                                                                                        //     {
                                                                                            ?>
                                                                                        
                                                                                            <div class="img">

                                                                                            <a href="{{ route('addtocart', $products_Id->id ) }}"><img
                                                                                                src="{{ asset('assets/images/products') . '/' . $products_Id->product_image  }}"
                                                                                                class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                                                                            </div>
                                                                                        <?php
                                                                                            // }
                                                                                            // }
                                                                                        ?>
                                                                                        
                                                                                    </div>
                                                                                    <div class="cart-info cart-wrap">
                                                                                        <a href="javascript:void(0)" title="Add to Wishlist" tabindex="0"><i
                                                                                                class="ti-heart" aria-hidden="true"></i></a>
                                                                                        <a href="#" data-bs-toggle="modal" data-bs-target="#quick-view" title="Quick View"
                                                                                            tabindex="0"><i class="ti-search" aria-hidden="true"></i></a>
                                                                                        <a href="compare.html" title="Compare" tabindex="0"><i class="ti-reload"
                                                                                                aria-hidden="true"></i></a>
                                                                                    </div>
                                                                                    {{-- <div class="add-button" data-bs-toggle="modal" data-bs-target="#addtocart">add to
                                                                                        cart</div> --}}
                                                                                </div>
                                                                                <div class="product-detail">
                                                    
                                                                                    <a href="{{ route('addtocart', $products_Id->id ) }}">
                                                                                        {{-- <h6>{{ $productdetail->selling_price }}</h6> --}}
                                                                                    </a>
                                                    
                                                                                </div>
                                                                            </div>
                                                                        {{-- @endforeach --}}
                                                                    <?php
                                                                    }
                                                                    }
                                                                
                                                                    ?>
                                                                    
                                                    
                                                                </div>
                                                            </div>
                                                        </section>
                                                    </div>
                                                    {{-- <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button type="button" class="btn btn-primary">Save changes</button>
                                                    </div> --}}
                                                </div>
                                                </div>
                                            </div>
                                            {{-- End --}}
                                        {{-- <a href="" id="offer" 
                                        class="btn btn-solid hover-solid btn-animation"><i class="fa fa-shopping-cart me-1"
                                            aria-hidden="true"></i>{{ $offers[0]->title }}</a> --}}

                                       
                                    </div>



                                    <div class="product-button" id="product-button">
                                    </div>
                                        <div class="product-form-group"><br>
                                            <div class="row" style="display:none;" id="addcart2_{{$product_det[0]->id}}">
                                                <div class="col-md-4">
                                                    <div class="input-group">
                                                        <span class="input-group-btn">
                                                            <button type="button" class="btn btn-danger btn-number" data-type="minus" data-field="quant[2]" onclick="addqnty('{{$product_det[0]->id}}','Minus')">
                                                                <span class="fa fa-minus"></span>
                                                            </button>
                                                        </span>
                                                        <input type="text" name="quant[2]" id="quantity{{$product_det[0]->id}}" value="0" class="form-control input-number" min="1" max="100" readonly>
                                                        <span class="input-group-btn">
                                                            <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]" onclick="addqnty('{{$product_det[0]->id}}','Add')">
                                                                <span class="fa fa-plus"></span>
                                                            </button>
                                                        </span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 ">
                                                    <a href="{{ url('/Shopping-cart')}}" class="buttons"><button type="button" class="btn add-to-cart-btn">&nbsp; <i class="biolife-icon icon-cart"></i> &nbsp; BUY NOW</button></a>

                                                </div>
                                            </div>
                                            @if($product_det[0]->quantity>0)
                                            @else
                                            @endif
                                        </div>
                                    <div class="product-buttons">
                                        <a href="" id="cartbook" 
                                        class="btn btn-solid hover-solid btn-animation"><i class=""
                                            aria-hidden="true"></i> Buy Now</a>
                                        <a href="" id="cartEffect" 
                                            class="btn btn-solid hover-solid btn-animation"><i class="fa fa-shopping-cart me-1"
                                                aria-hidden="true"></i> add to cart</a>
                                    
                                    </div>

                                    <div class="product-count" style="display:none;">
                                        <ul>
                                            <li>
                                                <img src="../assets/images/icon/truck.png" class="img-fluid" alt="image">
                                                <span class="lang">Free shipping for orders above $500 USD</span>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="border-product" style="display:none;">
                                        <h6 class="product-title">Sales Ends In</h6>
                                        <div class="timer">
                                            <p id="demo"></p>
                                        </div>
                                    </div>
                                    <div class="border-product">
                                        <h6 class="product-title">shipping info</h6>
                                        <ul class="shipping-info">
                                            <li>100% Original Products</li>
                                            <li>Free Delivery on order above Rs. 799</li>
                                            <li>Pay on delivery is available</li>
                                            <li>Easy 30 days returns and exchanges</li>
                                        </ul>
                                    </div>
                                    <div class="border-product">
                                        <h6 class="product-title">share it</h6>
                                        <div class="product-icon">
                                            <ul class="product-social">
                                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                            <li><a href="#"><i class="fa fa-whatsapp"></i></a></li>
                                                <!--<li><a href="#"><i class="fa fa-twitter"></i></a></li>-->
                                                <li><a href="#"><i class="fa fa-instagram"></i></a></li>
                                                
                                            </ul>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>    


<input type="hidden" name="product_size" id="product_size" value="{{$product_det[0]->size}}" class="form-control input-number">
<input type="hidden" name="product_color" id="product_color" value="{{$product_det[0]->color}}" class="form-control input-number">
<input type="hidden" name="hidden_name" id="product_name" value="{{$product_det[0]->product_name}}" />
<input type="hidden" name="hidden_price" id="product_price" value="{{$product_det[0]->retail_price}}" />
<input type="hidden" name="product_id" id="product_id" value="{{$product_det[0]->id }}" />
<input type="hidden" name="product_image" id="product_image" value="{{$product_det[0]->product_detail_image }}" />
<input type="hidden" name="product_qty" id="product_qty" value="{{ $product_det[0]->quantity }}" />

                                </form>
                                </div>
                            </div>
                      </div>
                    </div>
                </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Section ends -->


    <!-- product-tab starts -->
    <section class="tab-product m-0">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-lg-12">
                    <ul class="nav nav-tabs nav-material" id="top-tab" role="tablist">
                        <li class="nav-item"><a class="nav-link active" id="top-home-tab" data-bs-toggle="tab"
                                href="#top-home" role="tab" aria-selected="true"><i
                                    class="icofont icofont-ui-home"></i>Details</a>
                            <div class="material-border"></div>
                        </li>
                        <li class="nav-item"><a class="nav-link" id="profile-top-tab" data-bs-toggle="tab"
                                href="#top-profile" role="tab" aria-selected="false"><i
                                    class="icofont icofont-man-in-glasses"></i>Specification</a>
                            <div class="material-border"></div>
                        </li>
                       
                        <li class="nav-item"><a class="nav-link" id="review-top-tab" data-bs-toggle="tab"
                                href="#top-review" role="tab" aria-selected="false"><i
                                    class="icofont icofont-contacts"></i>Write Review</a>
                            <div class="material-border"></div>
                        </li>
                    </ul>
                    <div class="tab-content nav-material" id="top-tabContent">
                        <div class="tab-pane fade show active" id="top-home" role="tabpanel"
                            aria-labelledby="top-home-tab">
                            <div class="product-tab-discription">
                                <?php
                             
                                // use App\Models\Products\ProductsDetails;
                                // use App\Models\Products\Products;
                              
                                $pro_det_id = $product_det[0]->products_id;
                            
                                $productdesc = Products::where('product_id',$pro_det_id)->get();
                                //dd($productcolorsize[0]->description);
                             
                                ?>
                                <div class="part">
                                    <p>{{ $productdesc[0]->description }} </p>
                                    {{-- <p>The Model is wearing a white blouse from our stylist's collection, see the image
                                        for a mock-up of what the actual blouse would look like.it has text written on
                                        it in a black cursive language which looks great on a white color.</p> --}}
                                </div>
                                
                            </div>
                        </div>
                        <div class="tab-pane fade" id="top-profile" role="tabpanel" aria-labelledby="profile-top-tab">
                            <?php
                             
                                
                              use App\Models\Products\ProductSpecs;
                                $pro_spe_id = $product_det[0]->products_id;
                               
                                $productspec = ProductSpecs::where('products_id',$pro_spe_id)->get();
                                // dd($productspec);
                             
                                foreach($productspec as $productspec1)
                                {

                                ?>

                                <p>{{ $productspec1->specify_attribute. ' : '.$productspec1->specify_value}} </p>
                                
                                <?php
                                 }
                                ?>
                            
                        </div>
                      
                        <div class="tab-pane fade" id="top-review" role="tabpanel" aria-labelledby="review-top-tab">
                            <form action="{{route('rating')}}" method="post" class="theme-form">
                               
                                @csrf
                                <div class="form-row row">
                                    <div class="col-md-12">
                                        <div class="media">
                                            <label>Rating</label>
                                            <div class="media-body ms-3">
                                                <div class="rating three-star">
                                                    {{-- <i class="fa fa-star"></i> <i
                                                        class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                                        class="fa fa-star"></i> <i class="fa fa-star"></i> --}}
                                                        <div class="rate">
                                                            <input type="radio" id="star5" class="rate" name="rating" value="5"/>
                                                            <label for="star5" title="text">5 stars</label>
                                                            <input type="radio" checked id="star4" class="rate" name="rating" value="4"/>
                                                            <label for="star4" title="text">4 stars</label>
                                                            <input type="radio" id="star3" class="rate" name="rating" value="3"/>
                                                            <label for="star3" title="text">3 stars</label>
                                                            <input type="radio" id="star2" class="rate" name="rating" value="2">
                                                            <label for="star2" title="text">2 stars</label>
                                                            <input type="radio" id="star1" class="rate" name="rating" value="1"/>
                                                            <label for="star1" title="text">1 star</label>
                                                         </div>

                                                    </div>
                                            </div>
                                        </div>
                                    </div>


                                    <?php
                                        $uname = session('username');
                                        $sts = session('status');
                                             // dd($uname);
                                        //    dd($sts);   
                                        if(!empty($uname) &&  !empty($sts))
                                        {
                                        ?>
                                            
                                   
                                    <div class="col-md-6">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" name="name" id="name" value="{{ $uname }}">
                                        <input type="hidden" name="product_id" id="product_id" value="{{$product_det[0]->products_id }}" />
                                        <input type="hidden" name="hidden_name" id="product_name" value="{{$product_det[0]->product_name}}" />
                                    </div>
                                    <div class="col-md-6">
                                        <label for="email">Comments</label>
                                        <input type="text" class="form-control" name="comments" id="comments" placeholder="comments">
                                    </div>
                                    {{-- <div class="col-md-12">
                                        <label for="review">Review Title</label>
                                        <input type="text" class="form-control"  name="review" id="review"
                                            placeholder="Enter your Review Subjects" required>
                                    </div>
                                    <div class="col-md-12">
                                        <label for="review">Review Title</label>
                                        <textarea class="form-control" placeholder="Wrire Your Testimonial Here"
                                        name="description" id="description" rows="6"></textarea>
                                    </div> --}}
                                    <div class="col-md-12">
                                        <button class="btn btn-solid" type="submit">Submit Your
                                            Review</button>
                                    </div>
                                    <?php
                                    }
                                    ?>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- product-tab ends -->

    <!--Customer review start-->
    <section class="section-b-space ratio_asos">
        <div class="container">
            <div class="row">
                <div class="col-12 product-related">
                    <h2>Customer Review</h2>
                </div>
            </div>
            <div class="row search-product">
                <?php
              // dd($product);
                foreach ($product as $pro) {
               

                    // dd($pro->products_id);   
                $productrating = App\Models\User\rating::where('products_id',$pro->products_id)->get();
              //  dd($productrating[0]->star_rating);
                foreach ($productrating as  $value) {
                    //dd($value->star_rating);
                

               
                    ?>
                     <div class="media-body ms-3">
                        <div class="rating three-star">
                            {{-- <i class="fa fa-star"></i> <i
                                class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                class="fa fa-star"></i> <i class="fa fa-star"></i> --}}
                                <div class="rate">
                                    <?php
                                    for($i=0; $i< $value->star_rating; $i++)
                                          { 
                                            ?>
                                    <input type="radio" id="star1" class="rate" name="rating" value="1"/>
                                    <label for="star1" style="color:#ffcc00;" title="text">1 star</label>
                                   
                                    {{-- <label for="" title="text">{{ $productrating[0]->comments }}</label> --}}
                                <?php     
                                
                                    }
                                     ?>
                                      <span>{{ $value->comments }}</span><br>
                                      <span>{{ $value->customer_name }}</span>
                                 </div>

                            </div>
                    </div>
                <?php    
                    
                }

              ?>
               
                <?php
                 }
                
                ?>
                

            </div>
        </div>
    </section>
    <!-- Customer review end -->


    <!-- product section start -->
    <section class="section-b-space ratio_asos">
        <div class="container">
            <div class="row">
                <div class="col-12 product-related">
                    <h2>related products</h2>
                </div>
            </div>
            <div class="row search-product">
                <?php
                // dd($product);
                foreach ($product as $pro) {
                   //dd($pro->products_id);
                    
                    $products_Ids = Products::where('category_sub', $pro->category_sub)->get();
                    // dd($products_Ids);                                              
                    foreach($products_Ids as $products_Id)
                    {
                
                   
                // $productdetails = App\Models\Products\ProductsDetails::where('products_id',$products_Id->id)->get();
                 //dd($productdetails);
                //  print_r($productdetails);
               // print_r($category);
                
              ?>
               
                <div class="col-xl-2 col-md-4 col-6">
                    <div class="product-box">
                        <div class="img-wrapper">
                            <div class="front">
                                <?php
                                // $image = json_decode($products->product_detail_image);
                                // foreach ($image as $key => $value) {
                                //     if($key == 0)
                                //     {
                                    ?>
                                    <div class="img">
                                    <a href="{{ route('addtocart', $products_Id->id ) }}"><img src="{{ asset('assets/images/products/') . '/' . $products_Id->product_image }}"
                                        class="img-fluid blur-up lazyload" alt=""></a>    
                                        </div>
                                <?php
                                    //     }
                                    // }
                                ?>
                                
                            </div>
                            <div class="back">
                                <?php
                                // $image1 = json_decode($products->product_detail_image);
                                // foreach ($image1 as $key1 => $value1) {
                                //     if($key1 == 0)
                                //     {
                                    ?>
                                <a href="#"><img src="{{ asset('assets/images/products/') . '/' . $products_Id->product_image }}"
                                        class="img-fluid blur-up lazyload bg-img" alt=""></a>
                                        <?php
                                    //     }
                                    // }
                                ?>
                            </div>
                            <div class="cart-info cart-wrap">
                                <button data-bs-toggle="modal" data-bs-target="#addtocart" title="Add to cart"><i
                                        class="ti-shopping-cart"></i></button> <a href="javascript:void(0)"
                                    title="Add to Wishlist"><i class="ti-heart" aria-hidden="true"></i></a> <a href="#"
                                    data-bs-toggle="modal" data-bs-target="#quick-view" title="Quick View"><i
                                        class="ti-search" aria-hidden="true"></i></a> 
                            </div>
                        </div>
                        <div class="product-detail">
                            <div class="rating"><i class="fa fa-star"></i> <i class="fa fa-star"></i> <i
                                    class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i></div>
                            <a href="product-page(no-sidebar).html">
                                {{-- <h6>Slim Fit Cotton Shirt</h6> --}}
                            </a>
                            
                            <ul class="color-variant">
                                {{-- <li id ="bg-light0" class="bg-light0"></li>
                                <li class="bg-light1"></li>
                                <li class="bg-light2"></li> --}}
                            </ul>
                        </div>
                    </div>
                </div>
               
        <?php
            }
                }
                
                ?>
                

            </div>
        </div>
    </section>
    <!-- product section end -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/color-name/1.1.4/index.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinycolor/1.4.2/tinycolor.min.js"></script>
  <script>
        $(document).on("click",".quantity-right-plus",function() {
             // alert("click");
            var qty = $('#quantity').val();
             // alert(qty);
            var p_qty = $('#product_qty').val();
            //  alert(p_qty);
            if( p_qty > qty ){
                alert(qty);
                $('#quantity').val(qty);
                // setTimeout(function() { debugger; }, 5000)
            }
            else{
                alert('Out of quantity');
                $('.quantity-right-plus').prop('disabled', true);
               
        }
        });

        $(document).on("click",".quantity-left-minus",function() {
           // alert("click");
            var qty = $('#quantity').val();
           // alert(qty);
            var p_qty = $('#product_qty').val();
          //  alert(p_qty);
            if( p_qty >qty ){
                $('.quantity-right-plus').prop('disabled', false);
                $('#quantity').val(qty);
                // setTimeout(function() { debugger; }, 5000)
            }
            else{
                // alert('Out of quantity');
                $('.quantity-right-plus').prop('disabled', true);
               
        }
        });
    </script>

    

<script>
     $( document ).on("click",".size",function() {
        var ul= document.getElementById("clsize");
        
        var btns = ul.getElementsByClassName("size");
        
        //alert(btns.length);
        for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
        var current = document.getElementsByClassName("active");
        current[0].className = current[0].className.replace(" active", "");
        this.className += " active";
        });
       
        }
        
       
            var size = $(this).val();
            // alert(size);
           $.ajax({
                url: '{{route("sizedetails", "size")}}',
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}",
                     "size": size
                },
                dataType: "json",
                 success: function (data) {
                    console.log(data);
                    // alert(data.pro_color);
                    //  alert(data.pro_color);
                //    console.log(data.offername[0].type);

                    // console.log(data.pro_color[0].product_detail_image);
                    
                  //  console.log(data.pro_color);
                        if(data.offername && data.offername[0] && data.offername[0].type === 'Fixed Discount'){

                                                        
                                if(data.offername[0].discount_type == 'Percentage' ){
                                    
                                                    var dis = data.pro_sizedetails[0].selling_price * data.offername[0].value / 100;
                                                    
                                                    var amt = data.pro_sizedetails[0].selling_price - dis;
                                                    
                                }
                                else if(data.offername[0].discount_type == 'Fixed'){
                                    var amt = selprice - $offers;
                                }
                                $('#h3').html('<del>Rs ' +data.pro_sizedetails[0].selling_price+ '</del> Rs '+amt+'<input type="hidden"  id="product_price1" name="product_price1" class="form-control input-number" value="'+amt+' "><input type="hidden"  id="fixeddiscount" name="fixeddiscount" class="form-control input-number" value="fixeddiscount">')
                                $('.price-detail').hide();
                                $('#price').html('<h3 class="price-detail">Rs' +data.pro_sizedetails[0].selling_price+ ' <del>Rs'+data.pro_sizedetails[0].retail_price+'</del></h3> <input type="hidden"  id="product_price" name="product_price" class="form-control input-number" value="'+data.pro_sizedetails[0].selling_price+' ">');    

                                }
                                else{
                                $('.price-detail').hide();
                                $('#price').html('<h3 class="price-detail">Rs' +data.pro_sizedetails[0].selling_price+ ' <del>Rs'+data.pro_sizedetails[0].retail_price+'</del></h3> <input type="hidden"  id="product_price" name="product_price" class="form-control input-number" value="'+data.pro_sizedetails[0].selling_price+' ">');

                                }

                  // Hide all colors and fade in only the colors corresponding to the selected size
                  $('.licolor').removeClass('active').addClass('inactive');
                  $('.licolor[data-size="' + size + '"]').removeClass('inactive').addClass('active');


                  // Assuming data.pro_color is an array like ['GREEN', 'YELLOW', 'RED']
                var colors = data.pro_color;
                // alert(colors)
                // console.log(colors);
                // alert(data.pro_color);
                // Select the element with the class 'color-variant'
                var colorVariantElement = $('.color-variant');

                // Clear the existing content of the element
                colorVariantElement.html('');

                // Iterate over the colors array using forEach
                colors.forEach(function(color, index) {
                // Create a new list item element with the specified color
                //alert(color.color)
                var listItem = $('<li>', {
                     css: {
                        color: color.color,
                        backgroundColor: color.color
                    },
                    id: 'bg-light0' + color.id,
                    class: 'licolor bg-light0',
                    value: color.id
                  
                    
                }).append($('<input>', {
                    type: 'checkbox',
                    value: color.color,
                    id: 'color'+ color.id,
                    name: 'color'+ color.id+'[]'
                 }));

                // Append the new list item to the 'color-variant' element
                colorVariantElement.append(listItem);
                });
 
                  

                     var proimg = data.pro_color[0].product_detail_image;
                    //   console.log(proimg);
                    // alert(proimg);
                        var imgurl1="{{ asset('assets/images/products/detail/')}}";
                        const myArr = JSON.parse(proimg);
                        //  console.log(myArr[0]);
                        // console.log(myArr.length);
                        
                            var x=0;
                            x++;
                            if(x<=1)
                                {
                                for (let i = 0; i < myArr.length; i++) {
                                    //$("#slide1").hide();
                                    //console.log(myArr[i]);
                                    // alert(myArr[i]);
                                        if(myArr[i].length != 0 ){
                                             
                                        $("#slide1").html('<figure class="zoom" onmousemove="zoom(event)" style="background-image: '+imgurl1+'/'+myArr[i]+'"><img src="'+imgurl1+'/'+myArr[i]+'" alt="" class="img-fluid blur-up lazyload image_zoom_cls-0" style="width:500px;height:600px;"></figure>');
                                        $("#slide").html('<img src="'+imgurl1+'/'+myArr[i]+'" alt="" class="img-fluid blur-up lazyload">');
                                        }
                                        else{
                                            // alert('no image');
                                             $("#size"+size).hide();
                                        }
                                    }

                                }   
                // }
                },
                error: function (data) {
                    console.log('Error:', data);
                }
                });
        });


     // Handle color click events
        $(document).on("click", ".licolor", function () {
               // Toggle the 'active' class for the clicked element
                $(this).toggleClass('active');


                // Handle the color click logic here
                var selectedColors = [];

                // Iterate over all elements with 'licolor' and 'active' class
                $('.licolor.active').each(function () {
                    var colorId = $(this).val();
                    var color = $("#color" + colorId).val();
                    selectedColors.push(color);
                });

                // Join the selected colors into a comma-separated string
                var selectedColorsString = selectedColors.join(', ');
                // alert(selectedColorsString);
                // Set the value of the 'product_color' input field
                $('#product_color').val(selectedColorsString);

            
            
            
            var sizee = $(".size.active a").text();
           // alert(sizee);
            
            
            $('#product_size').val(sizee);


            $('#product_color').val(color);
            //  alert(size)
            //  alert(sizeeval)
            // Add your logic for handling color clicks based on colorId and size
           // console.log('Color clicked:', colorId, 'for size:', size);
    });
    </script>
    

<script>
    //  $( document ).on("click",".size",function() {
    //         alert("click");
    //     //    $(this).addClass('active');
    //     //    $(this).parent().addClass('Selected');



    //     // var header = document.getElementsByClassName("size-box");
    //     // alert(header);
    //    var ul= document.getElementById("clsize");
    //   // alert(ul);
    //   // console.log(ul);
    //     var btns = ul.getElementsByClassName("size");
    //    // alert(btns.length);
    //     for (var i = 0; i < btns.length; i++) {
    //     btns[i].addEventListener("click", function() {
    //     var current = document.getElementsByClassName("active");
    //     current[0].className = current[0].className.replace(" active", "");
    //     this.className += " active";
       
    //         // if (x.style.display === "none") {
    //         //     x.style.display = "block";
    //         // } else {
    //         //     x.style.display = "none";
    //         // }
    //     });
       
    //     }

        
       
    //         var size = $(this).val();
               
    //       // alert(size);

    //        $.ajax({

    //             url: '{{route("sizedetails", "size")}}',
    //             type: "GET",
    //             data: {
    //                 "_token": "{{ csrf_token() }}",
    //                  "size": size

    //             },

    //             dataType: "json",
    //              success: function (data) {
    //                 // console.log(data.pro_sizedetails[0].selling_price);
    //                 // console.log(data.pro_color);
    //                 // alert(data);
    //                 // console.log(data[0].selling_price);
    //                 // alert(data.size);
    //                 $('.price-detail').hide();
    //                  $('#price').html('<h3 class="price-detail">Rs' +data.pro_sizedetails[0].selling_price+ ' <del>Rs'+data.pro_sizedetails[0].retail_price+'</del></h3> <input type="hidden"  id="product_price" name="product_price" class="form-control input-number" value="'+data.pro_sizedetails[0].selling_price+' ">');
                     
    //                  $('.color-variant').html('<li id ="bg-light0" class="bg-light0" value ="'+data.pro_color[0].id+'">'+data.pro_color[0].color+'</li>');
    //                 // alert(data.color);
    //                 // $("#clsize").html('<li></li>');


    //                 // $.each( data, function( key, value ) {
    //                 //     // console.log( value.color );
    //                 //     if(value.color == value.color)
    //                 //     {
    //                 //     console.log( value.size );
                        
    //                 //     $("#clsize").append('<li class ="size" value='+value.id+'>'+value.size+'</li>');

                           
    //                 //     }
    //                 //      else{
    //                 //         console.log( value.size );
    //                 //     }
    //                 // });
              
    //             },
    //             error: function (data) {
    //                 console.log('Error:', data);
    //             }
    //             });

           
    //     });


        /* start */
        $(document).on("click",".bg-light0",function() {

            var colorvalue = $(this).val();
        
            $.ajax({
                url: '{{route("colorvalue", "colorvalue")}}',
                type: "GET",
                data: {
                    "_token": "{{ csrf_token() }}",
                    "colorvalue": colorvalue
                },

                dataType: "json",
                success: function (data) {
                
                //   $("#clsize").html('');
                        $('.size').removeClass('active');
                        $('.size').addClass('inactive');
                
                        $.each( data.productcolorvalue, function( key, value ) {
                        
                           
                            if(colorvalue == value.id)
                            {
                             var cls = $('#size' + value.id).attr('class');


                                  //  alert(cls);
                                if(cls == 'size'){

                                     
                                $('#size' + value.id).removeClass('inactive');
                                $('#size' + value.id).addClass('active');
                                }
                                else if(cls == 'size active')
                                {
                                    $('#size' + value.id).removeClass('active');
                                    $('#size' + value.id).addClass('inactive');
                                    // $('#size' + value.id).addClass('active');
                                }
                                else if(cls == 'size inactive')
                                {
                                    $('#size' + value.id).removeClass('inactive');
                                    $('#size' + value.id).addClass('active');
                                }
                                else{
                                    $('#size' + value.id).removeClass('active');
                                    $('#size' + value.id).addClass('inactive');
                                }

                            }
                            else{
                                 $('#size' + value.id).removeClass('active');
                                //  $('#size' + value.id).addClass('inactive');
                               
                            }
                            });
                            
                            var proimg = data.pro_color_val[0].product_detail_image;
                               //   console.log(proimg);
                                // alert(proimg);
                            var imgurl1="{{ asset('assets/images/products/detail/')}}";
                            const myArr = JSON.parse(proimg);
                           //  console.log(myArr[0]);
                           // console.log(myArr.length);
                        
                           // alert(myArr);
                            var x=0;
                            x++;
                            if(x<=1)
                                {
                                for (let i = 0; i < myArr.length; i++) {
                                    //$("#slide1").hide();
                                    console.log(myArr[i]);
                                    // alert(myArr[i]);
                                        if(myArr[i].length != 0 ){
                                            // alert(myArr[i].length);
                                        $("#slide1").html('<figure class="zoom" onmousemove="zoom(event)" style="background-image: '+imgurl1+'/'+myArr[i]+'"><img src="'+imgurl1+'/'+myArr[i]+'" alt="" class="img-fluid blur-up lazyload image_zoom_cls-0" style="width:500px;height:600px;"></figure>');
                                        $("#slide").html('<img src="'+imgurl1+'/'+myArr[i]+'" alt="" class="img-fluid blur-up lazyload">');
                                        }
                                        else{
                                            alert('no image');
                                        }
                                    }

                                }
                    },
                error: function (data) {
                    console.log('Error:', data);
                }
                });               
        });
        /*end*/
</script>




{{-- <script>
     $(document).on("click","#cartEffect",function() {
        alert("click");

        var x = document.getElementsByClassName("error-message");
                 x.style.display = 'none';   
        console.log(x);
           alert(x);
           document.getElementsByClassName("error-message").style.display = 'none';
            console.log(x[0].outerText);
            x[0].outerText = "";
             $('.product-buttons').html('<button type='submit' class="btn btn-solid hover-solid btn-animation"  value="submit">Buy Now</button> <a href="" id="cartEffect" class="btn btn-solid hover-solid btn-animation"><i class="fa fa-shopping-cart me-1" aria-hidden="true"></i> ADDED TO CART</a>');
     });
    </script> --}}



<script>
      
    //   $(document).ready(function(){

    //     var clr = $('.bg-light0').html();

    //         $('.bg-light0').each(function(){
                
    //              var clr1 = this.val();
                 
    //              if(clr1 == clr1)
    //              {
                   
    //                 $('.bg-light0').html(clr1);
    //              }
    //         })

    //     });
    
    function zoom(e) {
        var zoomer = e.currentTarget;
        e.offsetX ? (offsetX = e.offsetX) : (offsetX = e.touches[0].pageX);
        e.offsetY ? (offsetY = e.offsetY) : (offsetX = e.touches[0].pageX);
        x = (offsetX / zoomer.offsetWidth) * 100;
        y = (offsetY / zoomer.offsetHeight) * 100;
        zoomer.style.backgroundPosition = x + "% " + y + "%";
    }



</script>
    <script>
               document.addEventListener("DOMContentLoaded", function () {
                // Function to show the loading container
                function showLoader() {
                    document.getElementById("loading-container").style.display = "block";
                }
            
                // Function to hide the loading container
                function hideLoader() {
                    document.getElementById("loading-container").style.display = "none";
                }
            
                // Event listener to show loader when the page starts loading
                window.addEventListener("beforeunload", showLoader);
            
                // Event listener to hide loader when the page finishes loading
                window.addEventListener("load", hideLoader);
            });


    </script>


    <script src="jquery-3.6.3.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
   
    <!-- footer start -->
   
   @include('website.front-end.newfooter')