<?php
namespace App\Enums;

enum RoleEnums : string
{
    case ADMIN = 'admin';
    case USER = 'user';

    public static function values(): array
    {
        return array_column(RoleEnums::cases(), 'value');
    }
}
