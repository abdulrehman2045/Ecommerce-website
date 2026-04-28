<?php
include "code.php";
$result = mysqli_query($connection,"SELECT * FROM products");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Add Product</title>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

<style>
body{
  font-family:'Poppins',sans-serif;
  background:linear-gradient(135deg,#6a11cb,#2575fc);
  min-height:100vh;
  padding:40px 15px;
}
.form-card{
  background:#fff;
  border-radius:15px;
  padding:35px;
  box-shadow:0 15px 35px rgba(0,0,0,.2);
}
h2{
  text-align:center;
  color:#2575fc;
  font-weight:700;
  margin-bottom:25px;
}
.form-control{border-radius:30px;padding:12px 18px;}
.btn-primary{
  border-radius:30px;
  font-weight:600;
  background:linear-gradient(45deg,#6a11cb,#2575fc);
  border:none;
}
.table img{border-radius:10px;}
</style>
</head>

<body>

<div class="container">

<!-- ADD PRODUCT -->
<div class="row justify-content-center mb-5">
  <div class="col-md-6">
    <div class="form-card">
      <h2>Add Product</h2>
      <form action="code.php" method="POST" enctype="multipart/form-data">
        <input type="text" name="product_name" class="form-control mb-3" placeholder="Product Name" required>
        <input type="number" name="product_price" class="form-control mb-3" placeholder="Product Price" required>
        <input type="text" name="product_category" class="form-control mb-3" placeholder="Product Category" required>
        <input type="file" name="product_image" class="form-control mb-4" required>
        <button type="submit" name="add_product" class="btn btn-primary w-100">Add Product</button>
      </form>
    </div>
  </div>
</div>

<!-- PRODUCT TABLE -->
<div class="card shadow">
<div class="card-header bg-dark text-white">
  <h5 class="mb-0">Stored Products</h5>
</div>

<div class="card-body table-responsive">
<table class="table table-bordered table-hover text-center align-middle">
<thead class="table-dark">
<tr>
<th>ID</th><th>Image</th><th>Name</th><th>Price</th><th>Category</th><th>Action</th>
</tr>
</thead>
<tbody>

<?php while($row=mysqli_fetch_assoc($result)){ ?>
<tr>
<td><?= $row['id'] ?></td>
<td><img src="uploads/<?= $row['product_image'] ?>" width="60"></td>
<td><?= $row['product_name'] ?></td>
<td><?= $row['product_price'] ?></td>
<td><?= $row['product_category'] ?></td>
<td>
<button class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#up<?= $row['id'] ?>">Update</button>
<a href="code.php?delete=<?= $row['id'] ?>&img=<?= $row['product_image'] ?>"
   onclick="return confirm('Delete product?')" class="btn btn-danger btn-sm">Delete</a>
</td>
</tr>

<!-- UPDATE MODAL -->
<div class="modal fade" id="up<?= $row['id'] ?>">
<div class="modal-dialog modal-dialog-centered">
<div class="modal-content">
<form action="code.php" method="POST" enctype="multipart/form-data">
<div class="modal-header bg-warning">
<h5 class="modal-title">Update Product</h5>
<button type="button" class="btn-close" data-bs-dismiss="modal"></button>
</div>
<div class="modal-body">
<input type="hidden" name="id" value="<?= $row['id'] ?>">
<input type="hidden" name="old_image" value="<?= $row['product_image'] ?>">

<input type="text" name="product_name" class="form-control mb-2" value="<?= $row['product_name'] ?>" required>
<input type="number" name="product_price" class="form-control mb-2" value="<?= $row['product_price'] ?>" required>
<input type="text" name="product_category" class="form-control mb-2" value="<?= $row['product_category'] ?>" required>
<input type="file" name="product_image" class="form-control mb-2">

<img src="uploads/<?= $row['product_image'] ?>" width="80">
</div>
<div class="modal-footer">
<button type="submit" name="update_product" class="btn btn-success w-100">Save Changes</button>
</div>
</form>
</div>
</div>
</div>

<?php } ?>

</tbody>
</table>
</div>
</div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
