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
    <link rel="stylesheet" href="./css/Lcomd.css">
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
                <h2> Commande Ligne  <i class="fa-solid fa-link"></i></h2>
                <div class="form-group">
                    <label for="RefProduit">Ref_Produit</label>
                    <select name="RefProduit" id="RefProduit">
                    <?php
                            require_once("../Connection.php");
                            $rq="SELECT Reference  FROM produit ";
                            $rp=mysqli_query($conn,$rq);
                            if($rp){
                                while($ligne=mysqli_fetch_assoc($rp)){
                                    echo "<option value='{$ligne['Reference']}'>{$ligne['Reference']}</option>";
                                }
                            }else{
                                echo "error!!";
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="NumCommande">Num_Commande</label>
                    <select name="NumCommande" id="NumCommande">
                    <?php
                            require_once("../Connection.php");
                            $rq="SELECT Num FROM commande ";
                            $rp=mysqli_query($conn,$rq);
                            if($rp){
                                while($ligne=mysqli_fetch_assoc($rp)){
                                    echo "<option value='{$ligne['Num']}'>{$ligne['Num']}</option>";
                                }
                            }else{
                                echo "error!!";
                            }
                        ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="Quantite">Quantite</label>
                    <input type="number" name="Quantite" id="Quantite" >
                </div>
                <div class="form-group">
                    <label for="PrixUnitaire">Prix_Unitaire</label>
                    <input type="number" step="0.01" name="PrixUnitaire" id="PrixUnitaire" >
                </div>
                <div class="buttons">
                    <input type="submit" value="Add"  name="Add" class="btn">
                    <input type="submit" value="Delete" name="Delete" class="btn" onclick="alert('Are you sure you want to delete this user?')">
                    <input type="submit" value="Update" name="Update" class="btn" onclick="alert('Are you sure you want to update this user?')">
                    <input type="submit"  value="show" name="show" class="btn">
                    <input type="reset" value="Reset" class="btn">
                </div>
                
            </form>
           
        </div>
     </div>
     <div class="result hidden">
        <div class="container">
         <h2>Products List</h2>
            <table class="styled-table">
                <thead>
                <tr>
                <th>RefProduit </th>
                <th>NumCommande </th>
                <th>Quantite</th>
                <th>PrixUnitaire </th>
                </tr>
      </thead>
      <tbody id="user-table-body">
        <!-- User data will be populated here -->
         <?php
         require_once("../Connection.php");
         if($_SERVER['REQUEST_METHOD']==="POST"){
            if(isset($_POST['show'])&& $_POST['show']==='show'){
                $rq="SELECT * FROM lignedecommande";
                $rp=mysqli_query($conn,$rq);
                if($rp){
                while($ligne=mysqli_fetch_assoc($rp)){
                echo "<tr>";
                echo "<td>{$ligne['RefProduit']}</td>";
                echo "<td>{$ligne['NumCommande']}</td>";
                echo "<td>{$ligne['Quantite']}</td>";
                echo "<td>{$ligne['PrixUnitaire']}</td>";
                echo "</tr>";
            }
         }else{
            echo "<tr><td colspan='8'>No data found or error: " . mysqli_error($conn) . "</td></tr>";
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

</html><?php
require_once("../Connection.php");

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    // Sanitize input
    $RefProduit       = $_POST['RefProduit'] ?? "none";
    $NumCommande      = $_POST['NumCommande'] ?? "none";
    $Quantite    = $_POST['Quantite'] ?? "none";
    $PrixUnitaire = $_POST['PrixUnitaire'] ?? "none";
    // Escape strings for safety (minimum protection — use prepared statements ideally)
    $RefProduit       = intval($RefProduit); // make sure id is integer
    $NumCommande       = intval($NumCommande); // make sure id is integer
    $Quantite       = intval($Quantite); // make sure id is integer
    $PrixUnitaire       = intval($PrixUnitaire); // make sure id is integer


    // Handle Add
    if (isset($_POST['Add']) && $_POST['Add'] === "Add") {
        $query = "INSERT INTO lignedecommande VALUES ($RefProduit , $NumCommande, $Quantite, $PrixUnitaire)";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo "Insert error: " . mysqli_error($conn);
        } else {
            echo "Client added successfully.";
        }
    }

    // Handle Delete
    if (isset($_POST['Delete']) && $_POST['Delete'] === "Delete") {
        $query = "DELETE FROM lignedecommande WHERE RefProduit = $RefProduit AND NumCommande=$NumCommande ";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo "Delete error: " . mysqli_error($conn);
        } else {
            echo "Client deleted successfully.";
        }
    }
    if (isset($_POST['Update']) && $_POST['Update'] === "Update") {
        $query = "UPDATE lignedecommande 
        set Quantite=$Quantite,PrixUnitaire=$PrixUnitaire
        WHERE RefProduit=$RefProduit AND NumCommande=$NumCommande ";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo "Update error: " . mysqli_error($conn);
        } else {
            echo "Client Update successfully.";
        }
    
    }

}
?>
