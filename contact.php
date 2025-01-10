<?php

include 'include/connect.php';

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];
} else {
    $user_id = '';
}

if (isset($_POST['submit'])) {
    $name = isset($_POST['name']) ? htmlspecialchars(trim($_POST['name'])) : ''; //? vanya if/else ho yedi true ho bhane ? yespaxi ko execute hunxa
    $email = isset($_POST['email']) ? htmlspecialchars(trim($_POST['email'])) : '';
    $number = isset($_POST['number']) ? htmlspecialchars($_POST['number']) : '';
    $messages = isset($_POST['messages']) ? htmlspecialchars($_POST['messages']) : ''; //messages jun hamle $ ma rakheko xau tyo vaneko hmro tala name ma jun declare garyou tyo ho.

    $query = "SELECT * FROM `messages` WHERE name='$name' and email='$email' and number='$number' and messages='$messages' ";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        echo "Message already sent";
    } else {
        $query = "INSERT INTO `messages` (user_id,name,email,number,messages) VALUES ('$user_id','$name','$email','$number','$messages')";

        if (mysqli_query($conn, $query)) {
            echo "<script>
            alert('Message Successfully Sent');
            </script>";
        } else {
            echo "<script>
            alert('Message Not Sent');
            </script>";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact</title>
    <link rel="shortcut icon" href="image/icons/contact.png" type="image/x-icon">

    <link rel="stylesheet" href="css/style.css">
    <!--font awesome link-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=League+Spartan:wght@100..900&family=Open+Sans:ital,wght@0,300..800;1,300..800&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <!--Bootstrap Link-->
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>

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

    .address {
        display: flex;
        gap: 3px;
    }

    .phone {
        display: flex;
        gap: 10px;
    }

    .email {
        display: flex;
        gap: 10px;
    }

    .fa-location-dot {
        font-size: 25px;
        color: #ef437d;
    }

    .fa-phone {
        font-size: 25px;
        color: #ef437d;
    }

    .fa-envelope {
        font-size: 25px;
        color: #ef437d;
    }

    #navbar {
        margin-top: 1rem;
    }
</style>

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

    <form action="contact.php" method="POST">
        <div class="container">
            <button type="submit" class="btn btn-primary" style="margin: 12px;">Contact</button>

            <div class="row justify-content-evenly">
                <div class="col-4">
                    <div class="address">
                        <i class="fa-solid fa-location-dot"></i>
                        <h5>Address : </h5>
                        <p>123 Main St, Anytown, USA 12345</p>
                    </div>

                    <div class="phone">
                        <i class="fa-solid fa-phone"></i>
                        <h5>Phone : </h5>
                        <p>123-456-7890</p>
                    </div>

                    <div class="email">
                        <i class="fa-solid fa-envelope"></i>
                        <h5>Email : </h5>
                        <p>info@example.com</p>
                    </div>

                </div>
                <div class="col-4">
                    <div class="form-group">
                        <label for="name">Your Name</label>
                        <input type="text" name="name" class="form-control" id="name" placeholder="Enter your name" required>
                    </div>

                    <div class="form-group">
                        <label for="email">Your Email</label>
                        <input type="email" name="email" class="form-control" id="email" placeholder="Enter your email" required>
                    </div>

                    <div class="form-group">
                        <label for="subject">Number</label>
                        <input type="number" name="number" class="form-control" id="subject" placeholder="Enter Number" required>
                    </div>

                    <div class="form-group">
                        <label for="message">Message</label>
                        <textarea class="form-control" name="messages" id="message" rows="5" placeholder="Enter your message" required></textarea>
                    </div>

                    <button type="submit" name="submit" class="btn btn-primary" style="margin: 12px;">Submit</button>
                </div>
            </div>
        </div>
    </form>

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