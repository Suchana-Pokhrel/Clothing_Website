<?php

include '../include/connect.php';

session_start();

$admin_id = isset($_SESSION['admin_id']);

if (isset($_POST['submit'])) {
  $email = isset($_POST['email']) ? mysqli_real_escape_string($conn, $_POST['email']) : '';
  $password = isset($_POST['password']) ? $_POST['password'] : '';

  $query = "SELECT * FROM `admins` WHERE email='$email' and password='$password'";
  $result = mysqli_query($conn, $query);

  if ($result) {
    echo "<script type='text/javascript'>
        alert('Login Successful.');
        window.location.href='admin_dashboard.php';
    </script>";
    exit;
  } else {
    echo "<script type='text/javascript'>
        alert('Login Failed');
        </script>";
  }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <link rel="shortcut icon" href="../image/icons/admin_login.webp" type="image/x-icon">
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

    .login {
      width: 400px;
      display: flex;
      flex-direction: column;
      gap: 15px;
      margin-top: 7rem;
      border: 1px solid #fff;
      box-shadow: 4px 7px 10px rgba(0, 0, 0, 0.3);
    }

    input[type="email"],
    input:not([type="email"]) {
      width: 290px;
      align-items: center;
      align-self: center;
      height: 50px;
      outline: none;
      border-top: none;
      border-left: none;
      border-right: none;
    }

    p a {
      text-decoration: none;
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

  <center>
    <form action="admin_login.php" method="post">
      <div class="login">
        <h1>Login</h1>
        <hr>

        <input type="email" name="email" placeholder="Username">

        <input type="password" name="password" placeholder="Password">

        <input type="submit" name="submit" value="Login">

        <p>Not a Member ? <a href="admin_register.php"><span>Sign Up</span></a></p>
      </div>
    </form>
  </center>
</body>

</html>