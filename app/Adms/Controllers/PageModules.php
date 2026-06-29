<?php

namespace App\Adms\Controllers;

use Core\ConfigView;
use App\Adms\Models\ListPageModulesModel;
use App\Helpers\ButtonPermissions;

class PageModules
{
    private array $data;

    public function index(int|string|null $page = null): void
    {
        $page = (int) $page ? $page : 1;
        $pageModules = new ListPageModulesModel();
        $pageModulesResult = $pageModules->list($page);

        if($pageModulesResult !== []){
            $this->data['pagemodules'] = $pageModulesResult;
            $this->data['pagination'] = $pageModules->getPagination();
        } else {
            $this->data['pagemodules'] = [];
        }

        $buttons = [
            'add'    => ['menu_controller' => 'add-page-module', 'menu_method' => 'index'],
            'view'   => ['menu_controller' => 'view-page-module', 'menu_method' => 'index'],
            'update' => ['menu_controller' => 'update-page-module', 'menu_method' => 'index'],
            'delete' => ['menu_controller' => 'delete-page-module', 'menu_method' => 'index']
        ];

        $this->data['buttonpermissions'] = ButtonPermissions::checkPermissionsButtons($buttons);
        $this->viewPageModules();
    }

    private function viewPageModules(): void
    {
        $view = new ConfigView("Adms/Views/pagemodules/pageModules", $this->data);
        $view->loadView();
    }

}
