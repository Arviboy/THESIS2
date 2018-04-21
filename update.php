<?php
require_once("mysqli_connect.php");
session_start();

if(isset($_POST['submit'])){
	$id = $_GET['ID'];
	$dates = $_POST["dates"];
	$beginning = $_POST["beginning"];
	$items = $_POST["items"];
	$price = $_POST["price"];
	$retail = $_POST["retail"];
	$wSale = $_POST["wSale"];
	$ends = $_POST["ends"];

	$result = mysqli_query($dbconn, "SELECT * FROM inventorystatus WHERE ID = $id LIMIT 1")	or die(mysql_error());
	while ($row = mysqli_fetch_array($result)){

		$id = $row["id"];
		$dates = $row["dates"];
		$beginning = $row["beginning"];
		$items = $row["items"];
		$price = $row["price"];
		$retail = $row["retail"];
		$wSale = $row["wSale"];
		$ends = $row["ends"];
	}

$stmt = mysqli_query($dbconn, "UPDATE inventorystatus SET
										id = '$id',
										dates = '$dates',
										beginning = '$beginning',
										items = '$items',
										price = '$price',
										retail = '$retail',
										wSale = '$wSale',
										ends = '$ends'
										WHERE id = $id LIMIT 1");

	if($stmt) {
		$username=$_SESSION['username'];
		header('location:inventory.php');
	}
	else {
		echo 'kutch';
		echo mysqli_error($dbconn);
	}
}
?>
