<?php
include('mysqli_connect.php'); // file inclusion
if (isset($_POST['submit'])) {
$username=$_POST['username'];
$password = ($_POST['password']);
if(empty($username)){

	header('location:admin/adminLog.html');
}
// Validate the password.
if(empty($password)){
	header('location:adminLogin.html');
}
$result=mysqli_query($dbconn,"select * from admin where username='$username' and password='$password' ")
or die (mysqli_connect_error());
$count=mysqli_num_rows($result);
$row=mysqli_fetch_array($result);

		if ($count > 0){
		session_start();

		$_SESSION['username']=$row['username'];
		$_SESSION['firstname']=$row['firstname'];
		$_SESSION['lastname']=$row['lastname'];

		header('location:adminDashboard.php');
		}else{
		header('location:adminLogin.html');
		}
}
?>
