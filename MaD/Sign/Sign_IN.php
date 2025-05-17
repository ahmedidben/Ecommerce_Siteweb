<?php
session_start();
require_once("../../Connection.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $email = $_POST['email'] ?? "";
    $password = $_POST['password'] ?? "";
    $nom=null;
    $requete = "SELECT 1 FROM admin WHERE Email = ? AND Password = ?";
    $statement = mysqli_prepare($conn, $requete);

    if ($statement) {
        mysqli_stmt_bind_param($statement, "ss", $email, $password);
        mysqli_stmt_execute($statement);
        mysqli_stmt_store_result($statement); // nécessaire pour vérifier le nombre de lignes

        if (mysqli_stmt_num_rows($statement) > 0) {
            $rq="SELECT nom  from admin WHERE Email='$email'";
            $rs= mysqli_query($conn,$rq);
           if ($rs && mysqli_num_rows($rs) === 1) {
                $row = mysqli_fetch_assoc($rs);        // Fetch the row
                $_SESSION['username'] = $row['nom'];       // Save to session
            } else {
                echo "Email non trouvé ou doublon.";
             }
            header("Location: ../dashboard.php");
            exit();
        } else {
            header("Location: ./SingUP_IN.php");
            exit();
        }
    } else {
        echo "Erreur dans la requête SQL.";
    }
}
?>
