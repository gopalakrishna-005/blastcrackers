<?php

namespace App\Enum;

enum UserRole:string
{
    case SUPERADMIN = 'superadmin';
    case ADMIN      = 'admin';
    case USER       = 'user';
    case GUEST      = 'guest';
}