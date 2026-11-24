<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>@yield('title', 'TryMeNow')</title>
    <link rel="icon" href="{{ asset('assets/images/favicon.ico') }}" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: 'Plus Jakarta Sans', -apple-system, BlinkMacSystemFont, sans-serif;
            -webkit-tap-highlight-color: transparent;
        }
        body {
            background-color: #f8fafc;
            color: #1e293b;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
        }
        .error-card {
            background: #ffffff;
            border-radius: 20px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.06);
            max-width: 480px;
            width: 100%;
            padding: 40px 28px;
            text-align: center;
            border: 1px solid #e2e8f0;
        }
        .logo-wrap {
            margin-bottom: 24px;
        }
        .logo-wrap img {
            max-height: 44px;
            width: auto;
            object-fit: contain;
        }
        .icon-circle {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            background: #fee2e2;
            color: #ef4444;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
        }
        .icon-circle.warning {
            background: #fef3c7;
            color: #f59e0b;
        }
        .icon-circle.info {
            background: #e0f2fe;
            color: #0284c7;
        }
        .error-code {
            font-size: 14px;
            font-weight: 700;
            letter-spacing: 1px;
            text-transform: uppercase;
            color: #64748b;
            margin-bottom: 8px;
        }
        .error-title {
            font-size: 22px;
            font-weight: 700;
            color: #0f172a;
            margin-bottom: 12px;
            line-height: 1.3;
        }
        .error-desc {
            font-size: 15px;
            color: #64748b;
            line-height: 1.6;
            margin-bottom: 28px;
        }
        .action-btns {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }
        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 13px 20px;
            border-radius: 12px;
            font-size: 15px;
            font-weight: 600;
            text-decoration: none;
            cursor: pointer;
            transition: all 0.2s ease;
            border: none;
            width: 100%;
        }
        .btn-primary {
            background: #0f3443;
            background: linear-gradient(135deg, #0f3443 0%, #34e89e 100%);
            color: #ffffff;
            box-shadow: 0 4px 12px rgba(15, 52, 67, 0.2);
        }
        .btn-primary:active {
            transform: scale(0.98);
        }
        .btn-secondary {
            background: #f1f5f9;
            color: #334155;
        }
        .btn-secondary:active {
            background: #e2e8f0;
            transform: scale(0.98);
        }
    </style>
</head>
<body>
    <div class="error-card">
        <div class="logo-wrap">
            <img src="{{ asset('assets/images/header-logo.webp') }}" alt="TryMeNow" onerror="this.style.display='none'">
        </div>
        @yield('content')
    </div>
</body>
</html>
