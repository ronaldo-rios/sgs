<?php

namespace App\adms\Controllers;

use Core\ConfigView;
use App\Adms\Models\ListPermissionsModel;
use App\Helpers\ButtonPermissions;

class Permissions
{
    private ?array $data = [];

    public function index(string|int|null $page = null): void
    {
        $accessLevelId = (int) filter_input(INPUT_GET, 'level', FILTER_SANITIZE_NUMBER_INT);
        $page = (int) $page ? $page : 1;
       
        $permissions = new ListPermissionsModel();
        $resultPermissions = $permissions->listPermissions($accessLevelId, $page);
        
        if ($resultPermissions !== []) {
            $this->data['permissions'] = $resultPermissions;
            $this->data['accesslevels'] = $permissions->getAccessLevel();
            $this->data['pagination'] = $permissions->getPagination();
        } else {
            $this->data['permissions'] = [];
            $this->data['accesslevels'] = '';
            $this->data['pagination'] = null;
        }

        $this->data['page'] = $page;

        $buttons = [
            'update' => ['menu_controller' => 'update-permission', 'menu_method' => 'index']
        ];

        $this->data['buttonpermissions'] = ButtonPermissions::checkPermissionsButtons($buttons);

        $view = new ConfigView('Adms/Views/permissions/permissions', $this->data);
        $view->loadView();
    }
}