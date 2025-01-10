<?php

include 'include/connect.php';

session_start();

if (!isset($_SESSION['user_id'])) {
  echo "<script>alert('You are not logged in.');
    window.location.href='user_login.php';</script>";
  exit;
}
$user_id = $_SESSION['user_id'];

$query = "SELECT * FROM `orders` WHERE user_id='$user_id'";
$result = mysqli_query($conn, $query);

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Order</title>
  <link rel="shortcut icon" href="image/icons/order.jpg" type="image/x-icon">

  <link rel="stylesheet" href="css/style.css">
  <!--font awesome link-->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
    integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />

  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
    rel="stylesheet">
  <style>
    input[type="search"] {
      width: 260px;
      height: 30px;
      border-top-left-radius: 5px;
      border-bottom-left-radius: 5px;
      border-top-right-radius: none;
      border-bottom-right-radius: none;
      outline: none;
      border: none;
      padding: 20px;
    }

    button[type="submit"] {
      width: 50px;
      border: none;
      color: whitesmoke;
      background-color: darkred;
      text-align: center;
      height: 40px;
      border-top-right-radius: 5px;
      border-bottom-right-radius: 5px;
      cursor: pointer;
      margin-left: -1rem;
    }

    #order {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-around;
    }

    .flex {
      width: 400px;
      max-width: 1200px;
      border: 1px solid #fff;
      margin: 4rem;
      box-shadow: 0px 3px 8px rgba(0, 0, 0, 0.3);
      text-align: center;
    }

    p {
      font-weight: 700;
      color: black;
    }

    span{
      font-weight: 300;
    }
  </style>
</head>

<body>
  <!--header-->
  <section id="header">

    <!--Logo design-->
    <div class="logo">
      <img src="image/logo.png" alt="" height="100px" width="150px">
    </div>

    <form action="search_page.php" method="POST" class="searches">
      <input type="search" name="search" placeholder="Search Here">
      <button class="search" name="search_btn" type="submit"><i class="fa-solid fa-magnifying-glass"></i></button>
    </form>

    <div>
      <ul id="navbar">
        <li><a href="index.php">Home</a></li>
        <li><a href="shop.php">Shop</a></li>
        <li><a class="active" href="order.php">Order</a></li>
        <li><a href="about.php">About</a></li>
        <li><a href="contact.php">Contact</a></li>
        <li id="lg-bag"><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
        <a href="#" id="close"><i class="fa-solid fa-times"></i></a>
        <li id="lg-bag"><a href="user_login.php"><i class="fa-solid fa-user"></i></a></li>
      </ul>
    </div>
    <div class="mobile">
      <a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a>
      <i id="bar" class="fa-solid fa-bars"></i>
    </div>

  </section>

  <section id="order">
    <?php
    if ($result && mysqli_num_rows($result) > 0) {
      while ($row = mysqli_fetch_assoc($result)) {
    ?>

        <div class="flex">
          <p>Name: <span><?= htmlspecialchars($row['name']); ?></span></p>
          <p>E-Mail: <span><?= htmlspecialchars($row['email']); ?></span></p>
          <p>Phone Number: <span><?= htmlspecialchars($row['phone']); ?></span></p>
          <p>Address: <span><?= htmlspecialchars($row['address']); ?></span></p>
          <p>Total Price: <span><?= htmlspecialchars($row['total_price']); ?></span></p>
          <p>Payment Status: <span style="color: <?= $row['payment_status'] === 'pending' ? 'red' : 'green'; ?>;">
              <?= htmlspecialchars($row['payment_status']); ?></span></p>
        </div>
    <?php
      }
    } else {
      echo "<script type='text/javascript'>
                alert('No orders placed.');
                window.location.href='index.php';
                </script>";
    }

    ?>
  </section>

  <footer class="section-p1">
    <div class="col">
      <img src="image/logo.png" alt="" height="100px" width="100px">
      <h4>Contact</h4>
      <p><strong>Address: </strong>Kapan, Milanchowk, Kathmandu</p>
      <p><strong>Phone: </strong>01-5555555</p>
      <p><strong>Email: </strong>info@shop.com</p>

      <div class="follow">
        <h4>Follow Us</h4>
        <div class="icon">
          <a href="#"><i class="fa-brands fa-facebook-f"></i></a>
          <a href="#"><i class="fa-brands fa-instagram"></i></a>
          <a href="#"><i class="fa-brands fa-twitter"></i> </a>
          <a href="#"><i class="fa-brands fa-pinterest-p"></i></a>
        </div>
      </div>
      <div class="copyright">
        <p>&copy; 2023. Tech2 etc - HTML Ecommerce Template. All Rights Reserved.</p>
      </div>
    </div>

    <div class="col">
      <h4>About</h4>
      <a href="#">About Us</a>
      <a href="#">Delivery Information</a>
      <a href="#">Privacy Policy</a>
      <a href="#">Terms & Conditions</a>
      <a href="#">Contact Us</a>
    </div>

    <div class="col">
      <h4>My Account</h4>
      <a href="#">Sign In</a>
      <a href="#">View Cart</a>
      <a href="#">My Wishlist</a>
      <a href="#">Track My Order</a>
      <a href="#">Help</a>
    </div>
  </footer>
</body>

</html>