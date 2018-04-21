<?php
require_once("mysqli_connect.php");
//Create Connection
$conn= new mysqli($servername, $username, $password, $dbname);



 if ( isset($_POST['submit']) ) {
    $iden = $_POST["id"];
    $stock = $_POST["stock"];

    /* input data to stock */
    $sql = "UPDATE warehouse SET stock=stock + $stock WHERE id = '$iden' ";
    $result = mysqli_query($conn,$sql);


    if($sql){
      session_start();
      $username=$_SESSION['username'];
      header('location:warehouse.php');
    }else {
      echo "ERROR: " .$sql. "<br>";
    }
}
  mysqli_close($conn);

?>
