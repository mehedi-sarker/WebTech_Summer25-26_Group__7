-- ================================================
-- Run this in phpMyAdmin's SQL tab (golazobd database)
-- WARNING: this drops and recreates customers/staff,
-- so any existing test accounts will be wiped.
-- ================================================

DROP TABLE IF EXISTS customers;
DROP TABLE IF EXISTS staff;


-- ================================
-- CUSTOMERS TABLE (self sign-up)
-- ================================

CREATE TABLE customers (
    CustomerID INT AUTO_INCREMENT PRIMARY KEY,
    Username VARCHAR(50) NOT NULL UNIQUE,
    Password VARCHAR(50) NOT NULL,
    CreatedAt DATETIME NOT NULL
);


-- ================================
-- STAFF TABLE (admin + delivery man, inserted manually)
-- Username column here plays the same role as StaffID did before -
-- renamed so the same signin() function works for both tables.
-- ================================

CREATE TABLE staff (
    Username VARCHAR(10) PRIMARY KEY,
    Password VARCHAR(10) NOT NULL,
    Role VARCHAR(20) NOT NULL
);

INSERT INTO staff (Username, Password, Role)
VALUES
('A102', '1234', 'Admin'),
('D102', '1234', 'DeliveryMan');
