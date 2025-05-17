<?php
function getconnection(){
    $conn=mysqli_connect("localhost","root","root","magasin") or die("Connection failed: " . mysqli_connect_error());
    return $conn;
}
$conn=getconnection();

?>