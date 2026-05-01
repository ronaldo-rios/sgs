<?php

namespace App\Adms\Controllers;

use App\Adms\Models\UpdatePasswordModel;
use Core\ConfigView;
use App\Helpers\Flash;
use App\Helpers\Redirect;

class UpdatePassword
{
    private ?array $formData = [];

    public function index(): void
    {
        $keyHash = (string) filter_input(INPUT_GET, 'key', FILTER_UNSAFE_RAW);
        $this->formData = filter_input_array(INPUT_POST, FILTER_UNSAFE_RAW);
   
        ! empty($keyHash) && empty($this->formData['send_update_password'])
            ? $this->validateKey($keyHash)
            : $this->updatePassword($keyHash);
    }

    private function validateKey(string $key): void
    {
        $validate = new UpdatePasswordModel();
        
        if($validate->validate($key)) {
            $this->viewUpdatePassword();
        } else {
            Flash::danger('Link inválido!');
            Redirect::to('recover-password/index');
        }
    }

    private function viewUpdatePassword(): void
    {
        $view = new ConfigView("Adms/Views/login/updatePassword");
        $view->loadViewLogin();
    }

    private function updatePassword(string $key): void
    {
        if (! empty($this->formData['send_update_password'])) {
            $this->formData['key'] = $key;
            $updatePass = new UpdatePasswordModel();
            $updated = $updatePass->update($this->formData);

            $updated ? Redirect::to('login/index') : $this->viewUpdatePassword(); 
        }

        $this->viewUpdatePassword();
    }
}