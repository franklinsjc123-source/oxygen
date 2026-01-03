
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
                <div class="checkout-form">

                    
                    @php $user_info="App\Models\User"::where('id',session('userId'))->first();
                    
                    @endphp
                    
                    <form action="{{ route('UpdateUserProfile') }}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-3"></div>
                                <div class="col-lg-6 col-sm-12 col-xs-12">
                                <div class="checkout-title">
                                    <h3>User Settings</h3>
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
                                        <label for="account-option">Are Confirm To Update?</label>
                                    </div>
                                    <input type="hidden" name="userId" value="{{ @session('userId') }}" placeholder="">
                                    
                                    <input class="btn-solid btn" type="submit" value="Update">
                                        
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
                 console.log(data.end_date);
                 var date = data.end_date;
              //  var da1 = date.toISOString();
                // alert(date);
                 var date1 = new Date();
                   var da =  date1.toJSON();
                 console.log(da);
                // alert(da);
                var discountamt = data.dis_amt;
               // alert(discountamt);
                if(da !== data.end_date)
                {
                    $("#discountCode").hide();
                    $("#btnDiscountAction").hide();
                    alert('Coupan Expired');
                     var dis = $("#discount1").val(0);
                     //alert(dis);
                     var dis = $("#discount2").val(0);
                }
               else{
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
             if(isNaN(discountamt)){
                var netamt1 = gtotal;
               // alert(netamt1);
                
             }
              else
              {
                var netamt1 = gtotal-dis;
                // alert(netamt1);
               
              }

            
            //  alert(gtotal);
                $("#count1").val(netamt1);
            
            
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
