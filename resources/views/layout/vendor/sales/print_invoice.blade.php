@extends('layout.auth.master')
@section('contents')

@include('paritials.auth.header')?>

<!-- page-wrapper Start-->
@include('paritials.auth.topmenu');
<!-- Page Header Ends -->

<!-- Page Body Start-->
<div class="page-body-wrapper">
	
	<!-- Page Sidebar Start-->
	@include('paritials.vendorauth.sidemenu');
	<!-- Page Sidebar Ends-->
	
	<!-- Right sidebar Start-->
	
	<!-- Right sidebar Ends-->
	<style>
		
        .invoice {
		width: 800px;
		margin: auto;
		border: 1px solid #000;
		padding: 20px;
        }
        .header {
		text-align: center;
		margin-bottom: 20px;
        }
        .header h1 {
		margin: 0;
		font-size: 24px;
        }
        .details, .table, .footer {
		width: 100%;
		border-collapse: collapse;
        }
        .details td, .details th, .table td, .table th {
		border: 1px solid #000 !important;
		padding: 8px;
		text-align: left;
        }
        .details td {
		font-size: 14px;
        }
       
        .footer td {
		border: none;
        }
        .highlight {
		background-color: #ffff00 !important;
        }
	</style>
	<div class="page-body">
		
		<!-- Container-fluid starts-->
		<div class="container-fluid">
			<div class="page-header">
				<div class="row">
					<div class="col-lg-6">
						<div class="page-header-left">
							<h3>Invoice Print
								
							</h3>
						</div>
					</div>
					<div class="col-lg-6">
						<ol class="breadcrumb pull-right">
							<li class="breadcrumb-item"><a href="{{url('dashboard')}}"><i data-feather="home"></i></a></li>
							<li class="breadcrumb-item active">Order List</li>
						</ol>
					</div>
				</div>
			</div>
		</div>
		<!-- Container-fluid Ends-->
		
		<!-- Container-fluid starts-->
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-12">
					<div class="card tab2-card">
						
						<div class="card-body">
							<button type="button" onclick="printDiv('printableArea')" class="btn btn-success" value="Print"> <i class="fa fa-print"></i> Print</button>
							<div class="invoice" id="printableArea">
								<div class="header">
									<h1>Tax Invoice</h1>
								</div>
								<table class="details">
									<tr>
										<td style="width:50%"><strong>Sold By:</strong> {{ $vendorinfo->shop_name}}</td>
										<td style="width:50%"><strong>Invoice Number:</strong> OXY-000{{ $order_product->id}}</td>
									</tr>
									<tr>
										<td>
											<strong>Ship-from Address:</strong> 
											{{ $vendorinfo->address}},<br>
											{{ $vendorinfo->address1}},<br>
											{{ $vendorinfo->city}},<br>
											{{ $vendorinfo->state}} - {{ $vendorinfo->pincode}},
										</td>
										<td><strong>Order ID:</strong> {{ $order->order_id}} </td>
									</tr>
									<tr>
									<td><strong>GSTIN:</strong> {{ $vendorinfo->gst_number}}</td>
									<td><strong>Order Date:</strong> {{date('d-m-Y',strtotime($order->order_date)) }} </td>
										
									</tr>
									<tr>
										
										<td><strong>PAN:</strong> -</td>
										<td><strong>Invoice Date:</strong> {{ date('d-m-Y',strtotime($order->order_date))}} </td>
									</tr>
									<tr>
										<td><strong>CIN:</strong> -</td>
										<td> Payment Mode : {{ $order->payment_type}}</td>
									</tr>
								</table>
								<br>
								<table class="details">
									<tr>
										<td style="width:50%">
											<strong>Bill To:</strong><br>
											{{ $order->customer_firstname}} {{ $order->customer_lastname}}<br>
											{{ $order->customer_address}},{{ $order->customer_address1}},<br>
											{{ $order->customer_city}}<br>
											{{ $order->customer_state}} - {{ $order->customer_state}}<br>
											Phone: {{ $order->customer_mobileno}}<br>
											Email: {{ $order->customer_email}}
										</td>
										<td style="width:50%">
											<strong>Ship To:</strong><br>
											{{ $order->customer_firstname}} {{ $order->customer_lastname}}<br>
											{{ $order->customer_address}},{{ $order->customer_address1}},<br>
											{{ $order->customer_city}}<br>
											{{ $order->customer_state}} - {{ $order->customer_state}}<br>
											Phone: {{ $order->customer_mobileno}}<br>
											Email: {{ $order->customer_email}}
											<em>*Keep this invoice and manufacturer box for warranty purposes.</em>
										</td>
									</tr>
								</table>
								<br>
								<table class="table details">
									<thead>
										<tr >
											<th>Product</th>
											<th>Title</th>
											<th>Qty</th>
											<th>Gross Amount ₹</th>
											<th>Discount ₹</th>
											<th>Taxable Value ₹</th>
											<th>GST ₹</th>
											<th>Total ₹</th>
										</tr>
									</thead>
									<tbody>
										<tr>
											<td>{{$order_product->product_name}}</td>
											<td>
												
												<strong>{{$product->attributename1}}:</strong> {{$product->attributevalue1}}<br>
												<strong>{{$product->attributename2}}:</strong> {{$product->attributevalue2}}<br>
												<strong>{{$product->attributename3}}:</strong> {{$product->attributevalue3}}<br>
											</td>
											<td>{{$order_product->product_quantity}}</td>
											<td>{{$order_product->total_price}}</td>
											<td>0.00</td>
											<td>{{ $order_product->total_price - ($order_product->total_price*$order_product->product_gstin)/100 }}</td>
											<td>{{($order_product->total_price*$order_product->product_gstin )/100}}</td>
											<td>{{$order_product->total_price}}</td>
										</tr>
									</tbody>
								</table>
								<br>
								<table class="footer">
									<tr>
										<td><strong>Grand Total:</strong> ₹ {{$order_product->total_price}}</td>
									</tr>
									<tr>
										<td><strong>Amount In words : </strong>  {{ getIndianCurrency($order_product->total_price) }}</td>
									</tr>
									<tr>
										<td style="float:right;"><br><img src="{{asset('assets/images/sign.png')}}" style="width:125px;"><br>Authorized Signatory</td>
									</tr>
									<tr>
										<td><h4>DISCLAIMER:</h4>
											<p>1. This invoice is generated and issued on behalf of and under the instructions of the Merchant mentioned in this invoice. The goodsdescribed in this invoice are sold to the Customer by the Merchant and not by Pepperfry Private Limited (formerly known as TrendsutraPlatform Services Private Limited).Pepperfry Private Limited has merely facilitated the sale and purchase between the Merchant and theCustomer and the Merchant is responsible and liable for all the warranties, quality, merchantability etc. of the goods mentionedherein.Pepperfry Private Limited is not an agent and shall not be deemed to be construed as an agent of Merchant.</p>
											<p>2. The goods sold as part of this shipment are intended for end user consumption and not for re-sale.</p>
											<p>3. Reverse charges are not applicable.</p>
										</td>
									</tr>
								</table>
							</div>
							
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Container-fluid Ends-->
		
	</div>
	
	<?php

function getIndianCurrency(float $number)
{
    $decimal = round($number - ($no = floor($number)), 2) * 100;
    $hundred = null;
    $digits_length = strlen($no);
    $i = 0;
    $str = array();
    $words = array(0 => '', 1 => 'One', 2 => 'Two',
        3 => 'Three', 4 => 'Four', 5 => 'Five', 6 => 'Six',
        7 => 'Seven', 8 => 'Eight', 9 => 'Nine',
        10 => 'Ten', 11 => 'Eleven', 12 => 'Twelve',
        13 => 'Thirteen', 14 => 'Fourteen', 15 => 'Fifteen',
        16 => 'Sixteen', 17 => 'Seventeen', 18 => 'Eighteen',
        19 => 'Nineteen', 20 => 'Twenty', 30 => 'Thirty',
        40 => 'Forty', 50 => 'Fifty', 60 => 'Xixty',
        70 => 'Seventy', 80 => 'Eighty', 90 => 'Ninety');
    $digits = array('', 'Hundred','Thousand','Lakh', 'Crore');
    while( $i < $digits_length ) {
        $divider = ($i == 2) ? 10 : 100;
        $number = floor($no % $divider);
        $no = floor($no / $divider);
        $i += $divider == 10 ? 1 : 2;
        if ($number) {
            $plural = (($counter = count($str)) && $number > 9) ? 's' : null;
            $hundred = ($counter == 1 && $str[0]) ? ' And ' : null;
            $str [] = ($number < 21) ? $words[$number].' '. $digits[$counter]. $plural.' '.$hundred:$words[floor($number / 10) * 10].' '.$words[$number % 10]. ' '.$digits[$counter].$plural.' '.$hundred;
        } else $str[] = null;
    }
    $Rupees = implode('', array_reverse($str));
    $paise = ($decimal > 0) ? "." . ($words[$decimal / 10] . " " . $words[$decimal % 10]) . ' Paise' : '';
    return ($Rupees ? $Rupees . 'Rupees ' : '') . $paise;
} ?>


?>
	
	
	
	
    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
			
            document.body.innerHTML = printContents;
			
            window.print();
			
            document.body.innerHTML = originalContents;
		}
	</script>
@endsection