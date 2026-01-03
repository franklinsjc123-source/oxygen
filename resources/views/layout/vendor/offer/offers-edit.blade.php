@extends('layout.auth.master')
@section('contents')
    @include('paritials.auth.header')
    @include('paritials.js.offer.offer-create-js')
    @include('paritials.js.time-js')
    <!-- page-wrapper Start-->
    @include('paritials.auth.topmenu')
    <!-- Page Header Ends -->

    <!-- Page Body Start-->
    <div class="page-body-wrapper">

        <!-- Page Sidebar Start-->
        @include('paritials.vendorauth.sidemenu');
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
                                <h3>Offer Edit

                                </h3>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <ol class="breadcrumb pull-right">
                                <li class="breadcrumb-item"><a href="dashboard.php"><i data-feather="home"></i></a></li>

                                <li class="breadcrumb-item active">Offer Edit</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Container-fluid Ends-->

            <!-- Container-fluid starts-->
            <div class="container">
                <div class="col-sm-9">
                    <div class="card">
                        <div class="card-body">
							@if ($errors->any())    
								<ul>
								@foreach ($errors->all() as $error)
									<li>{{ $error }}</li>
								@endforeach
								</ul>
							@endif
                            <form id="frmOffer" name="frmOffer" class="needs-validation" method="POST" action="{{ route('vendoroffer.main.update', $offer->id) }}">
							 @method('PUT');
                                @csrf	

                                    <?php 
                                    if(!empty($_GET['type'])){ $selected = $_GET['type'];}
                                    //else{ $selected = 'home';}
                                    ?>

                                    
                                    {{-- <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group row">
                                                <div class="col-md-12">
                                                    <label class="form-group mb-3"><b>Offer Title</b></label>
                                                    <input class="form-control" id="offertitle" name="offertitle" type="text"
                                                    value="{{$offer->title}}"   required="">
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label class="mb-3"><b>Offer Type</b></label>
                                                <div class="col-md-12">
                                                    <div class="checkbox-primary">
                                                        <label class="d-block mb-2" for="edo-ani12">
                                                            <input class="radio_animated" onchange="buyxgety();"
                                                            {{$offer->type == 'Buy X Get Y Free'?'checked':'' }}                                                            
                                                                type="radio" id="type1" name="type" value="Buy X Get Y Free">
                                                            Buy X Get Y Free
                                                        </label>
    
                                                        <label class="d-block mb-2" for="edo-ani12">
                                                            <input class="radio_animated" onchange="buyxaty();"
                                                            <?php echo ($offer->type == 'Buy X @ Y')?'checked':'' ?>
                                                                type="radio" name="type" value="Buy X @ Y">
                                                            Buy X @ Y
                                                        </label>
    
                                                        <label class="d-block mb-2" for="edo-ani12">
                                                            <input class="radio_animated" onchange="cashbackoffer();"
                                                            <?php echo ($offer->type == 'Cashback Offer')?'checked':'' ?>
                                                                type="radio" name="type" value="Cashback Offer">
                                                            Cashback Offer
                                                        </label>
                                                        <label class="d-block mb-2" for="edo-ani12">
                                                            <input class="radio_animated" onchange="freedelivery();"
                                                            <?php echo ($offer->type == 'Free Delivery')?'checked':'' ?>
                                                                type="radio" name="type" value="Free Delivery">
                                                            Free Delivery
                                                        </label>
                                                        <label class="d-block mb-2" for="edo-ani12">
                                                            <input class="radio_animated"  type="radio" onchange="fixeddiscount();" 
                                                            <?php echo ($offer->type == 'Fixed Discount')?'checked':'' ?>
                                                                name="type" value="Fixed Discount">
                                                            Fixed Discount
                                                        </label>                    
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
                                    {{-- <script>

                                        var button1 = document.getElementById("type1");
                                        var button2 = document.getElementById("button2");

                                                             
                                        if (button1.checked){
                                            
                                            buyxaty();
                                         document.getElementById('buyxaty').style.display = 'none';
                                         document.getElementById('buyxgetydiv').style.display = 'block';
                                         document.getElementById('cashbackdiv').style.display = 'none';                                   
                                         document.getElementById('fixed_discount').style.display = 'none';
                                            
                                        }else if (button2.checked) {
                                            alert("radio2 selected");
                                        }
                                         buyxaty();
                                        
                                        function buyxaty(){	
                                            alert("radfjgfjgfhjghkio1 selected");
                                        	document.getElementById('buyxaty').style.display = 'block';
                                        	document.getElementById('buyxgetydiv').style.display = 'none';
                                        	document.getElementById('cashbackdiv').style.display = 'none';
                                        // 	document.getElementById('per_value').style.display = 'none';
                                        //   document.getElementById('amt_value').style.display = 'none';
                                        document.getElementById('fixed_discount').style.display = 'none';
                                         }
                                    </script> --}}
                                   
                {{-- Edit Row --}}
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group row">
                                            <div class="col-md-12">
                                                <label class="form-group mb-3"><b>Offer Title</b></label>

                                                <input class="form-control" id="offertitle" name="offertitle" type="text"
                                                value="{{$offer->title}}"    required="">
                                            </div>

                                        </div>
                                        <div class="form-group row">
                                            <label class="mb-3"><b>Offer Type</b></label>
                                            <div class="col-md-12">
                                                <div class="checkbox-primary">


                                                    <label class="d-block mb-2" for="edo-ani12">
                                                        @if ($offer->type == "Buy X Get Y Free")
                                                        <input class="radio_animated" onchange="buyxgety();" checked=""
                                                        type="radio" id="type" name="type" value="Buy X Get Y Free">
                                                        Buy X Get Y Free

                                                        @else
                                                        <input class="radio_animated" onchange="buyxgety();" 
                                                            type="radio" id="type" name="type" value="Buy X Get Y Free">
                                                        Buy X Get Y Free
                                                                                                                
                                                        @endif
                                                    </label>

                                                    <label class="d-block mb-2" for="edo-ani12">
                                                        @if ($offer->type == "Buy X @ Y")
                                                        <input class="radio_animated" onchange="buyxaty();" checked=""
                                                            type="radio" id="type" name="type" value="Buy X @ Y">
                                                        Buy X @ Y
                                                        @else
                                                        <input class="radio_animated" onchange="buyxaty();" 
                                                            type="radio" id="type" name="type" value="Buy X @ Y">
                                                            Buy X @ Y
                                                        @endif
                                                    </label>

                                                    <label class="d-block mb-2" for="edo-ani12">
                                                        @if ($offer->type == "Cashback Offer")
                                                        <input class="radio_animated" onchange="cashbackoffer();" checked=""
                                                            type="radio" id="type" name="type" value="Cashback Offer">
                                                        Cashback Offer
                                                        @else
                                                        <input class="radio_animated" onchange="cashbackoffer();"
                                                            type="radio" id="type" name="type" value="Cashback Offer">
                                                            Cashback Offer
                                                            @endif
                                                    </label>
                                                    <label class="d-block mb-2" for="edo-ani12">
                                                        @if ($offer->type == "Free Delivery")
                                                        <input class="radio_animated" onchange="freedelivery();" checked=""
                                                            type="radio" id="type" name="type" value="Free Delivery">
                                                        Free Delivery
                                                        @else
                                                        <input class="radio_animated" onchange="freedelivery();" 
                                                            type="radio" id="type" name="type" value="Free Delivery">
                                                        Free Delivery
                                                            @endif
                                                    </label>
                                                    <label class="d-block mb-2" for="edo-ani12">
                                                        @if ($offer->type == "Fixed Discount")
                                                        <input class="radio_animated"  type="radio" onchange="fixeddiscount();" checked="" 
                                                            name="type" value="Fixed Discount">
                                                        Fixed Discount
                                                        @else
                                                        <input class="radio_animated"  type="radio" onchange="fixeddiscount();" 
                                                            name="type" value="Fixed Discount">
                                                        Fixed Discount
                                                        @endif
                                                    </label>   
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>

                    @if ($offer->type == "Buy X Get Y Free")
                    <div class="card" id="buyxgetydiv" style="display: block;" >
                        <div class="card-body">
                            <div class="form-group row ">
                                <div class="col-md-4">
                                    <label class="fw-bold">Buy</label>
                                    <input class="form-control" id="BuyOffer" name="BuyOffer" type="text" value="{{$offer->buy}}">
                                </div>
                                <div class="col-md-1 text-center mt-3">
                                    <span class="h4 ">+</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="fw-bold">Get</label>                                    
                                    <input class="form-control" id="GetOffer1" name="GetOffer1" type="text" value="{{$offer->getoffer}}">
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="card" id="buyxgetydiv" style="display: none;">
                        <div class="card-body">
                            <div class="form-group row ">
                                <div class="col-md-4">
                                    <label class="fw-bold">Buy</label>
                                    <input class="form-control" id="BuyOffer" name="BuyOffer" type="text" value="" >
                                </div>
                                <div class="col-md-1 text-center mt-3">
                                    <span class="h4 ">+</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="fw-bold">Get</label>                                    
                                    <input class="form-control" id="GetOffer1" name="GetOffer1" type="text" value="" >
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    

                    @if ($offer->type == "Buy X @ Y")
                    <div class="card" id="buyxaty" style="display: block;">
                        <div class="card-body">
                            <div class="form-group row ">
                                <div class="col-md-4">
                                    <label class="fw-bold">Buy Product</label>
                                    <input class="form-control" id="txtBuyOffer" name="txtBuyOffer" value="{{$offer->buyproduct}}" type="text">
                                </div>
                                <div class="col-md-1 text-center mt-3">
                                    <span class="h4 ">@</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="fw-bold">Get Amount</label>                                     
                                    <input class="form-control" id="txtGetOffer" name="txtGetOffer"  value="{{$offer->getamt}}" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="card" id="buyxaty" style="display: none;">
                        <div class="card-body">
                            <div class="form-group row ">
                                <div class="col-md-4">
                                    <label class="fw-bold">Buy Product</label>
                                    <input class="form-control" id="txtBuyOffer" name="txtBuyOffer" value="" type="text">
                                </div>
                                <div class="col-md-1 text-center mt-3">
                                    <span class="h4 ">@</span>
                                </div>
                                <div class="col-md-4">
                                    <label class="fw-bold">Get Amount</label>                                     
                                    <input class="form-control" id="txtGetOffer" name="txtGetOffer"  value="" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif



                    @if ($offer->type == "Cashback Offer")
                    <div class="card" id="cashbackdiv" style="display: block;" >
                        {{-- style="display:none" --}}
                        <div class="card-body">
                            <div class="col-md-8">
                                <label class="bold"><b>Cashback Value</b></label>
                                <div class="col-md-12">
                                    <div class="checkbox-primary">
                                        <label class="d-block" for="edo-ani12">
                                            @if ($offer->cashbacktype == "Fixed")
                                            <input class="radio_animated" type="radio" checked="" onchange="fixed();" checked=""
                                            name="cashback" value="Fixed">
                                            Fixed (₹)
                                            <div id="fixedcashback">
                                                <div class="col-md-6 px-5">
                                                    <input class="form-control " id="fixedcashback" name="fixedcashback" type="text" value="{{$offer->cashbackvalue}}">
                                                </div>
                                            </div>
                                            @else
                                            <input class="radio_animated" type="radio"  onchange="fixed();" 
                                                name="cashback" value="Fixed">
                                            Fixed (₹)
                                            <div id="fixedcashback">
                                                <div class="col-md-6 px-5">
                                                    <input class="form-control " id="fixedcashback" name="fixedcashback" type="text" >
                                                </div>
                                            </div>
                                            @endif
                                        </label>
                                        {{-- <div id="fixedcashback">
                                            <div class="col-md-6 px-5">
                                                <input class="form-control " id="fixedcashback" name="fixedcashback" type="text" value="{{$offer->cashbackvalue}}">
                                            </div>
                                        </div> --}}
                                        <label class="d-block" for="edo-ani12">
                                            @if ($offer->cashbacktype == "Percentage")
                                            <input class="radio_animated" type="radio" onchange="percentage();" checked=""
                                                name="cashback" value="Percentage">
                                            Percentage (%)
                                            <div id="percentagecashback">
                                                <div class="col-md-6 px-5">
                                                    <input class="form-control" id="percentagecashback" name="percentagecashback" type="text" value="{{$offer->cashbackvalue}}">
                                                </div>
                                            @else
                                            <input class="radio_animated" type="radio" onchange="percentage();" 
                                                name="cashback" value="Percentage">
                                            Percentage (%)
                                            <div id="percentagecashback">
                                                <div class="col-md-6 px-5">
                                                    <input class="form-control" id="percentagecashback" name="percentagecashback" type="text" >
                                                </div>
                                            @endif
                                        </label>
                                        {{-- <div id="percentagecashback">
                                            <div class="col-md-6 px-5">
                                                <input class="form-control" id="percentagecashback" name="percentagecashback" type="text" value="{{$offer->cashbackvalue}}">
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="card" id="cashbackdiv" style="display: none;">
                        {{-- style="display:none" --}}
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
                                        <div id="fixedcashback">
                                            <div class="col-md-6 px-5">
                                                <input class="form-control " id="fixedcashback" name="fixedcashback" type="text" value="">
                                            </div>
                                        </div>
                                        <label class="d-block" for="edo-ani12">
                                            
                                            <input class="radio_animated" type="radio" onchange="percentage();" 
                                                name="cashback" value="Percentage">
                                            Percentage (%)
                                            
                                        </label>
                                        <div id="percentagecashback">
                                            <div class="col-md-6 px-5">
                                                <input class="form-control" id="percentagecashback" name="percentagecashback" type="text" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if ($offer->type == "Fixed Discount")
                    <div class="card" id="fixed_discount" style="display: block;">
                        <div class="card-body">
                            <div class="col-md-8">
                                <label class="bold"><b>Fixed Discount</b></label>
                                <div class="col-md-12">
                                    <div class="checkbox-primary">
                                        <label class="d-block" for="edo-ani12">
                                            @if ($offer->discount_type == "Fixed")
                                            <input class="radio_animated" type="radio" onchange="fixedamount();" checked=""
                                                name="discount_type" value="Fixed">
                                            Fixed (₹)
                                            <div id="amounttxtvalue" >
                                                <div class="col-md-6 px-5">
                                                    <input class="form-control" id="amounttxtvalue" name="amounttxtvalue" type="number" value="{{$offer->value}}">
                                                </div>
                                            </div>
                                            @else
                                            <input class="radio_animated" type="radio" onchange="fixedamount();"
                                                name="discount_type" value="Fixed">
                                            Fixed (₹)
                                            <div id="amounttxtvalue">
                                                <div class="col-md-6 px-5">
                                                    <input class="form-control" id="amounttxtvalue" name="amounttxtvalue" type="number" value="">
                                                </div>
                                            </div>
                                            @endif
                                        </label>
                                        {{-- <div id="amounttxtvalue" style="display: none;">
                                            <div class="col-md-6 px-5">
                                                <input class="form-control" id="amounttxtvalue" name="amounttxtvalue" type="number" value="">
                                            </div>
                                        </div> --}}
                                        <label class="d-block" for="edo-ani12">
                                            @if ($offer->discount_type == "Percentage")
                                            <input class="radio_animated" type="radio" onchange="fixedpercentage();"
                                                name="discount_type" value="Percentage">
                                            Percentage (%)
                                            <div id="percentagetxtvalue" style="display: none;">
                                                <div class="col-md-6 px-5">
                                                    <input class="form-control" id="percentagetxtvalue" name="percent_value" type="number" value="{{$offer->value}}">
                                                </div>
                                            </div>
                                            @else
                                            <input class="radio_animated" type="radio" onchange="fixedpercentage();"
                                                name="discount_type" value="Percentage">
                                            Percentage (%)
                                            <div id="percentagetxtvalue" style="display: none;">
                                                <div class="col-md-6 px-5">
                                                    <input class="form-control" id="percentagetxtvalue" name="percent_value" type="number" value="">
                                                </div>
                                            </div>
                                            @endif
                                        </label>
                                        {{-- <div id="percentagetxtvalue" style="display: none;">
                                            <div class="col-md-6 px-5">
                                                <input class="form-control" id="percentagetxtvalue" name="percent_value" type="number" value="">
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @else
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
                                            <div id="amounttxtvalue">
                                                <div class="col-md-6 px-5">
                                                    <input class="form-control" id="amounttxtvalue" name="amounttxtvalue" type="number" value="">
                                                </div>
                                            </div>                                            
                                        </label>
                                        {{-- <div id="amounttxtvalue" style="display: none;">
                                            <div class="col-md-6 px-5">
                                                <input class="form-control" id="amounttxtvalue" name="amounttxtvalue" type="number" value="">
                                            </div>
                                        </div> --}}
                                        <label class="d-block" for="edo-ani12">                                            
                                            <input class="radio_animated" type="radio" onchange="fixedpercentage();"
                                                name="discount_type" value="Percentage">
                                            Percentage (%)
                                            <div id="percentagetxtvalue" style="display: none;">
                                                <div class="col-md-6 px-5">
                                                    <input class="form-control" id="percentagetxtvalue" name="percent_value" type="number" value="">
                                                </div>
                                            </div>                                           
                                        </label>
                                        {{-- <div id="percentagetxtvalue" style="display: none;">
                                            <div class="col-md-6 px-5">
                                                <input class="form-control" id="percentagetxtvalue" name="percent_value" type="number" value="">
                                            </div>
                                        </div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif




                    <div class="card">
                        <div class="card-body">
                            <div class="col-md-8">
                                
                                
                                <div class="form-group mt-2">
                                    <label for="validationCustom01" class="mb-1 fw-bold">Status</label>
                                    <select name="editstatus" class="custom-select w-100 form-control" required="">
                                        <option value="1">Active</option>
                                        <option value="0">Deactive</option>
    
                                    </select>
    
                                </div>
                               
                                <!--<div class="col-md-12">-->
                                <!--    <div class="" id="dates">-->
                                <!--        <div class="form-group row">-->
                                <!--            <div class="col-md-6">-->
                                <!--                <label class="">Start Date</label>-->
                                <!--                <input id="startdate" name="startdate" type="datetime-local" class="form-control" value="{{$offer->ActiveStartDate}}"-->
                                <!--                    placeholder="dd/mm/yy" />-->
                                <!--            </div>-->
                                            

                                <!--        </div>-->
                                <!--        <div class="form-group row">-->
                                <!--            <div class="col-md-6">-->
                                <!--                <label class="">End Date</label>-->
                                <!--                <input id="enddate" name="enddate" type="datetime-local" class="form-control" value="{{$offer->ActiveEndDate}}"-->
                                <!--                    placeholder="dd/mm/yy" />-->
                                <!--            </div>-->
                                            
                                <!--        </div>-->
                                <!--    </div>-->
                                <!--</div>-->
                            </div>
                        </div>
                    </div>

                     {{-- <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="" class="fw-bold">Add Below Sections In Offers As Well </label>
                                <div class="checkbox-primary">
                                    <label class="d-block mb-2" for="">
                                        @if ($offer->ActiveEndDate == "Fixed Discount")
                                        <input class="radio_animated" checked="" type="radio" name="offertype" value="Fixed Discount" checked="">
                                        Fixed Discount
                                        @else
                                        <input class="radio_animated" checked="" type="radio" name="offertype" value="Fixed Discount">
                                        Fixed Discount
                                        @endif                                        
                                    </label>

                                    <label class="d-block mb-2" for="">
                                        @if ($offer->ActiveEndDate == "Percentage")
                                        <input class="radio_animated" type="radio" name="offertype" value="Percentage" checked="">
                                        Percentage
                                        @else
                                        <input class="radio_animated" type="radio" name="offertype" value="Percentage">
                                        Percentage
                                        @endif
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>  --}}





                    {{-- <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label for="validationCustom02" class="mb-1 fw-bold"> Background Image :</label>
                                <input class="form-control" require="" type="file">
                            </div>
                            <div class="form-group">
                                <label for="validationCustom02" class="mb-1 fw-bold"> TEXT ALIGN :</label>
                                <input class="form-control" id="txtalign" name="txtalign" type="text" value="{{$offer->textalign}}">
                            </div>

                        </div>

                    </div> --}}

                    {{-- <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label class="d-block mb-2 fw-bold" for="">
                                    Value
                                </label>

                                <label class="d-block mb-2 " for="">
                                    Discount Amount
                                </label>
                                <input type="text" class="form-control" name="txtvalue" value="{{$offer->value}}">
                            </div>
                        </div>
                    </div> --}}

                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label class="d-block mb-2" for="">
                                    @if ($offer->types == "None")
                                    <input class="radio_animated" checked="" type="radio" onchange="nonetype();" name="types" value="None" checked="">
                                    None
                                    @else
                                    <input class="radio_animated" checked="" type="radio" onchange="nonetype();" name="types" value="None">
                                    None
                                    @endif
                                </label>

                                <label class="d-block mb-2" for="">
                                    @if ($offer->types == "Minimum Purchase Amount")
                                    <input class="radio_animated" type="radio" onchange="minimum_pusrchase_amt();" name="types" value="Minimum Purchase Amount" checked="">
                                    Minimum Purchase Amount
                                    @else
                                    <input class="radio_animated" type="radio" onchange="minimum_pusrchase_amt();" name="types" value="Minimum Purchase Amount">
                                    Minimum Purchase Amount
                                    @endif
                                </label>
                                <div id="minimum_pusrchase_amt">
                                    <div class="col-md-6 px-5">
                                        <input class="form-control" id="m_p_a" name="m_p_a" type="text"value="{{$offer->m_p_a}}" style="display:none;">
                                    </div>
                                </div>
                                {{-- <label class="d-block mb-2" for="">
                                    <input class="radio_animated" type="radio" name="types" value="Minimum Quantity Of Items">
                                    Minimum Quantity Of Items
                                </label> --}}
                            </div>
                        </div>
                    </div>
                </div>







                <div class="form-group row ">
                    <div class="text-center">
                        <div class="col-xl-8 col-md-8">
                            <button class="btn btn-primary" type="submit">Save</button>
                            <a href="{{route('vendoroffer.main.index')}}" class="btn btn-secondary" type="button">Close</a>
                        </div>
                    </div>
                    </form>
                </div>
            </div>








        </div>
        <!-- Container-fluid Ends-->

    </div>
    </div>

    <!-- footer start-->

    <!-- footer end-->

    </div>

    </div>
@endsection
