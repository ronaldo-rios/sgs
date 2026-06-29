<?php

namespace App\Adms\Controllers;

use App\Adms\Models\ListAccessLevelsModel;
use App\Helpers\ButtonPermissions;
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

        $buttons = [
            'add'         => ['menu_controller' => 'add-access-level', 'menu_method' => 'index'],
            'permissions' => ['menu_controller' => 'permissions', 'menu_method' => 'index'],
            'sync'        => ['menu_controller' => 'sync-page-levels', 'menu_method' => 'index'],
            'view'        => ['menu_controller' => 'view-access-level', 'menu_method' => 'index'],
            'update'      => ['menu_controller' => 'update-access-level', 'menu_method' => 'index'],
            'delete'      => ['menu_controller' => 'delete-access-level', 'menu_method' => 'index']
        ];

        $this->data['buttonpermissions'] = ButtonPermissions::checkPermissionsButtons($buttons);
        $view = new ConfigView("Adms/Views/accesslevel/accessLevels", $this->data);
        $view->loadView();
    }
}