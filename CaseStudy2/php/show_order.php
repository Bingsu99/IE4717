<?php
  // Data Checking
  // var_dump($_POST) . "<br/>";

  // echo "justJava" . ": ";
  // echo $_POST["justJava"] . "<br/>";

  // echo "cafeAuLaitOption" . ": ";
  // echo $_POST["cafeAuLaitOption"] . "<br/>";

  // echo "cafeAuLait" . ": ";
  // echo $_POST["cafeAuLait"] . "<br/>";

  // echo "cappucinoOption" . ": ";
  // echo $_POST["cappucinoOption"] . "<br/>";

  // echo "cappucino" . ": ";
  // echo $_POST["cappucino"] . "<br/>";

  // Data Saving
  $justJavaQty = intval($_POST["justJava"]);
  $cafeAuLaitQty = intval($_POST["cafeAuLait"]);
  $cappucinoQty = intval($_POST["cappucino"]);
  $justJavaOpt = "Endless Cup";
  $cafeAuLaitOpt = $_POST["cafeAuLaitOption"];
  $cappucinoOpt = $_POST["cappucinoOption"];

  $orderItems = [];
  if ($justJavaQty!=0){
    array_push($orderItems, ["name" => "Just Java",
                              "quantity" => $justJavaQty,
                              "category" => $justJavaOpt]);
  }
  if ($cafeAuLaitQty!=0){
    array_push($orderItems, ["name" => "Cafe au Lait",
                              "quantity" => $cafeAuLaitQty,
                              "category" => $cafeAuLaitOpt]);
  }
  if ($cappucinoQty!=0){
    array_push($orderItems, ["name" => "Iced Cappucino",
                              "quantity" => $cappucinoQty,
                              "category" => $cappucinoOpt]);
  }
  

  // Connection to DB
  @ $db = new mysqli('localhost', 'root', '', 'javajam');
  if (mysqli_connect_errno()) {
     echo "Error: Could not connect to database.  Please try again later.";
     exit;
  }

  foreach ($orderItems as $value) {
    // Query for ProductID and Price
    $query = "select product_id, price from products where products.product_name = '" . $value["name"] . "' and products.category = '" . $value["category"] . "'";
    echo $query . "<br/>";
    $result = $db->query($query);
    $var1 = $result->fetch_assoc();
    echo "ProductID: " . $var1["product_id"] . "<br/>";
    echo "ProductPrice: " . $var1["price"] . "<br/><br/>";

    // Adding to Order Table
    $totalCost = $var1['price'] * $value['quantity'];
    $query = "insert into orders (product_id, purchasedPrice, quantity, datetime) values ({$var1['product_id']}, {$totalCost}, {$value['quantity']}, NOW())";
    $result = $db->query($query);

    // Checking if order is added into table
    if ($result) {
      echo "Added Order for 1 item <br/><br/>";
    }else {
      echo "An error has occurred.  The item was not added.";
    }
  }


?>