<?php

namespace Core;

final class Config
{
    public const CONTROLLER = 'Login';
    public const METHOD = 'index';
    public const CONTROLLER_ERROR = 'Login';
    public const PATH_USER_IMAGE = '/public/assets/img/users/';
    public const ACCESS_LEVEL_USER_DEFAULT = 6;

    public static function url(): string
    {
        return getenv('URL_BASE') ?: throw new \RuntimeException('Missing required environment variable: URL_BASE');
    }

    public static function db(): array
    {
        return [
            'host'     => getenv('MYSQL_HOST') ?: throw new \RuntimeException('Missing required environment variable: MYSQL_HOST'),
            'user'     => getenv('MYSQL_USER') ?: throw new \RuntimeException('Missing required environment variable: MYSQL_USER'),
            'password' => getenv('MYSQL_PASSWORD') ?: throw new \RuntimeException('Missing required environment variable: MYSQL_PASSWORD'),
            'database' => getenv('MYSQL_DATABASE') ?: throw new \RuntimeException('Missing required environment variable: MYSQL_DATABASE'),
            'port'     => (int) (getenv('MYSQL_PORT') ?: 3306),
        ];
    }

    public static function admEmail(): string
    {
        return getenv('ADM_EMAIL') ?: '';
    }
}
