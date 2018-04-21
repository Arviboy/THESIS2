<?php
require_once("mysqli_connect.php");


 if ( isset($_POST['submit']) ) {


    $dates = $_POST["dates"];
    $beginning = $_POST["beginning"];
   	$items = $_POST["items"];
   	$price = $_POST["price"];
    $retail = $_POST["retail"];
    $wSale = $_POST["wSale"];
    $ends = $_POST["ends"];

}
  $query = mysqli_query($dbconn, "INSERT into inventorystatus
                        (dates, beginning, items, price, retail, wSale,
                          ends)
        VALUES ('$dates','$beginning','$items','$price','$retail','$wSale','$ends')");

        if($query){
          session_start();
          $username=$_SESSION['username'];
          header('location:inventory.php');
        }else {
          echo "ERROR: " .$query. "<br>";
        }

 ?>
