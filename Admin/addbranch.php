
<?php
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';
$dbname = 'thesis';
$conn = mysqli_connect($dbhost, $dbuser, $dbpass,$dbname);


 if (isset($_POST['submit'])) {

   $branchname = $_POST['branchname'];

   $sql = "CREATE TABLE $branchname (
   id INT(25) AUTO_INCREMENT PRIMARY KEY,
   sackid INT(11) NOT NULL,
   updatedbeginning INT(25) NOT NULL,
   deliveries INT(25) NOT NULL,
   retail INT(11) NOT NULL,
   wholesale INT(11) NOT NULL,
   sold INT(11) NOT NULL,
   ending INT(25) NOT NULL,
   total INT(11) NOT NULL
   )";

   $sql2 = "INSERT INTO branches (nameofbranch) VALUES ('$branchname')";


   $result = mysqli_query($conn,"SELECT nameofbranch FROM branches WHERE nameofbranch = '$branchname'");
   if (mysqli_num_rows($result)){
       //if branch exists
     echo "Error creating branch: The branch exists! ";

   } else {
      //if not then add new branch
      if (($result3 = mysqli_query($conn,$sql)) === TRUE) {
          echo "Table created successfully";
      } else {
          echo "Error creating table: " . $conn->error;
      }
      $result2 = mysqli_query($conn,$sql2);



   }


   if($sql){
     header('location:/thesis/admin/admindashboard.php');
   }else {
     echo "ERROR: " .$sql. "<br>";
   }
}
 mysqli_close($conn);
?>
