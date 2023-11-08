<!-- testinggg
order
INSERT INTO `orders`(`UserID`, `delivery_datetime`) VALUES ('0', NOW())

orderitems
INSERT INTO `orderitems` (`OrderID`, `ItemID`, `Quantity`) VALUES ('0', '1', '1'), ('0', '2', '1'), ('0', '3', '1');

user
INSERT INTO `users`(`firstName`, `lastName`, `email`, `password`, `phone`, `address`, `unit`, `postalCode`, `userType`) VALUES ('abc','def','a@a.com','abcde','12345678','poiu','09-09','678876','')

-->

<?php

session_start();

// Display all session variables
// echo '<pre>';
// print_r($_SESSION);
// echo '</pre>';

include "./dbconnect.php";

// Create an SQL query to insert the data
$query = "INSERT INTO `orders`(`UserID`, `delivery_datetime`) VALUES ('0', NOW())";

// Execute the query
if ($dbcnx->query($query) === TRUE) {
    echo "Record inserted successfully.";
} else {
    echo "Orders Error: " . $query . "<br>" . $dbcnx->error;
}

$query = "SELECT OrderID FROM `orders`
          ORDER BY `delivery_datetime` DESC
          LIMIT 1;";
$result = $dbcnx->query($query)->fetch_assoc();

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

?>