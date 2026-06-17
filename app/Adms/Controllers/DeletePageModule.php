<?php

namespace App\Adms\Controllers;

use App\Adms\Models\DeletePageModuleModel;
use App\Helpers\Flash;
use App\Helpers\Redirect;

class DeletePageModule
{
    public function index(string|int $id)
    {
        $id = (int) $id;
        if (!empty($id)) {
            $delete = new DeletePageModuleModel();
            $delete->delete($id);
            Redirect::to('page-modules/index');
        }
        else {
            Flash::danger("Módulo de página não encontrado!");
            Redirect::to('page-modules/index');
        }
    }
}
