DROP DATABASE IF EXISTS yunan;
create database yunan;
use yunan;

-- Create Users table
CREATE TABLE Users (
    UserID INT AUTO_INCREMENT PRIMARY KEY ,
    firstName VARCHAR(50),
    lastName VARCHAR(50),
    email VARCHAR(100),
    password VARCHAR(100),
    phone VARCHAR(20),
    address VARCHAR(100),
    unit VARCHAR(20),
    postalCode VARCHAR(15),
    userType ENUM('Guest', 'Member')
);

-- Create Menus table
CREATE TABLE Menus (
    MenuID INT AUTO_INCREMENT PRIMARY KEY,
    MenuName VARCHAR(50),
    MenuDescription TEXT,
    MenuImage LONGBLOB
);

-- Create Orders table
CREATE TABLE Orders (
    OrderID INT AUTO_INCREMENT PRIMARY KEY,
    UserID INT,
    delivery_datetime DATETIME,
    FOREIGN KEY (UserID) REFERENCES Users(UserID)
);

-- Create Items table
CREATE TABLE Items (
    ItemID INT AUTO_INCREMENT PRIMARY KEY,
    MenuID INT,
    ItemName VARCHAR(50),
    ItemDescription TEXT,
    ItemPrice DECIMAL(10, 2),
    ItemImage LONGBLOB,
    FOREIGN KEY (MenuID) REFERENCES Menus(MenuID)
);


-- Create OrderItems table
CREATE TABLE OrderItems (
    OrderID INT,
    ItemID INT,
    Quantity INT,
    PRIMARY KEY (OrderID, ItemID),
    FOREIGN KEY (OrderID) REFERENCES Orders(OrderID),
    FOREIGN KEY (ItemID) REFERENCES Items(ItemID)
);

-- Adding Fake Users
INSERT INTO Users (UserID, firstName, lastName, email, password, phone, address, unit, postalCode, userType)
VALUES
(1, 'John', 'Doe', 'abc@abc.com', '123', '1234567890', '123 Main St', 'Apt 101', '12345', 'Member'),
(2, 'Jane', 'Smith', 'def@def.com', '456', '9876543210', '456 Elm St', 'Apt 202', '56789', 'Member'),
(3, 'Alice', 'Johnson', 'ghi@ghi.com', '789', '5551112222', '789 Oak St', 'Apt 303', '98765', 'Member');


-- Set the base path as a variable
SET @basePath = 'C:/xampp/htdocs/IE4717/IE4717/FinalProject/sql/assets/';

-- Use the variable to load a file
SET @asianDelightsMenu = LOAD_FILE(CONCAT(@basePath, 'AsianDelights/AsianDelightMenu.png'));
SET @asianDish1 = LOAD_FILE(CONCAT(@basePath, 'AsianDelights/BroccoliMushroomsScallops.png'));
SET @asianDish2 = LOAD_FILE(CONCAT(@basePath, 'AsianDelights/CurryChicken.png'));
SET @asianDish3 = LOAD_FILE(CONCAT(@basePath, 'AsianDelights/FriedRice.png'));
SET @asianDish4 = LOAD_FILE(CONCAT(@basePath, 'AsianDelights/GreenCurryChicken.png'));
SET @asianDish5 = LOAD_FILE(CONCAT(@basePath, 'AsianDelights/NonyaKueh.png'));

SET @christmasMenu = LOAD_FILE(CONCAT(@basePath, 'Christmas/ChristmasMenu.png'));
SET @christmasDish1 = LOAD_FILE(CONCAT(@basePath, 'Christmas/CherryBourbonGlazedHam.png'));
SET @christmasDish2 = LOAD_FILE(CONCAT(@basePath, 'Christmas/GrilledSausagesPeppersPotatoes.png'));
SET @christmasDish3 = LOAD_FILE(CONCAT(@basePath, 'Christmas/Ratatouille.png'));
SET @christmasDish4 = LOAD_FILE(CONCAT(@basePath, 'Christmas/RoastedFennel.png'));
SET @christmasDish5 = LOAD_FILE(CONCAT(@basePath, 'Christmas/Fideua.png'));

SET @frenchMenu = LOAD_FILE(CONCAT(@basePath, 'French/FrenchMenu.png'));
SET @frenchDish1 = LOAD_FILE(CONCAT(@basePath, 'French/Brownies.png'));
SET @frenchDish2 = LOAD_FILE(CONCAT(@basePath, 'French/EggSalad.png'));
SET @frenchDish3 = LOAD_FILE(CONCAT(@basePath, 'French/Minestrone.png'));
SET @frenchDish4 = LOAD_FILE(CONCAT(@basePath, 'French/AglioOlio.png'));
SET @frenchDish5 = LOAD_FILE(CONCAT(@basePath, 'French/RoastedChicken.png'));

SET @springMenu = LOAD_FILE(CONCAT(@basePath, 'Spring/SpringMenu.png'));
SET @springDish1 = LOAD_FILE(CONCAT(@basePath, 'Spring/BraisedChicken.png'));
SET @springDish2 = LOAD_FILE(CONCAT(@basePath, 'Spring/FriedBeehoon.png'));
SET @springDish3 = LOAD_FILE(CONCAT(@basePath, 'Spring/HerbalChicken.png'));
SET @springDish4 = LOAD_FILE(CONCAT(@basePath, 'Spring/MincedMeatTofu.png'));
SET @springDish5 = LOAD_FILE(CONCAT(@basePath, 'Spring/StartersPlatter.png'));

SET @vegetarianMenu = LOAD_FILE(CONCAT(@basePath, 'Vegetarian/VegetarianMenu.png'));
SET @vegetarianDish1 = LOAD_FILE(CONCAT(@basePath, 'Vegetarian/AbaloneMushroomBrocoli.png'));
SET @vegetarianDish2 = LOAD_FILE(CONCAT(@basePath, 'Vegetarian/CurryPotatos.png'));
SET @vegetarianDish3 = LOAD_FILE(CONCAT(@basePath, 'Vegetarian/MockCerealChicken.png'));
SET @vegetarianDish4 = LOAD_FILE(CONCAT(@basePath, 'Vegetarian/Samosa.png'));
SET @vegetarianDish5 = LOAD_FILE(CONCAT(@basePath, 'Vegetarian/VegetarianFriedRice.png'));

-- Inserting fake data into Menus table
INSERT INTO Menus (MenuID, MenuName, MenuDescription, MenuImage)
VALUES
(1, 'Asian', "Embark on a culinary adventure with our tantalizing Asian catering menu, featuring a symphony of flavors and aromas that will transport you to the heart of Asia.", @asianDelightsMenu),
(2, 'Christmas', "Indulge in our delectable Christmas catering menu, featuring festive classics and culinary creations that will tantalize your taste buds and impress your guests.", @christmasMenu),
(3, 'Spring', "Traditional and seasonal dishes, all prepared with fresh ingredients. From savory appetizers to mouthwatering entrees, we have something to tantalize everyone's taste buds.", @springMenu),
(4, 'French', 'Indulge in the exquisite flavors of French cuisine with our delectable catering menu.', @frenchMenu),
(5, 'Vegetarian', 'Indulge in a symphony of textures and tastes as we tantalize your palate with our array of meatless creations.', @vegetarianMenu);

-- Inserting fake data into Items table
INSERT INTO Items (ItemID, MenuID, ItemName, ItemDescription, ItemPrice, ItemImage)
VALUES
(1, 1, 'Broccoli with Mushroom and Scallops', 'A stir-fry of broccoli, mushrooms, and tender scallops in a savory sauce', 40, @asianDish1),
(2, 1, 'Curry Chicken', 'A fragrant and flavorful curry with tender chicken, vegetables, and a rich coconut milk base', 35, @asianDish2),
(3, 1, 'Fried Rice', 'A classic dish of stir-fried rice with eggs, vegetables, and chicken', 25, @asianDish3),
(4, 1, 'Green Curry Chicken', 'A spicy and aromatic curry with tender chicken, vegetables, and a creamy green curry sauce', 40, @asianDish4),
(5, 1, 'Nonya Kueh', 'Traditional Nonya Kueh with a variety of sweet and savory fillings', 15, @asianDish5),

(6, 2, 'Cherry Bourbon Glazed Ham', 'A succulent ham glazed with a sweet and tangy sauce of cherries and bourbon', 55, @christmasDish1),
(7, 2, 'Grilled Sausages with Peppers and Potatoes', 'A hearty medley of grilled sausages, colorful peppers, and roasted potatoes', 35, @christmasDish2),
(8, 2, 'Ratatouille', 'A vibrant Provençal vegetable stew with zucchini, eggplant, tomatoes, and bell peppers', 30, @christmasDish3),
(9, 2, 'Roasted Fennel With Delicata Squash & Apples', 'A caramelized and aromatic side dish of roasted fennel with herbs and spices', 20, @christmasDish4),
(10, 2, 'Squid and Shrimp Fideua', 'A Spanish pasta dish with a rich and flavorful seafood and vegetable broth', 45, @christmasDish5),

(11, 3, 'Braised Chicken', 'A savory and flavorful dish made with chicken, carrots, mushrooms, and soy sauce', 25, @springDish1),
(12, 3, 'Fried Beehoon', 'A light and fluffy noodle dish stir-fried with vegetables and a savory sauce', 15, @springDish2),
(13, 3, 'Herbal Chicken', 'A healthy and flavorful dish made with chicken, vegetables, and Chinese herbs', 20, @springDish3),
(14, 3, 'Minced Meat Tofu', 'A hearty and satisfying dish made with minced pork, tofu, vegetables, and a savory sauce', 18, @springDish4),
(15, 3, 'Starters Platter', 'A selection of our most popular starters, perfect for sharing', 20, @springDish5),

(16, 4, 'Brownies', 'Indulge in the rich, fudgy goodness of our decadent brownies', 15, @frenchDish1),
(17, 4, 'Egg Salad', 'Experience the simple yet satisfying flavors of our classic egg salad, crafted with fresh eggs, creamy mayonnaise, and a touch of mustard for a delightful bite', 10, @frenchDish2),
(18, 4, 'Minestrone', 'Warm up with our hearty minestrone soup, a medley of fresh vegetables, beans, and pasta simmered in a rich and flavorful broth', 18, @frenchDish3),
(19, 4, 'Mushroom Aglio Olio', 'Enjoy the simplicity and elegance of our aglio olio pasta, featuring tender spaghetti tossed in a garlicky, olive oil-based sauce with mushrooms', 20, @frenchDish4),
(20, 4, 'Roasted Chicken', 'Delight in our succulent roasted chicken, seasoned with herbs and spices for a flavorful and satisfying experience', 45, @frenchDish5),

(21, 5, 'Abalone Mushroom with Brocoli', 'A luxurious and flavorful dish featuring abalone mushrooms, broccoli, and a rich sauce', 28, @vegetarianDish1),
(22, 5, 'Curry Potatos', 'A comforting and aromatic dish prepared with potatoes, onions, and a flavorful curry sauce', 18, @vegetarianDish2),
(23, 5, 'Mock Cereal Chicken', 'A unique and protein-rich dish crafted with cereal, and a savory mock meat, resembling the texture and taste of chicken', 22, @vegetarianDish3),
(24, 5, 'Samosa', 'A triangular-shaped pastry filled with a savory mixture of spiced potatoes, peas, and onions, served with a tangy chutney', 15, @vegetarianDish4),
(25, 5, 'Vegetarian Fried Rice', 'A classic and versatile dish made with fragrant rice, a medley of vegetables, and a savory sauce', 16, @vegetarianDish5);