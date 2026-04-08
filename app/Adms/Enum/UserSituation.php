<?php

namespace App\Adms\Enum;

enum UserSituation: int
{
    case CONFIRMED_EMAIL = 1;
    case WAITING_FOR_CONFIRMATION = 2; 
    case NOT_REGISTERED = 3;
}