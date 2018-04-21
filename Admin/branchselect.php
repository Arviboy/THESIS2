<?php
include('mysqli_connect.php');
session_start();

$_SESSION['nameofbranch']=$row['nameofbranch'];
header('location:/thesis/admin/branch/inventory.php');


 ?>
