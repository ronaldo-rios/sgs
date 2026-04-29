<?php

namespace App\Adms\Controllers;

use App\Adms\Models\ListUsersModel;
use Core\ConfigView;

class Users
{
    public function index(int|string|null $page = null): void
    {
        $page = (int) $page ? $page : 1;
        $listUsers = new ListUsersModel();
        $users = $listUsers->list($page);

        $data['users'] = is_array($users) ? $users : [];
        // $this->data['pagination'] = $listUsers->getPagination();

        // $buttons = [
        //     'add_user' => ['menu_controller' => 'add-user', 'menu_method' => 'index'],
        //     'view_user' => ['menu_controller' => 'view-user', 'menu_method' => 'index'],
        //     'edit_user' => ['menu_controller' => 'edit-user', 'menu_method' => 'index'],
        //     'delete_user' => ['menu_controller' => 'delete-user', 'menu_method' => 'index']
        // ];
       
        // $this->data['button_permissions'] = ButtonPermissions::checkPermissionsButtons($buttons);
        // $this->data['sidebar_menu'] = SidebarMenuPermissions::checkPermissionsSidebarMenus();

        $view = new ConfigView("Adms/Views/users/users", $data);
        $view->loadView();
    }
}