<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Stylish Sign-Up Form</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }

        .form-container {
            background: #fff;
            border-radius: 15px;
            padding: 40px 30px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .form-container:hover {
            transform: translateY(-5px);
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.3);
        }

        h1 {
            font-weight: 700;
            margin-bottom: 30px;
            color: #2575fc;
            text-shadow: 1px 1px 3px rgba(0,0,0,0.2);
        }

        .form-control {
            border-radius: 50px;
            padding: 15px 20px;
            border: 1px solid #ddd;
            transition: all 0.3s ease;
        }

        .form-control:focus {
            border-color: #2575fc;
            box-shadow: 0 0 10px rgba(37,117,252,0.3);
        }

        .btn-primary {
            border-radius: 50px;
            padding: 12px 0;
            font-weight: 600;
            font-size: 1.1rem;
            background: linear-gradient(45deg, #6a11cb, #2575fc);
            border: none;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background: linear-gradient(45deg, #2575fc, #6a11cb);
            transform: scale(1.05);
            box-shadow: 0 8px 20px rgba(0,0,0,0.2);
        }

        @media (max-width: 576px) {
            .form-container {
                padding: 30px 20px;
            }
        }
    </style>
</head>
<body>

    <div class="form-container col-md-6 col-lg-5">
        <h1 class="text-center">Sign-Up</h1>

        <form action="code.php" method="POST">

            <input type="text"
                   name="name"
                   placeholder="Enter your name"
                   class="form-control mb-3"
                   required>

            <input type="email"
                   name="email"
                   placeholder="Enter your email"
                   class="form-control mb-3"
                   required>

            <input type="password"
                   name="pass"
                   placeholder="Enter your password"
                   class="form-control mb-4"
                   required>

            <button type="submit"
                    name="form"
                    class="btn btn-primary w-100">
                Submit
            </button>

        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
