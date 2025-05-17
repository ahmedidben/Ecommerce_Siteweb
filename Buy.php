<?php
session_start();
require_once("./Connection.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$U_id = $_SESSION['user_id'];
$cart_items = [];
$total_price = 0;

// Get all "EN COURE" commandes for the user
$rq = "SELECT Num FROM commande WHERE IDClient = $U_id AND Statut = 'EN COURE' ORDER BY DateCommande DESC";
$res = mysqli_query($conn, $rq);

// Store all commande IDs
$commandes_id = [];
while ($row = mysqli_fetch_assoc($res)) {
    $commandes_id[] = $row['Num'];
}
$_SESSION['$id_user_de_commande']=$U_id;
$_SESSION['$id_commandes_Buy']=$commandes_id;

// Loop through each commande
foreach ($commandes_id as $commande_id) {
    $rq = "SELECT 
                p.ImageURL, p.Designation, p.Reference, lc.Quantite, lc.PrixUnitaire,lc.NumCommande 
           FROM 
                lignedecommande lc
           JOIN 
                produit p ON lc.RefProduit = p.Reference
           WHERE 
                lc.NumCommande = $commande_id";
    $res = mysqli_query($conn, $rq);

    while ($row = mysqli_fetch_assoc($res)) {
        $row['Total'] = $row['Quantite'] * $row['PrixUnitaire'];
        $total_price += $row['Total'];
        $cart_items[] = $row;
    }
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <title>Basket</title>
    <link rel="stylesheet" href="../../css/normalized.css">
    <link rel="stylesheet" href="../../css/all.min.css">
    <link rel="stylesheet" href="./css/kolchi.css">
    <link rel="stylesheet" href="./css/Buy.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet"/>
</head>
<body>
<header class="header">
    <div class="container">
        <div class="logo">
            <a href="./index.php"><img src="./imgs/KOlش.svg" alt="logo" class="logo-img"></a>
        </div>
    </div>
</header>

<!-- basket section -->
<div class="carts">
    <div class="container">
        <h2 class="basket-title">Your Shopping Cart</h2>

        <?php if (!empty($cart_items)): ?>
            <?php foreach ($cart_items as $item): ?>
                <div class="cart-box">
                    <img src="<?= $item['ImageURL'] ?>" class="cart-img" alt="product"/>
                    <div class="cart-details">
                        <h3 class="cart-product-title"><?= htmlspecialchars($item['Designation']) ?></h3>
                        <p>Unit Price: <?= $item['PrixUnitaire'] ?> MAD</p>
                        <p>Quantity: <?= $item['Quantite'] ?></p>
                        <p>Total: <strong><?= $item['Total'] ?> MAD</strong></p>
                        <form method="post" action="removeFromCart.php">
                            <input type="hidden" name="product_id" value="<?= $item['Reference'] ?>">
                            <button type="submit" class="remove-btn" name="Num" value="<?= $item['NumCommande'] ?>">Remove</button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
            <div class="cart-summary">
                <h3>Total: <span><?= $total_price ?> MAD</span></h3>
                 <form action="confirm_order.php" method="POST">
                    <button type="submit" class="checkout-btn">Proceed to Checkout</button>
                 </form>
</div>
        <?php else: ?>
            <p style="text-align:center;">Your cart is empty.</p>
        <?php endif; ?>
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

</body>
</html>
