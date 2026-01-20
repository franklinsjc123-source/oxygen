 @extends('app_template')
 @section('title','Vendor Store Grid')
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
                    <ul class="breadcrumb mb-6">
                        <li><a href="demo1.html">Home</a></li>
                        <li><a href="{{ route('shops') }}">Shops</a></li>
                       
                    </ul>
                </div>
            </nav>

            <div class="page-content mb-8">
                <div class="container">
                    <div class="toolbox vendor-toolbox pb-0">
                    
                        <div class="toolbox-left mb-4 mb-md-0">
                            {{-- <a href="#" class="btn btn-primary btn-outline btn-rounded btn-icon-left "><i class="w-icon-category"></i>VENDORS</a> --}}
                            {{-- <label class="d-block">Total Store Showing 6</label> --}}
                            <h3><label class="d-block">SHOPS</label></h3>
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
                               <div class="store-header custom-split">
    <div class="store-left">
        <h4 class="store-title">
            <a href="{{ url('/vendorDetails/'.$vendorcreate->id) }}">
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
        <a href="{{ url('/vendorDetails/'.$vendorcreate->id) }}" class="btn btn-dark mt-3">
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