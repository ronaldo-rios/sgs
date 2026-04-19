<?php

namespace App\Adms\Enum;

enum AccessLevels: int
{
    case SUPER_ADMIN = 1;
    case ADMIN = 2; 
    case USER_DEFAULT = 3;
}