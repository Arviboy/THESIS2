<?php
require_once("mysqli_connect.php");


 if ( isset($_POST['submit']) ) {


    $dates = $_POST["dates"];
   	$title = $_POST["title"];
   	$content = $_POST["content"];


}
  $query = mysqli_query($dbconn, "INSERT into notes
                        (dates, title, content)
        VALUES ('$dates','$title','$content')");

        if($query){
          session_start();
          $username=$_SESSION['username'];
          header('location:/thesis/admin/notes/notes.php');
        }else {
          echo "ERROR: " .$query. "<br>";
        }

 ?>
