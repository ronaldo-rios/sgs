<?php

namespace App\adms\Controllers;

use App\Adms\Models\ConfirmEmailModel;
use App\Helpers\Flash;
use App\Helpers\Redirect;

class ConfirmEmail
{
    public function index(): void
    {
        $key = (string) filter_input(INPUT_GET, "key", FILTER_DEFAULT);
        if (! empty($key)) {
            $this->validateKey($key);
        }
    }

    private function validateKey(string $key): void
    {
        $confirmEmail = new ConfirmEmailModel();
        $confirmed = $confirmEmail->confirm($key);

        if($confirmed) {
            Redirect::to('login/index');
        }
        
        Flash::danger('Link inválido!');
        Redirect::to('login/index');
    }
}