<?php

namespace App\Adms\Controllers;

use App\Adms\Models\DeletePageTypeModel;
use App\Helpers\Flash;
use App\Helpers\Redirect;

class DeletePageType
{
    public function index(string|int $id)
    {
        $id = (int) $id;
        if (!empty($id)) {
            $delete = new DeletePageTypeModel();
            $delete->delete($id);
            Redirect::to('page-types/index');
        }
        else {
            Flash::danger("Tipo de página não encontrado!");
            Redirect::to('page-types/index');
        }
    }
}
