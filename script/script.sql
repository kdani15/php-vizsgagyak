CREATE DATABASE laptopdb DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE laptopdb;

CREATE TABLE laptops (
  id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(255),
  manufacturer VARCHAR(255),
  cpu VARCHAR(255),
  ram VARCHAR(255),
  storage VARCHAR(255),
  price DECIMAL(10,2)
);

INSERT INTO laptops (name, manufacturer, cpu, ram, storage, price)
VALUES 
('Asus Vivobook 15', 'Asus', 'Intel Core i5', '8GB', '512GB SSD', 299999),
('HP Pavilion 14', 'HP', 'AMD Ryzen 5', '16GB', '1TB SSD', 329999),
('Dell Inspiron 13', 'Dell', 'Intel Core i7', '16GB', '512GB SSD', 389999);
