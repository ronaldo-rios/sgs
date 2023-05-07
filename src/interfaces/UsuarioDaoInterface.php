<?php

namespace src\interfaces;

use src\models\Usuario;

interface UsuarioDaoInterface
{
    public function findByEmail($email);
    public function findByToken($token);
    public function findByCpf($cpf);
    public function findBySiap($siap);
    public function findByCrm($crm);
    public function findById($id);
    public function findAll();
    public function inserirUsuario(Usuario $u);
    public function atualizarUsuario(Usuario $u);
    public function deletarUsuario(Usuario $u);
}