<?php

namespace App\Helpers;

class Flash
{
    public static function success(string $message): void
    {
        $_SESSION['msg'] = "<div class='alert alert-success'>{$message}</div>";
    }

    public static function danger(string $message): void
    {
        $_SESSION['msg'] = "<div class='alert alert-danger'>{$message}</div>";
    }

    public static function info(string $message): void
    {
        $_SESSION['msg'] = "<div class='alert alert-info'>{$message}</div>";
    }

    public static function display(): void
    {
        if (isset($_SESSION['msg'])) {
            echo $_SESSION['msg'];
            unset($_SESSION['msg']);
        }
    }
}

