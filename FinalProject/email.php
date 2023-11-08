<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <title>Document</title>
    <link rel="stylesheet" href="./css/global.css" />
    <link rel="stylesheet" href="./css/email.css" />
  </head>

  <body>
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
    
    <?php
      session_start();

      if (isset($_SESSION['deliveryDetails'][0]) && isset($_SESSION['cart'])) {
        $details = $_SESSION['deliveryDetails'][0];
        $cartItems = $_SESSION['cart'];


        $itemsOutputString = ''; // Initialize the output string
        foreach ($cartItems as $item) {
            $itemsOutputString .= "- " . $item['quantity'] . ' x ' . $item['itemName'] . "\n";
        }

        $to = "f32ee@localhost";
        $subject = "Your Food Catering Order Details";
        $message = "Dear {$details['firstName']} {$details['lastName']},\n\n".
        "Thank you for choosing our catering services for your event. We're excited to confirm your order and provide you with the necessary details:\n\n".
        "Order Details:\n".
        "- Delivery Time: {$details['date']}\n".
        "- Delivery Time: {$details['time']}\n".
        "- Delivery Address: {$details['Address']}, {$details['Unit']}, {$details['Postal']}\n".
        "- Phone: {$details['Phone']}\n".
        "- Total Cost: {$_SESSION['totalcost']}\n\n".
        
        "List of Items Ordered:\n".
        "{$itemsOutputString}\n".
        
        "We are committed to ensuring your event is a success with our delicious and freshly prepared food. If you have any specific requests or changes to the order, please let us know as soon as possible.\n\n".
        
        "Please note that our team will arrive at the specified delivery time with your order to the provided delivery address. If there are any updates or changes regarding the delivery, we will inform you promptly.\n\n".
        
        "If you have any further inquiries or need assistance, feel free to reach out to our customer service team at +65 9876 5432.\n\n".
        
        "We appreciate your trust in our catering services and look forward to serving you.\n\n".
        
        "Best Regards,\n".
        "Yunan Catering";

        // Additional headers
        $headers = "From: f31ee@localhost\r\n";
        $headers .= "Reply-To: f31ee@localhost\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

        // Attempt to send the email
        if (mail($to, $subject, $message, $headers, "-f31ee@localhost")) {
            echo "<div class='confirmation-content'>
                    <span>WE MUST SAY.</span>
                    <span>YOU'VE A GREAT CHOICE OF TASTE!</span>
                    <img src='./assets/deliverybear.gif' class='delivery-image'>
                    <span>YOUR ORDER WAS COMPLETED SUCESSFULLY</span>
                    <span>A EMAIL RECEIPT INCLUDING THE DETAILS ABOUT YOUR ORDER HAS BEEN SENT TO THE EMAIL PROVIDED</span>
                    <button type='button' style='margin-top: 10px;' class='orderBtn'><a href='index.php' class='no-style'>Continue Browsing</a></button>
                    </div>";
            unset($_SESSION['cart']);
        } else {
            echo "<div class='confirmation-content'>
                    <span>Something went wrong</span>
                    <img src='./assets/deliverybear.gif' class='delivery-image'>
                    <span>PLEASE TRY AGAIN LATER</span>
                    <span>ERR: Failed to sent email</span>
                    <button type='button' style='margin-top: 10px;' class='orderBtn'><a href='index.php' class='no-style'>Continue Browsing</a></button>
                    </div>";
        }
      }else{
        echo "<div class='confirmation-content'>
                    <span>Something went wrong</span>
                    <img src='./assets/deliverybear.gif' class='delivery-image'>
                    <span>PLEASE TRY AGAIN LATER</span>
                    <span>ERR: Cart or Details Empty</span>
                    <button type='button' style='margin-top: 10px;' class='orderBtn'><a href='index.php' class='no-style'>Continue Browsing</a></button>
                    </div>";
      }
      
    ?>

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

