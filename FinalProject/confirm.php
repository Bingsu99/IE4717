<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Document</title>
    <link rel="stylesheet" href="./css/global.css" />
</head>

<body>
    <?php
      session_start();

      // Display all session variables
      echo '<pre>';
      print_r($_SESSION);
      echo '</pre>';

        // Initialize an array to store itemID, quantity, name, price
        $DeliveryDetails = array();
            
        // Check if there are parameters in the GET request
        if (!empty($_GET)) {
            $DeliveryDetails[] = array(
                "firstName" => $_GET['firstname'],
                "lastName" => $_GET['lastname'],
                "email" => $_GET['email'],
                "Phone" => $_GET['phone'],
                "Address" => $_GET['address'],
                "Unit" => $_GET['unit'],
                "Postal" =>  $_GET['postal'],
                "date" =>  $_GET['date'],
                "time" =>  $_GET['time'],

                );
            $_SESSION['deliveryDetails'] = $DeliveryDetails;
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

    <!-- ==============================  body content  ============================== -->

    <div class="container">
        <div id="cusOrder">
            <h2>Your Order</h2>
            <?php
                // Access the "cart" array within the larger array
                $cartItems = $_SESSION['cart'];

                // Check if there are items in the cart
                if (!empty($cartItems)) {
                    echo "<table>";
                    echo "<tr>";
                    echo "<th>Item Name</th>";
                    echo "<th>Quantity</th>";
                    echo "<th>Cost</th>";
                    echo "</tr>";
                    
                    // Iterate through each item in the cart and display its details
                    foreach ($cartItems as $item) {
                        echo "<tr>";
                        echo "<td>{$item['itemName']}</td>";
                        echo "<td>{$item['quantity']}</td>";
                        echo "<td>\${$item['cost']}</td>";
                        echo "</tr>";
                    }
                    
                    echo "</table>";
                } else {
                    echo "Your cart is empty.";
                }
            ?>

            <div id="img">
                <div id="img1"></div>
                <div id="img2"></div>
            </div>
        </div>
    </div>

    <div class="container">
        <h2>Your Information</h2>
        <table>
            <tr>
                <th>Personal Information</th>
                <th>Billing Address</th>
            </tr>
            <tr>
                <td>Personal Information</td>
                <td>Billing Address</td>
            </tr>
            <tr>
                <td>Personal Information</td>
                <td>Billing Address</td>
            </tr>
            <tr>
                <th>Delivery Option</th>gitnk
                <th></th>
            </tr>
            <tr>
                <td>Personal Information</td>
                <td>Billing Address</td>
            </tr>
            <tr>
                <td>Personal Information</td>
                <td>Billing Address</td>
            </tr>
        </table>



        <!-- php code here -->

        <?php
// Access the "deliveryDetails" array within the larger array
$deliveryDetails = $_SESSION['deliveryDetails'];

// Check if there are delivery details
if (!empty($deliveryDetails)) {
    echo "<h2>Delivery Details:</h2>";
    echo "<table>";
    echo "<tr>";
    echo "<th>First Name</th>";
    echo "<th>Last Name</th>";
    echo "<th>Email</th>";
    echo "<th>Phone</th>";
    echo "<th>Address</th>";
    echo "<th>Unit</th>";
    echo "<th>Postal Code</th>";
    echo "<th>Date</th>";
    echo "<th>Time</th>";
    echo "</tr>";

    // Iterate through the delivery details and display them
    foreach ($deliveryDetails as $details) {
        echo "<tr>";
        echo "<td>{$details['firstName']}</td>";
        echo "<td>{$details['lastName']}</td>";
        echo "<td>{$details['email']}</td>";
        echo "<td>{$details['Phone']}</td>";
        echo "<td>{$details['Address']}</td>";
        echo "<td>{$details['Unit']}</td>";
        echo "<td>{$details['Postal']}</td>";
        echo "<td>{$details['date']}</td>";
        echo "<td>{$details['time']}</td>";
        echo "</tr>";
    }

    echo "</table>";
} else {
    echo "No delivery details available.";
}
?>


    </div>

    <div class="container">
        <div id="addFee"></div>
        <div id="grandTotal"></div>
    </div>

    <div class="container">
        <form action="addOrder.php" method="get">
            <!-- <button type='button' class='orderBtn'><a href='delivery.php' class='no-style'>Back</a></button> -->
            <input type="submit" value="Make Payment" class="orderBtn">
        </form>
    </div>



    <!-- ============================================================ -->

    <footer class="container">
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