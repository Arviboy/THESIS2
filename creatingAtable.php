<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "thesis";
$dbconn = mysqli_connect($servername, $username, $password, $dbname) OR die ("Could not connect to Database" . mysqli_connect_error());
$conn = new mysqli($servername, $username, $password, $dbname);

// sql to create table
$sql = "CREATE TABLE $branchname (
   id INT(25) AUTO_INCREMENT PRIMARY KEY,
   sackid INT(11) NOT NULL,
   updatebeginning INT(25) NOT NULL,
   deliveries INT(25) NOT NULL,
   retail INT(11 NOT NULL),
   wholesale INT(11) NOT NULL,
   sold INT(11) NOT NULL,
   ending INT(25) NOT NULL,
   total INT(11) NOT NULL
   )";

if ($conn->query($sql) === TRUE) {
    echo "Table MyGuests created successfully";
} else {
    echo "Error creating table: " . $conn->error;
}

$conn->close();
?>
