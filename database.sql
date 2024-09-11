CREATE DATABASE data_base_name;
USE data_base_name;

CREATE TABLE users (
    id BIGINT(20) PRIMARY KEY AUTO_INCREMENT,
    name varchar(120) NOT NULL,
    email varchar(255) NOT NULL,
    pwd varchar(128) NOT NULL
);

CREATE TABLE users_data (
    id BIGINT(20) PRIMARY KEY AUTO_INCREMENT,
    user_id BIGINT(20) NOT NULL,
    user_token VARCHAR(8) UNIQUE,
    permissions int(1) NOT NULL,
    store_name varchar(200) NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);


-- Hostinger:
-- Nombre de la base de datos: 
-- Usuario de la base de datos: 
-- Contraseña de la base de datos: 