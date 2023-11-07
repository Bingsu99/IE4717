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
          <a href="#">
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
          <a href="https://erikterwan.com/" target="_blank">
            <li>Show me more</li>
          </a>
        </ul>
      </div>
      <!-- logo -->
      <div class="logo">
        <img src="your-logo.png" alt="Logo" />
      </div>

      <!-- login & cart -->
      <div id="rightnav">
        <a href="#"> Login/Register </a>
        <a href="#"> Cart </a>
      </div>
    </nav>
    <h2>Menu</h2>
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
  </body>
</html>

