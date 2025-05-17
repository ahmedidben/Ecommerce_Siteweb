<?php
session_start();
require_once("./Connection.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$U_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['product_id'])&& isset($_POST['Num']) ) {
    $product_id = intval($_POST['product_id']);


            $commande_id = $_POST['Num'];
            // Remove product from the corresponding ligne de commande
            $delete_rq = "DELETE FROM lignedecommande 
                          WHERE RefProduit = $product_id 
                          AND NumCommande = $commande_id";
            mysqli_query($conn, $delete_rq);
            // remove it from commande 
            $delete_rq="DELETE FROM commande 
            WHERE Num=$commande_id";
            mysqli_query($conn, $delete_rq);
    }

// Redirect back to the cart page
header("Location: Buy.php");
exit();
?>