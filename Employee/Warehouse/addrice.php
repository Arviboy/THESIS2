<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'thesis';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);


 if ( isset($_POST['submit']) ) {
   $ricebrandname = $_POST["ricebrandname"];
   $originalprice = $_POST["originalprice"];
   $sprice = $_POST["sprice"];

    /* input data */
    $sql = "INSERT INTO riceinfo (ricebrandname, originalprice, sprice) VALUES ('$ricebrandname','$originalprice','$sprice')";
    $result = mysqli_query($conn,$sql);


    /* transfer data to branch magmiminus sya sa stock
    $sql2 = "SELECT
    FROM Projects P INNER JOIN Countries C
    ON P.id_Country = C.id_Country";
    $result = mysqli_query($conn,$sql2);*/

    /* add id to other tables */
    mysqli_begin_transaction($conn, MYSQLI_TRANS_START_READ_WRITE);

    mysqli_query($conn, "INSERT INTO warehouse (riceid) SELECT id FROM riceinfo WHERE ricebrandname = '$ricebrandname'");
    mysqli_commit($conn);

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
