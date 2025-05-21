<?php
session_start();
$Catg[] = "";
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
    <style>
        .sort-container {
            text-align: left;
            padding: 10px 20px;
            margin:0 0  20px 0;
        }
        .sort-container select {
            padding: 5px 10px;
            border-radius: 8px;
            border: 1px solid #ccc;
        }
    </style>
</head>
<body>
<header class="header">
    <!-- (ton header reste inchangé ici) -->
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
                <button type="submit" class="No_account_Now"><i class="fa-solid fa-user"></i></button>
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
    <!-- ... -->
</header>

<div class="main">
    <div class="side_category">
        <div class="category">
            <h2>Categories </h2>
            <form action="./categorys.php" method='POST'>
                <ul>
                    <?php
                    require_once('./Connection.php');
                    $query = "SELECT * FROM categorie";
                    $result = mysqli_query($conn, $query);
                    if ($result) {
                        while ($row = mysqli_fetch_assoc($result)) {
                            $Catg[] = $row['Nom'];
                            echo "<li><button type='submit' name='category' value='" . htmlspecialchars($row['Nom']) . "'>" . htmlspecialchars($row['Nom']) . "</button></li>";
                        }
                    } else {
                        echo "Error: " . mysqli_error($conn);
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

        <!-- Formulaire de tri -->
        <div class="sort-container">
            <form method="GET">
                <label for="sort">Trier par prix :</label>
                <select name="sort" id="sort" onchange="this.form.submit()">
                    <option value="">-- Choisir --</option>
                    <option value="asc" <?php if (isset($_GET['sort']) && $_GET['sort'] === 'asc') echo 'selected'; ?>>Prix croissant</option>
                    <option value="desc" <?php if (isset($_GET['sort']) && $_GET['sort'] === 'desc') echo 'selected'; ?>>Prix décroissant</option>
                </select>
            </form>
        </div>

        <!-- Affichage des produits -->
        <div class="Products">
            <?php
            require_once('./Connection.php');
            $sort = isset($_GET['sort']) ? $_GET['sort'] : '';
            if ($sort === 'asc') {
                $query = "SELECT * FROM produit ORDER BY prix ASC";
            } elseif ($sort === 'desc') {
                $query = "SELECT * FROM produit ORDER BY prix DESC";
            } else {
                $query = "SELECT * FROM produit";
            }

            $result = mysqli_query($conn, $query);
            if ($result) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "<div class='product-item'>";
                    echo "<img src='" . $row['ImageURL'] . "' alt='" . $row['Reference'] . "' class='product-img'>";
                    echo "<p class='title'>" . $row['Designation'] . "</p>";
                    echo "<p class='price'>" . $row['prix'] . " DH</p>";
                    echo "<div class='btns'>";
                    if (!isset($_SESSION['user_id'])) {
                        echo "<form action='./verifieSign.php'>";
                        echo "<button type='submit' class='Buy_Now'>Buy Now</button>";
                        echo "<button type='submit' class='Add'>Add</button>";
                        echo "</form>";
                    } else {
                        echo "<form action='addToCart2.php' method='post'>";
                        echo "<input type='hidden' name='product_id' value='{$row['Reference']}'>";
                        echo "<button type='submit' name='Buy_Now' value='Buy_Now' class='Buy_Now'>Buy Now</button>";
                        echo "<button type='submit' name='Add' value='Add' class='Add'>Add</button>";
                        echo "</form>";
                    }
                    echo "</div></div>";
                }
            } else {
                echo "Error: " . mysqli_error($conn);
            }
            mysqli_close($conn);
            ?>
        </div>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <div class="footer-content">
            <div class="footer-logo">
                <img src="./imgs/KOlش.svg" alt="logo" class="logo-img">
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
