<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f7; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f4f4f7; padding: 40px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); padding: 40px 30px; text-align: center;">
                            <h1 style="margin: 0; color: #ffffff; font-size: 28px; font-weight: 700;">✅ Order Confirmed!</h1>
                            <p style="margin: 10px 0 0; color: rgba(255,255,255,0.9); font-size: 16px;">Thank you for your purchase</p>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding: 30px;">
                            <p style="margin: 0 0 15px; color: #333; font-size: 16px; line-height: 1.6;">
                                Dear <strong>{{ $orderData['customer_name'] }}</strong>,
                            </p>
                            <p style="margin: 0 0 20px; color: #555; font-size: 15px; line-height: 1.6;">
                                Your order has been placed successfully! Here are the details:
                            </p>

                            <!-- Order Info Box -->
                            <table width="100%" cellpadding="0" cellspacing="0" style="margin: 20px 0; border: 1px solid #e9ecef; border-radius: 8px; overflow: hidden;">
                                <tr>
                                    <td style="background-color: #f8f9fa; padding: 15px 20px; border-bottom: 1px solid #e9ecef;">
                                        <strong style="color: #333; font-size: 15px;">Order Information</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 20px;">
                                        <table width="100%" cellpadding="5" cellspacing="0">
                                            <tr>
                                                <td style="color: #777; font-size: 14px; width: 40%;">Order ID</td>
                                                <td style="color: #333; font-size: 14px; font-weight: 600;">{{ $orderData['order_id'] }}</td>
                                            </tr>
                                            <tr>
                                                <td style="color: #777; font-size: 14px;">Order Date</td>
                                                <td style="color: #333; font-size: 14px;">{{ \Carbon\Carbon::parse($orderData['order_date'])->timezone('Asia/Kolkata')->format('d-m-Y h:i:s A') }}</td>
                                            </tr>
                                            <tr>
                                                <td style="color: #777; font-size: 14px;">Payment Method</td>
                                                <td style="color: #333; font-size: 14px;">
                                                    @if(stripos($orderData['payment_type'], 'cash') !== false || $orderData['payment_type'] == 'cashondelivery' || $orderData['payment_type'] == 'COD')
                                                        Cash on Delivery
                                                    @else
                                                        Online Payment
                                                    @endif
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <!-- Products Table -->
                            <table width="100%" cellpadding="0" cellspacing="0" style="margin: 20px 0; border: 1px solid #e9ecef; border-radius: 8px; overflow: hidden;">
                                <tr>
                                    <td style="background-color: #f8f9fa; padding: 15px 20px; border-bottom: 1px solid #e9ecef;">
                                        <strong style="color: #333; font-size: 15px;">Ordered Items</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 0;">
                                        <table width="100%" cellpadding="12" cellspacing="0">
                                            <thead>
                                                <tr style="background-color: #f8f9fa;">
                                                    <th style="text-align: left; color: #555; font-size: 13px; border-bottom: 1px solid #e9ecef;">Product</th>
                                                    <th style="text-align: center; color: #555; font-size: 13px; border-bottom: 1px solid #e9ecef;">Qty</th>
                                                    <th style="text-align: right; color: #555; font-size: 13px; border-bottom: 1px solid #e9ecef;">Price</th>
                                                    <th style="text-align: right; color: #555; font-size: 13px; border-bottom: 1px solid #e9ecef;">Total</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($orderData['products'] as $product)
                                                <tr>
                                                    <td style="color: #333; font-size: 14px; border-bottom: 1px solid #f0f0f0;">
                                                        {{ $product['name'] }}
                                                        @if($product['size'])
                                                            <br><span style="color: #999; font-size: 12px;">Size: {{ $product['size'] }}</span>
                                                        @endif
                                                    </td>
                                                    <td style="text-align: center; color: #333; font-size: 14px; border-bottom: 1px solid #f0f0f0;">{{ $product['qty'] }}</td>
                                                    <td style="text-align: right; color: #333; font-size: 14px; border-bottom: 1px solid #f0f0f0;">₹{{ number_format($product['price'], 2) }}</td>
                                                    <td style="text-align: right; color: #333; font-size: 14px; border-bottom: 1px solid #f0f0f0;">₹{{ number_format($product['total'], 2) }}</td>
                                                </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <!-- Price Summary -->
                            <table width="100%" cellpadding="0" cellspacing="0" style="margin: 20px 0;">
                                <tr>
                                    <td width="60%"></td>
                                    <td width="40%">
                                        <table width="100%" cellpadding="8" cellspacing="0" style="border: 1px solid #e9ecef; border-radius: 8px; overflow: hidden;">
                                            <tr>
                                                <td style="color: #777; font-size: 14px;">Subtotal</td>
                                                <td style="text-align: right; color: #333; font-size: 14px;">₹{{ number_format($orderData['total_amount'], 2) }}</td>
                                            </tr>
                                            @if($orderData['discount_amount'] > 0)
                                            <tr>
                                                <td style="color: #27ae60; font-size: 14px;">Discount</td>
                                                <td style="text-align: right; color: #27ae60; font-size: 14px;">-₹{{ number_format($orderData['discount_amount'], 2) }}</td>
                                            </tr>
                                            @endif
                                            @if($orderData['shipping_charge'] > 0)
                                            <tr>
                                                <td style="color: #777; font-size: 14px;">Shipping</td>
                                                <td style="text-align: right; color: #333; font-size: 14px;">₹{{ number_format($orderData['shipping_charge'], 2) }}</td>
                                            </tr>
                                            @endif
                                            @if($orderData['gst_charge'] > 0)
                                            <tr>
                                                <td style="color: #777; font-size: 14px;">GST</td>
                                                <td style="text-align: right; color: #333; font-size: 14px;">₹{{ number_format($orderData['gst_charge'], 2) }}</td>
                                            </tr>
                                            @endif
                                            <tr style="border-top: 2px solid #333;">
                                                <td style="color: #333; font-size: 16px; font-weight: 700; padding-top: 12px;">Grand Total</td>
                                                <td style="text-align: right; color: #27ae60; font-size: 18px; font-weight: 700; padding-top: 12px;">₹{{ number_format($orderData['grand_total'], 2) }}</td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <!-- Shipping Address -->
                            <table width="100%" cellpadding="0" cellspacing="0" style="margin: 20px 0; border: 1px solid #e9ecef; border-radius: 8px; overflow: hidden;">
                                <tr>
                                    <td style="background-color: #f8f9fa; padding: 15px 20px; border-bottom: 1px solid #e9ecef;">
                                        <strong style="color: #333; font-size: 15px;">📦 Shipping Address</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 20px; color: #555; font-size: 14px; line-height: 1.8;">
                                        {{ $orderData['customer_name'] }}<br>
                                        {{ $orderData['address'] }}<br>
                                        @if($orderData['address1'])
                                            {{ $orderData['address1'] }}<br>
                                        @endif
                                        {{ $orderData['city'] }}, {{ $orderData['state'] }} - {{ $orderData['pincode'] }}<br>
                                        📞 {{ $orderData['mobile'] }}
                                    </td>
                                </tr>
                            </table>

                            <!-- CTA Button -->
                            <table width="100%" cellpadding="0" cellspacing="0" style="margin: 25px 0;">
                                <tr>
                                    <td align="center">
                                        <a href="{{ url('order_tracking/' . $orderData['order_id']) }}" style="display: inline-block; background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%); color: #ffffff; text-decoration: none; padding: 14px 40px; border-radius: 50px; font-size: 16px; font-weight: 600; box-shadow: 0 4px 15px rgba(17, 153, 142, 0.4);">
                                            Track Your Order →
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8f9fa; padding: 20px 30px; text-align: center; border-top: 1px solid #e9ecef;">
                            <p style="margin: 0 0 5px; color: #777; font-size: 13px;">
                                If you have any questions, feel free to contact us.
                            </p>
                            <p style="margin: 0; color: #999; font-size: 12px;">
                                This is an automated email. Please do not reply to this message.<br>
                                &copy; {{ date('Y') }} {{ config('app.name') }}. All rights reserved.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>
