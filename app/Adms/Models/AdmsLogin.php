<?php

namespace App\Adms\Models;

use PDO;
use App\Helpers\Connection;

class AdmsLogin
{
    private ?array $data;
    private object $conn;
    private bool $result = false;

    public function getResult(): bool
    {
        return $this->result;
    }

    public function login(array $data = null): void
    {
    }
}