<?php

include '../include/connect.php';
session_start();

$admin_id = $_SESSION['admin_id'] ?? null;

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

    table {
      width: 100%;
      text-align: center;
      border-collapse: collapse;
    }

    th,
    td {
      border: 1px solid black;
      padding: 20px;
    }

    img {
      width: 100px;
      height: auto;
    }

    .edit,
    .delete {
      text-decoration: none;
      padding: 8px 15px;
      border-radius: 5px;
      color: white;
      font-size: 14px;
    }

    .edit {
      background-color: #007BFF;
    }

    .edit:hover {
      background-color: #0056b3;
    }

    .delete {
      background-color: #FF5733;
    }

    .delete:hover {
      background-color: #cc4626;
    }
  </style>

</head>

<body>

  <div class="container">
    <div class="top-header-navbar">
      <a href="admin_dashboard.php">Admin Dashboard</a>
      <div class="header">
        <i class="fa-solid fa-bell"></i>
        <a href="#">Settings</a>
        <a href="admin_logout.php">Logout</a>
      </div>
    </div>
  </div>

  <div class="show-products">
    <h1 class="heading">Added Products</h1>

    <?php

    $query = "SELECT * FROM products";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
    ?>
      <table>
        <thead>
          <tr>
            <th>Id</th>
            <th>Name</th>
            <th>Price</th>
            <th>Image</th>
            <th>Description</th>
            <th>Action</th>
          </tr>
        </thead>
        <tbody>
          <?php
          while ($product = mysqli_fetch_assoc($result)) {
          ?>
            <tr>
              <td><?= htmlspecialchars($product['id']); ?></td>
              <td><?= htmlspecialchars($product['name']); ?></td>
              <td>Rs. <?= htmlspecialchars($product['price']); ?></td>
              <td><img src="../image/products/<?= htmlspecialchars($product['image']); ?>" alt="Product Image"></td>
              <td><?= htmlspecialchars($product['description']); ?></td>
              <td>
                <a href="update_products.php?update=<?= $product['id']; ?>" class="edit">Edit</a>
                <a href="products.php?delete=<?= $product['id']; ?>" class="delete" onclick="return confirm('Are you sure?');">Delete</a>
              </td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
    <?php
    } else {
      echo "<h2>No Products Found.</h2>";
    }
    ?>
  </div>
</body>

</html>