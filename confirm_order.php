<?php
session_start();
require_once("./Connection.php");

if (!isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit();
}

$U_id = $_SESSION['user_id'];
$commandes_id = $_SESSION['$id_commandes_Buy'] ?? [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['name'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    $address = mysqli_real_escape_string($conn, $_POST['address']);
    $City = mysqli_real_escape_string($conn, $_POST['City']);

    foreach ($commandes_id as $commande_id) {
        $stmt = $conn->prepare("UPDATE client SET Nom= ?, Tel = ?, Address = ?,Ville=? WHERE ID= ?");
        $stmt->bind_param("ssssi", $name, $phone, $address, $City,$U_id );
        $stmt->execute();
    }

    // Optional: Clear session cart IDs
    header("Location: thankyou.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Confirm Order</title>
    <link rel="stylesheet" href="../../css/normalized.css">
    <link rel="stylesheet" href="../../css/all.min.css">
    <link rel="stylesheet" href="./css/kolchi.css">
    <link rel="stylesheet" href="./css/Buy.css">
    <link rel="preconnect" href="https://fonts.googleapis.com"/>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin/>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet"/>
    <style>
               /* body {
            margin: 0;
            font-family: 'Roboto', sans-serif;
            background-color: #f2f4f8;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        } */
        .confirm-container {
            background-color: #ffffff;
            padding: 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 90%;
            max-width: 500px;
            margin:50px auto;
        }
        h2 {
            margin-bottom: 25px;
            color: #222;
            text-align: center;
        }
        label {
            display: block;
            margin-bottom: 8px;
            margin-top: 20px;
            color: #333;
            font-weight: bold;
        }
        input[type="text"],
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            background-color: #fafafa;
            transition: border-color 0.3s;
        }
        input[type="text"]:focus,
        textarea:focus {
            border-color: #007bff;
            outline: none;
        }
        textarea {
            resize: vertical;
            min-height: 100px;
        }
        button {
            width: 100%;
            padding: 14px;
            background-color: #007bff;
            color: white;
            font-size: 18px;
            border: none;
            border-radius: 8px;
            cursor: pointer;
            margin-top: 30px;
            transition: background-color 0.3s;
        }
        button:hover {
            background-color: #0056b3;
        }
        .note {
            text-align: center;
            font-size: 14px;
            color: #777;
            margin-top: 10px;
        }
        @media (max-width: 480px) {
            .confirm-container {
                padding: 25px;
            }
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
    <div class="confirm-container">
        <h2>Confirm Your Order</h2>
        <form method="POST">
            <label for="name">Full Name:</label>
            <input type="text" name="name" id="name" required>

            <label for="phone">Phone Number:</label>
            <input type="text" name="phone" id="phone" required>

            <label for="address">Delivery Address:</label>
            <textarea name="address" id="address" required></textarea>

            <label for="City">City:</label>
            <input type="text" name="City" id="City" required>
            <button type="submit">Submit Order</button>
        </form>
        <p class="note">Your order details will be securely saved.</p>
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
