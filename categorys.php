<?php
session_start();
$Catg = [];
require_once('./Connection.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>KolXi</title>
    <link rel="stylesheet" href="css/normalized.css">
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/kolchi.css">
    <link rel="stylesheet" href="css/product.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <link rel="shortcut icon" href="imgs/logo.svg" type="image/x-icon">
</head>
<body>

<header class="header">
    <div class="container">
        <div class="logo">
            <a href="index.php"><img src="imgs/KOlش.svg" alt="logo" class="logo-img"></a>
        </div>
        <div class="search">
            <form action="./Product.php" method="post" class="search">
                <input type="text" name="search" placeholder="Search...">
                <button type="submit" class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
            </form>
        </div>
        <div class="nav">
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
                        <button type="submit"><i class="fa-solid fa-cart-shopping"></i><span>shopping-basket</span></button>
                        <p id="orders">0</p>
                    </form>
                <?php else: ?>
                    <button onclick="window.location.href='Buy.php'"><i class="fa-solid fa-cart-shopping"></i><span>shopping-basket</span></button>
                    <p id="orders">
                        <?php
                        $rq = "SELECT COUNT(*) as num FROM commande WHERE IDClient = {$_SESSION['user_id']}";
                        $rp = mysqli_query($conn, $rq);
                        echo $rp ? mysqli_fetch_assoc($rp)['num'] : "*";
                        ?>
                    </p>
                <?php endif; ?>
            </div>
            <button type="submit" class="No_account_Now"><i class="fa-solid fa-user"></i></button>
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

<div class="main">
    <div class="side_category">
        <div class="category">
            <h2>Categories</h2>
            <form action="./Product.php" method="POST">
                <ul>
                    <?php
                    $query = "SELECT * FROM categorie";
                    $result = mysqli_query($conn, $query);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $Catg[] = $row['Nom'];
                        echo "<li><button type='submit' name='category' value='" . htmlspecialchars($row['Nom']) . "'>" . htmlspecialchars($row['Nom']) . "</button></li>";

                        }
                    }else {
                        echo "<li>Error loading categories</li>";
                    }
                    ?>
                </ul>
            </form>
        </div>
    </div>

    <div class="All_P">
        <div>
            <h2>Products <i class="fa-solid fa-percent"></i></h2>
        </div>
        <div class="Products">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['category'])) {
                $macategory = mysqli_real_escape_string($conn, $_POST['category']);
                // print_r($_POST);
                $rqt = "SELECT ID FROM categorie WHERE Nom = '$macategory'";
                $rp = mysqli_query($conn, $rqt);
                if ($rp && mysqli_num_rows($rp) > 0) {
                    $row = mysqli_fetch_assoc($rp);
                    $id = $row['ID'];
                    $query = "SELECT * FROM produit WHERE Categorie = $id";
                    $result = mysqli_query($conn, $query);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            echo "<div class='product-item'>";
                            echo "<img src='" . htmlspecialchars($row['ImageURL']) . "' alt='" . htmlspecialchars($row['Reference']) . "' class='product-img'>";
                            echo "<p class='title'>" . htmlspecialchars($row['Designation']) . "</p>";
                            echo "<p class='price'>" . htmlspecialchars($row['prix']) . " DH</p>";
                            echo "<div class='btns'>";
                            if (!isset($_SESSION['user_id'])) {
                                echo "<form action='./verifieSign.php'>";
                                echo "<button type='submit' class='Buy_Now'>Buy Now</button>";
                                echo "<button type='submit' class='Add'>Add</button>";
                                echo "</form>";
                            } else {
                                echo "<form action='addToCart2.php' method='post'>";
                                echo "<input type='hidden' name='product_id' value='" . htmlspecialchars($row['Reference']) . "'>";
                                echo "<button type='submit' name='Buy_Now' class='Buy_Now'>Buy Now</button>";
                                echo "<button type='submit' name='Add' class='Add'>Add</button>";
                                echo "</form>";
                            }
                            echo "</div></div>";
                        }
                    } else {
                        echo "<p>Error fetching products.</p>";
                    }
                } else {
                    echo "<p>Category not found.</p>";
                }
            } else {
                echo "<p>Select a category to view products.</p>";
            }
            ?>
        </div>
    </div>
</div>

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

<script src="script.js"></script>
</body>
</html>
