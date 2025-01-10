<?php
session_start();
include 'include/connect.php';

if (isset($_POST['submits'])) {
  $name = htmlspecialchars(trim($_POST['name']));
  $email = htmlspecialchars(trim($_POST['email']));
  $password = htmlspecialchars(trim($_POST['password']));
  $cpassword = htmlspecialchars(trim($_POST['cpassword']));

  if ($password != $cpassword) {
    echo "Passwords do not match.";
  } else {
    $query = "SELECT * FROM `users` WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result)) {
      echo "<script>alert('Email already exists.');</script>";
    } else {
      $query = "INSERT INTO `users` (name, email, password) VALUES ('$name', '$email', '$password')";
      if (mysqli_query($conn, $query)) {
        echo "<script>alert('Registered successfully.');</script>";
        header('Location: user_login.php'); // Redirect to login page after registration
        exit;
      } else {
        echo "<script>alert('Error occurred while registering.');</script>";
      }
    }
  }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register Page</title>
  <link rel="shortcut icon" href="image/icons/register.webp" type="image/x-icon">

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
  <!--Bootstrap Link-->
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">

  <!-- Bootstrap JS and Popper.js -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

  <style>
    #navbar {
      margin-top: 1rem;
    }

    #register-head {
      width: 600px;
      margin: 50px auto;
      padding: 20px;
      background-color: #f9f9f9;
      border: 1px solid #ddd;
      border-radius: 8px;
      box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    #register-head h3 {
      font-size: 1.5rem;
      font-weight: bold;
      text-align: center;
      margin-bottom: 20px;
    }

    #register-head label {
      font-size: 0.9rem;
      font-weight: bold;
      color: #333;
    }

    #register-head input[type="text"],
    #register-head input[type="email"],
    #register-head input[type="password"] {
      width: 100%;
      padding: 10px;
      font-size: 1rem;
      border: 1px solid #ccc;
      border-radius: 5px;
      box-sizing: border-box;
    }

    #register-head input:focus {
      outline: none;
      border-color: #007bff;
      box-shadow: 0 0 5px rgba(0, 123, 255, 0.5);
    }

    #register-head input::placeholder {
      color: #aaa;
      font-style: normal;
    }

    .btns {
      width: 100%;
      margin-top: 1rem;
      padding: 10px 25px;
      font-size: 15px;
      color: #fff;
      background: rgb(156, 81, 16);
      border: 0;
      border-radius: 7px;
      letter-spacing: .5px;
      font-weight: 200;
      cursor: pointer;
    }

    a {
      text-decoration: none;
    }

    .h-two {
      width: 100%;
      text-align: center;
      border-bottom: 1px solid gray;
      line-height: 0.1em;
    }

    p span {
      background: #fff;
      padding: 0 10px;
    }

    .box {
      border: 1px solid black;

      i {
        display: flex;
        margin-top: 1rem;
        margin-left: 3rem;
      }

      p {
        padding-left: 5px;
        font-weight: 700;
        color: black;
      }
    }

    .account {
      text-align: center;
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

    <div>
      <ul id="navbar">
        <li><a class="active" href="index.html">Home</a></li>
        <li><a href="shop.php">Shop</a></li>
        <li><a href="blog.php">Blog</a></li>
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

  <!--Register Page-->
  <section id="register-head">
    <h3>Sign Up</h3>
    <form action="" method="POST">
      <label for="name">Name</label>
      <input type="text" name="name" placeholder="Name" required>

      <label for="email">Email</label>
      <input type="email" name="email" placeholder="Email" required>

      <label for="password">Password</label>
      <input type="password" name="password" placeholder="Password" required>

      <label for="cpassword">Confirm Password</label>
      <input type="password" name="cpassword" placeholder="Confirm Password" required>

      <button class="btns" type="submit" name="submits">Sign Up</button>
    </form>

    <p class="account">Already have an account? <a href="user_login.php">Log In</a></p>

    <p class="h-two"><span>or</span></p>

    <div class="box">
      <i class="fa-brands fa-google">
        <a href="#">
          <p>Sign up with Google</p>
        </a>
      </i>
    </div>
  </section>
</body>

</html>