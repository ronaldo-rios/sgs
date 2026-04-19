CREATE DATABASE sgs
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

SET NAMES utf8mb4;
USE sgs;

CREATE TABLE `access_levels` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `access_level` VARCHAR(100) NOT NULL,
    `order_level` INT NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `config_emails` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `title` VARCHAR(225) NOT NULL,
    `name` VARCHAR(225) NOT NULL,
    `email` VARCHAR(225) NOT NULL,
    `host` VARCHAR(225) NOT NULL,
    `username` VARCHAR(225) NOT NULL,
    `password` VARCHAR(225) NOT NULL,
    `smtp_secure` VARCHAR(225) NOT NULL,
    `port` INT NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `colors`(
    `id` INT NOT NULL AUTO_INCREMENT,
    `color_name` VARCHAR(100) NOT NULL,
    `color` VARCHAR(100) NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB;

CREATE TABLE `users_situation`(
    `id` INT NOT NULL AUTO_INCREMENT,
    `situation_name` VARCHAR(100) NOT NULL,
    `color_id` INT NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_user_situation_with_color_id`
    FOREIGN KEY (`color_id`) REFERENCES `colors`(`id`) 
    ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) UNIQUE NOT NULL,
  `user` varchar(100) UNIQUE NOT NULL,
  `password` varchar(255) NOT NULL,
  `recover_password` varchar(255) NULL,
  `image` varchar(255) NULL,
  `confirm_email` VARCHAR(225) NULL,
  `user_situation_id` INT NOT NULL,
  `access_level_id` INT NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_users_with_user_situation_id`
  FOREIGN KEY (`user_situation_id`) REFERENCES `users_situation`(`id`) 
    ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_users_with_access_level_id`
  FOREIGN KEY (`access_level_id`) REFERENCES `access_levels`(`id`)
    ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB;