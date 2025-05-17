<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin</title>
    <!-- normalized all element  -->
    <link rel="stylesheet" href="../css/normalized.css">
    <link rel="stylesheet" href="../css/all.min.css">
    <link rel="stylesheet" href="./css/dashboard.css">
    <link rel="stylesheet" href="./css/users.css">
    <link rel="stylesheet" href="./css/orders.css">
    <!-- google fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
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
                <div class="name"> welecome admin</div>
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
            <form action="" method="post" class="form">
                <h2>Orders <i class="fa-solid fa-box"></i> </h2>
                <div class="form-group">
                    <label for="Num">Num</label>
                    <input type="number" name="Num" id="Num"  >
                </div>
                <div class="form-group">
                    <label for="DateCommande">DateCommande</label>
                    <input type="date" name="DateCommande" id="DateCommande" >
                </div>
                <div class="form-group">
                    <label for="IDClient">IDClient</label>
                    <select name="IDClient" id="IDClient ">
                    <?php
                            require_once("../Connection.php");
                            $rq="SELECT ID FROM client ";
                            $rp=mysqli_query($conn,$rq);
                            if($rp){
                                while($ligne=mysqli_fetch_assoc($rp)){
                                    echo "<option value='{$ligne['ID']}'>{$ligne['ID']}</option>";
                                }
                            }else{
                                echo "error!!";
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Statut">Statut</label>
                    <select name="Statut" id="Statut">
                        <option value="Statut">Statut</option>
                        <option value="En cours">En cours</option>
                        <option value="Livré">Livré</option>
                        <option value="Annulé">Annulé</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="AdresseLivraison">Adresse Livraison</label>
                    <input type="text" name="AdresseLivraison" id="AdresseLivraison" >
                </div>
                <div class="buttons">
                    <input type="submit" value="Add" name="Add" class="btn">
                    <input type="submit" value="Delete" name="Delete" class="btn" onclick="alert('Are you sure you want to delete this user?')">
                    <input type="submit" value="Update" name="Update" class="btn" onclick="alert('Are you sure you want to update this user?')">
                    <input type="submit" value="show" name="show" class="btn">
                    <input type="reset"  value="Reset" class="btn">
                </div>
            </form>

            
        </div>
     </div>
     <div class="result hidden">
        <div class="container">
         <h2>Orders List</h2>
            <table class="styled-table">
                <thead>
                <tr>
                <th>Num</th>
                <th>DateCommande</th>
                <th>IDClient</th>
                <th>Statut </th>
                <th>AdresseLivraison</th>
                </tr>
      </thead>
      <tbody id="user-table-body">
        <!-- User data will be populated here -->
        <?php
require_once("../Connection.php");

if ($_SERVER['REQUEST_METHOD'] === "POST") {
    if (isset($_POST['show']) && $_POST['show'] === 'show') {

        $rq = "SELECT * FROM commande";
        $rp = mysqli_query($conn, $rq);

        if ($rp && mysqli_num_rows($rp) > 0) {
            while ($ligne = mysqli_fetch_assoc($rp)) {
                echo "<tr>";
                echo "<td>{$ligne['Num']}</td>";
                echo "<td>{$ligne['DateCommande']}</td>";
                echo "<td>{$ligne['IDClient']}</td>";
                echo "<td>{$ligne['Statut']}</td>";
                echo "<td>{$ligne['AdresseLivraison']}</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No data found or error: " . mysqli_error($conn) . "</td></tr>";
        }
    }
}
?>
      </tbody>
    </table>
  </div>
</div>
    <script src="./script.js"></script>
</body>
</html>

<?php

require_once("../Connection.php");

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    // Sanitize input
    $Num        = $_POST['Num'] ?? "";
    $DateCommande     = $_POST['DateCommande'] ?? "none";
    $IDClient     = $_POST['IDClient'] ??"";
    $Statut = $_POST['Statut'] ?? "none";
    $AdresseLivraison      = $_POST['AdresseLivraison'] ?? "none";

    // Escape strings for safety (minimum protection — use prepared statements ideally)
    $Num       = intval($Num); // make sure id is integer
    $IDClient        = intval($IDClient ); // make sure id is integer
    $DateCommande     = mysqli_real_escape_string($conn, $DateCommande);
    $Statut    = mysqli_real_escape_string($conn, $Statut);
    $AdresseLivraison = mysqli_real_escape_string($conn, $AdresseLivraison);

    // Handle Add
    if (isset($_POST['Add']) && $_POST['Add'] === "Add") {
        $query = "INSERT INTO commande (Num, DateCommande, IDClient, Statut, AdresseLivraison)
                  VALUES ($Num, '$DateCommande', $IDClient, '$Statut', '$AdresseLivraison')";        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo "Insert error: " . mysqli_error($conn);
        } else {
            echo "Client added successfully.";
        }
    }

    // Handle Delete
    if (isset($_POST['Delete']) && $_POST['Delete'] === "Delete") {
        $query = "DELETE FROM commande WHERE Num = $Num";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo "Delete error: " . mysqli_error($conn);
        } else {
            echo "Client deleted successfully.";
        }
    }
    if (isset($_POST['Update']) && $_POST['Update'] === "Update") {
        $query = "UPDATE commande 
        set DateCommande ='$DateCommande' ,IDClient =$IDClient,Statut='$Statut',AdresseLivraison='$AdresseLivraison'
        WHERE Num=$Num ";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo "Update error: " . mysqli_error($conn);
        } else {
            echo "Client Update successfully.";
        }
    
    }

}
?>