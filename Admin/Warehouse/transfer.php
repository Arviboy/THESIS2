<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'thesis';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);


 if ( isset($_POST['submit']) ) {

    $iden = $_POST["id"];
    $transfer = $_POST["transfer"];
    $branchname = $_POST["branchname"];

    /* input data to transfer
    $sql = "UPDATE warehousetransfer SET transfer=transfer + $transfer, branchname ='$branchname' WHERE id = '$iden' ";
    $result = mysqli_query($conn,$sql);*/

    /* transfer data to branch magmiminus sya sa stock
    $sql2 = "UPDATE $branchname, warehouse
    SET $branchname.deliveries = $branchname.deliveries + '$transfer',
        warehouse.stock = warehouse.stock - '$transfer'
    WHERE  warehouse.id = sackid AND warehouse.id = '$iden' ";
    $result = mysqli_query($conn,$sql2);*/




/*$sqll="INSERT IGNORE INTO warehousetransfer (transfer,branchname,riceid) VALUES ('$transfer', '$branchname', '$iden') WHERE NOT EXISTS (SELECT transfer FROM warehousetransfer WHERE branchname = '$branchname' AND riceid = '$iden')";

$resulta= mysqli_query($conn,$sqll);

/*$squal="REPLACE INTO warehousetransfer SET transfer = '$transfer', branchname = '$branchname', riceid = '$iden', dateoftransfer = CURDATE())";*/



/*$squeal="UPDATE warehousetransfer (transfer,branchname,riceid)
SET transfer='$transfer'
WHERE EXISTS
(SELECT transfer FROM warehousetransfer WHERE riceid = '$iden' AND branchname = '$branchname')";
$resulta= mysqli_query($conn,$squeal);*/
$updatewarehousestock = "UPDATE warehouse
SET stock = stock - '$transfer'
WHERE id = '$iden' ";



$result = mysqli_query($conn,"SELECT transfer FROM warehousetransfer
  WHERE branchname = '$branchname' AND riceid = '$iden' AND dateoftransfer = CURDATE() AND confirmation = 0");

  $result2 = mysqli_query($conn,"SELECT sackid FROM $branchname
    WHERE sackid = '$iden'");

if (mysqli_num_rows($result)){
//if exists in warehousetransfer
    $updaterow = mysqli_query($conn,"UPDATE warehousetransfer
      SET transfer = transfer + '$transfer'
      WHERE branchname = '$branchname' AND riceid = '$iden' AND dateoftransfer = CURDATE()");
  $doupdate = mysqli_query($conn,$updatewarehousestock);

} else {
  //if does not exist in warehousetransfer

  $insertrow=mysqli_query($conn,"INSERT INTO warehousetransfer (transfer,branchname,riceid,dateoftransfer)
  VALUES ('$transfer', '$branchname', '$iden',CURDATE())");


  $doupdate = mysqli_query($conn,$updatewarehousestock);

}




if($doupdate){
  session_start();
  $username=$_SESSION['username'];
  header('location:warehouse.php');
}else {
  echo "ERROR: " .$doupdate. "<br>";
}
}
mysqli_close($conn);
