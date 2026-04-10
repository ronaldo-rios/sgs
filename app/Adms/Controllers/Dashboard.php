<?php

namespace App\Adms\Controllers;

use Core\ConfigView;

class Dashboard 
{
    private array $data = [];

    public function index(): void
    {
        $this->data = [
            'welcome' => "Bem Vindo(a), {$_SESSION['user_name']}!"
        ];

        $view = new ConfigView("Adms/Views/dashboard/dashboard", $this->data);
        $view->loadView();
    }
}