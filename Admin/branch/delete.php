<?php
include('mysqli_connect.php');

if (isset($_GET['id']) && is_numeric($_GET['id'])){
// get id value
$id = $_GET['id'];
// delete the entry
$result = mysqli_query($dbconn, "DELETE FROM inventorystatus WHERE id=$id")
or die(mysqli_connect_error());

// redirect back to the view page

header("Location: inventory.php");
}else{

// if id isn't set, or isn't valid, redirect back to view page

header("Location: inventory.php");
}
?>
