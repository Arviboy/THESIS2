<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "thesis";
$dbconn = mysqli_connect($servername, $username, $password, $dbname) OR die ("Could not connect to Database" . mysqli_connect_error());

 if(isset($_POST['submit']))
{

  $wholesale = $_POST["wholesale"];
  $sackid = $_POST["id"];
  $retail = $_POST["retail"];
  $sold = $wholesale + $retail;
  $branchname = $_POST["nameofbranch"];


  $sql = "UPDATE $branchname i, riceinfo r
          SET i.retail = i.retail + '$retail',
              i.wholesale = i.wholesale + '$wholesale',
              i.ending =  (i.updatedbeginning + i.deliveries) - '$sold',
              i.sold= i.sold + $sold,
              i.total =  r.sprice * '$sold' + i.total,
              i.updatedbeginning = (i.updatedbeginning + i.deliveries) - '$sold'
          WHERE i.sackid='$sackid' AND i.sackid = r.id";

  $sql3 = "INSERT INTO dailysales (riceid, branchname, deliveries, sold, ending, total, dateofsale)
  SELECT sackid, '$branchname',deliveries,sold, ending, total, CURDATE()
  FROM $branchname WHERE sackid='$sackid' ";


  $result1 = mysqli_query($dbconn,$sql);

  $result = mysqli_query($dbconn,"SELECT * FROM dailysales WHERE branchname = '$branchname' AND riceid = '$sackid' AND dateofsale = CURDATE()");
    if (mysqli_num_rows($result)){

      $updaterow = mysqli_query($dbconn,"UPDATE dailysales a, $branchname b
        SET a.sold = a.sold + b.sold, a.ending = b.ending, a.total = a.total + b.total
        WHERE a.branchname = '$branchname' AND a.riceid = '$sackid' AND a.dateofsale = CURDATE()");

    } else {

      $result3 = mysqli_query($dbconn,$sql3);

    }


    if($sql){

      header('location:/thesis/employee/branch/inventory.php');
    }else {
      echo "ERROR: " .$sql. "<br>";
    }
}
  mysqli_close($conn);
?>
