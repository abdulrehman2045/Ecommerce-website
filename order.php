<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

include("code.php");

/* DELETE ORDER */
if(isset($_GET['delete'])){
    $delete_id = $_GET['delete'];
    mysqli_query($connection,"DELETE FROM orders WHERE id='$delete_id'");
    header("Location: order.php");
    exit;
}

/* UPDATE STATUS */
if(isset($_POST['update_status'])){
    $order_id = $_POST['order_id'];
    $status = $_POST['status'];

    mysqli_query($connection,"UPDATE orders SET status='$status' WHERE id='$order_id'");
    header("Location: public.php?order");
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<title>Admin - Orders</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-5">

<h2 class="fw-bold mb-4">All Orders</h2>

<div class="card shadow">
<div class="card-body">

<div class="table-responsive">
<table class="table table-bordered table-hover align-middle">
<thead class="table-dark text-center">
<tr>
<th>ID</th>
<th>User</th>
<th>Contact</th>
<th>Address</th>
<th>Total</th>
<th>Status</th>
<th>Action</th>
</tr>
</thead>

<tbody>

<?php
$query = mysqli_query($connection,"SELECT * FROM orders ORDER BY id DESC");

if(mysqli_num_rows($query)>0){
while($row = mysqli_fetch_assoc($query)){
?>

<tr>
<td class="text-center"><?php echo $row['id']; ?></td>

<td>
<strong><?php echo $row['name']; ?></strong><br>
<small>User ID: <?php echo $row['user_id']; ?></small>
</td>

<td>
<?php echo $row['email']; ?><br>
<?php echo $row['phone']; ?>
</td>

<td><?php echo $row['address']; ?></td>

<td><strong>Rs. <?php echo $row['total_amount']; ?></strong></td>

<td class="text-center">
<form method="POST">
<input type="hidden" name="order_id" value="<?php echo $row['id']; ?>">

<select name="status" class="form-select form-select-sm"
        onchange="this.form.submit()">
<option <?php if($row['status']=="Pending") echo "selected"; ?>>Pending</option>
<option <?php if($row['status']=="Shipped") echo "selected"; ?>>Shipped</option>
<option <?php if($row['status']=="Delivered") echo "selected"; ?>>Delivered</option>
</select>

<input type="hidden" name="update_status">
</form>
</td>



<td class="text-center">
<a href="order.php?delete=<?php echo $row['id']; ?>"
   onclick="return confirm('Are you sure?')"
   class="btn btn-danger btn-sm">
   Delete
</a>
</td>

</tr>

<?php
}
}else{
echo "<tr><td colspan='8' class='text-center'>No Orders Found</td></tr>";
}
?>

</tbody>
</table>
</div>

</div>
</div>

</div>

</body>
</html>
