<?php

namespace App\adms\Controllers;

use Core\ConfigView;
use App\Adms\Models\NewConfirmEmailModel;
use App\Helpers\Redirect;

class NewConfirmEmail
{
    public function index(): void
    {
        $formData = filter_input_array(INPUT_POST, FILTER_DEFAULT) ?? [];
       
        ! empty($formData['sendNewConfirmEmail'])
            ? $this->getNewConfirmEmail($formData)
            : $this->viewNewConfirmEmail();
    }

    private function viewNewConfirmEmail(): void
    {
        $view = new ConfigView("Adms/Views/login/newConfirmEmail");
        $view->loadViewLogin();
    }

    private function getNewConfirmEmail($formData): void
    {
        $newConfirmEmail = new NewConfirmEmailModel();

        $newConfirmEmail->newConfirmEmail($formData)
            ? Redirect::to("login/index")
            : $this->viewNewConfirmEmail();
        
    }
}