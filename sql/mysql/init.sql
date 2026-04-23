CREATE DATABASE sgs
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

SET NAMES utf8mb4;
USE sgs;

CREATE TABLE `access_levels` (
    `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Id',
    `access_level` VARCHAR(100) NOT NULL COMMENT 'Name access level',
    `order_level` INT NOT NULL COMMENT 'Hierarchical order of the level',
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB
COMMENT='System access levels';

CREATE TABLE `config_emails` (
    `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Id',
    `title` VARCHAR(225) NOT NULL COMMENT 'Title of the setup email',
    `name` VARCHAR(225) NOT NULL COMMENT 'Senders name displayed in emails',
    `email` VARCHAR(225) NOT NULL COMMENT 'Senders email address',
    `host` VARCHAR(225) NOT NULL COMMENT 'SMTP server address',
    `username` VARCHAR(225) NOT NULL COMMENT 'Authentication user on the SMTP server',
    `password` VARCHAR(225) NOT NULL COMMENT 'Authentication password on the SMTP server',
    `smtp_secure` VARCHAR(225) NOT NULL COMMENT 'SMTP security protocol (TLS, SSL)',
    `port` INT NOT NULL COMMENT 'SMTP server connection port',
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB 
COMMENT='Email server settings for sending via the system';

CREATE TABLE `colors`(
    `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Id',
    `color_name` VARCHAR(100) NOT NULL COMMENT 'Color description',
    `color` VARCHAR(100) NOT NULL COMMENT 'Color code in HEX or other format',
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB 
COMMENT='Color palette used in the system';

CREATE TABLE `users_situation`(
    `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Id',
    `situation_name` VARCHAR(100) NOT NULL COMMENT 'User situation description',
    `color_id` INT NOT NULL COMMENT 'Fk of colors',
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY (`id`),
    CONSTRAINT `fk_user_situation_with_color_id`
    FOREIGN KEY (`color_id`) REFERENCES `colors`(`id`) 
    ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB 
COMMENT='Possible user scenarios';

CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Id',
  `name` varchar(100) NOT NULL COMMENT 'Full name user',
  `email` varchar(100) UNIQUE NOT NULL COMMENT 'E-mail of user',
  `user` varchar(100) UNIQUE NOT NULL COMMENT 'Unique login for authentication',
  `password` varchar(255) NOT NULL COMMENT 'Password for login storaged with hash',
  `recover_password` varchar(255) NULL COMMENT 'Field with temporary token for recovery pass',
  `image` varchar(255) NULL COMMENT 'Path image url',
  `confirm_email` VARCHAR(225) NULL COMMENT 'Token for e-mail confirmation (NULL = confirmed)',
  `user_situation_id` INT NOT NULL COMMENT '1 - Confirmed email | 2 - Waiting email confirm | 3 - Inactive',
  `access_level_id` INT NOT NULL COMMENT 'Fk of access_levels',
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` TIMESTAMP NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_users_with_user_situation_id`
  FOREIGN KEY (`user_situation_id`) REFERENCES `users_situation`(`id`) 
    ON DELETE RESTRICT ON UPDATE CASCADE,
  CONSTRAINT `fk_users_with_access_level_id`
  FOREIGN KEY (`access_level_id`) REFERENCES `access_levels`(`id`)
    ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB 
COMMENT='Principal table for users';