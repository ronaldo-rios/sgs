<?php

namespace App\Adms\Controllers;

use App\Adms\Models\UpdatePageModuleModel;
use App\Helpers\Flash;
use Core\ConfigView;
use App\Helpers\Redirect;

class UpdatePageModule
{
    private ?array $data = [];

    public function index(string|int $id)
    {
        $formData = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

        if(! empty($id) && empty($formData['send_update_page_module'])) {
            $id = (int) $id;
            $pageModule = new UpdatePageModuleModel();
            $details = $pageModule->viewInfoPageModule($id);

            if ($details !== []) {
                $this->data['pagemodule'] = $details;
                $this->viewEditPageModule();
            } else {
                Flash::danger("Módulo de página não encontrado!");
                Redirect::to("page-modules/index");
            }
        }
        else {
            $this->editPageModule($formData);
        }
    }

    private function viewEditPageModule(): void
    {
        $view = new ConfigView("Adms/Views/pagemodules/updatePageModule", $this->data);
        $view->loadView();
    }

    private function editPageModule(?array $formData): void
    {
        if (! empty($formData['send_update_page_module'])) {
            $pageModule = new UpdatePageModuleModel();
            $updated = $pageModule->update($formData);
            if ($updated) {
                Redirect::to("page-modules/index");
            }
            else {
                $this->data['pagemodule'] = $formData;
                $this->viewEditPageModule();
            }
        }
        else {
            Flash::danger("Módulo de página não encontrado!");
            Redirect::to("page-modules/index");
        }
    }
}
