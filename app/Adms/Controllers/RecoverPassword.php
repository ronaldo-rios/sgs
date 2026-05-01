<?php

namespace App\Adms\Controllers;

use App\Adms\Models\RecoverPasswordModel;
use App\Helpers\Redirect;
use Core\ConfigView;

class RecoverPassword
{
    public function index(): void
    {
        $formData = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
        ! empty($formData['send_recover_password']) 
            ? $this->recoverPassword($formData) : $this->viewRecoverPassword();
    }

    private function viewRecoverPassword(): void
    {
        $view = new ConfigView('Adms/Views/login/recoverPassword');
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