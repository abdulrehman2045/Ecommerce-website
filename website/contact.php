<?php
session_start();
include('../code.php'); // Aapka database connection file

$msg = "";

if(isset($_POST['send_message'])) {
    $name = mysqli_real_escape_string($connection, $_POST['name']);
    $email = mysqli_real_escape_string($connection, $_POST['email']);
    $subject = mysqli_real_escape_string($connection, $_POST['subject']);
    $message = mysqli_real_escape_string($connection, $_POST['message']);

    if(!empty($name) && !empty($email) && !empty($message)) {
        $query = "INSERT INTO contact_messages (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";
        $query_run = mysqli_query($connection, $query);

        if($query_run) {
            $msg = "<div class='alert alert-success'>Message sent successfully! We will contact you soon.</div>";
        } else {
            $msg = "<div class='alert alert-danger'>Something went wrong. Please try again.</div>";
        }
    } else {
        $msg = "<div class='alert alert-warning'>Please fill all required fields.</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us | MyStore</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    
    <style>
        body { font-family: 'Inter', sans-serif; background-color: #f4f7fe; }
        .contact-container { margin-top: 80px; margin-bottom: 80px; }
        .info-box { background: #4F46E5; color: white; border-radius: 20px; padding: 40px; height: 100%; }
        .form-box { background: white; border-radius: 20px; padding: 40px; shadow: 0 10px 30px rgba(0,0,0,0.05); }
        .icon-circle { width: 50px; height: 50px; background: rgba(255,255,255,0.2); border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 20px; font-size: 20px; }
        .form-control { border-radius: 10px; padding: 12px; border: 1px solid #e0e0e0; margin-bottom: 20px; }
        .btn-send { background: #4F46E5; color: white; padding: 12px 30px; border-radius: 10px; border: none; font-weight: 600; width: 100%; transition: 0.3s; }
        .btn-send:hover { background: #3730a3; transform: translateY(-2px); }
    </style>
</head>
<body>

<div class="container contact-container">
    <div class="row g-0 shadow-lg" style="border-radius: 20px; overflow: hidden;">
        
        <div class="col-lg-5">
            <div class="info-box">
                <h2 class="fw-bold mb-4">Contact Information</h2>
                <p class="mb-5" style="opacity: 0.8;">Send us a message, and our team will contact you within 24 hours.
</p>
                
                <div class="d-flex align-items-center mb-4">
                    <div class="icon-circle me-3"><i class="bi bi-telephone"></i></div>
                    <div>
                        <h6 class="mb-0">Phone</h6>
                        <p class="mb-0 small text-white-50">+92 300 1234567</p>
                    </div>
                </div>

                <div class="d-flex align-items-center mb-4">
                    <div class="icon-circle me-3"><i class="bi bi-envelope"></i></div>
                    <div>
                        <h6 class="mb-0">Email</h6>
                        <p class="mb-0 small text-white-50">support@mystore.com</p>
                    </div>
                </div>

                <div class="d-flex align-items-center mb-5">
                    <div class="icon-circle me-3"><i class="bi bi-geo-alt"></i></div>
                    <div>
                        <h6 class="mb-0">Address</h6>
                        <p class="mb-0 small text-white-50">Karachi, Sindh, Pakistan</p>
                    </div>
                </div>

                <div class="mt-auto pt-5">
                    <a href="#" class="text-white me-3 fs-4"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="text-white me-3 fs-4"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="text-white fs-4"><i class="bi bi-twitter"></i></a>
                </div>
            </div>
        </div>

        <div class="col-lg-7">
            <div class="form-box">
                <h3 class="fw-bold mb-4 text-dark">Get in Touch</h3>
                <?php echo $msg; ?>
                
                <form action="" method="POST">
                    <div class="row">
                        <div class="col-md-6">
                            <label class="form-label">Your Name</label>
                            <input type="text" name="name" class="form-control" placeholder="John Doe" required>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Email Address</label>
                            <input type="email" name="email" class="form-control" placeholder="john@example.com" required>
                        </div>
                    </div>

                    <label class="form-label">Subject</label>
                    <input type="text" name="subject" class="form-control" placeholder="How can we help?">

                    <label class="form-label">Message</label>
                    <textarea name="message" class="form-control" rows="5" placeholder="Write your message here..." required></textarea>

                    <button type="submit" name="send_message" class="btn-send">
                        Send Message <i class="bi bi-send ms-2"></i>
                    </button>
                </form>
            </div>
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>