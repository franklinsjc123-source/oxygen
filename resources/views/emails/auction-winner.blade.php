<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Auction Winner</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f7; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f4f4f7; padding: 40px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); padding: 40px 30px; text-align: center;">
                            <h1 style="margin: 0; color: #ffffff; font-size: 28px; font-weight: 700;">🎉 Congratulations!</h1>
                            <p style="margin: 10px 0 0; color: rgba(255,255,255,0.9); font-size: 16px;">You Won the Auction!</p>
                        </td>
                    </tr>

                    <!-- Product Image -->
                    @if($productImage)
                    <tr>
                        <td style="padding: 30px 30px 0; text-align: center;">
                            <img src="{{ asset('assets/images/products/' . $productImage) }}" alt="Product" style="max-width: 200px; height: auto; border-radius: 8px; box-shadow: 0 2px 10px rgba(0,0,0,0.1);">
                        </td>
                    </tr>
                    @endif

                    <!-- Body -->
                    <tr>
                        <td style="padding: 30px;">
                            <p style="margin: 0 0 15px; color: #333; font-size: 16px; line-height: 1.6;">
                                Dear <strong>{{ $winnerName }}</strong>,
                            </p>
                            <p style="margin: 0 0 20px; color: #555; font-size: 15px; line-height: 1.6;">
                                We're thrilled to inform you that you've won the auction for 
                                <strong style="color: #333;">{{ $productName }}</strong> with a winning bid of 
                                <strong style="color: #27ae60; font-size: 18px;">₹{{ number_format($bidAmount, 2) }}</strong>!
                            </p>

                            <!-- Coupon Code Box -->
                            <table width="100%" cellpadding="0" cellspacing="0" style="margin: 25px 0;">
                                <tr>
                                    <td style="background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border-radius: 10px; padding: 25px; text-align: center;">
                                        <p style="margin: 0 0 8px; color: #fff; font-size: 13px; text-transform: uppercase; letter-spacing: 2px; font-weight: 600;">Your Exclusive Coupon Code</p>
                                        <p style="margin: 0; color: #fff; font-size: 32px; font-weight: 800; letter-spacing: 3px; font-family: 'Courier New', monospace;">
                                            {{ $couponCode }}
                                        </p>
                                        <p style="margin: 10px 0 0; color: rgba(255,255,255,0.85); font-size: 12px;">Valid for 30 days from today</p>
                                    </td>
                                </tr>
                            </table>

                            <p style="margin: 0 0 15px; color: #555; font-size: 15px; line-height: 1.6;">
                                Use this coupon code at checkout to claim your auction product. This code is exclusive to you and cannot be transferred.
                            </p>

                            <!-- CTA Button -->
                            <table width="100%" cellpadding="0" cellspacing="0" style="margin: 25px 0;">
                                <tr>
                                    <td align="center">
                                        <a href="{{ url('home') }}" style="display: inline-block; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: #ffffff; text-decoration: none; padding: 14px 40px; border-radius: 50px; font-size: 16px; font-weight: 600; box-shadow: 0 4px 15px rgba(102, 126, 234, 0.4);">
                                            Shop Now →
                                        </a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8f9fa; padding: 20px 30px; text-align: center; border-top: 1px solid #e9ecef;">
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
