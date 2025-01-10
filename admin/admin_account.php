<?php

include '../include/connect.php';

session_start();

if (isset($_GET['delete'])) {
  $delete_id = intval($_GET['delete']);
  $query = "DELETE FROM admins WHERE id = '$delete_id'";
  $result = mysqli_query($conn, $query);

  if ($conn->query($query) === TRUE) {
    echo "<script type='text/javascript'>
    alert('Record Deleted Successfully.');
    window.location.href='admin_account.php';
    </script>";
  } else {
    echo "<script type='text/javascript'>
    alert('Error deleting record: $conn->error');
    window.location.href='admin_account.php';
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
  <title>Admin Account</title>
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

    .accounts {
      display: flex;
      flex-wrap: wrap;
      padding: 50px 20px;
      background-color: #f4f4f4;
      align-items: center;
      justify-content: center;
      gap: 20px;
    }

    .accounts .heading {
      text-align: center;
      font-size: 36px;
      font-weight: bold;
      margin-bottom: 20px;
    }

    .box {
      background-color: #fff;
      padding: 20px;
      width: 250px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      text-align: center;
      color: white;
    }

    .box h3 {
      font-size: 24px;
      margin-bottom: 30px;
      margin-top: 1rem;
    }

    .box p {
      font-size: 16px;
      color: #555;
    }

    .box .flex-btn {
      display: flex;
      justify-content: space-between;
      margin-top: 20px;
    }

    .box .flex-btn a {
      text-decoration: none;
      padding: 8px 15px;
      border-radius: 5px;
      font-size: 14px;
    }

    .option-btn {
      height: 20px;
      background-color: #4CAF50;
      color: #fff;
      text-decoration: none;
      border-radius: 20px;
    }

    .option-btn:hover {
      background-color: #45a049;
    }

    .delete-btn {
      background-color: #f44336;
      color: #fff;
    }

    .delete-btn:hover {
      background-color: #d32f2f;
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

  <h1 class="heading">Admin Account</h1>

  <section class="accounts">
    <div class="box">
      <h3>Admin Account</h3>
      <a href="admin_register.php" class="option-btn">Register Admin</a>
    </div>

    <?php

    $query = "SELECT * from `admins`";

    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
      while ($fetch_accounts = mysqli_fetch_assoc($result)) {
    ?>
        <div class="box">
          <p> Admin ID : <span><?= $fetch_accounts['id']; ?></span> </p>
          <p> Admin Name : <span><?= htmlspecialchars($fetch_accounts['name']); ?></span> </p>
          <p>Email: <span><?= htmlspecialchars($fetch_accounts['email']); ?></span></p>
          <div class="flex-btn">
            <a href="admin_account.php?delete=<?= $fetch_accounts['id']; ?>"
              onclick="return confirm('Are you sure you want to delete this user?');"
              class="delete-btn">Delete</a>
          </div>
        </div>
    <?php
      }
    } else {
      echo "<script type='text/javascript'>
  alert('No accounts found.');
  </script>";
    }
    ?>
    </div>
  </section>
</body>

</html>