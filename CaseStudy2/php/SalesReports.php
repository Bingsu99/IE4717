<?php
  // create short variable names
  $report = $_GET['report'];
?>

<html>

<head>
    <title>JavaJam - Sales Reports</title>
</head>

<body>
    <h1>Sales Reports</h1>
    <h2>Total dollar and quantity sales</h2>

    <!--  -->
    <?php
      // echo "selected: ". $report;
      @ $db = new mysqli('localhost', 'root', '', 'javajam');
      if (mysqli_connect_errno()) {
        echo "Error: Could not connect to database.  Please try again later.";
        exit;
      }
      // echo "<br> Connected successfully";
      
      $query = "select * from sales";
      $result = $db->query($query);
      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          echo "id: " . $row["sale_id"]. " - prodectID: " . $row["product_id"]. " - date " . $row["sale_date"]. 
          " - qty " . $row["quantity_sold"] . " - amt " . $row["total_amount"] . "<br>";
        }
      } else {
        echo "0 results";
      }
      $db->close();

    ?>
</body>

</html>