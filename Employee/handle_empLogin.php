
<?php
include('mysqli_connect.php'); // file inclusion
if (isset($_POST['submit'])) {
$username=$_POST['username'];
$password = ($_POST['password']);
if(empty($username)){

	header('location:login.php');
}
// Validate the password.
if(empty($password)){
	header('location:login.php');
}
$result=mysqli_query($dbconn,"SELECT * FROM employee WHERE username='$username' AND password='$password'")
or die (mysqli_connect_error());
$count=mysqli_num_rows($result);
$row=mysqli_fetch_array($result);

		if ($count > 0){
		session_start();

		$_SESSION['username']=$row['username'];
		$_SESSION['firstname']=$row['firstname'];
		$_SESSION['lastname']=$row['lastname'];
		$_SESSION['branchassign']=$row['branchassign'];
		header('location:/thesis/employee/empDashboard.php');
		}else{
		header('location:/thesis/employee/empDashboard.php');
		}
}
?>
