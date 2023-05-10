<?php 

namespace src\models;

final class Permissao
{
    public const MASTER = 'master';
    public const ADMIN = 'admin';
    public const MEDICO = 'medico';
    public const SERVIDOR = 'servidor';

    private function __construct()
    {
    }

    public static function validar(string $permissao): bool
    {
        return in_array($permissao, self::listar());
    }

    public static function listar(): array
    {
        return [
            self::MASTER,
            self::ADMIN,
            self::MEDICO,
            self::SERVIDOR,
        ];
    }
}
