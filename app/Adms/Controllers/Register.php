<?php

namespace App\Adms\Controllers;

use App\Adms\Models\AddNewUserModel;
use App\Helpers\Redirect;
use Core\ConfigView;

class Register
{
    private ?array $data = [];

    public function index(): void
    {
        $formData = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

        if(! empty($formData['send_new_user'])) {
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