DROP DATABASE IF EXISTS yunan;
create database yunan;
use yunan;

-- Create Users table
CREATE TABLE Users (
    UserID INT PRIMARY KEY,
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
    MenuID INT PRIMARY KEY,
    MenuName VARCHAR(50),
    MenuDescription TEXT,
    MenuImage LONGBLOB
);

-- Create Orders table
CREATE TABLE Orders (
    OrderID INT PRIMARY KEY,
    UserID INT,
    delivery_datetime DATETIME,
    FOREIGN KEY (UserID) REFERENCES Users(UserID)
);


-- ADD ITEM NAME
-- Create Items table
CREATE TABLE Items (
    ItemID INT PRIMARY KEY,
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
(1, 'Asian', 'Asian Description', @vegetarianDish1),
(2, 'Christmas', 'Christmas Description', @christmasMenu),
(3, 'French', 'French Description', @frenchMenu),
(4, 'Spring', 'Spring Description', @springMenu),
(5, 'Vegetarian', 'Vegetarian Description', @vegetarianMenu);

-- Inserting fake data into Items table
INSERT INTO Items (ItemID, MenuID, ItemName, ItemDescription, ItemPrice, ItemImage)
VALUES
(1, 1, 'Broccoli with Mushroom and Scallops', 'Description', 9.99, @asianDish1),
(2, 1, 'Curry Chicken', 'Description', 7.50, @asianDish2),
(3, 1, 'Fried Rice', 'Description', 10.25, @asianDish3),
(4, 1, 'Green Curry Chicken', 'Description', 7.50, @asianDish4),
(5, 1, 'Nonya Kueh', 'Description', 10.25, @asianDish5),
(6, 2, 'Cherry Bourbon Glazed Ham', 'Description', 9.99, @christmasDish1),
(7, 2, 'Grilled Sausages with Peppers and Potatoes', 'Description', 7.50, @christmasDish2),
(8, 2, 'Ratatouille', 'Description', 10.25, @christmasDish3),
(9, 2, 'Roasted Fennel With Delicata Squash & Apples', 'Description', 7.50, @christmasDish4),
(10, 2, 'Squid and Shrimp Fideua', 'Description', 10.25, @christmasDish5),
(11, 3, 'Brownies', 'Description', 9.99, @frenchDish1),
(12, 3, 'Egg Salad', 'Description', 7.50, @frenchDish2),
(13, 3, 'Minestrone', 'Description', 10.25, @frenchDish3),
(14, 3, 'Mushroom Aglio Olio', 'Description', 7.50, @frenchDish4),
(15, 3, 'Roasted Chicken', 'Description', 10.25, @frenchDish5),
(16, 4, 'Braised Chicken', 'Description', 9.99, @springDish1),
(17, 4, 'Fried Beehoon', 'Description', 7.50, @springDish2),
(18, 4, 'Herbal Chicken', 'Description', 10.25, @springDish3),
(19, 4, 'Minced Meat Tofu', 'Description', 7.50, @springDish4),
(20, 4, 'Starters Platter', 'Description', 10.25, @springDish5),
(21, 5, 'Abalone Mushroom with Brocoli', 'Description', 9.99, @vegetarianDish1),
(22, 5, 'Curry Potatos', 'Description', 7.50, @vegetarianDish2),
(23, 5, 'Mock Cereal Chicken', 'Description', 10.25, @vegetarianDish3),
(24, 5, 'Samosa', 'Description', 7.50, @vegetarianDish4),
(25, 5, 'Vegetarian Fried Rice', 'Description', 10.25, @vegetarianDish5);