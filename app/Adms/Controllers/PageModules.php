<?php

namespace App\Adms\Controllers;

use Core\ConfigView;
// use App\adms\Models\helpers\SidebarMenuPermissions;
use App\Adms\Models\ListPageModulesModel;

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
        // $this->data['sidebar_menu'] = SidebarMenuPermissions::checkPermissionsSidebarMenus();
        $this->viewPageModules();
    }

    private function viewPageModules(): void
    {
        $view = new ConfigView("Adms/Views/pagemodules/pageModules", $this->data);
        $view->loadView();
    }

}
