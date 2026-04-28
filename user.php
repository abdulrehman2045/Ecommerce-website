<?php
include "code.php";
?>
<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Students Data</title>

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Google Fonts -->
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">

  <style>
    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
      min-height: 100vh;
      padding: 20px;
    }

    h1 {
      color: #fff;
      text-align: center;
      font-weight: 700;
      margin-top: 20px;
      text-shadow: 2px 2px 5px rgba(0,0,0,0.3);
    }

    .table-container {
      background: #fff;
      border-radius: 15px;
      padding: 30px;
      box-shadow: 0 15px 35px rgba(0,0,0,0.2);
      margin-top: 40px;
      overflow-x: auto;
    }

    table {
      border-radius: 10px;
      overflow: hidden;
    }

    thead th {
      background: linear-gradient(45deg, #6a11cb, #2575fc);
      color: #fff;
      text-align: center;
      font-weight: 600;
    }

    tbody td {
      text-align: center;
      vertical-align: middle;
    }

    tbody tr:hover {
      background: rgba(37,117,252,0.1);
      transition: all 0.3s ease;
    }

    .btn {
      border-radius: 50px;
      transition: all 0.3s ease;
    }

    .btn-warning {
      background: linear-gradient(45deg, #ffb347, #ffcc33);
      border: none;
      color: #fff;
    }

    .btn-warning:hover {
      transform: scale(1.05);
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }

    .btn-danger {
      background: linear-gradient(45deg, #ff416c, #ff4b2b);
      border: none;
      color: #fff;
    }

    .btn-danger:hover {
      transform: scale(1.05);
      box-shadow: 0 8px 20px rgba(0,0,0,0.2);
    }

    /* Modal Styling */
    .modal-content {
      border-radius: 15px;
      overflow: hidden;
    }

    .modal-header {
      background: linear-gradient(45deg, #6a11cb, #2575fc);
      color: #fff;
      font-weight: 600;
    }

    .modal-footer .btn {
      min-width: 100px;
    }

    @media (max-width: 576px) {
      .table-container {
        padding: 20px;
      }
    }
  </style>
</head>
<body>

  <h1>Students Data</h1>

  <div class="container table-container">
    <table class="table table-bordered table-striped">
      <thead>
        <tr>
          <th>ID</th>
          <th>NAME</th>
          <th>EMAIL</th>
          <th>PASSWORD</th>
          <th>ACTIONS</th>
        </tr>
      </thead>
      <tbody>
        <?php
          $result = mysqli_query($connection, "SELECT * FROM students");
          while($data = mysqli_fetch_assoc($result)) { ?>
          <tr>
            <td><?php echo $data['id']; ?></td>
            <td><?php echo $data['Name']; ?></td>
            <td><?php echo $data['Email']; ?></td>
            <td><?php echo $data['Password']; ?></td>
            <td class="d-flex justify-content-center">
              <!-- Update Button -->
              <button type="button" class="btn btn-warning btn-sm me-2" data-bs-toggle="modal" data-bs-target="#Update<?php echo $data['id']; ?>">Update</button>
              <!-- Delete Button -->
              <button type="button" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#Delete<?php echo $data['id']; ?>">Delete</button>
            </td>
          </tr>

          <!-- Update Modal -->
          <div class="modal fade" id="Update<?php echo $data['id']; ?>" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <form action="code.php" method="post">
                  <div class="modal-header">
                    <h5 class="modal-title" id="updateModalLabel">Update Data</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body">
                    <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                    <div class="mb-3">
                      <label class="form-label">Full Name</label>
                      <input type="text" name="Name" class="form-control" value="<?php echo $data['Name']; ?>" required>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Email Address</label>
                      <input type="email" name="Email" class="form-control" value="<?php echo $data['Email']; ?>" required>
                    </div>
                    <div class="mb-3">
                      <label class="form-label">Password</label>
                      <input type="password" name="Password" class="form-control" value="<?php echo $data['Password']; ?>" required>
                    </div>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="update-btn" class="btn btn-success">Save Changes</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

          <!-- Delete Modal -->
          <div class="modal fade" id="Delete<?php echo $data['id']; ?>" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <form action="code.php" method="post">
                  <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Delete Confirmation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body text-center">
                    <h5>Are you sure you want to delete this data?</h5>
                    <input type="hidden" name="id" value="<?php echo $data['id']; ?>">
                  </div>
                  <div class="modal-footer justify-content-center">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" name="delete-btn" class="btn btn-danger">Delete</button>
                  </div>
                </form>
              </div>
            </div>
          </div>

        <?php } ?>
      </tbody>
    </table>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
