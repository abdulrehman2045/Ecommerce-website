<?php
session_start();
include("../code.php"); // must create $connection

if (!$connection) {
    die("Database Connection Failed: " . mysqli_connect_error());
}

// Cart Check
if (!isset($_SESSION['cart']) || count($_SESSION['cart']) == 0) {
    echo "<script>alert('Your cart is empty'); window.location='cart.php';</script>";
    exit;
}

// Login Check
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Please login first'); window.location='login.php';</script>";
    exit;
}

// Calculate totals
$subtotal = 0;
$shipping = 50;
$tax = 0;

foreach ($_SESSION['cart'] as $item) {
    $subtotal += $item['price'] * $item['quantity'];
}

$tax = $subtotal * 0.05;
$total = $subtotal + $shipping + $tax;


// FORM SUBMIT
if (isset($_POST['place_order'])) {

    $user_id = $_SESSION['user_id'];
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $address = trim($_POST['address']);
    $payment_method = trim($_POST['payment_method']);
    $order_notes = isset($_POST['order_notes']) ? trim($_POST['order_notes']) : '';

    if (empty($name) || empty($email) || empty($phone) || empty($address)) {
        echo "<script>alert('All required fields must be filled'); window.location='checkout.php';</script>";
        exit;
    }

    $product_details = [];
    foreach ($_SESSION['cart'] as $id => $item) {
        $product_details[] = [
            'id' => $id,
            'name' => $item['name'],
            'price' => $item['price'],
            'qty' => $item['quantity']
        ];
    }

    $products_json = json_encode($product_details);
    $order_date = date("Y-m-d H:i:s");
    $status = "pending";

    $stmt = $connection->prepare("INSERT INTO orders 
    (user_id, name, email, phone, address, payment_method, product_details, total_amount, order_date, order_notes, status) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");

    $stmt->bind_param("isssssssdss", $user_id, $name, $email, $phone, $address, $payment_method, $products_json, $total, $order_date, $order_notes, $status);

    if ($stmt->execute()) {
        $order_id = $stmt->insert_id;
        unset($_SESSION['cart']);
        echo "<script>alert('Order Placed Successfully!'); window.location='order_success.php?order_id=$order_id';</script>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Secure Checkout</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f8f9fa; color: #333; }
        .checkout-card { border: none; border-radius: 15px; box-shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .form-control { border-radius: 8px; padding: 12px; border: 1px solid #e0e0e0; }
        .form-control:focus { box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1); border-color: #0d6efd; }
        .summary-card { border-radius: 15px; background: #fff; border: 1px solid #eee; }
        .btn-place-order { padding: 15px; font-weight: 600; border-radius: 10px; text-transform: uppercase; letter-spacing: 1px; }
        .payment-option { border: 1px solid #eee; padding: 15px; border-radius: 10px; margin-bottom: 10px; cursor: pointer; transition: 0.3s; }
        .payment-option:hover { background-color: #f0f7ff; }
        .section-title { font-weight: 700; color: #222; margin-bottom: 25px; display: flex; align-items: center; }
        .section-title i { margin-right: 10px; color: #0d6efd; }
        .order-item-list { font-size: 0.95rem; }
    </style>
</head>
<body>

<div class="container py-5">
    <div class="row g-4">
        
        <div class="col-lg-8">
            <div class="card checkout-card p-4 p-md-5">
                <h3 class="section-title"><i class="bi bi-geo-alt"></i> Shipping Information</h3>
                
                <form method="POST">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Full Name</label>
                            <input type="text" name="name" class="form-control" placeholder="John Doe" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label fw-semibold">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="john@example.com" required>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-semibold">Phone Number</label>
                            <input type="text" name="phone" class="form-control" placeholder="+92 300 0000000" required>
                        </div>
                        <div class="col-12">
                            <label class="form-label fw-semibold">Delivery Address</label>
                            <textarea name="address" class="form-control" rows="3" placeholder="Street, House No, City..." required></textarea>
                        </div>
                    </div>

                    <h3 class="section-title mt-5"><i class="bi bi-credit-card"></i> Payment Method</h3>
                    
                    <div class="payment-option">
                        <div class="form-check m-0">
                            <input type="radio" name="payment_method" value="Cash on Delivery" id="cod" class="form-check-input" checked>
                            <label class="form-check-label fw-semibold" for="cod">Cash on Delivery (COD)</label>
                        </div>
                    </div>

                    <div class="payment-option">
                        <div class="form-check m-0">
                            <input type="radio" name="payment_method" value="Bank Transfer" id="bank" class="form-check-input">
                            <label class="form-check-label fw-semibold" for="bank">Online Bank Transfer</label>
                        </div>
                    </div>

                    <div class="mt-4">
                        <label class="form-label fw-semibold">Order Notes (Optional)</label>
                        <textarea name="order_notes" class="form-control" placeholder="Any special instructions for delivery?"></textarea>
                    </div>

                    <button type="submit" name="place_order" class="btn btn-primary btn-place-order w-100 mt-5 shadow-sm">
                        Confirm & Place Order
                    </button>
                </form>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card summary-card p-4 sticky-top" style="top: 20px; z-index: 10;">
                <h4 class="fw-bold mb-4">Order Summary</h4>
                
                <div class="order-item-list border-bottom pb-3 mb-3">
                    <?php foreach ($_SESSION['cart'] as $item): ?>
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <div>
                                <h6 class="m-0 fw-semibold"><?php echo $item['name']; ?></h6>
                                <small class="text-muted">Quantity: <?php echo $item['quantity']; ?></small>
                            </div>
                            <span class="fw-bold text-dark">Rs. <?php echo number_format($item['price'] * $item['quantity']); ?></span>
                        </div>
                    <?php endforeach; ?>
                </div>

                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Subtotal</span>
                    <span class="fw-semibold text-dark">Rs. <?php echo number_format($subtotal); ?></span>
                </div>

                <div class="d-flex justify-content-between mb-2">
                    <span class="text-muted">Shipping Fee</span>
                    <span class="text-success fw-semibold">+ Rs. <?php echo $shipping; ?></span>
                </div>

                <div class="d-flex justify-content-between mb-3">
                    <span class="text-muted">Tax (5%)</span>
                    <span class="fw-semibold text-dark">Rs. <?php echo number_format($tax); ?></span>
                </div>

                <div class="border-top pt-3 d-flex justify-content-between align-items-center">
                    <h5 class="fw-bold mb-0">Total</h5>
                    <h4 class="fw-bold text-primary mb-0">Rs. <?php echo number_format($total); ?></h4>
                </div>
                
                <div class="mt-4 p-3 bg-light rounded text-center">
                    <small class="text-muted"><i class="bi bi-shield-check"></i> Secure Checkout Guaranteed</small>
                </div>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>