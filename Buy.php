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
$_SESSION['$id_user_de_commande'] = $U_id;
$_SESSION['$id_commandes_Buy'] = $commandes_id;

// Loop through each commande
foreach ($commandes_id as $commande_id) {
    $rq = "SELECT 
                p.ImageURL, p.Designation, p.Reference, lc.Quantite, lc.PrixUnitaire, lc.NumCommande 
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

// Tax, shipping, promo logic
$shipping = 20; // MAD
$tax_rate = 0.15;
$tax = $total_price * $tax_rate;
$promo_discount = 0;

if (isset($_POST['promo_code']) && $_POST['promo_code'] === 'KOL10') {
    $promo_discount = 0.10 * $total_price;
}

$grand_total = $total_price + $shipping + $tax - $promo_discount;
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
    <style>
        .cart-side {
            background-color: #f9f9f9;
            padding: 20px;
            border-radius: 12px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            max-width: 350px;
            margin: 0px auto;
        }
        .cart-side h3 {
            font-size: 1.2rem;
            margin-bottom: 15px;
        }
        .cart-side p {
            margin: 10px 0;
        }
        .cart-side input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-top: 5px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 6px;
        }
        .cart-side button {
            padding: 10px;
            width: 100%;
            background-color: #222;
            color: #fff;
            border: none;
            border-radius: 6px;
            cursor: pointer;
        }
        .cart-box {
            margin-bottom: 20px;
        }
    </style>
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

            <!-- Cart Summary Sidebar -->
            <div class="cart-side">
                <h3>Order Summary</h3>
                <p>Subtotal: <strong><?= number_format($total_price, 2) ?> MAD</strong></p>
                <p>Shipping: <strong><?= number_format($shipping, 2) ?> MAD</strong></p>
                <p>Tax (15%): <strong><?= number_format($tax, 2) ?> MAD</strong></p>

                <form method="POST">
                    <label for="promo_code">Promo Code:</label>
                    <input type="text" name="promo_code" id="promo_code" placeholder="Enter code (e.g. KOL10)" />
                    <button type="submit">Apply</button>
                </form>

                <?php if ($promo_discount > 0): ?>
                    <p>Promo Discount: <strong>-<?= number_format($promo_discount, 2) ?> MAD</strong></p>
                <?php endif; ?>

                <hr>
                <p><strong>Total:</strong> <span><?= number_format($grand_total, 2) ?> MAD</span></p>

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

</body>
</html>
