<?php

namespace App\adms\Controllers;

use App\Adms\Models\RecoverPasswordModel;
use App\Helpers\Redirect;

class RecoverPassword
{
    private string|array|null $data = null;

    public function index(): void
    {
        $formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
        ! empty($formData['sendRecoverPassword']) 
            ? $this->recoverPassword($formData) : $this->viewRecoverPassword();
    }

    private function viewRecoverPassword(): void
    {
        $view = new \Core\ConfigView("Adms/Views/login/recoverPassword");
        $view->loadViewLogin();
    }

    private function recoverPassword(array $formData): void
    {
        $recoverPassword = new RecoverPasswordModel();
        $recoverPassword->recover($formData)
            ? Redirect::to("login/index")
            : $this->viewRecoverPassword();
    }
}