<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">

    <title>Oxygen</title>

    <meta name="keywords" content="Marketplace ecommerce responsive HTML5 Template" />
    <meta name="description" content="Wolmart is powerful marketplace &amp; ecommerce responsive Html5 Template.">
    <meta name="author" content="D-THEMES">

    <!-- Favicon -->
    <link rel="icon" type="image/png" href="{{ asset('website_assets/images/icons/favicon.png')}}">

    <!-- WebFont.js -->
    <script>
        WebFontConfig = {
            google: { families: ['Poppins:400,500,600,700'] }
        };
        ( function ( d ) {
            var wf = d.createElement( 'script' ), s = d.scripts[0];
            wf.src = "{{ asset('website_assets/js/webfont.js')}}";
            wf.async = true;
            s.parentNode.insertBefore( wf, s );
        } )( document );
    </script>

    <link rel="preload" href="{{ asset('website_assets/vendor/fontawesome-free/webfonts/fa-regular-400.woff2')}}" as="font" type="font/woff2"
        crossorigin="anonymous">
    <link rel="preload" href="{{ asset('website_assets/vendor/fontawesome-free/webfonts/fa-solid-900.woff2')}}" as="font" type="font/woff2"
        crossorigin="anonymous">
    <link rel="preload" href="{{ asset('website_assets/vendor/fontawesome-free/webfonts/fa-brands-400.woff2')}}" as="font" type="font/woff2"
            crossorigin="anonymous">
    <link rel="preload" href="{{ asset('website_assets/fonts/wolmart.woff?png09e')}}" as="font" type="font/woff" crossorigin="anonymous">

    <!-- Vendor CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('website_assets/vendor/fontawesome-free/css/all.min.css')}}">

    <!-- Plugin CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('website_assets/vendor/magnific-popup/magnific-popup.min.css')}}">

    <!-- Default CSS -->
    <link rel="stylesheet" type="text/css" href="{{ asset('website_assets/css/style.min.css')}}">
	<style>
	table  tbody tr td { text-align:center;}
	</style>
</head>

<body class="my-account">
    <div class="page-wrapper">
       
        <!-- Start of Header -->
         @include('front_end.common.header')
        <!-- End of Header -->

        <main class="main">
            <!-- Start of Page Header -->
            <div class="page-header">
                <div class="container">
                    <h1 class="page-title mb-0">My Account</h1>
                </div>
            </div>
            <!-- End of Page Header -->

            <!-- Start of Breadcrumb -->
            <nav class="breadcrumb-nav">
                <div class="container">
                    <ul class="breadcrumb">
						<li><a href="{{url('/')}}">Home</a></li>
                        <li><a href="{{url('/Accounts/Myaccount')}}">My account</a></li>
						  <li><a href="{{url('/Accounts/MyOrders')}}">My Orders</a></li>
                        <li>Order Details</li>
                    </ul>
                </div>
            </nav>
            <!-- End of Breadcrumb -->

            <!-- Start of PageContent -->
            <div class="page-content pt-2">
                <div class="container">
                    <div class="tab tab-vertical row gutter-lg">
                         @include('front_end.common.myaccount_sidebar')
						 <style>
						 table, th, td {
        border: 1px solid #333;padding:10px;
    }
						</style>
                        <div class="tab-content mb-6">
                            
							<div class="row">
                                        <div class="col-md-8">
                                            <h2 class="text-center"><img src="{{ url('/website_assets') }}/images/icons/cart.png" style="width:50px;"> Order Invoice </h2>
                                        </div>
                                        <div class="col-md-4">
                                            <p class="font-weight-bold mb-1 text-right">Invoice No: <strong>{{$vieworder->order_id}}</strong> </p>
                                            <p class="text-muted text-right">Invoice Date: <strong>{{date('d-m-Y',strtotime($vieworder->order_date))}}</strong></p>
                                        </div>
                                        <!-- End Col -->
                                    </div>

                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title"><i class="fa fa-info-circle"></i> Invoice (#{{$vieworder->order_id}}) </h4>
                                        </div>
                                        <div class="panel-body card">
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <td style="width: 50%;" class="text-left">
                                                            <h4 class="panel-title">Customer Information</h4>
                                                        </td>
                                                        <td style="width: 50%;" class="text-left">
                                                            <h4 class="panel-title">Shipping Information</h4>
                                                        </td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-left">
                                                            <p>Name : {{strtoupper($vieworder->customer_firstname)}}<br>Mobile : {{$vieworder->customer_mobileno}} <br>Address : {{$vieworder->customer_address}},{{$vieworder->customer_address1}}<br>City : {{$vieworder->customer_city}}<br>State : {{$vieworder->customer_state}} - {{$vieworder->customer_pincode}}</p>
                                                        </td>
                                                        <td class="text-left">
                                                            <p>Shipping Method:{{$vieworder->invoice_shippingmethod}} <br>Specified By : {{$vieworder->invoice_specifiedby}}<br>Side mark: {{$vieworder->invoice_sidemark}}</p>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
											<br>
											
                                            <h5> Products Information</h5>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <td class="text-left">Image</td>
                                                        <td class="text-left">Product</td>
                                                       <!-- <td class="text-left">GST %</td>
                                                        <td class="text-right">Quantity</td>
                                                        <td class="text-right">Unit Price</td>-->
                                                        <td class="text-right">Total</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($order_products as $order)
													
                                                    <tr>
                                                        <td class="text-left"> <img src="{{ asset('assets/images/products/detail/'.$order->product_image )}}" style="width:100px;height=100px;" class="img-responsive"> </td>
                                                        <td class="text-left">{{$order->product_name}} <br> Size : {{$order->product_size}} <br>
															{{$order->product_quantity}} X Rs.{{$order->product_price}}</td>

                                                        <!--<td class="text-right">{{$order->product_gstin}}</td>
                                                        <td class="text-right">{{$order->product_quantity}}</td>
                                                        <td class="text-right">Rs.{{$order->product_price}}</td>-->
                                                        <td class="text-right">Rs.{{$order->total_price}}</td>
                                                    </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td colspan="2" class="text-right">Sub-Total</td>
                                                        <td class="text-right">Rs.{{$vieworder->total_amount}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" class="text-right">Discount</td>
                                                        <td class="text-right">Rs.{{$vieworder->discount_amount}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2" class="text-right">Shipping Charge</td>
                                                        <td class="text-right">Rs.{{$vieworder->shipping_charge}}</td>
                                                    </tr>
                                                    
                                                    <tr>
                                                        <td colspan="2" class="text-right">NET TOTAL</td>
                                                        <td class="text-right">Rs.{{$vieworder->grand_total}} /-</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                            <table class="table table-bordered">
                                                <thead>
                                                    <tr>
                                                        <td colspan="2">Amount in Words : <h4 class="text-success"> {{convertToIndianCurrency($vieworder->grand_total)}}</h4>
                                                        </td>


                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td style="width:30%">

                                                            <h5 class="text-success">Order Notes : {{$vieworder->order_notes}}</h5>
                                                            <h5 class="text-success">Order Status : {{$vieworder->order_status}}</h5>
                                                            <h5 class="text-danger">Payment Status : {{$vieworder->payment_status}}</h5>
                                                            <h5 class="text-danger">Payment Type : {{$vieworder->payment_type}}</h5>
                                                        </td>
                                                        
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h4 class="panel-title"><i class="fa fa-info-circle"></i> Order History</h4>
                                        </div>
                                        <div class="panel-body card">
                                            <div class="table-responsive">
                                                <table class="table table-striped table-bordered zero-configuration">
                                                    <thead>
                                                        <tr>
                                                            <td class="text-left">Date Added</td>
                                                            <td class="text-left">Remarks</td>
                                                            <td class="text-left">Status</td>
                                                            <td class="text-left">Payment</td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr>
                                                            <td class="text-left">{{$vieworder->created_at}}</td>
                                                            <td class="text-left">{{$vieworder->order_notes}}</td>
                                                            <td class="text-left">{{$vieworder->order_status}}</td>
                                                            <td class="text-left">{{$vieworder->payment_status}}</td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End of PageContent -->
        </main>
        <!-- End of Main -->
        <!-- Start of Footer -->
         @include('front_end.common.footer')
@php

function convertToIndianCurrency($number)
{
$no = round($number);
$decimal = round($number - ($no = floor($number)), 2) * 100;
$digits_length = strlen($no);
$i = 0;
$str = array();
$words = array(
0 => '',
1 => 'One',
2 => 'Two',
3 => 'Three',
4 => 'Four',
5 => 'Five',
6 => 'Six',
7 => 'Seven',
8 => 'Eight',
9 => 'Nine',
10 => 'Ten',
11 => 'Eleven',
12 => 'Twelve',
13 => 'Thirteen',
14 => 'Fourteen',
15 => 'Fifteen',
16 => 'Sixteen',
17 => 'Seventeen',
18 => 'Eighteen',
19 => 'Nineteen',
20 => 'Twenty',
30 => 'Thirty',
40 => 'Forty',
50 => 'Fifty',
60 => 'Sixty',
70 => 'Seventy',
80 => 'Eighty',
90 => 'Ninety'
);
$digits = array('', 'Hundred', 'Thousand', 'Lakh', 'Crore');
while ($i < $digits_length) { $divider=($i==2) ? 10 : 100; $number=floor($no % $divider); $no=floor($no / $divider); $i +=$divider==10 ? 1 : 2; if ($number) { $plural=(($counter=count($str)) && $number> 9) ? 's' : null;
    $str[] = ($number < 21) ? $words[$number] . ' ' . $digits[$counter] . $plural : $words[floor($number / 10) * 10] . ' ' . $words[$number % 10] . ' ' . $digits[$counter] . $plural; } else { $str[]=null; } } $Rupees=implode(' ', array_reverse($str));
                        $paise = ($decimal) ? "And Paise " . ($words[$decimal - $decimal % 10]) . " " . ($words[$decimal % 10])  : '';
                        return ($Rupees ?  $Rupees : '') . $paise . "Rupees Only";
                    }
                    @endphp
    <!-- Plugin JS File -->
    <script src="{{ asset('website_assets/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{ asset('website_assets/vendor/sticky/sticky.js')}}"></script>
    <script src="{{ asset('website_assets/vendor/magnific-popup/jquery.magnific-popup.min.js')}}"></script>
    <script src="{{ asset('website_assets/js/main.min.js')}}"></script>
</body>

</html>