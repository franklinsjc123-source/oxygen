<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Seller Account Login Credentials</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f1f5f9; font-family: -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Helvetica, Arial, sans-serif; color: #1e293b;">
    <table width="100%" cellpadding="0" cellspacing="0" style="background-color: #f1f5f9; padding: 36px 12px;">
        <tr>
            <td align="center">
                <table width="600" cellpadding="0" cellspacing="0" style="max-width: 600px; width: 100%; background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);">
                    
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #ff7033 0%, #ff5214 100%); padding: 36px 30px; text-align: center;">
                            <h1 style="margin: 0; color: #ffffff; font-size: 26px; font-weight: 700; letter-spacing: -0.5px;">
                                Welcome to {{ config('app.name', 'Trymenow') }}!
                            </h1>
                            <p style="margin: 8px 0 0; color: rgba(255, 255, 255, 0.95); font-size: 15px;">
                                Your seller account is active and ready
                            </p>
                        </td>
                    </tr>

                    <!-- Body Content -->
                    <tr>
                        <td style="padding: 36px 32px;">
                            <p style="margin: 0 0 16px; font-size: 16px; line-height: 1.5; color: #334155;">
                                Dear <strong>{{ $vendor->owner_name ?? 'Seller' }}</strong>,
                            </p>
                            <p style="margin: 0 0 20px; font-size: 15px; line-height: 1.6; color: #475569;">
                                Congratulations! Your payment has been successfully processed and your seller account for <strong>{{ $vendor->shop_name ?? 'your shop' }}</strong> is now fully activated.
                            </p>
                            <p style="margin: 0 0 24px; font-size: 15px; line-height: 1.6; color: #475569;">
                                You can log in to your Seller Portal using the credentials below:
                            </p>

                            <!-- Credentials Box -->
                            <table width="100%" cellpadding="0" cellspacing="0" style="background: #f8fafc; border: 1px solid #e2e8f0; border-radius: 12px; margin-bottom: 28px; overflow: hidden;">
                                <tr>
                                    <td style="padding: 20px 24px; border-bottom: 1px solid #e2e8f0;">
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td width="35%" style="font-size: 13px; text-transform: uppercase; font-weight: 600; color: #64748b; letter-spacing: 0.5px;">
                                                    Username
                                                </td>
                                                <td width="65%" style="font-size: 16px; font-weight: 700; color: #0f172a; font-family: 'Courier New', Courier, monospace;">
                                                    {{ $username }}
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 20px 24px; border-bottom: 1px solid #e2e8f0;">
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td width="35%" style="font-size: 13px; text-transform: uppercase; font-weight: 600; color: #64748b; letter-spacing: 0.5px;">
                                                    Password
                                                </td>
                                                <td width="65%" style="font-size: 16px; font-weight: 700; color: #ff5214; font-family: 'Courier New', Courier, monospace;">
                                                    {{ $password }}
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 20px 24px;">
                                        <table width="100%" cellpadding="0" cellspacing="0">
                                            <tr>
                                                <td width="35%" style="font-size: 13px; text-transform: uppercase; font-weight: 600; color: #64748b; letter-spacing: 0.5px;">
                                                    Login URL
                                                </td>
                                                <td width="65%">
                                                    <a href="{{ $loginUrl }}" target="_blank" style="font-size: 14px; font-weight: 600; color: #2563eb; text-decoration: underline; word-break: break-all;">
                                                        {{ $loginUrl }}
                                                    </a>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            </table>

                            <!-- CTA Button -->
                            <table width="100%" cellpadding="0" cellspacing="0" style="margin-bottom: 28px;">
                                <tr>
                                    <td align="center">
                                        <a href="{{ $loginUrl }}" target="_blank" style="display: inline-block; background: linear-gradient(135deg, #ff7033 0%, #ff5214 100%); color: #ffffff; text-decoration: none; font-size: 15px; font-weight: 600; padding: 14px 36px; border-radius: 8px; box-shadow: 0 4px 12px rgba(255, 82, 20, 0.3);">
                                            Login to Seller Portal &rarr;
                                        </a>
                                    </td>
                                </tr>
                            </table>

                            <!-- Security Notice -->
                            <div style="background-color: #fffbeb; border: 1px solid #fef3c7; border-radius: 8px; padding: 14px 16px; margin-bottom: 20px;">
                                <p style="margin: 0; font-size: 13px; line-height: 1.5; color: #92400e;">
                                    <strong>Security Notice:</strong> Please keep your login credentials secure and confidential. We recommend updating your password after your first login through your account profile settings.
                                </p>
                            </div>

                            <p style="margin: 0; font-size: 14px; line-height: 1.6; color: #64748b;">
                                If you have any questions or require assistance, please feel free to reach out to our support team.
                            </p>
                        </td>
                    </tr>

                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f8fafc; padding: 22px 30px; text-align: center; border-top: 1px solid #e2e8f0;">
                            <p style="margin: 0 0 6px; color: #94a3b8; font-size: 12px;">
                                This is an automated email sent to {{ $vendor->email ?? 'your email' }}.
                            </p>
                            <p style="margin: 0; color: #94a3b8; font-size: 12px;">
                                &copy; {{ date('Y') }} {{ config('app.name', 'Trymenow') }}. All rights reserved.
                            </p>
                        </td>
                    </tr>

                </table>
            </td>
        </tr>
    </table>
</body>
</html>

