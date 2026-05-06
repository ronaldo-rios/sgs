<?php

namespace App\Adms\Controllers;

use App\adms\Models\helpers\SidebarMenuPermissions;
use App\Adms\Models\ListConfigEmailsModel;
use App\Helpers\Flash;
use App\Helpers\Redirect;

class ConfigEmails
{
    private ?array $data = [];

    public function index(int|string|null $page = null): void
    {
        $page = (int) $page ? $page : 1;
        $emailServers = new ListConfigEmailsModel();
        $response = $emailServers->getEmails($page);
       
        if ($response !== []) {
            $this->data['emails'] = $response;
            $this->data['pagination'] = $emailServers->getPagination();
            // $this->data['sidebar_menu'] = SidebarMenuPermissions::checkPermissionsSidebarMenus();
            $this->viewEmailServers();
        }
        else {
            Flash::danger('Usuário não encontrado!');
            Redirect::to('login/index');
        }
    
    }

    private function viewEmailServers(): void
    {
        $loadView = new \Core\ConfigView("Adms/Views/emailconfig/configEmails", $this->data);
        $loadView->loadView();
    }
}