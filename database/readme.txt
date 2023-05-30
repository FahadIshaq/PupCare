-- Create the database
CREATE DATABASE PupCare;

-- Use the created database
USE PupCare;

-- Create the tables
CREATE TABLE users (
  user_id INT PRIMARY KEY AUTO_INCREMENT,
  username VARCHAR(50) NOT NULL,
  pass VARCHAR(255) NOT NULL,
  email VARCHAR(100) NOT NULL,
  dob VARCHAR(100) NOT NULL,
  is_admin TINYINT(1) NOT NULL DEFAULT 0
);

CREATE TABLE dogs (
  dog_id INT PRIMARY KEY AUTO_INCREMENT,
  dogName VARCHAR(100) NOT NULL,
  breed VARCHAR(100) NOT NULL,
  age INT NOT NULL,
  owner_id INT,
  FOREIGN KEY (owner_id) REFERENCES users(user_id) ON DELETE CASCADE
);

CREATE TABLE services (
  service_id INT PRIMARY KEY AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  description TEXT,
  price DECIMAL(10, 2) NOT NULL
);

CREATE TABLE bookings (
  booking_id INT PRIMARY KEY AUTO_INCREMENT,
  user_id INT,
  service_id INT,
  dog_id INT,
home_address VARCHAR(100),
  date_booked_start DATETIME NOT NULL,
  date_booked_end DATETIME NOT NULL,
FOREIGN KEY (user_id) REFERENCES users(user_id) ON DELETE CASCADE,
  FOREIGN KEY (service_id) REFERENCES services(service_id) ON DELETE CASCADE,
  FOREIGN KEY (dog_id) REFERENCES dogs(dog_id) ON DELETE CASCADE
);
