<?php
if (!isset($_SESSION['user_id'])) {
    // Redirect to login or signup page
    header("Location: ./MainSign/SingUP_IN.php");
    exit();
}

?>