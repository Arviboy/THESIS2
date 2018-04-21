<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "thesis";
$dbconn = mysqli_connect($servername, $username, $password, $dbname) OR die ("Could not connect to Database" . mysqli_connect_error());

$conn= new mysqli($servername, $username, $password, $dbname);
  session_start();
  $branchassign=$_SESSION['branchassign'];

 if(isset($_POST['submit']))
{

  $wholesale = $_POST["wholesale"];
  $sackid = $_POST["id"];
  $retail = $_POST["retail"];
  $sold = $wholesale + $retail;


  $sql = "UPDATE $branchassign i, riceinfo r
          SET i.retail = i.retail + '$retail',
              i.wholesale = i.wholesale + '$wholesale',
              i.ending =  (i.updatedbeginning + i.deliveries) - '$sold',
              i.sold= i.sold + $sold,
              i.total =  r.sprice * '$sold' + i.total,
              i.updatedbeginning = (i.updatedbeginning + i.deliveries) - '$sold'
          WHERE i.sackid='$sackid' AND i.sackid = r.id";

  $sql2 = "UPDATE $branchassign i, riceinfo r
          SET i.retail = i.retail + '$retail',
              i.wholesale = i.wholesale + '$wholesale',
              i.ending =  i.updatedbeginning - '$sold',
              i.sold= i.sold + $sold,
              i.total =  r.sprice * '$sold' + i.total,
              i.updatedbeginning = i.updatedbeginning - '$sold'
          WHERE i.sackid='$sackid' AND i.sackid = r.id";


  $sql3 = "INSERT INTO dailysales (riceid, branchname, deliveries, sold, ending, total, dateofsale)
  SELECT sackid, '$branchassign',deliveries,sold, ending, total, CURDATE()
  FROM $branchassign WHERE sackid='$sackid' ";

  $checkiftherearesold = mysqli_query($dbconn,"SELECT * FROM $branchassign WHERE sackid = '$sackid' AND retail = 0 AND wholesale = 0");
  if(mysqli_num_rows($checkiftherearesold)){

    $result1 = mysqli_query($dbconn,$sql);

  } else {
    $result1 = mysqli_query($dbconn,$sql2);
  }


  $result = mysqli_query($dbconn,"SELECT * FROM dailysales WHERE branchname = '$branchassign' AND riceid = '$sackid' AND dateofsale = CURDATE()");
    if (mysqli_num_rows($result)){

      $updaterow = mysqli_query($dbconn,"UPDATE dailysales a, $branchassign b
        SET a.sold = a.sold + $sold, a.ending = b.ending, a.total = b.total, a.opricetotal = $sold * a.oprice + a.opricetotal
        WHERE a.branchname = '$branchassign' AND a.riceid = '$sackid' AND a.dateofsale = CURDATE()");


    } else {

      $result3 = mysqli_query($dbconn,$sql3);
      $resultupdateopricetotal = mysqli_query($dbconn,"UPDATE dailysales d, riceinfo r SET d.oprice = r.originalprice, d.opricetotal = d.sold * r.originalprice WHERE d.branchname = '$branchassign' AND d.riceid = '$sackid' AND d.dateofsale = CURDATE() AND d.riceid = r.id ");

    }

    if($sql){

      header('location:/thesis/employee/branch/inventory.php');
    }else {
      echo "ERROR: " .$sql. "<br>";
    }
}
  mysqli_close($conn);
?>
