<!DOCTYPE html>
<html lang="en">
  <head>
    <title>JavaJam Coffee House</title>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="./css/global.css" />
    <link rel="stylesheet" href="./css/menu.css" />
    <script type="text/javaScript" src="./js/price_update.js"></script>
  </head>
  <body>
    <!-- PHP to get data from database -->
    <?php
      $db = new mysqli('localhost', 'root', '', 'javajam');
      if (mysqli_connect_errno()) {
        echo "Error: Could not connect to database.  Please try again later.";
        exit;
      }

      $sql = "SELECT * FROM products";
      $result = $db->query($sql);
      $prices = [];
      while($row = $result->fetch_assoc()) {
        $prices[$row["product_id"]] = $row["price"];
      }
      $db->close();
    ?>
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
              <li><a href="index.html">Product Price Update</a></li>
            </ul>
          </nav>
        </div>
        <div id="rightcolumn">
          <div class="content">
            <h2 style="margin-left: 20px">Click to update product prices:</h2>
            <div id="section">
              <form
                name="priceUpdate"
                action="./php/price_update.php"
                method="post"
              >
                <table>
                  <tr>
                    <td>
                      <input
                        type="checkbox"
                        name="justJavaCheckBox"
                        id="checkbox1"
                        onclick="toggleInput('justJava')"
                      />
                    </td>
                    <td class="table_title"><b>Just Java</b></td>
                    <td>
                      Regular house blend, decaffinated coffee, or flavour of
                      the day<br /><b>Endless Cup $</b>
                      <input
                        type="number"
                        class="priceinput"
                        name="justJava"
                        id="price1"
                        value="<?php echo $prices[1]?>"
                        step="0.01"
                          min="0"
                        disabled
                      /><label
                        class="validation_message"
                        id="pricevalid1"
                        style="color: red"
                      ></label>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <!--  -->
                      <input
                        type="checkbox"
                        name="cafeAuLaitCheckBox"
                        id="checkbox2"
                        onclick="toggleInput('cafeAuLait')"
                      />
                    </td>
                    <td class="table_title"><b>Cafe au Lait</b></td>
                    <td>
                      House blended coffee infused into a smooth, steamed
                      milk<br />
                      <label for="single"
                        ><b>Single $</b
                        ><input
                          type="number"
                          class="priceinput"
                          id="price2"
                          name="cafeAuLait1"
                          value="<?php echo $prices[2]?>"
                          step="0.01"
                          min="0"
                          disabled /><label
                          class="validation_message"
                          id="pricevalid2"
                          style="color: red"
                        ></label></label
                      ><br />
                      <label for="double"
                        ><b>Double $</b
                        ><input
                          type="number"
                          class="priceinput"
                          id="price3"
                          name="cafeAuLait2"
                          value="<?php echo $prices[4]?>"
                          step="0.01"
                          min="0"
                          disabled /><label
                          class="validation_message"
                          id="pricevalid3"
                          style="color: red"
                        ></label
                      ></label>
                    </td>
                  </tr>
                  <tr>
                    <td>
                      <!--  -->
                      <input
                        type="checkbox"
                        name="cappucinoCheckBox"
                        id="checkbox3"
                        onclick="toggleInput('cappucino')"
                      />
                    </td>
                    <td class="table_title"><b>Iced Cappucino</b></td>
                    <td>
                      Sweetened espresso blended with icy-cold milk and served
                      in a chilled glass<br />
                      <label for="single"
                        ><b>Single $</b
                        ><input
                          type="number"
                          class="priceinput"
                          id="price4"
                          name="cappucino1"
                          value="<?php echo $prices[3]?>"
                          step="0.01"
                          min="0"
                          disabled
                        /><label
                          class="validation_message"
                          id="pricevalid4"
                          style="color: red"
                        ></label> </label
                      ><br />
                      <label for="double"
                        ><b>Double $</b
                        ><input
                          type="number"
                          class="priceinput"
                          id="price5"
                          name="cappucino2"
                          value="<?php echo $prices[5]?>"
                          step="0.01"
                          min="0"
                          disabled /><label
                          class="validation_message"
                          id="pricevalid5"
                          style="color: red"
                        ></label
                      ></label>
                    </td>
                  </tr>
                  <tr>
                    <td>
                    </td>
                    <td></td>
                    <td>
                    <input style="float: right;" id="Submit" type="submit" value="Submit" />
                    </td>
                  </tr>
                  
                </table>
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
