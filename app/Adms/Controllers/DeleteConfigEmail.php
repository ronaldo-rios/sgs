<?php

namespace App\adms\Controllers;

use App\Adms\Models\DeleteConfigEmailModel;
use App\Helpers\Flash;
use App\Helpers\Redirect;

class DeleteConfigEmail
{
    public function index(int|string $id): void
    {
        $id = (int) $id;
        if (!empty($id)) {
            $delete = new DeleteConfigEmailModel();
            $delete->delete($id);
            Redirect::to('config-emails/index'); 
        }
        else {
            Flash::danger('Servidor de E-mail Não encontrado!');
            Redirect::to('config-emails/index'); 
        }
    }

}