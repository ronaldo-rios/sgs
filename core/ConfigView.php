<?php

namespace Core;

class ConfigView
{
    public function __construct(private string $nameView, private ?array $data = [])
    {
    }

    /**
     * Check if the file exists, and load if it exists and is logged in, 
     * if it does not exist it displays the error message
     * @return void
     */
    public function loadView(): void
    {
        if(file_exists("app/{$this->nameView}.php")) {
            if (file_exists("app/Adms/Views/include/head.php")) {
                include "app/Adms/Views/include/head.php";
            }
            if (file_exists("app/Adms/Views/include/main.php")) {
                include "app/Adms/Views/include/main.php";
            }
                include "app/{$this->nameView}.php";
            if (file_exists("app/Adms/Views/include/footer.php")) {
                include "app/Adms/Views/include/footer.php";
            }
        } else {
            die("Erro ao carregar a view: {$this->nameView}. 
                Tente novamente ou entre em contato com o administrador: " . Config::admEmail()
            );
        }
    }

    /**
     * Load the login page and pages that do not need logged in
     * @return void
     */ 
    public function loadViewLogin(): void
    {
        if(file_exists("app/{$this->nameView}.php")) {
            if (file_exists("app/Adms/Views/include/head.php")) {
                include "app/Adms/Views/include/head.php";
            }
            include "app/{$this->nameView}.php";
            if (file_exists("app/Adms/Views/include/footer.php")) {
                include "app/Adms/Views/include/footer.php";
            }
        } else {
            die("Erro ao carregar a view: {$this->nameView}. 
                Tente novamente ou entre em contato com o administrador: " . Config::admEmail()
            );
        }
    }
}