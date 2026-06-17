<?php

/* Signal to footer.php that the main layout (with sidebar) has been loaded,
so that it closes the .wrapper and .content containers correctly. */
$renderMainLayout = true;

// Identify the current controller from the URL to mark the active menu item
$currentPath = strtolower(parse_url($_SERVER['REQUEST_URI'] ?? '', PHP_URL_PATH) ?? '');
$isActive = static fn (string $controller): string =>
    str_contains($currentPath, '/' . $controller) ? ' active' : '';
?>

<!-- div start content -->
<div class="content">
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        <!-- Sidebar header: menu icon + logo -->
        <div class="sidebar__header">
            <div class="sidebar__bars" id="sidebar-toggle" title="Menu">
                <i class="fa-solid fa-bars"></i>
            </div>
            <a href="<?= \Core\Config::url() ?>/dashboard/index" class="sidebar__brand">
                <img src="<?= \Core\Config::url() ?>/assets/img/system/logo.png" alt="SGS" class="sidebar__logo">
            </a>
        </div>

        <a href="<?= \Core\Config::url() ?>/dashboard/index" class="sidebar__nav<?= $isActive('dashboard') ?>">
            <i class="icon fa-solid fa-house"></i><span>Dashboard</span>
        </a>

        <a href="<?= \Core\Config::url() ?>/users/index" class="sidebar__nav<?= $isActive('users') ?>">
            <i class="icon fa-solid fa-users"></i><span>Usuários</span>
        </a>

        <a href="<?= \Core\Config::url() ?>/access-levels/index" class="sidebar__nav<?= $isActive('access-level') ?>">
            <i class="icon fa-solid fa-user-shield"></i><span>Níveis de Acesso</span>
        </a>

        <a href="<?= \Core\Config::url() ?>/page-types/index" class="sidebar__nav<?= $isActive('page-type') ?>">
            <i class="icon fa-solid fa-layer-group"></i><span>Tipos de Página</span>
        </a>

        <a href="<?= \Core\Config::url() ?>/page-modules/index" class="sidebar__nav<?= $isActive('page-module') ?>">
            <i class="icon fa-solid fa-cubes"></i><span>Módulos de Página</span>
        </a>

        <a href="<?= \Core\Config::url() ?>/pages/index" class="sidebar__nav<?= $isActive('pages') ?>">
            <i class="icon fa-solid fa-file-lines"></i><span>Páginas</span>
        </a>

        <a href="<?= \Core\Config::url() ?>/config-emails/index" class="sidebar__nav<?= $isActive('config-emails') ?>">
            <i class="icon fa-solid fa-envelope"></i><span>Configurações de Emails</span>
        </a>

        <a href="<?= \Core\Config::url() ?>/view-profile/index" class="sidebar__nav<?= $isActive('view-profile') ?>">
            <i class="icon fa-solid fa-user"></i><span>Perfil</span>
        </a>

        <a href="<?= \Core\Config::url() ?>/logout/index" class="sidebar__nav<?= $isActive('logout') ?>">
            <i class="icon fa-solid fa-arrow-right-from-bracket"></i><span>Sair</span>
        </a>
    </div>
    <!-- End sidebar -->

    <!-- Start page content -->
    <div class="wrapper">
