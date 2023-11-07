<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <title>Document</title>
    <link rel="stylesheet" href="./css/global.css" />
    <link rel="stylesheet" href="./css/menu.css" />
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
                <a href="./index.php">
                    <li>Home</li>
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

    <h2>Menus</h2>
    <p class="menus-description">Our catering services specialize in tailoring diverse menus to perfectly match any occasion and satisfy varied tastes. From corporate events to intimate gatherings, our culinary experts skillfully craft a wide array of delicacies, ensuring a flavorful experience that uniquely complements each special moment.</p>
    <div class="menu-container">
      <?php 
        include "./php/dbconnect.php";
        $query = 'select * from menus';
        $result = $dbcnx->query($query);
        $imageType = 'image/jpeg';
        while($row =$result->fetch_assoc()){
          
          // Finding Cost of Menu
          $menuID = $row["MenuID"];
          $costQuery = "select Sum(Items.ItemPrice) as cost from Menus join Items on Items.MenuID = Menus.MenuID and Menus.MenuID = $menuID";
          $costQueryResult = $dbcnx->query($costQuery)->fetch_assoc();
          $menuCost = $costQueryResult['cost'];

          // Decode Image
          $imageData = base64_encode($row["MenuImage"]);

          // Creating element
          echo "<div class='menuBox'>
                  <img src='data:$imageType;base64,$imageData' class='menuImage'>
                  {$row['MenuName']}
                  <hr/>
                  $$menuCost
                  <p>Description</p>
                  <form
                    name='menuForm'
                    action='./customise.php'
                    method='get'
                    class='orderForm'
                  >
                  <input type='hidden' name='menu' value=$menuID>
                  <input type='submit' class='orderBtn' value='Order Now'>
                  </form>
                </div>";
        }
        $dbcnx->close()
      ?>
    </div>
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