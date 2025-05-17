<?php
session_start();
require_once('./Connection.php');

$search = isset($_GET['search']) ? mysqli_real_escape_string($conn, $_GET['search']) : '';

$sql = "SELECT * FROM produit WHERE Designation LIKE '%$search%' OR Description LIKE '%$search%'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KolXi</title>
    <!-- normalized all element  -->
    <link rel="stylesheet" href="css/normalized.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/kolchi.css">
    <link rel="stylesheet" href="css/product.css">
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
                <form action="./Search.php" method="post" class="search">
                    <input type="text" placeholder="Search...">
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
                            $rq="SELECT COUNT(*) as num FROM commande WHERE IDClient={$_SESSION['user_id']}";
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

                </div><button type="submit" class="No_account_Now"><i class="fa-solid fa-user"></i></button><a href="#" class="No_account_Now"><i class="fa-solid fa-user"></i></a>
            </div>
            <div class="nav_l">
                <i class="fa-solid fa-bars"></i>
            </div>
        </div>
        <div class="navList">
            <ul class="list">
                <li><a href="#">Categorie</a></li>
                <li><a href="#">Products</a></li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="./MaD/SingUP_IN.php">Admin</a></li>
            </ul>
        </div>
    </header>
    <!-- end header  -->


    <div class="Sproducts">
        <h2>Search Results for "<?php echo htmlspecialchars($search); ?>"</h2>
        <?php if (mysqli_num_rows($result) > 0): ?>
            <?php
             while ($row = mysqli_fetch_assoc($result)) {
                // Display each product as a list item
                echo "<div class='product-item'>";
                echo "<img src='" . $row['ImageURL'] . "' alt='" . $row['Reference'] . "' class='product-img'>";
                echo "<p class='title'>".$row['Designation']."</p>";
                echo "<p class='price'>".$row['prix']." DH"."</p>";
                echo "<div class='btns'>";
                 if (!isset($_SESSION['user_id'])){
                    echo "<form action='./verifieSign.php'>";
                    echo "<button type='submit' class='Buy_Now'>Buy Now</button>";
                    echo "<button type='submit' class='Add'>Add</button>";
                    echo "</form>";
                    echo "</div>";
                 }else{
                    echo "<form action='addToCart2.php' method='post'>";
                    echo "<input type='hidden' name='product_id' value='{$row['Reference']}'>";
                    echo "<button type='submit' name='Buy_Now' value='Buy_Now' class='Buy_Now'>Buy Now</button>";
                    echo " <button type='submit'  name='Add' value='Add' class='Add'>Add</button>";
                    echo "</form>";
                    echo "</div>";
                 }
                echo "</div >";
            }
            ?>
        <?php else: ?>
            <p>No results found.</p>
        <?php endif; ?>
    </div>

    <!-- footer  -->
    <footer class="footer">
        <div class="container">
            <div class="footer-content">
                <div class="footer-logo">
                    <img src="imgs/logo.svg" alt="logo" class="logo-img">
                </div>
                <div class="footer-links">
                    <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">About</a></li>
                        <li><a href="#">Services</a></li>
                        <li><a href="#">Contact</a></li>
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
</body>
</html>
