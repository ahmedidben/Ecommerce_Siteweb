<?php
session_start();
if (isset($_POST['accept_cookies'])) {
    setcookie('accepted_cookies', 'yes', time() + (365 * 24 * 60 * 60)); // 1 year
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KolXi</title>
    <!-- normalized all element  -->
    <link rel="stylesheet" href="css/normalized.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/kolchi.css">
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link rel="shortcut icon" href="imgs/logo.svg" type="image/x-icon">
</head>

<body>
    <!-- header  -->
    <header class="header">
        <div class="container">
            <div class="logo">
                <a href="index.php"> <img src="imgs/KOlش.svg" alt="logo" class="logo-img"></a>
            </div>
            <div class="search">
                <form action="./Search.php" method="get" class="search">
                    <input type="text" name="search" placeholder="Search...">
                    <button type="submit" class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
                
            </div>
            <div class="nav">
                <!-- <ul class="nav-list">
                    <li><a href="#home">Home</a></li>
                    <li><a href="#about">About</a></li>
                    <li><a href="#services">Services</a></li>
                    <li><a href="#contact">Contact</a></li>
                </ul> -->

                <div class="signIn signUp">
                    <?php if (!isset($_SESSION['user_id'])): ?>
                        <button onclick="window.location.href='./MainSign/SingUP_IN.php'" class="signIn-btn">Sign In</button>
                        <button onclick="window.location.href='./MainSign/SingUP_IN.php'" class="signUp-btn">Sign Up</button>
                    <?php else: ?>
                        <span class="welcome-user">Welcome, <?php echo $_SESSION['username']; ?></span>
                        <button onclick="window.location.href='logout.php'" class="logout-btn">Logout</button>
                    <?php endif; ?>
                </div>

            </div>
            <div class="basket">
                <div class="basket_IN">
                <?php if (!isset($_SESSION['user_id'])): ?>
                    <form action="./MainSign/SingUP_IN.php">
                        <button  type="submit" ><i class="fa-solid fa-cart-shopping"></i> <span>shopping-basket</span> </button>
                        <p id="orders">0</p>
                    </form>
                    <?php else: ?>
                        <button onclick="window.location.href='Buy.php'" ><i class="fa-solid fa-cart-shopping"></i> <span>shopping-basket</span> </button>
                        <p id="orders">
                            <?php 
                            require_once("./Connection.php");
                            $rq="SELECT COUNT(*) as num FROM commande WHERE IDClient={$_SESSION['user_id']} and Statut='EN COURE'";
                            $rp=mysqli_query($conn,$rq);
                            if($rp){
                                $row = mysqli_fetch_assoc($rp);
                                echo "{$row['num']}";
                            }else{
                                echo "*";
                            }
                            
                            ?>
                        </p>
                    <?php endif; ?>

                </div>
                <?php if(isset($_SESSION['user_id'])) : ?>
                    <button onclick="window.location.href='./profile.php'" type="submit" class="No_account_Now"><i class="fa-solid fa-user"></i></button>
                <?php else : ?>
                    <button onclick="window.location.href='./MainSign/SingUP_IN.php'" type="submit" class="No_account_Now"><i class="fa-solid fa-user"></i></button>
                <?php endif; ?>
                </div>
            <div class="nav_l">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>
        <div class="navList">
            <ul class="list">
                <li><a href="./categories.php">Categorie</a></li>
                <li><a href="./Product.php">Products</a></li>
                <li><a href="./about.php">About</a></li>
                <li><a href="./contact.php">Contact</a></li>
                <li><a href="./MaD/Sign/SingUP_IN.php">Admin</a></li>
            </ul>
        </div>
    </header>
    <!-- end header  -->
    <!-- main  -->
    <div class="main">
        <div class="imgs">
            <img src="imgs/shift_imgs/switch1.jpg" alt="kolchi" class="kolchi-img">
        </div>
        <button class="left"><i class="fa-solid fa-less-than"></i></button>
        <button class="right"><i class="fa-solid fa-greater-than"></i></button>

        <div class="BestSales">
            <div class="container">
                <div class="title">
                    <h2>Best Selling</h2>
                </div>
                <div class="bestSales-list">
                    <a href="">
                        <div class="bestSales-item">
                            <div class="img">
                                <img src="imgs/bestSales/camera.jpg" alt="kolchi" class="kolchi-img">
                            </div>

                            <h3>INSTAX Mini 12 Instant Camera Mint Green</h3>
                            <div class="stars">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star-half-stroke"></i>
                            </div>
                            <p>$14.99</p>
                            <div class="btns">
                            <?php if (!isset($_SESSION['user_id'])): ?>
                                <form action="./verifieSign.php">
                                <button type="submit" class="Buy_Now">Buy Now</button>
                                <button type="submit" class="Add">Add</button>
                                </form>
                            <?php else: ?>
                                <form action="addToCart.php" method="post">
                                    <input type="hidden" name="product_id" value="1"> <!-- Replace with real product ID -->
                                    <button type="submit" name="Buy_Now" value="Buy_Now" class="Buy_Now">Buy Now</button>
                                    <button type="submit"  name="Add" value="Add" class="Add">Add</button>
                                </form>
                            <?php endif; ?>
                            
                             </div>
                        </div>
                    </a>
                    <a href="">
                        <div class="bestSales-item">
                            <div class="img">
                                <img src="imgs/bestSales/controle.jpg" alt="kolchi" class="kolchi-img">
                            </div>

                            <h3>BE</h3>
                            <div class="stars">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>

                            </div>
                            <p>$19.99</p>
                            
                            <div class="btns">
                            <?php if (!isset($_SESSION['user_id'])): ?>
                                <form action="./verifieSign.php">
                                <button type="submit" class="Buy_Now">Buy Now</button>
                                <button type="submit" class="Add">Add</button>
                                </form>
                            <?php else: ?>
                                <form action="addToCart.php" method="post">
                                <input type="hidden" name="product_id" value="2"> <!-- Replace with real product ID -->
                                    <button type="submit" name="Buy_Now" value="Buy_Now" class="Buy_Now">Buy Now</button>
                                    <button type="submit"  name="Add" value="Add" class="Add">Add</button>
                                </form>
                            <?php endif; ?>
                            
                             </div>
                        </div>
                    </a>
                    <a href="">
                        <div class="bestSales-item">
                            <div class="img">
                                <img src="imgs/bestSales/Drink.jpg" alt="kolchi" class="kolchi-img">
                            </div>

                            <h3>Best Body Nutrition Vital Drink ZEROP® – Cherry Syrup Sugar-Free – 1 L – 1:80 Makes 80
                                Litres of Ready Drink</h3>
                            <div class="stars">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-regular fa-star"></i>
                            </div>
                            <p>$29.99</p>
                            
                            <div class="btns">
                            <?php if (!isset($_SESSION['user_id'])): ?>
                                <form action="./verifieSign.php">
                                <button type="submit" class="Buy_Now">Buy Now</button>
                                <button type="submit" class="Add">Add</button>
                                </form>
                            <?php else: ?>
                                <form action="addToCart.php" method="post">
                                <input type="hidden" name="product_id" value="3"> <!-- Replace with real product ID -->
                                    <button type="submit" name="Buy_Now" value="Buy_Now" class="Buy_Now">Buy Now</button>
                                    <button type="submit"  name="Add" value="Add" class="Add">Add</button>
                                </form>
                            <?php endif; ?>
                            
                             </div>
                        </div>
                    </a>
                    <a href="">
                        <div class="bestSales-item">
                            <div class="img">
                                <img src="imgs/bestSales/scale.jpg" alt="kolchi" class="kolchi-img">
                            </div>

                            <h3>RENPHO Digital Bathroom Scale, Ultra Slim Body Scale with High-Precision Sensors, Smart
                                Scale with Step-On Technology, black</h3>

                            <div class="stars">
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star"></i>
                                <i class="fa-solid fa-star-half-stroke"></i>
                            </div>
                            <p>$39.99</p>
                            
                            <div class="btns">
                            <?php if (!isset($_SESSION['user_id'])): ?>
                                <form action="./verifieSign.php">
                                <button type="submit" class="Buy_Now">Buy Now</button>
                                <button type="submit" class="Add">Add</button>
                                </form>
                            <?php else: ?>
                                <form action="addToCart.php" method="post">
                                <input type="hidden" name="product_id" value="4"> <!-- Replace with real product ID -->
                                    <button type="submit" name="Buy_Now" value="Buy_Now" class="Buy_Now">Buy Now</button>
                                    <button type="submit"  name="Add" value="Add" class="Add">Add</button>
                                </form>
                            <?php endif; ?>
                            
                             </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
        <div class="Mo">
         <div class="More">
            <a href="./Product.php" id="More">More  Offers <i class="fa-solid fa-bolt"></i></a>
        </div> 
        </div>
    </div>
    <!-- end main  -->
    <!-- footer  -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <img src="imgs/logo.svg" alt="logo" class="logo-img">
                </div>
                <div class="footer-links">
                    <ul>
                        <li><a href="./index.php">Home</a></li>
                        <li><a href="./about.php">About</a></li>
                        <li><a href="./contact.php">Contact</a></li>
                    </ul>
                </div>
                <div class="footer-socials">
                    <a href="#"><i class="fa-brands fa-facebook"></i></a>
                    <a href="#"><i class="fa-brands fa-twitter"></i></a>
                    <a href="#"><i class="fa-brands fa-instagram"></i></a>
                </div>
            </div>
        </div>
        <div class="footer-bottom">
            <p>&copy; 2025 KolXi. All rights reserved.</p>
        </div>
    </footer>
    <!--  -->

    <?php if (!isset($_COOKIE['accepted_cookies'])): ?>
        <div class="cookie-overlay" id="cookieOverlay"></div>
        <div class="cookie-banner" id="cookieBanner">
            <form method="POST">
                <p>This website uses cookies to enhance your experience. 🍪</p>
                <button type="submit" name="accept_cookies">Accept</button>
            </form>
        </div>
<?php endif; ?>


    <script src="script.js"></script>
</body>

</html>

<?php
if (isset($_SESSION['id_commandes_Buy']) && isset($_SESSION['id_user_de_commande'])) {
    $cmds = $_SESSION['id_commandes_Buy'];
    $user_id = $_SESSION['id_user_de_commande'];

    foreach ($cmds as $cmd) {
        // Update status to EN livrison if not already
        $rqt = "UPDATE commande
                SET Statut='EN livrision'
                WHERE Num=$cmd AND IDClient=$user_id AND Statut='EN COURE'";
        $rp = mysqli_query($conn, $rqt);
        if (!$rp) {
            echo "Erreur lors de la mise à jour de la commande ($cmd) à EN livrision.";
        }

        // Check if 3 days passed
        $rqt1 = "SELECT DateCommande FROM commande WHERE Num=$cmd AND IDClient=$user_id";
        $rp1 = mysqli_query($conn, $rqt1);
        if ($rp1) {
            while ($row = mysqli_fetch_assoc($rp1)) {
                $date = new DateTime($row['DateCommande']);
                $date->modify('+3 days');
                $newDate = $date->format('Y-m-d');
                $currentDate = date("Y-m-d");

                if ($currentDate == $newDate) {
                    $rqt2 = "UPDATE commande
                             SET Statut='ARRIVÉE'
                             WHERE Num=$cmd AND IDClient=$user_id";
                    $rp2 = mysqli_query($conn, $rqt2);
                    if (!$rp2) {
                        echo "Erreur lors de la mise à jour de la commande ($cmd) à ARRIVÉE.";
                    }
                }
            }
        }
    }
}
?>
