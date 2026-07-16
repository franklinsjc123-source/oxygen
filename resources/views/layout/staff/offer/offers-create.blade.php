@extends('layout.auth.master')
@section('contents')
   
    @include('paritials.js.offer.offer-create-js')
    @include('paritials.js.time-js')
    <!-- page-wrapper Start-->
    @include('paritials.auth.topmenu')
    <!-- Page Header Ends -->

    <!-- Page Body Start-->
    <div class="page-body-wrapper">

        <!-- Page Sidebar Start-->
        @include('paritials.staffauth.sidemenu');
        <!-- Page Sidebar Ends-->

        <!-- Right sidebar Start-->

<!-- Right sidebar Ends-->

        <div class="page-body">

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="page-header">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="page-header-left">
                                <h3>Offer Create

                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="{{ url('dashboard') }}"><i data-feather="home"></i></a></li>

                                <li class="breadcrumb-item active">Offer Create</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

            <!-- Container-fluid starts-->
            <div class="container-fluid">
                <div class="col-sm-12">

                    <div class="card">

                        <div class="card-body">

							@if ($errors->any())    
								<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
								</ul>
							@endif
                            <form id="frmOffer" name="frmOffer" class="needs-validation" method="POST"    enctype="multipart/form-data"  action="{{ route('staffoffer.main.store') }}">
							 @csrf	
@php
    $shops = \DB::table('vendor_details')
        ->select('user_id', 'shop_name')
        ->orderBy('shop_name', 'asc')
        ->get();
@endphp

                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <label class="form-group mb-3"><b>Shop Name</b></label>
                                                <select class="custom-select w-100 form-control" id="shop_id" name="shop_id" required>
                                                    <option value="" disabled selected>Choose Shop Name</option>
                                                    @foreach($shops as $shop)
                                                        <option value="{{ $shop->user_id }}">{{ $shop->shop_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <label class="form-group mb-3"><b>Offer Title</b></label>
                                                <input class="form-control" id="offertitle" name="offertitle" type="text"
                                                    required="">
                                            </div>
                                        </div>

                                        <div class="form-group row">
                                            <label class="mb-3"><b>Offer Type</b></label>
                                            <div class="col-md-12">
                                                <div class="checkbox-primary">
                                                    <label class="d-block mb-2" for="edo-ani12">
                                                        <input class="radio_animated" onchange="buyxgety();"
                                                            type="radio" name="type" value="Buy X Get Y Free">
                                                        Buy X Get Y Free
                                                    </label>

                                                    <label class="d-block mb-2" for="edo-ani12">
                                                        <input class="radio_animated" onchange="buyxaty();"
                                                            type="radio" name="type" value="Buy X @ Y">
                                                        Buy X @ Y
                                                    </label>

                                                    <label class="d-block mb-2" for="edo-ani12">
                                                        <input class="radio_animated" onchange="cashbackoffer();"
                                                            type="radio" name="type" value="Cashback Offer">
                                                        Cashback Offer
                                                    </label>
                                                    <!--<label class="d-block mb-2" for="edo-ani12">-->
                                                    <!--    <input class="radio_animated" onchange="freedelivery();"-->
                                                    <!--        type="radio" name="type" value="Free Delivery">-->
                                                    <!--    Free Delivery-->
                                                    <!--</label>-->
                                                    <label class="d-block mb-2" for="edo-ani12">
                                                        <input class="radio_animated"  type="radio" onchange="fixeddiscount();" 
                                                            name="type" value="Fixed Discount">
                                                        Fixed Discount
                                                    </label>
                                                </div>
                                            </div>
                                        </div>


                                       
                                    </div>
                                </div>
                        </div>
                    </div>




                    <div class="card" id="buyxgetydiv" style="display: none;">
                        <div class="card-body">
                            <div class="form-group row ">
                                <div class="col-md-4">
                                    <label class="fw-bold">Buy</label>
                                    <input class="form-control" id="BuyOffer" name="BuyOffer" type="text">
                                </div>
                                <div class="col-md-1 text-center mt-3">
                                    <span class="h4 ">+</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="fw-bold">Get </label>
                                    <input class="form-control" id="GetOffer1" name="GetOffer1" type="text" >
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="card" id="buyxaty" style="display: none;">
                        <div class="card-body">
                            <div class="form-group row ">
                                <div class="col-md-4">
                                    <label class="fw-bold">Buy Product</label>
                                    <input class="form-control" id="txtBuyOffer" name="txtBuyOffer" type="text">
                                </div>
                                <div class="col-md-1 text-center mt-3">
                                    <span class="h4 ">@</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="fw-bold">Get Amount</label>
                                    <input class="form-control" id="txtGetOffer" name="txtGetOffer" type="text">
                                </div>
                            </div>
                        </div>
                    </div>




                    <div class="card" id="cashbackdiv" style="display: none;">
                        <div class="card-body">
                            <div class="col-md-8">
                                <label class="bold"><b>Cashback Value</b></label>
                                <div class="col-md-12">
                                    <div class="checkbox-primary">
                                        <label class="d-block" for="edo-ani12">
                                            <input class="radio_animated" type="radio"  onchange="fixed();"
                                                name="cashback" value="Fixed">
                                            Fixed (₹)
                                        </label>
                                        <div id="fixedcashback" style="display: none;">
                                            <div class="col-md-6 px-5">
                                                <input class="form-control" id="fixedcashback" name="fixedcashback" type="number" value="">
                                            </div>
                                        </div>
                                        <label class="d-block" for="edo-ani12">
                                            <input class="radio_animated" type="radio" onchange="percentage();"
                                                name="cashback" value="Percentage">
                                            Percentage (%)
                                        </label>
                                        <div id="percentagecashback" style="display: none;">
                                            <div class="col-md-6 px-5">
                                                <input class="form-control" id="percentagecashback" name="percentagecashback" type="number" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card" id="fixed_discount" style="display: none;">
                        <div class="card-body">
                            <div class="col-md-8">
                                <label class="bold"><b>Fixed Discount</b></label>
                                <div class="col-md-12">
                                    <div class="checkbox-primary">
                                        <label class="d-block" for="edo-ani12">
                                            <input class="radio_animated" type="radio" onchange="fixedamount();"
                                                name="discount_type" value="Fixed">
                                            Fixed (₹)
                                        </label>
                                        <div id="amounttxtvalue" style="display: none;">
                                            <div class="col-md-6 px-5">
                                                <input class="form-control" id="amounttxtvalue" name="amounttxtvalue" type="number" value="">
                                            </div>
                                        </div>
                                        <label class="d-block" for="edo-ani12">
                                            <input class="radio_animated" type="radio" onchange="fixedpercentage();"
                                                name="discount_type" value="Percentage">
                                            Percentage (%)
                                        </label>
                                        <div id="percentagetxtvalue" style="display: none;">
                                            <div class="col-md-6 px-5">
                                                <input class="form-control" id="percentagetxtvalue" name="percent_value" type="number" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>





                    <div class="card" >
                        <div class="card-body">
                            <div class="col-md-8">
                                
                                 <div class="form-group mt-2">
                                        <label for="validationCustom01" class="mb-1 fw-bold">Status</label>
                                        <select name="status" class="custom-select w-100 form-control" required="">
                                            <option value="1">Active</option>
                                            <option value="0">Deactive</option>
        
                                        </select>
        
                                    </div>

                            </div>
                        </div>

                    </div>





                    <div class="card">

                        <div class="card-body">
                            <div class="form-group">
                                <label for="" class="fw-bold">Minimum Requirment </label>

                                <label class="d-block mb-2" for="">
                                    <input class="radio_animated" checked="" type="radio" onchange="nonetype();" name="types" value="None">
                                    None
                                </label>

                                <label class="d-block mb-2" for="">
                                    <input class="radio_animated" type="radio" onchange="minimum_pusrchase_amt();" name="types" value="Minimum Purchase Amount">
                                    Minimum Purchase Amount
                                </label>
                                <div id="minimum_pusrchase_amt">
                                    <div class="col-md-6 px-5">
                                        <input class="form-control" id="m_p_a" name="m_p_a" type="text" style="display:none;">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>







                <div class="form-group row ">
                    <div class="text-center">
                        <div class="col-xl-8 col-md-8">
                            <button class="btn btn-primary" type="submit">Save</button>
                            <a href="{{route('staffoffer.main.index')}}" class="btn btn-secondary " type="button">Close</a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>








        </div>
        <!-- Container-fluid Ends-->

    </div>
    </div>

    </div>

    </div>
@endsection
