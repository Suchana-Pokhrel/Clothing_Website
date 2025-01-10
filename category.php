<?php

include 'include/connect.php';

session_start();

if (isset($_POST['user_id'])) {
  $user_id = $_SESSION['user_id'];
} else {
  $user_id = '';
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Category</title>
  <link rel="shortcut icon" href="image/icons/category.png" type="image/x-icon">

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
    .name {
      font-size: 1.3rem;
      font-weight: 600;
      text-align: left;
      margin-bottom: 1rem;
    }

    .price {
      text-align: left;
      font-size: 0.9rem;
      color: darkred;
      margin-bottom: 1rem;
      font-weight: 560;
    }

    .description {
      text-align: left;
    }

    .btns {
      padding: 10px 20px;
      background-color: rgb(56, 100, 56);
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      width: 200px;
      margin-top: 0.7rem;
    }

    .btns:hover {
      background-color: rgb(21, 57, 21);
    }

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

    .container {
      display: flex;
      justify-content: space-evenly;
      flex-wrap: wrap;
    }

    .slides {
      width: 100%;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      padding: 20px;
      max-width: 250px;
      height: 25rem;
      background-color: #fff;
      border: 1px solid #ddd;
      box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
      margin: 1rem;
    }

    .slides img {
      width: 70%;
      object-fit: contain;
    }
  </style>
</head>

<body>

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
        <li><a class="active" href="shop.php">Shop</a></li>
        <li><a href="order.php">Order</a></li>
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

  <div class="container">
    <?php

    $category_name = isset($_GET['name']) ? mysqli_real_escape_string($conn, $_GET['name']) : '';

    if ($category_name) {
      $query = "SELECT * FROM `products` WHERE name LIKE '%{$category_name}%'";
      $result = mysqli_query($conn, $query);

      if ($result && mysqli_num_rows($result)) {
        while ($fetch_product = mysqli_fetch_assoc($result)) {
    ?>
          <form action="cart.php" method="post" class="slides">
            <input type="hidden" name="pid" value="<?= isset($fetch_product['pid']); ?>">

            <input type="hidden" name="name" value="<?= isset($fetch_product['name']); ?>"> <!--hidden kina bhne user le data haru lai manipulate garna nasakos. data store hunxa tara user lai visible nahos bhnera-->

            <input type="hidden" name="price" value="<?= isset($fetch_product['price']); ?>">

            <input type="hidden" name="image" value="<?= isset($fetch_product['image']); ?>">

            <img src="image/products/<?= htmlspecialchars($fetch_product['image']); ?>" alt="">

            <div class="name"><?= htmlspecialchars($fetch_product['name']); ?></div>
            <div class="price">Rs.<?= htmlspecialchars($fetch_product['price']); ?></div>
            <div class="description"><?= htmlspecialchars($fetch_product['description']); ?></div>
            <input type="submit" value="Add To Cart" class="btns" name="add_to_cart">
          </form>
    <?php
        }
      } else {
        echo "<p>No products found for the category: " . htmlspecialchars($category_name) . ".</p>";
      }
    } else {
      echo "<script type='text/javascript'>
      alert('0 results.')";
    }

    ?>
  </div>
</body>

</html>