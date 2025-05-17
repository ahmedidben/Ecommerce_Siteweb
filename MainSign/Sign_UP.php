<?php
require_once("../Connection.php");

$email = $_POST['email'] ?? "";
$password = $_POST['password'] ?? "";
$nom = $_POST['name'] ?? "";

// Sécuriser le mot de passe avant insertion
//$hashedPassword = password_hash($password, PASSWORD_DEFAULT);

$requete = "INSERT INTO client (Email, Motdepass, Nom) VALUES (?, ?, ?)";
$statement = mysqli_prepare($conn, $requete);

if ($statement) {
    mysqli_stmt_bind_param($statement, "sss", $email, $password, $nom);
    if (mysqli_stmt_execute($statement)) {
        header("location: ./SingUP_IN.php");
    } else {
        echo "Erreur lors de l'insertion.";
    }
} else {
    echo "Erreur lors de la préparation de la requête.";
}
?>

