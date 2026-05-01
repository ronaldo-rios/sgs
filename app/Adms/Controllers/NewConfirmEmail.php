<?php

namespace App\adms\Controllers;

use Core\ConfigView;
use App\Adms\Models\NewConfirmEmailModel;
use App\Helpers\Redirect;

class NewConfirmEmail
{
    public function index(): void
    {
        $formData = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW) ?? [];
       
        ! empty($formData['send_new_confirm_email'])
            ? $this->getNewConfirmEmail($formData)
            : $this->viewNewConfirmEmail();
    }

    private function viewNewConfirmEmail(): void
    {
        $view = new ConfigView("Adms/Views/login/newConfirmEmail");
        $view->loadViewLogin();
    }

    private function getNewConfirmEmail(array $formData): void
    {
        $newConfirmEmail = new NewConfirmEmailModel();

        $newConfirmEmail->newConfirmEmail($formData)
            ? Redirect::to("login/index")
            : $this->viewNewConfirmEmail();
        
    }
}