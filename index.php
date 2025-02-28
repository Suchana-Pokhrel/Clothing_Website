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
    <title>Home</title>
    <link rel="shortcut icon" href="image/icons/home.png" type="image/x-icon">

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
                <li><a class="active" href="index.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
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

    <!--hero section-->
    <section id="hero">
        <h4>Trade-in-offer</h4>
        <h2>Super value deals</h2>
        <h1>On all products</h1>
        <p>Save more with coupons & up to 70% off! </p>
        <a href="shop.php"><button class="btns">Shop Now</button></a>
    </section>

    <!--Features Section-->
    <section id="feature" class="section-p1">
        <div class="fe-box">
            <img src="image/features/fe-1.png" alt="">
            <h4>Free Shipping</h4>
        </div>

        <div class="fe-box">
            <img src="image/features/fe-2.png" alt="">
            <h4>Online Order</h4>
        </div>

        <div class="fe-box">
            <img src="image/features/fe-3.png" alt="">
            <h4>Save Money</h4>
        </div>

        <div class="fe-box">
            <img src="image/features/fe-4.png" alt="">
            <h4>Happy Sell</h4>
        </div>
    </section>

    <!---Category Featured Products-->
    <section id="product1" class="section-p1">
        <h2>Featured Products</h2>
        <p>Summer Collection New Modern Design</p>
        <div class="pro-container">

            <!--Mens tshirt and shirt-->
            <div class="pro">
                <a href="category.php?name=T-shirt" class="slide">
                    <img src="image/category/cat-1..png" alt="">
                    <div class="des">
                        <span>adidas</span>
                        <h3>Men's T-Shirt</h3>
                        <div class="star">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <h4>$20</h4>
                    </div>
                    <a href="#"><i class="fa-solid fa-cart-shopping cart"></i></a>
                </a>
            </div>

            <div class="pro">
                <a href="category.php?name=shirt" class="slide">
                    <img src="image/category/cat-2.png" alt="">
                    <div class="des">
                        <span>adidas</span>
                        <h3>Men's Shirt</h3>
                        <div class="star">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <h4>$20</h4>
                    </div>
                    <a href="#"><i class="fa-solid fa-cart-shopping cart"></i></a>
                </a>
            </div>

            <!--Womens clothes-->
            <div class="pro">
                <a href="category.php?name=dress" class="slide">
                    <img src="image/category/cat-6.png" alt="">
                    <div class="des">
                        <span>adidas</span>
                        <h3>Girls Dress</h3>
                        <div class="star">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <h4>$20</h4>
                    </div>
                    <a href="#"><i class="fa-solid fa-cart-shopping cart"></i></a>
                </a>
            </div>

            <div class="pro">
                <a href="category.php?name=womens" class="slide">
                    <img src="image/category/cat-8.png" alt="">
                    <div class="des">
                        <span>adidas</span>
                        <h3>Womens Dress</h3>
                        <div class="star">
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                            <i class="fa-solid fa-star"></i>
                        </div>
                        <h4>$20</h4>
                    </div>
                    <a href="#"><i class="fa-solid fa-cart-shopping cart"></i></a>
                </a>
            </div>

        </div>
    </section>

    <!---banner-->
    <section id="banner" class="section-m1">
        <h4>Repair Services</h4>
        <h2>Up to <span>70% Off</span> - All t-shirt & Accessoires</h2>
        <button class="btns">Explore More</button>
    </section>

    <!---New Arrivals-->
    <section id="product1" class="section-p1">
        <h2>New Arrivals</h2>
        <p>Summer Collection New Modern Design</p>
        <div class="pro-container">
            <?php
            $query = "SELECT * FROM products";
            $result = mysqli_query($conn, $query);
            if ($result && mysqli_num_rows($result)) {
                while ($row = mysqli_fetch_assoc($result)) {
            ?>
                    <div class="pro">
                        <form action="cart.php" method="POST">
                            <img src="image/products/<?= htmlspecialchars($row['image']); ?>" alt="">

                            <input type="hidden" name="id" value="<?= htmlspecialchars($row['id']); ?>">
                            <input type="hidden" name="name" value="<?= htmlspecialchars($row['name']); ?>">
                            <input type="hidden" name="price" value="<?= htmlspecialchars($row['price']); ?>">

                            <input type="hidden" name="description" value="<?= htmlspecialchars($row['description']); ?>">
                            <input type="hidden" name="image" value="<?= htmlspecialchars($row['image']); ?>">

                            <div class="name"><?= htmlspecialchars($row['name']); ?></div>

                            <div class="price">
                                <span>Rs.</span><?= htmlspecialchars($row['price']) ?><span>/-</span>
                            </div>
                            <div class="description"><?= htmlspecialchars($row['description']); ?></div>

                            <input type="submit" value="Add to Cart" class="btns" name="add_to_cart">

                        </form>
                    </div>
            <?php
                }
            } else {
                echo '<h4 class="headings">No Products Here</h4>';
            }

            ?>

        </div>
    </section>

    <!---banner-->
    <section id="sm-banner" class="section-p1">
        <div class="banner-box">
            <h4>Crazy Deals</h4>
            <h2>buy 1 get 1 free</h2>
            <span>The best classic dress is on sale at ours.</span>
            <button class="btns">Learn More</button>
        </div>

        <div class="banner-box banner-box2">
            <h4>Spring/Summer</h4>
            <h2>New Collection</h2>
            <span>The best classic dress is on sale at ours.</span>
            <button class="btns">Collection</button>
        </div>
    </section>

    <!---banner-->
    <section id="banner3" class="section-p1">
        <div class="banner-box">
            <h4>SEASONAL SALE</h4>
            <h3>Winter Collection -50% OFF</h3>
        </div>

        <div class="banner-box banner-box4">
            <h4>New Footwear Collection</h4>
            <h3>Spring/Summer 2022</h3>
        </div>

        <div class="banner-box banner-box5">
            <h4>T-Shirt</h4>
            <h3>New Trendy Prints</h3>
        </div>
    </section>

    <section id="newsletter">
        <div class="newstext">
            <h4>Sign Up For News Letter</h4>
            <p>Get E-mail updates about our latest shop and <span>special offers.</span></p>
        </div>

        <div class="form">
            <input type="text" placeholder="Your email address">
            <button>Subscribe</button>
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

    <script src="js/script.js"></script>
</body>

</html>