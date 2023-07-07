<?php

namespace src\interfaces;

use src\models\Usuario;

interface UsuarioDaoInterface
{
    public function findByEmail($email);
    public function findByToken($token);
    public function findById($id);
    public function findAll();
    public function inserirUsuario(Usuario $u);
    public function atualizarUsuario(Usuario $u);
    public function deletarUsuario(Usuario $u);
    public function emailExists($email);
}