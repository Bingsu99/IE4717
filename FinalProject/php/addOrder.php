<?php

session_start();

// Display all session variables
// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';

include "./dbconnect.php";

// orders DB
$query = "INSERT INTO `orders`(`UserID`, `delivery_datetime`) VALUES ('1', NOW())";
echo $query;

if ($dbcnx->query($query) === TRUE) {
    echo "Record inserted successfully.";
} else {
    echo "Orders Error: " . $query . "<br>" . $dbcnx->error;
}


$query = "SELECT OrderID FROM `orders`
          ORDER BY `delivery_datetime` DESC
          LIMIT 1;";
$result = $dbcnx->query($query)->fetch_assoc();

// orderItems DB
$cartItems = $_SESSION['cart'];
if (!empty($cartItems)) {
    foreach ($cartItems as $item) {
        $qty = $item['quantity'];
        $itemID = $item['itemID'];

        echo $qty . $itemID . $result['OrderID'] . "<br>";

        $query = "INSERT INTO `orderitems` (`OrderID`, `ItemID`, `Quantity`) VALUES ($result[OrderID], $itemID, $qty)";
        echo $query;
        
        if ($dbcnx->query($query) === TRUE) {
            echo "Record inserted successfully.";
        } else {
            echo "Orderitems Error: " . $query . "<br>" . $dbcnx->error;
        }
    }                    
}

$dbcnx->close();

$redirect_url = '../email.php';
header("Location: $redirect_url");

?>