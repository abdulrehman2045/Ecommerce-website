<?php
session_start();
include('../code.php');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Services - Rehman Store</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    
    <!-- AOS Animation Library -->
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #6a11cb;
            --secondary-color: #2575fc;
            --accent-color: #ff6b6b;
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
            background-color: #f5f7fb;
            color: #333;
            overflow-x: hidden;
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
        }
        
        .navbar-brand i {
            margin-right: 8px;
        }
        
        .nav-link {
            font-weight: 500;
            color: var(--dark-color) !important;
            margin: 0 0.5rem;
            position: relative;
            transition: all 0.3s ease;
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
        }
        
        .cart-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(106, 17, 203, 0.3);
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
        }
        
        .breadcrumb-item + .breadcrumb-item::before {
            color: rgba(255, 255, 255, 0.7);
            content: ">";
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
        
        /* Service Cards */
        .service-card {
            background: white;
            border-radius: 20px;
            padding: 40px 30px;
            text-align: center;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            transition: all 0.4s ease;
            height: 100%;
            position: relative;
            overflow: hidden;
            border: 1px solid rgba(0,0,0,0.05);
        }
        
        .service-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 5px;
            background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
            transform: scaleX(0);
            transition: transform 0.4s ease;
        }
        
        .service-card:hover::before {
            transform: scaleX(1);
        }
        
        .service-card:hover {
            transform: translateY(-15px);
            box-shadow: 0 20px 40px rgba(0,0,0,0.15);
        }
        
        .service-icon-wrapper {
            width: 100px;
            height: 100px;
            margin: 0 auto 25px;
            background: linear-gradient(135deg, rgba(106, 17, 203, 0.1), rgba(37, 117, 252, 0.1));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.4s ease;
        }
        
        .service-card:hover .service-icon-wrapper {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            transform: scale(1.1);
        }
        
        .service-icon {
            font-size: 40px;
            color: var(--primary-color);
            transition: all 0.4s ease;
        }
        
        .service-card:hover .service-icon {
            color: white;
        }
        
        .service-card h4 {
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--dark-color);
            font-size: 1.3rem;
        }
        
        .service-card p {
            color: #666;
            line-height: 1.6;
            margin-bottom: 0;
        }
        
        /* Features Section */
        .features-section {
            padding: 80px 0;
            background: white;
        }
        
        .feature-item {
            text-align: center;
            padding: 30px 20px;
            border-radius: 15px;
            transition: all 0.3s ease;
        }
        
        .feature-item:hover {
            background: rgba(106, 17, 203, 0.05);
            transform: translateY(-5px);
        }
        
        .feature-icon {
            width: 80px;
            height: 80px;
            margin: 0 auto 20px;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-size: 35px;
        }
        
        /* CTA Section */
        .cta-section {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            padding: 80px 0;
            text-align: center;
            position: relative;
            overflow: hidden;
        }
        
        .cta-section::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -50%;
            width: 200%;
            height: 200%;
            background: radial-gradient(circle, rgba(255,255,255,0.1) 0%, transparent 70%);
            animation: rotate 30s linear infinite;
        }
        
        @keyframes rotate {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }
        
        .cta-content {
            position: relative;
            z-index: 1;
        }
        
        .cta-btn {
            background: white;
            color: var(--primary-color);
            padding: 15px 40px;
            border-radius: 50px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            margin-top: 20px;
            transition: all 0.3s ease;
            border: 2px solid white;
        }
        
        .cta-btn:hover {
            background: transparent;
            color: white;
            transform: translateY(-3px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.2);
        }
        
        /* Footer */
        footer {
            background: var(--dark-color);
            color: white;
            padding: 60px 0 30px;
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
        
        .footer-links li {
            margin-bottom: 10px;
            list-style: none;
        }
        
        .footer-links a {
            color: rgba(255, 255, 255, 0.7);
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .footer-links a:hover {
            color: white;
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
            
            .service-card {
                padding: 30px 20px;
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
                        <a class="nav-link active" href="services.php">Services</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="product.php">Products</a>
                    </li>

                    <!-- Cart -->
                    <li class="nav-item ms-3">
                        <a href="cart.php" class="cart-btn">
                            <i class="fas fa-shopping-cart me-2"></i>Cart
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
                                <?php echo $_SESSION['user_name']; ?>
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
            <h1 data-aos="fade-down">Our Services</h1>
            <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="100">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Services</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- Main Services Section -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="fw-bold mb-3">What We Offer</h2>
                <p class="text-muted">We provide exceptional services to make your shopping experience unforgettable</p>
            </div>

            <div class="row g-4">
                <!-- Service 1 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="100">
                    <div class="service-card">
                        <div class="service-icon-wrapper">
                            <i class="fas fa-truck-fast service-icon"></i>
                        </div>
                        <h4>Fast Delivery</h4>
                        <p>Quick and reliable shipping nationwide. Get your orders delivered within 2-3 business days.</p>
                    </div>
                </div>

                <!-- Service 2 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="200">
                    <div class="service-card">
                        <div class="service-icon-wrapper">
                            <i class="fas fa-lock service-icon"></i>
                        </div>
                        <h4>Secure Payment</h4>
                        <p>100% secure payment gateway integration. Your financial information is always protected with encryption.</p>
                    </div>
                </div>

                <!-- Service 3 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="300">
                    <div class="service-card">
                        <div class="service-icon-wrapper">
                            <i class="fas fa-headset service-icon"></i>
                        </div>
                        <h4>24/7 Support</h4>
                        <p>Our support team is always ready to help you. Get instant assistance via chat, email, or phone.</p>
                    </div>
                </div>

                <!-- Service 4 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="400">
                    <div class="service-card">
                        <div class="service-icon-wrapper">
                            <i class="fas fa-undo service-icon"></i>
                        </div>
                        <h4>Easy Returns</h4>
                        <p>Hassle-free return policy within 30 days. Not satisfied? Return your product easily.</p>
                    </div>
                </div>

                <!-- Service 5 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="500">
                    <div class="service-card">
                        <div class="service-icon-wrapper">
                            <i class="fas fa-gift service-icon"></i>
                        </div>
                        <h4>Special Offers</h4>
                        <p>Exclusive deals and discounts for our loyal customers. Save more with every purchase.</p>
                    </div>
                </div>

                <!-- Service 6 -->
                <div class="col-lg-4 col-md-6" data-aos="fade-up" data-aos-delay="600">
                    <div class="service-card">
                        <div class="service-icon-wrapper">
                            <i class="fas fa-certificate service-icon"></i>
                        </div>
                        <h4>Quality Assurance</h4>
                        <p>All products are quality checked and certified. We guarantee authenticity and premium quality.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features-section">
        <div class="container">
            <div class="text-center mb-5" data-aos="fade-up">
                <h2 class="fw-bold mb-3">Why Choose Us</h2>
                <p class="text-muted">We go above and beyond to ensure your satisfaction</p>
            </div>

            <div class="row g-4">
                <div class="col-md-3 col-6" data-aos="zoom-in" data-aos-delay="100">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-users"></i>
                        </div>
                        <h5>10K+ Customers</h5>
                        <p class="text-muted small">Trusted by thousands</p>
                    </div>
                </div>

                <div class="col-md-3 col-6" data-aos="zoom-in" data-aos-delay="200">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-box"></i>
                        </div>
                        <h5>500+ Products</h5>
                        <p class="text-muted small">Wide variety</p>
                    </div>
                </div>

                <div class="col-md-3 col-6" data-aos="zoom-in" data-aos-delay="300">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-star"></i>
                        </div>
                        <h5>4.8 Rating</h5>
                        <p class="text-muted small">Excellent reviews</p>
                    </div>
                </div>

                <div class="col-md-3 col-6" data-aos="zoom-in" data-aos-delay="400">
                    <div class="feature-item">
                        <div class="feature-icon">
                            <i class="fas fa-award"></i>
                        </div>
                        <h5>Award Winning</h5>
                        <p class="text-muted small">Best service 2023</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta-section">
        <div class="container">
            <div class="cta-content" data-aos="fade-up">
                <h2 class="mb-3">Ready to Start Shopping?</h2>
                <p class="lead mb-4">Join thousands of satisfied customers and experience the best online shopping</p>
                <a href="product.php" class="cta-btn">
                    <i class="fas fa-shopping-bag me-2"></i>Shop Now
                </a>
            </div>
        </div>
    </section>

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
                        <p><i class="fas fa-map-marker-alt me-2"></i>123 Fashion Street, NY 10001</p>
                        <p><i class="fas fa-phone me-2"></i>+1 (123) 456-7890</p>
                        <p><i class="fas fa-envelope me-2"></i>info@rehmanstore.com</p>
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
    </script>
</body>
</html>