<?php

namespace App\Adms\Controllers;

use App\Adms\Models\LoginModel;
use Core\ConfigView;
use App\Helpers\Redirect;

class Login
{
    public function index(): void
    {
        $formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);
       
        if (! empty($formData['sendLogin'])) {
            $validateLogin = new LoginModel();
            
            if ($validateLogin->login($formData)) {
                Redirect::to("dashboard/index");
            }  
        } 

        $view = new ConfigView("Adms/Views/login/login");
        $view->loadViewLogin();
    }
}