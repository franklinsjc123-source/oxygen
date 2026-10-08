<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Plan Expiry Notification</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f7; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f4f4f7; padding: 40px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #e74c3c 0%, #c0392b 100%); padding: 40px 30px; text-align: center;">
                            <h1 style="margin: 0; color: #ffffff; font-size: 28px; font-weight: 700;">Plan Expiry Notice</h1>
                            <p style="margin: 10px 0 0; color: rgba(255,255,255,0.9); font-size: 16px;">Action Required for {{ $shopName }}</p>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding: 30px;">
                            <p style="margin: 0 0 15px; color: #333; font-size: 16px; line-height: 1.6;">
                                Dear <strong>{{ $recipientName }}</strong>,
                            </p>
                            <p style="margin: 0 0 20px; color: #555; font-size: 15px; line-height: 1.6;">
                                This is a notification regarding the vendor plan for <strong>{{ $shopName }}</strong>.
                                The subscription plan {{ $isExpiryToday ? 'has expired today' : 'is scheduled to expire on' }} 
                                <strong style="color: #e74c3c;">{{ $expiryDate }}</strong>.
                            </p>

                            <p style="margin: 0 0 15px; color: #555; font-size: 15px; line-height: 1.6;">
                                Please ensure that the renewal process is completed to avoid any interruption in services and product visibility on the platform.
                            </p>

                            <!-- CTA Button -->
                            @if($isVendor)
                            <table width="100%" cellpadding="0" cellspacing="0" style="margin: 25px 0;">
                                <tr>
                                    <td align="center">
                                        <a href="{{ url('vendor/dashboard') }}" style="display: inline-block; background: linear-gradient(135deg, #183543 0%, #0f2430 100%); color: #ffffff; text-decoration: none; padding: 14px 40px; border-radius: 50px; font-size: 16px; font-weight: 600; box-shadow: 0 4px 15px rgba(24, 53, 67, 0.4);">
                                            Renew Now →
                                        </a>
                                    </td>
                                </tr>
                            </table>
                            @endif
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
