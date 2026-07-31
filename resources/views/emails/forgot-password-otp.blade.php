<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Password Reset OTP</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f4f4f7; font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;">
    <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="background-color: #f4f4f7;">
        <tr>
            <td style="padding: 40px 20px;">
                <table role="presentation" cellspacing="0" cellpadding="0" border="0" width="100%" style="max-width: 480px; margin: 0 auto; background: #fff; border-radius: 16px; box-shadow: 0 4px 24px rgba(0,0,0,0.08); overflow: hidden;">
                    {{-- Header --}}
                    <tr>
                        <td style="background: linear-gradient(135deg, #0088dd, #00b4d8); padding: 30px 40px; text-align: center;">
                            <h1 style="margin: 0; color: #fff; font-size: 22px; font-weight: 700; letter-spacing: 0.5px;">Password Reset</h1>
                        </td>
                    </tr>
                    {{-- Body --}}
                    <tr>
                        <td style="padding: 35px 40px;">
                            <p style="margin: 0 0 8px; font-size: 16px; color: #333;">Hello <strong>{{ $customerName }}</strong>,</p>
                            <p style="margin: 0 0 25px; font-size: 14px; color: #666; line-height: 1.6;">We received a request to reset your password. Use the OTP below to verify your identity:</p>

                            <div style="text-align: center; margin: 30px 0;">
                                <div style="display: inline-block; background: #f0f7ff; border: 2px dashed #0088dd; border-radius: 12px; padding: 18px 40px;">
                                    <span style="font-size: 36px; font-weight: 800; color: #0088dd; letter-spacing: 12px; font-family: 'Courier New', monospace;">{{ $otp }}</span>
                                </div>
                            </div>

                            <p style="margin: 0 0 8px; font-size: 13px; color: #999; text-align: center;">This OTP is valid for <strong>10 minutes</strong>.</p>
                            <p style="margin: 0; font-size: 13px; color: #999; text-align: center;">If you didn't request this, please ignore this email.</p>
                        </td>
                    </tr>
                    {{-- Footer --}}
                    <tr>
                        <td style="background: #f9fafb; padding: 20px 40px; text-align: center; border-top: 1px solid #eee;">
                            <p style="margin: 0; font-size: 12px; color: #aaa;">© {{ date('Y') }} {{ config('app.name') }}. All rights reserved.</p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
