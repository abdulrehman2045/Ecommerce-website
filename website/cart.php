<?php
session_start();
include('../code.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - Rehman Store</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- AOS Animation -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #6a11cb;
            --secondary-color: #2575fc;
            --accent-color: #ff6b6b;
            --success-color: #28a745;
            --warning-color: #ffc107;
            --light-color: #f8f9fa;
            --dark-color: #212529;
        }
        
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #f5f7fb 0%, #e9ecef 100%);
            min-height: 100vh;
            padding-bottom: 100px;
        }
        
        /* Navbar Styles */
        .navbar {
            background: #fff;
            box-shadow: 0 2px 15px rgba(0,0,0,0.08);
            padding: 1rem 0;
            transition: all 0.3s ease;
        }
        
        .navbar-brand {
            font-weight: 700;
            font-size: 1.5rem;
            color: var(--primary-color) !important;
            display: flex;
            align-items: center;
        }
        
        .navbar-brand i {
            margin-right: 8px;
        }
        
        .navbar-nav {
            align-items: center;
        }
        
        .nav-link {
            font-weight: 500;
            color: var(--dark-color) !important;
            margin: 0 0.5rem;
            position: relative;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
        }
        
        .nav-link:after {
            content: '';
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 0;
            height: 2px;
            background: var(--primary-color);
            transition: width 0.3s ease;
        }
        
        .nav-link:hover:after {
            width: 100%;
        }
        
        .nav-link:hover {
            color: var(--primary-color) !important;
        }
        
        /* Cart Button */
        .cart-btn {
            position: relative;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            padding: 0.5rem 1.2rem;
            border-radius: 30px;
            font-weight: 500;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            text-decoration: none;
        }
        
        .cart-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(106, 17, 203, 0.3);
            color: white;
        }
        
        .cart-badge {
            position: absolute;
            top: -8px;
            right: -8px;
            background: var(--accent-color);
            color: white;
            font-size: 0.7rem;
            width: 20px;
            height: 20px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: pulse 1.5s infinite;
        }
        
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.1); }
            100% { transform: scale(1); }
        }
        
        .user-welcome {
            display: flex;
            align-items: center;
            color: var(--dark-color);
            font-weight: 500;
        }
        
        /* Page Header */
        .page-header {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 80px 0 60px;
            position: relative;
            overflow: hidden;
        }
        
        .page-header::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: url('data:image/svg+xml;utf8,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320"><path fill="%23ffffff" fill-opacity="0.1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,138.7C960,139,1056,117,1152,112C1248,107,1344,117,1392,122.7L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path></svg>') no-repeat bottom;
            background-size: cover;
        }
        
        .page-header h1 {
            font-size: 3rem;
            font-weight: 700;
            margin-bottom: 1rem;
        }
        
        .breadcrumb {
            background: transparent;
            padding: 0;
            margin: 0;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .breadcrumb-item + .breadcrumb-item::before {
            color: rgba(255, 255, 255, 0.7);
            content: ">";
            padding: 0 0.5rem;
        }
        
        .breadcrumb-item a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .breadcrumb-item a:hover {
            color: white;
        }
        
        .breadcrumb-item.active {
            color: white;
        }
        
        /* Cart Container */
        .cart-container {
            background: white;
            border-radius: 20px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
            padding: 30px;
            margin-top: -50px;
            position: relative;
            z-index: 10;
        }
        
        /* Cart Table */
        .cart-table {
            background: white;
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 5px 20px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }
        
        .cart-table thead {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }
        
        .cart-table th {
            border: none;
            padding: 20px 15px;
            font-weight: 600;
            text-transform: uppercase;
            font-size: 0.85rem;
            letter-spacing: 0.5px;
            text-align: center;
        }
        
        .cart-table th:first-child {
            text-align: left;
        }
        
        .cart-table td {
            vertical-align: middle;
            padding: 20px 15px;
            border-color: #f0f0f0;
            text-align: center;
        }
        
        .cart-table td:first-child {
            text-align: left;
        }
        
        .product-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }
        
        .product-img {
            width: 80px;
            height: 80px;
            object-fit: cover;
            border-radius: 12px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
            flex-shrink: 0;
        }
        
        .product-img:hover {
            transform: scale(1.05);
        }
        
        .product-name {
            font-weight: 600;
            color: var(--dark-color);
            font-size: 1rem;
            margin: 0;
            line-height: 1.4;
        }
        
        .product-price {
            font-weight: 600;
            color: var(--primary-color);
            font-size: 1.1rem;
            margin: 0;
        }
        
        /* Quantity Controls */
        .quantity-control {
            display: flex;
            align-items: center;
            justify-content: center;
            background: #f8f9fa;
            border-radius: 30px;
            padding: 5px;
            min-width: 120px;
            margin: 0 auto;
        }
        
        .quantity-btn {
            width: 30px;
            height: 30px;
            border: none;
            background: white;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .quantity-btn:hover {
            background: var(--primary-color);
            color: white;
            transform: scale(1.1);
        }
        
        .quantity-input {
            width: 40px;
            text-align: center;
            border: none;
            background: transparent;
            font-weight: 600;
            font-size: 1rem;
        }
        
        .quantity-input:focus {
            outline: none;
        }
        
        /* Remove Button */
        .remove-btn {
            background: #ff4757;
            color: white;
            border: none;
            padding: 8px 15px;
            border-radius: 20px;
            cursor: pointer;
            transition: all 0.3s ease;
            font-size: 0.85rem;
            display: inline-flex;
            align-items: center;
            gap: 5px;
            text-decoration: none;
        }
        
        .remove-btn:hover {
            background: #ff3838;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 71, 87, 0.3);
            color: white;
        }
        
        /* Summary Card */
        .summary-card {
            background: white;
            border-radius: 20px;
            padding: 30px;
            box-shadow: 0 10px 40px rgba(0,0,0,0.08);
            position: sticky;
            top: 100px;
        }
        
        .summary-card h4 {
            font-weight: 700;
            color: var(--dark-color);
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 2px solid #f0f0f0;
            text-align: center;
        }
        
        .summary-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
            font-size: 0.95rem;
        }
        
        .summary-row.total {
            font-size: 1.2rem;
            font-weight: 700;
            color: var(--primary-color);
            padding-top: 15px;
            border-top: 2px solid #f0f0f0;
            margin-top: 20px;
        }
        
        .promo-section {
            margin: 25px 0;
        }
        
        .promo-code {
            display: flex;
            gap: 10px;
            margin-bottom: 10px;
        }
        
        .promo-input {
            flex: 1;
            padding: 12px 15px;
            border: 2px solid #e0e0e0;
            border-radius: 30px;
            font-size: 0.9rem;
            transition: all 0.3s ease;
        }
        
        .promo-input:focus {
            outline: none;
            border-color: var(--primary-color);
        }
        
        .promo-btn {
            padding: 12px 25px;
            background: var(--primary-color);
            color: white;
            border: none;
            border-radius: 30px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            white-space: nowrap;
        }
        
        .promo-btn:hover {
            background: var(--secondary-color);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(106, 17, 203, 0.3);
        }
        
        .checkout-btn {
            width: 100%;
            padding: 15px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            border-radius: 30px;
            font-weight: 600;
            font-size: 1.1rem;
            cursor: pointer;
            transition: all 0.3s ease;
            margin-top: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }
        
        .checkout-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(106, 17, 203, 0.3);
        }
        
        .continue-shopping {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            margin-top: 20px;
            color: var(--primary-color);
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        
        .continue-shopping:hover {
            color: var(--secondary-color);
            transform: translateX(5px);
        }
        
        /* Empty Cart */
        .empty-cart {
            text-align: center;
            padding: 60px 20px;
        }
        
        .empty-cart-icon {
            font-size: 100px;
            color: #ddd;
            margin-bottom: 30px;
        }
        
        .empty-cart h3 {
            color: var(--dark-color);
            margin-bottom: 15px;
        }
        
        .empty-cart p {
            color: #666;
            margin-bottom: 30px;
        }
        
        .shop-now-btn {
            padding: 12px 40px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            text-decoration: none;
            border-radius: 30px;
            font-weight: 600;
            display: inline-flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }
        
        .shop-now-btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(106, 17, 203, 0.3);
            color: white;
        }
        
        /* Footer */
        footer {
            background: var(--dark-color);
            color: white;
            padding: 60px 0 30px;
            margin-top: 80px;
        }
        
        .footer-widget h4 {
            font-size: 1.2rem;
            font-weight: 600;
            margin-bottom: 25px;
            position: relative;
            padding-bottom: 10px;
        }
        
        .footer-widget h4::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 50px;
            height: 2px;
            background: var(--primary-color);
        }
        
        .footer-widget p {
            margin-bottom: 20px;
            line-height: 1.8;
        }
        
        .footer-links {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .footer-links li {
            margin-bottom: 10px;
        }
        
        .footer-links a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: color 0.3s;
            display: flex;
            align-items: center;
        }
        
        .footer-links a:hover {
            color: white;
        }
        
        .social-links {
            display: flex;
            gap: 15px;
            margin-top: 20px;
        }
        
        .social-links a {
            width: 40px;
            height: 40px;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            transition: all 0.3s ease;
        }
        
        .social-links a:hover {
            background: var(--primary-color);
            transform: translateY(-3px);
        }
        
        .copyright {
            margin-top: 50px;
            padding-top: 20px;
            border-top: 1px solid rgba(255, 255, 255, 0.1);
            text-align: center;
            color: rgba(255, 255, 255, 0.7);
        }
        
        /* Responsive */
        @media (max-width: 768px) {
            .page-header h1 {
                font-size: 2rem;
            }
            
            .cart-table {
                font-size: 0.9rem;
            }
            
            .product-img {
                width: 60px;
                height: 60px;
            }
            
            .quantity-control {
                min-width: 100px;
            }
            
            .summary-card {
                margin-top: 30px;
                position: static;
            }
            
            .cart-table th,
            .cart-table td {
                padding: 10px 5px;
                font-size: 0.85rem;
            }
            
            .product-name {
                font-size: 0.9rem;
            }
            
            .product-price {
                font-size: 1rem;
            }
        }
        
        @media (max-width: 576px) {
            .navbar-brand {
                font-size: 1.2rem;
            }
            
            .cart-btn {
                padding: 0.4rem 1rem;
                font-size: 0.9rem;
            }
            
            .cart-table {
                overflow-x: auto;
            }
            
            .cart-table table {
                min-width: 600px;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light sticky-top">
        <div class="container">
            <a class="navbar-brand" href="index.php">
                <i class="fas fa-store"></i>Rehman Store
            </a>

            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto align-items-center">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="services.php">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="product.php">Products</a>
                    </li>

                    <!-- Cart -->
                    <li class="nav-item ms-3">
                        <a href="cart.php" class="cart-btn">
                            <i class="fas fa-shopping-cart"></i>
                            <span class="ms-2">Cart</span>
                            <?php if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0): ?>
                                <span class="cart-badge"><?php echo count($_SESSION['cart']); ?></span>
                            <?php endif; ?>
                        </a>
                    </li>
                    
                    <!-- Login / User Name -->
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <li class="nav-item ms-3">
                            <div class="user-welcome">
                                <i class="fas fa-user-circle me-2"></i>
                                <?php echo htmlspecialchars($_SESSION['user_name']); ?>
                            </div>
                        </li>
                        <li class="nav-item ms-3">
                            <a href="../logout.php" class="btn btn-outline-danger btn-sm">
                                <i class="fas fa-sign-out-alt me-1"></i>Logout
                            </a>
                        </li>
                    <?php else: ?>
                        <li class="nav-item ms-3">
                            <a href="../login.php" class="btn btn-success">
                                <i class="fas fa-sign-in-alt me-1"></i>Login
                            </a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <section class="page-header">
        <div class="container text-center">
            <h1 data-aos="fade-down">Shopping Cart</h1>
            <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="100">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="product.php">Products</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Cart</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Cart Content -->
    <div class="container">
        <div class="cart-container" data-aos="fade-up">
            <?php
            $total = 0;
            $subtotal = 0;
            $shipping = 50; // Fixed shipping cost
            $tax = 0;
            
            if(isset($_SESSION['cart']) && count($_SESSION['cart']) > 0):
            ?>
            
            <div class="row">
                <div class="col-lg-8">
                    <div class="cart-table">
                        <div class="table-responsive">
                            <table class="table table-hover mb-0">
                                <thead>
                                    <tr>
                                        <th>Product</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Total</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach($_SESSION['cart'] as $id => $item):
                                        $item_total = $item['price'] * $item['quantity'];
                                        $subtotal += $item_total;
                                    ?>
                                    <tr>
                                        <td>
                                            <div class="product-info">
                                                <img src="../uploads/<?php echo htmlspecialchars($item['image']); ?>" 
                                                     alt="<?php echo htmlspecialchars($item['name']); ?>" 
                                                     class="product-img">
                                                <p class="product-name"><?php echo htmlspecialchars($item['name']); ?></p>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="product-price">Rs. <?php echo number_format($item['price'], 2); ?></p>
                                        </td>
                                        <td>
                                            <div class="quantity-control">
                                                <button class="quantity-btn" onclick="updateQuantity('<?php echo $id; ?>', '<?php echo $item['quantity'] - 1; ?>')">
                                                    <i class="fas fa-minus"></i>
                                                </button>
                                                <input type="text" class="quantity-input" value="<?php echo $item['quantity']; ?>" readonly>
                                                <button class="quantity-btn" onclick="updateQuantity('<?php echo $id; ?>', '<?php echo $item['quantity'] + 1; ?>')">
                                                    <i class="fas fa-plus"></i>
                                                </button>
                                            </div>
                                        </td>
                                        <td>
                                            <p class="product-price">Rs. <?php echo number_format($item_total, 2); ?></p>
                                        </td>
                                        <td>
                                            <a href="remove.php?id=<?php echo $id; ?>" 
                                               class="remove-btn"
                                               onclick="return confirm('Are you sure you want to remove this item?')">
                                                <i class="fas fa-trash"></i>
                                                <span>Remove</span>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                    <div class="text-center">
                        <a href="product.php" class="continue-shopping">
                            <i class="fas fa-arrow-left"></i>
                            <span>Continue Shopping</span>
                        </a>
                    </div>
                </div>

                <div class="col-lg-4">
                    <div class="summary-card">
                        <h4>Order Summary</h4>
                        
                        <div class="summary-row">
                            <span>Subtotal:</span>
                            <span>Rs. <?php echo number_format($subtotal, 2); ?></span>
                        </div>
                        
                        <div class="summary-row">
                            <span>Shipping:</span>
                            <span>Rs. <?php echo number_format($shipping, 2); ?></span>
                        </div>
                        
                        <div class="summary-row">
                            <span>Tax (5%):</span>
                            <span>Rs. <?php $tax = $subtotal * 0.05; echo number_format($tax, 2); ?></span>
                        </div>
                        
                        <div class="summary-row total">
                            <span>Total:</span>
                            <span>Rs. <?php $total = $subtotal + $shipping + $tax; echo number_format($total, 2); ?></span>
                        </div>
                        
                        <div class="promo-section">
                            <div class="promo-code">
                                <input type="text" class="promo-input" placeholder="Promo code" id="promoCode">
                                <button class="promo-btn" onclick="applyPromo()">Apply</button>
                            </div>
                        </div>
                        
                        <form method="POST" action="checkout.php">
                            <input type="hidden" name="total_amount" value="<?php echo $total; ?>">
                            <input type="hidden" name="subtotal" value="<?php echo $subtotal; ?>">
                            <input type="hidden" name="shipping" value="<?php echo $shipping; ?>">
                            <input type="hidden" name="tax" value="<?php echo $tax; ?>">
                            <button type="submit" name="checkout" class="checkout-btn">
                                <i class="fas fa-lock"></i>
                                <span>Proceed to Checkout</span>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
            
            <?php else: ?>
            
            <!-- Empty Cart -->
            <div class="empty-cart">
                <div class="empty-cart-icon">
                    <i class="fas fa-shopping-cart"></i>
                </div>
                <h3>Your Cart is Empty</h3>
                <p>Looks like you haven't added anything to your cart yet</p>
                <a href="product.php" class="shop-now-btn">
                    <i class="fas fa-shopping-bag"></i>
                    <span>Shop Now</span>
                </a>
            </div>
            
            <?php endif; ?>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4 mb-lg-0">
                    <div class="footer-widget">
                        <h4>About Rehman Store</h4>
                        <p>We are dedicated to providing high-quality fashion products at affordable prices with exceptional customer service.</p>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-instagram"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-2 col-md-6 mb-4 mb-lg-0">
                    <div class="footer-widget">
                        <h4>Quick Links</h4>
                        <ul class="footer-links">
                            <li><a href="index.php">Home</a></li>
                            <li><a href="about.php">About Us</a></li>
                            <li><a href="services.php">Services</a></li>
                            <li><a href="product.php">Products</a></li>
                            <li><a href="contact.php">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4 mb-lg-0">
                    <div class="footer-widget">
                        <h4>Customer Service</h4>
                        <ul class="footer-links">
                            <li><a href="#">Shipping Information</a></li>
                            <li><a href="#">Returns & Exchanges</a></li>
                            <li><a href="#">Size Guide</a></li>
                            <li><a href="#">FAQs</a></li>
                            <li><a href="#">Terms & Conditions</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <h4>Contact Info</h4>
                        <ul class="footer-links">
                            <li>
                                <a href="#" style="pointer-events: none; cursor: default;">
                                    <i class="fas fa-map-marker-alt me-2"></i>
                                    123 Fashion Street, NY 10001
                                </a>
                            </li>
                            <li>
                                <a href="tel:+11234567890">
                                    <i class="fas fa-phone me-2"></i>
                                    +1 (123) 456-7890
                                </a>
                            </li>
                            <li>
                                <a href="mailto:info@rehmanstore.com">
                                    <i class="fas fa-envelope me-2"></i>
                                    info@rehmanstore.com
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="copyright">
                <p>&copy; <?php echo date('Y'); ?> Rehman Store. All Rights Reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        // Initialize AOS
        AOS.init({
            duration: 800,
            once: true
        });
        
        // Update Quantity Function
        function updateQuantity(productId, newQuantity) {
            if(newQuantity < 1) {
                if(confirm('Remove this item from cart?')) {
                    window.location.href = 'remove.php?id=' + productId;
                }
                return;
            }
            
            // Create form data
            const formData = new FormData();
            formData.append('update_quantity', 'true');
            formData.append('product_id', productId);
            formData.append('quantity', newQuantity);
            
            // Send AJAX request
            fetch('update_cart.php', {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if(data.success) {
                    location.reload();
                } else {
                    alert('Error updating quantity');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('Error updating quantity');
            });
        }
        
        // Apply Promo Code
        function applyPromo() {
            const promoCode = document.getElementById('promoCode').value;
            if(!promoCode) {
                alert('Please enter a promo code');
                return;
            }
            
            // Here you would typically send an AJAX request to validate the promo code
            // For demo purposes, we'll just show an alert
            if(promoCode.toUpperCase() === 'SAVE10') {
                alert('Promo code applied! You saved 10%');
                location.reload();
            } else {
                alert('Invalid promo code');
            }
        }
    </script>
</body>
</html>