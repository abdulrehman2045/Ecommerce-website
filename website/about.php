<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Rehman Store</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
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
        
        /* About Section */
        .about-section {
            padding: 80px 0;
        }
        
        .about-image {
            border-radius: 15px;
            overflow: hidden;
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
            transition: transform 0.5s ease;
        }
        
        .about-image:hover {
            transform: scale(1.03);
        }
        
        .about-content h2 {
            font-size: 2.5rem;
            font-weight: 700;
            color: var(--primary-color);
            margin-bottom: 1.5rem;
        }
        
        .about-content p {
            font-size: 1.1rem;
            line-height: 1.8;
            margin-bottom: 1.5rem;
            color: #555;
        }
        
        .feature-box {
            background: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.05);
            margin-bottom: 30px;
            transition: all 0.3s ease;
            height: 100%;
        }
        
        .feature-box:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.1);
        }
        
        .feature-icon {
            width: 70px;
            height: 70px;
            background: linear-gradient(45deg, var(--primary-color), var(--secondary-color));
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-bottom: 20px;
            color: white;
            font-size: 1.8rem;
        }
        
        .feature-box h4 {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 15px;
            color: var(--dark-color);
        }
        
        .team-member {
            text-align: center;
            margin-bottom: 30px;
        }
        
        .team-member img {
            width: 200px;
            height: 200px;
            object-fit: cover;
            border-radius: 50%;
            margin-bottom: 20px;
            border: 5px solid white;
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
        }
        
        .team-member:hover img {
            transform: scale(1.05);
        }
        
        .team-member h4 {
            font-size: 1.3rem;
            font-weight: 600;
            margin-bottom: 5px;
        }
        
        .team-member p {
            color: #666;
            margin-bottom: 15px;
        }
        
        .social-links a {
            display: inline-block;
            width: 40px;
            height: 40px;
            line-height: 40px;
            text-align: center;
            background: #f5f7fb;
            border-radius: 50%;
            margin: 0 5px;
            color: var(--primary-color);
            transition: all 0.3s ease;
        }
        
        .social-links a:hover {
            background: var(--primary-color);
            color: white;
            transform: translateY(-3px);
        }
        
        /* Timeline */
        .timeline {
            position: relative;
            padding: 20px 0;
        }
        
        .timeline::before {
            content: '';
            position: absolute;
            top: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 2px;
            height: 100%;
            background: var(--primary-color);
        }
        
        .timeline-item {
            position: relative;
            margin-bottom: 50px;
        }
        
        .timeline-content {
            position: relative;
            width: 45%;
            padding: 20px 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
        }
        
        .timeline-item:nth-child(odd) .timeline-content {
            margin-left: auto;
        }
        
        .timeline-date {
            position: absolute;
            top: 0;
            width: 45%;
            text-align: right;
            padding-right: 30px;
            font-weight: 600;
            color: var(--primary-color);
        }
        
        .timeline-item:nth-child(odd) .timeline-date {
            left: 0;
            text-align: left;
            padding-left: 30px;
        }
        
        .timeline-dot {
            position: absolute;
            top: 10px;
            left: 50%;
            transform: translateX(-50%);
            width: 20px;
            height: 20px;
            background: white;
            border: 4px solid var(--primary-color);
            border-radius: 50%;
            z-index: 1;
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
            
            .about-content h2 {
                font-size: 1.8rem;
            }
            
            .timeline::before {
                left: 30px;
            }
            
            .timeline-content {
                width: calc(100% - 60px);
                margin-left: 60px !important;
            }
            
            .timeline-date {
                width: auto;
                position: relative;
                margin-bottom: 10px;
                text-align: left !important;
                padding-left: 0 !important;
                padding-right: 0 !important;
            }
            
            .timeline-dot {
                left: 30px;
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
                        <a class="nav-link active" href="about.php">About</a>
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
            <h1 data-aos="fade-down">About Us</h1>
            <nav aria-label="breadcrumb" data-aos="fade-up" data-aos-delay="100">
                <ol class="breadcrumb justify-content-center">
                    <li class="breadcrumb-item"><a href="index.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">About Us</li>
                </ol>
            </nav>
        </div>
    </section>

    <!-- About Section -->
    <section class="about-section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 mb-5 mb-lg-0" data-aos="fade-right">
                    <div class="about-image">
                        <img src="https://images.unsplash.com/photo-1556742049-0cfed4f6a45d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" class="img-fluid" alt="About Our Store">
                    </div>
                </div>
                <div class="col-lg-6" data-aos="fade-left">
                    <div class="about-content">
                        <h2>Our Story</h2>
                        <p>Rehman Store began with a simple mission: to provide high-quality fashion products at affordable prices. What started as a small boutique has grown into a beloved online shopping destination.</p>
                        <p>Our commitment to quality, value, and customer satisfaction has been the cornerstone of our success. We carefully curate our collection to ensure every item meets our high standards.</p>
                        <p>Today, we're proud to serve thousands of customers worldwide, offering the latest trends in fashion while maintaining our dedication to exceptional service.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-truck"></i>
                        </div>
                        <h4>Fast Delivery</h4>
                        <p>We offer quick and reliable shipping to get your products to you as fast as possible.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <h4>Secure Payment</h4>
                        <p>Your payment information is safe with our encrypted and secure payment process.</p>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 mb-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="feature-box">
                        <div class="feature-icon">
                            <i class="fas fa-undo"></i>
                        </div>
                        <h4>Easy Returns</h4>
                        <p>Not satisfied with your purchase? We offer hassle-free returns within 30 days.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="py-5">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold" data-aos="fade-up">Meet Our Team</h2>
                <p class="lead text-muted" data-aos="fade-up" data-aos-delay="100">The talented people behind Rehman Store</p>
            </div>
            <div class="row">
                <div class="col-lg-3 col-md-6 mb-4" data-aos="zoom-in" data-aos-delay="100">
                    <div class="team-member">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Team Member">
                        <h4>John Smith</h4>
                        <p>Founder & CEO</p>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4" data-aos="zoom-in" data-aos-delay="200">
                    <div class="team-member">
                        <img src="https://images.unsplash.com/photo-1494790108755-2616b612b786?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Team Member">
                        <h4>Sarah Johnson</h4>
                        <p>Head of Design</p>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4" data-aos="zoom-in" data-aos-delay="300">
                    <div class="team-member">
                        <img src="https://images.unsplash.com/photo-1500648767791-00dcc994a43e?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1170&q=80" alt="Team Member">
                        <h4>Michael Chen</h4>
                        <p>Marketing Director</p>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 mb-4" data-aos="zoom-in" data-aos-delay="400">
                    <div class="team-member">
                        <img src="https://images.unsplash.com/photo-1573496359142-b8d87734a5a2?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=1188&q=80" alt="Team Member">
                        <h4>Emily Davis</h4>
                        <p>Customer Success</p>
                        <div class="social-links">
                            <a href="#"><i class="fab fa-facebook-f"></i></a>
                            <a href="#"><i class="fab fa-twitter"></i></a>
                            <a href="#"><i class="fab fa-linkedin-in"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Timeline Section -->
    <section class="py-5 bg-light">
        <div class="container">
            <div class="text-center mb-5">
                <h2 class="fw-bold" data-aos="fade-up">Our Journey</h2>
                <p class="lead text-muted" data-aos="fade-up" data-aos-delay="100">Milestones that shaped our company</p>
            </div>
            <div class="timeline">
                <div class="timeline-item" data-aos="fade-up">
                    <div class="timeline-date">2015</div>
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h4>Company Founded</h4>
                        <p>Rehman Store was established with a small team and a big vision.</p>
                    </div>
                </div>
                <div class="timeline-item" data-aos="fade-up">
                    <div class="timeline-date">2017</div>
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h4>First Physical Store</h4>
                        <p>Opened our first brick-and-mortar location in downtown.</p>
                    </div>
                </div>
                <div class="timeline-item" data-aos="fade-up">
                    <div class="timeline-date">2019</div>
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h4>E-commerce Launch</h4>
                        <p>Expanded our reach by launching our online shopping platform.</p>
                    </div>
                </div>
                <div class="timeline-item" data-aos="fade-up">
                    <div class="timeline-date">2021</div>
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h4>International Expansion</h4>
                        <p>Began shipping to customers worldwide, reaching new markets.</p>
                    </div>
                </div>
                <div class="timeline-item" data-aos="fade-up">
                    <div class="timeline-date">2023</div>
                    <div class="timeline-dot"></div>
                    <div class="timeline-content">
                        <h4>100,000+ Customers</h4>
                        <p>Celebrated serving over 100,000 satisfied customers globally.</p>
                    </div>
                </div>
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