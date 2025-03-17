drop database if exists realestatecompany;
create database realestatecompany;
use realestatecompany;


-- -- -- Contract Table -- -- --
DROP TABLE IF EXISTS contract;
CREATE TABLE contract (
  contractID INT AUTO_INCREMENT PRIMARY KEY,         
  contractType VARCHAR(255) NOT NULL,                          
  status VARCHAR(50),                                    -- ("Pending", "Signed", "Active")
  startDate DATE NOT NULL,                                     
  termsAndConditions TEXT NOT NULL,                            
  expiryDate DATE NOT NULL                                   
);

INSERT INTO contract 
  (contractType, status, startDate, termsAndConditions, expiryDate)
VALUES
 ('Sale', 'Pending', '2024-11-10', 'Standard sale agreement, Buyer to pay full price upfront', '2025-11-10'),
  ('Sale', 'Signed', '2024-11-15', 'Sale agreement with installment plan, Buyer to pay in 3 installments', '2025-11-15'),
  ('Lease', 'Active', '2024-12-01', 'Lease for 1 year with monthly payment schedule', '2025-12-01'),
  ('Sale', 'Completed', '2024-11-20', 'Sale with all terms fulfilled, buyer paid full amount', '2025-11-20');
  
  
  
-- -- -- Client Table -- -- --
DROP TABLE IF EXISTS client;
CREATE TABLE client (
  clientID INT PRIMARY KEY,           
  clientName VARCHAR(255) NOT NULL,                           
  status VARCHAR(50),                                -- ("Active", "Inactive")
  address VARCHAR(255),                              
  email VARCHAR(100) NOT NULL UNIQUE,                                
  password VARCHAR(100) NOT NULL UNIQUE,                                
  registrationDate DATE,                            
  company VARCHAR(255),                              
  phoneNumber VARCHAR(20)                       
);

INSERT INTO client (clientID, clientName, status, address, email, password, registrationDate, company, phoneNumber)
VALUES
  (1, 'John Doe', 'Active', '123 Elm St, Springfield', 'johndoe@example.com', 'password123', '2024-01-01', 'Doe Enterprises', '555-1234'),
  (2, 'Jane Smith', 'Inactive', '456 Oak Rd, Shelbyville', 'janesmith@example.com', 'password456', '2023-12-15', 'Smith Corp.', '555-5678'),
  (3, 'Alice Johnson', 'Active', '789 Pine Blvd, Capital City', 'alicej@example.com', 'password789', '2024-01-05', 'Johnson Industries', '555-9101'),
  (4, 'Bob Brown', 'Active', '101 Maple Dr, Rivertown', 'bobbrown@example.com', 'password101', '2024-01-10', 'Brown Enterprises', '555-1122'),
  (5, 'Charlie Davis', 'Inactive', '202 Birch St, Greenfield', 'charliedavis@example.com', 'password202', '2023-11-25', 'Davis LLC', '555-3344');

-- -- -- Owner Table -- -- --
DROP TABLE IF EXISTS owner;
CREATE TABLE owner (
  ownerID INT AUTO_INCREMENT PRIMARY KEY,         
  ownerName VARCHAR(255) NOT NULL,                          
  address VARCHAR(255),                            
  email VARCHAR(100) NOT NULL UNIQUE,                              
  password VARCHAR(100) NOT NULL UNIQUE,                              
  registrationDate DATE,                           
  company VARCHAR(255),                             
  phoneNumber VARCHAR(20)
);

INSERT INTO owner (ownerName, address, email, password, registrationDate, company, phoneNumber)
VALUES
  ('Michael Adams', '123 Oak Ave, Springfield', 'michaeladams@example.com', 'ownerpassword123', '2024-01-01', 'Adams Enterprises', '555-2233'),
  ('Samantha Lee', '456 Birch Rd, Riverton', 'samanthalee@example.com', 'ownerpassword456', '2023-12-15', 'Lee Solutions', '555-3344'),
  ('David Williams', '789 Pine St, Capital City', 'davidwilliams@example.com', 'ownerpassword789', '2024-01-05', 'Williams Industries', '555-4455'),
  ('Linda Johnson', '101 Maple Dr, Greenfield', 'lindajohnson@example.com', 'ownerpassword101', '2024-01-10', 'Johnson Consulting', '555-5566'),
  ('James Smith', '202 Elm St, Shelbyville', 'jamessmith@example.com', 'ownerpassword202', '2023-11-25', 'Smith Logistics', '555-6677');

-- -- -- Employee Table -- -- --
DROP TABLE IF EXISTS employee;
CREATE TABLE employee (
  employeeID INT AUTO_INCREMENT PRIMARY KEY,      
  fullName VARCHAR(255) NOT NULL,                           
  address VARCHAR(255) NOT NULL,                           
  email VARCHAR(100) NOT NULL UNIQUE,                              
  password VARCHAR(100) NOT NULL UNIQUE,                              
  position VARCHAR(100) NOT NULL,                            
  salary DECIMAL(10, 2) NOT NULL,                           
  phoneNumber VARCHAR(20),                          
  paymentDate DATE                                  
);

INSERT INTO employee (fullName, address, email, password, position, salary, phoneNumber, paymentDate)
VALUES
  ('Klarein Wassaya', '10 downtown St, Ramallah', 'klareinW@daman.com', 'emp001', 'HR Specialist', 52000.00, '555-5732', '2023-11-30'),
  ('Masa Jalamneh', '22 downtown St, Jenin', 'masaJ@daman.com', 'emp002', 'HR Specialist', 52000.00, '555-1376', '2023-11-30'),
  ('Yara Taha', '11 downtown St, Nablus', 'yaraT@daman.com', 'emp003', 'HR Specialist', 52000.00, '555-1542', '2023-11-30'),
  ('John Carter', '123 Main St, Springfield', 'johncarter@daman.com', 'emp123', 'Manager', 55000.00, '555-1234', '2024-01-01'),
  ('Emily Davis', '456 Oak Rd, Rivertown', 'emilydavis@daman.com', 'emp456', 'Sales Representative', 45000.00, '555-2345', '2023-12-15'),
  ('Michael Brown', '789 Pine Blvd, Greenfield', 'michaelbrown@daman.com', 'emp789', 'Software Developer', 75000.00, '555-3456', '2024-01-05'),
  ('Sarah Wilson', '101 Maple Dr, Shelbyville', 'sarahwilson@daman.com', 'emp101', 'Marketing Coordinator', 60000.00, '555-4567', '2024-01-10'),
  ('David Moore', '202 Birch St, Capital City', 'davidmoore@daman.com', 'emp202', 'HR Specialist', 52000.00, '555-5678', '2023-11-25');
 
DROP TABLE IF EXISTS property;
CREATE TABLE property (
  propertyID INT AUTO_INCREMENT PRIMARY KEY,          
  ownerID INT,
  propertyAddress VARCHAR(255) NOT NULL,                       
  salePrice DECIMAL(15, 2),                        
  marketPrice DECIMAL(15, 2),                          
  propertyType VARCHAR(100),                           -- ('House', 'Apartment', 'Commercial')
  propertyCountry VARCHAR(100) NOT NULL,                        
  city VARCHAR(100) NOT NULL,                                   
  costPaidBySeller DECIMAL(15, 2),                    
  closingDate DATE NOT NULL,
  imagePath VARCHAR(255) NOT NULL,
  details TEXT,
  foreign key (ownerID) references owner (ownerID)
);

INSERT INTO property 
  (ownerID, propertyAddress, salePrice, marketPrice, propertyType, propertyCountry, city, costPaidBySeller, closingDate, imagePath, details)
VALUES
  (1, '200 Cedar St, Midtown', 300000.00, 320000.00, 'House', 'Palestine', 'Bethlehem', 290000.00, '2024-11-25', 'images/building7.jpg', 'A cozy house located at 200 Cedar St, Midtown in Bethlehem, perfect for families. Market price exceeds sale price, making it a valuable investment.'),
  (2, '345 Elm Ave, Greenfield', 400000.00, 420000.00, 'Apartment', 'Palestine', 'Hebron', 390000.00, '2024-11-26', 'images/room1.jpg', 'A modern apartment at 345 Elm Ave, Greenfield in Hebron. Ideal for urban living with a great market value.'),
  (4, '567 Spruce Rd, Westside', 600000.00, 620000.00, 'Apartment', 'Palestine', 'Ramallah', 580000.00, '2024-11-27', 'images/building3.jpg', 'A high-value apartment at 567 Spruce Rd, Westside in Ramallah. A great choice for premium living.'),
  (3, '890 Walnut Blvd, Uptown', 550000.00, 570000.00, 'House', 'Palestine', 'Nablus', 530000.00, '2024-11-28', 'images/listing1.jpg', 'A spacious house at 890 Walnut Blvd, Uptown in Nablus, offering comfort and excellent resale value.'),
  (5, '123 Oak St, Lakeside', 250000.00, 270000.00, 'Apartment', 'Palestine', 'Jericho', 240000.00, '2024-11-29', 'images/listing2.jpg', 'A budget-friendly apartment at 123 Oak St, Lakeside in Jericho. Perfect for first-time buyers or investors.'),
  (2, '456 Birch Ave, Suburbia', 500000.00, 520000.00, 'Land', 'Palestine', 'Tulkarm', 480000.00, '2024-11-30', 'images/listing3.jpg', 'A prime land property at 456 Birch Ave, Suburbia in Tulkarm. Ideal for construction or investment opportunities.'),
  (5, '789 Palm Rd, Downtown', 700000.00, 730000.00, 'Apartment', 'Palestine', 'Jenin', 680000.00, '2024-12-01', 'images/listing4.jpg', 'A luxury apartment at 789 Palm Rd, Downtown in Jenin. Prime location with exceptional amenities.'),
  (1, '321 Maple Blvd, Hillcrest', 450000.00, 470000.00, 'Restaurant', 'Palestine', 'Gaza', 430000.00, '2024-12-02', 'images/listing5.jpg', 'A fully-equipped restaurant property at 321 Maple Blvd, Hillcrest in Gaza. A rare business opportunity.'),
  (4, '654 Ash St, Countryside', 280000.00, 300000.00, 'Farm', 'Palestine', 'Jenin', 270000.00, '2024-12-03', 'images/listing6.jpg', 'A serene farm at 654 Ash St, Countryside in Jenin. Perfect for agricultural ventures or a quiet retreat.'),
  (2, '987 Willow Ave, City Center', 800000.00, 820000.00, 'Roof Apartment', 'Palestine', 'Ramallah', 780000.00, '2024-12-04', 'images/listing7.jpg', 'A stunning roof apartment at 987 Willow Ave, City Center in Ramallah. Offers breathtaking city views.'),
  (3, '246 Cherry Rd, Northside', 380000.00, 400000.00, 'Apartment', 'Palestine', 'Bethlehem', 370000.00, '2024-12-05', 'images/listing8.jpg', 'A charming apartment at 246 Cherry Rd, Northside in Bethlehem. Perfect for small families or couples.'),
  (2, '135 Pine St, Seaview', 450000.00, 470000.00, 'House Property', 'Palestine', 'Jenin', 440000.00, '2024-12-06', 'images/listing9.jpg', 'A seaside house property at 135 Pine St, Seaview in Jenin. Offers peaceful living near the water.');


-- -- -- Transaction Table -- -- --
DROP TABLE IF EXISTS transaction;
CREATE TABLE transaction (
  transactionID INT AUTO_INCREMENT PRIMARY KEY,   
  salePrice DECIMAL(15, 2) NOT NULL,                        
  paymentTerms VARCHAR(255),                       -- ('Cash', 'Mortgage')
  transactionDate DATE NOT NULL,                            
  transactionType VARCHAR(100) NOT NULL,                    -- ('Sale', 'Lease', etc.)
  contractID INT NOT NULL,                                  -- FK referencing contract table
  clientID INT NOT NULL,                                    -- FK referencing client table
  ownerID INT NOT NULL,                                     -- FK referencing owner table
  employeeID INT NOT NULL,                                  -- FK referencing employee table
  propertyID INT NOT NULL,                                  -- FK referencing property table  
  appointmentDate DATE NOT NULL,                            
  FOREIGN KEY (contractID) REFERENCES contract(contractID),
  FOREIGN KEY (clientID) REFERENCES client(clientID),
  FOREIGN KEY (ownerID) REFERENCES owner(ownerID),
  FOREIGN KEY (employeeID) REFERENCES employee(employeeID),
  FOREIGN KEY (propertyID) REFERENCES property(propertyID)
);

INSERT INTO transaction 
  (salePrice, paymentTerms, transactionDate, transactionType, contractID, clientID, ownerID, employeeID, propertyID, appointmentDate)
VALUES
  (300000.00, 'Cash', '2024-11-10', 'Sale', 1, 1, 1, 1, 1, '2024-11-08'),
  (500000.00, 'bank', '2024-11-12', 'Sale', 2, 2, 2, 2, 2, '2024-11-09'),
  (25000.00, 'Cash', '2024-11-15', 'Lease', 3, 3, 3, 3, 3, '2024-11-13'),
  (120000.00, 'bank', '2024-11-18', 'Sale', 4, 4, 4, 4, 4, '2024-11-17');

DROP TABLE IF EXISTS contact_requests;
CREATE TABLE contact_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phone VARCHAR(20),
    message TEXT,
    status VARCHAR(50) DEFAULT 'New' -- "New", "Reviewed", etc.
);



DROP TABLE IF EXISTS buy_requests;
CREATE TABLE buy_requests (
    id INT AUTO_INCREMENT PRIMARY KEY,
    clientID INT,
    clientName VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    phoneNumber VARCHAR(15) NOT NULL,
    paymentTerms TEXT NOT NULL,
    propertyID INT,
	status VARCHAR(50) DEFAULT 'New' -- "New", "Reviewed", etc.

);

DROP TABLE IF EXISTS sell_requests;
CREATE TABLE sell_requests (
	  id INT AUTO_INCREMENT PRIMARY KEY,
	  ownerID INT,
      email VARCHAR(255) NOT NULL,
	  propertyAddress VARCHAR(255) NOT NULL,                       
	  salePrice DECIMAL(15, 2),                        
	  marketPrice DECIMAL(15, 2),                          
	  propertyType VARCHAR(100),                           -- ('House', 'Apartment', 'Commercial')
	  propertyCountry VARCHAR(100) NOT NULL,                        
	  city VARCHAR(100) NOT NULL,                                   
	  costPaidBySeller DECIMAL(15, 2),                    
	  closingDate DATE NOT NULL,
	  imagePath VARCHAR(255) NOT NULL,
	  details TEXT,
	  status VARCHAR(50) DEFAULT 'New' -- "New", "Reviewed", etc.
);


