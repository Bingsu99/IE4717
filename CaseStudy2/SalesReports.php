<!DOCTYPE html>
<html lang="en">

<head>
    <title>JavaJam - Sales Reports</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="./css/global.css" />
    <style>
    .content {
        margin: 2rem;
    }

    table {
        width: 625px;
        margin-bottom: 30px;
    }

    td,
    th {
        color: #000000;
        border-style: none;
        font-size: 16px;
        padding: 10px;
    }

    .table_title {
        font-size: 16px;
        font-weight: 500;
        text-align: center;
    }

    tr:nth-of-type(even) {
        background-color: #f5f4de;
    }

    tr:nth-of-type(odd) {
        background-color: #d1b48e;
    }
    </style>
</head>

<body>
    <div id="wrapper">
        <!-- header logo -->
        <header>
            <img src="./images/javalogo.jpg" alt="JavaJam Coffee House" width="619" height="117" />
        </header>
        <div id="colwrapper">
            <!-- nav col -->
            <div id="leftcolumn">
                <nav>
                    <ul>
                        <li><a href="PriceUpdate.php">Product Price Update</a></li>
                        <li><a href="SalesReports.php">Daily Sales Reports</a></li>
                    </ul>
                </nav>
            </div>

            <!-- right col -->
            <div id="rightcolumn">
                <div class="content">
                    <h2>
                        Click to generate daily sales report:
                    </h2>

                    <?php
                        $salesReport = $bestSeller = $genderErr = $salesReportErr = "";
                        $query = "";
                        if ($_SERVER["REQUEST_METHOD"] == "POST") {
                            if (empty($_POST["salesReport"])) {
                                $salesReportErr = "Filter choice is required";
                            } else {
                                $salesReport = $_POST["salesReport"];
                            }
                        }
                    ?>

                    <!-- form to GET sales report -->
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" id="ReportForm">
                        <input type="radio" name="salesReport" id="product_name"
                            <?php if (isset($salesReport) && $salesReport=="product_name") echo "checked";?>
                            value="product_name">Total dollar and quantity sales by products
                        <br>
                        <input type="radio" name="salesReport" id="category"
                            <?php if (isset($salesReport) && $salesReport=="category") echo "checked";?>
                            value="category">Total dollar and quantity sales by categories
                        <br><br>
                        <label for="bestSeller">Popular option of best selling product:
                            <span id="bestSeller">
                                <?php
                                    getBestSeller()
                                ?>
                            </span>
                        </label>
                        <!-- <br>
                        <input type="submit" value="Generate report"> -->
                    </form><br>

                    <!-- php script for salas report table-->
                    <!-- <h2>Sales Reports</h2> -->
                    <table>
                        <tr>
                            <?php
                            if($salesReport == ""){
                                
                            }else{
                                if ($salesReport=="product_name"){
                                    echo "<th>Product</th>";
                                } else
                                    echo "<th>Categories</th>";
                                echo 
                                "<th>Quantity</th>
                                 <th>Total Amount</th>";
                            }
                            ?>
                        </tr>
                        <?php
                            if ($salesReport=="product_name" || $salesReport=="category")
                                getReport($salesReport)
                        ?>
                    </table>
                </div>
            </div>
        </div>

        <!-- footer -->
        <footer>
            <i> Copyright &copy; 2014 JavaJam Coffee House</i><br /><a
                href="mailto:binghong@lim.com">binghong@lim.com</a><br />
            <a href="mailto:zhixin@chow.com">zhixin@chow.com</a>
        </footer>
    </div>

    <script>
    // Get a reference to the form and the radio buttons
    const form = document.getElementById("ReportForm");
    const radio1 = document.getElementById("product_name");
    const radio2 = document.getElementById("category");

    // Add a click event listener to the radio buttons
    radio1.addEventListener("click", function() {
        form.submit();
    });
    radio2.addEventListener("click", function() {
        form.submit();
    });
    </script>
</body>

</html>

<?php
function getReport($salesReport){
    @ $db = new mysqli('localhost', 'root', '', 'javajam');
    if (mysqli_connect_errno()) {
    echo "Error: Could not connect to database.  Please try again later.";
    exit;
    }
    
    $query = "SELECT *, SUM(`orders`.`quantity`) AS total_quantity, SUM(orders.purchasedPrice) AS total_amount 
            FROM `orders` RIGHT JOIN `products` 
            ON `orders`.`product_id` = `products`.`product_id` 
            WHERE DATE(`datetime`) = CURDATE()
            GROUP BY products.$salesReport
            ORDER BY `total_quantity` DESC;";
    
    $result = $db->query($query);
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            if ($salesReport=="product_name"){
                echo 
                    "<tr>
                    <td>".  $row["product_name"] . "</td>
                    <td>".  $row["total_quantity"] . "</td>
                    <td>$".  $row["total_amount"] . "</td>
                    </tr>";
                } else{
                echo  
                    "<tr>
                    <td>".  $row["category"]. "</td>
                    <td>".  $row["total_quantity"]. "</td>
                    <td>$".  $row["total_amount"]. "</td>
                    </tr>";
                }
                }
            }else {
            echo  "0 results";
    }
    $db->close();
}

function getBestSeller(){
    @ $db = new mysqli('localhost', 'root', '', 'javajam');
      if (mysqli_connect_errno()) {
        echo "Error: Could not connect to database.  Please try again later.";
        exit;
      }

      $query = "SELECT *, SUM(`orders`.`quantity`) AS total_quantity, SUM(orders.purchasedPrice) AS total_amount 
                FROM `orders` RIGHT JOIN `products` 
                ON `orders`.`product_id` = `products`.`product_id` 
                WHERE DATE(`datetime`) = CURDATE()
                GROUP BY products.`product_name`
                ORDER BY `total_quantity` DESC";

      $result = $db->query($query);
      if ($result->num_rows > 0) {
        // output data of first row
        $row = $result->fetch_assoc(); 
        echo 
          $row["product_name"]. ", ".  $row["category"];
      } else {
        echo "0 results";
      }
      $db->close();
}
?>