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
    MenuDescription TEXT
);

-- Create Orders table
CREATE TABLE Orders (
    OrderID INT PRIMARY KEY,
    UserID INT,
    delivery_datetime DATETIME,
    FOREIGN KEY (UserID) REFERENCES Users(UserID)
);

-- Create Items table
CREATE TABLE Items (
    ItemID INT PRIMARY KEY,
    MenuID INT,
    ItemDescription TEXT,
    ItemPrice DECIMAL(10, 2),
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
