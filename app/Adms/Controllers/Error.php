<?php

namespace App\Adms\Controllers;

use Core\ConfigView;

class Error
{
    public function index(): void
    {
        $data['code'] = "404";
        $data['title'] = "Página não encontrada";
        $data['message'] = "A página que você tentou acessar não existe ou você não tem permissão para visualizá-la.";

        $view = new ConfigView("Adms/Views/error/error", $data);
        $view->loadViewLogin();
    }
}
