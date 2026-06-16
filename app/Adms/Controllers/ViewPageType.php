<?php

namespace App\Adms\Controllers;

use App\Adms\Models\ViewPageTypeModel;
use App\Helpers\Flash;
use App\Helpers\Redirect;
use Core\ConfigView;

class ViewPageType
{
    private ?array $data = [];

    public function index(int|string $id): void
    {
        if (! empty($id)) {
            $id = (int) $id;
            $pageType = new ViewPageTypeModel();
            $details = $pageType->viewInfo($id);

            if ($details !== []) {
                $this->data['pagetype'] = $details;
                $this->viewPageTypeDetails();
            } else {
                Flash::danger('Tipo de página não encontrado!');
                Redirect::to("page-types/index");
            }
        }
        else {
            Flash::danger('Tipo de página não encontrado!');
            Redirect::to("page-types/index");
        }
    }

    private function viewPageTypeDetails(): void
    {
        $view = new ConfigView("Adms/Views/pagetypes/viewPageType", $this->data);
        $view->loadView();
    }
}
