use javajam;

CREATE TABLE javajam.`products` (
  `product_id` INT AUTO_INCREMENT,
  `product_name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `option` enum('Single','Double','Endless Cup') NOT NULL,
  PRIMARY KEY (`product_id`)
);

INSERT INTO javajam.`products` (`product_name`, `description`, `price`, `option`) VALUES
('Just Java', 'Regular house blend, decaffinated coffee, or flavour of the day', 2.00, 'Endless Cup'),
('Cafe au Lait', 'House blended coffee infused into a smooth, steamed milk', 2.00, 'Single'),
('Iced Cappucino', 'Sweetened espresso blended with icy-cold milk and served in a chilled glass', 4.75, 'Single'),
('Cafe au Lait', 'House blended coffee infused into a smooth, steamed milk', 3.00, 'Double'),
('Iced Cappucino', 'Sweetened espresso blended with icy-cold milk and served in a chilled glass', 5.75, 'Double');

CREATE TABLE `orders` (
  `order_id` INT AUTO_INCREMENT,
  `product_id` INT,
  `purchasedPrice` decimal(10,2) NOT NULL,
  `quantity` INT NOT NULL,
  `datetime` DATETIME NOT NULL,
  PRIMARY KEY (`order_id`),
  FOREIGN KEY (product_id) REFERENCES products(product_id)
);