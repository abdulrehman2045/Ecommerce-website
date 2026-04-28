<?php
session_start();

// Check if order_id exists
if (!isset($_GET['order_id']) || empty($_GET['order_id'])) {
    header("Location: index.php");
    exit;
}

$order_id = intval($_GET['order_id']);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmed | Success</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        :root {
            --primary-color: #4F46E5;
            --success-color: #22C55E;
            --bg-gradient: linear-gradient(135deg, #F5F7FF 0%, #E0E7FF 100%);
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: var(--bg-gradient);
            padding: 20px;
        }

        .success-card {
            background: #ffffff;
            width: 100%;
            max-width: 480px;
            padding: 50px 40px;
            border-radius: 24px;
            text-align: center;
            box-shadow: 0 20px 40px rgba(79, 70, 229, 0.1);
            animation: slideUp 0.8s cubic-bezier(0.16, 1, 0.3, 1);
            position: relative;
            overflow: hidden;
        }

        @keyframes slideUp {
            from { opacity: 0; transform: translateY(40px); }
            to { opacity: 1; transform: translateY(0); }
        }

        /* Animated Checkmark Circle */
        .icon-circle {
            width: 90px;
            height: 90px;
            background: #DCFCE7;
            color: var(--success-color);
            border-radius: 50%;
            display: flex;
            justify-content: center;
            align-items: center;
            margin: 0 auto 25px;
            font-size: 45px;
            animation: scaleIn 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) forwards;
        }

        @keyframes scaleIn {
            0% { transform: scale(0); }
            100% { transform: scale(1); }
        }

        h2 {
            font-size: 28px;
            font-weight: 800;
            color: #1F2937;
            margin-bottom: 12px;
            line-height: 1.2;
        }

        p {
            color: #6B7280;
            font-size: 16px;
            margin-bottom: 30px;
            line-height: 1.5;
        }

        .order-badge {
            background: #F3F4F6;
            padding: 15px 25px;
            border-radius: 12px;
            display: inline-block;
            margin-bottom: 35px;
        }

        .order-badge span {
            display: block;
            font-size: 12px;
            text-transform: uppercase;
            letter-spacing: 1px;
            color: #9CA3AF;
            margin-bottom: 5px;
        }

        .order-id-text {
            font-size: 20px;
            font-weight: 700;
            color: var(--primary-color);
        }

        .actions {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .btn {
            padding: 16px 30px;
            border-radius: 14px;
            text-decoration: none;
            font-weight: 600;
            font-size: 15px;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-primary {
            background: var(--primary-color);
            color: white;
            box-shadow: 0 4px 15px rgba(79, 70, 229, 0.3);
        }

        .btn-primary:hover {
            background: #4338CA;
            transform: translateY(-2px);
            box-shadow: 0 6px 20px rgba(79, 70, 229, 0.4);
        }

        .btn-secondary {
            background: transparent;
            color: #4B5563;
            border: 1px solid #E5E7EB;
        }

        .btn-secondary:hover {
            background: #F9FAFB;
            border-color: #D1D5DB;
        }

        /* Success Confetti Effect (Simple CSS) */
        .confetti {
            position: absolute;
            top: -10px;
            width: 10px;
            height: 10px;
            background: var(--primary-color);
            opacity: 0.5;
            border-radius: 2px;
        }
    </style>
</head>

<body>

    <div class="success-card">
        <div class="icon-circle">
            <i class="bi bi-check-lg"></i>
        </div>
        
        <h2>Woot! Order Placed.</h2>
        <p>Aapka order receive ho gaya hai. Hum jald hi aap se raabta karenge!</p>

        <div class="order-badge">
            <span>Tracking Number</span>
            <div class="order-id-text">#ORD-<?php echo $order_id; ?></div>
        </div>

        <div class="actions">
            <a href="index.php" class="btn btn-primary">
                <i class="bi bi-cart"></i> Continue Shopping
            </a>
            <a href="my_orders.php" class="btn btn-secondary">
                View My Orders
            </a>
        </div>
    </div>

    <div style="position:fixed; bottom:20px; color:#9CA3AF; font-size:12px;">
        Need help? <a href="contact.php" style="color:var(--primary-color); text-decoration:none;">Contact Support</a>
    </div>

</body>
</html>