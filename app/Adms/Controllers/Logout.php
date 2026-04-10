<?php

namespace App\Adms\Controllers;

use App\Helpers\Flash;
use App\Helpers\Redirect;

class Logout 
{
    public function index(): void
    {
        unset(
            $_SESSION['user_name'], 
            $_SESSION['user_email'], 
            $_SESSION['user_id'], 
            $_SESSION['user_nickname'], 
            $_SESSION['user_image'],
            $_SESSION['user_situation_id'],
            $_SESSION['access_level'],  
            $_SESSION['order_level']
        );     

        Flash::info("Logout realizado com sucesso!");
        Redirect::to("login/index");
    }
}