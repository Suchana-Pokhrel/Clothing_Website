<?php
include 'include/connect.php';
session_start();

// Get user_id from session
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : '';

// Initialize total
$total = 0;

// Calculate total price from the cart
$query = "SELECT * FROM `cart` WHERE user_id='$user_id'";
$result = mysqli_query($conn, $query);

if ($result && mysqli_num_rows($result)) {
  while ($fetch_cart = mysqli_fetch_assoc($result)) {
    $sub_total = $fetch_cart['price'] * $fetch_cart['quantity'];
    $total += $sub_total;
  }
}

// Handle order submission
if (isset($_POST['order'])) {
  $email = htmlspecialchars(trim($_POST['email']));
  $phone = htmlspecialchars(trim($_POST['phone']));
  $name = htmlspecialchars(trim($_POST['name']));
  $address = htmlspecialchars(trim($_POST['address']));
  $city = htmlspecialchars(trim($_POST['city']));
  $total_price = htmlspecialchars(trim($_POST['total_price']));

  // Check if cart has items
  $check_cart_query = "SELECT * FROM `cart` WHERE user_id='$user_id'";
  $check_cart_result = mysqli_query($conn, $check_cart_query);

  if ($check_cart_result && mysqli_num_rows($check_cart_result) > 0) {
    // Insert order into database
    $insert_order_query = "INSERT INTO `orders` (user_id, email, phone, name, address, city, total_price) 
                               VALUES ('$user_id', '$email', '$phone', '$name', '$address', '$city', '$total_price')";
    $insert_order_result = mysqli_query($conn, $insert_order_query);

    // Clear user's cart after placing the order
    $delete_cart_query = "DELETE FROM `cart` WHERE user_id='$user_id'";
    mysqli_query($conn, $delete_cart_query);

    if ($insert_order_result) {
      echo "<script>alert('Order placed successfully.'); window.location.href='order.php';</script>";
    } else {
      echo "<script>alert('Failed to place the order.');</script>";
    }
  } else {
    echo "<script>alert('Your cart is empty.');</script>";
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Checkout</title>
  <link rel="shortcut icon" href="image/icons/checkout.png" type="image/x-icon">

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

    header {
      height: 5%;
      margin-bottom: 30px;
      margin-top: 2rem;
      margin-left: 4rem;

      >h3 {
        font-size: 25px;
        color: #4E5150;
        font-weight: 800;
      }
    }

    main {
      height: 85%;
      display: flex;
      column-gap: 100px;
      margin-left: 4rem;

      .checkout-form {
        width: 50%;
      }

      h6 {
        font-size: 1rem;
        font-weight: 700;
        margin-top: 1rem;
        margin-bottom: 1rem;
        text-align: start;
      }

      .form-control {
        margin: 10px 0px;
        position: relative;
      }

      label:not([for="checkout-checkbox"]) {
        display: block;
        font-size: 1rem;
        font-weight: 500;
        margin-bottom: .5rem;
      }

      input:not([type="checkbox"]) {
        width: 500px;
        padding: 10px 10px 10px 40px;
        border-radius: 10px;
        outline: none;
        border: .2px solid #4e515085;
        font-size: 12px;
        font-weight: 700;

        &::placeholder {
          font-size: 12px;
          font-weight: 500;
        }
      }

      label[for="checkout-checkbox"] {
        font-size: 15px;
        font-weight: 500;
        line-height: 10px;
      }

      >div {
        position: absolute;

        span.fa {
          position: relative;
          top: 50%;
          left: 0%;
          transform: translate(15px, -50%);
        }
      }
    }

    .checkbox-control {
      align-items: center;
      column-gap: 10px;
    }

    .form-control-btn {
      display: flex;
      align-items: center;

      input[type="submit"] {
        padding: 10px 25px;
        font-size: 15px;
        color: #fff;
        background: #f2994a;
        border: 0;
        border-radius: 7px;
        letter-spacing: .5px;
        font-weight: 200;
        cursor: pointer;
      }
    }

    .logo {
      height: 100px;
      width: 150px;
    }

    .box {
      display: flex;
      padding: 1rem;
      align-items: center;
      box-shadow: 1px 1px 2px rgba(1, 1, 1, 0.2);
    }

    img {
      width: 15%;
    }

    .sub-total {
      display: flex;
      padding: 1rem;
      font-weight: 700;
      font-size: 1.1rem;
    }

    .flex {
      padding: 2rem;
      display: flex;
      flex-direction: column;
      gap: 12px;
    }

    .name {
      font-size: 1.2rem;
    }

    .price {
      font-size: .8rem;
      color: rgb(160, 81, 12);
    }

    .quantity {
      border: 1px solid rgba(127, 132, 130, 0.6);
      width: 50px;
      text-align: center;
      border-radius: 20px;
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
        <li><a href="shop.php">Shop</a></li>
        <li><a href="order.php">Order</a></li>
        <li><a href="about.php">About</a></li>
        <li><a class="active" href="contact.php">Contact</a></li>
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

  <header>
    <h3>Checkout</h3>
  </header>

  <main>
    <section class="checkout-form">
      <form action="" method="POST">
        <h6>Contact Information</h6>

        <div class="form-control">
          <label for="checkout-email">E-Mail:</label>
          <input type="email" id="checkout-email" name="email" placeholder="Enter your email." required>
        </div>

        <div class="form-control">
          <label for="checkout-phone">Phone:</label>
          <input type="number" id="checkout-phone" name="phone" placeholder="Enter your phone." required>
        </div>

        <h6>Shipping Address</h6>

        <div class="form-control">
          <label for="checkout-name">Full Name</label>
          <input type="text" id="checkout-name" name="name" placeholder="Enter your Name" required>
        </div>

        <div class="form-control">
          <label for="checkout-address">Address</label>
          <input type="text" id="checkout-address" name="address" placeholder="Enter your Address" required>
        </div>

        <div class="form-control">
          <label for="checkout-city">City</label>
          <input type="text" id="checkout-city" name="city" placeholder="Enter your City" required>
        </div>

        <div class="form-control checkbox-control">
          <input type="checkbox" name="checkout-checkbox" id="checkout-checkbox">
          <label for="checkout-checkbox">Save this information for next time</label>
        </div>

        <div class="form-control-btn">
          <!-- Pass total price to the order form -->
          <input type="hidden" name="total_price" value="<?= $total; ?>">
          <input type="submit" name="order" value="Continue">
        </div>
      </form>
    </section>

    <section class="checkout-details">
      <?php
      $query = "SELECT * FROM `cart` WHERE user_id='$user_id'";
      $result = mysqli_query($conn, $query);

      if ($result && mysqli_num_rows($result)) {
        while ($fetch_cart = mysqli_fetch_assoc($result)) {
      ?>
          <form class="box">
            <img src="image/products/<?= htmlspecialchars($fetch_cart['image']); ?>" alt="">
            <div class="flex">
              <div class="name"><?= htmlspecialchars($fetch_cart['name']); ?></div>
              <div class="price">Rs.<?= htmlspecialchars($fetch_cart['price']); ?></div>
              <div class="quantity"><?= htmlspecialchars($fetch_cart['quantity']); ?></div>
            </div>
          </form>
      <?php
        }
      } else {
        echo '<p>Your cart is empty.</p>';
      }
      ?>
      <div class="sub-total">Total Price: Rs.<?= $total; ?></div>
    </section>
  </main>
</body>

</html>