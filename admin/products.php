<?php

include '../include/connect.php';
session_start();

$admin_id = $_SESSION['admin_id'] ?? null;

if (isset($_POST['add_product'])) {
  $name = htmlspecialchars(trim($_POST['name'] ?? ''));
  $price = htmlspecialchars(trim($_POST['price'] ?? ''));
  $description = htmlspecialchars(trim($_POST['description'] ?? ''));

  if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $image = $_FILES['image']['name'];
    $image_size = $_FILES['image']['size'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_folder = '../image/products/' . basename($image);

    $allowed_extensions = ['jpg', 'jpeg', 'webp', 'png', 'gif'];
    $file_extension = strtolower(pathinfo($image, PATHINFO_EXTENSION));
    if (!in_array($file_extension, $allowed_extensions)) {
      echo "<script>alert('Invalid file format. Allowed formats: jpg, jpeg, png, gif');</script>";
      exit;
    }

    if ($image_size > 2 * 1024 * 1024) {
      echo "<script>alert('File size is too large. Maximum 2MB allowed.');</script>";
      exit;
    }

    if (move_uploaded_file($image_tmp_name, $image_folder)) {
      $stmt = $conn->prepare("INSERT INTO products (name, price, description, image) VALUES (?, ?, ?, ?)");
      $stmt->bind_param("sdss", $name, $price, $description, $image);

      if ($stmt->execute()) {
        echo "<script>
        alert('Product added successfully and saved in database.');
        window.location.href='show_products.php';
        </script>";
      } else {
        echo "Error: " . $stmt->error;
      }
    } else {
      echo "<script>alert('Failed to move the uploaded file.');</script>";
    }
  } else {
    echo "<script>alert('Please upload an image.');</script>";
  }
}

if (isset($_GET['delete'])) {
  $delete_id = $_GET['delete'];

  $query = "SELECT * FROM `products` WHERE id='$delete_id'";
  $result = mysqli_query($conn, $query);

  if ($row = mysqli_fetch_assoc($result)) {
    unlink('../image/products/' . $row['image']);
  }

  $query = "DELETE FROM `products` WHERE id='$delete_id'";
  if (mysqli_query($conn, $query)) {
    echo "<script>alert('Deleted Successfully from Database');</script>";
  } else {
    echo "<script>alert('Unsuccessful Deletion');</script>";
    exit;
  }

  $query = "DELETE FROM `cart` WHERE id='$delete_id'";
  $result = mysqli_query($conn, $query);

  header('Location: show_products.php');
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Show Products</title>

  <link rel="shortcut icon" href="../image/products/icon.png" type="image/x-icon">
  <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
  <link rel="stylesheet" href="../css/admin_part.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
  <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    html,
    body {
      margin: 0;
      padding: 0;
      width: 100%;
      overflow-x: hidden;
    }

    .container {
      max-width: 100%;
      background-color: rgb(43, 41, 41);
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
  </style>

</head>

<body>

  <div class="container">
    <div class="top-header-navbar">
      <a href="admin_dashboard.php">Admin Dashboard</a>
      <div class="header">
        <a href="#">Settings</a>
        <a href="admin_logout.php">Logout</a>
      </div>
    </div>
  </div>

  <h1 class="heading">Add Products</h1>

  <section class="products">
    <form action="" method="POST" enctype="multipart/form-data" class="form">

      <div class="inputbox">
        <span>Product Name</span>
        <input type="text" name="name" placeholder="Products Name" required>
      </div>

      <div class="inputbox">
        <span>Product Price</span>
        <input type="number" name="price" placeholder="Price" required>
      </div>

      <div class="inputbox">
        <span>Product Image</span>
        <input type="file" name="image" required>
      </div>

      <div class="inputbox">
        <span>Product Description</span>
        <textarea name="description" placeholder="Product Description"></textarea>
      </div>

      <input type="submit" name="add_product" value="Add Product">
    </form>
  </section>

</body>

</html>