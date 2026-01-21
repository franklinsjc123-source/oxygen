 @extends('app_template')
 @section('title',' Offers')
 @section('content')
<style>
    .custom-split{
  display:flex;
  height:240px;
  border-radius:10px;
   color: white;
  overflow:hidden;
  background: rgba(37, 38, 42, 0.9);
}

/* Left Text Area */
.custom-split .store-left{
  width:40%;
  padding:20px;
  display:flex;
  flex-direction:column;
  justify-content:center;
}

/* Right Image */
.custom-split .store-right{
  width:60%;
}

.custom-split .store-right img{
  width:100%;
  height:100%;
  
  object-fit:cover;
  display:block;
}
  .store-address-grid {
    color: #fff5f5ff;
  }


</style>
 
  <!-- Start of Main -->
        <main class="main">
            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb bb-no">

                        <li><a href="{{ url('home')}}">Home</a></li>
                        <li><a href="{{ url( 'offers' ) }}"> Offers </a> </li>

                        <?php if($offer_id > 0){  ?>
                            <li><a href="{{ url( 'offers/?id='.$offer_id ) }}"> <?= $offer_name ?> </a> </li>
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

                    <div class="shop-default-category category-ellipse-section ">
                        <div class="swiper-container swiper-theme shadow-swiper"
                                data-swiper-options="{
                                'spaceBetween': 20,
                                'slidesPerView': 2,
                                'breakpoints': {
                                    '480': {
                                        'slidesPerView': 3
                                    },
                                    '576': {
                                        'slidesPerView': 4
                                    },
                                    '768': {
                                        'slidesPerView': 6
                                    },
                                    '992': {
                                        'slidesPerView': 7
                                    },
                                    '1200': {
                                        'slidesPerView': 8,
                                        'spaceBetween': 30
                                    }
                                }
                            }"
                        >
                            <div class="swiper-wrapper row gutter-lg cols-xl-8 cols-lg-7 cols-md-6 cols-sm-4 cols-xs-3 cols-2">
                              

                                  <div class="swiper-slide category-wrap">
                                    <div class="category category-ellipse">
                                       <center>

                                         <figure class="category-media">
                                            <a href="{{ url( 'offers' ) }}">
                                                
                                                <img src="{{ asset('assets/images/offer_logo/all_offer.jpeg') }}" alt="All Offers"
                                                   style="background-color: #5C92C0;" />
                                            </a>
                                        </figure>
                                       </center>
                                        <div class="category-content">
                                            <h4 class="category-name">
                                                <a href="{{ url( 'offers' ) }}">All Offers</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>


                              	@foreach($offer as $o )

                             
                                <div class="swiper-slide category-wrap">
                                    <div class="category category-ellipse">
                                       <center>

                                         <figure class="category-media">
                                            <a href="{{ url( 'offers?id='.$o->id ) }}">
                                                
                                                <img src="{{ asset('assets/images/offer_logo/'.$o->offer_logo) }}" alt="Categroy"
                                                   style="background-color: #5C92C0;" />
                                            </a>
                                        </figure>
                                       </center>
                                        <div class="category-content">
                                            <h4 class="category-name">
                                                <a href="{{ url( 'offers?id='.$o->id ) }}">{{$o->title}}</a>
                                            </h4>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                              
                            </div>


                            
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>

                     <div class="page-content mb-8 mt-5">
                        <div class="container">
                            <div class="toolbox vendor-toolbox pb-0">
                            
                                <div class="toolbox-left mb-4 mb-md-0">
                                    {{-- <a href="#" class="btn btn-primary btn-outline btn-rounded btn-icon-left "><i class="w-icon-category"></i>VENDORS</a> --}}
                                    {{-- <label class="d-block">Total Store Showing 6</label> --}}
                                    <h2><label class="d-block">Offer  </label></h3><h4><?=  $offer_name ? '( ' . $offer_name. ' )' :''  ?></h4>
                                </div>
                               
                            </div>
                            <div class="vendor-search-wrapper">
                                <form class="vendor-search-form">
                                    <input type="email" class="form-control mr-4 bg-white" name="vendor" id="vendor"
                                        placeholder="Search Vendors" />
                                    <button class="btn btn-primary btn-rounded" type="submit">Apply</button>
                                </form>
                            </div>
                            <div class="row cols-lg-3 cols-md-2 cols-sm-2 cols-1 mt-4">

                            @foreach($vendorcreate as $vendorcreate )

                                    <!-- <div class="store-wrap mb-4">
                                        <div class="store store-grid">
                                            <div class="store-header" style="position: relative; overflow: hidden;">
                                                <figure class="store-banner" style="margin: 0;">
                                                    <img 
                                                        src="{{ asset('assets/images/vendor/profile/' . $vendorcreate->profile_image) }}"
                                                        alt="Vendor"
                                                        style="width: 100%; height: auto; object-fit: cover; display: block;" />
                                                </figure>
                                                <div class="banner-overlay"></div>
                                            </div>
                                            <div class="store-content">
                                                <h4 class="store-title">
                                                    <a href=" {{ url('/offer-products/'.$vendorcreate->id) }}">{{ $vendorcreate->shop_name }}</a>
                                                </h4>
                                                <div class="ratings-container">
                                                    <div class="ratings-full">
                                                        <span class="ratings" style="width: 100%;"></span>
                                                        <span class="tooltiptext tooltip-top"></span>
                                                    </div>
                                                </div>
                                                <div class="store-address-grid">
                                                    <b>
                                                    {{ $vendorcreate->address }} , <br>
                                                    {{-- {{ $vendorcreate->address }} , <br> --}}
                                                    {{ $vendorcreate->city }}  - {{ $vendorcreate->pincode }} ,  <br>
                                                    {{ $vendorcreate->state }} . <br>
                                                    <i class="w-icon-phone"></i> {{ $vendorcreate->mobile_number1 }}
                                                    </b>
                                                </div>
                                            
                                            </div>
                                            <div class="store-footer">
                                                <figure class="seller-brand">
                                                    <img src="{{ asset('assets/images/vendor/profile/' . $vendorcreate->profile_image) }}" alt="Brand" width="80" height="80" />
                                                </figure>
                                                <a href=" {{ url('/offer-products/'.$vendorcreate->id) }}" class="btn btn-dark btn-link btn-underline btn-icon-right btn-visit">
                                                <b>Visit Store</b> <i class="w-icon-long-arrow-right"></i></a>
                                            </div>
                                        </div>
                                    </div> -->
                                    <div class="store-wrap mb-4">
                            <div class="store store-grid">
                               <div class="store-header custom-split">
                                    <div class="store-left">
                                        <h4 class="store-title">
                                            <a href="{{ url('/shop-details/'.$vendorcreate->id) }}">
                                                {{ $vendorcreate->shop_name }}
                                            </a>
                                        </h4>

                                        <div class="ratings-container">
                                            <div class="ratings-full">
                                                <span class="ratings" style="width:100%;"></span>
                                            </div>
                                        </div>

                                        <div class="store-address-grid">
                                            
                                                {{ $vendorcreate->address }} , <br>
                                                {{ $vendorcreate->city }} - {{ $vendorcreate->pincode }} , <br>
                                                {{ $vendorcreate->state }} . <br>
                                                <i class="w-icon-phone"></i> {{ $vendorcreate->mobile_number1 }}
                                            
                                        </div>
                                <!-- 
                                        <a href="{{ url('/shop-details/'.$vendorcreate->id) }}" class="btn btn-dark mt-3">
                                            VISIT STORE
                                        </a> -->
                                    </div>

                                    <div class="store-right">
                                        <img src="{{ asset('assets/images/vendor/profile/' . $vendorcreate->profile_image) }}" alt="">
                                    </div>
                                </div>

                                
                                <div class="store-footer">
                                    <figure class="seller-brand">
                                        <img src="{{ asset('assets/images/vendor/profile/' . $vendorcreate->profile_image) }}" alt="Brand" width="80" height="80" />
                                    </figure>
                                    <a href=" {{ url('/shop-details/'.$vendorcreate->id) }}" class="btn btn-dark btn-link btn-underline btn-icon-right btn-visit">
                                       <b>Visit Store</b> <i class="w-icon-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                            @endforeach
                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>

 @endsection