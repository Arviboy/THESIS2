<html>
<head><title>Result</title></head>
<?php require_once("mysqli_connect.php"); ?>
<body>
<?php
echo "<table class='table table-hover table-striped table-sm' table-responsive id='someid'>";
echo "<thead>";
echo "<tr align='center'>
      <th>Date</th>
      <th>Beginning</th>
      <th>Items</th>
      <th>Price</th>
      <th>Delivery</th>
      <th>retail</th>
      <th>Whole Sale</th>
      <th>End</th>";
echo "</thead>";
 ?>

    <?php
    $searchvalue= $_POST['friendname'];


      $queryString = "SELECT * from inventorystatus where dates like '%".
      $searchvalue . "%'";

      $response = mysqli_query($dbconn, $queryString);

      if($response) {
        while($row = mysqli_fetch_array($response)) {


          echo '<td align=center>' . $row['dates'] . '</td>';
      		echo '<td align=center>' . $row['beginning'] . '</td>';
          echo '<td align=center>' . $row['items'] . '</td>';
      		echo '<td align=center>' . $row['price'] . '</td>';
      		echo '<td align=center>' . $row['delivery'] . '</td>';
      		echo '<td align=center>' . $row['retail'] . '</td>';
      		echo '<td align=center>' . $row['wSale'] . '</td>';
      		echo '<td align=center>' . $row['ends'] . '</td>';

    }
  } ?>
    </table>
  </body>
  </html>
