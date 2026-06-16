<?php

namespace App\Adms\Controllers;

use App\Adms\Models\AddPageTypeModel;
use App\Helpers\Redirect;
use Core\ConfigView;

class AddPageType
{
    private ?array $data = []; 

    public function index(): void
    {
        $formData = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

        ! empty($formData['send_add_page_type']) 
            ? $this->addPageType($formData)
            : $this->viewAddPageType();
    }

    private function addPageType(?array $formData): void
    {
        $this->data = $formData;

        $addPageGroup = new AddPageTypeModel();
        $added = $addPageGroup->add($formData);

        $added ? Redirect::to("page-types/index") : $this->viewAddPageType();
    }

    private function viewAddPageType(): void
    {
        $view = new ConfigView("Adms/Views/pagetypes/addPageType", $this->data);
        $view->loadView();
    }
}