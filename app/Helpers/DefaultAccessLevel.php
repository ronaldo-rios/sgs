<?php

namespace App\Helpers;

use App\Helpers\Connection;
use Core\Config;

class DefaultAccessLevel
{
    private static ?int $defaultId = null;

    /**
     * Resolve the access level assigned to newly registered users.
     * The default is declared in the database (is_default = 1)
     */
    public static function getId(): int
    {
        if (self::$defaultId !== null) {
            return self::$defaultId;
        }

        $conn = Connection::connect(Config::db());
        $id = $conn->query("SELECT `id` 
            FROM `access_levels` 
            WHERE `is_default` = 1 
            LIMIT 1"
        )->fetchColumn();

        return self::$defaultId = $id !== false
            ? (int) $id
            : throw new \RuntimeException('Nenhum nível padrão de acesso configurado.');
    }
}
