<?php

namespace App\Adms\Controllers;

use App\Adms\Models\AddAccessLevelModel;
use App\Helpers\Redirect;
use Core\ConfigView;

class AddAccessLevel
{
    private ?array $data = [];

    public function index(): void
    {
        $formData = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

        ! empty($formData['send_add_access_level']) 
            ? $this->addAccessLevel($formData)
            : $this->viewAddAccessLevel();
    }

    private function viewAddAccessLevel(): void
    {
        $view = new ConfigView("Adms/Views/accesslevel/addAccessLevel", $this->data);
        $view->loadView();
    }

    private function addAccessLevel(?array $formData): void
    {
        $this->data = $formData;

        $addAccessLevel = new AddAccessLevelModel();
        $added = $addAccessLevel->add($formData);

        $added ? Redirect::to("access-levels/index") : $this->viewAddAccessLevel();
        
    }
}