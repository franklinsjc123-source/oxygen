 
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
    <!-- section start -->
    {{-- @dd($product[0]->offers); --}}
    <?php
    
//  dd($product_det);
    // exit();
    ?>
    
    <section>
        <div id="loading-container">
        <div class="loader"></div>
        </div>
        <div class="collection-wrapper">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="product-slick">
                            <?php 
                            
                            $product_detailsimage = json_decode($product_det[0]->product_detail_image);
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
                                
                            ?>
                                    <div class ="img" id="slide">
                                       
                                        <img src="{{ asset('assets/images/products/detail') . '/' . $value1 }}" alt=""
                                            class="img-fluid blur-up lazyload">
                                       
                                        </div>
                                
                                    <?php
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
                            <div class="label-section">
                                <span class="badge badge-grey-color">#1 Best seller</span>
                                {{-- <span class="label-text">in fashion</span> --}}
                                <a href="javascript:void(0)">Best seller</a>

                            </div>
                           <div id="price">
                            <h3 class="price-detail">Rs {{ $product_det[0]->selling_price }} <del>Rs {{ $product_det[0]->retail_price }}</del><span></span></h3>
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
                                        // dd($colorsize_id);
    
                                        $productcolorsize1 = ProductsDetails::where('products_id',$colorsize_id)->get();
                                        
                                        $siz =array('');
                                        ?>
                                        
                                        @foreach ($productcolorsize1 as $item)
                                        
                                        <?php
                                        $size1 = $item->size;
                                        
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
                                $offertitle = $offers[0]->title;
                                }
                                else{
                                    $offertitle = " ";
                                }
                                if($offers[0]->type == 'Fixed Discount'){
                                        if($offers[0]->discount_type == 'Percentage')
                                        {
                                            $dis = $selprice * $offers[0]->value/100;
                                            $amt = $selprice - $dis;
                                        }
                                        else if($offers[0]->discount_type == 'Fixed') {
                                            $amt = $selprice - $offers[0]->value;
                                        }?>

                                        <h6 class="product-title">Total Price</h6>
                                <h3 id="h3"><del>Rs {{ $product_det[0]->selling_price }}</del> Rs {{ $amt }}
                                    <input type="hidden"  id="product_price1" name="product_price1" class="form-control input-number" value="{{ $amt }}">
                                    <input type="hidden"  id="fixeddiscount" name="fixeddiscount" class="form-control input-number" value="fixeddiscount">
                                </h3>
                                
                                <?php

                                    }

                                ?>
                                
                                
                                <!-- <h6 class="product-title">Offers Fixed Discount</h6>-->
                                
                                <!--{{-- <h5 class="price-detail"> {{ $offers[0]->title }}</h5> --}}-->
                                <!--<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal1">-->
                                
                                <!--    Fixed Discount-->
                                <!--  </button>-->
                                  
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
                                                                // dd($productdetailid);
                                                                   $product = App\Models\Products\Products::where('id',$productdetailid)->get();
                                                                //dd($product);
                                                                   $products_Ids = Products::where('offers', $product[0]->offers)->get();
                                                                  // dd($products_Ids);
                                                                 
                                                                 foreach($products_Ids as $products_Id)
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

                                <input type="hidden" name="product_size" id="product_size" value="{{$product_det[0]->size}}" class="form-control input-number">
                                 <input type="hidden" name="product_color" id="product_color" value="{{$product_det[0]->color}}" class="form-control input-number">
                                <input type="hidden" name="hidden_name" id="product_name" value="{{$product_det[0]->product_name}}" />
                                <input type="hidden" name="hidden_price" id="product_price" value="{{$product_det[0]->retail_price}}" />
                                <input type="hidden" name="product_id" id="product_id" value="{{$product_det[0]->id }}" />
                                <input type="hidden" name="product_image" id="product_image" value="{{$product_det[0]->product_detail_image }}" />
                                <input type="hidden" name="product_qty" id="product_qty" value="{{ $product_det[0]->quantity }}" />
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
                                    <!--<br>-->
                                    <!--<div class="buttons" id="addcart1_{{$product_det[0]->id}}">-->
                                    <!--    <button type="button" class="add-to-cart-btn" onclick="addqnty('{{$product_det[0]->id}}','Add')"> &nbsp;&nbsp;<i class="biolife-icon icon-cart"></i> &nbsp; Add to cart</button>-->

                                    <!--</div>-->
                                    @else
                                    <!--<br>-->
                                    <!--<div class="buttons">-->
                                    <!--    <button type="button" class="add-to-cart-btn" onclick="alert('Out Of Stock')" style="background-color:#05a5038a"> &nbsp;&nbsp;<i class="biolife-icon icon-cart"></i> &nbsp; Add to cart</button>-->

                                    <!--</div>-->
                                    @endif
                                </div>
                            <div class="product-buttons">
                                {{-- ///
                                <div class="row" style="display:none;" id="addcart2_{{$product_det->id}}">
                                    <div class="col-md-4">
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-danger btn-number" data-type="minus" data-field="quant[2]" onclick="addqnty('{{$product_det->id}}','Minus')">
                                                    <span class="fa fa-minus"></span>
                                                </button>
                                            </span>
                                            <input type="text" name="quant[2]" id="quantity{{$product_det->id}}" value="0" class="form-control input-number" min="1" max="100" readonly>
                                            <span class="input-group-btn">
                                                <button type="button" class="btn btn-success btn-number" data-type="plus" data-field="quant[2]" onclick="addqnty('{{$product_det->id}}','Add')">
                                                    <span class="fa fa-plus"></span>
                                                </button>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 ">
                                        <a href="" class="buttons"><button type="button" class="btn add-to-cart-btn">&nbsp; <i class="biolife-icon icon-cart"></i> &nbsp; BUY NOW</button></a>

                                    </div>
                                </div>
                                /// --}}
                                {{-- <button type='submit' class="btn btn-solid hover-solid btn-animation"  value="submit">Buy Now</button> --}}
                                <a href="" id="cartbook" 
                                class="btn btn-solid hover-solid btn-animation"><i class=""
                                    aria-hidden="true"></i> Buy Now</a>
                                   

                                <a href="" id="cartEffect" 
                                    class="btn btn-solid hover-solid btn-animation"><i class="fa fa-shopping-cart me-1"
                                        aria-hidden="true"></i> add to cart</a>
                                        
                                {{-- <a href="#" class="btn btn-solid"><i
                                class="fa fa-bookmark fz-16 me-2" aria-hidden="true"></i>wishlist</a> --}}
                            
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
                        </form>
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
                                {{-- <div class="part">
                                    <h5 class="inner-title">fabric:</h5>
                                    <p>Art silk is manufactured by synthetic fibres like rayon. It's light in weight and
                                        is soft on the skin for comfort in summers.Art silk is manufactured by synthetic
                                        fibres like rayon. It's light in weight and is soft on the skin for comfort in
                                        summers.</p>
                                </div>
                                <div class="part">
                                    <h5 class="inner-title">size & fit:</h5>
                                    <p>The model (height 5'8") is wearing a size S</p>
                                </div>
                                <div class="part">
                                    <h5 class="inner-title">Material & Care:</h5>
                                    <p>Top fabric: pure cotton</p>
                                    <p>Bottom fabric: pure cotton</p>
                                    <p>Hand-wash</p>
                                </div> --}}
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
                            {{-- <p>The Model is wearing a white blouse from our stylist's collection, see the image for a
                                mock-up of what the actual blouse would look like.it has text written on it in a black
                                cursive language which looks great on a white color.</p> --}}
                            {{-- <div class="single-product-tables">
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>Sleeve Length</td>
                                            <td>Sleevless</td>
                                        </tr>
                                        <tr>
                                            <td>Neck</td>
                                            <td>Round Neck</td>
                                        </tr>
                                        <tr>
                                            <td>Occasion</td>
                                            <td>Sports</td>
                                        </tr>
                                    </tbody>
                                </table>
                                <table>
                                    <tbody>
                                        <tr>
                                            <td>Fabric</td>
                                            <td>Polyester</td>
                                        </tr>
                                        <tr>
                                            <td>Fit</td>
                                            <td>Regular Fit</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div> --}}
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
    //
    // $( document ).ready(function() {
    //         var id = $(".bg-light0").val();
    //           var clsize;
    //           console.log(id);

    //       $.ajax({

    //             url: '{{route("colorsize", "id")}}',
    //             type: "GET",
    //             data: {
    //                 "_token": "{{ csrf_token() }}",
    //                  "id": id

    //             },

    //             dataType: "json",
    //              success: function (data) {
    //                 // console.log(data);
    //                 //  alert(data);
    //                 var arr = [];
    //                 $("#clsize").html('');
    
                  
    //                 $.each( data, function( key, value ) {
    //                     var strlength = value.color;
    //                     // alert(strlength.length);
    //                     console.log(value);
                        
    //                   if(value.size == 'Size' || value.size == null)
    //                     {
                            
                          
    //                     }   
    //                     else{
                            
    //                       $("#clsize").append('<li id = "size'+value.id+'" class ="size" value='+value.id+'><a href="javascript:void(0)">'+value.size+'</a></li><input type="hidden" id="sizee'+value.id+'" name="sizee'+value.id+'" value="'+value.size+'">');                            
    //                     }
    //                     var proimg = value.product_detail_image;
    //                     var imgurl1="{{ asset('assets/images/products/detail/')}}";
    //                     const myArr = JSON.parse(proimg);
    //                     console.log(myArr);
    //                     console.log(myArr.length);



    //                 //    x++;
    //                 //    if(x<=1)
    //                 //     {
    //                 //     for (let i = 0; i < myArr.length; i++) {
                           
    //                 //          $("#slide1").append('<img src="'+imgurl1+'/'+myArr[i]+'" alt="" class="img-fluid blur-up lazyload image_zoom_cls-0" style="width:500px;height:600px;">');
    //                 //          $("#slide").append('<img src="'+imgurl1+'/'+myArr[i]+'" alt="" class="img-fluid blur-up lazyload">');
    //                 //         }

    //                 //     }                      
                       

    //                 //    proimg.forEach(myfunction);
                        
    //                 //     function myFunction(item, index) {
    //                 //         $("#slide1").append('<img src="asset(assets/images/products/detail)'+'/'+index+' " alt="" class="img-fluid blur-up lazyload image_zoom_cls-0" style="width:500px;height:600px;">');
    //                 //         $("#slide").append('<img src="asset(assets/images/products/detail)'+'/'+index+' " alt="" class="img-fluid blur-up lazyload image_zoom_cls-0" style="width:500px;height:600px;">');
                            
    //                 //     }
                        
    //                 });
                    
    //             },
    //             error: function (data) {
    //                 console.log('Error:', data);
    //             }
    //             });

    // });
 
   
</script>





<script>
     $( document ).on("click",".size",function() {
        var ul= document.getElementById("clsize");
        
        var btns = ul.getElementsByClassName("size");

        for (var i = 0; i < btns.length; i++) {
        btns[i].addEventListener("click", function() {
        var current = document.getElementsByClassName("active");
        current[0].className = current[0].className.replace(" active", "");
        this.className += " active";
        });
       
        }
        
       
            var size = $(this).val();
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
                //    console.log(data.pro_sizedetails[0].selling_price);

                    // console.log(data.pro_color[0].product_detail_image);
                    
                        
                    if(data.offername[0].type == 'Fixed Discount'){

                        
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
                    //  $('.color-variant').html('<li id ="bg-light0" class="bg-light0" value ="'+data.pro_color[0].id+'">'+data.pro_color[0].color+'</li>');
                      var csize = document.getElementById("bg-light0"+size).value;
                    
                      var sizee = document.getElementById("sizee"+size).value;
                      const color =  document.getElementById("product_color"+size).value;
                    
                    const elements = document.querySelectorAll('#bg-light0'+size);
                     $('#product_size').val(sizee);
                     $('#product_color').val(color);
                     $('.licolor').removeClass('active');
                     $('.licolor').addClass('inactive');
                    // Loop through each element
                    elements.forEach(element => {
                    
                    if (csize == size) {
                        // element.style.border="none";
                        // $('#div2').html('<div class="form-control" style="border: 2px solid blue;"><li  style="color:'+data.pro_color[0].color+'; background-color:'+data.pro_color[0].color+';" id ="bg-light0 '+data.pro_color[0].id+'" class="bg-light0" value="'+data.pro_color[0].id+'"></li></div>');
                        
                        //    element.classList.toggle('active')
                        element.classList.remove("inactive");
                          element.classList.add("active");
                          
                          
                          
                         
                    } else {
                          element.classList.remove("active");
                          element.classList.add("inactive");
                        // element.classList.toggle('selected')
                        // element.classList.toggle('active')
                        
                    }
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
                                    console.log(myArr[i]);
                                    // alert(myArr[i]);
                                        if(myArr[i].length != 0 ){
                                             
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