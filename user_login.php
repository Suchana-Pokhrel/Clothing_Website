<?php

session_start();

include 'include/connect.php';

if (isset($_POST['submit'])) {
  $email = htmlspecialchars(trim($_POST['email']));
  $password = htmlspecialchars(trim($_POST['password']));

  $query = "SELECT * FROM `users` WHERE email='$email' and password='$password'";
  $result = mysqli_query($conn, $query);

  if ($result && mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);
    $_SESSION['user_id'] = $row['id'];
    header('Location: index.php');
    exit;
  } else {
    echo "<script>alert('Invalid email or password.');</script>";
  }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <link rel="shortcut icon" href="image/icons/admin_login.webp" type="image/x-icon">

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
    #navbar {
      margin-top: 1rem;
    }

    #register-head {
      width: 300px;
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

    form {
      display: flex;
      flex-direction: column;
      gap: 10px;
    }

    #register-head h3 {
      font-size: 1.5rem;
      font-weight: bold;
      text-align: center;
      margin-bottom: 20px;
    }

    #register-head label {
      font-size: 1rem;
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

    input[type="submit"] {
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
        <li><a class="active" href="index.php">Home</a></li>
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
    <h3>Login</h3>
    <form action="" method="post">
      <label for="email">Email</label>
      <input type="email" name="email" placeholder="Email" required>

      <label for="password">Password</label>
      <input type="password" name="password" placeholder="Password" required>

      <input type="submit" name="submit" value="Login">

      <p class="account">Don't have an account? <a href="user_register.php">Register</a></p>
    </form>
  </section>
</body>

</html>