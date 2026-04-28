<?php
session_start();

// ADMIN SESSION CHECK
if(!isset($_SESSION['admin_id'])){
    header("Location: login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Admin Panel</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<!-- Bootstrap -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>
 body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
            /* min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 20px; */
        }
.admin-header { height:60px; background:#0d6efd; color:#fff; }
.sidebar { width:240px; min-height:100vh; background:#212529; position:fixed; top:60px; left:0; }
.sidebar a { color:#adb5bd; text-decoration:none; padding:12px 20px; display:block; }
.sidebar a:hover { background:#0d6efd; color:#fff; }
.sidebar a i { margin-right:10px; }
.content { margin-left:240px; padding:20px; margin-top:60px; }
</style>
</head>
<body>

<nav class="navbar admin-header fixed-top px-4">
    <span class="navbar-brand mb-0 h5 text-white">
        <i class="bi bi-speedometer2"></i> <?php echo $_SESSION['admin_name']; ?>
    </span>
    <!-- <div class="dropdown">
      <a class="text-white dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown">
        <i class="bi bi-person-circle"></i> Admin
      </a>
      <ul class="dropdown-menu dropdown-menu-end">
        <li><a class="dropdown-item" href="#">Profile</a></li>
        <li><a class="dropdown-item" href="#">Settings</a></li>
        <li><hr class="dropdown-divider"></li>
        <li><a class="dropdown-item text-danger" href="logout.php">Logout</a></li>
      </ul>
    </div> -->
</nav>

<div class="sidebar">
  <a href="public.php?user"><i class="bi bi-people"></i> Users</a>
  <a href="public.php?pro"><i class="bi bi-bag"></i> Products</a>
  <a href="public.php?order"><i class="bi bi-cart"></i> Orders</a>
  <a href="logout.php"><i class="bi bi-gear"></i> Logout</a>
</div>
 
<div class="content">
<?php 
if(isset($_GET['user'])){ include "user.php"; }
if(isset($_GET['pro'])){ include "addproduct.php"; }
if(isset($_GET['order'])){ include "order.php"; }
?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
