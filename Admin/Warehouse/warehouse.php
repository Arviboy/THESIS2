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
	header('location:/thesis/adminLogin.html');
	}
	$username=$_SESSION['username'];
	$firstname=$_SESSION['firstname'];
	$lastname=$_SESSION['lastname'];
	  $result = mysqli_query($dbconn, "SELECT * FROM warehouse")	or die(mysql_error());
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
					<a class="nav-link" href="/thesis/admin/admindashboard.php">
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
					<a class="nav-link active" href="/thesis/admin/warehouse/warehouse.php">
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
							<h1 class="h2">Warehouse</h1>
							
						</div>
						<div class="btn-group mr-2">
							<button class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#sendstocks" id="reset">Send</button>
							<button class="btn btn-sm btn-outline-secondary" data-toggle="modal" data-target="#addStocks" id="reset">Fill</button>
						</div>


					</br>
				</br>

							<?php

							$sql = 'SELECT c.ricebrandname,b.stock FROM warehouse b,riceinfo c WHERE c.id = b.id';

							if($result = mysqli_query($conn, $sql)) {
								 if(mysqli_num_rows($result) > 0) {
						  	echo "<table class='table table-hover table-striped table-sm' table-responsive id='someid'>";
									  echo "<thead>";

										echo "<tr>";
										echo "<th>Rice Name</th>";
										echo "<th>Stock</th>";
										echo "</tr>";
										echo "</thead>";

										while($row = mysqli_fetch_array($result)){
											 echo "<tr>";
											 echo "<td>" . $row['ricebrandname'] . "</td>";
											 echo "<td>" . $row['stock'] . "</td>";
											 echo "</tr>";
										}
										echo "</table>";
										mysqli_free_result($result);
								 } else {
										echo "No records matching your query were found.";
								 }
							} else {
								 echo "ERROR: Could not able to execute $sql. " . mysqli_error($conn);
							}
							mysqli_close($conn);
						?>

					</main>
				</div>
			</div>
</div>
</div>

<!--MODAAALS ---------------------------------------------------------------------------------------------->



						<!-- For creating rice in warehouse --------------------------------------->
					 	<div class="container">
					 		<!-- Button to Open the Modal -->
					 	<div id="add">
					 <input type="image" src="/thesis/bootstrap/images/icon2.png" class="img-fluid image" data-toggle="modal" data-target="#myModal"></a>
					 	</div>




					 		<!-- The Modal for add -->
					 		<div class="modal fade" id="myModal">
					 			<div class="modal-dialog modal-dialog-centered">
					 				<div class="modal-content">

					 					<!-- Modal Header -->
					 					<div class="modal-header">
					 						<h4 class="modal-title">Create A Rice Name</h4>
					 						<button type="button" class="close" data-dismiss="modal">&times;</button>
					 					</div>

					 					<!-- Modal body -->
					 					<div class="modal-body">

					 						<form method="post" action="addrice.php" id="createList">
					 							<div class="form-group">
					 								<h2>Please Fill up Details</h2>

</br>

					 								<div class="form-group row">
					 									<label for="example-text-input" class="col-2 col-form-label">Rice Brand</label>
					 									<div class="col-10">
					 										<input class="form-control" type="text" name="ricebrandname" Placeholder="Rice" id="example-number-input">
					 									</div>
					 								</div>


					 								<div class="form-group row">
					 									<label for="example-number-input" class="col-2 col-form-label">Original Price</label>
					 									<div class="col-10">
					 										<input class="form-control" type="number" name="originalprice" Placeholder="00" id="example-number-input">
					 									</div>
					 								</div>


					 								<div class="form-group row">
					 									<label for="example-text-input" class="col-2 col-form-label">Selling Price</label>
					 									<div class="col-10">
					 										<input class="form-control" type="text" name="sprice" placeholder="00" id="example-text-input">
					 									</div>
					 								</div>

					 					</div>

					 					<!-- Modal footer -->
					 					<div class="modal-footer">

					 						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					 						<button type="submit" name="submit" class="btn btn-primary" form="createList">Save changes</button>

					 						</form>
					 					</div>

					 				</div>
					 			</div>
					 		</div>
					 	</div>
					 </div>



 <!--For adding stocks in the rice ------------------------------------------------------------------------------------------->
					 <div class="container">
						 <!-- Button to Open the Modal -->
						 <!-- <div>
								 <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#addStocks" id="reset">
							 Fill
								 </button>
						 </div> -->

						 <!-- The Modal for add -->
						 <div class="modal fade" id="addStocks">
							 <div class="modal-dialog modal-dialog-centered">
								 <div class="modal-content">

									 <!-- Modal Header -->
									 <div class="modal-header">
										 <h4 class="modal-title">Adding Rice</h4>
										 <button type="button" class="close" data-dismiss="modal">&times;</button>
									 </div>

									 <!-- Modal body -->
									 <div class="modal-body">

										 <form method="post" action="stock.php" id="addStocks">
											 <div class="form-group">
												 <h2> Details</h2>

									 <div class="form-group row">
										 <label for="example-number-input" class="col-2 col-form-label">Rice Brand</label>
										 <div class="col-10">
												 <select name="id" class="custom-select">
											<option selected="selected">Select what kind of rice: </option>
											<?php
											$res=$dbconn->query("SELECT * FROM riceinfo");
											while($row=$res->fetch_array())
											{
											 ?>
													<option value="<?php echo $row['id']; ?>"><?php echo $row['ricebrandname']; ?></option>
													<?php
											}
											?>
											</select>
										</div>
									</div>

											<div class="form-group row">
												<label for="example-number-input" class="col-2 col-form-label">Quantity</label>
												<div class="col-10">
													<input class="form-control" type="number" name="stock" placeholder="00" id="example-text-input">
												</div>
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

</br>

<!--Add branch modal-------------------------------------------------------------------------------->
<div class="container">
	<!-- Button to Open the Modal -->




	<!-- The Modal for add -->
	<div class="modal fade" id="addbranch">
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">

				<!-- Modal Header -->
				<div class="modal-header">
					<h4 class="modal-title">Create a Branch</h4>
					<button type="button" class="close" data-dismiss="modal">&times;</button>
				</div>

				<!-- Modal body -->
				<div class="modal-body">

					<form method="post" action="/thesis/admin/addbranch.php" id="addbranch">
						<div class="form-group">
							<h2> Details</h2>
						</br>
					 <div class="form-group row">
						 <label for="example-text-input" class="col-2 col-form-label">Branch Name</label>
						 <div class="col-10">
							 <input class="form-control" type="text" name="branchname" placeholder="Branch" id="example-text-input">
						 </div>
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


<!--For sending stocks to another branch ------------------------------------------------------------------------>
	<div class="container">
		<!-- Button to Open the Modal -->
		<!-- <div>
				<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#sendstocks" id="reset">
			Send
				</button>
		</div> -->




		<!-- The Modal for add -->
		<div class="modal fade" id="sendstocks">
			<div class="modal-dialog modal-dialog-centered">
				<div class="modal-content">

					<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title">Send to a Branch</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>

					<!-- Modal body -->
					<div class="modal-body">

						<form method="post" action="transfer.php" id="sendstocks">
							<div class="form-group">
								<h2> Details</h2>

					<div class="form-group row">
						<label for="example-number-input" class="col-2 col-form-label">Rice</label>
						<div class="col-10">
								<select name="id" class="custom-select">
					   <option selected="selected">Kind of Rice </option>
					   <?php
					   $res=$dbconn->query("SELECT * FROM riceinfo");
					   while($row=$res->fetch_array())
					   {
					    ?>
					       <option value="<?php echo $row['id']; ?>"><?php echo $row['ricebrandname']; ?></option>
					       <?php
					   }
					   ?>
					   </select>
					 </div>
				 </div>

				 <div class="form-group row">
					 <label for="example-number-input" class="col-2 col-form-label">Rice Brand</label>
					 <div class="col-10">
							 <select name="branchname" class="custom-select">
						<option selected="selected">Select what kind of rice: </option>
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

						 <div class="form-group row">
							 <label for="example-number-input" class="col-2 col-form-label">Quantity</label>
							 <div class="col-10">
								 <input class="form-control" type="number" name="transfer" placeholder="00" id="example-text-input">
							 </div>
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











<!-- SCRIPTS ------------------------------------------------------------------------------------------->
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
