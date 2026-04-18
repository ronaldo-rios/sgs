<?php

namespace App\Adms\Controllers;

use App\Helpers\Flash;
use Core\ConfigView;

class Error
{
    private array $data = [];

    public function index(): void
    {
        $this->data = [
            'content' => Flash::danger("<p>Erro: Página não encontrada</p>")
        ];

        $view = new ConfigView("Adms/Views/error/error", $this->data);
        $view->loadView();
    }
}