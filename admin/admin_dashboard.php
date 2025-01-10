<?php

include '../include/connect.php';

session_start();

$admin_id = isset($_SESSION['admin_id']);

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Dashboard</title>

  <link rel="shortcut icon" href="../image//icons/dashboard.webp" type="image/x-icon">

  <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />

  <link rel="stylesheet" href="../css/admin_part.css">

  <!-- font awesome cdn link  -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

  <script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

  <!--Bootstrap Link-->
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap JS and Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    html,
    body {
      margin: 0;
      padding: 0;
      width: 100%;
    }

    .container {
      max-width: 100%;
      background-color: rgb(43, 41, 41);
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }
  </style>
</head>

<body>
  <!--Navbar Header-->

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

  <!--Dashboard Cards-->


  <h3 style="color:aliceblue;">Admin Dashboard</h3>
  <div class="heading">
    <div class="heading">
      <div class="card">
        <div class="card-details">
          <div class="panel-icon">👤</div>
          <p class="text-title"> User Panel</p>
        </div>
        <button class="card-button"><a href="admin_user.php">More info</a> <i class="fa-solid fa-arrow-right"></i></button>
      </div>
    </div>

    <div class="heading">
      <div class="card">
        <div class="card-details">
          <div class="panel-icon">📦</div>
          <p class="text-title">Order Panel</p>
        </div>
        <button class="card-button"><a href="order_panel.php">More info</a> <i class="fa-solid fa-arrow-right"></i></button>
      </div>
    </div>

    <div class="heading">
      <div class="card">
        <div class="card-details">
          <div class="panel-icon">🛒</div>
          <p class="text-title">Add Products</p>
        </div>
        <button class="card-button"><a href="products.php">More info</a> <i class="fa-solid fa-arrow-right"></i></button>
      </div>
    </div>

    <div class="heading">
      <div class="card">
        <div class="card-details">
          <div class="panel-icon">🛠️</div>
          <p class="text-title">Admin Panel</p>

        </div>
        <button class="card-button"><a href="admin_account.php">More info</a> <i class="fa-solid fa-arrow-right"></i></button>
      </div>
    </div>
  </div>


</body>

</html>