<head>
  <link rel="stylesheet" href="style.css">
  <title>Home</title>
</head>
<?php

/*

EDIT.PHP

Allows user to edit specific entry in database

*/



// creates the edit record form

// since this form is used multiple times in this file, I have made it a function that is easily reusable

function renderForm($ID, $beginning, $dates, $items, $price, $delivery, $retail, $wSale, $ends, $error)

{

?>


<html>

<head>

<title>Edit Record</title>

</head>

<body>

<?php

// if there are any errors, display them

if ($error != '')

{

echo '<div style="padding:4px; border:1px solid red; color:red;">'.$error.'</div>';

}

?>



<form action="" method="post">
<input type="hidden" name="id" value="<?php echo $id; ?>"/>

<table>

<div class="form-style-6"> <h1> Register: </h1>

  <strong><label>ID: *</strong><input type="text" name="beginning" value="<?php echo $employeeID; ?>" /></label>

  <strong><label>Dates *</strong><input type="text" name="dates" value="<?php echo $beginning; ?>" /></label>

  <strong><label>Beginning: *</strong><input type="text" name="beginning" value="<?php echo $dates; ?>" /></label>

  <strong><label>Items: *</strong><input type="text" name="items" value="<?php echo $items; ?>" /></label>

    <strong><label>Price: *</strong><input type="text" name="price" value="<?php echo $price; ?>" /></label>

  <strong><label>Delivery: *</strong><input type="text" name="delivery" value="<?php echo $delivery; ?>" /></label>

  <strong><label>Retail: *</strong><input type="text" name="retail" value="<?php echo $retail; ?>" /></label>

  <strong><label>WholeSale: *</strong><input type="text" name="wSale" value="<?php echo $wSale; ?>" /></label>

  <strong><label>End: *</strong><input type="text" name="ends" value="<?php echo $ends; ?>" /></label>

<p>* required</p>

<p><input type="submit" name="submit" value="Submit">

</br>
</br>

<a href="inventory.php">
   <input type="button" value="Go Back" />
</a>
</table>




</form>

</body>

</html>

<?php

}







// connect to the database

include('mysqli_connect.php');



// check if the form has been submitted. If it has, process the form and save it to the database

if (isset($_POST['submit']))

{

// confirm that the 'id' value is a valid integer before getting the form data

if (is_numeric($_POST['id']))

{

// get form data, making sure it is valid

$id = $_POST['id'];

$employeeID = mysqli_real_escape_string($dbconn,$_POST['employeeID']);

$beginning = mysqli_real_escape_string($dbconn,$_POST['beginning']);

$dates = mysqli_real_escape_string($dbconn,$_POST['dates']);

$items = mysqli_real_escape_string($dbconn,$_POST['items']);

$price = mysqli_real_escape_string($dbconn,$_POST['price']);

$delivery = mysqli_real_escape_string($dbconn,$_POST['delivery']);

$retail = mysqli_real_escape_string($dbconn,$_POST['yearEmployeed']);

$wSale = mysqli_real_escape_string($dbconn,$_POST['wSale']);

$ends = mysqli_real_escape_string($dbconn,$_POST['ends']);

$allowedRemainingLeaves = mysqli_real_escape_string($dbconn,$_POST['allowedRemainingLeaves']);

$username = mysqli_real_escape_string($dbconn,$_POST['username']);

$password = mysqli_real_escape_string($dbconn,$_POST['password']);

$GENDER = mysqli_real_escape_string($dbconn,$_POST['GENDER']);


// check that beginning/dates fields are both filled in

if ($employeeID == '' || $beginning == '' || $dates == '' || $items == '' || $price == '' || $delivery == '' || $retail == '' || $wSale == '' || $ends == '' ||
$allowedRemainingLeaves == '' || $username == '' || $password == '' || $GENDER == '' )

{

// generate error message

$error = 'ERROR: Please fill in all required fields!';



//error, display form

renderForm($employeeID, $beginning, $dates, $items, $price, $delivery, $retail, $wSale, $ends, $allowedRemainingLeaves, $username, $password, $GENDER, $error)

}

else

{

// save the data to the database

mysqli_query($dbconn, "UPDATE emp_details SET employeeID = '$employeeID', beginning='$beginning', dates='$dates', items='$items', price='$price', delivery='$delivery', retail='$retail', wSale='$wSale', ends='$ends', allowedRemainingLeaves='$allowedRemainingLeaves', username='$username', password='$password, GENDER='$gender''WHERE id='$id'")

or die(mysqli_connect_error());



// once saved, redirect back to the view page

header("Location: home.php");

}

}

else

{

// if the 'id' isn't valid, display an error

echo 'Error!';

}

}

else

// if the form hasn't been submitted, get the data from the db and display the form

{



// get the 'id' value from the URL (if it exists), making sure that it is valid (checing that it is numeric/larger than 0)

if (isset($_GET['id']) && is_numeric($_GET['id']) && $_GET['id'] > 0)

{

// query db

$id = $_GET['id'];

$result = mysqli_query($dbconn, "SELECT * FROM emp_details WHERE id=$id")

or die(mysqli_connect_error());

$row = mysqli_fetch_array($result);



// check that the 'id' matches up with a row in the databse

if($row)

{



// get data from db

$employeeID = $row['employeeID'];

$beginning = $row['beginning'];

$dates = $row['dates'];

$items = $row['items'];

$price = $row['price'];

$delivery = $row['delivery'];

$retail = $row['yearEmployeed'];

$wSale = $row['wSale'];

$ends = $row['ends'];

$allowedRemainingLeaves = $row['allowedRemainingLeaves'];

$username = $row['username'];

$password = $row['password'];

$GENDER = $row['GENDER'];





// show form

renderForm($employeeID, $beginning, $dates, $items, $price, $delivery, $retail, $wSale, $ends, $allowedRemainingLeaves, $username, $password, $GENDER, '');

}

else

// if no match, display result

{

echo "No results!";

}

}

else

// if the 'id' in the URL isn't valid, or if there is no 'id' value, display an error

{

echo 'Error!';

}

}

?>

</div>
</body>
</html>
