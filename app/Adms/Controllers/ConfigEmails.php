<?php

namespace App\Adms\Controllers;

use App\adms\Models\helpers\SidebarMenuPermissions;
use App\Adms\Models\ListConfigEmailsModel;
use Core\ConfigView;

class ConfigEmails
{
    private ?array $data = [];

    public function index(int|string|null $page = null): void
    {
        $page = (int) $page ? $page : 1;
        $emailServers = new ListConfigEmailsModel();
        $response = $emailServers->getEmails($page);

        $this->data['emails'] = $response;
        $this->data['pagination'] = $emailServers->getPagination();
        // $this->data['sidebar'] = SidebarMenuPermissions::checkPermissionsSidebarMenus();
        $this->viewEmailServers();
    }

    private function viewEmailServers(): void
    {
        $loadView = new ConfigView("Adms/Views/emailconfig/configEmails", $this->data);
        $loadView->loadView();
    }
}
