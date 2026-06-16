<?php

namespace App\adms\Controllers;

use Core\ConfigView;
// use App\adms\Models\helpers\SidebarMenuPermissions;
use App\Adms\Models\ListPageTypesModel;

class PageTypes
{
    private array $data;

    public function index(int|string|null $page = null): void
    {
        $page = (int) $page ? $page : 1;
        $pageTypes = new ListPageTypesModel();
        $pageTypesResult = $pageTypes->list($page);

        if($pageTypesResult !== []){
            $this->data['page_types'] = $pageTypesResult;
            $this->data['pagination'] = $pageTypes->getPagination();
        } else {
            $this->data['page_types'] = [];
        }
        // $this->data['sidebar_menu'] = SidebarMenuPermissions::checkPermissionsSidebarMenus();
        $this->viewPageTypes();
    }

    private function viewPageTypes(): void
    {
        $view = new ConfigView("Adms/Views/pagetypes/pageTypes", $this->data);
        $view->loadView();
    }

}