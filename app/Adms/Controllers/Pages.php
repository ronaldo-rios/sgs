<?php

namespace App\Adms\Controllers;

use Core\ConfigView;
use App\Adms\Models\ListPagesModel;
use App\Helpers\ButtonPermissions;

class Pages
{
    private array $data;

    public function index(int|string|null $page = null): void
    {
        $page = (int) $page ? $page : 1;
        $pages = new ListPagesModel();
        $pagesResult = $pages->list($page);

        if($pagesResult !== []){
            $this->data['pages'] = $pagesResult;
            $this->data['pagination'] = $pages->getPagination();
        } else {
            $this->data['pages'] = [];
        }

        $buttons = [
            'add'    => ['menu_controller' => 'add-page', 'menu_method' => 'index'],
            'view'   => ['menu_controller' => 'view-page', 'menu_method' => 'index'],
            'update' => ['menu_controller' => 'update-page', 'menu_method' => 'index'],
            'delete' => ['menu_controller' => 'delete-page', 'menu_method' => 'index']
        ];

        $this->data['buttonpermissions'] = ButtonPermissions::checkPermissionsButtons($buttons);
        $this->viewPages();
    }

    private function viewPages(): void
    {
        $view = new ConfigView("Adms/Views/pages/pages", $this->data);
        $view->loadView();
    }

}
