<?php
include '../include/connect.php';
session_start();

if (isset($_GET['delete'])) {
  $delete_id = intval($_GET['delete']);

  $delete_user_query = "DELETE FROM `users` WHERE id='$delete_id'";
  if (mysqli_query($conn, $delete_user_query)) {
    mysqli_query($conn, "DELETE FROM `orders` WHERE user_id='$delete_id'");
    mysqli_query($conn, "DELETE FROM `messages` WHERE user_id='$delete_id'");
    mysqli_query($conn, "DELETE FROM `cart` WHERE user_id='$delete_id'");

    echo "<script>alert('User and related data deleted successfully.');</script>";
  } else {
    echo "<script>alert('Error deleting user: " . mysqli_error($conn) . "');</script>";
  }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Manage Users</title>
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

    .user-panel {
      text-align: center;
      padding: 20px;
    }

    .user-panel h1 {
      font-size: 2rem;
      color: #333;
      margin-bottom: 20px;
    }

    .user-container {
      display: flex;
      flex-wrap: wrap;
      justify-content: center;
      gap: 20px;
    }

    .user-box {
      background-color: #ffffff;
      border: 1px solid #ddd;
      border-radius: 5px;
      padding: 20px;
      width: 300px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      text-align: left;
    }

    .user-box p {
      margin: 10px 0;
      font-size: 1rem;
    }

    .user-box span {
      color: #007bff;
    }

    .delete-btn,
    .update-btn {
      display: inline-block;
      margin-top: 10px;
      padding: 10px 15px;
      text-decoration: none;
      border-radius: 5px;
      font-size: 1rem;
      color: #fff;
    }

    .delete-btn {
      background-color: #dc3545;
    }

    .delete-btn:hover {
      background-color: #c82333;
    }

    .update-btn {
      background-color: #007bff;
    }

    .update-btn:hover {
      background-color: #0056b3;
    }

    .empty {
      font-size: 1.2rem;
      color: #888;
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

  <section class="user-panel">
    <h1>Manage Users</h1>
    <div class="user-container">
      <?php
      // Fetch all users
      $select_accounts_query = "SELECT * FROM `users`";
      $select_accounts_result = mysqli_query($conn, $select_accounts_query);

      if ($select_accounts_result && mysqli_num_rows($select_accounts_result) > 0) {
        while ($fetch_accounts = mysqli_fetch_assoc($select_accounts_result)) {
      ?>
          <div class="user-box">
            <p>User ID: <span><?= $fetch_accounts['id']; ?></span></p>
            <p>Username: <span><?= htmlspecialchars($fetch_accounts['name']); ?></span></p>
            <p>Email: <span><?= htmlspecialchars($fetch_accounts['email']); ?></span></p>
            <a href="admin_user.php?delete=<?= $fetch_accounts['id']; ?>"
              onclick="return confirm('Are you sure you want to delete this user?');"
              class="delete-btn">Delete</a>
          </div>
      <?php
        }
      } else {
        echo '<p class="empty">No users found!</p>';
      }
      ?>
    </div>
  </section>
</body>

</html>