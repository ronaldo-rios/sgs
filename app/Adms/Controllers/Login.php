<?php

namespace App\Adms\Controllers;

use App\Adms\Models\AdmsLogin;
use Core\ConfigView;
use Core\Redirect;

class Login
{
    public function index(): void
    {
        $formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if (! empty($this->formData['sendLogin'])) {
            $validateLogin = new AdmsLogin();
            $validateLogin->login($formData);
            
            if($validateLogin->getResult()) {
                Redirect::to("dashboard/index");
            }  
        } 

        $view = new ConfigView("Adms/Views/login/login", null);
        $view->loadViewLogin();
    }
}