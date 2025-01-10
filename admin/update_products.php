<?php
include '../include/connect.php';

session_start();


if (isset($_POST['update'])) {
  $pid = $_POST['pid'];
  $name = htmlspecialchars(trim($_POST['name'] ?? ''));
  $price = htmlspecialchars(trim($_POST['price'] ?? ''));
  $description = htmlspecialchars(trim($_POST['description'] ?? ''));

  // Update product details
  $update_product = "UPDATE `products` SET name='$name', price='$price', description='$description' WHERE id='$pid'";
  mysqli_query($conn, $update_product);

  echo "<script>
  alert('Product Updated Successfully.');
  window.location.href='show_products.php';
  </script>";

  $old_image = $_POST['old_image'];
  $image = $_FILES['image']['name'];
  $image_size = $_FILES['image']['size'];
  $image_tmp_name = $_FILES['image']['tmp_name'];
  $image_folder = '../images/products/' . $image;

  if (!empty($image)) {
    if ($image_size > 2000000) {
      echo "<script>alert('Image size is too large.');</script>";
    } else {
      $update_image = "UPDATE `products` SET image='$image' WHERE id='$pid'";
      mysqli_query($conn, $update_image);
      move_uploaded_file($image_tmp_name, $image_folder);
      echo "<script>alert('Image is Updated.');</script>";
    }
  } else {

    $image = $old_image;
  }
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

  <h1 class="heading">Update Products</h1>

  <?php
  $update_id = $_GET['update'];
  $update_id = mysqli_real_escape_string($conn, $update_id);

  $query = "SELECT * FROM `products` WHERE id = '$update_id'";
  $result = mysqli_query($conn, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    while ($fetch_products = mysqli_fetch_assoc($result)) {
      $product_name = $fetch_products['name'];
      $product_price = $fetch_products['price'];
      $product_description = $fetch_products['description'];
      $product_image = $fetch_products['image'];
  ?>
      <section class="products">
        <form action="" method="POST" enctype="multipart/form-data" class="form">

          <input type="hidden" name="pid" value="<?php echo $update_id; ?>">
          <input type="hidden" name="old_image" value="<?php echo $product_image; ?>">

          <input type="hidden" name="id" value="<?php echo $update_id; ?>">
          <div class="inputbox">
            <span>Product Name</span>
            <input type="text" name="name" placeholder="Product Name" value="<?php echo $product_name; ?>" required>
          </div>

          <div class="inputbox">
            <span>Product Price</span>
            <input type="number" name="price" placeholder="Price" value="<?php echo $product_price; ?>" required>
          </div>

          <div class="inputbox">
            <span>Product Image</span>
            <input type="file" name="image" accept="image/*">
          </div>

          <div class="inputbox">
            <span>Product Description</span>
            <textarea name="description" placeholder="Product Description"><?php echo $product_description; ?></textarea>
          </div>

          <input type="hidden" name="old_image" value="<?php echo $product_image; ?>">
          <input type="submit" name="update" value="Update Product">
        </form>
      </section>

  <?php
    }
  } else {
    echo 'Product is missing.';
  }

  ?>

</body>

</html>