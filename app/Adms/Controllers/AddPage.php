<?php

namespace App\Adms\Controllers;

use App\Adms\Models\AddPageModel;
use App\Helpers\Redirect;
use Core\ConfigView;

class AddPage
{
    private ?array $data = [];

    public function index(): void
    {
        $formData = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

        ! empty($formData['send_add_page'])
            ? $this->addPage($formData)
            : $this->viewAddPage();
    }

    private function addPage(?array $formData): void
    {
        $this->data = $formData;

        $addPage = new AddPageModel();
        $added = $addPage->add($formData);

        $added ? Redirect::to("pages/index") : $this->viewAddPage();
    }

    private function viewAddPage(): void
    {
        $addPage = new AddPageModel();
        $this->data['page_types'] = $addPage->listPageTypes();
        $this->data['page_modules'] = $addPage->listPageModules();

        $view = new ConfigView("Adms/Views/pages/addPage", $this->data);
        $view->loadView();
    }
}
