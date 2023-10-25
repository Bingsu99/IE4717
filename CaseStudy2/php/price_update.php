<?php
  // Data Saving
  $justJavaPrice = isset($_POST["justJava"]) ? floatval($_POST["justJava"]) : null;
  $cafeAuLait1Price = isset($_POST["cafeAuLait1"]) ? floatval($_POST["cafeAuLait1"]) : null;
  $cafeAuLait2Price = isset($_POST["cafeAuLait2"]) ? floatval($_POST["cafeAuLait2"]) : null;
  $cappucino1Price = isset($_POST["cappucino1"]) ? floatval($_POST["cappucino1"]) : null;
  $cappucino2Price = isset($_POST["cappucino2"]) ? floatval($_POST["cappucino2"]) : null;

  // Connection to DB
  @ $db = new mysqli('localhost', 'root', '', 'javajam');
  if (mysqli_connect_errno()) {
     echo "Error: Could not connect to database.  Please try again later.";
     exit;
  }

  // Adding to Order Table
  if (isset($_POST["justJavaCheckBox"])){
    $query = "UPDATE products SET price = {$justJavaPrice} WHERE product_id = 1";
    $result = $db->query($query);
  }
  if (isset($_POST["cafeAuLaitCheckBox"])){
    $query = "UPDATE products SET price = {$cafeAuLait1Price} WHERE product_id = 2";
    $result = $db->query($query);
    $query = "UPDATE products SET price = {$cafeAuLait2Price} WHERE product_id = 4";
    $result = $db->query($query);
  }
  if (isset($_POST["cappucinoCheckBox"])){
    $query = "UPDATE products SET price = {$cappucino1Price} WHERE product_id = 3";
    $result = $db->query($query);
    $query = "UPDATE products SET price = {$cappucino2Price} WHERE product_id = 5";
    $result = $db->query($query);
  }

  $db->close();
  header('Location: ../PriceUpdate.php');
?>