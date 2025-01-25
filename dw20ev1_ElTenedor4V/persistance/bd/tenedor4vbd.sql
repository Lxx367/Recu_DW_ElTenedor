-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Servidor: 127.0.0.1
-- Tiempo de generación: 14-11-2024 a las 11:47:40
-- Versión del servidor: 10.4.32-MariaDB
-- Versión de PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de datos: `tenedor4vbd`
--

-- --------------------------------------------------------

CREATE DATABASE IF NOT EXISTS tenedor4vbd;
USE tenedor4vbd;

CREATE TABLE IF NOT EXISTS users (
    idUser INT AUTO_INCREMENT PRIMARY KEY,
    email VARCHAR(255) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    type VARCHAR(255) NOT NULL
);

CREATE TABLE IF NOT EXISTS category (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL UNIQUE
);

CREATE TABLE IF NOT EXISTS restaurant (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    image VARCHAR(500) NOT NULL,
    minorprice INT NOT NULL,
    mayorprice INT NOT NULL,
    menu TEXT NOT NULL,
    category_id INT,
    FOREIGN KEY (category_id) REFERENCES category(id)
        ON DELETE SET NULL
        ON UPDATE CASCADE
);

CREATE TABLE IF NOT EXISTS reservations (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fecha DATETIME NOT NULL,
    hora TIME NOT NULL,
    comensales INT NOT NULL,
    ip VARCHAR(255) NOT NULL
);

INSERT IGNORE INTO users (email, password, type) VALUES
    ('admin', '1234', "Admin"),
    ('gestor', '12345', "Gestor");

INSERT IGNORE INTO category (name) VALUES
    ('Italiana'),
    ('Japonesa'),
    ('Venezolana'),
    ('China'),
    ('Española');

INSERT IGNORE INTO restaurant (name, image, minorprice, mayorprice, menu, category_id) VALUES
    ('La Tagliatella', 'https://lh3.googleusercontent.com/p/AF1QipMIeNeeL3IuolN9lP-LdLkfGTAt4jG2hnzpRszG=s1360-w1360-h1020-rw', 20, 30, 'Tallarines y macarrones', 1),
    ('Sakura', 'https://lh3.googleusercontent.com/p/AF1QipNlUcDqefKGvMH94iBMghuuBrWj0S5adJiYDCnV=s1360-w1360-h1020', 25, 40, 'Sushi variado y pato', 2),
    ('Tepuy Bar', 'https://lh3.googleusercontent.com/p/AF1QipPBa2Im9BwIl4_V_rZbxI3hd0pXHDZ1EMWGRObJ=s1360-w1360-h1020-rw', 15, 25, 'Tequeños y arepitas', 3),
    ('Mei Mei', 'https://lh3.googleusercontent.com/p/AF1QipP8QGiClMNrNqBNhTCk9xr08BqittTySPoib2uI=s1360-w1360-h1020', 10, 20, 'Patatas de gamba y pan chino', 4),
    ('Restaurant Baserriberri', 'https://lh3.googleusercontent.com/p/AF1QipNfIJVXsMRZD12BGQ684pK9nyP-gpxh439XPvwE=s1360-w1360-h1020-rw', 30, 50, 'Variedad de carnes y pescados', 5);
