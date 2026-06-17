<?php

namespace App\Adms\Controllers;

use App\Adms\Models\DeletePageModel;
use App\Helpers\Flash;
use App\Helpers\Redirect;

class DeletePage
{
    public function index(string|int $id)
    {
        $id = (int) $id;
        if (!empty($id)) {
            $delete = new DeletePageModel();
            $delete->delete($id);
            Redirect::to('pages/index');
        }
        else {
            Flash::danger("Página não encontrada!");
            Redirect::to('pages/index');
        }
    }
}
