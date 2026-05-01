<?php

namespace App\Adms\Controllers;

use App\Adms\Models\UpdateUserModel;
use App\Helpers\Flash;
use App\Helpers\Redirect;
use Core\ConfigView;

class UpdateUser
{
    private ?array $data = [];

    public function index(int $id): void
    {
        $formData = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);

        if(! empty($id) && empty($formData['send_edit_user'])) {
            $id = (int) $id;
            $user = new UpdateUserModel();
            $userDetails = $user->viewInfoUser($id);
            
            if ($userDetails !== []) {
                $this->data['details'] = $userDetails;
                $this->viewEditUser();
            } else {
                Redirect::to("users/index");
            }
        }
        else {
            $this->editUser($formData);
        }
    }

    private function viewEditUser(): void
    {
        $dropdownSituations = new UpdateUserModel();
        $this->data['situation'] = $dropdownSituations->listSelectSituation();
        $this->data['level'] = $dropdownSituations->listSelectAccessLevel();
        $view = new ConfigView("Adms/Views/users/updateUser", $this->data);
        $view->loadView();
    }

    private function editUser(?array $formData): void
    {
        if (! empty($formData['send_edit_user'])) {

            $user = new UpdateUserModel();
            $edited = $user->edit($formData);

            if ($edited) {
                Redirect::to("view-user/index/{$formData['id']}");
            }
            else {
                $this->data['details'] = $formData;
                $this->viewEditUser();
            }
        }
        else {
            Flash::danger("Usuário não encontrado!");
            Redirect::to("users/index");
        }
    }
}