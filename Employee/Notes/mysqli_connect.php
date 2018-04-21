<?php
  $servername = "localhost";
  $username = "root";
  $password = "";
  $dbname = "thesis";
  $dbconn = mysqli_connect($servername, $username, $password, $dbname) OR die ("Could not connect to Database" . mysqli_connect_error());
?>
