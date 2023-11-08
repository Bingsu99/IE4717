<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Document</title>
    <link rel="stylesheet" href="./css/global.css" />
    <link rel="stylesheet" href="./css/delivery.css" />
    <script type="text/javascript" src="./js/deliveryDetails.js"></script>
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
            <?php
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                if(isset($_SESSION['login'])){
                    if ($_SESSION['login'] == True){
                        echo "<a href='./php/logout.php'> Logout </a>";
                    }
                }else{
                    echo "<a href='./login.php'> Login/Register </a>";
                };
            ?>

            <!-- <a href="#"> Cart </a> -->
        </div>
    </nav>

    <div class="content-container container">
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
                $_SESSION['totalcost'] = $totalPrice;
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

                        <td><input type="text" name="firstname" placeholder="First Name"
                                <?php echo isset($_SESSION['login']) ? 'value=\'' . $_SESSION['deliveryDetails']['firstName']. '\'' : "";?>
                                required></td>
                        <td><input type="text" name="lastname" placeholder="Last Name"
                                <?php echo isset($_SESSION['login']) ? 'value=\'' . $_SESSION['deliveryDetails']['lastName']. '\'' : "";?>
                                required></td>
                    </tr>
                    <tr>
                        <td colspan='2'><input type="email" name="email" placeholder="Email" class='twoCol'
                                <?php echo isset($_SESSION['login']) ? 'value=\'' . $_SESSION['deliveryDetails']['email']. '\'' : "";?>
                                required>
                        </td>
                    </tr>
                    <tr>
                        <td colspan='2'><input type="tel" name="phone" pattern="[0-9]{8}" placeholder="Contact Number"
                                class='twoCol'
                                <?php echo isset($_SESSION['login']) ? 'value=\'' . $_SESSION['deliveryDetails']['Phone']. '\'' : "";?>
                                required>
                        </td>
                    </tr>
                </table>

                <h3>Delivery Address</h3>
                <table>
                    <tr>
                        <td colspan='2'><input type="text" name="address" placeholder="Address" class='twoCol'
                                <?php echo isset($_SESSION['login']) ? 'value=\'' . $_SESSION['deliveryDetails']['Address']. '\'' : "";?>
                                required>
                        </td>
                    </tr>
                    <tr>
                        <td><input type="text" name="unit" placeholder="Unit"
                                <?php echo isset($_SESSION['login']) ? 'value=\'' . $_SESSION['deliveryDetails']['Unit']. '\'' : "";?>
                                required>
                        </td>
                        <td><input type="text" name="postal" placeholder="Postal Code"
                                <?php echo isset($_SESSION['login']) ? 'value=\'' . $_SESSION['deliveryDetails']['Postal']. '\'' : "";?>
                                required>
                        </td>
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



    <!-- footer -->
    <footer class="container" style="margin-top: 5rem;">
        <div class="footer-column">
            <h4>Account</h4>
            <ul>
                <li><a href="#"> Manage Account</a></li>
                <li><a href="#">Orders</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h4>Catering</h4>
            <ul>
                <li><a href="#">Menu</a></li>
                <li><a href="#">What's New</a></li>
                <li><a href="#">Service</a></li>
                <li><a href="#">FAQ</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h4>Company</h4>
            <ul>
                <li><a href="#">About</a></li>
                <li><a href="#">Media Post</a></li>
                <li><a href="#">Contact</a></li>
                <li><a href="#">Term & Conditions</a></li>
                <li><a href="#">Privacy Policy</a></li>
                <li><a href="#">Reviews</a></li>
            </ul>
        </div>
        <div class="footer-column">
            <h4>Newsletter</h4>
            <form action="" method="post" style="color: #fffcf8c0; font-size: 12px;">
                <label for="email" style="color: #fffcf8c0;">Email*</label><br>
                <input type="email" name="email" id="email" placeholder="Email">
                <p style="color: #fffcf8c0; margin-top: 0%; margin-bottom: .5rem;">Subscribe for the latest menu
                    launches and updates</p>

                <input type="checkbox" name="consent" id="consent">
                <label for="consent">I consent to recieve marketing communications from Yunnan Catering</label>
                <br><br>

                <input type="submit" value="Submit" class="orderBtn">
            </form>
        </div>
        <div class="footer-column">
            <ul class="itemsFlex logo">
                <li><a href="#"><img src="./images/Facebook.png" alt="Facebook logo" height="40"></a></li>
                <li><a href="#"><img src="./images/Instagram.png" alt="Facebook logo" height="40"></a></li>
                <li><img src="./images/halal logo.png" alt="Facebook logo" height="40"></li>
            </ul>
        </div>

    </footer>
</body>

</html>