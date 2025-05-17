<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <!-- normalized all element  -->
    <link rel="stylesheet" href="../css/normalized.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="./css/dashboard.css">
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
</head>

<body>
    <!-- nav  -->
    <div class="header">
        <div class="container">
            <div class="nav">
                <button class="bars"><i class="fa-solid fa-bars"></i></button>
                <button class="bell"><i class="fa-solid fa-bell"></i></button>
            </div>

            <div class="profile_i">
                <img src="../imgs/user-1-CGXawLZT.jpg" alt="profile" class="profile-img">
            </div>
            <div class="profile off">
                <div class="name"> welecome <?php echo $_SESSION['username']; ?></div>
                <form action="../logout.php">
                    <button type="submit" class="LogOut" >Logout</button>
                </form>
            </div>
            <div class="menu hidden">
                <div class="menu-item">
                    <i class="fa-solid fa-house"></i>
                    <a href="./dashboard.php">Dashboard</a>
                </div>
                <div class="menu-item">
                    <i class="fa-solid fa-user"></i>
                    <a href="./users.php">Users</a>
                </div>
                <div class="menu-item">
                    <i class="fa-solid fa-box"></i>
                    <a href="./products.php">Products</a>
                </div>
                <div class="menu-item">
                    <i class="fa-solid fa-chart-simple"></i>
                    <a href="./orders.php">Orders</a>
                </div>
                <div class="menu-item">
                    <i class="fa-solid fa-boxes-stacked"></i>
                    <a href="./command_line.php">command line</a>
                </div>

            </div>
        </div>

    </div>
    <!-- end nav  -->
    <!-- main  -->
    <div class="main">
        <div class="container">
            <div class="Welcome">
                <h2>Welcome, <?php echo $_SESSION['username']; ?> 👋</h2>
                <p>Here's what's happening today.</p>
            </div> 
            <div class="orders">
                <p>Number Of Oreders : </p>
                <span>
                    <?php
                    require_once("../connection.php");
                    $rq="SELECT COUNT(*)as num FROM commande";
                    $rs=mysqli_query($conn,$rq);
                    if ($rs && mysqli_num_rows($rs) === 1) {
                        $row = mysqli_fetch_assoc($rs);        // Fetch the row
                       echo $row["num"];
                    } else {
                        echo "Error 'NAN'";
                     }
                    ?>
                    <i class="fa-solid fa-fire"></i>
                </span>
            </div>
            <div class="clients">
               <p>Number Of Clients : </p>
               <span>
               <?php
                    require_once("../connection.php");
                    $rq="SELECT COUNT(*)as num FROM client";
                    $rs=mysqli_query($conn,$rq);
                    if ($rs && mysqli_num_rows($rs) === 1) {
                        $row = mysqli_fetch_assoc($rs);        // Fetch the row
                       echo $row["num"];
                    } else {
                        echo "Error 'NAN'";
                     }
                    ?>
                    <i class="fa-solid fa-person"></i>
                </span>
            </div>
            <div class="D_Admin">
                <p>Number Of demande_Admin : </p>
                <span>
                <?php
                    require_once("../connection.php");
                    $rq="SELECT COUNT(*)as num FROM demandeadmin";
                    $rs=mysqli_query($conn,$rq);
                    if ($rs && mysqli_num_rows($rs) === 1) {
                        $row = mysqli_fetch_assoc($rs);        // Fetch the row
                       echo $row["num"];
                    } else {
                        echo "Error 'NAN'";
                     }
                    ?>
                    <i class="fa-solid fa-paper-plane"></i>
                    
                </span>
            </div>
        </div>
    </div>
    <script src="./script.js"></script>
</body>

</html>