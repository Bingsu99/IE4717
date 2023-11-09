<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Document</title>
    <link rel="stylesheet" href="./css/global.css" />
    <link rel="stylesheet" href="./css/confirm.css" />
</head>

<body>
    <?php
      session_start();

      // Display all session variables
    //   echo '<pre>';
    //   print_r($_SESSION);
    //   echo '</pre>';

        // Initialize an array to store itemID, quantity, name, price
        $DeliveryDetails = array();
            
        // Check if there are parameters in the GET request
        if (!empty($_GET)) {
            $DeliveryDetails = array(
                // "userID" => $_GET['UserID'],
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

    <!-- ==============================  body content  ============================== -->

    <div class="container itemsFlex order">
        <div id="cusOrder">
            <h2 class="center">Your Order</h2>
            <div class='divider' style="border: #232323 1px solid;"></div>
            <?php
                // Access the "cart" array within the larger array
                $cartItems = $_SESSION['cart'];

                // Check if there are items in the cart
                if (!empty($cartItems)) {
                    echo "
                    <table>
                        <tr>
                            <th style='text-align: left;'>Item Name</th>
                            <th style='text-align: left;'>Quantity</th>
                            <th style='text-align: left;'>Cost</th>
                        </tr>";
                    
                    // Iterate through each item in the cart and display its details
                    foreach ($cartItems as $item) {
                        echo "
                        <tr>
                            <td>{$item['itemName']}</td>
                            <td>{$item['quantity']}</td>
                            <td>\${$item['cost']}</td>
                        </tr>";
                    }
                    
                    echo "</table>";
                } else {
                    echo "Your cart is empty.";
                }
            ?>
                <!-- <p class="center"><a href="./customise.php">Edit</a></p> -->
        </div>

        <!-- <div id="img">
            <div id="img1">
                <img src="./assets/temp.jpg" alt="order img" width="200px">
            </div>
            <div id="img2">
                <img src="./assets/temp3.jpg" alt="order img" width="200px">
            </div>
        </div> -->
    </div>

    <div class="container" id="cusInfo">
        <h2 class="center">Your Information</h2>
        <div class="itemsFlex info">
            <div>
                <h3>Personal Information</h3>
                <p>
                    <?php
                    $deliveryDetails = $_SESSION['deliveryDetails'];

                    if (!empty($deliveryDetails)) {
                        echo 
                            "<strong>First Name:</strong> {$deliveryDetails['firstName']} <br>
                            <strong>Last Name:</strong> {$deliveryDetails['lastName']} <br>
                            <strong>Email:</strong> {$deliveryDetails['email']} <br>
                            <strong>Phone:</strong> {$deliveryDetails['Phone']} <br>
                        ";
                    } else {
                        echo "No delivery details available.";
                    }
                    ?>
                </p>
            </div>
            <div>
                <h3>Billing Address</h3>
                <p>
                    <?php
                    $deliveryDetails = $_SESSION['deliveryDetails'];

                    if (!empty($deliveryDetails)) {
                        echo 
                            "<strong>Address:</strong> {$deliveryDetails['Address']} <br>
                            <strong>Unit:</strong> {$deliveryDetails['Unit']} <br>
                            <strong>Postal Code:</strong> {$deliveryDetails['Postal']} <br>
                        ";
                    } else {
                        echo "No delivery details available.";
                    }
                    ?>
                </p>
            </div>
        </div>
        <div class="itemsFlex info">
            <div>
                <h3>Delivery Details</h3>
                <p>
                    <?php
                    $deliveryDetails = $_SESSION['deliveryDetails'];

                    if (!empty($deliveryDetails)) {
                        echo 
                            "<strong>Date:</strong> {$deliveryDetails['date']} <br>
                            <strong>Time:</strong> {$deliveryDetails['time']} <br>
                        ";
                    } else {
                        echo "No delivery details available.";
                    }
                    ?>
                </p>
            </div>
            <div></div>
        </div>
    </div>

    <div class="container itemsFlex totalCost">
        <?php
            $cartItems = $_SESSION['cart'];
            $totalPrice = 0;
            $deliveryFee = 10;
                
            if (!empty($cartItems)) {
                foreach ($cartItems as $item) {
                    $cost = $item['cost'] * $item['quantity'];
                    $totalPrice += $cost;
                }                    
            } else {
                echo "Your cart is empty.";
            }
            $promo = $totalPrice * 0.05;
            $GST = (($totalPrice - $promo) + $deliveryFee) * 0.08;
            $grandTotal = ($totalPrice - $promo) + $GST;
            $_SESSION['totalcost'] = round($grandTotal, 2);
        ?>
        <table id="addFee">
            <tr>
                <td>SubTotal</td>
                <td class="alignRight">
                    <?php echo "$".$totalPrice; ?>
                </td>
            </tr>
            <tr>
                <td>Delivery Fee</td>
                <td  class="alignRight">
                    <?php echo "$".$deliveryFee; ?>
                </td>
            </tr>
            <tr>
                <td>Promo - 5% discount</td>
                <td class="alignRight">
                    <?php echo "$". round($promo,2); ?>
                </td>
            </tr>
        </table>
        <br>
        <table id="grandTotal">
            <tr>
                <td>Grand Total</td>
                <td class="alignRight">
                    <?php echo "$". round($grandTotal,2); ?>
                </td>
            </tr>
            <tr>
                <td>Inclusive GST (8%)</td>
                <td class="alignRight">
                    <?php echo "$". round($GST,2); ?>
                </td>
            </tr>
        </table>
    </div>

    <div class="container alignRight">
        <form action="./php/addOrder.php" method="get">
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