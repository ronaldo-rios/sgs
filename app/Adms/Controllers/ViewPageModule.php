<?php

namespace App\Adms\Controllers;

use App\Adms\Models\ViewPageModuleModel;
use App\Helpers\Flash;
use App\Helpers\Redirect;
use Core\ConfigView;

class ViewPageModule
{
    private ?array $data = [];

    public function index(int|string $id): void
    {
        if (! empty($id)) {
            $id = (int) $id;
            $pageModule = new ViewPageModuleModel();
            $details = $pageModule->viewInfo($id);

            if ($details !== []) {
                $this->data['pagemodule'] = $details;
                $this->viewPageModuleDetails();
            } else {
                Flash::danger('Módulo de página não encontrado!');
                Redirect::to("page-modules/index");
            }
        }
        else {
            Flash::danger('Módulo de página não encontrado!');
            Redirect::to("page-modules/index");
        }
    }

    private function viewPageModuleDetails(): void
    {
        $view = new ConfigView("Adms/Views/pagemodules/viewPageModule", $this->data);
        $view->loadView();
    }
}
