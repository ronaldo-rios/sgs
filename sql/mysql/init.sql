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

CREATE TABLE `page_types` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `type_name` VARCHAR(225) NOT NULL,
    `order_page_type` INT NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY(`id`)
) ENGINE=InnoDB
COMMENT='The type or category to which the page belongs';

CREATE TABLE `page_modules` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `type` VARCHAR(225) NOT NULL,
    `name` VARCHAR(225) NOT NULL,
    `order_module` INT NOT NULL,
    `obs` TEXT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY(`id`)
) ENGINE=InnoDB
COMMENT='Module or package that the page is part of';

CREATE TABLE `pages` (
    `id` INT NOT NULL AUTO_INCREMENT,
    `controller` VARCHAR(225) NOT NULL,
    `method` VARCHAR(225) NOT NULL,
    `controller_in_the_main` VARCHAR(225) NOT NULL,
    `method_in_the_main` VARCHAR(225) NOT NULL,
    `name_page` VARCHAR(225) NOT NULL,
    `public` INT NOT NULL,
    `enable_in_sidebar` INT NOT NULL,
    `icon` VARCHAR(225) NULL,
    `obs` TEXT NULL, 
    `active_status` INT NOT NULL,
    `page_type_id` INT NOT NULL,
    `page_module_id` INT NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY(`id`),
    CONSTRAINT `fk_pages_with_page_type_id`
    FOREIGN KEY (`page_type_id`) REFERENCES `page_types`(`id`)
        ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT `fk_pages_with_page_module_id`
    FOREIGN KEY (`page_module_id`) REFERENCES `page_modules`(`id`)
        ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB
COMMENT='Routine flow pages';

CREATE TABLE `page_levels`(
    `id` INT NOT NULL AUTO_INCREMENT,
    `permission` INT NOT NULL,
    `order_level_page` INT NOT NULL,
    `access_level_id` INT NOT NULL,
    `page_id` INT NOT NULL,
    `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL DEFAULT NULL,
    PRIMARY KEY(`id`),
    CONSTRAINT `fk_page_levels_with_access_level_id`
    FOREIGN KEY (`access_level_id`) REFERENCES `access_levels`(`id`)
        ON DELETE RESTRICT ON UPDATE CASCADE,
    CONSTRAINT `fk_page_levels_with_page_id`
    FOREIGN KEY (`page_id`) REFERENCES `pages`(`id`)
        ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB
COMMENT='Pages that the user can access according to their permissions';

INSERT INTO `colors`(color_name, color, created_at) 
VALUES
    ('Azul', '#0275D8', NOW()),
    ('Cinza', '#868E95', NOW()),
    ('Verde', '#5CB85C', NOW()),
    ('Vermelho', '#D9534F', NOW()),
    ('Laranja', '#F0AD4E', NOW()),
    ('Azul Claro', '#17A2B8', NOW()),
    ('Cinza Claro', '#343140', NOW()),
    ('Branco', '#FFFFFF', NOW());

INSERT INTO `users_situation`(id, situation_name, color_id, created_at) 
VALUES
    (1, 'Confirmado', 3, NOW()), 
    (2, 'Aguardando Confirmação', 5, NOW()), 
    (3, 'Inativo', 4, NOW());

INSERT INTO `access_levels` (id, access_level, order_level, created_at)
VALUES
    (1, 'Super Admin', 1, NOW()),
    (2, 'Administrador', 2, NOW()),
    (3, 'Médico', 3, NOW()),
    (4, 'Enfermeiro', 4, NOW()),
    (5, 'Financeiro', 5, NOW()),
    (6, 'Paciente', 6, NOW());

INSERT INTO `users`
(`name`, `email`, `user`, `password`, `user_situation_id`, `access_level_id`, `created_at`)
VALUES -- Senha do usuário padrão sem o hash: Secret123
('Test User', 'super.adm@teste.com', 'SUPERADM' , '$argon2id$v=19$m=65536,t=4,p=1$eE93QlNBaS5mVm9taUR2Tg$fNszblqZo9l6xSdrmyn4+/9qGHDfwvHzH7kVOCzOn/4', 1, 1, NOW());


