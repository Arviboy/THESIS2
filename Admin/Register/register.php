<?php
require_once("mysqli_connect.php");


 if ( isset($_POST['submit']) ) {

   	$id= $_POST["ID"];
    $firstname = $_POST["firstname"];
    $lastname = $_POST["lastname"];
   	$username = $_POST["username"];
   	$password = $_POST["password"];
    $gender = $_POST["gender"];
    $age = $_POST["age"];
    $branchassign = $_POST["branchassign"];

}
  $query = mysqli_query($dbconn, "INSERT into employee
                        (ID, firstname, lastname, username, password, gender, age, branchassign)
        VALUES ('$ID','$firstname','$lastname','$username','$password','$gender','$age','$branchassign')");

    if($query){
      session_start();
      $username=$_SESSION['username'];
      header('location:/thesis/admin/adminDashboard.php');
    }else {
      echo "ERROR: " .$query. "<br>";
    }

 ?>
