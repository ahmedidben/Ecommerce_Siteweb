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
    <link rel="stylesheet" href="./css/products.css">
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
            <form action="" method="POST" class="form">
                <h2>Products <i class="fa-solid fa-box"></i> </h2>
                <div class="form-group">
                    <label for="Ref">refirence</label>
                    <input type="text" name="Ref" id="Ref" placeholder="refirence" >
                </div>
                <div class="form-group">
                    <label for="Designation">Designation</label>
                    <input type="text" name="Designation" id="Designation" placeholder="Designation" >
                </div>
                <div class="form-group">
                    <label for="Description">Description</label>
                    <input type="text" name="Description" id="Description" placeholder="Description" >
                </div>
                <div class="form-group">
                    <label for="Categorie">Categorie : </label>
                     <select name="Categorie" id="Categorie">
                        <?php
                            require_once("../Connection.php");
                            $rq="SELECT ID FROM categorie ";
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
                    <label for="Prix">Prix</label>
                    <input type="number" step="0.01" name="Prix" id="Prix" placeholder="Prix" >
                </div>
                <div class="form-group">
                    <label for="PrixAcquisition">PrixAcquisition</label>
                    <input type="number" step="0.01" name="PrixAcquisition" id="PrixAcquisition" placeholder="PrixAcquisition" >
                </div>
                <div class="form-group">
                    <label for="Stock">Stock</label>
                    <input type="number" name="Stock" id="Stock" placeholder="Stock" >
                </div>
                <div class="form-group">
                    <label for="ImageURL">ImageURL</label>
                    <input type="text" name="ImageURL" id="ImageURL" placeholder="ImageURL" >
                </div>
                <div class="buttons">
                    <input type="submit" value="Add" name="Add" class="btn">
                    <input type="submit" value="Delete" name="Delete" class="btn" onclick="alert('Are you sure you want to delete this user?')">
                    <input type="submit" value="Update"  name="Update" class="btn" onclick="alert('Are you sure you want to update this user?')">
                    <input type="submit" value="show" name="show" class="btn">
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
                <th>Reference</th>
                <th>Designation</th>
                <th>Description</th>
                <th>Categorie </th>
                <th>prix</th>
                <th>PrixAcquisition</th>
                <th>Stock</th>
                <th>ImageURL</th>
                </tr>
      </thead>
      <tbody id="user-table-body">
        <!-- User data will be populated here -->
         <?php
         require_once("../Connection.php");
         if($_SERVER['REQUEST_METHOD']==="POST"){
            if(isset($_POST['show'])&& $_POST['show']==='show'){
                $rq="SELECT * FROM produit";
                $rp=mysqli_query($conn,$rq);
                if($rp){
                while($ligne=mysqli_fetch_assoc($rp)){
                echo "<tr>";
                echo "<td>{$ligne['Reference']}</td>";
                echo "<td>{$ligne['Designation']}</td>";
                echo "<td>{$ligne['Description']}</td>";
                echo "<td>{$ligne['Categorie']}</td>";
                echo "<td>{$ligne['prix']}</td>";
                echo "<td>{$ligne['PrixAcquisition']}</td>";
                echo "<td>{$ligne['Stock']}</td>";
                echo "<td>{$ligne['ImageURL']}</td>";
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

</html>

<?php
require_once("../Connection.php");

if ($_SERVER['REQUEST_METHOD'] === "POST") {

    // Sanitize input
    $Ref       = $_POST['Ref'] ?? "none";
    $Designation     = $_POST['Designation'] ?? "none";
    $Description    = $_POST['Description'] ?? "none";
    $Categorie = $_POST['Categorie'] ?? "none";
    $Prix      = $_POST['Prix'] ?? "none";
    $PrixAcquisition  = $_POST['PrixAcquisition'] ?? "none";
    $Stock     = $_POST['Stock'] ?? "none";
    $ImageURL     = $_POST['ImageURL'] ?? "none";

    // Escape strings for safety (minimum protection — use prepared statements ideally)
    $Ref       = intval($Ref); // make sure id is integer
    $Designation     = mysqli_real_escape_string($conn, $Designation);
    $Description    = mysqli_real_escape_string($conn, $Description);
    $Categorie = intval($Categorie);
    $Prix       = intval($Prix); // make sure id is integer
    $PrixAcquisition       = intval($PrixAcquisition); // make sure id is integer
    $Stock       = intval($Stock); // make sure id is integer
    $ImageURL     = mysqli_real_escape_string($conn, $ImageURL);

    // Handle Add
    if (isset($_POST['Add']) && $_POST['Add'] === "Add") {
        $query = "INSERT INTO produit VALUES ($Ref , '$Designation ', '$Description', $Categorie, $Prix, $PrixAcquisition, $Stock, '$ImageURL')";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo "Insert error: " . mysqli_error($conn);
        } else {
            echo "Client added successfully.";
        }
    }

    // Handle Delete
    if (isset($_POST['Delete']) && $_POST['Delete'] === "Delete") {
        $query = "DELETE FROM produit WHERE Reference = $Ref";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo "Delete error: " . mysqli_error($conn);
        } else {
            echo "Client deleted successfully.";
        }
    }
    if (isset($_POST['Update']) && $_POST['Update'] === "Update") {
        $query = "UPDATE produit 
        set Designation='$Designation',Description='$Description',Categorie=$Categorie,prix=$Prix,PrixAcquisition=$PrixAcquisition,Stock=$Stock,ImageURL='$ImageURL'
        WHERE Reference=$Ref ";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo "Update error: " . mysqli_error($conn);
        } else {
            echo "Client Update successfully.";
        }
    
    }

}
?>
