CREATE DATABASE sgs
    CHARACTER SET utf8mb4
    COLLATE utf8mb4_unicode_ci;

SET NAMES utf8mb4;
USE sgs;

CREATE TABLE `access_levels` (
    `id` INT NOT NULL AUTO_INCREMENT COMMENT 'Id',
    `access_level` VARCHAR(100) NOT NULL COMMENT 'Name access level',
    `order_level` INT NOT NULL COMMENT 'Hierarchical order of the level',
    `is_default` TINYINT(1) NOT NULL DEFAULT 0 COMMENT 'Level assigned to newly registered users',
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
    `type_module` VARCHAR(225) NOT NULL,
    `name_module` VARCHAR(225) NOT NULL,
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
    UNIQUE KEY `uq_page_levels_level_page` (`access_level_id`, `page_id`),
    CONSTRAINT `fk_page_levels_with_access_level_id`
    FOREIGN KEY (`access_level_id`) REFERENCES `access_levels`(`id`)
        ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk_page_levels_with_page_id`
    FOREIGN KEY (`page_id`) REFERENCES `pages`(`id`)
        ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB
COMMENT='Pages that the user can access according to their permissions';

INSERT INTO `colors`(id, color_name, color, created_at) 
VALUES
    (1, 'Azul', '#0275D8', NOW()),
    (2, 'Cinza', '#868E95', NOW()),
    (3, 'Verde', '#5CB85C', NOW()),
    (4, 'Vermelho', '#D9534F', NOW()),
    (5, 'Laranja', '#F0AD4E', NOW()),
    (6, 'Azul Claro', '#17A2B8', NOW()),
    (7, 'Cinza Claro', '#343140', NOW()),
    (8, 'Branco', '#FFFFFF', NOW());

INSERT INTO `users_situation`(id, situation_name, color_id, created_at) 
VALUES
    (1, 'Confirmado', 3, NOW()), 
    (2, 'Aguardando Confirmação', 5, NOW()), 
    (3, 'Inativo', 4, NOW());

INSERT INTO `page_types`(id, type_name, order_page_type, created_at)
VALUES
    (1, 'Listar', 1, NOW()),
    (2, 'Visualizar', 2, NOW()),
    (3, 'Cadastrar', 3, NOW()),
    (4, 'Editar', 4, NOW()),
    (5, 'Excluir', 5, NOW()),
    (6, 'Acesso', 6, NOW()),
    (7, 'Outros', 7, NOW());

INSERT INTO `access_levels` (access_level, order_level, is_default, created_at)
VALUES
    ('Super Admin', 1, 0, NOW()),
    ('Administrador', 2, 0, NOW()),
    ('Médico', 3, 0, NOW()),
    ('Enfermeiro', 4, 0, NOW()),
    ('Financeiro', 5, 0, NOW()),
    ('Paciente', 6, 1, NOW());

INSERT INTO `page_modules`(id, type_module, name_module, order_module, created_at)
VALUES
    (1, 'Adms', 'Administrativo', 1, NOW());

INSERT INTO `pages`
    (controller, method, controller_in_the_main, method_in_the_main, name_page, public, enable_in_sidebar, icon, active_status, page_type_id, page_module_id, created_at)
VALUES
    ('Login', 'index', 'login', 'index', 'Login', 1, 0, NULL, 1, 6, 1, NOW()),
    ('Register', 'index', 'new-user', 'index', 'Cadastro', 1, 0, NULL, 1, 6, 1, NOW()),
    ('Logout', 'index', 'logout', 'index', 'Logout', 1, 0, NULL, 1, 6, 1, NOW()),
    ('Error', 'index', 'error', 'index', 'Página de Erro', 1, 0, NULL, 1, 7, 1, NOW()),
    ('ConfirmEmail', 'index', 'confirm-email', 'index', 'Confirmação de Email', 1, 0, NULL, 1, 6, 1, NOW()),
    ('NewConfirmEmail', 'index', 'new-confirm-email', 'index', 'Nova Confirmação de Email', 1, 0, NULL, 1, 6, 1, NOW()),
    ('RecoverPassword', 'index', 'recover-password', 'index', 'Esqueci Minha Senha', 1, 0, NULL, 1, 6, 1, NOW()),
    ('UpdatePassword', 'index', 'update-password', 'index', 'Atualizar Senha', 1, 0, NULL, 1, 6, 1, NOW()),
    ('Permissions', 'index', 'permissions', 'index', 'Permissões de Acesso', 0, 0, NULL, 1, 1, 1, NOW()),
    ('UpdatePermission', 'index', 'edit-permission', 'index', 'Atualizar Permissões de Nível de Acesso', 0, 0, NULL, 1, 4, 1, NOW()),
    ('Dashboard', 'index', 'dashboard', 'index', 'Dashboard', 0, 1, 'fa-solid fa-house', 1, 7, 1, NOW()),
    ('SyncPageLevels', 'index', 'sync-page-levels', 'index', 'Sincronizar Página e Nível de Acesso', 0, 0, NULL, 1, 7, 1, NOW()),
    ('ViewProfile', 'index', 'view-profile', 'index', 'Perfil', 0, 1, 'fa-solid fa-user', 1, 2, 1, NOW()),
    ('UpdateProfile', 'index', 'edit-profile', 'index', 'Atualizar Perfil de Usuário Logado', 0, 0, NULL, 1, 4, 1, NOW()),
    ('Users', 'index', 'users', 'index', 'Usuários', 0, 1, 'fa-solid fa-users', 1, 1, 1, NOW()),
    ('ViewUser', 'index', 'view-user', 'index', 'Visualizar Usuário', 0, 0, NULL, 1, 2, 1, NOW()),
    ('AddUser', 'index', 'add-user', 'index', 'Adicionar Usuário', 0, 0, NULL, 1, 3, 1, NOW()),
    ('UpdateUser', 'index', 'edit-user', 'index', 'Editar Usuário', 0, 0, NULL, 1, 4, 1, NOW()),
    ('DeleteUser', 'index', 'delete-user', 'index', 'Excluir Usuário', 0, 0, NULL, 1, 5, 1, NOW()),
    ('AccessLevels', 'index', 'access-levels', 'index', 'Níveis de Acesso', 0, 1, 'fa-solid fa-user-shield', 1, 1, 1, NOW()),
    ('ViewAccessLevel', 'index', 'view-access-level', 'index', 'Visualizar Nível de Acesso', 0, 0, NULL, 1, 2, 1, NOW()),
    ('AddAccessLevel', 'index', 'add-access-level', 'index', 'Adicionar Novo Nível de Acesso', 0, 0, NULL, 1, 3, 1, NOW()),
    ('UpdateAccessLevel', 'index', 'edit-access-level', 'index', 'Editar Nível de Acesso', 0, 0, NULL, 1, 4, 1, NOW()),
    ('DeleteAccessLevel', 'index', 'delete-access-level', 'index', 'Deletar Nível de Acesso', 0, 0, NULL, 1, 5, 1, NOW()),
    ('ConfigEmails', 'index', 'config-emails', 'index', 'Servidores de Email', 0, 1, 'fa-solid fa-envelope', 1, 1, 1, NOW()),
    ('ViewConfigEmail', 'index', 'view-config-email', 'index', 'Visualizar Servidor de Email', 0, 0, NULL, 1, 2, 1, NOW()),
    ('AddConfigEmail', 'index', 'add-config-email', 'index', 'Adicionar Novo Servidor de Email', 0, 0, NULL, 1, 3, 1, NOW()),
    ('UpdateConfigEmail', 'index', 'edit-config-email', 'index', 'Editar Servidor de Email', 0, 0, NULL, 1, 4, 1, NOW()),
    ('DeleteConfigEmail', 'index', 'delete-config-email', 'index', 'Remover Servidor de Email', 0, 0, NULL, 1, 5, 1, NOW()),
    ('Pages', 'index', 'pages', 'index', 'Páginas', 0, 1, 'fa-solid fa-file-lines', 1, 1, 1, NOW()),
    ('ViewPage', 'index', 'view-page', 'index', 'Visualizar Página', 0, 0, NULL, 1, 2, 1, NOW()),
    ('AddPage', 'index', 'add-page', 'index', 'Cadastrar Nova Página', 0, 0, NULL, 1, 3, 1, NOW()),
    ('UpdatePage', 'index', 'edit-page', 'index', 'Editar Página', 0, 0, NULL, 1, 4, 1, NOW()),
    ('DeletePage', 'index', 'delete-page', 'index', 'Deletar Página', 0, 0, NULL, 1, 5, 1, NOW()),
    ('PageTypes', 'index', 'page-types', 'index', 'Tipos de Página', 0, 1, 'fa-solid fa-layer-group', 1, 1, 1, NOW()),
    ('ViewPageType', 'index', 'view-page-type', 'index', 'Visualizar Tipo de Página', 0, 0, NULL, 1, 2, 1, NOW()),
    ('AddPageType', 'index', 'add-page-type', 'index', 'Cadastrar Novo Tipo de Página', 0, 0, NULL, 1, 3, 1, NOW()),
    ('UpdatePageType', 'index', 'edit-page-type', 'index', 'Editar Tipo de Página', 0, 0, NULL, 1, 4, 1, NOW()),
    ('DeletePageType', 'index', 'delete-page-type', 'index', 'Deletar Tipo de Página', 0, 0, NULL, 1, 5, 1, NOW()),
    ('PageModules', 'index', 'page-modules', 'index', 'Módulos de Página', 0, 1, 'fa-solid fa-cubes', 1, 1, 1, NOW()),
    ('ViewPageModule', 'index', 'view-page-module', 'index', 'Visualizar Módulo', 0, 0, NULL, 1, 2, 1, NOW()),
    ('AddPageModule', 'index', 'add-page-module', 'index', 'Cadastrar Novo Módulo', 0, 0, NULL, 1, 3, 1, NOW()),
    ('UpdatePageModule', 'index', 'edit-page-module', 'index', 'Editar Módulo', 0, 0, NULL, 1, 4, 1, NOW()),
    ('DeletePageModule', 'index', 'delete-page-module', 'index', 'Deletar Módulo', 0, 0, NULL, 1, 5, 1, NOW());

INSERT INTO `users`
(`name`, `email`, `user`, `password`, `user_situation_id`, `access_level_id`, `created_at`)
VALUES -- Senha do usuário padrão sem o hash: Secret123
('Test User', 'super.adm@teste.com', 'SUPERADM' , '$argon2id$v=19$m=65536,t=4,p=1$eE93QlNBaS5mVm9taUR2Tg$fNszblqZo9l6xSdrmyn4+/9qGHDfwvHzH7kVOCzOn/4', 1, 1, NOW());


