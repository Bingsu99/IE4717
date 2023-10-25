<!DOCTYPE html>
<html lang="en">
  <head>
    <title>JavaJam Coffee House</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="./css/global.css" />
    <link rel="stylesheet" href="./css/menu.css" />
    <script type="text/javaScript" src="./js/menu.js"></script>
  </head>
  <body>
    <?php
      $db = new mysqli('localhost', 'root', '', 'javajam');
      if (mysqli_connect_errno()) {
        echo "Error: Could not connect to database.  Please try again later.";
        exit;
      }

      $sql = "SELECT * FROM products";
      $result = $db->query($sql); $prices = []; while($row =
    $result->fetch_assoc()) { $prices[$row["product_id"]] = $row["price"]; }
    $db->close(); ?>
    <div id="wrapper">
      <header>
        <img
          src="./images/javalogo.jpg"
          alt="JavaJam Coffee House"
          width="619"
          height="117"
        />
      </header>
      <div id="colwrapper">
        <div id="leftcolumn">
          <nav>
            <ul>
              <li><a href="index.html">Home</a></li>
              <li><a href="menu.html">Menu</a></li>
              <li><a href="music.html">Music</a></li>
              <li><a href="jobs.html">Jobs</a></li>
            </ul>
          </nav>
        </div>
        <div id="rightcolumn">
          <div class="content">
            <h2 style="margin-left: 20px">Coffee at JavaJam</h2>
            <div id="section">
              <form
                name="orderForm"
                action="./php/show_order.php"
                method="post"
              >
                <table>
                  <tr>
                    <td class="table_title"><b>Just Java</b></td>
                    <td>
                      Regular house blend, decaffinated coffee, or flavour of
                      the day<br /><b>Endless Cup $<span id="justJavaPrice"><?php echo $prices[1]?></span></b>
                    </td>
                    <td>
                      <input
                        type="number"
                        class="coffeeInput"
                        id="justJava"
                        name="justJava"
                        step="1"
                        min="0"
                      />
                    </td>
                    <td id="justJavaDisplay">$0</td>
                  </tr>
                  <tr>
                    <td class="table_title"><b>Cafe au Lait</b></td>
                    <td>
                      House blended coffee infused into a smooth, steamed
                      milk<br />
                      <input
                        type="radio"
                        name="cafeAuLaitOption"
                        id="cafeAuLaitSingle"
                        value="Single"
                        checked
                      />
                      <label for="Single"><b>Single $<span id="cafeAuLait1Price"><?php echo $prices[2]?></span></b></label>
                      <input
                        type="radio"
                        name="cafeAuLaitOption"
                        id="cafeAuLaitDouble"
                        value="Double"
                      />
                      <label for="Double"><b>Double $<span id="cafeAuLait2Price"><?php echo $prices[4]?></span></b></label>
                    </td>
                    <td>
                      <input
                        type="number"
                        class="coffeeInput"
                        id="cafeAuLait"
                        name="cafeAuLait"
                        step="1"
                        min="0"
                      />
                    </td>
                    <td id="cafeAuLaitDisplay">$0</td>
                  </tr>
                  <tr>
                    <td class="table_title"><b>Iced Cappucino</b></td>
                    <td>
                      Sweetened espresso blended with icy-cold milk and served
                      in a chilled glass<br />
                      <input
                        type="radio"
                        name="cappucinoOption"
                        id="cappucinoSingle"
                        value="Single"
                        checked
                      />
                      <label for="Single"><b>Single $<span id="cappucino1Price"><?php echo $prices[3]?></span></b></label>
                      <input
                        type="radio"
                        name="cappucinoOption"
                        id="cappucinoDouble"
                        value="Double"
                      />
                      <label for="Double"><b>Double $<span id="cappucino2Price"><?php echo $prices[5]?></span></b></label>
                    </td>
                    <td>
                      <input
                        type="number"
                        class="coffeeInput"
                        id="cappucino"
                        name="cappucino"
                        step="1"
                        min="0"
                      />
                    </td>
                    <td id="cappucinoDisplay">$0</td>
                  </tr>
                  <tr>
                    <td class="table_title"></td>
                    <td></td>
                    <td>Total:</td>
                    <td id="totalPriceDisplay">$0</td>
                  </tr>
                </table>
                <input id="clear" type="reset" value="Clear" />
                <input id="Submit" type="submit" value="Check Out" />
              </form>
            </div>
          </div>
        </div>
      </div>
      <footer>
        <i> Copyright &copy; 2014 JavaJam Coffee House</i><br /><a
          href="mailto:binghong@lim.com"
          >binghong@lim.com</a
        >
      </footer>
    </div>
  </body>
</html>
