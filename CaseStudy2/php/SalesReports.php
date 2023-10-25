<?php
  // create short variable names
  $SalesReport = $_POST['SalesReport'];
?>

<html>

<head>
    <title>JavaJam - Sales Reports</title>
    <style>
    table,
    th,
    td {
        border: 1px solid black;
    }
    </style>
</head>

<body>
    <h1>Sales Reports</h1>
    <h2>Total dollar and quantity sales by filter</h2>
    <table>
        <tr>
            <?php
            if ($SalesReport=="product_id"){
              echo "<th>Product</th>";
            } else
              echo "<th>Categories</th>";
            
            ?>
            <th>Quantity</th>
            <th>Total Amount</th>
        </tr>
        <?php
      @ $db = new mysqli('localhost', 'root', '', 'javajam');
      if (mysqli_connect_errno()) {
        echo "Error: Could not connect to database.  Please try again later.";
        exit;
      }

      $query = "SELECT *, SUM(`orders`.`quantity`) AS total_quantity, SUM(orders.purchasedPrice) AS total_amount 
                FROM `orders` RIGHT JOIN `products` 
                ON `orders`.`product_id` = `products`.`product_id` 
                WHERE DATE(`datetime`) = CURDATE()
                GROUP BY products.$SalesReport;";


      $result = $db->query($query);
      if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
          if ($SalesReport=="product_id"){
            echo 
            "<tr>
              <td>".  $row["product_name"]. "</td>
              <td>".  $row["category"]. "</td>
              <td>".  $row["total_quantity"]. "</td>
              <td>".  $row["total_amount"]. "</td>
            </tr>";
          } else{
            echo 
            "<tr>
              <td>".  $row["category"]. "</td>
              <td>".  $row["total_quantity"]. "</td>
              <td>".  $row["total_amount"]. "</td>
            </tr>";
          }
        }
      } else {
        echo "0 results";
      }
      $db->close();
      
      ?>
    </table>

    <!-- pops choice -->
    <h2>Popular option of best selling product</h2>
    <table>
        <tr>
            <th>Product</th>
            <th>Categories</th>
            <th>Quantity</th>
            <th>Total Amount</th>
        </tr>
        <tr>
            <?php
      @ $db = new mysqli('localhost', 'root', '', 'javajam');
      if (mysqli_connect_errno()) {
        echo "Error: Could not connect to database.  Please try again later.";
        exit;
      }

      $query = "SELECT *, SUM(`orders`.`quantity`) AS total_quantity, SUM(orders.purchasedPrice) AS total_amount 
                FROM `orders` RIGHT JOIN `products` 
                ON `orders`.`product_id` = `products`.`product_id` 
                WHERE DATE(`datetime`) = CURDATE()
                GROUP BY products.`product_id`
                ORDER BY `total_quantity` DESC";


      $result = $db->query($query);
      if ($result->num_rows > 0) {
        // output data of first row
        $row = $result->fetch_assoc(); 
        echo 
          "<tr>
            <td>".  $row["product_name"]. "</td>
            <td>".  $row["category"]. "</td>
            <td>".  $row["total_quantity"]. "</td>
            <td>".  $row["total_amount"]. "</td>
          </tr>";
      } else {
        echo "0 results";
      }
      $db->close();
      ?>
    </table>


</body>

</html>