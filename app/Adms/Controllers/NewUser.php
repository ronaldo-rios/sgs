<?php

namespace App\Adms\Controllers;

use App\Adms\Models\AddNewUserModel;
use App\Helpers\Redirect;
use Core\ConfigView;

class NewUser
{
    private ?array $data = [];

    public function index(): void
    {
        $formData = filter_input_array(INPUT_POST, FILTER_DEFAULT);

        if(! empty($formData['sendNewUser'])) {
            $register = new AddNewUserModel();
            $register->create($formData)
                ? Redirect::to("login/index")
                : $this->viewNewUser();
        }
        else {
            $this->viewNewUser();
        }
    }

    private function viewNewUser(): void
    {
        $view = new ConfigView("Adms/Views/login/register", $this->data);
        $view->loadViewLogin();
    }
}