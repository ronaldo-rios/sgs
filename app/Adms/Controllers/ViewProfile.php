<?php

namespace App\Adms\Controllers;

use Core\ConfigView;
use App\adms\Models\helpers\SidebarMenuPermissions;
use App\Adms\Models\ViewProfileModel;
use App\Helpers\Flash;
use App\Helpers\Redirect;

class ViewProfile
{
    private ?array $data = [];

    public function index(): void
    {
        $profile = new ViewProfileModel();
        $infoProfile = $profile->get();

        if (! empty($infoProfile)) {
            $this->data['profile'] = $infoProfile;
            // $this->data['sidebar_menu'] = SidebarMenuPermissions::checkPermissionsSidebarMenus();
            $this->viewProfile();
        }
        else {
            Flash::danger('Usuário não encontrado!');
            Redirect::to('login/index'); 
        }
    }

    private function viewProfile(): void
    {
        $view = new ConfigView("Adms/Views/profile/viewProfile", $this->data);
        $view->loadView();
    }
}