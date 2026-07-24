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

  /* ── Selected / Active Offer ── */
  @keyframes glowing-border {
      0% { box-shadow: 0 0 10px #ff7b00, 0 0 15px rgba(255, 123, 0, 0.6); }
      50% { box-shadow: 0 0 20px #ff0055, 0 0 30px rgba(255, 0, 85, 0.8); }
      100% { box-shadow: 0 0 10px #ff7b00, 0 0 15px rgba(255, 123, 0, 0.6); }
  }

  .category-ellipse.sc-active .category-media {
      position: relative;
      border-radius: 50%;
      padding: 4px;
      background: linear-gradient(135deg, #ff7b00 0%, #ff0055 50%, #764ba2 100%);
      animation: glowing-border 2s infinite;
      transition: all 0.35s cubic-bezier(.25,.8,.25,1);
  }
  .category-ellipse.sc-active .category-media img {
      border-radius: 50%;
      border: 3px solid #fff;
  }
  .category-ellipse.sc-active {
      transform: scale(1.15) translateY(-5px);
      transition: transform 0.35s cubic-bezier(.25,.8,.25,1);
      position: relative;
      z-index: 10;
  }
  .category-ellipse.sc-active .category-name a {
      color: #ff0055 !important;
      font-weight: 800 !important;
      letter-spacing: 0.5px;
      text-transform: uppercase;
      font-size: 1.05rem;
      text-shadow: 0px 2px 4px rgba(255, 0, 85, 0.2);
  }
  
  /* Add a tiny floating badge on the active item */
  .category-ellipse.sc-active .category-media::after {
      content: '★';
      position: absolute;
      top: -5px;
      right: -5px;
      background: #ff7b00;
      color: #fff;
      font-size: 14px;
      line-height: 1;
      padding: 6px;
      border-radius: 50%;
      border: 2px solid #fff;
      box-shadow: 0 2px 5px rgba(0,0,0,0.2);
  }
  
  .category-media {
      width: 100px;
      height: 100px;
      margin: 0 auto;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 50% !important;
      transition: all 0.3s ease;
      aspect-ratio: 1 / 1;
      flex-shrink: 0;
  }

  .category-media img {
      width: 100%;
      height: 100%;
      object-fit: cover;
      border-radius: 50%;
      display: block;
  }

  /* Hover effect for non-active items */
  .category-ellipse:not(.sc-active):hover {
      transform: translateY(-3px);
      transition: transform 0.25s ease;
  }
  /* Mobile Category Image & Text Size reduction */
  @media (max-width: 479px) {
      .category-ellipse .category-media {
          width: 55px !important;
          height: 55px !important;
          min-width: 55px !important;
          min-height: 55px !important;
          margin: 0 auto !important;
      }
      .category-ellipse .category-media img {
          width: 100% !important;
          height: 100% !important;
          object-fit: cover !important;
      }
      .category-ellipse.sc-active .category-media {
          padding: 2px !important;
      }
      .category-ellipse.sc-active .category-media img {
          border-width: 1.5px !important;
      }
      .category-ellipse .category-name {
          font-size: 10px !important;
          line-height: 1.2 !important;
          margin-top: 4px !important;
      }
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

                    <div class="shop-default-category category-ellipse-section mb-6">
                        <div class="row gutter-lg cols-xl-8 cols-lg-7 cols-md-6 cols-sm-4 cols-xs-4 cols-4 justify-content-center mt-4">
                              
                               <div class="category-wrap mb-4">
                                 <div class="category category-ellipse {{ ($offer_id == 0) ? 'sc-active' : '' }}">
                                     <figure class="category-media">
                                        <a href="{{ url( 'offers' ) }}">
                                            <img src="{{ asset('assets/images/offer_logo/all_offer.jpeg') }}" alt="All Offers"
                                               style="background-color: #5C92C0;" />
                                        </a>
                                    </figure>
                                    <div class="category-content">
                                        <h4 class="category-name">
                                            <a href="{{ url( 'offers' ) }}">All Offers</a>
                                        </h4>
                                    </div>
                                </div>
                            </div>

                            @foreach($offer as $o )
                            <div class="category-wrap mb-4">
                                 <div class="category category-ellipse {{ ($selectedGroupKey == $o->group_key) ? 'sc-active' : '' }}">
                                     <figure class="category-media">
                                        <a href="{{ url( 'offers?id='.$o->id ) }}">
                                            <img src="{{ asset('assets/images/offer_logo/'.$o->offer_logo) }}" alt="Categroy"
                                               style="background-color: #5C92C0;" />
                                        </a>
                                    </figure>
                                    <div class="category-content">
                                        <h4 class="category-name">
                                            <a href="{{ url( 'offers?id='.$o->id ) }}">{{$o->title}}</a>
                                        </h4>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                          
                        </div>
                    </div>

                     <div class="page-content mb-8 mt-5">
                        <div class="container">
                            <div class="toolbox vendor-toolbox pb-0">
                            
                                <div class="toolbox-left mb-4 mb-md-0">
                                </div>
                               
                            </div>
                            <div class="vendor-search-wrapper">
                                <form class="vendor-search-form">
                                    <input type="email" class="form-control mr-4 bg-white" name="vendor" id="vendor"
                                        placeholder="Search Vendors" />
                                    <button class="btn btn-primary btn-rounded" type="submit">Apply</button>
                                </form>
                            </div>

                            @foreach($groupedOffers as $groupKey => $vendors)
                            <div class="mt-5 mb-2">
                                <h3 class="title title-center title-underline">{{ $groupLabels[$groupKey] ?? $groupKey }}</h3>
                            </div>
                            <div class="row cols-lg-3 cols-md-2 cols-sm-2 cols-1 mt-2">
                                @foreach($vendors as $vendor)
                                    <div class="store-wrap mb-4">
                                        <div class="store store-grid">
                                           <div class="store-header custom-split">
                                                <div class="store-left">
                                                    <h4 class="store-title">
                                                        <a href="{{ url('/vendor-offer-products/'.$vendor->id.'?ids='.($groupOfferIds[$groupKey] ?? '')) }}">
                                                            {{ $vendor->shop_name }}
                                                        </a>
                                                    </h4>

                                                    <div class="ratings-container">
                                                        <div class="ratings-full">
                                                            <span class="ratings" style="width:100%;"></span>
                                                        </div>
                                                    </div>

                                                    <div class="store-address-grid">
                                                            {{ $vendor->address }} , <br>
                                                            {{ $vendor->city }} - {{ $vendor->pincode }} , <br>
                                                            {{ $vendor->state }} . <br>
                                                            <i class="w-icon-phone"></i> {{ $vendor->mobile_number1 }}
                                                    </div>
                                                </div>

                                             

                                                <div class="store-right">
                                                       <a  href="{{ url('/vendor-offer-products/'.$vendor->id.'?ids='.($groupOfferIds[$groupKey] ?? '')) }}" >
                                                    <img src="{{ asset('assets/images/vendor/profile/' . $vendor->profile_image) }}" alt="">
                                                    </a>
                                                </div>
                                            
                                            </div>

                                            <div class="store-footer">
                                                <figure class="seller-brand">
                                                       <a  href="{{ url('/vendor-offer-products/'.$vendor->id.'?ids='.($groupOfferIds[$groupKey] ?? '')) }}" >

                                                    <img src="{{ asset('assets/images/vendor/profile/' . $vendor->profile_image) }}" alt="Brand" width="80" height="80" />
                                                    
                                                </figure>
                                                <a href="{{ url('/vendor-offer-products/'.$vendor->id.'?ids='.($groupOfferIds[$groupKey] ?? '')) }}" class="btn btn-dark btn-link btn-underline btn-icon-right btn-visit">
                                                   <b></b></a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            @endforeach

                            @if(empty($groupedOffers) || count($groupedOffers) == 0)
                            <div class="text-center mt-5 mb-5">
                                <h4>No offers available at the moment.</h4>
                            </div>
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </main>

 @endsection