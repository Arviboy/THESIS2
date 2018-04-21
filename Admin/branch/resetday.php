<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'thesis';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);
$branchassign = $_POST["nameofbranch"];



if(isset($_POST['submit']))
{



  $sql3 = "UPDATE $branchassign SET updatedbeginning = ending";
  $sql4 = "UPDATE $branchassign SET updatedbeginning = deliveries";

  $resultsum = mysqli_query($conn,"SELECT SUM(total) AS value_sum, SUM(opricetotal) AS optotal FROM dailysales WHERE branchname = '$branchassign' AND dateofsale = CURDATE()");
  $row = mysqli_fetch_assoc($resultsum);

  $sumtotal = $row['value_sum'];
  $sumtotaloprice = $row['optotal'];

  $sqlinsert="INSERT INTO sales (branchname,total,originalpricetotal,dateofsale) VALUES ('$branchassign','$sumtotal','$sumtotaloprice',CURDATE())";
  $sqlupdate="UPDATE sales SET total = total + '$sumtotal', originalpricetotal = originalpricetotal + '$sumtotaloprice' WHERE branchname = '$branchassign' AND dateofsale = CURDATE()";

  $checksales = mysqli_query($conn,"SELECT * FROM sales WHERE branchname = '$branchassign' AND dateofsale = CURDATE() ");

if(mysqli_num_rows($checksales)){

  $updatesales = mysqli_query($conn,$sqlupdate);

} else {

  $insertsales = mysqli_query($conn,$sqlinsert);

}





$result = mysqli_query($conn,"SELECT * FROM $branchassign WHERE updatedbeginning = 0 AND deliveries > 0");

if (mysqli_num_rows($result)){

  $result4 = mysqli_query($conn,$sql4);

} else {

  $result3 = mysqli_query($conn,$sql3);
}


$result5=mysqli_query($conn, "UPDATE $branchassign SET retail = 0 , wholesale = 0 , ending = 0 , sold = 0, deliveries = 0, total = 0");



}
  mysqli_close($conn);


 ?>
