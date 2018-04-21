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
		header('location:adminLogin.html');
		}
		$username=$_SESSION['username'];
		$firstname=$_SESSION['firstname'];
		$lastname=$_SESSION['lastname'];
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
						<a class="nav-link active" href="/thesis/admin/sales/sales.php">
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
				<h1 class="h2">Sales</h1>
				<div class="btn-toolbar mb-2 mb-md-0">
					<div class="btn-group mr-2">
						<button class="btn btn-sm btn-outline-secondary">Share</button>
						<button class="btn btn-sm btn-outline-secondary">Export</button>
					</div>

<?php
$branch = false;
if ( isset ($_GET['branch'] ) ) {
$branch = $_GET['branch'];
}
?>
	<div class="dropdown">
  <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    <span data-feather="calendar"></span>Sort By
  </button>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
		<?php			echo ' <a class="nav-link" href="/thesis/admin/sales/sortbyyesterday.php?branch=' . $branch . '">Yesday</a>';
							echo ' <a class="nav-link" href="/thesis/admin/sales/sortbytoday.php?branch=' . $branch . '">Today</a>';
    					echo ' <a class="nav-link" href="/thesis/admin/sales/sortbythisweek.php?branch=' . $branch . '">This Week</a>';
    					echo ' <a class="nav-link" href="/thesis/admin/sales/sortbymonth.php?branch=' . $branch . '">This Month</a>';
		?>
  </div>
</div>
				</div>
			</div>


			<form method="get">
				<select name="branch" class="custom-select" onchange="this.form.submit();">
				<option selected="selected">Select Branch</option>
				<?php
				$res=$dbconn->query("SELECT * FROM branches");
				while($row=$res->fetch_array())
				{
				?>
				 <option value="<?php echo $row['nameofbranch']; ?>"><?php echo $row['nameofbranch']; ?></option>
				 <?php
				}

				echo $here;
				?>
				</select>
			</form>



<?php
//Create Connection

if(isset($_GET['branch'])){
  $branch = $_GET['branch']; //some_value
}

$sql = "SELECT c.ricebrandname, b.branchname, b.deliveries, b.sold, b.ending, b.total, b.dateofsale, b.opricetotal FROM dailysales b,riceinfo c WHERE c.id = b.riceid AND b.branchname = '$branch' AND WEEK(b.dateofsale) = WEEK(CURDATE())";

$result = mysqli_query($conn,$sql);


?>


<html>
<head><title>Result</title></head>
<body>
  <h3><?php echo $branch; ?></h3>
  </br>
<?php
echo "<table class='table table-hover table-striped table-sm' table-responsive id='someid'>";
echo "<thead>";
echo "<tr align='center'>
      <th>Rice</th>
      <th>Branch</th>
      <th>Deliveries</th>
      <th>Sold</th>
      <th>End</th>
      <th>Total</th>
      <th>Original Price Total</th>
      <th>Date of sale</th>";
echo "</thead>";
 ?>

    <?php

      if($result) {
        while($row = mysqli_fetch_array($result)) {


          echo '<tr>';
          echo '<td align=center>' . $row['ricebrandname'] . '</td>';
      		echo '<td align=center>' . $row['branchname'] . '</td>';
          echo '<td align=center>' . $row['deliveries'] . '</td>';
      		echo '<td align=center>' . $row['sold'] . '</td>';
      		echo '<td align=center>' . $row['ending'] . '</td>';
      		echo '<td align=center>' . $row['total'] . '</td>';
          echo '<td align=center>' . $row['opricetotal'] . '</td>';
      		echo '<td align=center>' . $row['dateofsale'] . '</td>';

          echo '</tr>';}}
  ?>



  </table>
  </div>
  </main>

  </div>
  </div>
  </div>
  </div>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

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


  	</html>
