DROP DATABASE ecommerce;
CREATE DATABASE ecommerce;
USE ecommerce;

CREATE TABLE brands (
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    name VARCHAR(40) unique NOT NULL
);

CREATE TABLE categories (
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    name varchar(40) unique NOT NULL
);

CREATE TABLE products (
    id int NOT NULL AUTO_INCREMENT PRIMARY KEY ,
    name varchar(60) unique NOT NULL,
    gender varchar(1) NOT NULL,
    price DECIMAL(6,2) NOT NULL,
    brand_id int NOT NULL,
    category_id int NOT NULL,
    FOREIGN KEY (brand_id) REFERENCES brands(id) ON UPDATE CASCADE ON DELETE CASCADE,
    FOREIGN KEY (category_id) REFERENCES categories(id) ON UPDATE CASCADE ON DELETE CASCADE
);

CREATE TABLE users
(
  id       int          NOT NULL AUTO_INCREMENT PRIMARY KEY,
  name     varchar(60)  NOT NULL,
  username varchar(30)  NOT NULL unique,
  password varchar(256) NOT NULL,
  email    varchar(30)  NOT NULL unique,
  address  varchar(150) NOT NULL,
  contact  varchar(40)  NOT NULL
)