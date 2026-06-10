<?php

namespace App\Adms\Controllers;

use App\Adms\Models\DeleteAccessLevelModel;
use App\Helpers\Flash;
use App\Helpers\Redirect;

class DeleteAccessLevel
{
    public function index(string|int $id)
    {
        $id = (int) $id;
        if (!empty($id)) {
            $delete = new DeleteAccessLevelModel(); 
            $delete->delete($id);
            Redirect::to('access-levels/index'); 
        }
        else {
            Flash::danger("Nível de Acesso não encontrado!");
            Redirect::to('access-levels/index'); 
        }
    }
}