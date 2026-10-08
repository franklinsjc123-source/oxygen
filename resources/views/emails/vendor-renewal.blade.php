<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Vendor Plan Renewal Success</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f7; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f4f4f7; padding: 40px 0;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="background-color: #ffffff; border-radius: 12px; overflow: hidden; box-shadow: 0 4px 20px rgba(0,0,0,0.1);">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #2ecc71 0%, #27ae60 100%); padding: 40px 30px; text-align: center;">
                            <h1 style="margin: 0; color: #ffffff; font-size: 28px; font-weight: 700;">Plan Renewal Successful!</h1>
                            <p style="margin: 10px 0 0; color: rgba(255,255,255,0.9); font-size: 16px;">{{ $shopName }}</p>
                        </td>
                    </tr>

                    <!-- Body -->
                    <tr>
                        <td style="padding: 30px;">
                            <p style="margin: 0 0 15px; color: #333; font-size: 16px; line-height: 1.6;">
                                Dear <strong>{{ $recipientName }}</strong>,
                            </p>
                            <p style="margin: 0 0 20px; color: #555; font-size: 15px; line-height: 1.6;">
                                We're happy to inform you that the vendor plan for <strong>{{ $shopName }}</strong> has been successfully renewed.
                            </p>

                            <table width="100%" cellpadding="0" cellspacing="0" style="margin: 20px 0; background-color: #f8f9fa; border-radius: 8px; padding: 15px;">
                                <tr>
                                    <td style="padding-bottom: 10px; color: #555;"><strong>New Package:</strong></td>
                                    <td style="padding-bottom: 10px; color: #333;">{{ $packageName }}</td>
                                </tr>
                                <tr>
                                    <td style="color: #555;"><strong>New Expiry Date:</strong></td>
                                    <td style="color: #333;">{{ $expiryDate }}</td>
                                </tr>
                            </table>

                            <p style="margin: 0 0 15px; color: #555; font-size: 15px; line-height: 1.6;">
                                Thank you for being a part of our platform.
                            </p>
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
