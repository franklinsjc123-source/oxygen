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

                        <?php if($offer_id !=''){  ?>
                            <li><a href="{{ url( 'offer-products/'.$vendor_id ) }}"> <?= $offer_name ?> </a> </li>
                        <?php  } else {  ?>
                            <li><a href="{{ url( 'offer-products') }}"> All </a> </li>
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
                            <div class="toolbox vendor-toolbox pb-0">
                            
                                <div class="toolbox-left mb-4 mb-md-0">
                                    {{-- <a href="#" class="btn btn-primary btn-outline btn-rounded btn-icon-left "><i class="w-icon-category"></i>VENDORS</a> --}}
                                    {{-- <label class="d-block">Total Store Showing 6</label> --}}
                                    <h2><label class="d-block">Offer Products </label></h3><h4><?=  $offer_name ? '( ' . $offer_name. ' )' :''  ?></h4>
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
                                         @include('frontend/product-card', ['product' => $product, 'showStockCount' => true])
                                     @endforeach
                                 @endif
                           
                        </div>
                    </div>
                </div>
            </div>
        </main>

 @endsection