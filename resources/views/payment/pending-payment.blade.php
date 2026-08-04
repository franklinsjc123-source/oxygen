<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Payment - Oxygen</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --success: #22c55e;
            --success-hover: #16a34a;
            --whatsapp: #25d366;
            --whatsapp-hover: #128c7e;
            --bg: #0f172a;
            --card-bg: rgba(30, 41, 59, 0.7);
            --text: #f8fafc;
            --text-muted: #94a3b8;
        }

        body {
            font-family: 'Outfit', sans-serif;
            background: radial-gradient(circle at top right, #1e1b4b, #0f172a);
            color: var(--text);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            margin: 0;
            padding: 20px;
        }

        .card {
            background: var(--card-bg);
            backdrop-filter: blur(16px);
            -webkit-backdrop-filter: blur(16px);
            border: 1px solid rgba(255, 255, 255, 0.1);
            border-radius: 24px;
            padding: 40px;
            width: 100%;
            max-width: 500px;
            text-align: center;
            box-shadow: 0 20px 40px rgba(0, 0, 0, 0.3);
            animation: slideUp 0.6s cubic-bezier(0.16, 1, 0.3, 1);
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .icon-container {
            width: 80px;
            height: 80px;
            background: rgba(79, 70, 229, 0.15);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            border-radius: 50%;
            margin: 0 auto 24px;
        }

        h1 {
            font-size: 28px;
            font-weight: 800;
            margin: 0 0 12px;
            background: linear-gradient(to right, #a5b4fc, #818cf8);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }

        p {
            color: var(--text-muted);
            font-size: 16px;
            line-height: 1.6;
            margin: 0 0 32px;
        }

        .details-box {
            background: rgba(15, 23, 42, 0.4);
            border-radius: 16px;
            padding: 20px;
            margin-bottom: 32px;
            text-align: left;
        }

        .detail-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            font-size: 15px;
        }

        .detail-row:last-child {
            margin-bottom: 0;
            border-top: 1px solid rgba(255, 255, 255, 0.08);
            padding-top: 12px;
            font-weight: 600;
        }

        .label {
            color: var(--text-muted);
        }

        .value {
            color: var(--text);
        }

        .btn {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 100%;
            padding: 16px;
            border-radius: 14px;
            font-size: 16px;
            font-weight: 600;
            text-decoration: none;
            transition: all 0.3s ease;
            margin-bottom: 16px;
            cursor: pointer;
            box-sizing: border-box;
            border: none;
        }

        .btn-whatsapp {
            background: var(--whatsapp);
            color: white;
            box-shadow: 0 8px 20px rgba(37, 211, 102, 0.2);
        }

        .btn-whatsapp:hover {
            background: var(--whatsapp-hover);
            transform: translateY(-2px);
        }

        .btn-whatsapp i {
            margin-right: 8px;
            font-size: 18px;
        }

        .btn-primary {
            background: var(--primary);
            color: white;
            box-shadow: 0 8px 20px rgba(79, 70, 229, 0.25);
        }

        .btn-primary:hover {
            background: var(--primary-hover);
            transform: translateY(-2px);
        }

        .btn-secondary {
            background: rgba(255, 255, 255, 0.05);
            color: var(--text-muted);
            border: 1px solid rgba(255, 255, 255, 0.1);
            margin-bottom: 0;
        }

        .btn-secondary:hover {
            background: rgba(255, 255, 255, 0.1);
            color: var(--text);
        }

        .copy-box {
            display: flex;
            background: rgba(15, 23, 42, 0.4);
            border-radius: 12px;
            padding: 8px 12px;
            margin-bottom: 24px;
            align-items: center;
            justify-content: space-between;
            font-size: 14px;
        }

        .copy-input {
            background: transparent;
            border: none;
            color: var(--text-muted);
            width: 80%;
            font-family: inherit;
            font-size: 14px;
            outline: none;
        }

        .copy-btn {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            color: var(--text);
            padding: 6px 12px;
            border-radius: 8px;
            cursor: pointer;
            transition: all 0.2s;
        }

        .copy-btn:hover {
            background: rgba(255, 255, 255, 0.2);
        }
    </style>
</head>
<body>
    <div class="card">
        <div class="icon-container">
            <i class="fa-solid fa-hourglass-half"></i>
        </div>
        <h1>Vendor Registered!</h1>
        <p>The vendor account has been created successfully. Please complete the package payment using the link below.</p>

        <div class="details-box">
            <div class="detail-row">
                <span class="label">Shop Name</span>
                <span class="value">{{ $vendor->shop_name }}</span>
            </div>
            <div class="detail-row">
                <span class="label">Owner Name</span>
                <span class="value">{{ $vendor->owner_name }}</span>
            </div>
            <div class="detail-row">
                <span class="label">WhatsApp Number</span>
                <span class="value">{{ $vendor->whatsapp_number ?: $vendor->mobile_number1 }}</span>
            </div>
        </div>

        <div class="copy-box">
            <input type="text" class="copy-input" value="{{ $paymentLink }}" readonly id="paymentLinkInput">
            <button class="copy-btn" onclick="copyLink()">Copy</button>
        </div>

        <a href="{{ $whatsappLink }}" target="_blank" class="btn btn-whatsapp">
            <i class="fa-brands fa-whatsapp"></i> Share on WhatsApp
        </a>

        <a href="{{ $paymentLink }}" target="_blank" class="btn btn-primary">
            Pay Now
        </a>

        <a href="{{ route('staffvendor-list') }}" class="btn btn-secondary">
            Go to Vendor List
        </a>
    </div>

    <script>
        function copyLink() {
            var copyText = document.getElementById("paymentLinkInput");
            copyText.select();
            copyText.setSelectionRange(0, 99999);
            navigator.clipboard.writeText(copyText.value);
            alert("Payment link copied to clipboard!");
        }
    </script>
</body>
</html>
