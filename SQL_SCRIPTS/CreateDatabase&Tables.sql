Create database R8PC_DATABASE;
use R8PC_DATABASE;
Create table CPU(
      Brand Varchar(7),
      Name Varchar(25),
      Performance int,
      price int,
      searched int,
      suggested int,
      primary key(Name)
      );

Create table GPU(
      Brand Varchar(7),
      Name Varchar(25),
      Performance int,
      price int,
      searched int,
      suggested int,
      primary key(Name)
      );

CREATE TABLE RAM (
		Amount INT PRIMARY KEY
	);

CREATE TABLE Laptops (
      Serial_Number varchar(25) PRIMARY KEY,
     Brand VARCHAR(25),
      Name VARCHAR(50),
    CPU_Name VARCHAR(25),
    RAM_Amount INT,
      GPU_Name VARCHAR(25),
      Price INT,
      suggested INT,
    FOREIGN KEY (CPU_Name) REFERENCES CPU (Name),
    FOREIGN KEY (GPU_Name) REFERENCES GPU (Name)
 );

CREATE TABLE Programs (
		Name VARCHAR(255) PRIMARY KEY,
    Description TEXT,
    picture VARCHAR(255),
    LCPU INT,
    MCPU INT,
    HCPU INT,
    LGPU INT,
    MGPU INT,
    HGPU INT,
    LRAM INT,
    MRAM INT,
    HRAM INT
	);

CREATE TABLE `users` (
      `id` int(11) NOT NULL AUTO_INCREMENT,
      `username` varchar(255) NOT NULL,
      `email` varchar(255) NOT NULL,
      `password` varchar(255) NOT NULL,
      PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;