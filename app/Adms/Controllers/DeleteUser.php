<?php

namespace App\Adms\Controllers;

use App\Adms\Models\DeleteUserModel;
use App\Helpers\Flash;
use App\Helpers\Redirect;

class DeleteUser
{
    public function index(int|string $id): void
    {
        $userId = (int) $id;
        if (!empty($userId)) {
            $deleteUser = new DeleteUserModel();
            $deleteUser->delete($userId);
            
            Redirect::to('users/index');
        }
        else {
            Flash::danger('Usuário não encontrado!');
            Redirect::to('users/index');
        }

    }
}