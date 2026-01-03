
@include('website.front-end.newhead')
 
{{-- @include('website.front-end.newheader') --}}
   <!-- header end -->


   @include('website.partials.js.frontendjs')
   @include('paritials.js.userwebsite.cart_js')
   @include('website.partials.css.frontendcss');
  

   <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
<style>
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

<body class="theme-color-29">
   <div id="loading-container">
       <div class="loader"></div>
   </div>

   <!-- loader start -->
   
   <!-- loader end -->

<!-- header start -->
   @include('paritials.website.header')
    <!-- section start -->
    <style>
        .count1{
        outline: none;
        }
        </style>
    <section class="section-b-space">
        <div class="container">
            <div class="checkout-page">
                <div style="margin-top:185px;" class="checkout-form">

                    {{-- @if(session('cart'))
                    @dd(session('cart'));
                    @endif --}}
                    @php $user_info="App\Models\User"::where('id',session('userId'))->first();
                    
                    @endphp
                    
                    <form action="{{ route('placeorder') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <div class="checkout-title">
                                    <h3>Billing Details</h3>
                                </div>
                                <div class="row check-out">
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <div class="field-label">First Name</div>
                                        <input type="text" name="firstname" value="{{ @$user_info->firstName}}" placeholder="">
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <div class="field-label">Last Name</div>
                                        <input type="text" name="lastname" value="{{ @$user_info->lastName}}" placeholder="">
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <div class="field-label">Phone</div>
                                        <input type="text" name="phone" value="{{ @$user_info->phone}}" placeholder="">
                                    </div>
                                    <div class="form-group col-md-6 col-sm-6 col-xs-12">
                                        <div class="field-label">Email Address</div>
                                        <input type="text" name="email" value="{{ @$user_info->email}}" placeholder="">
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="field-label">Country</div>
                                        <select name= "country">
                                            <option value="india">India</option>
                                            <option>South Africa</option>
                                            <option>United State</option>
                                            <option>Australia</option>
                                        </select>
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="field-label">Address</div>
                                        <input type="text" name="address" value="{{ @$user_info->address}}" placeholder="Street address">
                                    </div>
                                    <div class="form-group col-md-12 col-sm-12 col-xs-12">
                                        <div class="field-label">Town/City</div>
                                        <input type="text" name="town" value="{{ @$user_info->town}}" placeholder="">
                                    </div>
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <div class="field-label">State / County</div>
                                        <input type="text" name="state" value="{{ @$user_info->state}}" placeholder="">
                                    </div>
                                    <div class="form-group col-md-12 col-sm-6 col-xs-12">
                                        <div class="field-label">Postal Code</div>
                                        <input type="text" name="postelcode" value="{{ @$user_info->postelcode}}" placeholder="">
                                    </div>
                                    <div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                        <input type="checkbox" name="account-option" id="account-option" value="Update"> &ensp;
                                        <label for="account-option">Are You Update Address?</label>
                                    </div>
                                </div>
                                
                                
                            </div>
                            <div class="col-lg-6 col-sm-12 col-xs-12">
                                <div class="checkout-details">
                                    <div class="order-box">
                                        <div class="title-box">
                                            <div>Product <span>Total</span></div>
                                        </div>
                                        <ul class="qty">

                                        @php $total = 0;$cart=0;
                                        $totaldt = 0;
                                        $gtot1 = 0;
                                        $gtot = 0;
                                        $total1=0;
                                        $gst = 0;    
                                            @endphp
                                        @if(session('cart'))
                                        
                                        @foreach(session('cart') as $id => $details)

                                            @php $total += $details['price'] * $details['qty']; $cart++;
                                           if($total < 600)
                                            {
                                                $shipping = 40;
                                            }
                                            else 
                                            {
                                                $shipping = 0;
                                            }

                                            @endphp

                                            <li>{{ $details['name'] }} × {{ $details['qty'] }} <span>Rs {{ $details['price'] * $details['qty'] }}</span></li>
                                              <?php                                        
                                                $price = floatval($details['price']);
                                                $qty = intval($details['qty']);
                                                $gst = floatval($details['gst']);

                                                if (is_numeric($price) && is_numeric($qty) && is_numeric($gst)) {
                                                    $gstAmount = $price * $qty * $gst / 100;
                                                    echo "<li>GST: <span>" . $gstAmount . "</span></li>";
                                                } else {
                                                    echo "Invalid input data. Please check the values of price, qty, and gst.";
                                                }
                                            

                                                ?>
                                           
                                            @php
                                            $total1 = $details['price'] * $details['qty'];
                                            $gsttot = $price * $qty * $gst / 100;
                                            $gst = $details['gst'];
                                            $gtot = $total1 - $gsttot;
                                            $gtot1 += $gtot + $gsttot;
                                          
                                            @endphp
                                            <li>Product Price: <span>Rs {{$gtot}}</span></li>

                                            {{-- <li>Top × 1 <span>Rs 599</span></li> --}}
                                            {{-- <input type="hidden" value="{{$total}}" name="total"> --}}
                                            {{-- <input type="hidden" value="{{ $details['name'] }}" name="productname">
                                            <input type="hidden" value="{{ $details['qty'] }}" name="productqty">
                                            <input type="hidden" value="{{ $details['price'] }}" name="productprice"> --}}
                                         @endforeach
                                         @else
                                         @endif
                                        </ul>
                                        <ul class="sub-total">

                                            <?php
                                            //dd($total);
                                            if($gtot1 < 600)
                                                {
                                                    $shipping = 40;
                                                }
                                            else 
                                                {
                                                    $shipping = 0;
                                                }
                                            ?>
                                            <li>Subtotal <span class="count">Rs{{$gtot1}} </span></li>
                                             <li>Shipping
                                                <div class="shipping">
                                                    <div class="shopping-option">
                                                        <?php
                                                        // $shipping = 40;
                                                        ?>
                                                        <label for="free-shipping">Rs {{ $shipping }}</label>
                                                    </div>
                                                    
                                                </div>
                                            </li>
                                            {{-- <li>GST
                                                <div class="shipping">
                                                    <div class="shopping-option">
                                                        <?php
                                                        $gst = 10;
                                                        ?>
                                                         <span class="count">Rs{{ $gst }}</span>
                                                    </div>
                                                    
                                                </div>
                                            </li> --}}
                                            <li>
                                                
                                                <label for="html">Discount</label>
                                                <span class="count" id="discount1">
                                                    <input type="hidden" style ="border: 0px solid; color:grey" class="discount1" id="discount1" value="0" readonly></span>
                                                {{-- <span class="count"></span> --}}
                                                </li>
                                        </ul>
                                        <ul class="total">
                                            <li>Total 
                                                
                                                <span class="count1" id="count1">Rs {{ $gtot1 +  $shipping}}
                                                    <input type="hidden" style ="border: 0px solid; color:grey" class="count1" id="count1" value="{{ $gtot1 +  $shipping}}" readonly>
                                                    <span>
                                                {{-- <span class="count" id ="count">Rs {{ $total +  $shipping }}</span>  --}}
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="payment-box">
                                        <div class="upper-box">
                                            <div class="payment-options">
                                                <ul>
                                                    <li>
                                                        <div class="radio-option">
                                                            <input type="radio" name="payment-group" value ="onlinepayment" id="payment-1"
                                                                checked="checked">
                                                            <label for="payment-1">Online Payments<span
                                                                    class="small-text">Please send a check to Store
                                                                    Name, Store Street, Store Town, Store State /
                                                                    County, Store Postcode.</span></label>
                                                        </div>
                                                    </li>
                                                    <li>
                                                        <div class="radio-option">
                                                            <input type="radio" name="payment-group" value ="cashondelivery" id="payment-2">
                                                            <label for="payment-2">Cash On Delivery<span
                                                                    class="small-text">Please send a check to Store
                                                                    Name, Store Street, Store Town, Store State /
                                                                    County, Store Postcode.</span></label>
                                                        </div>
                                                    </li>
                                                    <?php
                                                     
                                                     $grandtoto = $total +  $shipping;
                                                    //  dd($grandtoto);
                                                    ?>
                                                    {{-- @if( $grandtoto > 1000) --}}
                                                    <label for="Coupon">Coupon Code</label>
                                                        
                                                    {{-- <input type="text" value="" name="couban" id="couban"> --}}
                                                    {{-- @endif --}}
                                                    <input type="text"
                                                        class="discount-code" id="discountCode"
                                                        name="discountCode" size="15"
                                                        placeholder="Enter Coupon Code" /><button
                                                        id="btnDiscountAction" type="submit"
                                                        value="Apply Discount" class="btnDiscountAction">Apply Coupon</button>
                                                 
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                         <input type="hidden" value="{{$gtot1}}" name="total" id="total">
                                        <input type="hidden" value="{{$total1}}" name="total1" id="total1">
                                        <input type="hidden" value="{{$shipping}}" name="shipping" id="shipping">
                                        <input type="hidden" value="{{ $gtot1 +  $shipping }}" name="grandtotal" id="grandtotal">
                                        <input type="hidden" value="" name="discount2" id="discount2">
                                        <input type="hidden" value="{{$gst}}" name="gst" id="gst">
                                        <div class="text-end">
                                            {{-- <a href="order-success.php" class="btn-solid btn">Place Order</a> --}}
                                            <input class="btn-solid btn" type="submit" value="Place Order">
                                        </div>
                                        {{-- <div class="text-end"><a href="order-success.php" class="btn-solid btn">Place Order</a></div> --}}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- section end -->
    
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script>
        // $(document).ready(function() {
            
          $("#btnDiscountAction").click(function(e) {
            e.preventDefault();
           
            var gtotal = $("#grandtotal").val();
            var discount = $("#discount1").val();
         alert(discount);
            var netamt = gtotal- discount;
            var dcode =  $("#discountCode").val();
           

            $.ajax({

            url: '{{route("discountoffere")}}',
            type: "GET",
            data: {
                "_token": "{{ csrf_token() }}",
                "dcode": dcode

            },

            dataType: "json",
            success: function (data) {
                 console.log(data);
                 var enddate = data.end_date;
                 var startdate = data.start_date;
                 alert(startdate)
              //  var da1 = date.toISOString();
                // alert(enddate);
                // alert(startdate);
                //  var date1 = new Date();
                //  var da =  date1.toJSON();
                 const currentDate = new Date();

                const year = currentDate.getFullYear();
                const month = String(currentDate.getMonth() + 1).padStart(2, '0'); // Months are 0-based, so we add 1 and pad with '0' if needed.
                const day = String(currentDate.getDate()).padStart(2, '0');
                const hours = String(currentDate.getHours()).padStart(2, '0');
                const minutes = String(currentDate.getMinutes()).padStart(2, '0');
                const now = `${year}-${month}-${day}T${hours}:${minutes}`;

               // alert(now);

                //  console.log(da);
                //  alert(da);
                var discountamt = data.dis_amt;
              //  alert(discountamt);
                if (now >= startdate && now <= enddate || (startdate === null && enddate === null))
                 {

                    $("#discount1").val(0);
                    $("#discount2").val(0);
            
                    //  alert(discountamt);
                    // $("#grandtotal").val(netamt);
                    $("#discount1").val(discountamt);
                    $("#discount2").val(discountamt);

                    var dis = $("#discount1").val();
                    var gtotal = $("#grandtotal").val();
             $("#grandtotal").val(gtotal);
            // alert(dis);
            // exit;
            alert(discountamt);
             if(isNaN(discountamt)){
                var netamt1 = gtotal;
              // alert(netamt1);
              $("#count1").val(netamt1);
              $("#discount2").val(discountamt);
             }
              else
              {
                var netamt1 = gtotal-dis;
               
                 $("#count1").val(netamt1);
                 $("#discount2").val(discountamt);
              }

            
            //  alert(gtotal);
              
            
             
                }
               else{

                $("#discountCode").hide();
                    $("#btnDiscountAction").hide();
                    alert('Coupan Expired');
                     var dis = $("#discount1").val(0);
                     //alert(dis);
                     var dis = $("#discount2").val(0);
             
            }
            },
            error: function (data) {
                console.log('Error:', data);
            }
            });


          });
        // });

</script>


@include('website.front-end.newfooter')
