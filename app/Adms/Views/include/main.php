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

        <?php
        // Menu items driven by the access level's permissions (enable_in_sidebar = 1).
        $sidebarMenuItems = \App\Helpers\SidebarMenuPermissions::checkPermissionsSidebarMenus();
        foreach ($sidebarMenuItems as $menuItem):
        ?>
            <a href="<?= \Core\Config::url() ?>/<?= $menuItem['controller_in_the_main'] ?>/<?= $menuItem['method_in_the_main'] ?>" class="sidebar__nav<?= $isActive($menuItem['controller_in_the_main']) ?>">
                <i class="icon <?= $menuItem['icon'] ?>"></i><span><?= $menuItem['name_page'] ?></span>
            </a>
        <?php endforeach ?>

        <!-- Always visible: logout is not stored as a sidebar page (enable_in_sidebar = 0) -->
        <a href="<?= \Core\Config::url() ?>/logout/index" class="sidebar__nav<?= $isActive('logout') ?>">
            <i class="icon fa-solid fa-arrow-right-from-bracket"></i><span>Sair</span>
        </a>
    </div>
    <!-- End sidebar -->

    <!-- Start page content -->
    <div class="wrapper">
