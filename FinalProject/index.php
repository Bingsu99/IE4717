<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <link rel="stylesheet" href="./css/global.css">
    <link rel="stylesheet" href="./css/index.css">
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
            <a href="#"> Login/Register </a>
            <a href="#"> Cart </a>
        </div>
    </nav>

    <!-- banner -->
    <div id="banner">
        <img src="./images/banner.jpg" alt="banner img - let us cater">
    </div>

    <!-- Specialise sesction -->
    <section id="whatWeDo" class="container">
        <div id="whatWeDo_p" class="centerText">
            <div class="centered">
                <h2>What We Specialise</h2>
                <p>
                    Experience the richness of French, the authenticity of Chinese, and the boldness of Korean flavors
                    with
                    our exquisite catering service. We specialize in crafting unforgettable Chinese cuisine experiences
                    for
                    celebrations and corporate events. Your taste buds deserve the best, and we deliver it to your
                    event.
                </p>
            </div>
        </div>
        <div id="whatWeDo_img">
            <img src="./images/WhatWeSpecialise.png" alt="WhatWeSpecialise">
        </div>
    </section>


    <section class="container" id="topPick">
        <h1>Top Picks</h1>
        <div class="itemsFlex">

            <?php 
                include "./php/dbconnect.php";
                $query = 'select * from menus LIMIT 3';
                $result = $dbcnx->query($query);
                $imageType = 'image/jpeg';
                while($row =$result->fetch_assoc()){
                
                    // Finding Cost of Menu
                    $menuID = $row["MenuID"];
                    $costQuery = "select Sum(Items.ItemPrice) as cost from Menus join Items on Items.MenuID = Menus.MenuID and Menus.MenuID = $menuID";
                    $costQueryResult = $dbcnx->query($costQuery)->fetch_assoc();
                    $menuCost = $costQueryResult['cost'];

                    $ItemsQuery = "select * from items join menus on Items.MenuID = Menus.MenuID AND items.MenuID = $menuID";
                    $itemsQueryResult = $dbcnx->query($ItemsQuery);
                    // Creating element
                    echo 
                    "<div class='package'>
                    <h3>{$row['MenuName']}</h3>
                    <div class='divider'></div>";
                    
                    while($menuItems =$itemsQueryResult->fetch_assoc()){
                        echo
                            "<div class='itemsFlex'>
                                <div class='food_items'>{$menuItems['ItemName']}</div>
                                <div class='price'>{$menuItems['ItemPrice']}</div>
                            </div>";
                    }
                        echo
                            "<div class='totalPrice'>
                                <h2>$$menuCost</h2>
                                <p>per pax</p>
                                <form
                                    name='menuForm'
                                    action='./customise.php'
                                    method='get'
                                    class='orderForm'
                                >
                                <input type='hidden' name='menu' value=$menuID>
                                <input type='submit' class='orderBtn' value='Order Now'>
                                </form>
                            </div> 
                        </div>";
                    
                }
                $dbcnx->close()
            ?>


        </div>
        <div class="more">
            <a href="#">See More Packages</a>
        </div>
    </section>

    <section class="container itemsFlex">
        <div class="sideImage">
            <div class="about_img">
                <img src="./images/OurStory_1.png" alt="about_img">
            </div>
            <div class="about_img">
                <img src="./images/OurStory_2.png" alt="about_img">
            </div>
        </div>
        <div class="centerText" id="OurStory">
            <div class="centered">
                <h3>This is</h3>
                <h2>Our Story</h2>
                <div class="divider"></div>
                <p>
                    At Yunnan Catering, we're passionate about bringing the authentic flavors of French, Chinese, and
                    Korean cuisine to your celebrations and corporate events. Founded on a love for food and a
                    dedication to quality, we've been creating unforgettable culinary experiences. Let us be a part of
                    your special moments, turning them into delicious memories.
                </p>
                <div class="more">
                    <a href="#">More About Us</a>
                </div>
            </div>
        </div>
        <div class="sideImage">
            <div class="about_img">
                <img src="./images/OurStory_3.png" alt="about_img">
            </div>
            <div class="about_img">
                <img src="./images/OurStory_4.png" alt="about_img">
            </div>
        </div>

    </section>

    <br>
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