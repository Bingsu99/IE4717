<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Document</title>
    <link rel="stylesheet" href="./css/global.css" />
    <link rel="stylesheet" href="./css/customise.css" />
    <script type="text/javaScript" src="./js/customise.js"></script>
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

    <form name='itemsForm' action='./delivery.php' method='get'>
        <table class="items-table" id="itemsContainer">
            <tr>
                <td><b>Item & Description</b></td>
                <td><b>Quantity</b></td>
                <td><b>Price</b></td>
            </tr>
            <?php
          if(isset($_GET['menu'])){
            $menuID = $_GET['menu'];
            include "./php/dbconnect.php";
            $menuQuery = "select * from Items where Items.MenuID = $menuID";
            $menuQueryResult = $dbcnx->query($menuQuery);
            $imageType = 'image/jpeg';
            while($itemData = $menuQueryResult->fetch_assoc()) {
              // Decode Image
              $imageData = base64_encode($itemData["ItemImage"]);
              
              // Create Table Row
              echo "<tr class='item'>
                        <td class='itemDescCol'>
                        <span class='itemID' hidden>{$itemData['ItemID']}</span>
                          <img src='data:$imageType;base64,$imageData' class='itemImage'>
                          <div class='itemDesc'>
                            <h3>{$itemData['ItemName']}</h3>
                            <p>{$itemData['ItemDescription']}</p>
                          </div>
                        </td>
                        <td><span class='unitPrice' hidden>{$itemData['ItemPrice']}</span><input type='number' class='itemQuantity' name='{$itemData['ItemID']}' min='1' value=1></td>
                        <td class='itemPrice'>{$itemData['ItemPrice']}</td>
                        
                    </tr>";
            }
            
          }else{
            echo "No Menu Selected";
          }
        ?>
            <tr>
                <td></td>
                <td>Total Price:</td>
                <td><b>$<span id="totalPrice">0</span></b></td>
            </tr>
            <tr>
                <td colspan="3" style="text-align: right;">
                    <button type='button' class='orderBtn'><a href='menu.php' class='no-style'>Back</a></button>
                    <input type="submit" value="Next" class="orderBtn">
                </td>
            </tr>
        </table>
    </form>


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