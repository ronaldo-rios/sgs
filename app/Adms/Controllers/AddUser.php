<?php

namespace App\Adms\Controllers;

use App\Adms\Models\AddNewUserModel;
use App\Helpers\Redirect;
use Core\ConfigView;

class AddUser
{
    public function index(): void
    {
        $formData = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
        ! empty($formData['send_add_user']) ? $this->addUser($formData) : $this->viewAddUser();
    }

    private function addUser(array $formData): void
    {
        $addUser = new AddNewUserModel();
        $added = $addUser->create($formData);

        $added ? Redirect::to("users/index") : $this->viewAddUser();
    }

    private function viewAddUser(): void
    {
        $view = new ConfigView("Adms/Views/users/addUser");
        $view->loadView();
    }
}