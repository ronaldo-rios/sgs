<?php

namespace App\Adms\Controllers;

use App\Adms\Models\AddPageModuleModel;
use App\Helpers\Redirect;
use Core\ConfigView;

class AddPageModule
{
    private ?array $data = [];

    public function index(): void
    {
        $formData = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

        ! empty($formData['send_add_page_module'])
            ? $this->addPageModule($formData)
            : $this->viewAddPageModule();
    }

    private function addPageModule(?array $formData): void
    {
        $this->data = $formData;

        $addPageModule = new AddPageModuleModel();
        $added = $addPageModule->add($formData);

        $added ? Redirect::to("page-modules/index") : $this->viewAddPageModule();
    }

    private function viewAddPageModule(): void
    {
        $view = new ConfigView("Adms/Views/pagemodules/addPageModule", $this->data);
        $view->loadView();
    }
}
