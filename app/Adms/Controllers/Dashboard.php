<?php

namespace App\Adms\Controllers;

use Core\ConfigView;

class Dashboard
{
    private array $data = [];

    public function index(): void
    {
        $view = new ConfigView('Adms/Views/dashboard/dashboard', $this->data);
        $view->loadView();
    }
}