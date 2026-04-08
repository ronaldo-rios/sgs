<?php

namespace Core;

final class Redirect
{
    public static function to(string $path): never
    {
        header('Location: ' . Config::url() . $path);
        exit;
    }
}