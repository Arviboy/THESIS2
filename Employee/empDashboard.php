<html>
<head>


		<link rel="stylesheet" href="/thesis/bootstrap/css/bootstrap.min.css">
		<link rel="stylesheet" href="/thesis/bootstrap/style.css">
		<link rel="stylesheet" href="/thesis/bootstrap/own.css">
		<link rel="stylesheet" href="/thesis/layout.css">
		<script src="/thesis/bootstrap/js/bootstrap.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</head>

<body>

	<?php

	require 'core.php';
	?>
	<?php
	include('mysqli_connect.php');
	$conn= new mysqli($servername, $username, $password, $dbname);
	if (!isset($_SESSION['username'])){
	header('location:employeeLogin.html');
	}
	$username=$_SESSION['username'];
	$firstname=$_SESSION['firstname'];
	$lastname=$_SESSION['lastname'];
	$branchassign=$_SESSION['branchassign'];
	$result = mysqli_query($dbconn, "SELECT * FROM warehouse")	or die(mysql_error());
	?>

	<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0" id="navbarshadow">
		<a class="navbar-brand col-sm-3 col-md-2 mr-0" id="sidebarCollapse" href="#">BACLUB</a>
		<input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
		<ul class="navbar-nav px-3">
			<li class="nav-item text-nowrap">
				<a class="nav-link" href="empLogout.php">Sign out</a>
			</li>
		</ul>
	</nav>


	<div class="container-fluid">
		<div class="row">
			<nav class="col-md-2 d-none d-md-block bg-light sidebar">
				<div class="sidebar-sticky">
					<center><p><h5><b>Employee</b></h5> <i><?php echo $firstname; ?></i></p></center>
					<ul class="nav flex-column">
				<li class="nav-item">
					<a class="nav-link active" href="/thesis/employee/employeedashboard.php">
						<span data-feather="home"></span>
						Dashboard <span class="sr-only">(current)</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/thesis/employee/branch/inventory.php">
						<span data-feather="file"></span>
						Inventory
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/thesis/employee/lowstock/lowinstock.php">
						<span data-feather="shopping-cart"></span>
						Lowstock
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/thesis/employee/notes/notes.php">
						<span data-feather="users"></span>
						Notes
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#">
						<span data-feather="bar-chart-2"></span>
						Expenses
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/thesis/employee/transferconfirm.php">
						<span data-feather="bar-chart-2"></span>
						Confirmation Order
					</a>
				</li>
			</ul>
		</div>
	</nav>
			<!-- Page Content Holder -->


					<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
						<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
							<h1 class="h2">Dashboard</h1>

						</div>

						<?php
// 						$sql = 'SELECT nameofbranch FROM branches';
// 						if($result = mysqli_query($conn, $sql)) {
// 							 if(mysqli_num_rows($result) > 0)
// 							 while($row = mysqli_fetch_array($result)){
// $dataPoints = array(array("label"=> $row['nameofbranch'], "y"=> 284935));
// }
// }




$dataPoints["data"] = array();

// run query
$sql = "SELECT m.updatedbeginning, riceinfo.ricebrandname FROM $branchassign m, riceinfo WHERE m.sackid = riceinfo.id";

// set array


// look through query
if($result = mysqli_query($conn, $sql)) {


	 // Push the data into the array
	 while($row = mysqli_fetch_array($result)) {
		 array_push($dataPoints["data"], array(
				 "label" => $row["ricebrandname"],
				 "y" => $row["updatedbeginning"]
				 )
		 );
	 }

  // add each row returned into an array
  // $dataPoints[] = array(array("label"=> $row['nameofbranch'], "y"=> 284935)) ;

// 	$dataPoints = array(
// 	array("label"=> "Education", "y"=> 284935),
// 	array("label"=> "Entertainment", "y"=> 256548),
// 	array("label"=> "Lifestyle", "y"=> 245214),
// 	array("label"=> "Business", "y"=> 233464),
// 	array("label"=> "Music & Audio", "y"=> 200285),
// 	array("label"=> "Personalization", "y"=> 194422),
// 	array("label"=> "Tools", "y"=> 180337),
// 	array("label"=> "Books & Reference", "y"=> 172340),
// 	array("label"=> "Travel & Local", "y"=> 118187),
// 	array("label"=> "Puzzle", "y"=> 107530)
// );

  // OR just echo the data:
}


print_r($dataPoints);

// debug:


?>
<script>
window.onload = function () {

var chart = new CanvasJS.Chart("chartContainer", {
	animationEnabled: true,
	theme: "light2", // "light1", "light2", "dark1", "dark2"
	title: {
		text: "<?php echo $branchassign;?>"
	},
	axisY: {
		title: "Stock",
		includeZero: false
	},
	data: [{
		type: "column",
		dataPoints: <?php echo json_encode($dataPoints["data"], JSON_NUMERIC_CHECK); ?>
	}]
});
chart.render();

}
</script>

<div id="chartContainer" style="height: 370px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>









						<h2>Daily</h2>

						<div class="card-deck mb-3 text-center">



							<?php
							// loop through results of database query, displaying them in the table
							$result = mysqli_query($dbconn, "SELECT * FROM notes")	or die(mysql_error());
							while($row = mysqli_fetch_array( $result )) {

								echo '<div class="card mb-4 box-shadow">  ';
								echo '	<div class="card-header"> ';
								echo '		<h4 class="my-0 font-weight-normal">' . $row['title'] .  '</h4> ';
								echo '	</div> ';
								echo '	<div class="card-body"> ';
								echo '		<ul class="list-unstyled mt-3 mb-4"> ';
								echo '			<li>' . $row['dates'] . ' </li> ';
								echo '			<li>' . $row['content'] . ' </li> ';
								echo '		</ul> ';
								echo '<td align=center><a href="delete.php?id=' . $row['ID'] . '"><button type="button" class="btn btn-danger">Done</button></a></td>';
								echo '	</div> ';
								echo '</div> ';

							echo '<br><br></center>';
							}
							?>


</div>
					</main>


			</div>
	</div>
</div>





<!-- jQuery CDN -->
<!-- jQuery CDN -->
 <script src="https://code.jquery.com/jquery-1.12.0.min.js"></script>
 <!-- Bootstrap Js CDN -->
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

 <script type="text/javascript">
     $(document).ready(function () {
         $('#sidebarCollapse').on('click', function () {
             $('#sidebar').toggleClass('active');
         });
     });
 </script>



	 <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
	 <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>
	 <script src="../../../../assets/js/vendor/popper.min.js"></script>
	 <script src="../../../../dist/js/bootstrap.min.js"></script>

	 <!-- Icons -->
	 <script src="https://unpkg.com/feather-icons/dist/feather.min.js"></script>
	 <script>
		 feather.replace()
		 </script>




  </body>


	</html>
