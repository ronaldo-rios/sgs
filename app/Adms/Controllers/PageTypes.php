<?php

namespace App\Adms\Controllers;

use Core\ConfigView;
use App\Adms\Models\ListPageTypesModel;
use App\Helpers\ButtonPermissions;

class PageTypes
{
    private array $data;

    public function index(int|string|null $page = null): void
    {
        $page = (int) $page ? $page : 1;
        $pageTypes = new ListPageTypesModel();
        $pageTypesResult = $pageTypes->list($page);

        if($pageTypesResult !== []){
            $this->data['pagetypes'] = $pageTypesResult;
            $this->data['pagination'] = $pageTypes->getPagination();
        } else {
            $this->data['pagetypes'] = [];
        }

        $buttons = [
            'add'    => ['menu_controller' => 'add-page-type', 'menu_method' => 'index'],
            'view'   => ['menu_controller' => 'view-page-type', 'menu_method' => 'index'],
            'update' => ['menu_controller' => 'update-page-type', 'menu_method' => 'index'],
            'delete' => ['menu_controller' => 'delete-page-type', 'menu_method' => 'index']
        ];

        $this->data['buttonpermissions'] = ButtonPermissions::checkPermissionsButtons($buttons);
        $this->viewPageTypes();
    }

    private function viewPageTypes(): void
    {
        $view = new ConfigView("Adms/Views/pagetypes/pageTypes", $this->data);
        $view->loadView();
    }

}