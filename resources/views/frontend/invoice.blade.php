<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Tax Invoice</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size:12px; }
        .row { width:100%; display:flex; }
        .col { width:50%; }
        .title { font-size:16px; font-weight:bold; }
        table { width:100%; border-collapse:collapse; margin-top:10px; }
        th, td { border:1px solid #000; padding:5px; text-align:center; }
        th { background:#f2f2f2; }
        .right { text-align:right; }
        .no-border td { border:none; }
        .noborder,
        .noborder td,
        .noborder th {
            border: none !important; text-align: left;
        }
    </style>
</head>
<body>
<table width="100%" class="noborder" style="margin-bottom:15px;">
    <tr>
        <!-- Logo -->
        <td width="25%" valign="middle">
            <img src="{{ public_path('frontend/images/header-logo.png') }}" width="120" style="
        width:110px;
        filter: grayscale(100%) contrast(200%) brightness(40%);
     ">
        </td>

        <!-- Title -->
        <td width="50%" valign="middle" style="text-align:center;">
            <h2 style="margin:0;">Tax Invoice / Bill of Supply</h2>
            <p style="margin:0;">(Original for Recipient)</p>
        </td>

        <!-- Empty / optional -->
        <td width="25%"></td>
    </tr>
</table>

<table width="100%" class="noborder">
    <tr>
        <td width="50%" valign="top">
            <b>Sold By:</b><br>
            {{ $seller['name'] }}<br>
            {{ $seller['address'] }}<br>
            PAN: {{ $seller['pan'] }}<br>
            GST: {{ $seller['gst'] }}
        </td>

        <td width="50%" valign="top" style="text-align:right;">
            <b>Billing Address:</b><br>
            {{ $billing['name'] }}<br>
            {{ $billing['address'] }}<br>
            {{ $billing['city'] }} - {{ $billing['pincode'] }}<br>
            State Code: {{ $billing['state_code'] }}
        </td>
    </tr>
</table>

<br>
<table width="100%" class="noborder">
    <tr>
        <td width="50%" valign="top">
            <b>Order Number:</b> {{ $invoice['order_no'] }}<br>
            <b>Invoice No:</b> {{ $invoice['invoice_no'] }}<br>
            <b>Order Date:</b> {{ $invoice['order_date'] }}<br>
            <b>Invoice Date:</b> {{ $invoice['invoice_date'] }}
        </td>

        <td width="50%" valign="top" style="text-align:right;">
            <b>Shipping Address:</b><br>
            {{ $shipping['name'] }}<br>
            {{ $shipping['address'] }}<br>
            {{ $shipping['city'] }} - {{ $shipping['pincode'] }}<br>
            State Code: {{ $shipping['state_code'] }}
        </td>
    </tr>
</table>


<table>
    <thead>
        <tr>
            <th>Sl</th>
            <th>Description</th>
            <th>Unit Price</th>
            <th>Qty</th>
            <th>Net Amount</th>
            <th>Tax %</th>
            <th>Tax Type</th>
            <th>Tax Amt</th>
            <th>Total</th>
        </tr>
    </thead>
    <tbody>
        @foreach($items as $i => $item)
        <tr>
            <td>{{ $i+1 }}</td>
            <td>{{ $item['name'] }}<br>HSN: {{ $item['hsn'] }}</td>
            <td>₹{{ $item['price'] }}</td>
            <td>{{ $item['qty'] }}</td>
            <td>₹{{ $item['net'] }}</td>
            <td>{{ $item['tax_rate'] }}%</td>
            <td>{{ $item['tax_type'] }}</td>
            <td>₹{{ $item['tax_amt'] }}</td>
            <td>₹{{ $item['total'] }}</td>
        </tr>
        @endforeach
    </tbody>
</table>

<table class="no-border">
    <tr>
        <td class="right"><b>Total Tax:</b></td>
        <td class="right">₹{{ $summary['tax'] }}</td>
    </tr>
    <tr>
        <td class="right"><b>Grand Total:</b></td>
        <td class="right">₹{{ $summary['grand'] }}</td>
    </tr>
</table>

<p><b>Amount in Words:</b> {{ $summary['words'] }}</p>
<p>Whether tax is payable under reverse charge - No</p>

<br><br>
<p style="text-align:right;">For {{ $seller['name'] }}</p>
<p style="text-align:right;"><b>Authorized Signatory</b></p>

</body>
</html>
