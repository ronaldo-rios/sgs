<?php

namespace App\Adms\Controllers;

use App\Adms\Models\ViewUserModel;
use App\Helpers\Flash;
use App\Helpers\Redirect;
use Core\ConfigView;

class ViewUser
{
    private ?array $data = [];

    public function index(int $id): void
    {
        if (! empty($id)) {
            $idUser = (int) $id;
            $user = new ViewUserModel();
            $userDetails = $user->viewInfo($idUser);

            if ($userDetails !== []) {
                $this->data['viewUser'] = $userDetails;
                $this->viewUserDetails();
            } else {
                Flash::danger('Usuário não encontrado!');
                Redirect::to("users/index");
            }
        }
        else {
            Flash::danger('Usuário não encontrado!');
            Redirect::to("users/index");
        }
    }

    private function viewUserDetails(): void
    {
        $view = new ConfigView("Adms/Views/users/viewUser", $this->data);
        $view->loadView();
    }
}