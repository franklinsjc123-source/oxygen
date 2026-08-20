<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Status - Tryneww</title>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --primary: #4f46e5;
            --primary-hover: #4338ca;
            --success: #22c55e;
            --success-hover: #16a34a;
            --danger: #ef4444;
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
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 36px;
            border-radius: 50%;
            margin: 0 auto 24px;
        }

        .icon-success {
            background: rgba(34, 197, 94, 0.15);
            color: var(--success);
        }

        .icon-danger {
            background: rgba(239, 68, 68, 0.15);
            color: var(--danger);
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
            cursor: pointer;
            box-sizing: border-box;
            border: none;
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
    </style>
</head>
<body>
    <div class="card">
        @if($success)
            <div class="icon-container icon-success">
                <i class="fa-solid fa-circle-check"></i>
            </div>
            <h1>Payment Successful!</h1>
            <p>{{ $message }}</p>
        @else
            <div class="icon-container icon-danger">
                <i class="fa-solid fa-circle-xmark"></i>
            </div>
            <h1>Payment Verification Failed</h1>
            <p>{{ $message }}</p>
        @endif

        <a href="/" class="btn btn-primary">
            Go to Homepage
        </a>
    </div>
</body>
</html>
