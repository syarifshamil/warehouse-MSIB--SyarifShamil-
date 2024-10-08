CREATE DATABASE warehouse_msib;

USE warehouse_msib;

CREATE TABLE gudang (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    location VARCHAR(255) NOT NULL,
    capacity INT NOT NULL,
    status ENUM('aktif', 'tidak_aktif') DEFAULT 'aktif',
    opening_hour TIME,
    closing_hour TIME
);
