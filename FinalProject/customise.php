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
    <form name='itemsForm'
          action='./delivery.php'
          method='get'>
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
            <td></td>
            <td><input type="button" value="Back"></td>
            <td><input type="submit" value="Next"></td>
        </tr>
      </table>
    </form>
  </body>
</html>

