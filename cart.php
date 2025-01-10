<?php
include 'include/connect.php';
session_start();

if (isset($_SESSION['user_id'])) {
  $user_id = $_SESSION['user_id'];
} else {
  $user_id = '';
}

// Handle cart deletion
if (isset($_POST['delete'])) {
  $cart_id = intval($_POST['cart_id']);
  $query = "DELETE FROM `cart` WHERE id='$cart_id'";
  mysqli_query($conn, $query);
}

// Handle quantity update
if (isset($_POST['update_qty'])) {
  $cart_id = intval($_POST['cart_id']);
  $quantity = intval($_POST['quantity']);
  $query = "UPDATE `cart` SET quantity = '$quantity' WHERE id = '$cart_id'";
  mysqli_query($conn, $query);
}

// Handle product addition
if (isset($_POST['add_product'])) {
  $name = htmlspecialchars(trim($_POST['name']));
  $price = floatval($_POST['price']);
  $quantity = intval($_POST['quantity']);
  $description = htmlspecialchars(trim($_POST['description']));

  if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
    $image = $_FILES['image']['name'];
    $image_tmp_name = $_FILES['image']['tmp_name'];
    $image_size = $_FILES['image']['size'];
    $image_folder = 'image/product/' . basename($image);

    $allowed_extensions = ['jpg', 'jpeg', 'png', 'webp', 'gif'];
    $file_extension = strtolower(pathinfo($image, PATHINFO_EXTENSION));
    if (!in_array($file_extension, $allowed_extensions)) {
      echo '<h4 class="headings">Invalid file format. Allowed formats: png, jpg, jpeg, gif, and webp.</h4>';
      exit;
    }
    if ($image_size > 2 * 1024 * 1024) {
      echo '<h4 class="headings">File too large to upload (max 2MB).</h4>';
      exit;
    }

    if (move_uploaded_file($image_tmp_name, $image_folder)) {
      $query = "INSERT INTO cart (name, price, quantity, description, image) VALUES ('$name', '$price', '$quantity', '$description', '$image')";
      if (mysqli_query($conn, $query)) {
        echo "<script>alert('Product added successfully.');</script>";
      } else {
        echo "Error: " . mysqli_error($conn);
      }
    } else {
      echo "<script>alert('Failed to move the uploaded file.');</script>";
    }
  } else {
    echo "<script>alert('Please upload an image.');</script>";
  }
}

// Handle adding product to cart
if (isset($_POST['add_to_cart'])) {
  $id = intval($_POST['id']);
  $name = htmlspecialchars($_POST['name']);
  $price = floatval($_POST['price']);
  $quantity = intval($_POST['quantity']);
  $image = htmlspecialchars($_POST['image']);

  $query = "SELECT * FROM `cart` WHERE user_id='$user_id' AND id='$id'";
  $result = mysqli_query($conn, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $query = "UPDATE `cart` SET quantity = quantity + $quantity WHERE user_id = '$user_id' AND id = '$id'";
  } else {
    $query = "INSERT INTO `cart` (user_id, id, name, price, quantity, image) VALUES ('$user_id', '$id', '$name', '$price', '$quantity', '$image')";
  }
  mysqli_query($conn, $query);
  header('location: cart.php');
  exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cart</title>
  <link rel="shortcut icon" href="image/icons/cart.png" type="image/x-icon">
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

  <!--Bootstrap Link-->
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap JS and Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

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

    .shopping-cart {
      max-width: 1200px;
      margin: 20px auto;
      padding: 20px;
      background: #fff;
      border-radius: 10px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .shopping-cart .heading {
      font-size: 24px;
      font-weight: bold;
      color: #333;
      margin-bottom: 20px;
      text-align: center;
    }

    .side-container {
      display: flex;
      flex-direction: column;
      gap: 20px;
    }

    .cart-item {
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 20px;
      border: 1px solid #ddd;
      padding: 15px;
      border-radius: 10px;
      background: #f9f9f9;
    }

    .left-content {
      display: flex;
      align-items: center;
      gap: 15px;
      flex: 1;
    }

    .left-content .image img {
      width: 120px;
      height: auto;
      border-radius: 10px;
      object-fit: cover;
    }

    .left-content .details {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    .left-content .details p:first-child {
      font-weight: bold;
      font-size: 18px;
      margin: 0;
      color: #333;
    }

    .left-content .details p {
      font-size: 14px;
      color: #666;
      margin: 0px;
      text-align: left;
    }

    .left-content .details input[type="number"] {
      width: 60px;
      padding: 5px;
      border: 1px solid #ccc;
      border-radius: 5px;
    }

    .left-content .details button {
      padding: 5px 10px;
      background-color: #007bff;
      color: white;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      font-size: 14px;
    }

    .left-content .details button:hover {
      background-color: #0056b3;
    }

    .side-container p {
      font-size: 16px;
      color: #555;
      text-align: center;
    }

    .checkout {
      margin-top: 20px;
      padding: 20px;
      background-color: #f5f5f5;
      border-radius: 10px;
      border: 1px solid #ddd;
      text-align: center;
    }

    .checkout h2 {
      font-size: 22px;
      font-weight: bold;
      margin-bottom: 15px;
      color: #333;
    }

    .checkout p {
      font-size: 18px;
      color: rgb(31, 93, 71);
      font-weight: bold;
      margin: 0;
    }

    .update {
      margin: 0;
    }

    .update {
      width: 200px;
      border-radius: 30px;
      color: white;
      font-size: 16px;
      font-weight: 600;
      margin-top: 1rem;
    }

    #navbar {
      margin-top: 1rem;
    }

    a {
      width: 200px;
      border-radius: 30px;
      color: white;
      font-size: 16px;
      font-weight: 600;
      margin-top: 1rem;
    }

    .search {
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

  <section class="shopping-cart">
    <h4 class="heading">Your Cart</h4>

    <div class="side-container">
      <?php
      $total = 0;
      if ($user_id) {
        $query = "SELECT * FROM `cart` WHERE user_id='$user_id'";
        $result = mysqli_query($conn, $query);
        if ($result && mysqli_num_rows($result) > 0) {
          while ($row = mysqli_fetch_assoc($result)) {
            $sub_total = $row['price'] * $row['quantity'];
            $total += $sub_total;
      ?>
            <form action="cart.php" method="post" class="cart-item">
              <input type="hidden" name="cart_id" value="<?= $row['id']; ?>">
              <div class="left-content">
                <div class="image">
                  <img src="image/products/<?= htmlspecialchars($row['image']); ?>" alt="">
                </div>
                <div class="details">
                  <p><?= htmlspecialchars($row['name']); ?></p>
                  <p>Price: Rs.<?= number_format($row['price'], 2); ?></p>
                  <p>Subtotal: Rs.<?= number_format($sub_total, 2); ?></p> <!--$sub_total=Rs.100 and 2 means after decimal like 100.00-->
                  <input type="number" name="quantity" min="1" max="99" value="<?= $row['quantity']; ?>">
                  <button class="update" type="submit" name="update_qty">Update</button>
                  <button class="update" type="submit" name="delete">Delete</button>
                </div>
              </div>
            </form>
      <?php
          }
        } else {
          echo "<p>Your cart is empty!</p>";
        }
      } else {
        echo "<p>Please log in to view your cart.</p>";
      }
      ?>
    </div>

    <div class="checkout">
      <h2>Order Summary</h2>
      <p>Total: Rs.<?= number_format($total, 2); ?></p>

      <?php
      if (isset($_SESSION['user_id'])) {
        echo '<a href="checkout.php" class="btn btn-danger">
            <i class="fa-solid fa-bag-shopping"></i> Checkout
          </a>';
      } else {
      ?>

        <button type="button" name="submit" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
          <i class="fa-solid fa-bag-shopping"></i> Checkout
        </button>

        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Please Login First</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <a href="user_login.php" class="btn btn-primary">Log In</a>
              </div>
            </div>
          </div>
        </div>
      <?php
      }
      ?>
    </div>
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