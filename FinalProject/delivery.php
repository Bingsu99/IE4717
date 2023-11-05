


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
    <?php
      session_start();
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

      // Initialize an array to store itemID, quantity, name, price
      $itemQuantities = array();

      // Check if there are parameters in the GET request
      if (!empty($_GET)) {
          // Iterate through the GET parameters
          foreach ($_GET as $key => $value) {
            $itemQuantities[] = array(
                                  "itemID" => $key,
                                  "itemName" => $itemPrices[$key]['itemName'],
                                  "quantity" => $value,
                                  "cost" => $itemPrices[$key]['itemPrice'] * $value,
                                );
          };
      }
      $_SESSION['cart'] = $itemQuantities;
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

    <?php
      var_dump($_SESSION['cart'])
    ?>
    
  </body>
</html>

