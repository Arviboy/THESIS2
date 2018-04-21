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
	header('location:/thesis/admin/adminLogin.html');
	}

		$username=$_SESSION['username'];
		$firstname=$_SESSION['firstname'];
		$lastname=$_SESSION['lastname'];
	  $result = mysqli_query($dbconn, "SELECT * FROM dailysales")	or die(mysql_error());
	?>

	<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0" id="navbarshadow">
		<a class="navbar-brand col-sm-3 col-md-2 mr-0" id="sidebarCollapse" href="#">BACLUB</a>
		<input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
		<ul class="navbar-nav px-3">
			<li class="nav-item text-nowrap">
				<a class="nav-link" href="/thesis/admin/adminLogout.php">Sign out</a>
			</li>
		</ul>
	</nav>


	<div class="container-fluid">
		<div class="row">
			<nav class="col-md-2 d-none d-md-block bg-light sidebar">
				<div class="sidebar-sticky">
					<center><p><h5><b>ADMIN</b></h5> <i><?php echo $firstname; ?></i></p></center>
					<ul class="nav flex-column">
				<li class="nav-item">
					<a class="nav-link active" href="/thesis/admin/admindashboard.php">
						<span data-feather="home"></span>
						Dashboard <span class="sr-only">(current)</span>
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/thesis/admin/sales/sales.php">
						<span data-feather="file"></span>
						Sales
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/thesis/admin/warehouse/warehouse.php">
						<span data-feather="shopping-cart"></span>
						Warehouse
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/thesis/admin/lowstock/lowstock.php">
						<span data-feather="shopping-cart"></span>
						Lowstock
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="/thesis/admin/notes/notes.php">
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
					<a class="nav-link" href="#">
						<span data-feather="layers"></span>
						Consolidation
					</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" href="#" data-toggle="modal" data-target="#registeremp">
						<span data-feather="layers"></span>
						Register an Account
					</a>
				</li>
			</ul>

			<h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
				<span>Branches</span>
				<div>
				<span data-feather="plus-circle" data-toggle="modal" data-target="#addbranch"></span>
				</div>
			</h6>

			<ul class="nav flex-column mb-2">
			<?php
			$result=$dbconn->query("SELECT * FROM branches");
			while($row=$result->fetch_array())
			{
				echo '<li class="nav-item">';
				echo ' <a class="nav-link" href="/thesis/admin/branch/inventory.php?nameofbranch=' . $row['nameofbranch'] . '">';
				echo '	 <span data-feather="file-text"></span>';
				echo $row['nameofbranch'];
				echo '	</a>';
				echo '</li>';
			}
			?>
			</ul>
		</div>
	</nav>
			<!-- Page Content Holder -->


					<main role="main" class="col-md-9 ml-sm-auto col-lg-10 pt-3 px-4">
						<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
							<h1 class="h2">Dashboard</h1>

						</div>


<!--CHART ------------------------------------------------------------------>
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
$sql = 'SELECT branchname, total FROM sales ORDER BY CURDATE()';

// set array


// look through query
if($result = mysqli_query($conn, $sql)) {


	 // Push the data into the array
	 while($row = mysqli_fetch_array($result)) {
		 array_push($dataPoints["data"], array(
				 "label" => $row["branchname"],
				 "y" => $row["total"]
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
		text: "SALES"
	},
	axisY: {
		title: "Amount of Sale",
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









<!--CHART END ------------------------------------------------------------------>

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


<!-- MODALS -->

<div class="container">
	<!-- Button to Open the Modal -->
	<!-- <div id="add">
<input type="image" src="/thesis/bootstrap/images/icon2.png" class="img-fluid image" data-toggle="modal" data-target="#registeremp"></a>
	</div> -->



	<!-- The Modal for Register -->
	<div class="modal fade" id="registeremp">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Create a List</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<!-- Modal body -->
				<div class="modal-body">

					<form method="post" action="/thesis/admin/register/register.php" id="registeremp">
						<div class="form-group">
							<h2>Register</h2>

							<div class="form-group row">
								<label for="example-text-input" class="col-2 col-form-label">First Name</label>
								<div class="col-10">
									<input class="form-control" type="text" name="firstname" placeholder="Erica" id="example-text-input">
								</div>
							</div>

							<div class="form-group row">
	 						 <label for="example-text-input" class="col-2 col-form-label">Last Name</label>
	 						 <div class="col-10">
	 							 <input class="form-control" type="text" name="lastname" placeholder="Bernadette" id="example-text-input">
	 						 </div>
	 					 </div>

					 <div class="form-group row">
						 <label for="example-text-input" class="col-2 col-form-label">Username</label>
						 <div class="col-10">
							 <input class="form-control" type="text" name="username" placeholder="ericabernadette" id="example-text-input">
						 </div>
					 </div>

					 <div class="form-group row">
						 <label for="example-text-input" class="col-2 col-form-label">Password</label>
						 <div class="col-10">
							 <input class="form-control" type="password" name="password" placeholder="Password" id="example-text-input">
						 </div>
					 </div>

					 <div class="form-group row">
						 <label for="example-text-input" class="col-2 col-form-label">Age</label>
						 <div class="col-10">
							 <input class="form-control" type="number" name="age" placeholder="23" id="example-text-input">
						 </div>
					 </div>

					 <div class="form-group row">
						 <label for="example-text-input" class="col-2 col-form-label">Gender</label>
						 <div class="col-10">
							 <input class="form-control" type="text" name="gender" placeholder="Female" id="example-text-input">
						 </div>
					 </div>

					 <div class="form-group row">
						 <div class="col-10">
								 <select name="branchassign" class="custom-select">
							<option selected="selected">Branch: </option>
							<?php
							$res=$dbconn->query("SELECT * FROM branches");
							while($row=$res->fetch_array())
							{
							 ?>
									<option value="<?php echo $row['nameofbranch']; ?>"><?php echo $row['nameofbranch']; ?></option>
									<?php
							}
							?>
							</select>
						</div>
					</div>

				<!-- Modal footer -->
				<div class="modal-footer">

					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="submit" name="submit" class="btn btn-primary">Submit</button>

					</form>
				</div>

			</div>
		</div>
	</div>
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

	 <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.1/Chart.min.js"></script>
	 <script>
		 var ctx = document.getElementById("myChart");
		 var myChart = new Chart(ctx, {
			 type: 'line',
			 data: {
				 labels: ["Sunday", "Monday", "Tuesday", "Wednesday", "Thursday", "Friday", "Saturday"],
				 datasets: [{
					 data: [15339, 21345, 18483, 24003, 23489, 24092, 12034],
					 lineTension: 0,
					 backgroundColor: 'transparent',
					 borderColor: '#007bff',
					 borderWidth: 4,
					 pointBackgroundColor: '#007bff'
				 }]
			 },
			 options: {
				 scales: {
					 yAxes: [{
						 ticks: {
							 beginAtZero: false
						 }
					 }]
				 },
				 legend: {
					 display: false,
				 }
			 }
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
