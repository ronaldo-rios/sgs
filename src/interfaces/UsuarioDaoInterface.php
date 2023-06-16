<?php

declare(strict_types=1);

namespace src\interfaces;

use src\models\Usuario;

interface UsuarioDaoInterface
{
    public function findByEmail($email): Usuario;
    public function findByToken($token): Usuario;
    public function findById(int $id): Usuario;
    public function findAll(): array;
    public function inserirUsuario(Usuario $u): Usuario;
    public function atualizarUsuario(Usuario $u): bool;
    public function deletarUsuario(Usuario $u): bool;
    public function emailExists($email): bool;
}