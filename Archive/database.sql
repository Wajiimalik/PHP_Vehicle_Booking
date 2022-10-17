CREATE DATABASE db_vehicles_booking;

USE db_vehicles_booking;

CREATE TABLE tb_vehicles
(
	vehicle_id INT PRIMARY KEY AUTO_INCREMENT,
	vehicle_name VARCHAR(100) NOT NULL,
	model VARCHAR(100) NOT NULL,
	make VARCHAR(100) NOT NULL,
	picture VARCHAR(65535) /*NOT NULL*/,
	price DECIMAL(7,2) NOT NULL
);


CREATE TABLE tb_users
(
	user_id INT PRIMARY KEY AUTO_INCREMENT,
	user_name VARCHAR(100) NOT NULL,
	contact_num VARCHAR(15) NOT NULL,
	email_address VARCHAR(100) NOT NULL,
	user_password VARCHAR(20),
	user_address VARCHAR(250) NOT NULL,
	gender VARCHAR(10) NOT NULL CHECK (gender IN ('male', 'female')),
	UNIQUE(email_address)
);

CREATE TABLE tb_bookings
(
	booking_id INT PRIMARY KEY AUTO_INCREMENT,
	user_id INT NOT NULL,
	vehicle_booked INT NOT NULL,
	pickup_location VARCHAR(100) NOT NULL,
	return_location VARCHAR(100) NOT NULL,
	pickup_datetime DATETIME NOT NULL,
	return_datetime DATETIME NOT NULL,
	sub_total DECIMAL(7,2) NOT NULL,
	booked_at DATETIME NOT NULL DEFAULT NOW(),
	FOREIGN KEY(user_id) REFERENCES tb_USERS(user_id),
	FOREIGN KEY(vehicle_booked) REFERENCES tb_vehicles(vehicle_id)
);