<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Document</title>
    <link rel="stylesheet" href="./css/global.css" />
    <link rel="stylesheet" href="./css/delivery.css" />
</head>

<body>
    <?php
      session_start();

      // Display all session variables
    //   echo '<pre>';
    //   print_r($_SESSION);
    //   echo '</pre>';

      include "./php/dbconnect.php";
      $sql = "SELECT ItemID, ItemPrice, ItemName FROM items";
      $result  = $dbcnx->query($sql);
      $itemPrices = array();
      while($row = $result->fetch_assoc()) {
        $itemPrices[$row['ItemID']] = array(
                                        'itemName' => $row['ItemName'],
                                        'itemPrice' => $row['ItemPrice']
                                      );
      }
    ?>

    <nav class="navbar container">
        <!-- hamburger -->
        <div id="menuToggle" class="left-menu">
            <!-- hamburger -->
            <input type="checkbox" />
            <span></span>
            <span></span>
            <span></span>

            <!-- menu inside hamburger -->
            <ul id="menu">
                <a href="./menu.php">
                    <li>Menu</li>
                </a>
                <a href="#">
                    <li>About</li>
                </a>
                <a href="#">
                    <li>Info</li>
                </a>
                <a href="#">
                    <li>Contact</li>
                </a>
                <a href="#" target="_blank">
                    <li>Show me more</li>
                </a>
            </ul>
        </div>
        <!-- logo -->
        <div class="logo">
            <a href="./index.php">
                <img src="images/logo.png" alt="Logo">
            </a>
        </div>

        <!-- login & cart -->
        <div id="rightnav">
            <a href="#"> Login/Register </a>
            <a href="#"> Cart </a>
        </div>
    </nav>

    <div class="content-container" style="margin-top: 4rem;">
        <table class="order-table">
            <tr>
                <td colspan='2'><b>Your Order</b>
                    <hr>
                </td>

            </tr>
            <?php
              // Initialize an array to store itemID, quantity, name, price
              $itemQuantities = array();

              // Check if there are parameters in the GET request
              if (!empty($_GET)) {
                // Iterate through the GET parameters
                $totalPrice = 0;
                foreach ($_GET as $key => $value) {
                  $cost = $itemPrices[$key]['itemPrice'] * $value;
                  $totalPrice += $cost;
                  $itemQuantities[] = array(
                                        "itemID" => $key,
                                        "itemName" => $itemPrices[$key]['itemName'],
                                        "quantity" => $value,
                                        "cost" => $cost,
                                      );
                  echo "<tr>";
                  echo "<td>{$value} x {$itemPrices[$key]['itemName']}</td>";
                  echo "<td class='price'>\${$cost}</td>";
                  echo "</tr>";
                };
                echo "<tr><td colspan='2' style='text-align: center;'><hr>\${$totalPrice}</td></tr>";
                $_SESSION['cart'] = $itemQuantities;
              }          
            ?>

        </table>

        <div class='details'>
            <h2>Delivery Details</h2>
            <!-- <form class="details-form"> -->
            <form name='confirmForm' action='./confirm.php' method='get'>
                <h3>Personal Information</h3>
                <table>
                    <tr>
                        <td><input type="text" name="firstname" placeholder="First Name" required></td>
                        <td><input type="text" name="lastname" placeholder="Last Name" required></td>
                    </tr>
                    <tr>
                        <td colspan='2'><input type="email" name="email" placeholder="Email" class='twoCol' required>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2'><input type="tel" name="phone" pattern="[0-9]{8}" placeholder="Contact Number"
                                class='twoCol' required></td>
                    </tr>
                </table>

                <h3>Delivery Address</h3>
                <table>
                    <tr>
                        <td colspan='2'><input type="text" name="address" placeholder="Address" class='twoCol' required>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="text" name="unit" placeholder="Unit" required></td>
                        <td><input type="text" name="postal" placeholder="Postal Code" required></td>
                    </tr>
                </table>
                <h3>Delivery Option</h3>
                <table>
                    <tr>
                        <td><input type="date" name="date" required></td>
                        <td><input type="time" name="time" required></td>
                    </tr>
                </table>
                <br>
                <input type="submit" value="Next" style='float: right;' class="orderBtn">
            </form>
        </div>
    </div>


</body>

</html>