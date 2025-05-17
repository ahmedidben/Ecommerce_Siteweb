<?php
session_start();

// Supprimer toutes les variables de session
session_unset();

// Supprimer le cookie de session
$params = session_get_cookie_params();
setcookie(
    session_name(),      // nom du cookie de session
    '',                  // valeur vide
    time() - 42000,      // date d'expiration dans le passé
    $params["path"], 
    $params["domain"],
    $params["secure"], 
    $params["httponly"]
);

// Détruire la session
session_destroy();
header("location: ./index.php");
exit();
?>
