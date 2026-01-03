 @extends('app_template')
 @section('title','Vendor Store Grid')
 @section('content')


 <!-- Start of Main -->
        <main class="main">
            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb mb-6">
                        <li><a href="demo1.html">Home</a></li>
                        <li><a href="{{ route('vendorDokenGrid') }}">Vendor</a></li>
                       
                    </ul>
                </div>
            </nav>

            <div class="page-content mb-8">
                <div class="container">
                    <div class="toolbox vendor-toolbox pb-0">
                    
                        <div class="toolbox-left mb-4 mb-md-0">
                            {{-- <a href="#" class="btn btn-primary btn-outline btn-rounded btn-icon-left "><i class="w-icon-category"></i>VENDORS</a> --}}
                            {{-- <label class="d-block">Total Store Showing 6</label> --}}
                            <h3><label class="d-block">VENDORS</label></h3>
                        </div>
                        <div class="toolbox-right">
                            <div class="toolbox-item toolbox-sort select-box mb-0">
                                <label class="font-weight-normal">Sort by:</label>
                                <select name="orderby" class="form-control">
                                    <option value="default" selected="selected">Default</option>
                                    <option value="recent">Most Recent</option>
                                    <option value="popular">Most Popular</option>
                                </select>
                            </div>
                   
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

                        <div class="store-wrap mb-4">
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
                                        <a href=" {{ url('/vendorDetails/'.$vendorcreate->id) }}">{{ $vendorcreate->shop_name }}</a>
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
                                    <a href=" {{ url('/vendorDetails/'.$vendorcreate->id) }}" class="btn btn-dark btn-link btn-underline btn-icon-right btn-visit">
                                       <b>Visit Store</b> <i class="w-icon-long-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                @endforeach
                    
                    </div>
                </div>
            </div>
        </main>
@endsection