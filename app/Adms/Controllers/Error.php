<?php

namespace App\Adms\Controllers;

use Core\ConfigView;

class Error
{
    public function index(): void
    {
        $data['content'] = "<p>Erro: Página não encontrada</p>";

        $view = new ConfigView("Adms/Views/error/error", $data);
        $view->loadViewLogin();
    }
}