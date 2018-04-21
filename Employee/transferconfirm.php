<html>
<head>
	<link rel="stylesheet" href="/thesis/bootstrap/css/bootstrap.min.css">
	<link rel="stylesheet" href="/thesis/bootstrap/style.css">
	<link rel="stylesheet" href="/thesis/bootstrap/own.css">
	<link rel="stylesheet" href="/thesis/layout.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>


<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<?php

require 'core.php';
?>
<?php

include('mysqli_connect.php');
$conn= new mysqli($servername, $username, $password, $dbname);
if (!isset($_SESSION['username'])){
header('location:/thesis/employee/employeeLogin.html');
}
//On page 2


$username=$_SESSION['username'];
$firstname=$_SESSION['firstname'];
$lastname=$_SESSION['lastname'];
$branchassign=$_SESSION['branchassign'];
?>


	<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0" id="navbarshadow">
		<a class="navbar-brand col-sm-3 col-md-2 mr-0" id="sidebarCollapse" href="#">BACLUB</a>
		<input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Search">
		<ul class="navbar-nav px-3">
			<li class="nav-item text-nowrap">
				<a class="nav-link" href="/thesis/employee/employeeLogout.php">Sign out</a>
			</li>
		</ul>
	</nav>


			<!-- Page Content Holder -->


			<div class="container-fluid">
				<div class="row">
					<nav class="col-md-2 d-none d-md-block bg-light sidebar">
						<div class="sidebar-sticky">
							<center><p><h5><b>Employee</b></h5> <i><?php echo $firstname; ?></i></p></center>
							<ul class="nav flex-column">
						<li class="nav-item">
							<a class="nav-link" href="/thesis/employee/empdashboard.php">
								<span data-feather="home"></span>
								Dashboard <span class="sr-only">(current)</span>
							</a>
						</li>
						<li class="nav-item">
							<a class="nav-link active" href="/thesis/employee/branch/inventory.php">
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
							<a class="nav-link active" href="/thesis/employee/transferconfirm.php">
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
					<h1 class="h2">Transfer - <i><?php echo $branchassign ?></i></h1>
					
				</div>

<div>

<?php
if ( isset($_POST['submit']) ) {
  $iden =$_POST['id'];
  $transfer = $_POST['transfer'];
  $dottransfer = $_POST['dateoftransfer'];


  echo $iden;
  echo $transfer;

  $insertnewrow="INSERT INTO $branchassign (sackid,deliveries)
  SELECT riceid,transfer FROM warehousetransfer
  WHERE riceid = '$iden' AND branchname = '$branchassign' AND transfer = '$transfer' AND dateoftransfer = '$dottransfer'";

  $updaterowinbranch = "UPDATE $branchassign a, warehousetransfer
  SET a.deliveries = a.deliveries + '$transfer'
  WHERE a.sackid = '$iden' AND warehousetransfer.branchname = '$branchassign' AND warehousetransfer.transfer = '$transfer' AND warehousetransfer.dateoftransfer = '$dottransfer'";

  $updateconfirm = "UPDATE warehousetransfer SET confirmation = 1 WHERE branchname = '$branchassign' AND riceid = '$iden' AND transfer = '$transfer' AND dateoftransfer = '$dottransfer'";

  $result2 = mysqli_query($dbconn,"SELECT sackid FROM $branchassign
    WHERE sackid = '$iden'");


            if (mysqli_num_rows($result2)){
              //if ricedata  exists in branch table
              $doupdateinbranch = mysqli_query($dbconn,$updaterowinbranch);
              $doupdateconfirm = mysqli_query($dbconn,$updateconfirm);

            } else{
              //if ricedata does not exist in branch table
              $doinsertinbranch = mysqli_query($dbconn,$insertnewrow);
              $doupdateconfirm = mysqli_query($dbconn,$updateconfirm);
            }

           }


$sql = "SELECT warehousetransfer.transfer,riceinfo.ricebrandname,warehousetransfer.riceid,warehousetransfer.dateoftransfer FROM warehousetransfer JOIN riceinfo
  WHERE warehousetransfer.branchname = '$branchassign' AND warehousetransfer.confirmation = '0' AND warehousetransfer.riceid = riceinfo.id ";



  if($result = mysqli_query($dbconn, $sql)) {
     if(mysqli_num_rows($result) > 0) {
	echo "<table class='table table-hover table-striped table-sm' table-responsive id='someid'>";
        echo "<tr>";
        echo "<th>Rice Name</th>";
        echo "<th>Number of transfer</th>";
        echo "<th>Date of transfer</th>";
        echo "<th>Confirm</th>";
        echo "</tr>";

        while($row = mysqli_fetch_array($result)){
           echo "<tr>";
           echo "<td>" . $row['ricebrandname'] . "</td>";
           echo "<form method='post'><td><input type='hidden' name='transfer' value=". $row['transfer'] ."/>" . $row['transfer'] . "</td>";
           echo "<td><input type='hidden' name='dateoftransfer' value=". $row['dateoftransfer'] ."/>" . $row['dateoftransfer'] . "</td>";
           echo "<td><button type='submit' class='btn btn-warning' name='submit'><input type='hidden' name='id' value=". $row['riceid'] ."/>YES</button></form></td>";
           echo "</tr>";





        }

  echo "</table>";

        mysqli_free_result($result);
     } else {
        echo "No records matching your query were found.";
     }
  }


  ?>


  </table>
  </div>


  <!---RESET DAY----------------------------------------------------------------------------------->


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
