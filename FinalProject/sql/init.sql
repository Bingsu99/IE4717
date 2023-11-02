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

-- SET @frenchImgData = LOAD_FILE('../assets/frenchmenu.jpg');
-- SET @chineseImgData = LOAD_FILE('../assets/chinesemenu.jpg');
-- SET @koreanImgData = LOAD_FILE('../assets/koreanmenu.jpg');
-- $basePath = 'C:/xampp/htdocs/IE4717/IE4717/FinalProject';

SET @tempData = LOAD_FILE('C:\\xampp\\htdocs\\IE4717\\IE4717\\FinalProject\\assets\\temp.jpg');
SET @tempData2 = LOAD_FILE('C:\\xampp\\htdocs\\IE4717\\IE4717\\FinalProject\\assets\\temp2.jpg');
SET @tempData3 = LOAD_FILE('C:\\xampp\\htdocs\\IE4717\\IE4717\\FinalProject\\assets\\temp3.jpg');


-- Inserting fake data into Menus table
INSERT INTO Menus (MenuID, MenuName, MenuDescription, MenuImage)
VALUES
(1, 'French', 'French Description', @tempData),
(2, 'Chinese', 'Chinese Description', @tempData2),
(3, 'Korean', 'Korean Description', @tempData3);

-- SET @salmonCanapesImgData = LOAD_FILE('../assets/SalmonCanapes.jpg');
-- SET @cheeseTartImgData = LOAD_FILE('../assets/CheeseTart.jpg');
-- SET @lyonnaiseSaladImgData = LOAD_FILE('../assets/LyonnaiseSalad.jpg');
-- SET @bokChoyImgData = LOAD_FILE('../assets/BokChoy.jpg');
-- SET @steamFishImgData = LOAD_FILE('../assets/SteamFish.jpg');
-- SET @toppokkiImgData = LOAD_FILE('../assets/Toppokki.jpg');
-- SET @sundaeImgData = LOAD_FILE('../assets/Sundae.jpg');

-- Inserting fake data into Items table
INSERT INTO Items (ItemID, MenuID, ItemName, ItemDescription, ItemPrice, ItemImage)
VALUES
(1, 1, 'Smoked Salmon Canapes', 'Smoked Salmon Canapes', 9.99, @tempData),
(2, 1, 'Alsatian Cheese Tart', 'Alsatian Cheese Tart', 7.50, @tempData),
(3, 1, 'Lyonnaise Salad', 'Lyonnaise Salad', 10.25, @tempData),
(4, 2, 'Bok Choy', 'Bok Choy', 8.75, @tempData),
(5, 2, 'Steam Fish', 'Steam Fish', 6.99, @tempData),
(6, 3, 'Toppokki', 'Toppokki', 19.99, @tempData),
(7, 3, 'Sundae', 'Sundae', 12.50, @tempData);