<?php

namespace App\Adms\Controllers;

use App\Adms\Models\ListAccessLevelsModel;
use Core\ConfigView;

class AccessLevels
{
    private ?array $data = [];

    public function index(): void
    {
        $accessLevels = new ListAccessLevelsModel();
        $listLevels = $accessLevels->listLevels();

        $listLevels !== []
            ? $this->data['accesslevels'] = $listLevels
            : $this->data['accesslevels'] = [];

        // $this->data['sidebar_menu'] = SidebarMenuPermissions::checkPermissionsSidebarMenus();
        $view = new ConfigView("Adms/Views/accesslevel/accessLevels", $this->data);
        $view->loadView();
    }
}