<?php
session_start();
require_once("./Connection.php");
$quantite = 1;

if (isset($_POST['product_id']) && isset($_SESSION['user_id'])) {
    $P_id = intval($_POST['product_id']);
    $U_id = intval($_SESSION['user_id']);

    // Insert into commande
    $rq = "INSERT INTO commande (DateCommande, IDClient, Statut) VALUES (NOW(), $U_id, 'EN COURE')";
    $rp = mysqli_query($conn, $rq);

    if ($rp) {
        $Num = mysqli_insert_id($conn); // NumCommande

        // Check if product already exists in lignedecommande
        $rq1 = "SELECT 1 AS R FROM lignedecommande 
        JOIN commande ON lignedecommande.NumCommande = commande.Num 
        WHERE RefProduit = $P_id AND commande.Num = $Num AND IDClient = $U_id";
        $rp1 = mysqli_query($conn, $rq1);

        if ($rp1) {
            $row = mysqli_fetch_assoc($rp1);

            if ($row) {
                // Product already in lignedecommande => update quantity
                $rq2 = "UPDATE lignedecommande
                        SET Quantite = Quantite + 1
                        WHERE RefProduit = $P_id AND NumCommande = $Num";
                mysqli_query($conn, $rq2);
            } else {
                // Get product price
                $rq3 = "SELECT prix AS p FROM produit WHERE Reference = $P_id";
                $rp3 = mysqli_query($conn, $rq3);
                $row3 = mysqli_fetch_assoc($rp3);
                $prix = $row3['p'];

                // Insert into lignedecommande
                $rq4 = "INSERT INTO lignedecommande (RefProduit, NumCommande, Quantite, PrixUnitaire)
        VALUES ($P_id, $Num, $quantite, $prix)";

                mysqli_query($conn, $rq4);
            }

            if(isset($_POST['Buy_Now']) && $_POST['Buy_Now']=='Buy_Now'){
                header("location: ./Buy.php");
                exit();
            }
            if(isset($_POST['Add']) && $_POST['Add']=='Add'){
                header("location: ./Product.php");

                exit();
            }
            
        } else {
            echo "error:2"; // lignedecommande select failed
        }
    } else {
        echo "error:1"; // commande insert failed
    }
} else {
    echo "Erreur : données manquantes.";
}
?>
