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
echo '<pre>';
print_r($_SESSION);
echo '</pre>';

?>