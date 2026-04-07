<?php

namespace Core;

final class Config
{
    public const CONTROLLER = 'Login';
    public const METHOD = 'index';
    public const CONTROLLER_ERROR = 'Login';
    public const PATH_USER_IMAGE = 'app/adms/assets/image/users/';

    public static function url(): string
    {
        return $_ENV['URL_BASE'];
    }

    public static function db(): array
    {
        return [
            'host'     => $_ENV['MYSQL_HOST'],
            'user'     => $_ENV['MYSQL_USER'],
            'password' => $_ENV['MYSQL_PASSWORD'],
            'database' => $_ENV['MYSQL_DATABASE'],
            'port'     => (int) $_ENV['MYSQL_PORT'],
        ];
    }
}
