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
                <h2>Client <i class="fa-solid fa-users"></i> </h2>
                <div class="form-group">
                    <label for="id">ID</label>
                    <input type="text" id="id" name="id"  autofocus>
                </div>
                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" id="name" name="name" >
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" >
                </div>
                <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" id="password" name="password" >
                </div>
                <div class="form-group">
                    <label for="Tel">Tel</label>
                    <input type="tel" id="Tel" name="Tel" >
                </div>
                <div class="form-group">
                    <label for="address">Address</label>
                    <input type="text" id="address" name="address" >
                </div>
                <div class="form-group">
                    <label for="Ville">City</label>
                    <input type="text" id="Ville" name="Ville" >
                </div>
                <div class="form-group">
                    <label for="date">Date Of Sign</label>
                    <input type="date" id="date" name="date" >
                </div>
                <div class="buttons">
                    <input type="submit" value="Add" name="Add" class="btn">
                    <input type="submit" value="Delete" name="Delete" class="btn" >
                    <input type="submit" value="Update" name="Update" class="btn">
                    <input type="submit" value="show" name="show" class="btn">
                    <input type="reset" value="Reset" name="Reset" class="btn">
                </div>
            </form>
        </div>
     </div>
     <div class="result hidden">
        <div class="container">
         <h2>User List</h2>
            <table class="styled-table">
                <thead>
                <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Tel</th>
                <th>City</th>
                <th>Address</th>
                <th>Date Of Sign</th>
                </tr>
      </thead>
      <tbody id="user-table-body">
        <!-- User data will be populated here -->
         <?php
            require_once("../Connection.php");
            if ($_SERVER['REQUEST_METHOD'] === "POST") {
                if(isset($_POST['show'])&& $_POST['show']==='show'){
                    $rq="SELECT * FROM client ";
                    $rp=mysqli_query($conn,$rq);
                    if($rp){
                        while($ligne=mysqli_fetch_assoc($rp)){
                            echo "<tr>";
                            echo "<td>{$ligne['ID']}</td>";
                            echo "<td>{$ligne['Nom']}</td>";
                            echo "<td>{$ligne['Email']}</td>";
                            echo "<td>{$ligne['Motdepass']}</td>";
                            echo "<td>{$ligne['Tel']}</td>";
                            echo "<td>{$ligne['Ville']}</td>";
                            echo "<td>{$ligne['Address']}</td>";
                            echo "<td>{$ligne['Dateinsecription']}</td>";
                            echo "</tr>";

                        }
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
    $id       = $_POST['id'] ?? "none";
    $name     = $_POST['name'] ?? "none";
    $email    = $_POST['email'] ?? "none";
    $password = $_POST['password'] ?? "none";
    $tel      = $_POST['Tel'] ?? "none";
    $address  = $_POST['address'] ?? "none";
    $city     = $_POST['Ville'] ?? "none";
    $date     = $_POST['date'] ?? "none";

    // Escape strings for safety (minimum protection — use prepared statements ideally)
    $id       = intval($id); // make sure id is integer
    $name     = mysqli_real_escape_string($conn, $name);
    $email    = mysqli_real_escape_string($conn, $email);
    $password = mysqli_real_escape_string($conn, $password);
    $tel      = mysqli_real_escape_string($conn, $tel);
    $address  = mysqli_real_escape_string($conn, $address);
    $city     = mysqli_real_escape_string($conn, $city);
    $date     = mysqli_real_escape_string($conn, $date);

    // Handle Add
    if (isset($_POST['Add']) && $_POST['Add'] === "Add") {
        $query = "INSERT INTO client VALUES ($id, '$name', '$email', '$password', '$tel', '$city', '$address', '$date')";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo "Insert error: " . mysqli_error($conn);
        } else {
            echo "Client added successfully.";
        }
    }

    // Handle Delete
    if (isset($_POST['Delete']) && $_POST['Delete'] === "Delete") {
        $query = "DELETE FROM client WHERE id = $id";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo "Delete error: " . mysqli_error($conn);
        } else {
            echo "Client deleted successfully.";
        }
    }
    if (isset($_POST['Update']) && $_POST['Update'] === "Update") {
        $query = "UPDATE client 
        set nom='$name',Email='$email',Motdepass='$password',Tel='$tel',Ville='$city',Address='$address'
        WHERE id=$id ";
        $result = mysqli_query($conn, $query);
        if (!$result) {
            echo "Update error: " . mysqli_error($conn);
        } else {
            echo "Client Update successfully.";
        }
    
    }

}
?>
