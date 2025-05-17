<?php
session_start();
require_once("../Connection.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'] ?? "";
    $password = $_POST['password'] ?? "";

    $requete = "SELECT ID, Nom, Tel, Address FROM client WHERE Email = ? AND Motdepass= ?";
    $statement = mysqli_prepare($conn, $requete);

    if ($statement) {
        // Lier les paramètres d'entrée
        mysqli_stmt_bind_param($statement, "ss", $email, $password);
        mysqli_stmt_execute($statement);

        // Lier les résultats aux variables
        mysqli_stmt_bind_result($statement, $id, $nom, $tel, $addr);
        
        // Stocker les résultats (utile pour utiliser mysqli_stmt_num_rows)
        mysqli_stmt_store_result($statement);

        if (mysqli_stmt_num_rows($statement) > 0) {
            // Récupérer les résultats
            while (mysqli_stmt_fetch($statement)) {
                $_SESSION['user_id'] = $id;
                $_SESSION['username'] = $nom;
                $_SESSION['user_tel'] = $tel;
                $_SESSION['user_Address'] = $addr;
            }

            header("Location: ../index.php");
            exit();
        } else {
            echo "Aucun utilisateur trouvé avec ces identifiants.";
        }
    } else {
        echo "Erreur dans la préparation de la requête.";
    }
}
?>

