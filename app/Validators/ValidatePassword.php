<?php

namespace App\Validators;

use App\Helpers\Flash;

class ValidatePassword
{
    private static bool $result = false;
    private const MIN_LENGTH = 6;

    public static function getResult(): bool
    {
        return self::$result;
    }

    /**
     * Static function to validate password
     * @param string $password
     * @return void
     */
    public static function validate(string $password): void
    {
        $regex = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).+$/';

        if (strlen($password) < self::MIN_LENGTH) {
            Flash::danger("A senha deve ter no mínimo 6 caracteres!");
            self::$result = false;
            return;
        } 
        else if (! preg_match($regex, $password)) {
            Flash::danger("A senha deve conter pelo menos uma letra maiúscula, uma letra minúscula e um número!");
            self::$result = false;
            return;
        } 
        else if (stristr($password, "'")) {
            Flash::danger("Caractere ( ' ) não permitido!");
            self::$result = false;
            return;
        }
        else {
            self::$result = true;
        }
    }
}
