<?php

namespace App\Adms\Controllers;

use App\Adms\Models\ListUsersModel;
use App\Helpers\ButtonPermissions;
use Core\ConfigView;

class Users
{
    public function index(int|string|null $page = null): void
    {
        $page = (int) $page ? $page : 1;
        $listUsers = new ListUsersModel();
        $users = $listUsers->list($page);

        $data['users'] = is_array($users) ? $users : [];
        $data['pagination'] = $listUsers->getPagination();

        $buttons = [
            'add'    => ['menu_controller' => 'add-user', 'menu_method' => 'index'],
            'view'   => ['menu_controller' => 'view-user', 'menu_method' => 'index'],
            'update' => ['menu_controller' => 'update-user', 'menu_method' => 'index'],
            'delete' => ['menu_controller' => 'delete-user', 'menu_method' => 'index']
        ];
       
        $data['buttonpermissions'] = ButtonPermissions::checkPermissionsButtons($buttons);

        $view = new ConfigView("Adms/Views/users/users", $data);
        $view->loadView();
    }
}