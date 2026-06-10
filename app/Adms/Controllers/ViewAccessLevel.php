<?php

namespace App\Adms\Controllers;

use App\Adms\Models\ViewAccessLevelModel;
use App\Helpers\Flash;
use App\Helpers\Redirect;
use Core\ConfigView;

class ViewAccessLevel
{
    private ?array $data = [];

    public function index(int|string $id): void
    {
        if (! empty($id)) {
            $id = (int) $id;
            $accessLevel = new ViewAccessLevelModel();
            $details = $accessLevel->viewInfo($id);

            if ($details !== []) {
                $this->data['accesslevel'] = $details;
                $this->viewAccessLevelDetails();
            } else {
                Flash::danger('Nível de acesso não encontrado!');
                Redirect::to("access-levels/index");
            }
        }
        else {
            Flash::danger('Nível de acesso não encontrado!');
            Redirect::to("access-levels/index");
        }
    }

    private function viewAccessLevelDetails(): void
    {
        $view = new ConfigView("Adms/Views/accesslevel/viewAccessLevel", $this->data);
        $view->loadView();
    }
}
