CREATE TABLE user_passwords (
    user_id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    firstName VARCHAR(50) NOT NULL,
    lastName VARCHAR(50) NOT NULL,
    age INT NOT NULL CHECK (age > 0 AND age <= 120), 
    birthday DATE NOT NULL,
    address VARCHAR(255) NOT NULL,
    date_added TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
CREATE TABLE Clients(
    clientID INT PRIMARY KEY AUTO_INCREMENT,
    clientName VARCHAR(50),
    contactPerson VARCHAR(50),
    email VARCHAR(100),
    phone VARCHAR(15),
    storeAddress TEXT,
    createdBy VARCHAR(50),
    lastUpdated VARCHAR(50),
    registrationDate DATE DEFAULT CURRENT_DATE,
    updatedAt DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE Shipments(
    shipmentID INT PRIMARY KEY AUTO_INCREMENT,
    clientID INT,
    shipmentWeight DECIMAL(10,2),
    shipmentMethod VARCHAR(50),
    deliveryAddress TEXT NOT NULL,
    estimatedDeliveryDate DATE,
    carrier VARCHAR(100),
    createdBy VARCHAR(50),
    lastUpdated VARCHAR(50),
    dateAdded DATE DEFAULT CURRENT_DATE,
    updatedAt DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
);

