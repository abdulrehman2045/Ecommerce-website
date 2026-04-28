<?php
if(session_status() == PHP_SESSION_NONE){
    session_start();
}
$connection = mysqli_connect("localhost", "root", "", "php_forms");

if (!$connection) {
    die("Database connection failed");
}
//  insert data
if (isset($_POST['form'])) {

    $name       = $_POST['name'];
    $useremail  = $_POST['email'];
    $password   = $_POST['pass'];

    $query = "INSERT INTO students (Name, Email, Password)
              VALUES ('$name', '$useremail', '$password')";

    $match = mysqli_query($connection, $query);

    if ($match) {
        echo "
        <script>
            alert('Add Student Successfully');
            window.location.href = 'public.php?user';
        </script>
        ";
    } else {
        echo "
        <script>
            alert(' Failed Insert Data');
        </script>
        ";
    }
};
// LOGIN
if(isset($_POST['login'])){
    $email = mysqli_real_escape_string($connection,$_POST['email']);
    $password = $_POST['pass'];

    $query = mysqli_query($connection,"SELECT * FROM students WHERE Email='$email'");
    if(mysqli_num_rows($query) == 1){
        $user = mysqli_fetch_assoc($query);

        if($password == $user['Password']){ 
            // Role based session
            if($user['role'] == 'admin'){
                $_SESSION['admin_id'] = $user['id'];
                $_SESSION['admin_name'] = $user['Name'];
                $_SESSION['admin_role'] = 'admin';
                header("Location: public.php"); // admin panel
                exit;
            } else {
                $_SESSION['user_id'] = $user['id'];
                $_SESSION['user_name'] = $user['Name'];
                $_SESSION['user_role'] = 'user';
                header("Location: website/index.php"); 
                exit;
            }
        } else {
            echo "<script>alert('Incorrect password'); window.location='login.php';</script>";
        }
    } else {
        echo "<script>alert('Email not registered'); window.location='login.php';</script>";
    }
}
// update code modal

if(isset($_POST['update-btn'])){
    $update_id = $_POST['id'];
    $update_username = $_POST['Name'];
    $update_useremail = $_POST['Email'];
    $update_userpassword = $_POST['Password'];

    $update_query = mysqli_query($connection,"UPDATE students set Name = '$update_username', Email = '$update_useremail', Password = '$update_userpassword' where id = '$update_id'");

    if($update_query){
        echo "<script>
        alert('Your data updated successfully!')
        location.assign('public.php?user')
        </script>";
    }else {
        echo "
        <script>
            alert('Failed update Data');
        </script>
        ";
    }
};
// delete code modal

if(isset($_POST['delete-btn'])){
    
    $id = $_POST['id'];

    $delete_query=mysqli_query($connection,"DELETE FROM students where id = '$id' ");

    if($delete_query){
        echo "<script>
        alert('Your data deleted successfully!');
        location.assign('public.php?user');
        </script>";
    }else {
        echo "
        <script>
            alert('Failed delete Data');
        </script>
        ";
    }
};
// ADD PRODUCT
if(isset($_POST['add_product'])){

    $product_name = mysqli_real_escape_string($connection, $_POST['product_name']);
    $product_price = mysqli_real_escape_string($connection, $_POST['product_price']);
    $product_category = mysqli_real_escape_string($connection, $_POST['product_category']);

    // Image Upload
    if(isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0){

        $img_name = $_FILES['product_image']['name'];
        $img_tmp = $_FILES['product_image']['tmp_name'];
        $img_size = $_FILES['product_image']['size'];

        $img_ext = pathinfo($img_name, PATHINFO_EXTENSION);
        $allowed_ext = ['jpg','jpeg','png','webp'];

        if(in_array(strtolower($img_ext), $allowed_ext)){
            // Optional: check image size (max 2MB)
            if($img_size <= 2*1024*1024){
                $new_img_name = time() . "_" . rand(1000,9999) . "." . $img_ext;
                $upload_path = "uploads/" . $new_img_name;

                if(move_uploaded_file($img_tmp, $upload_path)){
                    // Insert into database
                    $insert = "INSERT INTO products (product_name, product_price, product_category, product_image)
                               VALUES ('$product_name', '$product_price', '$product_category', '$new_img_name')";
                    $query = mysqli_query($connection, $insert);

                    if($query){
                        echo "<script>alert('Product Added Successfully'); window.location.href='public.php?pro';</script>";
                    } else {
                        echo "<script>alert('Database Error');</script>";
                    }

                } else {
                    echo "<script>alert('Image Upload Failed');</script>";
                }

            } else {
                echo "<script>alert('Image size must be less than 2MB');</script>";
            }

        } else {
            echo "<script>alert('Invalid Image Type');</script>";
        }

    } else {
        echo "<script>alert('Please select an image');</script>";
    }
};
// UPDATE PRODUCT
if(isset($_POST['update_product'])){
  $id=$_POST['id'];
  $name=$_POST['product_name'];
  $price=$_POST['product_price'];
  $cat=$_POST['product_category'];
  $old=$_POST['old_image'];

  if($_FILES['product_image']['name']!=""){
    $img=time().'_'.$_FILES['product_image']['name'];
    move_uploaded_file($_FILES['product_image']['tmp_name'],"uploads/".$img);
  }else{
    $img=$old;
  }

  mysqli_query($connection,"UPDATE products SET
  product_name='$name',
  product_price='$price',
  product_category='$cat',
  product_image='$img'
  WHERE id='$id'");

  header("Location:public.php?pro");
}

// DELETE PRODUCT
if(isset($_GET['delete'])){
  $id=$_GET['delete'];
  $img=$_GET['img'];
  unlink("uploads/".$img);

  mysqli_query($connection,"DELETE FROM products WHERE id='$id'");
  header("Location:public.php?pro");
}
?>

