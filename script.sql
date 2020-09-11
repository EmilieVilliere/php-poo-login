CREATE DATABASE `auth`; 

USE `auth`;

CREATE TABLE `user` (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    email VARCHAR(255),
    password VARCHAR(255),
    pseudo VARCHAR(255)
);

CREATE TABLE `reset_token` (
    id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY NOT NULL,
    token VARCHAR(500),
    expired_at VARCHAR(255), 
    user_id INT UNSIGNED NOT NULL,
    CONSTRAINT fk_user_id FOREIGN KEY (user_id) REFERENCES reset_token(id) ON DELETE CASCADE
);
