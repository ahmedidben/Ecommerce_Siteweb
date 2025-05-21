<?php
session_start();
require_once('Connection.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: ./MainSign/SingUP_IN.php");
    exit();
}

$userId = $_SESSION['user_id'];
$user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM client WHERE ID=$userId"));

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    if (!empty($_POST['password'])) {
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $update = "UPDATE client SET Nom='$username', Email='$email', Motdepass='$password' WHERE ID=$userId";
    } else {
        $update = "UPDATE client SET Nom='$username', Email='$email' WHERE ID=$userId";
    }

    mysqli_query($conn, $update);
    header("Location: profile.php?updated=1");
    exit();
}

// Order Status Auto-Update (if in session)
if (isset($_SESSION['$id_commandes_Buy'], $_SESSION['$id_user_de_commande'])) {
    $cmds = $_SESSION['$id_commandes_Buy'];
    $user_id = $_SESSION['$id_user_de_commande'];
    foreach ($cmds as $cmd) {
        $query = "SELECT * FROM commande WHERE Num=$cmd AND IDClient=$user_id";
        $result = mysqli_query($conn, $query);
        if ($result && $row = mysqli_fetch_assoc($result)) {
            $orderDate = new DateTime($row['DateCommande']);
            $currentDate = new DateTime();

            if ($currentDate->diff($orderDate)->days >= 3) {
                mysqli_query($conn, "UPDATE commande SET Statut='Arrived' WHERE Num=$cmd AND IDClient=$user_id");
            } else {
                mysqli_query($conn, "UPDATE commande SET Statut='In Delivery' WHERE Num=$cmd AND IDClient=$user_id");
            }
        }
    }
}

$orders = mysqli_query($conn, "SELECT * FROM commande WHERE IDClient=$userId ORDER BY DateCommande DESC");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Profile - KolXi</title>
    <link rel="stylesheet" href="css/normalized.css">
    <link rel="stylesheet" href="css/kolchi.css">
    <link rel="stylesheet" href="css/profile.css">
    <link rel="shortcut icon" href="imgs/logo.svg" type="image/x-icon">
    <link rel="stylesheet" href="css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <style>
        .profile-container {
            max-width: 1000px;
            margin: 40px auto;
            padding: 20px;
            background: #fff;
            border-radius: 10px;
        }

        h2, h3 {
            margin-bottom: 20px;
        }

        .profile-box, .orders {
            margin-bottom: 40px;
        }

        form input[type="text"],
        form input[type="email"],
        form input[type="password"] {
            display: block;
            width: 100%;
            padding: 10px;
            margin: 10px 0 20px;
        }

        form button {
            padding: 10px 20px;
            background-color: #0070f3;
            color: white;
            border: none;
            border-radius: 5px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            padding: 12px;
            text-align: center;
            border: 1px solid #ddd;
        }

        .status {
            font-weight: bold;
        }

        .status.Arrived { color: green; }
        .status["In Delivery"] { color: orange; }
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

<div class="profile-container">
    <h2>Hello, <?php echo htmlspecialchars($user['Nom']); ?> 👋</h2>

    <div class="profile-box">
        <h3>Update Your Information</h3>
        <form method="POST">
            <label>Username</label>
            <input type="text" name="username" value="<?php echo htmlspecialchars($user['Nom']); ?>" required>

            <label>Email</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($user['Email']); ?>" required>

            <label>New Password <small>(leave blank to keep current)</small></label>
            <input type="password" name="password">

            <button type="submit">Save Changes</button>
        </form>
    </div>

    <div class="orders">
        <h3>Your Orders</h3>
        <?php if (mysqli_num_rows($orders) > 0): ?>
            <table>
                <tr>
                    <th># Order</th>
                    <th>Date</th>
                    <th>Status</th>
                </tr>
                <?php while ($order = mysqli_fetch_assoc($orders)): ?>
                    <tr>
                        <td>#<?php echo $order['Num']; ?></td>
                        <td><?php echo $order['DateCommande']; ?></td>
                        <td class="status <?php echo $order['Statut']; ?>"><?php echo $order['Statut']; ?></td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>No orders yet.</p>
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
